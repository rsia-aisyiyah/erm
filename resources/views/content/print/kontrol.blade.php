@extends('content.print.main')

@section('content')
    {{-- @dd($kontrol) --}}
    <table>
        <tr>
            <td width="180px" style="padding-right: 10px">
                <img src="{{ asset('img/logo_bpjs.png') }}" alt="" width="200px" style="margin-top:15px" />
            </td>
            <td style="text-align: center" width="275px">
                <h4 class="" style="margin-bottom:0px;">SURAT RENCANA KONTROL</h4>
                <h4 class="" style="margin-top:0px;margin-bottom:0px;">RSIA AISYIYAH PEKAJANGAN</h4>
            </td>
            <td>
                <p style="font-size:14px;margin-top:15px">No. {{ $kontrol['no_surat'] }} <br>
                    Tgl. {{ $kontrol['tglKontrol'] }}
                </p>
            </td>
        </tr>
    </table>
    <img style="position: absolute;top:80px;right:30px" src="data:image/png;base64,{{ DNS1D::getBarcodePNG($kontrol['no_surat'], 'C39E') }}" height="30" width="180" /><br />

    <table style="">
        <tr>
            <td>
                Kepada Yth
            </td>
            <td>:</td>
            <td width="450px">
                <strong>{{ $kontrol['nmDokter'] }}</strong>
            </td>
        </tr>
        <tr>
            <td colspan="3" style="padding-bottom: 10px;padding-top: 10px;">Mohon pemeriksaan dan penanganan lebih lanjut : </td>
        </tr>
        <tr>
            <td>No. Kartu</td>
            <td>:</td>
            <td>{{ $kontrol['noKartu'] }}</td>
        </tr>
        <tr>
            <td>Nama Pasien</td>
            <td>:</td>
            <td>{{ $kontrol['namaPasien'] }} ({{ $kontrol['jkel'] }})</td>
        </tr>
        <tr>
            <td>Tanggal Lahir</td>
            <td>:</td>
            <td>{{ $kontrol['tglLahir'] }}</td>
        </tr>
        <tr>
            <td>Diagnosa Awal</td>
            <td>:</td>
            <td>{{ $kontrol['diagnosa'] }}</td>
        </tr>
        <tr>
            <td>Tanggal Entri</td>
            <td>:</td>
            <td>{{ $kontrol['tglSurat'] }}</td>
        </tr>
        <tr>
            <td colspan="3" style="padding-top:10px;padding-bottom:10px">
                Demikian atas bantuannya, diucapkan banyak terimakasih.
            </td>
        </tr>
    </table>


    <table>
        <tr>
            <td width="400px">
                <p>
                    <i>Tgl. Cetak {{ $kontrol['tglCetak'] }}</i>
                </p>
            </td>
            <td width="300px">
                <div>
                    <p style="text-align: center;margin-bottom:80px;font-size:16px">MENGETAHUI</p>
                    <hr />
                </div>
            </td>
        </tr>
    </table>

    {{-- {{ print_r($kontrol) }} --}}
@endsection

@push('script')
@endpush
