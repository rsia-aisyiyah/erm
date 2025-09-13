<?php

use App\DataTables\ResikoJatuhDewasaDataTable;
use App\Http\Controllers\DataBarangController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LabController;
use App\Http\Controllers\PermintaanLabController;
use App\Http\Controllers\JnsPerawatabLabController;
use App\Http\Controllers\DetailPermintaanLabController;
use App\Http\Controllers\DetailPemeriksaanLabController;
use App\Http\Controllers\TemplateLaboratoriumController;
use App\Http\Controllers\PermintaanPemeriksaanLabController;
use App\Http\Controllers\ResikoJatuhAnakController;
use App\Http\Controllers\ResikoJatuhDewasaController;
use App\Models\ResikoJatuhDewasa;

Route::middleware('auth')->group(function () {
    Route::prefix('obat')->group(function ($route) {
        $route->get('/', [DataBarangController::class, 'index']);
        $route->get('/table', [DataBarangController::class, 'table']);
    });

});