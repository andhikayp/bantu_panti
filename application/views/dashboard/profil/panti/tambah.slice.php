@extends('layouts.base.app')
@section('title', ' Ruang Sekolah')

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
    <a class="breadcrumb-item" href="{{ base_url('/PetugasController/hasil_survey') }}">Pelaksanaan Survey</a>
    <span class="breadcrumb-item active">Tambah Pelaksanaan Survey</span>
</nav>
<div class="block">
    <div class="block-header block-header-default bg-primary">
        <h3 class="block-title">Pelaksanaan Survey</h3>
    </div>
    <div class="block-content">
        <form class="js-validation-signup px-30" method="POST" enctype="multipart/form-data" action="{{ base_url('PetugasController/save_survey/') }}" aria-label="">
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material form-material-primary floating open">
                        <select class="form-control js-example-basic-single3" id="tempat_pelaksanaan" name="tempat_pelaksanaan">
                            <option value="0">Pilih Sekolah</option>
                            @foreach($sekolah as $pelaksanaan)
                                <option value="{{ $pelaksanaan->nama_sekolah }}">{{ $pelaksanaan->nama_sekolah }} - {{ $pelaksanaan->kecamatan }}</option>
                            @endforeach
                        </select>
                        <label for="tempat_pelaksanaan">Tempat Pelaksanaan</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material form-material-primary floating input-group">
                        <input type="text" class="form-control" id="pihak_sekolah" name="pihak_sekolah">
                        <label for="pihak_sekolah">Nama Penanggung Jawab Pihak Sekolah</label>
                        <div class="input-group-append">
                            <span class="input-group-text">Contoh: Bu Sarwosri</span>
                        </div>
                    </div>
                </div>
            </div><br>
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-group">
                        <label class="form-control-label" for="tanggal">Tanggal Pelaksanaan</label>
                        <br>
                        <input type="date" id="tanggal" class="form-control form-control-alternative" name="tanggal" required>
                            </select>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-group">
                        <label class="form-control-label" for="jam">Jam Pelaksanaan</label>
                        <br>
                        <input type="time" id="jam" class="form-control form-control-alternative" name="jam" required>
                            </select>
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