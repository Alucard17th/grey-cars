@php
    $currencySymbol = $currencySymbol ?? config('company.currency_symbol', '€');
@endphp
<div class="car-card">
    <div class="car-card-media">
        <img src="{{ $car->image_url }}" alt="{{ $car->name }}" loading="lazy" decoding="async">
        <div class="car-card-price">
            {{ number_format($car->price_per_day, 0) }}{{ $currencySymbol }}<small>/day</small>
        </div>
    </div>
    <div class="car-card-body">
        <h5 class="car-card-title">{{ $car->name }}</h5>
        <div class="car-card-subtitle">or similar</div>

        @if($car->options && count($car->options) > 0)
        <div class="car-card-section-label">Features</div>
        <div class="d-flex flex-wrap gap-2 mb-3">
            @foreach($car->options as $option)
            <span class="car-chip">
                {!! car_icon($option) !!}
                {{ $option }}
            </span>
            @endforeach
        </div>
        @endif

        @if($car->extras && count($car->extras) > 0)
        <div class="car-card-section-label">Extras</div>
        <div class="d-flex flex-wrap gap-2 mb-3">
            @foreach($car->extras as $extra => $price)
            @php($normalizedPrice = is_numeric($price) ? (float) $price : (float) preg_replace('/[^0-9.\-]/', '', (string) $price))
            <span class="car-chip car-chip-extra">
                {!! car_icon($extra) !!}
                {{ $extra }}
                <span class="car-chip-price">+{{ number_format($normalizedPrice, 0) }}{{ $currencySymbol }}</span>
            </span>
            @endforeach
        </div>
        @endif
    </div>
    <div class="car-card-footer">
        <a href="#" class="car-card-btn book-now-btn" data-car-id="{{ $car->id }}" data-bs-toggle="modal" data-bs-target="#bookingModal">
            <i class="bi bi-calendar-check"></i> Book Now
        </a>
    </div>
</div>
