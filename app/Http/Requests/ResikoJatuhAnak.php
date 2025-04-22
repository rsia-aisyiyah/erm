<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResikoJatuhAnak extends FormRequest
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
            'penilaian_humptydumpty_skala1' => 'required|string',
            'penilaian_humptydumpty_skala2' => 'required|string',
            'penilaian_humptydumpty_skala3' => 'required|string',
            'penilaian_humptydumpty_skala4' => 'required|string',
            'penilaian_humptydumpty_skala5' => 'required|string',
            'penilaian_humptydumpty_skala6' => 'required|string',
            'penilaian_humptydumpty_skala7' => 'required|string',
            'penilaian_humptydumpty_nilai1' => 'required|integer',
            'penilaian_humptydumpty_nilai2' => 'required|integer',
            'penilaian_humptydumpty_nilai3' => 'required|integer',
            'penilaian_humptydumpty_nilai4' => 'required|integer',
            'penilaian_humptydumpty_nilai5' => 'required|integer',
            'penilaian_humptydumpty_nilai6' => 'required|integer',
            'penilaian_humptydumpty_nilai7' => 'required|integer',
            'penilaian_humptydumpty_totalnilai' => 'required|integer',
            'hasil_skrining' => 'required|string',
            'saran' => 'required|string',
            'nip' => 'required|string',
        ];
    }
}
