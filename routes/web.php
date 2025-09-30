<?php

use App\Models\Pasien;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EwsController;
use App\Http\Controllers\LabController;
use App\Http\Controllers\UgdController;
use App\Http\Controllers\Icd9Controller;
use App\Http\Controllers\SbarController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RanapController;
use App\Models\AsesmenMedisIgdController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PenjabController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\AntreanController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\AskepUgdController;
use App\Http\Controllers\PenyakitController;
use App\Http\Controllers\KamarInapController;
use App\Http\Controllers\ResepObatController;
use App\Http\Controllers\SkoringTbController;
use App\Http\Controllers\CacatFisikController;
use App\Http\Controllers\DataBarangController;
use App\Http\Controllers\PlanOfCareController;
use App\Http\Controllers\PoliklinikController;
use App\Http\Controllers\RegPeriksaController;
use App\Http\Controllers\SkriningTbController;
use App\Http\Controllers\SukuBangsaController;
use App\Http\Controllers\TriasePemeriksaanUgd;
use App\Http\Controllers\BridgingSepController;
use App\Http\Controllers\EwsMaternalController;
use App\Http\Controllers\RanapGabungController;
use App\Http\Controllers\ResepDokterController;
use App\Http\Controllers\ResepPulangController;
use App\Http\Controllers\SelesaiPoliController;
use App\Http\Controllers\BahasaPasienController;
use App\Http\Controllers\Bridging\SepController;
use App\Http\Controllers\BridgingSPRIController;
use App\Http\Controllers\EstimasiPoliController;
use App\Http\Controllers\PermintaanLabController;
use App\Http\Controllers\PlanOfCareTimController;
use App\Http\Controllers\RsiaKetPasienController;
use App\Http\Controllers\AskepRalanAnakController;
use App\Http\Controllers\AskepRanapAnakController;
use App\Http\Controllers\Bridging\IcareController;
use App\Http\Controllers\DiagnosaPasienController;
use App\Http\Controllers\HasilRadiologiController;
use App\Http\Controllers\LaporanOperasiController;
use App\Http\Controllers\ProsedurPasienController;
use App\Http\Controllers\JnsPerawatabLabController;
use App\Http\Controllers\MappingPoliBpjsController;
use App\Http\Controllers\MasterImunisasiController;
use App\Http\Controllers\RsiaHasilKritisController;
use App\Http\Controllers\AsesmenMedisAnakController;
use App\Http\Controllers\AsesmenNyeriAnakController;
use App\Http\Controllers\Bridging\PesertaController;
use App\Http\Controllers\Bridging\RujukanController;
use App\Http\Controllers\CatatanPerawatanController;
use App\Http\Controllers\PemeriksaanRalanController;
use App\Http\Controllers\PemeriksaanRanapController;
use App\Http\Controllers\PeriksaRadiologiController;
use App\Http\Controllers\RiwayatImunisasiController;
use App\Http\Controllers\RsiaGrafikHarianController;
use App\Http\Controllers\BookingRegistrasiController;
use App\Http\Controllers\DischargePlanningController;
use App\Http\Controllers\MasalahAskepRanapController;
use App\Http\Controllers\RencanaAskepRanapController;
use App\Http\Controllers\ResumePasienRanapController;
use App\Http\Controllers\RiwayatPersalinanController;
use App\Http\Controllers\SuratKontrolUlangController;
use App\Http\Controllers\AsesmenNyeriBalitaController;
use App\Http\Controllers\AsesmenNyeriBatitaController;
use App\Http\Controllers\AsesmenNyeriDewasaController;
use App\Http\Controllers\AskepRanapNeonatusController;
use App\Http\Controllers\Bridging\ReferensiController;
use App\Http\Controllers\ResepDokterRacikanController;
use App\Http\Controllers\RsiaAsuhanGiziAnakController;
use App\Http\Controllers\RsiaGeneralConsentController;
use App\Http\Controllers\RsiaMappingRacikanController;
use App\Http\Controllers\AskepRalanKebidananController;
use App\Http\Controllers\AskepRanapKandunganController;
use App\Http\Controllers\BridgingRujukanBpjsController;
use App\Http\Controllers\DetailPemberianObatController;
use App\Http\Controllers\DetailPermintaanLabController;
use App\Http\Controllers\PenilaianMedisRanapController;
use App\Http\Controllers\PermintaanRadiologiController;
use App\Http\Controllers\AsesmenNyeriNeonatusController;
use App\Http\Controllers\DetailPemeriksaanLabController;
use App\Http\Controllers\RsiaAsuhanGiziDewasaController;
use App\Http\Controllers\TemplateLaboratoriumController;
use App\Http\Controllers\AsesmenMedisRajalAnakController;
use App\Http\Controllers\Apotek\ApotekReferensiController;
use App\Http\Controllers\MonitoringCairanPasienController;
use App\Http\Controllers\Bridging\RencanaKontrolController;
use App\Http\Controllers\BrigdgingRencanaKontrolController;
use App\Http\Controllers\JenisPerawatanRadiologiController;
use App\Http\Controllers\PenilaianMedisKebidananController;
use App\Http\Controllers\MasterMasalahKeperawatanController;
use App\Http\Controllers\MasterRencanaKeperawatanController;
use App\Http\Controllers\PermintaanPemeriksaanLabController;
use App\Http\Controllers\ResepDokterRacikanDetailController;
use App\Http\Controllers\RsiaMappingRacikanDetailController;
use App\Http\Controllers\RsiaPenilaianPendaftaranController;
use App\Http\Controllers\RsiaVerifPemeriksaanRanapController;
use App\Http\Controllers\AsesmenMedisRajalKandunganController;
use App\Http\Controllers\AsesmenMedisRanapKandunganController;
use App\Http\Controllers\KomunikasiEdukasiObatPulangController;
use App\Http\Controllers\PermintaanPemeriksaanRadiologiController;
use App\Models\ResepObat;

Route::get('/antrian', [AntreanController::class, 'index']);
Route::get('/get/antrian', [AntreanController::class, 'getAntrian']);

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
    Route::get('/periksa/show/{no_rkm_medis}/{tanggal?}', [
        RegPeriksaController::class,
        'show',
    ]);
    Route::get('periksa/detail', [RegPeriksaController::class, 'detailPeriksa']);
    Route::get('/upload', [UploadController::class, 'index']);
    Route::get('/upload/show', [UploadController::class, 'showUpload']);
    Route::delete('/upload/delete/{id}', [UploadController::class, 'delete']);
    Route::post('/upload', [UploadController::class, 'upload']);
    Route::get('/upload/status', [PoliklinikController::class, 'statusUpload']);

    Route::get('/petugas/cari', [PetugasController::class, 'cari']);





    Route::post('/booking/buat', [BookingRegistrasiController::class, 'create']);

    Route::get('/ugd', [UgdController::class, 'index']);
    Route::get('/ugd/get/table', [UgdController::class, 'getTable']);
    Route::get('/ugd/soap/table', [PemeriksaanRalanController::class, 'getTable']);
    Route::get('/ugd/asesmen/keperawatan', [AskepUgdController::class, 'get']);
    Route::post('/ugd/asesmen/medis/simpan', [AsesmenMedisIgdController::class, 'create']);
    Route::post('/ugd/asesmen/medis/ubah', [AsesmenMedisIgdController::class, 'edit']);
    Route::get('/ugd/asesmen/medis/{noRawat}', [AsesmenMedisIgdController::class, 'get']);

    // triase UGD
    Route::get('/triase/get/indikator', [TriasePemeriksaanUgd::class, 'getIndikator']);
    route::post('/triase/simpan', [TriasePemeriksaanUgd::class, 'simpan']);
    route::get('/triase/get', [TriasePemeriksaanUgd::class, 'get']);

    Route::get('persetujuan/loket/{loket}', [RsiaGeneralConsentController::class, 'index']);
    Route::post('persetujuan/tambah', [RsiaGeneralConsentController::class, 'tambah']);
    Route::get('persetujuan/ambil', [RsiaGeneralConsentController::class, 'ambil']);
    Route::post('persetujuan/ttd', [RsiaGeneralConsentController::class, 'simpanTtd']);
    Route::delete('persetujuan/hapus', [RsiaGeneralConsentController::class, 'delete']);

    Route::get('/pemeriksaan', [PemeriksaanRalanController::class, 'ambil']);
    Route::get('/pemeriksaan/get', [PemeriksaanRalanController::class, 'get']);
    Route::post('/pemeriksaan/simpan', [PemeriksaanRalanController::class, 'simpan']);
    Route::post('/pemeriksaan/edit', [PemeriksaanRalanController::class, 'edit']);
    Route::delete('/pemeriksaan/delete', [PemeriksaanRalanController::class, 'delete']);

    Route::get('/soap/get', [PemeriksaanRanapController::class, 'ambilPemeriksaan']);
    Route::get('/soap/get/table', [PemeriksaanRanapController::class, 'getDataTable']);
    Route::get('/soap', [PemeriksaanRanapController::class, 'ambil']);
    Route::get('/soap/ambil', [PemeriksaanRanapController::class, 'ambilSatu']);
    Route::post('/soap/ubah', [PemeriksaanRanapController::class, 'ubah']);
    Route::post('/soap/simpan', [PemeriksaanRanapController::class, 'simpan']);
    Route::delete('/soap/hapus', [PemeriksaanRanapController::class, 'hapus']);
    Route::post('/soap/verifikasi', [RsiaVerifPemeriksaanRanapController::class, 'create']);

    Route::post('/ranap/sbar/update', [SbarController::class, 'update']);
    Route::post('/ranap/sbar/delete', [SbarController::class, 'delete']);

    Route::get('/soap/chart', [PemeriksaanRanapController::class, 'getTTV']);
    Route::get('/soap/grafik/data', [PemeriksaanRanapController::class, 'getTTVData']);
    Route::post('/soap/grafik/store', [RsiaGrafikHarianController::class, 'store']);
    Route::delete('/soap/grafik/delete', [RsiaGrafikHarianController::class, 'delete']);

    Route::get('/aturan', [DetailPemberianObatController::class, 'aturanPakai']);
    Route::get('/obat/pemberian', [DetailPemberianObatController::class, 'get']);
    Route::get('/obat/pemberian/table', [DetailPemberianObatController::class, 'getDataTable']);


    Route::get('ranap', [RanapController::class, 'index']);
    Route::get('ranap/pasien', [RanapController::class, 'ranap']);
    Route::get('ranap/pasien/get', [KamarInapController::class, 'get']);
    Route::get('ranap/askep/anak', [AskepRanapAnakController::class, 'get']);
    Route::post('ranap/askep/anak/insert', [AskepRanapAnakController::class, 'insert']);
    Route::post('ranap/askep/anak/create', [AskepRanapAnakController::class, 'createOrUpdate']);
    Route::get('ranap/askep/anak/masalah', [MasalahAskepRanapController::class, 'get']);
    Route::get('ranap/askep/anak/rencana', [RencanaAskepRanapController::class, 'get']);
    Route::post('ranap/askep/anak/masalah/insert', [MasalahAskepRanapController::class, 'insert']);
    Route::post('ranap/askep/anak/masalah/delete', [MasalahAskepRanapController::class, 'delete']);
    Route::post('ranap/askep/anak/rencana/insert', [RencanaAskepRanapController::class, 'insert']);
    Route::post('ranap/askep/anak/rencana/delete', [RencanaAskepRanapController::class, 'delete']);

    Route::get('ranap/gabung/bayi', [RanapGabungController::class, 'get']);

    Route::get('ranap/askep/neonatus', [AskepRanapNeonatusController::class, 'get']);
    Route::post('ranap/askep/neonatus/create', [AskepRanapNeonatusController::class, 'createOrUpdate']);

    //    Route::post('ranap/gizi/asuhan/dewasa', [RsiaAsuhanGiziDewasaController::class, 'create']);
//    Route::get('ranap/gizi/asuhan/dewasa', [RsiaAsuhanGiziDewasaController::class, 'get']);

    Route::prefix('ranap')->group(function ($route) {
        $route->prefix('gizi')->group(function ($route) {
            $route->get('asuhan/dewasa', [RsiaAsuhanGiziDewasaController::class, 'get']);
            $route->post('asuhan/dewasa', [RsiaAsuhanGiziDewasaController::class, 'create']);
            $route->get('asuhan/dewasa/print', [RsiaAsuhanGiziDewasaController::class, 'print']);

            $route->get('asuhan/anak', [RsiaAsuhanGiziAnakController::class, 'get']);
            $route->post('asuhan/anak', [RsiaAsuhanGiziAnakController::class, 'create']);
            $route->get('asuhan/anak/print', [RsiaAsuhanGiziAnakController::class, 'print']);
        });
    });

    Route::get('master/masalah/keperawatan/table', [MasterMasalahKeperawatanController::class, 'getDataTable']);
    Route::get('master/rencana/keperawatan/table', [MasterRencanaKeperawatanController::class, 'getDataTable']);

    Route::get('ranap/askep/kandungan', [AskepRanapKandunganController::class, 'get']);
    Route::post('ranap/askep/kandungan/create', [AskepRanapKandunganController::class, 'createOrUpdate']);

    Route::get('ews/{sttsRawat}/{noRawat}', [EwsController::class, 'get']);
    Route::get('ews/maternal/{sttsRawat}/{noRawat}', [EwsMaternalController::class, 'get']);

    Route::get('dokter/ambil', [DokterController::class, 'ambil']);
    Route::get('dokter/cari', [DokterController::class, 'cari']);

    Route::get('asmed/kebidanan', [PenilaianMedisKebidananController::class, 'index']);
    Route::get('asmed/ranap/anak/print', [AsesmenMedisAnakController::class, 'print']);
    Route::get('asmed/ranap/anak/{noRawat}', [AsesmenMedisAnakController::class, 'get']);
    Route::get('asmed/ranap/anak/rm/{no_rkm_medis}', [AsesmenMedisAnakController::class, 'getByNoRm']);
    Route::post('asmed/ranap/anak/simpan', [AsesmenMedisAnakController::class, 'create']);
    Route::post('asmed/ranap/anak/ubah', [AsesmenMedisAnakController::class, 'update']);

    Route::get('asmed/ranap/kandungan/{noRawat}', [AsesmenMedisRanapKandunganController::class, 'get']);
    Route::get('asmed/ranap/kandungan/rm/{no_rkm_medis}', [AsesmenMedisRanapKandunganController::class, 'getByNoRm']);
    Route::post('asmed/ranap/kandungan/simpan', [AsesmenMedisRanapKandunganController::class, 'create']);
    Route::post('asmed/ranap/kandungan/ubah', [AsesmenMedisRanapKandunganController::class, 'update']);

    Route::get('obat/', [DataBarangController::class, 'index']);
    Route::get('obat/get/{kode_brng}', [DataBarangController::class, 'get']);
    Route::get('obat/cari', [DataBarangController::class, 'cari']);

    Route::get('/resep', [ResepObatController::class, 'index']);
    Route::post('/resep/create', [ResepObatController::class, 'create']);
    Route::delete('/resep/delete/{noResep}', [ResepObatController::class, 'delete']);
    Route::get('/resep/ambil/tabel', [ResepObatController::class, 'ambilTable']);
    Route::get('/resep/get/rawat/{no_rawat}', [ResepObatController::class, 'getByNoRawat']);
    Route::get('/resep/ambil/sekarang', [ResepObatController::class, 'ambilSekarang']);
    Route::get('/resep/riwayat/{no_rkm_medis}', [ResepObatController::class, 'getByNoRm']);
    Route::get('/resep/get/nomor/akhir', [ResepObatController::class, 'getLast']);
    Route::post('/resep/copy/{noResep}', [ResepObatController::class, 'copyResep']);

    Route::get('/resep/obat/akhir', [ResepObatController::class, 'akhir']);
    Route::get('/resep/obat/ambil', [ResepObatController::class, 'ambil']);
    Route::get('/resep/obat/ubah', [ResepObatController::class, 'ubah']);
    Route::get('/resep/obat/panggil', [ResepObatController::class, 'panggil']);
    Route::post('/resep/obat/simpan', [ResepObatController::class, 'simpan']);
    Route::delete('/resep/obat/hapus/{noResep}', [ResepObatController::class, 'hapus']);

    Route::post('/resep/umum/simpan', [ResepDokterController::class, 'simpan']);
    Route::get('/resep/umum/get/{no_resep?}', [ResepDokterController::class, 'get']);
    Route::post('/resep/umum/ubah', [ResepDokterController::class, 'ubah']);
    Route::delete('/resep/umum/hapus', [ResepDokterController::class, 'hapus']);
    Route::get('/aturan/cari', [ResepDokterController::class, 'cari']);
    Route::get('/resep/cari', [ResepDokterController::class, 'cari']);

    Route::get('/resep/racik/ambil', [ResepDokterRacikanController::class, 'ambil']);
    Route::post('/resep/racik/simpan', [ResepDokterRacikanController::class, 'simpan']);
    Route::post('/resep/racik/ubah', [ResepDokterRacikanController::class, 'ubah']);
    Route::delete('/resep/racik/hapus', [ResepDokterRacikanController::class, 'hapus']);

    Route::get('/resep/racik/detail/ambil', [ResepDokterRacikanDetailController::class, 'ambil']);
    Route::delete('/resep/racik/detail/hapus', [ResepDokterRacikanDetailController::class, 'hapus']);
    Route::post('/resep/racik/detail/simpan', [ResepDokterRacikanDetailController::class, 'simpan']);
    Route::post('/resep/racik/detail/ubah', [ResepDokterRacikanDetailController::class, 'ubah']);

    Route::get('/resep/racik/cari', [RsiaMappingRacikanController::class, 'cari']);
    Route::get('/resep/racik/template/ambil', [RsiaMappingRacikanController::class, 'ambil']);
    Route::delete('/resep/racik/template/hapus', [RsiaMappingRacikanController::class, 'hapus']);
    Route::get('/resep/racik', [RsiaMappingRacikanController::class, 'index']);
    Route::post('/resep/racik/template/tambah', [RsiaMappingRacikanController::class, 'tambah']);
    Route::post('/resep/racik/template/detail/tambah', [RsiaMappingRacikanDetailController::class, 'tambah']);
    Route::delete('/resep/racik/template/detail/hapus', [RsiaMappingRacikanDetailController::class, 'hapus']);

    Route::get('/pegawai/ambil', [PegawaiController::class, 'ambil']);

    Route::post('/penilaian/pendaftaran/simpan', [RsiaPenilaianPendaftaranController::class, 'simpan']);
    Route::get('/penilaian/medis/ranap/ambil', [PenilaianMedisRanapController::class, 'ambil']);

    Route::get('/penyakit/cari', [PenyakitController::class, 'cari']);
    Route::post('/penyakit/pasien/tambah', [DiagnosaPasienController::class, 'tambah']);
    Route::get('/penyakit/pasien/ambil', [DiagnosaPasienController::class, 'ambil']);
    Route::delete('/penyakit/pasien/hapus', [DiagnosaPasienController::class, 'hapus']);

    Route::get('/prosedur/cari', [Icd9Controller::class, 'cari']);
    Route::get('/prosedur/pasien/ambil', [ProsedurPasienController::class, 'ambil']);
    Route::post('/prosedur/pasien/tambah', [ProsedurPasienController::class, 'tambah']);
    Route::delete('/prosedur/pasien/hapus', [ProsedurPasienController::class, 'hapus']);

    Route::get('/operasi/laporan/detail', [LaporanOperasiController::class, 'show']);
    Route::get('/operasi/laporan/{noRawat}', [LaporanOperasiController::class, 'get']);

    Route::get('imunisasi/master', [MasterImunisasiController::class, 'get']);
    Route::post('imunisasi/riwayat/insert', [RiwayatImunisasiController::class, 'insert']);
    Route::delete('imunisasi/riwayat/delete', [RiwayatImunisasiController::class, 'delete']);
    Route::get('imunisasi/riwayat/get/{no_rkm_medis}', [RiwayatImunisasiController::class, 'get']);

    Route::get('riwayat/persalinan/get/{no_rkm_medis}', [RiwayatPersalinanController::class, 'get']);
    Route::delete('riwayat/persalinan/delete', [RiwayatPersalinanController::class, 'delete']);
    Route::post('riwayat/persalinan/insert', [RiwayatPersalinanController::class, 'insert']);

    Route::get('radiologi', [PeriksaRadiologiController::class, 'view']);
    Route::get('radiologi/table', [PermintaanRadiologiController::class, 'getTableIndex']);
    Route::get('radiologi/permintaan', [PermintaanRadiologiController::class, 'getByNoRawat']);
    Route::post('radiologi/permintaan', [PermintaanRadiologiController::class, 'create']);
    Route::get('radiologi/permintaan/nomor', [PermintaanRadiologiController::class, 'getNomor']);
    Route::get('radiologi/periksa', [PeriksaRadiologiController::class, 'getByNoRawat']);
    Route::post('radiologi/periksa/update', [PeriksaRadiologiController::class, 'update']);
    Route::get('radiologi/periksa/print', [PeriksaRadiologiController::class, 'print']);
    Route::post('radiologi/hasil/update', [HasilRadiologiController::class, 'update']);
    Route::post('radiologi/hasil/create', [HasilRadiologiController::class, 'create']);
    Route::get('radiologi/hasil', [HasilRadiologiController::class, 'get']);

    Route::get('radiologi/jenis/get', [JenisPerawatanRadiologiController::class, 'get']);
    Route::post('radiologi/permintaan/periksa', [PermintaanPemeriksaanRadiologiController::class, 'create']);

    Route::get('poc', [PlanOfCareController::class, 'get']);
    Route::post('poc/create', [PlanOfCareController::class, 'create']);
    Route::post('poc/tim/create', [PlanOfCareTimController::class, 'create']);
    Route::post('poc/tim/personil/delete/{id}', [PlanOfCareTimController::class, 'delete']);

    // Route::get('/hasil/kritis', [RsiaHasilKritisController::class, 'get']);
    Route::get('/hasil/kritis', [RsiaHasilKritisController::class, 'getHasil']);
    Route::get('/hasil/kritis/{id}', [RsiaHasilKritisController::class, 'get']);
    Route::post('/hasil/kritis', [RsiaHasilKritisController::class, 'create']);
    Route::post('/hasil/kritis/delete/{id}', [RsiaHasilKritisController::class, 'delete']);

    Route::get('skoring/tb', [SkoringTbController::class, 'get']);
    Route::post('skoring/tb', [SkoringTbController::class, 'create']);
    Route::post('skoring/tb/delete', [SkoringTbController::class, 'delete']);
    Route::get('skoring/tb/print/{id}', [SkoringTbController::class, 'print']);

    Route::get('skrining/tb', [SkriningTbController::class, 'get']);
    Route::post('skrining/tb', [SkriningTbController::class, 'create']);
    Route::post('skrining/tb/delete', [SkriningTbController::class, 'delete']);
    Route::get('skrining/tb/print/{id}', [SkriningTbController::class, 'print']);



    Route::get('spri/get/{nokartu}/{tanggal}', [BridgingSPRIController::class, 'get']);
    Route::post('spri/insert', [BridgingSPRIController::class, 'create']);
    Route::get('spri/print/{noSurat}', [BridgingSPRIController::class, 'print']);
    Route::post('rencanaKontrol/insert', [BrigdgingRencanaKontrolController::class, 'create']);
    Route::get('rencanaKontrol/print/{noSurat}', [BrigdgingRencanaKontrolController::class, 'print']);
    Route::post('rujukan/insert', [BridgingRujukanBpjsController::class, 'create']);
    Route::get('rujukan/print/{noRujukan}', [BridgingRujukanBpjsController::class, 'print']);
    Route::post('kontrol/umum/baru', [SuratKontrolUlangController::class, 'create']);

    Route::get('poliklinik/bpjs/{kdPoli}', [MappingPoliBpjsController::class, 'ambil']);
    Route::get('catatan/perawatan', [CatatanPerawatanController::class, 'getCatatan']);
    Route::get('catatan/perawatan/{noRawat}', [CatatanPerawatanController::class, 'get']);
    Route::post('catatan/perawatan/insert', [CatatanPerawatanController::class, 'insert']);
    Route::post('catatan/perawatan/create', [CatatanPerawatanController::class, 'insertOrUpdate']);

    Route::get('resume/ranap/get', [ResumePasienRanapController::class, 'get']);
    Route::post('resume/ranap/insert', [ResumePasienRanapController::class, 'insert']);
    Route::post('resume/ranap/edit', [ResumePasienRanapController::class, 'edit']);

    Route::get('catatan/pelaksanaan/edukasi/pasien', [\App\Http\Controllers\CatatanPelaksanaanEdukasiPasienController::class, 'get']);
    Route::post('catatan/pelaksanaan/edukasi/pasien', [\App\Http\Controllers\CatatanPelaksanaanEdukasiPasienController::class, 'create']);
    Route::post('catatan/pelaksanaan/edukasi/pasien/delete', [\App\Http\Controllers\CatatanPelaksanaanEdukasiPasienController::class, 'delete']);

    Route::post('monitoring/cairan/pasien', [MonitoringCairanPasienController::class, 'create']);
    Route::get('monitoring/cairan/pasien', [MonitoringCairanPasienController::class, 'get']);
    Route::post('monitoring/cairan/pasien/delete', [MonitoringCairanPasienController::class, 'delete']);

    Route::get('edukasi-obat-pulang', [KomunikasiEdukasiObatPulangController::class, 'get']);
    Route::post('edukasi-obat-pulang', [KomunikasiEdukasiObatPulangController::class, 'create']);
    Route::post('edukasi-obat-pulang/delete', [KomunikasiEdukasiObatPulangController::class, 'delete']);
    Route::get('resep-pulang', [ResepPulangController::class, 'get']);

    Route::post('discharge-planning', [DischargePlanningController::class, 'create']);
    Route::get('discharge-planning', [DischargePlanningController::class, 'get']);

    Route::get('sep', [BridgingSepController::class, 'index'])->name('sep.index');
    Route::get('sep/datatable', [BridgingSepController::class, 'dataTable'])->name('sep.datatable');
    Route::get('sep/{no_sep}', [BridgingSepController::class, 'ambilSep']);
});
Route::get('header  ', [RencanaKontrolController::class, 'testConfig']);

Route::get('/aes/{input}/{string}', [LoginController::class, 'aes_encrypt']);
Route::get('/nosurat/{poli}', [SuratKontrolUlangController::class, 'setNoSurat']);
Route::get('/noreg/{tanggal}/{poli}/{dokter}', [BookingRegistrasiController::class, 'setNoReg']);
Route::get('/norawat/{tanggal}', [RegPeriksaController::class, 'setNoRawat']);

Route::get('/test/view', function () {
    return view('test');
});
Route::get('/test/{kd_poli?}/{kd_dokter?}/{tgl_registrasi?}', [PoliklinikController::class, 'poliPasien']);
Route::get('/sbar', [SbarController::class, 'dataTable']);


require __DIR__.'/partials/asesmen_nyeri.php';
require __DIR__.'/partials/pasien.php';
require __DIR__.'/partials/bridging_bpjs.php';
require __DIR__.'/partials/registrasi.php';
require __DIR__.'/partials/poliklinik.php';
require __DIR__.'/partials/lab.php';
require __DIR__.'/partials/resiko_jatuh.php';
require __DIR__.'/partials/databarang.php';
require __DIR__.'/partials/logs.php';
// Route::get('/file', function () {
// $file = Storage::disk('custom')->url('LOGO RSIA (2).png');
// dd($file);
// dd($file);ln -s
// return $file->put('muchron.tlnxt', 'SKSKSKSKSKSKSKSK');
// return $gbr = $file->download('DSCF0002.JPG');
// // echo $gbr;
// return $g = $file->download('DSCF0002.JPG');
// return $html = "<br/><img src='" . $file . "' />";
// dd($file);
// });

// Route::get('/print', [PeriksaRadiologiController::class, 'print']);
Route::get('/test-resep/{no_resep}', [ResepObatController::class, 'copyResep']);