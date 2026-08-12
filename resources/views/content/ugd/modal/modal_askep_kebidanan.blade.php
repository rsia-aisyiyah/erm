<!-- Modal Asesmen Keperawatan Kebidanan UGD -->
<div class="modal fade" id="modalAskepKebidananUgd" tabindex="-1" aria-labelledby="modalAskepKebidananUgdLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-fullscreen modal-dialog-scrollable">
        <div class="modal-content">
            
            <!-- Modal Header -->
            <div class="modal-header bg-primary text-white py-2 px-3">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-gender-female fs-4 text-warning"></i>
                    <div>
                        <h5 class="modal-title fs-6 fw-bold mb-0" id="modalAskepKebidananUgdLabel">
                            Asesmen Awal Keperawatan Kebidanan &amp; Kandungan (UGD)
                        </h5>
                        <small class="text-white-50">Pengkajian klinis keperawatan obstetri &amp; ginekologi gawat darurat</small>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span id="badgeStatusAskepKebidananUgd" class="badge bg-light text-primary px-2 py-1">
                        <i class="bi bi-file-earmark-plus me-1"></i> Data Baru
                    </span>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>

            <!-- Patient Info Header (Readonly Banner) -->
            <div class="bg-light border-bottom px-3 py-2">
                <div class="row g-2 align-items-center" style="font-size: 11.5px;">
                    <div class="col-md-2 col-6">
                        <span class="text-muted d-block">No. Rawat:</span>
                        <strong id="kebidanan_info_no_rawat" class="text-primary">-</strong>
                    </div>
                    <div class="col-md-2 col-6">
                        <span class="text-muted d-block">No. Rekam Medis:</span>
                        <strong id="kebidanan_info_no_rkm_medis">-</strong>
                    </div>
                    <div class="col-md-3 col-12">
                        <span class="text-muted d-block">Nama Pasien:</span>
                        <strong id="kebidanan_info_nm_pasien" class="text-dark fs-6">-</strong>
                    </div>
                    <div class="col-md-2 col-6">
                        <span class="text-muted d-block">Tgl Lahir / Umur:</span>
                        <span id="kebidanan_info_tgl_lahir">-</span>
                    </div>
                    <div class="col-md-3 col-6">
                        <span class="text-muted d-block">Dokter DPJP / Penjab:</span>
                        <span id="kebidanan_info_dokter_penjab" class="text-truncate d-inline-block" style="max-width: 100%;">-</span>
                    </div>
                </div>
            </div>

            <!-- Modal Body Form -->
            <div class="modal-body p-3 bg-light">
                <form id="formAskepKebidananUgd" autocomplete="off">
                    <input type="hidden" id="kebidanan_no_rawat" name="no_rawat">
                    <input type="hidden" id="kebidanan_no_rkm_medis" name="no_rkm_medis">

                    <div class="row g-3">
                        
                        <!-- ==================== KOLOM KIRI ==================== -->
                        <div class="col-lg-6">

                            <!-- I. KEADAAN UMUM & TTV -->
                            <div class="card shadow-sm border-0 mb-3">
                                <div class="card-header bg-white fw-bold py-2 border-bottom text-primary d-flex align-items-center justify-content-between">
                                    <span><i class="bi bi-heart-pulse me-1 text-danger"></i> I. Keadaan Umum &amp; Tanda Vital</span>
                                </div>
                                <div class="card-body p-3">
                                    <div class="row g-2">
                                        <div class="col-md-5">
                                            <label class="form-label small fw-semibold mb-1">Bidan / Petugas Pengkaji <span class="text-danger">*</span></label>
                                            <select id="kebidanan_nip" name="nip" class="form-select form-select-sm" style="width: 100%;"></select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label small fw-semibold mb-1">Anamnesis <span class="text-danger">*</span></label>
                                            <select id="kebidanan_informasi" name="informasi" class="form-select form-select-sm">
                                                <option value="Autoanamnesis">Autoanamnesis</option>
                                                <option value="Alloanamnesis">Alloanamnesis</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label small fw-semibold mb-1">Tanggal &amp; Jam <span class="text-danger">*</span></label>
                                            <input type="datetime-local" id="kebidanan_tanggal" name="tanggal" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-md-3 col-6">
                                            <label class="form-label small fw-semibold mb-1">TD (mmHg)</label>
                                            <div class="input-group input-group-sm">
                                                <input type="text" id="kebidanan_td" name="td" class="form-control form-control-sm" placeholder="120/80" value="120/80">
                                                <span class="input-group-text">mmHg</span>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-6">
                                            <label class="form-label small fw-semibold mb-1">Nadi (x/m)</label>
                                            <div class="input-group input-group-sm">
                                                <input type="text" id="kebidanan_nadi" name="nadi" class="form-control form-control-sm" placeholder="80" value="80">
                                                <span class="input-group-text">x/m</span>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-6">
                                            <label class="form-label small fw-semibold mb-1">RR (x/m)</label>
                                            <div class="input-group input-group-sm">
                                                <input type="text" id="kebidanan_rr" name="rr" class="form-control form-control-sm" placeholder="20" value="20">
                                                <span class="input-group-text">x/m</span>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-6">
                                            <label class="form-label small fw-semibold mb-1">Suhu (°C)</label>
                                            <div class="input-group input-group-sm">
                                                <input type="text" id="kebidanan_suhu" name="suhu" class="form-control form-control-sm" placeholder="36.5" value="36.5">
                                                <span class="input-group-text">°C</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <label class="form-label small fw-semibold mb-1">GCS (E,V,M)</label>
                                            <input type="text" id="kebidanan_gcs" name="gcs" class="form-control form-control-sm" placeholder="15" value="15">
                                        </div>

                                        <div class="col-md-3 col-6">
                                            <label class="form-label small fw-semibold mb-1">BB (Kg)</label>
                                            <div class="input-group input-group-sm">
                                                <input type="number" step="0.1" id="kebidanan_bb" name="bb" class="form-control form-control-sm" placeholder="0" value="0">
                                                <span class="input-group-text">Kg</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-6">
                                            <label class="form-label small fw-semibold mb-1">TB (cm)</label>
                                            <div class="input-group input-group-sm">
                                                <input type="number" step="0.1" id="kebidanan_tb" name="tb" class="form-control form-control-sm" placeholder="0" value="0">
                                                <span class="input-group-text">cm</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-6">
                                            <label class="form-label small fw-semibold mb-1">LILA (cm)</label>
                                            <div class="input-group input-group-sm">
                                                <input type="text" id="kebidanan_lila" name="lila" class="form-control form-control-sm" placeholder="-" value="-">
                                                <span class="input-group-text">cm</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-6">
                                            <label class="form-label small fw-semibold mb-1">BMI (Kg/M²)</label>
                                            <div class="input-group input-group-sm">
                                                <input type="text" id="kebidanan_bmi" name="bmi" class="form-control form-control-sm bg-light" placeholder="-" value="-" readonly>
                                                <span class="input-group-text">Kg/M²</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- II. PEMERIKSAAN KEBIDANAN -->
                            <div class="card shadow-sm border-0 mb-3">
                                <div class="card-header bg-white fw-bold py-2 border-bottom text-primary">
                                    <i class="bi bi-person-heart me-1 text-pink"></i> II. Pemeriksaan Kebidanan
                                </div>
                                <div class="card-body p-3">
                                    <div class="row g-2">
                                        <div class="col-md-3 col-6">
                                            <label class="form-label small fw-semibold mb-1">TFU</label>
                                            <div class="input-group input-group-sm">
                                                <input type="text" id="kebidanan_tfu" name="tfu" class="form-control form-control-sm" value="-">
                                                <span class="input-group-text">cm</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-6">
                                            <label class="form-label small fw-semibold mb-1">TBJ</label>
                                            <input type="text" id="kebidanan_tbj" name="tbj" class="form-control form-control-sm" value="-">
                                        </div>
                                        <div class="col-md-2 col-4">
                                            <label class="form-label small fw-semibold mb-1">Letak</label>
                                            <input type="text" id="kebidanan_letak" name="letak" class="form-control form-control-sm" value="-">
                                        </div>
                                        <div class="col-md-2 col-4">
                                            <label class="form-label small fw-semibold mb-1">Presentasi</label>
                                            <input type="text" id="kebidanan_presentasi" name="presentasi" class="form-control form-control-sm" value="-">
                                        </div>
                                        <div class="col-md-2 col-4">
                                            <label class="form-label small fw-semibold mb-1">Penurunan</label>
                                            <input type="text" id="kebidanan_penurunan" name="penurunan" class="form-control form-control-sm" value="-">
                                        </div>

                                        <!-- HIS -->
                                        <div class="col-md-4 col-6">
                                            <label class="form-label small fw-semibold mb-1">Kontraksi / HIS</label>
                                            <div class="input-group input-group-sm">
                                                <input type="text" id="kebidanan_his" name="his" class="form-control form-control-sm" value="-">
                                                <span class="input-group-text">x/10'</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-6">
                                            <label class="form-label small fw-semibold mb-1">Kekuatan</label>
                                            <input type="text" id="kebidanan_kekuatan" name="kekuatan" class="form-control form-control-sm" value="-">
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <label class="form-label small fw-semibold mb-1">Lamanya</label>
                                            <div class="input-group input-group-sm">
                                                <input type="text" id="kebidanan_lamanya" name="lamanya" class="form-control form-control-sm" value="-">
                                                <span class="input-group-text">detik</span>
                                            </div>
                                        </div>

                                        <!-- BJJ -->
                                        <div class="col-md-6">
                                            <label class="form-label small fw-semibold mb-1">Denyut Jantung Janin (BJJ)</label>
                                            <div class="input-group input-group-sm">
                                                <input type="text" id="kebidanan_bjj" name="bjj" class="form-control form-control-sm" value="-">
                                                <span class="input-group-text">/m</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small fw-semibold mb-1">Keteraturan BJJ</label>
                                            <select id="kebidanan_ket_bjj" name="ket_bjj" class="form-select form-select-sm">
                                                <option value="Teratur">Teratur</option>
                                                <option value="Tidak Teratur">Tidak Teratur</option>
                                            </select>
                                        </div>

                                        <!-- Pemeriksaan Dalam -->
                                        <div class="col-12"><hr class="my-2"></div>
                                        <div class="col-md-3 col-6">
                                            <label class="form-label small fw-semibold mb-1">Portio</label>
                                            <input type="text" id="kebidanan_portio" name="portio" class="form-control form-control-sm" value="-">
                                        </div>
                                        <div class="col-md-3 col-6">
                                            <label class="form-label small fw-semibold mb-1">Pembukaan Serviks</label>
                                            <div class="input-group input-group-sm">
                                                <input type="text" id="kebidanan_serviks" name="serviks" class="form-control form-control-sm" value="-">
                                                <span class="input-group-text">cm</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-6">
                                            <label class="form-label small fw-semibold mb-1">Ketuban</label>
                                            <input type="text" id="kebidanan_ketuban" name="ketuban" class="form-control form-control-sm" value="-">
                                        </div>
                                        <div class="col-md-3 col-6">
                                            <label class="form-label small fw-semibold mb-1">Hodge</label>
                                            <input type="text" id="kebidanan_hodge" name="hodge" class="form-control form-control-sm" value="-">
                                        </div>

                                        <!-- Penunjang Kebidanan -->
                                        <div class="col-12"><h6 class="small fw-bold text-muted mt-2 mb-1">Pemeriksaan Penunjang Kebidanan:</h6></div>
                                        <div class="col-md-6">
                                            <label class="form-label small mb-0">Inspekulo:</label>
                                            <div class="input-group input-group-sm">
                                                <select id="kebidanan_inspekulo" name="inspekulo" class="form-select form-select-sm" style="max-width: 110px;">
                                                    <option value="Tidak">Tidak</option>
                                                    <option value="Dilakukan">Dilakukan</option>
                                                </select>
                                                <input type="text" id="kebidanan_ket_inspekulo" name="ket_inspekulo" class="form-control form-control-sm" placeholder="Hasil Inspekulo" value="-">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small mb-0">CTG:</label>
                                            <div class="input-group input-group-sm">
                                                <select id="kebidanan_ctg" name="ctg" class="form-select form-select-sm" style="max-width: 110px;">
                                                    <option value="Tidak">Tidak</option>
                                                    <option value="Dilakukan">Dilakukan</option>
                                                </select>
                                                <input type="text" id="kebidanan_ket_ctg" name="ket_ctg" class="form-control form-control-sm" placeholder="Hasil CTG" value="-">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small mb-0">USG:</label>
                                            <div class="input-group input-group-sm">
                                                <select id="kebidanan_usg" name="usg" class="form-select form-select-sm" style="max-width: 110px;">
                                                    <option value="Tidak">Tidak</option>
                                                    <option value="Dilakukan">Dilakukan</option>
                                                </select>
                                                <input type="text" id="kebidanan_ket_usg" name="ket_usg" class="form-control form-control-sm" placeholder="Hasil USG" value="-">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small mb-0">Laboratorium:</label>
                                            <div class="input-group input-group-sm">
                                                <select id="kebidanan_lab" name="lab" class="form-select form-select-sm" style="max-width: 110px;">
                                                    <option value="Tidak">Tidak</option>
                                                    <option value="Dilakukan">Dilakukan</option>
                                                </select>
                                                <input type="text" id="kebidanan_ket_lab" name="ket_lab" class="form-control form-control-sm" placeholder="Hasil Lab" value="-">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small mb-0">Lakmus:</label>
                                            <div class="input-group input-group-sm">
                                                <select id="kebidanan_lakmus" name="lakmus" class="form-select form-select-sm" style="max-width: 110px;">
                                                    <option value="Tidak">Tidak</option>
                                                    <option value="Dilakukan">Dilakukan</option>
                                                </select>
                                                <input type="text" id="kebidanan_ket_lakmus" name="ket_lakmus" class="form-control form-control-sm" placeholder="Hasil Lakmus" value="-">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small mb-0">Evaluasi Panggul:</label>
                                            <select id="kebidanan_panggul" name="panggul" class="form-select form-select-sm">
                                                <option value="Tidak Dilakukan Pemeriksaan">Tidak Dilakukan Pemeriksaan</option>
                                                <option value="Luas">Luas</option>
                                                <option value="Sedang">Sedang</option>
                                                <option value="Sempit">Sempit</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- III. RIWAYAT KESEHATAN, REPRODUKSI & KEHAMILAN -->
                            <div class="card shadow-sm border-0 mb-3">
                                <div class="card-header bg-white fw-bold py-2 border-bottom text-primary">
                                    <i class="bi bi-clock-history me-1 text-info"></i> III. Riwayat Kesehatan, Reproduksi &amp; Obstetri
                                </div>
                                <div class="card-body p-3">
                                    <!-- Keluhan Utama -->
                                    <div class="mb-3">
                                        <label class="form-label small fw-semibold mb-1">Keluhan Utama / Alasan Masuk UGD <span class="text-danger">*</span></label>
                                        <textarea id="kebidanan_keluhan_utama" name="keluhan_utama" rows="2" class="form-control form-control-sm" placeholder="Keluhan utama pasien saat tiba di UGD">-</textarea>
                                    </div>

                                    <!-- Menstruasi -->
                                    <h6 class="small fw-bold text-muted border-bottom pb-1 mb-2">Riwayat Menstruasi:</h6>
                                    <div class="row g-2 mb-3">
                                        <div class="col-md-2 col-4">
                                            <label class="form-label small mb-0">Menarche</label>
                                            <div class="input-group input-group-sm">
                                                <input type="text" id="kebidanan_umur" name="umur" class="form-control form-control-sm" value="-">
                                                <span class="input-group-text">th</span>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-4">
                                            <label class="form-label small mb-0">Lama</label>
                                            <div class="input-group input-group-sm">
                                                <input type="text" id="kebidanan_lama" name="lama" class="form-control form-control-sm" value="-">
                                                <span class="input-group-text">hr</span>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-4">
                                            <label class="form-label small mb-0">Banyaknya</label>
                                            <input type="text" id="kebidanan_banyaknya" name="banyaknya" class="form-control form-control-sm" value="-">
                                        </div>
                                        <div class="col-md-3 col-6">
                                            <label class="form-label small mb-0">Haid Terakhir</label>
                                            <input type="text" id="kebidanan_haid" name="haid" class="form-control form-control-sm" value="-">
                                        </div>
                                        <div class="col-md-3 col-6">
                                            <label class="form-label small mb-0">Siklus Haid</label>
                                            <div class="input-group input-group-sm">
                                                <input type="text" id="kebidanan_siklus" name="siklus" class="form-control form-control-sm" value="28">
                                                <span class="input-group-text">hr</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small mb-0">Keteraturan Siklus:</label>
                                            <select id="kebidanan_ket_siklus" name="ket_siklus" class="form-select form-select-sm">
                                                <option value="Teratur">Teratur</option>
                                                <option value="Tidak Teratur">Tidak Teratur</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small mb-0">Keluhan Menstruasi:</label>
                                            <select id="kebidanan_ket_siklus1" name="ket_siklus1" class="form-select form-select-sm">
                                                <option value="Tidak Ada Masalah">Tidak Ada Masalah</option>
                                                <option value="Dismenorhea">Dismenorhea</option>
                                                <option value="Spotting">Spotting</option>
                                                <option value="Menorhagia">Menorhagia</option>
                                                <option value="PMS">PMS</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Perkawinan -->
                                    <h6 class="small fw-bold text-muted border-bottom pb-1 mb-2">Riwayat Perkawinan:</h6>
                                    <div class="row g-2 mb-3">
                                        <div class="col-md-4">
                                            <label class="form-label small mb-0">Status Kawin</label>
                                            <select id="kebidanan_status" name="status" class="form-select form-select-sm">
                                                <option value="Menikah">Menikah</option>
                                                <option value="Tidak / Belum Menikah">Tidak / Belum Menikah</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label small mb-0">Berapa Kali</label>
                                            <div class="input-group input-group-sm">
                                                <input type="text" id="kebidanan_kali" name="kali" class="form-control form-control-sm" value="1">
                                                <span class="input-group-text">x</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label small mb-0">Usia Nikah I</label>
                                            <div class="input-group input-group-sm">
                                                <input type="text" id="kebidanan_usia1" name="usia1" class="form-control form-control-sm" value="-">
                                                <span class="input-group-text">th</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label small mb-0">Status Nikah I</label>
                                            <select id="kebidanan_ket1" name="ket1" class="form-select form-select-sm">
                                                <option value="Masih Menikah">Masih Menikah</option>
                                                <option value="-">-</option>
                                                <option value="Cerai">Cerai</option>
                                                <option value="Meninggal">Meninggal</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label small mb-0">Usia Nikah II</label>
                                            <input type="text" id="kebidanan_usia2" name="usia2" class="form-control form-control-sm" value="-">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label small mb-0">Status Nikah II</label>
                                            <select id="kebidanan_ket2" name="ket2" class="form-select form-select-sm">
                                                <option value="-">-</option>
                                                <option value="Masih Menikah">Masih Menikah</option>
                                                <option value="Cerai">Cerai</option>
                                                <option value="Meninggal">Meninggal</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label small mb-0">Usia Nikah III</label>
                                            <input type="text" id="kebidanan_usia3" name="usia3" class="form-control form-control-sm" value="-">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label small mb-0">Status Nikah III</label>
                                            <select id="kebidanan_ket3" name="ket3" class="form-select form-select-sm">
                                                <option value="-">-</option>
                                                <option value="Masih Menikah">Masih Menikah</option>
                                                <option value="Cerai">Cerai</option>
                                                <option value="Meninggal">Meninggal</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Kehamilan Sekarang -->
                                    <h6 class="small fw-bold text-muted border-bottom pb-1 mb-2">Riwayat Kehamilan Sekarang &amp; Obstetri:</h6>
                                    <div class="row g-2 mb-3">
                                        <div class="col-md-4">
                                            <label class="form-label small mb-0">HPHT</label>
                                            <input type="date" id="kebidanan_hpht" name="hpht" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label small mb-0">Usia Kehamilan</label>
                                            <div class="input-group input-group-sm">
                                                <input type="text" id="kebidanan_usia_kehamilan" name="usia_kehamilan" class="form-control form-control-sm" value="-">
                                                <span class="input-group-text">mg</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label small mb-0">Tafsiran Persalinan (TP/HPL)</label>
                                            <input type="date" id="kebidanan_tp" name="tp" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-md-2 col-3">
                                            <label class="form-label small mb-0">Gravida (G)</label>
                                            <input type="text" id="kebidanan_g" name="g" class="form-control form-control-sm" value="0">
                                        </div>
                                        <div class="col-md-2 col-3">
                                            <label class="form-label small mb-0">Para (P)</label>
                                            <input type="text" id="kebidanan_p" name="p" class="form-control form-control-sm" value="0">
                                        </div>
                                        <div class="col-md-2 col-3">
                                            <label class="form-label small mb-0">Abortus (A)</label>
                                            <input type="text" id="kebidanan_a" name="a" class="form-control form-control-sm" value="0">
                                        </div>
                                        <div class="col-md-2 col-3">
                                            <label class="form-label small mb-0">Hidup</label>
                                            <input type="text" id="kebidanan_hidup" name="hidup" class="form-control form-control-sm" value="0">
                                        </div>
                                        <div class="col-md-2 col-6">
                                            <label class="form-label small mb-0">Imunisasi TT</label>
                                            <select id="kebidanan_imunisasi" name="imunisasi" class="form-select form-select-sm">
                                                <option value="Tidak">Tidak</option>
                                                <option value="Ya">Ya</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 col-6">
                                            <label class="form-label small mb-0">Jumlah TT</label>
                                            <div class="input-group input-group-sm">
                                                <input type="text" id="kebidanan_ket_imunisasi" name="ket_imunisasi" class="form-control form-control-sm" value="-">
                                                <span class="input-group-text">x</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Riwayat Persalinan yang Lalu (Tabel) -->
                                    <div class="d-flex align-items-center justify-content-between border-bottom pb-1 mb-2">
                                        <h6 class="small fw-bold text-muted mb-0">Riwayat Persalinan yang Lalu:</h6>
                                        <button type="button" class="btn btn-outline-primary btn-sm py-0 px-2" style="font-size: 11px;" onclick="showModalRiwayatPersalinanUgd()">
                                            <i class="bi bi-plus-circle me-1"></i> Tambah Riwayat Partus
                                        </button>
                                    </div>
                                    <div class="table-responsive border rounded bg-white mb-2" style="max-height: 150px;">
                                        <table class="table table-bordered table-sm table-striped mb-0 tbRiwayatPersalinanPasienUgd" style="font-size: 11px;">
                                            <thead class="table-light">
                                                <tr>
                                                    <th width="5%" class="text-center">#</th>
                                                    <th>Tgl/Thn</th>
                                                    <th>Tempat</th>
                                                    <th>Usia Hamil</th>
                                                    <th>Jenis Partus</th>
                                                    <th>JK</th>
                                                    <th>Penolong</th>
                                                    <th>Penyulit</th>
                                                    <th>Keadaan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr><td colspan="9" class="text-center text-muted py-2">- Tidak Ada Data Riwayat Partus -</td></tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- Riwayat KB & Ginekologi -->
                                    <h6 class="small fw-bold text-muted border-bottom pb-1 mb-2 mt-3">Riwayat KB, Ginekologi &amp; Kebiasaan:</h6>
                                    <div class="row g-2">
                                        <div class="col-md-3">
                                            <label class="form-label small mb-0">Jenis KB</label>
                                            <select id="kebidanan_kb" name="kb" class="form-select form-select-sm">
                                                <option value="Belum Pernah">Belum Pernah</option>
                                                <option value="Suntik">Suntik</option>
                                                <option value="Pil">Pil</option>
                                                <option value="AKDR">AKDR</option>
                                                <option value="MOW">MOW</option>
                                                <option value="Implant">Implant</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label small mb-0">Lama Pakai</label>
                                            <input type="text" id="kebidanan_ket_kb" name="ket_kb" class="form-control form-control-sm" value="-">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label small mb-0">Komplikasi KB</label>
                                            <select id="kebidanan_komplikasi" name="komplikasi" class="form-select form-select-sm">
                                                <option value="Tidak Ada">Tidak Ada</option>
                                                <option value="Ada">Ada</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label small mb-0">Ket. Komplikasi</label>
                                            <input type="text" id="kebidanan_ket_komplikasi" name="ket_komplikasi" class="form-control form-control-sm" value="-">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label small mb-0">Berhenti KB Sejak</label>
                                            <input type="text" id="kebidanan_berhenti" name="berhenti" class="form-control form-control-sm" value="-">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label small mb-0">Alasan Berhenti</label>
                                            <input type="text" id="kebidanan_alasan" name="alasan" class="form-control form-control-sm" value="-">
                                        </div>
                                        <div class="col-md-5">
                                            <label class="form-label small mb-0">Riwayat Ginekologi</label>
                                            <select id="kebidanan_ginekologi" name="ginekologi" class="form-select form-select-sm">
                                                <option value="Tidak Ada">Tidak Ada</option>
                                                <option value="Infertilitas">Infertilitas</option>
                                                <option value="Infeksi Virus">Infeksi Virus</option>
                                                <option value="PMS">PMS</option>
                                                <option value="Cervisitis Kronis">Cervisitis Kronis</option>
                                                <option value="Endometriosis">Endometriosis</option>
                                                <option value="Mioma">Mioma</option>
                                                <option value="Polip Cervix">Polip Cervix</option>
                                            </select>
                                        </div>

                                        <!-- Kebiasaan -->
                                        <div class="col-md-4">
                                            <label class="form-label small mb-0">Konsumsi Obat/Jamu</label>
                                            <select id="kebidanan_kebiasaan" name="kebiasaan" class="form-select form-select-sm">
                                                <option value="-">-</option>
                                                <option value="Obat Obatan">Obat Obatan</option>
                                                <option value="Vitamin">Vitamin</option>
                                                <option value="Jamu Jamuan">Jamu Jamuan</option>
                                            </select>
                                        </div>
                                        <div class="col-md-8">
                                            <label class="form-label small mb-0">Ket. Konsumsi</label>
                                            <input type="text" id="kebidanan_ket_kebiasaan" name="ket_kebiasaan" class="form-control form-control-sm" value="-">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label small mb-0">Merokok</label>
                                            <div class="input-group input-group-sm">
                                                <select id="kebidanan_kebiasaan1" name="kebiasaan1" class="form-select form-select-sm" style="max-width: 90px;">
                                                    <option value="Tidak">Tidak</option>
                                                    <option value="Ya">Ya</option>
                                                </select>
                                                <input type="text" id="kebidanan_ket_kebiasaan1" name="ket_kebiasaan1" class="form-control form-control-sm" placeholder="btg/hari" value="-">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label small mb-0">Alkohol</label>
                                            <div class="input-group input-group-sm">
                                                <select id="kebidanan_kebiasaan2" name="kebiasaan2" class="form-select form-select-sm" style="max-width: 90px;">
                                                    <option value="Tidak">Tidak</option>
                                                    <option value="Ya">Ya</option>
                                                </select>
                                                <input type="text" id="kebidanan_ket_kebiasaan2" name="ket_kebiasaan2" class="form-control form-control-sm" placeholder="gls/hari" value="-">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label small mb-0">Narkoba/Obat Tidur</label>
                                            <select id="kebidanan_kebiasaan3" name="kebiasaan3" class="form-select form-select-sm">
                                                <option value="Tidak">Tidak</option>
                                                <option value="Ya">Ya</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /KOLOM KIRI -->


                        <!-- ==================== KOLOM KANAN ==================== -->
                        <div class="col-lg-6">

                            <!-- IV. STATUS FUNGSIONAL, PSIKOSOSIAL & RISIKO JATUH -->
                            <div class="card shadow-sm border-0 mb-3">
                                <div class="card-header bg-white fw-bold py-2 border-bottom text-primary">
                                    <i class="bi bi-person-walking me-1 text-success"></i> IV. Status Fungsional, Psikososial &amp; Risiko Jatuh
                                </div>
                                <div class="card-body p-3">
                                    <!-- Fungsional -->
                                    <div class="row g-2 mb-3">
                                        <div class="col-md-4">
                                            <label class="form-label small mb-0">Alat Bantu Jalan</label>
                                            <div class="input-group input-group-sm">
                                                <select id="kebidanan_alat_bantu" name="alat_bantu" class="form-select form-select-sm" style="max-width: 85px;">
                                                    <option value="Tidak">Tidak</option>
                                                    <option value="Ya">Ya</option>
                                                </select>
                                                <input type="text" id="kebidanan_ket_bantu" name="ket_bantu" class="form-control form-control-sm" placeholder="Jenis Alat" value="-">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label small mb-0">Prothesa / Tiruan</label>
                                            <div class="input-group input-group-sm">
                                                <select id="kebidanan_prothesa" name="prothesa" class="form-select form-select-sm" style="max-width: 85px;">
                                                    <option value="Tidak">Tidak</option>
                                                    <option value="Ya">Ya</option>
                                                </select>
                                                <input type="text" id="kebidanan_ket_pro" name="ket_pro" class="form-control form-control-sm" placeholder="Jenis Prothesa" value="-">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label small mb-0">Aktivitas (ADL)</label>
                                            <select id="kebidanan_adl" name="adl" class="form-select form-select-sm">
                                                <option value="Mandiri">Mandiri</option>
                                                <option value="Dibantu">Dibantu</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Psikososial -->
                                    <h6 class="small fw-bold text-muted border-bottom pb-1 mb-2">Psikososial, Spiritual &amp; Ekonomi:</h6>
                                    <div class="row g-2 mb-3">
                                        <div class="col-md-4">
                                            <label class="form-label small mb-0">Status Psikologis</label>
                                            <select id="kebidanan_status_psiko" name="status_psiko" class="form-select form-select-sm">
                                                <option value="Tenang">Tenang</option>
                                                <option value="Cemas">Cemas</option>
                                                <option value="Takut">Takut</option>
                                                <option value="Marah">Marah</option>
                                                <option value="Sedih">Sedih</option>
                                                <option value="Lain-lain">Lain-lain</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label small mb-0">Ket. Psikologis</label>
                                            <input type="text" id="kebidanan_ket_psiko" name="ket_psiko" class="form-control form-control-sm" value="-">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label small mb-0">Hubungan Keluarga</label>
                                            <select id="kebidanan_hub_keluarga" name="hub_keluarga" class="form-select form-select-sm">
                                                <option value="Baik">Baik</option>
                                                <option value="Tidak Baik">Tidak Baik</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label small mb-0">Tinggal Bersama</label>
                                            <div class="input-group input-group-sm">
                                                <select id="kebidanan_tinggal_dengan" name="tinggal_dengan" class="form-select form-select-sm" style="max-width: 120px;">
                                                    <option value="Suami / Istri">Suami / Istri</option>
                                                    <option value="Orang Tua">Orang Tua</option>
                                                    <option value="Sendiri">Sendiri</option>
                                                    <option value="Lainnya">Lainnya</option>
                                                </select>
                                                <input type="text" id="kebidanan_ket_tinggal" name="ket_tinggal" class="form-control form-control-sm" placeholder="Keterangan" value="-">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label small mb-0">Status Ekonomi</label>
                                            <select id="kebidanan_ekonomi" name="ekonomi" class="form-select form-select-sm">
                                                <option value="Baik">Baik</option>
                                                <option value="Cukup">Cukup</option>
                                                <option value="Kurang">Kurang</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label small mb-0">Nilai Budaya</label>
                                            <select id="kebidanan_budaya" name="budaya" class="form-select form-select-sm">
                                                <option value="Tidak Ada">Tidak Ada</option>
                                                <option value="Ada">Ada</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small mb-0">Ket. Nilai Budaya</label>
                                            <input type="text" id="kebidanan_ket_budaya" name="ket_budaya" class="form-control form-control-sm" value="-">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small mb-0">Edukasi Diberikan Kepada</label>
                                            <div class="input-group input-group-sm">
                                                <select id="kebidanan_edukasi" name="edukasi" class="form-select form-select-sm" style="max-width: 100px;">
                                                    <option value="Pasien">Pasien</option>
                                                    <option value="Keluarga">Keluarga</option>
                                                </select>
                                                <input type="text" id="kebidanan_ket_edukasi" name="ket_edukasi" class="form-control form-control-sm" placeholder="Keterangan" value="-">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Risiko Jatuh -->
                                    <h6 class="small fw-bold text-muted border-bottom pb-1 mb-2">Penilaian Risiko Jatuh (Metode Get Up and Go):</h6>
                                    <div class="row g-2">
                                        <div class="col-md-6">
                                            <label class="form-label small mb-0">a. Perlu bantuan saat duduk ke berdiri?</label>
                                            <select id="kebidanan_berjalan_a" name="berjalan_a" class="form-select form-select-sm">
                                                <option value="Tidak">Tidak</option>
                                                <option value="Ya">Ya</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small mb-0">b. Kesulitan berjalan / sempoyongan?</label>
                                            <select id="kebidanan_berjalan_b" name="berjalan_b" class="form-select form-select-sm">
                                                <option value="Tidak">Tidak</option>
                                                <option value="Ya">Ya</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small mb-0">c. Memegang kursi / meja saat berjalan?</label>
                                            <select id="kebidanan_berjalan_c" name="berjalan_c" class="form-select form-select-sm">
                                                <option value="Tidak">Tidak</option>
                                                <option value="Ya">Ya</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small mb-0">Tingkat Risiko:</label>
                                            <input type="text" id="kebidanan_hasil" name="hasil" class="form-control form-control-sm bg-light fw-bold text-success" value="Tidak beresiko (tidak ditemukan a dan b)" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small mb-0">Lapor Dokter:</label>
                                            <select id="kebidanan_lapor" name="lapor" class="form-select form-select-sm">
                                                <option value="Tidak">Tidak</option>
                                                <option value="Ya">Ya</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small mb-0">Jam Lapor Dokter:</label>
                                            <input type="text" id="kebidanan_ket_lapor" name="ket_lapor" class="form-control form-control-sm" value="-">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- V. SKRINING GIZI & SKRINING NYERI -->
                            <div class="card shadow-sm border-0 mb-3">
                                <div class="card-header bg-white fw-bold py-2 border-bottom text-primary">
                                    <i class="bi bi-egg-fried me-1 text-warning"></i> V. Skrining Gizi (MST) &amp; Pengkajian Nyeri
                                </div>
                                <div class="card-body p-3">
                                    <!-- Skrining Gizi -->
                                    <div class="row g-2 mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label small mb-0">1. Penurunan BB dlm 6 bln terakhir:</label>
                                            <select id="kebidanan_sg1" name="sg1" class="form-select form-select-sm">
                                                <option value="Tidak Ada" data-nilai="0">Tidak Ada (Skor 0)</option>
                                                <option value="Tidak Yakin / Ragu-ragu" data-nilai="2">Tidak Yakin / Ragu-ragu (Skor 2)</option>
                                                <option value="Ya 1-5 kg" data-nilai="1">Ya, 1-5 kg (Skor 1)</option>
                                                <option value="Ya 6-10 kg" data-nilai="2">Ya, 6-10 kg (Skor 2)</option>
                                                <option value="Ya 11-15 kg" data-nilai="3">Ya, 11-15 kg (Skor 3)</option>
                                                <option value="Ya > 15 kg" data-nilai="4">Ya, > 15 kg (Skor 4)</option>
                                            </select>
                                            <input type="hidden" id="kebidanan_nilai1" name="nilai1" value="0">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small mb-0">2. Asupan makan berkurang?</label>
                                            <select id="kebidanan_sg2" name="sg2" class="form-select form-select-sm">
                                                <option value="Tidak" data-nilai="0">Tidak (Skor 0)</option>
                                                <option value="Ya" data-nilai="1">Ya (Skor 1)</option>
                                            </select>
                                            <input type="hidden" id="kebidanan_nilai2" name="nilai2" value="0">
                                        </div>
                                        <div class="col-12">
                                            <div class="p-2 bg-light rounded border d-flex align-items-center justify-content-between">
                                                <span class="small fw-semibold">Total Skor Gizi MST:</span>
                                                <div>
                                                    <span class="badge bg-primary fs-6 px-2 py-1" id="display_kebidanan_total_gizi">0</span>
                                                    <input type="hidden" id="kebidanan_total_hasil" name="total_hasil" value="0">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Skrining Nyeri -->
                                    <h6 class="small fw-bold text-muted border-bottom pb-1 mb-2">Pengkajian Tingkat Skala Nyeri:</h6>
                                    <div class="row g-2">
                                        <div class="col-md-4">
                                            <label class="form-label small mb-0">Status Nyeri</label>
                                            <select id="kebidanan_nyeri" name="nyeri" class="form-select form-select-sm">
                                                <option value="Tidak Ada Nyeri">Tidak Ada Nyeri</option>
                                                <option value="Nyeri Akut">Nyeri Akut</option>
                                                <option value="Nyeri Kronis">Nyeri Kronis</option>
                                            </select>
                                        </div>
                                        <div class="col-md-8">
                                            <label class="form-label small mb-0 d-flex justify-content-between">
                                                <span>Skala Nyeri (0 - 10):</span>
                                                <span class="badge bg-success fw-bold" id="badge_kebidanan_skala_nyeri">0 - Tidak Nyeri</span>
                                            </label>
                                            <input type="range" id="kebidanan_skala_nyeri" name="skala_nyeri" min="0" max="10" value="0" class="form-range">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label small mb-0">Provokes (Pemicu):</label>
                                            <div class="input-group input-group-sm">
                                                <select id="kebidanan_provokes" name="provokes" class="form-select form-select-sm" style="max-width: 130px;">
                                                    <option value="Proses Penyakit">Proses Penyakit</option>
                                                    <option value="Benturan">Benturan</option>
                                                    <option value="Lain-lain">Lain-lain</option>
                                                </select>
                                                <input type="text" id="kebidanan_ket_provokes" name="ket_provokes" class="form-control form-control-sm" placeholder="Keterangan" value="-">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small mb-0">Quality (Kualitas):</label>
                                            <div class="input-group input-group-sm">
                                                <select id="kebidanan_quality" name="quality" class="form-select form-select-sm" style="max-width: 130px;">
                                                    <option value="Seperti Tertusuk">Seperti Tertusuk</option>
                                                    <option value="Berdenyut">Berdenyut</option>
                                                    <option value="Terbakar">Terbakar</option>
                                                    <option value="Lain-lain">Lain-lain</option>
                                                </select>
                                                <input type="text" id="kebidanan_ket_quality" name="ket_quality" class="form-control form-control-sm" placeholder="Keterangan" value="-">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label small mb-0">Region (Lokasi):</label>
                                            <input type="text" id="kebidanan_lokasi" name="lokasi" class="form-control form-control-sm" value="-">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label small mb-0">Menyebar:</label>
                                            <select id="kebidanan_menyebar" name="menyebar" class="form-select form-select-sm">
                                                <option value="Tidak">Tidak</option>
                                                <option value="Ya">Ya</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label small mb-0">Durasi Nyeri:</label>
                                            <input type="text" id="kebidanan_durasi" name="durasi" class="form-control form-control-sm" value="-">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small mb-0">Nyeri Hilang Saat:</label>
                                            <div class="input-group input-group-sm">
                                                <select id="kebidanan_nyeri_hilang" name="nyeri_hilang" class="form-select form-select-sm" style="max-width: 110px;">
                                                    <option value="Istirahat">Istirahat</option>
                                                    <option value="Minum Obat">Minum Obat</option>
                                                    <option value="Lain-lain">Lain-lain</option>
                                                </select>
                                                <input type="text" id="kebidanan_ket_nyeri" name="ket_nyeri" class="form-control form-control-sm" placeholder="Keterangan" value="-">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small mb-0">Lapor Ke Dokter:</label>
                                            <div class="input-group input-group-sm">
                                                <select id="kebidanan_pada_dokter" name="pada_dokter" class="form-select form-select-sm" style="max-width: 90px;">
                                                    <option value="Tidak">Tidak</option>
                                                    <option value="Ya">Ya</option>
                                                </select>
                                                <input type="text" id="kebidanan_ket_dokter" name="ket_dokter" class="form-control form-control-sm" placeholder="Jam Lapor" value="-">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- VI. MASALAH & RENCANA TINDAKAN KEBIDANAN -->
                            <div class="card shadow-sm border-0 mb-3">
                                <div class="card-header bg-white fw-bold py-2 border-bottom text-primary">
                                    <i class="bi bi-clipboard-check me-1 text-primary"></i> VI. Masalah &amp; Rencana Tindakan Kebidanan
                                </div>
                                <div class="card-body p-3">
                                    <div class="mb-3">
                                        <label class="form-label small fw-semibold mb-1">Masalah Kebidanan Teridentifikasi <span class="text-danger">*</span></label>
                                        <textarea id="kebidanan_masalah" name="masalah" rows="3" class="form-control form-control-sm" placeholder="Masalah kebidanan yang ditemukan pada pasien">-</textarea>
                                    </div>
                                    <div>
                                        <label class="form-label small fw-semibold mb-1">Tindakan / Rencana Tindakan Kebidanan <span class="text-danger">*</span></label>
                                        <textarea id="kebidanan_tindakan" name="tindakan" rows="4" class="form-control form-control-sm" placeholder="Tindakan / asuhan kebidanan yang telah atau akan dilakukan">-</textarea>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /KOLOM KANAN -->

                    </div>
                </form>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer bg-white py-2 px-3 d-flex justify-content-between border-top">
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-outline-danger btn-sm d-none" id="btnHapusAskepKebidananUgd" onclick="hapusAskepKebidananUgd()">
                        <i class="bi bi-trash me-1"></i> Hapus Asesmen
                    </button>
                    <button type="button" class="btn btn-outline-secondary btn-sm d-none" id="btnCetakAskepKebidananUgd" onclick="cetakAskepKebidananUgd()">
                        <i class="bi bi-printer me-1"></i> Cetak Asesmen
                    </button>
                </div>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i> Tutup
                    </button>
                    <button type="button" class="btn btn-primary btn-sm px-3" id="btnSimpanAskepKebidananUgd" onclick="simpanAskepKebidananUgd()">
                        <i class="bi bi-save me-1"></i> Simpan Asesmen
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Modal Child: Riwayat Persalinan Pasien UGD -->
<div class="modal fade" id="modalRiwayatPersalinanUgd" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-light py-2">
                <h6 class="modal-title fw-bold">Tambah Riwayat Persalinan yang Lalu</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="formRiwayatPersalinanUgd">
                <input type="hidden" name="no_rkm_medis" id="persalinan_no_rkm_medis">
                <div class="modal-body p-3">
                    <div class="row g-2">
                        <div class="col-md-4">
                            <label class="form-label small mb-1">Tanggal / Tahun Persalinan</label>
                            <input type="date" name="tgl_thn" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-md-8">
                            <label class="form-label small mb-1">Tempat Persalinan</label>
                            <input type="text" name="tempat_persalinan" class="form-control form-control-sm" placeholder="RS / Klinik / Puskesmas / Rumah" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small mb-1">Usia Kehamilan</label>
                            <input type="text" name="usia_hamil" class="form-control form-control-sm" placeholder="Aterm / 38 mg" required>
                        </div>
                        <div class="col-md-8">
                            <label class="form-label small mb-1">Jenis Persalinan</label>
                            <input type="text" name="jenis_persalinan" class="form-control form-control-sm" placeholder="Spontan / SC / Vakum" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small mb-1">Jenis Kelamin Bayi</label>
                            <div class="d-flex gap-3 mt-1">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jk" id="persalinan_jk_l" value="L" checked>
                                    <label class="form-check-label small" for="persalinan_jk_l">Laki-laki</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jk" id="persalinan_jk_p" value="P">
                                    <label class="form-check-label small" for="persalinan_jk_p">Perempuan</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <label class="form-label small mb-1">Penolong Persalinan</label>
                            <input type="text" name="penolong" class="form-control form-control-sm" placeholder="Dokter / Bidan" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small mb-1">Penyulit / Komplikasi</label>
                            <input type="text" name="penyulit" class="form-control form-control-sm" placeholder="Tidak Ada / PEB / Perdarahan" value="-">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small mb-1">BB / PB Bayi</label>
                            <input type="text" name="bbpb" class="form-control form-control-sm" placeholder="3200 gr / 49 cm" value="-">
                        </div>
                        <div class="col-12">
                            <label class="form-label small mb-1">Keadaan Bayi Sekarang</label>
                            <input type="text" name="keadaan" class="form-control form-control-sm" placeholder="Sehat / Meninggal" value="Sehat">
                        </div>
                    </div>
                </div>
                <div class="modal-footer py-2">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary btn-sm" onclick="simpanRiwayatPersalinanUgd()">Simpan Riwayat</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('script')
<script>
    // Inisialisasi Select2 Petugas Bidan
    $('#kebidanan_nip').select2({
        dropdownParent: $('#modalAskepKebidananUgd'),
        placeholder: 'Pilih Bidan / Petugas Pengkaji',
        ajax: {
            url: '/erm/petugas/cari',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: data.map(function(item) {
                        return { id: item.nip, text: item.nama };
                    })
                };
            }
        }
    });

    // Auto-Kalkulasi BMI
    function hitungBmiKebidanan() {
        const bb = parseFloat($('#kebidanan_bb').val()) || 0;
        const tb = parseFloat($('#kebidanan_tb').val()) || 0;
        if (bb > 0 && tb > 0) {
            const tbM = tb / 100;
            const bmi = (bb / (tbM * tbM)).toFixed(1);
            $('#kebidanan_bmi').val(bmi);
        } else {
            $('#kebidanan_bmi').val('-');
        }
    }
    $('#kebidanan_bb, #kebidanan_tb').on('input change', hitungBmiKebidanan);

    // Auto-Kalkulasi HPHT -> TP & Usia Hamil
    $('#kebidanan_hpht').on('change', function() {
        const hpht = $(this).val();
        if (!hpht) {
            $('#kebidanan_usia_kehamilan').val('-');
            $('#kebidanan_tp').val('');
            return;
        }
        const hphtDate = new Date(hpht);
        const today = new Date();
        const diffMs = today - hphtDate;
        if (diffMs > 0) {
            const totalHari = Math.floor(diffMs / (1000 * 60 * 60 * 24));
            const minggu = Math.floor(totalHari / 7);
            const sisaHari = totalHari % 7;
            $('#kebidanan_usia_kehamilan').val(`${minggu}m+${sisaHari}h`);
        }
        const hpl = new Date(hphtDate);
        hpl.setDate(hpl.getDate() + 280);
        const yyyy = hpl.getFullYear();
        const mm = String(hpl.getMonth() + 1).padStart(2, '0');
        const dd = String(hpl.getDate()).padStart(2, '0');
        $('#kebidanan_tp').val(`${yyyy}-${mm}-${dd}`);
    });

    // Auto-Kalkulasi Skor Gizi MST
    function hitungSkorGiziKebidanan() {
        const sg1Score = parseInt($('#kebidanan_sg1 option:selected').data('nilai') || 0);
        const sg2Score = parseInt($('#kebidanan_sg2 option:selected').data('nilai') || 0);
        $('#kebidanan_nilai1').val(sg1Score);
        $('#kebidanan_nilai2').val(sg2Score);
        const total = sg1Score + sg2Score;
        $('#kebidanan_total_hasil').val(total);
        $('#display_kebidanan_total_gizi').text(total);
    }
    $('#kebidanan_sg1, #kebidanan_sg2').on('change', hitungSkorGiziKebidanan);

    // Auto-Kalkulasi Risiko Jatuh Get Up and Go
    function hitungRisikoJatuhKebidanan() {
        const a = $('#kebidanan_berjalan_a').val() === 'Ya';
        const b = $('#kebidanan_berjalan_b').val() === 'Ya';
        const c = $('#kebidanan_berjalan_c').val() === 'Ya';

        if (a && b) {
            $('#kebidanan_hasil').val('Risiko tinggi (ditemukan a dan b)').attr('class', 'form-control form-control-sm bg-light fw-bold text-danger');
            if ($('#kebidanan_lapor').val() === 'Tidak') $('#kebidanan_lapor').val('Ya').trigger('change');
        } else if (a || b || c) {
            $('#kebidanan_hasil').val('Risiko rendah (ditemukan a/b/c)').attr('class', 'form-control form-control-sm bg-light fw-bold text-warning');
        } else {
            $('#kebidanan_hasil').val('Tidak beresiko (tidak ditemukan a dan b)').attr('class', 'form-control form-control-sm bg-light fw-bold text-success');
        }
    }
    $('#kebidanan_berjalan_a, #kebidanan_berjalan_b, #kebidanan_berjalan_c').on('change', hitungRisikoJatuhKebidanan);

    $('#kebidanan_lapor').on('change', function() {
        if ($(this).val() === 'Ya') {
            $('#kebidanan_ket_lapor').val(moment().format('HH:mm:ss'));
        } else {
            $('#kebidanan_ket_lapor').val('-');
        }
    });

    $('#kebidanan_pada_dokter').on('change', function() {
        if ($(this).val() === 'Ya') {
            $('#kebidanan_ket_dokter').val(moment().format('HH:mm:ss'));
        } else {
            $('#kebidanan_ket_dokter').val('-');
        }
    });

    // Visual Slider Skala Nyeri
    $('#kebidanan_skala_nyeri').on('input change', function() {
        const val = parseInt($(this).val());
        let badgeClass = 'badge bg-success fw-bold';
        let text = `${val} - Tidak Nyeri`;

        if (val >= 1 && val <= 3) {
            badgeClass = 'badge bg-info text-dark fw-bold';
            text = `${val} - Nyeri Ringan`;
        } else if (val >= 4 && val <= 6) {
            badgeClass = 'badge bg-warning text-dark fw-bold';
            text = `${val} - Nyeri Sedang`;
        } else if (val >= 7) {
            badgeClass = 'badge bg-danger fw-bold';
            text = `${val} - Nyeri Berat`;
        }
        $('#badge_kebidanan_skala_nyeri').attr('class', badgeClass).text(text);
    });

    // Reset Form
    function resetFormAskepKebidananUgd() {
        $('#formAskepKebidananUgd')[0].reset();
        $('#kebidanan_nip').val(null).trigger('change');
        $('#kebidanan_tanggal').val(new Date().toISOString().slice(0, 16));
        $('#kebidanan_informasi').val('Autoanamnesis');
        $('#kebidanan_td').val('120/80');
        $('#kebidanan_nadi').val('80');
        $('#kebidanan_rr').val('20');
        $('#kebidanan_suhu').val('36.5');
        $('#kebidanan_gcs').val('15');
        $('#kebidanan_bb, #kebidanan_tb').val('0');
        $('#kebidanan_lila, #kebidanan_bmi').val('-');
        $('#kebidanan_tfu, #kebidanan_tbj, #kebidanan_letak, #kebidanan_presentasi, #kebidanan_penurunan').val('-');
        $('#kebidanan_his, #kebidanan_kekuatan, #kebidanan_lamanya, #kebidanan_bjj').val('-');
        $('#kebidanan_ket_bjj').val('Teratur');
        $('#kebidanan_portio, #kebidanan_serviks, #kebidanan_ketuban, #kebidanan_hodge').val('-');
        $('#kebidanan_inspekulo, #kebidanan_ctg, #kebidanan_usg, #kebidanan_lab, #kebidanan_lakmus').val('Tidak');
        $('#kebidanan_ket_inspekulo, #kebidanan_ket_ctg, #kebidanan_ket_usg, #kebidanan_ket_lab, #kebidanan_ket_lakmus').val('-');
        $('#kebidanan_panggul').val('Tidak Dilakukan Pemeriksaan');
        $('#kebidanan_keluhan_utama').val('-');
        $('#kebidanan_umur, #kebidanan_lama, #kebidanan_banyaknya, #kebidanan_haid').val('-');
        $('#kebidanan_siklus').val('28');
        $('#kebidanan_ket_siklus').val('Teratur');
        $('#kebidanan_ket_siklus1').val('Tidak Ada Masalah');
        $('#kebidanan_status').val('Menikah');
        $('#kebidanan_kali').val('1');
        $('#kebidanan_usia1, #kebidanan_usia2, #kebidanan_usia3').val('-');
        $('#kebidanan_ket1').val('Masih Menikah');
        $('#kebidanan_ket2, #kebidanan_ket3').val('-');
        $('#kebidanan_hpht, #kebidanan_tp').val('');
        $('#kebidanan_usia_kehamilan').val('-');
        $('#kebidanan_g, #kebidanan_p, #kebidanan_a, #kebidanan_hidup').val('0');
        $('#kebidanan_imunisasi').val('Tidak');
        $('#kebidanan_ket_imunisasi').val('-');
        $('#kebidanan_kb').val('Belum Pernah');
        $('#kebidanan_ket_kb, #kebidanan_ket_komplikasi, #kebidanan_berhenti, #kebidanan_alasan').val('-');
        $('#kebidanan_komplikasi').val('Tidak Ada');
        $('#kebidanan_ginekologi').val('Tidak Ada');
        $('#kebidanan_kebiasaan, #kebidanan_ket_kebiasaan, #kebidanan_ket_kebiasaan1, #kebidanan_ket_kebiasaan2').val('-');
        $('#kebidanan_kebiasaan1, #kebidanan_kebiasaan2, #kebidanan_kebiasaan3').val('Tidak');
        $('#kebidanan_alat_bantu, #kebidanan_prothesa').val('Tidak');
        $('#kebidanan_ket_bantu, #kebidanan_ket_pro').val('-');
        $('#kebidanan_adl').val('Mandiri');
        $('#kebidanan_status_psiko').val('Tenang');
        $('#kebidanan_ket_psiko, #kebidanan_ket_tinggal, #kebidanan_ket_budaya, #kebidanan_ket_edukasi').val('-');
        $('#kebidanan_hub_keluarga').val('Baik');
        $('#kebidanan_tinggal_dengan').val('Suami / Istri');
        $('#kebidanan_ket_tinggal').val('-');
        $('#kebidanan_ekonomi').val('Baik');
        $('#kebidanan_budaya').val('Tidak Ada');
        $('#kebidanan_edukasi').val('Pasien');
        $('#kebidanan_berjalan_a, #kebidanan_berjalan_b, #kebidanan_berjalan_c').val('Tidak');
        hitungRisikoJatuhKebidanan();
        $('#kebidanan_lapor').val('Tidak');
        $('#kebidanan_ket_lapor').val('-');
        $('#kebidanan_sg1').val('Tidak Ada');
        $('#kebidanan_sg2').val('Tidak');
        hitungSkorGiziKebidanan();
        $('#kebidanan_nyeri').val('Tidak Ada Nyeri');
        $('#kebidanan_skala_nyeri').val(0).trigger('input');
        $('#kebidanan_provokes').val('Proses Penyakit');
        $('#kebidanan_ket_provokes, #kebidanan_ket_quality, #kebidanan_lokasi, #kebidanan_durasi, #kebidanan_ket_nyeri, #kebidanan_ket_dokter').val('-');
        $('#kebidanan_quality').val('Seperti Tertusuk');
        $('#kebidanan_menyebar').val('Tidak');
        $('#kebidanan_nyeri_hilang').val('Istirahat');
        $('#kebidanan_pada_dokter').val('Tidak');
        $('#kebidanan_masalah, #kebidanan_tindakan').val('-');

        $('#btnCetakAskepKebidananUgd, #btnHapusAskepKebidananUgd').addClass('d-none');
        $('#badgeStatusAskepKebidananUgd').attr('class', 'badge bg-light text-primary px-2 py-1').html('<i class="bi bi-file-earmark-plus me-1"></i> Data Baru');
        $('#btnSimpanAskepKebidananUgd').html('<i class="bi bi-save me-1"></i> Simpan Asesmen');
    }

    // Buka Modal Asesmen Keperawatan Kebidanan UGD
    function modalAskepKebidananUgd(noRawat) {
        resetFormAskepKebidananUgd();
        $('#kebidanan_no_rawat').val(noRawat);

        // Ambil Data Registrasi Pasien
        getRegPeriksa(noRawat).done(function(reg) {
            const p = reg?.pasien || {};
            const d = reg?.dokter || {};
            $('#kebidanan_info_no_rawat').text(reg?.no_rawat || noRawat);
            $('#kebidanan_info_no_rkm_medis').text(p?.no_rkm_medis || '-');
            $('#kebidanan_no_rkm_medis').val(p?.no_rkm_medis || '');
            $('#persalinan_no_rkm_medis').val(p?.no_rkm_medis || '');
            $('#kebidanan_info_nm_pasien').text(p?.nm_pasien || '-');
            $('#kebidanan_info_tgl_lahir').text(`${p?.tgl_lahir ? formatTanggal(p.tgl_lahir) : '-'} (${p?.jk || '-'})`);
            $('#kebidanan_info_dokter_penjab').text(`${d?.nm_dokter || '-'} / ${reg?.penjab?.png_jawab || '-'}`);

            // Pre-fill Riwayat Pemeriksaan Ralan jika entri baru
            if (reg?.pemeriksaan_ralan && reg.pemeriksaan_ralan.length > 0) {
                const pr = reg.pemeriksaan_ralan[0];
                if (pr.keluhan) $('#kebidanan_keluhan_utama').val(pr.keluhan);
                if (pr.tensi) $('#kebidanan_td').val(pr.tensi);
                if (pr.nadi) $('#kebidanan_nadi').val(pr.nadi);
                if (pr.respirasi) $('#kebidanan_rr').val(pr.respirasi);
                if (pr.suhu_tubuh) $('#kebidanan_suhu').val(pr.suhu_tubuh);
                if (pr.berat && parseFloat(pr.berat) > 0) $('#kebidanan_bb').val(pr.berat);
                if (pr.tinggi && parseFloat(pr.tinggi) > 0) $('#kebidanan_tb').val(pr.tinggi);
                hitungBmiKebidanan();
            }

            // Render Riwayat Persalinan yang Lalu
            if (p?.no_rkm_medis) {
                renderTableRiwayatPersalinanUgd(p.no_rkm_medis);
            }
        });

        // Ambil Data Asesmen Kebidanan Tersimpan
        $.get(`/erm/asesmen-keperawatan/kandungan?no_rawat=${encodeURIComponent(noRawat)}`).done(function(res) {
            const data = res?.data;
            if (data && data.no_rawat) {
                $('#badgeStatusAskepKebidananUgd').attr('class', 'badge bg-success px-2 py-1').html('<i class="bi bi-check-circle-fill me-1"></i> Data Tersimpan');
                $('#btnCetakAskepKebidananUgd, #btnHapusAskepKebidananUgd').removeClass('d-none');
                $('#btnSimpanAskepKebidananUgd').html('<i class="bi bi-save me-1"></i> Perbarui Asesmen');

                if (data.petugas) {
                    const opt = new Option(data.petugas.nama, data.petugas.nip, true, true);
                    $('#kebidanan_nip').append(opt).trigger('change');
                } else if (data.nip) {
                    const opt = new Option(data.nip, data.nip, true, true);
                    $('#kebidanan_nip').append(opt).trigger('change');
                }

                const tglVal = (data.tanggal && !data.tanggal.startsWith('0000-00-00')) ? data.tanggal.replace(' ', 'T') : '';
                $('#kebidanan_tanggal').val(tglVal);
                $('#kebidanan_informasi').val(data.informasi || 'Autoanamnesis');
                $('#kebidanan_td').val(data.td || '120/80');
                $('#kebidanan_nadi').val(data.nadi || '80');
                $('#kebidanan_rr').val(data.rr || '20');
                $('#kebidanan_suhu').val(data.suhu || '36.5');
                $('#kebidanan_gcs').val(data.gcs || '15');
                $('#kebidanan_bb').val(data.bb || '0');
                $('#kebidanan_tb').val(data.tb || '0');
                $('#kebidanan_lila').val(data.lila || '-');
                $('#kebidanan_bmi').val(data.bmi || '-');

                $('#kebidanan_tfu').val(data.tfu || '-');
                $('#kebidanan_tbj').val(data.tbj || '-');
                $('#kebidanan_letak').val(data.letak || '-');
                $('#kebidanan_presentasi').val(data.presentasi || '-');
                $('#kebidanan_penurunan').val(data.penurunan || '-');
                $('#kebidanan_his').val(data.his || '-');
                $('#kebidanan_kekuatan').val(data.kekuatan || '-');
                $('#kebidanan_lamanya').val(data.lamanya || '-');
                $('#kebidanan_bjj').val(data.bjj || '-');
                $('#kebidanan_ket_bjj').val(data.ket_bjj || 'Teratur');

                $('#kebidanan_portio').val(data.portio || '-');
                $('#kebidanan_serviks').val(data.serviks || '-');
                $('#kebidanan_ketuban').val(data.ketuban || '-');
                $('#kebidanan_hodge').val(data.hodge || '-');

                $('#kebidanan_inspekulo').val(data.inspekulo || 'Tidak');
                $('#kebidanan_ket_inspekulo').val(data.ket_inspekulo || '-');
                $('#kebidanan_ctg').val(data.ctg || 'Tidak');
                $('#kebidanan_ket_ctg').val(data.ket_ctg || '-');
                $('#kebidanan_usg').val(data.usg || 'Tidak');
                $('#kebidanan_ket_usg').val(data.ket_usg || '-');
                $('#kebidanan_lab').val(data.lab || 'Tidak');
                $('#kebidanan_ket_lab').val(data.ket_lab || '-');
                $('#kebidanan_lakmus').val(data.lakmus || 'Tidak');
                $('#kebidanan_ket_lakmus').val(data.ket_lakmus || '-');
                $('#kebidanan_panggul').val(data.panggul || 'Tidak Dilakukan Pemeriksaan');

                $('#kebidanan_keluhan_utama').val(data.keluhan_utama || '-');
                $('#kebidanan_umur').val(data.umur || '-');
                $('#kebidanan_lama').val(data.lama || '-');
                $('#kebidanan_banyaknya').val(data.banyaknya || '-');
                $('#kebidanan_haid').val(data.haid || '-');
                $('#kebidanan_siklus').val(data.siklus || '28');
                $('#kebidanan_ket_siklus').val(data.ket_siklus || 'Teratur');
                $('#kebidanan_ket_siklus1').val(data.ket_siklus1 || 'Tidak Ada Masalah');
                $('#kebidanan_status').val(data.status || 'Menikah');
                $('#kebidanan_kali').val(data.kali || '1');
                $('#kebidanan_usia1').val(data.usia1 || '-');
                $('#kebidanan_ket1').val(data.ket1 || 'Masih Menikah');
                $('#kebidanan_usia2').val(data.usia2 || '-');
                $('#kebidanan_ket2').val(data.ket2 || '-');
                $('#kebidanan_usia3').val(data.usia3 || '-');
                $('#kebidanan_ket3').val(data.ket3 || '-');

                $('#kebidanan_hpht').val((data.hpht && data.hpht !== '0000-00-00') ? data.hpht : '');
                $('#kebidanan_usia_kehamilan').val(data.usia_kehamilan || '-');
                $('#kebidanan_tp').val((data.tp && data.tp !== '0000-00-00') ? data.tp : '');
                $('#kebidanan_g').val(data.g || '0');
                $('#kebidanan_p').val(data.p || '0');
                $('#kebidanan_a').val(data.a || '0');
                $('#kebidanan_hidup').val(data.hidup || '0');
                $('#kebidanan_imunisasi').val(data.imunisasi || 'Tidak');
                $('#kebidanan_ket_imunisasi').val(data.ket_imunisasi || '-');

                $('#kebidanan_kb').val(data.kb || 'Belum Pernah');
                $('#kebidanan_ket_kb').val(data.ket_kb || '-');
                $('#kebidanan_komplikasi').val(data.komplikasi || 'Tidak Ada');
                $('#kebidanan_ket_komplikasi').val(data.ket_komplikasi || '-');
                $('#kebidanan_berhenti').val(data.berhenti || '-');
                $('#kebidanan_alasan').val(data.alasan || '-');
                $('#kebidanan_ginekologi').val(data.ginekologi || 'Tidak Ada');

                $('#kebidanan_kebiasaan').val(data.kebiasaan || '-');
                $('#kebidanan_ket_kebiasaan').val(data.ket_kebiasaan || '-');
                $('#kebidanan_kebiasaan1').val(data.kebiasaan1 || 'Tidak');
                $('#kebidanan_ket_kebiasaan1').val(data.ket_kebiasaan1 || '-');
                $('#kebidanan_kebiasaan2').val(data.kebiasaan2 || 'Tidak');
                $('#kebidanan_ket_kebiasaan2').val(data.ket_kebiasaan2 || '-');
                $('#kebidanan_kebiasaan3').val(data.kebiasaan3 || 'Tidak');

                $('#kebidanan_alat_bantu').val(data.alat_bantu || 'Tidak');
                $('#kebidanan_ket_bantu').val(data.ket_bantu || '-');
                $('#kebidanan_prothesa').val(data.prothesa || 'Tidak');
                $('#kebidanan_ket_pro').val(data.ket_pro || '-');
                $('#kebidanan_adl').val(data.adl || 'Mandiri');

                $('#kebidanan_status_psiko').val(data.status_psiko || 'Tenang');
                $('#kebidanan_ket_psiko').val(data.ket_psiko || '-');
                $('#kebidanan_hub_keluarga').val(data.hub_keluarga || 'Baik');
                $('#kebidanan_tinggal_dengan').val(data.tinggal_dengan || 'Suami / Istri');
                $('#kebidanan_ket_tinggal').val(data.ket_tinggal || '-');
                $('#kebidanan_ekonomi').val(data.ekonomi || 'Baik');
                $('#kebidanan_budaya').val(data.budaya || 'Tidak Ada');
                $('#kebidanan_ket_budaya').val(data.ket_budaya || '-');
                $('#kebidanan_edukasi').val(data.edukasi || 'Pasien');
                $('#kebidanan_ket_edukasi').val(data.ket_edukasi || '-');

                $('#kebidanan_berjalan_a').val(data.berjalan_a || 'Tidak');
                $('#kebidanan_berjalan_b').val(data.berjalan_b || 'Tidak');
                $('#kebidanan_berjalan_c').val(data.berjalan_c || 'Tidak');
                hitungRisikoJatuhKebidanan();
                $('#kebidanan_hasil').val(data.hasil || 'Tidak beresiko (tidak ditemukan a dan b)');
                $('#kebidanan_lapor').val(data.lapor || 'Tidak');
                $('#kebidanan_ket_lapor').val(data.ket_lapor || '-');

                $('#kebidanan_sg1').val(data.sg1 || 'Tidak Ada');
                $('#kebidanan_sg2').val(data.sg2 || 'Tidak');
                hitungSkorGiziKebidanan();

                $('#kebidanan_nyeri').val(data.nyeri || 'Tidak Ada Nyeri');
                $('#kebidanan_skala_nyeri').val(data.skala_nyeri || 0).trigger('input');
                $('#kebidanan_provokes').val(data.provokes || 'Proses Penyakit');
                $('#kebidanan_ket_provokes').val(data.ket_provokes || '-');
                $('#kebidanan_quality').val(data.quality || 'Seperti Tertusuk');
                $('#kebidanan_ket_quality').val(data.ket_quality || '-');
                $('#kebidanan_lokasi').val(data.lokasi || '-');
                $('#kebidanan_menyebar').val(data.menyebar || 'Tidak');
                $('#kebidanan_durasi').val(data.durasi || '-');
                $('#kebidanan_nyeri_hilang').val(data.nyeri_hilang || 'Istirahat');
                $('#kebidanan_ket_nyeri').val(data.ket_nyeri || '-');
                $('#kebidanan_pada_dokter').val(data.pada_dokter || 'Tidak');
                $('#kebidanan_ket_dokter').val(data.ket_dokter || '-');

                $('#kebidanan_masalah').val(data.masalah || '-');
                $('#kebidanan_tindakan').val(data.tindakan || '-');
            } else {
                // Set default NIP petugas login jika data baru
                const userNik = "{{ session()->get('pegawai')->nik ?? '' }}";
                const userNama = "{{ session()->get('pegawai')->nama ?? '' }}";
                if (userNik && userNama) {
                    const opt = new Option(userNama, userNik, true, true);
                    $('#kebidanan_nip').append(opt).trigger('change');
                }
            }
        });

        $('#modalAskepKebidananUgd').modal('show');
    }

    // Simpan Asesmen Kebidanan UGD
    function simpanAskepKebidananUgd() {
        const nip = $('#kebidanan_nip').val();
        if (!nip) {
            Swal.fire({ icon: 'warning', title: 'Perhatian!', text: 'Silakan pilih Bidan / Petugas Pengkaji terlebih dahulu.' });
            return;
        }

        const formData = $('#formAskepKebidananUgd').serialize();

        Swal.fire({
            title: 'Menyimpan Asesmen...',
            text: 'Mohon tunggu sebentar',
            allowOutsideClick: false,
            didOpen: () => { Swal.showLoading(); }
        });

        $.ajax({
            url: "{{ route('asesmen-keperawatan.kandungan.store') }}",
            type: "POST",
            data: formData,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: response?.message || 'Asesmen Keperawatan Kebidanan berhasil disimpan.',
                    timer: 1500,
                    showConfirmButton: false
                });
                $('#modalAskepKebidananUgd').modal('hide');
                if (typeof tbUgd === 'function') {
                    tbUgd();
                }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    let errs = xhr.responseJSON?.errors || {};
                    let msg = Object.values(errs).flat().join('<br>');
                    Swal.fire({ icon: 'error', title: 'Validasi Gagal!', html: msg || 'Mohon lengkapi seluruh isian wajib.' });
                } else {
                    Swal.fire({ icon: 'error', title: 'Gagal!', text: xhr.responseJSON?.message || 'Terjadi kesalahan sistem saat menyimpan asesmen.' });
                }
            }
        });
    }

    // Hapus Asesmen Kebidanan UGD
    function hapusAskepKebidananUgd() {
        const noRawat = $('#kebidanan_no_rawat').val();
        if (!noRawat) return;

        Swal.fire({
            title: 'Hapus Asesmen Kebidanan?',
            text: 'Data asesmen keperawatan kebidanan yang dihapus tidak dapat dikembalikan!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus Data!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({ title: 'Menghapus...', allowOutsideClick: false, didOpen: () => { Swal.showLoading(); } });
                $.ajax({
                    url: "{{ route('asesmen-keperawatan.kandungan.delete') }}",
                    type: "DELETE",
                    data: { no_rawat: noRawat },
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    success: function(response) {
                        Swal.fire({ icon: 'success', title: 'Terhapus!', text: 'Asesmen Keperawatan Kebidanan berhasil dihapus.', timer: 1500, showConfirmButton: false });
                        $('#modalAskepKebidananUgd').modal('hide');
                        if (typeof tbUgd === 'function') {
                            tbUgd();
                        }
                    },
                    error: function(xhr) {
                        Swal.fire({ icon: 'error', title: 'Gagal Menghapus!', text: xhr.responseJSON?.message || 'Terjadi kesalahan saat menghapus data.' });
                    }
                });
            }
        });
    }

    // Cetak Asesmen Kebidanan UGD
    function cetakAskepKebidananUgd() {
        const noRawat = $('#kebidanan_no_rawat').val();
        if (!noRawat) return;
        const url = `/erm/asesmen-keperawatan/kandungan/print?no_rawat=${encodeURIComponent(noRawat)}`;
        window.open(url, '_blank');
    }

    // Riwayat Persalinan yang Lalu Helper Functions
    function showModalRiwayatPersalinanUgd() {
        $('#formRiwayatPersalinanUgd')[0].reset();
        const rm = $('#kebidanan_no_rkm_medis').val();
        $('#persalinan_no_rkm_medis').val(rm);
        $('#modalRiwayatPersalinanUgd').modal('show');
    }

    function renderTableRiwayatPersalinanUgd(noRkmMedis) {
        const tbody = $('.tbRiwayatPersalinanPasienUgd tbody');
        tbody.html('<tr><td colspan="9" class="text-center py-2"><span class="spinner-border spinner-border-sm text-primary"></span> Memuat riwayat...</td></tr>');

        $.get(`/erm/riwayat/persalinan/get/${noRkmMedis}`).done(function(list) {
            tbody.empty();
            if (list && list.length > 0) {
                list.forEach(function(item) {
                    tbody.append(`
                        <tr>
                            <td class="text-center">
                                <button type="button" class="btn btn-outline-danger btn-sm py-0 px-1" title="Hapus Riwayat" onclick="hapusRiwayatPersalinanUgd('${item.no_rkm_medis}', '${item.tgl_thn}')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                            <td>${item.tgl_thn || '-'}</td>
                            <td>${item.tempat_persalinan || '-'}</td>
                            <td>${item.usia_hamil || '-'}</td>
                            <td>${item.jenis_persalinan || '-'}</td>
                            <td>${item.jk || '-'}</td>
                            <td>${item.penolong || '-'}</td>
                            <td>${item.penyulit || '-'}</td>
                            <td>${item.keadaan || '-'}</td>
                        </tr>
                    `);
                });
            } else {
                tbody.html('<tr><td colspan="9" class="text-center text-muted py-2">- Tidak Ada Data Riwayat Partus -</td></tr>');
            }
        }).fail(function() {
            tbody.html('<tr><td colspan="9" class="text-center text-danger py-2">Gagal memuat riwayat persalinan.</td></tr>');
        });
    }

    function simpanRiwayatPersalinanUgd() {
        const formData = $('#formRiwayatPersalinanUgd').serialize();
        $.post("{{ route('riwayat.persalinan.insert') }}", formData).done(function(res) {
            $('#modalRiwayatPersalinanUgd').modal('hide');
            Swal.fire({ icon: 'success', title: 'Berhasil!', text: 'Riwayat persalinan berhasil ditambahkan.', timer: 1000, showConfirmButton: false });
            const rm = $('#kebidanan_no_rkm_medis').val();
            renderTableRiwayatPersalinanUgd(rm);
        }).fail(function(xhr) {
            Swal.fire({ icon: 'error', title: 'Gagal!', text: xhr.responseJSON?.message || 'Gagal menyimpan riwayat persalinan.' });
        });
    }

    function hapusRiwayatPersalinanUgd(noRkmMedis, tglThn) {
        Swal.fire({
            title: 'Hapus Riwayat Partus?',
            text: `Hapus data persalinan tanggal ${tglThn}?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((res) => {
            if (res.isConfirmed) {
                $.ajax({
                    url: "{{ route('riwayat.persalinan.delete') }}",
                    type: "DELETE",
                    data: {
                        _token: "{{ csrf_token() }}",
                        no_rkm_medis: noRkmMedis,
                        tgl_thn: tglThn
                    },
                    success: function() {
                        renderTableRiwayatPersalinanUgd(noRkmMedis);
                    },
                    error: function() {
                        Swal.fire({ icon: 'error', title: 'Gagal!', text: 'Gagal menghapus riwayat persalinan.' });
                    }
                });
            }
        });
    }
</script>
@endpush
