@if($cars->count() > 0)
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5 text-white">
            <h2 class="fw-bold">OUR CARS</h2>
            <p class="lead text-white">Browse our selection of premium vehicles</p>
        </div>

        <div id="carSlider" class="carousel slide d-none d-md-block">
            <div class="carousel-inner">
                @foreach($cars->chunk(3) as $chunk)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <div class="row g-4">
                        @foreach($chunk as $car)
                        <div class="col-md-4">
                            <div class="card h-100 shadow-sm border-0 overflow-hidden">
                                <div class="" style="height: 200px; overflow: hidden; position: relative !important;">
                                    <img src="{{ $car->image_url }}" class="card-img-top h-100 object-fit-cover"
                                        alt="{{ $car->name }}">
                                    <div
                                        class="position-absolute top-0 end-0 bg-primary text-white px-2 py-1 m-2 rounded">
                                        ${{ number_format($car->price_per_day, 2) }}/day
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $car->name }}  <span class="text-muted fs-6">(or similar)</span></h5>
                                    <p class="text-muted">{{ $car->year }}</p>

                                    @if($car->options && count($car->options) > 0)
                                    <h4 class="h6">Features:</h4>
                                    <div class="d-flex flex-wrap gap-2 mb-3">
                                        @foreach($car->options as $option)
                                        <span class="badge bg-black p-2">{{ $option }}</span>
                                        @endforeach
                                    </div>
                                    @endif
                                    @if($car->extras && count($car->extras) > 0)
                                    <h4 class="h6">Extras:</h4>
                                    <div class="d-flex flex-wrap gap-2 mb-3">
                                        @foreach($car->extras as $extra => $price)
                                        <span class="badge bg-black p-2">{{ $extra }} (${{ $price }})</span>
                                        @endforeach
                                    </div>
                                    @endif
                                </div>
                                <div class="card-footer bg-white border-0">
                                    <div class="d-grid">
                                        <a href="#" class="btn btn-primary book-now-btn" data-car-id="{{ $car->id }}"
                                            data-bs-toggle="modal" data-bs-target="#bookingModal">Book Now</a>
                                    </div>
                                </div>
                            </div>
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
                    <div class="card h-100 shadow-sm border-0 overflow-hidden mx-3">
                        <div class="" style="height: 200px; overflow: hidden; position: relative !important;">
                            <img src="{{ $car->image_url }}" class="card-img-top h-100 object-fit-cover"
                                alt="{{ $car->name }}">
                            <div class="position-absolute top-0 end-0 bg-primary text-white px-2 py-1 m-2 rounded">
                                ${{ number_format($car->price_per_day, 2) }}/day
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $car->name }}</h5>
                            <p class="text-muted">{{ $car->year }} • <span
                                    style="color: {{ $car->color }}">{{ $car->color }}</span></p>
                            @if($car->options && count($car->options) > 0)
                            <div class="d-flex flex-wrap gap-2 mb-3">
                                @foreach($car->options as $option)
                                <span class="badge bg-black p-2">{{ $option }}</span>
                                @endforeach
                            </div>
                            @endif
                        </div>
                        <div class="card-footer bg-white border-0">
                            <div class="d-grid">
                                <a href="#" class="btn btn-primary book-now-btn" data-car-id="{{ $car->id }}"
                                    data-bs-toggle="modal" data-bs-target="#bookingModal">Book Now</a>
                            </div>
                        </div>
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