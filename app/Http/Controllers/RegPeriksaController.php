<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pasien;
use App\Models\RegPeriksa;
use App\Models\EstimasiPoli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class RegPeriksaController extends Controller
{
    public $tanggal;
    public function __construct()
    {
        $this->tanggal = new Carbon();
    }
    public function index()
    {
        return view('content.registrasi.daftar');
    }

    function create(Request $request)
    {
        $data = [
            'no_reg' => $request->no_reg,
            'no_rawat' => $this->setNoRawat(),
            'tgl_registrasi' => date('Y-m-d'),
            'jam_reg' => date('H:i:s'),
            'kd_dokter' => $request->kd_dokter,
            'no_rkm_medis' => $request->no_rkm_medis,
            'kd_poli' => $request->kd_poli,
            'p_jawab' => $request->p_jawab,
            'almt_pj' => $request->alamat,
            'hubungabpj' => $request->hubungan,
            'biaya_reg' => 0,
            'stts' => 'Belum',
            'status_lanjut' => $request->status_lanjut,
            'kd_pj' => $request->kd_pj,
            'umurdaftar' => $request->umur,
            'sttsumur' => $request->sttsumur,
            'status_bayar' => 'Belum Bayar',
            'status_poli' => $request->status_poli,
        ];
        $regPeriksa = RegPeriksa::create($data);

        return response()->json(['metaData' => ['Status' => 'OK', 'Code' => 200], 'response' => $regPeriksa]);
    }
    function setNoRawat()
    {
        $regPeriksa = Regperiksa::select('no_rawat')->where('tgl_registrasi', date('Y-m-d'))->orderBy('no_rawat', 'DESC')->first();


        if ($regPeriksa) {
            $no = explode('/', $regPeriksa->no_rawat);
            $no = $no[3] + 1;
        } else {
            $no = 1;
        }
        $noRawat = date('Y/m/d') . '/' . sprintf('%06d', $no);
        return $noRawat;
    }
    function setNoReg($kd_poli, $kd_dokter)
    {
        $regPeriksa = Regperiksa::select('no_reg')->where('tgl_registrasi', date('Y-m-d'))
            ->where('kd_poli', $kd_poli)
            ->where('kd_dokter', $kd_dokter)->orderBy('no_reg', 'DESC')->first();
        if ($regPeriksa) {
            $noReg = $regPeriksa->no_reg + 1;
        } else {
            $noReg = 1;
        }
        return sprintf('%03d', $noReg);
    }
    public function show($no_rkm_medis)
    {
        $regPeriksa = RegPeriksa::where('no_rkm_medis', $no_rkm_medis)
            ->with('upload')
            ->orderBy('tgl_registrasi', 'DESC')
            ->get();
        return response()->json($regPeriksa);
    }
    public function detailPeriksa(Request $request)
    {
        $regPeriksa = RegPeriksa::where('no_rawat', $request->no_rawat)
            ->with('kamarInap', function ($q) {
                $q->where('stts_pulang', '!=', 'Pindah Kamar');
            })
            ->with('pasien')
            ->first();
        return response()->json($regPeriksa);
    }
    public function riwayat(Request $request)
    {
        $pemeriksaan = Pasien::where('no_rkm_medis', $request->no_rkm_medis)
            ->with('regPeriksa', function ($q) use ($request) {
                return $q->where(function ($q) {
                    $q->where('stts', 'Sudah')->orWhere('status_lanjut', '=', 'Ranap');
                })->with(['upload', 'resepObat' => function ($q) {
                    return $q->with('resepDokter', 'resepRacikan');
                }, 'poliklinik', 'dokter', 'penjab', 'pemeriksaanRalan', 'catatanPerawatan', 'diagnosaPasien' => function ($q) {
                    return $q->with('penyakit')->orderBy('prioritas', 'ASC');
                }, 'prosedurPasien' => function ($q) {
                    return $q->with('icd9');
                }, 'detailPemberianObat' => function ($q) {
                    return $q->with(['aturanPakai', 'dataBarang' => function ($q) {
                        $q->with('kodeSatuan');
                    }]);
                }, 'detailPemeriksaanLab' => function ($q) {
                    $q->with(['jnsPerawatanLab', 'template'])->orderBy('tgl_periksa', 'ASC');
                }, 'kamarInap'])->orderBy('tgl_registrasi', $request->sortir);
            })
            ->first();

        return response()->json($pemeriksaan);
    }


    public function statusDaftar($no_rawat, $status)
    {
        $status = RegPeriksa::where('no_rawat', $no_rawat)->update([
            'stts' => $status
        ]);
    }

    public function ambil(Request $request)
    {
        if ($request->no_rawat) {
            $regPeriksa = RegPeriksa::where('no_rawat', $request->no_rawat)->with('pasien', 'dokter.spesialis', 'kamarInap.kamar.bangsal', 'suratKontrol', 'poliklinik')->first();
        } else {
            $regPeriksa = RegPeriksa::where('tgl_registrasi', $request->tgl_registrasi)->where('status_lanjut', 'Ralan')->with('pasien', 'penjab', 'dokter.spesialis', 'poliklinik', 'suratKontrol')->get();
        }
        return response()->json($regPeriksa);
    }

    public function statusDiterima(Request $request)
    {
        $regPeriksa = RegPeriksa::where('tgl_registrasi', $this->tanggal->now()->toDateString())
            ->where('kd_poli', $request->kd_poli)
            ->where('kd_dokter', $request->kd_dokter)
            ->where(function ($q) {
                $q->where('stts', 'Berkas Diterima')->orWhere('stts', 'Periksa');
            })->count();

        return $regPeriksa;
    }
    public function hitungSelesai(Request $request)
    {
        $regPeriksa = RegPeriksa::where('tgl_registrasi', $this->tanggal->now()->toDateString())
            ->where('kd_poli', $request->kd_poli)
            ->where('kd_dokter', $request->kd_dokter)
            ->where('stts', 'Sudah')->count();

        return $regPeriksa;
    }
    public function hitungBatal(Request $request)
    {
        $regPeriksa = RegPeriksa::where('tgl_registrasi', $this->tanggal->now()->toDateString())
            ->where('kd_poli', $request->kd_poli)
            ->where('kd_dokter', $request->kd_dokter)
            ->where('stts', 'Batal')->count();

        return $regPeriksa;
    }
    public function hitungTunggu(Request $request)
    {
        $regPeriksa = RegPeriksa::where('tgl_registrasi', $this->tanggal->now()->toDateString())
            ->where('kd_poli', $request->kd_poli)
            ->where('kd_dokter', $request->kd_dokter)
            ->where('stts', 'Belum')->count();

        return $regPeriksa;
    }

    public function status(Request $request)
    {
        $regPeriksa = DB::table('reg_periksa')
            ->select('stts', DB::raw('count(*) as jumlah'))
            ->groupBy('stts')
            ->where('tgl_registrasi', $this->tanggal->now()->toDateString())
            ->where('kd_poli', $request->kd_poli)
            ->where('kd_dokter', $request->kd_dokter)
            ->get();
        return response()->json($regPeriksa, 200);
    }
    public function ambilTable(Request $request)
    {
        $regPeriksa = RegPeriksa::where('tgl_registrasi', date('Y-m-d'))
            ->with('pasien', 'penjab', 'dokter.spesialis', 'poliklinik', 'generalConsent.pegawai', 'sep')->orderBy('no_rawat', 'DESC')->get();
        return DataTables::of($regPeriksa)->make(true);
    }
    public function ubahDpjp(Request $request)
    {
        $dokterDpjp = RegPeriksa::where('no_rawat', $request->no_rawat)->update(['kd_dokter' => $request->dokter]);

        return response()->json($dokterDpjp, 200);
    }
}
