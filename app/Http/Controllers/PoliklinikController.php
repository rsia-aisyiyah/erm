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
    public function index()
    {
        $poliklinik = $this->poliDokter();
        return view('content.poliklinik.poliklinik', [
            'data' => $poliklinik,
        ]);
    }
    public function poliDokter()
    {
        return $poliklinik = MappingPoliklinik::with([
            'dokter',
            'poliklinik',
        ])->get();
    }
    public function poliPasien($kd_poli, $kd_dokter)
    {
        $tanggal = new Carbon();

        $sekarang = $tanggal->now()->toDateString();
        return $pasienPoli = RegPeriksa::where('tgl_registrasi', $tanggal->now()->toDateString())
            ->with(['pasien', 'dokter'])
            ->where('kd_poli', $kd_poli)
            ->where('kd_dokter', $kd_dokter)->orderBy('no_reg', 'ASC');

        // return response()->json($pasienPoli);
    }
    public function jumlahPasienPoli(Request $request)
    {
        return $this->poliPasien($request->kd_poli, $request->kd_dokter)->count();
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
        $pasien = $this->poliPasien($kd_poli, $request->dokter);
        $poliklinik = $this->namaPoli($kd_poli);
        $dokter = $this->dokterPoli($request->dokter);
        $jmlUpload = 0;
        foreach ($pasien as $p) {
            $jmlUpload = $jmlUpload + $p->upload_count;
        }

        // return $jmlUpload;
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
        $pasien = $this->poliPasien($kd_poli, $request->dokter)->withCount('upload')->get();
        $jmlUpload = 0;
        foreach ($pasien as $p) {
            $jmlUpload = $jmlUpload + $p->upload_count;
        }
        return $jmlUpload;
    }
    public function tbPoliPasien($kd_poli, Request $request)
    {
        $pasien = $this->poliPasien($kd_poli, $request->dokter);

        return DataTables::of($pasien)
            ->editColumn('nm_pasien', function ($q) {
                if (
                    $q->kd_pj == 'A01' ||
                    $q->kd_pj == 'A05'
                ) {
                    $classText = 'text-success';
                } else {
                    $classText = 'text-danger';
                }
                if ($q->pasien) {
                    $pasien = $q->pasien->nm_pasien;
                } else {
                    $pasien = '-';
                }
                return '<h5>' . $q->no_reg . '</h5>' . $pasien . ' <br/> (' . $q->no_rawat . ') <br/><strong class="h6 ' . $classText . '"><i>' . $q->penjab->png_jawab . '</i></strong>';
            })
            ->addColumn('aksi', function ($q) {
                if ($q->stts == 'Batal') {
                    return '<h3 class="text-danger" align="center"><i class="bi bi-x-circle-fill"></i></h3>';
                } else if ($q->stts == 'Sudah') {
                    return '<h3 class="text-success" align="center"><i class="bi bi-check-circle-fill"></i></h3>';
                } else {
                    if ($q->stts == 'Berkas Diterima' || $q->stts == 'Periksa') {
                        $classPanggil = "btn btn-dark btn-sm mb-2 periksa-" . $q->no_reg;
                        $textPanggil = "RE-CALL";
                        $stylePanggil = "width: 80px; background-color: rgb(152, 0, 175); border-color: rgb(142, 6, 163);";
                        $classSelesai = "btn btn-warning btn-sm mb-2 selesai-" . $q->no_reg;
                        $styleSelesai = "width:80px";
                        $classBatal = "btn btn-danger btn-sm mb-2 batal-" . $q->no_reg;
                        $styleBatal = "width:80px";
                        $disable = '';
                        $disablePanggil = '';
                    } else {
                        $classPanggil = "btn btn-success btn-sm mb-2 periksa-" . $q->no_reg;
                        $textPanggil = "PANGGIL";
                        $stylePanggil = "width:80px";
                        $classSelesai = "btn btn-secondary btn-sm mb-2 selesai-" . $q->no_reg;
                        $styleSelesai = "width:80px";
                        $disablePanggil = '';
                        $disable = 'disabled';
                        $classBatal = "btn btn-secondary btn-sm mb-2 batal-" . $q->no_reg;
                        $styleBatal = "width:80px";
                    }
                    return '<div id="aksi">
                    <button ' . $disablePanggil . ' onclick="panggil(\'' . $q->no_reg . '\')" class="' . $classPanggil . '" type="button" style="' . $stylePanggil . '" data-id="' . $q->no_rawat . '">' . $textPanggil . '</button><br/>
                    <button ' . $disable . ' onclick="selesai(\'' . $q->no_reg . '\')" class="' . $classSelesai . '" style="' . $styleSelesai . '" data-id="' . $q->no_rawat . '" type="button">SELESAI</button><br/>
                    <button ' . $disable . ' onclick="batal(\'' . $q->no_reg . '\')" class="' . $classBatal . '" style="' . $styleBatal . '" data-id="' . $q->no_rawat . '" type="button">BATAL</button>
                    </div>';
                }
            })
            ->addColumn('upload', function ($q) {
                $no_rawat = $this->statusUpload($q->no_rawat);
                $status = $this->statusSoap($q->no_rawat);

                if ($no_rawat) {
                    $btnClass =
                        'class="btn btn-success btn-sm mb-2 mr-1"><i class="bi bi-check2-circle"></i> UPLOAD</a></br>';
                } else {
                    $btnClass =
                        'class="btn btn-primary btn-sm mb-2 mr-1"><i class="bi bi-cloud-upload-fill"></i> UPLOAD</a></br>';
                }

                if ($status) {
                    $classSoap = 'btn btn-success';
                } else {
                    $classSoap = 'btn btn-primary';
                }

                $btnUpload =
                    '<a href="#form-upload" style="width:80px;font-size:12px;text-align:left" onclick="detailPeriksa(\'' . $q->no_rawat . '\', \'' . $q->status_lanjut . '\')" ' . $btnClass;
                $btnUpload .=
                    '<button style="width:80px;font-size:12px;text-align:left" onclick="ambilNoRawat(\'' . $q->no_rawat . '\')" class="' . $classSoap . ' btn-sm mb-2 mr-1" data-bs-toggle="modal" data-bs-target="#modalSoap" data-id="' . $q->no_rawat . '"><i class="bi bi-pencil-square"></i> SOAP</button><br/>';
                $btnUpload .=
                    '<button style="width:80px;font-size:12px;text-align:left" onclick="ambilNoRm(\'' . $q->no_rkm_medis . '\')" class="btn btn-primary btn-sm mb-2 mr-1" data-bs-toggle="modal" data-bs-target="#modalRiwayat" data-id="' . $q->no_rkm_medis . '"><i class="bi bi-search"></i>RIWAYAT</button>';

                return $btnUpload;
            })
            ->rawColumns(['upload', 'nm_pasien', 'aksi'])
            ->make(true);
    }

    public function statusUpload($no_rawat)
    {
        $upload = Upload::select('no_rawat')
            ->where('no_rawat', $no_rawat)
            ->first();
        return $upload;
    }
    public function statusSoap($no_rawat)
    {
        $status = PemeriksaanRalan::select('no_rawat')
            ->where('no_rawat', $no_rawat)
            ->first();
        return $status;
    }
}
