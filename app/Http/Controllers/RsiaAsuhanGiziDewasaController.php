<?php

namespace App\Http\Controllers;

use App\Models\RsiaAsuhanGiziDewasa;
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
}
