<div class="modal fade" id="modalAsmedUgd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content" style="border-radius:0px">
            <div class="modal-header bg-primary text-white py-2">
                <h5 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-hospital-fill me-2"></i> ASESMEN AWAL MEDIS GAWAT DARURAT</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="background-color: #f8f9fa;">
                <form action="" id="formAsmedUgd">
                    <div class="container-fluid" style="font-size: 12px">
                        <!-- HEADER DATA PASIEN & DOKTER -->
                        <div class="card mb-3 shadow-sm border-0">
                            <div class="card-body py-2">
                                <div class="row align-items-center">
                                    <div class="col-sm-12 col-md-6 col-lg-5">
                                        <label class="fw-bold mb-1"><i class="bi bi-person-circle"></i> Data Pasien</label>
                                        <div class="row g-2">
                                            <div class="col-4">
                                                <input type="text" class="form-control form-control-sm no_rawat" placeholder="No. Rawat" name="no_rawat" id="no_rawat" readonly style="background-color: #e9ecef;cursor:not-allowed;font-weight:bold;">
                                            </div>
                                            <div class="col-5">
                                                <input type="text" style="background-color: #e9ecef;cursor:not-allowed" class="form-control form-control-sm pasien" id="pasien" name="pasien" placeholder="Nama Pasien" readonly>
                                            </div>
                                            <div class="col-3">
                                                <input type="text" style="background-color: #e9ecef;cursor:not-allowed" class="form-control form-control-sm tgl_lahir" id="tgl_lahir" name="tgl_lahir" placeholder="Tgl Lahir" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-7">
                                        <label class="fw-bold mb-1"><i class="bi bi-person-badge"></i> Dokter Pemeriksa & Anamnesis</label>
                                        <div class="row g-2">
                                            <div class="col-md-4 position-relative">
                                                <input type="hidden" class="kd_dokter" id="kd_dokter" name="kd_dokter">
                                                <input type="search" class="form-control form-control-sm dokter" placeholder="Nama Dokter" id="dokter" name="dokter" autocomplete="off">
                                                <div class="list-dokter"></div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="input-group input-group-sm">
                                                    <select class="form-select form-select-sm" id="anamnesis" name="anamnesis" style="max-width:130px;">
                                                        <option value="Autoanamnesis" selected>Autoanamnesis</option>
                                                        <option value="Alloanamnesis">Alloanamnesis</option>
                                                    </select>
                                                    <input type="text" class="form-control form-control-sm hubungan" placeholder="Hubungan" id="hubungan" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" name="hubungan">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control form-control-sm tanggal" name="tanggal" placeholder="Tgl Asesmen" id="tanggal" readonly style="background-color: #e9ecef;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- TRIASE (ATS) -->
                        <div class="card mb-3 shadow-sm border-0">
                            <div class="card-header bg-light fw-bold py-2 text-primary d-flex align-items-center justify-content-between">
                                <div>
                                    <i class="bi bi-diagram-3-fill me-1"></i> TRIASE ( AUSTRALIAN TRIAGE SCALE )
                                    <span id="badgeAsmedTriaseLinkedStatus"></span>
                                </div>
                                <div>
                                    <button type="button" class="btn btn-sm btn-outline-danger fw-bold py-0 text-xs d-none" id="btnAsmedTarikTriasePreReg" onclick="triggerLinkTriaseFromAsmed()">
                                        <i class="bi bi-link-45deg me-1"></i> Tarik Data Triase Pre-Reg
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-2">
                                <table class="table table-bordered table-striped table-hover tblTriase mb-0" style="font-size:11px;">
                                    <thead>
                                        <tr>
                                            <th class="all">
                                                <div class="text-nowrap">Prioritas</div>
                                                <div class="text-xs text-nowrap">Waktu Tunggu</div>
                                            </th>
                                            <th class="text-center text-nowrap bg-danger text-white">
                                                <div class="text-nowrap d-flex align-items-center justify-content-center">
                                                    <input type="checkbox" class="form-check-input me-2" name="ats_1" id="ats_1">
                                                    <span class="mt-1">ATS I</span>
                                                </div>
                                                <div class="text-xs text-nowrap">Segera</div>
                                            </th>
                                            <th class="text-center bg-warning text-white">
                                                <div class="text-nowrap d-flex align-items-center justify-content-center">
                                                    <input type="checkbox" class="form-check-input me-2" name="ats_2" id="ats_2">
                                                    <span class="mt-1">ATS II</span>
                                                </div>
                                                <div class="text-xs text-nowrap">10 Menit</div>
                                            </th>
                                            <th class="text-center bg-success text-white">
                                                <div class="text-nowrap d-flex align-items-center justify-content-center">
                                                    <input type="checkbox" class="form-check-input me-2" name="ats_3" id="ats_3">
                                                    <span class="mt-1">ATS III</span>
                                                </div>
                                                <div class="text-xs text-nowrap">30 Menit</div>
                                            </th>
                                            <th class="text-center bg-primary text-white">
                                                <div class="text-nowrap d-flex align-items-center justify-content-center">
                                                    <input type="checkbox" class="form-check-input me-2" name="ats_4" id="ats_4">
                                                    <span class="mt-1">ATS IV</span>
                                                </div>
                                                <div class="text-xs text-nowrap">60 Menit</div>
                                            </th>
                                            <th class="text-center">
                                                <div class="text-nowrap d-flex align-items-center justify-content-center">
                                                    <input type="checkbox" class="form-check-input me-2" name="ats_5" id="ats_5">
                                                    <span class="mt-1">ATS V</span>
                                                </div>
                                                <div class="text-xs text-nowrap">120 Menit</div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>

                        <!-- 1. RIWAYAT KESEHATAN -->
                        <div class="card mb-3 shadow-sm border-0">
                            <div class="card-header bg-light fw-bold py-2 text-primary">
                                <i class="bi bi-journal-medical me-1"></i> 1. RIWAYAT KESEHATAN
                            </div>
                            <div class="card-body py-2">
                                <div class="row g-2">
                                    <div class="col-md-6 col-lg-3">
                                        <label for="keluhan_utama" class="form-label mb-1">Keluhan Utama</label>
                                        <textarea class="form-control" name="keluhan_utama" id="keluhan_utama" rows="3" onfocus="removeZero(this)" onblur="cekKosong(this)">-</textarea>
                                    </div>
                                    <div class="col-md-6 col-lg-3">
                                        <label for="rps" class="form-label mb-1">Riwayat Penyakit Sekarang (RPS)</label>
                                        <textarea class="form-control" name="rps" id="rps" rows="3" onfocus="removeZero(this)" onblur="cekKosong(this)">-</textarea>
                                    </div>
                                    <div class="col-md-6 col-lg-3">
                                        <label for="rpd" class="form-label mb-1">Riwayat Penyakit Dahulu (RPD)</label>
                                        <textarea class="form-control" name="rpd" id="rpd" rows="3" onfocus="removeZero(this)" onblur="cekKosong(this)">-</textarea>
                                    </div>
                                    <div class="col-md-6 col-lg-3">
                                        <label for="rpk" class="form-label mb-1">Riwayat Penyakit Keluarga (RPK)</label>
                                        <textarea class="form-control" name="rpk" id="rpk" rows="3" onfocus="removeZero(this)" onblur="cekKosong(this)">-</textarea>
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <label for="rpo" class="form-label mb-1">Riwayat Penggunaan Obat (RPO)</label>
                                        <textarea class="form-control" name="rpo" id="rpo" rows="3" onfocus="removeZero(this)" onblur="cekKosong(this)">-</textarea>
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <label for="alergi" class="form-label mb-1">Riwayat Alergi</label>
                                        <input type="text" class="form-control form-control-sm" id="alergi" name="alergi" placeholder="Alergi Obat/Makanan" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 2. PEMERIKSAAN FISIK & TANDA VITAL -->
                        <div class="card mb-3 shadow-sm border-0">
                            <div class="card-header bg-light fw-bold py-2 text-primary">
                                <i class="bi bi-heart-pulse-fill me-1"></i> 2. PEMERIKSAAN FISIK & TANDA VITAL
                            </div>
                            <div class="card-body py-2">
                                <div class="row g-2 mb-2">
                                    <div class="col-6 col-md-3 col-lg-2">
                                        <label class="form-label mb-1">Keadaan Umum</label>
                                        <select class="form-select form-select-sm" name="keadaan" id="keadaan">
                                            <option value="Sehat">Sehat</option>
                                            <option value="Sakit Ringan">Sakit Ringan</option>
                                            <option value="Sakit Sedang">Sakit Sedang</option>
                                            <option value="Sakit Berat">Sakit Berat</option>
                                        </select>
                                    </div>
                                    <div class="col-6 col-md-3 col-lg-2">
                                        <label class="form-label mb-1">Kesadaran</label>
                                        <select class="form-select form-select-sm" name="kesadaran" id="kesadaran">
                                            <option value="Compos Mentis">Compos Mentis</option>
                                            <option value="Apatis">Apatis</option>
                                            <option value="Somnolen">Somnolen</option>
                                            <option value="Sopor">Sopor</option>
                                            <option value="Koma">Koma</option>
                                        </select>
                                    </div>
                                    <div class="col-6 col-md-2 col-lg-1">
                                        <label for="gcs" class="form-label mb-1">GCS(E,V,M)</label>
                                        <input type="text" class="form-control form-control-sm" id="gcs" name="gcs" value="-" autocomplete="off">
                                    </div>
                                    <div class="col-6 col-md-2 col-lg-1">
                                        <label for="td" class="form-label mb-1">TD (mmHg)</label>
                                        <input type="text" class="form-control form-control-sm" id="td" name="td" value="-" autocomplete="off">
                                    </div>
                                    <div class="col-6 col-md-2 col-lg-1">
                                        <label for="nadi" class="form-label mb-1">Nadi (x/m)</label>
                                        <input type="text" class="form-control form-control-sm" id="nadi" name="nadi" value="-" autocomplete="off">
                                    </div>
                                    <div class="col-6 col-md-2 col-lg-1">
                                        <label for="rr" class="form-label mb-1">RR (x/m)</label>
                                        <input type="text" class="form-control form-control-sm" id="rr" name="rr" value="-" autocomplete="off">
                                    </div>
                                    <div class="col-6 col-md-2 col-lg-1">
                                        <label for="suhu" class="form-label mb-1">Suhu (&deg;C)</label>
                                        <input type="text" class="form-control form-control-sm" id="suhu" name="suhu" value="-" autocomplete="off">
                                    </div>
                                    <div class="col-6 col-md-2 col-lg-1">
                                        <label for="spo" class="form-label mb-1">SpO2 (%)</label>
                                        <input type="text" class="form-control form-control-sm" id="spo" name="spo" value="-" autocomplete="off">
                                    </div>
                                    <div class="col-6 col-md-2 col-lg-1">
                                        <label for="bb" class="form-label mb-1">BB (Kg)</label>
                                        <input type="text" class="form-control form-control-sm" id="bb" name="bb" value="-" autocomplete="off">
                                    </div>
                                    <div class="col-6 col-md-2 col-lg-1">
                                        <label for="tb" class="form-label mb-1">TB (cm)</label>
                                        <input type="text" class="form-control form-control-sm" id="tb" name="tb" value="-" autocomplete="off">
                                    </div>
                                </div>
                                <hr class="my-2">
                                <div class="mt-2">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <label class="form-label mb-0 fw-bold small text-muted">PEMERIKSAAN FISIK (STATUS GENERALIS)</label>
                                        <button type="button" class="btn btn-xs btn-outline-primary py-0 px-2" id="btnSetSemuaNormalFisik" title="Set Semua Normal" style="font-size: 11px;">
                                            <i class="bi bi-check-all me-1"></i> Set Semua Normal
                                        </button>
                                    </div>
                                    <div class="row g-2">
                                        <!-- Kolom Kiri (7 Organ) -->
                                        <div class="col-lg-6">
                                            <table class="table table-bordered table-sm align-middle mb-0 bg-white" style="font-size: 11.5px;">
                                                <thead class="table-light">
                                                    <tr class="align-middle text-center">
                                                        <th style="width: 28%;" class="text-start ps-2">Organ</th>
                                                        <th style="width: 27%;">Status</th>
                                                        <th style="width: 45%;">Jika tidak normal, jelaskan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="fw-semibold ps-2">Kepala</td>
                                                        <td>
                                                            <select class="form-select form-select-sm status-fisik py-0" name="kepala" id="kepala" data-target="ket_kepala" style="font-size: 11.5px; height: 28px;">
                                                                <option value="Normal" selected>Normal</option>
                                                                <option value="Abnormal">Abnormal</option>
                                                                <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control form-control-sm ket-fisik py-0" name="ket_kepala" id="ket_kepala" placeholder="Keterangan..." disabled style="font-size: 11.5px; height: 28px;">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-semibold ps-2">Mata</td>
                                                        <td>
                                                            <select class="form-select form-select-sm status-fisik py-0" name="mata" id="mata" data-target="ket_mata" style="font-size: 11.5px; height: 28px;">
                                                                <option value="Normal" selected>Normal</option>
                                                                <option value="Abnormal">Abnormal</option>
                                                                <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control form-control-sm ket-fisik py-0" name="ket_mata" id="ket_mata" placeholder="Keterangan..." disabled style="font-size: 11.5px; height: 28px;">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-semibold ps-2">THT</td>
                                                        <td>
                                                            <select class="form-select form-select-sm status-fisik py-0" name="tht" id="tht" data-target="ket_tht" style="font-size: 11.5px; height: 28px;">
                                                                <option value="Normal" selected>Normal</option>
                                                                <option value="Abnormal">Abnormal</option>
                                                                <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control form-control-sm ket-fisik py-0" name="ket_tht" id="ket_tht" placeholder="Keterangan..." disabled style="font-size: 11.5px; height: 28px;">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-semibold ps-2">Mulut</td>
                                                        <td>
                                                            <select class="form-select form-select-sm status-fisik py-0" name="gigi" id="gigi" data-target="ket_gigi" style="font-size: 11.5px; height: 28px;">
                                                                <option value="Normal" selected>Normal</option>
                                                                <option value="Abnormal">Abnormal</option>
                                                                <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control form-control-sm ket-fisik py-0" name="ket_gigi" id="ket_gigi" placeholder="Keterangan..." disabled style="font-size: 11.5px; height: 28px;">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-semibold ps-2">Leher</td>
                                                        <td>
                                                            <select class="form-select form-select-sm status-fisik py-0" name="leher" id="leher" data-target="ket_leher" style="font-size: 11.5px; height: 28px;">
                                                                <option value="Normal" selected>Normal</option>
                                                                <option value="Abnormal">Abnormal</option>
                                                                <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control form-control-sm ket-fisik py-0" name="ket_leher" id="ket_leher" placeholder="Keterangan..." disabled style="font-size: 11.5px; height: 28px;">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-semibold ps-2">Jantung</td>
                                                        <td>
                                                            <select class="form-select form-select-sm status-fisik py-0" name="jantung" id="jantung" data-target="ket_jantung" style="font-size: 11.5px; height: 28px;">
                                                                <option value="Normal" selected>Normal</option>
                                                                <option value="Abnormal">Abnormal</option>
                                                                <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control form-control-sm ket-fisik py-0" name="ket_jantung" id="ket_jantung" placeholder="Keterangan..." disabled style="font-size: 11.5px; height: 28px;">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-semibold ps-2">Paru-paru</td>
                                                        <td>
                                                            <select class="form-select form-select-sm status-fisik py-0" name="paru" id="paru" data-target="ket_paru" style="font-size: 11.5px; height: 28px;">
                                                                <option value="Normal" selected>Normal</option>
                                                                <option value="Abnormal">Abnormal</option>
                                                                <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control form-control-sm ket-fisik py-0" name="ket_paru" id="ket_paru" placeholder="Keterangan..." disabled style="font-size: 11.5px; height: 28px;">
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <!-- Kolom Kanan (6 Organ) -->
                                        <div class="col-lg-6">
                                            <table class="table table-bordered table-sm align-middle mb-0 bg-white" style="font-size: 11.5px;">
                                                <thead class="table-light">
                                                    <tr class="align-middle text-center">
                                                        <th style="width: 32%;" class="text-start ps-2">Organ</th>
                                                        <th style="width: 27%;">Status</th>
                                                        <th style="width: 41%;">Jika tidak normal, jelaskan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="fw-semibold ps-2">Dada & Payudara</td>
                                                        <td>
                                                            <select class="form-select form-select-sm status-fisik py-0" name="thoraks" id="thoraks" data-target="ket_thoraks" style="font-size: 11.5px; height: 28px;">
                                                                <option value="Normal" selected>Normal</option>
                                                                <option value="Abnormal">Abnormal</option>
                                                                <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control form-control-sm ket-fisik py-0" name="ket_thoraks" id="ket_thoraks" placeholder="Keterangan..." disabled style="font-size: 11.5px; height: 28px;">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-semibold ps-2">Perut</td>
                                                        <td>
                                                            <select class="form-select form-select-sm status-fisik py-0" name="abdomen" id="abdomen" data-target="ket_abdomen" style="font-size: 11.5px; height: 28px;">
                                                                <option value="Normal" selected>Normal</option>
                                                                <option value="Abnormal">Abnormal</option>
                                                                <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control form-control-sm ket-fisik py-0" name="ket_abdomen" id="ket_abdomen" placeholder="Keterangan..." disabled style="font-size: 11.5px; height: 28px;">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-semibold ps-2">Urogenital</td>
                                                        <td>
                                                            <select class="form-select form-select-sm status-fisik py-0" name="genital" id="genital" data-target="ket_genital" style="font-size: 11.5px; height: 28px;">
                                                                <option value="Normal" selected>Normal</option>
                                                                <option value="Abnormal">Abnormal</option>
                                                                <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control form-control-sm ket-fisik py-0" name="ket_genital" id="ket_genital" placeholder="Keterangan..." disabled style="font-size: 11.5px; height: 28px;">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-semibold ps-2">Anggota Gerak</td>
                                                        <td>
                                                            <select class="form-select form-select-sm status-fisik py-0" name="ekstremitas" id="ekstremitas" data-target="ket_ekstremitas" style="font-size: 11.5px; height: 28px;">
                                                                <option value="Normal" selected>Normal</option>
                                                                <option value="Abnormal">Abnormal</option>
                                                                <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control form-control-sm ket-fisik py-0" name="ket_ekstremitas" id="ket_ekstremitas" placeholder="Keterangan..." disabled style="font-size: 11.5px; height: 28px;">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-semibold ps-2">Status Neurologis</td>
                                                        <td>
                                                            <select class="form-select form-select-sm status-fisik py-0" name="neurologis" id="neurologis" data-target="ket_neurologis" style="font-size: 11.5px; height: 28px;">
                                                                <option value="Normal" selected>Normal</option>
                                                                <option value="Abnormal">Abnormal</option>
                                                                <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control form-control-sm ket-fisik py-0" name="ket_neurologis" id="ket_neurologis" placeholder="Keterangan..." disabled style="font-size: 11.5px; height: 28px;">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-semibold ps-2">Muskuloskeletal</td>
                                                        <td>
                                                            <select class="form-select form-select-sm status-fisik py-0" name="muskuloskeletal" id="muskuloskeletal" data-target="ket_muskuloskeletal" style="font-size: 11.5px; height: 28px;">
                                                                <option value="Normal" selected>Normal</option>
                                                                <option value="Abnormal">Abnormal</option>
                                                                <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control form-control-sm ket-fisik py-0" name="ket_muskuloskeletal" id="ket_muskuloskeletal" placeholder="Keterangan..." disabled style="font-size: 11.5px; height: 28px;">
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <label for="ket_fisik" class="form-label mb-1 small fw-bold text-muted">Keterangan Tambahan Pemeriksaan Fisik :</label>
                                        <textarea class="form-control form-control-sm" name="ket_fisik" id="ket_fisik" rows="2" placeholder="Catatan tambahan pemeriksaan fisik umum">-</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 3. STATUS LOKALIS & PEMERIKSAAN PENUNJANG -->
                        <div class="row g-3 mb-3">
                            <div class="col-lg-5">
                                <div class="card h-100 shadow-sm border-0">
                                    <div class="card-header bg-light fw-bold py-2 text-primary">
                                        <i class="bi bi-geo-alt-fill me-1"></i> 3. STATUS LOKALIS
                                    </div>
                                    <div class="card-body py-2 text-center">
                                        <img src="{{ asset('/img/set-lokalis.jpg') }}" class="img-fluid rounded mb-2" style="max-height: 180px;">
                                        <div class="text-start">
                                            <label for="ket_lokalis" class="form-label mb-1">Keterangan Lokalis</label>
                                            <textarea class="form-control" name="ket_lokalis" id="ket_lokalis" rows="3" onfocus="removeZero(this)" onblur="cekKosong(this)">-</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="card h-100 shadow-sm border-0">
                                    <div class="card-header bg-light fw-bold py-2 text-primary">
                                        <i class="bi bi-clipboard2-pulse-fill me-1"></i> 4. PEMERIKSAAN PENUNJANG
                                    </div>
                                    <div class="card-body py-2">
                                        <div class="row g-2">
                                            <div class="col-md-4">
                                                <label for="ekg" class="form-label mb-1">EKG</label>
                                                <textarea class="form-control" name="ekg" id="ekg" rows="4" onfocus="removeZero(this)" onblur="cekKosong(this)">-</textarea>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="lab" class="form-label mb-1">Laboratorium</label>
                                                <textarea class="form-control" name="lab" id="lab" rows="4" onfocus="removeZero(this)" onblur="cekKosong(this)">-</textarea>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="rad" class="form-label mb-1">Radiologi</label>
                                                <textarea class="form-control" name="rad" id="rad" rows="4" onfocus="removeZero(this)" onblur="cekKosong(this)">-</textarea>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <label for="diagnosis" class="form-label fw-bold mb-1 text-danger"><i class="bi bi-bookmark-check-fill"></i> 5. DIAGNOSIS / ASESMEN MEDIS</label>
                                                <textarea class="form-control" name="diagnosis" id="diagnosis" rows="3" onfocus="removeZero(this)" onblur="cekKosong(this)" style="font-weight: 500;">-</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 6. TERAPI -->
                        <div class="card mb-3 shadow-sm border-0">
                            <div class="card-header bg-light fw-bold py-2 text-primary">
                                <i class="bi bi-capsule me-1"></i> 6. TERAPI (Tata Laksana)
                            </div>
                            <div class="card-body py-2">
                                <div class="p-2 mb-2 bg-light rounded border">
                                    <label class="form-label fw-bold d-block mb-1">Kategori Pelaksanaan Terapi :</label>
                                    <div class="d-flex flex-wrap gap-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="terapi_kategori[]" value="Preventif" id="terapi_preventif">
                                            <label class="form-check-label fw-semibold" for="terapi_preventif">Preventif</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="terapi_kategori[]" value="Kuratif" id="terapi_kuratif">
                                            <label class="form-check-label fw-semibold" for="terapi_kuratif">Kuratif</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="terapi_kategori[]" value="Rehabilitatif" id="terapi_rehabilitatif">
                                            <label class="form-check-label fw-semibold" for="terapi_rehabilitatif">Rehabilitatif</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="terapi_kategori[]" value="Paliatif" id="terapi_paliatif">
                                            <label class="form-check-label fw-semibold" for="terapi_paliatif">Paliatif</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="terapi_farmakologis" class="form-label fw-bold mb-1"><i class="bi bi-prescription2 text-primary"></i> Terapi Farmakologis :</label>
                                        <textarea class="form-control" name="terapi_farmakologis" id="terapi_farmakologis" style="min-height: 180px; height: 200px; resize: vertical;" placeholder="Tuliskan nama obat, dosis, frekuensi, dan rute pemberian...&#10;Contoh:&#10;- Paracetamol tab 500mg 3x1&#10;- Amoxicillin 500mg 3x1&#10;- Ringer Lactate 20 tpm">-</textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="terapi_non_farmakologis" class="form-label fw-bold mb-1"><i class="bi bi-bandaid text-success"></i> Terapi Non Farmakologis :</label>
                                        <textarea class="form-control" name="terapi_non_farmakologis" id="terapi_non_farmakologis" style="min-height: 180px; height: 200px; resize: vertical;" placeholder="Tuliskan tindakan non farmakologis, instruksi perawatan, edukasi, diet, kompres, posisi, dll...&#10;Contoh:&#10;- Tirah baring / bed rest&#10;- Kompres hangat&#10;- Diet lunak rendah garam">-</textarea>
                                    </div>
                                </div>
                                <input type="hidden" name="tata" id="tata">
                            </div>
                        </div>

                        <!-- 7. RENCANA TINDAK LANJUT -->
                        <div class="card mb-3 shadow-sm border-0">
                            <div class="card-header bg-light fw-bold py-2 text-primary">
                                <i class="bi bi-arrow-right-circle-fill me-1"></i> 7. RENCANA TINDAK LANJUT
                            </div>
                            <div class="card-body py-2">
                                <div class="row g-2 mb-2">
                                    <div class="col-12">
                                        <label class="form-label fw-bold mb-1">Pilihan Tindak Lanjut :</label>
                                        <div class="d-flex flex-wrap gap-4 p-2 bg-light rounded border">
                                            <div class="form-check">
                                                <input class="form-check-input radio-tindak-lanjut" type="radio" name="tindak_lanjut" id="tl_rajal" value="Rawat Jalan">
                                                <label class="form-check-label fw-bold text-success" for="tl_rajal"><i class="bi bi-house-door-fill"></i> Rawat Jalan</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input radio-tindak-lanjut" type="radio" name="tindak_lanjut" id="tl_ranap" value="Rawat Inap">
                                                <label class="form-check-label fw-bold text-primary" for="tl_ranap"><i class="bi bi-hospital"></i> Rawat Inap</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input radio-tindak-lanjut" type="radio" name="tindak_lanjut" id="tl_rujuk" value="Dirujuk">
                                                <label class="form-check-label fw-bold text-warning" for="tl_rujuk"><i class="bi bi-box-arrow-up-right"></i> Dirujuk</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- PANEL RAWAT JALAN -->
                                <div id="panel_rajal" class="panel-tindak-lanjut border rounded p-3 mb-2 bg-white d-none">
                                    <div class="row align-items-center">
                                        <div class="col-md-6">
                                            <label for="kontrol_ke" class="form-label fw-semibold">Kontrol ke :</label>
                                            <input type="text" class="form-control form-control-sm" name="kontrol_ke" id="kontrol_ke" placeholder="Poli / Faskes / Dokter Tujuan Kontrol">
                                        </div>
                                    </div>
                                </div>

                                <!-- PANEL RAWAT INAP -->
                                <div id="panel_ranap" class="panel-tindak-lanjut border rounded p-3 mb-2 bg-white d-none">
                                    <div class="row g-2">
                                        <div class="col-md-5">
                                            <label for="ranap_indikasi" class="form-label fw-semibold">Indikasi Rawat Inap :</label>
                                            <input type="text" class="form-control form-control-sm" name="ranap_indikasi" id="ranap_indikasi" placeholder="Indikasi medis masuk rawat inap">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="ranap_smf" class="form-label fw-semibold">SMF :</label>
                                            <select class="form-select form-select-sm" name="ranap_smf" id="ranap_smf">
                                                <option value="">-- Pilih SMF --</option>
                                                <option value="Obsgyn">Obsgyn (Kebidanan & Kandungan)</option>
                                                <option value="Anak">Anak</option>
                                                <option value="Bedah">Bedah</option>
                                                <option value="Penyakit Dalam">Penyakit Dalam</option>
                                                <option value="Umum">Umum / Lainnya</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="ranap_dpjp" class="form-label fw-semibold">DPJP Ranap :</label>
                                            @php
                                                $listDokterRanap = \App\Models\Dokter::where('status', '1')
                                                    ->where('kd_dokter', '!=', '-')
                                                    ->with('spesialis')
                                                    ->orderBy('nm_dokter', 'asc')
                                                    ->get();
                                            @endphp
                                            <select class="form-select form-select-sm" name="ranap_dpjp" id="ranap_dpjp">
                                                <option value="">-- Pilih DPJP Ranap --</option>
                                                @foreach ($listDokterRanap as $doc)
                                                    <option value="{{ $doc->kd_dokter }}">
                                                        {{ $doc->nm_dokter }} {{ (!empty($doc->spesialis->nm_sps) && $doc->spesialis->nm_sps != '-') ? '('.$doc->spesialis->nm_sps.')' : '' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12 mt-2">
                                            <label class="form-label fw-semibold d-block mb-1">Jenis Ruang Ranap :</label>
                                            <div class="d-flex flex-wrap gap-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="ranap_ruang" id="ruang_bangsal" value="Bangsal">
                                                    <label class="form-check-label" for="ruang_bangsal">Bangsal</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="ranap_ruang" id="ruang_isolasi" value="Isolasi">
                                                    <label class="form-check-label" for="ruang_isolasi">Isolasi</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="ranap_ruang" id="ruang_intensif" value="Intensif (ICU/NICU/PICU)">
                                                    <label class="form-check-label" for="ruang_intensif">Intensif (ICU/NICU/PICU)</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="ranap_ruang" id="ruang_vk" value="VK">
                                                    <label class="form-check-label" for="ruang_vk">VK (Kamar Bersalin)</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="ranap_ruang" id="ruang_perina" value="Perinatologi">
                                                    <label class="form-check-label" for="ruang_perina">Perinatologi</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- PANEL DIRUJUK -->
                                <div id="panel_rujuk" class="panel-tindak-lanjut border rounded p-3 mb-2 bg-white d-none">
                                    <div class="row g-2">
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold d-block mb-1">Tujuan Rujukan :</label>
                                            <div class="input-group input-group-sm">
                                                <select class="form-select" name="rujuk_tujuan" id="rujuk_tujuan" style="max-width: 140px;">
                                                    <option value="RS">Rumah Sakit</option>
                                                    <option value="Puskesmas">Puskesmas</option>
                                                </select>
                                                <input type="text" class="form-control" name="rujuk_nama_faskes" id="rujuk_nama_faskes" placeholder="Nama Rumah Sakit / Puskesmas Tujuan">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold d-block mb-1">Diantar oleh :</label>
                                            <div class="d-flex gap-3 pt-1">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="rujuk_transport" id="trans_ambulan" value="Ambulans">
                                                    <label class="form-check-label" for="trans_ambulan">Ambulans</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="rujuk_transport" id="trans_pribadi" value="Kendaraan Pribadi">
                                                    <label class="form-check-label" for="trans_pribadi">Kendaraan Pribadi</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-2">
                                            <label class="form-label fw-semibold d-block mb-1">Atas Dasar (Alasan Rujukan) :</label>
                                            <div class="d-flex flex-wrap gap-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="rujuk_alasan[]" id="alasan_kamar" value="Kamar Penuh">
                                                    <label class="form-check-label" for="alasan_kamar">Kamar Penuh</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="rujuk_alasan[]" id="alasan_fasilitas" value="Perlu Fasilitas dan SDM">
                                                    <label class="form-check-label" for="alasan_fasilitas">Perlu Fasilitas dan SDM</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="rujuk_alasan[]" id="alasan_pasien" value="Permintaan Pasien / Keluarga">
                                                    <label class="form-check-label" for="alasan_pasien">Permintaan Pasien / Keluarga</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 8. KONDISI PASIEN PULANG & TANDA TANGAN -->
                        <div class="card mb-3 shadow-sm border-0">
                            <div class="card-header bg-light fw-bold py-2 text-primary">
                                <i class="bi bi-box-arrow-right me-1"></i> 8. KONDISI PASIEN PULANG & SELESAI PELAYANAN
                            </div>
                            <div class="card-body py-2">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold d-block mb-1">Kondisi Pasien Pulang :</label>
                                        <div class="d-flex flex-column gap-2 p-2 bg-light rounded border">
                                            <div class="form-check">
                                                <input class="form-check-input radio-kondisi-pulang" type="radio" name="kondisi_pulang" id="kondisi_perbaikan" value="Perbaikan">
                                                <label class="form-check-label" for="kondisi_perbaikan">Perbaikan</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input radio-kondisi-pulang" type="radio" name="kondisi_pulang" id="kondisi_menolak" value="Menolak Rawat Inap">
                                                <label class="form-check-label" for="kondisi_menolak">Menolak Rawat Inap (Formulir Penolakan Rawat Inap)</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input radio-kondisi-pulang" type="radio" name="kondisi_pulang" id="kondisi_meninggal" value="Meninggal Dunia">
                                                <label class="form-check-label text-danger fw-semibold" for="kondisi_meninggal">Meninggal Dunia</label>
                                            </div>
                                        </div>

                                        <div id="panel_meninggal" class="mt-2 p-2 border border-danger rounded bg-white d-none">
                                            <label class="form-label text-danger small fw-bold mb-1">Waktu Pasien Meninggal Dunia :</label>
                                            <div class="row g-2">
                                                <div class="col-7">
                                                    <input type="date" class="form-control form-control-sm" name="tgl_meninggal" id="tgl_meninggal">
                                                </div>
                                                <div class="col-5">
                                                    <input type="time" class="form-control form-control-sm" name="jam_meninggal" id="jam_meninggal">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-bold d-block mb-1">Waktu Selesai Pelayanan & TTD Pasien/Keluarga :</label>
                                        <div class="p-2 bg-light rounded border">
                                            <div class="row g-2 mb-2">
                                                <div class="col-6">
                                                    <label class="form-label small mb-0">Tanggal Selesai Pelayanan UGD :</label>
                                                    <input type="date" class="form-control form-control-sm" name="selesai_layanan_tgl" id="selesai_layanan_tgl" value="{{ date('Y-m-d') }}">
                                                </div>
                                                <div class="col-6">
                                                    <label class="form-label small mb-0">Jam Selesai Pelayanan UGD :</label>
                                                    <input type="time" class="form-control form-control-sm" name="selesai_layanan_jam" id="selesai_layanan_jam" value="{{ date('H:i') }}">
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label small mb-0">Nama Terang Pasien / Keluarga :</label>
                                                    <input type="text" class="form-control form-control-sm" name="nama_keluarga_ttd" id="nama_keluarga_ttd" placeholder="Nama Pasien atau Keluarga yang tanda tangan">
                                                </div>
                                            </div>

                                            <div class="text-center p-2 border rounded bg-white">
                                                <div id="wrapperPreviewTtd" class="d-none mb-2">
                                                    <img id="imgPreviewTtd" src="" alt="TTD Pasien" class="img-fluid border" style="max-height: 80px;">
                                                </div>
                                                <input type="hidden" name="ttd_pasien" id="ttd_pasien">
                                                <button type="button" class="btn btn-outline-primary btn-sm w-100" id="btnBukaModalTtd">
                                                    <i class="bi bi-pen-fill me-1"></i> Tanda Tangan Pasien / Keluarga
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <div>
                    <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> Keluar</button>
                </div>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-warning btn-sm btn-asmed-ugd-print" onclick="cetakAsmedUgd()"><i class="bi bi-printer"></i> Cetak Asesmen</button>
                    <button type="button" class="btn btn-primary btn-sm btn-asmed-ugd"><i class="bi bi-save"></i> Simpan Asesmen</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL POPUP TANDA TANGAN DIGITAL (CANVAS TOUCH/MOUSE) -->
<div class="modal fade" id="modalTtdPasienAsmed" tabindex="-1" aria-labelledby="modalTtdLabel" aria-hidden="true" style="z-index: 1065;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow">
            <div class="modal-header bg-primary text-white py-2">
                <h6 class="modal-title fs-6" id="modalTtdLabel"><i class="bi bi-pen me-2"></i> Tanda Tangan Pasien / Keluarga</h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center p-3">
                <p class="text-muted small mb-2">Goreskan tanda tangan pada kotak di bawah ini menggunakan jari, stylus, atau mouse:</p>
                <div class="border border-2 border-primary rounded p-1 bg-white" style="touch-action: none; display: inline-block;">
                    <canvas id="canvasTtdPasien" width="360" height="180" style="touch-action: none; cursor: crosshair; background-color: #fff;"></canvas>
                </div>
            </div>
            <div class="modal-footer justify-content-between py-2">
                <button type="button" class="btn btn-secondary btn-sm" id="btnClearCanvasTtd"><i class="bi bi-eraser me-1"></i> Hapus / Ulangi</button>
                <div>
                    <button type="button" class="btn btn-outline-secondary btn-sm me-1" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success btn-sm" id="btnSaveCanvasTtd"><i class="bi bi-check-lg me-1"></i> Simpan Tanda Tangan</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    <style>
        #modalAsmedUgd textarea {
            height: auto !important;
            min-height: 80px;
            resize: vertical !important;
            font-size: 12px;
        }
        #modalAsmedUgd #terapi_farmakologis,
        #modalAsmedUgd #terapi_non_farmakologis {
            min-height: 180px !important;
            height: 200px !important;
            font-size: 12px;
            line-height: 1.5;
        }
        #modalAsmedUgd #diagnosis {
            min-height: 90px !important;
        }
    </style>
@endpush

@push('js')
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
@endpush

@push('script')
    <script>
        // Inisialisasi Canvas TTD Pasien
        let canvasTtd = document.getElementById('canvasTtdPasien');
        let ctxTtd = canvasTtd ? canvasTtd.getContext('2d') : null;
        let isDrawingTtd = false;

        function initCanvasTtd() {
            if (!canvasTtd || !ctxTtd) return;
            ctxTtd.lineWidth = 2.5;
            ctxTtd.lineCap = 'round';
            ctxTtd.strokeStyle = '#000000';

            function getPos(e) {
                let rect = canvasTtd.getBoundingClientRect();
                let clientX = e.clientX || (e.touches && e.touches[0] ? e.touches[0].clientX : 0);
                let clientY = e.clientY || (e.touches && e.touches[0] ? e.touches[0].clientY : 0);
                return {
                    x: clientX - rect.left,
                    y: clientY - rect.top
                };
            }

            function startDraw(e) {
                isDrawingTtd = true;
                let pos = getPos(e);
                ctxTtd.beginPath();
                ctxTtd.moveTo(pos.x, pos.y);
                if (e.cancelable) e.preventDefault();
            }

            function draw(e) {
                if (!isDrawingTtd) return;
                let pos = getPos(e);
                ctxTtd.lineTo(pos.x, pos.y);
                ctxTtd.stroke();
                if (e.cancelable) e.preventDefault();
            }

            function stopDraw() {
                isDrawingTtd = false;
            }

            // Mouse Events
            canvasTtd.onmousedown = startDraw;
            canvasTtd.onmousemove = draw;
            canvasTtd.onmouseup = stopDraw;
            canvasTtd.onmouseleave = stopDraw;

            // Touch Events (HP / Tablet)
            canvasTtd.addEventListener('touchstart', startDraw, { passive: false });
            canvasTtd.addEventListener('touchmove', draw, { passive: false });
            canvasTtd.addEventListener('touchend', stopDraw, { passive: false });
        }

        $('#btnBukaModalTtd').on('click', () => {
            $('#modalTtdPasienAsmed').modal('show');
            setTimeout(() => {
                initCanvasTtd();
            }, 300);
        });

        $('#btnClearCanvasTtd').on('click', () => {
            if (ctxTtd && canvasTtd) {
                ctxTtd.clearRect(0, 0, canvasTtd.width, canvasTtd.height);
            }
        });

        $('#btnSaveCanvasTtd').on('click', () => {
            if (!canvasTtd) return;
            let dataUrl = canvasTtd.toDataURL('image/png');
            $('#ttd_pasien').val(dataUrl);
            $('#imgPreviewTtd').attr('src', dataUrl);
            $('#wrapperPreviewTtd').removeClass('d-none');
            $('#modalTtdPasienAsmed').modal('hide');
        });

        // Toggle panel tindak lanjut
        $('.radio-tindak-lanjut').on('change', function() {
            let val = $(this).val();
            $('.panel-tindak-lanjut').addClass('d-none');
            if (val === 'Rawat Jalan') {
                $('#panel_rajal').removeClass('d-none');
            } else if (val === 'Rawat Inap') {
                $('#panel_ranap').removeClass('d-none');
            } else if (val === 'Dirujuk') {
                $('#panel_rujuk').removeClass('d-none');
            }
        });

        // Toggle panel meninggal
        $('.radio-kondisi-pulang').on('change', function() {
            if ($(this).val() === 'Meninggal Dunia') {
                $('#panel_meninggal').removeClass('d-none');
            } else {
                $('#panel_meninggal').addClass('d-none');
            }
        });

        $('.dokter').on('keyup', (e) => {
            dokter = $('.dokter').val();
            if (dokter.length >= 3) {
                getDokter(dokter).done((response) => {
                    html = '<ul class="dropdown-menu" style="width:auto;display:block;position:absolute;border-radius:3px;font-size:12px">';
                    $.map(response, function(data) {
                        html += '<li>';
                        html += '<a data-id="' + data.kd_dokter + '" data-nama="' + data.nm_dokter + '" class="dropdown-item" onclick="setDokterAsmed(this, \'#kd_dokter\', \'#dokter\')">' + data.nm_dokter + '</a>';
                        html += '</li>';
                    });
                    html += '</ul>';
                    $('.list-dokter').fadeIn();
                    $('.list-dokter').html(html);
                });
            }
        });

        function setDokterAsmed(param, id, dokter) {
            kd_dokter = $(param).data('id');
            nm_dokter = $(param).data('nama');
            $(id).val(kd_dokter);
            $(dokter).val(nm_dokter);
            $('.list-dokter').fadeOut();
        }

        function simpanTriase(data) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            $.ajax({
                url: '/erm/triase/simpan',
                type: 'POST',
                data: JSON.stringify(data),
                contentType: 'application/json',
                success: function(response) {
                    return true;
                },
                error: function(response) {
                    console.log(response);
                    return false;
                }
            });
        }

        // SIMPAN ASMED UGD
        $('.btn-asmed-ugd').on('click', () => {
            var data = {};
            var dataTriase = {};
            var no_rawat = $('#modalAsmedUgd #no_rawat').val();

            $('#formAsmedUgd input').each((index, element) => {
                let keys = $(element).prop('name');
                if ($(element).attr('type') == 'checkbox' || $(element).attr('type') == 'radio') {
                    return true;
                }
                if (keys) {
                    data[keys] = $(element).val();
                }
            });

            $('#formAsmedUgd select').each((index, element) => {
                let keys = $(element).prop('name');
                if (keys) {
                    data[keys] = $(element).val();
                }
            });

            $('#formAsmedUgd textarea').each((index, element) => {
                let keys = $(element).prop('name');
                if (keys) {
                    data[keys] = $(element).val();
                }
            });

            // Radio tindak lanjut
            data.tindak_lanjut = $('input[name="tindak_lanjut"]:checked').val() || '';
            data.ranap_ruang = $('input[name="ranap_ruang"]:checked').val() || '';
            data.rujuk_transport = $('input[name="rujuk_transport"]:checked').val() || '';
            data.kondisi_pulang = $('input[name="kondisi_pulang"]:checked').val() || '';

            // Checkbox Terapi Kategori
            let terapiKat = [];
            $('input[name="terapi_kategori[]"]:checked').each(function() {
                terapiKat.push($(this).val());
            });
            data.terapi_kategori = terapiKat;

            // Checkbox Alasan Rujuk
            let alasanRujuk = [];
            $('input[name="rujuk_alasan[]"]:checked').each(function() {
                alasanRujuk.push($(this).val());
            });
            data.rujuk_alasan = alasanRujuk;

            // Checkbox Triase ATS
            $('#formAsmedUgd input[type=checkbox]').each((index, element) => {
                let nameAttr = $(element).prop('name') || '';
                if (!nameAttr.startsWith('skala')) return true;

                keys = nameAttr.replaceAll('[', '_').replaceAll(']', '');
                var isChecked = $(element).is(":checked");
                var expKeys = keys.split('_');

                if (dataTriase[expKeys[0]] == undefined) {
                    dataTriase[expKeys[0]] = [];
                }

                var kode_skala_keys = 'kode_' + expKeys[0];
                if (isChecked) {
                    dataTriase[expKeys[0]].push({
                        'no_rawat': no_rawat,
                        [kode_skala_keys]: $(element).val()
                    });
                } else {
                    dataTriase[expKeys[0]].push({
                        'no_rawat': no_rawat,
                        [kode_skala_keys]: null
                    });
                }
            });

            data._token = "{{ csrf_token() }}";

            $.ajax({
                url: '/erm/ugd/asesmen/medis/simpan',
                data: data,
                method: 'POST',
                dataType: 'JSON',
            }).done((response) => {
                simpanTriase(dataTriase);
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses !',
                    text: 'Asesmen Medis UGD berhasil disimpan',
                    showConfirmButton: false,
                    timer: 1500
                });
                $('#modalAsmedUgd').modal('hide');
                if (typeof tbUgd === 'function') {
                    tbUgd();
                } else if (typeof tb_ranap !== 'undefined' && typeof tb_ranap.ajax !== 'undefined') {
                    tb_ranap.ajax.reload(null, false);
                } else if ($.fn.DataTable && $.fn.DataTable.isDataTable('#tb_ranap')) {
                    $('#tb_ranap').DataTable().ajax.reload(null, false);
                }
            }).fail((err) => {
                let errorMsg = err.responseJSON?.message || err.responseText || 'Terjadi kesalahan sistem';
                Swal.fire({
                    icon: 'error',
                    title: 'Akses Ditolak / Gagal',
                    text: errorMsg
                });
            });
        });

        function cetakAsmedUgd() {
            let no_rawat = $('#modalAsmedUgd #no_rawat').val();
            if (!no_rawat) {
                Swal.fire('Perhatian', 'Pilih data pasien terlebih dahulu', 'warning');
                return;
            }
            let url = `/erm/asesmen/medis/ugd/print?no_rawat=${no_rawat.replaceAll('/', '-')}`;
            window.open(url, '_blank');
        }

        $("#modalAsmedUgd").on('show.bs.modal', function(e) {
            setTimeout(() => {
                var no_rawat = $("#modalAsmedUgd #no_rawat").val();

                if ($.fn.DataTable.isDataTable('.tblTriase')) {
                    $('.tblTriase').DataTable().destroy();
                }

                // Reset header checkboxes
                for (let index = 1; index <= 5; index++) {
                    $("#ats_" + index).prop('checked', false);
                }

                $('.tblTriase').DataTable({
                    responsive: true,
                    paging: false,
                    searching: false,
                    info: false,
                    ordering: false,
                    ajax: {
                        url: '/erm/triase/get/indikator',
                        data: {
                            no_rawat: no_rawat
                        }
                    },
                    drawCallback: function() {
                        for (let index = 1; index <= 5; index++) {
                            let hasChecked = $('.item-skala' + index + ':checked').length > 0;
                            $("#ats_" + index).prop('checked', hasChecked);
                            $('.item-skala' + index).prop('disabled', !hasChecked);
                        }
                    },
                    columns: [{
                            data: 'nama_pemeriksaan'
                        },
                        {
                            data: 'skala1',
                            render: function(data) {
                                var skala1 = JSON.parse(data);
                                var html = '<div class="d-flex flex-column">';
                                skala1.forEach(function(item) {
                                    var isChecked = (item.triase && item.kode_skala1 && item.triase.kode_skala1 == item.kode_skala1);
                                    var c = isChecked ? 'checked' : '';
                                    html += '<div class="form-check form-check-inline">';
                                    html += '<input class="form-check-input item-skala1" disabled type="checkbox" name="skala1[' + item.kode_skala1 + ']" id="skala1_' + item.kode_skala1 + '" value="' + item.kode_skala1 + '" ' + c + '>';
                                    html += '<label class="form-check-label text-nowrap" for="skala1_' + item.kode_skala1 + '">' + item.pengkajian_skala1 + '</label>';
                                    html += '</div>';
                                });
                                html += '</div>';
                                return html;
                            }
                        },
                        {
                            data: 'skala2',
                            render: function(data) {
                                var skala2 = JSON.parse(data);
                                var html = '<div class="d-flex flex-column">';
                                skala2.forEach(function(item) {
                                    var isChecked = (item.triase && item.kode_skala2 && item.triase.kode_skala2 == item.kode_skala2);
                                    var c = isChecked ? 'checked' : '';
                                    html += '<div class="form-check form-check-inline">';
                                    html += '<input class="form-check-input item-skala2" disabled type="checkbox" name="skala2[' + item.kode_skala2 + ']" id="skala2_' + item.kode_skala2 + '" value="' + item.kode_skala2 + '" ' + c + '>';
                                    html += '<label class="form-check-label text-nowrap" for="skala2_' + item.kode_skala2 + '">' + item.pengkajian_skala2 + '</label>';
                                    html += '</div>';
                                });
                                html += '</div>';
                                return html;
                            }
                        },
                        {
                            data: 'skala3',
                            render: function(data) {
                                var skala3 = JSON.parse(data);
                                var html = '<div class="d-flex flex-column">';
                                skala3.forEach(function(item) {
                                    var isChecked = (item.triase && item.kode_skala3 && item.triase.kode_skala3 == item.kode_skala3);
                                    var c = isChecked ? 'checked' : '';
                                    html += '<div class="form-check form-check-inline">';
                                    html += '<input class="form-check-input item-skala3" disabled type="checkbox" name="skala3[' + item.kode_skala3 + ']" id="skala3_' + item.kode_skala3 + '" value="' + item.kode_skala3 + '" ' + c + '>';
                                    html += '<label class="form-check-label text-nowrap" for="skala3_' + item.kode_skala3 + '">' + item.pengkajian_skala3 + '</label>';
                                    html += '</div>';
                                });
                                html += '</div>';
                                return html;
                            }
                        },
                        {
                            data: 'skala4',
                            render: function(data) {
                                var skala4 = JSON.parse(data);
                                var html = '<div class="d-flex flex-column">';
                                skala4.forEach(function(item) {
                                    var isChecked = (item.triase && item.kode_skala4 && item.triase.kode_skala4 == item.kode_skala4);
                                    var c = isChecked ? 'checked' : '';
                                    html += '<div class="form-check form-check-inline">';
                                    html += '<input class="form-check-input item-skala4" disabled type="checkbox" name="skala4[' + item.kode_skala4 + ']" id="skala4_' + item.kode_skala4 + '" value="' + item.kode_skala4 + '" ' + c + '>';
                                    html += '<label class="form-check-label text-nowrap" for="skala4_' + item.kode_skala4 + '">' + item.pengkajian_skala4 + '</label>';
                                    html += '</div>';
                                });
                                html += '</div>';
                                return html;
                            }
                        },
                        {
                            data: 'skala5',
                            render: function(data) {
                                var skala5 = JSON.parse(data);
                                var html = '<div class="d-flex flex-column">';
                                skala5.forEach(function(item) {
                                    var isChecked = (item.triase && item.kode_skala5 && item.triase.kode_skala5 == item.kode_skala5);
                                    var c = isChecked ? 'checked' : '';
                                    html += '<div class="form-check form-check-inline">';
                                    html += '<input class="form-check-input item-skala5" disabled type="checkbox" name="skala5[' + item.kode_skala5 + ']" id="skala5_' + item.kode_skala5 + '" value="' + item.kode_skala5 + '" ' + c + '>';
                                    html += '<label class="form-check-label text-nowrap" for="skala5_' + item.kode_skala5 + '">' + item.pengkajian_skala5 + '</label>';
                                    html += '</div>';
                                });
                                html += '</div>';
                                return html;
                            }
                        },
                    ]
                });
            }, 300);
        });

        // Header ATS Checkbox change handler (toggle column)
        $('input[id^="ats_"]').off('change').on('change', function() {
            let skalaNum = $(this).attr('id').replace('ats_', '');
            let isChecked = $(this).is(':checked');
            if (isChecked) {
                $('.item-skala' + skalaNum).prop('disabled', false);
            } else {
                $('.item-skala' + skalaNum).prop('disabled', true).prop('checked', false);
            }
        });

        // Item change handler
        $(document).off('change', '.tblTriase input[type=checkbox]').on('change', '.tblTriase input[type=checkbox]', function() {
            for (let index = 1; index <= 5; index++) {
                let hasChecked = $('.item-skala' + index + ':checked').length > 0;
                if (hasChecked) {
                    $("#ats_" + index).prop('checked', true);
                    $('.item-skala' + index).prop('disabled', false);
                }
            }
        });

        $(document).on('change', '.status-fisik', function() {
            let target = $(this).data('target');
            let val = $(this).val();
            let $input = $(`#${target}`);
            if (val === 'Abnormal') {
                $input.prop('disabled', false);
                $input.addClass('border-warning bg-light');
            } else {
                $input.prop('disabled', true).val('');
                $input.removeClass('border-warning bg-light');
            }
        });

        $('#btnSetSemuaNormalFisik').on('click', function() {
            $('.status-fisik').val('Normal');
            $('.ket-fisik').val('').prop('disabled', true).removeClass('border-warning bg-light');
        });

        function resetFormAsmedUgd() {
            $('#formAsmedUgd')[0].reset();
            for (let index = 1; index <= 5; index++) {
                $("#ats_" + index).prop('checked', false);
            }
            $('.status-fisik').val('Normal');
            $('.ket-fisik').val('').prop('disabled', true).removeClass('border-warning bg-light');
            $('input[name="terapi_kategori[]"]').prop('checked', false);
            $('input[name="rujuk_alasan[]"]').prop('checked', false);
            $('.panel-tindak-lanjut').addClass('d-none');
            $('#panel_meninggal').addClass('d-none');
            $('#ttd_pasien').val('');
            $('#imgPreviewTtd').attr('src', '');
            $('#wrapperPreviewTtd').addClass('d-none');
            $('#formAsmedUgd select[name="ranap_dpjp"]').val('').find('.option-temp-dpjp').remove();
            $('#formAsmedUgd select[name="ranap_smf"]').val('');
            if (ctxTtd && canvasTtd) {
                ctxTtd.clearRect(0, 0, canvasTtd.width, canvasTtd.height);
            }
        }

        function modalAsmedUgd(params) {
            resetFormAsmedUgd();

            getAsmedUgd(params).done((response) => {
                if (Object.keys(response).length == 0) {
                    // Entri Baru: Tombol Cetak disembunyikan
                    $('.btn-asmed-ugd-print').addClass('d-none');
                    $('.btn-asmed-ugd').html('<i class="bi bi-save"></i> Simpan Asesmen');

                    getRegPeriksa(params).done((regPeriksa) => {
                        const p = regPeriksa?.pasien || {};
                        $('#formAsmedUgd input[name="no_rawat"]').val(regPeriksa?.no_rawat || params);
                        $('#formAsmedUgd input[name="pasien"]').val(`${p.nm_pasien || '-'} (${p.jk || '-'})`);
                        $('#formAsmedUgd input[name="tgl_lahir"]').val(`${p.tgl_lahir ? formatTanggal(p.tgl_lahir) : '-'} (${p.tgl_lahir ? hitungUmur(p.tgl_lahir) : '-'})`);
                        const doc = regPeriksa?.dokter || {};
                        const userNik = "{{ session()->get('pegawai')->nik }}";
                        const userNama = "{{ session()->get('pegawai')->nama }}";
                        const isUserDokter = "{{ session()->get('pegawai')->bidang }}" === 'Spesialis' || "{{ session()->get('pegawai')->jbtn }}".includes('Dokter') || "{{ session()->get('pegawai')->jnj_jabatan }}".includes('Dokter');
                        
                        const kdDokterVal = (isUserDokter && userNik) ? userNik : (doc.kd_dokter || userNik);
                        const nmDokterVal = (isUserDokter && userNama) ? userNama : (doc.nm_dokter || userNama);

                        $('#formAsmedUgd input[name="kd_dokter"]').val(kdDokterVal);
                        $('#formAsmedUgd input[name="dokter"]').val(nmDokterVal);
                        $('#formAsmedUgd input[name="tanggal"]').val("{{ date('Y-m-d H:i:s') }}");
                        $('#formAsmedUgd input[name="nama_keluarga_ttd"]').val(p.nm_pasien || '');

                        // Auto pre-fill dari Pemeriksaan Ralan (Pemeriksaan Awal Triage / Perawat)
                        if (regPeriksa?.pemeriksaan_ralan && regPeriksa.pemeriksaan_ralan.length > 0) {
                            const pem = regPeriksa.pemeriksaan_ralan[0];
                            if (pem.keluhan && pem.keluhan !== '-') $('#formAsmedUgd textarea[name="keluhan_utama"]').val(pem.keluhan);
                            if (pem.alergi && pem.alergi !== '-') $('#formAsmedUgd input[name="alergi"]').val(pem.alergi);
                            if (pem.tensi && pem.tensi !== '-') $('#formAsmedUgd input[name="td"]').val(pem.tensi);
                            if (pem.nadi && pem.nadi !== '-') $('#formAsmedUgd input[name="nadi"]').val(pem.nadi);
                            if (pem.respirasi && pem.respirasi !== '-') $('#formAsmedUgd input[name="rr"]').val(pem.respirasi);
                            if (pem.suhu_tubuh && pem.suhu_tubuh !== '-') $('#formAsmedUgd input[name="suhu"]').val(pem.suhu_tubuh);
                            if (pem.spo2 && pem.spo2 !== '-') $('#formAsmedUgd input[name="spo"]').val(pem.spo2);
                            if (pem.berat && pem.berat !== '-') $('#formAsmedUgd input[name="bb"]').val(pem.berat);
                            if (pem.tinggi && pem.tinggi !== '-') $('#formAsmedUgd input[name="tb"]').val(pem.tinggi);
                            if (pem.gcs && pem.gcs !== '-') $('#formAsmedUgd input[name="gcs"]').val(pem.gcs);
                            if (pem.kesadaran) $('#formAsmedUgd select[name="kesadaran"]').val(pem.kesadaran).change();
                        }

                        // Auto pre-fill dari Triase Pre-Registrasi jika ada
                        $.get('/erm/triase/prereg/by-no-rawat', { no_rawat: params }).done((resPre) => {
                            if (resPre.status === 'success' && resPre.data) {
                                const tri = resPre.data;
                                $('#badgeAsmedTriaseLinkedStatus').html(`<span class="badge bg-success ms-2 text-xs" title="ID Triase: ${tri.id_triase}"><i class="bi bi-check-circle-fill"></i> Data Ditarik dari Triase Pre-Reg (${tri.id_triase})</span>`);
                                $('#btnAsmedTarikTriasePreReg').addClass('d-none');
                                if (tri.keterangan_kedatangan && tri.keterangan_kedatangan !== '-') $('#formAsmedUgd textarea[name="keluhan_utama"]').val(tri.keterangan_kedatangan);
                                if (tri.tekanan_darah && tri.tekanan_darah !== '-') $('#formAsmedUgd input[name="td"]').val(tri.tekanan_darah);
                                if (tri.nadi && tri.nadi !== '-') $('#formAsmedUgd input[name="nadi"]').val(tri.nadi);
                                if (tri.pernapasan && tri.pernapasan !== '-') $('#formAsmedUgd input[name="rr"]').val(tri.pernapasan);
                                if (tri.suhu && tri.suhu !== '-') $('#formAsmedUgd input[name="suhu"]').val(tri.suhu);
                                if (tri.saturasi_o2 && tri.saturasi_o2 !== '-') $('#formAsmedUgd input[name="spo"]').val(tri.saturasi_o2);
                                if (tri.gcs && tri.gcs !== '-') $('#formAsmedUgd input[name="gcs"]').val(tri.gcs);
                                if (tri.skala_triase) {
                                    $(`#ats_${tri.skala_triase}`).prop('checked', true).change();
                                }
                            } else {
                                $('#badgeAsmedTriaseLinkedStatus').html('');
                                $('#btnAsmedTarikTriasePreReg').removeClass('d-none');
                            }
                        });
                    });
                } else {
                    // Data Pernah Disimpan: Tombol Cetak ditampilkan, sembunyikan tombol Tarik Triase
                    $('.btn-asmed-ugd-print').removeClass('d-none');
                    $('.btn-asmed-ugd').html('<i class="bi bi-pencil-square"></i> Ubah Asesmen');
                    $('#btnAsmedTarikTriasePreReg').addClass('d-none');

                    $.get('/erm/triase/prereg/by-no-rawat', { no_rawat: response.no_rawat }).done((resPre) => {
                        if (resPre.status === 'success' && resPre.data) {
                            $('#badgeAsmedTriaseLinkedStatus').html(`<span class="badge bg-success ms-2 text-xs" title="ID Triase: ${resPre.data.id_triase}"><i class="bi bi-check-circle-fill"></i> Data Ditarik dari Triase Pre-Reg (${resPre.data.id_triase})</span>`);
                        } else {
                            $('#badgeAsmedTriaseLinkedStatus').html('');
                        }
                    });

                    const p = response?.reg_periksa?.pasien || {};
                    $('#formAsmedUgd input[name="no_rawat"]').val(response.no_rawat);
                    $('#formAsmedUgd input[name="pasien"]').val(`${p.nm_pasien || '-'} (${p.jk || '-'})`);
                    $('#formAsmedUgd input[name="tgl_lahir"]').val(`${p.tgl_lahir ? formatTanggal(p.tgl_lahir) : '-'} (${p.tgl_lahir ? hitungUmur(p.tgl_lahir) : '-'})`);
                    $('#formAsmedUgd input[name="kd_dokter"]').val(response.kd_dokter);
                    $('#formAsmedUgd input[name="dokter"]').val(response.dokter ? response.dokter.nm_dokter : '');
                    $('#formAsmedUgd input[name="tanggal"]').val(response.tanggal);
                    $('#formAsmedUgd select[name="anamnesis"]').val(response.anamnesis).change();
                    $('#formAsmedUgd input[name="hubungan"]').val(response.hubungan);
                    $('#formAsmedUgd textarea[name="keluhan_utama"]').val(response.keluhan_utama);
                    $('#formAsmedUgd textarea[name="rps"]').val(response.rps);
                    $('#formAsmedUgd textarea[name="rpd"]').val(response.rpd);
                    $('#formAsmedUgd textarea[name="rpk"]').val(response.rpk);
                    $('#formAsmedUgd textarea[name="rpo"]').val(response.rpo);
                    $('#formAsmedUgd input[name="alergi"]').val(response.alergi);
                    $('#formAsmedUgd select[name="keadaan"]').val(response.keadaan).change();
                    $('#formAsmedUgd select[name="kesadaran"]').val(response.kesadaran).change();
                    $('#formAsmedUgd input[name="gcs"]').val(response.gcs);
                    $('#formAsmedUgd input[name="tb"]').val(response.tb);
                    $('#formAsmedUgd input[name="bb"]').val(response.bb);
                    $('#formAsmedUgd input[name="td"]').val(response.td);
                    $('#formAsmedUgd input[name="nadi"]').val(response.nadi);
                    $('#formAsmedUgd input[name="rr"]').val(response.rr);
                    $('#formAsmedUgd input[name="suhu"]').val(response.suhu);
                    $('#formAsmedUgd input[name="spo"]').val(response.spo);

                    // 13 Organ Pemeriksaan Fisik (Status & Keterangan)
                    let rsia = response.rsia_asmed || response.rsia_penilaian_medis_igd || {};
                    
                    const setOrganFisik = (orgName, statusVal, ketVal) => {
                        let status = statusVal || 'Normal';
                        $(`#formAsmedUgd select[name="${orgName}"]`).val(status);
                        let $ket = $(`#formAsmedUgd input[name="ket_${orgName}"]`);
                        if (status === 'Abnormal') {
                            $ket.prop('disabled', false).val(ketVal || '').addClass('border-warning bg-light');
                        } else {
                            $ket.prop('disabled', true).val('').removeClass('border-warning bg-light');
                        }
                    };

                    setOrganFisik('kepala', response.kepala, rsia.ket_kepala);
                    setOrganFisik('mata', response.mata, rsia.ket_mata);
                    setOrganFisik('tht', rsia.tht, rsia.ket_tht);
                    setOrganFisik('gigi', response.gigi, rsia.ket_gigi);
                    setOrganFisik('leher', response.leher, rsia.ket_leher);
                    setOrganFisik('jantung', rsia.jantung, rsia.ket_jantung);
                    setOrganFisik('paru', rsia.paru, rsia.ket_paru);
                    setOrganFisik('thoraks', response.thoraks, rsia.ket_thoraks);
                    setOrganFisik('abdomen', response.abdomen, rsia.ket_abdomen);
                    setOrganFisik('genital', response.genital, rsia.ket_genital);
                    setOrganFisik('ekstremitas', response.ekstremitas, rsia.ket_ekstremitas);
                    setOrganFisik('neurologis', rsia.neurologis, rsia.ket_neurologis);
                    setOrganFisik('muskuloskeletal', rsia.muskuloskeletal, rsia.ket_muskuloskeletal);

                    $('#formAsmedUgd textarea[name="ket_fisik"]').val(response.ket_fisik || '-');
                    $('#formAsmedUgd textarea[name="ket_lokalis"]').val(response.ket_lokalis || '-');
                    $('#formAsmedUgd textarea[name="ekg"]').val(response.ekg || '-');
                    $('#formAsmedUgd textarea[name="lab"]').val(response.lab || '-');
                    $('#formAsmedUgd textarea[name="rad"]').val(response.rad || '-');
                    $('#formAsmedUgd textarea[name="diagnosis"]').val(response.diagnosis || '');
                    $('#formAsmedUgd textarea[name="tata"]').val(response.tata || '-');

                    // Load RSIA Akreditasi Extension data
                    if (rsia && Object.keys(rsia).length > 0) {
                        // Terapi Kategori
                        if (rsia.terapi_kategori) {
                            let kats = rsia.terapi_kategori.split(',');
                            kats.forEach(k => {
                                $(`input[name="terapi_kategori[]"][value="${k.trim()}"]`).prop('checked', true);
                            });
                        }
                        $('#formAsmedUgd textarea[name="terapi_farmakologis"]').val(rsia.terapi_farmakologis || '-');
                        $('#formAsmedUgd textarea[name="terapi_non_farmakologis"]').val(rsia.terapi_non_farmakologis || '-');

                        // Tindak Lanjut
                        if (rsia.tindak_lanjut) {
                            $(`input[name="tindak_lanjut"][value="${rsia.tindak_lanjut}"]`).prop('checked', true).trigger('change');
                        }
                        $('#formAsmedUgd input[name="kontrol_ke"]').val(rsia.kontrol_ke || '');
                        $('#formAsmedUgd input[name="ranap_indikasi"]').val(rsia.ranap_indikasi || '');
                        $('#formAsmedUgd select[name="ranap_smf"]').val(rsia.ranap_smf || '');
                        
                        // Handler Backward Compatibility DPJP Ranap (Mendukung kd_dokter & Free Text Nama Dokter Lama)
                        const $dpjpSelect = $('#formAsmedUgd select[name="ranap_dpjp"]');
                        $dpjpSelect.find('.option-temp-dpjp').remove();
                        if (rsia.ranap_dpjp) {
                            if ($dpjpSelect.find(`option[value="${rsia.ranap_dpjp}"]`).length > 0) {
                                $dpjpSelect.val(rsia.ranap_dpjp);
                            } else {
                                let matched = false;
                                const cleanSearch = rsia.ranap_dpjp.toLowerCase().replace(/dr\.|drg\.|sp\.[a-z]+/g, '').trim();
                                $dpjpSelect.find('option').each(function() {
                                    const optText = $(this).text().toLowerCase();
                                    if ($(this).val() && (optText.includes(rsia.ranap_dpjp.toLowerCase()) || (cleanSearch.length > 2 && optText.includes(cleanSearch)))) {
                                        $dpjpSelect.val($(this).val());
                                        matched = true;
                                        return false;
                                    }
                                });
                                if (!matched) {
                                    $dpjpSelect.append(`<option class="option-temp-dpjp" value="${rsia.ranap_dpjp}" selected>${rsia.ranap_dpjp} (Teks Lama)</option>`);
                                }
                            }
                        } else {
                            $dpjpSelect.val('');
                        }

                        if (rsia.ranap_ruang) {
                            $(`input[name="ranap_ruang"][value="${rsia.ranap_ruang}"]`).prop('checked', true);
                        }

                        // Rujukan
                        $('#formAsmedUgd select[name="rujuk_tujuan"]').val(rsia.rujuk_tujuan || 'RS');
                        $('#formAsmedUgd input[name="rujuk_nama_faskes"]').val(rsia.rujuk_nama_faskes || '');
                        if (rsia.rujuk_transport) {
                            $(`input[name="rujuk_transport"][value="${rsia.rujuk_transport}"]`).prop('checked', true);
                        }
                        if (rsia.rujuk_alasan) {
                            let alasans = rsia.rujuk_alasan.split(',');
                            alasans.forEach(a => {
                                $(`input[name="rujuk_alasan[]"][value="${a.trim()}"]`).prop('checked', true);
                            });
                        }

                        // Kondisi Pulang
                        if (rsia.kondisi_pulang) {
                            $(`input[name="kondisi_pulang"][value="${rsia.kondisi_pulang}"]`).prop('checked', true).trigger('change');
                        }
                        let tglMeninggal = (rsia.tgl_meninggal && rsia.tgl_meninggal !== '-' && rsia.tgl_meninggal !== '0000-00-00') ? rsia.tgl_meninggal : '';
                        let jamMeninggal = (rsia.jam_meninggal && rsia.jam_meninggal !== '-') ? rsia.jam_meninggal : '';
                        $('#formAsmedUgd input[name="tgl_meninggal"]').val(tglMeninggal);
                        $('#formAsmedUgd input[name="jam_meninggal"]').val(jamMeninggal);

                        // Selesai Layanan & TTD
                        let tglSelesai = (rsia.selesai_layanan_tgl && rsia.selesai_layanan_tgl !== '-' && rsia.selesai_layanan_tgl !== '0000-00-00') ? rsia.selesai_layanan_tgl : "{{ date('Y-m-d') }}";
                        let jamSelesai = (rsia.selesai_layanan_jam && rsia.selesai_layanan_jam !== '-') ? rsia.selesai_layanan_jam : "{{ date('H:i') }}";
                        $('#formAsmedUgd input[name="selesai_layanan_tgl"]').val(tglSelesai);
                        $('#formAsmedUgd input[name="selesai_layanan_jam"]').val(jamSelesai);
                        $('#formAsmedUgd input[name="nama_keluarga_ttd"]').val(rsia.nama_keluarga_ttd || (response.reg_periksa ? response.reg_periksa.pasien.nm_pasien : ''));

                        if (rsia.ttd_pasien) {
                            let ttdUrl = rsia.ttd_pasien;
                            if (!ttdUrl.startsWith('data:image') && !ttdUrl.startsWith('http')) {
                                ttdUrl = '{{ asset("storage") }}/' + ttdUrl.replace(/^\/+/, '');
                            }
                            $('#ttd_pasien').val(rsia.ttd_pasien);
                            $('#imgPreviewTtd').attr('src', ttdUrl);
                            $('#wrapperPreviewTtd').removeClass('d-none');
                        }
                    } else {
                        // Default fallback if existing data without rsia_asmed
                        $('#formAsmedUgd textarea[name="terapi_farmakologis"]').val(response.tata || '-');
                        $('#formAsmedUgd input[name="nama_keluarga_ttd"]').val(response.reg_periksa ? response.reg_periksa.pasien.nm_pasien : '');
                    }
                }
            });

            $('#modalAsmedUgd').modal('show');
        }

        function triggerLinkTriaseFromAsmed() {
            const no_rawat = $('#formAsmedUgd input[name="no_rawat"]').val();
            if (!no_rawat) return;
            getRegPeriksa(no_rawat).done((regPeriksa) => {
                if (!regPeriksa) return;
                const p = regPeriksa.pasien || {};
                showModalLinkTriasePreReg(
                    no_rawat,
                    regPeriksa.no_rkm_medis || '',
                    p.nm_pasien || '',
                    p.jk || '',
                    `${hitungUmur(p.tgl_lahir)}`
                );
            });
        }
    </script>
@endpush
