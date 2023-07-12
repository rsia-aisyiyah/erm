<?php

namespace App\Http\Controllers\Bridging;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Services\Bpjs\Vclaim\BridgeVclaim;
use App\Services\Bpjs\Vclaim\ConfigVclaim;
use App\Services\Bpjs\Vclaim\ResponseVclaim;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class ReferensiController extends Controller
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
    public function testConfig()
    {
        return $this->config->setHeader();
    }

    public function getDiagnosa($diagnosa)
    {
        $endpoint = "referensi/diagnosa/{$diagnosa}";
        $result = $this->bridge->getRequest($endpoint);
        return $result;
    }

    public function getPropinsi()
    {
        $response = Http::withHeaders($this->config->setHeader())->get($this->config->setUrl() . "referensi/propinsi");
        return $this->output->responseVclaim($response, $this->config->keyDecrypt($this->config->setTimestamp()));
    }
    public function getPoli($poli)
    {
        $response = Http::withHeaders($this->config->setHeader())->get($this->config->setUrl() . "referensi/poli/{$poli}");
        return $this->output->responseVclaim($response, $this->config->keyDecrypt($this->config->setTimestamp()));
    }
    public function getDokterDpjp($jenis, $tgl, $kd_sps)
    {
        $response = Http::withHeaders($this->config->setHeader())->get($this->config->setUrl() . "referensi/dokter/pelayanan/{$jenis}/tglpelayanan/{$tgl}/spesialis/{$kd_sps}");
        return $this->output->responseVclaim($response, $this->config->keyDecrypt($this->config->setTimestamp()));
    }
    public function getPasien($nokartu, $tglsep)
    {
        $response = Http::withHeaders($this->config->setHeader())->get($this->config->setUrl() . "peserta/nokartu/{$nokartu}/tglSEP/{$tglsep}");
        return $this->output->responseVclaim($response, $this->config->keyDecrypt($this->config->setTimestamp()));
    }
    public function getFaskes($faskes, $jnsFaskes)
    {
        $endpoint = "referensi/faskes/{$faskes}/{$jnsFaskes}";
        $result = $this->bridge->getRequest($endpoint);
        return $result;
    }
}
