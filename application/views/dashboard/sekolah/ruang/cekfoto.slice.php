@extends('layouts.base.app')
@section('title', ' Foto Ruang Sekolah')

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
    <a class="breadcrumb-item" href="{{ base_url('SekolahController/ruangSekolah') }}">Ruang Sekolah</a>
    <a class="breadcrumb-item" href="{{ base_url('SekolahController/lihatRuang/'.$sekolah->npsn) }}">Ruang {{ $sekolah->nama_sekolah }}</a>
    <a class="breadcrumb-item" href="{{ base_url('SekolahController/fotoRuang/'.$ruang->kode_ruang.'/'.$sekolah->npsn) }}">Foto Ruang {{ $ruang->nama_ruang }}</a>
    <span class="breadcrumb-item active">Cek Foto</span>
</nav>
<div class="row">
    <div class="col-md-6">
        
    </div>
</div>
<div class="block">
    <div class="block-header block-header-default bg-primary">
        <h3 class="block-title">Cek Foto Ruang {{ $ruang->nama_ruang }} - {{ $sekolah->nama_sekolah }}</h3>
    </div>
    <div class="block-content">
        <div class="table-responsive">
            <table id="table-foto" class="stripe table table-stripped">
                <thead>
                    <tr>
                        <th class="text-center">Keterangan</th>
                        <th class="text-center">Foto</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($foto as $data)
                        <tr>
                            <td class="text-center">{{ $data->keterangan_foto }}</td>
                            <td class=""><img class="img-fluid" src="https://ruangdata.net//upload/fotoruang/{{ str_replace(' ', '_', $data->nama_foto) }}" alt=""></td>
                            <td class="text-center">
                                <button value="{{ base_url('SekolahController/hapusFoto/'.$data->kode_foto.'/'.$ruang->kode_ruang.'/'.$sekolah->npsn) }}" class="btn btn-sm btn-danger hapus-satu"><i class="fa fa-trash mr-2"></i> Hapus</button>
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
        $('#table-foto').DataTable({
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