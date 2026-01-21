@extends('layouts.admin')

@section('title', 'Kelola Enrollment')
@section('page-title', 'Kelola Enrollment')

@section('content')
<div class="container-fluid">
    <!-- Form Add Enrollment -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                <i class="bi bi-plus-circle me-2"></i>
                Daftarkan Siswa ke Kursus
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.enrollments.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-5">
                        <label class="form-label">Pilih Siswa</label>
                        <select class="form-select @error('student_id') is-invalid @enderror"
                            name="student_id"
                            required>
                            <option value="">-- Pilih Siswa --</option>
                            @foreach($students as $student)
                            <option value="{{ $student->id }}">
                                {{ $student->nis }} - {{ $student->user->name }} ({{ $student->class }})
                            </option>
                            @endforeach
                        </select>
                        @error('student_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-5">
                        <label class="form-label">Pilih Kursus</label>
                        <select class="form-select @error('course_id') is-invalid @enderror"
                            name="course_id"
                            required>
                            <option value="">-- Pilih Kursus --</option>
                            @foreach($courses as $course)
                            <option value="{{ $course->id }}">
                                {{ $course->code }} - {{ $course->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('course_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">&nbsp;</label>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-save me-2"></i>Daftarkan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Enrollment List -->
    <div class="card">
        <div class="card-header bg-white">
            <h5 class="mb-0">
                <i class="bi bi-list-check text-primary me-2"></i>
                Daftar Enrollment ({{ $enrollments->total() }})
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>NIS</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Kursus</th>
                            <th>Status</th>
                            <th>Terdaftar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($enrollments as $index => $enrollment)
                        <tr>
                            <td>{{ $enrollments->firstItem() + $index }}</td>
                            <td><strong>{{ $enrollment->student->nis }}</strong></td>
                            <td>{{ $enrollment->student->user->name }}</td>
                            <td><span class="badge bg-info">{{ $enrollment->student->class }}</span></td>
                            <td>
                                <strong>{{ $enrollment->course->name }}</strong><br>
                                <small class="text-muted">{{ $enrollment->course->code }}</small>
                            </td>
                            <td>
                                @if($enrollment->is_active)
                                <span class="badge bg-success">Aktif</span>
                                @else
                                <span class="badge bg-secondary">Tidak Aktif</span>
                                @endif
                            </td>
                            <td>{{ $enrollment->created_at->format('d M Y') }}</td>
                            <td>
                                <form action="{{ route('admin.enrollments.destroy', $enrollment->id) }}"
                                    method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Yakin ingin menghapus enrollment ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">
                                <i class="bi bi-inbox" style="font-size: 48px;"></i>
                                <p class="mt-2">Belum ada enrollment</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-3">
                {{ $enrollments->links() }}
            </div>
        </div>
    </div>
</div>
@endsection