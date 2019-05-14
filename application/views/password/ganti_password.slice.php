@extends('layouts.base.app')
@section('judul', 'Ganti Password ')

@section('header')
    @include('layouts.base.header')
@endsection

@section('sidebar')
    @include('layouts.base.sidebar')
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
    <span class="breadcrumb-item active">Ganti Password</span>
</nav>
<div class="block">
    <div class="block-header block-header-default bg-primary">
        <h3 class="block-title">Form Ganti Password</h3>
    </div>
    <div class="block-content">
        <form action="{{ base_url('password/ganti_password') }}" method="post">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">@</span>
                </div>
                <input type="password" class="form-control" name="password_lama" placeholder="Password Lama">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-unlock"></i></span>
                </div>
                <input type="password" class="form-control" name="password_baru" placeholder="Password Baru">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-refresh"></i></span>
                </div>
                <input type="password" class="form-control" name="konfirmasi_password_baru" placeholder="Ulangi Password Baru">
            </div>
            <div class="text-right">
                <button class="btn btn-primary" type="submit">Ganti Password</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('footer')
    @include('layouts.base.footer')
@endsection


