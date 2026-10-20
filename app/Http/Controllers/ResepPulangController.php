<?php

namespace App\Http\Controllers;

use App\Models\ResepPulang;
use App\Models\PermintaanResepPulang;
use App\Models\DetailPermintaanResepPulang;
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
     * Mengambil detail item permintaan resep pulang untuk modal validasi
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

        $items = [];
        if ($permintaan->detail) {
            foreach ($permintaan->detail as $det) {
                $stok = DB::table('gudangbarang')
                    ->where('kode_brng', $det->kode_brng)
                    ->where('kd_bangsal', $kdBangsal)
                    ->value('stok') ?? 0;

                $harga = ($det->barang->ralan ?? 0) > 0 ? $det->barang->ralan : ($det->barang->h_beli ?? 0);
                $biayaObat = (float)($harga * $det->jml);
                $subtotal = $biayaObat + $embalasePerObat + $tuslahPerObat;

                $items[] = [
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

        return response()->json([
            'permintaan' => $permintaan,
            'kdBangsal' => $kdBangsal,
            'nmBangsal' => $nmBangsal,
            'items' => $items,
            'embalase_per_obat' => $embalasePerObat,
            'tuslah_per_obat' => $tuslahPerObat,
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
            ->with(['detail.barang', 'regPeriksa'])
            ->first();

        if (!$permintaan) {
            return response()->json(['message' => 'Permintaan resep pulang tidak ditemukan'], 404);
        }

        if ($permintaan->status === 'Sudah') {
            return response()->json(['message' => 'Permintaan resep pulang ini sudah divalidasi sebelumnya'], 422);
        }

        if ($permintaan->detail->isEmpty()) {
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
            foreach ($permintaan->detail as $item) {
                $barang = $item->barang;
                $hBeli = $barang->h_beli ?? 0;
                $harga = ($barang->ralan ?? 0) > 0 ? $barang->ralan : $hBeli;
                $total = round(($harga * $item->jml) + $embalasePerObat + $tuslahPerObat);

                // 1. Simpan ke tabel resep_pulang
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

                // 2. Kurangi stok gudangbarang depo RM
                $currentStok = DB::table('gudangbarang')
                    ->where('kode_brng', $item->kode_brng)
                    ->where('kd_bangsal', $kdBangsal)
                    ->value('stok') ?? 0;

                $stokAkhir = max(0, $currentStok - $item->jml);
                DB::table('gudangbarang')
                    ->where('kode_brng', $item->kode_brng)
                    ->where('kd_bangsal', $kdBangsal)
                    ->update(['stok' => $stokAkhir]);

                // 3. Catat riwayat barang medis
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

            // 4. Update status permintaan_resep_pulang menjadi 'Sudah'
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
     * Tambah/Ubah Item pada Permintaan Resep Pulang sebelum divalidasi
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
     * Hapus Item dari Permintaan Resep Pulang
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
     */
    public function simpanPermintaan(Request $request)
    {
        $request->validate([
            'no_rawat' => 'required',
            'kd_dokter' => 'required',
            'items' => 'required|array|min:1',
            'items.*.kode_brng' => 'required',
            'items.*.jml' => 'required|numeric|min:0.01',
            'items.*.dosis' => 'nullable|string',
        ]);

        try {
            return DB::transaction(function () use ($request) {
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

                // 2. Simpan Detail Item Obat
                $detailData = [];
                foreach ($request->items as $item) {
                    $detailData[] = [
                        'no_permintaan' => $noPermintaan,
                        'kode_brng' => $item['kode_brng'],
                        'jml' => $item['jml'],
                        'dosis' => $item['dosis'] ?? '',
                    ];
                }
                DetailPermintaanResepPulang::insert($detailData);

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
            DetailPermintaanResepPulang::where('no_permintaan', $noPermintaan)->delete();
            $permintaan->delete();
        });

        return response()->json([
            'status' => true,
            'message' => 'Permintaan resep pulang ' . $noPermintaan . ' berhasil dibatalkan',
        ]);
    }
}
