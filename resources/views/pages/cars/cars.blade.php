@extends('layouts.app')

@section('content')
<!-- Breadcrumb -->
    @include('components.breadcrumb', [
        'title'       => 'Our Cars',
        'subtitle'    => 'Quality You Can Feel, Convenience You Deserve',
        'bgImage'     => asset('img/hero.jpg'),
        'breadcrumbs' => [
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Our Cars']
        ]
    ])
<!-- 
<div class="container-fluid d-flex align-items-center justify-content-center text-white"
    style="height:50vh; background-image: url('{{ asset('storage/slider/morocco-car.jpg') }}'); background-size: cover; background-position: bottom center; background-repeat: no-repeat;">
    <h1 class="fw-bold">Our Cars</h1>
</div> -->
<div class="container py-5">
    <div class="row g-4">
        @foreach($cars as $car)
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 shadow bg-light">
                <img src="{{ $car->image_url }}" class="card-img-top"
                    alt="{{ $car->name }}">
                <div class="card-body">
                    <h3 class="h5">{{ $car->name }}</h3>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Year: {{ $car->year }}</span>
                        <span class="badge bg-primary">{{ $car->type }}</span>
                    </div>
                    <p class="mb-2"><strong>Price:</strong> ${{ $car->price_per_day }}/day</p>

                    @if($car->options)
                    <div class="mb-3">
                        <h4 class="h6">Features:</h4>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach($car->options as $option)
                            <span class="badge bg-black p-2">{{ $option }}</span>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    @if($car->extras)
                    <div class="mb-3">
                        <h4 class="h6">Extras:</h4>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach($car->extras as $extra => $price)
                            <span class="badge bg-black p-2">{{ $extra }} (${{ $price }})</span>
                            @endforeach
                        </div>
                    </div>
                    @endif  

                    <div class="d-grid gap-2 mt-5">
                        <a href="#" class="btn btn-primary btn-block book-now-btn py-2" data-car-id="{{ $car->id }}" data-bs-toggle="modal"
                            data-bs-target="#bookingModal">Book Now</a>
                    </div>

                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $cars->links('pagination::bootstrap-5') }}
    </div>

    @include('components.searchCarModal')
</div>
@endsection