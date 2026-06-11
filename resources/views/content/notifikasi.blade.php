@inject('notification', 'App\Services\NotificationService')

@include('content.ranap.modal.modal_tabel_hasil_kritis')
@include('content.lab.modal_hasil_permintaan_lab')

<div class="position-fixed top-0 end-0 pt-3 pe-3 pb-3"
    style="z-index: 1080; margin-top: 50px; max-width: 420px; width: 100%;">

    {{-- 1. Alert SBAR --}}
    @if($notification->getSbarCount() > 0)
        <div id="alertSbar"
            class="alert alert-warning alert-dismissible fade show shadow-sm border-start border-warning border-3 p-2 mb-2 w-100"
            role="alert"
            style="background-color: rgba(255, 243, 205, 0.85) !important; backdrop-filter: blur(6px); -webkit-backdrop-filter: blur(6px); font-size: 0.85rem;">

            <div class="d-flex align-items-center justify-content-between pe-4">
                <div class="d-flex align-items-center me-2">
                    <i class="bi bi-bell-fill text-warning me-2 fs-6"></i>
                    <div>
                        <span class="fw-bold">SBAR Baru!</span> Silahkan cek segera.
                    </div>
                </div>

                <div>
                    <a href="{{ route('ranap.pemeriksaan-ranap.index', ['pemeriksaan' => 'sbar', 'dokter' => session()->get('pegawai')->nik]) }}"
                        class="btn btn-xs btn-warning fw-bold px-2 py-05 text-dark text-nowrap position-relative"
                        style="font-size: 0.75rem; padding-top: 2px; padding-bottom: 2px;">
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            <span id="textCountSbar">{{ $notification->getSbarCount() }}</span>
                        </span>
                        Cek
                    </a>
                </div>
            </div>
            <button type="button" class="btn-close p-2" data-bs-dismiss="alert" aria-label="Close"
                style="font-size: 0.65rem; top: 7px;"></button>
        </div>
    @endif

    {{-- 2. Alert Hasil Kritis --}}
    @if($notification->getHasilKritisCount() > 0)
        <div id="alertHasilKritis"
            class="alert alert-danger alert-dismissible fade show shadow-sm border-start border-danger border-2 p-2 mb-2 w-100"
            role="alert"
            style="background-color: rgba(255, 205, 210, 0.75) !important; backdrop-filter: blur(6px); -webkit-backdrop-filter: blur(6px); font-size: 0.85rem;">

            <div class="d-flex align-items-center justify-content-between pe-4">
                <div class="d-flex align-items-center me-2">
                    <i class="bi bi-exclamation-triangle-fill text-danger me-2 fs-6"></i>
                    <div>
                        <span class="fw-bold">Hasil Kritis!</span> Silahkan cek segera.
                    </div>
                </div>

                <div>
                    <button class="btn btn-sm btn-danger fw-bold px-2 py-05 text-white text-nowrap position-relative"
                        onclick="showTabelHasilKritis()">
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            <span id="textCountHasilKritis">{{ $notification->getHasilKritisCount() }}</span>
                        </span>
                        Cek
                    </button>
                </div>
            </div>
            <button type="button" class="btn-close p-2" data-bs-dismiss="alert" aria-label="Close"
                style="font-size: 0.65rem; top: 7px;"></button>
        </div>
    @endif

    {{-- 3. Alert Hasil Lab Baru --}}
    {{-- @if($notification->getPermintaanLabDoesntHaveSaran() > 0)
    <div id="alertPermintaanLab"
        class="alert alert-info alert-dismissible fade show shadow-sm border-start border-info border-2 p-2 mb-2 w-100"
        role="alert"
        style="background-color: rgba(205, 249, 255, 0.75) !important; backdrop-filter: blur(6px); -webkit-backdrop-filter: blur(6px); font-size: 0.85rem;">

        <div class="d-flex align-items-center justify-content-between pe-4">
            <div class="d-flex align-items-center me-2">
                <i class="bi bi-info-circle-fill text-info me-2 fs-6"></i>
                <div class="text-dark">
                    <span class="fw-bold">Hasil Lab Baru!</span> Silahkan cek segera.
                </div>
            </div>

            <div>
                <button class="btn btn-sm btn-info fw-bold px-2 py-05 text-white text-nowrap position-relative"
                    onclick="showHasilPermintaanLab()">
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        <span id="textCountPermintaanLab">{{ $notification->getPermintaanLabDoesntHaveSaran() }}</span>
                    </span>
                    Cek
                </button>
            </div>
        </div>
        <button type="button" class="btn-close p-2" data-bs-dismiss="alert" aria-label="Close"
            style="font-size: 0.65rem; top: 7px;"></button>
    </div>
    @endif --}}

</div>