<?php

namespace App\Http\Controllers;

use App\Models\EstimasiPoli;
use App\Models\ResepObat;
use App\Traits\ResponseTrait;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class EstimasiPoliController extends Controller
{
    // public $regPeriksa = app('App\Http\Controllers\RegPeriksaController')->status();
    private $tanggal;
    private $tracker;
    use ResponseTrait;
    public function __construct()
    {
        $this->tanggal = new Carbon();
        $this->tracker = new TrackerSqlController();
    }
    public function cari($no_rawat)
    {
        $estimasi = EstimasiPoli::where('no_rawat', $no_rawat)->first();
        return $estimasi;
    }

    public function get(Request $request)
    {
        $no_rawat = $request->no_rawat;
        $estimasi = EstimasiPoli::where('no_rawat', $no_rawat)->first();
        return $estimasi;
    }
    public function catatEstimasiAwal(Request $request)
    {
        $no_rawat = $request->no_rawat;
        if (!$no_rawat) {
            return response()->json(['message' => 'no_rawat required'], 400);
        }

        $getEstimasi = $this->get($request);
        if ($getEstimasi) {
            return response()->json(['no_rawat' => $no_rawat, 'jam_periksa' => $getEstimasi->jam_periksa, 'status' => 'already_exists'], 200);
        }

        // Pastikan Task 3 (pemeriksaan ralan awal perawat) sudah ada
        $pemeriksaan = \App\Models\PemeriksaanRalan::where('no_rawat', $no_rawat)->first();
        if (!$pemeriksaan) {
            return response()->json(['message' => 'Pemeriksaan ralan awal belum ada', 'status' => 'no_task3'], 200);
        }

        $jam_periksa = $this->tanggal->now()->toDateTimeString();
        $data = [
            'no_rawat' => $no_rawat,
            'jam_periksa' => $jam_periksa,
        ];

        try {
            DB::transaction(function () use ($data) {
                $estimasi = EstimasiPoli::create($data);
                if ($estimasi) {
                    $this->tracker->insertSql(new EstimasiPoli(), $data);
                }
            });
        } catch (QueryException $th) {
            return $this->errorResponse($th, $th->getMessage(), 500);
        }

        return response()->json(['no_rawat' => $no_rawat, 'jam_periksa' => $jam_periksa, 'status' => 'created'], 200);
    }

    public function kirim(Request $request)
    {
        $no_rawat = $request->no_rawat;
        $getEstimasi = $this->get($request);
        $regPeriksa = new RegPeriksaController();

        // Selalu pastikan status registrasi diubah ke 'Berkas Diterima' saat tombol PANGGIL ditekan
        $regPeriksa->statusDaftar($no_rawat, 'Berkas Diterima');

        if ($getEstimasi) {
            return response()->json(['no_rawat' => $no_rawat, 'jam_periksa' => $getEstimasi->jam_periksa], 200);
        }

        $jam_periksa = $this->tanggal->now()->toDateTimeString();

        // Safety Guard: Cek jika resep sudah dibuat sebelum tombol PANGGIL diklik
        $resep = ResepObat::where('no_rawat', $no_rawat)
            ->where('tgl_peresepan', '!=', '0000-00-00')
            ->orderBy('no_resep', 'desc')
            ->first();

        if ($resep && !empty($resep->jam_peresepan) && $resep->jam_peresepan !== '00:00:00') {
            $waktuResep = Carbon::parse($resep->tgl_peresepan . ' ' . $resep->jam_peresepan);
            $waktuSekarang = Carbon::now();
            if ($waktuSekarang->gte($waktuResep)) {
                $pemeriksaan = \App\Models\PemeriksaanRalan::where('no_rawat', $no_rawat)->first();
                if ($pemeriksaan && !empty($pemeriksaan->jam_rawat)) {
                    $waktuTask3 = Carbon::parse($pemeriksaan->tgl_perawatan . ' ' . $pemeriksaan->jam_rawat);
                    $estimasiWaktu = $waktuResep->copy()->subMinutes(5);
                    if ($estimasiWaktu->lte($waktuTask3)) {
                        $jam_periksa = $waktuTask3->copy()->addMinutes(1)->toDateTimeString();
                    } else {
                        $jam_periksa = $estimasiWaktu->toDateTimeString();
                    }
                } else {
                    $jam_periksa = $waktuResep->copy()->subMinutes(5)->toDateTimeString();
                }
            }
        }

        $data = [
            'no_rawat' => $no_rawat,
            'jam_periksa' => $jam_periksa,
        ];

        try {
            DB::transaction(function () use ($data) {
                $estimasi = EstimasiPoli::create($data);
                if ($estimasi) {
                    $this->tracker->insertSql(new EstimasiPoli(), $data);
                }
            });

        } catch (QueryException $th) {
            return $this->errorResponse($th, $th->getMessage(), 500);
        }
        return response()->json(['no_rawat' => $no_rawat, 'jam_periksa' => $jam_periksa], 200);

    }
    public function hapus(Request $request)
    {
        $no_rawat = $request->no_rawat;
        $estimasi = EstimasiPoli::where('no_rawat', $no_rawat);


        $resep = new ResepObat();

        // TODO: check apakah kosong
        $isResepExist = $resep->where('no_rawat', $no_rawat)->first();

        if ($isResepExist) {
            return response()->json('Resep Obat Masih Ada', 400);
        }


        if ($isResepExist) {
            return response()->json('Resep Obat Masih Ada', 400);
        }

        if ($estimasi) {
            $isDelete = $estimasi->delete();
            if ($isDelete) {
                $this->tracker->deleteSql(new EstimasiPoli(), ['no_rawat' => $no_rawat]);
            }

            app('App\Http\Controllers\RegPeriksaController')->statusDaftar($no_rawat, 'Belum');
            $response = response()->json(['pesan' => 'Batal Panggil Pasien', 'no_rawat' => $no_rawat], 200);
        } else {
            $response = response()->json('Nomor Rawat Tidak Ditemukan', 400);
        }

        return $response;
    }
}
