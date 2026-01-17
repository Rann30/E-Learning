<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;

class CourseController extends Controller
{
    public function index()
    {
        $student = Auth::user()->student;

        // Ambil kursus yang diikuti student
        $enrolledCourses = $student->enrollments()
            ->where('is_active', true)
            ->with('course.teacher')
            ->get()
            ->pluck('course');

        // Ambil semua kursus yang tersedia
        $availableCourses = Course::whereNotIn('id', $enrolledCourses->pluck('id'))
            ->with('teacher')
            ->get();

        return view('student.courses.index', compact('enrolledCourses', 'availableCourses'));
    }

    public function show($id)
    {
        $course = Course::with('teacher')->findOrFail($id);
        $student = Auth::user()->student;

        // Cek apakah student sudah enroll
        $isEnrolled = $student->enrollments()
            ->where('course_id', $id)
            ->where('is_active', true)
            ->exists();

        return view('student.courses.show', compact('course', 'isEnrolled'));
    }
}
