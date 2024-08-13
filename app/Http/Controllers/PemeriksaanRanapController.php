<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\RsiaLogSoap;
use App\Models\GrafikHarian;
use Illuminate\Http\Request;
use App\Models\PemeriksaanRanap;
use App\Models\RsiaGrafikHarian;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\RsiaLogSoapController;

class PemeriksaanRanapController extends Controller
{
    private $tanggal;
    private $pemeriksaan;
    private $grafikharian;
    private $track;
    private $log;

    public function __construct()
    {
        $this->tanggal = new Carbon();
        $this->pemeriksaan = new PemeriksaanRanap();
        $this->grafikharian = new GrafikHarian();
        $this->track = new TrackerSqlController();
        $this->log = new RsiaLogSoapController();
    }

    public function ambilSatu(Request $request)
    {
        $pemeriksaan = PemeriksaanRanap::where('no_rawat', $request->no_rawat)
            ->with(['regPeriksa.dokter', 'regPeriksa.pasien', 'petugas', 'petugas.dokter', 'grafikHarian']);

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
        $clause = [
            'no_rawat' => $request->no_rawat,
            'tgl_perawatan' => $request->tgl_perawatan,
            'jam_rawat' => $request->jam_rawat,
        ];

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
            'evaluasi' => '-',
            'instruksi' => $request->instruksi,
            'kesadaran' => $request->kesadaran,
        ];

        if ($request->tgl_perawatan_ubah == '' && $clause['tgl_perawatan'] == $request->tgl_perawatan_ubah) {
            $data['tgl_perawatan'] = $clause['tgl_perawatan'];
        } else {
            $data['tgl_perawatan'] = $request->tgl_perawatan_ubah;
        }

        if ($request->jam_rawat_ubah == '' && $clause['jam_rawat'] == $request->jam_rawat_ubah) {
            $data['jam_rawat'] = $clause['jam_rawat'];
        } else {
            $data['jam_rawat'] = $request->jam_rawat_ubah;
        }

        $data1 = [
            'no_rawat' => $request->no_rawat,
            'suhu_tubuh' => $request->suhu_tubuh,
            'tensi' => $request->tensi,
            'respirasi' => $request->respirasi,
            'nadi' => $request->nadi,
            'spo2' => $request->spo2,
            'gcs' => $request->gcs,
            'kesadaran' => $request->kesadaran,
            'keluaran_urin' => $request->keluaran_urin,
            'proteinuria' => $request->proteinuria,
            'air_ketuban' => $request->air_ketuban,
            'skala_nyeri' => $request->skala_nyeri,
            'lochia' => $request->lochia,
            'terlihat_tidak_sehat' => $request->terlihat_tidak_sehat,
            'o2' => $request->o2,
            'sumber' => 'SOAP',
        ];




        $log = $this->log->insert([
            'no_rawat' => $clause['no_rawat'],
            'tgl_perawatan' => $data['tgl_perawatan'],
            'jam_rawat' => $data['jam_rawat'],
        ], 'Ubah');

        $pemeriksaan = PemeriksaanRanap::where($clause)->update($data);
        $grafikharian = GrafikHarian::where($clause)->update($data1);
        $this->track->updateSql($this->pemeriksaan, $data, $clause);
        $this->track->updateSql($this->grafikharian, $data1, $clause);
        return response()->json([$pemeriksaan, $grafikharian]);
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
            'evaluasi' => '-',
            'instruksi' => $request->instruksi ? $request->instruksi : '',
            'kesadaran' => $request->kesadaran,
        ];

        $data1 = [
            'nip' => $request->nip,
            'no_rawat' => $request->no_rawat,
            'tgl_perawatan' => $this->tanggal->now()->toDateString(),
            'jam_rawat' => date('H:i:s'),
            'suhu_tubuh' => $request->suhu_tubuh,
            'tensi' => $request->tensi,
            'respirasi' => $request->respirasi,
            'nadi' => $request->nadi,
            'spo2' => $request->spo2,
            'gcs' => $request->gcs,
            'kesadaran' => $request->kesadaran,
            'keluaran_urin' => $request->keluaran_urin,
            'proteinuria' => $request->proteinuria,
            'air_ketuban' => $request->air_ketuban,
            'skala_nyeri' => $request->skala_nyeri,
            'lochia' => $request->lochia,
            'terlihat_tidak_sehat' => $request->terlihat_tidak_sehat,
            'o2' => $request->o2,
            'sumber' => 'SOAP',
        ];



        $pemeriksaan = PemeriksaanRanap::create($data);
        $grafikharian = GrafikHarian::create($data1);
        $this->track->insertSql($this->pemeriksaan, $data);
        $this->track->insertSql($this->grafikharian, $data);
        return response()->json(['Berhasil', $pemeriksaan, $grafikharian], 200);
    }
    public function hapus(Request $request)
    {
        $clause = [
            'no_rawat' => $request->no_rawat,
            'tgl_perawatan' => $request->tgl_perawatan,
            'jam_rawat' => $request->jam_rawat,
        ];
        $pemeriksaan = PemeriksaanRanap::where($clause)->delete();
        $this->track->deleteSql($this->pemeriksaan, $clause);

        $grafik = array_merge($clause, ['sumber' => 'SOAP']);
        $log = $this->log->insert($clause, 'Hapus');
        $grafikHarian = $this->grafikharian->where($grafik)->delete();
        return response()->json(['Berhasil', $pemeriksaan], 200);
    }

    function ambilPemeriksaan(Request $request)
    {
        $pemeriksaan = PemeriksaanRanap::where('no_rawat', $request->no_rawat)
            ->with(['regPeriksa', 'log', 'regPeriksa.pasien', 'petugas', 'pegawai' => function ($query) {
                return $query->with('dokter');
            }, 'grafikHarian', 'verifikasi.petugas' => function ($q) {
                return $q->select('nip', 'nama');
            }])
            ->orderBy('tgl_perawatan', 'DESC')
            ->orderBy('jam_rawat', 'DESC');
        if ($request->parameter) {
            if ($request->parameter == 'pemeriksaan') {
                $pemeriksaan->select([$request->parameter, 'gcs', 'suhu_tubuh', 'tensi', 'nadi', 'respirasi', 'kesadaran', 'jam_rawat', 'tgl_perawatan', 'nip'])->orderBy('tgl_perawatan', 'ASC');
            } else if ($request->parameter == 'obat' || $request->parameter == 'obatpulang') {
                $pemeriksaan->select(['rtl', 'pemeriksaan', 'jam_rawat', 'tgl_perawatan', 'nip'])->whereHas('pegawai', function ($query) {
                    $query->whereIn('departemen', ['DM7', 'SPS', '-', 'DM2', 'DM3', 'DM4', 'DM5', 'DM8', 'CSM']);
                })->orderBy('tgl_perawatan', 'ASC');
            } else if ($request->parameter == 'ttv') {
                $pemeriksaan->select(['suhu_tubuh', 'tensi', 'berat', 'tinggi', 'spo2', 'nadi', 'respirasi', 'kesadaran', 'gcs', 'jam_rawat', 'tgl_perawatan', 'nip'])->orderBy('tgl_perawatan', 'ASC');
            } else {
                $pemeriksaan->select([$request->parameter, 'jam_rawat', 'tgl_perawatan', 'nip'])->orderBy('tgl_perawatan', 'ASC');
            }
            if ($request->pemeriksaan) {
                $pemeriksaan->where($request->parameter, 'like', '%' . $request->pemeriksaan . '%');
            }
        }

        return $pemeriksaan->get();
    }

    function getDataTable(Request $request)
    {
        $data = $this->ambilPemeriksaan($request);

        return DataTables::of($data)->make(true);
    }

    public function ambil(Request $request)
    {

        $pemeriksaan = $this->pemeriksaan->where('no_rawat', $request->no_rawat)->with(['regPeriksa', 'regPeriksa.pasien', 'log.pegawai', 'petugas', 'grafikHarian', 'verifikasi.petugas' => function ($q) {
            return $q->select('nip', 'nama');
        }])->orderBy('tgl_perawatan', 'DESC')
            ->orderBy('jam_rawat', 'DESC');

        // if tanggal pertama and tanggal kedua is not empty string
        if ($request->tgl_pertama != '' && $request->tgl_kedua != '') {
            $pemeriksaan->whereBetween('tgl_perawatan', [$request->tgl_pertama, $request->tgl_kedua]);
        }

        if ($request->petugas == 1) {
            $pemeriksaan->whereHas('petugas', function ($q) use ($request) {
                return $q->whereIn('kd_jbtn', ['J01', 'J024', 'J025', 'J002']);
            });
        } else if ($request->petugas == 2) {
            $pemeriksaan->whereHas('petugas', function ($q) use ($request) {
                return $q->whereNotIn('kd_jbtn', ['J01', 'J024', 'J025', 'J002']);
            });
        }

        return DataTables::of($pemeriksaan->get())->make(true);
    }



    function getTTV(Request $request)
    {
        $id = str_replace('-', '/', $request->no_rawat);
        $data = $this->grafikharian->where(['no_rawat' => $id])
            ->whereHas('pegawai', function ($q) {
                return $q->where('jbtn', 'not like', '%direktur%')
                    ->where('jbtn', 'not like', '%spesialis%');
            })->get();

        // return json
        return $data;
    }

    function getTTVData(Request $request)
    {
        $id = str_replace('-', '/', $request->no_rawat);
        $data = $this->grafikharian->where(['no_rawat' => $id, 'sumber' => '-'])->get();
        return DataTables::of($data)->make(true);
    }
    function get($noRawat)
    {
        $pemeriksaan = $this->pemeriksaan->where('no_rawat', $noRawat)->get();

        return $pemeriksaan;
    }
    function getParamTTV($noRawat, $param)
    {
        $pemeriksaan = $this->pemeriksaan->where('no_rawat', $noRawat)->select($param)->get();

        return $pemeriksaan;
    }
}
