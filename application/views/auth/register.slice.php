@extends('layouts.auth.app')
@section('title', 'Masuk')

@section('content')
<!-- Page Content -->
<div class="bg-image" style="background-image: url('http://localhost/bantu_panti//upload/DSC_3038.JPG');">
    <div class="row mx-0 bg-black-op">
        <div class="hero-static col-md-6 col-xl-8 d-none d-md-flex align-items-md-end">
            <div class="p-30 invisible" data-toggle="appear">
                <p class="font-size-h3 font-w600 text-white">
                    Bantu Panti adalah aplikasi yang dapat mempermudah donatur untuk menyumbangkan donasi ke Panti Asuhan BJ Habibie  di wilayah Surabaya dan sekitarnya.
                </p>
                <p class="font-italic text-white-op">
                    Copyright &copy; Bantu Panti  <span class="js-year-copy"></span>
                </p>
            </div>
        </div>
        <div class="hero-static col-md-6 col-xl-4 d-flex align-items-center bg-white invisible" data-toggle="appear" data-class="animated fadeInRight">
            <div class="content content-full">
                <div class="px-30 py-10 text-center">
                    <img src="http://localhost/bantu_panti//upload/paket_20190127-082258.png" alt="Logo Sidoarjo" width="50%" height="100%"><br>
                    <a class="link-effect font-w700" href="index.html">
                        <span class="font-size-xl text-primary-dark">Panti Asuhan</span> <span class="font-size-xl">BJ Habibie</span>
                    </a>
                </div>
                <!-- Header -->
                <div class="px-30 py-10">
                    
                    <h1 class="h3 font-w700 mt-30 mb-10">Selamat Datang di Bantu Panti</h1>
                    <h2 class="h5 font-w400 text-muted mb-0">Buat Akun Donatur</h2>
                </div>
                <!-- END Header -->

                <!-- Sign In Form -->
                <!-- jQuery Validation functionality is initialized with .js-validation-signin class in js/pages/op_auth_signin.min.js which was auto compiled from _es6/pages/op_auth_signin.js -->
                <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
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
                <form id="login-form" class="js-validation-signin px-30" action="{{ base_url('auth/dologin') }}" method="post">
                    <div class="form-group row">
                        <div class="col-12">
                            <div class="form-material form-material-primary floating">
                                <input type="text" class="form-control" id="loginUsername" name="loginUsername">
                                <label for="loginUsername">Username</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <div class="form-material form-material-primary floating">
                                <input type="password" class="form-control" id="loginPassword" name="loginPassword">
                                <label for="loginPassword">Password</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <div class="form-material form-material-primary floating">
                                <input type="password" class="form-control" id="loginPassword" name="loginPassword">
                                <label for="loginPassword">Confirm Password</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="login-remember-me" name="login-remember-me">
                                <label class="custom-control-label" for="login-remember-me">Remember Me</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <span>
                            <button type="submit" class="btn btn-sm btn-hero btn-alt-primary">
                                <i class="si si-login mr-10"></i> Masuk
                            </button>
                            <!-- <button  class="btn btn-sm btn-hero btn-alt-danger" style="float: right;">
                                <a href="{{ base_url('auth/register') }}">
                                    <i class="si si-login mr-10"></i> Buat Akun
                                </a>
                            </button> -->
                        </span>
                        <!-- <div class="mt-30">
                            <a class="link-effect text-muted mr-10 mb-5 d-inline-block" href="op_auth_signup2.html">
                                                <i class="fa fa-plus mr-5"></i> Create Account
                                            </a>
                            <a class="link-effect text-muted mr-10 mb-5 d-inline-block" href="op_auth_reminder2.html">
                                                <i class="fa fa-warning mr-5"></i> Forgot Password
                                            </a>
                        </div> -->
                    </div>
                </form>
                <!-- END Sign In Form -->
            </div>
        </div>
    </div>
</div>
<!-- END Page Content -->
@endsection