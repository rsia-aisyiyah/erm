<style>
    /* ======================================================
       SCOPED UX & RESPONSIVE STYLES: #modalSoapRanap
       ====================================================== */
    #modalSoapRanap .modal-content {
        background-color: #f4f6f9;
    }

    #modalSoapRanap .erm-modal-header {
        background: #ffffff;
        border-bottom: 1px solid #e2e8f0;
        padding: 10px 16px;
        gap: 10px;
        flex-wrap: wrap;
        position: sticky;
        top: 0;
        z-index: 30;
    }

    #modalSoapRanap .erm-patient-strip {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 6px 12px;
        min-width: 0;
        flex: 1 1 auto;
    }

    #modalSoapRanap .erm-patient-avatar {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        background: #eff6ff;
        color: #2563eb;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        flex-shrink: 0;
    }

    #modalSoapRanap .erm-patient-name {
        font-size: 14px;
        font-weight: 700;
        color: #0f172a;
        line-height: 1.2;
    }

    #modalSoapRanap .erm-patient-meta {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 5px 6px;
        font-size: 11.5px;
        color: #475569;
        margin-top: 3px;
    }

    #modalSoapRanap .erm-meta-chip {
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
        max-width: 260px;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    #modalSoapRanap .erm-header-actions {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 6px;
        flex-shrink: 0;
    }

    #modalSoapRanap .erm-detail-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        display: inline-block;
        background-color: #94a3b8;
        transition: background-color 0.2s ease, box-shadow 0.2s ease;
    }

    #modalSoapRanap #btnToggleDetailPasienRanapHdr.is-open {
        background-color: #2563eb !important;
        border-color: #2563eb !important;
        color: #ffffff !important;
        box-shadow: 0 2px 8px rgba(37, 99, 235, 0.28);
    }

    #modalSoapRanap #btnToggleDetailPasienRanapHdr.is-open .erm-detail-dot {
        background-color: #4ade80;
        box-shadow: 0 0 0 3px rgba(74, 222, 128, 0.35);
    }

    #modalSoapRanap .erm-bpjs-check-pill {
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

    #modalSoapRanap .erm-bpjs-check-pill:hover {
        background: #dbeafe;
        border-color: #3b82f6;
    }

    /* Floating Kelengkapan Berkas Melayang di Kanan Bawah di Atas #modalSoapRanap (z-index 1065 > modal 1055, < child modal 1075) */
    #ermModalBerkasFloatWrap {
        position: fixed;
        right: 18px;
        bottom: 58px;
        z-index: 1065;
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 10px;
    }

    #btnErmModalBerkasFab {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 9px 14px;
        border-radius: 999px;
        border: 1px solid rgba(255, 255, 255, 0.25);
        background: linear-gradient(135deg, #1e293b, #0f172a);
        color: #ffffff;
        font-size: 12px;
        font-weight: 600;
        box-shadow: 0 12px 28px rgba(15, 23, 42, 0.32);
        cursor: pointer;
        transition: transform 0.15s ease, box-shadow 0.15s ease, background 0.25s ease;
    }

    #btnErmModalBerkasFab:hover {
        transform: translateY(-2px);
        box-shadow: 0 16px 34px rgba(15, 23, 42, 0.38);
    }

    #btnErmModalBerkasFab.is-complete {
        background: linear-gradient(135deg, #15803d, #16a34a);
    }

    #btnErmModalBerkasFab.is-warning {
        background: linear-gradient(135deg, #b45309, #d97706);
    }

    #btnErmModalBerkasFab.is-danger {
        background: linear-gradient(135deg, #b91c1c, #dc2626);
    }

    .erm-mbfab-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #4ade80;
        display: inline-block;
        flex-shrink: 0;
    }

    #btnErmModalBerkasFab.is-danger .erm-mbfab-dot,
    #btnErmModalBerkasFab.is-warning .erm-mbfab-dot {
        background: #fef08a;
        animation: ermMbFabPulse 1.6s infinite;
    }

    @keyframes ermMbFabPulse {
        0% { box-shadow: 0 0 0 0 rgba(254, 240, 138, 0.8); }
        70% { box-shadow: 0 0 0 8px rgba(254, 240, 138, 0); }
        100% { box-shadow: 0 0 0 0 rgba(254, 240, 138, 0); }
    }

    .erm-mbfab-track {
        width: 48px;
        height: 6px;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.28);
        overflow: hidden;
        display: inline-block;
    }

    .erm-mbfab-track > span {
        display: block;
        height: 100%;
        width: 0%;
        border-radius: 999px;
        background: #ffffff;
        transition: width 0.35s ease;
    }

    #ermModalBerkasFloatPanel {
        width: min(420px, calc(100vw - 24px));
        max-height: min(70vh, 560px);
        background: #ffffff;
        border: 1px solid #cbd5e1;
        border-radius: 14px;
        box-shadow: 0 20px 50px rgba(15, 23, 42, 0.28);
        display: flex;
        flex-direction: column;
        overflow: hidden;
        animation: ermMbSlideUp 0.18s ease-out;
    }

    @keyframes ermMbSlideUp {
        from { opacity: 0; transform: translateY(10px) scale(0.98); }
        to { opacity: 1; transform: translateY(0) scale(1); }
    }

    .erm-mbpanel-hdr {
        background: linear-gradient(135deg, #0f172a, #1e3a8a);
        color: #ffffff;
        padding: 11px 14px;
    }

    .erm-mbpanel-progress-track {
        height: 7px;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.22);
        overflow: hidden;
        margin-top: 7px;
    }

    .erm-mbpanel-progress-fill {
        height: 100%;
        width: 0%;
        border-radius: 999px;
        background: #4ade80;
        transition: width 0.4s ease, background 0.25s ease;
    }

    .erm-mbpanel-body {
        flex: 1 1 auto;
        overflow-y: auto;
        padding: 9px 11px;
        background: #f1f5f9;
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .erm-mbpanel-item {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-left: 4px solid #dc2626;
        border-radius: 9px;
        padding: 7px 10px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
        font-size: 11.5px;
    }

    .erm-mbpanel-item.is-ok {
        border-left-color: #16a34a;
    }

    .erm-mbpanel-item.is-partial {
        border-left-color: #d97706;
    }

    .erm-mbpanel-item.is-opt {
        border-left-color: #94a3b8;
    }

    @media (max-width: 767.98px) {
        #ermModalBerkasFloatWrap {
            right: 10px;
            bottom: 54px;
        }
        #ermModalBerkasFloatPanel {
            width: calc(100vw - 20px);
        }
    }

    /* Split Body Layout: Left Tab Rail + Right Main Workspace */
    #modalSoapRanap .modal-body {
        padding: 0 !important;
        display: flex;
        flex-direction: row;
        overflow: hidden;
        min-height: 0;
        background-color: #f4f6f9;
    }

    /* Left Vertical Tab Navigation Rail (Desktop >= 992px) */
    #modalSoapRanap .erm-tab-bar-wrap {
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

    #modalSoapRanap .erm-rail-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 12px 8px 12px;
        border-bottom: 1px solid #f1f5f9;
        gap: 6px;
        flex-shrink: 0;
    }

    #modalSoapRanap .erm-rail-title {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        color: #64748b;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    #modalSoapRanap .erm-rail-toggle-btn {
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

    #modalSoapRanap .erm-rail-toggle-btn:hover {
        background: #eff6ff;
        border-color: #bfdbfe;
        color: #2563eb;
    }

    #modalSoapRanap #tab-soap-ranap {
        display: flex;
        flex-direction: column;
        flex-wrap: nowrap;
        overflow-y: auto;
        overflow-x: hidden;
        flex: 1 1 auto;
        gap: 3px;
        border-bottom: 0;
        padding: 8px;
        margin-top: 0 !important;
        scrollbar-width: thin;
        -webkit-overflow-scrolling: touch;
    }

    #modalSoapRanap #tab-soap-ranap::-webkit-scrollbar {
        width: 4px;
        height: 4px;
    }

    #modalSoapRanap #tab-soap-ranap::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 999px;
    }

    #modalSoapRanap .erm-rail-group-label {
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.7px;
        color: #94a3b8;
        padding: 8px 10px 3px 10px;
        list-style: none;
        user-select: none;
    }

    #modalSoapRanap .erm-rail-group-label:first-child {
        padding-top: 2px;
    }

    #modalSoapRanap #tab-soap-ranap > .nav-item {
        flex: 0 0 auto;
        width: 100%;
    }

    #modalSoapRanap #tab-soap-ranap .nav-link {
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

    /* Pastikan e.target pada click handler tab selalu menunjuk ke <button class="nav-link"> */
    #modalSoapRanap #tab-soap-ranap .nav-link > * {
        pointer-events: none;
    }

    #modalSoapRanap #tab-soap-ranap .nav-link i {
        font-size: 14px;
        width: 18px;
        text-align: center;
        flex-shrink: 0;
    }

    #modalSoapRanap #tab-soap-ranap .nav-link .erm-tab-label {
        overflow: hidden;
        text-overflow: ellipsis;
    }

    #modalSoapRanap #tab-soap-ranap .nav-link:hover {
        background-color: #f1f5f9;
        color: #0f172a;
    }

    #modalSoapRanap #tab-soap-ranap .nav-link.active {
        background-color: #2563eb;
        color: #ffffff;
        border-color: #2563eb;
        box-shadow: 0 2px 6px rgba(37, 99, 235, 0.25);
    }

    /* Collapsed Mini Icon Rail Mode (Desktop) */
    #modalSoapRanap.erm-rail-collapsed .erm-tab-bar-wrap {
        width: 58px;
        flex: 0 0 58px;
    }

    #modalSoapRanap.erm-rail-collapsed .erm-rail-header {
        justify-content: center;
        padding: 10px 6px 8px 6px;
    }

    #modalSoapRanap.erm-rail-collapsed .erm-rail-title,
    #modalSoapRanap.erm-rail-collapsed .erm-rail-group-label,
    #modalSoapRanap.erm-rail-collapsed #tab-soap-ranap .nav-link .erm-tab-label {
        display: none;
    }

    #modalSoapRanap.erm-rail-collapsed #tab-soap-ranap {
        padding: 8px 6px;
    }

    #modalSoapRanap.erm-rail-collapsed #tab-soap-ranap .nav-link {
        justify-content: center;
        padding: 9px 0;
        gap: 0;
    }

    #modalSoapRanap.erm-rail-collapsed #tab-soap-ranap .nav-link i {
        font-size: 16px;
    }

    /* Right Main Content Workspace (Independent Scroll) */
    #modalSoapRanap .erm-ranap-workspace {
        flex: 1 1 auto;
        min-width: 0;
        overflow-y: auto;
        overflow-x: hidden;
        background-color: #f4f6f9;
        padding: 14px 16px;
    }

    #modalSoapRanap .erm-section-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 12px 14px;
        margin-bottom: 12px;
        box-shadow: 0 1px 2px rgba(15, 23, 42, 0.03);
    }

    #modalSoapRanap .erm-section-title {
        font-size: 12px;
        font-weight: 700;
        color: #1e293b;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 6px;
        margin-bottom: 10px;
        padding-bottom: 6px;
        border-bottom: 1px dashed #e2e8f0;
    }

    #modalSoapRanap .erm-section-title i {
        color: #2563eb;
        font-size: 14px;
    }

    #modalSoapRanap #myTabContent > .tab-pane {
        padding: 0 !important;
        margin: 0 !important;
    }

    #modalSoapRanap .erm-modal-footer {
        background: #ffffff;
        border-top: 1px solid #e2e8f0;
        padding: 9px 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 8px;
    }

    #modalSoapRanap textarea.form-control {
        resize: vertical;
    }

    /* Tablet & Mobile (< 992px): otomatis berubah menjadi Top Horizontal Scrollable Tab Bar */
    @media (max-width: 991.98px) {
        #modalSoapRanap .modal-body {
            flex-direction: column;
            overflow-y: auto;
        }

        #modalSoapRanap .erm-tab-bar-wrap,
        #modalSoapRanap.erm-rail-collapsed .erm-tab-bar-wrap {
            width: 100%;
            flex: 0 0 auto;
            position: sticky;
            top: 0;
            border-right: 0;
            border-bottom: 1px solid #e2e8f0;
            box-shadow: 0 2px 6px rgba(15, 23, 42, 0.04);
        }

        #modalSoapRanap .erm-rail-header,
        #modalSoapRanap .erm-rail-group-label {
            display: none !important;
        }

        #modalSoapRanap #tab-soap-ranap,
        #modalSoapRanap.erm-rail-collapsed #tab-soap-ranap {
            flex-direction: row;
            overflow-x: auto;
            overflow-y: hidden;
            padding: 6px 10px;
            gap: 4px;
        }

        #modalSoapRanap #tab-soap-ranap > .nav-item {
            width: auto;
        }

        #modalSoapRanap #tab-soap-ranap .nav-link,
        #modalSoapRanap.erm-rail-collapsed #tab-soap-ranap .nav-link {
            width: auto;
            justify-content: flex-start;
            padding: 6px 11px;
            gap: 6px;
        }

        #modalSoapRanap.erm-rail-collapsed #tab-soap-ranap .nav-link .erm-tab-label {
            display: inline !important;
        }

        #modalSoapRanap .erm-ranap-workspace {
            overflow-y: visible;
            padding: 10px;
        }
    }

    @media (max-width: 767.98px) {
        #modalSoapRanap .erm-modal-header {
            padding: 8px 12px;
        }
        #modalSoapRanap .erm-patient-avatar {
            display: none;
        }
        #modalSoapRanap .erm-patient-name {
            font-size: 13px;
        }
        #modalSoapRanap .erm-header-actions {
            width: 100%;
            justify-content: flex-start;
        }
    }
</style>

<div class="modal fade" id="modalSoapRanap" data-bs-focus="false" data-erm-loader="true" data-erm-loading-text="Memuat data pemeriksaan ranap..." tabindex="-1" aria-labelledby="modalSoapRanapLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            {{-- Sticky Patient Identity Header Card (Read-only display spans - zero DOM ID collision) --}}
            <div class="modal-header erm-modal-header">
                <div class="erm-patient-strip">
                    <div class="erm-patient-avatar">
                        <i class="bi bi-hospital"></i>
                    </div>
                    <div class="min-w-0">
                        <div class="d-flex align-items-center flex-wrap gap-2">
                            <span class="erm-patient-name text-truncate" id="ermRanapHdrNmPasien">PEMERIKSAAN RAWAT INAP</span>
                            <span class="badge rounded-pill text-bg-secondary d-none" id="ermRanapHdrPenjab" role="button" onclick="cekStatusBpjsRanapHeader()" title="Klik untuk cek status kepesertaan BPJS Kesehatan" style="font-size: 10.5px; cursor: pointer;"></span>
                            <button type="button" class="erm-bpjs-check-pill d-none" id="btnErmRanapCekBpjs" onclick="cekStatusBpjsRanapHeader()" title="Cek status kepesertaan BPJS Kesehatan (via No. Kartu / NIK)">
                                <i class="bi bi-shield-check" id="ermRanapCekBpjsIcon"></i>
                                <span id="ermRanapCekBpjsText">Cek Status BPJS</span>
                            </button>
                            <span class="badge rounded-pill d-none" id="ermRanapHdrBpjsStatusBadge" role="button" onclick="cekStatusBpjsRanapHeader()" title="Klik untuk refresh / lihat detail kepesertaan BPJS" style="font-size: 10.5px; cursor: pointer;"></span>
                            <span class="badge rounded-pill text-bg-danger d-none" id="ermRanapHdrAlergiBadge" style="font-size: 10.5px;">
                                <i class="bi bi-exclamation-triangle-fill me-1"></i>Alergi: <span id="ermRanapHdrAlergiText"></span>
                            </span>
                            <span class="badge rounded-pill d-none" id="ermRanapHdrEwsBadge" role="button" onclick="$('#tab-ews').trigger('click')" title="Klik untuk melihat tab EWS" style="font-size: 10.5px; cursor: pointer;"></span>
                        </div>
                        <div class="erm-patient-meta">
                            <span class="erm-meta-chip d-none" id="ermRanapHdrNoRmWrap" title="Nomor Rekam Medis"><i class="bi bi-folder2-open text-primary"></i>RM: <span id="ermRanapHdrNoRm">-</span></span>
                            <span class="erm-meta-chip d-none" id="ermRanapHdrNoRawatWrap" title="Nomor Rawat"><i class="bi bi-hash text-secondary"></i><span id="ermRanapHdrNoRawat">-</span></span>
                            <span class="erm-meta-chip d-none" id="ermRanapHdrUmurWrap" title="Tanggal Lahir / Umur"><i class="bi bi-cake2 text-info"></i><span id="ermRanapHdrUmur">-</span></span>
                            <span class="erm-meta-chip d-none" id="ermRanapHdrPjawabWrap" title="Penanggung Jawab / Keluarga"><i class="bi bi-people-fill text-warning"></i>PJ: <span id="ermRanapHdrPjawab">-</span></span>
                            <span class="erm-meta-chip d-none" id="ermRanapHdrKamarWrap" title="Bangsal / Lama Rawat"><i class="bi bi-door-open text-primary"></i><span id="ermRanapHdrKamar">-</span></span>
                            <span class="erm-meta-chip d-none" id="ermRanapHdrDokterWrap" title="Dokter DPJP"><i class="bi bi-person-badge text-success"></i><span id="ermRanapHdrDokter">-</span></span>
                            <span class="erm-meta-chip d-none" id="ermRanapHdrDiagAwalWrap" title="Diagnosa Awal"><i class="bi bi-clipboard2-pulse text-danger"></i>Dx: <span id="ermRanapHdrDiagAwal">-</span></span>
                        </div>
                    </div>
                </div>
                <div class="erm-header-actions">
                    <span data-erm-loader-status class="erm-loader-pill is-idle"></span>
                    <button type="button" id="btnErmRanapBerkasPill" class="btn btn-sm btn-outline-primary d-none d-inline-flex align-items-center gap-1 fw-semibold" onclick="toggleModalBerkasFloatPanel()" title="Buka / tutup panel floating kelengkapan berkas">
                        <i class="bi bi-folder-check"></i>
                        <span id="ermRanapBerkasPillText">Berkas 0%</span>
                    </button>
                    <button type="button" id="btnToggleDetailPasienRanapHdr" class="btn btn-sm btn-outline-secondary d-inline-flex align-items-center justify-content-center gap-1" onclick="toggleDetailPasienRanap()" aria-expanded="false" aria-controls="collapseRanapIdentitas" title="Tampilkan / sembunyikan kartu detail lengkap identitas pasien">
                        <span class="erm-detail-dot" id="ermRanapDetailStatusDot"></span>
                        <i class="bi bi-person-lines-fill"></i>
                        <span id="ermRanapDetailStatusText">Detail Pasien</span>
                        <i class="bi bi-chevron-down ms-1" id="ermRanapDetailChevron" style="font-size: 10px;"></i>
                    </button>
                    <button type="button" class="btn-close ms-1" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>

            <div class="modal-body">
                {{-- Left Vertical Tab Navigation Rail (Desktop >= 992px) / Sticky Top Scrollable Bar (< 992px) --}}
                <div class="erm-tab-bar-wrap">
                    <div class="erm-rail-header">
                        <span class="erm-rail-title"><i class="bi bi-grid-1x2 me-1 text-primary"></i>Menu CPPT</span>
                        <button type="button" class="erm-rail-toggle-btn" id="btnToggleErmRanapRail" onclick="toggleErmRanapRail()" title="Perkecil / Perlebar Menu Samping">
                            <i class="bi bi-layout-sidebar-inset" id="iconToggleErmRanapRail"></i>
                        </button>
                    </div>
                    <ul class="nav nav-tabs" id="tab-soap-ranap" role="tablist">
                        <li class="erm-rail-group-label">Catatan Klinis</li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="tab-soap" data-bs-toggle="tab"
                                data-bs-target="#tab-soap-pane" type="button" role="tab" aria-controls="tab-soap-pane"
                                aria-selected="true" title="SOAP"><i class="bi bi-clipboard2-pulse"></i><span class="erm-tab-label">SOAP</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tabKelengkapanBerkas" data-bs-toggle="tab"
                                data-bs-target="#tabKelengkapanBerkas-pane" type="button" role="tab"
                                aria-controls="tabKelengkapanBerkas-pane" aria-selected="false" title="Kelengkapan Berkas">
                                <i class="bi bi-folder-check"></i><span class="erm-tab-label d-inline-flex align-items-center justify-content-between flex-grow-1 gap-1"><span>Kelengkapan Berkas</span><span class="badge rounded-pill d-none" id="ranapBerkasTabBadge" style="font-size:9.5px;">0/0</span></span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tabSbar" data-bs-toggle="tab" data-bs-target="#tabSbar-pane"
                                type="button" role="tab" aria-controls="tabSbar-pane" aria-selected="false" title="SBAR"><i class="bi bi-chat-left-text"></i><span class="erm-tab-label">SBAR</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-tabel" data-bs-toggle="tab" data-bs-target="#tab-tabel-pane"
                                type="button" role="tab" aria-controls="tab-tabel-pane" aria-selected="false" title="CPPT Ranap"><i class="bi bi-journal-medical"></i><span class="erm-tab-label">CPPT Ranap</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tabPemeriksaanUgd-tabel" data-bs-toggle="tab"
                                data-bs-target="#tabPemeriksaanUgd-pane" type="button" role="tab"
                                aria-controls="tabPemeriksaanUgd-pane" aria-selected="false" title="Pemeriksaan UGD"><i class="bi bi-truck-front"></i><span class="erm-tab-label">Pemeriksaan UGD</span>
                            </button>
                        </li>

                        <li class="erm-rail-group-label">Terapi &amp; Tindakan</li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-resep" data-bs-toggle="tab" data-bs-target="#tab-resep-pane"
                                type="button" role="tab" aria-controls="tab-resep-pane" aria-selected="false" title="Resep"><i class="bi bi-capsule"></i><span class="erm-tab-label">Resep</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-diagnosa" data-bs-toggle="tab"
                                data-bs-target="#tab-diagnosa-pane" type="button" role="tab"
                                aria-controls="tab-diagnosa-pane" aria-selected="false" title="Diagnosa"><i class="bi bi-file-medical"></i><span class="erm-tab-label">Diagnosa</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tabTindakan" data-bs-toggle="tab"
                                data-bs-target="#tabTindakan-pane" type="button" role="tab" aria-controls="tabTindakan-pane"
                                aria-selected="false" title="Tindakan Ranap"><i class="bi bi-bandaid"></i><span class="erm-tab-label">Tindakan Ranap</span>
                            </button>
                        </li>

                        <li class="erm-rail-group-label">Monitoring &amp; Penunjang</li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-grafik" data-bs-toggle="tab" data-bs-target="#tab-grafik-pane"
                                type="button" role="tab" aria-controls="tab-grafik-pane" aria-selected="false" title="Grafik Pasien"><i class="bi bi-graph-up"></i><span class="erm-tab-label">Grafik Pasien</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-ews" data-bs-toggle="tab" data-bs-target="#tab-ews-pane"
                                type="button" role="tab" aria-controls="tab-ews-pane" aria-selected="false" title="EWS"><i class="bi bi-activity"></i><span class="erm-tab-label d-inline-flex align-items-center justify-content-between flex-grow-1 gap-1"><span>EWS</span><span class="badge rounded-pill d-none" id="ranapEwsTabBadge" style="font-size:9.5px;"></span></span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-laboratorium" data-bs-toggle="tab"
                                data-bs-target="#tab-laboratorium-pane" type="button" role="tab"
                                aria-controls="tab-laboratorium-pane" aria-selected="false" title="Laboratorium"><i class="bi bi-eyedropper"></i><span class="erm-tab-label">Laboratorium</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-radiologi" data-bs-toggle="tab"
                                data-bs-target="#tab-radiologi-pane" type="button" role="tab"
                                aria-controls="tab-radiologi-pane" aria-selected="false" title="Radiologi"><i class="bi bi-radioactive"></i><span class="erm-tab-label">Radiologi</span>
                            </button>
                        </li>

                        <li class="erm-rail-group-label">Gizi</li>
                        <li class="nav-item d-none" role="presentation">
                            <button class="nav-link" id="tabAsuhanGiziDewasa" data-bs-toggle="tab"
                                data-bs-target="#tabAsuhanGiziDewasa-pane" type="button" role="tab"
                                aria-controls="tabAsuhanGiziDewasa-pane" aria-selected="false" title="Asuhan Gizi Dewasa"><i class="bi bi-egg-fried"></i><span class="erm-tab-label">Asuhan Gizi Dewasa</span>
                            </button>
                        </li>
                        <li class="nav-item d-none" role="presentation">
                            <button class="nav-link" id="tabAsuhanGiziAnak" data-bs-toggle="tab"
                                data-bs-target="#tabAsuhanGiziAnak-pane" type="button" role="tab"
                                aria-controls="tabAsuhanGiziAnak-pane" aria-selected="false" title="Asuhan Gizi Anak"><i class="bi bi-emoji-smile"></i><span class="erm-tab-label">Asuhan Gizi Anak</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tabAdimeGizi" data-bs-toggle="tab"
                                data-bs-target="#tabAdimeGizi-pane" type="button" role="tab"
                                aria-controls="tabAdimeGizi-pane" aria-selected="false" title="ADIME Gizi"><i class="bi bi-clipboard2-check"></i><span class="erm-tab-label">ADIME Gizi</span>
                            </button>
                        </li>
                    </ul>
                </div>

                {{-- Right Main Workspace: Collapsible Patient Identity Card (#formInfoPasien intact & reusable across all tabs!) + Tab Panes --}}
                <div class="erm-ranap-workspace" id="ermRanapWorkspace">
                    {{-- Collapsible Detail Identitas Pasien Card: Menjaga seluruh input #formInfoPasien (no_rawat, no_rkm_medis, dpjp, kamar, dll.) selalu aktif & reusable untuk semua tab --}}
                    <div class="collapse" id="collapseRanapIdentitas">
                        <div class="erm-section-card border-primary-subtle">
                            <div class="erm-section-title">
                                <span><i class="bi bi-person-vcard me-1"></i>Identitas &amp; Detail Perawatan Pasien</span>
                                <button type="button" class="btn btn-sm btn-link text-muted text-decoration-none p-0" style="font-size: 11px;" onclick="toggleDetailPasienRanap()">
                                    <i class="bi bi-chevron-up me-1"></i>Sembunyikan
                                </button>
                            </div>
                            <div class="row g-2" id="formInfoPasien">
                                <div class="col-6 col-md-4 col-lg-2">
                                    <label for="no_rawat" class="form-label mb-1">No. Rawat</label>
                                    <input type="text" class="form-control form-control-sm" id="no_rawat" name="no_rawat"
                                        placeholder="" readonly>
                                </div>
                                <div class="col-12 col-md-8 col-lg-4">
                                    <label for="pasien" class="form-label mb-1">Pasien (No. RM &amp; Nama)</label>
                                    <div class="input-group input-group-sm">
                                        <input type="text" class="form-control" id="no_rkm_medis"
                                            name="no_rkm_medis" placeholder="" readonly>
                                        <input type="text" class="form-control w-50" id="pasien" name="pasien"
                                            placeholder="" readonly>
                                    </div>
                                </div>
                                <div class="col-6 col-md-4 col-lg-2">
                                    <label for="tgl_lahir" class="form-label mb-1">Tgl. Lahir / Umur</label>
                                    <input type="text" class="form-control form-control-sm" id="tgl_lahir" name="tgl_lahir"
                                        placeholder="" readonly>
                                </div>
                                <div class="col-6 col-md-4 col-lg-2">
                                    <label for="p_jawab" class="form-label mb-1">Keluarga / PJ</label>
                                    <x-input id="p_jawab" name="p_jawab" />
                                </div>
                                <div class="col-6 col-md-4 col-lg-2">
                                    <label for="kamar" class="form-label mb-1">Kamar / Lama</label>
                                    <x-input-group>
                                        <x-input id="kamar" name="kamar" readonly class="w-50" />
                                        <x-input id="lama" name="lama" readonly />
                                    </x-input-group>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label for="penjab" class="form-label mb-1">Pembiayaan / No. Kartu</label>
                                    <x-input-group>
                                        <x-input id="penjab" name="penjab" readonly class="w-50" />
                                        <x-input id="no_kartu" name="no_kartu" readonly />
                                    </x-input-group>
                                </div>
                                <div class="col-6 col-md-3 col-lg-4">
                                    <label for="diagnosa_awal" class="form-label mb-1">Diagnosa Awal</label>
                                    <x-input id="diagnosa_awal" name="diagnosa_awal" readonly />
                                </div>
                                <div class="col-6 col-md-3 col-lg-4">
                                    <label for="dokter_dpjp" class="form-label mb-1">Dokter DPJP</label>
                                    <input type="text" class="form-control form-control-sm" id="dokter_dpjp" name="dokter_dpjp"
                                        placeholder="" readonly>
                                    <input type="hidden" id="kd_dokter_dpjp" name="kd_dokter_dpjp">
                                    <input type="hidden" id="kd_sps_dokter" name="kd_sps_dokter">
                                    <input type="hidden" id="status_lanjut" name="status_lanjut">
                                    <input type="hidden" name="umur">
                                    <input type="hidden" name="kelasHarga">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade" id="tabPemeriksaanUgd-pane" role="tabpanel"
                            aria-labelledby="tabPemeriksaanUgd-tabel" tabindex="0">
                            <div class="erm-section-card">
                                @include('content.ugd.modal.pemeriksaan.data')
                            </div>
                        </div>
                        <div class="tab-pane fade show active" id="tab-soap-pane" role="tabpanel"
                            aria-labelledby="tab-soap" tabindex="0">
                            @include('content.ranap.modal.cppt._form_soap')
                        </div>
                        <div class="tab-pane fade" id="tabKelengkapanBerkas-pane" role="tabpanel"
                            aria-labelledby="tabKelengkapanBerkas" tabindex="0">
                            <div class="erm-section-card">
                                @include('content.ranap.modal.cppt._kelengkapan_berkas')
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tabSbar-pane" role="tabpanel" aria-labelledby="tabSbar"
                            tabindex="0">
                            <div class="erm-section-card">
                                @include('content.ranap.modal.cppt._sbar')
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-tabel-pane" role="tabpanel" aria-labelledby="tab-tabel"
                            tabindex="0">
                            <div class="erm-section-card">
                                @include('content.ranap.modal.cppt._table_soap')
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-diagnosa-pane" role="tabpanel" aria-labelledby="tab-diagnosa"
                            tabindex="0">
                            <div class="erm-section-card">
                                @include('content.ranap.modal.cppt._form_diagnosa')
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tabTindakan-pane" role="tabpanel"
                            aria-labelledby="tabTindakan" tabindex="0">
                            <div class="erm-section-card">
                                <div class="row gy-2">
                                    <div class="col-lg-7 col-xl-6 col-md-12 col-sm-12">
                                        <ul class="nav nav-tabs nav-tabs-expand" id="groupTindakan" role="tablist">
                                            <li class="nav-item" role="presentation" id="tabTindakanDokter">
                                                <button class="nav-link" id="btnTabTindakanDokterRanap" data-bs-toggle="tab"
                                                    data-bs-target="#targetTindakanDokterRanap" type="button" role="tab"
                                                    aria-controls="targetTindakanDokter" aria-selected="false">Tindakan
                                                    Dokter
                                                </button>
                                            </li>
                                            <li class="nav-item" role="presentation" id="tabTindakanPerawatRanap">
                                                <button class="nav-link" id="btnTabTindakanPerawatRanap" data-bs-toggle="tab"
                                                    data-bs-target="#targetTindakanPerawatRanap" type="button" role="tab"
                                                    aria-controls="targetTindakanPerawat" aria-selected="false">Tindakan
                                                    Perawat
                                                </button>
                                            </li>
                                            <li class="nav-item" role="presentation" id="tabTindakanDokterPerawat">
                                                <button class="nav-link" id="btnTabTindakanDokterPerawatRanap"
                                                    data-bs-toggle="tab" data-bs-target="#targetTindakanDokterPerawatRanap"
                                                    type="button" role="tab" aria-controls="targetTindakanDokterPerawat"
                                                    aria-selected="false">Tindakan
                                                    Dokter &amp; Perawat
                                                </button>
                                            </li>
                                        </ul>
                                        <div class="tab-content" id="contentTabTindakan">
                                            <div class="tab-pane fade p-2" id="targetTindakanDokterRanap" role="tabpanel"
                                                aria-labelledby="tabTindakanDokterRanap" tabindex="0">
                                                @include('content.ranap.modal.tindakan.tindakan_ranap_dr')
                                            </div>
                                            <div class="tab-pane fade p-2" id="targetTindakanPerawatRanap" role="tabpanel"
                                                aria-labelledby="tabTindakanPerawatRanapRanap" tabindex="0">
                                                @include('content.ranap.modal.tindakan.tindakan_ranap_pr')
                                            </div>
                                            <div class="tab-pane fade p-2" id="targetTindakanDokterPerawatRanap" role="tabpanel"
                                                aria-labelledby="tabTindakanDokterPerawatRanap" tabindex="0">
                                                @include('content.ranap.modal.tindakan.tindakan_ranap_drpr')
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-xl-6 col-md-12 col-sm-12 p-2">
                                        @include('content.ranap.modal.tindakan.tabel_tindakan')
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="tab-ews-pane" role="tabpanel" aria-labelledby="tab-ews"
                            tabindex="0">
                            <div class="erm-section-card">
                                @include('content.ranap.modal.cppt._ewsRanap')
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-resep-pane" role="tabpanel" aria-labelledby="tab-resep"
                            tabindex="0">
                            <div class="row g-3">
                                <div class="col-sm-12 col-lg-5">
                                    @include('content.poliklinik.modal.pemeriksaan.resepRalan')
                                </div>
                                <div class="col-sm-12 col-lg-7">
                                    <div class="card">
                                        <div class="card-header fw-semibold">
                                            Resep Rawat Inap
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-hover table-striped table-bordered tbResepRawatInap">
                                                    <thead>
                                                        <tr>
                                                            <th>Tgl. &amp; Jam Resep</th>
                                                            <th>No. Resep</th>
                                                            <th>Non-Racikan</th>
                                                            <th>Racikan</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody></tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-laboratorium-pane" role="tabpanel"
                            aria-labelledby="tab-laboratorium" tabindex="0">
                            <div class="erm-section-card">
                                <div id="hasilPermintaanLabSoap"></div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-radiologi-pane" role="tabpanel"
                            aria-labelledby="tab-radiologi" tabindex="0">
                            <div class="erm-section-card">
                                <div id="hasilPermintaanRadiologiSoap"></div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-grafik-pane" role="tabpanel" aria-labelledby="tab-grafik"
                            tabindex="0">
                            <div class="erm-section-card">
                                @include('content.ranap.modal.cppt._grafikPemeriksaan')
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tabAsuhanGiziDewasa-pane" role="tabpanel"
                            aria-labelledby="tabAsuhanGiziDewasa" tabindex="0">
                            <div class="erm-section-card">
                                @include('content.ranap.modal.cppt._formAsuhanGiziDewasa')
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tabAsuhanGiziAnak-pane" role="tabpanel"
                            aria-labelledby="tabAsuhanGiziAnak" tabindex="0">
                            <div class="erm-section-card">
                                @include('content.ranap.modal.cppt._formAsuhanGiziAnak')
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tabAdimeGizi-pane" role="tabpanel" aria-labelledby="tabAdimeGizi"
                            tabindex="0">
                            <div class="erm-section-card">
                                @include('content.ranap.modal.cppt._adimeGizi')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer erm-modal-footer">
                <div class="small text-muted d-flex align-items-center gap-2">
                    <i class="bi bi-layers text-primary"></i>
                    <span>Tab aktif: <strong class="text-dark" id="ermRanapFooterTabLabel">SOAP</strong></span>
                </div>
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal" style="font-size: 12px"><i
                        class="bi bi-x-circle"></i> Keluar
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Floating Kelengkapan Berkas di Kanan Bawah Melayang di Atas #modalSoapRanap (z-index: 1065) --}}
<div id="ermModalBerkasFloatWrap" class="d-none">
    <div id="ermModalBerkasFloatPanel" class="d-none" role="region" aria-label="Floating Checklist Kelengkapan Berkas">
        <div class="erm-mbpanel-hdr">
            <div class="d-flex align-items-center justify-content-between gap-2">
                <div class="min-w-0">
                    <div class="fw-bold d-flex align-items-center gap-1" style="font-size: 12.5px;">
                        <i class="bi bi-folder-check text-warning"></i>
                        <span>Kelengkapan Berkas</span>
                        <span class="badge bg-white bg-opacity-25 text-white" id="ermModalBerkasTipe" style="font-size: 9.5px;">-</span>
                    </div>
                    <div class="text-white-50" style="font-size: 10.5px;" id="ermModalBerkasRatio">Memeriksa berkas...</div>
                </div>
                <div class="d-flex align-items-center gap-1 flex-shrink-0">
                    <span class="fw-bold me-1" id="ermModalBerkasPct" style="font-size: 14px;">0%</span>
                    <button type="button" class="btn btn-sm btn-outline-light py-0 px-2" onclick="loadKelengkapanBerkasRanap()" title="Muat Ulang">
                        <i class="bi bi-arrow-clockwise" id="ermModalBerkasRefreshIco"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-light py-0 px-2" onclick="toggleModalBerkasFloatPanel(false)" title="Perkecil">
                        <i class="bi bi-dash-lg"></i>
                    </button>
                </div>
            </div>
            <div class="erm-mbpanel-progress-track">
                <div class="erm-mbpanel-progress-fill" id="ermModalBerkasBarFill"></div>
            </div>
        </div>

        <div class="p-2 bg-light border-bottom d-flex align-items-center justify-content-between gap-2 flex-wrap">
            <div class="btn-group btn-group-sm" role="group">
                <button type="button" class="btn btn-primary py-0 px-2 erm-mbflt-btn" data-flt="all" onclick="setModalBerkasFloatFilter('all', this)" style="font-size: 10.5px;">Semua</button>
                <button type="button" class="btn btn-outline-secondary py-0 px-2 erm-mbflt-btn" data-flt="missing" onclick="setModalBerkasFloatFilter('missing', this)" style="font-size: 10.5px;">Belum Diisi</button>
                <button type="button" class="btn btn-outline-secondary py-0 px-2 erm-mbflt-btn" data-flt="done" onclick="setModalBerkasFloatFilter('done', this)" style="font-size: 10.5px;">Lengkap</button>
            </div>
            <button type="button" class="btn btn-link btn-sm text-decoration-none p-0 fw-semibold" style="font-size: 10.5px;" onclick="toggleModalBerkasFloatPanel(false); bootstrap.Tab.getOrCreateInstance(document.getElementById('tabKelengkapanBerkas')).show();">
                <i class="bi bi-arrows-fullscreen me-1"></i>Tab Penuh
            </button>
        </div>

        <div class="erm-mbpanel-body" id="ermModalBerkasFloatBody">
            <div class="text-center text-muted py-4 small">
                <span class="spinner-border spinner-border-sm me-1"></span> Memeriksa kelengkapan berkas...
            </div>
        </div>
    </div>

    <button type="button" id="btnErmModalBerkasFab" onclick="toggleModalBerkasFloatPanel()" title="Cek Kelengkapan Berkas Pasien">
        <span class="erm-mbfab-dot"></span>
        <i class="bi bi-folder-check"></i>
        <span>Berkas</span>
        <span class="erm-mbfab-track"><span id="ermMbFabTrackFill"></span></span>
        <span class="badge rounded-pill bg-white text-dark fw-bold px-2" id="ermMbFabPctBadge">0%</span>
    </button>
</div>

{{-- <div class="modal fade" id="modalLogTracker" tabindex="-1" aria-labelledby="modalLogTrackerLabel" --}} {{--
    aria-hidden="true"> --}}
{{-- <div class="modal-dialog modal-xg modal-dialog-centered modal-dialog-scrollable"> --}}
{{-- <div class="modal-content"> --}}
{{-- <div class="modal-header"> --}}
{{-- <h5 class="modal-title fs-5" id="modalLogTrackerLabel">Catatan Pelaksanaan Edukasi Pasien</h5> --}}
{{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
{{-- </div> --}}
{{-- <div class="modal-body"> --}}

{{-- </div> --}}

{{-- </div> --}}
{{-- </div> --}}
{{-- </div> --}}
@include('content.poliklinik.modal.modal_resep')
@include('content.ranap.modal.modal_audit_log')
@push('script')
    <script>
        let no_rawat_soap = '';
        const tglSoap1 = '';
        const tglSoap2 = '';
        let getInstance = '';
        let sel = '';

        const formSoapRanap = $('#formSoapRanap')

        const tabSoapRanap = document.querySelector('#tab-soap')
        const modalSoapRanap = $('#modalSoapRanap')

        const departemen = "{{ session()->get('pegawai')->departemen }}";
        const formInfoPasien = $('#formInfoPasien')
        const tabLaboratorium = $('#tab-laboratorium')
        const tabRadiologi = $('#tab-radiologi')

        function setDetailPasienRanapButtonState(isOpen) {
            const btn = $('#btnToggleDetailPasienRanapHdr');
            btn.attr('aria-expanded', isOpen ? 'true' : 'false');
            if (isOpen) {
                btn.addClass('is-open');
                $('#ermRanapDetailStatusText').text('Detail: Tampil');
                $('#ermRanapDetailChevron').removeClass('bi-chevron-down').addClass('bi-chevron-up');
            } else {
                btn.removeClass('is-open');
                $('#ermRanapDetailStatusText').text('Detail Pasien');
                $('#ermRanapDetailChevron').removeClass('bi-chevron-up').addClass('bi-chevron-down');
            }
        }

        function toggleDetailPasienRanap() {
            const collapseEl = document.getElementById('collapseRanapIdentitas');
            if (!collapseEl) return;
            const bsCollapse = bootstrap.Collapse.getOrCreateInstance(collapseEl, { toggle: false });
            bsCollapse.toggle();
            if (!collapseEl.classList.contains('show')) {
                $('#ermRanapWorkspace').animate({ scrollTop: 0 }, 200);
            }
        }

        function applyErmRanapRailState(collapsed) {
            const modal = $('#modalSoapRanap');
            const icon = $('#iconToggleErmRanapRail');
            if (collapsed) {
                modal.addClass('erm-rail-collapsed');
                icon.removeClass('bi-layout-sidebar-inset').addClass('bi-layout-sidebar');
                $('#btnToggleErmRanapRail').attr('title', 'Perlebar Menu Samping');
            } else {
                modal.removeClass('erm-rail-collapsed');
                icon.removeClass('bi-layout-sidebar').addClass('bi-layout-sidebar-inset');
                $('#btnToggleErmRanapRail').attr('title', 'Perkecil Menu Samping (Mode Ikon)');
            }
        }

        function toggleErmRanapRail() {
            const nextCollapsed = !$('#modalSoapRanap').hasClass('erm-rail-collapsed');
            applyErmRanapRailState(nextCollapsed);
            try {
                localStorage.setItem('erm_ranap_soap_rail_collapsed', nextCollapsed ? '1' : '0');
            } catch (err) {}
        }

        function syncModalSoapRanapAlergi(alergiVal) {
            const val = (alergiVal || '').toString().trim();
            const lower = val.toLowerCase();
            if (val && val !== '-' && lower !== 'tidak ada' && lower !== 'tidak' && lower !== 'none') {
                $('#ermRanapHdrAlergiText').text(val);
                $('#ermRanapHdrAlergiBadge').removeClass('d-none');
            } else {
                $('#ermRanapHdrAlergiText').text('');
                $('#ermRanapHdrAlergiBadge').addClass('d-none');
            }
        }

        function syncModalSoapRanapHeader(response, no_rawat) {
            if (!response) return;
            const pasien = response.pasien || {};
            const nmPasien = pasien.nm_pasien ? `${pasien.nm_pasien}${pasien.jk ? ' (' + pasien.jk + ')' : ''}` : 'PEMERIKSAAN RAWAT INAP';
            $('#ermRanapHdrNmPasien').text(nmPasien);

            if (response.no_rkm_medis) {
                $('#ermRanapHdrNoRm').text(response.no_rkm_medis);
                $('#ermRanapHdrNoRmWrap').removeClass('d-none');
            }
            if (no_rawat) {
                $('#ermRanapHdrNoRawat').text(no_rawat);
                $('#ermRanapHdrNoRawatWrap').removeClass('d-none');
            }
            if (pasien.tgl_lahir) {
                $('#ermRanapHdrUmur').text(`${formatTanggal(pasien.tgl_lahir)} / ${hitungUmur(pasien.tgl_lahir)}`);
                $('#ermRanapHdrUmurWrap').removeClass('d-none');
            }

            const pJawab = (response.p_jawab || '').toString().trim();
            if (pJawab && pJawab !== '-') {
                const hub = (response.hubunganpj || '').toString().trim();
                const pjLabel = (hub && hub !== '-') ? `${pJawab} (${hub})` : pJawab;
                $('#ermRanapHdrPjawab').text(pjLabel);
                $('#ermRanapHdrPjawabWrap').attr('title', `Penanggung Jawab / Keluarga: ${pjLabel}`).removeClass('d-none');
            } else {
                $('#ermRanapHdrPjawabWrap').addClass('d-none');
            }

            if (response.dokter && response.dokter.nm_dokter) {
                $('#ermRanapHdrDokter').text(response.dokter.nm_dokter);
                $('#ermRanapHdrDokterWrap').removeClass('d-none');
            }

            if (Array.isArray(response.kamar_inap) && response.kamar_inap.length > 0) {
                const latestKamar = response.kamar_inap[response.kamar_inap.length - 1];
                const nmBangsal = latestKamar?.kamar?.bangsal?.nm_bangsal || '-';
                const lamaHari = latestKamar?.tgl_masuk ? `${hitungLamaHari(latestKamar.tgl_masuk)} Hari` : '';
                $('#ermRanapHdrKamar').text(lamaHari ? `${nmBangsal} (${lamaHari})` : nmBangsal);
                $('#ermRanapHdrKamarWrap').removeClass('d-none');

                const dxAwal = (latestKamar?.diagnosa_awal || '').toString().trim();
                if (dxAwal && dxAwal !== '-') {
                    $('#ermRanapHdrDiagAwal').text(dxAwal);
                    $('#ermRanapHdrDiagAwalWrap').attr('title', `Diagnosa Awal: ${dxAwal}`).removeClass('d-none');
                } else {
                    $('#ermRanapHdrDiagAwalWrap').addClass('d-none');
                }
            } else {
                $('#ermRanapHdrKamarWrap').addClass('d-none');
                $('#ermRanapHdrDiagAwalWrap').addClass('d-none');
            }

            const pngJawab = (response.penjab && response.penjab.png_jawab) ? response.penjab.png_jawab : '';
            const isBpjs = pngJawab.toUpperCase().includes('BPJS');
            if (pngJawab) {
                $('#ermRanapHdrPenjab')
                    .text(pngJawab)
                    .removeClass('d-none text-bg-secondary text-bg-success text-bg-danger')
                    .addClass(isBpjs ? 'text-bg-success' : 'text-bg-danger');
            }

            window._ermRanapHdrPasienBpjs = {
                no_peserta: (pasien.no_peserta || '').toString().trim(),
                no_ktp: (pasien.no_ktp || '').toString().trim(),
                is_umum: !isBpjs,
                png_jawab: pngJawab,
            };

            $('#ermRanapHdrBpjsStatusBadge').addClass('d-none').text('');
            $('#btnErmRanapCekBpjs').removeClass('d-none').prop('disabled', false);
            $('#ermRanapCekBpjsIcon').attr('class', 'bi bi-shield-check');
            $('#ermRanapCekBpjsText').text(isBpjs ? 'Cek Status BPJS' : 'Cek Kepesertaan BPJS');
        }

        function cekStatusBpjsRanapHeader() {
            const info = window._ermRanapHdrPasienBpjs || {};
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

            const btn = $('#btnErmRanapCekBpjs');
            btn.prop('disabled', true);
            $('#ermRanapCekBpjsIcon').attr('class', 'spinner-border spinner-border-sm');
            $('#ermRanapCekBpjsText').text('Mengecek BPJS...');

            const finishLoading = () => {
                btn.prop('disabled', false);
                $('#ermRanapCekBpjsIcon').attr('class', 'bi bi-shield-check');
                $('#ermRanapCekBpjsText').text(info.is_umum ? 'Cek Ulang BPJS' : 'Cek Status BPJS');
            };

            const handleBpjsResult = (res, sourceLabel) => {
                const p = res?.response?.peserta || (res?.response && typeof res.response === 'object' ? Object.values(res.response)[0] : null);
                if (res?.metaData?.code == 200 && p) {
                    const isAktif = String(p.statusPeserta?.kode) === '0';
                    const statusKet = p.statusPeserta?.keterangan || (isAktif ? 'AKTIF' : 'NON AKTIF');
                    const kelas = p.hakKelas?.keterangan ? ` (${p.hakKelas.keterangan})` : '';

                    const badge = $('#ermRanapHdrBpjsStatusBadge');
                    badge.removeClass('d-none text-bg-success text-bg-warning text-bg-danger text-bg-secondary');

                    if (isAktif) {
                        badge.addClass('text-bg-success');
                        if (info.is_umum) {
                            badge.html(`<i class="bi bi-check-circle-fill me-1"></i>BPJS: ${statusKet}${kelas} &bull; Bisa Disarankan Pakai BPJS`);
                        } else {
                            badge.html(`<i class="bi bi-check-circle-fill me-1"></i>BPJS: ${statusKet}${kelas}`);
                        }
                    } else {
                        badge.addClass('text-bg-warning text-dark');
                        badge.html(`<i class="bi bi-exclamation-circle-fill me-1"></i>BPJS: ${statusKet}`);
                    }

                    const statusColor = isAktif ? '#16a34a' : '#dc2626';
                    const infoUmumBanner = (isAktif && info.is_umum)
                        ? `<div class="alert alert-info py-2 px-3 small text-start mb-2"><i class="bi bi-info-circle-fill me-1"></i>Pasien terdaftar <strong>UMUM</strong>, namun kepesertaan BPJS Kesehatan <strong>AKTIF</strong> (dicek via ${sourceLabel}).</div>`
                        : '';

                    Swal.fire({
                        title: 'Status Kepesertaan BPJS Kesehatan',
                        width: 540,
                        html: `
                            ${infoUmumBanner}
                            <table class="table table-sm table-bordered text-start small mb-0">
                                <tr><th width="38%">Nama Peserta</th><td>${p.nama || '-'} (${p.sex === 'L' ? 'Laki-laki' : 'Perempuan'})</td></tr>
                                <tr><th>Status</th><td><strong style="color:${statusColor}">${statusKet}</strong></td></tr>
                                <tr><th>No. Kartu / NIK</th><td>${p.noKartu || '-'} / ${p.nik || '-'}</td></tr>
                                <tr><th>Hak Kelas</th><td>${p.hakKelas ? `${p.hakKelas.kode}. ${p.hakKelas.keterangan}` : '-'}</td></tr>
                                <tr><th>Jenis Peserta</th><td>${p.jenisPeserta ? `${p.jenisPeserta.kode}. ${p.jenisPeserta.keterangan}` : '-'}</td></tr>
                                <tr><th>Faskes Tingkat 1</th><td>${p.provUmum ? `${p.provUmum.kdProvider}. ${p.provUmum.nmProvider}` : '-'}</td></tr>
                                <tr><th>TMT / TAT</th><td>${p.tglTMT ? formatTanggal(p.tglTMT) : '-'} s/d ${p.tglTAT ? formatTanggal(p.tglTAT) : '-'}</td></tr>
                            </table>
                        `,
                        confirmButtonText: 'Tutup',
                    });
                    return true;
                }
                return false;
            };

            const checkByNik = () => {
                if (nik.length < 15) {
                    finishLoading();
                    $('#ermRanapHdrBpjsStatusBadge')
                        .removeClass('d-none text-bg-success text-bg-warning text-bg-danger')
                        .addClass('text-bg-secondary')
                        .html('<i class="bi bi-dash-circle me-1"></i>BPJS: Tidak Terdaftar');
                    Swal.fire('Peserta Tidak Ditemukan', 'Pasien tidak terdaftar sebagai peserta BPJS Kesehatan berdasarkan No. Kartu.', 'info');
                    return;
                }

                $.ajax({
                    url: `/erm/bridging/peserta/nik/${nik}/${tanggal}`,
                    dataType: 'JSON',
                    method: 'GET',
                }).done((res) => {
                    finishLoading();
                    if (!handleBpjsResult(res, 'NIK')) {
                        $('#ermRanapHdrBpjsStatusBadge')
                            .removeClass('d-none text-bg-success text-bg-warning text-bg-danger')
                            .addClass('text-bg-secondary')
                            .html('<i class="bi bi-dash-circle me-1"></i>BPJS: Tidak Terdaftar');
                        Swal.fire('Tidak Ditemukan di BPJS', res?.metaData?.message || 'Pasien tidak terdaftar sebagai peserta BPJS Kesehatan (via NIK).', 'info');
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
                        checkByNik();
                    } else {
                        finishLoading();
                        $('#ermRanapHdrBpjsStatusBadge')
                            .removeClass('d-none text-bg-success text-bg-warning text-bg-danger')
                            .addClass('text-bg-secondary')
                            .html('<i class="bi bi-dash-circle me-1"></i>BPJS: Tidak Terdaftar');
                        Swal.fire('Tidak Ditemukan di BPJS', res?.metaData?.message || 'Pasien tidak terdaftar sebagai peserta BPJS Kesehatan.', 'info');
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

        $(document).on('show.bs.collapse', '#collapseRanapIdentitas', function () {
            setDetailPasienRanapButtonState(true);
        });
        $(document).on('hide.bs.collapse', '#collapseRanapIdentitas', function () {
            setDetailPasienRanapButtonState(false);
        });

        $(document).ready(function () {
            try {
                applyErmRanapRailState(localStorage.getItem('erm_ranap_soap_rail_collapsed') === '1');
            } catch (err) {}
        });

        $('#tab-soap-ranap button[data-bs-toggle="tab"]').on('shown.bs.tab', function () {
            const label = $(this).find('.erm-tab-label').text().trim() || $(this).text().trim();
            $('#ermRanapFooterTabLabel').text(label);
            $('#ermRanapWorkspace').scrollTop(0);
            if (typeof this.scrollIntoView === 'function') {
                this.scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' });
            }
        });

        modalSoapRanap.on('hidden.bs.modal', () => {
            const elementInput = $('input');
            if (tabSoapRanap) {
                bootstrap.Tab.getOrCreateInstance(tabSoapRanap).show();
            }
            if (typeof jamSekarang !== 'undefined' && jamSekarang) {
                clearInterval(jamSekarang);
            }
            const collapseEl = document.getElementById('collapseRanapIdentitas');
            if (collapseEl && collapseEl.classList.contains('show')) {
                bootstrap.Collapse.getOrCreateInstance(collapseEl, { toggle: false }).hide();
            }
            setDetailPasienRanapButtonState(false);
            $('#ermRanapHdrBpjsStatusBadge').addClass('d-none').text('');
            $('#ermRanapHdrAlergiBadge').addClass('d-none');
            $('#ermRanapHdrEwsBadge').addClass('d-none').text('');
            $('#ranapEwsTabBadge').addClass('d-none').text('');
            $('#ewsWarningBanner').addClass('d-none').empty();
            $('#ewsLegendBox').addClass('d-none').empty();
            $('#btnErmRanapBerkasPill').addClass('d-none');
            $('#ranapBerkasTabBadge').addClass('d-none');
            $('#ermModalBerkasFloatWrap').addClass('d-none');
            $('#ermModalBerkasFloatPanel').addClass('d-none');
            if (window._ranapBerkasState) {
                window._ranapBerkasState.floatOpen = false;
            }
            $('#ermRanapFooterTabLabel').text('SOAP');

            elementInput.hasClass('is-valid') && elementInput.removeClass('is-valid');
            formAsuhanGiziDewasa.trigger('reset')
            formAsuhanGiziAnak.trigger('reset')
            if (typeof grafikPemeriksaan !== 'undefined' && grafikPemeriksaan) {
                grafikPemeriksaan.destroy();
            }
        })

        tabLaboratorium.on('click', () => {
            const no_rawat = formInfoPasien.find('input[name="no_rawat"]').val();
            const hasilLab = $('#hasilPermintaanLabSoap');
            $.get(`/erm/lab/permintaan`, {
                no_rawat: no_rawat
            }).done((response) => {
                let table = '';

                response.forEach((item) => {
                    table += `
                                                                                                                                <div class="d-flex align-items-center justify-content-between bg-warning p-1" style="font-size:12px">
                                                                                                                                    <div class="p-2 bd-highlight fw-bold">No. Order : ${item.noorder}</div>
                                                                                                                                    <div class="p-2 bd-highlight fw-bold">Diagnosa Klinis : ${item.diagnosa_klinis}</div>
                                                                                                                                    <div class="p-2 bd-highlight fw-bold">Informasi : ${item.informasi_tambahan}</div>
                                                                                                                                    <div class="p-2 bd-highlight fw-bold">Tgl. Permintaan : ${splitTanggal(item.tgl_permintaan)} ${item.jam_permintaan}</div>
                                                                                                                                </div>
                                                                                                                                <table class='table table-bordered table-hover'>
                                                                                                                                    <thead>
                                                                                                                                        <tr>
                                                                                                                                            <td width="">Pemeriksaan</td>
                                                                                                                                            <td width="20%">Hasil</td>
                                                                                                                                            <td width="30%">Nilai Rujukan</td>
                                                                                                                                            <td width="20%">Keterangan</td>
                                                                                                                                        </tr>
                                                                                                                                    </thead>
                                                                                                                                    <tbody>
                                                                                                                                            ${renderHasilPermintaanLab(item.hasil)}

                                                                                                                                            <tr>
                                                                                                                                                <td colspan="4" class="">Dokter PJ. Lab : <strong>${item.hasil.length ? item.hasil[0].dokter.nm_dokter : ''}</strong></td>
                                                                                                                                            </tr>
                                                                                                                                            <tr>
                                                                                                                                                <td colspan="2" class="">Saran : <strong>${item.saran_kesan ? item.saran_kesan.saran : '-'}</strong></td>
                                                                                                                                                <td colspan="2" class="">Kesan : <strong>${item.saran_kesan ? item.saran_kesan.kesan : '-'}</strong></td>
                                                                                                                                            </tr>
                                                                                                                                    </tbody>
                                                                                                                                </table>`

                })

                hasilLab.html(table);

            })
        })

        $('#tabTindakan').on('shown.bs.tab', function() {
            $('#btnTabTindakanDokterRanap').click()
            getTindakanDokterRanap()
            getTindakanPerawatRanap()
            getTindakanDokterPerawatRanap()
        })
        tabRadiologi.on('click', () => {

            const no_rawat = formInfoPasien.find('input[name="no_rawat"]').val();
            const container = $('#hasilPermintaanRadiologiSoap');

            container.html(`
                                                                                                    <div class="text-center py-4">
                                                                                                        <div class="spinner-border text-primary"></div>
                                                                                                        <div class="mt-2">Memuat data radiologi...</div>
                                                                                                    </div>
                                                                                                `);

            $.get('/erm/radiologi/permintaan', {
                no_rawat: no_rawat
            }).done((response) => {

                const data = response.data ?? response;

                if (!data.length) {
                    container.html(`
                                                                                                            <div class="alert alert-warning text-center">
                                                                                                                <i class="bi bi-exclamation-circle"></i>
                                                                                                                Belum ada permintaan radiologi.
                                                                                                            </div>
                                                                                                        `);
                    return;
                }

                let html = '';

                response.forEach((item) => {

                    html += `
                                                                                            <div class="card shadow-sm border-0 mb-4">

                                                                                                <div class="card-header bg-primary text-white">

                                                                                                    <div class="d-flex justify-content-between">

                                                                                                        <div>
                                                                                                            <h6 class="mb-1">
                                                                                                                <i class="bi bi-calendar-event"></i>
                                                                                                                ${formatTanggal(item.tgl_permintaan)}
                                                                                                                ${item.jam_permintaan}
                                                                                                            </h6>

                                                                                                            <small>
                                                                                                                No. Order :
                                                                                                                <strong>${item.noorder}</strong>
                                                                                                            </small>
                                                                                                        </div>

                                                                                                        <span class="badge bg-light text-dark align-self-start">
                                                                                                            ${item.status.toUpperCase()}
                                                                                                        </span>

                                                                                                    </div>

                                                                                                </div>

                                                                                                <div class="card-body">

                                                                                                    <div class="row">

                                                                                                        <div class="col-md-6 mb-3">

                                                                                                            <div class="border rounded p-3 h-100">

                                                                                                                <small class="text-muted">
                                                                                                                    Dokter Perujuk
                                                                                                                </small>

                                                                                                                <div class="fw-semibold">
                                                                                                                    ${item.dokter_rujuk?.nm_dokter ?? '-'}
                                                                                                                </div>

                                                                                                            </div>

                                                                                                        </div>

                                                                                                        <div class="col-md-6 mb-3">

                                                                                                            <div class="border rounded p-3 h-100">

                                                                                                                <small class="text-muted">
                                                                                                                    Diagnosa Klinis
                                                                                                                </small>

                                                                                                                <div class="fw-semibold">
                                                                                                                    ${item.diagnosa_klinis || '-'}
                                                                                                                </div>

                                                                                                            </div>

                                                                                                        </div>

                                                                                                        <div class="col-12 mb-3">

                                                                                                            <div class="border rounded p-3">

                                                                                                                <small class="text-muted">
                                                                                                                    Informasi Medis
                                                                                                                </small>

                                                                                                                <div class="fw-semibold">
                                                                                                                    ${item.informasi_tambahan || '-'}
                                                                                                                </div>

                                                                                                            </div>

                                                                                                        </div>

                                                                                                        <div class="col-12 mb-3">

                                                                                                            <label class="fw-bold text-primary mb-2">

                                                                                                                <i class="bi bi-radioactive"></i>

                                                                                                                Jenis Pemeriksaan

                                                                                                            </label>

                                                                                                            <div>
                                                                                            `;

                    item.permintaan_pemeriksaan.forEach((p) => {

                        html += `
                                                                                                    <span class="badge bg-primary me-2 mb-2 p-2">
                                                                                                        ${p.jns_pemeriksaan.nm_perawatan}
                                                                                                    </span>
                                                                                                `;

                    });

                    html += `
                                                                                                            </div>

                                                                                                        </div>

                                                                                                        <div class="col-12 mb-3">

                                                                                                            <label class="fw-bold text-success mb-2">

                                                                                                                <i class="bi bi-file-earmark-medical"></i>

                                                                                                                Hasil Radiologi

                                                                                                            </label>
                                                                                            `;

                    if (item.hasil_radiologi.length) {

                        item.hasil_radiologi.forEach((hasil) => {

                            html += `
                                                                                                        <div class="alert alert-light border mb-2">

                                                                                                            <pre class="mb-0" style="white-space:pre-wrap;font-family:inherit;">
                                                                                        ${hasil.hasil}
                                                                                                            </pre>

                                                                                                        </div>
                                                                                                    `;

                        });

                    } else {

                        html += `
                                                                                                    <div class="alert alert-warning">
                                                                                                        Belum ada hasil radiologi.
                                                                                                    </div>
                                                                                                `;

                    }

                    html += `
                                                                                                        </div>

                                                                                                        <div class="col-12">

                                                                                                            <label class="fw-bold text-danger mb-2">

                                                                                                                <i class="bi bi-images"></i>

                                                                                                                Gambar Radiologi

                                                                                                            </label>

                                                                                                            <div class="row">
                                                                                            `;

                    if (item.gambar_radiologi.length) {

                        item.gambar_radiologi.forEach((gambar) => {

                            const url = getBaseUrl(`/webapps/radiologi/${gambar.lokasi_gambar}`);

                            html += `
                                                                                                        <div class="col-md-3 col-6 mb-3">

                                                                                                            <div class="card">

                                                                                                                <img
                                                                                                                    src="${url}"
                                                                                                                    class="card-img-top"
                                                                                                                    style="height:180px;object-fit:cover">

                                                                                                                <div class="card-body p-2">

                                                                                                                    <a
                                                                                                                        class="btn btn-success btn-sm w-100"
                                                                                                                        data-magnify="gallery"
                                                                                                                        data-src="${url}">

                                                                                                                        <i class="bi bi-eye"></i>

                                                                                                                        Lihat Gambar

                                                                                                                    </a>

                                                                                                                </div>

                                                                                                            </div>

                                                                                                        </div>
                                                                                                    `;

                        });

                    } else {

                        html += `
                                                                                                    <div class="col-12">

                                                                                                        <div class="alert alert-danger">

                                                                                                            Tidak ada gambar radiologi.

                                                                                                        </div>

                                                                                                    </div>
                                                                                                `;

                    }

                    html += `
                                                                                                            </div>

                                                                                                        </div>

                                                                                                    </div>

                                                                                                </div>

                                                                                            </div>
                                                                                            `;

                });


                container.html(html);

            }).fail(() => {

                container.html(`
                                                                                                        <div class="alert alert-danger text-center">
                                                                                                            Gagal mengambil data radiologi.
                                                                                                        </div>
                                                                                                    `);

            });

        });


        modalSoapRanap.on('shown.bs.modal', () => {
            $('#ermModalBerkasFloatWrap').removeClass('d-none');

            if (departemen === 'CSM' || departemen === '-') {
                $('#tgl_perawatan_ubah').removeAttr('disabled');
                $('#jam_rawat_ubah').removeAttr('disabled');
            } else {
                $('#tgl_perawatan_ubah').attr('disabled', 'true');
                $('#jam_rawat_ubah').attr('disabled', 'true');
            }



            date = new Date()
            const hari = ('0' + (date.getDate())).slice(-2);
            const bulan = ('0' + (date.getMonth() + 1)).slice(-2);
            const tahun = date.getFullYear();
            dateStart = hari + '-' + bulan + '-' + tahun;

            const canvasSuhu = $('#grafik-suhu');

            sel = document.querySelector('#tab-tabel')
            getInstance = sel ? bootstrap.Tab.getOrCreateInstance(sel) : null;
            setDetailPasienRanapButtonState($('#collapseRanapIdentitas').hasClass('show'));
            if (typeof jamSekarang !== 'undefined' && jamSekarang) {
                clearInterval(jamSekarang);
            }
            jamSekarang = setInterval(() => {
                $('#jam_rawat_ubah').val(getJam())
            }, 1000);

            $('#tgl_perawatan_ubah').datepicker({
                format: 'dd-mm-yyyy',
                orientation: 'bottom',
                autoclose: true,
                setDate: dateStart,
            });

            $('#tgl_perawatan_ubah').datepicker('setDate', dateStart)
        })

        function showModalSoapRanap(no_rawat) {
            var formInfoPasien = $('#formInfoPasien')

            const formInfoPasienResep = $('#formInfoPasienResep')

            getRegPeriksa(no_rawat).done((response) => {
                formInfoPasien.find('input[name="no_rawat"]').val(no_rawat);
                formInfoPasien.find('input[name="tgl_lahir"]').val(`${formatTanggal(response.pasien.tgl_lahir)} / ${hitungUmur(response.pasien.tgl_lahir)}`);
                formInfoPasien.find('input[name="no_rkm_medis"]').val(response.no_rkm_medis);
                formInfoPasien.find('input[name="p_jawab"]').val(response.p_jawab);
                formInfoPasien.find('input[name="pasien"]').val(`${response.pasien.nm_pasien} (${response.pasien.jk})`);
                formInfoPasien.find('input[name="penjab"]').val(`${response.penjab.png_jawab}`);
                formInfoPasien.find('input[name="no_kartu"]').val(`${response.pasien.no_peserta}`);
                formInfoPasien.find('input[name="umur"]').val(`${response.umurdaftar} ${response.sttsumur}`);
                formInfoPasien.find('input[name="dokter_dpjp"]').val(`${response.dokter.nm_dokter}`);
                formInfoPasien.find('input[name="kd_dokter_dpjp"]').val(`${response.kd_dokter}`);
                formInfoPasien.find('input[name="kd_sps_dokter"]').val(`${response.dokter.kd_sps}`);
                formInfoPasien.find('input[name="status_lanjut"]').val(`${response.status_lanjut}`);

                formInfoPasienResep.find('input[name=no_rawat]').val(no_rawat);
                formInfoPasienResep.find('input[name=kd_dokter]').val(response.kd_dokter);
                formInfoPasienResep.find('input[name=no_rkm_medis]').val(response.no_rkm_medis);
                formInfoPasienResep.find('input[name=status_lanjut]').val(response.status_lanjut?.toLowerCase());

                const kamar = response.kamar_inap.map((item, index) => {
                    formInfoPasien.find('input[name="kamar"]').val(`${item.kamar.bangsal.nm_bangsal}`);
                    formInfoPasien.find('input[name="lama"]').val(`${hitungLamaHari(item.tgl_masuk)} Hari`)
                    formInfoPasien.find('input[name="diagnosa_awal"]').val(item.diagnosa_awal);
                    formInfoPasienResep.find('input[name=kelasHarga]').val(item.kamar?.kelas?.toLowerCase().replace(/\s/g, ''));

                    if (item.kamar.kelas === 'Kelas Utama') {
                        formInfoPasien.find('input[name="kelasHarga"]').val('kelas3');
                    }
                })

                $('#nomor_rawat').val(response.no_rawat);
                $('#nm_pasien').val(response.pasien.nm_pasien + ' (' + hitungUmur(response.pasien.tgl_lahir) + ')');
                $('#formSoapRanap input[name=nik]').val("{{ session()->get('pegawai')->nik }}");
                $('#formSoapRanap input[name=nama]').val("{{ session()->get('pegawai')->nama }}");
                $('#formSoapRanap input[name=spesialis]').val(response.dokter.kd_sps);

                syncModalSoapRanapHeader(response, no_rawat);
                if (typeof loadKelengkapanBerkasRanap === 'function') {
                    loadKelengkapanBerkasRanap(no_rawat);
                }
                if (typeof setEws === 'function' && response.dokter?.kd_sps) {
                    setEws(no_rawat, 'ranap', response.dokter.kd_sps);
                }

                riwayatResep(response.no_rkm_medis);

                const tabAsuhanGiziAnakParent = $('#tabAsuhanGiziAnak').parent()
                const tabAsuhanGiziDewasaParent = $('#tabAsuhanGiziDewasa').parent()

                if (response.dokter.kd_sps === 'S0001') {
                    tabAsuhanGiziAnakParent.addClass('d-none')
                    tabAsuhanGiziDewasaParent.removeClass('d-none')
                    $('.formEws').removeAttr('style');
                    $('.formEws select[name=keluaran_urin]').val('-').change()
                    $('.formEws select[name=proteinuria]').val('-').change()
                    $('.formEws select[name=air_ketuban]').val('-').change()
                    $('.formEws select[name=skala_nyeri]').val('-').change()
                    $('.formEws select[name=lochia]').val('-').change()
                    $('.formEws select[name=terlihat_tidak_sehat]').val('-').change()
                } else {
                    tabAsuhanGiziDewasaParent.addClass('d-none')
                    tabAsuhanGiziAnakParent.removeClass('d-none')
                    $('.formEws').css('display', 'none');
                    $('.formEws select[name=keluaran_urin]').val('').change()
                    $('.formEws select[name=proteinuria]').val('').change()
                    $('.formEws select[name=air_ketuban]').val('')
                    $('.formEws select[name=skala_nyeri]').val('')
                    $('.formEws select[name=lochia]').val('').change()
                    $('.formEws select[name=terlihat_tidak_sehat]').val('').change()
                }

                getDokter("{{ session()->get('pegawai')->nama }}").done((response) => {
                    if (response.length) {
                        $('.btn-tambah-grafik-harin').css('display', 'none')
                    } else {
                        $('.btn-tambah-grafik-harin').css('display', 'inline')
                    }
                })
                $('.btn-tambah-grafik-harin').attr('onclick', 'modalGrafikHarian("' + response.no_rawat + '","' + response.pasien.nm_pasien + ' (' + hitungUmur(response.pasien.tgl_lahir) + ')")');


                $('#formSoapRanap .btn-simpan').attr('data-kd-dokter', response.dokter.kd_dokter);
                $('#formSoapRanap .btn-simpan').attr('data-spesialis', response.dokter.spesialis.nm_sps);
                $('#formSoapRanap .btn-simpan').attr('data-nm-pasien', response.pasien.nm_pasien);

                $('#formSaveGrafikHarian #kdDokter').attr('data-kd-dokter', response.dokter.kd_dokter);
                $('#formSaveGrafikHarian #spesialisDokter').attr('data-spesialis', response.dokter.spesialis.nm_sps);
                $('#formSaveGrafikHarian #nmPasien').attr('data-nm-pasien', response.pasien.nm_pasien);
            })

            $('#modalSoapRanap').modal('toggle')

            tbSoapRanap(no_rawat);
            buildGrafik(no_rawat);
            appendDataGrafikHarian(no_rawat);
        }




        function checkJam() {
            cek = $('#cekJam').is(':checked')
            if (cek) {
                clearInterval(jamSekarang)
            } else {
                jamSekarang = setInterval(() => {
                    $('#jam_rawat_ubah').val(getJam())
                }, 1000);
            }
        }

        $('#cekJam').on('change', function() {
            checkJam();
        })

        $('button[data-bs-target="#tab-resep-pane"]').on('click', function() {
            const formInfoPasienResep = $('#formInfoPasienResep')
            const no_rawat = formInfoPasienResep.find('[name=no_rawat]').val();
            getResepObat(no_rawat)

        })
        $('button[data-bs-target="#tabAdimeGizi-pane"]').on('click', function() {
            const formInfoPasienResep = $('#formInfoPasienResep')
            const no_rawat = formInfoPasienResep.find('[name=no_rawat]').val();
            const formAdimeGizi = $('#formAdimeGizi')
            formAdimeGizi.find('input[name=nip]').val("{{ session()->get('pegawai')->nik }}")
            formAdimeGizi.find('input[name=nm_petugas]').val("{{ session()->get('pegawai')->nama }}")
            formAdimeGizi.find('input[name=tanggal]').val(moment().format('DD-MM-YYYY HH:mm:ss'))
            formAdimeGizi.find('#btnPrintAdime').prop('href', `/erm/ranap/gizi/catatan-adime/print?no_rawat=${no_rawat}`)
            getCatatanAdimeGizi(no_rawat)

        })
    </script>
@endpush
