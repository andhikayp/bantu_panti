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
    <a class="breadcrumb-item" href="{{ base_url('SekolahController/ruangSekolah') }}">Ruang Sekolah</a>
    <span class="breadcrumb-item active">Lihat Ruang {{ $sekolah->nama_sekolah }}</span>
</nav>
<div class="block">
    <div class="block-header block-header-default bg-primary">
        <h3 class="block-title">Lihat Ruang {{ $sekolah->nama_sekolah }}</h3>
    </div>
    <div class="block-content">
        <a href="{{ base_url('SekolahController/tambahRuang/'.$sekolah->npsn) }}" class="btn btn-sm bg-earth text-white"><i class="fa fa-plus"></i> Tambah Ruang</a>
        <div class="table-responsive mt-4">
            <table id="table-lihat" class="stripe table table-stripped">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Nama Ruang</th>
                        <!-- <th class="text-center">Luas Ruang</th> -->
                        <th class="text-center">Tipe Bangunan</th>
                        <th class="text-center">Jenis Bangunan</th>
                        <th class="text-center">Rencana Rehab</th>
                        <th class="text-center">Tahun Dibangun</th>
                        <th class="text-center">Rehab Ke</th>
                        <th class="text-center"></th>
                        <th class="text-center">Aksi</th>
                        <th class="text-center"></th>
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
                        <!-- <td class="text-center">{{ $data->luas_ruang }} m<sup>2</sup></td> -->
                        <td class="text-center">{{ $data->tipe_bangunan }}</td>
                        @if($data->jenis_bangunan == 1)
                            <td class="text-center">1 Lantai</td>
                        @elseif($data->jenis_bangunan == 2)
                            <td class="text-center">2 Lantai</td>
                        @elseif($data->rencana_rehab == 3)
                            <td class="text-center">3 Lantai</td>
                        @else
                            <td class="text-center">-</td>
                        @endif
                        @if($data->rencana_rehab == 1)
                            <td class="text-center">Lantai Dasar</td>
                        @elseif($data->rencana_rehab == 2)
                            <td class="text-center">Lantai 2</td>
                        @elseif($data->rencana_rehab == 3)
                            <td class="text-center">Lantai 3</td>
                        @else
                            <td class="text-center">-</td>
                        @endif
                        <td class="text-center">{{ $data->tahun_dibangun }}</td>
                        <td class="text-center">{{ $data->rehab_ke }}</td>
                        <td class="text-center" style="min-width: 110px">
                            <a href="{{ base_url('SekolahController/fotoRuang/'.$data->kode_ruang.'/'.$data->npsn) }}" class="btn btn-sm bg-success text-white"><i class="fa fa-image float-left mr-2"></i> Foto Ruang</a>
                        </td>
                        <td class="text-center" style="min-width: 80px">
                            <a href="{{ base_url('SekolahController/ubahRuang/'.$data->kode_ruang.'/'.$data->npsn) }}" class="btn btn-sm bg-primary text-white"><i class="fa fa-pencil float-left mr-2"></i> Ubah</a>
                        </td>
                        <td class="text-center" style="min-width: 80px">
                            <button value="{{ base_url('SekolahController/hapusRuang/'.$data->kode_ruang.'/'.$data->npsn) }}" class="btn btn-sm btn-danger hapus-satu"><i class="fa fa-trash float-left mr-2"></i> Hapus</btn>
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