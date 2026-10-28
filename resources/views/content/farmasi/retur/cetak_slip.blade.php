@extends('content.print.main')

@section('content')
    @php
        $kamarDisplay = '-';
        if ($pengajuan->regPeriksa && $pengajuan->regPeriksa->kamarInap && count($pengajuan->regPeriksa->kamarInap) > 0) {
            $activeKamar = collect($pengajuan->regPeriksa->kamarInap)->firstWhere('stts_pulang', '-') ?: $pengajuan->regPeriksa->kamarInap[0];
            $nmBangsal = $activeKamar->kamar->bangsal->nm_bangsal ?? '';
            $kdKamar = $activeKamar->kd_kamar ?? '';
            $kamarDisplay = $nmBangsal ? "{$nmBangsal} ({$kdKamar})" : $kdKamar;
        }

        $pasien = $pengajuan->regPeriksa->pasien ?? null;
        $jkText = ($pasien->jk ?? '') == 'L' ? 'Laki-Laki' : (($pasien->jk ?? '') == 'P' ? 'Perempuan' : '-');
        $tglLahir = $pasien && $pasien->tgl_lahir ? date('d-m-Y', strtotime($pasien->tgl_lahir)) : '-';
        $umur = ($pengajuan->regPeriksa->umurdaftar ?? 0) . ' ' . ($pengajuan->regPeriksa->sttsumur ?? 'Th');

        $barcodeData = '';
        try {
            $barcodeData = DNS1D::getBarcodePNG($pengajuan->no_pengajuan, 'C39E');
        } catch (\Exception $e) {
            $barcodeData = '';
        }

        $logoPath = public_path('img/logo.png');
        $logoSrc = file_exists($logoPath) ? 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath)) : asset('img/logo.png');

        $statusBadge = match($pengajuan->status) {
            'Disetujui' => 'background-color: #d1e7dd; color: #0f5132; border: 1px solid #badbcc;',
            'Ditolak' => 'background-color: #f8d7da; color: #842029; border: 1px solid #f5c2c7;',
            'Batal' => 'background-color: #e2e3e5; color: #41464b; border: 1px solid #d3d6d8;',
            default => 'background-color: #fff3cd; color: #664d03; border: 1px solid #ffecb5;',
        };
    @endphp

    <style>
        .table-info-pasien td {
            padding: 3px 4px;
            font-size: 11px;
            vertical-align: top;
        }
        .table-retur {
            width: 100%;
            border-collapse: collapse;
            font-size: 10.5px;
            margin-top: 8px;
            margin-bottom: 12px;
        }
        .table-retur th {
            background-color: #f8f9fa;
            border: 1px solid #333;
            padding: 5px 4px;
            text-align: center;
            font-weight: bold;
        }
        .table-retur td {
            border: 1px solid #333;
            padding: 5px 4px;
            vertical-align: middle;
        }
        .table-ttd {
            width: 100%;
            font-size: 11px;
            margin-top: 15px;
            border-collapse: collapse;
        }
        .table-ttd td {
            text-align: center;
            vertical-align: top;
            padding: 4px;
        }
        .badge-status {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 10.5px;
            font-weight: bold;
            text-transform: uppercase;
        }
    </style>

    <!-- KOP SURAT RSIA AISYIYAH PEKAJANGAN -->
    <img src="{{ $logoSrc }}" style="position: absolute; top: 0px; left: 10px; width: 60px;" alt="Logo RSIA" />
    
    @if($barcodeData)
        <div style="position: absolute; top: 0px; right: 10px; text-align: right;">
            <img src="data:image/png;base64,{{ $barcodeData }}" height="26" width="150" /><br>
            <span style="font-size: 10px; font-family: monospace; font-weight: bold;">{{ $pengajuan->no_pengajuan }}</span>
        </div>
    @endif

    <div style="text-align: center; margin-bottom: 5px; min-height: 60px;">
        <h3 style="margin: 0; font-size: 15px; font-weight: bold;">{{ $setting->nama_instansi ?? 'RSIA AISYIYAH PEKAJANGAN' }}</h3>
        <p style="margin: 2px 0 0 0; font-size: 10.5px;">{{ $setting->alamat_instansi ?? 'Jl. Raya Pekajangan No. 610' }}, {{ $setting->kabupaten ?? 'Kabupaten Pekalongan' }}, {{ $setting->propinsi ?? 'Jawa Tengah' }}</p>
        <p style="margin: 2px 0 0 0; font-size: 10.5px;">Telp. {{ $setting->kontak ?? '(0285) 785909' }} • Email : {{ $setting->email ?? 'rba610@gmail.com' }}</p>
    </div>

    <hr style="margin: 5px 0 10px 0; border: 0; border-top: 1.5px solid #000;">

    <div style="text-align: center; margin-bottom: 12px;">
        <h4 style="margin: 0; font-size: 13px; font-weight: bold; letter-spacing: 0.5px; text-transform: uppercase;">
            BUKTI PENGAJUAN RETUR OBAT RAWAT INAP
        </h4>
        <span style="font-size: 11px; color: #444;">Status: </span>
        <span class="badge-status" style="{{ $statusBadge }}">{{ $pengajuan->status }}</span>
        @if($pengajuan->no_retur_jual)
            <span style="font-size: 11px; margin-left: 8px; font-weight: bold; color: #0d6efd;">
                (No. Retur: {{ $pengajuan->no_retur_jual }}{{ !empty($jurnal->no_jurnal) ? ' | Jurnal: ' . $jurnal->no_jurnal : '' }})
            </span>
        @endif
    </div>

    <!-- IDENTITAS PASIEN & PENGAJUAN -->
    <table class="table-info-pasien" style="width: 100%; margin-bottom: 10px;">
        <tr>
            <td style="width: 18%;"><strong>No. Pengajuan</strong></td>
            <td style="width: 2%;">:</td>
            <td style="width: 30%; font-family: monospace; font-weight: bold;">{{ $pengajuan->no_pengajuan }}</td>
            <td style="width: 18%;"><strong>Tgl / Jam Pengajuan</strong></td>
            <td style="width: 2%;">:</td>
            <td style="width: 30%;">{{ date('d-m-Y', strtotime($pengajuan->tgl_pengajuan)) }} / {{ $pengajuan->jam_pengajuan }}</td>
        </tr>
        <tr>
            <td><strong>No. Rawat</strong></td>
            <td>:</td>
            <td style="font-family: monospace;">{{ $pengajuan->no_rawat }}</td>
            <td><strong>Ruangan / Kamar</strong></td>
            <td>:</td>
            <td>{{ $kamarDisplay }}</td>
        </tr>
        <tr>
            <td><strong>No. Rekam Medis</strong></td>
            <td>:</td>
            <td style="font-family: monospace;">{{ $pasien->no_rkm_medis ?? '-' }}</td>
            <td><strong>Petugas Pengaju</strong></td>
            <td>:</td>
            <td>{{ $pengajuan->pegawaiPengaju->nama ?? $pengajuan->petugas_pengaju }}</td>
        </tr>
        <tr>
            <td><strong>Nama Pasien</strong></td>
            <td>:</td>
            <td><strong>{{ $pasien->nm_pasien ?? '-' }}</strong> ({{ $jkText }}, {{ $umur }})</td>
            <td><strong>Petugas Validasi</strong></td>
            <td>:</td>
            <td>
                @if($pengajuan->pegawaiValidasi)
                    {{ $pengajuan->pegawaiValidasi->nama }} ({{ date('d-m-Y', strtotime($pengajuan->tgl_validasi)) }} {{ $pengajuan->jam_validasi }})
                @else
                    -
                @endif
            </td>
        </tr>
    </table>

    <!-- TABEL DAFTAR OBAT RETUR -->
    <table class="table-retur">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 12%;">Kode</th>
                <th style="width: 31%;">Nama Obat / Alkes</th>
                <th style="width: 8%;">Satuan</th>
                <th style="width: 8%;">Diajukan</th>
                <th style="width: 8%;">Disetujui</th>
                <th style="width: 13%;">Harga (Rp)</th>
                <th style="width: 15%;">Subtotal (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @php $totalRetur = 0; @endphp
            @forelse($pengajuan->details as $idx => $item)
                @php
                    $jmlFix = $pengajuan->status === 'Disetujui' ? $item->jml_disetujui : $item->jml_diajukan;
                    $subtotal = $jmlFix * $item->h_retur;
                    $totalRetur += $subtotal;
                @endphp
                <tr>
                    <td style="text-align: center;">{{ $idx + 1 }}</td>
                    <td style="font-family: monospace; text-align: center;">{{ $item->kode_brng }}</td>
                    <td>
                        <strong>{{ $item->barang->nama_brng ?? $item->kode_brng }}</strong>
                        @if($item->keterangan)
                            <div style="font-size: 9.5px; color: #555; font-style: italic;">Ket: {{ $item->keterangan }}</div>
                        @endif
                        @if($item->no_batch)
                            <div style="font-size: 9px; color: #777;">Batch: {{ $item->no_batch }}</div>
                        @endif
                    </td>
                    <td style="text-align: center;">{{ $item->kode_sat ?: ($item->barang->kode_sat ?? '-') }}</td>
                    <td style="text-align: center; font-weight: bold;">{{ (float)$item->jml_diajukan }}</td>
                    <td style="text-align: center; font-weight: bold; color: {{ $pengajuan->status === 'Disetujui' ? '#198754' : '#6c757d' }};">
                        {{ $pengajuan->status === 'Disetujui' ? (float)$item->jml_disetujui : '-' }}
                    </td>
                    <td style="text-align: right;">{{ number_format($item->h_retur, 0, ',', '.') }}</td>
                    <td style="text-align: right; font-weight: bold;">{{ number_format($subtotal, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align: center; padding: 10px; color: #777;">Tidak ada item obat.</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr style="background-color: #f8f9fa;">
                <td colspan="7" style="text-align: right; font-weight: bold; padding: 6px;">TOTAL NOMINAL RETUR :</td>
                <td style="text-align: right; font-weight: bold; padding: 6px; font-size: 11px;">Rp {{ number_format($totalRetur, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>

    <!-- CATATAN -->
    <div style="margin-top: 5px; font-size: 10.5px;">
        @if($pengajuan->catatan)
            <p style="margin: 2px 0;"><strong>Catatan Ruangan:</strong> {{ $pengajuan->catatan }}</p>
        @endif
        @if($pengajuan->catatan_farmasi)
            <p style="margin: 2px 0; color: #b02a37;"><strong>Catatan Farmasi:</strong> {{ $pengajuan->catatan_farmasi }}</p>
        @endif
    </div>

    <!-- TANDA TANGAN -->
    <table class="table-ttd">
        <tr>
            <td style="width: 50%;">
                Pekalongan, {{ date('d-m-Y', strtotime($pengajuan->tgl_pengajuan)) }}<br>
                Petugas Ruangan Ranap,<br><br><br><br>
                <strong><u>{{ $pengajuan->pegawaiPengaju->nama ?? $pengajuan->petugas_pengaju }}</u></strong><br>
                NIP. {{ $pengajuan->petugas_pengaju }}
            </td>
            <td style="width: 50%;">
                Petugas Farmasi / Validasi,<br><br><br><br>
                <strong><u>{{ $pengajuan->pegawaiValidasi->nama ?? ($pengajuan->petugas_validasi ?: '..........................................') }}</u></strong><br>
                @if($pengajuan->petugas_validasi)
                    NIP. {{ $pengajuan->petugas_validasi }}
                @else
                    NIP. .....................................
                @endif
            </td>
        </tr>
    </table>
@endsection
