<style>
    /* ======================================================
       SCOPED UX & RESPONSIVE STYLES: #modalSoapRalan
       ====================================================== */
    #modalSoapRalan .modal-content {
        background-color: #f4f6f9;
    }

    #modalSoapRalan .erm-modal-header {
        background: #ffffff;
        border-bottom: 1px solid #e2e8f0;
        padding: 10px 16px;
        gap: 10px;
        flex-wrap: wrap;
        position: sticky;
        top: 0;
        z-index: 30;
    }

    #modalSoapRalan .erm-patient-strip {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 6px 12px;
        min-width: 0;
        flex: 1 1 auto;
    }

    #modalSoapRalan .erm-patient-avatar {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: #eff6ff;
        color: #2563eb;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        flex-shrink: 0;
    }

    #modalSoapRalan .erm-patient-name {
        font-size: 14px;
        font-weight: 700;
        color: #0f172a;
        line-height: 1.2;
    }

    #modalSoapRalan .erm-patient-meta {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 6px;
        font-size: 11.5px;
        color: #475569;
        margin-top: 2px;
    }

    #modalSoapRalan .erm-meta-chip {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 2px 8px;
        border-radius: 999px;
        background: #f1f5f9;
        border: 1px solid #e2e8f0;
        font-size: 11px;
        font-weight: 600;
        color: #334155;
        white-space: nowrap;
    }

    #modalSoapRalan .erm-header-actions {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 6px;
        flex-shrink: 0;
    }

    #modalSoapRalan .modal-body {
        padding: 0 !important;
        display: flex;
        flex-direction: row;
        overflow: hidden;
        min-height: 0;
        background-color: #f4f6f9;
    }

    /* Left Vertical Tab Navigation Rail (Desktop >= 992px) */
    #modalSoapRalan .erm-tab-bar-wrap {
        width: 226px;
        flex: 0 0 226px;
        background: #ffffff;
        border-right: 1px solid #e2e8f0;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        z-index: 20;
        box-shadow: 2px 0 8px rgba(15, 23, 42, 0.03);
        transition: width 0.2s ease, flex-basis 0.2s ease;
    }

    #modalSoapRalan .erm-rail-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 12px 8px 12px;
        border-bottom: 1px solid #f1f5f9;
        gap: 6px;
        flex-shrink: 0;
    }

    #modalSoapRalan .erm-rail-title {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        color: #64748b;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    #modalSoapRalan .erm-rail-toggle-btn {
        width: 28px;
        height: 28px;
        padding: 0;
        border-radius: 7px;
        border: 1px solid #e2e8f0;
        background: #f8fafc;
        color: #475569;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        flex-shrink: 0;
        transition: all 0.15s ease;
    }

    #modalSoapRalan .erm-rail-toggle-btn:hover {
        background: #eff6ff;
        border-color: #bfdbfe;
        color: #2563eb;
    }

    #modalSoapRalan #tab-soap-rajal {
        display: flex;
        flex-direction: column;
        flex-wrap: nowrap;
        overflow-y: auto;
        overflow-x: hidden;
        flex: 1 1 auto;
        gap: 3px;
        border-bottom: 0;
        padding: 8px;
        scrollbar-width: thin;
        -webkit-overflow-scrolling: touch;
    }

    #modalSoapRalan #tab-soap-rajal::-webkit-scrollbar {
        width: 4px;
        height: 4px;
    }

    #modalSoapRalan #tab-soap-rajal::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 999px;
    }

    #modalSoapRalan .erm-rail-group-label {
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.7px;
        color: #94a3b8;
        padding: 8px 10px 3px 10px;
        list-style: none;
        user-select: none;
    }

    #modalSoapRalan .erm-rail-group-label:first-child {
        padding-top: 2px;
    }

    #modalSoapRalan #tab-soap-rajal > .nav-item {
        flex: 0 0 auto;
        width: 100%;
    }

    #modalSoapRalan #tab-soap-rajal .nav-link {
        width: 100%;
        text-align: left;
        white-space: nowrap;
        border: 1px solid transparent;
        border-radius: 8px;
        padding: 8px 10px;
        font-size: 12px;
        font-weight: 600;
        color: #475569;
        display: flex;
        align-items: center;
        gap: 9px;
        transition: all 0.15s ease;
    }

    #modalSoapRalan #tab-soap-rajal .nav-link i {
        font-size: 14px;
        width: 18px;
        text-align: center;
        flex-shrink: 0;
    }

    #modalSoapRalan #tab-soap-rajal .nav-link .erm-tab-label {
        overflow: hidden;
        text-overflow: ellipsis;
    }

    #modalSoapRalan #tab-soap-rajal .nav-link:hover {
        background-color: #f1f5f9;
        color: #0f172a;
    }

    #modalSoapRalan #tab-soap-rajal .nav-link.active {
        background-color: #2563eb;
        color: #ffffff;
        border-color: #2563eb;
        box-shadow: 0 2px 6px rgba(37, 99, 235, 0.25);
    }

    /* Collapsed Mini Icon Rail Mode (Desktop) */
    #modalSoapRalan.erm-rail-collapsed .erm-tab-bar-wrap {
        width: 58px;
        flex: 0 0 58px;
    }

    #modalSoapRalan.erm-rail-collapsed .erm-rail-header {
        justify-content: center;
        padding: 10px 6px 8px 6px;
    }

    #modalSoapRalan.erm-rail-collapsed .erm-rail-title,
    #modalSoapRalan.erm-rail-collapsed .erm-rail-group-label,
    #modalSoapRalan.erm-rail-collapsed #tab-soap-rajal .nav-link .erm-tab-label {
        display: none;
    }

    #modalSoapRalan.erm-rail-collapsed #tab-soap-rajal {
        padding: 8px 6px;
    }

    #modalSoapRalan.erm-rail-collapsed #tab-soap-rajal .nav-link {
        justify-content: center;
        padding: 9px 0;
        gap: 0;
    }

    #modalSoapRalan.erm-rail-collapsed #tab-soap-rajal .nav-link i {
        font-size: 16px;
    }

    /* Right Main Content Workspace (Independent Scroll) */
    #modalSoapRalan #tabContentPemeriksaan {
        flex: 1 1 auto;
        min-width: 0;
        overflow-y: auto;
        overflow-x: hidden;
        background-color: #f4f6f9;
    }

    #modalSoapRalan #tabContentPemeriksaan > .tab-pane {
        padding: 14px 16px;
    }

    /* Tablet & Mobile (< 992px): otomatis berubah menjadi Top Horizontal Scrollable Tab Bar */
    @media (max-width: 991.98px) {
        #modalSoapRalan .modal-body {
            flex-direction: column;
            overflow-y: auto;
        }

        #modalSoapRalan .erm-tab-bar-wrap,
        #modalSoapRalan.erm-rail-collapsed .erm-tab-bar-wrap {
            width: 100%;
            flex: 0 0 auto;
            position: sticky;
            top: 0;
            border-right: 0;
            border-bottom: 1px solid #e2e8f0;
            box-shadow: 0 2px 6px rgba(15, 23, 42, 0.04);
        }

        #modalSoapRalan .erm-rail-header,
        #modalSoapRalan .erm-rail-group-label {
            display: none !important;
        }

        #modalSoapRalan #tab-soap-rajal,
        #modalSoapRalan.erm-rail-collapsed #tab-soap-rajal {
            flex-direction: row;
            overflow-x: auto;
            overflow-y: hidden;
            padding: 6px 10px;
            gap: 4px;
        }

        #modalSoapRalan #tab-soap-rajal > .nav-item {
            width: auto;
        }

        #modalSoapRalan #tab-soap-rajal .nav-link,
        #modalSoapRalan.erm-rail-collapsed #tab-soap-rajal .nav-link {
            width: auto;
            justify-content: flex-start;
            padding: 6px 11px;
            gap: 6px;
        }

        #modalSoapRalan.erm-rail-collapsed #tab-soap-rajal .nav-link .erm-tab-label {
            display: inline !important;
        }

        #modalSoapRalan #tabContentPemeriksaan {
            overflow-y: visible;
        }
    }

    #modalSoapRalan textarea.form-control {
        resize: vertical;
    }

    /* Section Cards inside SOAP */
    #modalSoapRalan .erm-section-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 12px 14px;
        margin-bottom: 12px;
        box-shadow: 0 1px 2px rgba(15, 23, 42, 0.03);
    }

    #modalSoapRalan .erm-section-title {
        font-size: 12px;
        font-weight: 700;
        color: #1e293b;
        display: flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 10px;
        padding-bottom: 6px;
        border-bottom: 1px dashed #e2e8f0;
    }

    #modalSoapRalan .erm-section-title i {
        color: #2563eb;
        font-size: 14px;
    }

    #modalSoapRalan .erm-modal-footer {
        background: #ffffff;
        border-top: 1px solid #e2e8f0;
        padding: 10px 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 8px;
    }

    #modalSoapRalan .erm-detail-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        display: inline-block;
        background-color: #94a3b8;
        transition: background-color 0.2s ease, box-shadow 0.2s ease;
    }

    #modalSoapRalan #btnToggleDetailPasienHdr.is-open {
        background-color: #2563eb !important;
        border-color: #2563eb !important;
        color: #ffffff !important;
        box-shadow: 0 2px 8px rgba(37, 99, 235, 0.28);
    }

    #modalSoapRalan #btnToggleDetailPasienHdr.is-open .erm-detail-dot {
        background-color: #4ade80;
        box-shadow: 0 0 0 3px rgba(74, 222, 128, 0.35);
    }

    #modalSoapRalan .erm-bpjs-check-pill {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 2px 9px;
        border-radius: 999px;
        font-size: 10.5px;
        font-weight: 600;
        border: 1px solid #93c5fd;
        background: #eff6ff;
        color: #1d4ed8;
        cursor: pointer;
        transition: all 0.15s ease;
        white-space: nowrap;
    }

    #modalSoapRalan .erm-bpjs-check-pill:hover {
        background: #dbeafe;
        border-color: #3b82f6;
    }

    @media (max-width: 767.98px) {
        #modalSoapRalan .erm-modal-header {
            padding: 8px 12px;
        }
        #modalSoapRalan .erm-patient-avatar {
            display: none;
        }
        #modalSoapRalan .erm-patient-name {
            font-size: 13px;
        }
        #modalSoapRalan .erm-header-actions {
            width: 100%;
            justify-content: flex-start;
        }
        #modalSoapRalan .erm-header-actions .btn {
            flex: 1 1 auto;
            font-size: 11px !important;
            padding: 5px 8px;
        }
        #modalSoapRalan .erm-tab-bar-wrap {
            padding: 6px 10px 0 10px;
        }
        #modalSoapRalan #tabContentPemeriksaan > .tab-pane {
            padding: 10px;
        }
        #modalSoapRalan .erm-section-card {
            padding: 10px 12px;
        }
        #modalSoapRalan .erm-modal-footer {
            padding: 8px 12px;
        }
        #modalSoapRalan .erm-footer-hint {
            display: none !important;
        }
        #modalSoapRalan .erm-footer-buttons {
            width: 100%;
            display: flex;
            gap: 8px;
        }
        #modalSoapRalan .erm-footer-buttons .btn {
            flex: 1 1 auto;
            min-height: 36px;
        }
    }
</style>

<div class="modal fade" id="modalSoapRalan" data-bs-focus="false" data-erm-loader="true" data-erm-lock-buttons=".btnAction" data-erm-loading-text="Memuat data pemeriksaan..." tabindex="-1" aria-labelledby="modalSoapRalanTitle" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header erm-modal-header">
                <div class="erm-patient-strip">
                    <div class="erm-patient-avatar">
                        <i class="bi bi-person-vcard"></i>
                    </div>
                    <div class="min-w-0">
                        <div class="d-flex align-items-center flex-wrap gap-2">
                            <span class="erm-patient-name text-truncate" id="ermHdrNmPasien">PEMERIKSAAN &amp; RESEP</span>
                            <span class="badge rounded-pill text-bg-secondary d-none" id="ermHdrPenjab" role="button" onclick="cekStatusBpjsDariHeader()" title="Klik untuk cek status kepesertaan BPJS Kesehatan" style="font-size: 10.5px; cursor: pointer;"></span>
                            <button type="button" class="erm-bpjs-check-pill d-none" id="btnErmCekBpjs" onclick="cekStatusBpjsDariHeader()" title="Cek status kepesertaan BPJS Kesehatan (via No. Kartu / NIK)">
                                <i class="bi bi-shield-check" id="ermCekBpjsIcon"></i>
                                <span id="ermCekBpjsText">Cek Status BPJS</span>
                            </button>
                            <span class="badge rounded-pill d-none" id="ermHdrBpjsStatusBadge" role="button" onclick="cekStatusBpjsDariHeader()" title="Klik untuk refresh / lihat detail kepesertaan BPJS" style="font-size: 10.5px; cursor: pointer;"></span>
                            <span class="badge rounded-pill text-bg-danger d-none" id="ermHdrAlergiBadge" style="font-size: 10.5px;">
                                <i class="bi bi-exclamation-triangle-fill me-1"></i>Alergi: <span id="ermHdrAlergiText"></span>
                            </span>
                        </div>
                        <div class="erm-patient-meta">
                            <span class="erm-meta-chip d-none" id="ermHdrNoRmWrap"><i class="bi bi-folder2-open text-primary"></i>RM: <span id="ermHdrNoRm">-</span></span>
                            <span class="erm-meta-chip d-none" id="ermHdrNoRawatWrap"><i class="bi bi-hash text-secondary"></i><span id="ermHdrNoRawat">-</span></span>
                            <span class="erm-meta-chip d-none" id="ermHdrUmurWrap"><i class="bi bi-cake2 text-info"></i><span id="ermHdrUmur">-</span></span>
                            <span class="erm-meta-chip d-none" id="ermHdrPjawabWrap"><i class="bi bi-people-fill text-warning"></i>PJ: <span id="ermHdrPjawab">-</span></span>
                            <span class="erm-meta-chip d-none" id="ermHdrDokterWrap"><i class="bi bi-person-badge text-success"></i><span id="ermHdrDokter">-</span></span>
                        </div>
                    </div>
                </div>
                <div class="erm-header-actions">
                    <button type="button" id="btnToggleDetailPasienHdr" class="btn btn-sm btn-outline-secondary d-inline-flex align-items-center justify-content-center gap-1" onclick="toggleDetailPasienSoap()" aria-expanded="false" aria-controls="collapseSoapIdentitas" title="Tampilkan / sembunyikan detail lengkap identitas pasien">
                        <span class="erm-detail-dot" id="ermDetailStatusDot"></span>
                        <i class="bi bi-person-lines-fill"></i>
                        <span id="ermDetailStatusText">Detail Pasien</span>
                        <i class="bi bi-chevron-down ms-1" id="ermDetailChevron" style="font-size: 10px;"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-primary fw-semibold d-inline-flex align-items-center justify-content-center gap-1" onclick="toggleSideRiwayatSoap()" title="Buka / Tutup Riwayat Kunjungan Pasien (Alt + R / F2)">
                        <i class="bi bi-clock-history"></i>
                        <span>Riwayat</span>
                        <span class="badge bg-primary-subtle text-primary border border-primary-subtle d-none d-md-inline py-0 px-1" style="font-size: 9.5px;">Alt+R</span>
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-success fw-semibold d-inline-flex align-items-center justify-content-center gap-1" onclick="openSatuSehatRme()" style="border-color: #00877a; color: #007a6c;" title="Akses Rekam Medis Nasional SATUSEHAT (SSRME)">
                        <i class="bi bi-shield-check" style="color: #00877a;"></i>
                        <span>SATUSEHAT</span>
                    </button>
                    <button type="button" class="btn-close ms-1" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body">
                <div class="erm-tab-bar-wrap">
                    <div class="erm-rail-header">
                        <span class="erm-rail-title"><i class="bi bi-grid-1x2 me-1 text-primary"></i>Menu Periksa</span>
                        <button type="button" class="erm-rail-toggle-btn" id="btnToggleErmRail" onclick="toggleErmSoapRail()" title="Perkecil / Perlebar Menu Samping">
                            <i class="bi bi-layout-sidebar-inset" id="iconToggleErmRail"></i>
                        </button>
                    </div>
                    <ul class="nav nav-tabs nav-tabs-expand" id="tab-soap-rajal" role="tablist">
                        <li class="erm-rail-group-label">Klinis Utama</li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="tab-soap" data-bs-toggle="tab"
                                data-bs-target="#tab-soap-pane" type="button" role="tab" aria-controls="tab-soap-pane"
                                aria-selected="true" title="SOAP & Resep"><i class="bi bi-clipboard2-pulse"></i><span class="erm-tab-label">SOAP &amp; Resep</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation" id="li-riwayat-pemeriksaan">
                            <button class="nav-link" id="tab-riwayat-pemeriksaan" data-bs-toggle="tab"
                                data-bs-target="#tab-riwayat-pane" type="button" role="tab"
                                aria-controls="tab-riwayat-pemeriksaan" aria-selected="false" title="Riwayat Pemeriksaan">
                                <i class="bi bi-clock-history"></i><span class="erm-tab-label">Riwayat Pemeriksaan</span>
                            </button>
                        </li>

                        <li class="erm-rail-group-label">Asesmen</li>
                        <li class="nav-item" role="presentation" id="li-askep-obg">
                            <button class="nav-link" id="tabAskepObgyn" data-bs-toggle="tab"
                                data-bs-target="#contentAskepObgyn" type="button" role="tab" aria-controls="tabAskepObgyn"
                                aria-selected="false" title="Askep Awal Kebidanan"><i class="bi bi-heart-pulse"></i><span class="erm-tab-label">Askep Awal Kebidanan</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation" id="li-askep-anak">
                            <button class="nav-link" id="tabAskepAnak" data-bs-toggle="tab"
                                data-bs-target="#contentAskepAnak" type="button" role="tab" aria-controls="tabAskepAnak"
                                aria-selected="false" title="Askep Awal Anak"><i class="bi bi-emoji-smile"></i><span class="erm-tab-label">Askep Awal Anak</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation" id="li-asmed-obg">
                            <button class="nav-link" id="tab-asesmen-obg" data-bs-toggle="tab"
                                data-bs-target="#tab-asmed-obg" type="button" role="tab" aria-controls="tab-asmed-obg"
                                aria-selected="false" title="Asmed Rajal Obgyn"><i class="bi bi-file-medical"></i><span class="erm-tab-label">Asmed Rajal Obgyn</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation" id="li-asmed-ana">
                            <button class="nav-link" id="tab-asesmen-anak" data-bs-toggle="tab"
                                data-bs-target="#tab-asmed-ana" type="button" role="tab" aria-controls="tab-asmed-ana"
                                aria-selected="false" title="Asmed Rajal Anak"><i class="bi bi-file-medical"></i><span class="erm-tab-label">Asmed Rajal Anak</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation" id="li-asmed-ranap-obg">
                            <button class="nav-link" id="tab-asesmen-ranap-obg" data-bs-toggle="tab"
                                data-bs-target="#tab-asmed-ranap-obg" type="button" role="tab"
                                aria-controls="tab-asmed-ranap-obg" aria-selected="false" title="Asmed Ranap Obgyn">
                                <i class="bi bi-hospital"></i><span class="erm-tab-label">Asmed Ranap Obgyn</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation" id="li-asmed-ranap-ana">
                            <button class="nav-link" id="tab-asesmen-ranap-anak" data-bs-toggle="tab"
                                data-bs-target="#tab-asmed-ranap-ana" type="button" role="tab"
                                aria-controls="tab-asmed-ranap-ana" aria-selected="false" title="Asmed Ranap Anak">
                                <i class="bi bi-hospital"></i><span class="erm-tab-label">Asmed Ranap Anak</span>
                            </button>
                        </li>

                        <li class="erm-rail-group-label">Tindakan &amp; Penunjang</li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tabTindakan" data-bs-toggle="tab"
                                data-bs-target="#tabTindakan-pane" type="button" role="tab" aria-controls="tabTindakan-pane"
                                aria-selected="false" title="Tindakan"><i class="bi bi-bandaid"></i><span class="erm-tab-label">Tindakan</span>
                            </button>
                        </li>

                        <li class="nav-item" role="presentation" id="li-lab-ana">
                            <button class="nav-link" id="tab-lab" data-bs-toggle="tab" data-bs-target="#lab-ana"
                                type="button" role="tab" aria-controls="lab-ana" aria-selected="false" title="Laboratorium">
                                <i class="bi bi-eyedropper"></i><span class="erm-tab-label">Laboratorium</span>
                            </button>
                        </li>

                        <li class="nav-item" role="presentation" id="li-rad-ana">
                            <button class="nav-link" id="tab-rad" data-bs-toggle="tab" data-bs-target="#rad-ana"
                                type="button" role="tab" aria-controls="rad-ana" aria-selected="false" title="Radiologi"><i class="bi bi-radioactive"></i><span class="erm-tab-label">Radiologi</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="skriningTB" data-bs-toggle="tab" data-bs-target="#skriningTB-pane"
                                type="button" role="tab" aria-controls="skriningTB-pane" aria-selected="false" title="Skrining/Skoring TB">
                                <i class="bi bi-lungs"></i><span class="erm-tab-label">Skrining/Skoring TB</span>
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="tab-content" id="tabContentPemeriksaan">
                    <div class="tab-pane fade show active" id="tab-soap-pane" role="tabpanel"
                        aria-labelledby="tab-soap" tabindex="0">
                        @include('content.poliklinik.modal.pemeriksaan.soap')
                    </div>
                    <div class="tab-pane fade" id="tab-riwayat-pane" role="tabpanel"
                        aria-labelledby="tab-riwayat-pemeriksaan" tabindex="0">
                        @include('content.poliklinik.modal.pemeriksaan.riwayat_pemeriksaan')
                    </div>
                    <div class="tab-pane fade" id="tab-asmed-obg" role="tabpanel" aria-labelledby="tab-asesmen-obg"
                        tabindex="0">
                        @include('content.poliklinik.modal.pemeriksaan.asmed_kandungan')
                    </div>
                    <div class="tab-pane fade" id="contentAskepObgyn" role="tabpanel"
                        aria-labelledby="tabAskepObgyn" tabindex="0">
                        @include('content.poliklinik.modal.form.askep_awal_kebidanan')
                    </div>
                    <div class="tab-pane fade" id="contentAskepAnak" role="tabpanel" aria-labelledby="tabAskepAnak"
                        tabindex="0">
                        @include('content.poliklinik.modal.form.askep_awal_anak')
                    </div>
                    <div class="tab-pane fade" id="tab-asmed-ana" role="tabpanel" aria-labelledby="tab-asesmen-anak"
                        tabindex="0">
                        @include('content.poliklinik.modal.pemeriksaan.asmed_anak')
                    </div>
                    <div class="tab-pane fade" id="tab-asmed-ranap-obg" role="tabpanel"
                        aria-labelledby="tab-asesmen-ranap-obg" tabindex="0">
                        @include('content.ranap.form.form_asmed_kandungan')
                    </div>
                    <div class="tab-pane fade" id="tab-asmed-ranap-ana" role="tabpanel"
                        aria-labelledby="tab-asesmen-ranap-anak" tabindex="0">
                        @include('content.ranap.form.form_asemd_anak')
                    </div>

                    <div class="tab-pane fade" id="tabTindakan-pane" role="tabpanel"
                        aria-labelledby="tabTindakan" tabindex="0">
                        @include('content.poliklinik.modal.tab-tindakan')

                    </div>
                    <div class="tab-pane fade" id="asesmenNyeriAnak-pane" role="tabpanel"
                        aria-labelledby="tabTindakan" tabindex="0">
                        @include('content.ranap.form.form_nyeri_anak')
                    </div>
                    <div class="tab-pane fade" id="lab-ana" role="tabpanel" aria-labelledby="tab-lab" tabindex="0">
                        <div class="row g-3">
                            <div class="col-12 col-lg-6">
                                <div class="erm-section-card h-100 mb-0">
                                    @include('content.ranap.modal.penunjang.permintaan_lab')
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="erm-section-card h-100 mb-0">
                                    @include('content.ranap.modal.penunjang.hasil_lab')
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="rad-ana" role="tabpanel" aria-labelledby="tab-rad"
                        tabindex="0">
                        <div class="row g-3">
                            <div class="col-12 col-lg-6">
                                <div class="erm-section-card h-100 mb-0">
                                    @include('content.ranap.modal.penunjang.permintaan_radiologi')
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="erm-section-card h-100 mb-0">
                                    @include('content.ranap.modal.penunjang.hasil_radiologi')
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="skriningTB-pane" role="tabpanel" aria-labelledby="skriningTB"
                        tabindex="0">
                        <div class="erm-section-card">
                            <form action="" id="formPasienSkoringTb">
                                <div class="row g-2">
                                    <div class="col-6 col-md-4 col-lg-2">
                                        <label for="skoring_tb_no_rawat" class="form-label mb-1">No. Rawat</label>
                                        <input type="text" class="form-control form-control-sm br-full" id="skoring_tb_no_rawat" name="no_rawat"
                                            readonly>
                                    </div>
                                    <div class="col-12 col-md-8 col-lg-4">
                                        <label for="skoring_tb_nm_pasien" class="form-label mb-1">Pasien</label>
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control" id="skoring_tb_no_rkm_medis" name="no_rkm_medis"
                                                readonly>
                                            <input type="text" class="form-control w-50" id="skoring_tb_nm_pasien" name="nm_pasien"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4 col-lg-2">
                                        <label for="skoring_tb_tgl_lahir" class="form-label mb-1">Tgl. Lahir/Umur</label>
                                        <input type="text" class="form-control form-control-sm" id="skoring_tb_tgl_lahir" name="tgl_lahir" readonly>
                                    </div>
                                    <div class="col-6 col-md-4 col-lg-2">
                                        <label for="skoring_tb_p_jawab" class="form-label mb-1">Keluarga</label>
                                        <input type="text" class="form-control form-control-sm br-full" id="skoring_tb_p_jawab" name="p_jawab"
                                            readonly>
                                    </div>
                                    <div class="col-6 col-md-4 col-lg-2">
                                        <label for="skoring_tb_nm_poli" class="form-label mb-1">Poliklinik</label>
                                        <input type="text" class="form-control form-control-sm br-full" id="skoring_tb_nm_poli" name="nm_poli"
                                            readonly>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <label for="skoring_tb_nm_dokter" class="form-label mb-1">DPJP</label>
                                        <div class="input-group input-group-sm">
                                            <input type="text" id="skoring_tb_kd_dokter" name="kd_dokter" class="form-control"
                                                readonly>
                                            <input type="text" class="form-control w-50" id="skoring_tb_nm_dokter" name="nm_dokter"
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <ul class="nav nav-tabs mt-2 flex-nowrap overflow-auto" id="tabsSkoringTb" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active text-nowrap" id="formSkoringTb-tab" data-bs-toggle="tab"
                                    data-bs-target="#tabSkoringTb" type="button" role="tab" aria-controls="tabSkoringTb"
                                    aria-selected="true">Form Skoring
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link text-nowrap" id="SkoringTb-tab" data-bs-toggle="tab"
                                    data-bs-target="#SkoringTb" type="button" role="tab" aria-controls="SkoringTb"
                                    aria-selected="false">Hasil Skoring
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link text-nowrap" id="formSkriningTb-tab" data-bs-toggle="tab"
                                    data-bs-target="#tabSkriningTb" type="button" role="tab"
                                    aria-controls="tabSkriningTb" aria-selected="false">Form Skrining
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link text-nowrap" id="skriningTb-tab" data-bs-toggle="tab"
                                    data-bs-target="#skriningTb" type="button" role="tab" aria-controls="skriningTb"
                                    aria-selected="false">Hasil Skrining
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content bg-white border border-top-0 rounded-bottom" id="tabPenilaianTB">
                            <div class="tab-pane fade show active p-3" id="tabSkoringTb" role="tabpanel"
                                aria-labelledby="formSkoringTb-tab">
                                <div style="background-color:whitesmoke;border-radius:10px;padding:10px">
                                    @include('content.ranap.modal.skriningTb._formSkoringTb')
                                </div>
                            </div>
                            <div class="tab-pane fade p-3 table-responsive" id="SkoringTb" role="tabpanel"
                                aria-labelledby="SkoringTb-tab">
                                <table class="table nowrap" id="tbSkoringTb" width="100%"></table>
                            </div>
                            <div class="tab-pane fade p-3" id="tabSkriningTb" role="tabpanel"
                                aria-labelledby="formSkriningTb-tab">
                                <div style="background-color:whitesmoke;border-radius:10px;padding:10px">
                                    @include('content.ranap.modal.skriningTb._formSkriningTb')
                                </div>
                            </div>
                            <div class="tab-pane fade p-3 table-responsive" id="skriningTb" role="tabpanel"
                                aria-labelledby="skriningTb-tab">
                                <table class="table nowrap" id="tbSkriningTb" width="100%"></table>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <div class="modal-footer erm-modal-footer">
                <div class="d-flex align-items-center flex-wrap gap-2 text-muted small erm-footer-hint">
                    <span class="d-inline-flex align-items-center gap-1">
                        <i class="bi bi-layers text-primary"></i>
                        <span>Tab Aktif: <strong class="text-dark" id="ermFooterTabLabel">SOAP &amp; Resep</strong></span>
                    </span>
                    <span class="text-muted opacity-50">|</span>
                    <span data-erm-loader-status class="erm-loader-pill is-idle" title="Status pemuatan komponen & request AJAX">
                        <i class="bi bi-check2-circle"></i><span>Siap</span>
                    </span>
                </div>
                <div class="erm-footer-buttons d-flex align-items-center gap-2">
                    <button type="button" class="btn btn-outline-danger btn-sm px-3" data-bs-dismiss="modal"><i
                            class="bi bi-x-circle me-1"></i> Keluar
                    </button>
                    <button type="button" class="btn btn-success btn-sm px-3 btn-soap btnAction" onclick="simpanSoapRalan()"><i
                            class="bi bi-save me-1"></i> Simpan SOAP
                    </button>
                    <button type="button" class="btn btn-success btn-sm px-3 btn-asmed d-none btnAction" name="simpan"><i
                            class="bi bi-save me-1"></i>
                        Simpan Asmed Rajal
                    </button>
                    <button type="button" class="btn btn-success btn-sm px-3 btn-askep d-none btnAction" name="createAskepRalan"
                        id="createAskepRalan"><i class="bi bi-save me-1"></i>
                        Simpan Asesmen
                    </button>
                    <button type="button" class="btn btn-success btn-sm px-3 btn-asmed-ranap d-none btnAction" name="simpan"><i
                            class="bi bi-save me-1"></i> Simpan Asmed Ranap
                    </button>
                    <button type="button" class="btn btn-success btn-sm px-3 d-none btnAction" name="btnCreateAsesmenNyeri"
                        id="btnCreateAsesmenNyeri"><i class="bi bi-save me-1"></i> Simpan Asesmen Nyeri
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@include('content.poliklinik.modal.modal_resep')


@push('script')
    <script>
        const btnTabAsmedAnak = $('button[data-bs-target="#tab-asmed-ana"]');
        const btnTabAsmedRanapAnak = $('button[data-bs-target="#tab-asmed-ranap-ana"]');

        const btnTabAsmedObgyn = $('button[data-bs-target="#tab-asmed-obg"]');
        const btnTabAsmedRanapObgyn = $('button[data-bs-target="#tab-asmed-ranap-obg"]');

        const formAsmedAnak = $('#formAsmedAnak');
        const formAsmedRanapAnak = $('#formAsmedRanapAnak');

        const formAsmedRajalKandungan = $('#formAsmedRajalKandungan');
        const formAsmedRanapKandungan = $('#formAsmedRanapKandungan');

        const btnTabPermintaanLab = $('button[data-bs-target="#permintaan-laborat-tab-pane"]');

        const btnsSkriningTB = $('button[data-bs-target="#skriningTB-pane"]');

        const btnAsesmenNyeriAnak = $('button[data-bs-target="#asesmenNyeriAnak-pane"]')

        const btnTabLaboratorium = $('button[data-bs-target="#lab-ana"]');
        const btnTabRadiologi = $('button[data-bs-target="#rad-ana"]');
        const btnTabAskepObgyn = $('button[data-bs-target="#contentAskepObgyn"]')
        const btnTabAskepAnak = $('button[data-bs-target="#contentAskepAnak"]')
        function updateActionButtons(selectorToShow) {
            $('.btnAction').addClass('d-none');
            if (selectorToShow) {
                $(selectorToShow).removeClass('d-none');
            }
        }

        // Data ringkas kepesertaan pasien di memori (tanpa menambah input DOM agar 0 konflik ID)
        window._ermHdrPasienBpjs = {
            no_peserta: '',
            no_ktp: '',
            tgl_registrasi: '',
            is_umum: false,
            png_jawab: '',
        };

        // Sinkronisasi tampilan ringkasan pasien pada sticky header (read-only spans, tidak bentrok dengan input form)
        function syncModalSoapHeader(response) {
            if (!response) return;
            const pasien = response.pasien || {};
            const nmPasien = pasien.nm_pasien ? `${pasien.nm_pasien}${pasien.jk ? ' (' + pasien.jk + ')' : ''}` : 'PEMERIKSAAN & RESEP';
            $('#ermHdrNmPasien').text(nmPasien);

            if (response.no_rkm_medis) {
                $('#ermHdrNoRm').text(response.no_rkm_medis);
                $('#ermHdrNoRmWrap').removeClass('d-none');
            }
            if (response.no_rawat) {
                $('#ermHdrNoRawat').text(response.no_rawat);
                $('#ermHdrNoRawatWrap').removeClass('d-none');
            }
            if (pasien.tgl_lahir) {
                const objUmur = hitungUmurDaftar(pasien.tgl_lahir, response.tgl_registrasi);
                $('#ermHdrUmur').text(`${objUmur.tahun} Th ${objUmur.bulan} Bln ${objUmur.hari} Hr`);
                $('#ermHdrUmurWrap').removeClass('d-none');
            }

            // Nama Penanggung Jawab / Keluarga
            const pJawab = (response.p_jawab || pasien.namakeluarga || '').toString().trim();
            const hubPj = (response.hubunganpj || pasien.keluarga || '').toString().trim();
            if (pJawab && pJawab !== '-') {
                const labelPj = (hubPj && hubPj !== '-') ? `${pJawab} (${hubPj})` : pJawab;
                $('#ermHdrPjawab').text(labelPj);
                $('#ermHdrPjawabWrap').removeClass('d-none');
            } else {
                $('#ermHdrPjawabWrap').addClass('d-none');
            }

            if (response.dokter && response.dokter.nm_dokter) {
                $('#ermHdrDokter').text(response.dokter.nm_dokter);
                $('#ermHdrDokterWrap').removeClass('d-none');
            }

            const pngJawab = (response.penjab && response.penjab.png_jawab) ? response.penjab.png_jawab : '';
            const isBpjs = pngJawab.toUpperCase().includes('BPJS');
            if (pngJawab) {
                $('#ermHdrPenjab')
                    .text(pngJawab)
                    .removeClass('d-none text-bg-secondary text-bg-success text-bg-danger')
                    .addClass(isBpjs ? 'text-bg-success' : 'text-bg-danger');
            }

            // Simpan info untuk tombol Cek Status BPJS (mendukung pasien BPJS maupun UMUM via No. Kartu / NIK)
            window._ermHdrPasienBpjs = {
                no_peserta: (pasien.no_peserta || '').toString().trim(),
                no_ktp: (pasien.no_ktp || '').toString().trim(),
                tgl_registrasi: response.tgl_registrasi || "{{ date('Y-m-d') }}",
                is_umum: !isBpjs,
                png_jawab: pngJawab,
            };

            // Reset badge hasil cek BPJS tiap ganti pasien & tampilkan tombol Cek Status BPJS
            $('#ermHdrBpjsStatusBadge').addClass('d-none').text('');
            $('#btnErmCekBpjs').removeClass('d-none').prop('disabled', false);
            $('#ermCekBpjsIcon').attr('class', 'bi bi-shield-check');
            $('#ermCekBpjsText').text(isBpjs ? 'Cek Status BPJS' : 'Cek Kepesertaan BPJS');
        }

        function setDetailPasienButtonState(isOpen) {
            const btn = $('#btnToggleDetailPasienHdr');
            btn.attr('aria-expanded', isOpen ? 'true' : 'false');
            if (isOpen) {
                btn.addClass('is-open');
                $('#ermDetailStatusText').text('Detail: Tampil');
                $('#ermDetailChevron').removeClass('bi-chevron-down').addClass('bi-chevron-up');
            } else {
                btn.removeClass('is-open');
                $('#ermDetailStatusText').text('Detail Pasien');
                $('#ermDetailChevron').removeClass('bi-chevron-up').addClass('bi-chevron-down');
            }
        }

        function toggleDetailPasienSoap() {
            const collapseEl = document.getElementById('collapseSoapIdentitas');
            if (!collapseEl) return;

            const isSoapTabActive = $('#tab-soap-pane').hasClass('active');
            const bsCollapse = bootstrap.Collapse.getOrCreateInstance(collapseEl, { toggle: false });

            if (!isSoapTabActive) {
                // Jika user klik Detail Pasien saat berada di tab lain, pindah dulu ke tab SOAP lalu buka detail
                $('button[data-bs-target="#tab-soap-pane"]').tab('show');
                bsCollapse.show();
                $('#tabContentPemeriksaan').animate({ scrollTop: 0 }, 200);
                $('#modalSoapRalan .modal-body').animate({ scrollTop: 0 }, 200);
                return;
            }

            bsCollapse.toggle();
        }

        function applyErmSoapRailState(collapsed) {
            const modal = $('#modalSoapRalan');
            const icon = $('#iconToggleErmRail');
            if (collapsed) {
                modal.addClass('erm-rail-collapsed');
                icon.removeClass('bi-layout-sidebar-inset').addClass('bi-layout-sidebar');
                $('#btnToggleErmRail').attr('title', 'Perlebar Menu Samping');
            } else {
                modal.removeClass('erm-rail-collapsed');
                icon.removeClass('bi-layout-sidebar').addClass('bi-layout-sidebar-inset');
                $('#btnToggleErmRail').attr('title', 'Perkecil Menu Samping (Mode Ikon)');
            }
        }

        function toggleErmSoapRail() {
            const nextCollapsed = !$('#modalSoapRalan').hasClass('erm-rail-collapsed');
            applyErmSoapRailState(nextCollapsed);
            try {
                localStorage.setItem('erm_soap_rail_collapsed', nextCollapsed ? '1' : '0');
            } catch (err) {}
        }

        // Pulihkan preferensi sidebar kiri saat modal dibuka
        $(document).ready(function () {
            try {
                applyErmSoapRailState(localStorage.getItem('erm_soap_rail_collapsed') === '1');
            } catch (err) {}
        });

        function renderModalPesertaBpjsData(p) {
            if (!p) return;
            const jkel = p.sex == 'L' ? 'LAKI-LAKI' : 'PEREMPUAN';
            const isAktif = String(p.statusPeserta?.kode) === '0';
            $('.statusPeserta').css('color', isAktif ? 'green' : 'red');
            $('.namaPeserta').text(`${p.nama || '-'} ( ${jkel} )`);
            $('.nikPeserta').text(p.nik || '-');
            $('.tglLahirPeserta').text(p.tglLahir ? formatTanggal(p.tglLahir) : '-');
            $('.nokaPeserta').text(p.noKartu || '-');
            $('.statusPeserta').text(p.statusPeserta?.keterangan || '-');
            $('.pisaPeserta').text(p.pisa || '-');
            $('.teleponPeserta').text(p.mr?.noTelepon || '-');
            $('.kelasPeserta').text(p.hakKelas ? `${p.hakKelas.kode}. ${p.hakKelas.keterangan}` : '-');
            $('.jenisPeserta').text(p.jenisPeserta ? `${p.jenisPeserta.kode}. ${p.jenisPeserta.keterangan}` : '-');
            $('.fktpPeserta').text(p.provUmum ? `${p.provUmum.kdProvider}. ${p.provUmum.nmProvider}` : '-');
            $('.tglKartuPeserta').text(p.tglCetakKartu ? formatTanggal(p.tglCetakKartu) : '-');
            $('.tglTMTpeserta').text(p.tglTMT ? formatTanggal(p.tglTMT) : '-');
            $('.tglTATpeserta').text(p.tglTAT ? formatTanggal(p.tglTAT) : '-');
            $('.umurSekarangPeserta').text(p.umur?.umurSekarang || '-');
            $('.umurPelayananPeserta').text(p.umur?.umurSaatPelayanan || '-');
        }

        function cekStatusBpjsDariHeader() {
            const info = window._ermHdrPasienBpjs || {};
            const noka = (info.no_peserta || '').replace(/\D/g, '');
            const nik = (info.no_ktp || '').replace(/\D/g, '');
            const tanggal = "{{ date('Y-m-d') }}";

            if (noka.length < 10 && nik.length < 15) {
                Swal.fire({
                    icon: 'info',
                    title: 'Data Kartu / NIK Tidak Tersedia',
                    text: 'Pasien tidak memiliki No. Kartu BPJS maupun NIK (16 digit) yang valid di data master pasien.',
                });
                return;
            }

            const btn = $('#btnErmCekBpjs');
            btn.prop('disabled', true);
            $('#ermCekBpjsIcon').attr('class', 'spinner-border spinner-border-sm');
            $('#ermCekBpjsText').text('Mengecek BPJS...');

            const finishLoading = () => {
                btn.prop('disabled', false);
                $('#ermCekBpjsIcon').attr('class', 'bi bi-shield-check');
                $('#ermCekBpjsText').text(info.is_umum ? 'Cek Ulang BPJS' : 'Cek Status BPJS');
            };

            const handleBpjsResult = (res, sourceLabel) => {
                const p = res?.response?.peserta || (res?.response && typeof res.response === 'object' ? Object.values(res.response)[0] : null);
                if (res?.metaData?.code == 200 && p) {
                    const isAktif = String(p.statusPeserta?.kode) === '0';
                    const statusKet = p.statusPeserta?.keterangan || (isAktif ? 'AKTIF' : 'NON AKTIF');
                    const kelas = p.hakKelas?.keterangan ? ` (${p.hakKelas.keterangan})` : '';

                    const badge = $('#ermHdrBpjsStatusBadge');
                    badge.removeClass('d-none text-bg-success text-bg-warning text-bg-danger text-bg-secondary');

                    if (isAktif) {
                        badge.addClass('text-bg-success');
                        if (info.is_umum) {
                            badge.html(`<i class="bi bi-check-circle-fill me-1"></i>BPJS: ${statusKet}${kelas} &bull; Bisa Disarankan Pakai BPJS`);
                            swalToast(`Pasien terdaftar UMUM, namun kepesertaan BPJS Kesehatan AKTIF${kelas} (dicek via ${sourceLabel}).`, 'info');
                        } else {
                            badge.html(`<i class="bi bi-check-circle-fill me-1"></i>BPJS: ${statusKet}${kelas}`);
                        }
                    } else {
                        badge.addClass('text-bg-warning text-dark');
                        badge.html(`<i class="bi bi-exclamation-circle-fill me-1"></i>BPJS: ${statusKet}`);
                    }

                    renderModalPesertaBpjsData(p);
                    $('#modalPesertaBpjs').modal('show');
                    return true;
                }
                return false;
            };

            const checkByNik = () => {
                if (nik.length < 15) {
                    finishLoading();
                    $('#ermHdrBpjsStatusBadge')
                        .removeClass('d-none text-bg-success text-bg-warning text-bg-danger')
                        .addClass('text-bg-secondary')
                        .html('<i class="bi bi-dash-circle me-1"></i>BPJS: Tidak Terdaftar');
                    Swal.fire({
                        icon: 'info',
                        title: 'Peserta Tidak Ditemukan',
                        text: 'Pasien tidak terdaftar sebagai peserta BPJS Kesehatan berdasarkan No. Kartu.',
                    });
                    return;
                }

                $.ajax({
                    url: `/erm/bridging/peserta/nik/${nik}/${tanggal}`,
                    dataType: 'JSON',
                    method: 'GET',
                }).done((res) => {
                    finishLoading();
                    if (!handleBpjsResult(res, 'NIK')) {
                        $('#ermHdrBpjsStatusBadge')
                            .removeClass('d-none text-bg-success text-bg-warning text-bg-danger')
                            .addClass('text-bg-secondary')
                            .html('<i class="bi bi-dash-circle me-1"></i>BPJS: Tidak Terdaftar');
                        Swal.fire({
                            icon: 'info',
                            title: 'Tidak Ditemukan di BPJS',
                            text: res?.metaData?.message || 'Pasien tidak terdaftar sebagai peserta BPJS Kesehatan (via NIK).',
                        });
                    }
                }).fail((request) => {
                    finishLoading();
                    alertSessionExpired(request.status);
                    Swal.fire('Gagal', 'Tidak dapat terhubung ke layanan BPJS VClaim saat ini.', 'error');
                });
            };

            if (noka.length >= 10) {
                $.ajax({
                    url: `/erm/bridging/peserta/noka/${noka}/${tanggal}`,
                    dataType: 'JSON',
                    method: 'GET',
                }).done((res) => {
                    if (handleBpjsResult(res, 'No. Kartu')) {
                        finishLoading();
                    } else if (nik.length >= 15) {
                        // Fallback otomatis ke NIK jika nomor kartu di SIMRS kosong/salah
                        checkByNik();
                    } else {
                        finishLoading();
                        $('#ermHdrBpjsStatusBadge')
                            .removeClass('d-none text-bg-success text-bg-warning text-bg-danger')
                            .addClass('text-bg-secondary')
                            .html('<i class="bi bi-dash-circle me-1"></i>BPJS: Tidak Terdaftar');
                        Swal.fire({
                            icon: 'info',
                            title: 'Tidak Ditemukan di BPJS',
                            text: res?.metaData?.message || 'Pasien tidak terdaftar sebagai peserta BPJS Kesehatan.',
                        });
                    }
                }).fail((request) => {
                    if (request.status === 401) {
                        finishLoading();
                        alertSessionExpired(request.status);
                    } else if (nik.length >= 15) {
                        checkByNik();
                    } else {
                        finishLoading();
                        Swal.fire('Gagal', 'Tidak dapat terhubung ke layanan BPJS VClaim saat ini.', 'error');
                    }
                });
            } else {
                checkByNik();
            }
        }

        function syncModalSoapAlergi(alergiVal) {
            const val = (alergiVal || '').toString().trim();
            const lower = val.toLowerCase();
            if (val && val !== '-' && lower !== 'tidak ada' && lower !== 'tidak' && lower !== 'none') {
                $('#ermHdrAlergiText').text(val);
                $('#ermHdrAlergiBadge').removeClass('d-none');
            } else {
                $('#ermHdrAlergiText').text('');
                $('#ermHdrAlergiBadge').addClass('d-none');
            }
        }

        // Sinkronisasi indikator tombol Detail Pasien secara realtime saat panel dibuka/ditutup
        $(document).on('show.bs.collapse', '#collapseSoapIdentitas', function () {
            setDetailPasienButtonState(true);
        });
        $(document).on('hide.bs.collapse', '#collapseSoapIdentitas', function () {
            setDetailPasienButtonState(false);
        });

        $('#modalSoapRalan').on('show.bs.modal shown.bs.modal', function () {
            updateActionButtons('.btn-soap');
            $('#ermFooterTabLabel').text('SOAP & Resep');
            const isOpen = $('#collapseSoapIdentitas').hasClass('show');
            setDetailPasienButtonState(isOpen);
        });

        $('#modalSoapRalan').on('hidden.bs.modal', function () {
            const collapseEl = document.getElementById('collapseSoapIdentitas');
            if (collapseEl && collapseEl.classList.contains('show')) {
                bootstrap.Collapse.getOrCreateInstance(collapseEl, { toggle: false }).hide();
            }
            setDetailPasienButtonState(false);
            $('#ermHdrBpjsStatusBadge').addClass('d-none').text('');
            $('#ermHdrPjawabWrap').addClass('d-none');
        });

        // Auto-scroll active tab & update label konteks footer
        $('#tab-soap-rajal button[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
            const label = $(this).find('.erm-tab-label').text().trim() || $(this).text().trim();
            $('#ermFooterTabLabel').text(label);
            $('#tabContentPemeriksaan').scrollTop(0);
            if (typeof this.scrollIntoView === 'function') {
                this.scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' });
            }
        });

        $('button[data-bs-target="#tab-soap-pane"]').on('shown.bs.tab', function (e, x, y) {
            updateActionButtons('.btn-soap');
        });
        $('button[data-bs-target="#tab-riwayat-pane"]').on('shown.bs.tab', function () {
            updateActionButtons('');
        });
        $('button[data-bs-target="#tabTindakan-pane"]').on('shown.bs.tab', function () {
            updateActionButtons('');
        });
        $('button[data-bs-target="#rad-ana"]').on('shown.bs.tab', function () {
            updateActionButtons('');
        });

        btnTabAsmedAnak.on('shown.bs.tab', function (e, x, y) {
            const no_rawat = formSoapPoli.find('input[name="no_rawat"]').val();
            setSoapToAsmed(no_rawat, formAsmedAnak)
            updateActionButtons('.btn-asmed')

        })
        btnTabAsmedObgyn.on('shown.bs.tab', function (e, x, y) {
            const no_rawat = formSoapPoli.find('input[name="no_rawat"]').val();
            setSoapToAsmed(no_rawat, formAsmedRajalKandungan)
            updateActionButtons('.btn-asmed')

        })
        btnTabAsmedRanapAnak.on('shown.bs.tab', function (e, x, y) {
            const no_rawat = formSoapPoli.find('input[name="no_rawat"]').val();
            setSoapToAsmed(no_rawat, formAsmedRanapAnak)
            updateActionButtons('.btn-asmed-ranap')
        })

        btnTabAsmedRanapObgyn.on('shown.bs.tab', function (e, x, y) {
            const no_rawat = formSoapPoli.find('input[name="no_rawat"]').val();
            setSoapToAsmed(no_rawat, formAsmedRanapKandungan)
            updateActionButtons('.btn-asmed-ranap')
        });

        btnAsesmenNyeriAnak.on('shown.bs.tab', function () {
            const no_rawat = formSoapPoli.find('input[name="no_rawat"]').val();
            resetFormAsesmenNyeriAnak(no_rawat);
            renderAsesmenNyeriAnak(no_rawat)
            updateActionButtons('#btnCreateAsesmenNyeri')
            $('#btnCreateAsesmenNyeri').attr('onclick', 'createAsesmenNyeriAnak()')
        })
        btnAsesmenNyeriAnak.on('hidden.bs.tab', function () {
            $('#btnCreateAsesmenNyeri').removeAttr('onclick')
        })
        btnTabAskepObgyn.on('shown.bs.tab', function (e, x, y) {
            const no_rawat = formSoapPoli.find('input[name="no_rawat"]').val();
            const formAskepAwalObgyn = $('#formAskepAwalObgyn');

            updateActionButtons('#createAskepRalan')
            $('#createAskepRalan').removeAttr('onclick').attr('onclick', 'createAskepAwalObgyn()')
            setSoapToAsmed(no_rawat, formAskepAwalObgyn);
            getAskepAwalObgyn(no_rawat)

            $('.cacatFisik').addClass('d-none');
            $('.pengasuhAnak').addClass('d-none');
            $('.tinggalDengan').removeClass('d-none');
        });
        btnTabAskepAnak.on('shown.bs.tab', function (e, x, y) {
            const no_rawat = formSoapPoli.find('input[name="no_rawat"]').val();
            const formAskepAwalAnak = $('#formAskepAwalAnak');
            $('.cacatFisik').removeClass('d-none');
            $('.pengasuhAnak').removeClass('d-none');
            $('.tinggalDengan').addClass('d-none');
            updateActionButtons('#createAskepRalan')
            $('#createAskepRalan').removeAttr('onclick').attr('onclick', 'createAskepAwalAnak()')
            setSoapToAsmed(no_rawat, formAskepAwalAnak);
            getAskepAwalAnak(no_rawat)
        });

        btnsSkriningTB.on('shown.bs.tab', function (e, x, y) {
            const no_rawat = formSoapPoli.find('input[name="no_rawat"]').val();
            drawTbSkriningTb(no_rawat)
            drawTbSkoringTb(no_rawat)
            getRegPeriksa(no_rawat).done((response) => {
                const {
                    pasien,
                    dokter,
                    poliklinik
                } = response;
                formPasienSkoringTb.find('input[name=no_rawat]').val(no_rawat)
                formPasienSkoringTb.find('input[name=no_rkm_medis]').val(response.no_rkm_medis)
                formPasienSkoringTb.find('input[name=nm_pasien]').val(`${pasien.nm_pasien} (${pasien.jk})`)
                formPasienSkoringTb.find('input[name=tgl_lahir]').val(`${formatTanggal(pasien.tgl_lahir)} / ${hitungUmur(pasien.tgl_lahir)}`)
                formPasienSkoringTb.find('input[name=nm_poli]').val(poliklinik.nm_poli)
                formPasienSkoringTb.find('input[name=p_jawab]').val(`${response.p_jawab} (${response.hubunganpj})`)
                formPasienSkoringTb.find('input[name=nm_dokter]').val(dokter.nm_dokter)
                formPasienSkoringTb.find('input[name=kd_dokter]').val(response.kd_dokter)
            })

            updateActionButtons('')
        });

        btnTabLaboratorium.on('shown.bs.tab', function (e, x, y) {
            // $('#permintaan-laborat-tab').tab('show')
            tablePermintaanLab.find('tbody').empty();
            tablePermintaanLab.find('input[type=checkbox]').prop('checked', false)
            tableHasilPermintaan.addClass('d-none');
            getNomorPermintaan();
            let no_rawat = '';
            if (formSoapPoli.length) {
                no_rawat = formSoapPoli.find('#nomor_rawat').val();
                kd_dokter = formSoapPoli.find('#kd_dokter').val();
                nm_dokter = formSoapPoli.find('#kd_dokter').text()
                nm_pasien = formSoapPoli.find('#nama_pasien').val();
                const no_rkm_medis = formSoapPoli.find('#no_rkm_medis').val();
                setSelectPemeriksaanLab(no_rkm_medis)

                formPermintaanLab.find('#no_rawat').val(no_rawat)
                formPermintaanLab.find('#kd_dokter').val(kd_dokter)
                formPermintaanLab.find('#nm_dokter').val(nm_dokter)
                formPermintaanLab.find('#nm_pasien').val(nm_pasien)
                formPermintaanLab.find('#status').val('Ralan')
            } else {
                no_rawat = formPermintaanLab.find('#no_rawat').val()
            }
        })
        btnTabRadiologi.on('shown.bs.tab', function (e, x, y) {
            // $('#permintaan-radiologi-tab').tab('show')

            tablePermintaanRadiologi.find('tbody').empty();
            tableHasilPermintaan.addClass('d-none');
            getNoPermintaanRadiologi()
            let no_rawat = '';
            if (formSoapPoli.length) {
                no_rawat = formSoapPoli.find('#nomor_rawat').val();
                kd_dokter = formSoapPoli.find('#kd_dokter').val();
                formPermintaanRadiologi.find('#no_rawat').val(no_rawat)
                formPermintaanRadiologi.find('#kd_dokter').val(kd_dokter)
                formPermintaanRadiologi.find('#status').val('Ralan')
            } else {
                no_rawat = formPermintaanRadiologi.find('#no_rawat').val()
            }
        })



        function setRiwayatLaboratorium(no_rkm_medis) {
            const listRiwayatLaboratorium = $('#listRiwayatLaboratorium')
            $.get(`/erm/lab/riwayat/${no_rkm_medis}`).done((response) => {
                const {
                    data
                } = response;
                listRiwayatLaboratorium.empty()
                if (data.length === 0) {
                    return false;
                }

                const list = data.map((item, index) => {
                    return `<li class="list-group-item"  data-no-rawat="${item.no_rawat}" onclick="hasilLabRalan('${item.no_rawat}')">

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <div class="d-flex justify-content-between">

                                                                                                                                                                                                                                                        <span><i class="me-2 bi bi-circle-fill ${item.status === 'ralan' ? 'text-warning' : 'text-purple'}"></i> ${formatTanggal(item.tgl_permintaan)}</span>
                                                                                                                                                                                                                                                        <span>
                                                                                                                                                                                                                                                                ${item.diagnosa_klinis} ${item.informasi_tambahan}
                                                                                                                                                                                                                                                        </span>
                                                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                                                    </li>`
                }).join('')

                listRiwayatLaboratorium.on('click', 'li', function () {
                    listRiwayatLaboratorium.find('li').removeClass('active');
                    $(this).addClass('active');
                });

                listRiwayatLaboratorium.html(list)
            })

        }

        $('button[data-bs-target="#lab-ana"]').on('shown.bs.tab', function (e, x, y) {
            updateActionButtons('')
            const no_rawat = formSoapPoli.find('input[name="no_rawat"]').val();
            const no_rkm_medis = formSoapPoli.find('input[name="no_rkm_medis"]').val();

            setRiwayatLaboratorium(no_rkm_medis)
            $('#tbHasilLabRalan').find('tbody').empty()
            hasilLabRalan(no_rawat)

        })

        function hasilLabRalan(no_rawat) {
            getHasilLab(no_rawat).done((lab) => {
                let jenisPerawatan = '';
                let tglPeriksa = '';
                let hasil = '';
                $('#tbHasilLabRalan').find('tbody').empty()
                if (lab.length) {
                    let hasilLab = '';

                    lab.forEach((item, index) => {

                        if (item.detail.length) {
                            hasilLab += `<tr class="" >

                                                <td colspan="3" style="background-color:#ffc800;padding:2px">
                                                    <p class="ms-3 mb-0"><strong>${item.jns_perawatan_lab.nm_perawatan}</strong><br/>
                                                    ${formatTanggal(item.tgl_periksa)} ${item.jam}</p>
                                                </td>
                                                <td  style="background-color:#ffc800;padding:2px">${item.petugas.nama}</td></tr>`;
                            item.detail.sort((a, b) => a.template.urut - b.template.urut);
                            item.detail.forEach((detail, index) => {
                                hasilLab += `<tr class="${setWarnaPemeriksaan(detail.keterangan)}">
                        <td>${detail.template.Pemeriksaan}</td>
                        <td>${detail.nilai} ${detail.template.satuan}</td>
                        <td>${detail.nilai_rujukan} ${detail.template.satuan}</td>
                        <td>${detail.keterangan}</td></tr>`

                            })
                        }
                    })

                    $('#tbHasilLabRalan').find('tbody').html(hasilLab)
                }
            })
        }

        btnTabPermintaanLab.on('shown.bs.tab', function (e, x, y) {
            updateActionButtons('')
        })


        function setNoRacik(no_resep) {
            let no_racik = '';
            $.ajax({
                url: '/erm/resep/racik/ambil',
                method: 'GET',
                dataType: 'JSON',
                async: false,
                data: {
                    no_resep: no_resep,
                },
                success: function (response) {
                    if (Object.keys(response).length >= 1) {
                        $.map(response, function (data) {
                            no = data.no_racik
                        })
                        no_racik = parseInt(no) + 1;
                    } else {
                        no_racik = 1
                    }

                }
            })
            return no_racik;


        }

        function copyResep(kdResep) {
            const formInfoPasienResep = $('#formInfoPasienResep')
            const no_rawat = formInfoPasienResep.find('[name=no_rawat]').val();
            const kd_dokter = formInfoPasienResep.find('[name=kd_dokter]').val();
            const status = formInfoPasienResep.find('[name=status_lanjut]').val();

            Swal.fire({
                title: 'Yakin ?',
                text: "Anda mengcopy resep ini",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post(`/erm/resep/copy/${kdResep}`, {
                        no_rawat: no_rawat,
                        kd_dokter: kd_dokter,
                        status: status,
                    }).done((response) => {
                        if (response.success) {
                            swalToast('Berhasil Copy Resep')
                            getResepObat(no_rawat)
                        }
                    }).fail((error) => {
                        alertErrorAjax(error)
                    })

                    // createResep(kd_dokter, no_rawat)
                    // getObatResepUmum(kdResep)
                    // getResepRacikan(kdResep)
                    // setNoResep().done((response) => {
                    //     if (Object.keys(response).length > 0) {
                    //         if (response.tgl_perawatan == '0000-00-00' && response.no_rawat == $('#nomor_rawat').val()) {
                    //             nomor = response.no_resep;
                    //         } else {
                    //             nomor = parseInt(response.no_resep) + 1
                    //         }
                    //     } else {
                    //         nomor = "{{ date('Ymd') }}" + '0001';
                    //     }
                    //     $('.no_resep').val(nomor)
                    // })
                    // let dataResep;
                    // let dataObat;
                    // let dataRacikan;
                    // let no_resep = $('.no_resep').val();
                    // let no_rawat = $('#nomor_rawat').val();
                    // let no_racik = setNoRacik(no_resep)
                    // cekResep(no_rawat).done((response) => {
                    //     jmlResep = Object.keys(response).length;
                    //     if (jmlResep == 0) {
                    //         simpanResepObat().done((response) => {
                    //             console.log('BUAT RESEP', response)
                    //         });
                    //     }
                    //     ambilResep(kdResep).done((resep) => {
                    //         if (Object.keys(resep.resep_dokter).length > 0) {
                    //             $.map(resep.resep_dokter, function(rd) {
                    //                 $.ajax({
                    //                     url: '/erm/resep/umum/simpan',
                    //                     method: 'POST',
                    //                     data: {
                    //                         '_token': '{{ csrf_token() }}',
                    //                         'no_resep': no_resep,
                    //                         'kode_brng': rd.kode_brng,
                    //                         'aturan_pakai': rd.aturan_pakai,
                    //                         'jml': rd.jml,
                    //                     },
                    //                 }).done((response) => {
                    //                     console.log('SUKSES')
                    //                 })
                    //             })
                    //         }
                    //         if (Object.keys(resep.resep_racikan).length > 0) {
                    //             $.map(resep.resep_racikan, function(racik) {
                    //                 $.ajax({
                    //                     url: '/erm/resep/racik/simpan',
                    //                     method: 'POST',
                    //                     data: {
                    //                         '_token': "{{ csrf_token() }}",
                    //                         'no_resep': no_resep,
                    //                         'no_racik': racik.no_racik,
                    //                         'nama_racik': racik.nama_racik,
                    //                         'kd_racik': racik.kd_racik,
                    //                         'jml_dr': racik.jml_dr,
                    //                         'aturan_pakai': racik.aturan_pakai,
                    //                         'keterangan': racik.keterangan,
                    //                     },
                    //                     success: function(response) {
                    //                         $.map(racik.detail_racikan, function(racikan) {
                    //                             $.ajax({
                    //                                 url: '/erm/resep/racik/detail/simpan',
                    //                                 method: 'POST',
                    //                                 data: {
                    //                                     '_token': '{{ csrf_token() }}',
                    //                                     'no_resep': no_resep,
                    //                                     'no_racik': racikan.no_racik,
                    //                                     'kode_brng': racikan.kode_brng,
                    //                                     'p1': racikan.p1,
                    //                                     'p2': racikan.p2,
                    //                                     'jml': racikan.jml,
                    //                                     'kandungan': racikan.kandungan,
                    //                                 },
                    //                             }).done((response) => {
                    //                                 console.log('SUKSES')
                    //                             })
                    //                         })
                    //                     }
                    //                 }).done((response) => {
                    //                     console.log('SUKSES')
                    //                 })
                    //             })
                    //         }
                    //         $('.tb-resep-riwayat tbody').empty()
                    //         cekResep(no_rawat)
                    //         riwayatResep($('#no_rm').val())
                    //         tulisPlan();
                    //     })
                    // });


                }

            })
        }


        $('#simpanObat').on('click', function () {
            $.ajax({
                url: '/erm/resep/obat/ambil',
                data: {
                    'no_resep': $('.no_resep').val(),
                },
                success: function (response) {
                    if (Object.keys(response).length == 0) {
                        simpanResepObat()
                    }
                    $.ajax({
                        url: '/erm/resep/umum/simpan',
                        method: 'POST',
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'no_resep': $('.no_resep').val(),
                            'kode_brng': $('.kode_obat').val(),
                            'jml': $('.jml').val(),
                            'aturan_pakai': $('.aturan_pakai').val() + ' ' + $(
                                '.keterangan')
                                .val(),
                        },
                        success: function (response) {
                            cekResep(id)
                        },
                        error: function () {
                            Swal.fire('Gagal !', 'Obat tidak tersimpan', 'error')
                        }
                    })
                }
            })
        });


        function simpanResepObat() {

            kd_dokter = "{{ Request::get('dokter') }}";
            dokter = kd_dokter ? kd_dokter : $('#nik').val();

            let resep = $.ajax({
                url: '/erm/resep/obat/simpan',
                data: {
                    _token: "{{ csrf_token() }}",
                    kd_dokter: dokter,
                    no_rawat: $('#nomor_rawat').val(),
                    no_resep: $('.no_resep').val(),
                },
                method: 'POST',
                error: function (request, status, error) {
                    Swal.fire(
                        'Gagal !',
                        'Tidak bisa menambah resep<br/>' + request.responseJSON.message,
                        'error',
                    )

                }
            });

            return resep;
        }

        function ambilRacikan(no_resep, no_racik) {
            const hasil = $.ajax({
                url: '/erm/resep/racik/ambil',
                data: {
                    no_resep: no_resep,
                    no_racik: no_racik,
                },
            })
            return hasil;
        }

        function ambilResep(no_resep) {
            hasil = '';
            let resep = $.ajax({
                url: '/erm/resep/obat/ambil',
                data: {
                    no_resep: no_resep,
                },
                success: function (response) {
                    hasil = response;
                },
            })
            return resep;
        }



        function hitungJumlahObat(kps, p1, p2, jumlah) {
            jumlah = $('.jml_dr').val();
            kandungan = kps * p1 / p2;
            jml_obat = kandungan * jumlah / kps
            return parseFloat(jml_obat).toFixed(0);
        }

        function ambilObatRacikan() {
            $('.table-racikan tbody').empty();
            no_resep = $('.no_resep').val();
            no_racik = $('.no_racik').val();
            $.ajax({
                url: '/erm/resep/racik/detail/ambil',
                method: 'GET',
                dataType: 'JSON',
                data: {
                    no_resep: no_resep,
                    no_racik: no_racik,
                },
                success: function (response, status, detail) {
                    html = '';
                    no = 1;
                    $.map(response, function (res) {

                        kandungan = res.kandungan != 0 ? res.kandungan : res.data_barang.kapasitas;

                        html += '<tr class="obat-' + no + '">'
                        html += '<td><input type="hidden" id="kode_brng' + no + '" value="' + res.kode_brng + '" name="kode_brng[]"/>' + res.data_barang.nama_brng + '</td>'
                        html += '<td><input type="hidden" id="kps' + no + '" name="kps[]" value="' + res.data_barang.kapasitas + '"/>' + res.data_barang.kapasitas + ' mg </td>'
                        html += '<td><input type="search" class="form-control form-control-sm form-underline" id="p1' + no + '" name="p1[]" value="' + res.p1 + '" onkeyup="hitungObatRacik(' + no + ')" onfocusout="setNilaiPembagi(this)" autocomplete="off" onkeypress="return hanyaAngka(event)"/></td>'
                        html += '<td>/</td>'
                        html += '<td><input type="search" class="form-control form-control-sm form-underline" id="p2' + no + '"name="p2[]" onkeyup="hitungObatRacik(' + no + ')" value="' + res.p2 + '" onfocusout="setNilaiPembagi(this)" autocomplete="off" onkeypress="return hanyaAngka(event)"/></td>'
                        html += '<td><input type="search" class="form-control form-control-sm form-underline" id="kandungan' + no + '" name="kandungan[]" onkeypress="return hanyaAngka(event)" value="' + kandungan + '" onkeyup="hitungDosis(' + no + ')" autocomplete="off"/></td>'
                        html += '<td>mg</td>'
                        html += '<td><input type="search" class="form-control form-control-sm form-underline" id="jml_obat' + no + '" name="jml[]" value="' + hitungJumlahObat(res.data_barang.kapasitas, res.p1, res.p2) + '" readonly/></td>'
                        html += '<td><button type="button" class="btn btn-danger btn-sm" style="font-size:12px" data-resep="' + res.no_resep + '" data-racik="' + res.no_racik + '" data-obat="' + res.kode_brng + '" data-no="' + no + '" onclick="hapusObat(this)"><i class="bi bi-trash-fill"></i></button></td>'
                        html += '</tr>'
                        no++
                    });
                    $('.table-racikan tbody').append(html);
                    $('.nomor').val(no)
                },
            })
        }

        function editObat(param) {
            kode_obat = $(param).data('barang');
            kps = $(param).data('kps');
            obat = $(param).data('obat');

            $('.simpan-obat').addClass('d-none');
            $('.ubah-obat').css('display', '');
            $('.obat-baru').css('display', '');

            $('.kandungan').val(0);
            $('.jml_obat').val(0);
            $('.kps').val(kps);
            $('.kode_obat').val(kode_obat);
            $('.nama_obat').val(obat);
            $('.p1').val(1);
            $('.p2').val(1);
        }

        $('.ubah-obat').on('click', function () {
            no_racik = $('.no_racik').val();
            no_resep = $('.no_resep').val();
            kode_brng = $('.kode_obat').val();
            p1 = $('.p1').val();
            p2 = $('.p2').val();
            kandungan = $('.kandungan').val();
            jml = $('.jml_obat').val();

            $.ajax({
                url: '/erm/resep/racik/detail/ubah',
                data: {
                    _token: '{{ csrf_token() }}',
                    kode_brng: kode_brng,
                    no_racik: no_racik,
                    no_resep: no_resep,
                    p1: p1,
                    p2: p2,
                    kandungan: kandungan,
                    jml: jml,
                },
                method: 'POST',
                success: function (response) {
                    ambilObatRacikan();
                },
                error: function (request, status, error) {
                    Swal.fire(
                        'Gagal !',
                        'Tidak bisa mengubah obat<br/>' + request.responseJSON.message,
                        'error',
                    )
                }
            }).done(function () {
                tulisPlan();
            })
        })


        $('.obat-baru').on('click', function () {
            $('.simpan-obat').css('display', '');
            $('.ubah-obat').addClass('d-none');
            $('.obat-baru').addClass('d-none');

            $('.kandungan').val('');
            $('.jml_obat').val('');
            $('.kps').val('');
            $('.kode_obat').val('');
            $('.nama_obat').val('');
            $('.p1').val('');
            $('.p2').val('');

            $('.nama_obat').focus();

        })

        function hapusObat(param) {

            no_resep = $(param).data('resep');
            no_racik = $(param).data('racik');
            kode_brng = $(param).data('obat');
            no = $(param).data('no');


            Swal.fire({
                title: 'Yakin ?',
                text: "Anda tidak bisa mengembalikan lagi",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus saja!',
                cancelButtonText: 'Jangan',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/erm/resep/racik/detail/hapus',
                        method: 'DELETE',
                        data: {
                            _token: "{{ csrf_token() }}",
                            no_resep: no_resep,
                            no_racik: no_racik,
                            kode_brng: kode_brng,
                        },
                        success: function () {
                            $('.obat-' + no).remove();
                            hitungBarisObat($('.table-racikan'))
                            cekResep(id);
                            riwayatResep($('#no_rm').val())
                        },
                        error: function (request, status, error) {
                            Swal.fire(
                                'Gagal !',
                                'Tidak menghapus obat<br/>' + request.responseJSON
                                    .message,
                                'error',
                            )

                        }
                    }).done(function () {
                        tulisPlan();
                    })
                }
            })
        }

        function hitungBarisObat($table) {
            $table.find('tr').each(function (index, element) {
                $(element).attr('class', 'obat-' + index)
                $(element).find('td:eq(0) input').attr('id', 'kode_brng' + index)
                $(element).find('td:eq(1) input').attr('id', 'kps' + index)
                $(element).find('td:eq(2) input').attr('id', 'p1' + index)
                $(element).find('td:eq(2) input').attr('onchange', 'hitungObatRacik(' + index + ')')
                $(element).find('td:eq(4) input').attr('id', 'p2' + index)
                $(element).find('td:eq(4) input').attr('onchange', 'hitungObatRacik(' + index + ')')
                $(element).find('td:eq(5) input').attr('id', 'kandungan' + index)
                $(element).find('td:eq(5) input').attr('onchange', 'hitungDosis(' + index + ')')
                $(element).find('td:eq(7) input').attr('id', 'jml_obat' + index)
            });
            $('.nomor').val($table.find('tr').length);
        }

        $('tbody').on('click', '.edit', function () {
            let no_resep = $(this).attr('data-resep');
            let kode_brng = $(this).attr('data-obat');
            let no_racik = $(this).data('racik');
            // console.log('noracik', no_racik)
            $('#modalObatRacik').modal('show');
            ambilRacikan(no_resep, no_racik).done((racikan) => {
                $('.no_resep').val(racikan.no_resep);
                $('.metode').val(racikan.metode.nm_racik);
                $('.nm_racik').val(racikan.nama_racik);
                $('.no_racik').val(no_racik);
                $('.jml_dr').val(racikan.jml_dr);
                $('.aturan_pakai').val(racikan.aturan_pakai);
                ambilObatRacikan();
            })
        })

        $('#modalObatRacik').on('shown.bs.modal', function () {
            $('.kps').val('');
            $('.p1').val('');
            $('.p2').val('');
            $('.jml_obat').val('');
            $('.kandungan').val('');
            $('.kandungan').val('');
        });
        $('#modalObatRacik').on('hidden.bs.modal', function () {
            $('.no_racik').val('');
            $('.kps').val('');
            $('.p1').val('');
            $('.p2').val('');
            $('.jml_obat').val('');
            $('.nama_obat').val('');
            $('.kandungan').val('');
        });


        function hapusResepUmum(no_resep, kode_brng) {
            let resepUmum = $.ajax({
                url: '/erm/resep/umum/hapus',
                data: {
                    _token: "{{ csrf_token() }}",
                    no_resep: no_resep,
                    kode_brng: kode_brng,
                },
                method: 'DELETE',
            });

            return resepUmum;
        }

        function hapusNomorResep(no_resep) {
            ambilResep(no_resep).done(function (res) {
                resepDokter = Object.keys(res.resep_dokter).length
                resepRacik = Object.keys(res.resep_racikan).length
                if (resepDokter == 0 && resepRacik == 0) {
                    hapusResep(no_resep).done(function () {
                        Swal.fire({
                            title: 'Berhasil',
                            text: "Resep telah dihapus",
                            icon: 'success',
                            showCancelButton: false,
                            showConfirmButton: false,
                            timer: 1500,
                        })
                    })
                }
            })
        }

        $('tbody').on('click', '.remove', function () {
            let no_resep = $(this).attr('data-resep');
            let kode_brng = $(this).attr('data-obat');
            let no_racik = $(this).attr('data-racik');
            Swal.fire({
                title: 'Yakin ?',
                text: "Anda tidak bisa mengembalikan lagi",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus saja!',
                cancelButtonText: 'Jangan',
            }).then((result) => {
                if (result.isConfirmed) {
                    if (no_racik) {
                        hapusResepRacikan(no_resep, no_racik).done(function (response) {
                            hapusNomorResep(no_resep)
                            tulisPlan();
                            $('#body_racik').empty();
                            $('#tb-resep-racikan tbody').empty();
                            cekResep($('#nomor_rawat').val());
                        })
                    } else {
                        hapusResepUmum(no_resep, kode_brng).done(function (response) {
                            hapusNomorResep(no_resep)
                            $('#body_umum').empty();
                            cekResep($('#nomor_rawat').val())
                            tulisPlan();
                        })
                    }
                    riwayatResep($('#no_rm').val());
                }
            })
            return false;
        })


        function cariDiagnosaSoap(diagnosa) {
            getDiagnosa(diagnosa.value).done(function (response) {
                if (response) {
                    html =
                        '<ul class="dropdown-menu" style="width:auto;display:block;position:absolute;font-size:12px">';
                    no = 1;
                    $.map(response, function (data) {
                        html +=
                            '<li data-nama="' + data.nm_penyakit + '" data-id="' + data.kd_penyakit + '" onclick="tambahDiagnosa(this)"><a class="dropdown-item" href="#" style="overflow:hidden"> ' + data.kd_penyakit + ' - ' + data.nm_penyakit + '</a></li>'
                        no++;
                    })
                    html += '</ul>';
                    $('.list-diagnosa').fadeIn();
                    $('.list-diagnosa').html(html);
                }
            })
        }

        function cariProsedur(kode) {
            if (kode.value.length) {
                $.ajax({
                    url: '/erm/prosedur/cari',
                    data: {
                        'kode': kode.value,
                    },
                    dataType: 'JSON',
                    success: function (response) {
                        if (response) {
                            html =
                                '<ul class="dropdown-menu" style="width:auto;display:block;position:absolute;font-size:12px">';
                            no = 1;
                            $.map(response, function (data) {
                                html +=
                                    '<li data-nama="' + data.deskripsi_pendek + '" data-id="' + data.kode + '" onclick="tambahProsedur(this)"><a class="dropdown-item" href="#" style="overflow:hidden"> ' + data.kode + ' - ' + data.deskripsi_pendek + '</a></li>'
                                no++;
                            })
                            html += '</ul>';
                            $('.list-prosedur').fadeIn();
                            $('.list-prosedur').html(html);
                        }
                    }
                })
            }
        }

        function tambahDiagnosa(param) {
            no_rawat = $('#nomor_rawat').val();
            kd_penyakit = $(param).data('id');
            prioritas = $('.no_diagnosa').val()

            $.ajax({
                url: '/erm/penyakit/pasien/tambah',
                data: {
                    _token: "{{ csrf_token() }}",
                    no_rawat: no_rawat,
                    kd_penyakit: kd_penyakit,
                    status: "Ralan",
                    prioritas: prioritas,
                },
                method: 'POST',
                success: function (response) {
                    ambilDiagnosaPasien(no_rawat)
                    $('#diagnosa').val('').focus();
                }
            })

        }

        function tambahProsedur(param) {
            no_rawat = $('#nomor_rawat').val();
            kode = $(param).data('id');
            prioritas = $('.no_prosedur').val()

            $.ajax({
                url: '/erm/prosedur/pasien/tambah',
                data: {
                    _token: "{{ csrf_token() }}",
                    no_rawat: no_rawat,
                    kode: kode,
                    status: "Ralan",
                    prioritas: prioritas,
                },
                method: 'POST',
                success: function (response) {
                    ambilProsedurPasien(no_rawat)
                    $('#prosedur').val('').focus();
                }
            })

        }

        function ambilDiagnosaPasien(no_rawat) {
            $.ajax({
                url: '/erm/penyakit/pasien/ambil',
                data: {
                    no_rawat: no_rawat,
                },
                success: function (response) {
                    nomor = 1;
                    $('.table-diagnosa tbody').empty();
                    if (Object.keys(response).length > 0) {
                        $.map(response, function (res) {
                            html = '<tr class="diagnosa_' + res.kd_penyakit + '">'
                            html += '<td>'
                            html += res.prioritas
                            html += '</td>'
                            html += '<td>'
                            html += res.kd_penyakit
                            html += '</td>'
                            html += '<td>'
                            html += res.penyakit.nm_penyakit
                            html += '</td>'
                            html += '<td>'
                            html += '<button type="button" class="btn btn-danger btn-sm" style="font-size:12px" onclick="hapusDiagnosaPasien(\'' + no_rawat + '\', \'' + res.kd_penyakit + '\')"><i class="bi bi-trash-fill"></i></button>'
                            html += '</td>'
                            html += '</tr>'
                            nomor = res.prioritas + 1;
                            $('.table-diagnosa tbody').append(html)
                        })
                    } else {
                        html = '<tr>'
                        html += '<td colspan="4" style="text-align:center">Tidak ada diagnosa</td>'
                        html += '</tr>'
                        $('.table-diagnosa tbody').append(html)

                    }
                    $('.no_diagnosa').val(nomor)
                }
            })
        }

        function ambilProsedurPasien(no_rawat) {
            $.ajax({
                url: '/erm/prosedur/pasien/ambil',
                data: {
                    no_rawat: no_rawat,
                },
                success: function (response) {
                    nomor = 1;
                    $('.table-prosedur tbody').empty();
                    if (Object.keys(response).length > 0) {
                        $.map(response, function (res) {
                            html = '<tr class="prosedur_' + res.kode + '">'
                            html += '<td>'
                            html += res.prioritas
                            html += '</td>'
                            html += '<td>'
                            html += res.kode
                            html += '</td>'
                            html += '<td>'
                            html += res.icd9.deskripsi_pendek
                            html += '</td>'
                            html += '<td>'
                            html += '<button type="button" class="btn btn-danger btn-sm" style="font-size:12px" onclick="hapusProsedurPasien(\'' + no_rawat + '\', \'' + res.kode + '\')"><i class="bi bi-trash-fill"></i></button>'
                            html += '</td>'
                            html += '</tr>'
                            nomor = res.prioritas + 1;
                            $('.table-prosedur tbody').append(html)
                        })
                    } else {
                        html = '<tr>'
                        html += '<td colspan="4" style="text-align:center">Tidak ada prosedur</td>'
                        html += '</tr>'
                        $('.table-prosedur tbody').append(html)

                    }
                    $('.no_prosedur').val(nomor)
                }
            })
        }

        function hapusProsedurPasien(no_rawat, kode) {
            no = $('.no_diagnosa').val();
            $.ajax({
                url: '/erm/prosedur/pasien/hapus',
                data: {
                    _token: "{{ csrf_token() }}",
                    no_rawat: no_rawat,
                    kode: kode,
                },
                method: 'DELETE',
                success: function (response) {

                    $('.no_prosedur').val(parseInt(no) - 1)
                    ambilProsedurPasien(no_rawat)
                }
            })
        }

        function hapusDiagnosaPasien(no_rawat, kd_penyakit) {
            // console.log(no_rawat)
            no = $('.no_diagnosa').val();
            $.ajax({
                url: '/erm/penyakit/pasien/hapus',
                data: {
                    _token: "{{ csrf_token() }}",
                    no_rawat: no_rawat,
                    kd_penyakit: kd_penyakit,
                },
                method: 'DELETE',
                success: function (response) {

                    $('.no_diagnosa').val(parseInt(no) - 1)
                    ambilDiagnosaPasien(no_rawat)
                }
            })
        }



        $('#modal').on('shown.bs.modal', function () {


            $('.tambah_umum').css('visibility', 'visible')
            let kd_dokter = "{{ Request::get('dokter') }}"

            getRegPeriksa(id).done((regPeriksa) => {

                var form = '';
                if (regPeriksa.dokter.kd_sps == 'S0003') {
                    $('#li-asmed-ana').removeClass('d-none');
                    $('#li-asmed-ranap-ana').removeClass('d-none');
                    $('#li-data-anak').removeClass('d-none');
                    $('#li-asmed-obg').addClass('d-none');
                    $('#li-asmed-ranap-obg').addClass('d-none');
                    $('#li-data-obg').addClass('d-none');
                    $('.btn-asmed-ranap').attr('onclick', 'simpanAsmedRanapAnak()')
                    $('.btn-asmed').attr('onclick', 'simpanAsmedRajalAnak()')
                    form = '.form-asmed-anak';
                    setAsmedAnak(id);
                    setAsmedRanapAnak(id)

                } else if (regPeriksa.dokter.kd_sps == 'S0001') {
                    $('#li-asmed-ana').addClass('d-none');
                    $('#li-asmed-ranap-ana').addClass('d-none');
                    $('#li-data-anak').addClass('d-none');
                    $('#li-asmed-obg').removeClass('d-none');
                    $('#li-asmed-ranap-obg').removeClass('d-none');
                    $('#li-data-obg').removeClass('d-none');
                    $('.btn-asmed-ranap').attr('onclick', 'simpanAsmedRanapKandungan()')
                    $('.btn-asmed').attr('onclick', 'simpanAsmedRajalKandungan()')
                    form = '.form-asmed-kandungan';

                    setAsmedRajalKandungan(id);
                    setAsmedRanapKandungan(id)
                }
                $(`${form} input[name="no_rawat"]`).val(regPeriksa.no_rawat)
                $(`${form} input[name="pasien"]`).val(`${regPeriksa.pasien.nm_pasien} (${regPeriksa.pasien.jk})`)
                $(`${form} input[name="tgl_lahir"]`).val(`${formatTanggal(regPeriksa.pasien.tgl_lahir)} (${hitungUmur(regPeriksa.pasien.tgl_lahir)})`)
                $(`${form} input[name="kd_dokter"]`).val(regPeriksa.kd_dokter)
                $(`${form} input[name="nm_dokter"]`).val(regPeriksa.dokter.nm_dokter)
                $(`${form} input[name="nm_dokter"]`).attr('readonly', 'readonly')

                const formInfoPasienResep = $('#formInfoPasienResep')
                formInfoPasienResep.find(`input[name="no_rawat"]`).val(regPeriksa.no_rawat)

                formInfoPasienResep.find('input[name=no_rawat]').val(no_rawat);
                formInfoPasienResep.find('input[name=kd_dokter]').val(response.kd_dokter);
                formInfoPasienResep.find('input[name=no_rkm_medis]').val(response.no_rkm_medis);
                formInfoPasienResep.find('input[name=status_lanjut]').val(response.status_lanjut?.toLowerCase());
                const depoPoli = response.status_lanjut?.toLowerCase() === 'ranap' ? 'RM' : 'RM7';
                if (typeof setDepoResep === 'function') {
                    setDepoResep(depoPoli, 0);
                } else {
                    formInfoPasienResep.find('input[name=kd_bangsal]').val(depoPoli);
                    formInfoPasienResep.find('input[name=cari_kandungan]').val('0');
                    $('.namaDepoText').text(depoPoli === 'RM' ? 'Apotek Ranap' : 'Apotek Rajal');
                }

            })
            no = 1;
            isModalShow = true;
        });

        function setSoapToAsmed(no_rawat, form) {

            return getPemeriksaanPoli(no_rawat).done((response) => {
                if (Object.keys(response).length != 0) {
                    form.find(`select[name="kesadaran"]`).val(response.kesadaran).change();
                    form.find(`input[name="gcs"]`).val(response.gcs);
                    form.find(`input[name="tb"]`).val(response.tinggi);
                    form.find(`input[name="bb"]`).val(response.berat);
                    form.find(`input[name="td"]`).val(response.tensi);
                    form.find(`input[name="nadi"]`).val(response.nadi);
                    form.find(`input[name="rr"]`).val(response.respirasi);
                    form.find(`input[name="suhu"]`).val(response.suhu_tubuh);
                    form.find(`input[name="spo"]`).val(response.spo2);
                    form.find(`textarea[name="keluhan_utama"]`).val(response.keluhan);
                    form.find(`textarea[name="rps"]`).val(response.pemeriksaan);
                    form.find(`textarea[name="ket_fisik"]`).val(response.pemeriksaan);
                    form.find(`textarea[name="diagnosis"]`).val(response.penilaian);
                    form.find(`textarea[name="konsul"]`).val(response.instruksi);
                    form.find(`textarea[name="tata"]`).val(response.rtl);

                }
            })
        }

        function setAsmedRajalKandungan(no_rawat) {
            getAsmedRajalKandungan(no_rawat).done((response) => {
                if (Object.keys(response).length) {
                    $.each(response, (index, value) => {
                        select = $(`#formAsmedRajalKandungan select[name=${index}]`);
                        input = $(`#formAsmedRajalKandungan input[name=${index}]`);
                        textarea = $(`#formAsmedRajalKandungan textarea[name=${index}]`);

                        if (select.length) {
                            $(`#formAsmedRajalKandungan select[name=${index}]`).val(value)
                        } else if (input.length) {
                            $(`#formAsmedRajalKandungan input[name=${index}]`).val(value)
                        } else {
                            $(`#formAsmedRajalKandungan textarea[name=${index}]`).val(value)
                        }
                    })
                } else {
                    const form = $('#formAsmedRajalKandungan')
                    setSoapToAsmed(no_rawat, form);
                }
            })
        }

        function setAsmedAnak(no_rawat) {
            getAsmedAnak(no_rawat).done((response) => {
                $('.form-asmed-anak button[name="simpan"]').removeClass('d-none')
                $('.form-asmed-anak button[name="edit"]').addClass('d-none')
                if (Object.keys(response).length != 0) {
                    $('.form-asmed-anak button[name="simpan"]').addClass('d-none')
                    $('.form-asmed-anak button[name="edit"]').removeClass('d-none')
                    $('.form-asmed-anak select[name="anamnesis"]').val(response.anamnesis).change()
                    $('.form-asmed-anak input[name="hubungan"]').val(response.hubungan)
                    $('.form-asmed-anak textarea[name="keluhan_utama"]').val(response.keluhan_utama)
                    $('.form-asmed-anak textarea[name="rps"]').val(response.rps)
                    $('.form-asmed-anak textarea[name="rpk"]').val(response.rpk)
                    $('.form-asmed-anak textarea[name="rpd"]').val(response.rpd)
                    $('.form-asmed-anak textarea[name="rpo"]').val(response.rpo)
                    $('.form-asmed-anak input[name="alergi"]').val(response.alergi)
                    $('.form-asmed-anak select[name="keadaan"]').val(response.keadaan).change()
                    $('.form-asmed-anak select[name="kesadaran"]').val(response.kesadaran).change()
                    $('.form-asmed-anak input[name="gcs"]').val(response.gcs)
                    $('.form-asmed-anak input[name="tb"]').val(response.tb)
                    $('.form-asmed-anak input[name="bb"]').val(response.bb)
                    $('.form-asmed-anak input[name="td"]').val(response.td)
                    $('.form-asmed-anak input[name="nadi"]').val(response.nadi)
                    $('.form-asmed-anak input[name="rr"]').val(response.rr)
                    $('.form-asmed-anak input[name="suhu"]').val(response.suhu)
                    $('.form-asmed-anak input[name="spo"]').val(response.spo)
                    $('.form-asmed-anak select[name="kepala"]').val(response.kepala).change()
                    $('.form-asmed-anak select[name="mata"]').val(response.mata).change()
                    $('.form-asmed-anak select[name="genital"]').val(response.genital).change()
                    $('.form-asmed-anak select[name="gigi"]').val(response.gigi).change()
                    $('.form-asmed-anak select[name="ekstremitas"]').val(response.ekstremitas).change()
                    $('.form-asmed-anak select[name="tht"]').val(response.tht).change()
                    $('.form-asmed-anak select[name="kulit"]').val(response.kulit).change()
                    $('.form-asmed-anak select[name="thoraks"]').val(response.thoraks).change()
                    $('.form-asmed-anak select[name="kontraksi"]').val(response.kontraksi).change()
                    $('.form-asmed-anak textarea[name="ket_fisik"]').val(response.ket_fisik)
                    $('.form-asmed-anak input[name="tfu"]').val(response.tfu)
                    $('.form-asmed-anak input[name="tbj"]').val(response.tbj)
                    $('.form-asmed-anak input[name="his"]').val(response.his)
                    $('.form-asmed-anak input[name="djj"]').val(response.djj)
                    $('.form-asmed-anak input[name="inspeksi"]').val(response.inspeksi)
                    $('.form-asmed-anak input[name="vt"]').val(response.vt)
                    $('.form-asmed-anak input[name="inspekulo"]').val(response.inspekulo)
                    $('.form-asmed-anak input[name="rt"]').val(response.rt)
                    $('.form-asmed-anak textarea[name="ultra"]').val(response.ultra)
                    $('.form-asmed-anak textarea[name="kardio"]').val(response.kardio)
                    $('.form-asmed-anak textarea[name="lab"]').val(response.lab)
                    $('.form-asmed-anak textarea[name="diagnosis"]').val(response.diagnosis)
                    $('.form-asmed-anak textarea[name="tata"]').val(response.tata)
                    $('.form-asmed-anak textarea[name="konsul"]').val(response.konsul)

                }
            })
        }


        function setAsmedRanapAnak(no_rawat) {
            getAsmedRanapAnak(no_rawat).done((response) => {
                if (Object.keys(response).length) {
                    $.each(response, (index, value) => {
                        select = $(`#formAsmedRanapAnak select[name=${index}]`);
                        input = $(`#formAsmedRanapAnak input[name=${index}]`);
                        textarea = $(`#formAsmedRanapAnak textarea[name=${index}]`);

                        if (select.length) {
                            $(`#formAsmedRanapAnak select[name=${index}]`).val(value)
                        } else if (input.length) {
                            $(`#formAsmedRanapAnak input[name=${index}]`).val(value)
                        } else {
                            $(`#formAsmedRanapAnak textarea[name=${index}]`).val(value)
                        }
                    })
                } else {
                    const form = $('#formAsmedRanapAnak')
                    setSoapToAsmed(no_rawat, form);
                }
            })
        }

        function setAsmedRanapKandungan(no_rawat) {
            getAsmedRanapKandungan(no_rawat).done((response) => {
                if (Object.keys(response).length) {
                    $.each(response, (index, value) => {
                        select = $(`#formAsmedRanapKandungan select[name=${index}]`);
                        input = $(`#formAsmedRanapKandungan input[name=${index}]`);
                        textarea = $(`#formAsmedRanapKandungan textarea[name=${index}]`);

                        if (select.length) {
                            $(`#formAsmedRanapKandungan select[name=${index}]`).val(value)
                        } else if (input.length) {
                            $(`#formAsmedRanapKandungan input[name=${index}]`).val(value)
                        } else {
                            $(`#formAsmedRanapKandungan textarea[name=${index}]`).val(value)
                        }
                    })

                } else {
                    const form = $('#formAsmedRanapKandungan');
                    setSoapToAsmed(no_rawat, form);
                    $('#btnPrintAsmedRanapKandungan').attr('href', `javascript:void(0)`).addClass('d-none');
                }
            })
        }

        function hapusResep(no_resep) {
            let resep = $.ajax({
                url: '/erm/resep/obat/hapus/' + no_resep,
                data: {
                    _token: "{{ csrf_token() }}",
                },
                method: 'DELETE',
            })

            riwayatResep($('#no_rm').val())
            return resep;
        }

        function ubahObatDokter(no_resep, kode_brng, no) {
            $.ajax({
                url: '/erm/resep/umum/ubah',
                method: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    no_resep: no_resep,
                    kode_brng: kode_brng,
                    jml: $('.u_jml_' + no).val(),
                    aturan_pakai: $('.u_aturan_' + no).val(),
                },
                success: function (response) {
                    // alert(response);
                    cekResep(id)
                    tulisPlan()
                }
            })
        }

        $('tbody').on('click', '.ubah-obat', function () {
            no = $(this).data('id')
            jml = $('.jml_' + no).text();
            aturan_pakai = $('.aturan_pakai_' + no).text();
            $('.simpan-obat-' + no).css('visibility', 'visible');
            $('.simpan-obat-' + no).css('font-size', '12px');
            $('.ubah-obat').addClass('d-none');
            $('.jml_' + no).empty()
            $('.aturan_pakai_' + no).empty()
            $('.jml_' + no).append('<input type="text" class="form-control form-control-sm form-underline u_jml_' + no + '" value="' + jml + '" />')
            $('.aturan_pakai_' + no).append('<input type="text" onkeyup="cariAturan(this)" autocomplete="off" class="form-control form-control-sm aturan_pakai form-underline u_aturan_' + no + '" value="' + aturan_pakai + '" /><div class="list_aturan"></div>')

        })



        $('#modal').on('hidden.bs.modal', function () {
            const nm_pasien = $('#pasien-cari').val();
            tb_pasien(tgl_registrasi, nm_pasien);
            $('#tb-resep tbody').empty();
            $('#tb-resep-racikan tbody').empty();
            isModalShow = false;
            // $('#nomor_rawat').val('-');
            // $('#p_jawab').val('-');
            // $('#no_rm').val('-');
            // $('#nama_pasien').val('-');
            // $('#nama').val('-');
            // $('#nik').val('-');
            // $('#jabatan').val('-');
            // $('#nomor_rawat').val('-');
            // $('#tgl_perawatan').val('-');
            // $('#subjek').val('-');
            // $('#objek').val('-');
            // $('#asesmen').val('-');
            // $('#plan').val('-');
            // $('#instruksi').val('-');
            // $('#suhu').val('-');
            // $('#tensi').val('-');
            // $('#tinggi').val('-');
            // $('#berat').val('-');
            // $('#gcs').val('-');
            // $('#respirasi').val('-');
            // $('#alergi').val('-')
            // $('#nadi').val('-');
            // $('#spo2').val('-');
            formSoapPoli.find('input:not([type="radio"]):not([type="checkbox"])').val('-');
            formSoapPoli.find('textarea').val('-');

            $('#body_umum').empty();
            $('#body_racikan').empty();
            $('#body_riwayat').empty();
            $('#ket_pasien').val('');
            $('button[data-bs-target="#tab-soap-pane"]').tab('show')
            tb_pasien()


        });

        function catatanPasien() {
            const no_rawat = formSoapPoli.find('input[name="no_rawat"]').val();
            ambilDiagnosaPasien(no_rawat);
            ambilProsedurPasien(no_rawat);
            $('#modalCatatan').modal('show')
        }

        function getAsmedRajalKandungan(noRawat) {
            const id = textRawat(noRawat, '-')
            const asmed = $.ajax({
                url: '/erm/poliklinik/asmed/kandungan/get/' + id,
                metho: `GET`,
                error: (request) => {
                    alertSessionExpired(request.status)
                },
            })
            return asmed;
        }

        function getAsmedAnak(noRawat) {
            const id = textRawat(noRawat, '-')
            const asmed = $.ajax({
                url: '/erm/poliklinik/asmed/anak/get/' + id,
                metho: `GET`,
                error: (request) => {
                    alertSessionExpired(request.status)
                },
            })
            return asmed;
        }

        $('#btnHasilKritis').on('click', () => {
            const no_rawat = formSoapPoli.find('input[name="no_rawat"]').val();
            hasilKritis(no_rawat)
        })
    </script>
@endpush