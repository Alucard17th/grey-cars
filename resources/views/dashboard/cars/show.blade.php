@extends('layouts.dashboard')

@section('content')
<div class="dash-card">
    <div class="dash-card-header">
        <div class="d-flex align-items-center gap-2">
            <div class="text-primary"><i class="bi bi-car-front fs-5"></i></div>
            <div>
                <div class="fw-semibold">{{ $car->name }}</div>
                <div class="small text-muted">Car details</div>
            </div>
        </div>

        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('admin.cars.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left"></i>
            </a>
            <a href="{{ route('admin.cars.edit', $car->id) }}" class="btn btn-primary btn-sm">
                <i class="bi bi-pencil-square me-1"></i>Edit
            </a>
        </div>
    </div>

    <div class="dash-card-body">
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        @if($car->image_url)
                            <img src="{{ $car->image_url }}" alt="{{ $car->name }}" class="img-fluid rounded"
                                style="width:100%;max-height:280px;object-fit:cover;">
                        @else
                            <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height: 220px;">
                                <div class="text-muted">No image</div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-2">
                            <div>
                                <div class="h5 mb-1">{{ $car->name }}</div>
                                <div class="text-muted">{{ $car->year }}</div>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <span class="rounded-circle" style="width:12px;height:12px;background:{{ $car->color }}"></span>
                                <span class="text-muted">{{ $car->color }}</span>
                            </div>
                        </div>

                        @if($car->description)
                            <div class="text-muted small">Description</div>
                            <div class="mb-0">{{ $car->description }}</div>
                            <hr>
                        @else
                            <hr>
                        @endif

                        <div class="row gy-2">
                            <div class="col-md-6">
                                <div class="text-muted small">Price per day</div>
                                <div class="fw-semibold">
                                    {{ number_format($car->price_per_day, 2) }}{{ config('rental.currency_symbol', '€') }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="text-muted small">Deposit mode</div>
                                <div class="fw-semibold">
                                    {{ $car->is_security_deposit_fix ? 'Fixed only' : 'Flexible' }}
                                </div>
                            </div>
                            @if($car->security_deposit_per_day)
                                <div class="col-md-6">
                                    <div class="text-muted small">Daily deposit</div>
                                    <div class="fw-semibold">
                                        {{ number_format($car->security_deposit_per_day, 2) }}{{ config('rental.currency_symbol', '€') }}
                                    </div>
                                </div>
                            @endif
                            @if($car->security_deposit_fixed)
                                <div class="col-md-6">
                                    <div class="text-muted small">Fixed deposit</div>
                                    <div class="fw-semibold">
                                        {{ number_format($car->security_deposit_fixed, 2) }}{{ config('rental.currency_symbol', '€') }}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mt-1">
            @if($car->options)
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white fw-semibold">
                            <i class="bi bi-sliders me-1"></i> Options
                        </div>
                        <div class="card-body">
                            <pre class="mb-0">{{ json_encode($car->options, JSON_PRETTY_PRINT) }}</pre>
                        </div>
                    </div>
                </div>
            @endif

            @if($car->extras)
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white fw-semibold">
                            <i class="bi bi-plus-circle me-1"></i> Extras
                        </div>
                        <div class="card-body">
                            <pre class="mb-0">{{ json_encode($car->extras, JSON_PRETTY_PRINT) }}</pre>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div class="d-flex justify-content-between mt-4 small text-muted">
            <div>Created: {{ $car->created_at->format('M d, Y H:i') }}</div>
            <div>Updated: {{ $car->updated_at->format('M d, Y H:i') }}</div>
        </div>
    </div>
</div>
@endsection