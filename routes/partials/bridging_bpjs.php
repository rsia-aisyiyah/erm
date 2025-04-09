<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Bridging\SepController;
use App\Http\Controllers\Bridging\IcareController;
use App\Http\Controllers\Bridging\PesertaController;
use App\Http\Controllers\Bridging\RujukanController;
use App\Http\Controllers\Bridging\ReferensiController;
use App\Http\Controllers\Apotek\ApotekReferensiController;
use App\Http\Controllers\Bridging\RencanaKontrolController;
Route::middleware('auth')->group(function () {
    Route::prefix('bridging')->group(function () {
        Route::prefix('referensi')->group(function () {
            Route::get('/propinsi', [ReferensiController::class, 'getPropinsi']);
            Route::get('/diagnosa/{diagnosa}', [ReferensiController::class, 'getDiagnosa']);
            Route::get('/poli/{poli}', [ReferensiController::class, 'getPoli']);
            Route::get('/dokter/pelayanan/{jenis}/{tgl}/{kd_sps}', [ReferensiController::class, 'getDokterDpjp']);
            Route::get('/faskes/{faskes}/{jnsFaskes?}', [ReferensiController::class, 'getFaskes']);
        });
        Route::prefix('rujukan')->group(function () {
            Route::post('insert', [RujukanController::class, 'insertRujukanKeluar']);
            Route::get('keluar/list/{tglPertama}/{tglKedua}', [RujukanController::class, 'getListRujukanKeluarRs']);
            Route::get('keluar/{noRujukan}', [RujukanController::class, 'getRujukanKeluar']);
            Route::get('pcare/peserta/{noka}', [RujukanController::class, 'geRujukanPcarePeserta']);
            Route::get('peserta/{noka}', [RujukanController::class, 'getRujukanPeserta']);
            Route::get('list/peserta/{noka}', [RujukanController::class, 'getListRujukanPeserta']);
        });
        Route::prefix('rencanaKontrol')->group(function () {
            Route::get('{jnsKontrol}/{nomor}/{tanggal}', [RencanaKontrolController::class, 'getSpesialis']);
            Route::get('jadwal/{jnsKontrol}/{kdPoli}/{tanggal}', [RencanaKontrolController::class, 'getDokterSpesialis']);
            Route::get('list/{bulan}/{tahun}/{noka}/{filter}', [RencanaKontrolController::class, 'getListRencana']);
            Route::post('insert', [RencanaKontrolController::class, 'insertRencanaKontrol']);
        });

        Route::prefix('spri')->group(function () {
            Route::post('insert', [RencanaKontrolController::class, 'insertPerintahInap']);
        });
        Route::get('peserta/nik/{nik}/{tanggal}', [PesertaController::class, 'getPesertaNik']);
        Route::get('peserta/noka/{noka}/{tanggal}', [PesertaController::class, 'getPesertaNoka']);
        Route::get('SEP/{sep}', [SepController::class, 'getSep']);
        Route::get('peserta/nokartu/{nokartu}/tglsep/{tglsep}', [ReferensiController::class, 'getPasien']);
        Route::post('/riwayat/icare', [IcareController::class, 'rsValidate']);

        Route::get('apotek/referensi/dhpo', [ApotekReferensiController::class, 'getDpho']);
    });

});