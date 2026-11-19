<?php

use App\Http\Controllers\OperasiController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('operasi')->name('operasi.')->group(function () {
    Route::get('/', [OperasiController::class, 'index'])->name('index');
    Route::get('/jadwal', [OperasiController::class, 'getJadwal'])->name('jadwal');
    Route::post('/booking/simpan', [OperasiController::class, 'simpanBooking'])->name('booking.simpan');
    Route::post('/booking/status', [OperasiController::class, 'updateStatusBooking'])->name('booking.status');
    Route::delete('/booking/hapus', [OperasiController::class, 'hapusBooking'])->name('booking.hapus');
    Route::get('/laporan', [OperasiController::class, 'getLaporan'])->name('laporan.detail');
    Route::post('/laporan/simpan', [OperasiController::class, 'simpanLaporan'])->name('laporan.simpan');
    Route::delete('/laporan/hapus', [OperasiController::class, 'hapusLaporan'])->name('laporan.hapus');
    Route::get('/laporan/cetak/{no_rawat}', [OperasiController::class, 'cetakLaporan'])->name('laporan.cetak');
    Route::get('/pasien/cari', [OperasiController::class, 'cariPasien'])->name('pasien.cari');
});

