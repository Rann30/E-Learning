<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel - E-Learning')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
            width: 260px;
            background: linear-gradient(180deg, #1e293b 0%, #0f172a 100%);
            padding-top: 0;
            z-index: 1000;
            overflow-y: auto;
            transition: all 0.3s;
        }

        .sidebar-header {
            color: white;
            text-align: center;
            padding: 25px 20px;
            font-size: 22px;
            font-weight: bold;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(0, 0, 0, 0.2);
        }

        .sidebar-subtext {
            font-size: 11px;
            font-weight: normal;
            margin-top: 5px;
            opacity: 0.8;
        }

        .admin-badge {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 11px;
            margin-top: 10px;
            display: inline-block;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .menu-section {
            color: #94a3b8;
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
            color: #cbd5e1;
            text-decoration: none;
            transition: all 0.3s;
            border-left: 3px solid transparent;
        }

        .sidebar-menu li a:hover,
        .sidebar-menu li a.active {
            background-color: rgba(59, 130, 246, 0.1);
            border-left: 3px solid #3b82f6;
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
            background-color: #dc2626;
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
            background-color: #b91c1c;
        }

        /* Main Content */
        .main-content {
            margin-left: 260px;
            padding: 20px;
            min-height: 100vh;
        }

        /* Top Bar */
        .top-bar {
            background: white;
            padding: 20px 30px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .top-bar h4 {
            margin: 0;
            color: #1e293b;
            font-weight: 600;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #3b82f6;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                left: -260px;
            }

            .sidebar.active {
                left: 0;
            }

            .main-content {
                margin-left: 0;
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
            <i class="bi bi-shield-check"></i> ADMIN PANEL
            <div class="sidebar-subtext">SMART BM3 Management</div>
            <span class="admin-badge">
                <i class="bi bi-star me-1"></i>Administrator
            </span>
        </div>

        <ul class="sidebar-menu">
            <li class="menu-section">MAIN</li>
            <li>
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="menu-section">USER MANAGEMENT</li>
            <li>
                <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="bi bi-people"></i>
                    <span>Kelola User</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.students.index') }}" class="{{ request()->routeIs('admin.students.*') ? 'active' : '' }}">
                    <i class="bi bi-person-badge"></i>
                    <span>Data Siswa</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.teachers.index') }}" class="{{ request()->routeIs('admin.teachers.*') ? 'active' : '' }}">
                    <i class="bi bi-person-workspace"></i>
                    <span>Data Guru</span>
                </a>
            </li>

            <li class="menu-section">ACADEMIC</li>
            <li>
                <a href="{{ route('admin.courses.index') }}" class="{{ request()->routeIs('admin.courses.*') ? 'active' : '' }}">
                    <i class="bi bi-journal-code"></i>
                    <span>Kelola Kursus</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.enrollments.index') }}" class="{{ request()->routeIs('admin.enrollments.*') ? 'active' : '' }}">
                    <i class="bi bi-clipboard-check"></i>
                    <span>Enrollment</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.assignments.index') }}" class="{{ request()->routeIs('admin.assignments.*') ? 'active' : '' }}">
                    <i class="bi bi-file-text"></i>
                    <span>Tugas</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.schedules.index') }}" class="{{ request()->routeIs('admin.schedules.*') ? 'active' : '' }}">
                    <i class="bi bi-calendar-week"></i>
                    <span>Jadwal</span>
                </a>
            </li>

            <li class="menu-section">ATTENDANCE</li>
            <li>
                <a href="{{ route('admin.attendances.index') }}" class="{{ request()->routeIs('admin.attendances.*') ? 'active' : '' }}">
                    <i class="bi bi-calendar-check"></i>
                    <span>Kehadiran</span>
                </a>
            </li>

            <li class="menu-section">VIOLATION</li>
            <li>
                <a href="{{ route('admin.violations.index') }}" class="{{ request()->routeIs('admin.violations.*') ? 'active' : '' }}">
                    <i class="bi bi-exclamation-triangle"></i>
                    <span>Kartu Pelanggaran</span>
                </a>
            </li>

            <li class="menu-section">COMMUNICATION</li>
            <li>
                <a href="{{ route('admin.announcements.index') }}" class="{{ request()->routeIs('admin.announcements.*') ? 'active' : '' }}">
                    <i class="bi bi-megaphone"></i>
                    <span>Pengumuman</span>
                </a>
            </li>

            <li class="menu-section">REPORTS</li>
            <li>
                <a href="{{ route('admin.reports.index') }}" class="{{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
                    <i class="bi bi-bar-chart"></i>
                    <span>Laporan</span>
                </a>
            </li>

            <li class="menu-section">SYSTEM</li>
            <li>
                <a href="{{ route('admin.settings') }}" class="{{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                    <i class="bi bi-gear"></i>
                    <span>Pengaturan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.logs') }}" class="{{ request()->routeIs('admin.logs') ? 'active' : '' }}">
                    <i class="bi bi-clock-history"></i>
                    <span>Activity Logs</span>
                </a>
            </li>
        </ul>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="bi bi-box-arrow-right me-2"></i>
                <span>Logout</span>
            </button>
        </form>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Bar -->
        <div class="top-bar">
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-link d-md-none" onclick="toggleSidebar()">
                    <i class="bi bi-list" style="font-size: 24px;"></i>
                </button>
                <div>
                    <h4>@yield('page-title', 'Dashboard')</h4>
                    <small class="text-muted">@yield('page-subtitle', 'Kelola sistem e-learning')</small>
                </div>
            </div>

            <div class="user-info">
                <button class="btn btn-light" onclick="toggleFullscreen()">
                    <i class="bi bi-fullscreen"></i>
                </button>
                <button class="btn btn-light">
                    <i class="bi bi-bell"></i>
                    <span class="badge bg-danger">3</span>
                </button>
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=3b82f6&color=fff"
                    alt="Admin" class="user-avatar">
                <div>
                    <h6 class="mb-0" style="font-size: 14px;">{{ Auth::user()->name }}</h6>
                    <small class="text-muted">Administrator</small>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('active');
            document.getElementById('overlay').classList.toggle('active');
        }

        function toggleFullscreen() {
            if (!document.fullscreenElement) {
                document.documentElement.requestFullscreen();
            } else {
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                }
            }
        }
    </script>

    @stack('scripts')
</body>

</html>