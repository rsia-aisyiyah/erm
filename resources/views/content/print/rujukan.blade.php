@extends('content.print.main')

@section('content')
    {{-- @dd($rujukan) --}}
    <table>
        <tr>
            <td width="50%" style="padding-right: 75px">
                <img src="{{ asset('img/logo_bpjs.png') }}" alt="" width="200px" />
            </td>
            <td style="text-align: center">
                <h3 class="" style="margin-bottom:0px;">SURAT RUJUKAN RUMAH SAKIT</h3>
                <p class="text-content" style="margin-top:0px">{{ explode('. ', $rujukan['tipeRujukan'])[1] }}</p>
            </td>
        </tr>
    </table>

    <table style="margin-top:20px">
        <tr>
            <td>
                <p>Kepada Yth</p>
            </td>
            <td>:</td>
            <td width="300px">
                <p> <strong>{{ $rujukan['nm_ppkDirujuk'] }}</strong></p>
            </td>
            <td>
                <p>No. Rujukan</p>
            </td>
            <td>
                <p>:</p>
            </td>
            <td>
                <p><strong>{{ $rujukan['no_rujukan'] }}</strong></p>
            </td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td>
                <p>Asal Rumah Sakit</p>
            </td>
            <td>
                <p>:</p>
            </td>
            <td>
                <p>RSIA AISYIYAH PEKAJANGAN</p>
            </td>
        </tr>
    </table>
    <table style="margin-top:10px">
        <tr>
            <td colspan="6">
                <p>Mohon pemeriksaan dan penanganan lebih lanjut penderita : </p>
            </td>
        </tr>
        <tr>
            <td>
                <p>Nama</p>
            </td>
            <td>
                <p>:</p>
            </td>
            <td width="350px">
                <p>{{ $rujukan['nama_pasien'] }}</p>
            </td>
            <td>
                <p>Kelamin</p>
            </td>
            <td width="5px">
                <p>:</p>
            </td>
            <td>
                <p>{{ $rujukan['jkel'] }}</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>No. Kartu BPJS</p>
            </td>
            <td>
                <p width="2px">:</p>
            </td>
            <td width="350px">
                <p>{{ $rujukan['no_kartu'] }}</p>
            </td>
            <td>
                <p>Rawat</p>
            </td>
            <td>
                <p width="2px">:</p>
            </td>
            <td>
                <p>{{ $rujukan['jnsPelayanan'] }}</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>Diagnosa</p>
            </td>
            <td width="5px">
                <p>:</p>
            </td>
            <td width="350px" colspan="4">
                <p>{{ $rujukan['diagRujuk'] }}</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>Keterangan</p>
            </td>
            <td width="5px">
                <p>:</p>
            </td>
            <td width="350px">
                <p>{{ $rujukan['catatan'] }}</p>
            </td>
        </tr>
    </table>

    <p>Demikian atas bantuannya, diucapkan banyak terimakasih.</p>
    <table>
        <tr>
            <td width="500px">
                <p>
                    *) Rujukan berlaku sampai dengan {{ $rujukan['masaBerlaku'] }}
                </p>
                <p>
                    **) Tanggal rencana berkunjung {{ $rujukan['tglRujukan'] }}
                </p>
            </td>
            <td>
                <div>
                    <p style="text-align: center">Pekalongan, {{ $rujukan['tglRujukan'] }}</p>
                    <p style="text-align: center;margin-bottom:80px">MENGETAHUI</p>
                    <hr>
                </div>
            </td>
        </tr>
    </table>
    {{-- {{ $rujukan }} --}}
@endsection

@push('script')
@endpush
