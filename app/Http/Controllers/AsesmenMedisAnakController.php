<?php

namespace App\Http\Controllers;

use App\Models\AsesmenMedisAnak;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AsesmenMedisAnakController extends Controller
{
    protected $asmed;
    protected $carbon;
    protected $track;

    public function __construct()
    {
        $this->track = new TrackerSqlController;
        $this->asmed = new AsesmenMedisAnak();
        $this->carbon = new Carbon();
    }

    function get($noRawat)
    {
        $id = str_replace('-', '/', $noRawat);

        $asmed = $this->asmed->where('no_rawat', $id)->with('regPeriksa.pasien', 'regPeriksa.dokter')->first();
        return response()->json($asmed);
    }

    function create(Request $request)
    {
        $data = array_push($request->all(), ['tgl_tanggal' => date('Y-m-d H:i:s')]);

        $asmed = $this->asmed->create($data);
        $this->track->create($this->track->insertSql($this->asmed, $data));

        return $asmed;
    }
}
