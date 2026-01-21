@extends('layouts.admin')

@section('title', 'Data Guru')
@section('page-title', 'Data Guru')
@section('page-subtitle', 'Kelola data guru')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="bi bi-person-workspace text-primary me-2"></i>
                Daftar Guru ({{ $teachers->total() }})
            </h5>
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>Tambah Guru
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Total Kursus</th>
                            <th>Terdaftar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($teachers as $index => $teacher)
                        <tr>
                            <td>{{ $teachers->firstItem() + $index }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($teacher->name) }}"
                                        class="rounded-circle me-2"
                                        style="width: 40px; height: 40px;"
                                        alt="Teacher">
                                    <strong>{{ $teacher->name }}</strong>
                                </div>
                            </td>
                            <td>{{ $teacher->email }}</td>
                            <td>
                                <span class="badge bg-primary">{{ $teacher->courses->count() }} kursus</span>
                            </td>
                            <td>{{ $teacher->created_at->format('d M Y') }}</td>
                            <td>
                                <a href="{{ route('admin.teachers.show', $teacher->id) }}"
                                    class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                <i class="bi bi-inbox" style="font-size: 48px;"></i>
                                <p class="mt-2">Belum ada data guru</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-3">
                {{ $teachers->links() }}
            </div>
        </div>
    </div>
</div>
@endsection