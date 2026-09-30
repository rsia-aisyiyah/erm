<div class="modal fade" id="modalSatuSehatRme" tabindex="-1" aria-labelledby="modalSatuSehatRmeLabel" aria-hidden="true" style="z-index: 1065;">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 640px;">
        <div class="modal-content shadow-lg border-0 rounded-4 overflow-hidden">
            <!-- Modal Header -->
            <div class="modal-header py-2.5 px-3.5 text-white d-flex align-items-center justify-content-between" style="background: linear-gradient(135deg, #00877a 0%, #00b4a4 100%);">
                <div class="d-flex align-items-center gap-2.5 overflow-hidden me-3" style="min-width: 0; flex: 1;">
                    <div class="bg-white rounded-circle p-1 d-flex align-items-center justify-content-center shadow-xs flex-shrink-0" style="width: 34px; height: 34px; color: #00877a;">
                        <i class="bi bi-shield-check fs-5"></i>
                    </div>
                    <div class="overflow-hidden" style="min-width: 0; flex: 1;">
                        <h6 class="modal-title fw-bold mb-0 text-white text-truncate" id="modalSatuSehatRmeLabel" style="font-size: 14px; letter-spacing: 0.2px;">
                            SATUSEHAT Rekam Medis
                        </h6>
                        <div class="text-white-50 text-truncate" style="font-size: 11.5px;">
                            Kemenkes RI &bull; <span id="ssrme_patient_header" class="text-white fw-semibold">-</span>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2 flex-shrink-0 ms-auto">
                    <button type="button" class="btn btn-sm btn-outline-light rounded-pill px-2.5 py-0.5 border-white-50 text-white d-flex align-items-center gap-1 shadow-2xs" onclick="retryOpenSatuSehatRme()" style="font-size: 11.5px; font-weight: 500;" title="Muat Ulang">
                        <i class="bi bi-arrow-clockwise"></i>
                        <span>Refresh</span>
                    </button>
                    <button type="button" class="btn-close btn-close-white ms-1" data-bs-dismiss="modal" aria-label="Close" style="font-size: 11px;"></button>
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

                <!-- 3. CONSENT REQUIRED STATE (QR CODE & LINK) -->
                <div id="ssrme_view_consent" class="d-none d-flex flex-column align-items-center justify-content-center py-3 text-center">
                    <div class="mb-2 rounded-circle d-flex align-items-center justify-content-center" style="width: 58px; height: 58px; background-color: #fff8e6; color: #b78103;">
                        <i class="bi bi-qr-code-scan fs-2"></i>
                    </div>
                    <h6 class="fw-bold text-dark mb-1">Persetujuan Pasien Diperlukan</h6>
                    <p class="text-secondary small mb-2 px-3">
                        Akses rekam medis nasional membutuhkan persetujuan pasien melalui aplikasi <strong>SATUSEHAT Mobile</strong>.
                    </p>

                    <!-- QR Code Container -->
                    <div class="p-2.5 bg-white rounded-3 border shadow-2xs d-inline-block mx-auto mb-2">
                        <div id="ssrme_qrcode" class="d-flex justify-content-center align-items-center"></div>
                    </div>

                    <div class="alert alert-warning py-2 px-3 small text-start mb-2.5 w-100" style="font-size: 11px;">
                        <ol class="mb-0 ps-3">
                            <li>Minta pasien membuka aplikasi <strong>SATUSEHAT Mobile</strong> di ponselnya.</li>
                            <li>Scan QR Code di atas atau buka tautan verifikasi.</li>
                            <li>Klik <strong>Setujui</strong> pada layar ponsel pasien.</li>
                        </ol>
                    </div>

                    <div class="d-flex gap-2 justify-content-center w-100">
                        <a id="ssrme_verify_link" href="#" target="_blank" class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-1.5" style="font-size: 12px;">
                            <i class="bi bi-link-45deg me-1"></i>Link Manual
                        </a>
                        <button type="button" class="btn btn-sm btn-success rounded-pill px-4 py-1.5 fw-semibold" onclick="retryOpenSatuSehatRme()" style="background-color: #00877a; border-color: #00877a; font-size: 12px;">
                            <i class="bi bi-check-circle me-1"></i>Pasien Sudah Setuju, Buka RME
                        </button>
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
                    $('#ssrme_verify_link').attr('href', res.verification_url || '#');

                    // Generate QR Code
                    const qrContainer = document.getElementById('ssrme_qrcode');
                    qrContainer.innerHTML = '';
                    if (res.verification_url && typeof QRCode !== 'undefined') {
                        ssrmeQrInstance = new QRCode(qrContainer, {
                            text: res.verification_url,
                            width: 160,
                            height: 160,
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
