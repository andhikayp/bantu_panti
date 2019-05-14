@extends('layouts.base.app')
@section('title', ' Tambah Ruang Sekolah')

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
    <a class="breadcrumb-item" href="{{ base_url('SekolahController/ruangSekolah') }}">Ruang Sekolah</a>
    <a class="breadcrumb-item" href="{{ base_url('SekolahController/lihatRuang/'.$sekolah->npsn) }}">Ruang Sekolah</a>
    <span class="breadcrumb-item active">Tambah Ruang {{ $sekolah->nama_sekolah }}</span>
</nav>
<div class="row">
    <div class="col-md-6">
        
    </div>
</div>
<div class="block">
    <div class="block-header block-header-default bg-primary">
        <h3 class="block-title">Tambah Ruang {{ $sekolah->nama_sekolah }}</h3>
    </div>
    <div class="block-content">
        <form class="js-validation-signup px-30" method="POST" enctype="multipart/form-data" action="{{ base_url('SekolahController/tambahRuang/'.$sekolah->npsn) }}" aria-label="">
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material form-material-primary floating input-group">
                        <input type="text" class="form-control" id="nama_ruang" name="nama_ruang">
                        <label for="nama_ruang">Nama Ruang</label>
                        <div class="input-group-append">
                            <span class="input-group-text">Contoh: Ruang Guru / "-" jika kosong</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="form-group row">
                <div class="col-12">
                    <div class="form-material form-material-primary floating input-group">
                        <input type="number" class="form-control" id="luas_ruang" name="luas_ruang" step="0.01" min=0>
                        <label for="nama_ruang">Luas Ruang (m<sup>2</sup>)</label>
                        <div class="input-group-append">
                            <span class="input-group-text">Contoh: 65 / "-" jika kosong</span>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material form-material-primary floating input-group">
                        <input type="text" class="form-control" id="tipe_bangunan" name="tipe_bangunan">
                        <label for="tipe_bangunan">Tipe Bangunan</label>
                        <div class="input-group-append">
                            <span class="input-group-text">Contoh: / "-" jika kosong</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material form-material-primary floating open">
                        <select class="form-control" id="jenis_bangunan" name="jenis_bangunan">
                            <option value="0">Tidak Ada</option>
                            <option value="1">1 Lantai</option>
                            <option value="2">2 Lantai</option>
                            <option value="3">3 Lantai</option>
                        </select>
                        <label for="jenis_bangunan">Jenis Bangunan</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material form-material-primary floating open">
                        <select class="form-control" id="rencana_rehab" name="rencana_rehab">
                            <option value="0">Tidak Ada</option>
                            <option value="1">Lantai Dasar</option>
                            <option value="2">Lantai 2</option>
                            <option value="3">Lantai 3</option>
                        </select>
                        <label for="rencana_rehab">Rencana Rehab</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material form-material-primary floating input-group">
                        <input type="number" class="form-control" id="tahun_dibangun" name="tahun_dibangun">
                        <label for="tahun_dibangun">Tahun Dibangun</label>
                        <div class="input-group-append">
                            <span class="input-group-text">Contoh: 2011 / "0" jika kosong</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material form-material-primary floating input-group">
                        <input type="number" class="form-control" id="rehab_ke" name="rehab_ke">
                        <label for="rehab_ke">Rehab Ke</label>
                        <div class="input-group-append">
                            <span class="input-group-text">Contoh: 2 / "0" jika kosong</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="form-group row"></div>
            <div class="form-group row">
                <label class="col-12" for="foto_ruang">Foto Ruang</label>
                <div class="col-12">
                    <input type="file" id="foto_ruang" name="foto_ruang">
                </div>
            </div> -->
            <hr/><div class="row mb-2">
                <div class="col-3"></div>
                    <a class="col-3 btn btn-danger" href="{{ base_url('SekolahController/lihatRuang/'.$sekolah->npsn) }}">Cancel</a>&nbsp
                    <button type="submit" class="col-3 btn bg-earth text-white">Submit</button>
                <div class="col-3"></div>
            </div>
        </form>
    </div>
</div>
@endsection