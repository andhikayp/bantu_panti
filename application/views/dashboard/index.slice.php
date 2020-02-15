@extends('layouts.base.app')
@section('title', ' Dashboard')

@section('sidebar')
    @include('layouts.base.sidebar')
@endsection

@section('header')
    @include('layouts.base.header')
@endsection

@section('content')
<div class="col-12 mb-2 mt-2">
    @if($this->session->flashdata('message')) 
        @if($this->session->flashdata('message')['type'] == 'error')
        <div class="alert alert-danger">
            {{ implode('\n', $this->session->flashdata('message')['message']) }}
        </div>
        @else
        <div class="alert alert-success">
            {{ implode('\n', $this->session->flashdata('message')['message']) }}
        </div>
        @endif
    @endif
</div>

<nav class="breadcrumb bg-white push">
    <a class="breadcrumb-item" href="#">Dashboard</a>
    <span class="breadcrumb-item active">Index</span>
</nav>
<div class="block">
    <div class="block-header block-header-default bg-primary">
        <h3 class="block-title">Selamat Datang di Dashboard</h3>
    </div>
    <div class="block-content">
        <div id="body">
              <h3>Deskripsi Sistem</h3>
              <h4 style="text-transform: underline">Product Knowledge</h4>
              <ul>
              <li>Menampilkan daftar produk beserta harga</li>
              <li>Menambahkan data produk</li>
              <ul>
               <li>Nama</li>
               <li>Jumlah</li>
               <li>Harga</li>
              </ul>
              <li>Develop by <b>Andhika Yoga Perdana</b></li>
              <li>NRP : 05111740000101</li>
              <li>Kelas : PBKK - A</li>
              </ul>
        </div>

        <!-- <h2 class="content-heading text-default">ALUR DONASI</h2>
        <div class="row gutters-tiny">
            <div class="col-md-6 col-xl-3">
                <div class="block block-rounded">
                    <div class="block-content block-content-full ribbon ribbon-bookmark ribbon-danger ribbon-left bg-gray-light">
                        <div class="ribbon-box">1</div>
                        <div class="py-20 text-center">
                            <div class="mb-20">
                                <i class="fa fa-user fa-3x text-danger"></i>
                            </div>
                            <div class="font-size-sm font-w600 text-uppercase text-danger">1. Melengkapi Profil</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="block block-rounded">
                    <div class="block-content block-content-full ribbon ribbon-bookmark ribbon-danger ribbon-left bg-gray-light">
                        <div class="ribbon-box">2</div>
                        <div class="py-20 text-center">
                            <div class="mb-20">
                                <i class="fa fa-list fa-3x text-danger"></i>
                            </div>
                            <div class="font-size-sm font-w600 text-uppercase text-danger">2. Mengisi Donatur</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="block block-rounded">
                    <div class="block-content block-content-full ribbon ribbon-bookmark ribbon-info ribbon-left bg-gray-light">
                        <div class="ribbon-box">3</div>
                        <div class="py-20 text-center">
                            <div class="mb-20">
                                <i class="fa fa-image fa-3x text-info"></i>
                            </div>
                            <div class="font-size-sm font-w600 text-uppercase text-info">3. Upload LayoutPlan</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="block block-rounded">
                    <div class="block-content block-content-full ribbon ribbon-bookmark ribbon-info ribbon-left bg-gray-light">
                        <div class="ribbon-box">4</div>
                        <div class="py-20 text-center">
                            <div class="mb-20">
                                <i class="fa fa-plus fa-3x text-info"></i>
                            </div>
                            <div class="font-size-sm font-w600 text-uppercase text-info">4. Tambah Ruangan</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row gutters-tiny">
            <div class="col-md-6 col-xl-3">
                <div class="block block-rounded">
                    <div class="block-content block-content-full ribbon ribbon-bookmark ribbon-primary ribbon-left bg-gray-light">
                        <div class="ribbon-box">5</div>
                        <div class="py-20 text-center">
                            <div class="mb-20">
                                <i class="fa fa-upload fa-3x text-primary"></i>
                            </div>
                            <div class="font-size-sm font-w600 text-uppercase text-primary">5. Upload Kondisi</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="block block-rounded">
                    <div class="block-content block-content-full ribbon ribbon-bookmark ribbon-primary ribbon-left bg-gray-light">
                        <div class="ribbon-box">6</div>
                        <div class="py-20 text-center">
                            <div class="mb-20">
                                <i class="fa fa-upload fa-3x text-primary"></i>
                            </div>
                            <div class="font-size-sm font-w600 text-uppercase text-primary">6. Kesimpulan Kondisi</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="block block-rounded">
                    <div class="block-content block-content-full ribbon ribbon-bookmark ribbon-success ribbon-left bg-gray-light">
                        <div class="ribbon-box">7</div>
                        <div class="py-20 text-center">
                            <div class="mb-20">
                                <i class="fa fa-upload fa-3x text-success"></i>
                            </div>
                            <div class="font-size-sm font-w600 text-uppercase text-success">7. Download Laporan</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="block block-rounded">
                    <div class="block-content block-content-full ribbon ribbon-bookmark ribbon-success ribbon-left bg-gray-light">
                        <div class="ribbon-box">8</div>
                        <div class="py-20 text-center">
                            <div class="mb-20">
                                <i class="fa fa-check fa-3x text-success"></i>
                            </div>
                            <div class="font-size-sm font-w600 text-uppercase text-success">8. Selesai</div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->

        <!-- <h2 class="content-heading text-default">KETERANGAN</h2>
        <div class="row">
            <div class="col-lg-6 col-6">
                <div class="text-blue">
                    <h5>Profil Petugas</h5>
                    <p><i class="fa fa-arrow-right mr-5"></i> Melihat & mengedit profil petugas pada <b class="text-danger">Menu Profil Petugas</b></p>
                    <h5>Pelaksanaan Survey</h5>
                    <p><i class="fa fa-arrow-right mr-5"></i> Mengisi pelaksanaan survey <b class="text-danger">Menu Pelaksanaan Survey</b></p>
                    <h5>Upload Layout Plan</h5>
                    <p><i class="fa fa-arrow-right mr-5"></i> Mengupload denah sekolah atau layout plan <b class="text-danger">Menu Layout Plan</b></p>
                    <h5>Menambah Ruangan Tiap Sekolah</h5>
                    <p><i class="fa fa-arrow-right mr-5"></i> Tambah ruangan tiap sekolah pada <b class="text-danger">Menu Ruang Sekolah</b></p>
                    <p><i class="fa fa-arrow-right mr-5"></i> Menambah, melihat, mengubah dan menghapus ruangan pada <b class="text-danger">Menu Ruang Sekolah</b></p>
                </div>
            </div>
            <div class="col-lg-6 col-6">
                <div class="text-blue">
                    <h5>Upload Kondisi Komponen Ruang</h5>
                    <p><i class="fa fa-arrow-right mr-5"></i> Upload kondisi komponen tiap ruang pada <b class="text-danger">Menu Kondisi Sekolah</b></p>
                    <h5>Isi Kesimpulan Kondisi Ruang</h5>
                    <p><i class="fa fa-arrow-right mr-5"></i> Mengisi kesimpulan ada pada <b class="text-danger">Menu Kondisi Sekolah</b></p>
                    <h5>Download Laporan</h5>
                    <p><i class="fa fa-arrow-right mr-5"></i> Downlaod laporan (cover, laporan kondisi kerusakan) pada <b class="text-danger">Menu Download Laporan</b></p>
                </div>
            </div>
        </div> -->
    </div>
</div>
@endsection