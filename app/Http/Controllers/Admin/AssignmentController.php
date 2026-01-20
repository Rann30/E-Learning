<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Assignment;

class AssignmentController extends Controller
{
    public function index()
    {
        $assignments = Assignment::with('course')->latest()->paginate(20);
        return view('admin.assignments.index', compact('assignments'));
    }

    public function show($id)
    {
        $assignment = Assignment::with('course', 'submissions.student.user')->findOrFail($id);
        return view('admin.assignments.show', compact('assignment'));
    }
}
