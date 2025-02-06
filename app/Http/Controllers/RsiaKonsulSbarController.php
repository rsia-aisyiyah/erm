<?php

namespace App\Http\Controllers;

use App\Models\RsiaKonsulSbar;
use Facade\Ignition\QueryRecorder\Query;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class RsiaKonsulSbarController extends Controller
{
    protected $track;

    public function __construct() {
        $this->track = new TrackerSqlController();
    }

    public function create(Request $request){
        $data = [
            'no_rawat' => $request->no_rawat,
            'tgl_perawatan' => $request->tgl_perawatan,
            'jam_rawat' => $request->jam_rawat,
            'dokter' => $request->kd_dokter
        ];

        try {
            $result = RsiaKonsulSbar::create($data);
        } catch (QueryException $e) {
            return response()->json($e->errorInfo, 500);
        }
        $this->track->insertSql(new RsiaKonsulSbar(), $data);
        return response()->json($result, 200);
    }

    public function update(Request $request){
        $key= [
            'no_rawat' => $request->no_rawat,
            'tgl_perawatan' => $request->tgl_perawatan_awal,
            'jam_rawat' => $request->jam_rawat_awal,
        ];

        $data = [
            'no_rawat' => $request->no_rawat,
            'tgl_perawatan' => $request->tgl_perawatan,
            'jam_rawat' => $request->jam_rawat,
            'dokter' => $request->kd_dokter
        ];
        try {
            $result = RsiaKonsulSbar::where($key)
            ->update($data);
        } catch (QueryException $e) {
            return response()->json($e->errorInfo, 500);
        }
        $this->track->updateSql(new RsiaKonsulSbar(),$data, $key);
        return response()->json('Berhasil Update SBAR', 200);
    }
}
