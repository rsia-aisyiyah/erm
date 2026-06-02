<?php

namespace App\Services\HasilKritis;

use App\Models\RsiaHasilKritis;

class HasilKritisFetchService
{
    protected $model;
    public function __construct(RsiaHasilKritis $model)
    {
        $this->model = $model;
    }
    function getByPetugas($nip)
    {
        return $this->model->orWhere('petugas_ruang', $nip)->get();
    }
}
