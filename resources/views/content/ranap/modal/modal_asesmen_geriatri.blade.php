<div class="modal fade" id="modalAsesmenGeriatri" tabindex="-1" aria-labelledby="modalAsesmenGeriatriLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title fs-5" id="modalAsesmenGeriatriLabel">
                    <i class="bi bi-person-heart me-2"></i> <i>ASESMEN AWAL GERIATRI (RM 06 K/2015)</i>
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formAsesmenGeriatri">
                    @csrf
                    <!-- Identitas Pasien Banner -->
                    <div class="row gy-2 mb-3 bg-light p-2 rounded border">
                        <div class="col-lg-3 col-md-6">
                            <label class="form-label mb-0 fw-bold">No. Rawat</label>
                            <input type="text" class="form-control form-control-sm bg-white" name="no_rawat" id="ag_no_rawat" readonly>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <label class="form-label mb-0 fw-bold">Nama Pasien</label>
                            <input type="text" class="form-control form-control-sm bg-white" id="ag_nm_pasien" readonly>
                        </div>
                        <div class="col-lg-2 col-md-4">
                            <label class="form-label mb-0 fw-bold">No. RM</label>
                            <input type="text" class="form-control form-control-sm bg-white" id="ag_no_rkm_medis" readonly>
                        </div>
                        <div class="col-lg-2 col-md-4">
                            <label class="form-label mb-0 fw-bold">Tgl. Lahir / JK</label>
                            <input type="text" class="form-control form-control-sm bg-white" id="ag_tgl_lahir_jk" readonly>
                        </div>
                        <div class="col-lg-2 col-md-4">
                            <label class="form-label mb-0 fw-bold">Dokter DPJP</label>
                            <input type="text" class="form-control form-control-sm bg-white" id="ag_dokter_dpjp" readonly>
                        </div>
                    </div>

                    <div class="alert alert-info p-2 d-none" role="alert" id="alertAsesmenGeriatri">
                        <small><i class="bi bi-info-circle me-1"></i> Data Asesmen Geriatri sudah diisi pada <strong id="ag_tgl_input"></strong></small>
                    </div>

                    <!-- Nav Tabs Navigation -->
                    <ul class="nav nav-tabs nav-justified mb-3" id="tabGeriatri" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active fw-bold" id="tab-perawat-tab" data-bs-toggle="tab" data-bs-target="#tab-perawat" type="button" role="tab">
                                <i class="bi bi-person-badge text-primary me-1"></i> I. Data Awal (Perawat)
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link fw-bold" id="tab-dokter-tab" data-bs-toggle="tab" data-bs-target="#tab-dokter" type="button" role="tab">
                                <i class="bi bi-stethoscope text-danger me-1"></i> II. Data Medis (Dokter)
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link fw-bold" id="tab-sindrom-tab" data-bs-toggle="tab" data-bs-target="#tab-sindrom" type="button" role="tab">
                                <i class="bi bi-clipboard2-pulse text-warning me-1"></i> III. Penapisan Sindrom
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link fw-bold" id="tab-rencana-tab" data-bs-toggle="tab" data-bs-target="#tab-rencana" type="button" role="tab">
                                <i class="bi bi-journal-check text-success me-1"></i> IV. Rencana & Disposisi
                            </button>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content" id="tabGeriatriContent">
                        
                        <!-- TAB 1: DATA AWAL PERAWAT -->
                        <div class="tab-pane fade show active" id="tab-perawat" role="tabpanel">
                            <div class="card mb-3">
                                <div class="card-header bg-light fw-bold"><i class="bi bi-heart-pulse text-danger me-1"></i> Tanda-Tanda Vital (3 Posisi)</div>
                                <div class="card-body">
                                    <div class="row g-2">
                                        <div class="col-md-4 border-end">
                                            <h6 class="fw-bold text-primary">Posisi Baring</h6>
                                            <div class="mb-2">
                                                <label class="form-label small">Tekanan Darah (mmHg)</label>
                                                <input type="text" class="form-control form-control-sm" name="td_baring" placeholder="misal: 120/80">
                                            </div>
                                            <div class="mb-2">
                                                <label class="form-label small">Nadi (x/mnt)</label>
                                                <input type="text" class="form-control form-control-sm" name="nadi_baring" placeholder="80">
                                            </div>
                                        </div>
                                        <div class="col-md-4 border-end">
                                            <h6 class="fw-bold text-primary">Posisi Duduk</h6>
                                            <div class="mb-2">
                                                <label class="form-label small">Tekanan Darah (mmHg)</label>
                                                <input type="text" class="form-control form-control-sm" name="td_duduk" placeholder="misal: 118/78">
                                            </div>
                                            <div class="mb-2">
                                                <label class="form-label small">Nadi (x/mnt)</label>
                                                <input type="text" class="form-control form-control-sm" name="nadi_duduk" placeholder="82">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <h6 class="fw-bold text-primary">Posisi Berdiri</h6>
                                            <div class="mb-2">
                                                <label class="form-label small">Tekanan Darah (mmHg)</label>
                                                <input type="text" class="form-control form-control-sm" name="td_berdiri" placeholder="misal: 115/75">
                                            </div>
                                            <div class="mb-2">
                                                <label class="form-label small">Nadi (x/mnt)</label>
                                                <input type="text" class="form-control form-control-sm" name="nadi_berdiri" placeholder="85">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row g-2">
                                        <div class="col-md-3">
                                            <label class="form-label small">Respirasi (x/mnt)</label>
                                            <input type="text" class="form-control form-control-sm" name="respirasi" placeholder="20">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label small">Suhu (°C)</label>
                                            <input type="text" class="form-control form-control-sm" name="suhu" placeholder="36.5">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label small">Berat Badan (Kg)</label>
                                            <input type="text" class="form-control form-control-sm" name="bb" placeholder="55">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label small">TB / Tinggi Lutut (cm)</label>
                                            <input type="text" class="form-control form-control-sm" name="tb_tl" placeholder="155">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-3">
                                <div class="card-header bg-light fw-bold"><i class="bi bi-emoji-smile text-warning me-1"></i> Psikologi, Sosial & Nutrisi</div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold">Masalah Perkawinan</label>
                                            <select class="form-select form-select-sm" name="masalah_perkawinan">
                                                <option value="Tidak Ada">Tidak Ada</option>
                                                <option value="Ada">Ada</option>
                                            </select>
                                            <input type="text" class="form-control form-control-sm mt-1" name="ket_masalah_perkawinan" placeholder="Detail: cerai / istri baru / simpanan / dll">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold">Mengalami Kekerasan Fisik</label>
                                            <select class="form-select form-select-sm" name="kekerasan_fisik">
                                                <option value="Tidak Ada">Tidak Ada</option>
                                                <option value="Ada">Ada</option>
                                            </select>
                                            <select class="form-select form-select-sm mt-1" name="kekerasan_fisik_detail">
                                                <option value="">-- Pilih Keterangan --</option>
                                                <option value="Mencederai Diri/Orang Lain">Mencederai Diri/Orang Lain</option>
                                                <option value="Pernah">Pernah</option>
                                                <option value="Tidak Pernah">Tidak Pernah</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold">Trauma Kehidupan</label>
                                            <select class="form-select form-select-sm" name="trauma_kehidupan">
                                                <option value="Tidak Ada">Tidak Ada</option>
                                                <option value="Ada">Ada</option>
                                            </select>
                                            <input type="text" class="form-control form-control-sm mt-1" name="ket_trauma_kehidupan" placeholder="Jelaskan trauma kehidupan">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label small fw-bold">Gangguan Tidur</label>
                                            <select class="form-select form-select-sm" name="gangguan_tidur">
                                                <option value="Tidak Ada">Tidak Ada</option>
                                                <option value="Ada">Ada</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label small fw-bold">Konsultasi Psikologi/Psikiater</label>
                                            <select class="form-select form-select-sm" name="konsultasi_psikologi">
                                                <option value="Tidak Ada">Tidak Ada</option>
                                                <option value="Ada">Ada</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label small fw-bold">Status Pernikahan</label>
                                            <select class="form-select form-select-sm" name="status_pernikahan">
                                                <option value="Single">Single</option>
                                                <option value="Menikah">Menikah</option>
                                                <option value="Bercerai">Bercerai</option>
                                                <option value="Janda/Duda">Janda/Duda</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label small fw-bold">Anak</label>
                                            <select class="form-select form-select-sm" name="anak">
                                                <option value="Tidak Ada">Tidak Ada</option>
                                                <option value="Ada">Ada</option>
                                            </select>
                                            <input type="text" class="form-control form-control-sm mt-1" name="jumlah_anak" placeholder="Jumlah anak">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label small fw-bold">Pendidikan Terakhir</label>
                                            <select class="form-select form-select-sm" name="pendidikan_terakhir">
                                                <option value="SD">SD</option>
                                                <option value="SMP">SMP</option>
                                                <option value="SMA">SMA</option>
                                                <option value="Akademi">Akademi</option>
                                                <option value="Sarjana">Sarjana</option>
                                                <option value="Lainnya">Lainnya</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label small fw-bold">Tinggal Bersama</label>
                                            <select class="form-select form-select-sm" name="tinggal_bersama">
                                                <option value="Suami/Istri">Suami/Istri</option>
                                                <option value="Anak">Anak</option>
                                                <option value="Orangtua">Orangtua</option>
                                                <option value="Sendiri">Sendiri</option>
                                                <option value="Lainnya">Lainnya</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold">Penanggung Jawab / Telepon</label>
                                            <div class="input-group input-group-sm">
                                                <input type="text" class="form-control" name="nama_penanggung_jawab" placeholder="Nama PJ">
                                                <input type="text" class="form-control" name="no_telepon_penanggung_jawab" placeholder="No. HP/Telp">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold">Kebiasaan (Merokok / Alkohol / dll)</label>
                                            <input type="text" class="form-control form-control-sm" name="kebiasaan" placeholder="Jenis dan jumlah per hari">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold">Diet Saat Ini</label>
                                            <input type="text" class="form-control form-control-sm" name="diet_saat_ini" placeholder="Makanan biasa / lunak / TKTP / dll">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold">Perubahan BB (6 Bulan Terakhir)</label>
                                            <div class="input-group input-group-sm">
                                                <select class="form-select" name="perubahan_bb" style="max-width: 100px;">
                                                    <option value="Tidak">Tidak</option>
                                                    <option value="Ya">Ya</option>
                                                </select>
                                                <input type="text" class="form-control" name="ket_perubahan_bb" placeholder="Perubahan BB (kg)">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label small fw-bold">Riwayat Alergi</label>
                                            <div class="input-group input-group-sm">
                                                <select class="form-select" name="riwayat_alergi" style="max-width: 100px;">
                                                    <option value="Tidak">Tidak</option>
                                                    <option value="Ya">Ya</option>
                                                </select>
                                                <input type="text" class="form-control" name="nama_alergen" placeholder="Nama alergen (obat/makanan)">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- TAB 2: DATA MEDIS DOKTER -->
                        <div class="tab-pane fade" id="tab-dokter" role="tabpanel">
                            <div class="card mb-3">
                                <div class="card-header bg-light fw-bold"><i class="bi bi-card-text text-primary me-1"></i> Anamnesa & TTV Dokter</div>
                                <div class="card-body">
                                    <div class="mb-2">
                                        <label class="form-label small fw-bold">1. Keluhan Utama</label>
                                        <textarea class="form-control form-control-sm" name="keluhan_utama" rows="2" placeholder="Keluhan utama pasien..."></textarea>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label small fw-bold">2. Riwayat Penyakit Sekarang</label>
                                        <textarea class="form-control form-control-sm" name="rps" rows="2" placeholder="Riwayat penyakit sekarang..."></textarea>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label small fw-bold">3. Riwayat Penyakit Dahulu / Pengobatan</label>
                                        <textarea class="form-control form-control-sm" name="rpd_rpo" rows="2" placeholder="Riwayat penyakit dahulu / rawat inap / pengobatan..."></textarea>
                                    </div>
                                    <div class="row g-2 mt-1">
                                        <div class="col-md-3">
                                            <label class="form-label small fw-bold">GCS (E V M)</label>
                                            <div class="input-group input-group-sm">
                                                <input type="text" class="form-control" name="gcs_e" placeholder="E">
                                                <input type="text" class="form-control" name="gcs_v" placeholder="V">
                                                <input type="text" class="form-control" name="gcs_m" placeholder="M">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label small fw-bold">Tensi Dokter (mmHg)</label>
                                            <input type="text" class="form-control form-control-sm" name="tensi_dokter" placeholder="120/80">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label small fw-bold">Nadi (x/mnt)</label>
                                            <input type="text" class="form-control form-control-sm" name="nadi_dokter" placeholder="80">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label small fw-bold">Respirasi (x/mnt)</label>
                                            <input type="text" class="form-control form-control-sm" name="respirasi_dokter" placeholder="20">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label small fw-bold">Suhu (°C)</label>
                                            <input type="text" class="form-control form-control-sm" name="suhu_dokter" placeholder="36.5">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-3">
                                <div class="card-header bg-light fw-bold"><i class="bi bi-person-check text-success me-1"></i> Pemeriksaan Fisik Terperinci</div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-md-6 border-end">
                                            <h6 class="fw-bold text-dark border-bottom pb-1">Mata & THT</h6>
                                            <div class="row g-2 mb-2">
                                                <div class="col-6">
                                                    <label class="form-label small mb-0">Mata Anemis</label>
                                                    <select class="form-select form-select-sm" name="mata_anemis">
                                                        <option value="-">-</option>
                                                        <option value="+">+</option>
                                                    </select>
                                                </div>
                                                <div class="col-6">
                                                    <label class="form-label small mb-0">Mata Icterus</label>
                                                    <select class="form-select form-select-sm" name="mata_icterus">
                                                        <option value="-">-</option>
                                                        <option value="+">+</option>
                                                    </select>
                                                </div>
                                                <div class="col-6">
                                                    <label class="form-label small mb-0">Reflex Pupil</label>
                                                    <select class="form-select form-select-sm" name="mata_reflex_pupil">
                                                        <option value="+">+</option>
                                                        <option value="-">-</option>
                                                    </select>
                                                </div>
                                                <div class="col-6">
                                                    <label class="form-label small mb-0">Oedema Palpebrae</label>
                                                    <select class="form-select form-select-sm" name="mata_oedema_palpebrae">
                                                        <option value="-">-</option>
                                                        <option value="+">+</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row g-2">
                                                <div class="col-6">
                                                    <label class="form-label small mb-0">THT Tonsil</label>
                                                    <select class="form-select form-select-sm" name="tht_tonsil">
                                                        <option value="-">-</option>
                                                        <option value="+">+</option>
                                                    </select>
                                                </div>
                                                <div class="col-6">
                                                    <label class="form-label small mb-0">THT Pharing</label>
                                                    <select class="form-select form-select-sm" name="tht_pharing">
                                                        <option value="-">-</option>
                                                        <option value="+">+</option>
                                                    </select>
                                                </div>
                                                <div class="col-6">
                                                    <label class="form-label small mb-0">Lidah</label>
                                                    <select class="form-select form-select-sm" name="tht_lidah">
                                                        <option value="-">-</option>
                                                        <option value="+">+</option>
                                                    </select>
                                                </div>
                                                <div class="col-6">
                                                    <label class="form-label small mb-0">Bibir</label>
                                                    <select class="form-select form-select-sm" name="tht_bibir">
                                                        <option value="-">-</option>
                                                        <option value="+">+</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <h6 class="fw-bold text-dark border-bottom pb-1">Leher & Thoraks</h6>
                                            <div class="row g-2 mb-2">
                                                <div class="col-4">
                                                    <label class="form-label small mb-0">Leher JVP</label>
                                                    <select class="form-select form-select-sm" name="leher_jvp">
                                                        <option value="-">-</option>
                                                        <option value="+">+</option>
                                                    </select>
                                                </div>
                                                <div class="col-4">
                                                    <label class="form-label small mb-0">Pembesaran Kelenjar</label>
                                                    <select class="form-select form-select-sm" name="leher_kelenjar">
                                                        <option value="-">-</option>
                                                        <option value="+">+</option>
                                                    </select>
                                                </div>
                                                <div class="col-4">
                                                    <label class="form-label small mb-0">Kaku Kuduk</label>
                                                    <select class="form-select form-select-sm" name="leher_kaku_kuduk">
                                                        <option value="-">-</option>
                                                        <option value="+">+</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-2">
                                                <label class="form-label small mb-0">Thoraks Simetris</label>
                                                <select class="form-select form-select-sm" name="thoraks_simetris">
                                                    <option value="Simetris">Simetris</option>
                                                    <option value="Asimetris">Asimetris</option>
                                                </select>
                                            </div>
                                            <div class="mb-2">
                                                <label class="form-label small mb-0">Cor (S1, S2, Murmur, dll)</label>
                                                <input type="text" class="form-control form-control-sm" name="thoraks_cor" placeholder="S1, S2 reguler, Murmur (-)">
                                            </div>
                                            <div class="mb-2">
                                                <label class="form-label small mb-0">Pulmo (Suara nafas, Ronchi, Wheezing)</label>
                                                <input type="text" class="form-control form-control-sm" name="thoraks_pulmo" placeholder="Vesikuler, Ronchi (-), Wheezing (-)">
                                            </div>
                                        </div>

                                        <div class="col-md-12 border-top pt-2">
                                            <h6 class="fw-bold text-dark border-bottom pb-1">Abdomen & Ekstremitas</h6>
                                            <div class="row g-2">
                                                <div class="col-md-3">
                                                    <label class="form-label small mb-0">Distensi</label>
                                                    <select class="form-select form-select-sm" name="abdomen_distensi">
                                                        <option value="-">-</option>
                                                        <option value="+">+</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label small mb-0">Meteorismus</label>
                                                    <select class="form-select form-select-sm" name="abdomen_meteorismus">
                                                        <option value="-">-</option>
                                                        <option value="+">+</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label small mb-0">Peristaltic</label>
                                                    <select class="form-select form-select-sm" name="abdomen_peristaltic">
                                                        <option value="Normal">Normal</option>
                                                        <option value="Meningkat">Meningkat</option>
                                                        <option value="Menurun">Menurun</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label small mb-0">Ascites</label>
                                                    <select class="form-select form-select-sm" name="abdomen_ascites">
                                                        <option value="-">-</option>
                                                        <option value="+">+</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label small mb-0">Nyeri Tekan / Lokasi</label>
                                                    <div class="input-group input-group-sm">
                                                        <select class="form-select" name="abdomen_nyeri_tekan" style="max-width:70px;">
                                                            <option value="-">-</option>
                                                            <option value="+">+</option>
                                                        </select>
                                                        <input type="text" class="form-control" name="abdomen_lokasi_nyeri" placeholder="Lokasi nyeri tekan">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label small mb-0">Hepar / Lien</label>
                                                    <div class="input-group input-group-sm">
                                                        <input type="text" class="form-control" name="abdomen_hepar" placeholder="Hepar">
                                                        <input type="text" class="form-control" name="abdomen_lien" placeholder="Lien">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label small mb-0">Ekstremitas (Suhu & Oedema)</label>
                                                    <div class="input-group input-group-sm">
                                                        <select class="form-select" name="ekstremitas_suhu" style="max-width:90px;">
                                                            <option value="Hangat">Hangat</option>
                                                            <option value="Dingin">Dingin</option>
                                                        </select>
                                                        <input type="text" class="form-control" name="ekstremitas_oedema" placeholder="Oedema (+/-)">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- TAB 3: ASSESMEN SINDROM GERIATRI (10 PENAPISAN) -->
                        <div class="tab-pane fade" id="tab-sindrom" role="tabpanel">
                            <div class="card mb-3">
                                <div class="card-header bg-light fw-bold"><i class="bi bi-list-check text-warning me-1"></i> 10 Penapisan Sindrom Geriatri</div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold">1. Status Fungsional (Barthel ADL)</label>
                                            <select class="form-select form-select-sm" name="adl_barthel">
                                                <option value="Mandiri (20)">Mandiri (20)</option>
                                                <option value="Ketergantungan Ringan (12-19)">Ketergantungan Ringan (12-19)</option>
                                                <option value="Ketergantungan Sedang (9-11)">Ketergantungan Sedang (9-11)</option>
                                                <option value="Ketergantungan Berat (5-8)">Ketergantungan Berat (5-8)</option>
                                                <option value="Ketergantungan Total (0-4)">Ketergantungan Total (0-4)</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold">Instrumental ADL (IADL)</label>
                                            <select class="form-select form-select-sm" name="iadl">
                                                <option value="Independen (0)">Independen (0)</option>
                                                <option value="Kadang-kadang perlu bantuan (1)">Kadang-kadang perlu bantuan (1)</option>
                                                <option value="Perlu bantuan sepanjang waktu (2)">Perlu bantuan sepanjang waktu (2)</option>
                                                <option value="Tidak beraktivitas/dikerjakan orang lain (3-8)">Tidak beraktivitas/dikerjakan orang lain (3-8)</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold">2. Penapisan ACS (Delirium Akut)</label>
                                            <select class="form-select form-select-sm" name="acs_delirium">
                                                <option value="Tidak">Tidak</option>
                                                <option value="Ya">Ya</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold">3. Status Nutrisi (MNA)</label>
                                            <div class="row g-1">
                                                <div class="col-6">
                                                    <select class="form-select form-select-sm" name="mna_penapisan">
                                                        <option value="Normal (>=12)">Normal (>=12)</option>
                                                        <option value="Kemungkinan Malnutrisi (<=11)">Kemungkinan Malnutrisi (<=11)</option>
                                                    </select>
                                                </div>
                                                <div class="col-6">
                                                    <select class="form-select form-select-sm" name="mna_pengkajian">
                                                        <option value="Risiko Malnutrisi (17-23.5)">Risiko Malnutrisi (17-23.5)</option>
                                                        <option value="Malnutrisi (<17)">Malnutrisi (<17)</option>
                                                    </select>
                                                </div>
                                                <div class="col-6 mt-1">
                                                    <input type="text" class="form-control form-control-sm" name="mna_lingkar_lengan" placeholder="Lingkar lengan atas (cm)">
                                                </div>
                                                <div class="col-6 mt-1">
                                                    <input type="text" class="form-control form-control-sm" name="mna_lingkar_betis" placeholder="Lingkar betis (cm)">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold">4. Penapisan Kognitif (MMSE)</label>
                                            <select class="form-select form-select-sm" name="mmse">
                                                <option value="Normal (24-30)">Normal (24-30)</option>
                                                <option value="Gangguan Kognitif Ringan (MCI) (17-23)">Gangguan Kognitif Ringan (MCI) (17-23)</option>
                                                <option value="Gangguan Kognitif Pasti (<=16)">Gangguan Kognitif Pasti (<=16)</option>
                                                <option value="Belum Dapat Dievaluasi">Belum Dapat Dievaluasi</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold">5. Penapisan Depresi (GDS)</label>
                                            <select class="form-select form-select-sm" name="gds">
                                                <option value="Normal (0-5)">Normal (0-5)</option>
                                                <option value="Risiko Depresi (6-10)">Risiko Depresi (6-10)</option>
                                                <option value="Depresi (>10)">Depresi (>10)</option>
                                                <option value="Belum Dapat Dievaluasi">Belum Dapat Dievaluasi</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold">6. Penapisan Inkontinensia</label>
                                            <input type="text" class="form-control form-control-sm" name="inkontinensia" placeholder="Tidak ada / Ada (Akut/Kronik, jenis...)">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold">7. Prediksi Klinis Wells (DVT & Emboli Paru)</label>
                                            <select class="form-select form-select-sm" name="wells_dvt">
                                                <option value="Risiko Rendah (<1)">Risiko Rendah (<1)</option>
                                                <option value="Risiko Sedang (1-2)">Risiko Sedang (1-2)</option>
                                                <option value="Risiko Tinggi (>3)">Risiko Tinggi (>3)</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold">8. Skala Norton (Ulkus Dekubitus)</label>
                                            <select class="form-select form-select-sm" name="norton_ulkus">
                                                <option value="Risiko Rendah (>14)">Risiko Rendah (>14)</option>
                                                <option value="Risiko Sedang (12-13)">Risiko Sedang (12-13)</option>
                                                <option value="Risiko Tinggi (<12)">Risiko Tinggi (<12)</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold">9. Penapisan Insomnia</label>
                                            <select class="form-select form-select-sm" name="insomnia">
                                                <option value="Tidak Ada">Tidak Ada</option>
                                                <option value="General Insomnia">General Insomnia</option>
                                                <option value="Initial Insomnia">Initial Insomnia</option>
                                                <option value="Middle Insomnia">Middle Insomnia</option>
                                                <option value="Late Insomnia">Late Insomnia</option>
                                            </select>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label small fw-bold">10. Penapisan Lain-lain</label>
                                            <input type="text" class="form-control form-control-sm" name="penapisan_lain" placeholder="Catatan penapisan lainnya...">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-3">
                                <div class="card-header bg-light fw-bold"><i class="bi bi-shield-exclamation text-danger me-1"></i> Sindrom Geriatri & Impairment (ICF)</div>
                                <div class="card-body">
                                    <div class="mb-2">
                                        <label class="form-label small fw-bold">Checklist Sindrom Geriatri Teridentifikasi</label>
                                        <input type="text" class="form-control form-control-sm" name="sindrom_geriatri" placeholder="Contoh: Delirium, Demensia, Insomnia, Instabilitas/fall, Ulkus dekubitus, Immobilisasi, Depresi, Inkontinensia, Malnutrisi">
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label small fw-bold">Impairment (ICF) / Disability / Handicap</label>
                                        <textarea class="form-control form-control-sm" name="impairment_disability" rows="2" placeholder="Keterangan Impairment / Disability / Handicap..."></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- TAB 4: RENCANA & DISPOSISI -->
                        <div class="tab-pane fade" id="tab-rencana" role="tabpanel">
                            <div class="card mb-3">
                                <div class="card-header bg-light fw-bold"><i class="bi bi-journal-text text-success me-1"></i> Hasil Penunjang & Diagnosis</div>
                                <div class="card-body">
                                    <div class="mb-2">
                                        <label class="form-label small fw-bold">Hasil Pemeriksaan Penunjang</label>
                                        <textarea class="form-control form-control-sm" name="pemeriksaan_penunjang" rows="2" placeholder="Hasil Laborat / Radiologi / Penunjang lainnya..."></textarea>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label small fw-bold">Diagnosis (No. ICD X)</label>
                                        <textarea class="form-control form-control-sm" name="diagnosis_icd" rows="2" placeholder="Diagnosis ICD X..."></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-3">
                                <div class="card-header bg-light fw-bold"><i class="bi bi-box-arrow-right text-primary me-1"></i> Rekomendasi, Rencana & Disposisi</div>
                                <div class="card-body">
                                    <div class="row g-2 mb-2">
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold">Rekomendasi</label>
                                            <textarea class="form-control form-control-sm" name="rekomendasi" rows="3" placeholder="Rekomendasi dokter..."></textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold">Rencana Tata Laksana Medis</label>
                                            <textarea class="form-control form-control-sm" name="rencana_medis" rows="3" placeholder="Rencana medis dokter..."></textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label small fw-bold">Rencana Tata Laksana Keperawatan / Profesi Lain</label>
                                            <textarea class="form-control form-control-sm" name="rencana_keperawatan" rows="2" placeholder="Rencana keperawatan / gizi / farmasi / dll..."></textarea>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row g-2">
                                        <div class="col-md-3">
                                            <label class="form-label small fw-bold">Disposisi</label>
                                            <select class="form-select form-select-sm" name="disposisi" id="ag_disposisi">
                                                <option value="Boleh Pulang">Boleh Pulang</option>
                                                <option value="Kontrol Poliklinik">Kontrol Poliklinik</option>
                                                <option value="Dirawat di Ruang">Dirawat di Ruang</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label small fw-bold">Jam Keluar</label>
                                            <input type="time" class="form-control form-control-sm" name="disposisi_jam_keluar">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label small fw-bold">Tanggal Keluar / Kontrol</label>
                                            <input type="date" class="form-control form-control-sm" name="disposisi_tgl_keluar">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label small fw-bold">Ruang Rawat (jika dirawat)</label>
                                            <input type="text" class="form-control form-control-sm" name="disposisi_ruangan" placeholder="Nama ruangan">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><i class="bi bi-x-circle me-1"></i> Batal</button>
                <button type="button" class="btn btn-primary btn-sm" id="btnCetakAsesmenGeriatri" disabled><i class="bi bi-printer me-1"></i> Cetak PDF</button>
                <button type="button" class="btn btn-success btn-sm" id="btnSimpanAsesmenGeriatri"><i class="bi bi-save me-1"></i> Simpan Data</button>
            </div>
        </div>
    </div>
</div>

@push('script')
<script>
    function showModalAsesmenGeriatri(no_rawat) {
        $('#formAsesmenGeriatri')[0].reset();
        $('#alertAsesmenGeriatri').addClass('d-none');
        $('#btnCetakAsesmenGeriatri').attr('disabled', true).off('click');

        $.ajax({
            url: `${url}/asesmen-geriatri`,
            type: 'GET',
            data: { no_rawat: no_rawat },
            success: function(response) {
                $('#modalAsesmenGeriatri').modal('show');
                $('#ag_no_rawat').val(no_rawat);

                if (response && response.no_rawat) {
                    $('#alertAsesmenGeriatri').removeClass('d-none');
                    $('#ag_tgl_input').text(formatTanggal(response.tanggal));

                    // Fill Form Fields
                    $.each(response, function(key, val) {
                        const input = $(`#formAsesmenGeriatri [name="${key}"]`);
                        if (input.length) {
                            input.val(val);
                        }
                    });

                    // Set Patient Banner Info
                    if (response.reg_periksa) {
                        $('#ag_nm_pasien').val(response.reg_periksa.pasien?.nm_pasien || '-');
                        $('#ag_no_rkm_medis').val(response.reg_periksa.pasien?.no_rkm_medis || '-');
                        $('#ag_tgl_lahir_jk').val(`${response.reg_periksa.pasien?.tgl_lahir || '-'} (${response.reg_periksa.pasien?.jk || '-'})`);
                        $('#ag_dokter_dpjp').val(response.reg_periksa.dokter?.nm_dokter || '-');
                    }

                    // Enable Print Button
                    $('#btnCetakAsesmenGeriatri').attr('disabled', false).on('click', function() {
                        window.open(`${url}/asesmen-geriatri/print?no_rawat=${no_rawat}`, '_blank');
                    });
                } else {
                    // Fetch Basic Registration Info if no existing Geriatri record
                    $.ajax({
                        url: `${url}/registrasi/ambil`,
                        type: 'GET',
                        data: { no_rawat: no_rawat },
                        success: function(reg) {
                            if (reg) {
                                $('#ag_nm_pasien').val(reg.pasien?.nm_pasien || '-');
                                $('#ag_no_rkm_medis').val(reg.pasien?.no_rkm_medis || '-');
                                $('#ag_tgl_lahir_jk').val(`${reg.pasien?.tgl_lahir || '-'} (${reg.pasien?.jk || '-'})`);
                                $('#ag_dokter_dpjp').val(reg.dokter?.nm_dokter || '-');
                            }
                        }
                    });
                }
            }
        });
    }

    $('#btnSimpanAsesmenGeriatri').on('click', function() {
        const formData = $('#formAsesmenGeriatri').serialize();

        $.ajax({
            url: `${url}/asesmen-geriatri`,
            type: 'POST',
            data: formData,
            success: function(res) {
                if (res.status === 'success' || res.status === 'success update') {
                    alertSession('Data Asesmen Awal Geriatri berhasil disimpan');
                    $('#modalAsesmenGeriatri').modal('hide');
                } else {
                    alertError(res.message || 'Gagal menyimpan data');
                }
            },
            error: function(err) {
                alertError('Terjadi kesalahan server saat menyimpan data');
            }
        });
    });
</script>
@endpush
