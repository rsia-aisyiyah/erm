<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookingRegistrasi;
use App\Http\Controllers\RegPeriksaController;
use Illuminate\Database\QueryException;

class BookingRegistrasiController extends Controller
{
    protected $booking;
    protected $regPeriksa;
    protected $track;
    public function __construct()
    {
        $this->booking = new BookingRegistrasi();
        $this->regPeriksa = new RegPeriksaController();
        $this->track = new TrackerSqlController();
    }

    public function setNoReg($tanggal, $poli, $dokter)
    {
        return $this->regPeriksa->setNoReg($tanggal, $poli, $dokter);
    }

    public function create(Request $request)
    {
        $data = [
            'tanggal_booking' => date('Y-m-d'),
            'jam_booking' => date('H:i:s'),
            'no_rkm_medis' => $request->no_rkm_medis,
            'kd_dokter' => $request->kd_dokter,
            'kd_poli' => $request->kd_poli,
            'no_reg' => $this->setNoReg($request->tanggal, $request->kd_poli, $request->kd_dokter),
            'kd_pj' => 'A03',
            'tanggal_periksa' => $request->tanggal,
            'limit_reg' => '0',
            'waktu_kunjungan' => date('Y-m-d H:i:s'),
            'status' => 'Terdaftar',
        ];
        try {
            $booking = $this->booking->create($data);
            $track = $this->track->create($this->track->insertSql($this->booking, $data));
            return response()->json(['metaData' => ['Status' => 'OK', 'Code' => 200], 'response' => $this->getBooking($request->no_rkm_medis), 'qury' => $track]);
        } catch (QueryException $e) {
            return response()->json(['metaData' => ['Status' => 'FAILED', 'Code' => 400], 'response' => $e->errorInfo]);
        }


        // return response()->json(['metaData' => ['Status' => 'OK', 'Code' => 200], 'response' => $this->getBooking($request->no_rkm_medis)]);
    }

    function getBooking($no_rkm_medis)
    {
        $booking = $this->booking->with('pasien')
            ->where('no_rkm_medis', $no_rkm_medis)->orderBy('tanggal_periksa', 'DESC')->first();
        return $booking;
    }
}
