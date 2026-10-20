<!-- Modal Pengajuan Retur Obat Pasien Rawat Inap -->
<div class="modal fade" id="modalReturObatRanap" tabindex="-1" aria-labelledby="modalReturObatRanapLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content border-0 shadow">
            
            <!-- Modal Header -->
            <div class="modal-header text-white py-2 px-3 justify-content-between align-items-center" style="background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);">
                <div class="d-flex align-items-center gap-2">
                    <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                        <i class="bi bi-arrow-return-left fs-5 text-white"></i>
                    </div>
                    <div>
                        <h6 class="modal-title fw-bold mb-0 text-white" id="modalReturObatRanapLabel">
                            PENGAJUAN RETUR OBAT PASIEN RAWAT INAP
                        </h6>
                        <small class="text-white-50" style="font-size: 11px;">Pengembalian obat/alkes yang belum terpakai dari ruangan ke Depo Farmasi</small>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>

            <!-- Modal Body -->
            <div class="modal-body p-3 bg-light">
                
                <!-- BANNER INFO PASIEN -->
                <div class="card border-0 shadow-sm rounded-3 mb-3 bg-white">
                    <div class="card-body p-2.5">
                        <div class="row g-2 align-items-center" style="font-size: 11.5px;">
                            <div class="col-md-3 col-6">
                                <label class="text-muted small mb-0 d-block" style="font-size: 10px;">NO. RAWAT</label>
                                <strong class="text-primary font-monospace" id="retur_info_no_rawat">-</strong>
                                <input type="hidden" id="retur_input_no_rawat">
                                <input type="hidden" id="retur_input_kd_bangsal">
                            </div>
                            <div class="col-md-2 col-6">
                                <label class="text-muted small mb-0 d-block" style="font-size: 10px;">NO. REKAM MEDIS</label>
                                <strong class="text-dark font-monospace" id="retur_info_no_rkm_medis">-</strong>
                            </div>
                            <div class="col-md-4 col-12">
                                <label class="text-muted small mb-0 d-block" style="font-size: 10px;">NAMA PASIEN</label>
                                <strong class="text-dark" id="retur_info_nm_pasien">-</strong>
                            </div>
                            <div class="col-md-3 col-12">
                                <label class="text-muted small mb-0 d-block" style="font-size: 10px;">KAMAR / BANGSAL</label>
                                <strong class="text-dark" id="retur_info_kamar">-</strong>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- NAV TABS -->
                <ul class="nav nav-pills mb-3 bg-white p-1 rounded-3 shadow-sm border" id="pills-retur-tab" role="tablist">
                    <li class="nav-item flex-fill" role="presentation">
                        <button class="nav-link active py-2 fw-semibold w-100 text-center" id="tab-retur-form-link" data-bs-toggle="pill" data-bs-target="#tab-retur-form" type="button" role="tab" style="font-size: 12.5px;">
                            <i class="bi bi-pencil-square me-1 text-primary"></i> 1. Form Pengajuan Retur Baru
                        </button>
                    </li>
                    <li class="nav-item flex-fill" role="presentation">
                        <button class="nav-link py-2 fw-semibold w-100 text-center" id="tab-retur-riwayat-link" data-bs-toggle="pill" data-bs-target="#tab-retur-riwayat" type="button" role="tab" style="font-size: 12.5px;">
                            <i class="bi bi-clock-history me-1 text-secondary"></i> 2. Riwayat Pengajuan Pasien Ini
                            <span class="badge bg-primary rounded-pill ms-1" id="badgeJumlahRiwayatRetur">0</span>
                        </button>
                    </li>
                </ul>

                <div class="tab-content" id="pills-retur-tabContent">
                    
                    <!-- TAB 1: FORM PENGAJUAN BARU -->
                    <div class="tab-pane fade show active" id="tab-retur-form" role="tabpanel">
                        <div class="card border-0 shadow-sm rounded-3 bg-white mb-3">
                            <div class="card-header bg-white py-2 px-3 border-bottom d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="fw-bold mb-0 text-dark" style="font-size: 12.5px;">
                                        <i class="bi bi-list-check me-1 text-primary"></i> Pilih Obat yang Akan Diretur
                                    </h6>
                                    <small class="text-muted" style="font-size: 10.5px;">Daftar di bawah memuat obat yang pernah diberikan ke pasien di Ranap beserta sisa kuota yang dapat diretur.</small>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="input-group input-group-sm" style="width: 220px;">
                                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-search text-muted"></i></span>
                                        <input type="text" class="form-control form-control-sm border-start-0 ps-0" id="retur_filter_obat" placeholder="Filter nama obat..." onkeyup="filterTabelReturObat()">
                                    </div>
                                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="muatRiwayatPemberianObatRetur()" title="Segarkan Data Pemberian Obat">
                                        <i class="bi bi-arrow-clockwise"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="card-body p-0">
                                <div class="table-responsive" style="max-height: 380px;">
                                    <table class="table table-hover table-bordered table-sm mb-0 align-middle" id="tableReturObatPemberian" style="font-size: 11.5px;">
                                        <thead class="table-light sticky-top" style="z-index: 1;">
                                            <tr class="text-center align-middle">
                                                <th style="width: 40px;">
                                                    <input type="checkbox" class="form-check-input" id="checkAllRetur" onchange="toggleCheckAllRetur(this)">
                                                </th>
                                                <th style="width: 90px;">Kode</th>
                                                <th>Nama Obat / Alkes</th>
                                                <th style="width: 65px;">Satuan</th>
                                                <th style="width: 75px;">Diberikan</th>
                                                <th style="width: 75px;">Sdh Retur</th>
                                                <th style="width: 80px;">Sedang Ajukan</th>
                                                <th style="width: 95px;" class="table-success text-success" title="Klik angka pada baris ini untuk langsung retur seluruh sisa">Sisa Retur</th>
                                                <th style="width: 140px;">Jml Retur</th>
                                                <th style="width: 95px;">Biaya (Rp)</th>
                                                <th style="width: 105px;">Subtotal (Rp)</th>
                                                <th style="width: 160px;">Alasan / Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbodyReturObatPemberian">
                                            <tr>
                                                <td colspan="12" class="text-center py-4 text-muted">
                                                    <div class="spinner-border spinner-border-sm text-primary me-1" role="status"></div>
                                                    Memuat data pemberian obat pasien...
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="card-footer bg-light p-2.5 border-top">
                                <div class="row align-items-center g-2">
                                    <div class="col-md-7 col-12">
                                        <div class="d-flex align-items-center gap-2 flex-wrap">
                                            <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2.5 py-1.5" id="lblReturTotalItem">
                                                0 item dipilih
                                            </span>
                                            <span class="text-muted" style="font-size: 11px;">Total Estimasi Retur:</span>
                                            <strong class="text-primary fs-6" id="lblReturTotalNominal">Rp 0</strong>
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-12 text-md-end">
                                        <button type="button" class="btn btn-outline-secondary btn-sm me-1" onclick="resetFormPilihanRetur()">
                                            <i class="bi bi-x-circle me-1"></i> Reset Pilihan
                                        </button>
                                        <button type="button" class="btn btn-primary btn-sm shadow-sm px-3" id="btnSubmitPengajuanRetur" onclick="submitPengajuanReturRanap()">
                                            <i class="bi bi-send-fill me-1"></i> Kirim Pengajuan Retur
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Catatan Pengajuan -->
                        <div class="card border-0 shadow-sm rounded-3 bg-white p-3">
                            <label for="retur_catatan_ruangan" class="form-label fw-bold mb-1" style="font-size: 11.5px;">
                                <i class="bi bi-chat-left-text text-secondary me-1"></i> Catatan Pengajuan Ruangan (Opsional):
                            </label>
                            <textarea class="form-control form-control-sm" id="retur_catatan_ruangan" rows="2" placeholder="Contoh: Pasien acc pulang oleh dr. Sp.A, obat oral dan sisa injeksi dikembalikan ke Depo Farmasi..."></textarea>
                        </div>
                    </div>

                    <!-- TAB 2: RIWAYAT PENGAJUAN PASIEN -->
                    <div class="tab-pane fade" id="tab-retur-riwayat" role="tabpanel">
                        <div class="card border-0 shadow-sm rounded-3 bg-white">
                            <div class="card-header bg-white py-2 px-3 border-bottom d-flex justify-content-between align-items-center">
                                <h6 class="fw-bold mb-0 text-dark" style="font-size: 12.5px;">
                                    <i class="bi bi-clock-history me-1 text-primary"></i> Daftar Pengajuan Retur Pasien Ini
                                </h6>
                                <button type="button" class="btn btn-outline-secondary btn-sm" onclick="muatRiwayatDaftarReturPasien()" title="Segarkan Riwayat">
                                    <i class="bi bi-arrow-clockwise"></i> Refresh
                                </button>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered table-sm mb-0 align-middle" style="font-size: 11.5px;">
                                        <thead class="table-light">
                                            <tr class="text-center align-middle">
                                                <th style="width: 50px;">No</th>
                                                <th style="width: 150px;">No. Pengajuan</th>
                                                <th style="width: 120px;">Waktu</th>
                                                <th style="width: 140px;">Pengaju</th>
                                                <th>Ringkasan Item Obat</th>
                                                <th style="width: 120px;">Status</th>
                                                <th style="width: 130px;">No. Retur Khanza</th>
                                                <th style="width: 130px;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbodyRiwayatReturPasien">
                                            <tr>
                                                <td colspan="8" class="text-center py-4 text-muted">
                                                    Belum ada riwayat pengajuan retur untuk pasien ini.
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <!-- Modal Footer -->
            <div class="modal-footer py-2 px-3 bg-white border-top justify-content-between">
                <small class="text-muted" style="font-size: 11px;">
                    <i class="bi bi-info-circle me-1"></i> Setelah diajukan, status akan "Menunggu Validasi" dari petugas Farmasi.
                </small>
                <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">Tutup</button>
            </div>

        </div>
    </div>
</div>

<!-- Modal Detail Item Pengajuan Retur (Sub-modal) -->
<div class="modal fade" id="modalDetailReturItem" tabindex="-1" aria-labelledby="modalDetailReturItemLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow">
            <div class="modal-header py-2 px-3 bg-light border-bottom">
                <h6 class="modal-title fw-bold" id="modalDetailReturItemLabel" style="font-size: 12.5px;">
                    <i class="bi bi-box-seam text-primary me-1"></i> Detail Item Pengajuan: <span id="lblDetailNoPengajuan" class="text-primary font-monospace">-</span>
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">
                <div class="mb-2 p-2 bg-light rounded border" style="font-size: 11.5px;">
                    <div class="row g-2">
                        <div class="col-6">
                            <span class="text-muted">Status:</span> <strong id="lblDetailStatus">-</strong>
                        </div>
                        <div class="col-6 text-end">
                            <span class="text-muted">Petugas Pengaju:</span> <strong id="lblDetailPengaju">-</strong>
                        </div>
                        <div class="col-12" id="boxDetailCatatanFarmasi" style="display: none;">
                            <span class="text-muted">Catatan Farmasi:</span> <strong class="text-primary" id="lblDetailCatatanFarmasi">-</strong>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-sm table-bordered table-hover mb-0" style="font-size: 11.5px;">
                        <thead class="table-light text-center">
                            <tr>
                                <th>No</th>
                                <th>Nama Obat</th>
                                <th>Satuan</th>
                                <th>Jml Diajukan</th>
                                <th>Jml Disetujui</th>
                                <th>Harga Retur</th>
                                <th>Subtotal</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody id="tbodyDetailItemsPengajuan"></tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer py-1.5 px-3 bg-light">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

@push('script')
<script>
    let listObatPemberianRetur = [];

    // Buka Modal Retur Obat Ranap
    function bukaModalReturObatRanap(noRawat) {
        if (!noRawat) {
            Swal.fire('Peringatan', 'No. Rawat tidak valid.', 'warning');
            return;
        }

        $('#retur_input_no_rawat').val(noRawat);
        $('#retur_info_no_rawat').text(noRawat);
        $('#retur_catatan_ruangan').val('');
        $('#checkAllRetur').prop('checked', false);
        $('#retur_filter_obat').val('');

        // Ambil data pasien & kamar
        getRegPeriksa(noRawat).done(function(res) {
            const pasien = res?.pasien || {};
            const kamarList = res?.kamar_inap || [];

            let kamarNama = '-';
            let kdBangsal = 'RM';
            if (kamarList.length > 0) {
                const activeKamar = kamarList.find(k => k.stts_pulang === '-') || kamarList[0];
                kamarNama = activeKamar?.kamar?.bangsal?.nm_bangsal || activeKamar?.kd_kamar || '-';
                kdBangsal = activeKamar?.kd_bangsal || activeKamar?.kamar?.bangsal?.kd_bangsal || 'RM';
            }

            $('#retur_info_no_rkm_medis').text(pasien?.no_rkm_medis || '-');
            $('#retur_info_nm_pasien').text(pasien?.nm_pasien || '-');
            $('#retur_info_kamar').text(kamarNama);
            $('#retur_input_kd_bangsal').val(kdBangsal);
        });

        // Muat riwayat obat & riwayat pengajuan
        muatRiwayatPemberianObatRetur();
        muatRiwayatDaftarReturPasien();

        // Buka Tab 1
        $('#tab-retur-form-link').tab('show');

        // Tampilkan modal
        $('#modalReturObatRanap').modal('show');
    }

    // Muat Riwayat Obat Pasien Ranap
    function muatRiwayatPemberianObatRetur() {
        const noRawat = $('#retur_input_no_rawat').val();
        if (!noRawat) return;

        const $tbody = $('#tbodyReturObatPemberian');
        $tbody.html(`
            <tr>
                <td colspan="12" class="text-center py-4 text-muted">
                    <div class="spinner-border spinner-border-sm text-danger me-1" role="status"></div>
                    Memuat data pemberian obat pasien...
                </td>
            </tr>
        `);

        $.ajax({
            url: "{{ route('retur-obat.riwayat-pemberian') }}",
            type: "GET",
            data: { no_rawat: noRawat },
            success: function(data) {
                listObatPemberianRetur = Array.isArray(data) ? data : [];
                renderTablePemberianObatRetur(listObatPemberianRetur);
            },
            error: function(err) {
                $tbody.html(`
                    <tr>
                        <td colspan="12" class="text-center py-3 text-danger">
                            <i class="bi bi-exclamation-triangle me-1"></i> Gagal memuat data riwayat obat: ${err.responseJSON?.message || 'Terjadi kesalahan sistem'}
                        </td>
                    </tr>
                `);
            }
        });
    }

    // Render Tabel Obat Pemberian
    function renderTablePemberianObatRetur(items) {
        const $tbody = $('#tbodyReturObatPemberian');
        $tbody.empty();

        if (items.length === 0) {
            $tbody.html(`
                <tr>
                    <td colspan="12" class="text-center py-4 text-muted">
                        <i class="bi bi-inbox fs-4 d-block mb-1 text-secondary"></i>
                        Tidak ada riwayat pemberian obat pasien ranap yang dapat diretur.
                    </td>
                </tr>
            `);
            hitungTotalReturTerpilih();
            return;
        }

        items.forEach(function(item, idx) {
            const sisa = parseFloat(item.sisa_dapat_diretur) || 0;
            const isHabis = sisa <= 0;
            const keyBatch = (item.no_batch ? ` <span class="badge bg-light text-secondary border" style="font-size:9px;">B: ${item.no_batch}</span>` : '');

            const tr = `
                <tr class="row-retur-item ${isHabis ? 'table-light text-muted' : ''}" data-idx="${idx}" data-nama="${item.nama_brng.toLowerCase()}">
                    <td class="text-center">
                        <input type="checkbox" class="form-check-input chk-pilih-retur" data-idx="${idx}" ${isHabis ? 'disabled' : ''} onchange="onToggleItemRetur(${idx}, this.checked)">
                    </td>
                    <td class="font-monospace text-center">${item.kode_brng}</td>
                    <td>
                        <strong>${item.nama_brng}</strong>${keyBatch}
                    </td>
                    <td class="text-center">${item.satuan}</td>
                    <td class="text-center">${parseFloat(item.total_diberikan)}</td>
                    <td class="text-center text-secondary">${parseFloat(item.sudah_retur)}</td>
                    <td class="text-center text-warning-emphasis">${parseFloat(item.sedang_diajukan)}</td>
                    <td class="text-center table-success" style="${!isHabis ? 'cursor: pointer;' : ''}" onclick="${!isHabis ? `setReturMax(${idx})` : ''}" title="${!isHabis ? `Klik untuk langsung retur seluruh sisa (${sisa})` : ''}">
                        <strong class="${isHabis ? 'text-muted' : 'text-success'}">${sisa}</strong>
                        ${!isHabis ? `<i class="bi bi-arrow-right-short text-success opacity-75 ms-0.5"></i>` : ''}
                    </td>
                    <td class="text-center" style="min-width: 130px;">
                        <div class="input-group input-group-sm">
                            <input type="number" class="form-control form-control-sm text-center input-jml-retur fw-bold py-0.5 px-1 shadow-xs" 
                                id="retur_jml_${idx}" 
                                value="" 
                                placeholder="0" 
                                min="0.01" 
                                max="${sisa}" 
                                step="any" 
                                ${isHabis ? 'disabled' : ''} 
                                oninput="onChangeJmlRetur(${idx}, this.value)" 
                                onchange="onChangeJmlRetur(${idx}, this.value)" 
                                style="font-size: 11px;">
                            <button type="button" class="btn btn-outline-primary btn-sm px-2 py-0.5" 
                                ${isHabis ? 'disabled' : ''} 
                                onclick="setReturMax(${idx})" 
                                title="Isi langsung seluruh sisa (${sisa})" 
                                style="font-size: 10.5px; font-weight: 600;">
                                Max
                            </button>
                        </div>
                    </td>
                    <td class="text-end">
                        ${formatRupiah(item.h_retur)}
                    </td>
                    <td class="text-end fw-bold text-dark" id="retur_subtotal_${idx}">
                        ${formatRupiah(0)}
                    </td>
                    <td>
                        <input type="text" class="form-control form-control-sm py-0.5 px-1.5" 
                            id="retur_ket_${idx}" 
                            placeholder="Alasan retur..." 
                            ${isHabis ? 'disabled' : ''} 
                            style="font-size: 11px;">
                    </td>
                </tr>
            `;
            $tbody.append(tr);
        });

        hitungTotalReturTerpilih();
    }

    // Shortcut: Retur Seluruh Jumlah Sisa untuk 1 Item
    function setReturMax(idx) {
        const item = listObatPemberianRetur[idx];
        if (!item) return;

        const sisa = parseFloat(item.sisa_dapat_diretur) || 0;
        if (sisa <= 0) return;

        $(`#retur_jml_${idx}`).val(sisa);
        $(`.chk-pilih-retur[data-idx="${idx}"]`).prop('checked', true);

        const subtotal = sisa * parseFloat(item.h_retur);
        $(`#retur_subtotal_${idx}`).text(formatRupiah(subtotal));

        hitungTotalReturTerpilih();
    }

    // Toggle Check All
    function toggleCheckAllRetur(master) {
        const isChecked = $(master).is(':checked');
        $('.chk-pilih-retur:not(:disabled)').prop('checked', isChecked);
        if (!isChecked) {
            listObatPemberianRetur.forEach(function(item, idx) {
                $(`#retur_jml_${idx}`).val('');
                $(`#retur_subtotal_${idx}`).text(formatRupiah(0));
            });
        }
        hitungTotalReturTerpilih();
    }

    // Toggle Single Item
    function onToggleItemRetur(idx, isChecked) {
        const item = listObatPemberianRetur[idx];
        if (!item) return;

        const $input = $(`#retur_jml_${idx}`);
        const currentVal = parseFloat($input.val()) || 0;

        if (isChecked) {
            if (currentVal <= 0) {
                $input.focus();
            }
        } else {
            $input.val('');
            $(`#retur_subtotal_${idx}`).text(formatRupiah(0));
        }

        hitungTotalReturTerpilih();
    }

    // Ubah Jumlah Retur
    function onChangeJmlRetur(idx, val) {
        const item = listObatPemberianRetur[idx];
        if (!item) return;

        const max = parseFloat(item.sisa_dapat_diretur) || 0;
        let num = parseFloat(val);

        if (val === '' || isNaN(num) || num <= 0) {
            num = 0;
            $(`#retur_subtotal_${idx}`).text(formatRupiah(0));
            hitungTotalReturTerpilih();
            return;
        }

        if (num > max) {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'warning',
                title: `Maksimal retur untuk ${item.nama_brng} adalah ${max}`,
                showConfirmButton: false,
                timer: 2000
            });
            num = max;
            $(`#retur_jml_${idx}`).val(num);
        }

        const subtotal = num * parseFloat(item.h_retur);
        $(`#retur_subtotal_${idx}`).text(formatRupiah(subtotal));

        // Jika user mengetik angka > 0 tapi belum dicentang, otomatis centang
        if (num > 0) {
            $(`.chk-pilih-retur[data-idx="${idx}"]`).prop('checked', true);
        }

        hitungTotalReturTerpilih();
    }

    // Hitung Total Item & Nominal Terpilih
    function hitungTotalReturTerpilih() {
        let totalItem = 0;
        let totalNominal = 0;

        $('.chk-pilih-retur:checked').each(function() {
            const idx = $(this).data('idx');
            const item = listObatPemberianRetur[idx];
            if (item) {
                const jml = parseFloat($(`#retur_jml_${idx}`).val()) || 0;
                if (jml > 0) {
                    totalItem++;
                    totalNominal += (jml * parseFloat(item.h_retur));
                }
            }
        });

        $('#lblReturTotalItem').text(`${totalItem} item dipilih`);
        $('#lblReturTotalNominal').text(formatRupiah(totalNominal));

        if (totalItem === 0) {
            $('#btnSubmitPengajuanRetur').prop('disabled', true);
        } else {
            $('#btnSubmitPengajuanRetur').prop('disabled', false);
        }
    }

    // Reset Pilihan
    function resetFormPilihanRetur() {
        $('.chk-pilih-retur').prop('checked', false);
        $('#checkAllRetur').prop('checked', false);
        listObatPemberianRetur.forEach(function(item, idx) {
            $(`#retur_jml_${idx}`).val('');
            $(`#retur_subtotal_${idx}`).text(formatRupiah(0));
        });
        hitungTotalReturTerpilih();
    }

    // Filter Pencarian Nama Obat
    function filterTabelReturObat() {
        const q = $('#retur_filter_obat').val().toLowerCase().trim();
        $('.row-retur-item').each(function() {
            const nama = $(this).data('nama');
            if (!q || nama.includes(q)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }

    // Kirim Pengajuan Retur Ranap
    function submitPengajuanReturRanap() {
        const noRawat = $('#retur_input_no_rawat').val();
        const kdBangsal = $('#retur_input_kd_bangsal').val() || 'RM';
        const catatan = $('#retur_catatan_ruangan').val();

        const items = [];
        let hasEmptyJml = false;
        let emptyItemName = '';

        $('.chk-pilih-retur:checked').each(function() {
            const idx = $(this).data('idx');
            const item = listObatPemberianRetur[idx];
            if (item) {
                const valRaw = $(`#retur_jml_${idx}`).val();
                const jml = parseFloat(valRaw) || 0;
                const ket = $(`#retur_ket_${idx}`).val() || '';

                if (jml <= 0) {
                    hasEmptyJml = true;
                    emptyItemName = item.nama_brng;
                    $(`#retur_jml_${idx}`).focus();
                    return false; // hentikan loop each
                }

                items.push({
                    kode_brng: item.kode_brng,
                    kode_sat: item.kode_sat,
                    jml_diajukan: jml,
                    h_retur: item.h_retur,
                    no_batch: item.no_batch || '',
                    no_faktur: item.no_faktur || '',
                    keterangan: ket
                });
            }
        });

        if (hasEmptyJml) {
            Swal.fire({
                icon: 'warning',
                title: 'Jumlah Retur Belum Diisi',
                html: `Obat <strong>"${emptyItemName}"</strong> sudah dicentang tetapi jumlah retur masih kosong atau 0.<br><small class="text-muted">Silakan ketik jumlah yang ingin diretur atau klik tombol <b>Max</b> untuk meretur seluruh sisa.</small>`,
                confirmButtonColor: '#0d6efd'
            });
            return;
        }

        if (items.length === 0) {
            Swal.fire('Peringatan', 'Pilih minimal satu item obat yang akan diretur dan tentukan jumlahnya.', 'warning');
            return;
        }

        Swal.fire({
            title: 'Kirim Pengajuan Retur?',
            text: `Yakin ingin mengajukan retur untuk ${items.length} item obat ke Farmasi?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#0d6efd',
            confirmButtonText: 'Ya, Kirim Pengajuan',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('retur-obat.ajukan') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        no_rawat: noRawat,
                        kd_bangsal: kdBangsal,
                        catatan: catatan,
                        items: items
                    },
                    beforeSend: function() {
                        Swal.fire({
                            title: 'Menyimpan...',
                            text: 'Mohon tunggu pengajuan sedang diproses.',
                            allowOutsideClick: false,
                            didOpen: () => Swal.showLoading()
                        });
                    },
                    success: function(resp) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil Diajukan!',
                            text: resp.message || 'Pengajuan retur berhasil disimpan.',
                            timer: 2000,
                            showConfirmButton: true
                        }).then(() => {
                            // Refresh pemberian & riwayat
                            muatRiwayatPemberianObatRetur();
                            muatRiwayatDaftarReturPasien();
                            $('#retur_catatan_ruangan').val('');
                            $('#tab-retur-riwayat-link').tab('show');
                        });
                    },
                    error: function(err) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal Menyimpan',
                            text: err.responseJSON?.message || 'Terjadi kesalahan pada sistem saat menyimpan retur.'
                        });
                    }
                });
            }
        });
    }

    // Muat Riwayat Daftar Retur Pasien Ini
    function muatRiwayatDaftarReturPasien() {
        const noRawat = $('#retur_input_no_rawat').val();
        if (!noRawat) return;

        const $tbody = $('#tbodyRiwayatReturPasien');
        $tbody.html(`
            <tr>
                <td colspan="8" class="text-center py-3 text-muted">
                    <div class="spinner-border spinner-border-sm text-danger me-1"></div> Memuat riwayat pengajuan...
                </td>
            </tr>
        `);

        $.ajax({
            url: "{{ route('retur-obat.daftar') }}",
            type: "GET",
            data: { no_rawat: noRawat },
            success: function(data) {
                const list = Array.isArray(data) ? data : [];
                $('#badgeJumlahRiwayatRetur').text(list.length);
                $tbody.empty();

                if (list.length === 0) {
                    $tbody.html(`
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">
                                Belum ada riwayat pengajuan retur untuk pasien ini.
                            </td>
                        </tr>
                    `);
                    return;
                }

                list.forEach(function(item, idx) {
                    let badgeClass = 'bg-warning text-dark';
                    if (item.status === 'Disetujui') badgeClass = 'bg-success text-white';
                    else if (item.status === 'Ditolak') badgeClass = 'bg-danger text-white';
                    else if (item.status === 'Batal') badgeClass = 'bg-secondary text-white';

                    const details = item.details || [];
                    const detailSummary = details.map(d => `• ${d.barang?.nama_brng || d.kode_brng} (${d.jml_diajukan} ${d.kode_sat})`).slice(0, 3).join('<br>') + (details.length > 3 ? `<br><small class="text-muted">+${details.length - 3} item lainnya</small>` : '');

                    const btnBatal = item.status === 'Menunggu Validasi' 
                        ? `<button type="button" class="btn btn-outline-danger btn-sm py-0.5 px-1.5" onclick="batalkanPengajuanReturRanap('${item.no_pengajuan}')" title="Batalkan Pengajuan"><i class="bi bi-x-circle"></i> Batal</button>`
                        : '';

                    const btnCetak = `<button type="button" class="btn btn-outline-primary btn-sm py-0.5 px-1.5" onclick="cetakSlipRetur('${item.no_pengajuan}')" title="Cetak Bukti Retur"><i class="bi bi-printer"></i></button>`;
                    const btnDetail = `<button type="button" class="btn btn-outline-secondary btn-sm py-0.5 px-1.5" onclick="lihatDetailPengajuanRetur('${item.no_pengajuan}')" title="Lihat Detail Item"><i class="bi bi-eye"></i></button>`;

                    const tr = `
                        <tr>
                            <td class="text-center">${idx + 1}</td>
                            <td class="font-monospace fw-bold text-primary">${item.no_pengajuan}</td>
                            <td class="text-center">${splitTanggal(item.tgl_pengajuan)}<br><small class="text-muted">${item.jam_pengajuan}</small></td>
                            <td>${item.pegawai_pengaju?.nama || item.petugas_pengaju}</td>
                            <td>${detailSummary}</td>
                            <td class="text-center">
                                <span class="badge ${badgeClass} px-2 py-1">${item.status}</span>
                            </td>
                            <td class="font-monospace text-center text-primary fw-bold">
                                ${item.no_retur_jual || '-'}
                            </td>
                            <td class="text-center">
                                <div class="d-inline-flex gap-1">
                                    ${btnDetail}
                                    ${btnCetak}
                                    ${btnBatal}
                                </div>
                            </td>
                        </tr>
                    `;
                    $tbody.append(tr);
                });
            },
            error: function() {
                $tbody.html(`
                    <tr>
                        <td colspan="8" class="text-center py-3 text-danger">Gagal memuat riwayat pengajuan retur.</td>
                    </tr>
                `);
            }
        });
    }

    // Batalkan Pengajuan Retur Ranap
    function batalkanPengajuanReturRanap(noPengajuan) {
        Swal.fire({
            title: 'Batalkan Pengajuan?',
            text: `Pengajuan ${noPengajuan} akan dibatalkan. Berikan alasan pembatalan:`,
            input: 'text',
            inputPlaceholder: 'Alasan pembatalan...',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            confirmButtonText: 'Ya, Batalkan',
            cancelButtonText: 'Kembali',
            preConfirm: (alasan) => {
                if (!alasan) {
                    Swal.showValidationMessage('Alasan pembatalan wajib diisi');
                }
                return alasan;
            }
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ url('/retur-obat/batal') }}/" + noPengajuan,
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        alasan: result.value
                    },
                    success: function(resp) {
                        Swal.fire('Dibatalkan!', resp.message || 'Pengajuan retur berhasil dibatalkan.', 'success');
                        muatRiwayatDaftarReturPasien();
                        muatRiwayatPemberianObatRetur();
                    },
                    error: function(err) {
                        Swal.fire('Gagal', err.responseJSON?.message || 'Gagal membatalkan pengajuan.', 'error');
                    }
                });
            }
        });
    }

    // Lihat Detail Item Pengajuan Retur
    function lihatDetailPengajuanRetur(noPengajuan) {
        $.ajax({
            url: "{{ url('/retur-obat/detail') }}/" + noPengajuan,
            type: "GET",
            success: function(data) {
                $('#lblDetailNoPengajuan').text(data.no_pengajuan);
                $('#lblDetailStatus').text(data.status);
                $('#lblDetailPengaju').text(data.pegawai_pengaju?.nama || data.petugas_pengaju);

                if (data.catatan_farmasi) {
                    $('#boxDetailCatatanFarmasi').show();
                    $('#lblDetailCatatanFarmasi').text(data.catatan_farmasi);
                } else {
                    $('#boxDetailCatatanFarmasi').hide();
                }

                const $tbody = $('#tbodyDetailItemsPengajuan');
                $tbody.empty();

                (data.details || []).forEach(function(d, i) {
                    const tr = `
                        <tr>
                            <td class="text-center">${i + 1}</td>
                            <td><strong>${d.barang?.nama_brng || d.kode_brng}</strong></td>
                            <td class="text-center">${d.kode_sat || '-'}</td>
                            <td class="text-center fw-bold">${parseFloat(d.jml_diajukan)}</td>
                            <td class="text-center fw-bold text-success">${data.status === 'Disetujui' ? parseFloat(d.jml_disetujui) : '-'}</td>
                            <td class="text-end">${formatRupiah(d.h_retur)}</td>
                            <td class="text-end fw-bold text-dark">${formatRupiah(d.subtotal || (d.jml_diajukan * d.h_retur))}</td>
                            <td>${d.keterangan || '-'}</td>
                        </tr>
                    `;
                    $tbody.append(tr);
                });

                $('#modalDetailReturItem').modal('show');
            }
        });
    }

    // Cetak Slip Bukti Retur
    function cetakSlipRetur(noPengajuan) {
        window.open("{{ url('/retur-obat/cetak') }}/" + noPengajuan, '_blank');
    }

    // Helper Format Rupiah
    function formatRupiah(angka) {
        const num = parseFloat(angka) || 0;
        return 'Rp ' + num.toLocaleString('id-ID');
    }
</script>
@endpush
