<?php

namespace App\Http\Controllers;

use App\Http\Action\SetStatusRawat;
use App\Http\Action\UpdateJamResepObat;
use App\Http\Action\WaktuAmbilBerkas;
use App\Http\Controllers\ResepObatController;
use App\Http\Controllers\TrackerSqlController;
use App\Http\Requests\PemeriksaanRalanRequest;
use App\Models\GrafikHarian;
use App\Models\PemeriksaanRalan;
use App\Models\RegPeriksa;
use App\Models\ResepObat;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PemeriksaanRalanController extends Controller
{
    private $tanggal;
    private $berkas;
    private $resepObat;
    private $grafik;
    private $grafikHarian;
    private $regPeriksa;
    private $track;
    private $pemeriksaan;
    private $setStatus;

    public function __construct()
    {
        $this->tanggal = new Carbon();
        $this->berkas = new WaktuAmbilBerkas();
        $this->setStatus = new SetStatusRawat();
        $this->resepObat = new ResepObatController();
        $this->track = new TrackerSqlController();
        $this->pemeriksaan = new PemeriksaanRalan();
        $this->regPeriksa = new RegPeriksa();
        $this->grafik = new GrafikHarian();
        $this->grafikHarian = new GrafikPemeriksaanHarian();
    }

    public function ambil(Request $request)
    {

        $pemeriksaan = PemeriksaanRalan::where('no_rawat', $request->no_rawat)
            ->with([
                'regPeriksa.pasien',
                'pegawai' => function ($query) {
                    $query->with('dokter');
                }
            ]);

        if ($request->kd_poli) {
            $response = response()->json($pemeriksaan->get(), 200);
        } else {
            $response = response()->json($pemeriksaan->first(), 200);
        }
        return $response;
    }

    public function getTable(Request $request)
    {
        $pemeriksaan = $this->pemeriksaan->where(['no_rawat' => $request->no_rawat])->with(['regPeriksa.penjab', 'regPeriksa.dokter', 'pegawai', 'log', 'grafik'])
            ->orderBy('tgl_perawatan', 'DESC')
            ->orderBy('jam_rawat', 'DESC')->get();
        return DataTables::of($pemeriksaan)->make(true);
    }

    public function get(Request $request)
    {
        $clause = [
            'no_rawat' => $request->no_rawat,
            'jam_rawat' => $request->jam_rawat,
            'tgl_perawatan' => $request->tgl_perawatan,
        ];
        $pemeriksaan = $this->pemeriksaan->where($clause)->with(['regPeriksa.penjab', 'regPeriksa.dokter', 'pegawai', 'grafik'])->first();
        return response()->json($pemeriksaan);
    }

    public function delete(Request $request)
    {

        $clause = [
            'no_rawat' => $request->no_rawat,
            'jam_rawat' => $request->jam_rawat,
            'tgl_perawatan' => $request->tgl_perawatan,
        ];

        $pemeriksaan = $this->pemeriksaan->where($clause)->delete();
        $grafik = $this->grafik->where($clause)->delete();

        $this->track->deleteSql($this->pemeriksaan, $clause);
        $this->track->deleteSql($this->grafik, $clause);

        return $pemeriksaan;
    }

    public function simpan(PemeriksaanRalanRequest $request, UpdateJamResepObat $updateJamResepObat)
    {
        $clause = [
            'no_rawat' => $request->no_rawat,
            'jam_rawat' => $request->jam_rawat,
            'tgl_perawatan' => $request->tgl_perawatan,
            'nip' => $request->role === 'dokter' ? $request->kd_dokter : $request->nip
        ];


        $pemeriksaan = PemeriksaanRalan::where($clause)->first();
        if ($pemeriksaan) {
            return $this->updatePemeriksaanRalan($request, $clause, $updateJamResepObat);
        } else {
            return $this->createPemeriksaanRalan($request, $clause);
        }
    }


    function updatePemeriksaanRalan(PemeriksaanRalanRequest $request, array $clause, UpdateJamResepObat $updateJamResepObat)
    {
        $data = array_merge($request->pemeriksaanData(), $clause);
        $updateJamResepObat->handle($request);
        try {
            $update = PemeriksaanRalan::where($clause)->update($request->pemeriksaanData());
            if ($update) {
                $this->track->updateSql($this->pemeriksaan, $data, $clause);
                if ($request->o2) {
                    $this->grafikHarian->update($request);
                }
            }
        } catch (QueryException $e) {
            return response()->json($e->errorInfo, 500);
        }

    }
    function createPemeriksaanRalan(PemeriksaanRalanRequest $request, array $clause)
    {
        $clause['jam_rawat'] = date('H:i:s');
        $clause['tgl_perawatan'] = date('Y-m-d');
        $dataMerge = array_merge($request->pemeriksaanData(), $clause);
        try {
            $create = $this->pemeriksaan->create($dataMerge);
            if ($create) {
                $this->track->insertSql($this->pemeriksaan, $dataMerge);
                if ($request->kd_poli != 'IGDK') {
                    $this->berkas->handle($request);
                } else {
                    $this->setStatus->handle($request, 'Sudah');
                }
                if ($request->o2) {
                    $this->grafikHarian->create($request);
                }
            }
        } catch (QueryException $e) {
            return response()->json($e->errorInfo, 500);
        }
    }

    public function edit(Request $request)
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

        if ($request->kd_poli == 'IGDK') {
            $sttsPeriksa = ['stts' => 'Sudah'];
            RegPeriksa::where('no_rawat', $request->no_rawat)->update($sttsPeriksa);
            $this->track->insertSql($this->regPeriksa, $sttsPeriksa);
        }

        return response()->json($pemeriksaan);
    }
}
