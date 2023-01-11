<?php

namespace App\Http\Controllers;

use App\Models\RegPeriksa;
use Illuminate\Http\Request;
use App\Models\PemeriksaanRalan;

class PemeriksaanRalanController extends Controller
{
    public function ambil(Request $request)
    {
        $pemeriksaan = PemeriksaanRalan::where('no_rawat', $request->no_rawat)
            ->with('regPeriksa', function ($q) {
                $q->with('pasien');
            })->first();

        if ($pemeriksaan) {
            return response()->json($pemeriksaan, 200);
        } else {
            $regPeriksa = RegPeriksa::where('no_rawat', $request->no_rawat)
                ->with('pasien')->first();
            return response()->json($regPeriksa, 200);
        }
    }
}
