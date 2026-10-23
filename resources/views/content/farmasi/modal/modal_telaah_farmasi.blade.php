<!-- Modal Telaah Resep & Verifikasi Obat Farmasi (Khanza DlgResepObat) -->
<div class="modal fade" id="modalTelaahFarmasi" tabindex="-1" aria-labelledby="modalTelaahFarmasiLabel" aria-hidden="true" style="z-index: 1070;">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow">
            
            <!-- Modal Header -->
            <div class="modal-header bg-teal text-white py-2 px-3" style="background-color: #0f766e;">
                <div class="d-flex align-items-center gap-2">
                    <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                        <i class="bi bi-shield-check fs-5 text-white"></i>
                    </div>
                    <div>
                        <h6 class="modal-title fw-bold mb-0 text-white" id="modalTelaahFarmasiLabel">
                            TELAAH RESEP &amp; VERIFIKASI OBAT FARMASI
                        </h6>
                        <small class="text-white-50" style="font-size: 11px;">Evaluasi Klinis Resep &amp; Verifikasi Keselamatan Pasien Farmasi</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body p-3 bg-light">
                <form id="formTelaahFarmasi">
                    <input type="hidden" id="telaah_no_resep" name="no_resep">

                    <!-- Info Resep / Pasien -->
                    <div class="card border-0 shadow-sm rounded-3 mb-3 bg-white">
                        <div class="card-body p-2.5">
                            <div class="row g-2 align-items-center" style="font-size: 11.5px;">
                                <div class="col-md-3 col-6">
                                    <label class="text-muted small mb-0 d-block" style="font-size: 10px;">NO. RESEP / ORDER</label>
                                    <strong class="text-primary font-monospace" id="lblTelaahNoResep">-</strong>
                                </div>
                                <div class="col-md-3 col-6">
                                    <label class="text-muted small mb-0 d-block" style="font-size: 10px;">NO. RAWAT</label>
                                    <strong class="text-dark font-monospace" id="lblTelaahNoRawat">-</strong>
                                </div>
                                <div class="col-md-3 col-6">
                                    <label class="text-muted small mb-0 d-block" style="font-size: 10px;">NAMA PASIEN</label>
                                    <strong class="text-dark" id="lblTelaahNmPasien">-</strong>
                                </div>
                                <div class="col-md-3 col-6">
                                    <label class="text-muted small mb-0 d-block" style="font-size: 10px;">RUANG / DOKTER</label>
                                    <span class="text-dark" id="lblTelaahRuangDokter">-</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- BAGIAN 1: TELAAH RESEP -->
                    <div class="card border-0 shadow-sm rounded-3 mb-3 bg-white">
                        <div class="card-header bg-white border-bottom py-2 d-flex justify-content-between align-items-center">
                            <span class="fw-bold text-teal" style="font-size: 12px; color: #0f766e;">
                                <i class="bi bi-file-earmark-medical me-1"></i> A. TELAAH RESEP (PENGKAJIAN KLINIS &amp; FARMASETIS)
                            </span>
                            <button type="button" class="btn btn-outline-secondary btn-sm py-0 px-2" style="font-size: 10.5px;" onclick="resetTelaahDefault()">
                                <i class="bi bi-magic me-1"></i> Set Semua "Ya" &amp; Sesuai
                            </button>
                        </div>
                        <div class="card-body p-2">
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm align-middle mb-0" style="font-size: 11.5px;">
                                    <thead class="table-light text-center">
                                        <tr>
                                            <th width="5%">No</th>
                                            <th width="35%">Parameter Penilaian</th>
                                            <th width="20%">Status</th>
                                            <th width="40%">Keterangan Khusus</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- 1. Tepat Identifikasi Pasien -->
                                        <tr>
                                            <td class="text-center fw-bold">1</td>
                                            <td>Tepat Identifikasi Pasien</td>
                                            <td class="text-center">
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <input type="radio" class="btn-check" name="resep_identifikasi_pasien" id="id_pasien_ya" value="Ya" checked>
                                                    <label class="btn btn-outline-success py-0 px-2" for="id_pasien_ya">Ya</label>
                                                    <input type="radio" class="btn-check" name="resep_identifikasi_pasien" id="id_pasien_tdk" value="Tidak">
                                                    <label class="btn btn-outline-danger py-0 px-2" for="id_pasien_tdk">Tidak</label>
                                                </div>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control form-control-sm py-0" name="resep_ket_identifikasi_pasien" id="resep_ket_identifikasi_pasien" value="-" maxlength="30">
                                            </td>
                                        </tr>
                                        <!-- 2. Tepat Obat -->
                                        <tr>
                                            <td class="text-center fw-bold">2</td>
                                            <td>Tepat Obat &amp; Indikasi</td>
                                            <td class="text-center">
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <input type="radio" class="btn-check" name="resep_tepat_obat" id="tepat_obat_ya" value="Ya" checked>
                                                    <label class="btn btn-outline-success py-0 px-2" for="tepat_obat_ya">Ya</label>
                                                    <input type="radio" class="btn-check" name="resep_tepat_obat" id="tepat_obat_tdk" value="Tidak">
                                                    <label class="btn btn-outline-danger py-0 px-2" for="tepat_obat_tdk">Tidak</label>
                                                </div>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control form-control-sm py-0" name="resep_ket_tepat_obat" id="resep_ket_tepat_obat" value="-" maxlength="30">
                                            </td>
                                        </tr>
                                        <!-- 3. Tepat Dosis -->
                                        <tr>
                                            <td class="text-center fw-bold">3</td>
                                            <td>Tepat Dosis &amp; Kekuatan</td>
                                            <td class="text-center">
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <input type="radio" class="btn-check" name="resep_tepat_dosis" id="tepat_dosis_ya" value="Ya" checked>
                                                    <label class="btn btn-outline-success py-0 px-2" for="tepat_dosis_ya">Ya</label>
                                                    <input type="radio" class="btn-check" name="resep_tepat_dosis" id="tepat_dosis_tdk" value="Tidak">
                                                    <label class="btn btn-outline-danger py-0 px-2" for="tepat_dosis_tdk">Tidak</label>
                                                </div>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control form-control-sm py-0" name="resep_ket_tepat_dosis" id="resep_ket_tepat_dosis" value="-" maxlength="30">
                                            </td>
                                        </tr>
                                        <!-- 4. Tepat Cara Pemberian -->
                                        <tr>
                                            <td class="text-center fw-bold">4</td>
                                            <td>Tepat Cara / Rute Pemberian</td>
                                            <td class="text-center">
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <input type="radio" class="btn-check" name="resep_tepat_cara_pemberian" id="tepat_cara_ya" value="Ya" checked>
                                                    <label class="btn btn-outline-success py-0 px-2" for="tepat_cara_ya">Ya</label>
                                                    <input type="radio" class="btn-check" name="resep_tepat_cara_pemberian" id="tepat_cara_tdk" value="Tidak">
                                                    <label class="btn btn-outline-danger py-0 px-2" for="tepat_cara_tdk">Tidak</label>
                                                </div>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control form-control-sm py-0" name="resep_ket_tepat_cara_pemberian" id="resep_ket_tepat_cara_pemberian" value="-" maxlength="30">
                                            </td>
                                        </tr>
                                        <!-- 5. Tepat Waktu Pemberian -->
                                        <tr>
                                            <td class="text-center fw-bold">5</td>
                                            <td>Tepat Waktu &amp; Frekuensi</td>
                                            <td class="text-center">
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <input type="radio" class="btn-check" name="resep_tepat_waktu_pemberian" id="tepat_waktu_ya" value="Ya" checked>
                                                    <label class="btn btn-outline-success py-0 px-2" for="tepat_waktu_ya">Ya</label>
                                                    <input type="radio" class="btn-check" name="resep_tepat_waktu_pemberian" id="tepat_waktu_tdk" value="Tidak">
                                                    <label class="btn btn-outline-danger py-0 px-2" for="tepat_waktu_tdk">Tidak</label>
                                                </div>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control form-control-sm py-0" name="resep_ket_tepat_waktu_pemberian" id="resep_ket_tepat_waktu_pemberian" value="-" maxlength="30">
                                            </td>
                                        </tr>
                                        <!-- 6. Duplikasi Obat -->
                                        <tr>
                                            <td class="text-center fw-bold">6</td>
                                            <td>Bebas Duplikasi Obat</td>
                                            <td class="text-center">
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <input type="radio" class="btn-check" name="resep_ada_tidak_duplikasi_obat" id="duplikasi_ya" value="Ya" checked>
                                                    <label class="btn btn-outline-success py-0 px-2" for="duplikasi_ya">Ya</label>
                                                    <input type="radio" class="btn-check" name="resep_ada_tidak_duplikasi_obat" id="duplikasi_tdk" value="Tidak">
                                                    <label class="btn btn-outline-danger py-0 px-2" for="duplikasi_tdk">Tidak</label>
                                                </div>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control form-control-sm py-0" name="resep_ket_ada_tidak_duplikasi_obat" id="resep_ket_ada_tidak_duplikasi_obat" value="-" maxlength="30">
                                            </td>
                                        </tr>
                                        <!-- 7. Interaksi Obat -->
                                        <tr>
                                            <td class="text-center fw-bold">7</td>
                                            <td>Interaksi Obat Berbahaya</td>
                                            <td class="text-center">
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <input type="radio" class="btn-check" name="resep_interaksi_obat" id="interaksi_tdk" value="Tidak" checked>
                                                    <label class="btn btn-outline-success py-0 px-2" for="interaksi_tdk">Tidak Ada</label>
                                                    <input type="radio" class="btn-check" name="resep_interaksi_obat" id="interaksi_ya" value="Ya">
                                                    <label class="btn btn-outline-danger py-0 px-2" for="interaksi_ya">Ada</label>
                                                </div>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control form-control-sm py-0" name="resep_ket_interaksi_obat" id="resep_ket_interaksi_obat" value="-" maxlength="30">
                                            </td>
                                        </tr>
                                        <!-- 8. Kontra Indikasi Obat -->
                                        <tr>
                                            <td class="text-center fw-bold">8</td>
                                            <td>Kontra Indikasi Obat</td>
                                            <td class="text-center">
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <input type="radio" class="btn-check" name="resep_kontra_indikasi_obat" id="kontra_tdk" value="Tidak" checked>
                                                    <label class="btn btn-outline-success py-0 px-2" for="kontra_tdk">Tidak Ada</label>
                                                    <input type="radio" class="btn-check" name="resep_kontra_indikasi_obat" id="kontra_ya" value="Ya">
                                                    <label class="btn btn-outline-danger py-0 px-2" for="kontra_ya">Ada</label>
                                                </div>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control form-control-sm py-0" name="resep_ket_kontra_indikasi_obat" id="resep_ket_kontra_indikasi_obat" value="-" maxlength="30">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- BAGIAN 2: TELAAH OBAT (VERIFIKASI FISIK PENYIAPAN) -->
                    <div class="card border-0 shadow-sm rounded-3 mb-2 bg-white">
                        <div class="card-header bg-white border-bottom py-2">
                            <span class="fw-bold text-teal" style="font-size: 12px; color: #0f766e;">
                                <i class="bi bi-capsule me-1"></i> B. TELAAH OBAT (VERIFIKASI FISIK SEBELUM DISERAHKAN)
                            </span>
                        </div>
                        <div class="card-body p-2">
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm align-middle mb-0" style="font-size: 11.5px;">
                                    <thead class="table-light text-center">
                                        <tr>
                                            <th width="5%">No</th>
                                            <th width="65%">Parameter Verifikasi Fisik Obat</th>
                                            <th width="30%">Status Sesuai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center fw-bold">1</td>
                                            <td>Tepat Pasien &amp; Ruangan Rawat</td>
                                            <td class="text-center">
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <input type="radio" class="btn-check" name="obat_tepat_pasien" id="obat_pasien_ya" value="Ya" checked>
                                                    <label class="btn btn-outline-success py-0 px-3" for="obat_pasien_ya">Sesuai (Ya)</label>
                                                    <input type="radio" class="btn-check" name="obat_tepat_pasien" id="obat_pasien_tdk" value="Tidak">
                                                    <label class="btn btn-outline-danger py-0 px-3" for="obat_pasien_tdk">Tidak</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center fw-bold">2</td>
                                            <td>Tepat Fisik Obat &amp; Kualitas Sediaan</td>
                                            <td class="text-center">
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <input type="radio" class="btn-check" name="obat_tepat_obat" id="obat_obat_ya" value="Ya" checked>
                                                    <label class="btn btn-outline-success py-0 px-3" for="obat_obat_ya">Sesuai (Ya)</label>
                                                    <input type="radio" class="btn-check" name="obat_tepat_obat" id="obat_obat_tdk" value="Tidak">
                                                    <label class="btn btn-outline-danger py-0 px-3" for="obat_obat_tdk">Tidak</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center fw-bold">3</td>
                                            <td>Tepat Dosis &amp; Kekuatan Sediaan</td>
                                            <td class="text-center">
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <input type="radio" class="btn-check" name="obat_tepat_dosis" id="obat_dosis_ya" value="Ya" checked>
                                                    <label class="btn btn-outline-success py-0 px-3" for="obat_dosis_ya">Sesuai (Ya)</label>
                                                    <input type="radio" class="btn-check" name="obat_tepat_dosis" id="obat_dosis_tdk" value="Tidak">
                                                    <label class="btn btn-outline-danger py-0 px-3" for="obat_dosis_tdk">Tidak</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center fw-bold">4</td>
                                            <td>Tepat Rute &amp; Cara Pemberian</td>
                                            <td class="text-center">
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <input type="radio" class="btn-check" name="obat_tepat_cara_pemberian" id="obat_cara_ya" value="Ya" checked>
                                                    <label class="btn btn-outline-success py-0 px-3" for="obat_cara_ya">Sesuai (Ya)</label>
                                                    <input type="radio" class="btn-check" name="obat_tepat_cara_pemberian" id="obat_cara_tdk" value="Tidak">
                                                    <label class="btn btn-outline-danger py-0 px-3" for="obat_cara_tdk">Tidak</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center fw-bold">5</td>
                                            <td>Tepat Waktu &amp; Jadwal Pemberian UDD</td>
                                            <td class="text-center">
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <input type="radio" class="btn-check" name="obat_tepat_waktu_pemberian" id="obat_waktu_ya" value="Ya" checked>
                                                    <label class="btn btn-outline-success py-0 px-3" for="obat_waktu_ya">Sesuai (Ya)</label>
                                                    <input type="radio" class="btn-check" name="obat_tepat_waktu_pemberian" id="obat_waktu_tdk" value="Tidak">
                                                    <label class="btn btn-outline-danger py-0 px-3" for="obat_waktu_tdk">Tidak</label>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-2 px-1 text-muted" style="font-size: 11px;">
                        <span>Petugas Penelaah: <strong id="lblTelaahPetugas">{{ session()->get('pegawai')->nama ?? '-' }} ({{ session()->get('pegawai')->nik ?? '-' }})</strong></span>
                        <span id="lblTelaahStatusTersimpan" class="text-success fw-semibold d-none"><i class="bi bi-check-circle-fill me-1"></i> Data Telaah Tersimpan di Database</span>
                    </div>

                </form>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer py-1.5 px-3 bg-white d-flex justify-content-between">
                <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-success btn-sm px-4 shadow" id="btnSimpanTelaahFarmasi">
                    <i class="bi bi-save me-1"></i> Simpan Hasil Telaah
                </button>
            </div>

        </div>
    </div>
</div>

@push('script')
<script>
    // Buka Modal Telaah Farmasi
    function bukaModalTelaahFarmasi(noResep, noRawat = '', nmPasien = '', ruangDokter = '') {
        noResep = (noResep || '').toString().replace(/[\r\n\t]+/g, ' ').trim();
        noRawat = (noRawat || '').toString().replace(/[\r\n\t]+/g, ' ').trim();
        nmPasien = (nmPasien || '').toString().replace(/[\r\n\t]+/g, ' ').trim();
        ruangDokter = (ruangDokter || '').toString().replace(/[\r\n\t]+/g, ' ').trim();

        if (!noResep) {
            Swal.fire('Peringatan', 'Nomor resep/permintaan tidak valid.', 'warning');
            return;
        }

        $('#telaah_no_resep').val(noResep);
        $('#lblTelaahNoResep').text(noResep);
        $('#lblTelaahNoRawat').text(noRawat || '-');
        $('#lblTelaahNmPasien').text(nmPasien || '-');
        $('#lblTelaahRuangDokter').text(ruangDokter || '-');
        $('#lblTelaahStatusTersimpan').addClass('d-none');

        // Reset default form
        resetTelaahDefault();

        // Ambil data jika sudah pernah ditelaah sebelumnya
        $.get(`{{ url('/farmasi/telaah') }}/${encodeURIComponent(noResep)}`).done(function(res) {
            if (res.status && res.data) {
                const d = res.data;
                // Set radio dan keterangan
                setRadioVal('resep_identifikasi_pasien', d.resep_identifikasi_pasien);
                $('#resep_ket_identifikasi_pasien').val(d.resep_ket_identifikasi_pasien || '-');

                setRadioVal('resep_tepat_obat', d.resep_tepat_obat);
                $('#resep_ket_tepat_obat').val(d.resep_ket_tepat_obat || '-');

                setRadioVal('resep_tepat_dosis', d.resep_tepat_dosis);
                $('#resep_ket_tepat_dosis').val(d.resep_ket_tepat_dosis || '-');

                setRadioVal('resep_tepat_cara_pemberian', d.resep_tepat_cara_pemberian);
                $('#resep_ket_tepat_cara_pemberian').val(d.resep_ket_tepat_cara_pemberian || '-');

                setRadioVal('resep_tepat_waktu_pemberian', d.resep_tepat_waktu_pemberian);
                $('#resep_ket_tepat_waktu_pemberian').val(d.resep_ket_tepat_waktu_pemberian || '-');

                setRadioVal('resep_ada_tidak_duplikasi_obat', d.resep_ada_tidak_duplikasi_obat);
                $('#resep_ket_ada_tidak_duplikasi_obat').val(d.resep_ket_ada_tidak_duplikasi_obat || '-');

                setRadioVal('resep_interaksi_obat', d.resep_interaksi_obat);
                $('#resep_ket_interaksi_obat').val(d.resep_ket_interaksi_obat || '-');

                setRadioVal('resep_kontra_indikasi_obat', d.resep_kontra_indikasi_obat);
                $('#resep_ket_kontra_indikasi_obat').val(d.resep_ket_kontra_indikasi_obat || '-');

                setRadioVal('obat_tepat_pasien', d.obat_tepat_pasien);
                setRadioVal('obat_tepat_obat', d.obat_tepat_obat);
                setRadioVal('obat_tepat_dosis', d.obat_tepat_dosis);
                setRadioVal('obat_tepat_cara_pemberian', d.obat_tepat_cara_pemberian);
                setRadioVal('obat_tepat_waktu_pemberian', d.obat_tepat_waktu_pemberian);

                if (d.petugas) {
                    $('#lblTelaahPetugas').text(`${d.petugas.nama} (${d.nip})`);
                }
                $('#lblTelaahStatusTersimpan').removeClass('d-none');
            }
        });

        $('#modalTelaahFarmasi').modal('show');
    }

    // Helper set nilai radio button
    function setRadioVal(name, val) {
        if (!val) return;
        $(`input[name="${name}"][value="${val}"]`).prop('checked', true);
    }

    // Reset Form ke Preset Default "Ya" dan Sesuai
    function resetTelaahDefault() {
        setRadioVal('resep_identifikasi_pasien', 'Ya');
        $('#resep_ket_identifikasi_pasien').val('-');

        setRadioVal('resep_tepat_obat', 'Ya');
        $('#resep_ket_tepat_obat').val('-');

        setRadioVal('resep_tepat_dosis', 'Ya');
        $('#resep_ket_tepat_dosis').val('-');

        setRadioVal('resep_tepat_cara_pemberian', 'Ya');
        $('#resep_ket_tepat_cara_pemberian').val('-');

        setRadioVal('resep_tepat_waktu_pemberian', 'Ya');
        $('#resep_ket_tepat_waktu_pemberian').val('-');

        setRadioVal('resep_ada_tidak_duplikasi_obat', 'Ya');
        $('#resep_ket_ada_tidak_duplikasi_obat').val('-');

        setRadioVal('resep_interaksi_obat', 'Tidak');
        $('#resep_ket_interaksi_obat').val('-');

        setRadioVal('resep_kontra_indikasi_obat', 'Tidak');
        $('#resep_ket_kontra_indikasi_obat').val('-');

        setRadioVal('obat_tepat_pasien', 'Ya');
        setRadioVal('obat_tepat_obat', 'Ya');
        setRadioVal('obat_tepat_dosis', 'Ya');
        setRadioVal('obat_tepat_cara_pemberian', 'Ya');
        setRadioVal('obat_tepat_waktu_pemberian', 'Ya');
    }

    // Submit Simpan Hasil Telaah Farmasi
    $('#btnSimpanTelaahFarmasi').on('click', function() {
        const formData = $('#formTelaahFarmasi').serializeArray();
        formData.push({ name: '_token', value: "{{ csrf_token() }}" });

        $.ajax({
            url: "{{ route('farmasi.telaah.simpan') }}",
            type: "POST",
            data: formData,
            beforeSend: function() {
                Swal.fire({
                    title: 'Menyimpan Telaah...',
                    allowOutsideClick: false,
                    didOpen: () => { Swal.showLoading(); }
                });
            },
            success: function(resp) {
                Swal.fire('Berhasil!', resp.message || 'Hasil telaah farmasi berhasil disimpan.', 'success');
                $('#modalTelaahFarmasi').modal('hide');
                // Trigger refresh tabel jika ada
                if (typeof tbResep === 'function' && $.fn.DataTable.isDataTable('#tb_resep')) {
                    $('#tb_resep').DataTable().ajax.reload(null, false);
                }
                if (typeof loadDataDetailResepRalan === 'function' && $('#modalResepObat').hasClass('show') && typeof currentNoResepRalan !== 'undefined' && currentNoResepRalan) {
                    loadDataDetailResepRalan(currentNoResepRalan);
                }
                if (typeof loadResepRanapFarmasi === 'function') {
                    loadResepRanapFarmasi();
                }
                if (typeof loadPermintaanRanapFarmasi === 'function') {
                    loadPermintaanRanapFarmasi();
                }
                if (typeof loadPermintaanResepPulang === 'function') {
                    loadPermintaanResepPulang();
                }
                if (typeof loadRiwayatPermintaanPasien === 'function') {
                    loadRiwayatPermintaanPasien();
                }
            },
            error: function(xhr) {
                const msg = xhr.responseJSON?.message || 'Gagal menyimpan hasil telaah farmasi.';
                Swal.fire('Gagal!', msg, 'error');
            }
        });
    });
</script>
@endpush
