@extends('content.print.main')
@section('content')
    <img src="{{ asset('img/logo.png') }}" style="position: absolute;top:30px;left:20px;margin:0px;padding:0px" width="70" /><br />
    <div style="text-align: center; margin-bottom: 20px;">
        <h3 style="margin-bottom: 0px">RSIA AISYIYAH PEKAJANGAN</h3>
        <p style="font-size: 11px">Jl. Raya Pekajangan No. 610, Kabupaten Pekalongan, Jawa Tengah </p>
        <p style="font-size: 11px">Telp. (0285) 785909, Email : rba610@gmail.com </p>
    </div>
    <hr style="margin:0;padding:0">
    <h3 style="text-align: center"><u>HASIL SKRINING TB</u></h3>
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
                <th>Gejala dan Tanda TB</th>
                <th>Nilai</th>
            </tr>
            <tr>
                <td>Batuk Berdahak</td>
                <td>[ {{ $data->berdahak }} ]</td>
            </tr>
            <tr>
                <td>Batuk berdahak lebih dari 2 minggu</td>
                <td>[ {{ $data->berdahakB }} ]</td>
            </tr>
            <tr>
                <td>Demam hilang timbul lebih dari 1 Bulan</td>
                <td>[ {{ $data->demam }} ]</td>
            </tr>
            <tr>
                <td>Keringat malam tanpa aktivitas</td>
                <td>[ {{ $data->keringat }} ]</td>
            </tr>
            <tr>
                <td>Penurunan berat badan tanpa sebab yang jelas</td>
                <td>[ {{ $data->berat }} ]</td>
            </tr>
            <tr>
                <td>Pembesaran kelenjar getah bening (benjolan di daerah leher) dengan ukuran lebih dari 2 cm</td>
                <td>[ {{ $data->kelenjar }} ]</td>
            </tr>
            <tr>
                <td>Sesak nafas dan nyeri dada </td>
                <td>[ {{ $data->sesak }} ]</td>
            </tr>
            <tr>
                <td>Pernah minum obat paru dalam waktu lama sebelumnya </td>
                <td>[ {{ $data->obat }} ]</td>
            </tr>
            <tr>
                <td>Ada keluarga/tetangga yang pernah mengalami sakit paru-paru/TB/pengobatan paru-paru</td>
                <td>[ {{ $data->keluarga }} ]</td>
            </tr>
            <tr>
                <td>Penyakit lain : Asma / Diabetes Melitus </td>
                <td>[ {{ $data->penyakit }} ]</td>
            </tr>

        </tbody>
    </table>
    {{-- @dd($data) --}}

    {{-- <p style="margin-top: 30px">Hasil Pemeriksaan : </p>
    <hr />
    <p style="white-space: pre;border:1px solid #000; padding: 10px">{{ $data['hasil'] }}</p> --}}

    <table width="100%" style="text-align: center;margin-top:50px;margin-left:80px;font-size:12px;">
        <tr>
            <td>
                Petugas
            </td>
            <td>
                <small><i>Tanggal Cetak : {{ date('d/m/Y H:i:s') }}</i> <br></small>
                Dokter DPJP
            </td>
        </tr>
        <tr>
            <td>
                <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG($data->finger, 'QRCODE') }}" height="80" width="80" /><br>
            </td>
            <td>
                <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG($data->finger, 'QRCODE') }}" height="80" width="80" /><br>
            </td>
        </tr>
        <tr>
            <td>
                <u>{{ $data->pegawai->nama }}</u><br>
                NIP : {{ $data->pegawai->nik }}
            </td>
            <td>
                <u>{{ $data->reg_periksa->dokter->nm_dokter }}</u><br>
                NIP : {{ $data->reg_periksa->dokter->kd_dokter }}
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
