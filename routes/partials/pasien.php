<?php

use App\Models\Pasien;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PenjabController;
use App\Http\Controllers\CacatFisikController;
use App\Http\Controllers\SukuBangsaController;
use App\Http\Controllers\BahasaPasienController;
use App\Http\Controllers\RsiaKetPasienController;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Propinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::prefix('pasien')->group(function () {
        Route::get('/', [PasienController::class, 'index']);
        Route::get('/edit/{no_rkm_medis}', function ($no_rkm_medis) {
            $id = Crypt::decrypt($no_rkm_medis);
            $pasien = Pasien::where('no_rkm_medis', $id)->first();
            return view('content.pasien.edit', [
                'pasien' => $pasien,
            ]);
        });
        Route::get('/table', [PasienController::class, 'table']);
        Route::get('/cari', [PasienController::class, 'search']);
        Route::get('/get', [PasienController::class, 'get']);
        Route::get('/ambil/{no_rkm_medis}', [PasienController::class, 'ambil']);

        Route::get('/keterangan', [RsiaKetPasienController::class, 'get']);
        Route::post('/keterangan', [RsiaKetPasienController::class, 'create']);

        Route::get('/suku-bangsa', [SukuBangsaController::class, 'get']);
        Route::get('/bahasa', [BahasaPasienController::class, 'get']);
        Route::get('/cacat', [CacatFisikController::class, 'get']);
        Route::get('/penjab', [PenjabController::class, 'get']);

        Route::get('/kelurahan', function (Kelurahan $kelurahan, Request $request) {
            return $kelurahan->where('nm_kel', 'like', '%' . $request->nama . '%')->get();
        });

        Route::get('/kecamatan', function (Kecamatan $kecamatan, Request $request) {
            return $kecamatan->where('nm_kec', 'like', '%' . $request->nama . '%')->get();
        });
        Route::get('/kabupaten', function (Kabupaten $kabupaten, Request $request) {
            return $kabupaten->where('nm_kab', 'like', '%' . $request->nama . '%')->get();
        });
        Route::get('/propinsi', function (Propinsi $propinsi, Request $request) {
            return $propinsi->where('nm_prop', 'like', '%' . $request->nama . '%')->get();
        });
    });
});