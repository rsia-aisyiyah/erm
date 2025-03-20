@extends('content.print.main')
@section('content')
    <div style="text-align: center" class="mb-3">
        <h2 style="margin-bottom: 0px">RSIA AISYIYAH PEKAJANGAN</h2>
        <p style="font-size: 12px">Jl. Raya Pekajangan No. 610, Kabupaten Pekalongan, Jawa Tengah </p>
        <p style="font-size: 12px">Telp. (0285) 785909, Email : rba610@gmail.com </p>
    </div>
    <img src="{{ asset('img/logo.png') }}" style="position: absolute;top:10px;left:30px" width="55" />
    <img src="{{ asset('img/LOGO PARIPURNA.png') }}" style="position: absolute;top:15px;right:15px" width="120" />
    <hr class="m-0">

    <div class="border text-center bg-lime my-2 ">
        <h4>ASUHAN GIZI ANAK</h4>
    </div>

    <div class="border p-2">
        <table width="100%" style="margin-top:0px">
            <tbody style="font-size:12px">
                <tr>
                    <td colspan="2">
                        No. Rawat : {{ $asuhanGizi['no_rawat'] }}</br>
                        Nama : {{ $pasien['no_rkm_medis'] }} - {{ $pasien['nm_pasien'] }} ({{ $pasien['umur'] }})
                    </td>
                    <td colspan="2">
                        JK : {{ $pasien['jk'] }} <br>
                        Tgl. Lahir : {{ $pasien['tgl_lahir'] }}
                    </td>
                    <td colspan="2">
                        Tanggal: {{ $asuhanGizi['tanggal'] }} <br>
                        Diagnosis: {{ $pasien['diagnosa_awal'] }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>


    <div class="border mt-2 text-center">
        <h5>ASESMEN</h5>
    </div>
    <div class="border p-2">
        <table width="100%" style="font-size:12px">
            <tr>
                <td colspan="9">
                    <strong>1. Data Antopometri</strong>
                </td>
            </tr>
            {{-- BB --}}
            <tr>
                <td width="10%">
                    BB
                </td>
                <td width="20%">
                    : {{ $asuhanGizi['antropometri_bb'] }} Kg
                </td>
                <td width="22%">
                    Z-Score BB/U
                </td>
                <td width="15%">
                    : {{ $asuhanGizi['antropometri_zscore_bbperu'] }} SD
                </td>
                <td width="15%">
                    BB Ideal
                </td>
                <td width="20%">
                    : {{ $asuhanGizi['antropometri_bbideal'] }} Kg
                </td>
            </tr>

            {{-- TB --}}
            <tr>
                <td>
                    TB
                </td>
                <td>
                    : {{ $asuhanGizi['antropometri_tb'] }} cm
                </td>
                <td>
                    Z-Score TB/U
                </td>
                <td>
                    : {{ $asuhanGizi['antropometri_zscore_bbpertb'] }} SD
                </td>
                <td>
                    Status Gizi
                </td>
                <td>
                    : {{ $asuhanGizi['antropometri_status_gizi'] }}
                </td>
            </tr>

            {{-- IMT --}}
            <tr>
                <td>
                    IMT
                </td>
                <td>
                    : {{ $asuhanGizi['antropometri_imt'] }} Kg/m2
                </td>
                <td>
                    Z-Score IMT/U
                </td>
                <td>
                    : {{ $asuhanGizi['antropometri_zscore_imtperu'] }} SD
                </td>
                <td>
                </td>
            </tr>
            <tr>
                <td colspan="9">
                    <strong>2. Biokimia Terkait Gizi</strong>
                </td>
            </tr>
            <tr>
                <td colspan="9">
                    {{ $asuhanGizi['biokimia'] }}
                </td>

            </tr>
            <tr>
                <td colspan="9">
                    <strong>3. Data Fisik/Klinis Pasien</strong>
                </td>
            </tr>
            <tr>
                <td>
                    TD
                </td>
                <td>
                    : {{ $asuhanGizi['fisik_klinis_td'] }} mmHG
                </td>
                <td>
                    Nafsu makan
                </td>
                <td>
                    : {{ $asuhanGizi['fisik_klinis_nafsu_makan'] }}
                </td>
                <td>
                    Diare
                </td>
                <td>
                    : {{ $asuhanGizi['fisik_klinis_diare'] }}
                </td>
            </tr>
            <tr>
                <td>Nadi</td>
                <td>: {{ $asuhanGizi['fisik_klinis_nadi'] }} x/mnt</td>
                <td>Hilang Lemak Subkutan</td>
                <td>: {{ $asuhanGizi['fisik_klinis_hilang_lemak'] }}</td>
                <td>Konstipasi</td>
                <td>: {{ $asuhanGizi['fisik_klinis_konstipasi'] }}</td>
            </tr>
            <tr>
                <td>Suhu</td>
                <td>: {{ $asuhanGizi['fisik_klinis_suhu'] }} °C</td>
                <td>Gangguan Menelan</td>
                <td>: {{ $asuhanGizi['fisik_klinis_gangguan_telan'] }}</td>
                <td>Mual</td>
                <td>: {{ $asuhanGizi['fisik_klinis_mual'] }}</td>
            </tr>
            <tr>
                <td>Pernafasan</td>
                <td>: {{ $asuhanGizi['fisik_klinis_pernafasan'] }} x/mnt</td>
                <td>Gangguan Mengunyah</td>
                <td>: {{ $asuhanGizi['fisik_klinis_gangguan_kunyah'] }}</td>
                <td>Muntah</td>
                <td>: {{ $asuhanGizi['fisik_klinis_muntah'] }}</td>
            </tr>
            <tr>
                <td>Kesadaran</td>
                <td>: {{ $asuhanGizi['fisik_klinis_kesadaran'] }}</td>
                <td>Udem</td>
                <td>: {{ $asuhanGizi['fisik_klinis_udem'] }}</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="9">
                    <strong> 4. Data Riwayat Gizi</strong>
                </td>
            </tr>
            <tr>
                <td colspan="2">Alergi Makanan</td>
                <td colspan="7">: {{ $asuhanGizi['riwayat_gizi_alergi_makanan'] }}, Ket : {{ $asuhanGizi['riwayat_gizi_keterangan_alergi'] }}</td>
            </tr>
            <tr>
                <td colspan="2">Ketidaksukaan Makanan</td>
                <td colspan="7">: {{ $asuhanGizi['riwayat_gizi_ketidaksukaan_makanan'] }}, Ket : {{ $asuhanGizi['riwayat_gizi_keterangan_ketidaksukaan_makanan'] }}</td>
            </tr>
            <tr>
                <td colspan="2">Pantangan Makanan</td>
                <td colspan="7">: {{ $asuhanGizi['riwayat_gizi_pantangan_makanan'] }}, Ket : {{ $asuhanGizi['riwayat_gizi_keterangan_pantangan_makanan'] }}</td>
            </tr>
            <tr>
                <td colspan="2">Pola Makan</td>
                <td colspan="7">: {{ $asuhanGizi['riwayat_gizi_pola_makan'] }}, Ket : {{ $asuhanGizi['riwayat_gizi_keterangan_pola_makan'] }}</td>
            </tr>
            <tr>
                <td colspan="9"><strong>5. Data Riwayat Personal</strong></td>
            </tr>
            <tr>
                <td colspan="9">{{ $asuhanGizi['riwayat_personal'] }}</td>
            </tr>
        </table>

    </div>
    <div class="border text-center p-1">
        <h5>DIAGNOSIS</h5>
    </div>
    <div class="border p-2">
        <p>{{ $asuhanGizi['diagnosis'] }}</p>
    </div>
    <div class="border text-center p-1">
        <h5>INTERVENSI</h5>
    </div>
    <div class="border p-2">
        <table width="100%" style="font-size: 11px">
            <tr>
                <td colspan="6"><strong>1. Tujuan</strong></td>
            </tr>
            <tr>
                <td colspan="6">{{ $asuhanGizi['intervensi_gizi_tujuan'] }}</td>
            </tr>
            <tr>
                <td colspan="6"><strong>2. Intervensi</strong></td>
            </tr>
            <tr>
                <td colspan="3">Perhitungan Kebutuhan Zat Gizi</td>
                <td colspan="3">Pemberian Diet</td>
            </tr>
            <tr>
                <td>Energi</td>
                <td width="2px">:</td>
                <td>{{ $asuhanGizi['intervensi_gizi_energi'] }}</td>
                <td>Jenis Diet</td>
                <td width="2px">:</td>
                <td>{{ $asuhanGizi['intervensi_gizi_jenis_diet'] }}</td>
            </tr>
            <tr>
                <td>Protein</td>
                <td width="2px">:</td>
                <td>{{ $asuhanGizi['intervensi_gizi_protein'] }}</td>
                <td>Bentuk Makanan</td>
                <td width="2px">:</td>
                <td>{{ $asuhanGizi['intervensi_gizi_bentuk_makanan'] }}</td>
            </tr>
            <tr>
                <td>Lemak</td>
                <td width="2px">:</td>
                <td>{{ $asuhanGizi['intervensi_gizi_lemak'] }}</td>
                <td>Rute Pemberian</td>
                <td width="2px">:</td>
                <td>{{ $asuhanGizi['intervensi_gizi_rute_pemberian'] }}</td>
            </tr>
            <tr>
                <td>Karbohidrat</td>
                <td width="2px">:</td>
                <td>{{ $asuhanGizi['intervensi_gizi_karbohidrat'] }}</td>
                <td>Frekuensi</td>
                <td width="2px">:</td>
                <td>{{ $asuhanGizi['intervensi_gizi_frekuensi'] }}</td>
            </tr>
            <tr>
                <td colspan="6"><strong>3. Konseling Gizi / Edukasi</strong></td>
            </tr>
            <tr>
                <td colspan="6">{{ $asuhanGizi['intervensi_gizi_konseling'] }}</td>
            </tr>
        </table>
    </div>
    <div class="border text-center p-1">
        <h5>RENCANA MONITORING & EVALUASI</h5>
    </div>
    <div class="border p-2">
        <p>{{ $asuhanGizi['monitoring_evaluasi'] }}</p>
    </div>

    <div class="text-center mt-3" style="margin-left: 500px">
        <p>Pekajangan, {{ $asuhanGizi['tanggal'] }}</p>
        <p class="mb-1">Ahli Gizi</p>
        <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG($petugas['ttd'], 'QRCODE') }}" height="80" width="80" /><br>
        <p class="mt-1"><u><strong>({{ $petugas['nama'] }})</strong></u></p>
        <p class="">{{ $petugas['nip'] }}</p>
    </div>
@endsection
