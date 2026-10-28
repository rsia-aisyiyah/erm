<?php

namespace App\Action;

use App\Models\BridgingSep;

class FilterBridgingSep
{

    public function handle(BridgingSep $model, array $params)
    {
        if (!empty($params['start_date']) && !empty($params['end_date'])) {
            $filtered = $this->filterBetween($model, $params);
        } else if (!empty($params['tahun']) && !empty($params['bulan'])) {
            $filtered = $this->filterBulan($model, $params);
        } else {
            $filtered = $this->filterNow($model);
        }

        if (!empty($params['jnspelayanan'])) {
            $filtered = $filtered->where('jnspelayanan', $params['jnspelayanan']);
        }

        if (!empty($params['kd_poli'])) {
            $filtered = $filtered->whereHas('regPeriksa', function ($query) use ($params) {
                $query->where('kd_poli', $params['kd_poli']);
            });
        }

        if (!empty($params['kd_dokter'])) {
            $filtered = $filtered->whereHas('regPeriksa', function ($query) use ($params) {
                $query->where('kd_dokter', $params['kd_dokter']);
            });
        }

        if (!empty($params['status_skrj'])) {
            if ($params['status_skrj'] === 'flagged') {
                $filtered = $filtered->whereHas('regPeriksa.rencanaKontrolRalan', function ($query) {
                    $query->where('status_tindak_lanjut', 'KONTROL');
                });
            } else if ($params['status_skrj'] === 'terbit') {
                $filtered = $filtered->has('suratKontrol');
            } else if ($params['status_skrj'] === 'belum') {
                $filtered = $filtered->whereHas('regPeriksa.rencanaKontrolRalan', function ($query) {
                    $query->where('status_tindak_lanjut', 'KONTROL');
                })->doesntHave('suratKontrol');
            }
        }

        return $filtered;

    }

    protected function filterBetween(BridgingSep $model, array $params)
    {
        return $model->betweenTanggal($params['start_date'], $params['end_date']);
    }
    protected function filterNow(BridgingSep $model, ?string $params = null)
    {
        $date = $params ?? date('Y-m-d');
        return $model->where('tglsep', $date);
    }

    protected function filterTahun(BridgingSep $model, array $params)
    {
        return $model->tahun($params['tahun']);
    }

    protected function filterBulan(BridgingSep $model, array $params)
    {
        return $model->bulan($params['tahun'], $params['bulan']);
    }

}
