<?php

namespace App\Http\Controllers;

use App\Models\AskepRalanAnak;
use Illuminate\Http\Request;

class AskepRalanAnakController extends Controller
{
    public function ambil(Request $request)
    {
        if ($request->no_rkm_medis) {
            $askep = AskepRalanAnak::whereHas('regPeriksa', function ($q) use ($request) {
                $q->where('no_rkm_medis', $request->no_rkm_medis);
            })->with('regPeriksa.pasien.riwayatImunisasi.masterImunisasi', 'pegawai')->get();
        }

        if ($request->no_rawat) {
            $askep = AskepRalanAnak::where('no_rawat', $request->no_rawat)->with('regPeriksa.pasien.riwayatImunisasi.masterImunisasi', 'pegawai')->get();
        }

        return response()->json($askep);
    }
    public function ambilDetail(Request $request)
    {
        if ($request->no_rawat) {
            $askep = AskepRalanAnak::where('no_rawat', $request->no_rawat)->with('regPeriksa.pasien.riwayatImunisasi.masterImunisasi', 'pegawai')->first();
        }
        return response()->json($askep);
    }
}
