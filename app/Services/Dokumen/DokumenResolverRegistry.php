<?php

namespace App\Services\Dokumen;

use App\Services\Dokumen\Contracts\DokumenResolverInterface;

class DokumenResolverRegistry
{
    /** @var array<string, DokumenResolverInterface> cache instance per kode */
    private array $instances = [];

    public function get(string $kode): DokumenResolverInterface
    {
        if (!isset($this->instances[$kode])) {
            $class = config("dokumen.resolvers.{$kode}");

            if (!$class) {
                throw new \InvalidArgumentException("Resolver untuk kode dokumen '{$kode}' tidak terdaftar.");
            }

            $this->instances[$kode] = app($class);
        }

        return $this->instances[$kode];
    }

    /**
     * Cari kode jenis dokumen dengan mengecek existsUuid() ke tiap resolver
     * terdaftar. Return null kalau uuid tidak ditemukan di tabel manapun.
     */
    public function findKodeByUuid(string $uuid): ?string
    {
        foreach ($this->all() as $kode => $resolver) {
            if ($resolver->existsUuid($uuid)) {
                return $kode;
            }
        }

        return null;
    }

    /** @return array<string, DokumenResolverInterface> semua resolver terdaftar, keyed by kode */
    public function all(): array
    {
        return collect(config('dokumen.resolvers'))
            ->mapWithKeys(fn($class, $kode) => [$kode => $this->get($kode)])
            ->all();
    }
}