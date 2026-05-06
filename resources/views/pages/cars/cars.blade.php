@extends('layouts.app')

@section('content')
<!-- Breadcrumb -->
@include('components.breadcrumb', [
'title' => 'Our Cars',
'subtitle' => 'Quality You Can Feel, Convenience You Deserve',
'bgImage' => asset('img/hero.jpg'),
'breadcrumbs' => [
['label' => 'Home', 'url' => route('home')],
['label' => 'Our Cars']
]
])
<style>
.cars-pagination > nav > div > div > p {
    color: #ffffff !important;
}
.cars-pagination .page-link {
    background-color: transparent;
    border-color: rgba(255,255,255,0.1);
    color: #fff;
}
.cars-pagination .page-item.active .page-link {
    background-color: #e20305;
    border-color: #e20305;
}
</style>
@php
    $currencySymbol = config('company.currency_symbol', '€');
@endphp
<div class="container py-5">
    <div class="row g-4">
        @foreach($cars as $car)
        <div class="col-md-6 col-lg-4">
            @include('components.partials.car-card', ['car' => $car, 'currencySymbol' => $currencySymbol])
        </div>
        @endforeach
    </div>

    <div class="mt-4 cars-pagination">
        {{ $cars->links('pagination::bootstrap-5') }}
    </div>

    @include('components.searchCarModal')
</div>
@endsection
