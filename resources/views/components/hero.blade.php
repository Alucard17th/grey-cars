<section class="hero-slider">
    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
        </div>

        <div class="carousel-inner">
            <!-- Slide 1 -->
            <div class="carousel-item active" style="background-image: url('{{ asset('images/slider/car-cards.png') }}');">
                <div class="carousel-overlay"></div>
                <div class="container">
                    <div class="row align-items-center py-5">
                        <div class="col-lg-6 order-lg-1 order-2 text-white pt-5 mt-5 ps-5">
                            <h1 class="display-4 fw-bold mb-4 text-uppercase">Affordable Car Rentals</h1>
                            <p class="lead mb-4">Get the best value for your trip with transparent pricing, flexible
                                options, and top-notch service you can trust.
                            </p>
                            <a href="{{ route('cars.index') }}" class="btn btn-primary btn-lg px-4 me-2">Learn More</a>
                            <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg px-4">Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="carousel-item" style="background-image: url('{{ asset('images/slider/black-car.png') }}');">
                <div class="carousel-overlay"></div>
                <div class="container">
                    <div class="row align-items-center py-5">
                        <div class="col-lg-6 order-lg-1 order-2 text-white pt-5 mt-5 ps-5">
                            <h1 class="display-4 fw-bold mb-4 text-uppercase">Export Agadir with Comfort and Style</h1>
                            <p class="lead mb-4">Choose for a wide range of reliable rental cars and enjoy a smooth,
                                stress-free journey from the hearth of Agadir.
                            </p>
                            <a href="{{ route('cars.index') }}" class="btn btn-primary btn-lg px-4 me-2">Our Cars</a>
                            <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg px-4">Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="carousel-item" style="background-image: url('{{ asset('images/slider/morocco-car.jpg') }}'); background-position:bottom !important;">
                <div class="carousel-overlay"></div>
                <div class="container">
                    <div class="row align-items-center py-5">
                        <div class="col-lg-6 order-lg-1 order-2 text-white pt-5 mt-5 ps-5">
                            <h1 class="display-4 fw-bold mb-4 text-uppercase">Airport Pickup & Drop-off Made Easy</h1>
                            <p class="lead mb-4">Land and drive with ease - our convenient airport service gets your on 
                                the road without delays or complications.
                            </p>
                            <a href="{{ route('cars.index') }}" class="btn btn-primary btn-lg px-4 me-2">View Cars</a>
                            <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg px-4">Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>
