<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Etiket Obat - {{ $resep->no_resep }}</title>
    <style>
        @page {
            margin: 0;
            padding: 0;
        }

        * {
            box-sizing: border-box;
            -webkit-print-color-adjust: exact;
        }

        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff;
            color: #000;
        }

        .etiket-card {
            border: 0.75pt solid #000;
            box-sizing: border-box;
            page-break-after: always;
        }

        .etiket-card:last-child {
            page-break-after: avoid;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
        }

        .text-meta {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .obat-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        /* Responsive styling per ukuran label thermal */
        @if($ukuran === '5x3')
            .etiket-card { margin: 1pt 2pt; padding: 1.5pt 2.5pt; }
            .header-title { font-size: 4.8pt; font-weight: bold; line-height: 1.1; text-align: center; }
            .header-sub { font-size: 3.4pt; line-height: 1.05; text-align: center; }
            .section-badge { font-size: 4.2pt; font-weight: bold; margin: 0.5pt 0; text-align: center; }
            .text-meta { font-size: 3.8pt; line-height: 1.15; }
            .obat-nama { font-size: 5pt; font-weight: bold; }
            .obat-qty { font-size: 4.6pt; font-weight: bold; text-align: right; padding-right: 1.5pt; }
            .aturan-box { font-size: 7.2pt; font-weight: bold; margin: 1.2pt 0 0.8pt 0; text-align: center; }
            .racik-detail { font-size: 3.2pt; font-style: italic; color: #222; text-align: center; line-height: 1.0; }
            .doa-text { font-size: 3.4pt; font-style: italic; text-align: center; margin-top: 0.8pt; }
            .divider { border-bottom: 0.4pt solid #000; margin: 1pt 0; }
            .logo-img { max-height: 15pt; max-width: 15pt; }
            .logo-td { width: 16pt; }
        @elseif($ukuran === '5x5.8')
            .etiket-card { 
                margin: 1.5pt 2.5pt; 
                padding: 3pt 3.5pt; 
                height: 153pt; 
                border: 0.75pt solid #000; 
                box-sizing: border-box; 
            }
            .header-title { font-size: 6pt; font-weight: bold; line-height: 1.15; text-align: center; }
            .header-sub { font-size: 4pt; line-height: 1.12; text-align: center; }
            .section-badge { font-size: 5.5pt; font-weight: bold; margin: 1.8pt 0 1.2pt 0; text-align: center; letter-spacing: 0.3pt; }
            .text-meta { font-size: 4.4pt; line-height: 1.35; }
            .text-meta td { padding-top: 0.4pt; padding-bottom: 0.4pt; }
            .obat-table { margin-top: 3pt; }
            .obat-nama { font-size: 7.2pt; font-weight: bold; line-height: 1.2; }
            .obat-qty { font-size: 6.8pt; font-weight: bold; text-align: right; padding-right: 1.5pt; }
            .aturan-box { font-size: 13pt; font-weight: bold; margin: 9pt 0 5pt 0; text-align: center; line-height: 1.2; }
            .racik-detail { font-size: 3.8pt; font-style: italic; color: #222; text-align: center; line-height: 1.05; margin: 1.5pt 0; }
            .doa-text { font-size: 5.2pt; font-style: italic; text-align: center; margin-top: 8pt; }
            .divider { border-bottom: 0.55pt solid #000; margin: 2pt 0; }
            .logo-img { max-height: 22pt; max-width: 22pt; }
            .logo-td { width: 23pt; }
        @elseif($ukuran === '6.5x4')
            .etiket-card { margin: 1pt 2.5pt; padding: 2pt 3pt; }
            .header-title { font-size: 6.5pt; font-weight: bold; line-height: 1.15; text-align: center; }
            .header-sub { font-size: 4.2pt; line-height: 1.1; text-align: center; }
            .section-badge { font-size: 5.2pt; font-weight: bold; margin: 0.8pt 0; text-align: center; letter-spacing: 0.3pt; }
            .text-meta { font-size: 4.6pt; line-height: 1.22; }
            .obat-nama { font-size: 6.6pt; font-weight: bold; line-height: 1.15; }
            .obat-qty { font-size: 6.3pt; font-weight: bold; text-align: right; padding-right: 1.5pt; }
            .aturan-box { font-size: 10pt; font-weight: bold; margin: 2pt 0 1.2pt 0; text-align: center; }
            .racik-detail { font-size: 3.6pt; font-style: italic; color: #222; text-align: center; line-height: 1.05; }
            .doa-text { font-size: 4.2pt; font-style: italic; text-align: center; margin-top: 1.8pt; }
            .divider { border-bottom: 0.5pt solid #000; margin: 1.2pt 0; }
            .logo-img { max-height: 19pt; max-width: 19pt; }
            .logo-td { width: 21pt; }
        @elseif($ukuran === '7x5')
            .etiket-card { margin: 2pt 3.5pt; padding: 3pt 4pt; }
            .header-title { font-size: 7.6pt; font-weight: bold; line-height: 1.15; text-align: center; }
            .header-sub { font-size: 5pt; line-height: 1.12; text-align: center; }
            .section-badge { font-size: 6.4pt; font-weight: bold; margin: 1.2pt 0; text-align: center; letter-spacing: 0.5pt; }
            .text-meta { font-size: 5.4pt; line-height: 1.25; }
            .obat-nama { font-size: 7.5pt; font-weight: bold; }
            .obat-qty { font-size: 7pt; font-weight: bold; text-align: right; padding-right: 2pt; }
            .aturan-box { font-size: 11pt; font-weight: bold; margin: 3pt 0 1.5pt 0; text-align: center; }
            .racik-detail { font-size: 4.5pt; font-style: italic; color: #222; text-align: center; }
            .doa-text { font-size: 5pt; font-style: italic; text-align: center; margin-top: 2.2pt; }
            .divider { border-bottom: 0.65pt solid #000; margin: 1.6pt 0; }
            .logo-img { max-height: 23pt; max-width: 23pt; }
            .logo-td { width: 25pt; }
        @elseif($ukuran === '8x5')
            .etiket-card { margin: 2pt 4pt; padding: 3pt 4.5pt; }
            .header-title { font-size: 8pt; font-weight: bold; line-height: 1.15; text-align: center; }
            .header-sub { font-size: 5.2pt; line-height: 1.12; text-align: center; }
            .section-badge { font-size: 6.8pt; font-weight: bold; margin: 1.2pt 0; text-align: center; letter-spacing: 0.5pt; }
            .text-meta { font-size: 5.6pt; line-height: 1.25; }
            .obat-nama { font-size: 8pt; font-weight: bold; }
            .obat-qty { font-size: 7.5pt; font-weight: bold; text-align: right; padding-right: 2pt; }
            .aturan-box { font-size: 11.5pt; font-weight: bold; margin: 3pt 0 1.5pt 0; text-align: center; }
            .racik-detail { font-size: 4.8pt; font-style: italic; color: #222; text-align: center; }
            .doa-text { font-size: 5.2pt; font-style: italic; text-align: center; margin-top: 2.2pt; }
            .divider { border-bottom: 0.7pt solid #000; margin: 1.8pt 0; }
            .logo-img { max-height: 24pt; max-width: 24pt; }
            .logo-td { width: 26pt; }
        @elseif($ukuran === '8x6')
            .etiket-card { margin: 2.5pt 4pt; padding: 3.5pt 5pt; }
            .header-title { font-size: 8.5pt; font-weight: bold; line-height: 1.18; text-align: center; }
            .header-sub { font-size: 5.5pt; line-height: 1.15; text-align: center; }
            .section-badge { font-size: 7.2pt; font-weight: bold; margin: 1.5pt 0; text-align: center; letter-spacing: 0.6pt; }
            .text-meta { font-size: 6pt; line-height: 1.28; }
            .obat-nama { font-size: 8.5pt; font-weight: bold; }
            .obat-qty { font-size: 8pt; font-weight: bold; text-align: right; padding-right: 2.5pt; }
            .aturan-box { font-size: 12.5pt; font-weight: bold; margin: 3.5pt 0 2pt 0; text-align: center; }
            .racik-detail { font-size: 5.2pt; font-style: italic; color: #222; text-align: center; }
            .doa-text { font-size: 5.6pt; font-style: italic; text-align: center; margin-top: 2.5pt; }
            .divider { border-bottom: 0.75pt solid #000; margin: 2pt 0; }
            .logo-img { max-height: 26pt; max-width: 26pt; }
            .logo-td { width: 28pt; }
        @else
            .etiket-card { margin: 1.5pt 3pt; padding: 2.5pt 3.5pt; }
            .header-title { font-size: 6.8pt; font-weight: bold; line-height: 1.15; text-align: center; }
            .header-sub { font-size: 4.4pt; line-height: 1.12; text-align: center; }
            .section-badge { font-size: 5.5pt; font-weight: bold; margin: 1pt 0; text-align: center; }
            .text-meta { font-size: 4.8pt; line-height: 1.25; }
            .obat-nama { font-size: 6.8pt; font-weight: bold; }
            .obat-qty { font-size: 6.5pt; font-weight: bold; text-align: right; padding-right: 2pt; }
            .aturan-box { font-size: 10.5pt; font-weight: bold; margin: 2.5pt 0 1.5pt 0; text-align: center; }
            .racik-detail { font-size: 3.8pt; font-style: italic; color: #222; text-align: center; }
            .doa-text { font-size: 4.5pt; font-style: italic; text-align: center; margin-top: 2pt; }
            .divider { border-bottom: 0.55pt solid #000; margin: 1.5pt 0; }
            .logo-img { max-height: 20pt; max-width: 20pt; }
            .logo-td { width: 22pt; }
        @endif

        .lbl-bold {
            font-weight: bold;
        }

        .text-right-cell {
            text-align: right;
            padding-right: 2pt;
        }
    </style>
</head>
<body>

@php
    $pasien = $resep->regPeriksa->pasien ?? null;
    $dokter = $resep->dokter->nm_dokter ?? ($resep->regPeriksa->dokter->nm_dokter ?? '-');
    $poliKamar = $resep->status === 'ranap'
        ? ($kamarDisplay ?? 'Rawat Inap')
        : ($resep->regPeriksa->poliklinik->nm_poli ?? 'Rawat Jalan');
    
    $nmPasien = strtoupper($pasien->nm_pasien ?? '-');
    $noRkmMedis = $pasien->no_rkm_medis ?? '-';
    $tglLahir = !empty($pasien->tgl_lahir) ? date('d/m/Y', strtotime($pasien->tgl_lahir)) : '-';
    $jkUmur = ($pasien->jk ?? '-') . ' / ' . ($resep->regPeriksa->umurdaftar ?? '-') . ' ' . ($resep->regPeriksa->sttsumur ?? 'Th');
@endphp

@foreach($items as $item)
<div class="etiket-card">
    <!-- 1. KOP RS (SESUAI DlgResepObat KHANZA DENGAN LOGO RSIA) -->
    <table class="header-table">
        <tr>
            <td class="logo-td" style="vertical-align: middle; text-align: left;">
                @if(!empty($logoBase64))
                    <img src="data:image/png;base64,{{ $logoBase64 }}" class="logo-img" alt="Logo">
                @else
                    <img src="{{ public_path('img/LOGO RSIA .png') }}" class="logo-img" alt="Logo">
                @endif
            </td>
            <td style="text-align: center; vertical-align: middle;">
                <div class="header-title">{{ $setting->nama_instansi ?? 'RSIA AISYIYAH PEKAJANGAN' }}</div>
                <div class="header-sub">{{ $setting->alamat_instansi ?? 'Jl. Raya Pekajangan No. 610' }}, {{ $setting->kabupaten ?? 'Pekalongan' }}</div>
                <div class="header-sub">Telp. {{ $setting->kontak ?? '(0285) 785909' }}</div>
            </td>
            <td class="logo-td" style="vertical-align: middle; text-align: right;">
                <!-- Spacer penyeimbang simetris -->
            </td>
        </tr>
    </table>

    <div class="divider"></div>

    <!-- 2. JUDUL INSTALASI & META RESEP -->
    <div class="section-badge">INSTALASI FARMASI</div>

    <table class="text-meta">
        <tr>
            <td style="width: 50%; vertical-align: top; overflow: hidden; white-space: nowrap;">
                <span>{{ $tglResep }} {{ $jamResep }}</span>
            </td>
            <td class="text-right-cell" style="width: 50%; vertical-align: top; overflow: hidden; white-space: nowrap;">
                <span class="lbl-bold">{{ $resep->no_resep }}</span>
            </td>
        </tr>
        <tr>
            <td style="width: 50%; vertical-align: top; overflow: hidden; white-space: nowrap;">
                <span>No.RM : </span><span class="lbl-bold">{{ $noRkmMedis }}</span>
            </td>
            <td class="text-right-cell" style="width: 50%; vertical-align: top; overflow: hidden; white-space: nowrap;">
                <span>Tgl.Lahir : </span><span>{{ $tglLahir }}</span>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="vertical-align: top; overflow: hidden; white-space: nowrap;">
                <span class="lbl-bold">{{ $nmPasien }}</span> / {{ $jkUmur }}
            </td>
        </tr>
    </table>

    <div class="divider"></div>

    <!-- 3. DETAIL OBAT & ATURAN PAKAI -->
    <table class="obat-table">
        <tr>
            <td class="obat-nama" style="width: 60%; vertical-align: top;">
                {{ strtoupper($item['nama']) }}
            </td>
            <td class="obat-qty text-right-cell" style="width: 40%; vertical-align: top;">
                {{ $item['jml'] }} {{ ucfirst(strtolower($item['satuan'])) }}
            </td>
        </tr>
    </table>

    @if(!empty($item['detail_racik']) && count($item['detail_racik']) > 0)
        <div class="racik-detail">
            ({{ implode(', ', $item['detail_racik']) }})
        </div>
    @endif

    <div class="aturan-box">
        {{ strtoupper($item['aturan_pakai']) }}
    </div>

    @if(!empty($item['keterangan']) && $item['keterangan'] !== '-')
        <div style="font-size: 0.82em; text-align: center; color: #333; margin-top: -0.5pt;">
            {{ $item['keterangan'] }}
        </div>
    @endif

    <div class="doa-text">
        Semoga Lekas Sembuh
    </div>
</div>
@endforeach

</body>
</html>
