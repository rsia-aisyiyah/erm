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
            padding: 2px 4px;
            font-size: 9px;
            vertical-align: top;
        }
        .table-transfer {
            width: 100%;
            border-collapse: collapse;
            font-size: 8.5px;
            margin-bottom: 6px;
        }
        .table-transfer th {
            border: 1px solid #000;
            padding: 3px 4px;
            background-color: #f0f0f0;
            font-size: 8.5px;
            text-align: left;
        }
        .table-transfer td {
            border: 1px solid #000;
            padding: 3px 4px;
            vertical-align: top;
        }
        .section-title {
            font-weight: bold;
            font-size: 9.5px;
            margin-top: 5px;
            margin-bottom: 3px;
            border-bottom: 1px solid #000;
            padding-bottom: 1px;
            color: #111;
        }
    </style>

    @php
        $pasien = $regPeriksa->pasien ?? null;
        $t = $transfer ?? null;
        $tglMasuk = $t && $t->tanggal_masuk ? date('d-m-Y H:i:s', strtotime($t->tanggal_masuk)) : '-';
        $tglPindah = $t && $t->tanggal_pindah ? date('d-m-Y H:i:s', strtotime($t->tanggal_pindah)) : '-';
        
        $petugasSerahNama = ($t && $t->pegawaiMenyerahkan) ? $t->pegawaiMenyerahkan->nama : (($t && $t->petugasMenyerahkan) ? $t->petugasMenyerahkan->nama : ($t->nip_menyerahkan ?? '-'));
        $petugasTerimaNama = ($t && $t->pegawaiMenerima) ? $t->pegawaiMenerima->nama : (($t && $t->petugasMenerima) ? $t->petugasMenerima->nama : ($t->nip_menerima ?? '-'));
    @endphp

    <!-- HEADER KOP & IDENTITAS PASIEN -->
    <table width="100%" class="table-borderless" style="border-bottom: 2px solid #000; padding-bottom: 3px;">
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
                        <td width="35%" style="border: 1px solid #000; padding: 1.5px 3px;"><strong>No. RM</strong></td>
                        <td style="border: 1px solid #000; padding: 1.5px 3px;">: {{ $pasien->no_rkm_medis ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #000; padding: 1.5px 3px;"><strong>Nama Pasien</strong></td>
                        <td style="border: 1px solid #000; padding: 1.5px 3px;">: {{ $pasien->nm_pasien ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #000; padding: 1.5px 3px;"><strong>Tgl. Lahir / JK</strong></td>
                        <td style="border: 1px solid #000; padding: 1.5px 3px;">: {{ $pasien && $pasien->tgl_lahir ? date('d-m-Y', strtotime($pasien->tgl_lahir)) : '-' }} / {{ ($pasien->jk ?? '') == 'L' ? 'Laki-Laki' : 'Perempuan' }}</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #000; padding: 1.5px 3px;"><strong>No. Rawat</strong></td>
                        <td style="border: 1px solid #000; padding: 1.5px 3px;">: {{ $regPeriksa->no_rawat ?? '-' }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <div class="box-title">
        TRANSFER PASIEN ANTAR RUANG
    </div>

    <!-- 1. INFORMASI WAKTU & RUANGAN -->
    <div class="section-title">A. INFORMASI PEMINDAHAN RUANG</div>
    <table class="table-transfer">
        <tr>
            <td width="25%"><strong>Tanggal Masuk Ruang Asal</strong></td>
            <td width="25%">: {{ $tglMasuk }}</td>
            <td width="25%"><strong>Tanggal / Jam Pindah</strong></td>
            <td width="25%">: {{ $tglPindah }}</td>
        </tr>
        <tr>
            <td><strong>Asal Ruang Rawat / Poli</strong></td>
            <td>: {{ $t->asal_ruang ?? '-' }}</td>
            <td><strong>Ruang Rawat Selanjutnya</strong></td>
            <td>: {{ $t->ruang_selanjutnya ?? '-' }}</td>
        </tr>
        <tr>
            <td><strong>Metode Pemindahan</strong></td>
            <td>: {{ $t->metode_pemindahan_pasien ?? '-' }}</td>
            <td><strong>Indikasi Pindah Ruang</strong></td>
            <td>: {{ $t->indikasi_pindah_ruang ?? '-' }} {{ !empty($t->keterangan_indikasi_pindah_ruang) ? '('.$t->keterangan_indikasi_pindah_ruang.')' : '' }}</td>
        </tr>
    </table>

    <!-- 2. KONDISI KLINIS & TERAPI -->
    <div class="section-title">B. KONDISI KLINIS &amp; RIWAYAT TINDAKAN</div>
    <table class="table-transfer">
        <tr>
            <td width="25%"><strong>Diagnosa Utama</strong></td>
            <td colspan="3">: {{ $t->diagnosa_utama ?? '-' }}</td>
        </tr>
        <tr>
            <td><strong>Diagnosa Sekunder</strong></td>
            <td colspan="3">: {{ $t->diagnosa_sekunder ?? '-' }}</td>
        </tr>
        <tr>
            <td><strong>Prosedur yang Sudah Dilakukan</strong></td>
            <td colspan="3">: {!! nl2br(e($t->prosedur_yang_sudah_dilakukan ?? '-')) !!}</td>
        </tr>
        <tr>
            <td><strong>Obat yang Telah Diberikan</strong></td>
            <td colspan="3">: {!! nl2br(e($t->obat_yang_telah_diberikan ?? '-')) !!}</td>
        </tr>
        <tr>
            <td><strong>Pemeriksaan Penunjang</strong></td>
            <td colspan="3">: {!! nl2br(e($t->pemeriksaan_penunjang_yang_dilakukan ?? '-')) !!}</td>
        </tr>
        <tr>
            <td><strong>Peralatan yang Menyertai</strong></td>
            <td colspan="3">: {{ $t->peralatan_yang_menyertai ?? '-' }} {{ !empty($t->keterangan_peralatan_yang_menyertai) ? '('.$t->keterangan_peralatan_yang_menyertai.')' : '' }}</td>
        </tr>
    </table>

    <!-- 3. PERSETUJUAN PASIEN / KELUARGA -->
    <div class="section-title">C. PERSETUJUAN PEMINDAHAN PASIEN / KELUARGA</div>
    <table class="table-transfer">
        <tr>
            <td width="25%"><strong>Menyetujui Pemindahan</strong></td>
            <td width="25%">: {{ $t->pasien_keluarga_menyetujui ?? '-' }}</td>
            <td width="25%"><strong>Nama Penanggung Jawab</strong></td>
            <td width="25%">: {{ $t->nama_menyetujui ?? '-' }}</td>
        </tr>
        <tr>
            <td><strong>Hubungan dengan Pasien</strong></td>
            <td colspan="3">: {{ $t->hubungan_menyetujui ?? '-' }}</td>
        </tr>
    </table>

    <!-- 4. KEADAAN PASIEN SEBELUM & SESUDAH TRANSFER -->
    <div class="section-title">D. KEADAAN PASIEN DAN TANDA VITAL (SEBELUM &amp; SESUDAH TRANSFER)</div>
    <table class="table-transfer">
        <thead>
            <tr style="background-color: #f0f0f0; text-align: center;">
                <th width="30%" style="text-align: center;">Parameter Evaluasi</th>
                <th width="35%" style="text-align: center;">Sebelum Transfer</th>
                <th width="35%" style="text-align: center;">Sesudah Transfer</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>Keluhan Utama</strong></td>
                <td>{{ $t->keluhan_utama_sebelum_transfer ?? '-' }}</td>
                <td>{{ $t->keluhan_utama_sesudah_transfer ?? '-' }}</td>
            </tr>
            <tr>
                <td><strong>Keadaan Umum (Kesadaran)</strong></td>
                <td>{{ $t->keadaan_umum_sebelum_transfer ?? '-' }}</td>
                <td>{{ $t->keadaan_umum_sesudah_transfer ?? '-' }}</td>
            </tr>
            <tr>
                <td><strong>Tekanan Darah (TD)</strong></td>
                <td>{{ $t->td_sebelum_transfer ?? '-' }} mmHg</td>
                <td>{{ $t->td_sesudah_transfer ?? '-' }} mmHg</td>
            </tr>
            <tr>
                <td><strong>Nadi</strong></td>
                <td>{{ $t->nadi_sebelum_transfer ?? '-' }} x/menit</td>
                <td>{{ $t->nadi_sesudah_transfer ?? '-' }} x/menit</td>
            </tr>
            <tr>
                <td><strong>Respirasi (RR)</strong></td>
                <td>{{ $t->rr_sebelum_transfer ?? '-' }} x/menit</td>
                <td>{{ $t->rr_sesudah_transfer ?? '-' }} x/menit</td>
            </tr>
            <tr>
                <td><strong>Suhu Tubuh</strong></td>
                <td>{{ $t->suhu_sebelum_transfer ?? '-' }} &deg;C</td>
                <td>{{ $t->suhu_sesudah_transfer ?? '-' }} &deg;C</td>
            </tr>
        </tbody>
    </table>

    <!-- 5. TANDA TANGAN & SERAH TERIMA -->
    <table width="100%" class="table-borderless" style="margin-top: 15px;">
        <tr>
            <td width="33%" style="text-align: center;">
                Pasien / Keluarga Yang Menyetujui,<br><br>
                @if($t && $t->bukti && !empty($t->bukti->photo))
                    @php
                        $ttdSrc = $t->bukti->photo;
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
                    <img src="{{ $ttdSrc }}" style="max-height: 50px; max-width: 120px;" /><br>
                @else
                    <br><br><br>
                @endif
                <strong>( {{ $t->nama_menyetujui ?: ($pasien->nm_pasien ?? '..................................') }} )</strong>
            </td>
            <td width="33%" style="text-align: center;">
                Petugas Yang Menyerahkan,<br><br><br><br><br>
                <strong>( {{ $petugasSerahNama }} )</strong><br>
                <span style="font-size: 8px;">NIP. {{ $t->nip_menyerahkan ?? '-' }}</span>
            </td>
            <td width="34%" style="text-align: center;">
                Petugas Yang Menerima,<br><br><br><br><br>
                <strong>( {{ $petugasTerimaNama }} )</strong><br>
                <span style="font-size: 8px;">NIP. {{ $t->nip_menerima ?? '-' }}</span>
            </td>
        </tr>
    </table>
@endsection
