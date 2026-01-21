@extends('layouts.admin')

@section('title', 'Tambah Jadwal')
@section('page-title', 'Tambah Jadwal Baru')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.schedules.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Kursus</label>
                            <select class="form-select @error('course_id') is-invalid @enderror"
                                name="course_id"
                                required>
                                <option value="">-- Pilih Kursus --</option>
                                @foreach($courses as $course)
                                <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                    {{ $course->code }} - {{ $course->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('course_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Hari</label>
                            <select class="form-select @error('day') is-invalid @enderror"
                                name="day"
                                required>
                                <option value="">-- Pilih Hari --</option>
                                <option value="Monday" {{ old('day') == 'Monday' ? 'selected' : '' }}>Senin</option>
                                <option value="Tuesday" {{ old('day') == 'Tuesday' ? 'selected' : '' }}>Selasa</option>
                                <option value="Wednesday" {{ old('day') == 'Wednesday' ? 'selected' : '' }}>Rabu</option>
                                <option value="Thursday" {{ old('day') == 'Thursday' ? 'selected' : '' }}>Kamis</option>
                                <option value="Friday" {{ old('day') == 'Friday' ? 'selected' : '' }}>Jumat</option>
                                <option value="Saturday" {{ old('day') == 'Saturday' ? 'selected' : '' }}>Sabtu</option>
                            </select>
                            @error('day')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Waktu Mulai</label>
                                <input type="time"
                                    class="form-control @error('start_time') is-invalid @enderror"
                                    name="start_time"
                                    value="{{ old('start_time') }}"
                                    required>
                                @error('start_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Waktu Selesai</label>
                                <input type="time"
                                    class="form-control @error('end_time') is-invalid @enderror"
                                    name="end_time"
                                    value="{{ old('end_time') }}"
                                    required>
                                @error('end_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ruangan (Opsional)</label>
                            <input type="text"
                                class="form-control @error('room') is-invalid @enderror"
                                name="room"
                                value="{{ old('room') }}"
                                placeholder="Contoh: Lab Komputer 1">
                            @error('room')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr class="my-4">

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-2"></i>Simpan
                            </button>
                            <a href="{{ route('admin.schedules.index') }}" class="btn btn-secondary">
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