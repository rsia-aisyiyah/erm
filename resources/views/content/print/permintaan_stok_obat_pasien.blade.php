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
            $barcodeData = DNS1D::getBarcodePNG($permintaan->no_permintaan, 'C39E');
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
        .table-telaah {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
            margin-bottom: 15px;
        }
        .table-telaah td {
            border: 1px solid #aaa;
            padding: 4px 6px;
        }
        .table-ttd {
            width: 100%;
            font-size: 11px;
            margin-top: 10px;
            border-collapse: collapse;
        }
        .table-ttd td {
            text-align: center;
            vertical-align: top;
            padding: 4px;
        }
        .badge-jam {
            display: inline-block;
            background-color: #e9ecef;
            border: 1px solid #ced4da;
            border-radius: 3px;
            padding: 1px 3px;
            font-size: 9px;
            margin: 1px;
            font-family: monospace;
        }
    </style>

    <!-- KOP SURAT RESMI RSIA AISYIYAH PEKAJANGAN -->
    <img src="{{ public_path('img/logo.png') }}" style="position: absolute; top: 0px; left: 10px; width: 60px;" />
    
    @if($barcodeData)
        <div style="position: absolute; top: 0px; right: 10px; text-align: right;">
            <img src="data:image/png;base64,{{ $barcodeData }}" height="26" width="150" /><br>
            <span style="font-size: 10px; font-family: monospace; font-weight: bold;">{{ $permintaan->no_permintaan }}</span>
        </div>
    @endif

    <div style="text-align: center; margin-bottom: 5px; min-height: 60px;">
        <h3 style="margin: 0; font-size: 15px; font-weight: bold;">RSIA AISYIYAH PEKAJANGAN</h3>
        <p style="margin: 2px 0 0 0; font-size: 10.5px;">Jl. Raya Pekajangan No. 610, Kabupaten Pekalongan, Jawa Tengah</p>
        <p style="margin: 2px 0 0 0; font-size: 10.5px;">Telp. (0285) 785909 • Email : rba610@gmail.com</p>
    </div>

    <hr style="margin: 5px 0 10px 0; border: 0; border-top: 1.5px solid #000;">

    <!-- JUDUL DOKUMEN -->
    <div style="text-align: center; margin-bottom: 12px;">
        <h4 style="margin: 0; font-size: 13px; text-decoration: underline; text-transform: uppercase; font-weight: bold;">
            LEMBAR PERMINTAAN OBAT PASIEN (UDD RAWAT INAP)
        </h4>
        <span style="font-size: 10px; color: #444;">Unit Dose Dispensing (UDD) Pengorderan Obat Ruangan Rawat Inap ke Depo Farmasi</span>
    </div>

    <!-- IDENTITAS PASIEN & PERMINTAAN -->
    <table class="table-info-pasien" width="100%" style="margin-bottom: 8px;">
        <tr>
            <td width="18%"><strong>No. Permintaan</strong></td>
            <td width="2%">:</td>
            <td width="30%"><strong style="font-family: monospace; font-size: 11.5px;">{{ $permintaan->no_permintaan }}</strong></td>
            
            <td width="18%"><strong>No. Rawat</strong></td>
            <td width="2%">:</td>
            <td width="30%"><strong style="font-family: monospace;">{{ $permintaan->no_rawat }}</strong></td>
        </tr>
        <tr>
            <td><strong>Tanggal &amp; Jam Order</strong></td>
            <td>:</td>
            <td>{{ date('d-m-Y', strtotime($permintaan->tgl_permintaan)) }} pk {{ $permintaan->jam }}</td>
            
            <td><strong>No. Rekam Medis</strong></td>
            <td>:</td>
            <td><strong style="font-family: monospace;">{{ $regPeriksa->no_rkm_medis ?? '-' }}</strong></td>
        </tr>
        <tr>
            <td><strong>Kamar / Bangsal</strong></td>
            <td>:</td>
            <td><strong>{{ $kamarDisplay }}</strong></td>
            
            <td><strong>Nama Pasien</strong></td>
            <td>:</td>
            <td><strong>{{ $pasien->nm_pasien ?? '-' }}</strong></td>
        </tr>
        <tr>
            <td><strong>Dokter Peminta (DPJP)</strong></td>
            <td>:</td>
            <td>{{ $permintaan->dokter->nm_dokter ?? ($regPeriksa->dokter->nm_dokter ?? '-') }}</td>
            
            <td><strong>Tgl Lahir / JK / Usia</strong></td>
            <td>:</td>
            <td>{{ $tglLahir }} ({{ $jkText }}) / {{ $umur }}</td>
        </tr>
        <tr>
            <td><strong>Status Pelayanan</strong></td>
            <td>:</td>
            <td>
                @if($permintaan->status === 'Sudah')
                    <strong style="color: #198754;">SUDAH DISIAPKAN FARMASI</strong> 
                    <span style="font-size: 9.5px; color: #555;">({{ date('d-m-Y', strtotime($permintaan->tgl_validasi)) }} {{ $permintaan->jam_validasi }})</span>
                @else
                    <strong style="color: #d97706;">MENUNGGU PENYIAPAN FARMASI</strong>
                @endif
            </td>
            
            <td><strong>Status Pulang</strong></td>
            <td>:</td>
            <td>{{ $regPeriksa->status_lanjut ?? 'Ranap' }}</td>
        </tr>
    </table>

    <!-- TABEL RINCIAN PERMINTAAN OBAT / BHP -->
    <table class="table-obat">
        <thead>
            <tr>
                <th width="4%">No</th>
                <th width="12%">Kode Obat</th>
                <th width="32%">Nama Obat / BHP Medis</th>
                <th width="10%">Jumlah</th>
                <th width="8%">Satuan</th>
                <th width="18%">Aturan Pakai / Dosis</th>
                <th width="16%">Jadwal Pemberian Jam</th>
            </tr>
        </thead>
        <tbody>
            @php $details = $permintaan->detailPermintaan ?? collect(); @endphp
            @if(count($details) > 0)
                @foreach($details as $idx => $det)
                    @php
                        $satuan = $det->dataBarang->kodeSatuan->satuan ?? ($det->dataBarang->kode_sat ?? '-');
                        $jamList = [];
                        for ($h = 0; $h <= 23; $h++) {
                            $pad = str_pad($h, 2, '0', STR_PAD_LEFT);
                            $key = "jam{$pad}";
                            if (!empty($det->{$key}) && ($det->{$key} === 'true' || $det->{$key} === true || $det->{$key} === 1 || $det->{$key} === '1')) {
                                $jamList[] = "{$pad}:00";
                            }
                        }
                    @endphp
                    <tr>
                        <td style="text-align: center;">{{ $idx + 1 }}</td>
                        <td style="text-align: center; font-family: monospace;">{{ $det->kode_brng }}</td>
                        <td>
                            <strong>{{ $det->dataBarang->nama_brng ?? $det->kode_brng }}</strong>
                        </td>
                        <td style="text-align: center; font-weight: bold;">{{ $det->jml }}</td>
                        <td style="text-align: center;">{{ $satuan }}</td>
                        <td>{{ $det->aturan_pakai ?? '-' }}</td>
                        <td style="text-align: center;">
                            @if(count($jamList) > 0)
                                @foreach($jamList as $j)
                                    <span class="badge-jam">{{ $j }}</span>
                                @endforeach
                            @else
                                <span style="color: #888;">-</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="7" style="text-align: center; padding: 12px; color: #777;">
                        <i>Tidak ada rincian item obat pada permintaan ini.</i>
                    </td>
                </tr>
            @endif
        </tbody>
    </table>

    <!-- TELAAH RESEP & SKRINING FARMASI UDD (5 BENAR / 7 BENAR) -->
    <div style="font-size: 10.5px; font-weight: bold; margin-bottom: 3px;">
        TELAAH RESEP &amp; KESIAPAN FARMASI (CLINICAL &amp; DISPENSING CHECK)
    </div>
    <table class="table-telaah">
        <tr style="background-color: #f9f9f9;">
            <td width="33%"><span style="display: inline-block; width: 10px; height: 10px; border: 1.2px solid #333; margin-right: 4px; vertical-align: middle;"></span> 1. Tepat Pasien &amp; Ruangan</td>
            <td width="33%"><span style="display: inline-block; width: 10px; height: 10px; border: 1.2px solid #333; margin-right: 4px; vertical-align: middle;"></span> 3. Tepat Dosis &amp; Frekuensi</td>
            <td width="34%"><span style="display: inline-block; width: 10px; height: 10px; border: 1.2px solid #333; margin-right: 4px; vertical-align: middle;"></span> 5. Tepat Waktu Pemberian UDD</td>
        </tr>
        <tr style="background-color: #f9f9f9;">
            <td><span style="display: inline-block; width: 10px; height: 10px; border: 1.2px solid #333; margin-right: 4px; vertical-align: middle;"></span> 2. Tepat Indikasi &amp; Obat</td>
            <td><span style="display: inline-block; width: 10px; height: 10px; border: 1.2px solid #333; margin-right: 4px; vertical-align: middle;"></span> 4. Tepat Rute Pemberian</td>
            <td><span style="display: inline-block; width: 10px; height: 10px; border: 1.2px solid #333; margin-right: 4px; vertical-align: middle;"></span> 6. Tidak Ada Duplikasi / Interaksi</td>
        </tr>
    </table>

    <!-- TANDA TANGAN SERAH TERIMA 3 PIHAK -->
    <table class="table-ttd">
        <tr>
            <td width="33%">
                <strong>Yang Meminta</strong><br>
                Perawat Ruangan,<br><br><br><br><br>
                ( .................................................. )<br>
                <span style="font-size: 9.5px; color: #555;">Tgl &amp; Jam: .................................</span>
            </td>
            <td width="34%">
                <strong>Yang Menyerahkan</strong><br>
                Petugas Farmasi (Depo Inap),<br><br><br><br><br>
                ( .................................................. )<br>
                <span style="font-size: 9.5px; color: #555;">Tgl &amp; Jam: .................................</span>
            </td>
            <td width="33%">
                Pekalongan, {{ date('d-m-Y', strtotime($permintaan->tgl_permintaan)) }}<br>
                <strong>Yang Menerima</strong><br>
                Perawat Penerima di Ruangan,<br><br><br><br><br>
                ( .................................................. )<br>
                <span style="font-size: 9.5px; color: #555;">Tgl &amp; Jam: .................................</span>
            </td>
        </tr>
    </table>

    <div style="margin-top: 15px; font-size: 9px; color: #666; border-top: 1px dashed #ccc; padding-top: 4px;">
        <i>* Lembar resmi permintaan obat UDD ini dicetak otomatis dari Sistem ERM RSIA Aisyiyah Pekajangan pada {{ date('d/m/Y H:i:s') }}. Simpan sebagai arsip serah terima obat harian antara Farmasi & Ruangan.</i>
    </div>
@endsection
