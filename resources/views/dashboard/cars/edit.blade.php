@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Item: {{ $car->name }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.cars.update', $car->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Name -->
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Name*</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name', $car->name) }}" required>
                                @error('name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <!-- Year -->
                        <div class="row mb-3">
                            <label for="year" class="col-md-4 col-form-label text-md-end">Year*</label>
                            <div class="col-md-6">
                                <input id="year" type="number" class="form-control @error('year') is-invalid @enderror"
                                    name="year" value="{{ old('year', $car->year) }}" required>
                                @error('year')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <!-- Color -->
                        <div class="row mb-3">
                            <label for="color" class="col-md-4 col-form-label text-md-end">Color*</label>
                            <div class="col-md-6">
                                <input id="color" type="color" class="form-control @error('color') is-invalid @enderror"
                                    name="color" value="{{ old('color', $car->color) }}" required>
                                @error('color')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <!-- Price Per Day -->
                        <div class="row mb-3">
                            <label for="price_per_day" class="col-md-4 col-form-label text-md-end">Price Per
                                Day*</label>
                            <div class="col-md-6">
                                <input id="price_per_day" type="number" step="0.01"
                                    class="form-control @error('price_per_day') is-invalid @enderror"
                                    name="price_per_day" value="{{ old('price_per_day', $car->price_per_day) }}"
                                    required>
                                @error('price_per_day')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <!-- Security Deposit Per Day -->
                        <div class="row mb-3">
                            <label for="security_deposit_per_day" class="col-md-4 col-form-label text-md-end">
                                Security Deposit (Daily)
                            </label>
                            <div class="col-md-6">
                                <input id="security_deposit_per_day" type="number" step="0.01"
                                    class="form-control @error('security_deposit_per_day') is-invalid @enderror"
                                    name="security_deposit_per_day"
                                    value="{{ old('security_deposit_per_day', $car->security_deposit_per_day) }}">
                                @error('security_deposit_per_day')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <!-- Security Deposit Fixed -->
                        <div class="row mb-3">
                            <label for="security_deposit_fixed" class="col-md-4 col-form-label text-md-end">
                                Security Deposit (Fixed)
                            </label>
                            <div class="col-md-6">
                                <input id="security_deposit_fixed" type="number" step="0.01"
                                    class="form-control @error('security_deposit_fixed') is-invalid @enderror"
                                    name="security_deposit_fixed"
                                    value="{{ old('security_deposit_fixed', $car->security_deposit_fixed) }}">
                                @error('security_deposit_fixed')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3 d-flex align-items-center">
                            <label for="is_security_deposit_fix" class="col-md-4 col-form-label text-md-end">Fixed Only</label>
                            <div class="col-md-6">
                                <input id="is_security_deposit_fix" type="checkbox"
                                    class="border-3 border-primary form-check-input @error('is_security_deposit_fix') is-invalid @enderror"
                                    name="is_security_deposit_fix" value="{{ old('is_security_deposit_fix', $car->is_security_deposit_fix) }}"
                                    {{ old('is_security_deposit_fix', $car->is_security_deposit_fix) ? 'checked' : '' }}>
                                @error('is_security_deposit_fix')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Image -->
                        <div class="row mb-3">
                            <label for="image" class="col-md-4 col-form-label text-md-end">Image</label>
                            <div class="col-md-6">
                                @if($car->image_url)
                                <div class="mb-2">
                                    <img src="{{ $car->image_url }}" alt="Current image" class="img-thumbnail"
                                        style="max-height: 100px;">
                                </div>
                                @endif
                                <input id="image" type="file" class="form-control @error('image') is-invalid @enderror"
                                    name="image">
                                @error('image')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <!-- Options -->
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">Options</label>
                            <div class="col-md-8">
                                <div id="options-container">
                                    @php $optionCounter = 1; @endphp
                                    @foreach($car->options ?? [] as $key => $value)
                                    <div class="option-item row mb-2 align-items-center">
                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <input type="hidden" name="options_keys[]"
                                                    value="option_{{ $optionCounter }}">
                                                <span class="input-group-text">Option {{ $optionCounter }}</span>
                                                <input type="text" name="options_values[]" class="form-control"
                                                    value="{{ $value }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <button type="button"
                                                class="btn btn-danger btn-sm remove-option">Remove</button>
                                        </div>
                                    </div>
                                    @php $optionCounter++; @endphp
                                    @endforeach
                                </div>
                                <button type="button" id="add-option" class="btn btn-sm btn-primary mt-2">Add
                                    Option</button>
                            </div>
                        </div>

                        <!-- Extras -->
                        <!-- Extras Section -->
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">Extras</label>
                            <div class="col-md-8">
                                <div id="extras-container">
                                    @php $extraCounter = 1; @endphp
                                    @foreach($car->extras ?? [] as $key => $value)
                                    <div class="extra-item row mb-2 align-items-center">
                                        <div class="col-md-5">
                                            <input type="text" name="extras_keys[]" class="form-control"
                                                value="{{ $key }}" placeholder="Extra name">
                                        </div>
                                        <div class="col-md-5">
                                            <input type="text" name="extras_values[]" class="form-control"
                                                value="{{ $value }}" placeholder="Extra value">
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button"
                                                class="btn btn-danger btn-sm remove-extra">Remove</button>
                                        </div>
                                    </div>
                                    @php $extraCounter++; @endphp
                                    @endforeach
                                </div>
                                <button type="button" id="add-extra" class="btn btn-sm btn-primary mt-2">Add
                                    Extra</button>
                            </div>
                        </div>


                        <!-- Submit -->
                        <div class="row mb-0 mt-5">
                            <div class="col-md-6 offset-md-1">
                                <button type="submit" class="btn btn-success">Update Car</button>
                                <a href="{{ route('admin.cars.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
let optionCounter = {
    {
        $optionCounter ?? 1
    }
};
let extraCounter = {
    {
        $extraCounter ?? 1
    }
};

document.getElementById('add-option').addEventListener('click', function() {
    optionCounter++;
    const container = document.getElementById('options-container');
    const newItem = document.createElement('div');
    newItem.className = 'option-item row mb-2 align-items-center';
    newItem.innerHTML = `
            <div class="col-md-8">
                <div class="input-group">
                    <input type="hidden" name="options_keys[]" value="option_${optionCounter}">
                    <span class="input-group-text">Option ${optionCounter}</span>
                    <input type="text" name="options_values[]" class="form-control">
                </div>
            </div>
            <div class="col-md-4">
                <button type="button" class="btn btn-danger btn-sm remove-option">Remove</button>
            </div>
        `;
    container.appendChild(newItem);
});

document.getElementById('add-extra').addEventListener('click', function() {
    extraCounter++;
    const container = document.getElementById('extras-container');
    const newItem = document.createElement('div');
    newItem.className = 'extra-item row mb-2 align-items-center';
    newItem.innerHTML = `
            <div class="col-md-5">
                <input type="text" name="extras_keys[]" class="form-control" placeholder="Extra name">
            </div>
            <div class="col-md-5">
                <input type="text" name="extras_values[]" class="form-control" placeholder="Extra value">
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger btn-sm remove-extra">Remove</button>
            </div>
        `;
    container.appendChild(newItem);
});

document.addEventListener('click', function(e) {
    if (e.target.classList.contains('remove-option')) {
        e.target.closest('.option-item').remove();
    }
    if (e.target.classList.contains('remove-extra')) {
        e.target.closest('.extra-item').remove();
    }
});
</script>
@endpush