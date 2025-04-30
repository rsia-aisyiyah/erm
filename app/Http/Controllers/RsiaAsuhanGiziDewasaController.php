<?php

namespace App\Http\Controllers;

use App\Models\RsiaAsuhanGiziDewasa;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RsiaAsuhanGiziDewasaController extends Controller
{
    protected RsiaAsuhanGiziDewasa $rsiaAsuhanGiziDewasa;
    protected TrackerSqlController $track;
    public function __construct(RsiaAsuhanGiziDewasa $rsiaAsuhanGiziDewasa, TrackerSqlController $track)
    {
        $this->track = $track;
        $this->rsiaAsuhanGiziDewasa = $rsiaAsuhanGiziDewasa;
    }

    function create(Request $request): JsonResponse | array
    {
        $data = $request->except('_token');
        $data['tanggal'] = Carbon::parse($data['tanggal'])->toDateTimeString();

        $isExist = $this->rsiaAsuhanGiziDewasa->where('no_rawat', $data['no_rawat'])->first();

        if ($isExist) {
            return $this->update($request);
        }

        try {
            $rsiaAsuhanGiziDewasa = $this->rsiaAsuhanGiziDewasa->create($data);

            if ($rsiaAsuhanGiziDewasa) {
                $this->track->insertSql($this->rsiaAsuhanGiziDewasa, $data);
            }
        } catch (QueryException $e) {
            return response()->json($e->errorInfo, 500);
        }
        return response()->json('Berhasil', 200);
    }

    function update(Request $request): JsonResponse | array
    {
        $data = $request->except('_token');
        $data['tanggal'] = Carbon::parse($data['tanggal'])->toDateTimeString();

        try {
            $rsiaAsuhanGiziDewasa = $this
                ->rsiaAsuhanGiziDewasa
                ->where('no_rawat', $data['no_rawat'])
                ->update($data);

            if ($rsiaAsuhanGiziDewasa) {
                $this->track->updateSql($this->rsiaAsuhanGiziDewasa, $data, ['no_rawat' => $data['no_rawat']]);
            }
        } catch (QueryException $e) {
            return response()->json($e->errorInfo, 500);
        }
        return response()->json('Berhasil', 200);
    }
    function get(Request $request): JsonResponse
    {
        $asuhanGizi = $this->rsiaAsuhanGiziDewasa
            ->where('no_rawat', $request->no_rawat)->first();

        if ($asuhanGizi) {
            return response()->json($asuhanGizi, 200);
        }

        return response()->json(null, 200);
    }

    function print(Request $request){
        $asuhanGizi = $this->rsiaAsuhanGiziDewasa
            ->where('no_rawat', $request->no_rawat)
            ->with('regPeriksa', 'pasien', 'pegawai', 'kamarInap')
            ->first();

        $pasien = [
            'nm_pasien' => $asuhanGizi->pasien->nm_pasien,
            'umur' => $asuhanGizi->regPeriksa->umurdaftar . ' ' . $asuhanGizi->regPeriksa->sttsumur,
            'no_rkm_medis' => $asuhanGizi->pasien->no_rkm_medis, 
            'diagnosa_awal' => $asuhanGizi->kamarInap->diagnosa_awal, 
            'jk' => $asuhanGizi->pasien->jk === 'L' ? 'Laki-laki' : 'Perempuan', 
            'tgl_lahir' => Carbon::parse($asuhanGizi->pasien->tgl_lahir)->format('d F Y'), 
        ];
        $asuhanGizi['tanggal'] = Carbon::parse($asuhanGizi->tanggal)->format('d F Y H:i:s');
        $pdf = Pdf::loadView('content.print.asuhan_gizi_dewasa',
            [
                'asuhanGizi' => $asuhanGizi,
                'pasien' => $pasien,
            ]
        )
        ->setOption(['defaultFont' => 'serif', 'isRemoteEnabled' => true])
            ->setPaper(array(0, 0, 595, 935));
        return $pdf->stream(date('YmdHis') . '.pdf');
    }
}
