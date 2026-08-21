@extends('content.print.main')
@section('content')
    <table width="100%" style="border: none; border-collapse: collapse; margin-bottom: 5px;">
        <tr>
            <td width="15%" style="border: none; vertical-align: middle; text-align: center; padding: 0;">
                <img src="{{ public_path('img/logo.png') }}" width="60" />
            </td>
            <td width="85%" style="border: none; text-align: center; vertical-align: middle; padding: 0;">
                <h3 style="margin: 0; font-size: 16px; font-weight: bold;">RSIA AISYIYAH PEKAJANGAN</h3>
                <p style="margin: 2px 0 0 0; font-size: 11px;">Jl. Raya Pekajangan No. 610, Kabupaten Pekalongan, Jawa Tengah</p>
                <p style="margin: 2px 0 0 0; font-size: 11px;">Telp. (0285) 785909, Email : rba610@gmail.com</p>
            </td>
        </tr>
    </table>
    <hr style="margin: 5px 0 15px 0; border: 0; border-top: 1.5px solid #000;">
    <h3 style="text-align: center; margin-top: 0; margin-bottom: 15px;"><u>FORM SKRINING GIZI PASIEN</u></h3>

    <table style="font-size: 12px; margin-bottom: 15px;" width="100%">
        <tr>
            <td width="20%"><strong>No. Rawat</strong></td>
            <td width="3%">:</td>
            <td width="27%">{{ $data->no_rawat }}</td>
            <td width="20%"><strong>No. Rekam Medis</strong></td>
            <td width="3%">:</td>
            <td width="27%">{{ $regPeriksa->no_rkm_medis ?? '-' }}</td>
        </tr>
        <tr>
            <td><strong>Nama Pasien</strong></td>
            <td>:</td>
            <td>{{ $regPeriksa->pasien->nm_pasien ?? '-' }}</td>
            <td><strong>Jenis Kelamin</strong></td>
            <td>:</td>
            <td>{{ ($regPeriksa->pasien->jk ?? '') == 'L' ? 'Laki-Laki' : 'Perempuan' }}</td>
        </tr>
        <tr>
            <td><strong>Tgl. Lahir / Umur</strong></td>
            <td>:</td>
            <td>{{ date('d-m-Y', strtotime($regPeriksa->pasien->tgl_lahir ?? 'now')) }} ({{ $regPeriksa->umurdaftar ?? 0 }} {{ $regPeriksa->sttsumur ?? 'Th' }})</td>
            <td><strong>Kategori Skrining</strong></td>
            <td>:</td>
            <td><strong>{{ $data->kategori ?? 'ANAK' }}</strong></td>
        </tr>
    </table>

    <h4 style="margin-bottom: 5px; font-size: 13px;">I. Data Antropometri & Hasil Penunjang</h4>
    <table class="table-bordered" width="100%" style="font-size: 12px; margin-bottom: 15px;">
        <tr style="background-color: #f2f2f2;">
            <th width="20%" style="padding: 5px; text-align: left;">Parameter</th>
            <th width="30%" style="padding: 5px; text-align: left;">Hasil</th>
            <th width="20%" style="padding: 5px; text-align: left;">Pemeriksaan</th>
            <th width="30%" style="padding: 5px; text-align: left;">Hasil</th>
        </tr>
        <tr>
            <td style="padding: 5px;">Berat Badan (BB)</td>
            <td style="padding: 5px;"><strong>{{ $data->bb }} kg</strong></td>
            <td style="padding: 5px;">Hemoglobin (HB)</td>
            <td style="padding: 5px;">{{ $data->hb ? $data->hb . ' g/dL' : '-' }}</td>
        </tr>
        <tr>
            <td style="padding: 5px;">Tinggi Badan (TB)</td>
            <td style="padding: 5px;"><strong>{{ $data->tb }} cm</strong></td>
            <td style="padding: 5px;">HIV</td>
            <td style="padding: 5px;">{{ $data->hiv ?? 'Tidak Periksa' }}</td>
        </tr>
        <tr>
            <td style="padding: 5px;">Indeks Massa Tubuh (IMT)</td>
            <td style="padding: 5px;"><strong>{{ $data->imt }} kg/m²</strong></td>
            <td style="padding: 5px;">HBsAg</td>
            <td style="padding: 5px;">{{ $data->hbsag ?? 'Tidak Periksa' }}</td>
        </tr>
        @if(($data->kategori ?? '') === 'OBGYN')
        <tr>
            <td style="padding: 5px;">LILA</td>
            <td style="padding: 5px;"><strong>{{ $data->lila }} cm</strong></td>
            <td style="padding: 5px;">Syphilis</td>
            <td style="padding: 5px;">{{ $data->syphilis ?? 'Tidak Periksa' }}</td>
        </tr>
        @else
        <tr>
            <td style="padding: 5px;">Syphilis</td>
            <td style="padding: 5px;" colspan="3">{{ $data->syphilis ?? 'Tidak Periksa' }}</td>
        </tr>
        @endif
    </table>

    <h4 style="margin-bottom: 5px; font-size: 13px;">II. Pertanyaan & Skoring Nutrisi ({{ $data->kategori ?? 'ANAK' }})</h4>
    <table class="table-bordered" width="100%" style="font-size: 12px; margin-bottom: 15px;">
        <tr style="background-color: #f2f2f2;">
            <th width="70%" style="padding: 5px; text-align: left;">Kriteria Skrining</th>
            <th width="30%" style="padding: 5px; text-align: center;">Hasil / Jawaban</th>
        </tr>
        @if(($data->kategori ?? '') === 'OBGYN')
            @php $qArr = explode(',', $data->q_obgyn ?? 'TIDAK,TIDAK,TIDAK'); @endphp
            <tr>
                <td style="padding: 5px;">Apakah asupan makan berkurang karena tidak nafsu makan?</td>
                <td style="padding: 5px; text-align: center;"><strong>{{ $qArr[0] ?? 'TIDAK' }}</strong></td>
            </tr>
            <tr>
                <td style="padding: 5px;">Ada gangguan metabolisme (seperti diabetes, gangguan fungsi ginjal, dll.)</td>
                <td style="padding: 5px; text-align: center;">{{ $data->cb_obgyn ?? '-' }}</td>
            </tr>
            <tr>
                <td style="padding: 5px;">Apakah ada pertambahan BB yang kurang/berlebih selama hamil?</td>
                <td style="padding: 5px; text-align: center;"><strong>{{ $qArr[1] ?? 'TIDAK' }}</strong></td>
            </tr>
            <tr>
                <td style="padding: 5px;">Apakah Nilai Hb < 11 g/dL atau HCT < 30%?</td>
                <td style="padding: 5px; text-align: center;"><strong>{{ $qArr[2] ?? 'TIDAK' }}</strong></td>
            </tr>
        @else
            @php $qArr = explode(',', $data->q_anak ?? 'TIDAK,TIDAK'); @endphp
            <tr>
                <td style="padding: 5px;">Apakah pasien tampak kurus?</td>
                <td style="padding: 5px; text-align: center;"><strong>{{ $qArr[0] ?? 'TIDAK' }}</strong></td>
            </tr>
            <tr>
                <td style="padding: 5px;">Apakah ada penurunan berat badan selama 1 bulan terakhir?</td>
                <td style="padding: 5px; text-align: center;"><strong>{{ $qArr[1] ?? 'TIDAK' }}</strong></td>
            </tr>
            <tr>
                <td style="padding: 5px;">Apakah terdapat salah satu dari kondisi (muntah >3x/hari, diare kronik, dll.)?</td>
                <td style="padding: 5px; text-align: center;">{{ $data->cb_anak1 ?? '-' }}</td>
            </tr>
            <tr>
                <td style="padding: 5px;">Apakah ada penyakit/kondisi yang berisiko mengakibatkan malnutrisi?</td>
                <td style="padding: 5px; text-align: center;">{{ $data->cb_anak2 ?? '-' }}</td>
            </tr>
        @endif
    </table>

    <h4 style="margin-bottom: 5px; font-size: 13px;">III. Kesimpulan Penilaian Risiko Gizi</h4>
    <table class="table-bordered" width="100%" style="font-size: 12px; margin-bottom: 20px;">
        <tr>
            <td width="25%" style="padding: 6px;"><strong>Diagnosa Medis</strong></td>
            <td width="75%" style="padding: 6px;">{{ $data->diagnosa_medis ?? '-' }}</td>
        </tr>
        <tr>
            <td style="padding: 6px;"><strong>Skor Total Skrining</strong></td>
            <td style="padding: 6px;"><strong>{{ $data->skor }}</strong></td>
        </tr>
        <tr>
            <td style="padding: 6px;"><strong>Tingkat Risiko Gizi</strong></td>
            <td style="padding: 6px;">
                <strong style="color: {{ str_contains(strtolower($data->keterangan), 'tinggi') ? '#dc3545' : (str_contains(strtolower($data->keterangan), 'sedang') ? '#d97706' : '#198754') }};">
                    {{ $data->keterangan ?? '-' }}
                </strong>
            </td>
        </tr>
        <tr>
            <td style="padding: 6px;"><strong>Rekomendasi Jenis Diet</strong></td>
            <td style="padding: 6px;"><strong>{{ $data->jenis_diet ?? '-' }}</strong></td>
        </tr>
    </table>

    <table width="100%" style="font-size: 12px; margin-top: 30px;">
        <tr>
            <td width="60%"></td>
            <td width="40%" style="text-align: center;">
                Pekalongan, {{ date('d-m-Y') }}<br/>
                Petugas Pemeriksa / Ahli Gizi,<br/><br/><br/><br/>
                ( ..................................................... )
            </td>
        </tr>
    </table>
@endsection
