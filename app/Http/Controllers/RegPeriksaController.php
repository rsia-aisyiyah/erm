<?php

namespace App\Http\Controllers;

use App\Models\EstimasiPoli;
use App\Models\Pasien;
use App\Models\RegPeriksa;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RegPeriksaController extends Controller
{
    public $tanggal;
    public function __construct()
    {
        $this->tanggal = new Carbon();
    }
    public function show($no_rkm_medis)
    {
        $regPeriksa = RegPeriksa::where('no_rkm_medis', $no_rkm_medis)
            ->with('upload')
            ->orderBy('tgl_registrasi', 'DESC')
            ->get();
        return response()->json($regPeriksa);
    }
    public function detailPeriksa(Request $request)
    {
        $regPeriksa = RegPeriksa::where('no_rawat', $request->no_rawat)
            ->with('kamarInap', function ($q) {
                $q->where('stts_pulang', '!=', 'Pindah Kamar');
            })
            ->with('pasien')
            ->first();
        return response()->json($regPeriksa);
    }
    public function riwayat(Request $request)
    {
        $pemeriksaan = Pasien::where('no_rkm_medis', $request->no_rkm_medis)
            ->with('regPeriksa', function ($q) {
                return $q->where(function ($q) {
                    $q->where('stts', 'Sudah')->orWhere('status_lanjut', '=', 'Ranap');
                })->with(['upload', 'poliklinik', 'dokter', 'penjab', 'pemeriksaanRalan', 'diagnosaPasien' => function ($q) {
                    return $q->with('penyakit')->orderBy('prioritas', 'ASC');
                }, 'prosedurPasien' => function ($q) {
                    return $q->with('icd9');
                }, 'detailPemberianObat' => function ($q) {
                    return $q->with(['aturanPakai', 'dataBarang' => function ($q) {
                        $q->with('kodeSatuan');
                    }]);
                }, 'detailPemeriksaanLab' => function ($q) {
                    $q->with(['jnsPerawatanLab', 'template'])->orderBy('tgl_periksa', 'ASC');
                }, 'kamarInap'])->orderBy('tgl_registrasi', 'DESC');
            })
            ->first();

        return response()->json($pemeriksaan);
    }


    public function statusDaftar($no_rawat, $status)
    {
        $status = RegPeriksa::where('no_rawat', $no_rawat)->update([
            'stts' => $status
        ]);
    }

    public function statusDiterima(Request $request)
    {
        $regPeriksa = RegPeriksa::where('tgl_registrasi', $this->tanggal->now()->toDateString())
            ->where('kd_poli', $request->kd_poli)
            ->where('kd_dokter', $request->kd_dokter)
            ->where(function ($q) {
                $q->where('stts', 'Berkas Diterima')->orWhere('stts', 'Periksa');
            })->count();

        return $regPeriksa;
    }
    public function hitungSelesai(Request $request)
    {
        $regPeriksa = RegPeriksa::where('tgl_registrasi', $this->tanggal->now()->toDateString())
            ->where('kd_poli', $request->kd_poli)
            ->where('kd_dokter', $request->kd_dokter)
            ->where('stts', 'Sudah')->count();

        return $regPeriksa;
    }
    public function hitungBatal(Request $request)
    {
        $regPeriksa = RegPeriksa::where('tgl_registrasi', $this->tanggal->now()->toDateString())
            ->where('kd_poli', $request->kd_poli)
            ->where('kd_dokter', $request->kd_dokter)
            ->where('stts', 'Batal')->count();

        return $regPeriksa;
    }
    public function hitungTunggu(Request $request)
    {
        $regPeriksa = RegPeriksa::where('tgl_registrasi', $this->tanggal->now()->toDateString())
            ->where('kd_poli', $request->kd_poli)
            ->where('kd_dokter', $request->kd_dokter)
            ->where('stts', 'Belum')->count();

        return $regPeriksa;
    }
}
