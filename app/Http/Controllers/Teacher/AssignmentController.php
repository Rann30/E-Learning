<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Course;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    /**
     * Form tambah tugas
     */
    public function create(Course $course)
    {
        // Pastikan course milik teacher yang login
        if ($course->teacher_id !== auth()->id()) {
            abort(403, 'Anda tidak punya akses ke course ini');
        }

        return view('teacher.assignments.create', compact('course'));
    }

    /**
     * Simpan tugas
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'course_id'   => 'required|exists:courses,id',
            'title'       => 'required|string|max:255',
            'description' => 'required',
            'deadline'    => 'required|date',
            'max_score'   => 'required|integer|min:1',
        ]);

        $course = Course::findOrFail($data['course_id']);

        // Security check (PENTING)
        if ($course->teacher_id !== auth()->id()) {
            abort(403, 'Anda tidak berhak menambahkan tugas ke course ini');
        }

        Assignment::create([
            'course_id'   => $course->id,
            'teacher_id'  => auth()->id(),
            'title'       => $data['title'],
            'description' => $data['description'],
            'deadline'    => $data['deadline'],
            'max_score'   => $data['max_score'],
        ]);

        return redirect()
            ->route('teacher.courses.show', $course->id)
            ->with('success', 'Tugas berhasil dibuat');
    }
}
