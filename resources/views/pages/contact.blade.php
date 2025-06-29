@extends('layouts.app')

@section('content')

    <!-- Breadcrumb -->
    @include('components.breadcrumb', [
        'title'       => 'Contact Us',
        'subtitle'    => 'Quality You Can Feel, Convenience You Deserve',
        'bgImage'     => asset('img/hero.jpg'),
        'breadcrumbs' => [
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Contact Us']
        ]
    ])

    <!-- Location Section -->
    @include('components.map')

    <!-- Whatsapp Widget -->
    @include('components.whatsapp')

@endsection