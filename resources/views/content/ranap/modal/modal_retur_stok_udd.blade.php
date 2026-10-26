<!-- Modal Retur Sisa Stok Obat UDD (Ruangan Ranap ke Depo Farmasi) -->
<div class="modal fade" id="modalReturStokUdd" tabindex="-1" aria-labelledby="modalReturStokUddLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content border-0 shadow">
            
            <!-- Modal Header -->
            <div class="modal-header text-white py-2 px-3 justify-content-between align-items-center" style="background: linear-gradient(135deg, #fd7e14 0%, #d65b00 100%);">
                <div class="d-flex align-items-center gap-2">
                    <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                        <i class="bi bi-arrow-return-left fs-5 text-white"></i>
                    </div>
                    <div>
                        <h6 class="modal-title fw-bold mb-0 text-white" id="modalReturStokUddLabel">
                            PENGEMBALIAN SISA OBAT UDD KE DEPO FARMASI
                        </h6>
                        <small class="text-white-50" style="font-size: 11px;">Mutasi Fisik Obat dari Loker Pasien ke Depo Farmasi (Pasien Pulang / Stop Terapi)</small>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-light text-dark px-2 py-1 shadow-sm font-monospace" id="badgeNoReturUddPreview" style="font-size: 11px;">
                        RUDD-BARU
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
                                <strong class="text-primary font-monospace" id="retur_udd_no_rawat">-</strong>
                            </div>
                            <div class="col-md-2 col-6">
                                <label class="text-muted small mb-0 d-block" style="font-size: 10px;">NO. REKAM MEDIS</label>
                                <strong class="text-dark font-monospace" id="retur_udd_no_rkm_medis">-</strong>
                            </div>
                            <div class="col-md-4 col-12">
                                <label class="text-muted small mb-0 d-block" style="font-size: 10px;">NAMA PASIEN</label>
                                <strong class="text-dark" id="retur_udd_nm_pasien">-</strong>
                            </div>
                            <div class="col-md-3 col-12">
                                <label class="text-muted small mb-0 d-block" style="font-size: 10px;">KAMAR / BANGSAL</label>
                                <strong class="text-dark" id="retur_udd_kamar">-</strong>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- NAVIGATION TABS -->
                <ul class="nav nav-pills nav-fill mb-3 bg-white p-1 rounded-3 shadow-sm border" id="pills-retur-udd-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active py-2 fw-semibold" id="tab-form-retur-udd-link" data-bs-toggle="pill" data-bs-target="#tab-form-retur-udd" type="button" role="tab" style="font-size: 12.5px;">
                            <i class="bi bi-box-arrow-left me-1"></i> 1. Form Pengembalian Sisa Obat
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link py-2 fw-semibold" id="tab-riwayat-retur-udd-link" data-bs-toggle="pill" data-bs-target="#tab-riwayat-retur-udd" type="button" role="tab" style="font-size: 12.5px;">
                            <i class="bi bi-clock-history me-1"></i> 2. Riwayat Pengembalian Pasien Ini
                        </button>
                    </li>
                </ul>

                <!-- TAB CONTENT -->
                <div class="tab-content" id="pills-retur-udd-tabContent">
                    
                    <!-- TAB 1: FORM PENGEMBALIAN SISA OBAT -->
                    <div class="tab-pane fade show active" id="tab-form-retur-udd" role="tabpanel">
                        
                        <!-- Form Header: Alasan & Catatan -->
                        <div class="card border-0 shadow-sm rounded-3 mb-3 bg-white">
                            <div class="card-body p-3">
                                <div class="row g-2">
                                    <div class="col-md-5 col-12">
                                        <label class="form-label small fw-bold mb-1" style="font-size: 11px;">Alasan Pengembalian <span class="text-danger">*</span></label>
                                        <select class="form-select form-select-sm" id="retur_udd_alasan">
                                            <option value="Pasien Boleh Pulang (KRS)">Pasien Boleh Pulang (KRS)</option>
                                            <option value="Obat Distop / Diganti Dokter (DPJP)">Obat Distop / Diganti Dokter (DPJP)</option>
                                            <option value="Pasien Alergi / Menolak Minum">Pasien Alergi / Menolak Minum</option>
                                            <option value="Pasien Rujuk / Meninggal Dunia">Pasien Rujuk / Meninggal Dunia</option>
                                            <option value="Lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                    <div class="col-md-7 col-12">
                                        <label class="form-label small fw-bold mb-1" style="font-size: 11px;">Catatan Ruangan (Opsional)</label>
                                        <input type="text" class="form-control form-control-sm" id="retur_udd_catatan" placeholder="Contoh: Kondisi kemasan utuh, dibawa perawat jaga sore...">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Table Daftar Sisa Obat UDD Pasien -->
                        <div class="card border-0 shadow-sm rounded-3 bg-white">
                            <div class="card-header bg-white py-2 px-3 d-flex justify-content-between align-items-center">
                                <span class="fw-bold text-dark" style="font-size: 12px;">
                                    <i class="bi bi-list-check me-1 text-primary"></i> Daftar Obat UDD yang Memiliki Sisa Stok
                                </span>
                                <button type="button" class="btn btn-outline-secondary btn-sm py-0.5 px-2" onclick="loadSisaStokUddPasien()" title="Muat Ulang Data">
                                    <i class="bi bi-arrow-clockwise"></i> Refresh
                                </button>
                            </div>
                            <div class="table-responsive p-0">
                                <table class="table table-sm table-bordered table-hover align-middle mb-0" style="font-size: 11px;">
                                    <thead class="table-light">
                                        <tr class="text-center align-middle">
                                            <th style="width: 40px;">
                                                <input class="form-check-input" type="checkbox" id="checkAllReturUdd" onchange="toggleSelectAllReturUdd(this)">
                                            </th>
                                            <th style="width: 35px;">No</th>
                                            <th style="width: 100px;">Kode Obat</th>
                                            <th class="text-start">Nama Obat</th>
                                            <th style="width: 70px;">Satuan</th>
                                            <th style="width: 90px;">Sisa di Loker</th>
                                            <th style="width: 120px;">Jml Dikembalikan</th>
                                            <th class="text-start" style="width: 200px;">Keterangan / Kondisi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbodySisaObatReturUdd">
                                        <tr>
                                            <td colspan="8" class="text-center py-4 text-muted">
                                                <i class="bi bi-hourglass-split me-1"></i> Memuat data sisa obat pasien...
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer bg-white p-2.5 d-flex justify-content-between align-items-center">
                                <small class="text-muted" style="font-size: 11px;">
                                    <i class="bi bi-info-circle me-1"></i> Centang obat yang akan dikembalikan fisik nya ke Depo Farmasi.
                                </small>
                                <button type="button" class="btn btn-primary btn-sm px-3 shadow-sm fw-semibold" id="btnKirimReturUdd" onclick="kirimPengajuanReturUdd()">
                                    <i class="bi bi-send me-1"></i> Kirim Pengembalian ke Farmasi
                                </button>
                            </div>
                        </div>

                    </div>

                    <!-- TAB 2: RIWAYAT PENGEMBALIAN PASIEN INI -->
                    <div class="tab-pane fade" id="tab-riwayat-retur-udd" role="tabpanel">
                        <div class="card border-0 shadow-sm rounded-3 bg-white">
                            <div class="card-header bg-white py-2 px-3 d-flex justify-content-between align-items-center">
                                <span class="fw-bold text-dark" style="font-size: 12px;">
                                    <i class="bi bi-clock-history me-1 text-primary"></i> Riwayat Tiket Pengembalian Sisa UDD
                                </span>
                                <button type="button" class="btn btn-outline-secondary btn-sm py-0.5 px-2" onclick="loadRiwayatReturUddPasien()" title="Muat Ulang Data">
                                    <i class="bi bi-arrow-clockwise"></i> Refresh
                                </button>
                            </div>
                            <div class="table-responsive p-0">
                                <table class="table table-sm table-bordered table-hover align-middle mb-0" style="font-size: 11px;">
                                    <thead class="table-light">
                                        <tr class="text-center align-middle">
                                            <th style="width: 35px;">No</th>
                                            <th style="width: 140px;">No. Retur UDD</th>
                                            <th style="width: 120px;">Tgl &amp; Jam</th>
                                            <th class="text-start">Alasan</th>
                                            <th style="width: 130px;">Petugas Ruangan</th>
                                            <th style="width: 110px;">Status</th>
                                            <th style="width: 130px;">Petugas Farmasi</th>
                                            <th style="width: 100px;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbodyRiwayatReturUdd">
                                        <tr>
                                            <td colspan="8" class="text-center py-4 text-muted">
                                                <i class="bi bi-inbox me-1"></i> Belum ada riwayat pengembalian obat UDD untuk pasien ini.
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <!-- Modal Footer -->
            <div class="modal-footer py-1.5 px-3 bg-white justify-content-between">
                <span class="text-muted" style="font-size: 11px;">
                    <i class="bi bi-shield-check text-success me-1"></i> Mutasi stok logistik UDD tidak memotong billing kasir pasien.
                </span>
                <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">Tutup</button>
            </div>

        </div>
    </div>
</div>

@push('script')
<script>
    let currentSisaUddItems = [];

    // Buka Modal Retur UDD dari tombol di Header E-MAR
    function bukaModalReturUdd() {
        const noRawat = $('#emar_info_no_rawat').text();
        if (!noRawat || noRawat === '-') {
            Swal.fire('Peringatan', 'Silakan buka data pasien terlebih dahulu.', 'warning');
            return;
        }

        $('#retur_udd_no_rawat').text(noRawat);
        $('#retur_udd_no_rkm_medis').text($('#emar_info_no_rkm_medis').text());
        $('#retur_udd_nm_pasien').text($('#emar_info_nm_pasien').text());
        $('#retur_udd_kamar').text($('#emar_info_kamar').text());

        // Reset form
        $('#retur_udd_alasan').val('Pasien Boleh Pulang (KRS)');
        $('#retur_udd_catatan').val('');
        $('#tab-form-retur-udd-link').tab('show');

        $('#modalReturStokUdd').modal('show');
        loadSisaStokUddPasien();
        loadRiwayatReturUddPasien();
    }

    // Load sisa stok UDD pasien yang bisa dikembalikan
    function loadSisaStokUddPasien() {
        const noRawat = $('#retur_udd_no_rawat').text();
        if (!noRawat || noRawat === '-') return;

        $('#tbodySisaObatReturUdd').html(`
            <tr>
                <td colspan="8" class="text-center py-4 text-muted">
                    <span class="spinner-border spinner-border-sm me-1"></span> Memeriksa sisa stok obat pasien di loker ruangan...
                </td>
            </tr>
        `);

        $.get("{{ route('retur-stok-udd.sisa') }}", { no_rawat: noRawat })
            .done(function(items) {
                currentSisaUddItems = items || [];
                renderTbodySisaObatRetur(currentSisaUddItems);
            })
            .fail(function(xhr) {
                $('#tbodySisaObatReturUdd').html(`
                    <tr>
                        <td colspan="8" class="text-center py-3 text-danger">
                            <i class="bi bi-exclamation-triangle-fill me-1"></i> Gagal memuat data sisa obat: ${xhr.responseJSON?.message || 'Terjadi kesalahan sistem'}
                        </td>
                    </tr>
                `);
            });
    }

    function renderTbodySisaObatRetur(items) {
        const tbody = $('#tbodySisaObatReturUdd');
        tbody.empty();

        if (!items || items.length === 0) {
            tbody.html(`
                <tr>
                    <td colspan="8" class="text-center py-4 text-muted">
                        <i class="bi bi-check-circle-fill text-success fs-5 d-block mb-1"></i>
                        Tidak ada sisa stok obat UDD untuk pasien ini (seluruh obat telah selesai diberikan atau sudah diajukan pengembalian).
                    </td>
                </tr>
            `);
            $('#checkAllReturUdd').prop('checked', false).prop('disabled', true);
            $('#btnKirimReturUdd').prop('disabled', true);
            return;
        }

        $('#checkAllReturUdd').prop('disabled', false);
        $('#btnKirimReturUdd').prop('disabled', false);

        items.forEach(function(item, idx) {
            const tr = `
                <tr>
                    <td class="text-center">
                        <input class="form-check-input item-retur-check" type="checkbox" value="${idx}" id="chk_retur_${idx}" checked onchange="handleItemCheckChange()">
                    </td>
                    <td class="text-center text-muted">${idx + 1}</td>
                    <td class="text-center font-monospace">${item.kode_brng}</td>
                    <td>
                        <strong>${item.nama_brng}</strong>
                        ${item.no_batch ? `<small class="text-muted d-block" style="font-size: 10px;">Batch: ${item.no_batch}</small>` : ''}
                    </td>
                    <td class="text-center">${item.satuan}</td>
                    <td class="text-center fw-bold text-primary">${item.sisa_stok}</td>
                    <td>
                        <input type="number" step="0.01" min="0.01" max="${item.sisa_stok}" 
                               class="form-control form-control-sm text-center fw-bold item-retur-qty" 
                               id="qty_retur_${idx}" value="${item.sisa_stok}">
                    </td>
                    <td>
                        <input type="text" class="form-control form-control-sm item-retur-ket" 
                               id="ket_retur_${idx}" placeholder="Kondisi kemasan...">
                    </td>
                </tr>
            `;
            tbody.append(tr);
        });

        $('#checkAllReturUdd').prop('checked', true);
    }

    function toggleSelectAllReturUdd(master) {
        $('.item-retur-check').prop('checked', $(master).is(':checked'));
    }

    function handleItemCheckChange() {
        const total = $('.item-retur-check').length;
        const checked = $('.item-retur-check:checked').length;
        $('#checkAllReturUdd').prop('checked', total === checked && total > 0);
    }

    // Kirim Pengajuan Retur UDD
    function kirimPengajuanReturUdd() {
        const noRawat = $('#retur_udd_no_rawat').text();
        const alasan = $('#retur_udd_alasan').val();
        const catatan = $('#retur_udd_catatan').val();

        const selectedItems = [];
        $('.item-retur-check:checked').each(function() {
            const idx = parseInt($(this).val(), 10);
            const original = currentSisaUddItems[idx];
            if (!original) return;

            const qty = parseFloat($(`#qty_retur_${idx}`).val());
            const ket = $(`#ket_retur_${idx}`).val();

            if (isNaN(qty) || qty <= 0) {
                Swal.fire('Peringatan', `Jumlah retur untuk obat ${original.nama_brng} tidak valid.`, 'warning');
                return false;
            }

            if (qty > original.sisa_stok) {
                Swal.fire('Peringatan', `Jumlah retur obat ${original.nama_brng} (${qty}) melebihi sisa yang ada (${original.sisa_stok}).`, 'warning');
                return false;
            }

            selectedItems.push({
                kode_brng: original.kode_brng,
                jml_retur: qty,
                no_batch: original.no_batch,
                no_faktur: original.no_faktur,
                keterangan: ket
            });
        });

        if (selectedItems.length === 0) {
            Swal.fire('Peringatan', 'Silakan pilih minimal 1 item obat yang akan dikembalikan ke Farmasi.', 'warning');
            return;
        }

        Swal.fire({
            title: 'Kirim Pengembalian Sisa UDD?',
            html: `
                <div class="text-start" style="font-size: 13px;">
                    <p class="mb-1">Anda akan mengajukan pengembalian <strong>${selectedItems.length} item obat</strong> ke Depo Farmasi.</p>
                    <p class="text-muted small mb-0">Alasan: <strong>${alasan}</strong></p>
                </div>
            `,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#fd7e14',
            confirmButtonText: '<i class="bi bi-send me-1"></i> Ya, Kirim Pengembalian',
            cancelButtonText: 'Batal'
        }).then((res) => {
            if (res.isConfirmed) {
                $.ajax({
                    url: "{{ route('retur-stok-udd.ajukan') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        no_rawat: noRawat,
                        alasan: alasan,
                        catatan: catatan,
                        items: selectedItems
                    },
                    success: function(resp) {
                        Swal.fire({
                            title: 'Berhasil Diajukan!',
                            text: resp.message || 'Pengajuan pengembalian sisa obat UDD berhasil dikirim.',
                            icon: 'success',
                            showCancelButton: true,
                            confirmButtonColor: '#198754',
                            confirmButtonText: '<i class="bi bi-printer me-1"></i> Cetak Bukti Serah Terima',
                            cancelButtonText: 'Tutup'
                        }).then((pRes) => {
                            if (pRes.isConfirmed && resp.no_retur_udd) {
                                window.open("{{ url('/retur-stok-udd/cetak') }}/" + resp.no_retur_udd, '_blank');
                            }
                        });

                        loadSisaStokUddPasien();
                        loadRiwayatReturUddPasien();
                        loadEmarPasien(); // Refresh E-MAR juga
                    },
                    error: function(xhr) {
                        Swal.fire('Gagal!', xhr.responseJSON?.message || 'Gagal mengirim pengajuan retur UDD.', 'error');
                    }
                });
            }
        });
    }

    // Load Riwayat Retur UDD Pasien Ini
    function loadRiwayatReturUddPasien() {
        const noRawat = $('#retur_udd_no_rawat').text();
        if (!noRawat || noRawat === '-') return;

        const tbody = $('#tbodyRiwayatReturUdd');
        tbody.html(`
            <tr>
                <td colspan="8" class="text-center py-3 text-muted">
                    <span class="spinner-border spinner-border-sm me-1"></span> Memuat riwayat retur UDD...
                </td>
            </tr>
        `);

        $.get("{{ route('retur-stok-udd.daftar') }}", { no_rawat: noRawat })
            .done(function(data) {
                tbody.empty();
                if (!data || data.length === 0) {
                    tbody.html(`
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">
                                <i class="bi bi-inbox me-1"></i> Belum ada riwayat pengembalian obat UDD untuk pasien ini.
                            </td>
                        </tr>
                    `);
                    return;
                }

                data.forEach(function(r, idx) {
                    let badgeStatus = '';
                    if (r.status === 'Menunggu Diterima') {
                        badgeStatus = '<span class="badge bg-warning text-dark"><i class="bi bi-hourglass-split me-1"></i>Menunggu</span>';
                    } else if (r.status === 'Diterima') {
                        badgeStatus = '<span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>Diterima</span>';
                    } else if (r.status === 'Ditolak') {
                        badgeStatus = '<span class="badge bg-danger"><i class="bi bi-x-circle me-1"></i>Ditolak</span>';
                    } else {
                        badgeStatus = '<span class="badge bg-secondary"><i class="bi bi-slash-circle me-1"></i>Batal</span>';
                    }

                    const btnBatal = (r.status === 'Menunggu Diterima')
                        ? `<button type="button" class="btn btn-outline-danger btn-sm py-0 px-1.5" onclick="batalkanReturUdd('${r.no_retur_udd}')" title="Batalkan Pengajuan">
                               <i class="bi bi-trash"></i>
                           </button>`
                        : '';

                    const tr = `
                        <tr>
                            <td class="text-center text-muted">${idx + 1}</td>
                            <td class="text-center font-monospace fw-bold text-primary">${r.no_retur_udd}</td>
                            <td class="text-center">${r.tgl_retur} ${r.jam_retur}</td>
                            <td>
                                <strong>${r.alasan}</strong>
                                <small class="text-muted d-block">${r.details ? r.details.length : 0} item obat</small>
                            </td>
                            <td>${r.pegawai_ruangan ? r.pegawai_ruangan.nama : r.petugas_ruangan}</td>
                            <td class="text-center">${badgeStatus}</td>
                            <td>${r.pegawai_farmasi ? r.pegawai_farmasi.nama : (r.status === 'Diterima' ? r.petugas_farmasi : '-')}</td>
                            <td class="text-center">
                                <div class="d-flex align-items-center justify-content-center gap-1">
                                    <button type="button" class="btn btn-outline-primary btn-sm py-0 px-1.5" onclick="window.open('{{ url('/retur-stok-udd/cetak') }}/${r.no_retur_udd}', '_blank')" title="Cetak Bukti">
                                        <i class="bi bi-printer"></i>
                                    </button>
                                    ${btnBatal}
                                </div>
                            </td>
                        </tr>
                    `;
                    tbody.append(tr);
                });
            })
            .fail(function() {
                tbody.html(`
                    <tr>
                        <td colspan="8" class="text-center py-3 text-danger">Gagal memuat riwayat retur.</td>
                    </tr>
                `);
            });
    }

    // Batalkan Pengajuan Retur UDD
    function batalkanReturUdd(noReturUdd) {
        Swal.fire({
            title: 'Batalkan Pengajuan Retur UDD?',
            text: `Batalkan pengajuan ${noReturUdd}?`,
            icon: 'warning',
            input: 'text',
            inputPlaceholder: 'Alasan pembatalan (opsional)...',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            confirmButtonText: 'Ya, Batalkan',
            cancelButtonText: 'Kembali'
        }).then((res) => {
            if (res.isConfirmed) {
                $.post("{{ url('/retur-stok-udd/batal') }}/" + noReturUdd, {
                    _token: "{{ csrf_token() }}",
                    alasan: res.value || 'Dibatalkan perawat'
                }).done(function(resp) {
                    Swal.fire('Dibatalkan!', resp.message || 'Pengajuan telah dibatalkan.', 'success');
                    loadSisaStokUddPasien();
                    loadRiwayatReturUddPasien();
                    loadEmarPasien();
                }).fail(function(xhr) {
                    Swal.fire('Gagal!', xhr.responseJSON?.message || 'Gagal membatalkan pengajuan.', 'error');
                });
            }
        });
    }
</script>
@endpush
