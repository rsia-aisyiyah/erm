<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PoliklinikController;
use App\Http\Controllers\SelesaiPoliController;
use App\Http\Controllers\EstimasiPoliController;
use App\Http\Controllers\AskepRalanAnakController;
use App\Http\Controllers\AskepRalanKebidananController;
use App\Http\Controllers\AsesmenMedisRajalAnakController;
use App\Http\Controllers\AsesmenMedisRajalKandunganController;

Route::middleware('auth')->group(function () {
    Route::get('/poliklinik', [PoliklinikController::class, 'index'])->name('poliklinik');
    Route::get('/poliklinik/dokter', [PoliklinikController::class, 'poliDokter']);
    Route::get('/poliklinik/table', [PoliklinikController::class, 'tbPoliPasien']);
    Route::get('/poliklinik/{kd_poli}', [PoliklinikController::class, 'viewPoliPasien']);
    Route::get('/poliklinik/count/{kd_poli}', [PoliklinikController::class, 'countUpload']);
    Route::get('/pemeriksaan/jumlah', [PoliklinikController::class, 'jumlahPasienPoli']);
    Route::get('/poli/panggil', [EstimasiPoliController::class, 'get']);
    Route::post('/poliklinik/panggil', [EstimasiPoliController::class, 'kirim']);
    Route::delete('/poliklinik/batal', [EstimasiPoliController::class, 'hapus']);
    Route::post('/poliklinik/selesai', [SelesaiPoliController::class, 'kirim']);
    Route::get('poliklinik/status/periksa', [PoliklinikController::class, 'statusSoap']);
    Route::get('poliklinik/status/upload', [PoliklinikController::class, 'statusUpload']);
    Route::get('poliklinik/askep/kebidanan', [AskepRalanKebidananController::class, 'ambil']);
    Route::get('poliklinik/askep/kebidanan/{noRawat}', [AskepRalanKebidananController::class, 'get']);
    Route::get('poliklinik/askep/anak', [AskepRalanAnakController::class, 'ambil']);
    Route::get('poliklinik/askep/anak/detail', [AskepRalanAnakController::class, 'ambilDetail']);

    Route::get('poliklinik/asmed/kandungan/get/{noRawat}', [AsesmenMedisRajalKandunganController::class, 'get']);
    Route::post('poliklinik/asmed/kandungan/simpan', [AsesmenMedisRajalKandunganController::class, 'insert']);
    Route::post('poliklinik/asmed/kandungan/edit', [AsesmenMedisRajalKandunganController::class, 'edit']);
    Route::get('poliklinik/asmed/kandungan/riwayat/{no_rkm_medis}', [AsesmenMedisRajalKandunganController::class, 'getByNoRm']);
    Route::get('poliklinik/asmed/kandungan/print/{no_rawat}', [AsesmenMedisRajalKandunganController::class, 'print']);

    Route::post('poliklinik/asmed/anak/simpan', [AsesmenMedisRajalAnakController::class, 'insert']);
    Route::post('poliklinik/asmed/anak/edit', [AsesmenMedisRajalAnakController::class, 'edit']);
    Route::get('poliklinik/asmed/anak/get/{noRawat}', [AsesmenMedisRajalAnakController::class, 'get']);
    Route::get('poliklinik/asmed/anak/riwayat/{no_rkm_medis}', [AsesmenMedisRajalAnakController::class, 'getByNoRm']);
    Route::get('poliklinik/asmed/anak/print/{noRawat}', [AsesmenMedisRajalAnakController::class, 'print']);
});