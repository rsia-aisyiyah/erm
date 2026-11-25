<!-- MODAL PILIH BUNDLING / PAKET BOX OBAT & BHP -->
<div class="modal fade" id="modalPilihBundlingObat" tabindex="-1" aria-labelledby="modalPilihBundlingObatLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content border-0 shadow">
            
            <!-- Modal Header -->
            <div class="modal-header text-white py-2 px-3 align-items-center justify-content-between" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);">
                <div class="d-flex align-items-center gap-2">
                    <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center" style="width: 34px; height: 34px;">
                        <i class="bi bi-box-seam-fill fs-5 text-white"></i>
                    </div>
                    <div>
                        <h6 class="modal-title fw-bold text-white mb-0" id="modalPilihBundlingObatLabel">
                            PILIH BUNDLING / PAKET BOX OBAT &amp; BHP
                        </h6>
                        <small class="text-white-50" style="font-size: 11px;">Pilih template paket tindakan untuk mengisi seluruh item obat &amp; BHP secara otomatis</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Filter & Search Toolbar -->
            <div class="p-3 bg-light border-bottom">
                <div class="row g-2 align-items-center">
                    <div class="col-md-4 col-12">
                        <label class="form-label small fw-bold mb-1 text-muted" style="font-size: 10.5px;">FILTER RUANGAN / UNIT</label>
                        <select class="form-select form-select-sm" id="bundling_fil_unit" onchange="loadDaftarBundling()">
                            <option value="Semua">-- Semua Unit / Ruangan --</option>
                            <option value="Kamar Operasi">Kamar Operasi (IBS)</option>
                            <option value="UGD">UGD</option>
                            <option value="VK">VK (Kamar Bersalin)</option>
                            <option value="Ranap">Rawat Inap</option>
                        </select>
                    </div>
                    <div class="col-md-8 col-12">
                        <label class="form-label small fw-bold mb-1 text-muted" style="font-size: 10.5px;">CARI NAMA PAKET / TINDAKAN</label>
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" id="bundling_fil_keyword" placeholder="Ketik nama paket box (misal: SC, Kuret, Partus, Infus)..." onkeyup="if(event.key==='Enter') loadDaftarBundling()">
                            <button class="btn btn-outline-primary" type="button" onclick="loadDaftarBundling()">
                                <i class="bi bi-search me-1"></i> Cari
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Body (List of Bundling Packages) -->
            <div class="modal-body p-3 bg-light" style="min-height: 350px;">
                <div id="containerListBundling" class="d-flex flex-column gap-2.5">
                    <div class="text-center py-5 text-muted">
                        <div class="spinner-border spinner-border-sm text-primary me-2" role="status"></div>
                        Memuat daftar paket obat...
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer bg-white py-2 px-3 justify-content-between">
                <small class="text-muted" style="font-size: 11px;">
                    <i class="bi bi-info-circle me-1 text-primary"></i> Seluruh item dalam paket yang dipilih akan langsung masuk ke tabel order.
                </small>
                <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL SIMPAN SEBAGAI PAKET BARU DARI FORM ORDER -->
<div class="modal fade" id="modalSimpanPaketDariOrder" tabindex="-1" aria-labelledby="modalSimpanPaketDariOrderLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-secondary text-white py-2 px-3">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-bookmark-plus-fill fs-5"></i>
                    <h6 class="modal-title fw-bold text-white mb-0" id="modalSimpanPaketDariOrderLabel">Simpan Menjadi Template Paket Baru</h6>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3 bg-light">
                <div class="alert alert-info py-2 px-3 small mb-3 border-0 rounded-3">
                    <i class="bi bi-info-circle me-1"></i> Sebanyak <strong id="lblJumlahItemDisimpan" class="text-primary">0</strong> item obat yang ada di tabel order saat ini akan disimpan sebagai template paket baru.
                </div>
                <form id="formSimpanPaketDariOrder">
                    <div class="mb-2">
                        <label class="form-label small fw-bold mb-1">Nama Paket / Box <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm" id="save_nama_paket" required placeholder="Contoh: Paket Box Operasi SC - dr. Himawan">
                    </div>
                    <div class="mb-2">
                        <label class="form-label small fw-bold mb-1">Unit / Ruangan <span class="text-danger">*</span></label>
                        <select class="form-select form-select-sm" id="save_unit" required>
                            <option value="Kamar Operasi">Kamar Operasi (IBS)</option>
                            <option value="UGD">UGD</option>
                            <option value="VK">VK (Kamar Bersalin)</option>
                            <option value="Ranap">Rawat Inap</option>
                            <option value="Semua">Semua Unit</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label class="form-label small fw-bold mb-1">Keterangan / Catatan Tindakan</label>
                        <textarea class="form-control form-control-sm" id="save_keterangan" rows="2" placeholder="Catatan indikasi / penggunaan paket ini..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-white py-2 px-3 justify-content-between">
                <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary btn-sm px-4 shadow-sm" onclick="prosesSimpanPaketDariOrder()">
                    <i class="bi bi-check-lg me-1"></i> Simpan Template
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    let cacheBundlingData = [];

    // Buka Modal Pemilih Bundling
    function bukaModalPilihBundling() {
        const kamarInfo = $('#permintaan_info_kamar').text().trim().toUpperCase();

        // Auto-select filter berdasarkan kamar/ruangan pasien
        if (kamarInfo.includes('OPERASI') || kamarInfo.includes('OK') || kamarInfo.includes('IBS')) {
            $('#bundling_fil_unit').val('Kamar Operasi');
        } else if (kamarInfo.includes('IGD') || kamarInfo.includes('UGD')) {
            $('#bundling_fil_unit').val('UGD');
        } else if (kamarInfo.includes('BERSALIN') || kamarInfo.includes('VK')) {
            $('#bundling_fil_unit').val('VK');
        } else if ($('#bundling_fil_unit').val() === 'Semua') {
            $('#bundling_fil_unit').val('Kamar Operasi');
        }

        $('#bundling_fil_keyword').val('');
        $('#modalPilihBundlingObat').modal('show');
        loadDaftarBundling();
    }

    // Ambil Data Bundling dari Server
    function loadDaftarBundling() {
        const unit = $('#bundling_fil_unit').val();
        const kw = $('#bundling_fil_keyword').val();
        const $container = $('#containerListBundling');

        $container.html(`
            <div class="text-center py-5 text-muted">
                <div class="spinner-border spinner-border-sm text-primary me-2" role="status"></div>
                Memuat daftar paket obat &amp; BHP...
            </div>
        `);

        $.get("{{ route('obat.paket.data') }}", {
            unit: unit,
            status: '1',
            keyword: kw,
            with_stok: 1,
            depo: 'RM'
        }).done(function(res) {
            cacheBundlingData = res?.data || [];
            renderDaftarBundlingCards();
        }).fail(function() {
            $container.html(`
                <div class="alert alert-danger py-3 text-center rounded-3">
                    <i class="bi bi-exclamation-triangle me-1"></i> Gagal memuat data paket. Silahkan coba lagi.
                </div>
            `);
        });
    }

    // Render Cards Paket Bundling
    function renderDaftarBundlingCards() {
        const $container = $('#containerListBundling');
        $container.empty();

        if (cacheBundlingData.length === 0) {
            $container.html(`
                <div class="text-center py-5 text-muted bg-white rounded-3 shadow-sm border p-4">
                    <i class="bi bi-box-seam fs-1 d-block mb-2 text-secondary opacity-50"></i>
                    <h6 class="fw-bold text-dark mb-1">Belum Ada Paket Bundling Ditemukan</h6>
                    <small class="text-muted d-block mb-3">Tidak ada template paket untuk filter ruangan atau kata kunci yang dipilih.</small>
                    <a href="{{ route('obat.paket') }}" target="_blank" class="btn btn-outline-primary btn-sm px-3 rounded-pill">
                        <i class="bi bi-plus-lg me-1"></i> Buat Paket di Master Data
                    </a>
                </div>
            `);
            return;
        }

        cacheBundlingData.forEach(function(paket, idx) {
            const unitBadgeClass = paket.unit === 'Kamar Operasi' ? 'bg-danger-subtle text-danger border-danger' : 
                (paket.unit === 'UGD' ? 'bg-warning-subtle text-dark border-warning' : 
                (paket.unit === 'VK' ? 'bg-info-subtle text-info-emphasis border-info' : 'bg-primary-subtle text-primary border-primary'));

            const itemsCount = paket.details ? paket.details.length : (paket.details_count || 0);
            const collapseId = `collapsePaket_${paket.id}`;

            // Rincian items table
            let itemsRows = '';
            let anyOutOfStock = false;
            if (paket.details && paket.details.length > 0) {
                paket.details.forEach(function(det, dIdx) {
                    const isReady = (det.stok || 0) >= det.jumlah;
                    if (!isReady) anyOutOfStock = true;

                    itemsRows += `
                        <tr>
                            <td class="text-center font-monospace">${dIdx + 1}</td>
                            <td class="font-monospace">${det.kode_brng}</td>
                            <td><strong>${det.nama_brng || det.barang?.nama_brng || '-'}</strong></td>
                            <td class="text-center fw-bold text-primary">${det.jumlah}</td>
                            <td class="text-center">${det.satuan || 'Sat'}</td>
                            <td class="text-center">
                                <span class="badge ${isReady ? 'bg-success' : 'bg-danger'} rounded-pill" style="font-size: 10px;">
                                    Stok: ${det.stok || 0}
                                </span>
                            </td>
                            <td><small class="text-muted">${det.aturan_pakai || '-'}</small></td>
                        </tr>
                    `;
                });
            }

            const cardHtml = `
                <div class="card border-0 shadow-sm rounded-3 bg-white mb-2 overflow-hidden">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                            <div class="d-flex align-items-start gap-2.5">
                                <div class="rounded-3 bg-primary bg-opacity-10 text-primary p-2 d-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                                    <i class="bi bi-box-seam fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-0 text-dark" style="font-size: 13.5px;">
                                        ${paket.nama_paket}
                                    </h6>
                                    <div class="d-flex align-items-center gap-1.5 mt-1 flex-wrap" style="font-size: 11px;">
                                        <span class="badge border py-0.5 px-2 rounded-pill ${unitBadgeClass}">
                                            <i class="bi bi-geo-alt me-0.5"></i> ${paket.unit}
                                        </span>
                                        <span class="badge bg-light text-dark border py-0.5 px-2 rounded-pill font-monospace">
                                            <i class="bi bi-capsule me-0.5 text-success"></i> ${itemsCount} Item
                                        </span>
                                        ${paket.dokter ? `<span class="badge bg-secondary-subtle text-secondary border py-0.5 px-2 rounded-pill"><i class="bi bi-person-badge me-0.5"></i> ${paket.dokter.nm_dokter}</span>` : ''}
                                    </div>
                                    ${paket.keterangan && paket.keterangan !== '-' ? `<small class="text-muted d-block mt-1" style="font-size: 11px;"><i>${paket.keterangan}</i></small>` : ''}
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <button type="button" class="btn btn-outline-secondary btn-sm py-1 px-2.5 shadow-none" data-bs-toggle="collapse" data-bs-target="#${collapseId}" aria-expanded="false" style="font-size: 11px;">
                                    <i class="bi bi-list-nested me-1"></i> Rincian Item
                                </button>
                                <button type="button" class="btn btn-success btn-sm px-3 shadow-sm py-1" onclick="terapkanPaketKeOrder(${paket.id})" style="font-size: 12px;">
                                    <i class="bi bi-check2-circle me-1"></i> <b>Gunakan Paket Ini</b>
                                </button>
                            </div>
                        </div>

                        <!-- Collapse Preview Items -->
                        <div class="collapse mt-2.5 pt-2 border-top" id="${collapseId}">
                            <div class="table-responsive border rounded-2">
                                <table class="table table-bordered table-sm align-middle mb-0" style="font-size: 11px;">
                                    <thead class="table-light text-center">
                                        <tr>
                                            <th width="4%">No</th>
                                            <th width="14%">Kode</th>
                                            <th width="36%">Nama Obat / BHP</th>
                                            <th width="10%">Qty</th>
                                            <th width="10%">Sat</th>
                                            <th width="12%">Stok Depo</th>
                                            <th width="14%">Dosis</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        ${itemsRows || '<tr><td colspan="7" class="text-center py-2 text-muted">Tidak ada item dalam paket</td></tr>'}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            $container.append(cardHtml);
        });
    }

    // Terapkan Seluruh Item Paket ke Tabel Order Permintaan Pasien
    function terapkanPaketKeOrder(paketId) {
        const paket = cacheBundlingData.find(p => p.id == paketId);
        if (!paket) {
            Swal.fire('Peringatan', 'Data paket tidak ditemukan.', 'warning');
            return;
        }

        if (!paket.details || paket.details.length === 0) {
            Swal.fire('Peringatan', 'Paket ini tidak memiliki item obat.', 'warning');
            return;
        }

        let itemDitambahkan = 0;
        let itemDiupdate = 0;

        paket.details.forEach(function(det) {
            const kode = det.kode_brng;
            const nama = det.nama_brng || det.barang?.nama_brng || '-';
            const satuan = det.satuan || det.barang?.kodeSatuan?.satuan || (det.barang?.kode_sat || 'Sat');
            const jml = parseFloat(det.jumlah) || 1;
            const aturan = det.aturan_pakai || '-';

            // Cek apakah item sudah ada di daftar order sementara
            const existingIdx = listOrderSementara.findIndex(i => i.kode_brng === kode);
            if (existingIdx !== -1) {
                listOrderSementara[existingIdx].jml += jml;
                if (aturan !== '-' && listOrderSementara[existingIdx].aturan_pakai === '-') {
                    listOrderSementara[existingIdx].aturan_pakai = aturan;
                }
                itemDiupdate++;
            } else {
                listOrderSementara.push({
                    kode_brng: kode,
                    nama_brng: nama,
                    satuan: satuan,
                    jml: jml,
                    aturan_pakai: aturan,
                    jam: {},
                    jam_list: []
                });
                itemDitambahkan++;
            }
        });

        renderTableItemSementara();
        $('#modalPilihBundlingObat').modal('hide');

        Swal.fire({
            icon: 'success',
            title: 'Paket Berhasil Diterapkan!',
            html: `<div style="font-size: 12px;">Paket <b>${paket.nama_paket}</b> telah dimasukkan ke daftar order.<br><span class="text-success">${itemDitambahkan} item baru ditambahkan</span>, <span class="text-primary">${itemDiupdate} item bertambah kuantitas</span>.</div>`,
            showConfirmButton: true,
            confirmButtonText: 'OK, Lanjutkan',
            confirmButtonColor: '#198754'
        });
    }

    // Modal Simpan List Order Sebagai Paket Baru (Shortcut)
    function bukaModalSimpanSebagaiPaket() {
        if (!listOrderSementara || listOrderSementara.length === 0) {
            Swal.fire('Peringatan', 'Tabel order masih kosong. Tambahkan obat terlebih dahulu sebelum menyimpan sebagai paket.', 'warning');
            return;
        }

        $('#formSimpanPaketDariOrder')[0].reset();
        $('#lblJumlahItemDisimpan').text(listOrderSementara.length);

        const kamarInfo = $('#permintaan_info_kamar').text().trim().toUpperCase();
        if (kamarInfo.includes('OPERASI') || kamarInfo.includes('OK') || kamarInfo.includes('IBS')) {
            $('#save_unit').val('Kamar Operasi');
        } else if (kamarInfo.includes('IGD') || kamarInfo.includes('UGD')) {
            $('#save_unit').val('UGD');
        } else if (kamarInfo.includes('BERSALIN') || kamarInfo.includes('VK')) {
            $('#save_unit').val('VK');
        } else {
            $('#save_unit').val('Ranap');
        }

        $('#modalSimpanPaketDariOrder').modal('show');
    }

    // Proses Simpan Paket Baru dari Form Order
    function prosesSimpanPaketDariOrder() {
        const nama = $('#save_nama_paket').val().trim();
        const unit = $('#save_unit').val();
        const ket = $('#save_keterangan').val().trim();
        const kdDokter = $('#permintaan_kd_dokter').val() || null;

        if (!nama) {
            Swal.fire('Peringatan', 'Nama Paket wajib diisi.', 'warning');
            $('#save_nama_paket').focus();
            return;
        }

        Swal.fire({ title: 'Menyimpan Template Paket...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });

        $.ajax({
            url: "{{ route('obat.paket.simpan-dari-order') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                nama_paket: nama,
                unit: unit,
                keterangan: ket,
                kd_dokter: kdDokter,
                items: listOrderSementara
            },
            success: function(res) {
                $('#modalSimpanPaketDariOrder').modal('hide');
                Swal.fire('Tersimpan!', res.message || 'Template paket baru berhasil disimpan.', 'success');
            },
            error: function(xhr) {
                Swal.fire('Gagal!', xhr.responseJSON?.message || 'Gagal menyimpan template paket.', 'error');
            }
        });
    }
</script>
