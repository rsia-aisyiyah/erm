<?php

namespace App\Http\Controllers;

use App\Models\AsesmenNyeriBalita;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class AsesmenNyeriBalitaController extends Controller
{
    protected $track;
    protected $model;

    public function __construct()
    {
        $this->model = new AsesmenNyeriBalita();
        $this->track = new TrackerSqlController();
    }
    function create(Request $request)
    {
        $validate = $request->validate([
            'tanggal' => 'required',
            'pemicu' => 'required',
            'kualitas' => 'required',
            'lokasi' => 'required',
            'penanganan_non_farmakologi' => 'required',
            'skala' => 'required',
            'waktu' => ['required', 'min:5'],
        ]);

        $data = [
            'no_rawat' => $request->no_rawat,
            'tanggal' => date('Y-m-d H:i:s', strtotime($request->tanggal)),
            'pemicu' => $request->pemicu,
            'pemicu_lain' => $request->pemicu_lain,
            'kualitas' => $request->kualitas,
            'kualitas_lain' => $request->kualitas_lain,
            'lokasi' => $request->lokasi,
            'lokasi_lain' => $request->lokasi_lain,
            'penanganan_farmakologi' => $request->penanganan_farmakologi,
            'penanganan_non_farmakologi' => $request->penanganan_non_farmakologi,
            'penanganan_non_farmakologi_lain' => $request->penanganan_non_farmakologi_lain,
            'skala' => (int)$request->skala,
            'ket_skala' => $request->ket_skala,
            'waktu' => $request->waktu,
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
            return response()->json('Success', 201);
        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
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

    function update(Request $request)
    {
        $validate = $request->validate([
            'tanggal' => 'required',
            'pemicu' => 'required',
            'kualitas' => 'required',
            'lokasi' => 'required',
            'penanganan_non_farmakologi' => 'required',
            'skala' => 'required',
            'waktu' => ['required', 'min:5'],
        ]);

        $data = [
            'pemicu' => $request->pemicu,
            'pemicu_lain' => $request->pemicu_lain,
            'kualitas' => $request->kualitas,
            'kualitas_lain' => $request->kualitas_lain,
            'lokasi' => $request->lokasi,
            'lokasi_lain' => $request->lokasi_lain,
            'penanganan_farmakologi' => $request->penanganan_farmakologi,
            'penanganan_non_farmakologi' => $request->penanganan_non_farmakologi,
            'penanganan_non_farmakologi_lain' => $request->penanganan_non_farmakologi_lain,
            'skala' => (int)$request->skala,
            'ket_skala' => $request->ket_skala,
            'waktu' => $request->waktu,
        ];


        $key = ['no_rawat' => $request->no_rawat, 'tanggal' => date('Y-m-d H:i:s', strtotime($request->tanggal)), 'nip' => session()->get('pegawai')->nik];
        try {
            $update = $this->model->where($key)->update($data);
            if ($update) {
                $this->track->updateSql($this->model, $data, $key);
            }
            return response()->json(['message' => 'Success', 'data' => $data], 200);
        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    function delete(Request $request)
    {
        $keys = [
            'no_rawat' => $request->no_rawat,
            'tanggal' => $request->tanggal,
            'nip' => session()->get('pegawai')->nik
        ];

        try {
            $model = $this->model->where($keys)->delete();
            if ($model) {
                $this->track->deleteSql($this->model, $keys);
            }
        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
        return response()->json('Success', 200);
    }
}
