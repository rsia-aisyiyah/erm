{{-- @dd(auth()->user()->nama) --}}
<nav id="sidebarMenu" class="col-md-2 col-lg-1 d-md-block bg-light sidebar collapse">
    <div class="">
        <ul class="nav flex-column" style="font-size:12px">
            <h6
                class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
                <span>MENU</span>
            </h6>
            @if (session()->get('pegawai')->nik == 'direksi' || session()->get('pegawai')->departemen == 'DIR' || session()->get('pegawai')->departemen == 'DNM6')
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('registrasi') ? 'active' : '' }}" href="/erm/registrasi">
                        <i class="bi bi-pen  align-text-bottom"></i>
                        Pendaftaran
                    </a>
                </li>
            @endif
            </h6>
            @if (session()->get('pegawai')->nik == 'direksi' || session()->get('pegawai')->departemen == 'DIR' || session()->get('pegawai')->departemen == 'DNM6' || session()->get('pegawai')->departemen == 'DM6')
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('sep') ? 'active' : '' }}" href="/erm/sep">
                        <i class="bi bi-link align-text-bottom"></i>
                        SEP Terbit
                    </a>
                </li>
            @endif
            @if (session()->get('pegawai')->nik == 'direksi' || session()->get('pegawai')->departemen == 'DIR' || session()->get('pegawai')->departemen == 'DPM2' || session()->get('pegawai')->departemen == 'CSM' || session()->get('pegawai')->departemen == 'DNM2')
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('pasien') ? 'active' : '' }}" href="/erm/pasien">
                        <i class="bi bi-people-fill align-text-bottom"></i>
                        Pasien
                    </a>
                </li>
            @endif

            @if (
                (session()->get('pegawai')->nik == 'direksi' || session()->get('pegawai')->departemen == 'DIR' || session()->get('pegawai')->departemen == 'DPM1' || session()->get('pegawai')->departemen == 'DPM2' || session()->get('pegawai')->departemen == 'DM6' || session()->get('pegawai')->departemen == 'CSM' || session()->get('pegawai')->departemen == 'SPS' || session()->get('pegawai')->jnj_jabatan == 'DIRU' || session()->get('pegawai')->departemen == 'DM7' || session()->get('pegawai')->dokter) &&
                    session()->get('pegawai')->jbtn != 'Dokter Spesialis Radiologi')
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('poliklinik') ? 'active' : '' }}" href="/erm/poliklinik">
                        <i class="bi bi-bandaid align-text-bottom"></i>
                        Poliklinik
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Request::is('obat') ? 'active' : '' }}" href="/erm/obat">
                        <i class="bi bi-capsule-pill align-text-bottom"></i>
                        Obat & BHP
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Request::is('racikan') ? 'active' : '' }}" href="/erm/resep/racik">
                        <i class="bi bi-pen  align-text-bottom"></i>
                        Template Racikan
                    </a>
                </li>
            @endif

            @if (session()->get('pegawai')->nik == 'direksi' || session()->get('pegawai')->departemen == 'DIR' || session()->get('pegawai')->departemen == 'DPM1')
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('resep') ? 'active' : '' }}" href="/erm/resep">
                        <i class="bi bi-prescription align-text-bottom"></i>
                        Resep
                    </a>
                </li>
            @endif
            @if (session()->get('pegawai')->nik == 'direksi' || session()->get('pegawai')->jbtn == 'Dokter Spesialis Radiologi' || session()->get('pegawai')->departemen == 'RAD' || session()->get('pegawai')->departemen == 'CSM')
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('radiologi') ? 'active' : '' }}" href="/erm/radiologi">
                        <i class="bi bi-radioactive"></i>
                        Radiologi
                    </a>
                </li>
            @endif

            <li class="nav-item">
                <a class="nav-link {{ Request::is('lab') ? 'active' : '' }}" href="{{ url('/lab') }}">
                    <i class="bi bi-prescription2"></i>
                    Laborat
                </a>
            </li>
            @if (session()->get('pegawai')->nik == 'direksi' ||
                    session()->get('pegawai')->departemen == 'DM3' ||
                    session()->get('pegawai')->departemen == 'DM7' ||
                    session()->get('pegawai')->departemen == 'SPS' ||
                    session()->get('pegawai')->departemen == 'DPM1' ||
                    session()->get('pegawai')->departemen == 'DNM5' ||
                    session()->get('pegawai')->departemen == 'DM4' ||
                    session()->get('pegawai')->departemen == 'DM5' ||
                    session()->get('pegawai')->departemen == 'DM2' ||
                    session()->get('pegawai')->departemen == 'DPM2' ||
                    session()->get('pegawai')->departemen == 'DM1' ||
                    session()->get('pegawai')->departemen == 'CSM' ||
                    session()->get('pegawai')->departemen == 'ICU' ||
                    session()->get('pegawai')->departemen == 'DIR' ||
                    session()->get('pegawai')->dokter)
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('ranap') ? 'active' : '' }}" href="/erm/ranap">
                        <i class="bi bi-hospital-fill align-text-bottom"></i>
                        Rawat Inap
                    </a>
                </li>
            @endif

            @if (
                (session()->get('pegawai')->nik == 'direksi' || session()->get('pegawai')->departemen == 'DIR' || session()->get('pegawai')->jnj_jabatan == 'DIRU' || session()->get('pegawai')->departemen == 'DM1' || session()->get('pegawai')->departemen == 'CSM' || session()->get('pegawai')->departemen == 'DM7' || session()->get('pegawai')->departemen == 'SPS' || session()->get('pegawai')->departemen == 'DPM2' || session()->get('pegawai')->dokter) &&
                    session()->get('pegawai')->jbtn != 'Dokter Spesialis Radiologi')
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('ugd') ? 'active' : '' }}" href="/erm/ugd">
                        <i class="bi bi-clipboard-pulse align-text-bottom"></i>
                        UGD
                    </a>
                </li>
            @endif

            <li class="nav-item">
                <a class="nav-link" target="_blank" href="{{ config('app.kyc') }}?nama={{ session()->get('pegawai')->nama }}&nik={{ session()->get('pegawai')->nik }}">
                    <i class="bi bi-key-fill"></i>
                    KYC
                </a>
            </li>

            @if(session()->get('pegawai')->nik === 'direksi')
                <li class="nav-item">
                    <a class="nav-link" target="_blank" href="/erm/logs">
                        <i class="bi bi-journal"></i>
                        Log
                    </a>
                </li>
            @endif
            <hr />

            <h6
                class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
                <span>USER</span>
            </h6>
            <li class="nav-item">
                <a class="nav-link" href="javascript:void(0)">
                    <i class="bi bi-person-circle"></i>
                    {{ session()->get('pegawai')->nama }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/erm/logout">
                    <i class="bi bi-box-arrow-left"></i>
                    Logout
                </a>
            </li>
        </ul>
    </div>
</nav>
