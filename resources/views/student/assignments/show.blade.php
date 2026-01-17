@extends('layouts.student')

@section('title', 'Detail Tugas')
@section('page-title', 'DETAIL TUGAS')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-body">
                    <h3 class="mb-3">{{ $assignment->title }}</h3>

                    <div class="mb-3">
                        <span class="badge bg-primary">{{ $assignment->course->name }}</span>
                        <span class="badge bg-warning text-dark">
                            <i class="bi bi-calendar me-1"></i>
                            Deadline: {{ $assignment->deadline->format('d M Y, H:i') }}
                        </span>
                    </div>

                    <hr>

                    <h5 class="mb-3">Deskripsi Tugas</h5>
                    <p>{{ $assignment->description }}</p>

                    @if($assignment->file)
                    <div class="alert alert-info mt-3">
                        <i class="bi bi-file-earmark-text me-2"></i>
                        <a href="{{ asset($assignment->file) }}" target="_blank">Download File Tugas</a>
                    </div>
                    @endif
                </div>
            </div>

            @if(!$submission)
            <!-- Submit Form -->
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Kumpulkan Tugas</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('student.assignments.submit', $assignment->id) }}"
                        method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Jawaban / Keterangan</label>
                            <textarea class="form-control @error('content') is-invalid @enderror"
                                name="content"
                                rows="6"
                                required
                                placeholder="Tuliskan jawaban atau keterangan tugas Anda...">{{ old('content') }}</textarea>
                            @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Upload File (Opsional)</label>
                            <input type="file"
                                class="form-control @error('file') is-invalid @enderror"
                                name="file">
                            <small class="text-muted">Max: 10MB</small>
                            @error('file')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        @if(now() > $assignment->deadline)
                        <div class="alert alert-danger">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            <strong>Peringatan:</strong> Deadline sudah lewat. Tugas akan ditandai sebagai terlambat.
                        </div>
                        @endif

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-send me-2"></i>Kumpulkan Tugas
                            </button>
                            <a href="{{ route('student.assignments') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left me-2"></i>Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
            @else
            <!-- Submission Detail -->
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Tugas Sudah Dikumpulkan</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>Status:</strong>
                        @if($submission->status === 'graded')
                        <span class="badge bg-success">Dinilai</span>
                        @elseif($submission->status === 'late')
                        <span class="badge bg-danger">Terlambat</span>
                        @else
                        <span class="badge bg-warning">Menunggu Penilaian</span>
                        @endif
                    </div>

                    <div class="mb-3">
                        <strong>Dikumpulkan pada:</strong> {{ $submission->submitted_at->format('d M Y, H:i') }}
                    </div>

                    <div class="mb-3">
                        <strong>Jawaban Anda:</strong>
                        <p class="mt-2">{{ $submission->content }}</p>
                    </div>

                    @if($submission->file)
                    <div class="mb-3">
                        <strong>File:</strong>
                        <a href="{{ asset($submission->file) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-download me-1"></i>Download File
                        </a>
                    </div>
                    @endif

                    @if($submission->score)
                    <hr>
                    <div class="alert alert-success">
                        <h5 class="mb-2">Nilai: {{ $submission->score }} / 100</h5>
                        @if($submission->feedback)
                        <strong>Feedback dari Pengajar:</strong>
                        <p class="mb-0 mt-2">{{ $submission->feedback }}</p>
                        @endif
                    </div>
                    @endif

                    <a href="{{ route('student.assignments') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Kembali
                    </a>
                </div>
            </div>
            @endif
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">Informasi Tugas</h5>
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <i class="bi bi-book text-primary me-2"></i>
                            <strong>Kursus:</strong><br>
                            <span class="ms-4">{{ $assignment->course->name }}</span>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-calendar text-primary me-2"></i>
                            <strong>Deadline:</strong><br>
                            <span class="ms-4">{{ $assignment->deadline->format('d M Y, H:i') }}</span>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-star text-primary me-2"></i>
                            <strong>Nilai Maksimal:</strong><br>
                            <span class="ms-4">{{ $assignment->max_score }}</span>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-clock text-primary me-2"></i>
                            <strong>Sisa Waktu:</strong><br>
                            <span class="ms-4">
                                @php
                                $diff = now()->diff($assignment->deadline);
                                @endphp
                                @if(now() > $assignment->deadline)
                                <span class="text-danger">Terlambat</span>
                                @else
                                {{ $diff->days }} hari {{ $diff->h }} jam
                                @endif
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection