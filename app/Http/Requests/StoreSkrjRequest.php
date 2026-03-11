<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSkrjRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'no_sep' => 'required|string|max:30',
            'tgl_surat' => 'required|date',
            'no_surat' => 'required|string|max:50',
            'tgl_rencana' => 'required|date',
            'kd_dokter_bpjs' => 'required|string|max:20',
            'nm_dokter_bpjs' => 'required|string|max:100',
            'kd_poli_bpjs' => 'required|string|max:20',
            'nm_poli_bpjs' => 'required|string|max:100',
        ];
    }
}
