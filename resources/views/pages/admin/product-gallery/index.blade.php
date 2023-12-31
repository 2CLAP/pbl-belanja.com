@extends('layouts.dashboard')

@section('title')
    Admin Product Gallery Page
@endsection

@section('content')
<!-- Section Content -->
          <div
            class="section-content section-dashboard-home"
            data-aos="fade-down"
          >
            <div class="container-fluid">
              <div class="dashboard-heading">
                <h2 class="dashboard-title">Product Gallery</h2>
                <p class="dashboard-subtitle">Product Gallery List</p>
              </div>
              <div class="dashboard-content">
                <div class="row">
                  <div class="col-md-12">
                    <div class="card">
                      <div class="card-body">
                        <a href="{{ route('product-gallery.create') }}" class="btn btn-primary mb-3">
                          + Tambah Product Gallery Baru
                        </a>
                        <div class="table-responsive">
                          <table class="table table-hover scroll-horizontal-vertical w-100" id="crudTable">
                            <thead>
                              <tr>
                                <th>ID</th>
                                <th>Product</th>
                                <th>Foto</th>
                                <th>Aksi</th>
                              </tr>
                            </thead>
                            <tbody></tbody>
                          </table>
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
    <script>
      var datatable = $('#crudTable').DataTable( {
        proccessing: true,
        serverSide: true,
        ordering: true,
        ajax: {
          url: '{!! url()->current() !!}',
        },
        columns: [
          {data: 'id', name: 'id'},
          {data: 'product.name', name: 'product.name'},
          {data: 'photos', name: 'photos'},
          {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false,
            width: '15%',
          },
        ]
      })
    </script>
@endpush