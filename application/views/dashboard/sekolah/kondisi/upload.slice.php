@extends('layouts.base.app')
@section('title', ' Upload Kondisi Sekolah')

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
    <span class="breadcrumb-item active">Upload Kondisi {{ $ruang->nama_ruang }}</span>
</nav>
<div class="block">
    <div class="block-header block-header-default bg-primary">
        <h3 class="block-title">Upload Kondisi {{ $ruang->nama_ruang }}</h3>
    </div>
    <div class="block-content">
        <div class="col-lg-12 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-5 col-12">
                            <h3 class="h4"><i class="fa fa-arrow-right mr-5"></i>Format Upload Kondisi</h3>                            
                            <div class="mb-20">
                                <a href="{{ base_url('DownloadController/downloadFormatKomponen/'.$ruang->kode_ruang.'/'.$sekolah->npsn) }}" target="_blank"><button type="button" class="col-md-12 btn btn-lg bg-earth text-white"><i class="fa fa-download"></i> Download Format Kondisi</button></a>
                            </div>
                            <form action="{{ base_url('DownloadController/uploadFormatKomponen/'.$ruang->kode_ruang.'/'.$sekolah->npsn) }}" method="post" enctype="multipart/form-data">                            
                                <div class="mt-30 mb-5">
                                    <input type="file" class="form-control-file" id="filenilai" name="file" paria-describedby="uploadNilai" required>
                                </div>
                                <div class="">
                                    <button type="submit" class="col-md-12 btn btn-lg bg-earth text-white"><i class="fa fa-upload"></i> Upload Format Kondisi</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-7 col-12">
                            <h3 class="h4"><i class="fa fa-arrow-right mr-5"></i> Informasi</h3> 
                            <div class="text-blue">
                                <h5>Download Format Kondisi</h5>
                                <p><i class="fa fa-circle mr-5"></i> Klik Download untuk mendapatkan format berupa file excel</p>
                                <h5>Upload Format Kondisi</h5>
                                <p><i class="fa fa-circle mr-5"></i> Pilih file yang sudah terisi data kondisi yang benar</p>
                                <p><i class="fa fa-circle mr-5"></i> Klik Upload untuk input data kondisi</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="block">
    <div class="block-header block-header-default bg-primary">
        <h3 class="block-title">Kondisi Komponen {{ $ruang->nama_ruang }}</h3>
    </div>
    <div class="block-content">
        <div class="table-responsive">
            <table id="table-lihat" class="stripe table table-stripped">
                <thead>
                    <tr>
                        <th class="text-center">No <br>(a)</th>
                        <th class="text-center">Komponen <br>(b)</th>
                        <th class="text-center">Sub Komponen <br>(c)</th>
                        <th class="text-center">Seluruh Bangunan <br>(d)</th>
                        <th class="text-center">Tingkat Kerusakan <br>(e)</th>
                        <th class="text-center">Nilai Kerusakan <br>(f = (d x e))</th>
                    </tr>
                </thead>
                @php
                $i = 1;
                @endphp
                <tbody>
                    @foreach($kondisi as $data)
                    <tr>
                        <td class="text-center">{{ $i++ }}</td>
                        <td class="">{{ $data->nama_komponen }}</td>
                        <td class="">{{ $data->sub_komponen }}</td>
                        <td class="text-center">{{ $data->ts_bangunan }}</td>
                        <td class="text-center">{{ $data->t_kerusakan }}</td>
                        <td class="text-center">{{ $data->n_kerusakan }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('moreJS')
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js"></script>
<script>
    $(document).ready(function(){
        $('#table-lihat').DataTable({
            "autoWidth": true,
            "ordering": false,
        });
    });
</script>
@endsection