<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PresensiController;
use Illuminate\Support\Facades\Route;

// Halaman utama langsung diarahkan ke Dashboard dengan proteksi Login
Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified']);

// Rute Dashboard Admin Panel
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Semua rute di bawah ini wajib LOGIN (Proteksi Keamanan Auth)
Route::middleware('auth')->group(function () {
    
    // 👤 Fitur CRUD Manajemen Siswa
    Route::resource('siswa', SiswaController::class);

    // 📅 Fitur Manajemen Presensi Harian & Rekap Laporan
    Route::get('/presensi', [PresensiController::class, 'index'])->name('presensi.index');
    Route::post('/presensi', [PresensiController::class, 'store'])->name('presensi.store');
    Route::get('/rekap', [PresensiController::class, 'rekap'])->name('presensi.rekap');

    // ⚙️ Fitur Pengaturan Profil Admin (Bawaan Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';