@extends('content.print.main')
@section('content')
    <div style="text-align: center">
        <h3 style="margin-bottom: 0px">RSIA AISYIYAH PEKAJANGAN</h3>
        <p style="font-size: 11px">Jl. Raya Pekajangan No. 610, Kabupaten Pekalongan, Jawa Tengah </p>
        <p style="font-size: 11px">Telp. (0285) 785909, Email : rba610@gmail.com </p>
    </div>
    <hr style="margin:0;padding:0">
    <img src="{{ asset('img/logo.png') }}" style="position: absolute;top:10px;left:30px;margin:0px;padding:0px" width="50" /><br />
    {{-- <table class="table-print" width="100%" style="margin-top:0px">
        <thead>
            <tr>
                <th colspan="6" style="background-color:rgb(227, 255, 162);font-size:12px">
                    ASUHAN GIZI DEWASA
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="font-size:10px" colspan="2">
                    Nama : {{ $pasien['nm_pasien'] }} ({{ $pasien['umur'] }})</br>
                    No. RM : {{ $pasien['no_rkm_medis'] }}
                </td>
                <td style="font-size:10px" colspan="2">
                    Jenis Kelamin: {{ $pasien['jk'] }} <br>
                    Tanggal Lahir : {{ $pasien['tgl_lahir'] }}
                </td>
                <td style="font-size:10px" class="border" colspan="2">
                    Tgl. Asesmen: {{ $asuhanGizi['tanggal'] }} <br>
                    Diagnosis Medis: {{ $pasien['diagnosa_awal'] }}
                </td>
            </tr>
        </tbody>
    </table> --}}
    <div class="border text-center bg-lime">
        <h4>ASUHAN GIZI DEWASA</h4>
    </div>

    <div class="border">
        <table width="100%">
            <tr>
                <td colspan="9">
                    <strong>1. Data Antopometri</strong>
                </td>
            </tr>
            <tr>
                <td>
                    BB
                </td>
                <td>
                    : {{ $asuhanGizi['antropometri_bb'] }} Kg
                </td>
                <td>
                    Z-Score BB/U
                </td>
                <td>
                    : {{ $asuhanGizi['bb'] }} Kg
                </td>
            </tr>
        </table>

        {{ print_r($asuhanGizi) }}
    </div>
@endsection
