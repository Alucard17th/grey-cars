<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $perPage = 20;
        $cars = Car::query()
            ->when($request->has('search'), function($query) use ($request) {
                $query->where('name', 'like', '%'.$request->search.'%')
                    ->orWhere('description', 'like', '%'.$request->search.'%');
            })
            ->paginate($perPage);
        
        return view('dashboard.cars.index', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('dashboard.cars.create');
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
    {
        try{
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'year' => 'required|integer',
                'color' => 'required|string|max:255',
                'price_per_day' => 'required|numeric',
                'security_deposit_per_day' => 'nullable|numeric',
                'security_deposit_fixed' => 'nullable|numeric',
                'image' => 'nullable|image|max:2048',
                'is_security_deposit_fix' => 'nullable|boolean',
            ]);

            // Process options
            $options = [];
            if ($request->has('options_keys')) {
                foreach ($request->options_keys as $index => $key) {
                    if (!empty($key)) {
                        $value = $request->options_values[$index] ?? '';
                        $options[$key] = $value;
                    }
                }
            }

            // Process extras
            $extras = [];
            if ($request->has('extras_keys')) {
                foreach ($request->extras_keys as $index => $key) {
                    if (!empty($key)) {
                        $value = $request->extras_values[$index] ?? '';
                        $extras[$key] = $value;
                    }
                }
            }

            // Handle file upload
            if ($request->hasFile('image')) {
                $validated['image'] = $request->file('image')->store('cars', 'public');
            }

            $car = Car::create([
                ...$validated,
                'options' => !empty($options) ? $options : null,
                'extras' => !empty($extras) ? $extras : null,
            ]);

            return redirect()->route('admin.cars.index')->with('success', 'Car created successfully');
        }catch(\Exception $e){
            return redirect()->route('admin.cars.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $car = Car::findOrFail($id);
        return view('dashboard.cars.show', compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $car = Car::findOrFail($id);
        return view('dashboard.cars.edit', compact('car'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'year' => 'required|integer',
            'color' => 'required|string|max:255',
            'price_per_day' => 'required|numeric',
            'security_deposit_per_day' => 'nullable|numeric',
            'security_deposit_fixed' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            // 'options' => 'nullable|array',
            // 'options.*' => 'string',
            // 'extras' => 'nullable|array',
            // 'extras.*' => 'string',
            // ... other validation rules
            'is_security_deposit_fix' => 'nullable|boolean',
        ]);

        $car = Car::find($id);

        // Process options
        $options = [];
        if ($request->has('options_keys')) {
            foreach ($request->options_keys as $index => $key) {
                if (!empty($key)){
                    $value = $request->options_values[$index] ?? '';
                    $options[$key] = $value;
                }
            }
        }

        // Process extras
        $extras = [];
        if ($request->has('extras_keys')) {
            foreach ($request->extras_keys as $index => $key) {
                if (!empty($key)) {
                    $value = $request->extras_values[$index] ?? '';
                    $extras[$key] = $value;
                }
            }
        }

        // Handle file upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('cars', 'public');
        }

        $isFixed = $request->has('is_security_deposit_fix') ? 1 : 0;
        $validated['is_security_deposit_fix'] = $isFixed;

        $car->update([
            ...$validated,
            'options' => !empty($options) ? $options : null,
            'extras' => !empty($extras) ? $extras : null,
        ]);

        return redirect()->route('admin.cars.index')->with('success', 'Car updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $car = Car::findOrFail($id);
        $car->delete();

        return redirect()->route('admin.cars.index')->with('success', 'Car deleted successfully');
    }
}
