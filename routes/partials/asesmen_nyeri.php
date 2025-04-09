<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AsesmenNyeriAnakController;
use App\Http\Controllers\AsesmenNyeriBalitaController;
use App\Http\Controllers\AsesmenNyeriBatitaController;
use App\Http\Controllers\AsesmenNyeriDewasaController;
use App\Http\Controllers\AsesmenNyeriNeonatusController;

Route::middleware('auth')->group(function () {
    Route::post('asesmen-nyeri-dewasa', [AsesmenNyeriDewasaController::class, 'create']);
    Route::get('asesmen-nyeri-dewasa', [AsesmenNyeriDewasaController::class, 'get']);
    Route::get('asesmen-nyeri-dewasa/first', [AsesmenNyeriDewasaController::class, 'first']);
    Route::post('asesmen-nyeri-dewasa/delete', [AsesmenNyeriDewasaController::class, 'delete']);

    Route::post('asesmen-nyeri-batita', [AsesmenNyeriBatitaController::class, 'create']);
    Route::get('asesmen-nyeri-batita', [AsesmenNyeriBatitaController::class, 'get']);
    Route::post('asesmen-nyeri-batita/delete', [AsesmenNyeriBatitaController::class, 'delete']);
    Route::get('asesmen-nyeri-batita/first', [AsesmenNyeriBatitaController::class, 'first']);

    Route::post('asesmen-nyeri-balita', [AsesmenNyeriBalitaController::class, 'create']);
    Route::get('asesmen-nyeri-balita', [AsesmenNyeriBalitaController::class, 'get']);
    Route::post('asesmen-nyeri-balita/delete', [AsesmenNyeriBalitaController::class, 'delete']);
    Route::get('asesmen-nyeri-balita/first', [AsesmenNyeriBalitaController::class, 'first']);

    Route::post('asesmen-nyeri-anak', [AsesmenNyeriAnakController::class, 'create']);
    Route::get('asesmen-nyeri-anak', [AsesmenNyeriAnakController::class, 'get']);
    Route::post('asesmen-nyeri-anak/delete', [AsesmenNyeriAnakController::class, 'delete']);
    Route::get('asesmen-nyeri-anak/first', [AsesmenNyeriAnakController::class, 'first']);

    Route::post('asesmen-nyeri-neonatus', [AsesmenNyeriNeonatusController::class, 'create']);
    Route::get('asesmen-nyeri-neonatus', [AsesmenNyeriNeonatusController::class, 'get']);
    Route::post('asesmen-nyeri-neonatus/delete', [AsesmenNyeriNeonatusController::class, 'delete']);
    Route::get('asesmen-nyeri-neonatus/first', [AsesmenNyeriNeonatusController::class, 'first']);

});