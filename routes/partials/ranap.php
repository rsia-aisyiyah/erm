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
        $q->get('permintaan-diet/cetak', [PermintaanDietController::class, 'cetak'])->name('ranap.permintaan-diet.cetak');

        // Route Skrining Gizi Pasien
        $q->get('skrining-gizi', [SkriningGiziController::class, 'get'])->name('ranap.skrining-gizi.get');
        $q->post('skrining-gizi', [SkriningGiziController::class, 'store'])->name('ranap.skrining-gizi.store');
        $q->get('skrining-gizi/cetak', [SkriningGiziController::class, 'cetak'])->name('ranap.skrining-gizi.cetak');

        // Route Permintaan Stok Obat Pasien (Ranap UDD)
        $q->get('permintaan-obat/nomor', [\App\Http\Controllers\PermintaanStokObatPasienController::class, 'getNomor'])->name('ranap.permintaan-obat.nomor');
        $q->get('permintaan-obat', [\App\Http\Controllers\PermintaanStokObatPasienController::class, 'get'])->name('ranap.permintaan-obat.get');
        $q->get('permintaan-obat/detail/{no_permintaan}', [\App\Http\Controllers\PermintaanStokObatPasienController::class, 'getDetail'])->name('ranap.permintaan-obat.detail');
        $q->post('permintaan-obat', [\App\Http\Controllers\PermintaanStokObatPasienController::class, 'simpan'])->name('ranap.permintaan-obat.simpan');
        $q->delete('permintaan-obat/{no_permintaan}', [\App\Http\Controllers\PermintaanStokObatPasienController::class, 'hapus'])->name('ranap.permintaan-obat.hapus');

        // Farmasi Validasi & Penyiapan Obat
        $q->post('permintaan-obat/validasi', [\App\Http\Controllers\PermintaanStokObatPasienController::class, 'validasi'])->name('ranap.permintaan-obat.validasi');

        // Jadwal & Pemberian Obat ke Pasien (E-MAR)
        $q->get('pemberian-obat/stok', [\App\Http\Controllers\PermintaanStokObatPasienController::class, 'getStokPasien'])->name('ranap.pemberian-obat.stok');
        $q->post('pemberian-obat/simpan', [\App\Http\Controllers\PermintaanStokObatPasienController::class, 'beriObat'])->name('ranap.pemberian-obat.simpan');
        $q->delete('pemberian-obat/hapus', [\App\Http\Controllers\PermintaanStokObatPasienController::class, 'hapusPemberian'])->name('ranap.pemberian-obat.hapus');
        $q->get('pemberian-obat/riwayat', [\App\Http\Controllers\PermintaanStokObatPasienController::class, 'riwayatPemberian'])->name('ranap.pemberian-obat.riwayat');
    });
});