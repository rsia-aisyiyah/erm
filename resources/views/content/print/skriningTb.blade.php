@extends('content.print.main')
@section('content')
    <img src="{{ asset('img/logo.png') }}" style="position: absolute;top:60px;left:20px;margin:0px;padding:0px" width="70" /><br />
    <table class="borderless" style="margin-bottom: 10px;">
        <tr>
            <td>
                <div style="text-align: center; margin-left:100px">
                    <h3 style="margin-bottom: 0px">RSIA AISYIYAH PEKAJANGAN</h3>
                    <p style="font-size: 11px">Jl. Raya Pekajangan No. 610, Kabupaten Pekalongan, Jawa Tengah </p>
                    <p style="font-size: 11px">Telp. (0285) 785909, Email : rba610@gmail.com </p>
                </div>
            </td>
            <td style="max-width: 10%px;">
                <ul style="list-style-type: none;font-size:11px;border:1px solid #000; padding:10px; width:120%">
                    <li>No. RM : {{ $data->pasien->no_rkm_medis }}</li>
                    <li>Nama : {{ $data->pasien->nm_pasien }} ({{ $data->pasien->jk }})</li>
                    <li>Tgl. Lahir / Umur: {{ date('d-m-Y', strtotime($data->pasien->tgl_lahir)) }} / {{ $data->reg_periksa->umurdaftar }} {{ $data->reg_periksa->sttsumur }}</li>
                    <li>Alamat : {{ $data->pasien->alamat }}, {{ $data->pasien->kec->nm_kec }}</li>
                    <li>No. Hp/Telp : {{ $data->pasien->no_tlp }}</li>
                </ul>
            </td>
        </tr>
    </table>
    <hr style="margin:0;padding:0">
    <h3 style="text-align: center"><u>HASIL SKRINING TB PADA ANAK</u></h3>
    <table class="table-bordered" width="100%" style="margin-top:10px;margin-bottom:10px">
        {{-- <thead>
            <tr>
                <th colspan="6" style="height: 30px;vertical-align:top">
                    <u>HASIL SKRINING TB PADA ANAK</u>

                </th>
            </tr>
        </thead> --}}
        <tbody style="font-size: 14px">
            <tr style="">
                <th>Parameter</th>
                <th>Hasil</th>
                <th>Skor</th>
            </tr>
            <tr>
                <td>Kontak TB</td>
                <td>{{ $data->ket_kontak }}</td>
                <td>{{ $data->kontak }}</td>
            </tr>
            <tr>
                <td>Uji Tuberkulin (Mantoux)</td>
                <td>{{ $data->ket_mantoux }}</td>
                <td>{{ $data->mantoux }}</td>
            </tr>
            <tr>
                <td>Berat Badan/Keadaan Gizi</td>
                <td>{{ $data->ket_berat }}</td>
                <td>{{ $data->berat }}</td>
            </tr>
            <tr>
                <td>Demam yang tidak diketahui penyebabnya</td>
                <td>{{ $data->ket_demam }}</td>
                <td>{{ $data->demam }}</td>
            </tr>
            <tr>
                <td>Batuk Kronik</td>
                <td>{{ $data->ket_batul }}</td>
                <td>{{ $data->batul }}</td>
            </tr>
            <tr>
                <td>Pembesaran kelenjar limfe kolli, aksila, inguinal</td>
                <td>{{ $data->ket_pembesaran }}</td>
                <td>{{ $data->pembesaran }}</td>
            </tr>
            <tr>
                <td>Pembengkakan tulang/sendi panggul, lutut, falang</td>
                <td>{{ $data->ket_pembengkakan }}</td>
                <td>{{ $data->pembengkakan }}</td>
            </tr>
            <tr>
                <td>Foto thorax</td>
                <td>{{ $data->ket_thorax }}</td>
                <td>{{ $data->thorax }}</td>
            </tr>
            <tr>
                <th colspan="2">Total : </th>
                <td>{{ $data->total_skrining }}</td>
            </tr>
        </tbody>
    </table>
    {{-- @dd($data) --}}

    {{-- <p style="margin-top: 30px">Hasil Pemeriksaan : </p>
    <hr />
    <p style="white-space: pre;border:1px solid #000; padding: 10px">{{ $data['hasil'] }}</p> --}}

    <table width="100%" style="text-align: center;margin-top:50px;font-size:12px;">
        <tr>
            <td>
                <small><i>Tanggal Cetak : {{ date('d/m/Y H:i:s') }}</i> <br></small>
                Dokter DPJP
            </td>
        </tr>
        <tr>
            <td>
                <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG($data->finger, 'QRCODE') }}" height="80" width="80" /><br>
            </td>
        </tr>
        <tr>
            <td>
                <u>{{ $data->dokter->nm_dokter }}</u>
            </td>
        </tr>
    </table>
    {{-- @foreach ($data['gambar'] as $gbr)
        <div class="page-break"></div>
        <p style="margin-top: 40px">Foto Radiologi : </p>
        <hr />
        <img src="{{ $gbr }}" loading="lazy" style="width: 100%" />
    @endforeach --}}
@endsection
