<div class="modal fade" id="modalResepObat" tabindex="-1" aria-labelledby="modalResepObatLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content border-0 shadow">
            <!-- Modal Header -->
            <div class="modal-header bg-primary text-white py-2 px-3">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-prescription2 fs-5"></i>
                    <div>
                        <h6 class="modal-title fw-bold mb-0" id="modalResepObatLabel">Detail & Validasi Resep Obat Rawat Jalan</h6>
                        <small class="text-white-50" style="font-size: 11px;">Pengelolaan item obat, substitusi/penambahan, dan validasi billing stok depo</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body p-3 bg-light">
                <!-- Info Pasien & Resep Card -->
                <div class="card border-0 shadow-sm rounded-3 mb-3">
                    <div class="card-body p-3">
                        <div class="row g-2 align-items-center">
                            <div class="col-md-3">
                                <small class="text-muted d-block" style="font-size: 11px;">NO. RESEP & TGL</small>
                                <span class="fw-bold font-monospace text-primary fs-6" id="infoNoResep">-</span>
                                <div class="text-muted" style="font-size: 11px;" id="infoTglResep">-</div>
                            </div>
                            <div class="col-md-3">
                                <small class="text-muted d-block" style="font-size: 11px;">PASIEN & NO. RAWAT</small>
                                <strong class="text-dark d-block text-truncate" id="ralanPasienNama">-</strong>
                                <small class="text-muted font-monospace" id="ralanNoRawat">-</small>
                            </div>
                            <div class="col-md-3">
                                <small class="text-muted d-block" style="font-size: 11px;">POLIKLINIK & DOKTER</small>
                                <div class="fw-semibold text-dark text-truncate" id="ralanPoliNama">-</div>
                                <small class="text-muted text-truncate d-block" id="ralanDokterNama">-</small>
                            </div>
                            <div class="col-md-3 text-md-end">
                                <small class="text-muted d-block" style="font-size: 11px;">DEPO FARMASI & STATUS</small>
                                <span class="badge bg-secondary mb-1" id="ralanDepoNama">Depo Rajal</span><br>
                                <span class="badge bg-warning text-dark" id="ralanStatusBadge">BELUM VALIDASI</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Resep By Plan (SOAP Dokter) Collapse/Card -->
                <div class="card border-0 shadow-sm rounded-3 mb-3">
                    <div class="card-header bg-white py-2 d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-journal-text text-info"></i>
                            <strong style="font-size: 12.5px;">Instruksi Resep By Plan (SOAP Dokter)</strong>
                        </div>
                        <button class="btn btn-sm btn-outline-secondary py-0 px-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePlanSOAP" aria-expanded="true" style="font-size: 11px;">
                            <i class="bi bi-chevron-down"></i> Buka/Tutup Catatan
                        </button>
                    </div>
                    <div class="collapse show" id="collapsePlanSOAP">
                        <div class="card-body p-2 bg-light">
                            <textarea class="form-control notif bg-white border" id="notifResep" name="notifResep" rows="4" readonly style="font-size: 12.5px; font-family: monospace; min-height: 110px; line-height: 1.6; resize: vertical;" placeholder="Tidak ada catatan instruksi resep pada Plan SOAP dokter"></textarea>
                            <small class="text-muted fst-italic mt-1 d-block" style="font-size: 10.5px;">
                                * Catatan di atas bersumber dari kolom Plan (RTL) SOAP dokter saat periksa. Gunakan form di bawah untuk memasukkan atau menyesuaikan item obat ke dalam sistem.
                            </small>
                        </div>
                    </div>
                </div>

                <!-- Form Tambah Obat Baru (Hanya jika belum divalidasi) -->
                <div class="card border-0 shadow-sm rounded-3 mb-3" id="cardFormTambahObat">
                    <div class="card-header bg-white py-2">
                        <strong class="text-success" style="font-size: 12.5px;">
                            <i class="bi bi-plus-circle-fill me-1"></i> Tambah / Ganti Item Obat ke Resep
                        </strong>
                    </div>
                    <div class="card-body p-3">
                        <form id="formTambahObatRalan" onsubmit="event.preventDefault(); tambahObatKeResep();">
                            <input type="hidden" id="inputKodeBrngRalan" name="kode_brng">
                            <div class="row g-2 align-items-end">
                                <!-- Cari Obat Autocomplete -->
                                <div class="col-md-5 position-relative">
                                    <label class="form-label small fw-bold mb-1">Cari Obat / BHP Medis :</label>
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text bg-light"><i class="bi bi-search"></i></span>
                                        <input type="text" class="form-control" id="inputCariObatRalan" placeholder="Ketik nama obat..." autocomplete="off">
                                    </div>
                                    <div id="dropdownCariObatRalan" class="list-group position-absolute w-100 shadow d-none" style="z-index: 1070; max-height: 220px; overflow-y: auto;"></div>
                                </div>
                                <!-- Jumlah -->
                                <div class="col-md-2">
                                    <label class="form-label small fw-bold mb-1">Jumlah :</label>
                                    <div class="input-group input-group-sm">
                                        <input type="number" step="any" min="0.1" class="form-control" id="inputJmlObatRalan" placeholder="Jml" value="1" required>
                                        <span class="input-group-text small" id="lblSatuanObatRalan">Sat</span>
                                    </div>
                                </div>
                                <!-- Aturan Pakai -->
                                <div class="col-md-3">
                                    <label class="form-label small fw-bold mb-1">Aturan Pakai :</label>
                                    <input type="text" class="form-control form-control-sm" id="inputAturanPakaiRalan" list="listAturanPakaiRalan" placeholder="Contoh: 3x1 tablet sesudah makan" autocomplete="off">
                                    <datalist id="listAturanPakaiRalan">
                                        <option value="3 x 1 tablet">
                                        <option value="3 x 1 tablet sesudah makan">
                                        <option value="2 x 1 tablet">
                                        <option value="2 x 1 tablet sesudah makan">
                                        <option value="1 x 1 tablet">
                                        <option value="3 x 1 sendok takar (5 ml)">
                                        <option value="3 x 1/2 tablet">
                                        <option value="Bila demam / nyeri">
                                        <option value="Sebelum makan">
                                        <option value="Sesudah makan">
                                    </datalist>
                                </div>
                                <!-- Tombol Tambahkan -->
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-success btn-sm w-100 fw-semibold" id="btnSubmitTambahObat">
                                        <i class="bi bi-plus-lg me-1"></i> Tambahkan
                                    </button>
                                </div>
                            </div>
                            <div class="mt-1 d-flex gap-3 align-items-center" id="boxInfoObatTerpilih" style="display: none !important;">
                                <small class="text-success fw-bold" id="lblNamaObatTerpilih">-</small>
                                <small class="text-muted" id="lblStokDepoTerpilih">Stok: 0</small>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Tabel Item Obat Non-Racikan -->
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-header bg-white py-2 d-flex justify-content-between align-items-center">
                        <strong style="font-size: 13px;" class="text-primary">
                            <i class="bi bi-capsule me-1"></i> Obat Non-Racikan
                        </strong>
                        <span class="badge bg-primary rounded-pill" id="badgeJumlahItemRalan">0 Item</span>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-bordered table-sm align-middle mb-0" id="tbDetailResepRalan" style="font-size: 11.5px;">
                                <thead class="table-light">
                                    <tr class="text-center">
                                        <th width="3%">#</th>
                                        <th width="10%">Kode</th>
                                        <th>Nama Obat / Alkes</th>
                                        <th width="8%">Stok Depo</th>
                                        <th width="6%">Jumlah</th>
                                        <th width="7%">Satuan</th>
                                        <th width="16%">Aturan Pakai</th>
                                        <th width="9%">Harga</th>
                                        <th width="8%">Embalase</th>
                                        <th width="8%">Tuslah</th>
                                        <th width="10%">Subtotal</th>
                                        <th width="8%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="tbodyDetailResepRalan">
                                    <tr>
                                        <td colspan="12" class="text-center text-muted py-3">Memuat item resep...</td>
                                    </tr>
                                </tbody>
                                <tfoot class="table-light fw-bold">
                                    <tr>
                                        <td colspan="10" class="text-end">Subtotal Obat Non-Racikan :</td>
                                        <td class="text-end text-primary font-monospace" id="lblSubtotalNonRacik">Rp 0</td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Tabel Racikan -->
                <div class="card border-0 shadow-sm rounded-3 mt-3" id="cardRacikanRalan">
                    <div class="card-header bg-white py-2 d-flex justify-content-between align-items-center">
                        <strong style="font-size: 13px;" class="text-primary">
                            <i class="bi bi-mortarboard me-1"></i> Obat Racikan
                        </strong>
                        <button type="button" class="btn btn-outline-primary btn-sm py-1 px-2.5 shadow-sm fw-semibold" id="btnTambahRacikanBaru" onclick="bukaModalTambahRacikan()">
                            <i class="bi bi-plus-circle me-1"></i> Buat Racikan Baru
                        </button>
                    </div>
                    <div class="card-body p-2" id="boxListRacikanRalan"></div>
                </div>

                <!-- Ringkasan Biaya Resep (Biaya Obat, Embalase, Tuslah, Grand Total) -->
                <div class="card border-0 shadow-sm rounded-3 mt-3 bg-white">
                    <div class="card-body p-2 px-3">
                        <div class="row align-items-center g-2 text-center text-md-start" style="font-size: 12px;">
                            <div class="col-md-3 col-6">
                                <span class="text-muted d-block" style="font-size: 10.5px;">BIAYA OBAT (NETTO)</span>
                                <strong class="text-dark font-monospace" id="lblRingkasanBiayaObat">Rp 0</strong>
                            </div>
                            <div class="col-md-3 col-6">
                                <span class="text-muted d-block" style="font-size: 10.5px;">TOTAL EMBALASE</span>
                                <strong class="text-dark font-monospace" id="lblRingkasanEmbalase">Rp 0</strong>
                            </div>
                            <div class="col-md-3 col-6">
                                <span class="text-muted d-block" style="font-size: 10.5px;">TOTAL TUSLAH</span>
                                <strong class="text-dark font-monospace" id="lblRingkasanTuslah">Rp 0</strong>
                            </div>
                            <div class="col-md-3 col-6 text-md-end">
                                <span class="text-muted d-block" style="font-size: 10.5px;">TOTAL BIAYA RESEP</span>
                                <strong class="text-primary font-monospace fs-6" id="lblGrandTotalRalan">Rp 0</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer bg-white py-2 px-3 d-flex justify-content-between align-items-center">
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-outline-teal btn-sm text-white" id="btnModalTelaahRalan" style="background-color: #0f766e;">
                        <i class="bi bi-shield-check me-1"></i> Form Telaah Resep
                    </button>
                    <button type="button" class="btn btn-outline-primary btn-sm px-3 fw-semibold" id="btnModalEtiketRalan" onclick="bukaModalEtiket(currentNoResepRalan)" title="Cetak Etiket Aturan Pakai Obat">
                        <i class="bi bi-printer me-1"></i> Cetak Etiket
                    </button>
                </div>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-success btn-sm px-4 fw-bold" id="btnValidasiResepRalan" onclick="eksekusiValidasiRalan()">
                        <i class="bi bi-check2-circle me-1"></i> Validasi & Kurangi Stok
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Ubah / Substitusi Item Obat Ralan Non-Racikan -->
<div class="modal fade" id="modalUbahItemRalan" tabindex="-1" aria-hidden="true" style="z-index: 1080;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-warning py-2 px-3 text-dark">
                <h6 class="modal-title fw-bold mb-0" style="font-size: 13.5px;">
                    <i class="bi bi-arrow-left-right me-1"></i> Ubah / Substitusi Item Obat
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">
                <input type="hidden" id="editItemKodeBrng">
                <input type="hidden" id="editItemKodeBrngBaru">

                <!-- Obat Saat Ini -->
                <div class="mb-3 p-2 bg-light rounded border">
                    <small class="text-muted d-block" style="font-size: 11px;">OBAT SAAT INI :</small>
                    <strong class="text-dark fs-6" id="editItemNamaBrng">-</strong>
                    <div class="text-muted font-monospace" id="editItemKodeBrngDisplay" style="font-size: 11px;"></div>
                </div>

                <!-- Pilihan Ganti Obat Pengganti (Substitusi) -->
                <div class="mb-3 position-relative">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <label class="form-label small fw-bold mb-0 text-primary">
                            <i class="bi bi-search me-1"></i> Ganti dengan Obat Lain (Substitusi) :
                        </label>
                        <button type="button" class="btn btn-link btn-sm p-0 text-danger text-decoration-none d-none" id="btnResetGantiObat" onclick="resetObatPengganti()" style="font-size: 11px;">
                            <i class="bi bi-x-circle"></i> Batal Ganti Obat
                        </button>
                    </div>
                    <input type="text" class="form-control form-control-sm" id="editInputCariObatBaru" placeholder="Ketik nama obat jika ingin mengganti obat ini..." autocomplete="off">
                    <div id="dropdownCariObatSubstitusi" class="list-group position-absolute w-100 shadow d-none" style="z-index: 1090; max-height: 180px; overflow-y: auto;"></div>

                    <div class="mt-2 p-2 bg-success bg-opacity-10 rounded border border-success d-none" id="boxObatPenggantiTerpilih">
                        <small class="text-success fw-bold d-block" id="lblObatPenggantiTerpilih">-</small>
                        <small class="text-muted" id="lblStokPenggantiTerpilih">Stok: 0</small>
                    </div>
                </div>

                <!-- Jumlah & Aturan Pakai -->
                <div class="row g-2 mb-2">
                    <div class="col-md-5">
                        <label class="form-label small fw-bold mb-1">Jumlah :</label>
                        <input type="number" step="any" min="0.1" class="form-control form-control-sm" id="editItemJml" required>
                    </div>
                    <div class="col-md-7">
                        <label class="form-label small fw-bold mb-1">Aturan Pakai :</label>
                        <input type="text" class="form-control form-control-sm" id="editItemAturan" list="listAturanPakaiRalan">
                    </div>
                </div>
            </div>
            <div class="modal-footer py-2 px-3 bg-light">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-warning btn-sm fw-bold text-dark px-3" onclick="simpanPerubahanItemRalan()">
                    <i class="bi bi-check-lg me-1"></i> Simpan Perubahan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Header Racikan (Tambah / Edit) -->
<div class="modal fade" id="modalHeaderRacikanRalan" tabindex="-1" aria-hidden="true" style="z-index: 1080;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary py-2 px-3 text-white">
                <h6 class="modal-title fw-bold mb-0" id="modalHeaderRacikanTitle" style="font-size: 13.5px;">
                    <i class="bi bi-mortarboard me-1"></i> Form Racikan Obat
                </h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">
                <input type="hidden" id="racikNoRacik">
                <div class="mb-2">
                    <label class="form-label small fw-bold mb-1">Nama Racikan :</label>
                    <input type="text" class="form-control form-control-sm" id="racikNama" placeholder="Contoh: Puyer Batuk Pilek" required>
                </div>
                <div class="row g-2 mb-2">
                    <div class="col-md-6">
                        <label class="form-label small fw-bold mb-1">Metode Racik :</label>
                        <select class="form-select form-select-sm" id="racikKdMetode" required>
                            <!-- Diisi dinamis dari response metode_racik -->
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold mb-1">Jumlah Bungkus / Kemasan :</label>
                        <input type="number" min="1" class="form-control form-control-sm" id="racikJmlDr" value="10" required>
                    </div>
                </div>
                <div class="mb-2">
                    <label class="form-label small fw-bold mb-1">Aturan Pakai :</label>
                    <input type="text" class="form-control form-control-sm" id="racikAturanPakai" list="listAturanPakaiRalan" placeholder="Contoh: 3x1 bungkus">
                </div>
                <div class="mb-2">
                    <label class="form-label small fw-bold mb-1">Keterangan Tambahan :</label>
                    <input type="text" class="form-control form-control-sm" id="racikKeterangan" placeholder="Contoh: Sesudah makan / Bila panas">
                </div>
            </div>
            <div class="modal-footer py-2 px-3 bg-light">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary btn-sm fw-bold px-3" onclick="simpanHeaderRacikanRalan()">
                    <i class="bi bi-check-lg me-1"></i> Simpan Racikan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Obat ke Racikan -->
<div class="modal fade" id="modalTambahItemRacikanRalan" tabindex="-1" aria-hidden="true" style="z-index: 1080;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-success py-2 px-3 text-white">
                <h6 class="modal-title fw-bold mb-0" style="font-size: 13.5px;">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Obat ke Racikan
                </h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">
                <input type="hidden" id="tambahItemRacikNoRacik">
                <input type="hidden" id="tambahItemRacikKodeBrng">

                <div class="mb-2 p-2 bg-light rounded border">
                    <small class="text-muted d-block" style="font-size: 11px;">RACIKAN :</small>
                    <strong class="text-success fs-6" id="tambahItemRacikNamaRacikDisplay">-</strong>
                </div>

                <div class="mb-3 position-relative">
                    <label class="form-label small fw-bold mb-1">Cari Obat / Bahan Racikan :</label>
                    <input type="text" class="form-control form-control-sm" id="tambahItemRacikInputCari" placeholder="Ketik nama obat..." autocomplete="off">
                    <div id="dropdownCariObatItemRacik" class="list-group position-absolute w-100 shadow d-none" style="z-index: 1090; max-height: 180px; overflow-y: auto;"></div>
                    <div class="mt-2 p-2 bg-success bg-opacity-10 rounded border border-success d-none" id="boxItemRacikTerpilih">
                        <small class="text-success fw-bold d-block" id="lblItemRacikTerpilih">-</small>
                        <small class="text-muted" id="lblStokItemRacikTerpilih">Stok Depo: 0</small>
                    </div>
                </div>

                <div class="row g-2 mb-2">
                    <div class="col-md-6">
                        <label class="form-label small fw-bold mb-1">Jumlah Diambil (Tablet/Btl) :</label>
                        <input type="number" step="any" min="0.01" class="form-control form-control-sm" id="tambahItemRacikJml" placeholder="Jumlah" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold mb-1">Kandungan / Dosis (Opsional) :</label>
                        <input type="number" step="any" min="0" class="form-control form-control-sm" id="tambahItemRacikKandungan" placeholder="mg / ml" value="0">
                    </div>
                </div>
            </div>
            <div class="modal-footer py-2 px-3 bg-light">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-success btn-sm fw-bold px-3" onclick="simpanItemKeRacikanRalan()">
                    <i class="bi bi-plus-lg me-1"></i> Tambahkan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Ubah / Substitusi Obat di Racikan -->
<div class="modal fade" id="modalUbahItemRacikanRalan" tabindex="-1" aria-hidden="true" style="z-index: 1080;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-warning py-2 px-3 text-dark">
                <h6 class="modal-title fw-bold mb-0" style="font-size: 13.5px;">
                    <i class="bi bi-arrow-left-right me-1"></i> Ubah / Substitusi Obat Racikan
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">
                <input type="hidden" id="editRacikItemNoRacik">
                <input type="hidden" id="editRacikItemKodeBrng">
                <input type="hidden" id="editRacikItemKodeBrngBaru">

                <!-- Obat Saat Ini -->
                <div class="mb-3 p-2 bg-light rounded border">
                    <small class="text-muted d-block" style="font-size: 11px;">OBAT RACIKAN SAAT INI :</small>
                    <strong class="text-dark fs-6" id="editRacikItemNamaBrng">-</strong>
                    <div class="text-muted font-monospace" id="editRacikItemKodeBrngDisplay" style="font-size: 11px;"></div>
                </div>

                <!-- Pilihan Ganti Obat Pengganti (Substitusi) -->
                <div class="mb-3 position-relative">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <label class="form-label small fw-bold mb-0 text-primary">
                            <i class="bi bi-search me-1"></i> Ganti dengan Obat Lain (Substitusi) :
                        </label>
                        <button type="button" class="btn btn-link btn-sm p-0 text-danger text-decoration-none d-none" id="btnResetGantiObatRacik" onclick="resetObatPenggantiRacik()" style="font-size: 11px;">
                            <i class="bi bi-x-circle"></i> Batal Ganti Obat
                        </button>
                    </div>
                    <input type="text" class="form-control form-control-sm" id="editRacikInputCariObatBaru" placeholder="Ketik nama obat jika ingin mengganti obat racikan ini..." autocomplete="off">
                    <div id="dropdownCariObatSubstitusiRacik" class="list-group position-absolute w-100 shadow d-none" style="z-index: 1090; max-height: 180px; overflow-y: auto;"></div>

                    <div class="mt-2 p-2 bg-success bg-opacity-10 rounded border border-success d-none" id="boxObatPenggantiTerpilihRacik">
                        <small class="text-success fw-bold d-block" id="lblObatPenggantiTerpilihRacik">-</small>
                        <small class="text-muted" id="lblStokPenggantiTerpilihRacik">Stok: 0</small>
                    </div>
                </div>

                <!-- Jumlah & Kandungan -->
                <div class="row g-2 mb-2">
                    <div class="col-md-6">
                        <label class="form-label small fw-bold mb-1">Jumlah Diambil :</label>
                        <input type="number" step="any" min="0.01" class="form-control form-control-sm" id="editRacikItemJml" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold mb-1">Kandungan / Dosis (Opsional) :</label>
                        <input type="number" step="any" min="0" class="form-control form-control-sm" id="editRacikItemKandungan">
                    </div>
                </div>
            </div>
            <div class="modal-footer py-2 px-3 bg-light">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-warning btn-sm fw-bold text-dark px-3" onclick="simpanPerubahanItemRacikanRalan()">
                    <i class="bi bi-check-lg me-1"></i> Simpan Perubahan
                </button>
            </div>
        </div>
    </div>
</div>

@push('script')
<script>
    let currentNoResepRalan = '';
    let currentKdBangsalRalan = 'RM7';
    let currentIsValidatedRalan = false;
    let currentRawatDataRalan = {};

    // Fungsi Utama Buka Modal Detail & Validasi Resep Ralan
    function tampilResep(no_resep, kd_poli = '') {
        currentNoResepRalan = no_resep;
        $('#modalResepObat').modal('show');
        loadDataDetailResepRalan(no_resep);
    }

    // Load Data Lengkap Resep Ralan dari Server
    function loadDataDetailResepRalan(no_resep) {
        $('#infoNoResep').text(no_resep);
        $('#infoTglResep').text('Memuat...');
        $('#ralanPasienNama').text('Memuat...');
        $('#ralanNoRawat').text('-');
        $('#ralanPoliNama').text('-');
        $('#ralanDokterNama').text('-');
        $('#notifResep').val('Memuat resep by plan...').css('height', '110px');
        $('#tbodyDetailResepRalan').html('<tr><td colspan="10" class="text-center text-muted py-3">Memuat daftar obat...</td></tr>');

        $.get(`{{ url('/farmasi/resep-ralan/detail') }}/${no_resep}`).done(function(res) {
            const resep = res.resep;
            currentRawatDataRalan = resep;
            currentKdBangsalRalan = res.kdBangsal || 'RM7';
            currentIsValidatedRalan = res.is_validated;

            // Render Header Info
            $('#infoNoResep').text(resep.no_resep);
            $('#infoTglResep').text(`${resep.tgl_peresepan} pk ${resep.jam_peresepan}`);
            $('#ralanPasienNama').text(resep.reg_periksa?.pasien?.nm_pasien || '-');
            $('#ralanNoRawat').text(resep.no_rawat);
            $('#ralanPoliNama').text(resep.reg_periksa?.poliklinik?.nm_poli || '-');
            $('#ralanDokterNama').text(resep.reg_periksa?.dokter?.nm_dokter || '-');
            $('#ralanDepoNama').text(`${res.nmBangsal} (${currentKdBangsalRalan})`);

            // Status Badge & Tombol Validasi
            if (res.is_validated) {
                $('#ralanStatusBadge').removeClass('bg-warning text-dark').addClass('bg-success text-white')
                    .html(`<i class="bi bi-check-circle-fill me-1"></i> Tervalidasi pk ${resep.jam}`);
                $('#btnValidasiResepRalan').prop('disabled', true).removeClass('btn-success').addClass('btn-secondary')
                    .html('<i class="bi bi-check2-all me-1"></i> Resep Sudah Tervalidasi');
                $('#cardFormTambahObat').addClass('d-none');
            } else {
                $('#ralanStatusBadge').removeClass('bg-success text-white').addClass('bg-warning text-dark')
                    .html('<i class="bi bi-clock-history me-1"></i> BELUM VALIDASI');
                $('#btnValidasiResepRalan').prop('disabled', false).removeClass('btn-secondary').addClass('btn-success')
                    .html('<i class="bi bi-check2-circle me-1"></i> Validasi & Kurangi Stok');
                $('#cardFormTambahObat').removeClass('d-none');
            }

            // Bind Tombol Telaah
            const isTelaahRalan = !!resep.telaah_farmasi;
            if (isTelaahRalan) {
                $('#btnModalTelaahRalan')
                    .removeClass('btn-outline-danger')
                    .addClass('text-white')
                    .css('background-color', '#0f766e')
                    .html('<i class="bi bi-shield-check me-1"></i> Telaah Farmasi <span class="badge bg-white text-dark ms-1" style="font-size:10px;">Sudah</span>');
            } else {
                $('#btnModalTelaahRalan')
                    .removeClass('text-white')
                    .css('background-color', '')
                    .addClass('btn-outline-danger fw-semibold')
                    .html('<i class="bi bi-shield-exclamation me-1"></i> Telaah Farmasi (Belum)');
            }

            $('#btnModalTelaahRalan').off('click').on('click', function() {
                bukaModalTelaahFarmasi(
                    resep.no_resep,
                    resep.no_rawat,
                    resep.reg_periksa?.pasien?.nm_pasien || '',
                    resep.reg_periksa?.poliklinik?.nm_poli || ''
                );
            });

            // SOAP Plan / RTL
            const $notif = $('#notifResep');
            if (res.soap_plan && res.soap_plan.trim() !== '' && res.soap_plan !== '-') {
                $notif.val(res.soap_plan.trim());
            } else {
                $notif.val('Tidak ada catatan instruksi resep pada Plan SOAP dokter.');
            }
            setTimeout(function() {
                $notif.css('height', 'auto');
                const scrollH = $notif.prop('scrollHeight');
                $notif.css('height', Math.max(110, scrollH + 12) + 'px');
            }, 60);

            // Simpan metode racik untuk select option
            if (res.metode_racik) {
                globalMetodeRacikList = res.metode_racik;
                const $sel = $('#racikKdMetode');
                $sel.empty();
                res.metode_racik.forEach(function(m) {
                    $sel.append(`<option value="${m.kd_racik}">${m.nm_racik}</option>`);
                });
            }

            // Tombol tambah racikan baru
            if (res.is_validated) {
                $('#btnTambahRacikanBaru').addClass('d-none');
            } else {
                $('#btnTambahRacikanBaru').removeClass('d-none');
            }

            // Hitung akumulasi ringkasan biaya
            let sumBiayaObat = 0;
            let sumEmbalase = 0;
            let sumTuslah = 0;

            if (res.items) {
                res.items.forEach(function(item) {
                    sumBiayaObat += item.biaya_obat || (item.harga * item.jml);
                    sumEmbalase += item.embalase || 0;
                    sumTuslah += item.tuslah || 0;
                });
            }

            if (res.racikans) {
                res.racikans.forEach(function(r) {
                    if (r.details) {
                        r.details.forEach(function(d) {
                            sumBiayaObat += d.biaya_obat || (d.harga * d.jml);
                            sumEmbalase += d.embalase || 0;
                            sumTuslah += d.tuslah || 0;
                        });
                    }
                });
            }

            // Render Item Obat Non-Racikan & Racikan
            const totalNonRacik = renderTbodyResepRalan(res.items);
            const totalRacik = renderRacikanRalan(res.racikans);
            const grandTotalSemua = totalNonRacik + totalRacik;

            // Update Label Ringkasan
            $('#lblSubtotalNonRacik').text(`Rp ${numberFormat(totalNonRacik)}`);
            $('#lblRingkasanBiayaObat').text(`Rp ${numberFormat(sumBiayaObat)}`);
            $('#lblRingkasanEmbalase').text(`Rp ${numberFormat(sumEmbalase)}`);
            $('#lblRingkasanTuslah').text(`Rp ${numberFormat(sumTuslah)}`);
            $('#lblGrandTotalRalan').text(`Rp ${numberFormat(grandTotalSemua)}`);
        }).fail(function() {
            Swal.fire('Error', 'Gagal memuat detail resep rawat jalan.', 'error');
        });
    }

    // Render Tabel Daftar Obat Non-Racikan
    function renderTbodyResepRalan(items) {
        const $tbody = $('#tbodyDetailResepRalan');
        $tbody.empty();

        if (!items || items.length === 0) {
            $tbody.html('<tr><td colspan="12" class="text-center text-muted py-3"><i>Belum ada item obat non-racikan yang diinput. Tambahkan obat dari form di atas jika ada.</i></td></tr>');
            $('#badgeJumlahItemRalan').text('0 Item');
            return 0;
        }

        let grandTotal = 0;
        $('#badgeJumlahItemRalan').text(`${items.length} Item`);

        items.forEach(function(item, idx) {
            grandTotal += item.total;
            const isStokCukup = item.stok_depo >= item.jml;
            const stokBadge = isStokCukup
                ? `<span class="badge bg-success rounded-pill font-monospace" style="font-size: 10.5px;">${item.stok_depo}</span>`
                : `<span class="badge bg-danger rounded-pill font-monospace" style="font-size: 10.5px;" title="Stok depo kurang!">${item.stok_depo}</span>`;

            let aksiButtons = '';
            const btnEtiketItem = `
                <button type="button" class="btn btn-outline-primary btn-sm shadow-sm" style="padding: 4px 8px; font-size: 12px;" onclick="bukaModalEtiket(currentNoResepRalan, 'umum_${item.kode_brng}')" title="Cetak Etiket Item Ini">
                    <i class="bi bi-printer"></i>
                </button>
            `;

            if (!currentIsValidatedRalan) {
                aksiButtons = `
                    <div class="d-inline-flex gap-1 align-items-center">
                        ${btnEtiketItem}
                        <button type="button" class="btn btn-outline-warning btn-sm text-dark shadow-sm" style="padding: 4px 8px; font-size: 12px;" onclick="bukaModalEditItem('${item.kode_brng}', '${item.nama_brng.replace(/'/g, "\\'")}', ${item.jml}, '${(item.aturan_pakai || '').replace(/'/g, "\\'")}')" title="Ubah / Substitusi Obat">
                            <i class="bi bi-pencil fs-6"></i>
                        </button>
                        <button type="button" class="btn btn-outline-danger btn-sm shadow-sm" style="padding: 4px 8px; font-size: 12px;" onclick="hapusItemResep('${item.kode_brng}', '${item.nama_brng.replace(/'/g, "\\'")}')" title="Hapus Item Obat">
                            <i class="bi bi-trash fs-6"></i>
                        </button>
                    </div>
                `;
            } else {
                aksiButtons = `
                    <div class="d-inline-flex gap-1 align-items-center">
                        ${btnEtiketItem}
                        <span class="badge bg-light text-muted border">Terkunci</span>
                    </div>
                `;
            }

            const tr = `
                <tr>
                    <td class="text-center">${idx + 1}</td>
                    <td class="font-monospace text-muted" style="font-size: 11px;">${item.kode_brng}</td>
                    <td><strong>${item.nama_brng}</strong></td>
                    <td class="text-center">${stokBadge}</td>
                    <td class="text-center fw-bold">${item.jml}</td>
                    <td class="text-center">${item.satuan}</td>
                    <td><span class="badge bg-light text-dark border font-monospace text-wrap" style="font-size: 11px;">${item.aturan_pakai || '-'}</span></td>
                    <td class="text-end font-monospace">Rp ${numberFormat(item.harga)}</td>
                    <td class="text-end font-monospace text-muted">Rp ${numberFormat(item.embalase || 0)}</td>
                    <td class="text-end font-monospace text-muted">Rp ${numberFormat(item.tuslah || 0)}</td>
                    <td class="text-end font-monospace fw-semibold text-primary">Rp ${numberFormat(item.total)}</td>
                    <td class="text-center">${aksiButtons}</td>
                </tr>
            `;
            $tbody.append(tr);
        });

        return grandTotal;
    }

    // Render Racikan Terstruktur Lengkap
    function renderRacikanRalan(racikans) {
        const $card = $('#cardRacikanRalan');
        const $box = $('#boxListRacikanRalan');
        $box.empty();

        if (!racikans || racikans.length === 0) {
            $box.html('<div class="text-center text-muted py-3 bg-white border rounded"><i class="bi bi-info-circle me-1"></i> Belum ada obat racikan pada resep ini. Klik <strong>Buat Racikan Baru</strong> jika dokter meresepkan puyer/kapsul/racikan.</div>');
            return 0;
        }

        let totalBiayaSemuaRacik = 0;

        racikans.forEach(function(r) {
            totalBiayaSemuaRacik += r.total_biaya || 0;
            let rowsDetailHtml = '';

            if (r.details && r.details.length > 0) {
                r.details.forEach(function(d, dIdx) {
                    const isStokCukup = d.stok_depo >= d.jml;
                    const stokBadge = isStokCukup
                        ? `<span class="badge bg-success rounded-pill font-monospace" style="font-size: 10.5px;">${d.stok_depo}</span>`
                        : `<span class="badge bg-danger rounded-pill font-monospace" style="font-size: 10.5px;" title="Stok depo kurang!">${d.stok_depo}</span>`;

                    let aksiDetBtn = '';
                    if (!currentIsValidatedRalan) {
                        aksiDetBtn = `
                            <div class="d-inline-flex gap-1 align-items-center">
                                <button type="button" class="btn btn-outline-warning btn-sm text-dark shadow-sm" style="padding: 3px 8px; font-size: 12px;" onclick="bukaModalEditItemRacikan(${r.no_racik}, '${d.kode_brng}', '${d.nama_brng.replace(/'/g, "\\'")}', ${d.jml}, ${d.kandungan})" title="Ubah / Substitusi Bahan">
                                    <i class="bi bi-pencil fs-6"></i>
                                </button>
                                <button type="button" class="btn btn-outline-danger btn-sm shadow-sm" style="padding: 3px 8px; font-size: 12px;" onclick="hapusItemRacikan(${r.no_racik}, '${d.kode_brng}', '${d.nama_brng.replace(/'/g, "\\'")}')" title="Hapus Bahan ini">
                                    <i class="bi bi-trash fs-6"></i>
                                </button>
                            </div>
                        `;
                    } else {
                        aksiDetBtn = '<span class="badge bg-light text-muted border">Terkunci</span>';
                    }

                    rowsDetailHtml += `
                        <tr>
                            <td class="text-center">${dIdx + 1}</td>
                            <td class="font-monospace text-muted" style="font-size: 11px;">${d.kode_brng}</td>
                            <td><strong>${d.nama_brng}</strong></td>
                            <td class="text-center">${stokBadge}</td>
                            <td class="text-center font-monospace">${d.kandungan > 0 ? d.kandungan : '-'}</td>
                            <td class="text-center fw-bold">${d.jml}</td>
                            <td class="text-center">${d.satuan}</td>
                            <td class="text-end font-monospace">Rp ${numberFormat(d.harga)}</td>
                            <td class="text-end font-monospace text-muted">Rp ${numberFormat(d.embalase || 0)}</td>
                            <td class="text-end font-monospace text-muted">Rp ${numberFormat(d.tuslah || 0)}</td>
                            <td class="text-end font-monospace fw-semibold text-primary">Rp ${numberFormat(d.subtotal)}</td>
                            <td class="text-center">${aksiDetBtn}</td>
                        </tr>
                    `;
                });
            } else {
                rowsDetailHtml = `<tr><td colspan="12" class="text-center text-muted py-2 fst-italic">Belum ada bahan obat di racikan ini. Klik <strong>Tambah Obat</strong> untuk mengisi bahan racikan.</td></tr>`;
            }

            let aksiHeaderBtn = `
                <div class="d-inline-flex gap-1 align-items-center">
                    <button type="button" class="btn btn-outline-primary btn-sm py-1 px-2.5 shadow-sm" onclick="bukaModalEtiket(currentNoResepRalan, 'racik_${r.no_racik}')" title="Cetak Etiket Racikan Ini">
                        <i class="bi bi-printer me-1"></i> Etiket
                    </button>
            `;

            if (!currentIsValidatedRalan) {
                aksiHeaderBtn += `
                    <button type="button" class="btn btn-success btn-sm text-white shadow-sm py-1 px-2.5" onclick="bukaModalTambahItemRacikan(${r.no_racik}, '${r.nama_racik.replace(/'/g, "\\'")}')" title="Tambah Obat / Bahan ke racikan ini">
                        <i class="bi bi-plus-lg me-1"></i> Tambah Obat
                    </button>
                    <button type="button" class="btn btn-outline-warning btn-sm text-dark shadow-sm py-1 px-2" onclick="bukaModalEditHeaderRacikan(${r.no_racik}, '${r.nama_racik.replace(/'/g, "\\'")}', '${r.kd_racik}', ${r.jml_dr}, '${(r.aturan_pakai || '').replace(/'/g, "\\'")}', '${(r.keterangan || '').replace(/'/g, "\\'")}')" title="Ubah Info Racikan">
                        <i class="bi bi-pencil fs-6"></i>
                    </button>
                    <button type="button" class="btn btn-outline-danger btn-sm shadow-sm py-1 px-2" onclick="hapusRacikan(${r.no_racik}, '${r.nama_racik.replace(/'/g, "\\'")}')" title="Hapus Racikan ini">
                        <i class="bi bi-trash fs-6"></i>
                    </button>
                `;
            }
            aksiHeaderBtn += '</div>';

            const html = `
                <div class="card border mb-3 shadow-sm bg-white">
                    <div class="card-header bg-light py-2 px-3 d-flex justify-content-between align-items-center">
                        <div>
                            <strong class="text-dark fs-6"><i class="bi bi-capsule text-primary me-1"></i> ${r.nama_racik} (${r.jml_dr} Bks/Kemasan)</strong>
                            <span class="badge bg-primary ms-1">${r.nm_racik}</span>
                            <span class="badge bg-light text-dark border ms-1 font-monospace">Aturan: ${r.aturan_pakai || '-'}</span>
                            ${r.keterangan && r.keterangan !== '-' ? `<span class="badge bg-secondary ms-1">${r.keterangan}</span>` : ''}
                        </div>
                        ${aksiHeaderBtn}
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm table-hover align-middle mb-0" style="font-size: 11.5px;">
                                <thead class="table-light text-center">
                                    <tr>
                                        <th width="3%">#</th>
                                        <th width="10%">Kode</th>
                                        <th>Nama Obat / Bahan</th>
                                        <th width="8%">Stok Depo</th>
                                        <th width="10%">Dosis/Kandungan</th>
                                        <th width="7%">Jml Ambil</th>
                                        <th width="7%">Satuan</th>
                                        <th width="9%">Harga</th>
                                        <th width="8%">Embalase</th>
                                        <th width="8%">Tuslah</th>
                                        <th width="10%">Subtotal</th>
                                        <th width="8%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${rowsDetailHtml}
                                </tbody>
                                <tfoot class="table-light">
                                    <tr>
                                        <td colspan="10" class="text-end fw-bold">Subtotal Bahan ${r.nama_racik} :</td>
                                        <td class="text-end font-monospace fw-semibold text-primary">Rp ${numberFormat(r.total_biaya)}</td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            `;
            $box.append(html);
        });

        return totalBiayaSemuaRacik;
    }

    // Live Search Autocomplete Obat
    let timerCariObatRalan;
    $('#inputCariObatRalan').on('keyup', function() {
        const keyword = $(this).val().trim();
        clearTimeout(timerCariObatRalan);
        if (keyword.length < 2) {
            $('#dropdownCariObatRalan').addClass('d-none').empty();
            return;
        }

        timerCariObatRalan = setTimeout(function() {
            $.get("{{ url('/obat/cari') }}", { nama: keyword, gudang: currentKdBangsalRalan }).done(function(res) {
                const list = res?.data || [];
                const $drop = $('#dropdownCariObatRalan');
                $drop.empty();

                if (list.length === 0) {
                    $drop.append('<div class="list-group-item list-group-item-action text-muted p-2" style="font-size:11px;">Obat tidak ditemukan</div>');
                } else {
                    list.forEach(function(item) {
                        let stok = 0;
                        if (item.gudang_barang && item.gudang_barang.length > 0) {
                            stok = item.gudang_barang[0].stok || 0;
                        }
                        const sat = item.kode_satuan?.satuan || item.kode_sat || '';
                        const a = $(`
                            <a href="javascript:void(0)" class="list-group-item list-group-item-action p-2" style="font-size: 11.5px;">
                                <div class="d-flex justify-content-between align-items-center">
                                    <strong>${item.nama_brng}</strong>
                                    <span class="badge ${stok > 0 ? 'bg-success' : 'bg-danger'}">${stok} ${sat}</span>
                                </div>
                                <small class="text-muted font-monospace">${item.kode_brng}</small>
                            </a>
                        `);
                        a.on('click', function() {
                            $('#inputKodeBrngRalan').val(item.kode_brng);
                            $('#inputCariObatRalan').val(item.nama_brng);
                            $('#lblSatuanObatRalan').text(sat);
                            $('#lblNamaObatTerpilih').text(item.nama_brng);
                            $('#lblStokDepoTerpilih').text(`Stok Depo: ${stok} ${sat}`);
                            $('#boxInfoObatTerpilih').removeAttr('style');
                            $drop.addClass('d-none');
                            $('#inputJmlObatRalan').focus();
                        });
                        $drop.append(a);
                    });
                }
                $drop.removeClass('d-none');
            });
        }, 300);
    });

    $(document).on('click', function(e) {
        if (!$(e.target).closest('#inputCariObatRalan, #dropdownCariObatRalan').length) {
            $('#dropdownCariObatRalan').addClass('d-none');
        }
    });

    // Tambah Obat ke Resep
    function tambahObatKeResep() {
        const kodeBrng = $('#inputKodeBrngRalan').val();
        const jml = $('#inputJmlObatRalan').val();
        const aturan = $('#inputAturanPakaiRalan').val();

        if (!kodeBrng) {
            Swal.fire('Peringatan', 'Silahkan pilih obat dari daftar pencarian terlebih dahulu.', 'warning');
            return;
        }

        if (!jml || jml <= 0) {
            Swal.fire('Peringatan', 'Jumlah obat harus lebih dari 0.', 'warning');
            return;
        }

        $.ajax({
            url: "{{ route('farmasi.resep-ralan.tambah-obat') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                no_resep: currentNoResepRalan,
                kode_brng: kodeBrng,
                jml: jml,
                aturan_pakai: aturan
            },
            beforeSend: function() {
                $('#btnSubmitTambahObat').prop('disabled', true);
            },
            success: function(resp) {
                $('#btnSubmitTambahObat').prop('disabled', false);
                $('#inputKodeBrngRalan').val('');
                $('#inputCariObatRalan').val('');
                $('#inputJmlObatRalan').val('1');
                $('#inputAturanPakaiRalan').val('');
                $('#boxInfoObatTerpilih').attr('style', 'display: none !important;');

                // Reload Data
                loadDataDetailResepRalan(currentNoResepRalan);
            },
            error: function(xhr) {
                $('#btnSubmitTambahObat').prop('disabled', false);
                const msg = xhr.responseJSON?.message || 'Gagal menambahkan obat.';
                Swal.fire('Gagal!', msg, 'error');
            }
        });
    }

    // Buka Modal Edit Item / Substitusi
    function bukaModalEditItem(kode_brng, nama_brng, jml, aturan_pakai) {
        $('#editItemKodeBrng').val(kode_brng);
        $('#editItemKodeBrngBaru').val('');
        $('#editItemNamaBrng').text(nama_brng);
        $('#editItemKodeBrngDisplay').text(`Kode: ${kode_brng}`);
        $('#editItemJml').val(jml);
        $('#editItemAturan').val(aturan_pakai);

        // Reset state substitusi
        $('#editInputCariObatBaru').val('');
        $('#dropdownCariObatSubstitusi').addClass('d-none').empty();
        $('#boxObatPenggantiTerpilih').addClass('d-none');
        $('#btnResetGantiObat').addClass('d-none');

        $('#modalUbahItemRalan').modal('show');
    }

    // Live search obat pengganti (Substitusi)
    let timerCariSubstitusiRalan;
    $('#editInputCariObatBaru').on('keyup', function() {
        const keyword = $(this).val().trim();
        clearTimeout(timerCariSubstitusiRalan);
        if (keyword.length < 2) {
            $('#dropdownCariObatSubstitusi').addClass('d-none').empty();
            return;
        }

        timerCariSubstitusiRalan = setTimeout(function() {
            $.get("{{ url('/obat/cari') }}", { nama: keyword, gudang: currentKdBangsalRalan }).done(function(res) {
                const list = res?.data || [];
                const $drop = $('#dropdownCariObatSubstitusi');
                $drop.empty();

                if (list.length === 0) {
                    $drop.append('<div class="list-group-item list-group-item-action text-muted p-2" style="font-size:11px;">Obat tidak ditemukan</div>');
                } else {
                    list.forEach(function(item) {
                        let stok = 0;
                        if (item.gudang_barang && item.gudang_barang.length > 0) {
                            stok = item.gudang_barang[0].stok || 0;
                        }
                        const sat = item.kode_satuan?.satuan || item.kode_sat || '';
                        const a = $(`
                            <a href="javascript:void(0)" class="list-group-item list-group-item-action p-2" style="font-size: 11.5px;">
                                <div class="d-flex justify-content-between align-items-center">
                                    <strong>${item.nama_brng}</strong>
                                    <span class="badge ${stok > 0 ? 'bg-success' : 'bg-danger'}">${stok} ${sat}</span>
                                </div>
                                <small class="text-muted font-monospace">${item.kode_brng}</small>
                            </a>
                        `);
                        a.on('click', function() {
                            $('#editItemKodeBrngBaru').val(item.kode_brng);
                            $('#editInputCariObatBaru').val(item.nama_brng);
                            $('#lblObatPenggantiTerpilih').text(`Obat Pengganti: ${item.nama_brng} (${item.kode_brng})`);
                            $('#lblStokPenggantiTerpilih').text(`Stok Depo: ${stok} ${sat}`);
                            $('#boxObatPenggantiTerpilih').removeClass('d-none');
                            $('#btnResetGantiObat').removeClass('d-none');
                            $drop.addClass('d-none');
                        });
                        $drop.append(a);
                    });
                }
                $drop.removeClass('d-none');
            });
        }, 300);
    });

    $(document).on('click', function(e) {
        if (!$(e.target).closest('#editInputCariObatBaru, #dropdownCariObatSubstitusi').length) {
            $('#dropdownCariObatSubstitusi').addClass('d-none');
        }
    });

    // Reset obat pengganti
    function resetObatPengganti() {
        $('#editItemKodeBrngBaru').val('');
        $('#editInputCariObatBaru').val('');
        $('#boxObatPenggantiTerpilih').addClass('d-none');
        $('#btnResetGantiObat').addClass('d-none');
        $('#dropdownCariObatSubstitusi').addClass('d-none').empty();
    }

    // Simpan Perubahan / Substitusi Item
    function simpanPerubahanItemRalan() {
        const kodeBrng = $('#editItemKodeBrng').val();
        const kodeBrngBaru = $('#editItemKodeBrngBaru').val();
        const jml = $('#editItemJml').val();
        const aturan = $('#editItemAturan').val();

        if (!jml || jml <= 0) {
            Swal.fire('Peringatan', 'Jumlah obat harus lebih dari 0.', 'warning');
            return;
        }

        $.ajax({
            url: "{{ route('farmasi.resep-ralan.ubah-obat') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                no_resep: currentNoResepRalan,
                kode_brng: kodeBrng,
                kode_brng_baru: kodeBrngBaru,
                jml: jml,
                aturan_pakai: aturan
            },
            beforeSend: function() {
                Swal.fire({ title: 'Menyimpan Perubahan...', allowOutsideClick: false, didOpen: () => { Swal.showLoading(); } });
            },
            success: function(resp) {
                Swal.close();
                $('#modalUbahItemRalan').modal('hide');
                loadDataDetailResepRalan(currentNoResepRalan);
            },
            error: function(xhr) {
                const msg = xhr.responseJSON?.message || 'Gagal mengubah item resep.';
                Swal.fire('Gagal!', msg, 'error');
            }
        });
    }

    // Hapus Item Resep
    function hapusItemResep(kode_brng, nama_brng) {
        Swal.fire({
            title: 'Hapus Item Obat?',
            text: `Yakin ingin menghapus ${nama_brng} dari resep ini?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('farmasi.resep-ralan.hapus-obat') }}",
                    type: "DELETE",
                    data: {
                        _token: "{{ csrf_token() }}",
                        no_resep: currentNoResepRalan,
                        kode_brng: kodeBrng
                    },
                    success: function() {
                        loadDataDetailResepRalan(currentNoResepRalan);
                    },
                    error: function(xhr) {
                        const msg = xhr.responseJSON?.message || 'Gagal menghapus item.';
                        Swal.fire('Gagal!', msg, 'error');
                    }
                });
            }
        });
    }

    // Eksekusi Validasi Resep Ralan
    function eksekusiValidasiRalan() {
        Swal.fire({
            title: 'Validasi Resep Obat?',
            text: `Validasi resep ${currentNoResepRalan}? Stok depo obat akan dikurangi dan otomatis masuk ke billing pasien.`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#198754',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Validasi Sekarang!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('farmasi.resep-ralan.validasi') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        no_resep: currentNoResepRalan
                    },
                    beforeSend: function() {
                        Swal.fire({
                            title: 'Memproses Validasi Resep...',
                            allowOutsideClick: false,
                            didOpen: () => { Swal.showLoading(); }
                        });
                    },
                    success: function(resp) {
                        Swal.fire('Berhasil!', resp.message || 'Resep rawat jalan berhasil divalidasi.', 'success');
                        $('#modalResepObat').modal('hide');
                        if (typeof tbResep === 'function') {
                            $('#tb_resep').DataTable().destroy();
                            tbResep();
                            hitungResep();
                        }
                        if (typeof loadResepRanapFarmasi === 'function') {
                            loadResepRanapFarmasi();
                        }
                    },
                    error: function(xhr) {
                        const msg = xhr.responseJSON?.message || 'Gagal memvalidasi resep.';
                        Swal.fire('Gagal!', msg, 'error');
                    }
                });
            }
        });
    }

    // ==========================================
    // JS MANAJEMEN OBAT RACIKAN RALAN
    // ==========================================

    let globalMetodeRacikList = [];

    // Buka Modal Tambah Header Racikan
    function bukaModalTambahRacikan() {
        $('#modalHeaderRacikanTitle').html('<i class="bi bi-mortarboard me-1"></i> Buat Racikan Baru');
        $('#racikNoRacik').val('');
        $('#racikNama').val('');
        $('#racikJmlDr').val('10');
        $('#racikAturanPakai').val('');
        $('#racikKeterangan').val('-');
        if (globalMetodeRacikList && globalMetodeRacikList.length > 0) {
            $('#racikKdMetode').val(globalMetodeRacikList[0].kd_racik);
        }
        $('#modalHeaderRacikanRalan').modal('show');
    }

    // Buka Modal Edit Header Racikan
    function bukaModalEditHeaderRacikan(no_racik, nama_racik, kd_racik, jml_dr, aturan_pakai, keterangan) {
        $('#modalHeaderRacikanTitle').html('<i class="bi bi-pencil-square me-1"></i> Ubah Info Racikan');
        $('#racikNoRacik').val(no_racik);
        $('#racikNama').val(nama_racik);
        $('#racikKdMetode').val(kd_racik);
        $('#racikJmlDr').val(jml_dr);
        $('#racikAturanPakai').val(aturan_pakai);
        $('#racikKeterangan').val(keterangan);
        $('#modalHeaderRacikanRalan').modal('show');
    }

    // Simpan Header Racikan (Tambah / Edit)
    function simpanHeaderRacikanRalan() {
        const noRacik = $('#racikNoRacik').val();
        const nama = $('#racikNama').val().trim();
        const kdMetode = $('#racikKdMetode').val();
        const jmlDr = $('#racikJmlDr').val();
        const aturan = $('#racikAturanPakai').val().trim();
        const ket = $('#racikKeterangan').val().trim();

        if (!nama) {
            Swal.fire('Peringatan', 'Nama racikan wajib diisi.', 'warning');
            return;
        }
        if (!jmlDr || jmlDr <= 0) {
            Swal.fire('Peringatan', 'Jumlah bungkus racikan harus lebih dari 0.', 'warning');
            return;
        }

        const isEdit = noRacik !== '';
        const targetUrl = isEdit
            ? "{{ route('farmasi.resep-ralan.ubah-racikan') }}"
            : "{{ route('farmasi.resep-ralan.tambah-racikan') }}";

        $.ajax({
            url: targetUrl,
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                no_resep: currentNoResepRalan,
                no_racik: noRacik,
                nama_racik: nama,
                kd_racik: kdMetode,
                jml_dr: jmlDr,
                aturan_pakai: aturan,
                keterangan: ket
            },
            beforeSend: function() {
                Swal.fire({ title: 'Menyimpan Racikan...', allowOutsideClick: false, didOpen: () => { Swal.showLoading(); } });
            },
            success: function(resp) {
                Swal.close();
                $('#modalHeaderRacikanRalan').modal('hide');
                loadDataDetailResepRalan(currentNoResepRalan);
            },
            error: function(xhr) {
                const msg = xhr.responseJSON?.message || 'Gagal menyimpan racikan.';
                Swal.fire('Gagal!', msg, 'error');
            }
        });
    }

    // Hapus Seluruh Racikan
    function hapusRacikan(no_racik, nama_racik) {
        Swal.fire({
            title: 'Hapus Racikan?',
            text: `Yakin ingin menghapus seluruh racikan "${nama_racik}" beserta obat di dalamnya?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('farmasi.resep-ralan.hapus-racikan') }}",
                    type: "DELETE",
                    data: {
                        _token: "{{ csrf_token() }}",
                        no_resep: currentNoResepRalan,
                        no_racik: noRacik
                    },
                    beforeSend: function() {
                        Swal.fire({ title: 'Menghapus Racikan...', allowOutsideClick: false, didOpen: () => { Swal.showLoading(); } });
                    },
                    success: function() {
                        Swal.close();
                        loadDataDetailResepRalan(currentNoResepRalan);
                    },
                    error: function(xhr) {
                        const msg = xhr.responseJSON?.message || 'Gagal menghapus racikan.';
                        Swal.fire('Gagal!', msg, 'error');
                    }
                });
            }
        });
    }

    // Buka Modal Tambah Obat ke Racikan
    function bukaModalTambahItemRacikan(no_racik, nama_racik) {
        $('#tambahItemRacikNoRacik').val(no_racik);
        $('#tambahItemRacikKodeBrng').val('');
        $('#tambahItemRacikNamaRacikDisplay').text(nama_racik);
        $('#tambahItemRacikInputCari').val('');
        $('#tambahItemRacikJml').val('1');
        $('#tambahItemRacikKandungan').val('0');
        $('#dropdownCariObatItemRacik').addClass('d-none').empty();
        $('#boxItemRacikTerpilih').addClass('d-none');
        $('#modalTambahItemRacikanRalan').modal('show');
    }

    // Live search obat untuk tambah item racikan
    let timerCariObatItemRacik;
    $('#tambahItemRacikInputCari').on('keyup', function() {
        const keyword = $(this).val().trim();
        clearTimeout(timerCariObatItemRacik);
        if (keyword.length < 2) {
            $('#dropdownCariObatItemRacik').addClass('d-none').empty();
            return;
        }

        timerCariObatItemRacik = setTimeout(function() {
            $.get("{{ url('/obat/cari') }}", { nama: keyword, gudang: currentKdBangsalRalan }).done(function(res) {
                const list = res?.data || [];
                const $drop = $('#dropdownCariObatItemRacik');
                $drop.empty();

                if (list.length === 0) {
                    $drop.append('<div class="list-group-item list-group-item-action text-muted p-2" style="font-size:11px;">Obat tidak ditemukan</div>');
                } else {
                    list.forEach(function(item) {
                        let stok = 0;
                        if (item.gudang_barang && item.gudang_barang.length > 0) {
                            stok = item.gudang_barang[0].stok || 0;
                        }
                        const sat = item.kode_satuan?.satuan || item.kode_sat || '';
                        const a = $(`
                            <a href="javascript:void(0)" class="list-group-item list-group-item-action p-2" style="font-size: 11.5px;">
                                <div class="d-flex justify-content-between align-items-center">
                                    <strong>${item.nama_brng}</strong>
                                    <span class="badge ${stok > 0 ? 'bg-success' : 'bg-danger'}">${stok} ${sat}</span>
                                </div>
                                <small class="text-muted font-monospace">${item.kode_brng}</small>
                            </a>
                        `);
                        a.on('click', function() {
                            $('#tambahItemRacikKodeBrng').val(item.kode_brng);
                            $('#tambahItemRacikInputCari').val(item.nama_brng);
                            $('#lblItemRacikTerpilih').text(`${item.nama_brng} (${item.kode_brng})`);
                            $('#lblStokItemRacikTerpilih').text(`Stok Depo: ${stok} ${sat}`);
                            $('#boxItemRacikTerpilih').removeClass('d-none');
                            $drop.addClass('d-none');
                            $('#tambahItemRacikJml').focus();
                        });
                        $drop.append(a);
                    });
                }
                $drop.removeClass('d-none');
            });
        }, 300);
    });

    $(document).on('click', function(e) {
        if (!$(e.target).closest('#tambahItemRacikInputCari, #dropdownCariObatItemRacik').length) {
            $('#dropdownCariObatItemRacik').addClass('d-none');
        }
    });

    // Simpan Item Obat Baru ke Racikan
    function simpanItemKeRacikanRalan() {
        const noRacik = $('#tambahItemRacikNoRacik').val();
        const kodeBrng = $('#tambahItemRacikKodeBrng').val();
        const jml = $('#tambahItemRacikJml').val();
        const kandungan = $('#tambahItemRacikKandungan').val() || 0;

        if (!kodeBrng) {
            Swal.fire('Peringatan', 'Silahkan pilih obat dari daftar pencarian terlebih dahulu.', 'warning');
            return;
        }
        if (!jml || jml <= 0) {
            Swal.fire('Peringatan', 'Jumlah obat racikan harus lebih dari 0.', 'warning');
            return;
        }

        $.ajax({
            url: "{{ route('farmasi.resep-ralan.tambah-item-racikan') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                no_resep: currentNoResepRalan,
                no_racik: noRacik,
                kode_brng: kodeBrng,
                jml: jml,
                kandungan: kandungan
            },
            beforeSend: function() {
                Swal.fire({ title: 'Menambahkan Bahan...', allowOutsideClick: false, didOpen: () => { Swal.showLoading(); } });
            },
            success: function() {
                Swal.close();
                $('#modalTambahItemRacikanRalan').modal('hide');
                loadDataDetailResepRalan(currentNoResepRalan);
            },
            error: function(xhr) {
                const msg = xhr.responseJSON?.message || 'Gagal menambahkan bahan obat.';
                Swal.fire('Gagal!', msg, 'error');
            }
        });
    }

    // Buka Modal Edit / Substitusi Item Obat di Racikan
    function bukaModalEditItemRacikan(no_racik, kode_brng, nama_brng, jml, kandungan) {
        $('#editRacikItemNoRacik').val(no_racik);
        $('#editRacikItemKodeBrng').val(kode_brng);
        $('#editRacikItemKodeBrngBaru').val('');
        $('#editRacikItemNamaBrng').text(nama_brng);
        $('#editRacikItemKodeBrngDisplay').text(`Kode: ${kode_brng}`);
        $('#editRacikItemJml').val(jml);
        $('#editRacikItemKandungan').val(kandungan || 0);

        // Reset state substitusi
        $('#editRacikInputCariObatBaru').val('');
        $('#dropdownCariObatSubstitusiRacik').addClass('d-none').empty();
        $('#boxObatPenggantiTerpilihRacik').addClass('d-none');
        $('#btnResetGantiObatRacik').addClass('d-none');

        $('#modalUbahItemRacikanRalan').modal('show');
    }

    // Live search obat pengganti racikan (Substitusi)
    let timerCariSubstitusiRacik;
    $('#editRacikInputCariObatBaru').on('keyup', function() {
        const keyword = $(this).val().trim();
        clearTimeout(timerCariSubstitusiRacik);
        if (keyword.length < 2) {
            $('#dropdownCariObatSubstitusiRacik').addClass('d-none').empty();
            return;
        }

        timerCariSubstitusiRacik = setTimeout(function() {
            $.get("{{ url('/obat/cari') }}", { nama: keyword, gudang: currentKdBangsalRalan }).done(function(res) {
                const list = res?.data || [];
                const $drop = $('#dropdownCariObatSubstitusiRacik');
                $drop.empty();

                if (list.length === 0) {
                    $drop.append('<div class="list-group-item list-group-item-action text-muted p-2" style="font-size:11px;">Obat tidak ditemukan</div>');
                } else {
                    list.forEach(function(item) {
                        let stok = 0;
                        if (item.gudang_barang && item.gudang_barang.length > 0) {
                            stok = item.gudang_barang[0].stok || 0;
                        }
                        const sat = item.kode_satuan?.satuan || item.kode_sat || '';
                        const a = $(`
                            <a href="javascript:void(0)" class="list-group-item list-group-item-action p-2" style="font-size: 11.5px;">
                                <div class="d-flex justify-content-between align-items-center">
                                    <strong>${item.nama_brng}</strong>
                                    <span class="badge ${stok > 0 ? 'bg-success' : 'bg-danger'}">${stok} ${sat}</span>
                                </div>
                                <small class="text-muted font-monospace">${item.kode_brng}</small>
                            </a>
                        `);
                        a.on('click', function() {
                            $('#editRacikItemKodeBrngBaru').val(item.kode_brng);
                            $('#editRacikInputCariObatBaru').val(item.nama_brng);
                            $('#lblObatPenggantiTerpilihRacik').text(`Bahan Pengganti: ${item.nama_brng} (${item.kode_brng})`);
                            $('#lblStokPenggantiTerpilihRacik').text(`Stok Depo: ${stok} ${sat}`);
                            $('#boxObatPenggantiTerpilihRacik').removeClass('d-none');
                            $('#btnResetGantiObatRacik').removeClass('d-none');
                            $drop.addClass('d-none');
                        });
                        $drop.append(a);
                    });
                }
                $drop.removeClass('d-none');
            });
        }, 300);
    });

    $(document).on('click', function(e) {
        if (!$(e.target).closest('#editRacikInputCariObatBaru, #dropdownCariObatSubstitusiRacik').length) {
            $('#dropdownCariObatSubstitusiRacik').addClass('d-none');
        }
    });

    // Reset obat pengganti racikan
    function resetObatPenggantiRacik() {
        $('#editRacikItemKodeBrngBaru').val('');
        $('#editRacikInputCariObatBaru').val('');
        $('#boxObatPenggantiTerpilihRacik').addClass('d-none');
        $('#btnResetGantiObatRacik').addClass('d-none');
        $('#dropdownCariObatSubstitusiRacik').addClass('d-none').empty();
    }

    // Simpan Perubahan / Substitusi Item di Racikan
    function simpanPerubahanItemRacikanRalan() {
        const noRacik = $('#editRacikItemNoRacik').val();
        const kodeBrng = $('#editRacikItemKodeBrng').val();
        const kodeBrngBaru = $('#editRacikItemKodeBrngBaru').val();
        const jml = $('#editRacikItemJml').val();
        const kandungan = $('#editRacikItemKandungan').val() || 0;

        if (!jml || jml <= 0) {
            Swal.fire('Peringatan', 'Jumlah obat racikan harus lebih dari 0.', 'warning');
            return;
        }

        $.ajax({
            url: "{{ route('farmasi.resep-ralan.ubah-item-racikan') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                no_resep: currentNoResepRalan,
                no_racik: noRacik,
                kode_brng: kodeBrng,
                kode_brng_baru: kodeBrngBaru,
                jml: jml,
                kandungan: kandungan
            },
            beforeSend: function() {
                Swal.fire({ title: 'Menyimpan Perubahan...', allowOutsideClick: false, didOpen: () => { Swal.showLoading(); } });
            },
            success: function() {
                Swal.close();
                $('#modalUbahItemRacikanRalan').modal('hide');
                loadDataDetailResepRalan(currentNoResepRalan);
            },
            error: function(xhr) {
                const msg = xhr.responseJSON?.message || 'Gagal mengubah bahan racikan.';
                Swal.fire('Gagal!', msg, 'error');
            }
        });
    }

    // Hapus Item dari Racikan
    function hapusItemRacikan(no_racik, kode_brng, nama_brng) {
        Swal.fire({
            title: 'Hapus Bahan Racikan?',
            text: `Yakin ingin menghapus ${nama_brng} dari racikan ini?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('farmasi.resep-ralan.hapus-item-racikan') }}",
                    type: "DELETE",
                    data: {
                        _token: "{{ csrf_token() }}",
                        no_resep: currentNoResepRalan,
                        no_racik: noRacik,
                        kode_brng: kodeBrng
                    },
                    beforeSend: function() {
                        Swal.fire({ title: 'Menghapus Bahan...', allowOutsideClick: false, didOpen: () => { Swal.showLoading(); } });
                    },
                    success: function() {
                        Swal.close();
                        loadDataDetailResepRalan(currentNoResepRalan);
                    },
                    error: function(xhr) {
                        const msg = xhr.responseJSON?.message || 'Gagal menghapus bahan.';
                        Swal.fire('Gagal!', msg, 'error');
                    }
                });
            }
        });
    }

    function numberFormat(val) {
        if (!val) return '0';
        return Number(val).toLocaleString('id-ID');
    }
</script>
@endpush
