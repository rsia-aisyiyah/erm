<?php

namespace App\Http\Controllers;

use App\Models\RsiaPenilaianPendaftaran;
use Illuminate\Http\Request;

class RsiaPenilaianPendaftaranController extends Controller
{
    public function simpan(Request $request)
    {
        $penilaian = RsiaPenilaianPendaftaran::create([
            'nik' => $request->nik,
            'nilai' => $request->nilai,
        ]);

        return response()->json($penilaian);
    }
}
