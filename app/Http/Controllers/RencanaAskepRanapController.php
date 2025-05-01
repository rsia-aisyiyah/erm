<?php

namespace App\Http\Controllers;

use App\Models\RencanaAskepRanap;
use Illuminate\Http\Request;

class RencanaAskepRanapController extends Controller
{
    //
    protected $rencana;
    protected $track;
    public function __construct()
    {
        $this->rencana = new RencanaAskepRanap();
        $this->track = new TrackerSqlController();
    }
    function get(Request $request)
    {
        $rencana = RencanaAskepRanap::where('no_rawat', $request->no_rawat)->get();
        return response()->json($rencana);
    }
    function insert(Request $request)
    {
        $data = $request->rencana;

        for ($i = 0; $i < count($data); $i++) {
            $rencana[] = $this->rencana->create($data[$i]);
            $this->track->insertSql($this->rencana, $data[$i]);
        }
        return response()->json($rencana);
    }

    function delete(Request $request)
    {
        $clause = [
            'no_rawat' => $request->no_rawat
        ];
        $rencana = $this->rencana->where($clause)->delete();
        $this->track->deleteSql($this->rencana, $clause);

        return response()->json($rencana);
    }
}
