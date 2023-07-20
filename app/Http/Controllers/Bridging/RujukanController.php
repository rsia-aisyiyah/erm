<?php

namespace App\Http\Controllers\Bridging;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Services\Bpjs\Vclaim\BridgeVclaim;
use App\Services\Bpjs\Vclaim\ConfigVclaim;
use App\Services\Bpjs\Vclaim\ResponseVclaim;

class RujukanController extends Controller
{
    protected $config;
    protected $output;
    protected $bridge;

    public function __construct()
    {
        $this->config = new ConfigVclaim();
        $this->output = new ResponseVclaim();
        $this->bridge = new BridgeVclaim();
    }
    public function insertRujukanKeluar(Request $request)
    {
        $data = [
            'request' => [
                't_rujukan' => $request->all()
            ]
        ];
        $endpoint = "Rujukan/2.0/insert";
        $response = Http::withHeaders($this->config->setHeaderPost())->post($this->config->setUrl() . $endpoint, $data);
        return $this->output->responseVclaim($response, $this->config->keyDecrypt($this->config->setTimestamp()));
    }
}
