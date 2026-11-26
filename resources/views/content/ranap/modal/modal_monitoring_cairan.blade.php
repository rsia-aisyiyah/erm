<style>
    /* ======================================================
       SCOPED STYLES: #modalMonitoringCairan
       ====================================================== */
    #modalMonitoringCairan .modal-content {
        background: #f4f6f9;
        border: 0;
        border-radius: 14px;
        overflow: hidden;
    }

    #modalMonitoringCairan .mc-modal-header {
        background: #ffffff;
        border-bottom: 1px solid #e2e8f0;
        padding: 12px 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 10px;
    }

    #modalMonitoringCairan .mc-patient-strip {
        display: flex;
        align-items: center;
        gap: 10px;
        min-width: 0;
        flex: 1 1 auto;
    }

    #modalMonitoringCairan .mc-avatar {
        width: 40px;
        height: 40px;
        border-radius: 11px;
        background: linear-gradient(135deg, #e0f2fe, #dbeafe);
        color: #0284c7;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
    }

    #modalMonitoringCairan .mc-meta-row {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 5px;
        margin-top: 3px;
    }

    #modalMonitoringCairan .mc-chip {
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
        max-width: 240px;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    #modalMonitoringCairan .modal-body {
        padding: 14px 16px !important;
        background: #f4f6f9;
    }

    #modalMonitoringCairan .mc-kpi-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 10px;
        margin-bottom: 12px;
    }

    #modalMonitoringCairan .mc-kpi-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-left: 4px solid #2563eb;
        border-radius: 10px;
        padding: 9px 12px;
        box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
    }

    #modalMonitoringCairan .mc-kpi-card.is-intake {
        border-left-color: #0284c7;
    }

    #modalMonitoringCairan .mc-kpi-card.is-output {
        border-left-color: #d97706;
    }

    #modalMonitoringCairan .mc-kpi-card.is-balance {
        border-left-color: #16a34a;
    }

    #modalMonitoringCairan .mc-kpi-card.is-count {
        border-left-color: #6366f1;
    }

    #modalMonitoringCairan .mc-kpi-lbl {
        font-size: 10.5px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.35px;
        color: #64748b;
    }

    #modalMonitoringCairan .mc-kpi-val {
        font-size: 17px;
        font-weight: 800;
        color: #0f172a;
        line-height: 1.25;
        margin-top: 2px;
    }

    #modalMonitoringCairan .mc-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 11px;
        padding: 12px 14px;
        margin-bottom: 12px;
        box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
    }

    #modalMonitoringCairan .mc-card-title {
        font-size: 12px;
        font-weight: 700;
        color: #1e293b;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 6px;
        padding-bottom: 8px;
        margin-bottom: 10px;
        border-bottom: 1px dashed #e2e8f0;
    }

    #modalMonitoringCairan .mc-subpanel {
        border-radius: 9px;
        padding: 10px 12px;
        border: 1px solid #e2e8f0;
        height: 100%;
    }

    #modalMonitoringCairan .mc-subpanel.is-ttv {
        background: #f8fafc;
        border-color: #cbd5e1;
    }

    #modalMonitoringCairan .mc-subpanel.is-intake {
        background: #f0f9ff;
        border-color: #bae6fd;
    }

    #modalMonitoringCairan .mc-subpanel.is-output {
        background: #fffbeb;
        border-color: #fde68a;
    }

    #modalMonitoringCairan .mc-subpanel-hdr {
        font-size: 11.5px;
        font-weight: 700;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 6px;
    }

    #modalMonitoringCairan .mc-form-label {
        font-size: 11px;
        font-weight: 600;
        color: #475569;
        margin-bottom: 3px;
    }

    #modalMonitoringCairan #tbMonitoringCairanPasien {
        font-size: 12px;
        margin-top: 0 !important;
    }

    #modalMonitoringCairan #tbMonitoringCairanPasien thead th {
        background: #f1f5f9;
        color: #334155;
        font-size: 10.5px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        white-space: nowrap;
        vertical-align: middle;
        border-color: #cbd5e1;
    }

    #modalMonitoringCairan #tbMonitoringCairanPasien tbody td {
        vertical-align: middle;
    }

    #modalMonitoringCairan .mc-modal-footer {
        background: #ffffff;
        border-top: 1px solid #e2e8f0;
        padding: 10px 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 8px;
    }

    @media (max-width: 991.98px) {
        #modalMonitoringCairan .mc-kpi-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 575.98px) {
        #modalMonitoringCairan .mc-avatar {
            display: none;
        }
        #modalMonitoringCairan .mc-kpi-val {
            font-size: 15px;
        }
    }
</style>

<div class="modal fade" id="modalMonitoringCairan" data-bs-focus="false" data-erm-loader="true" data-erm-loading-text="Memuat monitoring cairan..." tabindex="-1" aria-labelledby="modalMonitoringCairanLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            {{-- Sticky Patient Header --}}
            <div class="modal-header mc-modal-header">
                <div class="mc-patient-strip">
                    <div class="mc-avatar">
                        <i class="bi bi-droplet-half"></i>
                    </div>
                    <div class="min-w-0">
                        <div class="d-flex align-items-center flex-wrap gap-2">
                            <h5 class="modal-title fw-bold mb-0 text-dark" id="modalMonitoringCairanLabel" style="font-size: 14.5px;">
                                Monitoring Keseimbangan Cairan Pasien
                            </h5>
                            <span class="badge text-bg-primary bg-opacity-10 text-primary border border-primary-subtle" id="mcHdrPasienNama" style="font-size: 11px;">-</span>
                        </div>
                        <div class="mc-meta-row">
                            <span class="mc-chip" title="Nomor Rawat"><i class="bi bi-hash text-secondary"></i><span id="mcHdrNoRawat">-</span></span>
                            <span class="mc-chip" title="Keluarga / PJ"><i class="bi bi-people-fill text-warning"></i>PJ: <span id="mcHdrKeluarga">-</span></span>
                            <span class="mc-chip" title="Bangsal / Kamar"><i class="bi bi-door-open text-primary"></i><span id="mcHdrKamar">-</span></span>
                            <span class="mc-chip" title="Dokter DPJP"><i class="bi bi-person-badge text-success"></i><span id="mcHdrDokter">-</span></span>
                            <span class="mc-chip" title="Diagnosa Awal"><i class="bi bi-clipboard2-pulse text-danger"></i>Dx: <span id="mcHdrDiagnosa">-</span></span>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2 flex-shrink-0">
                    <span data-erm-loader-status class="erm-loader-pill is-idle"></span>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>

            <div class="modal-body">
                {{-- Ringkasan KPI Keseimbangan Cairan (Auto-dihitung dari tabel riwayat) --}}
                <div class="mc-kpi-grid">
                    <div class="mc-kpi-card is-intake">
                        <div class="mc-kpi-lbl"><i class="bi bi-arrow-down-circle-fill text-info me-1"></i>Total Cairan Masuk</div>
                        <div class="mc-kpi-val text-primary" id="mcKpiIntake">0 <small class="fs-6 fw-normal text-muted">cc</small></div>
                    </div>
                    <div class="mc-kpi-card is-output">
                        <div class="mc-kpi-lbl"><i class="bi bi-arrow-up-circle-fill text-warning me-1"></i>Total Cairan Keluar</div>
                        <div class="mc-kpi-val text-warning-emphasis" id="mcKpiOutput">0 <small class="fs-6 fw-normal text-muted">cc</small></div>
                    </div>
                    <div class="mc-kpi-card is-balance">
                        <div class="mc-kpi-lbl"><i class="bi bi-speedometer2 text-success me-1"></i>Keseimbangan (Balance)</div>
                        <div class="mc-kpi-val" id="mcKpiBalance">0 <small class="fs-6 fw-normal text-muted">cc</small></div>
                    </div>
                    <div class="mc-kpi-card is-count">
                        <div class="mc-kpi-lbl"><i class="bi bi-journal-check text-primary me-1"></i>Jumlah Pemantauan</div>
                        <div class="mc-kpi-val text-dark" id="mcKpiCount">0 <small class="fs-6 fw-normal text-muted">catatan</small></div>
                    </div>
                </div>

                {{-- Form Input Monitoring Cairan --}}
                <form action="" id="formMonitoringCairan">
                    @csrf()
                    {{-- Input identitas scoped IDs (zero collision dengan modal lain) --}}
                    <input type="hidden" id="mc_no_rawat" name="no_rawat">
                    <input type="hidden" id="mc_nm_pasien" name="nm_pasien">
                    <input type="hidden" id="mc_keluarga" name="keluarga">
                    <input type="hidden" id="mc_kamar" name="kamar">
                    <input type="hidden" id="mc_diagnosa" name="diagnosa">
                    <input type="hidden" id="mc_dokter" name="dokter">
                    <input type="hidden" id="mc_kd_dokter" name="kd_dokter">

                    <div class="mc-card">
                        <div class="mc-card-title">
                            <span><i class="bi bi-plus-circle-fill text-primary me-1"></i>Input Pemantauan Keseimbangan Cairan</span>
                            <div class="d-flex align-items-center gap-2 flex-wrap">
                                <span class="badge text-bg-light border text-dark" id="mcDraftBalancePreview" style="font-size: 11px;">
                                    Estimasi Balance Input: <strong>0 cc</strong>
                                </span>
                                <button type="button" class="btn btn-outline-primary btn-sm py-0 px-2" id="searchPemeriksaanRanap" style="font-size: 11px;" title="Ambil Suhu, Nadi, dan Tekanan Darah dari CPPT Ranap">
                                    <i class="bi bi-search me-1"></i>Tarik TTV dari CPPT
                                </button>
                                <button type="button" class="btn btn-outline-secondary btn-sm py-0 px-2" onclick="resetInputMonitoringCairan()" style="font-size: 11px;" title="Bersihkan kolom isian">
                                    <i class="bi bi-arrow-counterclockwise me-1"></i>Reset
                                </button>
                            </div>
                        </div>

                        <div class="row g-3 sectionMonitoring">
                            {{-- Blok 1: TTV --}}
                            <div class="col-12 col-lg-4">
                                <div class="mc-subpanel is-ttv">
                                    <div class="mc-subpanel-hdr text-dark">
                                        <span><i class="bi bi-heart-pulse-fill text-danger me-1"></i>Tanda-Tanda Vital (TTV)</span>
                                    </div>
                                    <div class="row g-2">
                                        <div class="col-6 col-sm-4 col-lg-6">
                                            <label for="mc_suhu_tubuh" class="mc-form-label">Suhu Tubuh</label>
                                            <div class="input-group input-group-sm">
                                                <input type="text" class="form-control" id="mc_suhu_tubuh" name="suhu_tubuh" placeholder="36.5" autocomplete="off">
                                                <span class="input-group-text">°C</span>
                                            </div>
                                        </div>
                                        <div class="col-6 col-sm-4 col-lg-6">
                                            <label for="mc_nadi" class="mc-form-label">Nadi</label>
                                            <div class="input-group input-group-sm">
                                                <input type="text" class="form-control" id="mc_nadi" name="nadi" placeholder="80" autocomplete="off">
                                                <span class="input-group-text">x/mnt</span>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4 col-lg-12">
                                            <label for="mc_tensi" class="mc-form-label">Tekanan Darah</label>
                                            <div class="input-group input-group-sm">
                                                <input type="text" class="form-control" id="mc_tensi" name="tensi" placeholder="120/80" autocomplete="off">
                                                <span class="input-group-text">mmHg</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Blok 2: Cairan Masuk (Intake) --}}
                            <div class="col-12 col-lg-3">
                                <div class="mc-subpanel is-intake">
                                    <div class="mc-subpanel-hdr text-primary">
                                        <span><i class="bi bi-droplet-fill text-info me-1"></i>Cairan Masuk (Intake)</span>
                                    </div>
                                    <div class="row g-2">
                                        <div class="col-6 col-lg-12">
                                            <label for="mc_jumlah_carian_infus" class="mc-form-label">Jml. Cairan Infus</label>
                                            <div class="input-group input-group-sm">
                                                <input type="text" class="form-control mc-calc-input" id="mc_jumlah_carian_infus" name="jumlah_carian_infus" placeholder="0" autocomplete="off">
                                                <span class="input-group-text">cc</span>
                                            </div>
                                        </div>
                                        <div class="col-6 col-lg-12">
                                            <label for="mc_jumlah_tetes_permenit" class="mc-form-label">Kecepatan Tetes</label>
                                            <div class="input-group input-group-sm">
                                                <input type="text" class="form-control" id="mc_jumlah_tetes_permenit" name="jumlah_tetes_permenit" placeholder="20" autocomplete="off">
                                                <span class="input-group-text">tpm</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Blok 3: Cairan Keluar (Output) --}}
                            <div class="col-12 col-lg-5">
                                <div class="mc-subpanel is-output">
                                    <div class="mc-subpanel-hdr text-warning-emphasis">
                                        <span><i class="bi bi-box-arrow-up text-warning me-1"></i>Cairan Keluar (Output)</span>
                                    </div>
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <label for="mc_jumlah_urine" class="mc-form-label">Jumlah Urine</label>
                                            <div class="input-group input-group-sm">
                                                <input type="text" class="form-control mc-calc-input" id="mc_jumlah_urine" name="jumlah_urine" placeholder="0" autocomplete="off">
                                                <span class="input-group-text">cc</span>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label for="mc_cairan_lambung" class="mc-form-label">Cairan Lambung (NGT)</label>
                                            <div class="input-group input-group-sm">
                                                <input type="text" class="form-control mc-calc-input" id="mc_cairan_lambung" name="cairan_lambung" placeholder="0" autocomplete="off">
                                                <span class="input-group-text">cc</span>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label for="mc_cairan_drain" class="mc-form-label">Cairan Drain</label>
                                            <div class="input-group input-group-sm">
                                                <input type="text" class="form-control mc-calc-input" id="mc_cairan_drain" name="cairan_drain" placeholder="0" autocomplete="off">
                                                <span class="input-group-text">cc</span>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label for="mc_lainnya" class="mc-form-label">Lain-lain (Muntah/BAB/dll)</label>
                                            <div class="input-group input-group-sm">
                                                <input type="text" class="form-control mc-calc-input" id="mc_lainnya" name="lainnya" placeholder="0 / -" autocomplete="off">
                                                <span class="input-group-text">cc</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                {{-- Tabel Riwayat Monitoring Keseimbangan Cairan --}}
                <div class="mc-card mb-0">
                    <div class="mc-card-title">
                        <span><i class="bi bi-table text-primary me-1"></i>Riwayat Monitoring Keseimbangan Cairan</span>
                        <button type="button" class="btn btn-outline-secondary btn-sm py-0 px-2" onclick="loadTbMonitoringCairan($('#mc_no_rawat').val())" style="font-size: 11px;">
                            <i class="bi bi-arrow-clockwise me-1"></i>Muat Ulang
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-sm align-middle w-100" id="tbMonitoringCairanPasien"></table>
                    </div>
                </div>
            </div>

            <div class="modal-footer mc-modal-footer">
                <div class="small text-muted">
                    <i class="bi bi-person-check text-primary me-1"></i>Petugas input: <strong class="text-dark">{{ session()->get('pegawai')->nama }}</strong>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <button type="button" class="btn btn-primary btn-sm" style="font-size: 12px" id="btnSimpanMonitoringCairanPasien">
                        <i class="bi bi-save me-1"></i> Simpan Monitoring
                    </button>
                    <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal" style="font-size: 12px">
                        <i class="bi bi-x-circle me-1"></i> Keluar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal Pilihan TTV dari CPPT Ranap --}}
<div class="modal fade" id="modalPemeriksaanRapanCairan" data-bs-focus="false" tabindex="-1" aria-labelledby="modalPemeriksaanRapanCairanLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title fs-6 fw-bold" id="modalPemeriksaanRapanCairanLabel">
                    <i class="bi bi-clipboard2-pulse text-primary me-1"></i>Pilih TTV dari Pemeriksaan CPPT Ranap
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-sm align-middle mb-0" id="tbPemeriksaanRanapCairan" style="font-size: 12px;">
                        <thead class="table-light">
                            <tr>
                                <th>Tanggal</th>
                                <th>Jam</th>
                                <th>Suhu</th>
                                <th>Nadi</th>
                                <th>Tensi</th>
                                <th>Petugas</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        const modalMonitoringCairan = $('#modalMonitoringCairan');
        const formMonitoringCairan = $('#formMonitoringCairan');
        const tbMonitoringCairanPasien = $('#tbMonitoringCairanPasien');
        const btnSimpanMonitoringCairanPasien = $('#btnSimpanMonitoringCairanPasien');
        const searchPemeriksaanRanap = $('#searchPemeriksaanRanap');
        const modalPemeriksaanRapanCairan = $('#modalPemeriksaanRapanCairan');
        const tbPemeriksaanRanapCairan = $('#tbPemeriksaanRanapCairan');

        function parseMcNumber(val) {
            if (val === null || val === undefined) return 0;
            const cleaned = String(val).replace(',', '.').match(/-?\d+(\.\d+)?/);
            return cleaned ? parseFloat(cleaned[0]) : 0;
        }

        function formatMcCc(num) {
            const rounded = Math.round((Number(num) || 0) * 10) / 10;
            return Number.isInteger(rounded) ? rounded.toLocaleString('id-ID') : rounded.toLocaleString('id-ID', { maximumFractionDigits: 1 });
        }

        function updateMcDraftPreview() {
            const intake = parseMcNumber($('#mc_jumlah_carian_infus').val());
            const output = parseMcNumber($('#mc_jumlah_urine').val())
                + parseMcNumber($('#mc_cairan_lambung').val())
                + parseMcNumber($('#mc_cairan_drain').val())
                + parseMcNumber($('#mc_lainnya').val());
            const bal = intake - output;
            const sign = bal > 0 ? '+' : '';
            const cls = bal === 0 ? 'text-dark' : (bal > 0 ? 'text-primary' : 'text-danger');
            $('#mcDraftBalancePreview').html(
                `Estimasi Balance Input: <strong class="${cls}">${sign}${formatMcCc(bal)} cc</strong> <span class="text-muted">(In ${formatMcCc(intake)} / Out ${formatMcCc(output)})</span>`
            );
        }

        function resetInputMonitoringCairan() {
            formMonitoringCairan.find('.sectionMonitoring input').val('');
            updateMcDraftPreview();
        }

        $(document).on('input', '#formMonitoringCairan .mc-calc-input', updateMcDraftPreview);

        modalMonitoringCairan.on('hidden.bs.modal', () => {
            resetInputMonitoringCairan();
        });

        searchPemeriksaanRanap.on('click', () => {
            const no_rawat = $('#mc_no_rawat').val();
            if (!no_rawat) return;

            getPemeriksaanRanap(no_rawat).done((response) => {
                modalPemeriksaanRapanCairan.modal('show');
                const rows = Array.isArray(response) ? response : [];
                if (!rows.length) {
                    tbPemeriksaanRanapCairan.find('tbody').html(
                        '<tr><td colspan="7" class="text-center text-muted py-3">Belum ada data pemeriksaan CPPT Ranap.</td></tr>'
                    );
                    return;
                }

                const content = rows.map((item, index) => {
                    const suhu = item.suhu_tubuh ?? '-';
                    const nadi = item.nadi ?? '-';
                    const tensi = item.tensi ?? '-';
                    const petugas = item.petugas?.nama ?? '-';
                    return `<tr class="cursor-pointer" data-suhu="${String(suhu).replace(/"/g, '&quot;')}" data-nadi="${String(nadi).replace(/"/g, '&quot;')}" data-tensi="${String(tensi).replace(/"/g, '&quot;')}" onclick="setPemeriksaanCairan(this)">
                        <td class="text-nowrap">${splitTanggal(item.tgl_perawatan)}</td>
                        <td class="text-nowrap">${item.jam_rawat || '-'}</td>
                        <td class="text-nowrap fw-semibold">${suhu} °C</td>
                        <td class="text-nowrap">${nadi} x/mnt</td>
                        <td class="text-nowrap">${tensi} mmHg</td>
                        <td>${petugas}</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-outline-primary btn-sm py-0 px-2" style="font-size:11px;">Pilih</button>
                        </td>
                    </tr>`;
                }).join('');

                tbPemeriksaanRanapCairan.find('tbody').html(content);
            });
        });

        function setPemeriksaanCairan(rowEl) {
            const $tr = $(rowEl);
            $('#mc_suhu_tubuh').val($tr.data('suhu'));
            $('#mc_nadi').val($tr.data('nadi'));
            $('#mc_tensi').val($tr.data('tensi'));
            modalPemeriksaanRapanCairan.modal('hide');
        }

        function showModalMonitoringCairan(no_rawat) {
            resetInputMonitoringCairan();
            getRegPeriksa(no_rawat).done((response) => {
                loadTbMonitoringCairan(no_rawat);
                const { pasien, kamar_inap, dokter } = response;

                const listKamar = Array.isArray(kamar_inap) ? kamar_inap : [];
                const activeKamar = listKamar.find((item) => item.stts_pulang !== 'Pindah Kamar') || listKamar[listKamar.length - 1] || null;
                const nmBangsal = activeKamar?.kamar?.bangsal?.nm_bangsal || '-';
                const diagAwal = activeKamar?.diagnosa_awal || '-';
                const nmPasienFull = `${pasien?.nm_pasien || '-'} (${response.umurdaftar || ''} ${response.sttsumur || ''})`.trim();
                const keluarga = response.p_jawab || '-';
                const nmDokter = dokter?.nm_dokter || '-';

                // Populate hidden form inputs
                $('#mc_no_rawat').val(no_rawat);
                $('#mc_nm_pasien').val(nmPasienFull);
                $('#mc_keluarga').val(keluarga);
                $('#mc_kamar').val(nmBangsal);
                $('#mc_diagnosa').val(diagAwal);
                $('#mc_dokter').val(nmDokter);
                $('#mc_kd_dokter').val(response.kd_dokter || '');

                // Populate Sticky Header chips
                $('#mcHdrPasienNama').text(nmPasienFull);
                $('#mcHdrNoRawat').text(no_rawat);
                $('#mcHdrKeluarga').text(keluarga);
                $('#mcHdrKamar').text(nmBangsal);
                $('#mcHdrDokter').text(nmDokter);
                $('#mcHdrDiagnosa').text(diagAwal);

                modalMonitoringCairan.modal('show');
            });
        }

        btnSimpanMonitoringCairanPasien.on('click', () => {
            const data = getDataForm('#formMonitoringCairan', ['input']);
            if (!data.no_rawat) {
                Swal.fire('Perhatian', 'Nomor rawat pasien tidak valid.', 'warning');
                return;
            }

            const xhr = $.post(`${url}/monitoring/cairan/pasien`, data)
                .done(() => {
                    alertSuccessAjax('Data monitoring cairan tersimpan').then(() => {
                        loadTbMonitoringCairan(data.no_rawat);
                        resetInputMonitoringCairan();
                    });
                })
                .fail((request) => {
                    alertErrorAjax(request);
                });

            if (typeof ErmLoader !== 'undefined' && typeof ErmLoader.button === 'function') {
                ErmLoader.button('#btnSimpanMonitoringCairanPasien', xhr, 'Menyimpan...');
            }
        });

        function updateMcKpiSummary(rows) {
            const list = Array.isArray(rows) ? rows : [];
            let totalIn = 0;
            let totalOut = 0;

            list.forEach((r) => {
                totalIn += parseMcNumber(r.jumlah_carian_infus);
                totalOut += parseMcNumber(r.jumlah_urine)
                    + parseMcNumber(r.cairan_lambung)
                    + parseMcNumber(r.cairan_drain)
                    + parseMcNumber(r.lainnya);
            });

            const balance = totalIn - totalOut;
            const sign = balance > 0 ? '+' : '';
            const balCls = balance === 0 ? 'text-success' : (balance > 0 ? 'text-primary' : 'text-danger');

            $('#mcKpiIntake').html(`${formatMcCc(totalIn)} <small class="fs-6 fw-normal text-muted">cc</small>`);
            $('#mcKpiOutput').html(`${formatMcCc(totalOut)} <small class="fs-6 fw-normal text-muted">cc</small>`);
            $('#mcKpiBalance')
                .removeClass('text-success text-primary text-danger')
                .addClass(balCls)
                .html(`${sign}${formatMcCc(balance)} <small class="fs-6 fw-normal text-muted">cc</small>`);
            $('#mcKpiCount').html(`${list.length} <small class="fs-6 fw-normal text-muted">catatan</small>`);
        }

        function loadTbMonitoringCairan(no_rawat) {
            if (!no_rawat) return;

            tbMonitoringCairanPasien.DataTable({
                destroy: true,
                processing: true,
                ordering: false,
                pageLength: 10,
                autoWidth: false,
                ajax: {
                    url: `${url}/monitoring/cairan/pasien`,
                    data: {
                        'no_rawat': no_rawat,
                    },
                    dataSrc: function (json) {
                        const rows = json?.data || [];
                        updateMcKpiSummary(rows);
                        return rows;
                    },
                },
                columns: [
                    {
                        data: 'tgl_perawatan',
                        title: 'Waktu',
                        render: (data, type, row) => {
                            const tgl = row.tgl_perawatan ? splitTanggal(row.tgl_perawatan) : '-';
                            return `<div class="fw-semibold text-nowrap">${tgl}</div><div class="text-muted small">${row.jam_rawat || '-'}</div>`;
                        },
                        name: 'tgl_perawatan'
                    },
                    {
                        data: null,
                        title: 'Petugas',
                        render: (data, type, row) => {
                            return `<span class="fw-semibold text-dark">${row.petugas?.nama ?? row.nip ?? '-'}</span>`;
                        },
                        name: 'petugas'
                    },
                    {
                        data: null,
                        title: 'TTV (S / N / TD)',
                        render: (data, type, row) => {
                            return `<div class="text-nowrap small">
                                <span class="badge text-bg-light border text-dark">S: ${row.suhu_tubuh || '-'} °C</span>
                                <span class="badge text-bg-light border text-dark">N: ${row.nadi || '-'}</span>
                                <span class="badge text-bg-light border text-dark">TD: ${row.tensi || '-'}</span>
                            </div>`;
                        },
                        name: 'ttv'
                    },
                    {
                        data: 'jumlah_carian_infus',
                        title: 'Infus (In)',
                        render: (data) => `<span class="fw-bold text-primary">${data || '-'}</span>`,
                        name: 'jumlah_carian_infus'
                    },
                    {
                        data: 'jumlah_tetes_permenit',
                        title: 'Tetes/mnt',
                        render: (data) => data || '-',
                        name: 'jumlah_tetes_permenit'
                    },
                    {
                        data: 'jumlah_urine',
                        title: 'Urine',
                        render: (data) => data || '-',
                        name: 'jumlah_urine'
                    },
                    {
                        data: 'cairan_lambung',
                        title: 'Lambung',
                        render: (data) => data || '-',
                        name: 'cairan_lambung'
                    },
                    {
                        data: 'cairan_drain',
                        title: 'Drain',
                        render: (data) => data || '-',
                        name: 'cairan_drain'
                    },
                    {
                        data: 'lainnya',
                        title: 'Lain-lain',
                        render: (data) => data || '-',
                        name: 'lainnya'
                    },
                    {
                        data: null,
                        title: 'Balance',
                        render: (data, type, row) => {
                            const ins = parseMcNumber(row.jumlah_carian_infus);
                            const outs = parseMcNumber(row.jumlah_urine)
                                + parseMcNumber(row.cairan_lambung)
                                + parseMcNumber(row.cairan_drain)
                                + parseMcNumber(row.lainnya);
                            const bal = ins - outs;
                            const sign = bal > 0 ? '+' : '';
                            const cls = bal === 0 ? 'text-bg-success' : (bal > 0 ? 'text-bg-primary' : 'text-bg-danger');
                            return `<span class="badge ${cls}">${sign}${formatMcCc(bal)} cc</span>`;
                        },
                        name: 'balance'
                    },
                    {
                        title: 'Aksi',
                        name: 'action',
                        className: 'text-center',
                        render: (data, type, row) => {
                            return `<button class="btn btn-outline-danger btn-sm py-0 px-2" type="button" title="Hapus catatan" onclick="deleteMonitorCairanPasien('${row.no_rawat}', '${row.tgl_perawatan}', '${row.jam_rawat}')"><i class="bi bi-trash"></i></button>`;
                        }
                    },
                ],
                language: {
                    emptyTable: 'Belum ada data monitoring keseimbangan cairan pasien',
                    zeroRecords: 'Data tidak ditemukan',
                    search: 'Cari:',
                    lengthMenu: 'Tampilkan _MENU_ entri',
                    info: 'Menampilkan _START_–_END_ dari _TOTAL_ catatan',
                    infoEmpty: '0 catatan',
                },
            });
        }

        function deleteMonitorCairanPasien(no_rawat, tgl, jam) {
            Swal.fire({
                title: 'Hapus catatan cairan?',
                text: `Data monitoring tanggal ${splitTanggal(tgl)} jam ${jam} akan dihapus permanen.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post(`${url}/monitoring/cairan/pasien/delete`, {
                        no_rawat: no_rawat,
                        tgl_perawatan: tgl,
                        jam_rawat: jam,
                        _token: '{{ csrf_token() }}'
                    }).done(() => {
                        alertSuccessAjax('Data berhasil dihapus').then(() => {
                            loadTbMonitoringCairan(no_rawat);
                        });
                    }).fail((request) => {
                        alertErrorAjax(request);
                    });
                }
            });
        }
    </script>
@endpush
