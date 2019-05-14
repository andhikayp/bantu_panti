@extends('layouts.base.app')
@section('title', ' Upload Layout Plan')

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
    <span class="breadcrumb-item active">Upload Layout Plan {{ $sekolah->nama_sekolah }}</span>
</nav>
<div class="block">
    <div class="block-header block-header-default bg-primary">
        <h3 class="block-title">Upload Layout Plan {{ $sekolah->nama_sekolah }}</h3>
    </div>
    <div class="block-content">
        <form class="js-validation-signup px-30" method="POST" enctype="multipart/form-data" action="{{ base_url('PetugasController/uploadLayout/'.$sekolah->npsn) }}" aria-label="">
            <div class="row">
                <div class="col-4">
                    <div class="form-group row">
                        <label class="col-12" for="layout_plan1">Layout Plan Lantai 1</label>
                        <div class="col-12">
                            <input type="file" id="layout_plan1" name="file[]" paria-describedby="upload">
                        </div>
                    </div>
                    <span class="badge badge-info">Kosongi Jika Tidak Ada</span>
                    <span class="badge badge-danger">Format JPG atau PNG</span>
                </div>
                <div class="col-4">
                    <div class="form-group row">
                        <label class="col-12" for="layout_plan2">Layout Plan Lantai 2</label>
                        <div class="col-12">
                            <input type="file" id="layout_plan2" name="file[]" paria-describedby="upload">
                        </div>
                    </div>
                    <span class="badge badge-info">Kosongi Jika Tidak Ada</span>
                    <span class="badge badge-danger">Format JPG atau PNG</span>
                </div>
                <div class="col-4">
                    <div class="form-group row">
                        <label class="col-12" for="layout_plan3">Layout Plan Lantai 3</label>
                        <div class="col-12">
                            <input type="file" id="layout_plan3" name="file[]" paria-describedby="upload">
                        </div>
                    </div>
                    <span class="badge badge-info">Kosongi Jika Tidak Ada</span>
                    <span class="badge badge-danger">Format JPG atau PNG</span>
                </div>
            </div>
            <hr/><div class="row mb-2">
                <div class="col-3"></div>
                    <a class="col-3 btn btn-danger" href="{{ base_url('PetugasController/upIndex') }}">Cancel</a>&nbsp
                    <button type="submit" class="col-3 btn bg-earth text-white">Submit</button>
                <div class="col-3"></div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('moreJS')

@endsection