@extends('content.print.main')

@section('content')
    @php
        $kamarDisplay = '-';
        if ($kamar && $kamar->kamar) {
            $bangsal = $kamar->kamar->bangsal->nm_bangsal ?? '';
            $kdKamar = $kamar->kd_kamar ?? '';
            $kamarDisplay = $bangsal ? "{$bangsal} ({$kdKamar})" : $kdKamar;
        }

        $pasien = $regPeriksa->pasien ?? null;
        $jkText = ($pasien->jk ?? '') == 'L' ? 'Laki-Laki' : (($pasien->jk ?? '') == 'P' ? 'Perempuan' : '-');
        $tglLahir = $pasien->tgl_lahir ? date('d-m-Y', strtotime($pasien->tgl_lahir)) : '-';
        $umur = ($regPeriksa->umurdaftar ?? 0) . ' ' . ($regPeriksa->sttsumur ?? 'Th');

        $tglMulai = $laporan->tgl_operasi ? date('d-m-Y H:i', strtotime($laporan->tgl_operasi)) : '-';
        $tglSelesai = $laporan->tgl_selesai ? date('d-m-Y H:i', strtotime($laporan->tgl_selesai)) : '-';

        // Hitung durasi
        $durasiMenit = '-';
        if ($laporan->tgl_operasi && $laporan->tgl_selesai) {
            try {
                $start = \Carbon\Carbon::parse($laporan->tgl_operasi);
                $end = \Carbon\Carbon::parse($laporan->tgl_selesai);
                $diff = $start->diffInMinutes($end);
                $jam = floor($diff / 60);
                $menit = $diff % 60;
                $durasiMenit = ($jam > 0 ? "{$jam} jam " : "") . "{$menit} menit";
            } catch (\Exception $e) {
                $durasiMenit = '-';
            }
        }
    @endphp

    <style>
        .table-pasien td {
            padding: 3px 4px;
            font-size: 11px;
            vertical-align: top;
        }
        .table-laporan {
            width: 100%;
            border-collapse: collapse;
            font-size: 10.5px;
            margin-top: 8px;
            margin-bottom: 12px;
        }
        .table-laporan th {
            background-color: #f2f4f7;
            border: 1px solid #333;
            padding: 5px 6px;
            font-weight: bold;
            text-align: left;
        }
        .table-laporan td {
            border: 1px solid #333;
            padding: 5px 6px;
            vertical-align: top;
        }
        .section-header-box {
            background-color: #e5e7eb;
            font-weight: bold;
            font-size: 11px;
            padding: 4px 6px;
            border: 1px solid #333;
            margin-top: 6px;
        }
        .laporan-teks {
            border: 1px solid #333;
            padding: 10px;
            font-size: 11px;
            line-height: 1.6;
            min-height: 250px;
            white-space: pre-wrap;
        }
    </style>

    <div style="text-align: center; margin-bottom: 12px;">
        <h3 style="margin: 0; text-transform: uppercase; font-size: 15px; letter-spacing: 0.5px;">LAPORAN OPERASI</h3>
        <small style="font-size: 11px; color: #444;">Instalasi Bedah Sentral (Kamar Operasi)</small>
    </div>

    <!-- Identitas Pasien -->
    <table class="table-pasien" style="width: 100%; margin-bottom: 10px; border: 1px solid #333; padding: 4px;">
        <tr>
            <td style="width: 18%; font-weight: bold;">Nama Pasien</td>
            <td style="width: 2%;">:</td>
            <td style="width: 30%;">{{ $pasien->nm_pasien ?? '-' }}</td>
            <td style="width: 18%; font-weight: bold;">No. Rekam Medis</td>
            <td style="width: 2%;">:</td>
            <td style="width: 30%;"><strong>{{ $pasien->no_rkm_medis ?? '-' }}</strong></td>
        </tr>
        <tr>
            <td style="font-weight: bold;">No. Rawat</td>
            <td>:</td>
            <td>{{ $regPeriksa->no_rawat ?? '-' }}</td>
            <td style="font-weight: bold;">Jenis Kelamin / Usia</td>
            <td>:</td>
            <td>{{ $jkText }} / {{ $umur }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Kamar / Bangsal</td>
            <td>:</td>
            <td>{{ $kamarDisplay }}</td>
            <td style="font-weight: bold;">Tanggal Lahir</td>
            <td>:</td>
            <td>{{ $tglLahir }}</td>
        </tr>
    </table>

    <!-- Rincian Prosedur & Tim Operasi -->
    <table class="table-laporan">
        <tr>
            <th colspan="4" style="background-color: #e5e7eb; text-align: center;">DATA PELAKSANAAN PEMBEDAHAN</th>
        </tr>
        <tr>
            <td style="width: 22%; font-weight: bold;">Tindakan Operasi</td>
            <td colspan="3"><strong style="font-size: 11.5px;">{{ $laporan->paketOperasi->nm_perawatan ?? ($laporan->kode_paket ?? '-') }}</strong></td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Waktu Mulai</td>
            <td style="width: 28%;">{{ $tglMulai }} WIB</td>
            <td style="width: 22%; font-weight: bold;">Waktu Selesai</td>
            <td style="width: 28%;">{{ $tglSelesai }} WIB</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Lama Operasi</td>
            <td>{{ $durasiMenit }}</td>
            <td style="font-weight: bold;">Kategori / Sifat</td>
            <td><strong>{{ $laporan->kategori ?? '-' }}</strong></td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Jenis Anestesi</td>
            <td>{{ $laporan->jenis_anestesi ?? '-' }}</td>
            <td style="font-weight: bold;">Pemeriksaan PA</td>
            <td>{{ $laporan->pemeriksaan_pa ?? 'Tidak' }}</td>
        </tr>
        <tr>
            <th colspan="4" style="background-color: #e5e7eb; text-align: center;">TIM OPERASI</th>
        </tr>
        <tr>
            <td style="font-weight: bold;">Operator Utama</td>
            <td><strong>{{ $laporan->operatorSatu->nm_dokter ?? ($laporan->operator1 ?? '-') }}</strong></td>
            <td style="font-weight: bold;">Dokter Anestesi</td>
            <td>{{ $laporan->dokterAnestesi->nm_dokter ?? ($laporan->dokter_anestesi ?? '-') }} (Hadir: {{ $laporan->dr_anestesi_hadir ?? 'Ya' }})</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Asisten Operator 1</td>
            <td>{{ $laporan->asistenOperatorSatu->nama ?? ($laporan->asisten_operator1 ?? '-') }}</td>
            <td style="font-weight: bold;">Asisten Anestesi</td>
            <td>{{ $laporan->asistenAnestesiPetugas->nama ?? ($laporan->asisten_anestesi ?? '-') }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Asisten Operator 2</td>
            <td>{{ $laporan->asistenOperatorDua->nama ?? ($laporan->asisten_operator2 ?? '-') }}</td>
            <td style="font-weight: bold;">Dokter Anak</td>
            <td>{{ $laporan->dokterAnak->nm_dokter ?? ($laporan->dokter_anak ?? '-') }} (Hadir: {{ $laporan->dr_anak_hadir ?? 'Tidak' }})</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Perawat Sirkuler (Onloop)</td>
            <td colspan="3">{{ $laporan->onloopPetugas->nama ?? ($laporan->onloop ?? '-') }}</td>
        </tr>
        <tr>
            <th colspan="4" style="background-color: #e5e7eb; text-align: center;">DIAGNOSA &amp; TEMUAN KLINIS</th>
        </tr>
        <tr>
            <td style="font-weight: bold;">Diagnosa Pre-Operasi</td>
            <td colspan="3">{{ $laporan->diagnosa_preop ?? '-' }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Diagnosa Post-Operasi</td>
            <td colspan="3"><strong>{{ $laporan->diagnosa_postop ?? '-' }}</strong></td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Jaringan Insisi / Spesimen</td>
            <td colspan="3">{{ $laporan->jaringan_insisi ?? '-' }}</td>
        </tr>
    </table>

    <!-- Narasi Jalannya Operasi -->
    <div class="section-header-box">LAPORAN JALANNYA PEMBEDAHAN:</div>
    <div class="laporan-teks">{!! nl2br(e($laporan->laporan_operasi ?? '-')) !!}</div>

    <!-- Tanda Tangan -->
    <table style="width: 100%; margin-top: 20px; font-size: 11px;">
        <tr>
            <td style="width: 50%;"></td>
            <td style="width: 50%; text-align: center;">
                Pekalongan, {{ date('d F Y', strtotime($laporan->tgl_operasi ?: date('Y-m-d'))) }}<br>
                Dokter Operator,<br><br><br><br><br>
                <strong><u>{{ $laporan->operatorSatu->nm_dokter ?? ($laporan->operator1 ?? 'Dokter Operator') }}</u></strong><br>
                <small>SIP. {{ $laporan->operatorSatu->no_ijn_praktek ?? '-' }}</small>
            </td>
        </tr>
    </table>
@endsection

