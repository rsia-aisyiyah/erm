<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\RegPeriksaController;

Route::middleware('auth')->group(function () {
    Route::get('registrasi', [RegPeriksaController::class, 'index']);
    Route::get('registrasi/ambil', [RegPeriksaController::class, 'ambil']);
    Route::get('registrasi/ambil/table', [RegPeriksaController::class, 'ambilTable']);
    Route::get('/registrasi/status', [RegPeriksaController::class, 'status']);
    Route::get('/registrasi/selesai', [RegPeriksaController::class, 'hitungSelesai']);
    Route::get('/registrasi/batal', [RegPeriksaController::class, 'hitungBatal']);
    Route::get('/registrasi/tunggu', [RegPeriksaController::class, 'hitungTunggu']);
    Route::get('/registrasi/riwayat', [RegPeriksaController::class, 'riwayat']);
    Route::get('/registrasi/ubah/dokter', [RegPeriksaController::class, 'ubahDpjp']);
    Route::get('/registrasi/foto', [UploadController::class, 'ambilPeriksa']);

    Route::post('/registrasi/buat', [RegPeriksaController::class, 'create']);
});