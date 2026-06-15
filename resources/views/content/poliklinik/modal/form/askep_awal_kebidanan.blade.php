{{-- @extends('index') --}}
{{-- @section('contents') --}}
{{-- Form Info Pasien (readonly) --}}
<div class="border p-2 mb-3 bg-light">
    <form action="" accept="" id="formInfoAskepAwalObgyn">
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
<form action="" method="post" id="formAskepAwalObgyn">

    <div class="row">

        {{-- ======================== KOLOM KIRI ======================== --}}
        <div class="col-md-6">

            {{-- I. Keadaan Umum --}}
            <div class="card mb-3">
                <div class="card-header">
                    I. Keadaan Umum
                </div>
                <div class="card-body">
                    <div class="row g-2">

                        <div class="col-md-5">
                            <label for="nip">Petugas</label>
                            <x-select id="nip" name="nip" style="width:100%"
                                data-dropdown-parent="#formAskepAwalObgyn"></x-select>
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
                                <x-input id="bb" name="bb" />
                                <x-input-group-text>Kg</x-input-group-text>
                            </x-input-group>
                        </div>

                        <div class="col-md-3">
                            <label for="tb">TB</label>
                            <x-input-group class="input-group-sm">
                                <x-input id="tb" name="tb" />
                                <x-input-group-text>cm</x-input-group-text>
                            </x-input-group>
                        </div>

                        <div class="col-md-3">
                            <label for="lila">LILA</label>
                            <x-input-group class="input-group-sm">
                                <x-input id="lila" name="lila" />
                                <x-input-group-text>cm</x-input-group-text>
                            </x-input-group>
                        </div>

                        <div class="col-md-3">
                            <label for="bmi">BMI</label>
                            <x-input-group class="input-group-sm">
                                <x-input id="bmi" name="bmi" />
                                <x-input-group-text>Kg/M²</x-input-group-text>
                            </x-input-group>
                        </div>

                    </div>
                </div>
            </div>
            {{-- /I. Keadaan Umum --}}

            {{-- II. Pemeriksaan Kebidanan --}}
            <div class="card mb-3">
                <div class="card-header">
                    II. Pemeriksaan Kebidanan
                </div>
                <div class="card-body">
                    <div class="row g-2">

                        <div class="col-md-3">
                            <label for="tfu">TFU</label>
                            <x-input-group class="input-group-sm">
                                <x-input id="tfu" name="tfu" />
                                <x-input-group-text>cm</x-input-group-text>
                            </x-input-group>
                        </div>

                        <div class="col-md-3">
                            <label for="tbj">TBJ</label>
                            <x-input id="tbj" name="tbj" />
                        </div>

                        <div class="col-md-2">
                            <label for="letak">Letak</label>
                            <x-input id="letak" name="letak" />
                        </div>

                        <div class="col-md-2">
                            <label for="presentasi">Presentasi</label>
                            <x-input id="presentasi" name="presentasi" />
                        </div>

                        <div class="col-md-2">
                            <label for="penurunan">Penurunan</label>
                            <x-input id="penurunan" name="penurunan" />
                        </div>

                        <div class="col-md-3">
                            <label for="his">Kontraksi/HIS</label>
                            <x-input-group class="input-group-sm">
                                <x-input id="his" name="his" />
                                <x-input-group-text>x/10`</x-input-group-text>
                            </x-input-group>
                        </div>

                        <div class="col-md-2">
                            <label for="kekuatan">Kekuatan</label>
                            <x-input id="kekuatan" name="kekuatan" />
                        </div>

                        <div class="col-md-3">
                            <label for="lamanya">Lamanya</label>
                            <x-input-group class="input-group-sm">
                                <x-input id="lamanya" name="lamanya" />
                                <x-input-group-text>detik</x-input-group-text>
                            </x-input-group>
                        </div>

                        <div class="col-md-4">
                            <label for="bjj">Gerak janin x/30 mnt, bjj:</label>
                            <div class="d-flex gap-2">
                                <div>
                                    <x-input-group class="input-group-sm">
                                        <x-input id="bjj" name="bjj" />
                                        <x-input-group-text>/m</x-input-group-text>
                                    </x-input-group>
                                </div>
                                <div>
                                    <x-select name="ket_bjj" id="ket_bjj">
                                        <x-option>Teratur</x-option>
                                        <x-option>Tidak Teratur</x-option>
                                    </x-select>
                                </div>
                            </div>
                        </div>

                    </div>

                    <hr>

                    <div class="row g-2 mb-2">

                        <div class="col-md-2">
                            <label for="portio">Portio</label>
                            <x-input name="portio" />
                        </div>

                        <div class="col-md-3">
                            <label for="serviks">Pembukaan Serviks</label>
                            <x-input-group class="input-group-sm">
                                <x-input name="serviks" />
                                <x-input-group-text>cm</x-input-group-text>
                            </x-input-group>
                        </div>

                        <div class="col-md-3">
                            <label for="ketuban">Ketuban</label>
                            <x-input-group class="input-group-sm">
                                <x-input name="ketuban" />
                                <x-input-group-text>kep/bok</x-input-group-text>
                            </x-input-group>
                        </div>

                        <div class="col-md-3">
                            <label for="hodge">Hodge</label>
                            <x-input name="hodge" />
                        </div>

                    </div>

                    <p class="fw-bold border-bottom pb-1 mb-2">Pemeriksaan Penunjang</p>

                    <div class="row g-2">

                        <div class="col-md-6">
                            <div class="row align-items-end">
                                <div class="col-md-4">
                                    <label for="inspekulo">Inspekulo</label>
                                    <x-select name="inspekulo">
                                        <x-option>Dilakukan</x-option>
                                        <x-option>Tidak</x-option>
                                    </x-select>
                                </div>
                                <div class="col-md-8">
                                    <label for="ket_inspekulo">Hasil Inspekulo</label>
                                    <x-input name="ket_inspekulo" placeholder="Hasil Inspekulo" />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="row align-items-end">
                                <div class="col-md-4">
                                    <label for="ctg">CTG</label>
                                    <x-select name="ctg">
                                        <x-option>Dilakukan</x-option>
                                        <x-option>Tidak</x-option>
                                    </x-select>
                                </div>
                                <div class="col-md-8">
                                    <label for="ket_ctg">Hasil CTG</label>
                                    <x-input name="ket_ctg" placeholder="Hasil CTG" />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="row align-items-end">
                                <div class="col-md-4">
                                    <label for="usg">USG</label>
                                    <x-select name="usg">
                                        <x-option>Dilakukan</x-option>
                                        <x-option>Tidak</x-option>
                                    </x-select>
                                </div>
                                <div class="col-md-8">
                                    <label for="ket_usg">Hasil USG</label>
                                    <x-input name="ket_usg" placeholder="Hasil USG" />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="row align-items-end">
                                <div class="col-md-4">
                                    <label for="lab">Laboratorium</label>
                                    <x-select name="lab">
                                        <x-option>Dilakukan</x-option>
                                        <x-option>Tidak</x-option>
                                    </x-select>
                                </div>
                                <div class="col-md-8">
                                    <label for="ket_lab">Hasil Laboratorium</label>
                                    <x-input name="ket_lab" placeholder="Hasil Laboratorium" />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="row align-items-end">
                                <div class="col-md-4">
                                    <label for="lakmus">Lakmus</label>
                                    <x-select name="lakmus">
                                        <x-option>Dilakukan</x-option>
                                        <x-option>Tidak</x-option>
                                    </x-select>
                                </div>
                                <div class="col-md-8">
                                    <label for="ket_lakmus">Hasil Lakmus</label>
                                    <x-input name="ket_lakmus" placeholder="Hasil Lakmus" />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="row align-items-end">
                                <div class="col-md-6">
                                    <label for="panggul">Panggul</label>
                                    <x-select name="panggul">
                                        <x-option>Luas</x-option>
                                        <x-option>Sedang</x-option>
                                        <x-option>Sempit</x-option>
                                        <x-option>Tidak Dilakukan Pemeriksaan</x-option>
                                    </x-select>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            {{-- /II. Pemeriksaan Kebidanan --}}

            {{-- III. Riwayat Kesehatan & Reproduksi --}}
            <div class="card mb-3">
                <div class="card-header">
                    III. Riwayat Kesehatan &amp; Reproduksi
                </div>
                <div class="card-body">

                    {{-- Keluhan Utama --}}
                    <div class="mb-3">
                        <label for="keluhan_utama">Keluhan Utama</label>
                        <x-textarea id="keluhan_utama" name="keluhan_utama" rows="3"></x-textarea>
                    </div>

                    {{-- Riwayat Menstruasi --}}
                    <p class="fw-bold border-bottom pb-1 mb-2">Riwayat Menstruasi</p>
                    <div class="row g-2">

                        <div class="col-md-2">
                            <label for="umur">Menarche</label>
                            <x-input-group class="input-group-sm">
                                <x-input name="umur" />
                                <x-input-group-text>th</x-input-group-text>
                            </x-input-group>
                        </div>

                        <div class="col-md-2">
                            <label for="lama">Lama Haid</label>
                            <x-input-group class="input-group-sm">
                                <x-input name="lama" />
                                <x-input-group-text>hari</x-input-group-text>
                            </x-input-group>
                        </div>

                        <div class="col-md-2">
                            <label for="banyaknya">Banyaknya</label>
                            <x-input-group class="input-group-sm">
                                <x-input name="banyaknya" />
                                <x-input-group-text>pembalut</x-input-group-text>
                            </x-input-group>
                        </div>

                        <div class="col-md-3">
                            <label for="haid">Haid Terakhir</label>
                            <x-input name="haid" />
                        </div>

                        <div class="col-md-3">
                            <label for="siklus">Siklus</label>
                            <x-input-group class="input-group-sm">
                                <x-input name="siklus" />
                                <x-input-group-text>hari</x-input-group-text>
                            </x-input-group>
                        </div>

                    </div>

                    <div class="row mt-3">

                        <div class="col-md-4">
                            <label class="d-block mb-2">Keteraturan Siklus</label>
                            <div class="d-flex gap-3">
                                <x-input-radio id="ket_siklus_teratur" name="ket_siklus" value="Teratur" label="Teratur"
                                    checked />
                                <x-input-radio id="ket_siklus_tidak_teratur" name="ket_siklus" value="Tidak Teratur"
                                    label="Tidak Teratur" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="ket_siklus1">Keluhan Menstruasi</label>
                            <x-select name="ket_siklus1">
                                <x-option>Tidak Ada Masalah</x-option>
                                <x-option>Dismenorhea</x-option>
                                <x-option>Spotting</x-option>
                                <x-option>Menorhagia</x-option>
                                <x-option>PMS</x-option>
                            </x-select>
                        </div>

                    </div>

                    {{-- Riwayat Perkawinan --}}
                    <p class="fw-bold border-bottom pb-1 mb-2 mt-3">Riwayat Perkawinan</p>
                    <div class="row g-2">

                        <div class="col-md-4">
                            <label class="mb-2">Status Perkawinan</label>
                            <div class="d-flex gap-3">
                                <x-input-radio id="status_menikah" name="status" value="Menikah" label="Menikah"
                                    checked />
                                <x-input-radio id="status_tidak_menikah" name="status" value="Tidak / Belum Menikah"
                                    label="Tidak / Belum Menikah" />
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label for="kali">Menikah</label>
                            <x-input-group class="input-group-sm">
                                <x-input name="kali" />
                                <x-input-group-text>x</x-input-group-text>
                            </x-input-group>
                        </div>

                        <div class="col-md-2">
                            <label for="usia1">Usia Nikah I</label>
                            <x-input-group class="input-group-sm">
                                <x-input name="usia1" />
                                <x-input-group-text>th</x-input-group-text>
                            </x-input-group>
                        </div>

                        <div class="col-md-3">
                            <label for="ket1">Status</label>
                            <x-select name="ket1">
                                <x-option>-</x-option>
                                <x-option>Masih Menikah</x-option>
                                <x-option>Cerai</x-option>
                                <x-option>Meninggal</x-option>
                            </x-select>
                        </div>


                        <div class="col-md-2">
                            <label for="usia2">Usia Nikah II</label>
                            <x-input-group class="input-group-sm">
                                <x-input name="usia2" />
                                <x-input-group-text>th</x-input-group-text>
                            </x-input-group>
                        </div>

                        <div class="col-md-2">
                            <label for="ket2">Status</label>
                            <x-select name="ket2">
                                <x-option>-</x-option>
                                <x-option>Masih Menikah</x-option>
                                <x-option>Cerai</x-option>
                                <x-option>Meninggal</x-option>
                            </x-select>
                        </div>


                        <div class="col-md-2">
                            <label for="usia3">Usia Nikah III</label>
                            <x-input-group class="input-group-sm">
                                <x-input name="usia3" />
                                <x-input-group-text>th</x-input-group-text>
                            </x-input-group>
                        </div>

                        <div class="col-md-2">
                            <label for="ket3">Status</label>
                            <x-select name="ket3">
                                <x-option>-</x-option>
                                <x-option>Masih Menikah</x-option>
                                <x-option>Cerai</x-option>
                                <x-option>Meninggal</x-option>
                            </x-select>
                        </div>

                    </div>

                    {{-- Riwayat Kehamilan Sekarang --}}
                    <p class="fw-bold border-bottom pb-1 mb-2 mt-3">Riwayat Kehamilan Sekarang</p>
                    <div class="row g-2">

                        <div class="col-md-2">
                            <label for="hpht">HPHT</label>
                            <x-input name="hpht" type="date" />
                        </div>

                        <div class="col-md-3">
                            <label for="usia_kehamilan">Usia Kehamilan</label>
                            <x-input-group class="input-group-sm">
                                <x-input name="usia_kehamilan" />
                                <x-input-group-text>mg</x-input-group-text>
                            </x-input-group>
                        </div>

                        <div class="col-md-2">
                            <label for="tp">TP/EDD</label>
                            <x-input name="tp" type="date" />
                        </div>

                        <div class="col-md-1">
                            <label for="g">G</label>
                            <x-input name="g" />
                        </div>

                        <div class="col-md-1">
                            <label for="p">P</label>
                            <x-input name="p" />
                        </div>

                        <div class="col-md-1">
                            <label for="a">A</label>
                            <x-input name="a" />
                        </div>

                        <div class="col-md-2">
                            <label for="hidup">Hidup</label>
                            <x-input-group class="input-group-sm">
                                <x-input name="hidup" />
                                <x-input-group-text>anak</x-input-group-text>
                            </x-input-group>
                        </div>

                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="imunisasi">Imunisasi</label>
                                    <x-select name="imunisasi">
                                        <x-option>Tidak</x-option>
                                        <x-option>Ya</x-option>
                                    </x-select>
                                </div>
                                <div class="col-md-6 p-1">
                                    <label for="ket_imunisasi">Jumlah TT</label>
                                    <x-input-group class="input-group-sm">
                                        <x-input name="ket_imunisasi" />
                                        <x-input-group-text>x</x-input-group-text>
                                    </x-input-group>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <table class="table table-bordered table-sm tbRiwayatPersalinanPasien">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tgl Persalinan</th>
                                        <th>Tempat Persalinan</th>
                                        <th>Usia Hamil</th>
                                        <th>Jenis Persalinan</th>
                                        <th>JK</th>
                                        <th>Penolong</th>
                                        <th>Penyulit</th>
                                        <th>Keadaan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Diisi via JS --}}
                                </tbody>
                            </table>
                            <div class="d-flex gap-2">
                                <button class="btn btn-primary btn-sm" type="button"
                                    onclick="showModalRiwayatPersalinanAskep()">
                                    <i class="bi bi-pencil me-2"></i>Tambah
                                </button>
                            </div>
                        </div>

                    </div>

                    {{-- Riwayat KB --}}
                    <p class="border-bottom pb-1 fw-bold mb-2 mt-3">Riwayat KB</p>
                    <div class="row g-2">

                        <div class="col-md-4">
                            <label for="kb">Jenis KB</label>
                            <x-select name="kb">
                                <x-option>Belum Pernah</x-option>
                                <x-option>Suntik</x-option>
                                <x-option>Pil</x-option>
                                <x-option>AKDR</x-option>
                                <x-option>MOW</x-option>
                                <x-option>Implant</x-option>
                            </x-select>
                        </div>

                        <div class="col-md-2">
                            <label for="ket_kb">Lama Pemakaian</label>
                            <x-input-group class="input-group-sm">
                                <x-input name="ket_kb" />
                                <x-input-group-text>th</x-input-group-text>
                            </x-input-group>
                        </div>

                        <div class="col-md-3">
                            <label class="d-block">Komplikasi</label>
                            <div class="d-flex gap-3 mt-2">
                                <x-input-radio id="komplikasi_tidak" name="komplikasi" value="Tidak Ada"
                                    label="Tidak Ada" checked />
                                <x-input-radio id="komplikasi_ada" name="komplikasi" value="Ada" label="Ada" />
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="ket_komplikasi">Keterangan Komplikasi</label>
                            <x-input name="ket_komplikasi" />
                        </div>

                    </div>

                    <div class="row g-2 mt-2">
                        <div class="col-md-3">
                            <label for="berhenti">Berhenti KB Sejak</label>
                            <x-input name="berhenti" />
                        </div>
                        <div class="col-md-5">
                            <label for="alasan">Alasan Berhenti</label>
                            <x-input name="alasan" />
                        </div>
                        <div class="col-md-5">
                            <label for="alasan">Riwayat Ginekologi</label>
                            <x-select name="ginekologi">
                                <x-option>Tidak Ada</x-option>
                                <x-option>Infertilitas</x-option>
                                <x-option>Infeksi Virus</x-option>
                                <x-option>PMS</x-option>
                                <x-option>Cervisitis Kronis</x-option>
                                <x-option>Endometriosis</x-option>
                                <x-option>Mioma</x-option>
                                <x-option>Polip Cervix</x-option>
                            </x-select>
                        </div>
                    </div>

                    {{-- Riwayat Kebiasaan --}}
                    <p class="border-bottom pb-1 fw-bold mb-2 mt-3">Riwayat Kebiasaan</p>
                    <div class="row g-2">

                        <div class="col-md-4">
                            <label for="kebiasaan">Konsumsi</label>
                            <x-select name="kebiasaan">
                                <x-option>-</x-option>
                                <x-option>Obat Obatan</x-option>
                                <x-option>Vitamin</x-option>
                                <x-option>Jamu Jamuan</x-option>
                            </x-select>
                        </div>

                        <div class="col-md-8">
                            <label for="ket_kebiasaan">Keterangan</label>
                            <x-input name="ket_kebiasaan" />
                        </div>

                    </div>

                    <div class="row g-2 mt-2">

                        <div class="col-md-4">
                            <label class="d-block">Merokok</label>
                            <div class="d-flex gap-3 mt-2">
                                <x-input-radio id="kebiasaan1_tidak" name="kebiasaan1" value="Tidak" label="Tidak"
                                    checked />
                                <x-input-radio id="kebiasaan1_ya" name="kebiasaan1" value="Ya" label="Ya" />
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label for="ket_kebiasaan1">Batang/Hari</label>
                            <x-input-group class="input-group-sm">
                                <x-input name="ket_kebiasaan1" />
                                <x-input-group-text>btg</x-input-group-text>
                            </x-input-group>
                        </div>

                        <div class="col-md-3">
                            <label class="d-block">Alkohol</label>
                            <div class="d-flex gap-3 mt-2">
                                <x-input-radio id="kebiasaan2_tidak" name="kebiasaan2" value="Tidak" label="Tidak"
                                    checked />
                                <x-input-radio id="kebiasaan2_ya" name="kebiasaan2" value="Ya" label="Ya" />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="ket_kebiasaan2">Ket.</label>
                            <x-input-group class="input-group-sm">
                                <x-input name="ket_kebiasaan2" />
                                <x-input-group-text>gls/Hari</x-input-group-text>
                            </x-input-group>
                        </div>

                        <div class="col-md-3">
                            <label class="d-block">Narkoba/Obat Tidur</label>
                            <div class="d-flex gap-3 mt-2">
                                <x-input-radio id="kebiasaan3_tidak" name="kebiasaan3" value="Tidak" label="Tidak"
                                    checked />
                                <x-input-radio id="kebiasaan3_ya" name="kebiasaan3" value="Ya" label="Ya" />
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            {{-- /III. Riwayat Kesehatan & Reproduksi --}}

        </div>
        {{-- /KOLOM KIRI --}}

        {{-- ======================== KOLOM KANAN ======================== --}}
        <div class="col-md-6">

            {{-- Status Fungsional --}}
            @include('content.poliklinik.modal.form.partial.askep._status_fungsional')
            {{-- /Status Fungsional --}}

            {{-- IV. Psikososial --}}
            @include('content.poliklinik.modal.form.partial.askep._status_psikososial')
            {{-- /IV. Psikososial --}}

            {{-- IV. Risiko Jatuh --}}
            @include('content.poliklinik.modal.form.partial.askep._risiko_jatuh')
            {{-- /IV. Risiko Jatuh --}}

            {{-- V. Skrining Gizi --}}
            @include('content.poliklinik.modal.form.partial.askep._skrining_gizi')
            {{-- /V. Skrining Gizi --}}

            {{-- VI. Skrining Nyeri --}}
            @include('content.poliklinik.modal.form.partial.askep._skrining_nyeri')
            {{-- /VI. Skrining Nyeri --}}

            {{-- VII. Masalah dan Tindakan Kebidanan --}}
            <div class="card mb-3">
                <div class="card-header">
                    VII. Masalah dan Tindakan Kebidanan
                </div>
                <div class="card-body">

                    <div class="mb-3">
                        <label for="masalah">Masalah Kebidanan</label>
                        <x-textarea id="masalah" name="masalah" rows="4"
                            placeholder="Masalah yang ditemukan pada pasien"></x-textarea>
                    </div>

                    <div>
                        <label for="tindakan">Tindakan / Rencana Tindakan</label>
                        <x-textarea id="tindakan" name="tindakan" rows="4"
                            placeholder="Tindakan yang telah atau akan dilakukan"></x-textarea>
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
{{-- /formAskepAwalObgyn --}}




@push('script')
    <script>
        const formAskepAwalObgyn = $('#formAskepAwalObgyn');
        const formInfoAskepAwalObgyn = $('#formInfoAskepAwalObgyn');
        const rangeSkalaNyeri = formAskepAwalObgyn.find('input[name=skala_nyeri]');

        rangeSkalaNyeri.on('change', function (e) {
            formAskepAwalObgyn.find('span[id=nilai_skala_nyeri]')
                .text(e.currentTarget.value);
        });

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
                formInfoAskepAwalObgyn.find('input[name=no_rawat]').val(no_rawat)
                formInfoAskepAwalObgyn.find('input[name=no_rkm_medis]').val(pasien?.no_rkm_medis)
                formInfoAskepAwalObgyn.find('input[name=pasien]').val(`${pasien?.nm_pasien} (${pasien?.jk})`)
                formInfoAskepAwalObgyn.find('input[name=tgl_lahir]').val(`${formatTanggal(pasien?.tgl_lahir)}`)
                formInfoAskepAwalObgyn.find('input[name=umurdaftar]').val(`${textUmurDaftar}`)
                formInfoAskepAwalObgyn.find('input[name=penjab]').val(penjab?.png_jawab)
                formInfoAskepAwalObgyn.find('input[name=dokter]').val(dokter?.nm_dokter)
                $.get("{{ route('asesmen-keperawatan.kandungan.get') }}", {
                    no_rawat: no_rawat,
                }).done((response) => {
                    let optPetugas = ''
                    if (response.data) {
                        const { petugas, pasien } = response.data
                        setDataForm(formAskepAwalObgyn, response.data);
                        optPetugas = new Option(petugas?.nama, petugas?.nik, true, true);
                        formAskepAwalObgyn.find('select[name=nip]').append(optPetugas).trigger('change');
                        formAskepAwalObgyn.find('input[name=tanggal]').val(response.data.tanggal);
                        return '';
                    }

                    const jam = moment().format('HH:mm:ss')
                    optPetugas = new Option("{{ session()->get('pegawai')->nama }}", "{{ session()->get('pegawai')->nik }}", true,
                        true);
                    formAskepAwalObgyn.find('select[name=nip]').append(optPetugas).trigger('change');
                    formAskepAwalObgyn.find('input[name=tanggal]').val(new Date().toISOString().slice(0, -1));
                    // formAskepAwalObgyn.find("input[name=ket_lapor]").val(jam);
                    // formAskepAwalObgyn.find("input[name=ket_dokter]").val(jam);
                })
                renderTableRiwayatPersalinan(pasien.no_rkm_medis)
            })
        }

        function createAskepAwalObgyn() {
            const data = getDataForm('#formAskepAwalObgyn', ['input', 'select', 'textarea']);
            data['no_rawat'] = formInfoAskepAwalObgyn.find('input[name=no_rawat]').val();

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
                        alertErrorAjax(request);
                    }
                });

        }
        const selectPetugasAskepObgyn = formAskepAwalObgyn.find('select[name=nip]')
        selectPetugasAskepObgyn.select2({
            ajax: {
                url: '/erm/petugas/cari',
                dataType: 'json',
                dropdownParent: formAskepAwalObgyn,
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

        formAskepAwalObgyn.on('change', 'select[name=sg1]', function () {

            const nilai = $(this)
                .find('option:selected')
                .data('nilai');

            formAskepAwalObgyn
                .find('select[name=nilai1]')
                .val(nilai)
                .trigger('change');

            hitungSkorGizi();
        });

        formAskepAwalObgyn.on('change', 'input[name=sg2]', function () {

            const nilai = $(this).data('nilai');

            formAskepAwalObgyn
                .find('select[name=nilai2]')
                .val(nilai)
                .trigger('change');

            hitungSkorGizi();
        });
        function hitungSkorGizi() {

            const nilai1 = parseInt(
                formAskepAwalObgyn.find('select[name=nilai1]').val() || 0
            );

            const nilai2 = parseInt(
                formAskepAwalObgyn.find('select[name=nilai2]').val() || 0
            );

            const total = nilai1 + nilai2;

            formAskepAwalObgyn
                .find('input[name=total_hasil]')
                .val(total);
        }
       
        formAskepAwalObgyn.on(
            'change',
            'input[name="berjalan_a"], input[name="berjalan_b"], input[name="berjalan_c"]',
            hitungResikoJatuh
        );
        formAskepAwalObgyn.find('input[name=lapor]').on('change', function (e) {

            if (e.currentTarget.value == 'Ya') {
                const jam = moment().format('HH:mm:ss')
                formAskepAwalObgyn.find('input[name=ket_lapor]')
                    .prop('disabled', false)
                    .trigger('change').val(jam);
            } else {
                formAskepAwalObgyn.find('input[name=ket_lapor]')
                    .prop('disabled', true)
                    .val('00:00:00');
            }
        })
        formAskepAwalObgyn.find('input[name=pada_dokter]').on('change', function (e) {

            if (e.currentTarget.value == 'Ya') {
                const jam = moment().format('HH:mm:ss')
                formAskepAwalObgyn.find('input[name=ket_dokter]')
                    .prop('disabled', false)
                    .trigger('change').val(jam);
            } else {
                formAskepAwalObgyn.find('input[name=ket_dokter]')
                    .prop('disabled', true)
                    .val('00:00:00');
            }
        })

        function printAskepAwalObgyn() {
            // Ambil nilai no_rawat dari input atau atribut elemen
            const noRawat = formInfoAskepAwalObgyn.find('input[name="no_rawat"]').val();

            // Pastikan noRawat ada sebelum mencetak
            if (noRawat) {
                const url = `/erm/asesmen-keperawatan/kandungan/print?no_rawat=${encodeURIComponent(noRawat)}`;
                window.open(url, '_blank');
            } else {
                alert('Nomor rawat tidak ditemukan!');
            }
        }
        function showModalRiwayatPersalinanAskep() {
            const no_rkm_medis = formInfoAskepAwalObgyn.find('input[name="no_rkm_medis"]').val()
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

{{-- @endsection --}}