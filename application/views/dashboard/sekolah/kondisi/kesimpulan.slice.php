@extends('layouts.base.app')
@section('title', ' Kesimpulan Kondisi Sekolah')

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
    <a class="breadcrumb-item" href="{{ base_url('SekolahController/kondisiSekolah') }}">Kondisi Sekolah</a>
    <a class="breadcrumb-item" href="{{ base_url('SekolahController/lihatKondisi/'.$sekolah->npsn) }}">Lihat Kondisi {{ $sekolah->nama_sekolah }}</a>
    <span class="breadcrumb-item active">Kesimpulan Kondisi {{ $ruang->nama_ruang }}</span>
</nav>
<div class="block">
    <div class="block-header block-header-default bg-primary">
        <h3 class="block-title">Kesimpulan Kondisi {{ $ruang->nama_ruang }}</h3>
    </div>
    <div class="block-content">
    <form class="js-validation-signup px-30" method="POST" enctype="multipart/form-data" action="{{ base_url('SekolahController/kesimpulanKondisi/'.$ruang->kode_ruang.'/'.$sekolah->npsn) }}" aria-label="">
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material form-material-primary floating input-group">
                        <input value="{{ $ruang->jenis_perawatan }}" type="text" class="form-control" id="jenis_perawatan" name="jenis_perawatan">
                        <label for="jenis_perawatan">Jenis Perawatan</label>
                        <div class="input-group-append">
                            <span class="input-group-text">"-" jika kosong</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material form-material-primary floating input-group">
                        <input readonly value="{{ $ruang->nilai_kerusakan }}" type="number" class="form-control" id="nilai_kerusakan" name="nilai_kerusakan" step="0.01" min=0>
                        <label for="nilai_kerusakan">Nilai Kerusakan (%)</label>
                        <div class="input-group-append">
                            <span class="input-group-text">"0" jika kosong</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material form-material-primary floating input-group">
                        <input value="{{ $ruang->luas_direhab }}" type="number" class="form-control" id="luas_direhab" name="luas_direhab" step="0.01" min=0>
                        <label for="luas_direhab">Luas Ruangan di Rehab (m<sup>2</sup>)</label>
                        <div class="input-group-append">
                            <span class="input-group-text">"0" jika kosong</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material form-material-primary floating input-group">
                        <input readonly value="3000000" type="number" class="form-control" id="harga_satuan" name="harga_satuan" step="0.01" min=0>
                        <label for="harga_satuan">Harga Satuan Wilayah (Rp.)</label>
                        <div class="input-group-append">
                            <span class="input-group-text">"0" jika kosong</span>
                        </div>
                    </div>
                </div>
            </div>
            @php
                $hasil = $ruang->nilai_kerusakan/100 * $ruang->luas_direhab * 3000000;
            @endphp
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material form-material-primary floating input-group">
                        <input readonly value="{{ $hasil }}" type="number" class="form-control" id="perkiraan_biaya" name="perkiraan_biaya" step="0.01" min=0>
                        <label for="perkiraan_biaya">Perkiraan Biaya (Rp.)</label>
                        <div class="input-group-append">
                            <span class="input-group-text">"0" jika kosong</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material form-material-primary floating input-group">
                        <input value="{{ $ruang->penjelasan_singkat }}" type="text" class="form-control" id="penjelasan_singkat" name="penjelasan_singkat">
                        <label for="penjelasan_singkat">Penjelasan Singkat</label>
                        <div class="input-group-append">
                            <span class="input-group-text">"-" jika kosong</span>
                        </div>
                    </div>
                </div>
            </div>
            <hr/><div class="row mb-2">
                <div class="col-3"></div>
                    <a class="col-3 btn btn-danger" href="{{ base_url('SekolahController/lihatKondisi/'.$sekolah->npsn) }}">Cancel</a>&nbsp
                    <button type="submit" class="col-3 btn bg-earth text-white">Submit</button>
                <div class="col-3"></div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('moreJS')
<script>
$("#nilai_kerusakan,#luas_direhab,#harga_satuan").keyup(function () {
    $('#perkiraan_biaya').val($('#nilai_kerusakan').val() * $('#luas_direhab').val() * $('#harga_satuan').val());
});
</script>
@endsection