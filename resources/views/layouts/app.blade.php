<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fav Icon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo.png') }}">


    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <!-- Top Header -->
    <!-- <header class="bg-dark text-white py-2">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="d-flex gap-3">
                        <span><i class="bi bi-envelope me-2"></i> contact@example.com</span>
                        <span><i class="bi bi-phone me-2"></i> +1 234 567 890</span>
                    </div>
                </div>
                <div class="col-md-6 text-md-end">
                    <div class="d-flex gap-3 justify-content-md-end">
                        <a href="#" class="text-white"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="text-white"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="text-white"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="text-white"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </header> -->

    <!-- Top Bar -->
    <div class="top-bar d-none d-lg-block">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="top-bar-info">
                <span><i class="bi bi-geo-alt-fill"></i> {{ config('company.contact.address') }}</span>
                <span><i class="bi bi-clock-fill"></i> {{ config('company.contact.hours') }}</span>
            </div>
            <div class="top-bar-social">
                <a href="{{ config('company.contact.facebook') }}" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                <a href="{{ config('company.contact.instagram') }}" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                <a href="{{ config('company.contact.twitter') }}" aria-label="X"><i class="bi bi-twitter-x"></i></a>
                <a href="{{ config('company.contact.linkedin') }}" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
            </div>
        </div>
    </div>

    <!-- Main Navigation -->
    <nav class="navbar navbar-expand-lg navbar-modern sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name', 'Laravel') }}">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-label="Toggle navigation">
                <span class="navbar-toggler-bar"></span>
                <span class="navbar-toggler-bar"></span>
                <span class="navbar-toggler-bar"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link @if (request()->routeIs('home')) active @endif" href="{{route('home')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (request()->routeIs('about')) active @endif" href="{{route('about')}}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (request()->routeIs('cars.index')) active @endif" href="{{route('cars.index')}}">Our Cars</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (request()->routeIs('contact')) active @endif" href="{{route('contact')}}">Contact</a>
                    </li>
                </ul>
                <div class="navbar-actions">
                    <a href="tel:{{ config('company.contact.phone') }}" class="navbar-phone">
                        <span class="navbar-phone-icon"><i class="bi bi-telephone-fill"></i></span>
                        <span class="navbar-phone-text">
                            <small>Call us anytime</small>
                            <strong>{{ config('company.contact.phone') }}</strong>
                        </span>
                    </a>
                    <a href="{{ route('cars.index') }}" class="btn btn-primary navbar-cta">
                        <i class="bi bi-car-front-fill me-1"></i> Book Now
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="bg-black">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer-modern">
        <!-- CTA strip -->
        <div class="footer-cta">
            <div class="container">
                <div class="footer-cta-inner">
                    <div>
                        <h3 class="mb-1">Ready to hit the road?</h3>
                        <p class="mb-0 opacity-75">Book your perfect ride in minutes — pickup at the airport or anywhere in Agadir.</p>
                    </div>
                    <a href="{{ route('cars.index') }}" class="btn btn-light footer-cta-btn">
                        <i class="bi bi-car-front-fill me-2"></i>Browse Fleet
                        <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="footer-main">
            <div class="container">
                <div class="row g-5">
                    <!-- Brand -->
                    <div class="col-lg-4 col-md-6">
                        <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name', 'Laravel') }}" class="footer-logo mb-3">
                        <p class="footer-text">Premium vehicle solutions for discerning clients. Experience the road in unparalleled style and comfort.</p>

                        <div class="footer-socials">
                            <a href="{{ config('company.contact.facebook') }}" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                            <a href="{{ config('company.contact.instagram') }}" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                            <a href="{{ config('company.contact.twitter') }}" aria-label="X"><i class="bi bi-twitter-x"></i></a>
                            <a href="{{ config('company.contact.linkedin') }}" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div class="col-lg-3 col-md-6">
                        <h6 class="footer-heading">Quick Links</h6>
                        <ul class="footer-links">
                            <li><a href="{{ route('home') }}"><i class="bi bi-chevron-right"></i> Home</a></li>
                            <li><a href="{{ route('cars.index') }}"><i class="bi bi-chevron-right"></i> Our Cars</a></li>
                            <li><a href="{{ route('about') }}"><i class="bi bi-chevron-right"></i> About Us</a></li>
                            <li><a href="{{ route('terms-and-conditions') }}"><i class="bi bi-chevron-right"></i> Terms &amp; Conditions</a></li>
                            <li><a href="{{ route('contact') }}"><i class="bi bi-chevron-right"></i> Contact</a></li>
                        </ul>
                    </div>

                    <!-- Contact -->
                    <div class="col-lg-5 col-md-6">
                        <h6 class="footer-heading">Get in Touch</h6>
                        <ul class="footer-contact">
                            <li>
                                <span class="footer-contact-icon"><i class="bi bi-geo-alt-fill"></i></span>
                                <span>{{ config('company.contact.address') }}</span>
                            </li>
                            <li>
                                <a href="tel:{{ config('company.contact.phone') }}">
                                    <span class="footer-contact-icon"><i class="bi bi-telephone-fill"></i></span>
                                    <span>{{ config('company.contact.phone') }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="mailto:{{ config('company.contact.email') }}">
                                    <span class="footer-contact-icon"><i class="bi bi-envelope-fill"></i></span>
                                    <span>{{ config('company.contact.email') }}</span>
                                </a>
                            </li>
                            <li>
                                <span class="footer-contact-icon"><i class="bi bi-clock-fill"></i></span>
                                <span>{{ config('company.contact.hours') }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container text-center">
                <p class="mb-0 small">&copy; {{ date('Y') }} {{ config('app.name', 'Grey Cars') }}. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>

</html>