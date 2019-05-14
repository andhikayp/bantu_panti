@extends('layouts.base.app')
@section('title', ' Upload')

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
    <span class="breadcrumb-item active">Upload</span>
</nav>
<div class="block">
    <div class="block-header block-header-default bg-primary">
        <h3 class="block-title">Upload</h3>
    </div>
    <div class="block-content">
    <div class="table-responsive">
            <table id="table-upload" class="stripe table table-stripped">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">NPSN</th>
                        <th class="">Nama Sekolah</th>
                        <th class="">Kecamatan</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                @php
                $i = 1;
                @endphp
                <tbody>
                    @foreach($sekolah as $data)
                        @if($data->username_update==$this->session->user_login['username'] || $this->session->user_login['id_role']==1 || $this->session->user_login['id_role']==2)
                        <tr>
                            <td class="text-center">{{ $i++ }}</td>
                            <td class="text-center">{{ $data->npsn }}</td>
                            <td class="" style="min-width: 150px">{{ $data->nama_sekolah }}</td>
                            <td class="" style="min-width: 150px">{{ $data->kecamatan }}</td>
                            <td class="text-center" style="min-width: 320px">
                                <a href="{{ base_url('PetugasController/uploadLayout/'.$data->npsn) }}" class="btn btn-sm btn-danger mr-5"><i class="fa fa-upload float-left mr-2"></i> Upload Layout Plan</a>
                                <a href="{{ base_url('PetugasController/lihatLayout/'.$data->npsn) }}" class="btn btn-sm btn-primary"><i class="fa fa-search float-left mr-2"></i> Lihat Layout Plan</a>
                            </td>
                        </tr>
                        @endif
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
        $('#table-upload').DataTable({
            "autoWidth": true,
            "ordering": false,
        });
    });
</script>
@endsection