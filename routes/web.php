<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// Redirect root ke login
Route::get('/', function () {
    if (auth()->check()) {
        $user = auth()->user();
        if ($user->role === 'student') {
            return redirect()->route('student.dashboard');
        }
    }
    return redirect()->route('login');
});

// Auth Routes (untuk guest/belum login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

// Logout (harus login)
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');



// Student Routes (harus login)
Route::middleware(['auth'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Student\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/edit-profile', [App\Http\Controllers\Student\DashboardController::class, 'editProfile'])->name('edit-profile');
    Route::post('/update-profile', [App\Http\Controllers\Student\DashboardController::class, 'updateProfile'])->name('update-profile');

    // Courses
    Route::get('/courses', [App\Http\Controllers\Student\CourseController::class, 'index'])->name('courses');
    Route::get('/courses/{id}', [App\Http\Controllers\Student\CourseController::class, 'show'])->name('courses.show');

    // Assignments
    Route::get('/assignments', [App\Http\Controllers\Student\AssignmentController::class, 'index'])->name('assignments');
    Route::get('/assignments/{id}', [App\Http\Controllers\Student\AssignmentController::class, 'show'])->name('assignments.show');
    Route::post('/assignments/{id}/submit', [App\Http\Controllers\Student\AssignmentController::class, 'submit'])->name('assignments.submit');

    // Grades
    Route::get('/grades', [App\Http\Controllers\Student\GradeController::class, 'index'])->name('grades');

    // Attendance
    Route::get('/attendance', [App\Http\Controllers\Student\AttendanceController::class, 'index'])->name('attendance');

    // Schedule
    Route::get('/schedule', [App\Http\Controllers\Student\ScheduleController::class, 'index'])->name('schedule');

    // Prakerin
    Route::get('/prakerin', [App\Http\Controllers\Student\PrakerinController::class, 'index'])->name('prakerin');

    // Announcements
    Route::get('/announcements', [App\Http\Controllers\Student\AnnouncementController::class, 'index'])->name('announcements');

    // Profile
    Route::get('/profile', [App\Http\Controllers\Student\ProfileController::class, 'index'])->name('profile');
});
