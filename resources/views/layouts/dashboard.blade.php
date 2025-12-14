<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <!-- Bootstrap 5.3 CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->

    <!-- Font Awesome -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->

    <!-- Custom styles -->
    <style>
    :root {
        --dash-sidebar-expanded: 260px;
        --dash-sidebar-collapsed: 76px;
        --dash-surface: #0b1220;
        --dash-surface-2: rgba(255, 255, 255, 0.06);
        --dash-border: rgba(255, 255, 255, 0.10);
    }

    body {
        overflow-x: hidden;
        background: #f6f7fb;
    }

    .dash-shell {
        min-height: 100vh;
        display: flex;
    }

    .dash-sidebar {
        width: var(--dash-sidebar-expanded);
        background: radial-gradient(1200px 900px at 10% 10%, rgba(13, 110, 253, 0.22), transparent 50%),
            linear-gradient(180deg, #0b1220 0%, #0b1220 100%);
        color: rgba(255, 255, 255, 0.92);
        border-right: 1px solid var(--dash-border);
        position: sticky;
        top: 0;
        height: 100vh;
        flex: 0 0 auto;
    }

    .dash-sidebar .brand {
        height: 64px;
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 0 18px;
        border-bottom: 1px solid var(--dash-border);
    }

    .dash-sidebar .brand .logo {
        width: 34px;
        height: 34px;
        border-radius: 10px;
        display: grid;
        place-items: center;
        background: rgba(255, 255, 255, 0.10);
        border: 1px solid rgba(255, 255, 255, 0.16);
    }

    .dash-nav {
        padding: 12px;
    }

    .dash-nav .nav-item {
        display: flex;
        align-items: center;
        gap: 12px;
        width: 100%;
        padding: 10px 12px;
        border-radius: 12px;
        color: rgba(255, 255, 255, 0.86);
        text-decoration: none;
        border: 1px solid transparent;
    }

    .dash-nav .nav-item:hover {
        background: rgba(255, 255, 255, 0.08);
        border-color: rgba(255, 255, 255, 0.10);
    }

    .dash-nav .nav-item.active {
        background: rgba(13, 110, 253, 0.18);
        border-color: rgba(13, 110, 253, 0.35);
        color: #ffffff;
    }

    .dash-nav .nav-icon {
        width: 32px;
        height: 32px;
        border-radius: 10px;
        display: grid;
        place-items: center;
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.10);
        flex: 0 0 auto;
    }

    .dash-main {
        flex: 1 1 auto;
        min-width: 0;
        display: flex;
        flex-direction: column;
    }

    .dash-topbar {
        height: 64px;
        background: rgba(255, 255, 255, 0.75);
        backdrop-filter: blur(10px);
        border-bottom: 1px solid rgba(0, 0, 0, 0.06);
        display: flex;
        align-items: center;
    }

    .dash-content {
        padding: 18px;
    }

    .dash-card {
        background: #ffffff;
        border: 1px solid rgba(0, 0, 0, 0.06);
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.06);
    }

    .dash-card-header {
        padding: 14px 16px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.06);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
    }

    .dash-card-body {
        padding: 16px;
    }

    .dash-table thead th {
        font-weight: 600;
        color: rgba(0, 0, 0, 0.65);
        border-bottom-color: rgba(0, 0, 0, 0.06) !important;
    }

    .dash-table tbody td {
        border-top-color: rgba(0, 0, 0, 0.06) !important;
        vertical-align: middle;
    }

    .dash-sidebar-collapsed .dash-sidebar {
        width: var(--dash-sidebar-collapsed);
    }

    .dash-sidebar-collapsed .dash-sidebar .brand .title,
    .dash-sidebar-collapsed .dash-nav .nav-text {
        display: none;
    }

    .dash-sidebar-collapsed .dash-sidebar .brand {
        justify-content: center;
        padding: 0;
    }

    .dash-sidebar-collapsed .dash-nav {
        padding: 12px 10px;
    }

    .dash-sidebar-collapsed .dash-nav .nav-item {
        justify-content: center;
        padding: 10px;
    }

    @media (max-width: 991.98px) {
        .dash-sidebar {
            position: fixed;
            z-index: 1040;
            transform: translateX(-100%);
            transition: transform 200ms ease;
        }

        .dash-sidebar-open .dash-sidebar {
            transform: translateX(0);
        }

        .dash-sidebar-open::before {
            content: "";
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.35);
            z-index: 1039;
        }
    }
    </style>

    @stack('styles')
</head>

<body>

    <div class="dash-shell" id="dash-shell">

        <aside class="dash-sidebar">
            <div class="brand">
                <div class="logo">
                    <i class="bi bi-speedometer2"></i>
                </div>
                <div class="title fw-semibold">
                    {{ config('app.name', 'Laravel') }}
                </div>
            </div>

            <nav class="dash-nav">
                <a href="{{ route('admin.cars.index') }}"
                    class="nav-item @if (request()->routeIs('admin.cars.*')) active @endif">
                    <span class="nav-icon"><i class="bi bi-car-front"></i></span>
                    <span class="nav-text">Cars</span>
                </a>
                <a href="{{ route('admin.reservations.index') }}"
                    class="nav-item @if (request()->routeIs('admin.reservations.*')) active @endif">
                    <span class="nav-icon"><i class="bi bi-receipt"></i></span>
                    <span class="nav-text">Reservations</span>
                </a>
            </nav>
        </aside>

        <div class="dash-main">
            <header class="dash-topbar">
                <div class="container-fluid d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-2">
                        <button type="button" class="btn btn-outline-primary btn-sm" id="dash-sidebar-toggle">
                            <i class="bi bi-list"></i>
                        </button>
                        <div class="d-none d-md-block fw-semibold text-dark">
                            Admin
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-2">
                        <div class="dropdown">
                            <button class="btn btn-light btn-sm border dropdown-toggle" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle me-1"></i>
                                Account
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.password.change') }}">
                                        <i class="bi bi-shield-check me-2"></i>Change password
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('admin.logout') }}" onsubmit="return confirm('Are you sure you want to logout?');">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>

            <main class="dash-content">
                <div class="container-fluid">
                    @if (session('success'))
                        <div class="alert alert-success d-flex align-items-center" role="alert">
                            <i class="bi bi-check-circle me-2"></i>
                            <div>{{ session('success') }}</div>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            <div>{{ session('error') }}</div>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap 5.3 Bundle JS -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> -->

    @stack('scripts')
    <script>
    const dashShell = document.getElementById('dash-shell');
    const sidebarToggle = document.getElementById('dash-sidebar-toggle');

    if (sidebarToggle && dashShell) {
        sidebarToggle.addEventListener('click', function() {
            if (window.matchMedia('(max-width: 991.98px)').matches) {
                dashShell.classList.toggle('dash-sidebar-open');
                return;
            }

            dashShell.classList.toggle('dash-sidebar-collapsed');
        });

        document.addEventListener('click', function(e) {
            if (!dashShell.classList.contains('dash-sidebar-open')) {
                return;
            }

            const sidebar = dashShell.querySelector('.dash-sidebar');
            if (sidebar && !sidebar.contains(e.target) && e.target !== sidebarToggle) {
                dashShell.classList.remove('dash-sidebar-open');
            }
        });
    }
    </script>
</body>

</html>