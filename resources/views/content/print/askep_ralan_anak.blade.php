@extends('content.print.main')

@section('content')

    <div style="text-align:center">
        <h2 style="margin-bottom:0">
            RSIA AISYIYAH PEKAJANGAN
        </h2>

        <p style="margin:2px">
            ASESMEN KEPERAWATAN AWAL RAWAT JALAN ANAK
        </p>
    </div>

    <hr>

    <img src="{{ asset('img/logo.png') }}" style="position:absolute;top:10px;left:30px" width="60" />

    <table width="100%" border="1" style="border-collapse:collapse;font-size:10px">
        <tr>
            <th colspan="4" style="background:#f3fdd7;padding:5px">
                IDENTITAS PASIEN
            </th>
        </tr>

        <tr>
            <td width="20%">No RM</td>
            <td width="30%">
                {{ $data->pasien->no_rkm_medis }}
            </td>

            <td width="20%">Jenis Kelamin</td>
            <td width="30%">
                {{ $data->pasien->jk }}
            </td>
        </tr>

        <tr>
            <td>Nama Pasien</td>
            <td>
                {{ $data->pasien->nm_pasien }}
            </td>

            <td>Tanggal Lahir</td>
            <td>
                {{ date('d/m/Y', strtotime($data->pasien->tgl_lahir)) }}
            </td>
        </tr>

        <tr>
            <td>Umur</td>
            <td>
                {{ $data->pasien->umur }}
            </td>

            <td>Tanggal Kunjungan</td>
            <td>
                {{ date('d/m/Y H:i', strtotime($data->tanggal)) }}
            </td>
        </tr>
        <tr>
            <th colspan="4" style="background:#f3fdd7;padding:5px">
                I. KEADAAN UMUM
            </th>
        </tr>

        <tr>
            <td colspan="4">
                TD : {{ $data->td }}
                &nbsp;&nbsp;

                Nadi : {{ $data->nadi }}
                &nbsp;&nbsp;

                RR : {{ $data->rr }}
                &nbsp;&nbsp;

                Suhu : {{ $data->suhu }}
                &nbsp;&nbsp;

                GCS : {{ $data->gcs }}
            </td>
        </tr>

        <tr>
            <td colspan="4">
                BB : {{ $data->bb }} Kg

                &nbsp;&nbsp;

                TB : {{ $data->tb }} Cm

                &nbsp;&nbsp;

                LK : {{ $data->lk }}

                &nbsp;&nbsp;

                LD : {{ $data->ld }}

                &nbsp;&nbsp;

                LP : {{ $data->lp }}
            </td>
        </tr>
        <tr>
            <th colspan="4" style="background:#f3fdd7;padding:5px">
                II. RIWAYAT KESEHATAN
            </th>
        </tr>

        <tr>
            <td colspan="4">
                <b>Keluhan Utama</b><br>
                {!! nl2br(e($data->keluhan_utama)) !!}
            </td>
        </tr>

        <tr>
            <td colspan="4">
                <b>Riwayat Penyakit Dahulu</b><br>
                {!! nl2br(e($data->rpd)) !!}
            </td>
        </tr>

        <tr>
            <td colspan="4">
                <b>Riwayat Penyakit Keluarga</b><br>
                {!! nl2br(e($data->rpk)) !!}
            </td>
        </tr>

        <tr>
            <td colspan="4">
                <b>Riwayat Penggunaan Obat</b><br>
                {!! nl2br(e($data->rpo)) !!}
            </td>
        </tr>

        <tr>
            <td colspan="4">
                <b>Alergi</b><br>
                {{ $data->alergi }}
            </td>
        </tr>
        <tr>
            <th colspan="4" style="background:#f3fdd7;padding:5px">
                III. RIWAYAT KELAHIRAN
            </th>
        </tr>

        <tr>
            <td>Anak Ke</td>
            <td>{{ $data->anakke }}</td>

            <td>Dari Saudara</td>
            <td>{{ $data->darisaudara }}</td>
        </tr>

        <tr>
            <td>Cara Lahir</td>
            <td>{{ $data->caralahir }}</td>

            <td>Usia Kelahiran</td>
            <td>{{ $data->umurkelahiran }}</td>
        </tr>

        <tr>
            <td>Kelainan Bawaan</td>
            <td colspan="3">
                {{ $data->kelainanbawaan }}
                {{ $data->ket_kelainan_bawaan }}
            </td>
        </tr>
        <tr>
            <th colspan="4" style="background:#f3fdd7;padding:5px">
                IV. RIWAYAT IMUNISASI
            </th>
        </tr>

        <tr>
            <td colspan="4">

                <table width="100%" border="1" style="border-collapse:collapse">

                    <tr>
                        <th width="10%">No</th>
                        <th>Imunisasi</th>
                    </tr>

                    @foreach($data->riwayatImunisasi as $item)
                        <tr>
                            <td align="center">
                                {{ $loop->iteration }}
                            </td>
                            <td>
                                {{ $item->nama_imunisasi }}
                            </td>
                        </tr>
                    @endforeach

                </table>

            </td>
        </tr>
        <tr>
            <th colspan="4" style="background:#f3fdd7;padding:5px">
                XI. MASALAH KEPERAWATAN
            </th>
        </tr>

        <tr>
            <td colspan="4">

                <table width="100%" border="1" style="border-collapse:collapse">

                    <tr>
                        <th width="15%">Kode</th>
                        <th>Masalah</th>
                    </tr>

                    @foreach($data->masalah as $item)
                        <tr>
                            <td align="center">
                                {{ $item->kode_masalah }}
                            </td>

                            <td>
                                {{ $item->nama_masalah }}
                            </td>
                        </tr>
                    @endforeach

                </table>

            </td>
        </tr>
        <tr>
            <th colspan="4" style="background:#f3fdd7;padding:5px">
                XII. RENCANA KEPERAWATAN
            </th>
        </tr>

        <tr>
            <td colspan="4">

                <table width="100%" border="1" style="border-collapse:collapse">

                    <tr>
                        <th width="20%">Kode Masalah</th>
                        <th>Rencana</th>
                    </tr>

                    @foreach($data->rencanaMasalah as $item)
                        <tr>
                            <td align="center">
                                {{ $item->kode_masalah }}
                            </td>

                            <td>
                                {{ $item->rencana_keperawatan }}
                            </td>
                        </tr>
                    @endforeach

                </table>

            </td>
        </tr>
        <tr>
            <th colspan="4" style="background:#f3fdd7;padding:5px">
                PETUGAS
            </th>
        </tr>

        <tr>
            <td colspan="2" align="center" height="120">

                {{ date('d/m/Y H:i:s', strtotime($data->tanggal)) }}

            </td>

            <td colspan="2" align="center">

                <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG($data->ttd_petugas, 'QRCODE') }}" width="70">

                <br>

                {{ $data->petugas->nama }}

            </td>
        </tr>

    </table>

@endsection