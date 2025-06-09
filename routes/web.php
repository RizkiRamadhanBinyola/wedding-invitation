<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Halaman depan
Route::get('/', function () {
    return view('welcome');
});

// Dashboard tunggal berdasarkan role
Route::get('/dashboard', function () {
    $user = Auth::user();

    if ($user->role === 'admin') {
        return view('admin.dashboard');
    }

    // Default ke dashboard user
    return view('user.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Middleware auth untuk profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
