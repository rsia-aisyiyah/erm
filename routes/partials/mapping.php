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
    Route::prefix('mapping')->group(function () {
		Route::get('poliklinik', [\App\Http\Controllers\MappingPoliBpjsController::class, 'get']);
		Route::get('dokter', [\App\Http\Controllers\MappingDokterBpjsController::class, 'get']);
    });

});

