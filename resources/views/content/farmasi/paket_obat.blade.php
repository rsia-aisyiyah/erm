@extends('index')

@section('contents')
    <div class="row">
        <div class="col-12">
            <!-- Header Card -->
            <div class="card border-0 shadow-sm rounded-3 mb-3">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <div class="d-flex align-items-center gap-2">
                            <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                                <i class="bi bi-box-seam fs-4"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-0 text-dark">Master Paket &amp; Bundling Obat / BHP</h5>
                                <small class="text-muted" style="font-size: 11.5px;">Kelola template box paket obat &amp; BHP untuk Kamar Operasi (IBS), UGD, VK, dan Rawat Inap</small>
                            </div>
                        </div>
                        <div>
                            <button type="button" class="btn btn-primary btn-sm px-3 shadow-sm" onclick="bukaModalFormPaket()">
                                <i class="bi bi-plus-lg me-1"></i> Tambah Paket Baru
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter & Search Card -->
            <div class="card border-0 shadow-sm rounded-3 mb-3">
                <div class="card-body p-3">
                    <div class="row g-2 align-items-center">
                        <div class="col-md-3 col-6">
                            <label class="form-label small text-muted mb-1">Unit / Ruangan</label>
                            <select class="form-select form-select-sm" id="fil_unit" onchange="loadDaftarPaket()">
                                <option value="Semua">-- Semua Unit --</option>
                                <option value="Kamar Operasi">Kamar Operasi (IBS)</option>
                                <option value="UGD">UGD</option>
                                <option value="VK">VK (Kamar Bersalin)</option>
                                <option value="Ranap">Rawat Inap</option>
                            </select>
                        </div>
                        <div class="col-md-2 col-6">
                            <label class="form-label small text-muted mb-1">Status</label>
                            <select class="form-select form-select-sm" id="fil_status" onchange="loadDaftarPaket()">
                                <option value="">Semua Status</option>
                                <option value="1" selected>Aktif</option>
                                <option value="0">Nonaktif</option>
                            </select>
                        </div>
                        <div class="col-md-7 col-12">
                            <label class="form-label small text-muted mb-1">Pencarian Paket / Item Obat</label>
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" id="fil_keyword" placeholder="Ketik nama paket atau nama obat..." onkeyup="if(event.key==='Enter') loadDaftarPaket()">
                                <button class="btn btn-outline-secondary" type="button" onclick="loadDaftarPaket()">
                                    <i class="bi bi-search me-1"></i> Cari
                                </button>
                                <button class="btn btn-outline-danger" type="button" onclick="resetFilterPaket()">
                                    <i class="bi bi-arrow-counterclockwise"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabel Daftar Paket -->
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle mb-0" id="tbDaftarPaket" style="font-size: 12px;">
                            <thead class="table-light text-center">
                                <tr>
                                    <th width="4%">No</th>
                                    <th width="24%">Nama Paket</th>
                                    <th width="14%">Unit / Ruangan</th>
                                    <th width="18%">Dokter Spesialis</th>
                                    <th width="10%">Total Item</th>
                                    <th width="10%">Status</th>
                                    <th width="20%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="tbodyDaftarPaket">
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted">
                                        <div class="spinner-border spinner-border-sm text-primary me-2" role="status"></div>
                                        Memuat data paket obat...
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL FORM TAMBAH / EDIT PAKET OBAT -->
    <div class="modal fade" id="modalFormPaket" tabindex="-1" aria-labelledby="modalFormPaketLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-primary text-white py-2 px-3">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-box-seam fs-5"></i>
                        <h6 class="modal-title fw-bold text-white mb-0" id="modalFormPaketLabel">Form Paket Obat &amp; BHP</h6>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-3 bg-light">
                    <form id="formPaketObat">
                        <input type="hidden" id="paket_id" name="id">

                        <div class="card border-0 shadow-sm rounded-3 mb-3 bg-white">
                            <div class="card-body p-3">
                                <h6 class="fw-bold text-dark border-bottom pb-2 mb-3" style="font-size: 13px;">
                                    <i class="bi bi-info-circle text-primary me-1"></i> Informasi Header Paket
                                </h6>
                                <div class="row g-2">
                                    <div class="col-md-7 col-12">
                                        <label class="form-label small fw-bold mb-1">Nama Paket / Box <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm" id="form_nama_paket" required placeholder="Contoh: Paket Box Operasi SC Elektif">
                                    </div>
                                    <div class="col-md-5 col-12">
                                        <label class="form-label small fw-bold mb-1">Unit / Ruangan <span class="text-danger">*</span></label>
                                        <select class="form-select form-select-sm" id="form_unit" required>
                                            <option value="Kamar Operasi">Kamar Operasi (IBS)</option>
                                            <option value="UGD">UGD</option>
                                            <option value="VK">VK (Kamar Bersalin)</option>
                                            <option value="Ranap">Rawat Inap</option>
                                            <option value="Semua">Semua Unit</option>
                                        </select>
                                    </div>
                                    <div class="col-md-7 col-12">
                                        <label class="form-label small fw-bold mb-1">Dokter Spesialis (Opsional)</label>
                                        <select class="form-select form-select-sm" id="form_kd_dokter">
                                            <option value="">-- Berlaku untuk Semua Dokter --</option>
                                            @foreach ($dokterList as $d)
                                                <option value="{{ $d->kd_dokter }}">{{ $d->nm_dokter }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-5 col-12">
                                        <label class="form-label small fw-bold mb-1">Status</label>
                                        <select class="form-select form-select-sm" id="form_status">
                                            <option value="1">Aktif</option>
                                            <option value="0">Nonaktif</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label small fw-bold mb-1">Keterangan / Catatan Tindakan</label>
                                        <textarea class="form-control form-control-sm" id="form_keterangan" rows="2" placeholder="Catatan indikasi / penggunaan box paket..."></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- SUBFORM INPUT ITEM OBAT KE DALAM PAKET -->
                        <div class="card border-0 shadow-sm rounded-3 bg-white mb-2">
                            <div class="card-header bg-white border-bottom py-2 d-flex justify-content-between align-items-center">
                                <span class="fw-bold text-dark" style="font-size: 13px;">
                                    <i class="bi bi-capsule text-success me-1"></i> Daftar Obat &amp; BHP dalam Paket
                                </span>
                                <span class="badge bg-primary-subtle text-primary border" id="badgeTotalItemPaket">0 Item</span>
                            </div>
                            <div class="card-body p-3">
                                <!-- Input Bar Item -->
                                <div class="bg-light p-2.5 rounded-3 border mb-3">
                                    <div class="row g-2 align-items-end">
                                        <div class="col-md-5 col-12 position-relative">
                                            <label class="form-label small fw-bold mb-1">Cari Obat / BHP Medis</label>
                                            <input type="text" class="form-control form-control-sm" id="input_cari_obat" placeholder="Ketik nama obat / BHP..." autocomplete="off">
                                            <input type="hidden" id="input_kode_brng">
                                            <input type="hidden" id="input_nama_brng">
                                            <input type="hidden" id="input_satuan">
                                            <div id="dropdown_cari_obat" class="list-group position-absolute shadow-sm d-none" style="z-index: 1060; max-height: 220px; overflow-y: auto; width: 100%;"></div>
                                        </div>
                                        <div class="col-md-2 col-4">
                                            <label class="form-label small fw-bold mb-1">Jumlah</label>
                                            <div class="input-group input-group-sm">
                                                <input type="number" class="form-control text-center fw-bold" id="input_jumlah" value="1" min="0.1" step="any">
                                                <span class="input-group-text" id="lblInputSatuan" style="font-size: 10px;">Sat</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-8">
                                            <label class="form-label small fw-bold mb-1">Aturan Pakai / Dosis</label>
                                            <input type="text" class="form-control form-control-sm" id="input_aturan_pakai" placeholder="Contoh: K/P, 1x1 Amp, dll.">
                                        </div>
                                        <div class="col-md-2 col-12">
                                            <button type="button" class="btn btn-success btn-sm w-100" id="btnTambahItemPaket" onclick="tambahItemKePaket()">
                                                <i class="bi bi-plus-lg me-1"></i> Tambah
                                            </button>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between mt-1 text-muted" style="font-size: 11px;">
                                        <span>Item Terpilih: <b id="lblItemTerpilih" class="text-success">-</b></span>
                                        <span>Stok Depo: <b id="lblStokDepoInput" class="text-dark">0</b></span>
                                    </div>
                                </div>

                                <!-- Tabel Item Paket -->
                                <div class="table-responsive border rounded-3">
                                    <table class="table table-bordered table-sm align-middle mb-0" id="tbItemPaket" style="font-size: 11.5px;">
                                        <thead class="table-light text-center">
                                            <tr>
                                                <th width="5%">No</th>
                                                <th width="14%">Kode</th>
                                                <th width="35%">Nama Obat / BHP</th>
                                                <th width="12%">Jumlah</th>
                                                <th width="10%">Satuan</th>
                                                <th width="18%">Aturan Pakai</th>
                                                <th width="6%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbodyItemPaket">
                                            <tr>
                                                <td colspan="7" class="text-center text-muted py-3">
                                                    <i>Belum ada item obat yang dimasukkan ke dalam paket.</i>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-white py-2 px-3 justify-content-between">
                    <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary btn-sm px-4 shadow-sm" onclick="simpanPaketObat()">
                        <i class="bi bi-save me-1"></i> Simpan Paket
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL PREVIEW DETAIL PAKET OBAT -->
    <div class="modal fade" id="modalPreviewPaket" tabindex="-1" aria-labelledby="modalPreviewPaketLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-success text-white py-2 px-3">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-box2-fill fs-5"></i>
                        <div>
                            <h6 class="modal-title fw-bold text-white mb-0" id="preview_nama_paket">Detail Paket</h6>
                            <small class="text-white-50" id="preview_unit" style="font-size: 11px;">Unit: -</small>
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-3 bg-light">
                    <div class="card border-0 shadow-sm rounded-3 mb-3 bg-white">
                        <div class="card-body p-3" style="font-size: 12px;">
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <span class="text-muted small d-block">Dokter Spesialis:</span>
                                    <strong id="preview_dokter" class="text-dark">-</strong>
                                </div>
                                <div class="col-md-6">
                                    <span class="text-muted small d-block">Status:</span>
                                    <span id="preview_status_badge">-</span>
                                </div>
                                <div class="col-12 mt-2">
                                    <span class="text-muted small d-block">Keterangan:</span>
                                    <div id="preview_keterangan" class="p-2 bg-light rounded text-muted">-</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm rounded-3 bg-white">
                        <div class="card-header bg-white border-bottom py-2">
                            <span class="fw-bold text-dark" style="font-size: 12.5px;">
                                <i class="bi bi-list-check text-success me-1"></i> Rincian Item Obat &amp; BHP
                            </span>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-sm align-middle mb-0" style="font-size: 11.5px;">
                                    <thead class="table-light text-center">
                                        <tr>
                                            <th width="5%">No</th>
                                            <th width="15%">Kode</th>
                                            <th width="35%">Nama Obat / BHP</th>
                                            <th width="12%">Jumlah</th>
                                            <th width="10%">Satuan</th>
                                            <th width="13%">Stok Depo</th>
                                            <th width="20%">Aturan Pakai</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbodyPreviewItems">
                                        <tr>
                                            <td colspan="7" class="text-center py-3 text-muted">Memuat...</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-white py-2 px-3">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
<script>
    let listPaketData = [];
    let listFormItems = [];
    let timerCariObatMaster;

    $(document).ready(function() {
        loadDaftarPaket();
        initAutocompleteObat();
    });

    function resetFilterPaket() {
        $('#fil_unit').val('Semua');
        $('#fil_status').val('1');
        $('#fil_keyword').val('');
        loadDaftarPaket();
    }

    // Load Daftar Paket dari Server
    function loadDaftarPaket() {
        const unit = $('#fil_unit').val();
        const status = $('#fil_status').val();
        const keyword = $('#fil_keyword').val();

        $('#tbodyDaftarPaket').html(`
            <tr>
                <td colspan="7" class="text-center py-4 text-muted">
                    <div class="spinner-border spinner-border-sm text-primary me-2" role="status"></div>
                    Memuat data paket obat...
                </td>
            </tr>
        `);

        $.get("{{ route('obat.paket.data') }}", {
            unit: unit,
            status: status,
            keyword: keyword
        }).done(function(res) {
            listPaketData = res?.data || [];
            renderTableDaftarPaket();
        }).fail(function(xhr) {
            $('#tbodyDaftarPaket').html(`
                <tr>
                    <td colspan="7" class="text-center py-3 text-danger">
                        <i class="bi bi-exclamation-triangle me-1"></i> Gagal memuat data paket obat.
                    </td>
                </tr>
            `);
        });
    }

    // Render Tabel Daftar Paket
    function renderTableDaftarPaket() {
        const $tbody = $('#tbodyDaftarPaket');
        $tbody.empty();

        if (listPaketData.length === 0) {
            $tbody.html(`
                <tr>
                    <td colspan="7" class="text-center py-4 text-muted">
                        <i class="bi bi-inbox fs-4 d-block mb-1 text-secondary"></i>
                        Belum ada paket obat &amp; BHP yang terdaftar.
                    </td>
                </tr>
            `);
            return;
        }

        listPaketData.forEach(function(item, idx) {
            const badgeUnitClass = item.unit === 'Kamar Operasi' ? 'bg-danger-subtle text-danger border-danger' : 
                (item.unit === 'UGD' ? 'bg-warning-subtle text-dark border-warning' : 
                (item.unit === 'VK' ? 'bg-info-subtle text-info-emphasis border-info' : 'bg-primary-subtle text-primary border-primary'));

            const statusToggle = item.status === '1'
                ? `<button type="button" class="btn btn-sm btn-outline-success py-0.5 px-2 rounded-pill" onclick="toggleStatusPaket(${item.id})"><i class="bi bi-check-circle-fill me-1"></i> Aktif</button>`
                : `<button type="button" class="btn btn-sm btn-outline-secondary py-0.5 px-2 rounded-pill" onclick="toggleStatusPaket(${item.id})"><i class="bi bi-x-circle me-1"></i> Nonaktif</button>`;

            const dokterNama = item.dokter?.nm_dokter || '<span class="text-muted">Semua Dokter</span>';

            const tr = `
                <tr>
                    <td class="text-center font-monospace">${idx + 1}</td>
                    <td>
                        <strong class="text-primary d-block" style="font-size: 13px;">${item.nama_paket}</strong>
                        <small class="text-muted d-block text-truncate" style="max-width: 280px;">${item.keterangan || '-'}</small>
                    </td>
                    <td class="text-center">
                        <span class="badge border py-1 px-2 rounded-pill ${badgeUnitClass}">
                            <i class="bi bi-geo-alt me-0.5"></i> ${item.unit}
                        </span>
                    </td>
                    <td>${dokterNama}</td>
                    <td class="text-center">
                        <span class="badge bg-light text-dark border font-monospace px-2 py-1">
                            ${item.details_count || 0} item
                        </span>
                    </td>
                    <td class="text-center">${statusToggle}</td>
                    <td class="text-center">
                        <div class="d-inline-flex gap-1">
                            <button type="button" class="btn btn-outline-info btn-sm py-1 px-2 shadow-none" onclick="previewPaket(${item.id})" title="Lihat Rincian Item">
                                <i class="bi bi-eye"></i> Detail
                            </button>
                            <button type="button" class="btn btn-outline-primary btn-sm py-1 px-2 shadow-none" onclick="editPaket(${item.id})" title="Edit Paket">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <button type="button" class="btn btn-outline-danger btn-sm py-1 px-1.5 shadow-none" onclick="hapusPaket(${item.id}, '${item.nama_paket.replace(/'/g, "\\'")}')" title="Hapus Paket">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            `;
            $tbody.append(tr);
        });
    }

    // Modal Form Buka (Tambah Baru)
    function bukaModalFormPaket() {
        $('#formPaketObat')[0].reset();
        $('#paket_id').val('');
        $('#modalFormPaketLabel').text('Tambah Paket Obat & BHP Baru');
        listFormItems = [];
        resetInputItem();
        renderTableFormItems();
        $('#modalFormPaket').modal('show');
    }

    // Edit Paket
    function editPaket(id) {
        Swal.fire({ title: 'Memuat Data Paket...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });

        $.get(`{{ url('/obat/paket/detail') }}/${id}`).done(function(res) {
            Swal.close();
            const data = res?.data || {};

            $('#paket_id').val(data.id);
            $('#form_nama_paket').val(data.nama_paket);
            $('#form_unit').val(data.unit);
            $('#form_kd_dokter').val(data.kd_dokter || '');
            $('#form_status').val(data.status);
            $('#form_keterangan').val(data.keterangan !== '-' ? data.keterangan : '');

            listFormItems = (data.items || []).map(item => ({
                kode_brng: item.kode_brng,
                nama_brng: item.nama_brng,
                satuan: item.satuan,
                jumlah: item.jumlah,
                aturan_pakai: item.aturan_pakai !== '-' ? item.aturan_pakai : ''
            }));

            $('#modalFormPaketLabel').text(`Edit Paket: ${data.nama_paket}`);
            resetInputItem();
            renderTableFormItems();
            $('#modalFormPaket').modal('show');
        }).fail(function() {
            Swal.fire('Gagal!', 'Gagal mengambil detail paket.', 'error');
        });
    }

    // Preview Detail Paket
    function previewPaket(id) {
        Swal.fire({ title: 'Memuat...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });

        $.get(`{{ url('/obat/paket/detail') }}/${id}`).done(function(res) {
            Swal.close();
            const data = res?.data || {};

            $('#preview_nama_paket').text(data.nama_paket);
            $('#preview_unit').text(`Unit: ${data.unit}`);
            $('#preview_dokter').text(data.dokter?.nm_dokter || 'Semua Dokter');
            $('#preview_keterangan').text(data.keterangan || '-');

            const statusBadge = data.status === '1'
                ? `<span class="badge bg-success">Aktif</span>`
                : `<span class="badge bg-secondary">Nonaktif</span>`;
            $('#preview_status_badge').html(statusBadge);

            const $tbody = $('#tbodyPreviewItems');
            $tbody.empty();

            if (!data.items || data.items.length === 0) {
                $tbody.html(`<tr><td colspan="7" class="text-center py-3 text-muted">Tidak ada item obat.</td></tr>`);
            } else {
                data.items.forEach(function(it, idx) {
                    $tbody.append(`
                        <tr>
                            <td class="text-center font-monospace">${idx + 1}</td>
                            <td class="font-monospace">${it.kode_brng}</td>
                            <td><strong>${it.nama_brng}</strong></td>
                            <td class="text-center fw-bold text-primary">${it.jumlah}</td>
                            <td class="text-center">${it.satuan}</td>
                            <td class="text-center">
                                <span class="badge ${it.stok > 0 ? 'bg-success' : 'bg-danger'} rounded-pill" style="font-size: 10px;">
                                    ${it.stok}
                                </span>
                            </td>
                            <td>${it.aturan_pakai || '-'}</td>
                        </tr>
                    `);
                });
            }

            $('#modalPreviewPaket').modal('show');
        }).fail(function() {
            Swal.fire('Gagal!', 'Gagal memuat rincian paket.', 'error');
        });
    }

    // Toggle Status
    function toggleStatusPaket(id) {
        $.post(`{{ url('/obat/paket/toggle-status') }}/${id}`, {
            _token: "{{ csrf_token() }}"
        }).done(function(res) {
            loadDaftarPaket();
        }).fail(function(xhr) {
            Swal.fire('Gagal!', xhr.responseJSON?.message || 'Gagal mengubah status paket.', 'error');
        });
    }

    // Hapus Paket
    function hapusPaket(id, nama) {
        Swal.fire({
            title: 'Hapus Paket?',
            text: `Yakin ingin menghapus paket "${nama}"? Semua item di dalamnya akan ikut terhapus.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `{{ url('/obat/paket/hapus') }}/${id}`,
                    type: "DELETE",
                    data: { _token: "{{ csrf_token() }}" },
                    success: function(res) {
                        Swal.fire('Terhapus!', res.message || 'Paket berhasil dihapus.', 'success');
                        loadDaftarPaket();
                    },
                    error: function(xhr) {
                        Swal.fire('Gagal!', xhr.responseJSON?.message || 'Gagal menghapus paket.', 'error');
                    }
                });
            }
        });
    }

    // Autocomplete Input Cari Obat di Modal Form
    function initAutocompleteObat() {
        $('#input_cari_obat').on('input', function() {
            clearTimeout(timerCariObatMaster);
            const kw = $(this).val();
            if (kw.length < 2) {
                $('#dropdown_cari_obat').addClass('d-none').empty();
                return;
            }

            timerCariObatMaster = setTimeout(function() {
                $.get("{{ route('obat.cari') }}", { nama: kw, gudang: 'RM' }).done(function(res) {
                    const list = res?.data || [];
                    const $dd = $('#dropdown_cari_obat');
                    $dd.empty();

                    if (list.length === 0) {
                        $dd.append('<div class="list-group-item list-group-item-action disabled text-muted py-2">Obat tidak ditemukan</div>');
                    } else {
                        list.forEach(function(item) {
                            let stok = 0;
                            if (item.gudang_barang && item.gudang_barang.length > 0) {
                                stok = item.gudang_barang[0].stok || 0;
                            }
                            const sat = item.kode_satuan?.satuan || item.kode_sat || '';
                            $dd.append(`
                                <a href="javascript:void(0)" class="list-group-item list-group-item-action py-1.5 px-2.5" onclick="pilihObatMaster('${item.kode_brng}', '${item.nama_brng.replace(/'/g, "\\'")}', '${sat}', ${stok})">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <strong style="font-size: 11.5px;">${item.nama_brng}</strong>
                                        <span class="badge ${stok > 0 ? 'bg-success' : 'bg-danger'} rounded-pill" style="font-size: 10px;">Stok: ${stok}</span>
                                    </div>
                                    <small class="text-muted" style="font-size: 10px;">Kode: ${item.kode_brng}</small>
                                </a>
                            `);
                        });
                    }
                    $dd.removeClass('d-none');
                });
            }, 300);
        });

        $(document).on('click', function(e) {
            if (!$(e.target).closest('#input_cari_obat, #dropdown_cari_obat').length) {
                $('#dropdown_cari_obat').addClass('d-none');
            }
        });
    }

    function pilihObatMaster(kode, nama, sat, stok) {
        $('#input_kode_brng').val(kode);
        $('#input_nama_brng').val(nama);
        $('#input_satuan').val(sat);
        $('#input_cari_obat').val(nama);
        $('#lblItemTerpilih').text(nama);
        $('#lblStokDepoInput').text(`${stok} ${sat}`);
        $('#lblInputSatuan').text(sat);
        $('#dropdown_cari_obat').addClass('d-none').empty();
        $('#input_jumlah').focus();
    }

    function resetInputItem() {
        $('#input_cari_obat').val('');
        $('#input_kode_brng').val('');
        $('#input_nama_brng').val('');
        $('#input_satuan').val('');
        $('#lblItemTerpilih').text('-');
        $('#lblStokDepoInput').text('0');
        $('#lblInputSatuan').text('Sat');
        $('#input_jumlah').val('1');
        $('#input_aturan_pakai').val('');
        $('#dropdown_cari_obat').addClass('d-none').empty();
    }

    // Tambahkan item ke list sementara di modal
    function tambahItemKePaket() {
        const kode = $('#input_kode_brng').val();
        const nama = $('#input_nama_brng').val();
        const sat = $('#input_satuan').val() || 'Sat';
        const jml = parseFloat($('#input_jumlah').val()) || 0;
        const aturan = $('#input_aturan_pakai').val() || '-';

        if (!kode || !nama) {
            Swal.fire('Peringatan', 'Silahkan pilih obat / BHP terlebih dahulu.', 'warning');
            return;
        }

        if (jml <= 0) {
            Swal.fire('Peringatan', 'Jumlah obat harus lebih dari 0.', 'warning');
            return;
        }

        const existing = listFormItems.find(i => i.kode_brng === kode);
        if (existing) {
            existing.jumlah += jml;
            if (aturan !== '-') existing.aturan_pakai = aturan;
        } else {
            listFormItems.push({
                kode_brng: kode,
                nama_brng: nama,
                satuan: sat,
                jumlah: jml,
                aturan_pakai: aturan
            });
        }

        resetInputItem();
        renderTableFormItems();
        $('#input_cari_obat').focus();
    }

    function hapusItemDariPaket(idx) {
        listFormItems.splice(idx, 1);
        renderTableFormItems();
    }

    function renderTableFormItems() {
        const $tbody = $('#tbodyItemPaket');
        $tbody.empty();
        $('#badgeTotalItemPaket').text(`${listFormItems.length} Item`);

        if (listFormItems.length === 0) {
            $tbody.html(`
                <tr>
                    <td colspan="7" class="text-center text-muted py-3">
                        <i>Belum ada item obat yang dimasukkan ke dalam paket.</i>
                    </td>
                </tr>
            `);
            return;
        }

        listFormItems.forEach(function(item, idx) {
            $tbody.append(`
                <tr>
                    <td class="text-center font-monospace">${idx + 1}</td>
                    <td class="font-monospace">${item.kode_brng}</td>
                    <td><strong>${item.nama_brng}</strong></td>
                    <td class="text-center">
                        <input type="number" class="form-control form-control-sm text-center fw-bold py-0.5" style="width: 75px; margin: 0 auto;" value="${item.jumlah}" min="0.1" step="any" onchange="listFormItems[${idx}].jumlah = parseFloat(this.value) || 1">
                    </td>
                    <td class="text-center">${item.satuan}</td>
                    <td>
                        <input type="text" class="form-control form-control-sm py-0.5" value="${item.aturan_pakai || ''}" placeholder="-" onchange="listFormItems[${idx}].aturan_pakai = this.value">
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-outline-danger btn-sm py-0.5 px-1.5" onclick="hapusItemDariPaket(${idx})">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </td>
                </tr>
            `);
        });
    }

    // Simpan Paket Obat ke Server
    function simpanPaketObat() {
        const nama = $('#form_nama_paket').val().trim();
        const unit = $('#form_unit').val();
        const kdDokter = $('#form_kd_dokter').val();
        const status = $('#form_status').val();
        const keterangan = $('#form_keterangan').val().trim();
        const id = $('#paket_id').val();

        if (!nama) {
            Swal.fire('Peringatan', 'Nama Paket wajib diisi.', 'warning');
            $('#form_nama_paket').focus();
            return;
        }

        if (listFormItems.length === 0) {
            Swal.fire('Peringatan', 'Paket harus memiliki minimal 1 item obat/BHP.', 'warning');
            $('#input_cari_obat').focus();
            return;
        }

        Swal.fire({ title: 'Menyimpan Paket...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });

        $.ajax({
            url: "{{ route('obat.paket.simpan') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                id: id,
                nama_paket: nama,
                unit: unit,
                kd_dokter: kdDokter,
                status: status,
                keterangan: keterangan,
                items: listFormItems
            },
            success: function(res) {
                Swal.fire('Berhasil!', res.message || 'Paket obat berhasil disimpan.', 'success');
                $('#modalFormPaket').modal('hide');
                loadDaftarPaket();
            },
            error: function(xhr) {
                Swal.fire('Gagal!', xhr.responseJSON?.message || 'Gagal menyimpan paket obat.', 'error');
            }
        });
    }
</script>
@endpush
