<?php

namespace App\Http\Controllers;

use App\Models\RsiaHasilKritis;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use Yajra\DataTables\DataTables;

class RsiaHasilKritisController extends Controller
{
    protected $track;
    public function __construct()
    {
        $this->track = new TrackerSqlController();
    }
    function get($id)
    {
        $hasil = RsiaHasilKritis::where('id', $id)->with(['petugas' => function ($q) {
            return $q->select(['nip', 'nama']);
        }, 'petugasRuang' => function ($q) {
            return $q->select(['nip', 'nama']);
        }, 'dokter' => function ($q) {
            return $q->select(['kd_dokter', 'nm_dokter']);
        }, 'regPeriksa'])->first();
        return response()->json($hasil);
    }
    function getHasil(Request $request)
    {
        $hasil = RsiaHasilKritis::where('no_rawat', $request->no_rawat)->with(['petugas' => function ($q) {
            return $q->select(['nip', 'nama']);
        }, 'petugasRuang' => function ($q) {
            return $q->select(['nip', 'nama']);
        }, 'dokter' => function ($q) {
            return $q->select(['kd_dokter', 'nm_dokter']);
        }, 'regPeriksa']);

        return DataTables::of($hasil)->make(true);
    }

    function create(Request $request)
    {
        $data = [
            'no_rawat' => $request->no_rawat,
            'hasil' => $request->hasil,
            'petugas' => $request->petugas,
            'tgl' => $request->tgl ? date('Y-m-d H:i:s', strtotime($request->tgl)) : '0000-00-00 00:00:00',
            'petugas_ruang' => $request->petugas_ruang,
            'tgl_ruang' => $request->tgl_ruang ? date('Y-m-d H:i:s', strtotime($request->tgl_ruang)) : '0000-00-00 00:00:00',
            'dokter' => $request->dokter,
            'tgl_dokter' => $request->tgl_dokter ? date('Y-m-d H:i:s', strtotime($request->tgl_dokter)) : '0000-00-00 00:00:00',

        ];

        if ($request->id) {
            $isAvailable = RsiaHasilKritis::where('id', $request->id)->first();
            if ($isAvailable) {
                $this->update($request);
                return true;
            }
        }

        try {
            $hasil = RsiaHasilKritis::create($data);
            if ($hasil) {
                $this->track->insertSql(new RsiaHasilKritis(), $data);
            }
            return response()->json('SUKSES', 201);
        } catch (QueryException $e) {
            return response()->json($e->errorInfo, 500);
        }
    }
    function delete($id, Request $request)
    {
        try {
            $hasil = RsiaHasilKritis::where('id', $id)->delete();
            if ($hasil) {
                $this->track->deleteSql(new RsiaHasilKritis(), ['id' => $id]);
            }
            return response()->json($hasil);
        } catch (QueryException $e) {
            return response()->json($e->errorInfo, 500);
        }
    }
    function update(Request $request)
    {
        $data = [
            'no_rawat' => $request->no_rawat,
            'hasil' => $request->hasil,
            'petugas' => $request->petugas,
            'tgl' => $request->tgl ? date('Y-m-d H:i:s', strtotime($request->tgl)) : '0000-00-00 00:00:00',
            'petugas_ruang' => $request->petugas_ruang,
            'tgl_ruang' => $request->tgl_ruang ? date('Y-m-d H:i:s', strtotime($request->tgl_ruang)) : '0000-00-00 00:00:00',
            'dokter' => $request->dokter,
            'tgl_dokter' => $request->tgl_dokter ? date('Y-m-d H:i:s', strtotime($request->tgl_dokter)) : '0000-00-00 00:00:00',

        ];

        try {
            $hasil = RsiaHasilKritis::where(['id' => $request->id])->update($data);
            if ($hasil) {
                $this->track->updateSql(new RsiaHasilKritis(), $data, ['id' => $request->id]);
            }
            return response()->json('SUKSES', 201);
        } catch (QueryException $e) {
            return response()->json($e->errorInfo, 500);
        }
    }
}
