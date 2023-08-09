<?php

namespace App\Http\Controllers;

use App\Models\LaporanOperasi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LaporanOperasiController extends Controller
{
    protected $laporan;
    protected $carbon;

    public function __construct()
    {
        $this->laporan = new LaporanOperasi();
        $this->carbon = new Carbon();
    }

    public function get($noRawat)
    {
        $noRawat = str_replace("-", "/", $noRawat);
        $laporan = $this->laporan->where('no_rawat', $noRawat)->first();

        return $data = [
            'tanggal' => $this->carbon->parse($laporan->tanggal)->translatedFormat('d F Y H:i:s'),
            'selesaioperasi' => $this->carbon->parse($laporan->tanggal)->translatedFormat('d F Y H:i:s'),
            'laporan_operasi' => nl2br($laporan->laporan_operasi),
            'diagnosa_preop' => $laporan->diagnosa_preop,
            'diagnosa_postop' => $laporan->diagnosa_postop,
            'permintaan_pa' => $laporan->permintaan_pa,
            'jaringan_dieksekusi' => $laporan->jaringan_dieksekusi,
            'selesai' => $laporan->diagnosa_postop,
        ];
    }
}
