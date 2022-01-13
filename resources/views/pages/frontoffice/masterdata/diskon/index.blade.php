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
                            Master Data Diskon
                        </h1>
                        <div class="page-header-subtitle">List data diskon yang ditawarkan untuk pelanggan</div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    {{-- MAIN PAGE CONTENT --}}

    <div class="container-fluid mt-n10">
        <div class="card mb-4">
            <div class="card card-header-actions">
                <div class="card-header">List Diskon
                    <button class="btn btn-primary btn-sm" type="button" data-toggle="modal"
                        data-target="#Modaltambah">Tambah
                        Data</button>
                </div>
            </div>
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
                                <table class="table table-bordered table-hover dataTable" id="dataTable" width="100%"
                                    cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-sort="ascending"
                                                aria-label="Name: activate to sort column descending"
                                                style="width: 20px;">No</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-sort="ascending"
                                                aria-label="Name: activate to sort column descending"
                                                style="width: 20px;">Kode Diskon</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-sort="ascending"
                                                aria-label="Name: activate to sort column descending"
                                                style="width: 20px;">Nama Diskon</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-sort="ascending"
                                                aria-label="Name: activate to sort column descending"
                                                style="width: 20px;">Jumlah Diskon</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Actions: activate to sort column ascending"
                                                style="width: 77px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($diskon as $item)
                                        <tr role="row" class="odd">
                                            <th scope="row" class="small" class="sorting_1">{{ $loop->iteration}}</th>
                                            <td>{{ $item->kode_diskon }}</td>
                                            <td>{{ $item->nama_diskon }}</td>
                                            <td>{{ $item->jumlah_diskon }} %</td>
                                            <td>
                                                <a href="" class="btn btn-primary btn-datatable  mr-2" type="button"
                                                    data-toggle="modal" data-target="#Modaledit-{{ $item->id_diskon }}">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="" class="btn btn-danger btn-datatable  mr-2" type="button"
                                                    data-toggle="modal"
                                                    data-target="#Modalhapus-{{ $item->id_diskon }}">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="7" class="text-center">
                                                Data Diskon Kosong
                                            </td>
                                        </tr>
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


    {{-- MODAL Tambah -------------------------------------------------------------------------------------------}}
    <div class="modal fade" id="Modaltambah" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Data Diskon</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <form action="{{ route('diskon.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <label class="small mb-1">Isikan Form Dibawah Ini</label>
                        <hr>
                        </hr>
                        <div class="form-group">
                            <label class="small mb-1" for="kode_diskon">Kode Diskon</label>
                            <input class="form-control" name="kode_diskon" type="text" id="kode_diskon"
                                placeholder="Input Kode Diskon" value="{{ $kode_diskon }}" readonly />
                        </div>
                        <div class="form-group">
                            <label class="small mb-1 mr-1" for="nama_diskon">Nama Diskon</label><span class="mr-4 mb-3"
                                style="color: red">*</span>
                            <input class="form-control" name="nama_diskon" type="text" id="nama_diskon"
                                placeholder="Input Nama Diskon" value="{{ old('nama_diskon') }}" required>
                        </div>
                        <div class="form-group">
                            <label class="small mb-1 mr-1" for="jumlah_diskon">Jumlah Diskon (%)</label><span
                                class="mr-4 mb-3" style="color: red">*</span>
                            <input class="form-control" name="jumlah_diskon" type="number" id="jumlah_diskon"
                                placeholder="Input Jumlah Diskon" value="{{ old('jumlah_diskon') }}" required />
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="small mb-1" for="id_jenis_sparepart">Pilih Kelompok Sparepart</label><span class="mr-4 mb-3"
                            style="color: red">*</span>
                        <div class="input-group input-group-joined">
                            <input class="form-control" type="text" placeholder="Pilih Kelompok Sparepart" aria-label="Search"
                                id="detailjenis" name="detailjenis">
                            <div class="input-group-append">
                                <a href="" class="input-group-text" type="button" data-toggle="modal"
                                    data-target="#Modaljenis">
                                    <i class="fas fa-folder-open"></i>
                                </a>
                            </div>
                        </div>
                        <div class="small" id="alertsupplier" style="display:none">
                            <span class="font-weight-500 text-danger">Error! Anda Belum Memilih Pegawai!</span>
                            <button class="close" type="button" onclick="$(this).parent().hide()"
                                aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="Submit">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- MODAL EDIT -------------------------------------------------------------------------------------------}}
    @forelse ($diskon as $item)
    <div class="modal fade" id="Modaledit-{{ $item->id_diskon }}" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Data Diskon</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <form action="{{ route('diskon.update', $item->id_diskon) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="modal-body">
                        <label class="small mb-1">Isikan Form Dibawah Ini</label>
                        <hr>
                        </hr>
                        <div class="form-group">
                            <label class="small mb-1 mr-1" for="nama_diskon">Nama Diskon</label><span class="mr-4 mb-3"
                                style="color: red">*</span>
                            <input class="form-control" name="nama_diskon" type="text" id="nama_diskon"
                                value="{{ $item->nama_diskon }}" required></input>
                        </div>
                        <div class="form-group">
                            <label class="small mb-1 mr-1" for="jumlah_diskon">Jumlah Diskon (%)</label><span
                                class="mr-4 mb-3" style="color: red">*</span>
                            <input class="form-control" name="jumlah_diskon" type="number" id="jumlah_diskon"
                                value="{{ $item->jumlah_diskon }}" required></input>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="Submit">Ubah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @empty

    @endforelse

    {{-- MODAL DELETE ------------------------------------------------------------------------------}}
    @forelse ($diskon as $item)
    <div class="modal fade" id="Modalhapus-{{ $item->id_diskon }}" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger-soft">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Konfirmasi Hapus Data</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <form action="{{ route('diskon.destroy', $item->id_diskon) }}" method="POST" class="d-inline">
                    @csrf
                    @method('delete')
                    <div class="modal-body">Apakah Anda Yakin Menghapus Data Diskon dengan Kode {{ $item->kode_diskon }}
                        ?</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                        <button class="btn btn-danger" type="submit">Ya! Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @empty

    @endforelse

    <div class="modal fade" id="Modaljenis" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content ">
            <div class="modal-header bg-light ">
                <h5 class="modal-title">Pilih Jenis Sparepart</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div class="datatable">
                    <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered table-hover dataTable" id="dataTablePegawai"
                                    width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info"
                                    style="width: 100%;">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-sort="ascending"
                                                aria-label="Name: activate to sort column descending"
                                                style="width: 20px;">No</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Position: activate to sort column ascending"
                                                style="width: 150px;">Jenis Sparepart</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Actions: activate to sort column ascending"
                                                style="width: 50px;"> <input onClick="toggle(this)"
                                                name="chk[]" type="checkbox" />
                                                Pilih Semua</th>
                                        </tr>
                                    </thead>
                                    <tbody id="jenissparepart">
                                        @forelse ($jenis_sparepart as $item)
                                        <tr id="item-{{ $item->id_jenis_sparepart }}" role="row" class="odd">
                                            <th scope="row" class="small" class="sorting_1">{{ $loop->iteration}}</th>
                                            <td class="nama_pegawai"><span id="{{ $item->id_jenis_sparepart }}">{{ $item->jenis_sparepart }}</span></td>
                                            <td>
                                                <div class="">
                                                    <input class="checkpegawai"
                                                        id="customCheck1-{{ $item->id_jenis_sparepart }}" type="checkbox" name="cek" />
                                                    <label class="" for="customCheck1">Pilih</label>
                                                </div>
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
            <div class="modal-footer">
                <button class="btn btn-success" onclick="tambahkelompok(event)" type="button" data-dismiss="modal">Tambah
                </button>
            </div>
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
        $('#dataTablePegawai').DataTable()
    });

    function tambahkelompok(event){
        var Terpilih = 'Kelompok Sparepart Telah Dipilih'
        var detailjenis = $('#detailjenis').val(Terpilih)

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'success',
            title: 'Berhasil Menambahkan Data Kelompok Sparepart'
        })
    }

    function toggle(source) {
        checkboxes = document.getElementsByName('cek');
        for(var i=0, n=checkboxes.length;i<n;i++) {
            checkboxes[i].checked = source.checked;
        }
    }



</script>

@endsection
