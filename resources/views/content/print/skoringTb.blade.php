@extends('content.print.main')
@section('content')
    <img src="{{ asset('img/logo.png') }}" style="position: absolute;top:30px;left:20px;margin:0px;padding:0px" width="70" /><br />
    <div style="text-align: center; margin-bottom: 20px;">
        <h3 style="margin-bottom: 0px">RSIA AISYIYAH PEKAJANGAN</h3>
        <p style="font-size: 11px">Jl. Raya Pekajangan No. 610, Kabupaten Pekalongan, Jawa Tengah </p>
        <p style="font-size: 11px">Telp. (0285) 785909, Email : rba610@gmail.com </p>
    </div>
    <hr style="margin:0;padding:0">
    <h3 style="text-align: center"><u>HASIL SKORING TB</u></h3>
    <table style="font-size: 13px" width="100%">
        <tr>
            <td width="20%">No. RM</td>
            <td width="5%">:</td>
            <td>{{ $data->pasien->no_rkm_medis }}</td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td>
                {{ $data->pasien->nm_pasien }} ({{ $data->pasien->jk }})
            </td>
        </tr>
        <tr>
            <td>Tgl. Lahir / Umur </td>
            <td>: </td>
            <td>
                {{ date('d-m-Y', strtotime($data->pasien->tgl_lahir)) }} / {{ $data->reg_periksa->umurdaftar }} {{ $data->reg_periksa->sttsumur }}
            </td>
        </tr>
        <tr>
            <td>
                No. Hp/Telp
            </td>
            <td>:</td>
            <td>
                {{ $data->pasien->no_tlp }}
            </td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>
                {{ $data->pasien->alamat }}, {{ $data->pasien->kec->nm_kec }}
            </td>
        </tr>
        <tr>
            <td>Penanggung Jawab</td>
            <td>:</td>
            <td>
                {{ $data->reg_periksa->p_jawab }} ({{ $data->reg_periksa->hubunganpj }})
            </td>
        </tr>
    </table>

    <table class="table-bordered" width="100%" style="margin-top:10px;margin-bottom:10px">
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
                <u>{{ $data->dokter->nm_dokter }}</u><br>
                NIP : {{ $data->dokter->kd_dokter }}
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
