@extends('layouts.admin')

@section('title', 'Buat Kartu Pelanggaran')
@section('page-title', 'Buat Kartu Pelanggaran')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.violations.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Pilih Siswa</label>
                            <select class="form-select @error('student_id') is-invalid @enderror"
                                name="student_id"
                                required>
                                <option value="">-- Pilih Siswa --</option>
                                @foreach($students as $student)
                                <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>
                                    {{ $student->nis }} - {{ $student->user->name }} ({{ $student->class }})
                                </option>
                                @endforeach
                            </select>
                            @error('student_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nomor Kartu</label>
                            <input type="text"
                                class="form-control @error('card_number') is-invalid @enderror"
                                name="card_number"
                                value="{{ old('card_number') }}"
                                placeholder="Contoh: Ganjil 2526"
                                required>
                            @error('card_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                name="description"
                                rows="4">{{ old('description') }}</textarea>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select @error('is_active') is-invalid @enderror"
                                name="is_active"
                                required>
                                <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
                            @error('is_active')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr class="my-4">

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-save me-2"></i>Simpan
                            </button>
                            <a href="{{ route('admin.violations.index') }}" class="btn btn-secondary">
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