<!-- Booking Modal -->
<div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bookingModalLabel">Enter Booking Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="modalBookingForm" method="GET">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="pickup_location" class="form-label">Pickup Location</label>
                            <select name="pickup_location" id="pickup_location" class="form-select" required>
                                <option value="Agadir Airport - Al Massira">Agadir Airport - Al Massira</option>
                                <option value="Marrakech Airport - Menara">Marrakech Airport - Menara</option>
                                <option value="Essaouira Airport - Mogador">Essaouira Airport - Mogador</option>
                                <option value="Taghazout">Taghazout</option>
                                <option value="Grey Cars Rental">Grey Cars Rental Agency</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="dropoff_location" class="form-label">Drop Off Location</label>
                            <select name="dropoff_location" id="dropoff_location" class="form-select" required>
                                <option value="Agadir Airport - Al Massira">Agadir Airport - Al Massira</option>
                                <option value="Marrakech Airport - Menara">Marrakech Airport - Menara</option>
                                <option value="Essaouira Airport - Mogador">Essaouira Airport - Mogador</option>
                                <option value="Taghazout">Taghazout</option>
                                <option value="Grey Cars Rental">Grey Cars Rental Agency</option>
                            </select>
                        </div>

                        <!-- Pickup Date -->
                        <div class="col-md-12">
                            <label for="modal_date_picker" class="form-label"><i
                                    class="me-1 fs-6 fw-bold bi bi-calendar"></i> Pickup Date</label>
                            <input name="date_picker" id="modal_date_picker"
                                class="form-control @error('date_picker') is-invalid @enderror" required>
                            @error('pickup_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @error('dropoff_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 d-none">
                            <label for="pickup_date" class="form-label">Pickup Date</label>
                            <input type="date" name="pickup_date" id="modal_pickup_date" class="form-control"
                                min="{{ date('Y-m-d') }}" required>
                        </div>

                        <div class="col-md-6">
                            <label for="pickup_time" class="form-label">Pickup Time</label>
                            <input type="time" name="pickup_time" id="pickup_time" class="form-control" step="900"
                                required>
                        </div>

                        <div class="col-md-6 d-none">
                            <label for="dropoff_date" class="form-label">Drop Off Date</label>
                            <input type="date" name="dropoff_date" id="modal_dropoff_date" class="form-control"
                                min="{{ date('Y-m-d') }}" required>
                        </div>

                        <div class="col-md-6">
                            <label for="dropoff_time" class="form-label">Drop Off Time</label>
                            <input type="time" name="dropoff_time" id="dropoff_time" class="form-control" step="900"
                                required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer d-flex justify-content-start">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="confirmBooking">Continue</button>
            </div>
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
    const modalStartField = document.getElementById('modal_pickup_date'); // hidden
    const modalEndField = document.getElementById('modal_dropoff_date'); // hidden
    const modalDatePicker = document.getElementById('modal_date_picker');
    const modalDatePickerContainer = modalDatePicker.parentElement;
    const modalForm = document.querySelector('#modalBookingForm');

    const modalPicker = new easepick.create({
        element: '#modal_date_picker', // the only field users will touch
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

    /* write back to the hidden inputs whenever the user confirms a range */
    modalPicker.on('select', () => {
        const s = modalPicker.getStartDate();
        const e = modalPicker.getEndDate();
        modalStartField.value = s ? s.format('YYYY-MM-DD') : '';
        modalEndField.value = e ? e.format('YYYY-MM-DD') : '';

        // Safely remove error class
        if (modalDatePicker && modalDatePicker.classList) {
            modalDatePicker.classList.remove('is-invalid');
        }

        // Safely remove error message
        if (modalDatePickerContainer) {
            const existingError = modalDatePickerContainer.querySelector('.modal-date-picker-error');
            if(existingError){
                existingError.remove();
            }
        }

        console.log('Range selected', modalPicker.getStartDate(), modalPicker.getEndDate());
        console.log('Inputs updated', modalStartField.value, modalEndField.value);

    });
   
});
</script>