@extends('content.print.main')

@section('content')

    <style>
        .table-print {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .table-print td,
        .table-print th {
            border: 1px solid #000;
            padding: 6px;
            vertical-align: top;
        }

        .identitas td {
            font-size: 11px;
            border: 1px solid #000;
        }

        .adime-header {
            background: #dbeeff;
            font-size: 13px;
            font-weight: bold;
        }

        .adime-label {
            width: 18%;
            background: #f5f5f5;
            font-size: 11px;
            font-weight: bold;
        }

        .adime-content {
            font-size: 12px;
            line-height: 1.7;
            text-align: justify;
        }

        .adime-block {
            page-break-inside: avoid;
            margin-bottom: 12px;
        }

        .ttd {
            text-align: center;
            font-size: 10px;
            padding: 12px !important;
        }
    </style>

    {{-- HEADER --}}
    <div style="text-align:center">
        <h3 style="margin-bottom:0">
            RSIA AISYIYAH PEKAJANGAN
        </h3>

        <p style="font-size:11px;margin:2px">
            Jl. Raya Pekajangan No. 610, Kabupaten Pekalongan, Jawa Tengah
        </p>

        <p style="font-size:11px;margin:2px">
            Telp. (0285) 785909, Email : rba610@gmail.com
        </p>
    </div>

    <hr style="margin:5px 0">

    <img src="{{ asset('img/logo.png') }}" style="position:absolute;top:10px;left:30px" width="50" />

    {{-- IDENTITAS PASIEN --}}
    <table class="table-print identitas" style="margin-bottom:15px">

        <tr>
            <th colspan="6" style="
                        background:#e3ffa2;
                        font-size:13px;
                        text-align:center;
                    ">
                CATATAN ADIME GIZI RAWAT INAP
            </th>
        </tr>

        <tr>
            <td colspan="2">
                <strong>No. RM</strong> :
                {{ $adime->first()->pasien->no_rkm_medis }}
                <br>

                <strong>Nama</strong> :
                {{ $adime->first()->pasien->nm_pasien }}
            </td>
            <td colspan="2">
                <strong>No. Rawat</strong> :
                {{ $adime->first()->no_rawat }}
                <br>

                <strong>DPJP</strong> :
                {{ $adime->first()->regPeriksa->dokter->nm_dokter }}
            </td>

            <td colspan="2">
                <strong>Jenis Kelamin</strong> :
                {{ $adime->first()->pasien->jk == 'L' ? 'Laki-laki' : 'Perempuan' }}
                <br>

                <strong>Tanggal Lahir</strong> :
                {{ date('d-m-Y', strtotime($adime->first()->pasien->tgl_lahir)) }}
            </td>
        </tr>

    </table>

    {{-- LOOP ADIME --}}
    @foreach ($adime as $item)

        <div class="adime-block">

            <table class="table-print">

                {{-- HEADER ADIME --}}
                <tr>
                    <td colspan="2" class="adime-header">

                        CATATAN ADIME GIZI

                        <span style="float:right;font-weight:normal">
                            {{ date('d-m-Y H:i', strtotime($item->tanggal)) }}
                        </span>

                    </td>
                </tr>

                @php
                    $items = [
                        'A - Asesmen' => $item->asesmen,
                        'D - Diagnosis' => $item->diagnosis,
                        'I - Intervensi' => $item->intervensi,
                        'M - Monitoring' => $item->monitoring,
                        'E - Evaluasi' => $item->evaluasi,
                        'Instruksi' => $item->instruksi,
                    ];
                @endphp

                {{-- CONTENT --}}
                @foreach ($items as $label => $value)

                    <tr>

                        <td class="adime-label">
                            {{ $label }}
                        </td>

                        <td class="adime-content">
                            {!! nl2br(e($value)) !!}
                        </td>

                    </tr>

                @endforeach

                {{-- TTD --}}
                <tr>
                    <td colspan="2" class="ttd">

                        <div style="margin-bottom:5px">
                            Pekajangan,
                            {{ date('d-m-Y H:i', strtotime($item->tanggal)) }}
                        </div>

                        <div style="margin-bottom:10px">
                            Ahli Gizi / Petugas
                        </div>

                        <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG($item->sidik, 'QRCODE') }}" height="70"
                            width="70" />

                        <br><br>

                        <strong>
                            <u>{{ $item->petugas->nama }}</u>
                        </strong>

                        <br>

                        NIK : {{ $item->nip }}

                    </td>
                </tr>

            </table>

        </div>

    @endforeach

@endsection