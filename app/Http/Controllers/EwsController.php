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
use App\Models\PemeriksaanRalan;
use App\Models\RsiaGrafikHarian;

class EwsController extends Controller
{
    protected $oksigen;
    protected $respirasi;
    protected $saturasi;
    protected $pemRanap;
    protected $pemRalan;
    protected $regPeriksa;
    protected $tensi;
    protected $nadi;
    protected $suhu;
    protected $kesadaran;
    protected $grafikHarian;

    public function __construct()
    {
        $this->oksigen = RsiaEwsOksigen::get();
        $this->respirasi = RsiaEwsPernafasan::get();
        $this->saturasi = RsiaEwsSaturasi::get();
        $this->nadi = RsiaEwsNadi::get();
        $this->suhu = RsiaEwsSuhu::get();
        $this->tensi = RsiaEwsTensi::get();
        $this->kesadaran = RsiaEwsKesadaran::get();
        $this->pemRanap = new PemeriksaanRanap();
        $this->pemRalan = new PemeriksaanRalan();
        $this->regPeriksa = new RegPeriksaController();
        $this->grafikHarian = new RsiaGrafikHarian();
    }


    function getParam($table, $noRawat, $parameter = '', $sttsRawat)
    {
        $value = [];
        $kategoriUmur = [];
        $pemeriksaan = $sttsRawat == 'ranap' ? $this->pemRanap->where('no_rawat', $noRawat) : $this->pemRalan->where('no_rawat', $noRawat);
        $periksa = $parameter != 'oksigen' ? $pemeriksaan->select($parameter, 'tgl_perawatan', 'jam_rawat')->get() :
            $this->grafikHarian->where(['no_rawat' => $noRawat, 'sumber' => 'SOAP'])->select('o2', 'tgl_perawatan', 'jam_rawat')->get();

        $id = str_replace('-', '/', $noRawat);
        $regPeriksa = $this->regPeriksa->get($id);
        foreach ($table as $s) {
            $nilai_1 = $s->nilai_1 ? $s->nilai_1 : '';
            $nilai_2 = $s->nilai_2 ? $s->nilai_2 : '';
            if (
                $regPeriksa->sttsumur == 'Bl' ||
                $regPeriksa->sttsumur == 'Hr'
            ) {
                if ($s->kode_usia == '<') {
                    if ($s->kode_nilai == '>') {
                        $arrVal = [
                            'id' => $s->kode,
                            'parameter' => $s->kode_nilai . ' ' . $nilai_1,
                            'hasil' => $s->hasil,
                            'nilai1' => $nilai_1,
                            'nilai2' => $nilai_2,
                            'kategori' => "1 - 11 Bulan"
                        ];
                        $val[] = array_merge($arrVal, $this->getNilai($parameter, $periksa, $nilai_1, $nilai_2, $s->kode_nilai));
                    } else if ($s->kode_nilai == '<') {
                        $arrVal = [
                            'id' => $s->kode,
                            'parameter' => $s->kode_nilai . ' ' . $nilai_1,
                            'hasil' => $s->hasil,
                            'nilai1' => $nilai_1,
                            'nilai2' => $nilai_2,
                            'kategori' => "1 - 11 Bulan"
                        ];
                        $val[] = array_merge($arrVal, $this->getNilai($parameter, $periksa, $nilai_1, $nilai_2, $s->kode_nilai));
                    } else if ($s->kode_nilai == '<=' || $s->kode_nilai == '>=') {
                        $arrVal = [
                            'id' => $s->kode,
                            'parameter' => $s->kode_nilai . ' ' . $nilai_2,
                            'hasil' => $s->hasil,
                            'nilai1' => $nilai_1,
                            'nilai2' => $nilai_2,
                            'kategori' => "1 - 11 Bulan"
                        ];
                        $val[] = array_merge($arrVal, $this->getNilai($parameter, $periksa, $nilai_1, $nilai_2, $s->kode_nilai));
                    } else {
                        $arrVal = [
                            'id' => $s->kode,
                            'parameter' => $nilai_1 . $s->kode_nilai . $nilai_2,
                            'hasil' => $s->hasil,
                            'nilai1' => $nilai_1,
                            'nilai2' => $nilai_2,
                            'kategori' => "1 - 11 Bulan"
                        ];
                        $val[] = array_merge($arrVal, $this->getNilai($parameter, $periksa, $nilai_1, $nilai_2, $s->kode_nilai));
                    }
                }
                $value = $val;
            } else if ($regPeriksa->sttsumur == 'Th') {
                if ($s->kode_usia == '-') {
                    if ($regPeriksa->umurdaftar >= $s->usia_1 && $regPeriksa->umurdaftar <= $s->usia_2) {
                        if ($s->kode_nilai == '>' || $s->kode_nilai == '<') {
                            $arrVal = [
                                'id' => $s->kode,
                                'parameter' => $s->kode_nilai . ' ' . $nilai_1,
                                'hasil' => $s->hasil,
                                'nilai1' => $nilai_1,
                                'nilai2' => $nilai_2,
                                'kategori' => $s->usia_1 . ' - ' . $s->usia_2 . ' Tahun'
                            ];
                            $val[] = array_merge($arrVal, $this->getNilai($parameter, $periksa, $nilai_1, $nilai_2, $s->kode_nilai));
                        } else if ($s->kode_nilai == '>=' || $s->kode_nilai == '<=') {
                            $arrVal = [
                                'id' => $s->kode,
                                'parameter' => $s->kode_nilai . ' ' . $nilai_1,
                                'hasil' => $s->hasil,
                                'nilai1' => $nilai_1,
                                'nilai2' => $nilai_2,
                                'kategori' => $s->usia_1 . ' - ' . $s->usia_2 . ' Tahun'
                            ];
                            $val[] = array_merge($arrVal, $this->getNilai($parameter, $periksa, $nilai_1, $nilai_2, $s->kode_nilai));
                        } else {
                            $arrVal = [
                                'id' => $s->kode,
                                'parameter' => $nilai_1 . $s->kode_nilai . $nilai_2,
                                'nilai1' => $nilai_1,
                                'nilai2' => $nilai_2,
                                'hasil' => $s->hasil,
                                'kategori' => $s->usia_1 . ' - ' . $s->usia_2 . ' Tahun'
                            ];
                            $val[] = array_merge($arrVal, $this->getNilai($parameter, $periksa, $nilai_1, $nilai_2, $s->kode_nilai));
                        }
                        $value = $val;
                    }
                }
            }
        }
        return $value;
    }
    function getNilai($parameter, $periksa, $nilai1, $nilai2 = '', $kode_nilai = '')
    {
        $hp = [];
        $tanggal = [];
        $jam = [];
        if ($parameter == 'oksigen') {
            foreach ($periksa as $p) {
                if ($kode_nilai == ">=") {
                    if ($p['o2'] >= $nilai1) {
                        $hp[] = $p['o2'];
                    } else {
                        $hp[] = '';
                    }
                } else if ($kode_nilai == '<') {
                    if ($p['o2'] < $nilai1) {
                        $hp[] = $p['o2'];
                    } else {
                        $hp[] = '';
                    }
                } else {
                    if ($p['o2'] >= $nilai1 && $p['o2'] <= $nilai2) {
                        $hp[] = $p['o2'];
                    } else {
                        $hp[] = '';
                    }
                }
                $tanggal[] = $p['tgl_perawatan'];
                $jam[] = $p['jam_rawat'];
            }
        } else {
            foreach ($periksa as $pem) {
                if ($pem[$parameter] == '-') {
                    $hp[] = '';
                } else {
                    if ($parameter == 'tensi') {
                        $tensi = explode('/', $pem[$parameter]);
                        $pem[$parameter] = $tensi[0];
                    }
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
        }
        return ['hp' => $hp, 'tanggal' => $tanggal, 'jam' => $jam];
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
    function getParamTensi($noRawat, $sttsRawat)
    {
        $tensi = $this->tensi;
        return $this->getParam($tensi, $noRawat, 'tensi', $sttsRawat);
    }
    function getParamRespirasi($noRawat, $sttsRawat)
    {
        $respirasi = $this->respirasi;
        return $this->getParam($respirasi, $noRawat, 'respirasi', $sttsRawat);
    }
    function getParamKesadaran($noRawat, $sttsRawat)
    {
        $kesadaran = $this->kesadaran;
        return $this->getParam($kesadaran, $noRawat, 'kesadaran', $sttsRawat);
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
                'judul' => "A + B PERNAFASAN X/MENIT",
                'data' => $this->getParamRespirasi($id, $sttsRawat),
            ],
            'spo2' => [
                'kategori' => "spo2",
                'judul' => "A + B SATURASI 02 ",
                'data' => $this->getParamSaturasi($id, $sttsRawat),
            ],
            'oksigen' => [
                'kategori' => "oksigen",
                'judul' => "OKSIGEN (KANUL, NRM, RM)",
                'data' => $this->getParamOksigen($id, $sttsRawat),
            ],
            'tensi' => [
                'kategori' => "tensi",
                'judul' => "TEKANAN DARAH SISTOLIK (mmHg)",
                'data' => $this->getParamTensi($id, $sttsRawat),
            ],
            'suhu_tubuh' => [
                'kategori' => "suhu_tubuh",
                'judul' => 'SUHU (0C)',
                'data' => $this->getParamSuhu($id, $sttsRawat)
            ],
            'kesadaran' =>
            [
                'kategori' => "kesadaran",
                'judul' => 'KESADARAN',
                'data' => $this->getParamKesadaran($id, $sttsRawat)
            ],
            'nadi' => [
                'kategori' => "nadi",
                'judul' => 'NADI X/MENIT',
                'data' =>    $this->getParamNadi($id, $sttsRawat)
            ],
        ];
    }
}
