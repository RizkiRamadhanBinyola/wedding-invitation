<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/* ───── Controllers ───── */
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\ThemePreviewController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\UnifiedInvitationController;
use App\Http\Controllers\InvitationSectionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GreetingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

/* ========================== LANDING PAGE ========================== */
Route::get('/', fn () => view('welcome'));

/* =========================== DASHBOARD ============================ */
Route::get('/dashboard', function () {
    return Auth::user()->role === 'admin'
        ? view('admin.dashboard')
        : view('user.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/* ================ PENGATURAN PROFIL (AUTH) ======================= */
Route::middleware('auth')->group(function () {
    Route::get   ('/profile',  [ProfileController::class,'edit'  ])->name('profile.edit');
    Route::patch ('/profile',  [ProfileController::class,'update'])->name('profile.update');
    Route::delete('/profile',  [ProfileController::class,'destroy'])->name('profile.destroy');
});

/* ========================== ADMIN AREA =========================== */
Route::middleware(['auth', 'verified', 'admin'])->group(function () {

    /* ---- Tema ---- */
    Route::resource('themes', ThemeController::class);
    Route::get('/themes/{slug}/preview',
        [ThemePreviewController::class,'previewDummy']
    )->name('themes.preview');

    /* ---- User ---- */
    Route::resource('users', UserController::class);
});

/* =============== CRUD UNDANGAN (Admin + User) ==================== */
Route::middleware(['auth', 'verified'])
      ->resource('invitations', UnifiedInvitationController::class);

/* ===== SUB-MODULE /invitations/{id}/(pengantin|acara|…) ========== */
Route::middleware(['auth','verified'])
      ->prefix('invitations/{invitation}')
      ->as('invitations.')
      ->group(function () {

    /* ─── DASHBOARD KELOLA ─── */
    Route::get('/kelola',
        [InvitationSectionController::class,'dashboard']
    )->name('kelola');

    /* ---- PENGANTIN ---- */
    Route::get ('/pengantin', [InvitationSectionController::class,'editPengantin'])
         ->name('pengantin.edit');
    Route::put ('/pengantin', [InvitationSectionController::class,'updatePengantin'])
         ->name('pengantin.update');

    /* ---- ACARA ---- */
    Route::get ('/acara',     [InvitationSectionController::class,'editAcara'])
         ->name('acara.edit');
    Route::put ('/acara',     [InvitationSectionController::class,'updateAcara'])
         ->name('acara.update');

    /* ---- TEMA ---- */
    Route::get ('/tema',      [InvitationSectionController::class,'editTema'])
         ->name('tema.edit');
    Route::put ('/tema',      [InvitationSectionController::class,'updateTema'])
         ->name('tema.update');

    /* ---- MUSIK ---- */
    Route::get ('/musik',     [InvitationSectionController::class,'editMusik'])
         ->name('musik.edit');
    Route::put ('/musik',     [InvitationSectionController::class,'updateMusik'])
         ->name('musik.update');

    /* ---- GALERI ---- */
    Route::get    ('/galeri',          [InvitationSectionController::class,'editGaleri'])
         ->name('galeri.edit');
    Route::post   ('/galeri',          [InvitationSectionController::class,'storeGaleri'])
         ->name('galeri.store');
    Route::delete ('/galeri/{image}',  [InvitationSectionController::class,'destroyGaleri'])
         ->name('galeri.destroy');
});

/* ==================== FORM UCAPAN (PUBLIK) ======================== */
Route::post('/{slug}/greetings',
    [GreetingController::class,'storePublic']
)->where('slug',
    '^(?!dashboard$|themes$|invitations$|profile$|login$|register$|logout$|password$|email$).+'
)->name('greetings.public');

/* =========== PREVIEW UNDANGAN USER (LOGIN) ========== */
Route::get('/invitation/{slug}',
    [ThemePreviewController::class,'previewUser']
)->middleware(['auth'])->name('invitation.preview');

/* =========== PREVIEW TEMA DUMMY (NO LOGIN) ========== */
Route::get('/themes/preview/{slug}', function ($slug) {
    $theme = \App\Models\Theme::where('slug', $slug)->firstOrFail();

    $dummy = [
        'nama_pria'   => 'Raka',
        'nama_wanita' => 'Laras',
        'tanggal'     => '2025-08-17',
        'lokasi'      => 'Gedung Serbaguna, Jakarta',
    ];

    return view("admin.themes.{$theme->slug}.index", [
        'invitation' => (object) $dummy,
        'isDummy'    => true,
        'slug'       => $theme->slug,   // ← ditambahkan agar $slug tersedia di view
    ]);
})->name('themes.previewDummy');

/* ==================== AUTH ROUTES (BREEZE) ======================= */
require __DIR__.'/auth.php';

/* =========== CATCH-ALL SLUG UNDANGAN PUBLIK =========== */
Route::get('/{slug}', [InvitationController::class,'show'])
     ->where('slug',
        '^(?!dashboard$|themes$|invitations$|profile$|login$|register$|logout$|password$|email$).+'
     )->name('invitation.public');
