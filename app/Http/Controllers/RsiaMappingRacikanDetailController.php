<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RsiaMappingRacikanDetail;

class RsiaMappingRacikanDetailController extends Controller
{
    protected $detail;
    public function __construct()
    {
        $this->detail = new RsiaMappingRacikanDetail();
    }

    public function tambah(Request $request)
    {
        $racikan = $this->detail->create([
            'id_racik' => $request->id_racik,
            'kode_brng' => $request->kode_brng
        ]);

        return response()->json($racikan);
    }
}
