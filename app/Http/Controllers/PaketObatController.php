<?php

namespace App\Http\Controllers;

use App\Models\DataBarang;
use App\Models\Dokter;
use App\Models\GudangBarang;
use App\Models\RsiaPaketObat;
use App\Models\RsiaPaketObatDetail;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaketObatController extends Controller
{
    /**
     * Tampilan Halaman Utama Manajemen Paket Obat & BHP
     */
    public function index()
    {
        $dokterList = Dokter::where('status', '1')
            ->orderBy('nm_dokter', 'asc')
            ->get(['kd_dokter', 'nm_dokter']);

        return view('content.farmasi.paket_obat', [
            'dokterList' => $dokterList,
        ]);
    }

    /**
     * Ambil Data List Paket Obat (API / JSON)
     */
    public function getPaket(Request $request): JsonResponse
    {
        $query = RsiaPaketObat::with([
            'dokter:kd_dokter,nm_dokter',
            'details.barang.kodeSatuan',
        ])->withCount('details');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('unit') && $request->unit !== 'Semua') {
            $query->where(function ($q) use ($request) {
                $q->where('unit', $request->unit)
                    ->orWhere('unit', 'Semua');
            });
        }

        if ($request->filled('kd_dokter')) {
            $query->where('kd_dokter', $request->kd_dokter);
        }

        if ($request->filled('keyword')) {
            $kw = '%' . trim($request->keyword) . '%';
            $query->where(function ($q) use ($kw) {
                $q->where('nama_paket', 'like', $kw)
                    ->orWhere('keterangan', 'like', $kw)
                    ->orWhereHas('details.barang', function ($qb) use ($kw) {
                        $qb->where('nama_brng', 'like', $kw);
                    });
            });
        }

        $data = $query->orderBy('nama_paket', 'asc')->get();

        // Jika ada parameter depo untuk cek stok
        $kdBangsal = $request->depo ?: 'RM';
        if ($request->boolean('with_stok')) {
            $data->each(function ($paket) use ($kdBangsal) {
                $paket->details->each(function ($det) use ($kdBangsal) {
                    $stok = GudangBarang::where('kode_brng', $det->kode_brng)
                        ->where('kd_bangsal', $kdBangsal)
                        ->value('stok');
                    $det->stok = (float) ($stok ?: 0);
                    $det->satuan = $det->barang->kodeSatuan->satuan ?? ($det->barang->kode_sat ?? 'Sat');
                    $det->nama_brng = $det->barang->nama_brng ?? '-';
                });
            });
        }

        return response()->json([
            'status' => true,
            'data' => $data,
        ]);
    }

    /**
     * Ambil Detail 1 Paket Beserta Item & Stok Terkini
     */
    public function getDetail($id, Request $request): JsonResponse
    {
        $kdBangsal = $request->depo ?: 'RM';

        $paket = RsiaPaketObat::with([
            'dokter:kd_dokter,nm_dokter',
            'details.barang.kodeSatuan',
        ])->find($id);

        if (!$paket) {
            return response()->json([
                'status' => false,
                'message' => 'Paket obat tidak ditemukan.',
            ], 404);
        }

        $items = $paket->details->map(function ($det) use ($kdBangsal) {
            $stok = GudangBarang::where('kode_brng', $det->kode_brng)
                ->where('kd_bangsal', $kdBangsal)
                ->value('stok');

            return [
                'id' => $det->id,
                'kode_brng' => $det->kode_brng,
                'nama_brng' => $det->barang->nama_brng ?? '-',
                'satuan' => $det->barang->kodeSatuan->satuan ?? ($det->barang->kode_sat ?? 'Sat'),
                'jumlah' => (float) $det->jumlah,
                'aturan_pakai' => $det->aturan_pakai ?: '-',
                'keterangan' => $det->keterangan ?: '',
                'stok' => (float) ($stok ?: 0),
            ];
        });

        return response()->json([
            'status' => true,
            'data' => [
                'id' => $paket->id,
                'nama_paket' => $paket->nama_paket,
                'unit' => $paket->unit,
                'keterangan' => $paket->keterangan,
                'status' => $paket->status,
                'kd_dokter' => $paket->kd_dokter,
                'dokter' => $paket->dokter,
                'items' => $items,
            ],
        ]);
    }

    /**
     * Simpan / Update Master Paket Obat
     */
    public function simpan(Request $request): JsonResponse
    {
        $request->validate([
            'nama_paket' => 'required|string|max:150',
            'unit' => 'required|string|max:50',
            'items' => 'required|array|min:1',
            'items.*.kode_brng' => 'required',
            'items.*.jumlah' => 'required|numeric|min:0.01',
        ]);

        DB::beginTransaction();
        try {
            $paketId = $request->id;
            $payloadHeader = [
                'nama_paket' => trim($request->nama_paket),
                'unit' => $request->unit,
                'keterangan' => $request->keterangan ?: '-',
                'status' => $request->status ?? '1',
                'kd_dokter' => $request->kd_dokter ?: null,
                'created_by' => session()->get('pegawai.nik') ?? (session()->get('username') ?? 'Admin'),
            ];

            if ($paketId) {
                $paket = RsiaPaketObat::findOrFail($paketId);
                $paket->update($payloadHeader);
                RsiaPaketObatDetail::where('paket_id', $paketId)->delete();
            } else {
                $paket = RsiaPaketObat::create($payloadHeader);
                $paketId = $paket->id;
            }

            foreach ($request->items as $idx => $item) {
                RsiaPaketObatDetail::create([
                    'paket_id' => $paketId,
                    'kode_brng' => $item['kode_brng'],
                    'jumlah' => $item['jumlah'],
                    'aturan_pakai' => $item['aturan_pakai'] ?? '-',
                    'keterangan' => $item['keterangan'] ?? null,
                    'urutan' => $idx + 1,
                ]);
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Paket obat & BHP berhasil disimpan.',
                'data' => $paket,
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Gagal menyimpan paket obat: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Shortcut: Simpan dari List Order Sementara (Modal Permintaan Pasien)
     */
    public function simpanDariOrder(Request $request): JsonResponse
    {
        $request->validate([
            'nama_paket' => 'required|string|max:150',
            'unit' => 'required|string|max:50',
            'items' => 'required|array|min:1',
        ]);

        DB::beginTransaction();
        try {
            $paket = RsiaPaketObat::create([
                'nama_paket' => trim($request->nama_paket),
                'unit' => $request->unit,
                'keterangan' => $request->keterangan ?: 'Dibuat langsung dari form permintaan obat',
                'status' => '1',
                'kd_dokter' => $request->kd_dokter ?: null,
                'created_by' => session()->get('pegawai.nik') ?? (session()->get('username') ?? 'Nakes'),
            ]);

            foreach ($request->items as $idx => $item) {
                RsiaPaketObatDetail::create([
                    'paket_id' => $paket->id,
                    'kode_brng' => $item['kode_brng'],
                    'jumlah' => $item['jml'] ?? ($item['jumlah'] ?? 1),
                    'aturan_pakai' => $item['aturan_pakai'] ?? '-',
                    'keterangan' => $item['keterangan'] ?? null,
                    'urutan' => $idx + 1,
                ]);
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Paket obat baru berhasil disimpan.',
                'data' => $paket,
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Gagal menyimpan paket obat: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Hapus Master Paket Obat
     */
    public function hapus($id): JsonResponse
    {
        DB::beginTransaction();
        try {
            $paket = RsiaPaketObat::findOrFail($id);
            $paket->delete(); // Cascade delete details

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Paket obat berhasil dihapus.',
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Gagal menghapus paket obat: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Toggle Status Aktif / Nonaktif
     */
    public function toggleStatus($id): JsonResponse
    {
        try {
            $paket = RsiaPaketObat::findOrFail($id);
            $paket->status = $paket->status === '1' ? '0' : '1';
            $paket->save();

            return response()->json([
                'status' => true,
                'message' => 'Status paket obat berhasil diubah menjadi: ' . ($paket->status === '1' ? 'Aktif' : 'Nonaktif'),
                'new_status' => $paket->status,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal mengubah status paket obat: ' . $e->getMessage(),
            ], 500);
        }
    }
}
