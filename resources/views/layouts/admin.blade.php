<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') - SIPANDA </title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        :root {
            --primary: #A8DF8E;
            --primary-dark: #8bc76d;
            --primary-light: #c5ebb3;
            --secondary: #FFD8DF;
            --secondary-dark: #ffb8c4;
            --accent: #FFAAB8;
            --accent-dark: #ff8a9d;
            --light-bg: #F0FFDF;
            --white: #ffffff;
            --dark: #2d3748;
        }

        body {
            background-color: var(--light-bg);
            color: var(--dark);
        }

        /* Navbar Styling */
        .navbar-custom {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            box-shadow: 0 2px 10px rgba(168, 223, 142, 0.3);
        }

        .navbar-brand {
            color: var(--dark) !important;
            font-weight: 700;
            font-size: 1.25rem;
            transition: all 0.3s;
        }

        .navbar-brand:hover {
            transform: scale(1.05);
        }

        .navbar-nav .nav-link {
            color: var(--dark) !important;
            font-weight: 500;
            transition: all 0.3s;
            border-radius: 8px;
            padding: 8px 15px !important;
        }

        .navbar-nav .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .dropdown-item {
            padding: 10px 20px;
            transition: all 0.3s;
        }

        .dropdown-item:hover {
            background-color: var(--light-bg);
            transform: translateX(5px);
        }

        /* Sidebar Styling */
        .sidebar {
            background: linear-gradient(180deg, var(--white) 0%, var(--light-bg) 100%);
            min-height: calc(100vh - 56px);
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
        }

        .sidebar .nav-link {
            color: var(--dark);
            border-radius: 10px;
            margin: 5px 10px;
            padding: 12px 15px;
            transition: all 0.3s;
            font-weight: 500;
        }

        .sidebar .nav-link:hover {
            background-color: #fff0f3;
            color: var(--accent-dark);
            transform: translateX(5px);
        }

        .sidebar .nav-link.active {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: var(--dark);
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(168, 223, 142, 0.3);
        }

        .sidebar .nav-link i {
            font-size: 1.1rem;
        }

        /* Card Styling */
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            transition: all 0.3s;
            background-color: var(--white);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
        }

        /* Alert Styling */
        .alert {
            border-radius: 10px;
            border: none;
        }

        .alert-success-custom {
            background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary) 100%);
            color: var(--dark);
        }

        /* Button Styling */
        .btn-primary-custom {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border: none;
            color: var(--dark);
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(168, 223, 142, 0.4);
        }

        .btn-accent-custom {
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-dark) 100%);
            border: none;
            color: var(--white);
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-accent-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 170, 184, 0.4);
        }

        /* Main Content */
        main {
            padding-bottom: 50px;
        }

        .page-header {
            border-bottom: 2px solid var(--primary-light) !important;
            margin-bottom: 30px;
        }

        /* Footer */
        footer {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: var(--dark);
            box-shadow: 0 -2px 10px rgba(168, 223, 142, 0.3);
        }

        /* Scrollbar Styling */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: var(--light-bg);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary);
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-dark);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                top: 56px;
                left: -100%;
                width: 250px;
                z-index: 1000;
                transition: left 0.3s;
            }

            .sidebar.show {
                left: 0;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-custom sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                <i class="bi bi-mortarboard-fill me-2"></i>
                SIPANDA
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">
                            <i class="bi bi-house-door me-1"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">

                            <li>

                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        Logout
                                    </button>
                                </form>


                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 d-md-block sidebar">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                                href="{{ route('admin.dashboard') }}">
                                <i class="bi bi-speedometer2 me-2"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}"
                                href="{{ route('admin.users.index') }}">
                                <i class="bi bi-people me-2"></i>
                                Users
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.courses.*') ? 'active' : '' }}"
                                href="{{ route('admin.courses.index') }}">
                                <i class="bi bi-journal-code me-2"></i>
                                Mata Pelajaran
                            </a>
                        </li>





                    </ul>

                    <hr class="my-3" style="border-color: var(--primary-light);">


                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-10 ms-sm-auto px-md-4">
                <!-- Page Header -->
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 page-header">
                    <div>
                        <h1 class="h2 text-dark fw-bold">@yield('page-title', 'Dashboard')</h1>
                        <p class="text-muted mb-0">@yield('page-subtitle', '')</p>
                    </div>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        @yield('page-actions')
                    </div>
                </div>

                <!-- Alerts -->
                @if(session('success'))
                <div class="alert alert-dismissible fade show shadow-sm"
                    style="background: linear-gradient(135deg, #c5ebb3 0%, #A8DF8E 100%); border: none; color: #2d3748;"
                    role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <strong>Berhasil!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show shadow-sm"
                    style="border: none;"
                    role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <strong>Error!</strong> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                @if(session('warning'))
                <div class="alert alert-dismissible fade show shadow-sm"
                    style="background: linear-gradient(135deg, #FFF5E0 0%, #FFE5A8 100%); border: none; color: #2d3748;"
                    role="alert">
                    <i class="bi bi-exclamation-circle-fill me-2"></i>
                    <strong>Peringatan!</strong> {{ session('warning') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                @if(session('info'))
                <div class="alert alert-dismissible fade show shadow-sm"
                    style="background: linear-gradient(135deg, #fff0f3 0%, #FFD8DF 100%); border: none; color: #2d3748;"
                    role="alert">
                    <i class="bi bi-info-circle-fill me-2"></i>
                    <strong>Info!</strong> {{ session('info') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                <!-- Content -->
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Footer -->
    <footer class="mt-5 py-4 text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p class="mb-1 fw-bold">
                        <i class="bi bi-mortarboard-fill me-2"></i>
                        SIPANDA - Sistem Informasi Akademik Terpadu
                    </p>
                    <p class="mb-0 small">&copy; {{ date('Y') }} All rights reserved. Made with
                        <i class="bi bi-heart-fill text-danger"></i> for a better education.
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom Scripts -->
    <script>
        // Auto dismiss alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                setTimeout(function() {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 5000);
            });
        });

        // Mobile sidebar toggle
        const sidebarToggle = document.querySelector('.navbar-toggler');
        const sidebar = document.querySelector('.sidebar');

        if (window.innerWidth <= 768) {
            sidebarToggle?.addEventListener('click', function() {
                sidebar?.classList.toggle('show');
            });
        }
    </script>

    @stack('scripts')

</body>

</html>