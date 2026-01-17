<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PrakerinController extends Controller
{
    public function index()
    {
        $student = Auth::user()->student;
        return view('student.prakerin.index', compact('student'));
    }
}
