@extends('layouts.admin')

@section('title', 'Data Siswa')
@section('page-title', 'Data Siswa')
@section('page-subtitle', 'Kelola data siswa')

@section('content')
<div class="container-fluid">
    <!-- Filter & Search -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.students.index') }}">
                <div class="row align-items-end">
                    <div class="col-md-4">
                        <label class="form-label">Cari Siswa</label>
                        <input type="text"
                            class="form-control"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Nama, Email, atau NIS...">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Kelas</label>
                        <select class="form-select" name="class">
                            <option value="">Semua Kelas</option>
                            @foreach($classes as $class)
                            <option value="{{ $class }}" {{ request('class') == $class ? 'selected' : '' }}>
                                {{ $class }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="status">
                            <option value="">Semua Status</option>
                            <option value="Belum Lulus" {{ request('status') == 'Belum Lulus' ? 'selected' : '' }}>
                                Belum Lulus
                            </option>
                            <option value="Lulus" {{ request('status') == 'Lulus' ? 'selected' : '' }}>
                                Lulus
                            </option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-search me-2"></i>Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Students Table -->
    <div class="card">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="bi bi-people text-primary me-2"></i>
                Daftar Siswa ({{ $students->total() }})
            </h5>
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>Tambah Siswa
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>NIS</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Kelas</th>
                            <th>Status</th>
                            <th>Poin</th>
                            <th>Badges</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($students as $index => $student)
                        <tr>
                            <td>{{ $students->firstItem() + $index }}</td>
                            <td>
                                <img src="{{ $student->photo ? asset($student->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($student->user->name) }}"
                                    class="rounded-circle"
                                    style="width: 40px; height: 40px; object-fit: cover;"
                                    alt="Photo">
                            </td>
                            <td><strong>{{ $student->nis }}</strong></td>
                            <td>{{ $student->user->name }}</td>
                            <td>{{ $student->user->email }}</td>
                            <td><span class="badge bg-primary">{{ $student->class }}</span></td>
                            <td>
                                @if($student->status === 'Lulus')
                                <span class="badge bg-success">Lulus</span>
                                @else
                                <span class="badge bg-warning">Belum Lulus</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-{{ $student->points > 0 ? 'danger' : 'secondary' }}">
                                    {{ $student->points }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-info">{{ $student->badges }}</span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.students.show', $student->id) }}"
                                        class="btn btn-sm btn-info"
                                        title="Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.students.edit', $student->id) }}"
                                        class="btn btn-sm btn-warning"
                                        title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.students.destroy', $student->id) }}"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Yakin ingin menghapus siswa ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="btn btn-sm btn-danger"
                                            title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center text-muted py-4">
                                <i class="bi bi-inbox" style="font-size: 48px;"></i>
                                <p class="mt-2">Tidak ada data siswa</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-3">
                {{ $students->links() }}
            </div>
        </div>
    </div>
</div>
@endsection