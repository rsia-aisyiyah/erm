<?php

namespace App\Http\Controllers\Bridging;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Services\Bpjs\Vclaim\BridgeVclaim;
use App\Services\Bpjs\Vclaim\ConfigVclaim;
use App\Services\Bpjs\Vclaim\ResponseVclaim;


class IcareController extends Controller
{
    protected $config;
    protected $output;
    protected $bridge;
    protected $client;

    public function __construct()
    {
        $this->config = new ConfigVclaim();
        $this->output = new ResponseVclaim();
        $this->bridge = new BridgeVclaim();
        $this->client = new Client();
    }
    public function rsValidate(Request $request)
    {
        $data = [
            'param' => (string)$request->param,
            'kodedokter' => (int)$request->kodedokter
        ];
        $response = Http::withHeaders($this->config->setHeaderIcare())->post($this->config->setUrlIcare(), $data);
        return $this->output->responseVclaim($response, $this->config->keyDecrypt($this->config->setTimestamp()));
    }
}
