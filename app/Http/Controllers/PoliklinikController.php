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
        ])->get();
    }
    public function poliPasien($kd_poli, $kd_dokter, $tgl_registrasi)
    {
        $tanggal = new Carbon();

        $sekarang = $tanggal->now()->toDateString();
        $pasienPoli = RegPeriksa::with(['pasien.regPeriksa.askepRalanAnak', 'pasien.regPeriksa.askepRalanKebidanan', 'dokter', 'penjab', 'upload', 'pemeriksaanRalan', 'sep'])
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
        $pasien = $this->poliPasien($request->kd_poli, $request->dokter, $request->tgl_registrasi);

        return DataTables::of($pasien)->make(true);
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
