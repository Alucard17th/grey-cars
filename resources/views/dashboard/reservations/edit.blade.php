@extends('layouts.dashboard')
@section('content')
<div class="dash-card">
    <div class="dash-card-header">
        <div class="d-flex align-items-center gap-2">
            <div class="text-primary"><i class="bi bi-pencil-square fs-5"></i></div>
            <div>
                <div class="fw-semibold">Edit reservation</div>
                <div class="small text-muted">#{{ $reservation->id }}</div>
            </div>
        </div>

        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('admin.reservations.show', $reservation) }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-eye"></i>
            </a>
            <a href="{{ route('admin.reservations.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left"></i>
            </a>
        </div>
    </div>

    <div class="dash-card-body">
        <form method="POST" action="{{ route('admin.reservations.update', $reservation) }}">
            @method('PUT')
            @include('dashboard.reservations._form')
            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check2-circle me-1"></i>Save changes
                </button>
                <a href="{{ route('admin.reservations.show', $reservation) }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
