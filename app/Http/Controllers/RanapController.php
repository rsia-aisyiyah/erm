<?php

namespace App\Http\Controllers;

use App\Models\KamarInap;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class RanapController extends Controller
{
    public $tanggal;

    public function __construct()
    {
        $this->tanggal = new Carbon();
    }

    public function index()
    {
        return view('content.ranap.ranap');
    }

    public function ranap(Request $request)
    {

        $ranap = KamarInap::with(['regPeriksa.poc', 'edukasiObatPulang', 'regPeriksa' => function($q){
            $q->select(
                DB::raw('TRIM(kd_dokter) as kd_dokter'),
                DB::raw('TRIM(no_rkm_medis) as no_rkm_medis'),
                DB::raw('TRIM(kd_poli) as kd_poli'),
                DB::raw('TRIM(kd_pj) as kd_pj'),
                'no_rawat', 'umurdaftar', 'sttsumur', 'no_reg', 'tgl_registrasi'
            )->with(['pasien', 'dokter' => function ($q) {
                $q->with(['spesialis']);
            }, 'penjab', 'kamarInap']);
        }, 'kamar', 'ranapGabung.regPeriksa.dokter', 'ranapGabung.regPeriksa.pasien', 'ranapGabung.regPeriksa.askepRanapNeonatus', 'ranapGabung.regPeriksa.asmedRanapAnak', 'kamar.bangsal', 'regPeriksa.asmedRanapKandungan', 'regPeriksa.asmedRanapAnak', 'regPeriksa.askepRanapNeonatus', 'regPeriksa.askepRanapAnak', 'regPeriksa.askepRanapKandungan', 'resume', 'skoringTb', 'skriningTb'])->orderBy('no_rawat', 'DESC');

        if ($request->stts_pulang == '-') {
            $ranap->where('stts_pulang', $request->stts_pulang);
        } else if ($request->stts_pulang == 'Masuk') {
            $ranap->whereBetween('tgl_masuk', [$request->tgl_pertama, $request->tgl_kedua]);
        } else if ($request->stts_pulang == 'Pulang') {
            $ranap->whereBetween('tgl_keluar', [$request->tgl_pertama, $request->tgl_kedua]);
        }

        if ($request->kd_dokter) {
            $ranap->whereHas('regPeriksa', function ($q) use ($request) {
                $q->where('kd_dokter', $request->kd_dokter);
            });
        }

        if ($request->spesialis) {
            $ranap->whereHas('regPeriksa.dokter', function ($q) use ($request) {
                $q->where('kd_sps', $request->spesialis);
            });
        }

        if ($request->kamar) {
            $ranap->whereHas('kamar.bangsal', function ($q) use ($request) {
                $q->where('nm_bangsal', 'like', '%' . $request->kamar . '%');
            });
        }

        return DataTables::of($ranap)
            ->filter(function ($query) use ($request) {
                if ($request->has('search') && $request->get('search')['value']) {
                    return $query->whereHas('regPeriksa.pasien', function ($query) use ($request) {
                        $query->where('nm_pasien', 'like', '%' . $request->get('search')['value'] . '%');
                    });
                }
            })
            ->addColumn('lama', function ($ranap) {
                $date1 = $ranap->regPeriksa->tgl_registrasi; // Adjust this to your date columns
                $date2 = $ranap->tgl_keluar === '0000-00-00' ? date('Y-m-d') : $ranap->tgl_keluar; // Adjust this to your date columns
                return Carbon::parse($date1)->diffInDays($date2) + 1;
                // return $date1->diffInDays($date2);
            })
            ->make(true);
    }
}
