<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Tampilkan form login
     */
    public function showLoginForm()
    {
        // Jika sudah login, redirect ke dashboard sesuai role
        if (Auth::check()) {
            return $this->redirectBasedOnRole();
        }

        return view('auth.login');
    }

    /**
     * Proses login
     */
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password wajib diisi',
        ]);

        // Ambil credentials
        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember');

        // Coba login
        if (Auth::attempt($credentials, $remember)) {
            // Regenerate session untuk keamanan
            $request->session()->regenerate();

            // Redirect berdasarkan role user
            return $this->redirectBasedOnRole();
        }

        // Jika gagal, kembalikan dengan error
        throw ValidationException::withMessages([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ]);
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda berhasil logout');
    }

    /**
     * Redirect user berdasarkan role
     */
    protected function redirectBasedOnRole()
    {
        $user = Auth::user();

        // Redirect berdasarkan role
        switch ($user->role) {
            case 'student':
                return redirect()->route('student.dashboard');

            case 'teacher':
                return redirect()->route('teacher.dashboard');

            case 'admin':
                return redirect()->route('admin.dashboard');

            default:
                return redirect('/');
        }
    }
}
