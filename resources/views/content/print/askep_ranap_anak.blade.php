@extends('content.print.main')
@section('content')
                <div style="text-align: center">
                    <h2 style="margin-bottom: 0px">RSIA AISYIYAH PEKAJANGAN</h2>
                    <p style="font-size: 12px;margin:2px">Jl. Raya Pekajangan No. 610, Kabupaten Pekalongan, Jawa Tengah </p>
                    <p style="font-size: 12px;margin:2px">Telp. (0285) 785909, Email : rba610@gmail.com </p>
                </div>
                <hr style="margin-top:20px;padding:0">
                <img src="{{ asset('img/logo.png') }}" style="position: absolute;top:10px;left:30px;margin:0px;padding:0px"
                    width="60" /><br />

                <table class="table-print" width="100%" style="margin-top:0px; border-collapse: collapse;" border="1">
                    <thead>
                        <tr>
                            <th colspan="6" style="background-color:rgb(204, 255, 204);font-size:12px; padding: 5px">
                                ASESMEN KEPERAWATAN RAWAT INAP ANAK
                            </th>
                        </tr>
                        <tr>
                            <td style="font-size:10px; width: 15%" colspan="1">No. RM</td>
                            <td style="font-size:10px; width: 35%" colspan="2">: {{ $asmed['reg_periksa']['no_rkm_medis'] }}</td>
                            <td style="font-size:10px; width: 15%" colspan="1">Tgl. Asesmen</td>
                            <td style="font-size:10px; width: 35%" colspan="2">: {{ date('d-m-Y H:i:s', strtotime($asmed['tanggal'])) }}
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:10px; width: 15%" colspan="1">No. Rawat</td>
                            <td style="font-size:10px; width: 35%" colspan="2">: {{ $asmed['no_rawat'] }}</td>
                            <td style="font-size:10px; width: 15%" colspan="1">Tgl. Registrasi</td>
                            <td style="font-size:10px; width: 35%" colspan="2">:
                                {{ date('d-m-Y', strtotime($asmed['reg_periksa']['tgl_registrasi'])) }}
                                {{ $asmed['reg_periksa']['jam_reg'] }}
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:10px" colspan="1">Nama Pasien</td>
                            <td style="font-size:10px" colspan="2">: {{ $asmed['pasien']['nm_pasien'] }} ({{ $asmed['pasien']['jk'] }})
                            </td>
                            <td style="font-size:10px" colspan="1">Tgl. Lahir / Umur</td>
                            <td style="font-size:10px" colspan="2">: {{ date('d-m-Y', strtotime($asmed['pasien']['tgl_lahir'])) }}
                                ({{ $asmed['reg_periksa']['umurdaftar'] }} {{ $asmed['reg_periksa']['sttsumur'] }})</td>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- I. RIWAYAT KESEHATAN --}}
                        <tr>
                            <td colspan="6" style="background-color:#e7e7e7; font-size:10px; font-weight:bold; text-align:center">I.
                                RIWAYAT KESEHATAN & MASUK</td>
                        </tr>
                        <tr>
                            <td style="font-size:10px" colspan="2">Cara Masuk: {{ $asmed['cara_masuk'] }}</td>
                            <td style="font-size:10px" colspan="2">Tiba diruang: {{ $asmed['tiba_diruang_rawat'] }}</td>
                            <td style="font-size:10px" colspan="2">Kasus: {{ $asmed['kasus_trauma'] }}</td>
                        </tr>
                        <tr>
                            <td style="font-size:10px" colspan="3">Keluhan Utama: {{ $asmed['rps'] }}</td>
                            <td style="font-size:10px" colspan="3">Riwayat Penyakit Dahulu: {{ $asmed['rpd'] }}</td>
                        </tr>
                        <tr>
                            <td style="font-size:10px" colspan="3">Riwayat Kelahiran: Lahir {{ $asmed['caralahir'] }}
                                ({{ $asmed['umurkelahiran'] }}), Kelainan: {{ $asmed['kelainanbawaan'] }}</td>
                            <td style="font-size:10px" colspan="3">Riwayat Alergi: {{ $asmed['riwayat_alergi'] }}</td>
                        </tr>
                        <tr>
                            <td colspan="6" style="background-color:#e7e7e7; font-size:10px; font-weight:bold; text-align:center">II.
                                RIWAYAT
                                PSIKOLOGIS, SOSIAL, EKONOMI, BUDAYA</td>
                        </tr>
                        <tr>
                            <td colspan="3" style="font-size:9px; vertical-align: top; padding: 5px">
                                - Psikologis: {{ $asmed['riwayat_psiko_kondisi_psiko'] }} | Perilaku:
                                {{ $asmed['riwayat_psiko_perilaku'] }}<br>
                                - Gangguan Jiwa: {{ $asmed['riwayat_psiko_gangguan_jiwa'] }} | Hubungan Keluarga:
                                {{ $asmed['riwayat_psiko_hubungan_keluarga'] }}<br>
                                - Tinggal Bersama: {{ $asmed['riwayat_psiko_tinggal'] }} | Agama: {{ $asmed['pasien']['agama'] }}<br>
                                - Pekerjaan PJ: {{ $asmed['pasien']['pekerjaanpj'] }} | Bahasa:
                                {{ $asmed['pasien']['bahasa']['nama_bahasa'] }}
                            </td>
                            <td colspan="3" style="font-size:9px; vertical-align: top; padding: 5px">
                                - Kepercayaan: {{ $asmed['riwayat_psiko_nilai_kepercayaan'] }}<br>
                                - Edukasi diberikan kepada: {{ $asmed['riwayat_psiko_edukasi_diberikan'] }}<br>
                                - Cara Pembayaran: {{ $asmed['reg_periksa']['penjab']['png_jawab'] }}<br>
                                - Pendidikan PJ: {{ $asmed['pasien']['pnd'] }}
                            </td>
                        </tr>


                        <tr>
                            <td colspan="6" style="background-color:#e7e7e7; font-size:10px; font-weight:bold; text-align:center">III.
                                TANDA-TANDA VITAL & STATUS MENTAL</td>
                        </tr>
                        <tr>
                            <td colspan="6" style="padding: 4; border:none">
                                <table width="100%" style="border-collapse: collapse; font-size: 9px; border: none" class="borderless">
                                    <tr>
                                        <td width="16%" style="border: 1px solid #000; padding: 4px"><b>Nadi:</b>
                                            {{ $asmed['pemeriksaan_nadi'] }} x/m</td>
                                        <td width="16%" style="border: 1px solid #000; padding: 4px"><b>RR:</b>
                                            {{ $asmed['pemeriksaan_rr'] }}
                                            x/m</td>
                                        <td width="16%" style="border: 1px solid #000; padding: 4px"><b>Suhu:</b>
                                            {{ $asmed['pemeriksaan_suhu'] }} °C</td>
                                        <td width="16%" style="border: 1px solid #000; padding: 4px"><b>SpO2:</b>
                                            {{ $asmed['pemeriksaan_spo2'] }} %</td>
                                        <td width="16%" style="border: 1px solid #000; padding: 4px"><b>BB:</b>
                                            {{ $asmed['pemeriksaan_bb'] }}
                                            Kg</td>
                                        <td width="20%" style="border: 1px solid #000; padding: 4px"><b>TB:</b>
                                            {{ $asmed['pemeriksaan_tb'] }}
                                            Cm</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" style="border: 1px solid #000; padding: 4px"><b>Kesadaran:</b>
                                            {{ $asmed['pemeriksaan_mental'] }}</td>
                                        <td colspan="3" style="border: 1px solid #000; padding: 4px"><b>GCS:</b>
                                            {{ $asmed['pemeriksaan_gcs'] }}
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>



                        <tr>
                            <td colspan="6" style="background-color:#e7e7e7; font-size:10px; font-weight:bold; text-align:center">IV.
                                PEMERIKSAAN FISIK (PER SISTEM)</td>
                        </tr>
                        <tr>
                            <td colspan="6" style="padding: 4">
                                <table width="100%" style="border-collapse: collapse; font-size: 9px" border="1">
                                    <tr>
                                        <td width="50%" style="vertical-align: top; padding: 5px">
                                            <strong>1. Kepala & Leher</strong><br>
                                            - Kepala/Wajah: {{ $asmed['pemeriksaan_susunan_kepala'] }} /
                                            {{ $asmed['pemeriksaan_susunan_wajah'] }}<br>
                                            - Leher: {{ $asmed['pemeriksaan_susunan_leher'] }}<br>
                                            <strong>2. Respirasi (Pernapasan)</strong><br>
                                            - Pola: {{ $asmed['pemeriksaan_respirasi_pola_nafas'] }}
                                            ({{ $asmed['pemeriksaan_respirasi_irama_nafas'] }})<br>
                                            - Suara: {{ $asmed['pemeriksaan_respirasi_suara_nafas'] }}<br>
                                            - Retraksi: {{ $asmed['pemeriksaan_respirasi_retraksi'] }}, Batuk:
                                            {{ $asmed['pemeriksaan_respirasi_batuk'] }}<br>
                                            <strong>3. Kardiovaskuler (Jantung & Sirkulasi)</strong><br>
                                            - Denyut: {{ $asmed['pemeriksaan_kardiovaskuler_denyut_nadi'] }}
                                            ({{ $asmed['pemeriksaan_kardiovaskuler_pulsasi'] }})<br>
                                            - Sirkulasi: {{ $asmed['pemeriksaan_kardiovaskuler_sirkulasi'] }}<br>
                                            <strong>4. Integumen (Kulit)</strong><br>
                                            - Warna: {{ $asmed['pemeriksaan_integument_warnakulit'] }}, Turgor:
                                            {{ $asmed['pemeriksaan_integument_turgor'] }}<br>
                                            - Kelainan: {{ $asmed['pemeriksaan_integument_kulit'] }}, Dekubitus:
                                            {{ $asmed['pemeriksaan_integument_dekubitas'] }}
                                        </td>
                                        <td width="50%" style="vertical-align: top; padding: 5px">
                                            <strong>5. Gastrointestinal (Pencernaan)</strong><br>
                                            - Mulut/Gigi: {{ $asmed['pemeriksaan_gastrointestinal_mulut'] }} /
                                            {{ $asmed['pemeriksaan_gastrointestinal_gigi'] }}<br>
                                            - Abdomen: {{ $asmed['pemeriksaan_gastrointestinal_abdomen'] }}, Peristaltik:
                                            {{ $asmed['pemeriksaan_gastrointestinal_peistatik_usus'] }}<br>
                                            - Anus: {{ $asmed['pemeriksaan_gastrointestinal_anus'] }}<br>
                                            <strong>6. Neurologi (Saraf)</strong><br>
                                            - Bicara: {{ $asmed['pemeriksaan_neurologi_bicara'] }}<br>
                                            - Penglihatan/Pendengaran: {{ $asmed['pemeriksaan_neurologi_pengelihatan'] }} /
                                            {{ $asmed['pemeriksaan_neurologi_pendengaran'] }}<br>
                                            - Motorik/Otot: {{ $asmed['pemeriksaan_neurologi_motorik'] }} (Kekuatan:
                                            {{ $asmed['pemeriksaan_neurologi_kekuatan_otot'] }})<br>
                                            <strong>7. Muskuloskeletal (Tulang & Sendi)</strong><br>
                                            - Gerak: {{ $asmed['pemeriksaan_muskuloskletal_pergerakan_sendi'] }}<br>
                                            - Edema/Fraktur: {{ $asmed['pemeriksaan_muskuloskletal_oedema'] }} /
                                            {{ $asmed['pemeriksaan_muskuloskletal_fraktur'] }}<br>
                                            <strong>8. Eliminasi (BAK & BAB)</strong><br>
                                            - BAK: {{ $asmed['pemeriksaan_eliminasi_bak_warna'] }}
                                            ({{ $asmed['pemeriksaan_eliminasi_bak_lainlain'] }})<br>
                                            - BAB: {{ $asmed['pemeriksaan_eliminasi_bab_konsistensi'] }}, Warna:
                                            {{ $asmed['pemeriksaan_eliminasi_bab_warna'] }}
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        {{-- TUMBUH KEMBANG & PERINATAL --}}
                        <tr>
                            <td colspan="6" style="background-color:#e7e7e7; font-size:10px; font-weight:bold; text-align:center">V.
                                RIWAYAT
                                TUMBUH KEMBANG & PERINATAL CARE</td>
                        </tr>
                        <tr>
                            <td colspan="3" style="font-size:9px; vertical-align: top; padding: 5px">
                                <strong>Riwayat Perinatal:</strong><br>
                                - Anak ke: {{ $asmed['anakke'] }} dari {{ $asmed['darisaudara'] }} bersaudara<br>
                                - Cara Lahir: {{ $asmed['caralahir'] }} | Usia Lahir: {{ $asmed['umurkelahiran'] }}<br>
                                - Kelainan Bawaan: {{ $asmed['kelainanbawaan'] }}
                            </td>
                            <td colspan="3" style="font-size:9px; vertical-align: top; padding: 5px">
                                <strong>Milestone Perkembangan:</strong><br>
                                - Tengkurap: {{ $asmed['usiatengkurap'] }} bln | Duduk: {{ $asmed['usiaduduk'] }} bln<br>
                                - Berdiri: {{ $asmed['usiaberdiri'] }} bln | Berjalan: {{ $asmed['usiaberjalan'] }} bln<br>
                                - Bicara: {{ $asmed['usiabicara'] }} bln | Menulis: {{ $asmed['usiamenulis'] }} bln
                            </td>
                        </tr>

                        {{-- POLA KEHIDUPAN & PENGKAJIAN FUNGSI --}}
                        <tr>
                            <td colspan="3" style="background-color:#e7e7e7; font-size:10px; font-weight:bold; text-align:center">VI.
                                POLA
                                KEHIDUPAN SEHARI-HARI</td>
                            <td colspan="3" style="background-color:#e7e7e7; font-size:10px; font-weight:bold; text-align:center">VII.
                                PENGKAJIAN FUNGSI</td>
                        </tr>
                        <tr>
                            <td colspan="3" style="font-size:9px; vertical-align: top; padding: 5px">
                                <strong>Aktivitas:</strong><br>
                                - Mandi: {{ $asmed['pola_aktifitas_mandi'] }} | Makan/Minum:
                                {{ $asmed['pola_aktifitas_makanminum'] }}<br>
                                - Berpakaian: {{ $asmed['pola_aktifitas_berpakaian'] }} | Eliminasi:
                                {{ $asmed['pola_aktifitas_eliminasi'] }}<br>
                                - Berpindah: {{ $asmed['pola_aktifitas_berpindah'] }}<br>
                                <strong>Nutrisi:</strong><br>
                                - Porsi: {{ $asmed['pola_nutrisi_porsi_makan'] }} | Frekuensi:
                                {{ $asmed['pola_nutrisi_frekuesi_makan'] }}<br>
                                - Jenis Makanan: {{ $asmed['pola_nutrisi_jenis_makanan'] }}<br>
                                <strong>Tidur:</strong><br>
                                - Lama: {{ $asmed['pola_tidur_lama_tidur'] }} Jam/Hari | Gangguan: {{ $asmed['pola_tidur_gangguan'] }}
                            </td>
                            <td colspan="3" style="font-size:9px; vertical-align: top; padding: 5px">
                                - Kemampuan Aktivitas: {{ $asmed['pengkajian_fungsi_kemampuan_sehari'] }}<br>
                                - Berjalan: {{ $asmed['pengkajian_fungsi_berjalan'] }} | Aktivitas:
                                {{ $asmed['pengkajian_fungsi_aktifitas'] }}<br>
                                - Ambulasi: {{ $asmed['pengkajian_fungsi_ambulasi'] }}<br>
                                - Ekstremitas Atas/Bawah: {{ $asmed['pengkajian_fungsi_ekstrimitas_atas'] }} /
                                {{ $asmed['pengkajian_fungsi_ekstrimitas_bawah'] }}<br>
                                - Menggenggam/Koordinasi: {{ $asmed['pengkajian_fungsi_menggenggam'] }} /
                                {{ $asmed['pengkajian_fungsi_koordinasi'] }}<br>
                                - <strong>Kesimpulan Gangguan:</strong> {{ $asmed['pengkajian_fungsi_kesimpulan'] }}
                            </td>
                        </tr>

                        <tr>
                            <td colspan="6" style="background-color:#e7e7e7; font-size:10px; font-weight:bold; text-align:center">VIII.
                                SKRINING
                                GIZI (STRONG-KIDS)</td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <table width="100%" style="border-collapse: collapse; font-size: 9px" border="1">
                                    <tr style="text-align: center; background-color: #f5f5f5">
                                        <th width="70%">Parameter Skrining</th>
                                        <th width="20%">Hasil</th>
                                        <th width="10%">Skor</th>
                                    </tr>
                                    <tr>
                                        <td>1. Apakah pasien tampak kurus? (Asesmen Subjektif)</td>
                                        <td style="text-align: center">{{ $asmed['skrining_gizi1'] }}</td>
                                        <td style="text-align: center">{{ $asmed['nilai_gizi1'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>2. Apakah terdapat penurunan BB/tidak ada kenaikan BB pada anak < 1 th dalam 1 bulan
                                                terakhir?</td>
                                        <td style="text-align: center">{{ $asmed['skrining_gizi2'] }}</td>
                                        <td style="text-align: center">{{ $asmed['nilai_gizi2'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>3. Apakah terdapat diare > 5x/hari dan atau muntah > 3x/hari atau asupan makan berkurang?
                                        </td>
                                        <td style="text-align: center">{{ $asmed['skrining_gizi3'] }}</td>
                                        <td style="text-align: center">{{ $asmed['nilai_gizi3'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>4. Apakah terdapat penyakit atau rencana operasi yang berisiko malnutrisi?</td>
                                        <td style="text-align: center">{{ $asmed['skrining_gizi4'] }}</td>
                                        <td style="text-align: center">{{ $asmed['nilai_gizi4'] }}</td>
                                    </tr>
                                    <tr style="font-weight: bold; background-color: #f5f5f5">
                                        <td colspan="2" style="text-align: right; padding-right: 10px">Total Skor</td>
                                        <td style="text-align: center">{{ $asmed['nilai_total_gizi'] }}</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr class="">
                            <td colspan="6" style="background-color:#e7e7e7; font-size:10px; font-weight:bold; text-align:center">IX.
                                SKALA
                                NYERI FLACC</td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <table width="100%" style="border-collapse: collapse; font-size: 9px" border="1">
                                    <tr style="text-align: center; background-color: #f5f5f5">
                                        <th width="20%">Kategori</th>
                                        <th width="70%">Indikator Hasil</th>
                                        <th width="10%">Skor</th>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: bold">Wajah (Face)</td>
                                        <td>{{ $asmed['wajah'] }}</td>
                                        <td style="text-align: center">{{ $asmed['nilaiwajah'] }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: bold">Kaki (Legs)</td>
                                        <td>{{ $asmed['kaki'] }}</td>
                                        <td style="text-align: center">{{ $asmed['nilaikaki'] }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: bold">Aktivitas (Activity)</td>
                                        <td>{{ $asmed['aktifitas'] }}</td>
                                        <td style="text-align: center">{{ $asmed['nilaiaktifitas'] }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: bold">Menangis (Cry)</td>
                                        <td>{{ $asmed['menangis'] }}</td>
                                        <td style="text-align: center">{{ $asmed['nilaimenangis'] }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: bold">Kemampuan Ditenangkan</td>
                                        <td>{{ $asmed['bersuara'] }}</td>
                                        <td style="text-align: center">{{ $asmed['nilaibersuara'] }}</td>
                                    </tr>
                                    <tr style="font-weight: bold; background-color: #f5f5f5">
                                        <td colspan="2" style="text-align: right; padding-right: 10px">Interpretasi:
                                            {{ $asmed['nyeri'] }}
                                        </td>
                                        <td style="text-align: center">{{ $asmed['hasilnyeri'] }}</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        {{-- V. RIWAYAT IMUNISASI --}}

                        <tr>
                            <td colspan="6" style="background-color:#e7e7e7; font-size:10px; font-weight:bold; text-align:center">X.
                                RIWAYAT
                                IMUNISASI</td>
                        </tr>
                        <tr>
                            <td colspan="6" style="padding: 4">
                                @php
    // Mengelompokkan riwayat imunisasi berdasarkan nama imunisasi
    $groupedImunisasi = collect($asmed['pasien']['riwayat_imunisasi'])->groupBy(function ($item) {
        return $item['master_imunisasi']['nama_imunisasi'];
    });
                                @endphp

                                <table width="100%" style="border-collapse: collapse; font-size: 9px" border="1">
                                    <thead>
                                        <tr style="background-color: #f5f5f5; text-align: center">
                                            <th width="40%" style="padding: 5px">Nama Imunisasi</th>
                                            <th width="12%">Ke 1</th>
                                            <th width="12%">Ke 2</th>
                                            <th width="12%">Ke 3</th>
                                            <th width="12%">Ke 4</th>
                                            <th width="12%">Ke 5</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($groupedImunisasi->count() > 0)
                                            @foreach($groupedImunisasi as $nama => $riwayat)
                                                <tr>
                                                    <td style="padding: 5px; font-weight: bold">{{ $nama }}</td>
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <td style="text-align: center; font-size: 12px;">
                                                            {{-- Cek apakah dosis ke-i ada di dalam riwayat imunisasi ini --}}
                                                            @if($riwayat->contains('no_imunisasi', $i))
                                                                {{-- Menggunakan simbol centang (Unicode) agar ringan saat load PDF --}}
                                                                <span style="color: #007bff; font-weight: bold;">V</span>
                                                            @else
                                                                <span style="color: #ccc;"></span>
                                                            @endif
                                                        </td>
                                                    @endfor
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="6" style="text-align: center; padding: 10px; font-style: italic">
                                                    Tidak ada data riwayat imunisasi.
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </td>
                        </tr>

                        {{-- VI. DIAGNOSA & RENCANA KEPERAWATAN --}}
                        <tr>
                            <td colspan="3" style="background-color:#e7e7e7; font-size:10px; font-weight:bold; text-align:center">XI.
                                MASALAH KEPERAWATAN</td>
                            <td colspan="3" style="background-color:#e7e7e7; font-size:10px; font-weight:bold; text-align:center">XII.
                                RENCANA KEPERAWATAN</td>
                        </tr>
                        <tr>
                            <td colspan="3" style="font-size:9px; vertical-align: top">
                                <ul style="margin: 5px; padding-left: 15px">
                                    @foreach($asmed['masalah_keperawatan'] as $masalah)
                                        <li>{{ $masalah['master_masalah']['nama_masalah'] }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td colspan="3" style="font-size:9px; vertical-align: top">
                                <ul style="margin: 5px; padding-left: 15px">
                                    @foreach($asmed['masalah_keperawatan'] as $masalah)
                                        @foreach($masalah['rencana_keperawatan'] as $rencana)
                                            <li>{{ $rencana['master_rencana']['rencana_keperawatan'] }}</li>
                                        @endforeach
                                    @endforeach
                                </ul>
                            </td>
                        </tr>

                        {{-- Tanda Tangan --}}
                        <tr>
                            <td colspan="3" style="text-align: center; font-size: 10px; height: 100px; vertical-align: top">
                                <p>Petugas Pengkaji 1</p>
                                <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG($asmed['pengkaji1']['nip'], 'QRCODE') }}"
                                    height="60" width="60" style="margin: 5px" /><br>
                                <strong>( {{ $asmed['pengkaji1']['nama'] }} )</strong><br>
                                NIP: {{ $asmed['pengkaji1']['nip'] }}
                            </td>
                            <td colspan="3" style="text-align: center; font-size: 10px; height: 100px; vertical-align: top">
                                <p>Petugas Pengkaji 2</p>
                                <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG($asmed['pengkaji2']['nip'], 'QRCODE') }}" height="60" width="60"
                                    style="margin: 5px" /><br>
                                <strong>( {{ $asmed['pengkaji2']['nama'] }} )</strong><br>
                                NIP: {{ $asmed['pengkaji2']['nip'] }}
                            </td>
                        </tr>
                    </tbody>
                </table>
@endsection