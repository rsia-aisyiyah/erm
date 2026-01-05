<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\BridgingRujukanBpjs;
use Illuminate\Database\QueryException;
use PhpOffice\PhpSpreadsheet\Writer\Pdf\Dompdf;

class BridgingRujukanBpjsController extends Controller
{

    protected $rujukan;
    protected $track;
    protected $carbon;
    public function __construct()
    {
        $this->rujukan = new BridgingRujukanBpjs();
        $this->track = new TrackerSqlController();
        $this->carbon = new Carbon();
        // global $carbon;
    }
    function create(Request $request)
    {
        $data = $request->all();
        try {
            $rujukan = $this->rujukan->create($data);
            $this->track->insertSql($this->rujukan, $data);
            return response()->json($rujukan);
        } catch (QueryException $e) {
            return response()->json($e->errorInfo);
        }
    }
    function print($noRujukan)
    {
        $rujukan = $this->rujukan->where('no_rujukan', $noRujukan)->with(['sep'])->first();
        $dataRujukan = [
            'tipeRujukan' => $rujukan->tipeRujukan,
            'nm_ppkDirujuk' => $rujukan->nm_ppkDirujuk,
            'no_rujukan' => $rujukan->no_rujukan,
            'nama_pasien' => $rujukan->sep->nama_pasien,
            'jkel' => $rujukan->sep->jkel == 'L' ? 'Laki-Laki' : 'Perempuan',
            'no_kartu' => $rujukan->sep->no_kartu,
            'jnsPelayanan' => $rujukan->jnsPelayanan == '1' ? '1. Rawat Inap' : '2. Rawat Jalan',
            'diagRujuk' => $rujukan->diagRujukan . ' - ' . $rujukan->nama_diagRujukan,
            'tglRujukan' => $this->carbon->parse($rujukan->tglRujukan)->translatedFormat('d M Y'),
            'masaBerlaku' => $this->carbon->parse($rujukan->tglRujukan)->addDay(90)->translatedFormat('d M Y'),
            'catatan' => $rujukan->catatan,

        ];
        // return $file = view('content.print.rujukan', ['rujukan' => $rujukan]);
        $file = PDF::loadView('content.print.rujukan', ['rujukan' => $dataRujukan])->setOptions(['defaultFont' => 'serif', 'isRemoteEnabled' => true]);

        return $file->stream($rujukan->no_rujukan . '.pdf');
    }

    // function formatDate($tgl)
    // {
    //     $textTanggal = explode('-', $tgl);

    //     switch ($textTanggal[1]) {
    //         case '01':
    //             $bulan = 'Januari';
    //             break;
    //         case '02':
    //             $bulan = 'Februari';
    //             break;

    //         default:
    //             # code...
    //             break;
    //     }
    // }
}
