<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Halaman yang wajib Login
Route::middleware(['auth', 'verified'])->group(function () {

    // Rute Dashboard & Video untuk Customer
    Route::get('/dashboard', [VideoController::class, 'index'])->name('dashboard');
    Route::post('/request-access/{id}', [VideoController::class, 'requestAccess'])->name('request.access');
    Route::get('/watch/{id}', [VideoController::class, 'watch'])->name('video.watch');

    // Rute Khusus Admin (Upload & Approve)
    Route::get('/admin/upload', [AdminController::class, 'index'])->name('admin.upload');
    Route::post('/admin/upload', [AdminController::class, 'store'])->name('admin.video.store');
    Route::post('/admin/approve/{id}', [AdminController::class, 'approve'])->name('admin.approve');
    // Rute Khusus Admin (Upload & Approve)
    Route::get('/admin/video', [AdminController::class, 'video'])->name('admin.video');
    Route::get('/admin/video/edit/{id}', [AdminController::class, 'editVideo'])->name('admin.video.edit');
    Route::post('/admin/video/update/{id}', [AdminController::class, 'updateVideo'])->name('admin.video.update');
    Route::delete('/admin/video/delete/{id}', [AdminController::class, 'deleteVideo'])->name('admin.video.delete');

    // Rute CRUD Users untuk Admin
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::patch('/admin/users/{id}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');

    // Rute Profile bawaan
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
