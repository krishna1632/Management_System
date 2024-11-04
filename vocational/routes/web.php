<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\FacultyController;
use App\Http\Controllers\Admin\StudyMaterialController;
use App\Http\Controllers\Admin\PyqController;
// use App\Http\Controllers\Admin\EventController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/faculty', [FacultyController::class, 'store'])->name('faculty.store');
    Route::put('/user/profile/{id}', [UserController::class, 'update'])->name('user.update');
});

require __DIR__ . '/auth.php';

Route::middleware(['auth', 'userMiddleware'])->prefix('user')->as('user.')->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth', 'adminMiddleware'])->prefix('admin')->as('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::resource('/faculty', FacultyController::class);
    Route::resource('/study_materials', StudyMaterialController::class);
    Route::resource('/upload_pyq', PyqController::class);

    // Route::get('/upload_pyq', [PyqController::class, 'index'])->name('upload_pyq.index');
    // Route::get('/upload_pyq/create', [PyqController::class, 'create'])->name('upload_pyq.create');
    // Route::post('/upload_pyq', [PyqController::class, 'store'])->name('upload_pyq.store');
    // Route::get('/upload_pyq/{upload_pyq}', [PyqController::class, 'show'])->name('admin.upload_pyq.show');
    Route::get('/upload_pyq/{upload_pyq}/edit', [PyqController::class, 'edit'])->name('upload_pyq.edit');
    Route::put('/upload_pyq/{upload_pyq}', [PyqController::class, 'update'])->name('upload_pyq.update');
    // Route::delete('/upload_pyq/{upload_pyq}', [PyqController::class, 'destroy'])->name('upload_pyq.destroy');
});


// Event routes for admin
// Route::middleware(['auth', 'adminMiddleware'])->group(function () {
//     Route::get('/admin/event', [EventController::class, 'index'])->name('admin.event.index');
//     Route::get('/admin/event/create', [EventController::class, 'create'])->name('admin.event.create');
//     Route::post('/admin/event', [EventController::class, 'store'])->name('event.store');
//     Route::get('/admin/event/{event}/edit', [EventController::class, 'edit'])->name('admin.event.edit');
//     Route::put('/admin/event/{event}', [EventController::class, 'update'])->name('admin.event.update');
//     Route::delete('/admin/event/{event}', [EventController::class, 'destroy'])->name('admin.event.destroy');
// });