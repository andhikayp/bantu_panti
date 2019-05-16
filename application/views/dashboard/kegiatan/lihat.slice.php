@extends('layouts.base.app')
@section('title', ' Lihat Kegiatan')

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
    <span class="breadcrumb-item active">Lihat Story Kegiatan</span>
</nav>
<div class="block">
    <div class="block-header block-header-default bg-primary">
        <h3 class="block-title">Lihat Story Kegiatan</h3>
    </div>
    <div class="block-content">
        <a href="{{ base_url('kegiatanController/tambahKegiatan/') }}" class="btn btn-sm bg-earth text-white"><i class="fa fa-plus"></i>Tambah Story Kegiatan</a>
        @foreach ($kegiatan as $post)
        <div class="table-responsive mt-4" style="border-radius: 25px; padding: 20px; border: solid; margin-bottom: 15px;">
            <div class="card">
                <div class="card-header card-header-padding">
                    <a class="post-title" href="" style="font-size: 25px;">{{ $post->nama_kegiatan}} </a> <br>
                    <div>
                        {{ $post->tanggal_dibuat }}. Dibuat oleh: {{$post->pembuat }}</a>
                    </div>
                </div>
                <div class="card-body">
                    <p style="margin: 15px;">
                        {{ substr($post->deskripsi_kegiatan,0,300). '...' }}
                        <a href="{{ base_url('kegiatanController/lihatDetailKegiatan/'.$post->id) }}">Lihat Selengkapnya</a>
                    </p>
                    <p>
                        @if( $this->session->user_login['username'] == $post->pembuat)
                        <div class="form-inline">
                            <a href="" style="margin-right: 6px;">
                                <button type="submit" class="btn btn-md btn-outline-success">Edit</button> 
                            </a><br>
                            <form class="" action="" method="post">
                                <button type="submit" class="btn btn-md btn-outline-danger">Delete</button> 
                            </form>
                        </div>
                        @endif
                    </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

