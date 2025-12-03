<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Car;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReservationController extends Controller
{
    /** List */
    public function index()
    {
        $reservations = Reservation::with('car')->latest()->paginate(15);
        return view('dashboard.reservations.index', compact('reservations'));
    }

    /** Show single */
    public function show(Reservation $reservation)
    {
        $reservation->load('car');
        return view('dashboard.reservations.show', compact('reservation'));
    }

    public function showForClient(Reservation $reservation)
    {
        $reservation->load('car');
        return view('pages.reservations.show', compact('reservation'));
    }

    public function print(Reservation $reservation)
    {
        return view('pages.reservations.print', compact('reservation'));
    }


    /** New form */
    public function create()
    {
        $cars = Car::all();
        return view('dashboard.reservations.create', compact('cars'));
    }

    /** Store */
    public function store(Request $request)
    {
        $data = $request->validate([
            'car_id'             => 'required|exists:cars,id',
            'customer_name'      => 'required|string|max:255',
            'customer_email'     => 'required|email',
            'customer_phone'     => 'required|string',
            'customer_flight_number' => 'nullable|string',
            'pickup_location'    => 'required|string',
            'dropoff_location'   => 'required|string',
            'pickup_date'        => 'required|date',
            'dropoff_date'       => 'required|date|after_or_equal:pickup_date',
            'pickup_time'        => 'required',
            'dropoff_time'       => 'required',
            'special_requests'   => 'nullable|string',
            'extras'             => 'nullable|array',
            'extras.*'           => 'string',
            'security_deposit'   => 'nullable|in:per_day,fixed',
            'status'             => 'nullable|in:confirmed,pending,cancelled',
        ]);
        
        $car  = Car::findOrFail($data['car_id']);

        [$payload, $extrasTotal, $days] = $this->buildPayload($data, $car);

        $reservation = Reservation::create($payload + [
            'extras_total' => $extrasTotal,
            'total_price'  => ($car->price_per_day * $days) + $extrasTotal,
            'days'         => $days,
            'status'       => 'confirmed',
        ]);

        return redirect()->route('admin.reservations.show', $reservation)
                         ->with('success', 'Reservation created.');
    }

    /** Edit form */
    public function edit(Reservation $reservation)
    {
        $cars = Car::all();
        return view('dashboard.reservations.edit', compact('reservation','cars'));
    }

    /** Update */
    public function update(Request $request, Reservation $reservation)
    {
        $data = $this->validateInput($request, $reservation->id);
        $car  = Car::findOrFail($data['car_id']);

        [$payload, $extrasTotal, $days] = $this->buildPayload($data, $car);

        $reservation->update($payload + [
            'extras_total' => $extrasTotal,
            'total_price'  => ($car->price_per_day * $days) + $extrasTotal,
            'days'         => $days,
        ]);

        return back()->with('success', 'Reservation updated.');
    }

    /** Delete */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return back()->with('success', 'Reservation deleted.');
    }

    /* -------------------------------- PRIVATE HELPERS ------------------ */

    private function validateInput(Request $r, $id = null): array
    {
        return $r->validate([
            'car_id'             => 'required|exists:cars,id',
            'customer_name'      => 'required|string|max:255',
            'customer_email'     => 'required|email',
            'customer_phone'     => 'required|string',
            'customer_flight_number' => 'nullable|string',
            'pickup_location'    => 'required|string',
            'dropoff_location'   => 'required|string',
            'pickup_date'        => 'required|date',
            'dropoff_date'       => 'required|date|after_or_equal:pickup_date',
            'pickup_time'        => 'required',
            'dropoff_time'       => 'required',
            'special_requests'   => 'nullable|string',
            'extras'             => 'nullable|array',
            'extras.*'           => 'string',
            'security_deposit'   => 'nullable|in:per_day,fixed',
            'status'             => 'nullable|in:confirmed,pending,cancelled',
        ]);
    }

    private function buildPayload(array $data, Car $car): array
    {
        $between_cities_fees = config('company.fees.between_cities');
        $days = Carbon::parse($data['pickup_date'])
                    ->diffInDays(Carbon::parse($data['dropoff_date'])) + 1;

        // ---------- extras ----------
        $extraArr    = [];
        $extrasTotal = 0;

        foreach ($data['extras'] ?? [] as $extraName) {
            if (isset($car->extras[$extraName])) {
                $price = (float) preg_replace('/[^0-9.]/', '', $car->extras[$extraName]);
                $extraArr[$extraName] = [
                    'name'  => $extraName,
                    'price' => $price,
                    'total' => $price * $days,
                ];
                $extrasTotal += $price * $days;
            }
        }

        // $securityDeposit = $data['security_deposit'] === 'per_day'
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

        /* ------------- payload ------------- */
        $payload = [
            'car_id'              => $car->id,
            'customer_name'       => $data['customer_name'],
            'customer_email'      => $data['customer_email'],
            'customer_phone'      => $data['customer_phone'],
            'customer_flight_number' => $data['customer_flight_number'] ?? null,
            'pickup_location'     => $data['pickup_location'],
            'dropoff_location'    => $data['dropoff_location'],
            'pickup_date'         => $data['pickup_date'],
            'dropoff_date'        => $data['dropoff_date'],
            'pickup_time'         => $data['pickup_time'],
            'dropoff_time'        => $data['dropoff_time'],
            'special_requests'    => $data['special_requests'] ?? null,
            'extras'              => $extraArr,
            'security_deposit'    => $securityDeposit,
            'status'              => $data['status'] ?? 'pending',
        ];

        return [$payload, $extrasTotal, $days];
    }

    public function carConfig(\App\Models\Car $car)
    {
        return response()->json([
            'extras'  => $car->extras  ?? [],
        ]);
    }

}
