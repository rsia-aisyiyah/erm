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
        .checkbox-symbol {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            font-weight: bold;
        }
        .avoid-break {
            page-break-inside: avoid;
        }
        thead {
            display: table-header-group;
        }
        tfoot {
            display: table-footer-group;
        }
    </style>

    @php
        $pasien = $data->regPeriksa->pasien ?? null;
        $rsia = $data->rsiaAsmed ?? null;
        $kategoriTerapi = $rsia ? ($rsia->terapi_kategori ?? '') : '';
        $isPreventif = str_contains($kategoriTerapi, 'Preventif');
        $isKuratif = str_contains($kategoriTerapi, 'Kuratif');
        $isRehab = str_contains($kategoriTerapi, 'Rehabilitatif');
        $isPaliatif = str_contains($kategoriTerapi, 'Paliatif');

        $tindakLanjut = $rsia ? ($rsia->tindak_lanjut ?? '') : '';
        $isRajal = ($tindakLanjut == 'Rawat Jalan');
        $isRanap = ($tindakLanjut == 'Rawat Inap');
        $isRujuk = ($tindakLanjut == 'Dirujuk');

        $kondisiPulang = $rsia ? ($rsia->kondisi_pulang ?? '') : '';
        $rujukAlasan = $rsia ? ($rsia->rujuk_alasan ?? '') : '';
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
                        ASESMEN AWAL MEDIS GAWAT DARURAT
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="border: none; padding: 0;">
                    <!-- ANAMNESIS, TTV & PEMERIKSAAN FISIK LENGKAP -->
                    <table width="100%" class="table-print" style="margin-bottom: 5px; font-size: 9.5px; border-collapse: collapse;">
                        <tr style="background-color: #f8f9fa;">
                            <td width="50%" style="padding: 3px 5px;">
                                <strong>Tgl. Asesmen:</strong> {{ date('d-m-Y H:i', strtotime($data->tanggal)) }}<br>
                                <strong>Dokter Pemeriksa:</strong> {{ $data->dokter->nm_dokter ?? '-' }}
                            </td>
                            <td width="50%" style="padding: 3px 5px;">
                                <strong>Anamnesis:</strong> {{ $data->anamnesis ?? '-' }} @if(!empty($data->hubungan) && $data->hubungan != '-') ({{ $data->hubungan }}) @endif<br>
                                <strong>Alergi:</strong> <span style="{{ (!empty($data->alergi) && $data->alergi != '-') ? 'color: #dc3545; font-weight: bold;' : '' }}">{{ $data->alergi ?? '-' }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding: 3px 5px;">
                                <table width="100%" style="border: none; font-size: 9.5px; border-collapse: collapse;">
                                    <tr>
                                        <td width="18%" style="vertical-align: top; font-weight: bold; border: none; padding: 1px 0;">Keluhan Utama</td>
                                        <td width="2%" style="vertical-align: top; border: none; padding: 1px 0;">:</td>
                                        <td width="80%" style="vertical-align: top; border: none; padding: 1px 0;">{{ $data->keluhan_utama ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: top; font-weight: bold; border: none; padding: 1px 0;">RPS</td>
                                        <td style="vertical-align: top; border: none; padding: 1px 0;">:</td>
                                        <td style="vertical-align: top; border: none; padding: 1px 0;">{{ $data->rps ?? '-' }}</td>
                                    </tr>
                                    @if(!empty($data->rpd) && $data->rpd != '-')
                                    <tr>
                                        <td style="vertical-align: top; font-weight: bold; border: none; padding: 1px 0;">RPD</td>
                                        <td style="vertical-align: top; border: none; padding: 1px 0;">:</td>
                                        <td style="vertical-align: top; border: none; padding: 1px 0;">{{ $data->rpd }}</td>
                                    </tr>
                                    @endif
                                    @if(!empty($data->rpo) && $data->rpo != '-')
                                    <tr>
                                        <td style="vertical-align: top; font-weight: bold; border: none; padding: 1px 0;">RPO</td>
                                        <td style="vertical-align: top; border: none; padding: 1px 0;">:</td>
                                        <td style="vertical-align: top; border: none; padding: 1px 0;">{{ $data->rpo }}</td>
                                    </tr>
                                    @endif
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding: 3px 5px; background-color: #fafafa;">
                                <div style="font-weight: bold; margin-bottom: 2px;">Tanda Vital &amp; Keadaan Fisik:</div>
                                <table width="100%" class="border" style="font-size: 8.5px; text-align: center; border-collapse: collapse;">
                                    <tr style="background-color: #eaeaea;">
                                        <th style="padding: 1.5px 3px; border: 1px solid #000; width: 14%;">Keadaan Umum</th>
                                        <th style="padding: 1.5px 3px; border: 1px solid #000; width: 14%;">Kesadaran</th>
                                        <th style="padding: 1.5px 3px; border: 1px solid #000; width: 12%;">GCS</th>
                                        <th style="padding: 1.5px 3px; border: 1px solid #000; width: 12%;">TD</th>
                                        <th style="padding: 1.5px 3px; border: 1px solid #000; width: 12%;">Nadi</th>
                                        <th style="padding: 1.5px 3px; border: 1px solid #000; width: 12%;">RR</th>
                                        <th style="padding: 1.5px 3px; border: 1px solid #000; width: 12%;">Suhu</th>
                                        <th style="padding: 1.5px 3px; border: 1px solid #000; width: 12%;">SpO2</th>
                                    </tr>
                                    <tr>
                                        <td style="padding: 1.5px 3px; border: 1px solid #000;">{{ $data->keadaan ?? '-' }}</td>
                                        <td style="padding: 1.5px 3px; border: 1px solid #000;">{{ $data->kesadaran ?? '-' }}</td>
                                        <td style="padding: 1.5px 3px; border: 1px solid #000;">{{ $data->gcs ?? '-' }}</td>
                                        <td style="padding: 1.5px 3px; border: 1px solid #000;">{{ $data->td ? $data->td . ' mmHg' : '-' }}</td>
                                        <td style="padding: 1.5px 3px; border: 1px solid #000;">{{ $data->nadi ? $data->nadi . ' x/m' : '-' }}</td>
                                        <td style="padding: 1.5px 3px; border: 1px solid #000;">{{ $data->rr ? $data->rr . ' x/m' : '-' }}</td>
                                        <td style="padding: 1.5px 3px; border: 1px solid #000;">{{ $data->suhu ? $data->suhu . ' °C' : '-' }}</td>
                                        <td style="padding: 1.5px 3px; border: 1px solid #000;">{{ $data->spo ? $data->spo . ' %' : '-' }}</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding: 3px 5px;">
                                <div style="font-weight: bold; margin-bottom: 2px;">Pemeriksaan Fisik (Status Generalis):</div>
                                @php
                                    $organKiri = [
                                        ['label' => 'Kepala', 'status' => $data->kepala ?? 'Normal', 'ket' => $rsia->ket_kepala ?? ''],
                                        ['label' => 'Mata', 'status' => $data->mata ?? 'Normal', 'ket' => $rsia->ket_mata ?? ''],
                                        ['label' => 'THT', 'status' => $rsia->tht ?? 'Normal', 'ket' => $rsia->ket_tht ?? ''],
                                        ['label' => 'Mulut', 'status' => $data->gigi ?? 'Normal', 'ket' => $rsia->ket_gigi ?? ''],
                                        ['label' => 'Leher', 'status' => $data->leher ?? 'Normal', 'ket' => $rsia->ket_leher ?? ''],
                                        ['label' => 'Jantung', 'status' => $rsia->jantung ?? 'Normal', 'ket' => $rsia->ket_jantung ?? ''],
                                        ['label' => 'Paru-paru', 'status' => $rsia->paru ?? 'Normal', 'ket' => $rsia->ket_paru ?? ''],
                                    ];
                                    $organKanan = [
                                        ['label' => 'Dada & Payudara', 'status' => $data->thoraks ?? 'Normal', 'ket' => $rsia->ket_thoraks ?? ''],
                                        ['label' => 'Perut', 'status' => $data->abdomen ?? 'Normal', 'ket' => $rsia->ket_abdomen ?? ''],
                                        ['label' => 'Urogenital', 'status' => $data->genital ?? 'Normal', 'ket' => $rsia->ket_genital ?? ''],
                                        ['label' => 'Anggota Gerak', 'status' => $data->ekstremitas ?? 'Normal', 'ket' => $rsia->ket_ekstremitas ?? ''],
                                        ['label' => 'Status Neurologis', 'status' => $rsia->neurologis ?? 'Normal', 'ket' => $rsia->ket_neurologis ?? ''],
                                        ['label' => 'Muskuloskeletal', 'status' => $rsia->muskuloskeletal ?? 'Normal', 'ket' => $rsia->ket_muskuloskeletal ?? ''],
                                    ];
                                @endphp
                                <table width="100%" style="border-collapse: collapse; border: none; margin-bottom: 2px;">
                                    <tr>
                                        <td style="width: 50%; vertical-align: top; padding: 0 2px 0 0; border: none;">
                                            <table width="100%" class="border" style="font-size: 8px; border-collapse: collapse;">
                                                <tr style="background-color: #eaeaea; text-align: center;">
                                                    <th style="padding: 1.5px 3px; border: 1px solid #000; width: 30%;">Pemeriksaan</th>
                                                    <th style="padding: 1.5px 3px; border: 1px solid #000; width: 22%;">Status</th>
                                                    <th style="padding: 1.5px 3px; border: 1px solid #000; width: 48%;">Jika tidak normal, jelaskan</th>
                                                </tr>
                                                @foreach($organKiri as $org)
                                                <tr>
                                                    <td style="padding: 1px 3px; border: 1px solid #000; font-weight: 500;">{{ $org['label'] }}</td>
                                                    <td style="padding: 1px 3px; border: 1px solid #000; text-align: center;">
                                                        {!! ($org['status'] == 'Normal') ? 'Normal' : (($org['status'] == 'Abnormal') ? '<strong style="color:#d9534f;">Abnormal</strong>' : 'Tidak Diperiksa') !!}
                                                    </td>
                                                    <td style="padding: 1px 3px; border: 1px solid #000;">
                                                        {{ (!empty($org['ket']) && $org['ket'] != '-') ? $org['ket'] : '-' }}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td style="width: 50%; vertical-align: top; padding: 0 0 0 2px; border: none;">
                                            <table width="100%" class="border" style="font-size: 8px; border-collapse: collapse;">
                                                <tr style="background-color: #eaeaea; text-align: center;">
                                                    <th style="padding: 1.5px 3px; border: 1px solid #000; width: 34%;">Pemeriksaan</th>
                                                    <th style="padding: 1.5px 3px; border: 1px solid #000; width: 22%;">Status</th>
                                                    <th style="padding: 1.5px 3px; border: 1px solid #000; width: 44%;">Jika tidak normal, jelaskan</th>
                                                </tr>
                                                @foreach($organKanan as $org)
                                                <tr>
                                                    <td style="padding: 1px 3px; border: 1px solid #000; font-weight: 500;">{{ $org['label'] }}</td>
                                                    <td style="padding: 1px 3px; border: 1px solid #000; text-align: center;">
                                                        {!! ($org['status'] == 'Normal') ? 'Normal' : (($org['status'] == 'Abnormal') ? '<strong style="color:#d9534f;">Abnormal</strong>' : 'Tidak Diperiksa') !!}
                                                    </td>
                                                    <td style="padding: 1px 3px; border: 1px solid #000;">
                                                        {{ (!empty($org['ket']) && $org['ket'] != '-') ? $org['ket'] : '-' }}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding: 3px 5px;">
                                <div style="font-weight: bold; margin-bottom: 2px;">Pemeriksaan Penunjang &amp; Status Lokalis :</div>
                                <table width="100%" class="border" style="font-size: 8px; border-collapse: collapse;">
                                    <tr style="background-color: #eaeaea; text-align: center;">
                                        <th style="padding: 1.5px 3px; border: 1px solid #000; width: 33%;">Laboratorium</th>
                                        <th style="padding: 1.5px 3px; border: 1px solid #000; width: 33%;">Radiologi</th>
                                        <th style="padding: 1.5px 3px; border: 1px solid #000; width: 34%;">EKG</th>
                                    </tr>
                                    <tr>
                                        <td style="padding: 2px 4px; border: 1px solid #000; vertical-align: top; min-height: 16px; white-space: pre-line;">{{ (!empty($data->lab) && $data->lab != '-') ? $data->lab : '-' }}</td>
                                        <td style="padding: 2px 4px; border: 1px solid #000; vertical-align: top; min-height: 16px; white-space: pre-line;">{{ (!empty($data->rad) && $data->rad != '-') ? $data->rad : '-' }}</td>
                                        <td style="padding: 2px 4px; border: 1px solid #000; vertical-align: top; min-height: 16px; white-space: pre-line;">{{ (!empty($data->ekg) && $data->ekg != '-') ? $data->ekg : '-' }}</td>
                                    </tr>
                                </table>
                                @if(!empty($data->ket_lokalis) && $data->ket_lokalis != '-')
                                <div style="margin-top: 2px; font-size: 8.5px;">
                                    <strong>Status Lokalis :</strong> {{ $data->ket_lokalis }}
                                </div>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding: 3px 5px;">
                                <strong>Diagnosis / Asesmen Medis :</strong>
                                <span style="font-weight: bold; color: #000; margin-left: 6px;">{{ $data->diagnosis ?? '-' }}</span>
                            </td>
                        </tr>
                    </table>

                    <!-- SECTION TERAPI (AKP) - 2 KOLOM BERDAMPINGAN -->
                    <div class="avoid-break" style="margin-bottom: 5px;">
                        <div style="font-weight: bold; font-size: 10px; margin-bottom: 2px;">TERAPI</div>
                        <div style="font-size: 9.5px; margin-bottom: 3px;">
                            <span class="checkbox-symbol">{!! $isPreventif ? '&#9745;' : '&#9744;' !!}</span> Preventif &nbsp;&nbsp;&nbsp;&nbsp;
                            <span class="checkbox-symbol">{!! $isKuratif ? '&#9745;' : '&#9744;' !!}</span> Kuratif &nbsp;&nbsp;&nbsp;&nbsp;
                            <span class="checkbox-symbol">{!! $isRehab ? '&#9745;' : '&#9744;' !!}</span> Rehabilitatif &nbsp;&nbsp;&nbsp;&nbsp;
                            <span class="checkbox-symbol">{!! $isPaliatif ? '&#9745;' : '&#9744;' !!}</span> Paliatif
                        </div>

                        <table width="100%" class="border" style="border-collapse: collapse; font-size: 9px; margin-bottom: 2px;">
                            <tr>
                                <td width="50%" style="vertical-align: top; border: 1px solid #000; padding: 3px 5px;">
                                    <strong>Terapi Farmakologis :</strong>
                                    <div style="min-height: 25px; margin-top: 2px; white-space: pre-line; font-size: 9px;">
                                        {{ $rsia->terapi_farmakologis ?? $data->tata ?? '-' }}
                                    </div>
                                </td>
                                <td width="50%" style="vertical-align: top; border: 1px solid #000; padding: 3px 5px;">
                                    <strong>Terapi Non Farmakologis :</strong>
                                    <div style="min-height: 25px; margin-top: 2px; white-space: pre-line; font-size: 9px;">
                                        {{ $rsia->terapi_non_farmakologis ?? '-' }}
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <!-- SECTION RENCANA TINDAK LANJUT -->
                    <div class="avoid-break" style="margin-bottom: 5px;">
                        <div style="font-weight: bold; font-size: 10px; margin-bottom: 2px;">RENCANA TINDAK LANJUT</div>
                        <div class="box-section" style="line-height: 1.35; margin-bottom: 0;">
                            <!-- Rawat Jalan -->
                            <div>
                                <span class="checkbox-symbol">{!! $isRajal ? '&#9745;' : '&#9744;' !!}</span> <strong>Rawat Jalan</strong> &nbsp;&nbsp; Kontrol ke : {{ $isRajal ? ($rsia->kontrol_ke ?? '..................................') : '..................................' }}
                            </div>

                            <!-- Rawat Inap -->
                            <div style="margin-top: 2px;">
                                <span class="checkbox-symbol">{!! $isRanap ? '&#9745;' : '&#9744;' !!}</span> <strong>Rawat Inap</strong> &nbsp;&nbsp; Indikasi : {{ $isRanap ? ($rsia->ranap_indikasi ?? '..................................') : '..................................' }}<br>
                                <div style="margin-left: 15px;">
                                    SMF : 
                                    <span class="checkbox-symbol">{!! ($isRanap && ($rsia->ranap_smf ?? '') == 'Obsgyn') ? '&#9745;' : '&#9744;' !!}</span> Obsgyn &nbsp;&nbsp;
                                    <span class="checkbox-symbol">{!! ($isRanap && ($rsia->ranap_smf ?? '') == 'Anak') ? '&#9745;' : '&#9744;' !!}</span> Anak &nbsp;&nbsp;
                                    <span class="checkbox-symbol">{!! ($isRanap && !in_array($rsia->ranap_smf ?? '', ['Obsgyn','Anak',''])) ? '&#9745;' : '&#9744;' !!}</span> {{ ($isRanap && !in_array($rsia->ranap_smf ?? '', ['Obsgyn','Anak',''])) ? $rsia->ranap_smf : '..........' }} &nbsp;&nbsp;&nbsp;&nbsp;
                                    DPJP : {{ $isRanap ? ($rsia->dpjp->nm_dokter ?? $rsia->ranap_dpjp ?? '..................................') : '..................................' }}<br>
                                    Jenis Ruang : 
                                    <span class="checkbox-symbol">{!! ($isRanap && ($rsia->ranap_ruang ?? '') == 'Bangsal') ? '&#9745;' : '&#9744;' !!}</span> Bangsal &nbsp;&nbsp;
                                    <span class="checkbox-symbol">{!! ($isRanap && ($rsia->ranap_ruang ?? '') == 'Isolasi') ? '&#9745;' : '&#9744;' !!}</span> Isolasi &nbsp;&nbsp;
                                    <span class="checkbox-symbol">{!! ($isRanap && str_contains($rsia->ranap_ruang ?? '', 'Intensif')) ? '&#9745;' : '&#9744;' !!}</span> Intensif (ICU/NICU/PICU) &nbsp;&nbsp;
                                    <span class="checkbox-symbol">{!! ($isRanap && ($rsia->ranap_ruang ?? '') == 'VK') ? '&#9745;' : '&#9744;' !!}</span> VK &nbsp;&nbsp;
                                    <span class="checkbox-symbol">{!! ($isRanap && ($rsia->ranap_ruang ?? '') == 'Perinatologi') ? '&#9745;' : '&#9744;' !!}</span> Perinatologi
                                </div>
                            </div>

                            <!-- Dirujuk ke -->
                            <div style="margin-top: 2px;">
                                <span class="checkbox-symbol">{!! $isRujuk ? '&#9745;' : '&#9744;' !!}</span> <strong>Dirujuk ke</strong> &nbsp;&nbsp;
                                <span class="checkbox-symbol">{!! ($isRujuk && ($rsia->rujuk_tujuan ?? '') == 'RS') ? '&#9745;' : '&#9744;' !!}</span> RS {{ ($isRujuk && ($rsia->rujuk_tujuan ?? '') == 'RS') ? ($rsia->rujuk_nama_faskes ?? '................') : '................' }} &nbsp;&nbsp;&nbsp;&nbsp;
                                <span class="checkbox-symbol">{!! ($isRujuk && ($rsia->rujuk_tujuan ?? '') == 'Puskesmas') ? '&#9745;' : '&#9744;' !!}</span> Puskesmas {{ ($isRujuk && ($rsia->rujuk_tujuan ?? '') == 'Puskesmas') ? ($rsia->rujuk_nama_faskes ?? '................') : '................' }}<br>
                                <div style="margin-left: 15px;">
                                    Atas dasar : 
                                    <span class="checkbox-symbol">{!! ($isRujuk && str_contains($rujukAlasan, 'Kamar Penuh')) ? '&#9745;' : '&#9744;' !!}</span> Kamar Penuh &nbsp;&nbsp;
                                    <span class="checkbox-symbol">{!! ($isRujuk && str_contains($rujukAlasan, 'Perlu Fasilitas dan SDM')) ? '&#9745;' : '&#9744;' !!}</span> Perlu Fasilitas dan SDM &nbsp;&nbsp;
                                    <span class="checkbox-symbol">{!! ($isRujuk && str_contains($rujukAlasan, 'Permintaan Pasien / Keluarga')) ? '&#9745;' : '&#9744;' !!}</span> Permintaan Pasien / Keluarga<br>
                                    Diantar oleh : 
                                    <span class="checkbox-symbol">{!! ($isRujuk && ($rsia->rujuk_transport ?? '') == 'Ambulans') ? '&#9745;' : '&#9744;' !!}</span> Ambulans &nbsp;&nbsp;
                                    <span class="checkbox-symbol">{!! ($isRujuk && ($rsia->rujuk_transport ?? '') == 'Kendaraan Pribadi') ? '&#9745;' : '&#9744;' !!}</span> Kendaraan Pribadi
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION KONDISI PASIEN PULANG -->
                    <div class="avoid-break" style="margin-bottom: 5px;">
                        <div style="font-weight: bold; font-size: 10px; margin-bottom: 2px;">KONDISI PASIEN PULANG</div>
                        <div class="box-section" style="margin-bottom: 0;">
                            <div>
                                <span class="checkbox-symbol">{!! $kondisiPulang == 'Perbaikan' ? '&#9745;' : '&#9744;' !!}</span> Perbaikan
                            </div>
                            <div style="margin-top: 2px;">
                                <span class="checkbox-symbol">{!! $kondisiPulang == 'Menolak Rawat Inap' ? '&#9745;' : '&#9744;' !!}</span> Menolak Rawat Inap (Formulir Penolakan Rawat Inap)
                            </div>
                            <div style="margin-top: 2px;">
                                <span class="checkbox-symbol">{!! $kondisiPulang == 'Meninggal Dunia' ? '&#9745;' : '&#9744;' !!}</span> Meninggal Dunia &nbsp;&nbsp;&nbsp;&nbsp;
                                Hari : {{ ($kondisiPulang == 'Meninggal Dunia' && $rsia->tgl_meninggal) ? \Carbon\Carbon::parse($rsia->tgl_meninggal)->locale('id')->isoFormat('dddd') : '...........' }} &nbsp;&nbsp;&nbsp;&nbsp;
                                Tanggal : {{ ($kondisiPulang == 'Meninggal Dunia' && $rsia->tgl_meninggal) ? date('d-m-Y', strtotime($rsia->tgl_meninggal)) : '...........' }} &nbsp;&nbsp;&nbsp;&nbsp;
                                Jam : {{ ($kondisiPulang == 'Meninggal Dunia' && $rsia->jam_meninggal) ? date('H:i', strtotime($rsia->jam_meninggal)) : '...........' }}
                            </div>
                        </div>
                    </div>

                    <!-- SELESAI PELAYANAN & TANDA TANGAN -->
                    <div class="avoid-break" style="margin-top: 4px;">
                        <div style="text-align: right; font-size: 9.5px; margin-bottom: 3px;">
                            Selesai Pelayanan UGD : Tanggal {{ ($rsia && $rsia->selesai_layanan_tgl) ? date('d-m-Y', strtotime($rsia->selesai_layanan_tgl)) : '...................' }} &nbsp;&nbsp;
                            Jam {{ ($rsia && $rsia->selesai_layanan_jam) ? date('H:i', strtotime($rsia->selesai_layanan_jam)) : '...................' }}
                        </div>

                        <table width="100%" class="table-borderless" style="text-align: center; font-size: 9.5px; margin-top: 2px;">
                            <tr>
                                <td width="50%">
                                    Pasien / Keluarga<br>
                                    <div style="height: 55px; margin: 2px 0;">
                                        @if (!empty($rsia) && !empty($rsia->ttd_pasien))
                                            @php
                                                $ttdSrc = $rsia->ttd_pasien;
                                                if (!str_starts_with($ttdSrc, 'data:image')) {
                                                    $absStorage = storage_path('app/public/' . ltrim($ttdSrc, '/'));
                                                    $absPublic = public_path('storage/' . ltrim($ttdSrc, '/'));
                                                    if (file_exists($absStorage)) {
                                                        $ttdSrc = $absStorage;
                                                    } elseif (file_exists($absPublic)) {
                                                        $ttdSrc = $absPublic;
                                                    }
                                                }
                                            @endphp
                                            <img src="{{ $ttdSrc }}" height="50" />
                                        @else
                                            <br><br>
                                        @endif
                                    </div>
                                    ( <strong>{{ $rsia->nama_keluarga_ttd ?? $pasien->nm_pasien ?? '............................................' }}</strong> )<br>
                                    <span style="font-size: 8.5px; color: #555;">Tanda tangan dan nama terang</span>
                                </td>
                                <td width="50%">
                                    Dokter Jaga UGD<br>
                                    <div style="height: 55px; margin: 2px 0; text-align: center;">
                                        @if (!empty($data->kd_dokter))
                                            @php
                                                $qrText = 'Diverifikasi secara elektronik oleh: ' . ($data->dokter->nm_dokter ?? '-') . ' pada ' . date('d-m-Y H:i', strtotime($data->tanggal));
                                            @endphp
                                            <img src="data:image/png;base64,{!! DNS2D::getBarcodePNG($qrText, 'QRCODE', 2.3, 2.3) !!}" height="50" />
                                        @else
                                            <br><br>
                                        @endif
                                    </div>
                                    ( <strong>{{ $data->dokter->nm_dokter ?? '............................................' }}</strong> )<br>
                                    <span style="font-size: 8.5px; color: #555;">Tanda tangan dan nama terang</span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
@endsection