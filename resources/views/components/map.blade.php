<!-- Location Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Localisation</h2>
            <p class="lead text-muted">Find Us</p>
        </div>

        <div class="row g-4">
            <!-- Contact Info -->
            <div class="col-lg-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-start mb-4">
                            <div class="bg-primary bg-opacity-10 p-3 rounded me-3">
                                <i class="bi bi-geo-alt-fill fs-4 text-primary"></i>
                            </div>
                            <div>
                                <h4 class="h5 mb-1">Our Address</h4>
                                <p>GREY CARS RENTAL<br>{{ config('company.contact.address') }}</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start mb-4">
                            <div class="bg-primary bg-opacity-10 p-3 rounded me-3">
                                <i class="bi bi-telephone-fill fs-4 text-primary"></i>
                            </div>
                            <div>
                                <h4 class="h5 mb-1">Call Us</h4>
                                <p>{{ config('company.contact.phone') }}</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start">
                            <div class="bg-primary bg-opacity-10 p-3 rounded me-3">
                                <i class="bi bi-envelope-fill fs-4 text-primary"></i>
                            </div>
                            <div>
                                <h4 class="h5 mb-1">Email Us</h4>
                                <p>{{ config('company.contact.email') }}</p>
                            </div>
                        </div>

                        <div class="mt-4 pt-3 border-top">
                            <h4 class="h5 mb-3">Opening Hours</h4>
                            <ul class="list-unstyled">
                                <li class="d-flex justify-content-between mb-2">
                                    <span>Monday - Friday</span>
                                    <span>8:00 - 20:00</span>
                                </li>
                                <li class="d-flex justify-content-between mb-2">
                                    <span>Saturday</span>
                                    <span>9:00 - 18:00</span>
                                </li>
                                <li class="d-flex justify-content-between">
                                    <span>Sunday</span>
                                    <span>10:00 - 16:00</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Google Maps Embed -->
            <div class="col-lg-8">
                <div class="ratio ratio-16x9 h-100 shadow rounded overflow-hidden">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3446.123456789012!2d-9.4110127!3d30.3316742!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xdb3b502d49cf23d%3A0x19fbaaa2b64749cf!2sGREY%20CARS%20RENTAL-Agadir%20A%C3%A9roport!5e0!3m2!1sen!2sma!4v1234567890123!5m2!1sen!2sma"
                        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="border-0">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</section>