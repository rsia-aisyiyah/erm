@extends('content.print.main')

@section('content')

    <div style="text-align: center">
        <h2 style="margin-bottom: 0px">RSIA AISYIYAH PEKAJANGAN</h2>
        <p style="font-size: 12px;margin:2px">
            Jl. Raya Pekajangan No. 610, Kabupaten Pekalongan, Jawa Tengah
        </p>
        <p style="font-size: 12px;margin:2px">
            Telp. (0285) 785909, Email : rba610@gmail.com
        </p>
    </div>

    <hr style="margin-top:20px;padding:0">

    <img src="{{ asset('img/logo.png') }}" style="position: absolute;top:10px;left:30px" width="60" />

    <br>

    <table class="table-print" width="100%" style="margin-top:0px; border-collapse: collapse;" border="1">

        <thead>

            <tr>
                <th colspan="6" style="background-color:rgb(204,255,204);font-size:12px;padding:5px">
                    ASESMEN KEPERAWATAN RAWAT INAP KEBIDANAN
                </th>
            </tr>

            <tr>
                <td style="font-size:10px;width:15%">No. Rawat</td>
                <td style="font-size:10px;width:35%" colspan="2">
                    : {{ $askep['no_rawat'] }}
                </td>

                <td style="font-size:10px;width:15%">Tgl. Asesmen</td>
                <td style="font-size:10px;width:35%" colspan="2">
                    : {{ date('d-m-Y H:i:s', strtotime($askep['tanggal'])) }}
                </td>
            </tr>

            <tr>
                <td style="font-size:10px">Informasi</td>
                <td style="font-size:10px" colspan="2">
                    : {{ $askep['informasi'] }}
                </td>

                <td style="font-size:10px">Cara Masuk</td>
                <td style="font-size:10px" colspan="2">
                    : {{ $askep['cara_masuk'] }}
                </td>
            </tr>

            <tr>
                <td style="font-size:10px">Tiba Diruang</td>
                <td style="font-size:10px" colspan="5">
                    : {{ $askep['tiba_diruang_rawat'] }}
                </td>
            </tr>

        </thead>

        <tbody>

            {{-- I --}}
            <tr>
                <td colspan="6" style="background:#e7e7e7;font-size:10px;font-weight:bold;text-align:center">
                    I. RIWAYAT KESEHATAN
                </td>
            </tr>

            <tr>
                <td colspan="6" style="font-size:10px">
                    <b>Keluhan Utama :</b><br>
                    {{ $askep['keluhan'] }}
                </td>
            </tr>

            <tr>
                <td colspan="3" style="font-size:10px">
                    <b>Riwayat Penyakit Keluarga :</b><br>
                    {{ $askep['rpk'] }}
                </td>

                <td colspan="3" style="font-size:10px">
                    <b>Riwayat Penyakit Sekarang :</b><br>
                    {{ $askep['psk'] }}
                </td>
            </tr>

            <tr>
                <td colspan="3" style="font-size:10px">
                    <b>Riwayat Pengobatan :</b><br>
                    {{ $askep['rp'] }}
                </td>

                <td colspan="3" style="font-size:10px">
                    <b>Alergi :</b><br>
                    {{ $askep['alergi'] }}
                </td>
            </tr>

            {{-- II --}}
            <tr>
                <td colspan="6" style="background:#e7e7e7;font-size:10px;font-weight:bold;text-align:center">
                    II. RIWAYAT MENSTRUASI & PERKAWINAN
                </td>
            </tr>

            <tr>
                <td colspan="3" style="font-size:9px;vertical-align:top;padding:5px">

                    <b>Riwayat Menstruasi</b><br>

                    - Menarche :
                    {{ $askep['riwayat_mens_umur'] }} Tahun<br>

                    - Lama :
                    {{ $askep['riwayat_mens_lamanya'] }} Hari<br>

                    - Banyaknya :
                    {{ $askep['riwayat_mens_banyaknya'] }} Kali Ganti Pembalut<br>

                    - Siklus :
                    {{ $askep['riwayat_mens_siklus'] }} Hari
                    ({{ $askep['riwayat_mens_ket_siklus'] }})<br>

                    - Keluhan :
                    {{ $askep['riwayat_mens_dirasakan'] }}

                </td>

                <td colspan="3" style="font-size:9px;vertical-align:top;padding:5px">

                    <b>Riwayat Perkawinan</b><br>

                    - Status :
                    {{ $askep['riwayat_perkawinan_status'] }}<br>

                    - Menikah Ke :
                    {{ $askep['riwayat_perkawinan_ket_status'] }}<br>

                    - Usia Menikah :
                    {{ $askep['riwayat_perkawinan_usia1'] }} Tahun<br>

                    - Status Saat Ini :
                    {{ $askep['riwayat_perkawinan_ket_usia1'] }}

                </td>
            </tr>

            {{-- III --}}
            <tr>
                <td colspan="6" style="background:#e7e7e7;font-size:10px;font-weight:bold;text-align:center">
                    III. RIWAYAT KEHAMILAN & KB
                </td>
            </tr>

            <tr>

                <td colspan="3" style="font-size:9px;vertical-align:top;padding:5px">

                    <b>Riwayat Persalinan</b><br>

                    G :
                    {{ $askep['riwayat_persalinan_g'] }}

                    P :
                    {{ $askep['riwayat_persalinan_p'] }}

                    A :
                    {{ $askep['riwayat_persalinan_a'] }}<br>

                    Hidup :
                    {{ $askep['riwayat_persalinan_hidup'] }}

                    <br><br>

                    <b>Riwayat Kehamilan</b><br>

                    HPHT :
                    {{ date('d-m-Y', strtotime($askep['riwayat_hamil_hpht'])) }}<br>

                    Usia Hamil :
                    {{ $askep['riwayat_hamil_usiahamil'] }}<br>

                    Taksiran Persalinan :
                    {{ date('d-m-Y', strtotime($askep['riwayat_hamil_tp'])) }}<br>

                    ANC :
                    {{ $askep['riwayat_hamil_anc'] }} Kali,
                    Trimester :
                    {{ $askep['riwayat_hamil_ancke'] }}<br>

                    Keterangan ANC :
                    {{ $askep['riwayat_hamil_ket_ancke'] }}

                </td>

                <td colspan="3" style="font-size:9px;vertical-align:top;padding:5px">

                    <b>Keluhan Kehamilan</b><br>

                    Hamil Muda :
                    {{ $askep['riwayat_hamil_keluhan_hamil_muda'] }}<br>

                    Hamil Tua :
                    {{ $askep['riwayat_hamil_keluhan_hamil_tua'] }}

                    <br><br>

                    <b>Riwayat KB</b><br>

                    Jenis :
                    {{ $askep['riwayat_kb'] }}<br>

                    Lama :
                    {{ $askep['riwayat_kb_lamanya'] }}<br>

                    Komplikasi :
                    {{ $askep['riwayat_kb_komplikasi'] }}<br>

                    Ket :
                    {{ $askep['riwayat_kb_ket_komplikasi'] }}

                </td>

            </tr>

            {{-- IV --}}
            <tr>
                <td colspan="6" style="background:#e7e7e7;font-size:10px;font-weight:bold;text-align:center">
                    IV. PEMERIKSAAN KEBIDANAN
                </td>
            </tr>

            <tr>
                <td colspan="6" style="padding:4px">

                    <table width="100%" style="border-collapse: collapse;font-size:9px" border="1">

                        <tr>

                            <td>
                                TD :
                                {{ $askep['pemeriksaan_kebidanan_td'] }}
                            </td>

                            <td>
                                Nadi :
                                {{ $askep['pemeriksaan_kebidanan_nadi'] }}
                            </td>

                            <td>
                                RR :
                                {{ $askep['pemeriksaan_kebidanan_rr'] }}
                            </td>

                            <td>
                                Suhu :
                                {{ $askep['pemeriksaan_kebidanan_suhu'] }}
                            </td>

                            <td>
                                SPO2 :
                                {{ $askep['pemeriksaan_kebidanan_spo2'] }}
                            </td>

                        </tr>

                        <tr>

                            <td>
                                BB :
                                {{ $askep['pemeriksaan_kebidanan_bb'] }} Kg
                            </td>

                            <td>
                                TB :
                                {{ $askep['pemeriksaan_kebidanan_tb'] }} Cm
                            </td>

                            <td>
                                LILA :
                                {{ $askep['pemeriksaan_kebidanan_lila'] }} Cm
                            </td>

                            <td>
                                GCS :
                                {{ $askep['pemeriksaan_kebidanan_gcs'] }}
                            </td>

                            <td>
                                Mental :
                                {{ $askep['pemeriksaan_kebidanan_mental'] }}
                            </td>

                        </tr>

                    </table>

                </td>
            </tr>

            <tr>

                <td colspan="3" style="font-size:9px;vertical-align:top;padding:5px">

                    <b>Status Obstetri</b><br>

                    TFU :
                    {{ $askep['pemeriksaan_kebidanan_tfu'] }} Cm<br>

                    TBJ :
                    {{ $askep['pemeriksaan_kebidanan_tbj'] }} Gram<br>

                    Letak :
                    {{ $askep['pemeriksaan_kebidanan_letak'] }}<br>

                    Presentasi :
                    {{ $askep['pemeriksaan_kebidanan_presentasi'] }}<br>

                    Penurunan :
                    {{ $askep['pemeriksaan_kebidanan_penurunan'] }}

                </td>

                <td colspan="3" style="font-size:9px;vertical-align:top;padding:5px">

                    <b>His & DJJ</b><br>

                    His :
                    {{ $askep['pemeriksaan_kebidanan_his'] }} x<br>

                    Kekuatan :
                    {{ $askep['pemeriksaan_kebidanan_kekuatan'] }}<br>

                    Lamanya :
                    {{ $askep['pemeriksaan_kebidanan_lamanya'] }} detik<br>

                    DJJ :
                    {{ $askep['pemeriksaan_kebidanan_djj'] }} x/menit
                    ({{ $askep['pemeriksaan_kebidanan_ket_djj'] }})

                </td>

            </tr>

            <tr>

                <td colspan="3" style="font-size:9px;vertical-align:top;padding:5px">

                    <b>Pemeriksaan Dalam</b><br>

                    Portio :
                    {{ $askep['pemeriksaan_kebidanan_portio'] }}<br>

                    Pembukaan :
                    {{ $askep['pemeriksaan_kebidanan_pembukaan'] }}<br>

                    Ketuban :
                    {{ $askep['pemeriksaan_kebidanan_ketuban'] }}<br>

                    Hodge :
                    {{ $askep['pemeriksaan_kebidanan_hodge'] }}

                </td>

                <td colspan="3" style="font-size:9px;vertical-align:top;padding:5px">

                    <b>Pemeriksaan Penunjang</b><br>

                    Panggul :
                    {{ $askep['pemeriksaan_kebidanan_panggul'] }}<br>

                    Inspekulo :
                    {{ $askep['pemeriksaan_kebidanan_inspekulo'] }}
                    ({{ $askep['pemeriksaan_kebidanan_ket_inspekulo'] }})<br>

                    Lakmus :
                    {{ $askep['pemeriksaan_kebidanan_lakmus'] }}
                    ({{ $askep['pemeriksaan_kebidanan_ket_lakmus'] }})<br>

                    CTG :
                    {{ $askep['pemeriksaan_kebidanan_ctg'] }}
                    ({{ $askep['pemeriksaan_kebidanan_ket_ctg'] }})

                </td>

            </tr>

            {{-- V --}}
            <tr>
                <td colspan="6" style="background:#e7e7e7;font-size:10px;font-weight:bold;text-align:center">
                    V. PEMERIKSAAN UMUM
                </td>
            </tr>

            <tr>

                <td colspan="3" style="font-size:9px;vertical-align:top;padding:5px">

                    Kepala :
                    {{ $askep['pemeriksaan_umum_kepala'] }}<br>

                    Muka :
                    {{ $askep['pemeriksaan_umum_muka'] }}<br>

                    Mata :
                    {{ $askep['pemeriksaan_umum_mata'] }}<br>

                    Hidung :
                    {{ $askep['pemeriksaan_umum_hidung'] }}<br>

                    Telinga :
                    {{ $askep['pemeriksaan_umum_telinga'] }}

                </td>

                <td colspan="3" style="font-size:9px;vertical-align:top;padding:5px">

                    Mulut :
                    {{ $askep['pemeriksaan_umum_mulut'] }}<br>

                    Leher :
                    {{ $askep['pemeriksaan_umum_leher'] }}<br>

                    Dada :
                    {{ $askep['pemeriksaan_umum_dada'] }}<br>

                    Perut :
                    {{ $askep['pemeriksaan_umum_perut'] }}<br>

                    Genitalia :
                    {{ $askep['pemeriksaan_umum_genitalia'] }}<br>

                    Ekstrimitas :
                    {{ $askep['pemeriksaan_umum_ekstrimitas'] }}

                </td>

            </tr>

            {{-- VI --}}
            <tr>
                <td colspan="6" style="background:#e7e7e7;font-size:10px;font-weight:bold;text-align:center">
                    VI. PENGKAJIAN FUNGSI
                </td>
            </tr>

            <tr>

                <td colspan="3" style="font-size:9px;vertical-align:top;padding:5px">

                    Kemampuan Aktivitas :
                    {{ $askep['pengkajian_fungsi_kemampuan_aktifitas'] }}<br>

                    Berjalan :
                    {{ $askep['pengkajian_fungsi_berjalan'] }}<br>

                    Aktivitas :
                    {{ $askep['pengkajian_fungsi_aktivitas'] }}<br>

                    Ambulasi :
                    {{ $askep['pengkajian_fungsi_ambulasi'] }}

                </td>

                <td colspan="3" style="font-size:9px;vertical-align:top;padding:5px">

                    Ekstrimitas Atas :
                    {{ $askep['pengkajian_fungsi_ekstrimitas_atas'] }}<br>

                    Ekstrimitas Bawah :
                    {{ $askep['pengkajian_fungsi_ekstrimitas_bawah'] }}<br>

                    Menggenggam :
                    {{ $askep['pengkajian_fungsi_kemampuan_menggenggam'] }}<br>

                    Koordinasi :
                    {{ $askep['pengkajian_fungsi_koordinasi'] }}

                </td>

            </tr>

            {{-- VII --}}
            <tr>
                <td colspan="6" style="background:#e7e7e7;font-size:10px;font-weight:bold;text-align:center">
                    VII. PSIKOSOSIAL & NYERI
                </td>
            </tr>

            <tr>

                <td colspan="3" style="font-size:9px;vertical-align:top;padding:5px">

                    Kondisi Psikologis :
                    {{ $askep['riwayat_psiko_kondisipsiko'] }}<br>

                    Gangguan Jiwa :
                    {{ $askep['riwayat_psiko_gangguan_jiwa'] }}<br>

                    Hubungan Pasien :
                    {{ $askep['riwayat_psiko_hubungan_pasien'] }}<br>

                    Tinggal Dengan :
                    {{ $askep['riwayat_psiko_tinggal_dengan'] }}

                </td>

                <td colspan="3" style="font-size:9px;vertical-align:top;padding:5px;">

                    Skala Nyeri :
                    {{ $askep['penilaian_nyeri_skala'] }}<br>

                    Nyeri :
                    {{ $askep['penilaian_nyeri'] }}<br>

                    Penyebab :
                    {{ $askep['penilaian_nyeri_penyebab'] }}<br>

                    Hilang Dengan :
                    {{ $askep['penilaian_nyeri_hilang'] }}

                </td>

            </tr>

            {{-- VIII --}}
            <tr>
                <td colspan="6" style="background:#e7e7e7;font-size:10px;font-weight:bold;text-align:center">
                    VIII. SKRINING GIZI & RISIKO JATUH
                </td>
            </tr>

            <tr>

                <td colspan="3" style="font-size:9px;vertical-align:top;padding:5px;height:90px">

                    Skrining Gizi 1 :
                    {{ $askep['skrining_gizi1'] }}<br>

                    Skrining Gizi 2 :
                    {{ $askep['skrining_gizi2'] }}<br>

                    Total Nilai :
                    {{ $askep['nilai_total_gizi'] }}

                </td>

                <td colspan="3" style="font-size:9px;vertical-align:top;padding:5px;height:90px">

                    Risiko Jatuh :
                    {{ $askep['penilaian_jatuh_totalnilai'] }}<br>

                    Diagnosa Khusus :
                    {{ $askep['skrining_gizi_diagnosa_khusus'] }}

                </td>

            </tr>

            {{-- IX --}}
            <tr>
                <td colspan="3" style="background:#e7e7e7;font-size:10px;font-weight:bold;text-align:center">
                    IX. MASALAH KEPERAWATAN
                </td>

                <td colspan="3" style="background:#e7e7e7;font-size:10px;font-weight:bold;text-align:center">
                    X. RENCANA KEPERAWATAN
                </td>
            </tr>

            <tr>

                <td colspan="3" style="font-size:10px;height:80px;vertical-align:top">

                    {!! nl2br(e($askep['masalah'])) !!}

                </td>

                <td colspan="3" style="font-size:10px;height:80px;vertical-align:top">

                    {!! nl2br(e($askep['rencana'])) !!}

                </td>

            </tr>

            {{-- TTD --}}
            <tr>

                <td colspan="3" style="text-align:center;font-size:10px;height:120px;vertical-align:top">

                    <p>Petugas Pengkaji 1</p>

                    <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG($askep['sidik1'], 'QRCODE') }}" height="60"
                        width="60" style="margin:5px" />

                    <br>

                    <strong>
                        ( {{ $askep['pengkaji1']['nama'] }} )
                    </strong>

                    <br>

                    NIP :
                    {{ $askep['pengkaji1']['nip'] }}

                </td>

                <td colspan="3" style="text-align:center;font-size:10px;height:120px;vertical-align:top">

                    <p>Petugas Pengkaji 2</p>

                    <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG($askep['sidik2'], 'QRCODE') }}" height="60"
                        width="60" style="margin:5px" />

                    <br>

                    <strong>
                        ( {{ $askep['pengkaji2']['nama'] }} )
                    </strong>

                    <br>

                    NIP :
                    {{ $askep['pengkaji2']['nip'] }}

                </td>

            </tr>

        </tbody>

    </table>

@endsection