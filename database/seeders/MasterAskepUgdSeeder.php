<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterAskepUgdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Safe column length adjustment
        DB::statement("ALTER TABLE master_rencana_keperawatan_igd MODIFY COLUMN rencana_keperawatan VARCHAR(255) NOT NULL");
        DB::statement("ALTER TABLE master_rencana_keperawatan_igd MODIFY COLUMN kode_rencana VARCHAR(10) NOT NULL");
        DB::statement("ALTER TABLE master_masalah_keperawatan_igd MODIFY COLUMN nama_masalah VARCHAR(150) NOT NULL");

        $dataMaster = [
            [
                'kode' => '001',
                'nama' => 'Hipertermia',
                'rencana' => [
                    'Monitor suhu tubuh pasien secara berkala',
                    'Monitor adanya haluaran urine (output cairan)',
                    'Berikan cairan oral (minum air putih) yang cukup',
                    'Anjurkan konsumsi cairan yang cukup',
                    'Kolaborasi dengan dokter untuk pemberian cairan intravena (infus)',
                    'Kolaborasi dengan dokter untuk pemberian obat antipiretik',
                ]
            ],
            [
                'kode' => '002',
                'nama' => 'Bersihan Jalan Napas Tidak Efektif',
                'rencana' => [
                    'Monitor pola napas pasien (frekuensi, kedalaman, dan usaha napas)',
                    'Monitor bunyi napas tambahan (misalnya ronkhi, wheezing, gurgling, atau stridor)',
                    'Pertahankan kepatenan jalan napas',
                    'Posisikan pasien Semi Fowler atau Fowler',
                    'Berikan oksigenasi tambahan jika diperlukan',
                    'Kolaborasi dengan dokter untuk pemberian bronkodilator, ekspektoran, atau mukolitik',
                ]
            ],
            [
                'kode' => '016',
                'nama' => 'Pola Napas Tidak Efektif',
                'rencana' => [
                    'Monitor pola napas pasien (frekuensi, kedalaman, dan usaha napas)',
                    'Monitor bunyi napas tambahan (misalnya ronkhi, wheezing, gurgling, atau stridor)',
                    'Monitor nilai saturasi oksigen (SpO₂)',
                    'Posisikan pasien Semi Fowler atau Fowler',
                    'Berikan oksigenasi tambahan',
                    'Kolaborasi dengan dokter untuk pemberian bronkodilator, kortikosteroid, atau terapi inhalasi',
                ]
            ],
            [
                'kode' => '008',
                'nama' => 'Risiko Perdarahan',
                'rencana' => [
                    'Monitor tanda dan gejala perdarahan',
                    'Monitor tekanan darah dan frekuensi nadi secara berkala',
                    'Monitor nilai laboratorium yang berkaitan dengan pembekuan darah',
                    'Pertahankan tirah baring (bed rest) selama pasien mengalami risiko perdarahan aktif',
                    'Kolaborasi dengan dokter untuk pemberian obat penghenti perdarahan',
                ]
            ],
            [
                'kode' => '017',
                'nama' => 'Gangguan Sirkulasi Spontan',
                'rencana' => [
                    'Identifikasi tingkat kesadaran pasien',
                    'Monitor tanda-tanda kembalinya sirkulasi spontan',
                    'Tempatkan pasien pada permukaan yang datar dan keras',
                    'Bersihkan jalan napas dari sumbatan benda asing jika terlihat',
                    'Kolaborasi pemberian obat-obatan inotropik atau vasopresor',
                    'Kolaborasi pemasangan alat jalan napas definitif (intubasi endotrakeal / ETT)',
                ]
            ],
            [
                'kode' => '015',
                'nama' => 'Defisit Nutrisi',
                'rencana' => [
                    'Identifikasi status nutrisi pasien (hitung Indeks Massa Tubuh/IMT)',
                    'Identifikasi adanya alergi dan intoleransi makanan',
                    'Monitor asupan makanan (jumlah porsi yang dihabiskan)',
                    'Berikan makanan dalam porsi kecil tapi sering (small-frequent feeding)',
                    'Kolaborasi dengan ahli gizi untuk menentukan jumlah kalori dan jenis nutrient',
                    'Kolaborasi dengan dokter untuk pemberian obat antiemetik (anti-mual) atau multivitamin',
                ]
            ],
            [
                'kode' => '003',
                'nama' => 'Risiko Ketidakseimbangan Elektrolit',
                'rencana' => [
                    'Monitor kadar elektrolit serum',
                    'Monitor tanda dan gejala ketidakseimbangan elektrolit',
                    'Monitor tanda-tanda vital (nadi, tekanan darah, pernapasan)',
                    'Monitor adanya kehilangan cairan dan elektrolit melalui rute abnormal',
                    'Atur interval waktu pemantauan sesuai dengan kondisi klinis pasien',
                    'Kolaborasi dengan dokter untuk pemberian suplemen elektrolit',
                ]
            ],
            [
                'kode' => '004',
                'nama' => 'Risiko Ketidakseimbangan Cairan',
                'rencana' => [
                    'Monitor status hidrasi pasien (seperti frekuensi nadi, kekuatan nadi, tekanan darah, turgor kulit, kelembapan mukosa bibir)',
                    'Catat asupan (intake) dan haluaran (output) cairan secara akurat',
                    'Penuhi kebutuhan cairan oral pasien sesuai target kebutuhan harian',
                    'Berikan cairan intravena (infus) sesuai program terapi medis',
                    'Anjurkan pasien dan keluarga untuk ikut memantau dan melaporkan jumlah cairan yang dikonsumsi',
                    'Kolaborasi dengan dokter untuk pemberian terapi cairan intravena (baik kristaloid seperti RL/NaCl maupun koloid)',
                ]
            ],
            [
                'kode' => '009',
                'nama' => 'Diare',
                'rencana' => [
                    'Identifikasi penyebab diare',
                    'Monitor warna, volume, frekuensi, dan konsistensi tinja',
                    'Monitor tanda dan gejala dehidrasi',
                    'Berikan cairan oral',
                    'Berikan makanan dalam porsi kecil tapi sering',
                    'Anjurkan pasien untuk menjaga kebersihan tangan',
                    'Kolaborasi pemberian obat anti diare atau suplemen',
                ]
            ],
            [
                'kode' => '018',
                'nama' => 'Konstipasi',
                'rencana' => [
                    'Monitor tanda dan gejala konstipasi',
                    'Identifikasi faktor risiko atau penyebab konstipasi',
                    'Monitor bising usus pasien',
                    'Anjurkan meningkatkan asupan cairan',
                    'Anjurkan mengonsumsi makanan tinggi serat',
                    'Kolaborasi dengan dokter untuk pemberian pencahar/laksatif',
                ]
            ],
            [
                'kode' => '019',
                'nama' => 'Gangguan Eliminasi Urine',
                'rencana' => [
                    'Identifikasi faktor penyebab gangguan eliminasi urine',
                    'Monitor eliminasi urine meliputi frekuensi, konsistensi, aroma, volume, dan warna urine',
                    'Monitor tanda dan gejala retensi urine (seperti distensi/ketegangan kandung kemih di area perut bawah, rasa penuh, atau urine menetes)',
                    'Monitor tanda dan gejala inkontinensia urine (urine keluar tanpa disadari)',
                    'Kolaborasi dengan dokter untuk pemberian obat-obatan',
                ]
            ],
            [
                'kode' => '006',
                'nama' => 'Nyeri Akut',
                'rencana' => [
                    'Identifikasi lokasi, karakteristik, durasi, frekuensi, kualitas, dan intensitas nyeri',
                    'Identifikasi faktor yang memperberat dan memperingan nyeri',
                    'Berikan teknik non-farmakologis untuk mengurangi rasa nyeri',
                    'Fasilitasi istirahat dan tidur yang adekuat',
                    'Ajarkan teknik non-farmakologis (seperti relaksasi napas dalam)',
                    'Kolaborasi dengan dokter untuk pemberian analgetik',
                ]
            ],
            [
                'kode' => '010',
                'nama' => 'Ikterik Neonatus',
                'rencana' => [
                    'Monitor ikterik pada sklera dan kulit bayi secara berkala',
                    'Monitor suhu tubuh bayi setiap 4 jam sekali',
                    'Monitor asupan (intake) cairan berupa ASI/susu formula dan haluaran',
                    'Monitor efek samping fototerapi',
                    'Sesuaikan jarak antara lampu fototerapi dan permukaan kulit bayi',
                    'Kolaborasi dengan dokter anak untuk pemeriksaan laboratorium kadar bilirubin serum (total, direk, indirek) secara berkala',
                    'Kolaborasi pemberian terapi cairan intravena (infus)',
                ]
            ],
            [
                'kode' => '020',
                'nama' => 'Gangguan Rasa Nyaman',
                'rencana' => [
                    'Identifikasi gejala yang menyebabkan ketidaknyamanan (misalnya gatal, mual, pusing, suhu ruangan terlalu panas/dingin, atau suara bising)',
                    'Monitor kondisi kulit, kebersihan tempat tidur, dan kenyamanan linen',
                    'Hindari gangguan yang tidak perlu selama waktu istirahat pasien',
                    'Sediakan lingkungan yang bersih, tenang, dan aman',
                    'Ajarkan keluarga cara membantu pasien mengubah posisi secara aman di tempat tidur',
                ]
            ],
            [
                'kode' => '021',
                'nama' => 'Gangguan Tumbuh Kembang',
                'rencana' => [
                    'Identifikasi kebutuhan stimulasi anak berdasarkan usia perkembangan saat ini',
                    'Monitor kemampuan anak dalam berinteraksi dengan orang tua, teman sebaya, dan lingkungan',
                    'Fasilitasi anak untuk melakukan aktivitas motorik kasar dan halus',
                    'Berikan mainan yang edukatif dan sesuai dengan usia anak',
                    'Anjurkan orang tua membatasi waktu layar (screen time seperti HP/TV) pada anak',
                ]
            ],
            [
                'kode' => '007',
                'nama' => 'Gangguan Integritas Kulit/Jaringan',
                'rencana' => [
                    'Identifikasi penyebab gangguan integritas kulit',
                    'Monitor tanda-tanda infeksi lokal pada area sekitar luka',
                    'Berikan salep antiseptik atau salep antibiotik pada area luka sesuai indikasi medis',
                    'Ajarkan prosedur perawatan luka secara mandiri kepada keluarga',
                    'Anjurkan pasien untuk mengonsumsi makanan tinggi protein',
                ]
            ],
            [
                'kode' => '012',
                'nama' => 'Risiko Cedera',
                'rencana' => [
                    'Identifikasi area lingkungan yang berpotensi menyebabkan cedera',
                    'Monitor perubahan status kognitif, fungsi neuromuskuler, atau tingkat kesadaran pasien',
                    'Pasang pengaman tempat tidur (side rails) di kedua sisi tempat tidur',
                    'Pastikan tempat tidur pasien berada dalam posisi paling rendah yang aman',
                    'Ajarkan pasien dan keluarga cara memanggil bantuan perawat',
                ]
            ],
        ];

        // Safe update: update or insert master masalah and replace its intervensi list
        foreach ($dataMaster as $m) {
            DB::table('master_masalah_keperawatan_igd')->updateOrInsert(
                ['kode_masalah' => $m['kode']],
                ['nama_masalah' => $m['nama']]
            );

            // Delete old intervensi items for this specific kode_masalah to refresh with new ones
            DB::table('master_rencana_keperawatan_igd')->where('kode_masalah', $m['kode'])->delete();

            $subIdx = 1;
            foreach ($m['rencana'] as $r) {
                // Generate a clear sub-code e.g., '001-1', '001-2', or numeric key string fits varchar(10)
                $kodeRencana = $m['kode'] . '-' . $subIdx;
                DB::table('master_rencana_keperawatan_igd')->insert([
                    'kode_masalah' => $m['kode'],
                    'kode_rencana' => $kodeRencana,
                    'rencana_keperawatan' => $r,
                ]);
                $subIdx++;
            }
        }
    }
}
