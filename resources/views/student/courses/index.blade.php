@extends('layouts.student')

@section('title', 'Smart Learning')
@section('page-title', 'SMART LEARNING')

@push('styles')
<style>
    .course-card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.3s;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .course-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    }

    .course-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 20px;
        min-height: 120px;
    }

    .course-body {
        padding: 20px;
    }

    .badge-enrolled {
        background: #28a745;
        color: white;
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 12px;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <!-- Enrolled Courses -->
    <div class="mb-5">
        <h5 class="mb-4">
            <i class="bi bi-bookmark-check text-primary me-2"></i>
            Kursus yang Diikuti
        </h5>

        @if($enrolledCourses->count() > 0)
        <div class="row">
            @foreach($enrolledCourses as $course)
            <div class="col-md-4 mb-4">
                <div class="card course-card">
                    <div class="course-header">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge badge-enrolled">Terdaftar</span>
                            <span class="badge bg-light text-dark">{{ $course->code }}</span>
                        </div>
                        <h5 class="mb-1">{{ $course->name }}</h5>
                        <small><i class="bi bi-person me-1"></i>{{ $course->teacher->name }}</small>
                    </div>
                    <div class="course-body">
                        <p class="text-muted small mb-3">{{ Str::limit($course->description, 100) }}</p>
                        <a href="{{ route('student.courses.show', $course->id) }}" class="btn btn-primary btn-sm w-100">
                            <i class="bi bi-eye me-2"></i>Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="alert alert-info">
            <i class="bi bi-info-circle me-2"></i>
            Anda belum terdaftar di kursus manapun.
        </div>
        @endif
    </div>

    <!-- Available Courses -->
    <div>
        <h5 class="mb-4">
            <i class="bi bi-journals text-success me-2"></i>
            Kursus Tersedia
        </h5>

        @if($availableCourses->count() > 0)
        <div class="row">
            @foreach($availableCourses as $course)
            <div class="col-md-4 mb-4">
                <div class="card course-card">
                    <div class="course-header" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge bg-light text-dark">{{ $course->code }}</span>
                        </div>
                        <h5 class="mb-1">{{ $course->name }}</h5>
                        <small><i class="bi bi-person me-1"></i>{{ $course->teacher->name }}</small>
                    </div>
                    <div class="course-body">
                        <p class="text-muted small mb-3">{{ Str::limit($course->description, 100) }}</p>
                        <a href="{{ route('student.courses.show', $course->id) }}" class="btn btn-outline-primary btn-sm w-100">
                            <i class="bi bi-eye me-2"></i>Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="alert alert-info">
            <i class="bi bi-info-circle me-2"></i>
            Tidak ada kursus tersedia saat ini.
        </div>
        @endif
    </div>
</div>
@endsection