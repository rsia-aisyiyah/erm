<!-- Modal Form Triase Pre-Registrasi UGD -->
<div class="modal fade" id="modalTriasePreReg" tabindex="-1" aria-labelledby="modalTriasePreRegLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white py-2">
                <h5 class="modal-title fs-6 fw-bold" id="modalTriasePreRegLabel">
                    <i class="bi bi-diagram-3-fill me-2"></i> TRIASE PRE-REGISTRASI UGD (SEBELUM PENDAFTARAN)
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-light">
                <form id="formTriasePreReg">
                    @csrf
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

                    <!-- Skala Triase ATS (Tabel Matrix Indikator Lengkap Persis Asmed) -->
                    <div class="card mb-3 border-0 shadow-sm">
                        <div class="card-header bg-white py-2 fw-bold text-danger">
                            <i class="bi bi-diagram-3-fill me-1"></i> 3. TRIASE ( AUSTRALIAN TRIAGE SCALE )
                        </div>
                        <div class="card-body p-2">
                            <div class="table-responsive mb-3">
                                <table class="table table-bordered table-striped table-hover tblTriasePreReg mb-0" style="font-size:11px;" width="100%">
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
                                            <th class="text-center bg-warning text-white">
                                                <div class="text-nowrap d-flex align-items-center justify-content-center">
                                                    <input type="checkbox" class="form-check-input me-2" name="ats_prereg_2" id="ats_prereg_2" onchange="onHeaderAtsChange(2)">
                                                    <span class="mt-1">ATS II</span>
                                                </div>
                                                <div class="text-xs text-nowrap">10 Menit</div>
                                            </th>
                                            <th class="text-center bg-success text-white">
                                                <div class="text-nowrap d-flex align-items-center justify-content-center">
                                                    <input type="checkbox" class="form-check-input me-2" name="ats_prereg_3" id="ats_prereg_3" onchange="onHeaderAtsChange(3)">
                                                    <span class="mt-1">ATS III</span>
                                                </div>
                                                <div class="text-xs text-nowrap">30 Menit</div>
                                            </th>
                                            <th class="text-center bg-primary text-white">
                                                <div class="text-nowrap d-flex align-items-center justify-content-center">
                                                    <input type="checkbox" class="form-check-input me-2" name="ats_prereg_4" id="ats_prereg_4" onchange="onHeaderAtsChange(4)">
                                                    <span class="mt-1">ATS IV</span>
                                                </div>
                                                <div class="text-xs text-nowrap">60 Menit</div>
                                            </th>
                                            <th class="text-center bg-secondary text-white">
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

                            <div class="row g-2 mb-2 p-2 bg-white rounded border">
                                <div class="col-md-6">
                                    <label class="form-label text-xs fw-bold">Hasil Skala Utama ATS <span class="text-danger">*</span></label>
                                    <select class="form-select form-select-sm fw-bold" name="skala_triase" id="skala_triase_select" required>
                                        <option value="1">ATS I - Resusitasi (Segera / Red Zone)</option>
                                        <option value="2">ATS II - Emergency (Waktu Tunggu < 10 Menit)</option>
                                        <option value="3" selected>ATS III - Urgent (Waktu Tunggu < 30 Menit)</option>
                                        <option value="4">ATS IV - Semi-Urgent (Waktu Tunggu < 60 Menit)</option>
                                        <option value="5">ATS V - Non-Urgent (Waktu Tunggu < 120 Menit)</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-xs fw-bold">Kategori Warna Triase <span class="text-danger">*</span></label>
                                    <select class="form-select form-select-sm fw-bold" name="kategori_triase" id="kategori_triase_select" required>
                                        <option value="MERAH">MERAH (Emergency / Resusitasi)</option>
                                        <option value="KUNING" selected>KUNING (Urgent / Membutuhkan Penanganan Segera)</option>
                                        <option value="HIJAU">HIJAU (Non-Urgent / Rawat Jalan)</option>
                                        <option value="HITAM">HITAM (Meninggal / DOA)</option>
                                    </select>
                                </div>
                            </div>

                            <div class="alert alert-info py-2 px-3 mb-0 text-xs">
                                <i class="bi bi-info-circle me-1"></i> <strong>Catatan:</strong> Data triase pre-registrasi ini akan otomatis tersimpan temporary dan siap di-link begitu pasien menyelesaikan pendaftaran di loket SIMRS.
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-white py-2">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><i class="bi bi-x-lg me-1"></i> Batal</button>
                <button type="button" class="btn btn-danger btn-sm fw-bold" id="btnSimpanTriasePreReg" onclick="simpanTriasePreReg()"><i class="bi bi-check-lg me-1"></i> Simpan Triase Pre-Registrasi</button>
            </div>
        </div>
    </div>
</div>
