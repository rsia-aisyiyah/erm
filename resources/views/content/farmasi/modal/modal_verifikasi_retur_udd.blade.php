<!-- Modal Review & Verifikasi Pengembalian Sisa Obat UDD (Farmasi) -->
<div class="modal fade" id="modalVerifikasiReturUdd" tabindex="-1" aria-labelledby="modalVerifikasiReturUddLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" style="z-index: 1060;">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow">
            
            <!-- Modal Header -->
            <div class="modal-header text-white py-2 px-3 justify-content-between align-items-center" style="background: linear-gradient(135deg, #fd7e14 0%, #d65b00 100%);">
                <div class="d-flex align-items-center gap-2">
                    <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center" style="width: 34px; height: 34px;">
                        <i class="bi bi-box-arrow-in-down-left fs-5 text-white"></i>
                    </div>
                    <div>
                        <h6 class="modal-title fw-bold mb-0 text-white" id="modalVerifikasiReturUddLabel">
                            VERIFIKASI &amp; PENERIMAAN FISIK SISA OBAT PASIEN (FARMASI)
                        </h6>
                        <small class="text-white-50" style="font-size: 11px;">Pengecekan fisik obat sisa loker pasien ranap &amp; pengembalian ke stok Depo Farmasi</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body p-3 bg-light">
                
                <!-- Info Pengajuan Banner -->
                <div class="card border-0 shadow-sm rounded-3 mb-3 bg-white">
                    <div class="card-body p-2.5">
                        <div class="row g-2 align-items-center" style="font-size: 11.5px;">
                            <div class="col-md-3 col-6">
                                <label class="text-muted small mb-0 d-block" style="font-size: 10px;">NO. RETUR UDD</label>
                                <strong class="text-primary font-monospace" id="v_retur_udd_nomor">-</strong>
                            </div>
                            <div class="col-md-3 col-6">
                                <label class="text-muted small mb-0 d-block" style="font-size: 10px;">WAKTU PENGAJUAN</label>
                                <span class="text-dark" id="v_retur_udd_waktu">-</span>
                            </div>
                            <div class="col-md-3 col-6">
                                <label class="text-muted small mb-0 d-block" style="font-size: 10px;">PASIEN</label>
                                <strong class="text-dark" id="v_retur_udd_nm_pasien">-</strong>
                                <small class="text-muted font-monospace" id="v_retur_udd_no_rkm_medis"></small>
                            </div>
                            <div class="col-md-3 col-6">
                                <label class="text-muted small mb-0 d-block" style="font-size: 10px;">RUANGAN / KAMAR</label>
                                <strong class="text-dark" id="v_retur_udd_kamar">-</strong>
                            </div>
                            <div class="col-md-3 col-6">
                                <label class="text-muted small mb-0 d-block" style="font-size: 10px;">PETUGAS RUANGAN</label>
                                <span class="text-dark" id="v_retur_udd_petugas_ruangan">-</span>
                            </div>
                            <div class="col-md-3 col-6">
                                <label class="text-muted small mb-0 d-block" style="font-size: 10px;">ALASAN PENGEMBALIAN</label>
                                <strong class="text-dark" id="v_retur_udd_alasan">-</strong>
                            </div>
                            <div class="col-md-3 col-6">
                                <label class="text-muted small mb-0 d-block" style="font-size: 10px;">STATUS SAAT INI</label>
                                <span class="badge bg-warning text-dark px-2 py-1" id="v_retur_udd_badge_status">Menunggu Diterima</span>
                            </div>
                            <div class="col-md-3 col-6">
                                <label class="text-muted small mb-0 d-block" style="font-size: 10px;">CATATAN RUANGAN</label>
                                <span class="text-secondary fst-italic" id="v_retur_udd_catatan_ruangan">-</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabel Item Obat yang Dikembalikan -->
                <div class="card border-0 shadow-sm rounded-3 mb-3 bg-white">
                    <div class="card-header bg-white border-bottom py-2 d-flex justify-content-between align-items-center">
                        <span class="fw-bold small text-secondary">
                            <i class="bi bi-capsule text-primary me-1"></i> Rincian Fisik Obat Sisa UDD
                        </span>
                        <small class="text-muted" style="font-size: 11px;">
                            Periksa kondisi kemasan fisik obat sebelum menyetujui penerimaan ke stok depo.
                        </small>
                    </div>
                    <div class="card-body p-2">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-sm align-middle mb-0" style="font-size: 11.5px;">
                                <thead class="table-light text-center">
                                    <tr>
                                        <th width="4%">No</th>
                                        <th width="12%">Kode Obat</th>
                                        <th class="text-start" width="30%">Nama Obat</th>
                                        <th width="8%">Satuan</th>
                                        <th width="12%">Jml Diajukan</th>
                                        <th width="14%">Jml Diterima Masuk Rak</th>
                                        <th width="20%">Catatan / Kondisi Fisik</th>
                                    </tr>
                                </thead>
                                <tbody id="v_retur_udd_tbody_items">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Input Catatan Farmasi -->
                <div class="card border-0 shadow-sm rounded-3 bg-white" id="v_retur_udd_card_catatan_farmasi">
                    <div class="card-body p-2.5">
                        <label class="form-label small fw-bold mb-1" style="font-size: 11px;">
                            <i class="bi bi-chat-left-text text-primary me-1"></i> Catatan Petugas Farmasi (Opsional)
                        </label>
                        <input type="text" class="form-control form-control-sm" id="v_retur_udd_input_catatan_farmasi" placeholder="Contoh: Fisik 4 blister utuh diterima di Depo RM...">
                    </div>
                </div>

            </div>

            <!-- Modal Footer -->
            <div class="modal-footer py-2 px-3 bg-white d-flex justify-content-between align-items-center">
                <div>
                    <button type="button" class="btn btn-outline-primary btn-sm px-3" id="v_retur_udd_btn_cetak" style="display: none;">
                        <i class="bi bi-printer me-1"></i> Cetak Bukti Serah Terima
                    </button>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-outline-danger btn-sm px-3" id="v_retur_udd_btn_tolak" onclick="submitVerifikasiReturUdd('tolak')">
                        <i class="bi bi-x-circle me-1"></i> Tolak Pengembalian
                    </button>
                    <button type="button" class="btn btn-success btn-sm px-3 fw-semibold shadow-sm" id="v_retur_udd_btn_terima" onclick="submitVerifikasiReturUdd('terima')">
                        <i class="bi bi-check-circle me-1"></i> Terima &amp; Masukkan ke Stok Depo
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>
