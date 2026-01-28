@extends('layouts.admin')

@section('title', 'Kelola Kehadiran')
@section('page-title', 'Kelola Kehadiran')

@section('content')
<div class="container-fluid">
    <!-- Filter -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.attendances.index') }}">
                <div class="row align-items-end">
                    <div class="col-md-4">
                        <label class="form-label">Tanggal</label>
                        <input type="date"
                            class="form-control"
                            name="date"
                            value="{{ request('date', today()->format('Y-m-d')) }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">mata pelajaran</label>
                        <select class="form-select" name="course_id">
                            <option value="">Semua mata pelajaran</option>
                            @foreach($courses as $course)
                            <option value="{{ $course->id }}" {{ request('course_id') == $course->id ? 'selected' : '' }}>
                                {{ $course->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-search me-2"></i>Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Add Attendance -->
    <div class="card mb-4">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">
                <i class="bi bi-plus-circle me-2"></i>
                Catat Kehadiran
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.attendances.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <label class="form-label">Siswa</label>
                        <select class="form-select" name="student_id" required>
                            <option value="">Pilih Siswa</option>
                            @foreach($students as $student)
                            <option value="{{ $student->id }}">
                                {{ $student->user->name }} ({{ $student->class }})
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">mata pelajaran</label>
                        <select class="form-select" name="course_id" required>
                            <option value="">Pilih mata pelajaran</option>
                            @foreach($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Tanggal</label>
                        <input type="date" class="form-control" name="date" value="{{ today()->format('Y-m-d') }}" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="status" required>
                            <option value="hadir">Hadir</option>
                            <option value="izin">Izin</option>
                            <option value="sakit">Sakit</option>
                            <option value="alpha">Alpha</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">&nbsp;</label>
                        <button type="submit" class="btn btn-success w-100">
                            <i class="bi bi-save me-2"></i>Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Attendance List -->
    <div class="card">
        <div class="card-header bg-white">
            <h5 class="mb-0">
                <i class="bi bi-list-check text-primary me-2"></i>
                Daftar Kehadiran ({{ $attendances->total() }})
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Siswa</th>
                            <th>mata pelajaran</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($attendances as $index => $attendance)
                        <tr>
                            <td>{{ $attendances->firstItem() + $index }}</td>
                            <td>{{ $attendance->date->format('d M Y') }}</td>
                            <td>{{ $attendance->student->user->name }}</td>
                            <td>{{ $attendance->course->name }}</td>
                            <td>
                                @if($attendance->status === 'hadir')
                                <span class="badge bg-success">Hadir</span>
                                @elseif($attendance->status === 'izin')
                                <span class="badge bg-warning">Izin</span>
                                @elseif($attendance->status === 'sakit')
                                <span class="badge bg-info">Sakit</span>
                                @else
                                <span class="badge bg-danger">Alpha</span>
                                @endif
                            </td>
                            <td>{{ $attendance->note ?? '-' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">Tidak ada data kehadiran</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-3">
                {{ $attendances->links() }}
            </div>
        </div>
    </div>
</div>
@endsection