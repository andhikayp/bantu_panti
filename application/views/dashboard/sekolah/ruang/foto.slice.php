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
    <span class="breadcrumb-item active">Foto {{ $ruang->nama_ruang }}</span>
</nav>
<div class="row">
    <div class="col-md-6">
        
    </div>
</div>
<div class="block">
    <div class="block-header block-header-default bg-primary">
        <h3 class="block-title">Foto Ruang {{ $ruang->nama_ruang }} - {{ $sekolah->nama_sekolah }}</h3>
    </div>
    <div class="block-content">
        <form name="add_name" id="add_name" method="POST" enctype="multipart/form-data" action="{{ base_url('SekolahController/saveFotoRuang/'.$ruang->kode_ruang.'/'.$sekolah->npsn) }}">
            <a href="{{ base_url('SekolahController/cekFotoRuang/'.$ruang->kode_ruang.'/'.$sekolah->npsn) }}" class="pull-left btn bg-earth text-white mb-10"><i class="fa fa-eye"></i> Lihat Foto</a>
            <div class="table-responsive">
                <table class="table" id="dynamic_field">
                    <tr>
                        <td><input type="file" name="file[]" placeholder="Foto" class="form-control name_list" /></td>
                        <td><input type="text" name="keterangan_foto[]" placeholder="Keterangan Foto" class="form-control name_list" /></td>
                        <td><button type="button" name="add" id="add" class="btn btn-success">Tambah Lagi</button></td>
                    </tr>
                </table>
            </div>
            <hr/><div class="row mb-2">
                <div class="col-3"></div>
                    <a class="col-3 btn btn-danger" href="{{ base_url('SekolahController/lihatRuang/'.$sekolah->npsn) }}">Cancel</a>&nbsp
                    <button type="submit" class="col-3 btn bg-earth text-white">Submit</button>
                <div class="col-3"></div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('moreJS')
<script>
    $(document).ready(function(){  
        var i=1;  
        $('#add').click(function(){  
             i++;  
             $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="file" name="file[]" placeholder="Enter your Name" class="form-control name_list" /></td><td><input type="text" name="keterangan_foto[]" placeholder="Keterangan Foto" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
        });  
        $(document).on('click', '.btn_remove', function(){  
             var button_id = $(this).attr("id");   
             $('#row'+button_id+'').remove();  
        });
   });  
</script>
@endsection