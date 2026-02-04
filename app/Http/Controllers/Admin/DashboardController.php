<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Course;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung total users berdasarkan role
        $totalStudents = User::where('role', 'student')->count();
        $totalTeachers = User::where('role', 'teacher')->count();

        // Hitung total courses dan classes (jika ada model Class)
        $totalCourses = Course::count();
        $totalClasses = 0; // Sesuaikan dengan model Class jika ada

        // Ambil recent users (5 terbaru)
        $recentUsers = User::latest()
            ->take(5)
            ->get();

        // Ambil recent activities (10 terbaru)
        // Jika tidak ada model ActivityLog, gunakan array kosong
        try {
            $recentActivities = ActivityLog::with('user')
                ->latest()
                ->take(10)
                ->get();
        } catch (\Exception $e) {
            $recentActivities = collect(); // Empty collection
        }

        return view('admin.dashboard', compact(
            'totalStudents',
            'totalTeachers',
            'totalCourses',
            'totalClasses',
            'recentUsers',
            'recentActivities'
        ));
    }
}
