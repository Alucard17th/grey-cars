@extends('layouts.dashboard')

@section('content')
@php
    // Helpers
    $currency   = '€';                             // change to $, MAD, …
    $extras     = $reservation->extras   ?? [];    // ← casted to array in model
@endphp

<div class="container">

    {{-- PAGE TITLE --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">
            <i class="bi bi-receipt-cutoff me-1"></i>
            Reservation #{{ $reservation->id }}
        </h2>

        <div>
            <a href="{{ route('admin.reservations.edit',$reservation) }}" class="btn btn-outline-primary me-2">
                <i class="bi bi-pencil-square"></i> Edit
            </a>
            <a href="{{ route('admin.reservations.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left-circle"></i> Back
            </a>
        </div>
    </div>

    {{-- SUMMARY CARD --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h5 class="card-title"><i class="bi bi-info-circle me-1"></i>Summary</h5>
            <div class="row gy-2">
                <div class="col-md-4">
                    <strong>Car:</strong> {{ $reservation->car->name }}
                </div>
                <div class="col-md-4">
                    <strong>Status:</strong>
                    <span class="badge bg-info text-dark">{{ ucfirst($reservation->status) }}</span>
                </div>
                <div class="col-md-4">
                    <strong>Total price:</strong>
                    {{ $currency }}{{ number_format($reservation->total_price,2) }}
                </div>
            </div>
        </div>
    </div>

    {{-- CUSTOMER CARD --}}
    <div class="card mb-4">
        <div class="card-header fw-semibold">
            <i class="bi bi-person-lines-fill me-1"></i> Customer details
        </div>
        <div class="card-body">
            <div class="row gy-2">
                <div class="col-md-4"><strong>Name:</strong> {{ $reservation->customer_name }}</div>
                <div class="col-md-4"><strong>Email:</strong> {{ $reservation->customer_email }}</div>
                <div class="col-md-4"><strong>Phone:</strong> {{ $reservation->customer_phone }}</div>
                @if($reservation->customer_flight_number)
                    <div class="col-12"><strong>Flight #:</strong> {{ $reservation->customer_flight_number }}</div>
                @endif
            </div>
        </div>
    </div>

    {{-- SCHEDULE & LOCATIONS --}}
    <div class="row mb-4">
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header fw-semibold">
                    <i class="bi bi-calendar-event me-1"></i> Schedule
                </div>
                <div class="card-body">
                    <p class="mb-1">
                        <strong>Pickup:</strong>
                        {{ $reservation->pickup_date->format('d M Y') }}
                        @ {{ $reservation->pickup_time }}
                    </p>
                    <p class="mb-0">
                        <strong>Drop-off:</strong>
                        {{ $reservation->dropoff_date->format('d M Y') }}
                        @ {{ $reservation->dropoff_time }}
                    </p>
                    <p class="text-muted small mb-0">
                        ({{ $reservation->days }} {{ Str::plural('day',$reservation->days) }})
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mt-3 mt-lg-0">
            <div class="card h-100">
                <div class="card-header fw-semibold">
                    <i class="bi bi-geo-alt me-1"></i> Locations
                </div>
                <div class="card-body">
                    <p class="mb-1"><strong>Pickup:</strong> {{ $reservation->pickup_location }}</p>
                    <p class="mb-0"><strong>Drop-off:</strong> {{ $reservation->dropoff_location }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- EXTRAS--}}
    @if(count($extras))
    <div class="card mb-4">
        <div class="card-header fw-semibold">
            <i class="bi bi-plus-circle me-1"></i> Extras
        </div>
        <div class="card-body">
            @if(count($extras))
                <h6 class="fw-semibold">Extras (charged per day)</h6>
                <table class="table table-sm align-middle">
                    <thead class="table-light">
                        <tr><th>Extra</th><th class="text-end">Price/day</th><th class="text-end">Total</th></tr>
                    </thead>
                    <tbody>
                        @foreach($extras as $item)
                            <tr>
                                <td>{{ $item['name'] }}</td>
                                <td class="text-end">{{ $currency }}{{ number_format($item['price'],2) }}</td>
                                <td class="text-end">{{ $currency }}{{ number_format($item['total'],2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="fw-semibold">
                            <td colspan="2" class="text-end">Extras total</td>
                            <td class="text-end">{{ $currency }}{{ number_format($reservation->extras_total,2) }}</td>
                        </tr>
                    </tfoot>
                </table>
            @endif
          
        </div>
    </div>
    @endif

    {{-- PRICING BREAKDOWN --}}
    <div class="card mb-4">
        <div class="card-header fw-semibold">
            <i class="bi bi-cash-coin me-1"></i> Pricing breakdown
        </div>
        <div class="card-body">
            <div class="row gy-2">
                <div class="col-md-4">
                    <strong>Car rate:</strong>
                    {{ $currency }}{{ number_format($reservation->car->price_per_day,2) }}
                    × {{ $reservation->days }} days
                </div>
                <div class="col-md-4">
                    <strong>Security deposit:</strong>
                    {{ $currency }}{{ number_format($reservation->security_deposit,2) }}
                    ({{ $reservation->security_deposit_type ?? 'fixed' }})
                </div>
                <div class="col-md-4">
                    <strong>Extras total:</strong>
                    {{ $currency }}{{ number_format($reservation->extras_total,2) }}
                </div>
            </div>
            <hr>
            <h5 class="mb-0">
                <i class="bi bi-calculator"></i>
                Grand total:
                <span class="text-primary">
                    {{ $currency }}{{ number_format($reservation->total_price,2) }}
                </span>
            </h5>
        </div>
    </div>

    {{-- SPECIAL REQUESTS --}}
    @if($reservation->special_requests)
    <div class="card mb-4">
        <div class="card-header fw-semibold">
            <i class="bi bi-chat-left-text me-1"></i> Special requests
        </div>
        <div class="card-body">
            {{ $reservation->special_requests }}
        </div>
    </div>
    @endif

</div>
@endsection
