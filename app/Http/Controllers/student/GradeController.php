<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GradeController extends Controller
{
    public function index()
    {
        $student = Auth::user()->student;

        $submissions = $student->assignmentSubmissions()
            ->with('assignment.course')
            ->whereNotNull('score')
            ->orderBy('created_at', 'desc')
            ->get();

        // Hitung rata-rata per course
        $gradesByCourse = $submissions->groupBy('assignment.course_id')
            ->map(function ($items) {
                return [
                    'course' => $items->first()->assignment->course,
                    'average' => round($items->avg('score'), 2),
                    'count' => $items->count()
                ];
            });

        return view('student.grades.index', compact('submissions', 'gradesByCourse'));
    }
}
