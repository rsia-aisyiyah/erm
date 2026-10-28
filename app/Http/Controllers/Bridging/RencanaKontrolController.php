<?php

namespace App\Http\Controllers\Bridging;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Services\Bpjs\Vclaim\BridgeVclaim;
use App\Services\Bpjs\Vclaim\ConfigVclaim;
use App\Services\Bpjs\Vclaim\ResponseVclaim;
use App\Models\RencanaKontrol;
use App\Models\BridgingSep;
use App\Models\RsiaRencanaKontrolRalan;
use App\Http\Controllers\TrackerSqlController;

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
        $header = $this->config->setHeader();
        $response = Http::withHeaders($header)->get($this->config->setUrl() . $endpoint);
        return $this->output->responseVclaim($response, $this->config->keyDecrypt($header['X-timestamp']));
    }

    public function getDokterSpesialis($jnsKontrol, $kdPoli, $tanggal)
    {
        $endpoint = "RencanaKontrol/JadwalPraktekDokter/JnsKontrol/{$jnsKontrol}/KdPoli/{$kdPoli}/TglRencanaKontrol/{$tanggal}";
        $header = $this->config->setHeader();
        $response = Http::withHeaders($header)->get($this->config->setUrl() . $endpoint);
        return $this->output->responseVclaim($response, $this->config->keyDecrypt($header['X-timestamp']));
    }

    public function getListRencana($bulan, $tahun, $noka, $filter)
    {
        $endpoint = "RencanaKontrol/ListRencanaKontrol/Bulan/{$bulan}/Tahun/{$tahun}/Nokartu/{$noka}/filter/{$filter}";
        $header = $this->config->setHeader();
        $response = Http::withHeaders($header)->get($this->config->setUrl() . $endpoint);
        return $this->output->responseVclaim($response, $this->config->keyDecrypt($header['X-timestamp']));
    }

    public function getDataSuratKontrol($tglAwal, $tglAkhir, $filter)
    {
        $endpoint = "RencanaKontrol/ListRencanaKontrol/tglAwal/{$tglAwal}/tglAkhir/{$tglAkhir}/filter/{$filter}";
        $header = $this->config->setHeader();
        $response = Http::withHeaders($header)->get($this->config->setUrl() . $endpoint);
        return $this->output->responseVclaim($response, $this->config->keyDecrypt($header['X-timestamp']));
    }

    public function insertRencanaKontrol(Request $request)
    {
        $payload = $request->all();
        $noSep = $payload['noSEP'] ?? ($payload['no_sep'] ?? null);
        $kodeDokter = $payload['kodeDokter'] ?? ($payload['kode_dokter'] ?? null);
        $poliKontrol = $payload['poliKontrol'] ?? ($payload['kode_poli'] ?? null);
        $tglRencanaKontrol = $payload['tglRencanaKontrol'] ?? ($payload['tgl_kontrol'] ?? null);
        $user = $payload['user'] ?? (session()->get('pegawai') ? session()->get('pegawai')->nik : '-');

        $data = [
            'request' => [
                'noSEP' => $noSep,
                'kodeDokter' => $kodeDokter,
                'poliKontrol' => $poliKontrol,
                'tglRencanaKontrol' => $tglRencanaKontrol,
                'user' => $user,
            ]
        ];

        $endpoint = "RencanaKontrol/insert";
        $header = $this->config->setHeaderPost();
        $timestamp = $header['X-timestamp'];

        try {
            $response = Http::withHeaders($header)->post($this->config->setUrl() . $endpoint, $data);
            $resString = $this->output->responseVclaim($response, $this->config->keyDecrypt($timestamp));
            $res = json_decode($resString);
        } catch (\Exception $e) {
            Log::error('BPJS VClaim insert error: ' . $e->getMessage());
            return response()->json([
                'metaData' => [
                    'code' => '500',
                    'message' => 'Gagal menghubungi server BPJS: ' . $e->getMessage()
                ],
                'response' => null
            ]);
        }

        // Fallback: Jika response BPJS code 200 tetapi body response kosong
        if ($res && isset($res->metaData) && $res->metaData->code == '200' && (empty($res->response) || empty($res->response->noSuratKontrol))) {
            Log::warning("BPJS SKRJ 200 tetapi response body kosong untuk SEP {$noSep}, mencari surat kontrol yang baru diterbitkan...");
            $foundSurat = $this->cariSuratKontrolBaru($noSep, $tglRencanaKontrol);
            if ($foundSurat) {
                $res->response = $foundSurat;
            }
        }

        // Simpan langsung ke database RS (bridging_surat_kontrol_bpjs & rsia_rencana_kontrol_ralan)
        if ($res && isset($res->metaData) && $res->metaData->code == '200' && !empty($res->response) && !empty($res->response->noSuratKontrol)) {
            $noSurat = $res->response->noSuratKontrol;
            $tglRencana = $res->response->tglRencanaKontrol ?? $tglRencanaKontrol;
            $tglSurat = (!empty($res->response->tglTerbitKontrol) && $res->response->tglTerbitKontrol !== $tglRencana)
                ? $res->response->tglTerbitKontrol
                : date('Y-m-d');

            $sep = BridgingSep::where('no_sep', $noSep)->with('regPeriksa.dokter')->first();

            $nmDokter = $payload['nm_dokter_bpjs'] ?? ($payload['nama_dokter'] ?? ($res->response->namaDokter ?? '-'));
            $nmPoli = $payload['nm_poli_bpjs'] ?? ($payload['nama_poli'] ?? ($res->response->namaPoli ?? '-'));

            if (($nmDokter === '-' || empty($nmDokter)) && $sep && $sep->regPeriksa && $sep->regPeriksa->dokter) {
                $nmDokter = $sep->regPeriksa->dokter->nm_dokter;
            }
            if (($nmPoli === '-' || empty($nmPoli)) && $sep) {
                $nmPoli = $sep->nmpolitujuan ?: '-';
            }

            $dataDb = [
                'no_sep' => $noSep,
                'tgl_surat' => $tglSurat,
                'no_surat' => $noSurat,
                'tgl_rencana' => $tglRencana,
                'kd_dokter_bpjs' => $kodeDokter,
                'nm_dokter_bpjs' => $nmDokter,
                'kd_poli_bpjs' => $poliKontrol,
                'nm_poli_bpjs' => ucfirst(strtolower($nmPoli)),
            ];

            try {
                // 1. Simpan ke bridging_surat_kontrol_bpjs (idempotent dengan updateOrCreate)
                $rencanaKontrol = RencanaKontrol::updateOrCreate(['no_surat' => $noSurat], $dataDb);

                // 2. Track SQL SIMRS Khanza
                $track = new TrackerSqlController();
                $track->insertSql(new RencanaKontrol(), $dataDb);

                // 3. Sinkronkan ke rsia_rencana_kontrol_ralan
                if ($sep && $sep->no_rawat) {
                    RsiaRencanaKontrolRalan::updateOrCreate(
                        ['no_rawat' => $sep->no_rawat],
                        [
                            'kd_dokter' => $sep->regPeriksa ? $sep->regPeriksa->kd_dokter : ($kodeDokter ?: '-'),
                            'kd_poli' => $sep->regPeriksa ? $sep->regPeriksa->kd_poli : ($poliKontrol ?: null),
                            'status_tindak_lanjut' => 'KONTROL',
                            'tgl_rencana_kontrol' => $tglRencana,
                            'catatan' => 'SKU BPJS: ' . $noSurat,
                            'nip' => session()->get('pegawai') ? session()->get('pegawai')->nik : null,
                        ]
                    );
                }

                $res->saved_local = true;
            } catch (\Exception $e) {
                Log::error('Gagal simpan lokal bridging_surat_kontrol_bpjs: ' . $e->getMessage());
            }
        }

        return response()->json($res);
    }

    protected function cariSuratKontrolBaru($noSep, $tglRencanaKontrol)
    {
        try {
            $today = date('Y-m-d');
            $endpoint = "RencanaKontrol/ListRencanaKontrol/tglAwal/{$today}/tglAkhir/{$today}/filter/2";
            $header = $this->config->setHeader();
            $resp = Http::withHeaders($header)->get($this->config->setUrl() . $endpoint);
            $decrypted = $this->output->responseVclaim($resp, $this->config->keyDecrypt($header['X-timestamp']));
            $json = json_decode($decrypted);

            if ($json && isset($json->metaData) && $json->metaData->code == '200' && !empty($json->response->list)) {
                foreach ($json->response->list as $item) {
                    if (isset($item->noSepAsalKontrol) && $item->noSepAsalKontrol === $noSep) {
                        return (object)[
                            'noSuratKontrol' => $item->noSuratKontrol,
                            'tglRencanaKontrol' => $item->tglRencanaKontrol,
                            'tglTerbitKontrol' => $item->tglTerbitKontrol ?? $today,
                            'namaDokter' => $item->namaDokter ?? null,
                            'namaPoli' => $item->namaPoliTujuan ?? null,
                        ];
                    }
                }
            }
        } catch (\Exception $e) {
            Log::warning('Fallback cariSuratKontrolBaru gagal: ' . $e->getMessage());
        }

        return null;
    }

    public function getRencanaKontrol(string $noSuratKontrol)
    {
        $endpoint = "RencanaKontrol/noSuratKontrol/{$noSuratKontrol}";
        $header = $this->config->setHeader();
        $response = Http::withHeaders($header)->get($this->config->setUrl() . $endpoint);
        return $this->output->responseVclaim($response, $this->config->keyDecrypt($header['X-timestamp']));
    }

    public function insertPerintahInap(Request $request)
    {
        $data = ['request' => $request->all()];
        $endpoint = "RencanaKontrol/InsertSPRI";
        $header = $this->config->setHeaderPost();
        $response = Http::withHeaders($header)->post($this->config->setUrl() . $endpoint, $data);
        return $this->output->responseVclaim($response, $this->config->keyDecrypt($header['X-timestamp']));
    }
}
