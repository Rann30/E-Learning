@extends('layouts.admin')

@section('title', 'Laporan')
@section('page-title', 'Laporan & Statistik')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">
                        <i class="bi bi-file-earmark-text text-primary me-2"></i>
                        Laporan Tersedia
                    </h5>
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">Laporan Kehadiran</h6>
                                    <small class="text-muted">Rekap kehadiran siswa per periode</small>
                                </div>
                                <i class="bi bi-download"></i>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">Laporan Nilai</h6>
                                    <small class="text-muted">Rekap nilai siswa per kursus</small>
                                </div>
                                <i class="bi bi-download"></i>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">Laporan Enrollment</h6>
                                    <small class="text-muted">Data enrollment per kursus</small>
                                </div>
                                <i class="bi bi-download"></i>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">Laporan Pelanggaran</h6>
                                    <small class="text-muted">Data kartu pelanggaran siswa</small>
                                </div>
                                <i class="bi bi-download"></i>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">
                        <i class="bi bi-gear text-success me-2"></i>
                        Generate Custom Report
                    </h5>
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Tipe Laporan</label>
                            <select class="form-select">
                                <option>Kehadiran</option>
                                <option>Nilai</option>
                                <option>Enrollment</option>
                                <option>Pelanggaran</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Dari Tanggal</label>
                                <input type="date" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Sampai Tanggal</label>
                                <input type="date" class="form-control">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-file-earmark-arrow-down me-2"></i>
                            Generate Report
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="alert alert-info">
        <i class="bi bi-info-circle me-2"></i>
        <strong>Info:</strong> Fitur export laporan dalam pengembangan. Saat ini hanya menampilkan preview data.
    </div>
</div>
@endsection
````