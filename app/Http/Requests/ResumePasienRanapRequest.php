<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResumePasienRanapRequest extends FormRequest
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
		    'no_rawat'              => 'required|string|max:17',
		    'kd_dokter'             => 'required|string|max:20',
		    'diagnosa_awal'         => 'required|string|max:100',
		    'alasan'                => 'required|string|max:100',
		    'keluhan_utama'         => 'required|string',
		    'pemeriksaan_fisik'     => 'required|string',
		    'jalannya_penyakit'     => 'nullable|string',
		    'pemeriksaan_penunjang' => 'required|string',
		    'hasil_laborat'         => 'required|string',
		    'tindakan_dan_operasi'  => 'required|string',
		    'obat_di_rs'            => 'required|string',

		    'diagnosa_utama'        => 'required|string|max:80',
		    'kd_diagnosa_utama'     => 'required|string|max:10',

		    'diagnosa_sekunder'     => 'nullable|string|max:80',
		    'kd_diagnosa_sekunder'  => 'nullable|string|max:10',
		    'diagnosa_sekunder2'    => 'nullable|string|max:80',
		    'kd_diagnosa_sekunder2' => 'nullable|string|max:10',
		    'diagnosa_sekunder3'    => 'nullable|string|max:80',
		    'kd_diagnosa_sekunder3' => 'nullable|string|max:10',
		    'diagnosa_sekunder4'    => 'nullable|string|max:80',
		    'kd_diagnosa_sekunder4' => 'nullable|string|max:10',
		    'diagnosa_sekunder5'    => 'nullable|string|max:80',
		    'kd_diagnosa_sekunder5' => 'nullable|string|max:10',
		    'diagnosa_sekunder6'    => 'nullable|string|max:80',
		    'kd_diagnosa_sekunder6' => 'nullable|string|max:10',
		    'diagnosa_sekunder7'    => 'nullable|string|max:80',
		    'kd_diagnosa_sekunder7' => 'nullable|string|max:10',

		    'prosedur_utama'        => 'required|string|max:80',
		    'kd_prosedur_utama'     => 'required|string|max:8',
		    'prosedur_sekunder'     => 'nullable|string|max:80',
		    'kd_prosedur_sekunder'  => 'nullable|string|max:8',
		    'prosedur_sekunder2'    => 'nullable|string|max:80',
		    'kd_prosedur_sekunder2' => 'nullable|string|max:8',
		    'prosedur_sekunder3'    => 'nullable|string|max:80',
		    'kd_prosedur_sekunder3' => 'nullable|string|max:8',

		    'alergi'                => 'nullable|string|max:100',
		    'diet'                  => 'nullable|string',
		    'lab_belum'             => 'nullable|string',
		    'edukasi'               => 'required|string',

		    'cara_keluar'           => 'required|in:Atas Izin Dokter,Pindah RS,Pulang Atas Permintaan Sendiri,Lainnya',
		    'ket_keluar'            => 'nullable|string|max:50',
		    'keadaan'               => 'required|in:Membaik,Sembuh,Keadaan Khusus,Meninggal',
		    'ket_keadaan'           => 'nullable|string|max:50',
		    'dilanjutkan'           => 'required|in:Kembali Ke RS,RS Lain,Dokter Luar,Puskesmes,Lainnya',
		    'ket_dilanjutkan'       => 'nullable|string|max:50',
		    'kontrol'               => 'nullable|date',
		    'obat_pulang'           => 'required|string',

		    'shk'                   => 'nullable|in:Tidak,Ya,-,Belum,Sudah',
		    'shk_keterangan'        => 'nullable|string',
	    ];
    }

	public function attributes(): array
	{
		return [
			'no_rawat' => 'Nomor Rawat',
			'kd_dokter' => 'Kode Dokter',
			'diagnosa_awal' => 'Diagnosa Awal',
			'pemeriksaan_fisik' => 'Pemeriksaan Fisik',
			'cara_keluar' => 'Cara Keluar',
			'keadaan' => 'Keadaan Pasien',
			'dilanjutkan' => 'Rencana Lanjutan',
		];
	}
}
