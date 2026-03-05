<?php

namespace App\Http\Controllers;

use App\Models\KlinisResepAntibiotik;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class KlinisResepAntibiotikController extends Controller
{
    use ResponseTrait;
    public function create(Request $request)
    {
        $data = request()->validate([
            'no_rawat' => 'required',
            'kode_brng' => 'required',
            'no_resep' => 'required',
            'indikasi_penggunaan' => 'required',
            'catatan_klinis' => 'required',
        ]);
        $data['tanggal_input'] = now();

        try {
            $klinisResepAntibiotik = KlinisResepAntibiotik::updateOrCreate(
                [
                    'no_rawat' => $data['no_rawat'],
                    'kode_brng' => $data['kode_brng'],
                    'no_resep' => $data['no_resep'],
                ],
                $data
            );
            return $this->successResponse($klinisResepAntibiotik, 'Data klinis resep antibiotik berhasil disimpan');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 'Gagal menyimpan data klinis resep antibiotik');
        }
    }

    public function get(Request $request)
    {

        try {
            $klinisResepAntibiotik = KlinisResepAntibiotik::where('no_rawat', $request->no_rawat)
                ->where('kode_brng', $request->kode_brng)
                ->where('no_resep', $request->no_resep)
                ->first();
            return $this->successResponse($klinisResepAntibiotik, 'Data klinis resep antibiotik berhasil diambil');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 'Gagal mengambil data klinis resep antibiotik');
        }
    }
    public function delete(Request $request)
    {
        $data = request()->validate([
            'no_rawat' => 'required',
            'kode_brng' => 'required',
            'no_resep' => 'required',
        ]);

        try {
            $klinisResepAntibiotik = KlinisResepAntibiotik::where('no_rawat', $data['no_rawat'])
                ->where('kode_brng', $data['kode_brng'])
                ->where('no_resep', $data['no_resep'])
                ->first();

            if ($klinisResepAntibiotik) {
                $klinisResepAntibiotik->delete();
                return $this->successResponse(null, 'Data klinis resep antibiotik berhasil dihapus');
            } else {
                return $this->errorResponse(null, 'Data klinis resep antibiotik tidak ditemukan');
            }
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 'Gagal menghapus data klinis resep antibiotik');
        }
    }
}
