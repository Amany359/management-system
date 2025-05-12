<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Panel\TeamLeader\TaskController;
use App\Http\Controllers\Panel\TeamLeader\DashboardController;
use App\Http\Controllers\Panel\Programmer\TaskProgrammerController;
use App\Http\Controllers\Panel\Programmer\DashboardProgrammerController;
use App\Http\Controllers\Panel\QaManager\TaskQaManagerController;
use App\Http\Controllers\Panel\QaManager\DashboardQaManagerController;
use App\Http\Controllers\Panel\AdminManager\TaskAdminManagerController;
use App\Http\Controllers\Panel\AdminManager\DashboardAdminManagerController;
use App\Http\Controllers\Panel\ActivityLog\TaskActivityLogController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|-------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('team-leader')->middleware(['auth', 'role:team_leader'])->name('team_leader.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('tasks', TaskController::class);
    Route::post('tasks/{task}/assign-tester', [TaskController::class, 'assignTester'])->name('tasks.assignTester');
});





Route::prefix('programmer')->middleware(['auth', 'role:programmer,tester'])->name('programmer.')->group(function () {
    Route::get('/dashboard', [DashboardProgrammerController::class, 'index'])->name('dashboard');
    Route::get('tasks', [TaskProgrammerController::class, 'index'])->name('tasks.index');
    Route::put('tasks/{id}/update-status', [TaskProgrammerController::class, 'updateStatus'])->name('tasks.updateStatus');

});




Route::prefix('qa-manager')->middleware(['auth', 'role:qa_manager'])->name('qa_manager.')->group(function () {
    Route::get('/dashboard', [DashboardQaManagerController::class, 'dashboard'])->name('dashboard');
    Route::get('/tasks', [TaskQAManagerController::class, 'index'])->name('tasks.index');
    Route::post('/tasks/{task}/approve', [TaskQAManagerController::class, 'approveTask'])->name('tasks.approve');
    Route::post('/tasks/{task}/reschedule', [TaskQAManagerController::class, 'rescheduleTask'])->name('tasks.reschedule');
});


Route::prefix('admin-manager')->middleware(['auth', 'role:admin_manager'])->name('admin_manager.')->group(function () {
    Route::get('/dashboard', [DashboardAdminManagerController::class, 'index'])->name('dashboard');
    Route::get('/tasks', [TaskAdminManagerController::class, 'index'])->name('tasks.index');
    Route::get('/performance', [TaskAdminManagerController::class, 'performance'])->name('tasks.performance');
    Route::post('/tasks/{task}/priority', [TaskAdminManagerController::class, 'updatePriority'])->name('tasks.update_priority');
    Route::get('/weekly-report', [TaskAdminManagerController::class, 'weeklyReport'])->name('tasks.weekly_report');
   Route::get('/task-activity-logs', [TaskActivityLogController::class, 'index'])->name('logs.index');
Route::put('/tasks/{task}/update-status', [TaskActivityLogController::class, 'updateStatus'])->name('logs.updateStatus');
});