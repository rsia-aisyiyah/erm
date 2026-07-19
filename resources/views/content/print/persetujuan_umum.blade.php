@extends('content.print.main')

@section('content')

                                    <style>
                                        body {
                                            font-family: Arial, sans-serif;
                                            font-size: 10px;
                                            line-height: 1.5;
                                            color: #000;
                                        }

                                        .container {
                                            padding: 0 25px;
                                        }

                                        .header {
                                            width: 100%;
                                            border-collapse: collapse;
                                            margin-bottom: 10px;
                                        }

                                        .header td {
                                            vertical-align: middle;
                                        }

                                        .header-title {
                                            text-align: center;
                                        }

                                        .header-title h2 {
                                            margin: 0;
                                            font-size: 18px;
                                        }

                                        .header-title p {
                                            margin: 2px 0;
                                            font-size: 11px;
                                        }

                                        .title {
                                            text-align: center;
                                            font-size: 14px;
                                            font-weight: bold;
                                            margin: 15px 0;
                                        }

                                        .identity {
                                            width: 100%;
                                            border-collapse: collapse;

                                        }

                                        .identity-box {
                                            border: 1px solid #000;
                                            padding: 10px;
                                            margin-bottom: 15px;
                                        }

                                        .identity td {
                                            padding: 2px;
                                            vertical-align: top;
                                        }

                                        .content-box {
                                            border: 1px solid #000;
                                            padding: 10px;
                                            text-align: justify;
                                        }

                                        .content-box ol {
                                            margin: 0;
                                            padding-left: 18px;
                                            line-height: 1.5;
                                        }

                                        .content-box li {
                                            margin-bottom: 8px;
                                        }

                                        .signature-table {
                                            width: 100%;
                                            border-collapse: collapse;
                                            margin-top: 25px;
                                        }

                                        .signature-table td {
                                            width: 50%;
                                            text-align: center;
                                            vertical-align: top;
                                            padding: 5px;
                                        }

                                        .signature {
                                            width: 150px;
                                            height: auto;
                                        }

                                        .line {
                                            width: 180px;
                                            border-top: 1px solid #000;
                                            margin: 8px auto 0;
                                        }

                                        .footer {
                                            position: fixed;
                                            left: 0;
                                            right: 0;
                                            bottom: 10mm;
                                            /* sesuaikan dengan margin bawah */
                                            height: 25mm;
                                            border-top: 1px solid #000;
                                            font-size: 9px;
                                        }
                                    </style>

                                    <div class="container">

                                        {{-- HEADER --}}
                                        <table class="header">

                                            <tr>

                                                <td width="10%">
                                                    <img src="{{ public_path('img/logo.png') }}" width="60">
                                                </td>

                                                <td width="90%" class="header-title">

                                                    <h2>RSIA AISYIYAH PEKAJANGAN</h2>

                                                    <p>
                                                        Jl. Raya Pekajangan No.610 Kabupaten Pekalongan Jawa Tengah
                                                    </p>

                                                    <p>
                                                        Telp. (0285) 785909 • Email : rba610@gmail.com
                                                    </p>

                                                </td>

                                            </tr>

                                        </table>

                                        <hr>

                                        <div class="title">
                                            PERSETUJUAN UMUM (GENERAL CONSENT)
                                        </div>

                                        <div class="identity-box">
                                            {{-- IDENTITAS --}}
                                            <table class="identity">

                                                <tr>

                                                    <td width="18%"><strong>No. RM</strong></td>

                                                    <td width="42%">: {{ $reg->no_rkm_medis }}</td>

                                                    <td width="15%"><strong>No. Rawat</strong></td>

                                                    <td width="35%">: {{ $reg->no_rawat }}</td>

                                                </tr>

                                                <tr>

                                                    <td><strong>Nama Pasien</strong></td>

                                                    <td>: {{ $reg->nm_pasien }}</td>

                                                    <td><strong>Tgl. Lahir</strong></td>

                                                    <td>:
                                                        @php
    $lahir = \Carbon\Carbon::parse($reg->tgl_lahir);
    $registrasi = \Carbon\Carbon::parse($reg->tgl_registrasi);
    $selisih = $lahir->diff($registrasi);
                                                        @endphp

                                                        {{ $lahir->translatedFormat('d F Y') }} / {{ $selisih->y }} Th {{ $selisih->m }} Bln
                                                        {{ $selisih->d }} H
                                                    </td>

                                                </tr>

                                                <tr>

                                                    <td><strong>Jenis Kelamin</strong></td>

                                                    <td>: {{ $reg->jk }}</td>

                                                    <td><strong>Alamat</strong></td>

                                                    <td>: {{ $reg->alamat }}</td>

                                                </tr>

                                                <tr>

                                                    <td><strong>Dokter DPJP</strong></td>

                                                    <td>: {{ $reg->nm_dokter }}</td>

                                                    <td><strong>Asal Masuk</strong></td>

                                                    <td>: {{ $reg->nm_poli }}</td>

                                                </tr>

                                            </table>
                                        </div>

                                        {{-- ISI --}}
                                        <div class="content-box">

                                            <ol>

                                                <li>
                                                    <strong>SAYA MENGETAHUI DAN MENYETUJUI</strong>
                                                    berdasarkan Peraturan Menteri Kesehatan Nomor 24 Tahun 2022 tentang Rekam Medis,
                                                    fasilitas kesehatan wajib membuka akses dan mengirim data rekam medis kepada
                                                    Kementerian Kesehatan melalui platform <strong>SATUSEHAT</strong>.
                                                </li>

                                                <li>
                                                    <strong>MENYETUJUI UNTUK MENERIMA DAN MEMBUKA</strong>
                                                    data pasien dari fasilitas pelayanan kesehatan lainnya melalui
                                                    <strong>SATUSEHAT</strong>.
                                                </li>

                                                <li>
                                                    <strong>HAK PASIEN DAN KELUARGA.</strong>
                                                    Saya telah mendapatkan informasi mengenai hak dan kewajiban pasien.
                                                </li>

                                                <li>
                                                    <strong>PERSETUJUAN PELAYANAN KESEHATAN.</strong>
                                                    Saya memberikan persetujuan kepada RSIA Aisyiyah Pekajangan beserta dokter, perawat dan
                                                    tenaga kesehatan lainnya untuk memberikan pelayanan berupa pemeriksaan umum, laboratorium, radiologi,
                                                    terapi, tindakan
                                                    medis maupun pelayanan lain sesuai indikasimedis.
                                                </li>

                                                <li>
                                                    <strong>PELAYANAN KEROHANIAN.</strong>
                                                    Saya memahami rumah sakit menyediakan pelayanan kerohanian sesuai agama
                                                    dan kepercayaan pasien.
                                                </li>

                                                <li>
                                                    <strong>PRIVASI.</strong>
                                                    Saya memberikan kuasa kepada rumah sakit untuk menjaga kerahasiaan
                                                    data kesehatan saya.
                                                </li>

                                                <li>
                                                    <strong>RAHASIA KEDOKTERAN.</strong>
                                                    Rumah sakit menjamin kerahasiaan data medis saya sesuai ketentuan yang berlaku.
                                                </li>

                                                <li>

                                                    <strong>MEMBUKA RAHASIA KEDOKTERAN.</strong>

                                                    Saya memberikan izin kepada rumah sakit untuk memberikan informasi medis saya kepada:

                                                    <ul>

                                                        <li>Dokter dan tenaga kesehatan yang merawat saya.</li>

                                                        <li>BPJS Kesehatan, perusahaan asuransi, atau penjamin pembiayaan.</li>

                                                    </ul>

                                                </li>

                                                <li>
                                                    <strong>BARANG PRIBADI.</strong>
                                                    Saya setuju untuk tidak membawa barang-barang berharga yang tidak diperlukan (perhiasan,
                                                    elektronik,
                                                    dll) selama masa perawatan. Saya memahami rumah sakit tidak bertanggung jawab atas kehilangan, kerusakan
                                                    atau pencurian
                                                    barang berharga milik saya.
                                                </li>

                                                <li>
                                                    <strong>FASILITAS RUMAH SAKIT.</strong>
                                                    Saya bertanggung jawab atas kerusakan fasilitas rumah sakit yang saya sebabkan termasuk fasilitas umum
                                                    dan
                                                    fasilitas/alat medis.
                                                </li>

                                                <li>
                                                    <strong>HASIL PELAYANAN.</strong>
                                                    Saya memahami tidak ada jaminan mutlak terhadap hasil pelayanan medis.
                                                </li>

                                                <li>
                                                    <strong>PENGAJUAN KELUHAN.</strong>
                                                    Saya telah menerima informasi mengenai mekanisme penyampaian keluhan.
                                                </li>

                                                <li>
                                                    <strong>TANGGUNG JAWAB PEMBAYARAN.</strong>
                                                    Saya menyetujui seluruh biaya pelayanan kesehatan sesuai ketentuan rumah sakit.
                                                </li>

                                            </ol>
                                            <strong>SAYA TELAH MEMBACA DAN SEPENUHNYA SETUJU</strong> dengan setiap pernyataan diatas dan menandatanganinya tanpa paksaan dan
                                            dengan
                                            kesadaran penuh.

                                        </div>

                                        {{-- TANDA TANGAN --}}
                                        <table class="signature-table">

                                            <tr>

                                                <td>

                                                    Petugas
                                                    @php
    $qr = implode("\n", [
        'DIBUAT DAN TANDA TANGANI OLEH PETUGAS : ' . $petugas->nama,
        'NIK : ' . $petugas->nik,
        'PADA WAKTU : ' . now()
    ]);
                                                    @endphp

                                                    <br>
                                                    <br>
                                                    <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG($qr, 'QRCODE') }}" height="80" width="80" />
                                                    <br>
                                                    <br>
                                                    <strong>{{ $petugas->nama }}</strong>
                                                    <br>
                                                    NIP : {{ $petugas->nik }}

                                                </td>

                                                <td>

                                                    Pekajangan,
                                                    {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}

                                                    <br>

                                                    Penanggung Jawab Pasien / Keluarga

                                                    <br>

                                                    @if(!empty($signature))

                                                        <div style="text-align:center;">
                                                            <img class="signature" src="{{ $signature }}" height="80">

                                                            <div style="
                                                                margin-top:4px;
                                                                padding:3px;
                                                                border:1px dashed #aaa;
                                                                font-size:7px;
                                                                color:#aaa;
                                                            ">
                                                                Dokumen ini telah ditandatangani secara elektronik.<br>
                                                                Timestamp: {{ now()->format('Y-m-d H:i:s') }} WIB
                                                            </div>
                                                        </div>

                                                    @else

                                                        <br><br>

                                                    @endif

                                                    <strong>{{ $reg->p_jawab }}</strong>

                                                </td>

                                            </tr>

                                        </table>

                                    </div>
                                    <div class="footer">
                                        <table width="100%" style="font-size:10px">

                                            <tr>

                                                <td width="80%" valign="middle">

                                                    <strong>Dokumen Elektronik</strong><br>

                                                    Dokumen ini dibuat oleh Sistem Informasi Manajemen Rumah Sakit
                                                    RSIA Aisyiyah Pekajangan.

                                                    <br>

                                                    Untuk memastikan keaslian dokumen, silakan scan QR Code
                                                    di samping atau kunjungi:

                                                    <br>
                                                </td>

                                                <td width="20%" align="right">
                                                    <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG($verifyUrl, 'QRCODE') }}" width="60"
                                                        height="60">
                                                    <br>
                                                    <span style="font-size:9px">
                                                        Scan Verifikasi
                                                    </span>
                                                </td>

                                            </tr>

                                        </table>
                                    </div>

@endsection