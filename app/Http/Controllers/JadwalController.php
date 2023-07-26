<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    function getHari()
    {
        $hari = date('D');

        switch ($hari) {
            case 'Sun':
                $hari = 'MINGGU';
                break;
            case 'Mon':
                $hari = 'SENIN';
                break;
            case 'Tue':
                $hari = 'SELASA';
                break;
            case 'Wed':
                $hari = 'RABU';
                break;
            case 'Thu':
                $hari = 'KAMIS';
                break;
            case 'Fri':
                $hari = 'JUMAT';
                break;
            case 'Sat':
                $hari = 'SABTU';
                break;
            default:
                $hari = '-';
                break;
        }
        return $hari;
    }

    function getJadwal($kd_dokter, $kd_poli)
    {
        $jadwal = Jadwal::where('kd_dokter', $kd_dokter)
            ->where('kd_poli', $kd_poli)
            ->where('hari_kerja', $this->getHari())->first();

        return $jadwal;
    }
}
