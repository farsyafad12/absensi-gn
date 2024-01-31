<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="{{ route('dashboard') }}" class="text-nowrap logo-img mt-2">
                <img src="/assets/images/logos/gema-large.png" width="180" alt="logo-gema" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="kontrol">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Halaman Utama</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->url() == route('dashboard') ? ' active' : '' }}
                "
                        href="{{ route('dashboard') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Data</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->url() == route('data_siswa') ? ' active' : '' }}" href="{{ route('data_siswa') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-article"></i>
                        </span>
                        <span class="hide-menu">Data Siswa</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->url() == route('data_kehadiran') ? ' active' : '' }}" href="{{ route('data_kehadiran') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-article"></i>
                        </span>
                        <span class="hide-menu">Kehadiran Siswa</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->url() == route('data_kelas') ? ' active' : '' }}" href="{{ route('data_kelas') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-article"></i>
                        </span>
                        <span class="hide-menu">Data Kelas</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->url() == route('data_tingkat') ? ' active' : '' }}" href="{{ route('data_tingkat') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-article"></i>
                        </span>
                        <span class="hide-menu">Data Tingkat</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Lainnya</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->url() == route('qr_siswa') ? ' active' : '' }}" href="{{ route('qr_siswa') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-qrcode"></i>
                        </span>
                        <span class="hide-menu">Generate Qr Code</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->url() == route('laporan') ? ' active' : '' }}" href="{{ route('laporan') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-printer"></i>
                        </span>
                        <span class="hide-menu">Laporan</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Pengguna</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->url() == route('user_detail') ? ' active' : '' }}" href="{{ route('user_detail') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-settings"></i>
                        </span>
                        <span class="hide-menu">Pengaturan Akun</span>
                    </a>
                </li>
            </ul>
            <div class="unlimited-access hide-menu bg-light-primary position-relative mb-7 mt-5 rounded">
                <div class="d-flex">
                    <div class="unlimited-access-title me-3">
                        <h6 class="fw-semibold fs-4 mb-6 text-dark w-85">Butuh Bantuan ?</h6>
                        <a href="https://wa.me/6288293898965" target="_blank"
                            class="btn btn-primary fs-2 fw-semibold lh-sm"><i class="ti ti-phone me-2"></i>Hubungi
                            Pengelola</a>
                    </div>
                    <!--<div class="unlimited-access-img">
                <img src="../assets/images/backgrounds/rocket.png" alt="" class="img-fluid">
              </div>-->
                </div>
            </div>
        </nav>
    </div>
</aside>
