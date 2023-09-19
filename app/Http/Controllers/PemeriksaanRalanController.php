<?php

namespace App\Http\Controllers;

use Svg\Tag\Rect;
use Carbon\Carbon;
use App\Models\RegPeriksa;
use App\Models\GrafikHarian;
use Illuminate\Http\Request;
use App\Models\PemeriksaanRalan;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\ResepObatController;
use App\Http\Controllers\TrackerSqlController;

class PemeriksaanRalanController extends Controller
{
    private $tanggal;
    private $berkas;
    private $resepObat;
    private $grafik;
    private $track;
    private $pemeriksaan;
    public function __construct()
    {
        $this->tanggal = new Carbon();
        $this->berkas = new RsiaAmbilBerkasController();
        $this->resepObat = new ResepObatController();
        $this->track = new TrackerSqlController();
        $this->pemeriksaan = new PemeriksaanRalan();
        $this->grafik = new GrafikHarian();
    }
    public function ambil(Request $request)
    {

        $pemeriksaan = PemeriksaanRalan::where('no_rawat', $request->no_rawat)
            ->with('regPeriksa', function ($q) {
                $q->with('pasien');
            })->with('pegawai')->first();

        if ($pemeriksaan) {
            return response()->json($pemeriksaan, 200);
        } else {
            $regPeriksa = RegPeriksa::where('no_rawat', $request->no_rawat)
                ->with(['pasien', 'dokter'])->first();
            return response()->json($regPeriksa, 200);
        }
    }
    function getTable(Request $request)
    {
        $pemeriksaan = $this->pemeriksaan->where(['no_rawat' => $request->no_rawat])->with(['regPeriksa.penjab', 'regPeriksa.dokter', 'pegawai', 'log', 'grafik'])
            ->orderBy('tgl_perawatan', 'DESC')
            ->orderBy('jam_rawat', 'DESC')->get();
        return DataTables::of($pemeriksaan)->make(true);
    }

    function get(Request $request)
    {
        $clause = [
            'no_rawat' => $request->no_rawat,
            'jam_rawat' => $request->jam_rawat,
            'tgl_perawatan' => $request->tgl_perawatan
        ];
        $pemeriksaan = $this->pemeriksaan->where($clause)->with(['regPeriksa.penjab', 'regPeriksa.dokter', 'pegawai', 'grafik'])->first();
        return response()->json($pemeriksaan);
    }

    function delete(Request $request)
    {

        $clause = [
            'no_rawat' => $request->no_rawat,
            'jam_rawat' => $request->jam_rawat,
            'tgl_perawatan' => $request->tgl_perawatan
        ];

        $pemeriksaan = $this->pemeriksaan->where($clause)->delete();
        $grafik = $this->grafik->where($clause)->delete();

        $this->track->deleteSql($this->pemeriksaan, $clause);
        $this->track->deleteSql($this->grafik, $clause);

        return $pemeriksaan;
    }

    public function simpan(Request $request)
    {
        $clause = [
            'no_rawat' => $request->no_rawat,
            'jam_rawat' => $request->jam_rawat,
            'tgl_perawatan' => $request->tgl_perawatan,
        ];
        $pemeriksaan = PemeriksaanRalan::where($clause)->first();
        $pemGrafik = GrafikHarian::where($clause)->first();

        $data = [
            'suhu_tubuh' => $request->suhu_tubuh,
            'tensi' => $request->tensi,
            'nadi' => $request->nadi,
            'respirasi' => $request->respirasi,
            'tinggi' => $request->tinggi,
            'berat' => $request->berat,
            'spo2' => $request->spo2,
            'gcs' => $request->gcs,
            'kesadaran' => $request->kesadaran,
            'keluhan' => $request->keluhan,
            'pemeriksaan' => $request->pemeriksaan,
            'alergi' => $request->alergi ? $request->alergi : '-',
            'rtl' => $request->rtl ? $request->rtl : '-',
            'penilaian' => $request->penilaian,
            'instruksi' => $request->instruksi,
            'evaluasi' => $request->evaluasi,
            'lingkar_perut' => '-',
        ];

        $grafik = [
            'nip' => $request->nip,
            'no_rawat' => $request->no_rawat,
            'suhu_tubuh' => $request->suhu_tubuh,
            'tensi' => $request->tensi,
            'respirasi' => $request->respirasi,
            'nadi' => $request->nadi,
            'spo2' => $request->spo2,
            'gcs' => $request->gcs,
            'kesadaran' => $request->kesadaran,
            'keluaran_urin' => $request->keluaran_urin,
            'proteinuria' => $request->proteinuria,
            'air_ketuban' => $request->air_ketuban,
            'skala_nyeri' => $request->skala_nyeri,
            'lochia' => $request->lochia,
            'terlihat_tidak_sehat' => $request->terlihat_tidak_sehat,
            'o2' => $request->o2,
            'sumber' => 'SOAP',
        ];

        if ($pemeriksaan) {
            $update = PemeriksaanRalan::where($clause)->update($data);
            $trackSql  = $this->track->updateSql($this->pemeriksaan, $data, $clause);
            if ($pemGrafik) {
                $grafik = GrafikHarian::where($clause)->update($grafik);
                $trackSql  = $this->track->updateSql($this->grafik, $grafik, $clause);
            }
        } else {
            $dataTambah = [
                'nip' => $request->nip,
                'no_rawat' => $request->no_rawat,
                'jam_rawat' => date('H:i:s'),
                'tgl_perawatan' => $this->tanggal->now()->toDateString(),
            ];

            $create = array_merge($data, $dataTambah);
            $createGrafik = array_merge($grafik, $dataTambah);

            $update = PemeriksaanRalan::create($create);
            if ($request->kd_poli != 'IGDK') {
                if ($this->berkas->isAvailable($request->no_rawat)) {
                    $this->berkas->updateWaktu($request->no_rawat);
                } else {
                    $this->berkas->create(
                        [
                            'kd_dokter' => $request->kd_dokter,
                            'kd_poli' => $request->kd_poli,
                            'no_rawat' => $request->no_rawat,
                            'no_rkm_medis' => $request->no_rkm_medis,
                            'waktu' => "0000-00-00 00:00:00",
                            'waktu_soap' => date('Y-m-d H:i:s'),
                        ]
                    );
                }
            }
            $trackSql  = $this->track->insertSql($this->pemeriksaan, $data);

            if ($request->o2) {
                GrafikHarian::create($createGrafik);
                $this->track->insertSql($this->grafik, $grafik);
            }
        }
        return response()->json(['Berhasil', $update], 200);
    }

    function edit(Request $request)
    {
        $clause = [
            'no_rawat' => $request->no_rawat,
            'jam_rawat' => $request->jam_rawat,
            'tgl_perawatan' => $request->tgl_perawatan,
        ];

        $data = [
            'suhu_tubuh' => $request->suhu_tubuh,
            'tensi' => $request->tensi,
            'nadi' => $request->nadi,
            'respirasi' => $request->respirasi,
            'tinggi' => $request->tinggi,
            'berat' => $request->berat,
            'spo2' => $request->spo2,
            'gcs' => $request->gcs,
            'kesadaran' => $request->kesadaran,
            'keluhan' => $request->keluhan,
            'pemeriksaan' => $request->pemeriksaan,
            'alergi' => $request->alergi,
            'rtl' => $request->rtl ? $request->rtl : '',
            'penilaian' => $request->penilaian,
            'instruksi' => $request->instruksi,
            'evaluasi' => $request->evaluasi,
            'lingkar_perut' => '-',
            'nip' => $request->nip,
        ];
        $dataGrafik = [
            'nip' => $request->nip,
            'no_rawat' => $request->no_rawat,
            'suhu_tubuh' => $request->suhu_tubuh,
            'tensi' => $request->tensi,
            'respirasi' => $request->respirasi,
            'nadi' => $request->nadi,
            'spo2' => $request->spo2,
            'gcs' => $request->gcs,
            'kesadaran' => $request->kesadaran,
            'keluaran_urin' => $request->keluaran_urin,
            'proteinuria' => $request->proteinuria,
            'air_ketuban' => $request->air_ketuban,
            'skala_nyeri' => $request->skala_nyeri,
            'lochia' => $request->lochia,
            'terlihat_tidak_sehat' => $request->terlihat_tidak_sehat,
            'o2' => $request->o2,
            'sumber' => 'SOAP',
        ];


        $pemeriksaan = PemeriksaanRalan::where($clause)->update($data);
        $grafik = GrafikHarian::where($clause)->update($dataGrafik);

        $this->track->updateSql($this->pemeriksaan, $data, $clause);
        $this->track->updateSql($this->grafik, $dataGrafik, $clause);

        return response()->json($pemeriksaan);
    }
}
