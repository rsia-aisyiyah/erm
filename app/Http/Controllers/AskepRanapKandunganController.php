<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AskepRanapKandungan;
use App\Http\Controllers\TrackerSqlController;
use App\Services\PrintService;

class AskepRanapKandunganController extends Controller
{
    protected $askep;
    protected $track;
    protected $printService;

    public function __construct(PrintService $printService)
    {
        $this->printService = $printService;

        $this->askep = new AskepRanapKandungan();
        $this->track = new TrackerSqlController();
    }
    function get(Request $request)
    {
        return $this->askep->where('no_rawat', $request->no_rawat)->with('pengkaji1', 'pengkaji2')->first();
    }

    function createOrUpdate(Request $request)
    {
        $data = $request->except('_token');
        $askep = $this->askep->where('no_rawat', $data['no_rawat'])->first();

        if ($askep) {
            $createOrUpdate = $this->askep->where('no_rawat', $data['no_rawat'])->update($data);
            $this->track->updateSql($this->askep, $data, ['no_rawat' => $data['no_rawat']]);
        } else {
            $createOrUpdate = $this->askep->create($data);
            $this->track->insertSql($this->askep, $data);
        }
        return response()->json($createOrUpdate);
    }
    function printAskep(Request $request)
    {
        $askep = $this->askep->where('no_rawat', $request->no_rawat)->with('pengkaji1', 'pengkaji2')->first();
        $askep['sidik1'] = $this->printService->fingerOutput(
            $askep->pengkaji1->nama,
            bcrypt($askep->nip1),
            $askep->tanggal
        );
        $askep['sidik2'] = $this->printService->fingerOutput(
            $askep->pengkaji2->nama,
            bcrypt($askep->nip2),
            $askep->tanggal
        );

        return $this->printService->stream(
            'content.print.askep_ranap_kandungan',
            compact('askep'),
            $askep->no_rawat . date('YmdHis') . '.pdf'
        );



    }
}
