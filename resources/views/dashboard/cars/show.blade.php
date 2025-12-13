@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Car Details: {{ $car->name }}</span>
                    <div>
                        <a href="{{ route('admin.cars.edit', $car->id) }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('admin.cars.index') }}" class="btn btn-sm btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-4 text-center">
                            @if($car->image_url)
                            <img src="{{ $car->image_url }}" alt="{{ $car->name }}" class="img-fluid rounded"
                                style="max-height: 200px;">
                            @else
                            <div class="bg-light p-5 text-center">
                                No Image Available
                            </div>
                            @endif
                        </div>
                        <div class="col-md-8">
                            <h3>{{ $car->name }}</h3>
                            <p class="text-muted">{{ $car->year }} • {{ $car->color }}</p>
                            <hr>
                            <div class="row">
                                <div class="col-6">
                                    <p><strong>Price Per Day:</strong> {{ number_format($car->price_per_day, 2) }}{{ config('rental.currency_symbol', '€') }}</p>
                                    @if($car->security_deposit_per_day)
                                    <p><strong>Daily Deposit:</strong>
                                        {{ number_format($car->security_deposit_per_day, 2) }}{{ config('rental.currency_symbol', '€') }}</p>
                                    @endif
                                </div>
                                <div class="col-6">
                                    @if($car->security_deposit_fixed)
                                    <p><strong>Fixed Deposit:</strong>
                                        {{ number_format($car->security_deposit_fixed, 2) }}{{ config('rental.currency_symbol', '€') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($car->options)
                    <div class="mb-4">
                        <h5>Options</h5>
                        <div class="card">
                            <div class="card-body">
                                <pre>{{ json_encode($car->options, JSON_PRETTY_PRINT) }}</pre>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($car->extras)
                    <div class="mb-4">
                        <h5>Extras</h5>
                        <div class="card">
                            <div class="card-body">
                                <pre>{{ json_encode($car->extras, JSON_PRETTY_PRINT) }}</pre>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-6">
                            <small class="text-muted">Created: {{ $car->created_at->format('M d, Y H:i') }}</small>
                        </div>
                        <div class="col-6 text-end">
                            <small class="text-muted">Updated: {{ $car->updated_at->format('M d, Y H:i') }}</small>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection