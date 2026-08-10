@extends('content.print.main')
@section('content')
    <style>
        .box-title {
            border: 1.5px solid #000;
            text-align: center;
            font-weight: bold;
            font-size: 13px;
            padding: 5px;
            margin-top: 5px;
            margin-bottom: 10px;
            background-color: #f2f2f2;
        }
        .table-borderless td, .table-borderless th {
            border: none;
            padding: 2px 4px;
            font-size: 11px;
            vertical-align: top;
        }
        .box-section {
            border: 1px solid #000;
            padding: 6px 8px;
            margin-bottom: 8px;
            font-size: 11px;
        }
        .checkbox-symbol {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            font-weight: bold;
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

    <!-- HEADER KOP & DATA PASIEN -->
    <table width="100%" class="table-borderless" style="border-bottom: 2px solid #000; padding-bottom: 4px;">
        <tr>
            <td width="10%" style="vertical-align: middle; text-align: center;">
                <img src="{{ public_path('img/logo.png') }}" width="65" />
            </td>
            <td width="55%" style="vertical-align: middle;">
                <strong style="font-size: 13px; display: block;">RUMAH SAKIT IBU DAN ANAK AISYIYAH</strong>
                <strong style="font-size: 13px; display: block;">PEKAJANGAN &ndash; PEKALONGAN</strong>
                <span style="font-size: 10px; display: block;">Jl. Raya Pekajangan No. 610 Pekajangan, Pekalongan, 51172</span>
                <span style="font-size: 10px; display: block;">Telp. (0285) 785909 Email: pekajangan@rsiaaisyiyah.com</span>
                <span style="font-size: 10px; display: block;">Website: www.rsiaaisyiyah.com</span>
            </td>
            <td width="35%" style="vertical-align: top;">
                <table width="100%" class="border" style="font-size: 10.5px; border-collapse: collapse;">
                    <tr>
                        <td width="35%" style="padding: 2px 4px; border: 1px solid #000;"><strong>No. RM</strong></td>
                        <td width="65%" style="padding: 2px 4px; border: 1px solid #000;">: {{ $pasien->no_rkm_medis ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 2px 4px; border: 1px solid #000;"><strong>Nama</strong></td>
                        <td style="padding: 2px 4px; border: 1px solid #000;">: {{ $pasien->nm_pasien ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 2px 4px; border: 1px solid #000;"><strong>Tgl. Lahir</strong></td>
                        <td style="padding: 2px 4px; border: 1px solid #000;">: {{ $pasien->tgl_lahir ? date('d-m-Y', strtotime($pasien->tgl_lahir)) : '-' }} ({{ $pasien->jk ?? '-' }})</td>
                    </tr>
                    <tr>
                        <td style="padding: 2px 4px; border: 1px solid #000;"><strong>Alamat</strong></td>
                        <td style="padding: 2px 4px; border: 1px solid #000;">: {{ $pasien->alamat ?? '-' }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <div class="box-title">
        ASESMEN AWAL MEDIS GAWAT DARURAT
    </div>

    <!-- ANAMNESIS, TTV & PEMERIKSAAN FISIK LENGKAP -->
    <table width="100%" class="table-print" style="margin-bottom: 8px; font-size: 10px; border-collapse: collapse;">
        <tr style="background-color: #f8f9fa;">
            <td width="50%" style="padding: 4px 6px;">
                <strong>Tgl. Asesmen:</strong> {{ date('d-m-Y H:i', strtotime($data->tanggal)) }}<br>
                <strong>Dokter Pemeriksa:</strong> {{ $data->dokter->nm_dokter ?? '-' }}
            </td>
            <td width="50%" style="padding: 4px 6px;">
                <strong>Anamnesis:</strong> {{ $data->anamnesis ?? '-' }} @if(!empty($data->hubungan) && $data->hubungan != '-') ({{ $data->hubungan }}) @endif<br>
                <strong>Alergi:</strong> <span style="{{ (!empty($data->alergi) && $data->alergi != '-') ? 'color: #dc3545; font-weight: bold;' : '' }}">{{ $data->alergi ?? '-' }}</span>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="padding: 5px 6px;">
                <table width="100%" style="border: none; font-size: 10px; border-collapse: collapse;">
                    <tr>
                        <td width="20%" style="vertical-align: top; font-weight: bold; border: none; padding: 1.5px 0;">Keluhan Utama</td>
                        <td width="2%" style="vertical-align: top; border: none; padding: 1.5px 0;">:</td>
                        <td width="78%" style="vertical-align: top; border: none; padding: 1.5px 0;">{{ $data->keluhan_utama ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; font-weight: bold; border: none; padding: 1.5px 0;">RPS</td>
                        <td style="vertical-align: top; border: none; padding: 1.5px 0;">:</td>
                        <td style="vertical-align: top; border: none; padding: 1.5px 0;">{{ $data->rps ?? '-' }}</td>
                    </tr>
                    @if(!empty($data->rpd) && $data->rpd != '-')
                    <tr>
                        <td style="vertical-align: top; font-weight: bold; border: none; padding: 1.5px 0;">RPD</td>
                        <td style="vertical-align: top; border: none; padding: 1.5px 0;">:</td>
                        <td style="vertical-align: top; border: none; padding: 1.5px 0;">{{ $data->rpd }}</td>
                    </tr>
                    @endif
                    @if(!empty($data->rpo) && $data->rpo != '-')
                    <tr>
                        <td style="vertical-align: top; font-weight: bold; border: none; padding: 1.5px 0;">RPO</td>
                        <td style="vertical-align: top; border: none; padding: 1.5px 0;">:</td>
                        <td style="vertical-align: top; border: none; padding: 1.5px 0;">{{ $data->rpo }}</td>
                    </tr>
                    @endif
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="padding: 4px 6px; background-color: #fafafa;">
                <div style="font-weight: bold; margin-bottom: 2px;">Tanda Vital & Keadaan Fisik:</div>
                <table width="100%" class="border" style="font-size: 9.5px; text-align: center; border-collapse: collapse;">
                    <tr style="background-color: #eaeaea;">
                        <th style="padding: 2px 4px; border: 1px solid #000; width: 14%;">Keadaan Umum</th>
                        <th style="padding: 2px 4px; border: 1px solid #000; width: 14%;">Kesadaran</th>
                        <th style="padding: 2px 4px; border: 1px solid #000; width: 12%;">GCS</th>
                        <th style="padding: 2px 4px; border: 1px solid #000; width: 12%;">TD</th>
                        <th style="padding: 2px 4px; border: 1px solid #000; width: 12%;">Nadi</th>
                        <th style="padding: 2px 4px; border: 1px solid #000; width: 12%;">RR</th>
                        <th style="padding: 2px 4px; border: 1px solid #000; width: 12%;">Suhu</th>
                        <th style="padding: 2px 4px; border: 1px solid #000; width: 12%;">SpO2</th>
                    </tr>
                    <tr>
                        <td style="padding: 2px 4px; border: 1px solid #000;">{{ $data->keadaan ?? '-' }}</td>
                        <td style="padding: 2px 4px; border: 1px solid #000;">{{ $data->kesadaran ?? '-' }}</td>
                        <td style="padding: 2px 4px; border: 1px solid #000;">{{ $data->gcs ?? '-' }}</td>
                        <td style="padding: 2px 4px; border: 1px solid #000;">{{ $data->td ?? '-' }} mmHg</td>
                        <td style="padding: 2px 4px; border: 1px solid #000;">{{ $data->nadi ?? '-' }} x/m</td>
                        <td style="padding: 2px 4px; border: 1px solid #000;">{{ $data->rr ?? '-' }} x/m</td>
                        <td style="padding: 2px 4px; border: 1px solid #000;">{{ $data->suhu ?? '-' }} &deg;C</td>
                        <td style="padding: 2px 4px; border: 1px solid #000;">{{ $data->spo ?? '-' }} %</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="padding: 4px 6px;">
                <strong>Diagnosis / Asesmen Medis :</strong>
                <span style="font-weight: bold; color: #000; margin-left: 6px;">{{ $data->diagnosis ?? '-' }}</span>
            </td>
        </tr>
    </table>

    <!-- SECTION TERAPI (AKP) -->
    <div style="font-weight: bold; font-size: 11px; margin-bottom: 3px;">TERAPI</div>
    <div style="font-size: 11px; margin-bottom: 4px;">
        <span class="checkbox-symbol">{!! $isPreventif ? '&#9745;' : '&#9744;' !!}</span> Preventif &nbsp;&nbsp;&nbsp;&nbsp;
        <span class="checkbox-symbol">{!! $isKuratif ? '&#9745;' : '&#9744;' !!}</span> Kuratif &nbsp;&nbsp;&nbsp;&nbsp;
        <span class="checkbox-symbol">{!! $isRehab ? '&#9745;' : '&#9744;' !!}</span> Rehabilitatif &nbsp;&nbsp;&nbsp;&nbsp;
        <span class="checkbox-symbol">{!! $isPaliatif ? '&#9745;' : '&#9744;' !!}</span> Paliatif
    </div>

    <div class="box-section">
        <strong>Terapi Farmakologis :</strong>
        <div style="min-height: 40px; margin-top: 2px; white-space: pre-line;">
            {{ $rsia->terapi_farmakologis ?? $data->tata ?? '-' }}
        </div>
        <hr style="border-top: 1px dashed #999; margin: 4px 0;">
        <strong>Terapi Non Farmakologis :</strong>
        <div style="min-height: 30px; margin-top: 2px; white-space: pre-line;">
            {{ $rsia->terapi_non_farmakologis ?? '-' }}
        </div>
    </div>

    <!-- SECTION RENCANA TINDAK LANJUT -->
    <div style="font-weight: bold; font-size: 11px; margin-bottom: 3px;">RENCANA TINDAK LANJUT</div>
    <div class="box-section" style="line-height: 1.5;">
        <!-- Rawat Jalan -->
        <div>
            <span class="checkbox-symbol">{!! $isRajal ? '&#9745;' : '&#9744;' !!}</span> <strong>Rawat Jalan</strong> &nbsp;&nbsp; Kontrol ke : {{ $isRajal ? ($rsia->kontrol_ke ?? '..................................') : '..................................' }}
        </div>

        <!-- Rawat Inap -->
        <div style="margin-top: 4px;">
            <span class="checkbox-symbol">{!! $isRanap ? '&#9745;' : '&#9744;' !!}</span> <strong>Rawat Inap</strong> &nbsp;&nbsp; Indikasi : {{ $isRanap ? ($rsia->ranap_indikasi ?? '..................................') : '..................................' }}<br>
            <div style="margin-left: 20px;">
                DPJP : {{ $isRanap ? ($rsia->dpjp->nm_dokter ?? $rsia->ranap_dpjp ?? '..................................') : '..................................' }} &nbsp;&nbsp;&nbsp;&nbsp;
                SMF : 
                <span class="checkbox-symbol">{!! ($isRanap && ($rsia->ranap_smf ?? '') == 'Obsgyn') ? '&#9745;' : '&#9744;' !!}</span> Obsgyn &nbsp;&nbsp;
                <span class="checkbox-symbol">{!! ($isRanap && ($rsia->ranap_smf ?? '') == 'Anak') ? '&#9745;' : '&#9744;' !!}</span> Anak &nbsp;&nbsp;
                <span class="checkbox-symbol">{!! ($isRanap && !in_array($rsia->ranap_smf ?? '', ['Obsgyn','Anak',''])) ? '&#9745;' : '&#9744;' !!}</span> {{ ($isRanap && !in_array($rsia->ranap_smf ?? '', ['Obsgyn','Anak',''])) ? $rsia->ranap_smf : '..........' }}<br>
                Jenis Ruang : 
                <span class="checkbox-symbol">{!! ($isRanap && ($rsia->ranap_ruang ?? '') == 'Bangsal') ? '&#9745;' : '&#9744;' !!}</span> Bangsal &nbsp;&nbsp;
                <span class="checkbox-symbol">{!! ($isRanap && ($rsia->ranap_ruang ?? '') == 'Isolasi') ? '&#9745;' : '&#9744;' !!}</span> Isolasi &nbsp;&nbsp;
                <span class="checkbox-symbol">{!! ($isRanap && str_contains($rsia->ranap_ruang ?? '', 'Intensif')) ? '&#9745;' : '&#9744;' !!}</span> Intensif (ICU/NICU/PICU) &nbsp;&nbsp;
                <span class="checkbox-symbol">{!! ($isRanap && ($rsia->ranap_ruang ?? '') == 'VK') ? '&#9745;' : '&#9744;' !!}</span> VK &nbsp;&nbsp;
                <span class="checkbox-symbol">{!! ($isRanap && ($rsia->ranap_ruang ?? '') == 'Perinatologi') ? '&#9745;' : '&#9744;' !!}</span> Perinatologi
            </div>
        </div>

        <!-- Dirujuk ke -->
        <div style="margin-top: 4px;">
            <span class="checkbox-symbol">{!! $isRujuk ? '&#9745;' : '&#9744;' !!}</span> <strong>Dirujuk ke</strong> &nbsp;&nbsp;
            <span class="checkbox-symbol">{!! ($isRujuk && ($rsia->rujuk_tujuan ?? '') == 'RS') ? '&#9745;' : '&#9744;' !!}</span> RS {{ ($isRujuk && ($rsia->rujuk_tujuan ?? '') == 'RS') ? ($rsia->rujuk_nama_faskes ?? '................') : '................' }} &nbsp;&nbsp;&nbsp;&nbsp;
            <span class="checkbox-symbol">{!! ($isRujuk && ($rsia->rujuk_tujuan ?? '') == 'Puskesmas') ? '&#9745;' : '&#9744;' !!}</span> Puskesmas {{ ($isRujuk && ($rsia->rujuk_tujuan ?? '') == 'Puskesmas') ? ($rsia->rujuk_nama_faskes ?? '................') : '................' }}<br>
            <div style="margin-left: 20px;">
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

    <!-- SECTION KONDISI PASIEN PULANG -->
    <div style="font-weight: bold; font-size: 11px; margin-bottom: 3px;">KONDISI PASIEN PULANG</div>
    <div class="box-section">
        <div>
            <span class="checkbox-symbol">{!! $kondisiPulang == 'Perbaikan' ? '&#9745;' : '&#9744;' !!}</span> Perbaikan
        </div>
        <div style="margin-top: 3px;">
            <span class="checkbox-symbol">{!! $kondisiPulang == 'Menolak Rawat Inap' ? '&#9745;' : '&#9744;' !!}</span> Menolak Rawat Inap (Formulir Penolakan Rawat Inap)
        </div>
        <div style="margin-top: 3px;">
            <span class="checkbox-symbol">{!! $kondisiPulang == 'Meninggal Dunia' ? '&#9745;' : '&#9744;' !!}</span> Meninggal Dunia &nbsp;&nbsp;&nbsp;&nbsp;
            Hari : {{ ($kondisiPulang == 'Meninggal Dunia' && $rsia->tgl_meninggal) ? \Carbon\Carbon::parse($rsia->tgl_meninggal)->locale('id')->isoFormat('dddd') : '...........' }} &nbsp;&nbsp;&nbsp;&nbsp;
            Tanggal : {{ ($kondisiPulang == 'Meninggal Dunia' && $rsia->tgl_meninggal) ? date('d-m-Y', strtotime($rsia->tgl_meninggal)) : '...........' }} &nbsp;&nbsp;&nbsp;&nbsp;
            Jam : {{ ($kondisiPulang == 'Meninggal Dunia' && $rsia->jam_meninggal) ? date('H:i', strtotime($rsia->jam_meninggal)) : '...........' }}
        </div>
    </div>

    <!-- SELESAI PELAYANAN & TANDA TANGAN -->
    <div style="text-align: right; font-size: 11px; margin-top: 8px; margin-bottom: 8px;">
        Selesai Pelayanan UGD : Tanggal {{ $rsia->selesai_layanan_tgl ? date('d-m-Y', strtotime($rsia->selesai_layanan_tgl)) : '...................' }} &nbsp;&nbsp;
        Jam {{ $rsia->selesai_layanan_jam ? date('H:i', strtotime($rsia->selesai_layanan_jam)) : '...................' }}
    </div>

    <table width="100%" class="table-borderless" style="text-align: center; font-size: 11px; margin-top: 5px;">
        <tr>
            <td width="50%">
                Pasien / Keluarga<br>
                <div style="height: 65px; margin: 4px 0;">
                    @if (!empty($rsia->ttd_pasien))
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
                        <img src="{{ $ttdSrc }}" height="60" />
                    @else
                        <br><br>
                    @endif
                </div>
                ( <strong>{{ $rsia->nama_keluarga_ttd ?? $pasien->nm_pasien ?? '............................................' }}</strong> )<br>
                <span style="font-size: 10px; color: #555;">Tanda tangan dan nama terang</span>
            </td>
            <td width="50%">
                Dokter Jaga UGD<br>
                <div style="height: 65px; margin: 4px 0; text-align: center;">
                    @if (!empty($data->kd_dokter))
                        @php
                            $qrText = 'Diverifikasi secara elektronik oleh: ' . ($data->dokter->nm_dokter ?? '-') . ' pada ' . date('d-m-Y H:i', strtotime($data->tanggal));
                        @endphp
                        <img src="data:image/png;base64,{!! DNS2D::getBarcodePNG($qrText, 'QRCODE', 2.5, 2.5) !!}" height="55" />
                    @else
                        <br><br>
                    @endif
                </div>
                ( <strong>{{ $data->dokter->nm_dokter ?? '............................................' }}</strong> )<br>
                <span style="font-size: 10px; color: #555;">Tanda tangan dan nama terang</span>
            </td>
        </tr>
    </table>
@endsection