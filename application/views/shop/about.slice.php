@extends('layouts.base.app')
@section('title', ' Dashboard')

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
    <a class="breadcrumb-item" href="#">Dashboard</a>
    <span class="breadcrumb-item active">Index</span>
</nav>
<div class="block">
    <div class="block-header block-header-default bg-primary">
        <h3 class="block-title">About Us</h3>
    </div>
    <div class="block-content">
        <div id="body">
            <div>
                <h2>
                    A fresh approach to websites, apps and software development 
                </h2>
            </div>
            <div>
                <h3>
                    We’ve launched thousands of websites over the past 1 years with clients ranging from ... to ... Get started today and discover how our development team can help companies like yours to achieve your target. 
                </h3>
            </div>
        </div>
    </div>
</div>
@endsection