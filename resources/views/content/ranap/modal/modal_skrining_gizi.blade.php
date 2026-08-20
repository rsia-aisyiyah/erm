<!-- Modal Form Skrining Gizi Pasien -->
<div class="modal fade" id="modalSkriningGizi" tabindex="-1" aria-labelledby="modalSkriningGiziLabel" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content border-0 shadow">
            
            <!-- Modal Header Green -->
            <div class="modal-header text-white py-2 px-3 justify-content-between align-items-center" style="background: #198754;">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-clipboard2-check-fill fs-5"></i>
                    <h6 class="modal-title fw-bold mb-0 text-white" id="modalSkriningGiziLabel">
                        Skrining Gizi
                    </h6>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body p-3 bg-light">
                
                <!-- PATIENT BANNER CARD -->
                <div class="card border-0 shadow-sm rounded-3 mb-3" style="background: #ffffff;">
                    <div class="card-body p-3 d-flex align-items-center gap-3">
                        <div class="rounded-circle bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center" style="width: 42px; height: 42px; min-width: 42px;">
                            <i class="bi bi-person-fill fs-4"></i>
                        </div>
                        <div>
                            <strong class="d-block text-dark fs-6" id="skrining_info_nm_pasien">NAMA PASIEN</strong>
                            <small class="text-muted font-monospace" id="skrining_info_no_rawat">0000/00/00/000000</small>
                        </div>
                    </div>
                </div>

                <form id="formSkriningGizi" autocomplete="off">
                    @csrf
                    <input type="hidden" id="skrining_no_rawat" name="no_rawat">

                    <div class="row g-3">
                        
                        <!-- LEFT PANEL: Kategori (OBGYN / ANAK) -->
                        <div class="col-md-3">
                            <label class="form-label fw-bold text-success mb-2" style="font-size: 13px;">Kategori</label>
                            <div class="d-flex flex-column gap-2">
                                <label class="card border p-2 text-center rounded-3 cursor-pointer mb-0 kategori-card" id="cardKategoriObgyn">
                                    <input type="radio" name="kategori" id="kat_obgyn" value="OBGYN" class="d-none">
                                    <i class="bi bi-person-heart fs-3 text-secondary d-block mb-1"></i>
                                    <span class="fw-bold small text-dark">OBGYN</span>
                                </label>

                                <label class="card border p-2 text-center rounded-3 cursor-pointer mb-0 kategori-card active" id="cardKategoriAnak">
                                    <input type="radio" name="kategori" id="kat_anak" value="ANAK" class="d-none" checked>
                                    <i class="bi bi-person-standing fs-3 text-success d-block mb-1"></i>
                                    <span class="fw-bold small text-dark">ANAK</span>
                                </label>
                            </div>
                        </div>

                        <!-- RIGHT PANEL: Form Inputs -->
                        <div class="col-md-9">
                            
                            <!-- DATA ANTROPOMETRI -->
                            <div class="mb-3">
                                <h6 class="fw-bold text-success small border-bottom pb-1 mb-2">Data Antropometri</h6>
                                <div class="row g-2">
                                    
                                    <div class="col-md-4">
                                        <label class="form-label small mb-1">Berat Badan (Kg) <span class="text-danger">*</span></label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text bg-white"><i class="bi bi-speedometer2 text-muted"></i></span>
                                            <input type="number" step="0.1" class="form-control" id="skrining_bb" name="bb" required placeholder="0">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label small mb-1">Tinggi Badan (cm) <span class="text-danger">*</span></label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text bg-white"><i class="bi bi-ruler text-muted"></i></span>
                                            <input type="number" step="0.1" class="form-control" id="skrining_tb" name="tb" required placeholder="0">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label small mb-1">IMT</label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text bg-light"><i class="bi bi-calculator text-muted"></i></span>
                                            <input type="text" class="form-control bg-light" id="skrining_imt" name="imt" readonly placeholder="0">
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!-- DIAGNOSA MEDIS -->
                            <div class="mb-3">
                                <h6 class="fw-bold text-success small mb-1">Diagnosa Medis <span class="text-danger">*</span></h6>
                                <textarea class="form-control form-control-sm" id="skrining_diagnosa_medis" name="diagnosa_medis" rows="2" placeholder="Masukkan diagnosa medis pasien..." required></textarea>
                            </div>

                            <!-- HASIL PEMERIKSAAN PENUNJANG -->
                            <div class="mb-3">
                                <h6 class="fw-bold text-success small border-bottom pb-1 mb-2">Hasil Pemeriksaan Penunjang</h6>
                                <div class="row g-2">
                                    
                                    <div class="col-md-3 col-6">
                                        <label class="form-label small mb-1">HB</label>
                                        <div class="input-group input-group-sm">
                                            <input type="number" step="0.1" class="form-control" id="skrining_hb" name="hb" placeholder="0">
                                            <span class="input-group-text bg-light" style="font-size: 11px;">g/dL</span>
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-6">
                                        <label class="form-label small mb-1">HIV</label>
                                        <select class="form-select form-select-sm" id="skrining_hiv" name="hiv">
                                            <option value="Tidak Periksa">Tidak Periksa</option>
                                            <option value="Non Reaktif">Non Reaktif</option>
                                            <option value="Reaktif">Reaktif</option>
                                        </select>
                                    </div>

                                    <div class="col-md-3 col-6">
                                        <label class="form-label small mb-1">HBsAg</label>
                                        <select class="form-select form-select-sm" id="skrining_hbsag" name="hbsag">
                                            <option value="Tidak Periksa">Tidak Periksa</option>
                                            <option value="Non Reaktif">Non Reaktif</option>
                                            <option value="Reaktif">Reaktif</option>
                                        </select>
                                    </div>

                                    <div class="col-md-3 col-6">
                                        <label class="form-label small mb-1">Syphilis</label>
                                        <select class="form-select form-select-sm" id="skrining_syphilis" name="syphilis">
                                            <option value="Tidak Periksa">Tidak Periksa</option>
                                            <option value="Non Reaktif">Non Reaktif</option>
                                            <option value="Reaktif">Reaktif</option>
                                        </select>
                                    </div>

                                </div>
                            </div>

                            <!-- PERTANYAAN SKRINING DINAMIS (ANAK / OBGYN) -->
                            <div class="mb-3 p-3 bg-white border rounded-3 shadow-sm">
                                <h6 class="fw-bold text-dark small mb-2.5 border-bottom pb-1" id="titlePertanyaanSkrining">Pertanyaan Skrining Nutrisi</h6>
                                
                                <div id="panelPertanyaanAnak" class="px-1">
                                    <div class="row g-2 align-items-center mb-2" style="font-size: 12px;">
                                        <div class="col-md-8">a. Apakah pasien tampak kurus?</div>
                                        <div class="col-md-4">
                                            <select class="form-select form-select-sm q-anak-select" id="q_anak_1">
                                                <option value="0">Tidak (0)</option>
                                                <option value="1">Ya (1)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row g-2 align-items-center" style="font-size: 12px;">
                                        <div class="col-md-8">b. Apakah terdapat penurunan berat badan sebulan terakhir?</div>
                                        <div class="col-md-4">
                                            <select class="form-select form-select-sm q-anak-select" id="q_anak_2">
                                                <option value="0">Tidak (0)</option>
                                                <option value="1">Ya (1)</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div id="panelPertanyaanObgyn" class="d-none px-1">
                                    <div class="row g-2 align-items-center mb-2" style="font-size: 12px;">
                                        <div class="col-md-8">a. Penurunan BB tidak diinginkan selama 6 bulan terakhir?</div>
                                        <div class="col-md-4">
                                            <select class="form-select form-select-sm q-obgyn-select" id="q_obgyn_1">
                                                <option value="0">Tidak (0)</option>
                                                <option value="1">Ya (1)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row g-2 align-items-center" style="font-size: 12px;">
                                        <div class="col-md-8">b. Asupan makan berkurang karena tidak nafsu makan?</div>
                                        <div class="col-md-4">
                                            <select class="form-select form-select-sm q-obgyn-select" id="q_obgyn_2">
                                                <option value="0">Tidak (0)</option>
                                                <option value="1">Ya (1)</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="skor" id="skrining_skor_val" value="0">
                                <input type="hidden" name="q_anak" id="skrining_q_anak" value="">
                                <input type="hidden" name="q_obgyn" id="skrining_q_obgyn" value="">
                            </div>

                            <!-- GREEN SKOR CARD -->
                            <div class="card border-0 rounded-3 p-3" style="background: #e8f5e9; border: 1px solid #c8e6c9 !important;">
                                <div class="row align-items-center">
                                    <div class="col-md-4 text-center border-end border-success border-opacity-25">
                                        <small class="fw-bold text-success d-block mb-0" style="font-size: 11px;">Skor Skrining</small>
                                        <span class="display-5 fw-bold text-success" id="skrining_skor_display">0</span>
                                        <small class="d-block text-muted" id="skrining_keterangan_display">Resiko Rendah</small>
                                    </div>
                                    <div class="col-md-8 ps-md-3">
                                        <div class="mb-2">
                                            <label class="form-label fw-bold text-dark small mb-1">Status Assesment Lanjut</label>
                                            <select class="form-select form-select-sm" id="skrining_status_assesment_lanjut" name="status_assesment_lanjut">
                                                <option value="Belum">Belum</option>
                                                <option value="Sudah">Sudah</option>
                                                <option value="Tidak">Tidak</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label class="form-label fw-bold text-dark small mb-1">Keterangan</label>
                                            <input type="text" class="form-control form-control-sm" id="skrining_keterangan" name="keterangan" placeholder="Keterangan tambahan...">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </form>

            </div>

            <!-- Modal Footer -->
            <div class="modal-footer py-2 px-3 bg-white">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-1"></i> Batal
                </button>
                <button type="button" class="btn btn-success btn-sm px-3 fw-semibold" id="btnSimpanSkriningGizi">
                    <i class="bi bi-check-lg me-1"></i> Simpan Skrining Gizi
                </button>
            </div>

        </div>
    </div>
</div>

@push('script')
<script>
    let skriningOpenedFromDiet = false;

    // Open Modal Skrining Gizi
    function showModalSkriningGizi(noRawat, fromDiet = false) {
        if (!noRawat) return;

        skriningOpenedFromDiet = fromDiet;
        $('#skrining_no_rawat').val(noRawat);
        $('#formSkriningGizi')[0].reset();
        
        getRegPeriksa(noRawat).done(function(res) {
            const pasien = res?.pasien || {};
            $('#skrining_info_nm_pasien').text(pasien.nm_pasien || '-');
            $('#skrining_info_no_rawat').text(noRawat);

            // Load Existing Skrining Gizi Data
            $.get(`/erm/ranap/skrining-gizi?no_rawat=${encodeURIComponent(noRawat)}`).done(function(resp) {
                if (resp.success && resp.data) {
                    const d = resp.data;
                    $('#skrining_bb').val(d.bb || '');
                    $('#skrining_tb').val(d.tb || '');
                    $('#skrining_imt').val(d.imt || '');
                    $('#skrining_diagnosa_medis').val(d.diagnosa_medis || '');
                    $('#skrining_hb').val(d.hb || '');
                    $('#skrining_hiv').val(d.hiv || 'Tidak Periksa');
                    $('#skrining_hbsag').val(d.hbsag || 'Tidak Periksa');
                    $('#skrining_syphilis').val(d.syphilis || 'Tidak Periksa');
                    $('#skrining_status_assesment_lanjut').val(d.status_assesment_lanjut || 'Belum');
                    $('#skrining_keterangan').val(d.keterangan || '');

                    const kat = d.kategori || 'ANAK';
                    $(`input[name="kategori"][value="${kat}"]`).prop('checked', true).trigger('change');
                } else {
                    $(`input[name="kategori"][value="ANAK"]`).prop('checked', true).trigger('change');
                }

                hitungImtDanSkorSkrining();
                $('#modalSkriningGizi').modal('show');
            });
        });
    }

    // Toggle Kategori (ANAK / OBGYN)
    $('input[name="kategori"]').on('change', function() {
        const val = $(this).val();
        if (val === 'OBGYN') {
            $('#cardKategoriObgyn').addClass('border-success active').find('i').removeClass('text-secondary').addClass('text-success');
            $('#cardKategoriAnak').removeClass('border-success active').find('i').removeClass('text-success').addClass('text-secondary');
            $('#panelPertanyaanAnak').addClass('d-none');
            $('#panelPertanyaanObgyn').removeClass('d-none');
        } else {
            $('#cardKategoriAnak').addClass('border-success active').find('i').removeClass('text-secondary').addClass('text-success');
            $('#cardKategoriObgyn').removeClass('border-success active').find('i').removeClass('text-success').addClass('text-secondary');
            $('#panelPertanyaanObgyn').addClass('d-none');
            $('#panelPertanyaanAnak').removeClass('d-none');
        }
        hitungImtDanSkorSkrining();
    });

    // Auto Calculate IMT & Skor
    $('#skrining_bb, #skrining_tb, .q-anak-select, .q-obgyn-select').on('input change', function() {
        hitungImtDanSkorSkrining();
    });

    function hitungImtDanSkorSkrining() {
        const bb = parseFloat($('#skrining_bb').val()) || 0;
        const tb = parseFloat($('#skrining_tb').val()) || 0;
        
        let imt = 0;
        if (bb > 0 && tb > 0) {
            const tbM = tb / 100;
            imt = (bb / (tbM * tbM)).toFixed(2);
        }
        $('#skrining_imt').val(imt);

        const kat = $('input[name="kategori"]:checked').val();
        let skor = 0;

        if (kat === 'OBGYN') {
            const q1 = parseInt($('#q_obgyn_1').val()) || 0;
            const q2 = parseInt($('#q_obgyn_2').val()) || 0;
            skor = q1 + q2;
            $('#skrining_q_obgyn').val(`${q1},${q2}`);
        } else {
            const q1 = parseInt($('#q_anak_1').val()) || 0;
            const q2 = parseInt($('#q_anak_2').val()) || 0;
            skor = q1 + q2;
            $('#skrining_q_anak').val(`${q1},${q2}`);
        }

        $('#skrining_skor_val').val(skor);
        $('#skrining_skor_display').text(skor);

        let ket = 'Resiko Rendah';
        if (skor >= 4) ket = 'Resiko Tinggi';
        else if (skor >= 2) ket = 'Resiko Sedang';
        
        $('#skrining_keterangan_display').text(ket);
        if (!$('#skrining_keterangan').val() || $('#skrining_keterangan').val() === 'Resiko Rendah' || $('#skrining_keterangan').val() === 'Resiko Sedang' || $('#skrining_keterangan').val() === 'Resiko Tinggi') {
            $('#skrining_keterangan').val(ket);
        }
    }

    // Submit Simpan Skrining Gizi
    $('#btnSimpanSkriningGizi').on('click', function(e) {
        e.preventDefault();

        const noRawat = $('#skrining_no_rawat').val();
        const bb = $('#skrining_bb').val();
        const tb = $('#skrining_tb').val();
        const diagnosa = $('#skrining_diagnosa_medis').val();

        if (!noRawat || !bb || !tb || !diagnosa) {
            Swal.fire('Peringatan', 'Berat Badan, Tinggi Badan, dan Diagnosa Medis wajib diisi.', 'warning');
            return;
        }

        const formData = $('#formSkriningGizi').serialize();

        $.post('/erm/ranap/skrining-gizi', formData).done(function(res) {
            if (res.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: res.message,
                    timer: 1500,
                    showConfirmButton: false
                });
                $('#modalSkriningGizi').modal('hide');

                if (skriningOpenedFromDiet) {
                    setTimeout(function() {
                        showModalPermintaanDiet(noRawat);
                    }, 350);
                }
            } else {
                Swal.fire('Gagal', res.message || 'Gagal menyimpan data.', 'error');
            }
        }).fail(function(xhr) {
            const msg = xhr.responseJSON?.message || 'Terjadi kesalahan sistem.';
            Swal.fire('Error', msg, 'error');
        });
    });
</script>
@endpush
