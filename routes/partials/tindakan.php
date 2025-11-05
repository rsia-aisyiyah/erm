<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LabController;
use App\Http\Controllers\PermintaanLabController;
use App\Http\Controllers\JnsPerawatabLabController;
use App\Http\Controllers\DetailPermintaanLabController;
use App\Http\Controllers\DetailPemeriksaanLabController;
use App\Http\Controllers\TemplateLaboratoriumController;
use App\Http\Controllers\PermintaanPemeriksaanLabController;
use App\Http\Controllers\SaranKesanLabController;

Route::middleware('auth')->group(function () {
	Route::prefix('jenis-tindakan')->group(function ($route) {
		$route->get('/datatable/{param}', [\App\Http\Controllers\JenisPerawatanController::class, 'dataTable']);
		$route->get('ranap/datatable/{param}', [\App\Http\Controllers\JenisPerawatanInapController::class, 'dataTable']);
	});
	Route::prefix('tindakan')->group(function ($route) {
		$route->prefix('dokter')->group(function($route){
			$route->post('/', [\App\Http\Controllers\TindakanDokterController::class, 'create']);
			$route->get('/get', [\App\Http\Controllers\TindakanDokterController::class, 'get']);
			$route->delete('/delete', [\App\Http\Controllers\TindakanDokterController::class, 'delete']);
		});
		$route->prefix('perawat')->group(function($route){
			$route->post('/', [\App\Http\Controllers\TindakanPerawatController::class, 'create']);
			$route->get('/get', [\App\Http\Controllers\TindakanPerawatController::class, 'get']);
			$route->delete('/delete', [\App\Http\Controllers\TindakanPerawatController::class, 'delete']);
		});
		$route->prefix('dokter-perawat')->group(function($route){
			$route->post('/', [\App\Http\Controllers\TindakanDokterPerawatController::class, 'create']);
			$route->get('/get', [\App\Http\Controllers\TindakanDokterPerawatController::class, 'get']);
			$route->delete('/delete', [\App\Http\Controllers\TindakanDokterPerawatController::class, 'delete']);
		});

	});
	Route::prefix('tindakan-ranap')->group(function ($route){
		$route->prefix('dokter')->group(function($route){
			$route->get('/get', [\App\Http\Controllers\TindakanDokterRanapController::class, 'get']);
		});
	});
});