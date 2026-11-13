<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Pemberian Obat - {{ $pasien->nm_pasien ?? 'Pasien' }} (RM 5A)</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 8mm 10mm 6mm 10mm;
        }

        * {
            box-sizing: border-box;
            -webkit-print-color-adjust: exact;
        }

        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 8.5pt;
            color: #000;
            line-height: 1.15;
            margin: 0;
            padding: 0;
            background: #fff;
        }

        /* Header & Stiker Pasien */
        .header-wrap {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 3px;
        }

        .header-wrap td {
            vertical-align: top;
            padding: 0;
        }

        .kop-instansi {
            font-size: 8pt;
            line-height: 1.15;
        }

        .kop-title {
            font-size: 11pt;
            font-weight: bold;
            margin-bottom: 1px;
            letter-spacing: 0.2pt;
        }

        .box-stiker-pasien {
            border: 1pt solid #000;
            border-radius: 4px;
            padding: 4px 6px;
            font-size: 7.5pt;
            line-height: 1.25;
            width: 250px;
            margin-left: auto;
        }

        .box-stiker-pasien table {
            width: 100%;
            border-collapse: collapse;
        }

        .box-stiker-pasien td {
            padding: 0.5px 1px;
            vertical-align: top;
        }

        /* Judul Dokumen */
        .title-doc {
            text-align: center;
            font-size: 11pt;
            font-weight: bold;
            margin: 2px 0 4px 0;
            letter-spacing: 0.5pt;
        }

        /* Baris Meta Pasien */
        .meta-table {
            width: 100%;
            border: 0.75pt solid #000;
            border-collapse: collapse;
            font-size: 8pt;
            margin-bottom: 4px;
        }

        .meta-table td {
            padding: 2.5px 4px;
            vertical-align: middle;
            border-right: 0.75pt solid #000;
        }

        .meta-table td:last-child {
            border-right: none;
        }

        /* Tabel Utama Daftar Obat */
        .table-obat {
            width: 100%;
            border: 0.75pt solid #000;
            border-collapse: collapse;
            font-size: 7.5pt;
            margin-bottom: 4px;
        }

        .table-obat th, .table-obat td {
            border: 0.5pt solid #000;
            padding: 2px 2px;
            vertical-align: middle;
        }

        .table-obat th {
            background-color: #f2f2f2;
            text-align: center;
            font-weight: bold;
            font-size: 7.5pt;
        }

        .th-shift {
            font-size: 7pt;
            width: 16px;
            text-align: center;
        }

        .td-center {
            text-align: center;
        }

        .td-jam {
            text-align: center;
            font-size: 7pt;
            font-weight: 500;
            font-family: monospace;
            padding: 1px 0;
            overflow: hidden;
            white-space: nowrap;
        }

        .section-header {
            background-color: #e6e6e6;
            font-weight: bold;
            text-align: left;
            padding-left: 6px;
            font-size: 8pt;
            text-transform: uppercase;
        }

        .footer-petugas-row td {
            font-size: 7pt;
            background-color: #fafafa;
            padding: 1.5px 2px;
        }

        /* Footer Standar Jam */
        .footer-wrap {
            width: 100%;
            border-collapse: collapse;
            margin-top: 3px;
            font-size: 6.8pt;
            line-height: 1.15;
        }

        .footer-wrap td {
            vertical-align: top;
            padding: 0;
        }

        .box-panduan {
            border: 0.5pt solid #555;
            padding: 3px 5px;
            border-radius: 3px;
        }

        .box-panduan-title {
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 1.5px;
        }

        .check-mark {
            font-family: DejaVu Sans, sans-serif;
            font-weight: bold;
        }
    </style>
</head>
<body>

    @php
        $pasienObj = $regPeriksa->pasien ?? null;
        $nmPasien = strtoupper($pasienObj->nm_pasien ?? '-');
        $noRm = $pasienObj->no_rkm_medis ?? '-';
        $jk = $pasienObj->jk ?? '-';
        $tglLahir = !empty($pasienObj->tgl_lahir) ? date('Y-m-d', strtotime($pasienObj->tgl_lahir)) : '-';
        $umur = ($regPeriksa->umurdaftar ?? 0) . ' Th ' . ($regPeriksa->sttsumur ?? '');
        $alamat = $pasienObj->alamat ?? '-';
        $noTelp = $pasienObj->no_tlp ?? '-';
        $tglMasukDisplay = !empty($tglMasukRawat) ? date('d/m/Y', strtotime($tglMasukRawat)) : date('d/m/Y');
    @endphp

    <!-- 1. KOP RS & KOTAK STIKER PASIEN -->
    <table class="header-wrap">
        <tr>
            <td style="width: 65%;">
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="width: 50px; vertical-align: middle;">
                            @if(!empty($logoBase64))
                                <img src="data:image/png;base64,{{ $logoBase64 }}" style="max-height: 42px; max-width: 42px;" alt="Logo">
                            @else
                                <img src="{{ public_path('img/logo.png') }}" style="max-height: 42px; max-width: 42px;" alt="Logo">
                            @endif
                        </td>
                        <td style="vertical-align: middle; padding-left: 6px;">
                            <div class="kop-instansi">
                                <div class="kop-title">{{ $setting->nama_instansi ?? 'RSIA AISYIYAH PEKAJANGAN' }}</div>
                                <div>{{ $setting->alamat_instansi ?? 'Jl. Raya Pekajangan No. 610 Pekajangan, 51172' }}</div>
                                <div>Telp. {{ $setting->kontak ?? '(0285) 785909' }} | Email: {{ $setting->email ?? 'pekajangan@rsiaaisyiyah.com' }}</div>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
            <td style="width: 35%; text-align: right;">
                <div class="box-stiker-pasien">
                    <table>
                        <tr>
                            <td style="width: 22%;">No. RM</td>
                            <td style="width: 3%;">:</td>
                            <td style="width: 75%; font-weight: bold; font-family: monospace; font-size: 8.5pt;">{{ $noRm }}</td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td><strong>{{ $nmPasien }}</strong> ({{ $jk }})</td>
                        </tr>
                        <tr>
                            <td>Tgl. Lahir</td>
                            <td>:</td>
                            <td>{{ $tglLahir }} ({{ $umur }})</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td style="font-size: 7pt;">{{ \Illuminate\Support\Str::limit($alamat, 45) }}</td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>

    <!-- 2. JUDUL DOKUMEN -->
    <div class="title-doc">DAFTAR PEMBERIAN OBAT</div>

    <!-- 3. META BARIS PASIEN RAWAT INAP -->
    <table class="meta-table">
        <tr>
            <td style="width: 22%;">
                <b>Tanggal Masuk :</b> {{ $tglMasukDisplay }}
            </td>
            <td style="width: 36%;">
                <b>Dokter :</b> {{ $dokterDpjp }}
            </td>
            <td style="width: 24%;">
                <b>Alergi Obat :</b> <span style="{{ $alergiDisplay !== 'Tidak Ada' ? 'color: red; font-weight: bold;' : '' }}">{{ $alergiDisplay }}</span>
            </td>
            <td style="width: 18%;">
                <b>Kamar :</b> {{ $kamarDisplay }}
            </td>
        </tr>
    </table>

    <!-- 4. TABEL UTAMA PEMBERIAN OBAT -->
    <table class="table-obat">
        <!-- HEADER LEVEL 1: KOLOM UTAMA & TANGGAL -->
        <thead>
            <tr>
                <th rowspan="2" style="width: 20px;">No</th>
                <th rowspan="2" style="width: 155px;">ORAL</th>
                <th rowspan="2" style="width: 48px;">Frekuensi</th>
                <th rowspan="2" style="width: 52px;">Dosis</th>
                <th colspan="3" style="width: 42px;">Waktu</th>
                @foreach($tanggalList as $tgl)
                    <th colspan="3" style="font-size: 7pt; padding: 1.5px 0;">Tgl: {{ $tgl['label'] }}</th>
                @endforeach
            </tr>
            <tr>
                <th style="font-size: 6.5pt; width: 14px;">Ac</th>
                <th style="font-size: 6.5pt; width: 14px;">dc</th>
                <th style="font-size: 6.5pt; width: 14px;">pc</th>
                @foreach($tanggalList as $tgl)
                    <th class="th-shift">P</th>
                    <th class="th-shift">S</th>
                    <th class="th-shift">M</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            <!-- BARIS OBAT ORAL -->
            @forelse($grupOral as $idx => $oral)
                <tr>
                    <td class="td-center">{{ $idx + 1 }}</td>
                    <td><strong>{{ $oral['nama'] }}</strong></td>
                    <td class="td-center">{{ $oral['frekuensi'] }}</td>
                    <td class="td-center">{{ $oral['dosis'] }}</td>
                    <td class="td-center"><span class="check-mark">{{ $oral['ac'] ? '✓' : '' }}</span></td>
                    <td class="td-center"><span class="check-mark">{{ $oral['dc'] ? '✓' : '' }}</span></td>
                    <td class="td-center"><span class="check-mark">{{ $oral['pc'] ? '✓' : '' }}</span></td>
                    @foreach($tanggalList as $tgl)
                        @php $p = $oral['pemberian'][$tgl['tanggal']] ?? ['P'=>'','S'=>'','M'=>'']; @endphp
                        <td class="td-jam">{{ $p['P'] }}</td>
                        <td class="td-jam">{{ $p['S'] }}</td>
                        <td class="td-jam">{{ $p['M'] }}</td>
                    @endforeach
                </tr>
            @empty
                <tr>
                    <td class="td-center">-</td>
                    <td style="color: #666; font-style: italic;">Tidak ada obat oral</td>
                    <td class="td-center">-</td>
                    <td class="td-center">-</td>
                    <td></td><td></td><td></td>
                    @foreach($tanggalList as $tgl)
                        <td></td><td></td><td></td>
                    @endforeach
                </tr>
            @endforelse

            <!-- FOOTER BAGIAN ORAL: DOUBLE CEK & PETUGAS -->
            <tr class="footer-petugas-row">
                <td class="td-center" colspan="4" style="text-align: right; font-weight: bold; padding-right: 6px;">Double Cek</td>
                <td colspan="3" class="td-center"><span class="check-mark">✓</span></td>
                @foreach($tanggalList as $tgl)
                    <td colspan="3" class="td-center" style="font-size: 6.5pt;"><span class="check-mark">✓</span></td>
                @endforeach
            </tr>
            <tr class="footer-petugas-row">
                <td colspan="7" style="text-align: right; font-weight: bold; padding-right: 6px;">Petugas Menyiapkan</td>
                @foreach($tanggalList as $tgl)
                    @php $pet = $petugasMap[$tgl['tanggal']] ?? ['menyiapkan'=>'-']; @endphp
                    <td colspan="3" class="td-center" style="font-size: 6.5pt; font-weight: bold;">{{ $pet['menyiapkan'] }}</td>
                @endforeach
            </tr>
            <tr class="footer-petugas-row" style="border-bottom: 1.5pt solid #000;">
                <td colspan="7" style="text-align: right; font-weight: bold; padding-right: 6px;">Petugas Memberikan</td>
                @foreach($tanggalList as $tgl)
                    @php $pet = $petugasMap[$tgl['tanggal']] ?? ['P'=>'-','S'=>'-','M'=>'-']; @endphp
                    <td class="td-center" style="font-size: 6pt;">{{ $pet['P'] }}</td>
                    <td class="td-center" style="font-size: 6pt;">{{ $pet['S'] }}</td>
                    <td class="td-center" style="font-size: 6pt;">{{ $pet['M'] }}</td>
                @endforeach
            </tr>

            <!-- ======================================================== -->
            <!-- SECTION 2: INJEKSI -->
            <!-- ======================================================== -->
            <tr style="background-color: #f2f2f2; font-weight: bold;">
                <td class="td-center" rowspan="2">No</td>
                <td rowspan="2" style="font-size: 8pt;">INJEKSI</td>
                <td class="td-center" rowspan="2">Frekuensi</td>
                <td class="td-center" rowspan="2">Dosis</td>
                <td class="td-center" style="font-size: 6.5pt; width: 14px;">iv</td>
                <td class="td-center" style="font-size: 6.5pt; width: 14px;">im</td>
                <td class="td-center" style="font-size: 6.5pt; width: 14px;">sc</td>
                @foreach($tanggalList as $tgl)
                    <td colspan="3" class="td-center" style="font-size: 7pt; padding: 1.5px 0;">Tgl: {{ $tgl['label'] }}</td>
                @endforeach
            </tr>
            <tr style="background-color: #f2f2f2; font-weight: bold;">
                <td colspan="3" class="td-center" style="font-size: 6pt; padding: 0;">Rute</td>
                @foreach($tanggalList as $tgl)
                    <td class="th-shift">P</td>
                    <th class="th-shift">S</th>
                    <th class="th-shift">M</th>
                @endforeach
            </tr>

            @forelse($grupInjeksi as $idx => $inj)
                <tr>
                    <td class="td-center">{{ $idx + 1 }}</td>
                    <td><strong>{{ $inj['nama'] }}</strong></td>
                    <td class="td-center">{{ $inj['frekuensi'] }}</td>
                    <td class="td-center">{{ $inj['dosis'] }}</td>
                    <td class="td-center"><span class="check-mark">{{ $inj['iv'] ? '✓' : '' }}</span></td>
                    <td class="td-center"><span class="check-mark">{{ $inj['im'] ? '✓' : '' }}</span></td>
                    <td class="td-center"><span class="check-mark">{{ $inj['sc'] ? '✓' : '' }}</span></td>
                    @foreach($tanggalList as $tgl)
                        @php $p = $inj['pemberian'][$tgl['tanggal']] ?? ['P'=>'','S'=>'','M'=>'']; @endphp
                        <td class="td-jam">{{ $p['P'] }}</td>
                        <td class="td-jam">{{ $p['S'] }}</td>
                        <td class="td-jam">{{ $p['M'] }}</td>
                    @endforeach
                </tr>
            @empty
                <tr>
                    <td class="td-center">-</td>
                    <td style="color: #666; font-style: italic;">Tidak ada obat injeksi</td>
                    <td class="td-center">-</td>
                    <td class="td-center">-</td>
                    <td></td><td></td><td></td>
                    @foreach($tanggalList as $tgl)
                        <td></td><td></td><td></td>
                    @endforeach
                </tr>
            @endforelse

            <!-- FOOTER INJEKSI -->
            <tr class="footer-petugas-row">
                <td class="td-center" colspan="4" style="text-align: right; font-weight: bold; padding-right: 6px;">Double Cek</td>
                <td colspan="3" class="td-center"><span class="check-mark">✓</span></td>
                @foreach($tanggalList as $tgl)
                    <td colspan="3" class="td-center" style="font-size: 6.5pt;"><span class="check-mark">✓</span></td>
                @endforeach
            </tr>
            <tr class="footer-petugas-row">
                <td colspan="7" style="text-align: right; font-weight: bold; padding-right: 6px;">Petugas Menyiapkan</td>
                @foreach($tanggalList as $tgl)
                    @php $pet = $petugasMap[$tgl['tanggal']] ?? ['menyiapkan'=>'-']; @endphp
                    <td colspan="3" class="td-center" style="font-size: 6.5pt; font-weight: bold;">{{ $pet['menyiapkan'] }}</td>
                @endforeach
            </tr>
            <tr class="footer-petugas-row" style="border-bottom: 1.5pt solid #000;">
                <td colspan="7" style="text-align: right; font-weight: bold; padding-right: 6px;">Petugas Memberikan</td>
                @foreach($tanggalList as $tgl)
                    @php $pet = $petugasMap[$tgl['tanggal']] ?? ['P'=>'-','S'=>'-','M'=>'-']; @endphp
                    <td class="td-center" style="font-size: 6pt;">{{ $pet['P'] }}</td>
                    <td class="td-center" style="font-size: 6pt;">{{ $pet['S'] }}</td>
                    <td class="td-center" style="font-size: 6pt;">{{ $pet['M'] }}</td>
                @endforeach
            </tr>

            <!-- ======================================================== -->
            <!-- SECTION 3: LAIN-LAIN (Inhalasi, O2, Salep, dll) -->
            <!-- ======================================================== -->
            <tr style="background-color: #f2f2f2; font-weight: bold;">
                <td class="td-center" rowspan="2">No</td>
                <td rowspan="2" style="font-size: 8pt;">LAIN-LAIN</td>
                <td class="td-center" rowspan="2">Frekuensi</td>
                <td class="td-center" colspan="4" rowspan="2">KETERANGAN / Dosis</td>
                @foreach($tanggalList as $tgl)
                    <td colspan="3" class="td-center" style="font-size: 7pt; padding: 1.5px 0;">Tgl: {{ $tgl['label'] }}</td>
                @endforeach
            </tr>
            <tr style="background-color: #f2f2f2; font-weight: bold;">
                @foreach($tanggalList as $tgl)
                    <td class="th-shift">P</td>
                    <th class="th-shift">S</th>
                    <th class="th-shift">M</th>
                @endforeach
            </tr>

            @forelse($grupLain as $idx => $lain)
                <tr>
                    <td class="td-center">{{ $idx + 1 }}</td>
                    <td><strong>{{ $lain['nama'] }}</strong></td>
                    <td class="td-center">{{ $lain['frekuensi'] }}</td>
                    <td colspan="4" style="font-size: 7pt;">{{ $lain['keterangan'] }}</td>
                    @foreach($tanggalList as $tgl)
                        @php $p = $lain['pemberian'][$tgl['tanggal']] ?? ['P'=>'','S'=>'','M'=>'']; @endphp
                        <td class="td-jam">{{ $p['P'] ?: ($p['P'] === false ? '' : ($p['P'] ? '✓' : '')) }}</td>
                        <td class="td-jam">{{ $p['S'] ?: ($p['S'] === false ? '' : ($p['S'] ? '✓' : '')) }}</td>
                        <td class="td-jam">{{ $p['M'] ?: ($p['M'] === false ? '' : ($p['M'] ? '✓' : '')) }}</td>
                    @endforeach
                </tr>
            @empty
                <tr>
                    <td class="td-center">-</td>
                    <td style="color: #666; font-style: italic;">Tidak ada terapi lain-lain</td>
                    <td class="td-center">-</td>
                    <td colspan="4" class="td-center">-</td>
                    @foreach($tanggalList as $tgl)
                        <td></td><td></td><td></td>
                    @endforeach
                </tr>
            @endforelse

            <!-- FOOTER LAIN-LAIN -->
            <tr class="footer-petugas-row">
                <td class="td-center" colspan="4" style="text-align: right; font-weight: bold; padding-right: 6px;">Double Cek</td>
                <td colspan="3" class="td-center"><span class="check-mark">✓</span></td>
                @foreach($tanggalList as $tgl)
                    <td colspan="3" class="td-center" style="font-size: 6.5pt;"><span class="check-mark">✓</span></td>
                @endforeach
            </tr>
            <tr class="footer-petugas-row">
                <td colspan="7" style="text-align: right; font-weight: bold; padding-right: 6px;">Petugas Menyiapkan</td>
                @foreach($tanggalList as $tgl)
                    @php $pet = $petugasMap[$tgl['tanggal']] ?? ['menyiapkan'=>'-']; @endphp
                    <td colspan="3" class="td-center" style="font-size: 6.5pt; font-weight: bold;">{{ $pet['menyiapkan'] }}</td>
                @endforeach
            </tr>
            <tr class="footer-petugas-row">
                <td colspan="7" style="text-align: right; font-weight: bold; padding-right: 6px;">Petugas Memberikan</td>
                @foreach($tanggalList as $tgl)
                    @php $pet = $petugasMap[$tgl['tanggal']] ?? ['P'=>'-','S'=>'-','M'=>'-']; @endphp
                    <td class="td-center" style="font-size: 6pt;">{{ $pet['P'] }}</td>
                    <td class="td-center" style="font-size: 6pt;">{{ $pet['S'] }}</td>
                    <td class="td-center" style="font-size: 6pt;">{{ $pet['M'] }}</td>
                @endforeach
            </tr>
        </tbody>
    </table>

    <!-- 5. FOOTER PANDUAN STANDAR WAKTU PEMBERIAN OBAT (SESUAI RM 5A) -->
    <table class="footer-wrap">
        <tr>
            <!-- Kotak Waktu Oral -->
            <td style="width: 48%; padding-right: 6px;">
                <div class="box-panduan">
                    <div class="box-panduan-title">Waktu Pemberian Obat Oral :</div>
                    <table style="width: 100%; border-collapse: collapse; font-size: 6.5pt;">
                        <tr>
                            <td style="width: 50%;">1 x 1 : 07.00 - 08.00 (Pagi)</td>
                            <td style="width: 50%;">2 x 1 : 07.00 - 08.00 dan 18.00 - 19.00</td>
                        </tr>
                        <tr>
                            <td>1 x 1 : 12.00 - 13.00 (Siang)</td>
                            <td>3 x 1 : 07.00 - 08.00 ; 12.00 - 13.00 ; 18.00 - 19.00</td>
                        </tr>
                        <tr>
                            <td>1 x 1 : 17.00 - 18.00 (Malam)</td>
                            <td>4 x 1 : 07.00 - 08.00 ; 12.00 - 13.00 ; 18.00 - 19.00 dan 24.00</td>
                        </tr>
                    </table>
                    <div style="font-style: italic; color: #444; margin-top: 1px;">Isi dengan lengkap jelas dan terbaca.</div>
                </div>
            </td>

            <!-- Kotak Waktu Injeksi -->
            <td style="width: 52%;">
                <div class="box-panduan">
                    <div class="box-panduan-title">Waktu Pemberian Obat Injeksi :</div>
                    <table style="width: 100%; border-collapse: collapse; font-size: 6.5pt;">
                        <tr>
                            <td style="width: 55%;">1 x 1 : 08.00 - 09.00 (Pagi)</td>
                            <td style="width: 45%;">1 x 1 : 20.00 (Malam)</td>
                        </tr>
                        <tr>
                            <td colspan="2">2 x 1 : 08.00 - 09.00 dan 20.00 - 21.00</td>
                        </tr>
                        <tr>
                            <td colspan="2">3 x 1 : 08.00 - 09.00 ; 16.00 - 17.00 ; 23.00 - 24.00</td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>

    <!-- Label Kode Formulir RM 5A -->
    <table style="width: 100%; margin-top: 2px; font-size: 7pt;">
        <tr>
            <td style="text-align: center; font-weight: bold; letter-spacing: 0.5pt;">DAFTAR PEMBERIAN OBAT</td>
            <td style="text-align: right; width: 140px; font-weight: bold; font-family: monospace;">Rev2/2022-09-01 &nbsp; RM 5A</td>
        </tr>
    </table>

</body>
</html>

