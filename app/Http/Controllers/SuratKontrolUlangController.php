<?php

namespace App\Http\Controllers;

use App\Models\SuratKontrolUlang;
use Illuminate\Http\Request;

class SuratKontrolUlangController extends Controller
{
    public $suratKontrol;

    public function __construct()
    {
        $this->suratKontrol = new SuratKontrolUlang();
    }

    public function setBulanSurat($bulan)
    {
        switch ($bulan) {
            case '01':
                $bulan = 'I';
                break;
            case '02':
                $bulan = 'II';
                break;
            case '03':
                $bulan = 'III';
                break;
            case '04':
                $bulan = 'IV';
                break;
            case '05':
                $bulan = 'V';
                break;
            case '06':
                $bulan = 'VI';
                break;
            case '07':
                $bulan = 'VII';
                break;
            case '08':
                $bulan = 'VIII';
                break;
            case '09':
                $bulan = 'IX';
                break;
            case '10':
                $bulan = 'X';
                break;
            case '11':
                $bulan = 'XI';
                break;
            case '11':
                $bulan = 'XII';
                break;
            default:
                $bulan = '-';
                break;
        }
        return $bulan;
    }
    public function setNoSurat($poli = '')
    {
        $bulan = date('m');
        $tahun = date('Y');
        $suratKontrol = $this->suratKontrol->select('no_surat')
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)->orderBy('no_surat', 'DESC')->first();

        $bulanKontrol = $this->setBulanSurat($bulan);

        if ($suratKontrol) {
            $suratKontrol = explode('/', $suratKontrol->no_surat);
            $noSurat = sprintf("%05d", $suratKontrol[0] + 1);
            $suratKontrol = "$noSurat/RSIA/SKU/$poli/$bulanKontrol/$tahun";
        } else {
            $noSurat = sprintf("%05d", 1);
            $suratKontrol = "$noSurat/RSIA/SKU/$poli/$bulanKontrol/$tahun";
        }
        return $suratKontrol;
    }
    public function create(Request $request)
    {
        $data = [
            'no_surat' => $this->setNoSurat($request->jenis),
            'no_rkm_medis' => $request->no_rkm_medis,
            'no_rawat' => $request->no_rawat,
            'jenis' => $request->jenis,
            'tanggal' => $request->tanggal,
            'dokter' => $request->dokter,
        ];
        $suratKontrol = $this->suratKontrol->create($data);
        return response()->json($suratKontrol);
    }
}
