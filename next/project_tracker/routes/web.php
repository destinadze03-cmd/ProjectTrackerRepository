<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\TaskController;
// Load Breeze routes FIRST so they do NOT override your custom login
require __DIR__.'/auth.php';

// Public home
Route::get('/', function () {
    return view('welcome');
});

// DASHBOARD
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile (Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// CUSTOM LOGIN (now these take priority)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Role-based dashboards
Route::middleware(['auth', 'admin'])->get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

Route::middleware(['auth', 'staff'])->get('/staff/dashboard', function () {
    return view('staff.dashboard');
})->name('staff.dashboard');


Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
    ->name('admin.dashboard')
    ->middleware('auth');
use App\Http\Controllers\ProjectController;

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {

    // Project CRUD
    Route::get('/projects', [ProjectController::class, 'index'])->name('admin.projects.index');
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('admin.projects.create');
    Route::post('/projects', [ProjectController::class, 'store'])->name('admin.projects.store');
    Route::get('/projects/{id}', [ProjectController::class, 'show'])->name('admin.projects.show');
    Route::get('/projects/{id}/edit', [ProjectController::class, 'edit'])->name('admin.projects.edit');
    Route::put('/projects/{id}', [ProjectController::class, 'update'])->name('admin.projects.update');
    Route::delete('/projects/{id}', [ProjectController::class, 'destroy'])->name('admin.projects.destroy');

});


Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {

    Route::get('/projects', [ProjectController::class, 'index'])->name('admin.projects.index');
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('admin.projects.create');
    Route::post('/projects', [ProjectController::class, 'store'])->name('admin.projects.store');
    Route::get('/projects/{id}', [ProjectController::class, 'show'])->name('admin.projects.show');
    Route::get('/projects/{id}/edit', [ProjectController::class, 'edit'])->name('admin.projects.edit');
    Route::put('/projects/{id}', [ProjectController::class, 'update'])->name('admin.projects.update');
    Route::delete('/projects/{id}', [ProjectController::class, 'destroy'])->name('admin.projects.destroy');
// Create task under a specific project
    Route::get('/projects/{project}/tasks/create', [TaskController::class, 'create'])
        ->name('admin.tasks.create');

    // Store task
    Route::post('/projects/{project}/tasks', [TaskController::class, 'store'])
        ->name('admin.tasks.store');

         Route::get('/projects/{project}/tasks/create', [TaskController::class, 'create'])
        ->name('admin.tasks.create');

    Route::post('/projects/{project}/tasks', [TaskController::class, 'store'])
        ->name('admin.tasks.store');


        Route::get('/admin/projects/{projectId}/tasks/create', [TaskController::class, 'create'])
    ->name('admin.tasks.create');

Route::post('/admin/projects/{projectId}/tasks/store', [TaskController::class, 'store'])
    ->name('admin.tasks.store');

});

