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
    <a class="breadcrumb-item" href="{{ base_url('/PetugasController/hasil_survey') }}">Riwayat Donasi</a>
    <span class="breadcrumb-item active">Tambah Donasi</span>
</nav>
<div class="block">
    <div class="block-header block-header-default bg-primary">
        <h3 class="block-title">Tambah Donasi</h3>
    </div>
    <div class="block-content">
        <form class="js-validation-signup px-30" method="POST" enctype="multipart/form-data" action="{{ base_url('DonasiController/tambahDonasi/') }}" aria-label="">
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material form-material-primary floating input-group">
                        <input type="text" class="form-control" id="nominal_donasi" name="nominal_donasi">
                        <label for="pihak_sekolah">Nominal Donasi</label>
                        <div class="input-group-append">
                            <span class="input-group-text">Contoh: 500000</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material form-material-primary floating input-group">
                        <input type="text" class="form-control" id="keterangan_donasi" name="keterangan_donasi">
                        <label for="pihak_sekolah">Keterangan Donasi</label>
                        <!-- <div class="input-group-append">
                            <span class="input-group-text">Contoh: Pak Fajar</span>
                        </div> -->
                    </div>
                </div>
            </div><br>
            <div class="form-group row">
                <div class="col-4">
                    <div class="form-group row">
                        <label class="col-12">Upload bukti donasi</label>
                        <div class="col-12">
                            <input type="file" id="bukti_donasi" name="file" paria-describedby="upload">
                        </div>
                    </div>
                    <span class="badge badge-info">Ukuran Maks Upload 1MB</span>
                    <span class="badge badge-danger">Format JPG / PNG / PDF</span>
                </div>
            </div>
            <!-- <div class="form-group row">
                <div class="col-12">
                    <div class="form-material form-material-primary floating input-group">
                        <input type="text" class="form-control" id="alamat_panti" name="alamat_panti">
                        <label for="pihak_sekolah">Alamat Panti Asuhan</label>
                        <div class="input-group-append">
                            <span class="input-group-text">Contoh: Jl Bogowonto No. 6 Surabaya</span>
                        </div>
                    </div>
                </div>
            </div> -->
            <!-- <div class="form-group row">
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
            </div> -->
            <!-- <div class="form-group row">
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
            </div> -->
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