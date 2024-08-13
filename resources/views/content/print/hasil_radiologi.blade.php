@extends('content.print.main')
@section('content')
    <div style="text-align: center">
        <h3 style="margin-bottom: 0px">RSIA AISYIYAH PEKAJANGAN</h3>
        <p style="font-size: 11px">Jl. Raya Pekajangan No. 610, Kabupaten Pekalongan, Jawa Tengah </p>
        <p style="font-size: 11px">Telp. (0285) 785909, Email : rba610@gmail.com </p>
    </div>
    <hr style="margin:0;padding:0">
    <img src="{{ asset('img/logo.png') }}" style="position: absolute;top:10px;left:30px;margin:0px;padding:0px" width="50" /><br />
    <table class="" width="100%" style="margin-top:2px;margin-bottom:10px">
        <thead>
            <tr>
                <th colspan="6" style="height: 30px;vertical-align:top">
                    <u>HASIL PEMERIKSAAN RADIOLOGI</u>

                </th>
            </tr>
        </thead>
        <tbody style="font-size: 12px">
            <tr>
                <td>No. RM</td>
                <td>:</td>
                <td>{{ $data['no_rkm_medis'] }}</td>
                <td>Dokter Radiologi</td>
                <td>:</td>
                <td>{{ $data['dokter'] }}</td>
            </tr>
            <tr>
                <td>Nama Pasien</td>
                <td>:</td>
                <td>{{ $data['nama'] }} ({{ $data['jk'] }})</td>
                <td>Dokter Perujuk</td>
                <td>:</td>
                <td>{{ $data['dpjp'] }}</td>
            </tr>
            <tr>
                <td width="15%">Tanggal Lahir</td>
                <td width="2%">:</td>
                <td width="50%">{{ $data['tgl_lahir'] }} / {{ $data['umur'] }}</td>
                <td width="20%">Tanggal Periksa</td>
                <td width="2%">:</td>
                <td width="30%">{{ $data['tgl_pemeriksaan'] }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td>{{ $data['alamat'] }}</td>
                <td>Jam Periksa</td>
                <td>:</td>
                <td>{{ $data['jam'] }}</td>
            </tr>
            <tr>
                <td>No Rawat</td>
                <td>:</td>
                <td>{{ $data['no_rawat'] }}</td>
                <td>Jenis Pemeriksaan</td>
                <td>:</td>
                <td>{{ $data['jns_pemeriksaan'] }}</td>
            </tr>
            <tr>
                <td>Kamar Inap / Poli</td>
                <td>:</td>
                <td>{{ $data['kamar'] }} / {{ $data['poli'] }}</td>
            </tr>
        </tbody>
    </table>

    <p style="margin-top: 30px">Hasil Pemeriksaan : </p>
    <hr />
    <p style="white-space: pre;border:1px solid #000; padding: 10px">{{ $data['hasil'] }}</p>

    <table width="100%" style="text-align: center;margin-top:50px;font-size:12px;">
        <tr>
            <td>
                Penanggung Jawab
            </td>
            <td>
                <small><i>Tanggal Cetak : {{ date('d/m/Y H:i:s') }}</i> <br></small>
                Petugas Radiologi
            </td>
        </tr>
        <tr>
            <td>
                <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG($data['ttd_dokter'], 'QRCODE') }}" height="80" width="80" /><br>
            </td>
            <td>
                <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG($data['ttd_petugas'], 'QRCODE') }}" height="80" width="80" /><br>
            </td>
        </tr>
        <tr>
            <td>
                {{ $data['dokter'] }}
            </td>
            <td>
                {{ $data['petugas'] }}
            </td>
        </tr>
    </table>
    @foreach ($data['gambar'] as $gbr)
        <div class="page-break"></div>
        <p style="margin-top: 40px">Foto Radiologi : </p>
        <hr />
        <img src="{{ $gbr }}" loading="lazy" style="width: 100%" />
    @endforeach
@endsection
