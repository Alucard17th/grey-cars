<!-- Why Choose Us Section -->
<section class="py-5 about-modern">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-eyebrow">Why Choose Us</span>
            <h2 class="fw-bold text-white">Your Trusted Car Rental Partner</h2>
            <p class="text-light opacity-75 mx-auto" style="max-width:600px;">Locally rooted, internationally minded — discover Morocco with a partner who knows every road.</p>
        </div>

        @php
            $perks = [
                ['icon' => 'bi-shield-check', 'title' => 'Safety First', 'text' => 'All vehicles undergo rigorous maintenance checks to ensure your safety on Morocco\'s diverse roads.'],
                ['icon' => 'bi-geo-alt-fill', 'title' => 'Strategic Location', 'text' => 'Conveniently located in Agadir with easy access to airports, hotels, and major attractions.'],
                ['icon' => 'bi-translate', 'title' => 'Multilingual Support', 'text' => 'Our team speaks English, French, and Arabic to serve international travelers seamlessly.'],
                ['icon' => 'bi-arrow-repeat', 'title' => 'Flexible Rental Plans', 'text' => 'Daily, weekly, or monthly rentals with transparent pricing and no hidden fees.'],
            ];
        @endphp

        <div class="row g-4 mb-5">
            @foreach($perks as $i => $perk)
            <div class="col-md-6 col-lg-3">
                <div class="perk-card">
                    <div class="perk-card-num">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</div>
                    <div class="perk-card-icon"><i class="bi {{ $perk['icon'] }}"></i></div>
                    <h3 class="perk-card-title">{{ $perk['title'] }}</h3>
                    <p class="perk-card-text">{{ $perk['text'] }}</p>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Local Expertise Section -->
        <div class="local-expertise">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="pe-lg-4">
                        <span class="section-eyebrow">Local Expertise</span>
                        <h2 class="fw-bold text-white mb-3">Built for Your Moroccan Adventure</h2>
                        <p class="text-light opacity-75 mb-4">As a locally-owned company, we provide insider tips and recommendations to help you discover Agadir and beyond like a true local.</p>

                        <ul class="expertise-list">
                            <li>
                                <span class="expertise-check"><i class="bi bi-check-lg"></i></span>
                                <span>Detailed maps and suggested itineraries</span>
                            </li>
                            <li>
                                <span class="expertise-check"><i class="bi bi-check-lg"></i></span>
                                <span>24/7 roadside assistance throughout Morocco</span>
                            </li>
                            <li>
                                <span class="expertise-check"><i class="bi bi-check-lg"></i></span>
                                <span>Knowledge of best routes and hidden gems</span>
                            </li>
                            <li>
                                <span class="expertise-check"><i class="bi bi-check-lg"></i></span>
                                <span>Assistance with local customs and regulations</span>
                            </li>
                        </ul>

                        <div class="d-flex flex-wrap gap-3 mt-4">
                            <a href="{{ route('cars.index') }}" class="btn btn-primary expertise-cta">
                                <i class="bi bi-car-front-fill me-2"></i>Browse Fleet
                            </a>
                            <a href="{{ route('contact') }}" class="btn btn-outline-light expertise-cta">
                                Contact Us <i class="bi bi-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="expertise-media">
                        <img src="{{ asset('images/about-us-2.jpg') }}" alt="Exploring Morocco with Grey Cars Rental">
                        <div class="expertise-floating-card">
                            <div class="expertise-floating-icon"><i class="bi bi-people-fill"></i></div>
                            <div>
                                <strong>1000+</strong>
                                <span>Satisfied Customers</span>
                            </div>
                        </div>
                        <div class="expertise-floating-rating">
                            <div class="stars">
                                @for($i = 0; $i < 5; $i++)<i class="bi bi-star-fill"></i>@endfor
                            </div>
                            <strong>4.9 / 5</strong>
                            <span>Avg. customer rating</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
