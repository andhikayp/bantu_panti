@extends('layouts.base.app')
@section('title', ' Lihat Layout Plan')

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
    <a class="breadcrumb-item" href="{{ base_url('PetugasController/upIndex') }}">Upload</a>
    <span class="breadcrumb-item active">Lihat Layout Plan {{ $sekolah->nama_sekolah }}</span>
</nav>
<div class="block">
    <div class="block-header block-header-default bg-primary">
        <h3 class="block-title">Lihat Layout Plan {{ $sekolah->nama_sekolah }}</h3>
    </div>
    <div class="block-content">
        <h4><i class="fa fa-arrow-right mr-5 mb-5"></i><b>Layout Plan Lantai 1</b></h4>
        <div class="row items-push">
            <div class="col-md-12">
                <div class="options-container">
                    <img class="img-fluid" src="https://ruangdata.net//upload/layoutplan/{{ str_replace(' ', '_', $sekolah->layout_plan1) }}" alt="">
                </div>
            </div>
        </div>
        <h4><i class="fa fa-arrow-right mr-5 mb-5"></i><b>Layout Plan Lantai 2</b></h4>
        <div class="row items-push">
            <div class="col-md-12">
                <div class="options-container">
                    <img class="img-fluid" src="https://ruangdata.net//upload/layoutplan/{{ str_replace(' ', '_', $sekolah->layout_plan2) }}" alt="">
                </div>
            </div>
        </div>
        <h4><i class="fa fa-arrow-right mr-5 mb-5"></i><b>Layout Plan Lantai 3</b></h4>
        <div class="row items-push">
            <div class="col-md-12">
                <div class="options-container">
                    <img class="img-fluid" src="https://ruangdata.net//upload/layoutplan/{{ str_replace(' ', '_', $sekolah->layout_plan3) }}" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('moreJS')

@endsection