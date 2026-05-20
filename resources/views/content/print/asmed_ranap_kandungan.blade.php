@extends('content.print.main')

@section('content')

    <style>
        .table-print {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
        }

        .table-print td,
        .table-print th {
            border: 1px solid #000;
            padding: 4px;
            vertical-align: top;
        }

        .title-section {
            background: #e7e7e7;
            text-align: center;
            font-weight: bold;
        }

        .text-center {
            text-align: center;
        }

        .no-border {
            border: none !important;
        }

        .fs-10 {
            font-size: 10px;
        }

        .fs-11 {
            font-size: 11px;
        }
    </style>

    {{-- HEADER --}}
    <div style="text-align:center">
        <h3 style="margin-bottom:0">
            RSIA AISYIYAH PEKAJANGAN
        </h3>

        <p style="font-size:11px;margin:2px">
            Jl. Raya Pekajangan No. 610 Pekajangan – Pekalongan, 51172
        </p>

        <p style="font-size:11px;margin:2px">
            Telp. (0285) 785909 Email: rba610@gmail.com
            <br /> website: www.rsiaaisyiyah.com
        </p>
    </div>

    <img src="{{ asset('img/logo.png') }}" style="position:absolute; top:10px; left:25px" width="55">

    <hr>

    {{-- IDENTITAS --}}
    <table class="table-print" style="margin-top:10px">

        <thead>
            <tr>
                <th colspan="6" style="background:#dff0b2;font-size:12px">
                    ASESMEN AWAL MEDIS RAWAT INAP KANDUNGAN
                </th>
            </tr>

            <tr>
                <td colspan="2" class="fs-10">
                    <b>No. RM</b> :
                    {{ $asmed['regPeriksa']['pasien']['no_rkm_medis'] }}
                    <br>

                    <b>Nama Pasien</b> :
                    {{ $asmed['regPeriksa']['pasien']['nm_pasien'] }}
                </td>

                <td colspan="2" class="fs-10">
                    <b>Jenis Kelamin</b> :
                    {{ $asmed['regPeriksa']['pasien']['jk'] == 'L' ? 'Laki-laki' : 'Perempuan' }}
                    <br>

                    <b>Tanggal Lahir</b> :
                    {{ date('d-m-Y', strtotime($asmed['regPeriksa']['pasien']['tgl_lahir'])) }}
                </td>

                <td colspan="2" class="fs-10">
                    <b>Tanggal Asesmen</b> :
                    {{ date('d-m-Y H:i', strtotime($asmed['tanggal'])) }}
                    <br>

                    <b>Anamnesis</b> :
                    {{ $asmed['anamnesis'] }}
                </td>
            </tr>
        </thead>

        {{-- RIWAYAT --}}
        <tr>
            <td colspan="6" class="title-section">
                1. RIWAYAT KESEHATAN
            </td>
        </tr>

        <tr>
            <td colspan="6" style="">
                <b>Keluhan Utama</b><br>
                {!! nl2br(e($asmed['keluhan_utama'])) !!}
            </td>
        </tr>

        <tr>
            <td colspan="6" style="">
                <b>Riwayat Penyakit Sekarang</b><br>
                {!! nl2br(e($asmed['rps'])) !!}
            </td>
        </tr>

        <tr>
            <td colspan="3">
                <b>Riwayat Penyakit Dahulu</b><br>
                {!! nl2br(e($asmed['rpd'])) !!}
            </td>

            <td colspan="3">
                <b>Riwayat Penyakit Keluarga</b><br>
                {!! nl2br(e($asmed['rpk'])) !!}
            </td>
        </tr>

        <tr>
            <td colspan="3">
                <b>Riwayat Pengobatan</b><br>
                {!! nl2br(e($asmed['rpo'])) !!}
            </td>

            <td colspan="3">
                <b>Riwayat Alergi</b><br>
                {!! nl2br(e($asmed['alergi'])) !!}
            </td>
        </tr>

        {{-- PEMERIKSAAN --}}
        <tr>
            <td colspan="6" class="title-section">
                2. PEMERIKSAAN FISIK
            </td>
        </tr>

        <tr>
            <td colspan="2">
                <b>Keadaan Umum</b><br>
                {{ $asmed['keadaan'] }}
            </td>

            <td colspan="2">
                <b>Kesadaran</b><br>
                {{ $asmed['kesadaran'] }}
            </td>

            <td colspan="2">
                <b>GCS</b><br>
                {{ $asmed['gcs'] }}
            </td>
        </tr>

        <tr>
            <td colspan="6" class="text-center">
                TD : {{ $asmed['td'] }} mmHg,
                Nadi : {{ $asmed['nadi'] }} x/menit,
                RR : {{ $asmed['rr'] }} x/menit,
                Suhu : {{ $asmed['suhu'] }} °C,
                SPO2 : {{ $asmed['spo'] }} %,
                BB : {{ $asmed['bb'] }} Kg,
                TB : {{ $asmed['tb'] }} Cm
            </td>
        </tr>

        <tr>

            <td colspan="2">
                <b>Kepala</b> : {{ $asmed['kepala'] }} <br>
                <b>Mata</b> : {{ $asmed['mata'] }} <br>
                <b>Gigi</b> : {{ $asmed['gigi'] }} <br>
                <b>THT</b> : {{ $asmed['tht'] }}
            </td>

            <td colspan="2">
                <b>Thoraks</b> : {{ $asmed['thoraks'] }} <br>
                <b>Jantung</b> : {{ $asmed['jantung'] }} <br>
                <b>Paru</b> : {{ $asmed['paru'] }}
            </td>

            <td colspan="2">
                <b>Abdomen</b> : {{ $asmed['abdomen'] }} <br>
                <b>Genital</b> : {{ $asmed['genital'] }} <br>
                <b>Ekstremitas</b> : {{ $asmed['ekstremitas'] }} <br>
                <b>Kulit</b> : {{ $asmed['kulit'] }}
            </td>

        </tr>

        <tr>
            <td colspan="6">
                <b>Keterangan Pemeriksaan Fisik</b><br>
                {!! nl2br(e($asmed['ket_fisik'])) !!}
            </td>
        </tr>

        {{-- STATUS OBSTETRI --}}
        <tr>
            <td colspan="6" class="title-section">
                3. STATUS OBSTETRI & GINEKOLOGI
            </td>
        </tr>

        <tr>
            <td colspan="2">
                <b>TFU</b><br>
                {{ $asmed['tfu'] }}
            </td>

            <td colspan="2">
                <b>TBJ</b><br>
                {{ $asmed['tbj'] }}
            </td>

            <td colspan="2">
                <b>DJJ</b><br>
                {{ $asmed['djj'] }}
            </td>
        </tr>

        <tr>
            <td colspan="3">
                <b>His</b><br>
                {{ $asmed['his'] }}
            </td>

            <td colspan="3">
                <b>Kontraksi</b><br>
                {{ $asmed['kontraksi'] }}
            </td>
        </tr>

        <tr>
            <td colspan="3">
                <b>Inspeksi</b><br>
                {!! nl2br(e($asmed['inspeksi'])) !!}
            </td>

            <td colspan="3">
                <b>Inspekulo</b><br>
                {!! nl2br(e($asmed['inspekulo'])) !!}
            </td>
        </tr>

        <tr>
            <td colspan="3">
                <b>VT</b><br>
                {!! nl2br(e($asmed['vt'])) !!}
            </td>

            <td colspan="3">
                <b>RT</b><br>
                {!! nl2br(e($asmed['rt'])) !!}
            </td>
        </tr>

        {{-- PENUNJANG --}}
        <tr>
            <td colspan="6" class="title-section">
                4. PEMERIKSAAN PENUNJANG
            </td>
        </tr>

        <tr>
            <td colspan="2">
                <b>USG</b><br>
                {!! nl2br(e($asmed['ultra'])) !!}
            </td>

            <td colspan="2">
                <b>Kardiotokografi</b><br>
                {!! nl2br(e($asmed['kardio'])) !!}
            </td>

            <td colspan="2">
                <b>Laboratorium</b><br>
                {!! nl2br(e($asmed['lab'])) !!}
            </td>
        </tr>

        {{-- DIAGNOSIS --}}
        <tr>
            <td colspan="6" class="title-section">
                5. DIAGNOSIS
            </td>
        </tr>

        <tr>
            <td colspan="6">
                {!! nl2br(e($asmed['diagnosis'])) !!}
            </td>
        </tr>

        {{-- TATALAKSANA --}}
        <tr>
            <td colspan="6" class="title-section">
                6. TATA LAKSANA
            </td>
        </tr>

        <tr>
            <td colspan="6">
                {!! nl2br(e($asmed['tata'])) !!}
            </td>
        </tr>

        {{-- EDUKASI --}}
        <tr>
            <td colspan="6" class="title-section">
                7. EDUKASI
            </td>
        </tr>

        <tr>
            <td colspan="6" >
                {!! nl2br(e($asmed['edukasi'])) !!}
            </td>
        </tr>

        {{-- TTD --}}
        <tr>
            <td colspan="6" class="text-center">
                Dokter Pemeriksa
            </td>
        </tr>

        <tr>
            {{--
            <td colspan="6" style="height:120px; text-align:center; vertical-align:middle">

                {{ date('d-m-Y H:i', strtotime($asmed['tanggal'])) }}

            </td> --}}

            <td colspan="6" style="height:120px; text-align:center; vertical-align:bottom">

                <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG($asmed['sidik'], 'QRCODE') }}" width="70"
                    height="70">

                <br>

                <b>
                    <u>{{ $asmed['dokter']['nm_dokter'] }}</u>
                </b>

                <br>

                NIK :
                {{ $asmed['kd_dokter'] }}

            </td>

        </tr>

    </table>

@endsection