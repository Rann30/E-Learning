@extends('layouts.admin')

@section('title', 'Kartu Pelanggaran')
@section('page-title', 'Kartu Pelanggaran')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="bi bi-exclamation-triangle text-danger me-2"></i>
                Daftar Kartu Pelanggaran ({{ $violations->total() }})
            </h5>
            <a href="{{ route('admin.violations.create') }}" class="btn btn-danger">
                <i class="bi bi-plus-circle me-2"></i>Buat Kartu Pelanggaran
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nomor Kartu</th>
                            <th>NIS</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Deskripsi</th>
                            <th>Status</th>
                            <th>Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($violations as $index => $violation)
                        <tr>
                            <td>{{ $violations->firstItem() + $index }}</td>
                            <td><strong class="text-danger">{{ $violation->card_number }}</strong></td>
                            <td>{{ $violation->student->nis }}</td>
                            <td>{{ $violation->student->user->name }}</td>
                            <td><span class="badge bg-primary">{{ $violation->student->class }}</span></td>
                            <td>{{ Str::limit($violation->description, 50) }}</td>
                            <td>
                                @if($violation->is_active)
                                <span class="badge bg-danger">Aktif</span>
                                @else
                                <span class="badge bg-secondary">Tidak Aktif</span>
                                @endif
                            </td>
                            <td>{{ $violation->created_at->format('d M Y') }}</td>
                            <td>
                                <form action="{{ route('admin.violations.destroy', $violation->id) }}"
                                    method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Yakin ingin menghapus kartu ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted py-4">
                                <i class="bi bi-inbox" style="font-size: 48px;"></i>
                                <p class="mt-2">Belum ada kartu pelanggaran</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-3">
                {{ $violations->links() }}
            </div>
        </div>
    </div>
</div>
@endsection