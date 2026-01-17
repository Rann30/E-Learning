@extends('layouts.student')

@section('title', 'Pengumuman')
@section('page-title', 'PENGUMUMAN')

@push('styles')
<style>
    .announcement-card {
        border-left: 4px solid #667eea;
        transition: all 0.3s;
        margin-bottom: 20px;
    }

    .announcement-card:hover {
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        transform: translateY(-3px);
    }

    .announcement-info {
        border-left: 4px solid #667eea;
    }

    .announcement-warning {
        border-left: 4px solid #ffc107;
    }

    .announcement-success {
        border-left: 4px solid #28a745;
    }

    .announcement-danger {
        border-left: 4px solid #dc3545;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    @forelse($announcements as $announcement)
    <div class="card announcement-card announcement-{{ $announcement->type }}">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="flex-grow-1">
                    <h5 class="mb-2">{{ $announcement->title }}</h5>
                    <div class="mb-2">
                        @if($announcement->type === 'info')
                        <span class="badge bg-info">
                            <i class="bi bi-info-circle me-1"></i>Informasi
                        </span>
                        @elseif($announcement->type === 'warning')
                        <span class="badge bg-warning text-dark">
                            <i class="bi bi-exclamation-triangle me-1"></i>Penting
                        </span>
                        @elseif($announcement->type === 'success')
                        <span class="badge bg-success">
                            <i class="bi bi-check-circle me-1"></i>Pengumuman
                        </span>
                        @else
                        <span class="badge bg-danger">
                            <i class="bi bi-exclamation-circle me-1"></i>Urgent
                        </span>
                        @endif
                    </div>
                    <p class="mb-3">{{ $announcement->content }}</p>
                    <small class="text-muted">
                        <i class="bi bi-person me-1"></i>{{ $announcement->creator->name }}
                        <span class="mx-2">•</span>
                        <i class="bi bi-clock me-1"></i>{{ $announcement->created_at->diffForHumans() }}
                    </small>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="text-center py-5">
        <i class="bi bi-megaphone" style="font-size: 64px; color: #ddd;"></i>
        <h5 class="text-muted mt-3">Belum ada pengumuman</h5>
        <p class="text-muted">Pengumuman akan muncul di sini</p>
    </div>
    @endforelse

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $announcements->links() }}
    </div>
</div>
@endsection