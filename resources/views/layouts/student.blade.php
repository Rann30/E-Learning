<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'E-Learning - Student')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 250px;
            background: linear-gradient(180deg, #4A5D7E 0%, #3A4D6E 100%);
            padding-top: 0;
            transition: all 0.3s;
            z-index: 1000;
            overflow-y: auto;
        }

        .sidebar-header {
            color: white;
            text-align: center;
            padding: 25px 20px;
            font-size: 24px;
            font-weight: bold;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(0, 0, 0, 0.1);
        }

        .sidebar-subtext {
            font-size: 10px;
            font-weight: normal;
            margin-top: 5px;
            opacity: 0.8;
            line-height: 1.2;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .menu-section {
            color: #9CA3AF;
            font-size: 11px;
            padding: 20px 20px 10px;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            font-weight: 600;
        }

        .sidebar-menu li a {
            display: flex;
            align-items: center;
            padding: 14px 20px;
            color: #E5E7EB;
            text-decoration: none;
            transition: all 0.3s;
            border-left: 3px solid transparent;
        }

        .sidebar-menu li a:hover,
        .sidebar-menu li a.active {
            background-color: rgba(255, 255, 255, 0.1);
            border-left: 3px solid #60A5FA;
            color: #ffffff;
        }

        .sidebar-menu li a i {
            margin-right: 12px;
            font-size: 18px;
            width: 24px;
            text-align: center;
        }

        .logout-btn {
            position: sticky;
            bottom: 0;
            width: 100%;
            background-color: #EF4444;
            color: white;
            border: none;
            padding: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .logout-btn:hover {
            background-color: #DC2626;
        }

        .logout-btn i {
            margin-right: 10px;
        }

        /* Main Content */
        .main-content {
            margin-left: 250px;
            padding: 20px;
            min-height: 100vh;
        }

        /* Top Bar */
        .top-bar {
            background: white;
            padding: 15px 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .top-bar h4 {
            margin: 0;
            color: #4A5D7E;
            font-weight: 600;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .user-details h6 {
            margin: 0;
            font-size: 14px;
            font-weight: 600;
        }

        .user-details p {
            margin: 0;
            font-size: 12px;
            color: #6B7280;
        }

        /* Toggle button untuk mobile */
        .sidebar-toggle {
            display: none;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                left: -250px;
            }

            .sidebar.active {
                left: 0;
            }

            .main-content {
                margin-left: 0;
            }

            .sidebar-toggle {
                display: block;
            }

            .overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                z-index: 999;
            }

            .overlay.active {
                display: block;
            }
        }
    </style>

    @stack('styles')
</head>

<body>
    <!-- Overlay for mobile -->
    <div class="overlay" id="overlay" onclick="toggleSidebar()"></div>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            SIPANDA
            <div class="sidebar-subtext">
                BY SDN Bojong 02 tahun pelajaran2026/2027
            </div>
        </div>

        <ul class="sidebar-menu">
            <li class="menu-section">MENU</li>
            <li>
                <a href="{{ route('student.dashboard') }}" class="{{ request()->routeIs('student.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="menu-section">LMS</li>
            <li>
                <a href="{{ route('student.courses') }}" class="{{ request()->routeIs('student.courses*') ? 'active' : '' }}">
                    <i class="bi bi-book"></i>
                    <span>Ujian</span>
                </a>
            </li>
            <li>
                <a href="{{ route('student.assignments') }}" class="{{ request()->routeIs('student.assignments*') ? 'active' : '' }}">
                    <i class="bi bi-clipboard-check"></i>
                    <span>Tugas Saya</span>
                </a>
            </li>
            <li>
                <a href="{{ route('student.grades') }}" class="{{ request()->routeIs('student.grades') ? 'active' : '' }}">
                    <i class="bi bi-graph-up"></i>
                    <span>Nilai</span>
                </a>
            </li>



            <li class="menu-section">JADWAL</li>
            <li>
                <a href="{{ route('student.schedule') }}" class="{{ request()->routeIs('student.schedule') ? 'active' : '' }}">
                    <i class="bi bi-calendar-event"></i>
                    <span>Jadwal Kelas</span>
                </a>
            </li>



            <li class="menu-section">LAINNYA</li>

            <li>
                <a href="{{ route('student.profile') }}" class="{{ request()->routeIs('student.profile') ? 'active' : '' }}">
                    <i class="bi bi-person-circle"></i>
                    <span>Profile Saya</span>
                </a>
            </li>
        </ul>

        <div class="logout-section">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">
                    <span>🚪</span>
                    Logout
                </button>
            </form>
        </div>
    </div>


    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Bar -->
        <div class="top-bar">
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-link sidebar-toggle d-md-none" onclick="toggleSidebar()">
                    <i class="bi bi-list" style="font-size: 24px;"></i>
                </button>
                <h4>@yield('page-title', 'DASHBOARD')</h4>
            </div>

            <div class="user-info">
                <button class="btn btn-light" onclick="toggleFullscreen()">
                    <i class="bi bi-fullscreen"></i>
                </button>
                <button class="btn btn-light" onclick="toggleDarkMode()">
                    <i class="bi bi-moon"></i>
                </button>
                <img src="{{ Auth::user()->student->photo ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}"
                    alt="User" class="user-avatar">
                <div class="user-details">
                    <h6>{{ Auth::user()->name }}</h6>
                    <p>Student</p>
                </div>
            </div>
        </div>

        <!-- Alert Messages -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <!-- Page Content -->
        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Toggle Sidebar (Mobile)
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        }

        // Toggle Fullscreen
        function toggleFullscreen() {
            if (!document.fullscreenElement) {
                document.documentElement.requestFullscreen();
            } else {
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                }
            }
        }

        // Toggle Dark Mode (Simple)
        function toggleDarkMode() {
            document.body.classList.toggle('dark-mode');
            // Simpan preferensi ke localStorage
            const isDark = document.body.classList.contains('dark-mode');
            localStorage.setItem('darkMode', isDark);
        }

        // Load Dark Mode preference
        window.addEventListener('DOMContentLoaded', () => {
            const darkMode = localStorage.getItem('darkMode');
            if (darkMode === 'true') {
                document.body.classList.add('dark-mode');
            }
        });
    </script>

    @stack('scripts')
</body>

</html>