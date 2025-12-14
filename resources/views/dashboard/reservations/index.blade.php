@extends('layouts.dashboard')

@section('content')
<div class="dash-card">
    <div class="dash-card-header">
        <div class="d-flex align-items-center gap-2">
            <div class="text-primary"><i class="bi bi-receipt fs-5"></i></div>
            <div>
                <div class="fw-semibold">Reservations</div>
                <div class="small text-muted">Track bookings and customers</div>
            </div>
        </div>

        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('admin.reservations.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg me-1"></i>New reservation
            </a>
        </div>
    </div>

    <div class="dash-card-body">
        <div class="table-responsive">
            <table class="table dash-table align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width: 90px">#</th>
                        <th>Car</th>
                        <th>Customer</th>
                        <th style="width: 210px">Dates</th>
                        <th style="width: 140px">Total</th>
                        <th style="width: 140px">Status</th>
                        <th class="text-end" style="width: 200px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reservations as $r)
                        @php
                            $status = strtolower($r->status ?? '');
                            $badgeClass = 'bg-secondary';
                            if ($status === 'confirmed') $badgeClass = 'bg-success';
                            if ($status === 'pending') $badgeClass = 'bg-warning text-dark';
                            if ($status === 'cancelled') $badgeClass = 'bg-danger';
                        @endphp
                        <tr>
                            <td class="text-muted">#{{ $r->id }}</td>
                            <td class="fw-semibold">{{ $r->car->name }}</td>
                            <td>
                                <div class="fw-semibold">{{ $r->customer_name }}</div>
                                <div class="small text-muted">{{ $r->customer_email }}</div>
                            </td>
                            <td>
                                <div class="fw-semibold">{{ $r->pickup_date->format('d M') }} – {{ $r->dropoff_date->format('d M') }}</div>
                                <div class="small text-muted">{{ $r->days }} {{ Str::plural('day', $r->days) }}</div>
                            </td>
                            <td class="fw-semibold">
                                {{ number_format($r->total_price,2) }}{{ config('rental.currency_symbol', '€') }}
                            </td>
                            <td>
                                <span class="badge {{ $badgeClass }}">{{ ucfirst($r->status) }}</span>
                            </td>
                            <td class="text-end">
                                <a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.reservations.show',$r) }}">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.reservations.edit',$r) }}">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <a class="btn btn-sm btn-outline-dark" href="{{ route('admin.reservations.print',$r) }}" target="_blank">
                                    <i class="bi bi-printer"></i>
                                </a>
                                <form action="{{ route('admin.reservations.destroy',$r) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Delete?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div class="text-muted mb-2"><i class="bi bi-receipt fs-2"></i></div>
                                <div class="fw-semibold">No reservations yet</div>
                                <div class="text-muted small">Create your first booking to get started.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $reservations->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
