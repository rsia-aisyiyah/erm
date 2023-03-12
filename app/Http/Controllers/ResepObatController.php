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
    public function ambil()
    {
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
            'no_resep' => $request->data['no_resep'],
            'kd_dokter' => $request->data['kd_dokter'],
            'no_rawat' => $request->data['no_rawat'],
            'tgl_perawatan' => date('Y-m-d'),
            'jam' => date('H:i:s'),
            'tgl_peresepan' => date('Y-m-d'),
            'jam_peresepan' => date('H:i:s'),
            'status' => 'ralan',
            'tgl_penyerahan' => date('Y-m-d', strtotime("00:00:00")),
            'jam_penyerahan' => date('H:i:s', strtotime("00:00:00")),
        ]);

        return $resepObat;
    }
}
