<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AskepRanapAnak;

class AskepRanapAnakController extends Controller
{
    protected $askep;
    public function __construct()
    {
        $this->askep = new AskepRanapAnak();
    }

    function get(Request $request)
    {
        return $this->askep->where('no_rawat', $request->no_rawat)->with('masalahKeperawatan.masterMasalah.masterRencana', 'pengkaji1', 'pengkaji2')->first();
    }

    function insert(Request $request)
    {
        return $request->all();
    }
}
