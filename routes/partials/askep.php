<?php

use App\Http\Controllers\AskepRalanAnakController;
use App\Http\Controllers\AskepRalanKebidananController;
use App\Http\Controllers\MaslahAskepRalanAnakController;
use App\Http\Controllers\MasterMasalahKeperawatanAnakController;
use App\Http\Controllers\MasterRencanaKeperawatanAnakController;
use App\Http\Controllers\RencanaAskepRalanAnakController;
use Illuminate\Support\Facades\Route;

Route::prefix('asesmen-keperawatan')->group(function ($route) {

    $route->prefix('master-masalah')->group(function ($route) {
        $route->prefix('anak')->group(function ($route) {
            $route->get('/', [MasterMasalahKeperawatanAnakController::class, 'get'])->name('asesmen-keperawatan.master-masalah.anak.get');
        });
    });
    $route->prefix('master-rencana')->group(function ($route) {
        $route->prefix('anak')->group(function ($route) {
            $route->get('', [MasterRencanaKeperawatanAnakController::class, 'get'])->name('asesmen-keperawatan.master-rencana.anak.get');
        });
    });
    $route->prefix('kandungan')->group(function ($route) {
        $route->get('/', [AskepRalanKebidananController::class, 'getFirst'])->name('asesmen-keperawatan.kandungan.get');
        $route->post('/', [AskepRalanKebidananController::class, 'store'])->name('asesmen-keperawatan.kandungan.store');
        $route->get('print', [AskepRalanKebidananController::class, 'print'])->name('asesmen-keperawatan.kandungan.print');
    });
    $route->prefix('anak')->group(function ($route) {
        $route->get('/', [AskepRalanAnakController::class, 'ambilDetail'])->name('asesmen-keperawatan.anak.get');
        $route->post('/', [AskepRalanAnakController::class, 'store'])->name('asesmen-keperawatan.anak.store');
        $route->get('masalah', [MaslahAskepRalanAnakController::class, 'get'])->name('asesmen-keperawatan.anak.masalah');
        $route->get('rencana', [RencanaAskepRalanAnakController::class, 'get'])->name('asesmen-keperawatan.anak.rencana');
        $route->get('print', [AskepRalanAnakController::class, 'print'])->name('asesmen-keperawatan.anak.print');
    });
});
