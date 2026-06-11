<?php

use App\Http\Controllers\AskepRalanKebidananController;
use Illuminate\Support\Facades\Route;

Route::prefix('asesmen-keperawatan')->group(function ($route) {
    $route->prefix('kandungan')->group(function ($route) {
        $route->get('/', [AskepRalanKebidananController::class, 'getFirst'])->name('asesmen-keperawatan.kandungan.get');
        $route->post('/', [AskepRalanKebidananController::class, 'store'])->name('asesmen-keperawatan.kandungan.store');
        $route->get('print', [AskepRalanKebidananController::class, 'print'])->name('asesmen-keperawatan.kandungan.print');
    });
});