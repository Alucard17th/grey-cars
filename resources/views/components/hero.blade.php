<section class="hero-slider">
    <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="6000">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
        </div>

        <div class="carousel-inner">
            <!-- Slide 1 -->
            <div class="carousel-item active" style="background-image: url('{{ asset('images/slider/car-cards.png') }}');">
                <div class="carousel-overlay"></div>
                <div class="container h-100">
                    <div class="row align-items-center hero-row">
                        <div class="col-lg-8 col-xl-7 text-white hero-content">
                            <span class="hero-eyebrow"><span class="dot"></span> Premium Car Rentals · Agadir</span>
                            <h1 class="hero-title">Drive Morocco <span class="hero-title-accent">Your Way</span></h1>
                            <p class="hero-lead">Get the best value for your trip with transparent pricing, flexible options, and top-notch service you can trust.</p>
                            <div class="hero-cta">
                                <a href="{{ route('cars.index') }}" class="btn btn-primary btn-lg">
                                    <i class="bi bi-car-front-fill me-2"></i>Browse Fleet
                                </a>
                                <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg">
                                    Contact Us <i class="bi bi-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="carousel-item" data-lazy-bg="{{ asset('images/slider/black-car.png') }}">
                <div class="carousel-overlay"></div>
                <div class="container h-100">
                    <div class="row align-items-center hero-row">
                        <div class="col-lg-8 col-xl-7 text-white hero-content">
                            <span class="hero-eyebrow"><span class="dot"></span> Comfort · Style · Reliability</span>
                            <h1 class="hero-title">Explore Agadir <span class="hero-title-accent">in Style</span></h1>
                            <p class="hero-lead">Choose from a wide range of reliable rental cars and enjoy a smooth, stress-free journey from the heart of Agadir.</p>
                            <div class="hero-cta">
                                <a href="{{ route('cars.index') }}" class="btn btn-primary btn-lg">
                                    <i class="bi bi-car-front-fill me-2"></i>Our Cars
                                </a>
                                <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg">
                                    Contact Us <i class="bi bi-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="carousel-item" data-lazy-bg="{{ asset('images/slider/morocco-car.jpg') }}" style="background-position:bottom !important;">
                <div class="carousel-overlay"></div>
                <div class="container h-100">
                    <div class="row align-items-center hero-row">
                        <div class="col-lg-8 col-xl-7 text-white hero-content">
                            <span class="hero-eyebrow"><span class="dot"></span> Airport Service</span>
                            <h1 class="hero-title">Land. Drive. <span class="hero-title-accent">Discover.</span></h1>
                            <p class="hero-lead">Our convenient airport pickup & drop-off service gets you on the road without delays or complications.</p>
                            <div class="hero-cta">
                                <a href="{{ route('cars.index') }}" class="btn btn-primary btn-lg">
                                    <i class="bi bi-car-front-fill me-2"></i>View Cars
                                </a>
                                <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg">
                                    Contact Us <i class="bi bi-arrow-right ms-2"></i>
                                </a>
                            </div>
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

        <!-- Floating trust strip -->
        <div class="hero-trust-strip d-none d-lg-flex">
            <div class="hero-trust-item">
                <i class="bi bi-star-fill"></i>
                <div>
                    <strong>4.9/5</strong>
                    <span>Customer Rating</span>
                </div>
            </div>
            <div class="hero-trust-divider"></div>
            <div class="hero-trust-item">
                <i class="bi bi-people-fill"></i>
                <div>
                    <strong>15k+</strong>
                    <span>Happy Travelers</span>
                </div>
            </div>
            <div class="hero-trust-divider"></div>
            <div class="hero-trust-item">
                <i class="bi bi-shield-check"></i>
                <div>
                    <strong>Fully Insured</strong>
                    <span>Drive Worry-Free</span>
                </div>
            </div>
            <div class="hero-trust-divider"></div>
            <div class="hero-trust-item">
                <i class="bi bi-headset"></i>
                <div>
                    <strong>24/7</strong>
                    <span>Support</span>
                </div>
            </div>
        </div>

        <script>
            // Lazy-load non-active slide background images after first paint
            window.addEventListener('load', () => {
                requestIdleCallback ? requestIdleCallback(loadLazyBgs) : setTimeout(loadLazyBgs, 200);
                function loadLazyBgs() {
                    document.querySelectorAll('[data-lazy-bg]').forEach(el => {
                        el.style.backgroundImage = `url('${el.dataset.lazyBg}')`;
                    });
                }
            });
        </script>

        <!-- Scroll indicator -->
        <a href="#bookingForm" class="hero-scroll d-none d-md-flex" aria-label="Scroll down">
            <span class="hero-scroll-line"></span>
            <span class="hero-scroll-text">Scroll</span>
        </a>
    </div>
</section>
