@extends('layouts.app')

@section('content')
<!-- Breadcrumb -->
@include('components.breadcrumb', [
'title' => 'Our Cars',
'subtitle' => 'Quality You Can Feel, Convenience You Deserve',
'bgImage' => asset('img/hero.jpg'),
'breadcrumbs' => [
['label' => 'Home', 'url' => route('home')],
['label' => 'Our Cars']
]
])
<style>
.cars-pagination>nav>div>div>p {
    color: #ffffff !important;
}

.car-image {
    min-height: 225px;
    max-height: 225px;
}
</style>
<div class="container py-5">
    <div class="row g-4">
        @foreach($cars as $car)
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 shadow bg-light">
                <img src="{{ $car->image_url }}" class="card-img-top car-image" alt="{{ $car->name }}">
                <div class="card-body">
                    <h3 class="h5">{{ $car->name }} <span class="text-muted fs-6">(or
                            similar)</span></h3>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Year: {{ $car->year }}</span>
                        <span class="badge bg-primary">{{ $car->type }}</span>
                    </div>
                    <p class="mb-2"><strong>Price:</strong> ${{ $car->price_per_day }}/day</p>

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
                            {{ $extra }} (${{ $price }})</span>
                        @endforeach
                    </div>
                    @endif

                    <div class="d-grid gap-2 mt-5">
                        <a href="#" class="btn btn-primary btn-block book-now-btn py-2" data-car-id="{{ $car->id }}"
                            data-bs-toggle="modal" data-bs-target="#bookingModal">Book Now</a>
                    </div>

                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-4 cars-pagination">
        {{ $cars->links('pagination::bootstrap-5') }}
    </div>

    @include('components.searchCarModal')
</div>
@endsection