@extends('layouts.app')

@section('title')
    Store Detail Page
@endsection

@section('content')
    <!-- Page Content -->
    <div class="page-content page-details">
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
                  <li class="breadcrumb-item active">Detail Produk</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </section>

      <section class="store-gallery mb-3" id="gallery">
        <div class="container">
          <div class="row">
            <div class="col-lg-8" data-aos="zoom-in">
              <div class="main-image">
                <img
                  :src="photos[activePhoto].url"
                  :key="photos[activePhoto].id"
                  alt=""
                />
              </div>
            </div>
            <div class="col-12 col-md col-lg-3">
              <div class="row row-scroll">
                <div
                  class="col-6 col-md-4 col-lg-12 mt-4 mt-lg-0"
                  v-for="(photo, index) in photos"
                  :key="photo.id"
                  data-aos="zoom-in"
                  data-aos-delay="100"
                >
                  <a href="#" @click="changeActive(index)">
                    <div class="thumbnail-image">
                      <img
                        :src="photo.url"
                        :class="{ active: index == activePhoto }"
                        alt=""
                      />
                    </div>
                    {{-- <img
                      :src="photo.url"
                      class="w-100 thumbnail-image"
                      :class="{ active: index == activePhoto }"
                      alt=""
                    /> --}}
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <div class="store-details-container" data-aos="fade-up">
        <section class="store-heading">
          <div class="container">
            <div class="row">
              <div class="col-7 col-md-8 col-lg-8">
                <h1>{{ $product->name }}</h1>
                <div class="owner">{{ $product->category->name }}</div>
                <div class="price">Rp.{{ number_format($product->price) }}</div>
              </div>
              <div class="col-5 col-md-4 col-lg-3" data-aos="zoom-in">
                @auth
                  <form action="{{ route('detail-add', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <button type="submit" class="btn btn-success px-4 text-white btn-block mb-3">
                      Tambah ke Troli
                    </button>
                  </form>
                @else
                  <a href="{{ route('login') }}" class="btn btn-success px-4 text-white btn-block mb-3">
                    Daftar Terlebih Dahulu
                  </a>
                @endauth
                  <div class="stock text-center">
                    @if ($product->stock >= 6)
                        <p class="text-secondary">Stok Tersedia</p>
                    @elseif ($product->stock >= 2)
                        <p class="text-danger">{{ $product->stock }} stok tersisa</p>
                    @else
                        <p class="text-danger">Barang habis</p>
                    @endif
                  </div>
              </div>
            </div>
          </div>
        </section>
        <section class="store-description">
          <div class="container">
            <div class="row">
              <div class="col-12 col-lg-8">
                {!! $product->description !!}
              </div>
            </div>
          </div>
        </section>
        <section class="store-related">
          <div class="container">
            <div class="row">
              <div class="col-12 col-lg-8 mt-4 mb-2">
                <h5>Produk Serupa</h5>
              </div>
            </div>
            <div class="row">
              @forelse ($relatedProduct as $similarProduct)
                <div
                class="col-6 col-md-4 col-lg-3"
                data-aos="fade-up"
                data-aos-delay="100"
                >
                  <a href="{{ route('details', $similarProduct->slug) }}" class="component-products d-block">
                    <div class="products-thumbnail">
                      <div
                        class="products-image"
                        style="
                        @if($similarProduct->galleries->count())
                            background-image: url({{ Storage::url($similarProduct->galleries->first()->photos) }})
                        @else
                            background-color: #eee
                        @endif
                        "
                      ></div>
                    </div>
                    <div class="products-text">{{ $similarProduct->name }}</div>
                    <div class="products-price">Rp.{{ number_format($similarProduct->price) }}</div>
                  </a>
                </div>
              @empty
                <div
                  class="col-12 text-center py-5"
                  data-aos="fade-up"
                  data-aos-delay="100">
                    Tidak ada produk serupa
                </div>
              @endforelse
            </div>
          </div>
        </section>
      </div>
    </div>
@endsection

@push('addon-script')
  <script src="/vendor/vue/vue.js"></script>
    <script>
      var gallery = new Vue({
        el: "#gallery",
        mounted() {
          AOS.init();
        },
        data: {
          activePhoto: 0,
          photos: [
            @foreach ($product->galleries as $gallery)
              {
                id: {{ $gallery->id }},
                url: "{{ Storage::url($gallery->photos) }}",
              },
            @endforeach
          ],
        },
        methods: {
          changeActive(id) {
            this.activePhoto = id;
          },
        },
      });
    </script>
    <script src="/script/navbar-scroll.js"></script>
@endpush