<?php

namespace App\Http\Controllers;

use App\Models\Departemen;
use App\Models\Pegawai;
use App\Models\RsiaErmMenu;
use App\Models\RsiaErmMenuAkses;
use App\Models\RsiaErmMenuUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ErmMenuController extends Controller
{
    public function index()
    {
        $menus = RsiaErmMenu::with(['akses', 'userOverrides.pegawai'])
            ->orderBy('urutan', 'asc')
            ->get();

        $departemens = Departemen::orderBy('nama', 'asc')->get();

        // Daftar kategori bawaan untuk dropdown
        $kategoriList = [
            'Pelayanan Pasien',
            'Penunjang & Resep',
            'Data Pasien & Reg',
            'Sistem',
        ];

        return view('content.pengaturan.menu', compact('menus', 'departemens', 'kategoriList'));
    }

    /**
     * Simpan / Update Menu
     */
    public function simpan(Request $request): JsonResponse
    {
        $request->validate([
            'nama_menu' => 'required|string|max:100',
            'url' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
        ]);

        try {
            DB::beginTransaction();

            $data = [
                'nama_menu' => $request->nama_menu,
                'url' => $request->url,
                'icon' => $request->icon ?: 'bi-circle',
                'icon_bg' => $request->icon_bg ?: 'icon-poli',
                'kategori' => $request->kategori,
                'urutan' => (int) ($request->urutan ?: 99),
                'target' => $request->target ?: '_self',
                'title' => $request->title ?: $request->nama_menu,
                'is_active' => $request->has('is_active') ? (bool) $request->is_active : true,
            ];

            if ($request->filled('id')) {
                $menu = RsiaErmMenu::findOrFail($request->id);
                $menu->update($data);
                $message = 'Menu berhasil diperbarui.';
            } else {
                $menu = RsiaErmMenu::create($data);
                $message = 'Menu baru berhasil ditambahkan.';
            }

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => $message,
                'data' => $menu,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan menu: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Toggle status aktif menu
     */
    public function toggleStatus(Request $request): JsonResponse
    {
        $request->validate([
            'id' => 'required|integer',
        ]);

        $menu = RsiaErmMenu::findOrFail($request->id);
        $menu->is_active = !$menu->is_active;
        $menu->save();

        return response()->json([
            'success' => true,
            'message' => 'Status menu berhasil diubah menjadi ' . ($menu->is_active ? 'Aktif' : 'Non-aktif'),
            'is_active' => $menu->is_active,
        ]);
    }

    /**
     * Hapus menu
     */
    public function destroy($id): JsonResponse
    {
        try {
            $menu = RsiaErmMenu::findOrFail($id);
            $menu->delete();

            return response()->json([
                'success' => true,
                'message' => 'Menu berhasil dihapus.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus menu: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update Matrix Akses per Departemen / Dokter / All
     */
    public function updateAkses(Request $request): JsonResponse
    {
        $request->validate([
            'menu_id' => 'required|integer|exists:rsia_erm_menu,id',
            'tipe_akses' => 'required|in:dep,dokter,all',
            'target_id' => 'nullable|string',
            'is_checked' => 'required|boolean',
        ]);

        $menuId = $request->menu_id;
        $tipe = $request->tipe_akses;
        $target = $request->target_id;
        $isChecked = (bool) $request->is_checked;

        if ($isChecked) {
            RsiaErmMenuAkses::firstOrCreate([
                'menu_id' => $menuId,
                'tipe_akses' => $tipe,
                'target_id' => $target,
            ]);
        } else {
            RsiaErmMenuAkses::where('menu_id', $menuId)
                ->where('tipe_akses', $tipe)
                ->where('target_id', $target)
                ->delete();
        }

        return response()->json([
            'success' => true,
            'message' => 'Hak akses menu berhasil diperbarui.',
        ]);
    }

    /**
     * Simpan / Tambah User Override (Spesifik per NIK)
     */
    public function simpanUserOverride(Request $request): JsonResponse
    {
        $request->validate([
            'menu_id' => 'required|integer|exists:rsia_erm_menu,id',
            'nik' => 'required|string',
            'is_allowed' => 'required|boolean',
        ]);

        RsiaErmMenuUser::updateOrCreate(
            ['menu_id' => $request->menu_id, 'nik' => $request->nik],
            ['is_allowed' => (bool) $request->is_allowed]
        );

        return response()->json([
            'success' => true,
            'message' => 'Akses khusus pegawai berhasil disimpan.',
        ]);
    }

    /**
     * Hapus User Override
     */
    public function hapusUserOverride(Request $request): JsonResponse
    {
        $request->validate([
            'menu_id' => 'required|integer',
            'nik' => 'required|string',
        ]);

        RsiaErmMenuUser::where('menu_id', $request->menu_id)
            ->where('nik', $request->nik)
            ->delete();

        return response()->json([
            'success' => true,
            'message' => 'Akses khusus pegawai berhasil dihapus.',
        ]);
    }

    /**
     * Cari pegawai untuk user override
     */
    public function cariPegawai(Request $request): JsonResponse
    {
        $q = $request->q;
        $pegawai = Pegawai::where('nik', 'like', "%{$q}%")
            ->orWhere('nama', 'like', "%{$q}%")
            ->limit(15)
            ->get(['nik', 'nama', 'departemen', 'jbtn']);

        return response()->json($pegawai);
    }
}
