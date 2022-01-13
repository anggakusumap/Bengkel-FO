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

    <div class="container-fluid mt-n10">
        <div class="card">
            <div class="card-header border-bottom">
                <ul class="nav nav-tabs card-header-tabs" id="cardTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="overview-tab" href="#overview" data-toggle="tab" role="tab"
                            aria-controls="overview" aria-selected="true">Master Dikson</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="example-tab" href="#example" data-toggle="tab" role="tab"
                            aria-controls="example" aria-selected="false">Voucher</a>
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
                                        <div class=" m-0 font-weight-bold text-primary" style="text-align: center">
                                            Tambah Data Diskon
                                        </div>
                                        <hr class="my-2">
                                        <p class="small" style="text-align: center">Anda ingin menambahkan data
                                            diskon?
                                            klik tombol <b>Tambah</b>. </p>
                                        <div class="text-center">
                                            <button class="btn btn-sm btn-primary" type="button" data-toggle="modal"
                                                data-target="#Modaltambah">
                                                Tambah
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-arrow-right ml-1">
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
                                            <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <table class="table table-bordered table-hover dataTable"
                                                            id="dataTable" width="100%" cellspacing="0" role="grid"
                                                            aria-describedby="dataTable_info" style="width: 100%;">
                                                            <thead>
                                                                <tr role="row">
                                                                    <th class="sorting" tabindex="0"
                                                                        aria-controls="dataTable" rowspan="1"
                                                                        colspan="1" aria-sort="ascending"
                                                                        aria-label="Name: activate to sort column descending"
                                                                        style="width: 20px;">No</th>
                                                                    <th class="sorting" tabindex="0"
                                                                        aria-controls="dataTable" rowspan="1"
                                                                        colspan="1" aria-sort="ascending"
                                                                        aria-label="Name: activate to sort column descending"
                                                                        style="width: 20px;">Kode Diskon</th>
                                                                    <th class="sorting" tabindex="0"
                                                                        aria-controls="dataTable" rowspan="1"
                                                                        colspan="1" aria-sort="ascending"
                                                                        aria-label="Name: activate to sort column descending"
                                                                        style="width: 20px;">Nama Diskon</th>
                                                                    <th class="sorting" tabindex="0"
                                                                        aria-controls="dataTable" rowspan="1"
                                                                        colspan="1" aria-sort="ascending"
                                                                        aria-label="Name: activate to sort column descending"
                                                                        style="width: 20px;">Jumlah Diskon</th>
                                                                    <th class="sorting" tabindex="0"
                                                                        aria-controls="dataTable" rowspan="1"
                                                                        colspan="1"
                                                                        aria-label="Actions: activate to sort column ascending"
                                                                        style="width: 77px;">Actions</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @forelse ($diskon as $item)
                                                                <tr role="row" class="odd">
                                                                    <th scope="row" class="small" class="sorting_1">
                                                                        {{ $loop->iteration}}</th>
                                                                    <td>{{ $item->kode_diskon }}</td>
                                                                    <td>{{ $item->nama_diskon }}</td>
                                                                    <td>{{ $item->jumlah_diskon }} %</td>
                                                                    <td>
                                                                        <a href="{{ route('diskon.show', $item->id_diskon) }}"
                                                                            class="btn btn-secondary btn-datatable"
                                                                            data-toggle="tooltip" data-placement="top"
                                                                            title="" data-original-title="Detail">
                                                                            <i class="fa fa-eye"></i>
                                                                        </a>
                                                                        <a href="" class="btn btn-primary btn-datatable"
                                                                            type="button" data-toggle="modal"
                                                                            data-target="#Modaledit-{{ $item->id_diskon }}">
                                                                            <i class="fas fa-edit"></i>
                                                                        </a>
                                                                        <a href="" class="btn btn-danger btn-datatable"
                                                                            type="button" data-toggle="modal"
                                                                            data-target="#Modalhapus-{{ $item->id_diskon }}">
                                                                            <i class="fas fa-trash"></i>
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
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="example" role="tabpanel" aria-labelledby="example-tab">
                        <div class="datatable">
                            {{-- SHOW ENTRIES --}}
                            <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table class="table table-bordered table-hover dataTable" id="dataTableVoucher"
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
                                                        style="width: 20px;">Diskon</th>
                                                    <th class="sorting" tabindex="0" aria-controls="dataTable"
                                                        rowspan="1" colspan="1" aria-sort="ascending"
                                                        aria-label="Name: activate to sort column descending"
                                                        style="width: 20px;">Voucher</th>

                                                </tr>
                                            </thead>
                                            <tbody>


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
                            <div class="row" id="radio1">
                                <div class="col-md-6">
                                    <input class="mr-1" value="Diskon Khusus" type="radio" name="status_diskon"
                                        checked>Diskon Khusus
                                </div>
                                <div class="col-md-6">
                                    <input class="mr-1" value="Diskon Umum" type="radio" name="status_diskon">Diskon
                                    Umum
                                </div>
                            </div>
                        </div>

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
                            <label class="small mb-1 mr-1" for="jumlah_diskon">Jumlah Diskon
                                (%)</label><span class="mr-4 mb-3" style="color: red">*</span>
                            <input class="form-control" name="jumlah_diskon" type="number" id="jumlah_diskon"
                                placeholder="Input Jumlah Diskon" value="{{ old('jumlah_diskon') }}" required />
                        </div>
                        <div class="form-group" id="MinimalOrder" style="display:block">
                            <label class="small mb-1 mr-1" for="min_order">Minimal Order</label><span class="mr-4 mb-3" style="color: red">*</span>
                            <input class="form-control" name="min_order" type="number" id="min_order"
                                placeholder="Input Minimal Order" value="{{ old('min_order') }}" required />
                        </div>
                        <div class="form-group" id="KelompokTransaksiStyle" style="display:none">
                            <label class="small mb-1" for="id_jenis_sparepart">Pilih Kelompok
                                Sparepart</label><span class="mr-4 mb-3" style="color: red">*</span>
                            <div class="input-group input-group-joined">
                                <input class="form-control" type="text" placeholder="Pilih Kelompok Sparepart"
                                    aria-label="Search" id="detailjenis" name="detailjenis">
                                <div class="input-group-append">
                                    <a href="" class="input-group-text" type="button" data-toggle="modal"
                                        data-target="#Modaljenis">
                                        <i class="fas fa-folder-open"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="small" id="alertsupplier" style="display:none">
                                <span class="font-weight-500 text-danger">Error! Anda Belum Memilih
                                    Pegawai!</span>
                                <button class="close" type="button" onclick="$(this).parent().hide()"
                                    aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary" onclick="submit1(event)" type="button">Tambah</button>
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
                <form action="{{ route('diskon.update', $item->id_diskon) }}" id="form1" method="POST">
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
                            <label class="small mb-1 mr-1" for="jumlah_diskon">Jumlah Diskon
                                (%)</label><span class="mr-4 mb-3" style="color: red">*</span>
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
                    <div class="modal-body">Apakah Anda Yakin Menghapus Data Diskon dengan Kode
                        {{ $item->kode_diskon }}
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
                                                    style="width: 50px;"> <input onClick="toggle(this)" name="chk[]"
                                                        type="checkbox" />
                                                    Pilih Semua</th>
                                            </tr>
                                        </thead>
                                        <tbody id="jenissparepart">
                                            @forelse ($jenis_sparepart as $item)
                                            <tr id="item-{{ $item->id_jenis_sparepart }}" role="row" class="odd">
                                                <th scope="row" class="small" class="sorting_1">
                                                    {{ $loop->iteration}}
                                                </th>
                                                <td class="jenis_sparepart"><span
                                                        id="{{ $item->id_jenis_sparepart }}">{{ $item->jenis_sparepart }}</span>
                                                </td>
                                                <td>
                                                    <div class="">
                                                        <input class="checkpegawai"
                                                            id="customCheck1-{{ $item->id_jenis_sparepart }}"
                                                            type="checkbox" name="cek" />
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
                    <button class="btn btn-success" onclick="tambahkelompok(event)" type="button"
                        data-dismiss="modal">Tambah
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
        $('#dataTableVoucher').DataTable()

        $("#radio1").change(function () {
            var value = $("input[name='status_diskon']:checked").val();

            if (value == 'Diskon Umum') {
                $('#KelompokTransaksiStyle').show()
                $('#MinimalOrder').hide()
                
            } else {
                $('#KelompokTransaksiStyle').hide()
                $('#MinimalOrder').show()
            }


        });

    });


    function tambahkelompok(event) {
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
        for (var i = 0, n = checkboxes.length; i < n; i++) {
            checkboxes[i].checked = source.checked;
        }
    }

    function submit1(event, id_pegawai) {

        var tbody = $(`#jenissparepart`)
        var jenis = []
        for (let index = 0; index < tbody.length; index++) {
            var tes = $(tbody[index]).children()
            var check = tes.find('.checkpegawai').each(function (index, element) {
                var value = $(element).is(':checked')
                if (value == true) {
                    var tr = $(element).parent().parent().parent()
                    var td = $(tr).find('.jenis_sparepart')[0]
                    var nama = $(td).html()

                    var span = $(td).children()[0]
                    var id = $(span).attr('id')

                    jenis.push({
                        id_jenis_sparepart: id,
                    })
                }
            })
        }

        var _token = $('#form1').find('input[name="_token"]').val()
        var kode_diskon = $('#kode_diskon').val()
        var nama_diskon = $('#nama_diskon').val()
        var jumlah_diskon = $('#jumlah_diskon').val()
        var min_order = $('#min_order').val()
        var radio = $('#radio1').find("input[name='status_diskon']:checked").val()

        if (radio == 'Diskon Umum') {
            var data = {
                _token: _token,
                kode_diskon: kode_diskon,
                nama_diskon: nama_diskon,
                jumlah_diskon: jumlah_diskon,
                jenis: jenis,
                status_diskon: radio
            }
            if (nama_diskon == '' | jumlah_diskon == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Terdapat Field Kosong!',
                })
            } else if (jenis == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Kelompok Sparepart belum dipilih!',
                })
            } else {
                var sweet_loader =
                    '<div class="sweet_loader"><svg viewBox="0 0 140 140" width="140" height="140"><g class="outline"><path d="m 70 28 a 1 1 0 0 0 0 84 a 1 1 0 0 0 0 -84" stroke="rgba(0,0,0,0.1)" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round"></path></g><g class="circle"><path d="m 70 28 a 1 1 0 0 0 0 84 a 1 1 0 0 0 0 -84" stroke="#71BBFF" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-dashoffset="200" stroke-dasharray="300"></path></g></svg></div>';

                $.ajax({
                    method: 'post',
                    url: "/frontoffice/diskon",
                    data: data,
                    beforeSend: function () {
                        swal.fire({
                            title: 'Mohon Tunggu!',
                            html: 'Data Diskon Sedang Diproses...',
                            showConfirmButton: false,
                            onRender: function () {
                                // there will only ever be one sweet alert open.
                                $('.swal2-content').prepend(sweet_loader);
                            }
                        });
                    },
                    success: function (response) {
                        swal.fire({
                            icon: 'success',
                            showConfirmButton: false,
                            html: '<h5>Success!</h5>'
                        });
                        window.location.href = '/frontoffice/diskon/'
                    },
                    error: function (error) {
                        swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            html: error.responseJSON.message
                        });
                    }
                });
            }

        } else if (radio == 'Diskon Khusus') {
            var data = {
                _token: _token,
                kode_diskon: kode_diskon,
                nama_diskon: nama_diskon,
                jumlah_diskon: jumlah_diskon,
                status_diskon: radio,
                min_order: min_order
            }
            if (nama_diskon == '' | jumlah_diskon == '' | min_order == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Terdapat Field Kosong!',
                })
            
            } else {
                var sweet_loader =
                    '<div class="sweet_loader"><svg viewBox="0 0 140 140" width="140" height="140"><g class="outline"><path d="m 70 28 a 1 1 0 0 0 0 84 a 1 1 0 0 0 0 -84" stroke="rgba(0,0,0,0.1)" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round"></path></g><g class="circle"><path d="m 70 28 a 1 1 0 0 0 0 84 a 1 1 0 0 0 0 -84" stroke="#71BBFF" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-dashoffset="200" stroke-dasharray="300"></path></g></svg></div>';

                $.ajax({
                    method: 'post',
                    url: "/frontoffice/diskon",
                    data: data,
                    beforeSend: function () {
                        swal.fire({
                            title: 'Mohon Tunggu!',
                            html: 'Data Diskon Sedang Diproses...',
                            showConfirmButton: false,
                            onRender: function () {
                                // there will only ever be one sweet alert open.
                                $('.swal2-content').prepend(sweet_loader);
                            }
                        });
                    },
                    success: function (response) {
                        swal.fire({
                            icon: 'success',
                            showConfirmButton: false,
                            html: '<h5>Success!</h5>'
                        });
                        window.location.href = '/frontoffice/diskon/'
                    },
                    error: function (error) {
                        swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            html: error.responseJSON.message
                        });
                    }
                });
            }

        }



    }

</script>

@endsection
