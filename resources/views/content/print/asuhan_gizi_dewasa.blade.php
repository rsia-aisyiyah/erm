@extends('content.print.main')

@section('content')
        <div style="text-align: center">
            <h3 style="margin-bottom: 0px">RSIA AISYIYAH PEKAJANGAN</h3>
            <p style="font-size: 11px">Jl. Raya Pekajangan No. 610, Kabupaten Pekalongan, Jawa Tengah </p>
            <p style="font-size: 11px">Telp. (0285) 785909, Email : rba610@gmail.com </p>
        </div>
        <hr style="margin:0;padding:0">
        <img src="{{ asset('img/logo.png') }}" style="position: absolute;top:10px;left:30px;margin:0px;padding:0px"
            width="50" /><br />

        <div class="border text-center bg-lime" style="background-color: #f0f0f0; padding: 5px; margin-bottom: 10px;">
            <h4 style="margin: 0">ASUHAN GIZI DEWASA</h4>
        </div>

        <div class="border" style="margin-bottom: 10px;">
            <table width="100%" border="0" style="font-size: 12px; border-collapse: collapse;">
                <tr>
                    <td colspan="4" style="background-color: #eee;"><strong>1. Data Antropometri</strong></td>
                </tr>
                <tr>
                    <td width="20%">BB</td>
                    <td width="30%">: {{ $asuhanGizi['antropometri_bb'] }} Kg</td>
                    <td width="20%">TB</td>
                    <td width="30%">: {{ $asuhanGizi['antropometri_tb'] }} cm</td>
                </tr>
                <tr>
                    <td>IMT</td>
                    <td>: {{ $asuhanGizi['antropometri_imt'] }} kg/m²</td>
                    <td>LLA</td>
                    <td>: {{ $asuhanGizi['antropometri_lla'] }} cm</td>
                </tr>
                <tr>
                    <td>BB Ideal</td>
                    <td>: {{ $asuhanGizi['antropometri_bbideal'] }} Kg</td>
                    <td>Status Gizi</td>
                    <td>: {{ $asuhanGizi['antropometri_status_gizi'] }}</td>
                </tr>
            </table>
        </div>

        <div class="border" style="margin-bottom: 10px;">
            <table width="100%" style="font-size: 12px;">
                <tr>
                    <td style="background-color: #eee;"><strong>2. Data Biokimia</strong></td>
                </tr>
                <tr>
                    <td>{{ $asuhanGizi['biokimia'] }}</td>
                </tr>
            </table>
        </div>

        <div class="border" style="margin-bottom: 10px;">
            <table width="100%" style="font-size: 12px;">
                <tr>
                    <td colspan="4" style="background-color: #eee;"><strong>3. Pemeriksaan Fisik & Klinis</strong></td>
                </tr>
                <tr>
                    <td>Tensi</td>
                    <td>: {{ $asuhanGizi['fisik_klinis_td'] }} mmHg</td>
                    <td>Nadi</td>
                    <td>: {{ $asuhanGizi['fisik_klinis_nadi'] }} x/menit</td>
                </tr>
                <tr>
                    <td>Suhu</td>
                    <td>: {{ $asuhanGizi['fisik_klinis_suhu'] }} °C</td>
                    <td>Respirasi</td>
                    <td>: {{ $asuhanGizi['fisik_klinis_pernapasan'] }} x/menit</td>
                </tr>
                <tr>
                    <td>Kesadaran</td>
                    <td>: {{ $asuhanGizi['fisik_klinis_kesadaran'] }}</td>
                    <td>Nafsu Makan</td>
                    <td>: {{ $asuhanGizi['fisik_klinis_nafsu_makan'] }}</td>
                </tr>
                <tr>
                    <td colspan="4">
                        <strong>Kondisi Khusus:</strong> <br>
                        Gangguan Telan: {{ $asuhanGizi['fisik_klinis_gangguan_telan'] }},
                        Gangguan Kunyah: {{ $asuhanGizi['fisik_klinis_gangguan_kunyah'] }},
                        Mual: {{ $asuhanGizi['fisik_klinis_mual'] }},
                        Muntah: {{ $asuhanGizi['fisik_klinis_muntah'] }}
                    </td>
                </tr>
            </table>
        </div>

        <div class="border" style="margin-bottom: 10px;">
            <table width="100%" style="font-size: 12px;">
                <tr>
                    <td style="background-color: #eee;"><strong>4. Riwayat Gizi & Personal</strong></td>
                </tr>
                <tr>
                    <td>
                        Alergi: {{ $asuhanGizi['riwayat_gizi_alergi_makanan'] }}
                        ({{ $asuhanGizi['riwayat_gizi_keterangan_alergi'] }}) <br>
                        Pola Makan: {{ $asuhanGizi['riwayat_gizi_pola_makan'] }} <br>
                        Riwayat Personal: {{ $asuhanGizi['riwayat_personal'] }}
                    </td>
                </tr>
            </table>
        </div>

        <div class="border" style="margin-bottom: 10px;">
            <table width="100%" style="font-size: 12px;">
                <tr>
                    <td style="background-color: #eee;"><strong>5. Diagnosis Gizi</strong></td>
                </tr>
                <tr>
                    <td style="font-style: italic;">{{ $asuhanGizi['diagnosis'] }}</td>
                </tr>
            </table>
        </div>

        <div class="border" style="margin-bottom: 10px;">
            <table width="100%" style="font-size: 12px;">
                <tr>
                    <td colspan="4" style="background-color: #eee;"><strong>6. Intervensi Gizi</strong></td>
                </tr>
                <tr>
                    <td colspan="4">Tujuan: {{ $asuhanGizi['intervensi_gizi_tujuan'] }}</td>
                </tr>
                <tr>
                    <td>Energi: {{ $asuhanGizi['intervensi_gizi_energi'] }} kkal</td>
                    <td>Protein: {{ $asuhanGizi['intervensi_gizi_protein'] }} gr</td>
                    <td>Lemak: {{ $asuhanGizi['intervensi_gizi_lemak'] }} gr</td>
                    <td>Karbohidrat: {{ $asuhanGizi['intervensi_gizi_karbohidrat'] }} gr</td>
                </tr>
                <tr>
                    <td colspan="2">Diet: {{ $asuhanGizi['intervensi_gizi_jenis_diet'] }}</td>
                    <td colspan="2">Bentuk Makanan: {{ $asuhanGizi['intervensi_gizi_bentuk_makanan'] }}</td>
                </tr>
                <tr>
                    <td colspan="4">Frekuensi: {{ $asuhanGizi['intervensi_gizi_frekuensi'] }}</td>
                </tr>
                <tr>
                    <td colspan="4">Konseling: {{ $asuhanGizi['intervensi_gizi_konseling'] }}</td>
                </tr>
            </table>
        </div>

        <div class="border" style="margin-bottom: 10px;">
            <table width="100%" style="font-size: 12px;">
                <tr>
                    <td style="background-color: #eee;"><strong>7. Monitoring & Evaluasi</strong></td>
                </tr>
                <tr>
                    <td>{{ $asuhanGizi['monitoring_evaluasi'] }}</td>
                </tr>
            </table>
        </div>

    <div class="text-center mt-3" style="margin-left: 500px">
        <p>Pekajangan, {{ $asuhanGizi['tanggal'] }}</p>
        <p class="mb-1">Ahli Gizi</p>
        <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG($petugas['ttd'], 'QRCODE') }}" height="80" width="80" /><br>
        <p class="mt-1"><u><strong>({{ $petugas['nama'] }})</strong></u></p>
        <p class="">{{ $petugas['nip'] }}</p>
    </div>
@endsection