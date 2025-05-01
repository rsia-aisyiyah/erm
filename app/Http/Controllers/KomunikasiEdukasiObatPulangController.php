<?php

namespace App\Http\Controllers;

use App\Models\KomunikasiEdukasiObatPulang;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class KomunikasiEdukasiObatPulangController extends Controller
{
    protected $track;
    protected $model;

    public function __construct()
    {
        $this->track = new TrackerSqlController();
        $this->model = new KomunikasiEdukasiObatPulang();
    }

    public function create(Request $request)
    {
        $data = [
            'no_rawat' => $request->no_rawat,
            'kode_brng' => $request->kode_brng,
            'tgl' => date('Y-m-d H:i:s'),
            'jml' => $request->jml,
            'aturan' => $request->aturan_pakai,
            'intruksi' => $request->instruksi,
            'keterangan' => $request->keterangan,
            'pagi' => array_search('Pagi', $request->waktu) !== false ? 1 : 0,
            'siang' => array_search('Siang', $request->waktu) !== false ? 1 : 0,
            'sore' => array_search('Sore', $request->waktu) !== false ? 1 : 0,
            'malam' => array_search('Malam', $request->waktu) !== false ? 1 : 0,
            'nip' => session()->get('pegawai')->nik,
        ];

        try {
            $create = $this->model->create($data);
            if ($create) {
                $this->track->insertSql($this->model, $data);
            }
        } catch (QueryException $e) {
            return response()->json($e->errorInfo, 500);
        }
        return response()->json('SUKSES' . 200);

    }

    public function get(Request $request)
    {
        $query = $this->model->where('no_rawat', $request->no_rawat)
            ->with(['obat' => function ($query) {
                return $query->select(['kode_brng', 'nama_brng']);
            }, 'petugas'])
            ->get();
        return response()->json($query);
    }

    public function delete(Request $request)
    {
        $clause = [
            'no_rawat' => $request->no_rawat,
            'kode_brng' => $request->kode_brng,
            'nip' => $request->nip,
        ];

        if ($request->nip !== session()->get('pegawai')->nik) {
            return response()->json('Anda tidak dapat menghapus data ini', 500);
        }
        try {
            $delete = $this->model->where($clause)->delete();
            if ($delete) {
                $this->track->deleteSql($this->model, $clause);
            }
        } catch (QueryException $e) {
            return response()->json($e->errorInfo, 500);
        }
        return response()->json('SUKSES', 200);

    }

}
