<?php

namespace App\Http\Controllers\Bridging;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Bpjs\Bridging\Vclaim\BridgeVclaim;
use Bpjs\Bridging\Vclaim\ConfigVclaim;
use Bpjs\Bridging\Vclaim\ResponseVclaim;

class SepController extends Controller
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
    public function testConfig()
    {
        return $this->config->setHeader();
    }

    public function getSep($no_sep)
    {

        $endpoint = "SEP/{$no_sep}";
        $response = Http::withHeaders($this->config->setHeader())->get($this->config->setUrl() . $endpoint);
        return $this->output->responseVclaim($response, $this->config->keyDecrypt($this->config->setTimestamp()));
    }
    public function getPropinsi()
    {
        $response = Http::withHeaders($this->config->setHeader())->get($this->config->setUrl() . "referensi/propinsi");
        return $this->output->responseVclaim($response, $this->config->keyDecrypt($this->config->setTimestamp()));
    }
}
