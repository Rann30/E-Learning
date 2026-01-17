@extends('layouts.student')

@section('title', 'Data Kehadiran')
@section('page-title', 'DATA KEHADIRAN')

@push('styles')
<style>
    .attendance-card {
        border-radius: 15px;
        padding: 20px;
        text-align: center;
        margin-bottom: 20px;
    }

    .attendance-hadir {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        color: white;
    }

    .attendance-izin {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
    }

    .attendance-sakit {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        color: white;
    }

    .attendance-alpha {
        background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        color: white;
    }

    .attendance-value {
        font-size: 36px;
        font-weight: bold;
        margin: 10px 0;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="attendance-card attendance-hadir">
                <i class="bi bi-check-circle" style="font-size: 32px;"></i>
                <div class="attendance-value">{{ $attendances->where('status', 'hadir')->count() }}</div>
                <div>Hadir</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="attendance-card attendance-izin">
                <i class="bi bi-file-earmark-text" style="font-size: 32px;"></i>
                <div class="attendance-value">{{ $attendances->where('status', 'izin')->count() }}</div>
                <div>Izin</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="attendance-card attendance-sakit">
                <i class="bi bi-thermometer" style="font-size: 32px;"></i>
                <div class="attendance-value">{{ $attendances->where('status', 'sakit')->count() }}</div>
                <div>Sakit</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="attendance-card attendance-alpha">
                <i class="bi bi-x-circle" style="font-size: 32px;"></i>
                <div class="attendance-value">{{ $attendances->where('status', 'alpha')->count() }}</div>
                <div>Alpha</div>
            </div>
        </div>
    </div>

    <!-- Attendance Table -->
    <div class="card">
        <div class="card-header bg-white">
            <h5 class="mb-0">
                <i class="bi bi-calendar-week text-primary me-2"></i>
                Riwayat Kehadiran
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Hari</th>
                            <th>Kursus</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($attendances as $index => $attendance)
                        <tr>
                            <td>{{ $attendances->firstItem() + $index }}</td>
                            <td>{{ $attendance->date->format('d M Y') }}</td>
                            <td>{{ $attendance->date->locale('id')->isoFormat('dddd') }}</td>
                            <td>{{ $attendance->course->name }}</td>
                            <td>
                                @if($attendance->status === 'hadir')
                                <span class="badge bg-success">
                                    <i class="bi bi-check-circle me-1"></i>Hadir
                                </span>
                                @elseif($attendance->status === 'izin')
                                <span class="badge bg-warning">
                                    <i class="bi bi-file-earmark-text me-1"></i>Izin
                                </span>
                                @elseif($attendance->status === 'sakit')
                                <span class="badge bg-info">
                                    <i class="bi bi-thermometer me-1"></i>Sakit
                                </span>
                                @else
                                <span class="badge bg-danger">
                                    <i class="bi bi-x-circle me-1"></i>Alpha
                                </span>
                                @endif
                            </td>
                            <td>{{ $attendance->note ?? '-' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                <i class="bi bi-calendar-x" style="font-size: 48px;"></i>
                                <p class="mt-2">Belum ada data kehadiran</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-3">
                {{ $attendances->links() }}
            </div>
        </div>
    </div>
</div>
@endsection