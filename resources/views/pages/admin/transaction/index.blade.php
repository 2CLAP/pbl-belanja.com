@extends('layouts.dashboard')

@section('title')
    Admin Transaction Page
@endsection

@section('content')
<!-- Section Content -->
          <div
            class="section-content section-dashboard-home"
            data-aos="fade-down"
          >
            <div class="container-fluid">
              <div class="dashboard-heading">
                <h2 class="dashboard-title">Transaction</h2>
                <p class="dashboard-subtitle">Transaction List</p>
              </div>
              <div class="dashboard-content">
                <div class="row">
                  <div class="col-md-12">
                    <div class="card">
                      <div class="card-body">
                        <div class="table-responsive">
                          <table class="table table-hover scroll-horizontal-vertical w-100" id="crudTable">
                            <thead>
                              <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Total Harga</th>
                                <th>Transaction Status</th>
                                <th>Shipping Status</th>
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
          {data: 'user.name', name: 'user.name'},
          {data: 'total_price', name: 'total_price'},
          {data: 'transaction_status', name: 'transaction_status'},
          {data: 'shipping_status', name: 'shipping_status'},
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