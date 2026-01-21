@extends('layouts.admin')

@section('title', 'Detail Guru')
@section('page-title', 'Detail Guru')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($teacher->name) }}&size=150"
                        class="rounded-circle mb-3"
                        style="width: 150px; height: 150px; border: 5px solid #3b82f6;"
                        alt="Teacher">
                    <h4>{{ $teacher->name }}</h4>
                    <p class="text-muted">{{ $teacher->email }}</p>
                    <span class="badge bg-success">Teacher</span>

                    <hr>

                    <a href="{{ route('admin.teachers.index') }}" class="btn btn-secondary w-100">
                        <i class="bi bi-arrow-left me-2"></i>Kembali
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Kursus yang Diajar</h5>
                </div>
                <div class="card-body">
                    @forelse($teacher->courses as $course)
                    <div class="alert alert-info d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0">{{ $course->name }}</h6>
                            <small class="text-muted">{{ $course->code }}</small>
                        </div>
                        <span class="badge bg-primary">{{ $course->enrollments->count() }} siswa</span>
                    </div>
                    @empty
                    <p class="text-muted text-center">Belum mengajar kursus apapun</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection