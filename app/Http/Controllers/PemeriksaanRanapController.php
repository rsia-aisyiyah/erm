<?php

namespace App\Http\Controllers;

use App\Models\GrafikHarian;
use App\Models\PemeriksaanRanap;
use App\Models\RsiaGrafikHarian;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PemeriksaanRanapController extends Controller
{
    private $tanggal;
    private $pemeriksaan;
    private $grafikharian;
    private $track;
    private $grafikHarian;

    public function __construct()
    {
        $this->tanggal = new Carbon();
        $this->pemeriksaan = new PemeriksaanRanap();
        $this->grafikharian = new GrafikHarian();
        $this->track = new TrackerSqlController();
        $this->grafikHarian = new RsiaGrafikHarian();
    }

    public function ambilSatu(Request $request)
    {
        $pemeriksaan = PemeriksaanRanap::where('no_rawat', $request->no_rawat)
            ->with(['regPeriksa', 'regPeriksa.pasien', 'petugas','grafikHarian']);

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
        $pemeriksaan = PemeriksaanRanap::where($clause)->update($data);
        $grafikharian = GrafikHarian::where($clause)->update($data1);
        $this->track->create($this->track->updateSql($this->pemeriksaan, $data, $clause));
        $this->track->create($this->track->updateSql($this->grafikharian, $data1, $clause));
        return response()->json([$pemeriksaan,$grafikharian]);
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
        $this->track->create($this->track->insertSql($this->pemeriksaan, $data));
        $this->track->create($this->track->insertSql($this->grafikharian, $data));
        return response()->json(['Berhasil', $pemeriksaan,$grafikharian], 200);
    }
    public function hapus(Request $request)
    {
        $clause = [
            'no_rawat' => $request->no_rawat,
            'tgl_perawatan' => $request->tgl_perawatan,
            'jam_rawat' => $request->jam_rawat,
        ];
        $pemeriksaan = PemeriksaanRanap::where($clause)->delete();
        $this->track->create($this->track->deleteSql($this->pemeriksaan, $clause));
        return response()->json(['Berhasil', $pemeriksaan], 200);
    }
    public function ambil(Request $request)
    {
        $pemeriksaan = PemeriksaanRanap::where('no_rawat', $request->no_rawat)
            ->with(['regPeriksa', 'regPeriksa.pasien', 'petugas','grafikHarian'])->orderBy('tgl_perawatan', 'DESC')
            ->orderBy('jam_rawat', 'DESC');

        if ($request->tgl_pertama && $request->tgl_kedua) {
            $pemeriksaan->whereBetween('tgl_perawatan', [$request->tgl_pertama, $request->tgl_kedua]);
        } else {
            $pemeriksaan->where('tgl_perawatan', $this->tanggal->now()->toDateString());
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

        return DataTables::of($pemeriksaan)->make(true);
    }

    function getTTV(Request $request)
    {
        $id = str_replace('-', '/', $request->no_rawat);
        $data = $this->grafikHarian->select('tgl_perawatan', 'jam_rawat', 'suhu_tubuh', 'tensi', 'nadi', 'respirasi', 'spo2', 'o2', 'gcs', 'kesadaran', 'sumber', 'nip')->where(['no_rawat' => $id])->get();

        // return json
        return $data;
    }
}
