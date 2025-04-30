<?php

namespace App\Http\Controllers;

use App\Models\ResepObat;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ResepObatController extends Controller
{
    private $resepObat;
    private $track;
    public function __construct()
    {
        $this->resepObat = new ResepObat();
        $this->track = new TrackerSqlController();
    }
    public function index()
    {
        return view('content.farmasi.ralan.resep');
    }
    public function hapus($noResep)
    {
        $resepObat = $this->resepObat;
        $data = ['no_resep' => $noResep];
        $result = $resepObat->where($data)->delete();
        $this->track->deleteSql($resepObat, $data);
        return response()->json($result);
    }

    function getByNoRawat($no_rawat)
    {
        $id = str_replace('-', '/', $no_rawat);
        $resepObat = $this->resepObat->where('no_rawat', $id)
            ->with('resepDokter.dataBarang.kodeSatuan', 'resepRacikan.metode', 'resepRacikan.detailRacikan.databarang.kodeSatuan')
            ->get();

        return response()->json($resepObat);
    }
    function get($no_resep)
    {
        $resepObat = $this->resepObat->where('no_resep', $no_resep)->where('status', 'ralan')
            ->with('resepDokter.dataBarang.kodeSatuan', 'resepRacikan.metode', 'resepRacikan.detailRacikan.databarang.kodeSatuan')
            ->first();
        return response()->json($resepObat);
    }
    public function ambil(Request $request)
    {
        $resepObat = $this->resepObat;

        if ($request->no_rawat) {
            $resepObat = $this->resepObat->where('no_rawat', $request->no_rawat)->where('status', 'ralan')->with('resepDokter.dataBarang.kodeSatuan', 'resepRacikan.metode', 'resepRacikan.detailRacikan.databarang.kodeSatuan')->get();
        }
        if ($request->no_resep) {
            $resepObat = $this->resepObat->where('no_resep', $request->no_resep)->where('status', 'ralan')->with('resepDokter.dataBarang.kodeSatuan', 'resepRacikan.metode', 'resepRacikan.detailRacikan.databarang.kodeSatuan')->first();
        }
        return response()->json($resepObat);
    }
    public function panggil(Request $request)
    {
        $jam = $request->jam == 'true' ? date('H:i:s') : '00:00:00';
        $resepObat = $this->resepObat->where('no_resep', $request->no_resep)->update([
            'tgl_penyerahan' => $request->tanggal,
            'jam_penyerahan' => $jam,
        ]);

        return response()->json('Berhasil dipanggil');
    }
    public function ambilSekarang()
    {
        $resepObat = $this->resepObat->where('tgl_peresepan', date('Y-m-d'))->where('status', 'ralan')->with('regPeriksa')->get();
        return response()->json($resepObat);
    }
    public function ambilTable(Request $request)
    {
        $resepObat = $this->resepObat
            ->where('tgl_peresepan', $request->tgl_peresepan)
            ->with('regPeriksa.pasien', 'regPeriksa.poliklinik', 'regPeriksa.dokter.spesialis')->where('status', 'ralan')
            ->orderBy('jam_peresepan', 'DESC');

        return DataTables::of($resepObat)
            ->filter(function ($query) use ($request) {
                if ($request->has('search') && $request->get('search')['value']) {
                    return $query->whereHas('regPeriksa.pasien', function ($query) use ($request) {
                        $query->where('nm_pasien', 'like', '%' . $request->get('search')['value'] . '%');
                    });
                }
            })
            ->make(true);
    }
    public function getLast()
    {
        $resepObat = $this->resepObat->select('no_resep');
        $result = $resepObat->where('tgl_peresepan', date('Y-m-d'))->orWhere('tgl_perawatan', date('Y-m-d'))->orderBy('no_resep', 'DESC')->first();
        return response()->json($result);
    }
    public function akhir(Request $request)
    {
        $resepObat = $this->resepObat;

        if ($request->tgl_peresepan) {
            $result = $resepObat->where('tgl_peresepan', $request->tgl_peresepan)->orWhere('tgl_perawatan', $request->tgl_perawatan)->orderBy('no_resep', 'DESC')->first();
        }

        return response()->json($result);
    }
    public function simpan(Request $request)
    {
        $data = [
            'no_resep' => $request->no_resep,
            'kd_dokter' => $request->kd_dokter,
            'no_rawat' => $request->no_rawat,
            'tgl_perawatan' =>  '0000-00-00',
            'jam' => date('H:i:s', strtotime("00:00:00")),
            'tgl_peresepan' => date('Y-m-d'),
            'jam_peresepan' => date('H:i:s'),
            'status' => 'ralan',
            'tgl_penyerahan' =>  '0000-00-00',
            'jam_penyerahan' => date('H:i:s', strtotime("00:00:00")),
        ];
        $resepObat = $this->resepObat->create($data);
        $this->track->insertSql($this->resepObat, $data);
        return $resepObat;
    }

    function updateTime($no_resep)
    {
        $resep = $this->resepObat->where('no_resep', $no_resep)->update(['jam_peresepan' => date('H:i:s')]);
        return $resep;
    }

    function isAvailable($no_rawat)
    {
        $resep = $this->resepObat->where('no_rawat', $no_rawat)->first();
        return $resep;
    }

    function getByNoRm($no_rkm_medis)
    {
        $resep = $this->resepObat->whereHas('regPeriksa.pasien', function ($query) use ($no_rkm_medis) {
            return $query->where('no_rkm_medis', $no_rkm_medis);
        })->with(['resepRacikan.detailRacikan.databarang.kodeSatuan', 'resepRacikan.metode', 'resepDokter.dataBarang.kodeSatuan'])->get();

        return response()->json($resep);
    }
}
