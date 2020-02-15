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
        <h3 class="block-title">About</h3>
    </div>
    <div class="block-content">
        <div id="body">
            <table>
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td>Andhika Yoga Perdana</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td><a href="gmail.com">andhikay24@gmail.com</a></td>
                </tr>
                <tr>
                    <td>No Telepon</td>
                    <td>:</td>
                    <td>081252043185</td>
                </tr>
                <tr>
                    <td>Twitter</td>
                    <td>:</td>
                    <td><a href="twitter.com">@Andhika_Yoga1</a></td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection