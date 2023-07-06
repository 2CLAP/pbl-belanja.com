@extends('layouts.app')

@section('title')
    Store Transaction Detail Page
@endsection

@section('content')
<!-- Section Content -->
          <div
            class="page-content page-transaction page-transaction-detail mb-4"
            data-aos="fade-down"
          >
            <section
              class="store-breadcrumbs"
              data-aos="fade-down"
              data-aos-delay="100"
            >
              <div class="container">
                <div class="row">
                  <div class="col-12">
                    <nav>
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                          <a href="{{ route('transactions') }}">Transaksi</a>
                        </li>
                        <li class="breadcrumb-item active">Detail Transaksi</li>
                      </ol>
                    </nav>
                  </div>
                </div>
              </div>
            </section>
            <div class="container">
              <div class="transaction-heading">
                <h2 class="transaction-title">{{ $transaction->code }}</h2>
              </div>
              <div class="transaction-content" id="transactionDetails">
                <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-12 col-md-12 col-lg-4">
                            <img
                              src="{{ Storage::url($transaction->product->galleries->first()->photos ?? '') }}"
                              alt=""
                              class="w-100 mb-3"
                            />
                          </div>
                          <div class="col-12 col-md-8">
                            <div class="row">
                              <div class="col-12 col-md-6">
                                <div class="product-title">Nama Pelanggan</div>
                                <div class="product-subtitle">{{ $transaction->transaction->user->name }}</div>
                              </div>
                              <div class="col-12 col-md-6">
                                <div class="product-title">Nama Produk</div>
                                <div class="product-subtitle">{{ $transaction->product->name }}</div>
                              </div>
                              <div class="col-12 col-md-6">
                                <div class="product-title">
                                  Waktu Transaksi
                                </div>
                                <div class="product-subtitle">
                                  {{ $transaction->created_at }}
                                </div>
                              </div>
                              <div class="col-12 col-md-6">
                                <div class="product-title">Status Pembayaran</div>
                                @if ($transaction->transaction->transaction_status == 'PENDING')
                                    <div class="product-subtitle text-danger">
                                      {{ $transaction->transaction->transaction_status }}
                                    </div>
                                @else
                                    <div class="product-subtitle text-success">
                                      {{ $transaction->transaction->transaction_status }}
                                    </div>
                                @endif
                              </div>
                              <div class="col-12 col-md-6">
                                <div class="product-title">Total Belanja</div>
                                <div class="product-subtitle">{{ number_format($transaction->transaction->total_price) }}</div>
                              </div>
                              <div class="col-12 col-md-6">
                                <div class="product-title">Nomor Telpon</div>
                                <div class="product-subtitle">
                                  {{ $transaction->transaction->user->phone_number }}
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-12 mt-4">
                            <h5>Informasi Pengiriman</h5>
                          </div>
                          <div class="col-12">
                            <div class="row">
                              <div class="col-12 col-md-6">
                                <div class="product-title">Alamat I</div>
                                <div class="product-subtitle">
                                  {{ $transaction->transaction->user->address_one }}
                                </div>
                              </div>
                              <div class="col-12 col-md-6">
                                <div class="product-title">Alamat II</div>
                                <div class="product-subtitle">
                                  {{ $transaction->transaction->user->address_two }}
                                </div>
                              </div>
                              <div class="col-12 col-md-6">
                                <div class="product-title">Provinsi</div>
                                <div class="product-subtitle">{{ App\Models\Province::find($transaction->transaction->user->provinces_id)->name }}</div>
                              </div>
                              <div class="col-12 col-md-6">
                                <div class="product-title">Kabupaten</div>
                                <div class="product-subtitle">{{ App\Models\Regency::find($transaction->transaction->user->regencies_id)->name }}</div>
                              </div>
                              <div class="col-12 col-md-6">
                                <div class="product-title">Kode Pos</div>
                                <div class="product-subtitle">{{ $transaction->transaction->user->zip_code }}</div>
                              </div>
                              <div class="col-12 col-md-6">
                                <div class="product-title">Negara</div>
                                <div class="product-subtitle">{{ $transaction->transaction->user->country }}</div>
                              </div>
                              <div class="col-12 col-md-6">
                                  <div class="product-title">
                                    Status Pengiriman
                                  </div>
                                  @switch($transaction->shipping_status)
                                      @case('PENDING')
                                          <div class="product-subtitle text-danger">{{ $transaction->shipping_status }}</div>
                                          @break
                                      @case('SHIPPING')
                                          <div class="product-subtitle text-warning">{{ $transaction->shipping_status }}</div>
                                          @break
                                      @case('SUCCESS')
                                          <div class="product-subtitle text-success">{{ $transaction->shipping_status }}</div>
                                          @break
                                      @default
                                          <div class="product-subtitle text-primary">{{ $transaction->shipping_status }}</div>
                                          
                                  @endswitch
                                  {{-- <select name="status" id="status" class="form-control" v-model="status">
                                    <option value="UNPAID">Unpaid</option>
                                    <option value="PENDING">Pending</option>
                                    <option value="SHIPPING">Shipping</option>
                                    <option value="SUCCESS">Success</option>
                                  </select> --}}
                              </div>
                              <div class="col-12 col-md-6">
                                <div class="product-title">Nomor Resi</div>
                                @if ($transaction->resi == NULL)
                                    <div class="product-subtitle">-</div>
                                @else
                                    <div class="product-subtitle">{{ $transaction->resi }}</div>
                                @endif
                              </div>
                                {{-- <template v-if="status == 'SHIPPING'">
                                  <div class="col-12 col-md-3">
                                    <div class="product-title">Input Resi</div>
                                    <input type="text" class="form-control" name="resi" v-model="resi">
                                  </div>
                                  <div class="col-12 col-md-2 mt-4">
                                    <button type="submit" class="btn btn-outline-success btn-block">
                                      update Resi
                                    </button>
                                  </div>
                                </template> --}}
                            </div>
                            <div class="row">
                              <div class="col-12 col-md-2 mt-4">
                                <a href="{{ route('transactions') }}" class="btn btn-secondary btn-block">
                                  Kembali
                                </a>
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
            </div>
          </div>
@endsection

@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script>
      var transactionDetails = new Vue({
        el: "#transactionDetails",
        data: {
          status: "SHIPPING",
          resi: "JNE20839149021029301231",
        },
      });
    </script>
@endpush