<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = 12;
        $cars = Car::query()
            ->when($request->has('search'), function($query) use ($request) {
                $query->where('name', 'like', '%'.$request->search.'%')
                    ->orWhere('description', 'like', '%'.$request->search.'%');
            })
            ->paginate($perPage);
        
        return view('pages.cars.cars', compact('cars'));
    }

   public function search(Request $request)
    {
        $validated = $request->validate([
            'pickup_location' => 'required|string',
            'dropoff_location' => 'required|string',
            'pickup_date' => ['required', 'date', 'after_or_equal:today'],
            'dropoff_date' => [
                'nullable',
                'date',
                function ($attribute, $value, $fail) use ($request) {
                    $pickup = Carbon::parse($request->input('pickup_date'));
                    $dropoff = Carbon::parse($value ?? $request->input('pickup_date'));
                    if ($pickup->diffInDays($dropoff, false) < 3) {
                        $fail('The drop-off date must be at least 3 days after the pickup date.');
                    }
                }
            ],
            'pickup_time' => 'nullable|date_format:H:i',
            'dropoff_time' => 'nullable|date_format:H:i',
        ]);

        // Default drop-off date = pickup_date if not set
        $validated['dropoff_date'] = $validated['dropoff_date'] ?? $validated['pickup_date'];

        // Default time values
        $validated['pickup_time'] = $validated['pickup_time'] ?? '00:00';
        $validated['dropoff_time'] = $validated['dropoff_time'] ?? '23:59';

        $cars = Car::whereDoesntHave('reservations', function ($query) use ($validated) {
                $query->where(function ($q) use ($validated) {
                    $q->whereBetween('pickup_date', [$validated['pickup_date'], $validated['dropoff_date']])
                    ->orWhereBetween('dropoff_date', [$validated['pickup_date'], $validated['dropoff_date']])
                    ->orWhere(function ($inner) use ($validated) {
                        $inner->where('pickup_date', '<=', $validated['pickup_date'])
                                ->where('dropoff_date', '>=', $validated['dropoff_date']);
                    });
                });
            })
            ->paginate(12)
            ->appends($validated);

        return view('pages.cars.search-results', [
            'cars' => $cars,
            'searchParams' => $validated
        ]);
    }

    public function book(Car $car, Request $request)
    {
        try {
            $searchParams = $request->validate([
                'pickup_location' => 'required|string',
                'dropoff_location' => 'required|string',
                'pickup_date' => 'required|date',
                'dropoff_date' => 'required|date',
                'pickup_time' => 'nullable',
                'dropoff_time' => 'nullable',
            ]);
            
            if(!empty($searchParams['pickup_date']) || !empty($searchParams['dropoff_date'])) {
                if (!$car->isAvailable($searchParams['pickup_date'], $searchParams['dropoff_date'])) {
                    return back()->with('error', 'This car is no longer available for your selected dates.');
                }
            }
           
            return view('pages.cars.book', compact('car', 'searchParams'));
        }catch(\Exception $e) {
            // Log the error instead of dd() in production
            dd($e->getMessage());
        }
       
    }

    public function jsonBook(Car $car, Request $request)
    {
        try {
            $searchParams = $request->validate([
                'pickup_location' => 'required|string',
                'dropoff_location' => 'required|string',
                'pickup_date' => 'required|date',
                'dropoff_date' => 'required|date',
                'pickup_time' => 'nullable',
                'dropoff_time' => 'nullable',
            ]);
            
            if(!empty($searchParams['pickup_date']) || !empty($searchParams['dropoff_date'])) {
                if (!$car->isAvailable($searchParams['pickup_date'], $searchParams['dropoff_date'])) {
                    return response()->json([
                        'success' => false,
                        'message' => 'This car is no longer available for your selected dates.',
                        'available' => false
                    ]);
                }
            }
           
            return response()->json([
                'success' => true,
                'message' => 'This car is available for your selected dates.',
                'car' => $car,
                'searchParams' => $searchParams,
                'available' => true
            ]);
        }catch(\Exception $e) {
            // Log the error instead of dd() in production
            dd($e->getMessage());
        }
       
    }

    public function storeBooking(Car $car, Request $request)
    {
        // dd($request->all());
        try {
            $validated = $request->validate([
                'customer_name' => 'required|string|max:255',
                'customer_email' => 'required|email',
                'customer_phone' => 'required|string',
                'customer_flight_number' => 'required|string',
                'pickup_location' => 'required|string',
                'dropoff_location' => 'required|string',
                'pickup_date' => 'required|date',
                'dropoff_date' => 'required|date',
                'pickup_time' => 'nullable',
                'dropoff_time' => 'nullable',
                'special_requests' => 'nullable|string',
                'extras' => 'nullable|array',
                'extras.*' => 'string',
                'security_deposit' => 'nullable|string',
            ]);

            // Calculate days for pricing
            $pickup = Carbon::parse($validated['pickup_date']);
            $dropoff = Carbon::parse($validated['dropoff_date']);
            $days = max(1, $pickup->diffInDays($dropoff));

            // Prepare extras data
            $selectedExtras = [];
            $extrasTotal = 0;
            
            if (!empty($validated['extras'])) {
                foreach ($validated['extras'] as $extraName) {
                    if (isset($car->extras[$extraName])) {
                        $price = (float) preg_replace('/[^0-9.]/', '', $car->extras[$extraName]);
                        $selectedExtras[$extraName] = [
                            'name' => $extraName,
                            'price' => $price,
                            'total' => $price * $days
                        ];
                        $extrasTotal += $price * $days;
                    }
                }
            }

            // Calculate security deposit
            // $securityDeposit = $validated['security_deposit'] === 'per_day' 
            //     ? $car->security_deposit_per_day * $days 
            //     : $car->security_deposit_fixed;

            // ---------- security deposit ----------
            $useDeposit = config('rental.use_deposit'); // or config('app.use_deposit')

            if ($useDeposit) {
                // If car has fixed deposit only, force 'fixed'
                $depositType = $car->is_security_deposit_fix
                    ? 'fixed'
                    : ($data['security_deposit'] ?? 'per_day');

                if ($depositType === 'per_day') {
                    $securityDeposit = $car->security_deposit_per_day * $days;
                } else {
                    $securityDeposit = $car->security_deposit_fixed;
                }
            } else {
                // When deposit is disabled via .env/config
                $securityDeposit = 0; // or null, depending on how you want to store it
            }

            // Between cities fees
            $betweenCitiesMultiplier = shouldApplyTransportFee($request['pickup_location'], $request['dropoff_location']);
            $between_cities_fee = config('company.fees.between_cities') * $betweenCitiesMultiplier;

            // Create reservation
            $reservation = $car->reservations()->create([
                'customer_name' => $validated['customer_name'],
                'customer_email' => $validated['customer_email'],
                'customer_phone' => $validated['customer_phone'],
                'customer_flight_number' => $validated['customer_flight_number'],
                'pickup_location' => $validated['pickup_location'],
                'dropoff_location' => $validated['dropoff_location'],
                'pickup_date' => $validated['pickup_date'],
                'dropoff_date' => $validated['dropoff_date'],
                'pickup_time' => $validated['pickup_time'],
                'dropoff_time' => $validated['dropoff_time'],
                'special_requests' => $validated['special_requests'],
                'extras' => json_encode($selectedExtras), // Store as JSON
                'extras_total' => $extrasTotal,
                'security_deposit' => $securityDeposit,
                'total_price' => ($car->price_per_day * $days) + $extrasTotal + $between_cities_fee,
                'status' => 'confirmed',
                'days' => $days
            ]);

            // Send confirmation email
            // ---------- Send email to your Gmail with order details ----------
            try {
                $whatsAppNumber = preg_replace('/\D+/', '', $reservation->customer_phone); // keep only digits
                $whatsAppLink   = "https://wa.me/{$whatsAppNumber}";
                $sendTo = config('rental.send_order_to_email', '€');
                $currencySymbol = config('rental.currency_symbol', '€');

                $extras = $reservation->extras;
                if (is_string($extras)) {
                    $extras = json_decode($extras, true);
                }
                if (!is_array($extras)) {
                    $extras = [];
                }

                $extrasHtml = '';
                if (count($extras)) {
                    $extrasHtml .= "<br><strong>Extras</strong><br>";
                    foreach ($extras as $extra) {
                        $name = $extra['name'] ?? '';
                        $price = $extra['price'] ?? null;
                        $total = $extra['total'] ?? null;

                        $line = $name;
                        if ($price !== null) {
                            $line .= ' - ' . number_format((float) $price, 2) . $currencySymbol . '/day';
                        }
                        if ($total !== null) {
                            $line .= ' (Total: ' . number_format((float) $total, 2) . $currencySymbol . ')';
                        }

                        $extrasHtml .= "- {$line}<br>";
                    }
                }
                Mail::html("
                    New reservation #{$reservation->id}<br><br>
                    Car: {$reservation->car->name}<br>
                    Days: {$reservation->days}<br>
                    Customer: {$reservation->customer_name}<br>
                    Email: {$reservation->customer_email}<br>
                    Phone: <a href=\"{$whatsAppLink}\">WhatsApp {$reservation->customer_phone}</a><br><br>
                    Pickup: {$reservation->pickup_date->format('Y-m-d')} {$reservation->pickup_time} - {$reservation->pickup_location}<br>
                    Dropoff: {$reservation->dropoff_date->format('Y-m-d')} {$reservation->dropoff_time} - {$reservation->dropoff_location}<br><br>
                    Extras total: {$reservation->extras_total}{$currencySymbol}<br>
                    {$extrasHtml}
                    Total price: {$reservation->total_price}{$currencySymbol}<br>
                ", function ($message) use ($reservation, $sendTo) {
                    $message->to($sendTo)
                            ->subject('New Reservation #' . $reservation->id);
                });

            } catch (\Throwable $mailException) {
                \Log::error('Failed to send reservation email', [
                    'reservation_id' => $reservation->id,
                    'error'          => $mailException->getMessage(),
                ]);
                // do NOT return/throw here, just continue
            }
            // Mail::to($validated['customer_email'])->send(new ReservationConfirmation($reservation));

            return redirect()->route('reservations.show', $reservation)
                ->with('success', 'Your reservation has been confirmed!');
                
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'An error occurred while processing your reservation: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cars.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'color' => 'required|string|max:100',
            'price_per_day' => 'required|numeric|min:0',
            'security_deposit_per_day' => 'nullable|numeric|min:0',
            'security_deposit_fixed' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'options' => 'nullable|array',
            'options.*' => 'string',
            'extras' => 'nullable|array',
            'extras.*' => 'required|string',
        ]);

        if ($request->hasFile('image')) {
            File::ensureDirectoryExists(public_path('images/cars'));
            $filename = $request->file('image')->hashName();
            $request->file('image')->move(public_path('images/cars'), $filename);
            $validated['image'] = 'images/cars/' . $filename;
        }

        $validated['options'] = $request->input('options') ?: [];

        $car = Car::create($validated);

        // Convert extras to proper format if needed
        $extras = [];
        foreach ($request->input('extras', []) as $key => $value) {
            $extras[$key] = $value;
        }
        
        $car->extras = $extras;
        $car->save();

        return redirect()->route('cars.index')->with('success', 'Car created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        return view('cars.show', compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        return view('cars.edit', compact('car'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'color' => 'required|string|max:100',
            'price_per_day' => 'required|numeric|min:0',
            'security_deposit_per_day' => 'nullable|numeric|min:0',
            'security_deposit_fixed' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'options' => 'nullable|array',
            'options.*' => 'string',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($car->image) {
                if (str_starts_with($car->image, 'images/')) {
                    File::delete(public_path($car->image));
                } else {
                    Storage::disk('public')->delete($car->image);
                }
            }

            File::ensureDirectoryExists(public_path('images/cars'));
            $filename = $request->file('image')->hashName();
            $request->file('image')->move(public_path('images/cars'), $filename);
            $validated['image'] = 'images/cars/' . $filename;
        }

        $validated['options'] = $request->input('options') ?: [];

        $car->update($validated);

        return redirect()->route('cars.index')->with('success', 'Car updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        if ($car->image) {
            Storage::disk('public')->delete($car->image);
        }
        
        $car->delete();
        
        return redirect()->route('cars.index')->with('success', 'Car deleted successfully.');
    }
}