<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Dokter;
use App\Models\Poliklinik;
use App\Models\RegPeriksa;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\MappingPoliklinik;
use App\Models\PemeriksaanRalan;
use App\Models\Upload;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isEmpty;

class PoliklinikController extends Controller
{

    protected $dokter;
    public function __construct()
    {
        $this->dokter = new DokterController();
    }
    public function index()
    {
        $poliklinik = $this->poliDokter();
        return view('content.poliklinik.poliklinik', [
            'data' => $poliklinik,
            'umum' => $this->dokter->ambilUmum(),
        ]);
    }
    public function poliDokter()
    {
        return $poliklinik = MappingPoliklinik::with([
            'dokter',
            'poliklinik',
        ])->whereHas('jadwal')->get();
    }
    public function poliPasien($kd_poli = '', $kd_dokter = '', $tgl_registrasi)
    {
        $tanggal = new Carbon();

        $sekarang = $tanggal->now()->toDateString();
        $pasienPoli = RegPeriksa::select(['no_rawat', 'stts', 'kd_pj', 'tgl_registrasi', 'jam_reg', 'no_reg',
            DB::raw('TRIM(no_rkm_medis) as no_rkm_medis'),
            DB::raw('TRIM(kd_dokter) as kd_dokter'),
            DB::raw('TRIM(kd_poli) as kd_poli'),
        ])
            ->with([
                'pasien' => function ($query) {
                    $query->with(['askepRalanAnak', 'askepRalanKebidanan']);
        },'pasien.regPeriksa.askepRalanAnak', 'pasien.regPeriksa.askepRalanKebidanan', 'dokter.mappingDokter', 'penjab','skriningTb' , 'upload', 'pemeriksaanRalan', 'sep.suratKontrol', 'suratKontrol', 'sep.rujukanKeluar', 'pasien.spri' => function ($q) use ($tgl_registrasi) {
            return $q->where('tgl_surat', $tgl_registrasi);
        }])
            ->whereNotIn('kd_poli', ['OPE', 'IGDK', '-', 'U0016', 'LAB'])
            ->where('kd_poli', $kd_poli)
            ->orderBy('no_reg', 'ASC');

        $pasienPoli = $kd_dokter ? $pasienPoli->where('kd_dokter', $kd_dokter) : $pasienPoli;
        $pasienPoli = $tgl_registrasi ? $pasienPoli->where('tgl_registrasi', $tgl_registrasi) : $pasienPoli->where('tgl_registrasi', $tgl_registrasi);

        return $pasienPoli;
    }
    public function jumlahPasienPoli(Request $request)
    {
        return $this->poliPasien($request->kd_poli, $request->kd_dokter, $request->tgl_registrasi)->count();
    }

    public function namaPoli($kd_poli = '')
    {
        return $poliklinik = Poliklinik::where('status', '1')
            ->where('kd_poli', $kd_poli)
            ->first();
    }

    public function pasienPoliUpload()
    {
        // return $regPeriksa = RegPeriksa::
    }
    public function dokterPoli($kd_dokter = '')
    {
        if ($kd_dokter) {
            $dokter = Dokter::where('kd_dokter', $kd_dokter)->first();
        } else {
            $dokter = Dokter::where('status', '1')->get();
        }
        return $dokter;
    }
    public function viewPoliPasien($kd_poli, Request $request)
    {
        $kd_dokter = $request->dokter ? $request->dokter : '';
        $tgl_registrasi = $request->tgl_registrasi ? $request->tgl_registrasi : '';
        $pasien = $this->poliPasien($kd_poli, $kd_dokter, $tgl_registrasi);
        $poliklinik = $this->namaPoli($kd_poli);
        $dokter = $this->dokterPoli($request->dokter);
        $jmlUpload = 0;
        foreach ($pasien as $p) {
            $jmlUpload = $jmlUpload + $p->upload_count;
        }
        return view('content.poliklinik.pasien', [
            'pasien' => $pasien->get(),
            'jumlah' => $pasien->count(),
            'poli' => $poliklinik,
            'dokter' => $dokter,
            'uploaded' => $jmlUpload,
        ]);
    }
    public function countUpload($kd_poli, Request $request)
    {
        $pasien = $this->poliPasien($kd_poli, $request->dokter, $request->tgl_registrasi)->withCount('upload')->get();
        $jmlUpload = 0;
        foreach ($pasien as $p) {
            $jmlUpload = $jmlUpload + $p->upload_count;
        }
        return $jmlUpload;
    }
    public function tbPoliPasien(Request $request)
    {

        $pasien = $this->poliPasien($request->kd_poli, $request->kd_dokter, $request->tgl_registrasi);
        if ($request->pasien) {
            $pasien->whereHas('pasien', function ($query) use ($request) {
                $query->where('nm_pasien', 'like', '%' . $request->pasien . '%');
            });
        }
        if ($request->pembiayaan) {
            $pasien->whereHas('penjab', function ($query) use ($request) {
                $query->where('png_jawab', 'like', '%' . $request->pembiayaan . '%');
            });
        }
        if ($request->status_periksa) {
            $pasien->where('stts', $request->status_periksa);
        }

        return DataTables::of($pasien)
            ->filter(function ($query) use ($request) {
                if ($request->has('search') && $request->get('search')['value']) {
                    return $query->whereHas('pasien', function ($query) use ($request) {
                        $query->where('nm_pasien', 'like', '%' . $request->get('search')['value'] . '%');
                    });
                }
            })->make(true);
    }

    public function statusUpload(Request $request)
    {
        $upload = Upload::where('no_rawat', $request->no_rawat)
            ->get()->count();
        return response()->json($upload);
    }
    public function statusSoap(Request $request)
    {
        $status = PemeriksaanRalan::where('no_rawat', $request->no_rawat)
            ->get()->count();
        return response()->json($status);
    }
}
