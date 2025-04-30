<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ResepDokterRacikan;
use App\Http\Controllers\Controller;
use App\Models\ResepDokterRacikanDetail;
use App\Http\Controllers\TrackerSqlController;
use App\Http\Controllers\ResepDokterRacikanDetailController;

class ResepDokterRacikanController extends Controller
{
    protected $track;
    protected $resep;
    protected $resepDetail;
    public function __construct()
    {
        $this->track = new TrackerSqlController;
        $this->resep = new ResepDokterRacikan();
        $this->resepDetail = new ResepDokterRacikanDetailController();
    }
    public function ambil(Request $request)
    {
        $resepDokter = new ResepDokterRacikan();
        $hasil = '';
        if ($request->no_resep) {
            if ($request->no_racik) {
                $hasil = $resepDokter->where('no_resep', $request->no_resep)->where('no_racik', $request->no_racik)->with(['metode', 'detailRacikan' => function ($q) use ($request) {
                    $q->where('no_racik', $request->no_racik);
                }])->first();
            } else {
                $hasil = $resepDokter->where('no_resep', $request->no_resep)->with(['metode', 'detailRacikan'])->get();
            }
        }
        return response()->json($hasil, 200);
    }
    public function simpan(Request $request)
    {
        $data = [
            'no_resep' => $request->no_resep,
            'no_racik' => $request->no_racik,
            'nama_racik' => $request->nama_racik,
            'kd_racik' => $request->kd_racik,
            'jml_dr' => $request->jml_dr,
            'aturan_pakai' => $request->aturan_pakai,
            'keterangan' => $request->keterangan,
        ];


        $resep = ResepDokterRacikan::create($data);
        $this->track->insertSql($this->resep, $data);
        return response()->json($resep);
    }

    public function hapus(Request $request)
    {
        $clause = [
            'no_racik' => $request->no_racik,
            'no_resep' => $request->no_resep
        ];
        $resepDetail = $this->resepDetail->hapus($request);
        $resep = ResepDokterRacikan::where($clause)->delete();
        $this->track->deleteSql($this->resep, $clause);
        return response()->json($resep);
    }
    public function ubah(Request $request)
    {
        $clause = [
            'no_racik' => $request->no_racik,
            'no_resep' => $request->no_resep,
        ];
        $data = [
            'nama_racik' => $request->nama_racik,
            'aturan_pakai' => $request->aturan_pakai,
        ];
        $resep = ResepDokterRacikan::where($clause)->update($data);
        $this->track->updateSql($this->resep, $data, $clause);
        return response()->json($request);
    }
}
