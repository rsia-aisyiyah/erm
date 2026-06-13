<?php

use App\Http\Controllers\AskepRalanAnakController;
use App\Http\Controllers\AskepRalanKebidananController;
use Illuminate\Support\Facades\Route;

Route::prefix('asesmen-keperawatan')->group(function ($route) {
    $route->prefix('kandungan')->group(function ($route) {
        $route->get('/', [AskepRalanKebidananController::class, 'getFirst'])->name('asesmen-keperawatan.kandungan.get');
        $route->post('/', [AskepRalanKebidananController::class, 'store'])->name('asesmen-keperawatan.kandungan.store');
        $route->get('print', [AskepRalanKebidananController::class, 'print'])->name('asesmen-keperawatan.kandungan.print');
    });
    $route->prefix('anak')->group(function ($route) {

        $route->get('/', [AskepRalanAnakController::class, 'ambilDetail'])->name('asesmen-keperawatan.anak.get');
        $route->post('/', [AskepRalanAnakController::class, 'store'])->name('asesmen-keperawatan.anak.store');
    });
});
