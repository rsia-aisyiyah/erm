<?php

namespace App\Http\Controllers\Apotek;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Bpjs\Apotek\BridgeApotek;
use App\Services\Bpjs\Apotek\ConfigApotek;
use App\Services\Bpjs\Apotek\ResponseApotek;

class ApotekReferensiController extends Controller
{
    protected $output;
    protected $bridge;
    protected $client;
    protected $config;

    public function __construct()
    {
        $this->config = new ConfigApotek();
        $this->output = new ResponseApotek();
        $this->bridge = new BridgeApotek();
        $this->client = new Client();
    }

    function getDpho()
    {
        $endpoint = 'referensi/dpho';
        $result = $this->bridge->getRequest($endpoint);
        return $result;
    }
}
