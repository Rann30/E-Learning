@extends('layouts.admin')

@section('title', 'Kelola Kursus')
@section('page-title', 'Kelola Kursus')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="bi bi-journal-code text-primary me-2"></i>
                Daftar Kursus ({{ $courses->total() }})
            </h5>
            <a href="{{ route('admin.courses.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>Tambah Kursus
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama Kursus</th>
                            <th>Pengajar</th>
                            <th>Siswa</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($courses as $index => $course)
                        <tr>
                            <td>{{ $courses->firstItem() + $index }}</td>
                            <td><span class="badge bg-primary">{{ $course->code }}</span></td>
                            <td><strong>{{ $course->name }}</strong></td>
                            <td>{{ $course->teacher->name }}</td>
                            <td>
                                <span class="badge bg-success">{{ $course->enrollments->count() }} siswa</span>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.courses.show', $course->id) }}"
                                        class="btn btn-sm btn-info">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.courses.edit', $course->id) }}"
                                        class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.courses.destroy', $course->id) }}"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Yakin ingin menghapus kursus ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                <i class="bi bi-inbox" style="font-size: 48px;"></i>
                                <p class="mt-2">Belum ada kursus</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-3">
                {{ $courses->links() }}
            </div>
        </div>
    </div>
</div>
@endsection