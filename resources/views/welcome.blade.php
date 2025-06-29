@extends('layouts.app')

@section('content')

    <!-- Hero Slider -->
    @include('components.hero')

    <!-- Search Car Section -->
    @include('components.searchcar')

    <!-- Find Us Section -->
    @include('components.findus')

    <!-- Car Slider -->
    @include('components.carslider')

    <!-- Car Search Modal -->
    @include('components.searchCarModal')

    <!-- About Us Section -->
    @include('components.about')

    <!-- How It Works Section -->
    @include('components.howitworks')

    <!-- Why Choose Us Section -->
    @include('components.whychooseus')

    <!-- Statistics Section -->
    @include('components.statistics')

    <!-- Testimonials Section with Trustindex -->
    @include('components.testimonials')

    <!-- Location Section -->
    @include('components.map')

    <!-- Whatsapp Widget -->
    @include('components.whatsapp')

@endsection