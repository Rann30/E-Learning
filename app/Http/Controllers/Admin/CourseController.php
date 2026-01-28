<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User;
use App\Models\ActivityLog;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('teacher')->latest()->paginate(15);
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        $teachers = User::where('role', 'teacher')->get();
        return view('admin.courses.create', compact('teachers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:courses,code',
            'description' => 'nullable|string',
            'teacher_id' => 'required|exists:users,id',
        ]);

        $course = Course::create($request->all());

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'create',
            'model' => 'Course',
            'model_id' => $course->id,
            'description' => 'Created course: ' . $course->name,
            'ip_address' => request()->ip(),
        ]);

        return redirect()->route('admin.courses.index')
            ->with('success', 'Mata pelajaran berhasil dibuat!');
    }

    public function show(Course $course)
    {
        $course->load('teacher', 'enrollments.student.user');
        return view('admin.courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        $teachers = User::where('role', 'teacher')->get();
        return view('admin.courses.edit', compact('course', 'teachers'));
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:courses,code,' . $course->id,
            'description' => 'nullable|string',
            'teacher_id' => 'required|exists:users,id',
        ]);

        $course->update($request->all());

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'update',
            'model' => 'Course',
            'model_id' => $course->id,
            'description' => 'Updated course: ' . $course->name,
            'ip_address' => request()->ip(),
        ]);

        return redirect()->route('admin.courses.index')
            ->with('success', 'Mata pelajaran berhasil diupdate!');
    }

    public function destroy(Course $course)
    {
        $courseName = $course->name;
        $course->delete();

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'delete',
            'model' => 'Course',
            'model_id' => $course->id,
            'description' => 'Deleted course: ' . $courseName,
            'ip_address' => request()->ip(),
        ]);

        return redirect()->route('admin.courses.index')
            ->with('success', 'Mata Pelajaran berhasil dihapus!');
    }
}
