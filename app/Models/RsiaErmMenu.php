<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class RsiaErmMenu extends Model
{
    use HasFactory;

    protected $table = 'rsia_erm_menu';
    protected $guarded = [];

    public function akses()
    {
        return $this->hasMany(RsiaErmMenuAkses::class, 'menu_id');
    }

    public function userOverrides()
    {
        return $this->hasMany(RsiaErmMenuUser::class, 'menu_id');
    }

    /**
     * Dapatkan daftar menu yang diizinkan untuk pegawai yang sedang login,
     * dikelompokkan berdasarkan kategori.
     */
    public static function getMenusForUser($pegawai)
    {
        if (!$pegawai) {
            return collect();
        }

        // Cek apakah tabel sudah ada (safety check jika migration belum dijalankan)
        if (!Schema::hasTable('rsia_erm_menu')) {
            return collect();
        }

        $nik = $pegawai->nik ?? '';
        $dept = $pegawai->departemen ?? '';
        $jbtn = $pegawai->jbtn ?? '';
        $jnj = $pegawai->jnj_jabatan ?? '';
        $isDokter = !empty($pegawai->dokter);

        // Superadmin whitelist
        $isSuperAdmin = ($nik === 'direksi' || $dept === 'DIR' || $jnj === 'DIRU' || $dept === 'IT' ||
            in_array($nik, ['2.319.1017', '2.424.0418', '3.604.0123']));

        $allMenus = self::where('is_active', true)
            ->with(['akses', 'userOverrides'])
            ->orderBy('urutan', 'asc')
            ->get();

        if ($isSuperAdmin) {
            return $allMenus->groupBy('kategori');
        }

        $filteredMenus = $allMenus->filter(function ($menu) use ($nik, $dept, $jbtn, $isDokter) {
            // 1. Cek User Override Spesifik (prioritas tertinggi)
            $userOverride = $menu->userOverrides->firstWhere('nik', $nik);
            if ($userOverride !== null) {
                return (bool) $userOverride->is_allowed;
            }

            // 2. Cek Akses Umum (Semua User)
            if ($menu->akses->contains('tipe_akses', 'all')) {
                return true;
            }

            // 3. Cek Pengecualian khusus dokter spesialis radiologi (tidak buka poli/obat umum)
            if ($jbtn === 'Dokter Spesialis Radiologi' && in_array($menu->url, ['/erm/poliklinik', '/erm/obat', '/erm/resep/racik'])) {
                return false;
            }

            // 4. Cek Akses Dokter
            if ($isDokter && $menu->akses->contains('tipe_akses', 'dokter')) {
                return true;
            }

            // 5. Cek Akses Departemen
            if (!empty($dept) && $menu->akses->where('tipe_akses', 'dep')->contains('target_id', $dept)) {
                return true;
            }

            // 6. Dokter Spesialis Radiologi berhak atas menu Radiologi
            if ($jbtn === 'Dokter Spesialis Radiologi' && $menu->url === '/erm/radiologi') {
                return true;
            }

            return false;
        });

        return $filteredMenus->groupBy('kategori');
    }
}

