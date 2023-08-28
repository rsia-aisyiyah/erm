@extends('content.print.main')
@section('content')
    <div style="text-align: center">
        <h3 style="margin-bottom: 0px">RSIA AISYIYAH PEKAJANGAN</h3>
        <p style="font-size: 11px">Jl. Raya Pekajangan No. 610, Kabupaten Pekalongan, Jawa Tengah </p>
        <p style="font-size: 11px">Telp. (0285) 785909, Email : rba610@gmail.com </p>
    </div>
    <hr style="margin:0;padding:0">
    <img src="{{ asset('img/logo.png') }}" style="position: absolute;top:10px;left:30px;margin:0px;padding:0px" width="50" /><br />
    <table class="table-print" width="100%" style="margin-top:0px">
        <thead>
            <tr>
                <th colspan="6" style="background-color:rgb(227, 255, 162);font-size:12px">
                    ASESMEN AWAL MEDIS RAWAT JALAN ANAK
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="font-size:10px" colspan="2">
                    No. RM : {{ $data['no_rkm_medis'] }} <br>
                    Nama : {{ $data['nama'] }}
                </td>
                <td style="font-size:10px" colspan="2">
                    Jenis Kelamin: {{ $data['jk'] }} <br>
                    Tanggal Lahir : {{ $data['tgl_lahir'] }}
                </td>
                <td style="font-size:10px" class="border" colspan="2">
                    Tgl. Asesmen: {{ $data['tanggal'] }} <br>
                    Anamnesis: {{ $data['anamnesis'] }}
            </tr>
            <tr>
                <td colspan="6" style="text-align: center;background-color:#e7e7e7 ">
                    <p><strong>1. RIWAYAT KESEHATAN</strong></p>
                </td>
            </tr>
            <tr>
                <td style="font-size:10px; height:60px" colspan="6">
                    Keluhan Utama : <br> {{ $data['keluhan_utama'] }}
                </td>
            </tr>
            <tr>
                <td style="font-size:10px; height:40px" colspan="6">
                    Riwayat Penyakit Sekarang: <br>{{ $data['rps'] }}
                </td>
            </tr>
            <tr>
                <td style="font-size:10px; height:40x" colspan="3">
                    Riwayat Penyakit Dahulu:<br> {{ $data['rpd'] }}
                </td>
                <td style="font-size:10px; height:60px" colspan="3" class="border">
                    Riwayat Penyakit Keluarga:<br> {{ $data['rpk'] }}
                </td>
            </tr>
            <tr>
                <td style="font-size:10px; height:40px" colspan="3">
                    Riwayat Penyakit Pengobatan:<br> {{ $data['rpo'] }}
                </td>
                <td style="font-size:10px; height:40px" colspan="3" class="border">
                    Riwayat Alergi:<br> {{ $data['alergi'] }}
                </td>
            </tr>
            <tr>
                <td colspan="6" style="text-align: center;background-color:#e7e7e7 ">
                    <p><strong>2. PEMERIKSAAN FISIK</strong></p>
                </td>
            </tr>
            <tr>
                <td style="font-size:10px" colspan="2">
                    Keadaan Umum : {{ $data['keadaan'] }}
                </td>
                <td style="font-size:10px" colspan="2">
                    Kesadaran : {{ $data['kesadaran'] }}
                </td>
                <td style="font-size:10px" colspan="2">
                    GCS (E,V,M) : {{ $data['gcs'] }}
                </td>
            </tr>
            <tr>
                <td style="font-size:10px;text-align:center" colspan="6">
                    TD : {{ $data['td'] }} mmHg,
                    Nadi : {{ $data['td'] }} x/m,
                    Respirasi : {{ $data['rr'] }} x/m,
                    Suhu : {{ $data['suhu'] }} <sup>0</sup>C,
                    SPO2: {{ $data['spo'] }} %,
                    BB: {{ $data['bb'] }} Kg,
                    TB: {{ $data['tb'] }} Cm
                </td>
            </tr>
            <tr>
                <td style="font-size:10px;text-align:center;heught:80px">
                    <ul style="list-style-type: none; text-align:left; margin:0px; padding:5px">
                        <li>Kepala</li>
                        <li>Mata</li>
                        <li>Gigi & Mulut</li>
                        <li>THT</li>
                        <li>Thoraks</li>
                    </ul>
                </td>
                <td style="font-size:10px;text-align:center;" class="border">
                    <ul style="list-style-type: none; text-align:left; margin:0px; padding:5px">
                        <li>{{ $data['kepala'] }}</li>
                        <li>{{ $data['mata'] }}</li>
                        <li>{{ $data['gigi'] }}</li>
                        <li>{{ $data['tht'] }}</li>
                        <li>{{ $data['thoraks'] }}</li>
                    </ul>
                </td>
                <td style="font-size:10px;text-align:center;vertical-align:top">
                    <ul style="list-style-type: none; text-align:left; margin:0px; padding:5px">
                        <li>Abdomen</li>
                        <li>Genital & Anus</li>
                        <li>Ekstremitas</li>
                        <li>Kulit</li>
                    </ul>
                </td>
                <td style="font-size:10px;text-align:center;vertical-align:top" class="border">
                    <ul style="list-style-type: none; text-align:left; margin:0px; padding:5px">
                        <li>{{ $data['abdomen'] }}</li>
                        <li>{{ $data['genital'] }}</li>
                        <li>{{ $data['ekstremitas'] }}</li>
                        <li>{{ $data['kulit'] }}</li>
                    </ul>
                </td>
                <td style="font-size:10px;vertical-align:top" colspan="2" class="border">
                    Keterangan: <br>
                    {{ $data['ket_fisik'] }}
                </td>
            </tr>
            <tr>
                <td colspan="6" style="text-align: center;background-color:#e7e7e7 ">
                    <p><strong>3. STATUS LOKALIS</strong></p>
                </td>
            </tr>

            <tr>
                <td style="font-size:10px;vertical-align:top;height:50px;text-align:center" colspan="6" class="border">
                    <img src="{{ asset('img/set-lokalis.jpg') }}" alt="" style="height: 180px;width:80%">
                </td>
            </tr>

            <tr>
                <td style="font-size:10px;vertical-align:top;height:40px" colspan="6" class="border">
                    Keterangan Lokalis : {{ $data['ket_lokalis'] }}
                </td>
            </tr>
            <tr>
                <td style="font-size:10px;vertical-align:top;height:30px" colspan="6" class="border">
                    Diagnosis : {{ $data['diagnosis'] }}
                </td>
            </tr>
            <tr>
                <td colspan="6" style="text-align: center;background-color:#e7e7e7;">
                    <p><strong>5. TATA LAKSANA</strong></p>
                </td>
            </tr>
            <tr>
                <td style="font-size:10px;vertical-align:top;height:50px" colspan="6" class="border">
                    Tata Laksana : {{ $data['tata'] }}
                </td>
            </tr>
            <tr>
                <td colspan="6" style="text-align: center;background-color:#e7e7e7 ">
                    <p><strong>6. KONSUL/RUJUK</strong></p>
                </td>
            </tr>
            <tr>
                <td style="font-size:10px;vertical-align:top;height:50px" colspan="6" class="border">
                    Konsul/Rujuk : {{ $data['konsul'] }}
                </td>
            </tr>
            <tr>
                <td style="font-size:10px;" colspan="3" class="border">
                    Tanggal & Jam
                </td>
                <td style="font-size:10px;" colspan="3" class="border">
                    Nama Dokter & TTD
                </td>
            </tr>
            <tr>
                <td style="font-size:10px;vertical-align:center;height:80px;text-align:center" colspan="3" class="border">
                    {{ $data['tanggal'] }}
                </td>
                <td style="font-size:10px;vertical-align:bottom;height:80px;text-align:center" colspan="3" class="border">
                    <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG($data['sidik'], 'QRCODE') }}" height="80" width="80" /><br>
                    <b><u>{{ $data['dokter'] }} </u> <br></b>
                    NIK : {{ $data['kd_dokter'] }}

                </td>
            </tr>
        </tbody>
    </table>
@endsection
