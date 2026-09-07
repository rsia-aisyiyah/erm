<!-- Modal Form Triase Pre-Registrasi UGD -->
<div class="modal fade" id="modalTriasePreReg" tabindex="-1" aria-labelledby="modalTriasePreRegLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white py-2 d-flex flex-column align-items-stretch">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <h5 class="modal-title fs-6 fw-bold" id="modalTriasePreRegLabel">
                        <i class="bi bi-diagram-3-fill me-2"></i> TRIASE PRE-REGISTRASI UGD (SEBELUM PENDAFTARAN)
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Nav Tabs Navigasi Form & Riwayat -->
                <ul class="nav nav-tabs card-header-tabs mt-2 border-bottom-0" id="tabTriasePreRegNav" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active bg-white text-danger fw-bold py-1 px-3 text-xs" id="nav-form-tab" data-bs-toggle="tab" data-bs-target="#nav-form-prereg" type="button" role="tab">
                            <i class="bi bi-plus-circle me-1"></i> Form Input / Edit Triase
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link text-white fw-bold py-1 px-3 text-xs" id="nav-list-tab" data-bs-toggle="tab" data-bs-target="#nav-list-prereg" type="button" role="tab" onclick="loadRiwayatTriasePreReg()">
                            <i class="bi bi-journal-text me-1"></i> Riwayat & Edit Data Triase
                        </button>
                    </li>
                </ul>
            </div>

            <div class="modal-body bg-light">
                <div class="tab-content" id="tabTriasePreRegContent">
                    
                    <!-- TAB 1: FORM INPUT / EDIT TRIASE -->
                    <div class="tab-pane fade show active" id="nav-form-prereg" role="tabpanel">
                        <form id="formTriasePreReg">
                            @csrf
                            <input type="hidden" name="id_triase" id="id_triase_prereg_hidden" value="">

                            <!-- Banner Edit Mode (Muncul saat edit) -->
                            <div class="alert alert-warning py-2 px-3 mb-3 text-xs d-none" id="bannerEditTriasePreReg">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <i class="bi bi-pencil-square me-1"></i> <strong>Modus Edit:</strong> Mengubah Data Triase <span class="fw-bold" id="lblEditIdTriase"></span>
                                    </div>
                                    <button type="button" class="btn btn-xs btn-outline-dark py-0" onclick="batalEditTriasePreReg()">
                                        <i class="bi bi-x-lg me-1"></i> Batal Edit (Input Baru)
                                    </button>
                                </div>
                            </div>

                            <!-- Identitas Pasien Sementara -->
                            <div class="card mb-3 border-0 shadow-sm">
                                <div class="card-header bg-white py-2 fw-bold text-danger">
                                    <i class="bi bi-person-lines-fill me-1"></i> 1. IDENTITAS TEMPORARY PASIEN
                                </div>
                                <div class="card-body">
                                    <div class="row g-2">
                                        <div class="col-md-6">
                                            <label class="form-label text-xs fw-bold">Nama Pasien / Anonim <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-sm" name="nama_pasien_temp" placeholder="Contoh: Mr. X / Ms. Y / Ny. Anita" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label text-xs fw-bold">Jenis Kelamin</label>
                                            <select class="form-select form-select-sm" name="jk">
                                                <option value="L">Laki-Laki (L)</option>
                                                <option value="P">Perempuan (P)</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label text-xs fw-bold">Estimasi Umur</label>
                                            <input type="text" class="form-control form-control-sm" name="umur_temp" placeholder="Contoh: ~30 Th / Bayi">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label text-xs fw-bold">Cara Masuk</label>
                                            <select class="form-select form-select-sm" name="cara_masuk">
                                                <option value="Sendiri">Sendiri</option>
                                                <option value="Rujukan">Rujukan Faskes</option>
                                                <option value="Dikirim Polisi">Dikirim Polisi</option>
                                                <option value="Lain-lain">Lain-lain</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label text-xs fw-bold">Alat Transportasi</label>
                                            <select class="form-select form-select-sm" name="alat_transportasi">
                                                <option value="Kendaraan Pribadi">Kendaraan Pribadi</option>
                                                <option value="Ambulans RSIA">Ambulans RSIA</option>
                                                <option value="Ambulans Luar">Ambulans Luar</option>
                                                <option value="Lain-lain">Lain-lain</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label text-xs fw-bold">Alasan Kedatangan</label>
                                            <select class="form-select form-select-sm" name="alasan_kedatangan">
                                                <option value="Penyakit Non Trauma">Penyakit Non Trauma</option>
                                                <option value="Trauma / Kecelakaan">Trauma / Kecelakaan</option>
                                                <option value="Kebidanan / Ginekologi">Kebidanan / Ginekologi</option>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label text-xs fw-bold">Keluhan Utama / Alasan Datang</label>
                                            <textarea class="form-control form-control-sm" name="keterangan_kedatangan" rows="2" placeholder="Tuliskan keluhan utama pasien saat tiba di UGD..."></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Pemeriksaan Fisik & TTV -->
                            <div class="card mb-3 border-0 shadow-sm">
                                <div class="card-header bg-white py-2 fw-bold text-danger">
                                    <i class="bi bi-activity me-1"></i> 2. TANDA VITAL (TTV) & FISIK
                                </div>
                                <div class="card-body">
                                    <div class="row g-2">
                                        <div class="col-md-2">
                                            <label class="form-label text-xs fw-bold">TD (mmHg)</label>
                                            <input type="text" class="form-control form-control-sm" name="tekanan_darah" placeholder="120/80">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label text-xs fw-bold">Nadi (x/m)</label>
                                            <input type="text" class="form-control form-control-sm" name="nadi" placeholder="80">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label text-xs fw-bold">RR (x/m)</label>
                                            <input type="text" class="form-control form-control-sm" name="pernapasan" placeholder="20">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label text-xs fw-bold">Suhu (°C)</label>
                                            <input type="text" class="form-control form-control-sm" name="suhu" placeholder="36.5">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label text-xs fw-bold">SpO2 (%)</label>
                                            <input type="text" class="form-control form-control-sm" name="saturasi_o2" placeholder="98">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label text-xs fw-bold">GCS (E,V,M)</label>
                                            <input type="text" class="form-control form-control-sm" name="gcs" placeholder="15">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Skala Triase ATS (Tabel Matrix Indikator Lengkap) -->
                            <div class="card mb-3 border-0 shadow-sm">
                                <div class="card-header bg-white py-2 fw-bold text-danger">
                                    <i class="bi bi-diagram-3-fill me-1"></i> 3. TRIASE ( AUSTRALIAN TRIAGE SCALE )
                                </div>
                                <div class="card-body p-0 table-responsive">
                                    <div class="table-responsive mb-3">
                                        <table class="table table-bordered table-striped table-hover tblTriasePreReg mb-0 w-100" style="font-size:11px;" width="100%">
                                            <thead>
                                                <tr>
                                                    <th class="all">
                                                        <div class="text-nowrap">Prioritas</div>
                                                        <div class="text-xs text-nowrap">Waktu Tunggu</div>
                                                    </th>
                                                    <th class="text-center text-nowrap bg-danger text-white">
                                                        <div class="text-nowrap d-flex align-items-center justify-content-center">
                                                            <input type="checkbox" class="form-check-input me-2" name="ats_prereg_1" id="ats_prereg_1" onchange="onHeaderAtsChange(1)">
                                                            <span class="mt-1">ATS I</span>
                                                        </div>
                                                        <div class="text-xs text-nowrap">Segera</div>
                                                    </th>
                                                    <th class="text-center bg-warning text-dark">
                                                        <div class="text-nowrap d-flex align-items-center justify-content-center">
                                                            <input type="checkbox" class="form-check-input me-2" name="ats_prereg_2" id="ats_prereg_2" onchange="onHeaderAtsChange(2)">
                                                            <span class="mt-1">ATS II</span>
                                                        </div>
                                                        <div class="text-xs text-nowrap">10 Menit</div>
                                                    </th>
                                                    <th class="text-center bg-warning text-dark">
                                                        <div class="text-nowrap d-flex align-items-center justify-content-center">
                                                            <input type="checkbox" class="form-check-input me-2" name="ats_prereg_3" id="ats_prereg_3" onchange="onHeaderAtsChange(3)">
                                                            <span class="mt-1">ATS III</span>
                                                        </div>
                                                        <div class="text-xs text-nowrap">30 Menit</div>
                                                    </th>
                                                    <th class="text-center bg-success text-white">
                                                        <div class="text-nowrap d-flex align-items-center justify-content-center">
                                                            <input type="checkbox" class="form-check-input me-2" name="ats_prereg_4" id="ats_prereg_4" onchange="onHeaderAtsChange(4)">
                                                            <span class="mt-1">ATS IV</span>
                                                        </div>
                                                        <div class="text-xs text-nowrap">60 Menit</div>
                                                    </th>
                                                    <th class="text-center bg-success text-white">
                                                        <div class="text-nowrap d-flex align-items-center justify-content-center">
                                                            <input type="checkbox" class="form-check-input me-2" name="ats_prereg_5" id="ats_prereg_5" onchange="onHeaderAtsChange(5)">
                                                            <span class="mt-1">ATS V</span>
                                                        </div>
                                                        <div class="text-xs text-nowrap">120 Menit</div>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>

                                    <div class="row g-2 mb-2 p-2 bg-white rounded border m-2">
                                        <div class="col-md-6">
                                            <label class="form-label text-xs fw-bold">Hasil Skala Utama ATS <span class="text-danger">*</span></label>
                                            <select class="form-select form-select-sm fw-bold" name="skala_triase" id="skala_triase_select" required>
                                                <option value="" selected disabled>-- Pilih Skala Utama ATS --</option>
                                                <option value="1">ATS I - Resusitasi (Segera / Red Zone)</option>
                                                <option value="2">ATS II - Emergency (Waktu Tunggu < 10 Menit)</option>
                                                <option value="3">ATS III - Urgent (Waktu Tunggu < 30 Menit)</option>
                                                <option value="4">ATS IV - Semi-Urgent (Waktu Tunggu < 60 Menit)</option>
                                                <option value="5">ATS V - Non-Urgent (Waktu Tunggu < 120 Menit)</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label text-xs fw-bold">Kategori Warna Triase <span class="text-danger">*</span></label>
                                            <select class="form-select form-select-sm fw-bold" name="kategori_triase" id="kategori_triase_select" required>
                                                <option value="" selected disabled>-- Pilih Kategori Warna Triase --</option>
                                                <option value="MERAH">MERAH (Emergency / Resusitasi)</option>
                                                <option value="KUNING">KUNING (Urgent / Membutuhkan Penanganan Segera)</option>
                                                <option value="HIJAU">HIJAU (Non-Urgent / Rawat Jalan)</option>
                                                <option value="HITAM">HITAM (Meninggal / DOA)</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- TAB 2: RIWAYAT & EDIT DATA TRIASE PRE-REGISTRASI -->
                    <div class="tab-pane fade" id="nav-list-prereg" role="tabpanel">
                        <div class="card border-0 shadow-sm mb-2">
                            <div class="card-body p-2">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div class="fw-bold text-danger text-xs">
                                        <i class="bi bi-list-stars me-1"></i> DAFTAR RIWAYAT TRIASE PRE-REGISTRASI (LATEST 50 DATA)
                                    </div>
                                    <div class="w-50">
                                        <input type="text" class="form-control form-control-sm" id="searchTriasePreRegList" placeholder="Cari Nama Pasien / ID Triase / No. Rawat..." onkeyup="loadRiwayatTriasePreReg()">
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm table-striped table-hover text-xs mb-0" id="tblRiwayatTriasePreReg">
                                        <thead class="table-danger text-nowrap text-center">
                                            <tr>
                                                <th>ID Triase & Waktu</th>
                                                <th>Nama Pasien (Temp)</th>
                                                <th>JK / Umur</th>
                                                <th>Keluhan Utama</th>
                                                <th>Skala ATS & Warna</th>
                                                <th>Status Tautan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbodyRiwayatTriasePreReg">
                                            <tr><td colspan="7" class="text-center py-3 text-muted">Memuat data triase...</td></tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="modal-footer bg-white py-2">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><i class="bi bi-x-lg me-1"></i> Batal</button>
                <button type="button" class="btn btn-danger btn-sm fw-bold" id="btnSimpanTriasePreReg" onclick="simpanTriasePreReg()"><i class="bi bi-check-lg me-1"></i> Simpan Triase Pre-Registrasi</button>
            </div>
        </div>
    </div>
</div>
