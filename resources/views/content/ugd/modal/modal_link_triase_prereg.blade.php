<!-- Modal Penautan (Linking) Triase Pre-Registrasi -->
<div class="modal fade" id="modalLinkTriasePreReg" tabindex="-1" aria-labelledby="modalLinkTriasePreRegLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white py-2">
                <h5 class="modal-title fs-6 fw-bold" id="modalLinkTriasePreRegLabel">
                    <i class="bi bi-link-45deg me-1"></i> TAUTKAN TRIASE PRE-REGISTRASI DENGAN REGISTRASI PASIEN
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-light">
                <!-- Info Pasien SIMRS Terpilih -->
                <div class="card mb-3 border-primary shadow-sm">
                    <div class="card-header bg-primary text-white py-1.5 fw-bold text-xs">
                        <i class="bi bi-person-badge-fill me-1"></i> DATA REGISTRASI PASIEN (SIMRS KHANZA)
                    </div>
                    <div class="card-body p-2">
                        <div class="row g-2 text-xs">
                            <div class="col-md-3">
                                <strong>No. Rawat:</strong> <span id="link_simrs_no_rawat" class="badge bg-secondary">-</span>
                            </div>
                            <div class="col-md-3">
                                <strong>No. RM:</strong> <span id="link_simrs_no_rkm_medis" class="fw-bold text-primary">-</span>
                            </div>
                            <div class="col-md-3">
                                <strong>Nama Pasien:</strong> <span id="link_simrs_nm_pasien" class="fw-bold text-dark">-</span>
                            </div>
                            <div class="col-md-3">
                                <strong>Jenis Kelamin & Umur:</strong> <span id="link_simrs_jk_umur" class="fw-bold text-dark">-</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Alert Warning Jika Mismatch -->
                <div id="alertLinkMismatch" class="alert alert-danger py-2 px-3 mb-3 text-xs d-none border-2 border-danger shadow-sm">
                    <i class="bi bi-exclamation-triangle-fill me-1 fs-6"></i> <strong>PERINGATAN KESELAMATAN (SAFETY WARNING):</strong>
                    <span id="textLinkMismatch">Terdeteksi ketidakcocokan jenis kelamin antara data Registrasi dan data Triase Pre-Reg. Mohon periksa kembali sebelum menghubungkan!</span>
                </div>

                <!-- Daftar Triase Pre-Reg Active Unlinked -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-2 fw-bold text-dark d-flex align-items-center justify-content-between">
                        <div><i class="bi bi-list-ul me-1 text-danger"></i> PILIH DATA TRIASE PRE-REGISTRASI (UNLINKED)</div>
                        <div class="w-25">
                            <input type="text" class="form-control form-control-sm" id="searchUnlinkedTriase" placeholder="Cari nama / ID triase..." onkeyup="loadUnlinkedTriaseList()">
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive" style="max-height: 320px;">
                            <table class="table table-hover table-striped align-middle mb-0 text-xs" id="tableUnlinkedTriase">
                                <thead class="table-light sticky-top">
                                    <tr>
                                        <th class="text-center" width="5%">Pilih</th>
                                        <th>ID Triase / Waktu</th>
                                        <th>Nama Pasien Temp</th>
                                        <th>JK & Umur</th>
                                        <th>Keluhan Utama</th>
                                        <th>TTV (TD/Nadi/Suhu/SpO2)</th>
                                        <th class="text-center">Skala ATS</th>
                                        <th>Petugas</th>
                                    </tr>
                                </thead>
                                <tbody id="tbodyUnlinkedTriase">
                                    <tr>
                                        <td colspan="8" class="text-center py-3 text-muted">Memuat data triase...</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-white py-2">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><i class="bi bi-x-lg me-1"></i> Batal</button>
                <button type="button" class="btn btn-primary btn-sm fw-bold" id="btnEksekusiLinkTriase" onclick="eksekusiLinkTriase()" disabled><i class="bi bi-link-45deg me-1"></i> Tautkan Data Triase Ini</button>
            </div>
        </div>
    </div>
</div>
