<?php

namespace App\Http\Controllers;

use App\Models\PemeriksaanRalan;
use Illuminate\Http\Request;

class PemeriksaanRalanController extends Controller
{
    public function ambil(Request $request)
    {
        return $pemeriksaan = PemeriksaanRalan::where('no_rawat', $request->no_rawat)
            ->with('regPeriksa', function ($q) {
                $q->with('pasien');
            })->first();

        // if ($pemeriksaan) {
        //     return response()->json(['message' => 'Berhasil ambil data', 'pemeriksaan' => $pemeriksaan], 200);
        // } else {
        //     return response()->json(['message' => 'Tidak ditemukan data'], 404);
        // }
    }
}
