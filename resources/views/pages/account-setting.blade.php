@extends('layouts.app')

@section('title')
    Account Setting Page
@endsection

@section('content')
    <!-- Page Content -->
    <div class="page-content page-setting">
      <div class="section-setting" data-aos="fade-up">
        <div class="container">
          <div class="row align-items-center justify-content-center">
            <div class="col-lg-5 text-center d-none d-lg-block">
              <img
                src="/images/setting-pic.jpg"
                alt=""
                class="w-50 mb-4 mb-lg-none"
              />
            </div>
            <div class="col-12 col-lg-7">
              <div class="row">
                <div class="col-12">
                  <div class="setting-header">
                    <h2 class="setting-title">Pengaturan Akun</h2>
                    <p class="setting-subtitle">Kelola akunmu di sini</p>
                  </div>
                </div>
                <div class="col-12">
                  <div class="setting-content">
                    <div class="row">
                      <div class="col-12 col-lg-10">
                        <form action="{{ route('account-redirect','account') }}" method="POST" enctype="multipart/form-data">
                          @csrf
                          <div class="card">
                            <div class="card-body">
                              <div class="row">
                                <div class="col-12">
                                  <div class="form-group">
                                    <label for="name">Username</label>
                                    <input
                                      type="text"
                                      class="form-control"
                                      id="name"
                                      name="name"
                                      value="{{ $user->name }}"
                                    />
                                  </div>
                                </div>
                                <div class="col-12">
                                  <div class="form-group">
                                    <label for="email">Alamat Email</label>
                                    <input
                                      type="email"
                                      class="form-control"
                                      id="email"
                                      name="email"
                                      value="{{ $user->email }}"
                                    />
                                  </div>
                                </div>
                                <div class="col-12">
                                  <div class="form-group">
                                    <label for="number">Nomor Telpon</label>
                                    <input
                                      type="text"
                                      class="form-control"
                                      id="phone_number"
                                      name="phone_number"
                                      value="{{ $user->phone_number }}"
                                    />
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col text-right mt-3">
                                  <button type="submit" class="btn btn-success">
                                    Simpan Perubahan
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