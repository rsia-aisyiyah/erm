<?php

namespace App\Http\Controllers;

use App\Models\SkoringTb;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Yajra\DataTables\DataTables;
use Illuminate\Database\QueryException;

class SkoringTbController extends Controller
{
    protected $track;
    function __construct()
    {
        $this->track = new TrackerSqlController();
    }


    function create(Request $request)
    {
        $data = [
            'no_rawat' => $request->no_rawat,
            'kd_dokter' => $request->kd_dokter,
            'kontak' => $request->kontak,
            'demam' => $request->demam,
            'berat' => $request->berat,
            'batul' => $request->batul,
            'pembesaran' => $request->pembesaran,
            'pembengkakan' => $request->pembengkakan,
            'thorax' => $request->thorax,
            'mantoux' => $request->mantoux,
            'ket_kontak' => $request->ket_kontak,
            'ket_mantoux' => $request->ket_mantoux,
            'ket_berat' => $request->ket_berat,
            'ket_demam' => $request->ket_demam,
            'ket_batul' => $request->ket_batul,
            'ket_pembesaran' => $request->ket_pembesaran,
            'ket_pembengkakan' => $request->ket_pembengkakan,
            'ket_thorax' => $request->ket_thorax,
            'total_skrining' => $request->total_skrining,
            'tgl_skrining' => date('Y-m-d'),
            'jam_skrining' => date('H:i:s'),
        ];
        if ($request->id) {
            $find = SkoringTb::where('id', $request->id)->first();
            if ($find) {
                $this->update($request);
                return true;
            }
        }

        try {
            $skrining = SkoringTb::create($data);
            if ($skrining) {
                $this->track->insertSql(new SkoringTb(), $data);
            }
            return response('SUKSES', 201);
        } catch (QueryException $e) {
            return response($e->errorInfo, 500);
        }
    }

    function get(Request $request)
    {
        $skrining = new SkoringTb();
        if ($request->id) {
            $skrining = $skrining->where('id', $request->id)
                ->with(['regPeriksa' => function ($query) {
                    $query->select(['no_rawat', 'umurdaftar', 'sttsumur', 'p_jawab', 'hubunganpj']);
                }, 'penjab', 'pasien' => function ($query) {
                    return $query->with(['kec', 'kab']);
                }, 'dokter', 'kamar'])
                ->first();
        }
        if ($request->no_rawat) {
            $skrining = $skrining->where('no_rawat', $request->no_rawat)
	            ->with(['regPeriksa' => function ($query) {
		            $query->select(['no_rawat', 'umurdaftar', 'sttsumur', 'p_jawab', 'hubunganpj']);
	            }, 'penjab', 'pasien' => function ($query) {
		            return $query->with(['kec', 'kab']);
	            }, 'dokter', 'kamar'])->get();
        }

        if ($request->dataTable) {
            return DataTables::of($skrining)->make(true);
        }

        return response()->json($skrining);
    }

    function update(Request $request)
    {
        $data = [
            'kontak' => $request->kontak,
            'demam' => $request->demam,
            'berat' => $request->berat,
            'batul' => $request->batul,
            'pembesaran' => $request->pembesaran,
            'pembengkakan' => $request->pembengkakan,
            'thorax' => $request->thorax,
            'mantoux' => $request->mantoux,
            'ket_kontak' => $request->ket_kontak,
            'ket_mantoux' => $request->ket_mantoux,
            'ket_berat' => $request->ket_berat,
            'ket_demam' => $request->ket_demam,
            'ket_batul' => $request->ket_batul,
            'ket_pembesaran' => $request->ket_pembesaran,
            'ket_pembengkakan' => $request->ket_pembengkakan,
            'ket_thorax' => $request->ket_thorax,
            'total_skrining' => $request->total_skrining,
        ];
        try {
            $skrining = SkoringTb::where('id', $request->id)->update($data);
            if ($skrining) {
                $this->track->updateSql(new SkoringTb(), $data, ['id' => $request->id]);
            }
            return response()->json('SUKSES');
        } catch (QueryException $e) {
            return response()->json($e->errorInfo);
        }
    }
    function delete(Request $request)
    {
        $skrining = SkoringTb::where('id', $request->id);
        $getNoRawat = $skrining->select('no_rawat')->first();
        try {
            $delete = $skrining->delete();
            if ($delete) {
                $this->track->deleteSql(new SkoringTb(), ['id' => $request->id]);
            }
            return response()->json($getNoRawat);
        } catch (QueryException $e) {
            return response()->json($e->errorInfo);
        }
    }

    function print($id)
    {
        $skrining = $this->get(new \Illuminate\Http\Request(['id' => $id]))->getContent();
        $data = json_decode($skrining);
        $data->finger = $this->setFingerOutput($data->dokter->nm_dokter, bcrypt($data->dokter->kd_dokter), $data->tgl_skrining);
        $file = Pdf::loadView('content.print.skoringTb', ['data' => $data])
            ->setOption(['defaultFont' => 'serif', 'isRemoteEnabled' => true])
            ->setPaper(array(0, 0, 595, 935));
        return $file->stream($data->pasien->no_rkm_medis . date('YmdHis') . '.pdf');
    }
    function setFingerOutput($dokter, $id, $tanggal)
    {
        $strId = sha1($id);
        return $str = "Ditandatangani di RSIA Aisiyiyah Pekajangan Kab. Pekalongan, Ditandatangani Elektronik Oleh $dokter, ID $strId, $tanggal";
    }
}
