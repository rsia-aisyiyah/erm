<?php

namespace App\Http\Controllers;

use App\Models\PermintaanResepPulang;
use App\Models\PermintaanStokObatPasien;
use App\Models\RsiaPengajuanRetur;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotifikasiFarmasiController extends Controller
{
    /**
     * Mengambil daftar respon dan validasi dari Farmasi dalam 24 jam terakhir
     * (Retur Obat, Permintaan Stok Obat Ranap/UDD, dan Resep Pulang).
     */
    public function getResponFarmasi(Request $request): JsonResponse
    {
        $today = Carbon::today()->toDateString();
        $kemarin = Carbon::yesterday()->toDateString();
        $userRole = session()->get('role') ?? '';
        $userNik = session()->get('pegawai')->nik ?? '';

        $notifications = [];

        // 1. RESPON PENGAJUAN RETUR OBAT RANAP (Disetujui / Ditolak oleh Farmasi)
        try {
            $returList = RsiaPengajuanRetur::with([
                'regPeriksa.pasien',
                'regPeriksa.kamarInap' => function ($q) {
                    $q->with('kamar.bangsal')->orderBy('tgl_masuk', 'desc')->orderBy('jam_masuk', 'desc');
                },
                'pegawaiValidasi',
            ])
            ->whereIn('status', ['Disetujui', 'Ditolak'])
            ->where(function ($q) use ($today, $kemarin) {
                $q->whereDate('tgl_validasi', '>=', $kemarin)
                  ->orWhereDate('updated_at', '>=', $kemarin);
            })
            ->orderBy('tgl_validasi', 'desc')
            ->orderBy('jam_validasi', 'desc')
            ->limit(15)
            ->get();

            foreach ($returList as $retur) {
                $waktuValidasi = ($retur->tgl_validasi && $retur->jam_validasi) 
                    ? Carbon::parse("{$retur->tgl_validasi} {$retur->jam_validasi}")
                    : ($retur->updated_at ? Carbon::parse($retur->updated_at) : Carbon::now());

                $pasien = $retur->regPeriksa->pasien ?? null;
                $kamarInap = $retur->regPeriksa->kamarInap->first() ?? null;
                $nmKamar = $kamarInap ? ($kamarInap->kamar->bangsal->nm_bangsal ?? $kamarInap->kd_kamar ?? '-') : '-';

                $isDisetujui = $retur->status === 'Disetujui';

                $notifications[] = [
                    'id' => 'retur_' . $retur->no_pengajuan,
                    'kategori' => 'retur',
                    'judul' => $isDisetujui ? 'Retur Obat Disetujui' : 'Retur Obat Ditolak',
                    'status' => $retur->status,
                    'tipe_badge' => $isDisetujui ? 'success' : 'danger',
                    'icon' => $isDisetujui ? 'bi-arrow-return-left text-success' : 'bi-x-circle text-danger',
                    'no_referensi' => $retur->no_pengajuan,
                    'no_retur_jual' => $retur->no_retur_jual,
                    'no_rawat' => $retur->no_rawat,
                    'nm_pasien' => $pasien->nm_pasien ?? '-',
                    'no_rkm_medis' => $pasien->no_rkm_medis ?? '-',
                    'kamar' => $nmKamar,
                    'catatan' => $retur->catatan_farmasi ?: ($isDisetujui ? 'Pengajuan retur telah divalidasi farmasi.' : 'Pengajuan ditolak farmasi.'),
                    'petugas_farmasi' => $retur->pegawaiValidasi->nama ?? $retur->petugas_validasi ?? 'Farmasi',
                    'waktu' => $waktuValidasi->format('Y-m-d H:i:s'),
                    'waktu_human' => $waktuValidasi->locale('id')->diffForHumans(),
                    'url_cetak' => $isDisetujui ? url('/retur-obat/cetak/' . $retur->no_pengajuan) : null,
                ];
            }
        } catch (\Exception $e) {
            // Silently log or ignore if table not accessible
        }

        // 2. RESPON PERMINTAAN STOK OBAT RANAP (UDD) (Status 'Sudah')
        try {
            $uddList = PermintaanStokObatPasien::with([
                'regPeriksa.pasien',
                'regPeriksa.kamarInap' => function ($q) {
                    $q->with('kamar.bangsal')->orderBy('tgl_masuk', 'desc')->orderBy('jam_masuk', 'desc');
                },
                'dokter',
            ])
            ->where('status', 'Sudah')
            ->where(function ($q) use ($today, $kemarin) {
                $q->whereDate('tgl_validasi', '>=', $kemarin);
            })
            ->orderBy('tgl_validasi', 'desc')
            ->orderBy('jam_validasi', 'desc')
            ->limit(15)
            ->get();

            foreach ($uddList as $udd) {
                $waktuValidasi = ($udd->tgl_validasi && $udd->jam_validasi) 
                    ? Carbon::parse("{$udd->tgl_validasi} {$udd->jam_validasi}")
                    : Carbon::now();

                $pasien = $udd->regPeriksa->pasien ?? null;
                $kamarInap = $udd->regPeriksa->kamarInap->first() ?? null;
                $nmKamar = $kamarInap ? ($kamarInap->kamar->bangsal->nm_bangsal ?? $kamarInap->kd_kamar ?? '-') : '-';

                $notifications[] = [
                    'id' => 'udd_' . $udd->no_permintaan,
                    'kategori' => 'udd',
                    'judul' => 'Obat UDD Siap Diambil',
                    'status' => 'Disiapkan',
                    'tipe_badge' => 'primary',
                    'icon' => 'bi-capsule-pill text-primary',
                    'no_referensi' => $udd->no_permintaan,
                    'no_rawat' => $udd->no_rawat,
                    'nm_pasien' => $pasien->nm_pasien ?? '-',
                    'no_rkm_medis' => $pasien->no_rkm_medis ?? '-',
                    'kamar' => $nmKamar,
                    'catatan' => 'Permintaan stok obat UDD telah divalidasi & disiapkan oleh Farmasi.',
                    'petugas_farmasi' => 'Farmasi Ranap',
                    'waktu' => $waktuValidasi->format('Y-m-d H:i:s'),
                    'waktu_human' => $waktuValidasi->locale('id')->diffForHumans(),
                    'url_cetak' => null,
                ];
            }
        } catch (\Exception $e) {
            // Silently log or ignore
        }

        // 3. RESPON PERMINTAAN RESEP PULANG (Status 'Sudah')
        try {
            $resepPulangList = PermintaanResepPulang::with([
                'regPeriksa.pasien',
                'regPeriksa.kamarInap' => function ($q) {
                    $q->with('kamar.bangsal')->orderBy('tgl_masuk', 'desc')->orderBy('jam_masuk', 'desc');
                },
                'dokter',
            ])
            ->where('status', 'Sudah')
            ->where(function ($q) use ($today, $kemarin) {
                $q->whereDate('tgl_validasi', '>=', $kemarin);
            })
            ->orderBy('tgl_validasi', 'desc')
            ->orderBy('jam_validasi', 'desc')
            ->limit(15)
            ->get();

            foreach ($resepPulangList as $rp) {
                $waktuValidasi = ($rp->tgl_validasi && $rp->jam_validasi) 
                    ? Carbon::parse("{$rp->tgl_validasi} {$rp->jam_validasi}")
                    : Carbon::now();

                $pasien = $rp->regPeriksa->pasien ?? null;
                $kamarInap = $rp->regPeriksa->kamarInap->first() ?? null;
                $nmKamar = $kamarInap ? ($kamarInap->kamar->bangsal->nm_bangsal ?? $kamarInap->kd_kamar ?? '-') : '-';

                $notifications[] = [
                    'id' => 'rp_' . $rp->no_permintaan,
                    'kategori' => 'resep_pulang',
                    'judul' => 'Resep Pulang Selesai',
                    'status' => 'Selesai',
                    'tipe_badge' => 'info',
                    'icon' => 'bi-box-arrow-right text-info',
                    'no_referensi' => $rp->no_permintaan,
                    'no_rawat' => $rp->no_rawat,
                    'nm_pasien' => $pasien->nm_pasien ?? '-',
                    'no_rkm_medis' => $pasien->no_rkm_medis ?? '-',
                    'kamar' => $nmKamar,
                    'catatan' => 'Resep obat pulang telah divalidasi & siap diserahkan kepada pasien.',
                    'petugas_farmasi' => 'Farmasi',
                    'waktu' => $waktuValidasi->format('Y-m-d H:i:s'),
                    'waktu_human' => $waktuValidasi->locale('id')->diffForHumans(),
                    'url_cetak' => null,
                ];
            }
        } catch (\Exception $e) {
            // Silently log or ignore
        }

        // Urutkan seluruh notifikasi berdasarkan waktu descending
        usort($notifications, function ($a, $b) {
            return strtotime($b['waktu']) - strtotime($a['waktu']);
        });

        // Ambil maksimal 20 respon terbaru
        $notifications = array_slice($notifications, 0, 20);

        return response()->json([
            'status' => 'success',
            'is_dokter' => $userRole === 'dokter',
            'data' => $notifications,
            'total' => count($notifications),
        ]);
    }
}
