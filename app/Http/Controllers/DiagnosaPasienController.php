<?php

namespace App\Http\Controllers;

use App\Models\DiagnosaPasien;
use App\Traits\JsonResponseTrait;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class DiagnosaPasienController extends Controller
{

    use JsonResponseTrait;

    protected $track;
    protected $diagnosa;
    public function __construct()
    {
        $this->track = new TrackerSqlController();
        $this->diagnosa = new DiagnosaPasien();
    }
    public function tambah(Request $request)
    {

        $diagnosa = $this->diagnosa->where('no_rawat', $request->no_rawat)->get();
        $countDiagnosa  = $diagnosa->count();
        $prioritas = 1;
        if ($countDiagnosa) {
            $prioritas = $countDiagnosa + 1;
        }

        $data = [
            'no_rawat' => $request->no_rawat,
            'kd_penyakit' => $request->kd_penyakit,
            'status' => $request->status,
            'prioritas' => $prioritas,
        ];

        try {
            $penyakit = $this->diagnosa->create($data);
        } catch (QueryException $e) {
            return $this->errorResponse('Gagal menambahkan diagnosa', 500, $e->errorInfo);
        }
        $this->track->insertSql($this->diagnosa, $data);
        return $this->successResponse($penyakit, 'Berhasil', 201);
    }

    public function ambil(Request $request)
    {

        $penyakit = $this->diagnosa->with('penyakit')
            ->where('no_rawat', $request->no_rawat)
            ->orderBy('prioritas', 'ASC')->get();

        return response()->json($penyakit);
    }
    public function hapus(Request $request)
    {

        try {
            $penyakit = $this->diagnosa->where('no_rawat', $request->no_rawat)
                ->where('kd_penyakit', $request->kd_penyakit)->delete();
        } catch (QueryException $e) {
            return $this->errorResponse('Gagal menghapus diagnosa', 500, $e->errorInfo);
        }
        $this->track->deleteSql($this->diagnosa, ['no_rawat' => $request->no_rawat, 'kd_penyakit' => $request->kd_penyakit]);
        return $this->successResponse();
    }
}
