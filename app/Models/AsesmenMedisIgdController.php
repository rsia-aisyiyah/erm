<?php

namespace App\Models;

use App\Http\Controllers\TrackerSqlController;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AsesmenMedisIgdController extends Model
{
    use HasFactory;
    protected $asesmen;
    protected $track;

    public function __construct()
    {
        $this->asesmen = new AsesmenMedisIgd();
        $this->track = new TrackerSqlController();
    }

    function get($noRawat)
    {
        $id = str_replace('-', '/', $noRawat);
        $asmed = $this->asesmen->where('no_rawat', $id)->with(['regPeriksa.pasien', 'dokter'])->first();
        return response()->json($asmed);
    }
    function create(Request $request)
    {
        $data = $request->except(['_token', 'pasien', 'tgl_lahir', 'dokter']);
        $data['tanggal'] = date('Y-m-d H:i:s');

        $asmed = $this->asesmen->create($data);
        $this->track->insertSql($this->asesmen, $data);
        return response()->json($asmed);
    }
    function edit(Request $request)
    {
        $data = $request->except(['_token', 'pasien', 'tgl_lahir', 'dokter']);
        $asmed = $this->asesmen->where('no_rawat', $data['no_rawat'])->update($data);
        $this->track->updateSql($this->asesmen, $data, ['no_rawat' => $data['no_rawat']]);
        return response()->json($asmed);
    }
}
