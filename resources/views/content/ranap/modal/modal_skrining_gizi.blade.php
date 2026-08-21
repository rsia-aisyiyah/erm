<!-- Modal Form Skrining Gizi Pasien -->
<div class="modal fade" id="modalSkriningGizi" tabindex="-1" aria-labelledby="modalSkriningGiziLabel" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content border-0 shadow">
            
            <!-- Modal Header Green -->
            <div class="modal-header text-white py-2 px-3 justify-content-between align-items-center" style="background: #198754;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-clipboard2-check-fill fs-5"></i>
                    <h6 class="modal-title fw-bold mb-0 text-white" id="modalSkriningGiziLabel">
                        Skrining Gizi Pasien
                    </h6>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body p-3 bg-light">
                
                <!-- PATIENT BANNER CARD -->
                <div class="card border-0 shadow-sm rounded-3 mb-3" style="background: #ffffff;">
                    <div class="card-body p-3 d-flex align-items-center gap-3">
                        <div class="rounded-circle bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center" style="width: 42px; height: 42px; min-width: 42px;">
                            <i class="bi bi-person-fill fs-4"></i>
                        </div>
                        <div>
                            <strong class="d-block text-dark fs-6" id="skrining_info_nm_pasien">NAMA PASIEN</strong>
                            <small class="text-muted font-monospace" id="skrining_info_no_rawat">0000/00/00/000000</small>
                        </div>
                    </div>
                </div>

                <form id="formSkriningGizi" autocomplete="off">
                    @csrf
                    <input type="hidden" id="skrining_no_rawat" name="no_rawat">

                    <div class="row g-3">
                        
                        <!-- LEFT PANEL: Kategori (OBGYN / ANAK) -->
                        <div class="col-md-2">
                            <label class="form-label fw-bold text-success mb-2" style="font-size: 13px;">Kategori</label>
                            <div class="d-flex flex-column gap-2">
                                <label class="card border p-2 text-center rounded-3 cursor-pointer mb-0 kategori-card" id="cardKategoriObgyn">
                                    <input type="radio" name="kategori" id="kat_obgyn" value="OBGYN" class="d-none">
                                    <i class="bi bi-person-heart fs-3 text-secondary d-block mb-1"></i>
                                    <span class="fw-bold small text-dark">OBGYN</span>
                                </label>

                                <label class="card border p-2 text-center rounded-3 cursor-pointer mb-0 kategori-card active" id="cardKategoriAnak">
                                    <input type="radio" name="kategori" id="kat_anak" value="ANAK" class="d-none" checked>
                                    <i class="bi bi-person-standing fs-3 text-success d-block mb-1"></i>
                                    <span class="fw-bold small text-dark">ANAK</span>
                                </label>
                            </div>
                        </div>

                        <!-- RIGHT PANEL: Form Inputs -->
                        <div class="col-md-10">
                            
                            <!-- DATA ANTROPOMETRI -->
                            <div class="mb-3">
                                <div class="row g-2">
                                    <div class="col-md-4" id="col_bb">
                                        <label class="form-label small mb-1">Berat Badan (Kg) <span class="text-danger">*</span></label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text bg-white"><i class="bi bi-speedometer2 text-muted"></i></span>
                                            <input type="number" step="0.1" class="form-control" id="skrining_bb" name="bb" required placeholder="0">
                                        </div>
                                    </div>

                                    <div class="col-md-4" id="col_tb">
                                        <label class="form-label small mb-1">Tinggi Badan (cm) <span class="text-danger">*</span></label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text bg-white"><i class="bi bi-ruler text-muted"></i></span>
                                            <input type="number" step="0.1" class="form-control" id="skrining_tb" name="tb" required placeholder="0">
                                        </div>
                                    </div>

                                    <div class="col-md-4" id="col_imt">
                                        <label class="form-label small mb-1">IMT</label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text bg-light"><i class="bi bi-calculator text-muted"></i></span>
                                            <input type="text" class="form-control bg-light" id="skrining_imt" name="imt" readonly placeholder="0">
                                        </div>
                                    </div>

                                    <div class="col-md-3 d-none" id="wrapperLila">
                                        <label class="form-label small mb-1">LILA (cm)</label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text bg-white"><i class="bi bi-circle text-muted"></i></span>
                                            <input type="number" step="0.1" class="form-control" id="skrining_lila" name="lila" placeholder="0">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- DIAGNOSA MEDIS -->
                            <div class="mb-3">
                                <label class="form-label fw-bold text-dark small mb-1">Diagnosa Medis <span class="text-danger">*</span></label>
                                <textarea class="form-control form-control-sm" id="skrining_diagnosa_medis" name="diagnosa_medis" rows="2" placeholder="Masukkan diagnosa medis pasien..." required></textarea>
                            </div>

                            <!-- HASIL PEMERIKSAAN PENUNJANG -->
                            <div class="mb-3">
                                <label class="form-label fw-bold text-dark small mb-2">Hasil Pemeriksaan Penunjang</label>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label small mb-1 fw-semibold">HB</label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text bg-white"><i class="bi bi-pencil-square text-muted"></i></span>
                                            <input type="number" step="0.1" class="form-control" id="skrining_hb" name="hb" placeholder="Nilai HB...">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label small mb-1 fw-semibold">HIV</label>
                                        <div class="d-flex gap-3 align-items-center mt-1" style="font-size: 13px;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="hiv" id="hiv_reaktif" value="Reaktif">
                                                <label class="form-check-label" for="hiv_reaktif">Reaktif</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="hiv" id="hiv_non_reaktif" value="Non Reaktif">
                                                <label class="form-check-label" for="hiv_non_reaktif">Non Reaktif</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="hiv" id="hiv_tidak_periksa" value="Tidak Periksa" checked>
                                                <label class="form-check-label text-muted" for="hiv_tidak_periksa">Tidak Periksa</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label small mb-1 fw-semibold">HBSAG</label>
                                        <div class="d-flex gap-3 align-items-center mt-1" style="font-size: 13px;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="hbsag" id="hbsag_reaktif" value="Reaktif">
                                                <label class="form-check-label" for="hbsag_reaktif">Reaktif</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="hbsag" id="hbsag_non_reaktif" value="Non Reaktif">
                                                <label class="form-check-label" for="hbsag_non_reaktif">Non Reaktif</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="hbsag" id="hbsag_tidak_periksa" value="Tidak Periksa" checked>
                                                <label class="form-check-label text-muted" for="hbsag_tidak_periksa">Tidak Periksa</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label small mb-1 fw-semibold">Syphilis</label>
                                        <div class="d-flex gap-3 align-items-center mt-1" style="font-size: 13px;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="syphilis" id="syphilis_reaktif" value="Reaktif">
                                                <label class="form-check-label" for="syphilis_reaktif">Reaktif</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="syphilis" id="syphilis_non_reaktif" value="Non Reaktif">
                                                <label class="form-check-label" for="syphilis_non_reaktif">Non Reaktif</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="syphilis" id="syphilis_tidak_periksa" value="Tidak Periksa" checked>
                                                <label class="form-check-label text-muted" for="syphilis_tidak_periksa">Tidak Periksa</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- PERTANYAAN SKRINING CONTAINER -->
                            <div class="card border-0 shadow-sm rounded-3 p-3 mb-3" style="background: #ffffff;">
                                
                                <!-- PANEL PERTANYAAN OBGYN -->
                                <div id="panelPertanyaanObgyn" class="d-none">
                                    
                                    <!-- 1. Apakah asupan makan berkurang... -->
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold small text-dark mb-2">1. Apakah asupan makan berkurang karena kurang nafsu makan?</label>
                                        <div class="d-flex gap-3 ms-2">
                                            <div class="form-check">
                                                <input class="form-check-input q-obgyn-radio" type="radio" name="q_obgyn_1" id="q_obgyn_1_ya" value="Ya">
                                                <label class="form-check-label text-success fw-bold" for="q_obgyn_1_ya">Ya</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input q-obgyn-radio" type="radio" name="q_obgyn_1" id="q_obgyn_1_tidak" value="Tidak" checked>
                                                <label class="form-check-label text-secondary" for="q_obgyn_1_tidak">Tidak</label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- 2. Apakah terdapat gangguan metabolisme? -->
                                    <div class="mb-3 border-top pt-2">
                                        <label class="form-label fw-semibold small text-dark mb-2">2. Apakah terdapat gangguan metabolisme?</label>
                                        <div class="row g-2 ms-1" style="font-size: 12px;">
                                            <div class="col-md-4">
                                                <div class="form-check">
                                                    <input class="form-check-input cb-obgyn" type="checkbox" value="DM" id="cb_obgyn_dm">
                                                    <label class="form-check-label" for="cb_obgyn_dm">DM</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check">
                                                    <input class="form-check-input cb-obgyn" type="checkbox" value="Gangguan fungsi kronis" id="cb_obgyn_gangguan">
                                                    <label class="form-check-label" for="cb_obgyn_gangguan">Gangguan fungsi kronis</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check">
                                                    <input class="form-check-input cb-obgyn" type="checkbox" value="Infeksi kronis" id="cb_obgyn_infeksi">
                                                    <label class="form-check-label" for="cb_obgyn_infeksi">Infeksi kronis</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check">
                                                    <input class="form-check-input cb-obgyn" type="checkbox" value="TB" id="cb_obgyn_tb">
                                                    <label class="form-check-label" for="cb_obgyn_tb">TB</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check">
                                                    <input class="form-check-input cb-obgyn" type="checkbox" value="HIV/AIDS" id="cb_obgyn_hiv">
                                                    <label class="form-check-label" for="cb_obgyn_hiv">HIV/AIDS</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check">
                                                    <input class="form-check-input cb-obgyn" type="checkbox" value="Lainnya" id="cb_obgyn_lainnya">
                                                    <label class="form-check-label" for="cb_obgyn_lainnya">Lainnya</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check">
                                                    <input class="form-check-input cb-obgyn" type="checkbox" value="Tidak ada" id="cb_obgyn_tidak" checked>
                                                    <label class="form-check-label text-muted" for="cb_obgyn_tidak">Tidak ada</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- 3 & 4 Side by side -->
                                    <div class="row border-top pt-2">
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label fw-semibold small text-dark mb-2">3. Ada kenaikan BB kurang/lebih saat hamil?</label>
                                            <div class="d-flex gap-3 ms-2">
                                                <div class="form-check">
                                                    <input class="form-check-input q-obgyn-radio" type="radio" name="q_obgyn_3" id="q_obgyn_3_ya" value="Ya">
                                                    <label class="form-check-label text-success fw-bold" for="q_obgyn_3_ya">Ya</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input q-obgyn-radio" type="radio" name="q_obgyn_3" id="q_obgyn_3_tidak" value="Tidak" checked>
                                                    <label class="form-check-label text-secondary" for="q_obgyn_3_tidak">Tidak</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-2">
                                            <label class="form-label fw-semibold small text-dark mb-2">4. Nilai Hb < 11 g/dL atau HCT < 30%?</label>
                                            <div class="d-flex gap-3 ms-2">
                                                <div class="form-check">
                                                    <input class="form-check-input q-obgyn-radio" type="radio" name="q_obgyn_4" id="q_obgyn_4_ya" value="Ya">
                                                    <label class="form-check-label text-success fw-bold" for="q_obgyn_4_ya">Ya</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input q-obgyn-radio" type="radio" name="q_obgyn_4" id="q_obgyn_4_tidak" value="Tidak" checked>
                                                    <label class="form-check-label text-secondary" for="q_obgyn_4_tidak">Tidak</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <!-- PANEL PERTANYAAN ANAK -->
                                <div id="panelPertanyaanAnak">
                                    
                                    <!-- 1 & 2 Side by side -->
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold small text-dark mb-2">1. Apakah pasien tampak kurus?</label>
                                            <div class="d-flex gap-3 ms-2">
                                                <div class="form-check">
                                                    <input class="form-check-input q-anak-radio" type="radio" name="q_anak_1" id="q_anak_1_ya" value="Ya">
                                                    <label class="form-check-label text-success fw-bold" for="q_anak_1_ya">Ya</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input q-anak-radio" type="radio" name="q_anak_1" id="q_anak_1_tidak" value="Tidak" checked>
                                                    <label class="form-check-label text-secondary" for="q_anak_1_tidak">Tidak</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold small text-dark mb-2">2. Penurunan BB / Tidak ada peningkatan BB?</label>
                                            <div class="d-flex gap-3 ms-2">
                                                <div class="form-check">
                                                    <input class="form-check-input q-anak-radio" type="radio" name="q_anak_2" id="q_anak_2_ya" value="Ya">
                                                    <label class="form-check-label text-success fw-bold" for="q_anak_2_ya">Ya</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input q-anak-radio" type="radio" name="q_anak_2" id="q_anak_2_tidak" value="Tidak" checked>
                                                    <label class="form-check-label text-secondary" for="q_anak_2_tidak">Tidak</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- 3. Kondisi (Diare / Muntah / Asupan Kurang)? -->
                                    <div class="mb-3 border-top pt-2">
                                        <label class="form-label fw-semibold small text-dark mb-2">3. Kondisi (Diare / Muntah / Asupan Kurang)?</label>
                                        <div class="row g-2 ms-1" style="font-size: 12px;">
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input cb-anak1" type="checkbox" value="Diare > 5x/hari" id="cb_anak1_diare">
                                                    <label class="form-check-label" for="cb_anak1_diare">Diare > 5x/hari</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input cb-anak1" type="checkbox" value="Muntah >3x/hari" id="cb_anak1_muntah">
                                                    <label class="form-check-label" for="cb_anak1_muntah">Muntah >3x/hari</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input cb-anak1" type="checkbox" value="Asupan makanan berkurang" id="cb_anak1_asupan">
                                                    <label class="form-check-label" for="cb_anak1_asupan">Asupan makanan berkurang</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input cb-anak1" type="checkbox" value="Tidak ada" id="cb_anak1_tidak" checked>
                                                    <label class="form-check-label text-muted" for="cb_anak1_tidak">Tidak ada</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- 4. Penyakit beresiko malnutrisi? -->
                                    <div class="mb-3 border-top pt-2">
                                        <label class="form-label fw-semibold small text-dark mb-2">4. Penyakit beresiko malnutrisi?</label>
                                        <div class="row g-2 ms-1" style="font-size: 12px;">
                                            <div class="col-md-6">
                                                <div class="form-check mb-1">
                                                    <input class="form-check-input cb-anak2" type="checkbox" value="Diare kronik" id="cb_anak2_diare">
                                                    <label class="form-check-label" for="cb_anak2_diare">Diare kronik</label>
                                                </div>
                                                <div class="form-check mb-1">
                                                    <input class="form-check-input cb-anak2" type="checkbox" value="Retardasi mental" id="cb_anak2_retardasi">
                                                    <label class="form-check-label" for="cb_anak2_retardasi">Retardasi mental</label>
                                                </div>
                                                <div class="form-check mb-1">
                                                    <input class="form-check-input cb-anak2" type="checkbox" value="Gangguan psikiatrik" id="cb_anak2_psikiatrik">
                                                    <label class="form-check-label" for="cb_anak2_psikiatrik">Gangguan psikiatrik</label>
                                                </div>
                                                <div class="form-check mb-1">
                                                    <input class="form-check-input cb-anak2" type="checkbox" value="Trauma / Cidera berat" id="cb_anak2_trauma">
                                                    <label class="form-check-label" for="cb_anak2_trauma">Trauma / Cidera berat</label>
                                                </div>
                                                <div class="form-check mb-1">
                                                    <input class="form-check-input cb-anak2" type="checkbox" value="Penyakit jantung kronis" id="cb_anak2_jantung">
                                                    <label class="form-check-label" for="cb_anak2_jantung">Penyakit jantung kronis</label>
                                                </div>
                                                <div class="form-check mb-1">
                                                    <input class="form-check-input cb-anak2" type="checkbox" value="Penyakit ginjal kronis" id="cb_anak2_ginjal">
                                                    <label class="form-check-label" for="cb_anak2_ginjal">Penyakit ginjal kronis</label>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-check mb-1">
                                                    <input class="form-check-input cb-anak2" type="checkbox" value="TB Paru" id="cb_anak2_tb">
                                                    <label class="form-check-label" for="cb_anak2_tb">TB Paru</label>
                                                </div>
                                                <div class="form-check mb-1">
                                                    <input class="form-check-input cb-anak2" type="checkbox" value="Kelainan anatomi mulut" id="cb_anak2_mulut">
                                                    <label class="form-check-label" for="cb_anak2_mulut">Kelainan anatomi mulut</label>
                                                </div>
                                                <div class="form-check mb-1">
                                                    <input class="form-check-input cb-anak2" type="checkbox" value="Luka Bakar Luas" id="cb_anak2_bakar">
                                                    <label class="form-check-label" for="cb_anak2_bakar">Luka Bakar Luas</label>
                                                </div>
                                                <div class="form-check mb-1">
                                                    <input class="form-check-input cb-anak2" type="checkbox" value="Penyakit metabolisme (DM)" id="cb_anak2_dm">
                                                    <label class="form-check-label" for="cb_anak2_dm">Penyakit metabolisme (DM)</label>
                                                </div>
                                                <div class="form-check mb-1">
                                                    <input class="form-check-input cb-anak2" type="checkbox" value="Penyakit liver kronis" id="cb_anak2_liver">
                                                    <label class="form-check-label" for="cb_anak2_liver">Penyakit liver kronis</label>
                                                </div>
                                                <div class="form-check mb-1">
                                                    <input class="form-check-input cb-anak2" type="checkbox" value="Tidak ada" id="cb_anak2_tidak" checked>
                                                    <label class="form-check-label text-muted" for="cb_anak2_tidak">Tidak ada</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <!-- PERMINTAAN JENIS DIET -->
                                <div class="border-top pt-3 mt-3">
                                    <label class="form-label fw-bold text-success small mb-2">Permintaan Jenis Diet</label>
                                    <div class="d-flex flex-wrap gap-2" id="wrapperJenisDiet">
                                        <div class="form-check form-check-inline me-3">
                                            <input class="form-check-input" type="radio" name="jenis_diet" id="diet_nasi" value="Diet Nasi" checked>
                                            <label class="form-check-label text-success fw-semibold" for="diet_nasi">Diet Nasi</label>
                                        </div>
                                        <div class="form-check form-check-inline me-3">
                                            <input class="form-check-input" type="radio" name="jenis_diet" id="diet_bubur" value="Diet Bubur">
                                            <label class="form-check-label text-success fw-semibold" for="diet_bubur">Diet Bubur</label>
                                        </div>
                                        <div class="form-check form-check-inline me-3">
                                            <input class="form-check-input" type="radio" name="jenis_diet" id="diet_nasi_tim" value="Diet Nasi Tim">
                                            <label class="form-check-label text-success fw-semibold" for="diet_nasi_tim">Diet Nasi Tim</label>
                                        </div>
                                        <div class="form-check form-check-inline me-3">
                                            <input class="form-check-input" type="radio" name="jenis_diet" id="diet_cair" value="Diet Cair">
                                            <label class="form-check-label text-success fw-semibold" for="diet_cair">Diet Cair</label>
                                        </div>
                                        <div class="form-check form-check-inline me-3">
                                            <input class="form-check-input" type="radio" name="jenis_diet" id="diet_puasa" value="Puasa">
                                            <label class="form-check-label text-danger fw-semibold" for="diet_puasa">Puasa</label>
                                        </div>
                                        <div class="form-check form-check-inline me-3">
                                            <input class="form-check-input" type="radio" name="jenis_diet" id="diet_bubur_tim" value="Diet Bubur Tim">
                                            <label class="form-check-label text-success fw-semibold" for="diet_bubur_tim">Diet Bubur Tim</label>
                                        </div>
                                        <div class="form-check form-check-inline me-3">
                                            <input class="form-check-input" type="radio" name="jenis_diet" id="diet_bubur_saring" value="Diet Bubur Tim Saring">
                                            <label class="form-check-label text-success fw-semibold" for="diet_bubur_saring">Diet Bubur Tim Saring</label>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="skor" id="skrining_skor_val" value="0">
                                <input type="hidden" name="q_anak" id="skrining_q_anak" value="TIDAK,TIDAK">
                                <input type="hidden" name="q_obgyn" id="skrining_q_obgyn" value="TIDAK,TIDAK,TIDAK">
                                <input type="hidden" name="cb_obgyn" id="skrining_cb_obgyn" value="-">
                                <input type="hidden" name="cb_anak1" id="skrining_cb_anak1" value="-">
                                <input type="hidden" name="cb_anak2" id="skrining_cb_anak2" value="-">
                            </div>

                            <!-- DYNAMIC SKOR CARD -->
                            <div class="card border-0 rounded-3 p-3" id="cardSkorSkrining" style="background: #e8f5e9; border: 1px solid #c8e6c9 !important;">
                                <div class="row align-items-center">
                                    <div class="col-md-4 text-center border-end border-opacity-25" id="borderSkorDivider">
                                        <small class="fw-bold d-block mb-0" id="labelSkorTitle" style="font-size: 11px; color: #198754;">Skor Skrining</small>
                                        <span class="display-5 fw-bold" id="skrining_skor_display" style="color: #198754;">0</span>
                                        <small class="d-block fw-bold" id="skrining_keterangan_display" style="color: #198754;">Resiko Rendah</small>
                                    </div>
                                    <div class="col-md-8 ps-md-3">
                                        <div class="mb-2">
                                            <label class="form-label fw-bold text-dark small mb-1">Status Assesment Lanjut</label>
                                            <select class="form-select form-select-sm" id="skrining_status_assesment_lanjut" name="status_assesment_lanjut">
                                                <option value="Belum">Belum</option>
                                                <option value="Sudah">Sudah</option>
                                                <option value="Tidak">Tidak</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label class="form-label fw-bold text-dark small mb-1">Keterangan</label>
                                            <input type="text" class="form-control form-control-sm" id="skrining_keterangan" name="keterangan" placeholder="Keterangan tambahan...">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </form>

            </div>

            <!-- Modal Footer -->
            <div class="modal-footer py-2 px-3 bg-white justify-content-between">
                <div>
                    <button type="button" class="btn btn-primary btn-sm px-3 d-none" id="btnCetakSkriningGizi" onclick="cetakSkriningGizi($('#skrining_no_rawat').val())">
                        <i class="bi bi-printer me-1"></i> Cetak Skrining Gizi
                    </button>
                </div>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i> Batal
                    </button>
                    <button type="button" class="btn btn-success btn-sm px-3 fw-semibold" id="btnSimpanSkriningGizi">
                        <i class="bi bi-check-lg me-1"></i> Simpan Skrining Gizi
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

@push('script')
<script>
    let skriningOpenedFromDiet = false;

    // Open Modal Skrining Gizi
    function showModalSkriningGizi(noRawat, fromDiet = false) {
        if (!noRawat) return;

        skriningOpenedFromDiet = fromDiet;
        $('#skrining_no_rawat').val(noRawat);
        $('#btnCetakSkriningGizi').addClass('d-none');
        $('#formSkriningGizi')[0].reset();
        
        getRegPeriksa(noRawat).done(function(res) {
            const pasien = res?.pasien || {};
            $('#skrining_info_nm_pasien').text(pasien.nm_pasien || '-');
            $('#skrining_info_no_rawat').text(noRawat);

            // Load Existing Skrining Gizi Data
            $.get(`/erm/ranap/skrining-gizi?no_rawat=${encodeURIComponent(noRawat)}`).done(function(resp) {
                if (resp.success && resp.data) {
                    $('#btnCetakSkriningGizi').removeClass('d-none');
                    const d = resp.data;
                    $('#skrining_bb').val(d.bb || '');
                    $('#skrining_tb').val(d.tb || '');
                    $('#skrining_imt').val(d.imt || '');
                    $('#skrining_lila').val(d.lila || '');
                    $('#skrining_diagnosa_medis').val(d.diagnosa_medis || '');
                    $('#skrining_hb').val(d.hb || '');
                    setRadioByNameCaseInsensitive('hiv', d.hiv || 'Tidak Periksa');
                    setRadioByNameCaseInsensitive('hbsag', d.hbsag || 'Tidak Periksa');
                    setRadioByNameCaseInsensitive('syphilis', d.syphilis || 'Tidak Periksa');
                    $('#skrining_status_assesment_lanjut').val(d.status_assesment_lanjut || 'Belum');
                    $('#skrining_keterangan').val(d.keterangan || '');

                    if (d.jenis_diet) {
                        $(`input[name="jenis_diet"][value="${d.jenis_diet}"]`).prop('checked', true);
                    }

                    const kat = d.kategori || 'ANAK';
                    $(`input[name="kategori"][value="${kat}"]`).prop('checked', true).trigger('change');

                    // Set OBGYN values
                    if (kat === 'OBGYN') {
                        const qArr = (d.q_obgyn || '').split(',');
                        if (qArr[0]) setRadioByNameCaseInsensitive('q_obgyn_1', qArr[0]);
                        if (qArr[1]) setRadioByNameCaseInsensitive('q_obgyn_3', qArr[1]);
                        if (qArr[2]) setRadioByNameCaseInsensitive('q_obgyn_4', qArr[2]);

                        $('.cb-obgyn').prop('checked', false);
                        const cbObgyn = (d.cb_obgyn || '').split(',');
                        cbObgyn.forEach(val => {
                            const trimmed = val.trim();
                            $(`.cb-obgyn[value="${trimmed}"]`).prop('checked', true);
                        });
                        if ($('.cb-obgyn:checked').length === 0) $('#cb_obgyn_tidak').prop('checked', true);
                    } else {
                        // Set ANAK values
                        const qArr = (d.q_anak || '').split(',');
                        if (qArr[0]) setRadioByNameCaseInsensitive('q_anak_1', qArr[0]);
                        if (qArr[1]) setRadioByNameCaseInsensitive('q_anak_2', qArr[1]);

                        $('.cb-anak1').prop('checked', false);
                        const cbAnak1 = (d.cb_anak1 || '').split(',');
                        cbAnak1.forEach(val => {
                            const trimmed = val.trim();
                            $(`.cb-anak1[value="${trimmed}"]`).prop('checked', true);
                        });
                        if ($('.cb-anak1:checked').length === 0) $('#cb_anak1_tidak').prop('checked', true);

                        $('.cb-anak2').prop('checked', false);
                        const cbAnak2 = (d.cb_anak2 || '').split(',');
                        cbAnak2.forEach(val => {
                            const trimmed = val.trim();
                            $(`.cb-anak2[value="${trimmed}"]`).prop('checked', true);
                        });
                        if ($('.cb-anak2:checked').length === 0) $('#cb_anak2_tidak').prop('checked', true);
                    }
                } else {
                    $(`input[name="kategori"][value="ANAK"]`).prop('checked', true).trigger('change');
                }

                hitungImtDanSkorSkrining();
                $('#modalSkriningGizi').modal('show');
            });
        });
    }

    function setRadioByNameCaseInsensitive(name, val) {
        if (!val) return;
        const target = val.trim().toUpperCase();
        $(`input[name="${name}"]`).each(function() {
            if ($(this).val().trim().toUpperCase() === target) {
                $(this).prop('checked', true);
            }
        });
    }

    // Checkbox "Tidak ada" exclusive toggle logic
    $('.cb-obgyn').on('change', function() {
        if ($(this).attr('id') === 'cb_obgyn_tidak' && $(this).is(':checked')) {
            $('.cb-obgyn').not(this).prop('checked', false);
        } else if ($(this).is(':checked')) {
            $('#cb_obgyn_tidak').prop('checked', false);
        }
        hitungImtDanSkorSkrining();
    });

    $('.cb-anak1').on('change', function() {
        if ($(this).attr('id') === 'cb_anak1_tidak' && $(this).is(':checked')) {
            $('.cb-anak1').not(this).prop('checked', false);
        } else if ($(this).is(':checked')) {
            $('#cb_anak1_tidak').prop('checked', false);
        }
        hitungImtDanSkorSkrining();
    });

    $('.cb-anak2').on('change', function() {
        if ($(this).attr('id') === 'cb_anak2_tidak' && $(this).is(':checked')) {
            $('.cb-anak2').not(this).prop('checked', false);
        } else if ($(this).is(':checked')) {
            $('#cb_anak2_tidak').prop('checked', false);
        }
        hitungImtDanSkorSkrining();
    });

    // Toggle Kategori (ANAK / OBGYN)
    $('input[name="kategori"]').on('change', function() {
        const val = $(this).val();
        if (val === 'OBGYN') {
            $('#cardKategoriObgyn').addClass('border-success active').find('i').removeClass('text-secondary').addClass('text-success');
            $('#cardKategoriAnak').removeClass('border-success active').find('i').removeClass('text-success').addClass('text-secondary');
            $('#panelPertanyaanAnak').addClass('d-none');
            $('#panelPertanyaanObgyn').removeClass('d-none');

            // Tampilkan LILA untuk OBGYN (col-md-3)
            $('#wrapperLila').removeClass('d-none');
            $('#col_bb, #col_tb, #col_imt').removeClass('col-md-4').addClass('col-md-3');
        } else {
            $('#cardKategoriAnak').addClass('border-success active').find('i').removeClass('text-secondary').addClass('text-success');
            $('#cardKategoriObgyn').removeClass('border-success active').find('i').removeClass('text-success').addClass('text-secondary');
            $('#panelPertanyaanObgyn').addClass('d-none');
            $('#panelPertanyaanAnak').removeClass('d-none');

            // Sembunyikan LILA untuk ANAK (col-md-4)
            $('#wrapperLila').addClass('d-none');
            $('#skrining_lila').val('');
            $('#col_bb, #col_tb, #col_imt').removeClass('col-md-3').addClass('col-md-4');
        }
        hitungImtDanSkorSkrining();
    });

    // Auto Calculate IMT & Skor
    $('#skrining_bb, #skrining_tb, .q-obgyn-radio, .q-anak-radio').on('input change', function() {
        hitungImtDanSkorSkrining();
    });

    function hitungImtDanSkorSkrining() {
        const bb = parseFloat($('#skrining_bb').val()) || 0;
        const tb = parseFloat($('#skrining_tb').val()) || 0;
        
        let imt = 0;
        if (bb > 0 && tb > 0) {
            const tbM = tb / 100;
            imt = (bb / (tbM * tbM)).toFixed(2);
        }
        $('#skrining_imt').val(imt);

        const kat = $('input[name="kategori"]:checked').val();
        let skor = 0;
        let ket = 'Resiko Rendah';

        if (kat === 'OBGYN') {
            const q1 = $('input[name="q_obgyn_1"]:checked').val() || 'Tidak';
            const q3 = $('input[name="q_obgyn_3"]:checked').val() || 'Tidak';
            const q4 = $('input[name="q_obgyn_4"]:checked').val() || 'Tidak';

            if (q1.toUpperCase() === 'YA') skor += 1;

            let cbVals = [];
            $('.cb-obgyn:checked').each(function() {
                const v = $(this).val();
                if (v !== 'Tidak ada') cbVals.push(v);
            });
            if (cbVals.length > 0) skor += 1;

            if (q3.toUpperCase() === 'YA') skor += 1;
            if (q4.toUpperCase() === 'YA') skor += 1;

            // OBGYN: Jika skor >= 1 -> "Asesmen Lanjut oleh Ahli Gizi", jika 0 -> "Resiko Rendah"
            ket = skor >= 1 ? 'Asesmen Lanjut oleh Ahli Gizi' : 'Resiko Rendah';

            const allCb = [];
            $('.cb-obgyn:checked').each(function() { allCb.push($(this).val()); });
            $('#skrining_cb_obgyn').val(allCb.length > 0 ? allCb.join(', ') : '-');
            $('#skrining_q_obgyn').val(`${q1.toUpperCase()},${q3.toUpperCase()},${q4.toUpperCase()}`);

        } else {
            // ANAK
            const q1 = $('input[name="q_anak_1"]:checked').val() || 'Tidak';
            const q2 = $('input[name="q_anak_2"]:checked').val() || 'Tidak';

            if (q1.toUpperCase() === 'YA') skor += 1;
            if (q2.toUpperCase() === 'YA') skor += 1;

            let cb1Vals = [];
            $('.cb-anak1:checked').each(function() {
                const v = $(this).val();
                if (v !== 'Tidak ada') cb1Vals.push(v);
            });
            if (cb1Vals.length > 0) skor += 1;

            let cb2Vals = [];
            $('.cb-anak2:checked').each(function() {
                const v = $(this).val();
                if (v !== 'Tidak ada') cb2Vals.push(v);
            });
            if (cb2Vals.length > 0) skor += 2;

            // ANAK: 0 = Resiko Rendah, 1-3 = Resiko Sedang, >=4 = Resiko Tinggi
            if (skor === 0) {
                ket = 'Resiko Rendah';
            } else if (skor >= 1 && skor <= 3) {
                ket = 'Resiko Sedang';
            } else {
                ket = 'Resiko Tinggi';
            }

            const allCb1 = [];
            $('.cb-anak1:checked').each(function() { allCb1.push($(this).val()); });
            $('#skrining_cb_anak1').val(allCb1.length > 0 ? allCb1.join(', ') : '-');

            const allCb2 = [];
            $('.cb-anak2:checked').each(function() { allCb2.push($(this).val()); });
            $('#skrining_cb_anak2').val(allCb2.length > 0 ? allCb2.join(', ') : '-');

            $('#skrining_q_anak').val(`${q1.toUpperCase()},${q2.toUpperCase()}`);
        }

        $('#skrining_skor_val').val(skor);
        $('#skrining_skor_display').text(skor);
        $('#skrining_keterangan_display').text(ket);
        $('#skrining_keterangan').val(ket);

        // Dynamic Color Styling based on Risk Level
        const card = $('#cardSkorSkrining');
        const titleLbl = $('#labelSkorTitle');
        const numDisp = $('#skrining_skor_display');
        const ketDisp = $('#skrining_keterangan_display');

        if (ket === 'Resiko Tinggi') {
            card.css({ 'background': '#ffebee', 'border': '1px solid #ffcdd2' });
            titleLbl.css('color', '#dc3545');
            numDisp.css('color', '#dc3545');
            ketDisp.css('color', '#dc3545');
        } else if (ket === 'Resiko Sedang') {
            card.css({ 'background': '#fff8e1', 'border': '1px solid #ffe082' });
            titleLbl.css('color', '#b78103');
            numDisp.css('color', '#d97706');
            ketDisp.css('color', '#b78103');
        } else if (ket === 'Asesmen Lanjut oleh Ahli Gizi') {
            card.css({ 'background': '#e0f2fe', 'border': '1px solid #bae6fd' });
            titleLbl.css('color', '#0284c7');
            numDisp.css('color', '#0284c7');
            ketDisp.css('color', '#0284c7');
        } else {
            // Resiko Rendah
            card.css({ 'background': '#e8f5e9', 'border': '1px solid #c8e6c9' });
            titleLbl.css('color', '#198754');
            numDisp.css('color', '#198754');
            ketDisp.css('color', '#198754');
        }
    }

    // Submit Simpan Skrining Gizi
    $('#btnSimpanSkriningGizi').on('click', function(e) {
        e.preventDefault();

        const noRawat = $('#skrining_no_rawat').val();
        const bb = $('#skrining_bb').val();
        const tb = $('#skrining_tb').val();
        const diagnosa = $('#skrining_diagnosa_medis').val();

        if (!noRawat || !bb || !tb || !diagnosa) {
            Swal.fire('Peringatan', 'Berat Badan, Tinggi Badan, dan Diagnosa Medis wajib diisi.', 'warning');
            return;
        }

        const formData = $('#formSkriningGizi').serialize();

        $.post('/erm/ranap/skrining-gizi', formData).done(function(res) {
            if (res.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: res.message,
                    timer: 1500,
                    showConfirmButton: false
                });
                $('#modalSkriningGizi').modal('hide');
                if (typeof tb_ranap !== 'undefined') {
                    tb_ranap.draw(false);
                }

                if (skriningOpenedFromDiet) {
                    setTimeout(function() {
                        showModalPermintaanDiet(noRawat);
                    }, 350);
                }
            } else {
                Swal.fire('Gagal', res.message || 'Gagal menyimpan data.', 'error');
            }
        }).fail(function(xhr) {
            const msg = xhr.responseJSON?.message || 'Terjadi kesalahan sistem.';
            Swal.fire('Error', msg, 'error');
        });
    });

    function cetakSkriningGizi(noRawat) {
        if (!noRawat) return;
        window.open(`${url}/ranap/skrining-gizi/cetak?no_rawat=${encodeURIComponent(noRawat)}`, '_blank');
    }
</script>
@endpush
