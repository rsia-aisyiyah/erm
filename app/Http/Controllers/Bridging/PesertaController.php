<?php

namespace App\Http\Controllers\Bridging;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Bpjs\Vclaim\BridgeVclaim;
use App\Services\Bpjs\Vclaim\ConfigVclaim;
use App\Services\Bpjs\Vclaim\ResponseVclaim;

class PesertaController extends Controller
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
    function getPesertaNik($nik, $tanggal)
    {

        $endpoint = "Peserta/nik/{$nik}/tglSEP/{$tanggal}";
        $result = $this->bridge->getRequest($endpoint);
        return $result;
    }
    function getPesertaNoka($noka, $tanggal)
    {
		$endpoint = "Peserta/nokartu/{$noka}/tglSEP/{$tanggal}";
        $result = $this->bridge->getRequest($endpoint);
        return $result;
    }
}
