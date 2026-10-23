<?php

namespace App\Http\Controllers;

use App\Models\ResepPulang;
use App\Models\PermintaanResepPulang;
use App\Models\DetailPermintaanResepPulang;
use App\Models\PermintaanResepPulangRacikan;
use App\Models\PermintaanResepPulangRacikanDetail;
use App\Models\DataBarang;
use App\Models\RegPeriksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResepPulangController extends Controller
{
    public function get(Request $request)
    {
        $query = ResepPulang::where('no_rawat', $request->no_rawat)
            ->with('obat', function ($query) {
                return $query->select(['kode_brng', 'nama_brng']);
            })
            ->get();
        return response()->json($query);
    }

    /**
     * Mengambil daftar Permintaan Resep Pulang (Tab 4 sesuai Khanza DlgDaftarPermintaanResep)
     */
    public function getPermintaan(Request $request)
    {
        $tglAwal = $request->tgl_awal ?: date('Y-m-d');
        $tglAkhir = $request->tgl_akhir ?: date('Y-m-d');
        $status = $request->status;
        $keyword = $request->keyword;

        $query = PermintaanResepPulang::query()
            ->with([
                'regPeriksa.pasien',
                'regPeriksa.penjab',
                'regPeriksa.kamarInap' => function ($q) {
                    $q->with('kamar.bangsal')->orderBy('tgl_masuk', 'desc')->orderBy('jam_masuk', 'desc');
                },
                'dokter',
                'detail.barang.kodeSatuan',
                'racikan.detail.barang.kodeSatuan',
            ])
            ->whereBetween('tgl_permintaan', [$tglAwal, $tglAkhir]);

        if ($status === 'Belum') {
            $query->where('status', 'Belum');
        } elseif ($status === 'Sudah') {
            $query->where('status', 'Sudah');
        }

        if (!empty($keyword)) {
            $query->where(function ($q) use ($keyword) {
                $q->where('no_permintaan', 'like', "%{$keyword}%")
                    ->orWhere('no_rawat', 'like', "%{$keyword}%")
                    ->orWhereHas('regPeriksa.pasien', function ($qp) use ($keyword) {
                        $qp->where('nm_pasien', 'like', "%{$keyword}%")
                            ->orWhere('no_rkm_medis', 'like', "%{$keyword}%");
                    })
                    ->orWhereHas('dokter', function ($qd) use ($keyword) {
                        $qd->where('nm_dokter', 'like', "%{$keyword}%");
                    });
            });
        }

        $data = $query->orderBy('tgl_permintaan', 'desc')
            ->orderBy('jam', 'desc')
            ->get();

        return response()->json($data);
    }

    /**
     * Mengambil detail item permintaan resep pulang untuk modal validasi farmasi
     */
    public function getDetailPermintaan($noPermintaan)
    {
        $permintaan = PermintaanResepPulang::where('no_permintaan', $noPermintaan)
            ->with([
                'regPeriksa.pasien',
                'regPeriksa.penjab',
                'regPeriksa.kamarInap' => function ($q) {
                    $q->with('kamar.bangsal')->orderBy('tgl_masuk', 'desc')->orderBy('jam_masuk', 'desc');
                },
                'dokter',
                'detail.barang.kodeSatuan',
                'racikan.detail.barang.kodeSatuan',
            ])
            ->first();

        if (!$permintaan) {
            return response()->json(['message' => 'Permintaan resep pulang tidak ditemukan'], 404);
        }

        // Ambil set embalase dan tuslah
        $setEmbalase = DB::table('set_embalase')->first();
        $embalasePerObat = (float)($setEmbalase->embalase_per_obat ?? 0);
        $tuslahPerObat = (float)($setEmbalase->tuslah_per_obat ?? 0);

        // Depo rawat inap default RM
        $kdBangsal = 'RM';
        $nmBangsal = DB::table('bangsal')->where('kd_bangsal', $kdBangsal)->value('nm_bangsal') ?? 'Depo Farmasi Ranap';

        // 1. Items Non-Racikan
        $itemsNonRacik = [];
        $totalBiayaNonRacik = 0;
        $totalEmbalaseNonRacik = 0;
        $totalTuslahNonRacik = 0;

        if ($permintaan->detail) {
            foreach ($permintaan->detail as $det) {
                $stok = DB::table('gudangbarang')
                    ->where('kode_brng', $det->kode_brng)
                    ->where('kd_bangsal', $kdBangsal)
                    ->value('stok') ?? 0;

                $harga = ($det->barang->ralan ?? 0) > 0 ? $det->barang->ralan : ($det->barang->h_beli ?? 0);
                $biayaObat = (float)($harga * $det->jml);
                $subtotal = $biayaObat + $embalasePerObat + $tuslahPerObat;

                $totalBiayaNonRacik += $biayaObat;
                $totalEmbalaseNonRacik += $embalasePerObat;
                $totalTuslahNonRacik += $tuslahPerObat;

                $itemsNonRacik[] = [
                    'kode_brng' => $det->kode_brng,
                    'nama_brng' => $det->barang->nama_brng ?? $det->kode_brng,
                    'satuan' => $det->barang->kodeSatuan->satuan ?? ($det->barang->kode_sat ?? ''),
                    'jml' => (float)$det->jml,
                    'dosis' => $det->dosis ?? '',
                    'stok_depo' => (float)$stok,
                    'harga' => (float)$harga,
                    'biaya_obat' => $biayaObat,
                    'embalase' => $embalasePerObat,
                    'tuslah' => $tuslahPerObat,
                    'total' => (float)$subtotal,
                ];
            }
        }

        // 2. Items Racikan
        $itemsRacik = [];
        $totalBiayaRacik = 0;
        $totalEmbalaseRacik = 0;
        $totalTuslahRacik = 0;

        if ($permintaan->racikan) {
            foreach ($permintaan->racikan as $r) {
                $racikBahan = [];
                $subtotalRacik = 0;

                if ($r->detail) {
                    foreach ($r->detail as $det) {
                        $stok = DB::table('gudangbarang')
                            ->where('kode_brng', $det->kode_brng)
                            ->where('kd_bangsal', $kdBangsal)
                            ->value('stok') ?? 0;

                        $harga = ($det->barang->ralan ?? 0) > 0 ? $det->barang->ralan : ($det->barang->h_beli ?? 0);
                        $biayaObat = (float)($harga * $det->jml);
                        $subtotalBahan = $biayaObat + $embalasePerObat + $tuslahPerObat;

                        $totalBiayaRacik += $biayaObat;
                        $totalEmbalaseRacik += $embalasePerObat;
                        $totalTuslahRacik += $tuslahPerObat;
                        $subtotalRacik += $subtotalBahan;

                        $racikBahan[] = [
                            'kode_brng' => $det->kode_brng,
                            'nama_brng' => $det->barang->nama_brng ?? $det->kode_brng,
                            'satuan' => $det->barang->kodeSatuan->satuan ?? ($det->barang->kode_sat ?? ''),
                            'p1' => $det->p1,
                            'p2' => $det->p2,
                            'kandungan' => $det->kandungan,
                            'jml' => (float)$det->jml,
                            'stok_depo' => (float)$stok,
                            'harga' => (float)$harga,
                            'biaya_obat' => $biayaObat,
                            'embalase' => $embalasePerObat,
                            'tuslah' => $tuslahPerObat,
                            'total' => (float)$subtotalBahan,
                        ];
                    }
                }

                $itemsRacik[] = [
                    'no_racik' => $r->no_racik,
                    'nama_racik' => $r->nama_racik,
                    'kd_racik' => $r->kd_racik,
                    'jml_dr' => (int)$r->jml_dr,
                    'aturan_pakai' => $r->aturan_pakai,
                    'keterangan' => $r->keterangan ?? '',
                    'subtotal' => $subtotalRacik,
                    'bahan' => $racikBahan,
                ];
            }
        }

        $grandTotalBiayaObat = $totalBiayaNonRacik + $totalBiayaRacik;
        $grandTotalEmbalase = $totalEmbalaseNonRacik + $totalEmbalaseRacik;
        $grandTotalTuslah = $totalTuslahNonRacik + $totalTuslahRacik;
        $grandTotal = $grandTotalBiayaObat + $grandTotalEmbalase + $grandTotalTuslah;

        return response()->json([
            'permintaan' => $permintaan,
            'kdBangsal' => $kdBangsal,
            'nmBangsal' => $nmBangsal,
            'items' => $itemsNonRacik, // Kompatibilitas tabel legacy
            'items_non_racikan' => $itemsNonRacik,
            'items_racikan' => $itemsRacik,
            'biaya_obat_netto' => $grandTotalBiayaObat,
            'total_embalase' => $grandTotalEmbalase,
            'total_tuslah' => $grandTotalTuslah,
            'grand_total' => $grandTotal,
            'is_validated' => $permintaan->status === 'Sudah',
        ]);
    }

    /**
     * Validasi Permintaan Resep Pulang ke tabel resep_pulang (sesuai Khanza DlgInputResepPulang)
     */
    public function validasiPermintaan(Request $request)
    {
        $request->validate(['no_permintaan' => 'required']);
        $noPermintaan = $request->no_permintaan;

        $permintaan = PermintaanResepPulang::where('no_permintaan', $noPermintaan)
            ->with(['detail.barang', 'racikan.detail.barang', 'regPeriksa'])
            ->first();

        if (!$permintaan) {
            return response()->json(['message' => 'Permintaan resep pulang tidak ditemukan'], 404);
        }

        if ($permintaan->status === 'Sudah') {
            return response()->json(['message' => 'Permintaan resep pulang ini sudah divalidasi sebelumnya'], 422);
        }

        $hasNonRacik = $permintaan->detail && $permintaan->detail->isNotEmpty();
        $hasRacik = $permintaan->racikan && $permintaan->racikan->isNotEmpty();

        if (!$hasNonRacik && !$hasRacik) {
            return response()->json(['message' => 'Belum ada item obat pada permintaan resep pulang ini'], 422);
        }

        $noRawat = $permintaan->no_rawat;
        $kdBangsal = 'RM'; // Depo Farmasi Ranap
        $tglValidasi = date('Y-m-d');
        $jamValidasi = date('H:i:s');

        $setEmbalase = DB::table('set_embalase')->first();
        $embalasePerObat = (float)($setEmbalase->embalase_per_obat ?? 0);
        $tuslahPerObat = (float)($setEmbalase->tuslah_per_obat ?? 0);

        DB::beginTransaction();
        try {
            // 1. Validasi Item Non-Racikan
            if ($hasNonRacik) {
                foreach ($permintaan->detail as $item) {
                    $barang = $item->barang;
                    $hBeli = $barang->h_beli ?? 0;
                    $harga = ($barang->ralan ?? 0) > 0 ? $barang->ralan : $hBeli;
                    $total = round(($harga * $item->jml) + $embalasePerObat + $tuslahPerObat);

                    // Simpan ke tabel resep_pulang
                    ResepPulang::create([
                        'no_rawat' => $noRawat,
                        'kode_brng' => $item->kode_brng,
                        'jml_barang' => $item->jml,
                        'harga' => $harga,
                        'total' => $total,
                        'h_beli' => $hBeli,
                        'dosis' => $item->dosis ?? '',
                        'embalase' => $embalasePerObat,
                        'tuslah' => $tuslahPerObat,
                        'tanggal' => $tglValidasi,
                        'jam' => $jamValidasi,
                        'kd_bangsal' => $kdBangsal,
                        'no_batch' => '',
                        'no_faktur' => '',
                    ]);

                    // Kurangi stok gudangbarang depo RM
                    $currentStok = DB::table('gudangbarang')
                        ->where('kode_brng', $item->kode_brng)
                        ->where('kd_bangsal', $kdBangsal)
                        ->value('stok') ?? 0;

                    $stokAkhir = max(0, $currentStok - $item->jml);
                    DB::table('gudangbarang')
                        ->where('kode_brng', $item->kode_brng)
                        ->where('kd_bangsal', $kdBangsal)
                        ->update(['stok' => $stokAkhir]);

                    // Catat riwayat barang medis
                    DB::table('riwayat_barang_medis')->insert([
                        'kode_brng' => $item->kode_brng,
                        'stok_awal' => $currentStok,
                        'masuk' => 0,
                        'keluar' => $item->jml,
                        'stok_akhir' => $stokAkhir,
                        'posisi' => 'Resep Pulang',
                        'tanggal' => $tglValidasi,
                        'jam' => $jamValidasi,
                        'petugas' => session()->get('pegawai')->nik ?? 'apotek',
                        'kd_bangsal' => $kdBangsal,
                        'status' => 'Simpan',
                        'no_batch' => '',
                        'no_faktur' => '',
                    ]);
                }
            }

            // 2. Validasi Item Racikan
            if ($hasRacik) {
                foreach ($permintaan->racikan as $r) {
                    $dosisRacikText = "[Racikan: {$r->nama_racik} ({$r->jml_dr} {$r->kd_racik})] {$r->aturan_pakai}";
                    if (!empty($r->keterangan)) {
                        $dosisRacikText .= " ({$r->keterangan})";
                    }

                    if ($r->detail) {
                        foreach ($r->detail as $b) {
                            $barang = $b->barang;
                            $hBeli = $barang->h_beli ?? 0;
                            $harga = ($barang->ralan ?? 0) > 0 ? $barang->ralan : $hBeli;
                            $total = round(($harga * $b->jml) + $embalasePerObat + $tuslahPerObat);

                            // Simpan ke tabel resep_pulang dengan penanda racikan
                            ResepPulang::create([
                                'no_rawat' => $noRawat,
                                'kode_brng' => $b->kode_brng,
                                'jml_barang' => $b->jml,
                                'harga' => $harga,
                                'total' => $total,
                                'h_beli' => $hBeli,
                                'dosis' => $dosisRacikText,
                                'embalase' => $embalasePerObat,
                                'tuslah' => $tuslahPerObat,
                                'tanggal' => $tglValidasi,
                                'jam' => $jamValidasi,
                                'kd_bangsal' => $kdBangsal,
                                'no_batch' => '',
                                'no_faktur' => '',
                            ]);

                            // Kurangi stok gudangbarang depo RM
                            $currentStok = DB::table('gudangbarang')
                                ->where('kode_brng', $b->kode_brng)
                                ->where('kd_bangsal', $kdBangsal)
                                ->value('stok') ?? 0;

                            $stokAkhir = max(0, $currentStok - $b->jml);
                            DB::table('gudangbarang')
                                ->where('kode_brng', $b->kode_brng)
                                ->where('kd_bangsal', $kdBangsal)
                                ->update(['stok' => $stokAkhir]);

                            // Catat riwayat barang medis
                            DB::table('riwayat_barang_medis')->insert([
                                'kode_brng' => $b->kode_brng,
                                'stok_awal' => $currentStok,
                                'masuk' => 0,
                                'keluar' => $b->jml,
                                'stok_akhir' => $stokAkhir,
                                'posisi' => 'Resep Pulang',
                                'tanggal' => $tglValidasi,
                                'jam' => $jamValidasi,
                                'petugas' => session()->get('pegawai')->nik ?? 'apotek',
                                'kd_bangsal' => $kdBangsal,
                                'status' => 'Simpan',
                                'no_batch' => '',
                                'no_faktur' => '',
                            ]);
                        }
                    }
                }
            }

            // 3. Update status permintaan_resep_pulang menjadi 'Sudah'
            $permintaan->update([
                'status' => 'Sudah',
                'tgl_validasi' => $tglValidasi,
                'jam_validasi' => $jamValidasi,
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => "Permintaan resep pulang {$noPermintaan} berhasil divalidasi dan dicatat ke resep pulang.",
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Gagal memvalidasi resep pulang: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Tambah/Ubah Item Non-Racikan pada Permintaan Resep Pulang sebelum divalidasi
     */
    public function simpanItemPermintaan(Request $request)
    {
        $request->validate([
            'no_permintaan' => 'required',
            'kode_brng' => 'required',
            'jml' => 'required|numeric|min:0.1',
        ]);

        $permintaan = PermintaanResepPulang::where('no_permintaan', $request->no_permintaan)->first();
        if (!$permintaan || $permintaan->status === 'Sudah') {
            return response()->json(['message' => 'Permintaan sudah divalidasi atau tidak ditemukan'], 422);
        }

        $exist = DetailPermintaanResepPulang::where('no_permintaan', $request->no_permintaan)
            ->where('kode_brng', $request->kode_brng)
            ->first();

        if ($exist) {
            $exist->update([
                'jml' => $request->jml,
                'dosis' => $request->dosis ?? $exist->dosis,
            ]);
        } else {
            DetailPermintaanResepPulang::create([
                'no_permintaan' => $request->no_permintaan,
                'kode_brng' => $request->kode_brng,
                'jml' => $request->jml,
                'dosis' => $request->dosis ?? '',
            ]);
        }

        return response()->json(['status' => true, 'message' => 'Item obat berhasil diperbarui']);
    }

    /**
     * Hapus Item Non-Racikan dari Permintaan Resep Pulang
     */
    public function hapusItemPermintaan(Request $request)
    {
        $request->validate([
            'no_permintaan' => 'required',
            'kode_brng' => 'required',
        ]);

        $permintaan = PermintaanResepPulang::where('no_permintaan', $request->no_permintaan)->first();
        if (!$permintaan || $permintaan->status === 'Sudah') {
            return response()->json(['message' => 'Permintaan sudah divalidasi atau tidak ditemukan'], 422);
        }

        DetailPermintaanResepPulang::where('no_permintaan', $request->no_permintaan)
            ->where('kode_brng', $request->kode_brng)
            ->delete();

        return response()->json(['status' => true, 'message' => 'Item obat berhasil dihapus']);
    }

    /**
     * Hapus Seluruh Racikan dari Permintaan Resep Pulang
     */
    public function hapusRacikanPermintaan(Request $request)
    {
        $request->validate([
            'no_permintaan' => 'required',
            'no_racik' => 'required',
        ]);

        $permintaan = PermintaanResepPulang::where('no_permintaan', $request->no_permintaan)->first();
        if (!$permintaan || $permintaan->status === 'Sudah') {
            return response()->json(['message' => 'Permintaan sudah divalidasi atau tidak ditemukan'], 422);
        }

        DB::transaction(function () use ($request) {
            PermintaanResepPulangRacikanDetail::where('no_permintaan', $request->no_permintaan)
                ->where('no_racik', $request->no_racik)
                ->delete();
            PermintaanResepPulangRacikan::where('no_permintaan', $request->no_permintaan)
                ->where('no_racik', $request->no_racik)
                ->delete();
        });

        return response()->json(['status' => true, 'message' => 'Racikan berhasil dihapus']);
    }

    /**
     * Generate Nomor Permintaan Resep Pulang (Sesuai Khanza DlgPermintaanResepPulang: RP + YYYYMMDD + 4 digit counter)
     */
    public function getNomorPermintaan(Request $request)
    {
        $tgl = $request->tgl_permintaan ?: date('Y-m-d');
        $prefix = 'RP' . date('Ymd', strtotime($tgl));

        $maxNum = DB::table('permintaan_resep_pulang')
            ->where('tgl_permintaan', $tgl)
            ->selectRaw('IFNULL(MAX(CONVERT(RIGHT(no_permintaan, 4), SIGNED)), 0) as max_num')
            ->value('max_num');

        $nextNum = intval($maxNum) + 1;
        $noPermintaan = $prefix . sprintf('%04d', $nextNum);

        return response()->json([
            'status' => true,
            'no_permintaan' => $noPermintaan,
            'tgl_permintaan' => $tgl,
            'jam' => date('H:i:s'),
        ]);
    }

    /**
     * Simpan Permintaan Resep Pulang dari Rawat Inap (Dokter / Perawat Bangsal)
     * Mendukung item non-racikan dan item racikan tersendiri
     */
    public function simpanPermintaan(Request $request)
    {
        $request->validate([
            'no_rawat' => 'required',
            'kd_dokter' => 'required',
        ]);

        $itemsNonRacik = $request->items_non_racikan ?? [];
        $itemsRacik = $request->items_racikan ?? [];

        // Fallback jika dikirim via array items legacy
        if (empty($itemsNonRacik) && empty($itemsRacik) && $request->has('items') && is_array($request->items)) {
            $itemsNonRacik = $request->items;
        }

        if (empty($itemsNonRacik) && empty($itemsRacik)) {
            return response()->json(['status' => false, 'message' => 'Daftar obat masih kosong! Masukkan minimal 1 obat atau racikan.'], 422);
        }

        try {
            return DB::transaction(function () use ($request, $itemsNonRacik, $itemsRacik) {
                $tgl = $request->tgl_permintaan ?: date('Y-m-d');
                $jam = $request->jam ?: date('H:i:s');

                $prefix = 'RP' . date('Ymd', strtotime($tgl));
                $maxNum = DB::table('permintaan_resep_pulang')
                    ->where('tgl_permintaan', $tgl)
                    ->lockForUpdate()
                    ->selectRaw('IFNULL(MAX(CONVERT(RIGHT(no_permintaan, 4), SIGNED)), 0) as max_num')
                    ->value('max_num');

                $nextNum = intval($maxNum) + 1;
                $noPermintaan = $prefix . sprintf('%04d', $nextNum);

                // 1. Simpan Header Permintaan Resep Pulang
                $permintaan = PermintaanResepPulang::create([
                    'no_permintaan' => $noPermintaan,
                    'tgl_permintaan' => $tgl,
                    'jam' => $jam,
                    'no_rawat' => $request->no_rawat,
                    'kd_dokter' => $request->kd_dokter,
                    'status' => 'Belum',
                    'tgl_validasi' => '0000-00-00',
                    'jam_validasi' => '00:00:00',
                ]);

                // 2. Simpan Item Non-Racikan
                if (!empty($itemsNonRacik)) {
                    $detailData = [];
                    foreach ($itemsNonRacik as $item) {
                        if (empty($item['kode_brng']) || empty($item['jml'])) continue;
                        $detailData[] = [
                            'no_permintaan' => $noPermintaan,
                            'kode_brng' => $item['kode_brng'],
                            'jml' => $item['jml'],
                            'dosis' => $item['dosis'] ?? '',
                        ];
                    }
                    if (!empty($detailData)) {
                        DetailPermintaanResepPulang::insert($detailData);
                    }
                }

                // 3. Simpan Item Racikan (Tabel Tersendiri)
                if (!empty($itemsRacik)) {
                    $noRacik = 1;
                    foreach ($itemsRacik as $r) {
                        if (empty($r['nama_racik']) || empty($r['bahan'])) continue;

                        PermintaanResepPulangRacikan::create([
                            'no_permintaan' => $noPermintaan,
                            'no_racik' => $noRacik,
                            'nama_racik' => $r['nama_racik'],
                            'kd_racik' => $r['metode'] ?? 'Puyer',
                            'jml_dr' => intval($r['jml_kemasan'] ?? 1),
                            'aturan_pakai' => $r['aturan_pakai'] ?? '',
                            'keterangan' => $r['keterangan'] ?? '',
                        ]);

                        $detailRacikData = [];
                        foreach ($r['bahan'] as $b) {
                            if (empty($b['kode_brng']) || empty($b['jml'])) continue;
                            $detailRacikData[] = [
                                'no_permintaan' => $noPermintaan,
                                'no_racik' => $noRacik,
                                'kode_brng' => $b['kode_brng'],
                                'p1' => $b['p1'] ?? 1,
                                'p2' => $b['p2'] ?? 1,
                                'kandungan' => $b['kandungan'] ?? 0,
                                'jml' => $b['jml'],
                            ];
                        }
                        if (!empty($detailRacikData)) {
                            PermintaanResepPulangRacikanDetail::insert($detailRacikData);
                        }
                        $noRacik++;
                    }
                }

                return response()->json([
                    'status' => true,
                    'message' => 'Permintaan resep pulang berhasil dikirim ke Farmasi dengan No: ' . $noPermintaan,
                    'no_permintaan' => $noPermintaan,
                ]);
            });
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menyimpan permintaan resep pulang: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Ambil riwayat permintaan resep pulang berdasarkan no_rawat
     */
    public function getRiwayatPasien($noRawat)
    {
        $noRawatDecoded = str_replace('-', '/', $noRawat);
        $data = PermintaanResepPulang::where('no_rawat', $noRawatDecoded)
            ->with([
                'dokter:kd_dokter,nm_dokter',
                'detail.barang.kodeSatuan',
                'racikan.detail.barang.kodeSatuan',
            ])
            ->orderBy('tgl_permintaan', 'desc')
            ->orderBy('jam', 'desc')
            ->get();

        return response()->json([
            'status' => true,
            'data' => $data,
        ]);
    }

    /**
     * Batal/Hapus Permintaan Resep Pulang (hanya jika belum divalidasi farmasi)
     */
    public function batalPermintaan($noPermintaan)
    {
        $permintaan = PermintaanResepPulang::where('no_permintaan', $noPermintaan)->first();
        if (!$permintaan) {
            return response()->json(['status' => false, 'message' => 'Data permintaan tidak ditemukan'], 404);
        }

        if ($permintaan->status === 'Sudah') {
            return response()->json([
                'status' => false,
                'message' => 'Permintaan ini sudah divalidasi oleh Farmasi dan tidak dapat dibatalkan',
            ], 422);
        }

        DB::transaction(function () use ($permintaan, $noPermintaan) {
            PermintaanResepPulangRacikanDetail::where('no_permintaan', $noPermintaan)->delete();
            PermintaanResepPulangRacikan::where('no_permintaan', $noPermintaan)->delete();
            DetailPermintaanResepPulang::where('no_permintaan', $noPermintaan)->delete();
            $permintaan->delete();
        });

        return response()->json([
            'status' => true,
            'message' => 'Permintaan resep pulang ' . $noPermintaan . ' berhasil dibatalkan',
        ]);
    }

    /**
     * Mengambil data item etiket resep pulang untuk dropdown cetak etiket
     */
    public function getEtiketItems($noPermintaan)
    {
        $permintaan = PermintaanResepPulang::where('no_permintaan', $noPermintaan)
            ->with([
                'regPeriksa.pasien',
                'regPeriksa.poliklinik',
                'regPeriksa.kamarInap' => function ($q) {
                    $q->with('kamar.bangsal')->orderBy('tgl_masuk', 'desc')->orderBy('jam_masuk', 'desc');
                },
                'dokter',
                'detail.barang.kodeSatuan',
                'racikan.detail.barang.kodeSatuan',
            ])
            ->first();

        if (!$permintaan) {
            return response()->json(['message' => 'Permintaan resep pulang tidak ditemukan'], 404);
        }

        $kamarDisplay = 'Rawat Inap';
        if ($permintaan->regPeriksa && $permintaan->regPeriksa->kamarInap) {
            $currentKamar = is_iterable($permintaan->regPeriksa->kamarInap)
                ? ($permintaan->regPeriksa->kamarInap->filter(fn($k) => $k->stts_pulang != 'Pindah Kamar')->first() ?? $permintaan->regPeriksa->kamarInap->first())
                : $permintaan->regPeriksa->kamarInap;
            if ($currentKamar && $currentKamar->kamar) {
                $bangsal = $currentKamar->kamar->bangsal->nm_bangsal ?? '';
                $kdKamar = $currentKamar->kd_kamar ?? '';
                $kamarDisplay = $bangsal ? "{$bangsal} ({$kdKamar})" : $kdKamar;
            }
        }

        $itemsUmum = [];
        $itemsRacik = [];

        // 1. Obat Non-Racik
        if ($permintaan->detail && count($permintaan->detail) > 0) {
            foreach ($permintaan->detail as $det) {
                $itemsUmum[] = [
                    'kode' => $det->kode_brng,
                    'nama' => $det->barang->nama_brng ?? $det->kode_brng,
                    'satuan' => $det->barang->kodeSatuan->satuan ?? ($det->barang->kode_sat ?? 'TAB'),
                    'jml' => (float)$det->jml,
                    'aturan_pakai' => $det->dosis ?: 'Sesuai Petunjuk Dokter',
                ];
            }
        }

        // 2. Obat Racikan (Dari tabel permintaan_resep_pulang_racikan)
        if ($permintaan->racikan && count($permintaan->racikan) > 0) {
            foreach ($permintaan->racikan as $r) {
                $detailBahan = [];
                if ($r->detail) {
                    foreach ($r->detail as $b) {
                        $nm = $b->barang->nama_brng ?? $b->kode_brng;
                        $detailBahan[] = $nm;
                    }
                }

                $itemsRacik[] = [
                    'kode' => $r->no_racik,
                    'nama' => $r->nama_racik,
                    'satuan' => $r->kd_racik ?: 'Bungkus',
                    'jml' => (int)$r->jml_dr,
                    'aturan_pakai' => $r->aturan_pakai ?: 'Sesuai Petunjuk Dokter',
                    'detail_racik' => $detailBahan,
                ];
            }
        }

        return response()->json([
            'no_resep' => $permintaan->no_permintaan,
            'pasien' => $permintaan->regPeriksa->pasien ?? null,
            'dokter' => $permintaan->dokter->nm_dokter ?? '-',
            'poli' => $kamarDisplay,
            'items_umum' => $itemsUmum,
            'items_racik' => $itemsRacik,
        ]);
    }

    /**
     * Cetak PDF Etiket Resep Pulang (Sesuai Khanza DlgResepObat & DlgInputResepPulang)
     */
    public function printEtiket(Request $request, $noPermintaan = null)
    {
        $noPermintaan = $noPermintaan ?: $request->no_permintaan;
        if (!$noPermintaan) {
            abort(404, 'Nomor Permintaan Resep Pulang tidak ditemukan');
        }

        $ukuran = $request->ukuran ?: '6.5x4';
        $itemType = $request->item_type; // 'all', 'umum', 'racik'
        $itemKey = $request->item_key;

        $permintaan = PermintaanResepPulang::where('no_permintaan', $noPermintaan)
            ->with([
                'regPeriksa.pasien',
                'regPeriksa.poliklinik',
                'regPeriksa.kamarInap' => function ($q) {
                    $q->with('kamar.bangsal')->orderBy('tgl_masuk', 'desc')->orderBy('jam_masuk', 'desc');
                },
                'dokter',
                'detail.barang.kodeSatuan',
                'racikan.detail.barang.kodeSatuan',
            ])->first();

        if (!$permintaan) {
            abort(404, 'Data permintaan resep pulang tidak ditemukan');
        }

        $setting = DB::table('setting')->first();
        $logoFile = public_path('img/LOGO RSIA .png');
        if (file_exists($logoFile)) {
            $logoBase64 = base64_encode(file_get_contents($logoFile));
        } else {
            $logoBase64 = ($setting && !empty($setting->logo)) ? base64_encode($setting->logo) : null;
        }

        $tglResep = (!empty($permintaan->tgl_permintaan) && $permintaan->tgl_permintaan !== '0000-00-00')
            ? date('d/m/Y', strtotime($permintaan->tgl_permintaan))
            : date('d/m/Y');

        $jamResep = (!empty($permintaan->jam) && $permintaan->jam !== '00:00:00')
            ? substr($permintaan->jam, 0, 8)
            : date('H:i:s');

        $kamarDisplay = 'Rawat Inap';
        if ($permintaan->regPeriksa && $permintaan->regPeriksa->kamarInap) {
            $currentKamar = is_iterable($permintaan->regPeriksa->kamarInap)
                ? ($permintaan->regPeriksa->kamarInap->filter(fn($k) => $k->stts_pulang != 'Pindah Kamar')->first() ?? $permintaan->regPeriksa->kamarInap->first())
                : $permintaan->regPeriksa->kamarInap;
            if ($currentKamar && $currentKamar->kamar) {
                $bangsal = $currentKamar->kamar->bangsal->nm_bangsal ?? '';
                $kdKamar = $currentKamar->kd_kamar ?? '';
                $kamarDisplay = $bangsal ? "{$bangsal} ({$kdKamar})" : $kdKamar;
            }
        }

        $items = [];

        // 1. Item Non-Racikan
        if (!$itemType || $itemType === 'all' || $itemType === 'umum') {
            if ($permintaan->detail && count($permintaan->detail) > 0) {
                foreach ($permintaan->detail as $det) {
                    if ($itemKey && $itemType === 'umum' && $det->kode_brng != $itemKey) {
                        continue;
                    }

                    $items[] = [
                        'tipe' => 'umum',
                        'kode' => $det->kode_brng,
                        'nama' => $det->barang->nama_brng ?? $det->kode_brng,
                        'satuan' => $det->barang->kodeSatuan->satuan ?? ($det->barang->kode_sat ?? 'TAB'),
                        'jml' => (float)$det->jml,
                        'aturan_pakai' => $det->dosis ?: 'Sesuai Petunjuk Dokter',
                        'jenis' => '',
                        'keterangan' => '',
                        'detail_racik' => [],
                    ];
                }
            }
        }

        // 2. Item Racikan
        if (!$itemType || $itemType === 'all' || $itemType === 'racik') {
            if ($permintaan->racikan && count($permintaan->racikan) > 0) {
                foreach ($permintaan->racikan as $r) {
                    if ($itemKey && $itemType === 'racik' && $r->no_racik != $itemKey) {
                        continue;
                    }

                    $detailBahan = [];
                    if ($r->detail) {
                        foreach ($r->detail as $b) {
                            $nm = $b->barang->nama_brng ?? $b->kode_brng;
                            $detailBahan[] = $nm;
                        }
                    }

                    $items[] = [
                        'tipe' => 'racik',
                        'kode' => $r->no_racik,
                        'nama' => $r->nama_racik,
                        'satuan' => $r->kd_racik ?: 'Bungkus',
                        'jml' => (int)$r->jml_dr,
                        'aturan_pakai' => $r->aturan_pakai ?: 'Sesuai Petunjuk Dokter',
                        'jenis' => '',
                        'keterangan' => $r->keterangan ?: '',
                        'detail_racik' => $detailBahan,
                    ];
                }
            }
        }

        if (empty($items)) {
            $items[] = [
                'tipe' => 'umum',
                'kode' => '-',
                'nama' => 'Tidak Ada Obat',
                'satuan' => '-',
                'jml' => 0,
                'aturan_pakai' => '-',
                'jenis' => '',
                'keterangan' => '',
                'detail_racik' => [],
            ];
        }

        // Ukuran stiker dalam satuan points (1 cm = 28.3465 pt)
        $dimensions = [
            '6.5x4' => [184.25, 113.39], // Default SIMRS Khanza Model 1 & 2 (184pt x 113pt)
            '8x5'   => [226.77, 141.73], // 8 x 5 cm
            '7x5'   => [198.43, 141.73], // 7 x 5 cm
            '8x6'   => [226.77, 170.08], // 8 x 6 cm
            '5x3'   => [141.73, 85.04],  // 5 x 3 cm
            '5x5.8' => [144.00, 165.00], // SIMRS Khanza Model 3 Portrait (144pt x 165pt)
        ];

        $paperSize = $dimensions[$ukuran] ?? $dimensions['6.5x4'];

        $resepObj = (object)[
            'no_resep' => $permintaan->no_permintaan,
            'regPeriksa' => $permintaan->regPeriksa,
            'status' => 'ranap',
            'dokter' => $permintaan->dokter,
        ];

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('content.print.etiket_obat', [
            'resep' => $resepObj,
            'items' => $items,
            'setting' => $setting,
            'ukuran' => $ukuran,
            'paperSize' => $paperSize,
            'logoBase64' => $logoBase64,
            'tglResep' => $tglResep,
            'jamResep' => $jamResep,
            'kamarDisplay' => $kamarDisplay,
        ])
        ->setPaper([0, 0, $paperSize[0], $paperSize[1]])
        ->setOptions([
            'defaultFont' => 'Helvetica',
            'isRemoteEnabled' => true,
            'isHtml5ParserEnabled' => true,
        ]);

        return $pdf->stream("etiket-pulang-{$noPermintaan}-{$ukuran}.pdf");
    }
}
