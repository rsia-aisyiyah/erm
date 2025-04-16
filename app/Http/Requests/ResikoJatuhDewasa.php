<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResikoJatuhDewasa extends FormRequest
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
            'no_rawat' => 'required|string',
            'tanggal' => 'required|date',
            'penilaian_jatuhmorse_skala1' => 'required|string',
            'penilaian_jatuhmorse_skala2' => 'required|string',
            'penilaian_jatuhmorse_skala3' => 'required|string',
            'penilaian_jatuhmorse_skala4' => 'required|string',
            'penilaian_jatuhmorse_skala5' => 'required|string',
            'penilaian_jatuhmorse_skala6' => 'required|string',
            'penilaian_jatuhmorse_nilai1' => 'required|integer',
            'penilaian_jatuhmorse_nilai2' => 'required|integer',
            'penilaian_jatuhmorse_nilai3' => 'required|integer',
            'penilaian_jatuhmorse_nilai4' => 'required|integer',
            'penilaian_jatuhmorse_nilai5' => 'required|integer',
            'penilaian_jatuhmorse_nilai6' => 'required|integer',
            'penilaian_jatuhmorse_totalnilai' => 'required|integer',
            'hasil_skrining' => 'required|string',
            'saran' => 'required|string',
            'nip' => 'required|string',
        ];
    }
}
