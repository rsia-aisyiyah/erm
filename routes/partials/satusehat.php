<?php

use App\Http\Controllers\SatuSehatRmeController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::prefix('satusehat')->group(function () {
        Route::prefix('rme')->group(function () {
            Route::get('/open', [SatuSehatRmeController::class, 'openRme'])->name('satusehat.rme.open');
            Route::post('/consent', [SatuSehatRmeController::class, 'requestConsent'])->name('satusehat.rme.consent');
        });
    });
});
