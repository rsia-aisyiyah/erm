<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CatatanAdimeGiziRequest extends FormRequest
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
            'tanggal' => 'required|date_format:Y-m-d H:i:s',
            'asesmen' => 'required|string|max:1000',
            'diagnosis' => 'required|string|max:1000',
            'intervensi' => 'required|string|max:1000',
            'monitoring' => 'required|string|max:1000',
            'evaluasi' => 'required|string|max:1000',
            'instruksi' => 'required|string|max:1000',
            'nip' => 'required|string|max:20',
        ];
    }
}
