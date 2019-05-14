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
    <span class="breadcrumb-item active">Download Laporan</span>
</nav>
<div class="block">
    <div class="block-header block-header-default bg-primary">
        <h3 class="block-title">Download Laporan</h3>
    </div>
    <div class="block-content">
        <a class="btn btn-sm bg-earth text-white mb-3" href="{{ base_url('/Download/laporan_kondisi_sekolah/') }}" target="_blank"><i class="fa fa-download"></i><span class="ml-2">Download Laporan Kondisi Ruang Seluruh Sekolah</span></a>
        <div class="table-responsive">
            <table id="table-ruang" class="stripe table table-stripped">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">NPSN</th>
                        <th class="">Nama Sekolah</th>
                        <th class="">Kecamatan</th>
                        <th class="text-center">Jumlah Ruang</th>
                        <th class="text-center">Aksi Download</th>
                    </tr>
                </thead>
                @php
                $i = 1;
                @endphp
                <tbody>
                    @foreach($sekolah as $data)  
                        @foreach($sum as $jumlah)
                            @if($data->username_update==$this->session->user_login['username'] || $this->session->user_login['id_role']==1 || $this->session->user_login['id_role']==2)
                                @if($data->npsn==$jumlah->npsn)
                                    <tr>
                                        <td class="text-center">{{ $i++ }}</td>
                                        <td class="text-center">{{ $data->npsn }}</td>
                                        <td class="" style="min-width: 150px">{{ $data->nama_sekolah }}</td>
                                        <td class="" style="min-width: 150px">{{ $data->kecamatan }}</td>
                                        <td class="text-center">{{ $jumlah->jumlah }}</td>
                                        <td class="text-center" style="min-width: 370px">
                                            <a href="{{ base_url('Download/lihat_ruang/'.$data->npsn) }}" class="btn btn-sm btn-primary mr-5"><i class="fa fa-download"></i><span class="ml-2">Laporan Tiap Ruang</span></a>
                                            <!-- @if($data->layout_plan1 && $data->layout_plan2 && $data->layout_plan3)
                                                 <a href="{{ base_url('/Download/laporan_layout_plan/'.$data->npsn) }}" class="btn btn-sm bg-earth text-white mr-5" target="_blank"><i class="fa fa-download"></i><span class="ml-2">Layout Plan</span></a>
                                            @endif -->
                                            <a class="btn btn-sm btn-danger" href="{{ base_url('/Download/all/'.$data->npsn) }}" target="_blank"><i class="fa fa-download"></i><span class="ml-2">Laporan Semua Ruang</span></a>
                                        </td>
                                    </tr>
                                @endif
                            @endif
                        @endforeach
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
        $('#table-ruang').DataTable({
            "autoWidth": true,
            "ordering": false,
        });
    });
</script>
@endsection