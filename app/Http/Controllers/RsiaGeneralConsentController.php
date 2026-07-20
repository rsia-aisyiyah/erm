<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RsiaGeneralConsent;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Str;

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


    public function save(Request $request)
    {
        $request->validate([
            'signature' => 'required',
            'no_rawat' => 'required'
        ]);

        try {

            $exist = DB::table('rsia_persetujuan_umum')
                ->where('no_rawat', $request->no_rawat)
                ->exists();

            if ($exist) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Persetujuan untuk No. Rawat ini sudah ada.'
                ], 400); // 400 Bad Request
            }

            $data = trim($request->signature);
            if (strpos($data, 'base64,') !== false) {
                $parts = explode('base64,', $data);
                $data = end($parts);
            }

            $binary = base64_decode($data);

            if ($binary === false) {
                throw new Exception('Signature base64 tidak valid.');
            }

            $fileName = Str::uuid() . '.png';

            Storage::disk('public_upload')->put(
                'ttd/' . $fileName,
                $binary
            );

            $signaturePath = Storage::disk('public_upload')->path(
                'ttd/' . $fileName
            );

            $reg = DB::table('reg_periksa')
                ->join(
                    'pasien',
                    'pasien.no_rkm_medis',
                    '=',
                    'reg_periksa.no_rkm_medis'
                )
                ->join(
                    'dokter',
                    'dokter.kd_dokter',
                    '=',
                    'reg_periksa.kd_dokter'
                )
                ->join(
                    'poliklinik',
                    'poliklinik.kd_poli',
                    '=',
                    'reg_periksa.kd_poli'
                )
                ->select(
                    'reg_periksa.*',
                    'pasien.*',
                    'dokter.nm_dokter',
                    'poliklinik.nm_poli'
                )
                ->where('no_rawat', $request->no_rawat)
                ->first();

            if (!$reg) {
                throw new Exception('Data pasien tidak ditemukan.');
            }

            $uuid = (string) Str::uuid();
            $verifyUrl = config('app.verify_docs') . '/persetujuan_umum/' . $uuid;
            $pdf = Pdf::loadView(
                'content.print.persetujuan_umum',
                [
                    'petugas' => session()->get('pegawai'),
                    'reg' => $reg,
                    'signature' => $signaturePath,
                    'verifyUrl' => $verifyUrl,
                ]
            );

            $pdfName = 'GC_' . $uuid . '.pdf';

            Storage::disk('general_consent')->put(
                $pdfName,
                $pdf->output()
            );

            Storage::disk('public_upload')->delete(
                'ttd/' . $fileName
            );


            $hash = hash_file(
                'sha256',
                Storage::disk('general_consent')
                    ->path($pdfName)
            );

            DB::table('rsia_persetujuan_umum')->insert([
                'uuid' => $uuid,
                'no_rawat' => $request->no_rawat,
                'nip' => session('pegawai')->nik,
                'file' => $pdfName,
                'hash' => $hash,
                'signed_at' => $request->signed_at ?? now(),
            ]);

            return response()->json([
                'status' => true,
                'pdf' => $pdfName
            ]);

        } catch (\Throwable $e) {

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);

        }
    }

    function verify(Request $request, $uuid)
    {
        $consent = DB::table('rsia_persetujuan_umum')
            ->where('uuid', $uuid)
            ->first();

        if (!$consent) {
            return response()->json([
                'status' => false,
                'message' => 'Persetujuan umum tidak ditemukan.'
            ], 404);
        }

        $filePath = Storage::disk('general_consent')->path(
            $consent->file
        );

        $fileUrl = Storage::disk('general_consent')->url($consent->file);

        if (!file_exists($filePath)) {
            return response()->json([
                'status' => false,
                'message' => 'File persetujuan umum tidak ditemukan.'
            ], 404);
        }

        $hash = hash_file('sha256', $filePath);

        if ($hash !== $consent->hash) {
            return response()->json([
                'status' => false,
                'message' => 'File persetujuan umum telah diubah atau rusak.'
            ], 400);
        }

        return response()->json([
            'status' => true,
            'message' => 'File persetujuan umum valid.',
            'data' => [
                'no_rawat' => $consent->no_rawat,
                'nip' => $consent->nip,
                'signed_at' => $consent->signed_at,
                'file_url' => $fileUrl
            ]
        ]);
    }
    public function get(Request $request)
    {
        $data = DB::table('rsia_persetujuan_umum')->where('no_rawat', $request->no_rawat)->first();

        if ($data) {
            return response()->json([
                'exists' => true,
                'file_url' => asset('storage/general-consent/' . $data->file)
            ]);
        }

        return response()->json(['exists' => false]);
    }

}
