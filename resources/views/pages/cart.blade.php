@extends('layouts.app')

@section('title')
    Store Cart Page
@endsection

@section('content')
<!-- Page Content -->
    <div class="page-content page-carts">
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
                    <a href="{{ route('home') }}">Home</a>
                  </li>
                  <li class="breadcrumb-item active">Troli</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </section>
      <section class="store-cart mb-4">
        <div class="container">
          <div class="row" data-aos="fade-up" data-aos-delay="200">
            <div class="col-12">
              <div class="scroll-body">
              <table class="table table-borderless table-cart">
                <thead>
                  <tr>
                    <th>Gambar</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @php $totalPrice = 0 @endphp
                  @forelse  ($carts as $cart)
                    <tr>
                      <td style="width: 15%;">
                        @if ($cart->product->galleries->count())
                          <a href="{{ route('details', $cart->product->slug) }}" class="d-block">
                            {{-- <img src="{{ Storage::url($cart->product->galleries->first()->photos) }}" alt="" class="cart-image w-100">  --}}
                            <div class="cart-thumbnail">
                              <div
                                class="cart-image"
                                style="background-image: url({{ Storage::url($cart->product->galleries->first()->photos) }})"
                              ></div>
                            </div>
                          </a>
                        @else
                          <a href="{{ route('details', $cart->product->slug) }}" class="d-block">
                            {{-- <img src="{{ Storage::url($cart->product->galleries->first()->photos) }}" alt="" class="cart-image w-100">  --}}
                            <div class="cart-thumbnail">
                              <div
                                class="cart-image"
                                style="background-color: #eee"
                              ></div>
                            </div>
                          </a>
                        @endif
                      </td>
                      <td style="width: 35%;">
                        <a href="{{ route('details', $cart->product->slug) }}" class="product-title">{{ $cart->product->name }}</a>
                        <div class="product-subtitle">{{ $cart->product->category->name }}</div>
                      </td>
                      <td style="width: 35%;">
                        <div class="product-title">Rp.{{ number_format($cart->product->price) }}</div>
                        <div class="product-subtitle">IDR</div>
                      </td>
                      <td style="width: 20%;">
                        <form action="{{ route('cart-delete', $cart->id) }}" method="POST">
                          @method('DELETE')
                          @csrf
                          <button type="submit" class="btn btn-remove-cart">
                            Hapus
                          </button>
                        </form>
                      </td>
                    </tr>
                    @php $totalPrice += $cart->product->price @endphp
                  @empty
                    <tr>
                      <td colspan="4" class="text-center">Opss, nampaknya anda belum memilih barang</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
              </div>
            </div>
          </div>
          <div class="row mt-4" data-aos="fade-up" data-aos-delay="150">
            <div class="col-12">
              <hr/>
            </div>
            <div class="col-12">
              <h2 class="mb-4">Detail Pengiriman</h2>
            </div>
          </div>
          <form action="{{ route('checkout') }}" enctype="multipart/form-data" method="POST">
            @csrf
            
            <div class="row mb-2" data-aos="fade-up" data-aos-delay="200" id="locations">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="address_one">Alamat 1</label>
                  <input type="text" class="form-control" id="address_one" name="address_one" value="" required/>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="address_two">Alamat 2</label>
                  <input type="text" class="form-control" id="address_two" name="address_two" value="" required/>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="provinces_id">Provinsi</label>
                  {{-- <input type="text" class="form-control" id="provinces" name="provinces" value="Bali"/> --}}
                  <select name="provinces_id" id="provinces_id" class="form-control" v-if="provinces" v-model="provinces_id" required>
                    <option v-for="province in provinces" :value="province.id">@{{ province.name }}</option>
                  </select>
                  <select v-else class="form-control"></select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="regencies_id">Kabupaten</label>
                  {{-- <input type="text" class="form-control" id="regencies" name="regencies" value="Badung"/> --}}
                  <select name="regencies_id" id="regencies_id" class="form-control" v-if="regencies" v-model="regencies_id" required>
                    <option v-for="regency in regencies" :value="regency.id">@{{ regency.name }}</option>
                  </select>
                  <select v-else class="form-control"></select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="zip_code">Kode Pos</label>
                  <input type="text" class="form-control" id="zip_code" name="zip_code" value="" required/>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="country">Negara</label>
                  <input type="text" class="form-control" id="country" name="country" value="" required/>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="phone_number">Nomor Telpon</label>
                  <input type="text" class="form-control" id="phone_number" name="phone_number" value="" required/>
                </div>
              </div>
            </div>
            <div class="row" data-aos="fade-up" data-aos-delay="150">
              <div class="col-12">
                <hr/>
              </div>
              <div class="col-12">
                <h2 class="mb-2">Informasi Pembayaran</h2>
              </div>
            </div>
            @php $shippingInsurance = 7500 @endphp
            @php $shippingCost = 35000 @endphp
            <div class="row" data-aos="fade-up" data-aos-delay="200">
              <div class="col-5 col-md-3">
                <div class="product-title">Rp.{{ number_format($shippingInsurance ?? 0) }}</div>
                <div class="product-subtitle">Asuransi Pengiriman</div>
              </div>
              <div class="col-3 col-md-2">
                <div class="product-title">Rp.{{ number_format($shippingCost ?? 0) }}</div>
                <div class="product-subtitle">Biaya Pengiriman</div>
              </div>
              @php $totalTransaction = $totalPrice + $shippingInsurance + $shippingCost @endphp
              <div class="col-4 col-md-2">
                @if ($totalPrice == 0)
                    <div class="product-title text-success">Rp.0</div>
                @else
                    <div class="product-title text-success">Rp.{{ number_format($totalTransaction ?? 0) }}</div>
                @endif
                <div class="product-subtitle">Total</div>
              </div>
              <input type="hidden" name="total_price" value="{{ $totalTransaction }}">
              <div class="col-12 col-md-5">
                <button type="submit" class="btn btn-success px-4 btn-block mt-3 mt-md-0" method="POST">
                  Checkout Sekarang
                </button>
              </div>
            </div>
          </form>
        </div>
      </section>
@endsection

@push('addon-script')
  <script src="/vendor/vue/vue.js"></script>
  <script src="https://unpkg.com/vue-toasted"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <script>
      var locations = new Vue({
        el: "#locations",
        mounted() {
          AOS.init();
          this.getProvincesData();
        },
        data: {
          provinces: null,
          regencies: null,
          provinces_id: null,
          regencies_id: null,
        },
        methods: {
          getProvincesData() {
            var self = this;
                axios.get('{{ route('api-provinces') }}')
                  .then(function (response) {
                    self.provinces = response.data;
                  })
          },
          getRegenciesData() {
            var self = this;
                axios.get('{{ url('api/regencies') }}/' + self.provinces_id)
                  .then(function (response) {
                    self.regencies = response.data;
                  })
          },
        },
        watch: {
          provinces_id: function (val, oldVal) {
            this.regencies_id = null;
            this.getRegenciesData();
          }
        }
      });
    </script>
@endpush