@extends('layouts.base.app')
@section('title', ' Data Sekolah')

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
    <span class="breadcrumb-item active">Data Sekolah</span>
</nav>
<div class="block">
    <div class="block-header block-header-default bg-primary">
        <h3 class="block-title">Data Sekolah</h3>
    </div>
    <div class="block-content">
        <div class="table-responsive">
            <table id="table-sekolah" class="stripe table table-stripped">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">NPSN</th>
                        <th class="">Nama Sekolah</th>
                        <th class="">Kepala Sekolah</th>
                        <th class="text-center">Kecamatan</th>
                        <th class="">Alamat Sekolah</th>
                        <th class="text-center">Status Survei</th>
                    </tr>
                </thead>
                @php
                    $i = 1;
                @endphp
                <tbody>
                    @foreach($sekolah as $data)
                    <tr>
                        <td class="text-center">{{ $i++ }}</td>
                        <td class="text-center">{{ $data->npsn }}</td>
                        <td class="">{{ $data->nama_sekolah }}</td>
                        <td class="">{{ $data->nama_kepala_sekolah }}</td>
                        <td class="">{{ $data->kecamatan }}</td>
                        <td class="">{{ $data->alamat_sekolah }}</td>
                        @if($data->username_update)
                            <td class="text-center"><button class="btn btn-sm btn-info" style="pointer-events:none"><i class="fa fa-check"></i> Sudah</button></td>
                        @else
                            <td class="text-center"><button class="btn btn-sm btn-danger" style="pointer-events:none"><i class="fa fa-close"></i> Belum</button></td>
                        @endif
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
        $('#table-sekolah').DataTable({
            "autoWidth": true,
            "ordering": false,
        });
    });
</script>
@endsection