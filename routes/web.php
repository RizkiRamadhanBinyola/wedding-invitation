<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\ThemePreviewController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\UserInvitationController;

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

// Untuk admin lihat preview dengan data dummy
Route::get('/themes/{slug}/preview', [ThemePreviewController::class, 'previewDummy'])
    ->middleware(['auth', 'verified', 'admin'])
    ->name('themes.preview');

// Untuk user lihat preview undangan mereka
Route::get('/invitation/{slug}', [ThemePreviewController::class, 'previewUser'])
    ->name('invitation.preview');

    Route::get('/invitation/{slug}', [InvitationController::class, 'show']);

// Route untuk preview dummy tema
Route::get('/themes/preview/{slug}', function ($slug) {
    $theme = \App\Models\Theme::where('slug', $slug)->firstOrFail();

    $dummyData = [
        'nama_pria' => 'Raka',
        'nama_wanita' => 'Laras',
        'ortu_wanita' => 'Bapak A & Ibu B',
        'ortu_pria' => 'Bapak C & Ibu D',
        'anak_ke' => '1 dari 3 bersaudara',
        'tanggal' => '2025-08-17',
        'lokasi' => 'Gedung Serbaguna, Jakarta',
        'no_telp' => '08123456789',
        'email' => 'example@mail.com',
        'waktu_akad' => '10:00 WIB',
        'waktu_resepsi' => '12:00 WIB',
        'no_rekening' => '1234567890 (BCA)',
        'instagram' => '@raka_laras',
        'musik' => 'lagu.mp3',
    ];

    return view("admin.themes.{$theme->slug}.index", [
        'data' => $dummyData,
        'isDummy' => true,
    ]);
});

Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {
    Route::resource('invitations', UserInvitationController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('invitations', UserInvitationController::class);
});

// Route bawaan Laravel Breeze/Fortify untuk auth
require __DIR__.'/auth.php';
