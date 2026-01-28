@extends('layouts.admin')

@section('title', 'Detail Siswa')
@section('page-title', 'Detail Siswa')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Left Column - Profile -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <img src="{{ $student->photo ? asset($student->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($student->user->name) . '&size=150' }}"
                        class="rounded-circle mb-3"
                        style="width: 150px; height: 150px; object-fit: cover; border: 5px solid #3b82f6;"
                        alt="Photo">
                    <h4>{{ $student->user->name }}</h4>
                    <p class="text-muted">{{ $student->nis }}</p>
                    <span class="badge bg-primary mb-2">{{ $student->class }}</span>
                    <span class="badge bg-{{ $student->status === 'Lulus' ? 'success' : 'warning' }}">
                        {{ $student->status }}
                    </span>

                    <hr>

                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.students.edit', $student->id) }}" class="btn btn-primary">
                            <i class="bi bi-pencil me-2"></i>Edit Data
                        </a>
                        <a href="{{ route('admin.students.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>
            </div>

            <!-- Stats -->
            <div class="card mt-3">
                <div class="card-body">
                    <h6 class="mb-3">Statistik</h6>

                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Tugas Dikumpulkan</span>
                            <strong class="text-success">{{ $totalSubmissions }}</strong>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Rata-rata Nilai</span>
                            <strong class="text-info">{{ round($averageScore, 1) }}</strong>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Kehadiran</span>
                            <strong class="text-warning">{{ $attendanceRate }}%</strong>
                        </div>
                    </div>

                    <div>
                        <div class="d-flex justify-content-between mb-1">
                            <span>Badges</span>
                            <strong class="text-primary">{{ $student->badges }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column - Details -->
        <div class="col-md-8">
            <!-- Personal Info -->
            <div class="card mb-3">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Informasi Pribadi</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Nama Lengkap:</strong></div>
                        <div class="col-md-8">{{ $student->user->name }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Email:</strong></div>
                        <div class="col-md-8">{{ $student->user->email }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>NIS:</strong></div>
                        <div class="col-md-8">{{ $student->nis }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Kelas:</strong></div>
                        <div class="col-md-8">{{ $student->class }}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"><strong>Status:</strong></div>
                        <div class="col-md-8">
                            <span class="badge bg-{{ $student->status === 'Lulus' ? 'success' : 'warning' }}">
                                {{ $student->status }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>




        </div>
    </div>
</div>
@endsection