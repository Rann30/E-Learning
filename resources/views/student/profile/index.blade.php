@extends('layouts.student')

@section('title', 'Profile Saya')
@section('page-title', 'PROFILE SAYA')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <img src="{{ $student->photo ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&size=150' }}"
                        class="rounded-circle mb-3"
                        style="width: 150px; height: 150px; object-fit: cover;"
                        alt="Profile">
                    <h4>{{ Auth::user()->name }}</h4>
                    <p class="text-muted">{{ $student->nis }}</p>
                    <span class="badge bg-primary">{{ $student->class }}</span>
                    <hr>
                    <a href="{{ route('student.edit-profile') }}" class="btn btn-primary w-100">
                        <i class="bi bi-pencil me-2"></i>Edit Profile
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Informasi Pribadi</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Nama Lengkap:</strong></div>
                        <div class="col-md-8">{{ Auth::user()->name }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Email:</strong></div>
                        <div class="col-md-8">{{ Auth::user()->email }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>NIS:</strong></div>
                        <div class="col-md-8">{{ $student->nis }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Kelas:</strong></div>
                        <div class="col-md-8">{{ $student->class }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Status:</strong></div>
                        <div class="col-md-8">
                            <span class="badge bg-{{ $student->status === 'Lulus' ? 'success' : 'warning' }}">
                                {{ $student->status }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Statistik</h5>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-3 mb-3">
                            <div class="p-3 bg-light rounded">
                                <h3 class="text-primary">{{ $student->enrollments()->where('is_active', true)->count() }}</h3>
                                <small class="text-muted">Kursus Aktif</small>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="p-3 bg-light rounded">
                                <h3 class="text-success">{{ $student->assignmentSubmissions()->count() }}</h3>
                                <small class="text-muted">Tugas Dikumpulkan</small>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="p-3 bg-light rounded">
                                <h3 class="text-warning">{{ $student->badges }}</h3>
                                <small class="text-muted">Badges</small>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="p-3 bg-light rounded">
                                <h3 class="text-danger">{{ $student->points }}</h3>
                                <small class="text-muted">Poin Pelanggaran</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection