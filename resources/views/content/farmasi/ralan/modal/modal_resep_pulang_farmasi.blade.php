<!-- Modal Detail & Validasi Permintaan Resep Pulang (Sesuai Khanza DlgDaftarPermintaanResep Tab 4) -->
<div class="modal fade" id="modalDetailResepPulangFarmasi" tabindex="-1" aria-labelledby="modalDetailResepPulangLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-gradient-primary text-white py-2" style="background: linear-gradient(135deg, #1e3a8a, #2563eb);">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-box-arrow-right fs-4"></i>
                    <div>
                        <h6 class="modal-title fw-bold mb-0 text-white" id="modalDetailResepPulangLabel">
                            VALIDASI PERMINTAAN RESEP OBAT PULANG
                        </h6>
                        <small class="text-white-50" style="font-size: 11px;">SIMRS Khanza Integration &bull; Billing Resep Pulang &amp; Pengurangan Stok Depo</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-3">
                <!-- Info Header Pasien & Permintaan -->
                <div class="card border-0 bg-light mb-3">
                    <div class="card-body p-2">
                        <div class="row g-2 align-items-center" style="font-size: 12.5px;">
                            <div class="col-md-3">
                                <span class="text-muted d-block" style="font-size: 11px;">No. Permintaan / Waktu:</span>
                                <strong class="text-primary font-monospace" id="fPulangNoPermintaan">-</strong>
                                <span class="d-block text-muted" id="fPulangTglJam" style="font-size: 11px;">-</span>
                            </div>
                            <div class="col-md-3">
                                <span class="text-muted d-block" style="font-size: 11px;">Pasien &amp; No. Rawat:</span>
                                <strong class="text-dark" id="fPulangPasien">-</strong>
                                <div class="font-monospace text-muted" id="fPulangNoRawat" style="font-size: 11px;">-</div>
                            </div>
                            <div class="col-md-3">
                                <span class="text-muted d-block" style="font-size: 11px;">Kamar / Dokter Peresep:</span>
                                <strong id="fPulangKamar">-</strong>
                                <span class="d-block text-muted" id="fPulangDokter" style="font-size: 11px;">-</span>
                            </div>
                            <div class="col-md-3 text-md-end">
                                <span class="text-muted d-block" style="font-size: 11px;">Status Validasi:</span>
                                <span id="fPulangStatusBadge"><span class="badge bg-secondary">-</span></span>
                                <div class="mt-1">
                                    <span class="badge bg-info-subtle text-info border border-info" style="font-size: 10.5px;">
                                        Depo: <span id="fPulangDepo">RM (Farmasi Ranap)</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Tambah Item Obat Pulang (Hanya jika belum validasi) -->
                <div id="sectionTambahItemPulang" class="card border border-warning-subtle bg-warning-subtle bg-opacity-25 mb-3" style="display:none;">
                    <div class="card-body p-2">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="fw-semibold text-warning-emphasis" style="font-size: 12px;">
                                <i class="bi bi-plus-circle me-1"></i> Tambah / Ganti Item Obat Pulang:
                            </span>
                        </div>
                        <div class="row g-2 align-items-end">
                            <div class="col-md-5">
                                <label class="form-label mb-1" style="font-size: 11px;">Pilih Obat (Gudang/Depo):</label>
                                <select id="selectObatPulangBaru" class="form-select form-select-sm" style="width: 100%;"></select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label mb-1" style="font-size: 11px;">Jumlah (Jml):</label>
                                <input type="number" id="inputJmlPulangBaru" class="form-control form-control-sm text-center" min="1" step="1" value="1">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label mb-1" style="font-size: 11px;">Aturan Pakai (Dosis):</label>
                                <input type="text" id="inputDosisPulangBaru" class="form-control form-control-sm" placeholder="Contoh: 3 x 1 tablet sesudah makan">
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-sm btn-primary w-100" id="btnSimpanItemPulang">
                                    <i class="bi bi-save me-1"></i> Tambah
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabel Item Obat Non-Racikan -->
                <div class="card border shadow-none mb-3">
                    <div class="card-header bg-white py-2 d-flex justify-content-between align-items-center">
                        <span class="fw-bold text-dark" style="font-size: 12.5px;">
                            <i class="bi bi-capsule text-primary me-1"></i> Daftar Obat Non-Racikan (Obat Jadi)
                        </span>
                        <span class="badge bg-light text-muted border" id="fPulangCountItem">0 Item</span>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered table-hover align-middle mb-0" id="tbDetailResepPulangFarmasi" style="font-size: 11.5px;">
                            <thead class="table-light text-center">
                                <tr>
                                    <th width="4%">No</th>
                                    <th width="11%">Kode</th>
                                    <th>Nama Obat / Barang</th>
                                    <th width="8%">Jml</th>
                                    <th width="7%">Satuan</th>
                                    <th width="18%">Aturan Pakai (Dosis)</th>
                                    <th width="8%">Stok Depo</th>
                                    <th width="10%">Harga</th>
                                    <th width="8%">Embalase</th>
                                    <th width="8%">Tuslah</th>
                                    <th width="11%">Subtotal</th>
                                    <th width="6%" id="thAksiPulang">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="tbodyDetailResepPulangFarmasi">
                                <tr>
                                    <td colspan="12" class="text-center text-muted py-3">Memuat item resep pulang...</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Section Daftar Obat Racikan Pulang -->
                <div class="card border shadow-none mb-3" id="sectionRacikanPulangContainer">
                    <div class="card-header bg-white py-2 d-flex justify-content-between align-items-center">
                        <span class="fw-bold text-dark" style="font-size: 12.5px;">
                            <i class="bi bi-mortar-pestle text-primary me-1"></i> Daftar Obat Racikan Resep Pulang
                        </span>
                        <span class="badge bg-primary-subtle text-primary border border-primary-subtle" id="fPulangCountRacikan">0 Racikan</span>
                    </div>
                    <div class="card-body p-2" id="fPulangRacikanContainer">
                        <div class="text-center text-muted py-2" style="font-size: 12px;"><i>Tidak ada obat racikan pada permintaan ini.</i></div>
                    </div>
                </div>

                <!-- Financial Summary Card (Embalase, Tuslah & Grand Total) -->
                <div class="card border-0 bg-light-subtle rounded-3 shadow-sm p-3 mb-2">
                    <div class="row g-2 align-items-center text-center">
                        <div class="col-md-3 col-6">
                            <small class="text-muted d-block fw-semibold" style="font-size: 11px;">BIAYA OBAT (NETTO)</small>
                            <span class="fs-6 fw-bold text-dark font-monospace" id="fPulangBiayaObatNetto">Rp 0</span>
                        </div>
                        <div class="col-md-3 col-6 border-start">
                            <small class="text-muted d-block fw-semibold" style="font-size: 11px;">TOTAL EMBALASE</small>
                            <span class="fs-6 fw-bold text-info font-monospace" id="fPulangTotalEmbalase">Rp 0</span>
                        </div>
                        <div class="col-md-3 col-6 border-start">
                            <small class="text-muted d-block fw-semibold" style="font-size: 11px;">TOTAL TUSLAH</small>
                            <span class="fs-6 fw-bold text-secondary font-monospace" id="fPulangTotalTuslah">Rp 0</span>
                        </div>
                        <div class="col-md-3 col-6 border-start bg-primary-subtle rounded py-1">
                            <small class="text-primary d-block fw-bold" style="font-size: 11px;">TOTAL BIAYA RESEP PULANG</small>
                            <span class="fs-5 fw-bolder text-primary font-monospace" id="fPulangGrandTotal">Rp 0</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer py-2 bg-light d-flex justify-content-between">
                <button type="button" class="btn btn-sm btn-outline-secondary px-3" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-1"></i> Tutup
                </button>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-sm btn-outline-primary px-3 fw-bold" id="btnCetakEtiketPulangModal" onclick="bukaModalCetakEtiketPulang(currentNoPermintaanPulang)">
                        <i class="bi bi-printer me-1"></i> Cetak Etiket
                    </button>
                    <button type="button" class="btn btn-sm btn-success px-3 fw-bold" id="btnEksekusiValidasiResepPulang">
                        <i class="bi bi-check2-circle me-1"></i> Validasi Resep Pulang Sekarang
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
