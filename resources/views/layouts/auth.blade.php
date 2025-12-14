<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        body {
            min-height: 100vh;
            background: radial-gradient(1200px 900px at 10% 10%, rgba(13, 110, 253, 0.18), transparent 55%),
                radial-gradient(900px 700px at 90% 20%, rgba(236, 72, 153, 0.10), transparent 55%),
                #070a10;
            color: rgba(255, 255, 255, 0.92);
        }

        .auth-card {
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 18px;
            backdrop-filter: blur(10px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.55);
        }

        .auth-muted {
            color: rgba(255, 255, 255, 0.70) !important;
        }

        .auth-link {
            color: rgba(255, 255, 255, 0.80);
        }

        .auth-link:hover {
            color: #ffffff;
        }

        .form-control,
        .form-select {
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.16);
            color: rgba(255, 255, 255, 0.92);
        }

        .form-control:focus,
        .form-select:focus {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(13, 110, 253, 0.55);
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
            color: rgba(255, 255, 255, 0.92);
        }

        .input-group-text {
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.16);
            color: rgba(255, 255, 255, 0.75);
        }

        .dropdown-menu {
            background: #0b1220;
            border: 1px solid rgba(255, 255, 255, 0.10);
        }

        .dropdown-item {
            color: rgba(255, 255, 255, 0.85);
        }

        .dropdown-item:hover {
            background: rgba(255, 255, 255, 0.08);
            color: #ffffff;
        }

        .invalid-feedback {
            display: block;
        }
    </style>

    @stack('styles')
</head>

<body>
    @yield('content')

    @stack('scripts')
</body>

</html>
