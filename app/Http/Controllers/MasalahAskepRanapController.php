<?php

namespace App\Http\Controllers;

use App\Models\MasalahAskepRanap;
use Illuminate\Http\Request;

class MasalahAskepRanapController extends Controller
{
    //
    protected $masalah;
    protected $track;

    public function __construct()
    {
        $this->masalah = new MasalahAskepRanap();
        $this->track = new TrackerSqlController();
    }

    function get(Request $request)
    {
        $masalah = $this->masalah->where('no_rawat', $request->no_rawat)->get();

        return response()->json($masalah);
    }

    function insert(Request $request)
    {
        $data = $request->masalah;

        for ($i = 0; $i < count($data); $i++) {
            $masalah[] = $this->masalah->create($data[$i]);
            $this->track->insertSql($this->masalah, $data[$i]);
        }
        return response()->json($masalah);
    }

    function delete(Request $request)
    {
        $clause = [
            'no_rawat' => $request->no_rawat
        ];
        $masalah = $this->masalah->where($clause)->delete();
        $this->track->deleteSql($this->masalah, $clause);
        return response()->json($masalah);
    }
}
