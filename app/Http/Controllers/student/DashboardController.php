<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Tampilkan dashboard student
     */
    public function index()
    {
        // Ambil data student yang sedang login
        $student = Auth::user()->student;

        // Jika user tidak punya data student, redirect
        if (!$student) {
            return redirect()->route('login')
                ->with('error', 'Data student tidak ditemukan');
        }

        // Ambil violation card yang aktif
        $violationCard = $student->violationCards()
            ->where('is_active', true)
            ->first();

        // Hitung jumlah course yang diambil
        $totalCourses = $student->enrollments()
            ->where('is_active', true)
            ->count();

        return view('student.dashboard', compact('student', 'violationCard', 'totalCourses'));
    }

    /**
     * Tampilkan form edit profile
     */
    public function editProfile()
    {
        $student = Auth::user()->student;

        if (!$student) {
            return redirect()->route('login')
                ->with('error', 'Data student tidak ditemukan');
        }

        return view('student.edit-profile', compact('student'));
    }

    /**
     * Update profile
     */
    public function updateProfile(Request $request)
    {
        $request->validate([
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'photo.image' => 'File harus berupa gambar',
            'photo.mimes' => 'Format gambar harus: jpeg, png, jpg, atau gif',
            'photo.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        $student = Auth::user()->student;

        if (!$student) {
            return redirect()->route('login')
                ->with('error', 'Data student tidak ditemukan');
        }

        try {
            // Handle upload foto
            if ($request->hasFile('photo')) {
                // Hapus foto lama jika ada
                if ($student->photo && file_exists(public_path($student->photo))) {
                    unlink(public_path($student->photo));
                }

                // Upload foto baru
                $file = $request->file('photo');
                $filename = time() . '_' . $file->getClientOriginalName();

                // Buat folder jika belum ada
                if (!file_exists(public_path('uploads/students'))) {
                    mkdir(public_path('uploads/students'), 0755, true);
                }

                $file->move(public_path('uploads/students'), $filename);
                $student->photo = 'uploads/students/' . $filename;
            }

            $student->save();

            return redirect()->route('student.dashboard')
                ->with('success', 'Profile berhasil diupdate!');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
