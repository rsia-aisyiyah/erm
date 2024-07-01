<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\EstimasiPoli;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Database\QueryException;
use App\Http\Controllers\RegPeriksaController;

use function PHPUnit\Framework\isEmpty;

class EstimasiPoliController extends Controller
{


    private $tanggal;
    private $track;
    private $regPeriksa;
    public function __construct()
    {
        $this->track = new TrackerSqlController();
        $this->regPeriksa = new RegPeriksaController();
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
        $data = [
            'no_rawat' => $no_rawat,
            'jam_periksa' => $jam_periksa
        ];
        $estimasi = $this->cari($no_rawat);
        if (!isset($estimasi->no_rawat)) {
            $this->post(new \Illuminate\Http\Request($data));
        }
        $this->regPeriksa->statusDaftar($no_rawat, 'Berkas Diterima');
        return response()->json(['no_rawat' => $no_rawat, 'jam_periksa' => $data['jam_periksa']], 200);
    }
    public function hapus(Request $request)
    {
        $no_rawat = $request->no_rawat;
        $estimasi = EstimasiPoli::where('no_rawat', $no_rawat);
        if ($estimasi) {
            $this->delete($no_rawat);
            $this->regPeriksa->statusDaftar($no_rawat, 'Belum');
            $response = response()->json(['pesan' => 'Batal Panggil Pasien', 'no_rawat' => $no_rawat], 200);
        } else {
            $response = response()->json('Nomor Rawat Tidak Ditemukan', 400);
        }
        return $response;
    }

    function post(Request $request)
    {
        $data = [
            'no_rawat' => $request->no_rawat,
            'jam_periksa' => $request->jam_periksa,
        ];
        try {
            $estimasi = EstimasiPoli::create($data);
        } catch (QueryException $e) {
            return response()->json($e->errorInfo, 500);
        }
        $this->track->insertSql(new EstimasiPoli(), $data);
        return true;
    }

    function update(Request $request)
    {
        try {
            $estimasi = EstimasiPoli::where('no_rawat', $request->no_rawat)
                ->update(['jam_periksa' => $request->jam_periksa]);
        } catch (QueryException $e) {
            return response()->json($e->errorInfo, 500);
        }
        $this->track->updateSql(new EstimasiPoli(), ['jam_periksa' => $request->jam_periksa], ['no_rawat' => $request->no_rawat]);
        return true;
    }
    function delete($no_rawat)
    {
        try {
            $estimasi = EstimasiPoli::where('no_rawat', $no_rawat)->delete();
        } catch (QueryException $e) {
            return response()->json($e->errorInfo, 500);
        }

        $track = $this->track->deleteSql(new EstimasiPoli(), ['no_rawat' => $no_rawat]);
    }
}
