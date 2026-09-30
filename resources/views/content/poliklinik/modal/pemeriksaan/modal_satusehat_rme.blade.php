<div class="modal fade" id="modalSatuSehatRme" tabindex="-1" aria-labelledby="modalSatuSehatRmeLabel" aria-hidden="true" style="z-index: 1065;">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 760px;">
        <div class="modal-content shadow-lg border-0 rounded-4 overflow-hidden">
            <!-- Modal Header -->
            <div class="modal-header text-white d-flex align-items-center justify-content-between" style="background: linear-gradient(135deg, #00877a 0%, #00b4a4 100%); padding: 12px 18px;">
                <div class="d-flex align-items-center overflow-hidden me-3" style="min-width: 0; flex: 1;">
                    <div class="bg-white rounded-circle d-flex align-items-center justify-content-center shadow-xs flex-shrink-0" style="width: 38px; height: 38px; min-width: 38px; color: #00877a; margin-right: 12px;">
                        <i class="bi bi-shield-check fs-5"></i>
                    </div>
                    <div class="overflow-hidden" style="min-width: 0; flex: 1;">
                        <h6 class="modal-title fw-bold mb-0 text-white text-truncate" id="modalSatuSehatRmeLabel" style="font-size: 14.5px; letter-spacing: 0.2px;">
                            SATUSEHAT Rekam Medis
                        </h6>
                        <div class="text-white-50 text-truncate" style="font-size: 12px; margin-top: 2px;">
                            Kemenkes RI &bull; <span id="ssrme_patient_header" class="text-white fw-semibold">-</span>
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
                    <div class="spinner-border text-teal mb-3" style="width: 3rem; height: 3rem; color: #00877a;" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <h6 class="fw-bold text-dark mb-1">Menghubungkan ke SATUSEHAT</h6>
                    <p class="text-secondary small mb-0 text-center px-3" id="ssrme_loading_text">
                        Sedang memverifikasi izin akses & menyiapkan tautan RME Nasional...
                    </p>
                </div>

                <!-- 2. VIEWER STATE (BUKA DI TAB BARU) -->
                <div id="ssrme_view_viewer" class="d-none d-flex flex-column align-items-center justify-content-center py-4 px-2 text-center">
                    <div class="mb-3 rounded-circle d-flex align-items-center justify-content-center shadow-xs" style="width: 68px; height: 68px; background-color: #e6f7f5; color: #00877a;">
                        <i class="bi bi-box-arrow-up-right fs-1"></i>
                    </div>
                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1 mb-2 fw-semibold" style="font-size: 11px;">
                        <i class="bi bi-check2-circle me-1"></i>Izin Akses Pasien Terverifikasi
                    </span>
                    <h5 class="fw-bold text-dark mb-1">RME SATUSEHAT Siap Diakses</h5>
                    <p class="text-secondary small mb-4 px-3" style="max-width: 440px;">
                        Viewer rekam medis nasional resmi dari Kemenkes RI dibuka pada tab baru browser agar tampilan lebih luas dan tidak terhalang proteksi keamanan.
                    </p>

                    <div class="w-100 px-3 mb-3">
                        <a id="btnSsrmeOpenDirect" href="#" target="_blank" rel="noopener noreferrer" class="btn btn-lg btn-success w-100 rounded-pill fw-bold py-2.5 shadow-sm d-flex align-items-center justify-content-center gap-2" style="background-color: #00877a; border-color: #00877a; font-size: 14px;">
                            <i class="bi bi-box-arrow-up-right"></i>
                            <span>Buka RME SATUSEHAT (Tab Baru)</span>
                        </a>
                    </div>

                    <p class="text-muted small mb-0" style="font-size: 11px;">
                        <i class="bi bi-shield-check me-1 text-success"></i>Tautan viewer resmi aman dan memiliki masa berlaku dari SATUSEHAT.
                    </p>
                </div>

                <!-- 3. CONSENT REQUIRED STATE (PANDUAN SATUSEHAT MOBILE) -->
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
                                <div class="fw-bold text-dark mb-1" style="font-size: 12px;">Pilih Rawat Jalan</div>
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

                    <!-- Opsional QR Code & Manual Link (Tampil hanya jika verification_url tersedia) -->
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

@push('script')
<script>
    let ssrmeQrInstance = null;

    $(document).ready(function() {
        // Hentikan bubbling event modal agar tidak memicu reset form di modal induk (#modalSoapRalan)
        $('#modalSatuSehatRme').on('hidden.bs.modal hide.bs.modal shown.bs.modal show.bs.modal', function(e) {
            e.stopPropagation();
        });

        // Jaga agar scroll modal induk tetap aktif saat modal SATUSEHAT ditutup
        $('#modalSatuSehatRme').on('hidden.bs.modal', function(e) {
            e.stopPropagation();
            if ($('#modalSoapRalan').hasClass('show') || $('.modal.show').length > 0) {
                $('body').addClass('modal-open');
            }
        });
    });

    function openSatuSehatRme() {
        const noRawat = $('#nomor_rawat').val() || $('input[name="no_rawat"]').val();
        const kdDokter = $('#kd_dokter').val() || (typeof kd_dokter !== 'undefined' ? kd_dokter : '');
        const nmPasien = $('#nama_pasien').val() || '-';
        const noRm = $('#no_rm').val() || '-';

        if (!noRawat || noRawat === '-') {
            if (typeof swalToast === 'function') {
                swalToast('Silakan pilih data pasien terlebih dahulu', 'warning');
            } else {
                alert('Silakan pilih data pasien terlebih dahulu');
            }
            return;
        }

        // Tampilkan modal
        $('#ssrme_patient_header').text(`${noRm} - ${nmPasien}`);
        $('#modalSatuSehatRme').modal('show');

        // Reset view ke loading state
        showSsrmeView('loading');
        $('#btnSsrmeOpenDirect').attr('href', '#');

        fetchSatuSehatRme(noRawat, kdDokter);
    }

    function retryOpenSatuSehatRme() {
        const noRawat = $('#nomor_rawat').val() || $('input[name="no_rawat"]').val();
        const kdDokter = $('#kd_dokter').val() || (typeof kd_dokter !== 'undefined' ? kd_dokter : '');
        showSsrmeView('loading');
        fetchSatuSehatRme(noRawat, kdDokter);
    }

    function fetchSatuSehatRme(noRawat, kdDokter) {
        $.ajax({
            url: '{{ route("satusehat.rme.open") }}',
            type: 'GET',
            data: {
                no_rawat: noRawat,
                kd_dokter: kdDokter
            },
            dataType: 'json',
            success: function(res) {
                if (res.status === 'ready' && res.shlink_url) {
                    // Kasus 1: Siap Tampil (Tautan siap diakses)
                    $('#btnSsrmeOpenDirect').attr('href', res.shlink_url);
                    showSsrmeView('viewer');
                    $('#btnSsrmeOpenDirect').focus();

                    if (typeof swalToast === 'function') {
                        swalToast('Tautan RME SATUSEHAT siap dibuka', 'success');
                    }
                } else if (res.status === 'consent_required') {
                    // Kasus 2: Butuh Persetujuan Pasien
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
                } else {
                    showSsrmeError(res.message || 'Respons tidak valid dari server');
                }
            },
            error: function(xhr) {
                const res = xhr.responseJSON;
                const msg = res && res.message ? res.message : '';
                // Jika berkaitan dengan consent, alihkan langsung ke tampilan panduan
                if (res && (res.status === 'consent_required' || msg.toLowerCase().includes('consent') || msg.toLowerCase().includes('charme') || msg.toLowerCase().includes('persetujuan'))) {
                    showSsrmeView('consent');
                    $('#ssrme_qr_container').addClass('d-none');
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
        $('#ssrme_view_error').addClass('d-none');

        if (view === 'loading') $('#ssrme_view_loading').removeClass('d-none');
        else if (view === 'viewer') $('#ssrme_view_viewer').removeClass('d-none');
        else if (view === 'consent') $('#ssrme_view_consent').removeClass('d-none');
        else if (view === 'error') $('#ssrme_view_error').removeClass('d-none');
    }

    function showSsrmeError(message) {
        $('#ssrme_error_message').text(message);
        showSsrmeView('error');
    }
</script>
@endpush
