<?php

namespace App\Http\Controllers;

use App\Models\Databarang;
use App\Models\DetailReturJual;
use App\Models\RegPeriksa;
use App\Models\ReturJual;
use App\Models\RsiaDetailPengajuanRetur;
use App\Models\RsiaPengajuanRetur;
use App\Services\JurnalService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ReturObatRanapController extends Controller
{
    /**
     * Ambil riwayat obat yang telah diberikan ke pasien ranap berserta sisa yang dapat diretur.
     */
    public function getRiwayatObatPasien(Request $request)
    {
        $noRawat = $request->get('no_rawat');
        if (!$noRawat) {
            return response()->json(['message' => 'No. Rawat wajib diisi'], 422);
        }

        // Ambil data pemberian obat dari detail_pemberian_obat status Ranap
        $pemberian = DB::table('detail_pemberian_obat')
            ->join('databarang', 'detail_pemberian_obat.kode_brng', '=', 'databarang.kode_brng')
            ->leftJoin('kodesatuan', 'databarang.kode_sat', '=', 'kodesatuan.kode_sat')
            ->where('detail_pemberian_obat.no_rawat', $noRawat)
            ->where('detail_pemberian_obat.status', 'Ranap')
            ->select(
                'detail_pemberian_obat.kode_brng',
                'databarang.nama_brng',
                'databarang.kode_sat',
                'kodesatuan.satuan',
                'detail_pemberian_obat.biaya_obat as h_retur',
                'detail_pemberian_obat.no_batch',
                'detail_pemberian_obat.no_faktur',
                'detail_pemberian_obat.kd_bangsal',
                DB::raw('SUM(detail_pemberian_obat.jml) as total_diberikan')
            )
            ->groupBy(
                'detail_pemberian_obat.kode_brng',
                'databarang.nama_brng',
                'databarang.kode_sat',
                'kodesatuan.satuan',
                'detail_pemberian_obat.biaya_obat',
                'detail_pemberian_obat.no_batch',
                'detail_pemberian_obat.no_faktur',
                'detail_pemberian_obat.kd_bangsal'
            )
            ->get();

        // Ambil data yang sudah pernah di-retur di returjual (Khanza)
        $sudahRetur = DB::table('detreturjual')
            ->join('returjual', 'detreturjual.no_retur_jual', '=', 'returjual.no_retur_jual')
            ->where('returjual.no_retur_jual', 'like', $noRawat . '%')
            ->select(
                'detreturjual.kode_brng',
                'detreturjual.no_batch',
                'detreturjual.no_faktur',
                DB::raw('SUM(detreturjual.jml_retur) as total_retur')
            )
            ->groupBy('detreturjual.kode_brng', 'detreturjual.no_batch', 'detreturjual.no_faktur')
            ->get()
            ->keyBy(function ($item) {
                return $item->kode_brng . '|' . ($item->no_batch ?? '') . '|' . ($item->no_faktur ?? '');
            });

        // Ambil data pengajuan retur yang sedang 'Menunggu Validasi' (agar tidak dobel input)
        $sedangDiajukan = DB::table('rsia_detail_pengajuan_retur')
            ->join('rsia_pengajuan_retur', 'rsia_detail_pengajuan_retur.no_pengajuan', '=', 'rsia_pengajuan_retur.no_pengajuan')
            ->where('rsia_pengajuan_retur.no_rawat', $noRawat)
            ->where('rsia_pengajuan_retur.status', 'Menunggu Validasi')
            ->select(
                'rsia_detail_pengajuan_retur.kode_brng',
                'rsia_detail_pengajuan_retur.no_batch',
                'rsia_detail_pengajuan_retur.no_faktur',
                DB::raw('SUM(rsia_detail_pengajuan_retur.jml_diajukan) as total_diajukan')
            )
            ->groupBy(
                'rsia_detail_pengajuan_retur.kode_brng',
                'rsia_detail_pengajuan_retur.no_batch',
                'rsia_detail_pengajuan_retur.no_faktur'
            )
            ->get()
            ->keyBy(function ($item) {
                return $item->kode_brng . '|' . ($item->no_batch ?? '') . '|' . ($item->no_faktur ?? '');
            });

        $result = $pemberian->map(function ($row) use ($sudahRetur, $sedangDiajukan) {
            $key = $row->kode_brng . '|' . ($row->no_batch ?? '') . '|' . ($row->no_faktur ?? '');
            $returJml = isset($sudahRetur[$key]) ? (float)$sudahRetur[$key]->total_retur : 0;
            $diajukanJml = isset($sedangDiajukan[$key]) ? (float)$sedangDiajukan[$key]->total_diajukan : 0;

            $sisa = (float)$row->total_diberikan - ($returJml + $diajukanJml);
            $sisa = max(0, $sisa);

            return [
                'kode_brng' => $row->kode_brng,
                'nama_brng' => $row->nama_brng,
                'kode_sat' => $row->kode_sat,
                'satuan' => $row->satuan ?? $row->kode_sat,
                'h_retur' => (float)$row->h_retur,
                'total_diberikan' => (float)$row->total_diberikan,
                'sudah_retur' => $returJml,
                'sedang_diajukan' => $diajukanJml,
                'sisa_dapat_diretur' => $sisa,
                'no_batch' => $row->no_batch ?? '',
                'no_faktur' => $row->no_faktur ?? '',
                'kd_bangsal' => $row->kd_bangsal ?? 'RM',
            ];
        });

        return response()->json($result);
    }

    /**
     * Simpan Pengajuan Retur Baru dari Ruangan Rawat Inap.
     */
    public function simpanPengajuan(Request $request)
    {
        $request->validate([
            'no_rawat' => 'required|string',
            'items' => 'required|array|min:1',
            'items.*.kode_brng' => 'required|string',
            'items.*.jml_diajukan' => 'required|numeric|min:0.01',
            'items.*.h_retur' => 'required|numeric|min:0',
        ]);

        $noRawat = $request->no_rawat;
        $items = $request->items;

        // Ambil data pasien & kamar inap
        $reg = RegPeriksa::with(['kamarInap.kamar.bangsal'])->where('no_rawat', $noRawat)->first();
        if (!$reg) {
            return response()->json(['message' => 'Data pendaftaran rawat inap tidak ditemukan.'], 404);
        }

        // Tentukan depo/bangsal
        $kdBangsal = 'RM'; // default Farmasi Ranap
        if ($reg->kamarInap && count($reg->kamarInap) > 0) {
            $kdKamar = $reg->kamarInap[0]->kd_kamar;
            $depo = DB::table('set_depo_ranap')->where('kd_bangsal', $kdKamar)->value('kd_depo');
            if ($depo) {
                $kdBangsal = $depo;
            }
        }
        if ($request->kd_bangsal) {
            $kdBangsal = $request->kd_bangsal;
        }

        return DB::transaction(function () use ($request, $noRawat, $items, $kdBangsal) {
            // Generate No. Pengajuan: RET-YYYYMMDD-XXXX
            $today = Carbon::now()->format('Ymd');
            $prefix = 'RET-' . $today . '-';

            $lastNumber = RsiaPengajuanRetur::where('no_pengajuan', 'like', $prefix . '%')
                ->selectRaw('IFNULL(MAX(CONVERT(RIGHT(no_pengajuan, 4), SIGNED)), 0) as last_urut')
                ->value('last_urut');

            $nextUrut = sprintf('%04d', ((int)$lastNumber) + 1);
            $noPengajuan = $prefix . $nextUrut;

            $nikPetugas = session('pegawai')->nik ?? (session('user')->id_user ?? 'perawat');

            $pengajuan = RsiaPengajuanRetur::create([
                'no_pengajuan' => $noPengajuan,
                'no_rawat' => $noRawat,
                'kd_bangsal' => $kdBangsal,
                'tgl_pengajuan' => Carbon::now()->toDateString(),
                'jam_pengajuan' => Carbon::now()->toTimeString(),
                'petugas_pengaju' => $nikPetugas,
                'status' => 'Menunggu Validasi',
                'catatan' => $request->catatan ?? null,
            ]);

            foreach ($items as $item) {
                if ((float)$item['jml_diajukan'] <= 0) continue;

                RsiaDetailPengajuanRetur::create([
                    'no_pengajuan' => $noPengajuan,
                    'kode_brng' => $item['kode_brng'],
                    'kode_sat' => $item['kode_sat'] ?? '-',
                    'jml_diajukan' => (float)$item['jml_diajukan'],
                    'jml_disetujui' => 0,
                    'h_retur' => (float)$item['h_retur'],
                    'subtotal' => 0,
                    'no_batch' => $item['no_batch'] ?? '',
                    'no_faktur' => $item['no_faktur'] ?? '',
                    'keterangan' => $item['keterangan'] ?? null,
                ]);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Pengajuan retur obat berhasil disimpan dengan nomor: ' . $noPengajuan,
                'no_pengajuan' => $noPengajuan,
            ]);
        });
    }

    /**
     * Ambil daftar pengajuan retur (untuk Farmasi atau filter per No. Rawat).
     */
    public function getDaftarPengajuan(Request $request)
    {
        $query = RsiaPengajuanRetur::with([
            'details.barang.satuan',
            'regPeriksa.pasien',
            'regPeriksa.kamarInap.kamar.bangsal',
            'pegawaiPengaju',
            'pegawaiValidasi',
        ]);

        if ($request->filled('no_rawat')) {
            $query->where('no_rawat', $request->no_rawat);
        }

        if ($request->filled('status') && $request->status !== 'Semua') {
            $query->where('status', $request->status);
        }

        if ($request->filled('tgl_awal') && $request->filled('tgl_akhir')) {
            $query->whereBetween('tgl_pengajuan', [$request->tgl_awal, $request->tgl_akhir]);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('no_pengajuan', 'like', "%{$search}%")
                    ->orWhere('no_rawat', 'like', "%{$search}%")
                    ->orWhereHas('regPeriksa.pasien', function ($qp) use ($search) {
                        $qp->where('nm_pasien', 'like', "%{$search}%")
                            ->orWhere('no_rkm_medis', 'like', "%{$search}%");
                    });
            });
        }

        $data = $query->orderBy('tgl_pengajuan', 'desc')
            ->orderBy('jam_pengajuan', 'desc')
            ->get();

        return response()->json($data);
    }

    /**
     * Ambil detail single pengajuan retur.
     */
    public function getDetailPengajuan($no_pengajuan)
    {
        $pengajuan = RsiaPengajuanRetur::with([
            'details.barang.satuan',
            'regPeriksa.pasien',
            'regPeriksa.kamarInap.kamar.bangsal',
            'pegawaiPengaju',
            'pegawaiValidasi',
            'returJual',
        ])->where('no_pengajuan', $no_pengajuan)->first();

        if (!$pengajuan) {
            return response()->json(['message' => 'Pengajuan retur tidak ditemukan'], 404);
        }

        return response()->json($pengajuan);
    }

    /**
     * Batalkan pengajuan retur (Hanya bisa saat status 'Menunggu Validasi').
     */
    public function batalkanPengajuan(Request $request, $no_pengajuan)
    {
        $pengajuan = RsiaPengajuanRetur::where('no_pengajuan', $no_pengajuan)->first();
        if (!$pengajuan) {
            return response()->json(['message' => 'Pengajuan retur tidak ditemukan'], 404);
        }

        if ($pengajuan->status !== 'Menunggu Validasi') {
            return response()->json(['message' => 'Pengajuan tidak dapat dibatalkan karena sudah diproses (' . $pengajuan->status . ').'], 422);
        }

        $pengajuan->update([
            'status' => 'Batal',
            'catatan' => ($pengajuan->catatan ? $pengajuan->catatan . ' | ' : '') . 'Dibatalkan oleh pengaju: ' . ($request->alasan ?? 'Tidak ada alasan'),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Pengajuan retur berhasil dibatalkan.',
        ]);
    }

    /**
     * Proses Validasi Farmasi (Approval / Rejection).
     * Jika disetujui, otomatis membuat transaksi Retur Jual SIMRS Khanza (returjual & detreturjual),
     * mengembalikan stok ke gudangbarang, dan mencatat ke riwayat_barang_medis.
     */
    public function prosesValidasiFarmasi(Request $request, $no_pengajuan)
    {
        $request->validate([
            'aksi' => 'required|in:approve,reject',
            'catatan_farmasi' => 'nullable|string',
            'items' => 'required_if:aksi,approve|array',
        ]);

        return DB::transaction(function () use ($request, $no_pengajuan) {
            $pengajuan = RsiaPengajuanRetur::with(['details', 'regPeriksa.pasien'])
                ->where('no_pengajuan', $no_pengajuan)
                ->lockForUpdate()
                ->first();

            if (!$pengajuan) {
                return response()->json(['message' => 'Data pengajuan retur tidak ditemukan.'], 404);
            }

            if ($pengajuan->status !== 'Menunggu Validasi') {
                return response()->json(['message' => 'Pengajuan sudah diproses sebelumnya dengan status: ' . $pengajuan->status], 422);
            }

            $nikPetugas = session('pegawai')->nik ?? (session('user')->id_user ?? 'farmasi');
            $tglNow = Carbon::now()->toDateString();
            $jamNow = Carbon::now()->toTimeString();

            // Skenario 1: REJECT (DITOLAK)
            if ($request->aksi === 'reject') {
                $pengajuan->update([
                    'status' => 'Ditolak',
                    'petugas_validasi' => $nikPetugas,
                    'tgl_validasi' => $tglNow,
                    'jam_validasi' => $jamNow,
                    'catatan_farmasi' => $request->catatan_farmasi ?? 'Pengajuan ditolak oleh Farmasi',
                ]);

                return response()->json([
                    'status' => 'success',
                    'message' => 'Pengajuan retur obat berhasil ditolak.',
                ]);
            }

            // Skenario 2: APPROVE (DISETUJUI)
            $approvedItems = $request->items ?? [];
            $approvedMap = [];
            foreach ($approvedItems as $ai) {
                if (isset($ai['id'])) {
                    $approvedMap[$ai['id']] = (float)($ai['jml_disetujui'] ?? 0);
                }
            }

            $hasValidItems = false;
            foreach ($pengajuan->details as $det) {
                $jmlDisetujui = $approvedMap[$det->id] ?? (float)$det->jml_diajukan;
                if ($jmlDisetujui > 0) {
                    $hasValidItems = true;
                    break;
                }
            }

            if (!$hasValidItems) {
                return response()->json(['message' => 'Tidak ada obat yang disetujui (jumlah disetujui harus lebih dari 0).'], 422);
            }

            // 1. Generate No. Retur Jual format SIMRS Khanza: {norawat}{urut 2 digit}
            $noRawat = $pengajuan->no_rawat;
            $maxUrut = DB::table('returjual')
                ->where('no_retur_jual', 'like', $noRawat . '%')
                ->selectRaw('IFNULL(MAX(CONVERT(RIGHT(no_retur_jual, 2), SIGNED)), 0) as last_urut')
                ->value('last_urut');

            $nextUrut = sprintf('%02d', ((int)$maxUrut) + 1);
            $noReturJual = $noRawat . $nextUrut;

            // Depo pengembalian (gudangbarang)
            $kdBangsal = $pengajuan->kd_bangsal ?: 'RM';
            $noRkmMedis = $pengajuan->regPeriksa->no_rkm_medis;

            // 2. Insert Header ke table Khanza: returjual
            DB::table('returjual')->insert([
                'no_retur_jual' => $noReturJual,
                'tgl_retur' => $tglNow,
                'nip' => $nikPetugas,
                'no_rkm_medis' => $noRkmMedis,
                'kd_bangsal' => $kdBangsal,
            ]);

            // 3. Loop Detail Items
            $ttlRetur = 0;
            foreach ($pengajuan->details as $det) {
                $jmlDisetujui = $approvedMap[$det->id] ?? (float)$det->jml_diajukan;
                $jmlDisetujui = max(0, min($jmlDisetujui, (float)$det->jml_diajukan));

                $subtotal = $jmlDisetujui * (float)$det->h_retur;

                // Update detail pengajuan RSIA
                $det->update([
                    'jml_disetujui' => $jmlDisetujui,
                    'subtotal' => $subtotal,
                ]);

                if ($jmlDisetujui <= 0) {
                    continue;
                }

                $ttlRetur += $subtotal;

                // 3a. Insert Detail ke Khanza: detreturjual
                DB::table('detreturjual')->insert([
                    'no_retur_jual' => $noReturJual,
                    'nota_jual' => '-',
                    'kode_brng' => $det->kode_brng,
                    'kode_sat' => $det->kode_sat ?: '-',
                    'jml_jual' => 0,
                    'h_jual' => (float)$det->h_retur,
                    'jml_retur' => $jmlDisetujui,
                    'h_retur' => (float)$det->h_retur,
                    'subtotal' => $subtotal,
                    'no_batch' => $det->no_batch ?: '',
                    'no_faktur' => $det->no_faktur ?: '',
                ]);

                // 3b. Update / Insert Gudang Barang (Stok Depo Bertambah)
                $gbQuery = DB::table('gudangbarang')
                    ->where('kode_brng', $det->kode_brng)
                    ->where('kd_bangsal', $kdBangsal);

                if (!empty($det->no_batch)) {
                    $gbQuery->where('no_batch', $det->no_batch);
                }
                if (!empty($det->no_faktur)) {
                    $gbQuery->where('no_faktur', $det->no_faktur);
                }

                $gb = $gbQuery->first();
                $stokAwal = $gb ? (float)$gb->stok : 0;
                $stokAkhir = $stokAwal + $jmlDisetujui;

                if ($gb) {
                    $gbUpdateQuery = DB::table('gudangbarang')
                        ->where('kode_brng', $det->kode_brng)
                        ->where('kd_bangsal', $kdBangsal);

                    if (!empty($det->no_batch)) {
                        $gbUpdateQuery->where('no_batch', $det->no_batch);
                    }
                    if (!empty($det->no_faktur)) {
                        $gbUpdateQuery->where('no_faktur', $det->no_faktur);
                    }
                    $gbUpdateQuery->update(['stok' => $stokAkhir]);
                } else {
                    DB::table('gudangbarang')->insert([
                        'kode_brng' => $det->kode_brng,
                        'kd_bangsal' => $kdBangsal,
                        'stok' => $stokAkhir,
                        'no_batch' => $det->no_batch ?: '',
                        'no_faktur' => $det->no_faktur ?: '',
                    ]);
                }

                // 3c. Catat ke riwayat_barang_medis
                DB::table('riwayat_barang_medis')->insert([
                    'kode_brng' => $det->kode_brng,
                    'stok_awal' => $stokAwal,
                    'masuk' => $jmlDisetujui,
                    'keluar' => 0,
                    'stok_akhir' => $stokAkhir,
                    'posisi' => 'Retur Jual',
                    'tanggal' => $tglNow,
                    'jam' => $jamNow,
                    'petugas' => $nikPetugas,
                    'kd_bangsal' => $kdBangsal,
                    'status' => 'Simpan',
                    'no_batch' => $det->no_batch ?: '',
                    'no_faktur' => $det->no_faktur ?: '',
                ]);
            }

            // 4. Update Header RSIA Pengajuan Retur menjadi Disetujui
            $pengajuan->update([
                'status' => 'Disetujui',
                'petugas_validasi' => $nikPetugas,
                'tgl_validasi' => $tglNow,
                'jam_validasi' => $jamNow,
                'no_retur_jual' => $noReturJual,
                'catatan_farmasi' => $request->catatan_farmasi ?? null,
            ]);

            // 5. Buat transaksi Jurnal Akuntansi SIMRS Khanza (sesuai referensi DlgReturJual.java)
            $noJurnal = null;
            if ($ttlRetur > 0) {
                $jurnalService = new JurnalService();
                $noJurnal = $jurnalService->createJurnalReturJual($noReturJual, $ttlRetur, $kdBangsal, $nikPetugas);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Pengajuan retur berhasil divalidasi. Transaksi Retur Jual: ' . $noReturJual . ($noJurnal ? " (Jurnal: $noJurnal)" : ''),
                'no_retur_jual' => $noReturJual,
                'no_jurnal' => $noJurnal,
            ]);
        });
    }

    /**
     * Cetak Lembar Bukti Pengajuan Retur Obat Pasien Ranap.
     */
    public function cetakSlip($no_pengajuan)
    {
        $pengajuan = RsiaPengajuanRetur::with([
            'details.barang.satuan',
            'regPeriksa.pasien',
            'regPeriksa.kamarInap.kamar.bangsal',
            'pegawaiPengaju',
            'pegawaiValidasi',
        ])->where('no_pengajuan', $no_pengajuan)->firstOrFail();

        $setting = DB::table('setting')->first();
        $jurnal = null;
        if ($pengajuan->no_retur_jual) {
            $jurnal = DB::table('jurnal')->where('no_bukti', $pengajuan->no_retur_jual)->first();
        }

        return view('content.farmasi.retur.cetak_slip', compact('pengajuan', 'setting', 'jurnal'));
    }
}
