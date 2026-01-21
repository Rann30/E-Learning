@extends('layouts.admin')

@section('title', 'Pengaturan')
@section('page-title', 'Pengaturan Sistem')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Pengaturan Umum</h5>
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Nama Aplikasi</label>
                            <input type="text" class="form-control" value="SMART BM3">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama Sekolah</label>
                            <input type="text" class="form-control" value="SMK 3 TAHUN PALAJARAN">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email Sistem</label>
                            <input type="email" class="form-control" value="admin@smartbm3.com">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tahun Ajaran</label>
                            <input type="text" class="form-control" value="2025/2026">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Timezone</label>
                            <select class="form-select">
                                <option selected>Asia/Jakarta</option>
                            </select>
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
                        <button class="btn btn-warning">
                            <i class="bi bi-arrow-clockwise me-2"></i>
                            Clear Cache
                        </button>
                        <button class="btn btn-info">
                            <i class="bi bi-database me-2"></i>
                            Backup Database
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection