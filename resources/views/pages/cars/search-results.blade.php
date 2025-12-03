@extends('layouts.app')
@php
    $currencySymbol = config('company.currency_symbol', '€');
@endphp
@section('content')
<div class="container py-5">
    <h1 class="mb-4 text-white">Available Cars</h1>
    <div class="alert alert-light">
        Showing cars available from 
        {{ $searchParams['pickup_date'] ?? 'N/A' }} at {{ $searchParams['pickup_time'] ?? 'N/A' }}
        to {{ $searchParams['dropoff_date'] ?? 'N/A' }} at {{ $searchParams['dropoff_time'] ?? 'N/A' }}
    </div>
    
    @if($cars->isEmpty())
        <div class="alert alert-warning">No available cars found for your selected dates.</div>
    @else
        <div class="row g-4">
            @foreach($cars as $car)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm">
                    <img src="{{ $car->image_url }}" class="card-img-top" alt="{{ $car->name }}">
                    <div class="card-body">
                        <h3 class="h5">{{ $car->name }}</h3>
                        <div class="d-flex justify-content-between mb-2">
                            <!-- <span>Year: {{ $car->year }}</span> -->
                            <span class="badge bg-primary">{{ $car->type }}</span>
                        </div>
                        <p class="mb-2"><strong>Price:</strong> {{ number_format($car->price_per_day, 0) }}{{ $currencySymbol }}/day</p>
                        
                        <a href="{{ route('cars.book', ['car' => $car->id] + $searchParams) }}" 
                           class="btn btn-primary w-100">
                            Book Now
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="mt-4">
            {{ $cars->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
@endsection