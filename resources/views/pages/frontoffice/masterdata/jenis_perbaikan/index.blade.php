@extends('layouts.Admin.adminfrontoffice')

@section('content')
{{-- HEADER --}}
<main>
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="database"></i></div>
                            Master Data Jasa Perbaikan
                        </h1>
                        <div class="page-header-subtitle">List data Jasa Perbaikan yang dapat dilayani oleh bengkel
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    {{-- MAIN PAGE CONTENT --}}

    <div class="container-fluid mt-n10">
        <div class="card">
            <div class="card-header border-bottom">
                <ul class="nav nav-tabs card-header-tabs" id="cardTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="overview-tab" href="#overview" data-toggle="tab" role="tab" aria-controls="overview" aria-selected="true">Global</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="example-tab" href="#example" data-toggle="tab" role="tab" aria-controls="example" aria-selected="false">Lokal</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="cardTabContent">
                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                        <div class="row">
                            <div class="col-lg-3">
                
                                <!-- Illustrations -->
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Pengajuan</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="text-center">
                                            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 10rem;"
                                                src="/backend/src/assets/img/freepik/tambahdata.png" alt="">
                                        </div>
                                        <div class=" m-0 font-weight-bold text-primary" style="text-align: center">Pengajuan Tambah Data
                                            Perbaikan
                                        </div>
                                        <hr class="my-2">
                                        <p class="small" style="text-align: center">Anda ingin menambahkan data perbaikan yang tidak
                                            terdaftar?
                                            klik tombol <b>pengajuan</b>. </p>
                                        <div class="text-center">
                                            <button class="btn btn-sm btn-primary" type="button" data-toggle="modal"
                                                data-target="#Modaltambah">
                                                Ajukan Data Perbaikan
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" class="feather feather-arrow-right ml-1">
                                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                                    <polyline points="12 5 19 12 12 19"></polyline>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="card mb-4">
                                    
                                    <div class="card-body">
                                        <div class="datatable">
                                            @if(session('messageberhasil'))
                                            <div class="alert alert-success" role="alert"> <i class="fas fa-check"></i>
                                                {{ session('messageberhasil') }}
                                                <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            @endif
                                            @if(session('messagehapus'))
                                            <div class="alert alert-danger" role="alert"> <i class="fas fa-check"></i>
                                                {{ session('messagehapus') }}
                                                <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            @endif
                                            {{-- SHOW ENTRIES --}}
                                            <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <table class="table table-bordered table-hover dataTable" id="dataTable"
                                                            width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info"
                                                            style="width: 100%;">
                                                            <thead>
                                                                <tr role="row">
                                                                    <th class="sorting" tabindex="0" aria-controls="dataTable"
                                                                        rowspan="1" colspan="1" aria-sort="ascending"
                                                                        aria-label="Name: activate to sort column descending"
                                                                        style="width: 20px;">No</th>
                                                                    <th class="sorting" tabindex="0" aria-controls="dataTable"
                                                                        rowspan="1" colspan="1" aria-sort="ascending"
                                                                        aria-label="Name: activate to sort column descending"
                                                                        style="width: 20px;">Kode Jasa Perbaikan</th>
                                                                    <th class="sorting" tabindex="0" aria-controls="dataTable"
                                                                        rowspan="1" colspan="1" aria-sort="ascending"
                                                                        aria-label="Name: activate to sort column descending"
                                                                        style="width: 20px;">Nama Jasa Perbaikan</th>
                                                                    <th class="sorting" tabindex="0" aria-controls="dataTable"
                                                                        rowspan="1" colspan="1" aria-sort="ascending"
                                                                        aria-label="Name: activate to sort column descending"
                                                                        style="width: 20px;">Jenis Jasa Perbaikan</th>
                                                                    <th class="sorting" tabindex="0" aria-controls="dataTable"
                                                                        rowspan="1" colspan="1" aria-sort="ascending"
                                                                        aria-label="Name: activate to sort column descending"
                                                                        style="width: 20px;">Harga</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @forelse ($jenisperbaikan as $item)
                                                                <tr role="row" class="odd">
                                                                    <th scope="row" class="small" class="sorting_1">
                                                                        {{ $loop->iteration}}</th>
                                                                    <td>{{ $item->kode_jenis_perbaikan }}</td>
                                                                    <td>{{ $item->nama_jenis_perbaikan }}</td>
                                                                    <td>{{ $item->group_jenis_perbaikan }}</td>
                                                                    <td>Rp. {{ number_format($item->harga_jenis_perbaikan) }}</td>
                                                                 
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
                    </div>
                    <div class="tab-pane fade" id="example" role="tabpanel" aria-labelledby="example-tab">
                        <div class="card mb-4">
                                    
                            <div class="card-body">
                                <div class="datatable">
                                    @if(session('messageberhasil'))
                                    <div class="alert alert-success" role="alert"> <i class="fas fa-check"></i>
                                        {{ session('messageberhasil') }}
                                        <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    @endif
                                    @if(session('messagehapus'))
                                    <div class="alert alert-danger" role="alert"> <i class="fas fa-check"></i>
                                        {{ session('messagehapus') }}
                                        <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    @endif
                                    {{-- SHOW ENTRIES --}}
                                    <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table class="table table-bordered table-hover dataTable" id="dataTable"
                                                    width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info"
                                                    style="width: 100%;">
                                                    <thead>
                                                        <tr role="row">
                                                            <th class="sorting" tabindex="0" aria-controls="dataTable"
                                                                rowspan="1" colspan="1" aria-sort="ascending"
                                                                aria-label="Name: activate to sort column descending"
                                                                style="width: 20px;">No</th>
                                                            <th class="sorting" tabindex="0" aria-controls="dataTable"
                                                                rowspan="1" colspan="1" aria-sort="ascending"
                                                                aria-label="Name: activate to sort column descending"
                                                                style="width: 20px;">Kode Jasa Perbaikan</th>
                                                            <th class="sorting" tabindex="0" aria-controls="dataTable"
                                                                rowspan="1" colspan="1" aria-sort="ascending"
                                                                aria-label="Name: activate to sort column descending"
                                                                style="width: 20px;">Nama Jasa Perbaikan</th>
                                                            <th class="sorting" tabindex="0" aria-controls="dataTable"
                                                                rowspan="1" colspan="1" aria-sort="ascending"
                                                                aria-label="Name: activate to sort column descending"
                                                                style="width: 20px;">Jenis Jasa Perbaikan</th>
                                                            <th class="sorting" tabindex="0" aria-controls="dataTable"
                                                                rowspan="1" colspan="1" aria-sort="ascending"
                                                                aria-label="Name: activate to sort column descending"
                                                                style="width: 20px;">Harga</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($jenisperbaikan as $item)
                                                        <tr role="row" class="odd">
                                                            <th scope="row" class="small" class="sorting_1">
                                                                {{ $loop->iteration}}</th>
                                                            <td>{{ $item->Detailperbaikan->kode_jenis_perbaikan }}</td>
                                                            <td>{{ $item->Detailperbaikan->nama_jenis_perbaikan }}</td>
                                                            <td>{{ $item->Detailperbaikan->group_jenis_perbaikan }}</td>
                                                            <td>Rp. {{ number_format($item->Detailperbaikan->harga_jenis_perbaikan) }}</td>
                                                         
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
            </div>
        </div>






       
    </div>
</main>

{{-- MODAL Tambah -------------------------------------------------------------------------------------------}}
<div class="modal fade" id="Modaltambah" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah Jasa Perbaikan</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <form action="{{ route('jenis-perbaikan.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <label class="small mb-1">Isikan Form Dibawah Ini</label>
                    <hr>
                    </hr>
                    <div class="form-group">
                        <label class="small mb-1" for="kode_jenis_perbaikan">Kode Jasa Perbaikan</label>
                        <input class="form-control" name="kode_jenis_perbaikan" type="text" id="kode_jenis_perbaikan"
                            placeholder="Input Kode Jasa Perbaikan" value="{{ $kode_jenis_perbaikan }}" readonly>
                    </div>
                    <div class="form-group">
                        <label class="small mb-1" for="nama_jenis_perbaikan">Nama Jasa Perbaikan <span
                                style="color: red">*</span> </label>
                        <input class="form-control" name="nama_jenis_perbaikan" type="text" id="nama_jenis_perbaikan"
                            placeholder="Input Nama Jasa Perbaikan" value="{{ old('nama_jenis_perbaikan') }}"
                            class="form-control @error('nama_jenis_perbaikan') is-invalid @enderror">
                        @error('nama_jenis_perbaikan')<div class="text-danger small mb-1">{{ $message }}
                        </div> @enderror
                    </div>
                    <div class="form-group">
                        <label class="small mb-1" for="group_jenis_perbaikan">Jenis Jasa Perbaikan</label>
                        <select class="form-control" name="group_jenis_perbaikan"
                            class="form-control @error('group_jenis_perbaikan') is-invalid @enderror"
                            id="group_jenis_perbaikan">
                            <option value="{{ old('group_jenis_perbaikan') }}">Pilih Group Perbaikan
                            </option>
                            <option value="Service Ringan">Service Ringan</option>
                            <option value="Service Berat">Service Berat</option>
                        </select>
                        @error('group_jenis_perbaikan')<div class="text-danger small mb-1">{{ $message }}
                        </div> @enderror
                    </div>

                    <div class="form-group">
                        <label class="small mb-1" for="harga_jenis_perbaikan">Harga Perbaikan <span
                                style="color: red">*</span></label>
                        <input class="form-control" name="harga_jenis_perbaikan" type="text" id="harga_jenis_perbaikan"
                            placeholder="Input Harga Perbaikan" value="{{ old('harga_jenis_perbaikan') }}"
                            class="form-control @error('harga_jenis_perbaikan') is-invalid @enderror">
                        @error('harga_jenis_perbaikan')<div class="text-danger small mb-1">{{ $message }}
                        </div> @enderror
                    </div>
                </div>
                @if (count($errors) > 0)
                @endif
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="Submit">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

</main>

{{-- Callback Modal Jika Validasi Error --}}
@if (count($errors) > 0)
<button id="validasierror" style="display: none" type="button" data-toggle="modal" data-target="#Modaltambah">Open
    Modal</button>
@endif

{{-- Script Open Modal Callback --}}
<script>
    $(document).ready(function () {
        $('#validasierror').click();
    });

</script>


@endsection
