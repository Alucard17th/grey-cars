@extends('layouts.dashboard')

@section('content')
<div class="dash-card">
    <div class="dash-card-header">
        <div class="d-flex align-items-center gap-2">
            <div class="text-primary"><i class="bi bi-car-front fs-5"></i></div>
            <div>
                <div class="fw-semibold">Cars</div>
                <div class="small text-muted">Manage your fleet</div>
            </div>
        </div>

        <div class="d-flex align-items-center gap-2">
            <form method="GET" action="{{ route('admin.cars.index') }}" class="d-none d-md-block">
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                        placeholder="Search cars...">
                    @if(request('search'))
                        <a class="btn btn-outline-secondary" href="{{ route('admin.cars.index') }}">Clear</a>
                    @endif
                </div>
            </form>

            <a href="{{ route('admin.cars.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg me-1"></i>New car
            </a>
        </div>
    </div>

    <div class="dash-card-body">
        <div class="d-md-none mb-3">
            <form method="GET" action="{{ route('admin.cars.index') }}">
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                        placeholder="Search cars...">
                    @if(request('search'))
                        <a class="btn btn-outline-secondary" href="{{ route('admin.cars.index') }}">Clear</a>
                    @endif
                </div>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table dash-table align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width: 80px">ID</th>
                        <th>Car</th>
                        <th style="width: 110px">Year</th>
                        <th style="width: 120px">Color</th>
                        <th style="width: 140px">Price/day</th>
                        <th class="text-end" style="width: 180px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($cars as $car)
                        <tr>
                            <td class="text-muted">#{{ $car->id }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <img src="{{ $car->image_url }}" class="rounded" alt="{{ $car->name }}" width="56" height="56" style="object-fit:cover;">
                                    <div>
                                        <div class="fw-semibold">{{ $car->name }}</div>
                                        <div class="small text-muted">
                                            {{ $car->is_security_deposit_fix ? 'Fixed deposit only' : 'Flexible deposit' }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $car->year }}</td>
                            <td>
                                <span class="d-inline-flex align-items-center gap-2">
                                    <span class="rounded-circle" style="width:10px;height:10px;background:{{ $car->color }}"></span>
                                    <span class="text-muted">{{ $car->color }}</span>
                                </span>
                            </td>
                            <td class="fw-semibold">
                                {{ number_format($car->price_per_day, 2) }}{{ config('rental.currency_symbol', '€') }}
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.cars.show', $car->id) }}" class="btn btn-sm btn-outline-secondary">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.cars.edit', $car->id) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('admin.cars.destroy', $car->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="text-muted mb-2"><i class="bi bi-car-front fs-2"></i></div>
                                <div class="fw-semibold">No cars found</div>
                                <div class="text-muted small">Try adjusting your search or create a new car.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $cars->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection