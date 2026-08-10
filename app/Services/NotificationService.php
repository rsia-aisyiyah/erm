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

        $isDireksi = in_array(strtolower($nik), ['direksi', 'admin', 'verifikator'])
            || in_array($pegawai->jnj_jabatan ?? '', ['DIRU', 'DIR', 'DIRT'])
            || in_array($pegawai->departemen ?? '', ['DIR', 'DPM1', 'DPM2', 'DM1', 'DM7', 'CSM', 'SPS']);

        // 2. Bangun query dasar
        $query = RsiaHasilKritis::query();

        if ($isDireksi) {
            // JIKA DIREKSI / ADMIN: Hitung seluruh data RS yang belum selesai diverifikasi
            $query->where(function ($q) {
                $q->whereNull('tgl_ruang')
                    ->orWhere('tgl_ruang', '0000-00-00 00:00:00')
                    ->orWhereNull('tgl_dokter')
                    ->orWhere('tgl_dokter', '0000-00-00 00:00:00')
                    ->orWhereNull('tgl_drpj')
                    ->orWhere('tgl_drpj', '0000-00-00 00:00:00');
            });
        } else {
            // Tentukan apakah user adalah Dokter
            $isDokter = isset($pegawai->kd_sps) || (isset($pegawai->jbtn) && str_contains(strtolower($pegawai->jbtn), 'dokter'));

            if ($isDokter) {
                // JIKA DOKTER: Hitung penugasan sebagai DPJP Utama ATAU sebagai PJ Lab/Radiologi
                $query->where(function ($q) use ($nik) {
                    $q->where(function ($sub) use ($nik) {
                        $sub->where('dokter', $nik)
                            ->where(function ($empty) {
                                $empty->whereNull('tgl_dokter')
                                    ->orWhere('tgl_dokter', '0000-00-00 00:00:00');
                            });
                    })
                    ->orWhere(function ($sub) use ($nik) {
                        $sub->where('dokter_pj', $nik)
                            ->where(function ($empty) {
                                $empty->whereNull('tgl_drpj')
                                    ->orWhere('tgl_drpj', '0000-00-00 00:00:00');
                            });
                    });
                });
            } else {
                // JIKA PETUGAS RUANG
                $query->where('petugas_ruang', $nik)
                    ->where(function ($q) {
                        $q->whereNull('tgl_ruang')
                            ->orWhere('tgl_ruang', '0000-00-00 00:00:00');
                    });
            }
        }

        // 4. Kembalikan total data yang belum diverifikasi pada bulan berjalan
        return $query
            ->whereMonth('tgl', date('m'))
            ->whereYear('tgl', date('Y'))
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