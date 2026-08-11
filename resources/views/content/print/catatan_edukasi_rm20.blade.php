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
        .table-rm20 {
            width: 100%;
            border-collapse: collapse;
            font-size: 8px;
        }
        .table-rm20 th {
            border: 1px solid #000;
            padding: 2.5px 2px;
            text-align: center;
            background-color: #eee;
            font-size: 8px;
        }
        .table-rm20 td {
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
    </style>

    @php
        $pasien = $regPeriksa->pasien ?? null;
        $kamar = $regPeriksa->kamarInap ? $regPeriksa->kamarInap->filter(fn($k) => $k->stts_pulang != 'Pindah Kamar')->first() : null;
        $nmBangsal = $kamar && $kamar->kamar && $kamar->kamar->bangsal ? $kamar->kamar->bangsal->nm_bangsal : ($regPeriksa->poliklinik->nm_poli ?? '-');

        $as = $asesmen ?? null;

        $caraBelajar = $as ? ($as->cara_belajar ?? '') : '';
        $kebutuhanEdukasi = $as ? ($as->kebutuhan_edukasi ?? '') : '';
        $tabelRencana = ($as && is_array($as->tabel_rencana)) ? $as->tabel_rencana : (($as && is_string($as->tabel_rencana)) ? json_decode($as->tabel_rencana, true) : []);

        // Master baris rencana
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
@endsection
