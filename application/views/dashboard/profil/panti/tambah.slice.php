@extends('layouts.base.app')
@section('title', 'Ubah Profil Panti')

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
    <a class="breadcrumb-item" href="{{ base_url('/') }}">Dashboard</a>
    <!-- <a class="breadcrumb-item" href="{{ base_url('/PetugasController/hasil_survey') }}">Pelaksanaan Survey</a> -->
    <span class="breadcrumb-item active">Ubah Profil Panti</span>
</nav>
<div class="block">
    <div class="block-header block-header-default bg-primary">
        <h3 class="block-title">Profil Panti</h3>
    </div>
    <div class="block-content">
        <form class="js-validation-signup px-30" method="POST" enctype="multipart/form-data" action="{{ base_url('AdminController/profilPanti/') }}" aria-label="">
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material form-material-primary floating input-group">
                        <input value="{{ $panti->nama_panti }}" type="text" class="form-control" id="nama_panti" name="nama_panti">
                        <label for="pihak_sekolah">Nama Panti Asuhan</label>
                        <div class="input-group-append">
                            <span class="input-group-text">Contoh: Panti Asuhan Al-Hikmah</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material form-material-primary floating input-group">
                        <input value="{{ $panti->nama_ketua_panti }}" type="text" class="form-control" id="nama_ketua_panti" name="nama_ketua_panti">
                        <label for="pihak_sekolah">Nama Ketua Panti</label>
                        <div class="input-group-append">
                            <span class="input-group-text">Contoh: Pak Fajar</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material form-material-primary floating input-group">
                        <input value="{{ $panti->alamat_panti }}" type="text" class="form-control" id="alamat_panti" name="alamat_panti">
                        <label for="pihak_sekolah">Alamat Panti Asuhan</label>
                        <div class="input-group-append">
                            <span class="input-group-text">Contoh: Jl Bogowonto No. 6 Surabaya</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material form-material-primary floating input-group">
                        <input value="{{ $panti->no_telp_panti }}" type="text" class="form-control" id="no_telp_panti" name="no_telp_panti">
                        <label for="pihak_sekolah">No Telp. Panti Asuhan</label>
                        <div class="input-group-append">
                            <span class="input-group-text">Contoh: 081252747290</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material form-material-primary floating input-group">
                        <input value="{{ $panti->no_rekening_bank }}" type="text" class="form-control" id="no_rekening_bank" name="no_rekening_bank">
                        <label for="pihak_sekolah">No Rekening Bank</label>
                        <div class="input-group-append">
                            <span class="input-group-text">Contoh: 164 0000 965 550</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material form-material-primary floating input-group">
                        <input value="{{ $panti->nama_bank }}" type="text" class="form-control" id="nama_bank" name="nama_bank">
                        <label for="pihak_sekolah">Nama Bank</label>
                        <div class="input-group-append">
                            <span class="input-group-text">Contoh: Bank Mandiri</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material form-material-primary floating input-group">
                        <input value="{{ $panti->visi }}" type="text" class="form-control" id="visi" name="visi">
                        <label for="pihak_sekolah">Visi</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material form-material-primary floating input-group">
                        <input value="{{ $panti->misi }}" type="text" class="form-control" id="misi" name="misi">
                        <label for="pihak_sekolah">Misi</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material form-material-primary floating input-group">
                        <input value="{{ $panti->deskripsi_panti }}" type="text" class="form-control" id="deskripsi_panti" name="deskripsi_panti">
                        <label for="pihak_sekolah">Deskripsi Panti Asuhan</label>
                    </div>
                </div>
            </div>
            <hr/><div class="row mb-2">
                <div class="col-3"></div>
                    <a class="col-3 btn btn-danger" href="{{ base_url('PetugasController/save_survey/') }}">Cancel</a>&nbsp
                    <button type="submit" class="col-3 btn bg-earth text-white">Submit</button>
                <div class="col-3"></div>
            </div>
        </form>
    </div>
</div>
@endsection