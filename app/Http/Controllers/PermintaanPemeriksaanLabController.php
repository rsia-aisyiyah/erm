<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\QueryException;
use App\Models\PermintaanPemeriksaanLab;

class PermintaanPemeriksaanLabController extends Controller
{

    protected $pemeriksaan;
    protected $track;
    public function __construct()
    {
        $this->pemeriksaan = new PermintaanPemeriksaanLab();
        $this->track = new TrackerSqlController();
    }
    function create(Request $request): JsonResponse
    {
        foreach ($request->data as $item => $value) {
            try {
                $pemeriksaan = $this->pemeriksaan->create($value);
                if ($pemeriksaan) {
                    $this->track->insertSql($this->pemeriksaan, $value);
                }
                $return =  response()->json([
                    'status' => 'Sukses',
                    'message' => 'Data berhasil disimpan'
                ]);
            } catch (QueryException $e) {
                $return =  response()->json($e->errorInfo, 500);
            }
        }
        return $return;
    }
}
