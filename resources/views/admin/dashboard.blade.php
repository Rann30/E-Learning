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
        height: 100%;
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
        line-height: 1;
    }

    .stat-label {
        color: #6b7280;
        font-size: 14px;
        font-weight: 500;
    }

    .activity-item {
        padding: 15px 0;
        border-bottom: 1px solid #e5e7eb;
        transition: background-color 0.2s;
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .activity-item:hover {
        background-color: #f9fafb;
        margin: 0 -15px;
        padding-left: 15px;
        padding-right: 15px;
        border-radius: 8px;
    }

    .chart-container {
        background: white;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        margin-bottom: 20px;
    }

    .user-item {
        padding: 12px;
        border-radius: 8px;
        transition: background-color 0.2s;
        margin-bottom: 10px;
    }

    .user-item:hover {
        background-color: #f3f4f6;
    }

    .user-avatar {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        object-fit: cover;
    }

    .quick-action-btn {
        padding: 12px 20px;
        border-radius: 10px;
        font-weight: 500;
        transition: all 0.3s;
    }

    .quick-action-btn:hover {
        transform: translateX(5px);
    }

    .section-title {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
    }

    .section-title i {
        font-size: 20px;
        margin-right: 10px;
    }

    .empty-state {
        padding: 40px 20px;
        text-align: center;
        color: #9ca3af;
    }

    .empty-state i {
        font-size: 48px;
        margin-bottom: 15px;
        opacity: 0.5;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <!-- Statistics Cards -->
    <div class="row mb-4">
        <!-- Total Students -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card" style="border-left-color: #667eea;">
                <div class="stat-icon" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                    <i class="bi bi-people-fill"></i>
                </div>
                <div class="stat-value" style="color: #667eea;">{{ $totalStudents ?? 0 }}</div>
                <div class="stat-label">Total Siswa</div>
            </div>
        </div>

        <!-- Total Teachers -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card" style="border-left-color: #11998e;">
                <div class="stat-icon" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); color: white;">
                    <i class="bi bi-person-workspace"></i>
                </div>
                <div class="stat-value" style="color: #11998e;">{{ $totalTeachers ?? 0 }}</div>
                <div class="stat-label">Total Guru</div>
            </div>
        </div>

        <!-- Total Courses -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card" style="border-left-color: #f093fb;">
                <div class="stat-icon" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white;">
                    <i class="bi bi-journal-bookmark-fill"></i>
                </div>
                <div class="stat-value" style="color: #f093fb;">{{ $totalCourses ?? 0 }}</div>
                <div class="stat-label">Mata Pelajaran</div>
            </div>
        </div>

        <!-- Total Classes -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card" style="border-left-color: #ffa726;">
                <div class="stat-icon" style="background: linear-gradient(135deg, #ffa726 0%, #fb8c00 100%); color: white;">
                    <i class="bi bi-door-open-fill"></i>
                </div>
                <div class="stat-value" style="color: #ffa726;">{{ $totalClasses ?? 0 }}</div>
                <div class="stat-label">Total Kelas</div>
            </div>
        </div>
    </div>

    <!-- Main Content Row -->
    <div class="row">
        <!-- Left Column - Activities -->
        <div class="col-lg-8 mb-4">
            <div class="chart-container">
                <h5 class="section-title">
                    <i class="bi bi-clock-history text-info"></i>
                    Aktivitas Terbaru
                </h5>

                <div class="activities-list">
                    @if(isset($recentActivities) && $recentActivities->count() > 0)
                    @foreach($recentActivities as $activity)
                    <div class="activity-item">
                        <div class="d-flex align-items-start">
                            <div class="flex-shrink-0">
                                <div class="rounded-circle d-flex align-items-center justify-content-center"
                                    style="width: 40px; height: 40px; background-color: 
                                         @if($activity->action === 'create') #dcfce7
                                         @elseif($activity->action === 'update') #dbeafe
                                         @elseif($activity->action === 'delete') #fee2e2
                                         @else #f3f4f6
                                         @endif">
                                    @if($activity->action === 'create')
                                    <i class="bi bi-plus-circle-fill text-success"></i>
                                    @elseif($activity->action === 'update')
                                    <i class="bi bi-pencil-fill text-primary"></i>
                                    @elseif($activity->action === 'delete')
                                    <i class="bi bi-trash-fill text-danger"></i>
                                    @else
                                    <i class="bi bi-dot text-secondary"></i>
                                    @endif
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <p class="mb-1">
                                    <strong style="color: #1f2937;">{{ $activity->user->name ?? 'System' }}</strong>
                                    <span style="color: #4b5563;">{{ $activity->description }}</span>
                                </p>
                                <small class="text-muted">
                                    <i class="bi bi-clock me-1"></i>
                                    {{ $activity->created_at->diffForHumans() }}
                                </small>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <div class="empty-state">
                        <i class="bi bi-inbox"></i>
                        <p class="mb-0">Belum ada aktivitas terbaru</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div class="col-lg-4">
            <!-- Quick Actions -->
            <div class="chart-container">
                <h5 class="section-title">
                    <i class="bi bi-lightning-charge-fill text-warning"></i>
                    Quick Actions
                </h5>
                <div class="d-grid gap-3">
                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary quick-action-btn">
                        <i class="bi bi-person-plus-fill me-2"></i>Tambah User Baru
                    </a>
                    <a href="{{ route('admin.courses.index') }}" class="btn btn-success quick-action-btn">
                        <i class="bi bi-journal-plus me-2"></i>Kelola Mata Pelajaran
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-info quick-action-btn text-white">
                        <i class="bi bi-people-fill me-2"></i>Kelola Users
                    </a>
                </div>
            </div>

            <!-- Recent Users -->
            <div class="chart-container">
                <h5 class="section-title">
                    <i class="bi bi-person-plus-fill text-success"></i>
                    User Terbaru
                </h5>

                @if(isset($recentUsers) && $recentUsers->count() > 0)
                @foreach($recentUsers as $user)
                <div class="user-item d-flex align-items-center">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random&color=fff&bold=true"
                        class="user-avatar me-3"
                        alt="{{ $user->name }}">
                    <div class="flex-grow-1">
                        <h6 class="mb-0" style="color: #1f2937; font-weight: 600;">{{ $user->name }}</h6>
                        <small class="text-muted">
                            <i class="bi bi-person-badge me-1"></i>
                            {{ ucfirst($user->role) }}
                        </small>
                    </div>
                    <small class="text-muted">
                        {{ $user->created_at->diffForHumans() }}
                    </small>
                </div>
                @endforeach
                @else
                <div class="empty-state">
                    <i class="bi bi-person-x"></i>
                    <p class="mb-0">Belum ada user baru</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection