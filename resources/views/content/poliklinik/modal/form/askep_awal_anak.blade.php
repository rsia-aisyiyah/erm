{{-- @extends('index')
@section('contents') --}}
{{-- Form Info Pasien (readonly) --}}
<div class="border p-2 mb-3 bg-light">
    <form action="" accept="" id="formInfoAskepAwalAnak">
        <div class="row">
            <div class="col-md-2">
                <label for="no_rawat">No.Rawat</label>
                <x-input name="no_rawat"></x-input>
            </div>
            <div class="col-md-3">
                <label for="no_rawat">Pasien</label>
                <x-input-group>
                    <x-input name="no_rkm_medis"></x-input>
                    <x-input name="pasien" class="w-50"></x-input>
                </x-input-group>
            </div>
            <div class="col-md-2">
                <label for="tgl_lahir">Tgl. Lahir/Umur</label>
                <x-input-group>
                    <x-input name="tgl_lahir"></x-input>
                    <x-input name="umurdaftar" class="w-25"></x-input>
                </x-input-group>
            </div>
            <div class="col-md-2">
                <label for="penjab">Pembiayaan</label>
                <x-input name="penjab"></x-input>
            </div>
            <div class="col-md-3">
                <label for="dokter">Dokter DPJP</label>
                <x-input name="dokter"></x-input>
            </div>
        </div>
    </form>
</div>

{{-- Form Utama Askep Awal Kebidanan --}}
<form action="" method="post" id="formAskepAwalAnak">

    <div class="row">

        {{-- ======================== KOLOM KIRI ======================== --}}
        <div class="col-md-6">

            {{-- I. Keadaan Umum --}}
            <div class="card mb-3">
                <div class="card-header">
                    Keadaan Umum
                </div>
                <div class="card-body">
                    <div class="row g-2">

                        <div class="col-md-5">
                            <label for="nip">Petugas</label>
                            <x-select id="nip" name="nip" style="width:100%"
                                data-dropdown-parent="#formAskepAwalAnak"></x-select>
                        </div>

                        <div class="col-md-4">
                            <label for="informasi">Anamnesa</label>
                            <x-select id="informasi" name="informasi">
                                <x-option>Autoanamnesis</x-option>
                                <x-option>Alloanamnesis</x-option>
                            </x-select>
                        </div>

                        <div class="col-md-3">
                            <label for="tanggal">Tanggal</label>
                            <x-input id="tanggal" name="tanggal" type="datetime-local" />
                        </div>

                        <div class="col-md-3">
                            <label for="td">TD</label>
                            <x-input-group class="input-group-sm">
                                <x-input id="td" name="td" placeholder="mmHg" />
                                <x-input-group-text>mmHg</x-input-group-text>
                            </x-input-group>
                        </div>

                        <div class="col-md-2">
                            <label for="nadi">Nadi</label>
                            <x-input-group class="input-group-sm">
                                <x-input id="nadi" name="nadi" />
                                <x-input-group-text>x/m</x-input-group-text>
                            </x-input-group>
                        </div>

                        <div class="col-md-2">
                            <label for="rr">RR</label>
                            <x-input-group class="input-group-sm">
                                <x-input id="rr" name="rr" placeholder="x/menit" />
                                <x-input-group-text>x/m</x-input-group-text>
                            </x-input-group>
                        </div>

                        <div class="col-md-2">
                            <label for="suhu">Suhu</label>
                            <x-input-group class="input-group-sm">
                                <x-input id="suhu" name="suhu" placeholder="°C" />
                                <x-input-group-text>°C</x-input-group-text>
                            </x-input-group>
                        </div>

                        <div class="col-md-3">
                            <label for="gcs">GCS(E,V,M)</label>
                            <x-input id="gcs" name="gcs" />
                        </div>

                        <div class="col-md-2">
                            <label for="bb">BB</label>
                            <x-input-group class="input-group-sm">
                                <x-input id="bb" name="bb" value="0" />
                                <x-input-group-text>Kg</x-input-group-text>
                            </x-input-group>
                        </div>

                        <div class="col-md-2">
                            <label for="tb">TB</label>
                            <x-input-group class="input-group-sm">
                                <x-input id="tb" name="tb" value="0" />
                                <x-input-group-text>cm</x-input-group-text>
                            </x-input-group>
                        </div>
                        <div class="col-md-2">
                            <label for="lp">LP</label>
                            <x-input-group class="input-group-sm">
                                <x-input name="lp" />
                                <x-input-group-text>cm</x-input-group-text>
                            </x-input-group>
                        </div>
                        <div class="col-md-2">
                            <label for="lk">LK</label>
                            <x-input-group class="input-group-sm">
                                <x-input name="lk" />
                                <x-input-group-text>cm</x-input-group-text>
                            </x-input-group>
                        </div>
                        <div class="col-md-2">
                            <label for="ld">LD</label>
                            <x-input-group class="input-group-sm">
                                <x-input name="ld" />
                                <x-input-group-text>cm</x-input-group-text>
                            </x-input-group>
                        </div>
                    </div>
                </div>
            </div>
            {{-- /I. Keadaan Umum --}}
            <div class="card mb-3">
                <div class="card-header">
                    Riwayat Kesehatan Dulu
                </div>
                <div class="card-body">
                    <div class="row g-2">
                        <div class="col-md-6 col-sm-12">
                            <label for="keluhan_utama">Keluhan Utama</label>
                            <x-textarea cols="4" name="keluhan_utama" id="keluhan_utama">-</x-textarea>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label for="rpk">Riwayat Penyakit Keluarga</label>
                            <x-textarea cols="4" name="rpk" id="rpk">-</x-textarea>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label for="rpd">Riwayat Penyakit Dahulu</label>
                            <x-textarea cols="4" name="rpd" id="rpd">-</x-textarea>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label for="rpo">Riwayat Obat</label>
                            <x-textarea cols="4" name="rpo" id="rpo">-</x-textarea>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label for="alergi">Alergi</label>
                            <x-input name="alergi" />
                        </div>
                    </div>
                </div>
            </div>
            {{-- Riwayat Perinatal Care --}}
            <div class="card mb-3">
                <div class="card-header">
                    Riwayat Perinatal Care
                </div>
                <div class="card-body">
                    <div class="row g-2">
                        <div class="col-md-6 col-sm-12">
                            <label for="" class="d-block">Riwayat Kelahiran</label>
                            <div class="d-flex gap-3">
                                <label for="anak_ke" class="mt-1">Anak Ke :</label>
                                <x-input name="anakke" class="w-25" />
                                <label for="dari" class="mt-1">dari</label>
                                <x-input name="darisaudara" class="w-25" />
                                <label for="dari" class="mt-1">saudara</label>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <label for="caralahir">Cara Kelahiran</label>
                            <x-input-group>
                                <x-select name="caralahir">
                                    <x-option>Spontan</x-option>
                                    <x-option value="Sectio Caesaria">SC</x-option>
                                    <x-option>Lain-lain</x-option>
                                </x-select>
                                <x-input name="ket_caralahir" class="w-50" />
                            </x-input-group>

                        </div>
                        <div class="col-md-4 col-sm-12">
                            <label for="umurkelahiran" class="d-block">Umur Kelahiran</label>
                            <div class="d-flex gap-3">
                                <x-input-radio name="umurkelahiran" id="umurkelahiran1" value="Cukup Bulan"
                                    label="Cukup Bulan" checked />
                                <x-input-radio name="umurkelahiran" id="umurkelahiran2" value="Kurang Bulan"
                                    label="Kurang Bulan" />
                            </div>
                        </div>
                        <div class="col-md-5 col-sm-12">
                            <label for="kelainanbawaan" class="d-block">Umur Kelahiran</label>
                            <div class="d-flex gap-3">
                                <x-input-radio name="kelainanbawaan" id="kelainanbawaan1" value="Ya" label="Ya" />
                                <x-input-radio name="kelainanbawaan" id="kelainanbawaan2" value="Tidak" label="Tidak"
                                    checked />
                                <x-input name="ket_kelainan_bawaan" />
                            </div>


                        </div>

                    </div>
                </div>
            </div>
            {{-- Riwayat Perinatal Care --}}
            {{-- Riwayat Imunisasi --}}
            <div class="card mb-3">
                <div class="card-header">
                    Riwayat Imunisasi
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Imunisasi</th>
                                <th>Ke 1</th>
                                <th>Ke 2</th>
                                <th>Ke 3</th>
                                <th>Ke 4</th>
                                <th>Ke 5</th>
                            </tr>
                        </thead>

                    </table>
                    <button type="button" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus ms-1"></i> Tambah Imunisasi
                    </button>
                </div>
            </div>
            {{-- Riwayat Imunisasi --}}
            {{-- Riwayat Tumbuh Kembang --}}
            <div class="card mb-3">
                <div class="card-header">
                    Riwayat Tumbuh Kembang
                </div>
                <div class="card-body">
                    <div class="row gy-2">
                        <div class="col-md-2 col-sm-12">
                            <label for="usiatengkurap">a. Usia Tengkurap</label>
                            <x-input name="usiatengkurap" />
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <label for="usiaduduk">b. Usia Duduk</label>
                            <x-input name="usiaduduk" />
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <label for="usiaberdiri">c. Usia Berdiri</label>
                            <x-input name="usiaberdiri" />
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <label for="usiagigipertama">d. Gigi Pertama</label>
                            <x-input name="usiagigipertama" />
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <label for="usiaberjalan">e. Usia Berjalan</label>
                            <x-input name="usiaberjalan" />
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <label for="usiabicara">f. Usia Bicara</label>
                            <x-input name="usiabicara" />
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <label for="usiamembaca">g. Usia Membaca</label>
                            <x-input name="usiamembaca" />
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <label for="usiamenulis">h. Usia Menulis</label>
                            <x-input name="usiamenulis" />
                        </div>
                        <div class="col-md-5 col-sm-12">
                            <label for="gangguanemosi">Gangguan Emosi/Perkembangan Mental</label>
                            <x-input name="gangguanemosi" />
                        </div>
                    </div>
                </div>
            </div>
            {{-- Riwayat Tumbuh Kembang --}}
            @include('content.poliklinik.modal.form.partial.askep._status_fungsional')
            @include('content.poliklinik.modal.form.partial.askep._status_psikososial')
        </div>




        {{-- /KOLOM KIRI --}}

        {{-- ======================== KOLOM KANAN ======================== --}}
        <div class="col-md-6">

            {{-- Status Fungsional --}}

            {{-- /Status Fungsional --}}

            {{-- IV. Psikososial --}}

            {{-- /IV. Psikososial --}}

            {{-- IV. Risiko Jatuh --}}
            @include('content.poliklinik.modal.form.partial.askep._risiko_jatuh')
            {{-- /IV. Risiko Jatuh --}}

            {{-- V. Skrining Gizi --}}
            <div class="card mb-3">
                <div class="card-header">
                    <p class="card-title">Skrining Gizi (Strong Kid)</p>
                </div>
                <div class="card-body">
                    <div class="row gy-2">
                        <div class="col-md-8 col-sm-12">
                            <label for="">1. Apakah Pasien Tampak Kurus </label>
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <x-select name="sg1" id="sg1">
                                <option>Tidak</option>
                                <option>Ya</option>
                            </x-select>
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <x-input name="nilai1" value="0" readonly />
                        </div>
                        <div class="col-md-8 col-sm-12">
                            <label for="">2. Apakah terdapat penurunan berat badan selama satu bulan terakhir ?
                                <br>
                                <p class="text-muted ms-3" style="font-size: 10px">(Berdasarkan penilaian objektif data
                                    berat
                                    badan bila
                                    ada atau untuk bayi &lt; 1 tahun; berat badan tidak naik selama 3 bulan
                                    terakhir)</p>
                            </label>
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <x-select name="sg2" id="sg2">
                                <option>Tidak</option>
                                <option>Ya</option>
                            </x-select>
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <x-input name="nilai2" value="0" readonly />
                        </div>
                        <div class="col-md-8 col-sm-">
                            <label for="sg3">3. Asupan terdapat salah satu dari kondisi tersebut ?
                                <br />
                                <p class="text-muted ms-3" style="font-size: 10px">Diare >5x/hari dan
                                    atau
                                    muntah >3x/hari dalam sepekan terakhir;
                                    Asupan makanan berkurang selama sepekan terakhir</p>
                            </label>
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <x-select name="sg3" id="sg3">
                                <option>Tidak</option>
                                <option>Ya</option>
                            </x-select>
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <x-input name="nilai3" value="0" readonly />
                        </div>
                        <div class="col-md-8 col-sm-">
                            <label for="sg4">4. Apakah terdapat penyakit atau keadaan yang menyebabkan pasien berisiko
                                mengalami malnutrisi
                            </label>
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <x-select name="sg4" id="sg4">
                                <option>Tidak</option>
                                <option>Ya</option>
                            </x-select>
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <x-input name="nilai4" value="0" readonly />
                        </div>
                        <div class="col-md-10 col-sm-12 text-end">
                            <label for="">Total Skor</label>
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <x-input name="total_hasil" value="0" readonly />
                        </div>

                    </div>
                </div>

            </div>
            {{-- /V. Skrining Gizi --}}

            {{-- VI. Skrining Nyeri --}}
            <div class="card mb-3">
                <div class="card-header">
                    <p class="card-title">Skrining Nyeri Anak (FLACCS)</p>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="mb-1 col-sm-12 col-md-12 col-lg-6">
                            <div class="input-group">
                                <label for="wajah">Wajah : </label>
                                <select class="form-select" name="wajah" id="wajah"
                                    style="width:60%;border-radius:6px 0 0 6px">
                                    <option value="Tersenyum/tidak ada ekspresi khusus" data-id="0">
                                        Tersenyum/tidak ada ekspresi khusus</option>
                                    <option value="Terkadang meringis/menarik diri" data-id="1">Terkadang
                                        meringis/menarik diri</option>
                                    <option value="Sering menggetarkan dagu dan mengatupkan rahang" data-id="2">
                                        Sering menggetarkan dagu dan mengatupkan rahang</option>
                                </select>
                                <input type="text" class="form-control form-control-sm" id="nilaiwajah"
                                    name="nilaiwajah" value="0" readonly>
                            </div>
                        </div>
                        <div class="mb-1 col-sm-12 col-md-12 col-lg-6">
                            <div class="input-group">
                                <label for="menangis">Menangis : </label>
                                <select class="form-select" name="menangis" id="menangis"
                                    style="width:60%;border-radius:6px 0 0 6px">
                                    <option value="Tidak menangis (mudah bergerak)" data-id="0">Tidak menangis
                                        (mudah bergerak)</option>
                                    <option value="Mengerang/merengek" data-id="1">Mengerang/merengek</option>
                                    <option value="Menangis terus menerus, terisak, menjerit" data-id="2">
                                        Menangis terus menerus, terisak, menjerit</option>
                                </select>
                                <input type="text" class="form-control form-control-sm" id="nilaimenangis"
                                    name="nilaimenangis" value="0" readonly>
                            </div>
                        </div>
                        <div class="mb-1 col-sm-12 col-md-12 col-lg-6">
                            <div class="input-group">
                                <label for="kaki">Kaki : </label>
                                <select class="form-select" name="kaki" id="kaki"
                                    style="width:60%;border-radius:6px 0 0 6px">
                                    <option value="Gerakan normal/relaksasi" data-id="0">Gerakan
                                        normal/relaksasi</option>
                                    <option value="Tidak tenang/tegang" data-id="1">Tidak tenang/tegang</option>
                                    <option value="Kaki dibuat menendang/menarik" data-id="2">Kaki dibuat
                                        menendang/menarik</option>
                                </select>
                                <input type="text" class="form-control form-control-sm" id="nilaikaki" name="nilaikaki"
                                    value="0" readonly>
                            </div>
                        </div>
                        <div class="mb-1 col-sm-12 col-md-12 col-lg-6">
                            <div class="input-group">
                                <label for="bersuara">Bersuara : </label>
                                <select class="form-select" name="bersuara" id="bersuara"
                                    style="width:60%;border-radius:6px 0 0 6px">
                                    <option value="Bersuara normal/tenang" data-id="0">Bersuara normal/tenang
                                    </option>
                                    <option value="Tenang bila dipeluk, digendong/diajak bicara" data-id="1">
                                        Tenang bila dipeluk, digendong/diajak bicara</option>
                                    <option value="Sulit untuk menenangkan" data-id="2">Sulit untuk menenangkan
                                    </option>
                                </select>
                                <input type="text" class="form-control form-control-sm" id="nilaibersuara"
                                    name="nilaibersuara" value="0" readonly>
                            </div>
                        </div>
                        <div class="mb-1 col-sm-12 col-md-12 col-lg-6">
                            <div class="input-group">
                                <label for="aktifitas">Aktifitas : </label>
                                <select class="form-select" name="aktifitas" id="aktifitas"
                                    style="width:60%;border-radius:6px 0 0 6px">
                                    <option value="Tidur posisi normal, mudah bergerak" data-id="0">Tidur posisi
                                        normal, mudah bergerak</option>
                                    <option value="Gerakan menggeliat/berguling, kaku" data-id="1">Gerakan
                                        menggeliat/berguling, kaku</option>
                                    <option value="Melengkungkan punggung/kaku menghentak" data-id="2">
                                        Melengkungkan punggung/kaku menghentak</option>
                                </select>
                                <input type="text" class="form-control form-control-sm" id="nilaiaktifitas"
                                    name="nilaiaktifitas" value="0" readonly>
                            </div>
                        </div>
                        <div class="mb-1 col-sm-12 col-md-12 col-lg-3">
                            <div class="input-group">
                                <label for="hasilnyeri">Skala Nyeri : </label>
                                <input type="text" class="form-control form-control-sm" id="hasilnyeri"
                                    name="hasilnyeri" value="0" style="border-radius:6px" readonly>
                            </div>
                        </div>
                        <div class="mt-2 col-sm-12 col-md-12 col-lg-6">
                            <img src="{{ asset('/img/skala_nyeri_wong_baker.png') }}" alt="" class="mx-auto d-block"
                                style="max-width:100%;height:auto">
                        </div>

                        <div class="mt-2 col-sm-12 col-md-12 col-lg-6">
                            <div class="row gy-1">
                                <div class="mb-1 col-lg-5">
                                    <select class="form-select" name="nyeri" id="nyeri">
                                        <option value="Tidak Ada Nyeri">Tidak Ada Nyeri</option>
                                        <option value="Nyeri Akut">Nyeri Akut</option>
                                        <option value="Nyeri Kronis">Nyeri Kronis</option>
                                    </select>
                                </div>
                                <div class="mb-1 col-lg-7">
                                    <div class="input-group">
                                        <label for="lokasi">Lokasi : </label>
                                        <input type="text" class="form-control form-control-sm" id="lokasi"
                                            name="lokasi" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-"
                                            autocomplete="off" style="border-radius:6px">
                                    </div>
                                </div>
                                <div class="mb-1 col-lg-6">
                                    <div class="input-group">
                                        <label for="durasi">Durasi : </label>
                                        <input type="text" class="form-control form-control-sm" id="durasi"
                                            name="durasi" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-"
                                            autocomplete="off" style="border-radius:6px">
                                    </div>
                                </div>
                                <div class="mb-1 col-lg-6">
                                    <div class="input-group">
                                        <label for="frekuensi">Frekuensi : </label>
                                        <input type="text" class="form-control form-control-sm" id="frekuensi"
                                            name="frekuensi" onfocus="removeZero(this)" onblur="cekKosong(this)"
                                            value="-" autocomplete="off" style="border-radius:6px">
                                    </div>
                                </div>
                                <div class="mb-1 col-lg-12">
                                    <div class="input-group">
                                        <label for="nyeri_hilang">Nyeri Hilang Bila : </label>
                                        <select class="form-select" name="nyeri_hilang" id="nyeri_hilang"
                                            style="border-radius:6px 0 0 6px">
                                            <option value="Minum Obat">Minum Obat</option>
                                            <option value="Istirahat">Istirahat</option>
                                            <option value="Mendengarkan Musik">Mendengarkan Musik</option>
                                            <option value="Berubah Posisi/Tidur">Berubah Posisi/Tidur</option>
                                            <option value="Lain-lain">Lain-lain</option>
                                        </select>
                                        <input type="text" class="form-control form-control-sm" id="ket_nyeri"
                                            name="ket_nyeri" onfocus="removeZero(this)" onblur="cekKosong(this)"
                                            value="-" autocomplete="off">
                                    </div>
                                </div>
                                <div class="mb-1 col-lg-12">
                                    <div class="input-group">
                                        <label for="pada_dokter">Diberitahukan pada dokter ? </label>
                                        <select class="form-select" name="pada_dokter" id="pada_dokter"
                                            style="border-radius:6px">
                                            <option value="Tidak">Tidak</option>
                                            <option value="Ya">Ya</option>
                                        </select>
                                        <label for="ket_dokter">Jam : </label>
                                        <input type="time" class="form-control form-control-sm" id="ket_dokter"
                                            name="ket_dokter" onfocus="removeZero(this)" onblur="cekKosong(this)"
                                            disabled value="00:00:00" autocomplete="off" style="border-radius:6px">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <label for="" class="mb-2">Skala FLACCS : </label> --}}

            </div>
            {{-- /VI. Skrining Nyeri --}}

            {{-- VII. Masalah dan Tindakan Kebidanan --}}
            <div class="card mb-3">
                <div class="card-header">
                    Masalah dan Tindakan
                </div>
                <div class="card-body">

                    <div class="row gy-1">
                        <div class="mb-1 col-sm-12 col-md-12 col-lg-6">
                            <table id="tbMasalahKeperawatan" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>P</th>
                                        <th>Diagnosis Keperawatan</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="mb-1 mt-1 col-sm-12 col-md-12 col-lg-6">
                            <ul class="nav nav-tabs" id="tabMasalah" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button style="font-size:10px;padding:6px" class="nav-link active" id="rancana"
                                        data-bs-toggle="tab" data-bs-target="#rancana-pane" type="button" role="tab"
                                        aria-controls="rancana-pane" aria-selected="true">Rencana Keperawatan</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button style="font-size:10px;padding:6px" class="nav-link" id="tindakan"
                                        data-bs-toggle="tab" data-bs-target="#tindakan-pane" type="button" role="tab"
                                        aria-controls="tindakan-pane" aria-selected="false">Tindakan
                                        Keperawatan</button>
                                </li>

                            </ul>
                            <div class="tab-content" id="tabIsiMasalah">
                                <div class="tab-pane fade show active p-2" id="rancana-pane" role="tabpanel"
                                    aria-labelledby="rancana" tabindex="0">
                                    <table id="tbRencanaKeperawatan" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>P</th>
                                                <th>Rencana Keperawatan</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade p-2" id="tindakan-pane" role="tabpanel"
                                    aria-labelledby="tindakan" tabindex="0">
                                    <textarea class="form-control" name="rencana" id="rencana" cols="30"
                                        rows="10">-</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            {{-- /VII. Masalah dan Tindakan Kebidanan --}}
            <button class="btn btn-primary btn-sm" onclick="printAskepAwalObgyn()" id="btnPrintAskepAwalObgyn">
                <i class="bi bi-printer ms-2 "></i> Cetak Asesmen
            </button>

        </div>
        {{-- /KOLOM KANAN --}}

    </div>
    {{-- /row --}}

</form>
{{-- /formAskepAwalAnak --}}




@push('script')
    <script>
        const formAskepAwalAnak = $('#formAskepAwalAnak');
        const formInfoAskepAwalAnak = $('#formInfoAskepAwalAnak');
        const rangeSkalaNyeriAnak = formAskepAwalAnak.find('input[name=skala_nyeri]');

        var kodeMasalah = []
        var kodeRencana = []

        function getAskepAwalAnak(no_rawat) {
            tbMasalahKeperawatan()
            getRegPeriksa(no_rawat).done((response) => {
                const {
                    pasien,
                    dokter,
                    poliklinik,
                    penjab
                } = response;
                const umur = hitungUmurDaftar(pasien?.tgl_lahir, response.tgl_registrasi);
                const textUmurDaftar = `${umur.tahun} Tahun ${umur.bulan} Bulan ${umur.hari} Hari`;
                formInfoAskepAwalAnak.find('input[name=no_rawat]').val(no_rawat)
                formInfoAskepAwalAnak.find('input[name=no_rkm_medis]').val(pasien?.no_rkm_medis)
                formInfoAskepAwalAnak.find('input[name=pasien]').val(`${pasien?.nm_pasien} (${pasien?.jk})`)
                formInfoAskepAwalAnak.find('input[name=tgl_lahir]').val(`${formatTanggal(pasien?.tgl_lahir)}`)
                formInfoAskepAwalAnak.find('input[name=umurdaftar]').val(`${textUmurDaftar}`)
                formInfoAskepAwalAnak.find('input[name=penjab]').val(penjab?.png_jawab)
                formInfoAskepAwalAnak.find('input[name=dokter]').val(dokter?.nm_dokter)
                $.get("{{ route('asesmen-keperawatan.anak.get') }}", {
                    no_rawat: no_rawat,
                }).done((response) => {
                    let optPetugas = ''
                    if (response.data) {
                        const { petugas, pasien } = response.data
                        setDataForm(formAskepAwalAnak, response.data);
                        optPetugas = new Option(petugas?.nama, petugas?.nik, true, true);
                        formAskepAwalAnak.find('select[name=nip]').append(optPetugas).trigger('change');
                        formAskepAwalAnak.find('input[name=tanggal]').val(response.data.tanggal);
                        return '';
                    }

                    const jam = moment().format('HH:mm:ss')
                    optPetugas = new Option("{{ session()->get('pegawai')->nama }}", "{{ session()->get('pegawai')->nik }}", true,
                        true);
                    formAskepAwalAnak.find('select[name=nip]').append(optPetugas).trigger('change');
                    formAskepAwalAnak.find('input[name=tanggal]').val(new Date().toISOString().slice(0, -1));
                    // formAskepAwalAnak.find("input[name=ket_lapor]").val(jam);
                    // formAskepAwalAnak.find("input[name=ket_dokter]").val(jam);
                })
                // renderTableRiwayatPersalinan(pasien.no_rkm_medis)
            })
        }

        function createAskepAwalAnak() {
            const data = getDataForm('#formAskepAwalAnak', ['input', 'select', 'textarea']);
            data['no_rawat'] = formInfoAskepAwalAnak.find('input[name=no_rawat]').val();
            const masalahKeperawatan = $('input[name=chekMasalahKeperawatan]').val();
            $.post("{{ route('asesmen-keperawatan.anak.store') }}", data)
                .done((response) => {
                    console.log('DATA ===', data, 'RESPONSE ===', response);

                    if (response.success) {
                        alertSuccessAjax(response.message);
                    }
                })
                .fail((request) => {
                    if (request.status === 422) {
                        return handleValidationError(request)
                    } else {
                        // Menangani error selain 422 (misal: 500)
                        alertErrorAjax(request.responseJSON?.message || 'Terjadi kesalahan pada server');
                    }
                });

        }
        const selectPetugasAskepAnak = formAskepAwalAnak.find('select[name=nip]')
        selectPetugasAskepAnak.select2({
            ajax: {
                url: '/erm/petugas/cari',
                dataType: 'json',
                dropdownParent: formAskepAwalAnak,
                width: 'resolve',
                processResults: (data) => {
                    return {
                        results: data.map((pegawai) => {
                            return {
                                id: pegawai.nip,
                                text: pegawai.nama
                            }
                        })
                    }
                }
            }
        })

        formAskepAwalAnak.on('change', 'select[name^="sg"]', function () {
            const name = $(this).attr('name');
            const index = name.replace('sg', '');
            const jawaban = $(this).val();
            let skor = 0;
            if (jawaban === 'Ya') {
                skor = 1;
            }
            formAskepAwalAnak
                .find(`input[name="nilai${index}"]`)
                .val(skor)
                .trigger('change');
            hitungSkorGiziAnak();
        });
        function hitungSkorGiziAnak() {
            let total = 0;
            for (let i = 1; i <= 4; i++) {
                let nilaiInput = parseInt(formAskepAwalAnak.find(`input[name="nilai${i}"]`).val()) || 0;
                total += nilaiInput;
            }
            formAskepAwalAnak.find('input[name="total_hasil"]').val(total);
        }



        formAskepAwalAnak.on(
            'change',
            'input[name="berjalan_a"], input[name="berjalan_b"], input[name="berjalan_c"]',
            function () {
                hitungResikoJatuh(formAskepAwalAnak)
            }
        );
        formAskepAwalAnak.find('input[name=lapor]').on('change', function (e) {

            if (e.currentTarget.value == 'Ya') {
                const jam = moment().format('HH:mm:ss')
                formAskepAwalAnak.find('input[name=ket_lapor]')
                    .prop('disabled', false)
                    .trigger('change').val(jam);
            } else {
                formAskepAwalAnak.find('input[name=ket_lapor]')
                    .prop('disabled', true)
                    .val('');
            }
        })
        formAskepAwalAnak.find('input[name=pada_dokter]').on('change', function (e) {

            if (e.currentTarget.value == 'Ya') {
                const jam = moment().format('HH:mm:ss')
                formAskepAwalAnak.find('input[name=ket_dokter]')
                    .prop('disabled', false)
                    .trigger('change').val(jam);
            } else {
                formAskepAwalAnak.find('input[name=ket_dokter]')
                    .prop('disabled', true)
                    .val('');
            }
        })
        rangeSkalaNyeriAnak.on('change', function (e) {
            formAskepAwalAnak.find('span[id=nilai_skala_nyeri]')
                .text(e.currentTarget.value);
        });

        function printAskepAwalObgyn() {
            // Ambil nilai no_rawat dari input atau atribut elemen
            const noRawat = formInfoAskepAwalAnak.find('input[name="no_rawat"]').val();

            // Pastikan noRawat ada sebelum mencetak
            if (noRawat) {
                const url = `/erm/asesmen-keperawatan/kandungan/print?no_rawat=${encodeURIComponent(noRawat)}`;
                window.open(url, '_blank');
            } else {
                alert('Nomor rawat tidak ditemukan!');
            }
        }
        function showModalRiwayatPersalinanAskep() {
            const no_rkm_medis = formInfoAskepAwalAnak.find('input[name="no_rkm_medis"]').val()
            $('#modalRiwayatPersalinan').modal('show')
            $('#formRiwayatPersalinan').find('input[name=no_rkm_medis]').val(no_rkm_medis);
        }


        function tbMasalahKeperawatan() {
            $('#tbMasalahKeperawatan').dataTable({
                destroy: true,
                processing: true,
                ordering: false,
                paging: false,
                scrollY: 250,
                info: false,
                ajax: {
                    url: '/erm/master/masalah/keperawatan/table',
                },
                columns: [{
                    data: '',
                    render: (data, type, row) => {
                        return `<div class="form-check masalahKeperawatan">
                                                                                                                                                                                                                                                                                                    <input class="form-check-input listMasalahKeperawatan" name="checkMasalahKeperawatan" type="checkbox" id="kodeMasalah${row.kode_masalah}" onclick="cekMasalahKeperawatan(this,'${row.kode_masalah}')" value="${row.kode_masalah}">
                                                                                                                                                                                                                                                                                                </div>`
                    }
                }, {
                    data: '',
                    render: (data, type, row) => {

                        return `<label onclick="cekMasalahKeperawatan(this,'${row.kode_masalah}')">${row.nama_masalah}</label>`
                    }
                }]
            })
        }


        function getRencanaKeperawatan(no_rawat) {
            const rencana = $.ajax({
                url: '/erm/ranap/askep/anak/rencana',
                data: {
                    no_rawat: no_rawat
                },
                method: 'GET'
            })

            return rencana
        }



        function cekMasalahKeperawatan(element, params) {
            const isChecked = $(`#kodeMasalah${params}`).is(':checked')
            if (isChecked) {
                kodeMasalah.push(params)
            } else {
                kodeMasalah = kodeMasalah.filter((item) => {
                    return item != params
                });
            }
            tbRencanaKeperawatan(kodeMasalah)
            if (kodeMasalah.length == 0) {
                localStorage.removeItem(`kodeRencana`)
            }
        }

        function cekRencanaKeperawatan(params) {
            const isChecked = $(`#kodeRencana${params}`).is(':checked')
            if (isChecked) {
                kodeRencana.push(params)
            } else {
                kodeRencana = kodeRencana.filter((item) => {
                    return item != params
                });
            }
            if (kodeRencana.length == 0) {
                localStorage.removeItem(`kodeRencana`)
            } else {
                localStorage.setItem(`kodeRencana`, JSON.stringify(kodeRencana))
            }
        }

        function tbRencanaKeperawatan(kode) {
            $('#tbRencanaKeperawatan').dataTable({
                destroy: true,
                processing: true,
                ordering: false,
                paging: false,
                scrollY: 240,
                info: false,
                searching: false,
                ajax: {
                    url: '/erm/master/rencana/keperawatan/table/',
                    data: {
                        kode: kode,
                    },
                },
                columns: [{
                    data: '',
                    render: (data, type, row) => {
                        kode = localStorage.kodeRencana ? JSON.parse(localStorage.kodeRencana) : ''
                        $.map(kode, (kd) => {
                            if (kd == row.kode_rencana) {
                                $('#kodeRencana' + row.kode_rencana).attr('checked', 'checked')
                            } else {
                                $('#kodeRencana' + row.kode_rencana).removeProp('checked')
                            }

                        })

                        return `<div class="form-check">
                                                                                                                                                                                                                                                                                                    <input class="form-check-input listRencanaKeperawatan" name="checkRencanaKeperawatan" type="checkbox" value="${row.kode_rencana}" data-masalah="${row.kode_masalah}" onclick="cekRencanaKeperawatan('${row.kode_rencana}')" id="kodeRencana${row.kode_rencana}" onclick="">
                                                                                                                                                                                                                                                                                                </div>`
                    }
                },
                {
                    data: '',
                    render: (data, type, row) => {
                        return row.rencana_keperawatan
                    }
                }
                ],
                initComplete: (response) => {
                    no_rawat = $('#formAskepAwalAnak input[name=no_rawat]').val();
                    getRencanaKeperawatan(no_rawat).done((res) => {
                        $.map(res, (rencana) => {
                            $('#kodeRencana' + rencana.kode_rencana).attr('checked', 'checked')
                        })
                    })
                }
            })
        }
        $('#formAskepAwalAnak select[name=menangis]').change((e) => {
            const data = $('#formAskepAwalAnak select[name=menangis]').find(':selected').data('id')
            $('#formAskepAwalAnak input[name=nilaimenangis]').val(data)
            hitungSkalaNyeriAnak()
        })
        $('#formAskepAwalAnak select[name=wajah]').change((e) => {
            const data = $('#formAskepAwalAnak select[name=wajah]').find(':selected').data('id')
            $('#formAskepAwalAnak input[name=nilaiwajah]').val(data)
            hitungSkalaNyeriAnak()
        })
        $('#formAskepAwalAnak select[name=kaki]').change((e) => {
            const data = $('#formAskepAwalAnak select[name=kaki]').find(':selected').data('id')
            $('#formAskepAwalAnak input[name=nilaikaki]').val(data)
            hitungSkalaNyeriAnak()
        })
        $('#formAskepAwalAnak select[name=aktifitas]').change((e) => {
            const data = $('#formAskepAwalAnak select[name=aktifitas]').find(':selected').data('id')
            $('#formAskepAwalAnak input[name=nilaiaktifitas]').val(data)
            hitungSkalaNyeriAnak()
        })
        $('#formAskepAwalAnak select[name=bersuara]').change((e) => {
            const data = $('#formAskepAwalAnak select[name=bersuara]').find(':selected').data('id')
            $('#formAskepAwalAnak input[name=nilaibersuara]').val(data)
            hitungSkalaNyeriAnak()
        })

        function hitungSkalaNyeriAnak() {
            bersuara = $('#formAskepAwalAnak input[name=nilaibersuara]').val();
            menangis = $('#formAskepAwalAnak input[name=nilaimenangis]').val();
            wajah = $('#formAskepAwalAnak input[name=nilaiwajah]').val();
            kaki = $('#formAskepAwalAnak input[name=nilaikaki]').val();
            aktifitas = $('#formAskepAwalAnak input[name=nilaiaktifitas]').val();

            skalaNyeri = parseInt(bersuara) + parseInt(menangis) + parseInt(wajah) + parseInt(kaki) + parseInt(aktifitas);

            $('#formAskepAwalAnak input[name=hasilnyeri]').val(skalaNyeri)

            if (skalaNyeri >= 1 && skalaNyeri <= 3) {
                nyeri = 'Nyeri Ringan'
            } else if (skalaNyeri >= 4 && skalaNyeri <= 6) {
                nyeri = 'Nyeri Sedang'
            } else if (skalaNyeri >= 7 && skalaNyeri <= 10) {
                nyeri = 'Nyeri Akut'
            } else {
                nyeri = 'Tidak Ada Nyeri'
            }
            $('#formAskepAwalAnak select[name=nyeri]').val(nyeri)
        }
        formAskepAwalAnak.find('select[name=pada_dokter]').on('change', function (e) {
            if (e.currentTarget.value == 'Ya') {
                const jam = moment().format('HH:mm:ss');
                formAskepAwalAnak.find('input[name=ket_dokter]')
                    .prop('disabled', false)
                    .trigger('change').val(jam);
            } else {
                formAskepAwalAnak.find('input[name=ket_dokter]')
                    .prop('disabled', true)
                    .val('00:00:00');
            }
        })
    </script>
@endpush

{{-- @endsection --}}