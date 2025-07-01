<div class="container py-4">
    <div class="card shadow">
        <div class="card-body p-4">
            <form action="{{ route('cars.search') }}" method="GET" id="bookingForm">
                @csrf
                <div class="row g-3">
                    <!-- Pickup Location -->
                    <div class="col-md-6">
                        <label for="pickup_location" class="form-label"><i class="me-1 fs-6 fw-bold bi bi-geo"></i>
                            Pickup Location</label>
                        <select name="pickup_location" id="pickup_location"
                            class="form-select @error('pickup_location') is-invalid @enderror" required>
                            @php
                            $locations = [
                            'Agadir Airport - AL MASSIRA',
                            'Marrakech Airport - AL MENARA',
                            'Essaouira Airport - MOGADOR',
                            'Taghazout',
                            'Grey Cars Rental Agency'
                            ];
                            @endphp
                            @foreach($locations as $location)
                            <option value="{{ $location }}" {{ old('pickup_location') == $location ? 'selected' : '' }}>
                                {{ $location }}
                            </option>
                            @endforeach
                        </select>
                        @error('pickup_location')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Dropoff Location -->
                    <div class="col-md-6">
                        <label for="dropoff_location" class="form-label"><i class="me-1 fs-6 fw-bold bi bi-geo"></i>
                            Drop Off Location</label>
                        <select name="dropoff_location" id="dropoff_location"
                            class="form-select @error('dropoff_location') is-invalid @enderror" required>
                            @foreach($locations as $location)
                            <option value="{{ $location }}"
                                {{ old('dropoff_location') == $location ? 'selected' : '' }}>
                                {{ $location }}
                            </option>
                            @endforeach
                        </select>
                        @error('dropoff_location')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Pickup Date -->
                    <div class="col-md-12">
                        <label for="date_picker" class="form-label"><i class="me-1 fs-6 fw-bold bi bi-calendar"></i>
                            Pickup Date</label>
                        <input name="date_picker" id="date_picker"
                            class="form-control @error('date_picker') is-invalid @enderror" required>
                        @error('pickup_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        @error('dropoff_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="">
                        <label for="pickup_date" class="form-label d-none">Pickup Date</label>
                        <input type="date" name="pickup_date" id="pickup_date"
                            class="form-control @error('pickup_date') is-invalid @enderror d-none"
                            value="{{ old('pickup_date') }}">
                        @error('pickup_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Dropoff Date -->
                    <div class="">
                        <label for="dropoff_date" class="form-label d-none">Drop Off Date</label>
                        <input type="date" name="dropoff_date" id="dropoff_date"
                            class="form-control @error('dropoff_date') is-invalid @enderror d-none"
                            value="{{ old('dropoff_date') }}">
                        @error('dropoff_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Pickup Time -->
                    <div class="col-md-6">
                        <label for="pickup_time" class="form-label"><i class="me-1 fs-6 fw-bold bi bi-clock"></i> Pickup
                            Time</label>
                        <input type="time" name="pickup_time" id="pickup_time"
                            class="form-control @error('pickup_time') is-invalid @enderror"
                            value="{{ old('pickup_time') }}">
                        @error('pickup_time')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Dropoff Time -->
                    <div class="col-md-6">
                        <label for="dropoff_time" class="form-label"><i class="me-1 fs-6 fw-bold bi bi-clock"></i> Drop
                            Off Time</label>
                        <input type="time" name="dropoff_time" id="dropoff_time"
                            class="form-control @error('dropoff_time') is-invalid @enderror"
                            value="{{ old('dropoff_time') }}">
                        @error('dropoff_time')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="col-12 mt-3">
                        <button type="submit" class="btn btn-primary w-100 py-3">Search Available Cars</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@easepick/datetime@1.2.1/dist/index.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@easepick/core@1.2.1/dist/index.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@easepick/base-plugin@1.2.1/dist/index.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@easepick/range-plugin@1.2.1/dist/index.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@easepick/lock-plugin@1.2.1/dist/index.umd.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const startField = document.getElementById('pickup_date'); // hidden
    const endField = document.getElementById('dropoff_date'); // hidden
    const datePicker = document.getElementById('date_picker');
    const datePickerContainer = datePicker.parentElement;
    const form = document.querySelector('#bookingForm');

    const picker = new easepick.create({
        element: '#date_picker', // the only field users will touch
        format: 'YYYY-MM-DD', // ISO → easy for Laravel validation
        css: [
            'https://cdn.jsdelivr.net/npm/@easepick/core@1.2.1/dist/index.css',
            'https://cdn.jsdelivr.net/npm/@easepick/range-plugin@1.2.1/dist/index.css',
            'https://cdn.jsdelivr.net/npm/@easepick/lock-plugin@1.2.1/dist/index.css',
        ],
        plugins: ['RangePlugin', 'LockPlugin'],
        RangePlugin: {
            strict: true,
            delimiter: ' – ',
            tooltipNumber(num) {
                return num - 1;
            },
            locale: {
                one: 'day',
                other: 'days',
            },
        },
        LockPlugin: {
            minDays: 4,
            selectForward: true,
            minDate: new Date(),
        },
    });

    picker.on('select', () => {
        const s = picker.getStartDate();
        const e = picker.getEndDate();
        if (startField && endField) {
            startField.value = s ? s.format('YYYY-MM-DD') : '';
            endField.value = e ? e.format('YYYY-MM-DD') : '';
        }

        // Safely remove error class
        if (datePicker && datePicker.classList) {
            datePicker.classList.remove('is-invalid');
        }

        // Safely remove error message
        if (datePickerContainer) {
            const existingError = datePickerContainer.querySelector('.date-picker-error');
            if (existingError) {
                existingError.remove();
            }
        }
    });

    form.addEventListener('submit', (e) => {
        if (!startField?.value || !endField?.value) {
            e.preventDefault();

            // Safely add error class
            if (datePicker?.classList) {
                datePicker.classList.add('is-invalid');
            }

            // Safely add error message
            if (datePickerContainer && !datePickerContainer.querySelector('.date-picker-error')) {
                const errorDiv = document.createElement('div');
                errorDiv.className = 'date-picker-error invalid-feedback';
                errorDiv.textContent = 'Please select a valid date range';
                datePickerContainer.appendChild(errorDiv);
            }

            // Safely scroll to picker
            datePicker?.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
        }
    });
});
</script>