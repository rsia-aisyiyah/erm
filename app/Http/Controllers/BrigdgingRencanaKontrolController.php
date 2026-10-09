<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSkrjRequest;
use PDF;
use Carbon\Carbon;
use Milon\Barcode\DNS1D;
use Illuminate\Http\Request;
use App\Models\RencanaKontrol;
use Illuminate\Routing\Controller;
use Illuminate\Database\QueryException;
use App\Http\Controllers\TrackerSqlController;
use App\Http\Requests\StoreBangsalRequest;

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

    public function create(StoreSkrjRequest $request)
    {
        $data = $request->validated();

        $data['nm_poli_bpjs'] = ucfirst(strtolower($data['nm_poli_bpjs']));

        try {
            $rencanaKontrol = $this->rencanaKontrol->updateOrCreate(['no_surat' => $data['no_surat']], $data);
            $track = $this->track->insertSql($this->rencanaKontrol, $data);

            if (!empty($data['no_sep'])) {
                $sep = \App\Models\BridgingSep::where('no_sep', $data['no_sep'])->with('regPeriksa')->first();
                if ($sep && $sep->no_rawat) {
                    \App\Models\RsiaRencanaKontrolRalan::updateOrCreate(
                        ['no_rawat' => $sep->no_rawat],
                        [
                            'kd_dokter' => $sep->regPeriksa ? $sep->regPeriksa->kd_dokter : ($data['kd_dokter_bpjs'] ?? '-'),
                            'kd_poli' => $sep->regPeriksa ? $sep->regPeriksa->kd_poli : ($data['kd_poli_bpjs'] ?? null),
                            'status_tindak_lanjut' => 'KONTROL',
                            'tgl_rencana_kontrol' => $data['tgl_rencana'],
                            'catatan' => 'SKU BPJS: ' . $data['no_surat'],
                            'nip' => session()->get('pegawai') ? session()->get('pegawai')->nik : null,
                        ]
                    );
                }
            }

            return response()->json($rencanaKontrol);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
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
            'tglRujukanExpired' => $this->carbon->parse($kontrol->sep->tglrujukan)->addDays(90)->translatedFormat('d M Y'),
            'nmppkrujukan' => $kontrol->sep->nmppkrujukan,
            'tglKontrolSep' => $this->carbon->parse($kontrol->sep->tglrujukan)->translatedFormat('d M Y'),
            'no_surat' => $kontrol->no_surat,
            'tglSurat' => $this->carbon->parse($kontrol->tgl_surat)->translatedFormat('d F Y'),
            'tglKontrol' => $this->carbon->parse($kontrol->tgl_rencana)->translatedFormat('d M Y'),
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
