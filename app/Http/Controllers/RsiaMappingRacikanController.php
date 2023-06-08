<?php

namespace App\Http\Controllers;

use App\Models\RsiaMappingRacikan;
use Illuminate\Http\Request;

class RsiaMappingRacikanController extends Controller
{
    private $mapping;
    public function __construct()
    {
        $this->mapping = new RsiaMappingRacikan();
    }
    public function index()
    {
        return view('content.farmasi.racikan');
    }
    public function cari(Request $request)
    {
        $mapping = $this->mapping;

        $cari = $mapping->where('nm_racik', 'like', '%' . $request->nm_racik . '%')
            ->where('kd_dokter', $request->kd_dokter)->with(['detailRacik'])->get();

        return response()->json($cari);
    }
    // public function ambilId(Type $var = null)
    // {
    //     # code...
    // }
    public function ambil(Request $request)
    {
        // return $request;
        $mapping = $this->mapping->with(['dokter', 'detailRacik.dataBarang']);

        if ($request->nm_racik) {
            $ambil = $mapping->where('nm_racik', $request->nm_racik)->get();
        }

        if ($request->kd_dokter) {
            $ambil = $mapping->where('kd_dokter', $request->kd_dokter)->get();
        }
        if ($request->id) {
            $ambil = $mapping->where('id', $request->id)->first();
        }

        if (!$request->kd_dokter && !$request->nm_racik && !$request->id) {
            $ambil = $mapping->get();
        }

        // $result = $mapping->get();
        return response()->json($ambil);
    }
    public function tambah(Request $request)
    {
        $mapping = $this->mapping->create([
            'kd_dokter' => $request->kd_dokter,
            'nm_racik' => $request->nm_racik,
        ]);
        return response()->json($mapping);
    }
}
