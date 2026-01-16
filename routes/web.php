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
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/edit-profile', [DashboardController::class, 'editProfile'])->name('edit-profile');
    Route::post('/update-profile', [DashboardController::class, 'updateProfile'])->name('update-profile');
});
