<!-- Modal Cetak Etiket Aturan Pakai Obat (Sesuai Khanza DlgResepObat) -->
<div class="modal fade" id="modalCetakEtiket" tabindex="-1" aria-labelledby="modalCetakEtiketLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white py-2 px-3">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-printer fs-5"></i>
                    <div>
                        <h6 class="modal-title fw-bold mb-0" id="modalCetakEtiketLabel">Cetak Etiket Aturan Pakai Obat</h6>
                        <small class="text-white-50" style="font-size: 11px;">Format stiker/thermal printer sesuai SIMRS Khanza (DlgResepObat)</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body p-3 bg-light">
                <!-- Info Pasien & Resep Singkat -->
                <div class="card border-0 shadow-sm rounded-3 mb-3 bg-white">
                    <div class="card-body p-2 px-3">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                            <div>
                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle font-monospace fw-bold" id="badgeNoResepEtiket" style="font-size: 12.5px;">-</span>
                                <span class="fw-semibold text-dark ms-2" id="subTitleEtiketPasien" style="font-size: 13px;">Memuat data pasien...</span>
                            </div>
                            <div class="text-muted small" id="subTitleEtiketPoliDokter" style="font-size: 11px;">
                                -
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kontrol Ukuran & Pilihan Item -->
                <div class="row g-2 mb-3">
                    <!-- Pilihan Ukuran Label Kertas -->
                    <div class="col-md-7">
                        <label class="form-label fw-bold mb-1 d-flex align-items-center gap-1" style="font-size: 12px;">
                            <i class="bi bi-aspect-ratio text-primary"></i> Ukuran Label Stiker Thermal:
                        </label>
                        <div class="btn-group btn-group-sm w-100 shadow-xs" role="group" aria-label="Pilihan Ukuran Etiket">
                            <input type="radio" class="btn-check" name="etiket_ukuran" id="ukuran_65x4" value="6.5x4" autocomplete="off" checked>
                            <label class="btn btn-outline-primary fw-medium" for="ukuran_65x4" title="6.5 x 4 cm (Khanza Model 1 & 2)">6.5x4 cm <small class="text-muted d-none d-sm-inline">(Model 1)</small></label>

                            <input type="radio" class="btn-check" name="etiket_ukuran" id="ukuran_5x58" value="5x5.8" autocomplete="off">
                            <label class="btn btn-outline-primary fw-medium" for="ukuran_5x58" title="5 x 5.8 cm (Khanza Model 3 rptItemResep5 Portrait)">5x5.8 cm <small class="text-muted d-none d-sm-inline">(Model 3)</small></label>

                            <input type="radio" class="btn-check" name="etiket_ukuran" id="ukuran_8x5" value="8x5" autocomplete="off">
                            <label class="btn btn-outline-primary fw-medium" for="ukuran_8x5" title="8 x 5 cm (Standar Farmasi RS)">8x5 cm</label>

                            <input type="radio" class="btn-check" name="etiket_ukuran" id="ukuran_7x5" value="7x5" autocomplete="off">
                            <label class="btn btn-outline-primary fw-medium" for="ukuran_7x5" title="7 x 5 cm (Sedang)">7x5 cm</label>

                            <input type="radio" class="btn-check" name="etiket_ukuran" id="ukuran_8x6" value="8x6" autocomplete="off">
                            <label class="btn btn-outline-primary fw-medium" for="ukuran_8x6" title="8 x 6 cm (Besar)">8x6 cm</label>

                            <input type="radio" class="btn-check" name="etiket_ukuran" id="ukuran_5x3" value="5x3" autocomplete="off">
                            <label class="btn btn-outline-primary fw-medium" for="ukuran_5x3" title="5 x 3 cm (Klip Kecil)">5x3 cm</label>
                        </div>
                    </div>

                    <!-- Pilihan Item Obat -->
                    <div class="col-md-5">
                        <label class="form-label fw-bold mb-1 d-flex align-items-center gap-1" style="font-size: 12px;">
                            <i class="bi bi-capsule text-success"></i> Pilih Item Obat:
                        </label>
                        <select class="form-select form-select-sm" id="selectEtiketItem" style="font-size: 12px; font-weight: 500;">
                            <option value="all">Semua Obat &amp; Racikan</option>
                        </select>
                    </div>
                </div>

                <!-- Preview Area -->
                <div class="position-relative border rounded-3 overflow-hidden bg-white shadow-sm" style="height: 420px;">
                    <div id="loadingEtiketPreview" class="position-absolute top-0 start-0 w-100 h-100 d-flex flex-column align-items-center justify-content-center bg-white bg-opacity-75" style="z-index: 5;">
                        <div class="spinner-border text-primary" role="status"></div>
                        <span class="mt-2 text-muted fw-semibold small">Membuat pratinjau etiket...</span>
                    </div>
                    <iframe id="iframeEtiketPreview" class="w-100 h-100 border-0" src="about:blank"></iframe>
                </div>
            </div>

            <div class="modal-footer bg-white d-flex justify-content-between py-2 px-3">
                <div class="text-muted small" style="font-size: 11px;">
                    <i class="bi bi-info-circle me-1 text-primary"></i>Format siap cetak per-stiker otomatis untuk printer thermal
                </div>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">
                        Tutup
                    </button>
                    <a id="btnBukaTabEtiket" href="#" target="_blank" class="btn btn-outline-primary btn-sm px-3">
                        <i class="bi bi-box-arrow-up-right me-1"></i>Tab Baru
                    </a>
                    <button type="button" class="btn btn-success btn-sm px-3 fw-bold" onclick="printEtiketDirect()">
                        <i class="bi bi-printer me-1"></i>Cetak Sekarang
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
<script>
    const modalCetakEtiketElement = $('#modalCetakEtiket');
    let currentEtiketNoResep = '';
    let currentEtiketSumber = 'resep'; // 'resep' atau 'resep_pulang'

    function bukaModalEtiket(no_resep, defaultItem = 'all', sumber = 'resep') {
        if (!no_resep) return;
        currentEtiketNoResep = no_resep;
        currentEtiketSumber = sumber || 'resep';

        if (currentEtiketSumber === 'resep_pulang') {
            $('#modalCetakEtiketLabel').text('Cetak Etiket Aturan Pakai (Resep Pulang)');
        } else {
            $('#modalCetakEtiketLabel').text('Cetak Etiket Aturan Pakai Obat');
        }

        $('#badgeNoResepEtiket').text(no_resep);
        $('#subTitleEtiketPasien').text('Memuat data pasien...');
        $('#subTitleEtiketPoliDokter').text('');
        
        // Reset item selector
        const selectItem = $('#selectEtiketItem');
        selectItem.html('<option value="all">Semua Obat &amp; Racikan (Semua Etiket)</option>');
        
        const itemsApiUrl = (currentEtiketSumber === 'resep_pulang')
            ? `{{ url('/farmasi/resep-pulang/etiket-items') }}/${encodeURIComponent(no_resep)}`
            : `{{ url('/resep/etiket-items') }}/${encodeURIComponent(no_resep)}`;

        // Ambil data resep dan daftar item untuk dropdown
        $.get(itemsApiUrl).done((response) => {
            if (response && response.pasien) {
                const pas = response.pasien;
                $('#subTitleEtiketPasien').text(`${pas.nm_pasien} (RM: ${pas.no_rkm_medis})`);
                if (response.dokter || response.poli) {
                    $('#subTitleEtiketPoliDokter').text(`${response.poli || '-'} • ${response.dokter || '-'}`);
                }
            }

            // Group Obat Non-Racik
            if (response.items_umum && response.items_umum.length > 0) {
                const optGroupUmum = $('<optgroup label="Obat Non-Racik"></optgroup>');
                response.items_umum.forEach((item) => {
                    const isSelected = (defaultItem === `umum_${item.kode}`) ? 'selected' : '';
                    optGroupUmum.append(`<option value="umum_${item.kode}" ${isSelected}>${item.nama} (${item.jml} ${item.satuan})</option>`);
                });
                selectItem.append(optGroupUmum);
            }

            // Group Obat Racikan
            if (response.items_racik && response.items_racik.length > 0) {
                const optGroupRacik = $('<optgroup label="Obat Racikan"></optgroup>');
                response.items_racik.forEach((item) => {
                    const isSelected = (defaultItem === `racik_${item.kode}`) ? 'selected' : '';
                    optGroupRacik.append(`<option value="racik_${item.kode}" ${isSelected}>${item.nama} (${item.jml} ${item.satuan})</option>`);
                });
                selectItem.append(optGroupRacik);
            }

            if (defaultItem && defaultItem !== 'all') {
                selectItem.val(defaultItem);
            }

            loadEtiketPdfPreview();
        }).fail(() => {
            loadEtiketPdfPreview();
        });

        modalCetakEtiketElement.modal('show');
    }

    function bukaModalCetakEtiketPulang(noPermintaan, defaultItem = 'all') {
        bukaModalEtiket(noPermintaan, defaultItem, 'resep_pulang');
    }

    function getSelectedUkuranEtiket() {
        return $('input[name="etiket_ukuran"]:checked').val() || '6.5x4';
    }

    function buildEtiketUrl() {
        const ukuran = getSelectedUkuranEtiket();
        const itemVal = $('#selectEtiketItem').val() || 'all';
        const baseUrl = (currentEtiketSumber === 'resep_pulang')
            ? `{{ url('/farmasi/resep-pulang/etiket') }}/${encodeURIComponent(currentEtiketNoResep)}`
            : `{{ url('/resep/etiket') }}/${encodeURIComponent(currentEtiketNoResep)}`;

        let url = `${baseUrl}?ukuran=${ukuran}`;

        if (itemVal !== 'all') {
            const parts = itemVal.split('_');
            if (parts.length >= 2) {
                url += `&item_type=${parts[0]}&item_key=${encodeURIComponent(parts.slice(1).join('_'))}`;
            }
        }
        return url;
    }

    function loadEtiketPdfPreview() {
        if (!currentEtiketNoResep) return;
        $('#loadingEtiketPreview').removeClass('d-none');
        const url = buildEtiketUrl();
        $('#btnBukaTabEtiket').attr('href', url);

        const iframe = document.getElementById('iframeEtiketPreview');
        iframe.onload = function() {
            $('#loadingEtiketPreview').addClass('d-none');
        };
        iframe.src = url;
    }

    // Change handlers
    $('input[name="etiket_ukuran"]').on('change', function() {
        loadEtiketPdfPreview();
    });

    $('#selectEtiketItem').on('change', function() {
        loadEtiketPdfPreview();
    });

    function printEtiketDirect() {
        const iframe = document.getElementById('iframeEtiketPreview');
        if (iframe && iframe.contentWindow) {
            try {
                iframe.contentWindow.focus();
                iframe.contentWindow.print();
            } catch (e) {
                window.open(buildEtiketUrl(), '_blank');
            }
        } else {
            window.open(buildEtiketUrl(), '_blank');
        }
    }

    modalCetakEtiketElement.on('hidden.bs.modal', function () {
        $('#iframeEtiketPreview').attr('src', 'about:blank');
    });
</script>
@endpush
