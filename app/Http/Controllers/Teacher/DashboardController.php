<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Assignment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $teacherId = auth()->id();

        $courses = Course::where('teacher_id', $teacherId)->get();
        $courseCount = $courses->count();

        $assignmentCount = Assignment::whereHas('course', function ($q) use ($teacherId) {
            $q->where('teacher_id', $teacherId);
        })->count();

        return view('teacher.dashboard', compact(
            'courses',
            'courseCount',
            'assignmentCount'
        ));
    }
}
