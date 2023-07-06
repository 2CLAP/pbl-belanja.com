@extends('layouts.success')

@section('title')
    Store Success Page
@endsection

@section('content')
    <div class="page-content page-success">
      <div class="section-success" data-aos="zoom-in">
        <div class="container">
          <div class="row align-items-center row-login justify-content-center">
            <div class="col-lg-6 text-center">
              <img src="/images/success.svg" alt="" class="mb-4" />
              <h2>Transaksimu telah diproses!</h2>
              <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem
                recusandae quibusdam perferendis.
              </p>
              <div>
                <a href="{{ route('home') }}" class="btn btn-success w-50 mt-3">
                  Lanjutkan Belanja
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection