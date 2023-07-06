@extends('layouts.auth')

@section('title')
    Store Email Confirmation Page
@endsection

@section('content')
<!-- Page Content -->
        <div class="page-content page-auth">
            <div class="section-store-auth" data-aos="fade-up">
                <div class="container">
                    <div class="row align-items-center row-login">
                        <div class="col-lg-5 text-center d-none d-lg-block">
                            <img
                                src="/images/setting-pic.jpg"
                                alt=""
                                class="w-50 mb-4 mb-lg-none"
                            />
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col-12">
                                    <div class="setting-header">
                                        <h2 class="setting-title">Confirm Email</h2>
                                        <p class="setting-subtitle">Konfirmasi emailmu untuk reset password</p>
                                    </div>
                                </div>   
                                
                                <div class="col-12">
                                    <div class="setting-content">
                                        <div class="row">
                                        <div class="col-8">
                                            <form action="{{ route('password.email') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="card">
                                                <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="email">Alamat Email</label>

                                                            @if (session('status'))
                                                                <div class="alert alert-success" role="alert">
                                                                    {{ session('status') }}
                                                                </div>
                                                            @endif

                                                            <input id="email" type="email" class="mt-2 form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                                            @error('email')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                            </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 mt-3">
                                                        <a href="{{ route('login') }}" class="btn btn-signup">
                                                            Balik ke Masuk
                                                        </a>
                                                    </div>
                                                    <div class="col-6 text-right mt-3">
                                                    <button type="submit" class="btn btn-success">
                                                        Reset Password
                                                    </button>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection


                
                    <div class="row justify-content-center" style="display: none">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">{{ __('Reset Password') }}</div>

                                <div class="card-body">
                                    @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                    @endif

                                    <form method="POST" action="{{ route('password.email') }}">
                                        @csrf

                                        <div class="row mb-3">
                                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                            <div class="col-md-6">
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-0">
                                            <div class="col-md-6 offset-md-4">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('Send Password Reset Link') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>