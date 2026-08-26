<?php

namespace App\Http\Controllers;

use App\Models\RsiaTriasePreRegistrasi;
use App\Models\RegPeriksa;
use App\Models\RsiaDataTriaseUgdDetailSkala1;
use App\Models\RsiaDataTriaseUgdDetailSkala2;
use App\Models\RsiaDataTriaseUgdDetailSkala3;
use App\Models\RsiaDataTriaseUgdDetailSkala4;
use App\Models\RsiaDataTriaseUgdDetailSkala5;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RsiaTriasePreRegistrasiController extends Controller
{
    public function getUnlinked(Request $request)
    {
        $query = RsiaTriasePreRegistrasi::where('status_link', 'UNLINKED')
            ->with(['petugas' => function ($q) {
                $q->select('nip', 'nama');
            }])
            ->orderBy('tgl_triase', 'DESC');

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_pasien_temp', 'like', '%' . $request->search . '%')
                    ->orWhere('id_triase', 'like', '%' . $request->search . '%')
                    ->orWhere('keterangan_kedatangan', 'like', '%' . $request->search . '%');
            });
        }

        return response()->json([
            'status' => 'success',
            'data' => $query->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pasien_temp' => 'required',
            'skala_triase' => 'required|in:1,2,3,4,5',
            'kategori_triase' => 'required|in:MERAH,KUNING,HIJAU,HITAM',
        ]);

        $pegawai = session()->get('pegawai');
        $nip = $pegawai->nik ?? 'ADMIN';

        // Generate ID Triase: TR-YYYYMMDD-XXXX
        $datePrefix = 'TR-' . date('Ymd') . '-';
        $lastTriase = RsiaTriasePreRegistrasi::where('id_triase', 'like', $datePrefix . '%')
            ->orderBy('id_triase', 'DESC')
            ->first();

        if ($lastTriase) {
            $lastNum = (int) substr($lastTriase->id_triase, -4);
            $newNum = str_pad($lastNum + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNum = '0001';
        }
        $idTriase = $datePrefix . $newNum;

        DB::beginTransaction();
        try {
            $detailSkala = is_string($request->detail_skala_json) ? json_decode($request->detail_skala_json, true) : ($request->detail_skala_json ?? []);
            $kodeKasus = ($request->kode_kasus && $request->kode_kasus !== '-') ? $request->kode_kasus : '006';

            if ($request->id_triase) {
                $triase = RsiaTriasePreRegistrasi::find($request->id_triase);
                if ($triase) {
                    $triase->update([
                        'nama_pasien_temp' => $request->nama_pasien_temp,
                        'jk' => $request->jk ?? 'L',
                        'umur_temp' => $request->umur_temp ?? '-',
                        'cara_masuk' => $request->cara_masuk ?? 'Sendiri',
                        'alat_transportasi' => $request->alat_transportasi ?? 'Kendaraan Pribadi',
                        'alasan_kedatangan' => $request->alasan_kedatangan ?? 'Penyakit Non Trauma',
                        'keterangan_kedatangan' => $request->keterangan_kedatangan ?? '-',
                        'kode_kasus' => $kodeKasus,
                        'tekanan_darah' => $request->tekanan_darah ?? '-',
                        'nadi' => $request->nadi ?? '-',
                        'pernapasan' => $request->pernapasan ?? '-',
                        'suhu' => $request->suhu ?? '-',
                        'saturasi_o2' => $request->saturasi_o2 ?? '-',
                        'gcs' => $request->gcs ?? '-',
                        'nyeri' => $request->nyeri ?? '-',
                        'skala_triase' => $request->skala_triase,
                        'kategori_triase' => $request->kategori_triase,
                        'detail_skala_json' => $detailSkala,
                    ]);

                    // Sync update jika sudah terhubung ke no_rawat
                    if ($triase->status_link === 'LINKED' && $triase->no_rawat) {
                        $validKasus = DB::table('master_triase_macam_kasus')->where('kode_kasus', $kodeKasus)->first();
                        if (!$validKasus) {
                            $kodeKasus = '006';
                        }

                        DB::table('data_triase_igd')->updateOrInsert(
                            ['no_rawat' => $triase->no_rawat],
                            [
                                'tgl_kunjungan' => $triase->tgl_triase,
                                'cara_masuk' => $triase->cara_masuk,
                                'alat_transportasi' => $triase->alat_transportasi,
                                'alasan_kedatangan' => $triase->alasan_kedatangan,
                                'keterangan_kedatangan' => $triase->keterangan_kedatangan,
                                'kode_kasus' => $kodeKasus,
                                'tekanan_darah' => $triase->tekanan_darah,
                                'nadi' => $triase->nadi,
                                'pernapasan' => $triase->pernapasan,
                                'suhu' => $triase->suhu,
                                'saturasi_o2' => $triase->saturasi_o2,
                                'nyeri' => $triase->nyeri,
                            ]
                        );

                        // Sync detail indikator skala
                        $skalaModels = [
                            1 => RsiaDataTriaseUgdDetailSkala1::class,
                            2 => RsiaDataTriaseUgdDetailSkala2::class,
                            3 => RsiaDataTriaseUgdDetailSkala3::class,
                            4 => RsiaDataTriaseUgdDetailSkala4::class,
                            5 => RsiaDataTriaseUgdDetailSkala5::class,
                        ];
                        foreach ($skalaModels as $skalaNum => $modelClass) {
                            $modelClass::where('no_rawat', $triase->no_rawat)->delete();
                            $keySkala = 'skala' . $skalaNum;
                            if (isset($detailSkala[$keySkala]) && is_array($detailSkala[$keySkala])) {
                                foreach ($detailSkala[$keySkala] as $item) {
                                    $kodeKey = 'kode_skala' . $skalaNum;
                                    if (!empty($item[$kodeKey])) {
                                        $modelClass::create([
                                            'no_rawat' => $triase->no_rawat,
                                            $kodeKey => $item[$kodeKey]
                                        ]);
                                    }
                                }
                            }
                        }
                    }

                    DB::commit();
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Data Triase Pre-Registrasi berhasil diperbarui',
                        'data' => $triase
                    ]);
                }
            }

            // Generate ID Triase jika simpan baru: TR-YYYYMMDD-XXXX
            $datePrefix = 'TR-' . date('Ymd') . '-';
            $lastTriase = RsiaTriasePreRegistrasi::where('id_triase', 'like', $datePrefix . '%')
                ->orderBy('id_triase', 'DESC')
                ->first();

            if ($lastTriase) {
                $lastNum = (int) substr($lastTriase->id_triase, -4);
                $newNum = str_pad($lastNum + 1, 4, '0', STR_PAD_LEFT);
            } else {
                $newNum = '0001';
            }
            $idTriase = $datePrefix . $newNum;

            $triase = RsiaTriasePreRegistrasi::create([
                'id_triase' => $idTriase,
                'tgl_triase' => date('Y-m-d H:i:s'),
                'nama_pasien_temp' => $request->nama_pasien_temp,
                'jk' => $request->jk ?? 'L',
                'umur_temp' => $request->umur_temp ?? '-',
                'cara_masuk' => $request->cara_masuk ?? 'Sendiri',
                'alat_transportasi' => $request->alat_transportasi ?? 'Kendaraan Pribadi',
                'alasan_kedatangan' => $request->alasan_kedatangan ?? 'Penyakit Non Trauma',
                'keterangan_kedatangan' => $request->keterangan_kedatangan ?? '-',
                'kode_kasus' => $kodeKasus,
                'tekanan_darah' => $request->tekanan_darah ?? '-',
                'nadi' => $request->nadi ?? '-',
                'pernapasan' => $request->pernapasan ?? '-',
                'suhu' => $request->suhu ?? '-',
                'saturasi_o2' => $request->saturasi_o2 ?? '-',
                'gcs' => $request->gcs ?? '-',
                'nyeri' => $request->nyeri ?? '-',
                'skala_triase' => $request->skala_triase,
                'kategori_triase' => $request->kategori_triase,
                'detail_skala_json' => $detailSkala,
                'nip_petugas' => $nip,
                'status_link' => 'UNLINKED',
            ]);

            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Triase Pre-Registrasi berhasil disimpan',
                'data' => $triase
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menyimpan Triase Pre-Registrasi: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getRecentList(Request $request)
    {
        $query = RsiaTriasePreRegistrasi::with('petugas');
        if ($request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_pasien_temp', 'like', "%{$search}%")
                  ->orWhere('id_triase', 'like', "%{$search}%")
                  ->orWhere('no_rawat', 'like', "%{$search}%");
            });
        }
        $triaseList = $query->orderBy('tgl_triase', 'DESC')->limit(50)->get();

        return response()->json([
            'status' => 'success',
            'data' => $triaseList
        ]);
    }

    public function getDetail($id_triase)
    {
        $triase = RsiaTriasePreRegistrasi::with('petugas')->find($id_triase);
        if (!$triase) {
            return response()->json(['status' => 'error', 'message' => 'Data Triase tidak ditemukan'], 404);
        }
        return response()->json([
            'status' => 'success',
            'data' => $triase
        ]);
    }

    public function destroy(Request $request)
    {
        $triase = RsiaTriasePreRegistrasi::find($request->id_triase);
        if (!$triase) {
            return response()->json(['status' => 'error', 'message' => 'Data Triase tidak ditemukan'], 404);
        }

        if ($triase->status_link === 'LINKED') {
            return response()->json(['status' => 'error', 'message' => 'Triase yang sudah terhubung ke registrasi tidak dapat dihapus langsung. Lepas tautan terlebih dahulu.'], 400);
        }

        $triase->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Data Triase Pre-Registrasi berhasil dihapus'
        ]);
    }

    public function link(Request $request)
    {
        $request->validate([
            'id_triase' => 'required',
            'no_rawat' => 'required',
        ]);

        $pegawai = session()->get('pegawai');
        $nipLinker = $pegawai->nik ?? 'ADMIN';

        $triase = RsiaTriasePreRegistrasi::find($request->id_triase);
        if (!$triase) {
            return response()->json(['status' => 'error', 'message' => 'Data Triase Pre-Registrasi tidak ditemukan.'], 404);
        }

        $regPeriksa = RegPeriksa::with('pasien')->where('no_rawat', $request->no_rawat)->first();
        if (!$regPeriksa) {
            return response()->json(['status' => 'error', 'message' => 'Data Registrasi Pasien tidak ditemukan.'], 404);
        }

        // Cek validasi kode_kasus terhadap master_triase_macam_kasus untuk cegah FK 1452 error
        $kodeKasus = $triase->kode_kasus;
        $validKasus = DB::table('master_triase_macam_kasus')->where('kode_kasus', $kodeKasus)->first();
        if (!$validKasus) {
            $kodeKasus = '006'; // Default kode_kasus "-" pada Khanza
        }

        DB::beginTransaction();
        try {
            // Update status link pada rsia_triase_pre_registrasi
            $triase->update([
                'status_link' => 'LINKED',
                'no_rawat' => $regPeriksa->no_rawat,
                'no_rkm_medis' => $regPeriksa->no_rkm_medis,
                'tgl_linked' => date('Y-m-d H:i:s'),
                'nip_linker' => $nipLinker,
            ]);

            // Sync data ke data_triase_igd Khanza bawaan
            DB::table('data_triase_igd')->updateOrInsert(
                ['no_rawat' => $regPeriksa->no_rawat],
                [
                    'tgl_kunjungan' => $triase->tgl_triase,
                    'cara_masuk' => $triase->cara_masuk,
                    'alat_transportasi' => $triase->alat_transportasi,
                    'alasan_kedatangan' => $triase->alasan_kedatangan,
                    'keterangan_kedatangan' => $triase->keterangan_kedatangan,
                    'kode_kasus' => $kodeKasus,
                    'tekanan_darah' => $triase->tekanan_darah,
                    'nadi' => $triase->nadi,
                    'pernapasan' => $triase->pernapasan,
                    'suhu' => $triase->suhu,
                    'saturasi_o2' => $triase->saturasi_o2,
                    'nyeri' => $triase->nyeri,
                ]
            );

            // Sync detail indikator skala 1 s.d 5
            $details = $triase->detail_skala_json ?? [];
            $skalaModels = [
                'skala1' => RsiaDataTriaseUgdDetailSkala1::class,
                'skala2' => RsiaDataTriaseUgdDetailSkala2::class,
                'skala3' => RsiaDataTriaseUgdDetailSkala3::class,
                'skala4' => RsiaDataTriaseUgdDetailSkala4::class,
                'skala5' => RsiaDataTriaseUgdDetailSkala5::class,
            ];

            foreach ($skalaModels as $key => $modelClass) {
                $modelClass::where('no_rawat', $regPeriksa->no_rawat)->delete();
                if (!empty($details[$key]) && is_array($details[$key])) {
                    foreach ($details[$key] as $kodeSkala) {
                        $modelClass::create([
                            'no_rawat' => $regPeriksa->no_rawat,
                            'kode_' . $key => $kodeSkala
                        ]);
                    }
                }
            }

            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Triase Pre-Registrasi berhasil ditautkan ke pasien ' . $regPeriksa->pasien->nm_pasien,
                'data' => $triase
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menautkan Triase: ' . $e->getMessage()
            ], 500);
        }
    }

    public function unlink(Request $request)
    {
        $request->validate([
            'no_rawat' => 'required',
        ]);

        $triase = RsiaTriasePreRegistrasi::where('no_rawat', $request->no_rawat)->first();
        if (!$triase) {
            return response()->json(['status' => 'error', 'message' => 'Tautan Triase tidak ditemukan untuk no_rawat ini.'], 404);
        }

        DB::beginTransaction();
        try {
            $noRawat = $triase->no_rawat;
            $triase->update([
                'status_link' => 'UNLINKED',
                'no_rawat' => null,
                'no_rkm_medis' => null,
                'tgl_linked' => null,
                'nip_linker' => null,
            ]);

            // Hapus data sync di data_triase_igd Khanza
            DB::table('data_triase_igd')->where('no_rawat', $noRawat)->delete();
            RsiaDataTriaseUgdDetailSkala1::where('no_rawat', $noRawat)->delete();
            RsiaDataTriaseUgdDetailSkala2::where('no_rawat', $noRawat)->delete();
            RsiaDataTriaseUgdDetailSkala3::where('no_rawat', $noRawat)->delete();
            RsiaDataTriaseUgdDetailSkala4::where('no_rawat', $noRawat)->delete();
            RsiaDataTriaseUgdDetailSkala5::where('no_rawat', $noRawat)->delete();

            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Tautan Triase berhasil dilepaskan'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal melepaskan tautan Triase: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getByNoRawat(Request $request)
    {
        $triase = RsiaTriasePreRegistrasi::where('no_rawat', $request->no_rawat)
            ->with('petugas')
            ->first();

        return response()->json([
            'status' => 'success',
            'data' => $triase
        ]);
    }
}
