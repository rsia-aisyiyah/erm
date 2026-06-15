<?php

namespace App\Http\Controllers;

use App\Models\RencanaAskepRalanAnak;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class RencanaAskepRalanAnakController extends Controller
{
    use ResponseTrait;
    function get(Request $request)
    {
        $no_rawat = $request->no_rawat;
        $rencana = RencanaAskepRalanAnak::where('no_rawat', $no_rawat)->get();
        return $this->successResponse($rencana);
    }
}
