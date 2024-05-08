<?php

namespace App\Http\Controllers;

use App\Models\PermintaanLab;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PermintaanLabController extends Controller
{
    protected $permintaan;
    protected $track;
    public function __construct()
    {
        $this->permintaan = new PermintaanLab();
        $this->track = new TrackerSqlController();
    }
    function getNomor(): string
    {
        $permintaan = $this->permintaan
            ->where('tgl_permintaan', date('Y-m-d'))
            ->select('noorder')->orderBy('noorder', 'desc')->first();
        if ($permintaan == null) {
            $now = date('Ymd');
            $nomor = "PK{$now}0001";
        } else {
            $arrString = explode('PK', $permintaan->noorder);
            $nomor =  (int)$arrString[1] + 1;
            $nomor = "PK{$nomor}";
        }
        return $nomor;
    }

    function create(Request $request): JsonResponse
    {
        $data = [
            'noorder' => $this->getNomor(),
            'no_rawat' => $request->no_rawat,
            'tgl_permintaan' => date('Y-m-d'),
            'jam_permintaan' => date('H:i:s'),
            'dokter_perujuk' => $request->kd_dokter,
            'status' => $request->status,
            'informasi_tambahan' => $request->informasi_tambahan,
            'diagnosa_klinis' => $request->diagnosa_klinis,
        ];
        try {
            $permintaan = $this->permintaan->create($data);
            if ($permintaan) {
                $this->track->insertSql($this->permintaan, $data);
            }
            return response()->json([
                'status' => true,
                'message' => $permintaan->noorder
            ]);
        } catch (QueryException $e) {
            return response()->json($e->errorInfo, 500);
        }
    }

    function get(Request $request): JsonResponse
    {
        $permintaan = $this->permintaan->where('no_rawat', $request->no_rawat)
            ->with(['pemeriksaan' => function ($q) {
                return $q->with(['jenis', 'detail.item']);
            }])
            ->get();
        return response()->json($permintaan);
    }
}
