<?php

namespace App\Http\Controllers;

use App\Models\AsesmenMedisKandungan;
use Illuminate\Http\Request;

class AsesmenMedisKandunganController extends Controller
{
    protected $asmed;
    protected $track;

    public function __construct()
    {
        $this->asmed = new AsesmenMedisKandungan();
        $this->track = new TrackerSqlController();
    }

    function get($noRawat)
    {
        $id = str_replace('-', '/', $noRawat);
        $asmed = $this->asmed->where('no_rawat', $id)->with('regPeriksa', 'dokter')->first();

        return response()->json($asmed);
    }
    function create(Request $request)
    {
        $data = $request->except(['_token']);
        $data['tanggal'] = date('Y-m-d H:i:s');

        $asmed = $this->asmed->create($data);
        $this->track->create($this->track->insertSql($this->asmed, $data));

        return response()->json($asmed);
    }
    function update(Request $request)
    {
        $data = $request->except(['_token']);
        $clause = ['no_rawat' => $request->no_rawat];
        $asmed = $this->asmed->where($clause)->update($data);
        $this->track->create($this->track->updateSql($this->asmed, $data, $clause));

        return response()->json($asmed);
    }
}
