<?php

namespace App\Http\Controllers;

use App\Models\DiagnosaPasien;
use Illuminate\Http\Request;

class DiagnosaPasienController extends Controller
{


    protected $diagnosa;
    public function __construct()
    {
        $this->diagnosa = new DiagnosaPasien();
    }
    public function tambah(Request $request)
    {
        $penyakit = $this->diagnosa->create([
            'no_rawat' => $request->no_rawat,
            'kd_penyakit' => $request->kd_penyakit,
            'status' => $request->status,
            'prioritas' => $request->prioritas,
        ]);

        return response()->json($penyakit);
    }

    public function ambil(Request $request)
    {
        $penyakit = $this->diagnosa->with('penyakit')->where('no_rawat', $request->no_rawat)->orderBy('prioritas', 'ASC')->get();

        return response()->json($penyakit);
    }
    public function hapus(Request $request)
    {
        $penyakit = $this->diagnosa->where('no_rawat', $request->no_rawat)
            ->where('kd_penyakit', $request->kd_penyakit)->delete();

        return response()->json($penyakit);
    }
}
