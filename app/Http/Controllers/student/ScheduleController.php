<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Schedule;

class ScheduleController extends Controller
{
    public function index()
    {
        $student = Auth::user()->student;
        $courseIds = $student->enrollments()
            ->where('is_active', true)
            ->pluck('course_id');

        // Jadwal per hari
        $schedules = Schedule::whereIn('course_id', $courseIds)
            ->with('course')
            ->orderBy('day')
            ->orderBy('start_time')
            ->get()
            ->groupBy('day');

        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

        return view('student.schedule.index', compact('schedules', 'days'));
    }
}
