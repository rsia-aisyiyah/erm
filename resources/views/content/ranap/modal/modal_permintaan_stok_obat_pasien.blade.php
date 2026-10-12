<!-- Modal Permintaan Stok Obat Pasien Ranap (UDD) -->
<div class="modal fade" id="modalPermintaanObatRanap" tabindex="-1" aria-labelledby="modalPermintaanObatRanapLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content border-0 shadow">
            
            <!-- Modal Header -->
            <div class="modal-header text-white py-2 px-3 justify-content-between align-items-center" style="background: linear-gradient(135deg, #198754 0%, #157347 100%);">
                <div class="d-flex align-items-center gap-2">
                    <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                        <i class="bi bi-cart-plus-fill fs-5 text-white"></i>
                    </div>
                    <div>
                        <h6 class="modal-title fw-bold mb-0 text-white" id="modalPermintaanObatRanapLabel">
                            PERMINTAAN STOK OBAT PASIEN (UDD RAWAT INAP)
                        </h6>
                        <small class="text-white-50" style="font-size: 11px;">Pengorderan Obat Harian dari Ruangan ke Depo Farmasi &amp; Validasi Kesiapan Stok</small>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-light text-success px-2 py-1 shadow-sm font-monospace" id="badgeNoPermintaanAktif" style="font-size: 11px;">
                        SP-BARU
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
                                <strong class="text-success font-monospace" id="permintaan_info_no_rawat">-</strong>
                            </div>
                            <div class="col-md-2 col-6">
                                <label class="text-muted small mb-0 d-block" style="font-size: 10px;">NO. REKAM MEDIS</label>
                                <strong class="text-dark font-monospace" id="permintaan_info_no_rkm_medis">-</strong>
                            </div>
                            <div class="col-md-4 col-12">
                                <label class="text-muted small mb-0 d-block" style="font-size: 10px;">NAMA PASIEN</label>
                                <strong class="text-dark" id="permintaan_info_nm_pasien">-</strong>
                            </div>
                            <div class="col-md-3 col-12">
                                <label class="text-muted small mb-0 d-block" style="font-size: 10px;">KAMAR / BANGSAL</label>
                                <strong class="text-dark" id="permintaan_info_kamar">-</strong>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- NAVIGATION TABS -->
                <ul class="nav nav-pills nav-fill mb-3 bg-white p-1 rounded-3 shadow-sm border" id="pills-permintaan-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active py-2 fw-semibold" id="tab-order-obat-link" data-bs-toggle="pill" data-bs-target="#tab-order-obat" type="button" role="tab" style="font-size: 12.5px;">
                            <i class="bi bi-plus-circle me-1"></i> 1. Form Order Permintaan Baru
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link py-2 fw-semibold" id="tab-riwayat-order-link" data-bs-toggle="pill" data-bs-target="#tab-riwayat-order" type="button" role="tab" style="font-size: 12.5px;">
                            <i class="bi bi-clock-history me-1"></i> 2. Riwayat &amp; Status Permintaan Pasien
                        </button>
                    </li>
                </ul>

                <!-- TAB CONTENT -->
                <div class="tab-content" id="pills-permintaan-tabContent">
                    
                    <!-- TAB 1: FORM ORDER PERMINTAAN BARU -->
                    <div class="tab-pane fade show active" id="tab-order-obat" role="tabpanel">
                        <div class="card border-0 shadow-sm rounded-3 bg-white mb-3">
                            <div class="card-header bg-white border-bottom py-2 d-flex justify-content-between align-items-center">
                                <span class="fw-bold text-secondary" style="font-size: 12px;">
                                    <i class="bi bi-pencil-square text-success me-1"></i> Input Item Obat &amp; Jadwal Pemberian Jam
                                </span>
                                <span class="badge bg-success-subtle text-success border border-success" id="infoNoPermintaanBaru">
                                    Membuat No. Permintaan Baru...
                                </span>
                            </div>
                            <div class="card-body p-3">
                                <form id="formPermintaanObatRanap">
                                    <input type="hidden" id="permintaan_no_rawat" name="no_rawat">
                                    <input type="hidden" id="permintaan_kd_dokter" name="kd_dokter">

                                    <div class="row g-2 mb-3">
                                        <!-- Pencarian Obat -->
                                        <div class="col-md-5 col-12">
                                            <label class="form-label small fw-bold mb-1">Cari Obat / BHP Medis</label>
                                            <div class="input-group input-group-sm">
                                                <input type="text" class="form-control" id="permintaan_cari_obat" placeholder="Ketik nama obat / scan barcode..." autocomplete="off">
                                                <button class="btn btn-outline-secondary" type="button" id="btnCariObatPermintaan">
                                                    <i class="bi bi-search"></i>
                                                </button>
                                            </div>
                                            <input type="hidden" id="permintaan_kode_brng">
                                            <input type="hidden" id="permintaan_nama_brng">
                                            <input type="hidden" id="permintaan_satuan">
                                            <!-- Container Dropdown Hasil Pencarian -->
                                            <div id="permintaan_dropdown_obat" class="list-group position-absolute shadow-sm d-none" style="z-index: 1050; max-height: 250px; overflow-y: auto; width: 420px;"></div>
                                            <div class="d-flex justify-content-between mt-1 text-muted" style="font-size: 11px;">
                                                <span>Pilihan: <b id="lblObatTerpilih" class="text-success">-</b></span>
                                                <span>Stok Depo: <b id="lblStokDepo" class="text-dark">0</b></span>
                                            </div>
                                        </div>

                                        <!-- Jumlah -->
                                        <div class="col-md-2 col-4">
                                            <label class="form-label small fw-bold mb-1">Jumlah</label>
                                            <div class="input-group input-group-sm">
                                                <input type="number" class="form-control text-center fw-bold" id="permintaan_jml" value="1" min="0.1" step="any">
                                                <span class="input-group-text" id="lblSatuanObat" style="font-size: 11px;">Sat</span>
                                            </div>
                                        </div>

                                        <!-- Aturan Pakai -->
                                        <div class="col-md-5 col-8">
                                            <label class="form-label small fw-bold mb-1">Aturan Pakai / Dosis</label>
                                            <input type="text" class="form-control form-control-sm" id="permintaan_aturan_pakai" placeholder="Contoh: 3 x 1 tablet sesudah makan" list="listAturanPakaiPreset">
                                            <datalist id="listAturanPakaiPreset">
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

                                    <!-- PRESET JADWAL JAM 24 JAM -->
                                    <div class="bg-light p-2.5 rounded-3 border mb-3">
                                        <div class="d-flex justify-content-between align-items-center mb-2 flex-wrap gap-1">
                                            <label class="form-label small fw-bold mb-0 text-dark">
                                                <i class="bi bi-clock me-1 text-primary"></i> Jadwal Jam Pemberian (Centang Jam):
                                            </label>
                                            <div class="btn-group btn-group-sm flex-wrap" role="group" aria-label="Preset Jadwal Jam">
                                                <button type="button" class="btn btn-outline-secondary btn-sm py-0" onclick="setPresetJam('1x_pagi')">1x (07)</button>
                                                <button type="button" class="btn btn-outline-secondary btn-sm py-0" onclick="setPresetJam('1x_malam')">1x (19)</button>
                                                <button type="button" class="btn btn-outline-secondary btn-sm py-0" onclick="setPresetJam('2x')">2x (07, 19)</button>
                                                <button type="button" class="btn btn-outline-secondary btn-sm py-0" onclick="setPresetJam('3x')">3x (07, 13, 19)</button>
                                                <button type="button" class="btn btn-outline-secondary btn-sm py-0" onclick="setPresetJam('4x')">4x (07, 13, 19, 01)</button>
                                                <button type="button" class="btn btn-outline-secondary btn-sm py-0" onclick="setPresetJam('8h')">Tiap 8 Jam (06, 14, 22)</button>
                                                <button type="button" class="btn btn-outline-danger btn-sm py-0" onclick="setPresetJam('clear')">Reset Jam</button>
                                            </div>
                                        </div>

                                        <!-- Grid 24 Jam Checklist -->
                                        <div class="row row-cols-6 row-cols-md-12 g-1 text-center" id="containerCheckJam">
                                            @for ($h = 0; $h <= 23; $h++)
                                                @php $jamStr = sprintf('%02d', $h); @endphp
                                                <div class="col">
                                                    <input type="checkbox" class="btn-check chk-jam-order" id="chk_jam{{ $jamStr }}" value="jam{{ $jamStr }}" autocomplete="off">
                                                    <label class="btn btn-outline-success btn-sm w-100 py-1 px-0" for="chk_jam{{ $jamStr }}" style="font-size: 11px;">
                                                        {{ $jamStr }}:00
                                                    </label>
                                                </div>
                                            @endfor
                                        </div>
                                    </div>

                                    <!-- Tombol Tambah / Update Obat ke List -->
                                    <div class="d-flex justify-content-end mb-3 gap-2">
                                        <button type="button" class="btn btn-secondary btn-sm px-3 d-none shadow-sm" id="btnBatalEditItem" onclick="batalEditItemSementara()">
                                            <i class="bi bi-x-lg me-1"></i> Batal Edit
                                        </button>
                                        <button type="button" class="btn btn-success btn-sm px-3 shadow-sm" id="btnTambahItemPermintaan">
                                            <i class="bi bi-plus-lg me-1"></i> Tambahkan ke Daftar Order
                                        </button>
                                    </div>
                                </form>

                                <!-- TABEL DAFTAR ITEM YANG AKAN DI-ORDER -->
                                <div class="table-responsive border rounded-3 bg-white">
                                    <table class="table table-bordered table-hover table-sm align-middle mb-0" id="tbItemPermintaanSementara" style="font-size: 11.5px;">
                                        <thead class="table-light text-center">
                                            <tr>
                                                <th width="4%">No</th>
                                                <th width="12%">Kode</th>
                                                <th width="28%">Nama Obat / BHP</th>
                                                <th width="8%">Jumlah</th>
                                                <th width="8%">Satuan</th>
                                                <th width="20%">Aturan Pakai</th>
                                                <th width="15%">Jadwal Jam</th>
                                                <th width="5%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbodyItemPermintaanSementara">
                                            <tr>
                                                <td colspan="8" class="text-center text-muted py-3">
                                                    <i>Belum ada item obat yang ditambahkan. Silahkan cari obat dan klik Tambahkan.</i>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer bg-white border-top py-2 d-flex justify-content-between align-items-center">
                                <span class="small text-muted" id="lblTotalItemOrder">Total Item: 0 obat</span>
                                <button type="button" class="btn btn-primary btn-sm px-4 shadow" id="btnKirimOrderFarmasi">
                                    <i class="bi bi-send-fill me-1"></i> Kirim Permintaan ke Farmasi
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 2: RIWAYAT & STATUS PERMINTAAN PASIEN -->
                    <div class="tab-pane fade" id="tab-riwayat-order" role="tabpanel">
                        <div class="card border-0 shadow-sm rounded-3 bg-white mb-3">
                            <div class="card-header bg-white border-bottom py-2 d-flex justify-content-between align-items-center">
                                <span class="fw-bold text-secondary" style="font-size: 12px;">
                                    <i class="bi bi-list-check text-primary me-1"></i> Riwayat Permintaan Obat Ranap
                                </span>
                                <button type="button" class="btn btn-outline-secondary btn-sm py-1 px-2" onclick="loadRiwayatPermintaanPasien()">
                                    <i class="bi bi-arrow-clockwise"></i> Refresh
                                </button>
                            </div>
                            <div class="card-body p-2">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover table-sm align-middle mb-0" id="tbRiwayatPermintaanRanap" style="font-size: 11.5px;">
                                        <thead class="table-light text-center">
                                            <tr>
                                                <th width="15%">No. Permintaan</th>
                                                <th width="15%">Tanggal &amp; Jam</th>
                                                <th width="20%">Dokter Yang Meminta</th>
                                                <th width="15%">Status Pelayanan</th>
                                                <th width="15%">Waktu Validasi</th>
                                                <th width="20%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbodyRiwayatPermintaanRanap">
                                            <tr>
                                                <td colspan="6" class="text-center text-muted py-3">Memuat riwayat permintaan...</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <div class="modal-footer py-1.5 px-3 bg-white">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
            </div>

        </div>
    </div>
</div>

<!-- Submodal Detail Permintaan & Validasi Farmasi -->
<div class="modal fade" id="modalDetailPermintaanObat" tabindex="-1" aria-hidden="true" style="z-index: 1060;">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white py-2 px-3">
                <h6 class="modal-title fw-bold" id="titleDetailPermintaan">Detail Permintaan Stok Obat</h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">
                <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom" style="font-size: 11.5px;">
                    <div>
                        No. Permintaan: <strong class="font-monospace text-primary" id="lblDetNoPermintaan">-</strong><br>
                        Tanggal &amp; Jam: <span id="lblDetTglJam">-</span>
                    </div>
                    <div class="text-end">
                        Status: <span id="lblDetStatus">-</span><br>
                        Dokter: <span id="lblDetDokter">-</span>
                    </div>
                </div>

                <!-- Bagian Pilih Depo Pengeluaran untuk Validasi Farmasi -->
                <div class="alert alert-info py-2 px-3 mb-2 d-none" id="boxValidasiFarmasi">
                    <div class="row g-2 align-items-center" style="font-size: 11.5px;">
                        <div class="col-md-7 col-12">
                            <label class="form-label small fw-bold mb-0">Depo Farmasi Pengeluaran Stok:</label>
                            <select class="form-select form-select-sm" id="selDepoValidasiFarmasi">
                                <option value="RM" selected>Apotek Rinap (RM)</option>
                                <option value="B0015">Gudang Farmasi (B0015)</option>
                                <option value="LB">Laboratorium (LB)</option>
                            </select>
                        </div>
                        <div class="col-md-5 col-12 text-md-end text-start mt-md-3">
                            <button type="button" class="btn btn-success btn-sm w-100 fw-bold" id="btnEksekusiValidasiFarmasi">
                                <i class="bi bi-check2-circle me-1"></i> Validasi &amp; Siapkan Obat
                            </button>
                        </div>
                    </div>
                </div>

                <div class="table-responsive border rounded-3">
                    <table class="table table-bordered table-sm align-middle mb-0" id="tbDetailObatPermintaan" style="font-size: 11.5px;">
                        <thead class="table-light text-center">
                            <tr>
                                <th width="5%">No</th>
                                <th width="15%">Kode</th>
                                <th width="35%">Nama Obat</th>
                                <th width="10%">Jumlah</th>
                                <th width="10%">Satuan</th>
                                <th width="25%">Aturan Pakai &amp; Jam</th>
                            </tr>
                        </thead>
                        <tbody id="tbodyDetailObatPermintaan">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer py-1 px-3">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

@push('script')
<script>
    let listOrderSementara = [];

    // Buka Modal Permintaan Obat Ranap
    function modalPermintaanObatRanap(noRawat) {
        if (!noRawat) {
            Swal.fire('Peringatan', 'No. Rawat tidak valid.', 'warning');
            return;
        }

        $('#permintaan_no_rawat').val(noRawat);
        $('#permintaan_info_no_rawat').text(noRawat);

        // Ambil info pasien & kamar
        getRegPeriksa(noRawat).done(function(res) {
            const pasien = res?.pasien || {};
            const kamarList = res?.kamar_inap || [];
            const dokter = res?.dokter || {};

            let kamarNama = '-';
            if (kamarList.length > 0) {
                const activeKamar = kamarList.find(k => k.stts_pulang === '-') || kamarList[0];
                kamarNama = activeKamar?.kamar?.bangsal?.nm_bangsal || activeKamar?.kd_kamar || '-';
            }

            $('#permintaan_info_no_rkm_medis').text(pasien?.no_rkm_medis || '-');
            $('#permintaan_info_nm_pasien').text(pasien?.nm_pasien || '-');
            $('#permintaan_info_kamar').text(kamarNama);
            $('#permintaan_kd_dokter').val(res?.kd_dokter || dokter?.kd_dokter || '');
        });

        // Ambil nomor permintaan baru
        $.get("{{ route('ranap.permintaan-obat.nomor') }}").done(function(resNomor) {
            $('#infoNoPermintaanBaru').text(`No. Baru: ${resNomor}`);
            $('#badgeNoPermintaanAktif').text(resNomor);
        });

        // Reset form & list
        resetFormInputObat();
        listOrderSementara = [];
        renderTableItemSementara();

        // Switch to Tab 1
        $('#tab-order-obat-link').tab('show');

        // Show Modal
        $('#modalPermintaanObatRanap').modal('show');
    }

    let itemEditIndex = null;

    // Reset Form Input Obat
    function resetFormInputObat() {
        $('#permintaan_cari_obat').val('');
        $('#permintaan_kode_brng').val('');
        $('#permintaan_nama_brng').val('');
        $('#permintaan_satuan').val('');
        $('#lblObatTerpilih').text('-');
        $('#lblStokDepo').text('0');
        $('#lblSatuanObat').text('Sat');
        $('#permintaan_jml').val('1');
        $('#permintaan_aturan_pakai').val('');
        setPresetJam('clear');
        $('#permintaan_dropdown_obat').addClass('d-none').empty();
    }

    // Batal Mode Edit Item
    function batalEditItemSementara() {
        itemEditIndex = null;
        resetFormInputObat();
        $('#btnBatalEditItem').addClass('d-none');
        $('#btnTambahItemPermintaan').removeClass('btn-warning').addClass('btn-success')
            .html('<i class="bi bi-plus-lg me-1"></i> Tambahkan ke Daftar Order');
    }

    // Set Preset Jadwal Jam (Pagi, Malam, 2x, 3x, 4x, etc.)
    function setPresetJam(mode) {
        $('.chk-jam-order').prop('checked', false);

        if (mode === '1x_pagi') {
            $('#chk_jam07').prop('checked', true);
        } else if (mode === '1x_malam') {
            $('#chk_jam19').prop('checked', true);
        } else if (mode === '2x') {
            $('#chk_jam07, #chk_jam19').prop('checked', true);
        } else if (mode === '3x') {
            $('#chk_jam07, #chk_jam13, #chk_jam19').prop('checked', true);
        } else if (mode === '4x') {
            $('#chk_jam07, #chk_jam13, #chk_jam19, #chk_jam01').prop('checked', true);
        } else if (mode === '8h') {
            $('#chk_jam06, #chk_jam14, #chk_jam22').prop('checked', true);
        }
    }

    // Autocomplete pencarian obat
    let timerCariObat;
    $('#permintaan_cari_obat').on('input', function() {
        clearTimeout(timerCariObat);
        const keyword = $(this).val();
        if (keyword.length < 2) {
            $('#permintaan_dropdown_obat').addClass('d-none').empty();
            return;
        }

        timerCariObat = setTimeout(function() {
            $.get("{{ url('/obat/cari') }}", {
                nama: keyword,
                gudang: 'RM'
            }).done(function(res) {
                const list = res?.data || [];
                const $dropdown = $('#permintaan_dropdown_obat');
                $dropdown.empty();

                if (list.length === 0) {
                    $dropdown.append('<div class="list-group-item list-group-item-action disabled text-muted py-2">Obat tidak ditemukan</div>');
                } else {
                    list.forEach(function(item) {
                        let stok = 0;
                        if (item.gudang_barang && item.gudang_barang.length > 0) {
                            stok = item.gudang_barang[0].stok || 0;
                        }
                        const sat = item.kode_satuan?.satuan || item.kode_sat || '';
                        const rowHtml = `
                            <a href="javascript:void(0)" class="list-group-item list-group-item-action py-1.5 px-2.5" onclick="pilihObatPermintaan('${item.kode_brng}', '${item.nama_brng.replace(/'/g, "\\'")}', '${sat}', ${stok})">
                                <div class="d-flex justify-content-between align-items-center">
                                    <strong style="font-size: 11.5px;">${item.nama_brng}</strong>
                                    <span class="badge ${stok > 0 ? 'bg-success' : 'bg-danger'} rounded-pill" style="font-size: 10px;">Stok: ${stok} ${sat}</span>
                                </div>
                                <small class="text-muted" style="font-size: 10px;">Kode: ${item.kode_brng} | Jns: ${item.jenis?.nama || '-'}</small>
                            </a>
                        `;
                        $dropdown.append(rowHtml);
                    });
                }
                $dropdown.removeClass('d-none');
            });
        }, 300);
    });

    // Callback saat obat dipilih
    function pilihObatPermintaan(kode, nama, satuan, stok) {
        $('#permintaan_kode_brng').val(kode);
        $('#permintaan_nama_brng').val(nama);
        $('#permintaan_satuan').val(satuan);
        $('#permintaan_cari_obat').val(nama);
        $('#lblObatTerpilih').text(nama);
        $('#lblStokDepo').text(`${stok} ${satuan}`);
        $('#lblSatuanObat').text(satuan);
        $('#permintaan_dropdown_obat').addClass('d-none').empty();
        $('#permintaan_jml').focus();
    }

    // Sembunyikan dropdown bila klik di luar
    $(document).on('click', function(e) {
        if (!$(e.target).closest('#permintaan_cari_obat, #permintaan_dropdown_obat').length) {
            $('#permintaan_dropdown_obat').addClass('d-none');
        }
    });

    // Tambah / Update item ke tabel sementara
    $('#btnTambahItemPermintaan').on('click', function() {
        const kode = $('#permintaan_kode_brng').val();
        const nama = $('#permintaan_nama_brng').val();
        const satuan = $('#permintaan_satuan').val() || 'Sat';
        const jml = parseFloat($('#permintaan_jml').val()) || 0;
        const aturan = $('#permintaan_aturan_pakai').val() || '-';

        if (!kode || !nama) {
            Swal.fire('Peringatan', 'Silahkan pilih obat terlebih dahulu.', 'warning');
            return;
        }

        if (jml <= 0) {
            Swal.fire('Peringatan', 'Jumlah obat harus lebih dari 0.', 'warning');
            return;
        }

        // Kumpulkan jam yang dicentang
        const jamObj = {};
        const jamAktifList = [];
        for (let i = 0; i <= 23; i++) {
            const pad = String(i).padStart(2, '0');
            const key = `jam${pad}`;
            const isChecked = $(`#chk_${key}`).is(':checked');
            jamObj[key] = isChecked;
            if (isChecked) {
                jamAktifList.push(`${pad}:00`);
            }
        }

        if (itemEditIndex !== null && listOrderSementara[itemEditIndex]) {
            // Mode UPDATE
            listOrderSementara[itemEditIndex].kode_brng = kode;
            listOrderSementara[itemEditIndex].nama_brng = nama;
            listOrderSementara[itemEditIndex].satuan = satuan;
            listOrderSementara[itemEditIndex].jml = jml;
            listOrderSementara[itemEditIndex].aturan_pakai = aturan;
            listOrderSementara[itemEditIndex].jam = jamObj;
            listOrderSementara[itemEditIndex].jam_list = jamAktifList;
            batalEditItemSementara();
        } else {
            // Mode TAMBAH BARU (cek duplikasi)
            const existingIdx = listOrderSementara.findIndex(i => i.kode_brng === kode);
            if (existingIdx !== -1) {
                listOrderSementara[existingIdx].jml += jml;
                listOrderSementara[existingIdx].aturan_pakai = aturan;
                listOrderSementara[existingIdx].jam = jamObj;
                listOrderSementara[existingIdx].jam_list = jamAktifList;
            } else {
                listOrderSementara.push({
                    kode_brng: kode,
                    nama_brng: nama,
                    satuan: satuan,
                    jml: jml,
                    aturan_pakai: aturan,
                    jam: jamObj,
                    jam_list: jamAktifList,
                });
            }
            resetFormInputObat();
        }

        renderTableItemSementara();
        $('#permintaan_cari_obat').focus();
    });

    // Edit Item (Muat kembali ke Form Input)
    function editItemSementara(idx) {
        if (!listOrderSementara[idx]) return;
        const item = listOrderSementara[idx];
        itemEditIndex = idx;

        $('#permintaan_kode_brng').val(item.kode_brng);
        $('#permintaan_nama_brng').val(item.nama_brng);
        $('#permintaan_satuan').val(item.satuan);
        $('#permintaan_cari_obat').val(item.nama_brng);
        $('#lblObatTerpilih').text(item.nama_brng);
        $('#lblSatuanObat').text(item.satuan);
        $('#permintaan_jml').val(item.jml);
        $('#permintaan_aturan_pakai').val(item.aturan_pakai !== '-' ? item.aturan_pakai : '');

        // Pulihkan centang jam
        $('.chk-jam-order').prop('checked', false);
        for (let h = 0; h <= 23; h++) {
            const key = `jam${String(h).padStart(2, '0')}`;
            if (item.jam && item.jam[key]) {
                $(`#chk_${key}`).prop('checked', true);
            }
        }

        // Tampilkan tombol Batal & ubah tombol Simpan
        $('#btnBatalEditItem').removeClass('d-none');
        $('#btnTambahItemPermintaan').removeClass('btn-success').addClass('btn-warning')
            .html('<i class="bi bi-check-lg me-1"></i> Simpan Perubahan');

        // Scroll halus ke form dan fokus ke input jumlah
        document.getElementById('formPermintaanObatRanap').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        $('#permintaan_jml').focus().select();
    }

    // Ubah Jumlah Langsung dari Tabel (Inline)
    function ubahJumlahItemSementara(idx, val) {
        const num = parseFloat(val);
        if (isNaN(num) || num <= 0) {
            Swal.fire('Peringatan', 'Jumlah obat harus lebih dari 0.', 'warning');
            renderTableItemSementara();
            return;
        }

        if (listOrderSementara[idx]) {
            listOrderSementara[idx].jml = num;
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true
            });
            Toast.fire({
                icon: 'success',
                title: `Jumlah ${listOrderSementara[idx].nama_brng} diubah jadi ${num}`
            });
        }
    }

    // Render tabel item sementara
    function renderTableItemSementara() {
        const $tbody = $('#tbodyItemPermintaanSementara');
        $tbody.empty();

        if (listOrderSementara.length === 0) {
            $tbody.html(`
                <tr>
                    <td colspan="8" class="text-center text-muted py-3">
                        <i>Belum ada item obat yang ditambahkan. Silahkan cari obat dan klik Tambahkan.</i>
                    </td>
                </tr>
            `);
            $('#lblTotalItemOrder').text('Total Item: 0 obat');
            return;
        }

        listOrderSementara.forEach(function(item, idx) {
            let jamBadge = '-';
            if (item.jam_list && item.jam_list.length > 0) {
                jamBadge = item.jam_list.map(j => `<span class="badge bg-success-subtle text-success border border-success me-1" style="font-size: 9.5px;">${j}</span>`).join(' ');
            }

            const tr = `
                <tr class="${itemEditIndex === idx ? 'table-warning' : ''}">
                    <td class="text-center">${idx + 1}</td>
                    <td class="font-monospace">${item.kode_brng}</td>
                    <td><strong>${item.nama_brng}</strong></td>
                    <td class="text-center" style="width: 90px;">
                        <input type="number" class="form-control form-control-sm text-center fw-bold py-0.5 px-1 shadow-sm" value="${item.jml}" min="0.1" step="any" onchange="ubahJumlahItemSementara(${idx}, this.value)" style="font-size: 11.5px;" title="Ketik angka untuk ubah langsung">
                    </td>
                    <td class="text-center">${item.satuan}</td>
                    <td>${item.aturan_pakai}</td>
                    <td>${jamBadge}</td>
                    <td class="text-center text-nowrap">
                        <button type="button" class="btn btn-outline-warning btn-sm p-1 me-1" onclick="editItemSementara(${idx})" title="Edit Lengkap (Aturan / Jam / Dosis)">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                        <button type="button" class="btn btn-outline-danger btn-sm p-1" onclick="hapusItemSementara(${idx})" title="Hapus Baris">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
            `;
            $tbody.append(tr);
        });

        $('#lblTotalItemOrder').text(`Total Item: ${listOrderSementara.length} obat`);
    }

    function hapusItemSementara(index) {
        if (itemEditIndex === index) {
            batalEditItemSementara();
        }
        listOrderSementara.splice(index, 1);
        renderTableItemSementara();
    }

    // Kirim Permintaan ke Farmasi (Submit Order)
    $('#btnKirimOrderFarmasi').on('click', function() {
        const noRawat = $('#permintaan_no_rawat').val();
        const kdDokter = $('#permintaan_kd_dokter').val();

        if (listOrderSementara.length === 0) {
            Swal.fire('Peringatan', 'Daftar item order masih kosong.', 'warning');
            return;
        }

        if (!noRawat || !kdDokter) {
            Swal.fire('Peringatan', 'Data dokter DPJP / No. Rawat belum terisi.', 'warning');
            return;
        }

        Swal.fire({
            title: 'Kirim Permintaan?',
            text: `Kirim ${listOrderSementara.length} item obat ke Farmasi untuk disiapkan?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#198754',
            confirmButtonText: 'Ya, Kirim ke Farmasi',
            cancelButtonText: 'Batal'
        }).then((res) => {
            if (res.isConfirmed) {
                // Siapkan payload
                const obatPayload = listOrderSementara.map(i => {
                    const row = {
                        kode_brng: i.kode_brng,
                        jml: i.jml,
                        aturan_pakai: i.aturan_pakai,
                    };
                    for (let h = 0; h <= 23; h++) {
                        const key = `jam${String(h).padStart(2, '0')}`;
                        row[key] = i.jam[key] ? 'true' : 'false';
                    }
                    return row;
                });

                $.ajax({
                    url: "{{ route('ranap.permintaan-obat.simpan') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        no_rawat: noRawat,
                        kd_dokter: kdDokter,
                        obat: obatPayload
                    },
                    beforeSend: function() {
                        Swal.fire({
                            title: 'Mengirim...',
                            allowOutsideClick: false,
                            didOpen: () => { Swal.showLoading(); }
                        });
                    },
                    success: function(response) {
                        Swal.fire('Berhasil!', response.message || 'Permintaan berhasil dikirim ke Farmasi', 'success');
                        listOrderSementara = [];
                        renderTableItemSementara();
                        // Pindah ke Tab Riwayat
                        $('#tab-riwayat-order-link').tab('show');
                        loadRiwayatPermintaanPasien();
                    },
                    error: function(xhr) {
                        const msg = xhr.responseJSON?.message || 'Terjadi kesalahan saat menyimpan permintaan.';
                        Swal.fire('Gagal!', msg, 'error');
                    }
                });
            }
        });
    });

    // Pindah ke tab riwayat
    $('#tab-riwayat-order-link').on('shown.bs.tab', function() {
        loadRiwayatPermintaanPasien();
    });

    // Load Riwayat Permintaan Pasien
    function loadRiwayatPermintaanPasien() {
        const noRawat = $('#permintaan_no_rawat').val();
        if (!noRawat) return;

        const $tbody = $('#tbodyRiwayatPermintaanRanap');
        $tbody.html('<tr><td colspan="6" class="text-center text-muted py-3">Memuat riwayat permintaan...</td></tr>');

        $.get("{{ route('ranap.permintaan-obat.get') }}", { no_rawat: noRawat }).done(function(data) {
            $tbody.empty();
            if (!data || data.length === 0) {
                $tbody.html('<tr><td colspan="6" class="text-center text-muted py-3"><i>Belum ada permintaan obat untuk pasien ini.</i></td></tr>');
                return;
            }

            data.forEach(function(row) {
                const statusBadge = row.status === 'Sudah'
                    ? '<span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Sudah Disiapkan Farmasi</span>'
                    : '<span class="badge bg-warning text-dark"><i class="bi bi-hourglass-split me-1"></i> Menunggu Farmasi</span>';

                const waktuValidasi = row.status === 'Sudah'
                    ? `<small class="text-success">${row.tgl_validasi} ${row.jam_validasi}</small>`
                    : '<span class="text-muted">-</span>';

                let aksiHtml = `
                    <button type="button" class="btn btn-outline-info btn-sm py-0 px-2" onclick="showDetailPermintaanObat('${row.no_permintaan}')" title="Lihat Detail Item">
                        <i class="bi bi-eye"></i> Detail
                    </button>
                `;

                if (row.status === 'Belum') {
                    aksiHtml += `
                        <button type="button" class="btn btn-outline-success btn-sm py-0 px-2 ms-1" onclick="siapkanValidasiFarmasi('${row.no_permintaan}')" title="Validasi Farmasi">
                            <i class="bi bi-check2-circle"></i> Validasi
                        </button>
                        <button type="button" class="btn btn-outline-danger btn-sm py-0 px-2 ms-1" onclick="hapusPermintaanObat('${row.no_permintaan}')" title="Batalkan Permintaan">
                            <i class="bi bi-trash"></i>
                        </button>
                    `;
                }

                const tr = `
                    <tr>
                        <td class="font-monospace fw-bold text-primary">${row.no_permintaan}</td>
                        <td>${row.tgl_permintaan} ${row.jam}</td>
                        <td>${row.dokter?.nm_dokter || '-'}</td>
                        <td class="text-center">${statusBadge}</td>
                        <td class="text-center">${waktuValidasi}</td>
                        <td class="text-center">${aksiHtml}</td>
                    </tr>
                `;
                $tbody.append(tr);
            });
        });
    }

    // Detail Permintaan Modal
    let activeNoPermintaanDetail = '';
    function showDetailPermintaanObat(noPermintaan, forValidation = false) {
        activeNoPermintaanDetail = noPermintaan;
        $.get(`{{ url('/ranap/permintaan-obat/detail') }}/${noPermintaan}`).done(function(res) {
            $('#lblDetNoPermintaan').text(res.no_permintaan);
            $('#lblDetTglJam').text(`${res.tgl_permintaan} ${res.jam}`);
            $('#lblDetStatus').html(res.status === 'Sudah' ? '<span class="badge bg-success">Sudah Disiapkan</span>' : '<span class="badge bg-warning text-dark">Menunggu Farmasi</span>');
            $('#lblDetDokter').text(res.dokter?.nm_dokter || '-');

            if (forValidation && res.status === 'Belum') {
                $('#boxValidasiFarmasi').removeClass('d-none');
            } else {
                $('#boxValidasiFarmasi').addClass('d-none');
            }

            const $tbody = $('#tbodyDetailObatPermintaan');
            $tbody.empty();

            const details = res.detail_permintaan || [];
            if (details.length === 0) {
                $tbody.html('<tr><td colspan="6" class="text-center text-muted py-3">Tidak ada data detail obat.</td></tr>');
            } else {
                details.forEach(function(det, idx) {
                    // Extract active hours
                    const jamList = [];
                    for (let h = 0; h <= 23; h++) {
                        const key = `jam${String(h).padStart(2, '0')}`;
                        if (det[key] === 'true') {
                            jamList.push(`${String(h).padStart(2, '0')}:00`);
                        }
                    }
                    const jamStr = jamList.length > 0 ? jamList.map(j => `<span class="badge bg-success-subtle text-success border border-success me-0.5" style="font-size: 9px;">${j}</span>`).join(' ') : '-';

                    const tr = `
                        <tr>
                            <td class="text-center">${idx + 1}</td>
                            <td class="font-monospace">${det.kode_brng}</td>
                            <td><strong>${det.data_barang?.nama_brng || '-'}</strong></td>
                            <td class="text-center fw-bold">${det.jml}</td>
                            <td class="text-center">${det.data_barang?.kode_satuan?.satuan || det.data_barang?.kode_sat || '-'}</td>
                            <td>
                                <div>${det.aturan_pakai}</div>
                                <div class="mt-1">${jamStr}</div>
                            </td>
                        </tr>
                    `;
                    $tbody.append(tr);
                });
            }

            $('#modalDetailPermintaanObat').modal('show');
        });
    }

    function siapkanValidasiFarmasi(noPermintaan) {
        showDetailPermintaanObat(noPermintaan, true);
    }

    // Eksekusi Validasi Farmasi
    $('#btnEksekusiValidasiFarmasi').on('click', function() {
        if (!activeNoPermintaanDetail) return;
        const kdBangsal = $('#selDepoValidasiFarmasi').val() || 'RM';

        Swal.fire({
            title: 'Validasi & Siapkan Obat?',
            text: `Validasi permintaan ${activeNoPermintaanDetail} dan kurangi stok depo ${kdBangsal}?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#198754',
            confirmButtonText: 'Ya, Validasi Sekarang',
            cancelButtonText: 'Batal'
        }).then((res) => {
            if (res.isConfirmed) {
                $.ajax({
                    url: "{{ route('ranap.permintaan-obat.validasi') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        no_permintaan: activeNoPermintaanDetail,
                        kd_bangsal: kdBangsal
                    },
                    beforeSend: function() {
                        Swal.fire({ title: 'Memvalidasi...', allowOutsideClick: false, didOpen: () => { Swal.showLoading(); } });
                    },
                    success: function(resp) {
                        Swal.fire('Sukses!', resp.message || 'Obat berhasil disiapkan dan divalidasi ke Stok Pasien', 'success');
                        $('#modalDetailPermintaanObat').modal('hide');
                        loadRiwayatPermintaanPasien();
                    },
                    error: function(xhr) {
                        const msg = xhr.responseJSON?.message || 'Gagal memvalidasi permintaan';
                        Swal.fire('Gagal!', msg, 'error');
                    }
                });
            }
        });
    });

    // Hapus Permintaan Obat (Belum Dilayani)
    function hapusPermintaanObat(noPermintaan) {
        Swal.fire({
            title: 'Batalkan Permintaan?',
            text: `Apakah Anda yakin ingin membatalkan & menghapus order ${noPermintaan}?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            confirmButtonText: 'Ya, Batalkan',
            cancelButtonText: 'Tutup'
        }).then((res) => {
            if (res.isConfirmed) {
                $.ajax({
                    url: `{{ url('/ranap/permintaan-obat') }}/${noPermintaan}`,
                    type: "DELETE",
                    data: { _token: "{{ csrf_token() }}" },
                    success: function(resp) {
                        Swal.fire('Dihapus!', resp.message || 'Permintaan berhasil dihapus', 'success');
                        loadRiwayatPermintaanPasien();
                    },
                    error: function(xhr) {
                        const msg = xhr.responseJSON?.message || 'Gagal menghapus permintaan';
                        Swal.fire('Gagal!', msg, 'error');
                    }
                });
            }
        });
    }
</script>
@endpush
