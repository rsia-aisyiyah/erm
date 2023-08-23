<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AsesmenMedisIgdController extends Model
{
    use HasFactory;
    protected $asesmen;

    public function __construct()
    {
        $this->asesmen = new AsesmenMedisIgd();
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
        return response()->json($asmed);
    }
    function edit(Request $request)
    {
        $data = $request->except(['_token', 'pasien', 'tgl_lahir', 'dokter']);
        $asmed = $this->asesmen->where('no_rawat', $data['no_rawat'])->update($data);
        return response()->json($asmed);
    }
}
