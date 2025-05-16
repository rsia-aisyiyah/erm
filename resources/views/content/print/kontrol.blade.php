@extends('content.print.main')

@section('content')
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
                    Tgl. <strong>{{ $kontrol['tglKontrol'] }}</strong>
                </p>
            </td>
        </tr>
    </table>
    <img style="position: absolute;top:80px;right:30px" src="data:image/png;base64,{{ DNS1D::getBarcodePNG($kontrol['no_surat'], 'C39E') }}" height="30" width="180" /><br />

    <table style="font-size:13px">
        <tr>
            <td>
                Kepada Yth
            </td>
            <td>:</td>
            <td colspan="4">
                <strong>{{ $kontrol['nmDokter'] }}</strong>
            </td>
        </tr>
        <tr>
            <td colspan="6" style="padding-bottom: 10px;padding-top: 10px;">Mohon pemeriksaan dan penanganan lebih lanjut : </td>
        </tr>
        <tr>
            <td width="100px">No. Kartu</td>
            <td width="2px">:</td>
            <td width="500px" colspan="3">{{ $kontrol['noKartu'] }}</td>
            <td width="90px">No. Rujukan</td>
            <td width="2px">:</td>
            <td width="200px">{{ $kontrol['no_sep'] }}</td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td colspan="3">{{ $kontrol['namaPasien'] }} ({{ $kontrol['jkel'] }})</td>
            <td>Tgl. Rujukan</td>
            <td>:</td>
            <td>{{ $kontrol['tglKontrolSep'] }} s.d {{ $kontrol['tglRujukanExpired'] }}</td>
        </tr>
        <tr>
            <td>Tgl. Lahir / Umur</td>
            <td>:</td>
            <td colspan="3">{{ $kontrol['tglLahir'] }} / {{ $kontrol['umur'] }}</td>
            <td>Faskes</td>
            <td>:</td>
            <td>{{ $kontrol['nmppkrujukan'] }}</td>
        </tr>
        <tr>
            <td>Diagnosis Awal</td>
            <td>:</td>
            <td colspan="4">{{ $kontrol['diagnosa'] }}</td>
        </tr>
        <tr>
            <td>Tgl. Entri</td>
            <td>:</td>
            <td colspan="4">{{ $kontrol['tglSurat'] }}</td>
        </tr>
        <tr>
            <td colspan="5" style="padding-top:10px;padding-bottom:10px">
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
                <p>
                    <i id="rujukan-expired"></i>
                </p>
            </td>
            <td width="300px">
                <div>
                    <p style="text-align: center;margin-bottom:80px;font-size:12px">MENGETAHUI</p>
                    <hr />
                </div>
            </td>
        </tr>
    </table>
@endsection

@push('script')
@endpush
