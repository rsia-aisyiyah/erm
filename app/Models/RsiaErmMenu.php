<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;

class RsiaErmMenu extends Model
{
    use HasFactory;

    public const CACHE_KEY = 'rsia_erm_menus_active_v1';
    public const CACHE_TTL_SECONDS = 600;

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
     * Single source of truth untuk pengecekan Superadmin (IT / Direksi).
     */
    public static function isSuperAdmin($pegawai): bool
    {
        if (!$pegawai) {
            return false;
        }

        $nik = (string) ($pegawai->nik ?? '');
        $dept = strtoupper((string) ($pegawai->departemen ?? ''));
        $jnj = strtoupper((string) ($pegawai->jnj_jabatan ?? ''));

        return $nik === 'direksi'
            || $dept === 'DIR'
            || $jnj === 'DIRU'
            || $dept === 'IT'
            || in_array($nik, ['2.319.1017', '2.424.0418', '3.604.0123'], true);
    }

    /**
     * Ubah URL menu dari DB (yang mungkin masih berawalan /erm/...) agar mengikuti base path aktif.
     */
    public static function toAppUrl(?string $url): string
    {
        if (empty($url)) {
            return url('/');
        }

        if ($url === 'KYC_DYNAMIC' || preg_match('#^https?://#i', $url)) {
            return $url;
        }

        // URL aplikasi terpisah di server yang sama (misal /lab) tetap utuh
        if (!preg_match('#^/erm(/|$)#i', $url)) {
            return $url;
        }

        $relative = preg_replace('#^/erm#i', '', $url);
        $relative = '/' . ltrim((string) $relative, '/');

        return url($relative);
    }

    /**
     * Normalisasi URL/path menu agar "/erm/ranap", "/erm-dev/ranap", "/ranap/", dan "ranap" selalu cocok konsisten.
     */
    public static function normalizePath(?string $url): string
    {
        if (empty($url)) {
            return '';
        }

        $path = parse_url($url, PHP_URL_PATH) ?? $url;
        $clean = trim($path, '/');

        $appBase = trim((string) (parse_url(url('/'), PHP_URL_PATH) ?? ''), '/');
        if (!empty($appBase) && preg_match('#^' . preg_quote($appBase, '#') . '(/|$)#i', $clean)) {
            $clean = substr($clean, strlen($appBase));
            $clean = trim($clean, '/');
        }

        $clean = preg_replace('#^erm(/|$)#i', '', $clean);

        return strtolower(trim((string) $clean, '/'));
    }

    /**
     * Ambil seluruh menu aktif beserta relasi akses & override dari cache.
     */
    public static function getCachedMenus(): Collection
    {
        return Cache::remember(self::CACHE_KEY, self::CACHE_TTL_SECONDS, function () {
            if (!Schema::hasTable('rsia_erm_menu')) {
                return collect();
            }

            return self::where('is_active', true)
                ->with(['akses', 'userOverrides'])
                ->orderBy('urutan', 'asc')
                ->get();
        });
    }

    /**
     * Hapus cache menu saat admin mengubah master menu / matriks akses / override.
     */
    public static function clearCache(): void
    {
        Cache::forget(self::CACHE_KEY);
    }

    /**
     * Evaluasi apakah pegawai tertentu berhak mengakses 1 item menu.
     */
    public static function evaluateMenuForUser(self $menu, $pegawai): bool
    {
        if (self::isSuperAdmin($pegawai)) {
            return true;
        }

        $nik = (string) ($pegawai->nik ?? '');
        $dept = (string) ($pegawai->departemen ?? '');
        $jbtn = (string) ($pegawai->jbtn ?? '');
        $isDokter = !empty($pegawai->dokter);

        // 1. Cek User Override Spesifik (prioritas tertinggi)
        $userOverride = $menu->userOverrides->firstWhere('nik', $nik);
        if ($userOverride !== null) {
            return (bool) $userOverride->is_allowed;
        }

        // 2. Cek Akses Umum (Semua User)
        if ($menu->akses->contains('tipe_akses', 'all')) {
            return true;
        }

        $normalizedMenuPath = self::normalizePath($menu->url);

        // 3. Pengecualian khusus dokter spesialis radiologi (tidak buka poli/obat umum)
        if ($jbtn === 'Dokter Spesialis Radiologi' && in_array($normalizedMenuPath, ['poliklinik', 'obat', 'resep/racik'], true)) {
            return false;
        }

        // 4. Cek Akses Dokter
        if ($isDokter && $menu->akses->contains('tipe_akses', 'dokter')) {
            return true;
        }

        // 5. Cek Akses Departemen
        if ($dept !== '' && $menu->akses->where('tipe_akses', 'dep')->contains('target_id', $dept)) {
            return true;
        }

        // 6. Dokter Spesialis Radiologi berhak atas menu Radiologi
        if ($jbtn === 'Dokter Spesialis Radiologi' && $normalizedMenuPath === 'radiologi') {
            return true;
        }

        return false;
    }

    /**
     * Cek hak akses backend untuk middleware CheckMenuAccess berdasarkan path menu.
     */
    public static function canUserAccess($pegawai, string $menuPath): bool
    {
        if (!$pegawai) {
            return false;
        }

        if (self::isSuperAdmin($pegawai)) {
            return true;
        }

        $targetPath = self::normalizePath($menuPath);
        if ($targetPath === '') {
            return true;
        }

        $allMenus = self::getCachedMenus();

        // Jika tabel menu belum dimigrasi / kosong, gunakan fallback aman sesuai aturan sidebar legacy
        if ($allMenus->isEmpty()) {
            return self::fallbackLegacyAccess($pegawai, $targetPath);
        }

        $matchedMenu = $allMenus->first(function (self $menu) use ($targetPath) {
            return self::normalizePath($menu->url) === $targetPath;
        });

        // Jika menu tidak ditemukan di master menu aktif (nonaktif / belum didaftarkan), tolak akses non-superadmin
        if (!$matchedMenu) {
            return false;
        }

        return self::evaluateMenuForUser($matchedMenu, $pegawai);
    }

    /**
     * Fallback aturan akses apabila tabel rsia_erm_menu belum tersedia.
     */
    protected static function fallbackLegacyAccess($pegawai, string $targetPath): bool
    {
        $dept = (string) ($pegawai->departemen ?? '');
        $jbtn = (string) ($pegawai->jbtn ?? '');
        $nik = (string) ($pegawai->nik ?? '');
        $isDokter = !empty($pegawai->dokter);

        switch ($targetPath) {
            case 'poliklinik':
            case 'obat':
            case 'resep/racik':
                return $jbtn !== 'Dokter Spesialis Radiologi'
                    && ($isDokter || in_array($dept, ['DPM1', 'DPM2', 'DM6', 'DM7', 'CSM', 'SPS'], true));
            case 'ranap':
                return $isDokter || in_array($dept, ['DM1', 'DM2', 'DM3', 'DM4', 'DM5', 'DM7', 'DM8', 'DNM5', 'DPM1', 'DPM2', 'CSM', 'SPS', 'ICU'], true);
            case 'ugd':
                return $isDokter || in_array($dept, ['DM1', 'DM7', 'DPM2', 'CSM', 'SPS'], true);
            case 'operasi':
                return $isDokter || in_array($dept, ['OK', 'IBS', 'DM1', 'DM2', 'DM3', 'DM4', 'DM5', 'DM7', 'DPM1', 'DPM2', 'CSM', 'SPS', 'ICU'], true);
            case 'lab':
                return true;
            case 'radiologi':
                return $jbtn === 'Dokter Spesialis Radiologi' || in_array($dept, ['RAD', 'CSM'], true);
            case 'resep':
                return $dept === 'DPM1';
            case 'pasien':
                return in_array($dept, ['DPM2', 'CSM', 'DNM2'], true) || $nik === '2.326.0418';
            case 'registrasi':
                return $dept === 'DNM6';
            case 'sep':
                return in_array($dept, ['DNM6', 'DM6'], true);
            case 'pengaturan/menu':
            case 'logs':
                return false;
            default:
                return false;
        }
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

        $allMenus = self::getCachedMenus();
        if ($allMenus->isEmpty()) {
            return collect();
        }

        if (self::isSuperAdmin($pegawai)) {
            return $allMenus->groupBy('kategori');
        }

        $filteredMenus = $allMenus->filter(function (self $menu) use ($pegawai) {
            return self::evaluateMenuForUser($menu, $pegawai);
        });

        return $filteredMenus->groupBy('kategori');
    }
}

