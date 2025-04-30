<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RsiaGeneralConsent;
use Illuminate\Support\Facades\Storage;

class RsiaGeneralConsentController extends Controller
{
    protected $consent;
    public function __construct()
    {
        $this->consent = new RsiaGeneralConsent();
    }
    public function index($loket = '')
    {
        return view('content.registrasi.persetujuan_umum', [$loket]);
    }
    public function tambah(Request $request)
    {
        $consent = $this->consent;

        $consent->create([
            'no_rawat' => $request->no_rawat,
            'tgl_persetujuan' => date('Y-m-d'),
            'jam_persetujuan' => date('h:i:s'),
            'loket' => $request->loket,
            'no_rkm_medis' => $request->no_rkm_medis,
            'nik' => $request->nik,
        ]);

        return response()->json($consent);
    }
    public function ambil(Request $request)
    {
        $consent = $this->consent->where('status', '0')->where('tgl_persetujuan', date('Y-m-d'))->where('loket', $request->loket)->orderBy('id', 'DESC')->first();
        return response()->json($consent);
    }
    public function simpanTtd(Request $request)
    {
        $data_uri = $request->image;
        $no_rawat = $request->no_rawat;
        $image_part = explode(';base64,', $data_uri);
        $image_type = explode('data:image/', $image_part[0])[1];
        $base = base64_decode($image_part[1]);
        $no_rawat_text = str_replace('/', '', $no_rawat);
        $name = $no_rawat_text . '.' . $image_type;
        $storage = Storage::disk('public_upload')->put(
            'ttd/' . $name,
            $base
        );



        if ($storage) {
            $consent = $this->consent::where('no_rawat', $no_rawat)->update([
                'ttd' => $name,
                'status' => '1',
            ]);
        }

        return $consent;
    }

    function delete(Request $request)
    {
        $general = $this->consent->where('no_rawat', $request->no_rawat)->delete();
        return response()->json($general);
    }
}
