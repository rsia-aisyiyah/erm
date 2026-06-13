<?php

namespace App\Services;

class MasalahRencanaKeperawatanService
{
    public function masalah(string $noRawat, array $kodeMasalah, string $modelClass): bool
    {
        $baru = collect($kodeMasalah)
            ->filter()
            ->unique()
            ->sort()
            ->values()
            ->toArray();

        $lama = $modelClass::query()
            ->where('no_rawat', $noRawat)
            ->pluck('kode_masalah')
            ->sort()
            ->values()
            ->toArray();

        if ($lama === $baru) {
            return false;
        }

        $modelClass::query()
            ->where('no_rawat', $noRawat)
            ->get()
            ->each
            ->delete();

        foreach ($baru as $kode) {
            $modelClass::create([
                'no_rawat' => $noRawat,
                'kode_masalah' => $kode,
            ]);
        }

        return true;
    }

    public function rencana(string $noRawat, array $kodeRencana, string $modelClass): bool
    {
        $baru = collect($kodeRencana)
            ->filter()
            ->unique()
            ->sort()
            ->values()
            ->toArray();

        $lama = $modelClass::query()
            ->where('no_rawat', $noRawat)
            ->pluck('kode_rencana')
            ->sort()
            ->values()
            ->toArray();

        if ($lama === $baru) {
            return false;
        }

        $modelClass::query()
            ->where('no_rawat', $noRawat)
            ->get()
            ->each
            ->delete();

        foreach ($baru as $kode) {
            $modelClass::create([
                'no_rawat' => $noRawat,
                'kode_rencana' => $kode,
            ]);
        }

        return true;
    }
}
