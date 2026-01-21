@extends('layouts.admin')

@section('title', 'Edit Pengumuman')
@section('page-title', 'Edit Pengumuman')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.announcements.update', $announcement->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Judul Pengumuman</label>
                            <input type="text"
                                class="form-control @error('title') is-invalid @enderror"
                                name="title"
                                value="{{ old('title', $announcement->title) }}"
                                required>
                            @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Isi Pengumuman</label>
                            <textarea class="form-control @error('content') is-invalid @enderror"
                                name="content"
                                rows="6"
                                required>{{ old('content', $announcement->content) }}</textarea>
                            @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tipe</label>
                                <select class="form-select @error('type') is-invalid @enderror"
                                    name="type"
                                    required>
                                    <option value="info" {{ old('type', $announcement->type) == 'info' ? 'selected' : '' }}>Info</option>
                                    <option value="warning" {{ old('type', $announcement->type) == 'warning' ? 'selected' : '' }}>Warning</option>
                                    <option value="success" {{ old('type', $announcement->type) == 'success' ? 'selected' : '' }}>Success</option>
                                    <option value="danger" {{ old('type', $announcement->type) == 'danger' ? 'selected' : '' }}>Danger</option>
                                </select>
                                @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Status</label>
                                <select class="form-select @error('is_active') is-invalid @enderror"
                                    name="is_active"
                                    required>
                                    <option value="1" {{ old('is_active', $announcement->is_active) == '1' ? 'selected' : '' }}>Aktif</option>
                                    <option value="0" {{ old('is_active', $announcement->is_active) == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                                </select>
                                @error('is_active')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-2"></i>Update
                            </button>
                            <a href="{{ route('admin.announcements.index') }}" class="btn btn-secondary">
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