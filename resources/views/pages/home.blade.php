@extends('layouts.app')

@section('title')
    Store Homepage
@endsection

@section('content')
<!-- Page Content -->
    <div class="page-content page-home">
      <!-- Carousel -->
      <section class="store-carousel container">
          <div class="row">
            <div class="col-lg-12" data-aos="slide-down">
              <div
                class="carousel slide"
                id="storeCarousel"
                data-ride="carousel"
              >
                <ol class="carousel-indicators">
                  <li
                    class="active"
                    data-target="#storeCarousel"
                    data-slide-to="0"
                  ></li>
                  <li data-target="#storeCarousel" data-slide-to="1"></li>
                  <li data-target="#storeCarousel" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner border-radius">
                  <div class="carousel-item active">
                    <img
                      src="/images/crsl5.jpg"
                      alt="Carousel Image"
                      class="d-block w-100"
                    />
                  </div>
                  <div class="carousel-item">
                    <img
                      src="/images/crsl2.jpg"
                      alt="Carousel Image"
                      class="d-block w-100"
                    />
                  </div>
                  <div class="carousel-item">
                    <img
                      src="/images/crsl4.jpg"
                      alt="Carousel Image"
                      class="d-block w-100"
                    />
                  </div>
                </div>
              </div>
            </div>
          </div>
      </section>

      <!-- Our Catagories -->
      <section class="store-trend-categories">
        <div class="container">
          <div class="row justify-content-center justify-content-md-start">
            <div class="col-12" data-aos="fade-up">
              <h5>Kategori Populer</h5>
            </div>
            {{-- <div class="col-6 text-right" data-aos="fade-up">
              <a href="{{ route('categories') }}" class="see-all">See All</a>
            </div> --}}
          </div>
          <div class="row">
            @forelse ($categories as $category)
              <div
              class="col-12 col-md col-lg-4"
              data-aos="fade-up"
              data-aos-delay="100"
              >
                <a href="{{ route('categories-detail', $category->slug) }}" class="component-categories d-block">
                  <div class="categories-thumbnail">
                    <div class="categories-image" style="background-image: url({{ Storage::url($category->photo) }})">
                      <p class="categories-text">{{ $category->name }}</p>
                    </div>
                  </div>
                </a>
              </div>
            @empty
              <div
              class="col-12 text-center py-5"
              data-aos="fade-up"
              data-aos-delay="100">
                Opss, belum ada kategori sama sekali
              </div>
            @endforelse
          </div>
        </div>
      </section>

      <!-- New Products -->
      <section class="store-new-products">
        <div class="container">
          <div class="row">
            <div class="col-6 col-md col-lg-8" data-aos="fade-up">
              <h5>Produk Baru</h5>
            </div>
            <div class="col-6 col-md col-lg-4 text-right" data-aos="fade-up">
              <a href="{{ route('categories') }}" class="see-all">Semua produk</a>
            </div>
          </div>
          <div class="row">
            @forelse ($products as $product)
              <div
              class="col-6 col-md-4 col-lg-3"
              data-aos="fade-up"
              data-aos-delay="100"
              >
                @if($product->tag->name == "PRODUK BARU")
                    <p class="badge-product-new">BARU</p>
                @endif
                @if($product->tag->name == "KOSONG")
                    <p class="badge-product-sold">HABIS</p>
                @endif
                @if($product->tag->name == "TERLARIS")
                    <p class="badge-product-pop">TERLARIS</p>
                @endif
                <a href="{{ route('details', $product->slug) }}" class="component-products d-block">
                  <div class="products-thumbnail">
                    <div
                      class="products-image"
                      style="
                      @if($product->galleries->count())
                          background-image: url({{ Storage::url($product->galleries->first()->photos) }})
                      @else
                          background-color: #eee
                      @endif
                      "
                    >
                    {{-- @if($product->created_at >= now()->subWeeks(2)) <!-- Tambahkan kondisi ini -->
                        <p class="badge-product">BARU</p> <!-- Tambahkan elemen dengan teks "BARU" -->
                    @endif --}}
                    </div>
                  </div>
                  <div class="products-text">{{ $product->name }}</div>
                  <div class="products-price">Rp.{{ number_format($product->price) }}</div>
                </a>
              </div>
            @empty
              <div
                class="col-12 text-center py-5"
                data-aos="fade-up"
                data-aos-delay="100">
                  Opss, belum ada produk sama sekali
              </div>
            @endforelse
          </div>
        </div>
      </section>
    </div>
@endsection