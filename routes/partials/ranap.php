<?php

use App\Http\Controllers\PemeriksaanRanapController;
use App\Http\Controllers\PermintaanDietController;
use App\Http\Controllers\SkriningGiziController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'erm.session'])->group(function () {
    Route::group(['prefix' => 'ranap'], function ($q) {
        $q->get('monitoring-pulang', [\App\Http\Controllers\RanapController::class, 'monitoringPulang'])->name('ranap.monitoring-pulang');
        $q->get('kelengkapan-berkas', [\App\Http\Controllers\RanapController::class, 'kelengkapanBerkas'])->name('ranap.kelengkapan-berkas');
        $q->get('kelengkapan-berkas-batch', [\App\Http\Controllers\RanapController::class, 'kelengkapanBerkasBatch'])->name('ranap.kelengkapan-berkas-batch');
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
        $q->get('permintaan-obat/cetak', [\App\Http\Controllers\PermintaanStokObatPasienController::class, 'cetak'])->name('ranap.permintaan-obat.cetak');

        // Farmasi Validasi & Penyiapan Obat
        $q->post('permintaan-obat/validasi', [\App\Http\Controllers\PermintaanStokObatPasienController::class, 'validasi'])->name('ranap.permintaan-obat.validasi');
        $q->post('permintaan-obat/ubah-aturan-pakai', [\App\Http\Controllers\PermintaanStokObatPasienController::class, 'ubahAturanPakai'])->name('ranap.permintaan-obat.ubah-aturan-pakai');

        // Jadwal & Pemberian Obat ke Pasien (E-MAR)
        $q->get('pemberian-obat/stok', [\App\Http\Controllers\PermintaanStokObatPasienController::class, 'getStokPasien'])->name('ranap.pemberian-obat.stok');
        $q->post('pemberian-obat/simpan', [\App\Http\Controllers\PermintaanStokObatPasienController::class, 'beriObat'])->name('ranap.pemberian-obat.simpan');
        $q->delete('pemberian-obat/hapus', [\App\Http\Controllers\PermintaanStokObatPasienController::class, 'hapusPemberian'])->name('ranap.pemberian-obat.hapus');
        $q->get('pemberian-obat/riwayat', [\App\Http\Controllers\PermintaanStokObatPasienController::class, 'riwayatPemberian'])->name('ranap.pemberian-obat.riwayat');
        $q->get('pemberian-obat/rekonsiliasi-emar', [\App\Http\Controllers\PermintaanStokObatPasienController::class, 'getRekonsiliasiEmar'])->name('ranap.pemberian-obat.rekonsiliasi-emar');
        $q->post('pemberian-obat/verifikasi-billing-emar', [\App\Http\Controllers\PermintaanStokObatPasienController::class, 'verifikasiBillingEmar'])->name('ranap.pemberian-obat.verifikasi-billing-emar');

        // Rekap & Cetak Formulir RM 5A (Daftar Pemberian Obat)
        $q->get('pemberian-obat/rekap-rm5a', [\App\Http\Controllers\PermintaanStokObatPasienController::class, 'getRekapRm5a'])->name('ranap.pemberian-obat.rekap-rm5a');
        $q->get('pemberian-obat/cetak-rm5a/{no_rawat}', [\App\Http\Controllers\PermintaanStokObatPasienController::class, 'cetakRm5a'])->name('ranap.pemberian-obat.cetak-rm5a');
    });
});