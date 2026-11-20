<?php

namespace App\Http\Requests;

use DB;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

class StoreDishcarePlanning extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'no_rawat' => 'required|string|max:17',
            'rencana_rawat' => 'required|integer|min:0|gt:0',
            'tgl_rencana_pulang' => 'required|date',
            'diagnosa_keluar' => 'nullable|string|max:255',
            'kondisi_pulang' => 'nullable|string|max:255',
            'mobilisasi' => 'nullable|string|max:255',
            'alat_terpasang' => 'nullable|string|max:255',
            'penyuluhan' => 'nullable|string|max:255',
            'penyuluhan_lain' => 'nullable|string|max:255',
            'dokumen_penunjang' => 'nullable|string|max:255',
            'obat_pulang' => 'nullable|string|max:255',
            'target_asuhan' => 'nullable|string|max:255',
            'diet_dirumah' => 'nullable|string|max:255',
            'instruksi' => 'nullable|string|max:255',
            'nip' => 'required|string|max:18',
        ];
    }

    public function messages()
    {
        return [
            'no_rawat.required' => 'No Rawat harus diisi.',
            'rencana_rawat.required' => 'Rencana rawat harus diisi.',
            'rencana_rawat.gt' => 'Rencana rawat harus lebih besar dari 0.',
            'tgl_rencana_pulang.required' => 'Tanggal rencana pulang harus diisi.',
            'diagnosa_keluar.required' => 'Diagnosa keluar harus diisi.',
            'nip.required' => 'NIP harus diisi.',
        ];
    }

    public function attributes()
    {
        return [
            'no_rawat' => 'No Rawat',
            'rencana_rawat' => 'Rencana Rawat',
            'tgl_rencana_pulang' => 'Tanggal Rencana Pulang',
            'diagnosa_keluar' => 'Diagnosa Keluar',
            'kondisi_pulang' => 'Kondisi Pulang',
            'mobilisasi' => 'Mobilisasi',
            'alat_terpasang' => 'Alat Terpasang',
            'penyuluhan' => 'Penyuluhan',
            'penyuluhan_lain' => 'Penyuluhan Lain',
            'dokumen_penunjang' => 'Dokumen Penunjang',
            'obat_pulang' => 'Obat Pulang',
            'target_asuhan' => 'Target Asuhan',
            'diet_dirumah' => 'Diet di Rumah',
            'instruksi' => 'Instruksi',
            'nip' => 'NIP',
        ];
    }

    public function response(array $errors)
    {
        return response()->json($errors, 422);
    }
    protected function prepareForValidation()
    {

        $isUpdate = DB::table('rsia_discharge_planning')->where('no_rawat', $this->no_rawat)->get();

        if (!$isUpdate) {
            $this->merge([
                'tanggal' => Carbon::now()->format('Y-m-d H:i:s'),
                'diagnosa_keluar' => $this->diagnosa_keluar ?? '-',
            ]);
        } else {
            $this->request->remove('tanggal');
        }
    }

}