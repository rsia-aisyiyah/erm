<?php

namespace App\Http\Controllers;

use App\Models\BridgingSep;
use Illuminate\Http\Request;

class BridgingSepController extends Controller
{
    private $sep;
    public function __construct()
    {
        $this->sep = new BridgingSep();
    }

    function ambilSep($no_sep)
    {
        $sep = $this->sep->where('no_sep', $no_sep)->with(['regPeriksa.pasien.sep', 'suratKontrol', 'regPeriksa.dokter', 'rujukanKeluar'])->first();
        return response()->json($sep);
    }
}
