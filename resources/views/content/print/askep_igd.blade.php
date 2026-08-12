@extends('content.print.main')
@section('content')
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #000000;
            font-size: 8pt;
            line-height: 1.15;
        }
        .table-kop {
            width: 100%;
            border-collapse: collapse;
            border-bottom: 2px solid #000000;
            padding-bottom: 2px;
            margin-bottom: 3px;
        }
        .table-kop td {
            vertical-align: middle;
            border: none;
            padding: 1px;
            color: #000000;
        }
        .table-pasien {
            width: 100%;
            border-collapse: collapse;
            font-size: 8pt;
        }
        .table-pasien td {
            border: 1px solid #000000;
            padding: 1.5px 3px;
            vertical-align: top;
            color: #000000;
        }
        .doc-title {
            border: 1.5px solid #000000;
            background-color: #f2f2f2;
            color: #000000;
            text-align: center;
            font-weight: bold;
            font-size: 9.5pt;
            padding: 2.5px;
            margin: 2px 0 4px 0;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }
        .table-data {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 3px;
            font-size: 8pt;
        }
        .table-data td, .table-data th {
            border: 1px solid #000000;
            padding: 2px 4px;
            vertical-align: top;
            color: #000000;
        }
        .th-section {
            background-color: #e9ecef;
            color: #000000;
            font-weight: bold;
            font-size: 8.2pt;
            text-align: left;
            padding: 2px 4px !important;
            border: 1px solid #000000;
            letter-spacing: 0.2px;
        }
        .bg-light-row {
            background-color: #fafafa;
        }
        .label-cell {
            background-color: #f5f5f5;
            font-weight: bold;
            color: #000000;
        }
        .badge-status {
            display: inline-block;
            padding: 1px 4px;
            border-radius: 2px;
            font-weight: bold;
            font-size: 7.5pt;
            color: #000000;
            border: 1px solid #666666;
            background-color: #f8f9fa;
        }
        .list-unstyled {
            margin: 0;
            padding-left: 12px;
            color: #000000;
        }
        .list-unstyled li {
            margin-bottom: 1.5px;
            color: #000000;
        }
    </style>

    @php
        $regPeriksa = $data->regPeriksa ?? null;
        $pasien = $regPeriksa->pasien ?? null;
        $petugas = $data->pengkaji ?? null;
        $masalahList = $data->masalahKeperawatan ?? [];
        $rencanaList = $data->rencanaKeperawatan ?? [];
    @endphp

    <!-- HEADER KOP RUMAH SAKIT & DATA PASIEN -->
    <table class="table-kop">
        <tr>
            <td width="8%" style="text-align: center;">
                <img src="{{ public_path('img/logo.png') }}" width="44" />
            </td>
            <td width="54%" style="padding-left: 4px;">
                <strong style="font-size: 10.5pt; color: #000000; display: block;">RUMAH SAKIT IBU DAN ANAK AISYIYAH</strong>
                <strong style="font-size: 10.5pt; color: #000000; display: block;">PEKAJANGAN &ndash; PEKALONGAN</strong>
                <span style="font-size: 7.5pt; color: #000000; display: block; margin-top: 1px;">Jl. Raya Pekajangan No. 610 Pekajangan, Pekalongan, 51172</span>
                <span style="font-size: 7.5pt; color: #000000; display: block;">Telp. (0285) 785909 &bull; Email: pekajangan@rsiaaisyiyah.com</span>
            </td>
            <td width="38%">
                <table class="table-pasien">
                    <tr>
                        <td width="30%" class="label-cell"><strong>No. RM</strong></td>
                        <td width="70%">: <strong>{{ $pasien->no_rkm_medis ?? '-' }}</strong></td>
                    </tr>
                    <tr>
                        <td class="label-cell"><strong>Nama Pasien</strong></td>
                        <td>: <strong>{{ $pasien->nm_pasien ?? '-' }}</strong></td>
                    </tr>
                    <tr>
                        <td class="label-cell"><strong>Tgl. Lahir / JK</strong></td>
                        <td>: {{ $pasien && $pasien->tgl_lahir ? date('d-m-Y', strtotime($pasien->tgl_lahir)) : '-' }} ({{ $pasien->jk ?? '-' }})</td>
                    </tr>
                    <tr>
                        <td class="label-cell"><strong>Alamat</strong></td>
                        <td>: {{ $pasien->alamat ?? '-' }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <div class="doc-title">
        PENGKAJIAN AWAL KEPERAWATAN GAWAT DARURAT (IGD)
    </div>

    <!-- META DATA ASESMEN -->
    <table class="table-data">
        <tr style="background-color: #f8f9fa;">
            <td width="33%">
                <strong>Tgl. Masuk / Asuhan:</strong> {{ date('d-m-Y H:i', strtotime($data->tanggal)) }}
            </td>
            <td width="37%">
                <strong>Perawat Pengkaji:</strong> {{ $petugas->nama ?? $data->nip ?? '-' }}
            </td>
            <td width="30%">
                <strong>Sumber Informasi:</strong> {{ $data->informasi ?? '-' }}
            </td>
        </tr>
    </table>

    <!-- I. RIWAYAT KESEHATAN PASIEN -->
    <table class="table-data">
        <thead>
            <tr>
                <th colspan="3" class="th-section">I. RIWAYAT KESEHATAN PASIEN</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td width="24%" class="label-cell">Keluhan Utama (RPS) <span style="color:red;">*</span></td>
                <td width="2%" style="text-align: center;">:</td>
                <td width="74%">{{ $data->keluhan_utama ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label-cell">Riwayat Penyakit Dahulu (RPD)</td>
                <td style="text-align: center;">:</td>
                <td>{{ $data->rpd ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label-cell">Riwayat Penggunaan Obat (RPO)</td>
                <td style="text-align: center;">:</td>
                <td>{{ $data->rpo ?? '-' }}</td>
            </tr>
            @if(($pasien->jk ?? '') == 'P' || ($data->status_kehamilan ?? '') == 'Hamil')
            <tr>
                <td class="label-cell">Status Obstetrik / Kehamilan</td>
                <td style="text-align: center;">:</td>
                <td>
                    <strong>Status:</strong> <strong>{{ $data->status_kehamilan ?? 'Tidak Hamil' }}</strong>
                    @if(($data->status_kehamilan ?? '') == 'Hamil')
                        &nbsp;&bull;&nbsp; <strong>Gravida (G):</strong> {{ $data->gravida ?? '-' }}
                        &nbsp;&bull;&nbsp; <strong>Para (P):</strong> {{ $data->para ?? '-' }}
                        &nbsp;&bull;&nbsp; <strong>Abortus (A):</strong> {{ $data->abortus ?? '-' }}
                        &nbsp;&bull;&nbsp; <strong>HPHT:</strong> {{ $data->hpht ?? '-' }}
                    @endif
                </td>
            </tr>
            @endif
        </tbody>
    </table>

    <!-- II. PEMERIKSAAN FISIK KEPERAWATAN SISTEMATIS -->
    <table class="table-data">
        <thead>
            <tr>
                <th colspan="4" class="th-section">II. PEMERIKSAAN FISIK KEPERAWATAN SISTEMATIS</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td width="20%" class="label-cell">Tekanan Intrakranial</td>
                <td width="30%">{{ $data->tekanan ?? '-' }}</td>
                <td width="20%" class="label-cell">Pupil</td>
                <td width="30%">{{ $data->pupil ?? '-' }}</td>
            </tr>
            <tr class="bg-light-row">
                <td class="label-cell">Neurosensorik / Muskulo</td>
                <td>{{ $data->neurosensorik ?? '-' }}</td>
                <td class="label-cell">Integumen</td>
                <td>{{ $data->integumen ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label-cell">Turgor Kulit</td>
                <td>{{ $data->turgor ?? '-' }}</td>
                <td class="label-cell">Edema</td>
                <td>{{ $data->edema ?? '-' }}</td>
            </tr>
            <tr class="bg-light-row">
                <td class="label-cell">Mukosa Mulut</td>
                <td>{{ $data->mukosa ?? '-' }}</td>
                <td class="label-cell">Intoksikasi</td>
                <td>{{ $data->intoksikasi ?? 'Tidak Ada' }}</td>
            </tr>
            <tr>
                <td class="label-cell">Perdarahan</td>
                <td colspan="3">
                    <strong>{{ $data->perdarahan ?? 'Tidak Ada' }}</strong>
                    @if(($data->perdarahan ?? '') == 'Ada')
                        &nbsp;( Jumlah: <strong>{{ $data->jumlah_perdarahan ?? '-' }} cc</strong>, Warna: <strong>{{ $data->warna_perdarahan ?? '-' }}</strong> )
                    @endif
                </td>
            </tr>
            <tr class="bg-light-row">
                <td class="label-cell">Status Eliminasi</td>
                <td colspan="3">
                    <strong>BAB :</strong>
                    @if(!empty($data->bab) && $data->bab != '-')
                        {{ $data->bab }} x / {{ $data->xbab ?? 'Hari' }} &nbsp;&bull;&nbsp;
                        <strong>Konsistensi :</strong> {{ $data->kbab ?? '-' }} &nbsp;&bull;&nbsp;
                        <strong>Warna :</strong> {{ $data->wbab ?? '-' }}
                    @else
                        -
                    @endif
                    <br>
                    <strong>BAK :</strong>
                    @if(!empty($data->bak) && $data->bak != '-')
                        {{ $data->bak }} x / {{ $data->xbak ?? 'Hari' }} &nbsp;&bull;&nbsp;
                        <strong>Warna :</strong> {{ $data->wbak ?? '-' }}
                        @if(!empty($data->lbak) && $data->lbak != '-')
                            &nbsp;&bull;&nbsp; <strong>Keterangan :</strong> {{ $data->lbak }}
                        @endif
                    @else
                        -
                    @endif
                </td>
            </tr>
        </tbody>
    </table>

    <!-- III & IV & V. PSIKOSOSIAL & FUNGSIONAL (SIDE BY SIDE 50% - 50%) -->
    <table width="100%" style="border-collapse: collapse; border: none; margin-bottom: 3px;">
        <tr>
            <!-- KOLOM KIRI: PSIKOSOSIAL -->
            <td width="50%" style="vertical-align: top; padding: 0 2px 0 0; border: none;">
                <table class="table-data" style="margin-bottom: 0;">
                    <thead>
                        <tr>
                            <th colspan="2" class="th-section">III. PSIKOSOSIAL, BUDAYA &amp; SPIRITUAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td width="44%" class="label-cell">Kondisi Psikologis</td>
                            <td width="56%">{{ $data->psikologis ?? '-' }}</td>
                        </tr>
                        <tr class="bg-light-row">
                            <td class="label-cell">Riwayat Jiwa Masa Lalu</td>
                            <td>{{ $data->jiwa ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="label-cell">Perilaku Berisiko</td>
                            <td>
                                {{ $data->perilaku ?? '-' }}
                                @if(!empty($data->dilaporkan) && $data->dilaporkan != '-') <br><span style="font-size: 7pt; color: #333;">(Lapor: {{ $data->dilaporkan }}, {{ $data->sebutkan }})</span> @endif
                            </td>
                        </tr>
                        <tr class="bg-light-row">
                            <td class="label-cell">Hubungan Keluarga</td>
                            <td>{{ $data->hubungan ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="label-cell">Tinggal Bersama</td>
                            <td>{{ $data->tinggal_dengan ?? '-' }} {{ (!empty($data->ket_tinggal) && $data->ket_tinggal != '-') ? '('.$data->ket_tinggal.')' : '' }}</td>
                        </tr>
                        <tr class="bg-light-row">
                            <td class="label-cell">Nilai Budaya / Khusus</td>
                            <td>{{ $data->budaya ?? '-' }} {{ (!empty($data->ket_budaya) && $data->ket_budaya != '-') ? '('.$data->ket_budaya.')' : '' }}</td>
                        </tr>
                        <tr>
                            <td class="label-cell">Pendidikan Penanggung Jawab</td>
                            <td>{{ $data->pendidikan_pj ?? '-' }} {{ (!empty($data->ket_pendidikan_pj) && $data->ket_pendidikan_pj != '-') ? '('.$data->ket_pendidikan_pj.')' : '' }}</td>
                        </tr>
                        <tr class="bg-light-row">
                            <td class="label-cell">Edukasi Diberikan Kepada</td>
                            <td>{{ $data->edukasi ?? '-' }} {{ (!empty($data->ket_edukasi) && $data->ket_edukasi != '-') ? '('.$data->ket_edukasi.')' : '' }}</td>
                        </tr>
                    </tbody>
                </table>
            </td>

            <!-- KOLOM KANAN: FUNGSIONAL & RISIKO JATUH -->
            <td width="50%" style="vertical-align: top; padding: 0 0 0 2px; border: none;">
                <table class="table-data" style="margin-bottom: 2px;">
                    <thead>
                        <tr>
                            <th colspan="2" class="th-section">IV. PENGKAJIAN FUNGSIONAL (ADL)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td width="44%" class="label-cell">Kemampuan Aktivitas</td>
                            <td width="56%">{{ $data->kemampuan ?? '-' }}</td>
                        </tr>
                        <tr class="bg-light-row">
                            <td class="label-cell">Aktivitas Sehari-hari</td>
                            <td>{{ $data->aktifitas ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="label-cell">Penggunaan Alat Bantu Jalan</td>
                            <td>{{ $data->alat_bantu ?? 'Tidak' }} {{ (!empty($data->ket_bantu) && $data->ket_bantu != '-') ? '('.$data->ket_bantu.')' : '' }}</td>
                        </tr>
                    </tbody>
                </table>

                <table class="table-data" style="margin-bottom: 0;">
                    <thead>
                        <tr>
                            <th colspan="2" class="th-section">V. PENILAIAN RISIKO JATUH (GET UP &amp; GO)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td width="72%">a. Cara berjalan tidak seimbang / sempoyongan / limbung</td>
                            <td width="28%" style="text-align: center;"><strong>{{ $data->berjalan_a ?? 'Tidak' }}</strong></td>
                        </tr>
                        <tr class="bg-light-row">
                            <td>b. Memegang pinggiran kursi / meja saat akan duduk</td>
                            <td style="text-align: center;"><strong>{{ $data->berjalan_b ?? 'Tidak' }}</strong></td>
                        </tr>
                        <tr>
                            <td>c. Menggunakan alat bantu jalan saat masuk IGD</td>
                            <td style="text-align: center;"><strong>{{ $data->berjalan_c ?? 'Tidak' }}</strong></td>
                        </tr>
                        <tr style="background-color: #f1f4f8;">
                            <td class="label-cell"><strong>Tingkat Risiko Jatuh</strong></td>
                            <td style="text-align: center;">
                                <strong>{{ $data->hasil ?? 'Tidak beresiko' }}</strong>
                            </td>
                        </tr>
                        <tr>
                            <td class="label-cell">Pemberitahuan / Lapor Dokter</td>
                            <td style="text-align: center;">{{ $data->lapor ?? 'Tidak' }} {{ (!empty($data->ket_lapor) && $data->ket_lapor != '-') ? '('.$data->ket_lapor.')' : '' }}</td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </table>

    <!-- VI. PENGKAJIAN TINGKAT SKALA NYERI (PQRST) -->
    <table class="table-data">
        <thead>
            <tr>
                <th colspan="4" class="th-section">VI. PENGKAJIAN TINGKAT SKALA NYERI (PQRST)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td width="20%" class="label-cell">Status Nyeri</td>
                <td width="30%"><strong>{{ $data->nyeri ?? 'Tidak Ada Nyeri' }}</strong></td>
                <td width="20%" class="label-cell">Tingkat Skala Nyeri</td>
                <td width="30%">
                    <strong>Skala {{ $data->skala_nyeri ?? '0' }} / 10</strong>
                </td>
            </tr>
            @if(($data->nyeri ?? '') != 'Tidak Ada Nyeri' && ($data->nyeri ?? '') != '')
            <tr class="bg-light-row">
                <td class="label-cell">Provokes (Pemicu)</td>
                <td>{{ $data->provokes ?? '-' }} {{ (!empty($data->ket_provokes) && $data->ket_provokes != '-') ? '('.$data->ket_provokes.')' : '' }}</td>
                <td class="label-cell">Quality (Kualitas)</td>
                <td>{{ $data->quality ?? '-' }} {{ (!empty($data->ket_quality) && $data->ket_quality != '-') ? '('.$data->ket_quality.')' : '' }}</td>
            </tr>
            <tr>
                <td class="label-cell">Region (Lokasi / Radiasi)</td>
                <td>{{ $data->lokasi ?? '-' }} (Menyebar: {{ $data->menyebar ?? 'Tidak' }})</td>
                <td class="label-cell">Timing (Durasi &amp; Hilang)</td>
                <td>Durasi: {{ $data->durasi ?? '-' }}, Hilang Saat: {{ $data->nyeri_hilang ?? '-' }} {{ (!empty($data->ket_nyeri) && $data->ket_nyeri != '-') ? '('.$data->ket_nyeri.')' : '' }}</td>
            </tr>
            <tr class="bg-light-row">
                <td class="label-cell">Lapor Ke Dokter</td>
                <td colspan="3">{{ $data->pada_dokter ?? 'Tidak' }} {{ (!empty($data->ket_dokter) && $data->ket_dokter != '-') ? ' &bull; Jam Lapor: '.$data->ket_dokter : '' }}</td>
            </tr>
            @endif
        </tbody>
    </table>

    <!-- VII. SKRINING GIZI (DEWASA - MST / ANAK - STRONG-KIDS) -->
    @php
        $gizi = $data->gizi ?? null;
        
        // Deteksi kategori pasien (Anak vs Dewasa) secara cerdas
        $umurTahun = 0;
        if ($regPeriksa) {
            if (($regPeriksa->sttsumur ?? 'Th') != 'Th') {
                $umurTahun = 0; // Balita / Bayi (Bulan / Hari)
            } else {
                $umurTahun = (int) ($regPeriksa->umurdaftar ?? 0);
            }
        } elseif ($pasien && $pasien->tgl_lahir) {
            $umurTahun = \Carbon\Carbon::parse($pasien->tgl_lahir)->age;
        }
        $isAnak = ($umurTahun < 18);

        $kategoriGizi = $gizi->kategori_pasien ?? ($isAnak ? 'Anak' : 'Dewasa');
    @endphp
    <table class="table-data">
        <thead>
            <tr>
                <th colspan="4" class="th-section">
                    VII. SKRINING GIZI ({{ $kategoriGizi == 'Anak' ? 'STRONG-KIDS - ANAK' : 'MST - DEWASA' }})
                </th>
            </tr>
        </thead>
        <tbody>
            @if($kategoriGizi == 'Anak')
                <tr>
                    <td width="35%" class="label-cell">1. Pasien tampak kurus?</td>
                    <td width="15%">{{ $gizi->sg1 ?? 'Tidak' }} (Skor: {{ $gizi->nilai1 ?? 0 }})</td>
                    <td width="35%" class="label-cell">2. Penurunan BB / BB tdk naik?</td>
                    <td width="15%">{{ $gizi->sg2 ?? 'Tidak' }} (Skor: {{ $gizi->nilai2 ?? 0 }})</td>
                </tr>
                <tr class="bg-light-row">
                    <td class="label-cell">3. Diare &gt;5x/hr, muntah &gt;3x/hr, asupan &darr;?</td>
                    <td>{{ $gizi->sg3 ?? 'Tidak' }} (Skor: {{ $gizi->nilai3 ?? 0 }})</td>
                    <td class="label-cell">4. Penyakit berisiko malnutrisi?</td>
                    <td>{{ $gizi->sg4 ?? 'Tidak' }} (Skor: {{ $gizi->nilai4 ?? 0 }})</td>
                </tr>
            @else
                <tr>
                    <td width="35%" class="label-cell">1. Penurunan BB dlm 6 bln terakhir</td>
                    <td width="65%" colspan="3">{{ $gizi->sg1 ?? 'Tidak Ada' }} (Skor: {{ $gizi->nilai1 ?? 0 }})</td>
                </tr>
                <tr class="bg-light-row">
                    <td class="label-cell">2. Asupan makan berkurang</td>
                    <td colspan="3">{{ $gizi->sg2 ?? 'Tidak' }} (Skor: {{ $gizi->nilai2 ?? 0 }})</td>
                </tr>
            @endif
            <tr>
                <td class="label-cell"><strong>Total Skor &amp; Tingkat Risiko</strong></td>
                <td colspan="3">
                    <strong>Skor: {{ $gizi->total_skor ?? 0 }}</strong> &nbsp;&bull;&nbsp; 
                    <strong>Tingkat Risiko:</strong> <span class="badge-status">{{ $gizi->tingkat_risiko ?? 'Risiko Rendah' }}</span>
                    &nbsp;&bull;&nbsp; <strong>Lapor Gizi:</strong> {{ $gizi->lapor_gizi ?? 'Tidak' }} {{ (!empty($gizi->ket_lapor) && $gizi->ket_lapor != '-') ? '('.$gizi->ket_lapor.')' : '' }}
                </td>
            </tr>
        </tbody>
    </table>

    <!-- VIII. MASALAH & RENCANA KEPERAWATAN (INTERVENSI) -->
    <table class="table-data">
        <thead>
            <tr>
                <th colspan="2" class="th-section">VIII. MASALAH &amp; RENCANA KEPERAWATAN (INTERVENSI)</th>
            </tr>
            <tr style="background-color: #f1f4f8; text-align: center;">
                <th width="42%" style="padding: 2px 4px; font-weight: bold; border: 1px solid #000000;">Masalah Keperawatan Teridentifikasi</th>
                <th width="58%" style="padding: 2px 4px; font-weight: bold; border: 1px solid #000000;">Rencana Intervensi Tindakan Keperawatan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="vertical-align: top; padding: 4px 6px;">
                    @if(count($masalahList) > 0)
                        <ul class="list-unstyled">
                            @foreach($masalahList as $masalah)
                                <li>
                                    <strong>[{{ $masalah->kode_masalah }}]</strong> {{ $masalah->masterMasalah->nama_masalah ?? $masalah->kode_masalah }}
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <em style="color: #444444;">- Tidak ada masalah keperawatan yang teridentifikasi -</em>
                    @endif
                </td>
                <td style="vertical-align: top; padding: 4px 6px;">
                    @if(count($rencanaList) > 0)
                        <ul class="list-unstyled">
                            @foreach($rencanaList as $rencana)
                                <li>
                                    {{ $rencana->masterRencana->rencana_keperawatan ?? $rencana->kode_rencana }}
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <em style="color: #444444;">- Tidak ada rencana intervensi spesifik yang dipilih -</em>
                    @endif

                    @if(!empty($data->rencana) && $data->rencana != '-')
                        <div style="margin-top: 4px; border-top: 1px dashed #666666; padding-top: 2px;">
                            <strong style="color: #000000;">Catatan / Rencana Tambahan:</strong><br>
                            <span style="white-space: pre-line; color: #000000;">{{ $data->rencana }}</span>
                        </div>
                    @endif
                </td>
            </tr>
        </tbody>
    </table>

    <!-- TANDA TANGAN PERAWAT PENGKAJI DENGAN VERIFIKASI ELEKTRONIK QR CODE -->
    <table width="100%" style="border: none; border-collapse: collapse; font-size: 8pt; margin-top: 4px;">
        <tr>
            <td width="58%" style="border: none;"></td>
            <td width="42%" style="border: none; text-align: center; color: #000000;">
                Pekalongan, {{ date('d-m-Y H:i', strtotime($data->tanggal)) }}<br>
                <strong>Perawat Pengkaji UGD,</strong><br>
                <div style="height: 48px; margin: 2px 0; text-align: center;">
                    @if (!empty($petugas->nip) || !empty($data->nip))
                        @php
                            $namaPetugas = $petugas->nama ?? $data->nip;
                            $nipPetugas = $petugas->nip ?? $data->nip;
                            $qrText = 'Diverifikasi secara elektronik oleh Perawat Pengkaji: ' . $namaPetugas . ' (NIP: ' . $nipPetugas . ') pada ' . date('d-m-Y H:i', strtotime($data->tanggal));
                        @endphp
                        <img src="data:image/png;base64,{!! DNS2D::getBarcodePNG($qrText, 'QRCODE', 2.1, 2.1) !!}" height="44" style="border: 1px solid #888888; padding: 1px;" />
                    @else
                        <br><br>
                    @endif
                </div>
                ( <strong><u>{{ $petugas->nama ?? $data->nip ?? '............................................' }}</u></strong> )<br>
                <span style="font-size: 7.5pt; color: #000000;">NIP. {{ $petugas->nip ?? $data->nip ?? '-' }}</span>
            </td>
        </tr>
    </table>
@endsection
