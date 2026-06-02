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

        // 2. Tentukan field pencarian berdasarkan data session pegawai
        // Asumsi: Jika di session ada properti 'kd_sps' atau 'jabatan' mengandung kata Dokter
        // Atau jika format NIK dokter berbeda, silakan sesuaikan kondisi ini.
        $isDokter = isset($pegawai->kd_sps) || (isset($pegawai->jbtn) && str_contains(strtolower($pegawai->jbtn), 'dokter'));

        // 3. Bangun query dasar
        $query = RsiaHasilKritis::query();

        if ($isDokter) {
            // Jika Dokter: cari yang kolom 'dokter' sesuai NIK-nya, dan 'tgl_dokter' masih kosong
            $query->where('dokter', $nik)
                ->where(function ($q) {
                    $q->whereNull('tgl_dokter')
                        ->orWhere('tgl_dokter', '0000-00-00 00:00:00');
                });
        } else {
            // Jika Petugas Ruang (Perawat/Bidan/Admin): cari yang kolom 'petugas_ruang' sesuai NIK-nya, dan 'tgl_ruang' masih kosong
            $query->where('petugas_ruang', $nik)
                ->where(function ($q) {
                    $q->whereNull('tgl_ruang')
                        ->orWhere('tgl_ruang', '0000-00-00 00:00:00');
                });
        }

        // 4. Kembalikan total data yang belum diverifikasi
        return $query
            ->whereMonth('tgl', date('m'))
            ->whereYear('tgl', date('Y'))
            ->count();
    }
}