@extends('layouts.base.app')
@section('title', ' Edit Profil Petugas')

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

@if($this->session->user_login['id_role'] == '3')
<nav class="breadcrumb bg-white push">
    <a class="breadcrumb-item" href="{{ base_url('/') }}">Dashboard</a>
    <a class="breadcrumb-item" href="{{ base_url('PetugasController/indexProfil') }}">Profil Donatur</a>
    <span class="breadcrumb-item active">Edit Profil Donatur</span>
</nav>
<div class="block">
    <div class="block-header block-header-default bg-primary">
        <h3 class="block-title">Edit Profil Donatur</h3>
    </div>
    <div class="block-content">
        <form class="js-validation-signup px-30" method="POST" enctype="multipart/form-data" action="{{ base_url('PetugasController/editProfil') }}" aria-label="">
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material form-material-primary floating input-group">
                        <input value="{{ $petugas->nama_petugas }}" type="text" class="form-control" id="nama_petugas" name="nama_petugas">
                        <label for="nama_petugas">Nama Donatur</label>
                        <div class="input-group-append">
                            <span class="input-group-text">Contoh: Hikmawan</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material form-material-primary floating input-group">
                        <input value="{{ $petugas->email_petugas }}" type="text" class="form-control" id="email_petugas" name="email_petugas">
                        <label for="email_petugas">Email Donatur</label>
                        <div class="input-group-append">
                            <span class="input-group-text">Contoh: hikmawan@gmail.com</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material form-material-primary floating input-group">
                        <input value="{{ $petugas->no_hape_petugas }}" type="text" class="form-control" id="no_hape_petugas" name="no_hape_petugas">
                        <label for="no_hape_petugas">Nomer Telepon Donatur</label>
                        <div class="input-group-append">
                            <span class="input-group-text">Contoh: 085850000000</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material form-material-primary floating input-group">
                        <input value="{{ $petugas->alamat_petugas }}" type="text" class="form-control" id="alamat_petugas" name="alamat_petugas">
                        <label for="alamat_petugas">Alamat Donatur</label>
                        <div class="input-group-append">
                            <span class="input-group-text">Contoh: Desa Rejeni RT 12 RW 06 Krembung-Sidoarjo</span>
                        </div>
                    </div>
                </div>
            </div>
            <hr/><div class="row mb-2">
                <div class="col-3"></div>
                    <a class="col-3 btn btn-danger" href="{{ base_url('PetugasController/indexProfil') }}">Cancel</a>&nbsp
                    <button type="submit" class="col-3 btn bg-earth text-white">Submit</button>
                <div class="col-3"></div>
            </div>
        </form>
    </div>
</div>
@endif
@if($this->session->user_login['id_role'] == '4')
<nav class="breadcrumb bg-white push">
    <a class="breadcrumb-item" href="{{ base_url('/') }}">Dashboard</a>
    <a class="breadcrumb-item" href="{{ base_url('PetugasController/indexProfil') }}">Profil Anak Panti</a>
    <span class="breadcrumb-item active">Edit Profil Anak Panti</span>
</nav>
<div class="block">
    <div class="block-header block-header-default bg-primary">
        <h3 class="block-title">Edit Profil Petugas</h3>
    </div>
    <div class="block-content">
        <form class="js-validation-signup px-30" method="POST" enctype="multipart/form-data" action="{{ base_url('PetugasController/editProfil') }}" aria-label="">
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material form-material-primary floating input-group">
                        <input value="{{ $petugas->nama_petugas }}" type="text" class="form-control" id="nama_petugas" name="nama_petugas">
                        <label for="nama_petugas">Nama Anak Panti</label>
                        <div class="input-group-append">
                            <span class="input-group-text">Contoh: Hikmawan</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material form-material-primary floating input-group">
                        <input value="{{ $petugas->email_petugas }}" type="text" class="form-control" id="email_petugas" name="email_petugas">
                        <label for="email_petugas">Email Anak Panti</label>
                        <div class="input-group-append">
                            <span class="input-group-text">Contoh: hikmawan@gmail.com</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material form-material-primary floating input-group">
                        <input value="{{ $petugas->no_hape_petugas }}" type="text" class="form-control" id="no_hape_petugas" name="no_hape_petugas">
                        <label for="no_hape_petugas">Nomer Telepon Anak Panti</label>
                        <div class="input-group-append">
                            <span class="input-group-text">Contoh: 085850000000</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material form-material-primary floating input-group">
                        <input value="{{ $petugas->alamat_petugas }}" type="text" class="form-control" id="alamat_petugas" name="alamat_petugas">
                        <label for="alamat_petugas">Alamat Anak Panti</label>
                        <div class="input-group-append">
                            <span class="input-group-text">Contoh: Desa Rejeni RT 12 RW 06 Krembung-Sidoarjo</span>
                        </div>
                    </div>
                </div>
            </div>
            <hr/><div class="row mb-2">
                <div class="col-3"></div>
                    <a class="col-3 btn btn-danger" href="{{ base_url('PetugasController/indexProfil') }}">Cancel</a>&nbsp
                    <button type="submit" class="col-3 btn bg-earth text-white">Submit</button>
                <div class="col-3"></div>
            </div>
        </form>
    </div>
</div>
@endif

@endsection