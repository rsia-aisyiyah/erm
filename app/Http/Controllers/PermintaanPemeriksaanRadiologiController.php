<?php

namespace App\Http\Controllers;

use App\Models\PermintaanPemeriksaanRadiologi;
use App\Models\PermintaanRadiologi;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class PermintaanPemeriksaanRadiologiController extends Controller
{
    protected $track;
    protected $pemeriksaan;
    public function __construct()
    {
        $this->track = new TrackerSqlController();
        $this->pemeriksaan = new PermintaanPemeriksaanRadiologi();
    }
    function create(Request $request)

    {
        $data = [
            'noorder' => $request->noorder,
            'kd_jenis_prw' => $request->kd_jenis_prw,
            'stts_bayar' => 'Belum Bayar',
        ];

        try {
            $create = $this->pemeriksaan->create($data);
            if ($create) {
                $this->track->insertSql($this->pemeriksaan, $data);
            }
            return response()->json('SUKSES');
        } catch (QueryException $e) {
            return response()->json($e->errorInfo, 500);
        }
    }

    function get(Request $request)
    {
        $pemeriksaan = $this->pemeriksaan->where('noorder', $request->noorder)->get();
        return response()->json($pemeriksaan);
    }
}
