<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Announcement;
use App\Models\Assignment;
use App\Models\Attendance;
use App\Models\Schedule;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $student = Auth::user()->student;

        if (!$student) {
            return redirect()->route('login')
                ->with('error', 'Data student tidak ditemukan');
        }

        $violationCard = $student->violationCards()
            ->where('is_active', true)
            ->first();

        $enrollments = $student->enrollments()
            ->where('is_active', true)
            ->with('course')
            ->get();
        $totalCourses = $enrollments->count();

        $announcements = Announcement::where('is_active', true)
            ->latest()
            ->take(3)
            ->get();

        $courseIds = $enrollments->pluck('course_id');
        $upcomingAssignments = Assignment::whereIn('course_id', $courseIds)
            ->where('deadline', '>', now())
            ->orderBy('deadline', 'asc')
            ->with('course')
            ->take(5)
            ->get();

        $submittedAssignments = $student->assignmentSubmissions()
            ->with('assignment.course')
            ->latest()
            ->take(3)
            ->get();


        // Jadwal hari ini
        $today = Carbon::now()->locale('id')->isoFormat('dddd'); // Senin, Selasa, dst
        $todayEnglish = Carbon::now()->format('l'); // Monday, Tuesday, dst

        $todaySchedules = Schedule::whereIn('course_id', $courseIds)
            ->where('day', $todayEnglish)
            ->orderBy('start_time')
            ->with('course')
            ->get();


        // Statistik kehadiran
        $attendanceStats = Attendance::where('student_id', $student->id)
            ->whereMonth('date', now()->month)
            ->whereYear('date', now()->year)
            ->get()
            ->groupBy('status')
            ->map->count();

        $totalAttendance = $attendanceStats->sum();
        $attendancePercentage = $totalAttendance > 0
            ? round(($attendanceStats->get('hadir', 0) / $totalAttendance) * 100, 1)
            : 0;

        $averageScore = $student->assignmentSubmissions()
            ->whereNotNull('score')
            ->avg('score') ?? 0;

        $badges = $this->getStudentBadges($student);

        return view('student.dashboard', compact(
            'student',
            'violationCard',
            'totalCourses',
            'enrollments',
            'announcements',
            'upcomingAssignments',
            'submittedAssignments',
            'todaySchedules',
            'today', // Tambahkan ini
            'attendanceStats',
            'attendancePercentage',
            'averageScore'
        ));
    }


    /**
     * Get student badges based on achievements
     */
    private function getStudentBadges($student)
    {
        $badges = [];

        // Badge berdasarkan poin pelanggaran
        if ($student->points < 10) {
            $badges[] = [
                'name' => 'Siswa Teladan',
                'icon' => asset('images/badges/excellent.png'),
                'description' => 'Memiliki poin pelanggaran rendah'
            ];
        } elseif ($student->points == 0) {
            $badges[] = [
                'name' => 'Siswa Berprestasi',
                'icon' => asset('images/badges/top-student.png'),
                'description' => 'Tidak memiliki poin pelanggaran'
            ];
        }

        // Badge berdasarkan nilai rata-rata
        if ($averageScore = $student->assignmentSubmissions()->whereNotNull('score')->avg('score')) {
            if ($averageScore >= 90) {
                $badges[] = [
                    'name' => 'Nilai Sempurna',
                    'icon' => asset('images/badges/perfect-score.png'),
                    'description' => 'Rata-rata nilai ≥ 90'
                ];
            } elseif ($averageScore >= 80) {
                $badges[] = [
                    'name' => 'Siswa Berbakat',
                    'icon' => asset('images/badges/talented.png'),
                    'description' => 'Rata-rata nilai ≥ 80'
                ];
            }
        }

        // Badge berdasarkan kehadiran
        $attendanceStats = Attendance::where('student_id', $student->id)
            ->whereMonth('date', now()->month)
            ->whereYear('date', now()->year)
            ->get()
            ->groupBy('status')
            ->map->count();

        $totalAttendance = $attendanceStats->sum();
        if ($totalAttendance > 0) {
            $presentRate = ($attendanceStats->get('hadir', 0) / $totalAttendance) * 100;

            if ($presentRate == 100) {
                $badges[] = [
                    'name' => 'Kehadiran 100%',
                    'icon' => asset('images/badges/perfect-attendance.png'),
                    'description' => 'Kehadiran bulan ini sempurna'
                ];
            } elseif ($presentRate >= 95) {
                $badges[] = [
                    'name' => 'Rajin Hadir',
                    'icon' => asset('images/badges/good-attendance.png'),
                    'description' => 'Kehadiran ≥ 95%'
                ];
            }
        }

        // Badge berdasarkan jumlah tugas diselesaikan tepat waktu
        $onTimeSubmissions = $student->assignmentSubmissions()
            ->where('submitted_at', '<=', \DB::raw('assignments.deadline'))
            ->join('assignments', 'assignment_submissions.assignment_id', '=', 'assignments.id')
            ->count();

        if ($onTimeSubmissions >= 10) {
            $badges[] = [
                'name' => 'Tepat Waktu',
                'icon' => asset('images/badges/punctual.png'),
                'description' => 'Selalu mengumpulkan tugas tepat waktu'
            ];
        }

        // Fallback badge jika tidak ada
        if (empty($badges)) {
            $badges[] = [
                'name' => 'Siswa Baru',
                'icon' => asset('images/badges/new-student.png'),
                'description' => 'Selamat bergabung!'
            ];
        }

        // Maksimal 3 badge yang ditampilkan
        return array_slice($badges, 0, 3);
    }

    // ... method lainnya tetap sama
    public function editProfile()
    {
        // ... kode tetap sama
    }

    public function updateProfile(Request $request)
    {
        // ... kode tetap sama
    }
}
