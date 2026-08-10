@extends('content.print.main')
@section('content')
    <style>
        .box-title {
            border: 1.5px solid #000;
            text-align: center;
            font-weight: bold;
            font-size: 11px;
            padding: 4px;
            margin-top: 4px;
            margin-bottom: 6px;
            background-color: #f2f2f2;
            letter-spacing: 0.5px;
        }
        .table-borderless td, .table-borderless th {
            border: none;
            padding: 1.5px 3px;
            font-size: 9.5px;
            vertical-align: top;
        }
        .table-rm24 {
            width: 100%;
            border-collapse: collapse;
            font-size: 9px;
        }
        .table-rm24 th {
            border: 1px solid #000;
            padding: 3px 2px;
            text-align: center;
            background-color: #eee;
            font-size: 9px;
        }
        .table-rm24 td {
            border: 1px solid #000;
            padding: 4px;
            vertical-align: middle;
        }
        .checkbox-symbol {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
            font-weight: bold;
        }
        .legend-box {
            border: 1px solid #000;
            padding: 3px 5px;
            font-size: 8px;
            margin-top: 4px;
            line-height: 1.2;
        }
    </style>

    @php
        $pasien = $regPeriksa->pasien ?? null;
        $kamar = $regPeriksa->kamarInap ? $regPeriksa->kamarInap->filter(fn($k) => $k->stts_pulang != 'Pindah Kamar')->first() : null;
        $nmBangsal = $kamar && $kamar->kamar && $kamar->kamar->bangsal ? $kamar->kamar->bangsal->nm_bangsal : ($regPeriksa->poliklinik->nm_poli ?? '-');
        $totalRows = max(8, count($edukasiList));
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
        CATATAN PELAKSANAAN EDUKASI KEPADA PASIEN
    </div>

    <!-- TABEL UTAMA RM 24 -->
    <table class="table-rm24">
        <thead>
            <tr>
                <th width="4%">No</th>
                <th width="32%">Materi</th>
                <th width="11%">Tanggal &amp;<br>Durasi</th>
                <th width="12%">Metode &amp;<br>Durasi</th>
                <th width="13%">Hambatan &amp;<br>Cara Mengatasi</th>
                <th width="14%">Evaluasi</th>
                <th width="7%">Paraf<br>Pasien</th>
                <th width="7%">Paraf<br>Edukator</th>
            </tr>
        </thead>
        <tbody>
            @for ($i = 0; $i < $totalRows; $i++)
                @php
                    $edu = $edukasiList[$i] ?? null;
                @endphp
                <tr style="height: 48px;">
                    <!-- NO -->
                    <td style="text-align: center; font-weight: bold;">
                        {{ $i + 1 }}
                    </td>

                    <!-- MATERI -->
                    <td>
                        @if ($edu)
                            <strong>{{ $edu->materi }}</strong>
                        @endif
                    </td>

                    <!-- TANGGAL & DURASI -->
                    <td style="text-align: center;">
                        @if ($edu)
                            {{ date('d/m/Y', strtotime($edu->tanggal)) }}<br>
                            <span style="font-size: 8px; color: #555;">{{ date('H:i', strtotime($edu->tanggal)) }}</span>
                            @if ($edu->durasi)
                                <br><strong>{{ $edu->durasi }}</strong>
                            @endif
                        @endif
                    </td>

                    <!-- METODE -->
                    <td style="text-align: center;">
                        @if ($edu)
                            {{ $edu->metode ?? '-' }}
                        @endif
                    </td>

                    <!-- HAMBATAN & INTERVENSI -->
                    <td>
                        @if ($edu)
                            <strong>H:</strong> {{ ($edu->hambatan == 'Lain-lain' && $edu->hambatan_lain) ? $edu->hambatan_lain : ($edu->hambatan ?? 'Tidak Ada') }}<br>
                            <strong>I:</strong> {{ ($edu->intervensi == 'Lain-lain' && $edu->intervensi_lain) ? $edu->intervensi_lain : ($edu->intervensi ?? 'Tidak Ada') }}
                        @endif
                    </td>

                    <!-- EVALUASI -->
                    <td>
                        @if ($edu)
                            @php
                                $eval = $edu->evaluasi ?? '';
                                $isE1 = ($eval == 'Tidak mengerti');
                                $isE2 = ($eval == 'Mengerti, tidak mampu menjelaskan/melakukan');
                                $isE3 = ($eval == 'Mengerti, mampu menjelaskan/melakukan');
                            @endphp
                            <span class="checkbox-symbol">{!! $isE1 ? '&#9745;' : '&#9744;' !!}</span> Tidak mengerti<br>
                            <span class="checkbox-symbol">{!! $isE2 ? '&#9745;' : '&#9744;' !!}</span> Mengerti, tdk mampu<br>
                            <span class="checkbox-symbol">{!! $isE3 ? '&#9745;' : '&#9744;' !!}</span> Mengerti &amp; mampu
                        @else
                            <span class="checkbox-symbol">&#9744;</span> Tidak mengerti<br>
                            <span class="checkbox-symbol">&#9744;</span> Mengerti, tdk mampu<br>
                            <span class="checkbox-symbol">&#9744;</span> Mengerti &amp; mampu
                        @endif
                    </td>

                    <!-- PARAF PASIEN / KELUARGA -->
                    <td style="text-align: center; vertical-align: middle;">
                        @if ($edu && !empty($edu->ttd_pasien))
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

                    <!-- PARAF EDUKATOR -->
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
    <div style="border: 1px solid #000; border-top: none; padding: 4px 6px; font-size: 8.5px; display: flex; justify-content: space-between; align-items: center;">
        <div style="width: 75%; font-weight: 500;">
            <em>"Dengan ini menyatakan bahwa saya telah diberikan informasi dan edukasi serta diberi kesempatan untuk bertanya dan berdiskusi."</em>
        </div>
        <div style="width: 25%; text-align: right; font-size: 8px;">
            Paraf Pasien / Keluarga : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </div>
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
@endsection
