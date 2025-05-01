<?php

namespace App\Http\Controllers;

use App\Models\AskepUgd;
use Illuminate\Http\Request;

class AskepUgdController extends Controller
{
    protected $track;
    protected $askep;

    public function __construct()
    {
        $this->track = new TrackerSqlController();
        $this->askep = new AskepUgd();
    }

    function get(Request $request)
    {
        return $this->askep->where('no_rawat', $request->no_rawat)
            ->with('regPeriksa.pasien.bahasa', 'regPeriksa.pasien.cacat', 'regPeriksa.penjab', 'regPeriksa.dokter', 'masalahKeperawatan.masterMasalah', 'rencanaKeperawatan.masterRencana', 'pengkaji')
            ->first();
    }
}
