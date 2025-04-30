<?php

namespace App\Http\Controllers;

use App\Models\RanapGabung;
use Illuminate\Http\Request;

class RanapGabungController extends Controller
{
    protected $ranapGabung;

    public function __construct(RanapGabung $ranapGabung)
    {
        $this->ranapGabung = $ranapGabung;
    }

    public function get(Request $request)
    {
        $ranapGabung = $this->ranapGabung
            ->where('no_rawat', $request->no_rawat)
            ->orWhere('no_rawat2', $request->no_rawat)
            ->with('kamarIbu', function ($q) {
                return $q->where('stts_pulang', '!=', 'Pindah Kamar')->with('kamar.bangsal');
            })
            ->first();

        return response()->json($ranapGabung);
    }

}
