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

    .profile-banner::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 400px;
        height: 400px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
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

    .profile-details h2 {
        margin: 0;
        font-size: 28px;
        font-weight: bold;
    }

    .profile-details p {
        margin: 5px 0;
        opacity: 0.9;
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

    .info-card {
        background: white;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        margin-bottom: 20px;
    }

    .info-card h5 {
        color: #4A5D7E;
        font-weight: 600;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .card-status {
        background: #f8f9fa;
        border-left: 4px solid #28a745;
        padding: 20px;
        border-radius: 10px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .status-badge {
        background: #28a745;
        color: white;
        padding: 8px 20px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 14px;
    }

    .point-section {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
        text-align: center;
    }

    .point-value {
        font-size: 36px;
        font-weight: bold;
        color: #4A5D7E;
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
            <p><i class="bi bi-person-badge me-2"></i>Student</p>
            <p><i class="bi bi-geo-alt me-2"></i>{{ $student->class }}</p>
            <p><i class="bi bi-clock me-2"></i>{{ $student->status }}</p>
        </div>
    </div>

    <div class="badge-container">
        @if($student->badges > 0)
        @for($i = 0; $i < min($student->badges, 3); $i++)
            <img src="https://cdn-icons-png.flaticon.com/512/744/744984.png" alt="Badge" class="badge-item">
            @endfor
            @endif
    </div>

    <a href="{{ route('student.edit-profile') }}" class="edit-profile-btn">
        <i class="bi bi-pencil me-2"></i>Edit Profile
    </a>

    <div style="position: absolute; bottom: 40px; left: 40px; color: white; font-size: 12px;">
        {{ now()->format('d F Y H:i A') }}
    </div>
</div>

<div class="row">
    <!-- Poin Saya -->
    <div class="col-md-6">
        <div class="info-card">
            <h5>
                <i class="bi bi-award"></i>
                Poin Saya
            </h5>
            <div class="point-section">
                <div class="point-value">{{ $student->points }}</div>
                <p class="text-muted mb-0">Total Poin</p>
            </div>
        </div>
    </div>

    <!-- Akses Kartu -->
    <div class="col-md-6">
        <div class="info-card">
            <h5>
                <i class="bi bi-credit-card"></i>
                Akses SAS {{ $violationCard ? $violationCard->card_number : '' }}
            </h5>
            @if($violationCard)
            <div class="card-status">
                <div>
                    <p class="mb-1 text-muted small">Akses sas {{ $violationCard->card_number }} sudah aktif, kamu dapat melihat kartu ini</p>
                </div>
                <span class="status-badge">
                    <i class="bi bi-check-circle me-1"></i>Aktif
                </span>
            </div>
            <div class="mt-3">
                <button class="btn btn-primary">
                    <i class="bi bi-eye me-2"></i>Lihat Kartu
                </button>
            </div>
            @else
            <div class="alert alert-info">
                <i class="bi bi-info-circle me-2"></i>
                Anda belum memiliki kartu akses yang aktif
            </div>
            @endif
        </div>
    </div>

    <!-- Poin Pelanggaran -->
    <div class="col-md-12">
        <div class="info-card">
            <h5>
                <i class="bi bi-graph-up"></i>
                Poin Pelanggaran
            </h5>
            <div class="point-section">
                <div class="point-value">{{ $student->points }} Point</div>
                <div class="progress mt-3" style="height: 10px;">
                    <div class="progress-bar" role="progressbar" style="width: {{ min(($student->points / 100) * 100, 100) }}%"
                        aria-valuenow="{{ $student->points }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection