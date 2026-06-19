<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAskepRalanAnakRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Ubah sesuai dengan logic otorisasi Anda, misal cek role/permission
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     */
    public function rules(): array
    {
        return [
            'no_rawat' => ['required', 'string', 'max:20'],
            'tanggal' => ['required', 'date'],
            'informasi' => ['required', 'string'],
            'td' => ['required', 'string', 'max:20'],
            'nadi' => ['required',],
            'rr' => ['required',],
            'suhu' => ['required',],
            'gcs' => ['required',],
            'bb' => ['required',],
            'tb' => ['required',],
            'lp' => ['required',],
            'lk' => ['required',],
            'ld' => ['required',],

            'keluhan_utama' => ['required', 'string'],
            'rpd' => ['required', 'string'],
            'rpk' => ['required', 'string'],
            'rpo' => ['required', 'string'],
            'alergi' => ['required', 'string'],

            'anakke' => ['required'],
            'darisaudara' => ['required'],

            'caralahir' => ['required', 'string'],
            'ket_caralahir' => ['nullable', 'string'],
            'umurkelahiran' => ['required', 'string'],
            'kelainanbawaan' => ['required', 'string'],
            'ket_kelainan_bawaan' => ['nullable', 'string'],

            'usiatengkurap' => ['required', 'string'],
            'usiaduduk' => ['required', 'string'],
            'usiaberdiri' => ['required', 'string'],
            'usiagigipertama' => ['required', 'string'],
            'usiaberjalan' => ['required', 'string'],
            'usiabicara' => ['required', 'string'],
            'usiamembaca' => ['required', 'string'],
            'usiamenulis' => ['required', 'string'],

            'gangguanemosi' => ['required', 'string'],

            'alat_bantu' => ['required', 'string'],
            'ket_bantu' => ['nullable', 'string'],

            'prothesa' => ['required', 'string'],
            'ket_pro' => ['nullable', 'string'],

            'adl' => ['required', 'string'],

            'status_psiko' => ['required', 'string'],
            'ket_psiko' => ['nullable', 'string'],

            'hub_keluarga' => ['required', 'string'],
            'pengasuh' => ['required', 'string'],
            'ket_pengasuh' => ['nullable', 'string'],

            'ekonomi' => ['required', 'string'],
            'budaya' => ['required', 'string'],
            'ket_budaya' => ['nullable', 'string'],

            'edukasi' => ['required', 'string'],
            'ket_edukasi' => ['nullable', 'string'],

            'berjalan_a' => ['required', 'string'],
            'berjalan_b' => ['required', 'string'],
            'berjalan_c' => ['required', 'string'],

            'hasil' => ['required', 'string'],
            'lapor' => ['required', 'string'],
            'ket_lapor' => ['nullable', 'string'],

            'sg1' => ['nullable', 'string'],
            'nilai1' => ['nullable', 'integer'],

            'sg2' => ['nullable', 'string'],
            'nilai2' => ['nullable', 'integer'],

            'sg3' => ['nullable', 'string'],
            'nilai3' => ['nullable', 'integer'],

            'sg4' => ['nullable', 'string'],
            'nilai4' => ['nullable', 'integer'],

            'total_hasil' => ['nullable', 'integer'],

            'wajah' => ['required', 'string'],
            'nilaiwajah' => ['nullable', 'integer'],

            'kaki' => ['required', 'string'],
            'nilaikaki' => ['nullable', 'integer'],

            'aktifitas' => ['required', 'string'],
            'nilaiaktifitas' => ['nullable', 'integer'],

            'menangis' => ['required', 'string'],
            'nilaimenangis' => ['nullable', 'integer'],

            'bersuara' => ['required', 'string'],
            'nilaibersuara' => ['nullable', 'integer'],

            'hasilnyeri' => ['required', 'integer'],
            'nyeri' => ['required', 'string'],
            'lokasi' => ['required', 'string'],
            'durasi' => ['required', 'string'],
            'frekuensi' => ['required', 'string'],
            'nyeri_hilang' => ['required', 'string'],
            'ket_nyeri' => ['required', 'string'],

            'pada_dokter' => ['nullable', 'string'],
            'ket_dokter' => ['nullable', 'string'],

            'rencana' => ['nullable', 'string'],
            'nip' => ['required', 'string', 'max:20'],
        ];
    }

    /**
     * Mengatur custom attribute name agar pesan error lebih mudah dibaca user
     */
    public function attributes(): array
    {
        return [
            'no_rawat' => 'Nomor Rawat',
            'td' => 'Tekanan Darah',
            'rr' => 'Respiratory Rate',
            'suhu' => 'Suhu Tubuh',
            'bb' => 'Berat Badan',
            'tb' => 'Tinggi Badan',
            'keluhan_utama' => 'Keluhan Utama',
            // Tambahkan alias lain jika diperlukan
        ];
    }
    protected function prepareForValidation(): void
    {
        $this->merge([
            'ket_lapor' => $this->ket_lapor ? $this->ket_lapor : '-',
        ]);
    }
}
    