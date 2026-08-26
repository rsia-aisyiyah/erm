<!-- Modal Form Triase Pre-Registrasi UGD -->
<div class="modal fade" id="modalTriasePreReg" tabindex="-1" aria-labelledby="modalTriasePreRegLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
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

                    <!-- Skala Triase ATS -->
                    <div class="card mb-3 border-0 shadow-sm">
                        <div class="card-header bg-white py-2 fw-bold text-danger">
                            <i class="bi bi-shield-exclamation me-1"></i> 3. HASIL HASIL TRIASE (ATS / AUSTRALIAN TRIAGE SCALE)
                        </div>
                        <div class="card-body">
                            <div class="row g-2 mb-3">
                                <div class="col-md-6">
                                    <label class="form-label text-xs fw-bold">Skala Utama ATS <span class="text-danger">*</span></label>
                                    <select class="form-select form-select-sm" name="skala_triase" id="skala_triase_select" required>
                                        <option value="1">ATS I - Resusitasi (Segera / Red Zone)</option>
                                        <option value="2">ATS II - Emergency (Waktu Tunggu < 10 Menit)</option>
                                        <option value="3" selected>ATS III - Urgent (Waktu Tunggu < 30 Menit)</option>
                                        <option value="4">ATS IV - Semi-Urgent (Waktu Tunggu < 60 Menit)</option>
                                        <option value="5">ATS V - Non-Urgent (Waktu Tunggu < 120 Menit)</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-xs fw-bold">Kategori Warna Triase <span class="text-danger">*</span></label>
                                    <select class="form-select form-select-sm" name="kategori_triase" id="kategori_triase_select" required>
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
