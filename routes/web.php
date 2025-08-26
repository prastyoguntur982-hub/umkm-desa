<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\UmkmController;

use App\Http\Controllers\public\HomeController;

use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SosmedController;
use App\Http\Controllers\Auth\PasswordController;

use App\Http\Controllers\Admin\DashboardController;

use App\Http\Controllers\Auth\AuthenticatedSessionController;


// Route publik
Route::get('/', [HomeController::class, 'index'])->name('landing.home');


// Route untuk login dan logout admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AuthenticatedSessionController::class, 'create'])
        ->middleware('guest')
        ->name('login');

    Route::post('/login', [AuthenticatedSessionController::class, 'store'])
        ->middleware('guest');

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->middleware('auth')
        ->name('logout');
});

// Route admin yang hanya bisa diakses jika sudah login
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/change-password', [PasswordController::class, 'edit'])->name('password.edit');
    Route::put('/change-password', [PasswordController::class, 'update'])->name('password.update');
    // Dashboard admin
    Route::resource('dashboard', DashboardController::class)->except(['show']);

    // Resource lain di admin
    Route::resource('umkms', UmkmController::class)->except(['show']);


    Route::resource('slider', SliderController::class)->except(['show']);
    Route::resource('sosmed', SosmedController::class)->except(['show']);
    // Route::resource('profil-desa', ProfilDesaController::class)->except(['show']);



});

require __DIR__ . '/auth.php';
