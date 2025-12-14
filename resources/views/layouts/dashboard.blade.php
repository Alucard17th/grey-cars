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
    body {
        overflow-x: hidden;
    }

    #sidebar-wrapper {
        min-height: 100vh;
        margin-left: -15rem;
        transition: margin 0.25s ease-out;
    }

    #wrapper.toggled #sidebar-wrapper {
        margin-left: 0;
    }

    #page-content-wrapper {
        width: 100%;
    }

    #sidebar-wrapper .list-group {
        width: 15rem;
    }
    </style>

    @stack('styles')
</head>

<body>

    <div class="d-flex" id="wrapper">

        <!-- Sidebar -->
        <div class="border-end bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading border-bottom bg-light text-center py-4">

            </div>
            <div class="list-group list-group-flush">
                <a href=""
                    class="list-group-item list-group-item-action list-group-item-light p-2 @if (request()->routeIs('dashboard')) bg-light text-primary @endif">Dashboard</a>
                <a href="{{ route('admin.cars.index') }}"
                    class="list-group-item list-group-item-action list-group-item-light p-2 @if (request()->routeIs('admin.cars.index')) bg-light text-primary @endif">Cars</a>
                <a href="{{ route('admin.reservations.index') }}"
                    class="list-group-item list-group-item-action list-group-item-light p-2 @if (request()->routeIs('admin.reservations.index')) bg-light text-primary @endif">Reservations</a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page content wrapper -->
        <div id="page-content-wrapper">

            <!-- Top navigation -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <div class="container-fluid">
                    <button class="btn btn-outline-primary" id="menu-toggle"><i class="bi bi-list"></i></button>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Right side of navbar -->
                        <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                            <li class="nav-item">
                                <form method="POST" action=""
                                    onsubmit="return confirm('Are you sure you want to logout?');">
                                    @csrf
                                    <button type="submit" class="link-danger"><i
                                            class="fas fa-sign-out-alt me-2"></i>Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- /Top navigation -->

            <!-- Main content -->
            <main class="container-fluid py-4">
                @yield('content')
            </main>

        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Bootstrap 5.3 Bundle JS -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> -->

    @stack('scripts')
    <script>
    const menuToggle = document.getElementById('menu-toggle');
    const wrapper = document.getElementById('wrapper');

    menuToggle.addEventListener('click', function() {
        wrapper.classList.toggle('toggled');
    });
    </script>
</body>

</html>