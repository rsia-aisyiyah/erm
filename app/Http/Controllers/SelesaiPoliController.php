<?php

namespace App\Http\Controllers;

use App\Models\SelesaiPoli;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SelesaiPoliController extends Controller
{
    private $tanggal;
    public function __construct()
    {
        $this->tanggal = new Carbon();
    }

    public function cari($no_rawat)
    {
        return $selesai = SelesaiPoli::where('no_rawat', $no_rawat)->first();
    }

    public function kirim(Request $request)
    {
        $no_rawat = $request->no_rawat;
        $jam_periksa = $this->tanggal->now()->toDateTimeString();
        $cekSelesai = SelesaiPoli::where('no_rawat', $no_rawat)->first();
        if ($cekSelesai) {
            $selesai = SelesaiPoli::where('no_rawat', $no_rawat)->update([
                'jam_periksa' => $jam_periksa,
            ]);
        } else {
            $selesai = SelesaiPoli::create([
                'no_rawat' => $no_rawat,
                'jam_periksa' => $jam_periksa,
            ]);
        }
        app('App\Http\Controllers\RegPeriksaController')->statusDaftar($no_rawat, 'Sudah');
        return response()->json(['no_rawat' => $no_rawat, 'jam_periksa' => $jam_periksa, 'status' => 'Selesai'], 200);
    }
}
