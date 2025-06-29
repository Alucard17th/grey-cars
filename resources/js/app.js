import "./bootstrap";
import * as bootstrap from "bootstrap";

// Initialize tooltips
document.addEventListener("DOMContentLoaded", function () {
    // Tooltips
    const tooltipTriggerList = [].slice.call(
        document.querySelectorAll('[data-bs-toggle="tooltip"]')
    );
    const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Navbar scroll effect
    const navbar = document.querySelector(".navbar");

    window.addEventListener("scroll", function () {
        if (window.scrollY > 50) {
            navbar.classList.add("scrolled");
        } else {
            navbar.classList.remove("scrolled");
        }
    });

    // Activate carousel
    const myCarousel = document.querySelector("#heroCarousel");
    new bootstrap.Carousel(myCarousel, {
        interval: 5000,
        pause: "hover",
    });

    console.log("Carousel initialized", myCarousel);
});

// Counter
document.addEventListener("DOMContentLoaded", function () {
    const counters = document.querySelectorAll(".counter");
    const speed = 1000; // pixels per second (adjust this value to change speed)

    function startCounters() {
        let lastTime;
        const targetValues = Array.from(counters).map(
            (counter) => +counter.getAttribute("data-target")
        );

        function updateCounters(timestamp) {
            if (!lastTime) lastTime = timestamp;
            const deltaTime = timestamp - lastTime;
            lastTime = timestamp;

            let allComplete = true;

            counters.forEach((counter, index) => {
                const current = +counter.innerText.replace(/,/g, "");
                const target = targetValues[index];

                if (current < target) {
                    allComplete = false;
                    // Calculate increment based on time passed to maintain consistent speed
                    const increment = (speed * deltaTime) / 1000;
                    const newValue = Math.min(current + increment, target);
                    counter.innerText = Math.floor(newValue).toLocaleString();
                }
            });

            if (!allComplete) {
                requestAnimationFrame(updateCounters);
            }
        }

        requestAnimationFrame(updateCounters);
    }

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    startCounters();
                    observer.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.5 }
    );

    document.querySelectorAll(".counter").forEach((counter) => {
        observer.observe(counter.closest(".col-md-4"));
    });
});

// Search Car Modal
document.addEventListener("DOMContentLoaded", function () {
    const bookingModal = document.getElementById("bookingModal");
    const bookingForm = document.getElementById("bookingForm");
    const confirmBookingBtn = document.getElementById("confirmBooking");
    let currentCarId = null;

    const startField = document.getElementById('modal_pickup_date'); // hidden
    const endField = document.getElementById('modal_dropoff_date'); // hidden
    const modalDatePicker = document.getElementById('modal_date_picker');
    const modalDatePickerContainer = modalDatePicker.parentElement;
    // const modalForm = document.querySelector('#modalBookingForm');

    // When a Book Now button is clicked
    document.querySelectorAll(".book-now-btn").forEach((button) => {
        button.addEventListener("click", function () {
            currentCarId = this.getAttribute("data-car-id");
        });
    });

    // Handle form submission with Fetch
    confirmBookingBtn.addEventListener("click", async function () {
        console.log('FROM CONFIRM BOOKING');
        if (!startField?.value || !endField?.value) {
            console.log('No start or end date');
            // Safely add error class
            if (modalDatePicker?.classList) {
                modalDatePicker.classList.add("is-invalid");
            }

            // Safely add error message
            if (
                modalDatePickerContainer &&
                !modalDatePickerContainer.querySelector(".modal-date-picker-error")
            ) {
                const errorDiv = document.createElement("div");
                errorDiv.className = "modal-date-picker-error invalid-feedback";
                errorDiv.textContent = "Please select a valid date range";
                modalDatePickerContainer.appendChild(errorDiv);
            }

            // Safely scroll to picker
            modalDatePicker?.scrollIntoView({
                behavior: "smooth",
                block: "center",
            });

            return;
        }

        const formData = new FormData(bookingForm);
        const params = new URLSearchParams(formData);

        try {
            // Show loading state
            confirmBookingBtn.disabled = true;
            confirmBookingBtn.innerHTML =
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...';
            const errorAlert = document.querySelector(".alert-danger");
            if (errorAlert) {
                errorAlert.remove();
            }
            // Check car availability first
            const availabilityResponse = await fetch(
                `/cars/${currentCarId}/json-book?${params.toString()}`
            );
            const availabilityData = await availabilityResponse.json();

            if (!availabilityData.available) {
                throw new Error(
                    "This car is no longer available for your selected dates."
                );
            }

            // If available, proceed to booking page
            window.location.href = `/cars/${currentCarId}/book?${params.toString()}`;
        } catch (error) {
            // Show error message
            const errorAlert = document.createElement("div");
            errorAlert.className = "alert alert-danger mt-3";
            errorAlert.textContent = error.message;

            // Remove any existing alerts
            document
                .querySelectorAll(".alert-danger")
                .forEach((el) => el.remove());

            // Insert the alert
            bookingModal.querySelector(".modal-body").appendChild(errorAlert);

            // Scroll to error
            errorAlert.scrollIntoView({ behavior: "smooth" });
        } finally {
            // Reset button state
            confirmBookingBtn.disabled = false;
            confirmBookingBtn.textContent = "Continue to Booking";
        }
    });
});
