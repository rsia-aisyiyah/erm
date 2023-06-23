<?php

namespace App\Services\Bpjs;

use Bpjs\Bridging\Vclaim\BridgeVclaim;

class Referensi
{
    protected $serviceBpjs;
    public function __construct()
    {
        $this->serviceBpjs = new BridgeVclaim();
    }

    public function getDiagnosa($diagnosa)
    {
        $endpoint = "referensi/diagnosa/{$diagnosa}";
        return $dg = $this->serviceBpjs->getRequest($endpoint);
    }
}
