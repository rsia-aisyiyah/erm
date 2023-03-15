<?php

namespace App\Http\Controllers;

use App\Models\ResepDokterRacikanDetail;
use Illuminate\Http\Request;

class ResepDokterRacikanDetailController extends Controller
{
    public function ambil(Request $request)
    {
        $resep = new ResepDokterRacikanDetail();

        if ($request->no_resep) {
            $hasil = $resep->where('no_resep', $request->no_resep)->with('dataBarang')->get();
        }

        return response()->json($hasil);
    }
}
