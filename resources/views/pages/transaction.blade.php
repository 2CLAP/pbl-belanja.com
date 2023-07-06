@extends('layouts.app')

@section('title')
    Store Transaction Page
@endsection

@section('content')
<!-- Section Content -->
          <div
            class="page-content page-transaction"
            data-aos="fade-down"
          >
            <div class="container">
              <div class="transaction-heading">
                <h4 class="transaction-title">Transaksi</h4>
                <p class="transaction-subtitle">
                  Barang impianmu kami proses dari awal sampai akhir
                </p>
              </div>
              <div class="transaction-content">
                <div class="row">
                  <div class="col-12 mt-2">
                    <ul
                        class="nav nav-pills mb-3"
                        id="pills-tab"
                        role="tablist"
                    >
                        <li class="nav-item" role="presentation">
                        <a
                            class="nav-link active"
                            id="pills-home-tab"
                            data-toggle="pill"
                            href="#pills-home"
                            role="tab"
                            aria-controls="pills-home"
                            aria-selected="true"
                            >Dalam proses</a
                        >
                        </li>
                        <li class="nav-item" role="presentation">
                        <a
                            class="nav-link"
                            id="pills-profile-tab"
                            data-toggle="pill"
                            href="#pills-profile"
                            role="tab"
                            aria-controls="pills-profile"
                            aria-selected="false"
                            >Sukses</a
                        >
                        </li>
                    </ul>
                    <div class="tab-content scroll-body" id="pills-tabContent">
                      <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        @forelse ($onProcessTransactions as $transaction)
                              <a
                            href="{{ route('transaction-details', $transaction->id) }}"
                            class="card card-list d-block"
                            >
                            <div class="card-body">
                                <div class="row d-flex align-items-center">
                                <div class="col-sm col-md-3 col-lg-2">
                                    <img
                                    src="{{ Storage::url($transaction->product->galleries->first()->photos ?? '') }}"
                                    alt=""
                                    class="w-75"
                                    />
                                </div>
                                <div class="col-md-2 col-lg-4 mt-3 mt-sm-3 mt-md-0 mt-lg-0">{{ $transaction->product->name }}</div>
                                <div class="col-md-2 col-lg-2">{{ $transaction->shipping_status }}</div>
                                <div class="col-md-5 col-lg-3">{{ $transaction->created_at }}</div>
                                <div class="col-lg-1 d-none d-md-none d-lg-block">
                                    <img src="/images/arrow_to_right.svg" alt="" />
                                </div>
                                </div>
                            </div>
                            </a>
                        @empty
                            <div
                                class="col-12 text-center py-5"
                                data-aos="fade-up"
                                data-aos-delay="100">
                                Belum ada transaksi baru
                            </div>
                        @endforelse
                      </div>
                      <div
                        class="tab-pane fade"
                        id="pills-profile"
                        role="tabpanel"
                        aria-labelledby="pills-profile-tab"
                      >
                        @forelse ($successTransactions as $transaction)
                        <a
                            href="{{ route('transaction-details', $transaction->id) }}"
                            class="card card-list d-block"
                            >
                            <div class="card-body">
                                <div class="row d-flex align-items-center">
                                <div class="col-sm col-md-3 col-lg-2">
                                    <img
                                    src="{{ Storage::url($transaction->product->galleries->first()->photos ?? '') }}"
                                    alt=""
                                    class="w-75"
                                    />
                                </div>
                                <div class="col-md-2 col-lg-4 mt-3 mt-sm-3 mt-md-0 mt-lg-0">{{ $transaction->product->name }}</div>
                                <div class="col-md-2 col-lg-2">{{ $transaction->shipping_status }}</div>
                                <div class="col-md-5 col-lg-3">{{ $transaction->created_at }}</div>
                                <div class="col-lg-1 d-none d-md-none d-lg-block">
                                    <img src="/images/arrow_to_right.svg" alt="" />
                                </div>
                                </div>
                            </div>
                            </a>
                        @empty
                            <div
                                class="col-12 text-center py-5"
                                data-aos="fade-up"
                                data-aos-delay="100">
                                Belum ada transaksi yang kamu lakukan
                            </div>
                        @endforelse
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
@endsection