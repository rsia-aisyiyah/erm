<!-- Modal Pemberian Obat Pasien Ranap (E-MAR) -->
<style>
    .swal2-popup.swal2-toast {
        font-size: 11.5px !important;
        padding: 6px 12px !important;
        width: auto !important;
        max-width: 320px !important;
        border-radius: 8px !important;
    }
    .swal2-popup.swal2-toast .swal2-title {
        font-size: 11.5px !important;
        margin: 0 !important;
        font-weight: 600 !important;
    }
    .swal2-popup.swal2-toast .swal2-html-container {
        font-size: 11px !important;
        margin: 0 !important;
    }
    .swal2-popup.swal2-toast .swal2-icon {
        width: 1.25rem !important;
        height: 1.25rem !important;
        min-width: 1.25rem !important;
        margin: 0 8px 0 0 !important;
    }
    .swal2-popup.swal2-toast .swal2-icon .swal2-icon-content {
        font-size: 0.85rem !important;
    }
</style>
<div class="modal fade" id="modalPemberianObatRanap" tabindex="-1" aria-labelledby="modalPemberianObatRanapLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content border-0 shadow">
            
            <!-- Modal Header -->
            <div class="modal-header text-white py-2 px-3 justify-content-between align-items-center" style="background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);">
                <div class="d-flex align-items-center gap-2">
                    <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                        <i class="bi bi-capsule-pill fs-5 text-warning"></i>
                    </div>
                    <div>
                        <h6 class="modal-title fw-bold mb-0 text-white" id="modalPemberianObatRanapLabel">
                            JADWAL &amp; PEMBERIAN OBAT PASIEN (E-MAR)
                        </h6>
                        <small class="text-white-50" style="font-size: 11px;">Electronic Medication Administration Record - Eksekusi Pemberian Obat Ranap &amp; Billing Pasien</small>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <button type="button" class="btn btn-light btn-sm py-1 px-2.5 shadow-sm text-primary fw-bold" onclick="cetakFormulirRm5a()" title="Cetak Lembar Daftar Pemberian Obat Resmi (Format Rekam Medis RM 5A)">
                        <i class="bi bi-printer-fill me-1"></i> Cetak RM 5A
                    </button>
                    <button type="button" class="btn btn-warning btn-sm py-1 px-2.5 shadow-sm text-dark fw-bold" onclick="bukaModalReturUdd()" title="Kembalikan sisa obat UDD yang tidak digunakan ke Depo Farmasi (Pasien Pulang / Stop Terapi)">
                        <i class="bi bi-arrow-return-left me-1"></i> Retur Sisa UDD
                    </button>
                    <span class="badge bg-light text-primary px-2 py-1 shadow-sm font-monospace" id="badgeTanggalEmar" style="font-size: 11px;">
                        <i class="bi bi-calendar3 me-1"></i> Hari Ini
                    </span>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>

            <!-- Modal Body -->
            <div class="modal-body p-3 bg-light">
                
                <!-- PATIENT INFO BANNER -->
                <div class="card border-0 shadow-sm rounded-3 mb-3 bg-white">
                    <div class="card-body p-2.5">
                        <div class="row g-2 align-items-center" style="font-size: 11.5px;">
                            <div class="col-md-2 col-6">
                                <label class="text-muted small mb-0 d-block" style="font-size: 10px;">NO. RAWAT</label>
                                <strong class="text-primary font-monospace" id="emar_info_no_rawat">-</strong>
                            </div>
                            <div class="col-md-2 col-6">
                                <label class="text-muted small mb-0 d-block" style="font-size: 10px;">NO. REKAM MEDIS</label>
                                <strong class="text-dark font-monospace" id="emar_info_no_rkm_medis">-</strong>
                            </div>
                            <div class="col-md-3 col-12">
                                <label class="text-muted small mb-0 d-block" style="font-size: 10px;">NAMA PASIEN</label>
                                <strong class="text-dark" id="emar_info_nm_pasien">-</strong>
                            </div>
                            <div class="col-md-3 col-6">
                                <label class="text-muted small mb-0 d-block" style="font-size: 10px;">KAMAR / BANGSAL</label>
                                <strong class="text-dark" id="emar_info_kamar">-</strong>
                            </div>
                            <div class="col-md-2 col-6 text-md-end">
                                <label class="text-muted small mb-0 d-block" style="font-size: 10px;">STATUS ALERGI</label>
                                <span class="badge bg-light text-dark border px-2 py-1" id="emar_info_alergi">Tidak Ada</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- NAV PILLS SWITCHER MODE -->
                <ul class="nav nav-pills mb-3 bg-white p-1 rounded-3 border shadow-sm" id="pills-tab-emar" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active py-1.5 px-3 fw-bold btn-sm" id="tab-matriks-harian-link" data-bs-toggle="pill" data-bs-target="#tab-matriks-harian" type="button" role="tab" onclick="loadEmarPasien()" style="font-size: 12px;">
                            <i class="bi bi-grid-3x3-gap-fill me-1 text-primary"></i> 1. Matriks Jam Harian (Eksekusi 24 Jam)
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link py-1.5 px-3 fw-bold btn-sm" id="tab-rekap-rm5a-link" data-bs-toggle="pill" data-bs-target="#tab-rekap-rm5a" type="button" role="tab" onclick="loadRekapRm5a()" style="font-size: 12px;">
                            <i class="bi bi-file-earmark-medical-fill me-1 text-success"></i> 2. Tinjau Lembar RM 5A (Daftar Pemberian Obat Multi-Hari)
                        </button>
                    </li>
                </ul>

                <!-- TAB CONTENT -->
                <div class="tab-content" id="pills-tab-emarContent">

                    <!-- TAB 1: MATRIKS JAM HARIAN (REALTIME EKSEKUSI) -->
                    <div class="tab-pane fade show active" id="tab-matriks-harian" role="tabpanel">
                        <!-- CONTROL BAR & FILTER TANGGAL -->
                        <div class="card border-0 shadow-sm rounded-3 mb-3 bg-white">
                            <div class="card-body py-2 px-3">
                                <div class="row g-2 align-items-center justify-content-between">
                                    <div class="col-md-5 col-12 d-flex align-items-center gap-2">
                                        <label class="form-label small fw-bold mb-0 text-nowrap" style="font-size: 11.5px;">
                                            <i class="bi bi-calendar-event text-primary me-1"></i> Tanggal E-MAR:
                                        </label>
                                        <input type="date" class="form-control form-control-sm w-auto" id="emar_filter_tanggal" value="{{ date('Y-m-d') }}" onchange="loadEmarPasien()">
                                        <button type="button" class="btn btn-outline-primary btn-sm py-1 px-2" onclick="loadEmarPasien()" title="Muat Data">
                                            <i class="bi bi-arrow-clockwise"></i> Muat
                                        </button>
                                    </div>
                                    <div class="col-md-7 col-12 text-md-end text-start">
                                        <span class="badge bg-success-subtle text-success border border-success me-1" style="font-size: 10.5px;">
                                            <i class="bi bi-check-circle-fill me-1"></i> Sudah Diberikan
                                        </span>
                                        <span class="badge bg-warning-subtle text-dark border border-warning me-1" style="font-size: 10.5px;">
                                            <i class="bi bi-clock-fill text-warning me-1"></i> Dijadwalkan (Belum Diberikan)
                                        </span>
                                        <span class="badge bg-secondary-subtle text-muted border border-secondary" style="font-size: 10.5px;">
                                            - Tidak Dijadwalkan
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- CARD DAFTAR OBAT & TIMELINE 24 JAM -->
                        <div class="card border-0 shadow-sm rounded-3 bg-white mb-3">
                            <div class="card-header bg-white border-bottom py-2 d-flex justify-content-between align-items-center">
                                <span class="fw-bold text-secondary" style="font-size: 12px;">
                                    <i class="bi bi-grid-3x3-gap-fill text-primary me-1"></i> Matriks Jadwal &amp; Stok Obat Pasien (24 Jam)
                                </span>
                                <span class="small text-muted" id="lblCountObatEmar">0 jenis obat</span>
                            </div>
                            <div class="card-body p-2.5">
                                <div id="containerListEmarObat">
                                    <div class="text-center text-muted py-4">
                                        <i class="bi bi-inbox fs-2 d-block mb-1 text-secondary"></i>
                                        Memuat matriks obat pasien...
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- TABEL LOG RIWAYAT PEMBERIAN HARI INI -->
                        <div class="card border-0 shadow-sm rounded-3 bg-white">
                            <div class="card-header bg-white border-bottom py-2 d-flex justify-content-between align-items-center">
                                <span class="fw-bold text-secondary" style="font-size: 12px;">
                                    <i class="bi bi-journal-check text-success me-1"></i> Log Pemberian Obat Hari Ini (Billing Ranap)
                                </span>
                                <span class="small text-muted" id="lblTotalBillingEmar">Total Pemberian: 0 item</span>
                            </div>
                            <div class="card-body p-2">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover table-sm align-middle mb-0" id="tbLogPemberianEmar" style="font-size: 11.5px;">
                                        <thead class="table-light text-center">
                                            <tr>
                                                <th width="4%">No</th>
                                                <th width="10%">Jam Beri</th>
                                                <th width="24%">Nama Obat / BHP</th>
                                                <th width="14%">Pintu Sumber</th>
                                                <th width="8%">Dosis</th>
                                                <th width="8%">Satuan</th>
                                                <th width="14%">Aturan Pakai</th>
                                                <th width="12%">Status Billing</th>
                                                <th width="6%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbodyLogPemberianEmar">
                                            <tr>
                                                <td colspan="9" class="text-center text-muted py-3">Belum ada pemberian obat hari ini.</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 2: TINJAU LEMBAR RM 5A (FORMAT RESMI PERSIS LAMPIRAN 1) -->
                    <div class="tab-pane fade" id="tab-rekap-rm5a" role="tabpanel">
                        <!-- CONTROL BAR FILTER RENTANG RM 5A -->
                        <div class="card border-0 shadow-sm rounded-3 mb-3 bg-white">
                            <div class="card-body py-2 px-3">
                                <div class="row g-2 align-items-center justify-content-between">
                                    <div class="col-md-7 col-12 d-flex align-items-center gap-2 flex-wrap">
                                        <label class="form-label small fw-bold mb-0 text-nowrap" style="font-size: 11.5px;">
                                            <i class="bi bi-calendar-range text-success me-1"></i> Mulai Tanggal (6 Kolom):
                                        </label>
                                        <input type="date" class="form-control form-control-sm w-auto" id="rm5a_filter_tgl_awal">
                                        <button type="button" class="btn btn-outline-success btn-sm py-1 px-2.5 fw-semibold" onclick="loadRekapRm5a()" title="Muat Ulang Tinjauan RM 5A">
                                            <i class="bi bi-arrow-clockwise me-1"></i> Muat Lembar
                                        </button>
                                    </div>
                                    <div class="col-md-5 col-12 text-md-end text-start">
                                        <button type="button" class="btn btn-primary btn-sm py-1.5 px-3 fw-bold shadow-sm" onclick="cetakFormulirRm5a()">
                                            <i class="bi bi-printer-fill me-1"></i> Cetak Dokumen PDF (RM 5A)
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- CONTAINER LEMBAR TABEL RM 5A -->
                        <div class="card border-0 shadow-sm rounded-3 bg-white">
                            <div class="card-body p-3 overflow-auto" id="containerTinjauRm5a" style="min-height: 380px;">
                                <div class="text-center text-muted py-5">
                                    <i class="bi bi-file-earmark-medical fs-1 text-secondary d-block mb-2"></i>
                                    Klik tombol <b>Muat Lembar</b> atau buka tab ini untuk menampilkan rekap data Daftar Pemberian Obat.
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <div class="modal-footer py-1.5 px-3 bg-white">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
            </div>

        </div>
    </div>
</div>

<!-- Submodal Form Dialog Pemberian Obat -->
<div class="modal fade" id="modalDialogEksekusiBeriObat" tabindex="-1" aria-hidden="true" style="z-index: 1060;">
    <div class="modal-dialog modal-dialog-centered modal-lg" style="max-width: 760px;">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-success text-white py-2 px-3">
                <h6 class="modal-title fw-bold" style="font-size: 13px;">
                    <i class="bi bi-capsule me-1"></i> Catat Pemberian Obat (E-MAR)
                </h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">
                <form id="formEksekusiBeriObat">
                    <input type="hidden" id="eksekusi_no_rawat">
                    <input type="hidden" id="eksekusi_kode_brng">
                    <input type="hidden" id="eksekusi_no_batch">
                    <input type="hidden" id="eksekusi_no_faktur">
                    <input type="hidden" id="eksekusi_kd_bangsal">
                    <input type="hidden" id="eksekusi_sumber" value="permintaan_harian">
                    <input type="hidden" id="eksekusi_no_resep" value="">

                    <!-- Baris Atas: Info Obat (Kiri) & Tanggal/Jam Beri (Kanan) -->
                    <div class="card border-0 bg-light p-2.5 mb-2 rounded-3">
                        <div class="row g-2 align-items-center">
                            <div class="col-md-7 col-12">
                                <div class="d-flex align-items-center gap-2 mb-1">
                                    <span class="badge" id="lblEksekusiSumberBadge">Sumber</span>
                                    <small class="text-muted" id="lblEksekusiNoResep"></small>
                                </div>
                                <div class="fw-bold text-dark fs-6 text-truncate" id="lblEksekusiNamaObat" title="Nama Obat">-</div>
                                <small class="text-success fw-semibold" id="lblEksekusiSisaStok">Sisa Stok: 0</small>
                            </div>
                            <div class="col-md-5 col-12">
                                <div class="row g-1.5">
                                    <div class="col-6">
                                        <label class="form-label small fw-bold mb-1" style="font-size: 11px;">Tanggal</label>
                                        <input type="date" class="form-control form-control-sm" id="eksekusi_tanggal" value="{{ date('Y-m-d') }}">
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label small fw-bold mb-1" style="font-size: 11px;">Jam Beri</label>
                                        <input type="time" step="1" class="form-control form-control-sm text-center" id="eksekusi_jam" value="{{ date('H:i:s') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="alert py-1.5 px-2.5 mb-2 rounded-2 small d-none" id="alertEksekusiInfo" style="font-size: 11px;"></div>

                    <!-- Dosis / Jumlah Diberikan & Tool Kalkulator (Ukuran & Tinggi Konsisten 31px) -->
                    <div class="row g-2 align-items-end mb-2">
                        <div class="col-md-6 col-12">
                            <label class="form-label small fw-bold mb-1" style="font-size: 11px;">Dosis / Jumlah Diberikan</label>
                            <div class="input-group input-group-sm">
                                <input type="number" class="form-control form-control-sm text-center fw-bold" id="eksekusi_jml" value="1" min="0.0001" step="any" style="height: 31px; font-size: 12px;">
                                <span class="input-group-text fw-semibold" id="lblEksekusiSatuan" style="height: 31px; font-size: 11.5px; min-width: 65px; justify-content: center;">Sat</span>
                            </div>
                            <div class="mt-1 small text-muted d-none" id="lblKalkulatorSummary" style="font-size: 10.5px;"></div>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="form-label small fw-bold mb-1 d-none d-md-block text-muted" style="font-size: 11px; visibility: hidden;">Kalkulator</label>
                            <button type="button" class="btn btn-outline-primary btn-sm w-100 fw-semibold d-flex align-items-center justify-content-center" id="btnToggleKalkulatorDosis" style="height: 31px; font-size: 11.5px;">
                                <i class="bi bi-calculator me-1"></i> Hitung Dosis / Racikan
                            </button>
                        </div>
                    </div>

                    <!-- Panel Kalkulator Dosis (Metode Racikan) -->
                    <div class="card border border-primary border-opacity-25 bg-light mb-2.5 rounded-3 shadow-sm d-none" id="panelKalkulatorDosis">
                        <div class="card-header bg-primary bg-opacity-10 py-1.5 px-2.5 d-flex justify-content-between align-items-center">
                            <span class="fw-bold text-primary small" style="font-size: 11.5px;">
                                <i class="bi bi-calculator-fill me-1"></i> Hitung Berdasarkan Dosis / Sediaan (Metode Racikan)
                            </span>
                            <button type="button" class="btn-close" style="font-size: 9px;" id="btnCloseKalkulatorDosis" aria-label="Tutup"></button>
                        </div>
                        <div class="card-body p-2.5">
                            <!-- 4 Kolom Sejajar: Kapasitas, Dosis Diminta, P1/P2, Pecahan Cepat -->
                            <div class="row g-2 mb-2 align-items-center">
                                <div class="col-md-3 col-6">
                                    <label class="form-label mb-1 fw-semibold text-muted" style="font-size: 10.5px;" title="Kapasitas total kemasan obat utuh (misal: 100 ml, 500 ml, 500 mg)">
                                        Kapasitas Sediaan (Kps)
                                    </label>
                                    <div class="input-group input-group-sm">
                                        <input type="number" step="any" min="0" class="form-control form-control-sm text-center px-1" id="kalk_kps" placeholder="Contoh: 500" style="height: 31px; font-size: 11.5px;">
                                        <select class="form-select form-select-sm px-1 text-center" id="kalk_satuan_kps" style="max-width: 58px; font-size: 11px; height: 31px;">
                                            <option value="ml">ml</option>
                                            <option value="mg">mg</option>
                                            <option value="gr">gr</option>
                                            <option value="cc">cc</option>
                                            <option value="mcg">mcg</option>
                                            <option value="iu">IU</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <label class="form-label mb-1 fw-semibold text-success" style="font-size: 10.5px;" title="Jumlah dosis atau volume yang dibutuhkan pasien">
                                        Dosis Diminta <span class="badge bg-success-subtle text-success py-0 px-1 font-monospace" id="lblKalkSatuanKebutuhan">ml</span>
                                    </label>
                                    <div class="input-group input-group-sm">
                                        <input type="number" step="any" min="0" class="form-control form-control-sm text-center px-1 fw-bold border-success text-success" id="kalk_dosis_diminta" placeholder="Contoh: 100" style="height: 31px; font-size: 11.5px;">
                                        <button class="btn btn-outline-success btn-sm px-1.5" type="button" id="btnApplyKalkulator" title="Terapkan ke Jumlah Diberikan" style="height: 31px;">
                                            <i class="bi bi-check-lg"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <label class="form-label mb-1 fw-semibold text-primary" style="font-size: 10.5px;" title="Pecahan bagian sediaan seperti metode racikan (contoh: 1/2)">
                                        P1 / P2 (Pecahan)
                                    </label>
                                    <div class="input-group input-group-sm">
                                        <input type="number" step="any" min="0" class="form-control form-control-sm text-center px-1 fw-bold text-primary" id="kalk_p1" placeholder="P1" value="1" style="height: 31px; font-size: 11.5px;">
                                        <span class="input-group-text px-1 fw-bold bg-white text-muted" style="height: 31px;">/</span>
                                        <input type="number" step="any" min="1" class="form-control form-control-sm text-center px-1 fw-bold text-primary" id="kalk_p2" placeholder="P2" value="1" style="height: 31px; font-size: 11.5px;">
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <label class="form-label mb-1 text-muted fw-semibold" style="font-size: 10.5px;">Pecahan Cepat:</label>
                                    <div class="btn-group btn-group-sm w-100" role="group">
                                        <button type="button" class="btn btn-outline-secondary py-1 px-1 btn-quick-fraction" data-p1="1" data-p2="4" style="font-size: 10.5px; height: 31px;">¼</button>
                                        <button type="button" class="btn btn-outline-secondary py-1 px-1 btn-quick-fraction" data-p1="1" data-p2="3" style="font-size: 10.5px; height: 31px;">⅓</button>
                                        <button type="button" class="btn btn-outline-secondary py-1 px-1 btn-quick-fraction" data-p1="1" data-p2="2" style="font-size: 10.5px; height: 31px;">½</button>
                                        <button type="button" class="btn btn-outline-secondary py-1 px-1 btn-quick-fraction" data-p1="3" data-p2="4" style="font-size: 10.5px; height: 31px;">¾</button>
                                        <button type="button" class="btn btn-outline-secondary py-1 px-1 btn-quick-fraction" data-p1="1" data-p2="1" style="font-size: 10.5px; height: 31px;">1</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Feedback Ringkasan Perhitungan -->
                            <div class="rounded-2 p-1.5 px-2 bg-white border border-primary-subtle d-flex justify-content-between align-items-center" style="font-size: 11px;">
                                <div class="text-secondary small text-truncate me-2" id="lblKalkFormulaText" style="font-size: 10.5px;">
                                    Rumus: 1 kemasan utuh
                                </div>
                                <div class="text-nowrap">
                                    <span class="text-muted small me-1">Hasil:</span>
                                    <span class="fw-bold text-primary font-monospace" id="lblKalkHasilDosis" style="font-size: 12px;">1 Kemasan</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Baris Aturan Pakai & Keterangan (Sejajar 2 Kolom) -->
                    <div class="row g-2 mb-2">
                        <div class="col-md-6 col-12">
                            <label class="form-label small fw-bold mb-1">Aturan Pakai</label>
                            <input type="text" class="form-control form-control-sm" id="eksekusi_aturan_pakai" placeholder="Aturan pakai...">
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="form-label small fw-bold mb-1">Keterangan / Catatan Dosis (Opsional)</label>
                            <input type="text" class="form-control form-control-sm" id="eksekusi_keterangan" placeholder="Contoh: Diberikan 100 ml via infus pump...">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer py-1.5 px-3 bg-light">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-success btn-sm px-3 fw-bold" id="btnSimpanEksekusiBeriObat">
                    <i class="bi bi-check-lg me-1"></i> Simpan Pemberian
                </button>
            </div>
        </div>
    </div>
</div>

@push('script')
<script>
    // Helper Normalisasi Format Tanggal ISO (YYYY-MM-DD)
    function normalkanTanggalIso(tglStr) {
        if (!tglStr) return moment().format('YYYY-MM-DD');
        const clean = tglStr.toString().trim().replace(/\//g, '-');
        const m = moment(clean, ['YYYY-MM-DD', 'DD-MM-YYYY', 'D-M-YYYY']);
        return m.isValid() ? m.format('YYYY-MM-DD') : moment().format('YYYY-MM-DD');
    }

    // Buka Modal E-MAR Pemberian Obat Ranap
    function modalPemberianObatRanap(noRawat) {
        if (!noRawat) {
            Swal.fire('Peringatan', 'No. Rawat tidak valid.', 'warning');
            return;
        }

        const safeNoRawat = (noRawat || '').trim();
        const tglHariIni = moment().format('YYYY-MM-DD');

        $('#emar_info_no_rawat').text(safeNoRawat);
        $('#eksekusi_no_rawat').val(safeNoRawat);
        $('#emar_filter_tanggal').val(tglHariIni);

        // Reset container sebelum memuat agar bersih
        $('#containerListEmarObat').html('<div class="text-center text-muted py-4"><i class="bi bi-hourglass-split fs-3 d-block mb-1"></i> Memuat data E-MAR...</div>');
        $('#tbodyLogPemberianEmar').html('<tr><td colspan="9" class="text-center text-muted py-3">Memuat data log pemberian...</td></tr>');

        // Load data pasien & kamar
        getRegPeriksa(safeNoRawat).done(function(res) {
            const pasien = res?.pasien || {};
            const kamarList = res?.kamar_inap || [];

            let kamarNama = '-';
            if (kamarList.length > 0) {
                const activeKamar = kamarList.find(k => k.stts_pulang === '-') || kamarList[0];
                kamarNama = activeKamar?.kamar?.bangsal?.nm_bangsal || activeKamar?.kd_kamar || '-';
            }

            $('#emar_info_no_rkm_medis').text(pasien?.no_rkm_medis || '-');
            $('#emar_info_nm_pasien').text(pasien?.nm_pasien || '-');
            $('#emar_info_kamar').text(kamarNama);

            // Alergi
            const alergi = res?.alergi || '-';
            $('#emar_info_alergi').text(alergi && alergi !== '-' ? alergi : 'Tidak Ada');
            if (alergi && alergi !== '-' && alergi !== 'Tidak Ada') {
                $('#emar_info_alergi').removeClass('bg-light text-dark').addClass('bg-danger text-white');
            } else {
                $('#emar_info_alergi').removeClass('bg-danger text-white').addClass('bg-light text-dark');
            }
        });

        // Set default tab kembali ke tab 1 (Matriks Jam Harian)
        $('#tab-matriks-harian-link').tab('show');

        $('#modalPemberianObatRanap').modal('show');
        loadEmarPasien(safeNoRawat, tglHariIni);
    }

    // Pastikan data dimuat otomatis saat modal selesai tampil penuh
    $('#modalPemberianObatRanap').on('shown.bs.modal', function() {
        const noRawat = ($('#emar_info_no_rawat').text() || '').trim();
        if (noRawat && noRawat !== '-') {
            loadEmarPasien(noRawat);
        }
    });

    // Load data E-MAR Pasien (Stok obat + matriks 24 jam)
    function loadEmarPasien(targetNoRawat = null, targetTanggal = null) {
        const noRawat = (targetNoRawat || $('#emar_info_no_rawat').text() || '').trim();
        const rawTgl = targetTanggal || $('#emar_filter_tanggal').val();
        const tanggal = normalkanTanggalIso(rawTgl);
        if (!noRawat || noRawat === '-') return;

        $('#emar_filter_tanggal').val(tanggal);
        $('#badgeTanggalEmar').html(`<i class="bi bi-calendar3 me-1"></i> ${tanggal}`);

        const $container = $('#containerListEmarObat');
        $container.html('<div class="text-center text-muted py-4"><i class="bi bi-hourglass-split fs-3 d-block mb-1"></i> Memuat data E-MAR...</div>');

        $.get("{{ route('ranap.pemberian-obat.stok') }}", {
            no_rawat: noRawat,
            tanggal: tanggal,
            _t: new Date().getTime()
        }).done(function(resp) {
            const items = resp?.data || [];
            $container.empty();

            $('#lblCountObatEmar').text(`${items.length} jenis obat`);

            if (items.length === 0) {
                $container.html(`
                    <div class="text-center text-muted py-4">
                        <i class="bi bi-exclamation-circle fs-2 text-warning d-block mb-2"></i>
                        <strong>Belum ada stok obat pasien untuk rawat inap ini.</strong>
                        <p class="small mb-0 text-secondary">Silahkan buat permintaan obat terlebih dahulu melalui menu <b>Permintaan Obat Pasien</b> agar disiapkan oleh Farmasi.</p>
                    </div>
                `);
                loadLogPemberianHariIni(noRawat, tanggal);
                return;
            }

            items.forEach(function(item, idx) {
                // Buat 24 kotak jam
                let timelineBoxes = '';
                for (let h = 0; h <= 23; h++) {
                    const pad = String(h).padStart(2, '0');
                    const jamKey = `jam${pad}`;
                    const isDijadwalkan = item.jadwal_jam[jamKey] === true;

                    // Cek apakah di jam range ini sudah ada pemberian
                    // Range jam h:00:00 s/d h:59:59
                    const pemberianJam = item.pemberian_hari_ini?.find(p => {
                        const pHour = parseInt(p.jam.split(':')[0], 10);
                        return pHour === h;
                    });

                    if (pemberianJam) {
                        // Sudah Diberikan
                        const dosisTampil = (pemberianJam.dosis_klinis !== undefined) ? pemberianJam.dosis_klinis : (pemberianJam.jml || '');
                        const ketText = pemberianJam.keterangan ? ` (${pemberianJam.keterangan})` : '';
                        timelineBoxes += `
                            <div class="p-1 text-center" style="flex: 1 0 4%; min-width: 38px;">
                                <div class="bg-success text-white rounded p-1 shadow-sm" style="font-size: 9.5px; cursor: default;" title="Sudah diberikan: ${dosisTampil} ${item.satuan} pada ${pemberianJam.jam}${ketText} (${pemberianJam.status_billing || ''})">
                                    <span class="d-block fw-bold">${pad}:00</span>
                                    <i class="bi bi-check-circle-fill"></i>
                                    <span class="d-block" style="font-size: 8.5px;">${dosisTampil}</span>
                                </div>
                            </div>
                        `;
                    } else if (isDijadwalkan) {
                        if (item.sisa_stok <= 0) {
                            // Dijadwalkan tapi Stok Pasien Sudah Habis
                            timelineBoxes += `
                                <div class="p-1 text-center" style="flex: 1 0 4%; min-width: 38px;">
                                    <button type="button" class="btn btn-secondary btn-sm p-1 w-100 opacity-50 shadow-sm" style="font-size: 9.5px;" onclick="bukaDialogBeriObat('${item.kode_brng}', '${item.nama_brng.replace(/'/g, "\\'")}', '${item.satuan}', '${item.no_batch || ''}', '${item.no_faktur || ''}', '${item.kd_bangsal || ''}', '${item.aturan_pakai.replace(/'/g, "\\'")}', ${item.sisa_stok}, '${pad}:00:00', '${item.sumber || 'permintaan_harian'}', '${item.no_resep || ''}', ${item.kapasitas || 0})" title="Stok pasien habis (0 ${item.satuan})">
                                        <span class="d-block fw-bold">${pad}:00</span>
                                        <i class="bi bi-x-circle"></i>
                                        <span class="d-block" style="font-size: 8.5px;">Habis</span>
                                    </button>
                                </div>
                            `;
                        } else {
                            // Dijadwalkan tapi Belum Diberikan
                            timelineBoxes += `
                                <div class="p-1 text-center" style="flex: 1 0 4%; min-width: 38px;">
                                    <button type="button" class="btn btn-warning btn-sm p-1 w-100 shadow-sm" style="font-size: 9.5px;" onclick="bukaDialogBeriObat('${item.kode_brng}', '${item.nama_brng.replace(/'/g, "\\'")}', '${item.satuan}', '${item.no_batch || ''}', '${item.no_faktur || ''}', '${item.kd_bangsal || ''}', '${item.aturan_pakai.replace(/'/g, "\\'")}', ${item.sisa_stok}, '${pad}:00:00', '${item.sumber || 'permintaan_harian'}', '${item.no_resep || ''}', ${item.kapasitas || 0})" title="Klik untuk catat pemberian jam ${pad}:00">
                                        <span class="d-block fw-bold">${pad}:00</span>
                                        <i class="bi bi-plus-circle"></i>
                                        <span class="d-block" style="font-size: 8.5px;">Beri</span>
                                    </button>
                                </div>
                            `;
                        }
                    } else {
                        // Tidak Dijadwalkan
                        timelineBoxes += `
                            <div class="p-1 text-center" style="flex: 1 0 4%; min-width: 38px;">
                                <div class="bg-light text-muted border rounded p-1" style="font-size: 9.5px;" title="Tidak dijadwalkan">
                                    <span class="d-block">${pad}:00</span>
                                    <span>-</span>
                                </div>
                            </div>
                        `;
                    }
                }

                const sisaBadgeClass = item.sisa_stok > 0 ? 'bg-success' : 'bg-danger';

                const btnCatatHtml = item.sisa_stok > 0
                    ? `<button type="button" class="btn btn-outline-success btn-sm py-1 px-2.5 shadow-sm" style="font-size: 11px;" onclick="bukaDialogBeriObat('${item.kode_brng}', '${item.nama_brng.replace(/'/g, "\\'")}', '${item.satuan}', '${item.no_batch || ''}', '${item.no_faktur || ''}', '${item.kd_bangsal || ''}', '${item.aturan_pakai.replace(/'/g, "\\'")}', ${item.sisa_stok}, '', '${item.sumber || 'permintaan_harian'}', '${item.no_resep || ''}', ${item.kapasitas || 0})">
                           <i class="bi bi-plus-lg me-1"></i> Catat Pemberian
                       </button>`
                    : `<button type="button" class="btn btn-secondary btn-sm py-1 px-2.5 opacity-75 shadow-sm" style="font-size: 11px;" onclick="bukaDialogBeriObat('${item.kode_brng}', '${item.nama_brng.replace(/'/g, "\\'")}', '${item.satuan}', '${item.no_batch || ''}', '${item.no_faktur || ''}', '${item.kd_bangsal || ''}', '${item.aturan_pakai.replace(/'/g, "\\'")}', ${item.sisa_stok}, '', '${item.sumber || 'permintaan_harian'}', '${item.no_resep || ''}', ${item.kapasitas || 0})" title="Stok obat pasien habis">
                           <i class="bi bi-x-circle me-1"></i> Stok Habis
                       </button>`;

                const sumberBadge = item.sumber === 'resep_dokter'
                    ? `<span class="badge bg-primary-subtle text-primary border border-primary px-2 py-0.5 rounded-pill" style="font-size: 10px;"><i class="bi bi-prescription2 me-1"></i> Resep DPJP Ranap (${item.no_resep || '-'})</span>`
                    : `<span class="badge bg-info-subtle text-dark border border-info px-2 py-0.5 rounded-pill" style="font-size: 10px;"><i class="bi bi-box-seam me-1"></i> Permintaan Harian / BHP</span>`;

                const cardHtml = `
                    <div class="card border rounded-3 mb-2 shadow-sm bg-white">
                        <div class="card-body p-2.5">
                            <div class="row g-2 align-items-center mb-2">
                                <div class="col-md-5 col-12">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center fw-bold" style="width: 28px; height: 28px; font-size: 11px;">
                                            ${idx + 1}
                                        </div>
                                        <div>
                                            <div class="d-flex align-items-center gap-1.5 flex-wrap">
                                                <strong class="text-dark" style="font-size: 12.5px;">${item.nama_brng}</strong>
                                                ${sumberBadge}
                                            </div>
                                            <small class="text-muted" style="font-size: 10.5px;">
                                                Aturan: <b class="text-dark">${item.aturan_pakai}</b> | Batch: ${item.no_batch || '-'}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="d-flex gap-2 align-items-center" style="font-size: 11px;">
                                        <span class="badge bg-light text-dark border">Masuk: <b>${item.total_masuk}</b> ${item.satuan}</span>
                                        <span class="badge bg-light text-dark border">Keluar: <b>${item.total_diberikan}</b> ${item.satuan}</span>
                                        <span class="badge ${sisaBadgeClass}">Sisa: <b>${item.sisa_stok}</b> ${item.satuan}</span>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12 text-md-end text-start">
                                    ${btnCatatHtml}
                                </div>
                            </div>

                            <!-- TIMELINE 24 JAM HORIZONTAL SCROLL -->
                            <div class="d-flex overflow-auto pb-1 bg-light rounded-2 p-1 border" style="font-size: 10px;">
                                ${timelineBoxes}
                            </div>
                        </div>
                    </div>
                `;
                $container.append(cardHtml);
            });

            loadLogPemberianHariIni(noRawat, tanggal);
        });
    }

    // Load Log Riwayat Pemberian Hari Ini
    function loadLogPemberianHariIni(noRawat, tanggal) {
        const safeTanggal = normalkanTanggalIso(tanggal);
        const $tbody = $('#tbodyLogPemberianEmar');
        $tbody.html('<tr><td colspan="9" class="text-center text-muted py-3">Memuat data log pemberian...</td></tr>');

        $.get("{{ route('ranap.pemberian-obat.riwayat') }}", {
            no_rawat: noRawat,
            tanggal: safeTanggal,
            _t: new Date().getTime()
        }).done(function(data) {
            $tbody.empty();
            if (!data || data.length === 0) {
                $tbody.html('<tr><td colspan="9" class="text-center text-muted py-3"><i>Belum ada pemberian obat yang dicatat pada tanggal ini.</i></td></tr>');
                $('#lblTotalBillingEmar').text('Total Pemberian: 0 item');
                return;
            }

            let totalRp = 0;
            data.forEach(function(row, idx) {
                totalRp += (parseFloat(row.total_biaya || row.total) || 0);
                const sat = row.satuan || row.data_barang?.kode_satuan?.satuan || row.data_barang?.kode_sat || '-';
                const aturan = row.aturan_pakai?.aturan || row.aturan_pakai || '-';
                const namaObat = row.nama_brng || row.data_barang?.nama_brng || row.kode_brng;
                const dosis = (row.dosis_klinis !== undefined) ? row.dosis_klinis : row.jml;

                const sumberBadge = (row.sumber === 'resep_dokter')
                    ? '<span class="badge bg-primary-subtle text-primary border border-primary px-2 py-0.5 rounded-pill" style="font-size: 10px;"><i class="bi bi-prescription2 me-1"></i> Resep DPJP</span>'
                    : '<span class="badge bg-info-subtle text-dark border border-info px-2 py-0.5 rounded-pill" style="font-size: 10px;"><i class="bi bi-box-seam me-1"></i> Permintaan Harian</span>';

                const statusBillingBadge = (row.status_billing === 'Sudah Dibilkan')
                    ? `<span class="badge bg-success-subtle text-success border border-success px-2 py-0.5 rounded-pill" style="font-size: 10px;" title="Sudah Masuk Billing Ranap Khanza"><i class="bi bi-check-circle-fill me-1"></i> Ter-Billing</span>`
                    : `<span class="badge bg-warning-subtle text-dark border border-warning px-2 py-0.5 rounded-pill" style="font-size: 10px;" title="Dosis pecahan menunggu verifikasi pembulatan Farmasi"><i class="bi bi-clock-fill text-warning me-1"></i> Menunggu Verifikasi</span>`;

                const tr = `
                    <tr>
                        <td class="text-center">${idx + 1}</td>
                        <td class="text-center fw-bold text-primary font-monospace">${row.jam}</td>
                        <td>
                            <strong>${namaObat}</strong>
                            ${row.keterangan ? `<div class="text-muted" style="font-size: 10px;"><i class="bi bi-info-circle me-1"></i>${row.keterangan}</div>` : ''}
                        </td>
                        <td class="text-center">${sumberBadge}</td>
                        <td class="text-center fw-bold text-success">${dosis}</td>
                        <td class="text-center">${sat}</td>
                        <td>${aturan}</td>
                        <td class="text-center">${statusBillingBadge}</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-outline-danger btn-sm p-1" onclick="hapusCatatanPemberian('${row.no_rawat}', '${row.kode_brng}', '${row.tgl_perawatan}', '${row.jam}', '${row.no_batch || ''}', '${row.no_faktur || ''}', ${row.id || 'null'})" title="Hapus Catatan Pemberian">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                `;
                $tbody.append(tr);
            });

            $('#lblTotalBillingEmar').html(`Total: <b>${data.length} pemberian</b>`);
        });
    }

    /**
     * Sederhanakan Pecahan Rasio (Metode Racikan)
     */
    function sederhanakanPecahan(val1, val2) {
        if (!val1 || !val2 || val2 === 0) return { p1: 1, p2: 1 };
        const ratio = val1 / val2;
        const known = [
            { r: 0.1,   p1: 1, p2: 10 },
            { r: 0.125, p1: 1, p2: 8 },
            { r: 0.167, p1: 1, p2: 6 },
            { r: 0.2,   p1: 1, p2: 5 },
            { r: 0.25,  p1: 1, p2: 4 },
            { r: 0.333, p1: 1, p2: 3 },
            { r: 0.4,   p1: 2, p2: 5 },
            { r: 0.5,   p1: 1, p2: 2 },
            { r: 0.6,   p1: 3, p2: 5 },
            { r: 0.667, p1: 2, p2: 3 },
            { r: 0.75,  p1: 3, p2: 4 },
            { r: 0.8,   p1: 4, p2: 5 },
            { r: 1.0,   p1: 1, p2: 1 },
            { r: 1.5,   p1: 3, p2: 2 },
            { r: 2.0,   p1: 2, p2: 1 },
        ];

        for (let k of known) {
            if (Math.abs(ratio - k.r) < 0.02) {
                return { p1: k.p1, p2: k.p2 };
            }
        }

        function gcd(x, y) {
            x = Math.round(Math.abs(x) * 100);
            y = Math.round(Math.abs(y) * 100);
            while (y) {
                let t = y;
                y = x % y;
                x = t;
            }
            return x;
        }

        const divisor = gcd(val1, val2);
        if (divisor > 0) {
            let p1 = Math.round((val1 * 100) / divisor);
            let p2 = Math.round((val2 * 100) / divisor);
            if (p1 > 0 && p2 > 0 && p1 < 100 && p2 < 100) {
                return { p1: p1, p2: p2 };
            }
        }

        return {
            p1: Math.round(val1 * 100) / 100,
            p2: Math.round(val2 * 100) / 100
        };
    }

    /**
     * Parse Kapasitas & Satuan Otomatis dari Nama Obat
     */
    function parseKapasitasDariNama(namaObat) {
        if (!namaObat) return { kapasitas: 0, satuan: 'ml' };
        const clean = namaObat.toUpperCase();

        const matchMl = clean.match(/(\d+(?:[.,]\d+)?)\s*(ML|CC)/i);
        if (matchMl) {
            return {
                kapasitas: parseFloat(matchMl[1].replace(',', '.')),
                satuan: 'ml'
            };
        }

        const matchMgMl = clean.match(/(\d+(?:[.,]\d+)?)\s*MG\s*\/\s*(\d+(?:[.,]\d+)?)\s*ML/i);
        if (matchMgMl) {
            return {
                kapasitas: parseFloat(matchMgMl[2].replace(',', '.')),
                satuan: 'ml'
            };
        }

        const matchMg = clean.match(/(\d+(?:[.,]\d+)?)\s*MG/i);
        if (matchMg) {
            return {
                kapasitas: parseFloat(matchMg[1].replace(',', '.')),
                satuan: 'mg'
            };
        }

        const matchGr = clean.match(/(\d+(?:[.,]\d+)?)\s*(GR|GRAM)/i);
        if (matchGr) {
            return {
                kapasitas: parseFloat(matchGr[1].replace(',', '.')),
                satuan: 'gr'
            };
        }

        const matchIu = clean.match(/(\d+(?:[.,]\d+)?)\s*IU/i);
        if (matchIu) {
            return {
                kapasitas: parseFloat(matchIu[1].replace(',', '.')),
                satuan: 'iu'
            };
        }

        return { kapasitas: 0, satuan: 'ml' };
    }

    /**
     * Hitung Kalkulator Dosis Sediaan (Metode Racikan)
     */
    function hitungKalkulatorDosis(source) {
        const kps = parseFloat($('#kalk_kps').val()) || 0;
        const satuanKps = $('#kalk_satuan_kps').val() || 'ml';
        const satuanUtama = $('#lblEksekusiSatuan').text() || 'Kemasan';

        let p1 = parseFloat($('#kalk_p1').val());
        let p2 = parseFloat($('#kalk_p2').val());
        let dosisDiminta = parseFloat($('#kalk_dosis_diminta').val());
        let jml = parseFloat($('#eksekusi_jml').val());

        if (source === 'dosis_diminta') {
            if (!isNaN(dosisDiminta) && dosisDiminta > 0) {
                if (kps > 0) {
                    const total = dosisDiminta / kps;
                    const roundedTotal = Number(total.toFixed(4));
                    $('#eksekusi_jml').val(roundedTotal);

                    const frac = sederhanakanPecahan(dosisDiminta, kps);
                    $('#kalk_p1').val(frac.p1);
                    $('#kalk_p2').val(frac.p2);

                    updateKalkulatorUI(roundedTotal, frac.p1, frac.p2, dosisDiminta, kps, satuanKps, satuanUtama);
                } else {
                    $('#lblKalkHasilDosis').text(`Isi Kapasitas (Kps)`);
                    $('#lblKalkFormulaText').text(`Kapasitas total sediaan obat harus diisi.`);
                }
            }
        } else if (source === 'p1p2' || source === 'preset_fraction') {
            if (isNaN(p1) || p1 < 0) p1 = 1;
            if (isNaN(p2) || p2 <= 0) p2 = 1;

            const fraction = p1 / p2;
            const roundedTotal = Number(fraction.toFixed(4));
            $('#eksekusi_jml').val(roundedTotal);

            if (kps > 0) {
                const dosis = Number((kps * fraction).toFixed(2));
                $('#kalk_dosis_diminta').val(dosis);
                updateKalkulatorUI(roundedTotal, p1, p2, dosis, kps, satuanKps, satuanUtama);
            } else {
                updateKalkulatorUI(roundedTotal, p1, p2, null, 0, satuanKps, satuanUtama);
            }
        } else if (source === 'kps') {
            if (kps > 0) {
                if (!isNaN(dosisDiminta) && dosisDiminta > 0) {
                    hitungKalkulatorDosis('dosis_diminta');
                } else if (!isNaN(p1) && !isNaN(p2) && p2 > 0) {
                    const fraction = p1 / p2;
                    const roundedTotal = Number(fraction.toFixed(4));
                    const dosis = Number((kps * fraction).toFixed(2));
                    $('#kalk_dosis_diminta').val(dosis);
                    updateKalkulatorUI(roundedTotal, p1, p2, dosis, kps, satuanKps, satuanUtama);
                }
            }
        } else if (source === 'eksekusi_jml') {
            if (!isNaN(jml) && jml > 0) {
                const frac = sederhanakanPecahan(jml, 1);
                $('#kalk_p1').val(frac.p1);
                $('#kalk_p2').val(frac.p2);

                if (kps > 0) {
                    const dosis = Number((jml * kps).toFixed(2));
                    $('#kalk_dosis_diminta').val(dosis);
                    updateKalkulatorUI(jml, frac.p1, frac.p2, dosis, kps, satuanKps, satuanUtama);
                } else {
                    updateKalkulatorUI(jml, frac.p1, frac.p2, null, 0, satuanKps, satuanUtama);
                }
            }
        }
    }

    function updateKalkulatorUI(jml, p1, p2, dosisDiminta, kps, satuanKps, satuanUtama) {
        let formula = '';
        let summaryText = '';
        let autoKet = '';

        if (dosisDiminta !== null && kps > 0) {
            formula = `${dosisDiminta} ${satuanKps} / ${kps} ${satuanKps} = ${jml} ${satuanUtama} (Pecahan ${p1}/${p2})`;
            summaryText = `<i class="bi bi-info-circle me-1"></i> Perhitungan: <b>${dosisDiminta} ${satuanKps}</b> dari sediaan <b>${kps} ${satuanKps}</b> (&asymp; ${jml} ${satuanUtama})`;
            autoKet = `Diberikan ${dosisDiminta} ${satuanKps} (${p1}/${p2} ${satuanUtama})`;
        } else {
            formula = `Pecahan ${p1}/${p2} = ${jml} ${satuanUtama}`;
            summaryText = `<i class="bi bi-info-circle me-1"></i> Perhitungan: Pecahan <b>${p1}/${p2}</b> (&asymp; ${jml} ${satuanUtama})`;
            autoKet = `Diberikan ${p1}/${p2} ${satuanUtama}`;
        }

        $('#lblKalkHasilDosis').text(`${jml} ${satuanUtama}`);
        $('#lblKalkFormulaText').text(formula);
        $('#lblKalkulatorSummary').removeClass('d-none').html(summaryText);

        const currentKet = $('#eksekusi_keterangan').val();
        if (!currentKet || currentKet.startsWith('Diberikan ')) {
            $('#eksekusi_keterangan').val(autoKet);
        }
    }

    // Buka Dialog Eksekusi Pemberian Obat
    function bukaDialogBeriObat(kode, nama, satuan, batch, faktur, bangsal, aturan, sisa, presetJam = '', sumber = 'permintaan_harian', noResep = '', kapasitas = 0) {
        if (sisa <= 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Stok Obat Pasien Habis',
                text: `Stok ${nama} untuk pasien ini sudah habis (0 ${satuan}). Harap buat order permintaan stok obat baru ke Depo Farmasi terlebih dahulu.`,
                confirmButtonColor: '#0d6efd',
            });
            return;
        }

        $('#eksekusi_kode_brng').val(kode);
        $('#eksekusi_no_batch').val(batch || '');
        $('#eksekusi_no_faktur').val(faktur || '');
        $('#eksekusi_kd_bangsal').val(bangsal || 'RM');
        $('#eksekusi_sumber').val(sumber || 'permintaan_harian');
        $('#eksekusi_no_resep').val(noResep || '');
        $('#lblEksekusiNamaObat').text(nama);
        $('#lblEksekusiSatuan').text(satuan);
        $('#lblEksekusiSisaStok').text(`Sisa Stok Pasien: ${sisa} ${satuan}`);
        $('#eksekusi_tanggal').val($('#emar_filter_tanggal').val() || moment().format('YYYY-MM-DD'));
        $('#eksekusi_jam').val(presetJam || moment().format('HH:mm:ss'));
        $('#eksekusi_jml').val('1').attr('max', sisa).data('max-sisa', sisa);
        $('#eksekusi_aturan_pakai').val(aturan || '');
        $('#eksekusi_keterangan').val('');
        $('#lblKalkulatorSummary').addClass('d-none').empty();

        // Inisialisasi Kalkulator Dosis Sediaan
        let kpsFinal = parseFloat(kapasitas) || 0;
        let satFinal = 'ml';

        const parsed = parseKapasitasDariNama(nama);
        if (kpsFinal <= 0 && parsed.kapasitas > 0) {
            kpsFinal = parsed.kapasitas;
            satFinal = parsed.satuan;
        } else if (kpsFinal > 0) {
            satFinal = parsed.satuan || 'ml';
        } else {
            const lowerSat = (satuan || '').toLowerCase();
            const lowerNama = (nama || '').toLowerCase();
            if (lowerSat.includes('botol') || lowerSat.includes('infus') || lowerSat.includes('fls') || lowerSat.includes('ampul') || lowerNama.includes('infus') || lowerNama.includes('sirup') || lowerNama.includes('syrup') || lowerNama.includes('drop')) {
                satFinal = 'ml';
            } else if (lowerSat.includes('tablet') || lowerSat.includes('kapsul') || lowerSat.includes('kaplet') || lowerNama.includes('tab') || lowerNama.includes('caps')) {
                satFinal = 'mg';
            }
        }

        $('#kalk_kps').val(kpsFinal > 0 ? kpsFinal : '');
        $('#kalk_satuan_kps').val(satFinal);
        $('#lblKalkSatuanKebutuhan').text(satFinal);
        $('#kalk_dosis_diminta').val('');
        $('#kalk_p1').val(1);
        $('#kalk_p2').val(1);
        $('#lblKalkHasilDosis').text(`1 ${satuan}`);
        $('#lblKalkFormulaText').text('Rumus: 1 kemasan utuh');

        // Reset panel kalkulator tertutup
        $('#panelKalkulatorDosis').addClass('d-none');
        $('#btnToggleKalkulatorDosis').html('<i class="bi bi-calculator me-1"></i> Hitung Dosis / Racikan').removeClass('btn-outline-danger').addClass('btn-outline-primary');

        const $sumberBadge = $('#lblEksekusiSumberBadge');
        const $alertInfo = $('#alertEksekusiInfo');
        const $lblNoResep = $('#lblEksekusiNoResep');

        if (sumber === 'resep_dokter') {
            $sumberBadge.removeClass().addClass('badge bg-primary text-white').html('<i class="bi bi-prescription2 me-1"></i> Resep DPJP Ranap');
            $lblNoResep.text(noResep ? `No. Resep: ${noResep}` : '');
            $alertInfo.removeClass('d-none alert-info').addClass('alert-primary').html(
                '<i class="bi bi-info-circle me-1"></i> <b>Pre-Billed:</b> Obat resep dokter ini sudah ter-billing saat validasi resep oleh Farmasi. Pencatatan ini murni untuk rekam medis administrasi obat (E-MAR).'
            );
        } else {
            $sumberBadge.removeClass().addClass('badge bg-info text-dark').html('<i class="bi bi-box-seam me-1"></i> Permintaan Harian');
            $lblNoResep.text('');
            $alertInfo.removeClass('d-none alert-primary').addClass('alert-info').html(
                '<i class="bi bi-info-circle me-1"></i> <b>Billing Rekonsiliasi:</b> Dosis pecahan (misal 0.5 ampul) akan diverifikasi dan dibulatkan tagihannya oleh Farmasi.'
            );
        }

        $('#modalDialogEksekusiBeriObat').modal('show');
    }

    // Submit Eksekusi Pemberian Obat
    $('#btnSimpanEksekusiBeriObat').on('click', function() {
        const noRawat = $('#emar_info_no_rawat').text();
        const kode = $('#eksekusi_kode_brng').val();
        const tgl = $('#eksekusi_tanggal').val();
        const jam = $('#eksekusi_jam').val();
        const jml = parseFloat($('#eksekusi_jml').val()) || 0;
        const maxSisa = parseFloat($('#eksekusi_jml').data('max-sisa')) || 0;
        const batch = $('#eksekusi_no_batch').val();
        const faktur = $('#eksekusi_no_faktur').val();
        const bangsal = $('#eksekusi_kd_bangsal').val();
        const aturan = $('#eksekusi_aturan_pakai').val();
        const keterangan = $('#eksekusi_keterangan').val();
        const sumber = $('#eksekusi_sumber').val() || 'permintaan_harian';
        const noResep = $('#eksekusi_no_resep').val() || '';

        if (jml <= 0) {
            Swal.fire('Peringatan', 'Jumlah pemberian obat harus lebih dari 0.', 'warning');
            return;
        }

        if (maxSisa > 0 && jml > maxSisa) {
            Swal.fire('Peringatan', `Jumlah pemberian (${jml}) melebihi sisa stok obat pasien (${maxSisa}).`, 'warning');
            return;
        }

        $.ajax({
            url: "{{ route('ranap.pemberian-obat.simpan') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                no_rawat: noRawat,
                kode_brng: kode,
                tgl_perawatan: tgl,
                jam: jam,
                jml: jml,
                no_batch: batch,
                no_faktur: faktur,
                kd_bangsal: bangsal,
                aturan_pakai: aturan,
                keterangan: keterangan,
                sumber: sumber,
                no_resep: noResep
            },
            beforeSend: function() {
                Swal.fire({ title: 'Menyimpan...', allowOutsideClick: false, didOpen: () => { Swal.showLoading(); } });
            },
            success: function(resp) {
                $('#modalDialogEksekusiBeriObat').modal('hide');
                loadEmarPasien(noRawat, tgl);
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: resp.message || 'Pemberian obat berhasil dicatat.',
                    timer: 1500,
                    showConfirmButton: false
                });
            },
            error: function(xhr) {
                const msg = xhr.responseJSON?.message || 'Gagal mencatat pemberian obat.';
                Swal.fire('Gagal!', msg, 'error');
            }
        });
    });

    // Event listeners Kalkulator Dosis (Metode Racikan)
    $('#btnToggleKalkulatorDosis').on('click', function() {
        const $panel = $('#panelKalkulatorDosis');
        if ($panel.hasClass('d-none')) {
            $panel.removeClass('d-none');
            $(this).html('<i class="bi bi-x-circle me-1"></i> Tutup Kalkulator').removeClass('btn-outline-primary').addClass('btn-outline-danger');
            $('#kalk_dosis_diminta').focus().select();
        } else {
            $panel.addClass('d-none');
            $(this).html('<i class="bi bi-calculator me-1"></i> Hitung Dosis / Racikan').removeClass('btn-outline-danger').addClass('btn-outline-primary');
        }
    });

    $('#btnCloseKalkulatorDosis').on('click', function() {
        $('#panelKalkulatorDosis').addClass('d-none');
        $('#btnToggleKalkulatorDosis').html('<i class="bi bi-calculator me-1"></i> Hitung Dosis / Racikan').removeClass('btn-outline-danger').addClass('btn-outline-primary');
    });

    $('#kalk_dosis_diminta').on('input', function() {
        hitungKalkulatorDosis('dosis_diminta');
    });

    $('#kalk_kps').on('input', function() {
        hitungKalkulatorDosis('kps');
    });

    $('#kalk_satuan_kps').on('change', function() {
        const sat = $(this).val();
        $('#lblKalkSatuanKebutuhan').text(sat);
        hitungKalkulatorDosis('kps');
    });

    $('#kalk_p1, #kalk_p2').on('input', function() {
        hitungKalkulatorDosis('p1p2');
    });

    $(document).on('click', '.btn-quick-fraction', function() {
        const p1 = $(this).data('p1');
        const p2 = $(this).data('p2');
        $('#kalk_p1').val(p1);
        $('#kalk_p2').val(p2);
        hitungKalkulatorDosis('preset_fraction');
    });

    $('#eksekusi_jml').on('input', function() {
        hitungKalkulatorDosis('eksekusi_jml');
    });

    $('#btnApplyKalkulator').on('click', function() {
        hitungKalkulatorDosis('dosis_diminta');
        $('#panelKalkulatorDosis').addClass('d-none');
        $('#btnToggleKalkulatorDosis').html('<i class="bi bi-calculator me-1"></i> Hitung Dosis / Racikan').removeClass('btn-outline-danger').addClass('btn-outline-primary');
    });

    // Hapus Catatan Pemberian Obat
    function hapusCatatanPemberian(noRawat, kode, tgl, jam, batch, faktur, id = null) {
        Swal.fire({
            title: 'Hapus Pemberian Obat?',
            text: `Hapus catatan pemberian obat jam ${jam} pada tanggal ${tgl}?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
        }).then((res) => {
            if (res.isConfirmed) {
                $.ajax({
                    url: "{{ route('ranap.pemberian-obat.hapus') }}",
                    type: "DELETE",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id,
                        no_rawat: noRawat,
                        kode_brng: kode,
                        tgl_perawatan: tgl,
                        jam: jam,
                        no_batch: batch,
                        no_faktur: faktur
                    },
                    success: function(resp) {
                        loadEmarPasien(noRawat, tgl);
                        Swal.fire({
                            icon: 'success',
                            title: 'Dihapus!',
                            text: resp.message || 'Catatan pemberian obat telah dihapus.',
                            timer: 1500,
                            showConfirmButton: false
                        });
                    },
                    error: function(xhr) {
                        const msg = xhr.responseJSON?.message || 'Gagal menghapus pemberian obat.';
                        Swal.fire('Gagal!', msg, 'error');
                    }
                });
            }
        });
    }

    // Helper Format Rupiah
    function formatRupiah(angka) {
        return new Intl.NumberFormat('id-ID').format(angka || 0);
    }

    // ========================================================
    // FITUR FORMULIR RM 5A (DAFTAR PEMBERIAN OBAT)
    // ========================================================

    // 1. Buka Cetak Dokumen PDF Resmi RM 5A
    function cetakFormulirRm5a(tglAwal = '') {
        const noRawat = $('#emar_info_no_rawat').text();
        if (!noRawat || noRawat === '-') {
            Swal.fire('Peringatan', 'Silahkan pilih pasien rawat inap terlebih dahulu.', 'warning');
            return;
        }

        const safeNoRawat = encodeURIComponent(noRawat.replace(/\//g, '-'));
        let url = `{{ url('/ranap/pemberian-obat/cetak-rm5a') }}/${safeNoRawat}`;
        
        const filterTgl = tglAwal || $('#rm5a_filter_tgl_awal').val();
        if (filterTgl) {
            url += `?tgl_awal=${filterTgl}`;
        }
        window.open(url, '_blank');
    }

    // 2. Load Rekap Tabel RM 5A (Multi-Hari) di Layar
    function loadRekapRm5a() {
        const noRawat = $('#emar_info_no_rawat').text();
        const tglAwal = $('#rm5a_filter_tgl_awal').val() || '';
        if (!noRawat || noRawat === '-') return;

        const $container = $('#containerTinjauRm5a');
        $container.html(`
            <div class="text-center text-muted py-5">
                <div class="spinner-border text-success mb-2" role="status"></div>
                <div class="small fw-semibold">Memuat rekap Lembar Daftar Pemberian Obat (RM 5A)...</div>
            </div>
        `);

        $.get("{{ route('ranap.pemberian-obat.rekap-rm5a') }}", {
            no_rawat: noRawat,
            tgl_awal: tglAwal
        }).done(function(resp) {
            if (!resp.status || !resp.data) {
                $container.html('<div class="text-center text-muted py-4">Data rekam pemberian obat tidak ditemukan.</div>');
                return;
            }

            const d = resp.data;
            if (!tglAwal && d.tanggalList && d.tanggalList.length > 0) {
                $('#rm5a_filter_tgl_awal').val(d.tanggalList[0].tanggal);
            }

            renderTampilanLembarRm5a(d);
        }).fail(function(xhr) {
            const msg = xhr.responseJSON?.message || 'Gagal memuat rekap RM 5A.';
            $container.html(`<div class="text-center text-danger py-4"><i class="bi bi-exclamation-triangle fs-2 d-block mb-1"></i>${msg}</div>`);
        });
    }

    // 3. Render HTML Tabel RM 5A Interaktif di Layar
    function renderTampilanLembarRm5a(d) {
        const $container = $('#containerTinjauRm5a');
        $container.empty();

        const tglList = d.tanggalList || [];
        const grupOral = d.grupOral || [];
        const grupInjeksi = d.grupInjeksi || [];
        const grupLain = d.grupLain || [];
        const petugasMap = d.petugasMap || {};

        // Buat Baris Header Tanggal (Subkolom P, S, M)
        let thTanggal1 = '';
        let thTanggal2 = '';
        tglList.forEach(t => {
            thTanggal1 += `<th colspan="3" class="text-center bg-light border" style="font-size: 11px;">Tgl: <b>${t.label}</b></th>`;
            thTanggal2 += `
                <th class="text-center border bg-white" style="font-size: 10px; width: 26px;">P</th>
                <th class="text-center border bg-white" style="font-size: 10px; width: 26px;">S</th>
                <th class="text-center border bg-white" style="font-size: 10px; width: 26px;">M</th>
            `;
        });

        // 1. Render Section ORAL
        let rowsOral = '';
        if (grupOral.length === 0) {
            rowsOral = `<tr><td colspan="${7 + (tglList.length * 3)}" class="text-center text-muted py-2 fst-italic">Tidak ada instruksi obat oral.</td></tr>`;
        } else {
            grupOral.forEach((item, idx) => {
                let cellTgl = '';
                tglList.forEach(t => {
                    const p = item.pemberian[t.tanggal] || { P: '', S: '', M: '' };
                    cellTgl += `
                        <td class="text-center align-middle font-monospace" style="font-size: 10px; background-color: ${p.P ? '#e8f5e9' : 'transparent'}; font-weight: ${p.P ? 'bold' : 'normal'}; color: ${p.P ? '#1b5e20' : 'inherit'};">${p.P || ''}</td>
                        <td class="text-center align-middle font-monospace" style="font-size: 10px; background-color: ${p.S ? '#e8f5e9' : 'transparent'}; font-weight: ${p.S ? 'bold' : 'normal'}; color: ${p.S ? '#1b5e20' : 'inherit'};">${p.S || ''}</td>
                        <td class="text-center align-middle font-monospace" style="font-size: 10px; background-color: ${p.M ? '#e8f5e9' : 'transparent'}; font-weight: ${p.M ? 'bold' : 'normal'}; color: ${p.M ? '#1b5e20' : 'inherit'};">${p.M || ''}</td>
                    `;
                });

                rowsOral += `
                    <tr>
                        <td class="text-center align-middle">${idx + 1}</td>
                        <td class="align-middle"><strong>${item.nama}</strong></td>
                        <td class="text-center align-middle">${item.frekuensi}</td>
                        <td class="text-center align-middle">${item.dosis}</td>
                        <td class="text-center align-middle">${item.ac ? '<i class="bi bi-check-lg text-success fw-bold"></i>' : ''}</td>
                        <td class="text-center align-middle">${item.dc ? '<i class="bi bi-check-lg text-success fw-bold"></i>' : ''}</td>
                        <td class="text-center align-middle">${item.pc ? '<i class="bi bi-check-lg text-success fw-bold"></i>' : ''}</td>
                        ${cellTgl}
                    </tr>
                `;
            });
        }

        // Footer Baris Oral
        let cellDoubleCekOral = '';
        let cellMenyiapkanOral = '';
        let cellMemberikanOral = '';
        tglList.forEach(t => {
            const pet = petugasMap[t.tanggal] || { menyiapkan: '-', P: '-', S: '-', M: '-' };
            cellDoubleCekOral += `<td colspan="3" class="text-center text-success"><i class="bi bi-check-lg"></i></td>`;
            cellMenyiapkanOral += `<td colspan="3" class="text-center fw-bold small text-primary" style="font-size: 10px;">${pet.menyiapkan}</td>`;
            cellMemberikanOral += `
                <td class="text-center small" style="font-size: 9.5px;">${pet.P}</td>
                <td class="text-center small" style="font-size: 9.5px;">${pet.S}</td>
                <td class="text-center small" style="font-size: 9.5px;">${pet.M}</td>
            `;
        });

        // 2. Render Section INJEKSI
        let rowsInjeksi = '';
        if (grupInjeksi.length === 0) {
            rowsInjeksi = `<tr><td colspan="${7 + (tglList.length * 3)}" class="text-center text-muted py-2 fst-italic">Tidak ada instruksi obat injeksi.</td></tr>`;
        } else {
            grupInjeksi.forEach((item, idx) => {
                let cellTgl = '';
                tglList.forEach(t => {
                    const p = item.pemberian[t.tanggal] || { P: '', S: '', M: '' };
                    cellTgl += `
                        <td class="text-center align-middle font-monospace" style="font-size: 10px; background-color: ${p.P ? '#e3f2fd' : 'transparent'}; font-weight: ${p.P ? 'bold' : 'normal'}; color: ${p.P ? '#0d47a1' : 'inherit'};">${p.P || ''}</td>
                        <td class="text-center align-middle font-monospace" style="font-size: 10px; background-color: ${p.S ? '#e3f2fd' : 'transparent'}; font-weight: ${p.S ? 'bold' : 'normal'}; color: ${p.S ? '#0d47a1' : 'inherit'};">${p.S || ''}</td>
                        <td class="text-center align-middle font-monospace" style="font-size: 10px; background-color: ${p.M ? '#e3f2fd' : 'transparent'}; font-weight: ${p.M ? 'bold' : 'normal'}; color: ${p.M ? '#0d47a1' : 'inherit'};">${p.M || ''}</td>
                    `;
                });

                rowsInjeksi += `
                    <tr>
                        <td class="text-center align-middle">${idx + 1}</td>
                        <td class="align-middle"><strong>${item.nama}</strong></td>
                        <td class="text-center align-middle">${item.frekuensi}</td>
                        <td class="text-center align-middle">${item.dosis}</td>
                        <td class="text-center align-middle">${item.iv ? '<i class="bi bi-check-lg text-primary fw-bold"></i>' : ''}</td>
                        <td class="text-center align-middle">${item.im ? '<i class="bi bi-check-lg text-primary fw-bold"></i>' : ''}</td>
                        <td class="text-center align-middle">${item.sc ? '<i class="bi bi-check-lg text-primary fw-bold"></i>' : ''}</td>
                        ${cellTgl}
                    </tr>
                `;
            });
        }

        // 3. Render Section LAIN-LAIN
        let rowsLain = '';
        if (grupLain.length === 0) {
            rowsLain = `<tr><td colspan="${7 + (tglList.length * 3)}" class="text-center text-muted py-2 fst-italic">Tidak ada instruksi terapi lain-lain.</td></tr>`;
        } else {
            grupLain.forEach((item, idx) => {
                let cellTgl = '';
                tglList.forEach(t => {
                    const p = item.pemberian[t.tanggal] || { P: '', S: '', M: '' };
                    cellTgl += `
                        <td class="text-center align-middle font-monospace" style="font-size: 10px;">${p.P || ''}</td>
                        <td class="text-center align-middle font-monospace" style="font-size: 10px;">${p.S || ''}</td>
                        <td class="text-center align-middle font-monospace" style="font-size: 10px;">${p.M || ''}</td>
                    `;
                });

                rowsLain += `
                    <tr>
                        <td class="text-center align-middle">${idx + 1}</td>
                        <td class="align-middle"><strong>${item.nama}</strong></td>
                        <td class="text-center align-middle">${item.frekuensi}</td>
                        <td colspan="4" class="align-middle small">${item.keterangan}</td>
                        ${cellTgl}
                    </tr>
                `;
            });
        }

        // Susun Tabel Keseluruhan
        const html = `
            <div class="border rounded p-3 bg-white shadow-sm" style="font-family: inherit;">
                <!-- Header Dokumen Ringkas -->
                <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-2 flex-wrap gap-2">
                    <div>
                        <h6 class="fw-bold mb-0 text-dark">DAFTAR PEMBERIAN OBAT (RM 5A)</h6>
                        <small class="text-muted">RSIA Aisyiyah Pekajangan • Rekap Pemberian Obat Ranap</small>
                    </div>
                    <div class="text-end small">
                        <span class="badge bg-primary me-1">DPJP: ${d.dokterDpjp || '-'}</span>
                        <span class="badge bg-light text-dark border">Kamar: ${d.kamarDisplay || '-'}</span>
                        <span class="badge ${d.alergiDisplay !== 'Tidak Ada' ? 'bg-danger' : 'bg-light text-dark'} border ms-1">Alergi: ${d.alergiDisplay}</span>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-sm align-middle mb-0" style="font-size: 11px;">
                        <!-- HEADER SECTION ORAL -->
                        <thead class="table-light">
                            <tr>
                                <th rowspan="2" class="text-center align-middle" width="3%">No</th>
                                <th rowspan="2" class="align-middle" width="22%">1. ORAL</th>
                                <th rowspan="2" class="text-center align-middle" width="7%">Frek</th>
                                <th rowspan="2" class="text-center align-middle" width="8%">Dosis</th>
                                <th colspan="3" class="text-center align-middle" width="8%">Waktu</th>
                                ${thTanggal1}
                            </tr>
                            <tr>
                                <th class="text-center" width="2.5%" style="font-size: 10px;">Ac</th>
                                <th class="text-center" width="2.5%" style="font-size: 10px;">dc</th>
                                <th class="text-center" width="2.5%" style="font-size: 10px;">pc</th>
                                ${thTanggal2}
                            </tr>
                        </thead>
                        <tbody>
                            ${rowsOral}
                            <!-- Footer Oral -->
                            <tr class="bg-light fw-bold" style="font-size: 10.5px;">
                                <td colspan="4" class="text-end pe-2">Double Cek</td>
                                <td colspan="3" class="text-center text-success"><i class="bi bi-check-lg"></i></td>
                                ${cellDoubleCekOral}
                            </tr>
                            <tr class="bg-light" style="font-size: 10.5px;">
                                <td colspan="7" class="text-end pe-2 fw-semibold">Petugas Menyiapkan</td>
                                ${cellMenyiapkanOral}
                            </tr>
                            <tr class="bg-light border-bottom border-dark" style="font-size: 10.5px;">
                                <td colspan="7" class="text-end pe-2 fw-semibold">Petugas Memberikan</td>
                                ${cellMemberikanOral}
                            </tr>

                            <!-- HEADER SECTION INJEKSI -->
                            <tr class="table-light border-top border-dark">
                                <th rowspan="2" class="text-center align-middle">No</th>
                                <th rowspan="2" class="align-middle">2. INJEKSI</th>
                                <th rowspan="2" class="text-center align-middle">Frek</th>
                                <th rowspan="2" class="text-center align-middle">Dosis</th>
                                <th colspan="3" class="text-center align-middle">Rute</th>
                                ${thTanggal1}
                            </tr>
                            <tr class="table-light">
                                <th class="text-center" style="font-size: 10px;">iv</th>
                                <th class="text-center" style="font-size: 10px;">im</th>
                                <th class="text-center" style="font-size: 10px;">sc</th>
                                ${thTanggal2}
                            </tr>
                            ${rowsInjeksi}
                            <!-- Footer Injeksi -->
                            <tr class="bg-light fw-bold" style="font-size: 10.5px;">
                                <td colspan="4" class="text-end pe-2">Double Cek</td>
                                <td colspan="3" class="text-center text-success"><i class="bi bi-check-lg"></i></td>
                                ${cellDoubleCekOral}
                            </tr>
                            <tr class="bg-light" style="font-size: 10.5px;">
                                <td colspan="7" class="text-end pe-2 fw-semibold">Petugas Menyiapkan</td>
                                ${cellMenyiapkanOral}
                            </tr>
                            <tr class="bg-light border-bottom border-dark" style="font-size: 10.5px;">
                                <td colspan="7" class="text-end pe-2 fw-semibold">Petugas Memberikan</td>
                                ${cellMemberikanOral}
                            </tr>

                            <!-- HEADER SECTION LAIN-LAIN -->
                            <tr class="table-light border-top border-dark">
                                <th rowspan="2" class="text-center align-middle">No</th>
                                <th rowspan="2" class="align-middle">3. LAIN-LAIN</th>
                                <th rowspan="2" class="text-center align-middle">Frek</th>
                                <th colspan="4" rowspan="2" class="text-center align-middle">Keterangan / Dosis</th>
                                ${thTanggal1}
                            </tr>
                            <tr class="table-light">
                                ${thTanggal2}
                            </tr>
                            ${rowsLain}
                            <!-- Footer Lain -->
                            <tr class="bg-light fw-bold" style="font-size: 10.5px;">
                                <td colspan="4" class="text-end pe-2">Double Cek</td>
                                <td colspan="3" class="text-center text-success"><i class="bi bi-check-lg"></i></td>
                                ${cellDoubleCekOral}
                            </tr>
                            <tr class="bg-light" style="font-size: 10.5px;">
                                <td colspan="7" class="text-end pe-2 fw-semibold">Petugas Menyiapkan</td>
                                ${cellMenyiapkanOral}
                            </tr>
                            <tr class="bg-light" style="font-size: 10.5px;">
                                <td colspan="7" class="text-end pe-2 fw-semibold">Petugas Memberikan</td>
                                ${cellMemberikanOral}
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-3 pt-2 border-top text-muted small" style="font-size: 10px;">
                    <span>* Catatan: Data jam terisi otomatis dari riwayat eksekusi perawat pada E-MAR.</span>
                    <span class="font-monospace fw-bold">Rev2/2022-09-01 • RM 5A</span>
                </div>
            </div>
        `;

        $container.html(html);
    }
</script>
@endpush
