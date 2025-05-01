<?php

namespace App\Http\Controllers;

use App\Models\EstimasiPoli;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class EstimasiPoliController extends Controller
{
    // public $regPeriksa = app('App\Http\Controllers\RegPeriksaController')->status();
    private $tanggal;
    private $tracker;
    public function __construct()
    {
        $this->tanggal = new Carbon();
        $this->tracker = new TrackerSqlController();
    }
    public function cari($no_rawat)
    {
        $estimasi = EstimasiPoli::where('no_rawat', $no_rawat)->first();
        return $estimasi;
    }

    public function get(Request $request): bool
    {
        $no_rawat = $request->no_rawat;
        $estimasi = EstimasiPoli::where('no_rawat', $no_rawat)->first();

        if ($estimasi) {
            return true;
        }
        return false;
    }
    public function kirim(Request $request)
    {
        $no_rawat = $request->no_rawat;
        $jam_periksa = $this->tanggal->now()->toDateTimeString();

        $getEstimasi = $this->get($request);

        if (!$getEstimasi) {
            $data = [
                'no_rawat' => $no_rawat,
                'jam_periksa' => $jam_periksa,
            ];

            $estimasi = EstimasiPoli::create(
                $data
            );

            if ($estimasi) {
                $this->tracker->insertSql(new EstimasiPoli(), $data);
            }
        }
        app('App\Http\Controllers\RegPeriksaController')->statusDaftar($no_rawat, 'Berkas Diterima');
        return response()->json(['no_rawat' => $no_rawat, 'jam_periksa' => $jam_periksa], 200);
    }
    public function hapus(Request $request)
    {
        $no_rawat = $request->no_rawat;
        $estimasi = EstimasiPoli::where('no_rawat', $no_rawat);

        if ($estimasi) {
            $isDelete = $estimasi->delete();
            if ($isDelete) {
                $this->tracker->deleteSql(new EstimasiPoli(), ['no_rawat' => $no_rawat]);
            }

            app('App\Http\Controllers\RegPeriksaController')->statusDaftar($no_rawat, 'Belum');
            $response = response()->json(['pesan' => 'Batal Panggil Pasien', 'no_rawat' => $no_rawat], 200);
        } else {
            $response = response()->json('Nomor Rawat Tidak Ditemukan', 400);
        }

        return $response;
    }
}
