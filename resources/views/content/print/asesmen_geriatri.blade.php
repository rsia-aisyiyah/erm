@extends('content.print.main')

@section('content')
    <style>
        table {
            border-collapse: collapse;
            font-size: 10px;
            width: 100%;
        }

        td, th {
            border: 1px solid #000;
            padding: 4px;
            vertical-align: top;
        }

        .title {
            text-align: center;
            margin-bottom: 10px;
            margin-top: 5px;
        }

        .header-bg {
            background: #d9ead3;
            font-weight: bold;
        }

        .section-header {
            background: #88c425;
            color: #000;
            font-weight: bold;
            padding: 5px;
        }

        .label {
            font-weight: bold;
            background: #f7f7f7;
        }

        .page-break {
            page-break-after: always;
        }
    </style>

    @php
        $pasien = optional($data->regPeriksa)->pasien;
        $dokter = optional($data->regPeriksa)->dokter;
    @endphp

    <!-- HALAMAN 1 -->
    <table width="100%" style="border-collapse: collapse; border-bottom: 2px solid #000; padding-bottom: 3px; margin-bottom: 8px;">
        <tr>
            <td width="10%" style="vertical-align: middle; text-align: center; border: none;">
                <img src="{{ public_path('img/logo.png') }}" width="50" />
            </td>
            <td width="55%" style="vertical-align: middle; border: none;">
                <strong style="font-size: 11.5px; display: block;">RUMAH SAKIT IBU DAN ANAK AISYIYAH</strong>
                <strong style="font-size: 11.5px; display: block;">PEKAJANGAN &ndash; PEKALONGAN</strong>
                <span style="font-size: 8.5px; display: block;">Jl. Raya Pekajangan No. 610 Pekajangan, Pekalongan, 51172</span>
                <span style="font-size: 8.5px; display: block;">Telp. (0285) 785909 Email: pekajangan@rsiaaisyiyah.com Website: www.rsiaaisyiyah.com</span>
            </td>
            <td width="35%" style="vertical-align: top; border: none;">
                <table width="100%" style="font-size: 9px; border-collapse: collapse;">
                    <tr>
                        <td width="35%" style="padding: 1.5px 3px; border: 1px solid #000;"><strong>No. RM</strong></td>
                        <td width="65%" style="padding: 1.5px 3px; border: 1px solid #000;">: {{ $pasien->no_rkm_medis ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 1.5px 3px; border: 1px solid #000;"><strong>Nama</strong></td>
                        <td style="padding: 1.5px 3px; border: 1px solid #000;">: {{ $pasien->nm_pasien ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 1.5px 3px; border: 1px solid #000;"><strong>Tgl. Lahir</strong></td>
                        <td style="padding: 1.5px 3px; border: 1px solid #000;">: {{ $pasien && $pasien->tgl_lahir ? date('d-m-Y', strtotime($pasien->tgl_lahir)) : '-' }} ({{ $pasien->jk ?? '-' }})</td>
                    </tr>
                    <tr>
                        <td style="padding: 1.5px 3px; border: 1px solid #000;"><strong>Alamat</strong></td>
                        <td style="padding: 1.5px 3px; border: 1px solid #000;">: {{ $pasien->alamat ?? '-' }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table width="100%" style="margin-bottom: 8px;">
        <tr>
            <td class="header-bg" colspan="4" style="text-align: center; font-size: 11px; padding: 5px;">
                ASESMEN AWAL GERIATRI
            </td>
        </tr>
        <tr>
            <td class="label" style="width: 15%;">No. Rawat</td>
            <td style="width: 35%;">{{ $data->no_rawat }}</td>
            <td class="label" style="width: 15%;">Tanggal Asesmen</td>
            <td style="width: 35%;">{{ date('d-m-Y H:i', strtotime($data->tanggal)) }}</td>
        </tr>
        <tr>
            <td class="label">Dokter DPJP</td>
            <td colspan="3">{{ $dokter->nm_dokter ?? '-' }}</td>
        </tr>
    </table>

    <!-- I. DATA AWAL (PERAWAT) -->
    <div class="section-header">I. DATA AWAL (Diisi oleh Perawat)</div>
    <table style="margin-bottom: 5px;">
        <tr>
            <td class="label" style="width: 20%;">Tanda Vital</td>
            <td colspan="3">
                <b>Tekanan Darah:</b> Baring: {{ $data->td_baring ?: '-' }} mmHg | Duduk: {{ $data->td_duduk ?: '-' }} mmHg | Berdiri: {{ $data->td_berdiri ?: '-' }} mmHg<br>
                <b>Nadi:</b> Baring: {{ $data->nadi_baring ?: '-' }} x/mnt | Duduk: {{ $data->nadi_duduk ?: '-' }} x/mnt | Berdiri: {{ $data->nadi_berdiri ?: '-' }} x/mnt<br>
                <b>Respirasi:</b> {{ $data->respirasi ?: '-' }} x/mnt | <b>Suhu:</b> {{ $data->suhu ?: '-' }} °C | <b>BB:</b> {{ $data->bb ?: '-' }} kg | <b>TB/TL:</b> {{ $data->tb_tl ?: '-' }} cm
            </td>
        </tr>
        <tr>
            <td class="label">Psikologi</td>
            <td colspan="3">
                • <b>Masalah Perkawinan:</b> {{ $data->masalah_perkawinan }} {{ $data->ket_masalah_perkawinan ? '('.$data->ket_masalah_perkawinan.')' : '' }}<br>
                • <b>Mengalami Kekerasan Fisik:</b> {{ $data->kekerasan_fisik }} {{ $data->kekerasan_fisik_detail ? '('.$data->kekerasan_fisik_detail.')' : '' }}<br>
                • <b>Trauma Kehidupan:</b> {{ $data->trauma_kehidupan }} {{ $data->ket_trauma_kehidupan ? '('.$data->ket_trauma_kehidupan.')' : '' }}<br>
                • <b>Gangguan Tidur:</b> {{ $data->gangguan_tidur }} | <b>Konsultasi Psikologi/Psikiater:</b> {{ $data->konsultasi_psikologi }}
            </td>
        </tr>
        <tr>
            <td class="label">Sosial</td>
            <td colspan="3">
                • <b>Status Pernikahan:</b> {{ $data->status_pernikahan }} | <b>Anak:</b> {{ $data->anak }} (Jumlah: {{ $data->jumlah_anak ?: '0' }})<br>
                • <b>Pendidikan:</b> {{ $data->pendidikan_terakhir }} | <b>Warganegara:</b> {{ $data->warganegara }} | <b>Pekerjaan:</b> {{ $data->pekerjaan }}<br>
                • <b>Tinggal Bersama:</b> {{ $data->tinggal_bersama }} | <b>Penanggung Jawab:</b> {{ $data->nama_penanggung_jawab ?: '-' }} (Telp: {{ $data->no_telepon_penanggung_jawab ?: '-' }})<br>
                • <b>Kebiasaan:</b> {{ $data->kebiasaan ?: '-' }} | <b>Agama:</b> {{ $data->agama }}
            </td>
        </tr>
        <tr>
            <td class="label">Nutrisi</td>
            <td colspan="3">
                • <b>Diet Saat Ini:</b> {{ $data->diet_saat_ini ?: '-' }}<br>
                • <b>Perubahan BB (6 bulan terakhir):</b> {{ $data->perubahan_bb }} {{ $data->ket_perubahan_bb ? '('.$data->ket_perubahan_bb.' kg)' : '' }}
            </td>
        </tr>
        <tr>
            <td class="label">Riwayat Alergi</td>
            <td colspan="3">
                {{ $data->riwayat_alergi == 'Ya' ? 'Ya: ' . $data->nama_alergen : 'Tidak Ada' }}
            </td>
        </tr>
    </table>

    <!-- II. DATA MEDIS (DOKTER) -->
    <div class="section-header">II. DATA MEDIS (Diisi oleh Dokter)</div>
    <table style="margin-bottom: 5px;">
        <tr>
            <td class="label" style="width: 25%;">1. Keluhan Utama</td>
            <td>{!! nl2br(e($data->keluhan_utama ?: '-')) !!}</td>
        </tr>
        <tr>
            <td class="label">2. Riwayat Penyakit Sekarang</td>
            <td>{!! nl2br(e($data->rps ?: '-')) !!}</td>
        </tr>
        <tr>
            <td class="label">3. Riwayat Penyakit Dahulu / Pengobatan</td>
            <td>{!! nl2br(e($data->rpd_rpo ?: '-')) !!}</td>
        </tr>
        <tr>
            <td class="label">Penilaian Nyeri</td>
            <td>
                <b>Keluhan Nyeri:</b> {{ $data->keluhan_nyeri }}
                @if($data->skrining_nyeri_detail)
                    <br><b>Skrining:</b> {{ $data->skrining_nyeri_detail }}
                @endif
            </td>
        </tr>
        <tr>
            <td class="label">Tanda Vital & GCS</td>
            <td>
                <b>GCS:</b> E: {{ $data->gcs_e ?: '-' }} V: {{ $data->gcs_v ?: '-' }} M: {{ $data->gcs_m ?: '-' }} |
                <b>Tensi:</b> {{ $data->tensi_dokter ?: '-' }} mmHg |
                <b>Nadi:</b> {{ $data->nadi_dokter ?: '-' }} x/mnt |
                <b>Respirasi:</b> {{ $data->respirasi_dokter ?: '-' }} x/mnt |
                <b>Suhu:</b> {{ $data->suhu_dokter ?: '-' }} °C
            </td>
        </tr>
        <tr>
            <td class="label">Pemeriksaan Fisik</td>
            <td>
                • <b>Mata:</b> Anemis ({{ $data->mata_anemis }}), Icterus ({{ $data->mata_icterus }}), Reflex Pupil ({{ $data->mata_reflex_pupil }}), Oedema Palpebrae ({{ $data->mata_oedema_palpebrae }})<br>
                • <b>THT:</b> Tonsil ({{ $data->tht_tonsil }}), Pharing ({{ $data->tht_pharing }}), Lidah ({{ $data->tht_lidah }}), Bibir ({{ $data->tht_bibir }})<br>
                • <b>Leher:</b> JVP ({{ $data->leher_jvp }}), Pembesaran Kelenjar ({{ $data->leher_kelenjar }}), Kaku Kuduk ({{ $data->leher_kaku_kuduk }})<br>
                • <b>Thoraks:</b> {{ $data->thoraks_simetris }} | Cor: {{ $data->thoraks_cor ?: '-' }} | Pulmo: {{ $data->thoraks_pulmo ?: '-' }}<br>
                • <b>Abdomen:</b> Distensi ({{ $data->abdomen_distensi }}), Meteorismus ({{ $data->abdomen_meteorismus }}), Peristaltic ({{ $data->abdomen_peristaltic }}), Ascites ({{ $data->abdomen_ascites }}), Nyeri Tekan ({{ $data->abdomen_nyeri_tekan }} {{ $data->abdomen_lokasi_nyeri ? 'Lokasi: '.$data->abdomen_lokasi_nyeri : '' }}), Hepar: {{ $data->abdomen_hepar ?: '-' }}, Lien: {{ $data->abdomen_lien ?: '-' }}<br>
                • <b>Ekstremitas:</b> Suhu: {{ $data->ekstremitas_suhu }}, Oedema: {{ $data->ekstremitas_oedema ?: '-' }}, Lain-lain: {{ $data->ekstremitas_lain ?: '-' }}
            </td>
        </tr>
    </table>

    <div class="page-break"></div>

    <!-- HALAMAN 2 -->
    <div class="section-header">III. ASSESMEN SINDROM GERIATRI (10 Penapisan)</div>
    <table style="margin-bottom: 5px;">
        <tr>
            <td class="label" style="width: 35%;">1. Status Fungsional (Barthel ADL)</td>
            <td>{{ $data->adl_barthel ?: '-' }}</td>
        </tr>
        <tr>
            <td class="label">Instrumental ADL (IADL)</td>
            <td>{{ $data->iadl ?: '-' }}</td>
        </tr>
        <tr>
            <td class="label">2. Penapisan ACS (Delirium Akut)</td>
            <td>{{ $data->acs_delirium ?: 'Tidak' }}</td>
        </tr>
        <tr>
            <td class="label">3. Status Nutrisi (MNA)</td>
            <td>
                Penapisan: {{ $data->mna_penapisan ?: '-' }} | Pengkajian: {{ $data->mna_pengkajian ?: '-' }}<br>
                Lingkar Lengan Atas: {{ $data->mna_lingkar_lengan ?: '-' }} cm | Lingkar Betis: {{ $data->mna_lingkar_betis ?: '-' }} cm
            </td>
        </tr>
        <tr>
            <td class="label">4. Penapisan Kognitif (MMSE)</td>
            <td>{{ $data->mmse ?: '-' }}</td>
        </tr>
        <tr>
            <td class="label">5. Penapisan Depresi (GDS)</td>
            <td>{{ $data->gds ?: '-' }}</td>
        </tr>
        <tr>
            <td class="label">6. Penapisan Inkontinensia</td>
            <td>{{ $data->inkontinensia ?: '-' }}</td>
        </tr>
        <tr>
            <td class="label">7. Prediksi Klinis Wells (DVT/Emboli Paru)</td>
            <td>{{ $data->wells_dvt ?: '-' }}</td>
        </tr>
        <tr>
            <td class="label">8. Penapisan Ulkus Dekubitus (Skala Norton)</td>
            <td>{{ $data->norton_ulkus ?: '-' }}</td>
        </tr>
        <tr>
            <td class="label">9. Penapisan Insomnia</td>
            <td>{{ $data->insomnia ?: '-' }}</td>
        </tr>
        <tr>
            <td class="label">10. Penapisan Lain-lain</td>
            <td>{{ $data->penapisan_lain ?: '-' }}</td>
        </tr>
    </table>

    <table style="margin-bottom: 5px;">
        <tr>
            <td class="label" style="width: 25%;">Hasil Pemeriksaan Penunjang</td>
            <td>{!! nl2br(e($data->pemeriksaan_penunjang ?: '-')) !!}</td>
        </tr>
        <tr>
            <td class="label">Diagnosis (ICD X)</td>
            <td>{!! nl2br(e($data->diagnosis_icd ?: '-')) !!}</td>
        </tr>
        <tr>
            <td class="label">Sindrom Geriatri Teridentifikasi</td>
            <td>{{ $data->sindrom_geriatri ?: '-' }}</td>
        </tr>
        <tr>
            <td class="label">Impairment (ICF) / Disability / Handicap</td>
            <td>{!! nl2br(e($data->impairment_disability ?: '-')) !!}</td>
        </tr>
    </table>

    <div class="page-break"></div>

    <!-- HALAMAN 3 -->
    <div class="section-header">IV. REKOMENDASI, RENCANA TATA LAKSANA & DISPOSISI</div>
    <table style="margin-bottom: 10px;">
        <tr>
            <td class="label" style="width: 50%;">REKOMENDASI</td>
            <td class="label" style="width: 50%;">RENCANA TATA LAKSANA MEDIS</td>
        </tr>
        <tr>
            <td style="height: 120px;">{!! nl2br(e($data->rekomendasi ?: '-')) !!}</td>
            <td style="height: 120px;">{!! nl2br(e($data->rencana_medis ?: '-')) !!}</td>
        </tr>
        <tr>
            <td class="label">DISPOSISI</td>
            <td class="label">RENCANA TATA LAKSANA KEPERAWATAN / PROFESI LAIN</td>
        </tr>
        <tr>
            <td style="height: 120px;">
                <b>Disposisi:</b> {{ $data->disposisi }}<br>
                @if($data->disposisi == 'Boleh Pulang')
                    <b>Jam Keluar:</b> {{ $data->disposisi_jam_keluar ?: '-' }} WIB | <b>Tanggal:</b> {{ $data->disposisi_tgl_keluar ? date('d-m-Y', strtotime($data->disposisi_tgl_keluar)) : '-' }}<br>
                    <b>Kontrol Poliklinik:</b> {{ $data->disposisi_tgl_kontrol ? 'Ya, Tgl: ' . date('d-m-Y', strtotime($data->disposisi_tgl_kontrol)) : 'Tidak' }}
                @elseif($data->disposisi == 'Dirawat di Ruang')
                    <b>Ruang Rawat:</b> {{ $data->disposisi_ruangan ?: '-' }}
                @endif
            </td>
            <td style="height: 120px;">{!! nl2br(e($data->rencana_keperawatan ?: '-')) !!}</td>
        </tr>
    </table>

    <!-- SIGNATURES -->
    <table style="border:none; margin-top: 20px;">
        <tr style="border:none; text-align: center;">
            <td style="border:none; width: 33%;">
                Perawat Pengkaji,<br><br><br><br>
                <b>( {{ optional($data->perawat)->nama ?? '..........................' }} )</b>
            </td>
            <td style="border:none; width: 33%;">
                Dokter Pengkaji,<br><br><br><br>
                <b>( {{ optional($data->dokter)->nm_dokter ?? '..........................' }} )</b>
            </td>
            <td style="border:none; width: 33%;">
                Dokter Ruangan,<br><br><br><br>
                <b>( {{ optional($data->dokterRuangan)->nm_dokter ?? '..........................' }} )</b>
            </td>
        </tr>
    </table>
@endsection
