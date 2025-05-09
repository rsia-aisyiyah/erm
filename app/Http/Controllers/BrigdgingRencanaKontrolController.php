<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use Milon\Barcode\DNS1D;
use Illuminate\Http\Request;
use App\Models\RencanaKontrol;
use Illuminate\Routing\Controller;
use Illuminate\Database\QueryException;
use App\Http\Controllers\TrackerSqlController;

class BrigdgingRencanaKontrolController extends Controller
{
    protected $rencanaKontrol;
    protected $track;
    protected $carbon;

    public function __construct()
    {
        $this->rencanaKontrol = new RencanaKontrol();
        $this->track = new TrackerSqlController();
        $this->carbon = new Carbon();
    }

    public function create(Request $request)
    {
        $data = [
            'no_sep' => $request->no_sep,
            'tgl_surat' => $request->tgl_surat,
            'no_surat' => $request->no_surat,
            'tgl_rencana' => $request->tgl_rencana,
            'kd_dokter_bpjs' => $request->kd_dokter_bpjs,
            'nm_dokter_bpjs' => $request->nm_dokter_bpjs,
            'kd_poli_bpjs' => $request->kd_poli_bpjs,
            'nm_poli_bpjs' => ucfirst(strtolower($request->nm_poli_bpjs)),
        ];

        try {
            $rencanaKontrol = $this->rencanaKontrol->create($data);
            $track = $this->track->insertSql($this->rencanaKontrol, $data);
            return response()->json($rencanaKontrol);
        } catch (QueryException $e) {
            return response()->json(['metaData' => ['Status' => 'FAILED', 'Code' => 400], 'response' => $e->errorInfo]);
        }
    }

    function print($noSurat)
    {
        $kontrol = $this->rencanaKontrol->where('no_surat', $noSurat)
            ->with(['sep.regPeriksa', 'mappingDokter.dokter'])
            ->first();
        $dataKontrol = [
            // 'sep' => $kontrol->sep->toArray(),
            'no_sep' => $kontrol->sep->no_rujukan,
            'tglRujukanExpired' => $this->carbon->parse($kontrol->sep->tglrujukan)->addDays(90)->translatedFormat('d F Y'),
            'nmppkrujukan' => $kontrol->sep->nmppkrujukan,
            'tglKontrolSep' => $this->carbon->parse($kontrol->sep->tglrujukan)->translatedFormat('d F Y'),
            'no_surat' => $kontrol->no_surat,
            'tglSurat' => $this->carbon->parse($kontrol->tgl_surat)->translatedFormat('d F Y'),
            'tglKontrol' => $this->carbon->parse($kontrol->tgl_rencana)->translatedFormat('d F Y'),
            'nmDokter' => $kontrol->mappingDokter->dokter->nm_dokter,
            'noKartu' => $kontrol->sep->no_kartu,
            'namaPasien' => $kontrol->sep->nama_pasien,
            'jkel' => $kontrol->sep->jkel,
            'umur' => $kontrol->sep->regPeriksa->umurdaftar . ' ' . $kontrol->sep->regPeriksa->sttsumur,
            'tglLahir' => $this->carbon->parse($kontrol->sep->tanggal_lahir)->translatedFormat('d F Y'),
            'diagnosa' => $kontrol->sep->diagawal . ' - ' . $kontrol->sep->nmdiagnosaawal,
            'tglCetak' => date('d/m/Y H:i:s'),
            // 'qrCode' => DNS1D::getBarcodeHtml('TEST', 'PHARMA2T'),
        ];
        $file = PDF::loadView('content.print.kontrol', ['kontrol' => $dataKontrol])
            ->setOptions(['defaultFont' => 'serif', 'isRemoteEnabled' => true]);

        return $file->stream($kontrol->no_surat . '.pdf');
    }
}
