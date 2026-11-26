{{--
==========================================================================
KOMPONEN DROPDOWN AKSI RAWAT INAP (BERTINGKAT PER STAGE + MENU LANGSUNG)
==========================================================================
Cara mudah menambah item menu baru:
1) Langsung tambah 1 object di `window.RanapDropdownMenu.getConfig(ctx)` pada bagian:
- `quick` : tombol cepat paling atas
- `stages` : submenu bertingkat (key: 'asesmen' | 'asuhan' | 'obat' | 'pulang', atau tambah stage baru)
- `direct` : menu langsung 1 klik (Informed Consent, Edukasi, Discharge, Resume, Riwayat, dll.)
2) Atau daftar secara dinamis dari file Blade/JS lain tanpa edit file ini:
RanapDropdownMenu.registerItem('asuhan', (ctx) => ({
label: 'Nama Menu Baru',
icon: 'bi bi-star text-warning',
onclick: `fungsiModalBaru('${ctx.noRawat}')`,
show: true, // opsional (default: true)
checked: ctx.row.xxx, // opsional (tampilkan centang hijau bila data sudah ada)
}));
==========================================================================
--}}
@push('style')
    <style>
        /* ======================================================
                                                                                                                       MULTI-LEVEL STAGE DROPDOWN MENU RANAP (#tb_ranap)
                                                                                                                       ====================================================== */
        .ranap-stage-menu {
            min-width: 245px !important;
            padding: 6px !important;
            border-radius: 10px !important;
            border: 1px solid rgba(15, 23, 42, 0.1) !important;
            box-shadow: 0 12px 32px rgba(15, 23, 42, 0.16) !important;
            overflow: visible !important;
            max-height: none !important;
            font-size: 11.5px;
            z-index: 1050;
        }

        .ranap-stage-quick {
            border-radius: 7px;
            background: #eff6ff;
            color: #1d4ed8 !important;
            font-weight: 700;
            padding: 6px 10px !important;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
        }

        .ranap-stage-quick:hover {
            background: #dbeafe !important;
            color: #1e40af !important;
        }

        .ranap-stage-direct {
            display: flex !important;
            align-items: center;
            gap: 8px;
            padding: 6px 10px !important;
            border-radius: 7px;
            font-weight: 600;
            color: #1e293b;
            transition: background 0.15s ease, color 0.15s ease;
        }

        .ranap-stage-direct:hover {
            background: #eff6ff !important;
            color: #1d4ed8 !important;
        }

        .ranap-stage-direct-hdr {
            font-size: 9.5px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            color: #94a3b8;
            padding: 2px 10px 3px 10px;
            user-select: none;
        }

        .ranap-stage-item {
            position: relative;
        }

        .ranap-stage-toggle {
            display: flex !important;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            padding: 7px 10px !important;
            border-radius: 7px;
            font-weight: 600;
            color: #1e293b;
            cursor: pointer;
            transition: background 0.15s ease, color 0.15s ease;
        }

        .ranap-stage-toggle .stage-left {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            min-width: 0;
        }

        .ranap-stage-icon {
            width: 22px;
            height: 22px;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            flex-shrink: 0;
        }

        .ranap-stage-icon.is-asesmen {
            background: #fef2f2;
            color: #dc2626;
        }

        .ranap-stage-icon.is-asuhan {
            background: #eff6ff;
            color: #2563eb;
        }

        .ranap-stage-icon.is-obat {
            background: #f0fdf4;
            color: #16a34a;
        }

        .ranap-stage-icon.is-gizi {
            background: #f0fdf4;
            color: #a3169cff;
        }

        .ranap-stage-icon.is-pulang {
            background: #fffbeb;
            color: #d97706;
        }

        .ranap-stage-arrow {
            font-size: 10px;
            color: #94a3b8;
            transition: transform 0.15s ease, color 0.15s ease;
        }

        .ranap-stage-item:hover>.ranap-stage-toggle,
        .ranap-stage-item.is-sub-open>.ranap-stage-toggle {
            background: #f1f5f9;
            color: #0f172a;
        }

        .ranap-stage-item.is-sub-open>.ranap-stage-toggle .ranap-stage-arrow {
            color: #2563eb;
            transform: translateX(2px);
        }

        .ranap-submenu {
            display: none;
            position: absolute !important;
            top: -4px;
            left: calc(100% - 2px);
            right: auto;
            bottom: auto;
            inset: auto;
            transform: none !important;
            min-width: 265px;
            max-height: 75vh;
            overflow-y: auto;
            padding: 6px;
            margin: 0 !important;
            border-radius: 10px;
            border: 1px solid rgba(15, 23, 42, 0.1);
            background: #ffffff;
            box-shadow: 0 14px 36px rgba(15, 23, 42, 0.18);
            font-size: 11.5px;
            z-index: 1052;
        }

        .ranap-stage-item.is-sub-open>.ranap-submenu {
            display: block;
        }

        .ranap-submenu-hdr {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 4px 9px 6px 9px;
            margin-bottom: 4px;
            border-bottom: 1px dashed #e2e8f0;
            color: #64748b;
        }

        .ranap-submenu .dropdown-item {
            border-radius: 6px;
            padding: 5px 9px !important;
            display: flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
        }

        .ranap-submenu .dropdown-item:hover {
            background: #eff6ff;
            color: #1d4ed8;
        }

        @media (max-width: 991.98px) {
            .ranap-stage-menu {
                max-height: 72vh !important;
                overflow-y: auto !important;
            }

            .ranap-submenu {
                position: static !important;
                box-shadow: none;
                border: 0;
                border-left: 2px solid #cbd5e1;
                border-radius: 0;
                margin: 2px 0 4px 14px;
                padding: 2px 0 2px 6px;
                min-width: 0;
                max-height: none;
            }

            .ranap-stage-item.is-sub-open>.ranap-stage-toggle .ranap-stage-arrow {
                transform: rotate(90deg);
            }
        }
    </style>
@endpush

@push('script')
    <script>
        (function (window, $) {
            'use strict';

            const userDepartemen = "{{ session()->get('pegawai')->departemen }}";
            const grupAksesPoc = ['DM7', 'Direksi', 'SPS', '-', 'CSM'];
            const grupAksesResume = ['Direksi', 'SPS', '-', 'CSM'];

            // Registry tambahan dinamis (opsional jika ingin menyuntikkan item dari file Blade lain)
            const extraItems = {
                quick: [],
                direct: [],
                stages: {},
            };

            function renderCheckIcon(val, useAltIcon) {
                if (!val) return '';
                if (useAltIcon) {
                    return '<i class="bi bi-check-circle text-success ms-1"></i>';
                }
                return typeof cekList === 'function' ? cekList(val) : '<i class="bi bi-check-circle text-success ms-1"></i>';
            }

            function renderMenuItem(item, isDirect) {
                if (!item || item.show === false) return '';
                if (item.rawHtml) return item.rawHtml;

                const linkClass = isDirect
                    ? `dropdown-item ranap-stage-direct ${item.className || ''}`.trim()
                    : `dropdown-item py-1 ${item.className || ''}`.trim();
                const iconHtml = item.icon ? `<i class="${item.icon}${isDirect ? '' : ' me-1'}"></i>` : '';
                const checkHtml = item.checked !== undefined ? ` ${renderCheckIcon(item.checked, item.altCheckIcon)}` : '';
                const attrs = item.extraAttrs ? ` ${item.extraAttrs}` : '';
                const labelHtml = isDirect ? `<span>${item.label}${checkHtml}</span>` : `${item.label}${checkHtml}`;

                return `<li><a class="${linkClass}" href="javascript:void(0)" onclick="${item.onclick}"${attrs}>${iconHtml}${labelHtml}</a></li>`;
            }

            /**
             * KONFIGURASI TERPUSAT MENU DROPDOWN RAWAT INAP
             * ------------------------------------------------------------
             * Cukup tambah 1 objek baru di array `items` pada stage yang
             * diinginkan atau di array `direct` untuk menu langsung 1 klik!
             */
            function getConfig(ctx) {
                const { data, row, noRawat, noRm, kdSps, isDokter } = ctx;

                return {
                    // 1) TOMBOL CEPAT PALING ATAS
                    quick: [
                        {
                            label: 'CPPT (SOAP)',
                            icon: 'bi bi-journal-medical me-1',
                            badge: 'Cepat',
                            onclick: `showModalSoapRanap('${noRawat}')`,
                            extraAttrs: `data-kd-dokter="${row.reg_periksa.kd_dokter}"`,
                        },
                    ],

                    // 2) STAGE BERTINGKAT (SUBMENU)
                    stages: [
                        {
                            key: 'asesmen',
                            title: 'Asesmen & Skrining',
                            icon: 'bi-clipboard2-pulse',
                            iconClass: 'is-asesmen',
                            items: [
                                {
                                    label: 'Asesmen Medis IGD',
                                    icon: 'bi bi-hospital text-danger',
                                    onclick: `modalAsmedUgd('${noRawat}')`,
                                    checked: row.asmed_igd || (row.reg_periksa ? row.reg_periksa.asmed_igd : null),
                                },
                                {
                                    label: 'Asesmen Medis Anak',
                                    icon: 'bi bi-person-badge text-primary',
                                    onclick: `asmedRanapAnak('${noRawat}')`,
                                    show: kdSps === 'S0003',
                                    checked: row.reg_periksa?.asmed_ranap_anak,
                                },
                                {
                                    label: 'Asesmen Resiko Jatuh Anak',
                                    icon: 'bi bi-person-exclamation text-danger',
                                    onclick: `showModalAsesmenResikoJatuhAnak('${noRawat}')`,
                                    show: kdSps === 'S0003',
                                },
                                {
                                    label: 'Asesmen Keperawatan Neonatus',
                                    icon: 'bi bi-heart-pulse text-danger',
                                    onclick: `askepRanapNeonatus('${noRawat}')`,
                                    show: kdSps === 'S0003' && data.sttsumur === 'Hr',
                                    checked: row.reg_periksa?.askep_ranap_neonatus,
                                },
                                {
                                    label: 'Asesmen Keperawatan Anak',
                                    icon: 'bi bi-clipboard-pulse text-info',
                                    onclick: `askepRanapAnak('${noRawat}')`,
                                    show: kdSps === 'S0003' && data.sttsumur !== 'Hr',
                                    checked: row.reg_periksa?.askep_ranap_anak,
                                },
                                {
                                    label: 'Asesmen Medis Kandungan',
                                    icon: 'bi bi-gender-female text-danger',
                                    onclick: `asmedRanapKandungan('${noRawat}')`,
                                    show: kdSps === 'S0001',
                                    checked: row.reg_periksa?.asmed_ranap_kandungan,
                                },
                                {
                                    label: 'Asesmen Keperawatan Kandungan',
                                    icon: 'bi bi-balloon-heart text-danger',
                                    onclick: `askepRanapKandungan('${noRawat}')`,
                                    show: kdSps === 'S0001',
                                    checked: row.reg_periksa?.askep_ranap_kandungan,
                                },
                                {
                                    label: 'Asesmen Resiko Jatuh Dewasa',
                                    icon: 'bi bi-person-exclamation text-danger',
                                    onclick: `showModalAsesmenResikoJatuhDewasa('${noRawat}')`,
                                    show: kdSps === 'S0001',
                                },
                                {
                                    rawHtml: typeof renderListsAsesmenNyeri === 'function'
                                        ? renderListsAsesmenNyeri(data.pasien.tgl_lahir, data.tgl_registrasi, noRawat)
                                        : '',
                                },
                                {
                                    label: 'Asesmen Awal Geriatri',
                                    icon: 'bi bi-person-heart text-success',
                                    onclick: `showModalAsesmenGeriatri('${noRawat}')`,
                                    checked: row.asesmen_geriatri,
                                },
                                {
                                    label: 'Skoring & Skrining TB',
                                    icon: 'bi bi-lungs text-danger',
                                    onclick: `skoringTb('${noRawat}')`,
                                    checked: row.skrining_tb,
                                },
                            ],
                        },
                        {
                            key: 'asuhan',
                            title: 'Asuhan & Penunjang',
                            icon: 'bi-journal-medical',
                            iconClass: 'is-asuhan',
                            items: [
                                {
                                    label: 'CPPT (SOAP)',
                                    icon: 'bi bi-journal-medical text-primary',
                                    className: 'fw-bold text-primary',
                                    onclick: `showModalSoapRanap('${noRawat}')`,
                                    extraAttrs: `data-kd-dokter="${row.reg_periksa.kd_dokter}"`,
                                },
                                {
                                    label: 'Plan of Care',
                                    icon: 'bi bi-clipboard-data text-primary',
                                    onclick: `modalPlanOfCare('${noRawat}')`,
                                    show: grupAksesPoc.includes(isDokter),
                                    checked: row.reg_periksa?.poc,
                                },
                                {
                                    label: 'Discharge Planning',
                                    icon: 'bi bi-box-arrow-right text-warning',
                                    onclick: `showModalDischargePlanning('${noRawat}')`,
                                    checked: row.discharge_planning,
                                },
                                {
                                    label: 'Catatan Edukasi',
                                    icon: 'bi bi-person-video3 text-warning',
                                    onclick: `catatanEdukasiPasien('${noRawat}')`,
                                },
                                {
                                    label: 'Pemeriksaan Penunjang',
                                    icon: 'bi bi-file-earmark-medical text-primary',
                                    onclick: `modalPemeriksaanPenunjang('${noRawat}')`,
                                },
                                {
                                    label: 'Hasil Kritis',
                                    icon: 'bi bi-exclamation-triangle text-danger',
                                    onclick: `hasilKritis('${noRawat}')`,
                                    extraAttrs: `data-id="${noRawat}"`,
                                },
                                {
                                    label: 'Upload Berkas Penunjang',
                                    icon: 'bi bi-upload text-secondary',
                                    onclick: `detailPeriksa('${noRawat}', 'Ranap')`,
                                },
                            ],
                        },
                        {
                            key: 'obat',
                            title: 'Terapi Obat & Gizi',
                            icon: 'bi-capsule-pill',
                            iconClass: 'is-obat',
                            items: [
                                {
                                    label: 'Permintaan Obat Harian (Ranap)',
                                    icon: 'bi bi-cart-plus text-success',
                                    onclick: `modalPermintaanObatRanap('${noRawat}')`,
                                },
                                {
                                    label: 'Jadwal & Pemberian Obat (E-MAR)',
                                    icon: 'bi bi-capsule-pill text-primary',
                                    onclick: `modalPemberianObatRanap('${noRawat}')`,
                                },
                                {
                                    label: 'Retur Obat Pasien',
                                    icon: 'bi bi-arrow-return-left text-primary',
                                    onclick: `bukaModalReturObatRanap('${noRawat}')`,
                                },
                                {
                                    label: 'Monitoring Cairan Pasien',
                                    icon: 'bi bi-droplet text-info',
                                    onclick: `showModalMonitoringCairan('${noRawat}')`,
                                },

                            ],
                        },
                        {
                            key: 'gizi',
                            title: 'Gizi',
                            icon: 'bi-cookie',
                            iconClass: 'is-gizi',
                            items: [
                                {
                                    label: 'Form Skrining Gizi',
                                    icon: 'bi bi-clipboard2-check text-success',
                                    onclick: `showModalSkriningGizi('${noRawat}')`,
                                    checked: row.rsia_skrining_gizi || row.skrining_gizi,
                                },
                                {
                                    label: 'Permintaan Diet Pasien',
                                    icon: 'fa-solid fa-utensils text-success',
                                    onclick: `showModalPermintaanDiet('${noRawat}')`,
                                },
                            ]
                        },
                        {
                            key: 'pulang',
                            title: 'Transfer & Obat Pulang',
                            icon: 'bi-arrow-left-right',
                            iconClass: 'is-pulang',
                            items: [
                                {
                                    label: 'Transfer Pasien Antar Ruang',
                                    icon: 'bi bi-arrow-left-right text-primary',
                                    onclick: `showModalTransferPasien('${noRawat}')`,
                                },
                                {
                                    label: 'Permintaan Resep Pulang',
                                    icon: 'bi bi-prescription2 text-primary',
                                    onclick: `bukaModalPermintaanResepPulang('${noRawat}')`,
                                },
                                {
                                    label: 'Edukasi Obat Pulang',
                                    icon: 'bi bi-capsule text-danger',
                                    onclick: `showModalObatPulang('${noRawat}')`,
                                    checked: row.edukasi_obat_pulang,
                                },
                            ],
                        },
                    ],

                    // 3) MENU LANGSUNG TERPISAH (1 KLIK)
                    directHeader: 'Dokumen &amp; Riwayat',
                    direct: [
                        {
                            label: 'Informed Consent',
                            icon: 'bi bi-file-earmark-medical text-primary',
                            onclick: `showModalPersetujuanAnestesi('${noRawat}')`,
                        },


                        {
                            label: 'Resume Medis',
                            icon: 'bi bi-file-text text-dark',
                            onclick: `resumeMedis('${noRawat}')`,
                            show: grupAksesResume.includes(isDokter),
                            checked: row.resume,
                            altCheckIcon: true,
                        },
                        {
                            label: 'Riwayat Pasien',
                            icon: 'bi bi-clock-history text-secondary',
                            onclick: `listRiwayatPasien('${noRm}')`,
                            extraAttrs: `data-id="${noRm}"`,
                        },
                    ],
                };
            }

            function buildMenuHtml(data, row) {
                const ctx = {
                    data,
                    row,
                    noRawat: data.no_rawat,
                    noRm: data.no_rkm_medis,
                    kdSps: row.reg_periksa?.dokter?.kd_sps,
                    isDokter: userDepartemen,
                };

                const cfg = getConfig(ctx);
                let html = '';

                // A. Quick Access Items
                const quickList = [...cfg.quick, ...extraItems.quick.map((fn) => fn(ctx))];
                quickList.forEach((q) => {
                    if (!q || q.show === false) return;
                    const badge = q.badge ? `<span class="badge text-bg-primary" style="font-size:9px;">${q.badge}</span>` : '';
                    const attrs = q.extraAttrs ? ` ${q.extraAttrs}` : '';
                    html += `
                                                                                                                                    <li class="mb-1">
                                                                                                                                        <a class="dropdown-item ranap-stage-quick" href="javascript:void(0)" onclick="${q.onclick}"${attrs}>
                                                                                                                                            <span><i class="${q.icon || ''}"></i> ${q.label}</span>
                                                                                                                                            ${badge}
                                                                                                                                        </a>
                                                                                                                                    </li>
                                                                                                                                `;
                });

                html += `<li><hr class="dropdown-divider my-1"></li>`;

                // B. Stage Submenus
                cfg.stages.forEach((st) => {
                    const dynamicSub = (extraItems.stages[st.key] || []).map((fn) => fn(ctx));
                    const subHtml = [...st.items, ...dynamicSub].map((it) => renderMenuItem(it, false)).join('');
                    if (!subHtml.trim()) return;

                    html += `
                                                                                                                                    <li class="ranap-stage-item" data-stage="${st.key}">
                                                                                                                                        <a class="dropdown-item ranap-stage-toggle" href="javascript:void(0)" role="button" aria-expanded="false">
                                                                                                                                            <span class="stage-left">
                                                                                                                                                <span class="ranap-stage-icon ${st.iconClass || ''}"><i class="bi ${st.icon || 'bi-folder'}"></i></span>
                                                                                                                                                <span>${st.title}</span>
                                                                                                                                            </span>
                                                                                                                                            <i class="bi bi-chevron-right ranap-stage-arrow"></i>
                                                                                                                                        </a>
                                                                                                                                        <ul class="dropdown-menu ranap-submenu">
                                                                                                                                            <li class="ranap-submenu-hdr"><i class="bi ${st.icon || 'bi-folder'} me-1"></i>${st.title}</li>
                                                                                                                                            ${subHtml}
                                                                                                                                        </ul>
                                                                                                                                    </li>
                                                                                                                                `;
                });

                // C. Direct Standalone Items
                const directList = [...cfg.direct, ...extraItems.direct.map((fn) => fn(ctx))];
                const directHtml = directList.map((it) => renderMenuItem(it, true)).join('');
                if (directHtml.trim()) {
                    html += `
                                                                                                                                    <li><hr class="dropdown-divider my-1"></li>
                                                                                                                                    <li class="ranap-stage-direct-hdr">${cfg.directHeader || 'Dokumen &amp; Riwayat'}</li>
                                                                                                                                    ${directHtml}
                                                                                                                                `;
                }

                return html;
            }

            function buildButtonHtml(rowIndex, noRawat, listItems) {
                return `
                                                                                                                                <div class="dropdown ranap-stage-dropdown">
                                                                                                                                    <button class="btn btn-primary btn-sm dropdown-toggle shadow-sm px-2 py-1" type="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" data-bs-popper-config='{"strategy":"fixed"}' aria-expanded="false" id="dropdownAksi${rowIndex}" data-id="${noRawat}">
                                                                                                                                        <i class="bi bi-list-task"></i>
                                                                                                                                    </button>
                                                                                                                                    <ul class="dropdown-menu ranap-stage-menu">
                                                                                                                                        ${listItems}
                                                                                                                                    </ul>
                                                                                                                                </div>
                                                                                                                            `;
            }

            // Smart submenu positioning relatif terhadap .ranap-stage-item (bebas dari bug transform Popper.js)
            function positionSubmenu($stageItem) {
                const $sub = $stageItem.children('.ranap-submenu');
                if (!$sub.length) return;

                if (window.innerWidth < 992) {
                    $sub.removeAttr('style');
                    return;
                }

                const rect = $stageItem[0].getBoundingClientRect();
                const vw = window.innerWidth;
                const vh = window.innerHeight;

                $sub.css({
                    left: 'calc(100% - 2px)',
                    right: 'auto',
                    top: '-4px',
                    bottom: 'auto',
                    visibility: 'hidden',
                    display: 'block',
                });

                const subW = $sub.outerWidth();
                const subH = $sub.outerHeight();
                const flipLeft = (rect.right - 2 + subW) > (vw - 10);

                let relTop = -4;
                const overflowBottom = (rect.top + relTop + subH) - (vh - 10);
                if (overflowBottom > 0) {
                    relTop -= overflowBottom;
                    if (rect.top + relTop < 10) {
                        relTop = 10 - rect.top;
                    }
                }

                $sub.css({
                    left: flipLeft ? 'auto' : 'calc(100% - 2px)',
                    right: flipLeft ? 'calc(100% - 2px)' : 'auto',
                    top: `${Math.round(relTop)}px`,
                    bottom: 'auto',
                    visibility: 'visible',
                    display: '',
                });
            }

            // Public API agar mudah menambah item dari mana saja
            window.RanapDropdownMenu = {
                getConfig: getConfig,
                buildMenu: buildMenuHtml,
                buildButton: buildButtonHtml,
                registerItem: function (target, itemFactory) {
                    if (typeof itemFactory !== 'function') return;
                    if (target === 'quick') {
                        extraItems.quick.push(itemFactory);
                    } else if (target === 'direct') {
                        extraItems.direct.push(itemFactory);
                    } else {
                        if (!extraItems.stages[target]) extraItems.stages[target] = [];
                        extraItems.stages[target].push(itemFactory);
                    }
                },
            };

            // Backward-compatible global functions dipakai oleh #tb_ranap
            window.buildCategorizedMenuRanap = buildMenuHtml;
            window.buildDropdownButton = buildButtonHtml;

            // Delegated Event Handlers
            $(document).on('mouseenter', '.ranap-stage-menu .ranap-stage-item', function () {
                if (window.innerWidth < 992) return;
                const $item = $(this);
                $item.siblings('.ranap-stage-item').removeClass('is-sub-open').children('.ranap-stage-toggle').attr('aria-expanded', 'false');
                $item.addClass('is-sub-open').children('.ranap-stage-toggle').attr('aria-expanded', 'true');
                positionSubmenu($item);
            });

            $(document).on('click', '.ranap-stage-menu .ranap-stage-toggle', function (e) {
                e.preventDefault();
                e.stopPropagation();
                const $item = $(this).closest('.ranap-stage-item');
                const isOpen = $item.hasClass('is-sub-open');
                $item.siblings('.ranap-stage-item').removeClass('is-sub-open').children('.ranap-stage-toggle').attr('aria-expanded', 'false');
                if (!isOpen) {
                    $item.addClass('is-sub-open').children('.ranap-stage-toggle').attr('aria-expanded', 'true');
                    positionSubmenu($item);
                } else {
                    $item.removeClass('is-sub-open').children('.ranap-stage-toggle').attr('aria-expanded', 'false');
                }
            });

            $(document).on('mouseenter', '.ranap-stage-menu .ranap-stage-direct, .ranap-stage-menu .ranap-stage-quick', function () {
                if (window.innerWidth < 992) return;
                $(this).closest('.ranap-stage-menu').find('.ranap-stage-item').removeClass('is-sub-open').children('.ranap-stage-toggle').attr('aria-expanded', 'false');
            });

            $(document).on('click', '.ranap-stage-menu .ranap-submenu .dropdown-item, .ranap-stage-menu .ranap-stage-quick, .ranap-stage-menu .ranap-stage-direct', function () {
                const $dropdown = $(this).closest('.ranap-stage-dropdown');
                const toggleBtn = $dropdown.find('> button[data-bs-toggle="dropdown"]')[0];
                if (toggleBtn) {
                    bootstrap.Dropdown.getOrCreateInstance(toggleBtn).hide();
                }
            });

            $(document).on('hide.bs.dropdown', '.ranap-stage-dropdown', function () {
                $(this).find('.ranap-stage-item').removeClass('is-sub-open');
                $(this).find('.ranap-stage-toggle').attr('aria-expanded', 'false');
                $(this).find('.ranap-submenu').removeAttr('style');
            });
        })(window, jQuery);
    </script>
@endpush