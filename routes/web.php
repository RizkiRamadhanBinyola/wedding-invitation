<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/* Controllers */
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\ThemePreviewController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\UnifiedInvitationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GreetingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

/* ==========================  LANDING PAGE  ========================== */
Route::get('/', fn () => view('welcome'));

/* ===========================  DASHBOARD  ============================ */
Route::get('/dashboard', function () {
    return Auth::user()->role === 'admin'
        ? view('admin.dashboard')
        : view('user.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/* =====================  PENGATURAN PROFIL (AUTH)  =================== */
Route::middleware('auth')->group(function () {
    Route::get   ('/profile',  [ProfileController::class, 'edit' ])->name('profile.edit');
    Route::patch ('/profile',  [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile',  [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/* ===========================  ADMIN AREA  =========================== */
Route::middleware(['auth', 'verified', 'admin'])->group(function () {

    /* --- Tema --- */
    Route::resource('themes', ThemeController::class);
    Route::get('/themes/{slug}/preview', [ThemePreviewController::class, 'previewDummy'])
         ->name('themes.preview');

    /* --- User --- */
    Route::resource('users', UserController::class);
});

/* ============  CRUD INVITATION (Admin & User Bersama)  ============= */
Route::middleware(['auth', 'verified'])
      ->resource('invitations', UnifiedInvitationController::class);

/* =================  FORM UCAPAN PUBLIK di Halaman Undangan ========= */
Route::post('/{slug}/greetings', [GreetingController::class, 'storePublic'])
     ->where('slug', '^(?!dashboard$|themes$|invitations$|profile$|login$|register$|logout$|password$|email$).+')
     ->name('greetings.public');

/* ================  PREVIEW UNDANGAN MILIK USER (LOGIN)  ============ */
Route::get('/invitation/{slug}', [ThemePreviewController::class, 'previewUser'])
     ->middleware(['auth'])
     ->name('invitation.preview');

/* ================  PREVIEW TEMA DUMMY (NO LOGIN)  ================== */
Route::get('/themes/preview/{slug}', function ($slug) {
    $theme = \App\Models\Theme::where('slug', $slug)->firstOrFail();

    $dummyData = [
        'nama_pria' => 'Raka',
        'nama_wanita' => 'Laras',
        'tanggal' => '2025-08-17',
        'lokasi' => 'Gedung Serbaguna, Jakarta',
        'ucapan' => '',
    ];

    return view("admin.themes.{$theme->slug}.index", [
        'invitation' => (object) $dummyData,
        'isDummy'    => true,
    ]);
})->name('themes.previewDummy');

/* =======================  AUTH ROUTES (BREEZE)  ===================== */
require __DIR__.'/auth.php';

/* =================================================================== */
/* -----------  ROUTE PUBLIK UNDANGAN (CATCH‑ALL)  /{slug}  ----------- */
/* --------*** LETAKKAN PALING BAWAH – PENTING ***--------------------- */
/* =================================================================== */
Route::get('/{slug}', [InvitationController::class, 'show'])
     ->where('slug', '^(?!dashboard$|themes$|invitations$|profile$|login$|register$|logout$|password$|email$).+')
     ->name('invitation.public');
