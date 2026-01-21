@extends('layouts.admin')

@section('title', 'Activity Logs')
@section('page-title', 'Activity Logs')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-white">
            <h5 class="mb-0">
                <i class="bi bi-clock-history text-primary me-2"></i>
                Riwayat Aktivitas ({{ $logs->total() }})
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Waktu</th>
                            <th>User</th>
                            <th>Action</th>
                            <th>Model</th>
                            <th>Description</th>
                            <th>IP Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($logs as $log)
                        <tr>
                            <td>{{ $log->created_at->format('d M Y, H:i') }}</td>
                            <td>{{ $log->user->name ?? 'System' }}</td>
                            <td>
                                @if($log->action === 'create')
                                <span class="badge bg-success">Create</span>
                                @elseif($log->action === 'update')
                                <span class="badge bg-primary">Update</span>
                                @elseif($log->action === 'delete')
                                <span class="badge bg-danger">Delete</span>
                                @else
                                <span class="badge bg-secondary">{{ $log->action }}</span>
                                @endif
                            </td>
                            <td><code>{{ $log->model }}</code></td>
                            <td>{{ $log->description }}</td>
                            <td><small>{{ $log->ip_address }}</small></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">Belum ada log aktivitas</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-3">
                {{ $logs->links() }}
            </div>
        </div>
    </div>
</div>
@endsection