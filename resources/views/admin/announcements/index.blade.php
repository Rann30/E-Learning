@extends('layouts.admin')

@section('title', 'Kelola Pengumuman')
@section('page-title', 'Kelola Pengumuman')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="bi bi-megaphone text-primary me-2"></i>
                Daftar Pengumuman ({{ $announcements->total() }})
            </h5>
            <a href="{{ route('admin.announcements.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>Buat Pengumuman
            </a>
        </div>
        <div class="card-body">
            @forelse($announcements as $announcement)
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="flex-grow-1">
                            <h5 class="mb-2">{{ $announcement->title }}</h5>
                            <p class="mb-2">{{ Str::limit($announcement->content, 200) }}</p>
                            <div class="mb-2">
                                @if($announcement->type === 'info')
                                <span class="badge bg-info">Info</span>
                                @elseif($announcement->type === 'warning')
                                <span class="badge bg-warning text-dark">Warning</span>
                                @elseif($announcement->type === 'success')
                                <span class="badge bg-success">Success</span>
                                @else
                                <span class="badge bg-danger">Danger</span>
                                @endif

                                @if($announcement->is_active)
                                <span class="badge bg-success">Aktif</span>
                                @else
                                <span class="badge bg-secondary">Tidak Aktif</span>
                                @endif
                            </div>
                            <small class="text-muted">
                                <i class="bi bi-person me-1"></i>{{ $announcement->creator->name }}
                                <span class="mx-2">•</span>
                                <i class="bi bi-clock me-1"></i>{{ $announcement->created_at->diffForHumans() }}
                            </small>
                        </div>
                        <div class="ms-3">
                            <div class="btn-group">
                                <a href="{{ route('admin.announcements.edit', $announcement->id) }}"
                                    class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.announcements.destroy', $announcement->id) }}"
                                    method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Yakin ingin menghapus pengumuman ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center py-5">
                <i class="bi bi-megaphone" style="font-size: 64px; color: #ddd;"></i>
                <h5 class="text-muted mt-3">Belum ada pengumuman</h5>
            </div>
            @endforelse

            <div class="d-flex justify-content-center mt-3">
                {{ $announcements->links() }}
            </div>
        </div>
    </div>
</div>
@endsection