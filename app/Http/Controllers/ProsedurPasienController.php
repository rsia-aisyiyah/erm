<?php

namespace App\Http\Controllers;

use App\Models\ProsedurPasien;
use Illuminate\Http\Request;

class ProsedurPasienController extends Controller
{
    private $prosedur;
    public function __construct()
    {
        $this->prosedur = new ProsedurPasien();
    }

    public function ambil(Request $request)
    {
        $prosedur = $this->prosedur->with('icd9')->where('no_rawat', $request->no_rawat)->get();

        return response()->json($prosedur);
    }

    public function tambah(Request $request)
    {
        $prosedur = $this->prosedur->create([
            'no_rawat' => $request->no_rawat,
            'kode' => $request->kode,
            'status' => $request->status,
            'prioritas' => $request->prioritas,
        ]);

        return response()->json($prosedur);
    }

    public function hapus(Request $request)
    {

        $prosedur = $this->prosedur
            ->where('no_rawat', $request->no_rawat)
            ->where('kode', $request->kode)
            ->delete();

        return response()->json($prosedur);
    }
}
