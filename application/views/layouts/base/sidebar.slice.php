<nav id="sidebar">
    <!-- Sidebar Content -->
    <div class="sidebar-content">
        <!-- Side Header -->
        <div class="content-header content-header-fullrow px-15">
            <!-- Mini Mode -->
            <div class="content-header-section sidebar-mini-visible-b">
                <!-- Logo -->
                <span class="content-header-item font-w700 font-size-xl float-left animated fadeIn">
                    <span class="text-dual-primary-dark">R</span><span class="text-primary">D</span>
                </span>
                <!-- END Logo -->
            </div>
            <!-- END Mini Mode -->

            <!-- Normal Mode -->
            <div class="content-header-section text-center align-parent sidebar-mini-hidden">
                <!-- Close Sidebar, Visible only on mobile screens -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none align-v-r" data-toggle="layout"
                    data-action="sidebar_close">
                    <i class="fa fa-times text-danger"></i>
                </button>
                <!-- END Close Sidebar -->

                <!-- Logo -->
                <div class="content-header-item">
                    <a class="link-effect font-w700" href="#">
                        <i class="fa fa-database text-primary"></i>
                        <span class="font-size-xl text-dual-primary-dark">Online</span> <span class="font-size-xl text-primary">Shop</span>
                    </a>
                </div>
                <!-- END Logo -->
            </div>
            <!-- END Normal Mode -->
        </div>
        <!-- END Side Header -->

        <!-- Side User -->
        <div class="content-side content-side-full content-side-user px-10 align-parent">
            <!-- Visible only in mini mode -->
            <div class="sidebar-mini-visible-b align-v animated fadeIn">
                {{-- <img class="img-avatar img-avatar32" src="http://localhost/bantu_panti//upload/paket_20190127-082258.png"
                    alt=""> --}}
            </div>
            <!-- END Visible only in mini mode -->

            <!-- Visible only in normal mode -->
            <div class="sidebar-mini-hidden-b text-center">
                <a class="img-link" href="#">
                    {{-- <img class="img-avatar" src="http://localhost/bantu_panti//upload/paket_20190127-082258.png" alt=""> --}}
                </a>
                <ul class="list-inline mt-10">
                    <li class="list-inline-item">
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <a class="link-effect text-dual-primary-dark" data-toggle="layout" data-action="sidebar_style_inverse_toggle"
                            href="javascript:void(0)">
                            <i class="si si-drop"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a class="link-effect text-dual-primary-dark" href="{{ base_url('Sessions/logout') }}">
                            <i class="si si-logout"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- END Visible only in normal mode -->
        </div>
        <!-- END Side User -->

        <!-- Side Navigation -->
        <div class="content-side content-side-full">
            <ul class="nav-main">
                <li>
                    <a href="{{ base_url('/') }}" class="
                        @if($this->router->fetch_class() == 'dashboard' && $this->router->fetch_method() == 'index')
                            active
                        @endif">
                        <i class="fa fa-home"></i><span class="sidebar-mini-hide">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ base_url('/') }}" class="
                        @if($this->router->fetch_class() == 'dashboard' && $this->router->fetch_method() == 'index')
                            active
                        @endif">
                        <i class="fa fa-home"></i><span class="sidebar-mini-hide">About</span>
                    </a>
                </li>
                <li>
                    <a href="{{ base_url('/') }}" class="
                        @if($this->router->fetch_class() == 'dashboard' && $this->router->fetch_method() == 'index')
                            active
                        @endif">
                        <i class="fa fa-home"></i><span class="sidebar-mini-hide">Contact</span>
                    </a>
                </li>
                <!-- <li class="nav-main-heading"><span class="sidebar-mini-visible">UI</span><span class="sidebar-mini-hidden">Panti Asuhan</span></li>
                <li>
                    <a href="{{ base_url('AdminController/LihatProfilPanti') }}">
                        <i class="fa fa-share"></i><span class="sidebar-mini-hide">Lihat Profil Panti</span>
                    </a>
                </li>
                @if($this->session->user_login['role'] == 'd01')
                <li>
                    <a href="{{ base_url('AdminController/profilPanti') }}">
                        <i class="fa fa-retweet"></i><span class="sidebar-mini-hide">Ubah Profil Panti</span>
                    </a>
                </li>
                @endif
                <li class="nav-main-heading"><span class="sidebar-mini-visible">UI</span><span class="sidebar-mini-hidden">Manajemen User</span></li>
                @if($this->session->user_login['role'] == 'd01')
                <li>
                    <a href="{{ base_url('AdminController/userAnakPanti') }}" class="
                        @if($this->router->fetch_class() == 'AdminController' && ($this->router->fetch_method() == 'userAnakPanti' || $this->router->fetch_method() == 'tambahUserAnakPanti' || $this->router->fetch_method() == 'resetPasswordAnakPanti'))
                            active
                        @endif">
                        <i class="fa fa-user"></i><span class="sidebar-mini-hide">Anak Panti</span>
                    </a>
                </li>
                <li>
                    <a href="{{ base_url('AdminController/userDonatur') }}" class="
                        @if($this->router->fetch_class() == 'AdminController' && ($this->router->fetch_method() == 'userDonatur' || $this->router->fetch_method() == 'tambahUserDonatur' || $this->router->fetch_method() == 'resetPasswordDonatur'))
                            active
                        @endif">
                        <i class="fa fa-check-circle"></i><span class="sidebar-mini-hide">Donatur</span>
                    </a>
                </li>
                @else
                <li>
                    <a href="{{ base_url('PetugasController/indexProfil') }}" class="
                        @if($this->router->fetch_class() == 'PetugasController' && ($this->router->fetch_method() == 'indexProfil' || $this->router->fetch_method() == 'editProfil'))
                            active
                        @endif">
                        @if($this->session->user_login['role']=="ap01")
                            <i class="fa fa-user"></i><span class="sidebar-mini-hide">Profil Anak Panti</span>
                        @endif
                        @if($this->session->user_login['role']=="p01")
                            <i class="fa fa-user"></i><span class="sidebar-mini-hide">Profil Donatur</span>
                        @endif
                    </a>
                </li>
                @endif
                <li class="nav-main-heading"><span class="sidebar-mini-visible">UI</span><span class="sidebar-mini-hidden">Kegiatan Panti</span></li>
                <li>
                    <a href="{{ base_url('KegiatanController/lihatKegiatan') }}">
                        <i class="fa fa-share"></i><span class="sidebar-mini-hide">Lihat Story Kegiatan</span>
                    </a>
                </li>
                @if($this->session->user_login['role']!="p01")
                <li>
                    <a href="{{ base_url('KegiatanController/tambahKegiatan') }}">
                        <i class="fa fa-share"></i><span class="sidebar-mini-hide">Tambah Story Kegiatan</span>
                    </a>
                </li>
                @endif

                @if($this->session->user_login['role'] != 'ap01')
                <li class="nav-main-heading"><span class="sidebar-mini-visible">UI</span><span class="sidebar-mini-hidden">Donasi</span></li>
                <li>
                    <a href="{{ base_url('DonasiController/index') }}">
                        <i class="fa fa-share"></i><span class="sidebar-mini-hide">Riwayat Donasi</span>
                    </a>
                </li>
                <li>
                    <a href="{{ base_url('DonasiController/tambahDonasi') }}">
                        <i class="fa fa-share"></i><span class="sidebar-mini-hide">Tambah Donasi</span>
                    </a>
                </li>
                @endif

                @if($this->session->user_login['role'] != 'ap01')
                <li class="nav-main-heading"><span class="sidebar-mini-visible">UI</span><span class="sidebar-mini-hidden">Pengeluaran</span></li>
                <li>
                    <a href="{{ base_url('PengeluaranController/index') }}">
                        <i class="fa fa-share"></i><span class="sidebar-mini-hide">Riwayat Pengeluaran</span>
                    </a>
                </li>
                    @if($this->session->user_login['role']!="p01")
                    <li>
                        <a href="{{ base_url('PengeluaranController/tambahPengeluaran') }}">
                            <i class="fa fa-share"></i><span class="sidebar-mini-hide">Tambah Pengeluaran</span>
                        </a>
                    </li>
                    @endif
                @endif
                

                @if($this->session->user_login['role'] == 'a01' || $this->session->user_login['role'] == 'd01')
                <li class="nav-main-heading"><span class="sidebar-mini-visible">UI</span><span class="sidebar-mini-hidden">Laporan</span></li>
                <li>
                    <a href="{{ base_url('PetugasController/downIndex') }}" class="
                        @if($this->router->fetch_class() == 'PetugasController' && $this->router->fetch_method() == 'downIndex')
                            active
                        @endif">
                        <i class="fa fa-download"></i><span class="sidebar-mini-hide">Download Laporan Donasi</span>
                    </a>
                </li>
                <li>
                    <a href="{{ base_url('Download/surveyor') }}" class="
                        @if($this->router->fetch_class() == 'Download' && $this->router->fetch_method() == 'surveyor')
                            active
                        @endif">
                        <i class="fa fa-download"></i><span class="sidebar-mini-hide">Download Laporan Pengeluaran</span>
                    </a>
                </li>
                @endif -->
            </ul>
        </div>
        <!-- END Side Navigation -->
    </div>
    <!-- Sidebar Content -->
</nav>
<!-- END Sidebar -->