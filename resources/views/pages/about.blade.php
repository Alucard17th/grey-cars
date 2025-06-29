@extends('layouts.app')

@section('content')

    <!-- Breadcrumb -->
    @include('components.breadcrumb', [
        'title'       => 'Who We Are',
        'subtitle'    => 'Quality You Can Feel, Convenience You Deserve',
        'bgImage'     => asset('img/hero.jpg'),
        'breadcrumbs' => [
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'About Us']
        ]
    ])

    <!-- About Us Section -->
    @include('components.about')

    <!-- About Us 2nd Section -->
    @include('components.about-2')

     <!-- About Us 3rd Section -->
    @include('components.about-3')

    <!-- Statistics Section -->
    @include('components.statistics')

    <!-- Testimonials Section with Trustindex -->
    @include('components.testimonials')

    <!-- Location Section -->
    @include('components.map')

    <!-- Whatsapp Widget -->
    @include('components.whatsapp')

@endsection