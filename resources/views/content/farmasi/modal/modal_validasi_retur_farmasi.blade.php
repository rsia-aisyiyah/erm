<!-- Modal Review & Validasi Pengajuan Retur Farmasi -->
<div class="modal fade" id="modalValidasiReturFarmasi" tabindex="-1" aria-labelledby="modalValidasiReturFarmasiLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" style="z-index: 1060;">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow">
            
            <!-- Modal Header -->
            <div class="modal-header text-white py-2 px-3 justify-content-between align-items-center" style="background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);">
                <div class="d-flex align-items-center gap-2">
                    <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center" style="width: 34px; height: 34px;">
                        <i class="bi bi-shield-check fs-5 text-white"></i>
                    </div>
                    <div>
                        <h6 class="modal-title fw-bold mb-0 text-white" id="modalValidasiReturFarmasiLabel">
                            VALIDASI PENGAJUAN RETUR OBAT (FARMASI)
                        </h6>
                        <small class="text-white-50" style="font-size: 11px;">Persetujuan pengembalian obat ke depo &amp; pembuatan transaksi Retur Jual SIMRS Khanza</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body p-3 bg-light">
                
                <!-- Info Pengajuan Banner -->
                <div class="card border-0 shadow-sm rounded-3 mb-3 bg-white">
                    <div class="card-body p-2.5">
                        <div class="row g-2 align-items-center" style="font-size: 11.5px;">
                            <div class="col-md-3 col-6">
                                <label class="text-muted small mb-0 d-block" style="font-size: 10px;">NO. PENGAJUAN</label>
                                <strong class="text-primary font-monospace" id="val_retur_no_pengajuan">-</strong>
                            </div>
                            <div class="col-md-3 col-6">
                                <label class="text-muted small mb-0 d-block" style="font-size: 10px;">WAKTU PENGAJUAN</label>
                                <span class="text-dark" id="val_retur_waktu">-</span>
                            </div>
                            <div class="col-md-3 col-6">
                                <label class="text-muted small mb-0 d-block" style="font-size: 10px;">PASIEN</label>
                                <strong class="text-dark" id="val_retur_nm_pasien">-</strong>
                                <small class="text-muted font-monospace" id="val_retur_no_rkm_medis"></small>
                            </div>
                            <div class="col-md-3 col-6">
                                <label class="text-muted small mb-0 d-block" style="font-size: 10px;">RUANGAN / KAMAR</label>
                                <strong class="text-dark" id="val_retur_kamar">-</strong>
                            </div>
                            <div class="col-md-3 col-6">
                                <label class="text-muted small mb-0 d-block" style="font-size: 10px;">PETUGAS PENGAJU</label>
                                <span class="text-dark" id="val_retur_petugas">-</span>
                            </div>
                            <div class="col-md-3 col-6">
                                <label class="text-muted small mb-0 d-block" style="font-size: 10px;">STATUS SAAT INI</label>
                                <span class="badge bg-warning text-dark px-2 py-1" id="val_retur_badge_status">Menunggu Validasi</span>
                            </div>
                            <div class="col-md-6 col-12">
                                <label class="text-muted small mb-0 d-block" style="font-size: 10px;">CATATAN RUANGAN</label>
                                <span class="text-secondary fst-italic" id="val_retur_catatan_ruangan">-</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabel Item Obat Yang Diretur -->
                <div class="card border-0 shadow-sm rounded-3 bg-white mb-3">
                    <div class="card-header bg-white py-2 px-3 border-bottom d-flex justify-content-between align-items-center">
                        <h6 class="fw-bold mb-0 text-dark" style="font-size: 12px;">
                            <i class="bi bi-capsule text-primary me-1"></i> Rincian Item Obat yang Diajukan
                        </h6>
                        <small class="text-muted" style="font-size: 11px;">Sesuaikan jumlah yang disetujui jika fisik obat tidak lengkap.</small>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive" style="max-height: 360px;">
                            <table class="table table-hover table-bordered table-sm mb-0 align-middle" style="font-size: 11.5px;">
                                <thead class="table-light sticky-top">
                                    <tr class="text-center align-middle">
                                        <th style="width: 45px;">No</th>
                                        <th style="width: 100px;">Kode</th>
                                        <th>Nama Obat / Alkes</th>
                                        <th style="width: 70px;">Satuan</th>
                                        <th style="width: 90px;">Diajukan</th>
                                        <th style="width: 110px;" class="table-primary text-primary">Disetujui</th>
                                        <th style="width: 100px;">Harga (Rp)</th>
                                        <th style="width: 110px;">Subtotal (Rp)</th>
                                        <th style="width: 110px;">Batch/Faktur</th>
                                        <th>Keterangan Pengaju</th>
                                    </tr>
                                </thead>
                                <tbody id="tbodyValReturItems">
                                    <tr>
                                        <td colspan="10" class="text-center py-4 text-muted">Memuat data obat...</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer bg-light p-2.5 border-top d-flex justify-content-between align-items-center">
                        <span class="text-muted" style="font-size: 11.5px;">
                            Total Item: <strong class="text-dark" id="lblValReturTotalItem">0</strong>
                        </span>
                        <div>
                            <span class="text-muted me-2" style="font-size: 11.5px;">Total Nilai Retur yang Disetujui:</span>
                            <strong class="text-primary fs-6" id="lblValReturTotalNominal">Rp 0</strong>
                        </div>
                    </div>
                </div>

                <!-- Input Catatan Farmasi -->
                <div class="card border-0 shadow-sm rounded-3 bg-white p-3">
                    <label for="val_retur_catatan_farmasi" class="form-label fw-bold mb-1" style="font-size: 11.5px;">
                        <i class="bi bi-chat-dots text-primary me-1"></i> Catatan / Alasan Farmasi:
                    </label>
                    <textarea class="form-control form-control-sm" id="val_retur_catatan_farmasi" rows="2" placeholder="Catatan opsional saat disetujui, atau wajib diisi alasan penolakan jika pengajuan ditolak..."></textarea>
                </div>

            </div>

            <!-- Modal Footer -->
            <div class="modal-footer py-2 px-3 bg-white border-top justify-content-between">
                <div>
                    <button type="button" class="btn btn-outline-secondary btn-sm" id="btnCetakDariModalValidasi" style="display: none;" onclick="cetakSlipReturDariModal()">
                        <i class="bi bi-printer me-1"></i> Cetak Bukti Retur
                    </button>
                </div>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-outline-danger btn-sm px-3" id="btnRejectReturFarmasi" onclick="prosesValidasiReturAksi('reject')">
                        <i class="bi bi-x-circle me-1"></i> Tolak Pengajuan
                    </button>
                    <button type="button" class="btn btn-success btn-sm px-3 shadow-sm" id="btnApproveReturFarmasi" onclick="prosesValidasiReturAksi('approve')">
                        <i class="bi bi-check-circle-fill me-1"></i> Setujui &amp; Buat Retur Jual
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    let currentDetailReturFarmasi = null;

    // Buka Modal Validasi Retur Farmasi
    function bukaModalValidasiReturFarmasi(noPengajuan) {
        if (!noPengajuan) return;

        Swal.fire({
            title: 'Memuat...',
            allowOutsideClick: false,
            didOpen: () => Swal.showLoading()
        });

        $.ajax({
            url: "{{ url('/retur-obat/detail') }}/" + noPengajuan,
            type: "GET",
            success: function(res) {
                Swal.close();
                currentDetailReturFarmasi = res;

                $('#val_retur_no_pengajuan').text(res.no_pengajuan);
                $('#val_retur_waktu').text(`${splitTanggal(res.tgl_pengajuan)} ${res.jam_pengajuan}`);

                const pasien = res.reg_periksa?.pasien || {};
                $('#val_retur_nm_pasien').text(pasien.nm_pasien || '-');
                $('#val_retur_no_rkm_medis').text(`(${pasien.no_rkm_medis || '-'})`);

                const kamarList = res.reg_periksa?.kamar_inap || [];
                let kamarNama = '-';
                if (kamarList.length > 0) {
                    const activeKamar = kamarList.find(k => k.stts_pulang === '-') || kamarList[0];
                    kamarNama = activeKamar?.kamar?.bangsal?.nm_bangsal || activeKamar?.kd_kamar || '-';
                }
                $('#val_retur_kamar').text(kamarNama);
                $('#val_retur_petugas').text(res.pegawai_pengaju?.nama || res.petugas_pengaju);

                let badgeClass = 'bg-warning text-dark';
                if (res.status === 'Disetujui') badgeClass = 'bg-success text-white';
                else if (res.status === 'Ditolak') badgeClass = 'bg-danger text-white';
                else if (res.status === 'Batal') badgeClass = 'bg-secondary text-white';

                $('#val_retur_badge_status').attr('class', `badge ${badgeClass} px-2 py-1`).text(res.status);
                $('#val_retur_catatan_ruangan').text(res.catatan || '-');
                $('#val_retur_catatan_farmasi').val(res.catatan_farmasi || '');

                const isMenunggu = res.status === 'Menunggu Validasi';
                if (isMenunggu) {
                    $('#btnRejectReturFarmasi, #btnApproveReturFarmasi').show();
                    $('#btnCetakDariModalValidasi').hide();
                } else {
                    $('#btnRejectReturFarmasi, #btnApproveReturFarmasi').hide();
                    $('#btnCetakDariModalValidasi').show();
                }

                renderTabelItemValidasiFarmasi(res.details || [], isMenunggu);
                $('#modalValidasiReturFarmasi').modal('show');
            },
            error: function(err) {
                Swal.fire('Gagal', err.responseJSON?.message || 'Gagal memuat detail pengajuan.', 'error');
            }
        });
    }

    // Render Tabel Item Validasi
    function renderTabelItemValidasiFarmasi(items, isEditable) {
        const $tbody = $('#tbodyValReturItems');
        $tbody.empty();

        if (items.length === 0) {
            $tbody.html('<tr><td colspan="10" class="text-center py-3 text-muted">Tidak ada item obat pada pengajuan ini.</td></tr>');
            hitungTotalValidasiFarmasi();
            return;
        }

        items.forEach(function(item, idx) {
            const jmlDiajukan = parseFloat(item.jml_diajukan) || 0;
            const jmlDisetujui = isEditable ? jmlDiajukan : (parseFloat(item.jml_disetujui) || 0);
            const harga = parseFloat(item.h_retur) || 0;
            const subtotal = jmlDisetujui * harga;

            const tr = `
                <tr>
                    <td class="text-center">${idx + 1}</td>
                    <td class="font-monospace text-center">${item.kode_brng}</td>
                    <td><strong>${item.barang?.nama_brng || item.kode_brng}</strong></td>
                    <td class="text-center">${item.kode_sat || '-'}</td>
                    <td class="text-center fw-bold text-secondary">${jmlDiajukan}</td>
                    <td class="text-center">
                        <input type="number" class="form-control form-control-sm text-center fw-bold py-0.5 px-1 input-val-disetujui" 
                            id="val_disetujui_${item.id}" 
                            data-id="${item.id}" 
                            data-harga="${harga}" 
                            data-max="${jmlDiajukan}" 
                            value="${jmlDisetujui}" 
                            min="0" 
                            max="${jmlDiajukan}" 
                            step="any" 
                            ${!isEditable ? 'disabled' : ''} 
                            onchange="onChangeValDisetujui(${item.id})" 
                            style="font-size: 11.5px;">
                    </td>
                    <td class="text-end">${formatRupiah(harga)}</td>
                    <td class="text-end fw-bold text-primary" id="val_subtotal_${item.id}">${formatRupiah(subtotal)}</td>
                    <td class="text-center font-monospace" style="font-size: 10px;">
                        ${item.no_batch ? `B:${item.no_batch}<br>` : ''}${item.no_faktur ? `F:${item.no_faktur}` : '-'}
                    </td>
                    <td style="font-size: 11px;">${item.keterangan || '-'}</td>
                </tr>
            `;
            $tbody.append(tr);
        });

        hitungTotalValidasiFarmasi();
    }

    // Ubah Jumlah Disetujui
    function onChangeValDisetujui(itemId) {
        const $input = $(`#val_disetujui_${itemId}`);
        let num = parseFloat($input.val());
        const max = parseFloat($input.data('max')) || 0;
        const harga = parseFloat($input.data('harga')) || 0;

        if (isNaN(num) || num < 0) {
            num = 0;
            $input.val(num);
        } else if (num > max) {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'warning',
                title: `Jumlah disetujui tidak boleh melebihi yang diajukan (${max})`,
                showConfirmButton: false,
                timer: 2000
            });
            num = max;
            $input.val(num);
        }

        const subtotal = num * harga;
        $(`#val_subtotal_${itemId}`).text(formatRupiah(subtotal));

        hitungTotalValidasiFarmasi();
    }

    // Hitung Total Nilai Disetujui
    function hitungTotalValidasiFarmasi() {
        let totalItem = 0;
        let totalNominal = 0;

        $('.input-val-disetujui').each(function() {
            const num = parseFloat($(this).val()) || 0;
            const harga = parseFloat($(this).data('harga')) || 0;
            if (num > 0) {
                totalItem++;
                totalNominal += (num * harga);
            }
        });

        $('#lblValReturTotalItem').text(totalItem);
        $('#lblValReturTotalNominal').text(formatRupiah(totalNominal));
    }

    // Eksekusi Validasi (Approve / Reject)
    function prosesValidasiReturAksi(aksi) {
        if (!currentDetailReturFarmasi) return;

        const noPengajuan = currentDetailReturFarmasi.no_pengajuan;
        const catatan = $('#val_retur_catatan_farmasi').val();

        if (aksi === 'reject') {
            if (!catatan.trim()) {
                Swal.fire('Peringatan', 'Harap isi catatan / alasan penolakan pada kolom catatan farmasi.', 'warning');
                $('#val_retur_catatan_farmasi').focus();
                return;
            }

            Swal.fire({
                title: 'Tolak Pengajuan Retur?',
                text: `Pengajuan ${noPengajuan} akan ditolak dengan alasan: "${catatan}". Lanjutkan?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                confirmButtonText: 'Ya, Tolak Pengajuan',
                cancelButtonText: 'Batal'
            }).then((res) => {
                if (res.isConfirmed) {
                    kirimAksiValidasiKeServer(noPengajuan, {
                        aksi: 'reject',
                        catatan_farmasi: catatan
                    });
                }
            });

        } else if (aksi === 'approve') {
            const items = [];
            let totalQty = 0;

            $('.input-val-disetujui').each(function() {
                const id = $(this).data('id');
                const qty = parseFloat($(this).val()) || 0;
                totalQty += qty;
                items.push({
                    id: id,
                    jml_disetujui: qty
                });
            });

            if (totalQty <= 0) {
                Swal.fire('Peringatan', 'Tidak ada item obat yang disetujui (semua jumlah disetujui 0). Jika ingin membatalkan, silakan pilih Tolak Pengajuan.', 'warning');
                return;
            }

            Swal.fire({
                title: 'Setujui & Buat Retur Jual?',
                html: `Sistem akan otomatis:<br>
                    <ul class="text-start mt-2" style="font-size: 12px;">
                        <li>Membuat Transaksi <b>Retur Jual SIMRS Khanza</b></li>
                        <li>Mengembalikan stok ke <b>Gudang/Depo Farmasi</b></li>
                        <li>Mencatat mutasi masuk ke <b>Riwayat Barang Medis</b></li>
                    </ul>`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#198754',
                confirmButtonText: 'Ya, Setujui Sekarang',
                cancelButtonText: 'Batal'
            }).then((res) => {
                if (res.isConfirmed) {
                    kirimAksiValidasiKeServer(noPengajuan, {
                        aksi: 'approve',
                        catatan_farmasi: catatan,
                        items: items
                    });
                }
            });
        }
    }

    // Ajax Kirim Validasi ke Server
    function kirimAksiValidasiKeServer(noPengajuan, payload) {
        payload._token = "{{ csrf_token() }}";

        Swal.fire({
            title: 'Memproses Validasi...',
            text: 'Mohon tunggu, sinkronisasi stok dan transaksi SIMRS sedang berjalan.',
            allowOutsideClick: false,
            didOpen: () => Swal.showLoading()
        });

        $.ajax({
            url: "{{ url('/retur-obat/validasi') }}/" + noPengajuan,
            type: "POST",
            data: payload,
            success: function(resp) {
                Swal.fire({
                    icon: 'success',
                    title: 'Validasi Berhasil!',
                    html: `${resp.message || 'Pengajuan retur berhasil divalidasi.'}<br>` + 
                        (resp.no_retur_jual ? `<div class="mt-2 p-2 bg-light rounded border font-monospace text-primary fw-bold fs-6">No. Retur Jual: ${resp.no_retur_jual}</div>` : '') +
                        (resp.no_jurnal ? `<div class="mt-1 small text-muted font-monospace"><i class="bi bi-journal-check text-success me-1"></i>No. Jurnal GL: <strong>${resp.no_jurnal}</strong></div>` : ''),
                    showCancelButton: Boolean(resp.no_retur_jual),
                    confirmButtonText: resp.no_retur_jual ? '<i class="bi bi-printer me-1"></i> Cetak Bukti' : 'OK',
                    cancelButtonText: 'Tutup'
                }).then((r) => {
                    if (r.isConfirmed && resp.no_retur_jual) {
                        window.open("{{ url('/retur-obat/cetak') }}/" + noPengajuan, '_blank');
                    }
                    $('#modalValidasiReturFarmasi').modal('hide');
                    if (typeof loadPengajuanReturFarmasi === 'function') {
                        loadPengajuanReturFarmasi();
                    }
                });
            },
            error: function(err) {
                Swal.fire('Gagal', err.responseJSON?.message || 'Terjadi kesalahan saat memproses validasi.', 'error');
            }
        });
    }

    // Cetak Slip dari Modal
    function cetakSlipReturDariModal() {
        if (currentDetailReturFarmasi) {
            window.open("{{ url('/retur-obat/cetak') }}/" + currentDetailReturFarmasi.no_pengajuan, '_blank');
        }
    }

    // Helper Format Rupiah
    function formatRupiah(angka) {
        const num = parseFloat(angka) || 0;
        return 'Rp ' + num.toLocaleString('id-ID');
    }
</script>
