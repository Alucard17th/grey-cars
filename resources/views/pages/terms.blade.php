@extends('layouts.app')

@section('content')
<x-breadcrumb
    eyebrow="Legal"
    title="Terms and Conditions"
    subtitle="By accessing the GREY CARS website, you fully accept these Terms and Conditions."
    :breadcrumbs="[
        ['label' => 'Home', 'url' => route('home')],
        ['label' => 'Terms and Conditions'],
    ]"
/>

<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-9">
                <div class="terms-card">
                    <div class="terms-meta">
                        <span><i class="bi bi-calendar3"></i> Last updated: <strong>01/05/2026</strong></span>
                    </div>

                    <div class="terms-section">
                        <h2 class="terms-heading"><span class="terms-num">1</span> Definitions</h2>
                        <ul class="terms-list">
                            <li><strong>Website:</strong> refers to the GREY CARS website</li>
                            <li><strong>User:</strong> any person browsing the website or using our services</li>
                            <li><strong>Provider:</strong> GREY CARS, the car rental service provider</li>
                        </ul>
                    </div>

                    <div class="terms-section">
                        <h2 class="terms-heading"><span class="terms-num">2</span> Services Offered</h2>
                        <p>GREY CARS provides car rental services. Details regarding available vehicles, prices, and specific conditions are available on the website.</p>
                    </div>

                    <div class="terms-section">
                        <h2 class="terms-heading"><span class="terms-num">3</span> Access to Services</h2>
                        <p>Access to the website is free, while rental services are paid. The User is responsible for their own equipment and internet connection.</p>
                    </div>

                    <div class="terms-section">
                        <h2 class="terms-heading"><span class="terms-num">4</span> User Obligations</h2>
                        <ul class="terms-list">
                            <li>Provide accurate information when making a booking</li>
                            <li>Comply with the specific rental conditions for each vehicle</li>
                            <li>Not use the website for illegal purposes</li>
                        </ul>
                    </div>

                    <div class="terms-section">
                        <h2 class="terms-heading"><span class="terms-num">5</span> Booking and Payment</h2>
                        <p>Bookings are made through our secure online platform. Payment is made upon vehicle delivery. A confirmation will be sent after booking. Prices are displayed in euros.</p>
                        <div class="terms-callout terms-callout-warning">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                            <div>
                                <strong>Important:</strong> Upon delivery, the total amount must be paid in cash, either in euros or Moroccan dirhams, when receiving the vehicle.
                            </div>
                        </div>
                    </div>

                    <div class="terms-section">
                        <h2 class="terms-heading"><span class="terms-num">6</span> Cancellation and Refund Policy</h2>
                        <p>Cancellation conditions may vary depending on the booking. Please refer to our Refund Policy for more details.</p>
                    </div>

                    <div class="terms-section">
                        <h2 class="terms-heading"><span class="terms-num">7</span> GREY CARS Liability</h2>
                        <p>GREY CARS is committed to providing high-quality services but shall not be held responsible for:</p>
                        <ul class="terms-list">
                            <li>Misuse of the vehicle</li>
                            <li>Errors resulting from incorrect information provided by the User</li>
                        </ul>
                    </div>

                    <div class="terms-section">
                        <h2 class="terms-heading"><span class="terms-num">8</span> Personal Data</h2>
                        <p>We collect and process your data in accordance with our Privacy Policy. Your information will never be shared without your consent.</p>
                    </div>

                    <div class="terms-section">
                        <h2 class="terms-heading"><span class="terms-num">9</span> Intellectual Property</h2>
                        <p>All website content (texts, images, logos) is the property of GREY CARS. Any reproduction or reuse without prior authorization is prohibited.</p>
                    </div>

                    <div class="terms-section">
                        <h2 class="terms-heading"><span class="terms-num">10</span> Governing Law and Disputes</h2>
                        <p>These Terms are governed by Moroccan law. Any disputes shall fall under the jurisdiction of the courts of Agadir.</p>
                    </div>

                    <div class="terms-section">
                        <h2 class="terms-heading"><span class="terms-num">11</span> Modification of Terms</h2>
                        <p>GREY CARS reserves the right to modify these Terms at any time. Changes will take effect immediately upon publication on the website.</p>
                    </div>

                    <div class="terms-section">
                        <h2 class="terms-heading"><span class="terms-num">12</span> Lost Keys or Documents</h2>
                        <div class="terms-fees">
                            <div class="terms-fee-card">
                                <div class="terms-fee-icon"><i class="bi bi-key-fill"></i></div>
                                <div>
                                    <span class="terms-fee-label">Lost Car Key</span>
                                    <strong class="terms-fee-value">150 €</strong>
                                </div>
                            </div>
                            <div class="terms-fee-card">
                                <div class="terms-fee-icon"><i class="bi bi-file-earmark-text-fill"></i></div>
                                <div>
                                    <span class="terms-fee-label">Lost Vehicle Documents</span>
                                    <strong class="terms-fee-value">500 €</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    .terms-card {
        background: linear-gradient(160deg, #161616 0%, #0a0a0a 100%);
        border: 1px solid rgba(255, 255, 255, 0.06);
        border-radius: 22px;
        padding: 2.5rem 2.25rem;
        color: rgba(255, 255, 255);
        line-height: 1.65;
        box-shadow: 0 25px 50px -15px rgba(0, 0, 0, 0.6);
    }
    .terms-meta {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        border-radius: 50px;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        font-size: 0.85rem;
        color: rgba(255, 255, 255, 0.75);
        margin-bottom: 2.25rem;
    }
    .terms-meta i { color: #e20305; }
    .terms-meta strong { color: #fff; }
    .terms-section { margin-bottom: 2rem; }
    .terms-section:last-child { margin-bottom: 0; }
    .terms-heading {
        display: flex;
        align-items: center;
        gap: 0.85rem;
        color: #fff;
        font-size: 1.25rem;
        font-weight: 700;
        margin: 0 0 0.85rem;
        padding-bottom: 0.7rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.06);
    }
    .terms-num {
        flex-shrink: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 34px;
        height: 34px;
        padding: 0 0.6rem;
        border-radius: 10px;
        background: linear-gradient(135deg, #e20305, #b50204);
        color: #fff;
        font-size: 0.85rem;
        font-weight: 700;
        box-shadow: 0 8px 18px rgba(226, 3, 5, 0.35);
    }
    .terms-section p { margin: 0 0 0.75rem; color: rgba(255, 255, 255, 0.75); }
    .terms-section p:last-child { margin-bottom: 0; }
    .terms-list {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }
    .terms-list li {
        position: relative;
        padding: 0.65rem 0.85rem 0.65rem 2rem;
        border-radius: 10px;
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.05);
        color: rgba(255, 255, 255, 0.8);
    }
    .terms-list li::before {
        content: '';
        position: absolute;
        left: 0.85rem;
        top: 1.05rem;
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #e20305;
        box-shadow: 0 0 0 3px rgba(226, 3, 5, 0.2);
    }
    .terms-list li strong { color: #fff; font-weight: 700; }
    .terms-callout {
        display: flex;
        align-items: flex-start;
        gap: 0.85rem;
        margin-top: 1rem;
        padding: 1rem 1.15rem;
        border-radius: 14px;
        border: 1px solid;
    }
    .terms-callout i {
        font-size: 1.35rem;
        line-height: 1.3;
        flex-shrink: 0;
    }
    .terms-callout-warning {
        background: rgba(255, 178, 51, 0.08);
        border-color: rgba(255, 178, 51, 0.35);
        color: #ffd591;
    }
    .terms-callout-warning i { color: #ffb233; }
    .terms-callout strong { color: #fff; }
    .terms-fees {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 1rem;
        margin-top: 0.5rem;
    }
    .terms-fee-card {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem 1.15rem;
        border-radius: 14px;
        background: linear-gradient(135deg, rgba(226, 3, 5, 0.1), rgba(226, 3, 5, 0.02));
        border: 1px solid rgba(226, 3, 5, 0.25);
    }
    .terms-fee-icon {
        width: 46px;
        height: 46px;
        border-radius: 12px;
        background: linear-gradient(135deg, #e20305, #b50204);
        color: #fff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        box-shadow: 0 8px 18px rgba(226, 3, 5, 0.35);
        flex-shrink: 0;
    }
    .terms-fee-label {
        display: block;
        font-size: 0.78rem;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        color: rgba(255, 255, 255, 0.55);
    }
    .terms-fee-value {
        display: block;
        color: #fff;
        font-size: 1.35rem;
        font-weight: 800;
        line-height: 1.1;
    }
    @media (max-width: 575.98px) {
        .terms-card { padding: 1.75rem 1.25rem; }
        .terms-heading { font-size: 1.1rem; }
    }
</style>
@endpush
