<?php

namespace App\Http\Controllers;

use App\Models\BookingOperasi;
use App\Models\Dokter;
use App\Models\LaporanOperasi;
use App\Models\Operasi;
use App\Models\PaketOperasi;
use App\Models\Petugas;
use App\Models\RegPeriksa;
use App\Models\RsiaOperasi;
use App\Models\RsiaOperasiSafe;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OperasiController extends Controller
{
    /**
     * Halaman Utama Modul Kamar Operasi (IBS)
     */
    public function index()
    {
        $dokterList = Dokter::where('status', '1')
            ->orderBy('nm_dokter', 'asc')
            ->get(['kd_dokter', 'nm_dokter']);

        $pegawaiList = Petugas::where('status', '1')
            ->orderBy('nama', 'asc')
            ->get(['nip', 'nama']);

        $paketList = PaketOperasi::orderBy('nm_perawatan', 'asc')
            ->get(['kode_paket', 'nm_perawatan']);

        return view('content.operasi.operasi', [
            'dokterList' => $dokterList,
            'pegawaiList' => $pegawaiList,
            'paketList' => $paketList,
        ]);
    }

    /**
     * Ambil data Jadwal Operasi (Booking Operasi)
     */
    public function getJadwal(Request $request): JsonResponse
    {
        $tglAwal = $request->tgl_awal ?: date('Y-m-d');
        $tglAkhir = $request->tgl_akhir ?: date('Y-m-d');

        $query = BookingOperasi::with([
            'regPeriksa.pasien',
            'regPeriksa.poliklinik',
            'regPeriksa.kamarInap' => function ($q) {
                $q->where('stts_pulang', '-')->with('kamar.bangsal');
            },
            'paketOperasi',
            'dokter',
            'laporanOperasiSafe.operatorSatu',
            'laporanOperasiKhanza',
            'operasiKhanza',
        ])
        ->whereBetween('tanggal', [$tglAwal, $tglAkhir]);

        if ($request->filled('status') && $request->status !== 'Semua') {
            $query->where('status', $request->status);
        }

        if ($request->filled('kd_dokter')) {
            $query->where('kd_dokter', $request->kd_dokter);
        }

        if ($request->filled('keyword')) {
            $kw = '%' . trim($request->keyword) . '%';
            $query->where(function ($q) use ($kw) {
                $q->where('no_rawat', 'like', $kw)
                    ->orWhereHas('regPeriksa.pasien', function ($qp) use ($kw) {
                        $qp->where('nm_pasien', 'like', $kw)
                            ->orWhere('no_rkm_medis', 'like', $kw);
                    })
                    ->orWhereHas('paketOperasi', function ($qpk) use ($kw) {
                        $qpk->where('nm_perawatan', 'like', $kw);
                    });
            });
        }

        $data = $query->orderBy('tanggal', 'asc')
            ->orderBy('jam_mulai', 'asc')
            ->get();

        $data->transform(function ($item) {
            $item->laporan_operasi = $item->laporanOperasiSafe ?? $item->laporanOperasiKhanza ?? $item->operasiKhanza;
            return $item;
        });

        return response()->json([
            'status' => true,
            'data' => $data,
        ]);
    }

    /**
     * Simpan / Tambah Jadwal Booking Operasi Baru
     */
    public function simpanBooking(Request $request): JsonResponse
    {
        $request->validate([
            'no_rawat' => 'required',
            'kode_paket' => 'required',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'kd_dokter' => 'required',
        ]);

        $noRawat = str_replace('-', '/', $request->no_rawat);

        $exists = BookingOperasi::where('no_rawat', $noRawat)
            ->where('tanggal', $request->tanggal)
            ->exists();

        if ($exists) {
            return response()->json([
                'status' => false,
                'message' => 'Pasien sudah memiliki jadwal operasi pada tanggal tersebut.',
            ], 422);
        }

        try {
            BookingOperasi::create([
                'no_rawat' => $noRawat,
                'kode_paket' => $request->kode_paket,
                'tanggal' => $request->tanggal,
                'jam_mulai' => $request->jam_mulai,
                'jam_selesai' => $request->jam_selesai,
                'status' => $request->status ?: 'Menunggu',
                'kd_dokter' => $request->kd_dokter,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Jadwal operasi berhasil ditambahkan.',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menambahkan jadwal operasi: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update Status Booking Operasi (Menunggu -> Proses Operasi -> Selesai)
     */
    public function updateStatusBooking(Request $request): JsonResponse
    {
        $request->validate([
            'no_rawat' => 'required',
            'tanggal' => 'required',
            'status' => 'required|in:Menunggu,Proses Operasi,Selesai',
        ]);

        $noRawat = str_replace('-', '/', $request->no_rawat);

        try {
            DB::table('booking_operasi')
                ->where('no_rawat', $noRawat)
                ->where('tanggal', $request->tanggal)
                ->update(['status' => $request->status]);

            return response()->json([
                'status' => true,
                'message' => 'Status jadwal operasi berhasil diubah menjadi: ' . $request->status,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal mengubah status operasi: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Hapus Booking Operasi
     */
    public function hapusBooking(Request $request): JsonResponse
    {
        $request->validate([
            'no_rawat' => 'required',
            'tanggal' => 'required',
        ]);

        $noRawat = str_replace('-', '/', $request->no_rawat);

        try {
            DB::table('booking_operasi')
                ->where('no_rawat', $noRawat)
                ->where('tanggal', $request->tanggal)
                ->delete();

            return response()->json([
                'status' => true,
                'message' => 'Jadwal operasi berhasil dihapus.',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menghapus jadwal operasi: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Ambil Data Laporan Operasi
     */
    public function getLaporan(Request $request): JsonResponse
    {
        $noRawat = str_replace('-', '/', $request->no_rawat);

        $laporan = RsiaOperasiSafe::with([
            'regPeriksa.pasien',
            'paketOperasi',
            'operatorSatu',
            'dokterAnestesi',
            'dokterAnak',
            'asistenOperatorSatu',
            'asistenOperatorDua',
            'asistenAnestesiPetugas',
            'onloopPetugas',
            'bookingOperasi',
        ])
        ->where('no_rawat', $noRawat)
        ->first();

        // Fallback jika belum ada di rsia_operasi_safe, cek rsia_operasi legacy
        if (!$laporan) {
            $laporan = RsiaOperasi::with([
                'regPeriksa.pasien',
                'paketOperasi',
                'operatorSatu',
                'dokterAnestesi',
                'dokterAnak',
                'asistenOperatorSatu',
                'asistenOperatorDua',
                'asistenAnestesiPetugas',
                'onloopPetugas',
                'bookingOperasi',
            ])
            ->where('no_rawat', $noRawat)
            ->first();
        }

        // Fallback jika belum ada di rsia_operasi_safe/rsia_operasi, cek laporan_operasi Khanza atau booking
        if (!$laporan) {
            $khanza = LaporanOperasi::where('no_rawat', $noRawat)->first();
            $booking = BookingOperasi::with(['regPeriksa.pasien', 'paketOperasi', 'dokter'])
                ->where('no_rawat', $noRawat)
                ->first();

            $regPeriksa = RegPeriksa::with(['pasien', 'dokter'])
                ->where('no_rawat', $noRawat)
                ->first();

            if ($khanza) {
                return response()->json([
                    'status' => true,
                    'is_new' => false,
                    'data' => [
                        'no_rawat' => $noRawat,
                        'reg_periksa' => $booking->regPeriksa ?? $regPeriksa,
                        'pasien' => $booking->regPeriksa->pasien ?? ($regPeriksa->pasien ?? null),
                        'kode_paket' => $booking->kode_paket ?? '',
                        'operator1' => $booking->kd_dokter ?? ($regPeriksa->kd_dokter ?? ''),
                        'tgl_operasi' => $khanza->tanggal ?: ($booking ? $booking->tanggal . ' ' . $booking->jam_mulai : date('Y-m-d H:i:s')),
                        'tgl_selesai' => $khanza->selesaioperasi ?: ($booking ? $booking->tanggal . ' ' . $booking->jam_selesai : date('Y-m-d H:i:s')),
                        'kategori' => 'Elektive',
                        'jenis_anestesi' => 'GA',
                        'pemeriksaan_pa' => $khanza->permintaan_pa ?: 'Tidak',
                        'diagnosa_preop' => $khanza->diagnosa_preop ?: '',
                        'diagnosa_postop' => $khanza->diagnosa_postop ?: '',
                        'jaringan_insisi' => $khanza->jaringan_dieksekusi ?: '',
                        'laporan_operasi' => $khanza->laporan_operasi ?: '',
                        'dr_anestesi_hadir' => 'Ya',
                        'dr_anak_hadir' => 'Tidak',
                    ],
                ]);
            }

            return response()->json([
                'status' => true,
                'is_new' => true,
                'data' => [
                    'no_rawat' => $noRawat,
                    'pasien' => $booking->regPeriksa->pasien ?? ($regPeriksa->pasien ?? null),
                    'kode_paket' => $booking->kode_paket ?? '',
                    'operator1' => $booking->kd_dokter ?? ($regPeriksa->kd_dokter ?? ''),
                    'tgl_operasi' => $booking ? $booking->tanggal . ' ' . $booking->jam_mulai : date('Y-m-d H:i:s'),
                    'tgl_selesai' => $booking ? $booking->tanggal . ' ' . $booking->jam_selesai : date('Y-m-d H:i:s'),
                    'kategori' => 'Elektive',
                    'jenis_anestesi' => 'GA',
                    'pemeriksaan_pa' => 'Tidak',
                    'dr_anestesi_hadir' => 'Ya',
                    'dr_anak_hadir' => 'Tidak',
                ],
            ]);
        }

        return response()->json([
            'status' => true,
            'is_new' => false,
            'data' => $laporan,
        ]);
    }

    /**
     * Simpan / Perbarui Laporan Operasi
     */
    public function simpanLaporan(Request $request): JsonResponse
    {
        $request->validate([
            'no_rawat' => 'required',
            'tgl_operasi' => 'required',
            'tgl_selesai' => 'required',
            'kode_paket' => 'required',
            'operator1' => 'required',
        ]);

        $noRawat = str_replace('-', '/', $request->no_rawat);

        DB::beginTransaction();
        try {
            $dataPayload = [
                'no_rawat' => $noRawat,
                'tgl_operasi' => $request->tgl_operasi,
                'tgl_selesai' => $request->tgl_selesai,
                'kode_paket' => $request->kode_paket,
                'diagnosa_preop' => $request->diagnosa_preop ?: '-',
                'diagnosa_postop' => $request->diagnosa_postop ?: '-',
                'kategori' => $request->kategori ?: 'Elektive',
                'jenis_anestesi' => $request->jenis_anestesi ?: '-',
                'operator1' => $request->operator1,
                'asisten_operator1' => $request->asisten_operator1 ?: '-',
                'asisten_operator2' => $request->asisten_operator2 ?: '-',
                'dokter_anak' => $request->dokter_anak ?: '-',
                'dokter_anestesi' => $request->dokter_anestesi ?: '-',
                'asisten_anestesi' => $request->asisten_anestesi ?: '-',
                'onloop' => $request->onloop ?: '-',
                'jaringan_insisi' => $request->jaringan_insisi ?: '-',
                'pemeriksaan_pa' => $request->pemeriksaan_pa ?: 'Tidak',
                'laporan_operasi' => $request->laporan_operasi ?: '-',
                'dr_anestesi_hadir' => $request->dr_anestesi_hadir ?: 'Ya',
                'dr_anak_hadir' => $request->dr_anak_hadir ?: 'Tidak',
            ];

            // Upsert ke tabel utama rsia_operasi_safe
            DB::table('rsia_operasi_safe')->updateOrInsert(
                ['no_rawat' => $noRawat],
                $dataPayload
            );

            // Upsert juga ke rsia_operasi bila tabel ada
            try {
                DB::table('rsia_operasi')->updateOrInsert(
                    ['no_rawat' => $noRawat],
                    $dataPayload
                );
            } catch (\Throwable $e) {}

            // Sinkronkan juga ke tabel standar Khanza laporan_operasi
            DB::table('laporan_operasi')->updateOrInsert(
                ['no_rawat' => $noRawat],
                [
                    'tanggal' => $request->tgl_operasi,
                    'diagnosa_preop' => $request->diagnosa_preop ?: '-',
                    'diagnosa_postop' => $request->diagnosa_postop ?: '-',
                    'jaringan_dieksekusi' => $request->jaringan_insisi ?: '-',
                    'selesaioperasi' => $request->tgl_selesai,
                    'permintaan_pa' => $request->pemeriksaan_pa === 'Ya' ? 'Ya' : 'Tidak',
                    'laporan_operasi' => $request->laporan_operasi ?: '-',
                ]
            );

            // Update status booking_operasi menjadi Selesai bila ada
            DB::table('booking_operasi')
                ->where('no_rawat', $noRawat)
                ->update(['status' => 'Selesai']);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Laporan operasi berhasil disimpan dan status operasi diselesaikan.',
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Gagal menyimpan laporan operasi: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Hapus Laporan Operasi
     */
    public function hapusLaporan(Request $request): JsonResponse
    {
        $noRawat = str_replace('-', '/', $request->no_rawat);

        DB::beginTransaction();
        try {
            DB::table('rsia_operasi_safe')->where('no_rawat', $noRawat)->delete();
            DB::table('rsia_operasi')->where('no_rawat', $noRawat)->delete();
            DB::table('laporan_operasi')->where('no_rawat', $noRawat)->delete();

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Laporan operasi berhasil dihapus.',
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Gagal menghapus laporan operasi: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Cetak PDF Laporan Operasi Resmi
     */
    public function cetakLaporan($no_rawat)
    {
        $noRawat = str_replace('-', '/', $no_rawat);

        $laporan = RsiaOperasiSafe::with([
            'regPeriksa.pasien',
            'regPeriksa.kamarInap' => function ($q) {
                $q->where('stts_pulang', '-')->with('kamar.bangsal');
            },
            'paketOperasi',
            'operatorSatu',
            'dokterAnestesi',
            'dokterAnak',
            'asistenOperatorSatu',
            'asistenOperatorDua',
            'asistenAnestesiPetugas',
            'onloopPetugas',
        ])
        ->where('no_rawat', $noRawat)
        ->first();

        if (!$laporan) {
            $laporan = RsiaOperasi::with([
                'regPeriksa.pasien',
                'regPeriksa.kamarInap' => function ($q) {
                    $q->where('stts_pulang', '-')->with('kamar.bangsal');
                },
                'paketOperasi',
                'operatorSatu',
                'dokterAnestesi',
                'dokterAnak',
                'asistenOperatorSatu',
                'asistenOperatorDua',
                'asistenAnestesiPetugas',
                'onloopPetugas',
            ])
            ->where('no_rawat', $noRawat)
            ->first();
        }

        if (!$laporan) {
            abort(404, 'Laporan operasi untuk nomor rawat ini belum tersedia.');
        }

        if (!$laporan) {
            abort(404, 'Laporan operasi untuk nomor rawat ini belum tersedia.');
        }

        $regPeriksa = $laporan->regPeriksa;
        $kamar = null;
        if ($regPeriksa && $regPeriksa->kamarInap) {
            $kamar = is_iterable($regPeriksa->kamarInap)
                ? ($regPeriksa->kamarInap->filter(fn($k) => $k->stts_pulang != 'Pindah Kamar')->first() ?? $regPeriksa->kamarInap->first())
                : $regPeriksa->kamarInap;
        }

        $pdf = Pdf::loadView('content.print.laporan_operasi', [
            'laporan' => $laporan,
            'regPeriksa' => $regPeriksa,
            'pasien' => $regPeriksa->pasien,
            'kamar' => $kamar,
        ])->setPaper('a4', 'portrait');

        return $pdf->stream('laporan_operasi_' . str_replace('/', '_', $noRawat) . '.pdf');
    }

    /**
     * Cari Pasien untuk Modal Booking Operasi (Autocomplete)
     */
    public function cariPasien(Request $request): JsonResponse
    {
        $keyword = trim($request->keyword);
        if (strlen($keyword) < 2) {
            return response()->json(['data' => []]);
        }

        $kw = "%{$keyword}%";
        $data = RegPeriksa::with(['pasien', 'poliklinik', 'kamarInap' => function ($q) {
                $q->where('stts_pulang', '-')->with('kamar.bangsal');
            }])
            ->where(function ($q) use ($kw) {
                $q->where('no_rawat', 'like', $kw)
                    ->orWhere('no_rkm_medis', 'like', $kw)
                    ->orWhereHas('pasien', function ($qp) use ($kw) {
                        $qp->where('nm_pasien', 'like', $kw);
                    });
            })
            ->where('status_lanjut', 'Ranap')
            ->orderBy('tgl_registrasi', 'desc')
            ->limit(10)
            ->get();

        return response()->json(['data' => $data]);
    }
}

