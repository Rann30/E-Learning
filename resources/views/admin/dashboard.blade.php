@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Ringkasan sistem e-learning')

@push('styles')
<style>
    .stat-card {
        background: white;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        transition: all 0.3s;
        border-left: 4px solid;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        margin-bottom: 15px;
    }

    .stat-value {
        font-size: 32px;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .stat-label {
        color: #6b7280;
        font-size: 14px;
    }

    .activity-item {
        padding: 12px 0;
        border-bottom: 1px solid #e5e7eb;
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .chart-container {
        background: white;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card" style="border-left-color: #3b82f6;">
                <div class="stat-icon" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                    <i class="bi bi-people"></i>
                </div>
                <div class="stat-value text-primary">{{ $totalStudents }}</div>
                <div class="stat-label">Total Siswa</div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card" style="border-left-color: #10b981;">
                <div class="stat-icon" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); color: white;">
                    <i class="bi bi-person-workspace"></i>
                </div>
                <div class="stat-value text-success">{{ $totalTeachers }}</div>
                <div class="stat-label">Total Guru</div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card" style="border-left-color: #f59e0b;">
                <div class="stat-icon" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white;">
                    <i class="bi bi-journal-code"></i>
                </div>
                <div class="stat-value text-warning">{{ $totalCourses }}</div>
                <div class="stat-label">Total Mata Pelajaran</div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card" style="border-left-color: #8b5cf6;">
                <div class="stat-icon" style="background: linear-gradient(135deg, #a18cd1 0%, #fbc2eb 100%); color: white;">
                    <i class="bi bi-file-text"></i>
                </div>
                <div class="stat-value text-purple">{{ $totalAssignments }}</div>
                <div class="stat-label">Total Tugas</div>
            </div>
        </div>
    </div>

    <!-- Secondary Stats -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <i class="bi bi-person-check text-success" style="font-size: 36px;"></i>
                    <h4 class="mt-2 mb-0">{{ $totalEnrollments }}</h4>
                    <small class="text-muted">Total Pendaftaran Aktif</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <i class="bi bi-shield-check text-success" style="font-size: 36px;"></i>
                    <h4 class="mt-2 mb-0">{{ $totalAdmins }}</h4>
                    <small class="text-muted">Total Admin</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <i class="bi bi-calendar-check text-info" style="font-size: 36px;"></i>
                    <h4 class="mt-2 mb-0">{{ array_sum($todayAttendance) }}</h4>
                    <small class="text-muted">Kehadiran Hari Ini</small>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Left Column -->
        <div class="col-lg-8">
            <!-- Kehadiran Hari Ini -->
            <div class="chart-container mb-4">
                <h5 class="mb-3">
                    <i class="bi bi-calendar-check text-primary me-2"></i>
                    Kehadiran Hari Ini
                </h5>
                <div class="row text-center">
                    <div class="col-3">
                        <div class="p-3" style="background: #d1fae5; border-radius: 10px;">
                            <h3 class="text-success mb-0">{{ $todayAttendance['hadir'] }}</h3>
                            <small>Hadir</small>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="p-3" style="background: #fef3c7; border-radius: 10px;">
                            <h3 class="text-warning mb-0">{{ $todayAttendance['izin'] }}</h3>
                            <small>Izin</small>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="p-3" style="background: #dbeafe; border-radius: 10px;">
                            <h3 class="text-info mb-0">{{ $todayAttendance['sakit'] }}</h3>
                            <small>Sakit</small>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="p-3" style="background: #fee2e2; border-radius: 10px;">
                            <h3 class="text-danger mb-0">{{ $todayAttendance['alpha'] }}</h3>
                            <small>Alpha</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Popular Courses -->
            <div class="chart-container mb-4">
                <h5 class="mb-3">
                    <i class="bi bi-graph-up text-success me-2"></i>
                    Mata Pelajaran Terpopuler
                </h5>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Mata Pelajaran</th>
                                <th>Kode</th>
                                <th>Guru</th>
                                <th>Siswa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($popularCourses as $course)
                            <tr>
                                <td><strong>{{ $course->name }}</strong></td>
                                <td><span class="badge bg-primary">{{ $course->code }}</span></td>
                                <td>{{ $course->teacher->name }}</td>
                                <td><span class="badge bg-success">{{ $course->enrollments_count }} siswa</span></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Recent Activities -->
            <div class="chart-container">
                <h5 class="mb-3">
                    <i class="bi bi-clock-history text-info me-2"></i>
                    Aktivitas Terbaru
                </h5>
                @forelse($recentActivities as $activity)
                <div class="activity-item">
                    <div class="d-flex align-items-start">
                        <div class="flex-shrink-0">
                            <div class="rounded-circle bg-light p-2">
                                @if($activity->action === 'create')
                                <i class="bi bi-plus-circle text-success"></i>
                                @elseif($activity->action === 'update')
                                <i class="bi bi-pencil text-primary"></i>
                                @elseif($activity->action === 'delete')
                                <i class="bi bi-trash text-danger"></i>
                                @else
                                <i class="bi bi-dot text-secondary"></i>
                                @endif
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <p class="mb-0">
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
                <p class="text-muted text-center">Belum ada aktivitas</p>
                @endforelse
            </div>
        </div>

        <!-- Right Column -->
        <div class="col-lg-4">
            <!-- Quick Actions -->
            <div class="chart-container mb-4">
                <h5 class="mb-3">
                    <i class="bi bi-lightning text-warning me-2"></i>
                    Quick Actions
                </h5>
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-2"></i>Tambah User Baru
                    </a>
                    <a href="{{ route('admin.courses.index') }}" class="btn btn-success">
                        <i class="bi bi-journal-plus me-2"></i>Kelola Mata Pelajaran
                    </a>
                    <a href="{{ route('admin.announcements.create') }}" class="btn btn-info">
                        <i class="bi bi-megaphone me-2"></i>Buat Pengumuman
                    </a>
                </div>
            </div>

            <!-- Recent Users -->
            <div class="chart-container">
                <h5 class="mb-3">
                    <i class="bi bi-person-plus text-success me-2"></i>
                    User Terbaru
                </h5>
                @foreach($recentUsers as $user)
                <div class="d-flex align-items-center mb-3">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}"
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
@endsection