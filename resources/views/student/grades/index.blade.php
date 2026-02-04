@extends('layouts.student')

@section('title', 'Nilai Saya')
@section('page-title', 'NILAI SAYA')

@push('styles')
<style>
    .grade-card {
        border-radius: 15px;
        padding: 25px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        margin-bottom: 20px;
    }

    .grade-value {
        font-size: 48px;
        font-weight: bold;
    }

    .course-grade-card {
        border-left: 4px solid #667eea;
        transition: all 0.3s;
    }

    .course-grade-card:hover {
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        transform: translateX(5px);
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <!-- Overall Grade -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="grade-card">
                <h5 class="mb-2">Rata-rata Keseluruhan</h5>
                <div class="grade-value">
                    {{ $submissions->isNotEmpty() ? round($submissions->avg('score'), 1) : 0 }}
                </div>
                <p class="mb-0">dari {{ $submissions->count() }} tugas</p>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3">Rata-rata Per mata pelajaran</h5>
                    @forelse($gradesByCourse as $gradeData)
                    <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                        <div>
                            <h6 class="mb-1">{{ $gradeData['course']->name }}</h6>
                            <small class="text-muted">{{ $gradeData['count'] }} tugas</small>
                        </div>
                        <div class="text-end">
                            <h4 class="mb-0 text-primary">{{ $gradeData['average'] }}</h4>
                        </div>
                    </div>
                    @empty
                    <p class="text-muted text-center">Belum ada nilai</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Detailed Grades -->
    <div class="card">
        <div class="card-header bg-white">
            <h5 class="mb-0">
                <i class="bi bi-list-check text-primary me-2"></i>
                Riwayat Nilai
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Tugas</th>
                            <th>mata pelajaran</th>
                            <th>Tanggal Submit</th>
                            <th>Nilai</th>
                            <th>Status</th>
                            <th>Feedback</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($submissions as $index => $submission)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $submission->assignment->title }}</td>
                            <td>{{ $submission->assignment->course->name }}</td>
                            <td>{{ $submission->submitted_at->format('d M Y') }}</td>
                            <td>
                                <strong class="text-primary" style="font-size: 18px;">
                                    {{ $submission->score }}
                                </strong> / 100
                            </td>
                            <td>
                                @if($submission->score >= 80)
                                <span class="badge bg-success">Sangat Baik</span>
                                @elseif($submission->score >= 70)
                                <span class="badge bg-info">Baik</span>
                                @elseif($submission->score >= 60)
                                <span class="badge bg-warning">Cukup</span>
                                @else
                                <span class="badge bg-danger">Perlu Perbaikan</span>
                                @endif
                            </td>
                            <td>
                                @if($submission->feedback)
                                <button class="btn btn-sm btn-outline-primary"
                                    data-bs-toggle="modal"
                                    data-bs-target="#feedbackModal{{ $submission->id }}">
                                    <i class="bi bi-chat-text"></i> Lihat
                                </button>

                                <!-- Modal Feedback -->
                                <div class="modal fade" id="feedbackModal{{ $submission->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Feedback Pengajar</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <h6>{{ $submission->assignment->title }}</h6>
                                                <hr>
                                                <p>{{ $submission->feedback }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <span class="text-muted">-</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                <i class="bi bi-inbox" style="font-size: 48px;"></i>
                                <p class="mt-2">Belum ada nilai</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection