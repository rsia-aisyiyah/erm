@extends('content.print.main')
@section('content')
    <style>
        .box-title {
            border: 1.5px solid #000;
            text-align: center;
            font-weight: bold;
            font-size: 10.5px;
            padding: 3px;
            margin-top: 3px;
            margin-bottom: 4px;
            background-color: #f2f2f2;
            letter-spacing: 0.3px;
        }
        .table-borderless td, .table-borderless th {
            border: none;
            padding: 1.5px 3px;
            font-size: 9px;
            vertical-align: top;
        }
        .table-rm20, .table-rm23, .table-rm24 {
            width: 100%;
            border-collapse: collapse;
            font-size: 8px;
        }
        .table-rm20 th, .table-rm23 th, .table-rm24 th {
            border: 1px solid #000;
            padding: 2.5px 2px;
            text-align: center;
            background-color: #eee;
            font-size: 8px;
        }
        .table-rm20 td, .table-rm23 td, .table-rm24 td {
            border: 1px solid #000;
            padding: 2px 3px;
            vertical-align: middle;
        }
        .checkbox-symbol {
            font-family: DejaVu Sans, sans-serif;
            font-size: 9.5px;
            font-weight: bold;
        }
        .section-header {
            font-weight: bold;
            font-size: 9.5px;
            margin-top: 4px;
            margin-bottom: 2px;
            border-bottom: 1px solid #000;
            padding-bottom: 1px;
        }
        .legend-box {
            border: 1px solid #000;
            padding: 3px 5px;
            font-size: 7.5px;
            margin-top: 3px;
            line-height: 1.15;
        }
        .page-break {
            page-break-after: always !important;
        }
    </style>

    @php
        $pasien = $regPeriksa->pasien ?? null;
        $kamar = $regPeriksa->kamarInap ? $regPeriksa->kamarInap->filter(fn($k) => $k->stts_pulang != 'Pindah Kamar')->first() : null;
        $nmBangsal = $kamar && $kamar->kamar && $kamar->kamar->bangsal ? $kamar->kamar->bangsal->nm_bangsal : ($regPeriksa->poliklinik->nm_poli ?? '-');
    @endphp

    {{-- ========================================================================= --}}
    {{-- 1. HALAMAN FORM RM 20 (JIKA ADA DATA)                                      --}}
    {{-- ========================================================================= --}}
    @if ($hasRm20 && $asesmen)
        @php
            $as = $asesmen;
            $caraBelajar = $as ? ($as->cara_belajar ?? '') : '';
            $kebutuhanEdukasi = $as ? ($as->kebutuhan_edukasi ?? '') : '';
            $tabelRencana = ($as && is_array($as->tabel_rencana)) ? $as->tabel_rencana : (($as && is_string($as->tabel_rencana)) ? json_decode($as->tabel_rencana, true) : []);

            $masterRencana = [
                'hak_kewajiban' => ['label' => 'Hak dan kewajiban pasien', 'default_ppa' => 'Perawat / Bidan', 'default_cara' => 'Diskusi (D)', 'default_sasaran' => 'Keluarga (K)', 'default_evaluasi' => 'Mampu menjelaskan'],
                'orientasi' => ['label' => 'Orientasi ruangan', 'default_ppa' => 'Perawat / Bidan', 'default_cara' => 'Demonstrasi (Demo)', 'default_sasaran' => 'Keluarga (K)', 'default_evaluasi' => 'Mampu mendemonstrasikan'],
                'kondisi_medis' => ['label' => 'Kondisi medis, diagnosis pasti, asuhan & pengobatan', 'default_ppa' => 'Dokter (DPJP)', 'default_cara' => 'Diskusi (D)', 'default_sasaran' => 'Pasien & Keluarga (P&K)', 'default_evaluasi' => 'Mampu menjelaskan'],
                'penggunaan_obat' => ['label' => 'Penggunaan obat yang efektif dan aman', 'default_ppa' => 'Farmasi / Apoteker', 'default_cara' => 'Diskusi (D)', 'default_sasaran' => 'Pasien & Keluarga (P&K)', 'default_evaluasi' => 'Mampu menjelaskan'],
                'peralatan_medis' => ['label' => 'Penggunaan peralatan medis yang efektif dan aman', 'default_ppa' => 'Perawat / Bidan', 'default_cara' => 'Demonstrasi (Demo)', 'default_sasaran' => 'Keluarga (K)', 'default_evaluasi' => 'Mampu mendemonstrasikan'],
                'diet_nutrisi' => ['label' => 'Diet dan nutrisi', 'default_ppa' => 'Nutrisionis / Gizi', 'default_cara' => 'Diskusi (D)', 'default_sasaran' => 'Keluarga (K)', 'default_evaluasi' => 'Mampu menjelaskan'],
                'manajemen_nyeri' => ['label' => 'Manajemen nyeri', 'default_ppa' => 'Perawat / Tim Nyeri', 'default_cara' => 'Demonstrasi (Demo)', 'default_sasaran' => 'Pasien & Keluarga (P&K)', 'default_evaluasi' => 'Mampu mendemonstrasikan'],
                'pencegahan_infeksi' => ['label' => 'Pencegahan dan pengendalian infeksi', 'default_ppa' => 'Perawat / Bidan', 'default_cara' => 'Demonstrasi (Demo)', 'default_sasaran' => 'Keluarga (K)', 'default_evaluasi' => 'Mampu mendemonstrasikan'],
                'kebutuhan_berkelanjutan' => ['label' => 'Pemenuhan kebutuhan kesehatan berkelanjutan', 'default_ppa' => 'Perawat / Bidan', 'default_cara' => 'Diskusi (D)', 'default_sasaran' => 'Keluarga (K)', 'default_evaluasi' => 'Mampu menjelaskan'],
                'lain_lain' => ['label' => 'Lain-lain : ' . ($as->kebutuhan_edukasi_lain ?? ''), 'default_ppa' => 'Perawat / Bidan', 'default_cara' => 'Diskusi (D)', 'default_sasaran' => 'Keluarga (K)', 'default_evaluasi' => 'Mampu menjelaskan'],
            ];
        @endphp

        <!-- HEADER KOP & IDENTITAS PASIEN -->
        <table width="100%" class="table-borderless" style="border-bottom: 2px solid #000; padding-bottom: 2px;">
            <tr>
                <td width="10%" style="vertical-align: middle; text-align: center;">
                    <img src="{{ public_path('img/logo.png') }}" width="50" />
                </td>
                <td width="55%" style="vertical-align: middle;">
                    <strong style="font-size: 11px; display: block;">RUMAH SAKIT IBU DAN ANAK AISYIYAH</strong>
                    <strong style="font-size: 11px; display: block;">PEKAJANGAN &ndash; PEKALONGAN</strong>
                    <span style="font-size: 8px; display: block;">Jl. Raya Pekajangan No. 610 Pekajangan, Pekalongan, 51172</span>
                    <span style="font-size: 8px; display: block;">Telp. (0285) 785909 Email: rsiaaisyiyah@gmail.com Website: www.rsiaaisyiyah.com</span>
                </td>
                <td width="35%" style="vertical-align: top;">
                    <table width="100%" class="border" style="font-size: 8.5px; border-collapse: collapse;">
                        <tr>
                            <td width="35%" style="padding: 1px 3px; border: 1px solid #000;"><strong>Nama</strong></td>
                            <td width="65%" style="padding: 1px 3px; border: 1px solid #000;">: {{ $pasien->nm_pasien ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td style="padding: 1px 3px; border: 1px solid #000;"><strong>Tgl. Lahir</strong></td>
                            <td style="padding: 1px 3px; border: 1px solid #000;">: {{ $pasien->tgl_lahir ? date('d-m-Y', strtotime($pasien->tgl_lahir)) : '-' }} ({{ $pasien->jk ?? '-' }})</td>
                        </tr>
                        <tr>
                            <td style="padding: 1px 3px; border: 1px solid #000;"><strong>No. RM</strong></td>
                            <td style="padding: 1px 3px; border: 1px solid #000;">: {{ $pasien->no_rkm_medis ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td style="padding: 1px 3px; border: 1px solid #000;"><strong>Ruang/Kelas</strong></td>
                            <td style="padding: 1px 3px; border: 1px solid #000;">: {{ $as->ruang ?? $nmBangsal }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <div class="box-title">
            ASSESMEN KEBUTUHAN DAN PERENCANAAN PENDIDIKAN PASIEN DAN KELUARGA RAWAT INAP
        </div>

        <!-- RUANG, TANGGAL & JAM -->
        <table width="100%" style="font-size: 8.5px; margin-bottom: 3px;">
            <tr>
                <td width="35%"><strong>Ruang :</strong> {{ $as->ruang ?? $nmBangsal }}</td>
                <td width="35%"><strong>Tanggal :</strong> {{ $as ? date('d/m/Y', strtotime($as->tanggal)) : date('d/m/Y') }}</td>
                <td width="30%"><strong>Jam :</strong> {{ $as ? date('H:i', strtotime($as->tanggal)) : date('H:i') }} WIB</td>
            </tr>
        </table>

        <!-- BAGIAN A: PENGKAJIAN KEBUTUHAN PENDIDIKAN -->
        <div class="section-header">A. PENGKAJIAN KEBUTUHAN PENDIDIKAN</div>
        <table width="100%" style="font-size: 8px; line-height: 1.25; border-collapse: collapse;">
            <tr>
                <td width="3%" style="vertical-align: top;">1.</td>
                <td width="32%" style="vertical-align: top;">Agama, keyakinan dan nilai-nilai</td>
                <td width="65%" style="vertical-align: top;">: <strong>{{ $as->agama_keyakinan ?? ($pasien->agama ?? 'Islam') }}</strong></td>
            </tr>
            <tr>
                <td style="vertical-align: top;">2.</td>
                <td style="vertical-align: top;">Bahasa sehari-hari</td>
                <td style="vertical-align: top;">
                    : <span class="checkbox-symbol">{!! ($as && ($as->bahasa_indonesia ?? 'Aktif') != '-') ? '&#9745;' : '&#9744;' !!}</span> Indonesia, 
                      <span style="font-size: 7.5px;">({!! ($as && $as->bahasa_indonesia == 'Aktif') ? '<strong><u>aktif</u></strong>/pasif' : (($as && $as->bahasa_indonesia == 'Pasif') ? 'aktif/<strong><u>pasif</u></strong>' : 'aktif/pasif') !!})</span> &nbsp;&nbsp;
                      <span class="checkbox-symbol">{!! ($as && !empty($as->bahasa_daerah) && $as->bahasa_daerah_status != '-') ? '&#9745;' : '&#9744;' !!}</span> Daerah: {{ $as->bahasa_daerah ?? 'Jawa' }} 
                      <span style="font-size: 7.5px;">({!! ($as && $as->bahasa_daerah_status == 'Aktif') ? '<strong><u>aktif</u></strong>/pasif' : (($as && $as->bahasa_daerah_status == 'Pasif') ? 'aktif/<strong><u>pasif</u></strong>' : 'aktif/pasif') !!})</span><br>
                      &nbsp; <span class="checkbox-symbol">{!! ($as && ($as->bahasa_inggris ?? '-') != '-') ? '&#9745;' : '&#9744;' !!}</span> Inggris 
                      <span style="font-size: 7.5px;">({!! ($as && $as->bahasa_inggris == 'Aktif') ? '<strong><u>aktif</u></strong>/pasif' : (($as && $as->bahasa_inggris == 'Pasif') ? 'aktif/<strong><u>pasif</u></strong>' : 'aktif/pasif') !!})</span> &nbsp;&nbsp;
                      <span class="checkbox-symbol">{!! ($as && !empty($as->bahasa_lain) && $as->bahasa_lain_status != '-') ? '&#9745;' : '&#9744;' !!}</span> Lain-lain: {{ $as->bahasa_lain ?? '-' }} 
                      <span style="font-size: 7.5px;">({!! ($as && $as->bahasa_lain_status == 'Aktif') ? '<strong><u>aktif</u></strong>/pasif' : (($as && $as->bahasa_lain_status == 'Pasif') ? 'aktif/<strong><u>pasif</u></strong>' : 'aktif/pasif') !!})</span>
                </td>
            </tr>
            <tr>
                <td style="vertical-align: top;">3.</td>
                <td style="vertical-align: top;">Perlu penerjemah</td>
                <td style="vertical-align: top;">
                    : <span class="checkbox-symbol">{!! ($as && $as->perlu_penerjemah == 'Tidak') ? '&#9745;' : '&#9744;' !!}</span> Tidak &nbsp;&nbsp;&nbsp;&nbsp;
                      <span class="checkbox-symbol">{!! ($as && $as->perlu_penerjemah == 'Ya') ? '&#9745;' : '&#9744;' !!}</span> Ya, bahasa: {{ ($as && $as->perlu_penerjemah == 'Ya') ? ($as->penerjemah_bahasa ?? '..........') : '..........' }}
                </td>
            </tr>
            <tr>
                <td style="vertical-align: top;">4.</td>
                <td style="vertical-align: top;">Bahasa isyarat</td>
                <td style="vertical-align: top;">
                    : <span class="checkbox-symbol">{!! ($as && $as->bahasa_isyarat == 'Tidak') ? '&#9745;' : '&#9744;' !!}</span> Tidak &nbsp;&nbsp;&nbsp;&nbsp;
                      <span class="checkbox-symbol">{!! ($as && $as->bahasa_isyarat == 'Ya') ? '&#9745;' : '&#9744;' !!}</span> Ya, {{ ($as && $as->bahasa_isyarat == 'Ya') ? ($as->bahasa_isyarat_ket ?? '..........') : '..........' }}
                </td>
            </tr>
            <tr>
                <td style="vertical-align: top;">5.</td>
                <td style="vertical-align: top;">Cara belajar yang disukai</td>
                <td style="vertical-align: top;">
                    : <span class="checkbox-symbol">{!! str_contains($caraBelajar, 'Membaca') ? '&#9745;' : '&#9744;' !!}</span> Membaca &nbsp;&nbsp;
                      <span class="checkbox-symbol">{!! str_contains($caraBelajar, 'Diskusi') ? '&#9745;' : '&#9744;' !!}</span> Diskusi &nbsp;&nbsp;
                      <span class="checkbox-symbol">{!! str_contains($caraBelajar, 'Audio visual') ? '&#9745;' : '&#9744;' !!}</span> Audio visual / gambar &nbsp;&nbsp;
                      <span class="checkbox-symbol">{!! str_contains($caraBelajar, 'Menulis') ? '&#9745;' : '&#9744;' !!}</span> Menulis &nbsp;&nbsp;
                      <span class="checkbox-symbol">{!! str_contains($caraBelajar, 'Demonstrasi') ? '&#9745;' : '&#9744;' !!}</span> Demonstrasi
                </td>
            </tr>
            <tr>
                <td style="vertical-align: top;">6.</td>
                <td style="vertical-align: top;">Tingkat pendidikan</td>
                <td style="vertical-align: top;">
                    @php $pddk = $as->tingkat_pendidikan ?? ($pasien->pnd ?? ''); @endphp
                    : <span class="checkbox-symbol">{!! ($pddk == 'TK') ? '&#9745;' : '&#9744;' !!}</span> TK &nbsp;&nbsp;
                      <span class="checkbox-symbol">{!! ($pddk == 'SD') ? '&#9745;' : '&#9744;' !!}</span> SD &nbsp;&nbsp;
                      <span class="checkbox-symbol">{!! ($pddk == 'SMP') ? '&#9745;' : '&#9744;' !!}</span> SMP &nbsp;&nbsp;
                      <span class="checkbox-symbol">{!! (in_array($pddk, ['SMA', 'SMK', 'SLTA'])) ? '&#9745;' : '&#9744;' !!}</span> SMA &nbsp;&nbsp;
                      <span class="checkbox-symbol">{!! (in_array($pddk, ['Akademi', 'D3', 'Diploma'])) ? '&#9745;' : '&#9744;' !!}</span> Akademi &nbsp;&nbsp;
                      <span class="checkbox-symbol">{!! (in_array($pddk, ['Sarjana', 'S1', 'S2', 'S3'])) ? '&#9745;' : '&#9744;' !!}</span> Sarjana &nbsp;&nbsp;
                      <span class="checkbox-symbol">{!! (!in_array($pddk, ['TK','SD','SMP','SMA','SMK','SLTA','Akademi','D3','Diploma','Sarjana','S1','S2','S3',''])) ? '&#9745;' : '&#9744;' !!}</span> Lainnya: {{ (!in_array($pddk, ['TK','SD','SMP','SMA','SMK','SLTA','Akademi','D3','Diploma','Sarjana','S1','S2','S3',''])) ? $pddk : '...' }}
                </td>
            </tr>
            <tr>
                <td style="vertical-align: top;">7.</td>
                <td style="vertical-align: top;">Mampu membaca</td>
                <td style="vertical-align: top;">
                    : <span class="checkbox-symbol">{!! ($as && $as->mampu_membaca == 'Tidak') ? '&#9745;' : '&#9744;' !!}</span> Tidak &nbsp;&nbsp;&nbsp;&nbsp;
                      <span class="checkbox-symbol">{!! (!$as || $as->mampu_membaca == 'Ya') ? '&#9745;' : '&#9744;' !!}</span> Ya
                </td>
            </tr>
            <tr>
                <td style="vertical-align: top;">8.</td>
                <td style="vertical-align: top;">Hambatan emosi dan motivasi</td>
                <td style="vertical-align: top;">
                    : <span class="checkbox-symbol">{!! (!$as || $as->hambatan_emosi == 'Tidak') ? '&#9745;' : '&#9744;' !!}</span> Tidak &nbsp;&nbsp;&nbsp;&nbsp;
                      <span class="checkbox-symbol">{!! ($as && $as->hambatan_emosi == 'Ya') ? '&#9745;' : '&#9744;' !!}</span> Ya
                </td>
            </tr>
            <tr>
                <td style="vertical-align: top;">9.</td>
                <td style="vertical-align: top;">Kesediaan menerima informasi</td>
                <td style="vertical-align: top;">
                    : <span class="checkbox-symbol">{!! ($as && $as->kesediaan_menerima == 'Tidak') ? '&#9745;' : '&#9744;' !!}</span> Tidak &nbsp;&nbsp;&nbsp;&nbsp;
                      <span class="checkbox-symbol">{!! (!$as || $as->kesediaan_menerima == 'Ya') ? '&#9745;' : '&#9744;' !!}</span> Ya
                </td>
            </tr>
            <tr>
                <td style="vertical-align: top;">10.</td>
                <td style="vertical-align: top;">Keterbatasan fisik dan kognitif</td>
                <td style="vertical-align: top;">
                    : <span class="checkbox-symbol">{!! (!$as || $as->keterbatasan_fisik == 'Tidak') ? '&#9745;' : '&#9744;' !!}</span> Tidak &nbsp;&nbsp;&nbsp;&nbsp;
                      <span class="checkbox-symbol">{!! ($as && $as->keterbatasan_fisik == 'Ya') ? '&#9745;' : '&#9744;' !!}</span> Ya
                </td>
            </tr>
            <tr>
                <td style="vertical-align: top;">11.</td>
                <td style="vertical-align: top;">Kebutuhan pendidikan</td>
                <td style="vertical-align: top;">
                    <table width="100%" class="table-borderless" style="font-size: 8px; line-height: 1.15; margin: 0; padding: 0;">
                        <tr>
                            <td width="52%" style="padding: 0;">
                                <span class="checkbox-symbol">{!! (!$as || str_contains($kebutuhanEdukasi, 'Hak dan kewajiban')) ? '&#9745;' : '&#9744;' !!}</span> Hak dan kewajiban pasien<br>
                                <span class="checkbox-symbol">{!! (!$as || str_contains($kebutuhanEdukasi, 'Orientasi ruangan')) ? '&#9745;' : '&#9744;' !!}</span> Orientasi ruangan<br>
                                <span class="checkbox-symbol">{!! (!$as || str_contains($kebutuhanEdukasi, 'Kondisi medis')) ? '&#9745;' : '&#9744;' !!}</span> Kondisi medis, diagnosis pasti, asuhan &amp; pengobatan<br>
                                <span class="checkbox-symbol">{!! (!$as || str_contains($kebutuhanEdukasi, 'Penggunaan obat')) ? '&#9745;' : '&#9744;' !!}</span> Penggunaan obat yg efektif &amp; aman (efek samping &amp; interaksi)<br>
                                <span class="checkbox-symbol">{!! (!$as || str_contains($kebutuhanEdukasi, 'peralatan medis')) ? '&#9745;' : '&#9744;' !!}</span> Penggunaan peralatan medis yang efektif dan aman
                            </td>
                            <td width="48%" style="padding: 0;">
                                <span class="checkbox-symbol">{!! (!$as || str_contains($kebutuhanEdukasi, 'Diet')) ? '&#9745;' : '&#9744;' !!}</span> Diet dan nutrisi<br>
                                <span class="checkbox-symbol">{!! (!$as || str_contains($kebutuhanEdukasi, 'Rehabilitasi')) ? '&#9745;' : '&#9744;' !!}</span> Rehabilitasi medik<br>
                                <span class="checkbox-symbol">{!! (!$as || str_contains($kebutuhanEdukasi, 'Manajemen nyeri')) ? '&#9745;' : '&#9744;' !!}</span> Manajemen nyeri<br>
                                <span class="checkbox-symbol">{!! (!$as || str_contains($kebutuhanEdukasi, 'Pencegahan dan pengendalian')) ? '&#9745;' : '&#9744;' !!}</span> Pencegahan dan pengendalian infeksi<br>
                                <span class="checkbox-symbol">{!! (!$as || str_contains($kebutuhanEdukasi, 'kesehatan berkelanjutan')) ? '&#9745;' : '&#9744;' !!}</span> Pemenuhan kebutuhan kesehatan berkelanjutan<br>
                                <span class="checkbox-symbol">{!! ($as && str_contains($kebutuhanEdukasi, 'Lain-lain')) ? '&#9745;' : '&#9744;' !!}</span> Lain-lain : {{ ($as && $as->kebutuhan_edukasi_lain) ? $as->kebutuhan_edukasi_lain : '................................' }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <!-- BAGIAN B: PERENCANAAN PEMBERIAN EDUKASI -->
        <div class="section-header" style="margin-top: 5px;">B. PERENCANAAN PEMBERIAN EDUKASI</div>
        <div style="font-size: 8.5px; margin-bottom: 3px;">
            <strong>Rencana pelaksanaan edukasi :</strong> &nbsp;&nbsp;
            <span class="checkbox-symbol">{!! (!$as || ($as->rencana_pelaksanaan ?? 'Individu') == 'Individu') ? '&#9745;' : '&#9744;' !!}</span> Individu &nbsp;&nbsp;&nbsp;&nbsp;
            <span class="checkbox-symbol">{!! ($as && ($as->rencana_pelaksanaan ?? '') == 'Kolaboratif') ? '&#9745;' : '&#9744;' !!}</span> Kolaboratif
        </div>

        <!-- TABEL RENCANA EDUKASI -->
        <table class="table-rm20">
            <thead>
                <tr>
                    <th width="30%">Kebutuhan Edukasi</th>
                    <th width="18%">Pemberian Edukasi</th>
                    <th width="15%">Tanggal &amp; Waktu<br>Pembelajaran</th>
                    <th width="12%">Sasaran<br>(P/K/P&amp;K)*</th>
                    <th width="12%">Cara Edukasi<br>(D/C/Demo/S/O/PL)**</th>
                    <th width="13%">Metode<br>Evaluasi***</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($masterRencana as $key => $item)
                    @php
                        $rencanaRow = $tabelRencana[$key] ?? null;
                        $isCheckedTopic = !$as || str_contains($kebutuhanEdukasi, explode(' ', $item['label'])[0]) || ($key === 'lain_lain' && !empty($as->kebutuhan_edukasi_lain));
                        
                        $ppa = $rencanaRow['ppa'] ?? $item['default_ppa'];
                        $tglWaktu = !empty($rencanaRow['tgl_waktu']) ? date('d/m/y H:i', strtotime($rencanaRow['tgl_waktu'])) : ($as ? date('d/m/y H:i', strtotime($as->tanggal)) : date('d/m/y H:i'));
                        $sasaran = $rencanaRow['sasaran'] ?? $item['default_sasaran'];
                        $cara = $rencanaRow['cara'] ?? $item['default_cara'];
                        $evaluasi = $rencanaRow['evaluasi'] ?? $item['default_evaluasi'];
                    @endphp
                    <tr>
                        <td style="font-weight: 500;">
                            <span class="checkbox-symbol">{!! $isCheckedTopic ? '&#9745;' : '&#9744;' !!}</span> {{ $item['label'] }}
                        </td>
                        <td style="text-align: center;">{{ $isCheckedTopic ? $ppa : '-' }}</td>
                        <td style="text-align: center;">{{ $isCheckedTopic ? $tglWaktu : '-' }}</td>
                        <td style="text-align: center;">{{ $isCheckedTopic ? $sasaran : '-' }}</td>
                        <td style="text-align: center;">{{ $isCheckedTopic ? $cara : '-' }}</td>
                        <td style="text-align: center;">{{ $isCheckedTopic ? $evaluasi : '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- FOOTER & TTD PENGKAJI -->
        <table width="100%" class="table-borderless" style="margin-top: 4px; font-size: 8px;">
            <tr>
                <td width="65%" style="vertical-align: top;">
                    <div class="legend-box">
                        <strong>Keterangan:</strong> * coret yang tidak perlu<br>
                        <strong>Pemberian edukasi:</strong><br>
                        <strong>(*) P/K/P&amp;K</strong> : Pasien / Keluarga Pasien / Pasien &amp; Keluarga Pasien<br>
                        <strong>(**) D/C/Demo/S/O/PL</strong> : Diskusi / Ceramah / Demonstrasi / Simulasi / Observasi / Praktek Langsung<br>
                        <strong>(***) Evaluasi</strong> : Mampu menjelaskan atau mampu mendemonstrasikan
                    </div>
                </td>
                <td width="35%" style="vertical-align: top; text-align: center;">
                    <div style="font-size: 8.5px; font-weight: bold; margin-bottom: 2px;">Perawat / Bidan Pengkaji :</div>
                    @php
                        $nmPetugas = $as ? ($as->petugas->nama ?? ($as->pegawai->nama ?? ($as->nip ?? 'Perawat'))) : 'Perawat';
                        $nipPetugas = $as ? $as->nip : '';
                        $qrText = 'Pengkajian RM 20 oleh: ' . $nmPetugas . ' (NIP: ' . $nipPetugas . ') pada ' . ($as ? date('d-m-Y H:i', strtotime($as->tanggal)) : date('d-m-Y H:i'));
                    @endphp
                    @if ($as && $as->nip)
                        <img src="data:image/png;base64,{!! DNS2D::getBarcodePNG($qrText, 'QRCODE', 2, 2) !!}" height="35" style="display: block; margin: 0 auto;" />
                    @else
                        <div style="height: 35px;"></div>
                    @endif
                    <span style="font-size: 8.5px; font-weight: bold; text-decoration: underline;">( {{ $nmPetugas }} )</span>
                </td>
            </tr>
        </table>

        <div style="display: flex; justify-content: space-between; font-size: 8px; margin-top: 2px; color: #555;">
            <em>*Isi dengan lengkap, jelas dan terbaca</em>
            <strong style="color: #000; font-size: 9px;">RM 20</strong>
        </div>
    @endif

    {{-- PAGE BREAK ANTARA RM 20 DAN RM 23/RM 24 --}}
    @if ($hasRm20 && ($hasRm23 || $hasRm24))
        <div class="page-break"></div>
    @endif

    {{-- ========================================================================= --}}
    {{-- 2. HALAMAN FORM RM 23 (JIKA ADA DATA)                                      --}}
    {{-- ========================================================================= --}}
    @if ($hasRm23 && count($edukasiRm23) > 0)
        @php
            $dataByDisiplin = [];
            foreach ($edukasiRm23 as $edu) {
                $dataByDisiplin[$edu->disiplin] = $edu;
            }

            $masterDisiplin = [
                'DPJP' => [
                    'title' => 'DPJP (Dokter Spesialis)',
                    'desc' => '1. Kondisi Pasien<br>2. Usulan Pengobatan<br>3. Nama individu yang memberikan pengobatan<br>4. Potensi manfaat dan kekurangannya<br>5. Kemungkinan alternatif<br>6. Kemungkinan keberhasilan<br>7. Kemungkinan timbulnya masalah selama masa pemulihan<br>8. Kemungkinan yang terjadi apabila tidak diobati'
                ],
                'Farmasi' => [
                    'title' => 'Farmasi',
                    'desc' => '1. Obat-obatan yang di dapat pasien<br>2. Aturan pemakaian dan dosis obat<br>3. Efek samping obat<br>4. Kontra Indikasi obat<br>5. Interaksi obat'
                ],
                'Perawat/Bidan' => [
                    'title' => 'Perawat / Bidan',
                    'desc' => '1. Penggunaan peralatan medis yg aman<br>2. Pencegahan & pengendalian infeksi (Cuci tangan / Lainnya)<br>3. Pendidikan kesehatan berkelanjutan<br>4. Orientasi Ruangan<br>5. Hak dan Kewajiban pasien'
                ],
                'Nutrisionis' => [
                    'title' => 'Nutrisionis',
                    'desc' => '1. Status gizi & pelayanan makanan RS<br>2. Diet selama perawatan<br>3. Diet untuk di rumah<br>4. Penyimpanan makanan / cegah kontaminasi'
                ],
                'Manajemen Nyeri' => [
                    'title' => 'Manajemen Nyeri',
                    'desc' => 'a. Farmakologi<br>b. Non farmakologi (Relaksasi / Distraksi / Massage / Kompres)'
                ]
            ];
        @endphp

        <!-- HEADER KOP & IDENTITAS PASIEN -->
        <table width="100%" class="table-borderless" style="border-bottom: 2px solid #000; padding-bottom: 2px;">
            <tr>
                <td width="10%" style="vertical-align: middle; text-align: center;">
                    <img src="{{ public_path('img/logo.png') }}" width="55" />
                </td>
                <td width="55%" style="vertical-align: middle;">
                    <strong style="font-size: 12px; display: block;">RUMAH SAKIT IBU DAN ANAK AISYIYAH</strong>
                    <strong style="font-size: 12px; display: block;">PEKAJANGAN &ndash; PEKALONGAN</strong>
                    <span style="font-size: 8.5px; display: block;">Jl. Raya Pekajangan No. 610 Pekajangan, Pekalongan, 51172</span>
                    <span style="font-size: 8.5px; display: block;">Telp. (0285) 785909 Email: rsiaaisyiyah@gmail.com</span>
                    <span style="font-size: 8.5px; display: block;">Website: www.rsiaaisyiyah.com</span>
                </td>
                <td width="35%" style="vertical-align: top;">
                    <table width="100%" class="border" style="font-size: 9px; border-collapse: collapse;">
                        <tr>
                            <td width="35%" style="padding: 1.5px 3px; border: 1px solid #000;"><strong>Nama</strong></td>
                            <td width="65%" style="padding: 1.5px 3px; border: 1px solid #000;">: {{ $pasien->nm_pasien ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td style="padding: 1.5px 3px; border: 1px solid #000;"><strong>Tgl. Lahir</strong></td>
                            <td style="padding: 1.5px 3px; border: 1px solid #000;">: {{ $pasien->tgl_lahir ? date('d-m-Y', strtotime($pasien->tgl_lahir)) : '-' }} ({{ $pasien->jk ?? '-' }})</td>
                        </tr>
                        <tr>
                            <td style="padding: 1.5px 3px; border: 1px solid #000;"><strong>No. RM</strong></td>
                            <td style="padding: 1.5px 3px; border: 1px solid #000;">: {{ $pasien->no_rkm_medis ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td style="padding: 1.5px 3px; border: 1px solid #000;"><strong>Ruang/Kelas</strong></td>
                            <td style="padding: 1.5px 3px; border: 1px solid #000;">: {{ $nmBangsal }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <div class="box-title">
            CATATAN PELAKSANAAN PENDIDIKAN PASIEN DAN KELUARGA DARI MULTI DISIPLIN
        </div>

        <!-- TABEL UTAMA RM 23 -->
        <table class="table-rm23">
            <thead>
                <tr>
                    <th width="18%">PEMBERIAN EDUKASI / PENDIDIKAN</th>
                    <th width="28%">PENJELASAN MATERI EDUKASI</th>
                    <th width="12%">TGL &amp; WAKTU<br>/ DURASI</th>
                    <th width="10%">METODE</th>
                    <th width="11%">HAMBATAN &amp; INTERVENSI</th>
                    <th width="11%">EVALUASI</th>
                    <th width="10%">PARAF PASIEN / KELUARGA</th>
                    <th width="10%">PARAF EDUKATOR</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($masterDisiplin as $keyDisiplin => $info)
                    @php
                        $edu = $dataByDisiplin[$keyDisiplin] ?? null;
                    @endphp
                    <tr>
                        <td style="font-weight: bold; text-align: center; vertical-align: middle;">
                            {{ $info['title'] }}
                        </td>
                        <td>
                            @if ($edu && $edu->materi)
                                @php
                                    $lines = explode("\n", $edu->materi);
                                    $hasCustomNotes = false;
                                    $customNotesText = '';
                                @endphp
                                <div style="line-height: 1.25;">
                                    @foreach ($lines as $line)
                                        @php $trimmed = trim($line); @endphp
                                        @if (!empty($trimmed))
                                            @if (str_starts_with($trimmed, '1.') || str_starts_with($trimmed, '2.') || str_starts_with($trimmed, '3.') || str_starts_with($trimmed, '4.') || str_starts_with($trimmed, '5.') || str_starts_with($trimmed, '6.') || str_starts_with($trimmed, '7.') || str_starts_with($trimmed, '8.') || str_starts_with($trimmed, 'a.') || str_starts_with($trimmed, 'b.'))
                                                <span class="checkbox-symbol">&#9745;</span> {{ $trimmed }}<br>
                                            @elseif (in_array($trimmed, ['Kondisi Pasien', 'Usulan Pengobatan', 'Nama individu yang memberikan pengobatan', 'Potensi manfaat dan kekurangannya', 'Kemungkinan alternatif', 'Kemungkinan keberhasilan', 'Kemungkinan timbulnya masalah selama masa pemulihan', 'Kemungkinan yang terjadi apabila tidak diobati', 'Obat-obatan yang di dapat pasien', 'Aturan pemakaian dan dosis obat', 'Efek samping obat', 'Kontra Indikasi obat', 'Interaksi obat', 'Penggunaan peralatan medis yg aman', 'Pencegahan & pengendalian infeksi (Cuci tangan / Lainnya)', 'Pendidikan kesehatan berkelanjutan', 'Orientasi Ruangan', 'Hak dan Kewajiban pasien', 'Status gizi & pelayanan makanan RS', 'Diet selama perawatan', 'Diet untuk di rumah', 'Penyimpanan makanan / cegah kontaminasi']))
                                                <span class="checkbox-symbol">&#9745;</span> {{ $trimmed }}<br>
                                            @else
                                                @php
                                                    $hasCustomNotes = true;
                                                    $customNotesText .= ($customNotesText ? '<br>' : '') . $trimmed;
                                                @endphp
                                            @endif
                                        @endif
                                    @endforeach
                                    @if ($hasCustomNotes)
                                        <div style="margin-top: 3px; padding-top: 2px; border-top: 1px dashed #999; font-style: italic; color: #111;">
                                            <strong>Catatan:</strong> {!! $customNotesText !!}
                                        </div>
                                    @endif
                                </div>
                            @else
                                <div style="color: #666; line-height: 1.2;">
                                    {!! $info['desc'] !!}
                                </div>
                            @endif
                        </td>
                        <td style="text-align: center; vertical-align: middle;">
                            @if ($edu)
                                <strong>{{ date('d-m-Y', strtotime($edu->tanggal)) }}</strong><br>
                                {{ date('H:i', strtotime($edu->tanggal)) }} WIB<br>
                                <span style="font-size: 8px; color: #333;">({{ $edu->durasi ?? '10 Menit' }})</span>
                            @else
                                <br><br>
                            @endif
                        </td>
                        <td style="text-align: center; vertical-align: middle;">
                            @if ($edu && $edu->metode)
                                {{ $edu->metode }}
                            @else
                                -
                            @endif
                        </td>
                        <td style="vertical-align: middle;">
                            @if ($edu)
                                <div style="font-size: 8px; line-height: 1.2;">
                                    <strong>Hambatan:</strong><br>
                                    {{ $edu->hambatan_lain ? $edu->hambatan_lain : ($edu->hambatan ?? 'Tidak Ada') }}<br>
                                    <strong>Intervensi:</strong><br>
                                    {{ $edu->intervensi_lain ? $edu->intervensi_lain : ($edu->intervensi ?? 'Tidak Ada') }}
                                </div>
                            @else
                                -
                            @endif
                        </td>
                        <td style="vertical-align: middle; text-align: center;">
                            @if ($edu && $edu->evaluasi)
                                <span style="font-size: 8px;">{{ $edu->evaluasi }}</span>
                            @else
                                -
                            @endif
                        </td>
                        <td style="text-align: center; vertical-align: middle;">
                            @if ($edu && $edu->ttd_pasien)
                                @php
                                    $ttdSrc = $edu->ttd_pasien;
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
                                <img src="{{ $ttdSrc }}" height="32" style="max-width: 50px;" /><br>
                                <span style="font-size: 7.5px;">{{ $edu->nama_penerima ?? 'Keluarga' }}</span>
                            @else
                                <br><br>
                            @endif
                        </td>
                        <td style="text-align: center; vertical-align: middle;">
                            @if ($edu && $edu->nip)
                                @php
                                    $nmPetugas = $edu->petugas->nama ?? ($edu->dokter->nm_dokter ?? '-');
                                    $qrText = 'Diedukasi oleh: ' . $nmPetugas . ' (NIP: ' . $edu->nip . ') pada ' . date('d-m-Y H:i', strtotime($edu->tanggal));
                                @endphp
                                <img src="data:image/png;base64,{!! DNS2D::getBarcodePNG($qrText, 'QRCODE', 2, 2) !!}" height="32" /><br>
                                <span style="font-size: 7.5px;">{{ $nmPetugas }}</span>
                            @else
                                <br><br>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- PERNYATAAN & TTD PASIEN -->
        @php
            $lastEduWithTtd = $edukasiRm23->filter(fn($e) => !empty($e->ttd_pasien))->last() ?? $edukasiRm23->last();
            $namaPenerimaFinal = $lastEduWithTtd->nama_penerima ?? ($regPeriksa->p_jawab ?? ($pasien->nm_pasien ?? ''));
            $ttdPasienFinal = $lastEduWithTtd->ttd_pasien ?? null;
            $ttdSrcFinal = null;
            if (!empty($ttdPasienFinal)) {
                $ttdSrcFinal = $ttdPasienFinal;
                if (!str_starts_with($ttdSrcFinal, 'data:image')) {
                    $absStorage = storage_path('app/public/' . ltrim($ttdSrcFinal, '/'));
                    $absPublic = public_path('storage/' . ltrim($ttdSrcFinal, '/'));
                    if (file_exists($absStorage)) {
                        $ttdSrcFinal = $absStorage;
                    } elseif (file_exists($absPublic)) {
                        $ttdSrcFinal = $absPublic;
                    }
                }
            }
        @endphp
        <div style="border: 1px solid #000; border-top: none; padding: 4px 8px; font-size: 8.5px;">
            <table width="100%" class="table-borderless" style="font-size: 8.5px; line-height: 1.2;">
                <tr>
                    <td width="68%" style="vertical-align: middle;">
                        <em>"Dengan ini menyatakan bahwa saya telah diberikan informasi dan edukasi serta diberi kesempatan untuk bertanya dan berdiskusi."</em>
                    </td>
                    <td width="32%" style="vertical-align: middle; text-align: center;">
                        <div style="font-size: 8px; font-weight: bold; margin-bottom: 2px;">Paraf Pasien / Keluarga :</div>
                        @if ($ttdSrcFinal)
                            <img src="{{ $ttdSrcFinal }}" height="32" style="max-width: 60px; display: block; margin: 0 auto;" />
                            <span style="font-size: 8px; font-weight: bold; text-decoration: underline;">( {{ $namaPenerimaFinal }} )</span>
                        @else
                            <div style="height: 25px;"></div>
                            <span style="font-size: 8px;">( {{ $namaPenerimaFinal ? $namaPenerimaFinal : '...................................................' }} )</span>
                        @endif
                    </td>
                </tr>
            </table>
        </div>

        <!-- KETERANGAN KODE KELENGKAPAN -->
        <div class="legend-box">
            <table width="100%" class="table-borderless" style="font-size: 7.5px; line-height: 1.1;">
                <tr>
                    <td width="12%"><strong>Metode</strong></td>
                    <td width="88%">: a. Diskusi / Wawancara &nbsp;&nbsp; b. Simulasi (S) &nbsp;&nbsp; c. Demonstrasi (Demo) &nbsp;&nbsp; d. Ceramah &nbsp;&nbsp; e. Observasi (O) &nbsp;&nbsp; f. Praktek Langsung (PL)</td>
                </tr>
                <tr>
                    <td><strong>Hambatan</strong></td>
                    <td>: a. Tidak Ada &nbsp; b. Bahasa &nbsp; c. Kehilangan Harapan &nbsp; d. Masalah Keuangan &nbsp; e. Kesalahan &nbsp; f. Faktor Budaya &nbsp; g. Kelemahan Sensori &nbsp; h. Tidak Percaya Diri &nbsp; i. Menyangkal &nbsp; j. Kecemasan/ketakutan &nbsp; k. Kelemahan Kognitif &nbsp; l. Tidak tertarik</td>
                </tr>
                <tr>
                    <td><strong>Intervensi</strong></td>
                    <td>: a. Tidak Ada &nbsp; b. Menyediakan Penerjemah &nbsp; c. Melakukan Pendekatan secara budaya/agama &nbsp; d. Mengulangi materi &nbsp; e. Melibatkan Keluarga Terdekat &nbsp; f. Memakai role model perilaku</td>
                </tr>
            </table>
        </div>

        <div style="text-align: right; font-size: 9px; font-weight: bold; margin-top: 2px;">
            RM 23
        </div>
    @endif

    {{-- PAGE BREAK ANTARA RM 23 DAN RM 24 --}}
    @if ($hasRm23 && $hasRm24)
        <div class="page-break"></div>
    @endif

    {{-- ========================================================================= --}}
    {{-- 3. HALAMAN FORM RM 24 (JIKA ADA DATA)                                      --}}
    {{-- ========================================================================= --}}
    @if ($hasRm24 && count($edukasiRm24) > 0)
        <!-- HEADER KOP & IDENTITAS PASIEN -->
        <table width="100%" class="table-borderless" style="border-bottom: 2px solid #000; padding-bottom: 2px;">
            <tr>
                <td width="10%" style="vertical-align: middle; text-align: center;">
                    <img src="{{ public_path('img/logo.png') }}" width="55" />
                </td>
                <td width="55%" style="vertical-align: middle;">
                    <strong style="font-size: 12px; display: block;">RUMAH SAKIT IBU DAN ANAK AISYIYAH</strong>
                    <strong style="font-size: 12px; display: block;">PEKAJANGAN &ndash; PEKALONGAN</strong>
                    <span style="font-size: 8.5px; display: block;">Jl. Raya Pekajangan No. 610 Pekajangan, Pekalongan, 51172</span>
                    <span style="font-size: 8.5px; display: block;">Telp. (0285) 785909 Email: rsiaaisyiyah@gmail.com</span>
                    <span style="font-size: 8.5px; display: block;">Website: www.rsiaaisyiyah.com</span>
                </td>
                <td width="35%" style="vertical-align: top;">
                    <table width="100%" class="border" style="font-size: 9px; border-collapse: collapse;">
                        <tr>
                            <td width="35%" style="padding: 1.5px 3px; border: 1px solid #000;"><strong>Nama</strong></td>
                            <td width="65%" style="padding: 1.5px 3px; border: 1px solid #000;">: {{ $pasien->nm_pasien ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td style="padding: 1.5px 3px; border: 1px solid #000;"><strong>Tgl. Lahir</strong></td>
                            <td style="padding: 1.5px 3px; border: 1px solid #000;">: {{ $pasien->tgl_lahir ? date('d-m-Y', strtotime($pasien->tgl_lahir)) : '-' }} ({{ $pasien->jk ?? '-' }})</td>
                        </tr>
                        <tr>
                            <td style="padding: 1.5px 3px; border: 1px solid #000;"><strong>No. RM</strong></td>
                            <td style="padding: 1.5px 3px; border: 1px solid #000;">: {{ $pasien->no_rkm_medis ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td style="padding: 1.5px 3px; border: 1px solid #000;"><strong>Ruang/Kelas</strong></td>
                            <td style="padding: 1.5px 3px; border: 1px solid #000;">: {{ $nmBangsal }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <div class="box-title">
            CATATAN PELAKSANAAN EDUKASI KEPADA PASIEN
        </div>

        <!-- TABEL UTAMA RM 24 -->
        <table class="table-rm24">
            <thead>
                <tr>
                    <th width="4%">NO</th>
                    <th width="28%">MATERI EDUKASI</th>
                    <th width="12%">TGL &amp; WAKTU<br>/ DURASI</th>
                    <th width="11%">METODE</th>
                    <th width="13%">HAMBATAN &amp; INTERVENSI</th>
                    <th width="12%">EVALUASI</th>
                    <th width="10%">PARAF PASIEN / KELUARGA</th>
                    <th width="10%">PARAF EDUKATOR</th>
                </tr>
            </thead>
            <tbody>
                @php $maxRows = max(count($edukasiRm24), 8); @endphp
                @for ($i = 0; $i < $maxRows; $i++)
                    @php $edu = $edukasiRm24[$i] ?? null; @endphp
                    <tr style="height: 32px;">
                        <td style="text-align: center; vertical-align: middle;">{{ $i + 1 }}</td>
                        <td style="vertical-align: middle;">
                            @if ($edu)
                                <strong>{{ $edu->materi }}</strong>
                                @if ($edu->disiplin)
                                    <br><small style="color: #555;">(Disiplin: {{ $edu->disiplin }})</small>
                                @endif
                            @endif
                        </td>
                        <td style="text-align: center; vertical-align: middle;">
                            @if ($edu)
                                <strong>{{ date('d-m-Y', strtotime($edu->tanggal)) }}</strong><br>
                                {{ date('H:i', strtotime($edu->tanggal)) }} WIB<br>
                                <span style="font-size: 7.5px; color: #333;">({{ $edu->durasi ?? '10 Menit' }})</span>
                            @endif
                        </td>
                        <td style="text-align: center; vertical-align: middle;">
                            @if ($edu && $edu->metode)
                                {{ $edu->metode }}
                            @endif
                        </td>
                        <td style="vertical-align: middle;">
                            @if ($edu)
                                <div style="font-size: 7.5px; line-height: 1.15;">
                                    <strong>H:</strong> {{ $edu->hambatan_lain ? $edu->hambatan_lain : ($edu->hambatan ?? 'Tidak Ada') }}<br>
                                    <strong>I:</strong> {{ $edu->intervensi_lain ? $edu->intervensi_lain : ($edu->intervensi ?? 'Tidak Ada') }}
                                </div>
                            @endif
                        </td>
                        <td style="text-align: center; vertical-align: middle;">
                            @if ($edu && $edu->evaluasi)
                                <span style="font-size: 7.5px;">{{ $edu->evaluasi }}</span>
                            @endif
                        </td>
                        <td style="text-align: center; vertical-align: middle;">
                            @if ($edu && $edu->ttd_pasien)
                                @php
                                    $ttdSrc = $edu->ttd_pasien;
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
                                <img src="{{ $ttdSrc }}" height="32" style="max-width: 45px;" /><br>
                                <span style="font-size: 7px;">{{ $edu->nama_penerima ?? 'Keluarga' }}</span>
                            @endif
                        </td>
                        <td style="text-align: center; vertical-align: middle;">
                            @if ($edu && $edu->nip)
                                @php
                                    $nmPetugas = $edu->petugas->nama ?? ($edu->dokter->nm_dokter ?? '-');
                                    $qrText = 'Diedukasi oleh: ' . $nmPetugas . ' (NIP: ' . $edu->nip . ') pada ' . date('d-m-Y H:i', strtotime($edu->tanggal));
                                @endphp
                                <img src="data:image/png;base64,{!! DNS2D::getBarcodePNG($qrText, 'QRCODE', 1.8, 1.8) !!}" height="30" /><br>
                                <span style="font-size: 7px;">{{ $nmPetugas }}</span>
                            @endif
                        </td>
                    </tr>
                @endfor
            </tbody>
        </table>

        <!-- PERNYATAAN & TTD PASIEN -->
        @php
            $lastEduWithTtd24 = $edukasiRm24->filter(fn($e) => !empty($e->ttd_pasien))->last() ?? $edukasiRm24->last();
            $namaPenerimaFinal24 = $lastEduWithTtd24->nama_penerima ?? ($regPeriksa->p_jawab ?? ($pasien->nm_pasien ?? ''));
            $ttdPasienFinal24 = $lastEduWithTtd24->ttd_pasien ?? null;
            $ttdSrcFinal24 = null;
            if (!empty($ttdPasienFinal24)) {
                $ttdSrcFinal24 = $ttdPasienFinal24;
                if (!str_starts_with($ttdSrcFinal24, 'data:image')) {
                    $absStorage = storage_path('app/public/' . ltrim($ttdSrcFinal24, '/'));
                    $absPublic = public_path('storage/' . ltrim($ttdSrcFinal24, '/'));
                    if (file_exists($absStorage)) {
                        $ttdSrcFinal24 = $absStorage;
                    } elseif (file_exists($absPublic)) {
                        $ttdSrcFinal24 = $absPublic;
                    }
                }
            }
        @endphp
        <div style="border: 1px solid #000; border-top: none; padding: 4px 8px; font-size: 8.5px;">
            <table width="100%" class="table-borderless" style="font-size: 8.5px; line-height: 1.2;">
                <tr>
                    <td width="68%" style="vertical-align: middle;">
                        <em>"Dengan ini menyatakan bahwa saya telah diberikan informasi dan edukasi serta diberi kesempatan untuk bertanya dan berdiskusi."</em>
                    </td>
                    <td width="32%" style="vertical-align: middle; text-align: center;">
                        <div style="font-size: 8px; font-weight: bold; margin-bottom: 2px;">Paraf Pasien / Keluarga :</div>
                        @if ($ttdSrcFinal24)
                            <img src="{{ $ttdSrcFinal24 }}" height="32" style="max-width: 60px; display: block; margin: 0 auto;" />
                            <span style="font-size: 8px; font-weight: bold; text-decoration: underline;">( {{ $namaPenerimaFinal24 }} )</span>
                        @else
                            <div style="height: 25px;"></div>
                            <span style="font-size: 8px;">( {{ $namaPenerimaFinal24 ? $namaPenerimaFinal24 : '...................................................' }} )</span>
                        @endif
                    </td>
                </tr>
            </table>
        </div>

        <!-- KETERANGAN KODE KELENGKAPAN -->
        <div class="legend-box">
            <table width="100%" class="table-borderless" style="font-size: 7.5px; line-height: 1.1;">
                <tr>
                    <td width="12%"><strong>Metode</strong></td>
                    <td width="88%">: a. Diskusi / Wawancara &nbsp;&nbsp; b. Simulasi (S) &nbsp;&nbsp; c. Demonstrasi (Demo) &nbsp;&nbsp; d. Ceramah &nbsp;&nbsp; e. Observasi (O) &nbsp;&nbsp; f. Praktek Langsung (PL)</td>
                </tr>
                <tr>
                    <td><strong>Hambatan</strong></td>
                    <td>: a. Tidak Ada &nbsp; b. Bahasa &nbsp; c. Kehilangan Harapan &nbsp; d. Masalah Keuangan &nbsp; e. Kesalahan &nbsp; f. Faktor Budaya &nbsp; g. Kelemahan Sensori &nbsp; h. Tidak Percaya Diri &nbsp; i. Menyangkal &nbsp; j. Kecemasan/ketakutan &nbsp; k. Kelemahan Kognitif &nbsp; l. Tidak tertarik</td>
                </tr>
                <tr>
                    <td><strong>Intervensi</strong></td>
                    <td>: a. Tidak Ada &nbsp; b. Menyediakan Penerjemah &nbsp; c. Melakukan Pendekatan secara budaya/agama &nbsp; d. Mengulangi materi &nbsp; e. Melibatkan Keluarga Terdekat &nbsp; f. Memakai role model perilaku</td>
                </tr>
            </table>
        </div>

        <div style="text-align: right; font-size: 9px; font-weight: bold; margin-top: 2px;">
            RM 24
        </div>
    @endif
@endsection
