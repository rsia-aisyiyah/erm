<?php

namespace App\Http\Controllers;

use App\Models\ResumePasienRanap;
use Illuminate\Http\Request;

class ResumePasienRanapController extends Controller
{

    protected $resume;
    protected $track;
    public function __construct()
    {
        $this->resume = new ResumePasienRanap();
        $this->track = new TrackerSqlController();
    }

    function get(Request $request)
    {
        $resume = $this->resume->where('no_rawat', $request->no_rawat)->with([
            'regPeriksa.pasien', 'dokter.spesialis', 'regPeriksa.penjab', 'regPeriksa.poliklinik',
            'regPeriksa.kamarInap' => function ($query) {
                return $query->where('stts_pulang', '!=', 'Pindah Kamar')->with(['kamar.bangsal']);
            }, 'bayiGabung.kamarIbu' => function ($query) {
                return $query->where('stts_pulang', '!=', 'Pindah Kamar')->with(['kamar.bangsal']);
            }
        ])->first();

        return response()->json($resume);
    }

    function insert(Request $request)
    {
        $data =  $request->except(['tgl_kontrol', 'jam_kontrol', '_token']);
        $this->track->insertSql($this->resume, $data);
        return $this->resume->create($data);
    }

    function edit(Request $request)
    {
        $data =  $request->except(['tgl_kontrol', 'jam_kontrol', '_token']);
        $this->track->updateSql($this->resume, $data, ['no_rawat', $data['no_rawat']]);
        return $this->resume->where('no_rawat', $data['no_rawat'])->update($data);
    }
}
