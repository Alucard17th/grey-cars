@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2 class="mb-3">Cars</h2>
    <a href="{{ route('admin.cars.create') }}" class="btn btn-primary mb-3">+ New</a>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <table class="table table-striped align-middle">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Year</th>
                <th>Color</th>
                <th>Price/Day</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cars as $car)
            <tr>
                <td>{{ $car->id }}</td>
                <td>
                    <img src="{{ $car->image_url }}" class="img-fluid rounded" alt="{{ $car->name }}" width="75"
                        height="75">
                    {{ $car->name }}
                </td>
                <td>{{ $car->year }}</td>
                <td>{{ $car->color }}</td>
                <td>{{ number_format($car->price_per_day, 2) }}{{ config('rental.currency_symbol', '€') }}</td>
                <td>
                    <a href="{{ route('admin.cars.show', $car->id) }}" class="btn btn-sm btn-outline-secondary">
                        View
                    </a>
                    <a href="{{ route('admin.cars.edit', $car->id) }}" class="btn btn-sm btn-outline-primary">
                        Edit
                    </a>
                    <form action="{{ route('admin.cars.destroy', $car->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">
                            Del
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $cars->links('pagination::bootstrap-5') }}
</div>
@endsection