<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\RsiaLogSoap;
use App\Models\GrafikHarian;
use Illuminate\Http\Request;
use App\Models\PemeriksaanRanap;
use App\Models\RsiaGrafikHarian;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\RsiaLogSoapController;

class PemeriksaanRanapController extends Controller
{
    private $tanggal;
    private $pemeriksaan;
    private $grafikharian;
    private $track;
    private $grafikHarian;
    private $log;

    public function __construct()
    {
        $this->tanggal = new Carbon();
        $this->pemeriksaan = new PemeriksaanRanap();
        $this->grafikharian = new GrafikHarian();
        $this->track = new TrackerSqlController();
        $this->grafikHarian = new RsiaGrafikHarian();
        $this->log = new RsiaLogSoapController();
    }

    public function ambilSatu(Request $request)
    {
        $pemeriksaan = PemeriksaanRanap::where('no_rawat', $request->no_rawat)
            ->with(['regPeriksa', 'regPeriksa.pasien', 'petugas', 'grafikHarian']);

        if ($request->tgl_perawatan) {
            $pemeriksaan->where('tgl_perawatan', $request->tgl_perawatan);
        }
        if ($request->jam_rawat) {
            $pemeriksaan->where('jam_rawat', $request->jam_rawat);
        }

        return response()->json($pemeriksaan->first(), 200);
    }

    public function ubah(Request $request)
    {
        $data = [
            'suhu_tubuh' => $request->suhu_tubuh,
            'nip' => $request->nip,
            'tinggi' => $request->tinggi,
            'berat' => $request->berat,
            'respirasi' => $request->respirasi,
            'nadi' => $request->nadi,
            'tensi' => $request->tensi,
            'spo2' => $request->spo2,
            'gcs' => $request->gcs,
            'alergi' => $request->alergi,
            'keluhan' => $request->keluhan,
            'pemeriksaan' => $request->pemeriksaan,
            'penilaian' => $request->penilaian,
            'rtl' => $request->rtl,
            'evaluasi' => '-',
            'instruksi' => $request->instruksi,
            'kesadaran' => $request->kesadaran,
        ];

        $data1 = [
            'nip' => $request->nip,
            'no_rawat' => $request->no_rawat,
            'suhu_tubuh' => $request->suhu_tubuh,
            'tensi' => $request->tensi,
            'respirasi' => $request->respirasi,
            'nadi' => $request->nadi,
            'spo2' => $request->spo2,
            'gcs' => $request->gcs,
            'kesadaran' => $request->kesadaran,
            'o2' => $request->o2,
            'sumber' => 'SOAP',
        ];


        $clause = [
            'no_rawat' => $request->no_rawat,
            'tgl_perawatan' => $request->tgl_perawatan,
            'jam_rawat' => $request->jam_rawat,
        ];


        $log = $this->log->insert($clause, 'Ubah');
        $pemeriksaan = PemeriksaanRanap::where($clause)->update($data);
        $grafikharian = GrafikHarian::where($clause)->update($data1);
        $this->track->updateSql($this->pemeriksaan, $data, $clause);
        $this->track->updateSql($this->grafikharian, $data1, $clause);
        return response()->json([$pemeriksaan, $grafikharian]);
    }

    public function simpan(Request $request)
    {
        $data = [
            'nip' => $request->nip,
            'no_rawat' => $request->no_rawat,
            'tgl_perawatan' => $this->tanggal->now()->toDateString(),
            'jam_rawat' => date('H:i:s'),
            'suhu_tubuh' => $request->suhu_tubuh,
            'tinggi' => $request->tinggi,
            'berat' => $request->berat,
            'tensi' => $request->tensi,
            'respirasi' => $request->respirasi,
            'nadi' => $request->nadi,
            'spo2' => $request->spo2,
            'gcs' => $request->gcs,
            'alergi' => $request->alergi,
            'keluhan' => $request->keluhan,
            'pemeriksaan' => $request->pemeriksaan,
            'penilaian' => $request->penilaian,
            'rtl' => $request->rtl,
            'evaluasi' => '-',
            'instruksi' => $request->instruksi,
            'kesadaran' => $request->kesadaran,
        ];

        $data1 = [
            'nip' => $request->nip,
            'no_rawat' => $request->no_rawat,
            'tgl_perawatan' => $this->tanggal->now()->toDateString(),
            'jam_rawat' => date('H:i:s'),
            'suhu_tubuh' => $request->suhu_tubuh,
            'tensi' => $request->tensi,
            'respirasi' => $request->respirasi,
            'nadi' => $request->nadi,
            'spo2' => $request->spo2,
            'gcs' => $request->gcs,
            'kesadaran' => $request->kesadaran,
            'o2' => $request->o2,
            'sumber' => 'SOAP',
        ];

        $pemeriksaan = PemeriksaanRanap::create($data);
        $grafikharian = GrafikHarian::create($data1);
        $this->track->insertSql($this->pemeriksaan, $data);
        $this->track->insertSql($this->grafikharian, $data);
        return response()->json(['Berhasil', $pemeriksaan, $grafikharian], 200);
    }
    public function hapus(Request $request)
    {
        $clause = [
            'no_rawat' => $request->no_rawat,
            'tgl_perawatan' => $request->tgl_perawatan,
            'jam_rawat' => $request->jam_rawat,
        ];
        $pemeriksaan = PemeriksaanRanap::where($clause)->delete();
        $this->track->deleteSql($this->pemeriksaan, $clause);

        $clause = array_merge($clause, ['sumber' => 'SOAP']);
        $log = $this->log->insert($clause, 'Hapus');
        $grafikHarian = $this->grafikHarian->where($clause)->delete();
        return response()->json(['Berhasil', $pemeriksaan], 200);
    }

    function ambilPemeriksaan(Request $request)
    {
        $pemeriksaan = PemeriksaanRanap::where('no_rawat', $request->no_rawat)
            ->with(['regPeriksa', 'log', 'regPeriksa.pasien', 'petugas', 'grafikHarian', 'verifikasi.petugas' => function ($q) {
                return $q->select('nip', 'nama');
            }])->whereHas('petugas', function ($q) {
                return $q->whereNotIn('kd_jbtn', ['J01', 'J024', 'J025', 'J002']);
            })
            ->orderBy('tgl_perawatan', 'DESC')
            ->orderBy('jam_rawat', 'DESC')->get();
        return $pemeriksaan;
    }
    public function ambil(Request $request)
    {

        $pemeriksaan = $this->pemeriksaan->where('no_rawat', $request->no_rawat)->with(['regPeriksa', 'regPeriksa.pasien', 'log.pegawai', 'petugas', 'grafikHarian', 'verifikasi.petugas' => function ($q) {
            return $q->select('nip', 'nama');
        }])->orderBy('tgl_perawatan', 'DESC')
            ->orderBy('jam_rawat', 'DESC');

        // if tanggal pertama and tanggal kedua is not empty string
        if ($request->tgl_pertama != '' && $request->tgl_kedua != '') {
            $pemeriksaan->whereBetween('tgl_perawatan', [$request->tgl_pertama, $request->tgl_kedua]);
        }

        if ($request->petugas == 1) {
            $pemeriksaan->whereHas('petugas', function ($q) use ($request) {
                return $q->whereIn('kd_jbtn', ['J01', 'J024', 'J025', 'J002']);
            });
        } else if ($request->petugas == 2) {
            $pemeriksaan->whereHas('petugas', function ($q) use ($request) {
                return $q->whereNotIn('kd_jbtn', ['J01', 'J024', 'J025', 'J002']);
            });
        }

        return DataTables::of($pemeriksaan->get())->make(true);
    }

    function getTTV(Request $request)
    {
        $id = str_replace('-', '/', $request->no_rawat);
        $data = $this->grafikHarian->where(['no_rawat' => $id])->get();

        // return json
        return $data;
    }

    function getTTVData(Request $request)
    {
        $id = str_replace('-', '/', $request->no_rawat);
        $data = $this->grafikHarian->where(['no_rawat' => $id, 'sumber' => '-'])->get();
        return DataTables::of($data)->make(true);
    }
    function get($noRawat)
    {
        $pemeriksaan = $this->pemeriksaan->where('no_rawat', $noRawat)->get();

        return $pemeriksaan;
    }
    function getParamTTV($noRawat, $param)
    {
        $pemeriksaan = $this->pemeriksaan->where('no_rawat', $noRawat)->select($param)->get();

        return $pemeriksaan;
    }
}
