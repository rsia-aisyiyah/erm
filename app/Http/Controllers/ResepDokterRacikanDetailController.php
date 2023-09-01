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
        if ($request->kode_brng) {
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

        $this->track->deleteSql($this->resep, $clause);
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
        $this->track->insertSql($this->resep, $data);
        return response()->json($racikan);
    }
    public function ubah(Request $request)
    {
        $clause = [
            'no_resep' => $request->no_resep,
            'no_racik' => $request->no_racik,
            'kode_brng' => $request->kode_brng
        ];
        $data = [
            'kode_brng' => $request->kode_brng,
            'p1' => $request->p1,
            'p2' => $request->p2,
            'kandungan' => $request->kandungan,
            'jml' => $request->jml,
        ];
        $cekRacik = ResepDokterRacikanDetail::where($clause)->count();
        if ($cekRacik == 0) {
            $racik = $this->simpan($request);
            $this->track->insertSql($this->resep, $request->except('_token'));
        } else {
            $racik =  ResepDokterRacikanDetail::where($clause)->update($data);
            $this->track->updateSql($this->resep, $data, $clause);
        }
        return response()->json($racik);
    }
}
