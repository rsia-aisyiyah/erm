<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    public function ambil(Request $request)
    {
        $dokter = Dokter::where('status', '1')->with('pegawai', 'spesialis');

        if ($request->sps) {
            $dokter->where('kd_sps', $request->sps);
        }
        if ($request->nik) {
            $dokter->where('kd_dokter', $request->nik);
        }

        $data = $dokter->get();
        return response()->json(['Message' => 'Berhasil', 'data' => $data], 200);
    }
}
