<?php

namespace App\Http\Controllers;

use App\Models\AturanPakai;
use App\Models\DataBarang;
use App\Models\DetailPemberianObat;
use App\Models\DetailPermintaanStokObatPasien;
use App\Models\GudangBarang;
use App\Models\KamarInap;
use App\Models\PermintaanStokObatPasien;
use App\Models\RegPeriksa;
use App\Models\StokObatPasien;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class PermintaanStokObatPasienController extends Controller
{
    protected $track;

    public function __construct()
    {
        $this->track = new TrackerSqlController();
    }

    /**
     * Generate auto nomor permintaan stok obat pasien: SP + Ymd + 4-digit urutan
     */
    public function getNomor(): string
    {
        $prefix = "SP" . date('Ymd');
        $last = PermintaanStokObatPasien::where('no_permintaan', 'like', "{$prefix}%")
            ->orderBy('no_permintaan', 'desc')
            ->value('no_permintaan');

        if (!$last) {
            return "{$prefix}0001";
        }

        $lastNum = (int) substr($last, -4);
        $nextNum = str_pad($lastNum + 1, 4, '0', STR_PAD_LEFT);
        return "{$prefix}{$nextNum}";
    }

    /**
     * Simpan permintaan stok obat ranap (Tahap 1: Ruangan order obat)
     */
    public function simpan(Request $request): JsonResponse
    {
        $request->validate([
            'no_rawat' => 'required',
            'kd_dokter' => 'required',
            'obat' => 'required|array|min:1',
        ]);

        $noPermintaan = $this->getNomor();
        $tglNow = date('Y-m-d');
        $jamNow = date('H:i:s');

        DB::beginTransaction();
        try {
            $headerData = [
                'no_permintaan' => $noPermintaan,
                'tgl_permintaan' => $tglNow,
                'jam' => $jamNow,
                'no_rawat' => $request->no_rawat,
                'kd_dokter' => $request->kd_dokter,
                'status' => 'Belum',
                'tgl_validasi' => '0000-00-00',
                'jam_validasi' => '00:00:00',
            ];

            $permintaan = PermintaanStokObatPasien::create($headerData);
            if ($permintaan) {
                $this->track->insertSql(new PermintaanStokObatPasien(), $headerData);
            }

            foreach ($request->obat as $item) {
                $detailData = [
                    'no_permintaan' => $noPermintaan,
                    'kode_brng' => $item['kode_brng'],
                    'jml' => (float) ($item['jml'] ?? 1),
                    'aturan_pakai' => $item['aturan_pakai'] ?? '-',
                    'jam00' => !empty($item['jam00']) && ($item['jam00'] === true || $item['jam00'] === 'true' || $item['jam00'] === '1' || $item['jam00'] === 1) ? 'true' : 'false',
                    'jam01' => !empty($item['jam01']) && ($item['jam01'] === true || $item['jam01'] === 'true' || $item['jam01'] === '1' || $item['jam01'] === 1) ? 'true' : 'false',
                    'jam02' => !empty($item['jam02']) && ($item['jam02'] === true || $item['jam02'] === 'true' || $item['jam02'] === '1' || $item['jam02'] === 1) ? 'true' : 'false',
                    'jam03' => !empty($item['jam03']) && ($item['jam03'] === true || $item['jam03'] === 'true' || $item['jam03'] === '1' || $item['jam03'] === 1) ? 'true' : 'false',
                    'jam04' => !empty($item['jam04']) && ($item['jam04'] === true || $item['jam04'] === 'true' || $item['jam04'] === '1' || $item['jam04'] === 1) ? 'true' : 'false',
                    'jam05' => !empty($item['jam05']) && ($item['jam05'] === true || $item['jam05'] === 'true' || $item['jam05'] === '1' || $item['jam05'] === 1) ? 'true' : 'false',
                    'jam06' => !empty($item['jam06']) && ($item['jam06'] === true || $item['jam06'] === 'true' || $item['jam06'] === '1' || $item['jam06'] === 1) ? 'true' : 'false',
                    'jam07' => !empty($item['jam07']) && ($item['jam07'] === true || $item['jam07'] === 'true' || $item['jam07'] === '1' || $item['jam07'] === 1) ? 'true' : 'false',
                    'jam08' => !empty($item['jam08']) && ($item['jam08'] === true || $item['jam08'] === 'true' || $item['jam08'] === '1' || $item['jam08'] === 1) ? 'true' : 'false',
                    'jam09' => !empty($item['jam09']) && ($item['jam09'] === true || $item['jam09'] === 'true' || $item['jam09'] === '1' || $item['jam09'] === 1) ? 'true' : 'false',
                    'jam10' => !empty($item['jam10']) && ($item['jam10'] === true || $item['jam10'] === 'true' || $item['jam10'] === '1' || $item['jam10'] === 1) ? 'true' : 'false',
                    'jam11' => !empty($item['jam11']) && ($item['jam11'] === true || $item['jam11'] === 'true' || $item['jam11'] === '1' || $item['jam11'] === 1) ? 'true' : 'false',
                    'jam12' => !empty($item['jam12']) && ($item['jam12'] === true || $item['jam12'] === 'true' || $item['jam12'] === '1' || $item['jam12'] === 1) ? 'true' : 'false',
                    'jam13' => !empty($item['jam13']) && ($item['jam13'] === true || $item['jam13'] === 'true' || $item['jam13'] === '1' || $item['jam13'] === 1) ? 'true' : 'false',
                    'jam14' => !empty($item['jam14']) && ($item['jam14'] === true || $item['jam14'] === 'true' || $item['jam14'] === '1' || $item['jam14'] === 1) ? 'true' : 'false',
                    'jam15' => !empty($item['jam15']) && ($item['jam15'] === true || $item['jam15'] === 'true' || $item['jam15'] === '1' || $item['jam15'] === 1) ? 'true' : 'false',
                    'jam16' => !empty($item['jam16']) && ($item['jam16'] === true || $item['jam16'] === 'true' || $item['jam16'] === '1' || $item['jam16'] === 1) ? 'true' : 'false',
                    'jam17' => !empty($item['jam17']) && ($item['jam17'] === true || $item['jam17'] === 'true' || $item['jam17'] === '1' || $item['jam17'] === 1) ? 'true' : 'false',
                    'jam18' => !empty($item['jam18']) && ($item['jam18'] === true || $item['jam18'] === 'true' || $item['jam18'] === '1' || $item['jam18'] === 1) ? 'true' : 'false',
                    'jam19' => !empty($item['jam19']) && ($item['jam19'] === true || $item['jam19'] === 'true' || $item['jam19'] === '1' || $item['jam19'] === 1) ? 'true' : 'false',
                    'jam20' => !empty($item['jam20']) && ($item['jam20'] === true || $item['jam20'] === 'true' || $item['jam20'] === '1' || $item['jam20'] === 1) ? 'true' : 'false',
                    'jam21' => !empty($item['jam21']) && ($item['jam21'] === true || $item['jam21'] === 'true' || $item['jam21'] === '1' || $item['jam21'] === 1) ? 'true' : 'false',
                    'jam22' => !empty($item['jam22']) && ($item['jam22'] === true || $item['jam22'] === 'true' || $item['jam22'] === '1' || $item['jam22'] === 1) ? 'true' : 'false',
                    'jam23' => !empty($item['jam23']) && ($item['jam23'] === true || $item['jam23'] === 'true' || $item['jam23'] === '1' || $item['jam23'] === 1) ? 'true' : 'false',
                ];

                DetailPermintaanStokObatPasien::create($detailData);
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Permintaan stok obat berhasil dikirim ke Farmasi',
                'no_permintaan' => $noPermintaan,
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Gagal menyimpan permintaan obat: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Ambil data permintaan obat (list per pasien atau per tanggal)
     */
    public function get(Request $request): JsonResponse
    {
        $query = PermintaanStokObatPasien::with([
            'detailPermintaan.dataBarang.kodeSatuan',
            'regPeriksa.pasien',
            'regPeriksa.kamarInap' => function ($q) {
                $q->where('stts_pulang', '-')->with('kamar.bangsal');
            },
            'dokter',
        ]);

        if ($request->filled('no_rawat')) {
            $query->where('no_rawat', $request->no_rawat);
        }

        if ($request->filled('tgl_permintaan')) {
            $query->where('tgl_permintaan', $request->tgl_permintaan);
        } elseif ($request->filled('tgl_awal') && $request->filled('tgl_akhir')) {
            $query->whereBetween('tgl_permintaan', [$request->tgl_awal, $request->tgl_akhir]);
        }

        if ($request->filled('status') && $request->status !== 'Semua') {
            $query->where('status', $request->status);
        }

        $data = $query->orderBy('tgl_permintaan', 'desc')
            ->orderBy('jam', 'desc')
            ->get();

        return response()->json($data);
    }

    /**
     * Ambil detail spesifik satu nomor permintaan
     */
    public function getDetail($no_permintaan): JsonResponse
    {
        $permintaan = PermintaanStokObatPasien::where('no_permintaan', $no_permintaan)
            ->with([
                'detailPermintaan.dataBarang.kodeSatuan',
                'regPeriksa.pasien',
                'regPeriksa.kamarInap' => function ($q) {
                    $q->where('stts_pulang', '-')->with('kamar.bangsal');
                },
                'dokter',
            ])
            ->first();

        if (!$permintaan) {
            return response()->json(['message' => 'Data permintaan obat tidak ditemukan'], 404);
        }

        return response()->json($permintaan);
    }

    /**
     * Hapus permintaan obat (hanya jika status Belum divalidasi)
     */
    public function hapus($no_permintaan): JsonResponse
    {
        $permintaan = PermintaanStokObatPasien::where('no_permintaan', $no_permintaan)->first();

        if (!$permintaan) {
            return response()->json(['message' => 'Data permintaan obat tidak ditemukan'], 404);
        }

        if ($permintaan->status === 'Sudah') {
            return response()->json(['message' => 'Permintaan sudah disiapkan/divalidasi oleh Farmasi dan tidak dapat dihapus.'], 422);
        }

        DB::beginTransaction();
        try {
            DetailPermintaanStokObatPasien::where('no_permintaan', $no_permintaan)->delete();
            $permintaan->delete();
            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Permintaan obat berhasil dibatalkan/dihapus',
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Gagal menghapus permintaan obat: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Farmasi Menyiapkan & Memvalidasi Permintaan Obat (Tahap 2)
     */
    public function validasi(Request $request): JsonResponse
    {
        $request->validate([
            'no_permintaan' => 'required',
        ]);

        $permintaan = PermintaanStokObatPasien::where('no_permintaan', $request->no_permintaan)
            ->with('detailPermintaan')
            ->first();

        if (!$permintaan) {
            return response()->json(['message' => 'Permintaan obat tidak ditemukan'], 404);
        }

        if ($permintaan->status === 'Sudah') {
            return response()->json(['message' => 'Permintaan obat ini sudah pernah divalidasi'], 422);
        }

        $tglValidasi = date('Y-m-d');
        $jamValidasi = date('H:i:s');
        $kdBangsal = $request->kd_bangsal ?: 'RM'; // Default depo farmasi rawat inap
        $nikPetugas = session()->get('pegawai')->nik ?? '-';

        DB::beginTransaction();
        try {
            // Update header status
            $permintaan->update([
                'status' => 'Sudah',
                'tgl_validasi' => $tglValidasi,
                'jam_validasi' => $jamValidasi,
            ]);

            // Siapkan barang ke stok_obat_pasien dan kurangi gudangbarang
            foreach ($permintaan->detailPermintaan as $detail) {
                $noBatch = $request->no_batch ?? '';
                $noFaktur = $request->no_faktur ?? '';

                $stokPasienData = [
                    'tanggal' => $tglValidasi,
                    'jam' => $jamValidasi,
                    'no_rawat' => $permintaan->no_rawat,
                    'kode_brng' => $detail->kode_brng,
                    'jumlah' => $detail->jml,
                    'kd_bangsal' => $kdBangsal,
                    'no_batch' => $noBatch,
                    'no_faktur' => $noFaktur,
                    'aturan_pakai' => $detail->aturan_pakai,
                    'jam00' => $detail->jam00,
                    'jam01' => $detail->jam01,
                    'jam02' => $detail->jam02,
                    'jam03' => $detail->jam03,
                    'jam04' => $detail->jam04,
                    'jam05' => $detail->jam05,
                    'jam06' => $detail->jam06,
                    'jam07' => $detail->jam07,
                    'jam08' => $detail->jam08,
                    'jam09' => $detail->jam09,
                    'jam10' => $detail->jam10,
                    'jam11' => $detail->jam11,
                    'jam12' => $detail->jam12,
                    'jam13' => $detail->jam13,
                    'jam14' => $detail->jam14,
                    'jam15' => $detail->jam15,
                    'jam16' => $detail->jam16,
                    'jam17' => $detail->jam17,
                    'jam18' => $detail->jam18,
                    'jam19' => $detail->jam19,
                    'jam20' => $detail->jam20,
                    'jam21' => $detail->jam21,
                    'jam22' => $detail->jam22,
                    'jam23' => $detail->jam23,
                ];

                StokObatPasien::create($stokPasienData);

                // Potong stok di gudangbarang
                $gudang = GudangBarang::where('kode_brng', $detail->kode_brng)
                    ->where('kd_bangsal', $kdBangsal)
                    ->where('no_batch', $noBatch)
                    ->where('no_faktur', $noFaktur)
                    ->first();

                $stokAwal = $gudang ? $gudang->stok : 0;
                $stokAkhir = $stokAwal - $detail->jml;

                if ($gudang) {
                    $gudang->decrement('stok', $detail->jml);
                } else {
                    GudangBarang::create([
                        'kode_brng' => $detail->kode_brng,
                        'kd_bangsal' => $kdBangsal,
                        'stok' => -$detail->jml,
                        'no_batch' => $noBatch,
                        'no_faktur' => $noFaktur,
                    ]);
                }

                // Catat ke riwayat_barang_medis
                DB::table('riwayat_barang_medis')->insert([
                    'kode_brng' => $detail->kode_brng,
                    'stok_awal' => $stokAwal,
                    'masuk' => 0,
                    'keluar' => $detail->jml,
                    'stok_akhir' => $stokAkhir,
                    'posisi' => 'Stok Pasien Ranap',
                    'tanggal' => $tglValidasi,
                    'jam' => $jamValidasi,
                    'petugas' => $nikPetugas,
                    'kd_bangsal' => $kdBangsal,
                    'status' => 'Simpan',
                    'no_batch' => $noBatch,
                    'no_faktur' => $noFaktur,
                    'keterangan' => $permintaan->no_rawat,
                ]);
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Obat berhasil disiapkan dan divalidasi ke Stok Pasien',
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Gagal memvalidasi permintaan: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Ambil data stok obat pasien & jadwal jam pemberian (Tahap 3 E-MAR)
     */
    public function getStokPasien(Request $request): JsonResponse
    {
        $request->validate([
            'no_rawat' => 'required',
        ]);

        $noRawat = $request->no_rawat;
        $tanggal = $request->tanggal ?: date('Y-m-d');

        // Ambil master stok obat pasien untuk no_rawat ini
        $stokItems = StokObatPasien::where('no_rawat', $noRawat)
            ->with(['dataBarang.kodeSatuan'])
            ->get();

        // Group by kode_brng, no_batch, no_faktur
        $grouped = [];
        foreach ($stokItems as $item) {
            $key = $item->kode_brng . '_' . $item->no_batch . '_' . $item->no_faktur;
            if (!isset($grouped[$key])) {
                $grouped[$key] = [
                    'kode_brng' => $item->kode_brng,
                    'nama_brng' => $item->dataBarang->nama_brng ?? '-',
                    'satuan' => $item->dataBarang->kodeSatuan->satuan ?? '-',
                    'no_batch' => $item->no_batch,
                    'no_faktur' => $item->no_faktur,
                    'kd_bangsal' => $item->kd_bangsal,
                    'aturan_pakai' => $item->aturan_pakai,
                    'total_masuk' => 0,
                    'masuk_hari_ini' => 0,
                    'total_diberikan' => 0,
                    'sisa_stok' => 0,
                    'jadwal_jam' => [],
                    'pemberian_hari_ini' => [],
                ];

                // Inisialisasi jadwal jam 00-23
                for ($i = 0; $i <= 23; $i++) {
                    $jamCol = 'jam' . sprintf('%02d', $i);
                    $grouped[$key]['jadwal_jam'][$jamCol] = false;
                }
            }

            $grouped[$key]['total_masuk'] += (float) $item->jumlah;
            if ($item->tanggal === $tanggal) {
                $grouped[$key]['masuk_hari_ini'] += (float) $item->jumlah;
            }

            // Gabungkan jadwal jam true
            for ($i = 0; $i <= 23; $i++) {
                $jamCol = 'jam' . sprintf('%02d', $i);
                if ($item->{$jamCol} === 'true') {
                    $grouped[$key]['jadwal_jam'][$jamCol] = true;
                }
            }
        }

        // Hitung total pengeluaran obat dari detail_pemberian_obat (Status Ranap)
        foreach ($grouped as $key => &$val) {
            $pemberianTotal = DetailPemberianObat::where('no_rawat', $noRawat)
                ->where('kode_brng', $val['kode_brng'])
                ->where('no_batch', $val['no_batch'])
                ->where('no_faktur', $val['no_faktur'])
                ->where('status', 'Ranap')
                ->sum('jml');

            $val['total_diberikan'] = (float) $pemberianTotal;
            $val['sisa_stok'] = max(0, $val['total_masuk'] - $val['total_diberikan']);

            // Detail pemberian khusus tanggal yang dipilih (E-MAR hari ini)
            $pemberianHariIni = DetailPemberianObat::where('no_rawat', $noRawat)
                ->where('kode_brng', $val['kode_brng'])
                ->where('no_batch', $val['no_batch'])
                ->where('no_faktur', $val['no_faktur'])
                ->where('status', 'Ranap')
                ->where('tgl_perawatan', $tanggal)
                ->get();

            $val['pemberian_hari_ini'] = $pemberianHariIni;
        }

        return response()->json([
            'status' => true,
            'tanggal' => $tanggal,
            'data' => array_values($grouped),
        ]);
    }

    /**
     * Eksekusi Pemberian Obat ke Pasien oleh Ruangan/Perawat (E-MAR)
     */
    public function beriObat(Request $request): JsonResponse
    {
        $request->validate([
            'no_rawat' => 'required',
            'kode_brng' => 'required',
            'jml' => 'required|numeric|min:0.01',
        ]);

        $noRawat = $request->no_rawat;
        $kodeBrng = $request->kode_brng;
        $tglPerawatan = $request->tgl_perawatan ?: date('Y-m-d');
        $jam = $request->jam ?: date('H:i:s');
        $jml = (float) $request->jml;
        $noBatch = $request->no_batch ?? '';
        $noFaktur = $request->no_faktur ?? '';
        $kdBangsal = $request->kd_bangsal ?: 'RM';
        $aturanPakai = $request->aturan_pakai ?? '-';

        // Ambil data kamar inap untuk menentukan kelas tarif
        $kamarInap = KamarInap::where('no_rawat', $noRawat)
            ->where('stts_pulang', '-')
            ->with('kamar')
            ->first();

        $kelas = $kamarInap->kamar->kelas ?? 'Kelas 1';

        // Ambil data barang & harga jual sesuai kelas
        $barang = DataBarang::where('kode_brng', $kodeBrng)->first();
        if (!$barang) {
            return response()->json(['message' => 'Data obat tidak ditemukan'], 404);
        }

        $hBeli = (float) $barang->dasar ?: (float) $barang->h_beli;
        $biayaObat = (float) $barang->kelas1;

        if (stripos($kelas, 'Kelas 1') !== false) {
            $biayaObat = (float) $barang->kelas1;
        } elseif (stripos($kelas, 'Kelas 2') !== false) {
            $biayaObat = (float) $barang->kelas2;
        } elseif (stripos($kelas, 'Kelas 3') !== false) {
            $biayaObat = (float) $barang->kelas3;
        } elseif (stripos($kelas, 'Utama') !== false) {
            $biayaObat = (float) $barang->utama;
        } elseif (stripos($kelas, 'VIP') !== false && stripos($kelas, 'VVIP') === false) {
            $biayaObat = (float) $barang->vip;
        } elseif (stripos($kelas, 'VVIP') !== false) {
            $biayaObat = (float) $barang->vvip;
        }

        if ($biayaObat <= 0) {
            $biayaObat = $hBeli > 0 ? ceil($hBeli * 1.2) : (float) $barang->ralan;
        }

        $total = $biayaObat * $jml;

        DB::beginTransaction();
        try {
            // Masukkan ke detail_pemberian_obat
            DetailPemberianObat::create([
                'tgl_perawatan' => $tglPerawatan,
                'jam' => $jam,
                'no_rawat' => $noRawat,
                'kode_brng' => $kodeBrng,
                'h_beli' => $hBeli,
                'biaya_obat' => $biayaObat,
                'jml' => $jml,
                'embalase' => 0,
                'tuslah' => 0,
                'total' => $total,
                'status' => 'Ranap',
                'kd_bangsal' => $kdBangsal,
                'no_batch' => $noBatch,
                'no_faktur' => $noFaktur,
            ]);

            // Catat ke aturan_pakai
            AturanPakai::updateOrCreate(
                [
                    'tgl_perawatan' => $tglPerawatan,
                    'jam' => $jam,
                    'no_rawat' => $noRawat,
                    'kode_brng' => $kodeBrng,
                ],
                [
                    'aturan' => $aturanPakai,
                ]
            );

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Pemberian obat berhasil dicatat ke rekam medis & billing pasien',
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Gagal mencatat pemberian obat: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Batalkan / Hapus satu rekaman pemberian obat (jika belum diverifikasi kasir)
     */
    public function hapusPemberian(Request $request): JsonResponse
    {
        $request->validate([
            'no_rawat' => 'required',
            'kode_brng' => 'required',
            'tgl_perawatan' => 'required',
            'jam' => 'required',
        ]);

        DB::beginTransaction();
        try {
            DetailPemberianObat::where('no_rawat', $request->no_rawat)
                ->where('kode_brng', $request->kode_brng)
                ->where('tgl_perawatan', $request->tgl_perawatan)
                ->where('jam', $request->jam)
                ->where('no_batch', $request->no_batch ?? '')
                ->where('no_faktur', $request->no_faktur ?? '')
                ->where('status', 'Ranap')
                ->delete();

            AturanPakai::where('no_rawat', $request->no_rawat)
                ->where('kode_brng', $request->kode_brng)
                ->where('tgl_perawatan', $request->tgl_perawatan)
                ->where('jam', $request->jam)
                ->delete();

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Pemberian obat berhasil dihapus',
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Gagal menghapus catatan pemberian obat: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Riwayat pemberian obat pasien untuk tabel log
     */
    public function riwayatPemberian(Request $request): JsonResponse
    {
        $request->validate([
            'no_rawat' => 'required',
        ]);

        $query = DetailPemberianObat::where('no_rawat', $request->no_rawat)
            ->where('status', 'Ranap')
            ->with(['dataBarang.kodeSatuan', 'aturanPakai']);

        if ($request->filled('tanggal')) {
            $query->where('tgl_perawatan', $request->tanggal);
        }

        $data = $query->orderBy('tgl_perawatan', 'desc')
            ->orderBy('jam', 'desc')
            ->get();

        return response()->json($data);
    }
}
