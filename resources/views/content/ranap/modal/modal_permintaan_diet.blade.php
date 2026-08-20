<!-- Modal Permintaan Diet Pasien Ranap -->
<div class="modal fade" id="modalPermintaanDiet" tabindex="-1" aria-labelledby="modalPermintaanDietLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content border-0 shadow">
            
            <!-- Modal Header -->
            <div class="modal-header text-white py-2 px-3 justify-content-between align-items-center" style="background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);">
                <div class="d-flex align-items-center gap-2">
                    <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                        <i class="bi bi-cup-hot-fill fs-5 text-warning"></i>
                    </div>
                    <div>
                        <h6 class="modal-title fw-bold mb-0 text-white" id="modalPermintaanDietLabel">
                            PERMINTAAN &amp; PEMBERIAN DIET PASIEN
                        </h6>
                        <small class="text-white-50" style="font-size: 11px;">Pengelolaan Jenis Diet &amp; Jadwal Pemberian Makanan Pasien Rawat Inap</small>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span id="badgeStatusPermintaanDiet" class="badge bg-light text-primary px-2 py-1 shadow-sm" style="font-size: 11px;">
                        <i class="bi bi-calendar-event me-1"></i> Hari Ini
                    </span>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>

            <!-- Modal Body -->
            <div class="modal-body p-3 bg-light">
                
                <!-- PATIENT INFO BANNER -->
                <div class="card border-0 shadow-sm rounded-3 mb-3" style="background: #ffffff;">
                    <div class="card-body p-2.5">
                        <div class="row g-2 align-items-center" style="font-size: 11.5px;">
                            <div class="col-md-3 col-6">
                                <label class="text-muted small mb-0 d-block" style="font-size: 10px;">NO. RAWAT</label>
                                <strong class="text-primary font-monospace" id="diet_info_no_rawat">-</strong>
                            </div>
                            <div class="col-md-2 col-6">
                                <label class="text-muted small mb-0 d-block" style="font-size: 10px;">NO. REKAM MEDIS</label>
                                <strong class="text-dark font-monospace" id="diet_info_no_rkm_medis">-</strong>
                            </div>
                            <div class="col-md-4 col-12">
                                <label class="text-muted small mb-0 d-block" style="font-size: 10px;">NAMA PASIEN</label>
                                <strong class="text-dark" id="diet_info_nm_pasien">-</strong>
                            </div>
                            <div class="col-md-3 col-12">
                                <label class="text-muted small mb-0 d-block" style="font-size: 10px;">KAMAR / BANGSAL</label>
                                <strong class="text-dark" id="diet_info_kamar">-</strong>
                            </div>
                        </div>
                    </div>
                </div>

                <form id="formPermintaanDiet" autocomplete="off">
                    @csrf
                    <input type="hidden" id="diet_no_rawat" name="no_rawat">
                    <input type="hidden" id="diet_kd_kamar" name="kd_kamar">

                    <!-- INPUT PERMINTAAN DIET CARD -->
                    <div class="card border-0 shadow-sm rounded-3 mb-3">
                        <div class="card-header bg-white py-2 px-3 fw-bold text-primary small d-flex justify-content-between align-items-center">
                            <span><i class="bi bi-pencil-square me-1"></i> Form Permintaan Diet</span>
                            <div class="d-flex align-items-center gap-1">
                                <label class="small text-muted mb-0 me-1" style="font-size: 11px;">Tanggal:</label>
                                <input type="date" class="form-control form-control-sm py-0.5 px-2" id="diet_tanggal" name="tanggal" value="{{ date('Y-m-d') }}" style="width: 140px; font-size: 12px;">
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <div class="row g-3">
                                
                                <!-- Jenis Diet -->
                                <div class="col-md-12">
                                    <label class="form-label fw-semibold small mb-1">Jenis Diet Pasien <span class="text-danger">*</span></label>
                                    <select class="form-select form-select-sm" id="diet_kd_diet" name="kd_diet" required>
                                        <option value="">-- Pilih Master Jenis Diet --</option>
                                    </select>
                                </div>

                                <!-- Waktu Pemberian Diet (Pagi, Siang, Sore) -->
                                <div class="col-md-12">
                                    <label class="form-label fw-semibold small mb-1">Status Pemberian Diet Per Waktu Makan :</label>
                                    <div class="p-2 bg-light rounded border">
                                        <div class="row g-2 text-center" style="font-size: 12px;">
                                            
                                            <!-- PAGI -->
                                            <div class="col-md-4 col-12 border-end border-sm-0">
                                                <div class="fw-bold text-primary mb-1"><i class="bi bi-brightness-high me-1"></i> PAGI (07:00)</div>
                                                <div class="btn-group btn-group-sm w-100" role="group">
                                                    <input type="radio" class="btn-check" name="pagi" id="pagi_ya" value="Ya" checked>
                                                    <label class="btn btn-outline-success py-1" for="pagi_ya">Ya</label>

                                                    <input type="radio" class="btn-check" name="pagi" id="pagi_puasa" value="Puasa">
                                                    <label class="btn btn-outline-warning py-1" for="pagi_puasa">Puasa</label>

                                                    <input type="radio" class="btn-check" name="pagi" id="pagi_pulang" value="Pulang">
                                                    <label class="btn btn-outline-info py-1" for="pagi_pulang">Pulang</label>

                                                    <input type="radio" class="btn-check" name="pagi" id="pagi_none" value="-">
                                                    <label class="btn btn-outline-secondary py-1" for="pagi_none">-</label>
                                                </div>
                                            </div>

                                            <!-- SIANG -->
                                            <div class="col-md-4 col-12 border-end border-sm-0">
                                                <div class="fw-bold text-danger mb-1"><i class="bi bi-sun me-1"></i> SIANG (12:00)</div>
                                                <div class="btn-group btn-group-sm w-100" role="group">
                                                    <input type="radio" class="btn-check" name="siang" id="siang_ya" value="Ya" checked>
                                                    <label class="btn btn-outline-success py-1" for="siang_ya">Ya</label>

                                                    <input type="radio" class="btn-check" name="siang" id="siang_puasa" value="Puasa">
                                                    <label class="btn btn-outline-warning py-1" for="siang_puasa">Puasa</label>

                                                    <input type="radio" class="btn-check" name="siang" id="siang_pulang" value="Pulang">
                                                    <label class="btn btn-outline-info py-1" for="siang_pulang">Pulang</label>

                                                    <input type="radio" class="btn-check" name="siang" id="siang_none" value="-">
                                                    <label class="btn btn-outline-secondary py-1" for="siang_none">-</label>
                                                </div>
                                            </div>

                                            <!-- SORE -->
                                            <div class="col-md-4 col-12">
                                                <div class="fw-bold text-indigo mb-1" style="color: #6f42c1;"><i class="bi bi-moon-stars me-1"></i> SORE (17:00)</div>
                                                <div class="btn-group btn-group-sm w-100" role="group">
                                                    <input type="radio" class="btn-check" name="sore" id="sore_ya" value="Ya" checked>
                                                    <label class="btn btn-outline-success py-1" for="sore_ya">Ya</label>

                                                    <input type="radio" class="btn-check" name="sore" id="sore_puasa" value="Puasa">
                                                    <label class="btn btn-outline-warning py-1" for="sore_puasa">Puasa</label>

                                                    <input type="radio" class="btn-check" name="sore" id="sore_pulang" value="Pulang">
                                                    <label class="btn btn-outline-info py-1" for="sore_pulang">Pulang</label>

                                                    <input type="radio" class="btn-check" name="sore" id="sore_none" value="-">
                                                    <label class="btn btn-outline-secondary py-1" for="sore_none">-</label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <!-- Catatan Khusus -->
                                <div class="col-md-12">
                                    <label class="form-label fw-semibold small mb-1">Catatan / Permintaan Khusus :</label>
                                    <textarea class="form-control form-control-sm" id="diet_permintaan_khusus" name="permintaan_khusus" rows="2" placeholder="Catatan tambahan (misal: Makanan cair/lembek, Alergi udang, Puasa jam 22:00, dll)..."></textarea>
                                </div>

                            </div>
                        </div>
                        <div class="card-footer bg-white py-2 px-3 d-flex justify-content-between align-items-center">
                            <button type="button" class="btn btn-outline-danger btn-sm d-none" id="btnHapusPermintaanDiet">
                                <i class="bi bi-trash me-1"></i> Hapus Diet Tanggal Ini
                            </button>
                            <div class="ms-auto d-flex gap-2">
                                <button type="button" class="btn btn-secondary btn-sm" id="btnResetPermintaanDiet">
                                    <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                                </button>
                                <button type="button" class="btn btn-primary btn-sm px-3" id="btnSimpanPermintaanDiet">
                                    <i class="bi bi-save me-1"></i> Simpan Permintaan Diet
                                </button>
                            </div>
                        </div>
                    </div>

                </form>

                <!-- TABEL RIWAYAT DIET PASIEN -->
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-header bg-white py-2 px-3 fw-bold text-dark small">
                        <i class="bi bi-clock-history me-1 text-primary"></i> Riwayat Pemberian Diet Pasien
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive" style="max-height: 220px; overflow-y: auto;">
                            <table class="table table-hover table-striped align-middle mb-0" id="tbRiwayatDietPasien" style="font-size: 11.5px;">
                                <thead class="table-light sticky-top">
                                    <tr>
                                        <th width="15%">Tanggal</th>
                                        <th width="25%">Jenis Diet</th>
                                        <th width="12%" class="text-center">Pagi</th>
                                        <th width="12%" class="text-center">Siang</th>
                                        <th width="12%" class="text-center">Sore</th>
                                        <th width="24%">Permintaan Khusus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="6" class="text-center py-3 text-muted">Memuat riwayat diet...</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Modal Footer -->
            <div class="modal-footer py-2 px-3 bg-white">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-1"></i> Tutup
                </button>
            </div>

        </div>
    </div>
</div>

@push('script')
<script>
    let masterDietLoaded = false;

    // Load Master Diet Select Options
    function loadMasterDietOptions(callback) {
        if (masterDietLoaded && $('#diet_kd_diet option').length > 1) {
            if (typeof callback === 'function') callback();
            return;
        }

        $.get('/erm/ranap/permintaan-diet/master').done(function(res) {
            if (res.success && res.data) {
                let options = '<option value="">-- Pilih Master Jenis Diet --</option>';
                res.data.forEach(function(item) {
                    options += `<option value="${item.kd_diet}">${item.nama_diet}</option>`;
                });
                $('#diet_kd_diet').html(options);
                masterDietLoaded = true;
            }
            if (typeof callback === 'function') callback();
        }).fail(function() {
            if (typeof callback === 'function') callback();
        });
    }

    // Open Modal Permintaan Diet
    function showModalPermintaanDiet(noRawat) {
        if (!noRawat) {
            Swal.fire('Peringatan', 'No. Rawat tidak valid.', 'warning');
            return;
        }

        $('#diet_no_rawat').val(noRawat);
        $('#diet_tanggal').val(moment().format('YYYY-MM-DD'));
        
        // Reset form & status
        resetFormPermintaanDiet();

        // Load data pasien & kamar
        getRegPeriksa(noRawat).done(function(res) {
            const pasien = res?.pasien || {};
            const kamarList = res?.kamar_inap || [];
            
            let kamarNama = '-';
            let kdKamar = '-';
            if (kamarList.length > 0) {
                const activeKamar = kamarList.find(k => k.stts_pulang === '-') || kamarList[0];
                kamarNama = activeKamar?.kamar?.bangsal?.nm_bangsal || activeKamar?.kd_kamar || '-';
                kdKamar = activeKamar?.kd_kamar || '-';
            }

            $('#diet_info_no_rawat').text(noRawat);
            $('#diet_info_no_rkm_medis').text(pasien.no_rkm_medis || '-');
            $('#diet_info_nm_pasien').text(`${pasien.nm_pasien || '-'} (${res.umurdaftar || 0} ${res.sttsumur || 'Th'})`);
            $('#diet_info_kamar').text(kamarNama);
            $('#diet_kd_kamar').val(kdKamar);

            // Load Master Diet & active data for today
            loadMasterDietOptions(function() {
                loadPermintaanDietByDate(noRawat, $('#diet_tanggal').val());
                loadRiwayatDietPasien(noRawat);
            });

            $('#modalPermintaanDiet').modal('show');
        });
    }

    // Change Tanggal Event
    $('#diet_tanggal').on('change', function() {
        const noRawat = $('#diet_no_rawat').val();
        const tanggal = $(this).val();
        if (noRawat && tanggal) {
            loadPermintaanDietByDate(noRawat, tanggal);
        }
    });

    // Load Data Permintaan Diet pada Tanggal Tertentu
    function loadPermintaanDietByDate(noRawat, tanggal) {
        $.get(`/erm/ranap/permintaan-diet?no_rawat=${encodeURIComponent(noRawat)}&tanggal=${encodeURIComponent(tanggal)}`).done(function(res) {
            if (res.success && res.data) {
                const p = res.data.permintaan;
                const kdDiet = res.data.kd_diet;

                if (kdDiet) {
                    $('#diet_kd_diet').val(kdDiet);
                } else {
                    $('#diet_kd_diet').val('');
                }

                if (p) {
                    $(`input[name="pagi"][value="${p.pagi || '-'}"]`).prop('checked', true);
                    $(`input[name="siang"][value="${p.siang || '-'}"]`).prop('checked', true);
                    $(`input[name="sore"][value="${p.sore || '-'}"]`).prop('checked', true);
                    $('#diet_permintaan_khusus').val(p.permintaan_khusus || '');
                    $('#btnHapusPermintaanDiet').removeClass('d-none');
                } else {
                    resetWaktuRadio();
                    $('#diet_permintaan_khusus').val('');
                    $('#btnHapusPermintaanDiet').addClass('d-none');
                }
            }
        });
    }

    // Reset Form Permintaan Diet
    function resetFormPermintaanDiet() {
        $('#diet_kd_diet').val('');
        resetWaktuRadio();
        $('#diet_permintaan_khusus').val('');
        $('#btnHapusPermintaanDiet').addClass('d-none');
    }

    function resetWaktuRadio() {
        $('#pagi_ya').prop('checked', true);
        $('#siang_ya').prop('checked', true);
        $('#sore_ya').prop('checked', true);
    }

    $('#btnResetPermintaanDiet').on('click', function() {
        resetFormPermintaanDiet();
    });

    // Load Riwayat Diet Pasien
    function loadRiwayatDietPasien(noRawat) {
        const tbody = $('#tbRiwayatDietPasien tbody');
        tbody.html('<tr><td colspan="6" class="text-center py-3 text-muted"><div class="spinner-border spinner-border-sm text-primary me-1"></div> Memuat riwayat diet...</td></tr>');

        $.get(`/erm/ranap/permintaan-diet/riwayat?no_rawat=${encodeURIComponent(noRawat)}`).done(function(res) {
            if (res.success && res.data && res.data.length > 0) {
                let html = '';
                res.data.forEach(function(row) {
                    const badgePagi = getBadgeWaktuStatus(row.pagi);
                    const badgeSiang = getBadgeWaktuStatus(row.siang);
                    const badgeSore = getBadgeWaktuStatus(row.sore);

                    html += `
                        <tr>
                            <td class="fw-bold text-primary font-monospace">${moment(row.tanggal).format('DD-MM-YYYY')}</td>
                            <td class="fw-semibold text-dark">${row.nama_diet || '-'}</td>
                            <td class="text-center">${badgePagi}</td>
                            <td class="text-center">${badgeSiang}</td>
                            <td class="text-center">${badgeSore}</td>
                            <td class="text-wrap">${row.permintaan_khusus || '-'}</td>
                        </tr>
                    `;
                });
                tbody.html(html);
            } else {
                tbody.html('<tr><td colspan="6" class="text-center py-3 text-muted">Belum ada riwayat permintaan diet.</td></tr>');
            }
        }).fail(function() {
            tbody.html('<tr><td colspan="6" class="text-center py-3 text-danger">Gagal memuat riwayat diet.</td></tr>');
        });
    }

    function getBadgeWaktuStatus(status) {
        if (status === 'Ya') return '<span class="badge bg-success px-2 py-0.5">Ya</span>';
        if (status === 'Puasa') return '<span class="badge bg-warning text-dark px-2 py-0.5">Puasa</span>';
        if (status === 'Pulang') return '<span class="badge bg-info px-2 py-0.5">Pulang</span>';
        return '<span class="badge bg-light text-muted px-2 py-0.5">-</span>';
    }

    // Submit Simpan Permintaan Diet
    $('#btnSimpanPermintaanDiet').on('click', function(e) {
        e.preventDefault();

        const noRawat = $('#diet_no_rawat').val();
        const tanggal = $('#diet_tanggal').val();
        const kdDiet = $('#diet_kd_diet').val();

        if (!noRawat || !tanggal) {
            Swal.fire('Peringatan', 'No. Rawat dan Tanggal wajib diisi.', 'warning');
            return;
        }

        const formData = $('#formPermintaanDiet').serialize();

        Swal.fire({
            title: 'Simpan Permintaan Diet?',
            text: 'Data permintaan diet pasien akan disimpan.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Simpan',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.post('/erm/ranap/permintaan-diet', formData).done(function(res) {
                    if (res.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: res.message,
                            timer: 1500,
                            showConfirmButton: false
                        });
                        $('#btnHapusPermintaanDiet').removeClass('d-none');
                        loadRiwayatDietPasien(noRawat);
                    } else {
                        Swal.fire('Gagal', res.message || 'Gagal menyimpan data.', 'error');
                    }
                }).fail(function(xhr) {
                    const msg = xhr.responseJSON?.message || 'Terjadi kesalahan sistem.';
                    Swal.fire('Error', msg, 'error');
                });
            }
        });
    });

    // Submit Hapus Permintaan Diet
    $('#btnHapusPermintaanDiet').on('click', function(e) {
        e.preventDefault();

        const noRawat = $('#diet_no_rawat').val();
        const tanggal = $('#diet_tanggal').val();

        if (!noRawat || !tanggal) return;

        Swal.fire({
            title: 'Hapus Permintaan Diet?',
            text: `Data diet tanggal ${moment(tanggal).format('DD-MM-YYYY')} akan dihapus.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/erm/ranap/permintaan-diet',
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}',
                        no_rawat: noRawat,
                        tanggal: tanggal
                    },
                    success: function(res) {
                        if (res.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Terhapus',
                                text: res.message,
                                timer: 1500,
                                showConfirmButton: false
                            });
                            resetFormPermintaanDiet();
                            loadRiwayatDietPasien(noRawat);
                        } else {
                            Swal.fire('Gagal', res.message || 'Gagal menghapus data.', 'error');
                        }
                    },
                    error: function(xhr) {
                        const msg = xhr.responseJSON?.message || 'Terjadi kesalahan sistem.';
                        Swal.fire('Error', msg, 'error');
                    }
                });
            }
        });
    });
</script>
@endpush
