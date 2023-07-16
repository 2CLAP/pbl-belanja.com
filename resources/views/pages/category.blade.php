@extends('layouts.app')

@section('title')
    Store Category Page
@endsection

@section('content')
<!-- Page Content -->
    <div class="page-content page-home">
      <!-- All Catagories -->
      <section class="store-trend-categories">
        <div class="container">
          <div class="row">
            <div class="col-12" data-aos="zoom-in">
              <h5>Semua Kategori</h5>
            </div>
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
                      <p class="categories-text d-flex">{{ $category->name }}</p>
                    </div>
                  </div>
                </a>
              </div>
            @empty
              <div
              class="col-12 text-center py-5"
              data-aos="fade-up"
              data-aos-delay="100">
                Opss, belum ada kategori disini
              </div>
            @endforelse
          </div>
        </div>
      </section>

      <!-- All Products -->
      <section class="store-new-products">
        <div class="container">
          <div class="row">
            <div class="col-12 col-md-8 col-lg-9 mt-2" data-aos="fade-up">
              <h5>Semua Produk</h5>
            </div>
            {{-- <div class="col-12 col-md-4 col-lg-3" data-aos="fade-up">
              <div class="search-bar">
                <div class="search-icon">
                  <img src="/images/icon-search.png" alt="">
                </div>
                <div class="search-input">
                  <input type="search" placeholder="Search..." id="search" class="input">
                  </div>
              </div>
            </div> --}}
          </div>
          <div class="row">
            @forelse ($products as $product)
              <div
              class="col-6 col-md-4 col-lg-3"
              data-aos="fade-up"
              data-aos-delay="100"
              >
                <a href="{{ route('details', $product->slug) }}" class="component-products d-block">                    
                  @if($product->tag->name == "PRODUK BARU")
                      <p class="badge-product-new">BARU</p>
                  @endif
                  @if($product->tag->name == "KOSONG")
                      <p class="badge-product-sold">HABIS</p>
                  @endif
                  @if($product->tag->name == "TERLARIS")
                      <p class="badge-product-pop">TERLARIS</p>
                  @endif
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
                  </div>
                  </div>
                  <div class="products-text">{{ $product->name }}</div>
                  <div class="products-price">Rp{{ number_format($product->price) }}</div>
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
          <div class="row">
            <div class="col-12 mt-4" data-aos="fade-up" data-aos-delay="100">
              {{ $products->links() }}
            </div>
          </div>
        </div>
      </section>
    </div>
@endsection