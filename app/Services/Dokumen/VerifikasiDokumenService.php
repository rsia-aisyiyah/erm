<?php

namespace App\Services\Dokumen;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class VerifikasiDokumenService
{
    public function __construct(private DokumenResolverRegistry $registry)
    {
    }

    /**
     * Verifikasi dokumen berdasarkan uuid saja — TIDAK perlu tahu jenis dokumennya
     * di URL. Cara kerja:
     * 1. Query ringan (UNION ALL, semua kolom uuid ber-index unik) ke semua
     *    tabel terdaftar untuk menemukan tabel mana yang punya uuid ini.
     * 2. Setelah tahu kode jenisnya, delegasikan ke resolver yang sesuai
     *    untuk ambil data lengkap + mapping kolom yang benar.
     */
    public function verifikasi(string $uuid): array
    {
        $kode = $this->temukanKodeDariUuid($uuid);

        if (!$kode) {
            return ['valid' => false, 'alasan' => 'uuid_tidak_ditemukan'];
        }

        $resolver = $this->registry->get($kode);
        $data = $resolver->findByUuid($uuid);

        if (!$data) {
            return ['valid' => false, 'alasan' => 'uuid_tidak_ditemukan'];
        }

        $fileContent = Storage::disk('local')->get($data['file']);
        $hashValid = hash_equals($data['hash'], hash('sha256', $fileContent ?? ''));

        return [
            'valid' => $hashValid,
            'alasan' => $hashValid ? null : 'hash_tidak_cocok',
            'kode_jenis' => $kode,
            'jenis_dokumen' => $resolver->label(),
            'view_template' => $resolver->viewTemplate(),
            'no_rawat' => $data['no_rawat'],
            'nip' => $data['nip'],
            'signed_at' => $data['signed_at'],
            'konten' => $data['konten'],
        ];
    }

    private function temukanKodeDariUuid(string $uuid): ?string
    {
        // Tiap resolver tahu nama kolom uuid-nya sendiri lewat existsUuid(),
        // jadi tidak ada asumsi skema kolom seragam di sini.
        // Untuk performa lebih baik di skala besar, existsUuid() bisa diubah
        // memakai cache (redis) atau tabel index terpisah — lihat catatan di bawah.
        foreach ($this->registry->all() as $kode => $resolver) {
            if ($resolver->existsUuid($uuid)) {
                return $kode;
            }
        }

        return null;
    }
}