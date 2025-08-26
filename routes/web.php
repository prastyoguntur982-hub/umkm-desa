<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AlurController;
use App\Http\Controllers\Admin\PpidController;
use App\Http\Controllers\Admin\UmkmController;
use App\Http\Controllers\admin\BalaiController;
use App\Http\Controllers\Admin\PasarController;
use App\Http\Controllers\public\HomeController;
use App\Http\Controllers\Admin\AgendaController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SosmedController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Admin\FormulirController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InfoHargaController;
use App\Http\Controllers\Admin\StrukturOrganisasiController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;


// Route publik
Route::get('/', [HomeController::class, 'index'])->name('landing.home');
Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/search', [BeritaController::class, 'search']);
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');

Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri.index');
Route::get('/galeri/search', [GaleriController::class, 'search'])->name('galeri.search');
Route::get('/galeri/{id}', [GaleriController::class, 'show'])->name('galeri.show');

Route::get('/tentang/struktur-organisasi', [StrukturOrganisasiController::class, 'show'])->name('struktur-organisasi.show');

Route::get('/pasar', [PasarController::class, 'index'])->name('pasar.index');
Route::get('/pasar/search', [PasarController::class, 'search'])->name('pasar.search');
Route::get('pasar/{id}', [PasarController::class, 'show'])->name('pasar.show');

Route::get('/info-harga', [InfoHargaController::class, 'index'])->name('info-harga.index');
Route::get('/info-harga/search', [InfoHargaController::class, 'search'])->name('info-harga.search');
Route::get('/info-harga/{id}', [InfoHargaController::class, 'show'])->name('info-harga.show');

Route::get('/ppid/{slug}', [PpidController::class, 'show'])->name('ppid.show');
Route::get('/alur/{slug}', [AlurController::class, 'show'])->name('alur.show');
Route::get('/tentang/{slug}', [BalaiController::class, 'show'])->name('balai.show');

Route::get('/ppid/unduh/{id}', [PpidController::class, 'unduh'])->name('ppid.unduh');
Route::get('/dokumen-pasar/unduh/{id}', [PasarController::class, 'unduh'])->name('dokumen-pasar.unduh');

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


    Route::resource('galeri', GaleriController::class)->except(['show']);
    Route::resource('slider', SliderController::class)->except(['show']);
    Route::resource('sosmed', SosmedController::class)->except(['show']);
    // Route::resource('profil-desa', ProfilDesaController::class)->except(['show']);


    // Route tambahan 
    Route::post('pasars/detail', [PasarController::class, 'storeDetail'])->name('pasars.storeDetail');
    Route::post('pasars/dokumen', [PasarController::class, 'storeDokumenPasar'])->name('pasars.storeDokumenPasar');
    Route::post('galeri/kategori-galeri', [GaleriController::class, 'storeKategoriGaleri'])->name('galeri.storeKategoriGaleri');

    Route::put('pasars/update-detail/{id}', [PasarController::class, 'updateDetail'])->name('pasars.updateDetail');
    Route::put('pasars/update-dokumen-pasar/{id}', [PasarController::class, 'updateDokumen'])->name('pasars.updateDokumen');

    Route::get('/ppid/unduh/{id}', [PpidController::class, 'unduh'])->name('ppid.unduh');
    Route::get('/dokumen-pasar/unduh/{id}', [PasarController::class, 'unduh'])->name('dokumen-pasar.unduh');
    Route::get('/tentang/{slug}', [BalaiController::class, 'show'])->name('balai.show');

    Route::delete('pasars/delete-detail/{id}', [PasarController::class, 'destroyDetail'])->name('pasars.destroyDetail');
    Route::delete('pasars/delete-dokumen-pasar/{id}', [PasarController::class, 'destroyDokumen'])->name('pasars.destroyDokumen');
    Route::delete('info-harga/delete-barang/{id}', [InfoHargaController::class, 'destroyBarang'])->name('info-harga.destroyBarang');
    Route::delete('info-harga/delete-harga/{id}', [InfoHargaController::class, 'destroyHarga'])->name('info-harga.destroyHarga');
    Route::delete('galeri/delete-kategori-galeri/{id}', [GaleriController::class, 'destroyKategoriGaleri'])->name('galeri.destroyKategoriGaleri');
    Route::delete('berita/delete-berita/{id}', [BeritaController::class, 'destroyBerita'])->name('berita.destroyBerita');
});

require __DIR__ . '/auth.php';
