<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Override;

class HasilKritisRequest extends FormRequest
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
            'hasil' => 'required|string|max:1000',
            'petugas' => 'required|string|max:20',
            'tgl' => 'nullable',
            'petugas_ruang' => 'required|string|max:20',
            'tgl_ruang' => 'nullable',
            'dokter' => 'required|string|max:20',
            'tgl_dokter' => 'nullable',
            'dokter_pj' => 'required|string|max:20',
            'tgl_drpj' => 'nullable',
        ];
    }

    // #[Override]
    // public function merge(array $input)
    // {
    //     return array_merge($input, [
    //         'tgl' => !empty($input['tgl'])
    //             ? \Carbon\Carbon::createFromFormat('d-m-Y H:i:s', $input['tgl'])->format('Y-m-d H:i:s')
    //             : null,

    //         'tgl_ruang' => !empty($input['tgl_ruang'])
    //             ? \Carbon\Carbon::createFromFormat('d-m-Y H:i:s', $input['tgl_ruang'])->format('Y-m-d H:i:s')
    //             : null,

    //         'tgl_dokter' => !empty($input['tgl_dokter'])
    //             ? \Carbon\Carbon::createFromFormat('d-m-Y H:i:s', $input['tgl_dokter'])->format('Y-m-d H:i:s')
    //             : null,
    //     ]);
    // }

    protected function prepareForValidation()
    {
        $this->merge([
            'tgl' => filled($this->tgl)
                ? \Carbon\Carbon::createFromFormat('d-m-Y H:i:s', $this->tgl)->format('Y-m-d H:i:s')
                : now()->format('Y-m-d H:i:s'),

            'tgl_ruang' => filled($this->tgl_ruang)
                ? \Carbon\Carbon::createFromFormat('d-m-Y H:i:s', $this->tgl_ruang)->format('Y-m-d H:i:s')
                : NULL,

            'tgl_dokter' => filled($this->tgl_dokter)
                ? \Carbon\Carbon::createFromFormat('d-m-Y H:i:s', $this->tgl_dokter)->format('Y-m-d H:i:s')
                : NULL,
        ]);
    }

    public function messages()
    {
        return [
            'no_rawat.required' => 'No. rawat wajib diisi.',
            'no_rawat.string' => 'No. rawat harus berupa teks.',

            'hasil.required' => 'Hasil kritis wajib diisi.',
            'hasil.string' => 'Hasil kritis harus berupa teks.',

            'petugas.required' => 'Petugas wajib diisi.',
            'petugas.string' => 'Petugas harus berupa teks.',

            'petugas_ruang.required' => 'Petugas ruang wajib diisi.',

            'dokter.required' => 'Dokter wajib diisi.',
            'dokter_pj.required' => 'Dokter PJ wajib diisi.',

        ];
    }


}
