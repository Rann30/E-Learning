@extends('layouts.student')

@section('title', 'Detail Kursus')
@section('page-title', 'DETAIL KURSUS')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h3>{{ $course->name }}</h3>
                            <p class="text-muted mb-0">
                                <i class="bi bi-code-square me-2"></i>{{ $course->code }}
                            </p>
                        </div>
                        @if($isEnrolled)
                        <span class="badge bg-success" style="padding: 10px 20px;">
                            <i class="bi bi-check-circle me-1"></i>Terdaftar
                        </span>
                        @endif
                    </div>

                    <hr>

                    <h5 class="mb-3">Deskripsi</h5>
                    <p>{{ $course->description }}</p>

                    @if(!$isEnrolled)
                    <div class="alert alert-warning mt-4">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        Anda belum terdaftar di kursus ini. Silakan hubungi admin untuk mendaftar.
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">Informasi Pengajar</h5>
                    <div class="d-flex align-items-center mb-3">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($course->teacher->name) }}&size=60"
                            class="rounded-circle me-3"
                            alt="Teacher">
                        <div>
                            <h6 class="mb-0">{{ $course->teacher->name }}</h6>
                            <small class="text-muted">Pengajar</small>
                        </div>
                    </div>

                    <hr>

                    <h6 class="mb-3">Detail Kursus</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="bi bi-journal-code text-primary me-2"></i>
                            <strong>Kode:</strong> {{ $course->code }}
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-calendar text-primary me-2"></i>
                            <strong>Dibuat:</strong> {{ $course->created_at->format('d M Y') }}
                        </li>
                    </ul>

                    @if($isEnrolled)
                    <a href="{{ route('student.courses') }}" class="btn btn-primary w-100 mt-3">
                        <i class="bi bi-arrow-left me-2"></i>Kembali ke Daftar Kursus
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection