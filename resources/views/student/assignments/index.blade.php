@extends('layouts.student')

@section('title', 'Tugas Saya')
@section('page-title', 'TUGAS SAYA')

@push('styles')
<style>
    .assignment-card {
        border-left: 4px solid #667eea;
        transition: all 0.3s;
    }

    .assignment-card:hover {
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        transform: translateX(5px);
    }

    .deadline-badge {
        background: #ffc107;
        color: #000;
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .deadline-urgent {
        background: #dc3545;
        color: white;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <!-- Pending Assignments -->
    <div class="mb-5">
        <h5 class="mb-4">
            <i class="bi bi-clock-history text-warning me-2"></i>
            Tugas Belum Dikumpulkan ({{ $pendingAssignments->count() }})
        </h5>

        @forelse($pendingAssignments as $assignment)
        <div class="card assignment-card mb-3">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h5 class="mb-2">{{ $assignment->title }}</h5>
                        <p class="text-muted mb-2">
                            <i class="bi bi-book me-1"></i>{{ $assignment->course->name }}
                        </p>
                        <p class="mb-2">{{ Str::limit($assignment->description, 150) }}</p>
                        <small class="text-muted">
                            <i class="bi bi-calendar me-1"></i>
                            Deadline: {{ $assignment->deadline->format('d M Y, H:i') }}
                        </small>
                    </div>
                    <div class="col-md-4 text-end">
                        @php
                        $daysLeft = now()->diffInDays($assignment->deadline, false);
                        $isUrgent = $daysLeft <= 2;
                            @endphp
                            <span class="deadline-badge {{ $isUrgent ? 'deadline-urgent' : '' }}">
                            @if($daysLeft > 0)
                            {{ $daysLeft }} hari lagi
                            @else
                            Terlambat
                            @endif
                            </span>
                            <div class="mt-3">
                                <a href="{{ route('student.assignments.show', $assignment->id) }}"
                                    class="btn btn-primary">
                                    <i class="bi bi-pencil me-2"></i>Kerjakan
                                </a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="alert alert-success">
            <i class="bi bi-check-circle me-2"></i>
            Tidak ada tugas yang perlu dikerjakan saat ini.
        </div>
        @endforelse
    </div>

    <!-- Submitted Assignments -->
    <div>
        <h5 class="mb-4">
            <i class="bi bi-check-circle text-success me-2"></i>
            Tugas yang Sudah Dikumpulkan ({{ $submittedAssignments->count() }})
        </h5>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Judul Tugas</th>
                        <th>Kursus</th>
                        <th>Dikumpulkan</th>
                        <th>Status</th>
                        <th>Nilai</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($submittedAssignments as $submission)
                    <tr>
                        <td>{{ $submission->assignment->title }}</td>
                        <td>{{ $submission->assignment->course->name }}</td>
                        <td>{{ $submission->submitted_at->format('d M Y, H:i') }}</td>
                        <td>
                            @if($submission->status === 'graded')
                            <span class="badge bg-success">Dinilai</span>
                            @elseif($submission->status === 'late')
                            <span class="badge bg-danger">Terlambat</span>
                            @else
                            <span class="badge bg-warning">Menunggu</span>
                            @endif
                        </td>
                        <td>
                            @if($submission->score)
                            <strong class="text-primary">{{ $submission->score }}</strong> / 100
                            @else
                            <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('student.assignments.show', $submission->assignment_id) }}"
                                class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye"></i> Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Belum ada tugas yang dikumpulkan</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection