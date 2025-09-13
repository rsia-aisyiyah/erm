<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PemeriksaanRalanRequest extends FormRequest
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
            'nip' => 'required',
            'no_rawat' => 'required',
            'jam_rawat' => 'required',
            'suhu_tubuh' => 'required',
            'tensi' => 'required',
            'nadi' => 'required',
            'respirasi' => 'required',
            'tinggi' => 'required',
            'berat' => 'required',
            'spo2' => 'required',
            'gcs' => 'required',
            'kesadaran' => 'required',
            'keluhan' => 'required',
            'pemeriksaan' => 'required',
            'alergi' => 'required',
            'rtl' => 'required',
            'penilaian' => 'required',
            'instruksi' => 'required',
            'evaluasi' => 'required',
            'lingkar_perut' => 'required',
        ];
    }

    public function pemeriksaanData()
    {
        return [
            'suhu_tubuh' => $this->suhu_tubuh,
            'tensi' => $this->tensi,
            'jam_rawat' => $this->jam_rawat ?? date('H:i:s'),
            'nadi' => $this->nadi,
            'respirasi' => $this->respirasi,
            'tinggi' => $this->tinggi,
            'berat' => $this->berat,
            'spo2' => $this->spo2,
            'gcs' => $this->gcs,
            'kesadaran' => $this->kesadaran,
            'keluhan' => $this->keluhan,
            'pemeriksaan' => $this->pemeriksaan,
            'alergi' => $this->alergi ?: '-',
            'rtl' => $this->rtl ?: '-',
            'penilaian' => $this->penilaian ?: '-',
            'instruksi' => $this->instruksi ?: '-',
            'evaluasi' => $this->evaluasi ?: '-',
            'lingkar_perut' => '-',
        ];
    }
}
