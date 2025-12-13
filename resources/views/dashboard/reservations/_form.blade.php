@csrf
@php($editing = isset($reservation))
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0 small">
            @foreach ($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="row g-3">
    {{-- ------------ CAR ------------- --}}
    <div class="col-md-4">
        <label class="form-label">Car *</label>
        <select class="form-select @error('car_id') is-invalid @enderror" name="car_id" required>
            @foreach($cars as $car)
                <option value="{{ $car->id }}"
                    @selected(old('car_id', $reservation->car_id ?? '') == $car->id)>
                    {{ $car->name }}
                </option>
            @endforeach
        </select>
        @error('car_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    {{-- ------------ CUSTOMER INFO ------------- --}}
    <div class="col-md-4">
        <label class="form-label">Customer name *</label>
        <input  type="text"
                class="form-control @error('customer_name') is-invalid @enderror"
                name="customer_name"
                value="{{ old('customer_name', $reservation->customer_name ?? '') }}"
                required>
        @error('customer_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label">Customer phone *</label>
        <input  type="text"
                class="form-control @error('customer_phone') is-invalid @enderror"
                name="customer_phone"
                value="{{ old('customer_phone', $reservation->customer_phone ?? '') }}"
                required>
        @error('customer_phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label">Customer email *</label>
        <input  type="email"
                class="form-control @error('customer_email') is-invalid @enderror"
                name="customer_email"
                value="{{ old('customer_email', $reservation->customer_email ?? '') }}"
                required>
        @error('customer_email') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    {{-- ------------ DATES & TIMES ------------- --}}
    <div class="col-md-3">
        <label class="form-label">Pickup date *</label>
        <input  type="date"
                class="form-control @error('pickup_date') is-invalid @enderror"
                name="pickup_date"
                value="{{ old('pickup_date', optional($reservation->pickup_date ?? null)->format('Y-m-d')) }}"
                required>
        @error('pickup_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-3">
        <label class="form-label">Pickup time *</label>
        <input  type="time"
                class="form-control @error('pickup_time') is-invalid @enderror"
                name="pickup_time"
                value="{{ old('pickup_time', $reservation->pickup_time ?? '') }}"
                required>
        @error('pickup_time') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-3">
        <label class="form-label">Drop-off date *</label>
        <input  type="date"
                class="form-control @error('dropoff_date') is-invalid @enderror"
                name="dropoff_date"
                value="{{ old('dropoff_date', optional($reservation->dropoff_date ?? null)->format('Y-m-d')) }}"
                required>
        @error('dropoff_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-3">
        <label class="form-label">Drop-off time *</label>
        <input  type="time"
                class="form-control @error('dropoff_time') is-invalid @enderror"
                name="dropoff_time"
                value="{{ old('dropoff_time', $reservation->dropoff_time ?? '') }}"
                required>
        @error('dropoff_time') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    {{-- ------------ LOCATIONS ------------- --}}
    <div class="col-md-6">
        <label class="form-label">Pickup location *</label>
        <input  type="text"
                class="form-control @error('pickup_location') is-invalid @enderror"
                name="pickup_location"
                value="{{ old('pickup_location', $reservation->pickup_location ?? '') }}"
                required>
        @error('pickup_location') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Drop-off location *</label>
        <input  type="text"
                class="form-control @error('dropoff_location') is-invalid @enderror"
                name="dropoff_location"
                value="{{ old('dropoff_location', $reservation->dropoff_location ?? '') }}"
                required>
        @error('dropoff_location') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    {{-- ------------ DEPOSIT TYPE ------------- --}}
    <div class="col-md-3">
        <label class="form-label">Security deposit *</label>
        <select class="form-select @error('security_deposit') is-invalid @enderror"
                name="security_deposit" required>
            <option value="per_day"
                @selected(old('security_deposit',$reservation->security_deposit_type ?? '')==='per_day')>
                Per day
            </option>
            <option value="fixed"
                @selected(old('security_deposit',$reservation->security_deposit_type ?? '')==='fixed')>
                Fixed
            </option>
        </select>
        @error('security_deposit') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    {{-- ------------ EXTRAS & OPTIONS ------------- --}}
    <div class="col-12">
        <label class="form-label">Extras & Options</label>

        <div id="extras-wrapper"  class="row gy-1"></div>
        <div id="options-wrapper" class="row gy-1 mt-2"></div>

        {{-- array-level errors --}}
        @if($errors->has('extras') || $errors->has('options'))
           <p class="text-danger small mb-0">
               {{ $errors->first('extras') ?: $errors->first('options') }}
           </p>
        @endif

        <small class="text-muted">Tick anything the customer wants to add.</small>
    </div>

    {{-- ------------ ACTION BUTTONS ------------- --}}
    <div class="col-12">
        <button class="btn btn-success">{{ $editing ? 'Update' : 'Create' }}</button>
        <a href="{{ route('admin.reservations.index') }}" class="btn btn-secondary">Cancel</a>
    </div>
</div>

@push('scripts')
<script>
const carSelect       = document.querySelector('[name="car_id"]');
const extrasWrapper   = document.getElementById('extras-wrapper');
const optionsWrapper  = document.getElementById('options-wrapper');

// selections to “re-check” (editing / failed validation)
const oldExtras   = <?php
    $reservationExtras = isset($reservation) ? ($reservation->extras ?? []) : [];
    if (is_string($reservationExtras)) {
        $reservationExtras = json_decode($reservationExtras, true);
    }
    if (!is_array($reservationExtras)) {
        $reservationExtras = [];
    }

    echo json_encode(old('extras', array_keys($reservationExtras)));
?>;
const oldOptions  = <?php
    $reservationOptions = isset($reservation) ? ($reservation->options ?? []) : [];
    if (is_string($reservationOptions)) {
        $reservationOptions = json_decode($reservationOptions, true);
    }
    if (!is_array($reservationOptions)) {
        $reservationOptions = [];
    }

    echo json_encode(old('options', $reservationOptions));
?>;

// Initialise
document.addEventListener('DOMContentLoaded', () => loadConfig(carSelect.value));
carSelect.addEventListener('change', e => loadConfig(e.target.value));

function loadConfig(carId)
{
    if (!carId) { extrasWrapper.innerHTML = optionsWrapper.innerHTML = ''; return; }

    fetch(`{{ url('/admin/ajax/cars') }}/${carId}/config`)
        .then(r => r.json())
        .then(data => renderCheckboxes(data))
        .catch(console.error);
}

function renderCheckboxes({ extras = {}, options = {} })
{
    // Helper to build a titled block of check-boxes --------------------------
    const buildSection = (title, obj, field, remembered = []) =>
        Object.keys(obj).length
        ? `
            <div class="mb-2">
                <h6 class="fw-semibold mb-1">${title}</h6>
                <div class="row gy-1">
                    ${Object.entries(obj).map(
                        ([key, val]) => `
                            <div class="col-md-3 form-check">
                                <input  class="form-check-input" type="checkbox"
                                        id="${field}-${key}" name="${field}[]" value="${field === 'extras' ? key : val}"
                                        ${remembered.includes(key) ? 'checked' : ''}>
                                <label class="form-check-label" for="${field}-${key}">
                                    ${field === 'extras' ? `${key} (${val}/day)` : val}
                                </label>
                            </div>`
                    ).join('')}
                </div>
            </div>`
        : '';

    // Build HTML and inject --------------------------------------------------
    extrasWrapper.innerHTML  = buildSection('Extras',  extras , 'extras' , oldExtras );
    optionsWrapper.innerHTML = buildSection('Options', options, 'options', oldOptions);
}

</script>
@endpush

