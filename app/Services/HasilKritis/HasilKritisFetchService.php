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
        $isDireksi = in_array(strtolower($nip), ['direksi', 'admin', 'verifikator'])
            || (session()->has('pegawai') && in_array(session()->get('pegawai')->jnj_jabatan ?? '', ['DIRU', 'DIR', 'DIRT']))
            || (session()->has('pegawai') && in_array(session()->get('pegawai')->departemen ?? '', ['DIR', 'DPM1', 'DPM2', 'DM1', 'DM7', 'CSM', 'SPS']));

        if ($isDireksi) {
            if ($status === 'belum') {
                $query->where(function ($q) {
                    $q->whereNull('tgl_ruang')
                        ->orWhere('tgl_ruang', '0000-00-00 00:00:00')
                        ->orWhereNull('tgl_dokter')
                        ->orWhere('tgl_dokter', '0000-00-00 00:00:00')
                        ->orWhereNull('tgl_drpj')
                        ->orWhere('tgl_drpj', '0000-00-00 00:00:00');
                });
            } elseif ($status === 'sudah') {
                $query->whereNotNull('tgl_ruang')
                    ->where('tgl_ruang', '!=', '0000-00-00 00:00:00')
                    ->whereNotNull('tgl_dokter')
                    ->where('tgl_dokter', '!=', '0000-00-00 00:00:00')
                    ->whereNotNull('tgl_drpj')
                    ->where('tgl_drpj', '!=', '0000-00-00 00:00:00');
            }
            return;
        }

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
        $query->when($status === 'belum', fn($q) => $q->where(fn($sub) => $sub->whereNull($column)->orWhere($column, '0000-00-00 00:00:00')))
            ->when($status === 'sudah', fn($q) => $q->whereNotNull($column)->where($column, '!=', '0000-00-00 00:00:00'));
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