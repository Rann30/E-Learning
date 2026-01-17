@extends('layouts.student')

@section('title', 'Jadwal Kelas')
@section('page-title', 'JADWAL KELAS')

@push('styles')
<style>
    .day-card {
        border-radius: 15px;
        overflow: hidden;
        margin-bottom: 20px;
        border: none;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .day-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 15px 20px;
        font-weight: 600;
    }

    .schedule-item {
        padding: 15px 20px;
        border-bottom: 1px solid #e9ecef;
        transition: all 0.3s;
    }

    .schedule-item:last-child {
        border-bottom: none;
    }

    .schedule-item:hover {
        background: #f8f9fa;
        transform: translateX(5px);
    }

    .time-badge {
        background: #667eea;
        color: white;
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="alert alert-info mb-4">
        <i class="bi bi-info-circle me-2"></i>
        Berikut adalah jadwal kelas Anda untuk minggu ini.
    </div>

    @foreach($days as $day)
    @php
    $daySchedules = $schedules->get($day, collect());
    $dayIndo = [
    'Monday' => 'Senin',
    'Tuesday' => 'Selasa',
    'Wednesday' => 'Rabu',
    'Thursday' => 'Kamis',
    'Friday' => 'Jumat',
    'Saturday' => 'Sabtu',
    'Sunday' => 'Minggu'
    ];
    @endphp

    @if($daySchedules->isNotEmpty())
    <div class="day-card">
        <div class="day-header">
            <i class="bi bi-calendar-day me-2"></i>
            {{ $dayIndo[$day] }}
        </div>
        <div class="card-body p-0">
            @foreach($daySchedules as $schedule)
            <div class="schedule-item">
                <div class="row align-items-center">
                    <div class="col-md-3">
                        <span class="time-badge">
                            <i class="bi bi-clock me-1"></i>
                            {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }} -
                            {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
                        </span>
                    </div>
                    <div class="col-md-6">
                        <h6 class="mb-1">{{ $schedule->course->name }}</h6>
                        <small class="text-muted">
                            <i class="bi bi-person me-1"></i>
                            {{ $schedule->course->teacher->name }}
                        </small>
                    </div>
                    <div class="col-md-3 text-end">
                        @if($schedule->room)
                        <span class="badge bg-light text-dark">
                            <i class="bi bi-door-open me-1"></i>
                            {{ $schedule->room }}
                        </span>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
    @endforeach

    @if($schedules->isEmpty())
    <div class="text-center py-5">
        <i class="bi bi-calendar-x" style="font-size: 64px; color: #ddd;"></i>
        <h5 class="text-muted mt-3">Belum ada jadwal kelas</h5>
        <p class="text-muted">Jadwal akan muncul setelah Anda terdaftar di kursus</p>
    </div>
    @endif
</div>
@endsection