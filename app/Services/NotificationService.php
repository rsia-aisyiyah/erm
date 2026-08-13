<?php

namespace App\Services;

use App\Models\PemeriksaanRanap;
use App\Models\PermintaanLab;
use App\Models\RsiaHasilKritis;
use Illuminate\Support\Facades\Auth;

class NotificationService
{
    public function getSbarCount()
    {
        if (!Auth::check())
            return 0;

        return PemeriksaanRanap::with(
            'sbar.dokterKonsul',
            'verifikasi'
        )->whereDoesntHave('verifikasi')
            ->whereHas('sbar.dokterKonsul', function ($query) {
                $query->where('dokter', session()->get('pegawai')->nik);

            })
            ->whereMonth('tgl_perawatan', date('m'))
            ->whereYear('tgl_perawatan', date('Y'))
            ->count();
    }

    public function getSbar()
    {
        if (!Auth::check())
            return 0;

        return PemeriksaanRanap::whereHas('verifikasi')
            ->with(
                'sbar.dokterKonsul',
                'verifikasi'
            )
            ->whereHas('sbar', function ($query) {
                $query->where('nip', session()->get('pegawai')->nik);
            })
            ->get();
    }

    public function getHasilKritisCount()
    {
        // 1. Cek apakah user sudah login
        if (!Auth::check() || !session()->has('pegawai')) {
            return 0;
        }

        $pegawai = session()->get('pegawai');
        $nik = $pegawai->nik;

        // 2. Notifikasi HANYA muncul untuk user spesifik (Petugas Ruang, DPJP, atau PJ Lab)
        //    yang tercatat pada data hasil kritis tersebut DAN belum melakukan verifikasi.
        return RsiaHasilKritis::whereMonth('tgl', date('m'))
            ->whereYear('tgl', date('Y'))
            ->where(function ($q) use ($nik) {
                // Petugas Ruangan belum verifikasi
                $q->where(function ($sub) use ($nik) {
                    $sub->where('petugas_ruang', $nik)
                        ->where(function ($empty) {
                            $empty->whereNull('tgl_ruang')
                                ->orWhere('tgl_ruang', '0000-00-00 00:00:00');
                        });
                })
                // Dokter DPJP belum verifikasi
                ->orWhere(function ($sub) use ($nik) {
                    $sub->where('dokter', $nik)
                        ->where(function ($empty) {
                            $empty->whereNull('tgl_dokter')
                                ->orWhere('tgl_dokter', '0000-00-00 00:00:00');
                        });
                })
                // Dokter PJ Lab/Rad belum verifikasi
                ->orWhere(function ($sub) use ($nik) {
                    $sub->where('dokter_pj', $nik)
                        ->where(function ($empty) {
                            $empty->whereNull('tgl_drpj')
                                ->orWhere('tgl_drpj', '0000-00-00 00:00:00');
                        });
                });
            })
            ->count();
    }

    function getPermintaanLabDoesntHaveSaran()
    {
        $query = PermintaanLab::whereDoesntHave('detailSaran')
            ->whereHas('hasil')
            ->whereMonth('tgl_permintaan', date('m'))
            ->whereYear('tgl_permintaan', date('Y'))
            ->count();

        return $query;

    }
}