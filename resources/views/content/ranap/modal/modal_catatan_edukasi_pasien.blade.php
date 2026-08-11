<div class="modal fade" id="modalCatatanEdukasiPasien" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true" style="background-color: rgb(0 0 0 / 49%)">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white py-2">
                <h5 class="modal-title fs-6 fw-bold" id="exampleModalLabel"><i class="bi bi-journal-bookmark me-1"></i> Edukasi Pasien &amp; Keluarga Rawat Inap (RM 20, RM 23 &amp; RM 24)</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">
                <!-- IDENTITAS PASIEN -->
                <form action="" id="formPasienCatatanEdukasi">
                    <div class="row gy-2 bg-light p-2 rounded border mb-2">
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <x-input-group class="input-group-sm">
                                <x-input-group-text for="no_rawat" label="No. Rawat"></x-input-group-text>
                                <x-input id="no_rawat" name="no_rawat" readonly />
                            </x-input-group>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <x-input-group class="input-group-sm">
                                <x-input-group-text for="nm_pasien" label="Pasien"></x-input-group-text>
                                <x-input id="nm_pasien" name="nm_pasien" readonly />
                            </x-input-group>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <x-input-group class="input-group-sm">
                                <x-input-group-text for="tgl_lahir" label="Tgl. Lahir"></x-input-group-text>
                                <x-input id="tgl_lahir" name="tgl_lahir" readonly />
                            </x-input-group>
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-12">
                            <x-input-group class="input-group-sm">
                                <x-input-group-text for="p_jawab" label="Keluarga"></x-input-group-text>
                                <x-input id="p_jawab" name="p_jawab" readonly />
                            </x-input-group>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <x-input-group class="input-group-sm">
                                <x-input-group-text for="kamar" label="Kamar"></x-input-group-text>
                                <x-input id="kamar" name="kamar" readonly />
                            </x-input-group>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <x-input-group class="input-group-sm">
                                <x-input-group-text for="diagnosa_awal" label="Diagnosa"></x-input-group-text>
                                <x-input id="diagnosa_awal" name="diagnosa_awal" readonly />
                            </x-input-group>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <x-input-group class="input-group-sm">
                                <x-input-group-text for="dokter" label="Dokter"></x-input-group-text>
                                <x-input id="dokter" name="dokter" readonly />
                            </x-input-group>
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-12">
                            <x-input-group class="input-group-sm">
                                <x-input-group-text for="lama" label="Lama"></x-input-group-text>
                                <x-input id="lama" name="lama" readonly />
                            </x-input-group>
                        </div>
                    </div>
                </form>

                <!-- NAV TABS RM 20, RM 23 & RM 24 -->
                <ul class="nav nav-pills mb-2" id="tabEdukasi" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active fw-bold py-1 px-3" id="tab-rm20-tab" data-bs-toggle="pill" data-bs-target="#tab-rm20" type="button" role="tab" onclick="switchFormJenis('RM 20')">
                            <i class="bi bi-clipboard2-pulse me-1"></i> Form RM 20 (Assesmen &amp; Rencana Edukasi)
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link fw-bold py-1 px-3" id="tab-rm23-tab" data-bs-toggle="pill" data-bs-target="#tab-rm23" type="button" role="tab" onclick="switchFormJenis('RM 23')">
                            <i class="bi bi-people-fill me-1"></i> Form RM 23 (Edukasi Multidisiplin PPA)
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link fw-bold py-1 px-3" id="tab-rm24-tab" data-bs-toggle="pill" data-bs-target="#tab-rm24" type="button" role="tab" onclick="switchFormJenis('RM 24')">
                            <i class="bi bi-card-text me-1"></i> Form RM 24 (Edukasi Pasien Terbuka)
                        </button>
                    </li>
                </ul>

                <!-- FORM ASESMEN KEBUTUHAN EDUKASI RM 20 -->
                <form id="formAsesmenEdukasiRm20" class="border p-3 rounded bg-white shadow-sm mb-3">
                    @csrf
                    <input type="hidden" name="no_rawat" id="rm20_no_rawat" />
                    
                    <!-- BARIS KONTROL ATAS: TANGGAL, RUANG, PETUGAS & TOMBOL CEPAT -->
                    <div class="row gy-2 mb-2 p-2 bg-light rounded border">
                        <div class="col-lg-3 col-md-6">
                            <x-input-group class="input-group-sm">
                                <x-input-group-text for="rm20_tanggal" label="Tgl / Jam Asesmen" />
                                <x-input id="rm20_tanggal" name="tanggal" class="datetimepicker" />
                            </x-input-group>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <x-input-group class="input-group-sm">
                                <x-input-group-text for="rm20_ruang" label="Ruang / Kamar" />
                                <x-input id="rm20_ruang" name="ruang" />
                            </x-input-group>
                        </div>
                        <div class="col-lg-4 col-md-8">
                            <x-input-group class="input-group-sm">
                                <x-input-group-text for="rm20_nip" label="Perawat / Pengkaji" />
                                <x-input id="rm20_nip" name="nip" readonly />
                                <x-input id="rm20_nama" name="nama" class="w-50" readonly />
                            </x-input-group>
                        </div>
                        <div class="col-lg-2 col-md-4 text-end">
                            <button type="button" class="btn btn-outline-success btn-sm w-100 fw-bold" onclick="setDefaultRm20()">
                                <i class="bi bi-magic me-1"></i> Set Standar Normal
                            </button>
                        </div>
                    </div>

                    <!-- BAGIAN A: PENGKAJIAN KEBUTUHAN PENDIDIKAN -->
                    <div class="p-2 border rounded bg-light mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2 pb-1 border-bottom">
                            <span class="fw-bold text-primary fs-6"><i class="bi bi-card-checklist me-1"></i> A. PENGKAJIAN KEBUTUHAN PENDIDIKAN</span>
                        </div>

                        <div class="row gy-2">
                            <!-- 1. Agama -->
                            <div class="col-lg-4 col-md-6">
                                <label class="form-label small fw-bold mb-1">1. Agama &amp; Keyakinan :</label>
                                <input type="text" class="form-control form-control-sm" name="agama_keyakinan" id="rm20_agama" placeholder="Agama pasien..." />
                            </div>

                            <!-- 2. Bahasa Sehari-hari -->
                            <div class="col-lg-8 col-md-6">
                                <label class="form-label small fw-bold mb-1">2. Bahasa Sehari-hari :</label>
                                <div class="row g-1">
                                    <div class="col-md-3 col-sm-6">
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text py-0" style="font-size: 11px;">Indo</span>
                                            <select class="form-select form-select-sm py-0" name="bahasa_indonesia" id="rm20_bahasa_indonesia">
                                                <option value="Aktif" selected>Aktif</option>
                                                <option value="Pasif">Pasif</option>
                                                <option value="-">-</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6">
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control form-control-sm py-0" name="bahasa_daerah" id="rm20_bahasa_daerah" value="Jawa" placeholder="Daerah..." />
                                            <select class="form-select form-select-sm py-0" name="bahasa_daerah_status" id="rm20_bahasa_daerah_status">
                                                <option value="Aktif" selected>Aktif</option>
                                                <option value="Pasif">Pasif</option>
                                                <option value="-">-</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6">
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text py-0" style="font-size: 11px;">Inggris</span>
                                            <select class="form-select form-select-sm py-0" name="bahasa_inggris" id="rm20_bahasa_inggris">
                                                <option value="-" selected>-</option>
                                                <option value="Aktif">Aktif</option>
                                                <option value="Pasif">Pasif</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6">
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control form-control-sm py-0" name="bahasa_lain" id="rm20_bahasa_lain" placeholder="Lain..." />
                                            <select class="form-select form-select-sm py-0" name="bahasa_lain_status" id="rm20_bahasa_lain_status">
                                                <option value="-" selected>-</option>
                                                <option value="Aktif">Aktif</option>
                                                <option value="Pasif">Pasif</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- 3. Penerjemah & 4. Bahasa Isyarat -->
                            <div class="col-lg-6 col-md-6">
                                <div class="row g-2">
                                    <div class="col-6">
                                        <label class="form-label small fw-bold mb-1">3. Perlu Penerjemah :</label>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="form-check form-check-inline m-0">
                                                <input class="form-check-input" type="radio" name="perlu_penerjemah" id="rm20_penerjemah_tidak" value="Tidak" checked>
                                                <label class="form-check-label small" for="rm20_penerjemah_tidak">Tidak</label>
                                            </div>
                                            <div class="form-check form-check-inline m-0">
                                                <input class="form-check-input" type="radio" name="perlu_penerjemah" id="rm20_penerjemah_ya" value="Ya">
                                                <label class="form-check-label small" for="rm20_penerjemah_ya">Ya</label>
                                            </div>
                                            <input type="text" class="form-control form-control-sm py-0" name="penerjemah_bahasa" id="rm20_penerjemah_bahasa" placeholder="Bahasa..." disabled style="height: 28px;" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label small fw-bold mb-1">4. Bahasa Isyarat :</label>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="form-check form-check-inline m-0">
                                                <input class="form-check-input" type="radio" name="bahasa_isyarat" id="rm20_isyarat_tidak" value="Tidak" checked>
                                                <label class="form-check-label small" for="rm20_isyarat_tidak">Tidak</label>
                                            </div>
                                            <div class="form-check form-check-inline m-0">
                                                <input class="form-check-input" type="radio" name="bahasa_isyarat" id="rm20_isyarat_ya" value="Ya">
                                                <label class="form-check-label small" for="rm20_isyarat_ya">Ya</label>
                                            </div>
                                            <input type="text" class="form-control form-control-sm py-0" name="bahasa_isyarat_ket" id="rm20_isyarat_ket" placeholder="Keterangan..." disabled style="height: 28px;" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- 5. Cara Belajar yang Disukai -->
                            <div class="col-lg-6 col-md-6">
                                <label class="form-label small fw-bold mb-1">5. Cara Belajar yang Disukai :</label>
                                <div class="d-flex flex-wrap gap-2">
                                    <div class="form-check form-check-sm">
                                        <input class="form-check-input rm20-cara" type="checkbox" name="cara_belajar[]" id="rm20_cara_baca" value="Membaca">
                                        <label class="form-check-label small" for="rm20_cara_baca">Membaca</label>
                                    </div>
                                    <div class="form-check form-check-sm">
                                        <input class="form-check-input rm20-cara" type="checkbox" name="cara_belajar[]" id="rm20_cara_diskusi" value="Diskusi" checked>
                                        <label class="form-check-label small" for="rm20_cara_diskusi">Diskusi</label>
                                    </div>
                                    <div class="form-check form-check-sm">
                                        <input class="form-check-input rm20-cara" type="checkbox" name="cara_belajar[]" id="rm20_cara_audio" value="Audio visual / gambar" checked>
                                        <label class="form-check-label small" for="rm20_cara_audio">Audio visual / gambar</label>
                                    </div>
                                    <div class="form-check form-check-sm">
                                        <input class="form-check-input rm20-cara" type="checkbox" name="cara_belajar[]" id="rm20_cara_tulis" value="Menulis">
                                        <label class="form-check-label small" for="rm20_cara_tulis">Menulis</label>
                                    </div>
                                    <div class="form-check form-check-sm">
                                        <input class="form-check-input rm20-cara" type="checkbox" name="cara_belajar[]" id="rm20_cara_demo" value="Demonstrasi">
                                        <label class="form-check-label small" for="rm20_cara_demo">Demonstrasi</label>
                                    </div>
                                </div>
                            </div>

                            <!-- 6. Tingkat Pendidikan & 7-10. Parameter Psikologis -->
                            <div class="col-lg-6 col-md-12">
                                <label class="form-label small fw-bold mb-1">6. Tingkat Pendidikan Pasien :</label>
                                <div class="d-flex flex-wrap gap-2 mb-2">
                                    <div class="form-check"><input class="form-check-input" type="radio" name="tingkat_pendidikan" id="rm20_pnd_tk" value="TK"><label class="form-check-label small" for="rm20_pnd_tk">TK</label></div>
                                    <div class="form-check"><input class="form-check-input" type="radio" name="tingkat_pendidikan" id="rm20_pnd_sd" value="SD"><label class="form-check-label small" for="rm20_pnd_sd">SD</label></div>
                                    <div class="form-check"><input class="form-check-input" type="radio" name="tingkat_pendidikan" id="rm20_pnd_smp" value="SMP"><label class="form-check-label small" for="rm20_pnd_smp">SMP</label></div>
                                    <div class="form-check"><input class="form-check-input" type="radio" name="tingkat_pendidikan" id="rm20_pnd_sma" value="SMA" checked><label class="form-check-label small" for="rm20_pnd_sma">SMA</label></div>
                                    <div class="form-check"><input class="form-check-input" type="radio" name="tingkat_pendidikan" id="rm20_pnd_akademi" value="Akademi"><label class="form-check-label small" for="rm20_pnd_akademi">Akademi</label></div>
                                    <div class="form-check"><input class="form-check-input" type="radio" name="tingkat_pendidikan" id="rm20_pnd_sarjana" value="Sarjana"><label class="form-check-label small" for="rm20_pnd_sarjana">Sarjana</label></div>
                                    <div class="form-check"><input class="form-check-input" type="radio" name="tingkat_pendidikan" id="rm20_pnd_lainnya" value="Lainnya"><label class="form-check-label small" for="rm20_pnd_lainnya">Lainnya</label></div>
                                </div>

                                <div class="row g-2">
                                    <div class="col-6">
                                        <label class="form-label small fw-bold mb-1">7. Mampu Membaca :</label>
                                        <select class="form-select form-select-sm" name="mampu_membaca" id="rm20_mampu_membaca">
                                            <option value="Ya" selected>Ya</option>
                                            <option value="Tidak">Tidak</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label small fw-bold mb-1">8. Hambatan Emosi :</label>
                                        <select class="form-select form-select-sm" name="hambatan_emosi" id="rm20_hambatan_emosi">
                                            <option value="Tidak" selected>Tidak</option>
                                            <option value="Ya">Ya</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label small fw-bold mb-1">9. Kesediaan Terima Info :</label>
                                        <select class="form-select form-select-sm" name="kesediaan_menerima" id="rm20_kesediaan_menerima">
                                            <option value="Ya" selected>Ya</option>
                                            <option value="Tidak">Tidak</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label small fw-bold mb-1">10. Keterbatasan Fisik/Kognitif :</label>
                                        <select class="form-select form-select-sm" name="keterbatasan_fisik" id="rm20_keterbatasan_fisik">
                                            <option value="Tidak" selected>Tidak</option>
                                            <option value="Ya">Ya</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- 11. Kebutuhan Pendidikan (11 Poin) -->
                            <div class="col-lg-6 col-md-12">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <label class="form-label small fw-bold mb-0">11. Kebutuhan Pendidikan yang Diperlukan :</label>
                                    <button type="button" class="btn btn-link btn-sm py-0 text-decoration-none fw-bold" onclick="toggleAllKebutuhan(true)">Pilih Semua</button>
                                </div>
                                <div class="p-2 border rounded bg-white" style="max-height: 180px; overflow-y: auto;">
                                    <div class="row g-1">
                                        <div class="col-12"><div class="form-check form-check-sm"><input class="form-check-input rm20-kebutuhan" type="checkbox" name="kebutuhan_edukasi[]" id="rm20_keb_1" value="Hak dan kewajiban pasien" checked><label class="form-check-label small" for="rm20_keb_1">Hak dan kewajiban pasien</label></div></div>
                                        <div class="col-12"><div class="form-check form-check-sm"><input class="form-check-input rm20-kebutuhan" type="checkbox" name="kebutuhan_edukasi[]" id="rm20_keb_2" value="Orientasi ruangan" checked><label class="form-check-label small" for="rm20_keb_2">Orientasi ruangan</label></div></div>
                                        <div class="col-12"><div class="form-check form-check-sm"><input class="form-check-input rm20-kebutuhan" type="checkbox" name="kebutuhan_edukasi[]" id="rm20_keb_3" value="Kondisi medis, diagnosis pasti, asuhan & pengobatan" checked><label class="form-check-label small" for="rm20_keb_3">Kondisi medis, diagnosis pasti, asuhan & pengobatan</label></div></div>
                                        <div class="col-12"><div class="form-check form-check-sm"><input class="form-check-input rm20-kebutuhan" type="checkbox" name="kebutuhan_edukasi[]" id="rm20_keb_4" value="Penggunaan obat yang efektif dan aman (potensi efek samping dan interaksi)" checked><label class="form-check-label small" for="rm20_keb_4">Penggunaan obat yang efektif &amp; aman</label></div></div>
                                        <div class="col-12"><div class="form-check form-check-sm"><input class="form-check-input rm20-kebutuhan" type="checkbox" name="kebutuhan_edukasi[]" id="rm20_keb_5" value="Penggunaan peralatan medis yang efektif dan aman" checked><label class="form-check-label small" for="rm20_keb_5">Penggunaan peralatan medis yang efektif dan aman</label></div></div>
                                        <div class="col-12"><div class="form-check form-check-sm"><input class="form-check-input rm20-kebutuhan" type="checkbox" name="kebutuhan_edukasi[]" id="rm20_keb_6" value="Diet dan nutrisi" checked><label class="form-check-label small" for="rm20_keb_6">Diet dan nutrisi</label></div></div>
                                        <div class="col-12"><div class="form-check form-check-sm"><input class="form-check-input rm20-kebutuhan" type="checkbox" name="kebutuhan_edukasi[]" id="rm20_keb_7" value="Rehabilitasi medik" checked><label class="form-check-label small" for="rm20_keb_7">Rehabilitasi medik</label></div></div>
                                        <div class="col-12"><div class="form-check form-check-sm"><input class="form-check-input rm20-kebutuhan" type="checkbox" name="kebutuhan_edukasi[]" id="rm20_keb_8" value="Manajemen nyeri" checked><label class="form-check-label small" for="rm20_keb_8">Manajemen nyeri</label></div></div>
                                        <div class="col-12"><div class="form-check form-check-sm"><input class="form-check-input rm20-kebutuhan" type="checkbox" name="kebutuhan_edukasi[]" id="rm20_keb_9" value="Pencegahan dan pengendalian infeksi" checked><label class="form-check-label small" for="rm20_keb_9">Pencegahan dan pengendalian infeksi</label></div></div>
                                        <div class="col-12"><div class="form-check form-check-sm"><input class="form-check-input rm20-kebutuhan" type="checkbox" name="kebutuhan_edukasi[]" id="rm20_keb_10" value="Pemenuhan kebutuhan kesehatan berkelanjutan" checked><label class="form-check-label small" for="rm20_keb_10">Pemenuhan kebutuhan kesehatan berkelanjutan</label></div></div>
                                        <div class="col-12">
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="form-check form-check-sm mb-0"><input class="form-check-input rm20-kebutuhan" type="checkbox" name="kebutuhan_edukasi[]" id="rm20_keb_11" value="Lain-lain"><label class="form-check-label small" for="rm20_keb_11">Lain-lain</label></div>
                                                <input type="text" class="form-control form-control-sm py-0" name="kebutuhan_edukasi_lain" id="rm20_kebutuhan_edukasi_lain" placeholder="Sebutkan..." disabled style="height: 26px;" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- BAGIAN B: PERENCANAAN PEMBERIAN EDUKASI -->
                    <div class="p-2 border rounded bg-light mb-2">
                        <div class="d-flex justify-content-between align-items-center mb-2 pb-1 border-bottom">
                            <span class="fw-bold text-success fs-6"><i class="bi bi-calendar-check me-1"></i> B. PERENCANAAN PEMBERIAN EDUKASI</span>
                            <div>
                                <span class="small fw-bold me-2">Rencana Pelaksanaan :</span>
                                <div class="form-check form-check-inline mb-0">
                                    <input class="form-check-input" type="radio" name="rencana_pelaksanaan" id="rm20_rencana_individu" value="Individu" checked>
                                    <label class="form-check-label small" for="rm20_rencana_individu">Individu</label>
                                </div>
                                <div class="form-check form-check-inline mb-0">
                                    <input class="form-check-input" type="radio" name="rencana_pelaksanaan" id="rm20_rencana_kolaboratif" value="Kolaboratif">
                                    <label class="form-check-label small" for="rm20_rencana_kolaboratif">Kolaboratif</label>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive" style="max-height: 260px; overflow-y: auto;">
                            <table class="table table-bordered table-sm table-hover bg-white mb-0" id="tableRencanaRm20" style="font-size: 11px;">
                                <thead class="table-secondary text-center sticky-top">
                                    <tr>
                                        <th width="32%">Kebutuhan Edukasi</th>
                                        <th width="18%">Pemberian Edukasi (PPA)</th>
                                        <th width="15%">Sasaran</th>
                                        <th width="18%">Cara Edukasi</th>
                                        <th width="17%">Metode Evaluasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Injected dynamically based on checklist kebutuhan -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>

                <!-- FORM CATATAN EDUKASI (RM 23 & RM 24) -->
                <form id="formCatatanEdukasiPasien" class="border p-3 rounded bg-white shadow-sm mb-3" style="display: none;">
                    <input type="hidden" name="jenis_form" id="jenis_form" value="RM 23" />
                    <input type="hidden" name="ttd_pasien" id="edukasi_ttd_pasien" value="" />

                    <!-- BARIS 1: TANGGAL, DURASI, PETUGAS -->
                    <div class="row gy-2 mb-2">
                        <div class="col-lg-3 col-md-6">
                            <x-input-group class="input-group-sm">
                                <x-input-group-text for="tanggal" label="Tanggal / Jam"></x-input-group-text>
                                <x-input id="tanggal" name="tanggal" class="datetimepicker" />
                            </x-input-group>
                        </div>
                        <div class="col-lg-2 col-md-6">
                            <x-input-group class="input-group-sm">
                                <x-input-group-text for="durasi" label="Durasi"></x-input-group-text>
                                <input type="text" class="form-control" name="durasi" id="durasi" placeholder="misal: 10 Menit" value="10 Menit" />
                            </x-input-group>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <x-input-group class="input-group-sm">
                                <x-input-group-text for="nip" label="Edukator (PPA)" />
                                <x-input id="nip" name="nip" readonly />
                                <x-input id="nama" name="nama" class="w-50" readonly />
                            </x-input-group>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <x-input-group class="input-group-sm">
                                <x-input-group-text for="nama_penerima" label="Penerima" />
                                <input type="text" class="form-control" name="nama_penerima" id="nama_penerima" placeholder="Nama Pasien / Keluarga" />
                            </x-input-group>
                        </div>
                    </div>

                    <!-- AREA KONTEN MATERI (DINAMIS UNTUK RM 23 vs RM 24) -->
                    <div id="sectionRm23" class="mb-3 p-2 bg-light rounded border">
                        <label class="form-label fw-bold text-primary mb-1"><i class="bi bi-diagram-3 me-1"></i> Pilih Disiplin Profesi (PPA) :</label>
                        <div class="d-flex flex-wrap gap-2 mb-2">
                            <input type="radio" class="btn-check" name="disiplin" id="disiplin_dpjp" value="DPJP" autocomplete="off" checked onchange="renderChecklistMateri()">
                            <label class="btn btn-outline-primary btn-sm" for="disiplin_dpjp"><i class="bi bi-person-badge"></i> DPJP (Dokter)</label>

                            <input type="radio" class="btn-check" name="disiplin" id="disiplin_farmasi" value="Farmasi" autocomplete="off" onchange="renderChecklistMateri()">
                            <label class="btn btn-outline-primary btn-sm" for="disiplin_farmasi"><i class="bi bi-capsule"></i> Farmasi</label>

                            <input type="radio" class="btn-check" name="disiplin" id="disiplin_perawat" value="Perawat/Bidan" autocomplete="off" onchange="renderChecklistMateri()">
                            <label class="btn btn-outline-primary btn-sm" for="disiplin_perawat"><i class="bi bi-heart-pulse"></i> Perawat / Bidan</label>

                            <input type="radio" class="btn-check" name="disiplin" id="disiplin_nutrisionis" value="Nutrisionis" autocomplete="off" onchange="renderChecklistMateri()">
                            <label class="btn btn-outline-primary btn-sm" for="disiplin_nutrisionis"><i class="bi bi-egg-fried"></i> Nutrisionis (Gizi)</label>

                            <input type="radio" class="btn-check" name="disiplin" id="disiplin_nyeri" value="Manajemen Nyeri" autocomplete="off" onchange="renderChecklistMateri()">
                            <label class="btn btn-outline-primary btn-sm" for="disiplin_nyeri"><i class="bi bi-shield-plus"></i> Manajemen Nyeri</label>
                        </div>

                        <!-- CHECKLIST MATERI PER DISIPLIN -->
                        <div class="p-2 border rounded bg-white mb-2" id="containerChecklistMateri">
                            <!-- Injected by JS -->
                        </div>
                    </div>

                    <!-- TEXTAREA MATERI / KETIKAN BEBAS (UNTUK RM 24 & CATATAN TAMBAHAN RM 23) -->
                    <div class="mb-2">
                        <label for="materi" class="form-label fw-bold text-secondary mb-1">
                            <span id="labelMateri">Materi Edukasi Tambahan / Keterangan Khusus :</span>
                        </label>
                        <textarea class="form-control" name="materi" id="materi" rows="2" placeholder="Ketik rincian atau materi edukasi yang disampaikan..."></textarea>
                    </div>

                    <!-- METODE -->
                    <div class="mb-2 p-2 bg-light rounded border">
                        <label class="form-label fw-bold d-block mb-1 text-primary"><i class="bi bi-chat-dots me-1"></i> Metode Pembelajaran (Dapat Dipilih Lebih Dari 1) :</label>
                        <div class="d-flex flex-wrap gap-3">
                            <div class="form-check">
                                <input class="form-check-input check-metode" type="checkbox" name="metode[]" id="metode_diskusi" value="Diskusi / Wawancara" checked>
                                <label class="form-check-label fw-semibold" for="metode_diskusi">a. Diskusi / Wawancara</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input check-metode" type="checkbox" name="metode[]" id="metode_simulasi" value="Simulasi (S)">
                                <label class="form-check-label" for="metode_simulasi">b. Simulasi (S)</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input check-metode" type="checkbox" name="metode[]" id="metode_demo" value="Demonstrasi (Demo)">
                                <label class="form-check-label" for="metode_demo">c. Demonstrasi (Demo)</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input check-metode" type="checkbox" name="metode[]" id="metode_ceramah" value="Ceramah">
                                <label class="form-check-label" for="metode_ceramah">d. Ceramah</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input check-metode" type="checkbox" name="metode[]" id="metode_observasi" value="Observasi (O)">
                                <label class="form-check-label" for="metode_observasi">e. Observasi (O)</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input check-metode" type="checkbox" name="metode[]" id="metode_pl" value="Praktek Langsung (PL)">
                                <label class="form-check-label" for="metode_pl">f. Praktek Langsung (PL)</label>
                            </div>
                        </div>
                    </div>

                    <!-- HAMBATAN & INTERVENSI -->
                    <div class="row gy-2 mb-2">
                        <div class="col-lg-6 col-md-12">
                            <div class="p-2 border rounded bg-light h-100">
                                <label class="form-label fw-bold mb-1 text-danger"><i class="bi bi-exclamation-triangle me-1"></i> Hambatan (Dapat Dipilih Lebih Dari 1) :</label>
                                <div class="row g-1">
                                    <div class="col-6 col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input check-hambatan" type="checkbox" name="hambatan[]" id="hambatan_tidak_ada" value="Tidak Ada" checked>
                                            <label class="form-check-label small fw-bold" for="hambatan_tidak_ada">Tidak Ada</label>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input check-hambatan" type="checkbox" name="hambatan[]" id="hambatan_bahasa" value="Bahasa">
                                            <label class="form-check-label small" for="hambatan_bahasa">Bahasa</label>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input check-hambatan" type="checkbox" name="hambatan[]" id="hambatan_harapan" value="Kehilangan Harapan">
                                            <label class="form-check-label small" for="hambatan_harapan">Kehilangan Harapan</label>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input check-hambatan" type="checkbox" name="hambatan[]" id="hambatan_keuangan" value="Masalah Keuangan">
                                            <label class="form-check-label small" for="hambatan_keuangan">Masalah Keuangan</label>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input check-hambatan" type="checkbox" name="hambatan[]" id="hambatan_kesalahan" value="Kesalahan">
                                            <label class="form-check-label small" for="hambatan_kesalahan">Kesalahan</label>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input check-hambatan" type="checkbox" name="hambatan[]" id="hambatan_budaya" value="Faktor Budaya">
                                            <label class="form-check-label small" for="hambatan_budaya">Faktor Budaya</label>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input check-hambatan" type="checkbox" name="hambatan[]" id="hambatan_sensori" value="Kelemahan Sensori">
                                            <label class="form-check-label small" for="hambatan_sensori">Kelemahan Sensori</label>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input check-hambatan" type="checkbox" name="hambatan[]" id="hambatan_pede" value="Tidak Percaya Diri">
                                            <label class="form-check-label small" for="hambatan_pede">Tidak Percaya Diri</label>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input check-hambatan" type="checkbox" name="hambatan[]" id="hambatan_menyangkal" value="Menyangkal">
                                            <label class="form-check-label small" for="hambatan_menyangkal">Menyangkal</label>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input check-hambatan" type="checkbox" name="hambatan[]" id="hambatan_cemas" value="Kecemasan/ketakutan">
                                            <label class="form-check-label small" for="hambatan_cemas">Kecemasan/ketakutan</label>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input check-hambatan" type="checkbox" name="hambatan[]" id="hambatan_kognitif" value="Kelemahan Kognitif">
                                            <label class="form-check-label small" for="hambatan_kognitif">Kelemahan Kognitif</label>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input check-hambatan" type="checkbox" name="hambatan[]" id="hambatan_tertarik" value="Tidak tertarik/tidak berminat">
                                            <label class="form-check-label small" for="hambatan_tertarik">Tidak Tertarik</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex align-items-center gap-2 mt-1">
                                            <div class="form-check mb-0">
                                                <input class="form-check-input check-hambatan" type="checkbox" name="hambatan[]" id="hambatan_lain_chk" value="Lain-lain">
                                                <label class="form-check-label small" for="hambatan_lain_chk">Lain-lain</label>
                                            </div>
                                            <input type="text" id="hambatan_lain" name="hambatan_lain" class="form-control form-control-sm py-0" placeholder="Sebutkan hambatan lain..." disabled style="height: 28px;" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="p-2 border rounded bg-light h-100">
                                <label class="form-label fw-bold mb-1 text-success"><i class="bi bi-tools me-1"></i> Intervensi Mengatasi Hambatan (Dapat Dipilih Lebih Dari 1) :</label>
                                <div class="row g-1">
                                    <div class="col-6 col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input check-intervensi" type="checkbox" name="intervensi[]" id="intervensi_tidak_ada" value="Tidak Ada" checked>
                                            <label class="form-check-label small fw-bold" for="intervensi_tidak_ada">Tidak Ada</label>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input check-intervensi" type="checkbox" name="intervensi[]" id="intervensi_penerjemah" value="Menyediakan Penerjemah">
                                            <label class="form-check-label small" for="intervensi_penerjemah">Menyediakan Penerjemah</label>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input check-intervensi" type="checkbox" name="intervensi[]" id="intervensi_budaya" value="Melakukan pendekatan secara budaya/agama">
                                            <label class="form-check-label small" for="intervensi_budaya">Pendekatan Budaya/Agama</label>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input check-intervensi" type="checkbox" name="intervensi[]" id="intervensi_ulangi" value="Mengulangi materi">
                                            <label class="form-check-label small" for="intervensi_ulangi">Mengulangi Materi</label>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input check-intervensi" type="checkbox" name="intervensi[]" id="intervensi_keluarga" value="Melibatkan keluarga terdekat">
                                            <label class="form-check-label small" for="intervensi_keluarga">Melibatkan Keluarga</label>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input check-intervensi" type="checkbox" name="intervensi[]" id="intervensi_rolemodel" value="Melakukan pendekatan dengan cara memakai role model untuk merubah perilaku">
                                            <label class="form-check-label small" for="intervensi_rolemodel">Memakai Role Model</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex align-items-center gap-2 mt-1">
                                            <div class="form-check mb-0">
                                                <input class="form-check-input check-intervensi" type="checkbox" name="intervensi[]" id="intervensi_lain_chk" value="Lain-lain">
                                                <label class="form-check-label small" for="intervensi_lain_chk">Lain-lain</label>
                                            </div>
                                            <input type="text" id="intervensi_lain" name="intervensi_lain" class="form-control form-control-sm py-0" placeholder="Sebutkan intervensi lain..." disabled style="height: 28px;" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- EVALUASI & TANDA TANGAN PASIEN -->
                    <div class="row gy-2">
                        <div class="col-lg-6 col-md-12">
                            <div class="p-2 border rounded bg-light h-100">
                                <label class="form-label fw-bold mb-1 text-primary"><i class="bi bi-check2-circle me-1"></i> Evaluasi Pemahaman Pasien / Keluarga :</label>
                                <x-input-group>
                                    <x-radio-group name="evaluasi"
                                        :radios="[
                                            'evaluasi1' => ['value' => 'Tidak mengerti', 'label' => 'Tidak Mengerti'],
                                            'evaluasi2' => ['value' => 'Mengerti, tidak mampu menjelaskan/melakukan', 'label' => 'Mengerti, Tidak Mampu Menjelaskan'],
                                            'evaluasi3' => ['value' => 'Mengerti, mampu menjelaskan/melakukan', 'label' => 'Mengerti & Mampu Menjelaskan/Melakukan', 'checked' => true],
                                        ]" />
                                </x-input-group>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="p-2 border rounded bg-light h-100 d-flex flex-column justify-content-between">
                                <div>
                                    <label class="form-label fw-bold mb-1"><i class="bi bi-pen me-1"></i> Bukti Tanda Tangan Pasien / Keluarga :</label>
                                    <div class="d-flex align-items-center gap-2">
                                        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="openSignatureModalEdukasi()">
                                            <i class="bi bi-pencil-square"></i> Bubuhkan Tanda Tangan
                                        </button>
                                        <button type="button" class="btn btn-outline-danger btn-sm" id="btnHapusTtdEdukasi" onclick="clearSignatureEdukasi()" style="display: none;">
                                            <i class="bi bi-trash"></i> Hapus TTD
                                        </button>
                                    </div>
                                </div>
                                <div id="previewTtdEdukasiWrapper" class="mt-2 text-center border p-1 rounded bg-white" style="display: none;">
                                    <span class="text-muted d-block small mb-1">Preview Tanda Tangan Tersimpan:</span>
                                    <img id="previewTtdEdukasiImg" src="" height="50" style="max-width: 120px;" />
                                </div>
                            </div>
                        </div>
                    </div>
                    @csrf
                </form>

                <!-- TABEL RIWAYAT EDUKASI -->
                <div class="d-flex justify-content-between align-items-center mb-1 mt-2">
                    <span class="fw-bold fs-6 text-dark"><i class="bi bi-table me-1"></i> Riwayat Pelaksanaan Edukasi Pasien :</span>
                    <div class="btn-group btn-group-sm" role="group">
                        <button type="button" class="btn btn-outline-primary active" id="filterTableSemua" onclick="filterTableCatatan('Semua')">Semua</button>
                        <button type="button" class="btn btn-outline-primary" id="filterTableRm23" onclick="filterTableCatatan('RM 23')">RM 23</button>
                        <button type="button" class="btn btn-outline-primary" id="filterTableRm24" onclick="filterTableCatatan('RM 24')">RM 24</button>
                    </div>
                </div>

                <div class="table-responsive" style="max-height: 220px; overflow-y: auto;">
                    <table class="table table-striped table-hover table-bordered table-sm" id="tableCatatanEdukasiPasien" style="font-size: 11.5px;">
                        <thead class="table-dark sticky-top">
                            <tr>
                                <th width="3%">#</th>
                                <th width="8%">Form</th>
                                <th width="12%">Disiplin</th>
                                <th>Materi Edukasi</th>
                                <th width="13%">Tgl &amp; Durasi</th>
                                <th width="11%">Metode</th>
                                <th width="14%">Hambatan &amp; Intervensi</th>
                                <th width="12%">Evaluasi</th>
                                <th width="8%">TTD Pasien</th>
                                <th width="10%">Edukator</th>
                                <th width="5%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Loaded via AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- MODAL FOOTER DENGAN TOMBOL CETAK RM 20, RM 23 & RM 24 -->
            <div class="modal-footer d-flex justify-content-between">
                <div class="d-flex gap-2 flex-wrap">
                    <button type="button" class="btn btn-success btn-sm fw-bold" id="btnCetakRm20" onclick="cetakCatatanEdukasi('rm20')" disabled title="Cetak aktif jika data asesmen RM 20 sudah disimpan">
                        <i class="bi bi-printer-fill me-1"></i> Cetak RM 20 (Assesmen &amp; Rencana)
                    </button>
                    <button type="button" class="btn btn-warning btn-sm fw-bold" id="btnCetakRm23" onclick="cetakCatatanEdukasi('rm23')" disabled title="Cetak aktif jika sudah ada data edukasi RM 23">
                        <i class="bi bi-printer-fill me-1"></i> Cetak RM 23 (Multidisiplin)
                    </button>
                    <button type="button" class="btn btn-info btn-sm text-white fw-bold" id="btnCetakRm24" onclick="cetakCatatanEdukasi('rm24')" disabled title="Cetak aktif jika sudah ada data edukasi RM 24">
                        <i class="bi bi-printer-fill me-1"></i> Cetak RM 24 (Edukasi Pasien)
                    </button>
                </div>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-primary btn-sm fw-bold" id="btnSimpanCatatanEdukasi" onclick="handleSimpanEdukasi()">
                        <i class="bi bi-save me-1"></i> Simpan Asesmen (RM 20)
                    </button>
                    <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i> Keluar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SUB-MODAL CANVAS TANDA TANGAN PASIEN/KELUARGA -->
<div class="modal fade" id="modalSignatureEdukasi" tabindex="-1" aria-hidden="true" style="background-color: rgba(0,0,0,0.6); z-index: 1060;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg">
            <div class="modal-header bg-dark text-white py-2">
                <h6 class="modal-title mb-0"><i class="bi bi-pen me-1"></i> Tanda Tangan Pasien / Keluarga (Edukasi)</h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center p-3">
                <p class="text-muted small mb-2">Silakan bubuhkan tanda tangan pasien/keluarga pada area kotak di bawah ini:</p>
                <div style="border: 2px dashed #0d6efd; border-radius: 8px; display: inline-block; background-color: #fafafa;">
                    <canvas id="canvasSignatureEdukasi" width="400" height="200" style="touch-action: none; cursor: crosshair;"></canvas>
                </div>
            </div>
            <div class="modal-footer py-1 d-flex justify-content-between">
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="resetCanvasEdukasi()"><i class="bi bi-arrow-counterclockwise"></i> Reset Garis</button>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary btn-sm" onclick="applySignatureEdukasi()"><i class="bi bi-check2"></i> Gunakan Tanda Tangan</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        const modalCatatanEdukasiPasien = $('#modalCatatanEdukasiPasien');
        const formAsesmenEdukasiRm20 = $('#formAsesmenEdukasiRm20');
        const formCatatanEdukasiPasien = $('#formCatatanEdukasiPasien');
        const formPasienCatatanEdukasi = $('#formPasienCatatanEdukasi');
        const tableCatatanEdukasiPasien = $('#tableCatatanEdukasiPasien');
        const modalSignatureEdukasi = $('#modalSignatureEdukasi');

        let rawCatatanEdukasiList = [];
        let activeFilterJenis = 'Semua';
        let activeFormJenis = 'RM 20';
        let currentPatientData = null;

        // Master Topik Rencana RM 20
        const masterTopikRm20 = [
            { key: 'hak_kewajiban', label: 'Hak dan kewajiban pasien', ppa: 'Perawat / Bidan', sasaran: 'Keluarga (K)', cara: 'Diskusi (D)', evaluasi: 'Mampu menjelaskan' },
            { key: 'orientasi', label: 'Orientasi ruangan', ppa: 'Perawat / Bidan', sasaran: 'Keluarga (K)', cara: 'Demonstrasi (Demo)', evaluasi: 'Mampu mendemonstrasikan' },
            { key: 'kondisi_medis', label: 'Kondisi medis, diagnosis pasti, asuhan & pengobatan', ppa: 'Dokter (DPJP)', sasaran: 'Pasien & Keluarga (P&K)', cara: 'Diskusi (D)', evaluasi: 'Mampu menjelaskan' },
            { key: 'penggunaan_obat', label: 'Penggunaan obat yang efektif dan aman', ppa: 'Farmasi / Apoteker', sasaran: 'Pasien & Keluarga (P&K)', cara: 'Diskusi (D)', evaluasi: 'Mampu menjelaskan' },
            { key: 'peralatan_medis', label: 'Penggunaan peralatan medis yang efektif dan aman', ppa: 'Perawat / Bidan', sasaran: 'Keluarga (K)', cara: 'Demonstrasi (Demo)', evaluasi: 'Mampu mendemonstrasikan' },
            { key: 'diet_nutrisi', label: 'Diet dan nutrisi', ppa: 'Nutrisionis / Gizi', sasaran: 'Keluarga (K)', cara: 'Diskusi (D)', evaluasi: 'Mampu menjelaskan' },
            { key: 'rehabilitasi', label: 'Rehabilitasi medik', ppa: 'Fisioterapis / Dokter', sasaran: 'Pasien & Keluarga (P&K)', cara: 'Demonstrasi (Demo)', evaluasi: 'Mampu mendemonstrasikan' },
            { key: 'manajemen_nyeri', label: 'Manajemen nyeri', ppa: 'Perawat / Tim Nyeri', sasaran: 'Pasien & Keluarga (P&K)', cara: 'Demonstrasi (Demo)', evaluasi: 'Mampu mendemonstrasikan' },
            { key: 'pencegahan_infeksi', label: 'Pencegahan dan pengendalian infeksi', ppa: 'Perawat / Bidan', sasaran: 'Keluarga (K)', cara: 'Demonstrasi (Demo)', evaluasi: 'Mampu mendemonstrasikan' },
            { key: 'kesehatan_berkelanjutan', label: 'Pemenuhan kebutuhan kesehatan berkelanjutan', ppa: 'Perawat / Bidan', sasaran: 'Keluarga (K)', cara: 'Diskusi (D)', evaluasi: 'Mampu menjelaskan' },
            { key: 'lain_lain', label: 'Lain-lain', ppa: 'Perawat / Bidan', sasaran: 'Keluarga (K)', cara: 'Diskusi (D)', evaluasi: 'Mampu menjelaskan' }
        ];

        // Master Checklist RM 23 Berdasarkan Disiplin
        const masterChecklistRm23 = {
            'DPJP': [
                'Kondisi Pasien',
                'Usulan Pengobatan',
                'Nama individu yang memberikan pengobatan',
                'Potensi manfaat dan kekurangannya',
                'Kemungkinan alternatif',
                'Kemungkinan keberhasilan',
                'Kemungkinan timbulnya masalah selama masa pemulihan',
                'Kemungkinan yang terjadi apabila tidak diobat',
                'Lain-lain (Catatan Tambahan)'
            ],
            'Farmasi': [
                'Obat-obatan yang di dapat pasien',
                'Aturan pemakaian dan dosis obat',
                'Efek samping obat',
                'Kontra Indikasi obat',
                'Interaksi obat',
                'Lain-lain (Catatan Tambahan)'
            ],
            'Perawat/Bidan': [
                'Penggunaan peralatan medis yg aman',
                'Pencegahan & pengendalian infeksi (Cuci tangan / Lainnya)',
                'Pendidikan kesehatan berkelanjutan',
                'Orientasi Ruangan',
                'Hak dan Kewajiban pasien',
                'Lain-lain (Catatan Tambahan)'
            ],
            'Nutrisionis': [
                'Status gizi & pelayanan makanan RS',
                'Diet selama perawatan',
                'Diet untuk di rumah',
                'Penyimpanan makanan / cegah kontaminasi',
                'Lain-lain (Catatan Tambahan)'
            ],
            'Manajemen Nyeri': [
                'a. Farmakologi',
                'b. Non farmakologi (Relaksasi / Distraksi / Massage / Kompres)',
                'Lain-lain (Catatan Tambahan)'
            ]
        };

        // Inisialisasi Canvas TTD
        let canvasEdukasi = document.getElementById('canvasSignatureEdukasi');
        let ctxEdukasi = canvasEdukasi.getContext('2d');
        let isDrawingEdukasi = false;
        let isCanvasEmptyEdukasi = true;

        function getCanvasMousePos(canvas, evt) {
            let rect = canvas.getBoundingClientRect();
            return {
                x: (evt.clientX - rect.left) * (canvas.width / rect.width),
                y: (evt.clientY - rect.top) * (canvas.height / rect.height)
            };
        }

        function getCanvasTouchPos(canvas, evt) {
            let rect = canvas.getBoundingClientRect();
            let touch = evt.touches[0];
            return {
                x: (touch.clientX - rect.left) * (canvas.width / rect.width),
                y: (touch.clientY - rect.top) * (canvas.height / rect.height)
            };
        }

        canvasEdukasi.addEventListener('mousedown', function(e) {
            isDrawingEdukasi = true;
            isCanvasEmptyEdukasi = false;
            let pos = getCanvasMousePos(canvasEdukasi, e);
            ctxEdukasi.beginPath();
            ctxEdukasi.moveTo(pos.x, pos.y);
        });

        canvasEdukasi.addEventListener('mousemove', function(e) {
            if (!isDrawingEdukasi) return;
            let pos = getCanvasMousePos(canvasEdukasi, e);
            ctxEdukasi.lineWidth = 2.5;
            ctxEdukasi.lineCap = 'round';
            ctxEdukasi.strokeStyle = '#000';
            ctxEdukasi.lineTo(pos.x, pos.y);
            ctxEdukasi.stroke();
        });

        window.addEventListener('mouseup', function() {
            isDrawingEdukasi = false;
        });

        canvasEdukasi.addEventListener('touchstart', function(e) {
            e.preventDefault();
            isDrawingEdukasi = true;
            isCanvasEmptyEdukasi = false;
            let pos = getCanvasTouchPos(canvasEdukasi, e);
            ctxEdukasi.beginPath();
            ctxEdukasi.moveTo(pos.x, pos.y);
        }, { passive: false });

        canvasEdukasi.addEventListener('touchmove', function(e) {
            e.preventDefault();
            if (!isDrawingEdukasi) return;
            let pos = getCanvasTouchPos(canvasEdukasi, e);
            ctxEdukasi.lineWidth = 2.5;
            ctxEdukasi.lineCap = 'round';
            ctxEdukasi.strokeStyle = '#000';
            ctxEdukasi.lineTo(pos.x, pos.y);
            ctxEdukasi.stroke();
        }, { passive: false });

        canvasEdukasi.addEventListener('touchend', function(e) {
            e.preventDefault();
            isDrawingEdukasi = false;
        }, { passive: false });

        function resetCanvasEdukasi() {
            ctxEdukasi.clearRect(0, 0, canvasEdukasi.width, canvasEdukasi.height);
            isCanvasEmptyEdukasi = true;
        }

        function openSignatureModalEdukasi() {
            resetCanvasEdukasi();
            modalSignatureEdukasi.modal('show');
        }

        function applySignatureEdukasi() {
            if (isCanvasEmptyEdukasi) {
                Swal.fire('Peringatan', 'Kanvas tanda tangan masih kosong', 'warning');
                return;
            }
            let dataUrl = canvasEdukasi.toDataURL('image/png');
            $('#edukasi_ttd_pasien').val(dataUrl);
            $('#previewTtdEdukasiImg').attr('src', dataUrl);
            $('#previewTtdEdukasiWrapper').show();
            $('#btnHapusTtdEdukasi').show();
            modalSignatureEdukasi.modal('hide');
        }

        function clearSignatureEdukasi() {
            $('#edukasi_ttd_pasien').val('');
            $('#previewTtdEdukasiImg').attr('src', '');
            $('#previewTtdEdukasiWrapper').hide();
            $('#btnHapusTtdEdukasi').hide();
        }

        function switchFormJenis(jenis) {
            activeFormJenis = jenis;
            $('#jenis_form').val(jenis);

            if (jenis === 'RM 20') {
                $('#formAsesmenEdukasiRm20').show();
                $('#formCatatanEdukasiPasien').hide();
                $('#btnSimpanCatatanEdukasi').html('<i class="bi bi-save me-1"></i> Simpan Asesmen (RM 20)');
                let no_rawat = formPasienCatatanEdukasi.find('input[name=no_rawat]').val();
                if (no_rawat) {
                    loadAsesmenRm20(no_rawat);
                }
            } else if (jenis === 'RM 23') {
                $('#formAsesmenEdukasiRm20').hide();
                $('#formCatatanEdukasiPasien').show();
                $('#sectionRm23').show();
                $('#labelMateri').text('Materi Edukasi Tambahan / Keterangan Khusus :');
                $('#materi').attr('placeholder', 'Ketik catatan materi tambahan jika diperlukan...');
                $('#btnSimpanCatatanEdukasi').html('<i class="bi bi-save me-1"></i> Simpan Catatan Edukasi (RM 23)');
                filterTableCatatan('RM 23');
                renderChecklistMateri();
            } else if (jenis === 'RM 24') {
                $('#formAsesmenEdukasiRm20').hide();
                $('#formCatatanEdukasiPasien').show();
                $('#sectionRm23').hide();
                $('#labelMateri').text('Materi Edukasi (RM 24) :');
                $('#materi').attr('placeholder', 'Ketik materi edukasi yang disampaikan ke pasien...');
                $('#btnSimpanCatatanEdukasi').html('<i class="bi bi-save me-1"></i> Simpan Catatan Edukasi (RM 24)');
                filterTableCatatan('RM 24');
            }
        }

        function handleSimpanEdukasi() {
            if (activeFormJenis === 'RM 20') {
                simpanAsesmenRm20();
            } else {
                simpanCatatanEdukasi();
            }
        }

        // ======================== RM 20 LOGIC ========================
        function renderTableRencanaRm20(savedData = {}) {
            let tbody = $('#tableRencanaRm20 tbody');
            tbody.empty();

            masterTopikRm20.forEach(topik => {
                let rowData = savedData[topik.key] || {};
                let ppa = rowData.ppa || topik.ppa;
                let sasaran = rowData.sasaran || topik.sasaran;
                let cara = rowData.cara || topik.cara;
                let evaluasi = rowData.evaluasi || topik.evaluasi;

                let rowHtml = `
                    <tr data-key="${topik.key}">
                        <td class="fw-bold text-dark py-1">${topik.label}</td>
                        <td class="py-1">
                            <input type="text" class="form-control form-control-sm py-0 plan-ppa" value="${ppa}" style="font-size: 11px;" />
                        </td>
                        <td class="py-1">
                            <select class="form-select form-select-sm py-0 plan-sasaran" style="font-size: 11px;">
                                <option value="Keluarga (K)" ${sasaran === 'Keluarga (K)' ? 'selected' : ''}>Keluarga (K)</option>
                                <option value="Pasien (P)" ${sasaran === 'Pasien (P)' ? 'selected' : ''}>Pasien (P)</option>
                                <option value="Pasien & Keluarga (P&K)" ${sasaran === 'Pasien & Keluarga (P&K)' ? 'selected' : ''}>Pasien & Keluarga (P&K)</option>
                            </select>
                        </td>
                        <td class="py-1">
                            <select class="form-select form-select-sm py-0 plan-cara" style="font-size: 11px;">
                                <option value="Diskusi (D)" ${cara === 'Diskusi (D)' ? 'selected' : ''}>Diskusi (D)</option>
                                <option value="Ceramah (C)" ${cara === 'Ceramah (C)' ? 'selected' : ''}>Ceramah (C)</option>
                                <option value="Demonstrasi (Demo)" ${cara === 'Demonstrasi (Demo)' ? 'selected' : ''}>Demonstrasi (Demo)</option>
                                <option value="Simulasi (S)" ${cara === 'Simulasi (S)' ? 'selected' : ''}>Simulasi (S)</option>
                                <option value="Observasi (O)" ${cara === 'Observasi (O)' ? 'selected' : ''}>Observasi (O)</option>
                                <option value="Praktek Langsung (PL)" ${cara === 'Praktek Langsung (PL)' ? 'selected' : ''}>Praktek Langsung (PL)</option>
                            </select>
                        </td>
                        <td class="py-1">
                            <select class="form-select form-select-sm py-0 plan-evaluasi" style="font-size: 11px;">
                                <option value="Mampu menjelaskan" ${evaluasi === 'Mampu menjelaskan' ? 'selected' : ''}>Mampu Menjelaskan</option>
                                <option value="Mampu mendemonstrasikan" ${evaluasi === 'Mampu mendemonstrasikan' ? 'selected' : ''}>Mampu Mendemonstrasikan</option>
                            </select>
                        </td>
                    </tr>
                `;
                tbody.append(rowHtml);
            });
        }

        function setDefaultRm20() {
            if (currentPatientData && currentPatientData.pasien) {
                $('#rm20_agama').val(currentPatientData.pasien.agama || 'Islam');
                let pnd = currentPatientData.pasien.pnd || 'SMA';
                $(`input[name="tingkat_pendidikan"][value="${pnd}"]`).prop('checked', true);
            }
            $('#rm20_bahasa_indonesia').val('Aktif');
            $('#rm20_bahasa_daerah').val('Jawa');
            $('#rm20_bahasa_daerah_status').val('Aktif');
            $('#rm20_bahasa_inggris').val('-');
            $('#rm20_bahasa_lain').val('');
            $('#rm20_bahasa_lain_status').val('-');
            $('#rm20_penerjemah_tidak').prop('checked', true);
            $('#rm20_penerjemah_bahasa').val('').attr('disabled', 'disabled');
            $('#rm20_isyarat_tidak').prop('checked', true);
            $('#rm20_isyarat_ket').val('').attr('disabled', 'disabled');

            $('.rm20-cara').prop('checked', false);
            $('#rm20_cara_diskusi, #rm20_cara_audio').prop('checked', true);

            $('#rm20_mampu_membaca').val('Ya');
            $('#rm20_hambatan_emosi').val('Tidak');
            $('#rm20_kesediaan_menerima').val('Ya');
            $('#rm20_keterbatasan_fisik').val('Tidak');

            toggleAllKebutuhan(true);
            $('#rm20_rencana_individu').prop('checked', true);
            renderTableRencanaRm20();
        }

        function toggleAllKebutuhan(status) {
            $('.rm20-kebutuhan').not('#rm20_keb_11').prop('checked', status);
        }

        $(document).on('change', 'input[name="perlu_penerjemah"]', function() {
            if ($(this).val() === 'Ya') {
                $('#rm20_penerjemah_bahasa').removeAttr('disabled').focus();
            } else {
                $('#rm20_penerjemah_bahasa').attr('disabled', 'disabled').val('');
            }
        });

        $(document).on('change', 'input[name="bahasa_isyarat"]', function() {
            if ($(this).val() === 'Ya') {
                $('#rm20_isyarat_ket').removeAttr('disabled').focus();
            } else {
                $('#rm20_isyarat_ket').attr('disabled', 'disabled').val('');
            }
        });

        $(document).on('change', '#rm20_keb_11', function() {
            if ($(this).is(':checked')) {
                $('#rm20_kebutuhan_edukasi_lain').removeAttr('disabled').focus();
            } else {
                $('#rm20_kebutuhan_edukasi_lain').attr('disabled', 'disabled').val('');
            }
        });

        function loadAsesmenRm20(no_rawat) {
            $.get(`${url}/asesmen/kebutuhan/edukasi`, { no_rawat: no_rawat }).done((data) => {
                if (data && data.no_rawat) {
                    $('#btnCetakRm20').prop('disabled', false);
                    $('#rm20_no_rawat').val(data.no_rawat);
                    $('#rm20_tanggal').val(data.tanggal);
                    $('#rm20_ruang').val(data.ruang);
                    $('#rm20_nip').val(data.nip);
                    $('#rm20_nama').val(data.petugas ? data.petugas.nama : (data.pegawai ? data.pegawai.nama : data.nip));
                    $('#rm20_agama').val(data.agama_keyakinan || '');
                    $('#rm20_bahasa_indonesia').val(data.bahasa_indonesia || 'Aktif');
                    $('#rm20_bahasa_daerah').val(data.bahasa_daerah || 'Jawa');
                    $('#rm20_bahasa_daerah_status').val(data.bahasa_daerah_status || 'Aktif');
                    $('#rm20_bahasa_inggris').val(data.bahasa_inggris || '-');
                    $('#rm20_bahasa_lain').val(data.bahasa_lain || '');
                    $('#rm20_bahasa_lain_status').val(data.bahasa_lain_status || '-');

                    if (data.perlu_penerjemah === 'Ya') {
                        $('#rm20_penerjemah_ya').prop('checked', true);
                        $('#rm20_penerjemah_bahasa').removeAttr('disabled').val(data.penerjemah_bahasa || '');
                    } else {
                        $('#rm20_penerjemah_tidak').prop('checked', true);
                        $('#rm20_penerjemah_bahasa').attr('disabled', 'disabled').val('');
                    }

                    if (data.bahasa_isyarat === 'Ya') {
                        $('#rm20_isyarat_ya').prop('checked', true);
                        $('#rm20_isyarat_ket').removeAttr('disabled').val(data.bahasa_isyarat_ket || '');
                    } else {
                        $('#rm20_isyarat_tidak').prop('checked', true);
                        $('#rm20_isyarat_ket').attr('disabled', 'disabled').val('');
                    }

                    let caraArr = (data.cara_belajar || '').split(',').map(s => s.trim());
                    $('.rm20-cara').each(function() {
                        $(this).prop('checked', caraArr.includes($(this).val()));
                    });

                    if (data.tingkat_pendidikan) {
                        $(`input[name="tingkat_pendidikan"][value="${data.tingkat_pendidikan}"]`).prop('checked', true);
                    }

                    $('#rm20_mampu_membaca').val(data.mampu_membaca || 'Ya');
                    $('#rm20_hambatan_emosi').val(data.hambatan_emosi || 'Tidak');
                    $('#rm20_kesediaan_menerima').val(data.kesediaan_menerima || 'Ya');
                    $('#rm20_keterbatasan_fisik').val(data.keterbatasan_fisik || 'Tidak');

                    let kebText = data.kebutuhan_edukasi || '';
                    $('.rm20-kebutuhan').each(function() {
                        let v = $(this).val();
                        if (v === 'Lain-lain') {
                            let hasLain = kebText.includes('Lain-lain') || data.kebutuhan_edukasi_lain;
                            $(this).prop('checked', !!hasLain);
                            if (hasLain) {
                                $('#rm20_kebutuhan_edukasi_lain').removeAttr('disabled').val(data.kebutuhan_edukasi_lain || '');
                            }
                        } else {
                            $(this).prop('checked', kebText.includes(v.split(' ')[0]));
                        }
                    });

                    if (data.rencana_pelaksanaan === 'Kolaboratif') {
                        $('#rm20_rencana_kolaboratif').prop('checked', true);
                    } else {
                        $('#rm20_rencana_individu').prop('checked', true);
                    }

                    let savedRencana = data.tabel_rencana || {};
                    if (typeof savedRencana === 'string') {
                        try { savedRencana = JSON.parse(savedRencana); } catch(e) { savedRencana = {}; }
                    }
                    renderTableRencanaRm20(savedRencana);
                } else {
                    // Belum ada data asesmen, tombol cetak dinonaktifkan
                    $('#btnCetakRm20').prop('disabled', true);
                    setDefaultRm20();
                }
            });
        }

        function simpanAsesmenRm20() {
            let no_rawat = formPasienCatatanEdukasi.find('input[name=no_rawat]').val();
            if (!no_rawat) {
                Swal.fire('Peringatan', 'Nomor rawat tidak ditemukan', 'warning');
                return;
            }

            let caraBelajar = [];
            $('.rm20-cara:checked').each(function() { caraBelajar.push($(this).val()); });

            let kebutuhanEdukasi = [];
            $('.rm20-kebutuhan:checked').each(function() { kebutuhanEdukasi.push($(this).val()); });

            // Build tabel_rencana object
            let tabelRencana = {};
            $('#tableRencanaRm20 tbody tr').each(function() {
                let key = $(this).data('key');
                tabelRencana[key] = {
                    ppa: $(this).find('.plan-ppa').val(),
                    sasaran: $(this).find('.plan-sasaran').val(),
                    cara: $(this).find('.plan-cara').val(),
                    evaluasi: $(this).find('.plan-evaluasi').val(),
                };
            });

            let tglRaw = $('#rm20_tanggal').val();
            let tglFormatted = tglRaw;
            let tglParts = tglRaw.split(' ');
            if (tglParts.length > 1) {
                tglFormatted = `${splitTanggal(tglParts[0])} ${tglParts[1]}`;
            }

            let postData = {
                no_rawat: no_rawat,
                tanggal: tglFormatted,
                ruang: $('#rm20_ruang').val(),
                nip: $('#rm20_nip').val(),
                agama_keyakinan: $('#rm20_agama').val(),
                bahasa_indonesia: $('#rm20_bahasa_indonesia').val(),
                bahasa_daerah: $('#rm20_bahasa_daerah').val(),
                bahasa_daerah_status: $('#rm20_bahasa_daerah_status').val(),
                bahasa_inggris: $('#rm20_bahasa_inggris').val(),
                bahasa_lain: $('#rm20_bahasa_lain').val(),
                bahasa_lain_status: $('#rm20_bahasa_lain_status').val(),
                perlu_penerjemah: $('input[name="perlu_penerjemah"]:checked').val() || 'Tidak',
                penerjemah_bahasa: $('#rm20_penerjemah_bahasa').val(),
                bahasa_isyarat: $('input[name="bahasa_isyarat"]:checked').val() || 'Tidak',
                bahasa_isyarat_ket: $('#rm20_isyarat_ket').val(),
                cara_belajar: caraBelajar,
                tingkat_pendidikan: $('input[name="tingkat_pendidikan"]:checked').val() || 'SMA',
                mampu_membaca: $('#rm20_mampu_membaca').val(),
                hambatan_emosi: $('#rm20_hambatan_emosi').val(),
                kesediaan_menerima: $('#rm20_kesediaan_menerima').val(),
                keterbatasan_fisik: $('#rm20_keterbatasan_fisik').val(),
                kebutuhan_edukasi: kebutuhanEdukasi,
                kebutuhan_edukasi_lain: $('#rm20_kebutuhan_edukasi_lain').val(),
                rencana_pelaksanaan: $('input[name="rencana_pelaksanaan"]:checked').val() || 'Individu',
                tabel_rencana: tabelRencana,
                _token: "{{ csrf_token() }}"
            };

            $.post(`${url}/asesmen/kebutuhan/edukasi`, postData).done((response) => {
                alertSuccessAjax(response).then(() => {
                    loadAsesmenRm20(no_rawat);
                });
            }).fail((error) => {
                alertErrorAjax(error);
            });
        }

        function renderChecklistMateri(selectedItems = []) {
            let disiplin = $('input[name="disiplin"]:checked').val() || 'DPJP';
            let items = masterChecklistRm23[disiplin] || [];
            let container = $('#containerChecklistMateri');
            container.empty();

            let html = `
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <label class="form-label fw-bold small text-muted mb-0">Checklist Poin Materi Standar (${disiplin}) :</label>
                    <div class="form-check form-check-inline m-0">
                        <input class="form-check-input" type="checkbox" id="checkAllMateri" style="cursor: pointer;">
                        <label class="form-check-label small fw-bold text-primary" for="checkAllMateri" style="cursor: pointer;">
                            <i class="bi bi-check-all"></i> Centang Semua
                        </label>
                    </div>
                </div>
                <div class="row gy-1">`;
            items.forEach((item, idx) => {
                let isChecked = selectedItems.includes(item) ? 'checked' : '';
                html += `
                    <div class="col-md-6 col-sm-12">
                        <div class="form-check form-check-sm">
                            <input class="form-check-input check-materi-item" type="checkbox" value="${item}" id="chk_materi_${idx}" ${isChecked}>
                            <label class="form-check-label small" for="chk_materi_${idx}">${item}</label>
                        </div>
                    </div>
                `;
            });
            html += `</div>`;
            container.html(html);

            let allChecked = items.length > 0 && selectedItems.length === items.length;
            $('#checkAllMateri').prop('checked', allChecked);
        }

        $(document).on('change', '#checkAllMateri', function() {
            let isChecked = $(this).is(':checked');
            $('.check-materi-item').prop('checked', isChecked);
        });

        $(document).on('change', '.check-materi-item', function() {
            let total = $('.check-materi-item').length;
            let checked = $('.check-materi-item:checked').length;
            $('#checkAllMateri').prop('checked', total > 0 && total === checked);

            if ($(this).val() === 'Lain-lain (Catatan Tambahan)' && $(this).is(':checked')) {
                $('#materi').focus();
            }
        });

        // Event handler checkbox hambatan (eksklusif Tidak Ada vs opsi lain)
        $(document).on('change', '.check-hambatan', function() {
            let val = $(this).val();
            let isChecked = $(this).is(':checked');

            if (val === 'Tidak Ada' && isChecked) {
                $('.check-hambatan').not('#hambatan_tidak_ada').prop('checked', false);
                $('#hambatan_lain').attr('disabled', 'disabled').val('');
            } else if (val !== 'Tidak Ada' && isChecked) {
                $('#hambatan_tidak_ada').prop('checked', false);
            }

            if ($('#hambatan_lain_chk').is(':checked')) {
                $('#hambatan_lain').removeAttr('disabled').focus();
            } else {
                $('#hambatan_lain').attr('disabled', 'disabled').val('');
            }

            if (!$('.check-hambatan:checked').length) {
                $('#hambatan_tidak_ada').prop('checked', true);
            }
        });

        // Event handler checkbox intervensi (eksklusif Tidak Ada vs opsi lain)
        $(document).on('change', '.check-intervensi', function() {
            let val = $(this).val();
            let isChecked = $(this).is(':checked');

            if (val === 'Tidak Ada' && isChecked) {
                $('.check-intervensi').not('#intervensi_tidak_ada').prop('checked', false);
                $('#intervensi_lain').attr('disabled', 'disabled').val('');
            } else if (val !== 'Tidak Ada' && isChecked) {
                $('#intervensi_tidak_ada').prop('checked', false);
            }

            if ($('#intervensi_lain_chk').is(':checked')) {
                $('#intervensi_lain').removeAttr('disabled').focus();
            } else {
                $('#intervensi_lain').attr('disabled', 'disabled').val('');
            }

            if (!$('.check-intervensi:checked').length) {
                $('#intervensi_tidak_ada').prop('checked', true);
            }
        });

        function catatanEdukasiPasien(no_rawat) {
            modalCatatanEdukasiPasien.modal('show');
            const nip = "{{ session()->get('pegawai')->nik }}";
            const nm_petugas = "{{ session()->get('pegawai')->nama }}";
            const tanggal = moment().format('DD-MM-YYYY HH:mm:ss');

            // Reset tombol cetak ke disabled hingga data terkonfirmasi
            $('#btnCetakRm20').prop('disabled', true);
            $('#btnCetakRm23').prop('disabled', true);
            $('#btnCetakRm24').prop('disabled', true);

            // Set RM 20 fields
            $('#rm20_no_rawat').val(no_rawat);
            $('#rm20_nip').val(nip);
            $('#rm20_nama').val(nm_petugas);
            $('#rm20_tanggal').val(tanggal);

            // Set RM 23/24 fields
            formCatatanEdukasiPasien.find('input[name=nip]').val(nip);
            formCatatanEdukasiPasien.find('input[name=nama]').val(nm_petugas);
            formCatatanEdukasiPasien.find('input[name=tanggal]').val(tanggal);
            formCatatanEdukasiPasien.find('input[name=durasi]').val('10 Menit');
            clearSignatureEdukasi();

            // Default tab: RM 20
            $('#tab-rm20-tab').tab('show');
            switchFormJenis('RM 20');

            getRegPeriksa(no_rawat).done((response) => {
                currentPatientData = response;
                const { pasien, dokter, kamar_inap } = response;
                const kamar = (kamar_inap || []).filter((item) => item.stts_pulang !== 'Pindah Kamar');
                const bangsal = kamar.map((item) => item.kamar.bangsal.nm_bangsal).join('');
                const diagnosa = (kamar_inap || []).map((item) => item.diagnosa_awal).join('');
                const lama = (kamar_inap || []).map((item) => item.lama).join('');

                formPasienCatatanEdukasi.find('input[name=no_rawat]').val(no_rawat);
                formPasienCatatanEdukasi.find('input[name=nm_pasien]').val(`${response.no_rkm_medis} - ${response.pasien.nm_pasien} (${response.pasien.jk})`);
                formPasienCatatanEdukasi.find('input[name=tgl_lahir]').val(`${formatTanggal(response.pasien.tgl_lahir)} / ${response.umurdaftar} ${response.sttsumur}`);
                formPasienCatatanEdukasi.find('input[name=umur]').val(`${response.umurdaftar} ${response.sttsumur}`);
                formPasienCatatanEdukasi.find('input[name=p_jawab]').val(response.p_jawab);
                formPasienCatatanEdukasi.find('input[name=kamar]').val(bangsal);
                formPasienCatatanEdukasi.find('input[name=diagnosa_awal]').val(diagnosa);
                formPasienCatatanEdukasi.find('input[name=dokter]').val(dokter ? dokter.nm_dokter : '-');
                formPasienCatatanEdukasi.find('input[name=lama]').val(`${hitungLamaHari(response.tgl_registrasi)} Hari`);

                $('#rm20_ruang').val(bangsal);
                formCatatanEdukasiPasien.find('input[name=nama_penerima]').val(response.p_jawab || response.pasien.nm_pasien);

                loadAsesmenRm20(no_rawat);
                renderCatatanEdukasiPasien(no_rawat);
            });
        }

        function renderCatatanEdukasiPasien(no_rawat) {
            tableCatatanEdukasiPasien.find('tbody').empty();
            $.get(`${url}/catatan/pelaksanaan/edukasi/pasien`, { no_rawat: no_rawat }).done((response) => {
                rawCatatanEdukasiList = response || [];

                const hasRm23 = rawCatatanEdukasiList.some(item => (item.jenis_form || 'RM 23') === 'RM 23');
                const hasRm24 = rawCatatanEdukasiList.some(item => item.jenis_form === 'RM 24');
                $('#btnCetakRm23').prop('disabled', !hasRm23);
                $('#btnCetakRm24').prop('disabled', !hasRm24);

                displayFilteredTable();
            });
        }

        function filterTableCatatan(jenis) {
            activeFilterJenis = jenis;
            $('#filterTableSemua, #filterTableRm23, #filterTableRm24').removeClass('active');
            if (jenis === 'Semua') $('#filterTableSemua').addClass('active');
            if (jenis === 'RM 23') $('#filterTableRm23').addClass('active');
            if (jenis === 'RM 24') $('#filterTableRm24').addClass('active');
            displayFilteredTable();
        }

        function displayFilteredTable() {
            tableCatatanEdukasiPasien.find('tbody').empty();
            let filtered = rawCatatanEdukasiList;
            if (activeFilterJenis !== 'Semua') {
                filtered = rawCatatanEdukasiList.filter(item => (item.jenis_form || 'RM 23') === activeFilterJenis);
            }

            if (!filtered || !filtered.length) {
                tableCatatanEdukasiPasien.find('tbody').html(`<tr><td colspan="11" class="text-center text-muted py-3">Belum ada data catatan edukasi pasien</td></tr>`);
                return;
            }

            const dataCatatan = filtered.map((item, index) => {
                let badgeClass = item.jenis_form === 'RM 24' ? 'bg-info' : 'bg-primary';
                let ttdHtml = '-';
                if (item.ttd_pasien) {
                    let ttdUrl = item.ttd_pasien;
                    if (!ttdUrl.startsWith('data:image') && !ttdUrl.startsWith('http')) {
                        ttdUrl = '{{ asset("storage") }}/' + ttdUrl.replace(/^\/+/, '');
                    }
                    ttdHtml = `<img src="${ttdUrl}" height="28" style="max-width: 60px;" alt="TTD" /><br><span style="font-size: 9px;">${item.nama_penerima || ''}</span>`;
                }

                let materiClean = (item.materi || '').replace(/\n/g, '<br>');

                return `<tr>
                    <td class="text-center">${index + 1}</td>
                    <td class="text-center"><span class="badge ${badgeClass}">${item.jenis_form || 'RM 23'}</span></td>
                    <td class="fw-bold text-primary">${item.disiplin || '-'}</td>
                    <td>${materiClean}</td>
                    <td class="text-center">${item.tanggal}<br><strong class="text-success">${item.durasi || ''}</strong></td>
                    <td class="text-center">${item.metode || '-'}</td>
                    <td>
                        <small><strong>H:</strong> ${item.hambatan_lain ? item.hambatan_lain : (item.hambatan || 'Tidak Ada')}</small><br>
                        <small><strong>I:</strong> ${item.intervensi_lain ? item.intervensi_lain : (item.intervensi || 'Tidak Ada')}</small>
                    </td>
                    <td><small>${item.evaluasi || '-'}</small></td>
                    <td class="text-center">${ttdHtml}</td>
                    <td class="text-center"><small class="fw-bold">${item.petugas ? item.petugas.nama : (item.dokter ? item.dokter.nm_dokter : item.nip)}</small></td>
                    <td class="text-center">
                        <button type="button" class="btn btn-danger btn-sm py-0 px-1" title="Hapus" onclick="deleteCatatanEdukasiPasien('${item.no_rawat}', '${item.tanggal}', '${item.nip}')">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>`;
            });
            tableCatatanEdukasiPasien.find('tbody').append(dataCatatan);
        }

        function simpanCatatanEdukasi() {
            const jenisForm = $('#jenis_form').val() || 'RM 23';
            let finalMateriLines = [];

            if (jenisForm === 'RM 23') {
                $('.check-materi-item:checked').each(function() {
                    if ($(this).val() !== 'Lain-lain (Catatan Tambahan)') {
                        finalMateriLines.push($(this).val());
                    }
                });
            }

            let textTambahan = $('#materi').val().trim();
            if (textTambahan) {
                finalMateriLines.push(textTambahan);
            }

            if (!finalMateriLines.length) {
                Swal.fire('Peringatan', 'Silakan pilih minimal 1 checklist materi atau ketik materi edukasi!', 'warning');
                return;
            }

            const data = getDataForm('#formCatatanEdukasiPasien', ['input', 'select', 'textarea']);
            data['no_rawat'] = formPasienCatatanEdukasi.find('input[name=no_rawat]').val();
            data['jenis_form'] = jenisForm;
            data['materi'] = finalMateriLines.join("\n");

            let metodeArr = [];
            $('.check-metode:checked').each(function() { metodeArr.push($(this).val()); });
            data['metode'] = metodeArr.length ? metodeArr.join(', ') : 'Diskusi / Wawancara';

            let hambatanArr = [];
            $('.check-hambatan:checked').each(function() {
                if ($(this).val() !== 'Lain-lain') {
                    hambatanArr.push($(this).val());
                }
            });
            if ($('#hambatan_lain_chk').is(':checked') && $('#hambatan_lain').val().trim()) {
                hambatanArr.push('Lain-lain: ' + $('#hambatan_lain').val().trim());
            } else if ($('#hambatan_lain_chk').is(':checked')) {
                hambatanArr.push('Lain-lain');
            }
            data['hambatan'] = hambatanArr.length ? hambatanArr.join(', ') : 'Tidak Ada';
            data['hambatan_lain'] = $('#hambatan_lain_chk').is(':checked') ? $('#hambatan_lain').val() : '';

            let intervensiArr = [];
            $('.check-intervensi:checked').each(function() {
                if ($(this).val() !== 'Lain-lain') {
                    intervensiArr.push($(this).val());
                }
            });
            if ($('#intervensi_lain_chk').is(':checked') && $('#intervensi_lain').val().trim()) {
                intervensiArr.push('Lain-lain: ' + $('#intervensi_lain').val().trim());
            } else if ($('#intervensi_lain_chk').is(':checked')) {
                intervensiArr.push('Lain-lain');
            }
            data['intervensi'] = intervensiArr.length ? intervensiArr.join(', ') : 'Tidak Ada';
            data['intervensi_lain'] = $('#intervensi_lain_chk').is(':checked') ? $('#intervensi_lain').val() : '';

            const tanggalArr = data['tanggal'].split(' ');
            if (tanggalArr.length > 1) {
                data['tanggal'] = `${splitTanggal(tanggalArr[0])} ${tanggalArr[1]}`;
            }

            $.post(`${url}/catatan/pelaksanaan/edukasi/pasien`, data).done((response) => {
                alertSuccessAjax(response).then(() => {
                    renderCatatanEdukasiPasien(data['no_rawat']);
                    $('#materi').val('');
                    $('.check-materi-item').prop('checked', false);
                    $('#checkAllMateri').prop('checked', false);
                    clearSignatureEdukasi();

                    // Reset checklist metode, hambatan, intervensi ke default
                    $('.check-metode').prop('checked', false);
                    $('#metode_diskusi').prop('checked', true);
                    $('.check-hambatan').prop('checked', false);
                    $('#hambatan_tidak_ada').prop('checked', true);
                    $('.check-intervensi').prop('checked', false);
                    $('#intervensi_tidak_ada').prop('checked', true);

                    const nip = "{{ session()->get('pegawai')->nik }}";
                    const nm_petugas = "{{ session()->get('pegawai')->nama }}";
                    const tanggal = moment().format('DD-MM-YYYY HH:mm:ss');

                    formCatatanEdukasiPasien.find('input[name=nip]').val(nip);
                    formCatatanEdukasiPasien.find('input[name=nama]').val(nm_petugas);
                    formCatatanEdukasiPasien.find('input[name=tanggal]').val(tanggal);
                    formCatatanEdukasiPasien.find('#hambatan_lain').attr('disabled', 'disabled').val('');
                    formCatatanEdukasiPasien.find('#intervensi_lain').attr('disabled', 'disabled').val('');
                });
            }).fail((error) => {
                alertErrorAjax(error);
            });
        }

        function deleteCatatanEdukasiPasien(no_rawat, tanggal, nip) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: 'Data edukasi yang dihapus tidak bisa dikembalikan!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post(`${url}/catatan/pelaksanaan/edukasi/pasien/delete`, {
                        no_rawat: no_rawat,
                        tanggal: tanggal,
                        nip: nip,
                        _token: "{{ csrf_token() }}"
                    }).done((response) => {
                        alertSuccessAjax(response).then(() => {
                            renderCatatanEdukasiPasien(no_rawat);
                        });
                    }).fail((error) => {
                        alertErrorAjax(error);
                    });
                }
            });
        }

        function cetakCatatanEdukasi(tipe) {
            if (tipe === 'rm20' && $('#btnCetakRm20').is(':disabled')) {
                Swal.fire('Informasi', 'Data Asesmen Kebutuhan Edukasi (RM 20) belum disimpan', 'warning');
                return;
            }
            if (tipe === 'rm23' && $('#btnCetakRm23').is(':disabled')) {
                Swal.fire('Informasi', 'Belum ada data Catatan Edukasi RM 23 yang tersimpan', 'warning');
                return;
            }
            if (tipe === 'rm24' && $('#btnCetakRm24').is(':disabled')) {
                Swal.fire('Informasi', 'Belum ada data Catatan Edukasi RM 24 yang tersimpan', 'warning');
                return;
            }

            let no_rawat = formPasienCatatanEdukasi.find('input[name=no_rawat]').val();
            if (!no_rawat) {
                Swal.fire('Peringatan', 'Nomor rawat tidak ditemukan', 'warning');
                return;
            }
            let cleanNoRawat = no_rawat.replace(/\//g, '-');
            let printUrl = `${url}/catatan/pelaksanaan/edukasi/pasien/print/${tipe}?no_rawat=${cleanNoRawat}`;
            window.open(printUrl, '_blank');
        }
    </script>
@endpush

