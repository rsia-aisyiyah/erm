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
        $query = $this->getBaseQuery();
        $this->filterByRoleAndStatus($query, $nip, $status);
        $this->filterByMonth($query, $bulanRaw);

        return $query->orderBy('tgl', 'desc')->get();
    }

    private function getBaseQuery(): Builder
    {
        return $this->model->with([
            'petugas' => fn($q) => $q->select(['nip', 'nama']),
            'petugasRuang' => fn($q) => $q->select(['nip', 'nama']),
            'dokter' => fn($q) => $q->select(['kd_dokter', 'nm_dokter']),
            'dokterPj' => fn($q) => $q->select(['kd_dokter', 'nm_dokter']),
            'kamar',
            'regPeriksa.pasien' => fn($q) => $q->select(['no_rkm_medis', 'nm_pasien', 'jk'])
        ]);
    }

    /**
     * MODIFIKASI: Mendukung pencarian ganda Dokter (Sebagai DPJP Utama ATAU PJ Laborat/Rad)
     */
    private function filterByRoleAndStatus(Builder $query, string $nip, ?string $status): void
    {
        $isDokter = $this->dokterModel->where('kd_dokter', $nip)->exists();

        if ($isDokter) {
            // Dokter bisa melihat data jika dia tercatat sebagai Dokter DPJP ATAU Dokter PJ Lab/Rad
            $query->where(function ($q) use ($nip, $status) {
                $q->where(function ($sub) use ($nip, $status) {
                    $sub->where('dokter', $nip);
                    $this->applyStatusValidation($sub, 'tgl_dokter', $status);
                })->orWhere(function ($sub) use ($nip, $status) {
                    $sub->where('dokter_pj', $nip);
                    $this->applyStatusValidation($sub, 'tgl_drpj', $status);
                });
            });
        } else {
            // Untuk perawat/petugas ruangan tetap sama
            $query->where('petugas_ruang', $nip);
            $this->applyStatusValidation($query, 'tgl_ruang', $status);
        }
    }

    private function applyStatusValidation(Builder $query, string $column, ?string $status): void
    {
        $query->when($status === 'belum', fn($q) => $q->whereNull($column))
            ->when($status === 'sudah', fn($q) => $q->whereNotNull($column));
    }

    private function filterByMonth(Builder $query, ?string $bulanRaw): void
    {
        $query->when($bulanRaw, function ($q, $bulanRaw) {
            $carbon = Carbon::parse($bulanRaw);
            $q->whereMonth('tgl', $carbon->format('m'))
                ->whereYear('tgl', $carbon->format('Y'));
        });
    }
}