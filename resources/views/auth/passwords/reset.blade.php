@extends('layouts.auth')

@section('title')
    Store Reset Password Page
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
                                        <h2 class="setting-title">Reset Password</h2>
                                        <p class="setting-subtitle">Perbarui password mu</p>
                                    </div>
                                </div>   
                                
                                <div class="col-12">
                                    <div class="setting-content">
                                        <div class="row">
                                        <div class="col-10">
                                            <form action="{{ route('password.update') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="token" value="{{ $token }}">
                                            <div class="card">
                                                <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="email">Alamat Email</label>

                                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                                            @error('email')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="password">Password Baru</label>

                                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                                            @error('password')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="password-confirm">Konfirmasi Password</label>

                                                            {{-- <input id="password" type="password" class="mt-2 form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password"> --}}
                                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col text-right mt-3">
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

@section('content')
<div class="container" style="display: none">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
