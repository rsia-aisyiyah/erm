<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RsiaGrafikHarianController extends Controller
{
    protected $model;   
    protected $track;

    public function __construct() {
        $this->model = new \App\Models\RsiaGrafikHarian();
        $this->track = new \App\Http\Controllers\TrackerSqlController();
    }

    function store(Request $request) {
        $now = new \Illuminate\Support\Carbon();
        $timeNow = $now->format('H:i:s');
        $dateNow = $now->format('Y-m-d');
        $data = [
            'no_rawat' => $request->no_rawat,
            'tgl_perawatan' => $dateNow,
            'jam_rawat' => $timeNow,

            'suhu_tubuh' => $request->suhu_tubuh,
            'tensi' => $request->tensi,
            'nadi' => $request->nadi,
            'respirasi' => $request->respirasi,

            'spo2' => $request->spo2,
            'o2' => $request->o2,
            'gcs' => $request->gcs,
            'kesadaran' => $request->kesadaran,

            'sumber' => "-",
        ];

        // get session
        $session = session()->get('pegawai');
        $data['nip'] = $session['petugas']['nip'];

        // insert to database
        $grafikHarian = $this->model->create($data);
        $this->track->create($this->track->insertSql($this->model, $data));

        // if success return success
        if ($grafikHarian) {
            return response()->json([
                'success' => true,
                'no_rawat' => $request->no_rawat,
                'message' => 'Berhasil menambahkan data grafik harian',
                'data' => $grafikHarian
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan data grafik harian',
            ], 400);
        }
    }
}
