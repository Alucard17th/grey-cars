@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Item Details: {{ $item->name }}</span>
                    <div>
                        <a href="{{ route('items.edit', $item->id) }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('items.index') }}" class="btn btn-sm btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-4 text-center">
                            @if($item->image_url)
                            <img src="{{ $item->image_url }}" alt="{{ $item->name }}" class="img-fluid rounded"
                                style="max-height: 200px;">
                            @else
                            <div class="bg-light p-5 text-center">
                                No Image Available
                            </div>
                            @endif
                        </div>
                        <div class="col-md-8">
                            <h3>{{ $item->name }}</h3>
                            <p class="text-muted">{{ $item->year }} • {{ $item->color }}</p>
                            <hr>
                            <div class="row">
                                <div class="col-6">
                                    <p><strong>Price Per Day:</strong> ${{ number_format($item->price_per_day, 2) }}</p>
                                    @if($item->security_deposit_per_day)
                                    <p><strong>Daily Deposit:</strong>
                                        ${{ number_format($item->security_deposit_per_day, 2) }}</p>
                                    @endif
                                </div>
                                <div class="col-6">
                                    @if($item->security_deposit_fixed)
                                    <p><strong>Fixed Deposit:</strong>
                                        ${{ number_format($item->security_deposit_fixed, 2) }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($item->options)
                    <div class="mb-4">
                        <h5>Options</h5>
                        <div class="card">
                            <div class="card-body">
                                <pre>{{ json_encode($item->options, JSON_PRETTY_PRINT) }}</pre>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($item->extras)
                    <div class="mb-4">
                        <h5>Extras</h5>
                        <div class="card">
                            <div class="card-body">
                                <pre>{{ json_encode($item->extras, JSON_PRETTY_PRINT) }}</pre>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-6">
                            <small class="text-muted">Created: {{ $item->created_at->format('M d, Y H:i') }}</small>
                        </div>
                        <div class="col-6 text-end">
                            <small class="text-muted">Updated: {{ $item->updated_at->format('M d, Y H:i') }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection