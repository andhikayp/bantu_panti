@extends('layouts.base.app')
@section('title', ' Lihat Kondisi Sekolah')

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
    <span class="breadcrumb-item active">Lihat Kondisi {{ $sekolah->nama_sekolah }}</span>
</nav>
<div class="block">
    <div class="block-header block-header-default bg-primary">
        <h3 class="block-title">Lihat Kondisi {{ $sekolah->nama_sekolah }}</h3>
    </div>
    <div class="block-content">
        <div class="table-responsive">
            <table id="table-lihat" class="stripe table table-stripped">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="">Nama Ruang</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                @php
                $i = 1;
                @endphp
                <tbody>
                    @foreach($ruang as $data)
                    <tr>
                        <td class="text-center">{{ $i++ }}</td>
                        <td class="">{{ $data->nama_ruang }}</td>
                        <td class="text-center">
                            <a href="{{ base_url('SekolahController/lihatKondisiRuang/'.$data->kode_ruang.'/'.$sekolah->npsn) }}" class="btn btn-sm btn-primary mr-5"><i class="fa fa-search"></i> Informasi dan Kesimpulan</a>
                            <a href="{{ base_url('SekolahController/uploadKondisi/'.$data->kode_ruang.'/'.$sekolah->npsn) }}" class="btn btn-sm btn-danger"><i class="fa fa-upload"></i> Upload & Lihat Kondisi</a>
                            <a href="{{ base_url('SekolahController/kesimpulanKondisi/'.$data->kode_ruang.'/'.$sekolah->npsn) }}" class="btn btn-sm bg-earth text-white"><i class="fa fa-list"></i> Kesimpulan Kondisi Ruang</a>
                        </td>
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