@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Ringkasan sistem e-learning')

@push('styles')
<style>
    /* Color Variables */
    :root {
        --primary: #A8DF8E;
        --primary-dark: #8bc76d;
        --primary-light: #c5ebb3;
        --secondary: #FFD8DF;
        --accent: #FFAAB8;
        --light-bg: #F0FFDF;
    }

    body {
        background-color: var(--light-bg);
    }

    /* Override Bootstrap primary color */
    .bg-primary {
        background-color: var(--primary) !important;
    }

    .text-primary {
        color: var(--primary-dark) !important;
    }

    .btn-primary {
        background-color: var(--primary);
        border-color: var(--primary);
        color: #2d3748;
    }

    .btn-primary:hover {
        background-color: var(--primary-dark);
        border-color: var(--primary-dark);
        color: #2d3748;
    }

    .badge.bg-primary {
        background-color: var(--primary) !important;
        color: #2d3748;
    }

    /* Custom colors */
    .bg-accent {
        background-color: var(--accent) !important;
    }

    .bg-secondary-custom {
        background-color: var(--secondary) !important;
    }

    .text-accent {
        color: var(--accent) !important;
    }

    /* Card hover effect */
    .card:hover {
        transform: translateY(-5px);
        transition: all 0.3s;
    }

    /* Stat card borders */
    .border-start-primary {
        border-left: 4px solid var(--primary) !important;
    }

    .border-start-accent {
        border-left: 4px solid var(--accent) !important;
    }

    .border-start-secondary {
        border-left: 4px solid var(--secondary) !important;
    }

    .border-start-warning {
        border-left: 4px solid #FFE5A8 !important;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <!-- Statistics Cards -->
    <div class="row g-4 mb-4">
        <!-- Total Siswa -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100 border-start-primary">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-3 p-3" style="background: linear-gradient(135deg, #A8DF8E 0%, #8bc76d 100%);">
                            <i class="bi bi-people fs-2 text-dark"></i>
                        </div>
                    </div>
                    <h2 class="fw-bold mb-1">{{ $totalStudents }}</h2>
                    <p class="text-muted mb-0">Total Siswa</p>
                </div>
            </div>
        </div>

        <!-- Total Guru -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100 border-start-accent">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-3 p-3" style="background: linear-gradient(135deg, #FFAAB8 0%, #ff8a9d 100%);">
                            <i class="bi bi-person-workspace fs-2 text-white"></i>
                        </div>
                    </div>
                    <h2 class="fw-bold mb-1">{{ $totalTeachers }}</h2>
                    <p class="text-muted mb-0">Total Guru</p>
                </div>
            </div>
        </div>

        <!-- Total Mata Pelajaran -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100 border-start-secondary">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-3 p-3" style="background: linear-gradient(135deg, #FFD8DF 0%, #ffb8c4 100%);">
                            <i class="bi bi-journal-code fs-2 text-dark"></i>
                        </div>
                    </div>
                    <h2 class="fw-bold mb-1">{{ $totalCourses }}</h2>
                    <p class="text-muted mb-0">Total Mata Pelajaran</p>
                </div>
            </div>
        </div>

        <!-- Total Tugas -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100 border-start-warning">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-3 p-3" style="background: linear-gradient(135deg, #FFE5A8 0%, #FFD700 100%);">
                            <i class="bi bi-file-text fs-2 text-dark"></i>
                        </div>
                    </div>
                    <h2 class="fw-bold mb-1">{{ $totalAssignments }}</h2>
                    <p class="text-muted mb-0">Total Tugas</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Secondary Stats -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-person-check fs-1" style="color: #A8DF8E;"></i>
                    <h4 class="mt-2 mb-0 fw-bold">{{ $totalEnrollments }}</h4>
                    <small class="text-muted">Total Pendaftaran Aktif</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-shield-check fs-1" style="color: #FFAAB8;"></i>
                    <h4 class="mt-2 mb-0 fw-bold">{{ $totalAdmins }}</h4>
                    <small class="text-muted">Total Admin</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-calendar-check fs-1" style="color: #FFD8DF;"></i>
                    <h4 class="mt-2 mb-0 fw-bold">{{ array_sum($todayAttendance) }}</h4>
                    <small class="text-muted">Kehadiran Hari Ini</small>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Left Column -->
        <div class="col-lg-8">
            <!-- Kehadiran Hari Ini -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title mb-4">
                        <i class="bi bi-calendar-check me-2" style="color: #A8DF8E;"></i>
                        Kehadiran Hari Ini
                    </h5>
                    <div class="row g-3 text-center">
                        <div class="col-3">
                            <div class="p-3 rounded-3" style="background: linear-gradient(135deg, #c5ebb3 0%, #A8DF8E 100%);">
                                <h3 class="fw-bold mb-0 text-dark">{{ $todayAttendance['hadir'] }}</h3>
                                <small class="text-dark">Hadir</small>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="p-3 rounded-3" style="background: linear-gradient(135deg, #FFF5E0 0%, #FFE5A8 100%);">
                                <h3 class="fw-bold mb-0 text-dark">{{ $todayAttendance['izin'] }}</h3>
                                <small class="text-dark">Izin</small>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="p-3 rounded-3" style="background: linear-gradient(135deg, #fff0f3 0%, #FFD8DF 100%);">
                                <h3 class="fw-bold mb-0 text-dark">{{ $todayAttendance['sakit'] }}</h3>
                                <small class="text-dark">Sakit</small>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="p-3 rounded-3" style="background: linear-gradient(135deg, #ffe0e6 0%, #ffc9d3 100%);">
                                <h3 class="fw-bold mb-0 text-dark">{{ $todayAttendance['alpha'] }}</h3>
                                <small class="text-dark">Alpha</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Popular Courses -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title mb-4">
                        <i class="bi bi-graph-up me-2" style="color: #FFAAB8;"></i>
                        Mata Pelajaran Terpopuler
                    </h5>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light" style="background: linear-gradient(135deg, #A8DF8E 0%, #c5ebb3 100%);">
                                <tr>
                                    <th class="fw-semibold">Mata Pelajaran</th>
                                    <th class="fw-semibold">Kode</th>
                                    <th class="fw-semibold">Guru</th>
                                    <th class="fw-semibold">Siswa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($popularCourses as $course)
                                <tr>
                                    <td class="fw-semibold">{{ $course->name }}</td>
                                    <td>
                                        <span class="badge rounded-pill" style="background-color: #A8DF8E; color: #2d3748;">
                                            {{ $course->code }}
                                        </span>
                                    </td>
                                    <td>{{ $course->teacher->name }}</td>
                                    <td>
                                        <span class="badge rounded-pill" style="background-color: #FFAAB8; color: white;">
                                            {{ $course->enrollments_count }} siswa
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Recent Activities -->
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-4">
                        <i class="bi bi-clock-history me-2" style="color: #FFD8DF;"></i>
                        Aktivitas Terbaru
                    </h5>
                    <div class="list-group list-group-flush">
                        @forelse($recentActivities as $activity)
                        <div class="list-group-item border-0 px-0">
                            <div class="d-flex align-items-start">
                                <div class="flex-shrink-0">
                                    <div class="rounded-circle p-2" style="background-color: #F0FFDF;">
                                        @if($activity->action === 'create')
                                        <i class="bi bi-plus-circle" style="color: #A8DF8E;"></i>
                                        @elseif($activity->action === 'update')
                                        <i class="bi bi-pencil" style="color: #FFD8DF;"></i>
                                        @elseif($activity->action === 'delete')
                                        <i class="bi bi-trash" style="color: #FFAAB8;"></i>
                                        @else
                                        <i class="bi bi-dot text-secondary"></i>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <p class="mb-1">
                                        <strong>{{ $activity->user->name ?? 'System' }}</strong>
                                        {{ $activity->description }}
                                    </p>
                                    <small class="text-muted">
                                        <i class="bi bi-clock me-1"></i>
                                        {{ $activity->created_at->diffForHumans() }}
                                    </small>
                                </div>
                            </div>
                        </div>
                        @empty
                        <p class="text-muted text-center py-3">Belum ada aktivitas</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div class="col-lg-4">
            <!-- Quick Actions -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title mb-4">
                        <i class="bi bi-lightning me-2" style="color: #FFE5A8;"></i>
                        Quick Actions
                    </h5>
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.users.create') }}" class="btn btn-lg" style="background: linear-gradient(135deg, #A8DF8E 0%, #8bc76d 100%); border: none; color: #2d3748;">
                            <i class="bi bi-plus-circle me-2"></i>Tambah User Baru
                        </a>
                        <a href="{{ route('admin.courses.index') }}" class="btn btn-lg" style="background: linear-gradient(135deg, #FFAAB8 0%, #ff8a9d 100%); border: none; color: white;">
                            <i class="bi bi-journal-plus me-2"></i>Kelola Mata Pelajaran
                        </a>
                        <a href="{{ route('admin.announcements.create') }}" class="btn btn-lg" style="background: linear-gradient(135deg, #FFD8DF 0%, #ffb8c4 100%); border: none; color: #2d3748;">
                            <i class="bi bi-megaphone me-2"></i>Buat Pengumuman
                        </a>
                        <a href="{{ route('admin.reports.index') }}" class="btn btn-lg" style="background: linear-gradient(135deg, #FFE5A8 0%, #FFD700 100%); border: none; color: #2d3748;">
                            <i class="bi bi-file-earmark-text me-2"></i>Lihat Laporan
                        </a>
                    </div>
                </div>
            </div>

            <!-- Recent Users -->
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-4">
                        <i class="bi bi-person-plus me-2" style="color: #A8DF8E;"></i>
                        User Terbaru
                    </h5>
                    @foreach($recentUsers as $user)
                    <div class="d-flex align-items-center mb-3 p-2 rounded-3" style="background-color: #F0FFDF;">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=A8DF8E&color=2d3748"
                            class="rounded-circle me-3"
                            style="width: 40px; height: 40px;"
                            alt="User">
                        <div class="flex-grow-1">
                            <h6 class="mb-0">{{ $user->name }}</h6>
                            <small class="text-muted">{{ ucfirst($user->role) }}</small>
                        </div>
                        <small class="text-muted">{{ $user->created_at->diffForHumans() }}</small>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
