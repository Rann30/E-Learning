<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Student\DashboardController as StudentDashboard;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\UserController;


/*
|--------------------------------------------------------------------------
| ROOT
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    if (!auth()->check()) {
        return redirect()->route('login');
    }

    return match (auth()->user()->role) {
        'student' => redirect()->route('student.dashboard'),
        'admin'   => redirect()->route('admin.dashboard'),
        default   => abort(403),
    };
});

/*
|--------------------------------------------------------------------------
| AUTH - GUEST ONLY
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

/*
|--------------------------------------------------------------------------
| AUTH - LOGOUT
|--------------------------------------------------------------------------
*/
Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

/*
|--------------------------------------------------------------------------
| STUDENT ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'student'])
    ->prefix('student')
    ->name('student.')
    ->group(function () {

        Route::get('/dashboard', [StudentDashboard::class, 'index'])->name('dashboard');

        Route::get('/edit-profile', [StudentDashboard::class, 'editProfile'])->name('edit-profile');
        Route::post('/update-profile', [StudentDashboard::class, 'updateProfile'])->name('update-profile');

        Route::get('/courses', [App\Http\Controllers\Student\CourseController::class, 'index'])->name('courses');
        Route::get('/courses/{id}', [App\Http\Controllers\Student\CourseController::class, 'show'])->name('courses.show');

        Route::get('/assignments', [App\Http\Controllers\Student\AssignmentController::class, 'index'])->name('assignments');
        Route::get('/assignments/{id}', [App\Http\Controllers\Student\AssignmentController::class, 'show'])->name('assignments.show');
        Route::post('/assignments/{id}/submit', [App\Http\Controllers\Student\AssignmentController::class, 'submit'])->name('assignments.submit');

        Route::get('/grades', [App\Http\Controllers\Student\GradeController::class, 'index'])->name('grades');
        Route::get('/attendance', [App\Http\Controllers\Student\AttendanceController::class, 'index'])->name('attendance');
        Route::get('/schedule', [App\Http\Controllers\Student\ScheduleController::class, 'index'])->name('schedule');
        Route::get('/prakerin', [App\Http\Controllers\Student\PrakerinController::class, 'index'])->name('prakerin');
        Route::get('/announcements', [App\Http\Controllers\Student\AnnouncementController::class, 'index'])->name('announcements');
        Route::get('/profile', [App\Http\Controllers\Student\ProfileController::class, 'index'])->name('profile');
    });

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

        Route::resource('users', App\Http\Controllers\Admin\UserController::class);

        Route::resource('courses', App\Http\Controllers\Admin\CourseController::class);
        Route::resource('schedules', App\Http\Controllers\Admin\ScheduleController::class);
        Route::resource('announcements', App\Http\Controllers\Admin\AnnouncementController::class);

        Route::get('/students', [App\Http\Controllers\Admin\StudentController::class, 'index'])->name('students.index');
        Route::get('/students/{id}', [App\Http\Controllers\Admin\StudentController::class, 'show'])->name('students.show');
        Route::get('/students/{id}/edit', [App\Http\Controllers\Admin\StudentController::class, 'edit'])->name('students.edit');
        Route::put('/students/{id}', [App\Http\Controllers\Admin\StudentController::class, 'update'])->name('students.update');
        Route::delete('/students/{id}', [App\Http\Controllers\Admin\StudentController::class, 'destroy'])->name('students.destroy');

        Route::get('/teachers', [App\Http\Controllers\Admin\TeacherController::class, 'index'])->name('teachers.index');
        Route::get('/teachers/{id}', [App\Http\Controllers\Admin\TeacherController::class, 'show'])->name('teachers.show');

        Route::get('/enrollments', [App\Http\Controllers\Admin\EnrollmentController::class, 'index'])->name('enrollments.index');
        Route::post('/enrollments', [App\Http\Controllers\Admin\EnrollmentController::class, 'store'])->name('enrollments.store');
        Route::delete('/enrollments/{id}', [App\Http\Controllers\Admin\EnrollmentController::class, 'destroy'])->name('enrollments.destroy');

        Route::get('/assignments', [App\Http\Controllers\Admin\AssignmentController::class, 'index'])->name('assignments.index');
        Route::get('/assignments/{id}', [App\Http\Controllers\Admin\AssignmentController::class, 'show'])->name('assignments.show');

        Route::get('/attendances', [App\Http\Controllers\Admin\AttendanceController::class, 'index'])->name('attendances.index');
        Route::post('/attendances', [App\Http\Controllers\Admin\AttendanceController::class, 'store'])->name('attendances.store');


        Route::get('/reports', [App\Http\Controllers\Admin\ReportController::class, 'index'])->name('reports.index');
        Route::get('/settings', [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings');
        Route::get('/logs', [App\Http\Controllers\Admin\LogController::class, 'index'])->name('logs');
    });
