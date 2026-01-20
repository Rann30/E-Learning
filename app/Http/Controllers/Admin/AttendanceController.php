<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Student;
use App\Models\Course;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $query = Attendance::with('student.user', 'course');

        // Filter by date
        if ($request->filled('date')) {
            $query->whereDate('date', $request->date);
        } else {
            $query->whereDate('date', today());
        }

        // Filter by course
        if ($request->filled('course_id')) {
            $query->where('course_id', $request->course_id);
        }

        $attendances = $query->latest()->paginate(50);
        $courses = Course::all();
        $students = Student::with('user')->get();

        return view('admin.attendances.index', compact('attendances', 'courses', 'students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'date' => 'required|date',
            'status' => 'required|in:hadir,izin,sakit,alpha',
            'note' => 'nullable|string',
        ]);

        Attendance::create($request->all());

        return redirect()->route('admin.attendances.index')
            ->with('success', 'Kehadiran berhasil dicatat!');
    }
}
