@extends('index')

@push('style')
<style>
    @keyframes pulseNewItem {
        0% { background-color: rgba(25, 135, 84, 0.25); }
        50% { background-color: rgba(255, 193, 7, 0.35); }
        100% { background-color: transparent; }
    }
    .row-highlight-baru {
        animation: pulseNewItem 4s ease-out;
    }
    .btn-notif-control {
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        font-weight: 500;
    }
    .btn-notif-control:hover {
        transform: translateY(-1.5px);
    }
    .pill-select-control {
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid #ced4da;
    }
    .pill-select-control:hover, .pill-select-control:focus-within {
        border-color: #0d6efd;
        box-shadow: 0 2px 8px rgba(13, 110, 253, 0.15) !important;
    }

    /* MODERN TOAST NOTIFICATION STYLING */
    .swal2-container.swal2-top-end,
    .swal2-container.swal2-top-right {
        top: 65px !important;
        right: 20px !important;
        padding: 0 !important;
    }
    .swal2-farmasi-toast {
        background: #ffffff !important;
        border-radius: 14px !important;
        box-shadow: 0 18px 45px -8px rgba(15, 23, 42, 0.2), 0 4px 12px -2px rgba(15, 23, 42, 0.08) !important;
        padding: 16px 20px !important;
        border: 1px solid rgba(226, 232, 240, 0.95) !important;
        width: 430px !important;
        max-width: calc(100vw - 36px) !important;
        overflow: hidden !important;
        position: relative !important;
        transition: transform 0.2s ease, box-shadow 0.2s ease !important;
    }
    .swal2-farmasi-toast:hover {
        transform: translateY(-2px) scale(1.01) !important;
        box-shadow: 0 22px 48px -6px rgba(15, 23, 42, 0.25) !important;
    }
    .swal2-farmasi-toast .swal2-title,
    .swal2-farmasi-toast .swal2-html-container {
        padding: 0 !important;
        margin: 0 !important;
        text-align: left !important;
        width: 100% !important;
    }
    .swal2-farmasi-toast .swal2-close {
        position: absolute !important;
        top: 12px !important;
        right: 12px !important;
        width: 26px !important;
        height: 26px !important;
        font-size: 16px !important;
        color: #94a3b8 !important;
        border-radius: 50% !important;
        transition: all 0.15s ease !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        background: #f8fafc !important;
        border: 1px solid #e2e8f0 !important;
        z-index: 10 !important;
    }
    .swal2-farmasi-toast .swal2-close:hover {
        background: #e2e8f0 !important;
        color: #0f172a !important;
    }
    .swal2-farmasi-toast .swal2-timer-progress-bar {
        height: 4px !important;
        border-radius: 0 !important;
        bottom: 0 !important;
    }

    /* Type-specific vertical accent strip & gradient progress bar */
    .toast-border-ralan {
        border-left: 4.5px solid #198754 !important;
    }
    .toast-border-ralan .swal2-timer-progress-bar {
        background: linear-gradient(90deg, #198754, #20c997) !important;
    }

    .toast-border-ranap {
        border-left: 4.5px solid #6f42c1 !important;
    }
    .toast-border-ranap .swal2-timer-progress-bar {
        background: linear-gradient(90deg, #6f42c1, #a855f7) !important;
    }

    .toast-border-udd {
        border-left: 4.5px solid #0d6efd !important;
    }
    .toast-border-udd .swal2-timer-progress-bar {
        background: linear-gradient(90deg, #0d6efd, #38bdf8) !important;
    }

    .toast-border-pulang {
        border-left: 4.5px solid #d63384 !important;
    }
    .toast-border-pulang .swal2-timer-progress-bar {
        background: linear-gradient(90deg, #d63384, #f43f5e) !important;
    }

    .toast-border-warning {
        border-left: 4.5px solid #f59e0b !important;
    }
    .toast-border-warning .swal2-timer-progress-bar {
        background: linear-gradient(90deg, #f59e0b, #fbbf24) !important;
    }

    .toast-border-retur {
        border-left: 4.5px solid #0d6efd !important;
    }
    .toast-border-retur .swal2-timer-progress-bar {
        background: linear-gradient(90deg, #0d6efd, #38bdf8) !important;
    }
</style>
@endpush

@section('contents')
    <!-- BAR KONTROL NOTIFIKASI & AUTO-SYNC FARMASI -->
    <div class="card border-0 shadow-sm rounded-3 mb-2.5 bg-white">
        <div class="card-body py-2 px-3 d-flex flex-wrap justify-content-between align-items-center gap-2">
            <div class="d-flex align-items-center gap-2 flex-wrap">
                <span class="badge bg-light text-secondary border d-inline-flex align-items-center gap-1.5 py-1.5 px-3 rounded-pill shadow-xs" style="font-size: 11.5px;">
                    <span class="spinner-grow spinner-grow-sm text-success" style="width: 7px; height: 7px;" role="status"></span>
                    <span>Auto-Sync: <strong class="text-dark" id="lblSyncStatus">Aktif (20s)</strong></span>
                </span>
                <span class="badge bg-light text-muted border py-1.5 px-2.5 rounded-pill d-none d-md-inline-block" id="lblLastSyncTime" style="font-size: 11px;">
                    <i class="bi bi-clock me-1 text-secondary"></i>Terakhir dicek: -
                </span>
            </div>
            <div class="d-flex align-items-center gap-2 flex-wrap">
                <div class="d-inline-flex align-items-center bg-white rounded-pill ps-3 pe-1 shadow-xs pill-select-control" style="height: 32px;">
                    <i class="bi bi-repeat text-primary me-1.5" style="font-size: 11.5px;"></i>
                    <select class="form-select form-select-sm border-0 bg-transparent py-0 ps-0 pe-4 shadow-none" id="selectReminderInterval" title="Interval pengingat berkala jika masih ada resep menunggu" style="font-size: 11.5px; height: 100%; cursor: pointer; font-weight: 500;">
                        <option value="120" selected>Pengingat: Tiap 2 Menit</option>
                        <option value="180">Pengingat: Tiap 3 Menit</option>
                        <option value="300">Pengingat: Tiap 5 Menit</option>
                        <option value="0">Pengingat: Sekali Saja (Tanpa Pengulangan)</option>
                    </select>
                </div>

                <button type="button" class="btn btn-sm btn-outline-secondary d-inline-flex align-items-center gap-1.5 py-1 px-3 rounded-pill shadow-xs btn-notif-control" id="btnTestChime" title="Uji coba bunyi notifikasi lonceng" style="font-size: 11.5px; height: 32px;">
                    <i class="bi bi-volume-up text-primary"></i> <span>Tes Bunyi</span>
                </button>
                <button type="button" class="btn btn-sm btn-outline-secondary d-inline-flex align-items-center gap-1.5 py-1 px-3 rounded-pill shadow-xs btn-notif-control" id="btnToggleDesktopNotif" title="Aktifkan notifikasi desktop saat browser di-minimize" style="font-size: 11.5px; height: 32px;">
                    <i class="bi bi-display" id="iconDesktopNotif"></i> <span id="lblDesktopNotif">Notif Desktop: OFF</span>
                </button>
                <button type="button" class="btn btn-sm btn-success text-white d-inline-flex align-items-center gap-1.5 py-1 px-3 rounded-pill shadow-xs btn-notif-control" id="btnToggleSound" title="Aktifkan / bisukan bunyi notifikasi saat resep baru masuk" style="font-size: 11.5px; height: 32px;">
                    <i class="bi bi-bell-fill" id="iconSound"></i> <span id="lblSoundStatus">Suara: AKTIF</span>
                </button>
            </div>
        </div>
    </div>

    <!-- NAVIGASI TAB UTAMA FARMASI (SESUAI KHANZA DlgDaftarPermintaanResep) -->
    <ul class="nav nav-pills nav-fill mb-3 bg-white p-1 rounded-3 shadow-sm border" id="pills-farmasi-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active py-2 fw-semibold" id="tab-farmasi-ralan-link" data-bs-toggle="pill" data-bs-target="#tab-farmasi-ralan" type="button" role="tab" style="font-size: 13px;">
                <i class="bi bi-hospital me-1"></i> 1. Antrean Resep Rawat Jalan (Ralan)
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link py-2 fw-semibold" id="tab-farmasi-resep-ranap-link" data-bs-toggle="pill" data-bs-target="#tab-farmasi-resep-ranap" type="button" role="tab" style="font-size: 13px;">
                <i class="bi bi-file-earmark-medical me-1"></i> 2. Resep Dokter Rawat Inap (Ranap)
                <span class="badge bg-danger rounded-pill ms-1" id="badgeCountResepRanapTunggu">0</span>
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link py-2 fw-semibold" id="tab-farmasi-ranap-link" data-bs-toggle="pill" data-bs-target="#tab-farmasi-ranap" type="button" role="tab" style="font-size: 13px;">
                <i class="bi bi-inbox-fill me-1"></i> 3. Permintaan Stok Ranap (UDD)
                <span class="badge bg-danger rounded-pill ms-1" id="badgeCountRanapTunggu">0</span>
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link py-2 fw-semibold" id="tab-farmasi-pulang-link" data-bs-toggle="pill" data-bs-target="#tab-farmasi-pulang" type="button" role="tab" style="font-size: 13px;">
                <i class="bi bi-box-arrow-right me-1"></i> 4. Permintaan Resep Pulang
                <span class="badge bg-danger rounded-pill ms-1" id="badgeCountPulangTunggu">0</span>
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link py-2 fw-semibold" id="tab-farmasi-retur-link" data-bs-toggle="pill" data-bs-target="#tab-farmasi-retur" type="button" role="tab" style="font-size: 13px;">
                <i class="bi bi-arrow-return-left me-1"></i> 5. Pengajuan Retur Ranap
                <span class="badge bg-danger rounded-pill ms-1" id="badgeCountReturTunggu">0</span>
            </button>
        </li>
    </ul>

    <div class="tab-content" id="pills-farmasi-tabContent">
        
        <!-- TAB 1: RESEP RAWAT JALAN (RALAN) -->
        <div class="tab-pane fade show active" id="tab-farmasi-ralan" role="tabpanel">
            <div class="row gy-2">
                <div class="col-sm-12">
                    <div class="card border-0 shadow-sm rounded-3">
                        <div class="card-body p-3">
                            <table class="table-sm mb-0">
                                <tr style="height: 25px">
                                    <td>Jumlah Resep</td>
                                    <td>:</td>
                                    <td width="100px">
                                        <button class="btn btn-sm" id="count-resep"
                                            style="display: block; width:auto; border-radius: 50%; background-color: #0067dd; color:white; font-weight:bold; font-size:9pt">0
                                        </button>
                                    </td>
                                    <td>Selesai</td>
                                    <td>:</td>
                                    <td>
                                        <button id="count-selesai" class="btn btn-sm btn-success"
                                            style="display: block; width:auto; border-radius: 50%; color:white; font-weight:bold; font-size:9pt">0
                                        </button>
                                    </td>
                                </tr>
                                <tr style="height: 40px">
                                    <td>Menunggu</td>
                                    <td>:</td>
                                    <td>
                                        <button id="count-tunggu" class="btn btn-sm btn-warning"
                                            style="display: block; width:auto; border-radius: 50%; color:rgb(48, 48, 48); font-weight:bold; font-size:9pt">0
                                        </button>
                                    </td>
                                    <td>Tidak Ambil</td>
                                    <td>:</td>
                                    <td>
                                        <button id="count-tidak" class="btn btn-sm btn-danger"
                                            style="display: block; width:auto; border-radius: 50%; color:white; font-weight:bold; font-size:9pt">0
                                        </button>
                                    </td>
                                </tr>
                            </table>
                            <input type="hidden" id="hitung-panggil" value="">
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-md-4 col-sm-6">
                    <label for="tgl_peresepan" class="form-label small fw-bold mb-1">Tgl. Resep</label>
                    <input type="text" class="form-control form-control-sm" id="tgl_peresepan" autocomplete="off" value="{{ date('d-m-Y') }}">
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6">
                    <label for="tgl_penyerahan" class="form-label small fw-bold mb-1">Tgl. Penyerahan</label>
                    <input type="text" class="form-control form-control-sm" id="tgl_penyerahan" autocomplete="off" value="{{ date('d-m-Y') }}">
                </div>
                <div class="col-lg-3 col-md-4 col-sm-12">
                    <label class="form-label small d-block mb-1">&nbsp;</label>
                    <button class="btn btn-success btn-sm px-3" id="btnFilterResep" onclick="filterResep()">
                        <i class="bi bi-search me-1"></i> Cari Resep Ralan
                    </button>
                    <x-input type="hidden" name="status" id="status" value="ralan"></x-input>
                </div>

                <div class="col-12 mt-2">
                    <div class="card border-0 shadow-sm rounded-3">
                        <div class="card-body p-2">
                            <table class="table table-striped table-hover table-sm text-sm" id="tb_resep" width="100%">
                                <thead class="table-light">
                                    <tr role="row">
                                        <th>No. Resep &amp; Pasien</th>
                                        <th>Waktu</th>
                                        <th>Status Pelayanan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TAB 2: RESEP DOKTER RAWAT INAP (RANAP) -->
        <div class="tab-pane fade" id="tab-farmasi-resep-ranap" role="tabpanel">
            <div class="row gy-2">
                <!-- Counter Badges Resep Ranap -->
                <div class="col-12">
                    <div class="card border-0 shadow-sm rounded-3">
                        <div class="card-body p-3">
                            <div class="row g-2 text-center">
                                <div class="col-md-4 col-12">
                                    <div class="p-2 border rounded-3 bg-light">
                                        <small class="text-muted d-block" style="font-size: 11px;">TOTAL RESEP DOKTER RANAP</small>
                                        <span class="fs-5 fw-bold text-primary font-monospace" id="count-resep-ranap-total">0</span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-6">
                                    <div class="p-2 border rounded-3 bg-warning-subtle border-warning">
                                        <small class="text-warning-emphasis d-block fw-semibold" style="font-size: 11px;">MENUNGGU PELAYANAN (BELUM)</small>
                                        <span class="fs-5 fw-bold text-warning-emphasis font-monospace" id="count-resep-ranap-menunggu">0</span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-6">
                                    <div class="p-2 border rounded-3 bg-success-subtle border-success">
                                        <small class="text-success-emphasis d-block fw-semibold" style="font-size: 11px;">SUDAH TERLAYANI (SELESAI)</small>
                                        <span class="fs-5 fw-bold text-success font-monospace" id="count-resep-ranap-selesai">0</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filter Controls Resep Ranap -->
                <div class="col-12">
                    <div class="card border-0 shadow-sm rounded-3">
                        <div class="card-body p-2.5">
                            <div class="row g-2 align-items-end">
                                <div class="col-md-2 col-6">
                                    <label class="form-label small fw-bold mb-1" style="font-size: 11px;">Tgl. Awal</label>
                                    <input type="text" class="form-control form-control-sm" id="farmasi_resep_ranap_tgl_awal" value="{{ date('d-m-Y') }}" autocomplete="off">
                                </div>
                                <div class="col-md-2 col-6">
                                    <label class="form-label small fw-bold mb-1" style="font-size: 11px;">Tgl. Akhir</label>
                                    <input type="text" class="form-control form-control-sm" id="farmasi_resep_ranap_tgl_akhir" value="{{ date('d-m-Y') }}" autocomplete="off">
                                </div>
                                <div class="col-md-2 col-6">
                                    <label class="form-label small fw-bold mb-1" style="font-size: 11px;">Status Pelayanan</label>
                                    <select class="form-select form-select-sm" id="farmasi_resep_ranap_status">
                                        <option value="Semua">Semua Status</option>
                                        <option value="Belum" selected>Belum Terlayani</option>
                                        <option value="Sudah">Sudah Terlayani</option>
                                    </select>
                                </div>
                                <div class="col-md-4 col-6">
                                    <label class="form-label small fw-bold mb-1" style="font-size: 11px;">Pencarian (Keyword)</label>
                                    <input type="text" class="form-control form-control-sm" id="farmasi_resep_ranap_keyword" placeholder="No. Resep / No. Rawat / Pasien / Bangsal / Dokter...">
                                </div>
                                <div class="col-md-2 col-12">
                                    <div class="d-flex gap-1">
                                        <button type="button" class="btn btn-primary btn-sm w-100" onclick="loadResepRanapFarmasi()">
                                            <i class="bi bi-search me-1"></i> Filter
                                        </button>
                                        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="loadResepRanapFarmasi()" title="Refresh Data">
                                            <i class="bi bi-arrow-clockwise"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabel Resep Ranap -->
                <div class="col-12">
                    <div class="card border-0 shadow-sm rounded-3">
                        <div class="card-body p-2">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped table-sm align-middle text-sm mb-0" id="tb_farmasi_resep_ranap" width="100%">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="text-center text-nowrap" width="14%">No. Resep &amp; Waktu</th>
                                            <th width="15%">Kamar / Bangsal</th>
                                            <th width="23%">Pasien</th>
                                            <th width="16%">Dokter Peresep</th>
                                            <th class="text-center text-nowrap" width="11%">Telaah Farmasi</th>
                                            <th class="text-center text-nowrap" width="11%">Status Pelayanan</th>
                                            <th class="text-center text-nowrap" width="10%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_farmasi_resep_ranap">
                                        <tr>
                                            <td colspan="7" class="text-center text-muted py-3">Klik tombol filter atau buka tab untuk memuat data.</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TAB 3: PERMINTAAN OBAT RAWAT INAP (RANAP / UDD) -->
        <div class="tab-pane fade" id="tab-farmasi-ranap" role="tabpanel">
            <div class="row gy-2">
                <!-- Counter Badges Ranap -->
                <div class="col-12">
                    <div class="card border-0 shadow-sm rounded-3">
                        <div class="card-body p-3">
                            <div class="row g-2 text-center">
                                <div class="col-md-4 col-12">
                                    <div class="p-2 border rounded-3 bg-light">
                                        <small class="text-muted d-block" style="font-size: 11px;">TOTAL PERMINTAAN UDD</small>
                                        <span class="fs-5 fw-bold text-primary font-monospace" id="count-ranap-total">0</span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-6">
                                    <div class="p-2 border rounded-3 bg-warning-subtle border-warning">
                                        <small class="text-warning-emphasis d-block fw-semibold" style="font-size: 11px;">MENUNGGU PENYIAPAN FARMASI</small>
                                        <span class="fs-5 fw-bold text-warning-emphasis font-monospace" id="count-ranap-menunggu">0</span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-6">
                                    <div class="p-2 border rounded-3 bg-success-subtle border-success">
                                        <small class="text-success-emphasis d-block fw-semibold" style="font-size: 11px;">SUDAH DISIAPKAN (SELESAI)</small>
                                        <span class="fs-5 fw-bold text-success font-monospace" id="count-ranap-selesai">0</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filter Controls Ranap -->
                <div class="col-12">
                    <div class="card border-0 shadow-sm rounded-3">
                        <div class="card-body p-2.5">
                            <div class="row g-2 align-items-end">
                                <div class="col-md-2 col-6">
                                    <label class="form-label small fw-bold mb-1" style="font-size: 11px;">Tgl. Awal</label>
                                    <input type="text" class="form-control form-control-sm" id="farmasi_ranap_tgl_awal" value="{{ date('d-m-Y') }}" autocomplete="off">
                                </div>
                                <div class="col-md-2 col-6">
                                    <label class="form-label small fw-bold mb-1" style="font-size: 11px;">Tgl. Akhir</label>
                                    <input type="text" class="form-control form-control-sm" id="farmasi_ranap_tgl_akhir" value="{{ date('d-m-Y') }}" autocomplete="off">
                                </div>
                                <div class="col-md-2 col-6">
                                    <label class="form-label small fw-bold mb-1" style="font-size: 11px;">Status Pelayanan</label>
                                    <select class="form-select form-select-sm" id="farmasi_ranap_status">
                                        <option value="Semua">Semua Status</option>
                                        <option value="Belum" selected>Menunggu Farmasi (Belum)</option>
                                        <option value="Sudah">Sudah Disiapkan</option>
                                    </select>
                                </div>
                                <div class="col-md-4 col-6">
                                    <label class="form-label small fw-bold mb-1" style="font-size: 11px;">Pencarian (Keyword)</label>
                                    <input type="text" class="form-control form-control-sm" id="farmasi_ranap_keyword" placeholder="No. Permintaan / Pasien / Bangsal...">
                                </div>
                                <div class="col-md-2 col-12">
                                    <div class="d-flex gap-1">
                                        <button type="button" class="btn btn-primary btn-sm w-100" onclick="loadPermintaanRanapFarmasi()">
                                            <i class="bi bi-search me-1"></i> Filter
                                        </button>
                                        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="loadPermintaanRanapFarmasi()" title="Refresh Data">
                                            <i class="bi bi-arrow-clockwise"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabel Permintaan Ranap UDD -->
                <div class="col-12 mt-2">
                    <div class="card border-0 shadow-sm rounded-3">
                        <div class="card-body p-2">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-bordered table-sm align-middle mb-0" id="tb_permintaan_ranap_farmasi" style="font-size: 11.5px;">
                                    <thead class="table-light text-center">
                                        <tr>
                                            <th width="14%">No. Permintaan &amp; Jam</th>
                                            <th width="16%">Kamar / Bangsal</th>
                                            <th width="24%">Pasien</th>
                                            <th width="15%">Dokter Peminta</th>
                                            <th width="11%">Telaah Farmasi</th>
                                            <th width="10%">Status Kesiapan</th>
                                            <th width="10%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_permintaan_ranap_farmasi">
                                        <tr>
                                            <td colspan="7" class="text-center text-muted py-3">Memuat antrean permintaan obat rawat inap...</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- TAB 4: PERMINTAAN RESEP PULANG (SESUAI KHANZA TAB 4) -->
        <div class="tab-pane fade" id="tab-farmasi-pulang" role="tabpanel">
            <div class="row gy-2">
                <!-- Counter Badges Resep Pulang -->
                <div class="col-12">
                    <div class="card border-0 shadow-sm rounded-3">
                        <div class="card-body p-3">
                            <div class="row g-2 text-center">
                                <div class="col-md-4 col-12">
                                    <div class="p-2 border rounded-3 bg-light">
                                        <small class="text-muted d-block" style="font-size: 11px;">TOTAL PERMINTAAN RESEP PULANG</small>
                                        <span class="fs-5 fw-bold text-primary font-monospace" id="count-pulang-total">0</span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-6">
                                    <div class="p-2 border rounded-3 bg-warning-subtle border-warning">
                                        <small class="text-warning-emphasis d-block fw-semibold" style="font-size: 11px;">MENUNGGU FARMASI (BELUM)</small>
                                        <span class="fs-5 fw-bold text-warning-emphasis font-monospace" id="count-pulang-menunggu">0</span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-6">
                                    <div class="p-2 border rounded-3 bg-success-subtle border-success">
                                        <small class="text-success-emphasis d-block fw-semibold" style="font-size: 11px;">SUDAH TERLAYANI (VALIDASI)</small>
                                        <span class="fs-5 fw-bold text-success font-monospace" id="count-pulang-selesai">0</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filter Controls Resep Pulang -->
                <div class="col-12">
                    <div class="card border-0 shadow-sm rounded-3">
                        <div class="card-body p-2.5">
                            <div class="row g-2 align-items-end">
                                <div class="col-md-2 col-6">
                                    <label class="form-label small fw-bold mb-1" style="font-size: 11px;">Tgl. Awal</label>
                                    <input type="text" class="form-control form-control-sm" id="farmasi_pulang_tgl_awal" value="{{ date('d-m-Y') }}" autocomplete="off">
                                </div>
                                <div class="col-md-2 col-6">
                                    <label class="form-label small fw-bold mb-1" style="font-size: 11px;">Tgl. Akhir</label>
                                    <input type="text" class="form-control form-control-sm" id="farmasi_pulang_tgl_akhir" value="{{ date('d-m-Y') }}" autocomplete="off">
                                </div>
                                <div class="col-md-2 col-6">
                                    <label class="form-label small fw-bold mb-1" style="font-size: 11px;">Status Pelayanan</label>
                                    <select class="form-select form-select-sm" id="farmasi_pulang_status">
                                        <option value="Semua">Semua Status</option>
                                        <option value="Belum" selected>Menunggu Farmasi (Belum)</option>
                                        <option value="Sudah">Sudah Disiapkan (Sudah)</option>
                                    </select>
                                </div>
                                <div class="col-md-4 col-6">
                                    <label class="form-label small fw-bold mb-1" style="font-size: 11px;">Pencarian (Keyword)</label>
                                    <input type="text" class="form-control form-control-sm" id="farmasi_pulang_keyword" placeholder="No. Permintaan / Pasien / Kamar / Dokter...">
                                </div>
                                <div class="col-md-2 col-12">
                                    <div class="d-flex gap-1">
                                        <button type="button" class="btn btn-primary btn-sm w-100" onclick="loadPermintaanResepPulangFarmasi()">
                                            <i class="bi bi-search me-1"></i> Filter
                                        </button>
                                        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="loadPermintaanResepPulangFarmasi()" title="Refresh Data">
                                            <i class="bi bi-arrow-clockwise"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabel Resep Pulang -->
                <div class="col-12">
                    <div class="card border-0 shadow-sm rounded-3">
                        <div class="card-body p-2">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped table-sm align-middle text-sm mb-0" id="tb_farmasi_resep_pulang" width="100%">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="text-center" width="15%">No. Permintaan &amp; Waktu</th>
                                            <th width="15%">Kamar / Bangsal</th>
                                            <th width="25%">Pasien</th>
                                            <th width="18%">Dokter Peresep</th>
                                            <th class="text-center" width="10%">Status Validasi</th>
                                            <th class="text-center" width="17%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_farmasi_resep_pulang">
                                        <tr>
                                            <td colspan="6" class="text-center text-muted py-3">Klik tombol filter atau buka tab untuk memuat data.</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TAB 5: PENGAJUAN RETUR OBAT RANAP -->
        <div class="tab-pane fade" id="tab-farmasi-retur" role="tabpanel">
            <div class="row gy-2">
                <!-- Counter Badges Retur Obat -->
                <div class="col-12">
                    <div class="card border-0 shadow-sm rounded-3">
                        <div class="card-body p-3">
                            <div class="row g-2 text-center">
                                <div class="col-md-3 col-6">
                                    <div class="p-2 border rounded-3 bg-light">
                                        <small class="text-muted d-block" style="font-size: 11px;">TOTAL PENGAJUAN RETUR</small>
                                        <span class="fs-5 fw-bold text-primary font-monospace" id="count-retur-total">0</span>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="p-2 border rounded-3 bg-warning-subtle border-warning">
                                        <small class="text-warning-emphasis d-block fw-semibold" style="font-size: 11px;">MENUNGGU VALIDASI</small>
                                        <span class="fs-5 fw-bold text-warning-emphasis font-monospace" id="count-retur-menunggu">0</span>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="p-2 border rounded-3 bg-success-subtle border-success">
                                        <small class="text-success-emphasis d-block fw-semibold" style="font-size: 11px;">SUDAH DISETUJUI</small>
                                        <span class="fs-5 fw-bold text-success font-monospace" id="count-retur-disetujui">0</span>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="p-2 border rounded-3 bg-light">
                                        <small class="text-muted d-block fw-semibold" style="font-size: 11px;">DITOLAK / BATAL</small>
                                        <span class="fs-5 fw-bold text-secondary font-monospace" id="count-retur-ditolak">0</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filter Controls Retur Obat -->
                <div class="col-12">
                    <div class="card border-0 shadow-sm rounded-3">
                        <div class="card-body p-2.5">
                            <div class="row g-2 align-items-end">
                                <div class="col-md-2 col-6">
                                    <label class="form-label small fw-bold mb-1" style="font-size: 11px;">Tgl. Awal</label>
                                    <input type="text" class="form-control form-control-sm" id="farmasi_retur_tgl_awal" value="{{ date('d-m-Y') }}" autocomplete="off">
                                </div>
                                <div class="col-md-2 col-6">
                                    <label class="form-label small fw-bold mb-1" style="font-size: 11px;">Tgl. Akhir</label>
                                    <input type="text" class="form-control form-control-sm" id="farmasi_retur_tgl_akhir" value="{{ date('d-m-Y') }}" autocomplete="off">
                                </div>
                                <div class="col-md-2 col-6">
                                    <label class="form-label small fw-bold mb-1" style="font-size: 11px;">Status Pengajuan</label>
                                    <select class="form-select form-select-sm" id="farmasi_retur_status">
                                        <option value="Semua">Semua Status</option>
                                        <option value="Menunggu Validasi" selected>Menunggu Validasi</option>
                                        <option value="Disetujui">Disetujui</option>
                                        <option value="Ditolak">Ditolak</option>
                                        <option value="Batal">Batal</option>
                                    </select>
                                </div>
                                <div class="col-md-4 col-6">
                                    <label class="form-label small fw-bold mb-1" style="font-size: 11px;">Pencarian (Keyword)</label>
                                    <input type="text" class="form-control form-control-sm" id="farmasi_retur_keyword" placeholder="No. Pengajuan / Pasien / Kamar / Petugas...">
                                </div>
                                <div class="col-md-2 col-12">
                                    <div class="d-flex gap-1">
                                        <button type="button" class="btn btn-primary btn-sm w-100" onclick="loadPengajuanReturFarmasi()">
                                            <i class="bi bi-search me-1"></i> Filter
                                        </button>
                                        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="loadPengajuanReturFarmasi()" title="Refresh Data">
                                            <i class="bi bi-arrow-clockwise"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabel Retur Obat -->
                <div class="col-12">
                    <div class="card border-0 shadow-sm rounded-3">
                        <div class="card-body p-2">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped table-sm align-middle text-sm mb-0" id="tb_farmasi_retur" width="100%">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="text-center" width="16%">No. Pengajuan &amp; Waktu</th>
                                            <th width="15%">Kamar / Bangsal</th>
                                            <th width="22%">Pasien &amp; No. RM</th>
                                            <th width="13%">Petugas Pengaju</th>
                                            <th width="18%">Ringkasan Obat</th>
                                            <th class="text-center" width="10%">Status</th>
                                            <th class="text-center" width="16%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_farmasi_retur">
                                        <tr>
                                            <td colspan="7" class="text-center text-muted py-3">Klik tombol filter atau buka tab untuk memuat data pengajuan retur.</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Submodal Detail Permintaan & Validasi Kesiapan Stok Farmasi -->
    <div class="modal fade" id="modalFarmasiDetailPermintaan" tabindex="-1" aria-hidden="true" style="z-index: 1060;">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-primary text-white py-2 px-3">
                    <h6 class="modal-title fw-bold">Detail Order &amp; Validasi Kesiapan Stok Farmasi</h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-3 bg-light">
                    <!-- Ringkasan Order -->
                    <div class="card border-0 shadow-sm rounded-3 mb-3 bg-white">
                        <div class="card-body p-2.5">
                            <div class="row g-2 align-items-center" style="font-size: 11.5px;">
                                <div class="col-md-3 col-6">
                                    <small class="text-muted d-block" style="font-size: 10px;">NO. PERMINTAAN</small>
                                    <strong class="text-primary font-monospace" id="fDetNoPermintaan">-</strong>
                                </div>
                                <div class="col-md-3 col-6">
                                    <small class="text-muted d-block" style="font-size: 10px;">TGL &amp; JAM ORDER</small>
                                    <span class="text-dark" id="fDetTglJam">-</span>
                                </div>
                                <div class="col-md-3 col-6">
                                    <small class="text-muted d-block" style="font-size: 10px;">PASIEN</small>
                                    <strong class="text-dark" id="fDetPasien">-</strong>
                                </div>
                                <div class="col-md-3 col-6">
                                    <small class="text-muted d-block" style="font-size: 10px;">KAMAR / BANGSAL</small>
                                    <span class="text-dark" id="fDetKamar">-</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tabel Item Obat -->
                    <div class="card border-0 shadow-sm rounded-3 bg-white">
                        <div class="card-header bg-white border-bottom py-2 d-flex justify-content-between align-items-center">
                            <span class="fw-bold small text-secondary">
                                <i class="bi bi-capsule text-primary me-1"></i> Rincian Obat &amp; Jadwal Pemberian Jam
                            </span>
                            <span id="fDetStatusBadge">-</span>
                        </div>
                        <div class="card-body p-2">
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm align-middle mb-0" style="font-size: 11.5px;">
                                    <thead class="table-light text-center">
                                        <tr>
                                            <th width="4%">No</th>
                                            <th width="12%">Kode</th>
                                            <th width="32%">Nama Obat / BHP</th>
                                            <th width="10%">Jumlah</th>
                                            <th width="8%">Satuan</th>
                                            <th width="24%">Aturan Pakai &amp; Jam</th>
                                            <th width="10%">Substitusi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="fDetTbodyObat">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer py-1.5 px-3 bg-white d-flex justify-content-between">
                    <div>
                        <button type="button" class="btn btn-outline-secondary btn-sm" id="btnCetakDariFarmasiDetail">
                            <i class="bi bi-printer me-1"></i> Cetak Lembar Permintaan
                        </button>
                        <button type="button" class="btn btn-teal btn-sm text-white ms-1" style="background-color: #0f766e;" id="btnTelaahDariFarmasiDetail">
                            <i class="bi bi-shield-check me-1"></i> Telaah Farmasi
                        </button>
                    </div>
                    <div>
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-success btn-sm shadow ms-1" id="btnEksekusiValidasiFarmasi">
                            <i class="bi bi-check-circle me-1"></i> Validasi Kesiapan Stok
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('content.farmasi.ralan.modal.modal_resep')
    @include('content.farmasi.modal.modal_telaah_farmasi')
    @include('content.farmasi.modal.modal_substitusi_obat')
    @include('content.farmasi.ralan.modal.modal_resep_pulang_farmasi')
    @include('content.farmasi.modal.modal_validasi_retur_farmasi')
    @include('content.farmasi.ralan.modal.modal_cetak_etiket')
@endsection

@push('script')
    <script>
        function safeJsStr(val) {
            if (val === null || val === undefined) return '';
            return String(val)
                .replace(/[\r\n\t]+/g, ' ')
                .replace(/\\/g, '\\\\')
                .replace(/'/g, "\\'")
                .replace(/"/g, '&quot;')
                .trim();
        }

        function getKamarFormat(regPeriksa) {
            const ki = regPeriksa?.kamar_inap?.[0];
            if (!ki) return '-';
            const kdKamar = (ki.kd_kamar || '').replace(/[\r\n\t]+/g, ' ').trim();
            const nmBangsal = (ki.kamar?.bangsal?.nm_bangsal || '').replace(/[\r\n\t]+/g, ' ').trim();
            if (nmBangsal && kdKamar) {
                return `${nmBangsal} (${kdKamar})`;
            }
            return nmBangsal || kdKamar || '-';
        }

        const tglPeresepan = $('#tgl_peresepan');
        const tglPenyerahan = $('#tgl_penyerahan');

        $(document).ready(function() {
            tbResep();
            hitungResep();
            initNotifikasiDanAutoSyncFarmasi();

            // Inisialisasi datepicker untuk semua tab
            $('#farmasi_ranap_tgl_awal, #farmasi_ranap_tgl_akhir, #farmasi_resep_ranap_tgl_awal, #farmasi_resep_ranap_tgl_akhir, #farmasi_pulang_tgl_awal, #farmasi_pulang_tgl_akhir').datepicker({
                format: 'dd-mm-yyyy',
                orientation: 'bottom',
                autoclose: true,
                todayHighlight: true,
                todayBtn: true,
            });

            // Load data saat tab masing-masing dibuka
            $('#tab-farmasi-resep-ranap-link').on('shown.bs.tab', function() {
                loadResepRanapFarmasi();
            });
            $('#tab-farmasi-ranap-link').on('shown.bs.tab', function() {
                loadPermintaanRanapFarmasi();
            });
            $('#tab-farmasi-pulang-link').on('shown.bs.tab', function() {
                loadPermintaanResepPulangFarmasi();
            });
            $('#tab-farmasi-retur-link').on('shown.bs.tab', function() {
                loadPengajuanReturFarmasi();
            });
        });

        $('#tgl_peresepan, #tgl_penyerahan, #farmasi_retur_tgl_awal, #farmasi_retur_tgl_akhir').datepicker({
            format: 'dd-mm-yyyy',
            orientation: 'bottom',
            autoclose: true,
            todayHighlight: true,
            todayBtn: true,
        });

        function filterResep() {
            tbResep();
        }

        // ========================================================
        // FITUR NOTIFIKASI SUARA (HTML5 AUDIO & WEB AUDIO API DUAL)
        // Default Permanen: Nada Bandara Klasik (D5 -> F#5 -> A5 -> D6)
        // ========================================================

        const sndChimeMasuk = new Audio("{{ asset('sound/nada-airport.wav') }}?v=bandara2026");
        const sndChimeReminder = new Audio("{{ asset('sound/nada-airport.wav') }}?v=bandara2026");
        sndChimeMasuk.preload = 'auto';
        sndChimeReminder.preload = 'auto';

        let audioCtx = null;
        let isAudioUnlocked = false;

        function getAudioContext() {
            if (!audioCtx) {
                const AudioContextClass = window.AudioContext || window.webkitAudioContext;
                if (AudioContextClass) {
                    audioCtx = new AudioContextClass();
                }
            }
            if (audioCtx && audioCtx.state === 'suspended') {
                audioCtx.resume().catch(() => {});
            }
            return audioCtx;
        }

        // Buka gembok autoplay audio browser secara senyap saat user berinteraksi (klik/ketik/touch)
        function unlockAudio() {
            if (isAudioUnlocked) return;

            try {
                // 1. Prime Web Audio API
                const ctx = getAudioContext();
                if (ctx) {
                    if (ctx.state === 'suspended') {
                        ctx.resume().then(() => {
                            isAudioUnlocked = true;
                        }).catch(() => {});
                    } else if (ctx.state === 'running') {
                        isAudioUnlocked = true;
                    }

                    // Keep-alive silent oscillator agar browser tidak mematikan AudioContext di background tab
                    try {
                        const silentOsc = ctx.createOscillator();
                        const silentGain = ctx.createGain();
                        silentGain.gain.setValueAtTime(0.00001, ctx.currentTime);
                        silentOsc.connect(silentGain);
                        silentGain.connect(ctx.destination);
                        silentOsc.start();
                    } catch (e) {}
                }

                // 2. Prime HTML5 Audio dengan play & pause instan saat event gesture user
                const p1 = sndChimeMasuk.play();
                if (p1 !== undefined) {
                    p1.then(() => {
                        sndChimeMasuk.pause();
                        sndChimeMasuk.currentTime = 0;
                        isAudioUnlocked = true;
                    }).catch(() => {});
                }

                const p2 = sndChimeReminder.play();
                if (p2 !== undefined) {
                    p2.then(() => {
                        sndChimeReminder.pause();
                        sndChimeReminder.currentTime = 0;
                        isAudioUnlocked = true;
                    }).catch(() => {});
                }
            } catch (e) {
                console.warn('[FARMASI AUDIO] Unlock warning:', e);
            }
        }

        window.unlockAudio = unlockAudio;

        // Pasang listener di document agar audio langsung terbuka otomatis begitu user mengklik / mengetik di mana saja
        $(document).on('click keydown pointerup touchend', function() {
            unlockAudio();
        });

        // 1. Suara Notifikasi Resep Baru Masuk (Nada Bandara Klasik: D5 -> F#5 -> A5 -> D6)
        function playHospitalChime(forcePlay = false) {
            if (!forcePlay && localStorage.getItem('farmasi_notif_sound') === '0') {
                return;
            }

            unlockAudio();

            let isPlayed = false;
            try {
                sndChimeMasuk.pause();
                sndChimeMasuk.currentTime = 0;
                sndChimeMasuk.volume = 1.0;
                const p = sndChimeMasuk.play();
                if (p !== undefined) {
                    p.then(() => {
                        isPlayed = true;
                    }).catch(err => {
                        console.warn('[FARMASI AUDIO] HTML5 Audio dicegah (background tab?), beralih ke Synth:', err);
                        playHospitalChimeSynth();
                    });
                }
            } catch (e) {
                console.warn('[FARMASI AUDIO] HTML5 Audio exception, beralih ke Synth:', e);
                playHospitalChimeSynth();
            }

            // Saat tab di background (document.hidden), jika HTML5 Audio tertahan, bunyikan via Web Audio Synth
            if (document.hidden) {
                setTimeout(function() {
                    if (!isPlayed) {
                        playHospitalChimeSynth();
                    }
                }, 100);
            }
        }

        // Fallback Web Audio API Synth: 4-Nada Khas Bandara Klasik (D5 -> F#5 -> A5 -> D6)
        function playHospitalChimeSynth() {
            try {
                const ctx = getAudioContext();
                if (!ctx) return;

                const runSynth = () => {
                    const now = ctx.currentTime;
                    // Nada Bandara Klasik Persis: D5 (587 Hz) -> F#5 (740 Hz) -> A5 (880 Hz) -> D6 (1175 Hz)
                    const notes = [
                        { freq: 587.33, time: now + 0.00, dur: 0.35, gain: 0.75 },
                        { freq: 739.99, time: now + 0.18, dur: 0.35, gain: 0.75 },
                        { freq: 880.00, time: now + 0.36, dur: 0.35, gain: 0.80 },
                        { freq: 1174.66, time: now + 0.54, dur: 0.90, gain: 0.85 }
                    ];

                    notes.forEach(n => {
                        const osc = ctx.createOscillator();
                        const gain = ctx.createGain();
                        osc.type = 'sine';
                        osc.frequency.setValueAtTime(n.freq, n.time);
                        gain.gain.setValueAtTime(n.gain, n.time);
                        gain.gain.exponentialRampToValueAtTime(0.0001, n.time + n.dur);
                        osc.connect(gain);
                        gain.connect(ctx.destination);
                        osc.start(n.time);
                        osc.stop(n.time + n.dur);
                    });
                };

                if (ctx.state === 'suspended') {
                    ctx.resume().then(runSynth).catch(() => {});
                } else {
                    runSynth();
                }
            } catch (e) {
                console.warn('[FARMASI AUDIO] Synth chime error:', e);
            }
        }

        // 2. Suara Lonceng Pengingat Berkala (Juga Memakai Nada Bandara Klasik)
        function playReminderChime() {
            if (localStorage.getItem('farmasi_notif_sound') === '0') {
                return;
            }

            unlockAudio();

            let isPlayed = false;
            try {
                sndChimeReminder.pause();
                sndChimeReminder.currentTime = 0;
                sndChimeReminder.volume = 0.95;
                const p = sndChimeReminder.play();
                if (p !== undefined) {
                    p.then(() => {
                        isPlayed = true;
                    }).catch(err => {
                        console.warn('[FARMASI AUDIO] HTML5 Audio reminder dicegah, beralih ke Synth:', err);
                        playReminderChimeSynth();
                    });
                }
            } catch (e) {
                playReminderChimeSynth();
            }

            if (document.hidden) {
                setTimeout(function() {
                    if (!isPlayed) {
                        playReminderChimeSynth();
                    }
                }, 100);
            }
        }

        function playReminderChimeSynth() {
            playHospitalChimeSynth();
        }

        // Flash title browser saat tab tidak aktif
        let originalDocTitle = document.title || 'Resep - ERM';
        let titleFlashTimer = null;
        function flashDocTitle(alertText) {
            if (titleFlashTimer) clearInterval(titleFlashTimer);
            let state = false;
            let counter = 0;
            titleFlashTimer = setInterval(function() {
                document.title = state ? `🔔 ${alertText}` : originalDocTitle;
                state = !state;
                counter++;
                if (counter > 20) {
                    clearInterval(titleFlashTimer);
                    document.title = originalDocTitle;
                    titleFlashTimer = null;
                }
            }, 600);
        }

        window.addEventListener('focus', function() {
            if (titleFlashTimer) {
                clearInterval(titleFlashTimer);
                document.title = originalDocTitle;
                titleFlashTimer = null;
            }
        });

        // HTML5 Desktop Notification
        function sendDesktopNotification(title, body) {
            if (!("Notification" in window)) return;
            if (Notification.permission === "granted" && localStorage.getItem('farmasi_notif_desktop') === '1') {
                try {
                    const notif = new Notification(title, {
                        body: body,
                        icon: "{{ asset('/img/logo.png') }}"
                    });
                    notif.onclick = function() {
                        window.focus();
                        this.close();
                    };
                } catch (e) {
                    console.warn('Desktop notif error:', e);
                }
            }
        }

        // Pindah tab secara terprogram (simulasi klik nyata dan Bootstrap 5 Tab trigger)
        function switchToTab(tabLinkId) {
            console.log('[FARMASI] Pindah tab ke:', tabLinkId);
            const el = document.getElementById(tabLinkId);
            if (!el) {
                console.warn('[FARMASI] Tab link tidak ditemukan:', tabLinkId);
                return;
            }

            // 1. Trigger klik jQuery & Native DOM
            el.click();
            $('#' + tabLinkId).trigger('click');

            // 2. Trigger Bootstrap 5 Tab instance
            try {
                if (window.bootstrap && bootstrap.Tab) {
                    const tabTrigger = bootstrap.Tab.getOrCreateInstance(el);
                    tabTrigger.show();
                }
            } catch (err) {
                console.warn('[FARMASI] Bootstrap tab switch warning:', err);
            }

            // 3. Scroll halus ke navigasi tab agar langsung terlihat
            $('html, body').animate({
                scrollTop: $('#pills-farmasi-tab').offset().top - 20
            }, 300);
        }

        // Refresh tabel pada tab yang sedang aktif
        function refreshActiveTabTable() {
            if ($('#tab-farmasi-ralan').hasClass('show')) {
                tbResep();
            } else if ($('#tab-farmasi-resep-ranap').hasClass('show')) {
                loadResepRanapFarmasi();
            } else if ($('#tab-farmasi-ranap').hasClass('show')) {
                loadPermintaanRanapFarmasi();
            } else if ($('#tab-farmasi-pulang').hasClass('show')) {
                loadPermintaanResepPulangFarmasi();
            } else if ($('#tab-farmasi-retur').hasClass('show')) {
                loadPengajuanReturFarmasi();
            }
        }

        // Delegasi Event Klik Global untuk Toast Notifikasi Farmasi
        $(document).on('click', '.swal2-farmasi-toast, .swal2-farmasi-toast *', function(e) {
            if ($(e.target).closest('.swal2-close').length) {
                return; // Jangan navigasi jika klik tombol silang (close)
            }
            const $toast = $(this).closest('.swal2-farmasi-toast');
            const targetTab = $(this).attr('data-tab-id') || $(this).data('tab-id') || $toast.attr('data-tab-id') || $toast.data('tab-id');
            if (targetTab) {
                console.log('[FARMASI] Toast diklik, menuju tab:', targetTab);
                switchToTab(targetTab);
                Swal.close();
            }
        });

        // Tampilkan Toast SweetAlert2 untuk 1-2 item
        function tampilkanToastNotifikasi(item) {
            const typeConfig = {
                'ralan': {
                    badge: 'bg-success text-white',
                    iconBg: 'rgba(25, 135, 84, 0.12)',
                    iconColor: '#198754',
                    borderClass: 'toast-border-ralan',
                    btnClass: 'btn-outline-success'
                },
                'ranap': {
                    badge: 'bg-primary text-white',
                    iconBg: 'rgba(111, 66, 193, 0.12)',
                    iconColor: '#6f42c1',
                    borderClass: 'toast-border-ranap',
                    btnClass: 'btn-outline-primary'
                },
                'udd': {
                    badge: 'bg-info text-dark',
                    iconBg: 'rgba(13, 110, 253, 0.12)',
                    iconColor: '#0d6efd',
                    borderClass: 'toast-border-udd',
                    btnClass: 'btn-outline-primary'
                },
                'pulang': {
                    badge: 'bg-danger text-white',
                    iconBg: 'rgba(214, 51, 132, 0.12)',
                    iconColor: '#d63384',
                    borderClass: 'toast-border-pulang',
                    btnClass: 'btn-outline-danger'
                },
                'retur': {
                    badge: 'bg-primary text-white',
                    iconBg: 'rgba(13, 110, 253, 0.12)',
                    iconColor: '#0d6efd',
                    borderClass: 'toast-border-retur',
                    btnClass: 'btn-outline-primary'
                }
            }[item.type] || {
                badge: 'bg-secondary text-white',
                iconBg: 'rgba(108, 117, 125, 0.12)',
                iconColor: '#6c757d',
                borderClass: 'toast-border-ralan',
                btnClass: 'btn-outline-secondary'
            };

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 9000,
                timerProgressBar: true,
                showCloseButton: true,
                customClass: {
                    popup: `swal2-farmasi-toast ${typeConfig.borderClass}`
                },
                didOpen: (toastEl) => {
                    $(toastEl).attr('data-tab-id', item.tabId).css('cursor', 'pointer');
                    toastEl.addEventListener('mouseenter', Swal.stopTimer);
                    toastEl.addEventListener('mouseleave', Swal.resumeTimer);
                }
            });

            Toast.fire({
                html: `
                    <div class="d-flex align-items-start" style="gap: 16px;" data-tab-id="${item.tabId}">
                        <div class="rounded-3 d-flex align-items-center justify-content-center flex-shrink-0" 
                             style="width: 44px; height: 44px; min-width: 44px; border-radius: 12px; background: ${typeConfig.iconBg}; color: ${typeConfig.iconColor}; border: 1px solid rgba(0,0,0,0.06);">
                            <i class="bi ${item.icon} fs-5"></i>
                        </div>
                        <div class="flex-grow-1" style="min-width: 0; padding-right: 28px;">
                            <div class="d-flex align-items-center justify-content-between mb-1.5">
                                <span class="badge ${typeConfig.badge} rounded-pill px-2.5 py-1" style="font-size: 10.5px; font-weight: 600; letter-spacing: 0.3px;">
                                    ${item.label}
                                </span>
                                <span class="text-muted" style="font-size: 10.5px;">Baru Saja</span>
                            </div>
                            <div class="fw-bold text-dark text-truncate" style="font-size: 14px; line-height: 1.35;" title="${item.pasien}">
                                ${item.pasien}
                            </div>
                            <div class="d-flex align-items-center gap-1.5 flex-wrap mt-1.5" style="font-size: 11px;">
                                <span class="font-monospace fw-bold text-primary bg-primary-subtle px-2 py-0.5 rounded border border-primary-subtle">
                                    ${item.nomor}
                                </span>
                                <span class="text-secondary text-truncate" style="max-width: 250px;">
                                    <i class="bi bi-geo-alt me-0.5"></i>${item.lokasi}
                                </span>
                            </div>
                            <div class="mt-2.5 pt-2 border-top d-flex justify-content-end">
                                <span class="btn btn-xs ${typeConfig.btnClass} rounded-pill py-1 px-3 d-inline-flex align-items-center gap-1.5 shadow-xs" data-tab-id="${item.tabId}" style="font-size: 11.5px; font-weight: 600;">
                                    <span>Buka Antrean</span> <i class="bi bi-arrow-right"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                `
            });
        }

        // Tampilkan Toast SweetAlert2 untuk banyak item (batch)
        function tampilkanToastBatch(items) {
            const firstTab = items[0]?.tabId || 'tab-farmasi-ralan-link';
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 10000,
                timerProgressBar: true,
                showCloseButton: true,
                customClass: {
                    popup: 'swal2-farmasi-toast toast-border-warning'
                },
                didOpen: (toastEl) => {
                    $(toastEl).attr('data-tab-id', firstTab).css('cursor', 'pointer');
                    toastEl.addEventListener('mouseenter', Swal.stopTimer);
                    toastEl.addEventListener('mouseleave', Swal.resumeTimer);
                }
            });

            const summaryList = items.slice(0, 3).map(it => `
                <div class="d-flex justify-content-between align-items-center py-1 border-bottom" data-tab-id="${it.tabId}">
                    <span class="fw-semibold text-dark text-truncate" style="max-width: 220px;">${it.pasien}</span>
                    <span class="badge bg-light text-secondary border font-monospace px-1.5 py-0.5" style="font-size: 9.5px;">${it.nomor}</span>
                </div>
            `).join('');
            const moreText = items.length > 3 ? `<div class="text-muted mt-1 text-center" style="font-size: 10.5px;">+${items.length - 3} resep/permintaan lainnya...</div>` : '';

            Toast.fire({
                html: `
                    <div class="d-flex align-items-start" style="gap: 16px;" data-tab-id="${firstTab}">
                        <div class="rounded-3 d-flex align-items-center justify-content-center flex-shrink-0" 
                             style="width: 44px; height: 44px; min-width: 44px; border-radius: 12px; background: rgba(220, 53, 69, 0.12); color: #dc3545; border: 1px solid rgba(0,0,0,0.06);">
                            <i class="bi bi-stack fs-5"></i>
                        </div>
                        <div class="flex-grow-1" style="min-width: 0; padding-right: 28px;">
                            <div class="d-flex align-items-center justify-content-between mb-1.5">
                                <span class="badge bg-danger rounded-pill px-2.5 py-1" style="font-size: 10.5px; font-weight: 700;">
                                    ANTREAN BANYAK
                                </span>
                                <span class="text-muted" style="font-size: 10.5px;">${items.length} Masuk</span>
                            </div>
                            <div class="fw-bold text-dark" style="font-size: 13.5px;">
                                ${items.length} Antrean Baru Sekaligus!
                            </div>
                            <div class="mt-2 p-2 rounded bg-light border" style="font-size: 11px;">
                                ${summaryList}${moreText}
                            </div>
                            <div class="mt-2.5 pt-2 border-top d-flex justify-content-end">
                                <span class="btn btn-xs btn-outline-danger rounded-pill py-1 px-3 d-inline-flex align-items-center gap-1.5 shadow-xs" data-tab-id="${firstTab}" style="font-size: 11.5px; font-weight: 600;">
                                    <span>Lihat Semua Antrean</span> <i class="bi bi-arrow-right"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                `
            });
        }

        // Tampilkan Toast SweetAlert2 untuk pengingat berkala
        function tampilkanToastReminder(total, ralan, ranap, udd, pulang, retur = 0) {
            let primaryTab = 'tab-farmasi-ralan-link';
            if (udd > 0) primaryTab = 'tab-farmasi-ranap-link';
            else if (ranap > 0) primaryTab = 'tab-farmasi-resep-ranap-link';
            else if (pulang > 0) primaryTab = 'tab-farmasi-pulang-link';
            else if (retur > 0) primaryTab = 'tab-farmasi-retur-link';

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 7000,
                timerProgressBar: true,
                showCloseButton: true,
                customClass: {
                    popup: 'swal2-farmasi-toast toast-border-warning'
                },
                didOpen: (toastEl) => {
                    $(toastEl).attr('data-tab-id', primaryTab).css('cursor', 'pointer');
                    toastEl.addEventListener('mouseenter', Swal.stopTimer);
                    toastEl.addEventListener('mouseleave', Swal.resumeTimer);
                }
            });

            const rincian = [];
            if (ralan > 0) rincian.push(`<span class="badge bg-light text-dark border px-2 py-1 me-1 mb-1" style="cursor: pointer;" data-tab-id="tab-farmasi-ralan-link">${ralan} Ralan</span>`);
            if (ranap > 0) rincian.push(`<span class="badge bg-light text-dark border px-2 py-1 me-1 mb-1" style="cursor: pointer;" data-tab-id="tab-farmasi-resep-ranap-link">${ranap} Resep Ranap</span>`);
            if (udd > 0) rincian.push(`<span class="badge bg-light text-dark border px-2 py-1 me-1 mb-1" style="cursor: pointer;" data-tab-id="tab-farmasi-ranap-link">${udd} UDD</span>`);
            if (pulang > 0) rincian.push(`<span class="badge bg-light text-dark border px-2 py-1 me-1 mb-1" style="cursor: pointer;" data-tab-id="tab-farmasi-pulang-link">${pulang} Pulang</span>`);
            if (retur > 0) rincian.push(`<span class="badge bg-light text-dark border px-2 py-1 me-1 mb-1" style="cursor: pointer;" data-tab-id="tab-farmasi-retur-link">${retur} Retur</span>`);

            Toast.fire({
                html: `
                    <div class="d-flex align-items-start" style="gap: 16px;" data-tab-id="${primaryTab}">
                        <div class="rounded-3 d-flex align-items-center justify-content-center flex-shrink-0" 
                             style="width: 44px; height: 44px; min-width: 44px; border-radius: 12px; background: rgba(245, 158, 11, 0.15); color: #d97706; border: 1px solid rgba(0,0,0,0.06);">
                            <i class="bi bi-bell-fill fs-5"></i>
                        </div>
                        <div class="flex-grow-1" style="min-width: 0; padding-right: 28px;">
                            <div class="d-flex align-items-center justify-content-between mb-1.5">
                                <span class="badge bg-warning text-dark rounded-pill px-2.5 py-1" style="font-size: 10.5px; font-weight: 700;">
                                    <i class="bi bi-clock-history me-1"></i>PENGINGAT
                                </span>
                                <span class="text-muted" style="font-size: 10.5px;">Tiap 2 Mnt</span>
                            </div>
                            <div class="fw-bold text-dark" style="font-size: 13.5px;">
                                Masih ada <span class="badge bg-danger rounded-pill px-2 py-0.5">${total} antrean</span> menunggu!
                            </div>
                            <div class="mt-2 d-flex flex-wrap gap-1" style="font-size: 11px;">
                                ${rincian.join('')}
                            </div>
                            <div class="mt-2.5 pt-2 border-top d-flex justify-content-between align-items-center">
                                <small class="text-muted" style="font-size: 10.5px;">Klik untuk langsung buka antrean</small>
                                <span class="btn btn-xs btn-outline-primary rounded-pill py-0.5 px-2.5 d-inline-flex align-items-center gap-1" style="font-size: 11px; font-weight: 600;" data-tab-id="${primaryTab}">
                                    <span>Periksa</span> <i class="bi bi-arrow-right"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                `
            });
        }

        // Memory tracker ID yang sudah diketahui & baru
        let isInitialNotifCheck = true;
        let lastReminderTimestamp = Date.now();
        const knownRalanIds = new Set();
        const knownRanapIds = new Set();
        const knownUddIds = new Set();
        const knownPulangIds = new Set();
        const knownReturIds = new Set();
        const recentlyAlertedIds = new Set();

        function checkAntreanFarmasiBaru() {
            const today = moment().format('YYYY-MM-DD');

            $.when(
                $.get("{{ url('resep/ambil/sekarang') }}"),
                $.get("{{ route('farmasi.resep-ranap.data') }}", { tgl_awal: today, tgl_akhir: today }),
                $.get("{{ route('farmasi.permintaan-ranap.data') }}", { tgl_awal: today, tgl_akhir: today }),
                $.get("{{ route('farmasi.resep-pulang.permintaan') }}", { tgl_awal: today, tgl_akhir: today }),
                $.get("{{ route('retur-obat.daftar') }}", { status: 'Menunggu Validasi' })
            ).done(function(resRalan, resRanap, resUdd, resPulang, resRetur) {
                const dataRalan = (resRalan && resRalan[0]) ? resRalan[0] : [];
                const dataRanap = (resRanap && resRanap[0]) ? resRanap[0] : [];
                const dataUdd = (resUdd && resUdd[0]) ? resUdd[0] : [];
                const dataPulang = (resPulang && resPulang[0]) ? resPulang[0] : [];
                const dataRetur = (resRetur && resRetur[0]) ? resRetur[0] : [];

                const newItems = [];

                // 1. Cek Ralan
                let countRalanTunggu = 0;
                let countRalanSelesai = 0;
                let countRalanTidakAmbil = 0;
                let countRalanTotal = 0;
                dataRalan.forEach(function(row) {
                    countRalanTotal++;
                    const isTidakAmbil = (row.tgl_perawatan === '0000-00-00' && row.reg_periksa?.status_bayar === 'Sudah Bayar');
                    const isWaiting = (row.tgl_perawatan === '0000-00-00' && !isTidakAmbil);

                    if (isTidakAmbil) {
                        countRalanTidakAmbil++;
                    } else if (isWaiting) {
                        countRalanTunggu++;
                        if (!knownRalanIds.has(row.no_resep)) {
                            if (!isInitialNotifCheck) {
                                newItems.push({
                                    type: 'ralan',
                                    label: 'Resep Rawat Jalan (Ralan)',
                                    icon: 'bi-hospital',
                                    nomor: row.no_resep,
                                    pasien: row.reg_periksa?.pasien?.nm_pasien || '-',
                                    lokasi: row.reg_periksa?.poliklinik?.nm_poli || 'Poliklinik',
                                    tabId: 'tab-farmasi-ralan-link'
                                });
                                recentlyAlertedIds.add(row.no_resep);
                            }
                        }
                    } else {
                        countRalanSelesai++;
                    }
                    knownRalanIds.add(row.no_resep);
                });

                // 2. Cek Resep Dokter Ranap
                let countRanapTunggu = 0;
                dataRanap.forEach(function(row) {
                    const isWaiting = row.tgl_perawatan === '0000-00-00';
                    if (isWaiting) {
                        countRanapTunggu++;
                        if (!knownRanapIds.has(row.no_resep)) {
                            if (!isInitialNotifCheck) {
                                newItems.push({
                                    type: 'ranap',
                                    label: 'Resep Dokter Ranap',
                                    icon: 'bi-file-earmark-medical',
                                    nomor: row.no_resep,
                                    pasien: row.reg_periksa?.pasien?.nm_pasien || '-',
                                    lokasi: getKamarFormat(row.reg_periksa),
                                    tabId: 'tab-farmasi-resep-ranap-link'
                                });
                                recentlyAlertedIds.add(row.no_resep);
                            }
                        }
                    }
                    knownRanapIds.add(row.no_resep);
                });

                // 3. Cek Permintaan Stok Ranap (UDD)
                let countUddTunggu = 0;
                dataUdd.forEach(function(row) {
                    const isWaiting = row.status === 'Belum';
                    if (isWaiting) {
                        countUddTunggu++;
                        if (!knownUddIds.has(row.no_permintaan)) {
                            if (!isInitialNotifCheck) {
                                newItems.push({
                                    type: 'udd',
                                    label: 'Permintaan Stok Ranap (UDD)',
                                    icon: 'bi-inbox-fill',
                                    nomor: row.no_permintaan,
                                    pasien: row.reg_periksa?.pasien?.nm_pasien || '-',
                                    lokasi: getKamarFormat(row.reg_periksa),
                                    tabId: 'tab-farmasi-ranap-link'
                                });
                                recentlyAlertedIds.add(row.no_permintaan);
                            }
                        }
                    }
                    knownUddIds.add(row.no_permintaan);
                });

                // 4. Cek Resep Pulang
                let countPulangTunggu = 0;
                dataPulang.forEach(function(row) {
                    const isWaiting = row.status === 'Belum';
                    if (isWaiting) {
                        countPulangTunggu++;
                        if (!knownPulangIds.has(row.no_permintaan)) {
                            if (!isInitialNotifCheck) {
                                newItems.push({
                                    type: 'pulang',
                                    label: 'Permintaan Resep Pulang',
                                    icon: 'bi-box-arrow-right',
                                    nomor: row.no_permintaan,
                                    pasien: row.reg_periksa?.pasien?.nm_pasien || '-',
                                    lokasi: getKamarFormat(row.reg_periksa),
                                    tabId: 'tab-farmasi-pulang-link'
                                });
                                recentlyAlertedIds.add(row.no_permintaan);
                            }
                        }
                    }
                    knownPulangIds.add(row.no_permintaan);
                });

                // 5. Cek Retur Obat Ranap
                let countReturTunggu = 0;
                dataRetur.forEach(function(row) {
                    const isWaiting = row.status === 'Menunggu Validasi';
                    if (isWaiting) {
                        countReturTunggu++;
                        if (!knownReturIds.has(row.no_pengajuan)) {
                            if (!isInitialNotifCheck) {
                                newItems.push({
                                    type: 'retur',
                                    label: 'Pengajuan Retur Ranap',
                                    icon: 'bi-arrow-return-left',
                                    nomor: row.no_pengajuan,
                                    pasien: row.reg_periksa?.pasien?.nm_pasien || '-',
                                    lokasi: getKamarFormat(row.reg_periksa),
                                    tabId: 'tab-farmasi-retur-link'
                                });
                                recentlyAlertedIds.add(row.no_pengajuan);
                            }
                        }
                    }
                    knownReturIds.add(row.no_pengajuan);
                });

                // Update counter angka pada UI
                $('#count-resep').text(countRalanTotal);
                $('#count-tunggu').text(countRalanTunggu);
                $('#count-selesai').text(countRalanSelesai);
                $('#count-tidak').text(countRalanTidakAmbil);
                $('#badgeCountResepRanapTunggu').text(countRanapTunggu);
                $('#badgeCountRanapTunggu').text(countUddTunggu);
                $('#badgeCountPulangTunggu').text(countPulangTunggu);
                $('#badgeCountReturTunggu').text(countReturTunggu);

                $('#lblLastSyncTime').html(`<i class="bi bi-check2-circle text-success me-1"></i>Dicek: ${moment().format('HH:mm:ss')}`);

                if (isInitialNotifCheck) {
                    isInitialNotifCheck = false;
                    lastReminderTimestamp = Date.now();
                    return;
                }

                const totalMenunggu = countRalanTunggu + countRanapTunggu + countUddTunggu + countPulangTunggu + countReturTunggu;

                if (newItems.length > 0) {
                    lastReminderTimestamp = Date.now();
                    playHospitalChime();
                    flashDocTitle(`(${newItems.length}) Antrean Baru!`);
                    refreshActiveTabTable();

                    // Bersihkan efek highlight setelah 15 detik
                    setTimeout(function() {
                        recentlyAlertedIds.clear();
                    }, 15000);

                    if (newItems.length <= 2) {
                        newItems.forEach(function(item) {
                            tampilkanToastNotifikasi(item);
                            sendDesktopNotification(`🔔 ${item.label} Baru!`, `${item.pasien} (${item.lokasi}) - No: ${item.nomor}`);
                        });
                    } else {
                        tampilkanToastBatch(newItems);
                        sendDesktopNotification(`🔔 ${newItems.length} Antrean Baru Masuk!`, `Terdapat ${newItems.length} resep/permintaan stok/retur baru masuk ke antrean farmasi.`);
                    }
                } else if (totalMenunggu > 0) {
                    // Pengingat berkala jika masih ada antrean menunggu
                    const reminderIntervalSec = parseInt(localStorage.getItem('farmasi_notif_interval') || '120'); // default 120s (2 menit)
                    if (reminderIntervalSec > 0) {
                        const elapsedSec = (Date.now() - lastReminderTimestamp) / 1000;
                        if (elapsedSec >= reminderIntervalSec) {
                            lastReminderTimestamp = Date.now();
                            playReminderChime();
                            flashDocTitle(`⚠️ (${totalMenunggu}) Menunggu!`);
                            tampilkanToastReminder(totalMenunggu, countRalanTunggu, countRanapTunggu, countUddTunggu, countPulangTunggu, countReturTunggu);
                        }
                    }
                } else {
                    // Total antrean menunggu sudah 0 (selesai semua)
                    lastReminderTimestamp = Date.now();
                }
            }).fail(function() {
                $('#lblLastSyncTime').html(`<i class="bi bi-exclamation-triangle text-warning me-1"></i>Sinkronisasi tertunda`);
            });
        }

        function updateSoundButtonUI() {
            const soundEnabled = localStorage.getItem('farmasi_notif_sound') !== '0';
            if (soundEnabled) {
                $('#btnToggleSound').removeClass('btn-outline-secondary').addClass('btn-success text-white');
                $('#iconSound').removeClass('bi-bell-slash').addClass('bi-bell-fill');
                $('#lblSoundStatus').text('Suara: AKTIF');
            } else {
                $('#btnToggleSound').removeClass('btn-success text-white').addClass('btn-outline-secondary');
                $('#iconSound').removeClass('bi-bell-fill').addClass('bi-bell-slash');
                $('#lblSoundStatus').text('Suara: BISU');
            }
        }

        function updateDesktopNotifButtonUI() {
            if (!("Notification" in window)) {
                $('#btnToggleDesktopNotif').addClass('d-none');
                return;
            }
            const isGranted = Notification.permission === 'granted';
            const isEnabled = isGranted && localStorage.getItem('farmasi_notif_desktop') === '1';

            if (isEnabled) {
                $('#btnToggleDesktopNotif').removeClass('btn-outline-secondary').addClass('btn-primary text-white');
                $('#lblDesktopNotif').text('Notif Desktop: AKTIF');
            } else {
                $('#btnToggleDesktopNotif').removeClass('btn-primary text-white').addClass('btn-outline-secondary');
                $('#lblDesktopNotif').text('Notif Desktop: OFF');
            }
        }

        function initNotifikasiDanAutoSyncFarmasi() {
            // Pasang audio unlock saat interaksi user pertama
            $(document).one('click keydown', function() {
                getAudioContext();
            });

            // Set default sound setting jika belum ada
            if (localStorage.getItem('farmasi_notif_sound') === null) {
                localStorage.setItem('farmasi_notif_sound', '1');
            }
            updateSoundButtonUI();
            updateDesktopNotifButtonUI();

            // Set default reminder interval ke 120 detik (2 menit)
            if (localStorage.getItem('farmasi_notif_interval') === null) {
                localStorage.setItem('farmasi_notif_interval', '120');
            }
            $('#selectReminderInterval').val(localStorage.getItem('farmasi_notif_interval') || '120');

            $('#selectReminderInterval').on('change', function() {
                const val = $(this).val();
                localStorage.setItem('farmasi_notif_interval', val);
                lastReminderTimestamp = Date.now();
                const text = $(this).find('option:selected').text();
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: `Pengaturan Diperbarui: ${text}`,
                    showConfirmButton: false,
                    timer: 2500
                });
            });

            // Event toggle sound
            $('#btnToggleSound').on('click', function() {
                const current = localStorage.getItem('farmasi_notif_sound') !== '0';
                const next = current ? '0' : '1';
                localStorage.setItem('farmasi_notif_sound', next);
                updateSoundButtonUI();
                if (next === '1') {
                    playHospitalChime(true);
                }
            });

            // Event test chime
            $('#btnTestChime').on('click', function() {
                unlockAudio();
                playHospitalChime(true);
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: '🔊 Memutar suara lonceng farmasi...',
                    showConfirmButton: false,
                    timer: 2000
                });
            });

            // Event toggle desktop notif
            $('#btnToggleDesktopNotif').on('click', function() {
                if (!("Notification" in window)) {
                    Swal.fire('Info', 'Browser ini tidak mendukung Desktop Notification.', 'info');
                    return;
                }

                if (Notification.permission === 'default') {
                    Notification.requestPermission().then(function(perm) {
                        if (perm === 'granted') {
                            localStorage.setItem('farmasi_notif_desktop', '1');
                            updateDesktopNotifButtonUI();
                            sendDesktopNotification('🔔 Notifikasi Desktop Aktif', 'Notifikasi antrean resep dan stok akan muncul di layar desktop Anda.');
                        } else {
                            localStorage.setItem('farmasi_notif_desktop', '0');
                            updateDesktopNotifButtonUI();
                        }
                    });
                } else if (Notification.permission === 'granted') {
                    const current = localStorage.getItem('farmasi_notif_desktop') === '1';
                    const next = current ? '0' : '1';
                    localStorage.setItem('farmasi_notif_desktop', next);
                    updateDesktopNotifButtonUI();
                } else {
                    Swal.fire('Izin Ditolak', 'Izin notifikasi desktop diblokir di browser. Silakan izinkan di pengaturan situs browser Anda.', 'warning');
                }
            });

            // Jalankan sinkronisasi pertama kali (silent registration)
            checkAntreanFarmasiBaru();

            // Web Worker background timer: Berjalan konstan tiap 20 detik tanpa dibekukan (throttled) browser saat tab tidak aktif
            startAutoSyncWorker();

            // Saat user kembali ke tab ini, refresh antrean & pastikan AudioContext aktif
            document.addEventListener('visibilitychange', function() {
                if (!document.hidden) {
                    checkAntreanFarmasiBaru();
                    if (audioCtx && audioCtx.state === 'suspended') {
                        audioCtx.resume().catch(() => {});
                    }
                }
            });
        }

        // Auto-Sync Web Worker (Kebal terhadap background tab throttling)
        function startAutoSyncWorker() {
            try {
                const workerScript = `
                    let timer = null;
                    self.onmessage = function(e) {
                        if (e.data === 'start') {
                            if (timer) clearInterval(timer);
                            timer = setInterval(function() {
                                self.postMessage('sync_tick');
                            }, 20000);
                        } else if (e.data === 'stop') {
                            if (timer) clearInterval(timer);
                            timer = null;
                        }
                    };
                `;
                const blob = new Blob([workerScript], { type: 'application/javascript' });
                const worker = new Worker(URL.createObjectURL(blob));
                worker.onmessage = function(e) {
                    if (e.data === 'sync_tick') {
                        checkAntreanFarmasiBaru();
                    }
                };
                worker.postMessage('start');
                console.log('[FARMASI AUTO-SYNC] Web Worker aktif (berjalan konstan di background tab).');
            } catch (e) {
                console.warn('[FARMASI AUTO-SYNC] Fallback to setInterval:', e);
                setInterval(checkAntreanFarmasiBaru, 20000);
            }
        }

        function hitungResep() {
            $.ajax({
                url: 'resep/ambil/sekarang',
                success: function(response) {
                    resep = 0;
                    valid = 0;
                    tunggu = 0;
                    tidak = 0;
                    selesai = 0;
                    $.map(response, function(res) {
                        if (res.tgl_perawatan != '0000-00-00') {
                            valid += parseInt(1);
                        } else {
                            if (res.reg_periksa && res.reg_periksa.status_bayar == 'Sudah Bayar') {
                                tidak += parseInt(1);
                            }
                        }
                        if (res.tgl_peresepan != '0000-00-00') {
                            resep += parseInt(1);
                        }
                        if (res.tgl_penyerahan != '0000-00-00' && res.jam_penyerahan) {
                            selesai += parseInt(1);
                        }
                    });
                    tunggu = Math.max(0, resep - valid - tidak);
                    $('#count-resep').text(resep);
                    $('#count-tunggu').text(tunggu);
                    $('#count-selesai').text(selesai);
                    $('#count-valid').text(valid);
                    $('#count-tidak').text(tidak);
                }
            });
        }

        function tbResep() {
            const tgl_peresepan = tglPeresepan.val();
            const tgl_penyerahan = tglPenyerahan.val();
            $('#tb_resep').DataTable({
                processing: false,
                destroy: true,
                scrollX: true,
                serverSide: true,
                stateSave: true,
                searching: false,
                ordering: false,
                paging: false,
                lenghtChange: false,
                info: false,
                deferRender: true,
                ajax: {
                    url: "/erm/resep/ambil/tabel",
                    data: {
                        tgl_peresepan: tgl_peresepan,
                        tgl_penyerahan: tgl_penyerahan
                    }
                },
                createdRow: function(row, data, dataIndex) {
                    if (data && recentlyAlertedIds.has(data.no_resep)) {
                        $(row).addClass('row-highlight-baru');
                    }
                },
                columns: [
                    {
                        data: null,
                        render: function(data, type, row, meta) {
                            const penjab = row.reg_periksa.kd_pj == 'A03' ? '<b><span class="text-danger">(UMUM)</span></b>' : '<b><span class="text-success">(BPJS)</span></b>';
                            const isTelaah = !!row.telaah_farmasi;
                            const badgeTelaah = isTelaah
                                ? '<span class="badge bg-success-subtle text-success border border-success-subtle ms-1" style="font-size: 10px;" title="Sudah Ditelaah Farmasi"><i class="bi bi-shield-check me-1"></i>Sudah Telaah</span>'
                                : '<span class="badge bg-danger-subtle text-danger border border-danger-subtle ms-1" style="font-size: 10px;" title="Belum Ditelaah Farmasi"><i class="bi bi-shield-exclamation me-1"></i>Belum Telaah</span>';

                            let html = `<span class="font-monospace fw-bold text-primary">${row.no_resep}</span> ${badgeTelaah}<br/>`;
                            html += `<h6 style="margin:0px">${row.reg_periksa.pasien.nm_pasien}</h6>`;
                            html += `${row.no_rawat}<br/>`;
                            html += `${row.reg_periksa.poliklinik.nm_poli} ${penjab}<br/>`;
                            html += `<small class="text-muted">${row.reg_periksa.dokter.nm_dokter}</small>`;
                            return html;
                        },
                        name: 'nm_pasien'
                    },
                    {
                        data: null,
                        render: function(data, type, row, meta) {
                            let html = `Resep : ${row.jam_peresepan}<br/>`;
                            html += `Validasi : ${row.jam}<br/>`;
                            html += `Penyerahan : ${row.jam_penyerahan}<br/>`;
                            return html;
                        },
                        name: 'waktu'
                    },
                    {
                        data: null,
                        render: function(data, type, row, meta) {
                            let safeNmPasien = safeJsStr(row.reg_periksa?.pasien?.nm_pasien);
                            let safeNmPoli = safeJsStr(row.reg_periksa?.poliklinik?.nm_poli);
                            let safeNoResep = safeJsStr(row.no_resep);
                            let safeNoRawat = safeJsStr(row.no_rawat);
                            let safeKdPoli = safeJsStr(row.reg_periksa?.kd_poli);

                            const isTelaah = !!row.telaah_farmasi;
                            const btnTelaah = isTelaah
                                ? `<button onclick="bukaModalTelaahFarmasi('${safeNoResep}', '${safeNoRawat}', '${safeNmPasien}', '${safeNmPoli}')" class="btn btn-sm text-white mb-1" style="background-color: #0f766e; width:110px;" type="button" title="Sudah Ditelaah Farmasi (Klik untuk melihat/mengubah)"><i class="bi bi-shield-check me-1"></i> TELAAH <i class="bi bi-check-lg fw-bold"></i></button><br/>`
                                : `<button onclick="bukaModalTelaahFarmasi('${safeNoResep}', '${safeNoRawat}', '${safeNmPasien}', '${safeNmPoli}')" class="btn btn-sm btn-outline-danger mb-1 fw-bold" style="width:110px;" type="button" title="Belum Ditelaah Farmasi (Klik untuk menelaah)"><i class="bi bi-shield-exclamation me-1"></i> BLM TELAAH</button><br/>`;

                            let html = `<button onclick="tampilResep('${safeNoResep}', '${safeKdPoli}')" class="btn btn-sm mb-1 status-${safeNoResep}" type="button" style="width:110px;display:inline" data-id="${safeNoRawat}"></button><br/>`;
                            html += btnTelaah;
                            html += `<button onclick="bukaModalEtiket('${safeNoResep}')" class="btn btn-sm btn-outline-primary mb-1" style="width:110px;" type="button" title="Cetak Etiket Aturan Pakai Obat"><i class="bi bi-printer me-1"></i> ETIKET</button><br/>`;
                            html += `<button onclick="panggilResep('${safeNoResep}', false, '${safeNmPasien}')" class="btn btn-sm btn-warning mb-1 panggil-${safeNoResep}" style="width:110px;display:none" type="button" data-id="${safeNoRawat}">PANGGIL</button><br/>`;
                            html += `<button onclick="panggilResep('${safeNoResep}', true, '${safeNmPasien}')" class="btn btn-sm btn-success mb-1 selesai-${safeNoResep}" style="width:110px;display:none" type="button" data-id="${safeNoRawat}">SELESAI</button>`;

                            if (row.tgl_perawatan == '0000-00-00') {
                                if (row.reg_periksa.status_bayar == 'Belum Bayar') {
                                    $('.status-' + row.no_resep).addClass('btn-primary').text('BELUM');
                                    $('.panggil-' + row.no_resep).css('display', 'none');
                                } else {
                                    $('.status-' + row.no_resep).addClass('btn-danger').text('TIDAK DIAMBIL');
                                    $('.panggil-' + row.no_resep).css('display', 'none');
                                }
                            } else {
                                if (row.jam_penyerahan == '00:00:00') {
                                    $('.status-' + row.no_resep).addClass('btn-primary').text('RESEP');
                                    $('.panggil-' + row.no_resep).css('display', 'inline');
                                    $('.selesai-' + row.no_resep).css('display', 'inline');
                                } else if (row.jam_penyerahan != '00:00:00') {
                                    $('.status-' + row.no_resep).css('height', '50px').addClass('btn-success').text('SELESAI');
                                    $('.panggil-' + row.no_resep).css('display', 'none');
                                    $('.selesai-' + row.no_resep).css('display', 'none');
                                }
                            }
                            return html;
                        },
                        name: 'status'
                    }
                ]
            });
        }

        function panggilResep(no_resep, status, pasien) {
            let jam_panggil = status ? 'true' : '00:00:00';

            // HANYA trigger pemanggilan suara di antrian jika tombol PANGGIL diklik (status == false)
            if (!status) {
                const triggerTimestamp = Date.now().toString();
                console.log("[FARMASI] PANGGIL diklik:", no_resep, pasien, triggerTimestamp);
                localStorage.setItem('no_panggil', no_resep);
                localStorage.setItem('nm_pasien', pasien);
                localStorage.setItem('panggil_trigger', triggerTimestamp);
                localStorage.setItem('panggil', 'yes');
                setTimeout(() => {
                    localStorage.setItem('panggil', 'no');
                }, 3000);
            } else {
                console.log("[FARMASI] SELESAI diklik:", no_resep, pasien);
                localStorage.setItem('resep_selesai_trigger', Date.now().toString());
            }

            $.ajax({
                url: 'resep/obat/panggil',
                data: {
                    no_resep: no_resep,
                    tanggal: "{{ date('Y-m-d') }}",
                    jam: jam_panggil,
                },
                success: function(response) {
                    $('.status-' + no_resep).prop('onclick', '').css('height', '50px').removeClass('btn-primary mb-2').addClass('btn-success').text('SELESAI');
                    $('.panggil-' + no_resep).css('display', 'none');
                    $('.selesai-' + no_resep).css('display', 'none');
                    $('#tb_resep').DataTable().destroy();
                    tbResep();
                    hitungResep();
                }
            });
        }

        function tampilResep(no_resep, kd_poli = '') {
            currentNoResepRalan = no_resep;
            $('#modalResepObat').modal('show');
            if (typeof loadDataDetailResepRalan === 'function') {
                loadDataDetailResepRalan(no_resep);
            }
        }

        // ==========================================
        // FITUR RAWAT INAP (RANAP / UDD) DI FARMASI
        // ==========================================

        function loadPermintaanRanapFarmasi(isBackgroundCountOnly = false) {
            const tglAwal = moment($('#farmasi_ranap_tgl_awal').val(), 'DD-MM-YYYY').format('YYYY-MM-DD');
            const tglAkhir = moment($('#farmasi_ranap_tgl_akhir').val(), 'DD-MM-YYYY').format('YYYY-MM-DD');
            const status = $('#farmasi_ranap_status').val();
            const keyword = $('#farmasi_ranap_keyword').val();

            const $tbody = $('#tbody_permintaan_ranap_farmasi');
            if (!isBackgroundCountOnly) {
                $tbody.html('<tr><td colspan="7" class="text-center text-muted py-3">Memuat antrean permintaan obat ranap...</td></tr>');
            }

            $.get("{{ route('farmasi.permintaan-ranap.data') }}", {
                tgl_awal: tglAwal,
                tgl_akhir: tglAkhir,
                status: status,
                keyword: keyword
            }).done(function(data) {
                let countTotal = data ? data.length : 0;
                let countMenunggu = 0;
                let countSelesai = 0;

                if (data && data.length > 0) {
                    data.forEach(function(row) {
                        if (row.status === 'Belum') {
                            countMenunggu++;
                        } else {
                            countSelesai++;
                        }
                    });
                }

                $('#count-ranap-total').text(countTotal);
                $('#count-ranap-menunggu').text(countMenunggu);
                $('#count-ranap-selesai').text(countSelesai);
                $('#badgeCountRanapTunggu').text(countMenunggu);

                if (isBackgroundCountOnly) return;

                $tbody.empty();
                if (!data || data.length === 0) {
                    $tbody.html('<tr><td colspan="7" class="text-center text-muted py-3"><i>Tidak ada antrean permintaan obat ranap pada filter ini.</i></td></tr>');
                    return;
                }

                data.forEach(function(row) {
                    const kamarText = getKamarFormat(row.reg_periksa);
                    const safeNmPasien = safeJsStr(row.reg_periksa?.pasien?.nm_pasien);
                    const safeKamar = safeJsStr(kamarText);
                    const safeNoPermintaan = safeJsStr(row.no_permintaan);
                    const safeNoRawat = safeJsStr(row.no_rawat);

                    const penjabText = (row.reg_periksa?.penjab?.png_jawab || '').includes('BPJS')
                        ? '<span class="badge bg-success-subtle text-success border border-success">BPJS</span>'
                        : '<span class="badge bg-danger-subtle text-danger border border-danger">UMUM</span>';

                    const statusBadge = row.status === 'Sudah'
                        ? '<span class="badge bg-success-subtle text-success border border-success-subtle px-2.5 py-1.5 rounded-pill fw-semibold text-nowrap d-inline-flex align-items-center gap-1" style="font-size: 11.5px;"><i class="bi bi-check-circle"></i> Sudah Disiapkan</span>'
                        : '<span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-2.5 py-1.5 rounded-pill fw-semibold text-nowrap d-inline-flex align-items-center gap-1" style="font-size: 11.5px;"><i class="bi bi-hourglass-split"></i> Menunggu Farmasi</span>';

                    const telaahBadge = row.telaah_farmasi
                        ? `<span class="badge text-white px-2.5 py-1.5 rounded-pill fw-semibold text-nowrap d-inline-flex align-items-center gap-1" style="background-color: #0f766e; font-size: 11.5px;"><i class="bi bi-shield-check"></i> Sudah Ditelaah</span>`
                        : `<span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle px-2.5 py-1.5 rounded-pill fw-semibold text-nowrap d-inline-flex align-items-center gap-1" style="font-size: 11.5px;"><i class="bi bi-shield"></i> Belum Ditelaah</span>`;

                    const isHighlighted = recentlyAlertedIds.has(row.no_permintaan) ? 'row-highlight-baru' : '';
                    const tr = `
                        <tr class="${isHighlighted}">
                            <td class="text-center align-middle">
                                <span class="font-monospace fw-bold text-primary">${safeNoPermintaan}</span><br>
                                <small class="text-muted">${row.tgl_permintaan} pk ${row.jam}</small>
                            </td>
                            <td class="align-middle"><strong>${kamarText}</strong></td>
                            <td class="align-middle">
                                <div><strong>${row.reg_periksa?.pasien?.nm_pasien || '-'}</strong> ${penjabText}</div>
                                <div class="font-monospace text-muted" style="font-size: 10.5px;">RM: ${row.reg_periksa?.no_rkm_medis || '-'} | No. Rawat: ${row.no_rawat}</div>
                            </td>
                            <td class="align-middle"><small>${row.dokter?.nm_dokter || '-'}</small></td>
                            <td class="text-center align-middle">${telaahBadge}</td>
                            <td class="text-center align-middle">${statusBadge}</td>
                            <td class="text-center align-middle">
                                <div class="d-inline-flex align-items-center gap-1">
                                    <button type="button" class="btn btn-outline-primary btn-sm px-2.5 py-1 fw-semibold text-nowrap d-inline-flex align-items-center gap-1 rounded" onclick="bukaDetailRanapFarmasi('${safeNoPermintaan}')" title="Detail Item &amp; Validasi" style="font-size: 11.5px; height: 30px;">
                                        <i class="bi bi-eye"></i> <span>Detail</span>
                                    </button>
                                    <button type="button" class="btn btn-sm text-white px-2.5 py-1 fw-semibold text-nowrap d-inline-flex align-items-center gap-1 rounded" style="background-color: #0f766e; font-size: 11.5px; height: 30px;" onclick="bukaModalTelaahFarmasi('${safeNoPermintaan}', '${safeNoRawat}', '${safeNmPasien}', '${safeKamar}')" title="Telaah Resep &amp; Obat">
                                        <i class="bi bi-shield-check"></i> <span>Telaah</span>
                                    </button>
                                    <button type="button" class="btn btn-outline-secondary btn-sm px-2 py-1 text-nowrap d-inline-flex align-items-center gap-1 rounded" onclick="cetakPermintaanObat('${safeNoPermintaan}')" title="Cetak Lembar Resmi" style="font-size: 11.5px; height: 30px;">
                                        <i class="bi bi-printer"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    `;
                    $tbody.append(tr);
                });
            });
        }

        // Buka Detail Permintaan Ranap di Modal Farmasi
        function bukaDetailRanapFarmasi(noPermintaan) {
            $.get(`{{ url('/ranap/permintaan-obat/detail') }}/${noPermintaan}`).done(function(res) {
                $('#fDetNoPermintaan').text(res.no_permintaan);
                $('#fDetTglJam').text(`${res.tgl_permintaan} ${res.jam}`);
                $('#fDetPasien').text(`${res.reg_periksa?.pasien?.nm_pasien || '-'} (${res.no_rawat})`);

                const kamar = getKamarFormat(res.reg_periksa);
                $('#fDetKamar').text(kamar);

                $('#fDetStatusBadge').html(res.status === 'Sudah' ? '<span class="badge bg-success">Sudah Disiapkan</span>' : '<span class="badge bg-warning text-dark">Menunggu Farmasi</span>');

                // Render tombol aksi footer
                $('#btnCetakDariFarmasiDetail').off('click').on('click', function() {
                    cetakPermintaanObat(res.no_permintaan);
                });

                $('#btnTelaahDariFarmasiDetail').off('click').on('click', function() {
                    bukaModalTelaahFarmasi(res.no_permintaan, res.no_rawat, res.reg_periksa?.pasien?.nm_pasien || '', kamar);
                });

                if (res.status === 'Sudah') {
                    $('#btnEksekusiValidasiFarmasi').addClass('disabled').text('Sudah Divalidasi');
                } else {
                    $('#btnEksekusiValidasiFarmasi').removeClass('disabled').html('<i class="bi bi-check-circle me-1"></i> Validasi Kesiapan Stok');
                    $('#btnEksekusiValidasiFarmasi').off('click').on('click', function() {
                        validasiStokFarmasi(res.no_permintaan);
                    });
                }

                // Render detail tabel obat
                const $tbody = $('#fDetTbodyObat');
                $tbody.empty();
                const details = res.detail_permintaan || [];

                if (details.length === 0) {
                    $tbody.html('<tr><td colspan="7" class="text-center text-muted py-3">Tidak ada data obat.</td></tr>');
                } else {
                    details.forEach(function(det, idx) {
                        const jamList = [];
                        for (let h = 0; h <= 23; h++) {
                            const key = `jam${String(h).padStart(2, '0')}`;
                            if (det[key] === 'true') {
                                jamList.push(`${String(h).padStart(2, '0')}:00`);
                            }
                        }
                        const jamStr = jamList.length > 0 ? jamList.map(j => `<span class="badge bg-success-subtle text-success border border-success me-0.5" style="font-size: 9px;">${j}</span>`).join(' ') : '-';
                        const sat = det.data_barang?.kode_satuan?.satuan || det.data_barang?.kode_sat || '-';

                        let btnSubstitusiHtml = '-';
                        if (res.status === 'Belum') {
                            const safeNoPermintaan = safeJsStr(res.no_permintaan);
                            const safeKodeBrng = safeJsStr(det.kode_brng);
                            const safeNamaBrng = safeJsStr(det.data_barang?.nama_brng || det.kode_brng);
                            const safeAturanPakai = safeJsStr(det.aturan_pakai || '');
                            btnSubstitusiHtml = `
                                <button type="button" class="btn btn-outline-warning btn-sm py-0 px-1 text-dark" onclick="bukaModalSubstitusi('${safeNoPermintaan}', '${safeKodeBrng}', '${safeNamaBrng}', ${det.jml}, '${safeAturanPakai}')" title="Substitusi / Ganti Obat">
                                    <i class="bi bi-arrow-left-right"></i> Ganti
                                </button>
                            `;
                        }

                        const tr = `
                            <tr>
                                <td class="text-center">${idx + 1}</td>
                                <td class="font-monospace">${det.kode_brng}</td>
                                <td><strong>${det.data_barang?.nama_brng || '-'}</strong></td>
                                <td class="text-center fw-bold text-primary">${det.jml}</td>
                                <td class="text-center">${sat}</td>
                                <td>
                                    <div>${det.aturan_pakai}</div>
                                    <div class="mt-1">${jamStr}</div>
                                </td>
                                <td class="text-center">${btnSubstitusiHtml}</td>
                            </tr>
                        `;
                        $tbody.append(tr);
                    });
                }

                $('#modalFarmasiDetailPermintaan').modal('show');
            });
        }

        // Eksekusi Validasi Stok Farmasi (Murni validasi penyiapan stok tanpa billing)
        function validasiStokFarmasi(noPermintaan) {
            Swal.fire({
                title: 'Validasi Kesiapan Stok?',
                text: `Validasi penyiapan obat untuk ${noPermintaan}? Stok gudang depo akan dikurangi dan dimasukkan ke stok buffer pasien. (Belum ditagih ke billing pasien)`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#198754',
                confirmButtonText: 'Ya, Siapkan & Validasi',
                cancelButtonText: 'Batal'
            }).then((res) => {
                if (res.isConfirmed) {
                    $.ajax({
                        url: "{{ route('ranap.permintaan-obat.validasi') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            no_permintaan: noPermintaan
                        },
                        beforeSend: function() {
                            Swal.fire({ title: 'Memvalidasi Stok...', allowOutsideClick: false, didOpen: () => { Swal.showLoading(); } });
                        },
                        success: function(resp) {
                            Swal.fire('Berhasil!', resp.message || 'Obat berhasil disiapkan dan divalidasi ke stok pasien.', 'success');
                            $('#modalFarmasiDetailPermintaan').modal('hide');
                            loadPermintaanRanapFarmasi();
                        },
                        error: function(xhr) {
                            const msg = xhr.responseJSON?.message || 'Gagal memvalidasi stok farmasi.';
                            Swal.fire('Gagal!', msg, 'error');
                        }
                    });
                }
            });
        }

        // Cetak Lembar Permintaan Resmi
        function cetakPermintaanObat(noPermintaan) {
            if (!noPermintaan) return;
            const printUrl = `{{ route('ranap.permintaan-obat.cetak') }}?no_permintaan=${encodeURIComponent(noPermintaan)}`;
            window.open(printUrl, '_blank');
        }

        // ========================================================
        // TAB 2: FITUR RESEP DOKTER RAWAT INAP (RANAP)
        // ========================================================

        function loadResepRanapFarmasi(isBackgroundCountOnly = false) {
            const tglAwal = moment($('#farmasi_resep_ranap_tgl_awal').val(), 'DD-MM-YYYY').format('YYYY-MM-DD');
            const tglAkhir = moment($('#farmasi_resep_ranap_tgl_akhir').val(), 'DD-MM-YYYY').format('YYYY-MM-DD');
            const status = $('#farmasi_resep_ranap_status').val();
            const keyword = $('#farmasi_resep_ranap_keyword').val();

            const $tbody = $('#tbody_farmasi_resep_ranap');
            if (!isBackgroundCountOnly) {
                $tbody.html('<tr><td colspan="7" class="text-center text-muted py-3">Memuat data resep dokter ranap...</td></tr>');
            }

            $.get("{{ route('farmasi.resep-ranap.data') }}", {
                tgl_awal: tglAwal,
                tgl_akhir: tglAkhir,
                status: status,
                keyword: keyword
            }).done(function(data) {
                let countTotal = data ? data.length : 0;
                let countMenunggu = 0;
                let countSelesai = 0;

                if (data && data.length > 0) {
                    data.forEach(function(row) {
                        if (row.tgl_perawatan === '0000-00-00') {
                            countMenunggu++;
                        } else {
                            countSelesai++;
                        }
                    });
                }

                $('#count-resep-ranap-total').text(countTotal);
                $('#count-resep-ranap-menunggu').text(countMenunggu);
                $('#count-resep-ranap-selesai').text(countSelesai);
                $('#badgeCountResepRanapTunggu').text(countMenunggu);

                if (isBackgroundCountOnly) return;

                $tbody.empty();
                if (!data || data.length === 0) {
                    $tbody.html('<tr><td colspan="7" class="text-center text-muted py-3"><i>Tidak ada data resep dokter ranap pada filter ini.</i></td></tr>');
                    return;
                }

                data.forEach(function(row) {
                    const kamarText = getKamarFormat(row.reg_periksa);
                    const safeNmPasien = safeJsStr(row.reg_periksa?.pasien?.nm_pasien);
                    const safeKamar = safeJsStr(kamarText);
                    const safeNoResep = safeJsStr(row.no_resep);
                    const safeNoRawat = safeJsStr(row.no_rawat);

                    const penjabText = (row.reg_periksa?.penjab?.png_jawab || '').includes('BPJS')
                        ? '<span class="badge bg-success-subtle text-success border border-success">BPJS</span>'
                        : '<span class="badge bg-danger-subtle text-danger border border-danger">UMUM</span>';

                    const isSelesai = row.tgl_perawatan !== '0000-00-00';
                    const statusBadge = isSelesai
                        ? `<span class="badge bg-success-subtle text-success border border-success-subtle px-2.5 py-1.5 rounded-pill fw-semibold text-nowrap d-inline-flex align-items-center gap-1" style="font-size: 11.5px;"><i class="bi bi-check-circle"></i> Terlayani (${row.tgl_perawatan})</span>`
                        : `<span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-2.5 py-1.5 rounded-pill fw-semibold text-nowrap d-inline-flex align-items-center gap-1" style="font-size: 11.5px;"><i class="bi bi-hourglass-split"></i> Belum Terlayani</span>`;

                    const telaahBadge = row.telaah_farmasi
                        ? `<span class="badge text-white px-2.5 py-1.5 rounded-pill fw-semibold text-nowrap d-inline-flex align-items-center gap-1" style="background-color: #0f766e; font-size: 11.5px;"><i class="bi bi-shield-check"></i> Sudah Ditelaah</span>`
                        : `<span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle px-2.5 py-1.5 rounded-pill fw-semibold text-nowrap d-inline-flex align-items-center gap-1" style="font-size: 11.5px;"><i class="bi bi-shield"></i> Belum Ditelaah</span>`;

                    const btnClass = isSelesai ? 'btn-success' : 'btn-primary';
                    const btnLabel = isSelesai ? 'SELESAI' : 'RESEP';

                    const isHighlighted = recentlyAlertedIds.has(row.no_resep) ? 'row-highlight-baru' : '';
                    const tr = `
                        <tr class="${isHighlighted}">
                            <td class="text-center align-middle">
                                <span class="font-monospace fw-bold text-primary">${safeNoResep}</span><br>
                                <small class="text-muted">${row.tgl_peresepan} ${row.jam_peresepan}</small>
                            </td>
                            <td class="align-middle"><strong>${kamarText}</strong></td>
                            <td class="align-middle">
                                <div><strong>${row.reg_periksa?.pasien?.nm_pasien || '-'}</strong> ${penjabText}</div>
                                <div class="font-monospace text-muted" style="font-size: 10.5px;">RM: ${row.reg_periksa?.no_rkm_medis || '-'} | No. Rawat: ${row.no_rawat}</div>
                            </td>
                            <td class="align-middle"><small>${row.dokter?.nm_dokter || '-'}</small></td>
                            <td class="text-center align-middle">${telaahBadge}</td>
                            <td class="text-center align-middle">${statusBadge}</td>
                            <td class="text-center align-middle">
                                <div class="d-inline-flex align-items-center gap-1">
                                    <button type="button" class="btn ${btnClass} btn-sm px-2.5 py-1 fw-semibold text-nowrap d-inline-flex align-items-center gap-1 rounded" onclick="tampilResep('${safeNoResep}', '')" title="Detail Resep &amp; Validasi" style="font-size: 11.5px; height: 30px;">
                                        <i class="bi bi-capsule"></i> <span>${btnLabel}</span>
                                    </button>
                                    <button type="button" class="btn btn-sm text-white px-2.5 py-1 fw-semibold text-nowrap d-inline-flex align-items-center gap-1 rounded" style="background-color: #0f766e; font-size: 11.5px; height: 30px;" onclick="bukaModalTelaahFarmasi('${safeNoResep}', '${safeNoRawat}', '${safeNmPasien}', '${safeKamar}')" title="Telaah Resep Farmasi">
                                        <i class="bi bi-shield-check"></i> <span>TELAAH</span>
                                    </button>
                                    <button type="button" class="btn btn-outline-primary btn-sm px-2.5 py-1 fw-semibold text-nowrap d-inline-flex align-items-center gap-1 rounded" style="font-size: 11.5px; height: 30px;" onclick="bukaModalEtiket('${safeNoResep}')" title="Cetak Etiket Aturan Pakai Obat">
                                        <i class="bi bi-printer"></i> <span>ETIKET</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    `;
                    $tbody.append(tr);
                });
            });
        }

        // ========================================================
        // TAB 4: FITUR PERMINTAAN RESEP PULANG (KHANZA TAB 4)
        // ========================================================

        let currentNoPermintaanPulang = null;

        function loadPermintaanResepPulangFarmasi(isBackgroundCountOnly = false) {
            const tglAwal = moment($('#farmasi_pulang_tgl_awal').val(), 'DD-MM-YYYY').format('YYYY-MM-DD');
            const tglAkhir = moment($('#farmasi_pulang_tgl_akhir').val(), 'DD-MM-YYYY').format('YYYY-MM-DD');
            const status = $('#farmasi_pulang_status').val();
            const keyword = $('#farmasi_pulang_keyword').val();

            const $tbody = $('#tbody_farmasi_resep_pulang');
            if (!isBackgroundCountOnly) {
                $tbody.html('<tr><td colspan="6" class="text-center text-muted py-3">Memuat permintaan resep pulang...</td></tr>');
            }

            $.get("{{ route('farmasi.resep-pulang.permintaan') }}", {
                tgl_awal: tglAwal,
                tgl_akhir: tglAkhir,
                status: status,
                keyword: keyword
            }).done(function(data) {
                let countTotal = data ? data.length : 0;
                let countMenunggu = 0;
                let countSelesai = 0;

                if (data && data.length > 0) {
                    data.forEach(function(row) {
                        if (row.status === 'Belum') {
                            countMenunggu++;
                        } else {
                            countSelesai++;
                        }
                    });
                }

                $('#count-pulang-total').text(countTotal);
                $('#count-pulang-menunggu').text(countMenunggu);
                $('#count-pulang-selesai').text(countSelesai);
                $('#badgeCountPulangTunggu').text(countMenunggu);

                if (isBackgroundCountOnly) return;

                $tbody.empty();
                if (!data || data.length === 0) {
                    $tbody.html('<tr><td colspan="6" class="text-center text-muted py-3"><i>Tidak ada antrean permintaan resep pulang pada filter ini.</i></td></tr>');
                    return;
                }

                data.forEach(function(row) {
                    const kamarText = getKamarFormat(row.reg_periksa);
                    const safeNoPermintaan = safeJsStr(row.no_permintaan);

                    const penjabText = (row.reg_periksa?.penjab?.png_jawab || '').includes('BPJS')
                        ? '<span class="badge bg-success-subtle text-success border border-success">BPJS</span>'
                        : '<span class="badge bg-danger-subtle text-danger border border-danger">UMUM</span>';

                    const hasRacikan = (row.detail || []).some(d => (d.dosis || '').startsWith('[Racikan:')) || (row.racikan && row.racikan.length > 0);
                    const racikanBadge = hasRacikan 
                        ? '<span class="badge bg-primary-subtle text-primary border border-primary-subtle ms-1" style="font-size: 10px;"><i class="bi bi-mortar-pestle me-1"></i>Ada Racikan</span>' 
                        : '';

                    const isSudah = row.status === 'Sudah';
                    const statusBadge = isSudah
                        ? `<span class="badge bg-success-subtle text-success border border-success-subtle px-2.5 py-1.5 rounded-pill fw-semibold text-nowrap d-inline-flex align-items-center gap-1" style="font-size: 11.5px;"><i class="bi bi-check-circle"></i> Sudah Divalidasi</span>`
                        : `<span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-2.5 py-1.5 rounded-pill fw-semibold text-nowrap d-inline-flex align-items-center gap-1" style="font-size: 11.5px;"><i class="bi bi-hourglass-split"></i> Menunggu Farmasi</span>`;

                    const btnClass = isSudah ? 'btn-outline-success' : 'btn-primary';

                    const isHighlighted = recentlyAlertedIds.has(row.no_permintaan) ? 'row-highlight-baru' : '';
                    const tr = `
                        <tr class="${isHighlighted}">
                            <td class="text-center align-middle">
                                <span class="font-monospace fw-bold text-primary">${safeNoPermintaan}</span><br>
                                <small class="text-muted">${row.tgl_permintaan} ${row.jam}</small>
                            </td>
                            <td class="align-middle"><strong>${kamarText}</strong></td>
                            <td class="align-middle">
                                <div><strong>${row.reg_periksa?.pasien?.nm_pasien || '-'}</strong> ${penjabText} ${racikanBadge}</div>
                                <div class="font-monospace text-muted" style="font-size: 10.5px;">RM: ${row.reg_periksa?.no_rkm_medis || '-'} | No. Rawat: ${row.no_rawat}</div>
                            </td>
                            <td class="align-middle"><small>${row.dokter?.nm_dokter || '-'}</small></td>
                            <td class="text-center align-middle">${statusBadge}</td>
                            <td class="text-center align-middle">
                                <div class="d-flex justify-content-center gap-1">
                                    <button type="button" class="btn ${btnClass} btn-sm px-2.5 py-1 fw-semibold text-nowrap d-inline-flex align-items-center gap-1 shadow-xs" onclick="bukaDetailResepPulangFarmasi('${safeNoPermintaan}')" title="Detail Item &amp; Validasi" style="font-size: 11.5px; height: 30px;">
                                        <i class="bi bi-box-arrow-right"></i> <span>Detail &amp; Validasi</span>
                                    </button>
                                    <button type="button" class="btn btn-outline-primary btn-sm px-2.5 py-1 fw-semibold text-nowrap d-inline-flex align-items-center gap-1 shadow-xs" onclick="bukaModalCetakEtiketPulang('${safeNoPermintaan}')" title="Cetak Etiket Aturan Pakai Obat Pulang" style="font-size: 11.5px; height: 30px;">
                                        <i class="bi bi-printer"></i> <span>Etiket</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    `;
                    $tbody.append(tr);
                });
            });
        }

        function bukaDetailResepPulangFarmasi(noPermintaan) {
            currentNoPermintaanPulang = noPermintaan;
            $.get(`{{ url('/farmasi/resep-pulang/detail') }}/${noPermintaan}`).done(function(res) {
                const p = res.permintaan;
                $('#fPulangNoPermintaan').text(p.no_permintaan);
                $('#fPulangTglJam').text(`${p.tgl_permintaan} ${p.jam}`);
                $('#fPulangPasien').text(p.reg_periksa?.pasien?.nm_pasien || '-');
                $('#fPulangNoRawat').text(`RM: ${p.reg_periksa?.no_rkm_medis || '-'} | No. Rawat: ${p.no_rawat}`);

                const kamar = getKamarFormat(p.reg_periksa);
                $('#fPulangKamar').text(kamar);
                $('#fPulangDokter').text(p.dokter?.nm_dokter || '-');
                $('#fPulangDepo').text(`${res.kdBangsal} (${res.nmBangsal})`);

                const isValidated = res.is_validated;
                $('#fPulangStatusBadge').html(isValidated ? '<span class="badge bg-success">Sudah Divalidasi</span>' : '<span class="badge bg-warning text-dark">Menunggu Validasi</span>');

                if (isValidated) {
                    $('#sectionTambahItemPulang').hide();
                    $('#thAksiPulang').hide();
                    $('#btnEksekusiValidasiResepPulang').addClass('disabled').html('<i class="bi bi-check-circle me-1"></i> Sudah Divalidasi');
                } else {
                    $('#sectionTambahItemPulang').show();
                    $('#thAksiPulang').show();
                    $('#btnEksekusiValidasiResepPulang').removeClass('disabled').html('<i class="bi bi-check2-circle me-1"></i> Validasi Resep Pulang Sekarang');
                    $('#btnEksekusiValidasiResepPulang').off('click').on('click', function() {
                        eksekusiValidasiResepPulang(p.no_permintaan);
                    });
                }

                renderTbodyResepPulangFarmasi(res.items_non_racikan || res.items || [], res.items_racikan || [], isValidated, res);
                initSelect2ObatPulang();
                $('#modalDetailResepPulangFarmasi').modal('show');
            });
        }

        function renderTbodyResepPulangFarmasi(itemsNonRacik, itemsRacik, isValidated, res) {
            const $tbody = $('#tbodyDetailResepPulangFarmasi');
            $tbody.empty();

            if (!itemsNonRacik || itemsNonRacik.length === 0) {
                $tbody.html('<tr><td colspan="12" class="text-center text-muted py-3">Tidak ada obat non-racikan pada permintaan ini.</td></tr>');
            } else {
                itemsNonRacik.forEach(function(item, idx) {
                    const safeKodeBrng = safeJsStr(item.kode_brng);
                    const stokClass = (item.stok_depo <= 0) ? 'text-danger fw-bold' : ((item.stok_depo < item.jml) ? 'text-warning fw-bold' : 'text-success fw-bold');
                    const aksiHtml = isValidated ? '' : `
                        <td class="text-center">
                            <button type="button" class="btn btn-outline-danger btn-sm py-0 px-1" onclick="hapusItemResepPulang('${safeKodeBrng}')" title="Hapus Item">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    `;

                    const isRacikanLegacy = (item.dosis || '').startsWith('[Racikan:');
                    const dosisHtml = isRacikanLegacy 
                        ? `<span class="badge bg-primary text-white me-1" style="font-size: 10px;"><i class="bi bi-mortar-pestle me-1"></i>Racikan</span><strong>${item.dosis}</strong>` 
                        : (item.dosis || '-');

                    const tr = `
                        <tr>
                            <td class="text-center">${idx + 1}</td>
                            <td class="font-monospace">${item.kode_brng}</td>
                            <td><strong>${item.nama_brng}</strong></td>
                            <td class="text-center fw-bold text-primary">${item.jml}</td>
                            <td class="text-center">${item.satuan}</td>
                            <td>${dosisHtml}</td>
                            <td class="text-center ${stokClass}">${item.stok_depo}</td>
                            <td class="text-end font-monospace">Rp ${new Intl.NumberFormat('id-ID').format(item.harga)}</td>
                            <td class="text-end font-monospace">Rp ${new Intl.NumberFormat('id-ID').format(item.embalase)}</td>
                            <td class="text-end font-monospace">Rp ${new Intl.NumberFormat('id-ID').format(item.tuslah)}</td>
                            <td class="text-end font-monospace fw-bold text-primary">Rp ${new Intl.NumberFormat('id-ID').format(item.total)}</td>
                            ${aksiHtml}
                        </tr>
                    `;
                    $tbody.append(tr);
                });
            }

            // Render Section Racikan
            const $racikanContainer = $('#fPulangRacikanContainer');
            $racikanContainer.empty();

            if (!itemsRacik || itemsRacik.length === 0) {
                $racikanContainer.html('<div class="text-center text-muted py-2" style="font-size: 12px;"><i>Tidak ada obat racikan pada permintaan ini.</i></div>');
            } else {
                itemsRacik.forEach(function(r) {
                    let bahanRows = '';
                    (r.bahan || []).forEach(function(b, bIdx) {
                        const stokBahanClass = (b.stok_depo <= 0) ? 'text-danger fw-bold' : ((b.stok_depo < b.jml) ? 'text-warning fw-bold' : 'text-success fw-bold');
                        const p1p2 = (b.p1 && b.p2) ? `${b.p1}/${b.p2}` : '-';
                        const kand = b.kandungan ? `${b.kandungan} mg` : '-';
                        bahanRows += `
                            <tr>
                                <td class="text-center text-muted">${bIdx + 1}</td>
                                <td class="font-monospace">${b.kode_brng}</td>
                                <td><strong>${b.nama_brng}</strong></td>
                                <td class="text-center">${p1p2}</td>
                                <td class="text-center">${kand}</td>
                                <td class="text-center fw-bold text-primary">${b.jml}</td>
                                <td class="text-center">${b.satuan}</td>
                                <td class="text-center ${stokBahanClass}">${b.stok_depo}</td>
                                <td class="text-end font-monospace">Rp ${new Intl.NumberFormat('id-ID').format(b.harga)}</td>
                                <td class="text-end font-monospace">Rp ${new Intl.NumberFormat('id-ID').format(b.embalase)}</td>
                                <td class="text-end font-monospace">Rp ${new Intl.NumberFormat('id-ID').format(b.tuslah)}</td>
                                <td class="text-end font-monospace fw-bold text-primary">Rp ${new Intl.NumberFormat('id-ID').format(b.total)}</td>
                            </tr>
                        `;
                    });

                    const btnHapusRacik = isValidated ? '' : `
                        <button type="button" class="btn btn-outline-danger btn-sm py-0 px-2" onclick="hapusRacikanResepPulang(${r.no_racik})" title="Hapus Seluruh Racikan Ini">
                            <i class="bi bi-trash me-1"></i> Hapus Racikan
                        </button>
                    `;

                    const racikCard = `
                        <div class="card border mb-2 shadow-xs rounded-2">
                            <div class="card-header bg-light py-1.5 px-3 d-flex justify-content-between align-items-center flex-wrap gap-1">
                                <div class="d-flex align-items-center gap-2 flex-wrap">
                                    <span class="badge bg-primary px-2 py-1"><i class="bi bi-mortar-pestle me-1"></i>RACIKAN #${r.no_racik} (${r.kd_racik})</span>
                                    <strong class="text-dark fs-6">${r.nama_racik}</strong>
                                    <span class="badge bg-secondary">${r.jml_dr} ${r.kd_racik}</span>
                                    <span class="text-muted ms-2"><i class="bi bi-clock-history me-1"></i>Aturan Pakai: <strong class="text-dark">${r.aturan_pakai}</strong></span>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="font-monospace fw-bold text-primary" style="font-size: 12px;">Subtotal Racikan: Rp ${new Intl.NumberFormat('id-ID').format(r.subtotal)}</span>
                                    ${btnHapusRacik}
                                </div>
                            </div>
                            <div class="table-responsive p-0">
                                <table class="table table-sm table-bordered align-middle mb-0" style="font-size: 11px;">
                                    <thead class="table-light text-center">
                                        <tr>
                                            <th width="3%">#</th>
                                            <th width="11%">Kode</th>
                                            <th>Nama Bahan Obat</th>
                                            <th width="7%">P1/P2</th>
                                            <th width="9%">Kandungan</th>
                                            <th width="8%">Total Diambil</th>
                                            <th width="7%">Satuan</th>
                                            <th width="8%">Stok Depo</th>
                                            <th width="10%">Harga</th>
                                            <th width="8%">Embalase</th>
                                            <th width="8%">Tuslah</th>
                                            <th width="11%">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        ${bahanRows}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    `;
                    $racikanContainer.append(racikCard);
                });
            }

            $('#fPulangCountItem').text(`${(itemsNonRacik || []).length} Item`);
            $('#fPulangCountRacikan').text(`${(itemsRacik || []).length} Racikan`);
            $('#fPulangBiayaObatNetto').text(`Rp ${new Intl.NumberFormat('id-ID').format(res.biaya_obat_netto || 0)}`);
            $('#fPulangTotalEmbalase').text(`Rp ${new Intl.NumberFormat('id-ID').format(res.total_embalase || 0)}`);
            $('#fPulangTotalTuslah').text(`Rp ${new Intl.NumberFormat('id-ID').format(res.total_tuslah || 0)}`);
            $('#fPulangGrandTotal').text(`Rp ${new Intl.NumberFormat('id-ID').format(res.grand_total || 0)}`);
        }

        function initSelect2ObatPulang() {
            if ($('#selectObatPulangBaru').hasClass("select2-hidden-accessible")) {
                return;
            }
            $('#selectObatPulangBaru').select2({
                dropdownParent: $('#modalDetailResepPulangFarmasi'),
                placeholder: 'Ketik nama obat atau kode barang...',
                minimumInputLength: 2,
                ajax: {
                    url: "{{ route('obat.cari') }}",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return { q: params.term };
                    },
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    id: item.kode_brng,
                                    text: `${item.nama_brng} (${item.kode_brng}) - Satuan: ${item.kode_sat}`
                                };
                            })
                        };
                    },
                    cache: true
                }
            });

            $('#btnSimpanItemPulang').off('click').on('click', function() {
                const kodeBrng = $('#selectObatPulangBaru').val();
                const jml = parseFloat($('#inputJmlPulangBaru').val()) || 1;
                const dosis = $('#inputDosisPulangBaru').val();

                if (!kodeBrng) {
                    Swal.fire('Peringatan', 'Pilih obat terlebih dahulu!', 'warning');
                    return;
                }

                $.ajax({
                    url: "{{ route('farmasi.resep-pulang.simpan-item') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        no_permintaan: currentNoPermintaanPulang,
                        kode_brng: kodeBrng,
                        jml: jml,
                        dosis: dosis
                    },
                    success: function() {
                        $('#selectObatPulangBaru').val(null).trigger('change');
                        $('#inputJmlPulangBaru').val(1);
                        $('#inputDosisPulangBaru').val('');
                        bukaDetailResepPulangFarmasi(currentNoPermintaanPulang);
                    },
                    error: function(xhr) {
                        Swal.fire('Gagal', xhr.responseJSON?.message || 'Gagal menyimpan item obat', 'error');
                    }
                });
            });
        }

        function hapusItemResepPulang(kodeBrng) {
            Swal.fire({
                title: 'Hapus Item Obat?',
                text: 'Hapus obat ini dari permintaan resep pulang?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((res) => {
                if (res.isConfirmed) {
                    $.ajax({
                        url: "{{ route('farmasi.resep-pulang.hapus-item') }}",
                        type: "DELETE",
                        data: {
                            _token: "{{ csrf_token() }}",
                            no_permintaan: currentNoPermintaanPulang,
                            kode_brng: kodeBrng
                        },
                        success: function() {
                            bukaDetailResepPulangFarmasi(currentNoPermintaanPulang);
                        },
                        error: function(xhr) {
                            Swal.fire('Gagal', xhr.responseJSON?.message || 'Gagal menghapus item obat', 'error');
                        }
                    });
                }
            });
        }

        function hapusRacikanResepPulang(noRacik) {
            Swal.fire({
                title: 'Hapus Racikan?',
                text: 'Hapus seluruh racikan ini dari permintaan resep pulang?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                confirmButtonText: 'Ya, Hapus Racikan',
                cancelButtonText: 'Batal'
            }).then((res) => {
                if (res.isConfirmed) {
                    $.ajax({
                        url: "{{ route('farmasi.resep-pulang.hapus-racikan') }}",
                        type: "DELETE",
                        data: {
                            _token: "{{ csrf_token() }}",
                            no_permintaan: currentNoPermintaanPulang,
                            no_racik: noRacik
                        },
                        success: function() {
                            bukaDetailResepPulangFarmasi(currentNoPermintaanPulang);
                        },
                        error: function(xhr) {
                            Swal.fire('Gagal', xhr.responseJSON?.message || 'Gagal menghapus racikan', 'error');
                        }
                    });
                }
            });
        }

        function eksekusiValidasiResepPulang(noPermintaan) {
            Swal.fire({
                title: 'Validasi Resep Pulang?',
                text: `Validasi resep pulang ${noPermintaan}? Stok depo RM akan dikurangi dan otomatis tersimpan ke billing Resep Pulang pasien.`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#198754',
                confirmButtonText: 'Ya, Validasi Sekarang!',
                cancelButtonText: 'Batal'
            }).then((res) => {
                if (res.isConfirmed) {
                    $.ajax({
                        url: "{{ route('farmasi.resep-pulang.validasi') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            no_permintaan: noPermintaan
                        },
                        beforeSend: function() {
                            Swal.fire({ title: 'Memvalidasi Resep Pulang...', allowOutsideClick: false, didOpen: () => { Swal.showLoading(); } });
                        },
                        success: function(resp) {
                            Swal.fire('Berhasil!', resp.message || 'Resep pulang berhasil divalidasi ke billing pasien.', 'success');
                            $('#modalDetailResepPulangFarmasi').modal('hide');
                            loadPermintaanResepPulangFarmasi();
                        },
                        error: function(xhr) {
                            Swal.fire('Gagal!', xhr.responseJSON?.message || 'Gagal memvalidasi resep pulang.', 'error');
                        }
                    });
                }
            });
        }

        // ========================================================
        // TAB 5: PENGAJUAN RETUR OBAT RAWAT INAP (FARMASI)
        // ========================================================

        function loadPengajuanReturFarmasi(isBackgroundCountOnly = false) {
            const $tbody = $('#tbody_farmasi_retur');
            if (!isBackgroundCountOnly) {
                $tbody.html('<tr><td colspan="7" class="text-center py-4 text-muted"><div class="spinner-border spinner-border-sm text-primary me-1"></div> Memuat data pengajuan retur...</td></tr>');
            }

            const tglAwalRaw = $('#farmasi_retur_tgl_awal').val();
            const tglAkhirRaw = $('#farmasi_retur_tgl_akhir').val();
            const status = $('#farmasi_retur_status').val();
            const keyword = $('#farmasi_retur_keyword').val() || '';

            const tglAwal = tglAwalRaw ? moment(tglAwalRaw, 'DD-MM-YYYY').format('YYYY-MM-DD') : '';
            const tglAkhir = tglAkhirRaw ? moment(tglAkhirRaw, 'DD-MM-YYYY').format('YYYY-MM-DD') : '';

            $.ajax({
                url: "{{ route('retur-obat.daftar') }}",
                type: "GET",
                data: {
                    tgl_awal: tglAwal,
                    tgl_akhir: tglAkhir,
                    status: status,
                    search: keyword
                },
                success: function(data) {
                    const list = Array.isArray(data) ? data : [];

                    // Update summary counts
                    let countTotal = list.length;
                    let countMenunggu = 0;
                    let countDisetujui = 0;
                    let countDitolak = 0;

                    list.forEach(function(item) {
                        if (item.status === 'Menunggu Validasi') countMenunggu++;
                        else if (item.status === 'Disetujui') countDisetujui++;
                        else countDitolak++;
                    });

                    $('#count-retur-total').text(countTotal);
                    $('#count-retur-menunggu').text(countMenunggu);
                    $('#count-retur-disetujui').text(countDisetujui);
                    $('#count-retur-ditolak').text(countDitolak);
                    $('#badgeCountReturTunggu').text(countMenunggu);

                    if (isBackgroundCountOnly) return;

                    $tbody.empty();
                    if (list.length === 0) {
                        $tbody.html('<tr><td colspan="7" class="text-center text-muted py-4"><i class="bi bi-inbox fs-4 d-block mb-1 text-secondary"></i> Tidak ada data pengajuan retur pada filter ini.</td></tr>');
                        return;
                    }

                    list.forEach(function(row) {
                        const safeNoPengajuan = safeJsStr(row.no_pengajuan);
                        const kamarText = getKamarFormat(row.reg_periksa);
                        const pasien = row.reg_periksa?.pasien || {};
                        const safeNmPasien = safeJsStr(pasien.nm_pasien || '-');
                        const safeNoRm = safeJsStr(pasien.no_rkm_medis || '-');

                        const isMenunggu = row.status === 'Menunggu Validasi';
                        const isDisetujui = row.status === 'Disetujui';

                        let badgeStatus = `<span class="badge bg-warning-subtle text-warning-emphasis border border-warning px-2.5 py-1.5 rounded-pill fw-semibold text-nowrap d-inline-flex align-items-center gap-1"><i class="bi bi-hourglass-split"></i> Menunggu Validasi</span>`;
                        if (isDisetujui) {
                            badgeStatus = `<span class="badge bg-success-subtle text-success border border-success px-2.5 py-1.5 rounded-pill fw-semibold text-nowrap d-inline-flex align-items-center gap-1"><i class="bi bi-check-circle"></i> Disetujui</span>`;
                        } else if (row.status === 'Ditolak') {
                            badgeStatus = `<span class="badge bg-danger-subtle text-danger border border-danger px-2.5 py-1.5 rounded-pill fw-semibold text-nowrap d-inline-flex align-items-center gap-1"><i class="bi bi-x-circle"></i> Ditolak</span>`;
                        } else if (row.status === 'Batal') {
                            badgeStatus = `<span class="badge bg-secondary-subtle text-secondary border border-secondary px-2.5 py-1.5 rounded-pill fw-semibold text-nowrap d-inline-flex align-items-center gap-1"><i class="bi bi-slash-circle"></i> Batal</span>`;
                        }

                        // Summary items
                        const details = row.details || [];
                        const detailsHtml = details.map(d => `<span class="badge bg-light text-dark border me-1 mb-1" style="font-size:10.5px;">${d.barang?.nama_brng || d.kode_brng} (<b>${d.jml_diajukan}</b> ${d.kode_sat || ''})</span>`).slice(0, 3).join('') + (details.length > 3 ? `<span class="badge bg-secondary-subtle text-secondary border" style="font-size:9.5px;">+${details.length - 3} lainnya</span>` : '');

                        const btnValidasi = isMenunggu
                            ? `<button type="button" class="btn btn-sm btn-primary d-inline-flex align-items-center gap-1 py-1 px-2.5 shadow-sm" onclick="bukaModalValidasiReturFarmasi('${safeNoPengajuan}')" title="Review & Validasi Pengajuan Retur">
                                <i class="bi bi-shield-check"></i> <span>Validasi</span>
                               </button>`
                            : `<button type="button" class="btn btn-sm btn-outline-primary d-inline-flex align-items-center gap-1 py-1 px-2.5" onclick="bukaModalValidasiReturFarmasi('${safeNoPengajuan}')" title="Lihat Detail Validasi">
                                <i class="bi bi-eye"></i> <span>Detail</span>
                               </button>`;

                        const btnCetak = `<button type="button" class="btn btn-sm btn-outline-secondary py-1 px-2" onclick="window.open('{{ url('/retur-obat/cetak') }}/${safeNoPengajuan}', '_blank')" title="Cetak Lembar Bukti Retur">
                            <i class="bi bi-printer"></i>
                        </button>`;

                        const isHighlighted = recentlyAlertedIds.has(row.no_pengajuan) ? 'row-highlight-baru' : '';

                        const tr = `
                            <tr class="${isHighlighted}">
                                <td class="text-center align-middle">
                                    <span class="font-monospace fw-bold text-primary" style="font-size: 12.5px;">${safeNoPengajuan}</span><br>
                                    <small class="text-muted">${splitTanggal(row.tgl_pengajuan)} ${row.jam_pengajuan}</small>
                                </td>
                                <td class="align-middle">
                                    <span class="text-dark fw-medium">${kamarText}</span>
                                </td>
                                <td class="align-middle">
                                    <strong class="text-dark">${safeNmPasien}</strong><br>
                                    <span class="text-muted font-monospace" style="font-size: 11px;">RM: ${safeNoRm} • ${row.no_rawat}</span>
                                </td>
                                <td class="align-middle">
                                    <span class="text-dark">${row.pegawai_pengaju?.nama || row.petugas_pengaju}</span>
                                </td>
                                <td class="align-middle">
                                    <div class="d-flex flex-wrap">${detailsHtml}</div>
                                </td>
                                <td class="text-center align-middle">
                                    ${badgeStatus}
                                    ${row.no_retur_jual ? `<div class="mt-1 font-monospace text-primary fw-bold" style="font-size:10.5px;">${row.no_retur_jual}</div>` : ''}
                                </td>
                                <td class="text-center align-middle">
                                    <div class="d-inline-flex gap-1">
                                        ${btnValidasi}
                                        ${btnCetak}
                                    </div>
                                </td>
                            </tr>
                        `;
                        $tbody.append(tr);
                    });
                },
                error: function() {
                    $tbody.html('<tr><td colspan="7" class="text-center text-danger py-3">Gagal memuat daftar pengajuan retur.</td></tr>');
                }
            });
        }
    </script>
@endpush
