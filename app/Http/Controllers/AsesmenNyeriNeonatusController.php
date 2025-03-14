<?php

namespace App\Http\Controllers;

use App\Models\AsesmenNyeriNeonatus;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class AsesmenNyeriNeonatusController extends Controller
{
    protected $model;
    protected $track;
    function __construct()
    {
        $this->model = new AsesmenNyeriNeonatus();
        $this->track = new TrackerSqlController();
    }
    function create(Request $request)
    {
        $validate = $request->validate([
            'tanggal' => 'required',
            'no_rawat' => 'required',
            'ekspresi_wajah_nilai' => 'required',
            'kaki_nilai' => 'required',
            'tangisan_nilai' => 'required',
            'tangan_nilai' => 'required',
            'kesadaran_nilai' => 'required',
            'pola_nafas_nilai' => 'required',

        ]);

       $data = [
            'no_rawat' => $request->no_rawat,
            'tanggal' => date('Y-m-d H:i:s', strtotime($request->tanggal)),
            'ekspresi_wajah_nilai' => $request->ekspresi_wajah_nilai,
            'ekspresi_wajah_ket' => $request->ekspresi_wajah_ket,
            'kaki_nilai' => $request->kaki_nilai,
            'tangan_nilai' => $request->tangan_nilai,
            'tangan_ket' => $request->tangan_ket,
            'tangisan_nilai' => $request->tangisan_nilai,
            'kesadaran_nilai' => $request->kesadaran_nilai,
            'pola_nafas_nilai' => $request->pola_nafas_nilai,
            'kaki_ket' => $request->kaki_ket,
            'tangisan_ket' => $request->tangisan_ket,
            'kesadaran_ket' => $request->kesadaran_ket,
            'pola_nafas_ket' => $request->pola_nafas_ket,
            'total_nilai' => $request->total_nilai,
            'keterangan_nilai' => $request->keterangan,
            'farmakologi' => $request->farmakologi,
            'non_farmakologi' => $request->non_farmakologi,
            'non_farmakologi_lain' => $request->non_farmakologi_lain,
            'nip' => session()->get('pegawai')->nik
        ];
        $model = $this->model->where('no_rawat', $request->no_rawat)
            ->where('tanggal', date('Y-m-d H:i:s', strtotime($request->tanggal)))
            ->where('nip', session()->get('pegawai')->nik);

        if ($model->first()) {
            return $this->update($request);
        }

        try {
            $create = $this->model->create($data);
            if ($create) {
                $this->track->insertSql($this->model, $data);
            }
        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
        return response()->json('Success', 201);
    }

    function get(Request $request)
    {
        $get = $this->model->where('no_rawat', $request->no_rawat)
            ->with(['petugas'])
            ->get();
        return response()->json($get);
    }

    function first(Request $request)
    {
        $get = $this->model->where('no_rawat', $request->no_rawat)
            ->with(['petugas'])
            ->first();
        return response()->json($get);
    }

    function delete(Request $request)
    {
        $keys = [
            'no_rawat' => $request->no_rawat,
            'tanggal' => $request->tanggal,
            'nip' => session()->get('pegawai')->nik
        ];

        $model = $this->model->where($keys);

        if ($model->first()) {
            try {
                $delete = $model->delete();
                if ($delete) {
                    $this->track->deleteSql($this->model, $keys);
                }
                return response()->json('Success', 201);
            } catch (QueryException $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }
        return response()->json('Not Found', 404);
    }
    function update(Request $request)
    {
        $validate = $request->validate([
            'tanggal' => 'required',
            'no_rawat' => 'required',
            'ekspresi_wajah_nilai' => 'required',
            'kaki_nilai' => 'required',
            'tangisan_nilai' => 'required',
            'tangan_nilai' => 'required',
            'kesadaran_nilai' => 'required',
            'pola_nafas_nilai' => 'required',

        ]);

       $data = [
            'ekspresi_wajah_nilai' => $request->ekspresi_wajah_nilai,
            'ekspresi_wajah_ket' => $request->ekspresi_wajah_ket,
            'kaki_nilai' => $request->kaki_nilai,
            'tangisan_nilai' => $request->tangisan_nilai,
            'tangan_nilai' => $request->tangan_nilai,
            'tangan_ket' => $request->tangan_ket,
            'kesadaran_nilai' => $request->kesadaran_nilai,
            'pola_nafas_nilai' => $request->pola_nafas_nilai,
            'kaki_ket' => $request->kaki_ket,
            'tangisan_ket' => $request->tangisan_ket,
            'kesadaran_ket' => $request->kesadaran_ket,
            'pola_nafas_ket' => $request->pola_nafas_ket,
            'total_nilai' => $request->total_nilai,
            'keterangan_nilai' => $request->keterangan,
            'farmakologi' => $request->farmakologi,
            'non_farmakologi' => $request->non_farmakologi,
            'non_farmakologi_lain' => $request->non_farmakologi_lain,
        ];

        $key = [
            'no_rawat' => $request->no_rawat,
            'tanggal' => date('Y-m-d H:i:s', strtotime($request->tanggal)),
            'nip' => session()->get('pegawai')->nik
        ];

        try {
            $update = $this->model->where('no_rawat', $request->no_rawat)
                ->where($key)
                ->update($data);
            if ($update) {
                $this->track->updateSql($this->model, $data, $key);
            }
            return response()->json('Success', 201);
        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
