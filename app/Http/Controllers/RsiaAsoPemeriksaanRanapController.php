<?php

namespace App\Http\Controllers;

use App\Models\RsiaAsoPemeriksaanRanap;
use Illuminate\Http\Request;

class RsiaAsoPemeriksaanRanapController extends Controller
{
    private $aso;

    public function __construct()
    {
        $this->aso = new RsiaAsoPemeriksaanRanap();
    }

    private function checkIsApoteker($pegawai)
    {
        if (!$pegawai) return false;
        $jbtn = strtolower($pegawai->jbtn ?? '');
        $dep = strtolower($pegawai->departemen ?? '');
        $nik = strtolower($pegawai->nik ?? '');
        $nama = strtolower($pegawai->nama ?? '');

        return (
            str_contains($jbtn, 'apoteker') ||
            str_contains($jbtn, 'farmasi') ||
            str_contains($jbtn, 'kefarmasian') ||
            str_contains($jbtn, 'ttk') ||
            str_contains($dep, 'farmasi') ||
            $dep === 'far' ||
            $dep === 'dpm1' ||
            str_contains($nama, 'farm') ||
            str_contains($nama, 'apt') ||
            $nik === 'direksi'
        );
    }

    public function create(Request $request)
    {
        $pegawai = session()->get('pegawai');
        if (!$this->checkIsApoteker($pegawai)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Akses ditolak. Fitur stempel ASO hanya dapat diakses oleh akun Apoteker / Farmasi.'
            ], 403);
        }

        $request->validate([
            'no_rawat' => 'required',
            'tgl_perawatan' => 'required',
            'jam_rawat' => 'required',
        ]);

        try {
            $aso = RsiaAsoPemeriksaanRanap::updateOrCreate(
                [
                    'no_rawat' => $request->no_rawat,
                    'tgl_perawatan' => $request->tgl_perawatan,
                    'jam_rawat' => $request->jam_rawat,
                ],
                [
                    'tgl_aso' => date('Y-m-d H:i:s'),
                    'nip_apoteker' => $pegawai->nik ?? '',
                    'status_aso' => 'AKTIF',
                    'catatan_aso' => $request->catatan_aso ?? 'Automatic Stop Order (ASO) telah dilakukan oleh Apoteker.',
                ]
            );

            return response()->json([
                'status' => 'success',
                'message' => 'Stempel ASO berhasil diposting',
                'data' => $aso
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menyimpam stempel ASO: ' . $e->getMessage()
            ], 500);
        }
    }

    public function delete(Request $request)
    {
        $pegawai = session()->get('pegawai');
        if (!$this->checkIsApoteker($pegawai)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Akses ditolak. Pembatalan stempel ASO hanya dapat dilakukan oleh akun Apoteker / Farmasi.'
            ], 403);
        }

        try {
            RsiaAsoPemeriksaanRanap::where([
                'no_rawat' => $request->no_rawat,
                'tgl_perawatan' => $request->tgl_perawatan,
                'jam_rawat' => $request->jam_rawat,
            ])->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Stempel ASO berhasil dibatalkan'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal membatalkan stempel ASO: ' . $e->getMessage()
            ], 500);
        }
    }
}
