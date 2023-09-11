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
use App\Models\RsiaEwsKesadaranMaternal;
use App\Models\RsiaEwsAirKetubanMaternal;
use App\Models\RsiaEwsKeluaranUrinMaternal;
use App\Models\RsiaEwsLochiaMaternal;
use App\Models\RsiaEwsPernafasanMaternal;
use App\Models\RsiaEwsProteinueraMaternal;
use App\Models\RsiaEwsSkalaNyeriMaternal;
use App\Models\RsiaEwsTidakSehatMaternal;

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
    protected $protein;
    protected $ketuban;
    protected $kesehatan;
    protected $lochia;
    protected $kesadaran;
    protected $nyeri;
    protected $urin;
    protected $grafikHarian;
    public function __construct()
    {
        $this->oksigen = RsiaEwsOksigenMaternal::get();
        $this->protein = RsiaEwsProteinueraMaternal::get();
        $this->ketuban = RsiaEwsAirKetubanMaternal::get();
        $this->kesadaran = RsiaEwsKesadaranMaternal::get();
        $this->nyeri = RsiaEwsSkalaNyeriMaternal::get();
        $this->lochia = RsiaEwsLochiaMaternal::get();
        $this->kesehatan = RsiaEwsTidakSehatMaternal::get();
        $this->respirasi = RsiaEwsPernafasanMaternal::get();
        $this->saturasi = RsiaEwsSaturasiMaternal::get();
        $this->nadi = RsiaEwsNadiMaternal::get();
        $this->suhu = RsiaEwsSuhuMaternal::get();
        $this->sistolik = RsiaEwsSistolikMaternal::get();
        $this->urin = [];
        $this->diastolik = RsiaEwsDiastolikMaternal::get();
        $this->grafikHarian = new RsiaGrafikHarian();
    }
    function getNilai($parameter, $periksa, $nilai1, $nilai2 = '', $kode_nilai = '')
    {
        $hp = [];
        $tanggal = [];
        $jam = [];
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
                        $arrTensi = explode('/', $pem['tensi']);
                        $pem[$parameter] = count($arrTensi) > 1 ? $arrTensi[1] : '';
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
            } else if ($parameter == 'urin') {
                $labelParam = 'Y/T';
                $indexPeriksa = 'urin';
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
    function getParamProtein($noRawat, $sttsRawat)
    {
        $table = $this->protein;
        return $this->getParam($table, $noRawat, 'protein', $sttsRawat);
    }
    function getParamKetuban($noRawat, $sttsRawat)
    {
        $table = $this->ketuban;
        return $this->getParam($table, $noRawat, 'ketuban', $sttsRawat);
    }
    function getParamKesadaran($noRawat, $sttsRawat)
    {
        $table = $this->kesadaran;
        return $this->getParam($table, $noRawat, 'kesadaran', $sttsRawat);
    }
    function getParamNyeri($noRawat, $sttsRawat)
    {
        $table = $this->nyeri;
        return $this->getParam($table, $noRawat, 'nyeri', $sttsRawat);
    }
    function getParamLochia($noRawat, $sttsRawat)
    {
        $table = $this->lochia;
        return $this->getParam($table, $noRawat, 'locia', $sttsRawat);
    }
    function getParamKesehatan($noRawat, $sttsRawat)
    {
        $table = $this->kesehatan;
        return $this->getParam($table, $noRawat, 'kesehatan', $sttsRawat);
    }
    function getParamUrin($noRawat, $sttsRawat)
    {
        $table = $this->urin;
        return $this->getParam($table, $noRawat, 'urin', $sttsRawat);
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
            'urin' => [
                'kategori' => "urin",
                'judul' => "KELUARAN URIN",
                'data' => $this->getParamProtein($id, $sttsRawat),
            ],
            'proteinurea' => [
                'kategori' => "proteinurea",
                'judul' => "PROTEINUREA",
                'data' => $this->getParamUrin($id, $sttsRawat),
            ],
            'ketuban' => [
                'kategori' => "ketuban",
                'judul' => "AIR KETUBAN",
                'data' => $this->getParamKetuban($id, $sttsRawat),
            ],
            'kesadaran' => [
                'kategori' => "kesadaran",
                'judul' => "KESADARAN",
                'data' => $this->getParamKesadaran($id, $sttsRawat),
            ],
            'nyeri' => [
                'kategori' => "nyeri",
                'judul' => "SKALA NYERI",
                'data' => $this->getParamNyeri($id, $sttsRawat),
            ],
            'lochia' => [
                'kategori' => "lochia",
                'judul' => "LOCHIA",
                'data' => $this->getParamNyeri($id, $sttsRawat),
            ],
            'kesehatan' => [
                'kategori' => "kesehatan",
                'judul' => "TERLIHAT TIDAK SEHAT",
                'data' => $this->getParamKesehatan($id, $sttsRawat),
            ],
        ];
    }
}
