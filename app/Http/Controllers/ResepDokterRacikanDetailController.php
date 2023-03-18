<?php

namespace App\Http\Controllers;

use App\Models\ResepDokterRacikanDetail;
use Illuminate\Http\Request;

class ResepDokterRacikanDetailController extends Controller
{
    public $resep;
    public function __construct()
    {
        $this->resep = new ResepDokterRacikanDetail();
    }
    public function ambil(Request $request)
    {
        $resep = $this->resep;
        if ($request->no_resep) {
            if ($request->no_racik) {
                $hasil = $resep->where('no_resep', $request->no_resep)->where('no_racik', $request->no_racik)->with('dataBarang')->get();
            } else {
                $hasil = $resep->where('no_resep', $request->no_resep)->with('dataBarang')->get();
            }
        }
        return response()->json($hasil);
    }
    public function hapus(Request $request)
    {
        $resep = $this->resep;
        $hasil = $resep->where('no_resep', $request->no_resep)->where('no_racik', $request->no_racik)->where('kode_brng', $request->kode_brng)->delete();
        return response()->json($hasil);
    }
}
