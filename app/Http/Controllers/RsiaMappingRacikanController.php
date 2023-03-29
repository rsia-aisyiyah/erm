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
    public function cari(Request $request)
    {
        $mapping = $this->mapping;

        $cari = $mapping->where('nama_racik', 'like', '%' . $request->nama_racik . '%')->groupBy('nama_racik')->get();

        return response()->json($cari);
    }
    public function ambil(Request $request)
    {
        $mapping = $this->mapping;

        $ambil = $mapping->where('nama_racik', $request->nama_racik)->get();
        return response()->json($ambil);
    }
}
