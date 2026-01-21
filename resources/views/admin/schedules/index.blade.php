@extends('layouts.admin')

@section('title', 'Kelola Jadwal')
@section('page-title', 'Kelola Jadwal')

@section('content')
<div class="container-fluid">
    <div class="card mb-4">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="bi bi-calendar-week text-primary me-2"></i>
                Jadwal Kelas
            </h5>
            <a href="{{ route('admin.schedules.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>Tambah Jadwal
            </a>
        </div>
        <div class="card-body">
            @php
            $dayIndo = [
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu',
            'Sunday' => 'Minggu'
            ];
            @endphp

            @foreach($days as $day)
            @php
            $daySchedules = $schedules->get($day, collect());
            @endphp

            @if($daySchedules->isNotEmpty())
            <div class="mb-4">
                <h5 class="mb-3 text-primary">
                    <i class="bi bi-calendar-day me-2"></i>
                    {{ $dayIndo[$day] ?? $day }}
                </h5>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Waktu</th>
                                <th>Kursus</th>
                                <th>Kode</th>
                                <th>Ruangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($daySchedules as $schedule)
                            <tr>
                                <td>
                                    <strong>{{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}</strong>
                                    -
                                    <strong>{{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}</strong>
                                </td>
                                <td>{{ $schedule->course->name }}</td>
                                <td><span class="badge bg-primary">{{ $schedule->course->code }}</span></td>
                                <td>{{ $schedule->room ?? '-' }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.schedules.edit', $schedule->id) }}"
                                            class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.schedules.destroy', $schedule->id) }}"
                                            method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
            @endforeach

            @if($schedules->isEmpty())
            <div class="text-center py-5">
                <i class="bi bi-calendar-x" style="font-size: 64px; color: #ddd;"></i>
                <h5 class="text-muted mt-3">Belum ada jadwal</h5>
                <p class="text-muted">Klik tombol "Tambah Jadwal" untuk membuat jadwal baru</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection