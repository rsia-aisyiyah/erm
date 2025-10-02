<?php

namespace App\Http\Controllers;

use App\Models\EstimasiPoli;
use App\Models\ResepObat;
use App\Traits\ResponseTrait;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class EstimasiPoliController extends Controller
{
    // public $regPeriksa = app('App\Http\Controllers\RegPeriksaController')->status();
    private $tanggal;
    private $tracker;
    use ResponseTrait;
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

    public function get(Request $request)
    {
        $no_rawat = $request->no_rawat;
        $estimasi = EstimasiPoli::where('no_rawat', $no_rawat)->first();
        return $estimasi;
    }
    public function kirim(Request $request)
    {
        $no_rawat = $request->no_rawat;
        $jam_periksa = $this->tanggal->now()->toDateTimeString();
        $getEstimasi = $this->get($request);

        $data = [
            'no_rawat' => $no_rawat,
            'jam_periksa' => $jam_periksa,
        ];

        if ($getEstimasi) {
            return response()->json(['no_rawat' => $no_rawat, 'jam_periksa' => $getEstimasi->jam_periksa], 200);
        }

        try {
            DB::transaction(function () use ($data, $no_rawat) {
                $estimasi = EstimasiPoli::create($data);
                if ($estimasi) {
                    $this->tracker->insertSql(new EstimasiPoli(), $data);
                }
                $regPeriksa = new RegPeriksaController();
                $regPeriksa->statusDaftar($no_rawat, 'Berkas Diterima');

            });

        } catch (QueryException $th) {
            return $this->errorResponse($th, $th->getMessage(), 500);
        }
        return response()->json(['no_rawat' => $no_rawat, 'jam_periksa' => $jam_periksa], 200);

    }
    public function hapus(Request $request)
    {
        $no_rawat = $request->no_rawat;
        $estimasi = EstimasiPoli::where('no_rawat', $no_rawat);


        $resep = new ResepObat();

        // TODO: check apakah kosong
        $isResepExist = $resep->where('no_rawat', $no_rawat)->first();

        if ($isResepExist) {
            return response()->json('Resep Obat Masih Ada', 400);
        }


        if ($isResepExist) {
            return response()->json('Resep Obat Masih Ada', 400);
        }

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
