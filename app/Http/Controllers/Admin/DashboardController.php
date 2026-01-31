<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Assignment;

use App\Models\ActivityLog;
use App\Models\Attendance;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Total Statistics
        $totalStudents = User::where('role', 'student')->count();
        $totalTeachers = User::where('role', 'teacher')->count();
        $totalAdmins = User::where('role', 'admin')->count();
        $totalCourses = Course::count();
        $totalEnrollments = Enrollment::where('is_active', true)->count();
        $totalAssignments = Assignment::count();

        // Recent Activities (10 terakhir)
        $recentActivities = ActivityLog::with('user')
            ->latest()
            ->take(10)
            ->get();

        // Recent Users (5 terakhir)
        $recentUsers = User::latest()->take(5)->get();



        // Enrollment per bulan (6 bulan terakhir)
        $enrollmentStats = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $enrollmentStats[] = [
                'month' => $month->format('M Y'),
                'count' => Enrollment::whereYear('created_at', $month->year)
                    ->whereMonth('created_at', $month->month)
                    ->count()
            ];
        }

        // Attendance summary hari ini
        $todayAttendance = [
            'hadir' => Attendance::whereDate('date', today())->where('status', 'hadir')->count(),
            'izin' => Attendance::whereDate('date', today())->where('status', 'izin')->count(),
            'sakit' => Attendance::whereDate('date', today())->where('status', 'sakit')->count(),
            'alpha' => Attendance::whereDate('date', today())->where('status', 'alpha')->count(),
        ];

        // Top 5 popular courses
        $popularCourses = Course::withCount('enrollments')
            ->orderBy('enrollments_count', 'desc')
            ->take(5)
            ->get();

        return view('Admin.dashboard', compact(
            'totalStudents',
            'totalTeachers',
            'totalAdmins',
            'totalCourses',
            'totalEnrollments',
            'totalAssignments',

            'recentActivities',
            'recentUsers',

            'enrollmentStats',
            'todayAttendance',
            'popularCourses'
        ));
    }
}
