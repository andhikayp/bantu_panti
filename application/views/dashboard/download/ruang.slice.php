@extends('layouts.base.app')
@section('title', ' Ruang Sekolah')

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
    <a class="breadcrumb-item" href="{{ base_url('PetugasController/downIndex') }}">Download Laporan</a>
    <span class="breadcrumb-item active">Laporan Per Ruang {{ $sekolah->nama_sekolah }}</span>
</nav>
<div class="block">
    <div class="block-header block-header-default bg-primary">
        <h3 class="block-title">Laporan Per Ruang {{ $sekolah->nama_sekolah }}</h3>
    </div>
    <div class="block-content">
        <a class="btn btn-sm btn-danger" href="{{ base_url('/Download/laporan_analisa_kerusakan/'.$sekolah->npsn) }}" target="_blank"><i class="fa fa-download"></i><span class="ml-2">Cover</span></a>
        @if($sekolah->layout_plan1 && $sekolah->layout_plan2 && $sekolah->layout_plan3)
            <a href="{{ base_url('/Download/laporan_layout_plan/'.$sekolah->npsn) }}" class="btn btn-sm bg-earth text-white mr-5" target="_blank"><i class="fa fa-download"></i><span class="ml-2">Layout Plan</span></a>
        @endif
        <div class="table-responsive mt-4">
            <table id="table-lihat" class="stripe table table-stripped">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Nama Ruang</th>
                        <th class="text-center">Aksi Download</th>
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
                            <a class="btn btn-sm btn-primary" href="{{ base_url('/Download/laporan_analisa_kerusakan_tiap_ruang/'.$data->kode_ruang.'/'.$data->npsn) }}" target="_blank"><i class="fa fa-download"></i><span class="ml-2">Laporan Analisa Kerusakan</span></a>
                            <a class="btn btn-sm btn-primary" href="{{ base_url('/Download/foto_tiap_ruang/'.$data->kode_ruang) }}" target="_blank"><i class="fa fa-download"></i><span class="ml-2">Laporan Foto Ruang</span></a>
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
<script>
    $(".hapus-satu").click(function(){
        var link = ($(this).val())
        swal({
            title: 'Apakah anda yakin untuk menghapus ruang ini?',
            text: "Data Ruang akan hilang setelah anda menekan tombol 'Ya'",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak',
            closeOnConfirm: true
            }).then((result) => {
            if (result.value) {
                window.location.href = link;
            }
            });
    });
</script>
@endsection