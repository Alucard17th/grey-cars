<!-- Our Commitment Section -->
<section class="py-5 bg-primary bg-opacity-10">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-white">Our Commitment to You</h2>
            <p class="lead text-white">Beyond Just Car Rental</p>
        </div>

        <!-- Service Process -->
        <div class="row g-4 mb-7">
            <div class="col-md-4">
                <div class="text-center p-4 h-100">
                    <div class="bg-primary bg-opacity-25 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="bi bi-calendar-check fs-2 text-white"></i>
                    </div>
                    <h3 class="h4 text-white">Easy Booking</h3>
                    <p class="text-white opacity-75">Simple online reservation system with instant confirmation and flexible modification options.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center p-4 h-100">
                    <div class="bg-primary bg-opacity-25 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="bi bi-people fs-2 text-white"></i>
                    </div>
                    <h3 class="h4 text-white">Personalized Service</h3>
                    <p class="text-white opacity-75">Dedicated agents who understand your needs and help select the perfect vehicle.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center p-4 h-100">
                    <div class="bg-primary bg-opacity-25 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="bi bi-heart fs-2 text-white"></i>
                    </div>
                    <h3 class="h4 text-white">After-Rental Care</h3>
                    <p class="text-white opacity-75">We follow up to ensure your complete satisfaction with our services.</p>
                </div>
            </div>
        </div>

        <!-- Community Involvement -->
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <img src="{{ asset('images/about-us-3.jpg') }}" alt="Grey Cars Rental Community Involvement" 
                     class="img-fluid rounded shadow-lg">
            </div>
            <div class="col-lg-6">
                <div class="ps-lg-4">
                    <h2 class="fw-bold text-white mb-4">Rooted in Moroccan Community</h2>
                    <p class="text-white mb-4">As a proud Moroccan business, we're committed to giving back to the communities that support us.</p>
                    
                    <div class="d-flex mb-4">
                        <div class="me-4">
                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                <i class="bi bi-tree text-white fs-5"></i>
                            </div>
                        </div>
                        <div>
                            <h4 class="h5 text-white">Eco-Friendly Initiatives</h4>
                            <p class="text-white opacity-75 mb-0">We maintain fuel-efficient vehicles and support local environmental projects.</p>
                        </div>
                    </div>
                    
                    <div class="d-flex mb-4">
                        <div class="me-4">
                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                <i class="bi bi-briefcase text-white fs-5"></i>
                            </div>
                        </div>
                        <div>
                            <h4 class="h5 text-white">Local Employment</h4>
                            <p class="text-white opacity-75 mb-0">100% of our team members are from the Agadir region, supporting local families.</p>
                        </div>
                    </div>
                    
                    <div class="d-flex">
                        <div class="me-4">
                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                <i class="bi bi-currency-exchange text-white fs-5"></i>
                            </div>
                        </div>
                        <div>
                            <h4 class="h5 text-white">Fair Pricing</h4>
                            <p class="text-white opacity-75 mb-0">We keep our rates competitive while ensuring fair wages for our staff.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="text-center mt-5">
            <h3 class="text-white mb-4">Ready to Explore Morocco with Confidence?</h3>
            <a href="{{ route('contact') }}" class="btn btn-primary btn-lg px-4 me-2">
                <i class="bi bi-telephone me-2"></i> Contact Us
            </a>
            <a href="{{ route('cars.index') }}" class="btn btn-outline-light btn-lg px-4">
                <i class="bi bi-car-front me-2"></i> View Our Fleet
            </a>
        </div>
    </div>
</section>