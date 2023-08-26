<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AsesmenMedisRajalKandungan;
use PDF;
use Carbon\Carbon;

class AsesmenMedisRajalKandunganController extends Controller
{
    protected $track;
    protected $asmed;
    protected $carbon;

    public function __construct()
    {
        $this->asmed = new AsesmenMedisRajalKandungan();
        $this->carbon = new Carbon();
        $this->track = new TrackerSqlController();
    }

    function get($noRawat)
    {
        $id = str_replace('-', '/', $noRawat);
        $asmed = $this->asmed->where('no_rawat', $id)->with(['regPeriksa.pasien', 'dokter'])->first();
        return response()->json($asmed);
    }
    function insert(Request $request)
    {
        $data = $request->except('_token');
        $data['tanggal'] = date('Y-m-d H:i:s');

        $asmed = $this->asmed->create($data);
        $this->track->insertSql($this->asmed, $data);
        return response()->json($asmed);
    }
    function edit(Request $request)
    {
        $data = $request->except(['_token', 'dokter', 'tgl_lahir']);
        $clause = ['no_rawat' => $data['no_rawat']];

        $asmed = $this->asmed->where($clause)->update($data);
        $this->track->updateSql($this->asmed, $data, $clause);
        return response()->json($asmed);
    }
    function getByNoRm($no_rkm_medis)
    {
        $asmed = $this->asmed->with('regPeriksa.pasien', 'dokter')
            ->whereHas('regPeriksa', function ($q) use ($no_rkm_medis) {
                $q->where('no_rkm_medis', $no_rkm_medis);
            })->get();

        return response()->json($asmed);
    }
    function setFingerOutput($dokter, $id, $tanggal)
    {
        $strId = sha1($id);
        return $str = "Dikeluarkan di RSIA Aisiyiyah Pekajangan Kab. Pekalongan, Ditandatangani Elektronik Oleh $dokter, ID $strId, $tanggal";
    }
    function print($no_rawat)
    {
        $id = str_replace('-', '/', $no_rawat);
        $asmed = $this->asmed->where('no_rawat', $id)->with(['regPeriksa.pasien', 'dokter.pegawai.sidikjari'])->first();
        $dataAsmed = [
            'nama' => $asmed->regPeriksa->pasien->nm_pasien,
            'dokter' => $asmed->dokter->nm_dokter,
            'kd_dokter' => $asmed->dokter->kd_dokter,
            'no_rkm_medis' => $asmed->regPeriksa->no_rkm_medis,
            'jk' => $asmed->regPeriksa->pasien->jk == 'L' ? 'Laki-laki' : 'Perempuan',
            'tgl_lahir' => $this->carbon->parse($asmed->regPeriksa->pasien->tgl_lahir)->translatedFormat('d F Y'),
            'tanggal' => $this->carbon->parse($asmed->tanggal)->translatedFormat('d F Y H:i:s'),
            'anamnesis' => $asmed->anamnesis,
            'keluhan_utama' => $asmed->keluhan_utama,
            'rps' => $asmed->rps,
            'rpd' => $asmed->rpd,
            'rpk' => $asmed->rpk,
            'rpo' => $asmed->rpo,
            'alergi' => $asmed->alergi,
            'keadaan' => $asmed->keadaan,
            'kesadaran' => $asmed->kesadaran,
            'gcs' => $asmed->gcs,
            'td' => $asmed->td,
            'nadi' => $asmed->nadi,
            'rr' => $asmed->rr,
            'suhu' => $asmed->suhu,
            'spo' => $asmed->spo,
            'bb' => $asmed->bb,
            'tb' => $asmed->tb,
            'kepala' => $asmed->kepala,
            'mata' => $asmed->mata,
            'gigi' => $asmed->gigi,
            'tht' => $asmed->tht,
            'thoraks' => $asmed->thoraks,
            'abdomen' => $asmed->abdomen,
            'genital' => $asmed->genital,
            'ekstremitas' => $asmed->ekstremitas,
            'kulit' => $asmed->kulit,
            'ket_fisik' => $asmed->ket_fisik,
            'tfu' => $asmed->tfu,
            'tbj' => $asmed->tbj,
            'his' => $asmed->his,
            'kontraksi' => $asmed->kontraksi,
            'djj' => $asmed->djj,
            'inspeksi' => $asmed->inspeksi,
            'inspekulo' => $asmed->inspekulo,
            'vt' => $asmed->vt,
            'rt' => $asmed->rt,
            'ultra' => $asmed->ultra,
            'kardio' => $asmed->kardio,
            'lab' => $asmed->lab,
            'diagnosis' => $asmed->diagnosis,
            'tata' => $asmed->tata,
            'konsul' => $asmed->konsul,
        ];
        $dataAsmed['sidik'] = $this->setFingerOutput($dataAsmed['dokter'], $asmed->dokter->pegawai->sidikjari->sidikjari, $dataAsmed['tanggal']);

        $file = PDF::loadView('content.print.asmed_kandungan', ['data' => $dataAsmed])->setOptions(['defaultFont' => 'serif', 'isRemoteEnabled' => true]);

        // $file = PDF::loadView('content.print.asmed_kandungan', ['data' => $dataAsmed])->setOptions(['defaultFont' => 'sherif', 'isRemoteEnabled' => true]);
        return $file->stream($asmed->no_rawat . '.pdf');
    }
}
