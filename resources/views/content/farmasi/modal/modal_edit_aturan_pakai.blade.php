<!-- Modal Ubah Rincian Obat (Jumlah, Aturan Pakai & Jadwal Jam) -->
<div class="modal fade" id="modalEditAturanPakaiPermintaan" tabindex="-1" aria-labelledby="modalEditAturanPakaiLabel" aria-hidden="true" style="z-index: 1085;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">

            <div class="modal-header bg-primary text-white py-2 px-3">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-pencil-square fs-5"></i>
                    <div>
                        <h6 class="modal-title fw-bold mb-0 text-white" id="modalEditAturanPakaiLabel">
                            UBAH RINCIAN OBAT (JUMLAH &amp; ATURAN PAKAI)
                        </h6>
                        <small class="text-white-50" style="font-size: 11px;">Sesuaikan jumlah, aturan pakai, dan jam pemberian sebelum validasi</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-3 bg-light">
                <form id="formEditAturanPakaiPermintaan" onsubmit="event.preventDefault(); $('#btnSimpanEditAturanPakai').click();">
                    <input type="hidden" id="edit_aturan_no_permintaan">
                    <input type="hidden" id="edit_aturan_kode_brng">

                    <!-- Kartu Informasi Obat -->
                    <div class="card border-0 shadow-sm rounded-3 mb-3 bg-white border-start border-primary border-4">
                        <div class="card-body p-2.5">
                            <label class="text-primary small fw-bold mb-1" style="font-size: 10.5px;">ITEM OBAT / BHP:</label>
                            <h6 class="fw-bold text-dark mb-1" id="lblEditAturanNamaObat">-</h6>
                            <div class="d-flex justify-content-between text-muted" style="font-size: 11px;">
                                <span>Kode: <b id="lblEditAturanKodeObat" class="font-monospace">-</b></span>
                                <span>Satuan: <b id="lblEditAturanSatuanObat" class="text-primary">-</b></span>
                            </div>
                        </div>
                    </div>

                    <!-- Input Jumlah & Aturan Pakai -->
                    <div class="card border-0 shadow-sm rounded-3 p-3 bg-white mb-3">
                        <div class="row g-2">
                            <div class="col-md-4 col-12">
                                <label class="form-label small fw-bold mb-1 text-dark">
                                    <i class="bi bi-box-seam text-primary me-1"></i> Jumlah:
                                </label>
                                <div class="input-group">
                                    <input type="number" class="form-control form-control-sm text-center fw-bold" id="edit_aturan_jml_val" min="0.1" step="any" required>
                                    <span class="input-group-text bg-light text-muted" id="lblEditAturanSatuanText" style="font-size: 11px;">Satuan</span>
                                </div>
                            </div>
                            <div class="col-md-8 col-12">
                                <label class="form-label small fw-bold mb-1 text-dark">
                                    <i class="bi bi-card-text text-primary me-1"></i> Aturan Pakai / Dosis:
                                </label>
                                <input type="text" class="form-control form-control-sm" id="edit_aturan_pakai_val" placeholder="Contoh: 3 x 1 tablet sesudah makan" list="listEditAturanPakaiPreset" autocomplete="off" required>
                                <datalist id="listEditAturanPakaiPreset">
                                    <option value="1 x 1 Tablet Pagi (07:00)">
                                    <option value="1 x 1 Tablet Malam (19:00)">
                                    <option value="2 x 1 Tablet (07:00, 19:00)">
                                    <option value="3 x 1 Tablet (07:00, 13:00, 19:00)">
                                    <option value="4 x 1 Tablet (07:00, 13:00, 19:00, 01:00)">
                                    <option value="1 x 1 Ampul IV (07:00)">
                                    <option value="2 x 1 Ampul IV (07:00, 19:00)">
                                    <option value="3 x 1 Ampul IV (07:00, 13:00, 19:00)">
                                    <option value="3 x 1 Sendok Teh (5 ml)">
                                    <option value="1 x 1 Tetes Mata Kanan/Kiri">
                                    <option value="K/P (Bila Perlu / Mual / Demam / Nyeri)">
                                </datalist>
                            </div>
                        </div>
                    </div>

                    <!-- Jadwal Jam 24 Jam Checklist -->
                    <div class="card border-0 shadow-sm rounded-3 p-3 bg-white">
                        <div class="d-flex justify-content-between align-items-center mb-2 flex-wrap gap-1">
                            <label class="form-label small fw-bold mb-0 text-dark">
                                <i class="bi bi-clock me-1 text-primary"></i> Jadwal Jam Pemberian (Centang Jam):
                            </label>
                            <div class="btn-group btn-group-sm flex-wrap" role="group" aria-label="Preset Jadwal Jam">
                                <button type="button" class="btn btn-outline-secondary btn-sm py-0" onclick="setEditPresetJam('1x_pagi')">1x (07)</button>
                                <button type="button" class="btn btn-outline-secondary btn-sm py-0" onclick="setEditPresetJam('1x_malam')">1x (19)</button>
                                <button type="button" class="btn btn-outline-secondary btn-sm py-0" onclick="setEditPresetJam('2x')">2x (07, 19)</button>
                                <button type="button" class="btn btn-outline-secondary btn-sm py-0" onclick="setEditPresetJam('3x')">3x (07, 13, 19)</button>
                                <button type="button" class="btn btn-outline-secondary btn-sm py-0" onclick="setEditPresetJam('4x')">4x (07, 13, 19, 01)</button>
                                <button type="button" class="btn btn-outline-secondary btn-sm py-0" onclick="setEditPresetJam('8h')">Tiap 8 Jam (06, 14, 22)</button>
                                <button type="button" class="btn btn-outline-danger btn-sm py-0" onclick="setEditPresetJam('clear')">Reset Jam</button>
                            </div>
                        </div>

                        <!-- Grid 24 Jam Checklist -->
                        <div class="row row-cols-6 row-cols-md-12 g-1 text-center" id="containerEditCheckJam">
                            @for ($h = 0; $h <= 23; $h++)
                                @php $jamStr = sprintf('%02d', $h); @endphp
                                <div class="col">
                                    <input type="checkbox" class="btn-check chk-jam-edit" id="edit_chk_jam{{ $jamStr }}" value="jam{{ $jamStr }}" autocomplete="off">
                                    <label class="btn btn-outline-success btn-sm w-100 py-1 px-0" for="edit_chk_jam{{ $jamStr }}" style="font-size: 11px;">
                                        {{ $jamStr }}:00
                                    </label>
                                </div>
                            @endfor
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer py-1.5 px-3 bg-white d-flex justify-content-between">
                <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary btn-sm px-4 shadow text-white fw-bold" id="btnSimpanEditAturanPakai">
                    <i class="bi bi-check-lg me-1"></i> Simpan Perubahan
                </button>
            </div>

        </div>
    </div>
</div>

@push('script')
    <script>
        function setEditPresetJam(mode) {
            $('.chk-jam-edit').prop('checked', false);

            if (mode === '1x_pagi') {
                $('#edit_chk_jam07').prop('checked', true);
            } else if (mode === '1x_malam') {
                $('#edit_chk_jam19').prop('checked', true);
            } else if (mode === '2x') {
                $('#edit_chk_jam07, #edit_chk_jam19').prop('checked', true);
            } else if (mode === '3x') {
                $('#edit_chk_jam07, #edit_chk_jam13, #edit_chk_jam19').prop('checked', true);
            } else if (mode === '4x') {
                $('#edit_chk_jam07, #edit_chk_jam13, #edit_chk_jam19, #edit_chk_jam01').prop('checked', true);
            } else if (mode === '8h') {
                $('#edit_chk_jam06, #edit_chk_jam14, #edit_chk_jam22').prop('checked', true);
            }
        }

        // Modal Edit Lengkap (Jumlah + Aturan Pakai + Jam)
        function triggerEditAturanPakai(noPermintaan, kodeBrng) {
            const itemKey = `${noPermintaan}_${kodeBrng}`;
            const det = (window.activePermintaanItems && window.activePermintaanItems[itemKey]) ? window.activePermintaanItems[itemKey] : null;

            const namaBrng = det?.data_barang?.nama_brng || det?.nama_brng || kodeBrng;
            const sat = det?.data_barang?.kode_satuan?.satuan || det?.data_barang?.kode_sat || det?.satuan || '-';
            const aturanPakai = det?.aturan_pakai || '';
            const jml = det?.jml || 1;

            $('#edit_aturan_no_permintaan').val(noPermintaan);
            $('#edit_aturan_kode_brng').val(kodeBrng);
            $('#lblEditAturanNamaObat').text(namaBrng);
            $('#lblEditAturanKodeObat').text(kodeBrng);
            $('#lblEditAturanSatuanObat').text(sat);
            $('#lblEditAturanSatuanText').text(sat);
            $('#edit_aturan_jml_val').val(jml);
            $('#edit_aturan_pakai_val').val(aturanPakai);

            $('.chk-jam-edit').prop('checked', false);
            if (det) {
                for (let h = 0; h <= 23; h++) {
                    const k = `jam${String(h).padStart(2, '0')}`;
                    if (det[k] === 'true' || det[k] === true || det[k] === '1' || det[k] === 1) {
                        $(`#edit_chk_${k}`).prop('checked', true);
                    }
                }
            }

            $('#modalEditAturanPakaiPermintaan').modal('show');
            setTimeout(() => {
                $('#edit_aturan_jml_val').focus().select();
            }, 300);
        }

        // Quick Adjust Jumlah Obat via Prompt
        function quickEditJumlah(noPermintaan, kodeBrng, currentJml, namaObat) {
            Swal.fire({
                title: 'Sesuaikan Jumlah Obat',
                html: `
                <div class="text-start mb-2" style="font-size: 13px;">
                    <span class="text-muted d-block">Nama Obat:</span>
                    <strong class="text-primary">${namaObat}</strong>
                </div>
            `,
                input: 'number',
                inputValue: currentJml,
                inputAttributes: {
                    min: '0.1',
                    step: 'any',
                    autofocus: 'autofocus'
                },
                showCancelButton: true,
                confirmButtonText: '<i class="bi bi-check-lg me-1"></i> Simpan',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#0d6efd',
                inputValidator: (val) => {
                    if (!val || parseFloat(val) <= 0) {
                        return 'Jumlah obat harus lebih besar dari 0!';
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('farmasi.permintaan-ranap.ubah-aturan-pakai') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            no_permintaan: noPermintaan,
                            kode_brng: kodeBrng,
                            jml: parseFloat(result.value)
                        },
                        beforeSend: function() {
                            Swal.fire({
                                title: 'Menyimpan Jumlah...',
                                allowOutsideClick: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                }
                            });
                        },
                        success: function(resp) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: resp.message || 'Jumlah obat berhasil diperbarui.',
                                timer: 1000,
                                showConfirmButton: false
                            });
                            if (typeof bukaDetailRanapFarmasi === 'function') {
                                bukaDetailRanapFarmasi(noPermintaan);
                            }
                            if (typeof showDetailPermintaanObat === 'function') {
                                showDetailPermintaanObat(noPermintaan);
                            }
                        },
                        error: function(xhr) {
                            Swal.fire('Gagal!', xhr.responseJSON?.message || 'Gagal mengubah jumlah obat.', 'error');
                        }
                    });
                }
            });
        }

        // Simpan dari Modal Lengkap
        $('#btnSimpanEditAturanPakai').off('click').on('click', function() {
            const noPermintaan = $('#edit_aturan_no_permintaan').val();
            const kodeBrng = $('#edit_aturan_kode_brng').val();
            const jml = $('#edit_aturan_jml_val').val();
            const aturanPakai = $('#edit_aturan_pakai_val').val().trim();

            if (!jml || parseFloat(jml) <= 0) {
                Swal.fire('Peringatan', 'Jumlah obat harus lebih besar dari 0.', 'warning');
                return;
            }

            if (!aturanPakai) {
                Swal.fire('Peringatan', 'Aturan pakai tidak boleh kosong.', 'warning');
                return;
            }

            const dataPost = {
                _token: "{{ csrf_token() }}",
                no_permintaan: noPermintaan,
                kode_brng: kodeBrng,
                jml: parseFloat(jml),
                aturan_pakai: aturanPakai
            };

            for (let h = 0; h <= 23; h++) {
                const key = `jam${String(h).padStart(2, '0')}`;
                dataPost[key] = $(`#edit_chk_${key}`).is(':checked') ? 'true' : 'false';
            }

            $.ajax({
                url: "{{ route('farmasi.permintaan-ranap.ubah-aturan-pakai') }}",
                type: "POST",
                data: dataPost,
                beforeSend: function() {
                    Swal.fire({
                        title: 'Menyimpan Perubahan...',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                },
                success: function(resp) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: resp.message || 'Rincian obat berhasil diperbarui.',
                        timer: 1200,
                        showConfirmButton: false
                    });

                    $('#modalEditAturanPakaiPermintaan').modal('hide');

                    if (typeof bukaDetailRanapFarmasi === 'function') {
                        bukaDetailRanapFarmasi(noPermintaan);
                    }
                    if (typeof showDetailPermintaanObat === 'function') {
                        showDetailPermintaanObat(noPermintaan);
                    }
                    if (typeof loadPermintaanRanapFarmasi === 'function') {
                        loadPermintaanRanapFarmasi();
                    }
                    if (typeof loadPermintaanObatPasien === 'function') {
                        loadPermintaanObatPasien();
                    }
                },
                error: function(xhr) {
                    const msg = xhr.responseJSON?.message || 'Gagal memperbarui rincian obat.';
                    Swal.fire('Gagal!', msg, 'error');
                }
            });
        });
    </script>
@endpush
