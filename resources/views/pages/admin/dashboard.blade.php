@extends('layouts.dashboard')

@section('title')
    Admin Dashboard Page
@endsection

@section('content')
<!-- Section Content -->
          <div
            class="section-content section-dashboard-home"
            data-aos="fade-down"
          >
            <div class="container-fluid">
              <div class="dashboard-heading">
                <h2 class="dashboard-title">Dashboard</h2>
                <p class="dashboard-subtitle">Welcome back Administrator</p>
              </div>
              <div class="dashboard-content">
                <div class="row">
                  <div class="col-sm-12 col-md-12 col-lg-4">
                    <div class="card mb-2">
                      <div class="card-body">
                        <div class="dashboard-card-title">User</div>
                        <div class="dashboard-card-subtitle">{{ number_format($customer) }}</div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-12 col-lg-4">
                    <div class="card mb-2">
                      <div class="card-body">
                        <div class="dashboard-card-title">Revenue</div>
                        <div class="dashboard-card-subtitle">Rp.{{ number_format($revenue) }}</div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-12 col-lg-4">
                    <div class="card mb-2">
                      <div class="card-body">
                        <div class="dashboard-card-title">Transaction</div>
                        <div class="dashboard-card-subtitle">{{ number_format($transaction) }}</div>
                      </div>
                    </div>
                  </div>
                </div>
                {{-- <div class="row mt-3">
                  <div class="col-12 mt-2">
                    <h5 class="mb-3">Recent Transactions</h5>
                    @foreach ($transaction_data as $transaction)
                        <a
                          href="{{ route('') }}"
                          class="card card-list d-block"
                        >
                          <div class="card-body">
                            <div class="row">
                              <div class="col-sm col-md-12 col-lg-2">
                                <img
                                  src="/images/recent-transactions-1.png"
                                  alt=""
                                  class="mx-auto d-block"
                                />
                                </div>
                                <div class="col-md-5 col-lg-4">Orange Bogatta</div>
                                <div class="col-md-3 col-lg-2">Outwear</div>
                                <div class="col-md-4 col-lg-3">25 Mei, 2023</div>
                                <div class="col-md-1 d-none d-md-none d-lg-block">
                                <img src="/images/arrow_to_right.svg" alt="" />
                              </div>
                            </div>
                          </div>
                        </a>
                    @endforeach
                  </div>
                </div> --}}
              </div>
            </div>
          </div>
@endsection