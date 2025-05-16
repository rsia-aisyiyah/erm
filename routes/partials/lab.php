<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LabController;
use App\Http\Controllers\PermintaanLabController;
use App\Http\Controllers\JnsPerawatabLabController;
use App\Http\Controllers\DetailPermintaanLabController;
use App\Http\Controllers\DetailPemeriksaanLabController;
use App\Http\Controllers\TemplateLaboratoriumController;
use App\Http\Controllers\PermintaanPemeriksaanLabController;

Route::middleware('auth')->group(function () {
    Route::prefix('lab')->group(function ($route) {
        $route->get('/', [LabController::class, 'index']);
        $route->get('/petugas', [LabController::class, 'petugas']);
        $route->get('/ambil', [LabController::class, 'ambil']);
        $route->get('/ambil/table', [LabController::class, 'getDataTable']);

        $route->get('/jenis/get', [JnsPerawatabLabController::class, 'get']);
        $route->get('/jenis/template/get', [JnsPerawatabLabController::class, 'getTemplate']);
        $route->prefix('permintaan')->group(function ($route) {
            $route->get('/', [PermintaanLabController::class, 'get']);
            $route->get('/table', [PermintaanLabController::class, 'getDataTable']);
            $route->post('/', [PermintaanLabController::class, 'create']);
            $route->get('/nomor', [PermintaanLabController::class, 'getNomor']);
            $route->post('/detail', [DetailPermintaanLabController::class, 'create']);
            $route->post('/pemeriksaan', [PermintaanPemeriksaanLabController::class, 'create']);
        });

        $route->get('/template/get', [TemplateLaboratoriumController::class, 'get']);
        $route->get('/hasil', [DetailPemeriksaanLabController::class, 'get']);

    });
});