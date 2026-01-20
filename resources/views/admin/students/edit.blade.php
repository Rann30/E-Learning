@extends('layouts.admin')

@section('title', 'Edit Siswa')
@section('page-title', 'Edit Data Siswa')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.students.update', $student->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                name="name"
                                value="{{ old('name', $student->user->name) }}"
                                required>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email"
                                class="form-control @error('email') is-invalid @enderror"
                                name="email"
                                value="{{ old('email', $student->user->email) }}"
                                required>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">NIS</label>
                                <input type="text"
                                    class="form-control @error('nis') is-invalid @enderror"
                                    name="nis"
                                    value="{{ old('nis', $student->nis) }}"
                                    required>
                                @error('nis')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kelas</label>
                                <select class="form-select @error('class') is-invalid @enderror" name="class" required>
                                    <option value="">Pilih Kelas</option>
                                    @foreach(['X RPL 1', 'X RPL 2', 'XI RPL 1', 'XI RPL 2', 'XII RPL 1', 'XII RPL 2'] as $class)
                                    <option value="{{ $class }}" {{ old('class', $student->class) == $class ? 'selected' : '' }}>
                                        {{ $class }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('class')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Status</label>
                                <select class="form-select @error('status') is-invalid @enderror" name="status" required>
                                    <option value="Belum Lulus" {{ old('status', $student->status) == 'Belum Lulus' ? 'selected' : '' }}>
                                        Belum Lulus
                                    </option>
                                    <option value="Lulus" {{ old('status', $student->status) == 'Lulus' ? 'selected' : '' }}>
                                        Lulus
                                    </option>
                                </select>
                                @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Poin Pelanggaran</label>
                                <input type="number"
                                    class="form-control @error('points') is-invalid @enderror"
                                    name="points"
                                    value="{{ old('points', $student->points) }}"
                                    min="0"
                                    required>
                                @error('points')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Badges</label>
                                <input type="number"
                                    class="form-control @error('badges') is-invalid @enderror"
                                    name="badges"
                                    value="{{ old('badges', $student->badges) }}"
                                    min="0"
                                    required>
                                @error('badges')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-2"></i>Simpan Perubahan
                            </button>
                            <a href="{{ route('admin.students.index') }}" class="btn btn-secondary">
                                <i class="bi bi-x-circle me-2"></i>Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection