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

    <!-- Main Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ url('/') }}"><img class="img-fluid"
                    src="{{ asset('images/logo.png') }}" style="width:200px;"
                    alt="{{ config('app.name', 'Laravel') }}"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link @if (request()->routeIs('home')) text-primary @endif" href="{{route('home')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (request()->routeIs('about')) text-primary @endif" href="{{route('about')}}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (request()->routeIs('cars.index')) text-primary @endif" href="{{route('cars.index')}}">Our Cars</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (request()->routeIs('contact')) text-primary @endif" href="{{route('contact')}}">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="bg-black">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white pt-5 pb-3">
        <div class="container">
            <div class="row g-4">
                <!-- Company Info -->
                <div class="col-lg-4 col-md-6">
                    <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name', 'Laravel') }}" class="img-fluid mb-3">
                    <h5 class="text-uppercase mb-4" style="font-family: 'Oswald', sans-serif;">{{ config('app.name', 'Laravel') }}</h5>
                    <p>Premium vehicle solutions for discerning clients. Experience the road in unparalleled style and
                        comfort.</p>
                    <div class="mt-4">
                        <a href="{{ config('company.contact.facebook') }}" class="text-white me-3"><i class="bi bi-facebook"></i></a>
                        <a href="{{ config('company.contact.instagram') }}" class="text-white me-3"><i class="bi bi-instagram"></i></a>
                        <a href="{{ config('company.contact.twitter') }}" class="text-white me-3"><i class="bi bi-twitter-x"></i></a>
                        <a href="{{ config('company.contact.linkedin') }}" class="text-white"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="col-lg-4 col-md-6">
                    <h5 class="text-uppercase mb-4" style="font-family: 'Oswald', sans-serif;">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('home') }}" class="text-white text-decoration-none">Home</a></li>
                        <li class="mb-2"><a href="{{ route('cars.index') }}" class="text-white text-decoration-none">Our Cars</a></li>
                        <li class="mb-2"><a href="{{ route('about') }}" class="text-white text-decoration-none">About Us</a></li>
                        <li class="mb-2"><a href="{{ route('terms-and-conditions') }}" class="text-white text-decoration-none">Terms and Conditions</a></li>
                        <li class="mb-2"><a href="{{ route('contact') }}" class="text-white text-decoration-none">Contact</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div class="col-lg-4 col-md-6">
                    <h5 class="text-uppercase mb-4" style="font-family: 'Oswald', sans-serif;">Contact Us</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="bi bi-geo-alt-fill me-2"></i> {{ config('company.contact.address') }}</li>
                        <li class="mb-2"><i class="bi bi-telephone-fill me-2"></i> {{ config('company.contact.phone') }}</li>
                        <li class="mb-2"><i class="bi bi-envelope-fill me-2"></i> {{ config('company.contact.email') }}</li>
                        <li class="mb-2"><i class="bi bi-clock-fill me-2"></i> {{ config('company.contact.hours') }}</li>
                    </ul>
                </div>
            </div>

            <hr class="my-4 bg-secondary">

            <!-- Copyright -->
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0">&copy; {{ date('Y') }} Luxury Car Rentals. All rights reserved.</p>
                </div>
                <!-- <div class="col-md-6 text-center text-md-end">
                    <a href="#" class="text-white text-decoration-none me-3">Privacy Policy</a>
                    <a href="#" class="text-white text-decoration-none me-3">Terms of Service</a>
                    <a href="#" class="text-white text-decoration-none">FAQ</a>
                </div> -->
            </div>
        </div>
    </footer>
</body>

</html>