<?php

use App\Models\Pasien;
use App\Models\ResepObat;
use App\Models\Poliklinik;
use App\Models\DetailPemberianObat;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LabController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RanapController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\ResepObatController;
use App\Http\Controllers\DataBarangController;
use App\Http\Controllers\PoliklinikController;
use App\Http\Controllers\RegPeriksaController;
use App\Http\Controllers\ResepDokterController;
use App\Http\Controllers\SelesaiPoliController;
use App\Http\Controllers\EstimasiPoliController;
use App\Http\Controllers\PemeriksaanRalanController;
use App\Http\Controllers\PemeriksaanRanapController;
use App\Http\Controllers\ResepDokterRacikanController;
use App\Http\Controllers\AskepRalanKebidananController;
use App\Http\Controllers\DetailPemberianObatController;
use App\Http\Controllers\PenilaianMedisKebidananController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\ResepDokterRacikanDetailController;

Route::get('/login', function () {
    return view('content.auth.login');
});
Route::post('/login', [LoginController::class, 'authenticate'])
    ->name('login')
    ->middleware('guest');

Route::middleware('auth')->group(function () {
    Route::get('/logout', [LoginController::class, 'logout']);
    Route::get('/', function () {
        return redirect('/poliklinik');
    });

    Route::get('/pasien', [PasienController::class, 'index']);
    Route::get('/pasien/cari', [PasienController::class, 'search']);
    Route::get('/pasien/show/{no_rkm_medis}', [
        PasienController::class,
        'show',
    ]);
    Route::get('/periksa/show/{no_rkm_medis}', [
        RegPeriksaController::class, 'show',
    ]);
    Route::get('periksa/detail', [
        RegPeriksaController::class,
        'detailPeriksa',
    ]);
    Route::get('/test/{no_rkm_medis}', [RegPeriksaController::class, 'show']);
    Route::get('/upload', [UploadController::class, 'index']);
    Route::get('/upload/show', [UploadController::class, 'showUpload']);
    Route::delete('/upload/delete/{id}', [UploadController::class, 'delete']);
    Route::post('/upload', [UploadController::class, 'upload']);
    Route::get('/upload/status', [PoliklinikController::class, 'statusUpload']);
    Route::get('/test', function () {
        return Pasien::limit(10)
            ->with('regPeriksa')
            ->get();
    });

    Route::get('/petugas/cari', [PetugasController::class, 'cari']);

    Route::get('/poliklinik', [PoliklinikController::class, 'index'])->name('poliklinik');
    Route::get('/poliklinik/dokter', [
        PoliklinikController::class,
        'poliDokter',
    ]);
    Route::get('/poliklinik/table', [
        PoliklinikController::class,
        'tbPoliPasien',
    ]);
    Route::get('/poliklinik/{kd_poli}', [
        PoliklinikController::class,
        'viewPoliPasien',
    ]);
    Route::get('/poliklinik/count/{kd_poli}', [PoliklinikController::class, 'countUpload']);
    Route::get('/pemeriksaan/jumlah', [PoliklinikController::class, 'jumlahPasienPoli']);
    Route::post('/poliklinik/panggil', [EstimasiPoliController::class, 'kirim']);
    Route::delete('/poliklinik/batal', [EstimasiPoliController::class, 'hapus']);
    Route::post('/poliklinik/selesai', [SelesaiPoliController::class, 'kirim']);
    Route::get('poliklinik/status/periksa', [PoliklinikController::class, 'statusSoap']);
    Route::get('poliklinik/status/upload', [PoliklinikController::class, 'statusUpload']);
    Route::get('poliklinik/askep/kebidanan', [AskepRalanKebidananController::class, 'ambil']);

    Route::get('registrasi/ambil', [RegPeriksaController::class, 'ambil']);
    Route::get('/registrasi/status', [RegPeriksaController::class, 'status']);
    // Route::get('/registrasi/status', [RegPeriksaController::class, 'statusDiterima']);
    Route::get('/registrasi/selesai', [RegPeriksaController::class, 'hitungSelesai']);
    Route::get('/registrasi/batal', [RegPeriksaController::class, 'hitungBatal']);
    Route::get('/registrasi/tunggu', [RegPeriksaController::class, 'hitungTunggu']);
    Route::get('/registrasi/riwayat', [RegPeriksaController::class, 'riwayat']);
    Route::get('/registrasi/foto', [UploadController::class, 'ambilPeriksa']);


    Route::get('/pemeriksaan', [PemeriksaanRalanController::class, 'ambil']);
    Route::post('/pemeriksaan/simpan', [PemeriksaanRalanController::class, 'simpan']);
    Route::get('/soap', [PemeriksaanRanapController::class, 'ambil']);
    Route::get('/soap/ambil', [PemeriksaanRanapController::class, 'ambilSatu']);
    Route::post('/soap/ubah', [PemeriksaanRanapController::class, 'ubah']);
    Route::post('/soap/simpan', [PemeriksaanRanapController::class, 'simpan']);
    Route::delete('/soap/hapus', [PemeriksaanRanapController::class, 'hapus']);
    Route::get('/aturan', [DetailPemberianObatController::class, 'aturanPakai']);
    Route::get('lab/petugas', [LabController::class, 'petugas']);
    Route::get('lab/ambil', [LabController::class, 'ambil']);

    Route::get('ranap', [RanapController::class, 'index']);
    Route::get('ranap/pasien', [RanapController::class, 'ranap']);

    Route::get('dokter/ambil', [DokterController::class, 'ambil']);

    Route::get('asmed/kebidanan', [PenilaianMedisKebidananController::class, 'index']);

    Route::get('obat/', [DataBarangController::class, 'index']);
    Route::get('obat/cari', [DataBarangController::class, 'cari']);

    Route::get('/aturan/cari', [ResepDokterController::class, 'cari']);

    Route::get('/resep/cari', [ResepDokterController::class, 'cari']);
    Route::get('/resep/obat/akhir', [ResepObatController::class, 'akhir']);
    Route::get('/resep/obat/ambil', [ResepObatController::class, 'ambil']);
    Route::post('/resep/obat/simpan', [ResepObatController::class, 'simpan']);
    Route::post('/resep/obat/hapus', [ResepObatController::class, 'hapus']);

    Route::post('/resep/umum/simpan', [ResepDokterController::class, 'simpan']);
    Route::delete('/resep/umum/hapus', [ResepDokterController::class, 'hapus']);

    Route::get('/resep/racik/ambil', [ResepDokterRacikanController::class, 'ambil']);
    Route::post('/resep/racik/simpan', [ResepDokterRacikanController::class, 'simpan']);
    Route::delete('/resep/racik/hapus', [ResepDokterRacikanController::class, 'hapus']);
    Route::post('/resep/racik/detail/simpan', [ResepDokterRacikanController::class, 'simpanRacik']);

    Route::get('/resep/racik/detail/ambil', [ResepDokterRacikanDetailController::class, 'ambil']);
    Route::delete('/resep/racik/detail/hapus', [ResepDokterRacikanDetailController::class, 'hapus']);
});
Route::get('/aes/{input}/{string}', [LoginController::class, 'aes_encrypt']);
Route::get('/test/{no_rkm_medis}', [RegPeriksaController::class, 'riwayat']);
