<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VideoController;
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

    // Rute Profile bawaan
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';