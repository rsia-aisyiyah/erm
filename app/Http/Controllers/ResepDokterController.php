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
            $hasil = $resepDokter->where('aturan_pakai', 'like', $request->aturan_pakai . "%")->get();
        } else {
            $resepDokter->get();
        }

        return response()->json($hasil, 200);
    }
    public function simpan(Request $request)
    {

        foreach ($request->data as $data) {
            $resepDokter[] = $this->resepDokter->create([
                'no_resep' => $data['no_resep'],
                'kode_brng' => $data['kode_brng'],
                'jml' => $data['jml'],
                'aturan_pakai' => $data['aturan_pakai'],
            ]);
        }

        return $resepDokter;
    }
}
