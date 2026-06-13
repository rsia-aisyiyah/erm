@extends('index')
@section('contents')
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
                                    <x-input id="bb" name="bb" type="number" value="0" />
                                    <x-input-group-text>Kg</x-input-group-text>
                                </x-input-group>
                            </div>

                            <div class="col-md-3">
                                <label for="tb">TB</label>
                                <x-input-group class="input-group-sm">
                                    <x-input id="tb" name="tb" type="number" value="0" />
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
                                <label for="ld">Ld</label>
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
                                <x-input name="nilai1" />
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
                                <x-input name="nilai2" />
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
                                <x-input name="nilai3" />
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
                                <x-input name="nilai4" />
                            </div>
                            <div class="col-md-10 col-sm-12 text-end">
                                <label for="">Total Skor</label>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <x-input name="total_hasil" />
                            </div>

                        </div>
                    </div>

                </div>
                {{-- /V. Skrining Gizi --}}

                {{-- VI. Skrining Nyeri --}}
                @include('content.poliklinik.modal.form.partial.askep._skrining_nyeri')
                {{-- /VI. Skrining Nyeri --}}

                {{-- VII. Masalah dan Tindakan Kebidanan --}}
                <div class="card mb-3">
                    <div class="card-header">
                        Masalah dan Tindakan
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="mb-1 col-sm-12 col-md-12 col-lg-6">
                                <table id="tbMasalahKeperawatan" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>P</th>
                                            <th>Masalah Keperawatan</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="mb-1 mt-1 col-sm-12 col-md-12 col-lg-6">
                                <ul class="nav nav-tabs" id="tabMasalah" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button style="font-size:10px;padding:6px" class="nav-link active" id="rencana"
                                            data-bs-toggle="tab" data-bs-target="#rencana-pane" type="button" role="tab"
                                            aria-controls="rencana-pane" aria-selected="true">Rencana Keperawatan</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button style="font-size:10px;padding:6px" class="nav-link" id="tindakan"
                                            data-bs-toggle="tab" data-bs-target="#tindakan-pane" type="button" role="tab"
                                            aria-controls="tindakan-pane" aria-selected="false">Tindakan
                                            Keperawatan</button>
                                    </li>

                                </ul>
                                <div class="tab-content" id="tabIsiMasalah">
                                    <div class="tab-pane fade show active p-2" id="rencana-pane" role="tabpanel"
                                        aria-labelledby="rencana" tabindex="0">
                                        <table id="tbRencanaKeperawatano" class="table table-striped">
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
                                            rows="15"></textarea>
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
            const rangeSkalaNyeri = formAskepAwalAnak.find('input[name=skala_nyeri]');

            $(document).ready(function () {
                tbMasalahKeperawatan()
            })

            function hitungKehamilan() {
                const hpht = $('#hpht').val();
                if (!hpht) {
                    $('#usia_kehamilan').val('');
                    $('#tp').val('');
                    return;
                }
                const hphtDate = new Date(hpht);
                const
                    today = new Date();
                const selisihHari = Math.floor((today - hphtDate) / (1000 * 60 * 60 * 24));
                const
                    minggu = Math.floor(selisihHari / 7);
                const hari = selisihHari % 7;
                $('#usia_kehamilan').val(`${minggu}m+${hari}h`);
                const hplDate = new Date(hphtDate);
                hplDate.setDate(hplDate.getDate() + 280);
                const yyyy = hplDate.getFullYear();
                const mm = String(hplDate.getMonth() + 1).padStart(2, '0');
                const dd = String(hplDate.getDate()).padStart(2, '0');
                $('#tp').val(`${yyyy}-${mm}-${dd}`);

            }
            $(document).on('change', '#hpht', hitungKehamilan);

            function getAskepAwalObgyn(no_rawat) {
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
                    $.get("{{ route('asesmen-keperawatan.kandungan.get') }}", {
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
                    renderTableRiwayatPersalinan(pasien.no_rkm_medis)
                })
            }

            function createAskepAwalObgyn() {
                const data = getDataForm('#formAskepAwalAnak', ['input', 'select', 'textarea']);
                data['no_rawat'] = formInfoAskepAwalAnak.find('input[name=no_rawat]').val();

                $.post("{{ route('asesmen-keperawatan.kandungan.store') }}", data)
                    .done((response) => {
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

            formAskepAwalAnak.on('change', 'select[name=sg1]', function () {

                const nilai = $(this)
                    .find('option:selected')
                    .data('nilai');

                formAskepAwalAnak
                    .find('select[name=nilai1]')
                    .val(nilai)
                    .trigger('change');

                hitungSkorGizi();
            });

            formAskepAwalAnak.on('change', 'input[name=sg2]', function () {

                const nilai = $(this).data('nilai');

                formAskepAwalAnak
                    .find('select[name=nilai2]')
                    .val(nilai)
                    .trigger('change');

                hitungSkorGizi();
            });
            function hitungSkorGizi() {

                const nilai1 = parseInt(
                    formAskepAwalAnak.find('select[name=nilai1]').val() || 0
                );

                const nilai2 = parseInt(
                    formAskepAwalAnak.find('select[name=nilai2]').val() || 0
                );

                const total = nilai1 + nilai2;

                formAskepAwalAnak
                    .find('input[name=total_hasil]')
                    .val(total);
            }
            function hitungResikoJatuh() {
                const a = formAskepAwalAnak
                    .find('input[name="berjalan_a"]:checked')
                    .val();
                const b = formAskepAwalAnak
                    .find('input[name="berjalan_b"]:checked')
                    .val();

                let hasil = '';

                if (a === 'Ya' && b === 'Ya') {

                    hasil = 'Resiko Tinggi (Ditemukan A Dan B)';

                    formAskepAwalAnak
                        .find('input[name="lapor"][value="Ya"]')
                        .prop('checked', true);

                } else if (a === 'Ya' || b === 'Ya') {

                    hasil = 'Resiko Rendah (Ditemukan A/B)';

                } else {

                    hasil = 'Tidak Beresiko (Tidak Ditemukan A Dan B)';
                }

                formAskepAwalAnak
                    .find('select[name="hasil"]')
                    .val(hasil);
            }
            formAskepAwalAnak.on(
                'change',
                'input[name="berjalan_a"], input[name="berjalan_b"]',
                hitungResikoJatuh
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

            function hapusRiwayatPersalinan(no_rkm_medis, tgl_thn) {
                Swal.fire({
                    title: 'Konfirmasi',
                    text: "Yakin ingin menghapus data ini?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Hapus'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('riwayat.persalinan.delete') }}",
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}',
                                no_rkm_medis: no_rkm_medis,
                                tgl_thn: tgl_thn
                            },
                            success: (response) => {
                                alertSuccessAjax('Data berhasil dihapus');
                                // Panggil ulang fungsi render tabel Anda
                                renderTableRiwayatPersalinan(no_rkm_medis);
                            },
                            error: (xhr) => {
                                alertErrorAjax('Gagal menghapus data');
                            }
                        });
                    }
                });
            }
        </script>
    @endpush

@endsection