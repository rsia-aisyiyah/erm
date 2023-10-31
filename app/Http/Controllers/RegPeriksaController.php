<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pasien;
use App\Models\RegPeriksa;
use App\Models\EstimasiPoli;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class RegPeriksaController extends Controller
{
    public $tanggal;
    public $track;
    public $regPeriksa;
    public function __construct()
    {
        $this->tanggal = new Carbon();
        $this->track = new TrackerSqlController();
        $this->regPeriksa = new RegPeriksa();
    }
    public function index()
    {
        return view('content.registrasi.daftar');
    }

    function create(Request $request)
    {
        $data = [
            'no_reg' => $request->no_reg,
            'no_rawat' => $this->setNoRawat($request->tgl_registrasi),
            'tgl_registrasi' => $request->tgl_registrasi,
            'jam_reg' => date('H:i:s'),
            'kd_dokter' => $request->kd_dokter,
            'no_rkm_medis' => $request->no_rkm_medis,
            'kd_poli' => $request->kd_poli,
            'p_jawab' => $request->p_jawab,
            'almt_pj' => $request->almt_pj,
            'hubunganpj' => $request->hubungan,
            'biaya_reg' => 0,
            'stts' => 'Belum',
            'status_lanjut' => $request->status_lanjut,
            'kd_pj' => $request->kd_pj,
            'umurdaftar' => $request->umurdaftar,
            'sttsumur' => $request->sttsumur,
            'status_bayar' => 'Belum Bayar',
            'status_poli' => $request->status_poli,
            'stts_daftar' => $request->stts_daftar,
        ];
        try {

            $result = $this->regPeriksa->create($data);
            $track = $this->track->insertSql($this->regPeriksa, $data);
            return response()->json(['metaData' => ['Status' => 'OK', 'Code' => 200], 'response' => $result, 'qury' => $track]);
        } catch (QueryException $e) {
            return response()->json(['metaData' => ['Status' => 'FAILED', 'Code' => 400], 'response' => $e->errorInfo]);
        }
    }
    function setNoRawat($tanggal)
    {

        $regPeriksa = RegPeriksa::where('tgl_registrasi', $tanggal)->orderBy('no_rawat', 'DESC')->first();

        $tanggal = str_replace('-', '/', $tanggal);
        if ($regPeriksa) {
            $no = explode('/', $regPeriksa->no_rawat);
            $no = $no[3] + 1;
            $noRawat = $tanggal . '/' . sprintf('%06d', $no);
        } else {
            $no = 1;
            $noRawat = $tanggal . '/' . sprintf('%06d', $no);
        }
        return $noRawat;
    }
    function setNoReg($tanggal, $kd_poli, $kd_dokter)
    {
        $regPeriksa = Regperiksa::select('no_reg')->where('tgl_registrasi', $tanggal)
            ->where('kd_poli', $kd_poli)
            ->where('kd_dokter', $kd_dokter)->orderBy('no_reg', 'DESC')->first();

        if ($regPeriksa) {
            $noReg = $regPeriksa->no_reg + 1;
        } else {
            $noReg = 1;
        }
        return sprintf('%03d', $noReg);
    }
    public function show($no_rkm_medis, $tanggal = '')
    {
        $data = $tanggal ? ['no_rkm_medis' => $no_rkm_medis, 'tgl_registrasi' => $tanggal] : ['no_rkm_medis' => $no_rkm_medis];
        $regPeriksa = RegPeriksa::where($data)
            ->with(['upload', 'pasien'])
            ->orderBy('tgl_registrasi', 'DESC')
            ->get();
        return response()->json($regPeriksa);
    }
    public function detailPeriksa(Request $request)
    {
        $regPeriksa = RegPeriksa::where('no_rawat', $request->no_rawat)
            ->with('kamarInap', function ($q) {
                return $q->where('stts_pulang', '!=', 'Pindah Kamar')->with('kamar.bangsal');
            })
            ->with('pasien.bahasa', 'dokter', 'dokter.spesialis', 'penjab', 'diagnosaPasien.penyakit', 'bayiGabung.kamarInap.kamar.bangsal')
            ->first();
        return response()->json($regPeriksa);
    }
    public function riwayat(Request $request)
    {
        $pemeriksaan = Pasien::where('no_rkm_medis', $request->no_rkm_medis)
            ->with('regPeriksa', function ($q) use ($request) {
                return $q->where(function ($q) {
                    $q->where('stts', '!=', 'Belum')->orWhere('status_lanjut', '=', 'Ranap');
                })->with([
                    'upload', 'resepObat' => function ($q) {
                        return $q->with('resepDokter', 'resepRacikan');
                    }, 'poliklinik', 'dokter', 'penjab', 'pemeriksaanRalan.pegawai', 'pemeriksaanRanap.pegawai',
                    'catatanPerawatan', 'diagnosaPasien' => function ($q) {
                        return $q->with('penyakit')->orderBy('prioritas', 'ASC');
                    }, 'prosedurPasien' => function ($q) {
                        return $q->with('icd9');
                    }, 'detailPemberianObat' => function ($q) {
                        return $q->with(['aturanPakai', 'dataBarang' => function ($q) {
                            $q->with('kodeSatuan');
                        }]);
                    }, 'detailPemeriksaanLab' => function ($q) {
                        $q->with(['jnsPerawatanLab', 'template'])->orderBy('tgl_periksa', 'ASC');
                    }, 'kamarInap', 'operasi.paketOperasi', 'operasi.op1', 'operasi.asistenOp1', 'operasi.asistenOp2',
                    'operasi.omloop', 'resumeMedis.regPeriksa.penjab', 'resumeMedis.dokter', 'resumeMedis.kamarInap' => function ($query) {
                        return $query->where('stts_pulang', '!=', 'Pindah Kamar')->with('kamar.bangsal');
                    },
                    'resumeMedis.bayiGabung.kamarInap.kamar.bangsal', 'asmedRanapAnak.regPeriksa.pasien', 'asmedRanapAnak.dokter', 'asmedRanapKandungan.regPeriksa.pasien',
                    'asmedRanapKandungan.dokter', 'periksaRadiologi.hasilRadiologi', 'periksaRadiologi.gambarRadiologi', 'periksaRadiologi.dokterRujuk', 'periksaRadiologi.petugas', 'periksaRadiologi.permintaanRadiologi', 'periksaRadiologi.dokter', 'periksaRadiologi.jnsPerawatan', 'periksaRadiologi.hasilRadiologi'
                ])->orderBy('no_rawat', $request->sortir);
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
            $regPeriksa = RegPeriksa::where('no_rawat', $request->no_rawat)->with('pasien', 'dokter.spesialis', 'kamarInap.kamar.bangsal', 'suratKontrol', 'poliklinik', 'suratKontrol')->first();
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
            ->with('pasien', 'penjab', 'dokter.spesialis', 'poliklinik', 'generalConsent.pegawai', 'sep', 'suratKontrol')->orderBy('no_rawat', 'DESC')->get();
        return DataTables::of($regPeriksa)->make(true);
    }
    public function ubahDpjp(Request $request)
    {
        $dokterDpjp = RegPeriksa::where('no_rawat', $request->no_rawat)->update(['kd_dokter' => $request->dokter]);

        return response()->json($dokterDpjp, 200);
    }
    function get($noRawat)
    {
        $regPeriksa = $this->regPeriksa->where('no_rawat', $noRawat)->first();
        return $regPeriksa;
    }
}
