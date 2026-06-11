@extends('content.print.main')

@section('content')

    {{-- HEADER --}}
    <div style="text-align: center">
        <h2 style="margin-bottom: 0px">RSIA AISYIYAH PEKAJANGAN</h2>
        <p style="font-size: 12px;margin:2px">
            JL. RAYA PEKAJANGAN NO. 610 PEKALONGAN, PEKALONGAN, JAWA TENGAH
        </p>
        <p style="font-size: 12px;margin:2px">
            (0285) 785909
        </p>
        <p style="font-size: 12px;margin:2px">
            E-mail : rba610@gmail.com
        </p>
    </div>

    <hr style="margin-top:10px;padding:0">

    <img src="{{ asset('img/logo.png') }}" style="position:absolute;top:10px;left:30px" width="60" />

    <br>

    <table width="100%" style="border-collapse:collapse;margin-top:0px;font-size:10px" border="1">

        {{-- JUDUL --}}
        <thead>
            <tr>
                <th colspan="6"
                    style="font-size:11px;padding:5px;text-align:center;text-transform:uppercase;background:#f3fdd7">
                    PENGKAJIAN AWAL PASIEN RAWAT JALAN KEBIDANAN &amp; KANDUNGAN
                </th>
            </tr>

            {{-- IDENTITAS --}}
            <tr>
                <td style="font-size:10px;width:16%;padding:3px 5px">
                    <b>No. RM</b>
                </td>
                <td style="font-size:10px;width:34%;padding:3px 5px" colspan="2">
                    : {{ $data->pasien->no_rkm_medis ?? '-' }}
                </td>
                <td style="font-size:10px;width:16%;padding:3px 5px">
                    <b>Jenis Kelamin</b>
                </td>
                <td style="font-size:10px;width:34%;padding:3px 5px" colspan="2">
                    : {{ isset($data->pasien->jk) ? ($data->pasien->jk == 'L' ? 'Laki-laki' : 'Perempuan') : '-' }}
                </td>
            </tr>

            <tr>
                <td style="font-size:10px;padding:3px 5px">
                    <b>Nama Pasien</b>
                </td>
                <td style="font-size:10px;padding:3px 5px" colspan="2">
                    : {{ $data->pasien->nm_pasien ?? '-' }}
                </td>
                <td style="font-size:10px;padding:3px 5px">
                    <b>Tanggal Lahir</b>
                </td>
                <td style="font-size:10px;padding:3px 5px" colspan="2">
                    : {{ isset($data->pasien->tgl_lahir) ? date('d/m/Y', strtotime($data->pasien->tgl_lahir)) : '-' }}
                </td>
            </tr>

            <tr>
                <td style="font-size:10px;padding:3px 5px">
                    <b>Tanggal Kunjungan</b>
                </td>
                <td style="font-size:10px;padding:3px 5px" colspan="2">
                    : {{ isset($data->tanggal) ? date('d/m/Y', strtotime($data->tanggal)) : '-' }}
                </td>
                <td style="font-size:10px;padding:3px 5px">
                    <b>Informasi didapat dari</b>
                </td>
                <td style="font-size:10px;padding:3px 5px" colspan="2">
                    : {{ $data->informasi_dari ?? 'Autoanamnesis' }}
                </td>
            </tr>
        </thead>

        <tbody>

            {{-- I. KEADAAN UMUM --}}
            <tr>
                <td colspan="6"
                    style="background:#f1ffc9;font-size:10px;font-weight:bold;text-align:center;padding:3px 5px">
                    I. KEADAAN UMUM
                </td>
            </tr>

            <tr>
                <td colspan="6" style="font-size:10px;padding:3px 5px">
                    TD : {{ $data->td ?? '-' }} mmHg &nbsp;&nbsp;
                    Nadi : {{ $data->nadi ?? '-' }} x/menit &nbsp;&nbsp;
                    RR : {{ $data->rr ?? '-' }} x/menit &nbsp;&nbsp;
                    Suhu : {{ $data->suhu ?? '-' }} °C &nbsp;&nbsp;
                    GCS(E,V,M) : {{ $data->gcs ?? '-' }}
                </td>
            </tr>

            <tr>
                <td colspan="6" style="font-size:10px;padding:3px 5px">
                    BB : {{ $data->bb ?? '-' }} Kg &nbsp;&nbsp;
                    TB : {{ $data->tb ?? '-' }} cm &nbsp;&nbsp;
                    BMI : {{ $data->bmi ?? '-' }} Kg/m²
                </td>
            </tr>

            {{-- II. PEMERIKSAAN KEBIDANAN --}}
            <tr>
                <td colspan="6"
                    style="background:#f3fdd7;font-size:10px;font-weight:bold;text-align:center;padding:3px 5px">
                    II. PEMERIKSAAN KEBIDANAN
                </td>
            </tr>

            <tr>
                <td colspan="6" style="font-size:10px;padding:3px 5px">
                    LILA : {{ $data->lila ?? '-' }} cm
                </td>
            </tr>

            <tr>
                <td colspan="6" style="font-size:10px;padding:3px 5px">
                    TFU : {{ $data->tfu ?? '-' }} cm,
                    TBJ : {{ $data->tbj ?? '-' }} gr.
                    Letak {{ $data->letak ?? '-' }}
                    presentasi {{ $data->presentasi ?? '-' }}
                    penurunan {{ $data->penurunan ?? '-' }}
                </td>
            </tr>

            <tr>
                <td colspan="6" style="font-size:10px;padding:3px 5px">
                    Kontraksi/HIS {{ $data->his ?? '-' }} x/10',
                    Kekuatan {{ $data->kekuatan_his ?? '-' }}
                    Lamanya {{ $data->lama_his ?? '-' }} detik.
                    Gerak janin {{ $data->gerak_janin ?? '-' }} x/30 menit,
                    DJJ {{ $data->djj ?? '-' }} /mnt {{ $data->irama_djj ?? '-' }}
                </td>
            </tr>

            <tr>
                <td colspan="6" style="font-size:10px;padding:3px 5px">
                    Portio {{ $data->portio ?? '-' }}
                    Pembukaan serviks {{ $data->pembukaan ?? '-' }} cm,
                    Ketuban {{ $data->ketuban ?? '-' }}
                    kep / bok.
                    Hodge {{ $data->hodge ?? '-' }}
                </td>
            </tr>

            <tr>
                <td colspan="6" style="font-size:10px;padding:3px 5px">
                    <b>Pemeriksaan penunjang :</b>
                </td>
            </tr>

            <tr>
                <td colspan="2" style="font-size:10px;padding:3px 5px">
                    Inspekulo : {{ $data->inspekulo_ada ?? 'Tidak' }} Hasil {{ $data->inspekulo_hasil ?? '' }}
                </td>
                <td colspan="2" style="font-size:10px;padding:3px 5px">
                    CTG : {{ $data->ctg_ada ?? 'Tidak' }} Hasil {{ $data->ctg_hasil ?? '' }}
                </td>
                <td colspan="2" style="font-size:10px;padding:3px 5px">
                    Lakmus : {{ $data->lakmus_ada ?? 'Tidak' }} Hasil {{ $data->lakmus_hasil ?? '' }}
                </td>
            </tr>

            <tr>
                <td colspan="2" style="font-size:10px;padding:3px 5px">
                    Laboratorium : {{ $data->lab_ada ?? 'Tidak' }} Hasil {{ $data->lab_hasil ?? '' }}
                </td>
                <td colspan="2" style="font-size:10px;padding:3px 5px">
                    USG : {{ $data->usg_ada ?? 'Tidak' }} Hasil {{ $data->usg_hasil ?? '' }}
                </td>
                <td colspan="2" style="font-size:10px;padding:3px 5px">
                    Panggul : {{ $data->panggul ?? 'Tidak Dilakukan Pemeriksaan' }}
                </td>
            </tr>

            {{-- III. RIWAYAT KESEHATAN --}}
            <tr>
                <td colspan="6"
                    style="background:#f3fdd7;font-size:10px;font-weight:bold;text-align:center;padding:3px 5px">
                    III. RIWAYAT KESEHATAN
                </td>
            </tr>

            <tr>
                <td colspan="6" style="font-size:10px;padding:3px 5px;height:130px;vertical-align:top">
                    <b>Keluhan Utama :</b> <br>{!! nl2br(e($data->keluhan_utama ?? '-')) !!}
                </td>
            </tr>

            <tr>
                <td style="font-size:10px;padding:3px 5px;width:16%;vertical-align:top">
                    <b>Riwayat Menstruasi</b>
                </td>
                <td colspan="5" style="font-size:10px;padding:3px 5px;vertical-align:top">
                    Menarche : {{ $data->menarche ?? '-' }} tahun,
                    lamanya : {{ $data->lama_mens ?? '-' }} hari,
                    banyaknya : {{ $data->banyak_mens ?? '-' }} pembalut.
                    Haid terakhir : {{ isset($data->hpht) ? date('d-m-Y', strtotime($data->hpht)) : '-' }}<br>
                    Siklus : {{ $data->siklus_mens ?? '-' }} hari,
                    ( {{ $data->keteraturan_mens ?? '-' }} ),
                    {{ $data->masalah_mens ?? 'Tidak Ada Masalah' }}
                </td>
            </tr>

            <tr>
                <td style="font-size:10px;padding:3px 5px;vertical-align:top">
                    <b>Riwayat Perkawinan</b>
                </td>
                <td colspan="5" style="font-size:10px;padding:3px 5px;vertical-align:top">
                    Status Menikah : {{ $data->status_nikah ?? '-' }}
                    {{ $data->jumlah_nikah ?? '-' }} kali
                    Usia Perkawinan I : {{ $data->usia_nikah_1 ?? '-' }} tahun, {{ $data->status_nikah_1 ?? '-' }}<br>
                    Usia Perkawinan II : {{ $data->usia_nikah_2 ?? '-' }} tahun, {{ $data->status_nikah_2 ?? '-' }}
                    &nbsp;&nbsp;
                    Usia Perkawinan III : {{ $data->usia_nikah_3 ?? '-' }} tahun, {{ $data->status_nikah_3 ?? '-' }}
                </td>
            </tr>

            <tr>
                <td style="font-size:10px;padding:3px 5px;vertical-align:top">
                    <b>Riwayat Kehamilan Tetap</b>
                </td>
                <td colspan="5" style="font-size:10px;padding:3px 5px;vertical-align:top">
                    HPHT : {{ isset($data->hpht) ? date('d/m/Y', strtotime($data->hpht)) : '-' }}
                    &nbsp;&nbsp;
                    Usia Kehamilan : {{ $data->usia_kehamilan ?? '-' }}
                    &nbsp;&nbsp;
                    TP : {{ isset($data->tp) ? date('d/m/Y', strtotime($data->tp)) : '-' }}
                    &nbsp;&nbsp;
                    Riwayat Imunisasi : {{ $data->imunisasi ?? '-' }}, berapa kali {{ $data->jumlah_imunisasi ?? '-' }}<br>
                    G : {{ $data->gravida ?? '-' }}
                    &nbsp;
                    P : {{ $data->para ?? '-' }}
                    &nbsp;
                    A : {{ $data->abortus ?? '-' }}
                    &nbsp;
                    Hidup : {{ $data->hidup ?? '-' }}

                    {{-- Sub tabel riwayat persalinan --}}
                    @if (isset($data->riwayatPersalinan) && $data->riwayatPersalinan->count() > 0)
                        <table width="100%" style="border-collapse:collapse;font-size:9px;margin-top:4px" border="1">
                            <thead>
                                <tr style="background:#f0f0f0">
                                    <th rowspan="2" style="padding:2px 3px;text-align:center">No</th>
                                    <th rowspan="2" style="padding:2px 3px;text-align:center">Tgl/Thn Persalinan</th>
                                    <th rowspan="2" style="padding:2px 3px;text-align:center">Tempat Persalinan</th>
                                    <th rowspan="2" style="padding:2px 3px;text-align:center">Usia Hamil</th>
                                    <th rowspan="2" style="padding:2px 3px;text-align:center">Jenis Persalinan</th>
                                    <th rowspan="2" style="padding:2px 3px;text-align:center">Penolong</th>
                                    <th rowspan="2" style="padding:2px 3px;text-align:center">Penyulit</th>
                                    <th colspan="3" style="padding:2px 3px;text-align:center">Anak</th>
                                </tr>
                                <tr style="background:#f0f0f0">
                                    <th style="padding:2px 3px;text-align:center">JK</th>
                                    <th style="padding:2px 3px;text-align:center">BB/PB</th>
                                    <th style="padding:2px 3px;text-align:center">Keadaan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data->riwayatPersalinan as $i => $rp)
                                    <tr>
                                        <td style="padding:2px 3px;text-align:center">{{ $i + 1 }}</td>
                                        <td style="padding:2px 3px;text-align:center">
                                            {{ isset($rp->tgl_persalinan) ? date('Y-m-d', strtotime($rp->tgl_persalinan)) : '-' }}
                                        </td>
                                        <td style="padding:2px 3px;text-align:center">{{ $rp->tempat_persalinan ?? '-' }}</td>
                                        <td style="padding:2px 3px;text-align:center">{{ $rp->usia_hamil ?? '-' }}</td>
                                        <td style="padding:2px 3px;text-align:center">{{ $rp->jenis_persalinan ?? '-' }}</td>
                                        <td style="padding:2px 3px;text-align:center">{{ $rp->penolong ?? '-' }}</td>
                                        <td style="padding:2px 3px;text-align:center">{{ $rp->penyulit ?? '-' }}</td>
                                        <td style="padding:2px 3px;text-align:center">{{ $rp->jk ?? '-' }}</td>
                                        <td style="padding:2px 3px;text-align:center">{{ $rp->bb_pb ?? '-' }}</td>
                                        <td style="padding:2px 3px;text-align:center">{{ $rp->keadaan ?? '-' }}</td>
                                    </tr>
                                @endforeach
                                @for ($j = $data->riwayatPersalinan->count(); $j < 4; $j++)
                                    <tr>
                                        <td style="padding:2px 3px">&nbsp;</td>
                                        <td style="padding:2px 3px">&nbsp;</td>
                                        <td style="padding:2px 3px">&nbsp;</td>
                                        <td style="padding:2px 3px">&nbsp;</td>
                                        <td style="padding:2px 3px">&nbsp;</td>
                                        <td style="padding:2px 3px">&nbsp;</td>
                                        <td style="padding:2px 3px">&nbsp;</td>
                                        <td style="padding:2px 3px">&nbsp;</td>
                                        <td style="padding:2px 3px">&nbsp;</td>
                                        <td style="padding:2px 3px">&nbsp;</td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    @endif
                </td>
            </tr>

            <tr>
                <td style="font-size:10px;padding:3px 5px;vertical-align:top">
                    <b>Riwayat Ginekologi</b>
                </td>
                <td colspan="5" style="font-size:10px;padding:3px 5px">
                    : {{ $data->riwayat_ginekologi ?? 'Tidak Ada' }}
                </td>
            </tr>

            <tr>
                <td style="font-size:10px;padding:3px 5px;vertical-align:top">
                    <b>Riwayat Kebiasaan</b>
                </td>
                <td colspan="5" style="font-size:10px;padding:3px 5px">
                    : {{ $data->kebiasaan ?? 'Vitamin' }}.
                    Merokok : {{ $data->merokok ?? 'Tidak' }}.
                    Alkohol : {{ $data->alkohol ?? 'Tidak' }}.
                    Obat tidur/Narkoba : {{ $data->narkoba ?? 'Tidak' }}
                </td>
            </tr>

            <tr>
                <td style="font-size:10px;padding:3px 5px;vertical-align:top">
                    <b>Riwayat K.B.</b>
                </td>
                <td colspan="5" style="font-size:10px;padding:3px 5px">
                    : {{ $data->kb ?? '-' }}.
                    Lamanya : {{ $data->lama_kb ?? '-' }}.
                    Komplikasi KB : {{ $data->komplikasi_kb ?? 'Tidak Ada' }}.
                    Berhenti KB : {{ $data->berhenti_kb ?? '-' }}.
                    Alasan : {{ $data->alasan_berhenti_kb ?? '-' }}
                </td>
            </tr>

            {{-- IV. FUNGSIONAL --}}
            <tr>
                <td colspan="6"
                    style="background:#f3fdd7;font-size:10px;font-weight:bold;text-align:center;padding:3px 5px">
                    IV. FUNGSIONAL
                </td>
            </tr>

            <tr>
                <td colspan="2" style="font-size:10px;padding:3px 5px">
                    Alat Bantu : {{ $data->alat_bantu ?? 'Tidak' }}
                </td>
                <td colspan="2" style="font-size:10px;padding:3px 5px">
                    Prothesa : {{ $data->prothesa ?? 'Tidak' }}
                </td>
                <td colspan="2" style="font-size:10px;padding:3px 5px">
                    Cacat Fisik : {{ $data->cacat_fisik ?? 'TIDAK ADA' }}
                    &nbsp;&nbsp;
                    ADL : {{ $data->adl ?? 'Mandiri' }}
                </td>
            </tr>

            {{-- V. PSIKO-SOSIAL SPIRITUAL DAN BUDAYA --}}
            <tr>
                <td colspan="6"
                    style="background:#f3fdd7;font-size:10px;font-weight:bold;text-align:center;padding:3px 5px">
                    V. RIWAYAT PSIKO-SOSIAL SPIRITUAL DAN BUDAYA
                </td>
            </tr>

            <tr>
                <td colspan="3" style="font-size:10px;padding:3px 5px;vertical-align:top">
                    Status Psikologis : {{ $data->status_psikologis ?? '-' }}
                </td>
                <td colspan="3" style="font-size:10px;padding:3px 5px;vertical-align:top">
                    Agama : {{ $data->agama ?? '-' }}
                </td>
            </tr>

            <tr>
                <td colspan="6" style="font-size:10px;padding:3px 5px">
                    <b>Status Sosial dan Ekonomi :</b><br>
                    a. Hubungan pasien dengan anggota keluarga : {{ $data->hubungan_keluarga ?? 'Baik' }}<br>
                    b. Tinggal dengan : {{ $data->tinggal_dengan ?? '-' }}<br>
                    c. Ekonomi : {{ $data->ekonomi ?? 'Baik' }}
                </td>
            </tr>

            <tr>
                <td colspan="3" style="font-size:10px;padding:3px 5px;vertical-align:top">
                    Kepercayaan / Budaya / Nilai-nilai khusus yang perlu diperhatikan :
                    {{ $data->nilai_budaya ?? 'Tidak Ada' }}
                </td>
                <td colspan="3" style="font-size:10px;padding:3px 5px;vertical-align:top">
                    Bahasa yang digunakan sehari-hari : {{ $data->bahasa ?? 'INDONESIA' }}
                    &nbsp;&nbsp;
                    Edukasi diberikan kepada : {{ $data->edukasi_kepada ?? 'Pasien' }}
                </td>
            </tr>

            {{-- VI. PENILAIAN RESIKO JATUH --}}
            <tr>
                <td colspan="6"
                    style="background:#f3fdd7;font-size:10px;font-weight:bold;text-align:center;padding:3px 5px">
                    VI. PENILAIAN RESIKO JATUH
                </td>
            </tr>

            <tr>
                <td colspan="6" style="font-size:10px;padding:3px 5px">
                    <table width="100%" style="border-collapse:collapse;font-size:9px" border="1">
                        <thead>
                            <tr style="background:#f0f0f0">
                                <th style="padding:2px 4px;width:5%;text-align:center">No</th>
                                <th style="padding:2px 4px;text-align:left">Hal-hal yang diobservasi</th>
                                <th style="padding:2px 4px;width:12%;text-align:center">Ya/Tidak</th>
                                <th style="padding:2px 4px;width:30%;text-align:center">Hasil</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="padding:2px 4px;text-align:center">1.</td>
                                <td style="padding:2px 4px">
                                    <b>Cara Berjalan :</b><br>
                                    A. Tidak seimbang/sempoyongan/ limbung<br>
                                    B. Jalan dengan menggunakan alat bantu (kruk, tripot, kursi roda, orang lain)
                                </td>
                                <td style="padding:2px 4px;text-align:center">{{ $data->berjalan_a ?? 'Tidak' }}
                                    <br />{{ $data->berjalan_b ?? 'Tidak' }}
                                </td>
                                <td rowspan="2" style="padding:2px 4px;vertical-align:middle">
                                    Hasil : {{ $data->hasil ?? 'Tidak Beresiko (Tidak Ditemukan A Dan B)' }}<br><br>
                                    Dilaporkan ke dokter ? {{ $data->lapor ?? 'Tidak' }}, pada :
                                    {{ $data->ket_lapor ?? '-' }}
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:2px 4px;text-align:center">2.</td>
                                <td style="padding:2px 4px">
                                    C. Menopang saat akan duduk, tampak memegang pinggiran kursi atau meja/benda lain
                                    sebagai penopang
                                </td>
                                <td style="padding:2px 4px;text-align:center">{{ $data->berjalan_c ?? 'Tidak' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>

            {{-- VII. SKRINING GIZI --}}
            <tr>
                <td colspan="6"
                    style="background:#f3fdd7;font-size:10px;font-weight:bold;text-align:center;padding:3px 5px">
                    VII. SKRINING GIZI
                </td>
            </tr>

            <tr>
                <td colspan="6" style="font-size:10px;padding:3px 5px">
                    <table width="100%" style="border-collapse:collapse;font-size:9px" border="1">
                        <thead>
                            <tr style="background:#f0f0f0">
                                <th style="padding:2px 4px;width:5%;text-align:center">No</th>
                                <th style="padding:2px 4px;text-align:left">Parameter</th>
                                <th style="padding:2px 4px;width:15%;text-align:center" colspan="2">Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="padding:2px 4px;text-align:center">1</td>
                                <td style="padding:2px 4px">Apakah ada penurunan berat badan yang tidak diinginkan selama
                                    enam bulan terakhir?</td>
                                <td style="padding:2px 4px;text-align:center" width="10%">
                                    {{ $data->gizi_penurunan_bb ?? 'Tidak' }}
                                </td>
                                <td style="text-align:center" width="5%">
                                    {{ $data->gizi_skor_1 ?? '0' }}
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:2px 4px;text-align:center">2</td>
                                <td style="padding:2px 4px">Apakah nafsu makan berkurang karena tidak nafsu makan?</td>
                                <td style="padding:2px 4px;text-align:center">
                                    {{ $data->gizi_nafsu_makan ?? 'Tidak' }}
                                </td>
                                <td style="text-align:center">
                                    {{ $data->gizi_skor_2 ?? '0' }}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" style="padding:2px 4px;text-align:right">
                                    <b>Total Skor</b>
                                </td>
                                <td style="padding:2px 4px;text-align:center" colspan="1">
                                    {{ $data->gizi_total_skor ?? '0' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>

            {{-- VIII. PENILAIAN TINGKAT NYERI --}}
            <tr>
                <td colspan="6"
                    style="background:#f3fdd7;font-size:10px;font-weight:bold;text-align:center;padding:3px 5px">
                    VIII. PENILAIAN TINGKAT NYERI
                </td>
            </tr>

            <tr>
                <td colspan="3" style="font-size:9px;padding:3px 5px;vertical-align:top">
                    <img src="{{ asset('img/skala_nyeri_wong_baker.png') }}" style="width: 100%;height: auto" />
                </td>
                <td colspan="3" style="font-size:10px;padding:3px 5px;vertical-align:top">
                    <b>Kualitas Nyeri</b>/br> Penyebab : {{ $data->nyeri_penyebab ?? '-' }}<br>
                    Kualitas : {{ $data->nyeri_kualitas ?? '-' }}<br>
                    Wilayah : Lokasi {{ $data->nyeri_lokasi ?? '-' }} <br />Menyebar :
                    {{ $data->nyeri_menyebar ?? 'Tidak' }}<br>
                    Severity : Skala Nyeri {{ $data->skala_nyeri ?? '-' }}, Waktu / Durasi :
                    {{ $data->durasi_nyeri ?? '-' }}<br>
                    Nyeri hilang bila : {{ $data->nyeri_hilang ?? '-' }} <br /> Diberitahukan pada dokter ?
                    {{ $data->nyeri_lapor_dokter ?? 'Tidak' }}
                </td>
            </tr>

            {{-- MASALAH & TINDAKAN --}}
            <tr>
                <td colspan="3"
                    style="background:#f3fdd7;font-size:10px;font-weight:bold;text-align:center;padding:3px 5px">
                    MASALAH KEBIDANAN
                </td>
                <td colspan="3"
                    style="background:#f3fdd7;font-size:10px;font-weight:bold;text-align:center;padding:3px 5px">
                    TINDAKAN
                </td>
            </tr>

            <tr>
                <td colspan="3" style="font-size:10px;height:80px;vertical-align:top;padding:3px 5px">
                    {!! nl2br(e($data->masalah ?? '')) !!}
                </td>
                <td colspan="3" style="font-size:10px;height:80px;vertical-align:top;padding:3px 5px">
                    {!! nl2br(e($data->tindakan ?? '')) !!}
                </td>
            </tr>

            {{-- TANDA TANGAN --}}
            <tr>
                <td colspan="6"
                    style="background:#f3fdd7;font-size:10px;font-weight:bold;text-align:center;padding:3px 5px">
                    YANG MELAKUKAN ANAMNESA
                </td>
            </tr>

            <tr>
                <td colspan="3" style="font-size:10px;text-align:center;padding:3px 5px">
                    Tanggal dan Jam
                </td>
                <td colspan="3" style="font-size:10px;text-align:center;padding:3px 5px">
                    Tanda Tangan dan Nama Bidan
                </td>
            </tr>

            <tr>
                <td colspan="3" style="font-size:10px;text-align:center;height:100px;vertical-align:middle;padding:3px 5px">
                    {{ isset($data->tanggal) ? date('M, d/m/Y H:i:s', strtotime($data->tanggal)) : '-' }} WIB
                </td>
                <td colspan="3" style="font-size:10px;text-align:center;height:100px;vertical-align:bottom;padding:3px 5px">

                    <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG($data->ttd_petugas, 'QRCODE') }}" height="60"
                        width="60" style="margin:5px" />

                    <br>
                    {{ $data->petugas->nama ?? '-' }}
                </td>
            </tr>

        </tbody>

    </table>

@endsection