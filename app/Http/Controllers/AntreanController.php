<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AntreanController extends Controller
{

    protected $resepObat;

    public function __construct()
    {
        $this->resepObat = new \App\Models\ResepObat;
    }

    function index()
    {
        return view('antrian');
    }

    public function getSuara(Request $request)
    {
        $text = $request->query('text', 'Nomor antrian');
        $text = substr(trim($text), 0, 150);

        $url = 'https://translate.google.com/translate_tts?ie=UTF-8&tl=id&client=tw-ob&q=' . urlencode($text);

        try {
            $context = stream_context_create([
                'http' => [
                    'header' => "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64)\r\n",
                    'timeout' => 5
                ]
            ]);
            $audio = @file_get_contents($url, false, $context);
            if ($audio !== false && strlen($audio) > 0) {
                return response($audio, 200, [
                    'Content-Type' => 'audio/mpeg',
                    'Cache-Control' => 'public, max-age=86400',
                ]);
            }
        } catch (\Exception $e) {
            // ignore
        }

        return response('Gagal memuat suara', 500);
    }

    function getAntrian()
    {
        $data = $this->resepObat
            ->with([
                'regPeriksa' => function ($q) {
                    return $q->with(['pasien', 'poliklinik', 'dokter']);
                },
                'resepDokter',
                'resepRacikan',
            ])
            ->where('tgl_peresepan', date('Y-m-d'))
            ->get();

        $data = $data->map(function ($item) {
            return [
                'no_resep' => $item->no_resep,
                'no_rawat' => $item->no_rawat,
                'nm_pasien' => $item->regPeriksa->pasien->nm_pasien,
                'status_obat' => $this->getStatus($item),
                'category_obat' => $this->getCategory($item),
                'poliklinik' => $item->regPeriksa->poliklinik->nm_poli,
                'dokter' => $item->regPeriksa->dokter->nm_dokter,

                'tgl_peresepan' => $item->tgl_peresepan,
                'jam_peresepan' => $item->jam_peresepan,
                "tgl_perawatan" => $item->tgl_perawatan,
                "jam_perawatan" => $item->jam,
                "tgl_penyerahan" => $item->tgl_penyerahan,
                "jam_penyerahan" => $item->jam_penyerahan,

                'resepDokter' => $item->resepDokter,
                'resepRacikan' => $item->resepRacikan,
            ];
        });


        return response()->json($data);
    }

    private function getCategory($data)
    {
        if ($data->resepRacikan && count($data->resepRacikan) > 0) {
            return 'RACIKAN';
        } elseif ($data->resepDokter && count($data->resepDokter) > 0) {
            return 'NON RACIKAN';
        } else {
            return 'NON RACIK';
        }
    }

    private function getStatus($data)
    {
        if ($data->tgl_perawatan == "000-00-00") {
            return "MENUNGGU VALIDASI";
        } elseif ($data->tgl_perawatan !== "0000-00-00" && $data->tgl_penyerahan == "0000-00-00") {
            return "DISIAPKAN";
        } elseif ($data->tgl_perawatan != "0000-00-00" && $data->tgl_penyerahan != "0000-00-00") {
            return "SELESAI";
        } else {
            return "-";
        }
    }
}