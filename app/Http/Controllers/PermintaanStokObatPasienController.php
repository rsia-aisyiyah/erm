<?php

namespace App\Http\Controllers;

use App\Models\AturanPakai;
use App\Models\CatatanPemberianObatPasien;
use App\Models\DataBarang;
use App\Models\DetailPemberianObat;
use App\Models\DetailPermintaanStokObatPasien;
use App\Models\GudangBarang;
use App\Models\KamarInap;
use App\Models\PermintaanStokObatPasien;
use App\Models\RegPeriksa;
use App\Models\StokObatPasien;
use Exception;
use Carbon\Carbon;
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
                'telaahFarmasi.petugas',
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
                    DB::table('gudangbarang')
                        ->where('kode_brng', $gudang->kode_brng)
                        ->where('kd_bangsal', $gudang->kd_bangsal)
                        ->where('no_batch', $gudang->no_batch)
                        ->where('no_faktur', $gudang->no_faktur)
                        ->decrement('stok', $detail->jml);
                } else {
                    DB::table('gudangbarang')->insert([
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
     * Ambil antrean permintaan obat rawat inap untuk dashboard Farmasi
     */
    public function getFarmasiData(Request $request): JsonResponse
    {
        $query = PermintaanStokObatPasien::with([
            'detailPermintaan.dataBarang.kodeSatuan',
            'regPeriksa.pasien',
            'regPeriksa.penjab',
            'regPeriksa.kamarInap' => function ($q) {
                $q->where('stts_pulang', '-')->with('kamar.bangsal');
            },
            'dokter',
            'telaahFarmasi.petugas',
        ]);

        if ($request->filled('tgl_awal') && $request->filled('tgl_akhir')) {
            $query->whereBetween('tgl_permintaan', [$request->tgl_awal, $request->tgl_akhir]);
        } elseif ($request->filled('tgl_permintaan')) {
            $query->where('tgl_permintaan', $request->tgl_permintaan);
        } else {
            $query->where('tgl_permintaan', date('Y-m-d'));
        }

        if ($request->filled('status') && $request->status !== 'Semua') {
            $query->where('status', $request->status);
        }

        if ($request->filled('keyword')) {
            $kw = '%' . $request->keyword . '%';
            $query->where(function ($q) use ($kw) {
                $q->where('no_permintaan', 'like', $kw)
                    ->orWhere('no_rawat', 'like', $kw)
                    ->orWhereHas('regPeriksa.pasien', function ($qp) use ($kw) {
                        $qp->where('nm_pasien', 'like', $kw)->orWhere('no_rkm_medis', 'like', $kw);
                    })
                    ->orWhereHas('dokter', function ($qd) use ($kw) {
                        $qd->where('nm_dokter', 'like', $kw);
                    });
            });
        }

        $data = $query->orderBy('tgl_permintaan', 'desc')
            ->orderBy('jam', 'desc')
            ->get();

        return response()->json($data);
    }

    /**
     * Substitusi / Ganti item obat pada permintaan stok obat pasien
     */
    public function substitusi(Request $request): JsonResponse
    {
        $request->validate([
            'no_permintaan' => 'required',
            'kode_brng_lama' => 'required',
            'kode_brng_baru' => 'required',
        ]);

        $permintaan = PermintaanStokObatPasien::where('no_permintaan', $request->no_permintaan)->first();
        if (!$permintaan) {
            return response()->json(['message' => 'Permintaan obat tidak ditemukan'], 404);
        }

        if ($permintaan->status === 'Sudah') {
            return response()->json(['message' => 'Permintaan sudah divalidasi, tidak dapat mensubstitusi obat.'], 422);
        }

        $detail = DetailPermintaanStokObatPasien::where('no_permintaan', $request->no_permintaan)
            ->where('kode_brng', $request->kode_brng_lama)
            ->first();

        if (!$detail) {
            return response()->json(['message' => 'Item obat asal tidak ditemukan pada permintaan ini'], 404);
        }

        if ($request->kode_brng_lama !== $request->kode_brng_baru) {
            $isExist = DB::table('detail_permintaan_stok_obat_pasien')
                ->where('no_permintaan', $request->no_permintaan)
                ->where('kode_brng', $request->kode_brng_baru)
                ->exists();

            if ($isExist) {
                return response()->json([
                    'message' => 'Obat pengganti sudah ada dalam daftar permintaan ini. Silakan sesuaikan jumlah obat yang sudah ada.'
                ], 422);
            }
        }

        DB::beginTransaction();
        try {
            DB::table('detail_permintaan_stok_obat_pasien')
                ->where('no_permintaan', $request->no_permintaan)
                ->where('kode_brng', $request->kode_brng_lama)
                ->update([
                    'kode_brng' => $request->kode_brng_baru,
                    'jml' => $request->filled('jml') ? (float)$request->jml : $detail->jml,
                    'aturan_pakai' => $request->filled('aturan_pakai') ? $request->aturan_pakai : $detail->aturan_pakai,
                ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Item obat berhasil disubstitusi / diganti',
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Gagal mensubstitusi obat: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Ubah Jumlah, Aturan Pakai & Jadwal Jam Pemberian pada detail permintaan obat
     */
    public function ubahAturanPakai(Request $request): JsonResponse
    {
        $request->validate([
            'no_permintaan' => 'required',
            'kode_brng' => 'required',
            'aturan_pakai' => 'nullable|string',
            'jml' => 'nullable|numeric|min:0.01',
        ]);

        $permintaan = PermintaanStokObatPasien::where('no_permintaan', $request->no_permintaan)->first();
        if (!$permintaan) {
            return response()->json(['message' => 'Permintaan obat tidak ditemukan'], 404);
        }

        if ($permintaan->status === 'Sudah') {
            return response()->json(['message' => 'Permintaan sudah divalidasi, tidak dapat mengubah item obat.'], 422);
        }

        $detail = DetailPermintaanStokObatPasien::where('no_permintaan', $request->no_permintaan)
            ->where('kode_brng', $request->kode_brng)
            ->first();

        if (!$detail) {
            return response()->json(['message' => 'Item obat tidak ditemukan pada permintaan ini'], 404);
        }

        $updateData = [];

        if ($request->has('aturan_pakai') && $request->aturan_pakai !== null) {
            $updateData['aturan_pakai'] = $request->aturan_pakai;
        }

        if ($request->has('jml') && $request->jml !== null) {
            $updateData['jml'] = (float) $request->jml;
        }

        // Update jadwal jam bila ada
        for ($h = 0; $h <= 23; $h++) {
            $key = 'jam' . sprintf('%02d', $h);
            if ($request->has($key)) {
                $val = $request->input($key);
                $updateData[$key] = (!empty($val) && ($val === true || $val === 'true' || $val === '1' || $val === 1)) ? 'true' : 'false';
            }
        }

        if (empty($updateData)) {
            return response()->json(['message' => 'Tidak ada data yang diperbarui'], 422);
        }

        DB::beginTransaction();
        try {
            DB::table('detail_permintaan_stok_obat_pasien')
                ->where('no_permintaan', $request->no_permintaan)
                ->where('kode_brng', $request->kode_brng)
                ->update($updateData);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Rincian obat (jumlah / aturan pakai / jam) berhasil diperbarui',
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Gagal memperbarui item obat: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Ambil data stok obat pasien & jadwal jam pemberian (Tahap 3 E-MAR)
     * Menggabungkan Pintu 1 (Resep Dokter CPPT Ranap) & Pintu 2 (Permintaan Harian/UDD)
     */
    public function getStokPasien(Request $request): JsonResponse
    {
        $request->validate([
            'no_rawat' => 'required',
        ]);

        $noRawat = $request->no_rawat;
        $rawTgl = $request->tanggal;
        $tanggal = date('Y-m-d');
        if ($rawTgl) {
            try {
                $clean = str_replace('/', '-', trim($rawTgl));
                $tanggal = Carbon::parse($clean)->format('Y-m-d');
            } catch (\Throwable $e) {
                $tanggal = date('Y-m-d');
            }
        }
        $grouped = [];

        // 1. PINTU 2: Ambil dari Permintaan Stok Obat Pasien (UDD / Harian)
        $stokItems = StokObatPasien::where('no_rawat', $noRawat)
            ->with(['dataBarang.kodeSatuan'])
            ->get();

        foreach ($stokItems as $item) {
            $key = 'harian_' . $item->kode_brng . '_' . $item->no_batch . '_' . $item->no_faktur;
            if (!isset($grouped[$key])) {
                $grouped[$key] = [
                    'key' => $key,
                    'sumber' => 'permintaan_harian',
                    'is_prebilled' => false,
                    'sumber_label' => 'Permintaan Harian / BHP',
                    'no_resep' => null,
                    'kode_brng' => $item->kode_brng,
                    'nama_brng' => $item->dataBarang->nama_brng ?? '-',
                    'satuan' => $item->dataBarang->kodeSatuan->satuan ?? '-',
                    'kapasitas' => (float) ($item->dataBarang->kapasitas ?? 0),
                    'no_batch' => $item->no_batch,
                    'no_faktur' => $item->no_faktur,
                    'kd_bangsal' => $item->kd_bangsal,
                    'aturan_pakai' => $item->aturan_pakai,
                    'first_date' => $item->tanggal,
                    'total_masuk' => 0,
                    'masuk_hari_ini' => 0,
                    'total_diberikan' => 0,
                    'sisa_stok' => 0,
                    'jadwal_jam' => [],
                    'pemberian_hari_ini' => [],
                ];

                for ($i = 0; $i <= 23; $i++) {
                    $jamCol = 'jam' . sprintf('%02d', $i);
                    $grouped[$key]['jadwal_jam'][$jamCol] = false;
                }
            }

            if ($item->tanggal < $grouped[$key]['first_date']) {
                $grouped[$key]['first_date'] = $item->tanggal;
            }

            $grouped[$key]['total_masuk'] += (float) $item->jumlah;
            if ($item->tanggal === $tanggal) {
                $grouped[$key]['masuk_hari_ini'] += (float) $item->jumlah;
            }

            for ($i = 0; $i <= 23; $i++) {
                $jamCol = 'jam' . sprintf('%02d', $i);
                if ($item->{$jamCol} === 'true') {
                    $grouped[$key]['jadwal_jam'][$jamCol] = true;
                }
            }
        }

        // 2. PINTU 1: Ambil dari Resep Dokter Ranap (CPPT) yang sudah divalidasi Farmasi
        $resepRanap = DB::table('resep_obat')
            ->join('resep_dokter', 'resep_obat.no_resep', '=', 'resep_dokter.no_resep')
            ->join('databarang', 'resep_dokter.kode_brng', '=', 'databarang.kode_brng')
            ->leftJoin('kodesatuan', 'databarang.kode_sat', '=', 'kodesatuan.kode_sat')
            ->where('resep_obat.no_rawat', $noRawat)
            ->where('resep_obat.status', 'ranap')
            ->where('resep_obat.tgl_perawatan', '<>', '0000-00-00')
            ->select([
                'resep_obat.no_resep',
                'resep_obat.tgl_perawatan as tgl_validasi',
                'resep_obat.jam as jam_validasi',
                'resep_dokter.kode_brng',
                'databarang.nama_brng',
                'databarang.kapasitas',
                'kodesatuan.satuan',
                'resep_dokter.jml',
                'resep_dokter.aturan_pakai',
            ])
            ->get();

        foreach ($resepRanap as $r) {
            $key = 'resep_' . $r->kode_brng . '_' . $r->no_resep;
            if (!isset($grouped[$key])) {
                $grouped[$key] = [
                    'key' => $key,
                    'sumber' => 'resep_dokter',
                    'is_prebilled' => true,
                    'sumber_label' => 'Resep Dokter (' . $r->no_resep . ')',
                    'no_resep' => $r->no_resep,
                    'kode_brng' => $r->kode_brng,
                    'nama_brng' => $r->nama_brng,
                    'satuan' => $r->satuan ?: 'Sat',
                    'kapasitas' => (float) ($r->kapasitas ?? 0),
                    'no_batch' => '',
                    'no_faktur' => '',
                    'kd_bangsal' => 'RM',
                    'aturan_pakai' => $r->aturan_pakai ?: '-',
                    'first_date' => $r->tgl_validasi,
                    'total_masuk' => (float) $r->jml,
                    'masuk_hari_ini' => ($r->tgl_validasi === $tanggal) ? (float) $r->jml : 0,
                    'total_diberikan' => 0,
                    'sisa_stok' => 0,
                    'jadwal_jam' => [],
                    'pemberian_hari_ini' => [],
                ];

                for ($i = 0; $i <= 23; $i++) {
                    $jamCol = 'jam' . sprintf('%02d', $i);
                    $grouped[$key]['jadwal_jam'][$jamCol] = false;
                }

                // Auto-schedule jam berdasarkan aturan pakai
                $aturan = strtolower($r->aturan_pakai);
                if (strpos($aturan, '1x') !== false || strpos($aturan, '1 x') !== false) {
                    if (strpos($aturan, 'malam') !== false || strpos($aturan, '19') !== false) {
                        $grouped[$key]['jadwal_jam']['jam19'] = true;
                    } else {
                        $grouped[$key]['jadwal_jam']['jam07'] = true;
                    }
                } elseif (strpos($aturan, '2x') !== false || strpos($aturan, '2 x') !== false) {
                    $grouped[$key]['jadwal_jam']['jam07'] = true;
                    $grouped[$key]['jadwal_jam']['jam19'] = true;
                } elseif (strpos($aturan, '3x') !== false || strpos($aturan, '3 x') !== false) {
                    $grouped[$key]['jadwal_jam']['jam07'] = true;
                    $grouped[$key]['jadwal_jam']['jam13'] = true;
                    $grouped[$key]['jadwal_jam']['jam19'] = true;
                } elseif (strpos($aturan, '4x') !== false || strpos($aturan, '4 x') !== false) {
                    $grouped[$key]['jadwal_jam']['jam07'] = true;
                    $grouped[$key]['jadwal_jam']['jam13'] = true;
                    $grouped[$key]['jadwal_jam']['jam19'] = true;
                    $grouped[$key]['jadwal_jam']['jam01'] = true;
                } elseif (strpos($aturan, '8 jam') !== false || strpos($aturan, '8h') !== false) {
                    $grouped[$key]['jadwal_jam']['jam06'] = true;
                    $grouped[$key]['jadwal_jam']['jam14'] = true;
                    $grouped[$key]['jadwal_jam']['jam22'] = true;
                } else {
                    $grouped[$key]['jadwal_jam']['jam07'] = true;
                }
            } else {
                $grouped[$key]['total_masuk'] += (float) $r->jml;
            }
        }

        // 3. Hitung pengeluaran klinis dari catatan_pemberian_obat_pasien (dengan fallback)
        foreach ($grouped as $key => &$val) {
            $catatanQuery = CatatanPemberianObatPasien::where('no_rawat', $noRawat)
                ->where('kode_brng', $val['kode_brng'])
                ->where('sumber', $val['sumber']);

            if (!empty($val['first_date'])) {
                $catatanQuery->where('tgl_perawatan', '>=', $val['first_date']);
            }

            $totalKlinis = (float) $catatanQuery->sum('dosis_klinis');

            // Fallback ke DetailPemberianObat jika catatan_pemberian_obat_pasien belum ada untuk data lama
            if ($totalKlinis <= 0 && $val['sumber'] === 'permintaan_harian') {
                $pemberianLegacy = DetailPemberianObat::where('no_rawat', $noRawat)
                    ->where('kode_brng', $val['kode_brng'])
                    ->where('status', 'Ranap');
                if (!empty($val['first_date'])) {
                    $pemberianLegacy->where('tgl_perawatan', '>=', $val['first_date']);
                }
                $totalKlinis = (float) $pemberianLegacy->sum('jml');
            }

            $val['total_diberikan'] = $totalKlinis;
            $val['sisa_stok'] = max(0, $val['total_masuk'] - $val['total_diberikan']);

            // Detail pemberian khusus tanggal yang dipilih (E-MAR hari ini)
            $pemberianHariIni = CatatanPemberianObatPasien::where('no_rawat', $noRawat)
                ->where('kode_brng', $val['kode_brng'])
                ->where('sumber', $val['sumber'])
                ->where('tgl_perawatan', $tanggal)
                ->get();

            if ($pemberianHariIni->isEmpty() && $val['sumber'] === 'permintaan_harian') {
                $legacyHariIni = DetailPemberianObat::where('no_rawat', $noRawat)
                    ->where('kode_brng', $val['kode_brng'])
                    ->where('status', 'Ranap')
                    ->where('tgl_perawatan', $tanggal)
                    ->get()
                    ->map(function ($leg) {
                        return [
                            'id' => null,
                            'jam' => $leg->jam,
                            'dosis_klinis' => (float) $leg->jml,
                            'status_billing' => 'Sudah Dibilkan',
                        ];
                    });
                $val['pemberian_hari_ini'] = $legacyHariIni;
            } else {
                $val['pemberian_hari_ini'] = $pemberianHariIni->map(function ($cat) {
                    return [
                        'id' => $cat->id,
                        'jam' => $cat->jam,
                        'dosis_klinis' => (float) $cat->dosis_klinis,
                        'status_billing' => $cat->status_billing,
                        'keterangan' => $cat->keterangan,
                    ];
                });
            }
        }

        return response()->json([
            'status' => true,
            'tanggal' => $tanggal,
            'data' => array_values($grouped),
        ]);
    }

    /**
     * Eksekusi Pemberian Obat ke Pasien oleh Ruangan/Perawat (E-MAR)
     * Mencatat dosis klinis ke catatan_pemberian_obat_pasien dan mengelola status billing
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
        $rawTgl = $request->tgl_perawatan;
        $tglPerawatan = date('Y-m-d');
        if ($rawTgl) {
            try {
                $clean = str_replace('/', '-', trim($rawTgl));
                $tglPerawatan = Carbon::parse($clean)->format('Y-m-d');
            } catch (\Throwable $e) {
                $tglPerawatan = date('Y-m-d');
            }
        }
        $jam = $request->jam ?: date('H:i:s');
        $jml = (float) $request->jml;
        $noBatch = $request->no_batch ?? '';
        $noFaktur = $request->no_faktur ?? '';
        $kdBangsal = $request->kd_bangsal ?: 'RM';
        $aturanPakai = $request->aturan_pakai ?? '-';
        $sumber = $request->sumber ?: 'permintaan_harian';
        $noResep = $request->no_resep ?? null;
        $nipPerawat = session()->get('pegawai')->nik ?? (session()->get('user')->username ?? '-');

        // Ambil data barang
        $barang = DataBarang::with('kodeSatuan')->where('kode_brng', $kodeBrng)->first();
        if (!$barang) {
            return response()->json(['message' => 'Data obat tidak ditemukan'], 404);
        }

        $satuan = $barang->kodeSatuan->satuan ?? 'satuan';

        // Hitung harga obat sesuai kelas kamar
        $kamarInap = KamarInap::where('no_rawat', $noRawat)->where('stts_pulang', '-')->with('kamar')->first();
        $kelas = $kamarInap->kamar->kelas ?? 'Kelas 1';
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

        DB::beginTransaction();
        try {
            // Tentukan status billing:
            // 1. Jika sumber dari resep_dokter: sudah ter-billing di depan saat validasi resep!
            // 2. Jika sumber permintaan_harian & BHP bulat: langsung billing
            // 3. Jika sumber permintaan_harian & obat pecahan: menunggu verifikasi Farmasi
            $statusBilling = 'Menunggu Verifikasi';
            $jmlBilling = 0;

            if ($sumber === 'resep_dokter') {
                $statusBilling = 'Sudah Dibilkan';
                $jmlBilling = $jml;
            } else {
                $nama = strtolower($barang->nama_brng);
                $isBhp = (strpos($nama, 'spuit') !== false ||
                          strpos($nama, 'abocath') !== false ||
                          strpos($nama, 'iv set') !== false ||
                          strpos($nama, 'infus set') !== false ||
                          strpos($nama, 'kassa') !== false ||
                          strpos($nama, 'plaster') !== false ||
                          strpos($nama, 'plester') !== false ||
                          strpos($nama, 'needle') !== false ||
                          strpos($nama, 'wing') !== false ||
                          strpos($nama, 'underpad') !== false ||
                          stripos($satuan, 'pcs') !== false ||
                          stripos($satuan, 'biji') !== false);

                if ($isBhp && fmod($jml, 1) == 0) {
                    $statusBilling = 'Sudah Dibilkan';
                    $jmlBilling = $jml;

                    DetailPemberianObat::create([
                        'tgl_perawatan' => $tglPerawatan,
                        'jam' => $jam,
                        'no_rawat' => $noRawat,
                        'kode_brng' => $kodeBrng,
                        'h_beli' => $hBeli,
                        'biaya_obat' => $biayaObat,
                        'jml' => $jmlBilling,
                        'embalase' => 0,
                        'tuslah' => 0,
                        'total' => $biayaObat * $jmlBilling,
                        'status' => 'Ranap',
                        'kd_bangsal' => $kdBangsal,
                        'no_batch' => $noBatch,
                        'no_faktur' => $noFaktur,
                    ]);
                } else {
                    $statusBilling = 'Menunggu Verifikasi';
                    $jmlBilling = 0;
                }
            }

            // Catat ke catatan_pemberian_obat_pasien (Rekam Medis Klinis E-MAR)
            CatatanPemberianObatPasien::create([
                'no_rawat' => $noRawat,
                'kode_brng' => $kodeBrng,
                'tgl_perawatan' => $tglPerawatan,
                'jam' => $jam,
                'dosis_klinis' => $jml,
                'satuan' => $satuan,
                'aturan_pakai' => $aturanPakai,
                'kd_bangsal' => $kdBangsal,
                'no_batch' => $noBatch,
                'no_faktur' => $noFaktur,
                'nip_perawat' => $nipPerawat,
                'sumber' => $sumber,
                'no_resep' => $noResep,
                'keterangan' => $request->keterangan ?? null,
                'status_pemberian' => 'Sudah Diberikan',
                'status_billing' => $statusBilling,
                'jml_billing' => $jmlBilling,
            ]);

            // Catat juga ke aturan_pakai standar Khanza
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
                'message' => $statusBilling === 'Sudah Dibilkan'
                    ? 'Pemberian obat berhasil dicatat ke E-MAR'
                    : 'Pemberian obat klinis berhasil dicatat ke E-MAR (Menunggu verifikasi pembulatan Farmasi)',
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
     * Batalkan / Hapus satu rekaman pemberian obat di E-MAR
     */
    public function hapusPemberian(Request $request): JsonResponse
    {
        $id = $request->id;
        $catatan = null;

        if ($id) {
            $catatan = CatatanPemberianObatPasien::find($id);
        } else {
            $catatan = CatatanPemberianObatPasien::where('no_rawat', $request->no_rawat)
                ->where('kode_brng', $request->kode_brng)
                ->where('tgl_perawatan', $request->tgl_perawatan)
                ->where('jam', $request->jam)
                ->first();
        }

        if (!$catatan) {
            // Fallback legacy DetailPemberianObat
            DetailPemberianObat::where('no_rawat', $request->no_rawat)
                ->where('kode_brng', $request->kode_brng)
                ->where('tgl_perawatan', $request->tgl_perawatan)
                ->where('jam', $request->jam)
                ->where('status', 'Ranap')
                ->delete();

            return response()->json([
                'status' => true,
                'message' => 'Pemberian obat berhasil dihapus',
            ]);
        }

        DB::beginTransaction();
        try {
            // Jika sudah terlanjur terbit di detail_pemberian_obat, hapus juga
            if ($catatan->status_billing === 'Sudah Dibilkan' && $catatan->sumber === 'permintaan_harian' && $catatan->jml_billing > 0) {
                DetailPemberianObat::where('no_rawat', $catatan->no_rawat)
                    ->where('kode_brng', $catatan->kode_brng)
                    ->where('tgl_perawatan', $catatan->tgl_perawatan)
                    ->where('status', 'Ranap')
                    ->where('jml', $catatan->jml_billing)
                    ->delete();
            }

            AturanPakai::where('no_rawat', $catatan->no_rawat)
                ->where('kode_brng', $catatan->kode_brng)
                ->where('tgl_perawatan', $catatan->tgl_perawatan)
                ->where('jam', $catatan->jam)
                ->delete();

            $catatan->delete();

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Catatan pemberian obat berhasil dihapus',
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
     * Riwayat pemberian obat pasien untuk tabel log E-MAR
     */
    public function riwayatPemberian(Request $request): JsonResponse
    {
        $request->validate([
            'no_rawat' => 'required',
        ]);

        $query = CatatanPemberianObatPasien::where('no_rawat', $request->no_rawat)
            ->with(['dataBarang.kodeSatuan', 'pegawaiPerawat', 'pegawaiFarmasi']);

        if ($request->filled('tanggal')) {
            try {
                $clean = str_replace('/', '-', trim($request->tanggal));
                $filterTgl = Carbon::parse($clean)->format('Y-m-d');
            } catch (\Throwable $e) {
                $filterTgl = $request->tanggal;
            }
            $query->where('tgl_perawatan', $filterTgl);
        }

        $catatan = $query->orderBy('jam', 'desc')->get();

        if ($catatan->isEmpty()) {
            // Fallback legacy
            $legacyQuery = DetailPemberianObat::where('no_rawat', $request->no_rawat)
                ->where('status', 'Ranap')
                ->with(['dataBarang.kodeSatuan', 'aturanPakai']);
            if (isset($filterTgl) && $filterTgl) {
                $legacyQuery->where('tgl_perawatan', $filterTgl);
            }
            $legacy = $legacyQuery->orderBy('jam', 'desc')->get();

            $data = $legacy->map(function ($leg) {
                return [
                    'id' => null,
                    'no_rawat' => $leg->no_rawat,
                    'kode_brng' => $leg->kode_brng,
                    'tgl_perawatan' => $leg->tgl_perawatan,
                    'jam' => $leg->jam,
                    'dosis_klinis' => (float) $leg->jml,
                    'satuan' => $leg->dataBarang->kodeSatuan->satuan ?? '-',
                    'nama_brng' => $leg->dataBarang->nama_brng ?? $leg->kode_brng,
                    'aturan_pakai' => $leg->aturanPakai->aturan ?? '-',
                    'sumber' => 'permintaan_harian',
                    'sumber_badge' => 'Permintaan Harian',
                    'status_pemberian' => 'Sudah Diberikan',
                    'status_billing' => 'Sudah Dibilkan',
                    'jml_billing' => (float) $leg->jml,
                    'biaya_satuan' => (float) $leg->biaya_obat,
                    'total_biaya' => (float) $leg->total,
                    'perawat' => '-',
                    'farmasi' => '-',
                ];
            });

            return response()->json($data);
        }

        $data = $catatan->map(function ($row) {
            $biayaObat = (float) ($row->dataBarang->kelas1 ?? $row->dataBarang->ralan ?? 0);
            return [
                'id' => $row->id,
                'no_rawat' => $row->no_rawat,
                'kode_brng' => $row->kode_brng,
                'tgl_perawatan' => $row->tgl_perawatan,
                'jam' => $row->jam,
                'dosis_klinis' => (float) $row->dosis_klinis,
                'satuan' => $row->satuan ?: ($row->dataBarang->kodeSatuan->satuan ?? '-'),
                'nama_brng' => $row->dataBarang->nama_brng ?? $row->kode_brng,
                'aturan_pakai' => $row->aturan_pakai,
                'keterangan' => $row->keterangan ?? '',
                'sumber' => $row->sumber,
                'sumber_badge' => $row->sumber === 'resep_dokter' ? 'Resep Dokter' : 'Permintaan Harian',
                'status_pemberian' => $row->status_pemberian,
                'status_billing' => $row->status_billing,
                'jml_billing' => (float) $row->jml_billing,
                'biaya_satuan' => $biayaObat,
                'total_biaya' => $row->status_billing === 'Sudah Dibilkan' ? ($biayaObat * ($row->jml_billing ?: $row->dosis_klinis)) : 0,
                'perawat' => $row->pegawaiPerawat->nama ?? $row->nip_perawat,
                'farmasi' => $row->pegawaiFarmasi->nama ?? $row->nip_farmasi,
            ];
        });

        return response()->json($data);
    }

    /**
     * Ambil data rekonsiliasi E-MAR harian untuk divalidasi & dibulatkan oleh Farmasi
     */
    public function getRekonsiliasiEmar(Request $request): JsonResponse
    {
        $tanggal = $request->tanggal ?: date('Y-m-d');
        $statusBilling = $request->status_billing ?: 'Menunggu Verifikasi';

        $query = CatatanPemberianObatPasien::with([
            'regPeriksa.pasien',
            'regPeriksa.kamarInap' => function ($q) {
                $q->with('kamar.bangsal')->where('stts_pulang', '-');
            },
            'dataBarang.kodeSatuan',
            'pegawaiPerawat',
        ])
        ->where('tgl_perawatan', $tanggal)
        ->where('sumber', 'permintaan_harian');

        if ($statusBilling !== 'Semua') {
            $query->where('status_billing', $statusBilling);
        }

        $records = $query->orderBy('no_rawat')->orderBy('jam')->get();

        $grouped = [];
        foreach ($records as $rec) {
            $key = $rec->no_rawat . '_' . $rec->kode_brng;
            if (!isset($grouped[$key])) {
                $kamar = '-';
                if ($rec->regPeriksa && $rec->regPeriksa->kamarInap && $rec->regPeriksa->kamarInap->count() > 0) {
                    $activeK = $rec->regPeriksa->kamarInap->first();
                    $kamar = ($activeK->kamar->bangsal->nm_bangsal ?? '') . ' (' . ($activeK->kd_kamar ?? '-') . ')';
                }

                $hBeli = (float) ($rec->dataBarang->dasar ?: $rec->dataBarang->h_beli);
                $biayaSatuan = (float) ($rec->dataBarang->kelas1 ?: ($hBeli > 0 ? ceil($hBeli * 1.2) : (float) $rec->dataBarang->ralan));

                $grouped[$key] = [
                    'no_rawat' => $rec->no_rawat,
                    'pasien' => $rec->regPeriksa->pasien->nm_pasien ?? '-',
                    'no_rkm_medis' => $rec->regPeriksa->pasien->no_rkm_medis ?? '-',
                    'kamar' => $kamar,
                    'kode_brng' => $rec->kode_brng,
                    'nama_brng' => $rec->dataBarang->nama_brng ?? $rec->kode_brng,
                    'satuan' => $rec->satuan ?: ($rec->dataBarang->kodeSatuan->satuan ?? 'satuan'),
                    'aturan_pakai' => $rec->aturan_pakai,
                    'kd_bangsal' => $rec->kd_bangsal,
                    'no_batch' => $rec->no_batch,
                    'no_faktur' => $rec->no_faktur,
                    'tgl_perawatan' => $rec->tgl_perawatan,
                    'status_billing' => $rec->status_billing,
                    'biaya_satuan' => $biayaSatuan,
                    'total_dosis_klinis' => 0,
                    'suggested_billing' => 0,
                    'rincian_pemberian' => [],
                    'ids' => [],
                ];
            }

            $grouped[$key]['total_dosis_klinis'] += (float) $rec->dosis_klinis;
            $grouped[$key]['rincian_pemberian'][] = [
                'id' => $rec->id,
                'jam' => $rec->jam,
                'dosis' => (float) $rec->dosis_klinis,
                'keterangan' => $rec->keterangan ?? '',
                'perawat' => $rec->pegawaiPerawat->nama ?? $rec->nip_perawat,
            ];
            $grouped[$key]['ids'][] = $rec->id;
        }

        foreach ($grouped as &$g) {
            // Rekomendasi pembulatan ke atas (ceil)
            $g['suggested_billing'] = ceil($g['total_dosis_klinis']);
            if ($g['suggested_billing'] <= 0) $g['suggested_billing'] = 1;
        }

        return response()->json([
            'status' => true,
            'data' => array_values($grouped),
        ]);
    }

    /**
     * Farmasi Menyetujui & Membulatkan Tagihan E-MAR ke detail_pemberian_obat Khanza
     */
    public function verifikasiBillingEmar(Request $request): JsonResponse
    {
        $request->validate([
            'no_rawat' => 'required',
            'kode_brng' => 'required',
            'tgl_perawatan' => 'required',
            'jml_billing' => 'required|numeric|min:0.01',
        ]);

        $noRawat = $request->no_rawat;
        $kodeBrng = $request->kode_brng;
        $tglPerawatan = $request->tgl_perawatan;
        $jmlBilling = (float) $request->jml_billing;
        $nipFarmasi = session()->get('pegawai')->nik ?? (session()->get('user')->username ?? '-');

        // Ambil data barang
        $barang = DataBarang::with('kodeSatuan')->where('kode_brng', $kodeBrng)->first();
        if (!$barang) {
            return response()->json(['message' => 'Data obat tidak ditemukan'], 404);
        }

        // Hitung harga obat sesuai kelas kamar
        $kamarInap = KamarInap::where('no_rawat', $noRawat)->where('stts_pulang', '-')->with('kamar')->first();
        $kelas = $kamarInap->kamar->kelas ?? 'Kelas 1';
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

        $jamNow = date('H:i:s');
        $kdBangsal = $request->kd_bangsal ?: 'RM';
        $noBatch = $request->no_batch ?? '';
        $noFaktur = $request->no_faktur ?? '';

        DB::beginTransaction();
        try {
            // 1. Masukkan ke detail_pemberian_obat Khanza dengan jumlah bulat yang disetujui Farmasi
            DetailPemberianObat::create([
                'tgl_perawatan' => $tglPerawatan,
                'jam' => $jamNow,
                'no_rawat' => $noRawat,
                'kode_brng' => $kodeBrng,
                'h_beli' => $hBeli,
                'biaya_obat' => $biayaObat,
                'jml' => $jmlBilling,
                'embalase' => 0,
                'tuslah' => 0,
                'total' => $biayaObat * $jmlBilling,
                'status' => 'Ranap',
                'kd_bangsal' => $kdBangsal,
                'no_batch' => $noBatch,
                'no_faktur' => $noFaktur,
            ]);

            // 2. Update status_billing pada catatan_pemberian_obat_pasien
            CatatanPemberianObatPasien::where('no_rawat', $noRawat)
                ->where('kode_brng', $kodeBrng)
                ->where('tgl_perawatan', $tglPerawatan)
                ->where('sumber', 'permintaan_harian')
                ->where('status_billing', 'Menunggu Verifikasi')
                ->update([
                    'status_billing' => 'Sudah Dibilkan',
                    'jml_billing' => $jmlBilling,
                    'tgl_verifikasi_billing' => now(),
                    'nip_farmasi' => $nipFarmasi,
                ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => "Pemakaian obat {$barang->nama_brng} berhasil diverifikasi & dibillkan ({$jmlBilling} {$barang->kodeSatuan->satuan})",
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Gagal memverifikasi billing E-MAR: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Cetak Lembar Resmi Permintaan Stok Obat Pasien (UDD Rawat Inap)
     */
    public function cetak(Request $request)
    {
        error_reporting(E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED);

        $no_permintaan = $request->input('no_permintaan');
        $no_rawat = $request->input('no_rawat');

        $query = PermintaanStokObatPasien::with([
            'detailPermintaan.dataBarang.kodeSatuan',
            'regPeriksa.pasien',
            'regPeriksa.kamarInap' => function ($q) {
                $q->with('kamar.bangsal');
            },
            'dokter',
        ]);

        if ($no_permintaan) {
            $permintaan = $query->where('no_permintaan', $no_permintaan)->first();
        } elseif ($no_rawat) {
            $no_rawat = str_replace('-', '/', $no_rawat);
            $permintaan = $query->where('no_rawat', $no_rawat)
                ->orderBy('tgl_permintaan', 'desc')
                ->orderBy('jam', 'desc')
                ->first();
        } else {
            abort(404, 'Parameter no_permintaan atau no_rawat tidak ditemukan.');
        }

        if (!$permintaan) {
            abort(404, 'Data permintaan stok obat tidak ditemukan.');
        }

        $regPeriksa = $permintaan->regPeriksa;
        $kamar = null;
        if ($regPeriksa && $regPeriksa->kamarInap) {
            $kamar = is_iterable($regPeriksa->kamarInap)
                ? ($regPeriksa->kamarInap->filter(fn($k) => $k->stts_pulang != 'Pindah Kamar')->first() ?? $regPeriksa->kamarInap->first())
                : $regPeriksa->kamarInap;
        }

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('content.print.permintaan_stok_obat_pasien', [
            'permintaan' => $permintaan,
            'regPeriksa' => $regPeriksa,
            'kamar' => $kamar,
        ])->setPaper('a4', 'portrait');

        return $pdf->stream('permintaan_obat_' . $permintaan->no_permintaan . '.pdf');
    }

    /**
     * Parsing Data Daftar Pemberian Obat Format RM 5A (Oral, Injeksi, Lain-Lain)
     */
    public function parseDaftarPemberianRm5a($noRawat, $tglAwal = null, $tglAkhir = null)
    {
        $noRawat = str_replace('-', '/', $noRawat);
        $regPeriksa = RegPeriksa::where('no_rawat', $noRawat)
            ->with(['pasien', 'dokter', 'poliklinik', 'kamarInap.kamar.bangsal'])
            ->first();

        if (!$regPeriksa) {
            return null;
        }

        $kamarInapList = KamarInap::where('no_rawat', $noRawat)
            ->with('kamar.bangsal')
            ->orderBy('tgl_masuk', 'asc')
            ->get();
        $kamarAwal = $kamarInapList->first();
        $kamarAktif = $kamarInapList->where('stts_pulang', '-')->last() ?? $kamarInapList->last();
        $tglMasukRawat = $kamarAwal ? $kamarAwal->tgl_masuk : ($regPeriksa->tgl_registrasi ?? date('Y-m-d'));

        $kamarDisplay = '-';
        if ($kamarAktif && $kamarAktif->kamar) {
            $bangsal = $kamarAktif->kamar->bangsal->nm_bangsal ?? '';
            $kdKamar = $kamarAktif->kd_kamar ?? '';
            $kamarDisplay = $bangsal ? "{$bangsal} ({$kdKamar})" : $kdKamar;
        }

        // Alergi Pasien (Pemeriksaan Ranap, Ralan/IGD, Asesmen Medis / Askep)
        $alergi = null;
        try {
            $alergi = DB::table('pemeriksaan_ranap')
                ->where('no_rawat', $noRawat)
                ->whereNotNull('alergi')
                ->where('alergi', '!=', '')
                ->where('alergi', '!=', '-')
                ->orderBy('tgl_perawatan', 'desc')
                ->value('alergi');
        } catch (\Throwable $e) {}

        if (!$alergi) {
            try {
                $alergi = DB::table('pemeriksaan_ralan')
                    ->where('no_rawat', $noRawat)
                    ->whereNotNull('alergi')
                    ->where('alergi', '!=', '')
                    ->where('alergi', '!=', '-')
                    ->orderBy('tgl_perawatan', 'desc')
                    ->value('alergi');
            } catch (\Throwable $e) {}
        }

        if (!$alergi) {
            try {
                $alergi = DB::table('penilaian_awal_keperawatan_ranap_anak')
                    ->where('no_rawat', $noRawat)
                    ->whereNotNull('riwayat_alergi')
                    ->where('riwayat_alergi', '!=', '')
                    ->where('riwayat_alergi', '!=', '-')
                    ->value('riwayat_alergi');
            } catch (\Throwable $e) {}
        }

        if (!$alergi) {
            try {
                $alergi = DB::table('penilaian_awal_keperawatan_kebidanan_ranap')
                    ->where('no_rawat', $noRawat)
                    ->whereNotNull('alergi')
                    ->where('alergi', '!=', '')
                    ->where('alergi', '!=', '-')
                    ->value('alergi');
            } catch (\Throwable $e) {}
        }

        if (!$alergi) {
            try {
                $alergi = DB::table('penilaian_medis_ranap')
                    ->where('no_rawat', $noRawat)
                    ->whereNotNull('alergi')
                    ->where('alergi', '!=', '')
                    ->where('alergi', '!=', '-')
                    ->value('alergi');
            } catch (\Throwable $e) {}
        }

        $alergiDisplay = ($alergi && trim($alergi) !== '-' && trim($alergi) !== '') ? trim($alergi) : 'Tidak Ada';

        // Tentukan 6 Kolom Tanggal (Sesuai kolom formulir RM 5A)
        $jmlKolom = 6;
        $tanggalList = [];

        if ($tglAwal) {
            $start = Carbon::parse($tglAwal);
        } else {
            $tglMasukCarbon = Carbon::parse($tglMasukRawat);
            $hariIni = Carbon::today();
            if ($hariIni->diffInDays($tglMasukCarbon) >= $jmlKolom) {
                $start = $hariIni->copy()->subDays($jmlKolom - 1);
            } else {
                $start = $tglMasukCarbon;
            }
        }

        for ($i = 0; $i < $jmlKolom; $i++) {
            $currDate = $start->copy()->addDays($i)->format('Y-m-d');
            $tanggalList[] = [
                'tanggal' => $currDate,
                'label' => Carbon::parse($currDate)->format('d/m'),
                'label_full' => Carbon::parse($currDate)->format('d/m/Y'),
                'hari' => Carbon::parse($currDate)->translatedFormat('D'),
            ];
        }

        $allTglKeys = array_column($tanggalList, 'tanggal');

        // Ambil Riwayat Pemberian Klinis E-MAR
        $catatans = CatatanPemberianObatPasien::where('no_rawat', $noRawat)
            ->whereIn('tgl_perawatan', $allTglKeys)
            ->with(['dataBarang.kodeSatuan', 'pegawaiPerawat', 'pegawaiFarmasi'])
            ->orderBy('jam', 'asc')
            ->get();

        // Ambil juga jika ada pemberian legacy Khanza
        $details = DetailPemberianObat::where('no_rawat', $noRawat)
            ->where('status', 'Ranap')
            ->whereIn('tgl_perawatan', $allTglKeys)
            ->with(['dataBarang.kodeSatuan', 'aturanPakai'])
            ->orderBy('jam', 'asc')
            ->get();

        // Ambil seluruh master permintaan obat aktif pasien
        $permintaanItems = DetailPermintaanStokObatPasien::whereHas('permintaan', function ($q) use ($noRawat) {
            $q->where('no_rawat', $noRawat);
        })->with('dataBarang.kodeSatuan')->get();

        // Koleksi semua obat unik
        $obatMasterMap = [];

        foreach ($permintaanItems as $pi) {
            $barang = $pi->dataBarang ?: $pi->barang;
            if (!$barang) continue;
            $kode = $pi->kode_brng;
            if (!isset($obatMasterMap[$kode])) {
                $obatMasterMap[$kode] = [
                    'kode_brng' => $kode,
                    'nama_brng' => $barang->nama_brng,
                    'satuan' => $barang->kodeSatuan->satuan ?? ($barang->kode_sat ?? ''),
                    'aturan_pakai' => $pi->aturan_pakai ?? '-',
                    'frekuensi' => $pi->frekuensi ?? '',
                ];
            }
        }

        foreach ($catatans as $cat) {
            $kode = $cat->kode_brng;
            if (!isset($obatMasterMap[$kode])) {
                $obatMasterMap[$kode] = [
                    'kode_brng' => $kode,
                    'nama_brng' => $cat->dataBarang->nama_brng ?? $kode,
                    'satuan' => $cat->satuan ?: ($cat->dataBarang->kodeSatuan->satuan ?? ''),
                    'aturan_pakai' => $cat->aturan_pakai ?? '-',
                    'frekuensi' => '',
                ];
            }
        }

        foreach ($details as $dtl) {
            $kode = $dtl->kode_brng;
            if (!isset($obatMasterMap[$kode])) {
                $obatMasterMap[$kode] = [
                    'kode_brng' => $kode,
                    'nama_brng' => $dtl->dataBarang->nama_brng ?? $kode,
                    'satuan' => $dtl->dataBarang->kodeSatuan->satuan ?? '',
                    'aturan_pakai' => $dtl->aturanPakai->aturan ?? '-',
                    'frekuensi' => '',
                ];
            }
        }

        // Matriks Petugas Penyiap (Farmasi) & Pemberi (Perawat) per tanggal & shift
        $petugasMap = [];
        foreach ($allTglKeys as $tgl) {
            $petugasMap[$tgl] = [
                'menyiapkan' => '-',
                'P' => '-',
                'S' => '-',
                'M' => '-',
            ];
        }

        foreach ($catatans as $cat) {
            $tgl = $cat->tgl_perawatan;
            if (!isset($petugasMap[$tgl])) continue;

            $jamInt = (int) substr($cat->jam, 0, 2);
            $shift = 'M';
            if ($jamInt >= 6 && $jamInt < 14) {
                $shift = 'P';
            } elseif ($jamInt >= 14 && $jamInt < 21) {
                $shift = 'S';
            } else {
                $shift = 'M';
            }

            if ($cat->pegawaiPerawat && !empty($cat->pegawaiPerawat->nama)) {
                $parts = explode(' ', trim($cat->pegawaiPerawat->nama));
                $namaPerawat = $parts[0];
                if ($petugasMap[$tgl][$shift] === '-' || empty($petugasMap[$tgl][$shift])) {
                    $petugasMap[$tgl][$shift] = $namaPerawat;
                } elseif (strpos($petugasMap[$tgl][$shift], $namaPerawat) === false) {
                    $petugasMap[$tgl][$shift] .= '/' . $namaPerawat;
                }
            }

            if ($cat->pegawaiFarmasi && !empty($cat->pegawaiFarmasi->nama)) {
                $partsF = explode(' ', trim($cat->pegawaiFarmasi->nama));
                $petugasMap[$tgl]['menyiapkan'] = $partsF[0];
            } elseif ($petugasMap[$tgl]['menyiapkan'] === '-') {
                $petugasMap[$tgl]['menyiapkan'] = 'Farmasi';
            }
        }

        // Kelompokkan 3 Kategori Obat: ORAL, INJEKSI, LAIN
        $grupOral = [];
        $grupInjeksi = [];
        $grupLain = [];

        foreach ($obatMasterMap as $kode => $info) {
            $nama = strtolower($info['nama_brng']);
            $satuan = strtolower($info['satuan']);
            $aturan = strtolower($info['aturan_pakai']);

            $isInjeksi = (
                strpos($nama, 'inj') !== false ||
                strpos($nama, 'injeksi') !== false ||
                strpos($nama, 'infus') !== false ||
                strpos($nama, 'drip') !== false ||
                strpos($nama, 'amp') !== false ||
                strpos($nama, 'ampul') !== false ||
                strpos($nama, 'vial') !== false ||
                strpos($nama, 'ceftriaxone') !== false ||
                strpos($nama, 'cefotaxime') !== false ||
                strpos($nama, 'meropenem') !== false ||
                strpos($nama, 'furosemid') !== false ||
                strpos($satuan, 'amp') !== false ||
                strpos($satuan, 'vial') !== false ||
                strpos($aturan, 'iv') !== false ||
                strpos($aturan, 'im') !== false ||
                strpos($aturan, 'sc') !== false
            );

            $isLain = (
                strpos($nama, ' o2') !== false ||
                strpos($nama, 'oksigen') !== false ||
                strpos($nama, 'nebu') !== false ||
                strpos($nama, 'nebulizer') !== false ||
                strpos($nama, 'combivent') !== false ||
                strpos($nama, 'pulmicort') !== false ||
                strpos($nama, 'lasalcom') !== false ||
                strpos($nama, 'salep') !== false ||
                strpos($nama, 'cream') !== false ||
                strpos($nama, 'krim') !== false ||
                strpos($nama, 'supp') !== false ||
                strpos($nama, 'tetes') !== false ||
                strpos($nama, 'gtt') !== false ||
                strpos($nama, 'kassa') !== false
            );

            $aturanPakai = $info['aturan_pakai'];
            $pemberianCat = $catatans->where('kode_brng', $kode);
            $pemberianDtl = $details->where('kode_brng', $kode);

            $lastCat = $pemberianCat->sortByDesc('tgl_perawatan')->sortByDesc('jam')->first();
            if ($lastCat && !empty($lastCat->aturan_pakai) && $lastCat->aturan_pakai !== '-') {
                $aturanPakai = $lastCat->aturan_pakai;
            }

            $frek = '-';
            if (preg_match('/(\d+)\s*[xX]/', $aturanPakai, $mFrek)) {
                $frek = $mFrek[1] . 'x';
            } elseif (!empty($info['frekuensi'])) {
                $frek = $info['frekuensi'];
            }

            $dosis = '-';
            // Prioritaskan dosis klinis aktual dari catatan pemberian obat
            if ($lastCat && !empty($lastCat->dosis_klinis) && (float) $lastCat->dosis_klinis > 0) {
                $dosis = (string) (float) $lastCat->dosis_klinis;
            } elseif ($pemberianDtl->isNotEmpty()) {
                $lastDtl = $pemberianDtl->sortByDesc('tgl_perawatan')->sortByDesc('jam')->first();
                if ($lastDtl && !empty($lastDtl->jml) && (float) $lastDtl->jml > 0) {
                    $dosis = (string) (float) $lastDtl->jml;
                }
            }

            // Fallback: Parse dari aturan pakai jika belum ada riwayat pemberian klinis
            if ($dosis === '-' || $dosis === '') {
                if (preg_match('/[xX]\s*([0-9.,\/]+(?:\s*[a-zA-Z%]+)?)/', $aturanPakai, $mDosis)) {
                    $dosis = trim($mDosis[1]);
                } else {
                    $dosis = $info['satuan'] ?: '1';
                }
            }

            $matriksPemberian = [];
            foreach ($allTglKeys as $tgl) {
                $matriksPemberian[$tgl] = [
                    'P' => [],
                    'S' => [],
                    'M' => [],
                ];
            }

            foreach ($pemberianCat as $p) {
                $tgl = $p->tgl_perawatan;
                if (!isset($matriksPemberian[$tgl])) continue;

                $jamInt = (int) substr($p->jam, 0, 2);
                $jamMenit = substr($p->jam, 0, 5);
                $jamTampil = substr($jamMenit, 3, 2) === '00' ? sprintf('%02d', $jamInt) : $jamMenit;

                if ($p->status_pemberian === 'Ditunda') {
                    $jamTampil = 'Tunda';
                } elseif ($p->status_pemberian === 'Ditolak Pasien') {
                    $jamTampil = 'Tolak';
                }

                $shift = 'M';
                if ($jamInt >= 6 && $jamInt < 14) {
                    $shift = 'P';
                } elseif ($jamInt >= 14 && $jamInt < 21) {
                    $shift = 'S';
                } else {
                    $shift = 'M';
                }

                $matriksPemberian[$tgl][$shift][] = $jamTampil;
            }

            $pemberianDtl = $details->where('kode_brng', $kode);
            foreach ($pemberianDtl as $p) {
                $tgl = $p->tgl_perawatan;
                if (!isset($matriksPemberian[$tgl])) continue;

                $jamInt = (int) substr($p->jam, 0, 2);
                $jamMenit = substr($p->jam, 0, 5);
                $jamTampil = substr($jamMenit, 3, 2) === '00' ? sprintf('%02d', $jamInt) : $jamMenit;

                $shift = 'M';
                if ($jamInt >= 6 && $jamInt < 14) {
                    $shift = 'P';
                } elseif ($jamInt >= 14 && $jamInt < 21) {
                    $shift = 'S';
                } else {
                    $shift = 'M';
                }

                if (!in_array($jamTampil, $matriksPemberian[$tgl][$shift])) {
                    $matriksPemberian[$tgl][$shift][] = $jamTampil;
                }
            }

            $pemberianDisplay = [];
            foreach ($allTglKeys as $tgl) {
                $pemberianDisplay[$tgl] = [
                    'P' => !empty($matriksPemberian[$tgl]['P']) ? implode(', ', $matriksPemberian[$tgl]['P']) : '',
                    'S' => !empty($matriksPemberian[$tgl]['S']) ? implode(', ', $matriksPemberian[$tgl]['S']) : '',
                    'M' => !empty($matriksPemberian[$tgl]['M']) ? implode(', ', $matriksPemberian[$tgl]['M']) : '',
                ];
            }

            if ($isLain) {
                $grupLain[] = [
                    'kode_brng' => $kode,
                    'nama' => $info['nama_brng'],
                    'frekuensi' => $frek,
                    'keterangan' => $info['aturan_pakai'] !== '-' ? $info['aturan_pakai'] : $dosis,
                    'pemberian' => $pemberianDisplay,
                ];
            } elseif ($isInjeksi) {
                $isIv = (strpos($aturan, 'iv') !== false || strpos($aturan, 'intra vena') !== false || strpos($aturan, 'infus') !== false || strpos($aturan, 'drip') !== false || true);
                $isIm = (strpos($aturan, 'im') !== false || strpos($aturan, 'intra muskuler') !== false);
                $isSc = (strpos($aturan, 'sc') !== false || strpos($aturan, 'subkutan') !== false);
                if ($isIm || $isSc) {
                    $isIv = false;
                }

                $grupInjeksi[] = [
                    'kode_brng' => $kode,
                    'nama' => $info['nama_brng'],
                    'frekuensi' => $frek,
                    'dosis' => $dosis,
                    'iv' => $isIv,
                    'im' => $isIm,
                    'sc' => $isSc,
                    'pemberian' => $pemberianDisplay,
                ];
            } else {
                $isAc = (strpos($aturan, 'ac') !== false || strpos($aturan, 'a.c') !== false || strpos($aturan, 'sebelum') !== false);
                $isDc = (strpos($aturan, 'dc') !== false || strpos($aturan, 'd.c') !== false || strpos($aturan, 'saat makan') !== false || strpos($aturan, 'bersama makan') !== false);
                $isPc = (strpos($aturan, 'pc') !== false || strpos($aturan, 'p.c') !== false || strpos($aturan, 'sesudah') !== false || strpos($aturan, 'setelah') !== false);
                if (!$isAc && !$isDc && !$isPc) {
                    $isPc = true;
                }

                $grupOral[] = [
                    'kode_brng' => $kode,
                    'nama' => $info['nama_brng'],
                    'frekuensi' => $frek,
                    'dosis' => $dosis,
                    'ac' => $isAc,
                    'dc' => $isDc,
                    'pc' => $isPc,
                    'pemberian' => $pemberianDisplay,
                ];
            }
        }

        return [
            'regPeriksa' => $regPeriksa,
            'pasien' => $regPeriksa->pasien,
            'kamarDisplay' => $kamarDisplay,
            'dokterDpjp' => $regPeriksa->dokter->nm_dokter ?? '-',
            'tglMasukRawat' => $tglMasukRawat,
            'alergiDisplay' => $alergiDisplay,
            'tanggalList' => $tanggalList,
            'grupOral' => $grupOral,
            'grupInjeksi' => $grupInjeksi,
            'grupLain' => $grupLain,
            'petugasMap' => $petugasMap,
        ];
    }

    /**
     * API Data Rekap Formulir RM 5A (Untuk Tampilan Screen di Modal E-MAR)
     */
    public function getRekapRm5a(Request $request): JsonResponse
    {
        $noRawat = $request->no_rawat;
        if (!$noRawat) {
            return response()->json(['message' => 'no_rawat wajib diisi'], 400);
        }

        $data = $this->parseDaftarPemberianRm5a($noRawat, $request->tgl_awal, $request->tgl_akhir);
        if (!$data) {
            return response()->json(['message' => 'Data pasien rawat inap tidak ditemukan'], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $data,
        ]);
    }

    /**
     * Cetak PDF Formulir RM 5A: Daftar Pemberian Obat Pasien Rawat Inap
     */
    public function cetakRm5a(Request $request, $no_rawat)
    {
        $data = $this->parseDaftarPemberianRm5a($no_rawat, $request->tgl_awal, $request->tgl_akhir);
        if (!$data) {
            abort(404, 'Data rekam medis pasien tidak ditemukan');
        }

        $setting = DB::table('setting')->first();
        $logoFile = public_path('img/LOGO RSIA .png');
        if (!file_exists($logoFile)) {
            $logoFile = public_path('img/logo.png');
        }
        $logoBase64 = file_exists($logoFile) ? base64_encode(file_get_contents($logoFile)) : null;

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('content.print.daftar_pemberian_obat_rm5a', array_merge($data, [
            'setting' => $setting,
            'logoBase64' => $logoBase64,
        ]))
        ->setPaper('a4', 'landscape')
        ->setOptions([
            'defaultFont' => 'Helvetica',
            'isRemoteEnabled' => true,
            'isHtml5ParserEnabled' => true,
        ]);

        $safeRm = $data['pasien']->no_rkm_medis ?? 'pasien';
        return $pdf->stream("DAFTAR_PEMBERIAN_OBAT_RM5A_{$safeRm}.pdf");
    }
}
