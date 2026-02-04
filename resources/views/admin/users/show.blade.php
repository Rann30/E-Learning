@extends('layouts.admin')

@section('title', 'Detail User')
@section('page-title', 'Detail User')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&size=150&background=random"
                        class="rounded-circle mb-3"
                        style="width: 150px; height: 150px; border: 5px solid #3b82f6;"
                        alt="Avatar">
                    <h4>{{ $user->name }}</h4>
                    <p class="text-muted">{{ $user->email }}</p>

                    @if($user->role === 'admin')
                    <span class="badge bg-danger mb-3">Admin</span>
                    @elseif($user->role === 'teacher')
                    <span class="badge bg-success mb-3">Teacher</span>
                    @else
                    <span class="badge bg-primary mb-3">Student</span>
                    @endif

                    <hr>

                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning">
                            <i class="bi bi-pencil me-2"></i>Edit User
                        </a>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Informasi User</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Nama Lengkap:</strong></div>
                        <div class="col-md-8">{{ $user->name }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Email:</strong></div>
                        <div class="col-md-8">{{ $user->email }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Role:</strong></div>
                        <div class="col-md-8">
                            @if($user->role === 'admin')
                            <span class="badge bg-danger">Admin</span>
                            @elseif($user->role === 'teacher')
                            <span class="badge bg-success">Teacher</span>
                            @else
                            <span class="badge bg-primary">Student</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Terdaftar:</strong></div>
                        <div class="col-md-8">{{ $user->created_at->format('d M Y, H:i') }}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"><strong>Terakhir Update:</strong></div>
                        <div class="col-md-8">{{ $user->updated_at->format('d M Y, H:i') }}</div>
                    </div>

                    @if($user->role === 'student' && $user->student)
                    <hr>
                    <h6 class="mt-4 mb-3">Data Student</h6>
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>NIS:</strong></div>
                        <div class="col-md-8">{{ $user->student->nis }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Kelas:</strong></div>
                        <div class="col-md-8"><span class="badge bg-primary">{{ $user->student->class }}</span></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Status:</strong></div>
                        <div class="col-md-8">
                            <span class="badge bg-{{ $user->student->status === 'Lulus' ? 'success' : 'warning' }}">
                                {{ $user->student->status }}
                            </span>
                        </div>
                    </div>

                    @endif

                    @if($user->role === 'teacher')
                    <hr>
                    <h6 class="mt-4 mb-3">mata pelajaran yang Diajar</h6>
                    @if($user->courses && $user->courses->count() > 0)
                    @foreach($user->courses as $course)
                    <div class="alert alert-info mb-2">
                        <strong>{{ $course->name }}</strong> ({{ $course->code }})
                    </div>
                    @endforeach
                    @else
                    <p class="text-muted">Belum mengajar mata pelajaran apapun</p>
                    @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection