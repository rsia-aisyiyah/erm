<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RsiaGrafikHarian;
use App\Models\RsiaEwsNadiMaternal;
use App\Models\RsiaEwsSuhuMaternal;
use App\Models\RsiaEwsOksigenMaternal;
use App\Models\RsiaEwsSaturasiMaternal;
use App\Models\RsiaEwsSistolikMaternal;
use App\Models\RsiaEwsDiastolikMaternal;
use App\Models\RsiaEwsPernafasanMaternal;

class EwsMaternalController extends Controller
{
    //
    protected $oksigen;
    protected $respirasi;
    protected $saturasi;
    protected $sistolik;
    protected $diastolik;
    protected $nadi;
    protected $suhu;
    protected $urin;
    protected $grafikHarian;
    public function __construct()
    {
        $this->oksigen = RsiaEwsOksigenMaternal::get();
        $this->respirasi = RsiaEwsPernafasanMaternal::get();
        $this->saturasi = RsiaEwsSaturasiMaternal::get();
        $this->nadi = RsiaEwsNadiMaternal::get();
        $this->suhu = RsiaEwsSuhuMaternal::get();
        $this->sistolik = RsiaEwsSistolikMaternal::get();
        $this->diastolik = RsiaEwsDiastolikMaternal::get();
        $this->grafikHarian = new RsiaGrafikHarian();
    }
    function getNilai($parameter, $periksa, $nilai1, $nilai2 = '', $kode_nilai = '')
    {
        $hp = [];
        $tanggal = [];
        $jam = [];
        // if ($parameter == 'oksigen') {
        //     foreach ($periksa as $p) {
        //         if ($kode_nilai == ">=") {
        //             if ($p['o2'] >= $nilai1) {
        //                 $hp[] = $p['o2'];
        //             } else {
        //                 $hp[] = '';
        //             }
        //         } else if ($kode_nilai == '<') {
        //             if ($p['o2'] < $nilai1) {
        //                 $hp[] = $p['o2'];
        //             } else {
        //                 $hp[] = '';
        //             }
        //         } else {
        //             if ($p['o2'] >= $nilai1 && $p['o2'] <= $nilai2) {
        //                 $hp[] = $p['o2'];
        //             } else {
        //                 $hp[] = '';
        //             }
        //         }
        //         $tanggal[] = $p['tgl_perawatan'];
        //         $jam[] = $p['jam_rawat'];
        //     }
        // } else {

        // return [$parameter];
        // if($parameter == 'sistolik')
        foreach ($periksa as $pem) {
            if ($pem[$parameter] == '-') {
                $hp[] = '';
            } else {
                if ($parameter == 'kesadaran') {
                    if ($kode_nilai == $pem[$parameter]) {
                        $hp[] = $pem[$parameter];
                    } else {

                        $hp[] = '';
                    }
                } else if ($parameter == 'suhu_tubuh') {
                    if ($kode_nilai == '<') {
                        if ($pem[$parameter] < $nilai1) {
                            $hp[] = $pem[$parameter];
                        } else {
                            $hp[] = '';
                        }
                    } else if ($kode_nilai == '>') {
                        if ($pem[$parameter] > $nilai1) {
                            $hp[] = $pem[$parameter];
                        } else {
                            $hp[] = '';
                        }
                    } else {
                        if ($pem[$parameter] <= $nilai1 && $pem[$parameter] >= $nilai2) {
                            $hp[] = $pem[$parameter];
                        } else {
                            $hp[] = '';
                        }
                    }
                } else if ($parameter == 'sistolik' || $parameter == 'diastolik') {
                    if ($parameter == 'sistolik') {
                        $pem[$parameter] = explode('/', $pem['tensi'])[0];
                    } else if ($parameter == 'diastolik') {
                        $pem[$parameter] = explode('/', $pem['tensi'])[1];
                    }

                    if ($kode_nilai == '>=') {
                        if ($pem[$parameter] >= $nilai1) {
                            $hp[] = $pem[$parameter];
                        } else {
                            $hp[] = '';
                        }
                    } else if ($kode_nilai == '<=') {
                        if ($pem[$parameter] <= $nilai1) {
                            $hp[] = $pem[$parameter];
                        } else {
                            $hp[] = '';
                        }
                    } else if ($kode_nilai == '-') {
                        if ($pem[$parameter] >= $nilai1 && $pem[$parameter] <= $nilai2) {

                            $hp[] = $pem[$parameter];
                        } else {
                            $hp[] = '';
                        }
                    }
                } else if ($parameter == 'nadi') {
                    if ($kode_nilai == '>=') {
                        if ($pem[$parameter] >= $nilai1) {
                            $hp[] = $pem[$parameter];
                        } else {
                            $hp[] = '';
                        }
                    } else if ($kode_nilai == '<=') {
                        if ($pem[$parameter] <= $nilai1) {
                            $hp[] = $pem[$parameter];
                        } else {
                            $hp[] = '';
                        }
                    } else if ($kode_nilai == '-') {
                        if ($pem[$parameter] >= $nilai1 && $pem[$parameter] <= $nilai2) {

                            $hp[] = $pem[$parameter];
                        } else {
                            $hp[] = '';
                        }
                    }
                } else {
                    if ($kode_nilai == '<') {
                        if ($pem[$parameter] < $nilai1) {
                            $hp[] = $pem[$parameter];
                        } else {
                            $hp[] = '';
                        }
                    } else if ($kode_nilai == '>') {
                        if ($pem[$parameter] > $nilai1) {
                            $hp[] = $pem[$parameter];
                        } else {
                            $hp[] = '';
                        }
                    } else if ($kode_nilai == '>=') {
                        if ($pem[$parameter] >= $nilai1) {
                            $hp[] = $pem[$parameter];
                        } else {
                            $hp[] = '';
                        }
                    } else if ($kode_nilai == '-') {
                        if ($pem[$parameter] >= $nilai1 && $pem[$parameter] <= $nilai2) {

                            $hp[] = $pem[$parameter];
                        } else {
                            $hp[] = '';
                        }
                    }
                }
            }
            $tanggal[] = $pem['tgl_perawatan'];
            $jam[] = $pem['jam_rawat'];
        }
        // }
        return ['hp' => $hp, 'tanggal' => $tanggal, 'jam' => $jam];
    }
    function getParam($table, $noRawat, $parameter = '', $sttsRawat)
    {
        $value = [];
        $periksa = $this->grafikHarian->where(['no_rawat' => $noRawat, 'sumber' => 'SOAP'])->get();
        if (count($table) == 0) {
            if ($parameter == 'oksigen') {
                $labelParam = 'L/menit';
                $indexPeriksa = 'o2';
            }
            $hp = [];
            $arrVal = [
                'id' => 1,
                'parameter' => "$labelParam",
                'hasil' => '',
                'nilai1' => '',
                'nilai2' => '',
                'kategori' => 'Maternal',
            ];
            foreach ($periksa as $p) {
                $hp[] = $p[$indexPeriksa];
                $tanggal[] = $p['tgl_perawatan'];
                $jam[] = $p['jam_rawat'];
            }
            $val[] = array_merge($arrVal, [
                'hp' => $hp,
                'tanggal' => $tanggal,
                'jam' => $jam,
            ]);
        } else {
            foreach ($table as $s) {
                $nilai_1 = $s->nilai_1 ? $s->nilai_1 : '';
                $nilai_2 = $s->nilai_2 ? $s->nilai_2 : '';
                if ($s->kode_nilai == '>') {
                    $arrVal = [
                        'id' => $s->kode,
                        'parameter' => $s->kode_nilai . ' ' . $nilai_1,
                        'hasil' => $s->hasil,
                        'nilai1' => $nilai_1,
                        'nilai2' => $nilai_2,
                        'kategori' => "Maternal"
                    ];
                    $val[] = array_merge($arrVal, $this->getNilai($parameter, $periksa, $nilai_1, $nilai_2, $s->kode_nilai));
                } else if ($s->kode_nilai == '<') {
                    $arrVal = [
                        'id' => $s->kode,
                        'parameter' => $s->kode_nilai . ' ' . $nilai_1,
                        'hasil' => $s->hasil,
                        'nilai1' => $nilai_1,
                        'nilai2' => $nilai_2,
                        'kategori' => "Maternal"
                    ];
                    $val[] = array_merge($arrVal, $this->getNilai($parameter, $periksa, $nilai_1, $nilai_2, $s->kode_nilai));
                } else if ($s->kode_nilai == '<=' || $s->kode_nilai == '>=') {
                    $arrVal = [
                        'id' => $s->kode,
                        'parameter' => $s->kode_nilai . ' ' . $nilai_2,
                        'hasil' => $s->hasil,
                        'nilai1' => $nilai_1,
                        'nilai2' => $nilai_2,
                        'kategori' => "Maternal"
                    ];
                    $val[] = array_merge($arrVal, $this->getNilai($parameter, $periksa, $nilai_1, $nilai_2, $s->kode_nilai));
                } else {
                    $arrVal = [
                        'id' => $s->kode,
                        'parameter' => $nilai_1 . $s->kode_nilai . $nilai_2,
                        'hasil' => $s->hasil,
                        'nilai1' => $nilai_1,
                        'nilai2' => $nilai_2,
                        'kategori' => "Maternal"
                    ];
                    $val[] = array_merge($arrVal, $this->getNilai($parameter, $periksa, $nilai_1, $nilai_2, $s->kode_nilai));
                }
            }
        }
        $value = $val;

        return $value;
    }
    function getParamSaturasi($noRawat, $sttsRawat)
    {
        $saturasi = $this->saturasi;
        return $this->getParam($saturasi, $noRawat, 'spo2', $sttsRawat);
    }
    function getParamOksigen($noRawat, $sttsRawat)
    {
        $oksigen = $this->oksigen;
        return $this->getParam($oksigen, $noRawat, 'oksigen', $sttsRawat);
    }
    function getParamSistolik($noRawat, $sttsRawat)
    {
        $sistolik = $this->sistolik;
        return $this->getParam($sistolik, $noRawat, 'sistolik', $sttsRawat);
    }
    function getParamDiastolik($noRawat, $sttsRawat)
    {
        $diastolik = $this->diastolik;
        return $this->getParam($diastolik, $noRawat, 'diastolik', $sttsRawat);
    }
    function getParamRespirasi($noRawat, $sttsRawat)
    {
        $respirasi = $this->respirasi;
        return $this->getParam($respirasi, $noRawat, 'respirasi', $sttsRawat);
    }
    function getParamSuhu($noRawat, $sttsRawat)
    {
        $suhu = $this->suhu;
        return $this->getParam($suhu, $noRawat, 'suhu_tubuh', $sttsRawat);
    }
    function getParamNadi($noRawat, $sttsRawat)
    {
        $nadi = $this->nadi;
        return $this->getParam($nadi, $noRawat, 'nadi', $sttsRawat);
    }
    function get($sttsRawat, $noRawat)
    {
        $id = str_replace('-', '/', $noRawat);
        return [
            'respirasi' => [
                'kategori' => "respirasi",
                'judul' => "PERNAFASAN X/MENIT",
                'data' => $this->getParamRespirasi($id, $sttsRawat),
            ],
            'spo2' => [
                'kategori' => "spo2",
                'judul' => "SATURASI 02 ",
                'data' => $this->getParamSaturasi($id, $sttsRawat),
            ],
            'oksigen' => [
                'kategori' => "oksigen",
                'judul' => "PENGGUNAAN OKSIGEN",
                'data' => $this->getParamOksigen($id, $sttsRawat),
            ],
            'suhu_tubuh' => [
                'kategori' => "suhu_tubuh",
                'judul' => 'SUHU (0C)',
                'data' => $this->getParamSuhu($id, $sttsRawat)
            ],
            'nadi' => [
                'kategori' => "nadi",
                'judul' => 'NADI X/MENIT',
                'data' =>    $this->getParamNadi($id, $sttsRawat)
            ],
            'sistolik' => [
                'kategori' => "sistolik",
                'judul' => "SISTOLIK (mmHg)",
                'data' => $this->getParamSistolik($id, $sttsRawat),
            ],
            'diastolik' => [
                'kategori' => "diastolik",
                'judul' => "DIASTOLIK (mmHg)",
                'data' => $this->getParamDiastolik($id, $sttsRawat),
            ],
        ];
    }
}
