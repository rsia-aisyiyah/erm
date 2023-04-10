{{-- @dd(auth()->user()->nama) --}}
<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
            <h6
                class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
                <span>MENU</span>
            </h6>

            <li class="nav-item">
                <a class="nav-link {{ Request::is('registrasi') ? 'active' : '' }}" href="/erm/registrasi">
                    <i class="bi bi-pen  align-text-bottom"></i>
                    Pendaftaran
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('pasien') ? 'active' : '' }}" href="/erm/pasien">
                    <i class="bi bi-people-fill align-text-bottom"></i>
                    Pasien
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('poliklinik') ? 'active' : '' }}" href="/erm/poliklinik">
                    <i class="bi bi-bandaid align-text-bottom"></i>
                    Poliklinik
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('resep') ? 'active' : '' }}" href="/erm/resep">
                    <i class="bi bi-prescription align-text-bottom"></i>
                    Resep
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('ranap') ? 'active' : '' }}" href="/erm/ranap">
                    <i class="bi bi-hospital-fill align-text-bottom"></i>
                    Rawat Inap
                </a>
            </li>
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
