<!-- Modal Substitusi / Pergantian Obat Farmasi -->
<div class="modal fade" id="modalSubstitusiObat" tabindex="-1" aria-labelledby="modalSubstitusiObatLabel" aria-hidden="true" style="z-index: 1080;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            
            <div class="modal-header bg-warning text-dark py-2 px-3">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-arrow-left-right fs-5"></i>
                    <div>
                        <h6 class="modal-title fw-bold mb-0" id="modalSubstitusiObatLabel">
                            SUBSTITUSI / PERGANTIAN OBAT
                        </h6>
                        <small class="text-muted" style="font-size: 11px;">Ganti Obat yang Kosong dengan Obat Pengganti / Merek Setara</small>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-3 bg-light">
                <form id="formSubstitusiObat">
                    <input type="hidden" id="substitusi_no_permintaan" name="no_permintaan">
                    <input type="hidden" id="substitusi_no_rawat" name="no_rawat">
                    <input type="hidden" id="substitusi_kode_brng_lama" name="kode_brng_lama">
                    <input type="hidden" id="substitusi_kd_dokter" name="kd_dokter">
                    <input type="hidden" id="substitusi_nama_dokter" name="nama_dokter">

                    <!-- Kartu Obat Asal -->
                    <div class="card border-0 shadow-sm rounded-3 mb-2.5 bg-white border-start border-danger border-4">
                        <div class="card-body p-2.5">
                            <label class="text-danger small fw-bold mb-1" style="font-size: 10.5px;">OBAT ASAL (YANG AKAN DIGANTI):</label>
                            <h6 class="fw-bold text-dark mb-1" id="lblSubstitusiNamaLama">-</h6>
                            <div class="d-flex justify-content-between text-muted" style="font-size: 11px;">
                                <span>Kode: <b id="lblSubstitusiKodeLama" class="font-monospace">-</b></span>
                                <span>Jumlah Awal: <b id="lblSubstitusiJmlLama">0</b></span>
                            </div>
                        </div>
                    </div>

                    <!-- Kartu Verifikasi & Consent Dokter Register -->
                    <div class="card border-0 shadow-sm rounded-3 mb-2.5 bg-white border-start border-primary border-4">
                        <div class="card-body p-2.5">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <i class="bi bi-person-badge-fill text-primary fs-5"></i>
                                <div>
                                    <small class="text-muted text-uppercase fw-bold" style="font-size: 10px;">Dokter Register / Penanggung Jawab Pasien:</small>
                                    <h6 class="fw-bold text-dark mb-0" id="lblSubstitusiNamaDokter">-</h6>
                                </div>
                            </div>
                            <div class="form-check p-2 bg-light rounded-2 border">
                                <input class="form-check-input ms-0 me-2" type="checkbox" id="chkSubstitusiKonfirmasiDokter" style="cursor: pointer; width: 1.15em; height: 1.15em;">
                                <label class="form-check-label small fw-bold text-dark" for="chkSubstitusiKonfirmasiDokter" style="cursor: pointer; font-size: 11.5px; line-height: 1.4;">
                                    Sudah dilakukan konfirmasi penggantian obat kepada Dokter (sesuai dokter register: <span id="lblSubstitusiNamaDokterConsent" class="text-primary">-</span>)
                                </label>
                            </div>
                            <div class="mt-2">
                                <label class="form-label text-muted mb-1" style="font-size: 10.5px;">Catatan Konfirmasi (Opsional):</label>
                                <input type="text" class="form-control form-control-sm" id="substitusi_catatan_konfirmasi" placeholder="Contoh: Disetujui ganti sediaan / merek setara" style="font-size: 11px;">
                            </div>
                        </div>
                    </div>

                    <!-- Input Obat Pengganti -->
                    <div class="card border-0 shadow-sm rounded-3 p-3 bg-white">
                        <label class="form-label small fw-bold mb-1">Cari Obat Pengganti (Depo / Gudang)</label>
                        <div class="input-group input-group-sm mb-1 position-relative">
                            <input type="text" class="form-control" id="substitusi_cari_obat_baru" placeholder="Ketik nama obat pengganti..." autocomplete="off">
                            <button class="btn btn-outline-secondary" type="button" id="btnCariObatSubstitusi">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                        <div id="substitusi_dropdown_obat" class="list-group position-absolute shadow-sm d-none" style="z-index: 1090; max-height: 200px; overflow-y: auto; width: 380px; margin-top: 55px;"></div>
                        <input type="hidden" id="substitusi_kode_brng_baru" name="kode_brng_baru">

                        <div class="d-flex justify-content-between mb-2 text-muted" style="font-size: 11px;">
                            <span>Dipilih: <b id="lblSubstitusiObatTerpilih" class="text-success">-</b></span>
                            <span>Stok Depo: <b id="lblSubstitusiStokDepo">0</b></span>
                        </div>

                        <div class="row g-2 mb-2">
                            <div class="col-4">
                                <label class="form-label small fw-bold mb-1">Jumlah</label>
                                <input type="number" class="form-control form-control-sm text-center fw-bold" id="substitusi_jml_baru" name="jml" value="1" min="0.1" step="any">
                            </div>
                            <div class="col-8">
                                <label class="form-label small fw-bold mb-1">Aturan Pakai Baru</label>
                                <input type="text" class="form-control form-control-sm" id="substitusi_aturan_pakai_baru" name="aturan_pakai" placeholder="Contoh: 3 x 1 tablet">
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer py-1.5 px-3 bg-white d-flex justify-content-between">
                <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-warning btn-sm px-4 shadow text-dark fw-bold" id="btnSimpanSubstitusi">
                    <i class="bi bi-arrow-left-right me-1"></i> Terapkan Pergantian Obat
                </button>
            </div>

        </div>
    </div>
</div>

@push('script')
<script>
    // Buka Modal Substitusi
    function bukaModalSubstitusi(noPermintaan, kodeLama, namaLama, jmlLama, aturanLama, noRawat = '', kdDokter = '', namaDokter = '') {
        $('#substitusi_no_permintaan').val(noPermintaan);
        $('#substitusi_no_rawat').val(noRawat);
        $('#substitusi_kode_brng_lama').val(kodeLama);
        $('#substitusi_kd_dokter').val(kdDokter);
        $('#substitusi_nama_dokter').val(namaDokter);

        $('#lblSubstitusiNamaLama').text(namaLama);
        $('#lblSubstitusiKodeLama').text(kodeLama);
        $('#lblSubstitusiJmlLama').text(jmlLama);

        const dokterDisplay = namaDokter || 'Dokter Register';
        $('#lblSubstitusiNamaDokter').text(dokterDisplay);
        $('#lblSubstitusiNamaDokterConsent').text(dokterDisplay);

        $('#chkSubstitusiKonfirmasiDokter').prop('checked', false);
        $('#substitusi_catatan_konfirmasi').val('');

        $('#substitusi_kode_brng_baru').val('');
        $('#substitusi_cari_obat_baru').val('');
        $('#lblSubstitusiObatTerpilih').text('-');
        $('#lblSubstitusiStokDepo').text('0');
        $('#substitusi_jml_baru').val(jmlLama);
        $('#substitusi_aturan_pakai_baru').val(aturanLama || '-');
        $('#substitusi_dropdown_obat').addClass('d-none').empty();

        $('#modalSubstitusiObat').modal('show');
    }

    // Live search obat baru untuk substitusi
    let timeoutSearchSub = null;
    $('#substitusi_cari_obat_baru').on('keyup', function() {
        const query = $(this).val().trim();
        clearTimeout(timeoutSearchSub);
        if (query.length < 2) {
            $('#substitusi_dropdown_obat').addClass('d-none').empty();
            return;
        }

        timeoutSearchSub = setTimeout(function() {
            $.get("{{ url('/obat/cari') }}", { nama: query, gudang: 'RM' }).done(function(res) {
                const data = res?.data || [];
                const $drop = $('#substitusi_dropdown_obat');
                $drop.empty();
                if (!data || data.length === 0) {
                    $drop.append('<div class="list-group-item list-group-item-action text-muted p-2" style="font-size:11px;">Obat tidak ditemukan</div>');
                } else {
                    data.forEach(function(item) {
                        let totalStok = 0;
                        if (item.gudang_barang && item.gudang_barang.length > 0) {
                            totalStok = item.gudang_barang[0].stok || 0;
                        }
                        const sat = item.kode_satuan?.satuan || item.kode_sat || 'Sat';
                        const a = $(`
                            <a href="javascript:void(0)" class="list-group-item list-group-item-action p-2" style="font-size:11.5px;">
                                <div class="d-flex justify-content-between align-items-center">
                                    <strong>${item.nama_brng}</strong>
                                    <span class="badge ${totalStok > 0 ? 'bg-success' : 'bg-danger'}">${totalStok} ${sat}</span>
                                </div>
                                <small class="text-muted font-monospace">${item.kode_brng}</small>
                            </a>
                        `);
                        a.on('click', function() {
                            $('#substitusi_kode_brng_baru').val(item.kode_brng);
                            $('#lblSubstitusiObatTerpilih').text(item.nama_brng);
                            $('#lblSubstitusiStokDepo').text(`${totalStok} ${sat}`);
                            $('#substitusi_cari_obat_baru').val(item.nama_brng);
                            $drop.addClass('d-none');
                        });
                        $drop.append(a);
                    });
                }
                $drop.removeClass('d-none');
            });
        }, 300);
    });

    // Simpan Substitusi
    $('#btnSimpanSubstitusi').on('click', function() {
        const noPermintaan = $('#substitusi_no_permintaan').val();
        const kodeLama = $('#substitusi_kode_brng_lama').val();
        const kodeBaru = $('#substitusi_kode_brng_baru').val();
        const jml = $('#substitusi_jml_baru').val();
        const aturan = $('#substitusi_aturan_pakai_baru').val();

        if (!kodeBaru) {
            Swal.fire('Peringatan', 'Silahkan pilih obat pengganti terlebih dahulu.', 'warning');
            return;
        }

        const isKonfirmasi = $('#chkSubstitusiKonfirmasiDokter').is(':checked');
        if (!isKonfirmasi) {
            Swal.fire({
                icon: 'warning',
                title: 'Konfirmasi Dokter Diperlukan',
                text: 'Harap pastikan penggantian obat sudah dikonfirmasi kepada Dokter Register dan centang checklist konfirmasi sebelum melanjutkan.',
                confirmButtonColor: '#ffc107',
            });
            return;
        }

        const noRawat = $('#substitusi_no_rawat').val();
        const kdDokter = $('#substitusi_kd_dokter').val();
        const namaDokter = $('#substitusi_nama_dokter').val();
        const catatan = $('#substitusi_catatan_konfirmasi').val();

        $.ajax({
            url: "{{ route('farmasi.permintaan-ranap.substitusi') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                no_permintaan: noPermintaan,
                no_rawat: noRawat,
                kode_brng_lama: kodeLama,
                nama_brng_lama: $('#lblSubstitusiNamaLama').text(),
                kode_brng_baru: kodeBaru,
                nama_brng_baru: $('#lblSubstitusiObatTerpilih').text(),
                jml: jml,
                aturan_pakai: aturan,
                kd_dokter: kdDokter,
                nama_dokter: namaDokter,
                konfirmasi_dokter: 1,
                catatan: catatan
            },
            beforeSend: function() {
                Swal.fire({ title: 'Memproses Substitusi...', allowOutsideClick: false, didOpen: () => { Swal.showLoading(); } });
            },
            success: function(resp) {
                Swal.fire('Berhasil!', resp.message || 'Obat berhasil disubstitusi.', 'success');
                $('#modalSubstitusiObat').modal('hide');
                if (typeof loadPermintaanRanapFarmasi === 'function') {
                    loadPermintaanRanapFarmasi();
                }
                if (typeof showDetailPermintaanObat === 'function') {
                    showDetailPermintaanObat(noPermintaan);
                }
                if (typeof bukaDetailRanapFarmasi === 'function') {
                    bukaDetailRanapFarmasi(noPermintaan);
                }
            },
            error: function(xhr) {
                const msg = xhr.responseJSON?.message || 'Gagal mensubstitusi obat.';
                Swal.fire('Gagal!', msg, 'error');
            }
        });
    });
</script>
@endpush
