<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - E-Learning</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .register-container {
            max-width: 500px;
            width: 100%;
        }

        .register-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            padding: 40px;
        }

        .register-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .register-header h2 {
            color: #4A5D7E;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .register-header p {
            color: #6B7280;
            font-size: 14px;
        }

        .logo {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            color: white;
            font-size: 30px;
        }

        .form-control,
        .form-select {
            border-radius: 10px;
            padding: 12px 15px;
            border: 2px solid #E5E7EB;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .btn-register {
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            font-weight: 600;
            margin-top: 20px;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.4);
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            color: #6B7280;
        }

        .login-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }

        .alert {
            border-radius: 10px;
            border: none;
        }
    </style>
</head>

<body>
    <div class="register-container">
        <div class="register-card">
            <div class="register-header">
                <div class="logo">
                    <i class="bi bi-person-plus-fill"></i>
                </div>
                <h2>Daftar Akun</h2>
                <p>SMART BM3 E-Learning</p>
            </div>

            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><i class="bi bi-exclamation-triangle me-2"></i>Terjadi Kesalahan:</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Lengkap</label>
                    <input type="text"
                        class="form-control @error('name') is-invalid @enderror"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        placeholder="Masukkan nama lengkap">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Email</label>
                    <input type="email"
                        class="form-control @error('email') is-invalid @enderror"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        placeholder="nama@email.com">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">NIS</label>
                    <input type="text"
                        class="form-control @error('nis') is-invalid @enderror"
                        name="nis"
                        value="{{ old('nis') }}"
                        required
                        placeholder="Nomor Induk Siswa">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Kelas</label>
                    <select class="form-select @error('class') is-invalid @enderror"
                        name="class"
                        required>
                        <option value="">Pilih Kelas</option>
                        <option value="X RPL 1" {{ old('class') == 'X RPL 1' ? 'selected' : '' }}>X RPL 1</option>
                        <option value="X RPL 2" {{ old('class') == 'X RPL 2' ? 'selected' : '' }}>X RPL 2</option>
                        <option value="XI RPL 1" {{ old('class') == 'XI RPL 1' ? 'selected' : '' }}>XI RPL 1</option>
                        <option value="XI RPL 2" {{ old('class') == 'XI RPL 2' ? 'selected' : '' }}>XI RPL 2</option>
                        <option value="XII RPL 1" {{ old('class') == 'XII RPL 1' ? 'selected' : '' }}>XII RPL 1</option>
                        <option value="XII RPL 2" {{ old('class') == 'XII RPL 2' ? 'selected' : '' }}>XII RPL 2</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Password</label>
                    <input type="password"
                        class="form-control @error('password') is-invalid @enderror"
                        name="password"
                        required
                        placeholder="Minimal 8 karakter">
                    <small class="text-muted">Minimal 8 karakter</small>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Konfirmasi Password</label>
                    <input type="password"
                        class="form-control"
                        name="password_confirmation"
                        required
                        placeholder="Ketik ulang password">
                </div>

                <button type="submit" class="btn btn-register">
                    <i class="bi bi-person-check me-2"></i>Daftar Sekarang
                </button>

                <div class="login-link">
                    Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>