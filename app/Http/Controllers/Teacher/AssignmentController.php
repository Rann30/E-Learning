<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Course;
use Illuminate\Http\Request;


class AssignmentController extends Controller
{
    public function create(Request $request)
    {
        $course = Course::findOrFail($request->course_id);
        abort_if($course->teacher_id !== auth()->id(), 403);


        return view('teacher.assignments.create', compact('course'));
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'description' => 'required',
            'deadline' => 'required|date',
            'max_score' => 'required|integer|min:1'
        ]);


        $data['teacher_id'] = auth()->id();


        Assignment::create($data);


        return redirect()
            ->route('teacher.courses.show', $data['course_id'])
            ->with('success', 'Tugas berhasil dibuat');
    }
}
