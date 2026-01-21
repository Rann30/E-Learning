@extends('layouts.admin')

@section('title', 'Detail Kursus')
@section('page-title', 'Detail Kursus')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h3>{{ $course->name }}</h3>
                            <p class="text-muted mb-0">
                                <i class="bi bi-code-square me-2"></i>{{ $course->code }}
                            </p>
                        </div>
                        <div>
                            <a href="{{ route('admin.courses.edit', $course->id) }}" class="btn btn-warning">
                                <i class="bi bi-pencil me-2"></i>Edit
                            </a>
                        </div>
                    </div>

                    <hr>

                    <h5 class="mb-3">Deskripsi</h5>
                    <p>{{ $course->description }}</p>

                    <h5 class="mb-3 mt-4">Pengajar</h5>
                    <div class="d-flex align-items-center">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($course->teacher->name) }}"
                            class="rounded-circle me-3"
                            style="width: 50px; height: 50px;"
                            alt="Teacher">
                        <div>
                            <h6 class="mb-0">{{ $course->teacher->name }}</h6>
                            <small class="text-muted">{{ $course->teacher->email }}</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Siswa Terdaftar ({{ $course->enrollments->count() }})</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>NIS</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($course->enrollments as $index => $enrollment)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $enrollment->student->nis }}</td>
                                    <td>{{ $enrollment->student->user->name }}</td>
                                    <td>{{ $enrollment->student->class }}</td>
                                    <td>
                                        <span class="badge bg-{{ $enrollment->is_active ? 'success' : 'secondary' }}">
                                            {{ $enrollment->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">Belum ada siswa terdaftar</td>
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
                        <li class="mb-3">
                            <i class="bi bi-code-square text-primary me-2"></i>
                            <strong>Kode:</strong> {{ $course->code }}
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-people text-primary me-2"></i>
                            <strong>Siswa:</strong> {{ $course->enrollments->count() }}
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-calendar text-primary me-2"></i>
                            <strong>Dibuat:</strong> {{ $course->created_at->format('d M Y') }}
                        </li>
                    </ul>

                    <hr>

                    <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary w-100">
                        <i class="bi bi-arrow-left me-2"></i>Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection