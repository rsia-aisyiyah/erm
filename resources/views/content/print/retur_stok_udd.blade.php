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

        $barcodeData = '';
        try {
            $barcodeData = DNS1D::getBarcodePNG($retur->no_retur_udd, 'C39E');
        } catch (\Exception $e) {
            $barcodeData = '';
        }
    @endphp

    <style>
        .table-info-pasien td {
            padding: 3px 4px;
            font-size: 11px;
            vertical-align: top;
        }
        .table-obat {
            width: 100%;
            border-collapse: collapse;
            font-size: 10.5px;
            margin-top: 8px;
            margin-bottom: 12px;
        }
        .table-obat th {
            background-color: #f0f3f6;
            border: 1px solid #333;
            padding: 5px 4px;
            text-align: center;
            font-weight: bold;
        }
        .table-obat td {
            border: 1px solid #333;
            padding: 5px 4px;
            vertical-align: top;
        }
        .table-ttd {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
            margin-top: 15px;
        }
        .table-ttd td {
            padding: 4px;
            vertical-align: top;
            text-align: center;
        }
        .badge-status {
            display: inline-block;
            padding: 2px 8px;
            font-size: 10px;
            font-weight: bold;
            border-radius: 4px;
            border: 1px solid #333;
        }
    </style>

    <div style="text-align: center; margin-bottom: 10px;">
        <h4 style="margin: 0; font-size: 14px; font-weight: bold; text-transform: uppercase;">
            BUKTI SERAH TERIMA PENGEMBALIAN SISA OBAT UDD (RAWAT INAP)
        </h4>
        <small style="font-size: 10.5px; color: #555;">Dokumen Mutasi Internal Loker Pasien ke Depo Farmasi</small>
    </div>

    <table style="width: 100%; margin-bottom: 8px;">
        <tr>
            <td style="width: 60%; vertical-align: top;">
                <table class="table-info-pasien" style="width: 100%;">
                    <tr>
                        <td style="width: 110px;">No. Rawat</td>
                        <td style="width: 8px;">:</td>
                        <td><strong>{{ $retur->no_rawat }}</strong></td>
                    </tr>
                    <tr>
                        <td>No. Rekam Medis</td>
                        <td>:</td>
                        <td><strong>{{ $pasien->no_rkm_medis ?? '-' }}</strong></td>
                    </tr>
                    <tr>
                        <td>Nama Pasien</td>
                        <td>:</td>
                        <td><strong>{{ $pasien->nm_pasien ?? '-' }}</strong> ({{ $jkText }}, {{ $umur }})</td>
                    </tr>
                    <tr>
                        <td>Kamar / Bangsal</td>
                        <td>:</td>
                        <td>{{ $kamarDisplay }}</td>
                    </tr>
                </table>
            </td>
            <td style="width: 40%; vertical-align: top; text-align: right;">
                <table class="table-info-pasien" style="width: 100%;">
                    <tr>
                        <td style="width: 90px; text-align: left;">No. Retur UDD</td>
                        <td style="width: 8px;">:</td>
                        <td style="text-align: left;"><strong style="font-family: monospace;">{{ $retur->no_retur_udd }}</strong></td>
                    </tr>
                    <tr>
                        <td style="text-align: left;">Tgl / Jam Pengajuan</td>
                        <td>:</td>
                        <td style="text-align: left;">{{ date('d-m-Y', strtotime($retur->tgl_retur)) }} {{ $retur->jam_retur }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: left;">Depo Tujuan</td>
                        <td>:</td>
                        <td style="text-align: left;">{{ $retur->bangsal->nm_bangsal ?? $retur->kd_bangsal }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: left;">Alasan Pengembalian</td>
                        <td>:</td>
                        <td style="text-align: left;"><strong>{{ $retur->alasan }}</strong></td>
                    </tr>
                    <tr>
                        <td style="text-align: left;">Status</td>
                        <td>:</td>
                        <td style="text-align: left;">
                            <span class="badge-status">{{ strtoupper($retur->status) }}</span>
                        </td>
                    </tr>
                </table>
                @if ($barcodeData)
                    <div style="margin-top: 4px; text-align: right;">
                        <img src="data:image/png;base64,{{ $barcodeData }}" alt="Barcode" style="height: 28px;" />
                    </div>
                @endif
            </td>
        </tr>
    </table>

    <table class="table-obat">
        <thead>
            <tr>
                <th style="width: 25px;">No</th>
                <th style="width: 85px;">Kode Obat</th>
                <th style="text-align: left;">Nama Obat / Alkes</th>
                <th style="width: 65px;">Satuan</th>
                <th style="width: 65px;">Jml Retur</th>
                <th style="width: 75px;">Jml Diterima</th>
                <th style="width: 120px;">Keterangan / Kondisi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($retur->details as $index => $item)
                <tr>
                    <td style="text-align: center;">{{ $index + 1 }}</td>
                    <td style="text-align: center; font-family: monospace;">{{ $item->kode_brng }}</td>
                    <td><strong>{{ $item->barang->nama_brng ?? '-' }}</strong></td>
                    <td style="text-align: center;">{{ $item->barang->kodeSatuan->satuan ?? '-' }}</td>
                    <td style="text-align: center; font-weight: bold; color: #b02a37;">{{ $item->jml_retur }}</td>
                    <td style="text-align: center; font-weight: bold; color: #198754;">
                        {{ $retur->status === 'Diterima' ? $item->jml_diterima : '-' }}
                    </td>
                    <td>{{ $item->keterangan ?: '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if ($retur->catatan || $retur->catatan_farmasi)
        <div style="font-size: 10px; margin-bottom: 12px; border: 1px dashed #aaa; padding: 5px 8px; border-radius: 4px;">
            @if ($retur->catatan)
                <div><strong>Catatan Ruangan:</strong> {{ $retur->catatan }}</div>
            @endif
            @if ($retur->catatan_farmasi)
                <div><strong>Catatan Farmasi:</strong> {{ $retur->catatan_farmasi }}</div>
            @endif
        </div>
    @endif

    <table class="table-ttd">
        <tr>
            <td style="width: 50%;">
                Yang Menyerahkan (Perawat Ruangan)<br/>
                <span style="font-size: 9.5px; color: #666;">Petugas Bangsal Rawat Inap</span>
                <br/><br/><br/><br/>
                <strong>( {{ $retur->pegawaiRuangan->nama ?? '.........................................' }} )</strong>
            </td>
            <td style="width: 50%;">
                Yang Menerima &amp; Memverifikasi<br/>
                <span style="font-size: 9.5px; color: #666;">Petugas Depo Farmasi Rawat Inap</span>
                <br/><br/><br/><br/>
                <strong>( {{ $retur->pegawaiFarmasi->nama ?? '.........................................' }} )</strong>
            </td>
        </tr>
    </table>
@endsection
