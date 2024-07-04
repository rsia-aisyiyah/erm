<?php

namespace App\Http\Controllers;

use App\Models\ProsedurPasien;
use App\Traits\JsonResponseTrait;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ProsedurPasienController extends Controller
{
    use JsonResponseTrait;
    private $prosedur;
    private $track;
    public function __construct()
    {
        $this->prosedur = new ProsedurPasien();
        $this->track = new TrackerSqlController();
    }

    public function ambil(Request $request)
    {
        $prosedur = $this->prosedur->with('icd9')->where('no_rawat', $request->no_rawat)->get();

        return response()->json($prosedur);
    }

    public function tambah(Request $request)
    {
        $prosedur = $this->prosedur->where('no_rawat', $request->no_rawat)->get();
        $countProsedur  = $prosedur->count();
        $prioritas = 1;

        if ($countProsedur) {
            $prioritas = $countProsedur + 1;
        }

        $data = [
            'no_rawat' => $request->no_rawat,
            'kode' => $request->kode,
            'status' => $request->status,
            'prioritas' => $prioritas,
        ];
        try {
            $this->prosedur->create($data);
        } catch (QueryException $e) {
            return $this->errorResponse('Gagal menambahkan prosedur', 500, $e->errorInfo);
        }
        $this->track->insertSql($this->prosedur, $data);
        return $this->successResponse($data, 'Berhasil', 201);
    }

    public function hapus(Request $request)
    {
        $clause = [
            'no_rawat' => $request->no_rawat,
            'kode' => $request->kode,
        ];
        try {

            $prosedur = $this->prosedur
                ->where($clause)
                ->delete();
        } catch (QueryException $e) {
            return $this->errorResponse('Gagal menghapus prosedur', 500, $e->errorInfo);
        }
        $this->track->deleteSql($this->prosedur, $clause);
        return $this->successResponse($prosedur, 'Berhasil menghapus data prosedur');
    }
}
