<?php

namespace App\Http\Controllers;

use App\Models\Databarang;
use App\Models\DetailPemberianObat;
use App\Models\GudangBarang;
use App\Models\KamarInap;
use App\Models\RegPeriksa;
use App\Models\RsiaDetailReturStokUdd;
use App\Models\RsiaReturStokUdd;
use App\Models\StokObatPasien;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ReturStokUddController extends Controller
{
    /**
     * Generate Nomor Pengajuan Retur UDD: RUDD-YYYYMMDD-XXXX
     */
    public function getNomor(): string
    {
        $today = Carbon::now()->format('Ymd');
        $prefix = "RUDD-{$today}-";

        $lastNumber = RsiaReturStokUdd::where('no_retur_udd', 'like', "{$prefix}%")
            ->selectRaw('IFNULL(MAX(CONVERT(RIGHT(no_retur_udd, 4), SIGNED)), 0) as last_urut')
            ->value('last_urut');

        $nextNumber = str_pad((int) $lastNumber + 1, 4, '0', STR_PAD_LEFT);
        return "{$prefix}{$nextNumber}";
    }

    /**
     * Ambil daftar obat UDD pasien yang masih memiliki sisa stok (belum diberikan)
     */
    public function getSisaStokPasien(Request $request): JsonResponse
    {
        $noRawat = $request->no_rawat;
        if (!$noRawat) {
            return response()->json(['message' => 'No. Rawat wajib diisi'], 422);
        }

        $stokItems = StokObatPasien::with(['dataBarang.kodeSatuan'])
            ->where('no_rawat', $noRawat)
            ->get();

        if ($stokItems->isEmpty()) {
            return response()->json([]);
        }

        // Ambil pengajuan retur UDD yang sedang "Menunggu Diterima" agar tidak diajukan dobel
        $sedangDiajukan = DB::table('rsia_detail_retur_stok_udd')
            ->join('rsia_retur_stok_udd', 'rsia_detail_retur_stok_udd.no_retur_udd', '=', 'rsia_retur_stok_udd.no_retur_udd')
            ->where('rsia_retur_stok_udd.no_rawat', $noRawat)
            ->where('rsia_retur_stok_udd.status', 'Menunggu Diterima')
            ->select(
                'rsia_detail_retur_stok_udd.kode_brng',
                'rsia_detail_retur_stok_udd.no_batch',
                'rsia_detail_retur_stok_udd.no_faktur',
                DB::raw('SUM(rsia_detail_retur_stok_udd.jml_retur) as total_diajukan')
            )
            ->groupBy('rsia_detail_retur_stok_udd.kode_brng', 'rsia_detail_retur_stok_udd.no_batch', 'rsia_detail_retur_stok_udd.no_faktur')
            ->get()
            ->keyBy(function ($item) {
                return $item->kode_brng . '|' . ($item->no_batch ?? '') . '|' . ($item->no_faktur ?? '');
            });

        $grouped = [];
        foreach ($stokItems as $item) {
            $key = $item->kode_brng . '|' . ($item->no_batch ?? '') . '|' . ($item->no_faktur ?? '');

            if (!isset($grouped[$key])) {
                $grouped[$key] = [
                    'kode_brng' => $item->kode_brng,
                    'nama_brng' => $item->dataBarang->nama_brng ?? '-',
                    'satuan' => $item->dataBarang->kodeSatuan->satuan ?? '-',
                    'no_batch' => $item->no_batch ?? '',
                    'no_faktur' => $item->no_faktur ?? '',
                    'kd_bangsal' => $item->kd_bangsal,
                    'aturan_pakai' => $item->aturan_pakai,
                    'first_udd_date' => $item->tanggal,
                    'total_masuk' => 0,
                    'total_diberikan' => 0,
                    'total_diajukan' => 0,
                    'sisa_stok' => 0,
                ];
            }

            if ($item->tanggal < $grouped[$key]['first_udd_date']) {
                $grouped[$key]['first_udd_date'] = $item->tanggal;
            }

            $grouped[$key]['total_masuk'] += (float) $item->jumlah;
        }

        $result = [];
        foreach ($grouped as $key => $val) {
            $pemberianTotal = DetailPemberianObat::where('no_rawat', $noRawat)
                ->where('kode_brng', $val['kode_brng'])
                ->where('no_batch', $val['no_batch'])
                ->where('no_faktur', $val['no_faktur'])
                ->where('status', 'Ranap')
                ->where('tgl_perawatan', '>=', $val['first_udd_date'])
                ->sum('jml');

            $diajukanJml = isset($sedangDiajukan[$key]) ? (float) $sedangDiajukan[$key]->total_diajukan : 0;

            $sisa = (float) $val['total_masuk'] - ((float) $pemberianTotal + $diajukanJml);

            if ($sisa > 0) {
                $val['total_diberikan'] = (float) $pemberianTotal;
                $val['total_diajukan'] = $diajukanJml;
                $val['sisa_stok'] = round($sisa, 2);
                $result[] = $val;
            }
        }

        return response()->json($result);
    }

    /**
     * Simpan pengajuan retur stok UDD oleh Perawat / Ruangan
     */
    public function simpanPengajuan(Request $request): JsonResponse
    {
        $request->validate([
            'no_rawat' => 'required',
            'items' => 'required|array|min:1',
            'items.*.kode_brng' => 'required',
            'items.*.jml_retur' => 'required|numeric|min:0.01',
            'alasan' => 'required|string',
        ]);

        $noRawat = $request->no_rawat;
        $items = $request->items;

        $reg = RegPeriksa::with(['kamarInap.kamar'])->where('no_rawat', $noRawat)->first();
        if (!$reg) {
            return response()->json(['message' => 'Data pasien rawat inap tidak ditemukan'], 404);
        }

        // Tentukan depo (default 'RM' atau mapping set_depo_ranap)
        $kdBangsal = 'RM';
        if ($reg->kamarInap && count($reg->kamarInap) > 0) {
            $kdKamar = $reg->kamarInap[0]->kd_kamar;
            $depo = DB::table('set_depo_ranap')->where('kd_bangsal', $kdKamar)->value('kd_depo');
            if ($depo) {
                $kdBangsal = $depo;
            }
        }
        if ($request->filled('kd_bangsal')) {
            $kdBangsal = $request->kd_bangsal;
        }

        $nikPengaju = session()->get('pegawai')->nik ?? '-';

        return DB::transaction(function () use ($request, $noRawat, $items, $kdBangsal, $nikPengaju) {
            $noReturUdd = $this->getNomor();

            RsiaReturStokUdd::create([
                'no_retur_udd' => $noReturUdd,
                'no_rawat' => $noRawat,
                'kd_bangsal' => $kdBangsal,
                'tgl_retur' => date('Y-m-d'),
                'jam_retur' => date('H:i:s'),
                'petugas_ruangan' => $nikPengaju,
                'alasan' => $request->alasan,
                'status' => 'Menunggu Diterima',
                'catatan' => $request->catatan ?? null,
            ]);

            foreach ($items as $item) {
                RsiaDetailReturStokUdd::create([
                    'no_retur_udd' => $noReturUdd,
                    'kode_brng' => $item['kode_brng'],
                    'jml_retur' => (float) $item['jml_retur'],
                    'jml_diterima' => 0,
                    'no_batch' => $item['no_batch'] ?? '',
                    'no_faktur' => $item['no_faktur'] ?? '',
                    'keterangan' => $item['keterangan'] ?? null,
                ]);
            }

            return response()->json([
                'status' => true,
                'message' => 'Pengajuan pengembalian sisa obat UDD berhasil dikirim ke Farmasi',
                'no_retur_udd' => $noReturUdd,
            ]);
        });
    }

    /**
     * Ambil daftar pengajuan retur UDD
     */
    public function getDaftar(Request $request): JsonResponse
    {
        $query = RsiaReturStokUdd::with([
            'details.barang.kodeSatuan',
            'regPeriksa.pasien',
            'regPeriksa.kamarInap' => function ($q) {
                $q->where('stts_pulang', '-')->with('kamar.bangsal');
            },
            'pegawaiRuangan',
            'pegawaiFarmasi',
            'bangsal',
        ]);

        if ($request->filled('no_rawat')) {
            $query->where('no_rawat', $request->no_rawat);
        }

        if ($request->filled('status') && $request->status !== 'Semua') {
            $query->where('status', $request->status);
        }

        if ($request->filled('tgl_awal') && $request->filled('tgl_akhir')) {
            $query->whereBetween('tgl_retur', [$request->tgl_awal, $request->tgl_akhir]);
        } elseif ($request->filled('tgl_retur')) {
            $query->where('tgl_retur', $request->tgl_retur);
        }

        $data = $query->orderBy('tgl_retur', 'desc')
            ->orderBy('jam_retur', 'desc')
            ->get();

        return response()->json($data);
    }

    /**
     * Ambil detail single retur UDD
     */
    public function getDetail($no_retur_udd): JsonResponse
    {
        $retur = RsiaReturStokUdd::with([
            'details.barang.kodeSatuan',
            'regPeriksa.pasien',
            'regPeriksa.kamarInap' => function ($q) {
                $q->where('stts_pulang', '-')->with('kamar.bangsal');
            },
            'pegawaiRuangan',
            'pegawaiFarmasi',
            'bangsal',
        ])->where('no_retur_udd', $no_retur_udd)->first();

        if (!$retur) {
            return response()->json(['message' => 'Data retur UDD tidak ditemukan'], 404);
        }

        return response()->json($retur);
    }

    /**
     * Batalkan pengajuan retur UDD oleh Perawat / Ruangan
     */
    public function batalkan(Request $request, $no_retur_udd): JsonResponse
    {
        $retur = RsiaReturStokUdd::where('no_retur_udd', $no_retur_udd)->first();
        if (!$retur) {
            return response()->json(['message' => 'Data pengajuan retur UDD tidak ditemukan'], 404);
        }

        if ($retur->status !== 'Menunggu Diterima') {
            return response()->json(['message' => 'Pengajuan tidak dapat dibatalkan karena sudah diproses (' . $retur->status . ')'], 422);
        }

        $retur->update([
            'status' => 'Batal',
            'catatan' => ($retur->catatan ? $retur->catatan . ' | ' : '') . 'Dibatalkan oleh ruangan: ' . ($request->alasan ?? 'Batal'),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Pengajuan retur sisa UDD berhasil dibatalkan',
        ]);
    }

    /**
     * Proses Penerimaan / Penolakan Fisik Sisa Obat UDD oleh Petugas Farmasi
     */
    public function prosesPenerimaan(Request $request, $no_retur_udd): JsonResponse
    {
        $request->validate([
            'aksi' => 'required|in:terima,tolak',
            'catatan_farmasi' => 'nullable|string',
            'items' => 'required_if:aksi,terima|array',
        ]);

        return DB::transaction(function () use ($request, $no_retur_udd) {
            $retur = RsiaReturStokUdd::with('details')->where('no_retur_udd', $no_retur_udd)->lockForUpdate()->first();
            if (!$retur) {
                return response()->json(['message' => 'Data retur UDD tidak ditemukan'], 404);
            }

            if ($retur->status !== 'Menunggu Diterima') {
                return response()->json(['message' => 'Pengajuan ini sudah pernah diproses sebelumnya (' . $retur->status . ')'], 422);
            }

            $nikFarmasi = session()->get('pegawai')->nik ?? '-';
            $tglSekarang = date('Y-m-d');
            $jamSekarang = date('H:i:s');

            if ($request->aksi === 'tolak') {
                $retur->update([
                    'status' => 'Ditolak',
                    'petugas_farmasi' => $nikFarmasi,
                    'tgl_diterima' => $tglSekarang,
                    'jam_diterima' => $jamSekarang,
                    'catatan_farmasi' => $request->catatan_farmasi ?? 'Ditolak oleh Farmasi',
                ]);

                return response()->json([
                    'status' => true,
                    'message' => 'Pengajuan retur UDD berhasil ditolak.',
                ]);
            }

            // Aksi === 'terima'
            $itemsPayload = collect($request->items)->keyBy('id');

            foreach ($retur->details as $detail) {
                $payloadItem = $itemsPayload->get($detail->id);
                $jmlDiterima = $payloadItem ? (float) ($payloadItem['jml_diterima'] ?? $detail->jml_retur) : (float) $detail->jml_retur;

                if ($jmlDiterima < 0) {
                    $jmlDiterima = 0;
                }

                $detail->update([
                    'jml_diterima' => $jmlDiterima,
                    'keterangan' => $payloadItem['keterangan'] ?? $detail->keterangan,
                ]);

                if ($jmlDiterima > 0) {
                    // 1. Kurangi stok_obat_pasien (masukkan nilai negatif agar sum(jumlah) berkurang)
                    StokObatPasien::create([
                        'tanggal' => $tglSekarang,
                        'jam' => $jamSekarang,
                        'no_rawat' => $retur->no_rawat,
                        'kode_brng' => $detail->kode_brng,
                        'jumlah' => -$jmlDiterima,
                        'kd_bangsal' => $retur->kd_bangsal,
                        'no_batch' => $detail->no_batch,
                        'no_faktur' => $detail->no_faktur,
                        'aturan_pakai' => 'Retur Sisa UDD ke Farmasi',
                        'jam00' => 'false', 'jam01' => 'false', 'jam02' => 'false', 'jam03' => 'false',
                        'jam04' => 'false', 'jam05' => 'false', 'jam06' => 'false', 'jam07' => 'false',
                        'jam08' => 'false', 'jam09' => 'false', 'jam10' => 'false', 'jam11' => 'false',
                        'jam12' => 'false', 'jam13' => 'false', 'jam14' => 'false', 'jam15' => 'false',
                        'jam16' => 'false', 'jam17' => 'false', 'jam18' => 'false', 'jam19' => 'false',
                        'jam20' => 'false', 'jam21' => 'false', 'jam22' => 'false', 'jam23' => 'false',
                    ]);

                    // 2. Tambah kembali stok Depo Apotek Ranap di gudangbarang
                    $gudang = GudangBarang::where('kode_brng', $detail->kode_brng)
                        ->where('kd_bangsal', $retur->kd_bangsal)
                        ->where('no_batch', $detail->no_batch)
                        ->where('no_faktur', $detail->no_faktur)
                        ->first();

                    $stokAwal = $gudang ? $gudang->stok : 0;
                    $stokAkhir = $stokAwal + $jmlDiterima;

                    if ($gudang) {
                        DB::table('gudangbarang')
                            ->where('kode_brng', $gudang->kode_brng)
                            ->where('kd_bangsal', $gudang->kd_bangsal)
                            ->where('no_batch', $gudang->no_batch)
                            ->where('no_faktur', $gudang->no_faktur)
                            ->increment('stok', $jmlDiterima);
                    } else {
                        DB::table('gudangbarang')->insert([
                            'kode_brng' => $detail->kode_brng,
                            'kd_bangsal' => $retur->kd_bangsal,
                            'stok' => $jmlDiterima,
                            'no_batch' => $detail->no_batch,
                            'no_faktur' => $detail->no_faktur,
                        ]);
                    }

                    // 3. Catat kartu stok di riwayat_barang_medis
                    DB::table('riwayat_barang_medis')->insert([
                        'kode_brng' => $detail->kode_brng,
                        'stok_awal' => $stokAwal,
                        'masuk' => $jmlDiterima,
                        'keluar' => 0,
                        'stok_akhir' => $stokAkhir,
                        'posisi' => 'Apotek Rinap',
                        'tanggal' => $tglSekarang,
                        'jam' => $jamSekarang,
                        'petugas' => $nikFarmasi,
                        'kd_bangsal' => $retur->kd_bangsal,
                        'status' => 'Simpan',
                        'no_batch' => $detail->no_batch,
                        'no_faktur' => $detail->no_faktur,
                        'keterangan' => 'Retur Sisa UDD: ' . $retur->no_rawat . ' (' . $retur->alasan . ')',
                    ]);
                }
            }

            $retur->update([
                'status' => 'Diterima',
                'petugas_farmasi' => $nikFarmasi,
                'tgl_diterima' => $tglSekarang,
                'jam_diterima' => $jamSekarang,
                'catatan_farmasi' => $request->catatan_farmasi,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Sisa obat UDD berhasil diterima dan stok Depo Farmasi telah bertambah kembali.',
            ]);
        });
    }

    /**
     * Cetak Lembar Bukti Serah Terima Retur Obat UDD
     */
    public function cetak($no_retur_udd)
    {
        $retur = RsiaReturStokUdd::with([
            'details.barang.kodeSatuan',
            'regPeriksa.pasien',
            'regPeriksa.kamarInap' => function ($q) {
                $q->where('stts_pulang', '-')->with('kamar.bangsal');
            },
            'pegawaiRuangan',
            'pegawaiFarmasi',
            'bangsal',
        ])->where('no_retur_udd', $no_retur_udd)->first();

        if (!$retur) {
            abort(404, 'Data retur UDD tidak ditemukan');
        }

        $regPeriksa = $retur->regPeriksa;
        $kamar = $regPeriksa->kamarInap[0] ?? null;

        return view('content.print.retur_stok_udd', [
            'retur' => $retur,
            'regPeriksa' => $regPeriksa,
            'kamar' => $kamar,
        ]);
    }
}
