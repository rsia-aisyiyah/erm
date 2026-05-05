<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AskepRanapAnakRequest extends FormRequest
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
            // Identitas & Waktu
            'no_rawat' => 'required|string|max:20',
            'tanggal' => 'required|date_format:Y-m-d H:i:s',
            'informasi' => 'required|string',
            'ket_informasi' => 'required|string',
            'tiba_diruang_rawat' => 'required|string',

            // Riwayat Kesehatan & Kebiasaan
            'kasus_trauma' => 'nullable|string',
            'cara_masuk' => 'required|string',
            'rps' => 'required|string',
            'rpd' => 'required|string',
            'rpk' => 'required|string',
            'rpo' => 'required|string',
            'riwayat_pembedahan' => 'required|string',
            'riwayat_dirawat_dirs' => 'required|string',
            'alat_bantu_dipakai' => 'required|string',
            'riwayat_kehamilan' => 'required|string',
            'riwayat_kehamilan_perkiraan' => 'required|string',
            'riwayat_tranfusi' => 'required|string',
            'riwayat_alergi' => 'required|string',
            'riwayat_merokok' => 'required|string',
            'riwayat_merokok_jumlah' => 'required|string',
            'riwayat_alkohol' => 'required|string',
            'riwayat_alkohol_jumlah' => 'required|string',
            'riwayat_narkoba' => 'required|string',
            'riwayat_olahraga' => 'required|string',

            // Pemeriksaan Umum & Vital Signs
            'pemeriksaan_mental' => 'required|string',
            'pemeriksaan_keadaan_umum' => 'required|string',
            'pemeriksaan_gcs' => 'required|string|max:10',
            'pemeriksaan_td' => 'required|string|max:15',
            'pemeriksaan_nadi' => 'required|string|max:10',
            'pemeriksaan_rr' => 'required|string|max:10',
            'pemeriksaan_suhu' => 'required|string|max:10',
            'pemeriksaan_spo2' => 'required|string|max:10',
            'pemeriksaan_bb' => 'required|string',
            'pemeriksaan_tb' => 'required|string',

            // Pemeriksaan Sistem (Head to Toe)
            'pemeriksaan_susunan_kepala' => 'required|string',
            'pemeriksaan_susunan_kepala_keterangan' => 'required|string',
            'pemeriksaan_susunan_wajah' => 'required|string',
            'pemeriksaan_susunan_wajah_keterangan' => 'required|string',
            'pemeriksaan_susunan_leher' => 'required|string',
            'pemeriksaan_susunan_kejang' => 'required|string',
            'pemeriksaan_susunan_kejang_keterangan' => 'required|string',
            'pemeriksaan_susunan_sensorik' => 'required|string',

            // Kardiovaskuler, Respirasi, Gastrointestinal
            'pemeriksaan_kardiovaskuler_denyut_nadi' => 'required|string',
            'pemeriksaan_kardiovaskuler_sirkulasi' => 'required|string',
            'pemeriksaan_kardiovaskuler_sirkulasi_keterangan' => 'required|string',
            'pemeriksaan_kardiovaskuler_pulsasi' => 'required|string',
            'pemeriksaan_respirasi_pola_nafas' => 'required|string',
            'pemeriksaan_respirasi_retraksi' => 'required|string',
            'pemeriksaan_respirasi_suara_nafas' => 'required|string',
            'pemeriksaan_respirasi_volume_pernafasan' => 'required|string',
            'pemeriksaan_respirasi_jenis_pernafasan' => 'required|string',
            'pemeriksaan_respirasi_jenis_pernafasan_keterangan' => 'required|string',
            'pemeriksaan_respirasi_irama_nafas' => 'required|string',
            'pemeriksaan_respirasi_batuk' => 'required|string',
            'pemeriksaan_gastrointestinal_mulut' => 'required|string',
            'pemeriksaan_gastrointestinal_mulut_keterangan' => 'required|string',
            'pemeriksaan_gastrointestinal_gigi' => 'required|string',
            'pemeriksaan_gastrointestinal_gigi_keterangan' => 'required|string',
            'pemeriksaan_gastrointestinal_lidah' => 'required|string',
            'pemeriksaan_gastrointestinal_lidah_keterangan' => 'required|string',
            'pemeriksaan_gastrointestinal_tenggorokan' => 'required|string',
            'pemeriksaan_gastrointestinal_tenggorokan_keterangan' => 'required|string',
            'pemeriksaan_gastrointestinal_abdomen' => 'required|string',
            'pemeriksaan_gastrointestinal_abdomen_keterangan' => 'required|string',
            'pemeriksaan_gastrointestinal_peistatik_usus' => 'required|string',
            'pemeriksaan_gastrointestinal_anus' => 'required|string',

            // Neurologi, Integumen, Muskuloskeletal
            'pemeriksaan_neurologi_pengelihatan' => 'required|string',
            'pemeriksaan_neurologi_pengelihatan_keterangan' => 'required|string',
            'pemeriksaan_neurologi_alat_bantu_penglihatan' => 'required|string',
            'pemeriksaan_neurologi_pendengaran' => 'required|string',
            'pemeriksaan_neurologi_bicara' => 'required|string',
            'pemeriksaan_neurologi_bicara_keterangan' => 'required|string',
            'pemeriksaan_neurologi_sensorik' => 'required|string',
            'pemeriksaan_neurologi_motorik' => 'required|string',
            'pemeriksaan_neurologi_kekuatan_otot' => 'required|string',
            'pemeriksaan_integument_warnakulit' => 'required|string',
            'pemeriksaan_integument_turgor' => 'required|string',
            'pemeriksaan_integument_kulit' => 'required|string',
            'pemeriksaan_integument_dekubitas' => 'required|string',
            'pemeriksaan_muskuloskletal_pergerakan_sendi' => 'required|string',
            'pemeriksaan_muskuloskletal_kekauatan_otot' => 'required|string',
            'pemeriksaan_muskuloskletal_nyeri_sendi' => 'required|string',
            'pemeriksaan_muskuloskletal_nyeri_sendi_keterangan' => 'required|string',
            'pemeriksaan_muskuloskletal_oedema' => 'required|string',
            'pemeriksaan_muskuloskletal_oedema_keterangan' => 'required|string',
            'pemeriksaan_muskuloskletal_fraktur' => 'required|string',
            'pemeriksaan_muskuloskletal_fraktur_keterangan' => 'required|string',

            // Eliminasi & Pola Aktivitas
            'pemeriksaan_eliminasi_bab_frekuensi_jumlah' => 'required|string',
            'pemeriksaan_eliminasi_bab_frekuensi_durasi' => 'required|string',
            'pemeriksaan_eliminasi_bab_konsistensi' => 'required|string',
            'pemeriksaan_eliminasi_bab_warna' => 'required|string',
            'pemeriksaan_eliminasi_bak_frekuensi_jumlah' => 'required|string',
            'pemeriksaan_eliminasi_bak_frekuensi_durasi' => 'required|string',
            'pemeriksaan_eliminasi_bak_warna' => 'required|string',
            'pemeriksaan_eliminasi_bak_lainlain' => 'required|string',
            'pola_aktifitas_makanminum' => 'required|string',
            'pola_aktifitas_mandi' => 'required|string',
            'pola_aktifitas_eliminasi' => 'required|string',
            'pola_aktifitas_berpakaian' => 'required|string',
            'pola_aktifitas_berpindah' => 'required|string',
            'pola_nutrisi_frekuesi_makan' => 'required|string',
            'pola_nutrisi_jenis_makanan' => 'required|string',
            'pola_nutrisi_porsi_makan' => 'required|string',
            'pola_tidur_lama_tidur' => 'required|string',
            'pola_tidur_gangguan' => 'required|string',

            // Pengkajian Fungsi & Psikososial
            'pengkajian_fungsi_kemampuan_sehari' => 'required|string',
            'pengkajian_fungsi_aktifitas' => 'required|string',
            'pengkajian_fungsi_berjalan' => 'required|string',
            'pengkajian_fungsi_berjalan_keterangan' => 'required|string',
            'pengkajian_fungsi_ambulasi' => 'required|string',
            'pengkajian_fungsi_ekstrimitas_atas' => 'required|string',
            'pengkajian_fungsi_ekstrimitas_atas_keterangan' => 'required|string',
            'pengkajian_fungsi_ekstrimitas_bawah' => 'required|string',
            'pengkajian_fungsi_ekstrimitas_bawah_keterangan' => 'required|string',
            'pengkajian_fungsi_menggenggam' => 'required|string',
            'pengkajian_fungsi_menggenggam_keterangan' => 'required|string',
            'pengkajian_fungsi_koordinasi' => 'required|string',
            'pengkajian_fungsi_koordinasi_keterangan' => 'required|string',
            'pengkajian_fungsi_kesimpulan' => 'required|string',
            'riwayat_psiko_kondisi_psiko' => 'required|string',
            'riwayat_psiko_gangguan_jiwa' => 'required|string',
            'riwayat_psiko_perilaku' => 'required|string',
            'riwayat_psiko_perilaku_keterangan' => 'required|string',
            'riwayat_psiko_hubungan_keluarga' => 'required|string',
            'riwayat_psiko_tinggal' => 'required|string',
            'riwayat_psiko_tinggal_keterangan' => 'required|string',
            'riwayat_psiko_nilai_kepercayaan' => 'required|string',
            'riwayat_psiko_nilai_kepercayaan_keterangan' => 'required|string',
            'riwayat_psiko_pendidikan_pj' => 'required|string',
            'riwayat_psiko_edukasi_diberikan' => 'required|string',
            'riwayat_psiko_edukasi_diberikan_keterangan' => 'required|string',

            // Khusus Tumbuh Kembang Anak
            'anakke' => 'required|integer',
            'darisaudara' => 'required|integer',
            'caralahir' => 'required|string',
            'ket_caralahir' => 'required|string',
            'umurkelahiran' => 'required|string',
            'kelainanbawaan' => 'required|string',
            'ket_kelainan_bawaan' => 'required|string',
            'usiatengkurap' => 'required|string',
            'usiaduduk' => 'required|string',
            'usiaberdiri' => 'required|string',
            'usiagigipertama' => 'required|string',
            'usiaberjalan' => 'required|string',
            'usiabicara' => 'required|string',
            'usiamembaca' => 'required|string',
            'usiamenulis' => 'required|string',
            'gangguanemosi' => 'required|string',

            // Skrining Gizi (4 Parameter)
            'skrining_gizi1' => 'required|string',
            'nilai_gizi1' => 'required|numeric',
            'skrining_gizi2' => 'required|string',
            'nilai_gizi2' => 'required|numeric',
            'skrining_gizi3' => 'required|string',
            'nilai_gizi3' => 'required|numeric',
            'skrining_gizi4' => 'required|string',
            'nilai_gizi4' => 'required|numeric',
            'nilai_total_gizi' => 'required|numeric',

            // Penilaian Nyeri (Metode FLACC/NIPS)
            'wajah' => 'required|string',
            'nilaiwajah' => 'required|numeric',
            'kaki' => 'required|string',
            'nilaikaki' => 'required|numeric',
            'aktifitas' => 'required|string',
            'nilaiaktifitas' => 'required|numeric',
            'menangis' => 'required|string',
            'nilaimenangis' => 'required|numeric',
            'bersuara' => 'required|string',
            'nilaibersuara' => 'required|numeric',
            'hasilnyeri' => 'required|numeric',
            'nyeri' => 'required|string',
            'lokasi' => 'required|string',
            'durasi' => 'required|string',
            'frekuensi' => 'required|string',
            'nyeri_hilang' => 'required|string',
            'ket_nyeri' => 'required|string',
            'pada_dokter' => 'required|string', // Jam/Keterangan lapor dokter
            'ket_dokter' => 'required|string',

            // Rencana & Autentikasi Staff
            'nip1' => 'required|string|max:20',
            'nip2' => 'required|string|max:20',
            'kd_dokter' => 'required|string|max:20',
        ];
    }

    public function messages(): array
    {
        return [
            'no_rawat.required' => 'Nomor rawat wajib diisi.',
            'kd_dokter.required' => 'Kode dokter penanggung jawab wajib diisi.',
            'tanggal.required' => 'Tanggal pengkajian harus ditentukan.',
            
        ];
    }

    public function prepareForValidation()
    {
        // $this->merge([
        //     'riwayat_kehamilan' => $this->riwayat_kehamilan ?? 'Tidak',
        //     'pengkajian_fungsi_berjalan_keterangan' => $this->pengkajian_fungsi_berjalan_keterangan ?? '-',
        // ]);
    }
    
}
