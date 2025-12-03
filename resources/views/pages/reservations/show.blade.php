@extends('layouts.app')

@section('content')
@php
    $currencySymbol = config('company.currency_symbol', '€');
@endphp
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Actions -->
            <div class="d-flex justify-content-between align-items-center my-4">
                <a href="{{ route('home') }}" class="btn btn-outline-light">
                    <i class="bi bi-arrow-left me-2"></i> Back to Home
                </a>
                <div class="d-flex gap-3">
                    <a href="{{ route('admin.reservations.print', $reservation) }}"
                        class="btn btn-outline-primary" target="_blank">
                        <i class="bi bi-printer me-2"></i> Print Reservation
                    </a>
                </div>
            </div>
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="h4 mb-0">Reservation #{{ $reservation->id }}</h2>
                        <span class="badge bg-white text-success fs-6">
                            <i class="bi bi-check-circle me-2"></i>
                            {{ ucfirst($reservation->status) }}
                        </span>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Reservation Timeline -->
                    <div class="mb-5">
                        <div class="d-flex align-items-center mb-3">
                            <h3 class="h5 mb-0 text-primary">Your Journey</h3>
                            <span class="ms-3 badge bg-primary-light text-primary">
                                {{ $reservation->days }} {{ Str::plural('day', $reservation->days) }}
                            </span>
                        </div>

                        <div class="timeline-steps">
                            <div class="timeline-step">
                                <div class="timeline-content">
                                    <div class="circle-icon bg-primary text-white">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                    <h5 class="mb-1">Pickup</h5>
                                    <p class="mb-0 text-muted">
                                        {{ $reservation->pickup_date->format('l, F j, Y') }}
                                    </p>
                                    <p class="fw-bold">
                                        {{ $reservation->pickup_time }} at {{ $reservation->pickup_location }}
                                    </p>
                                </div>
                            </div>
                            <div class="timeline-step">
                                <div class="timeline-content">
                                    <div class="circle-icon bg-primary text-white">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                    <h5 class="mb-1">Dropoff</h5>
                                    <p class="mb-0 text-muted">
                                        {{ $reservation->dropoff_date->format('l, F j, Y') }}
                                    </p>
                                    <p class="fw-bold">
                                        {{ $reservation->dropoff_time }} at {{ $reservation->dropoff_location }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Car Details -->
                        <div class="col-lg-6 mb-4">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-header bg-light">
                                    <h3 class="h5 mb-0">Your Vehicle</h3>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex flex-column">
                                        <div class="flex-shrink-0 me-3">
                                            <img src="{{ $reservation->car->image_url }}"
                                                alt="{{ $reservation->car->name }}" class="img-fluid rounded"
                                                style="width: 180px;">
                                        </div>
                                        <div class="flex-grow-1">
                                            <h4 class="mb-1">{{ $reservation->car->name }}</h4>
                                            <p class="text-muted mb-2">
                                                <span style="color: {{ $reservation->car->color }}">
                                                    {{ $reservation->car->color_name }}
                                                </span>
                                            </p>

                                            @if($reservation->car->options)
                                            <div class="d-flex flex-wrap gap-2 mb-3">
                                                @foreach($reservation->car->options as $option)
                                                <span class="badge bg-dark bg-opacity-10 text-dark">
                                                    {{ $option }}
                                                </span>
                                                @endforeach
                                            </div>
                                            @endif

                                            <div class="d-flex align-items-center">
                                                <span class="fs-4 fw-bold text-primary">
                                                    {{ number_format($reservation->car->price_per_day, 2) }}{{ $currencySymbol }}
                                                </span>
                                                <span class="ms-2 text-muted">/ day</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Customer Details -->
                        <div class="col-lg-6 mb-4">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-header bg-light">
                                    <h3 class="h5 mb-0">Your Details</h3>
                                </div>
                                <div class="card-body">
                                    <ul class="list-unstyled mb-0">
                                        <li class="mb-2">
                                            <strong>Name:</strong> {{ $reservation->customer_name }}
                                        </li>
                                        <li class="mb-2">
                                            <strong>Email:</strong> {{ $reservation->customer_email }}
                                        </li>
                                        <li class="mb-2">
                                            <strong>Phone:</strong> {{ $reservation->customer_phone }}
                                        </li>
                                        <li class="mb-2">
                                            <strong>Flight Number:</strong> {{ $reservation->customer_flight_number }}
                                        </li>
                                        @if($reservation->special_requests)
                                        <li class="mt-3 pt-3 border-top">
                                            <strong>Special Requests:</strong>
                                            <p class="mb-0">{{ $reservation->special_requests }}</p>
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pricing Breakdown -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-light">
                            <h3 class="h5 mb-0">Pricing Breakdown</h3>
                        </div>
                        <div class="card-body p-0">
                            @php
                            $basePrice = $reservation->car->price_per_day * $reservation->days;
                            $extrasTotal = $reservation->extras_total ?? 0;

                            $transportFee = shouldApplyTransportFee($reservation->pickup_location, $reservation->dropoff_location)
                            ? config('company.fees.between_cities') * 1 // both ways
                            : 0;

                            $useDeposit = config('rental.use_deposit');
                            $deposit = $useDeposit ? $reservation->security_deposit : 0;

                            $subtotal = $basePrice + $extrasTotal + $transportFee;
                            $total = $subtotal + $deposit;
                            @endphp

                            <table class="table table-borderless mb-0">
                                <tbody>
                                    <tr>
                                        <td class="ps-4">Base Price ({{ $reservation->days }} days)</td>
                                        <td class="text-end pe-4">
                                            {{ number_format($basePrice, 0) }}{{ $currencySymbol }}
                                        </td>
                                    </tr>

                                    @if($reservation->extras && count(json_decode($reservation->extras, true)) > 0)
                                    <tr>
                                        <td class="ps-4 border-top">Extras</td>
                                        <td class="text-end pe-4 border-top">
                                            {{ number_format($extrasTotal, 0) }}{{ $currencySymbol }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="px-4 py-0">
                                            <div class="bg-light rounded p-3">
                                                @foreach(json_decode($reservation->extras, true) as $extra)
                                                <div class="d-flex justify-content-between mb-1">
                                                    <span>{{ $extra['name'] }}</span>
                                                    <span>{{ number_format($extra['total'], 0) }}{{ $currencySymbol }}</span>
                                                </div>
                                                @endforeach
                                            </div>
                                        </td>
                                    </tr>
                                    @endif

                                    @if($transportFee > 0)
                                    <tr>
                                        <td class="ps-4">Transport Fee</td>
                                        <td class="text-end pe-4">
                                            {{ number_format($transportFee, 0) }}{{ $currencySymbol }}
                                        </td>
                                    </tr>
                                    @endif

                                    <tr class="border-top">
                                        <td class="ps-4"><strong>Subtotal</strong></td>
                                        <td class="text-end pe-4">
                                            <strong>{{ number_format($subtotal, 0) }}{{ $currencySymbol }}</strong>
                                        </td>
                                    </tr>

                                    @if($useDeposit)
                                    <tr>
                                        <td class="ps-4">Security Deposit</td>
                                        <td class="text-end pe-4">
                                            {{ number_format($deposit, 0) }}{{ $currencySymbol }}
                                        </td>
                                    </tr>
                                    @endif

                                    <tr class="bg-light">
                                        <td class="ps-4"><strong>Total Amount</strong></td>
                                        <td class="text-end pe-4">
                                            <strong class="text-primary">
                                                {{ number_format($total, 0) }}{{ $currencySymbol }}
                                            </strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Timeline Styles */
    .timeline-steps {
        display: flex;
        justify-content: space-between;
        padding: 0;
        position: relative;
    }

    .timeline-steps::before {
        content: "";
        position: absolute;
        top: 30px;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--bs-primary) 0%, rgba(13, 110, 253, 0.1) 100%);
    }

    .timeline-step {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
    }

    .circle-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 1rem;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
    }

    .timeline-content {
        text-align: center;
        padding: 0 1rem;
    }

    /* Card Enhancements */
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.1) !important;
    }

    /* Primary Light Color */
    .bg-primary-light {
        background-color: rgba(13, 110, 253, 0.1);
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .timeline-steps {
            flex-direction: column;
        }

        .timeline-steps::before {
            display: none;
        }

        .timeline-step {
            margin-bottom: 2rem;
        }

        .d-flex.justify-content-between {
            flex-direction: column;
            gap: 1rem;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add to Calendar functionality
        document.querySelector('.btn-primary').addEventListener('click', function() {
            const startDate = new Date('{{ $reservation->pickup_date->format('
                Y - m - d ') }}T{{ $reservation->pickup_time }}');
            const endDate = new Date('{{ $reservation->dropoff_date->format('
                Y - m - d ') }}T{{ $reservation->dropoff_time }}');

            const event = {
                title: 'Car Rental: {{ $reservation->car->name }}',
                description: `Reservation #{{ $reservation->id }}\nPickup: {{ $reservation->pickup_location }}\nDropoff: {{ $reservation->dropoff_location }}`,
                location: '{{ $reservation->pickup_location }}',
                start: startDate,
                end: endDate
            };

            // Here you would implement actual calendar integration
            alert('Add to calendar functionality would open here\n\n' +
                JSON.stringify(event, null, 2));
        });
    });
</script>
@endpush