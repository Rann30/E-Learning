@extends('layouts.student')

@section('title', 'Dashboard Student')
@section('page-title', 'DASHBOARD')

@push('styles')
<style>
    .profile-banner {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 15px;
        padding: 40px;
        color: white;
        position: relative;
        overflow: hidden;
        margin-bottom: 30px;
    }

    .profile-date {
        position: absolute;
        bottom: 40px;
        left: 40px;
        color: white;
        font-size: 12px;
        z-index: 1;
    }


    .profile-banner::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 400px;
        height: 400px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        pointer-events: none;
        /* 🔥 INI KUNCINYA */
    }


    .profile-info {
        display: flex;
        align-items: center;
        gap: 30px;
        position: relative;
        z-index: 1;
    }

    .profile-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        border: 5px solid white;
        object-fit: cover;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }

    .badge-container {
        position: absolute;
        top: 40px;
        right: 40px;
        display: flex;
        gap: 10px;
    }

    .badge-item {
        width: 60px;
        height: 60px;
    }

    .edit-profile-btn {
        position: absolute;
        bottom: 40px;
        right: 40px;
        z-index: 10;
        background: white;
        color: #667eea;
        border: none;
        padding: 12px 30px;
        border-radius: 25px;
        font-weight: 600;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        transition: all 0.3s;
    }

    .edit-profile-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
    }

    .card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    }

    .stat-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 25px;
        border-radius: 15px;
        margin-bottom: 20px;
    }

    .stat-value {
        font-size: 36px;
        font-weight: bold;
        margin: 10px 0;
    }

    .announcement-item {
        border-left: 4px solid #667eea;
        padding: 15px;
        margin-bottom: 15px;
        background: #f8f9fa;
        border-radius: 8px;
    }

    .assignment-item {
        border-bottom: 1px solid #e9ecef;
        padding: 15px 0;
    }

    .assignment-item:last-child {
        border-bottom: none;
    }

    .deadline-badge {
        background: #ffc107;
        color: #000;
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .schedule-item {
        background: #f8f9fa;
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 10px;
        border-left: 4px solid #667eea;
    }
</style>
@endpush

@section('content')
<!-- Profile Banner -->
<div class="profile-banner">
    <div class="profile-info">
        <img src="{{ $student->photo ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&size=120' }}"
            alt="Profile" class="profile-avatar">
        <div class="profile-details">
            <h2>{{ Auth::user()->name }}</h2>
            <p><i class="bi bi-person-badge me-2"></i>Siswa</p>
            <p><i class="bi bi-geo-alt me-2"></i>{{ $student->class }}</p>
            <p><i class="bi bi-clock me-2"></i>{{ $student->status }}</p>
        </div>
    </div>

    <a href="{{ route('student.edit-profile') }}"
        class="edit-profile-btn">
        <i class="bi bi-pencil me-2"></i> Edit Profile
    </a>



</div>

<!-- Statistics Cards -->
<div class="row mb-4">


    <div class="col-md-3">
        <div class="stat-card" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
            <i class="bi bi-clipboard-check" style="font-size: 30px;"></i>
            <div class="stat-value">{{ $upcomingAssignments->count() }}</div>
            <div>Tugas Aktif</div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stat-card" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
            <i class="bi bi-trophy" style="font-size: 30px;"></i>
            <div class="stat-value">{{ round($averageScore, 1) }}</div>
            <div>Rata-rata Nilai</div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Left Column -->
    <div class="col-md-8">
        <!-- Pengumuman -->


        <!-- Tugas -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title mb-3">
                    <i class="bi bi-clipboard-check text-warning me-2"></i>
                    Tugas yang Akan Datang
                </h5>
                @forelse($upcomingAssignments as $assignment)
                <div class="assignment-item">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="flex-grow-1">
                            <h6 class="mb-1">{{ $assignment->title }}</h6>
                            <p class="mb-1 text-muted small">{{ $assignment->course->name }}</p>
                            <small class="text-muted">
                                <i class="bi bi-calendar me-1"></i>
                                Deadline: {{ $assignment->deadline->format('d M Y, H:i') }}
                            </small>
                        </div>
                        <span class="deadline-badge">
                            {{ $assignment->deadline->diffForHumans() }}
                        </span>
                    </div>
                </div>
                @empty
                <div class="text-center text-muted py-4">
                    <i class="bi bi-check-circle" style="font-size: 48px; color: #28a745;"></i>
                    <p class="mt-2">Tidak ada tugas yang akan datang</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Jadwal Hari Ini -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-3">
                    <i class="bi bi-calendar-event text-success me-2"></i>
                    Jadwal Hari Ini ({{ $today }})
                </h5>
                @forelse($todaySchedules as $schedule)
                <div class="schedule-item">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="mb-1">{{ $schedule->course->name }}</h6>
                            <small class="text-muted">
                                <i class="bi bi-clock me-1"></i>
                                {{ Carbon\Carbon::parse($schedule->start_time)->format('H:i') }} -
                                {{ Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
                            </small>
                            @if($schedule->room)
                            <br>
                            <small class="text-muted">
                                <i class="bi bi-door-open me-1"></i>{{ $schedule->room }}
                            </small>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center text-muted py-4">
                    <i class="bi bi-calendar-x" style="font-size: 48px;"></i>
                    <p class="mt-2">Tidak ada jadwal hari ini</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>






</div>
</div>
@endsection
```