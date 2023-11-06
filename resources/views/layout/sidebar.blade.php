{{-- @dd(auth()->user()->nama) --}}
<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="">
        <ul class="nav flex-column">
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
            @if (session()->get('pegawai')->nik == 'direksi' || session()->get('pegawai')->departemen == 'DIR' || session()->get('pegawai')->departemen == 'DPM2' || session()->get('pegawai')->departemen == 'CSM' || session()->get('pegawai')->departemen == 'DNM2')
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('pasien') ? 'active' : '' }}" href="/erm/pasien">
                        <i class="bi bi-people-fill align-text-bottom"></i>
                        Pasien
                    </a>
                </li>
            @endif

            @if (
                (session()->get('pegawai')->nik == 'direksi' || session()->get('pegawai')->departemen == 'DIR' || session()->get('pegawai')->departemen == 'DPM1' || session()->get('pegawai')->departemen == 'DM6' || session()->get('pegawai')->departemen == 'CSM' || session()->get('pegawai')->departemen == 'SPS' || session()->get('pegawai')->jnj_jabatan == 'DIRU' || session()->get('pegawai')->departemen == 'DM7' || session()->get('pegawai')->dokter) &&
                    session()->get('pegawai')->jbtn != 'Dokter Spesialis Radiologi')
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('poliklinik') ? 'active' : '' }}" href="/erm/poliklinik">
                        <i class="bi bi-bandaid align-text-bottom"></i>
                        Poliklinik
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
            @if (session()->get('pegawai')->nik == 'direksi' || session()->get('pegawai')->jbtn == 'Dokter Spesialis Radiologi' || session()->get('pegawai')->departemen == 'RAD')
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('radiologi') ? 'active' : '' }}" href="/erm/radiologi">
                        <i class="bi bi-radioactive"></i>
                        Radiologi
                    </a>
                </li>
            @endif

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
