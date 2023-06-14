<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AntreanController extends Controller
{

    protected $resepObat;

    public function __construct() {
        $this->resepObat = new \App\Models\ResepObat;
    }

    function index() {
        return view('antrian');
    }

    function getAntrian() {
        $data = $this->resepObat
            ->with([ 'regPeriksa', 'regPeriksa.pasien', 'resepDokter', 'resepRacikan',])
            ->where('tgl_peresepan', date('Y-m-d'))
            ->get();

        // map data return only nm_pasien
        $data = $data->map(function($item) {
            return [
                'no_resep' => $item->no_resep,
                'no_rawat' => $item->no_rawat,
                'nm_pasien' => $item->regPeriksa->pasien->nm_pasien,
                'status_obat' => $this->getStatus($item),
                'category_obat' => $this->getCategory($item),

                'tgl_peresepan' => $item->tgl_peresepan,
                'jam_peresepan' => $item->jam_peresepan,
                "tgl_perawatan" => $item->tgl_perawatan,
                "jam_perawatan" => $item->jam,
                "tgl_penyerahan" => $item->tgl_penyerahan,
                "jam_penyerahan" => $item->jam_penyerahan,

                'resepDokter' => $item->resepDokter,
                'resepRacikan' => $item->resepRacikan,
            ];
        });


        return response()->json($data);
    }

    private function getCategory($data) {
        if ($data->resepRacikan && count($data->resepRacikan) > 0) {
            return 'racikan';
        } elseif($data->resepDokter && count($data->resepDokter) > 0) {
            return 'non racikan';
        } else {
            return 'umum';
        }
    }

    private function getStatus($data) {
        if ($data->tgl_perawatan == "000-00-00") {
            return "menunggu validasi";
        } elseif ($data->tgl_perawatan !== "0000-00-00" && $data->tgl_penyerahan == "0000-00-00") {
            return "disiapkan";
        } elseif ($data->tgl_perawatan != "0000-00-00" && $data->tgl_penyerahan != "0000-00-00") {
            return "selesai";
        } else {
            return "tidak diketahui";
        }
    }
}
