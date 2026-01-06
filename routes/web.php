<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\StaffTaskController;
use App\Http\Controllers\AdminStaffController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\SuperAdminProjectController;
use App\Http\Controllers\SuperAdmin\ProjectController as SAProjectController;
use App\Http\Controllers\SuperAdminStaffController;
use App\Http\Controllers\SuperAdmin\SuperAdminTaskController;




use App\Http\Controllers\Admin\AdminTaskController;
/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication


Route::get('login', [LoginController::class, 'create'])->name('login');
Route::post('login', [LoginController::class, 'authenticate'])->name('login');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');


Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('register', [RegisteredUserController::class, 'store']);

Route::post('/logout', [App\Http\Controllers\LogoutController::class, 'logout'])
    ->name('logout');

/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // User Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Super Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:super_admin'])->prefix('superadmin')->group(function () {

    // Dashboard
    Route::get('/dashboard', [SuperAdminController::class, 'dashboard'])
        ->name('superadmin.dashboard');

    // Admins Management
    Route::get('/admins', [SuperAdminController::class, 'indexAdmins'])
        ->name('superadmin.admins.index');

    Route::post('/admins/create', [SuperAdminController::class, 'createAdmin'])
        ->name('superadmin.admins.create');

    Route::post('/admins/convert/{id}', [SuperAdminController::class, 'convertStaffToAdmin'])
        ->name('superadmin.admins.convert');

    // Projects Management
    Route::get('/projects', [SuperAdminProjectController::class, 'index'])
        ->name('superadmin.projects.index');

    Route::post('/projects', [SuperAdminProjectController::class, 'store'])
        ->name('superadmin.projects.store');

    Route::get('/projects/{project}/edit', [SuperAdminProjectController::class, 'edit'])
        ->name('superadmin.projects.edit');

    Route::put('/projects/{project}', [SuperAdminProjectController::class, 'update'])
        ->name('superadmin.projects.update');

    Route::get('/projects/{project}', [SuperAdminProjectController::class, 'show'])
        ->name('superadmin.projects.show');

    Route::delete('/projects/{project}', [SuperAdminProjectController::class, 'destroy'])
        ->name('superadmin.projects.delete');

    Route::get('/projects/{project}/report', [SuperAdminProjectController::class, 'report'])
        ->name('superadmin.projects.report');

// Task management
       Route::get('/superadmin/tasks', [SuperAdminController::class, 'tasks'])
        ->name('superadmin.task.index'); 

// View task details
Route::get('/superadmin/tasks/{id}', [SuperAdminController::class, 'stafftaskview'])
    ->name('superadmin.task.viewtask');

// Track task progress
Route::get('/superadmin/tasks/{id}/track', [SuperAdminController::class, 'trackstafftask'])
    ->name('superadmin.task.tracktask');

        Route::get('/superadmin/tasks/validated', [SuperAdminController::class, 'validatedTasks'])->name('superadmin.task.validatedtasks');

Route::get('/superadmin/tasks/complete', [SuperAdminController::class, 'completeTasks'])
    ->name('superadmin.task.completedtask');

Route::get('/superadmin/tasks/pending', [SuperAdminController::class, 'pendingTasks'])
    ->name('superadmin.task.pendingtask');

Route::get('/superadmin/tasks/submitted', [SuperAdminController::class, 'submittedTasks'])
    ->name('superadmin.task.submittedtask');










    
Route::get('/superadmin/projects', [SuperAdminController::class, 'totalProjects'])
    ->name('superadmin.projects.projectpage');

    Route::get('/superadmin/staff', [SuperAdminController::class, 'totalStaff'])
    ->name('superadmin.staff.staffpage');

Route::get('/superadmin/admins', [SuperAdminController::class, 'totalAdmins'])
    ->name('superadmin.admins.adminpage');


    //superadmin see admin project
    Route::get('/superadmin/admins/{admin}/projects', [SuperAdminController::class, 'viewAdminProjects'])
    ->name('superadmin.admins.projects');


    Route::get('/staff', [SuperAdminController::class, 'totalStaff'])->name('staff.staffpage');
   Route::get('/superadmin/staff/{id}', [SuperAdminStaffController::class, 'view'])->name('superadmin.staff.view');
Route::get('/superadmin/task/{id}', [SuperAdminTaskController::class, 'show'])->name('superadmin.task.show');



    Route::get('/projects/{project}/tasks/create', [SuperAdminTaskController::class, 'create'])
        ->name('superadmin.tasks.create');


//Route::get('tasks/create/{project}', [SuperAdminTaskController::class, 'create'])->name('tasks.create');
    


Route::post('/projects/{project}/tasks/store', [SuperAdminTaskController::class, 'store'])
    ->name('superadmin.tasks.store');

});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'isAdmin'])->group(function () {

    // Admin Dashboard
    Route::get('admin/dashboard', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');





    // admin create task
    Route::post('/admin/tasks', [AdminTaskController::class, 'store'])
    ->name('admin.tasks.store');

     // admin approve task
    Route::post('/admin/tasks/{task}/approve', [AdminTaskController::class, 'approve'])
    ->name('admin.tasks.approve');

Route::post('/admin/tasks/{task}/reject', [AdminTaskController::class, 'reject'])
    ->name('admin.tasks.reject');












    Route::post('/admin/tasks', [AdminTaskController::class, 'store'])->name('admin.tasks.store');

    
});

/*
|--------------------------------------------------------------------------
| Staff Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'isStaff'])->group(function () {

    // Staff Dashboard (with tasks)
    Route::get('/staff/dashboard', [StaffTaskController::class, 'dashboard'])
        ->name('staff.dashboard');

    // All assigned tasks
    Route::get('/staff/tasks', [StaffTaskController::class, 'index'])
        ->name('staff.tasks.index');

    // View single task
    Route::get('/staff/tasks/{task}', [StaffTaskController::class, 'viewTask'])
        ->name('staff.tasks.show');

    // Submit progress / screenshot / mark done
    Route::post('/staff/tasks/{task}/update', [StaffTaskController::class, 'updateTask'])
        ->name('staff.tasks.update');
});
