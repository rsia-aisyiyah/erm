@extends('content.print.main')
@section('content')
    <style>
        .box-title {
            border: 1.5px solid #000;
            text-align: center;
            font-weight: bold;
            font-size: 11.5px;
            padding: 3px;
            margin-top: 3px;
            margin-bottom: 5px;
            background-color: #f2f2f2;
            letter-spacing: 0.5px;
        }
        .table-borderless td, .table-borderless th {
            border: none;
            padding: 1.5px 3px;
            font-size: 9.5px;
            vertical-align: top;
        }
        .box-section {
            border: 1px solid #000;
            padding: 4px 6px;
            margin-bottom: 5px;
            font-size: 9.5px;
            page-break-inside: avoid;
        }
        .section-header {
            background-color: #e9ecef;
            font-weight: bold;
            font-size: 9.5px;
            padding: 2.5px 5px;
            border: 1px solid #000;
            margin-top: 4px;
            margin-bottom: 2px;
        }
        .checkbox-symbol {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10.5px;
            font-weight: bold;
        }
        .avoid-break {
            page-break-inside: avoid;
        }
        thead {
            display: table-header-group;
        }
    </style>

    @php
        $pasien = $data->regPeriksa->pasien ?? null;
        $petugas = $data->pengkaji ?? null;
        $masalahList = $data->masalahKeperawatan ?? [];
        $rencanaList = $data->rencanaKeperawatan ?? [];
    @endphp

    <table width="100%" style="border: none; border-collapse: collapse;">
        <thead>
            <tr>
                <th style="border: none; padding: 0; font-weight: normal; text-align: left;">
                    <!-- HEADER KOP & DATA PASIEN -->
                    <table width="100%" class="table-borderless" style="border-bottom: 2px solid #000; padding-bottom: 3px; margin-bottom: 2px;">
                        <tr>
                            <td width="10%" style="vertical-align: middle; text-align: center;">
                                <img src="{{ public_path('img/logo.png') }}" width="50" />
                            </td>
                            <td width="55%" style="vertical-align: middle;">
                                <strong style="font-size: 11.5px; display: block;">RUMAH SAKIT IBU DAN ANAK AISYIYAH</strong>
                                <strong style="font-size: 11.5px; display: block;">PEKAJANGAN &ndash; PEKALONGAN</strong>
                                <span style="font-size: 8.5px; display: block;">Jl. Raya Pekajangan No. 610 Pekajangan, Pekalongan, 51172</span>
                                <span style="font-size: 8.5px; display: block;">Telp. (0285) 785909 Email: pekajangan@rsiaaisyiyah.com Website: www.rsiaaisyiyah.com</span>
                            </td>
                            <td width="35%" style="vertical-align: top;">
                                <table width="100%" class="border" style="font-size: 9px; border-collapse: collapse;">
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

                    <div class="box-title">
                        PENGKAJIAN AWAL KEPERAWATAN GAWAT DARURAT
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="border: none; padding: 0;">
                    <!-- META DATA ASESMEN -->
                    <table width="100%" class="table-print" style="margin-bottom: 4px; font-size: 9px; border-collapse: collapse;">
                        <tr style="background-color: #f8f9fa;">
                            <td width="33%" style="padding: 2.5px 4px;">
                                <strong>Tgl. Asuhan:</strong> {{ date('d-m-Y H:i', strtotime($data->tanggal)) }}
                            </td>
                            <td width="33%" style="padding: 2.5px 4px;">
                                <strong>Perawat Pengkaji:</strong> {{ $petugas->nama ?? $data->nip ?? '-' }}
                            </td>
                            <td width="34%" style="padding: 2.5px 4px;">
                                <strong>Informasi:</strong> {{ $data->informasi ?? '-' }}
                            </td>
                        </tr>
                    </table>

                    <!-- SEKSI I. RIWAYAT KESEHATAN -->
                    <div class="section-header">I. RIWAYAT KESEHATAN PASIEN</div>
                    <table width="100%" class="table-print" style="margin-bottom: 4px; font-size: 9px; border-collapse: collapse;">
                        <tr>
                            <td width="22%" style="padding: 2px 4px; font-weight: bold;">Keluhan Utama (RPS)</td>
                            <td width="2%" style="padding: 2px 4px; text-align: center;">:</td>
                            <td width="76%" style="padding: 2px 4px;">{{ $data->keluhan_utama ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td style="padding: 2px 4px; font-weight: bold;">Riwayat Penyakit Dahulu (RPD)</td>
                            <td style="padding: 2px 4px; text-align: center;">:</td>
                            <td style="padding: 2px 4px;">{{ $data->rpd ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td style="padding: 2px 4px; font-weight: bold;">Riwayat Penggunaan Obat (RPO)</td>
                            <td style="padding: 2px 4px; text-align: center;">:</td>
                            <td style="padding: 2px 4px;">{{ $data->rpo ?? '-' }}</td>
                        </tr>
                        @if(($pasien->jk ?? '') == 'P' || ($data->status_kehamilan ?? '') == 'Hamil')
                        <tr>
                            <td style="padding: 2px 4px; font-weight: bold;">Status Obstetrik / Kehamilan</td>
                            <td style="padding: 2px 4px; text-align: center;">:</td>
                            <td style="padding: 2px 4px;">
                                <strong>Status:</strong> {{ $data->status_kehamilan ?? 'Tidak Hamil' }} &nbsp;&bull;&nbsp;
                                <strong>G:</strong> {{ $data->gravida ?? '-' }} &nbsp;&bull;&nbsp;
                                <strong>P:</strong> {{ $data->para ?? '-' }} &nbsp;&bull;&nbsp;
                                <strong>A:</strong> {{ $data->abortus ?? '-' }} &nbsp;&bull;&nbsp;
                                <strong>HPHT:</strong> {{ $data->hpht ?? '-' }}
                            </td>
                        </tr>
                        @endif
                    </table>

                    <!-- SEKSI II. PEMERIKSAAN FISIK KEPERAWATAN -->
                    <div class="section-header">II. PEMERIKSAAN FISIK SISTEMATIS</div>
                    <table width="100%" class="border" style="margin-bottom: 4px; font-size: 8.5px; border-collapse: collapse;">
                        <tr style="background-color: #fafafa;">
                            <td width="20%" style="padding: 2px 4px; border: 1px solid #000; font-weight: bold;">Tekanan Intrakranial</td>
                            <td width="30%" style="padding: 2px 4px; border: 1px solid #000;">{{ $data->tekanan ?? '-' }}</td>
                            <td width="20%" style="padding: 2px 4px; border: 1px solid #000; font-weight: bold;">Pupil</td>
                            <td width="30%" style="padding: 2px 4px; border: 1px solid #000;">{{ $data->pupil ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td style="padding: 2px 4px; border: 1px solid #000; font-weight: bold;">Neurosensorik / Muskuloskeletal</td>
                            <td style="padding: 2px 4px; border: 1px solid #000;">{{ $data->neurosensorik ?? '-' }}</td>
                            <td style="padding: 2px 4px; border: 1px solid #000; font-weight: bold;">Integumen</td>
                            <td style="padding: 2px 4px; border: 1px solid #000;">{{ $data->integumen ?? '-' }}</td>
                        </tr>
                        <tr style="background-color: #fafafa;">
                            <td style="padding: 2px 4px; border: 1px solid #000; font-weight: bold;">Turgor Kulit</td>
                            <td style="padding: 2px 4px; border: 1px solid #000;">{{ $data->turgor ?? '-' }}</td>
                            <td style="padding: 2px 4px; border: 1px solid #000; font-weight: bold;">Edema</td>
                            <td style="padding: 2px 4px; border: 1px solid #000;">{{ $data->edema ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td style="padding: 2px 4px; border: 1px solid #000; font-weight: bold;">Mukosa Mulut</td>
                            <td style="padding: 2px 4px; border: 1px solid #000;">{{ $data->mukosa ?? '-' }}</td>
                            <td style="padding: 2px 4px; border: 1px solid #000; font-weight: bold;">Perdarahan</td>
                            <td style="padding: 2px 4px; border: 1px solid #000;">
                                {{ $data->perdarahan ?? 'Tidak Ada' }}
                                @if(($data->perdarahan ?? '') == 'Ada')
                                    ({{ $data->jumlah_perdarahan ?? '-' }} cc, Warna: {{ $data->warna_perdarahan ?? '-' }})
                                @endif
                            </td>
                        </tr>
                        <tr style="background-color: #fafafa;">
                            <td style="padding: 2px 4px; border: 1px solid #000; font-weight: bold;">Intoksikasi</td>
                            <td style="padding: 2px 4px; border: 1px solid #000;">{{ $data->intoksikasi ?? 'Tidak Ada' }}</td>
                            <td style="padding: 2px 4px; border: 1px solid #000; font-weight: bold;">Eliminasi</td>
                            <td style="padding: 2px 4px; border: 1px solid #000;">
                                <strong>BAB:</strong> {{ $data->bab ? $data->bab . ' x/' . $data->xbab : '-' }}, Konsistensi: {{ $data->kbab ?? '-' }}, Warna: {{ $data->wbab ?? '-' }}<br>
                                <strong>BAK:</strong> {{ $data->bak ? $data->bak . ' x/' . $data->xbak : '-' }}, Warna: {{ $data->wbak ?? '-' }} {{ (!empty($data->lbak) && $data->lbak != '-') ? '('.$data->lbak.')' : '' }}
                            </td>
                        </tr>
                    </table>

                    <!-- SEKSI III & IV. PSIKOSOSIAL & FUNGSIONAL (2 KOLOM) -->
                    <div class="avoid-break">
                        <table width="100%" style="border-collapse: collapse; border: none; margin-bottom: 4px;">
                            <tr>
                                <td width="50%" style="vertical-align: top; padding: 0 2px 0 0; border: none;">
                                    <div class="section-header">III. PSIKOSOSIAL, BUDAYA &amp; SPIRITUAL</div>
                                    <table width="100%" class="border" style="font-size: 8.5px; border-collapse: collapse;">
                                        <tr>
                                            <td width="42%" style="padding: 2px 3px; border: 1px solid #000; font-weight: bold;">Kondisi Psikologis</td>
                                            <td width="58%" style="padding: 2px 3px; border: 1px solid #000;">{{ $data->psikologis ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 2px 3px; border: 1px solid #000; font-weight: bold;">Gangguan Jiwa Masa Lalu</td>
                                            <td style="padding: 2px 3px; border: 1px solid #000;">{{ $data->jiwa ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 2px 3px; border: 1px solid #000; font-weight: bold;">Perilaku Berisiko</td>
                                            <td style="padding: 2px 3px; border: 1px solid #000;">
                                                {{ $data->perilaku ?? '-' }}
                                                @if(!empty($data->dilaporkan) && $data->dilaporkan != '-') (Lapor: {{ $data->dilaporkan }}, {{ $data->sebutkan }}) @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 2px 3px; border: 1px solid #000; font-weight: bold;">Hubungan Keluarga</td>
                                            <td style="padding: 2px 3px; border: 1px solid #000;">{{ $data->hubungan ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 2px 3px; border: 1px solid #000; font-weight: bold;">Tinggal Dengan</td>
                                            <td style="padding: 2px 3px; border: 1px solid #000;">{{ $data->tinggal_dengan ?? '-' }} {{ (!empty($data->ket_tinggal) && $data->ket_tinggal != '-') ? '('.$data->ket_tinggal.')' : '' }}</td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 2px 3px; border: 1px solid #000; font-weight: bold;">Nilai Budaya / Khusus</td>
                                            <td style="padding: 2px 3px; border: 1px solid #000;">{{ $data->budaya ?? '-' }} {{ (!empty($data->ket_budaya) && $data->ket_budaya != '-') ? '('.$data->ket_budaya.')' : '' }}</td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 2px 3px; border: 1px solid #000; font-weight: bold;">Pendidikan PJ</td>
                                            <td style="padding: 2px 3px; border: 1px solid #000;">{{ $data->pendidikan_pj ?? '-' }} {{ (!empty($data->ket_pendidikan_pj) && $data->ket_pendidikan_pj != '-') ? '('.$data->ket_pendidikan_pj.')' : '' }}</td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 2px 3px; border: 1px solid #000; font-weight: bold;">Edukasi Diberikan</td>
                                            <td style="padding: 2px 3px; border: 1px solid #000;">{{ $data->edukasi ?? '-' }} {{ (!empty($data->ket_edukasi) && $data->ket_edukasi != '-') ? '('.$data->ket_edukasi.')' : '' }}</td>
                                        </tr>
                                    </table>
                                </td>
                                <td width="50%" style="vertical-align: top; padding: 0 0 0 2px; border: none;">
                                    <div class="section-header">IV. PENGKAJIAN FUNGSIONAL (ADL)</div>
                                    <table width="100%" class="border" style="font-size: 8.5px; border-collapse: collapse;">
                                        <tr>
                                            <td width="42%" style="padding: 2px 3px; border: 1px solid #000; font-weight: bold;">Kemampuan Aktivitas</td>
                                            <td width="58%" style="padding: 2px 3px; border: 1px solid #000;">{{ $data->kemampuan ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 2px 3px; border: 1px solid #000; font-weight: bold;">Aktivitas Sehari-hari</td>
                                            <td style="padding: 2px 3px; border: 1px solid #000;">{{ $data->aktifitas ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 2px 3px; border: 1px solid #000; font-weight: bold;">Alat Bantu Jalan</td>
                                            <td style="padding: 2px 3px; border: 1px solid #000;">{{ $data->alat_bantu ?? 'Tidak' }} {{ (!empty($data->ket_bantu) && $data->ket_bantu != '-') ? '('.$data->ket_bantu.')' : '' }}</td>
                                        </tr>
                                    </table>

                                    <div class="section-header" style="margin-top: 4px;">VI. PENILAIAN RISIKO JATUH</div>
                                    <table width="100%" class="border" style="font-size: 8.5px; border-collapse: collapse;">
                                        <tr>
                                            <td width="70%" style="padding: 2px 3px; border: 1px solid #000;">a. Cara berjalan sempoyongan / limbung</td>
                                            <td width="30%" style="padding: 2px 3px; border: 1px solid #000; text-align: center;"><strong>{{ $data->berjalan_a ?? 'Tidak' }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 2px 3px; border: 1px solid #000;">b. Memegang penopang saat akan duduk</td>
                                            <td style="padding: 2px 3px; border: 1px solid #000; text-align: center;"><strong>{{ $data->berjalan_b ?? 'Tidak' }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 2px 3px; border: 1px solid #000;">c. Menggunakan alat bantu jalan</td>
                                            <td style="padding: 2px 3px; border: 1px solid #000; text-align: center;"><strong>{{ $data->berjalan_c ?? 'Tidak' }}</strong></td>
                                        </tr>
                                        <tr style="background-color: #f8f9fa;">
                                            <td style="padding: 2px 3px; border: 1px solid #000; font-weight: bold;">Hasil Evaluasi Risiko Jatuh</td>
                                            <td style="padding: 2px 3px; border: 1px solid #000; text-align: center; font-weight: bold; color: {{ str_contains($data->hasil ?? '', 'tinggi') ? '#d9534f' : (str_contains($data->hasil ?? '', 'rendah') ? '#f0ad4e' : '#5cb85c') }};">
                                                {{ $data->hasil ?? 'Tidak beresiko' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 2px 3px; border: 1px solid #000;">Lapor Dokter</td>
                                            <td style="padding: 2px 3px; border: 1px solid #000; text-align: center;">{{ $data->lapor ?? 'Tidak' }} {{ (!empty($data->ket_lapor) && $data->ket_lapor != '-') ? '('.$data->ket_lapor.')' : '' }}</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <!-- SEKSI V. PENGKAJIAN NYERI (PQRST) -->
                    <div class="avoid-break">
                        <div class="section-header">V. PENGKAJIAN TINGKAT SKALA NYERI (PQRST)</div>
                        <table width="100%" class="border" style="margin-bottom: 4px; font-size: 8.5px; border-collapse: collapse;">
                            <tr style="background-color: #fafafa;">
                                <td width="15%" style="padding: 2px 4px; border: 1px solid #000; font-weight: bold;">Status Nyeri</td>
                                <td width="35%" style="padding: 2px 4px; border: 1px solid #000;"><strong>{{ $data->nyeri ?? 'Tidak Ada Nyeri' }}</strong></td>
                                <td width="15%" style="padding: 2px 4px; border: 1px solid #000; font-weight: bold;">Skala Nyeri (0-10)</td>
                                <td width="35%" style="padding: 2px 4px; border: 1px solid #000;">
                                    <strong style="font-size: 10px; color: {{ ($data->skala_nyeri ?? 0) >= 7 ? '#d9534f' : (($data->skala_nyeri ?? 0) >= 4 ? '#f0ad4e' : '#5cb85c') }};">
                                        Skala {{ $data->skala_nyeri ?? '0' }} / 10
                                    </strong>
                                </td>
                            </tr>
                            @if(($data->nyeri ?? '') != 'Tidak Ada Nyeri' && ($data->nyeri ?? '') != '')
                            <tr>
                                <td style="padding: 2px 4px; border: 1px solid #000; font-weight: bold;">Provokes (Pemicu)</td>
                                <td style="padding: 2px 4px; border: 1px solid #000;">{{ $data->provokes ?? '-' }} {{ (!empty($data->ket_provokes) && $data->ket_provokes != '-') ? '('.$data->ket_provokes.')' : '' }}</td>
                                <td style="padding: 2px 4px; border: 1px solid #000; font-weight: bold;">Quality (Kualitas)</td>
                                <td style="padding: 2px 4px; border: 1px solid #000;">{{ $data->quality ?? '-' }} {{ (!empty($data->ket_quality) && $data->ket_quality != '-') ? '('.$data->ket_quality.')' : '' }}</td>
                            </tr>
                            <tr style="background-color: #fafafa;">
                                <td style="padding: 2px 4px; border: 1px solid #000; font-weight: bold;">Region (Lokasi / Radiasi)</td>
                                <td style="padding: 2px 4px; border: 1px solid #000;">{{ $data->lokasi ?? '-' }} (Menyebar: {{ $data->menyebar ?? 'Tidak' }})</td>
                                <td style="padding: 2px 4px; border: 1px solid #000; font-weight: bold;">Timing &amp; Nyeri Hilang</td>
                                <td style="padding: 2px 4px; border: 1px solid #000;">Durasi: {{ $data->durasi ?? '-' }}, Hilang: {{ $data->nyeri_hilang ?? '-' }} {{ (!empty($data->ket_nyeri) && $data->ket_nyeri != '-') ? '('.$data->ket_nyeri.')' : '' }}</td>
                            </tr>
                            <tr>
                                <td style="padding: 2px 4px; border: 1px solid #000; font-weight: bold;">Lapor Ke Dokter</td>
                                <td colspan="3" style="padding: 2px 4px; border: 1px solid #000;">{{ $data->pada_dokter ?? 'Tidak' }} {{ (!empty($data->ket_dokter) && $data->ket_dokter != '-') ? ' (Jam Lapor: '.$data->ket_dokter.')' : '' }}</td>
                            </tr>
                            @endif
                        </table>
                    </div>

                    <!-- SEKSI VII. MASALAH & RENCANA KEPERAWATAN -->
                    <div class="avoid-break">
                        <div class="section-header">VII. MASALAH &amp; RENCANA KEPERAWATAN (INTERVENSI)</div>
                        <table width="100%" class="border" style="margin-bottom: 4px; font-size: 8.5px; border-collapse: collapse;">
                            <tr style="background-color: #eaeaea; text-align: center;">
                                <th width="45%" style="padding: 2.5px 4px; border: 1px solid #000;">Masalah Keperawatan Teridentifikasi</th>
                                <th width="55%" style="padding: 2.5px 4px; border: 1px solid #000;">Rencana Intervensi Keperawatan</th>
                            </tr>
                            <tr>
                                <td style="vertical-align: top; padding: 4px 6px; border: 1px solid #000;">
                                    @if(count($masalahList) > 0)
                                        <ul style="margin: 0; padding-left: 15px;">
                                            @foreach($masalahList as $masalah)
                                                <li style="margin-bottom: 2px;">
                                                    <strong>{{ $masalah->masterMasalah->nama_masalah ?? $masalah->kode_masalah }}</strong>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <em>- Tidak ada masalah keperawatan yang dipilih -</em>
                                    @endif
                                </td>
                                <td style="vertical-align: top; padding: 4px 6px; border: 1px solid #000;">
                                    @if(count($rencanaList) > 0)
                                        <ul style="margin: 0; padding-left: 15px;">
                                            @foreach($rencanaList as $rencana)
                                                <li style="margin-bottom: 2px;">
                                                    {{ $rencana->masterRencana->rencana_keperawatan ?? $rencana->kode_rencana }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <em>- Tidak ada rencana intervensi yang dipilih -</em>
                                    @endif

                                    @if(!empty($data->rencana) && $data->rencana != '-')
                                        <div style="margin-top: 4px; border-top: 1px dashed #ccc; padding-top: 2px;">
                                            <strong>Catatan / Rencana Tambahan:</strong><br>
                                            <span style="white-space: pre-line;">{{ $data->rencana }}</span>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>

                    <!-- TANDA TANGAN PERAWAT PENGKAJI -->
                    <div class="avoid-break" style="margin-top: 6px;">
                        <table width="100%" class="table-borderless" style="text-align: right; font-size: 9.5px;">
                            <tr>
                                <td width="55%"></td>
                                <td width="45%" style="text-align: center;">
                                    Pekalongan, {{ date('d-m-Y H:i', strtotime($data->tanggal)) }}<br>
                                    Perawat Pengkaji UGD,<br>
                                    <div style="height: 55px; margin: 3px 0; text-align: center;">
                                        @if (!empty($petugas->nip) || !empty($data->nip))
                                            @php
                                                $namaPetugas = $petugas->nama ?? $data->nip;
                                                $nipPetugas = $petugas->nip ?? $data->nip;
                                                $qrText = 'Diverifikasi secara elektronik oleh Perawat Pengkaji: ' . $namaPetugas . ' (NIP: ' . $nipPetugas . ') pada ' . date('d-m-Y H:i', strtotime($data->tanggal));
                                            @endphp
                                            <img src="data:image/png;base64,{!! DNS2D::getBarcodePNG($qrText, 'QRCODE', 2.3, 2.3) !!}" height="50" />
                                        @else
                                            <br><br>
                                        @endif
                                    </div>
                                    ( <strong>{{ $petugas->nama ?? $data->nip ?? '............................................' }}</strong> )<br>
                                    <span style="font-size: 8px; color: #555;">NIP. {{ $petugas->nip ?? $data->nip ?? '-' }}</span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
@endsection
