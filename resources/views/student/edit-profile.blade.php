@extends('layouts.student')

@section('title', 'Edit Profile')
@section('page-title', 'EDIT PROFILE')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h4 class="mb-4"><i class="bi bi-person-circle me-2"></i>Edit Profile</h4>

                <form action="{{ route('student.update-profile') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="text-center mb-4">
                        <img src="{{ $student->photo ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}"
                            alt="Profile"
                            class="rounded-circle mb-3"
                            style="width: 150px; height: 150px; object-fit: cover;"
                            id="preview-image">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" value="{{ Auth::user()->name }}" disabled>
                        <small class="text-muted">Nama tidak dapat diubah</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">NIS</label>
                        <input type="text" class="form-control" value="{{ $student->nis }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kelas</label>
                        <input type="text" class="form-control" value="{{ $student->class }}" disabled>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Foto Profile</label>
                        <input type="file"
                            class="form-control @error('photo') is-invalid @enderror"
                            name="photo"
                            accept="image/*"
                            onchange="previewImage(event)">
                        @error('photo')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Format: JPG, PNG. Max: 2MB</small>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-2"></i>Simpan Perubahan
                        </button>
                        <a href="{{ route('student.dashboard') }}" class="btn btn-secondary">
                            <i class="bi bi-x-circle me-2"></i>Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const preview = document.getElementById('preview-image');
            preview.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endpush
@endsection