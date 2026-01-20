<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Course;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::with('course')->orderBy('day')->orderBy('start_time')->get();
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

        return view('admin.schedules.index', compact('schedules', 'days'));
    }

    public function create()
    {
        $courses = Course::all();
        return view('admin.schedules.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'day' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'start_time' => 'required',
            'end_time' => 'required',
            'room' => 'nullable|string',
        ]);

        Schedule::create($request->all());

        return redirect()->route('admin.schedules.index')
            ->with('success', 'Jadwal berhasil dibuat!');
    }

    public function edit(Schedule $schedule)
    {
        $courses = Course::all();
        return view('admin.schedules.edit', compact('schedule', 'courses'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'day' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'start_time' => 'required',
            'end_time' => 'required',
            'room' => 'nullable|string',
        ]);

        $schedule->update($request->all());

        return redirect()->route('admin.schedules.index')
            ->with('success', 'Jadwal berhasil diupdate!');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('admin.schedules.index')
            ->with('success', 'Jadwal berhasil dihapus!');
    }
}
