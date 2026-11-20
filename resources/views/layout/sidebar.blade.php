@php
    $pegawai = session()->get('pegawai');
    $nik = $pegawai->nik ?? '';
    $nama = $pegawai->nama ?? 'Pengguna';
    $jbtn = $pegawai->jbtn ?? ($pegawai->departemen ?? 'Staff');
    $dept = $pegawai->departemen ?? '';
    $isDokter = !empty($pegawai->dokter);
    $jnj = $pegawai->jnj_jabatan ?? '';

    // Ambil inisial nama untuk avatar
    $words = explode(' ', trim($nama));
    $initials = '';
    if (count($words) >= 2) {
        $initials = strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1));
    } else {
        $initials = strtoupper(substr($nama, 0, 2));
    }

    // Role check helper
    $isDireksiOrIt = ($nik === 'direksi' || $dept === 'DIR' || $jnj === 'DIRU' || $dept === 'IT' || $nik === '2.319.1017' || $nik === '2.424.0418' || $nik === '3.604.0123');

    // Ambil menu dinamis dari database rsia_erm_menu
    $groupedMenus = \App\Models\RsiaErmMenu::getMenusForUser($pegawai);
@endphp

<style>
    /* Styling Modern Scoped Sidebar ERM */
    #sidebarMenu {
        background-color: #ffffff !important;
        border-right: 1px solid #e2e8f0 !important;
        box-shadow: 2px 0 12px rgba(0, 0, 0, 0.03) !important;
        padding-top: 50px !important;
        height: 100vh !important;
        max-height: 100vh !important;
        display: flex !important;
        flex-direction: column !important;
        overflow: hidden !important;
        z-index: 1000 !important;
    }

    .sidebar-scroll-wrapper {
        flex: 1 1 0px !important;
        min-height: 0 !important;
        overflow-y: auto !important;
        overflow-x: hidden !important;
        overscroll-behavior: contain;
        -webkit-overflow-scrolling: touch;
        padding: 10px 10px 16px 10px;
    }

    /* Custom Ultra-Slim Scrollbar */
    .sidebar-scroll-wrapper::-webkit-scrollbar {
        width: 5px;
    }
    .sidebar-scroll-wrapper::-webkit-scrollbar-track {
        background: transparent;
    }
    .sidebar-scroll-wrapper::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 4px;
    }
    .sidebar-scroll-wrapper::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }

    /* Kategori Header */
    .sidebar-cat-title {
        font-size: 10.5px;
        font-weight: 700;
        letter-spacing: 0.8px;
        text-transform: uppercase;
        color: #94a3b8;
        padding: 10px 10px 4px 10px;
        margin-top: 6px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        white-space: nowrap;
    }

    /* Menu Link Card */
    .erm-nav-link {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 6px 10px;
        margin-bottom: 2px;
        border-radius: 8px;
        color: #334155 !important;
        font-size: 12.5px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.16s ease;
        position: relative;
        white-space: nowrap;
    }

    .erm-nav-link:hover {
        background-color: #f1f5f9;
        color: #0f172a !important;
        transform: translateX(3px);
    }

    /* Active Link State */
    .erm-nav-link.active {
        background-color: #e2e8f0;
        color: #0f172a !important;
        font-weight: 600;
        box-shadow: inset 3px 0 0 #0d6efd;
    }

    /* Icon Box Mini Pastel Medis */
    .erm-icon-box {
        width: 28px;
        height: 28px;
        border-radius: 7px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        flex-shrink: 0;
        transition: all 0.16s ease;
    }

    /* Palet Warna Khas Per Modul */
    .icon-poli { background-color: #ccfbf1; color: #0f766e; }
    .icon-ranap { background-color: #e0e7ff; color: #4338ca; }
    .icon-ugd { background-color: #ffedd5; color: #c2410c; }
    .icon-ok { background-color: #ffe4e6; color: #e11d48; }
    .icon-lab { background-color: #f3e8ff; color: #7e22ce; }
    .icon-rad { background-color: #e0f2fe; color: #0369a1; }
    .icon-resep { background-color: #dbeafe; color: #1d4ed8; }
    .icon-obat { background-color: #f1f5f9; color: #475569; }
    .icon-racik { background-color: #fef9c3; color: #854d0e; }
    .icon-pasien { background-color: #f1f5f9; color: #334155; }
    .icon-daftar { background-color: #f1f5f9; color: #475569; }
    .icon-sep { background-color: #ecfdf5; color: #047857; }
    .icon-kyc { background-color: #fef3c7; color: #b45309; }
    .icon-log { background-color: #f1f5f9; color: #64748b; }
    .icon-menu-manage { background-color: #fce7f3; color: #be185d; }

    /* Profil User Card di Footer Sidebar */
    .sidebar-user-footer {
        flex-shrink: 0 !important;
        padding: 10px 10px;
        border-top: 1px solid #e2e8f0;
        background-color: #ffffff;
    }
    .user-profile-card {
        background-color: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 7px 9px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
    }
    .user-avatar-circle {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: linear-gradient(135deg, #0d6efd, #0dcaf0);
        color: #ffffff;
        font-weight: 700;
        font-size: 11px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .user-text-info {
        min-width: 0;
        flex: 1 1 auto;
    }
    .user-name-title {
        font-size: 12px;
        font-weight: 700;
        color: #1e293b;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        line-height: 1.25;
    }
    .user-role-subtitle {
        font-size: 10.5px;
        color: #64748b;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .btn-user-logout {
        width: 26px;
        height: 26px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #dc2626;
        background-color: #fee2e2;
        text-decoration: none;
        flex-shrink: 0;
        transition: all 0.15s ease;
    }
    .btn-user-logout:hover {
        background-color: #dc2626;
        color: #ffffff;
    }
</style>

<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse">
    <div class="sidebar-scroll-wrapper">
        <ul class="nav flex-column mb-0">

            @if ($groupedMenus->isNotEmpty())
                {{-- ======================================================== --}}
                {{-- 1. MODE DINAMIS (BERBASIS DATABASE rsia_erm_menu)       --}}
                {{-- ======================================================== --}}
                @foreach ($groupedMenus as $kategori => $menus)
                    <div class="sidebar-cat-title {{ !$loop->first ? 'mt-2' : '' }}">
                        <span>{{ $kategori }}</span>
                    </div>
                    @foreach ($menus as $m)
                        @php
                            $targetUrl = $m->url;
                            if ($targetUrl === 'KYC_DYNAMIC') {
                                $targetUrl = config('app.kyc') . '?nama=' . urlencode($nama) . '&nik=' . urlencode($nik);
                            }
                            $urlPath = parse_url($m->url, PHP_URL_PATH) ?? '';
                            $cleanPath = ltrim($urlPath, '/');
                            $cleanPath = preg_replace('/^erm\//', '', $cleanPath);
                            $isActive = !empty($cleanPath) && (Request::is($cleanPath . '*') || Request::is('erm/' . $cleanPath . '*'));
                        @endphp
                        <li class="nav-item">
                            <a class="erm-nav-link {{ $isActive ? 'active' : '' }}" 
                               href="{{ $targetUrl }}" 
                               target="{{ $m->target }}" 
                               title="{{ $m->title ?: $m->nama_menu }}">
                                <span class="erm-icon-box {{ $m->icon_bg }}"><i class="bi {{ $m->icon }}"></i></span>
                                <span>{{ $m->nama_menu }}</span>
                            </a>
                        </li>
                    @endforeach
                @endforeach
            @else
                {{-- ======================================================== --}}
                {{-- 2. MODE FALLBACK HARDCODED                               --}}
                {{-- ======================================================== --}}

                <!-- 1. KELOMPOK PELAYANAN PASIEN (CORE KLINIS DOKTER) -->
                <div class="sidebar-cat-title">
                    <span>Pelayanan Pasien</span>
                </div>

                <!-- Poliklinik (Rawat Jalan) -->
                @if (
                    (($isDireksiOrIt ||
                        $dept == 'DPM1' ||
                        $dept == 'DPM2' ||
                        $dept == 'DM6' ||
                        $dept == 'CSM' ||
                        $dept == 'SPS' ||
                        $dept == 'DM7' ||
                        $nik == '' ||
                        $isDokter) &&
                        ($pegawai->jbtn ?? '') != 'Dokter Spesialis Radiologi'))
                    <li class="nav-item">
                        <a class="erm-nav-link {{ Request::is('poliklinik*') ? 'active' : '' }}" href="/erm/poliklinik" title="Pelayanan Pasien Poliklinik (Rawat Jalan)">
                            <span class="erm-icon-box icon-poli"><i class="bi bi-bandaid"></i></span>
                            <span>Poliklinik</span>
                        </a>
                    </li>
                @endif

                <!-- Rawat Inap (Bangsal) -->
                @if (
                    $isDireksiOrIt ||
                        $dept == 'DM3' ||
                        $dept == 'DM7' ||
                        $dept == 'SPS' ||
                        $dept == 'DPM1' ||
                        $dept == 'DNM5' ||
                        $dept == 'DM4' ||
                        $dept == 'DM5' ||
                        $dept == 'DM2' ||
                        $dept == 'DPM2' ||
                        $dept == 'DM1' ||
                        $dept == 'CSM' ||
                        $dept == 'ICU' ||
                        $isDokter)
                    <li class="nav-item">
                        <a class="erm-nav-link {{ Request::is('ranap*') ? 'active' : '' }}" href="/erm/ranap" title="Pelayanan Pasien Rawat Inap & E-MAR">
                            <span class="erm-icon-box icon-ranap"><i class="bi bi-hospital"></i></span>
                            <span>Rawat Inap</span>
                        </a>
                    </li>
                @endif

                <!-- UGD (Gawat Darurat) -->
                @if (
                    $isDireksiOrIt ||
                        $dept == 'DM1' ||
                        $dept == 'CSM' ||
                        $dept == 'DM7' ||
                        $dept == 'SPS' ||
                        $dept == 'DPM2' ||
                        $isDokter)
                    <li class="nav-item">
                        <a class="erm-nav-link {{ Request::is('ugd*') ? 'active' : '' }}" href="/erm/ugd" title="Instalasi Gawat Darurat (UGD)">
                            <span class="erm-icon-box icon-ugd"><i class="bi bi-clipboard2-pulse"></i></span>
                            <span>UGD</span>
                        </a>
                    </li>
                @endif

                <!-- Kamar Operasi (IBS) -->
                @if (
                    $isDireksiOrIt ||
                        $dept == 'DM1' ||
                        $dept == 'DM2' ||
                        $dept == 'DM3' ||
                        $dept == 'DM4' ||
                        $dept == 'DM5' ||
                        $dept == 'DM7' ||
                        $dept == 'SPS' ||
                        $dept == 'DPM1' ||
                        $dept == 'DPM2' ||
                        $dept == 'OK' ||
                        $dept == 'IBS' ||
                        $dept == 'CSM' ||
                        $dept == 'ICU' ||
                        $isDokter)
                    <li class="nav-item">
                        <a class="erm-nav-link {{ Request::is('operasi*') ? 'active' : '' }}" href="/erm/operasi" title="Kamar Operasi (IBS) & Laporan Operasi">
                            <span class="erm-icon-box icon-ok"><i class="bi bi-heart-pulse-fill"></i></span>
                            <span>Kamar Operasi</span>
                        </a>
                    </li>
                @endif


                <!-- 2. KELOMPOK PENUNJANG & FARMASI -->
                <div class="sidebar-cat-title mt-2">
                    <span>Penunjang &amp; Resep</span>
                </div>

                <!-- Laborat -->
                <li class="nav-item">
                    <a class="erm-nav-link {{ Request::is('lab*') ? 'active' : '' }}" href="{{ url('/lab') }}" title="Pelayanan & Hasil Pemeriksaan Laboratorium">
                        <span class="erm-icon-box icon-lab"><i class="bi bi-prescription2"></i></span>
                        <span>Laborat</span>
                    </a>
                </li>

                <!-- Radiologi -->
                @if (
                    $isDireksiOrIt ||
                        ($pegawai->jbtn ?? '') == 'Dokter Spesialis Radiologi' ||
                        $dept == 'RAD' ||
                        $dept == 'CSM')
                    <li class="nav-item">
                        <a class="erm-nav-link {{ Request::is('radiologi*') ? 'active' : '' }}" href="/erm/radiologi" title="Pelayanan & Hasil Radiologi">
                            <span class="erm-icon-box icon-rad"><i class="bi bi-radioactive"></i></span>
                            <span>Radiologi</span>
                        </a>
                    </li>
                @endif

                <!-- Resep Dokter / Farmasi -->
                @if ($isDireksiOrIt || $dept == 'DPM1')
                    <li class="nav-item">
                        <a class="erm-nav-link {{ Request::is('resep') ? 'active' : '' }}" href="/erm/resep" title="Daftar Resep Obat Dokter">
                            <span class="erm-icon-box icon-resep"><i class="bi bi-prescription"></i></span>
                            <span>Resep</span>
                        </a>
                    </li>
                @endif

                <!-- Obat & BHP -->
                @if (
                    (($isDireksiOrIt ||
                        $dept == 'DPM1' ||
                        $dept == 'DPM2' ||
                        $dept == 'DM6' ||
                        $dept == 'CSM' ||
                        $dept == 'SPS' ||
                        $dept == 'DM7' ||
                        $nik == '' ||
                        $isDokter) &&
                        ($pegawai->jbtn ?? '') != 'Dokter Spesialis Radiologi'))
                    <li class="nav-item">
                        <a class="erm-nav-link {{ Request::is('obat*') ? 'active' : '' }}" href="/erm/obat" title="Master Data Obat & Bahan Medis Habis Pakai">
                            <span class="erm-icon-box icon-obat"><i class="bi bi-capsule-pill"></i></span>
                            <span>Obat &amp; BHP</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="erm-nav-link {{ Request::is('resep/racik*') || Request::is('racikan*') ? 'active' : '' }}" href="/erm/resep/racik" title="Template Racikan Obat Dokter">
                            <span class="erm-icon-box icon-racik"><i class="bi bi-mortarboard"></i></span>
                            <span>Template Racik</span>
                        </a>
                    </li>
                @endif


                <!-- 3. KELOMPOK REGISTRASI & PASIEN -->
                <div class="sidebar-cat-title mt-2">
                    <span>Data Pasien &amp; Reg</span>
                </div>

                <!-- Pasien -->
                @if ($isDireksiOrIt || $dept == 'DPM2' || $dept == 'CSM' || $dept == 'DNM2' || $nik == '2.326.0418')
                    <li class="nav-item">
                        <a class="erm-nav-link {{ Request::is('pasien*') ? 'active' : '' }}" href="/erm/pasien" title="Master Data Pasien & Riwayat RM">
                            <span class="erm-icon-box icon-pasien"><i class="bi bi-people"></i></span>
                            <span>Data Pasien</span>
                        </a>
                    </li>
                @endif

                <!-- Pendaftaran -->
                @if ($isDireksiOrIt || $dept == 'DNM6')
                    <li class="nav-item">
                        <a class="erm-nav-link {{ Request::is('registrasi*') ? 'active' : '' }}" href="/erm/registrasi" title="Pendaftaran Pasien Baru / Lama">
                            <span class="erm-icon-box icon-daftar"><i class="bi bi-pen"></i></span>
                            <span>Pendaftaran</span>
                        </a>
                    </li>
                @endif

                <!-- SEP Terbit -->
                @if ($isDireksiOrIt || $dept == 'DNM6' || $dept == 'DM6')
                    <li class="nav-item">
                        <a class="erm-nav-link {{ Request::is('sep*') ? 'active' : '' }}" href="/erm/sep" title="Monitoring Surat Eligibilitas Peserta (SEP BPJS)">
                            <span class="erm-icon-box icon-sep"><i class="bi bi-link-45deg"></i></span>
                            <span>SEP Terbit</span>
                        </a>
                    </li>
                @endif


                <!-- 4. KELOMPOK SISTEM & UTILITY -->
                <div class="sidebar-cat-title mt-2">
                    <span>Sistem</span>
                </div>

                <!-- KYC -->
                <li class="nav-item">
                    <a class="erm-nav-link" target="_blank" href="{{ config('app.kyc') }}?nama={{ urlencode($nama) }}&nik={{ urlencode($nik) }}" title="Verifikasi SatuSehat KYC Kemenkes">
                        <span class="erm-icon-box icon-kyc"><i class="bi bi-key"></i></span>
                        <span>KYC SatuSehat</span>
                    </a>
                </li>

                <!-- Log Aktivitas -->
                @if ($nik === 'direksi' || $dept === 'IT')
                    <li class="nav-item">
                        <a class="erm-nav-link" target="_blank" href="/erm/logs" title="System Application Logs">
                            <span class="erm-icon-box icon-log"><i class="bi bi-journal-code"></i></span>
                            <span>App Logs</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="erm-nav-link {{ Request::is('pengaturan/menu*') ? 'active' : '' }}" href="/erm/pengaturan/menu" title="Manajemen Menu & Hak Akses">
                            <span class="erm-icon-box icon-menu-manage"><i class="bi bi-sliders"></i></span>
                            <span>Manajemen Menu</span>
                        </a>
                    </li>
                @endif
            @endif

        </ul>
    </div>

    <!-- 5. KARTU USER / DOKTER DI BAGIAN PALING BAWAH -->
    <div class="sidebar-user-footer">
        <div class="user-profile-card">
            <div class="user-avatar-circle" title="{{ $nama }}">
                {{ $initials }}
            </div>
            <div class="user-text-info">
                <div class="user-name-title" title="{{ $nama }}">{{ $nama }}</div>
                <div class="user-role-subtitle" title="{{ $jbtn }}">{{ $isDokter ? 'DPJP / Dokter' : $jbtn }}</div>
            </div>
            <a href="/erm/logout" class="btn-user-logout" title="Keluar dari Sistem (Logout)">
                <i class="bi bi-box-arrow-right"></i>
            </a>
        </div>
    </div>
</nav>
