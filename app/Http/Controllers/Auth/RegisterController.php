<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    /**
     * Tampilkan form register
     */
    public function showRegistrationForm()
    {
        // Jika sudah login, redirect
        if (Auth::check()) {
            return redirect()->route('student.dashboard');
        }

        return view('auth.register');
    }

    /**
     * Proses registrasi
     */
    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'nis' => ['required', 'string', 'unique:students,nis'],
            'class' => ['required', 'string'],
        ], [
            'name.required' => 'Nama lengkap wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
            'nis.required' => 'NIS wajib diisi',
            'nis.unique' => 'NIS sudah terdaftar',
            'class.required' => 'Kelas wajib dipilih',
        ]);

        try {
            // Gunakan database transaction untuk keamanan
            DB::beginTransaction();

            // Buat user baru
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'student', // Default role student
            ]);

            // Buat data student
            Student::create([
                'user_id' => $user->id,
                'nis' => $request->nis,
                'class' => $request->class,
                'status' => 'Belum Lulus',
                'points' => 0,
                'badges' => 0,
            ]);

            DB::commit();

            // Login otomatis setelah register
            Auth::login($user);

            return redirect()->route('student.dashboard')
                ->with('success', 'Registrasi berhasil! Selamat datang.');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan saat registrasi. Silakan coba lagi.']);
        }
    }
}
