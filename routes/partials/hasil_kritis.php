<?php

use App\Http\Controllers\RsiaHasilKritisController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'hasil-kritis'], function ($route) {
    $route->get('/petugas', [RsiaHasilKritisController::class, 'getPetugas'])->name('hasil-kritis.petugas');
    // $route->get('/', [RsiaHasilKritisController::class, 'index'])->name('hasil-kritis.index');
    $route->get('/{id}', [RsiaHasilKritisController::class, 'get'])->name('hasil-kritis.show');
    $route->post('/', [RsiaHasilKritisController::class, 'create'])->name('hasil-kritis.store');
    $route->post('/verifikasi/{id}', [RsiaHasilKritisController::class, 'verifikasi'])->name('hasil-kritis.verifikasi');
    $route->post('/delete/{id}', [RsiaHasilKritisController::class, 'delete'])->name('hasil-kritis.delete');
    $route->post('/update/{id}', [RsiaHasilKritisController::class, 'update'])->name('hasil-kritis.update');
});