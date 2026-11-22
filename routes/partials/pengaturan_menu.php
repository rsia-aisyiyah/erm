<?php

use App\Http\Controllers\ErmMenuController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'erm.session', 'erm.menu:pengaturan/menu'])->prefix('pengaturan/menu')->group(function () {
    Route::get('/', [ErmMenuController::class, 'index'])->name('pengaturan.menu.index');
    Route::post('/simpan', [ErmMenuController::class, 'simpan'])->name('pengaturan.menu.simpan');
    Route::post('/toggle-status', [ErmMenuController::class, 'toggleStatus'])->name('pengaturan.menu.toggle');
    Route::delete('/{id}', [ErmMenuController::class, 'destroy'])->name('pengaturan.menu.destroy');
    Route::post('/update-akses', [ErmMenuController::class, 'updateAkses'])->name('pengaturan.menu.update-akses');
    Route::post('/user-override', [ErmMenuController::class, 'simpanUserOverride'])->name('pengaturan.menu.user-override.simpan');
    Route::delete('/user-override', [ErmMenuController::class, 'hapusUserOverride'])->name('pengaturan.menu.user-override.hapus');
    Route::get('/cari-pegawai', [ErmMenuController::class, 'cariPegawai'])->name('pengaturan.menu.cari-pegawai');
});

