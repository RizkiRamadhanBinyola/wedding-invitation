<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\ThemePreviewController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\UnifiedInvitationController;
use App\Http\Controllers\InvitationSectionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GreetingController;

/* ========================== LANDING ========================== */
Route::get('/', fn () => view('welcome'));

/* ======================== AUTH ROUTES ======================== */
require __DIR__.'/auth.php';

/* ======================== DASHBOARD ========================== */
Route::get('/dashboard', function () {
    return Auth::user()->role === 'admin'
        ? view('admin.dashboard')
        : view('user.dashboard');
})->middleware(['auth', 'verified', 'ensure.invitation.setup'])->name('dashboard');

/* ======================== PROFILE ============================ */
Route::middleware('auth')->group(function () {
    Route::get   ('/profile',  [ProfileController::class, 'edit'])   ->name('profile.edit');
    Route::patch ('/profile',  [ProfileController::class, 'update']) ->name('profile.update');
    Route::delete('/profile',  [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/* ========================== ADMIN ============================ */
Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::resource('themes', ThemeController::class);
    Route::get('/themes/{slug}/preview', [ThemePreviewController::class, 'previewDummy'])->name('themes.preview');
    Route::resource('users', UserController::class);
});

/* ==================== SETUP UNDANGAN ========================= */
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get ('/setup-invitation', [InvitationController::class, 'showSetupForm'])   ->name('user.invitation.setup');
    Route::post('/setup-invitation', [InvitationController::class, 'submitSetupForm']) ->name('user.invitation.setup.submit');
});

/* ==================== CRUD UNDANGAN ========================== */
Route::middleware(['auth', 'verified'])
    ->resource('invitations', UnifiedInvitationController::class);

/* ================== SUB-MODULE UNDANGAN ====================== */
Route::middleware(['auth', 'verified'])
    ->prefix('invitations/{invitation}')
    ->as('invitations.')
    ->group(function () {
        Route::get('/kelola', [InvitationSectionController::class, 'dashboard'])->name('kelola');

        Route::get ('/pengantin', [InvitationSectionController::class, 'editPengantin'])->name('pengantin.edit');
        Route::put ('/pengantin', [InvitationSectionController::class, 'updatePengantin'])->name('pengantin.update');

        Route::get ('/acara', [InvitationSectionController::class, 'editAcara'])->name('acara.edit');
        Route::put ('/acara', [InvitationSectionController::class, 'updateAcara'])->name('acara.update');

        Route::get ('/tema', [InvitationSectionController::class, 'editTema'])->name('tema.edit');
        Route::put ('/tema', [InvitationSectionController::class, 'updateTema'])->name('tema.update');

        Route::get ('/musik', [InvitationSectionController::class, 'editMusik'])->name('musik.edit');
        Route::put ('/musik', [InvitationSectionController::class, 'updateMusik'])->name('musik.update');

        Route::get    ('/galeri',         [InvitationSectionController::class, 'editGaleri'])  ->name('galeri.edit');
        Route::post   ('/galeri',         [InvitationSectionController::class, 'storeGaleri']) ->name('galeri.store');
        Route::delete ('/galeri/{image}', [InvitationSectionController::class, 'destroyGaleri'])->name('galeri.destroy');
    });

/* ============== PREVIEW UNDANGAN (LOGIN) ===================== */
Route::get('/invitation/{slug}', [ThemePreviewController::class, 'previewUser'])
    ->middleware(['auth'])
    ->name('invitation.preview');

/* ============== FORM UCAPAN TAMU (PUBLIK) ==================== */
Route::post('/{slug}/greetings', [GreetingController::class, 'storePublic'])
    ->where('slug', '^(?!dashboard$|themes$|invitations$|profile$|login$|register$|logout$|password$|email$).+')
    ->name('greetings.public');

/* ============== CATCH-ALL UNDANGAN PUBLIK ==================== */
Route::get('/{slug}', [InvitationController::class, 'show'])
    ->where('slug', '^(?!dashboard$|themes$|invitations$|profile$|login$|register$|logout$|password$|email$).+')
    ->name('invitation.public');
