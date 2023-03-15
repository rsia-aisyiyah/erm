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
            $hasil = $resepDokter->where('no_resep', $request->no_resep)->with(['metode', 'detailRacikan'])->get();
        }

        if ($request->no_racik) {
            $hasil = $resepDokter->where('no_resep', $request->no_resep)->where('no_racik', $request->no_racik)->with(['metode', 'detailRacikan'])->first();
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
    public function simpanRacik(Request $request)
    {
        $racikan = ResepDokterRacikanDetail::create([
            'no_resep' => $request->no_resep,
            'no_racik' => $request->no_racik,
            'kode_brng' => $request->kode_brng,
            'p1' => $request->p1,
            'p2' => $request->p2,
            'kandungan' => $request->kandungan,
            'jml' => $request->jml,
        ]);
        return response()->json($racikan);
    }
}
