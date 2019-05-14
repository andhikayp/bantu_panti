@extends('layouts.base.app')
@section('title', ' Profil Petugas')

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
    <span class="breadcrumb-item active">Profil Petugas</span>
</nav>
<div class="block block-themed">
    <div class="block-header bg-gd-lake">
        <h3 class="block-title">Profil Petugas</h3>
        <div class="block-options">
            <a href="{{ base_url('PetugasController/editProfil') }}"><button type="button" class="btn-block-option btn-sm bg-danger">
                <i class="si si-pencil"></i> Ubah
            </button></a>
        </div>
    </div>
    <div class="block-content">
        <div class="row">
            <div class="col-6">
                <div class="form-group row">
                    <label class="col-12">Username Petugas</label>
                    <div class="col-md-9">
                        <div class="form-control-plaintext"><i class="fa fa-arrow-right mr-5"></i><b>{{ $petugas->username ? $petugas->username : "-" }}</b></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">Nama Petugas</label>
                    <div class="col-md-9">
                        <div class="form-control-plaintext"><i class="fa fa-arrow-right mr-5"></i><b>{{ $petugas->nama_petugas ? $petugas->nama_petugas : "-" }}</b></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">Email Petugas</label>
                    <div class="col-md-9">
                        <div class="form-control-plaintext"><i class="fa fa-arrow-right mr-5"></i><b>{{ $petugas->email_petugas ? $petugas->email_petugas : "-" }}</b></div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group row">
                    <label class="col-12">Nomer Telepon Petugas</label>
                    <div class="col-md-9">
                        <div class="form-control-plaintext"><i class="fa fa-arrow-right mr-5"></i><b>{{ $petugas->no_hape_petugas ? $petugas->no_hape_petugas : "-" }}</b></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">Alamat Petugas</label>
                    <div class="col-md-9">
                        <div class="form-control-plaintext"><i class="fa fa-arrow-right mr-5"></i><b>{{ $petugas->alamat_petugas ? $petugas->alamat_petugas : "-" }}</b></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection