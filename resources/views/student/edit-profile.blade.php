@extends('layouts.student')

@section('title', 'Edit Profile')
@section('page-title', 'EDIT PROFILE')

@push('styles')
<style>
    .profile-preview {
        width: 200px;
        height: 200px;
        border-radius: 50%;
        object-fit: cover;
        border: 5px solid #667eea;
        margin-bottom: 20px;
    }

    .upload-area {
        border: 2px dashed #ddd;
        border-radius: 15px;
        padding: 30px;
        text-align: center;
        background: #f8f9fa;
        transition: all 0.3s;
        cursor: pointer;
    }

    .upload-area:hover {
        border-color: #667eea;
        background: #f0f0ff;
    }

    .upload-icon {
        font-size: 48px;
        color: #667eea;
        margin-bottom: 15px;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h4 class="mb-4">
                        <i class="bi bi-person-circle me-2 text-primary"></i>
                        Edit Profile
                    </h4>

                    <form action="{{ route('student.update-profile') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Photo Preview -->
                        <div class="text-center mb-4">
                            <img src="{{ $student->photo ? asset($student->photo) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&size=200' }}"
                                alt="Profile"
                                class="profile-preview"
                                id="preview-image">
                        </div>

                        <!-- Upload Photo -->
                        <div class="mb-4">
                            <label class="form-label">
                                <i class="bi bi-image me-1"></i>
                                Foto Profile
                            </label>

                            <div class="upload-area" onclick="document.getElementById('photo-input').click()">
                                <i class="bi bi-cloud-upload upload-icon"></i>
                                <h6>Klik untuk upload foto</h6>
                                <p class="text-muted mb-0 small">Format: JPG, PNG, GIF (Max: 2MB)</p>
                            </div>

                            <input type="file"
                                class="form-control d-none @error('photo') is-invalid @enderror"
                                id="photo-input"
                                name="photo"
                                accept="image/*"
                                onchange="previewImage(event)">

                            @error('photo')
                            <div class="text-danger mt-2">
                                <small><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</small>
                            </div>
                            @enderror

                            <small class="text-muted d-block mt-2">
                                <i class="bi bi-info-circle me-1"></i>
                                Foto profile akan ditampilkan di dashboard dan profil Anda
                            </small>
                        </div>

                        <hr class="my-4">

                        <!-- Informasi yang tidak bisa diubah -->
                        <h5 class="mb-3">Informasi Pribadi</h5>
                        <p class="text-muted small mb-3">
                            <i class="bi bi-lock me-1"></i>
                            Data berikut tidak dapat diubah. Hubungi admin jika ada kesalahan data.
                        </p>

                        <div class="mb-3">
                            <label class="form-label">
                                <i class="bi bi-person me-1"></i>
                                Nama Lengkap
                            </label>
                            <input type="text"
                                class="form-control"
                                value="{{ Auth::user()->name }}"
                                disabled>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                <i class="bi bi-envelope me-1"></i>
                                Email
                            </label>
                            <input type="email"
                                class="form-control"
                                value="{{ Auth::user()->email }}"
                                disabled>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">
                                    <i class="bi bi-card-text me-1"></i>
                                    NIS
                                </label>
                                <input type="text"
                                    class="form-control"
                                    value="{{ $student->nis }}"
                                    disabled>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">
                                    <i class="bi bi-building me-1"></i>
                                    Kelas
                                </label>
                                <input type="text"
                                    class="form-control"
                                    value="{{ $student->class }}"
                                    disabled>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">
                                <i class="bi bi-flag me-1"></i>
                                Status
                            </label>
                            <input type="text"
                                class="form-control"
                                value="{{ $student->status }}"
                                disabled>
                        </div>

                        <hr class="my-4">

                        <!-- Buttons -->
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

            <!-- Info Card -->
            <div class="card mt-4">
                <div class="card-body">
                    <h6 class="mb-3">
                        <i class="bi bi-info-circle text-primary me-2"></i>
                        Informasi
                    </h6>
                    <ul class="mb-0">
                        <li class="mb-2">Foto profile digunakan untuk identitas Anda di sistem</li>
                        <li class="mb-2">Ukuran foto maksimal 2MB</li>
                        <li class="mb-2">Format yang didukung: JPG, PNG, GIF</li>
                        <li class="mb-2">Untuk mengubah data pribadi (nama, email, NIS, kelas), hubungi admin</li>
                        <li>Pastikan foto yang diupload jelas dan sesuai</li>
                    </ul>
                </div>
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

        if (event.target.files && event.target.files[0]) {
            reader.readAsDataURL(event.target.files[0]);
        }
    }

    // Drag & Drop Support
    const uploadArea = document.querySelector('.upload-area');
    const fileInput = document.getElementById('photo-input');

    uploadArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        uploadArea.style.borderColor = '#667eea';
        uploadArea.style.background = '#f0f0ff';
    });

    uploadArea.addEventListener('dragleave', () => {
        uploadArea.style.borderColor = '#ddd';
        uploadArea.style.background = '#f8f9fa';
    });

    uploadArea.addEventListener('drop', (e) => {
        e.preventDefault();
        uploadArea.style.borderColor = '#ddd';
        uploadArea.style.background = '#f8f9fa';

        const files = e.dataTransfer.files;
        if (files.length > 0) {
            fileInput.files = files;
            previewImage({
                target: fileInput
            });
        }
    });
</script>
@endpush
@endsection