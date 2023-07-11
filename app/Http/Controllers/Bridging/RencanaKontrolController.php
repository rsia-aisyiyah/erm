<?php

namespace App\Http\Controllers\Bridging;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Services\Bpjs\Vclaim\BridgeVclaim;
use App\Services\Bpjs\Vclaim\ConfigVclaim;
use App\Services\Bpjs\Vclaim\ResponseVclaim;
use PhpParser\Node\Expr\Cast\Object_;

class RencanaKontrolController extends Controller
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

    public function getSpesialis($jnsKontrol, $nomor, $tanggal)
    {
        $endpoint = "RencanaKontrol/ListSpesialistik/JnsKontrol/{$jnsKontrol}/nomor/{$nomor}/TglRencanaKontrol/{$tanggal}";
        $response = Http::withHeaders($this->config->setHeader())->get($this->config->setUrl() . $endpoint);
        return $this->output->responseVclaim($response, $this->config->keyDecrypt($this->config->setTimestamp()));
    }
    public function getDokterSpesialis($jnsKontrol, $kdPoli, $tanggal)
    {
        $endpoint = "RencanaKontrol/JadwalPraktekDokter/JnsKontrol/{$jnsKontrol}/KdPoli/{$kdPoli}/TglRencanaKontrol/{$tanggal}";
        $response = Http::withHeaders($this->config->setHeader())->get($this->config->setUrl() . $endpoint);
        return $this->output->responseVclaim($response, $this->config->keyDecrypt($this->config->setTimestamp()));
    }
    public function getListRencana($bulan, $tahun, $noka, $filter)
    {
        $endpoint = "RencanaKontrol/ListRencanaKontrol/Bulan/{$bulan}/Tahun/{$tahun}/Nokartu/{$noka}/filter/{$filter}";

        $countHit = 1;
        $output = false;
        while ($output == false) {
            $response = Http::withHeaders($this->config->setHeader())->get($this->config->setUrl() . $endpoint);
            $response = $this->output->responseVclaim($response, $this->config->keyDecrypt($this->config->setTimestamp()));
            $res = json_decode($response);
            if ($res->response == null && $res->metaData->code == '200') {
                $output = false;
                $countHit++;
            } else {
                $output = true;
            }
        }
        return $res;
    }
    public function getDataSuratKontrol($tglAwal, $tglAkhir, $filter)
    {
        $endpoint = "RencanaKontrol/ListRencanaKontrol/tglAwal/{$tglAwal}/tglAkhir/{$tglAkhir}/filter/{$filter}";
        $response = Http::withHeaders($this->config->setHeader())->get($this->config->setUrl() . $endpoint);
        return $this->output->responseVclaim($response, $this->config->keyDecrypt($this->config->setTimestamp()));
    }


    public function insertRencanaKontrol(Request $request)
    {
        $data = ['request' => $request->all()];
        $endpoint = "RencanaKontrol/insert";
        $response = Http::withHeaders($this->config->setHeaderPost())->post($this->config->setUrl() . $endpoint, $data);
        return $this->output->responseVclaim($response, $this->config->keyDecrypt($this->config->setTimestamp()));
    }
}
