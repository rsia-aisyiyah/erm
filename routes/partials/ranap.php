<?php

use App\Http\Controllers\PemeriksaanRanapController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::group(['prefix' => 'ranap'], function ($q) {
        $q->get('pemeriksaan-ranap/table', [PemeriksaanRanapController::class, 'dataTable'])->name('ranap.pemeriksaan-ranap.table');
        $q->get('pemeriksaan-ranap', [PemeriksaanRanapController::class, 'index'])->name('ranap.pemeriksaan-ranap.index');
    });
});