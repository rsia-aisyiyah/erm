<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\EstimasiPoli;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class EstimasiPoliController extends Controller
{
    // public $regPeriksa = app('App\Http\Controllers\RegPeriksaController')->status();
    private $tanggal;
    public function __construct()
    {
        $this->tanggal = new Carbon();
    }
    public function cari($no_rawat)
    {
        $estimasi = EstimasiPoli::where('no_rawat', $no_rawat)->first();
        return $estimasi;
    }

    function get(Request $request): JsonResponse
    {
        $no_rawat = $request->no_rawat;
        $estimasi = EstimasiPoli::where('no_rawat', $no_rawat)->first();

        return response()->json($estimasi);
    }
    public function kirim(Request $request)
    {
        $no_rawat = $request->no_rawat;
        $jam_periksa = $this->tanggal->now()->toDateTimeString();

        $getEstimasi = $this->cari($no_rawat);

        if (!isset($getEstimasi)) {
            $estimasi = EstimasiPoli::create(
                [
                    'no_rawat' => $no_rawat,
                    'jam_periksa' => $jam_periksa,
                ]
            );
        }
        app('App\Http\Controllers\RegPeriksaController')->statusDaftar($no_rawat, 'Berkas Diterima');
        return response()->json(['no_rawat' => $no_rawat, 'jam_periksa' => $jam_periksa], 200);
    }
    public function hapus(Request $request)
    {
        $no_rawat = $request->no_rawat;
        $estimasi = EstimasiPoli::where('no_rawat', $no_rawat);

        if ($estimasi) {
            $estimasi->delete();
            app('App\Http\Controllers\RegPeriksaController')->statusDaftar($no_rawat, 'Belum');
            $response = response()->json(['pesan' => 'Batal Panggil Pasien', 'no_rawat' => $no_rawat], 200);
        } else {
            $response = response()->json('Nomor Rawat Tidak Ditemukan', 400);
        }

        return $response;
    }
}
