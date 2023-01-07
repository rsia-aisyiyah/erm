<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\EstimasiPoli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class EstimasiPoliController extends Controller
{
    // public $regPeriksa = app('App\Http\Controllers\RegPeriksaController')->status();

    public function cari($no_rawat)
    {
        $estimasi = EstimasiPoli::where('no_rawat', $no_rawat)->first();
        return $estimasi;
    }
    public function kirim(Request $request)
    {
        $tanggal = new Carbon();
        $no_rawat = $request->no_rawat;
        $jam_periksa = $tanggal->now()->toDateTimeString();

        if ($this->cari($no_rawat)) {
            $estimasi = EstimasiPoli::where('no_rawat', $no_rawat)->update(['jam_periksa' => $jam_periksa]);
        } else {
            $estimasi = EstimasiPoli::create(
                [
                    'no_rawat' => $no_rawat,
                    'jam_periksa' => $jam_periksa,
                ]
            );
        }
        app('App\Http\Controllers\RegPeriksaController')->statusDaftar($no_rawat, 'Berkas Diterima');
        return response()->json(['no_rawat' => $no_rawat, 'jam_periksa' => $jam_periksa], 200);
    }
}
