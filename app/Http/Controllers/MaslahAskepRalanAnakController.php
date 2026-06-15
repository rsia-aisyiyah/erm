<?php

namespace App\Http\Controllers;

use App\Models\MasalahAskepRalanAnak;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class MaslahAskepRalanAnakController extends Controller
{
    use ResponseTrait;
    function get(Request $request)
    {
        $no_rawat = $request->no_rawat;
        $masalah = MasalahAskepRalanAnak::where('no_rawat', $no_rawat)->get();
        return $this->successResponse($masalah);

    }
}
