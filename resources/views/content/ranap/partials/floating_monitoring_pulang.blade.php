{{-- Floating Monitoring Pasien Pulang Ranap (Resume Medis & Surat Kontrol BPJS) --}}
<style>
    #ranapFloatingMonitorWrap {
        position: fixed;
        right: 18px;
        bottom: 18px;
        z-index: 1047;
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 10px;
        font-family: inherit;
    }

    #ranapFloatingMonitorWrap.is-panel-open {
        z-index: 1049;
    }

    #btnRanapMonitorFab {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 9px 14px;
        border-radius: 999px;
        border: 1px solid rgba(15, 23, 42, 0.12);
        background: #0f172a;
        color: #ffffff;
        font-size: 12px;
        font-weight: 600;
        box-shadow: 0 10px 28px rgba(15, 23, 42, 0.25);
        cursor: pointer;
        transition: transform 0.15s ease, box-shadow 0.15s ease, background 0.2s ease;
    }

    #btnRanapMonitorFab:hover {
        transform: translateY(-2px);
        box-shadow: 0 14px 32px rgba(15, 23, 42, 0.32);
    }

    #btnRanapMonitorFab.has-alerts {
        background: linear-gradient(135deg, #b91c1c, #dc2626);
        border-color: rgba(255, 255, 255, 0.25);
    }

    .ranap-fab-pulse {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #4ade80;
        display: inline-block;
    }

    #btnRanapMonitorFab.has-alerts .ranap-fab-pulse {
        background: #fef08a;
        box-shadow: 0 0 0 0 rgba(254, 240, 138, 0.75);
        animation: ranapMonitorPulse 1.6s infinite;
    }

    @keyframes ranapMonitorPulse {
        0% {
            box-shadow: 0 0 0 0 rgba(254, 240, 138, 0.8);
        }

        70% {
            box-shadow: 0 0 0 8px rgba(254, 240, 138, 0);
        }

        100% {
            box-shadow: 0 0 0 0 rgba(254, 240, 138, 0);
        }
    }

    #ranapMonitorPanel {
        width: min(440px, calc(100vw - 24px));
        max-height: min(76vh, 620px);
        background: #ffffff;
        border: 1px solid #cbd5e1;
        border-radius: 14px;
        box-shadow: 0 18px 45px rgba(15, 23, 42, 0.22);
        display: flex;
        flex-direction: column;
        overflow: hidden;
        animation: ranapPanelSlideUp 0.2s ease-out;
    }

    @keyframes ranapPanelSlideUp {
        from {
            opacity: 0;
            transform: translateY(12px) scale(0.98);
        }

        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    @keyframes ranapMonSpin {
        to {
            transform: rotate(360deg);
        }
    }

    .ranap-mon-spin {
        display: inline-block;
        animation: ranapMonSpin 0.8s linear infinite;
    }

    .ranap-mon-header {
        background: linear-gradient(135deg, #0f172a, #1e293b);
        color: #ffffff;
        padding: 11px 14px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
    }

    .ranap-mon-toolbar {
        padding: 8px 12px;
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
        display: flex;
        flex-direction: column;
        gap: 7px;
    }

    .ranap-mon-tabs {
        display: flex;
        flex-wrap: nowrap;
        overflow-x: auto;
        gap: 4px;
        scrollbar-width: none;
    }

    .ranap-mon-tabs::-webkit-scrollbar {
        display: none;
    }

    .ranap-mon-tab-btn {
        border: 1px solid #cbd5e1;
        background: #ffffff;
        color: #475569;
        border-radius: 999px;
        padding: 3px 9px;
        font-size: 11px;
        font-weight: 600;
        white-space: nowrap;
        cursor: pointer;
        transition: all 0.15s ease;
    }

    .ranap-mon-tab-btn.active {
        background: #2563eb;
        border-color: #2563eb;
        color: #ffffff;
    }

    .ranap-mon-body {
        flex: 1 1 auto;
        overflow-y: auto;
        padding: 10px 12px;
        background: #f1f5f9;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .ranap-mon-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-left: 4px solid #dc2626;
        border-radius: 10px;
        padding: 9px 11px;
        box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
        font-size: 11.5px;
    }

    .ranap-mon-card.type-sk {
        border-left-color: #f59e0b;
    }

    .ranap-mon-card.type-resume {
        border-left-color: #ef4444;
    }

    .ranap-mon-card.type-mismatch {
        border-left-color: #7c3aed;
    }

    .ranap-mon-compare {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 6px;
        margin-top: 6px;
        padding: 6px 8px;
        background: #fef2f2;
        border: 1px dashed #fca5a5;
        border-radius: 7px;
        font-size: 11px;
    }

    @media (max-width: 575.98px) {
        #ranapFloatingMonitorWrap {
            right: 10px;
            bottom: 10px;
        }

        #ranapMonitorPanel {
            width: calc(100vw - 20px);
            max-height: 78vh;
        }
    }
</style>

<div id="ranapFloatingMonitorWrap">
    {{-- Panel Floating Monitoring (Expandable) --}}
    <div id="ranapMonitorPanel" class="d-none" role="region" aria-label="Monitoring Pasien Pulang Ranap">
        <div class="ranap-mon-header">
            <div class="min-w-0">
                <div class="fw-bold d-flex align-items-center gap-1" style="font-size: 12.5px;">
                    <i class="bi bi-bell-fill text-warning"></i>
                    <span>Monitoring Pasien Pulang</span>
                </div>
                <div class="text-white-50" style="font-size: 10.5px;" id="ranapMonPeriodeText">
                    Memuat periode...
                </div>
            </div>
            <div class="d-flex align-items-center gap-1 flex-shrink-0">
                <button type="button" class="btn btn-sm btn-outline-light py-0 px-2"
                    onclick="loadMonitoringPulangRanap()" title="Muat Ulang Data">
                    <i class="bi bi-arrow-clockwise" id="ranapMonRefreshIcon"></i>
                </button>
                <button type="button" class="btn btn-sm btn-outline-light py-0 px-2"
                    onclick="toggleRanapMonitorPanel(false)" title="Perkecil Notifikasi">
                    <i class="bi bi-dash-lg"></i>
                </button>
            </div>
        </div>

        <div class="ranap-mon-toolbar">
            {{-- Pilih Rentang Waktu & Search --}}
            <div class="d-flex align-items-center justify-content-between gap-2 flex-wrap">
                <div class="btn-group btn-group-sm" role="group" aria-label="Rentang Monitoring">
                    <button type="button" class="btn btn-outline-secondary py-0 px-2 ranap-mon-range-btn" data-days="1"
                        onclick="setRanapMonitorRange(1)" style="font-size: 10.5px;">Hari Ini</button>
                    <button type="button" class="btn btn-primary py-0 px-2 ranap-mon-range-btn" data-days="3"
                        onclick="setRanapMonitorRange(3)" style="font-size: 10.5px;">3 Hari</button>
                    <button type="button" class="btn btn-outline-secondary py-0 px-2 ranap-mon-range-btn" data-days="7"
                        onclick="setRanapMonitorRange(7)" style="font-size: 10.5px;">7 Hari</button>
                    <button type="button" class="btn btn-outline-secondary py-0 px-2 ranap-mon-range-btn"
                        data-days="filter" onclick="setRanapMonitorRange('filter')" style="font-size: 10.5px;"
                        title="Ikuti tanggal filter Pulang di tabel">Filter Tabel</button>
                </div>
                <input type="search" id="ranapMonSearchInput" class="form-control form-control-sm"
                    style="max-width: 155px; height: 24px; font-size: 11px;" placeholder="Cari pasien / bangsal..."
                    oninput="renderRanapMonitorList()">
            </div>

            {{-- Filter Kategori Masalah --}}
            <div class="ranap-mon-tabs">
                <button type="button" class="ranap-mon-tab-btn active" data-issue="all"
                    onclick="setRanapMonitorTab('all', this)">
                    Semua (<span id="ranapMonCountAll">0</span>)
                </button>
                <button type="button" class="ranap-mon-tab-btn" data-issue="tanggal_tidak_cocok"
                    onclick="setRanapMonitorTab('tanggal_tidak_cocok', this)">
                    Tgl Beda (<span id="ranapMonCountMismatch">0</span>)
                </button>
                <button type="button" class="ranap-mon-tab-btn" data-issue="belum_resume"
                    onclick="setRanapMonitorTab('belum_resume', this)">
                    Blm Resume (<span id="ranapMonCountResume">0</span>)
                </button>
                <button type="button" class="ranap-mon-tab-btn" data-issue="belum_surat_kontrol"
                    onclick="setRanapMonitorTab('belum_surat_kontrol', this)">
                    Blm SKRI (<span id="ranapMonCountSk">0</span>)
                </button>
            </div>
        </div>

        <div class="ranap-mon-body" id="ranapMonListContainer">
            <div class="text-center text-muted py-4 small">
                <span class="spinner-border spinner-border-sm me-1"></span> Memeriksa pasien pulang...
            </div>
        </div>
    </div>

    {{-- Floating Trigger Button (Selalu di Kanan Bawah) --}}
    <button type="button" id="btnRanapMonitorFab" onclick="toggleRanapMonitorPanel()"
        title="Monitoring Resume Medis & Surat Kontrol BPJS Pasien Pulang">
        <span class="ranap-fab-pulse"></span>
        <i class="bi bi-clipboard2-pulse-fill"></i>
        <span>Monitoring Pulang</span>
        <span class="badge rounded-pill bg-white text-danger fw-bold px-2" id="ranapFabTotalBadge">0</span>
    </button>
</div>

@push('script')
    <script>
        window._ranapMonitorState = {
            items: [],
            activeTab: 'all',
            rangeMode: 3, // 1, 3, 7, atau 'filter'
            isOpen: false,
        };

        function escapeMonitorHtml(str) {
            return String(str ?? '')
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#39;');
        }

        function toggleRanapMonitorPanel(forceState) {
            const nextOpen = typeof forceState === 'boolean' ? forceState : !window._ranapMonitorState.isOpen;
            window._ranapMonitorState.isOpen = nextOpen;
            $('#ranapMonitorPanel').toggleClass('d-none', !nextOpen);
            $('#ranapFloatingMonitorWrap').toggleClass('is-panel-open', nextOpen);
            if (nextOpen && typeof toggleRanapBerkasPanel === 'function') {
                toggleRanapBerkasPanel(false);
            }
            if (nextOpen && window._ranapMonitorState.items.length === 0) {
                loadMonitoringPulangRanap();
            }
        }

        function setRanapMonitorRange(mode) {
            window._ranapMonitorState.rangeMode = mode;
            $('.ranap-mon-range-btn').removeClass('btn-primary').addClass('btn-outline-secondary');
            $(`.ranap-mon-range-btn[data-days="${mode}"]`).removeClass('btn-outline-secondary').addClass('btn-primary');
            loadMonitoringPulangRanap();
        }

        function setRanapMonitorTab(tabKey, btnEl) {
            window._ranapMonitorState.activeTab = tabKey;
            $('.ranap-mon-tab-btn').removeClass('active');
            if (btnEl) {
                $(btnEl).addClass('active');
            }
            renderRanapMonitorList();
        }

        function loadMonitoringPulangRanap() {
            const mode = window._ranapMonitorState.rangeMode;
            const params = {
                kd_dokter: typeof kd_dokter !== 'undefined' ? (kd_dokter || '') : '',
                spesialis: typeof sps !== 'undefined' ? (sps || '') : '',
                kamar: typeof kamar !== 'undefined' ? (kamar || '') : '',
            };

            if (mode === 'filter') {
                const a = $('#tgl_pulang_awal').val();
                const b = $('#tgl_pulang_akhir').val();
                if (a && b && typeof splitTanggal === 'function') {
                    params.tgl_pertama = splitTanggal(a);
                    params.tgl_kedua = splitTanggal(b);
                } else {
                    params.days = 3;
                }
            } else {
                params.days = mode;
            }

            $('#ranapMonRefreshIcon').addClass('ranap-mon-spin');

            $.ajax({
                url: '/erm/ranap/monitoring-pulang',
                method: 'GET',
                dataType: 'JSON',
                ermSilent: true,
                data: params,
            }).done(function (res) {
                if (!res || !res.success) return;

                const s = res.summary || {};
                window._ranapMonitorState.items = res.items || [];

                const total = s.total_bermasalah || 0;
                $('#ranapFabTotalBadge').text(total);
                $('#btnRanapMonitorFab').toggleClass('has-alerts', total > 0);

                $('#ranapMonCountAll').text(total);
                $('#ranapMonCountMismatch').text(s.tanggal_tidak_cocok || 0);
                $('#ranapMonCountResume').text(s.belum_resume || 0);
                $('#ranapMonCountSk').text(s.belum_surat_kontrol || 0);

                const awalFmt = res.periode?.awal ? splitTanggal(res.periode.awal) : '-';
                const akhirFmt = res.periode?.akhir ? splitTanggal(res.periode.akhir) : '-';
                $('#ranapMonPeriodeText').text(`Pulang ${awalFmt} s/d ${akhirFmt} • ${s.total_pulang || 0} pasien pulang`);

                renderRanapMonitorList();
            }).fail(function (xhr) {
                if (xhr.status === 401) {
                    alertSessionExpired(xhr.status);
                    return;
                }
                $('#ranapMonListContainer').html(`
                        <div class="alert alert-danger py-2 px-3 small mb-0">
                            <i class="bi bi-exclamation-circle me-1"></i> Gagal memuat monitoring pasien pulang.
                        </div>
                    `);
            }).always(function () {
                $('#ranapMonRefreshIcon').removeClass('ranap-mon-spin');
            });
        }

        function renderRanapMonitorList() {
            const container = $('#ranapMonListContainer');
            const activeTab = window._ranapMonitorState.activeTab;
            const keyword = ($('#ranapMonSearchInput').val() || '').toLowerCase().trim();

            const filtered = (window._ranapMonitorState.items || []).filter(function (item) {
                if (activeTab !== 'all' && !(item.issues || []).includes(activeTab)) {
                    return false;
                }
                if (keyword) {
                    const hay = `${item.nm_pasien} ${item.no_rkm_medis} ${item.no_rawat} ${item.nm_bangsal} ${item.nm_dokter}`.toLowerCase();
                    if (!hay.includes(keyword)) return false;
                }
                return true;
            });

            if (!filtered.length) {
                container.html(`
                        <div class="text-center py-4 bg-white rounded-3 border">
                            <i class="bi bi-check-circle-fill text-success fs-3 d-block mb-1"></i>
                            <div class="fw-semibold text-dark small">Semua Terpantau Lengkap</div>
                            <div class="text-muted" style="font-size: 11px;">Tidak ada temuan pada filter ini.</div>
                        </div>
                    `);
                return;
            }

            const html = filtered.map(function (item) {
                const issues = item.issues || [];
                const isMismatch = issues.includes('tanggal_tidak_cocok');
                const isBelumResume = issues.includes('belum_resume');
                const isBelumSk = issues.includes('belum_surat_kontrol');

                let cardType = 'type-resume';
                if (isMismatch) cardType = 'type-mismatch';
                else if (isBelumSk && !isBelumResume) cardType = 'type-sk';

                let badges = '';
                if (isMismatch) {
                    badges += `<span class="badge text-bg-danger" style="font-size: 10px;"><i class="bi bi-calendar-x me-1"></i>Tgl Kontrol Tidak Cocok</span> `;
                }
                if (isBelumResume) {
                    badges += `<span class="badge bg-danger-subtle text-danger border border-danger-subtle" style="font-size: 10px;"><i class="bi bi-file-earmark-x me-1"></i>Belum Resume Medis</span> `;
                }
                if (isBelumSk) {
                    badges += `<span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle" style="font-size: 10px;"><i class="bi bi-envelope-exclamation me-1"></i>Belum Surat Kontrol BPJS</span> `;
                }

                let compareBox = '';
                if (isMismatch) {
                    const tglRes = item.tgl_kontrol_resume ? splitTanggal(item.tgl_kontrol_resume) : '<em class="text-danger">Kosong</em>';
                    const tglBpjs = item.tgl_kontrol_bpjs ? splitTanggal(item.tgl_kontrol_bpjs) : '-';
                    compareBox = `
                            <div class="ranap-mon-compare">
                                <div>
                                    <div class="text-muted" style="font-size: 10px;">Tgl Kontrol Resume</div>
                                    <div class="fw-bold text-danger">${tglRes}</div>
                                </div>
                                <div>
                                    <div class="text-muted" style="font-size: 10px;">Tgl SKRI BPJS</div>
                                    <div class="fw-bold text-primary">${tglBpjs}</div>
                                </div>
                            </div>
                        `;
                }

                const sepInfo = item.is_bpjs
                    ? (item.no_sep
                        ? `<div class="text-muted mt-1" style="font-size: 10.5px;"><i class="bi bi-link-45deg"></i>SEP: <span class="font-monospace text-dark">${escapeMonitorHtml(item.no_sep)}</span>${item.no_surat_kontrol ? ` &bull; SKRI: <span class="font-monospace text-primary">${escapeMonitorHtml(item.no_surat_kontrol)}</span>` : ''}</div>`
                        : `<div class="text-danger mt-1" style="font-size: 10.5px;"><i class="bi bi-exclamation-triangle me-1"></i>SEP BPJS belum terhubung di reg_periksa</div>`)
                    : '';

                const tglPulangFmt = item.tgl_keluar ? splitTanggal(item.tgl_keluar) : '-';
                const penjabBadge = item.is_bpjs
                    ? `<span class="badge text-bg-success" style="font-size: 9.5px;">${escapeMonitorHtml(item.png_jawab)}</span>`
                    : `<span class="badge text-bg-secondary" style="font-size: 9.5px;">${escapeMonitorHtml(item.png_jawab)}</span>`;

                return `
                        <div class="ranap-mon-card ${cardType}">
                            <div class="d-flex justify-content-between align-items-start gap-2">
                                <div class="min-w-0">
                                    <div class="fw-bold text-dark text-truncate">${escapeMonitorHtml(item.nm_pasien)}</div>
                                    <div class="text-muted" style="font-size: 10.5px;">
                                        RM: <strong>${escapeMonitorHtml(item.no_rkm_medis)}</strong> &bull; ${escapeMonitorHtml(item.no_rawat)}
                                    </div>
                                </div>
                                ${penjabBadge}
                            </div>
                            <div class="text-muted mt-1" style="font-size: 10.5px;">
                                <i class="bi bi-hospital me-1"></i>${escapeMonitorHtml(item.nm_bangsal)} &bull;
                                <i class="bi bi-calendar-check me-1"></i>Pulang: ${tglPulangFmt} (${escapeMonitorHtml(item.stts_pulang)})
                            </div>
                            <div class="text-muted" style="font-size: 10.5px;">
                                <i class="bi bi-person-badge me-1"></i>${escapeMonitorHtml(item.nm_dokter)}
                            </div>
                            <div class="mt-2 d-flex flex-wrap gap-1">${badges}</div>
                            ${compareBox}
                            ${sepInfo}
                            <div class="mt-2 pt-1 border-top d-flex justify-content-end gap-1">
                                <button type="button" class="btn btn-outline-primary btn-sm py-0 px-2" style="font-size: 10.5px;" onclick="bukaResumeDariMonitor('${escapeMonitorHtml(item.no_rawat)}')">
                                    <i class="bi bi-file-text me-1"></i>Buka Resume
                                </button>
                            </div>
                        </div>
                    `;
            }).join('');

            container.html(html);
        }

        function bukaResumeDariMonitor(noRawat) {
            if (typeof resumeMedis === 'function') {
                toggleRanapMonitorPanel(false);
                resumeMedis(noRawat);
            }
        }

        $(document).ready(function () {
            // Load awal setelah tabel ranap jalan
            setTimeout(loadMonitoringPulangRanap, 700);

            // Refresh otomatis jika Resume Medis selesai disimpan/ditutup
            $('#modalResumeRanap').on('hidden.bs.modal', function () {
                loadMonitoringPulangRanap();
            });
        });
    </script>
@endpush