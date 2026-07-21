<?php

namespace App\Services\Dokumen\Resolvers;

use App\Services\Dokumen\Contracts\DokumenResolverInterface;
use Illuminate\Support\Facades\DB;

/**
 * Base class untuk tabel-tabel yang strukturnya mirip rsia_persetujuan_umum
 * (punya kolom uuid, no_rawat, nip, file, hash, signed_at).
 * Tinggal extend + isi $table dan $konten() di resolver anak.
 *
 * Kalau ada tabel lama yang nama kolomnya beda (misal 'ditandatangani_pada'
 * bukan 'signed_at'), jangan paksa extend ini — implement
 * DokumenResolverInterface langsung dan mapping manual di sana.
 */
abstract class BaseColumnResolver implements DokumenResolverInterface
{
    protected string $table;
    protected string $label;
    protected string $viewTemplate;
    protected string $nomorPrefix;
    protected string $storage;

    public function table(): string
    {
        return $this->table;
    }

    public function label(): string
    {
        return $this->label;
    }

    public function viewTemplate(): string
    {
        return $this->viewTemplate;
    }

    public function nomorPrefix(): string
    {
        return $this->nomorPrefix;
    }

    public function storage(): string
    {
        return $this->storage;
    }

    public function existsUuid(string $uuid): bool
    {
        return DB::table($this->table)->where('uuid', $uuid)->exists();
    }

    /**
     * Join ke reg_periksa + pasien SEKALI DI SINI, jadi tiap resolver anak
     * tidak perlu menulis ulang join yang sama — ini berlaku untuk semua
     * dokumen karena semua tabel referensi no_rawat.
     */
    public function findByUuid(string $uuid): ?array
    {
        $row = DB::table($this->table)
            ->join('reg_periksa', "{$this->table}.no_rawat", '=', 'reg_periksa.no_rawat')
            ->join('pasien', 'reg_periksa.no_rkm_medis', '=', 'pasien.no_rkm_medis')
            ->select(
                "{$this->table}.id",
                "{$this->table}.uuid",
                "{$this->table}.no_rawat",
                "{$this->table}.nip",
                "{$this->table}.file",
                "{$this->table}.hash",
                "{$this->table}.signed_at",
                "{$this->table}.created_at",
                'pasien.no_rkm_medis',
            )
            ->where("{$this->table}.uuid", $uuid)
            ->first();

        if (!$row) {
            return null;
        }

        return [
            'id' => $row->id,
            'uuid' => $row->uuid,
            'no_rawat' => $row->no_rawat,
            'no_rkm_medis' => $row->no_rkm_medis,
            'nip' => $row->nip,
            'file' => $row->file,
            'hash' => $row->hash,
            'signed_at' => $row->signed_at,
            'created_at' => $row->created_at,
            'konten' => $this->konten($row),
        ];
    }

    /**
     * Field tambahan spesifik jenis dokumen ini (isi bebas per tabel).
     * Contoh: general consent -> nama_wali, hubungan_pasien, dst.
     */
    abstract protected function konten(object $row): array;
}