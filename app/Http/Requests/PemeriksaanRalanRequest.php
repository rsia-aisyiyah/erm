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

        ];
    }

    public function pemeriksaanData()
    {
        return [
            'suhu_tubuh' => $this->suhu_tubuh,
            'tensi' => $this->tensi,
            'tgl_perawatan' => $this->tgl_perawatan ?? date('Y-m-d'),
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
