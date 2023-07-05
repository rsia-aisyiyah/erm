<?php

namespace App\Http\Controllers;

use App\Models\RencanaKontrol;
use Illuminate\Http\Request;

class BrigdgingRencanaKontrolController extends Controller
{
    protected $rencanaKontrol;

    public function __construct()
    {
        $this->rencanaKontrol = new RencanaKontrol();
    }

    public function create(Request $request)
    {
        $data = $request->all();
        $rencanaKontrol = $this->rencanaKontrol->create($data);
        return response()->json($rencanaKontrol);
    }
}
