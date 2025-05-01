<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\AsesmenMedisRajalAnak;
use App\Http\Controllers\TrackerSqlController;
use PDF;

class AsesmenMedisRajalAnakController extends Controller
{
    protected $asmed;
    protected $carbon;
    protected $track;
    public function __construct()
    {
        $this->asmed = new AsesmenMedisRajalAnak();
        $this->carbon = new Carbon();
        $this->track = new TrackerSqlController();
    }

    function get($noRawat)
    {
        $id = str_replace('-', '/', $noRawat);
        $asmed = $this->asmed->with(['regPeriksa.pasien', 'dokter'])->where('no_rawat', $id)->first();
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
        $data = $request->except('_token');
        $clause = ['no_rawat' => $request->no_rawat];

        $asmed = $this->asmed->where('no_rawat', $request->no_rawat)->update($data);
        $this->track->updateSql($this->asmed, $data, $clause);
        return response()->json($asmed);
    }
    function getByNoRm($noRkmMedis)
    {
        $asmed = $this->asmed->with(['regPeriksa.pasien', 'dokter'])
            ->whereHas('regPeriksa.pasien', function ($query) use ($noRkmMedis) {
                return $query->where('no_rkm_medis', $noRkmMedis);
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
            'ket_lokalis' => $asmed->ket_lokalis,
            'ket_lokalis' => $asmed->penunjang,
            'diagnosis' => $asmed->diagnosis,
            'tata' => $asmed->tata,
            'konsul' => $asmed->konsul,
        ];
        $dataAsmed['sidik'] = $this->setFingerOutput($dataAsmed['dokter'], $asmed->dokter->pegawai->sidikjari->sidikjari, $dataAsmed['tanggal']);

        $file = PDF::loadView('content.print.asmed_rajal_anak', ['data' => $dataAsmed])
            ->setPaper(array(0, 0, 595, 935))
            ->setOptions(['defaultFont' => 'serif', 'isRemoteEnabled' => true]);

        // $file = PDF::loadView('content.print.asmed_kandungan', ['data' => $dataAsmed])->setOptions(['defaultFont' => 'sherif', 'isRemoteEnabled' => true]);
        return $file->stream($asmed->no_rawat . '.pdf');
    }
}
