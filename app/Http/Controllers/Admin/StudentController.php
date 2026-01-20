<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::with('user');

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            })->orWhere('nis', 'like', '%' . $search . '%')
                ->orWhere('class', 'like', '%' . $search . '%');
        }

        // Filter by class
        if ($request->filled('class')) {
            $query->where('class', $request->class);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $students = $query->latest()->paginate(15);
        $classes = Student::distinct()->pluck('class');

        return view('admin.students.index', compact('students', 'classes'));
    }

    public function show($id)
    {
        $student = Student::with(['user', 'enrollments.course', 'violationCards', 'attendances'])
            ->findOrFail($id);

        // Statistics
        $totalCourses = $student->enrollments()->where('is_active', true)->count();
        $totalSubmissions = $student->assignmentSubmissions()->count();
        $averageScore = $student->assignmentSubmissions()->whereNotNull('score')->avg('score') ?? 0;
        $attendanceRate = $this->calculateAttendanceRate($student);

        return view('admin.students.show', compact('student', 'totalCourses', 'totalSubmissions', 'averageScore', 'attendanceRate'));
    }

    public function edit($id)
    {
        $student = Student::with('user')->findOrFail($id);
        return view('admin.students.edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $student->user_id,
            'nis' => 'required|string|unique:students,nis,' . $id,
            'class' => 'required|string',
            'status' => 'required|in:Belum Lulus,Lulus',
            'points' => 'required|integer|min:0',
            'badges' => 'required|integer|min:0',
        ]);

        try {
            DB::beginTransaction();

            // Update User
            $student->user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            // Update Student
            $student->update([
                'nis' => $request->nis,
                'class' => $request->class,
                'status' => $request->status,
                'points' => $request->points,
                'badges' => $request->badges,
            ]);

            // Log activity
            ActivityLog::create([
                'user_id' => auth()->id(),
                'action' => 'update',
                'model' => 'Student',
                'model_id' => $student->id,
                'description' => 'Updated student: ' . $student->user->name,
                'ip_address' => request()->ip(),
            ]);

            DB::commit();

            return redirect()->route('admin.students.index')
                ->with('success', 'Data siswa berhasil diupdate!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->with('error', 'Gagal update data: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $student = Student::findOrFail($id);
            $studentName = $student->user->name;

            // Delete user (akan cascade delete student)
            $student->user->delete();

            // Log activity
            ActivityLog::create([
                'user_id' => auth()->id(),
                'action' => 'delete',
                'model' => 'Student',
                'model_id' => $id,
                'description' => 'Deleted student: ' . $studentName,
                'ip_address' => request()->ip(),
            ]);

            return redirect()->route('Admin.students.index')
                ->with('success', 'Siswa berhasil dihapus!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal hapus siswa: ' . $e->getMessage());
        }
    }

    private function calculateAttendanceRate($student)
    {
        $total = $student->attendances()->count();
        if ($total === 0) return 0;

        $present = $student->attendances()->where('status', 'hadir')->count();
        return round(($present / $total) * 100, 1);
    }
}
