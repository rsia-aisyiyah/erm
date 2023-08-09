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
            $hasil = $resep->where('no_resep', $request->no_resep)->where('no_racik', $request->no_racik)->where('kode_brng', $request->kode_brng)->delete();
        } else {
            $hasil = $resep->where('no_resep', $request->no_resep)->where('no_racik', $request->no_racik)->delete();
        }
        return response()->json($hasil);
    }
    public function simpan(Request $request)
    {
        $racikan = ResepDokterRacikanDetail::create([
            'no_resep' => $request->no_resep,
            'no_racik' => $request->no_racik,
            'kode_brng' => $request->kode_brng,
            'p1' => $request->p1,
            'p2' => $request->p2,
            'kandungan' => $request->kandungan,
            'jml' => $request->jml,
        ]);
        return response()->json($racikan);
    }
    public function ubah(Request $request)
    {
        $cekRacik = ResepDokterRacikanDetail::where('no_resep', $request->no_resep)
            ->where('no_racik', $request->no_racik)
            ->where('kode_brng', $request->kode_brng)->count();
        if ($cekRacik == 0) {
            $racik = $this->simpan($request);
        } else {
            $racik =  ResepDokterRacikanDetail::where('no_resep', $request->no_resep)
                ->where('no_racik', $request->no_racik)
                ->where('kode_brng', $request->kode_brng)->update([
                    'kode_brng' => $request->kode_brng,
                    'p1' => $request->p1,
                    'p2' => $request->p2,
                    'kandungan' => $request->kandungan,
                    'jml' => $request->jml,
                ]);
        }
        return response()->json($racik);
    }
}
