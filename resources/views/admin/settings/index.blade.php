@extends('layouts.admin')

@section('title', 'Pengaturan')
@section('page-title', 'Pengaturan Sistem')

@section('content')
<div class="container-fluid">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Pengaturan Umum</h5>
                    <form action="{{ route('admin.settings.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Nama Aplikasi</label>
                            <input type="text"
                                class="form-control @error('app_name') is-invalid @enderror"
                                name="app_name"
                                value="{{ old('app_name', $settings['app_name'] ?? 'SMART BM3') }}"
                                required>
                            @error('app_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama Sekolah</label>
                            <input type="text"
                                class="form-control @error('school_name') is-invalid @enderror"
                                name="school_name"
                                value="{{ old('school_name', $settings['school_name'] ?? 'SMK 3 TAHUN PALAJARAN') }}"
                                required>
                            @error('school_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email Sistem</label>
                            <input type="email"
                                class="form-control @error('system_email') is-invalid @enderror"
                                name="system_email"
                                value="{{ old('system_email', $settings['system_email'] ?? 'admin@smartbm3.com') }}"
                                required>
                            @error('system_email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tahun Ajaran</label>
                            <input type="text"
                                class="form-control @error('academic_year') is-invalid @enderror"
                                name="academic_year"
                                value="{{ old('academic_year', $settings['academic_year'] ?? '2025/2026') }}"
                                required>
                            @error('academic_year')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Timezone</label>
                            <select class="form-select @error('timezone') is-invalid @enderror"
                                name="timezone"
                                required>
                                <option value="Asia/Jakarta" {{ old('timezone', $settings['timezone'] ?? 'Asia/Jakarta') == 'Asia/Jakarta' ? 'selected' : '' }}>Asia/Jakarta</option>
                                <option value="Asia/Makassar" {{ old('timezone', $settings['timezone'] ?? '') == 'Asia/Makassar' ? 'selected' : '' }}>Asia/Makassar</option>
                                <option value="Asia/Jayapura" {{ old('timezone', $settings['timezone'] ?? '') == 'Asia/Jayapura' ? 'selected' : '' }}>Asia/Jayapura</option>
                            </select>
                            @error('timezone')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr class="my-4">

                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-2"></i>Simpan Pengaturan
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title mb-3">Informasi Sistem</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <strong>Laravel Version:</strong> {{ app()->version() }}
                        </li>
                        <li class="mb-2">
                            <strong>PHP Version:</strong> {{ phpversion() }}
                        </li>
                        <li class="mb-2">
                            <strong>Environment:</strong> {{ config('app.env') }}
                        </li>
                    </ul>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">Maintenance</h5>
                    <div class="d-grid gap-2">
                        <form action="{{ route('admin.settings.clear-cache') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-warning w-100">
                                <i class="bi bi-arrow-clockwise me-2"></i>
                                Clear Cache
                            </button>
                        </form>

                        <form action="{{ route('admin.settings.backup') }}" method="POST" class="mt-2">
                            @csrf
                            <button type="submit" class="btn btn-info w-100">
                                <i class="bi bi-database me-2"></i>
                                Backup Database
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection