<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ThemeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman utama (landing page)
Route::get('/', function () {
    return view('welcome');
});

// Dashboard berdasarkan role user
Route::get('/dashboard', function () {
    $user = Auth::user();

    return match ($user->role) {
        'admin' => view('admin.dashboard'),
        default => view('user.dashboard'),
    };
})->middleware(['auth', 'verified'])->name('dashboard');

// Grup middleware auth untuk pengaturan profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route Middleware Theme
Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::resource('themes', ThemeController::class);
});

// Route bawaan Laravel Breeze/Fortify untuk auth
require __DIR__.'/auth.php';
