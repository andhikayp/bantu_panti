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
                        <span class="font-size-xl text-dual-primary-dark">Bantu</span> <span class="font-size-xl text-primary">Panti</span>
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
                <img class="img-avatar img-avatar32" src="http://localhost/bantu_panti//upload/paket_20190127-082258.png"
                    alt="">
            </div>
            <!-- END Visible only in mini mode -->

            <!-- Visible only in normal mode -->
            <div class="sidebar-mini-hidden-b text-center">
                <a class="img-link" href="#">
                    <img class="img-avatar" src="http://localhost/bantu_panti//upload/paket_20190127-082258.png" alt="">
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
                <!-- <li>
                    <a href="{{ base_url('AdminController/statistik') }}" class="
                        @if($this->router->fetch_class() == 'AdminController' && $this->router->fetch_method() == 'statistik')
                            active
                        @endif">
                        <i class="fa fa-bar-chart "></i><span class="sidebar-mini-hide">Statistik</span>
                    </a>
                </li> -->
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
                        <i class="fa fa-user"></i><span class="sidebar-mini-hide">Donatur</span>
                    </a>
                </li>
                @else
                <li>
                    <a href="{{ base_url('PetugasController/indexProfil') }}" class="
                        @if($this->router->fetch_class() == 'PetugasController' && ($this->router->fetch_method() == 'indexProfil' || $this->router->fetch_method() == 'editProfil'))
                            active
                        @endif">
                        <i class="fa fa-user"></i><span class="sidebar-mini-hide">Profil Petugas</span>
                    </a>
                </li>
                @endif
                <li class="nav-main-heading"><span class="sidebar-mini-visible">UI</span><span class="sidebar-mini-hidden">Sekolah</span></li>
                <li>
                    <a href="{{ base_url('SekolahController/index') }}" class="
                        @if($this->router->fetch_class() == 'SekolahController' && $this->router->fetch_method() == 'index')
                            active
                        @endif">
                        <i class="fa fa-university"></i><span class="sidebar-mini-hide">Data Sekolah</span>
                    </a>
                </li>
                <li>
                    <a href="{{ base_url('SekolahController/anggaran') }}" class="
                        @if($this->router->fetch_class() == 'SekolahController' && $this->router->fetch_method() == 'anggaran')
                            active
                        @endif">
                        <i class="fa fa-retweet"></i><span class="sidebar-mini-hide">Anggaran Sekolah</span>
                    </a>
                </li>
                <li>
                    <a href="{{ base_url('SekolahController/anggaran_kecamatan') }}" class="
                        @if($this->router->fetch_class() == 'SekolahController' && $this->router->fetch_method() == 'anggaranamatan')
                            active
                        @endif">
                        <i class="fa fa-share"></i><span class="sidebar-mini-hide">Anggaran Tiap Kecamatan</span>
                    </a>
                </li>
                <li class="nav-main-heading"><span class="sidebar-mini-visible">UI</span><span class="sidebar-mini-hidden">Pengisian</span></li>
                <li>
                    <a href="{{ base_url('PetugasController/hasil_survey') }}" class="
                        @if($this->router->fetch_class() == 'PetugasController' && $this->router->fetch_method() == 'hasil_survey')
                            active
                        @endif">
                        <i class="fa fa-check-circle"></i><span class="sidebar-mini-hide">1. Pelaksanaan Survey</span>
                    </a>
                </li>
                <li>
                    <a href="{{ base_url('PetugasController/upIndex') }}" class="
                        @if($this->router->fetch_class() == 'PetugasController' && ($this->router->fetch_method() == 'upIndex' || $this->router->fetch_method() == 'lihatLayout' || $this->router->fetch_method() == 'uploadLayout'))
                            active
                        @endif">
                        <i class="fa fa-upload"></i><span class="sidebar-mini-hide">2. Layout Plan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ base_url('SekolahController/ruangSekolah') }}" class="
                        @if($this->router->fetch_class() == 'SekolahController' && ($this->router->fetch_method() == 'ruangSekolah' || $this->router->fetch_method() == 'lihatRuang' || $this->router->fetch_method() == 'tambahRuang' || $this->router->fetch_method() == 'ubahRuang' || $this->router->fetch_method() == 'fotoRuang' || $this->router->fetch_method() == 'cekFotoRuang'))
                            active
                        @endif">
                        <i class="fa fa-building"></i><span class="sidebar-mini-hide">3. Ruang Sekolah</span>
                    </a>
                </li>
                <li>
                    <a href="{{ base_url('SekolahController/kondisiSekolah') }}" class="
                        @if($this->router->fetch_class() == 'SekolahController' && ($this->router->fetch_method() == 'kondisiSekolah' || $this->router->fetch_method() == 'lihatKondisi' || $this->router->fetch_method() == 'lihatKondisiRuang' || $this->router->fetch_method() == 'uploadKondisi' || $this->router->fetch_method() == 'kesimpulanKondisi'))
                            active
                        @endif">
                        <i class="fa fa-wrench"></i><span class="sidebar-mini-hide">4. Kondisi Sekolah</span>
                    </a>
                </li>
                <li class="nav-main-heading"><span class="sidebar-mini-visible">UI</span><span class="sidebar-mini-hidden">Laporan</span></li>
                <li>
                    <a href="{{ base_url('PetugasController/downIndex') }}" class="
                        @if($this->router->fetch_class() == 'PetugasController' && $this->router->fetch_method() == 'downIndex')
                            active
                        @endif">
                        <i class="fa fa-download"></i><span class="sidebar-mini-hide">Download Laporan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ base_url('Download/surveyor') }}" class="
                        @if($this->router->fetch_class() == 'Download' && $this->router->fetch_method() == 'surveyor')
                            active
                        @endif">
                        <i class="fa fa-download"></i><span class="sidebar-mini-hide">Download Surveyor</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- END Side Navigation -->
    </div>
    <!-- Sidebar Content -->
</nav>
<!-- END Sidebar -->