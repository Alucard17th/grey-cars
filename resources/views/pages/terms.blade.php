@extends('layouts.app')

@section('content')
<div class="container-fluid py-5">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h1 class="h3 mb-0">Terms and Conditions of Use</h1>
                </div>
                
                <div class="card-body">
                    <div class="alert alert-info">
                        <p class="mb-0">By accessing our GREY CARS website, you fully accept these terms and conditions. Last updated: {{ now()->format('m/d/Y') }}</p>
                    </div>

                    <div class="mb-5">
                        <h2 class="h4 text-primary mb-3">1. Definitions</h2>
                        <ul class="list-unstyled">
                            <li class="mb-2"><strong>Website:</strong> refers to the GREY CARS website</li>
                            <li class="mb-2"><strong>User:</strong> any person browsing the site or using our services</li>
                            <li><strong>Provider:</strong> GREY CARS, the car rental service provider</li>
                        </ul>
                    </div>

                    <div class="mb-5">
                        <h2 class="h4 text-primary mb-3">2. Services Offered</h2>
                        <p>GREY CARS provides car rental services. Details of available vehicles, prices, and specific conditions are available on the website.</p>
                    </div>

                    <div class="mb-5">
                        <h2 class="h4 text-primary mb-3">3. Service Access</h2>
                        <p>Website access is free, but rental services are paid. The User is responsible for their equipment and internet connection.</p>
                    </div>

                    <div class="mb-5">
                        <h2 class="h4 text-primary mb-3">4. User Obligations</h2>
                        <ul>
                            <li class="mb-2">Provide accurate information when booking</li>
                            <li class="mb-2">Comply with the specific rental conditions for each vehicle</li>
                            <li>Do not use the website for illegal purposes</li>
                        </ul>
                    </div>

                    <div class="mb-5">
                        <h2 class="h4 text-primary mb-3">5. Booking and Payment</h2>
                        <p>Bookings are made online via our secure platform. Payments are made upon vehicle delivery. A confirmation will be sent after booking. Prices are shown in euros.</p>
                        <div class="alert alert-warning">
                            <p class="mb-0"><strong>Important:</strong> Upon delivery, the total amount will be paid in cash, along with the deductible, when receiving the vehicle.</p>
                        </div>
                    </div>

                    <div class="mb-5">
                        <h2 class="h4 text-primary mb-3">6. Cancellation and Refund Policy</h2>
                        <p>Cancellation conditions vary by booking. See our Refund Policy for details.</p>
                    </div>

                    <div class="mb-5">
                        <h2 class="h4 text-primary mb-3">7. GREY CARS Liability</h2>
                        <p>GREY CARS is committed to providing quality services but disclaims all liability for:</p>
                        <ul>
                            <li class="mb-2">Unforeseen mechanical breakdowns</li>
                            <li class="mb-2">Vehicle misuse</li>
                            <li>Errors due to incorrect information provided by the User</li>
                        </ul>
                    </div>

                    <div class="mb-5">
                        <h2 class="h4 text-primary mb-3">8. Personal Data</h2>
                        <p>We collect and process your data according to our Privacy Policy. Your information will never be shared without consent.</p>
                    </div>

                    <div class="mb-5">
                        <h2 class="h4 text-primary mb-3">9. Intellectual Property</h2>
                        <p>Website content (texts, images, logos) is property of GREY CARS. Any reproduction is prohibited without authorization.</p>
                    </div>

                    <div class="mb-5">
                        <h2 class="h4 text-primary mb-3">10. Governing Law and Disputes</h2>
                        <p>These terms are governed by Moroccan law. Any disputes will fall under the jurisdiction of Agadir courts.</p>
                    </div>

                    <div class="mb-5">
                        <h2 class="h4 text-primary mb-3">11. Terms Modification</h2>
                        <p>GREY CARS reserves the right to modify these terms at any time. Changes will take effect immediately upon publication on the website.</p>
                    </div>

                    <div class="mb-5">
                        <h2 class="h4 text-primary mb-3">12. Lost Keys and Papers</h2>
                        <p>In case of lost car keys or vehicle documents, a fee of 500 {{ config('rental.currency_symbol', '€') }} will be applied.</p>
                    </div>

                    <!-- <div class="alert alert-light border mt-5">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="acceptTerms">
                            <label class="form-check-label" for="acceptTerms">
                                I acknowledge having read and accepted the Terms and Conditions of Use
                            </label>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .card {
        border-radius: 10px;
        overflow: hidden;
    }
    
    .card-header {
        padding: 1.5rem;
    }
    
    .card-body {
        padding: 2rem;
    }
    
    h2 {
        border-bottom: 2px solid #f0f0f0;
        padding-bottom: 0.5rem;
    }
    
    .alert-warning {
        background-color: rgba(255,193,7,0.1);
        border-color: rgba(255,193,7,0.3);
    }
    
    @media (max-width: 768px) {
        .card-body {
            padding: 1.5rem;
        }
    }
</style>
@endpush