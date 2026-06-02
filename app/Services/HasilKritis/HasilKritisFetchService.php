<?php

namespace App\Services\HasilKritis;

use App\Models\Dokter;
use App\Models\RsiaHasilKritis;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;

class HasilKritisFetchService
{
    protected $model;
    protected $dokterModel;

    public function __construct(RsiaHasilKritis $model, Dokter $dokterModel)
    {
        $this->model = $model;
        $this->dokterModel = $dokterModel;
    }

    public function getByPetugas(string $nip, ?string $status = null, ?string $bulanRaw = null)
    {
        // 1. Inisialisasi query dasar beserta relasinya
        $query = $this->getBaseQuery();

        // 2. Pisahkan filter Role & Status Petugas
        $this->filterByRoleAndStatus($query, $nip, $status);

        // 3. Pisahkan filter Waktu/Bulan
        $this->filterByMonth($query, $bulanRaw);

        // 4. Eksekusi hasil akhir
        return $query->orderBy('tgl', 'desc')->get();
    }

    /**
     * Fungsi Terpisah: Mengatur Base Query & Eager Loading
     */
    private function getBaseQuery(): Builder
    {
        return $this->model->with([
            'petugas' => fn($q) => $q->select(['nip', 'nama']),
            'petugasRuang' => fn($q) => $q->select(['nip', 'nama']),
            'dokter' => fn($q) => $q->select(['kd_dokter', 'nm_dokter']),
            'regPeriksa.pasien' => fn($q) => $q->select(['no_rkm_medis', 'nm_pasien', 'jk'])
        ]);
    }

    /**
     * Fungsi Terpisah: Mengatur Filter berdasarkan Role & Status Verifikasi
     */
    private function filterByRoleAndStatus(Builder $query, string $nip, ?string $status): void
    {
        $isDokter = $this->dokterModel->where('kd_dokter', $nip)->exists();

        if ($isDokter) {
            $query->where('dokter', $nip);
            $this->applyStatusValidation($query, 'tgl_dokter', $status);
        } else {
            $query->where('petugas_ruang', $nip);
            $this->applyStatusValidation($query, 'tgl_ruang', $status);
        }
    }

    /**
     * Fungsi Terpisah: Helper khusus validasi status 'belum' / 'sudah'
     */
    private function applyStatusValidation(Builder $query, string $column, ?string $status): void
    {
        $query->when($status === 'belum', fn($q) => $q->whereNull($column))
              ->when($status === 'sudah', fn($q) => $q->whereNotNull($column));
    }

    /**
     * Fungsi Terpisah: Mengatur Filter Bulan & Tahun
     */
    private function filterByMonth(Builder $query, ?string $bulanRaw): void
    {
        $query->when($bulanRaw, function ($q, $bulanRaw) {
            $carbon = Carbon::parse($bulanRaw);
            $q->whereMonth('tgl', $carbon->format('m'))
              ->whereYear('tgl', $carbon->format('Y'));
        });
    }
}