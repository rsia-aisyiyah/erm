<?php

use App\Http\Controllers\PemeriksaanRanapController;
use App\Http\Controllers\PermintaanDietController;
use App\Http\Controllers\SkriningGiziController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::group(['prefix' => 'ranap'], function ($q) {
        $q->get('pemeriksaan-ranap/table', [PemeriksaanRanapController::class, 'dataTable'])->name('ranap.pemeriksaan-ranap.table');
        $q->get('pemeriksaan-ranap', [PemeriksaanRanapController::class, 'index'])->name('ranap.pemeriksaan-ranap.index');

        // Route Permintaan Diet Pasien
        $q->get('permintaan-diet/master', [PermintaanDietController::class, 'getMasterDiet'])->name('ranap.permintaan-diet.master');
        $q->get('permintaan-diet', [PermintaanDietController::class, 'get'])->name('ranap.permintaan-diet.get');
        $q->post('permintaan-diet', [PermintaanDietController::class, 'store'])->name('ranap.permintaan-diet.store');
        $q->delete('permintaan-diet', [PermintaanDietController::class, 'destroy'])->name('ranap.permintaan-diet.destroy');
        $q->get('permintaan-diet/riwayat', [PermintaanDietController::class, 'riwayat'])->name('ranap.permintaan-diet.riwayat');

        // Route Skrining Gizi Pasien
        $q->get('skrining-gizi', [SkriningGiziController::class, 'get'])->name('ranap.skrining-gizi.get');
        $q->post('skrining-gizi', [SkriningGiziController::class, 'store'])->name('ranap.skrining-gizi.store');
    });
});