<?php

namespace App\Http\Controllers;

use App\Models\RegPeriksa;
use App\Models\RsiaEwsNadi;
use App\Models\RsiaEwsSuhu;
use App\Models\RsiaEwsTensi;
use Illuminate\Http\Request;
use App\Models\RsiaEwsOksigen;
use App\Models\RsiaEwsSaturasi;
use App\Models\PemeriksaanRanap;
use App\Models\RsiaEwsKesadaran;
use App\Models\RsiaEwsPernafasan;
use App\Http\Controllers\PemeriksaanRanapController;

class EwsController extends Controller
{
    protected $oksigen;
    protected $respirasi;
    protected $saturasi;
    protected $pemeriksaan;
    protected $regPeriksa;
    protected $tensi;
    protected $nadi;
    protected $suhu;
    protected $kesadaran;

    public function __construct()
    {
        $this->oksigen = RsiaEwsOksigen::get();
        $this->respirasi = RsiaEwsPernafasan::get();
        $this->saturasi = RsiaEwsSaturasi::get();
        $this->nadi = RsiaEwsNadi::get();
        $this->suhu = RsiaEwsSuhu::get();
        $this->tensi = RsiaEwsTensi::get();
        $this->kesadaran = RsiaEwsKesadaran::get();
        $this->pemeriksaan = new PemeriksaanRanap();
        $this->regPeriksa = new RegPeriksaController();
    }


    function getParam($table, $noRawat)
    {
        $value = [];
        $kategoriUmur = [];
        $id = str_replace('-', '/', $noRawat);
        $regPeriksa = $this->regPeriksa->get($id);
        foreach ($table as $s) {
            $nilai_1 = $s->nilai_1 ? $s->nilai_1 : '';
            $nilai_2 = $s->nilai_2 ? $s->nilai_2 : '';
            if ($regPeriksa->sttsumur == 'Bl') {
                if ($s->kode_usia == '<') {
                    if ($s->kode_nilai == '>') {
                        $val[] = [
                            'id' => $s->kode,
                            'parameter' => $s->kode_nilai . ' ' . $nilai_1,
                            'hasil' => $s->hasil,
                            'nilai1' => $nilai_1,
                            'nilai2' => $nilai_2,
                            'kategori' => "1 - 11 Bulan"
                        ];
                    } else if ($s->kode_nilai == '<') {
                        $val[] = [
                            'id' => $s->kode,
                            'parameter' => $s->kode_nilai . ' ' . $nilai_1,
                            'hasil' => $s->hasil,
                            'nilai1' => $nilai_1,
                            'nilai2' => $nilai_2,
                            'kategori' => "1 - 11 Bulan"
                        ];
                    } else {
                        $val[] = [
                            'id' => $s->kode,
                            'parameter' => $nilai_1 . $s->kode_nilai . $nilai_2,
                            'hasil' => $s->hasil,
                            'nilai1' => $nilai_1,
                            'nilai2' => $nilai_2,
                            'kategori' => "1 - 11 Bulan"
                        ];
                    }
                }
                $value = $val;
            } else {
                if ($s->kode_usia == '-') {
                    if ($regPeriksa->umurdaftar >= $s->usia_1 && $regPeriksa->umurdaftar <= $s->usia_2) {
                        if ($s->kode_nilai == '>') {
                            $val[] = [
                                'id' => $s->kode,
                                'parameter' => $s->kode_nilai . ' ' . $nilai_1,
                                'hasil' => $s->hasil,
                                'nilai1' => $nilai_1,
                                'nilai2' => $nilai_2,
                                'kategori' => $s->usia_1 . ' - ' . $s->usia_2
                            ];
                        } else if ($s->kode_nilai == '<') {
                            $val[] = [
                                'id' => $s->kode,
                                'parameter' => $s->kode_nilai . ' ' . $nilai_1,
                                'hasil' => $s->hasil,
                                'nilai1' => $nilai_1,
                                'nilai2' => $nilai_2,
                                'kategori' => $s->usia_1 . ' - ' . $s->usia_2
                            ];
                        } else {
                            $val[] = [
                                'id' => $s->kode,
                                'parameter' => $nilai_1 . $s->kode_nilai . $nilai_2,
                                'nilai1' => $nilai_1,
                                'nilai2' => $nilai_2,
                                'hasil' => $s->hasil,
                                'kategori' => $s->usia_1 . ' - ' . $s->usia_2
                            ];
                        }
                        $value = $val;
                    }
                }
            }
        }
        return $value;
    }

    function getParamSaturasi($noRawat)
    {
        $saturasi = $this->saturasi;
        $param = $this->getParam($saturasi, $noRawat);

        $pemeriksaan = $this->pemeriksaan->where('no_rawat', $noRawat)->select('spo2', 'tgl_perawatan', 'jam_rawat')->get();

        $data = [];
        // $data = $param;
        foreach ($pemeriksaan as $pem) {
            // $data[] = $pem->spo2;
            foreach ($param as $p) {
                if ($pem['spo2'] > $p['nilai1'] && $pem['spo2'] < $p['nilai2']) {
                    $data[] = [$pem['spo2']];
                }
            }
        }
        return $data;
    }
    function getParamOksigen($noRawat)
    {
        $oksigen = $this->oksigen;
        return $this->getParam($oksigen, $noRawat);
    }
    function getParamTensi($noRawat)
    {
        $tensi = $this->tensi;
        return $this->getParam($tensi, $noRawat);
    }
    function getParamRespirasi($noRawat)
    {
        $respirasi = $this->respirasi;
        return $this->getParam($respirasi, $noRawat);
    }
    function getParamKesadaran($noRawat)
    {
        $kesadaran = $this->kesadaran;
        return $this->getParam($kesadaran, $noRawat);
    }
    function getParamSuhu($noRawat)
    {
        $suhu = $this->suhu;
        return $this->getParam($suhu, $noRawat);
    }
    function getParamNadi($noRawat)
    {
        $nadi = $this->nadi;
        return $this->getParam($nadi, $noRawat);
    }

    function get($noRawat)
    {
        $id = str_replace('-', '/', $noRawat);

        return [
            'respirasi' => [
                'kategori' => "respirasi",
                'judul' => "A + B PERNAFASAN X/MENIT",
                'data' => $this->getParamRespirasi($id),
            ],
            'spo2' => [
                'kategori' => "spo2",
                'judul' => "A + B SATURASI 02 ",
                'data' => $this->getParamSaturasi($id),
            ],
            'oksigen' => [
                'kategori' => "oksigen",
                'judul' => "OKSIGEN (KANUL, NRM, RM)",
                'data' => $this->getParamOksigen($id),
            ],
            'tensi' => [
                'kategori' => "tensi",
                'judul' => "TEKANAN DARAH SISTOLIK (mmHg)",
                'data' => $this->getParamTensi($id),
            ],
            'suhu_tubuh' => [
                'kategori' => "suhu_tubuh",
                'judul' => 'SUHU (0C)',
                'data' => $this->getParamSuhu($id)
            ],
            'kesadaran' =>
            [
                'kategori' => "kesadaran",
                'judul' => 'KESADARAN',
                'data' => $this->getParamKesadaran($id)
            ],
            'nadi' => [
                'kategori' => "nadi",
                'judul' => 'NADI X/MENIT',
                'data' =>    $this->getParamNadi($id)
            ],
        ];
    }
}
