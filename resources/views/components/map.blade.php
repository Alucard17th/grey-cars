<!-- Location Section -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5 text-white">
            <span class="section-eyebrow">Visit Us</span>
            <h2 class="fw-bold">Find Us on the Map</h2>
            <p class="text-light opacity-75 mx-auto" style="max-width:560px;">Our main office is located at Agadir Al Massira Airport — easy to reach the moment you land.</p>
        </div>

        <div class="row g-4 align-items-stretch">
            <!-- Contact Info -->
            <div class="col-lg-4">
                <div class="map-info-card h-100">
                    <h3 class="map-info-title">Get in Touch</h3>
                    <p class="map-info-sub">Reach out anytime — we're here to help.</p>

                    <ul class="map-info-list">
                        <li>
                            <span class="map-info-icon"><i class="bi bi-geo-alt-fill"></i></span>
                            <div>
                                <span class="map-info-label">Our Address</span>
                                <a href="https://www.google.com/maps?q=GREY+CARS+RENTAL+Agadir+Aeroport" target="_blank" rel="noopener" class="map-info-value">
                                    GREY CARS RENTAL<br>{{ config('company.contact.address') }}
                                </a>
                            </div>
                        </li>
                        <li>
                            <span class="map-info-icon"><i class="bi bi-telephone-fill"></i></span>
                            <div>
                                <span class="map-info-label">Call Us</span>
                                <a href="tel:{{ config('company.contact.phone') }}" class="map-info-value">{{ config('company.contact.phone') }}</a>
                            </div>
                        </li>
                        <li>
                            <span class="map-info-icon"><i class="bi bi-envelope-fill"></i></span>
                            <div>
                                <span class="map-info-label">Email Us</span>
                                <a href="mailto:{{ config('company.contact.email') }}" class="map-info-value">{{ config('company.contact.email') }}</a>
                            </div>
                        </li>
                        <li>
                            <span class="map-info-icon"><i class="bi bi-clock-fill"></i></span>
                            <div>
                                <span class="map-info-label">Working Hours</span>
                                <span class="map-info-value">{{ config('company.contact.hours') }}</span>
                            </div>
                        </li>
                    </ul>

                    <div class="map-info-actions">
                        <a href="https://wa.me/{{ preg_replace('/\D/', '', config('company.contact.phone')) }}" target="_blank" rel="noopener" class="map-info-btn map-info-btn-whatsapp">
                            <i class="bi bi-whatsapp"></i> WhatsApp
                        </a>
                        <a href="https://www.google.com/maps?q=GREY+CARS+RENTAL+Agadir+Aeroport" target="_blank" rel="noopener" class="map-info-btn map-info-btn-direction">
                            <i class="bi bi-cursor-fill"></i> Directions
                        </a>
                    </div>
                </div>
            </div>

            <!-- Google Maps Embed -->
            <div class="col-lg-8">
                <div class="map-frame h-100">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3446.123456789012!2d-9.4110127!3d30.3316742!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xdb3b502d49cf23d%3A0x19fbaaa2b64749cf!2sGREY%20CARS%20RENTAL-Agadir%20A%C3%A9roport!5e0!3m2!1sen!2sma!4v1234567890123!5m2!1sen!2sma"
                        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                    <div class="map-frame-pin">
                        <i class="bi bi-geo-alt-fill"></i>
                        <span>Agadir Al Massira Airport</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
