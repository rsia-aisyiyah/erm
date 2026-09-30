<div class="modal fade" id="modalSatuSehatRme" tabindex="-1" aria-labelledby="modalSatuSehatRmeLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-fullscreen-lg-down" style="max-width: 92vw;">
        <div class="modal-content shadow-lg border-0 rounded-4 overflow-hidden">
            <!-- Modal Header -->
            <div class="modal-header py-2.5 px-3 text-white" style="background: linear-gradient(135deg, #00877a 0%, #00b4a4 100%);">
                <div class="d-flex align-items-center gap-2">
                    <div class="bg-white text-teal rounded-circle p-1.5 d-flex align-items-center justify-content-center shadow-xs" style="width: 32px; height: 32px; color: #00877a;">
                        <i class="bi bi-shield-check fs-5"></i>
                    </div>
                    <div>
                        <h6 class="modal-title fw-bold mb-0 text-white" id="modalSatuSehatRmeLabel" style="font-size: 14px; letter-spacing: 0.3px;">
                            SATUSEHAT Rekam Medis Elektronik (SSRME)
                        </h6>
                        <small class="text-white-50" style="font-size: 11px;">
                            Kementerian Kesehatan RI &bull; <span id="ssrme_patient_header" class="text-white fw-semibold">-</span>
                        </small>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-1.5">
                    <a id="btnSsrmeNewTab" href="#" target="_blank" class="btn btn-sm btn-light border-0 text-teal rounded-pill px-2.5 py-1 d-none" style="font-size: 11px; font-weight: 600; color: #00877a;" title="Buka di Tab Baru">
                        <i class="bi bi-box-arrow-up-right me-1"></i>Tab Baru
                    </a>
                    <button type="button" class="btn btn-sm btn-light border-0 text-teal rounded-circle p-1 d-flex align-items-center justify-content-center" onclick="retryOpenSatuSehatRme()" style="width: 28px; height: 28px; color: #00877a;" title="Muat Ulang">
                        <i class="bi bi-arrow-clockwise"></i>
                    </button>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>

            <!-- Modal Body -->
            <div class="modal-body p-0 position-relative" style="min-height: 80vh; background-color: #f8fafc;">
                
                <!-- 1. LOADING STATE -->
                <div id="ssrme_view_loading" class="d-flex flex-column align-items-center justify-content-center h-100 py-5" style="min-height: 75vh;">
                    <div class="spinner-border text-teal mb-3" style="width: 3rem; height: 3rem; color: #00877a;" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <h6 class="fw-bold text-dark mb-1">Menghubungkan ke SATUSEHAT Platform</h6>
                    <p class="text-secondary small mb-0 text-center px-3" id="ssrme_loading_text">
                        Sedang memverifikasi izin akses & mengambil data rekam medis nasional pasien...
                    </p>
                </div>

                <!-- 2. VIEWER STATE (IFRAME) -->
                <div id="ssrme_view_viewer" class="d-none w-100 h-100 d-flex flex-column" style="height: 82vh;">
                    <div class="bg-teal-subtle py-1.5 px-3 border-bottom d-flex justify-content-between align-items-center" style="background-color: #e6f7f5; font-size: 11.5px;">
                        <span class="text-dark fw-medium">
                            <i class="bi bi-info-circle text-teal me-1" style="color: #00877a;"></i>
                            Menampilkan riwayat rekam medis terpadu nasional (Alergi, Diagnosis, Terapi, Lab & Radiologi).
                        </span>
                        <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2 py-0.5" style="font-size: 10px;">
                            <i class="bi bi-check2-circle me-1"></i>Izin Akses Aktif
                        </span>
                    </div>
                    <iframe id="ssrme_iframe" src="about:blank" class="w-100 flex-grow-1 border-0" allow="fullscreen" sandbox="allow-scripts allow-same-origin allow-forms allow-popups allow-modals"></iframe>
                </div>

                <!-- 3. CONSENT REQUIRED STATE -->
                <div id="ssrme_view_consent" class="d-none d-flex flex-column align-items-center justify-content-center py-5 px-3" style="min-height: 75vh;">
                    <div class="card border-0 shadow-sm rounded-4 p-4 text-center" style="max-width: 520px; background: #ffffff;">
                        <div class="mb-3 mx-auto rounded-circle d-flex align-items-center justify-content-center" style="width: 64px; height: 64px; background-color: #fff8e6; color: #b78103;">
                            <i class="bi bi-qr-code-scan fs-1"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-1">Persetujuan Pasien Diperlukan</h5>
                        <p class="text-secondary small mb-3">
                            Akses rekam medis nasional membutuhkan izin dari pasien sesuai standar keamanan SATUSEHAT Kemenkes RI.
                        </p>

                        <!-- QR Code Container -->
                        <div class="p-3 bg-light rounded-3 border d-inline-block mx-auto mb-3">
                            <div id="ssrme_qrcode" class="d-flex justify-content-center align-items-center"></div>
                        </div>

                        <div class="alert alert-warning py-2 px-3 small text-start mb-3" style="font-size: 11.5px;">
                            <ol class="mb-0 ps-3">
                                <li>Minta pasien membuka aplikasi <strong>SATUSEHAT Mobile</strong> di ponselnya.</li>
                                <li>Scan QR Code di atas atau buka tautan verifikasi.</li>
                                <li>Setujui pembagian data rekam medis untuk fasilitas kesehatan ini.</li>
                            </ol>
                        </div>

                        <div class="d-flex gap-2 justify-content-center">
                            <a id="ssrme_verify_link" href="#" target="_blank" class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-1.5" style="font-size: 12px;">
                                <i class="bi bi-link-45deg me-1"></i>Buka Link di Browser
                            </a>
                            <button type="button" class="btn btn-sm btn-success rounded-pill px-4 py-1.5 fw-semibold" onclick="retryOpenSatuSehatRme()" style="background-color: #00877a; border-color: #00877a; font-size: 12px;">
                                <i class="bi bi-check-circle me-1"></i>Pasien Sudah Setuju, Buka RME
                            </button>
                        </div>
                    </div>
                </div>

                <!-- 4. ERROR STATE -->
                <div id="ssrme_view_error" class="d-none d-flex flex-column align-items-center justify-content-center py-5 px-3" style="min-height: 75vh;">
                    <div class="card border-0 shadow-sm rounded-4 p-4 text-center" style="max-width: 480px; background: #ffffff;">
                        <div class="mb-3 mx-auto rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background-color: #fde8e8; color: #dc2626;">
                            <i class="bi bi-exclamation-triangle fs-2"></i>
                        </div>
                        <h6 class="fw-bold text-dark mb-1">Gagal Membuka RME SATUSEHAT</h6>
                        <p class="text-secondary small mb-3" id="ssrme_error_message">
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
</div>

@push('script')
<script>
    let ssrmeQrInstance = null;

    function openSatuSehatRme() {
        const noRawat = $('#nomor_rawat').val();
        const kdDokter = $('#kd_dokter').val();
        const nmPasien = $('#nama_pasien').val() || '-';
        const noRm = $('#no_rm').val() || '-';

        if (!noRawat) {
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
        $('#btnSsrmeNewTab').addClass('d-none').attr('href', '#');
        $('#ssrme_iframe').attr('src', 'about:blank');

        fetchSatuSehatRme(noRawat, kdDokter);
    }

    function retryOpenSatuSehatRme() {
        const noRawat = $('#nomor_rawat').val();
        const kdDokter = $('#kd_dokter').val();
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
                    // Kasus 1: Siap Tampil (Iframe)
                    $('#ssrme_iframe').attr('src', res.shlink_url);
                    $('#btnSsrmeNewTab').removeClass('d-none').attr('href', res.shlink_url);
                    showSsrmeView('viewer');

                    if (typeof swalToast === 'function') {
                        swalToast('RME SATUSEHAT berhasil dimuat', 'success');
                    }
                } else if (res.status === 'consent_required') {
                    // Kasus 2: Butuh Persetujuan Pasien
                    showSsrmeView('consent');
                    $('#ssrme_verify_link').attr('href', res.verification_url || '#');

                    // Generate QR Code
                    const qrContainer = document.getElementById('ssrme_qrcode');
                    qrContainer.innerHTML = '';
                    if (res.verification_url && typeof QRCode !== 'undefined') {
                        ssrmeQrInstance = new QRCode(qrContainer, {
                            text: res.verification_url,
                            width: 170,
                            height: 170,
                            colorDark: "#0f172a",
                            colorLight: "#ffffff",
                            correctLevel: QRCode.CorrectLevel.M
                        });
                    }
                } else {
                    showSsrmeError(res.message || 'Respons tidak valid dari server');
                }
            },
            error: function(xhr) {
                let msg = 'Gagal mengakses RME SATUSEHAT.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    msg = xhr.responseJSON.message;
                } else if (xhr.statusText) {
                    msg += ' (' + xhr.statusText + ')';
                }
                showSsrmeError(msg);
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
