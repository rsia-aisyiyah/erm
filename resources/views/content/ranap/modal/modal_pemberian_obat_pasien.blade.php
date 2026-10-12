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
                            <div class="col-md-3 col-6">
                                <label class="text-muted small mb-0 d-block" style="font-size: 10px;">NO. RAWAT</label>
                                <strong class="text-primary font-monospace" id="emar_info_no_rawat">-</strong>
                            </div>
                            <div class="col-md-2 col-6">
                                <label class="text-muted small mb-0 d-block" style="font-size: 10px;">NO. REKAM MEDIS</label>
                                <strong class="text-dark font-monospace" id="emar_info_no_rkm_medis">-</strong>
                            </div>
                            <div class="col-md-4 col-12">
                                <label class="text-muted small mb-0 d-block" style="font-size: 10px;">NAMA PASIEN</label>
                                <strong class="text-dark" id="emar_info_nm_pasien">-</strong>
                            </div>
                            <div class="col-md-3 col-12">
                                <label class="text-muted small mb-0 d-block" style="font-size: 10px;">KAMAR / BANGSAL</label>
                                <strong class="text-dark" id="emar_info_kamar">-</strong>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CONTROL BAR & FILTER TANGGAL -->
                <div class="card border-0 shadow-sm rounded-3 mb-3 bg-white">
                    <div class="card-body py-2 px-3">
                        <div class="row g-2 align-items-center justify-content-between">
                            <div class="col-md-5 col-12 d-flex align-items-center gap-2">
                                <label class="form-label small fw-bold mb-0 text-nowrap" style="font-size: 11.5px;">
                                    <i class="bi bi-calendar-event text-primary me-1"></i> Tanggal E-MAR:
                                </label>
                                <input type="date" class="form-control form-control-sm w-auto" id="emar_filter_tanggal" value="{{ date('Y-m-d') }}">
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
                                        <th width="12%">Jam Beri</th>
                                        <th width="28%">Nama Obat / BHP</th>
                                        <th width="8%">Jumlah</th>
                                        <th width="8%">Satuan</th>
                                        <th width="12%">Biaya Satuan</th>
                                        <th width="12%">Total Biaya</th>
                                        <th width="16%">Aturan Pakai</th>
                                        <th width="8%">Aksi</th>
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

            <div class="modal-footer py-1.5 px-3 bg-white">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
            </div>

        </div>
    </div>
</div>

<!-- Submodal Form Dialog Pemberian Obat -->
<div class="modal fade" id="modalDialogEksekusiBeriObat" tabindex="-1" aria-hidden="true" style="z-index: 1060;">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-success text-white py-2 px-3">
                <h6 class="modal-title fw-bold" style="font-size: 12.5px;">
                    <i class="bi bi-capsule me-1"></i> Catat Pemberian Obat
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

                    <div class="mb-2">
                        <label class="form-label small text-muted mb-0">Nama Obat:</label>
                        <div class="fw-bold text-dark" id="lblEksekusiNamaObat" style="font-size: 12px;">-</div>
                        <small class="text-success" id="lblEksekusiSisaStok">Sisa Stok: 0</small>
                    </div>

                    <div class="row g-2 mb-2">
                        <div class="col-6">
                            <label class="form-label small fw-bold mb-1">Tanggal</label>
                            <input type="date" class="form-control form-control-sm" id="eksekusi_tanggal" value="{{ date('Y-m-d') }}">
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-bold mb-1">Jam Beri</label>
                            <input type="time" step="1" class="form-control form-control-sm text-center" id="eksekusi_jam" value="{{ date('H:i:s') }}">
                        </div>
                    </div>

                    <div class="mb-2">
                        <label class="form-label small fw-bold mb-1">Jumlah Diberikan</label>
                        <div class="input-group input-group-sm">
                            <input type="number" class="form-control text-center fw-bold" id="eksekusi_jml" value="1" min="0.1" step="any">
                            <span class="input-group-text" id="lblEksekusiSatuan">Sat</span>
                        </div>
                    </div>

                    <div class="mb-2">
                        <label class="form-label small fw-bold mb-1">Aturan Pakai</label>
                        <input type="text" class="form-control form-control-sm" id="eksekusi_aturan_pakai" placeholder="Aturan pakai...">
                    </div>
                </form>
            </div>
            <div class="modal-footer py-1.5 px-3 bg-light">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-success btn-sm px-3" id="btnSimpanEksekusiBeriObat">
                    <i class="bi bi-check-lg me-1"></i> Simpan Pemberian
                </button>
            </div>
        </div>
    </div>
</div>

@push('script')
<script>
    // Buka Modal E-MAR Pemberian Obat Ranap
    function modalPemberianObatRanap(noRawat) {
        if (!noRawat) {
            Swal.fire('Peringatan', 'No. Rawat tidak valid.', 'warning');
            return;
        }

        $('#emar_info_no_rawat').text(noRawat);
        $('#eksekusi_no_rawat').val(noRawat);
        $('#emar_filter_tanggal').val(moment().format('YYYY-MM-DD'));

        // Load data pasien & kamar
        getRegPeriksa(noRawat).done(function(res) {
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
        });

        $('#modalPemberianObatRanap').modal('show');
        loadEmarPasien();
    }

    // Load data E-MAR Pasien (Stok obat + matriks 24 jam)
    function loadEmarPasien() {
        const noRawat = $('#emar_info_no_rawat').text();
        const tanggal = $('#emar_filter_tanggal').val() || moment().format('YYYY-MM-DD');
        if (!noRawat || noRawat === '-') return;

        $('#badgeTanggalEmar').html(`<i class="bi bi-calendar3 me-1"></i> ${tanggal}`);

        const $container = $('#containerListEmarObat');
        $container.html('<div class="text-center text-muted py-4"><i class="bi bi-hourglass-split fs-3 d-block mb-1"></i> Memuat data E-MAR...</div>');

        $.get("{{ route('ranap.pemberian-obat.stok') }}", {
            no_rawat: noRawat,
            tanggal: tanggal
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
                        timelineBoxes += `
                            <div class="p-1 text-center" style="flex: 1 0 4%; min-width: 38px;">
                                <div class="bg-success text-white rounded p-1 shadow-sm" style="font-size: 9.5px; cursor: default;" title="Sudah diberikan: ${pemberianJam.jml} ${item.satuan} pada ${pemberianJam.jam}">
                                    <span class="d-block fw-bold">${pad}:00</span>
                                    <i class="bi bi-check-circle-fill"></i>
                                    <span class="d-block" style="font-size: 8.5px;">${pemberianJam.jml}</span>
                                </div>
                            </div>
                        `;
                    } else if (isDijadwalkan) {
                        if (item.sisa_stok <= 0) {
                            // Dijadwalkan tapi Stok Pasien Sudah Habis
                            timelineBoxes += `
                                <div class="p-1 text-center" style="flex: 1 0 4%; min-width: 38px;">
                                    <button type="button" class="btn btn-secondary btn-sm p-1 w-100 opacity-50 shadow-sm" style="font-size: 9.5px;" onclick="bukaDialogBeriObat('${item.kode_brng}', '${item.nama_brng.replace(/'/g, "\\'")}', '${item.satuan}', '${item.no_batch}', '${item.no_faktur}', '${item.kd_bangsal}', '${item.aturan_pakai.replace(/'/g, "\\'")}', ${item.sisa_stok}, '${pad}:00:00')" title="Stok pasien habis (0 ${item.satuan})">
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
                                    <button type="button" class="btn btn-warning btn-sm p-1 w-100 shadow-sm" style="font-size: 9.5px;" onclick="bukaDialogBeriObat('${item.kode_brng}', '${item.nama_brng.replace(/'/g, "\\'")}', '${item.satuan}', '${item.no_batch}', '${item.no_faktur}', '${item.kd_bangsal}', '${item.aturan_pakai.replace(/'/g, "\\'")}', ${item.sisa_stok}, '${pad}:00:00')" title="Klik untuk catat pemberian jam ${pad}:00">
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
                    ? `<button type="button" class="btn btn-outline-success btn-sm py-1 px-2.5 shadow-sm" style="font-size: 11px;" onclick="bukaDialogBeriObat('${item.kode_brng}', '${item.nama_brng.replace(/'/g, "\\'")}', '${item.satuan}', '${item.no_batch}', '${item.no_faktur}', '${item.kd_bangsal}', '${item.aturan_pakai.replace(/'/g, "\\'")}', ${item.sisa_stok}, '')">
                           <i class="bi bi-plus-lg me-1"></i> Catat Pemberian
                       </button>`
                    : `<button type="button" class="btn btn-secondary btn-sm py-1 px-2.5 opacity-75 shadow-sm" style="font-size: 11px;" onclick="bukaDialogBeriObat('${item.kode_brng}', '${item.nama_brng.replace(/'/g, "\\'")}', '${item.satuan}', '${item.no_batch}', '${item.no_faktur}', '${item.kd_bangsal}', '${item.aturan_pakai.replace(/'/g, "\\'")}', ${item.sisa_stok}, '')" title="Stok obat pasien habis">
                           <i class="bi bi-x-circle me-1"></i> Stok Habis
                       </button>`;

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
                                            <strong class="text-dark d-block" style="font-size: 12.5px;">${item.nama_brng}</strong>
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
        const $tbody = $('#tbodyLogPemberianEmar');
        $tbody.html('<tr><td colspan="9" class="text-center text-muted py-3">Memuat data log pemberian...</td></tr>');

        $.get("{{ route('ranap.pemberian-obat.riwayat') }}", {
            no_rawat: noRawat,
            tanggal: tanggal
        }).done(function(data) {
            $tbody.empty();
            if (!data || data.length === 0) {
                $tbody.html('<tr><td colspan="9" class="text-center text-muted py-3"><i>Belum ada pemberian obat yang dicatat pada tanggal ini.</i></td></tr>');
                $('#lblTotalBillingEmar').text('Total Pemberian: 0 item');
                return;
            }

            let totalRp = 0;
            data.forEach(function(row, idx) {
                totalRp += (parseFloat(row.total) || 0);
                const sat = row.data_barang?.kode_satuan?.satuan || row.data_barang?.kode_sat || '-';
                const aturan = row.aturan_pakai?.aturan || '-';

                const tr = `
                    <tr>
                        <td class="text-center">${idx + 1}</td>
                        <td class="text-center fw-bold text-primary font-monospace">${row.jam}</td>
                        <td><strong>${row.data_barang?.nama_brng || row.kode_brng}</strong></td>
                        <td class="text-center fw-bold">${row.jml}</td>
                        <td class="text-center">${sat}</td>
                        <td class="text-end">Rp ${formatRupiah(row.biaya_obat)}</td>
                        <td class="text-end fw-bold">Rp ${formatRupiah(row.total)}</td>
                        <td>${aturan}</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-outline-danger btn-sm p-1" onclick="hapusCatatanPemberian('${row.no_rawat}', '${row.kode_brng}', '${row.tgl_perawatan}', '${row.jam}', '${row.no_batch || ''}', '${row.no_faktur || ''}')" title="Hapus Catatan Pemberian">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                `;
                $tbody.append(tr);
            });

            $('#lblTotalBillingEmar').html(`Total: <b>${data.length} item</b> (Rp ${formatRupiah(totalRp)})`);
        });
    }

    // Buka Dialog Eksekusi Pemberian Obat
    function bukaDialogBeriObat(kode, nama, satuan, batch, faktur, bangsal, aturan, sisa, presetJam = '') {
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
        $('#lblEksekusiNamaObat').text(nama);
        $('#lblEksekusiSatuan').text(satuan);
        $('#lblEksekusiSisaStok').text(`Sisa Stok Pasien: ${sisa} ${satuan}`);
        $('#eksekusi_tanggal').val($('#emar_filter_tanggal').val() || moment().format('YYYY-MM-DD'));
        $('#eksekusi_jam').val(presetJam || moment().format('HH:mm:ss'));
        $('#eksekusi_jml').val('1').attr('max', sisa).data('max-sisa', sisa);
        $('#eksekusi_aturan_pakai').val(aturan || '');

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
                aturan_pakai: aturan
            },
            beforeSend: function() {
                Swal.fire({ title: 'Menyimpan...', allowOutsideClick: false, didOpen: () => { Swal.showLoading(); } });
            },
            success: function(resp) {
                Swal.fire('Berhasil!', resp.message || 'Pemberian obat berhasil dicatat.', 'success');
                $('#modalDialogEksekusiBeriObat').modal('hide');
                loadEmarPasien();
            },
            error: function(xhr) {
                const msg = xhr.responseJSON?.message || 'Gagal mencatat pemberian obat.';
                Swal.fire('Gagal!', msg, 'error');
            }
        });
    });

    // Hapus Catatan Pemberian Obat
    function hapusCatatanPemberian(noRawat, kode, tgl, jam, batch, faktur) {
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
                        no_rawat: noRawat,
                        kode_brng: kode,
                        tgl_perawatan: tgl,
                        jam: jam,
                        no_batch: batch,
                        no_faktur: faktur
                    },
                    success: function(resp) {
                        Swal.fire('Dihapus!', resp.message || 'Catatan pemberian obat telah dihapus.', 'success');
                        loadEmarPasien();
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
</script>
@endpush
