<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SURAT RUJUKAN RUMAH SAKIT</title>
    <style>
        * {
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            margin: px;
        }

        p {
            font-size: 12px;
            margin: 0px;
        }
    </style>
    <script></script>
</head>

<body>
    <table>
        <tr>
            <td width="50%" style="padding-right: 75px">
                <img src="{{ asset('img/logo_bpjs.png') }}" alt="" width="200px" />
            </td>
            <td style="text-align: center">
                <h3 class="" style="margin-bottom:0px;">SURAT RUJUKAN RUMAH SAKIT</h3>
                <p class="text-content" style="margin-top:0px">{{ explode('. ', $rujukan->tipeRujukan)[1] }}</p>
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
                <p> <strong>{{ $rujukan->nm_ppkDirujuk }}</strong></p>
            </td>
            <td>
                <p>No. Rujukan</p>
            </td>
            <td>
                <p>:</p>
            </td>
            <td>
                <p><strong>{{ $rujukan->no_rujukan }}</strong></p>
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
                <p>{{ $rujukan->sep->nama_pasien }}</p>
            </td>
            <td>
                <p>Kelamin</p>
            </td>
            <td>
                <p>:</p>
            </td>
            <td>
                <p>{{ $rujukan->sep->jkel == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
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
                <p>{{ $rujukan->sep->no_kartu }}</p>
            </td>
            <td>
                <p>Rawat</p>
            </td>
            <td>
                <p width="2px">:</p>
            </td>
            <td>
                <p>{{ $rujukan->jnsPelayanan == '1' ? '1. Rawat Inap' : '2. Rawat Jalan' }}</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>Diagnosa</p>
            </td>
            <td>
                <p width="2px">:</p>
            </td>
            <td width="350px" colspan="4">
                <p>{{ $rujukan->diagRujukan }} - {{ $rujukan->nama_diagRujukan }}</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>Keterangan</p>
            </td>
            <td>
                <p width="2px">:</p>
            </td>
            <td width="350px">
                <p>{{ $rujukan->catatan }}</p>
            </td>
        </tr>
    </table>

    <p>Demikian atas bantuannya, diucapkan banyak terimakasih.</p>
    <table>
        <tr>
            <td width="500px">

            </td>
            <td>
                <div>
                    <p style="text-align: center">Pekalongan, {{ $rujukan->tglRujukan }} </p>
                    <p style="text-align: center">MENGETAHUI</p>
                </div>
            </td>
        </tr>
    </table>
    {{-- <p>{{ $rujukan }}</p> --}}
</body>

</html>
