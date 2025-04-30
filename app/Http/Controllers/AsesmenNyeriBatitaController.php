<?php

namespace App\Http\Controllers;

use App\Models\AsesmenNyeriBatita;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class AsesmenNyeriBatitaController extends Controller
{
    protected $model;
    protected $track;
    function __construct()
    {
        $this->model = new AsesmenNyeriBatita();
        $this->track = new TrackerSqlController();
    }
    function create(Request $request)
    {
        $validate = $request->validate([
            'tanggal' => 'required',
            'no_rawat' => 'required',
            'wajah' => 'required',
            'kaki' => 'required',
            'aktivitas' => 'required',
            'menangis' => 'required',
            'bersuara' => 'required',
            'interpretasi' => 'required',
            'farmakologi' => 'required',
            'non_farmakologi' => 'required',
            'total_skor' => 'required',
        ]);

        $data = [
            'no_rawat' => $request->no_rawat,
            'tanggal' => date('Y-m-d H:i:s', strtotime($request->tanggal)),
            'wajah' => $request->wajah,
            'kaki' => $request->kaki,
            'aktivitas' => $request->aktivitas,
            'menangis' => $request->menangis,
            'bersuara' => $request->bersuara,
            'wajah_ket' => $request->wajah_ket,
            'kaki_ket' => $request->kaki_ket,
            'aktivitas_ket' => $request->aktivitas_ket,
            'menangis_ket' => $request->menangis_ket,
            'bersuara_ket' => $request->bersuara_ket,
            'total_skor' => $request->total_skor,
            'interpretasi' => $request->interpretasi,
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
            'wajah' => 'required',
            'kaki' => 'required',
            'aktivitas' => 'required',
            'menangis' => 'required',
            'bersuara' => 'required',
            'interpretasi' => 'required',
            'farmakologi' => 'required',
            'non_farmakologi' => 'required',
            'total_skor' => 'required',
        ]);

        $data = [
            'wajah' => $request->wajah,
            'kaki' => $request->kaki,
            'aktivitas' => $request->aktivitas,
            'menangis' => $request->menangis,
            'bersuara' => $request->bersuara,
            'wajah_ket' => $request->wajah_ket,
            'kaki_ket' => $request->kaki_ket,
            'aktivitas_ket' => $request->aktivitas_ket,
            'menangis_ket' => $request->menangis_ket,
            'bersuara_ket' => $request->bersuara_ket,
            'total_skor' => $request->total_skor,
            'interpretasi' => $request->interpretasi,
            'farmakologi' => $request->farmakologi,
            'non_farmakologi' => $request->non_farmakologi,
            'non_farmakologi_lain' => $request->non_farmakologi_lain,
            'nip' => session()->get('pegawai')->nik
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
