<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Course;
use App\Models\ActivityLog;

class EnrollmentController extends Controller
{
    public function index()
    {
        $enrollments = Enrollment::with('student.user', 'course')
            ->latest()
            ->paginate(20);

        $students = Student::with('user')->get();
        $courses = Course::all();

        return view('admin.enrollments.index', compact('enrollments', 'students', 'courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
        ]);

        // Check if already enrolled
        $exists = Enrollment::where('student_id', $request->student_id)
            ->where('course_id', $request->course_id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Siswa sudah terdaftar di kursus ini!');
        }

        $enrollment = Enrollment::create([
            'student_id' => $request->student_id,
            'course_id' => $request->course_id,
            'is_active' => true,
        ]);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'create',
            'model' => 'Enrollment',
            'model_id' => $enrollment->id,
            'description' => 'Enrolled student to course',
            'ip_address' => request()->ip(),
        ]);

        return redirect()->route('admin.enrollments.index')
            ->with('success', 'Siswa berhasil didaftarkan ke kursus!');
    }

    public function destroy($id)
    {
        $enrollment = Enrollment::findOrFail($id);
        $enrollment->delete();

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'delete',
            'model' => 'Enrollment',
            'model_id' => $id,
            'description' => 'Removed enrollment',
            'ip_address' => request()->ip(),
        ]);

        return redirect()->route('admin.enrollments.index')
            ->with('success', 'Enrollment berhasil dihapus!');
    }
}
