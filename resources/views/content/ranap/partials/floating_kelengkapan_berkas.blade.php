{{-- Floating Sticky Progress Bar di Atas Tabel Ranap + Floating Panel Rincian Kelengkapan Berkas --}}
<style>
    /* Sticky Floating Progress Bar di atas #tb_ranap */
    #ranapBerkasFloatBar {
        position: sticky;
        top: 52px;
        z-index: 25;
        background: rgba(255, 255, 255, 0.96);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid #cbd5e1;
        border-radius: 12px;
        padding: 10px 14px;
        margin-bottom: 12px;
        box-shadow: 0 8px 24px rgba(15, 23, 42, 0.08);
        transition: box-shadow 0.2s ease;
    }

    .ranap-berkas-bar-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 10px;
    }

    .ranap-berkas-progress-wrap {
        flex: 1 1 260px;
        min-width: 200px;
    }

    .ranap-berkas-track {
        height: 10px;
        border-radius: 999px;
        background: #e2e8f0;
        overflow: hidden;
        position: relative;
    }

    .ranap-berkas-fill {
        height: 100%;
        width: 0%;
        border-radius: 999px;
        background: linear-gradient(90deg, #2563eb, #3b82f6);
        transition: width 0.45s cubic-bezier(0.22, 1, 0.36, 1), background 0.3s ease;
    }

    .ranap-berkas-fill.is-high {
        background: linear-gradient(90deg, #16a34a, #22c55e);
    }

    .ranap-berkas-fill.is-mid {
        background: linear-gradient(90deg, #d97706, #f59e0b);
    }

    .ranap-berkas-fill.is-low {
        background: linear-gradient(90deg, #dc2626, #ef4444);
    }

    .ranap-berkas-chips {
        display: flex;
        flex-wrap: nowrap;
        overflow-x: auto;
        gap: 6px;
        margin-top: 9px;
        padding-top: 8px;
        border-top: 1px dashed #e2e8f0;
        scrollbar-width: thin;
    }

    .ranap-berkas-mini-chip {
        flex: 0 0 auto;
        min-width: 112px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 4px 8px;
        font-size: 10.5px;
    }

    .ranap-berkas-mini-track {
        height: 4px;
        border-radius: 999px;
        background: #e2e8f0;
        overflow: hidden;
        margin-top: 3px;
    }

    .ranap-berkas-mini-fill {
        height: 100%;
        border-radius: 999px;
        transition: width 0.4s ease;
    }

    /* Floating Drawer & FAB di Kanan Bawah (di atas Monitoring Pulang, tidak bertumpuk) */
    #ranapFloatingBerkasWrap {
        position: fixed;
        right: 18px;
        bottom: 66px;
        z-index: 1046;
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 10px;
    }

    #btnRanapBerkasFab {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 14px;
        border-radius: 999px;
        border: 1px solid rgba(37, 99, 235, 0.25);
        background: linear-gradient(135deg, #1d4ed8, #2563eb);
        color: #ffffff;
        font-size: 12px;
        font-weight: 600;
        box-shadow: 0 10px 26px rgba(37, 99, 235, 0.28);
        cursor: pointer;
        transition: transform 0.15s ease, box-shadow 0.15s ease;
    }

    #btnRanapBerkasFab:hover {
        transform: translateY(-2px);
        box-shadow: 0 14px 30px rgba(37, 99, 235, 0.36);
    }

    .ranap-fab-mini-bar {
        width: 44px;
        height: 6px;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.28);
        overflow: hidden;
        display: inline-block;
    }

    .ranap-fab-mini-bar > span {
        display: block;
        height: 100%;
        background: #4ade80;
        border-radius: 999px;
        transition: width 0.35s ease;
    }

    #ranapFloatingBerkasPanel {
        width: min(470px, calc(100vw - 24px));
        max-height: min(74vh, 600px);
        background: #ffffff;
        border: 1px solid #cbd5e1;
        border-radius: 14px;
        box-shadow: 0 18px 45px rgba(15, 23, 42, 0.22);
        display: flex;
        flex-direction: column;
        overflow: hidden;
        animation: ranapBerkasSlideUp 0.2s ease-out;
    }

    @keyframes ranapBerkasSlideUp {
        from { opacity: 0; transform: translateY(12px) scale(0.98); }
        to { opacity: 1; transform: translateY(0) scale(1); }
    }

    .ranap-berkas-panel-hdr {
        background: linear-gradient(135deg, #1e3a8a, #2563eb);
        color: #ffffff;
        padding: 11px 14px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
    }

    .ranap-berkas-panel-body {
        flex: 1 1 auto;
        overflow-y: auto;
        padding: 10px 12px;
        background: #f1f5f9;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .ranap-berkas-patient-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-left: 4px solid #2563eb;
        border-radius: 10px;
        padding: 9px 11px;
        font-size: 11.5px;
    }

    .ranap-berkas-patient-card.is-full {
        border-left-color: #16a34a;
    }

    .ranap-berkas-patient-card.is-low {
        border-left-color: #dc2626;
    }

    .ranap-berkas-doc-btn {
        border: 1px solid transparent;
        border-radius: 999px;
        padding: 2px 7px;
        font-size: 10px;
        font-weight: 600;
        cursor: pointer;
        transition: transform 0.1s ease;
    }

    .ranap-berkas-doc-btn:hover {
        transform: translateY(-1px);
    }

    .ranap-berkas-doc-btn.is-ok {
        background: #dcfce7;
        color: #166534;
        border-color: #86efac;
    }

    .ranap-berkas-doc-btn.is-miss {
        background: #fee2e2;
        color: #991b1b;
        border-color: #fca5a5;
    }

    .ranap-berkas-doc-btn.is-opt {
        background: #f1f5f9;
        color: #64748b;
        border-color: #cbd5e1;
    }

    @media (max-width: 767.98px) {
        #ranapBerkasFloatBar {
            top: 48px;
            padding: 8px 10px;
        }
        #ranapFloatingBerkasWrap {
            right: 10px;
            bottom: 60px;
        }
        #ranapFloatingBerkasPanel {
            width: calc(100vw - 20px);
        }
    }
</style>

{{-- 1. FLOATING STICKY PROGRESS BAR DI ATAS TABEL #tb_ranap --}}
<!-- <div id="ranapBerkasFloatBar" role="region" aria-label="Progress Kelengkapan Berkas Ranap">
    <div class="ranap-berkas-bar-top">
        <div class="d-flex align-items-center gap-2">
            <div class="d-inline-flex align-items-center justify-content-center rounded-3 bg-primary bg-opacity-10 text-primary" style="width: 34px; height: 34px;">
                <i class="bi bi-folder-check fs-5"></i>
            </div>
            <div>
                <div class="fw-bold text-dark d-flex align-items-center flex-wrap gap-1" style="font-size: 12.5px;">
                    <span>Kelengkapan Berkas Ranap</span>
                    <span class="badge text-bg-light border text-secondary" id="ranapFloatTotalPasien" style="font-size: 10px;">0 Pasien</span>
                    <span class="badge bg-success-subtle text-success border border-success-subtle" id="ranapFloatLengkapCnt" style="font-size: 10px;">Lengkap: 0</span>
                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle" id="ranapFloatBelumCnt" style="font-size: 10px;">Belum: 0</span>
                </div>
                <div class="text-muted" style="font-size: 10.5px;">
                    Rata-rata kelengkapan berkas wajib (Askep, Asmed, POC, Nyeri, TB, Discharge, Resume)
                </div>
            </div>
        </div>

        <div class="ranap-berkas-progress-wrap">
            <div class="d-flex align-items-center justify-content-between mb-1">
                <span class="small fw-semibold text-muted" style="font-size: 11px;">Progress Kelengkapan</span>
                <span class="fw-bold" id="ranapFloatAvgPctText" style="font-size: 13px;">0%</span>
            </div>
            <div class="ranap-berkas-track">
                <div class="ranap-berkas-fill" id="ranapFloatAvgBar"></div>
            </div>
        </div>

        <div class="d-flex align-items-center gap-1 flex-shrink-0">
            <button type="button" class="btn btn-outline-secondary btn-sm py-1 px-2" onclick="toggleRanapBerkasChips()" id="btnToggleRanapChips" title="Tampilkan / sembunyikan rincian per berkas" style="font-size: 11px;">
                <i class="bi bi-bar-chart-steps"></i>
            </button>
            <button type="button" class="btn btn-outline-primary btn-sm py-1 px-2" onclick="loadKelengkapanBerkasBatchRanap()" title="Refresh progress kelengkapan berkas" style="font-size: 11px;">
                <i class="bi bi-arrow-clockwise" id="ranapFloatBerkasRefreshIcon"></i>
            </button>
            <button type="button" class="btn btn-primary btn-sm py-1 px-2" onclick="toggleRanapBerkasPanel(true)" style="font-size: 11px;">
                <i class="bi bi-list-check me-1"></i>Rincian Pasien
            </button>
        </div>
    </div>

    {{-- Mini Progress Bar per Jenis Berkas Utama --}}
    <div class="ranap-berkas-chips" id="ranapFloatPerBerkasChips">
        <div class="text-muted small py-1"><span class="spinner-border spinner-border-sm me-1"></span>Menghitung kelengkapan berkas pasien...</div>
    </div>
</div> -->

{{-- 2. FLOATING PANEL & TRIGGER PILL DI KANAN BAWAH --}}
<div id="ranapFloatingBerkasWrap">
    <div id="ranapFloatingBerkasPanel" class="d-none" role="region" aria-label="Detail Kelengkapan Berkas Pasien Ranap">
        <div class="ranap-berkas-panel-hdr">
            <div>
                <div class="fw-bold d-flex align-items-center gap-1" style="font-size: 12.5px;">
                    <i class="bi bi-folder-check text-warning"></i>
                    <span>Kelengkapan Berkas Pasien</span>
                </div>
                <div class="text-white-50" style="font-size: 10.5px;" id="ranapBerkasPanelSub">Memuat data...</div>
            </div>
            <div class="d-flex align-items-center gap-1">
                <button type="button" class="btn btn-sm btn-outline-light py-0 px-2" onclick="loadKelengkapanBerkasBatchRanap()" title="Muat Ulang">
                    <i class="bi bi-arrow-clockwise"></i>
                </button>
                <button type="button" class="btn btn-sm btn-outline-light py-0 px-2" onclick="toggleRanapBerkasPanel(false)" title="Tutup Panel">
                    <i class="bi bi-dash-lg"></i>
                </button>
            </div>
        </div>

        <div class="p-2 bg-light border-bottom d-flex flex-column gap-2">
            <div class="d-flex align-items-center justify-content-between gap-2 flex-wrap">
                <div class="btn-group btn-group-sm" role="group">
                    <button type="button" class="btn btn-primary py-0 px-2 ranap-bpanel-flt" data-flt="missing" onclick="setRanapBerkasPanelFilter('missing', this)" style="font-size: 10.5px;">Belum Lengkap</button>
                    <button type="button" class="btn btn-outline-secondary py-0 px-2 ranap-bpanel-flt" data-flt="all" onclick="setRanapBerkasPanelFilter('all', this)" style="font-size: 10.5px;">Semua</button>
                    <button type="button" class="btn btn-outline-secondary py-0 px-2 ranap-bpanel-flt" data-flt="done" onclick="setRanapBerkasPanelFilter('done', this)" style="font-size: 10.5px;">100% Lengkap</button>
                </div>
                <input type="search" id="ranapBerkasPanelSearch" class="form-control form-control-sm" style="max-width: 170px; height: 24px; font-size: 11px;" placeholder="Cari pasien / bangsal..." oninput="renderRanapBerkasPanelList()">
            </div>
        </div>

        <div class="ranap-berkas-panel-body" id="ranapBerkasPanelBody">
            <div class="text-center text-muted py-4 small">
                <span class="spinner-border spinner-border-sm me-1"></span> Memuat daftar pasien...
            </div>
        </div>
    </div>

    <button type="button" id="btnRanapBerkasFab" onclick="toggleRanapBerkasPanel()" title="Buka Rincian Kelengkapan Berkas Pasien Ranap">
        <i class="bi bi-folder-check"></i>
        <span>Berkas</span>
        <span class="ranap-fab-mini-bar"><span id="ranapFabMiniBarFill" style="width: 0%;"></span></span>
        <span class="badge rounded-pill bg-white text-primary fw-bold px-2" id="ranapFabBerkasPct">0%</span>
    </button>
</div>

@push('script')
    <script>
        window._ranapBerkasBatchState = {
            items: [],
            filter: 'missing',
            isOpen: false,
            chipsHidden: false,
        };

        function toggleRanapBerkasChips() {
            window._ranapBerkasBatchState.chipsHidden = !window._ranapBerkasBatchState.chipsHidden;
            $('#ranapFloatPerBerkasChips').toggleClass('d-none', window._ranapBerkasBatchState.chipsHidden);
        }

        function toggleRanapBerkasPanel(forceState) {
            const nextOpen = typeof forceState === 'boolean' ? forceState : !window._ranapBerkasBatchState.isOpen;
            window._ranapBerkasBatchState.isOpen = nextOpen;
            $('#ranapFloatingBerkasPanel').toggleClass('d-none', !nextOpen);

            // Tutup panel Monitoring Pulang jika sedang terbuka agar tidak bertumpuk
            if (nextOpen && typeof toggleRanapMonitorPanel === 'function') {
                toggleRanapMonitorPanel(false);
            }
            if (nextOpen && window._ranapBerkasBatchState.items.length === 0) {
                loadKelengkapanBerkasBatchRanap();
            }
        }

        function setRanapBerkasPanelFilter(flt, btnEl) {
            window._ranapBerkasBatchState.filter = flt;
            $('.ranap-bpanel-flt').removeClass('btn-primary').addClass('btn-outline-secondary');
            if (btnEl) {
                $(btnEl).removeClass('btn-outline-secondary').addClass('btn-primary');
            }
            renderRanapBerkasPanelList();
        }

        function getProgressColorClass(pct) {
            if (pct >= 90) return 'is-high';
            if (pct >= 60) return 'is-mid';
            return 'is-low';
        }

        function getProgressHexColor(pct) {
            if (pct >= 90) return '#16a34a';
            if (pct >= 60) return '#d97706';
            return '#dc2626';
        }

        function loadKelengkapanBerkasBatchRanap() {
            const params = {
                stts_pulang: typeof stts_pulang !== 'undefined' ? stts_pulang : '-',
                tgl_pertama: typeof tgl_awal !== 'undefined' ? tgl_awal : '',
                tgl_kedua: typeof tgl_akhir !== 'undefined' ? tgl_akhir : '',
                kd_dokter: typeof kd_dokter !== 'undefined' ? (kd_dokter || '') : '',
                spesialis: typeof sps !== 'undefined' ? (sps || '') : '',
                kamar: typeof kamar !== 'undefined' ? (kamar || '') : '',
            };

            $('#ranapFloatBerkasRefreshIcon').addClass('ranap-mon-spin');

            $.ajax({
                url: '/erm/ranap/kelengkapan-berkas-batch',
                method: 'GET',
                dataType: 'JSON',
                ermSilent: true,
                data: params,
            }).done(function (res) {
                if (!res || !res.success) return;

                const s = res.summary || {};
                const pct = s.avg_percent || 0;
                const total = s.total_pasien || 0;
                const lengkap = s.lengkap_penuh || 0;
                const belum = s.belum_lengkap || 0;

                window._ranapBerkasBatchState.items = res.items || [];

                // Update Sticky Floating Progress Bar di atas #tb_ranap
                $('#ranapFloatTotalPasien').text(`${total} Pasien`);
                $('#ranapFloatLengkapCnt').text(`Lengkap: ${lengkap}`);
                $('#ranapFloatBelumCnt').text(`Belum: ${belum}`);

                $('#ranapFloatAvgPctText')
                    .text(`${pct}%`)
                    .css('color', getProgressHexColor(pct));

                $('#ranapFloatAvgBar')
                    .css('width', `${pct}%`)
                    .removeClass('is-high is-mid is-low')
                    .addClass(getProgressColorClass(pct));

                // Update Floating FAB pill kanan bawah
                $('#ranapFabBerkasPct').text(`${pct}%`);
                $('#ranapFabMiniBarFill')
                    .css('width', `${pct}%`)
                    .css('background', pct >= 90 ? '#4ade80' : (pct >= 60 ? '#fde047' : '#fca5a5'));

                $('#ranapBerkasPanelSub').text(`Rata-rata ${pct}% • ${lengkap}/${total} pasien lengkap penuh`);

                // Render mini progress chip per berkas
                const chipsHtml = (s.per_berkas || []).map(function (b) {
                    const barColor = b.required ? getProgressHexColor(b.percent) : '#64748b';
                    const optTag = b.required ? '' : ' <span class="text-muted">(Opt)</span>';
                    return `
                        <div class="ranap-berkas-mini-chip" title="${b.label}: ${b.done} dari ${b.total} pasien (${b.percent}%)">
                            <div class="d-flex justify-content-between align-items-center gap-1">
                                <span class="fw-semibold text-dark text-truncate">${b.label}${optTag}</span>
                                <span class="fw-bold" style="color:${barColor};">${b.percent}%</span>
                            </div>
                            <div class="ranap-berkas-mini-track">
                                <div class="ranap-berkas-mini-fill" style="width:${b.percent}%;background:${barColor};"></div>
                            </div>
                        </div>
                    `;
                }).join('');

                $('#ranapFloatPerBerkasChips').html(chipsHtml || '<div class="text-muted small">Tidak ada pasien pada filter aktif.</div>');

                renderRanapBerkasPanelList();
            }).fail(function (xhr) {
                if (xhr.status === 401) {
                    alertSessionExpired(xhr.status);
                }
            }).always(function () {
                $('#ranapFloatBerkasRefreshIcon').removeClass('ranap-mon-spin');
            });
        }

        function renderRanapBerkasPanelList() {
            const container = $('#ranapBerkasPanelBody');
            const flt = window._ranapBerkasBatchState.filter;
            const kw = ($('#ranapBerkasPanelSearch').val() || '').toLowerCase().trim();

            const filtered = (window._ranapBerkasBatchState.items || []).filter(function (it) {
                if (flt === 'missing' && it.required_missing === 0) return false;
                if (flt === 'done' && it.required_missing > 0) return false;
                if (kw) {
                    const hay = `${it.nm_pasien} ${it.no_rkm_medis} ${it.no_rawat} ${it.nm_bangsal} ${it.nm_dokter}`.toLowerCase();
                    if (!hay.includes(kw)) return false;
                }
                return true;
            });

            if (!filtered.length) {
                container.html(`
                    <div class="text-center py-4 bg-white rounded-3 border">
                        <i class="bi bi-check-circle-fill text-success fs-3 d-block mb-1"></i>
                        <div class="fw-semibold text-dark small">Tidak ada data pada filter ini</div>
                    </div>
                `);
                return;
            }

            const esc = (s) => String(s ?? '').replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;').replace(/'/g, '&#39;');

            const html = filtered.map(function (it) {
                const cardCls = it.required_missing === 0 ? 'is-full' : (it.percent < 60 ? 'is-low' : '');
                const barCls = getProgressColorClass(it.percent);
                const pctColor = getProgressHexColor(it.percent);

                const docBtns = (it.berkas || []).map(function (b) {
                    const cls = b.completed ? 'is-ok' : (b.required ? 'is-miss' : 'is-opt');
                    const ico = b.completed ? 'bi-check2' : (b.required ? 'bi-x' : 'bi-dash');
                    return `<button type="button" class="ranap-berkas-doc-btn ${cls}" onclick="bukaBerkasPasienDariFloat('${esc(it.no_rawat)}', '${esc(b.action)}')" title="Klik untuk membuka ${esc(b.short)}">
                        <i class="bi ${ico}"></i> ${esc(b.short)}
                    </button>`;
                }).join(' ');

                return `
                    <div class="ranap-berkas-patient-card ${cardCls}">
                        <div class="d-flex justify-content-between align-items-start gap-2">
                            <div class="min-w-0">
                                <div class="fw-bold text-dark text-truncate">${esc(it.nm_pasien)}</div>
                                <div class="text-muted" style="font-size: 10.5px;">
                                    RM: <strong>${esc(it.no_rkm_medis)}</strong> &bull; ${esc(it.nm_bangsal)} &bull; ${esc(it.tipe_pasien)}
                                </div>
                            </div>
                            <div class="text-end flex-shrink-0">
                                <div class="fw-bold" style="color:${pctColor};font-size:12.5px;">${it.percent}%</div>
                                <div class="text-muted" style="font-size:9.5px;">${it.required_completed}/${it.required_total} wajib</div>
                            </div>
                        </div>
                        <div class="ranap-berkas-track my-1" style="height: 6px;">
                            <div class="ranap-berkas-fill ${barCls}" style="width: ${it.percent}%;"></div>
                        </div>
                        <div class="d-flex flex-wrap gap-1 mt-2">${docBtns}</div>
                        <div class="mt-2 pt-1 border-top d-flex justify-content-end">
                            <button type="button" class="btn btn-outline-primary btn-sm py-0 px-2" style="font-size: 10.5px;" onclick="bukaBerkasPasienDariFloat('${esc(it.no_rawat)}', 'cppt_berkas')">
                                <i class="bi bi-folder-check me-1"></i>Buka CPPT &amp; Checklist
                            </button>
                        </div>
                    </div>
                `;
            }).join('');

            container.html(html);
        }

        function bukaBerkasPasienDariFloat(noRawat, actionKey) {
            toggleRanapBerkasPanel(false);
            switch (actionKey) {
                case 'askep_anak':
                    if (typeof askepRanapAnak === 'function') askepRanapAnak(noRawat);
                    break;
                case 'askep_neonatus':
                    if (typeof askepRanapNeonatus === 'function') askepRanapNeonatus(noRawat);
                    break;
                case 'askep_kebidanan':
                    if (typeof askepRanapKandungan === 'function') askepRanapKandungan(noRawat);
                    break;
                case 'asmed_igd':
                    if (typeof modalAsmedUgd === 'function') modalAsmedUgd(noRawat);
                    break;
                case 'asmed_obgyn':
                    if (typeof asmedRanapKandungan === 'function') asmedRanapKandungan(noRawat);
                    break;
                case 'asmed_anak':
                    if (typeof asmedRanapAnak === 'function') asmedRanapAnak(noRawat);
                    break;
                case 'plan_of_care':
                    if (typeof modalPlanOfCare === 'function') modalPlanOfCare(noRawat);
                    break;
                case 'nyeri_neonatus':
                    if (typeof showModalAsesmenNyeriNeonatus === 'function') showModalAsesmenNyeriNeonatus(noRawat);
                    break;
                case 'nyeri_batita':
                    if (typeof showModalAsesmenNyeriBatita === 'function') showModalAsesmenNyeriBatita(noRawat);
                    break;
                case 'nyeri_balita':
                    if (typeof showModalAsesmenNyeriBalita === 'function') showModalAsesmenNyeriBalita(noRawat);
                    break;
                case 'nyeri_anak':
                    if (typeof showModalAsesmenNyeriAnak === 'function') showModalAsesmenNyeriAnak(noRawat);
                    break;
                case 'nyeri_dewasa':
                    if (typeof showModalAsesmenNyeriDewasa === 'function') showModalAsesmenNyeriDewasa(noRawat);
                    break;
                case 'skoring_tb':
                    if (typeof skoringTb === 'function') skoringTb(noRawat);
                    break;
                case 'discharge_planning':
                    if (typeof showModalDischargePlanning === 'function') showModalDischargePlanning(noRawat);
                    break;
                case 'resume_medis':
                    if (typeof resumeMedis === 'function') resumeMedis(noRawat);
                    break;
                case 'penunjang':
                    if (typeof modalPemeriksaanPenunjang === 'function') modalPemeriksaanPenunjang(noRawat);
                    break;
                case 'cppt_berkas':
                    if (typeof showModalSoapRanap === 'function') {
                        showModalSoapRanap(noRawat);
                        setTimeout(function () {
                            const tabEl = document.getElementById('tabKelengkapanBerkas');
                            if (tabEl) bootstrap.Tab.getOrCreateInstance(tabEl).show();
                        }, 250);
                    }
                    break;
            }
        }

        $(document).ready(function () {
            // Otomatis sinkron setiap kali tabel #tb_ranap selesai memuat data dari filter apapun
            $(document).on('xhr.dt', '#tb_ranap', function () {
                loadKelengkapanBerkasBatchRanap();
            });

            // Fallback load awal
            setTimeout(loadKelengkapanBerkasBatchRanap, 600);

            // Auto-refresh saat modal berkas ditutup (bila kembali ke halaman tabel Ranap)
            $(document).on('hidden.bs.modal', '.modal', function () {
                if (!$('.modal.show').length) {
                    loadKelengkapanBerkasBatchRanap();
                }
            });
        });
    </script>
@endpush
