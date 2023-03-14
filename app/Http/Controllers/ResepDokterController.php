<?php

namespace App\Http\Controllers;

use App\Models\ResepDokter;
use Illuminate\Http\Request;

class ResepDokterController extends Controller
{
    private $resepDokter;
    public function __construct()
    {
        $this->resepDokter = new ResepDokter();
    }
    public function ambil(Request $request)
    {
        $resepDokter = $this->resepDokter;

        if ($request->no_resep) {
            $hasil = $resepDokter->where('no_resep', $request->no_resep)->first();
        }

        return response()->json($hasil, 200);
    }
    public function cari(Request $request)
    {
        $resepDokter = $this->resepDokter;

        if ($request->aturan_pakai) {
            $hasil = $resepDokter->where('aturan_pakai', 'like', '%' . $request->aturan_pakai . "%")->limit(10)->get();
        } else {
            $resepDokter->limit(10)->get();
        }

        return response()->json($hasil, 200);
    }
    public function simpan(Request $request)
    {

        $resepDokter = $this->resepDokter->create([
            'no_resep' => $request->no_resep,
            'kode_brng' => $request->kode_brng,
            'jml' => $request->jml,
            'aturan_pakai' => $request->aturan_pakai,
        ]);

        return response()->json($resepDokter);
    }
    public function hapus(Request $request)
    {
        $resepDokter = $this->resepDokter->where('no_resep', $request->no_resep)->where('kode_brng', $request->kode_brng)->delete();
        return response()->json($resepDokter, 200);
    }
}
