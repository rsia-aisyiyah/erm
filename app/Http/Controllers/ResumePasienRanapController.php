<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResumePasienRanapRequest;
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

    function insert(ResumePasienRanapRequest $request)
    {
        try {
            $data = $request->validated();
			$isAvailResume = $this->resume->where('no_rawat', $data['no_rawat'])->first();
			if($isAvailResume){
				return $this->edit($request);
			}
            $resume = $this->resume->create($data);
            if ($resume) {
                $this->track->insertSql($this->resume, $data);

            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
        return response()->json('Sukses');
    }

    function edit(ResumePasienRanapRequest $request)
    {
        try {
	    $data = $request->validated();
            $update = $this->resume->where('no_rawat', $data['no_rawat'])->update($data);
            if ($update) {
                $this->track->updateSql($this->resume, $data, ['no_rawat', $data['no_rawat']]);
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }

        return response()->json('Sukses');
    }
}
