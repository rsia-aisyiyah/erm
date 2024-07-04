<?php

namespace App\Http\Controllers;

use App\Models\CatatanPerawatan;
use App\Traits\JsonResponseTrait;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Svg\Tag\Rect;

class CatatanPerawatanController extends Controller
{
    protected $catatan;
    protected $track;
    use JsonResponseTrait;
    public function __construct()
    {
        $this->catatan = new CatatanPerawatan();
        $this->track = new TrackerSqlController();
    }
    function insert(Request $request)
    {
        $data = [
            'no_rawat' => $request->no_rawat,
            'kd_dokter' => $request->kd_dokter,
            'catatan' => $request->catatan,
            'tanggal' => date('Y-m-d'),
            'jam' => date('H:i:s'),
        ];

        $catatan = $this->catatan->create($data);
        $this->track->insertSql($this->catatan, $data);

        return response()->json($catatan);
    }

    function get($noRawat)
    {
        $nomor = str_replace('-', '/', $noRawat);
        $catatan = $this->catatan->where('no_rawat', $nomor)->with('dokter')->first();

        return response()->json($catatan);
    }
    function update(Request $request)
    {
        $data = [
            'no_rawat' => $request->no_rawat,
            'kd_dokter' => $request->kd_dokter,
            'catatan' => $request->catatan,
            'tanggal' => date('Y-m-d'),
            'jam' => date('H:i:s'),
        ];
        try {
            $this->catatan->where('no_rawat', $request->no_rawat)->update($data);
        } catch (QueryException $e) {
            return $this->errorResponse('Gagal menambahkan catatan', 500, $e->errorInfo);
        }
        $this->track->updateSql($this->catatan, $data, ['no_rawat' => $request->no_rawat]);
        return $this->successResponse($data, 'Berhasil', 201);
    }
    function insertOrUpdate(Request $request)
    {

        $data = [
            'no_rawat' => $request->no_rawat,
            'kd_dokter' => $request->kd_dokter,
            'catatan' => $request->catatan,
            'tanggal' => date('Y-m-d'),
            'jam' => date('H:i:s'),
        ];
        $getCatatan = $this->catatan->where('no_rawat', $request->no_rawat)->count();
        try {
            if ($getCatatan) {
                $this->update(new \Illuminate\Http\Request($data));
            } else {
                $catatan = $this->catatan->create($data);
                $this->track->insertSql($this->catatan, $data);
            }
        } catch (QueryException $e) {
            return $this->errorResponse('Gagal menambahkan catatan', 500, $e->errorInfo);
        }
        return $this->successResponse(null, 'Berhasil');
    }
    function getCatatan(Request $request)
    {
        $catatan = $this->catatan->where('no_rawat', $request->no_rawat)->with('dokter')->first();
        return response()->json($catatan);
    }

    function delete(Request $request)
    {
        try {
            $this->catatan->where('no_rawat', $request->no_rawat)->delete();
        } catch (QueryException $e) {
            return $this->errorResponse('Gagal hapus catatan', 500, $e->errorInfo);
        }
        $this->track->deleteSql($this->catatan, ['no_rawat' => $request->no_rawat]);
        return $this->successResponse(null, 'Berhasil', 201);
    }
}
