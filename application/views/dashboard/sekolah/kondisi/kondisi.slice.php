@extends('layouts.base.app')
@section('title', ' Kondisi Sekolah')

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
    <span class="breadcrumb-item active">Kondisi {{ $ruang->nama_ruang }}</span>
</nav>

<div class="row">
    <div class="col-md-6">
        <div class="block block-themed">
            <div class="block-header bg-gd-sea">
                <h3 class="block-title">Informasi {{ $ruang->nama_ruang }}</h3>
                <div class="block-options">
                    <a href="{{ base_url('SekolahController/ubahRuang/'.$ruang->kode_ruang.'/'.$sekolah->npsn) }}"><button type="button" class="btn-block-option">
                        <i class="si si-pencil"></i> Ubah
                    </button></a>
                </div>
            </div>
            <div class="block-content">
                <div class="form-group row">
                    <label class="col-12">Nama Ruang</label>
                    <div class="col-md-9">
                        <div class="form-control-plaintext"><i class="fa fa-arrow-right mr-5"></i><b>{{ $ruang->nama_ruang ? $ruang->nama_ruang : "-"  }}</b></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">Tipe Bangunan</label>
                    <div class="col-md-9">
                        <div class="form-control-plaintext"><i class="fa fa-arrow-right mr-5"></i><b>{{ $ruang->tipe_bangunan ? $ruang->tipe_bangunan : "-"  }}</b></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">Jenis Bangunan</label>
                    <div class="col-md-9">
                        <div class="form-control-plaintext"><i class="fa fa-arrow-right mr-5"></i><b>{{ $ruang->jenis_bangunan ? $ruang->jenis_bangunan : "-"  }}</b></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">Rencana Rehab</label>
                    <div class="col-md-9">
                        <div class="form-control-plaintext"><i class="fa fa-arrow-right mr-5"></i><b>{{ $ruang->rencana_rehab ? $ruang->rencana_rehab : "-"  }}</b></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">Tahun Dibangun</label>
                    <div class="col-md-9">
                        <div class="form-control-plaintext"><i class="fa fa-arrow-right mr-5"></i><b>{{ $ruang->tahun_dibangun ? $ruang->tahun_dibangun : "-"  }}</b></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">Rehab Ke</label>
                    <div class="col-md-9">
                        <div class="form-control-plaintext"><i class="fa fa-arrow-right mr-5"></i><b>{{ $ruang->rehab_ke ? $ruang->rehab_ke : "-"  }}</b></div>
                    </div>
                </div>
                <!-- <div class="form-group row">
                    <label class="col-12">Foto Ruang</label>
                    <div class="col-md-9">
                        <div class="form-control-plaintext"><img src="https://ruangdata.net//upload/fotoruang/{{$ruang->foto_ruang}}" width="100%" alt=""></div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="block block-themed">
            <div class="block-header bg-gd-lake">
                <h3 class="block-title">Kesimpulan Kondisi {{ $ruang->nama_ruang }}</h3>
                <div class="block-options">
                    <a href="{{ base_url('SekolahController/kesimpulanKondisi/'.$ruang->kode_ruang.'/'.$sekolah->npsn) }}"><button type="button" class="btn-block-option">
                        <i class="si si-pencil"></i> Ubah
                    </button></a>
                </div>
            </div>
            <div class="block-content">
                <div class="form-group row">
                    <label class="col-12">Jenis Perawatan</label>
                    <div class="col-md-9">
                        <div class="form-control-plaintext"><i class="fa fa-arrow-right mr-5"></i><b>{{ $ruang->jenis_perawatan ? $ruang->jenis_perawatan : "-" }}</b></div>
                    </div>
                </div>
                @php
                    $ruang->nilai_kerusakan = $ruang->nilai_kerusakan;
                @endphp
                <div class="form-group row">
                    <label class="col-12">Nilai Kerusakan</label>
                    <div class="col-md-9">
                        <div class="form-control-plaintext"><i class="fa fa-arrow-right mr-5"></i><b>{{ $ruang->nilai_kerusakan ? $ruang->nilai_kerusakan : "-" }} %</b></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">Luas Direhab</label>
                    <div class="col-md-9">
                        <div class="form-control-plaintext"><i class="fa fa-arrow-right mr-5"></i><b>{{ $ruang->luas_direhab ? $ruang->luas_direhab : "-" }} m<sup>2</sup></b></div>
                    </div>
                </div>
                @php
                    $hasil_rupiah = number_format($data['harga_satuan']->harga_satuan,2,',','.');
                @endphp
                <div class="form-group row">
                    <label class="col-12">Harga Satuan</label>
                    <div class="col-md-9">
                        <div class="form-control-plaintext"><i class="fa fa-arrow-right mr-5"></i><b>Rp. {{ $hasil_rupiah }}</b></div>
                    </div>
                </div>
                @php
                    $biaya = $ruang->nilai_kerusakan/100*$ruang->luas_direhab*$data['harga_satuan']->harga_satuan;
                    $biaya = round($biaya);
                    $hasil_rupiah = number_format($biaya,2,',','.');
                @endphp
                <div class="form-group row">
                    <label class="col-12">Perkiraan Biaya</label>
                    <div class="col-md-9">
                        <div class="form-control-plaintext"><i class="fa fa-arrow-right mr-5"></i><b>Rp. {{ $hasil_rupiah }}</b></div>
                    </div>
                </div>
                <!-- <div class="form-group row">
                    <label class="col-12">Perkiraan Biaya</label>
                    <div class="col-md-9">
                        <div class="form-control-plaintext"><i class="fa fa-arrow-right mr-5"></i><b>Rp.{{ $ruang->perkiraan_biaya ? $ruang->perkiraan_biaya : "-" }}</b></div>
                    </div>
                </div> -->
                <!-- <div class="form-group row">
                    <label class="col-12">Terbilang</label>
                    <div class="col-md-9">
                        <div class="form-control-plaintext"><i class="fa fa-arrow-right mr-5"></i><b>{{ $terbilang ? $terbilang : "-" }}</b></div>
                    </div>
                </div> -->
                <div class="form-group row">
                    <label class="col-12">Penjelasan Kondisi Ruangan</label>
                    <div class="col-md-9">
                        <div class="form-control-plaintext"><i class="fa fa-arrow-right mr-5"></i><b>{{ $ruang->penjelasan_singkat ? $ruang->penjelasan_singkat : "-" }}</b></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('moreJS')

@endsection