<?php

namespace App\Http\Controllers;

use App\Models\PermintaanLab;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

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
            $nomor = (int) $arrString[1] + 1;
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
        $permintaan = $this->permintaan->with([
            'pemeriksaan' => function ($q) {
                return $q->with(['jenis', 'detail.item', 'detail.dokter']);
            },
            'hasil' => function ($q) {
                return $q->with([
                    'jnsPerawatanLab',
                    'detail.template' => function ($q) {
                        return $q->orderBy('urut');
                    },
                    'saranKesan',
                    'petugas',
                    'dokter'
                ]);
            },
            'saranKesan'
        ])->orderBy('noorder', 'desc');

        if ($request->noorder) {
            $permintaan = $permintaan->where('noorder', $request->noorder)
                ->first();
        } else if ($request->tgl_hasil && $request->jam_hasil) {
            $permintaan = $permintaan->where('no_rawat', $request->no_rawat)
                ->where('tgl_permintaan', $request->tgl_hasil)
                ->where('jam_permintaan', $request->jam_hasil)
                ->first();
        } else {
            $permintaan = $permintaan->where('no_rawat', $request->no_rawat)
                ->get();
        }
        return response()->json($permintaan);
    }

    function getDataTable(Request $request)
    {
        $permintaan = $this->permintaan->with([
            'pemeriksaan.jenis',
            'regPeriksa' => function ($q) {
                return $q->with(['pasien', 'penjab']);
            },
            'dokter'
        ]);


        if ($request) {
            $permintaan->whereBetween('tgl_permintaan', [date('Y-m-d', strtotime($request->tgl_pertama)), date('Y-m-d', strtotime($request->tgl_kedua))]);
        } else {
            $permintaan->where('tgl_permintaan', date('Y-m-d'));
        }
        return DataTables::of($permintaan)->make(true);
    }


}
