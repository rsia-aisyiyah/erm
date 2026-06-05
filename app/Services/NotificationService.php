<?php

namespace App\Services;

use App\Models\PemeriksaanRanap;
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

        // 2. Tentukan apakah user adalah Dokter
        $isDokter = isset($pegawai->kd_sps) || (isset($pegawai->jbtn) && str_contains(strtolower($pegawai->jbtn), 'dokter'));

        // 3. Bangun query dasar
        $query = RsiaHasilKritis::query();

        if ($isDokter) {
            // JIKA DOKTER: Hitung penugasan sebagai DPJP Utama ATAU sebagai PJ Lab/Radiologi
            $query->where(function ($q) use ($nik) {

                // Kondisi A: Sebagai Dokter Utama yang tgl_dokter-nya masih kosong
                $q->where(function ($sub) use ($nik) {
                    $sub->where('dokter', $nik)
                        ->where(function ($empty) {
                            $empty->whereNull('tgl_dokter')
                                ->orWhere('tgl_dokter', '0000-00-00 00:00:00');
                        });
                })

                    // ATAU Kondisi B: Sebagai Dokter PJ Lab/Rad yang tgl_drpj-nya masih kosong
                    ->orWhere(function ($sub) use ($nik) {
                        $sub->where('dokter_pj', $nik)
                            ->where(function ($empty) {
                                $empty->whereNull('tgl_drpj')
                                    ->orWhere('tgl_drpj', '0000-00-00 00:00:00');
                            });
                    });

            });

        } else {
            // JIKA PETUGAS RUANG: Tetap seperti logika lama Anda
            $query->where('petugas_ruang', $nik)
                ->where(function ($q) {
                    $q->whereNull('tgl_ruang')
                        ->orWhere('tgl_ruang', '0000-00-00 00:00:00');
                });
        }

        // 4. Kembalikan total data yang belum diverifikasi pada bulan berjalan
        return $query
            ->whereMonth('tgl', date('m'))
            ->whereYear('tgl', date('Y'))
            ->count();
    }
}