<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AskepRanapAnak;

class AskepRanapAnakController extends Controller
{
    protected $askep;
    protected $track;
    public function __construct()
    {
        $this->askep = new AskepRanapAnak();
        $this->track = new TrackerSqlController();
    }

    function get(Request $request)
    {
        return $this->askep->where('no_rawat', $request->no_rawat)->with('regPeriksa.pasien.bahasa', 'masalahKeperawatan.masterMasalah', 'masalahKeperawatan.rencanaKeperawatan.masterRencana', 'pengkaji1', 'pengkaji2', 'dokter')->first();
    }

    function insert(Request $request)
    {
        $data = $request->all();
        $insert = $this->askep->create($data);
        $this->track->insertSql($this->askep, $request->except('_token'));
        return response()->json($insert);
    }

    function createOrUpdate(Request $request)
    {
        $data = $request->except('_token');
        $askep = $this->askep->where('no_rawat', $data['no_rawat'])->first();

        if ($askep) {
            $createOrUpdate =  $this->askep->where('no_rawat', $data['no_rawat'])->update($data);
            $this->track->updateSql($this->askep, $data, ['no_rawat' => $data['no_rawat']]);
        } else {
            $createOrUpdate =  $this->askep->create($data);
            $this->track->insertSql($this->askep, $data);
        }
        return response()->json($createOrUpdate);
    }
}
