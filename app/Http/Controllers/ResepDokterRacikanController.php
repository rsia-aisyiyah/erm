<?php

namespace App\Http\Controllers;

use App\Models\ResepDokterRacikan;
use App\Models\ResepDokterRacikanDetail;
use Illuminate\Http\Request;

class ResepDokterRacikanController extends Controller
{
    public function ambil(Request $request)
    {
        $resepDokter = new ResepDokterRacikan();

        if ($request->no_resep) {
            if ($request->no_racik) {
                $hasil = $resepDokter->where('no_resep', $request->no_resep)->where('no_racik', $request->no_racik)->with(['metode', 'detailRacikan' => function ($q) use ($request) {
                    $q->where('no_racik', $request->no_racik);
                }])->first();
            } else {
                $hasil = $resepDokter->where('no_resep', $request->no_resep)->with(['metode', 'detailRacikan'])->get();
            }
        }
        return response()->json($hasil, 200);
    }
    public function simpan(Request $request)
    {
        $resep = ResepDokterRacikan::create([
            'no_resep' => $request->no_resep,
            'no_racik' => $request->no_racik,
            'nama_racik' => $request->nama_racik,
            'kd_racik' => $request->kd_racik,
            'jml_dr' => $request->jml_dr,
            'aturan_pakai' => $request->aturan_pakai,
            'keterangan' => $request->keterangan,
        ]);

        return response()->json($resep);
    }

    public function hapus(Request $request)
    {
        $resep = ResepDokterRacikan::where('no_racik', $request->no_racik)->where('no_resep', $request->no_resep)->delete();
        return response()->json($resep);
    }
}
