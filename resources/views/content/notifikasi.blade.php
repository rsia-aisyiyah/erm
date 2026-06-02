@inject('notification', 'App\Services\NotificationService')

@include('content.ranap.modal.modal_tabel_hasil_kritis')
<!-- FLOATING ALERT CONTAINER (Menampung semua notifikasi) -->
<div class="position-fixed top-0 end-0 p-3" style="z-index: 1080; margin-top: 50px; max-width: 360px; width: 100%;">

    @if($notification->getSbarCount() > 0)
        <div class="alert alert-warning alert-dismissible fade show shadow-sm border-start border-warning border-3 p-2 mb-1"
            role="alert"
            style="background-color: rgba(255, 243, 205, 0.85) !important; backdrop-filter: blur(6px); -webkit-backdrop-filter: blur(6px); font-size: 0.85rem; max-width: 360px;">

            <div class="d-flex align-items-center justify-content-between pe-4">
                <div class="d-flex align-items-center me-2">
                    <i class="bi bi-bell-fill text-warning me-2 fs-6"></i>
                    <div>
                        <span class="fw-bold">SBAR Baru!</span> Silahkan cek segera.
                    </div>
                </div>

                <div>
                    <a href="{{ route('ranap.pemeriksaan-ranap.index', ['pemeriksaan' => 'sbar', 'dokter' => session()->get('pegawai')->nik]) }}"
                        class="btn btn-xs btn-warning fw-bold px-2 py-05 text-dark text-nowrap"
                        style="font-size: 0.75rem; padding-top: 2px; padding-bottom: 2px;">
                        Cek
                    </a>
                </div>
            </div>

            <button type="button" class="btn-close p-2" data-bs-dismiss="alert" aria-label="Close"
                style="font-size: 0.65rem; top: 7px;"></button>
        </div>

    @endif()

    {{-- @dump($notification->getHasilKritisCount()) --}}
    @if($notification->getHasilKritisCount() > 0)
        <div class="alert alert-danger alert-dismissible fade show shadow-sm border-start border-danger border-2 p-2 mb-1"
            role="alert"
            style="background-color: rgba(255, 205, 210, 0.75) !important; backdrop-filter: blur(6px); -webkit-backdrop-filter: blur(6px); font-size: 0.85rem; max-width: 360px;">

            <div class="d-flex align-items-center justify-content-between pe-4">
                <div class="d-flex align-items-center me-2">
                    <i class="bi bi-exclamation-triangle-fill text-danger me-2 fs-6"></i>
                    <div>
                        <span class="fw-bold">Hasil Kritis!</span> Silahkan cek segera.
                    </div>
                </div>

                <div>
                    {{-- <a href="{{ route('hasil-kritis.petugas', ['nip' => session()->get('pegawai')->nik]) }}"
                        class="btn btn-xs btn-danger fw-bold px-2 py-05 text-white text-nowrap"
                        style="font-size: 0.75rem; padding-top: 2px; padding-bottom: 2px;">
                        Cek --}}
                        <button class="btn btn-sm btn-danger fw-bold px-2 py-05 text-white text-nowrap"
                            onclick="showTabelHasilKritis()">
                            Cek
                        </button>
                    </a>
                </div>
            </div>

            <button type="button" class="btn-close p-2" data-bs-dismiss="alert" aria-label="Close"
                style="font-size: 0.65rem; top: 7px;"></button>
        </div>
    @endif

    {{-- <!-- 2. NOTIFIKASI PEMERIKSAAN LAIN (Info/Biru atau Primary) -->
    <div class="alert alert-info alert-dismissible fade show shadow border-start border-info border-3 mb-2"
        role="alert">
        <div class="d-flex align-items-start">
            <div class="me-2 mt-1">
                <i class="bi bi-file-earmark-medical-fill fs-5 text-info"></i>
            </div>
            <div>
                <h6 class="alert-heading fw-bold mb-1">Konfirmasi Pemeriksaan</h6>
                <p class="small mb-2">Terdapat hasil laboratorium/radiologi baru yang perlu dikonfirmasi Dokter.</p>
                <a href="/pemeriksaan/konfirmasi" class="btn btn-sm btn-info text-white fw-bold px-3 py-1"
                    style="font-size: 0.75rem;">
                    <i class="bi bi-check-circle me-1"></i> Konfirmasi
                </a>
            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div> --}}

</div>