@extends('content.print.main')
@section('content')
    @php
        $kamar = $regPeriksa && $regPeriksa->kamarInap 
            ? (is_iterable($regPeriksa->kamarInap) 
                ? ($regPeriksa->kamarInap->filter(fn($k) => $k->stts_pulang != 'Pindah Kamar')->first() ?? $regPeriksa->kamarInap->first()) 
                : $regPeriksa->kamarInap) 
            : null;
    @endphp
    <table width="100%" style="border: none; border-collapse: collapse; margin-bottom: 5px;">
        <tr>
            <td width="15%" style="border: none; vertical-align: middle; text-align: center; padding: 0;">
                <img src="{{ public_path('img/logo.png') }}" width="60" />
            </td>
            <td width="85%" style="border: none; text-align: center; vertical-align: middle; padding: 0;">
                <h3 style="margin: 0; font-size: 16px; font-weight: bold;">RSIA AISYIYAH PEKAJANGAN</h3>
                <p style="margin: 2px 0 0 0; font-size: 11px;">Jl. Raya Pekajangan No. 610, Kabupaten Pekalongan, Jawa Tengah</p>
                <p style="margin: 2px 0 0 0; font-size: 11px;">Telp. (0285) 785909, Email : rba610@gmail.com</p>
            </td>
        </tr>
    </table>
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
            <td colspan="4">{{ date('d-m-Y', strtotime($regPeriksa->pasien->tgl_lahir ?? 'now')) }} ({{ $regPeriksa->umurdaftar ?? 0 }} {{ $regPeriksa->sttsumur ?? 'Th' }})</td>
        </tr>
    </table>

    <h4 style="margin-bottom: 5px; font-size: 13px;">Detail Permintaan Diet</h4>
    <table class="table-bordered" width="100%" style="font-size: 12px; margin-bottom: 20px;">
        <tr style="background-color: #f2f2f2;">
            <th width="30%" style="padding: 6px; text-align: left;">Item</th>
            <th width="70%" style="padding: 6px; text-align: left;">Keterangan / Status</th>
        </tr>
        <tr>
            <td style="padding: 6px;"><strong>Jenis Diet Pasien</strong></td>
            <td style="padding: 6px;">
                <strong style="color: #0d6efd; font-size: 13px;">{{ $skrining->jenis_diet ?? 'Diet Nasi' }}</strong>
                @if($skrining)
                    <br/><span style="font-size: 11px; color: #6c757d;">(Sesuai Rekomendasi Skrining Gizi - Diagnosa: {{ $skrining->diagnosa_medis ?? '-' }})</span>
                @endif
            </td>
        </tr>
        <tr>
            <td style="padding: 6px;"><strong>Jadwal Makan Pagi (06:00 - 07:00)</strong></td>
            <td style="padding: 6px;">
                <strong style="color: {{ ($permintaan->pagi ?? '-') == 'Ya' ? '#198754' : (($permintaan->pagi ?? '-') == 'Puasa' ? '#d97706' : '#6c757d') }};">
                    {{ $permintaan->pagi ?? '-' }}
                </strong>
            </td>
        </tr>
        <tr>
            <td style="padding: 6px;"><strong>Jadwal Makan Siang (11:30 - 12:30)</strong></td>
            <td style="padding: 6px;">
                <strong style="color: {{ ($permintaan->siang ?? '-') == 'Ya' ? '#198754' : (($permintaan->siang ?? '-') == 'Puasa' ? '#d97706' : '#6c757d') }};">
                    {{ $permintaan->siang ?? '-' }}
                </strong>
            </td>
        </tr>
        <tr>
            <td style="padding: 6px;"><strong>Jadwal Makan Sore (16:30 - 17:30)</strong></td>
            <td style="padding: 6px;">
                <strong style="color: {{ ($permintaan->sore ?? '-') == 'Ya' ? '#198754' : (($permintaan->sore ?? '-') == 'Puasa' ? '#d97706' : '#6c757d') }};">
                    {{ $permintaan->sore ?? '-' }}
                </strong>
            </td>
        </tr>
        <tr>
            <td style="padding: 6px;"><strong>Catatan / Permintaan Khusus</strong></td>
            <td style="padding: 6px;">{{ $permintaan->permintaan_khusus && $permintaan->permintaan_khusus !== '-' ? $permintaan->permintaan_khusus : 'Tidak ada catatan khusus' }}</td>
        </tr>
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
