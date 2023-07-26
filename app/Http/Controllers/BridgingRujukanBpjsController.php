<?php

namespace App\Http\Controllers;

use App\Models\BridgingRujukanBpjs;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use PDF;
use PhpOffice\PhpSpreadsheet\Writer\Pdf\Dompdf;

class BridgingRujukanBpjsController extends Controller
{

    protected $rujukan;
    protected $track;
    public function __construct()
    {
        $this->rujukan = new BridgingRujukanBpjs();
        $this->track = new TrackerSqlController();
    }
    function create(Request $request)
    {
        $data = $request->all();
        try {
            $rujukan = $this->rujukan->create($data);
            $this->track->create($this->track->insertSql($this->rujukan, $data));
            return response()->json($rujukan);
        } catch (QueryException $e) {
            return response()->json($e->errorInfo);
        }
    }
    function print($noRujukan)
    {
        $rujukan = $this->rujukan->where('no_rujukan', $noRujukan)->with(['sep'])->first();
        // return $file = view('content.print.rujukan', ['rujukan' => $rujukan]);
        $file = PDF::loadView('content.print.rujukan', ['rujukan' => $rujukan])->setOptions(['defaultFont' => 'serif', 'isRemoteEnabled' => true]);

        return $file->stream('rujukan_keluar_pdf.pdf');
    }
}
