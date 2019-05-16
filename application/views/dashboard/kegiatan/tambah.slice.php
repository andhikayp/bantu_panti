@extends('layouts.base.app')
@section('title', 'Tambah Kegiatan Panti')

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
    <span class="breadcrumb-item active">Tambah Kegiatan Panti</span>
</nav>
<div class="block">
    <div class="block-header block-header-default bg-primary">
        <h3 class="block-title">Kegiatan Panti</h3>
    </div>
    <div class="block-content">
        <form class="js-validation-signup px-30" method="POST" enctype="multipart/form-data" action="{{ base_url('KegiatanController/tambahKegiatan/') }}" aria-label="">
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material form-material-primary floating input-group">
                        <input type="text" class="form-control" id="nama_kegiatan" name="nama_kegiatan">
                        <label for="pihak_sekolah">Nama Kegiatan</label>
                        <!-- <div class="input-group-append">
                            <span class="input-group-text">Contoh: Panti Asuhan Al-Hikmah</span>
                        </div> -->
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material form-material-primary floating input-group">
                        <input type="text" class="form-control" id="deskripsi_kegiatan" name="deskripsi_kegiatan">
                        <label for="pihak_sekolah">Deskripsi Kegiatan</label>
                        <!-- <div class="input-group-append">
                            <span class="input-group-text">Contoh: Pak Fajar</span>
                        </div> -->
                    </div>
                </div>
            </div>
            <hr/><div class="row mb-2">
                <div class="col-3"></div>
                    <a class="col-3 btn btn-danger" href="{{ base_url('KegiatanController/tambahKegiatan/') }}">Cancel</a>&nbsp
                    <button type="submit" class="col-3 btn bg-earth text-white">Submit</button>
                <div class="col-3"></div>
            </div>
        </form>
    </div>
</div>
@endsection