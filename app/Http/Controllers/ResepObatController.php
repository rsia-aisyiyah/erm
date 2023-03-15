<?php

namespace App\Http\Controllers;

use App\Models\ResepObat;
use Illuminate\Http\Request;

class ResepObatController extends Controller
{
    private $resepObat;
    public function __construct()
    {
        $this->resepObat = new ResepObat();
    }

    public function hapus(Request $request)
    {
        $resepObat = $this->resepObat;
        $result = $resepObat->where('no_rawat', $request->no_rawat)->where('no_resep', $request->no_resep)->delete();
        return response()->json($result);
    }
    public function ambil(Request $request)
    {
        $resepObat = $this->resepObat;

        if ($request->no_rawat) {
            $result = $resepObat->where('no_rawat', $request->no_rawat)->with(['resepDokter.dataBarang', 'resepRacikan.metode', 'resepRacikan.detailRacikan.databarang'])->get();
        }
        if ($request->no_resep) {
            $result = $resepObat->where('no_resep', $request->no_resep)->with('resepDokter.dataBarang', 'resepRacikan.metode', 'resepRacikan.detailRacikan.databarang')->get();
        }

        return response()->json($result);
    }
    public function akhir(Request $request)
    {
        $resepObat = $this->resepObat;

        if ($request->tgl_peresepan) {
            $result = $resepObat->where('tgl_peresepan', $request->tgl_peresepan)->orderBy('no_resep', 'DESC')->first();
        }

        return response()->json($result);
    }
    public function simpan(Request $request)
    {
        $resepObat = $this->resepObat->create([
            'no_resep' => $request->no_resep,
            'kd_dokter' => $request->kd_dokter,
            'no_rawat' => $request->no_rawat,
            // 'tgl_perawatan' => date_format(date_create('00/00/0000'), 'Y-m-d'),
            'tgl_perawatan' =>  '0000-00-00',
            'jam' => date('H:i:s', strtotime("00:00:00")),
            'tgl_peresepan' => date('Y-m-d'),
            'jam_peresepan' => date('H:i:s'),
            'status' => 'ralan',
            'tgl_penyerahan' =>  '0000-00-00',
            // 'tgl_penyerahan' => date_format(date_create('00/00/0000'), 'Y-m-d'),
            'jam_penyerahan' => date('H:i:s', strtotime("00:00:00")),
        ]);

        return $resepObat;
    }
}
