<div class="container search-card-wrap py-4">
    <div class="card shadow search-modern">
        <div class="card-body p-4 p-md-4">
            <form action="{{ route('cars.search') }}" method="GET" id="bookingForm">
                @csrf
                <div class="row g-3 g-md-4">
                    <!-- Pickup Location -->
                    <div class="col-md-6">
                        <div class="search-field @error('pickup_location') is-invalid @enderror">
                            <div class="search-field-icon"><i class="bi bi-geo-alt-fill"></i></div>
                            <div class="search-field-body">
                                <label for="pickup_location" class="search-field-label">Pickup Location</label>
                                <select name="pickup_location" id="pickup_location"
                                    class="search-field-input form-select @error('pickup_location') is-invalid @enderror" required>
                                    @php($locations = config('rental.locations', []))
                                    @foreach($locations as $location)
                                    <option value="{{ $location }}" {{ old('pickup_location') == $location ? 'selected' : '' }}>
                                        {{ $location }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @error('pickup_location')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Dropoff Location -->
                    <div class="col-md-6">
                        <div class="search-field @error('dropoff_location') is-invalid @enderror">
                            <div class="search-field-icon"><i class="bi bi-geo-alt"></i></div>
                            <div class="search-field-body">
                                <label for="dropoff_location" class="search-field-label">Drop Off Location</label>
                                <select name="dropoff_location" id="dropoff_location"
                                    class="search-field-input form-select @error('dropoff_location') is-invalid @enderror" required>
                                    @foreach($locations as $location)
                                    <option value="{{ $location }}"
                                        {{ old('dropoff_location') == $location ? 'selected' : '' }}>
                                        {{ $location }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @error('dropoff_location')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Pickup Date Range -->
                    <div class="col-md-12">
                        <div class="search-field">
                            <div class="search-field-icon"><i class="bi bi-calendar3"></i></div>
                            <div class="search-field-body">
                                <label for="date_picker" class="search-field-label">Pickup &amp; Drop-off Dates</label>
                                <input name="date_picker" id="date_picker" placeholder="Select your rental dates"
                                    class="search-field-input form-control @error('date_picker') is-invalid @enderror" required>
                            </div>
                        </div>
                        @error('pickup_date')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                        @error('dropoff_date')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-none">
                        <input type="date" name="pickup_date" id="pickup_date"
                            class="form-control @error('pickup_date') is-invalid @enderror"
                            value="{{ old('pickup_date') }}">
                        <input type="date" name="dropoff_date" id="dropoff_date"
                            class="form-control @error('dropoff_date') is-invalid @enderror"
                            value="{{ old('dropoff_date') }}">
                    </div>

                    <!-- Pickup Time -->
                    <div class="col-md-6">
                        <div class="search-field @error('pickup_time') is-invalid @enderror">
                            <div class="search-field-icon"><i class="bi bi-clock-fill"></i></div>
                            <div class="search-field-body">
                                <label for="pickup_time" class="search-field-label">Pickup Time</label>
                                <input type="time" name="pickup_time" id="pickup_time"
                                    class="search-field-input form-control @error('pickup_time') is-invalid @enderror"
                                    value="{{ old('pickup_time') }}">
                            </div>
                        </div>
                        @error('pickup_time')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Dropoff Time -->
                    <div class="col-md-6">
                        <div class="search-field @error('dropoff_time') is-invalid @enderror">
                            <div class="search-field-icon"><i class="bi bi-clock-history"></i></div>
                            <div class="search-field-body">
                                <label for="dropoff_time" class="search-field-label">Drop Off Time</label>
                                <input type="time" name="dropoff_time" id="dropoff_time"
                                    class="search-field-input form-control @error('dropoff_time') is-invalid @enderror"
                                    value="{{ old('dropoff_time') }}">
                            </div>
                        </div>
                        @error('dropoff_time')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="col-12 mt-2">
                        <button type="submit" class="btn btn-primary search-modern-submit">
                            <i class="bi bi-search me-2"></i>Search Available Cars
                            <i class="bi bi-arrow-right ms-2 search-arrow"></i>
                        </button>
                        <div class="search-modern-trust">
                            <span><i class="bi bi-shield-check"></i> No hidden fees</span>
                            <span class="search-trust-dot">·</span>
                            <span><i class="bi bi-arrow-counterclockwise"></i> Free cancellation</span>
                            <span class="search-trust-dot">·</span>
                            <span><i class="bi bi-lock-fill"></i> Secure booking</span>
                        </div>
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