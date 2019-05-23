@extends('layouts.base.app')
@section('title', ' Manajemen User')

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
    <span class="breadcrumb-item active">Riwayat Pengeluaran</span>
</nav>
<div class="block">
    <div class="block-header block-header-default bg-primary">
        <h3 class="block-title">Riwayat Pengeluaran</h3>
    </div>
    <div class="block-content">
        <a href="{{ base_url('PengeluaranController/tambahPengeluaran') }}" class="btn btn-sm bg-earth text-white mb-3"><i class="fa fa-plus mr-2"></i>Tambah Pengeluaran</a>
        <div class="table-responsive">
            <table id="table-ruang" class="stripe table table-stripped">
                <thead>
                    <tr>
                        <th class="text-center">ID Pengeluaran</th>
                        <!-- <th class="text-center">Username Donatur</th> -->
                        <th class="text-center">Jumlah Pengeluaran</th>
                        <th class="text-center">Tanggal Pengeluaran</th>
                        <th class="text-center" style="width: 40%">Keterangan Donasi</th>
                        <!-- <th class="text-center">Aksi</th> -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($pengeluaran as $data)
                    <tr>
                        <td class="text-center">{{ $data->id_pengeluaran }}</td>
                        <!-- <td class="" style="min-width: 150px">{{ $data->username_donatur }}</td> -->
                        <td class="text-center">{{ $data->nominal_pengeluaran }}</td>
                        <td class="text-center">{{ $data->tanggal_pengeluaran }}</td>
                        <td class="text-center" style="width: 40%">{{ $data->keterangan_pengeluaran }}</td>
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
        $('#table-ruang').DataTable({
            "autoWidth": true,
            "ordering": false,
        });
    });
</script>

<script>
    $(".hapus-satu").click(function(){
        var link = ($(this).val())
        swal({
            title: 'Apakah anda yakin untuk menghapus user ini?',
            text: "Data User akan hilang setelah anda menekan tombol 'Ya'",
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