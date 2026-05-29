<?php

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Rute Bawaan (Mengambil data user yang sedang login via token)
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// 🌐 RUTE BARU: Endpoint API untuk mengambil seluruh data siswa dalam format JSON
Route::get('/siswa', function () {
    return response()->json([
        'success' => true,
        'message' => 'RESTful API Presensi AI: Daftar data siswa berhasil diambil.',
        'data' => Siswa::all()
    ], 200);
});