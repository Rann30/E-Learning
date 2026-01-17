<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Announcement;
use App\Models\Assignment;
use App\Models\Schedule;
use App\Models\ViolationCard;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class StudentController extends Controller
{
    public function dashboard()
    {
        $student = Auth::user()->student;

        // Prepare badges (dipindahkan dari view ke controller)
        $badges = $this->getStudentBadges($student);

        // Data untuk dashboard
        $data = [
            'student' => $student,
            'badges' => $badges,
            'totalCourses' => $student->courses()->count(),
            'upcomingAssignments' => $this->getUpcomingAssignments($student),
            'attendancePercentage' => $this->calculateAttendancePercentage($student),
            'averageScore' => $this->calculateAverageScore($student),
            'announcements' => $this->getLatestAnnouncements(),
            'todaySchedules' => $this->getTodaySchedules($student),
            'today' => Carbon::now()->translatedFormat('d F Y'),
            'attendanceStats' => $this->getMonthlyAttendanceStats($student),
            'violationCard' => $this->getActiveViolationCard($student),
        ];

        return view('student.dashboard', $data);
    }

    private function getStudentBadges(Student $student)
    {
        $badges = [];

        // Logic untuk menentukan badge
        if ($student->points < 10) {
            $badges[] = ['name' => 'Siswa Teladan', 'icon' => 'images/badges/excellent.png'];
        }

        if ($student->attendance_rate > 90) {
            $badges[] = ['name' => 'Kehadiran Sempurna', 'icon' => 'images/badges/attendance.png'];
        }

        if ($student->average_score > 85) {
            $badges[] = ['name' => 'Nilai Terbaik', 'icon' => 'images/badges/top-score.png'];
        }

        // Maksimal 3 badge yang ditampilkan
        return array_slice($badges, 0, 3);
    }

    // ... method lainnya untuk mendapatkan data
}
