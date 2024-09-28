<?php

namespace App\Models;

use App\Http\Controllers\TrackerSqlController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

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

    public function get($noRawat)
    {
        $id = str_replace('-', '/', $noRawat);
        $asmed = $this->asesmen->where('no_rawat', $id)->with(['regPeriksa.pasien', 'dokter'])->first();
        return response()->json($asmed);
    }
    public function create(Request $request)
    {
        $data = $request->except(['_token', 'pasien', 'tgl_lahir', 'dokter']);
        $data['tanggal'] = date('Y-m-d H:i:s');

        $isExist = $this->asesmen->where([
            'no_rawat' => $data['no_rawat'],
        ])->first();

        if ($isExist) {
            return $this->edit($request);
        }

        try {
            $created = $this->asesmen->create($data);
            if ($created) {
                $this->track->insertSql($this->asesmen, $data);
            }
        } catch (QueryException $e) {
            return response()->json($e->errorInfo, 500);
        }

        return response()->json('Berhasil membuat asesmen medis ugd', 201);
    }
    public function edit(Request $request)
    {
        $data = $request->except(['_token', 'pasien', 'tgl_lahir', 'dokter']);
        $data['tanggal'] = date('Y-m-d H:i:s');

        try {
            $clause = ['no_rawat' => $data['no_rawat']];
            $updated = $this->asesmen->where($clause)->update($data);
            if ($updated) {
                $this->track->updateSql($this->asesmen, $data, $clause);
            }
        } catch (QueryException $e) {
            return response()->json($e->errorInfo, 500);
        }
        return response()->json('Berhasil mengubah asesmen medis', 200);

    }
}
