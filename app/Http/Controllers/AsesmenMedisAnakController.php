<?php

namespace App\Http\Controllers;

use App\Models\AsesmenMedisAnak;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AsesmenMedisAnakController extends Controller
{
    protected $asmed;
    protected $carbon;
    protected $track;

    public function __construct()
    {
        $this->track = new TrackerSqlController;
        $this->asmed = new AsesmenMedisAnak();
        $this->carbon = new Carbon();
    }

    function get($noRawat)
    {
        $id = str_replace('-', '/', $noRawat);

        $asmed = $this->asmed->where('no_rawat', $id)->with('regPeriksa.pasien', 'regPeriksa.dokter', 'dokter')->first();
        return response()->json($asmed);
    }

    function create(Request $request)
    {
        $data = $request->all();
        $data['tanggal'] = date('Y-m-d H:i:s');


        $asmed = $this->asmed->create($data);
        $this->track->insertSql($this->asmed, $data);

        return $asmed;
    }
    function update(Request $request)
    {
        if ($request->no_rawat_2) {
            $data = $request->except(['_token', 'no_rawat_2']);
            $data['tanggal'] = date('Y-m-d H:i:s');
            $clause = ['no_rawat' => $request->no_rawat_2];
        } else {
            $data = $request->except(['_token']);
            $clause = ['no_rawat' => $request->no_rawat];
        }
        $asmed = $this->asmed->where($clause)->update($data);
        $this->track->updateSql($this->asmed, $data, $clause);

        return $asmed;
    }
    function getByNoRm($no_rkm_medis)
    {
        $asmed = $this->asmed->whereHas('regPeriksa', function ($query) use ($no_rkm_medis) {
            $query->where('no_rkm_medis', $no_rkm_medis);
        })->with('regPeriksa.pasien', 'regPeriksa.poliklinik', 'dokter')->get();
        return response()->json($asmed);
    }
    
    function print(Request $request){
        $asmed = $this->asmed->where('no_rawat', $request->no_rawat)->with('regPeriksa.pasien', 'regPeriksa.dokter', 'dokter.pegawai')->first();
        $asmed['sidik'] = $this->setFingerOutput($asmed->dokter->nm_dokter, bcrypt($asmed->dokter->kd_dokter), $asmed->tanggal);

        $pdf = Pdf::loadView('content.print.asmed_ranap_anak', compact('asmed'))
        ->setOption(['defaultFont' => 'serif', 'isRemoteEnabled' => true])
            ->setPaper(array(0, 0, 595, 935));
        return $pdf->stream($asmed->regPeriksa->pasien->no_rkm_medis . date('YmdHis') . '.pdf');
        // return response()->json($asmed);
    }

     function setFingerOutput($dokter, $id, $tanggal)
    {
        $strId = sha1($id);
        return $str = "Ditandatangani di RSIA Aisiyiyah Pekajangan Kab. Pekalongan, Ditandatangani Elektronik Oleh $dokter, ID $strId, $tanggal";
    }
}
