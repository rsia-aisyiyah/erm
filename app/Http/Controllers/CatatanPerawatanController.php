<?php

namespace App\Http\Controllers;

use App\Models\CatatanPerawatan;
use Illuminate\Http\Request;
use Svg\Tag\Rect;

class CatatanPerawatanController extends Controller
{
    protected $catatan;
    protected $track;
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
        $catatan = $this->catatan->where('no_rawat', $request->no_rawat)->update($data);
        return response()->json($catatan);
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
        $getCatatan = $this->catatan->where('no_rawat', str_replace('-', '/', $data['no_rawat']))->count();
        if ($getCatatan) {
            $catatan = $this->catatan->where('no_rawat', $request->no_rawat)->update($data);
            $this->track->updateSql($this->catatan, $data, ['no_rawat' => $request->no_rawat]);
        } else {
            $catatan = $this->catatan->create($data);
            $this->track->insertSql($this->catatan, $data);
        }
        return response()->json($catatan);
    }
    function getCatatan(Request $request)
    {
        $catatan = $this->catatan->where('no_rawat', $request->no_rawat)->with('dokter')->first();
        return response()->json($catatan);
    }
}
