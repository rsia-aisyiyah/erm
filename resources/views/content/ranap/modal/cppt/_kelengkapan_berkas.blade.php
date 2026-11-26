<style>
    /* ======================================================
       KELENGKAPAN BERKAS RANAP (#tabKelengkapanBerkas-pane)
       ====================================================== */
    .erm-berkas-summary {
        position: sticky;
        top: 0;
        z-index: 15;
        background: linear-gradient(135deg, rgba(248, 250, 252, 0.97), rgba(239, 246, 255, 0.97));
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        border: 1px solid #bfdbfe;
        border-radius: 10px;
        padding: 12px 14px;
        margin-bottom: 12px;
        box-shadow: 0 6px 18px rgba(15, 23, 42, 0.08);
    }

    .erm-berkas-filter-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 10px;
    }

    .erm-berkas-filter-btn {
        border: 1px solid #cbd5e1;
        background: #ffffff;
        color: #475569;
        border-radius: 999px;
        padding: 3px 10px;
        font-size: 11.5px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.15s ease;
    }

    .erm-berkas-filter-btn.active {
        background: #2563eb;
        border-color: #2563eb;
        color: #ffffff;
    }

    .erm-berkas-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 6px;
    }

    .erm-berkas-table thead th {
        background: #f1f5f9;
        color: #475569;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        padding: 8px 10px;
        border: 1px solid #e2e8f0;
    }

    .erm-berkas-table tbody tr {
        background: #ffffff;
        box-shadow: 0 1px 2px rgba(15, 23, 42, 0.04);
    }

    .erm-berkas-table tbody td {
        padding: 9px 11px;
        vertical-align: middle;
        border: 1px solid #e2e8f0;
        border-left-width: 0;
        font-size: 12px;
    }

    .erm-berkas-table tbody td:first-child {
        border-left-width: 4px;
        border-top-left-radius: 8px;
        border-bottom-left-radius: 8px;
    }

    .erm-berkas-table tbody tr.is-done td:first-child {
        border-left-color: #16a34a;
    }

    .erm-berkas-table tbody tr.is-missing td:first-child {
        border-left-color: #dc2626;
    }

    .erm-berkas-table tbody tr.is-optional td:first-child {
        border-left-color: #94a3b8;
    }

    .erm-berkas-table tbody td:last-child {
        border-top-right-radius: 8px;
        border-bottom-right-radius: 8px;
        white-space: nowrap;
        text-align: right;
    }

    @media (max-width: 767.98px) {
        .erm-berkas-table thead {
            display: none;
        }

        .erm-berkas-table,
        .erm-berkas-table tbody,
        .erm-berkas-table tbody tr,
        .erm-berkas-table tbody td {
            display: block;
            width: 100%;
        }

        .erm-berkas-table tbody tr {
            margin-bottom: 10px;
            border: 1px solid #cbd5e1;
            border-radius: 9px;
            overflow: hidden;
        }

        .erm-berkas-table tbody td {
            border: 0 !important;
            border-bottom: 1px dashed #e2e8f0 !important;
            border-radius: 0 !important;
            text-align: left !important;
            padding: 7px 10px;
        }

        .erm-berkas-table tbody td:last-child {
            border-bottom: 0 !important;
        }
    }
</style>

<div id="ranapBerkasWrap">
    <div class="erm-berkas-summary">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-2">
            <div>
                <div class="fw-bold text-dark d-flex align-items-center gap-2" style="font-size: 13.5px;">
                    <i class="bi bi-folder-check text-primary"></i>
                    <span>Kelengkapan Berkas Rawat Inap</span>
                    <span class="badge text-bg-primary bg-opacity-10 text-primary border border-primary-subtle"
                        id="ranapBerkasTipeBadge" style="font-size: 10.5px;">-</span>
                </div>
                <div class="text-muted small" id="ranapBerkasSummaryText">Memeriksa kelengkapan berkas pasien...</div>
            </div>
            <div class="d-flex align-items-center gap-2">
                <span class="fw-bold fs-5 text-primary" id="ranapBerkasPercentText">0%</span>
                <button type="button" class="btn btn-sm btn-outline-primary py-1 px-2"
                    onclick="loadKelengkapanBerkasRanap()" title="Refresh status kelengkapan berkas">
                    <i class="bi bi-arrow-clockwise me-1"></i>Refresh
                </button>
            </div>
        </div>
        <div class="progress" style="height: 8px; border-radius: 999px; background: #e2e8f0;">
            <div class="progress-bar bg-primary" id="ranapBerkasProgressBar" role="progressbar" style="width: 0%;"
                aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
    </div>

    <div class="erm-berkas-filter-bar">
        <div class="d-flex flex-wrap gap-1">
            <button type="button" class="erm-berkas-filter-btn active" data-filter="all"
                onclick="setRanapBerkasFilter('all', this)">
                Semua (<span id="ranapBerkasCntAll">0</span>)
            </button>
            <button type="button" class="erm-berkas-filter-btn" data-filter="missing"
                onclick="setRanapBerkasFilter('missing', this)">
                Belum Lengkap (<span id="ranapBerkasCntMissing">0</span>)
            </button>
            <button type="button" class="erm-berkas-filter-btn" data-filter="done"
                onclick="setRanapBerkasFilter('done', this)">
                Sudah Lengkap (<span id="ranapBerkasCntDone">0</span>)
            </button>
        </div>
        <span class="text-muted" style="font-size: 11px;">
            <i class="bi bi-info-circle me-1"></i><strong>Surat Kontrol BPJS</strong> wajib bagi pasien BPJS (dicocokkan
            via No. SEP); <strong>Penunjang (Lab &amp; Radiologi)</strong> bersifat kondisional.
        </span>
    </div>

    <div class="table-responsive">
        <table class="erm-berkas-table">
            <thead>
                <tr>
                    <th width="34%">Nama Berkas</th>
                    <th width="14%">Kategori</th>
                    <th width="16%">Status</th>
                    <th width="24%">Keterangan</th>
                    <th width="12%" class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody id="ranapBerkasTbody">
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">
                        <span class="spinner-border spinner-border-sm me-1"></span> Memuat kelengkapan berkas...
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@push('script')
    <script>
        window._ranapBerkasState = {
            items: [],
            filter: 'all',
            floatFilter: 'all',
            floatOpen: false,
            no_rawat: '',
        };

        function toggleModalBerkasFloatPanel(forceState) {
            const nextOpen = typeof forceState === 'boolean' ? forceState : !window._ranapBerkasState.floatOpen;
            window._ranapBerkasState.floatOpen = nextOpen;
            $('#ermModalBerkasFloatPanel').toggleClass('d-none', !nextOpen);
            if (nextOpen && window._ranapBerkasState.items.length === 0) {
                loadKelengkapanBerkasRanap();
            }
        }

        function setModalBerkasFloatFilter(flt, btnEl) {
            window._ranapBerkasState.floatFilter = flt;
            $('.erm-mbflt-btn').removeClass('btn-primary').addClass('btn-outline-secondary');
            if (btnEl) {
                $(btnEl).removeClass('btn-outline-secondary').addClass('btn-primary');
            }
            renderModalBerkasFloatList();
        }

        function escapeBerkasHtml(str) {
            return String(str ?? '')
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#39;');
        }

        function renderModalBerkasFloatList() {
            const container = $('#ermModalBerkasFloatBody');
            const flt = window._ranapBerkasState.floatFilter;
            const items = (window._ranapBerkasState.items || []).filter(function (it) {
                if (flt === 'missing') return it.required && !it.completed;
                if (flt === 'done') return it.completed;
                return true;
            });

            if (!items.length) {
                container.html(`
                            <div class="text-center py-4 bg-white rounded-3 border">
                                <i class="bi bi-check-circle-fill text-success fs-3 d-block mb-1"></i>
                                <div class="fw-semibold text-dark small">Semua Berkas Terpantau Lengkap</div>
                            </div>
                        `);
                return;
            }

            const html = items.map(function (it) {
                const isSk = it.key === 'surat_kontrol';
                let itemCls = '';
                let badgeHtml = '<span class="badge text-bg-danger" style="font-size:9.5px;">Belum</span>';
                if (it.completed) {
                    itemCls = it.partial ? 'is-partial' : 'is-ok';
                    if (it.tgl_mismatch) {
                        badgeHtml = '<span class="badge text-bg-warning text-dark" style="font-size:9.5px;"><i class="bi bi-calendar-x me-1"></i>Tgl Beda</span>';
                    } else if (it.partial) {
                        badgeHtml = '<span class="badge text-bg-warning text-dark" style="font-size:9.5px;">Sebagian</span>';
                    } else {
                        badgeHtml = '<span class="badge text-bg-success" style="font-size:9.5px;">Lengkap</span>';
                    }
                } else if (!it.required) {
                    itemCls = 'is-opt';
                    badgeHtml = isSk
                        ? '<span class="badge text-bg-secondary" style="font-size:9.5px;">Non-BPJS</span>'
                        : '<span class="badge text-bg-secondary" style="font-size:9.5px;">Penunjang</span>';
                }

                const btnCls = it.completed
                    ? (it.tgl_mismatch ? 'btn-warning text-dark' : 'btn-outline-primary')
                    : (it.required ? 'btn-danger' : 'btn-outline-secondary');
                let btnLbl = (it.action === 'tab_lab' || it.action === 'tab_radiologi')
                    ? 'Lihat'
                    : (it.completed ? 'Buka' : 'Isi');
                if (isSk) {
                    btnLbl = it.completed ? 'Detail' : (it.required ? 'Cek' : 'Info');
                }

                let extraMetaHtml = '';
                if (isSk && (it.no_sep || it.no_surat_kontrol)) {
                    const sepChip = it.no_sep
                        ? `<span class="badge bg-light text-dark border font-monospace" style="font-size:9.5px;">SEP: ${escapeBerkasHtml(it.no_sep)}</span>`
                        : '';
                    const skChip = it.no_surat_kontrol
                        ? `<span class="badge bg-primary-subtle text-primary border border-primary-subtle font-monospace" style="font-size:9.5px;">SKRI: ${escapeBerkasHtml(it.no_surat_kontrol)}</span>`
                        : '';
                    extraMetaHtml = `<div class="d-flex flex-wrap gap-1 mt-1">${sepChip}${skChip}</div>`;
                }

                return `
                            <div class="erm-mbpanel-item ${itemCls}">
                                <div class="min-w-0">
                                    <div class="fw-semibold text-dark d-flex align-items-center gap-1 flex-wrap">
                                        <span>${escapeBerkasHtml(it.label)}</span>
                                        ${badgeHtml}
                                    </div>
                                    <div class="text-muted ${isSk ? '' : 'text-truncate'}" style="font-size: 10.5px;">${escapeBerkasHtml(it.detail || '-')}</div>
                                    ${extraMetaHtml}
                                </div>
                                <button type="button" class="btn btn-sm ${btnCls} py-0 px-2 flex-shrink-0" style="font-size: 10.5px;" onclick="toggleModalBerkasFloatPanel(false); bukaBerkasRanap('${escapeBerkasHtml(it.action)}');">
                                    ${btnLbl}
                                </button>
                            </div>
                        `;
            }).join('');

            container.html(html);
        }

        function setRanapBerkasFilter(filterKey, btnEl) {
            window._ranapBerkasState.filter = filterKey;
            $('.erm-berkas-filter-btn').removeClass('active');
            if (btnEl) {
                $(btnEl).addClass('active');
            }
            renderKelengkapanBerkasRanap();
        }

        function loadKelengkapanBerkasRanap(noRawatOverride) {
            const noRawat = noRawatOverride || $('#formInfoPasien').find('input[name="no_rawat"]').val();
            if (!noRawat) return;

            window._ranapBerkasState.no_rawat = noRawat;
            $('#ermModalBerkasRefreshIco').addClass('ranap-mon-spin');

            $.ajax({
                url: '/erm/ranap/kelengkapan-berkas',
                method: 'GET',
                dataType: 'JSON',
                ermSilent: true,
                data: { no_rawat: noRawat },
            }).done(function (res) {
                if (!res || !res.success) return;

                const s = res.summary || {};
                const items = res.items || [];
                window._ranapBerkasState.items = items;

                const reqDone = s.required_completed || 0;
                const reqTotal = s.required_total || 0;
                const reqMissing = s.required_missing || 0;
                const pct = s.percent || 0;
                const tipePasien = res.pasien?.tipe_pasien || '-';

                // 1. Update Floating Widget Kanan Bawah di Atas #modalSoapRanap
                const stateCls = pct >= 100 ? 'is-complete' : (pct >= 60 ? 'is-warning' : 'is-danger');
                const fillHex = pct >= 100 ? '#4ade80' : (pct >= 60 ? '#fde047' : '#fca5a5');

                $('#btnErmModalBerkasFab')
                    .removeClass('is-complete is-warning is-danger')
                    .addClass(stateCls);
                $('#ermMbFabTrackFill').css('width', `${pct}%`);
                $('#ermMbFabPctBadge').text(`${pct}% (${reqDone}/${reqTotal})`);

                $('#ermModalBerkasTipe').text(tipePasien);
                $('#ermModalBerkasRatio').text(
                    reqMissing > 0
                        ? `${reqDone}/${reqTotal} berkas wajib terisi • ${reqMissing} belum diisi`
                        : `${reqDone}/${reqTotal} berkas wajib lengkap semua`
                );
                $('#ermModalBerkasPct').text(`${pct}%`);
                $('#ermModalBerkasBarFill')
                    .css('width', `${pct}%`)
                    .css('background', fillHex);

                renderModalBerkasFloatList();

                // 2. Update Tab Checklist Kelengkapan Berkas
                $('#ranapBerkasTipeBadge').text(tipePasien);
                $('#ranapBerkasPercentText')
                    .text(`${pct}%`)
                    .removeClass('text-primary text-success text-warning text-danger')
                    .addClass(pct >= 100 ? 'text-success' : (pct >= 60 ? 'text-warning' : 'text-danger'));

                $('#ranapBerkasProgressBar')
                    .css('width', `${pct}%`)
                    .attr('aria-valuenow', pct)
                    .removeClass('bg-primary bg-success bg-warning bg-danger')
                    .addClass(pct >= 100 ? 'bg-success' : (pct >= 60 ? 'bg-warning' : 'bg-danger'));

                $('#ranapBerkasSummaryText').html(
                    `Berkas wajib terisi: <strong class="text-dark">${reqDone} dari ${reqTotal}</strong>` +
                    (reqMissing > 0
                        ? ` &bull; <span class="text-danger fw-semibold">${reqMissing} berkas wajib belum lengkap</span>`
                        : ` &bull; <span class="text-success fw-semibold">Semua berkas wajib lengkap</span>`)
                );

                // 3. Update badge pada tab rail & sticky header pill
                const tabBadge = $('#ranapBerkasTabBadge');
                const hdrPill = $('#btnErmRanapBerkasPill');
                const hdrText = $('#ermRanapBerkasPillText');

                tabBadge.text(`${reqDone}/${reqTotal}`)
                    .removeClass('d-none text-bg-success text-bg-warning text-bg-danger text-dark')
                    .addClass(reqMissing === 0 ? 'text-bg-success' : (pct >= 60 ? 'text-bg-warning text-dark' : 'text-bg-danger'));

                hdrText.text(`Berkas ${pct}%`);
                hdrPill.removeClass('d-none btn-outline-success btn-outline-warning btn-outline-danger text-dark')
                    .addClass(reqMissing === 0 ? 'btn-outline-success' : (pct >= 60 ? 'btn-outline-warning text-dark' : 'btn-outline-danger'));

                // Counter filter buttons
                const cntAll = items.length;
                const cntMissing = items.filter((it) => it.required && !it.completed).length;
                const cntDone = items.filter((it) => it.completed).length;
                $('#ranapBerkasCntAll').text(cntAll);
                $('#ranapBerkasCntMissing').text(cntMissing);
                $('#ranapBerkasCntDone').text(cntDone);

                renderKelengkapanBerkasRanap();
            }).fail(function (xhr) {
                if (xhr.status === 401) {
                    alertSessionExpired(xhr.status);
                    return;
                }
                $('#ermModalBerkasFloatBody').html('<div class="alert alert-danger py-2 px-3 small mb-0"><i class="bi bi-exclamation-circle me-1"></i>Gagal memeriksa kelengkapan berkas.</div>');
                $('#ranapBerkasTbody').html(`
                            <tr>
                                <td colspan="5" class="text-center text-danger py-3">
                                    <i class="bi bi-exclamation-circle me-1"></i>Gagal memeriksa kelengkapan berkas.
                                </td>
                            </tr>
                        `);
            }).always(function () {
                $('#ermModalBerkasRefreshIco').removeClass('ranap-mon-spin');
            });
        }

        function renderKelengkapanBerkasRanap() {
            const tbody = $('#ranapBerkasTbody');
            const filter = window._ranapBerkasState.filter;
            const items = (window._ranapBerkasState.items || []).filter(function (it) {
                if (filter === 'missing') return it.required && !it.completed;
                if (filter === 'done') return it.completed;
                return true;
            });

            if (!items.length) {
                tbody.html(`
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    <i class="bi bi-check-circle-fill text-success fs-4 d-block mb-1"></i>
                                    Tidak ada berkas pada filter ini.
                                </td>
                            </tr>
                        `);
                return;
            }

            const html = items.map(function (it) {
                const isSk = it.key === 'surat_kontrol';
                let rowCls = 'is-missing';
                let statusBadge = '<span class="badge text-bg-danger"><i class="bi bi-x-circle me-1"></i>Belum Diisi</span>';

                if (it.completed) {
                    rowCls = 'is-done';
                    if (it.tgl_mismatch) {
                        statusBadge = '<span class="badge text-bg-warning text-dark"><i class="bi bi-calendar-x me-1"></i>Tgl Kontrol Beda</span>';
                    } else if (it.partial) {
                        statusBadge = '<span class="badge text-bg-warning text-dark"><i class="bi bi-exclamation-circle me-1"></i>Sebagian Terisi</span>';
                    } else {
                        statusBadge = '<span class="badge text-bg-success"><i class="bi bi-check-circle-fill me-1"></i>Sudah Terisi</span>';
                    }
                } else if (!it.required) {
                    rowCls = 'is-optional';
                    statusBadge = isSk
                        ? '<span class="badge text-bg-secondary"><i class="bi bi-dash-circle me-1"></i>Non-BPJS</span>'
                        : '<span class="badge text-bg-secondary"><i class="bi bi-dash-circle me-1"></i>Kondisional</span>';
                }

                const reqTag = it.required
                    ? '<span class="badge bg-danger-subtle text-danger border border-danger-subtle ms-1" style="font-size: 9.5px;">Wajib</span>'
                    : (isSk
                        ? '<span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle ms-1" style="font-size: 9.5px;">Non-BPJS</span>'
                        : '<span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle ms-1" style="font-size: 9.5px;">Penunjang</span>');

                let btnLabel = (it.action === 'tab_lab' || it.action === 'tab_radiologi')
                    ? '<i class="bi bi-eye me-1"></i>Lihat Hasil'
                    : (it.completed ? '<i class="bi bi-pencil-square me-1"></i>Lihat / Ubah' : '<i class="bi bi-plus-circle me-1"></i>Isi Berkas');
                if (isSk) {
                    btnLabel = it.completed
                        ? '<i class="bi bi-printer me-1"></i>Detail / Cetak'
                        : (it.required ? '<i class="bi bi-search me-1"></i>Cek SEP / SKRI' : '<i class="bi bi-info-circle me-1"></i>Info');
                }

                const btnCls = it.completed
                    ? (it.tgl_mismatch ? 'btn-warning text-dark' : 'btn-outline-primary')
                    : (it.required ? 'btn-danger' : 'btn-outline-secondary');

                return `
                            <tr class="${rowCls}">
                                <td>
                                    <div class="fw-semibold text-dark">${escapeBerkasHtml(it.label)}${reqTag}</div>
                                </td>
                                <td>
                                    <span class="badge text-bg-light border text-secondary">${escapeBerkasHtml(it.category)}</span>
                                </td>
                                <td>${statusBadge}</td>
                                <td class="text-muted" style="font-size: 11.5px;">${escapeBerkasHtml(it.detail || '-')}</td>
                                <td>
                                    <button type="button" class="btn btn-sm ${btnCls} py-0 px-2" style="font-size: 11px;" onclick="bukaBerkasRanap('${escapeBerkasHtml(it.action)}')">
                                        ${btnLabel}
                                    </button>
                                </td>
                            </tr>
                        `;
            }).join('');

            tbody.html(html);
        }

        function tampilkanDetailSuratKontrolBerkas(item, noRawat) {
            const it = item || {};
            const hasSk = Boolean(it.completed && it.no_surat_kontrol);
            const hasSep = Boolean(it.no_sep);
            const isBpjs = Boolean(it.is_bpjs ?? it.required);
            const isMismatch = Boolean(it.tgl_mismatch);

            const statusHtml = hasSk
                ? (isMismatch
                    ? '<span class="badge text-bg-warning text-dark">SKRI Ditemukan • Tanggal Kontrol Beda dengan Resume</span>'
                    : '<span class="badge text-bg-success">SEP &amp; Surat Kontrol BPJS Cocok</span>')
                : (!isBpjs
                    ? '<span class="badge text-bg-secondary">Pasien Non-BPJS (Tidak Wajib SKRI)</span>'
                    : (hasSep
                        ? '<span class="badge text-bg-danger">SEP Ada • Surat Kontrol Belum Terbit</span>'
                        : '<span class="badge text-bg-danger">Nomor SEP Belum Ditemukan</span>'));

            const bodyHtml = `
                        <div class="text-start small">
                            <div class="mb-2">${statusHtml}</div>
                            <table class="table table-sm table-bordered mb-2" style="font-size: 12px;">
                                <tbody>
                                    <tr>
                                        <th class="bg-light" style="width: 38%;">No. Rawat</th>
                                        <td class="font-monospace">${escapeBerkasHtml(noRawat || '-')}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-light">No. SEP</th>
                                        <td class="font-monospace fw-semibold">${escapeBerkasHtml(it.no_sep || 'Belum terbit')}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-light">No. Surat Kontrol</th>
                                        <td class="font-monospace fw-semibold text-primary">${escapeBerkasHtml(it.no_surat_kontrol || 'Belum terbit')}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-light">Tgl Rencana Kontrol</th>
                                        <td>${escapeBerkasHtml(it.tgl_rencana || '-')}${isMismatch ? ` <span class="text-danger fw-semibold">(Resume: ${escapeBerkasHtml(it.tgl_kontrol_resume || 'Kosong')})</span>` : ''}</td>
                                    </tr>
                                    ${it.nm_poli_bpjs ? `<tr><th class="bg-light">Poli BPJS</th><td>${escapeBerkasHtml(it.nm_poli_bpjs)}</td></tr>` : ''}
                                    ${it.nm_dokter_bpjs ? `<tr><th class="bg-light">Dokter BPJS</th><td>${escapeBerkasHtml(it.nm_dokter_bpjs)}</td></tr>` : ''}
                                </tbody>
                            </table>
                        </div>
                    `;

            if (typeof Swal === 'undefined') {
                if (hasSk) {
                    window.open(`/erm/rencanaKontrol/print/${encodeURIComponent(it.no_surat_kontrol)}`, '_blank');
                }
                return;
            }

            Swal.fire({
                title: 'Surat Kontrol BPJS (SKRI)',
                html: bodyHtml,
                icon: hasSk ? (isMismatch ? 'warning' : 'success') : (isBpjs ? 'warning' : 'info'),
                showConfirmButton: hasSk || isBpjs,
                confirmButtonText: hasSk
                    ? '<i class="bi bi-printer me-1"></i>Cetak Surat Kontrol'
                    : '<i class="bi bi-box-arrow-up-right me-1"></i>Buka Menu SEP',
                showDenyButton: isMismatch || (isBpjs && !hasSk),
                denyButtonText: '<i class="bi bi-file-text me-1"></i>Buka Resume Medis',
                denyButtonColor: '#2563eb',
                showCancelButton: true,
                cancelButtonText: 'Tutup',
            }).then(function (res) {
                if (res.isConfirmed) {
                    if (hasSk) {
                        window.open(`/erm/rencanaKontrol/print/${encodeURIComponent(it.no_surat_kontrol)}`, '_blank');
                    } else {
                        window.open('/erm/sep', '_blank');
                    }
                } else if (res.isDenied) {
                    if (typeof resumeMedis === 'function') {
                        resumeMedis(noRawat);
                    }
                }
            });
        }

        function bukaBerkasRanap(actionKey) {
            const noRawat = $('#formInfoPasien').find('input[name="no_rawat"]').val() || window._ranapBerkasState.no_rawat;
            if (!noRawat) return;

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
                case 'surat_kontrol': {
                    const skItem = (window._ranapBerkasState.items || []).find((x) => x.key === 'surat_kontrol');
                    tampilkanDetailSuratKontrolBerkas(skItem, noRawat);
                    break;
                }
                case 'tab_lab':
                    $('#tab-laboratorium').trigger('click');
                    break;
                case 'tab_radiologi':
                    $('#tab-radiologi').trigger('click');
                    break;
            }
        }

        // Refresh otomatis saat tab Kelengkapan Berkas dibuka atau ketika modal berkas anak ditutup
        $('#tabKelengkapanBerkas').on('shown.bs.tab', function () {
            loadKelengkapanBerkasRanap();
        });

        $(document).on('hidden.bs.modal', '.modal', function () {
            if (this.id !== 'modalSoapRanap' && $('#modalSoapRanap').hasClass('show')) {
                loadKelengkapanBerkasRanap();
            }
        });
    </script>
@endpush