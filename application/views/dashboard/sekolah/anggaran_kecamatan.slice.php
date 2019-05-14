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
    <span class="breadcrumb-item active">Anggaran Sekolah Tiap Kecamatan</span>
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
                        <th class="">Kecamatan</th>
                        <th class="">Total Anggaran</th>
                    </tr>
                </thead>
                @php
                    $i = 1;
                @endphp
                <tbody>
                    @foreach($harga as $data)
                    <tr>
                        <td class="text-center">{{ $i++ }}</td>
                        <td class="">{{ $data->kecamatan }}</td>
                        @php
                            $data->total_anggaran = round($data->total_anggaran, -3);
                            $data->total_anggaran = "Rp " . number_format($data->total_anggaran,2,',','.');
                            // $data->total_anggaran = number_format($data->total_anggaran, -3);
                        @endphp
                        <td class="">{{ $data->total_anggaran }}</td>
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