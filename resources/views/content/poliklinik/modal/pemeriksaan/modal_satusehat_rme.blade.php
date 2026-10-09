<div class="modal fade" id="modalSatuSehatRme" data-bs-focus="false" aria-labelledby="modalSatuSehatRmeLabel" aria-hidden="true" style="z-index: 1065;">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 760px;">
        <div class="modal-content shadow-lg border-0 rounded-4 overflow-hidden">
            <!-- Modal Header -->
            <div id="ssrme_modal_header" class="modal-header text-white d-flex align-items-center justify-content-between" style="background: linear-gradient(135deg, #00877a 0%, #00b4a4 100%); padding: 12px 18px; transition: background 0.3s ease;">
                <div class="d-flex align-items-center overflow-hidden me-3" style="min-width: 0; flex: 1;">
                    <div id="ssrme_header_icon_box" class="bg-white rounded-circle d-flex align-items-center justify-content-center shadow-xs flex-shrink-0" style="width: 38px; height: 38px; min-width: 38px; color: #00877a; margin-right: 12px;">
                        <i id="ssrme_header_icon" class="bi bi-shield-check fs-5"></i>
                    </div>
                    <div class="overflow-hidden" style="min-width: 0; flex: 1;">
                        <div class="d-flex align-items-center gap-2">
                            <h6 class="modal-title fw-bold mb-0 text-white text-truncate" id="modalSatuSehatRmeLabel" style="font-size: 14.5px; letter-spacing: 0.2px;">
                                SATUSEHAT Rekam Medis
                            </h6>
                            <span id="ssrme_header_badge" class="badge rounded-pill bg-white text-teal fw-bold d-none" style="font-size: 10px; padding: 2px 8px;">
                                REGULER
                            </span>
                        </div>
                        <div class="text-white-50 text-truncate" style="font-size: 12px; margin-top: 2px;">
                            <span id="ssrme_subtitle_tag">Kemenkes RI</span> &bull; <span id="ssrme_patient_header" class="text-white fw-semibold">-</span>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2 flex-shrink-0 ms-auto">
                    <button type="button" class="btn btn-sm btn-outline-light rounded-pill px-2.5 py-1 border-white-50 text-white d-flex align-items-center gap-1 shadow-2xs" onclick="retryOpenSatuSehatRme()" style="font-size: 11.5px; font-weight: 500;" title="Muat Ulang">
                        <i class="bi bi-arrow-clockwise"></i>
                        <span>Refresh</span>
                    </button>
                    <button type="button" class="btn-close btn-close-white ms-2" data-bs-dismiss="modal" aria-label="Close" style="font-size: 11px;"></button>
                </div>
            </div>

            <!-- Modal Body -->
            <div class="modal-body p-3 position-relative" style="background-color: #f8fafc; min-height: 380px;">
                
                <!-- 1. LOADING STATE -->
                <div id="ssrme_view_loading" class="d-flex flex-column align-items-center justify-content-center py-5">
                    <div id="ssrme_loading_spinner" class="spinner-border mb-3" style="width: 3rem; height: 3rem; color: #00877a;" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <h6 id="ssrme_loading_title" class="fw-bold text-dark mb-1">Menghubungkan ke SATUSEHAT</h6>
                    <p class="text-secondary small mb-0 text-center px-3" id="ssrme_loading_text">
                        Sedang memverifikasi izin akses & menyiapkan tautan RME Nasional...
                    </p>
                </div>

                <!-- 2. VIEWER STATE (PILIHAN: TAB BARU / POPUP JENDELA) -->
                <div id="ssrme_view_viewer" class="d-none d-flex flex-column align-items-center justify-content-center py-4 px-2 text-center">
                    <div id="ssrme_viewer_icon_box" class="mb-3 rounded-circle d-flex align-items-center justify-content-center shadow-xs" style="width: 68px; height: 68px; background-color: #e6f7f5; color: #00877a;">
                        <i class="bi bi-box-arrow-up-right fs-1"></i>
                    </div>
                    <span id="ssrme_viewer_badge" class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1 mb-2 fw-semibold" style="font-size: 11px;">
                        <i class="bi bi-check2-circle me-1"></i>Izin Akses Pasien Terverifikasi
                    </span>
                    <h5 id="ssrme_viewer_title" class="fw-bold text-dark mb-1">RME SATUSEHAT Siap Diakses</h5>
                    <p id="ssrme_viewer_desc" class="text-secondary small mb-4 px-3" style="max-width: 500px; font-size: 12.5px;">
                        Viewer rekam medis nasional resmi dari Kemenkes RI siap dibuka. Silakan pilih mode tampilan yang dokter inginkan:
                    </p>

                    <div class="w-100 px-3 mb-3 d-flex flex-column flex-sm-row gap-2.5 justify-content-center">
                        <a id="btnSsrmeOpenDirect" href="#" target="_blank" rel="noopener noreferrer" class="btn btn-lg btn-success flex-fill rounded-pill fw-bold py-2.5 shadow-sm d-flex align-items-center justify-content-center gap-2" style="background-color: #00877a; border-color: #00877a; font-size: 13.5px;">
                            <i class="bi bi-box-arrow-up-right"></i>
                            <span>Buka di Tab Baru</span>
                        </a>
                        <button type="button" id="btnSsrmeOpenPopup" class="btn btn-lg btn-outline-success flex-fill rounded-pill fw-bold py-2.5 shadow-sm d-flex align-items-center justify-content-center gap-2" onclick="openSsrmeAsPopup()" style="color: #00877a; border: 1.5px solid #00877a; font-size: 13.5px;">
                            <i class="bi bi-window-stack"></i>
                            <span>Buka Jendela Pop-up</span>
                        </button>
                    </div>

                    <p id="ssrme_viewer_note" class="text-muted small mb-0" style="font-size: 11px;">
                        <i class="bi bi-shield-check me-1 text-success"></i>Tautan viewer resmi aman dan memiliki masa berlaku dari SATUSEHAT. Mode pop-up memudahkan dokter melihat RME bersandingan dengan layar ERM.
                    </p>
                </div>

                <!-- 3A. CONSENT REQUIRED STATE - REGULER (PANDUAN SATUSEHAT MOBILE) -->
                <div id="ssrme_view_consent" class="d-none d-flex flex-column align-items-center justify-content-center py-2 px-1 text-center">
                    <!-- Header Badge & Title -->
                    <div class="d-inline-flex align-items-center gap-1.5 px-3 py-1 rounded-pill bg-warning-subtle text-warning-emphasis border border-warning-subtle mb-2" style="font-size: 11.5px; font-weight: 600;">
                        <i class="bi bi-shield-lock-fill text-warning"></i>
                        <span>Persetujuan Pasien Diperlukan</span>
                    </div>

                    <h5 class="fw-bold text-dark mb-1">Panduan Izin Akses di SATUSEHAT Mobile</h5>
                    <p class="text-secondary small mb-3 px-2" style="max-width: 620px; font-size: 12px;">
                        Sesuai petunjuk teknis <strong>SATUSEHAT Rekam Medis (SSRME V2.0)</strong>, minta pasien membuka aplikasi <strong>SATUSEHAT Mobile</strong> di ponselnya dan ikuti 4 langkah berikut:
                    </p>

                    <!-- 4 Langkah Visual sesuai Slide Kemenkes -->
                    <div class="row g-2 mb-3 w-100 text-start">
                        <!-- Langkah 1 -->
                        <div class="col-12 col-sm-6 col-lg-3">
                            <div class="card h-100 border border-light-subtle shadow-2xs rounded-3 p-2.5 bg-white position-relative overflow-hidden" style="border-top: 3px solid #00877a !important;">
                                <div class="d-flex align-items-center justify-content-between mb-1.5">
                                    <span class="badge rounded-pill fw-bold text-white px-2 py-0.5" style="background-color: #00877a; font-size: 9.5px; letter-spacing: 0.3px;">
                                        Langkah 01
                                    </span>
                                    <i class="bi bi-grid-fill text-muted" style="font-size: 13px;"></i>
                                </div>
                                <div class="fw-bold text-dark mb-1" style="font-size: 12px;">Menu Fitur</div>
                                <p class="text-secondary mb-0" style="font-size: 11px; line-height: 1.4;">
                                    Buka aplikasi <strong>SATUSEHAT Mobile</strong> di ponsel, lalu klik menu <strong>Fitur</strong> di bilah bawah.
                                </p>
                            </div>
                        </div>

                        <!-- Langkah 2 -->
                        <div class="col-12 col-sm-6 col-lg-3">
                            <div class="card h-100 border border-light-subtle shadow-2xs rounded-3 p-2.5 bg-white position-relative overflow-hidden" style="border-top: 3px solid #00877a !important;">
                                <div class="d-flex align-items-center justify-content-between mb-1.5">
                                    <span class="badge rounded-pill fw-bold text-white px-2 py-0.5" style="background-color: #00877a; font-size: 9.5px; letter-spacing: 0.3px;">
                                        Langkah 02
                                    </span>
                                    <i class="bi bi-clipboard2-pulse text-muted" style="font-size: 13px;"></i>
                                </div>
                                <div class="fw-bold text-dark mb-1" style="font-size: 12px;">Pilih Resume Medis</div>
                                <p class="text-secondary mb-0" style="font-size: 11px; line-height: 1.4;">
                                    Pada kelompok <strong>Resume Medis</strong>, pilih ikon menu <strong>Rawat Jalan</strong> (atau Rawat Inap).
                                </p>
                            </div>
                        </div>

                        <!-- Langkah 3 -->
                        <div class="col-12 col-sm-6 col-lg-3">
                            <div class="card h-100 border border-light-subtle shadow-2xs rounded-3 p-2.5 bg-white position-relative overflow-hidden" style="border-top: 3px solid #00877a !important;">
                                <div class="d-flex align-items-center justify-content-between mb-1.5">
                                    <span class="badge rounded-pill fw-bold text-white px-2 py-0.5" style="background-color: #00877a; font-size: 9.5px; letter-spacing: 0.3px;">
                                        Langkah 03
                                    </span>
                                    <i class="bi bi-box-arrow-up-right text-muted" style="font-size: 13px;"></i>
                                </div>
                                <div class="fw-bold text-dark mb-1" style="font-size: 12px;">Bagikan Akses</div>
                                <p class="text-secondary mb-0" style="font-size: 11px; line-height: 1.4;">
                                    Klik tombol <strong>Bagikan Akses Resume Medis</strong> di layar ponsel pasien.
                                </p>
                            </div>
                        </div>

                        <!-- Langkah 4 -->
                        <div class="col-12 col-sm-6 col-lg-3">
                            <div class="card h-100 border border-light-subtle shadow-2xs rounded-3 p-2.5 bg-white position-relative overflow-hidden" style="border-top: 3px solid #00877a !important;">
                                <div class="d-flex align-items-center justify-content-between mb-1.5">
                                    <span class="badge rounded-pill fw-bold text-white px-2 py-0.5" style="background-color: #00877a; font-size: 9.5px; letter-spacing: 0.3px;">
                                        Langkah 04
                                    </span>
                                    <i class="bi bi-check-circle-fill text-muted" style="font-size: 13px;"></i>
                                </div>
                                <div class="fw-bold text-dark mb-1" style="font-size: 12px;">Setujui Akses</div>
                                <p class="text-secondary mb-0" style="font-size: 11px; line-height: 1.4;">
                                    Centang persetujuan, lalu klik tombol biru <strong>Bagikan Kode Akses</strong>.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Opsional QR Code & Manual Link -->
                    <div id="ssrme_qr_container" class="d-none mb-3 p-2 bg-white rounded-3 border shadow-2xs text-center">
                        <div class="small fw-semibold text-secondary mb-1" style="font-size: 11px;">
                            <i class="bi bi-qr-code-scan me-1 text-teal"></i>Atau scan QR Code / buka link berikut:
                        </div>
                        <div id="ssrme_qrcode" class="d-flex justify-content-center align-items-center my-1.5"></div>
                        <a id="ssrme_verify_link" href="#" target="_blank" class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-1" style="font-size: 11px;">
                            <i class="bi bi-box-arrow-up-right me-1"></i>Buka Link Verifikasi
                        </a>
                    </div>

                    <!-- Tombol Aksi Utama -->
                    <div class="w-100 px-2 mt-1">
                        <button type="button" class="btn btn-lg btn-success rounded-pill px-4 py-2.5 fw-bold shadow-sm d-inline-flex align-items-center gap-2" onclick="retryOpenSatuSehatRme()" style="background-color: #00877a; border-color: #00877a; font-size: 13.5px;">
                            <i class="bi bi-check-circle-fill fs-5"></i>
                            <span>Pasien Sudah Menyetujui, Buka RME</span>
                        </button>
                        <p class="text-muted small mt-2 mb-0" style="font-size: 11px;">
                            <i class="bi bi-shield-check text-success me-1"></i>Setelah pasien menyelesaikan Langkah 4 di ponselnya, izin akses akan aktif otomatis secara real-time.
                        </p>
                    </div>
                </div>

                <!-- 3B. EMERGENCY VERIFICATION STATE (PANDUAN KHUSUS UGD / BYPASS KODE AKSES) -->
                <div id="ssrme_view_emergency" class="d-none d-flex flex-column align-items-center justify-content-center py-2 px-1 text-center">
                    <!-- Red Header Badge -->
                    <div class="d-inline-flex align-items-center gap-1.5 px-3 py-1.5 rounded-pill bg-danger-subtle text-danger border border-danger-subtle mb-2" style="font-size: 11.5px; font-weight: 700;">
                        <i class="bi bi-shield-fill-exclamation text-danger"></i>
                        <span>AKSES KHUSUS KONDISI EMERGENCY</span>
                    </div>

                    <h5 class="fw-bold text-dark mb-1">Otorisasi Akses Emergency RME Nasional</h5>
                    <p class="text-secondary small mb-3 px-2" style="max-width: 620px; font-size: 12px;">
                        Akses tanpa kode pasien dilakukan demi keselamatan jiwa pasien setelah wali memberikan izin dan seluruh alasan klinis dicatat dalam <strong>Audit Trail Kemenkes RI</strong>.
                    </p>

                    <!-- 3 Langkah Prosedur Kedaruratan sesuai Juknis Kemenkes -->
                    <div class="row g-2 mb-3 w-100 text-start">
                        <!-- Langkah 1 -->
                        <div class="col-12 col-md-4">
                            <div class="card h-100 border border-danger-subtle shadow-2xs rounded-3 p-2.5 bg-white position-relative overflow-hidden" style="border-top: 3px solid #dc2626 !important;">
                                <div class="d-flex align-items-center justify-content-between mb-1.5">
                                    <span class="badge rounded-pill fw-bold text-white px-2 py-0.5" style="background-color: #dc2626; font-size: 9.5px; letter-spacing: 0.3px;">
                                        Langkah 01
                                    </span>
                                    <i class="bi bi-box-arrow-up-right text-danger" style="font-size: 13px;"></i>
                                </div>
                                <div class="fw-bold text-dark mb-1" style="font-size: 12px;">Buka Form Kemenkes</div>
                                <p class="text-secondary mb-0" style="font-size: 11px; line-height: 1.4;">
                                    Klik tombol merah <strong>Buka Form Akses Emergency</strong> di bawah untuk membuka halaman otorisasi kedaruratan resmi.
                                </p>
                            </div>
                        </div>

                        <!-- Langkah 2 -->
                        <div class="col-12 col-md-4">
                            <div class="card h-100 border border-danger-subtle shadow-2xs rounded-3 p-2.5 bg-white position-relative overflow-hidden" style="border-top: 3px solid #dc2626 !important;">
                                <div class="d-flex align-items-center justify-content-between mb-1.5">
                                    <span class="badge rounded-pill fw-bold text-white px-2 py-0.5" style="background-color: #dc2626; font-size: 9.5px; letter-spacing: 0.3px;">
                                        Langkah 02
                                    </span>
                                    <i class="bi bi-pencil-square text-danger" style="font-size: 13px;"></i>
                                </div>
                                <div class="fw-bold text-dark mb-1" style="font-size: 12px;">Isi Alasan & Data Wali</div>
                                <p class="text-secondary mb-0" style="font-size: 11px; line-height: 1.4;">
                                    Tuliskan alasan klinis kedaruratan (min 10 karakter) serta identitas pengantar/wali pasien (Nama, NIK, Hubungan).
                                </p>
                            </div>
                        </div>

                        <!-- Langkah 3 -->
                        <div class="col-12 col-md-4">
                            <div class="card h-100 border border-danger-subtle shadow-2xs rounded-3 p-2.5 bg-white position-relative overflow-hidden" style="border-top: 3px solid #dc2626 !important;">
                                <div class="d-flex align-items-center justify-content-between mb-1.5">
                                    <span class="badge rounded-pill fw-bold text-white px-2 py-0.5" style="background-color: #dc2626; font-size: 9.5px; letter-spacing: 0.3px;">
                                        Langkah 03
                                    </span>
                                    <i class="bi bi-check-circle-fill text-danger" style="font-size: 13px;"></i>
                                </div>
                                <div class="fw-bold text-dark mb-1" style="font-size: 12px;">Ajukan Akses Emergency</div>
                                <p class="text-secondary mb-0" style="font-size: 11px; line-height: 1.4;">
                                    Centang persetujuan & klik <strong>Ajukan Akses Emergency</strong>. RME Nasional pasien langsung terbuka otomatis.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Aksi Kedaruratan -->
                    <div class="w-100 px-3 mb-2 d-flex flex-column flex-sm-row gap-2.5 justify-content-center">
                        <a id="btnSsrmeEmergencyOpenDirect" href="#" target="_blank" rel="noopener noreferrer" class="btn btn-lg btn-danger flex-fill rounded-pill fw-bold py-2.5 shadow-sm d-flex align-items-center justify-content-center gap-2" style="background-color: #dc2626; border-color: #dc2626; font-size: 13.5px;">
                            <i class="bi bi-box-arrow-up-right"></i>
                            <span>Buka Form Akses Emergency (Tab Baru)</span>
                        </a>
                        <button type="button" id="btnSsrmeEmergencyOpenPopup" class="btn btn-lg btn-outline-danger flex-fill rounded-pill fw-bold py-2.5 shadow-sm d-flex align-items-center justify-content-center gap-2" onclick="openSsrmeAsPopup()" style="color: #dc2626; border: 1.5px solid #dc2626; font-size: 13.5px;">
                            <i class="bi bi-window-stack"></i>
                            <span>Buka Jendela Pop-up</span>
                        </button>
                    </div>

                    <div class="w-100 text-center mt-2">
                        <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-1.5" onclick="retryOpenSatuSehatRme()" style="font-size: 11.5px;">
                            <i class="bi bi-arrow-clockwise me-1"></i>Sudah Submit Form di Kemenkes? Klik Cek Status
                        </button>
                        <p class="text-muted small mt-2 mb-0" style="font-size: 10.5px;">
                            <i class="bi bi-shield-exclamation text-danger me-1"></i>Seluruh tindakan pengajuan akses darurat ini diaudit dan dipantau resmi oleh Kementerian Kesehatan RI.
                        </p>
                    </div>
                </div>

                <!-- 4. ERROR STATE -->
                <div id="ssrme_view_error" class="d-none d-flex flex-column align-items-center justify-content-center py-4 text-center">
                    <div class="mb-3 rounded-circle d-flex align-items-center justify-content-center" style="width: 56px; height: 56px; background-color: #fde8e8; color: #dc2626;">
                        <i class="bi bi-exclamation-triangle fs-2"></i>
                    </div>
                    <h6 class="fw-bold text-dark mb-1">Gagal Membuka RME SATUSEHAT</h6>
                    <p class="text-secondary small mb-3 px-3" id="ssrme_error_message">
                        Terjadi kendala saat menghubungkan ke server SATUSEHAT.
                    </p>
                    <div class="d-flex gap-2 justify-content-center">
                        <button type="button" class="btn btn-sm btn-secondary rounded-pill px-3" data-bs-dismiss="modal">
                            Tutup
                        </button>
                        <button type="button" class="btn btn-sm btn-primary rounded-pill px-3 fw-semibold" onclick="retryOpenSatuSehatRme()">
                            <i class="bi bi-arrow-clockwise me-1"></i>Coba Lagi
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<style>
    #modalSatuSehatRme {
        z-index: 1065 !important;
    }
    .modal-backdrop + .modal-backdrop {
        z-index: 1060 !important;
    }
    #btnSsrmeOpenPopup:hover {
        background-color: #00877a !important;
        color: #ffffff !important;
    }
    #btnSsrmeEmergencyOpenPopup:hover {
        background-color: #dc2626 !important;
        color: #ffffff !important;
    }
</style>

@push('script')
<script>
    let ssrmeQrInstance = null;
    let currentShlinkUrl = '';
    let isCurrentEmergency = 0;
    let currentTargetNoRawat = '';
    let currentTargetKdDokter = '';

    $(document).ready(function() {
        // Jaga agar scroll modal induk tetap aktif saat modal SATUSEHAT ditutup
        $('#modalSatuSehatRme').on('hidden.bs.modal', function(e) {
            e.stopPropagation();
            if ($('#modalSoapRalan').hasClass('show') || $('#modalSoapUgd').hasClass('show') || $('.modal.show').length > 0) {
                $('body').addClass('modal-open');
            }
        });
    });

    function openSsrmeAsPopup() {
        const url = currentShlinkUrl || $('#btnSsrmeOpenDirect').attr('href') || $('#btnSsrmeEmergencyOpenDirect').attr('href');
        if (!url || url === '#' || url === 'javascript:void(0)') {
            return;
        }

        // Ukuran pop-up optimal
        const width = Math.min(1300, Math.floor(window.screen.availWidth * 0.9));
        const height = Math.min(850, Math.floor(window.screen.availHeight * 0.9));
        const left = Math.max(0, Math.floor((window.screen.availWidth - width) / 2));
        const top = Math.max(0, Math.floor((window.screen.availHeight - height) / 2));

        const win = window.open(
            url,
            'SatuSehatRmePopup',
            `width=${width},height=${height},left=${left},top=${top},resizable=yes,scrollbars=yes,status=no,toolbar=no,menubar=no,location=no`
        );

        if (win) {
            win.focus();
        } else {
            if (typeof swalToast === 'function') {
                swalToast('Pop-up terhalang oleh proteksi browser. Silakan izinkan pop-up atau klik "Buka di Tab Baru".', 'warning');
            } else {
                alert('Pop-up terhalang oleh proteksi browser. Silakan izinkan pop-up atau klik "Buka di Tab Baru".');
            }
        }
    }

    /**
     * Buka RME SATUSEHAT Umum (Bisa dipanggil dari Poliklinik atau UGD)
     * isEmergency: 0 = Reguler (Persetujuan Consent via SS Mobile)
     *              1 = Emergency (Bypass Kode Akses untuk UGD/Gawat Darurat)
     */
    function openSatuSehatRme(isEmergency = 0, customNoRawat = null, customKdDokter = null, customNmPasien = null, customNoRm = null) {
        currentShlinkUrl = '';
        isCurrentEmergency = isEmergency ? 1 : 0;

        const noRawat = customNoRawat || $('#nomor_rawat').val() || $('#no_rawat').val() || $('input[name="no_rawat"]').val();
        const kdDokter = customKdDokter || $('#kd_dokter').val() || $('#kd_dokter_dpjp').val() || (typeof kd_dokter !== 'undefined' ? kd_dokter : '');
        const nmPasien = customNmPasien || $('#nama_pasien').val() || $('#pasien').val() || $('#nm_pasien').val() || '-';
        const noRm = customNoRm || $('#no_rm').val() || $('#no_rkm_medis').val() || '-';

        currentTargetNoRawat = noRawat;
        currentTargetKdDokter = kdDokter;

        if (!noRawat || noRawat === '-') {
            if (typeof swalToast === 'function') {
                swalToast('Silakan pilih data pasien terlebih dahulu', 'warning');
            } else {
                alert('Silakan pilih data pasien terlebih dahulu');
            }
            return;
        }

        try {
            if (document.activeElement && typeof document.activeElement.blur === 'function') {
                document.activeElement.blur();
            }
        } catch (e) {}

        // Terapkan Tema Header Sesuai Mode (Reguler vs Emergency)
        applySsrmeTheme(isCurrentEmergency);

        $('#ssrme_patient_header').text(`${noRm} - ${nmPasien}`);
        
        // Buka modal secara aman tanpa focus trap
        const modalEl = document.getElementById('modalSatuSehatRme');
        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            const ssrmeModal = bootstrap.Modal.getOrCreateInstance(modalEl, {
                backdrop: true,
                keyboard: true,
                focus: false
            });
            ssrmeModal.show();
        } else {
            $('#modalSatuSehatRme').modal({ focus: false }).modal('show');
        }

        // Reset view ke loading state
        showSsrmeView('loading');
        $('#btnSsrmeOpenDirect').attr('href', '#');
        $('#btnSsrmeEmergencyOpenDirect').attr('href', '#');

        fetchSatuSehatRme(noRawat, kdDokter, isCurrentEmergency);
    }

    /**
     * Helper khusus UGD / IGD
     */
    function openSatuSehatRmeUgd(isEmergency = 1) {
        const noRawat = $('#modalSoapUgd #no_rawat').val() || $('input[name="no_rawat"]').val();
        const kdDokter = $('#modalSoapUgd #kd_dokter_dpjp').val() || (typeof kd_dokter !== 'undefined' ? kd_dokter : '');
        const nmPasien = $('#modalSoapUgd #pasien').val() || $('#modalSoapUgd #nm_pasien').val() || '-';
        const noRm = $('#modalSoapUgd #no_rkm_medis').val() || '-';

        openSatuSehatRme(isEmergency, noRawat, kdDokter, nmPasien, noRm);
    }

    function retryOpenSatuSehatRme() {
        if (!currentTargetNoRawat) {
            currentTargetNoRawat = $('#modalSoapUgd #no_rawat').val() || $('#nomor_rawat').val() || $('#no_rawat').val() || $('input[name="no_rawat"]').val();
        }
        if (!currentTargetKdDokter) {
            currentTargetKdDokter = $('#modalSoapUgd #kd_dokter_dpjp').val() || $('#kd_dokter').val() || (typeof kd_dokter !== 'undefined' ? kd_dokter : '');
        }
        showSsrmeView('loading');
        fetchSatuSehatRme(currentTargetNoRawat, currentTargetKdDokter, isCurrentEmergency);
    }

    function applySsrmeTheme(isEmergency) {
        const header = $('#ssrme_modal_header');
        const iconBox = $('#ssrme_header_icon_box');
        const icon = $('#ssrme_header_icon');
        const title = $('#modalSatuSehatRmeLabel');
        const badge = $('#ssrme_header_badge');
        const subtag = $('#ssrme_subtitle_tag');
        const loadingSpinner = $('#ssrme_loading_spinner');
        const loadingTitle = $('#ssrme_loading_title');
        const viewerIconBox = $('#ssrme_viewer_icon_box');
        const viewerBadge = $('#ssrme_viewer_badge');
        const btnDirect = $('#btnSsrmeOpenDirect');
        const btnPopup = $('#btnSsrmeOpenPopup');

        if (isEmergency) {
            header.css('background', 'linear-gradient(135deg, #991b1b 0%, #dc2626 100%)');
            iconBox.css('color', '#dc2626');
            icon.removeClass('bi-shield-check').addClass('bi-shield-fill-exclamation');
            title.text('SATUSEHAT RME Emergency');
            badge.removeClass('d-none bg-white text-teal').addClass('bg-white text-danger').text('AKSES EMERGENCY (BYPASS)');
            subtag.text('Kondisi Gawat Darurat (UGD/IGD)');
            
            loadingSpinner.css('color', '#dc2626');
            loadingTitle.text('Menghubungkan ke Akses Emergency SATUSEHAT');
            
            viewerIconBox.css({ 'background-color': '#fef2f2', 'color': '#dc2626' });
            viewerBadge.removeClass('bg-success-subtle text-success border-success-subtle')
                       .addClass('bg-danger-subtle text-danger border-danger-subtle')
                       .html('<i class="bi bi-shield-fill-exclamation me-1"></i>Otorisasi Akses Emergency Siap');
            
            btnDirect.css({ 'background-color': '#dc2626', 'border-color': '#dc2626' });
            btnPopup.css({ 'color': '#dc2626', 'border-color': '#dc2626' });
            $('#ssrme_viewer_note').html('<i class="bi bi-shield-exclamation me-1 text-danger"></i>Akses Emergency dicatat dalam Audit Trail Kemenkes RI demi keselamatan jiwa pasien.');
        } else {
            header.css('background', 'linear-gradient(135deg, #00877a 0%, #00b4a4 100%)');
            iconBox.css('color', '#00877a');
            icon.removeClass('bi-shield-fill-exclamation').addClass('bi-shield-check');
            title.text('SATUSEHAT Rekam Medis');
            badge.removeClass('d-none bg-white text-danger').addClass('bg-white text-teal').text('REGULER');
            subtag.text('Kemenkes RI');
            
            loadingSpinner.css('color', '#00877a');
            loadingTitle.text('Menghubungkan ke SATUSEHAT');
            
            viewerIconBox.css({ 'background-color': '#e6f7f5', 'color': '#00877a' });
            viewerBadge.removeClass('bg-danger-subtle text-danger border-danger-subtle')
                       .addClass('bg-success-subtle text-success border-success-subtle')
                       .html('<i class="bi bi-check2-circle me-1"></i>Izin Akses Pasien Terverifikasi');
            
            btnDirect.css({ 'background-color': '#00877a', 'border-color': '#00877a' });
            btnPopup.css({ 'color': '#00877a', 'border-color': '#00877a' });
            $('#ssrme_viewer_note').html('<i class="bi bi-shield-check me-1 text-success"></i>Tautan viewer resmi aman dan memiliki masa berlaku dari SATUSEHAT. Mode pop-up memudahkan dokter melihat RME bersandingan dengan layar ERM.');
        }
    }

    function fetchSatuSehatRme(noRawat, kdDokter, isEmergency = 0) {
        $.ajax({
            url: '{{ route("satusehat.rme.open") }}',
            type: 'GET',
            data: {
                no_rawat: noRawat,
                kd_dokter: kdDokter,
                is_emergency: isEmergency
            },
            dataType: 'json',
            success: function(res) {
                if (res.status === 'ready' && res.shlink_url) {
                    // Kasus 1: Siap Tampil (Tautan langsung terbuka)
                    currentShlinkUrl = res.shlink_url;
                    $('#btnSsrmeOpenDirect').attr('href', res.shlink_url);
                    showSsrmeView('viewer');

                    if (typeof swalToast === 'function') {
                        swalToast('Tautan RME SATUSEHAT siap dibuka', 'success');
                    }
                } else if (res.status === 'consent_required') {
                    // Kasus 2: Butuh Persetujuan (Reguler vs Emergency)
                    const targetUrl = res.verification_url || res.shlink_url || '';
                    currentShlinkUrl = targetUrl;

                    const isModeEmergency = Boolean(isEmergency || (res && res.is_emergency));

                    if (isModeEmergency) {
                        // Tampilkan Form Panduan Emergency
                        $('#btnSsrmeEmergencyOpenDirect').attr('href', targetUrl || '#');
                        showSsrmeView('emergency');
                    } else {
                        // Tampilkan Panduan 4-Langkah Mobile
                        showSsrmeView('consent');

                        const qrBox = $('#ssrme_qr_container');
                        const qrContainer = document.getElementById('ssrme_qrcode');
                        qrContainer.innerHTML = '';

                        if (res.verification_url && typeof QRCode !== 'undefined') {
                            qrBox.removeClass('d-none');
                            $('#ssrme_verify_link').attr('href', res.verification_url);
                            ssrmeQrInstance = new QRCode(qrContainer, {
                                text: res.verification_url,
                                width: 130,
                                height: 130,
                                colorDark: "#0f172a",
                                colorLight: "#ffffff",
                                correctLevel: QRCode.CorrectLevel.M
                            });
                        } else {
                            qrBox.addClass('d-none');
                        }
                    }
                } else {
                    showSsrmeError(res.message || 'Respons tidak valid dari server');
                }
            },
            error: function(xhr) {
                const res = xhr.responseJSON;
                const msg = res && res.message ? res.message : '';
                
                // Jika error berkaitan dengan consent
                if (res && (res.status === 'consent_required' || msg.toLowerCase().includes('consent') || msg.toLowerCase().includes('charme') || msg.toLowerCase().includes('persetujuan'))) {
                    if (isEmergency) {
                        showSsrmeView('emergency');
                    } else {
                        showSsrmeView('consent');
                        $('#ssrme_qr_container').addClass('d-none');
                    }
                    return;
                }

                let errorMsg = 'Gagal mengakses RME SATUSEHAT.';
                if (msg) {
                    errorMsg = msg;
                } else if (xhr.statusText) {
                    errorMsg += ' (' + xhr.statusText + ')';
                }
                showSsrmeError(errorMsg);
            }
        });
    }

    function showSsrmeView(view) {
        $('#ssrme_view_loading').addClass('d-none');
        $('#ssrme_view_viewer').addClass('d-none');
        $('#ssrme_view_consent').addClass('d-none');
        $('#ssrme_view_emergency').addClass('d-none');
        $('#ssrme_view_error').addClass('d-none');

        if (view === 'loading') $('#ssrme_view_loading').removeClass('d-none');
        else if (view === 'viewer') $('#ssrme_view_viewer').removeClass('d-none');
        else if (view === 'consent') $('#ssrme_view_consent').removeClass('d-none');
        else if (view === 'emergency') $('#ssrme_view_emergency').removeClass('d-none');
        else if (view === 'error') $('#ssrme_view_error').removeClass('d-none');
    }

    function showSsrmeError(message) {
        $('#ssrme_error_message').text(message);
        showSsrmeView('error');
    }
</script>
@endpush
