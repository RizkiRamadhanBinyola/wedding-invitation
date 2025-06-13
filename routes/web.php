<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\ThemePreviewController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\UserInvitationController;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

/* ==========================  LANDING PAGE  ========================== */
Route::get('/', fn () => view('welcome'));

/* ===========================  DASHBOARD  ============================ */
Route::get('/dashboard', function () {
    $user = Auth::user();

    return $user->role === 'admin'
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

    // CRUD Tema
    Route::resource('themes', ThemeController::class);

    // Preview tema (dummy)
    Route::get('/themes/{slug}/preview', [ThemePreviewController::class, 'previewDummy'])
         ->name('themes.preview');
});

Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::resource('users', UserController::class);
});

/* ========================  USER CRUD INVITATION  ==================== */
/* URL internal: /invitations  — nama‑rute: invitations.* */
Route::middleware(['auth'])->group(function () {
    Route::resource('invitations', UserInvitationController::class);
});

/* ================  ROUTE PREVIEW UNDANGAN MILIK USER  =============== */
/* Login diperlukan, dipakai user sebelum publish */
Route::get('/invitation/{slug}', [ThemePreviewController::class, 'previewUser'])
     ->middleware(['auth'])
     ->name('invitation.preview');

/* ================  DUMMY PREVIEW TEMA (NO LOGIN)  =================== */
Route::get('/themes/preview/{slug}', function ($slug) {
    $theme = \App\Models\Theme::where('slug', $slug)->firstOrFail();

    $dummyData = [
        'nama_pria'       => 'Raka',
        'nama_wanita'     => 'Laras',
        'ortu_wanita'     => 'Bapak A & Ibu B',
        'ortu_pria'       => 'Bapak C & Ibu D',
        'anak_ke'         => '1 dari 3 bersaudara',
        'tanggal'         => '2025-08-17',
        'lokasi'          => 'Gedung Serbaguna, Jakarta',
        'no_telp'         => '08123456789',
        'email'           => 'example@mail.com',
        'waktu_akad'      => '10:00 WIB',
        'waktu_resepsi'   => '12:00 WIB',
        'no_rekening'     => '1234567890 (BCA)',
        'instagram'       => '@raka_laras',
        'musik'           => 'lagu.mp3',
    ];

    return view("admin.themes.{$theme->slug}.index", [
        'data'    => $dummyData,
        'isDummy' => true,
    ]);
})->name('themes.previewDummy');

/* =======================  AUTH ROUTES (BREEZE)  ===================== */
require __DIR__.'/auth.php';

/* ==================================================================== */
/* ----------------  ROUTE PUBLIK UNDANGAN  /{slug}  ------------------ */
/* ------------  *** LETAKKAN PALING BAWAH – PENTING ***  ------------ */
/* ==================================================================== */

Route::get('/{slug}', [InvitationController::class, 'show'])
    ->where('slug', '^(?!dashboard$|themes$|invitations$|profile$|login$|register$|logout$|password$|email$).+')
    ->name('invitation.public');
