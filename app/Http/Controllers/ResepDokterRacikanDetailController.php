<?php

namespace App\Http\Controllers;

use App\Models\ResepDokterRacikanDetail;
use Illuminate\Http\Request;

class ResepDokterRacikanDetailController extends Controller
{
    public $resep;
    public $track;
    public function __construct()
    {
        $this->resep = new ResepDokterRacikanDetail();
        $this->track = new TrackerSqlController();
    }
    public function ambil(Request $request)
    {
        $resep = $this->resep;
        if ($request->no_resep) {
            if ($request->no_racik) {
                $hasil = $resep->where('no_resep', $request->no_resep)->where('no_racik', $request->no_racik)->with('dataBarang')->get();
            } else {
                $hasil = $resep->where('no_resep', $request->no_resep)->with('dataBarang')->get();
            }
        }
        return response()->json($hasil);
    }
    public function hapus(Request $request)
    {
        $resep = $this->resep;
        if ($request->no_resep && $request->no_racik) {
            $clause = [
                'no_racik' => $request->no_racik,
                'no_resep' => $request->no_resep,
            ];
        } else if ($request->kode_brng) {
            $clause = [
                'no_racik' => $request->no_racik,
                'kode_brng' => $request->kode_brng
            ];
        } else {
            $clause = [
                'no_racik' => $request->no_racik,
            ];
        }
        $hasil = $resep->where($clause)->delete();
        if ($hasil) {
            $this->track->deleteSql($this->resep, $clause);
        }
        return response()->json($hasil);
    }
    public function simpan(Request $request)
    {
        $data = [
            'no_resep' => $request->no_resep,
            'no_racik' => $request->no_racik,
            'kode_brng' => $request->kode_brng,
            'p1' => $request->p1,
            'p2' => $request->p2,
            'kandungan' => $request->kandungan,
            'jml' => $request->jml,
        ];
        $racikan = ResepDokterRacikanDetail::create($data);
        if ($racikan) {
            $this->track->insertSql($this->resep, $data);
            return response()->json($racikan);
        }
    }
    public function ubah(Request $request)
    {
        $clause = [
            'no_resep' => $request->no_resep,
            'no_racik' => $request->no_racik,
        ];
        $cekRacik = ResepDokterRacikanDetail::where($clause);
        if ($cekRacik->count()) {
            $this->hapus($request);
        }
        for ($i = 0; $i < sizeof($request->kode_brng); $i++) {
            $data = [
                'no_resep' => $request->no_resep,
                'no_racik' => $request->no_racik,
                'kode_brng' => $request->kode_brng[$i],
                'p1' => $request->p1[$i],
                'p2' => $request->p2[$i],
                'kandungan' => $request->kandungan[$i],
                'jml' => $request->jml[$i],
            ];
            $insert = ResepDokterRacikanDetail::insert($data);
            if ($insert) {
                $this->track->insertSql($this->resep, $data);
            }
        }
        return response()->json($insert);
    }
}
