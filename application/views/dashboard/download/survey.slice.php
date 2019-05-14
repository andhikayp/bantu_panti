@extends('layouts.base.app')
@section('title', 'Download')

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
    <span class="breadcrumb-item active">Pelaksanaan Survey</span>
</nav>
<div class="block">
    <div class="block-header block-header-default bg-primary">
        <h3 class="block-title">Laporan Hasil Survey</h3>
    </div>
    <div class="block-content">
        <a href="{{ base_url('PetugasController/survey') }}" class="btn btn-sm bg-earth text-white mb-3"><i class="fa fa-plus mr-2"></i>Tambah Pelaksanaan Survey</a>
        <div class="block-content">
            <div class="table-responsive">
                <table id="table-ruang" class="stripe table table-stripped">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="">Nama Petugas</th>
                            <th class="">Tempat Pelaksanaan</th>
                            <th class="">PJ Sekolah</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Jam</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    @php
                    $i = 1;
                    @endphp
                    <tbody>
                        @foreach($survey as $data)
                        <tr>
                            <td class="text-center">{{ $i++ }}</td>
                            @foreach($petugas as $nama)
                                @if($nama->username==$data->petugas)
                                    <td class="">{{ $nama->nama_petugas }}</td>
                                @endif
                            @endforeach
                            <td class="">{{ $data->tempat_pelaksanaan }}</td>
                            <td class="">{{ $data->pihak_sekolah }}</td>
                            <td class="text-center">{{ $data->tanggal}}</td>
                            <td class="text-center">{{ $data->jam}}</td>
                            <td class="" style="min-width: 130px">
                                @if($this->session->user_login['username']==$data->petugas)
                                    <a href="{{ base_url('PetugasController/hapus_survey/'.$data->id.'/'.$data->jam) }}" class="btn btn-sm btn-danger btn-block"><i class="fa fa-trash float-left"></i><span class="ml-3 float-left">Hapus Survey</span></a>
                                    <a href="{{ base_url('PetugasController/edit_survey/'.$data->id) }}" class="btn btn-sm btn-primary btn-block"><i class="fa fa-download float-left"></i><span class="ml-3 float-left">Edit Survey</span></a>
                                    
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('moreJS')
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js"></script>
<script>
    $(document).ready(function(){
        $('#table-ruang').DataTable({
            "autoWidth": true,
            "ordering": false,
        });
    });
</script>
@endsection