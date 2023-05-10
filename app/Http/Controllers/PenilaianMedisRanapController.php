<?php

namespace App\Http\Controllers;

use App\Models\PenilaianMedisRanap;
use Illuminate\Http\Request;

class PenilaianMedisRanapController extends Controller
{
    public function ambil(Request $request)
    {
        $penilaian = PenilaianMedisRanap::where('no_rawat', $request->no_rawat)->with(['dokter', 'regPeriksa.pasien'])->first();
        return response()->json($penilaian);
    }
}
