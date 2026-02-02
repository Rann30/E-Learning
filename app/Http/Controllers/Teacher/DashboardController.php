<?php

namespace App\Http\Controllers\Teacher;


use App\Http\Controllers\Controller;
use App\Models\Course;


class DashboardController extends Controller
{
public function index()
{
$courses = Course::where('teacher_id', auth()->id())
->withCount('assignments')
->get();


return view('teacher.dashboard', compact('courses'));
}
}
