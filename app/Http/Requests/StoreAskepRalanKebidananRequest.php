<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAskepRalanKebidananRequest extends FormRequest
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
            'tanggal' => 'required|date',
            'informasi' => ['required', Rule::in(['Autoanamnesis', 'Alloanamnesis'])],

            // KEADAAN UMUM
            'td' => 'required|string|max:8',
            'nadi' => 'required|string|max:5',
            'rr' => 'required|string|max:5',
            'suhu' => 'required|string|max:5',
            'gcs' => 'required|string|max:10',
            'bb' => 'required|string|max:5',
            'tb' => 'required|string|max:5',
            'lila' => 'required|string|max:5',
            'bmi' => 'required|string|max:10',

            // PEMERIKSAAN KEBIDANAN
            'tfu' => 'required|string|max:10',
            'tbj' => 'required|string|max:10',
            'letak' => 'required|string|max:10',
            'presentasi' => 'required|string|max:10',
            'penurunan' => 'required|string|max:10',
            'his' => 'required|string|max:10',
            'kekuatan' => 'required|string|max:10',
            'lamanya' => 'required|string|max:10',
            'bjj' => 'required|string|max:10',
            'ket_bjj' => ['required', Rule::in(['Teratur', 'Tidak Teratur'])],

            'portio' => 'required|string|max:10',
            'serviks' => 'required|string|max:10',
            'ketuban' => 'required|string|max:10',
            'hodge' => 'required|string|max:10',

            // PENUNJANG
            'inspekulo' => ['required', Rule::in(['Dilakukan', 'Tidak'])],
            'ket_inspekulo' => 'required|string|max:50',

            'ctg' => ['required', Rule::in(['Dilakukan', 'Tidak'])],
            'ket_ctg' => 'required|string|max:50',

            'usg' => ['required', Rule::in(['Dilakukan', 'Tidak'])],
            'ket_usg' => 'required|string|max:50',

            'lab' => ['required', Rule::in(['Dilakukan', 'Tidak'])],
            'ket_lab' => 'required|string|max:50',

            'lakmus' => ['required', Rule::in(['Dilakukan', 'Tidak'])],
            'ket_lakmus' => 'required|string|max:50',

            'panggul' => [
                'required',
                Rule::in([
                    'Luas',
                    'Sedang',
                    'Sempit',
                    'Tidak Dilakukan Pemeriksaan'
                ])
            ],

            // RIWAYAT KESEHATAN
            'keluhan_utama' => 'required|string|max:1000',

            'umur' => 'required|string|max:10',
            'lama' => 'required|string|max:10',
            'banyaknya' => 'required|string|max:10',
            'haid' => 'required|string|max:20',
            'siklus' => 'required|string|max:10',

            'ket_siklus' => [
                'required',
                Rule::in(['Teratur', 'Tidak Teratur'])
            ],

            'ket_siklus1' => [
                'required',
                Rule::in([
                    'Tidak Ada Masalah',
                    'Dismenorhea',
                    'Spotting',
                    'Menorhagia',
                    'PMS'
                ])
            ],

            // PERKAWINAN
            'status' => [
                'required',
                Rule::in([
                    'Menikah',
                    'Tidak / Belum Menikah'
                ])
            ],

            'kali' => 'required|string|max:5',

            'usia1' => 'required|string|max:5',
            'ket1' => [
                'required',
                Rule::in([
                    '-',
                    'Masih Menikah',
                    'Cerai',
                    'Meninggal'
                ])
            ],

            'usia2' => 'required|string|max:5',
            'ket2' => [
                'required',
                Rule::in([
                    '-',
                    'Masih Menikah',
                    'Cerai',
                    'Meninggal'
                ])
            ],

            'usia3' => 'required|string|max:5',
            'ket3' => [
                'required',
                Rule::in([
                    '-',
                    'Masih Menikah',
                    'Cerai',
                    'Meninggal'
                ])
            ],

            // KEHAMILAN
            'hpht' => 'nullable|date',
            'usia_kehamilan' => 'nullable|string|max:10',
            'tp' => 'nullable|date',

            'imunisasi' => ['required', Rule::in(['Ya', 'Tidak'])],
            'ket_imunisasi' => 'required|string|max:10',

            'g' => 'required|string|max:10',
            'p' => 'required|string|max:10',
            'a' => 'required|string|max:10',
            'hidup' => 'required|string|max:10',

            // GINEKOLOGI
            'ginekologi' => [
                'required',
                Rule::in([
                    'Tidak Ada',
                    'Infertilitas',
                    'Infeksi Virus',
                    'PMS',
                    'Cervisitis Kronis',
                    'Endometriosis',
                    'Mioma',
                    'Polip Cervix',
                    'Kanker Kandungan',
                    'Operasi Kandungan'
                ])
            ],

            // KEBIASAAN
            'kebiasaan' => [
                'required',
                Rule::in([
                    '-',
                    'Obat Obatan',
                    'Vitamin',
                    'Jamu Jamuan'
                ])
            ],

            'ket_kebiasaan' => 'required|string|max:50',

            'kebiasaan1' => ['required', Rule::in(['Ya', 'Tidak'])],
            'ket_kebiasaan1' => 'required|string|max:5',

            'kebiasaan2' => ['required', Rule::in(['Ya', 'Tidak'])],
            'ket_kebiasaan2' => 'required|string|max:5',

            'kebiasaan3' => ['required', Rule::in(['Ya', 'Tidak'])],

            // KB
            'kb' => [
                'required',
                Rule::in([
                    'Belum Pernah',
                    'Suntik',
                    'Pil',
                    'AKDR',
                    'MOW',
                    'Implant'
                ])
            ],

            'ket_kb' => 'required|string|max:10',

            'komplikasi' => ['required', Rule::in(['Ada', 'Tidak Ada'])],
            'ket_komplikasi' => 'required|string|max:50',

            'berhenti' => 'required|string|max:20',
            'alasan' => 'required|string|max:50',

            // FUNGSIONAL
            'alat_bantu' => ['required', Rule::in(['Ya', 'Tidak'])],
            'ket_bantu' => 'required|string|max:50',

            'prothesa' => ['required', Rule::in(['Ya', 'Tidak'])],
            'ket_pro' => 'required|string|max:50',

            'adl' => ['required', Rule::in(['Mandiri', 'Dibantu'])],

            // PSIKOSOSIAL
            'status_psiko' => [
                'required',
                Rule::in([
                    'Tenang',
                    'Takut',
                    'Cemas',
                    'Depresi',
                    'Lain-Lain'
                ])
            ],

            'ket_psiko' => 'required|string|max:50',

            'hub_keluarga' => ['required', Rule::in(['Baik', 'Tidak Baik'])],

            'tinggal_dengan' => [
                'required',
                Rule::in([
                    'Sendiri',
                    'Orang Tua',
                    'Suami / Istri',
                    'Lainnya'
                ])
            ],

            'ket_tinggal' => 'required|string|max:50',

            'ekonomi' => [
                'required',
                Rule::in([
                    'Baik',
                    'Cukup',
                    'Kurang'
                ])
            ],

            'budaya' => ['required', Rule::in(['Ada', 'Tidak Ada'])],
            'ket_budaya' => 'required|string|max:50',

            'edukasi' => ['required', Rule::in(['Pasien', 'Keluarga'])],
            'ket_edukasi' => 'required|string|max:50',

            // RESIKO JATUH
            'berjalan_a' => ['required', Rule::in(['Ya', 'Tidak'])],
            'berjalan_b' => ['required', Rule::in(['Ya', 'Tidak'])],
            'berjalan_c' => ['required', Rule::in(['Ya', 'Tidak'])],

            'hasil' => ['required'],
            'lapor' => ['required', Rule::in(['Ya', 'Tidak'])],
            'ket_lapor' => 'nullable|string|max:10',

            // SKRINING GIZI
            'sg1' => ['required'],
            'nilai1' => ['required'],

            'sg2' => ['required', Rule::in(['Ya', 'Tidak'])],
            'nilai2' => ['required'],

            'total_hasil' => 'required|string|max:5',

            // NYERI
            'nyeri' => [
                'required',
                Rule::in([
                    'Tidak Ada Nyeri',
                    'Nyeri Akut',
                    'Nyeri Kronis'
                ])
            ],

            'provokes' => [
                'required',
                Rule::in([
                    'Proses Penyakit',
                    'Benturan',
                    'Lain-Lain'
                ])
            ],

            'ket_provokes' => 'required|string|max:40',

            'quality' => [
                'required',
                Rule::in([
                    'Seperti Tertusuk',
                    'Berdenyut',
                    'Teriris',
                    'Tertindih',
                    'Tertiban',
                    'Lain-Lain'
                ])
            ],

            'ket_quality' => 'required|string|max:40',

            'lokasi' => 'required|string|max:40',
            'menyebar' => ['required', Rule::in(['Ya', 'Tidak'])],

            'skala_nyeri' => 'required|integer|min:0|max:10',

            'durasi' => 'required|string|max:5',

            'nyeri_hilang' => [
                'required',
                Rule::in([
                    'Istirahat',
                    'Mendengar Musik',
                    'Minum Obat'
                ])
            ],

            'ket_nyeri' => 'required|string|max:40',

            'pada_dokter' => ['required', Rule::in(['Ya', 'Tidak'])],
            'ket_dokter' => 'nullable|string|max:10',

            // ASESMEN
            'masalah' => 'required|string|max:1000',
            'tindakan' => 'required|string|max:1000',

            // PETUGAS
            'nip' => 'required|string|max:20',
        ];
    }
    public function attributes(): array
    {
        return [

            'no_rawat' => 'Nomor Rawat',
            'tanggal' => 'Tanggal Asesmen',
            'informasi' => 'Sumber Informasi',

            // KEADAAN UMUM
            'td' => 'Tekanan Darah',
            'nadi' => 'Nadi',
            'rr' => 'Respiratory Rate',
            'suhu' => 'Suhu',
            'gcs' => 'GCS',
            'bb' => 'Berat Badan',
            'tb' => 'Tinggi Badan',
            'lila' => 'Lingkar Lengan Atas',
            'bmi' => 'BMI',

            // PEMERIKSAAN KEBIDANAN
            'tfu' => 'TFU',
            'tbj' => 'TBJ',
            'letak' => 'Letak Janin',
            'presentasi' => 'Presentasi',
            'penurunan' => 'Penurunan Kepala',
            'his' => 'His',
            'kekuatan' => 'Kekuatan His',
            'lamanya' => 'Lamanya His',
            'bjj' => 'BJJ',
            'ket_bjj' => 'Keterangan BJJ',
            'portio' => 'Portio',
            'serviks' => 'Serviks',
            'ketuban' => 'Ketuban',
            'hodge' => 'Hodge',

            // PENUNJANG
            'inspekulo' => 'Pemeriksaan Inspekulo',
            'ket_inspekulo' => 'Hasil Inspekulo',

            'ctg' => 'Pemeriksaan CTG',
            'ket_ctg' => 'Hasil CTG',

            'usg' => 'Pemeriksaan USG',
            'ket_usg' => 'Hasil USG',

            'lab' => 'Pemeriksaan Laboratorium',
            'ket_lab' => 'Hasil Laboratorium',

            'lakmus' => 'Pemeriksaan Lakmus',
            'ket_lakmus' => 'Hasil Lakmus',

            'panggul' => 'Pemeriksaan Panggul',

            // RIWAYAT KESEHATAN
            'keluhan_utama' => 'Keluhan Utama',
            'umur' => 'Umur Menarche',
            'lama' => 'Lama Haid',
            'banyaknya' => 'Banyaknya Haid',
            'haid' => 'Haid Terakhir',
            'siklus' => 'Siklus Haid',
            'ket_siklus' => 'Keteraturan Siklus',
            'ket_siklus1' => 'Masalah Menstruasi',

            // PERKAWINAN
            'status' => 'Status Perkawinan',
            'kali' => 'Jumlah Pernikahan',
            'usia1' => 'Usia Menikah Pertama',
            'usia2' => 'Usia Menikah Kedua',
            'usia3' => 'Usia Menikah Ketiga',

            // KEHAMILAN
            'hpht' => 'HPHT',
            'usia_kehamilan' => 'Usia Kehamilan',
            'tp' => 'Taksiran Persalinan',
            'imunisasi' => 'Imunisasi TT',
            'ket_imunisasi' => 'Jumlah Imunisasi TT',

            'g' => 'Gravida',
            'p' => 'Para',
            'a' => 'Abortus',
            'hidup' => 'Anak Hidup',

            // GINEKOLOGI
            'ginekologi' => 'Riwayat Ginekologi',

            // KEBIASAAN
            'kebiasaan' => 'Kebiasaan Konsumsi',
            'ket_kebiasaan' => 'Keterangan Kebiasaan',

            'kebiasaan1' => 'Merokok',
            'ket_kebiasaan1' => 'Jumlah Rokok',

            'kebiasaan2' => 'Alkohol',
            'ket_kebiasaan2' => 'Jumlah Alkohol',

            'kebiasaan3' => 'Narkoba',

            // KB
            'kb' => 'Riwayat KB',
            'ket_kb' => 'Lama Pemakaian KB',
            'komplikasi' => 'Komplikasi KB',
            'ket_komplikasi' => 'Keterangan Komplikasi',
            'berhenti' => 'Berhenti KB',
            'alasan' => 'Alasan Berhenti KB',

            // FUNGSIONAL
            'alat_bantu' => 'Alat Bantu',
            'ket_bantu' => 'Jenis Alat Bantu',
            'prothesa' => 'Prothesa',
            'ket_pro' => 'Jenis Prothesa',
            'adl' => 'Aktivitas Sehari Hari',

            // PSIKOSOSIAL
            'status_psiko' => 'Status Psikologis',
            'ket_psiko' => 'Keterangan Psikologis',
            'hub_keluarga' => 'Hubungan Keluarga',
            'tinggal_dengan' => 'Tinggal Dengan',
            'ket_tinggal' => 'Keterangan Tempat Tinggal',
            'ekonomi' => 'Status Ekonomi',
            'budaya' => 'Nilai Budaya',
            'ket_budaya' => 'Keterangan Budaya',
            'edukasi' => 'Edukasi Diberikan Kepada',
            'ket_edukasi' => 'Keterangan Edukasi',

            // RISIKO JATUH
            'berjalan_a' => 'Risiko Jatuh A',
            'berjalan_b' => 'Risiko Jatuh B',
            'berjalan_c' => 'Risiko Jatuh C',
            'hasil' => 'Hasil Risiko Jatuh',
            'lapor' => 'Dilaporkan Ke Dokter',
            'ket_lapor' => 'Jam Lapor',

            // GIZI
            'sg1' => 'Skrining Gizi Pertanyaan 1',
            'nilai1' => 'Nilai Skrining Gizi 1',
            'sg2' => 'Skrining Gizi Pertanyaan 2',
            'nilai2' => 'Nilai Skrining Gizi 2',
            'total_hasil' => 'Total Skor Gizi',

            // NYERI
            'nyeri' => 'Jenis Nyeri',
            'provokes' => 'Penyebab Nyeri',
            'ket_provokes' => 'Keterangan Penyebab Nyeri',
            'quality' => 'Karakteristik Nyeri',
            'ket_quality' => 'Keterangan Karakteristik Nyeri',
            'lokasi' => 'Lokasi Nyeri',
            'menyebar' => 'Nyeri Menyebar',
            'skala_nyeri' => 'Skala Nyeri',
            'durasi' => 'Durasi Nyeri',
            'nyeri_hilang' => 'Nyeri Berkurang Dengan',
            'ket_nyeri' => 'Keterangan Nyeri',
            'pada_dokter' => 'Dilaporkan Ke Dokter',
            'ket_dokter' => 'Jam Lapor Dokter',

            // ASESMEN
            'masalah' => 'Masalah Kebidanan',
            'tindakan' => 'Tindakan Kebidanan',

            // PETUGAS
            'nip' => 'Petugas Pemeriksa',
        ];
    }
    public function messages(): array
    {
        return [
            'required' => ':attribute wajib diisi.',
            'date' => ':attribute harus berupa tanggal yang valid.',
            'integer' => ':attribute harus berupa angka.',
            'in' => ':attribute tidak valid.',
            'max' => ':attribute melebihi batas yang diperbolehkan.',
            'min' => ':attribute kurang dari batas minimal.',
        ];
    }
    protected function prepareForValidation(): void
    {
        if ($this->filled('tanggal')) {
            $this->merge([
                'tanggal' => date(
                    'Y-m-d H:i:s',
                    strtotime($this->tanggal)
                ),
                'hpht' => $this->hpht ? date(
                    'Y-m-d H:i:s',
                    strtotime($this->hpht)
                ) : '0000-00-00 00:00:00',
                'tp' => $this->tp ? date(
                    'Y-m-d H:i:s',
                    strtotime($this->tp)
                ) : '0000-00-00 00:00:00',
            ]);
        }
    }
}
