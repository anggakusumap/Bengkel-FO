@extends('layouts.Admin.adminfrontoffice')

@section('content')
{{-- HEADER --}}
<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-4">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="users"></i></div>
                        Riwayat Transaksi Pelanggan {{ $customer->nama_customer }}
                    </h1>
                    <div class="page-header-subtitle">Data pelanggan yang pernah dilayani oleh bengkel</div>
                </div>
            </div>
        </div>
    </div>
</header>

{{-- MAIN PAGE CONTENT --}}
<div class="card">
    <div class="card-header border-bottom">
        <ul class="nav nav-tabs card-header-tabs" id="cardTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="overview-tab" href="#overview" data-toggle="tab" role="tab" aria-controls="overview" aria-selected="true">List Transaksi Service</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="example-tab" href="#example" data-toggle="tab" role="tab" aria-controls="example" aria-selected="false">List Transaksi Penjualan</a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="cardTabContent">
            <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                <div class="datatable">
                    <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered table-hover dataTable" id="dataTable" width="100%"
                                    cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-sort="ascending"
                                                aria-label="Name: activate to sort column descending" style="width: 20px;">
                                                No</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-sort="ascending"
                                                aria-label="Name: activate to sort column descending" style="width: 20px;">
                                                Bengkel</th> 
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-sort="ascending"
                                                aria-label="Name: activate to sort column descending" style="width: 20px;">
                                                Kode Sa</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-sort="ascending"
                                                aria-label="Name: activate to sort column descending" style="width: 20px;">
                                                Kendaraan</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-sort="ascending"
                                                aria-label="Name: activate to sort column descending" style="width: 20px;">
                                                Detail Service</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($service as $item)
                                        <tr role="row" class="odd">
                                            <th scope="row" class="small" class="sorting_1">{{ $loop->iteration}}</th>
                                            <td>{{ $item->nama_bengkel }}</td>
                                            <td>{{ $item->kode_sa }}</td>
                                            <td>{{ $item->kendaraan->nama_kendaraan }}</td>
                                            <td>{{ $item->alamat_customer }}</td>
                                            <td>
                                               
                                                <a href="" class="btn btn-primary btn-datatable" type="button"
                                                    data-toggle="modal"
                                                    data-target="#Modalservice-{{ $item->id_service_advisor }}">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                
                                            </td>
                                        </tr>
                                        @empty
                                        
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="example" role="tabpanel" aria-labelledby="example-tab">
                <h5 class="card-title">Example Pane</h5>
                <p class="card-text">...</p>
            </div>
        </div>
    </div>
</div>




{{-- Modal Edit --}}
@forelse ($service as $item)
<div class="modal fade" id="Modalservice-{{ $item->id_service_advisor }}" data-backdrop="static" tabindex="-1"
    role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit Customer Bengkel</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
                <div class="modal-body">
                    <div class="datatable">
                        <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-bordered table-hover dataTable" id="dataTable" width="100%"
                                        cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                    colspan="1" aria-sort="ascending"
                                                    aria-label="Name: activate to sort column descending" style="width: 20px;">
                                                    No</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                    colspan="1" aria-sort="ascending"
                                                    aria-label="Name: activate to sort column descending" style="width: 20px;">
                                                    Nama Perbaikan</th> 
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                    colspan="1" aria-sort="ascending"
                                                    aria-label="Name: activate to sort column descending" style="width: 20px;">
                                                    Jenis Perbaikan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($service->detail_perbaikan as $item)
                                            <tr role="row" class="odd">
                                                <th scope="row" class="small" class="sorting_1">{{ $loop->iteration}}</th>
                                                <td>{{ $item->nama_jenis_perbaikan }}</td>
                                                <td>{{ $item->group_jenis_perbaikan }}</td>
                                            </tr>
                                            @empty
                                          
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>

@empty

@endforelse


</main>


@endsection
