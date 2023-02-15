<?php

namespace App\Http\Controllers;

use App\Models\PemeriksaanRanap;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PemeriksaanRanapController extends Controller
{
    private $tanggal;
    public function __construct()
    {
        $this->tanggal = new Carbon();
    }

    public function ambilSatu(Request $request)
    {
        $pemeriksaan = PemeriksaanRanap::where('no_rawat', $request->no_rawat)
            ->with(['regPeriksa', 'regPeriksa.pasien', 'petugas']);

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
            'evaluasi' => $request->evaluasi,
            'instruksi' => $request->instruksi,
        ];
        $pemeriksaan = PemeriksaanRanap::where('no_rawat', $request->no_rawat)
            ->where('tgl_perawatan', $request->tgl_perawatan)
            ->where('jam_rawat', $request->jam_rawat)
            ->update(
                $data
            );
        return response()->json($pemeriksaan);
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
            'evaluasi' => $request->evaluasi,
            'instruksi' => $request->instruksi,
        ];
        $pemeriksaan = PemeriksaanRanap::create($data);

        return response()->json(['Berhasil', $pemeriksaan], 200);
    }
    public function hapus(Request $request)
    {
        $pemeriksaan = PemeriksaanRanap::where('no_rawat', $request->no_rawat)
            ->where('tgl_perawatan', $request->tgl_perawatan)
            ->where('jam_rawat', $request->jam_rawat)->delete();

        return response()->json(['Berhasil', $pemeriksaan], 200);
    }
    public function ambil(Request $request)
    {
        $pemeriksaan = PemeriksaanRanap::where('no_rawat', $request->no_rawat)
            ->with(['regPeriksa', 'regPeriksa.pasien', 'petugas'])->orderBy('tgl_perawatan', 'DESC')
            ->orderBy('jam_rawat', 'DESC');

        if ($request->tgl_pertama && $request->tgl_kedua) {
            $pemeriksaan->whereBetween('tgl_perawatan', [$request->tgl_pertama, $request->tgl_kedua]);
        } else {
            $pemeriksaan->where('tgl_perawatan', $this->tanggal->now()->toDateString());
        }

        // return response()->json($pemeriksaan->get());

        return DataTables::of($pemeriksaan)->make(true);
    }
}
