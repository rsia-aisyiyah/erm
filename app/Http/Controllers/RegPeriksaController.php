<?php

namespace App\Http\Controllers;

use App\Models\EstimasiPoli;
use App\Models\Pasien;
use App\Models\RegPeriksa;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RegPeriksaController extends Controller
{
    //
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
    public function pemeriksaanRalan($no_rkm_medis)
    {
        $pemeriksaan = Pasien::where('no_rkm_medis', $no_rkm_medis)
            ->with('regPeriksa', function ($q) {
                return $q->where(function ($q) {
                    $q->where('stts', 'Sudah')->orWhere('status_lanjut', '=', 'Ranap');
                })->with(['poliklinik', 'dokter', 'penjab', 'pemeriksaanRalan', 'diagnosaPasien' => function ($q) {
                    return $q->with('penyakit');
                }, 'detailPemberianObat' => function ($q) {
                    return $q->with(['aturanPakai', 'dataBarang' => function ($q) {
                        $q->with('kodeSatuan');
                    }]);
                }, 'detailPemeriksaanLab' => function ($q) {
                    $q->with(['jnsPerawatanLab', 'template'])->orderBy('tgl_periksa', 'ASC');
                }, 'kamarInap'])->orderBy('tgl_registrasi', 'DESC');
            })
            ->get();

        return response()->json($pemeriksaan);
    }
    public function estimasi($no_rawat)
    {
        $estimasi = EstimasiPoli::where('no_rawat', $no_rawat)->first();
        return $estimasi;
    }
    public function kirimEstimasi(Request $request)
    {
        $tanggal = new Carbon();
        $no_rawat = $request->no_rawat;
        $jam_periksa = $tanggal->now()->toDateTimeString();

        if ($this->estimasi($no_rawat)) {
            $estimasi = EstimasiPoli::where('no_rawat', $no_rawat)->update(['jam_periksa' => $jam_periksa]);
        } else {
            $estimasi = EstimasiPoli::create(
                [
                    'no_rawat' => $no_rawat,
                    'jam_periksa' => $jam_periksa,
                ]
            );
        }
        $this->statusDaftar($no_rawat, 'Berkas Diterima');
        return response()->json('Berhasil', 200);
    }

    public function statusDaftar($no_rawat, $status)
    {

        $status = RegPeriksa::where('no_rawat', $no_rawat)->update([
            'stts' => $status
        ]);
    }

    public function status()
    {
    }
}
