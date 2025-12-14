@extends('layouts.app')

@section('content')
@php
    $currencySymbol = config('company.currency_symbol', '€');
    $betweenCitiesMultiplier = shouldApplyTransportFee($searchParams['pickup_location'], $searchParams['dropoff_location']);
@endphp
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h2 class="h4 mb-0">Book {{ $car->name }}</h2>
                </div>

                <div class="card-body">
                    <div class="row">
                        <!-- Left Column - Car Details -->
                        <div class="col-md-5">
                            <div class="mb-4">
                                @if($car->image)
                                <img src="{{$car->image_url }}" alt="{{ $car->name }}" class="img-fluid rounded mb-3">
                                @else
                                <div class="bg-light text-center p-5 rounded mb-3">
                                    <i class="fas fa-car fa-5x text-muted"></i>
                                </div>
                                @endif

                                <h3 class="h4">{{ $car->name }}</h3>
                                <!-- Price -->
                                <p class=""><strong>Price:</strong> {{ number_format($car->price_per_day, 2) }}{{ $currencySymbol }}
                                    /day</p>
                                @if($car->options && count($car->options) > 0)
                                <h4 class="h5 fw-bold">Features:</h4>
                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    @foreach($car->options as $option)
                                    <span class="badge bg-black p-2 d-flex align-items-center"><i
                                            class="bi {{ car_icon($option) }} me-1 fs-5"></i>{{ $option }}</span>
                                    @endforeach
                                </div>
                                @endif
                                @if($car->extras && count($car->extras) > 0)
                                <h4 class="h5 fw-bold">Extras:</h4>
                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    @foreach($car->extras as $extra => $price)
                                    <span class="badge bg-black p-2 d-flex align-items-center"><i
                                            class="bi {{ car_icon($extra) }} me-1 fs-5"></i>
                                        {{ $extra }} ({{ $price }}{{ $currencySymbol }})</span>
                                    @endforeach
                                </div>
                                @endif
                            </div>

                            <div class="alert alert-light">
                                <h5 class="fw-bold">Booking Summary</h5>
                                <p><strong>Pickup:</strong> {{ $searchParams['pickup_location'] }} on
                                    <span class="fw-bold">{{ $searchParams['pickup_date'] }}</span> at
                                    {{ $searchParams['pickup_time'] }}
                                </p>
                                <p><strong>Dropoff:</strong> {{ $searchParams['dropoff_location'] }} on
                                    <span class="fw-bold">{{ $searchParams['dropoff_date'] }}</span> at
                                    {{ $searchParams['dropoff_time'] }}
                                </p>
                                <p class="mb-0"><strong>Total Price:</strong>
                                    {{ $car->calculateTotalPrice($searchParams['pickup_date'], $searchParams['dropoff_date']) }}{{ $currencySymbol }}
                                </p>
                            </div>
                        </div>

                        <!-- Right Column - Booking Form -->
                        <div class="col-md-7">
                            <form action="{{ route('cars.book.store', $car) }}" method="POST">
                                @csrf
                                <input type="hidden" name="pickup_location"
                                    value="{{ $searchParams['pickup_location'] }}">
                                <input type="hidden" name="dropoff_location"
                                    value="{{ $searchParams['dropoff_location'] }}">
                                <input type="hidden" name="pickup_date" value="{{ $searchParams['pickup_date'] }}">
                                <input type="hidden" name="dropoff_date" value="{{ $searchParams['dropoff_date'] }}">
                                <input type="hidden" name="pickup_time" value="{{ $searchParams['pickup_time'] }}">
                                <input type="hidden" name="dropoff_time" value="{{ $searchParams['dropoff_time'] }}">

                                @if($car->description)
                                <div class="mb-4">
                                    <h3 class="h5 mb-2">Description</h3>
                                    <div class="text-muted">{{ $car->description }}</div>
                                </div>
                                @endif

                                <h3 class="h4 mb-4">Your Information</h3>

                                <div class="mb-3">
                                    <label for="customer_name" class="form-label">Full Name</label>
                                    <input type="text" name="customer_name" id="customer_name" class="form-control"
                                        required>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="customer_email" class="form-label">Email</label>
                                        <input type="email" name="customer_email" id="customer_email"
                                            class="form-control" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="customer_phone" class="form-label">Phone Number</label>
                                        <input type="tel" name="customer_phone" id="customer_phone" class="form-control"
                                            required>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="customer_flight_number" class="form-label">Flight Number</label>
                                    <input type="text" name="customer_flight_number" id="customer_flight_number"
                                        class="form-control" required>
                                </div>

                                <div class="mb-4">
                                    <label for="special_requests" class="form-label">Special Requests</label>
                                    <textarea name="special_requests" id="special_requests" class="form-control"
                                        rows="3"></textarea>
                                </div>
                                
                                @if(config('rental.use_deposit'))
                                <div class="card mb-4 shadow-sm">
                                    <div class="card-header bg-transparent border-0">
                                        <h5 class="mb-0 fw-bold">Security Deposit</h5>
                                    </div>
                                    <div class="card-body">
                                        @if($car->is_security_deposit_fix)
                                        <!-- Show only fixed option -->
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="security_deposit"
                                                id="security_deposit_fixed" value="fixed"
                                                {{ old('security_deposit', 'fixed') == 'fixed' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="security_deposit_fixed">
                                                {{ $car->security_deposit_fixed }}{{ $currencySymbol }} fixed
                                            </label>
                                        </div>
                                        @else
                                        <!-- Show both options -->
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="security_deposit"
                                                id="security_deposit_per_day" value="per_day"
                                                {{ old('security_deposit', 'per_day') == 'per_day' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="security_deposit_per_day">
                                                {{ $car->security_deposit_per_day }}{{ $currencySymbol }} per day
                                            </label>
                                        </div>
                                        @endif

                                        @error('security_deposit')
                                        <div class="invalid-feedback d-block">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                @endif

                                <!-- Add this section below your existing form fields -->
                                @if($car->extras && count($car->extras) > 0)
                                <div class="card mb-4 shadow-sm">
                                    <div class="card-header bg-transparent border-0">
                                        <h5 class="mb-0 fw-bold">Available Extras</h5>
                                    </div>
                                    <div class="card-body">
                                        @foreach($car->extras as $name => $price)
                                        <div class="form-check mb-3">
                                            <input class="form-check-input extra-checkbox" type="checkbox"
                                                name="extras[]" id="extra-{{ Str::slug($name) }}" value="{{ $name }}"
                                                data-price="{{ (float) preg_replace('/[^0-9.]/', '', $price) }}">
                                            <label class="form-check-label" for="extra-{{ Str::slug($name) }}">
                                                <strong>{{ $name }}</strong> - {{ $price }}{{ $currencySymbol }} <small>(per day)</small>
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endif

                                <div class="mb-4">
                                    <h5 class="fw-bold">Terms and Conditions</h5>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="accept_terms"
                                            id="accept_terms" required>
                                        <label class="form-check-label" for="accept_terms">
                                            I acknowledge having read and accepted the <a href="{{ route('terms-and-conditions') }}" target="_blank">Terms and Conditions of Use</a>.
                                        </label>
                                    </div>
                                </div>

                                @if($betweenCitiesMultiplier > 0)
                                <div class="alert alert-warning" role="alert">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="accept_transport_fee"
                                            id="accept_transport_fee" required>
                                        <label class="form-check-label" for="accept_transport_fee">
                                            Your booking involves different cities
                                            ({{ $searchParams['pickup_location'] }} to
                                            {{ $searchParams['dropoff_location'] }}).
                                            <span class="fw-semibold">An additional transport fee of
                                                <span
                                                    class="fw-bold">{{ config('company.fees.between_cities') * $betweenCitiesMultiplier }}{{ $currencySymbol }}</span>
                                                will apply</span>
                                            to cover vehicle relocation between locations.
                                        </label>
                                    </div>
                                </div>
                                @endif
                                <button type="submit" class="btn btn-primary w-100 py-3">
                                    <i class="fas fa-check-circle me-2"></i> Confirm Booking
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection