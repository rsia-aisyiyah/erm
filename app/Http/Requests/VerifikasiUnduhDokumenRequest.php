<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VerifikasiUnduhDokumenRequest extends FormRequest
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
            'no_rkm_medis' => ['required', 'string', 'max:20'],
            'tgl_lahir' => ['required', 'date_format:Y-m-d'],
        ];
    }

    public function messages(): array
    {
        return [
            'no_rkm_medis.required' => 'Nomor rekam medis wajib diisi.',
            'tgl_lahir.required' => 'Tanggal lahir wajib diisi.',
        ];
    }
}
