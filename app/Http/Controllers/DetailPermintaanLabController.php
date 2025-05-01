<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\DetailPermintaanLab;
use App\Models\PermintaanPemeriksaanLab;
use Illuminate\Database\QueryException;

class DetailPermintaanLabController extends Controller
{
    protected $permintaan;
    protected $pemeriksaan;
    protected $track;
    public function __construct()
    {
        $this->permintaan = new DetailPermintaanLab();
        $this->pemeriksaan = new PermintaanPemeriksaanLab();
        $this->track = new TrackerSqlController();
    }

    function create(Request $request): JsonResponse
    {
        foreach ($request->data as $item => $value) {
            $data = [
                'noorder' => $request->noorder,
                'id_template' => $value['id_template'],
                'kd_jenis_prw' => $value['kd_jenis_prw'],
                'stts_bayar' => 'Belum',
            ];
            try {
                $permintaan = $this->permintaan->create($data);
                if ($permintaan) {
                    $this->track->insertSql($this->permintaan, $data);
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
