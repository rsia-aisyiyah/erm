<?php

namespace App\Http\Controllers;

use App\Models\SkriningTb;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Yajra\DataTables\DataTables;
use Illuminate\Database\QueryException;

class SkriningTbController extends Controller
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
            'berat' => $request->berat,
            'berdahak' => $request->berdahak,
            'berdahakB' => $request->berdahakB,
            'demam' => $request->demam,
            'nip' => session()->get('pegawai')->nik,
            'kelenjar' => $request->kelenjar,
            'keluarga' => $request->keluarga,
            'keringat' => $request->keringat,
            'obat' => $request->obat,
            'penyakit' => $request->penyakit,
            'sesak' => $request->sesak,
        ];
        if ($request->id) {
            $find = SkriningTb::where('id', $request->id)->first();
            if ($find) {
                $this->update($request);
                return true;
            }
        }

        try {
            $skrining = SkriningTb::create($data);
            if ($skrining) {
                $this->track->insertSql(new SkriningTb(), $data);
            }
            return response('SUKSES', 201);
        } catch (QueryException $e) {
            return response($e->errorInfo, 500);
        }
    }

    function get(Request $request)
    {
        $skrining = new SkriningTb();
        if ($request->id) {
            $skrining = $skrining->where('id', $request->id)
                ->with(['pegawai', 'regPeriksa.dokter', 'pasien' => function ($query) {
                    return $query->with(['kec', 'kab']);
                }])->first();
        }
        if ($request->no_rawat) {
            $skrining = $skrining->where('no_rawat', $request->no_rawat)
                ->with('pegawai', 'regPeriksa')->get();
        }

        if ($request->dataTable) {
            return DataTables::of($skrining)->make(true);
        }

        return response()->json($skrining);
    }

    function update(Request $request)
    {
        $data = [
            'nip' => session()->get('pegawai')->nik,
            'berat' => $request->berat,
            'berdahak' => $request->berdahak,
            'berdahakB' => $request->berdahakB,
            'demam' => $request->demam,
            'kelenjar' => $request->kelenjar,
            'keluarga' => $request->keluarga,
            'keringat' => $request->keringat,
            'obat' => $request->obat,
            'penyakit' => $request->penyakit,
            'sesak' => $request->sesak,
        ];

        try {
            $skrining = SkriningTb::where('id', $request->id)->update($data);
            if ($skrining) {
                $this->track->updateSql(new SkriningTb(), $data, ['id' => $request->id]);
            }
            return response()->json('SUKSES');
        } catch (QueryException $e) {
            return response()->json($e->errorInfo);
        }
    }
    function delete(Request $request)
    {
        $skrining = SkriningTb::where('id', $request->id);
        $getNoRawat = $skrining->select('no_rawat')->first();
        try {
            $delete = $skrining->delete();
            if ($delete) {
                $this->track->deleteSql(new SkriningTb(), ['id' => $request->id]);
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
        // return $data;
        $data->finger = $this->setFingerOutput($data->pegawai->nama, bcrypt($data->pegawai->nik), date('Y-m-d H:i:s'));
        $data->fingerDokter = $this->setFingerOutput($data->reg_periksa->dokter->nm_dokter, bcrypt($data->reg_periksa->dokter->kd_dokter), date('Y-m-d H:i:s'));
        $file = Pdf::loadView('content.print.skriningTb', ['data' => $data])
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
