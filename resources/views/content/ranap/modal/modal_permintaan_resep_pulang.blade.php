<!-- Modal Permintaan Resep Pulang Ranap -->
<div class="modal fade" id="modalPermintaanResepPulang" tabindex="-1" aria-labelledby="modalPermintaanResepPulangLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="modalPermintaanResepPulangLabel"><i>PERMINTAAN RESEP OBAT PULANG</i></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <!-- Info Pasien -->
                <div class="row gy-2 mb-3" id="formInfoPasienResepPulang">
                    <div class="col-lg-2 col-md-3 col-sm-6">
                        <label for="resep_pulang_no_rawat" class="form-label mb-1">No. Rawat</label>
                        <input type="text" class="form-control form-control-sm" id="resep_pulang_no_rawat" readonly>
                    </div>
                    <div class="col-lg-4 col-md-5 col-sm-6">
                        <label for="resep_pulang_nm_pasien" class="form-label mb-1">Pasien</label>
                        <input type="text" class="form-control form-control-sm" id="resep_pulang_nm_pasien" readonly>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <label for="resep_pulang_kamar" class="form-label mb-1">Kamar</label>
                        <input type="text" class="form-control form-control-sm" id="resep_pulang_kamar" readonly>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <label for="resep_pulang_dpjp" class="form-label mb-1">DPJP</label>
                        <input type="text" class="form-control form-control-sm" id="resep_pulang_dpjp" readonly>
                        <input type="hidden" id="resep_pulang_kd_dokter_dpjp">
                    </div>
                </div>

                <hr class="my-2">

                <!-- Nav Tabs -->
                <ul class="nav nav-tabs mb-3" id="tabResepPulang" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="tab-input-link" data-bs-toggle="tab" data-bs-target="#tab-input" type="button" role="tab">
                            Input Resep Pulang
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab-riwayat-link" data-bs-toggle="tab" data-bs-target="#tab-riwayat" type="button" role="tab">
                            Riwayat Permintaan <span class="badge bg-secondary ms-1" id="badgeJumlahRiwayatResepPulang">0</span>
                        </button>
                    </li>
                </ul>

                <div class="tab-content" id="tabResepPulangContent">
                    <!-- TAB 1: FORM INPUT -->
                    <div class="tab-pane fade show active" id="tab-input" role="tabpanel">
                        
                        <!-- Header Transaksi -->
                        <div class="row g-2 mb-3 align-items-end">
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label for="resep_pulang_no_permintaan" class="form-label mb-1">No. Permintaan</label>
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" id="resep_pulang_no_permintaan" readonly>
                                    <button class="btn btn-outline-secondary" type="button" onclick="refreshNomorPermintaanResepPulang()" title="Refresh Nomor">
                                        <i class="bi bi-arrow-clockwise"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-3 col-sm-6">
                                <label for="resep_pulang_tgl_permintaan" class="form-label mb-1">Tanggal</label>
                                <input type="date" class="form-control form-control-sm" id="resep_pulang_tgl_permintaan" value="{{ date('Y-m-d') }}">
                            </div>
                            <div class="col-lg-2 col-md-3 col-sm-6">
                                <label for="resep_pulang_jam_permintaan" class="form-label mb-1">Jam</label>
                                <input type="time" class="form-control form-control-sm" id="resep_pulang_jam_permintaan" value="{{ date('H:i') }}">
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label for="resep_pulang_kd_dokter" class="form-label mb-1">Dokter Peresep</label>
                                <select class="form-select form-select-sm" id="resep_pulang_kd_dokter">
                                    <option value="">-- Pilih Dokter --</option>
                                </select>
                            </div>
                            <div class="col-lg-2 col-md-6 col-sm-12">
                                <label for="resep_pulang_depo" class="form-label mb-1">Depo Farmasi</label>
                                <select class="form-select form-select-sm" id="resep_pulang_depo">
                                    <option value="RM" selected>Apotek Rinap (RM)</option>
                                    <option value="RM7">Apotek Rajal (RM7)</option>
                                    <option value="RM5">Gudang Farmasi (RM5)</option>
                                </select>
                            </div>
                        </div>

                        <!-- Pilihan Tipe Input: Non-Racikan vs Racikan -->
                        <ul class="nav nav-pills mb-2" id="pills-tipe-resep-pulang" role="tablist">
                            <li class="nav-item">
                                <button class="nav-link active py-1 px-3 btn-sm" id="btn-tipe-nonracikan" data-bs-toggle="pill" data-bs-target="#panel-nonracikan" type="button" role="tab" style="font-size: 12px;">
                                    <i class="bi bi-capsule me-1"></i> Obat Non-Racikan
                                </button>
                            </li>
                            <li class="nav-item ms-2">
                                <button class="nav-link py-1 px-3 btn-sm" id="btn-tipe-racikan" data-bs-toggle="pill" data-bs-target="#panel-racikan" type="button" role="tab" style="font-size: 12px;">
                                    <i class="bi bi-mortar-pestle me-1"></i> Obat Racikan
                                </button>
                            </li>
                        </ul>

                        <div class="tab-content mb-3" id="tabContentTipeResepPulang">
                            <!-- PANEL 1: OBAT NON-RACIKAN -->
                            <div class="tab-pane fade show active" id="panel-nonracikan" role="tabpanel">
                                <div class="card border bg-light">
                                    <div class="card-body p-3">
                                        <div class="row g-3 align-items-end">
                                            <div class="col-lg-5 col-md-5 col-sm-12 position-relative">
                                                <label class="form-label mb-1">Nama Obat</label>
                                                <input type="text" class="form-control form-control-sm" id="resep_pulang_cari_obat" placeholder="Ketik nama obat..." autocomplete="off">
                                                <input type="hidden" id="resep_pulang_selected_kode_brng">
                                                <input type="hidden" id="resep_pulang_selected_nama_brng">
                                                <input type="hidden" id="resep_pulang_selected_satuan">
                                                
                                                <div id="resep_pulang_dropdown_obat" class="list-group position-absolute w-100 shadow-sm d-none" style="z-index: 1060; max-height: 220px; overflow-y: auto;"></div>
                                            </div>

                                            <div class="col-lg-2 col-md-2 col-sm-4">
                                                <label class="form-label mb-1">Jumlah <span id="resep_pulang_label_satuan" class="text-muted"></span></label>
                                                <input type="number" step="any" min="0.1" class="form-control form-control-sm text-center" id="resep_pulang_input_jml" placeholder="0">
                                            </div>

                                            <div class="col-lg-4 col-md-3 col-sm-5">
                                                <label class="form-label mb-1">Aturan Pakai</label>
                                                <input type="text" class="form-control form-control-sm" id="resep_pulang_input_dosis" list="resep_pulang_list_dosis" placeholder="Contoh: 3 x 1 tablet sesudah makan" autocomplete="off">
                                            </div>

                                            <div class="col-lg-1 col-md-2 col-sm-3">
                                                <button type="button" class="btn btn-primary btn-sm w-100" onclick="tambahItemResepPulangKeDraft()">
                                                    <i class="bi bi-plus-lg"></i> Tambah
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- PANEL 2: OBAT RACIKAN -->
                            <div class="tab-pane fade" id="panel-racikan" role="tabpanel">
                                <div class="card border bg-light">
                                    <div class="card-body p-3">
                                        <!-- Header Racikan -->
                                        <div class="row g-2 mb-2">
                                            <div class="col-lg-4 col-md-5 col-sm-12">
                                                <label class="form-label mb-1">Nama Racikan <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control form-control-sm" id="racik_nama" placeholder="Contoh: Puyer Batuk Pilek">
                                            </div>
                                            <div class="col-lg-3 col-md-4 col-sm-6">
                                                <label class="form-label mb-1">Metode Racik</label>
                                                <select class="form-select form-select-sm" id="racik_metode" onchange="updateLabelKemasanRacikan()">
                                                    <option value="Puyer" selected>Puyer</option>
                                                    <option value="Kapsul">Kapsul</option>
                                                    <option value="Salep">Salep</option>
                                                    <option value="Sirup">Sirup</option>
                                                    <option value="Sachet">Sachet</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-2 col-md-3 col-sm-6">
                                                <label class="form-label mb-1">Jml Kemasan <span class="text-danger">*</span></label>
                                                <div class="input-group input-group-sm">
                                                    <input type="number" min="1" class="form-control text-center" id="racik_jml_kemasan" value="10">
                                                    <span class="input-group-text" id="racik_label_kemasan">bks</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-12 col-sm-12">
                                                <label class="form-label mb-1">Aturan Pakai <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control form-control-sm" id="racik_aturan_pakai" list="resep_pulang_list_dosis" placeholder="Contoh: 3 x 1 bungkus sesudah makan">
                                            </div>
                                        </div>

                                        <hr class="my-2">

                                        <!-- Input Bahan Obat Racikan -->
                                        <div class="p-2 mb-2 bg-white rounded border">
                                            <div class="d-flex justify-content-between align-items-center mb-2 pb-1 border-bottom">
                                                <span class="text-primary fw-bold" style="font-size: 11.5px;">
                                                    <i class="bi bi-calculator me-1"></i> Input Komposisi Bahan &amp; Perhitungan Dosis
                                                </span>
                                                <span class="text-muted" style="font-size: 11px;">
                                                    Kemasan Racikan: <strong class="text-dark" id="racik_badge_jml_kemasan">10</strong> <span id="racik_badge_satuan_kemasan">bks</span>
                                                </span>
                                            </div>

                                            <div class="row g-2 align-items-end">
                                                <!-- 1. Bahan Obat -->
                                                <div class="col-lg-4 col-md-12 position-relative">
                                                    <label class="form-label mb-1 fw-semibold" style="font-size: 11px;">Bahan Obat</label>
                                                    <input type="text" class="form-control form-control-sm" id="racik_cari_bahan" placeholder="Ketik nama bahan obat..." autocomplete="off">
                                                    <input type="hidden" id="racik_selected_kode_brng">
                                                    <input type="hidden" id="racik_selected_nama_brng">
                                                    <input type="hidden" id="racik_selected_satuan">
                                                    <input type="hidden" id="racik_selected_stok">
                                                    <div id="racik_dropdown_bahan" class="list-group position-absolute w-100 shadow-sm d-none" style="z-index: 1060; max-height: 200px; overflow-y: auto;"></div>
                                                </div>

                                                <!-- 2. Kapasitas (Kps) -->
                                                <div class="col-lg-2 col-md-3 col-sm-6">
                                                    <label class="form-label mb-1 fw-semibold" style="font-size: 11px;" title="Kekuatan sediaan obat per tablet/kapsul dari master data">
                                                        Kapasitas (Kps)
                                                    </label>
                                                    <div class="input-group input-group-sm">
                                                        <input type="number" step="any" min="0" class="form-control text-center" id="racik_bahan_kps" placeholder="0" title="Kapasitas kekuatan obat (mg)">
                                                        <span class="input-group-text px-1" style="font-size: 10.5px;">mg</span>
                                                    </div>
                                                </div>

                                                <!-- 3. Metode P1/P2 (Pecahan per Bungkus) -->
                                                <div class="col-lg-2 col-md-3 col-sm-6">
                                                    <label class="form-label mb-1 fw-semibold text-primary" style="font-size: 11px;" title="Dosis pecahan per kemasan (contoh: 1/2 tablet)">
                                                        P1 / P2 (Pecahan)
                                                    </label>
                                                    <div class="input-group input-group-sm">
                                                        <input type="number" step="any" min="0" class="form-control text-center px-1 fw-bold" id="racik_bahan_p1" placeholder="P1" value="1" title="Pembilang (P1)">
                                                        <span class="input-group-text px-1 fw-bold">/</span>
                                                        <input type="number" step="any" min="1" class="form-control text-center px-1 fw-bold" id="racik_bahan_p2" placeholder="P2" value="1" title="Penyebut (P2)">
                                                    </div>
                                                </div>

                                                <!-- 4. Kandungan / Dosis (mg) -->
                                                <div class="col-lg-2 col-md-3 col-sm-6">
                                                    <label class="form-label mb-1 fw-semibold text-success" style="font-size: 11px;" title="Dosis yang diinginkan per kemasan dalam mg">
                                                        Kandungan (Dosis)
                                                    </label>
                                                    <div class="input-group input-group-sm">
                                                        <input type="number" step="any" min="0" class="form-control text-center px-1" id="racik_bahan_kandungan" placeholder="0" title="Dosis per bungkus">
                                                        <span class="input-group-text px-1" style="font-size: 10.5px;">mg</span>
                                                    </div>
                                                </div>

                                                <!-- 5. Total Diambil -->
                                                <div class="col-lg-2 col-md-3 col-sm-6">
                                                    <label class="form-label mb-1 fw-semibold text-danger" style="font-size: 11px;" title="Total tablet/kapsul yang diambil untuk seluruh racikan">
                                                        Total Diambil <span id="racik_label_satuan" class="text-muted" style="font-size: 10px;"></span>
                                                    </label>
                                                    <div class="input-group input-group-sm">
                                                        <input type="number" step="any" min="0.01" class="form-control text-center fw-bold text-primary px-1" id="racik_bahan_jml" placeholder="0">
                                                        <button type="button" class="btn btn-primary px-2" onclick="tambahBahanKeRacikanSementara()" title="Tambah Bahan">
                                                            <i class="bi bi-plus-lg"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center mt-1 text-muted" style="font-size: 10.5px;">
                                                <span><i class="bi bi-info-circle me-1"></i>Isi <strong>P1/P2</strong> (misal: 1/2) atau <strong>Kandungan</strong> (misal: 250mg) &rarr; nilai lainnya &amp; <strong>Total Diambil</strong> otomatis terhitung sinkron.</span>
                                            </div>
                                        </div>

                                        <!-- Tabel Bahan Sementara -->
                                        <div class="table-responsive bg-white rounded border mb-2">
                                            <table class="table table-sm table-bordered mb-0" style="font-size: 11.5px;">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th style="width: 30px;" class="text-center">#</th>
                                                        <th>Nama Bahan Obat</th>
                                                        <th style="width: 90px;" class="text-center">Kps (mg)</th>
                                                        <th style="width: 80px;" class="text-center">P1 / P2</th>
                                                        <th style="width: 110px;" class="text-center">Kandungan</th>
                                                        <th style="width: 120px;" class="text-center">Total Diambil</th>
                                                        <th style="width: 45px;" class="text-center">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbodyBahanRacikanSementara">
                                                    <tr id="rowBahanRacikanKosong">
                                                        <td colspan="7" class="text-center text-muted py-2">Belum ada bahan obat pada racikan ini.</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="d-flex justify-content-end">
                                            <button type="button" class="btn btn-primary btn-sm" onclick="masukkanRacikanKeDraftResep()">
                                                <i class="bi bi-check2-circle me-1"></i> Masukkan Racikan ke Daftar Resep
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Datalist Aturan Pakai -->
                        <datalist id="resep_pulang_list_dosis">
                            <option value="1 x 1 tablet sehari sesudah makan (pagi)">
                            <option value="1 x 1 tablet sehari sesudah makan (malam)">
                            <option value="2 x 1 tablet sehari sesudah makan">
                            <option value="3 x 1 tablet sehari sesudah makan">
                            <option value="3 x 1 bungkus sehari sesudah makan">
                            <option value="2 x 1 bungkus sehari sesudah makan">
                            <option value="3 x 1 sendok teh sehari sesudah makan">
                            <option value="1 x 1 kapsul sehari sebelum makan">
                            <option value="2 x 1 kapsul sehari sebelum makan">
                            <option value="Bila demam / nyeri (prn)">
                            <option value="Dioleskan tipis 2x sehari">
                        </datalist>

                        <!-- Tabel Draft Obat -->
                        <div class="table-responsive mb-3">
                            <table class="table table-bordered table-striped table-sm" id="tableDraftResepPulang">
                                <thead>
                                    <tr>
                                        <th style="width: 40px;" class="text-center">No</th>
                                        <th style="width: 120px;">Kode Obat</th>
                                        <th>Nama Obat / Racikan</th>
                                        <th style="width: 90px;" class="text-center">Satuan</th>
                                        <th style="width: 90px;" class="text-center">Jumlah</th>
                                        <th>Aturan Pakai</th>
                                        <th style="width: 60px;" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="tbodyDraftResepPulang">
                                    <tr id="rowDraftKosong">
                                        <td colspan="7" class="text-center text-muted py-3">Belum ada obat yang ditambahkan.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="kosongkanDraftResepPulang()">
                                <i class="bi bi-trash"></i> Bersihkan
                            </button>
                            <button type="button" class="btn btn-success btn-sm" id="btnSimpanPermintaanResepPulang" onclick="kirimPermintaanResepPulang()">
                                <i class="bi bi-save me-1"></i> Simpan Permintaan
                            </button>
                        </div>

                    </div>

                    <!-- TAB 2: RIWAYAT PERMINTAAN -->
                    <div class="tab-pane fade" id="tab-riwayat" role="tabpanel">
                        <div class="d-flex justify-content-end mb-2">
                            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="loadRiwayatPermintaanResepPulang()">
                                <i class="bi bi-arrow-clockwise me-1"></i> Refresh
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-sm" id="tableRiwayatResepPulang">
                                <thead>
                                    <tr>
                                        <th style="width: 40px;" class="text-center">No</th>
                                        <th style="width: 140px;">No. Permintaan</th>
                                        <th style="width: 130px;">Tanggal &amp; Jam</th>
                                        <th>Dokter Peresep</th>
                                        <th>Rincian Obat / Racikan</th>
                                        <th style="width: 120px;" class="text-center">Status</th>
                                        <th style="width: 80px;" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="tbodyRiwayatResepPulang">
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-3">Memuat riwayat...</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-1"></i> Tutup
                </button>
            </div>

        </div>
    </div>
</div>

@push('script')
<script>
    let draftResepPulangItems = [];
    let listDokterResepPulangCache = [];
    let tempBahanRacikanItems = [];

    /**
     * Buka Modal Permintaan Resep Pulang
     */
    function bukaModalPermintaanResepPulang(no_rawat) {
        if (!no_rawat) return;

        // Reset draft & form
        draftResepPulangItems = [];
        tempBahanRacikanItems = [];
        renderDraftResepPulangTable();
        renderTableBahanRacikanSementara();

        // Reset non-racikan form
        $('#resep_pulang_cari_obat').val('');
        $('#resep_pulang_selected_kode_brng').val('');
        $('#resep_pulang_input_jml').val('');
        $('#resep_pulang_input_dosis').val('');
        $('#resep_pulang_dropdown_obat').addClass('d-none').empty();

        // Reset racikan form
        $('#racik_nama').val('');
        $('#racik_metode').val('Puyer');
        $('#racik_jml_kemasan').val('10');
        $('#racik_aturan_pakai').val('');
        $('#racik_cari_bahan').val('');
        $('#racik_selected_kode_brng').val('');
        $('#racik_bahan_kandungan').val('');
        $('#racik_bahan_jml').val('');
        $('#racik_dropdown_bahan').addClass('d-none').empty();
        updateLabelKemasanRacikan();

        // Switch to Tab 1 & non-racikan
        $('#tab-input-link').tab('show');
        $('#btn-tipe-nonracikan').tab('show');

        // Buka modal
        $('#modalPermintaanResepPulang').modal('show');

        // Gunakan getRegPeriksa standar ERM untuk mengisi data pasien
        getRegPeriksa(no_rawat).done(function(response) {
            const pasien = response.pasien || {};
            const dokter = response.dokter || {};

            let kamarText = '-';
            if (response.kamar_inap && response.kamar_inap.length > 0) {
                const ki = response.kamar_inap[0];
                const nmBangsal = ki.kamar?.bangsal?.nm_bangsal || '';
                const kdKamar = (ki.kd_kamar || '').replace(/[\r\n\t]+/g, ' ').trim();
                kamarText = nmBangsal ? `${nmBangsal} (${kdKamar})` : kdKamar;
            }

            $('#resep_pulang_no_rawat').val(no_rawat);
            $('#resep_pulang_nm_pasien').val(`${response.no_rkm_medis} - ${pasien.nm_pasien || '-'}`);
            $('#resep_pulang_kamar').val(kamarText);
            $('#resep_pulang_dpjp').val(dokter.nm_dokter || '-');
            $('#resep_pulang_kd_dokter_dpjp').val(response.kd_dokter || '');

            // Set dokter peresep default = DPJP
            loadDokterResepPulang(response.kd_dokter);
        }).fail(function() {
            $('#resep_pulang_no_rawat').val(no_rawat);
            loadDokterResepPulang();
        });

        // Generate nomor permintaan
        refreshNomorPermintaanResepPulang();

        // Muat riwayat
        loadRiwayatPermintaanResepPulang(no_rawat);
    }

    /**
     * Update label satuan kemasan racikan
     */
    function updateLabelKemasanRacikan() {
        const m = $('#racik_metode').val();
        let lbl = 'bks';
        if (m === 'Kapsul') lbl = 'kapsul';
        else if (m === 'Salep') lbl = 'pot';
        else if (m === 'Sirup') lbl = 'botol';
        else if (m === 'Sachet') lbl = 'sachet';
        $('#racik_label_kemasan').text(lbl);
    }

    /**
     * Generate Nomor Permintaan Baru
     */
    function refreshNomorPermintaanResepPulang() {
        const tgl = $('#resep_pulang_tgl_permintaan').val() || '';
        $.get("{{ route('resep-pulang.nomor') }}", { tgl_permintaan: tgl }).done(function(res) {
            if (res.status) {
                $('#resep_pulang_no_permintaan').val(res.no_permintaan);
            }
        });
    }

    $('#resep_pulang_tgl_permintaan').on('change', function() {
        refreshNomorPermintaanResepPulang();
    });

    /**
     * Muat Daftar Dokter
     */
    function loadDokterResepPulang(selectedKdDokter) {
        if (listDokterResepPulangCache.length > 0) {
            renderDropdownDokterResepPulang(selectedKdDokter);
            return;
        }

        $.get("{{ url('/dokter/ambil') }}").done(function(res) {
            listDokterResepPulangCache = Array.isArray(res) ? res : (res?.data || []);
            renderDropdownDokterResepPulang(selectedKdDokter);
        });
    }

    function renderDropdownDokterResepPulang(selectedKdDokter) {
        const $sel = $('#resep_pulang_kd_dokter');
        $sel.empty().append('<option value="">-- Pilih Dokter --</option>');

        listDokterResepPulangCache.forEach(function(d) {
            $sel.append(`<option value="${d.kd_dokter}">${d.nm_dokter}</option>`);
        });

        const targetDokter = selectedKdDokter || $('#resep_pulang_kd_dokter_dpjp').val();
        if (targetDokter) {
            $sel.val(targetDokter);
        }
    }

    /**
     * Autocomplete Pencarian Obat Non-Racikan
     */
    let timerCariObatResepPulang;
    $('#resep_pulang_cari_obat').on('input', function() {
        clearTimeout(timerCariObatResepPulang);
        const keyword = $(this).val().trim();
        const $dropdown = $('#resep_pulang_dropdown_obat');

        if (keyword.length < 2) {
            $dropdown.addClass('d-none').empty();
            return;
        }

        timerCariObatResepPulang = setTimeout(function() {
            const selectedDepo = $('#resep_pulang_depo').val() || 'RM';
            $.get("{{ url('/obat/cari') }}", {
                nama: keyword,
                gudang: selectedDepo
            }).done(function(res) {
                const list = res?.data || [];
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
                        const safeNama = item.nama_brng.replace(/'/g, "\\'");
                        const rowHtml = `
                            <a href="javascript:void(0)" class="list-group-item list-group-item-action py-1 px-2.5" onclick="pilihObatResepPulang('${item.kode_brng}', '${safeNama}', '${sat}', ${stok})">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span style="font-size: 12px;"><strong>${item.nama_brng}</strong></span>
                                    <span class="badge ${stok > 0 ? 'bg-success' : 'bg-danger'}" style="font-size: 10px;">${stok} ${sat}</span>
                                </div>
                            </a>
                        `;
                        $dropdown.append(rowHtml);
                    });
                }
                $dropdown.removeClass('d-none');
            });
        }, 250);
    });

    $('#resep_pulang_depo').on('change', function() {
        if ($('#resep_pulang_cari_obat').val().trim().length >= 2) {
            $('#resep_pulang_cari_obat').trigger('input');
        }
        if ($('#racik_cari_bahan').val().trim().length >= 2) {
            $('#racik_cari_bahan').trigger('input');
        }
    });

    $(document).on('click', function(e) {
        if (!$(e.target).closest('#resep_pulang_cari_obat, #resep_pulang_dropdown_obat').length) {
            $('#resep_pulang_dropdown_obat').addClass('d-none');
        }
        if (!$(e.target).closest('#racik_cari_bahan, #racik_dropdown_bahan').length) {
            $('#racik_dropdown_bahan').addClass('d-none');
        }
    });

    function pilihObatResepPulang(kode_brng, nama_brng, satuan, stok) {
        $('#resep_pulang_selected_kode_brng').val(kode_brng);
        $('#resep_pulang_selected_nama_brng').val(nama_brng);
        $('#resep_pulang_selected_satuan').val(satuan);

        $('#resep_pulang_cari_obat').val(nama_brng);
        $('#resep_pulang_label_satuan').text(`(${satuan})`);
        $('#resep_pulang_dropdown_obat').addClass('d-none').empty();

        $('#resep_pulang_input_jml').focus().select();
    }

    /**
     * Tambah Item Non-Racikan ke Draft
     */
    function tambahItemResepPulangKeDraft() {
        const kode_brng = $('#resep_pulang_selected_kode_brng').val();
        const nama_brng = $('#resep_pulang_selected_nama_brng').val();
        const satuan = $('#resep_pulang_selected_satuan').val() || '-';
        const jml = parseFloat($('#resep_pulang_input_jml').val());
        const dosis = $('#resep_pulang_input_dosis').val().trim();

        if (!kode_brng || !nama_brng) {
            alertPeringatan('Silakan pilih obat terlebih dahulu!');
            $('#resep_pulang_cari_obat').focus();
            return;
        }

        if (!jml || jml <= 0 || isNaN(jml)) {
            alertPeringatan('Jumlah obat harus lebih dari 0!');
            $('#resep_pulang_input_jml').focus();
            return;
        }

        if (!dosis) {
            alertPeringatan('Aturan pakai harus diisi!');
            $('#resep_pulang_input_dosis').focus();
            return;
        }

        const existingIndex = draftResepPulangItems.findIndex(i => i.type !== 'racikan' && i.kode_brng === kode_brng);
        if (existingIndex > -1) {
            draftResepPulangItems[existingIndex].jml = jml;
            draftResepPulangItems[existingIndex].dosis = dosis;
        } else {
            draftResepPulangItems.push({
                type: 'non-racikan',
                kode_brng: kode_brng,
                nama_brng: nama_brng,
                satuan: satuan,
                jml: jml,
                dosis: dosis
            });
        }

        $('#resep_pulang_cari_obat').val('');
        $('#resep_pulang_selected_kode_brng').val('');
        $('#resep_pulang_selected_nama_brng').val('');
        $('#resep_pulang_selected_satuan').val('');
        $('#resep_pulang_label_satuan').text('');
        $('#resep_pulang_input_jml').val('');
        $('#resep_pulang_input_dosis').val('');

        renderDraftResepPulangTable();
        $('#resep_pulang_cari_obat').focus();
    }

    /**
     * Autocomplete Pencarian Bahan Obat Racikan
     */
    let timerCariBahanRacikan;
    $('#racik_cari_bahan').on('input', function() {
        clearTimeout(timerCariBahanRacikan);
        const keyword = $(this).val().trim();
        const $dropdown = $('#racik_dropdown_bahan');

        if (keyword.length < 2) {
            $dropdown.addClass('d-none').empty();
            return;
        }

        timerCariBahanRacikan = setTimeout(function() {
            const selectedDepo = $('#resep_pulang_depo').val() || 'RM';
            $.get("{{ url('/obat/cari') }}", {
                nama: keyword,
                gudang: selectedDepo
            }).done(function(res) {
                const list = res?.data || [];
                $dropdown.empty();

                if (list.length === 0) {
                    $dropdown.append('<div class="list-group-item list-group-item-action disabled text-muted py-2">Bahan obat tidak ditemukan</div>');
                } else {
                    list.forEach(function(item) {
                        let stok = 0;
                        if (item.gudang_barang && item.gudang_barang.length > 0) {
                            stok = item.gudang_barang[0].stok || 0;
                        }
                        const sat = item.kode_satuan?.satuan || item.kode_sat || '';
                        const kps = parseFloat(item.kapasitas) || 0;
                        const safeNama = item.nama_brng.replace(/'/g, "\\'");
                        const rowHtml = `
                            <a href="javascript:void(0)" class="list-group-item list-group-item-action py-1 px-2.5" onclick="pilihBahanRacikan('${item.kode_brng}', '${safeNama}', '${sat}', ${stok}, ${kps})">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <span style="font-size: 12px;"><strong>${item.nama_brng}</strong></span>
                                        ${kps > 0 ? `<small class="text-muted ms-1">(Kps: ${kps} mg)</small>` : ''}
                                    </div>
                                    <span class="badge ${stok > 0 ? 'bg-success' : 'bg-danger'}" style="font-size: 10px;">${stok} ${sat}</span>
                                </div>
                            </a>
                        `;
                        $dropdown.append(rowHtml);
                    });
                }
                $dropdown.removeClass('d-none');
            });
        }, 250);
    });

    function pilihBahanRacikan(kode_brng, nama_brng, satuan, stok, kapasitas) {
        $('#racik_selected_kode_brng').val(kode_brng);
        $('#racik_selected_nama_brng').val(nama_brng);
        $('#racik_selected_satuan').val(satuan);
        $('#racik_selected_stok').val(stok);

        $('#racik_cari_bahan').val(nama_brng);
        $('#racik_label_satuan').text(`(${satuan})`);
        $('#racik_dropdown_bahan').addClass('d-none').empty();

        const kps = parseFloat(kapasitas) || 0;
        $('#racik_bahan_kps').val(kps > 0 ? kps : '');

        // Default pecahan 1 / 1
        $('#racik_bahan_p1').val(1);
        $('#racik_bahan_p2').val(1);

        hitungRacikanBahan('p1p2');

        $('#racik_bahan_p1').focus().select();
    }

    /**
     * Sederhanakan pecahan desimal / rasio
     */
    function sederhanakanPecahan(val1, val2) {
        if (!val1 || !val2 || val2 === 0) return { p1: 1, p2: 1 };
        const ratio = val1 / val2;
        const known = [
            { r: 0.125, p1: 1, p2: 8 },
            { r: 0.167, p1: 1, p2: 6 },
            { r: 0.2,   p1: 1, p2: 5 },
            { r: 0.25,  p1: 1, p2: 4 },
            { r: 0.333, p1: 1, p2: 3 },
            { r: 0.5,   p1: 1, p2: 2 },
            { r: 0.667, p1: 2, p2: 3 },
            { r: 0.75,  p1: 3, p2: 4 },
            { r: 1.0,   p1: 1, p2: 1 },
            { r: 1.5,   p1: 3, p2: 2 },
            { r: 2.0,   p1: 2, p2: 1 },
            { r: 3.0,   p1: 3, p2: 1 }
        ];

        for (let k of known) {
            if (Math.abs(ratio - k.r) < 0.02) {
                return { p1: k.p1, p2: k.p2 };
            }
        }

        function gcd(x, y) {
            x = Math.round(Math.abs(x) * 100);
            y = Math.round(Math.abs(y) * 100);
            while (y) {
                let t = y;
                y = x % y;
                x = t;
            }
            return x;
        }

        const divisor = gcd(val1, val2);
        if (divisor > 0) {
            let p1 = Math.round((val1 * 100) / divisor);
            let p2 = Math.round((val2 * 100) / divisor);
            if (p1 > 0 && p2 > 0 && p1 < 100 && p2 < 100) {
                return { p1: p1, p2: p2 };
            }
        }

        return {
            p1: Math.round(val1 * 100) / 100,
            p2: Math.round(val2 * 100) / 100
        };
    }

    /**
     * Hitung Otomatis Racikan Bahan (Metode P1/P2, Kandungan, Total Diambil, & Kps)
     */
    function hitungRacikanBahan(source) {
        const jmlKemasan = parseFloat($('#racik_jml_kemasan').val()) || 1;
        const kps = parseFloat($('#racik_bahan_kps').val()) || 0;

        let p1 = parseFloat($('#racik_bahan_p1').val());
        let p2 = parseFloat($('#racik_bahan_p2').val());
        let kandungan = parseFloat($('#racik_bahan_kandungan').val());
        let jml = parseFloat($('#racik_bahan_jml').val());

        if (source === 'p1p2' || source === 'kemasan') {
            if (isNaN(p1) || p1 < 0) p1 = 1;
            if (isNaN(p2) || p2 <= 0) p2 = 1;

            const fraction = p1 / p2;
            const total = fraction * jmlKemasan;
            $('#racik_bahan_jml').val(Math.round(total * 100) / 100);

            if (kps > 0) {
                const dosis = kps * fraction;
                $('#racik_bahan_kandungan').val(Math.round(dosis * 100) / 100);
            }
        } else if (source === 'kandungan') {
            if (!isNaN(kandungan) && kandungan > 0 && kps > 0) {
                // Sesuai rumus farmasi SIMRS Khanza: Total = (Jml Kemasan * Kandungan) / Kapasitas
                const total = (jmlKemasan * kandungan) / kps;
                $('#racik_bahan_jml').val(Math.round(total * 100) / 100);

                const simplified = sederhanakanPecahan(kandungan, kps);
                $('#racik_bahan_p1').val(simplified.p1);
                $('#racik_bahan_p2').val(simplified.p2);
            }
        } else if (source === 'jml') {
            if (!isNaN(jml) && jml > 0 && jmlKemasan > 0) {
                const simplified = sederhanakanPecahan(jml, jmlKemasan);
                $('#racik_bahan_p1').val(simplified.p1);
                $('#racik_bahan_p2').val(simplified.p2);

                if (kps > 0) {
                    const dosis = (jml * kps) / jmlKemasan;
                    $('#racik_bahan_kandungan').val(Math.round(dosis * 100) / 100);
                }
            }
        } else if (source === 'kps') {
            if (!isNaN(p1) && !isNaN(p2) && p2 > 0 && kps > 0) {
                const dosis = kps * (p1 / p2);
                $('#racik_bahan_kandungan').val(Math.round(dosis * 100) / 100);
            }
        }
    }

    // Event listener sinkronisasi form racikan
    $(document).on('input change', '#racik_jml_kemasan', function() {
        const val = $(this).val() || 1;
        $('#racik_badge_jml_kemasan').text(val);
        hitungRacikanBahan('kemasan');
    });

    $(document).on('input', '#racik_bahan_p1, #racik_bahan_p2', function() {
        hitungRacikanBahan('p1p2');
    });

    $(document).on('input', '#racik_bahan_kandungan', function() {
        hitungRacikanBahan('kandungan');
    });

    $(document).on('input', '#racik_bahan_kps', function() {
        hitungRacikanBahan('kps');
    });

    $(document).on('input', '#racik_bahan_jml', function() {
        hitungRacikanBahan('jml');
    });

    /**
     * Tambah Bahan ke Tabel Racikan Sementara
     */
    function tambahBahanKeRacikanSementara() {
        const kode_brng = $('#racik_selected_kode_brng').val();
        const nama_brng = $('#racik_selected_nama_brng').val();
        const satuan = $('#racik_selected_satuan').val() || '-';
        const kps = parseFloat($('#racik_bahan_kps').val()) || 0;
        const p1 = parseFloat($('#racik_bahan_p1').val()) || 1;
        const p2 = parseFloat($('#racik_bahan_p2').val()) || 1;
        const kandungan = parseFloat($('#racik_bahan_kandungan').val()) || 0;
        const jml = parseFloat($('#racik_bahan_jml').val());

        if (!kode_brng || !nama_brng) {
            alertPeringatan('Silakan pilih bahan obat terlebih dahulu!');
            $('#racik_cari_bahan').focus();
            return;
        }

        if (!jml || jml <= 0 || isNaN(jml)) {
            alertPeringatan('Total obat yang diambil harus lebih dari 0!');
            $('#racik_bahan_jml').focus();
            return;
        }

        const existingIdx = tempBahanRacikanItems.findIndex(b => b.kode_brng === kode_brng);
        const itemData = {
            kode_brng: kode_brng,
            nama_brng: nama_brng,
            satuan: satuan,
            kps: kps,
            p1: p1,
            p2: p2,
            kandungan: kandungan,
            jml: jml
        };

        if (existingIdx > -1) {
            tempBahanRacikanItems[existingIdx] = itemData;
        } else {
            tempBahanRacikanItems.push(itemData);
        }

        // Reset input fields
        $('#racik_cari_bahan').val('');
        $('#racik_selected_kode_brng').val('');
        $('#racik_selected_nama_brng').val('');
        $('#racik_selected_satuan').val('');
        $('#racik_selected_stok').val('');
        $('#racik_bahan_kps').val('');
        $('#racik_bahan_p1').val('1');
        $('#racik_bahan_p2').val('1');
        $('#racik_bahan_kandungan').val('');
        $('#racik_bahan_jml').val('');
        $('#racik_label_satuan').text('');

        renderTableBahanRacikanSementara();
        $('#racik_cari_bahan').focus();
    }

    function renderTableBahanRacikanSementara() {
        const $tbody = $('#tbodyBahanRacikanSementara');
        $tbody.empty();

        if (tempBahanRacikanItems.length === 0) {
            $tbody.html(`
                <tr id="rowBahanRacikanKosong">
                    <td colspan="7" class="text-center text-muted py-2">Belum ada bahan obat pada racikan ini.</td>
                </tr>
            `);
            return;
        }

        tempBahanRacikanItems.forEach(function(b, idx) {
            const kpsText = b.kps > 0 ? `${b.kps} mg` : '-';
            const p1p2Text = `<span class="badge bg-light text-dark border font-monospace">${b.p1} / ${b.p2}</span>`;
            const kandunganText = b.kandungan > 0 ? `${b.kandungan} mg` : '-';

            const tr = `
                <tr>
                    <td class="text-center align-middle">${idx + 1}</td>
                    <td class="align-middle">
                        <strong>${b.nama_brng}</strong>
                        <div class="text-muted" style="font-size: 10px;">Kode: ${b.kode_brng}</div>
                    </td>
                    <td class="text-center align-middle">${kpsText}</td>
                    <td class="text-center align-middle">${p1p2Text}</td>
                    <td class="text-center align-middle font-monospace">${kandunganText}</td>
                    <td class="text-center align-middle">
                        <strong class="text-primary font-monospace">${b.jml}</strong> <small class="text-muted">${b.satuan}</small>
                    </td>
                    <td class="text-center align-middle">
                        <button type="button" class="btn btn-outline-danger btn-sm py-0 px-1" onclick="hapusBahanRacikanSementara(${idx})" title="Hapus Bahan">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
            `;
            $tbody.append(tr);
        });
    }

    function hapusBahanRacikanSementara(idx) {
        tempBahanRacikanItems.splice(idx, 1);
        renderTableBahanRacikanSementara();
    }

    /**
     * Masukkan Racikan Utuh ke Draft Resep Pulang
     */
    function masukkanRacikanKeDraftResep() {
        const nama_racik = $('#racik_nama').val().trim();
        const metode = $('#racik_metode').val();
        const jml_kemasan = parseInt($('#racik_jml_kemasan').val()) || 0;
        const aturan_pakai = $('#racik_aturan_pakai').val().trim();

        if (!nama_racik) {
            alertPeringatan('Nama Racikan harus diisi!');
            $('#racik_nama').focus();
            return;
        }

        if (jml_kemasan <= 0) {
            alertPeringatan('Jumlah kemasan racikan harus minimal 1!');
            $('#racik_jml_kemasan').focus();
            return;
        }

        if (!aturan_pakai) {
            alertPeringatan('Aturan pakai racikan harus diisi!');
            $('#racik_aturan_pakai').focus();
            return;
        }

        if (tempBahanRacikanItems.length === 0) {
            alertPeringatan('Bahan racikan masih kosong! Tambahkan minimal 1 bahan obat.');
            $('#racik_cari_bahan').focus();
            return;
        }

        draftResepPulangItems.push({
            type: 'racikan',
            id: 'RCK_' + Date.now(),
            nama_racik: nama_racik,
            metode: metode,
            jml_kemasan: jml_kemasan,
            aturan_pakai: aturan_pakai,
            bahan: JSON.parse(JSON.stringify(tempBahanRacikanItems))
        });

        // Reset form racikan
        $('#racik_nama').val('');
        $('#racik_aturan_pakai').val('');
        tempBahanRacikanItems = [];
        renderTableBahanRacikanSementara();

        renderDraftResepPulangTable();
        alertSukses(`Racikan "${nama_racik}" berhasil ditambahkan ke daftar!`);
    }

    /**
     * Render Tabel Draft Utama (Non-Racikan + Racikan)
     */
    function renderDraftResepPulangTable() {
        const $tbody = $('#tbodyDraftResepPulang');
        $tbody.empty();

        if (draftResepPulangItems.length === 0) {
            $tbody.html(`
                <tr id="rowDraftKosong">
                    <td colspan="7" class="text-center text-muted py-3">Belum ada obat yang ditambahkan.</td>
                </tr>
            `);
            return;
        }

        draftResepPulangItems.forEach(function(item, idx) {
            if (item.type === 'racikan') {
                let listBahanHtml = '<ul class="mb-0 ps-3" style="font-size: 11px;">';
                item.bahan.forEach(function(b) {
                    let detKandungan = [];
                    if (b.kps > 0) detKandungan.push(`Kps: ${b.kps}mg`);
                    if (b.p1 && b.p2) detKandungan.push(`P: ${b.p1}/${b.p2}`);
                    if (b.kandungan > 0) detKandungan.push(`Dosis: ${b.kandungan}mg`);
                    const detStr = detKandungan.length > 0 ? ` <span class="text-muted">(${detKandungan.join(', ')})</span>` : '';
                    listBahanHtml += `<li><strong>${b.nama_brng}</strong>: <strong>${b.jml}</strong> ${b.satuan}${detStr}</li>`;
                });
                listBahanHtml += '</ul>';

                const tr = `
                    <tr class="table-light">
                        <td class="text-center align-top fw-bold text-primary">${idx + 1}</td>
                        <td class="align-top font-monospace text-muted">-</td>
                        <td class="align-top" colspan="3">
                            <div class="d-flex align-items-center mb-1">
                                <span class="badge bg-primary me-2"><i class="bi bi-mortar-pestle me-1"></i>RACIKAN (${item.metode})</span>
                                <strong class="fs-6">${item.nama_racik}</strong>
                                <span class="badge bg-secondary ms-2">${item.jml_kemasan} ${item.metode}</span>
                            </div>
                            <div class="border rounded p-1.5 bg-white">
                                <div class="text-muted small mb-0.5"><strong>Komposisi Bahan:</strong></div>
                                ${listBahanHtml}
                            </div>
                        </td>
                        <td class="align-top">
                            <span class="fw-semibold text-dark">${item.aturan_pakai}</span>
                        </td>
                        <td class="text-center align-top">
                            <button type="button" class="btn btn-danger btn-sm py-0 px-1.5" onclick="hapusItemDraftResepPulang(${idx})" title="Hapus Seluruh Racikan">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                `;
                $tbody.append(tr);
            } else {
                const tr = `
                    <tr>
                        <td class="text-center">${idx + 1}</td>
                        <td>${item.kode_brng}</td>
                        <td><strong>${item.nama_brng}</strong></td>
                        <td class="text-center">${item.satuan}</td>
                        <td class="text-center">${item.jml}</td>
                        <td>${item.dosis}</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-danger btn-sm py-0 px-1.5" onclick="hapusItemDraftResepPulang(${idx})" title="Hapus">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                `;
                $tbody.append(tr);
            }
        });
    }

    function hapusItemDraftResepPulang(index) {
        draftResepPulangItems.splice(index, 1);
        renderDraftResepPulangTable();
    }

    function kosongkanDraftResepPulang() {
        draftResepPulangItems = [];
        tempBahanRacikanItems = [];
        renderTableBahanRacikanSementara();
        renderDraftResepPulangTable();
    }

    /**
     * Kirim Permintaan Resep Pulang ke Farmasi (Opsi 1: Flatten Racikan ke format SIMRS Khanza)
     */
    function kirimPermintaanResepPulang() {
        const no_rawat = $('#resep_pulang_no_rawat').val();
        const kd_dokter = $('#resep_pulang_kd_dokter').val();
        const tgl_permintaan = $('#resep_pulang_tgl_permintaan').val();
        const jam = $('#resep_pulang_jam_permintaan').val();

        if (!no_rawat) {
            alertError('Data no rawat tidak valid!');
            return;
        }

        if (!kd_dokter) {
            alertPeringatan('Silakan pilih Dokter Peresep terlebih dahulu!');
            $('#resep_pulang_kd_dokter').focus();
            return;
        }

        if (draftResepPulangItems.length === 0) {
            alertPeringatan('Daftar obat masih kosong! Masukkan minimal 1 obat atau racikan.');
            return;
        }

        // Flatten data agar sesuai tabel detail_permintaan_resep_pulang SIMRS Khanza
        let itemsToSend = [];
        draftResepPulangItems.forEach(item => {
            if (item.type === 'racikan') {
                item.bahan.forEach(b => {
                    let detBahan = [];
                    if (b.p1 && b.p2) detBahan.push(`P:${b.p1}/${b.p2}`);
                    if (b.kandungan > 0) detBahan.push(`${b.kandungan}mg`);
                    const detStr = detBahan.length > 0 ? ` [${detBahan.join(' ')}]` : '';
                    const dosisRacik = `[Racikan: ${item.nama_racik} (${item.jml_kemasan} ${item.metode})] ${item.aturan_pakai}${detStr}`;
                    itemsToSend.push({
                        kode_brng: b.kode_brng,
                        jml: b.jml,
                        dosis: dosisRacik
                    });
                });
            } else {
                itemsToSend.push({
                    kode_brng: item.kode_brng,
                    jml: item.jml,
                    dosis: item.dosis
                });
            }
        });

        const $btn = $('#btnSimpanPermintaanResepPulang');
        $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1"></span> Menyimpan...');

        $.ajax({
            url: "{{ route('resep-pulang.simpan') }}",
            method: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                no_rawat: no_rawat,
                kd_dokter: kd_dokter,
                tgl_permintaan: tgl_permintaan,
                jam: jam,
                items: itemsToSend
            },
            success: function(res) {
                $btn.prop('disabled', false).html('<i class="bi bi-save me-1"></i> Simpan Permintaan');
                if (res.status) {
                    alertSukses(res.message);
                    draftResepPulangItems = [];
                    tempBahanRacikanItems = [];
                    renderTableBahanRacikanSementara();
                    renderDraftResepPulangTable();
                    refreshNomorPermintaanResepPulang();
                    $('#tab-riwayat-link').tab('show');
                    loadRiwayatPermintaanResepPulang(no_rawat);
                } else {
                    alertError(res.message || 'Terjadi kesalahan sistem!');
                }
            },
            error: function(xhr) {
                $btn.prop('disabled', false).html('<i class="bi bi-save me-1"></i> Simpan Permintaan');
                const msg = xhr.responseJSON?.message || 'Gagal menyimpan permintaan resep pulang.';
                alertError(msg);
            }
        });
    }

    /**
     * Memuat Riwayat Permintaan
     */
    function loadRiwayatPermintaanResepPulang(no_rawat) {
        const targetNoRawat = no_rawat || $('#resep_pulang_no_rawat').val();
        if (!targetNoRawat) return;

        const noRawatClean = targetNoRawat.replace(/\//g, '-');
        const $tbody = $('#tbodyRiwayatResepPulang');
        $tbody.html('<tr><td colspan="7" class="text-center text-muted py-3">Memuat riwayat...</td></tr>');

        $.get(`/erm/resep-pulang/riwayat/${noRawatClean}`).done(function(res) {
            const list = res.data || [];
            $('#badgeJumlahRiwayatResepPulang').text(list.length);
            $tbody.empty();

            if (list.length === 0) {
                $tbody.html(`
                    <tr>
                        <td colspan="7" class="text-center text-muted py-3">Belum ada riwayat permintaan resep pulang.</td>
                    </tr>
                `);
                return;
            }

            list.forEach(function(item, idx) {
                const isBelum = item.status === 'Belum';
                const statusBadge = isBelum 
                    ? `<span class="badge bg-warning text-dark">Belum Divalidasi</span>`
                    : `<span class="badge bg-success">Sudah Divalidasi</span>`;

                let rincianHtml = '<ul class="mb-0 ps-3" style="font-size: 11.5px;">';
                if (item.detail && item.detail.length > 0) {
                    item.detail.forEach(function(d) {
                        const sat = d.barang?.kode_satuan?.satuan || d.barang?.kode_sat || '';
                        const isRacikan = (d.dosis || '').startsWith('[Racikan:');
                        const racikBadge = isRacikan ? '<span class="badge bg-primary text-white me-1" style="font-size: 9.5px;">Racikan</span>' : '';
                        rincianHtml += `<li>${racikBadge}<strong>${d.barang?.nama_brng || d.kode_brng}</strong> (${d.jml} ${sat}) - <i>${d.dosis || '-'}</i></li>`;
                    });
                } else {
                    rincianHtml += '<li>-</li>';
                }
                rincianHtml += '</ul>';

                let aksiBtn = '-';
                if (isBelum) {
                    aksiBtn = `
                        <button type="button" class="btn btn-danger btn-sm py-0 px-2" onclick="batalkanPermintaanResepPulang('${item.no_permintaan}')" title="Batalkan">
                            Batal
                        </button>
                    `;
                }

                const tr = `
                    <tr>
                        <td class="text-center">${idx + 1}</td>
                        <td>${item.no_permintaan}</td>
                        <td>${item.tgl_permintaan} ${item.jam}</td>
                        <td>${item.dokter?.nm_dokter || item.kd_dokter}</td>
                        <td>${rincianHtml}</td>
                        <td class="text-center">${statusBadge}</td>
                        <td class="text-center">${aksiBtn}</td>
                    </tr>
                `;
                $tbody.append(tr);
            });
        }).fail(function() {
            $tbody.html('<tr><td colspan="7" class="text-center text-danger py-3">Gagal memuat riwayat.</td></tr>');
        });
    }

    /**
     * Batalkan Permintaan
     */
    function batalkanPermintaanResepPulang(no_permintaan) {
        if (!confirm(`Batalkan permintaan resep pulang ${no_permintaan}?`)) {
            return;
        }

        $.ajax({
            url: `/erm/resep-pulang/batal/${no_permintaan}`,
            method: 'DELETE',
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function(res) {
                if (res.status) {
                    alertSukses(res.message);
                    loadRiwayatPermintaanResepPulang();
                } else {
                    alertError(res.message);
                }
            },
            error: function(xhr) {
                const msg = xhr.responseJSON?.message || 'Gagal membatalkan permintaan.';
                alertError(msg);
            }
        });
    }

    // Helper alerts standar ERM
    function alertSukses(pesan) {
        if (typeof Swal !== 'undefined') {
            Swal.fire({ icon: 'success', title: 'Sukses', text: pesan, timer: 1800, showConfirmButton: false });
        } else {
            alert(pesan);
        }
    }
    function alertPeringatan(pesan) {
        if (typeof Swal !== 'undefined') {
            Swal.fire({ icon: 'warning', title: 'Perhatian', text: pesan, timer: 2000, showConfirmButton: false });
        } else {
            alert(pesan);
        }
    }
    function alertError(pesan) {
        if (typeof Swal !== 'undefined') {
            Swal.fire({ icon: 'error', title: 'Error', text: pesan });
        } else {
            alert(pesan);
        }
    }
</script>
@endpush
