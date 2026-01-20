<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = User::where('role', 'teacher')
            ->with('courses')
            ->latest()
            ->paginate(15);

        return view('Admin.teachers.index', compact('teachers'));
    }
    public function show($id)
    {
        $teacher = User::where('role', 'teacher')
            ->with('courses')
            ->findOrFail($id);

        return view('Admin.teachers.show', compact('teacher'));
    }
}
