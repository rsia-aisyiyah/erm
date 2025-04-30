<?php

namespace App\Http\Controllers;

use App\Models\MasterImunisasi;
use Illuminate\Http\Request;

class MasterImunisasiController extends Controller
{
    protected $vaksin;
    public function __construct()
    {
        $this->vaksin = new MasterImunisasi();
    }

    function get(Request $request)
    {
        $vaksin = $this->vaksin->where('nama_imunisasi', 'like', '%' . $request->nama . '%')->get();
        return response()->json($vaksin);
    }
}
