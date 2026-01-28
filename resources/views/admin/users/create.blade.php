@extends('layouts.admin')

@section('title', 'Tambah User')
@section('page-title', 'Tambah User Baru')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Form Tambah User</h5>

                    <form action="{{ route('admin.users.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                name="name"
                                value="{{ old('name') }}"
                                required
                                placeholder="Masukkan nama lengkap">
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email"
                                class="form-control @error('email') is-invalid @enderror"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                placeholder="contoh@email.com">
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Password <span class="text-danger">*</span></label>
                                <input type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    name="password"
                                    required
                                    placeholder="Minimal 8 karakter">
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                                <input type="password"
                                    class="form-control"
                                    name="password_confirmation"
                                    required
                                    placeholder="Ulangi password">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Role <span class="text-danger">*</span></label>
                            <select class="form-select @error('role') is-invalid @enderror"
                                name="role"
                                id="roleSelect"
                                required>
                                <option value="">-- Pilih Role --</option>
                                <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>Student</option>
                                <option value="teacher" {{ old('role') == 'teacher' ? 'selected' : '' }}>Teacher</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                            @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Student Fields -->
                        <div id="studentFields" style="display: none;">
                            <div class="alert alert-info">
                                <i class="bi bi-info-circle me-2"></i>
                                <strong>Data Tambahan untuk Student</strong>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">NIS <span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control @error('nis') is-invalid @enderror"
                                        name="nis"
                                        value="{{ old('nis') }}"
                                        placeholder="Nomor Induk Siswa">
                                    @error('nis')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kelas <span class="text-danger">*</span></label>
                                    <select class="form-select @error('class') is-invalid @enderror"
                                        name="class">
                                        <option value="">-- Pilih Kelas --</option>
                                        <option value="X RPL 1" {{ old('class') == 'X RPL 1' ? 'selected' : '' }}>X RPL 1</option>
                                        <option value="X RPL 2" {{ old('class') == 'X RPL 2' ? 'selected' : '' }}>X RPL 2</option>
                                        <option value="XI RPL 1" {{ old('class') == 'XI RPL 1' ? 'selected' : '' }}>XI RPL 1</option>
                                        <option value="XI RPL 2" {{ old('class') == 'XI RPL 2' ? 'selected' : '' }}>XI RPL 2</option>
                                        <option value="XII RPL 1" {{ old('class') == 'XII RPL 1' ? 'selected' : '' }}>XII RPL 1</option>
                                        <option value="XII RPL 2" {{ old('class') == 'XII RPL 2' ? 'selected' : '' }}>XII RPL 2</option>
                                    </select>
                                    @error('class')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-2"></i>Simpan User
                            </button>
                            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                                <i class="bi bi-x-circle me-2"></i>Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body">
                    <h6 class="mb-3">
                        <i class="bi bi-info-circle text-primary me-2"></i>
                        Informasi
                    </h6>
                    <ul class="mb-0">
                        <li>Password minimal 8 karakter</li>
                        <li>Email harus unik (belum terdaftar)</li>
                        <li>Jika memilih role <strong>Student</strong>, wajib mengisi NIS dan Kelas</li>
                        <li>User akan langsung bisa login setelah dibuat</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Show/Hide student fields based on role selection
    document.getElementById('roleSelect').addEventListener('change', function() {
        const studentFields = document.getElementById('studentFields');
        const nisInput = document.querySelector('input[name="nis"]');
        const classSelect = document.querySelector('select[name="class"]');

        if (this.value === 'student') {
            studentFields.style.display = 'block';
            nisInput.required = true;
            classSelect.required = true;
        } else {
            studentFields.style.display = 'none';
            nisInput.required = false;
            classSelect.required = false;
        }
    });

    // Trigger on page load if old value exists
    window.addEventListener('DOMContentLoaded', function() {
        const roleSelect = document.getElementById('roleSelect');
        if (roleSelect.value === 'student') {
            document.getElementById('studentFields').style.display = 'block';
        }
    });
</script>
@endpush
@endsection