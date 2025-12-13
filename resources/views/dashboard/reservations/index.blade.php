@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2 class="mb-3">Reservations</h2>
    <a href="{{ route('admin.reservations.create') }}" class="btn btn-primary mb-3">+ New</a>

    <table class="table table-striped align-middle">
        <thead>
            <tr>
                <th>#</th><th>Car</th><th>Customer</th><th>Dates</th>
                <th>Total</th><th>Status</th><th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($reservations as $r)
            <tr>
                <td>{{ $r->id }}</td>
                <td>{{ $r->car->name }}</td>
                <td>{{ $r->customer_name }}</td>
                <td>{{ $r->pickup_date->format('d M') }} – {{ $r->dropoff_date->format('d M') }}</td>
                <td>{{ number_format($r->total_price,2) }}{{ config('rental.currency_symbol', '€') }}</td>
                <td><span class="badge bg-info">{{ $r->status }}</span></td>
                <td class="text-end">
                    <a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.reservations.show',$r) }}">View</a>
                    <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.reservations.edit',$r) }}">Edit</a>
                    <form action="{{ route('admin.reservations.destroy',$r) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('Delete?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger">Del</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $reservations->links('pagination::bootstrap-5') }}
</div>
@endsection
