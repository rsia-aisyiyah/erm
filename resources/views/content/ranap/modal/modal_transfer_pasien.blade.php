<!-- MODAL TRANSFER PASIEN ANTAR RUANG -->
<div class="modal fade" id="modalTransferPasien" tabindex="-1" aria-labelledby="modalTransferPasienLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen modal-dialog-scrollable">
        <div class="modal-content shadow-lg border-0">
            <!-- MODAL HEADER -->
            <div class="modal-header bg-primary text-white py-2 px-3 align-items-center">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-arrow-left-right fs-4"></i>
                    <div>
                        <h5 class="modal-title fw-bold fs-6 mb-0" id="modalTransferPasienLabel">TRANSFER PASIEN ANTAR RUANG</h5>
                        <small class="text-white-50" style="font-size: 11px;">Formulir Rekam Medis Pemindahan &amp; Serah Terima Pasien</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- MODAL BODY -->
            <div class="modal-body p-3 bg-light">
                <!-- BANNER IDENTITAS PASIEN -->
                <div class="card border-0 shadow-sm mb-3">
                    <div class="card-body p-2 bg-white rounded">
                        <div class="row align-items-center g-2">
                            <div class="col-auto">
                                <div class="avatar bg-primary-subtle text-primary p-2 rounded-circle text-center" style="width: 42px; height: 42px;">
                                    <i class="bi bi-person-fill fs-5"></i>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <span class="text-muted d-block" style="font-size: 10px;">NAMA PASIEN / NO. RM</span>
                                <span class="fw-bold text-dark fs-6" id="transfer_pasien_nama">-</span>
                                <span class="badge bg-secondary ms-1" id="transfer_pasien_norm" style="font-size: 11px;">-</span>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <span class="text-muted d-block" style="font-size: 10px;">NO. RAWAT</span>
                                <span class="fw-bold text-primary" id="transfer_pasien_norawat">-</span>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <span class="text-muted d-block" style="font-size: 10px;">TGL LAHIR / UMUR / JK</span>
                                <span class="fw-bold text-dark" id="transfer_pasien_ttl_jk" style="font-size: 12px;">-</span>
                            </div>
                            <div class="col-md-2 col-sm-6 text-end">
                                <span class="text-muted d-block" style="font-size: 10px;">RUANG / KAMAR SAAT INI</span>
                                <span class="badge bg-success fs-7" id="transfer_pasien_kamar">-</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- NAV TABS -->
                <ul class="nav nav-pills nav-fill mb-3 bg-white p-1 rounded border shadow-sm" id="pills-tab-transfer" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active fw-bold py-1 px-3" id="tab-form-transfer-tab" data-bs-toggle="pill" data-bs-target="#tab-form-transfer" type="button" role="tab" aria-selected="true">
                            <i class="bi bi-pencil-square me-1"></i> Formulir Transfer Pasien
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link fw-bold py-1 px-3" id="tab-riwayat-transfer-tab" data-bs-toggle="pill" data-bs-target="#tab-riwayat-transfer" type="button" role="tab" aria-selected="false">
                            <i class="bi bi-clock-history me-1"></i> Riwayat Transfer (<span id="countRiwayatTransfer">0</span>)
                        </button>
                    </li>
                </ul>

                <!-- TAB CONTENT -->
                <div class="tab-content" id="pills-tabContent-transfer">
                    <!-- TAB 1: FORMULIR TRANSFER -->
                    <div class="tab-pane fade show active" id="tab-form-transfer" role="tabpanel">
                        <form id="formTransferPasien" autocomplete="off">
                            <input type="hidden" name="no_rawat" id="transfer_no_rawat" />
                            <input type="hidden" name="is_edit" id="transfer_is_edit" value="0" />
                            <input type="hidden" name="photo" id="transfer_photo" />

                            <!-- BAGIAN A: INFORMASI PEMINDAHAN RUANG -->
                            <div class="card border-0 shadow-sm mb-3">
                                <div class="card-header bg-white border-bottom py-2">
                                    <span class="fw-bold text-primary"><i class="bi bi-geo-alt-fill me-1"></i> A. INFORMASI PEMINDAHAN RUANG</span>
                                </div>
                                <div class="card-body p-3">
                                    <div class="row g-2">
                                        <div class="col-md-3">
                                            <label class="form-label small fw-bold mb-1">Tanggal Masuk Ruang Asal :</label>
                                            <input type="text" class="form-control form-control-sm datetimepicker" name="tanggal_masuk" id="transfer_tanggal_masuk" required />
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label small fw-bold mb-1">Tanggal / Jam Pindah :</label>
                                            <input type="text" class="form-control form-control-sm datetimepicker" name="tanggal_pindah" id="transfer_tanggal_pindah" required />
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label small fw-bold mb-1">Asal Ruang Rawat / Poli :</label>
                                            <input type="text" class="form-control form-control-sm" name="asal_ruang" id="transfer_asal_ruang" placeholder="Nama ruang / poli asal..." />
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label small fw-bold mb-1">Ruang Rawat Selanjutnya :</label>
                                            <input type="text" class="form-control form-control-sm" name="ruang_selanjutnya" id="transfer_ruang_selanjutnya" placeholder="Nama ruang / bangsal tujuan..." />
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label small fw-bold mb-1">Metode Pemindahan Pasien :</label>
                                            <select class="form-select form-select-sm" name="metode_pemindahan_pasien" id="transfer_metode">
                                                <option value="Kursi Roda">Kursi Roda</option>
                                                <option value="Tempat Tidur">Tempat Tidur</option>
                                                <option value="Brankar" selected>Brankar</option>
                                                <option value="Berjalan">Berjalan</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label small fw-bold mb-1">Indikasi Pindah Ruang :</label>
                                            <select class="form-select form-select-sm" name="indikasi_pindah_ruang" id="transfer_indikasi">
                                                <option value="Kondisi Pasien Stabil">Kondisi Pasien Stabil</option>
                                                <option value="Kondisi Pasien Tidak Ada Perubahan">Kondisi Pasien Tidak Ada Perubahan</option>
                                                <option value="Kondisi Pasien Memburuk">Kondisi Pasien Memburuk</option>
                                                <option value="Fasilitas Kurang Memadai">Fasilitas Kurang Memadai</option>
                                                <option value="Fasilitas Butuh Lebih Baik">Fasilitas Butuh Lebih Baik</option>
                                                <option value="Tenaga Membutuhkan Yang Lebih Ahli">Tenaga Membutuhkan Yang Lebih Ahli</option>
                                                <option value="Tenaga Kurang">Tenaga Kurang</option>
                                                <option value="Lain-lain">Lain-lain</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label small fw-bold mb-1">Keterangan Indikasi Pindah :</label>
                                            <input type="text" class="form-control form-control-sm" name="keterangan_indikasi_pindah_ruang" id="transfer_keterangan_indikasi" placeholder="Keterangan tambahan jika lain-lain..." />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- BAGIAN B: KONDISI KLINIS & TINDAKAN -->
                            <div class="card border-0 shadow-sm mb-3">
                                <div class="card-header bg-white border-bottom py-2">
                                    <span class="fw-bold text-primary"><i class="bi bi-clipboard2-pulse-fill me-1"></i> B. KONDISI KLINIS &amp; TINDAKAN YANG TELAH DILAKUKAN</span>
                                </div>
                                <div class="card-body p-3">
                                    <div class="row g-2">
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold mb-1">Diagnosa Utama :</label>
                                            <input type="text" class="form-control form-control-sm" name="diagnosa_utama" id="transfer_diagnosa_utama" placeholder="Diagnosa utama saat transfer..." />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold mb-1">Diagnosa Sekunder :</label>
                                            <input type="text" class="form-control form-control-sm" name="diagnosa_sekunder" id="transfer_diagnosa_sekunder" placeholder="Diagnosa sekunder / komorbid..." />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold mb-1">Prosedur yang Sudah Dilakukan :</label>
                                            <textarea class="form-control form-control-sm" name="prosedur_yang_sudah_dilakukan" id="transfer_prosedur" rows="2" placeholder="Tindakan / prosedur medis / keperawatan yang telah diberikan..."></textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold mb-1">Obat yang Telah Diberikan :</label>
                                            <textarea class="form-control form-control-sm" name="obat_yang_telah_diberikan" id="transfer_obat" rows="2" placeholder="Daftar obat, dosis, dan rute pemberian..."></textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold mb-1">Pemeriksaan Penunjang yang Sudah Dilakukan :</label>
                                            <textarea class="form-control form-control-sm" name="pemeriksaan_penunjang_yang_dilakukan" id="transfer_penunjang" rows="2" placeholder="Laboratorium, Radiologi, EKG, dll..."></textarea>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label small fw-bold mb-1">Peralatan yang Menyertai :</label>
                                            <select class="form-select form-select-sm" name="peralatan_yang_menyertai" id="transfer_peralatan">
                                                <option value="">- Tidak Ada -</option>
                                                <option value="Oksigen Portable">Oksigen Portable</option>
                                                <option value="Infus" selected>Infus</option>
                                                <option value="NGT">NGT</option>
                                                <option value="Syringe Pump">Syringe Pump</option>
                                                <option value="Suction">Suction</option>
                                                <option value="Kateter Urin">Kateter Urin</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label small fw-bold mb-1">Keterangan Peralatan :</label>
                                            <input type="text" class="form-control form-control-sm" name="keterangan_peralatan_yang_menyertai" id="transfer_keterangan_peralatan" placeholder="Keterangan alat / cairan..." />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- BAGIAN C: PERSETUJUAN PASIEN / KELUARGA -->
                            <div class="card border-0 shadow-sm mb-3">
                                <div class="card-header bg-white border-bottom py-2">
                                    <span class="fw-bold text-primary"><i class="bi bi-person-check-fill me-1"></i> C. PERSETUJUAN PEMINDAHAN PASIEN / KELUARGA</span>
                                </div>
                                <div class="card-body p-3">
                                    <div class="row g-2 align-items-center">
                                        <div class="col-md-3">
                                            <label class="form-label small fw-bold mb-1">Menyetujui Pemindahan :</label>
                                            <div class="d-flex gap-3 mt-1">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="pasien_keluarga_menyetujui" id="transfer_setuju_ya" value="Ya" checked>
                                                    <label class="form-check-label small" for="transfer_setuju_ya">Ya, Setuju</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="pasien_keluarga_menyetujui" id="transfer_setuju_tidak" value="Tidak">
                                                    <label class="form-check-label small" for="transfer_setuju_tidak">Tidak</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label small fw-bold mb-1">Nama Keluarga / Penanggung Jawab :</label>
                                            <input type="text" class="form-control form-control-sm" name="nama_menyetujui" id="transfer_nama_menyetujui" placeholder="Nama terang keluarga / pasien..." />
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label small fw-bold mb-1">Hubungan dengan Pasien :</label>
                                            <select class="form-select form-select-sm" name="hubungan_menyetujui" id="transfer_hubungan_menyetujui">
                                                <option value="Suami">Suami</option>
                                                <option value="Istri">Istri</option>
                                                <option value="Orang Tua">Orang Tua</option>
                                                <option value="Keluarga" selected>Keluarga</option>
                                                <option value="Kakak">Kakak</option>
                                                <option value="Adik">Adik</option>
                                                <option value="Saudara">Saudara</option>
                                                <option value="Kakek">Kakek</option>
                                                <option value="Nenek">Nenek</option>
                                                <option value="Penanggung Jawab">Penanggung Jawab</option>
                                                <option value="Menantu">Menantu</option>
                                                <option value="Ipar">Ipar</option>
                                                <option value="Mertua">Mertua</option>
                                                <option value="-">-</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 text-center">
                                            <label class="form-label small fw-bold mb-1 d-block">Tanda Tangan :</label>
                                            <button type="button" class="btn btn-outline-primary btn-sm w-100" onclick="bukaModalTtdTransfer()">
                                                <i class="bi bi-pen me-1"></i> TTD Digital
                                            </button>
                                            <div id="previewTtdTransferWrapper" class="mt-1" style="display: none;">
                                                <img id="previewTtdTransferImg" src="" style="max-height: 40px; border: 1px dashed #ccc; padding: 2px; border-radius: 4px;" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- BAGIAN D: EVALUASI KEADAAN & TANDA VITAL (SEBELUM VS SESUDAH) -->
                            <div class="card border-0 shadow-sm mb-3">
                                <div class="card-header bg-white border-bottom py-2">
                                    <span class="fw-bold text-primary"><i class="bi bi-heart-pulse-fill me-1"></i> D. KEADAAN PASIEN DAN TANDA VITAL</span>
                                </div>
                                <div class="card-body p-3">
                                    <div class="row g-3">
                                        <!-- KOLOM 1: SEBELUM TRANSFER -->
                                        <div class="col-md-6 border-end">
                                            <div class="p-2 rounded bg-light border mb-2">
                                                <span class="fw-bold text-dark small"><i class="bi bi-box-arrow-left text-danger me-1"></i> 1. KONDISI SEBELUM TRANSFER</span>
                                            </div>
                                            <div class="row g-2">
                                                <div class="col-12">
                                                    <label class="form-label small mb-0">Keluhan Utama Sebelum Transfer :</label>
                                                    <input type="text" class="form-control form-control-sm" name="keluhan_utama_sebelum_transfer" id="transfer_keluhan_sebelum" placeholder="Keluhan pasien sebelum transfer..." />
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label small mb-0">Keadaan Umum / Kesadaran :</label>
                                                    <select class="form-select form-select-sm" name="keadaan_umum_sebelum_transfer" id="transfer_ku_sebelum">
                                                        <option value="Compos Mentis" selected>Compos Mentis</option>
                                                        <option value="Gelisah">Gelisah</option>
                                                        <option value="Delirium">Delirium</option>
                                                        <option value="Koma">Koma</option>
                                                    </select>
                                                </div>
                                                <div class="col-6 col-sm-3">
                                                    <label class="form-label small mb-0">TD (mmHg) :</label>
                                                    <input type="text" class="form-control form-control-sm" name="td_sebelum_transfer" id="transfer_td_sebelum" placeholder="120/80" />
                                                </div>
                                                <div class="col-6 col-sm-3">
                                                    <label class="form-label small mb-0">Nadi (x/m) :</label>
                                                    <input type="text" class="form-control form-control-sm" name="nadi_sebelum_transfer" id="transfer_nadi_sebelum" placeholder="80" />
                                                </div>
                                                <div class="col-6 col-sm-3">
                                                    <label class="form-label small mb-0">RR (x/m) :</label>
                                                    <input type="text" class="form-control form-control-sm" name="rr_sebelum_transfer" id="transfer_rr_sebelum" placeholder="20" />
                                                </div>
                                                <div class="col-6 col-sm-3">
                                                    <label class="form-label small mb-0">Suhu (&deg;C) :</label>
                                                    <input type="text" class="form-control form-control-sm" name="suhu_sebelum_transfer" id="transfer_suhu_sebelum" placeholder="36.5" />
                                                </div>
                                            </div>
                                        </div>

                                        <!-- KOLOM 2: SESUDAH TRANSFER -->
                                        <div class="col-md-6">
                                            <div class="p-2 rounded bg-light border mb-2">
                                                <span class="fw-bold text-dark small"><i class="bi bi-box-arrow-in-right text-success me-1"></i> 2. KONDISI SESUDAH TRANSFER</span>
                                            </div>
                                            <div class="row g-2">
                                                <div class="col-12">
                                                    <label class="form-label small mb-0">Keluhan Utama Sesudah Transfer :</label>
                                                    <input type="text" class="form-control form-control-sm" name="keluhan_utama_sesudah_transfer" id="transfer_keluhan_sesudah" placeholder="Keluhan pasien sesudah sampai di ruangan..." />
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label small mb-0">Keadaan Umum / Kesadaran :</label>
                                                    <select class="form-select form-select-sm" name="keadaan_umum_sesudah_transfer" id="transfer_ku_sesudah">
                                                        <option value="Compos Mentis" selected>Compos Mentis</option>
                                                        <option value="Gelisah">Gelisah</option>
                                                        <option value="Delirium">Delirium</option>
                                                        <option value="Koma">Koma</option>
                                                    </select>
                                                </div>
                                                <div class="col-6 col-sm-3">
                                                    <label class="form-label small mb-0">TD (mmHg) :</label>
                                                    <input type="text" class="form-control form-control-sm" name="td_sesudah_transfer" id="transfer_td_sesudah" placeholder="120/80" />
                                                </div>
                                                <div class="col-6 col-sm-3">
                                                    <label class="form-label small mb-0">Nadi (x/m) :</label>
                                                    <input type="text" class="form-control form-control-sm" name="nadi_sesudah_transfer" id="transfer_nadi_sesudah" placeholder="80" />
                                                </div>
                                                <div class="col-6 col-sm-3">
                                                    <label class="form-label small mb-0">RR (x/m) :</label>
                                                    <input type="text" class="form-control form-control-sm" name="rr_sesudah_transfer" id="transfer_rr_sesudah" placeholder="20" />
                                                </div>
                                                <div class="col-6 col-sm-3">
                                                    <label class="form-label small mb-0">Suhu (&deg;C) :</label>
                                                    <input type="text" class="form-control form-control-sm" name="suhu_sesudah_transfer" id="transfer_suhu_sesudah" placeholder="36.5" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- BAGIAN E: SERAH TERIMA PETUGAS -->
                            <div class="card border-0 shadow-sm mb-3">
                                <div class="card-header bg-white border-bottom py-2">
                                    <span class="fw-bold text-primary"><i class="bi bi-people-fill me-1"></i> E. SERAH TERIMA PETUGAS (PPA)</span>
                                </div>
                                <div class="card-body p-3">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold mb-1">Petugas yang Menyerahkan :</label>
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                                                <input type="text" class="form-control" name="nip_menyerahkan" id="transfer_nip_menyerahkan" readonly style="max-width: 130px;" />
                                                <input type="text" class="form-control" name="nama_menyerahkan" id="transfer_nama_menyerahkan" readonly />
                                            </div>
                                        </div>
                                        <div class="col-md-6 position-relative">
                                            <label class="form-label small fw-bold mb-1">Petugas yang Menerima :</label>
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-text"><i class="bi bi-person-check-fill"></i></span>
                                                <input type="text" class="form-control" name="nip_menerima" id="transfer_nip_menerima" placeholder="NIP..." readonly style="max-width: 130px;" />
                                                <input type="text" class="form-control" name="nama_menerima" id="transfer_nama_menerima" placeholder="Ketik nama petugas penerima..." onkeyup="cariPetugasTransfer(this.value)" autocomplete="off" />
                                            </div>
                                            <ul class="dropdown-menu shadow w-100 list_petugas_transfer" style="display: none; max-height: 200px; overflow-y: auto; z-index: 1055;"></ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- TAB 2: RIWAYAT TRANSFER -->
                    <div class="tab-pane fade" id="tab-riwayat-transfer" role="tabpanel">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body p-3">
                                <div class="table-responsive">
                                    <table class="table table-sm table-bordered table-hover w-100" id="tableRiwayatTransfer" style="font-size: 11.5px;">
                                        <thead class="table-primary text-center">
                                            <tr>
                                                <th width="4%">No</th>
                                                <th width="14%">Tgl Masuk Ruang</th>
                                                <th width="14%">Tgl Pindah</th>
                                                <th width="20%">Asal &rarr; Tujuan</th>
                                                <th width="18%">Indikasi Pindah</th>
                                                <th width="18%">Petugas (Serah / Terima)</th>
                                                <th width="12%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr><td colspan="7" class="text-center text-muted">Memuat data riwayat transfer...</td></tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- MODAL FOOTER -->
            <div class="modal-footer bg-white py-2 px-3 justify-content-between border-top">
                <div>
                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="resetFormTransfer()">
                        <i class="bi bi-file-earmark-plus me-1"></i> Form Baru
                    </button>
                    <button type="button" class="btn btn-outline-info btn-sm ms-1" id="btnCetakTransferModal" onclick="cetakTransferPasien()" disabled title="Simpan data terlebih dahulu untuk mencetak">
                        <i class="bi bi-printer me-1"></i> Cetak Form Transfer (PDF)
                    </button>
                </div>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i> Tutup
                    </button>
                    <button type="button" class="btn btn-primary btn-sm fw-bold" id="btnSimpanTransfer" onclick="simpanTransferPasien()">
                        <i class="bi bi-save me-1"></i> Simpan Data Transfer
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL SIGNATURE PERSATUJUAN TRANSFER -->
<div class="modal fade" id="modalSignatureTransfer" tabindex="-1" aria-hidden="true" style="z-index: 1060;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg border-0">
            <div class="modal-header bg-primary text-white py-2">
                <h6 class="modal-title fw-bold fs-6"><i class="bi bi-pen me-1"></i> Tanda Tangan Pasien / Keluarga</h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center p-3">
                <p class="small text-muted mb-2">Silakan bubuhkan tanda tangan persetujuan transfer pada area kanvas di bawah ini:</p>
                <div class="border rounded bg-white mx-auto shadow-sm" style="width: 100%; max-width: 380px; height: 180px; position: relative;">
                    <canvas id="canvasTransfer" width="380" height="180" style="touch-action: none; cursor: crosshair;"></canvas>
                </div>
            </div>
            <div class="modal-footer py-2 justify-content-between">
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="resetCanvasTransfer()">
                    <i class="bi bi-eraser me-1"></i> Bersihkan
                </button>
                <div>
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary btn-sm fw-bold" onclick="simpanSignatureTransfer()">
                        <i class="bi bi-check-circle me-1"></i> Terapkan TTD
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        let signaturePadTransfer = null;
        let canvasElemTransfer = null;
        let listTransferCache = [];
        let currentTransferNoRawat = '';
        let currentSelectedTglMasuk = '';

        function showModalTransferPasien(no_rawat) {
            currentTransferNoRawat = no_rawat;
            resetFormTransfer();
            $('#modalTransferPasien').modal('show');
            $('#tab-form-transfer-tab').tab('show');

            // Ambil data pasien dan registrasi
            getRegPeriksa(no_rawat).done((response) => {
                const p = response.pasien || {};
                $('#transfer_pasien_nama').text(p.nm_pasien || '-');
                $('#transfer_pasien_norm').text(p.no_rkm_medis || '-');
                $('#transfer_pasien_norawat').text(no_rawat);
                
                const tglLahir = p.tgl_lahir ? splitTanggal(p.tgl_lahir) : '-';
                const jk = p.jk === 'L' ? 'Laki-Laki' : 'Perempuan';
                $('#transfer_pasien_ttl_jk').text(`${tglLahir} (${p.umur || '-'}) / ${jk}`);

                // Kamar / Bangsal
                let kamar = '-';
                if (response.kamar_inap && response.kamar_inap.length > 0) {
                    const activeKamar = response.kamar_inap.find(k => k.stts_pulang !== 'Pindah Kamar') || response.kamar_inap[0];
                    if (activeKamar && activeKamar.kamar && activeKamar.kamar.bangsal) {
                        kamar = activeKamar.kamar.bangsal.nm_bangsal;
                    }
                } else if (response.poliklinik) {
                    kamar = response.poliklinik.nm_poli;
                }
                $('#transfer_pasien_kamar').text(kamar);
                $('#transfer_asal_ruang').val(kamar);

                // Auto fill nama penanggung jawab jika ada
                if (response.p_jawab) {
                    $('#transfer_nama_menyetujui').val(response.p_jawab);
                    if (response.hubunganpj) {
                        $('#transfer_hubungan_menyetujui').val(response.hubunganpj);
                    }
                }

                // Default NIP Menyerahkan
                const userNik = "{{ session()->get('pegawai')->nik ?? '' }}";
                const userNama = "{{ session()->get('pegawai')->nama ?? '' }}";
                $('#transfer_nip_menyerahkan').val(userNik);
                $('#transfer_nama_menyerahkan').val(userNama);

                // Load riwayat transfer
                loadRiwayatTransfer(no_rawat);
            });
        }

        function resetFormTransfer() {
            $('#formTransferPasien')[0].reset();
            $('#transfer_no_rawat').val(currentTransferNoRawat);
            $('#transfer_is_edit').val('0');
            $('#transfer_photo').val('');
            $('#previewTtdTransferWrapper').hide();
            $('#previewTtdTransferImg').attr('src', '');

            const now = moment().format('YYYY-MM-DD HH:mm:ss');
            $('#transfer_tanggal_masuk').val(now).removeAttr('readonly');
            $('#transfer_tanggal_pindah').val(now);

            const userNik = "{{ session()->get('pegawai')->nik ?? '' }}";
            const userNama = "{{ session()->get('pegawai')->nama ?? '' }}";
            $('#transfer_nip_menyerahkan').val(userNik);
            $('#transfer_nama_menyerahkan').val(userNama);
            $('#transfer_nip_menerima').val('');
            $('#transfer_nama_menerima').val('');

            $('#btnSimpanTransfer').html('<i class="bi bi-save me-1"></i> Simpan Data Transfer');
            currentSelectedTglMasuk = '';
            refreshBtnCetakTransfer();
        }

        function refreshBtnCetakTransfer() {
            if (listTransferCache.length > 0 || currentSelectedTglMasuk) {
                $('#btnCetakTransferModal').removeAttr('disabled').removeAttr('title');
            } else {
                $('#btnCetakTransferModal').attr('disabled', 'disabled').attr('title', 'Simpan data terlebih dahulu untuk mencetak');
            }
        }

        function loadRiwayatTransfer(no_rawat) {
            $.get(`${url}/transfer/pasien/antar-ruang`, { no_rawat: no_rawat }).done((response) => {
                listTransferCache = response || [];
                $('#countRiwayatTransfer').text(listTransferCache.length);
                refreshBtnCetakTransfer();

                let tbody = $('#tableRiwayatTransfer tbody');
                tbody.empty();

                if (!listTransferCache || listTransferCache.length === 0) {
                    tbody.html('<tr><td colspan="7" class="text-center text-muted py-3">Belum ada riwayat transfer pasien untuk nomor rawat ini.</td></tr>');
                    return;
                }

                listTransferCache.forEach((item, index) => {
                    const serah = (item.pegawai_menyerahkan ? item.pegawai_menyerahkan.nama : (item.petugas_menyerahkan ? item.petugas_menyerahkan.nama : item.nip_menyerahkan)) || '-';
                    const terima = (item.pegawai_menerima ? item.pegawai_menerima.nama : (item.petugas_menerima ? item.petugas_menerima.nama : item.nip_menerima)) || '-';

                    let rowHtml = `
                        <tr>
                            <td class="text-center align-middle">${index + 1}</td>
                            <td class="align-middle">${item.tanggal_masuk || '-'}</td>
                            <td class="align-middle fw-bold text-primary">${item.tanggal_pindah || '-'}</td>
                            <td class="align-middle"><span class="badge bg-secondary">${item.asal_ruang || '-'}</span> &rarr; <span class="badge bg-success">${item.ruang_selanjutnya || '-'}</span></td>
                            <td class="align-middle">${item.indikasi_pindah_ruang || '-'}</td>
                            <td class="align-middle">
                                <small class="d-block"><i class="bi bi-box-arrow-left text-danger me-1"></i>${serah}</small>
                                <small class="d-block"><i class="bi bi-box-arrow-in-right text-success me-1"></i>${terima}</small>
                            </td>
                            <td class="text-center align-middle">
                                <div class="btn-group btn-group-sm">
                                    <button type="button" class="btn btn-outline-warning btn-sm" title="Edit" onclick="editTransferPasien('${item.no_rawat}', '${item.tanggal_masuk}')">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button type="button" class="btn btn-outline-danger btn-sm" title="Hapus" onclick="hapusTransferPasien('${item.no_rawat}', '${item.tanggal_masuk}')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                    <button type="button" class="btn btn-outline-info btn-sm" title="Cetak PDF" onclick="cetakTransferPasien('${item.no_rawat}', '${item.tanggal_masuk}')">
                                        <i class="bi bi-printer"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    `;
                    tbody.append(rowHtml);
                });
            });
        }

        function editTransferPasien(no_rawat, tanggal_masuk) {
            const data = listTransferCache.find(x => x.no_rawat === no_rawat && x.tanggal_masuk === tanggal_masuk);
            if (!data) return;

            currentSelectedTglMasuk = data.tanggal_masuk;
            $('#transfer_no_rawat').val(data.no_rawat);
            $('#transfer_is_edit').val('1');
            $('#transfer_tanggal_masuk').val(data.tanggal_masuk).attr('readonly', 'readonly');
            $('#transfer_tanggal_pindah').val(data.tanggal_pindah);
            $('#transfer_asal_ruang').val(data.asal_ruang);
            $('#transfer_ruang_selanjutnya').val(data.ruang_selanjutnya);
            $('#transfer_metode').val(data.metode_pemindahan_pasien);
            $('#transfer_indikasi').val(data.indikasi_pindah_ruang);
            $('#transfer_keterangan_indikasi').val(data.keterangan_indikasi_pindah_ruang);
            $('#transfer_diagnosa_utama').val(data.diagnosa_utama);
            $('#transfer_diagnosa_sekunder').val(data.diagnosa_sekunder);
            $('#transfer_prosedur').val(data.prosedur_yang_sudah_dilakukan);
            $('#transfer_obat').val(data.obat_yang_telah_diberikan);
            $('#transfer_penunjang').val(data.pemeriksaan_penunjang_yang_dilakukan);
            $('#transfer_peralatan').val(data.peralatan_yang_menyertai);
            $('#transfer_keterangan_peralatan').val(data.keterangan_peralatan_yang_menyertai);

            if (data.pasien_keluarga_menyetujui === 'Tidak') {
                $('#transfer_setuju_tidak').prop('checked', true);
            } else {
                $('#transfer_setuju_ya').prop('checked', true);
            }
            $('#transfer_nama_menyetujui').val(data.nama_menyetujui);
            $('#transfer_hubungan_menyetujui').val(data.hubungan_menyetujui);

            $('#transfer_keluhan_sebelum').val(data.keluhan_utama_sebelum_transfer);
            $('#transfer_ku_sebelum').val(data.keadaan_umum_sebelum_transfer);
            $('#transfer_td_sebelum').val(data.td_sebelum_transfer);
            $('#transfer_nadi_sebelum').val(data.nadi_sebelum_transfer);
            $('#transfer_rr_sebelum').val(data.rr_sebelum_transfer);
            $('#transfer_suhu_sebelum').val(data.suhu_sebelum_transfer);

            $('#transfer_keluhan_sesudah').val(data.keluhan_utama_sesudah_transfer);
            $('#transfer_ku_sesudah').val(data.keadaan_umum_sesudah_transfer);
            $('#transfer_td_sesudah').val(data.td_sesudah_transfer);
            $('#transfer_nadi_sesudah').val(data.nadi_sesudah_transfer);
            $('#transfer_rr_sesudah').val(data.rr_sesudah_transfer);
            $('#transfer_suhu_sesudah').val(data.suhu_sesudah_transfer);

            $('#transfer_nip_menyerahkan').val(data.nip_menyerahkan);
            const namaSerah = (data.pegawai_menyerahkan ? data.pegawai_menyerahkan.nama : (data.petugas_menyerahkan ? data.petugas_menyerahkan.nama : data.nip_menyerahkan)) || '';
            $('#transfer_nama_menyerahkan').val(namaSerah);

            $('#transfer_nip_menerima').val(data.nip_menerima);
            const namaTerima = (data.pegawai_menerima ? data.pegawai_menerima.nama : (data.petugas_menerima ? data.petugas_menerima.nama : data.nip_menerima)) || '';
            $('#transfer_nama_menerima').val(namaTerima);

            if (data.bukti && data.bukti.photo) {
                $('#transfer_photo').val(data.bukti.photo);
                $('#previewTtdTransferImg').attr('src', data.bukti.photo);
                $('#previewTtdTransferWrapper').show();
            } else {
                $('#transfer_photo').val('');
                $('#previewTtdTransferWrapper').hide();
            }

            $('#btnSimpanTransfer').html('<i class="bi bi-pencil-square me-1"></i> Perbarui Data Transfer');
            $('#tab-form-transfer-tab').tab('show');
            refreshBtnCetakTransfer();
        }

        function simpanTransferPasien() {
            const no_rawat = $('#transfer_no_rawat').val();
            if (!no_rawat) {
                Swal.fire('Peringatan', 'Nomor rawat tidak ditemukan', 'warning');
                return;
            }

            const nipMenerima = $('#transfer_nip_menerima').val();
            if (!nipMenerima) {
                Swal.fire('Peringatan', 'Harap pilih Petugas yang Menerima transfer terlebih dahulu', 'warning');
                $('#transfer_nama_menerima').focus();
                return;
            }

            const formData = $('#formTransferPasien').serializeArray();
            let postData = { _token: "{{ csrf_token() }}" };
            $.each(formData, function(i, field) {
                postData[field.name] = field.value;
            });

            $.post(`${url}/transfer/pasien/antar-ruang`, postData).done((response) => {
                alertSuccessAjax(response).then(() => {
                    currentSelectedTglMasuk = postData.tanggal_masuk;
                    loadRiwayatTransfer(no_rawat);
                    $('#tab-riwayat-transfer-tab').tab('show');
                });
            }).fail((error) => {
                alertErrorAjax(error);
            });
        }

        function hapusTransferPasien(no_rawat, tanggal_masuk) {
            Swal.fire({
                title: 'Hapus Data Transfer?',
                text: `Data transfer tanggal ${tanggal_masuk} akan dihapus permanen!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post(`${url}/transfer/pasien/antar-ruang/delete`, {
                        no_rawat: no_rawat,
                        tanggal_masuk: tanggal_masuk,
                        _token: "{{ csrf_token() }}"
                    }).done((response) => {
                        alertSuccessAjax(response).then(() => {
                            if (currentSelectedTglMasuk === tanggal_masuk) {
                                resetFormTransfer();
                            }
                            loadRiwayatTransfer(no_rawat);
                        });
                    }).fail((error) => {
                        alertErrorAjax(error);
                    });
                }
            });
        }

        function cetakTransferPasien(no_rawat = null, tanggal_masuk = null) {
            const targetNoRawat = no_rawat || currentTransferNoRawat;
            const targetTglMasuk = tanggal_masuk || currentSelectedTglMasuk;

            if (!targetNoRawat) {
                Swal.fire('Peringatan', 'Nomor rawat tidak ditemukan', 'warning');
                return;
            }

            let printUrl = `${url}/transfer/pasien/antar-ruang/print?no_rawat=${encodeURIComponent(targetNoRawat)}`;
            if (targetTglMasuk) {
                printUrl += `&tanggal_masuk=${encodeURIComponent(targetTglMasuk)}`;
            }
            window.open(printUrl, '_blank');
        }

        function cariPetugasTransfer(keyword) {
            if (keyword.length < 2) {
                $('.list_petugas_transfer').fadeOut();
                return;
            }
            getPetugas(keyword).done((response) => {
                let html = '';
                if (response && response.length > 0) {
                    response.forEach(item => {
                        html += `<li><a class="dropdown-item py-1" href="javascript:void(0)" onclick="setPetugasTransfer('${item.nip}', '${item.nama}')"><strong class="d-block">${item.nama}</strong><small class="text-muted">NIP. ${item.nip}</small></a></li>`;
                    });
                } else {
                    html = `<li><span class="dropdown-item text-muted small">Petugas tidak ditemukan</span></li>`;
                }
                $('.list_petugas_transfer').html(html).fadeIn();
            });
        }

        function setPetugasTransfer(nip, nama) {
            $('#transfer_nip_menerima').val(nip);
            $('#transfer_nama_menerima').val(nama);
            $('.list_petugas_transfer').fadeOut();
        }

        // SIGNATURE PAD LOGIC
        function bukaModalTtdTransfer() {
            $('#modalSignatureTransfer').modal('show');
            setTimeout(() => {
                if (!canvasElemTransfer) {
                    canvasElemTransfer = document.getElementById('canvasTransfer');
                    signaturePadTransfer = new SignaturePad(canvasElemTransfer, {
                        backgroundColor: 'rgb(255, 255, 255)',
                        penColor: 'rgb(0, 0, 0)'
                    });
                }
                signaturePadTransfer.clear();
            }, 300);
        }

        function resetCanvasTransfer() {
            if (signaturePadTransfer) {
                signaturePadTransfer.clear();
            }
        }

        function simpanSignatureTransfer() {
            if (!signaturePadTransfer || signaturePadTransfer.isEmpty()) {
                Swal.fire('Peringatan', 'Silakan bubuhkan tanda tangan terlebih dahulu', 'warning');
                return;
            }
            const dataUrl = signaturePadTransfer.toDataURL('image/png');
            $('#transfer_photo').val(dataUrl);
            $('#previewTtdTransferImg').attr('src', dataUrl);
            $('#previewTtdTransferWrapper').show();
            $('#modalSignatureTransfer').modal('hide');
        }

        // Close dropdown when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('#transfer_nama_menerima, .list_petugas_transfer').length) {
                $('.list_petugas_transfer').fadeOut();
            }
        });
    </script>
@endpush
