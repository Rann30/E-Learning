<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use Carbon\Carbon;

class AssignmentController extends Controller
{
    public function index()
    {
        $student = Auth::user()->student;
        $courseIds = $student->enrollments()
            ->where('is_active', true)
            ->pluck('course_id');

        // Tugas yang belum dikumpulkan
        $submittedAssignmentIds = $student->assignmentSubmissions()->pluck('assignment_id');
        $pendingAssignments = Assignment::whereIn('course_id', $courseIds)
            ->whereNotIn('id', $submittedAssignmentIds)
            ->where('deadline', '>', now())
            ->with('course')
            ->orderBy('deadline')
            ->get();

        // Tugas yang sudah dikumpulkan
        $submittedAssignments = $student->assignmentSubmissions()
            ->with('assignment.course')
            ->latest()
            ->get();

        return view('student.assignments.index', compact('pendingAssignments', 'submittedAssignments'));
    }

    public function show($id)
    {
        $assignment = Assignment::with('course')->findOrFail($id);
        $student = Auth::user()->student;

        // Cek apakah sudah submit
        $submission = AssignmentSubmission::where('assignment_id', $id)
            ->where('student_id', $student->id)
            ->first();

        return view('student.assignments.show', compact('assignment', 'submission'));
    }

    public function submit(Request $request, $id)
    {
        $request->validate([
            'content' => 'required',
            'file' => 'nullable|file|max:10240' // 10MB
        ]);

        $student = Auth::user()->student;
        $assignment = Assignment::findOrFail($id);

        try {
            $data = [
                'assignment_id' => $id,
                'student_id' => $student->id,
                'content' => $request->content,
                'submitted_at' => now(),
                'status' => now() > $assignment->deadline ? 'late' : 'pending'
            ];

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/assignments'), $filename);
                $data['file'] = 'uploads/assignments/' . $filename;
            }

            AssignmentSubmission::create($data);

            return redirect()->route('student.assignments')
                ->with('success', 'Tugas berhasil dikumpulkan!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengumpulkan tugas: ' . $e->getMessage());
        }
    }
}
