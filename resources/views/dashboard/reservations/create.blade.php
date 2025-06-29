@extends('layouts.dashboard')
@section('content')
<div class="container">
    <h2>{{ isset($reservation)?'Edit':'New' }} Reservation</h2>
    <form method="POST"
          action="{{ isset($reservation) ? route('admin.reservations.update',$reservation) : route('admin.reservations.store') }}">
        @if(isset($reservation)) @method('PUT') @endif
        @include('dashboard.reservations._form')
    </form>
</div>
@endsection
