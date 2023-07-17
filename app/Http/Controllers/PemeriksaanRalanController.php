<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\RegPeriksa;
use Illuminate\Http\Request;
use App\Models\PemeriksaanRalan;
use App\Http\Controllers\ResepObatController;
use App\Http\Controllers\TrackerSqlController;

class PemeriksaanRalanController extends Controller
{
    private $tanggal;
    private $berkas;
    private $resepObat;
    private $track;
    private $pemeriksaan;
    public function __construct()
    {
        $this->tanggal = new Carbon();
        $this->berkas = new RsiaAmbilBerkasController();
        $this->resepObat = new ResepObatController();
        $this->track = new TrackerSqlController();
        $this->pemeriksaan = new PemeriksaanRalan();
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
                ->with('pasien')->first();
            return response()->json($regPeriksa, 200);
        }
    }
    public function simpan(Request $request)
    {
        $clause = [
            'no_rawat' => $request->no_rawat,
        ];
        $pemeriksaan = PemeriksaanRalan::where($clause)->first();

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
            'jam_rawat' => date('H:i:s'),
            'tgl_perawatan' => $this->tanggal->now()->toDateString(),
        ];

        if ($pemeriksaan) {
            $update = PemeriksaanRalan::where($clause)->update($data);
            $trackSql  = $this->track->updateSql($this->pemeriksaan, $data, $clause);
        } else {
            $dataTambah = [
                'nip' => $request->nip,
                'no_rawat' => $request->no_rawat,
            ];

            $create = array_merge($data, $dataTambah);

            $update = PemeriksaanRalan::create($create);
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
            $trackSql  = $this->track->insertSql($this->pemeriksaan, $data);
        }


        if ($this->resepObat->isAvailable($request->no_rawat)) {
            $resep = $this->resepObat->isAvailable($request->no_rawat);
            $this->resepObat->updateTime($resep->no_resep);
        }
        $this->track->create($trackSql);
        return response()->json(['Berhasil', $update], 200);
    }
}
