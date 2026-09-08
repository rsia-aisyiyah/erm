<div class="modal fade" id="modalPersetujuanAnestesi" tabindex="-1" aria-labelledby="modalPersetujuanAnestesiLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content shadow-lg">
            <div class="modal-header bg-primary text-white py-2 px-3">
                <h5 class="modal-title fs-6 fw-bold" id="modalPersetujuanAnestesiLabel">
                    <i class="bi bi-file-earmark-medical me-2"></i> INFORMED CONSENT TINDAKAN MEDIS REGIONAL ANESTESI /
                    RA
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body p-3 bg-light">
                <!-- Info Pasien -->
                <div class="card mb-3 border-0 shadow-sm bg-white">
                    <div class="card-body py-2 px-3">
                        <div class="row g-2 text-dark align-items-center" style="font-size: 12.5px;">
                            <div class="col-md-3 col-6">
                                <span class="text-muted d-block small">No. Rawat</span>
                                <strong class="text-primary" id="info_anestesi_no_rawat">-</strong>
                            </div>
                            <div class="col-md-3 col-6">
                                <span class="text-muted d-block small">No. Rekam Medis</span>
                                <strong id="info_anestesi_no_rkm_medis">-</strong>
                            </div>
                            <div class="col-md-3 col-6">
                                <span class="text-muted d-block small">Nama Pasien</span>
                                <strong id="info_anestesi_nm_pasien">-</strong>
                            </div>
                            <div class="col-md-3 col-6">
                                <span class="text-muted d-block small">Tgl Lahir / Umur / JK</span>
                                <strong id="info_anestesi_ttl_jk">-</strong>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- DAFTAR RIWAYAT INFORMED CONSENT (MULTI-RECORD) -->
                <div class="card mb-3 border-0 shadow-sm bg-white">
                    <div
                        class="card-header bg-white py-2 d-flex justify-content-between align-items-center border-bottom">
                        <span class="fw-bold text-dark" style="font-size: 13px;">
                            <i class="bi bi-clock-history text-primary me-1"></i> Riwayat Informed Consent Anestesi
                        </span>
                        <button type="button" class="btn btn-outline-primary btn-sm py-1 px-3"
                            onclick="resetFormPersetujuanAnestesi()">
                            <i class="bi bi-plus-circle me-1"></i> + Buat Form Baru
                        </button>
                    </div>
                    <div class="card-body p-0 table-responsive">
                        <table class="table table-bordered table-hover table-sm mb-0 align-middle"
                            id="tb_riwayat_anestesi">
                            <thead class="table-light text-center" style="font-size: 12px;">
                                <tr>
                                    <th width="4%">No</th>
                                    <th width="16%">Tgl & Jam</th>
                                    <th width="24%">Dokter Anestesi</th>
                                    <th width="12%">Pernyataan</th>
                                    <th width="26%">Diagnosis</th>
                                    <th width="18%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody style="font-size: 12px;" id="list_riwayat_anestesi">
                                <tr>
                                    <td colspan="6" class="text-center py-2 text-muted">Belum ada riwayat persetujuan
                                        tindakan anestesi.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- FORM INPUT / EDIT -->
                <div class="card border-0 shadow-sm bg-white">
                    <div
                        class="card-header bg-primary text-white py-2 px-3 d-flex justify-content-between align-items-center">
                        <span class="fw-bold" style="font-size: 13px;" id="lbl_status_form_anestesi">
                            <i class="bi bi-pencil-square me-1"></i> Form Input Informed Consent
                        </span>
                        <span class="badge bg-light text-primary" id="badge_mode_anestesi">Mode: Tambah Baru</span>
                    </div>
                    <div class="card-body p-3">
                        <form id="formPersetujuanAnestesi" autocomplete="off">
                            @csrf
                            <input type="hidden" name="id" id="anestesi_id" value="">
                            <input type="hidden" name="no_rawat" id="anestesi_no_rawat">

                            <!-- Section 1: Pelaksana & Waktu -->
                            <div class="p-3 mb-3 rounded border bg-light bg-opacity-50">
                                <div class="row g-2">
                                    <div class="col-md-3">
                                        <label class="form-label fw-bold small mb-1">Tanggal Tindakan <span
                                                class="text-danger">*</span></label>
                                        <input type="date" name="tanggal" id="anestesi_tanggal"
                                            class="form-control form-control-sm" value="{{ date('Y-m-d') }}" required>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label fw-bold small mb-1">Jam <span
                                                class="text-danger">*</span></label>
                                        <input type="time" name="jam" id="anestesi_jam"
                                            class="form-control form-control-sm" value="{{ date('H:i:s') }}" required>
                                    </div>
                                    <div class="col-md-7">
                                        <label class="form-label fw-bold small mb-1">Dokter Penanggung Jawab Tindakan
                                            (Anestesi) <span class="text-danger">*</span></label>
                                        <select name="kd_dokter_anestesi" id="anestesi_kd_dokter"
                                            data-dropdown-parent="#modalPersetujuanAnestesi" class="select2 w-100"
                                            required></select>
                                    </div>
                                </div>
                            </div>

                            <!-- Section 2: Tabel 10 Butir Informasi -->
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h6 class="fw-bold text-primary mb-0" style="font-size: 13px;">
                                    <i class="bi bi-info-circle me-1"></i> I. PEMBERIAN INFORMASI TINDAKAN MEDIS
                                </h6>
                                <button type="button" class="btn btn-outline-secondary btn-sm py-0 px-2"
                                    style="font-size: 11px;" onclick="toggleCheckAllInformasi()">
                                    <i class="bi bi-check-all me-1"></i> Centang / Hapus Semua
                                </button>
                            </div>
                            <div class="table-responsive mb-3 border rounded">
                                <table class="table table-bordered table-sm align-middle mb-0">
                                    <thead class="table-light text-center" style="font-size: 12px;">
                                        <tr>
                                            <th width="4%">NO</th>
                                            <th width="20%">JENIS INFORMASI</th>
                                            <th width="66%">ISI INFORMASI</th>
                                            <th width="10%">TANDA (&check;)</th>
                                        </tr>
                                    </thead>
                                    <tbody style="font-size: 12px;">
                                        <tr>
                                            <td class="text-center">1</td>
                                            <td class="fw-bold">Diagnosis</td>
                                            <td>
                                                <input type="text" name="diagnosis" id="anestesi_diagnosis"
                                                    class="form-control form-control-sm"
                                                    placeholder="Isi diagnosis klinis pasien">
                                            </td>
                                            <td class="text-center">
                                                <input type="checkbox" name="check_diagnosis" value="1"
                                                    class="form-check-input check-info-item" checked>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">2</td>
                                            <td class="fw-bold">Dasar Diagnosis</td>
                                            <td>
                                                <input type="text" name="dasar_diagnosis"
                                                    id="anestesi_dasar_diagnosis" class="form-control form-control-sm"
                                                    value="Anamnesis, pemeriksaan fisik, dan pemeriksaan penunjang">
                                            </td>
                                            <td class="text-center">
                                                <input type="checkbox" name="check_dasar_diagnosis" value="1"
                                                    class="form-check-input check-info-item" checked>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">3</td>
                                            <td class="fw-bold">Tindakan Medis</td>
                                            <td>
                                                <input type="text" name="tindakan_medis"
                                                    id="anestesi_tindakan_medis" class="form-control form-control-sm"
                                                    value="Regional anestesi (RA) / anestesi spinal">
                                            </td>
                                            <td class="text-center">
                                                <input type="checkbox" name="check_tindakan_medis" value="1"
                                                    class="form-check-input check-info-item" checked>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">4</td>
                                            <td class="fw-bold">Indikasi Tindakan</td>
                                            <td>
                                                <input type="text" name="indikasi_tindakan"
                                                    id="anestesi_indikasi_tindakan"
                                                    class="form-control form-control-sm"
                                                    value="Pasien dengan kebutuhan anestesi regional, pasien operasi">
                                            </td>
                                            <td class="text-center">
                                                <input type="checkbox" name="check_indikasi_tindakan" value="1"
                                                    class="form-check-input check-info-item" checked>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">5</td>
                                            <td class="fw-bold">Tata Cara</td>
                                            <td>
                                                <textarea name="tata_cara" id="anestesi_tata_cara" class="form-control form-control-sm" rows="2">Obat bius diberikan dengan cara disuntikkan di ruas tulang belakang</textarea>
                                            </td>
                                            <td class="text-center">
                                                <input type="checkbox" name="check_tata_cara" value="1"
                                                    class="form-check-input check-info-item" checked>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">6</td>
                                            <td class="fw-bold">Tujuan</td>
                                            <td>
                                                <textarea name="tujuan" id="anestesi_tujuan" class="form-control form-control-sm" rows="2">Menghilangkan rasa sakit, memfasilitasi jalannya operasi / tindakan</textarea>
                                            </td>
                                            <td class="text-center">
                                                <input type="checkbox" name="check_tujuan" value="1"
                                                    class="form-check-input check-info-item" checked>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">7</td>
                                            <td class="fw-bold">Risiko Tindakan</td>
                                            <td>
                                                <input type="text" name="risiko" id="anestesi_risiko"
                                                    class="form-control form-control-sm"
                                                    value="Nyeri saat penyuntikan">
                                            </td>
                                            <td class="text-center">
                                                <input type="checkbox" name="check_risiko" value="1"
                                                    class="form-check-input check-info-item" checked>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">8</td>
                                            <td class="fw-bold">Komplikasi</td>
                                            <td>
                                                <textarea name="komplikasi" id="anestesi_komplikasi" class="form-control form-control-sm" rows="3">1. Mual, muntah, pusing, mengantuk, sulit bernafas, hipotensi, henti jantung, syok anafilaktik&#10;2. Alergi / hipersensitif terhadap obat</textarea>
                                            </td>
                                            <td class="text-center">
                                                <input type="checkbox" name="check_komplikasi" value="1"
                                                    class="form-check-input check-info-item" checked>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">9</td>
                                            <td class="fw-bold">Prognosis Tindakan</td>
                                            <td>
                                                <input type="text" name="prognosis" id="anestesi_prognosis"
                                                    class="form-control form-control-sm" value="Dubia">
                                            </td>
                                            <td class="text-center">
                                                <input type="checkbox" name="check_prognosis" value="1"
                                                    class="form-check-input check-info-item" checked>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">10</td>
                                            <td class="fw-bold">Alternatif dan Risiko</td>
                                            <td>
                                                <input type="text" name="alternatif_dan_risiko"
                                                    id="anestesi_alternatif_dan_risiko"
                                                    class="form-control form-control-sm" value="Tidak ada">
                                            </td>
                                            <td class="text-center">
                                                <input type="checkbox" name="check_alternatif" value="1"
                                                    class="form-check-input check-info-item" checked>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mt-2">
                                    <label class="form-label fw-bold small mb-1">Pemberi Informasi (Freetext) <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="pemberi_informasi" id="anestesi_pemberi_informasi"
                                        class="form-control form-control-sm" required
                                        placeholder="Nama Dokter / Petugas Pemberi Edukasi">
                                </div>
                                <div class="col-md-12 mt-2">
                                    <label class="form-label fw-bold small mb-1">Penerima Informasi / Wali
                                        (Freetext) <span class="text-danger">*</span></label>
                                    <input type="text" name="penerima_informasi" id="anestesi_penerima_informasi"
                                        class="form-control form-control-sm" required
                                        placeholder="Nama Pasien / Keluarga / Wali Penerima Informasi">
                                </div>
                            </div>

                            <!-- Section 3: Persetujuan / Penolakan Tindakan Medis -->
                            <h6 class="m-2 fw-bold text-success" style="font-size: 13px;">
                                <i class="bi bi-shield-check me-1"></i> II. PERSETUJUAN / PENOLAKAN TINDAKAN MEDIS
                            </h6>
                            <div class="p-3 mb-3 rounded border bg-light bg-opacity-50">
                                <div class="row g-2">
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold small mb-1">Pernyataan Sikap <span
                                                class="text-danger">*</span></label>
                                        <div class="d-flex gap-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio"
                                                    name="jenis_pernyataan" id="pernyataan_setuju" value="SETUJU"
                                                    checked>
                                                <label class="form-check-label fw-bold text-success"
                                                    for="pernyataan_setuju">
                                                    <i class="bi bi-check-circle-fill me-1"></i> SETUJU
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio"
                                                    name="jenis_pernyataan" id="pernyataan_menolak" value="MENOLAK">
                                                <label class="form-check-label fw-bold text-danger"
                                                    for="pernyataan_menolak">
                                                    <i class="bi bi-x-circle-fill me-1"></i> MENOLAK
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold small mb-1">Hubungan Dengan Pasien <span
                                                class="text-danger">*</span></label>
                                        <select name="hubungan" id="anestesi_hubungan"
                                            class="form-select form-select-sm" required>
                                            <option value="Diri Sendiri">Diri Sendiri</option>
                                            <option value="Suami">Suami</option>
                                            <option value="Istri">Istri</option>
                                            <option value="Anak">Anak</option>
                                            <option value="Ibu">Ibu</option>
                                            <option value="Ayah">Ayah</option>
                                            <option value="Adik">Adik</option>
                                            <option value="Kakak">Kakak</option>
                                            <option value="Keluarga">Keluarga</option>
                                            <option value="Lain-lain">Lain-lain</option>
                                        </select>
                                    </div>

                                    <div class="col-12 mt-2">
                                        <span class="small fw-bold text-secondary">Identitas Pembuat Pernyataan (Pasien
                                            / Wali):</span>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row gy-2">
                                            <div class="col-md-5">
                                                <label class="form-label small mb-1">Nama Lengkap <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="nama_pj" id="anestesi_nama_pj"
                                                    class="form-control form-control-sm" required
                                                    placeholder="Nama Yang Menyatakan">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label small mb-1">Tgl. Lahir</label>
                                                <input type="date" name="tgl_lahir_pj" id="anestesi_tgl_lahir_pj"
                                                    class="form-control form-control-sm">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label small mb-1">Umur (Thn)</label>
                                                <input type="text" name="umur_pj" id="anestesi_umur_pj"
                                                    class="form-control form-control-sm" placeholder="Contoh: 30">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label small mb-1">Jenis Kelamin</label>
                                                <select name="jk_pj" id="anestesi_jk_pj"
                                                    class="form-select form-select-sm">
                                                    <option value="L">Laki-laki</option>
                                                    <option value="P">Perempuan</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label small mb-1">No. Telp / WA</label>
                                                <input type="text" name="no_telp_pj" id="anestesi_no_telp_pj"
                                                    class="form-control form-control-sm">
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label small mb-1">Alamat Lengkap</label>
                                                <textarea name="alamat_pj" id="anestesi_alamat_pj" class="form-control"
                                                    placeholder="Alamat lengkap pembuat pernyataan" cols="12" rows="3"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <span class="small fw-bold text-primary">
                                            <i class="bi bi-pen me-1"></i> Tanda Tangan Pasien / Wali
                                        </span>
                                        <input type="hidden" name="tanda_tangan_pj" id="anestesi_tanda_tangan_pj">
                                        <div class="border rounded bg-white p-1 shadow-sm mt-1"
                                            style="width: 100%; max-width: 360px; height: 160px; position: relative;">
                                            <canvas id="canvasSignatureAnestesi" width="350" height="150"
                                                style="touch-action: none; cursor: crosshair; width: 100%; height: 100%;"></canvas>
                                        </div>
                                        <button type="button" class="btn btn-outline-danger btn-sm py-0 px-2 mt-1"
                                            style="font-size: 11px;" onclick="resetSignatureAnestesi()">
                                            <i class="bi bi-eraser me-1"></i> Bersihkan TTD
                                        </button>
                                    </div>


                                    <div class="col-12 mt-2">
                                        <span class="small fw-bold text-secondary">Saksi-Saksi:</span>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small mb-1">Saksi 1 (Keluarga)</label>
                                        <input type="text" name="saksi_keluarga" id="anestesi_saksi_keluarga"
                                            class="form-control form-control-sm"
                                            placeholder="Nama Saksi Pihak Keluarga">
                                        <div class="">
                                            <span class="small fw-bold text-primary">
                                                <i class="bi bi-pen me-1"></i> Tanda Tangan Saksi Keluarga
                                            </span>
                                            <input type="hidden" name="tanda_tangan_saksi_keluarga"
                                                id="anestesi_tanda_tangan_saksi_keluarga">
                                            <div class="border rounded bg-white p-1 shadow-sm mt-1"
                                                style="width: 100%; max-width: 360px; height: 160px; position: relative;">
                                                <canvas id="canvasSignatureSaksiKeluarga" width="350"
                                                    height="150"
                                                    style="touch-action: none; cursor: crosshair; width: 100%; height: 100%;"></canvas>
                                            </div>
                                            <button type="button"
                                                class="btn btn-outline-danger btn-sm py-0 px-2 mt-1"
                                                style="font-size: 11px;" onclick="resetSignatureSaksiKeluarga()">
                                                <i class="bi bi-eraser me-1"></i> Bersihkan TTD
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small mb-1">Saksi 2 (Petugas / Tenaga Medis)</label>
                                        <input type="hidden" name="saksi_tenaga_medis"
                                            id="anestesi_saksi_tenaga_medis">
                                        <select name="nip_petugas" id="anestesi_nip_petugas" class="select2 w-100"
                                            data-dropdown-parent="#modalPersetujuanAnestesi"></select>
                                    </div>

                                    <!-- Section 4: Tanda Tangan Digital -->

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between py-2 px-3 bg-white border-top">
                <div>
                    <button type="button" class="btn btn-outline-danger btn-sm" id="btnHapusAnestesi"
                        onclick="hapusPersetujuanAnestesi()" style="display:none;">
                        <i class="bi bi-trash"></i> Hapus Data Ini
                    </button>
                    <button type="button" class="btn btn-outline-secondary btn-sm ms-1" id="btnCetakAnestesi"
                        onclick="cetakPersetujuanAnestesi()" style="display:none;">
                        <i class="bi bi-printer"></i> Cetak PDF
                    </button>
                </div>
                <div>
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary btn-sm fw-bold px-3 ms-1"
                        onclick="simpanPersetujuanAnestesi()">
                        <i class="bi bi-save me-1"></i> Simpan Data
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script src="{{ asset('js/signature_pad.umd.js') }}"></script>
    <script>
        let pasienAktifAnestesi = null;
        let daftarRiwayatAnestesi = [];
        let signaturePadAnestesi = null;
        let signaturePadSaksiKeluarga = null;
        let pjPasienAnestesi = null;

        function initSignaturePadAnestesi() {
            const canvas = document.getElementById('canvasSignatureAnestesi');
            if (!canvas) return;

            if (signaturePadAnestesi) {
                signaturePadAnestesi.clear();
                return;
            }

            signaturePadAnestesi = new SignaturePad(canvas, {
                backgroundColor: 'rgb(255, 255, 255)',
                penColor: 'rgb(0, 0, 0)',
                minWidth: 1.5,
                maxWidth: 3.5
            });
        }

        function initSignaturePadSaksiKeluarga() {
            const canvas = document.getElementById('canvasSignatureSaksiKeluarga');
            if (!canvas) return;

            if (signaturePadSaksiKeluarga) {
                signaturePadSaksiKeluarga.clear();
                return;
            }

            signaturePadSaksiKeluarga = new SignaturePad(canvas, {
                backgroundColor: 'rgb(255, 255, 255)',
                penColor: 'rgb(0, 0, 0)',
                minWidth: 1.5,
                maxWidth: 3.5
            });
        }

        function resetSignatureAnestesi() {
            if (signaturePadAnestesi) {
                signaturePadAnestesi.clear();
            }
            $('#anestesi_tanda_tangan_pj').val('');
        }

        function resetSignatureSaksiKeluarga() {
            if (signaturePadSaksiKeluarga) {
                signaturePadSaksiKeluarga.clear();
            }
            $('#anestesi_tanda_tangan_saksi_keluarga').val('');
        }

        function toggleCheckAllInformasi() {
            let items = $('.check-info-item');
            let isAllChecked = items.length === items.filter(':checked').length;
            items.prop('checked', !isAllChecked);
        }

        $('#modalPersetujuanAnestesi').on('shown.bs.modal', function() {
            initSignaturePadAnestesi();
            initSignaturePadSaksiKeluarga();
        });

        function initDokterAnestesiSelect(selectedKd = '') {
            $.ajax({
                url: "{{ route('dokter.cari') }}",
                type: 'GET',
                dataType: 'JSON',
                success: function(response) {
                    let opt = '<option value="">-- Pilih Dokter Anestesi --</option>';
                    response.forEach(function(d) {
                        let sps = d.spesialis ? ` (${d.spesialis.nm_sps})` : '';
                        let isSel = (d.kd_dokter === selectedKd) ? 'selected' : '';
                        opt += `<option value="${d.kd_dokter}" ${isSel}>${d.nm_dokter}${sps}</option>`;
                    });
                    $('#anestesi_kd_dokter').html(opt);
                    if (selectedKd) {
                        $('#anestesi_kd_dokter').val(selectedKd).trigger('change');
                    }
                }
            });
        }

        $('#anestesi_nip_petugas').on('select2:select', function(e) {
            let nama = e.params.data.text;
            $('#anestesi_saksi_tenaga_medis').val(nama);
        });

        function initPetugasSelect(selectedNip = '', selectedNama = '') {
            $('#anestesi_nip_petugas').select2({
                dropdownParent: $('#modalPersetujuanAnestesi'),
                ajax: {
                    url: "{{ route('petugas.cari') }}",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    id: item.nip,
                                    text: item.nama + ' (' + (item.departemen || item.nip) + ')'
                                };
                            })
                        };
                    },
                    cache: true
                },
                placeholder: 'Pilih / Cari Petugas Pembuat',
                allowClear: true
            });

            if (selectedNip && selectedNama) {
                let opt = new Option(selectedNama, selectedNip, true, true);
                $('#anestesi_nip_petugas').append(opt).trigger('change');
            } else {
                let sessionNik = "{{ session()->get('pegawai')->nik ?? '' }}";
                let sessionNama = "{{ session()->get('pegawai')->nama ?? '' }}";
                if (sessionNik && sessionNama) {
                    let opt = new Option(sessionNama, sessionNik, true, true);
                    $('#anestesi_nip_petugas').append(opt).trigger('change');
                    $('#anestesi_saksi_tenaga_medis').val(sessionNama);
                }
            }
        }

        // Auto fill freetext pemberi informasi jika dokter anestesi dipilih
        $('#anestesi_kd_dokter').on('select2:select change', function() {
            let drText = $('#anestesi_kd_dokter option:selected').text();
            if (drText && drText !== '-- Pilih Dokter Anestesi --' && !$('#anestesi_pemberi_informasi').val()) {
                let cleanName = drText.split(' (')[0];
                $('#anestesi_pemberi_informasi').val(cleanName);
            }
        });

        function showModalPersetujuanAnestesi(no_rawat) {
            $('#anestesi_no_rawat').val(no_rawat);
            $('#info_anestesi_no_rawat').text(no_rawat);

            getRegPeriksa(no_rawat).done((response) => {
                const {
                    pasien,
                    tgl_registrasi
                } = response;

                let umurObj = (pasien && pasien.tgl_lahir) ? hitungUmurDaftar(pasien.tgl_lahir, tgl_registrasi) : {
                    tahun: 0,
                    bulan: 0,
                    hari: 0
                };
                let umurDaftarText = `${umurObj.tahun} Th ${umurObj.bulan} Bln ${umurObj.hari} Hari`;

                pasienAktifAnestesi = {
                    ...pasien,
                    umurTahun: umurObj.tahun,
                    umurText: umurDaftarText
                };

                pjPasienAnestesi = {
                    nama_pj: response.p_jawab,
                    almt_pj: response.almt_pj,
                }

                $('#info_anestesi_no_rkm_medis').text(pasien.no_rkm_medis || '-');
                $('#info_anestesi_nm_pasien').text(pasien.nm_pasien || '-');
                $('#info_anestesi_ttl_jk').text(
                    `${pasien.tgl_lahir || ''} / ${umurDaftarText} / ${pasien.jk || ''}`);
            });

            initDokterAnestesiSelect();
            initPetugasSelect();
            loadRiwayatPersetujuanAnestesi(no_rawat);
            $('#modalPersetujuanAnestesi').modal('show');
        }

        function loadRiwayatPersetujuanAnestesi(no_rawat) {
            $.ajax({
                url: "{{ route('persetujuan-anestesi.get') }}",
                type: 'GET',
                data: {
                    no_rawat: no_rawat
                },
                success: function(data) {
                    daftarRiwayatAnestesi = data || [];
                    renderTableRiwayatAnestesi();
                    resetFormPersetujuanAnestesi();
                }
            });
        }

        function renderTableRiwayatAnestesi() {
            let html = '';
            if (daftarRiwayatAnestesi.length === 0) {
                html =
                    '<tr><td colspan="6" class="text-center py-2 text-muted">Belum ada riwayat persetujuan tindakan anestesi.</td></tr>';
            } else {
                daftarRiwayatAnestesi.forEach(function(item, idx) {
                    let badgeStatus = item.jenis_pernyataan === 'SETUJU' ?
                        '<span class="badge bg-success">SETUJU</span>' :
                        '<span class="badge bg-danger">MENOLAK</span>';
                    let drName = item.dokter_anestesi ? item.dokter_anestesi.nm_dokter : '-';

                    html += `
                    <tr>
                        <td class="text-center">${idx + 1}</td>
                        <td class="text-center">${item.tanggal} ${item.jam}</td>
                        <td>${drName}</td>
                        <td class="text-center">${badgeStatus}</td>
                        <td>${item.diagnosis || '-'}</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-outline-primary btn-sm py-0 px-2" title="Edit Data" onclick="editPersetujuanAnestesi(${item.id})">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button type="button" class="btn btn-outline-secondary btn-sm py-0 px-2" title="Cetak PDF" onclick="cetakPersetujuanAnestesi(${item.id})">
                                <i class="bi bi-printer"></i>
                            </button>
                            <button type="button" class="btn btn-outline-danger btn-sm py-0 px-2" title="Hapus Data" onclick="hapusPersetujuanAnestesi(${item.id})">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                `;
                });
            }
            $('#list_riwayat_anestesi').html(html);
        }

        function resetFormPersetujuanAnestesi() {
            let no_rawat = $('#anestesi_no_rawat').val();
            $('#formPersetujuanAnestesi')[0].reset();
            $('#anestesi_id').val('');
            $('#anestesi_no_rawat').val(no_rawat);
            $('#anestesi_tanggal').val("{{ date('Y-m-d') }}");
            $('#anestesi_jam').val("{{ date('H:i:s') }}");

            $('#anestesi_dasar_diagnosis').val('Anamnesis, pemeriksaan fisik, dan pemeriksaan penunjang');
            $('#anestesi_tindakan_medis').val('Regional anestesi (RA) / anestesi spinal');
            $('#anestesi_indikasi_tindakan').val('Pasien dengan kebutuhan anestesi regional, pasien operasi');
            $('#anestesi_tata_cara').val('Obat bius diberikan dengan cara disuntikkan di ruas tulang belakang');
            $('#anestesi_tujuan').val('Menghilangkan rasa sakit, memfasilitasi jalannya operasi / tindakan');
            $('#anestesi_risiko').val('Nyeri saat penyuntikan');
            $('#anestesi_komplikasi').val(
                '1. Mual, muntah, pusing, mengantuk, sulit bernafas, hipotensi, henti jantung, syok anafilaktik\n2. Alergi / hipersensitif terhadap obat'
            );
            $('#anestesi_prognosis').val('Dubia');
            $('#anestesi_alternatif_dan_risiko').val('Tidak ada');

            $('.check-info-item').prop('checked', true);
            $('#pernyataan_setuju').prop('checked', true);
            $('#anestesi_hubungan').val('Diri Sendiri');

            $('#anestesi_kd_dokter').val('').trigger('change');


            let sessionNik = "{{ session()->get('pegawai')->nik ?? '' }}";
            let sessionNama = "{{ session()->get('pegawai')->nama ?? '' }}";
            initPetugasSelect(sessionNik, sessionNama);

            if (pasienAktifAnestesi) {
                $('#anestesi_penerima_informasi').val(pasienAktifAnestesi.nm_pasien);
                $('#anestesi_nama_pj').val(pasienAktifAnestesi.nm_pasien);
                $('#anestesi_tgl_lahir_pj').val(pasienAktifAnestesi.tgl_lahir);
                $('#anestesi_umur_pj').val(pasienAktifAnestesi.umurTahun ?? pasienAktifAnestesi.umur);
                $('#anestesi_jk_pj').val(pasienAktifAnestesi.jk);
                $('#anestesi_alamat_pj').val(pasienAktifAnestesi.alamat);
                $('#anestesi_no_telp_pj').val(pasienAktifAnestesi.no_tlp);
            }

            resetSignatureAnestesi();
            resetSignatureSaksiKeluarga();

            $('#badge_mode_anestesi').removeClass('bg-warning text-dark').addClass('bg-light text-primary').text(
                'Mode: Tambah Baru');
            $('#btnHapusAnestesi').hide();
            $('#btnCetakAnestesi').hide();
        }

        function editPersetujuanAnestesi(id) {
            let item = daftarRiwayatAnestesi.find(d => d.id == id);
            if (!item) return;

            $('#anestesi_id').val(item.id);
            $('#anestesi_no_rawat').val(item.no_rawat);
            $('#anestesi_tanggal').val(item.tanggal);
            $('#anestesi_jam').val(item.jam);
            $('#anestesi_kd_dokter').val(item.kd_dokter_anestesi).trigger('change');

            let petugasNama = item.petugas ? item.petugas.nama : '';
            initPetugasSelect(item.nip_petugas, petugasNama);

            $('#anestesi_pemberi_informasi').val(item.pemberi_informasi);
            $('#anestesi_penerima_informasi').val(item.penerima_informasi);
            $('#anestesi_diagnosis').val(item.diagnosis);
            $('#anestesi_dasar_diagnosis').val(item.dasar_diagnosis);
            $('#anestesi_tindakan_medis').val(item.tindakan_medis);
            $('#anestesi_indikasi_tindakan').val(item.indikasi_tindakan);
            $('#anestesi_tata_cara').val(item.tata_cara);
            $('#anestesi_tujuan').val(item.tujuan);
            $('#anestesi_risiko').val(item.risiko);
            $('#anestesi_komplikasi').val(item.komplikasi);
            $('#anestesi_prognosis').val(item.prognosis);
            $('#anestesi_alternatif_dan_risiko').val(item.alternatif_dan_risiko);

            // Checkboxes
            $('input[name=check_diagnosis]').prop('checked', item.check_diagnosis == '1');
            $('input[name=check_dasar_diagnosis]').prop('checked', item.check_dasar_diagnosis == '1');
            $('input[name=check_tindakan_medis]').prop('checked', item.check_tindakan_medis == '1');
            $('input[name=check_indikasi_tindakan]').prop('checked', item.check_indikasi_tindakan == '1');
            $('input[name=check_tata_cara]').prop('checked', item.check_tata_cara == '1');
            $('input[name=check_tujuan]').prop('checked', item.check_tujuan == '1');
            $('input[name=check_risiko]').prop('checked', item.check_risiko == '1');
            $('input[name=check_komplikasi]').prop('checked', item.check_komplikasi == '1');
            $('input[name=check_prognosis]').prop('checked', item.check_prognosis == '1');
            $('input[name=check_alternatif]').prop('checked', item.check_alternatif == '1');

            // Pernyataan & Identitas
            $(`input[name=jenis_pernyataan][value="${item.jenis_pernyataan}"]`).prop('checked', true);
            $('#anestesi_hubungan').val(item.hubungan);
            $('#anestesi_nama_pj').val(item.nama_pj);
            $('#anestesi_tgl_lahir_pj').val(item.tgl_lahir_pj);
            $('#anestesi_umur_pj').val(item.umur_pj);
            $('#anestesi_jk_pj').val(item.jk_pj);
            $('#anestesi_alamat_pj').val(item.alamat_pj);
            $('#anestesi_no_telp_pj').val(item.no_telp_pj);
            $('#anestesi_saksi_keluarga').val(item.saksi_keluarga);


            console.log(`TRIGGER BUTTON EDIT === ${id}`, item);
            console.log(`signaturePadAnestesi === `, signaturePadAnestesi);


            // Tanda Tangan
            $('#anestesi_tanda_tangan_pj').val(item.tanda_tangan_pj || '');


            if (signaturePadAnestesi) {
                signaturePadAnestesi.clear();
                if (item.tanda_tangan_pj) {
                    if (item.tanda_tangan_pj.startsWith('data:image')) {
                        signaturePadAnestesi.fromDataURL(item.tanda_tangan_pj);
                    } else {
                        let imgUrl = `{{ asset('storage') }}/${item.tanda_tangan_pj}`;
                        signaturePadAnestesi.fromDataURL(imgUrl);
                    }
                }
            }

            $('#anestesi_tanda_tangan_saksi_keluarga').val(item.tanda_tangan_saksi_keluarga || '');
            if (signaturePadSaksiKeluarga) {
                signaturePadSaksiKeluarga.clear();
                if (item.tanda_tangan_saksi_keluarga) {
                    if (item.tanda_tangan_saksi_keluarga.startsWith('data:image')) {
                        signaturePadSaksiKeluarga.fromDataURL(item.tanda_tangan_saksi_keluarga);
                    } else {
                        let imgUrl = `{{ asset('storage') }}/${item.tanda_tangan_saksi_keluarga}`;
                        signaturePadSaksiKeluarga.fromDataURL(imgUrl);
                    }
                }
            }

            $('#badge_mode_anestesi').removeClass('bg-light text-primary').addClass('bg-warning text-dark').text(
                `Mode: Edit (Sesi ${item.tanggal})`);
            $('#btnHapusAnestesi').show();
            $('#btnCetakAnestesi').show();
        }

        // Auto-fill jika memilih hubungan "Diri Sendiri"
        $('#anestesi_hubungan').on('change', function() {
            if ($(this).val() === 'Diri Sendiri' && pasienAktifAnestesi) {
                $('#anestesi_nama_pj').val(pasienAktifAnestesi.nm_pasien);
                $('#anestesi_tgl_lahir_pj').val(pasienAktifAnestesi.tgl_lahir);
                $('#anestesi_umur_pj').val(pasienAktifAnestesi.umurTahun ?? pasienAktifAnestesi.umur);
                $('#anestesi_jk_pj').val(pasienAktifAnestesi.jk);
                $('#anestesi_alamat_pj').val(pasienAktifAnestesi.alamat);
                $('#anestesi_no_telp_pj').val(pasienAktifAnestesi.no_tlp);
            } else {
                console.log('PN PASIEN ===', pjPasienAnestesi);

                $('#anestesi_nama_pj').val(pjPasienAnestesi.nama_pj);
                $('#anestesi_penerima_informasi').val(pjPasienAnestesi.nama_pj);
                $('#anestesi_tgl_lahir_pj').val(moment().format('YYYY-MM-DD'));
                $('#anestesi_alamat_pj').val(pjPasienAnestesi.almt_pj);
            }
        });

        $('#anestesi_tgl_lahir_pj').on('change', function() {
            let tglLahirPj = $(this).val();
            let umurPj = hitungUmur(tglLahirPj);
            $('#anestesi_umur_pj').val(umurPj);
        });

        function simpanPersetujuanAnestesi() {
            let form = $('#formPersetujuanAnestesi');
            if (!form[0].checkValidity()) {
                form[0].reportValidity();
                return;
            }

            if (signaturePadAnestesi && !signaturePadAnestesi.isEmpty()) {
                $('#anestesi_tanda_tangan_pj').val(signaturePadAnestesi.toDataURL('image/png'));
            }

            console.log(signaturePadSaksiKeluarga.toDataURL());
            if (signaturePadSaksiKeluarga && !signaturePadSaksiKeluarga.isEmpty()) {
                $('#anestesi_tanda_tangan_saksi_keluarga').val(signaturePadSaksiKeluarga.toDataURL('image/png'));
            }

            let formData = form.serialize();
            let no_rawat = $('#anestesi_no_rawat').val();

            $.ajax({
                url: "{{ route('persetujuan-anestesi.simpan') }}",
                type: 'POST',
                data: formData,
                success: function(res) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: res.message,
                        timer: 1500,
                        showConfirmButton: false
                    });
                    loadRiwayatPersetujuanAnestesi(no_rawat);
                },
                error: function(err) {
                    let msg = err.responseJSON?.message || 'Gagal menyimpan data.';
                    Swal.fire('Gagal!', msg, 'error');
                }
            });
        }

        function hapusPersetujuanAnestesi(id = null) {
            let targetId = id || $('#anestesi_id').val();
            if (!targetId) {
                Swal.fire('Perhatian', 'Pilih data yang ingin dihapus terlebih dahulu.', 'warning');
                return;
            }

            let no_rawat = $('#anestesi_no_rawat').val();

            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: 'Apakah Anda yakin ingin menghapus data persetujuan anestesi ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('persetujuan-anestesi.hapus') }}",
                        type: 'DELETE',
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: targetId
                        },
                        success: function(res) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Terhapus!',
                                text: res.message,
                                timer: 1500,
                                showConfirmButton: false
                            });
                            loadRiwayatPersetujuanAnestesi(no_rawat);
                        },
                        error: function(err) {
                            Swal.fire('Gagal!', 'Gagal menghapus data persetujuan.', 'error');
                        }
                    });
                }
            });
        }

        function cetakPersetujuanAnestesi(id = null) {
            let targetId = id || $('#anestesi_id').val();
            let no_rawat = $('#anestesi_no_rawat').val();

            if (targetId) {
                window.open(`{{ url('persetujuan-anestesi/print') }}?id=${targetId}`, '_blank');
            } else if (no_rawat) {
                let clean = no_rawat.replace(/\//g, '-');
                window.open(`{{ url('persetujuan-anestesi/print') }}?no_rawat=${clean}`, '_blank');
            } else {
                Swal.fire('Perhatian', 'Simpan data terlebih dahulu sebelum mencetak.', 'warning');
            }
        }
    </script>
@endpush
