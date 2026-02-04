<?php

namespace App\Http\Controllers\Teacher;


use App\Http\Controllers\Controller;
use App\Models\Course;


class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::where('teacher_id', auth()->id())->get();
        return view('teacher.courses.index', compact('courses'));
    }


    public function show(Course $course)
    {
        abort_if($course->teacher_id !== auth()->id(), 403);


        $subjects = $course->subjects;
        $assignments = $course->assignments()->latest()->get();


        return view('teacher.courses.show', compact('course', 'subjects', 'assignments'));
    }
}
