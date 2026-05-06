@php
    $currencySymbol = config('company.currency_symbol', '€');
@endphp
@if($cars->count() > 0)
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5 text-white">
            <span class="section-eyebrow">Our Fleet</span>
            <h2 class="fw-bold">Our Cars</h2>
            <p class="text-light opacity-75 mx-auto" style="max-width:560px;">Browse our selection of premium vehicles — comfort, style and reliability for every journey.</p>
        </div>

        <div id="carSlider" class="carousel slide d-none d-md-block">
            <div class="carousel-inner">
                @foreach($cars->chunk(3) as $chunk)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <div class="row g-4">
                        @foreach($chunk as $car)
                        <div class="col-md-4">
                            @include('components.partials.car-card', ['car' => $car, 'currencySymbol' => $currencySymbol])
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carSlider" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bg-dark rounded-circle p-3" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carSlider" data-bs-slide="next">
                <span class="carousel-control-next-icon bg-dark rounded-circle p-3" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <div id="carSliderMobile" class="carousel slide d-block d-md-none">
            <div class="carousel-inner">
                @foreach($cars as $car)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <div class="mx-3">
                        @include('components.partials.car-card', ['car' => $car, 'currencySymbol' => $currencySymbol])
                    </div>
                </div>
                @endforeach
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carSliderMobile" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bg-dark rounded-circle p-3" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carSliderMobile" data-bs-slide="next">
                <span class="carousel-control-next-icon bg-dark rounded-circle p-3" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

    </div>
</section>
@else
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">No Cars Available</h2>
        </div>
    </div>
</section>
@endif
