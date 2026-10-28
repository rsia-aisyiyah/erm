{{-- Komponen Notifikasi Respon Farmasi ke Ranap/Orderer (Non-Intrusive) --}}
<div class="dropdown me-1 position-relative" id="dropdownResponFarmasi">
    <button class="btn btn-dark position-relative border-0 py-1.5 px-2.5 rounded-3 d-flex align-items-center gap-1.5"
        type="button" 
        id="btnDropdownNotifFarmasi" 
        data-bs-toggle="dropdown" 
        data-bs-display="static"
        aria-expanded="false" 
        title="Respon & Validasi Permintaan Farmasi"
        style="background: rgba(255, 255, 255, 0.08); transition: all 0.2s;">
        <i class="bi bi-bell-fill fs-5 text-light" id="iconBellFarmasi"></i>
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger border border-light" 
            id="badgeNotifCount" 
            style="display:none; font-size: 10px; padding: 3px 6px;">
            0
        </span>
    </button>

    <div class="dropdown-menu dropdown-menu-end shadow-lg border-0 p-0" 
        aria-labelledby="btnDropdownNotifFarmasi" 
        id="menuResponFarmasi">
        
        {{-- Header Dropdown --}}
        <div class="d-flex align-items-center justify-content-between border-bottom bg-light px-3.5 py-3" style="padding: 14px 18px;">
            <div class="d-flex align-items-center gap-2.5">
                <span class="d-inline-flex align-items-center justify-content-center bg-primary-subtle text-primary rounded-circle shadow-xs" style="width: 34px; height: 34px; min-width: 34px;">
                    <i class="bi bi-capsule-pill fs-6"></i>
                </span>
                <div>
                    <h6 class="mb-0 fw-bold text-dark" style="font-size: 13.5px;">Respon Farmasi</h6>
                    <small class="text-muted" style="font-size: 11px;">Update validasi resep & retur</small>
                </div>
            </div>
            <div class="d-flex align-items-center gap-2">
                <button type="button" class="btn btn-sm btn-outline-secondary py-1 px-2 rounded-pill d-inline-flex align-items-center" id="btnToggleSoundRanap" title="Toggle Bunyi Notifikasi" style="font-size: 11px; height: 26px;">
                    <i class="bi bi-volume-up-fill" id="iconSoundRanap"></i>
                </button>
                <button type="button" class="btn btn-sm btn-light border py-1 px-2.5 rounded-pill text-dark fw-medium" onclick="tandaiSemuaResponDibaca()" title="Tandai semua telah dibaca" style="font-size: 11px; height: 26px;">
                    <i class="bi bi-check2-all me-1"></i> Baca
                </button>
            </div>
        </div>

        {{-- List Notifikasi --}}
        <div id="listNotifResponFarmasi" style="max-height: 420px; overflow-y: auto;">
            <div class="text-center py-4 text-muted" id="emptyNotifFarmasi" style="padding: 30px 20px;">
                <i class="bi bi-bell-slash fs-3 d-block text-secondary mb-1 opacity-50"></i>
                <small style="font-size: 12px;">Belum ada respon farmasi baru hari ini</small>
            </div>
        </div>

        {{-- Footer --}}
        <div class="px-3.5 py-2.5 border-top bg-light text-center" style="padding: 10px 18px;">
            <small class="text-muted" style="font-size: 11px;">
                <i class="bi bi-shield-check text-success me-1"></i> Mode senyap aktif saat Anda sedang mengetik ERM
            </small>
        </div>
    </div>
</div>

{{-- Container Floating Toast (Non-Intrusive, Pojok Bawah) --}}
<div id="toastResponFarmasiContainer" class="position-fixed bottom-0 end-0 p-3" style="z-index: 1090; pointer-events: none; max-width: 380px; width: 100%;">
    {{-- Toast items akan di-append ke sini secara dinamis --}}
</div>

{{-- Direct Style Tag (Agar pasti aktif dan tidak terlewatkan oleh render Blade) --}}
<style>
    #dropdownResponFarmasi {
        position: relative !important;
    }
    #dropdownResponFarmasi #menuResponFarmasi {
        position: absolute !important;
        right: 0 !important;
        left: auto !important;
        top: calc(100% + 10px) !important;
        margin-top: 0 !important;
        width: 410px !important;
        max-width: calc(100vw - 32px) !important;
        border-radius: 14px !important;
        overflow: hidden !important;
        z-index: 1080 !important;
        box-shadow: 0 16px 40px rgba(0, 0, 0, 0.2), 0 2px 8px rgba(0, 0, 0, 0.08) !important;
        border: 1px solid rgba(0, 0, 0, 0.1) !important;
        background: #ffffff !important;
    }
    .notif-item {
        padding: 14px 18px !important;
        transition: background-color 0.15s ease-in-out;
        cursor: pointer;
        border-bottom: 1px solid #f1f3f5;
        display: block !important;
        background-color: #ffffff;
    }
    .notif-item:hover {
        background-color: #f8faff !important;
    }
    .notif-item.unread {
        background-color: #f2f7ff !important;
        border-left: 4px solid #0d6efd !important;
    }
    .notif-icon-circle {
        width: 36px !important;
        height: 36px !important;
        min-width: 36px !important;
        border-radius: 10px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        flex-shrink: 0 !important;
    }
    .toast-farmasi-card {
        pointer-events: auto;
        background: #ffffff !important;
        border-radius: 12px !important;
        box-shadow: 0 10px 25px -4px rgba(0, 0, 0, 0.14), 0 4px 10px -2px rgba(0, 0, 0, 0.06) !important;
        border: 1px solid rgba(0, 0, 0, 0.08) !important;
        margin-top: 10px;
        transform: translateY(20px);
        opacity: 0;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .toast-farmasi-card.show-card {
        transform: translateY(0);
        opacity: 1;
    }
    .bell-ring-anim {
        animation: bellRing 1.5s infinite;
    }
    @keyframes bellRing {
        0%, 100% { transform: rotate(0); }
        20%, 60% { transform: rotate(15deg); }
        40%, 80% { transform: rotate(-15deg); }
    }
</style>

@push('script')
<script>
    // Audio Notifikasi Chime Lembut (Nada Crystal)
    const sndResponFarmasi = new Audio("{{ asset('sound/nada-crystal.wav') }}");
    sndResponFarmasi.volume = 0.5;

    // State & Cache
    let listResponFarmasi = [];
    let isDokterRole = {{ session('role') === 'dokter' ? 'true' : 'false' }};

    // Suara: Dokter default mati (0), perawat default aktif (1)
    if (localStorage.getItem('sound_respon_farmasi') === null) {
        localStorage.setItem('sound_respon_farmasi', isDokterRole ? '0' : '1');
    }

    function updateSoundUI() {
        const isSoundOn = localStorage.getItem('sound_respon_farmasi') === '1';
        if (isSoundOn) {
            $('#iconSoundRanap').removeClass('bi-volume-mute-fill text-muted').addClass('bi-volume-up-fill text-success');
            $('#btnToggleSoundRanap').attr('title', 'Bunyi Suara: AKTIF (Klik untuk membisukan)');
        } else {
            $('#iconSoundRanap').removeClass('bi-volume-up-fill text-success').addClass('bi-volume-mute-fill text-muted');
            $('#btnToggleSoundRanap').attr('title', 'Bunyi Suara: BISU (Klik untuk mengaktifkan)');
        }
    }

    // Toggle Sound Button
    $('#btnToggleSoundRanap').on('click', function(e) {
        e.stopPropagation();
        const current = localStorage.getItem('sound_respon_farmasi') === '1';
        localStorage.setItem('sound_respon_farmasi', current ? '0' : '1');
        updateSoundUI();
    });

    // Deteksi apakah pengguna sedang fokus mengetik atau membuka modal ERM
    function isUserBusyFillingERM() {
        // 1. Cek apakah kursor aktif pada input/textarea
        const active = document.activeElement;
        if (active && (
            active.tagName === 'TEXTAREA' || 
            (active.tagName === 'INPUT' && ['text', 'search', 'number', 'email'].includes(active.type)) || 
            active.isContentEditable
        )) {
            return true;
        }

        // 2. Cek apakah ada modal SOAP/Asmed/Tindakan yang sedang terbuka
        const $openModals = $('.modal.show');
        if ($openModals.length > 0) {
            return true;
        }

        return false;
    }

    // Ambil ID yang sudah pernah ditandai dibaca dari LocalStorage
    function getReadNotifIds() {
        try {
            return JSON.parse(localStorage.getItem('read_respon_farmasi_ids') || '[]');
        } catch (e) {
            return [];
        }
    }

    function saveReadNotifId(id) {
        const readIds = getReadNotifIds();
        if (!readIds.includes(id)) {
            readIds.push(id);
            if (readIds.length > 100) readIds.shift();
            localStorage.setItem('read_respon_farmasi_ids', JSON.stringify(readIds));
        }
    }

    function tandaiSemuaResponDibaca() {
        const allIds = listResponFarmasi.map(item => item.id);
        localStorage.setItem('read_respon_farmasi_ids', JSON.stringify(allIds));
        renderListResponFarmasi();
    }

    // Render Dropdown List
    function renderListResponFarmasi() {
        const $list = $('#listNotifResponFarmasi');
        const readIds = getReadNotifIds();

        let unreadCount = 0;
        $list.empty();

        if (listResponFarmasi.length === 0) {
            $list.html(`
                <div class="text-center py-4 text-muted" style="padding: 30px 20px;">
                    <i class="bi bi-bell-slash fs-3 d-block text-secondary mb-1 opacity-50"></i>
                    <small style="font-size: 12px;">Belum ada respon farmasi baru hari ini</small>
                </div>
            `);
            $('#badgeNotifCount').hide();
            $('#iconBellFarmasi').removeClass('bell-ring-anim text-warning').addClass('text-light');
            return;
        }

        listResponFarmasi.forEach(item => {
            const isRead = readIds.includes(item.id);
            if (!isRead) unreadCount++;

            const badgeClass = item.tipe_badge === 'success' 
                ? 'bg-success-subtle text-success border border-success' 
                : (item.tipe_badge === 'danger' 
                    ? 'bg-danger-subtle text-danger border border-danger' 
                    : 'bg-primary-subtle text-primary border border-primary');

            const iconBg = item.tipe_badge === 'success'
                ? 'bg-success-subtle'
                : (item.tipe_badge === 'danger' ? 'bg-danger-subtle' : 'bg-primary-subtle');

            const itemHtml = `
                <div class="notif-item ${!isRead ? 'unread' : ''}" style="padding: 14px 18px !important;" onclick="onClickNotifItem('${item.id}', '${item.url_cetak || ''}')">
                    <div class="d-flex align-items-start" style="gap: 14px;">
                        <div class="notif-icon-circle ${iconBg}" style="width: 36px; height: 36px; min-width: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="bi ${item.icon} fs-5"></i>
                        </div>
                        <div class="flex-grow-1" style="min-width: 0;">
                            <div class="d-flex align-items-center justify-content-between mb-1">
                                <span class="fw-bold text-dark text-truncate pe-2" style="font-size: 13px;">${item.judul}</span>
                                <span class="badge ${badgeClass} px-2 py-0.5 rounded-pill flex-shrink-0" style="font-size: 10px;">${item.status}</span>
                            </div>
                            <div class="text-truncate text-secondary mb-1" style="font-size: 12px;">
                                <strong>${item.nm_pasien}</strong> <span class="text-muted">(${item.kamar})</span>
                            </div>
                            <p class="mb-1 text-muted text-truncate-2" style="font-size: 11.5px; line-height: 1.4;">
                                ${item.catatan}
                            </p>
                            <div class="d-flex align-items-center justify-content-between text-muted mt-2" style="font-size: 11px;">
                                <span><i class="bi bi-person-check me-1"></i>${item.petugas_farmasi}</span>
                                <span>${item.waktu_human}</span>
                            </div>
                            ${item.url_cetak ? `
                                <div class="mt-2 text-end">
                                    <a href="${item.url_cetak}" target="_blank" class="btn btn-xs btn-outline-success py-1 px-3 rounded-pill fw-medium" style="font-size: 11px;" onclick="event.stopPropagation(); saveReadNotifId('${item.id}'); renderListResponFarmasi();">
                                        <i class="bi bi-printer me-1"></i> Cetak Bukti
                                    </a>
                                </div>
                            ` : ''}
                        </div>
                    </div>
                </div>
            `;
            $list.append(itemHtml);
        });

        // Update Badge Count
        if (unreadCount > 0) {
            $('#badgeNotifCount').text(unreadCount > 99 ? '99+' : unreadCount).show();
            $('#iconBellFarmasi').addClass('bell-ring-anim text-warning').removeClass('text-light');
        } else {
            $('#badgeNotifCount').hide();
            $('#iconBellFarmasi').removeClass('bell-ring-anim text-warning').addClass('text-light');
        }
    }

    function onClickNotifItem(id, urlCetak) {
        saveReadNotifId(id);
        renderListResponFarmasi();
        if (urlCetak) {
            window.open(urlCetak, '_blank');
        }
    }

    // Tampilkan Floating Toast Lembut
    function triggerFloatingToast(item) {
        const toastId = 'toast_card_' + Math.random().toString(36).substring(2, 9);
        const borderClass = item.tipe_badge === 'success' 
            ? 'border-success' 
            : (item.tipe_badge === 'danger' ? 'border-danger' : 'border-primary');

        const badgeClass = item.tipe_badge === 'success' 
            ? 'bg-success-subtle text-success border border-success-subtle' 
            : (item.tipe_badge === 'danger' 
                ? 'bg-danger-subtle text-danger border border-danger-subtle' 
                : 'bg-primary-subtle text-primary border border-primary-subtle');

        const iconBg = item.tipe_badge === 'success'
            ? 'bg-success-subtle'
            : (item.tipe_badge === 'danger' ? 'bg-danger-subtle' : 'bg-primary-subtle');

        const toastHtml = `
            <div id="${toastId}" class="toast-farmasi-card p-3 border-start border-4 ${borderClass}">
                <div class="d-flex align-items-start justify-content-between mb-2">
                    <div class="d-flex align-items-center" style="gap: 10px;">
                        <div class="notif-icon-circle ${iconBg}" style="width: 34px; height: 34px; min-width: 34px; border-radius: 9px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="bi ${item.icon} fs-5"></i>
                        </div>
                        <div>
                            <strong class="text-dark d-block" style="font-size: 13px; font-weight: 600; line-height: 1.25;">${item.judul}</strong>
                            <small class="text-muted font-monospace" style="font-size: 10.5px;">${item.no_referensi}</small>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge ${badgeClass} rounded-pill" style="font-size: 10px; font-weight: 500;">${item.status}</span>
                        <button type="button" class="btn-close" style="font-size: 9px;" onclick="$('#${toastId}').remove()"></button>
                    </div>
                </div>
                <div class="pt-2 border-top" style="border-color: #f1f5f9 !important;">
                    <div class="text-dark" style="font-size: 12px; line-height: 1.4;">
                        <span class="text-secondary" style="font-size: 11px;">Pasien:</span> <strong class="text-dark">${item.nm_pasien}</strong>
                    </div>
                    <div class="mt-0.5" style="font-size: 11.5px;">
                        <span class="text-secondary" style="font-size: 11px;">Ruang/Kamar:</span> <span class="badge bg-light text-dark border px-1.5 py-0.5 rounded" style="font-weight: 500;">${item.kamar}</span>
                    </div>
                    <div class="mt-1.5 text-secondary" style="font-size: 11.5px; line-height: 1.4;">
                        ${item.catatan}
                    </div>
                </div>
                ${item.url_cetak ? `
                    <div class="mt-2 pt-2 border-top d-flex justify-content-end" style="border-color: #f1f5f9 !important;">
                        <a href="${item.url_cetak}" target="_blank" class="btn btn-xs btn-outline-success py-1 px-2.5 rounded-pill fw-medium d-inline-flex align-items-center gap-1" style="font-size: 11px;" onclick="$('#${toastId}').remove(); saveReadNotifId('${item.id}'); renderListResponFarmasi();">
                            <i class="bi bi-printer"></i> Cetak Slip
                        </a>
                    </div>
                ` : ''}
            </div>
        `;

        const $toast = $(toastHtml);
        $('#toastResponFarmasiContainer').append($toast);

        setTimeout(() => $toast.addClass('show-card'), 50);

        // Auto-dismiss setelah 6 detik
        setTimeout(() => {
            $toast.removeClass('show-card');
            setTimeout(() => $toast.remove(), 400);
        }, 6000);
    }

    // Polling Function
    let lastFetchedResponseIds = new Set();
    let isFirstPoll = true;

    function fetchResponFarmasi() {
        $.ajax({
            url: "{{ route('notifikasi.respon-farmasi') }}",
            type: "GET",
            dataType: "json",
            success: function(res) {
                if (res.status === 'success') {
                    listResponFarmasi = res.data || [];
                    isDokterRole = res.is_dokter;

                    const readIds = getReadNotifIds();
                    const newUnreadItems = [];

                    listResponFarmasi.forEach(item => {
                        if (!readIds.includes(item.id) && !lastFetchedResponseIds.has(item.id)) {
                            newUnreadItems.push(item);
                        }
                        lastFetchedResponseIds.add(item.id);
                    });

                    renderListResponFarmasi();

                    // Jika ada notifikasi baru masuk setelah page load awal:
                    if (!isFirstPoll && newUnreadItems.length > 0) {
                        const busyFillingERM = isUserBusyFillingERM();

                        // HANYA jika TIDAK sedang sibuk mengisi formulir ERM:
                        if (!busyFillingERM) {
                            triggerFloatingToast(newUnreadItems[0]);

                            const soundActive = localStorage.getItem('sound_respon_farmasi') === '1';
                            if (soundActive) {
                                sndResponFarmasi.play().catch(() => {});
                            }
                        }
                    }

                    isFirstPoll = false;
                }
            },
            error: function() {
                // Silently handle error on background poll
            }
        });
    }

    // Inisialisasi saat Document Ready
    $(document).ready(function() {
        updateSoundUI();
        fetchResponFarmasi();

        // Polling tiap 25 detik
        setInterval(fetchResponFarmasi, 25000);
    });
</script>
@endpush
