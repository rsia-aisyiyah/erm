<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RsiaGrafikHarianController extends Controller
{
    protected $model;
    protected $track;

    public function __construct()
    {
        $this->model = new \App\Models\RsiaGrafikHarian();
        $this->track = new \App\Http\Controllers\TrackerSqlController();
    }

    function store(Request $request)
    {
        $now = new \Illuminate\Support\Carbon();
        $timeNow = $now->format('H:i:s');
        $dateNow = $now->format('Y-m-d');

        // if request action isset and action is update
        if (isset($request->action) && $request->action == 'update') {
            $timeNow = $request->jam_rawat;
            $dateNow = $request->tgl_perawatan;
        }

        // return $request->all();
        $data = [
            'no_rawat' => $request->no_rawat,
            'tgl_perawatan' => $request->tgl_perawatan ? $request->tgl_perawatan : $dateNow,
            'jam_rawat' => $request->jam_rawat ? $request->jam_rawat : $timeNow,

            'suhu_tubuh' => $request->suhu_tubuh,
            'tensi' => $request->tensi,
            'nadi' => $request->nadi,
            'respirasi' => $request->respirasi,

            'spo2' => $request->spo2,
            'o2' => $request->o2,
            'gcs' => $request->gcs,
            'kesadaran' => $request->kesadaran,
        ];

        if (!isset($request->action)) {
            $data['sumber'] = "-";

            // get session
            $session = session()->get('pegawai');
            $data['nip'] = $session['petugas']['nip'];

            // insert to database
            $grafikHarian = $this->model->create($data);
            $this->track->insertSql($this->model, $data);
        } else {
            $clause = [
                'no_rawat' => $request->no_rawat,
                'tgl_perawatan' => $request->tgl_perawatan,
                'jam_rawat' => $request->jam_rawat,
            ];

            // update to database
            $grafikHarian = $this->model->where($clause)->update($data);
            $this->track->updateSql($this->model, $clause, $data);
        }


        // // if success return success
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

    function delete(Request $request, $sumber = '-')
    {
        $clause = [
            'no_rawat' => $request->no_rawat,
            'tgl_perawatan' => $request->tgl_perawatan,
            'jam_rawat' => $request->jam_rawat,
        ];
        $data = $this->model->where($clause)->delete();
        $this->track->deleteSql($this->model, $clause);

        if ($data) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil menghapus data grafik harian',
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data grafik harian',
            ], 400);
        }
    }

    function updateSbar(Request $request){
        $clause = [
            'no_rawat' => $request->no_rawat,
            'tgl_perawatan' => $request->tgl_perawatan_awal,
            'jam_rawat' => $request->jam_rawat_awal,
        ];

        $data = [
            'tgl_perawatan' => $request->tgl_perawatan,
            'jam_rawat' => $request->jam_rawat,
            'sumber' => $request->sumber,
        ];

        try{
            DB::transaction(function () use ($data, $clause, $request)  {
                    $grafikHarian = $this->model->where($clause)->update($data);
                    $this->track->updateSql($this->model, $clause, $data);
            });
           
        }catch(QueryException $e){
            return response()->json($e->errorInfo, 500);
        }

        return response()->json('Berhasil Update', 200);
        
    }
}
