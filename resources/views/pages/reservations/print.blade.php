<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Reservation #{{ $reservation->id }}</title>

<style>
    /* -------- Root + typography -------- */
    :root           { --sp:6px; }                                /* master spacing unit */
    *               { box-sizing:border-box; }
    body            { margin:0; font:13px/1.25 "DejaVu Sans", Arial, sans-serif; color:#000; }
    h2,h5           { margin:0 0 var(--sp); font-weight:600; line-height:1.2; }
    h5              { font-size:14px; }
    table           { width:100%; border-collapse:collapse; font-size:12px; }
    td              { padding:var(--sp) 0; vertical-align:top; }
    .text-end       { text-align:right; }
    .text-center    { text-align:center; }
    .muted          { color:#666; }
    .badge          { display:inline-block; padding:2px 6px; border-radius:3px; font-size:11px; }
    .bg-success     { background:#28a745; color:#fff; }

    /* -------- Layout helpers -------- */
    .wrap           { width:100%; max-width:700px; margin:0 auto; padding:10mm 8mm; min-height:100vh; display:flex; flex-direction:column; }
    .row            { display:flex; flex-wrap:wrap; margin:calc(-1*var(--sp)) 0 0; }
    .col-6          { width:50%; padding-top:var(--sp); }
    .col-4          { width:33.3333%; padding-top:var(--sp); }
    .mb-0           { margin-bottom:0 !important; }
    .mb-1           { margin-bottom:var(--sp) !important; }
    .mb-2           { margin-bottom:calc(2*var(--sp)) !important; }
    .mb-3           { margin-bottom:calc(3*var(--sp)) !important; }
    .mt-3           { margin-top:calc(3*var(--sp)) !important; }
    .ps-0           { padding-left:0 !important; }
    .fw-600         { font-weight:600; }
    .fs-90          { font-size:11px; }
    .logo           { max-height:21mm; max-width:45mm; height:auto; width:auto; display:block; }
    .header-row     { align-items:center; }
    .footer         { margin-top:auto; }

    /* -------- Page/print settings -------- */
    @page { margin:10mm 8mm; }
    @media print {
        a[href]:after { content:''; }
    }
</style>
</head>
<body>

<div class="wrap">
    @php
        $currencySymbol = config('company.currency_symbol', '€');
        $companyName = config('company.name', '');
        $companyWebsite = config('company.website', '');
        $companyLogo = config('company.logo', '');
        $companyPhone = config('company.contact.phone', '');
        $companyEmail = config('company.contact.email', '');
        $companyWhatsapp = config('company.contact.whatsapp', '');
        $companyAddress = config('company.contact.address', '');
    @endphp
    <!-- Header -->
    <div class="row header-row mb-2">
        <div class="col-4">
            <h2>Reservation #{{ $reservation->id }}</h2>
            <span class="badge bg-success">{{ ucfirst($reservation->status) }}</span>
        </div>
        <div class="col-4 text-center">
            @if($companyLogo)
                <img class="logo" src="{{ $companyLogo }}" alt="{{ $companyName ?: 'Company logo' }}">
            @endif
        </div>
        <div class="col-4 text-end fs-90">
            {{ $companyName ?: 'Grey Cars Rental Co.' }}
            @if($companyWebsite)
                <br>{{ $companyWebsite }}
            @endif
        </div>
    </div>
    <hr class="mb-2">

    <!-- Pickup / Drop-off -->
    <div class="row mb-3">
        <div class="col-6">
            <h5>Pickup</h5>
            <div class="fs-90">
                {{ $reservation->pickup_date->format('D, M j Y') }},
                {{ $reservation->pickup_time }}<br>
                {{ $reservation->pickup_location }}
            </div>
        </div>
        <div class="col-6">
            <h5>Drop-off</h5>
            <div class="fs-90">
                {{ $reservation->dropoff_date->format('D, M j Y') }},
                {{ $reservation->dropoff_time }}<br>
                {{ $reservation->dropoff_location }}
            </div>
        </div>
    </div>

    <!-- Vehicle & Customer -->
    <div class="row mb-3">

        <div class="col-6">
            <h5 class="mb-1">Vehicle</h5>
            <table>
                <tr><td class="ps-0">Model</td><td>{{ $reservation->car->name }}</td></tr>
                <tr><td class="ps-0">Rate</td>
                    <td>{{ number_format($reservation->car->price_per_day,2) }}{{ $currencySymbol }}/day</td></tr>
            </table>
            @if($reservation->car->options)
                <div class="fs-90 mb-0"><span class="fw-600">Options:</span>
                    {{ implode(', ', $reservation->car->options) }}
                </div>
            @endif
        </div>

        <div class="col-6">
            <h5 class="mb-1">Customer</h5>
            <table>
                <tr><td class="ps-0">Name</td><td>{{ $reservation->customer_name }}</td></tr>
                <tr><td class="ps-0">Email</td><td>{{ $reservation->customer_email }}</td></tr>
                <tr><td class="ps-0">Phone</td><td>{{ $reservation->customer_phone }}</td></tr>
                @if($reservation->customer_flight_number)
                <tr><td class="ps-0">Flight</td><td>{{ $reservation->customer_flight_number }}</td></tr>
                @endif
            </table>
        </div>

    </div>

    <!-- Special requests -->
    @if($reservation->special_requests)
        <h5 class="mb-1">Special requests</h5>
        <div class="fs-90 mb-3">{{ $reservation->special_requests }}</div>
    @endif

    <!-- Pricing -->
    <h5 class="mb-1">Pricing</h5>
    <table>
        <tbody>
        <tr>
            <td class="ps-0">Base ({{ $reservation->days }} days)</td>
            <td class="text-end">
                {{ number_format($reservation->car->price_per_day * $reservation->days, 2) }}{{ $currencySymbol }}
            </td>
        </tr>

        @php($extras = json_decode($reservation->extras, true) ?? [])
        @if(count($extras))
            <tr>
                <td class="ps-0">Extras</td>
                <td class="text-end">
                    {{ number_format($reservation->extras_total, 2) }}{{ $currencySymbol }}
                </td>
            </tr>
            @foreach($extras as $e)
                <tr class="fs-90 muted">
                    <td class="ps-4">{{ $e['name'] }}</td>
                    <td class="text-end">{{ number_format($e['total'],2) }}{{ $currencySymbol }}</td>
                </tr>
            @endforeach
        @endif

        <tr class="fw-600">
            <td class="ps-0">Total amount</td>
            <td class="text-end">
                {{ number_format($reservation->total_price, 2) }}{{ $currencySymbol }}
            </td>
        </tr>
        </tbody>
    </table>

    <div class="fs-90 muted mt-3 mb-3">
        📩 We’ll contact you shortly to confirm your reservation by email or WhatsApp.
        <br>
        Please bring this confirmation and a valid driver’s licence when collecting your vehicle.
    </div>

    <hr class="mb-2 footer">
    <div class="fs-90 muted footer">
        {{ $companyName ?: 'Grey Cars Rental Co.' }}
        @if($companyAddress)
            <br>{{ $companyAddress }}
        @endif
        @if($companyPhone)
            <br>Phone: {{ $companyPhone }}
        @endif
        @if($companyWhatsapp)
            <br>WhatsApp: {{ $companyWhatsapp }}
        @endif
        @if($companyEmail)
            <br>Email: {{ $companyEmail }}
        @endif
        @if($companyWebsite)
            <br>Website: {{ $companyWebsite }}
        @endif
    </div>

</div>

<script>
    window.onload = () => { window.print(); window.onafterprint = () => window.close(); };
</script>

</body>
</html>
