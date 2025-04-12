<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\DataTables;

use function PHPSTORM_META\map;

class PasienController extends Controller
{
    protected $pasien;
    protected $track;
    public function __construct()
    {
        $this->pasien = new Pasien();
        $this->track = new TrackerSqlController();
    }
    public function index()
    {
        return view('content.pasien.pencarian');
    }
    public function search(Request $request)
    {
        $pasien = [];
        if ($request->has('q')) {
            $pasien = Pasien::where('nm_pasien', 'like', '%' . $request->q . '%')
                ->orWhere('no_rkm_medis', 'like', '%' . $request->q . '%')
                ->get();
        }
        return response()->json($pasien);
    }
    public function ambil($no_rkm_medis)
    {
        $pasien = Pasien::where('no_rkm_medis', $no_rkm_medis)->with(['regPeriksa.resepObat.resepDokter.dataBarang', 'regPeriksa.resepObat.resepRacikan.detailRacikan.dataBarang'])
            ->with(['suku', 'bahasa', 'cacat', 'penjab', 'kel', 'kec', 'kab', 'prop', 'instansi', 'suku'])
            ->first();
        return response()->json($pasien);
    }
    function getAsmed($no_rkm_medis)
    {
        $pasien = $this->pasien->where('no_rkm_medis', $no_rkm_medis)->with(['regPeriksa.asmedRajalKandungan'])->first();

        foreach ($pasien->regPeriksa as $p) {
            $data = [];
            $arrAsmed = json_decode($p['asmedRajalKandungan']);
            if (!empty($arrAsmed)) {
                $data[] = $arrAsmed;
            }
        }
        return DataTables::of($data)->make(true);
    }
    function table(Request $request)
    {
        $key = $request->search['value'];
        $pasien = $this->pasien;
        if ($key) {
            $pasien = $pasien
                ->where('nm_pasien', 'like', '%' . $key . '%');
        } else {
            $pasien = $pasien
                ->where('nm_pasien', '!=', '-')
                ->orderBy('nm_pasien', 'ASC');
        }
        $pasien = $pasien
            ->with('kec', 'kab', 'kel', 'penjab', 'instansi', 'prop')
            ->limit(1000)->get();
        return DataTables::of($pasien)
            ->addColumn('id', function ($pasien) {
                return Crypt::encrypt($pasien->no_rkm_medis);
            })
            ->make(true);
    }
    function create(Request $request)
    {
        $data = [
            'no_rkm_medis' => $request->no_rkm_medis,
            'nm_pasien' => $request->nm_pasien,
            'jk' => $request->jk,
            'tmp_lahir' => $request->tmp_lahir,
            'tgl_lahir' => date('Y-m-d', strtotime($request->tgl_lahir)),
            'tgl_daftar' => date('Y-m-d', strtotime($request->tgl_daftar)),
            'nm_ibu' => $request->nm_ibu,
            'no_ktp' => $request->no_ktp,
            'umur' => $request->umur,
            'agama' => $request->agama,
            'stts_nikah' => $request->stts_nikah,
            'kd_pj' => $request->kd_pj,
            'no_peserta' => $request->no_peserta,
            'no_tlp' => $request->no_tlp,
            'email' => $request->email,
            'pekerjaan' => $request->pekerjaan,
            'gol_darah' => $request->gol_darah,
            'alamat' => $request->alamat,
            'kd_prop' => $request->kd_prop,
            'kd_kab' => $request->kd_kab,
            'kd_kec' => $request->kd_kec,
            'kd_kel' => $request->kd_kel,
            'pnd' => $request->pnd,
            'perusahaan_pasien' => $request->perusahaan_pasien,
            'cacat_fisik' => $request->cacat_fisik,
            'suku_bangsa' => $request->suku_bangsa,
            'bahasa_pasien' => $request->bahasa_pasien,
            'keluarga' => $request->keluarga,
            'namakeluarga' => $request->namakeluarga,
            'pekerjaanpj' => $request->pekerjaanpj,
            'alamatpj' => $request->alamatpj,
            'kelurahanpj' => $request->kelurahanpj,
            'kecamatanpj' => $request->kecamatanpj,
            'kabupatenpj' => $request->kabupatenpj,
            'propinsipj' => $request->propinsipj,
            'nip' => $request->nip,
        ];
        $pasien = $this->pasien->where('no_rkm_medis', $request->no_rkm_medis);

        if ($pasien->first()) {
            return $this->edit($request);
        }

        try {
            $pasien = $this->pasien->create($data);
            if ($pasien) {
                $this->track->insertSql($this->pasien, $data);
                return response()->json($pasien);
            }
        } catch (QueryException $e) {
            return response()->json($e->errorInfo);
        }
    }
    function edit(Request $request)
    {

        $data = [
            'nm_pasien' => $request->nm_pasien,
            'jk' => $request->jk,
            'tmp_lahir' => $request->tmp_lahir,
            'tgl_lahir' => date('Y-m-d', strtotime($request->tgl_lahir)),
            'tgl_daftar' => date('Y-m-d', strtotime($request->tgl_daftar)),
            'nm_ibu' => $request->nm_ibu,
            'no_ktp' => $request->no_ktp,
            'umur' => $request->umur,
            'agama' => $request->agama,
            'stts_nikah' => $request->stts_nikah,
            'kd_pj' => $request->kd_pj,
            'no_peserta' => $request->no_peserta,
            'no_tlp' => $request->no_tlp,
            'email' => $request->email,
            'pekerjaan' => $request->pekerjaan,
            'gol_darah' => $request->gol_darah,
            'alamat' => $request->alamat,
            'kd_prop' => $request->kd_prop,
            'kd_kab' => $request->kd_kab,
            'kd_kec' => $request->kd_kec,
            'kd_kel' => $request->kd_kel,
            'pnd' => $request->pnd,
            'perusahaan_pasien' => $request->perusahaan_pasien,
            'cacat_fisik' => $request->cacat_fisik,
            'suku_bangsa' => $request->suku_bangsa,
            'bahasa_pasien' => $request->bahasa_pasien,
            'keluarga' => $request->keluarga,
            'namakeluarga' => $request->namakeluarga,
            'pekerjaanpj' => $request->pekerjaanpj,
            'alamatpj' => $request->alamatpj,
            'kelurahanpj' => $request->kelurahanpj,
            'kecamatanpj' => $request->kecamatanpj,
            'kabupatenpj' => $request->kabupatenpj,
            'propinsipj' => $request->propinsipj,
            'nip' => $request->nip,
        ];
        try {
            $pasien = $this->pasien->where('no_rkm_medis', $request->no_rkm_medis)->update($data);
            if ($pasien) {
                $this->track->updateSql($this->pasien, $data, ['no_rkm_medis' => $request->no_rkm_medis]);
                return response()->json($pasien);
            }
        } catch (QueryException $e) {
            return response()->json($e->errorInfo);
        }
    }
}
