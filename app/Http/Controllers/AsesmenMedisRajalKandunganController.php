<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AsesmenMedisRajalKandungan;

class AsesmenMedisRajalKandunganController extends Controller
{
    protected $track;
    protected $asmed;

    public function __construct()
    {
        $this->asmed = new AsesmenMedisRajalKandungan();
        $this->track = new TrackerSqlController();
    }

    function get($noRawat)
    {
        $id = str_replace('-', '/', $noRawat);
        $asmed = $this->asmed->where('no_rawat', $id)->with(['regPeriksa.pasien', 'dokter'])->first();
        return response()->json($asmed);
    }
    function insert(Request $request)
    {
        $data = $request->except('_token');
        $data['tanggal'] = date('Y-m-d H:i:s');

        $asmed = $this->asmed->create($data);
        $this->track->insertSql($this->asmed, $data);
        return response()->json($asmed);
    }
    function edit(Request $request)
    {
        $data = $request->except(['_token', 'dokter', 'tgl_lahir']);
        $clause = ['no_rawat' => $data['no_rawat']];

        $asmed = $this->asmed->where($clause)->update($data);
        $this->track->updateSql($this->asmed, $data, $clause);
        return response()->json($asmed);
    }
}
