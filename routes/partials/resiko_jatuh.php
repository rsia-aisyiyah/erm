<?php

use App\DataTables\ResikoJatuhDewasaDataTable;
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
    Route::prefix('asesmen/resiko-jatuh-dewasa')->group(function ($route) {
        $route->get('/', [ResikoJatuhDewasaController::class, 'index']);
        $route->get('/get', [ResikoJatuhDewasaController::class, 'get']);
        $route->put('/', [ResikoJatuhDewasaController::class, 'update']);
        $route->post('/', [ResikoJatuhDewasaController::class, 'create']);
        $route->delete('/', [ResikoJatuhDewasaController::class, 'delete']);
    });
    Route::prefix('asesmen/resiko-jatuh-anak')->group(function ($route) {
        $route->get('/', [ResikoJatuhAnakController::class, 'index']);
        $route->get('/get', [ResikoJatuhAnakController::class, 'get']);
        $route->put('/', [ResikoJatuhAnakController::class, 'update']);
        $route->post('/', [ResikoJatuhAnakController::class, 'create']);
        $route->delete('/', [ResikoJatuhAnakController::class, 'delete']);
    });
});