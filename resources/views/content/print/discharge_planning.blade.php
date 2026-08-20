@extends('content.print.main')

@section('content')
    <style>
        table {
            border-collapse: collapse;
            font-size: 10px;
        }

        td,
        th {
            border: 1px solid #000;
            padding: 5px;
            vertical-align: top;

        }

        .title {
            text-align: center;
            margin-bottom: 10px;
            margin-top: 10px;
        }

        .header {
            background: #d9ead3;
            font-weight: bold;
            text-align: center;
        }

        .label {
            width: 28%;
            font-weight: bold;
            background: #f7f7f7;
        }
    </style>

    <img src="{{ public_path('img/logo.png') }}"
        style="position:absolute;left:25px;top:8px;width:60px;">

    <div class="title">
        <h2 style="margin:0">RSIA AISYIYAH PEKAJANGAN</h2>
        <div><i>DISCHARGE PLANNING</i></div>
        <p>
            Jl. Raya Pekajangan No.610 Kabupaten Pekalongan Jawa Tengah
        </p>

        <p>
            Telp. (0285) 785909 • Email : rba610@gmail.com
        </p>

    </div>

    <hr>
    <table width="100%" style="margin-bottom: 10px">
        <tr>
            <td class="label" style="width: 15%">No. Rawat</td>
            <td>{{ $data->no_rawat }}</td>

            <td class="label">Tanggal</td>
            <td>{{ date('d/m/Y H:i', strtotime($data->tanggal)) }}</td>
        </tr>

        <tr>
            <td class="label">No. RM</td>
            <td>{{ $data->pasien->no_rkm_medis }}</td>

            <td class="label">Nama Pasien</td>
            <td>{{ $data->pasien->nm_pasien }}</td>
        </tr>

        <tr>
            <td class="label">Jenis Kelamin</td>
            <td>{{ $data->pasien->jk }}</td>

            <td class="label">Tanggal Lahir</td>
            <td>{{ date('d/m/Y', strtotime($data->pasien->tgl_lahir)) }}</td>
        </tr>

        <tr>
            <td class="label">Dokter DPJP</td>
            <td colspan="3">
                {{ optional($data->regPeriksa)->dokter->nm_dokter ?? '-' }}
            </td>
        </tr>

    </table>

    <table width="100%">

        <tr>
            <th colspan="4" class="header">
                INFORMASI PULANG
            </th>
        </tr>

        <tr>
            <td class="label">Rencana Rawat</td>
            <td>{{ $data->rencana_rawat }} Jam</td>

            <td class="label">Tanggal Rencana Pulang</td>
            <td>{{ date('d/m/Y H:i', strtotime($data->tgl_rencana_pulang)) }}</td>
        </tr>

        <tr>
            <td class="label">Diagnosis Keluar</td>
            <td colspan="3">
                {{ $data->diagnosa_keluar }}
            </td>
        </tr>

        <tr>
            <td class="label">Kondisi Pulang</td>
            <td>{{ $data->kondisi_pulang }}</td>

            <td class="label">Mobilisasi</td>
            <td>{{ $data->mobilisasi }}</td>
        </tr>

        <tr>
            <td class="label">Alat Terpasang</td>
            <td colspan="3">
                {{ $data->alat_terpasang }}
            </td>
        </tr>

        <tr>
            <th colspan="4" class="header">
                EDUKASI PASIEN
            </th>
        </tr>

        <tr>
            <td class="label">Penyuluhan</td>
            <td colspan="3">
                {{ $data->penyuluhan }}

                @if ($data->penyuluhan_lain != '-')
                    <br>
                    {{ $data->penyuluhan_lain }}
                @endif
            </td>
        </tr>

        @if (!empty($data->target_asuhan))
        <tr>
            <td class="label">Target Asuhan yang Terukur</td>
            <td colspan="3">
                {!! nl2br(e($data->target_asuhan)) !!}
            </td>
        </tr>
        @endif

        <tr>
            <td class="label">Diet di Rumah</td>
            <td colspan="3">
                {!! nl2br(e($data->diet_dirumah)) !!}
            </td>
        </tr>

        <tr>
            <td class="label">Instruksi</td>
            <td colspan="3">
                {!! nl2br(e($data->instruksi)) !!}
            </td>
        </tr>

        <tr>
            <th colspan="4" class="header">
                DOKUMEN PENUNJANG
            </th>
        </tr>

        <tr>
            <td colspan="4">

                @php
                    $dokumen = collect(explode(';', $data->dokumen_penunjang))
                        ->filter()
                        ->values();
                @endphp

                <table width="100%">
                    @foreach ($dokumen as $item)
                        <tr>
                            <td style="width:5%;text-align:center;">
                                {{ $loop->iteration }}
                            </td>
                            <td>
                                {{ trim($item) }}
                            </td>
                        </tr>
                    @endforeach
                </table>

            </td>
        </tr>

        @if ($data->obat_pulang)
            <tr>
                <th colspan="4" class="header">
                    OBAT PULANG
                </th>
            </tr>

            <tr>
                <td colspan="4">
                    {!! nl2br(e($data->obat_pulang)) !!}
                </td>
            </tr>
        @endif



    </table>
    <div style="text-align:center; margin-top:20px; width:100%;">
        <p style="margin:0; font-weight:bold;">PETUGAS</p>

        <p style="margin:5px 0 15px 0;">
            Pekajangan, {{ date('d/m/Y', strtotime($data->tanggal)) }}
        </p>

        <img
            src="data:image/png;base64,{{ DNS2D::getBarcodePNG($data->nip, 'QRCODE') }}"
            width="80">

        <p style="margin-top:10px;">
            {{ $data->petugas->nama }}
        </p>
    </div>
@endsection
