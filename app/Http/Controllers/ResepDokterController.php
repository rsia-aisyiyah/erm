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
    public function cari(Request $request)
    {
        $resepDokter = $this->resepDokter;

        if ($request->aturan_pakai) {
            $hasil = $resepDokter->where('aturan_pakai', 'like', $request->aturan_pakai . "%")->groupBy('aturan_pakai')->get();
        } else {
            $resepDokter->groupBy('aturan_pakai')->get();
        }

        return response()->json($hasil, 200);
    }
}
