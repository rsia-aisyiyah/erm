<?php

namespace App\Http\Controllers;

use App\Models\RsiaVerifPemeriksaanRanap;
use App\Services\AuthVerificationService;
use Illuminate\Http\Request;

class RsiaVerifPemeriksaanRanapController extends Controller
{
    protected $verif;
    protected $track;


    public function __construct()
    {
        $this->verif = new RsiaVerifPemeriksaanRanap();
        $this->track = new TrackerSqlController();
    }

    function create(AuthVerificationService $authVeif, Request $request)
    {
        $data = $request->validate([
            'no_rawat' => 'required',
            'tgl_perawatan' => 'required',
            'jam_rawat' => 'required',

        ]);
        $data = array_merge($data, [
            'tgl_verif' => date('Y-m-d'),
            'jam_verif' => date('H:i:s'),
            'verifikator' => session()->get('pegawai')->nik,
        ]);

        $isVerified = $authVeif->verifyPassword($request->password);

        if (!$isVerified) {
            return response()->json(['message' => 'Password salah'], 422);
        }

        try {
            $verif = $this->verif->create($data);
            $this->track->insertSql($this->verif, $data);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }

        return response()->json($verif);
    }
}
