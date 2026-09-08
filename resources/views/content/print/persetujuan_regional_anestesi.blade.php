@extends('content.print.main')

@section('content')
    <style>
        @page {
            margin: 15px 25px;
        }

        body {
            font-family: Arial, Helvetica, 'DejaVu Sans', sans-serif;
            font-size: 9.5px;
            line-height: 1.2;
            color: #000;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 4px;
        }

        .header-table td {
            vertical-align: top;
        }

        .patient-box {
            border: 1px solid #000;
            padding: 4px 6px;
            font-size: 9px;
            width: 80%;
        }

        .doc-title {
            text-align: center;
            font-size: 11.5px;
            font-weight: bold;
            margin: 5px 0 6px 0;
            line-height: 1.25;
        }

        .table-content {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 4px;
        }

        .table-content th,
        .table-content td {
            border: 1px solid #000;
            padding: 2.5px 4px;
            vertical-align: top;
            font-size: 9px;
        }

        .table-content th {
            background-color: #f0f0f0;
            text-align: center;
            font-weight: bold;
        }

        .section-header {
            background-color: #e5e5e5;
            font-weight: bold;
            text-align: center;
            padding: 3px;
            border: 1px solid #000;
        }

        .strikethrough {
            text-decoration: line-through;
            color: #666;
        }

        .signature-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
            text-align: center;
            font-size: 9px;
        }

        .signature-table td {
            vertical-align: top;
            padding: 2px;
        }

        .footer-note {
            width: 100%;
            margin-top: 6px;
            font-size: 8.5px;
            display: table;
        }

        .footer-left {
            display: table-cell;
            text-align: left;
            font-style: italic;
        }

        .footer-right {
            display: table-cell;
            text-align: right;
        }
    </style>

    <!-- KOP DAN KOTAK IDENTITAS PASIEN -->
    <table class="header-table">
        <tr>
            <td style="width: 60%;">
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="width: 45px; vertical-align: middle;">
                            <img src="{{ asset('img/logo.png') }}" width="60px" alt="Logo">
                        </td>
                        <td style="vertical-align: middle; padding-left: 5px;">
                            <strong style="font-size: 10.5px;">RUMAH SAKIT IBU DAN ANAK AISYIYAH</strong><br>
                            <strong style="font-size: 10.5px;">PEKAJANGAN - PEKALONGAN</strong><br>
                            <span style="font-size: 7.5px;">Jl. Raya Pekajangan No. 610 Pekajangan, Pekalongan,
                                51172</span><br>
                            <span style="font-size: 7.5px;">Telp. (0285) 785909 Email: pekajangan@rsiaaisyiyah.com Website:
                                www.rsiaaisyiyah.com</span>
                        </td>
                    </tr>
                </table>
            </td>
            <td style="width: 40%;">
                <div class="patient-box">
                    <table style="width: 100%; border-collapse: collapse; font-size: 8.5px;">
                        <tr>
                            <td style="width: 55px;">No. RM</td>
                            <td style="width: 5px;">:</td>
                            <td><strong>{{ $regPeriksa->no_rkm_medis }}</strong></td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td><strong>{{ $regPeriksa->pasien->nm_pasien }}</strong></td>
                        </tr>
                        <tr>
                            <td>Tgl. Lahir</td>
                            <td>:</td>
                            <td>{{ date('d-m-Y', strtotime($regPeriksa->pasien->tgl_lahir)) }} &nbsp;&nbsp;&nbsp;&nbsp;
                                {{ $regPeriksa->pasien->jk == 'L' ? 'L' : 'P' }}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td>{{ $regPeriksa->pasien->alamat ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>

    <div class="doc-title">
        INFORMED CONSENT TINDAKAN MEDIS<br>REGIONAL ANESTESI / RA
    </div>

    <!-- I. PEMBERIAN INFORMASI -->
    <table class="table-content" style="margin-bottom:20px">
        <tr>
            <th colspan="4" class="section-header">PEMBERIAN INFORMASI</th>
        </tr>
        <tr>
            <td style="width: 28%; font-weight: bold;">Dokter Penanggung Jawab Tindakan</td>
            <td colspan="3">{{ $anestesi->dokterAnestesi->nm_dokter ?? '-' }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Pemberi Informasi</td>
            <td colspan="3">{{ $anestesi->pemberi_informasi ?? '-' }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Penerima Informasi / Pemberi Persetujuan*</td>
            <td colspan="3">{{ $anestesi->penerima_informasi ?? '-' }}</td>
        </tr>
    </table>

    <table class="table-content">


        <tr style="background-color: #f0f0f0;">
            <th style="width: 4%;">NO</th>
            <th style="width: 22%;">JENIS INFORMASI</th>
            <th style="width: 64%;">ISI INFORMASI</th>
            <th style="width: 10%;">TANDA (V)</th>
        </tr>
        <tr>
            <td style="text-align: center;">1</td>
            <td>Diagnosis</td>
            <td>{{ $anestesi->diagnosis ?? '-' }}</td>
            <td style="text-align: center; font-size: 11px;color:green;">{!! $anestesi->check_diagnosis == '1' ? 'V' : '' !!}</td>
        </tr>
        <tr>
            <td style="text-align: center;">2</td>
            <td>Dasar Diagnosis</td>
            <td>{{ $anestesi->dasar_diagnosis ?? 'Anamnesis, pemeriksaan fisik, dan pemeriksaan penunjang' }}</td>
            <td style="text-align: center; font-size: 11px;color:green;">{!! $anestesi->check_dasar_diagnosis == '1' ? 'V' : '' !!}</td>
        </tr>
        <tr>
            <td style="text-align: center;">3</td>
            <td>Tindakan Medis</td>
            <td>{{ $anestesi->tindakan_medis ?? 'Regional anestesi (RA) / anestesi spinal' }}</td>
            <td style="text-align: center; font-size: 11px;color:green;">{!! $anestesi->check_tindakan_medis == '1' ? 'V' : '' !!}</td>
        </tr>
        <tr>
            <td style="text-align: center;">4</td>
            <td>Indikasi Tindakan</td>
            <td>{{ $anestesi->indikasi_tindakan ?? 'Pasien dengan kebutuhan anestesi regional, pasien operasi' }}</td>
            <td style="text-align: center; font-size: 11px;color:green;">{!! $anestesi->check_indikasi_tindakan == '1' ? 'V' : '' !!}</td>
        </tr>
        <tr>
            <td style="text-align: center;">5</td>
            <td>Tata Cara</td>
            <td>{{ $anestesi->tata_cara ?? 'Obat bius diberikan dengan cara disuntikkan di ruas tulang belakang' }}</td>
            <td style="text-align: center; font-size: 11px;color:green;">{!! $anestesi->check_tata_cara == '1' ? 'V' : '' !!}</td>
        </tr>
        <tr>
            <td style="text-align: center;">6</td>
            <td>Tujuan</td>
            <td>{{ $anestesi->tujuan ?? 'Menghilangkan rasa sakit, memfasilitasi jalannya operasi / tindakan' }}</td>
            <td style="text-align: center; font-size: 11px;color:green;">{!! $anestesi->check_tujuan == '1' ? 'V' : '' !!}</td>
        </tr>
        <tr>
            <td style="text-align: center;">7</td>
            <td>Risiko Tindakan</td>
            <td>{{ $anestesi->risiko ?? 'Nyeri saat penyuntikan' }}</td>
            <td style="text-align: center; font-size: 11px;color:green;">{!! $anestesi->check_risiko == '1' ? 'V' : '' !!}</td>
        </tr>
        <tr>
            <td style="text-align: center;">8</td>
            <td>Komplikasi</td>
            <td>{!! nl2br(
                e(
                    $anestesi->komplikasi ??
                        "1. Mual, muntah, pusing, mengantuk, sulit bernafas, hipotensi, henti jantung, syok anafilaktik\n2. Alergi / hipersensitif terhadap obat",
                ),
            ) !!}</td>
            <td style="text-align: center; font-size: 11px;color:green;">{!! $anestesi->check_komplikasi == '1' ? 'V' : '' !!}</td>
        </tr>
        <tr>
            <td style="text-align: center;">9</td>
            <td>Prognosis Tindakan</td>
            <td>{{ $anestesi->prognosis ?? 'Dubia' }}</td>
            <!-- Mengganti 'v' dengan kode HTML centang standar -->
            <td style="text-align: center; font-size: 11px;color:green;">{!! $anestesi->check_prognosis == '1' ? 'V' : '' !!}</td>
        </tr>
        <tr>
            <td style="text-align: center;">10</td>
            <td>Alternatif dan Risiko</td>
            <td>{{ $anestesi->alternatif_dan_risiko ?? 'Tidak ada' }}</td>
            <td style="text-align: center; font-size: 11px;color:green;">{!! $anestesi->check_alternatif == '1' ? 'V' : '' !!}</td>
        </tr>
        <tr>
            <td colspan="3" style="font-size: 9px;">
                Dengan ini menyatakan bahwa saya telah menerangkan hal-hal diatas secara benar dan jujur dan memberikan
                kesempatan untuk bertanya dan atau berdiskusi.
            </td>
            <td style="text-align: center; font-size: 8px; vertical-align: middle;">
                @php
                    $pemberiNama =
                        $anestesi->pemberi_informasi ?: $anestesi->dokterAnestesi->nm_dokter ?? 'Petugas / Dokter';
                    $qrPemberi =
                        'Diverifikasi secara elektronik oleh: ' .
                        $pemberiNama .
                        ' pada ' .
                        date('d-m-Y H:i', strtotime($anestesi->tanggal . ' ' . $anestesi->jam));
                @endphp
                <img src="data:image/png;base64,{!! DNS2D::getBarcodePNG($qrPemberi, 'QRCODE', 1.8, 1.8) !!}" height="30" /><br>
                <strong style="font-size: 8px;">( {{ $pemberiNama }} )</strong><br>
                <span style="font-size: 7.5px; color: #555;">Pemberi Informasi</span>
            </td>
        </tr>
        <tr>
            <td colspan="3" style="font-size: 9px;">
                Dengan ini menyatakan bahwa saya telah menerima informasi sebagaimana diatas yang saya beri tanda / paraf
                dikolom kanannya, dan telah memahami.
            </td>
            <td style="text-align: center; font-size: 8px; vertical-align: middle;">
                @if (!empty($anestesi->tanda_tangan_pj))
                    @if (str_starts_with($anestesi->tanda_tangan_pj, 'data:image'))
                        <img src="{{ $anestesi->tanda_tangan_pj }}" style="max-height: 28px; max-width: 80px;"
                            alt="TTD"><br>
                    @elseif(\Illuminate\Support\Facades\Storage::disk('public')->exists($anestesi->tanda_tangan_pj))
                        <img src="{{ asset('storage/' . $anestesi->tanda_tangan_pj) }}"
                            style="max-height: 28px; max-width: 80px;" alt="TTD"><br>
                    @else
                        <br><br>
                    @endif
                @else
                    <br><br>
                @endif
                <strong style="font-size: 8px;">( {{ $anestesi->penerima_informasi ?: $anestesi->nama_pj }} )</strong><br>
                <span style="font-size: 7.5px; color: #555;">Penerima Informasi</span>
            </td>
        </tr>
    </table>

    <div style="font-size: 7.5px; margin-bottom: 4px; font-style: italic;">
        * Bila pasien tidak kompeten atau tidak mau menerima informasi, maka penerima informasi adalah wali atau keluarga
        terdekat.
    </div>

    <!-- II. PERSETUJUAN / PENOLAKAN TINDAKAN MEDIS -->
    <div style="border: 1px solid #000; padding: 10px 12px;">
        <div style="text-align: center; font-weight: bold; font-size: 9.5px; margin-bottom: 4px;">
            PERSETUJUAN TINDAKAN MEDIS
        </div>

        <div>Yang bertanda tangan di bawah ini, saya :</div>
        <table
            style="width: 100%; border-collapse: collapse; margin-left: 8px; margin-top: 2px; margin-bottom: 3px; font-size: 9px;">
            <tr>
                <td style="width: 110px;">Nama</td>
                <td style="width: 5px;">:</td>
                <td><strong>{{ $anestesi->nama_pj }}</strong></td>
            </tr>
            <tr>
                <td style="">Hubungan Dengan Pasien</td>
                <td style="width: 5px;">:</td>
                <td><strong>{{ $anestesi->hubungan ?? '-' }}</strong></td>
            </tr>
            <tr>
                <td>Tanggal lahir</td>
                <td>:</td>
                <td>{{ $anestesi->tgl_lahir_pj ? date('d-m-Y', strtotime($anestesi->tgl_lahir_pj)) : '-' }}
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    Umur : {{ $anestesi->umur_pj ?? '-' }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td>{{ $anestesi->alamat_pj ?? '-' }}</td>
            </tr>

        </table>

        <div>dengan ini menyatakan dengan sesungguhnya :</div>
        <div style="text-align: center; font-size: 11px;color:green; font-weight: bold; margin: 3px 0;">
            @if ($anestesi->jenis_pernyataan == 'SETUJU')
                <u>SETUJU</u> &nbsp;&nbsp;&nbsp;&nbsp; / &nbsp;&nbsp;&nbsp;&nbsp; <span class="strikethrough">MENOLAK</span>
            @else
                <span class="strikethrough">SETUJU</span> &nbsp;&nbsp;&nbsp;&nbsp; / &nbsp;&nbsp;&nbsp;&nbsp; <u>MENOLAK</u>
            @endif
        </div>

        <div>
            untuk dilakukan tindakan medis berupa : <strong>REGIONAL ANESTESI</strong> &nbsp;&nbsp; terhadap :
        </div>

        <table
            style="width: 100%; border-collapse: collapse; margin-left: 8px; margin-top: 2px; margin-bottom: 3px; font-size: 9px;">
            <tr>
                <td>Nomor Rawat</td>
                <td>:</td>
                <td><strong>{{ $regPeriksa->no_rawat }}</strong></td>
            </tr>
            <tr>
                <td>Nomor Rekam Medis</td>
                <td>:</td>
                <td><strong>{{ $regPeriksa->no_rkm_medis }}</strong></td>
            </tr>
            <tr>
                <td style="width: 110px;">Nama</td>
                <td style="width: 5px;">:</td>
                <td><strong>{{ $regPeriksa->pasien->nm_pasien }}</strong></td>
            </tr>
            <tr>
                <td>Tanggal lahir</td>
                <td>:</td>
                <td>{{ date('d-m-Y', strtotime($regPeriksa->pasien->tgl_lahir)) }}
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    Umur : {{ $regPeriksa->umurdaftar }} {{ $regPeriksa->sttsumur }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td>{{ $regPeriksa->pasien->alamat ?? '-' }}</td>
            </tr>

        </table>

        <div style="text-align: justify; font-size: 9px; margin-top: 3px; line-height: 1.2; padding:2px">
            Saya memahami perlunya dan manfaat tindakan tersebut sebagaimana telah dijelaskan kepada saya, termasuk resiko
            dan komplikasi yang mungkin timbul. Saya juga menyadari bahwa oleh karena ilmu kedokteran bukanlah ilmu pasti,
            maka keberhasilan tindakan kedokteran bukanlah keniscayaan, melainkan sangat bergantung pada izin Tuhan Yang
            Maha Esa.
        </div>

        <!-- TANDA TANGAN -->
        <div style="margin-top: 6px; margin-bottom: 2px; font-size: 9px;">
            Pekalongan, {{ date('d-m-Y', strtotime($anestesi->tanggal)) }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Jam :
            {{ date('H:i', strtotime($anestesi->jam)) }}
        </div>

        <table class="signature-table">
            <tr>
                <td style="width: 50%;">
                    Yang membuat pernyataan,<br>
                    @if (!empty($anestesi->tanda_tangan_pj))
                        @if (str_starts_with($anestesi->tanda_tangan_pj, 'data:image'))
                            <img src="{{ $anestesi->tanda_tangan_pj }}"
                                style="max-height: 45px; max-width: 120px;padding:10px" alt="TTD"><br>
                        @elseif(\Illuminate\Support\Facades\Storage::disk('public')->exists($anestesi->tanda_tangan_pj))
                            <img src="{{ asset('storage/' . $anestesi->tanda_tangan_pj) }}"
                                style="max-height: 45px; max-width: 120px;padding:10px" alt="TTD"><br>
                        @else
                            <br><br><br>
                        @endif
                    @else
                        <br><br><br>
                    @endif
                    <strong>( {{ $anestesi->nama_pj }} )</strong>
                </td>

                <td style="width: 50%;">
                    Dokter / Petugas,<br>
                    @php
                        $drNama =
                            $anestesi->dokterAnestesi->nm_dokter ??
                            ($anestesi->pemberi_informasi ?? 'Dokter Penanggung Jawab');
                        $qrDokter =
                            'Diverifikasi secara elektronik oleh: ' .
                            $drNama .
                            ' pada ' .
                            date('d-m-Y H:i', strtotime($anestesi->tanggal . ' ' . $anestesi->jam));
                    @endphp
                    <img src="data:image/png;base64,{!! DNS2D::getBarcodePNG($qrDokter, 'QRCODE', 2.2, 2.2) !!}" style="padding:10px" height="42" /><br>
                    <strong>( {{ $drNama }} )</strong>
                </td>

            </tr>
            <tr>
                <td colspan="2"> Saksi-saksi :</td>
            </tr>
            <tr>
                <td style="width: 50%;">
                    <span style="">Saksi 1 (Dari Keluarga)</span>,<br>
                    <img src="{{ asset('storage/' . $anestesi->tanda_tangan_saksi_keluarga) }}"
                        style="max-height: 45px; max-width: 120px;padding:10px" alt="Tanda Tangan Saksi Keluarga"><br>
                    (<strong>{{ $anestesi->saksi_keluarga ?? 'Keluarga' }}</strong>)<br>

                </td>
                <td style="width: 50%;">
                    <span style="">Saksi 2 (Dari Petugas RS)</span>,<br>
                    @php
                        $drNamaPetugas = $anestesi->petugas->nama;
                        $qrDokter =
                            'Ditandatangani secara elektronik oleh: ' .
                            $drNamaPetugas .
                            ' pada ' .
                            date('d-m-Y H:i', strtotime($anestesi->tanggal . ' ' . $anestesi->jam));
                    @endphp
                    <img src="data:image/png;base64,{!! DNS2D::getBarcodePNG($qrDokter, 'QRCODE', 2.2, 2.2) !!}" style="padding: 10px" height="42" /><br>
                    (<strong>{{ $anestesi->saksi_tenaga_medis ?? 'Petugas' }}</strong>)
                <td>
            </tr>
        </table>
    </div>
@endsection
