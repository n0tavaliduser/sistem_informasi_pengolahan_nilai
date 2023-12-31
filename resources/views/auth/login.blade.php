@extends('layouts.master-without-nav')
@section('title')
    LOGIN
@endsection
@section('content')

<!-- auth-page wrapper -->
<div class="auth-page-wrapper py-5 d-flex justify-content-center align-items-center min-vh-100" style="
        background-image: url({{ URL::asset('assets/img/bg1.jpg') }});
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
    ">
    <div class="bg-overlay" style="opacity: 0.4">
    </div>
    <div class="d-flex" style="position: absolute; padding-top: 30px; padding-left: 30px; left: 2rem; top: 1rem;">
        <div class="d-flex gap-3 justify-content-center align-items center">
            <img src="{{ URL::asset('assets/img/logo.png') }}" alt="" height="50">
            <div class="d-grid align-items-center">
                <h5 class="text-light">APN - SMKN1MAROS</h5>
                <h6 class="text-light">Jl. Ps. Ikan No.63, Allepolea</h6>
            </div>
        </div>
    </div>
    <!-- auth-page content -->
    <div class="auth-page-content overflow-hidden pt-lg-5">
        <div class="container d-flex flex-column justify-content-center align-items-center">
            <h2 class="mb-4 text-light">Selamat Datang</h2>
            <div class="card overflow-hidden bg-white bg-opacity-50 col-lg-6">
                <div class="row g-0">
                    <div class="col-lg-12">
                        <div class="p-lg-5 p-4">
                            <h3 class="mb-4 text-center text-dark">LOGIN</h3>
                            <div class="mt-0">
                                <form action="{{ route('login') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1"><i class="ri-shield-user-fill"></i></span>
                                            <input type="email" id="email" name="email" value="{{ old('email', 'admin@smk.com') }}" class="form-control @error('email') is-invalid @enderror" placeholder="Masukan E-mail" aria-label="email" aria-describedby="basic-addon1">
                                        </div>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1"><i class="ri-lock-password-fill"></i></span>
                                            <input type="password" id="password" name="password" value="{{ old('password', 'abcd1234') }}" class="form-control @error('password') is-invalid @enderror" placeholder="Masukan Password" aria-label="password" aria-describedby="basic-addon1">
                                        </div>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                        </div>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="auth-remember-check">
                                        <label class="form-check-label" for="auth-remember-check">Remember
                                            me</label>
                                    </div>

                                    <div class="mt-4">
                                        <button class="btn btn-success w-100" type="submit">Sign In</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end card -->
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
</div>
<!-- end auth-page-wrapper -->

@endsection
@section('script')
<script src="{{ URL::asset('build/js/pages/password-addon.init.js') }}"></script>
@endsection
