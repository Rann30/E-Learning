@extends('layouts.admin')

@section('title', 'Kelola Tugas')
@section('page-title', 'Kelola Tugas')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-white">
            <h5 class="mb-0">
                <i class="bi bi-file-text text-primary me-2"></i>
                Daftar Tugas ({{ $assignments->total() }})
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Judul Tugas</th>
                            <th>Kursus</th>
                            <th>Deadline</th>
                            <th>Submission</th>
                            <th>Max Score</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($assignments as $index => $assignment)
                        <tr>
                            <td>{{ $assignments->firstItem() + $index }}</td>
                            <td><strong>{{ $assignment->title }}</strong></td>
                            <td>
                                {{ $assignment->course->name }}<br>
                                <small class="text-muted">{{ $assignment->course->code }}</small>
                            </td>
                            <td>
                                <span class="badge bg-{{ $assignment->deadline > now() ? 'success' : 'danger' }}">
                                    {{ $assignment->deadline->format('d M Y, H:i') }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-info">{{ $assignment->submissions->count() }} submission</span>
                            </td>
                            <td>{{ $assignment->max_score }}</td>
                            <td>
                                <a href="{{ route('admin.assignments.show', $assignment->id) }}"
                                    class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                <i class="bi bi-inbox" style="font-size: 48px;"></i>
                                <p class="mt-2">Belum ada tugas</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-3">
                {{ $assignments->links() }}
            </div>
        </div>
    </div>
</div>
@endsection