@extends('layouts.admin')

@section('title', 'Detail Tugas')
@section('page-title', 'Detail Tugas')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-body">
                    <h3>{{ $assignment->title }}</h3>
                    <p class="text-muted">{{ $assignment->course->name }} ({{ $assignment->course->code }})</p>

                    <hr>

                    <h5>Deskripsi</h5>
                    <p>{{ $assignment->description }}</p>

                    <div class="alert alert-info mt-3">
                        <strong>Deadline:</strong> {{ $assignment->deadline->format('d M Y, H:i') }}
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Submissions ({{ $assignment->submissions->count() }})</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Siswa</th>
                                    <th>Submitted</th>
                                    <th>Status</th>
                                    <th>Score</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($assignment->submissions as $submission)
                                <tr>
                                    <td>{{ $submission->student->user->name }}</td>
                                    <td>{{ $submission->submitted_at->format('d M Y, H:i') }}</td>
                                    <td>
                                        <span class="badge bg-{{ $submission->status === 'graded' ? 'success' : 'warning' }}">
                                            {{ ucfirst($submission->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($submission->score)
                                        <strong>{{ $submission->score }}</strong> / {{ $assignment->max_score }}
                                        @else
                                        <span class="text-muted">Belum dinilai</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">Belum ada submission</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">Informasi</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <strong>Max Score:</strong> {{ $assignment->max_score }}
                        </li>
                        <li class="mb-2">
                            <strong>Deadline:</strong> {{ $assignment->deadline->format('d M Y, H:i') }}
                        </li>
                        <li class="mb-2">
                            <strong>Submissions:</strong> {{ $assignment->submissions->count() }}
                        </li>
                        <li class="mb-2">
                            <strong>Graded:</strong> {{ $assignment->submissions->where('status', 'graded')->count() }}
                        </li>
                    </ul>

                    <hr>

                    <a href="{{ route('admin.assignments.index') }}" class="btn btn-secondary w-100">
                        <i class="bi bi-arrow-left me-2"></i>Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection