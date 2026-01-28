<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RegistrationController as AdminRegistrationController;
use App\Http\Controllers\Student\RegistrationController as StudentRegistrationController;

// Home page
Route::get('/', function () {
    return view('welcome');
});

// Auth routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminRegistrationController::class, 'dashboard'])->name('admin.dashboard');
    
    // User management
    Route::prefix('/admin/users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('admin.users.index');
        Route::get('/create', [UserController::class, 'create'])->name('admin.users.create');
        Route::post('/', [UserController::class, 'store'])->name('admin.users.store');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('admin.users.update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    });
    
    // Registration management
    Route::prefix('/admin/registrations')->group(function () {
        Route::get('/', [AdminRegistrationController::class, 'index'])->name('admin.registrations.index');
        Route::get('/{registration}', [AdminRegistrationController::class, 'show'])->name('admin.registrations.show');
        Route::get('/{registration}/edit', [AdminRegistrationController::class, 'edit'])->name('admin.registrations.edit');
        Route::put('/{registration}', [AdminRegistrationController::class, 'update'])->name('admin.registrations.update');
        Route::delete('/{registration}', [AdminRegistrationController::class, 'destroy'])->name('admin.registrations.destroy');
    });
});

// Student routes
Route::middleware(['auth', 'student'])->group(function () {
    Route::get('/student/dashboard', [StudentRegistrationController::class, 'dashboard'])->name('student.dashboard');
    
    // Registration
    Route::get('/student/registration/create', [StudentRegistrationController::class, 'create'])->name('student.registration.create');
    Route::post('/student/registration', [StudentRegistrationController::class, 'store'])->name('student.registration.store');
    Route::get('/student/registration', [StudentRegistrationController::class, 'show'])->name('student.registration.show');
    Route::get('/student/registration/edit', [StudentRegistrationController::class, 'edit'])->name('student.registration.edit');
    Route::put('/student/registration', [StudentRegistrationController::class, 'update'])->name('student.registration.update');
});

