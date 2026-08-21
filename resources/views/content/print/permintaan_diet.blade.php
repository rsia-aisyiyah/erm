@extends('content.print.main')
@section('content')
    @php
        $kamar = $regPeriksa && $regPeriksa->kamarInap 
            ? (is_iterable($regPeriksa->kamarInap) 
                ? ($regPeriksa->kamarInap->filter(fn($k) => $k->stts_pulang != 'Pindah Kamar')->first() ?? $regPeriksa->kamarInap->first()) 
                : $regPeriksa->kamarInap) 
            : null;
    @endphp
    <img src="{{ public_path('img/logo.png') }}" style="position: absolute; top: 0px; left: 10px; width: 60px;" />
    <div style="text-align: center; margin-bottom: 10px; min-height: 65px;">
        <h3 style="margin: 0; font-size: 16px; font-weight: bold;">RSIA AISYIYAH PEKAJANGAN</h3>
        <p style="margin: 3px 0 0 0; font-size: 11px;">Jl. Raya Pekajangan No. 610, Kabupaten Pekalongan, Jawa Tengah</p>
        <p style="margin: 3px 0 0 0; font-size: 11px;">Telp. (0285) 785909, Email : rba610@gmail.com</p>
    </div>
    <hr style="margin: 5px 0 15px 0; border: 0; border-top: 1.5px solid #000;">
    <h3 style="text-align: center; margin-top: 0; margin-bottom: 15px;"><u>LEMBAR PERMINTAAN & PEMBERIAN DIET PASIEN</u></h3>

    <table style="font-size: 12px; margin-bottom: 15px;" width="100%">
        <tr>
            <td width="20%"><strong>No. Rawat</strong></td>
            <td width="3%">:</td>
            <td width="27%">{{ $regPeriksa->no_rawat ?? '-' }}</td>
            <td width="20%"><strong>Tanggal Order</strong></td>
            <td width="3%">:</td>
            <td width="27%"><strong>{{ date('d-m-Y', strtotime($tanggal)) }}</strong></td>
        </tr>
        <tr>
            <td><strong>No. Rekam Medis</strong></td>
            <td>:</td>
            <td>{{ $regPeriksa->no_rkm_medis ?? '-' }}</td>
            <td><strong>Kamar / Bangsal</strong></td>
            <td>:</td>
            <td>{{ $kamar->kamar->bangsal->nm_bangsal ?? '-' }} ({{ $kamar->kd_kamar ?? '-' }})</td>
        </tr>
        <tr>
            <td><strong>Nama Pasien</strong></td>
            <td>:</td>
            <td>{{ $regPeriksa->pasien->nm_pasien ?? '-' }}</td>
            <td><strong>Jenis Kelamin</strong></td>
            <td>:</td>
            <td>{{ ($regPeriksa->pasien->jk ?? '') == 'L' ? 'Laki-Laki' : 'Perempuan' }}</td>
        </tr>
        <tr>
            <td><strong>Tgl. Lahir / Umur</strong></td>
            <td>:</td>
            <td>{{ date('d-m-Y', strtotime($regPeriksa->pasien->tgl_lahir ?? 'now')) }} ({{ $regPeriksa->umurdaftar ?? 0 }} {{ $regPeriksa->sttsumur ?? 'Th' }})</td>
            <td><strong>Jenis Diet Pasien</strong></td>
            <td>:</td>
            <td><strong style="color: #0d6efd;">{{ $skrining->jenis_diet ?? 'Diet Nasi' }}</strong></td>
        </tr>
    </table>

    <h4 style="margin-bottom: 5px; font-size: 13px;">Riwayat Permintaan & Pemberian Diet Pasien</h4>
    <table class="table-bordered" width="100%" style="font-size: 11px; margin-bottom: 20px;">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th width="5%" style="padding: 5px; text-align: center;">No</th>
                <th width="15%" style="padding: 5px; text-align: center;">Tanggal</th>
                <th width="22%" style="padding: 5px; text-align: left;">Jenis Diet</th>
                <th width="10%" style="padding: 5px; text-align: center;">Pagi</th>
                <th width="10%" style="padding: 5px; text-align: center;">Siang</th>
                <th width="10%" style="padding: 5px; text-align: center;">Sore</th>
                <th width="28%" style="padding: 5px; text-align: left;">Permintaan Khusus</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($riwayatDiet) && count($riwayatDiet) > 0)
                @foreach($riwayatDiet as $index => $item)
                    <tr style="{{ $item->tanggal == $tanggal ? 'background-color: #eef6ff;' : '' }}">
                        <td style="padding: 5px; text-align: center;">{{ $index + 1 }}</td>
                        <td style="padding: 5px; text-align: center;"><strong>{{ date('d-m-Y', strtotime($item->tanggal)) }}</strong></td>
                        <td style="padding: 5px;">{{ $skrining->jenis_diet ?? 'Diet Nasi' }}</td>
                        <td style="padding: 5px; text-align: center;">
                            <strong style="color: {{ $item->pagi == 'Ya' ? '#198754' : ($item->pagi == 'Puasa' ? '#d97706' : '#6c757d') }};">
                                {{ $item->pagi }}
                            </strong>
                        </td>
                        <td style="padding: 5px; text-align: center;">
                            <strong style="color: {{ $item->siang == 'Ya' ? '#198754' : ($item->siang == 'Puasa' ? '#d97706' : '#6c757d') }};">
                                {{ $item->siang }}
                            </strong>
                        </td>
                        <td style="padding: 5px; text-align: center;">
                            <strong style="color: {{ $item->sore == 'Ya' ? '#198754' : ($item->sore == 'Puasa' ? '#d97706' : '#6c757d') }};">
                                {{ $item->sore }}
                            </strong>
                        </td>
                        <td style="padding: 5px;">{{ $item->permintaan_khusus && $item->permintaan_khusus !== '-' ? $item->permintaan_khusus : '-' }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="7" style="padding: 10px; text-align: center; color: #6c757d;">Belum ada riwayat permintaan diet.</td>
                </tr>
            @endif
        </tbody>
    </table>

    <table width="100%" style="font-size: 12px; margin-top: 30px;">
        <tr>
            <td width="50%" style="text-align: center;">
                Perawat Penanggung Jawab,<br/><br/><br/><br/>
                ( ..................................................... )
            </td>
            <td width="50%" style="text-align: center;">
                Pekalongan, {{ date('d-m-Y', strtotime($tanggal)) }}<br/>
                Petugas Instalasi Gizi,<br/><br/><br/><br/>
                ( ..................................................... )
            </td>
        </tr>
    </table>
@endsection
