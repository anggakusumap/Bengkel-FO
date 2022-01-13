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
                            <div class="page-header-icon" style="color: white"><i class="fas fa-wallet"></i>
                            </div>
                            <div class="page-header-subtitle" style="color: white">Detail Diskon

                            </div>
                        </h1>

                    </div>
                    <div class="col-12 col-xl-auto">
                        <a href="{{ route('diskon.index') }}" class="btn btn-sm btn-light text-primary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container mt-n10">

        <div class="card mb-4">
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label class="small mb-1" for="tahun_gaji">Kode Diskon</label>
                        <input class="form-control" id="tahun_gaji" type="text" name="tahun_gaji"
                            placeholder="Input Tahun Gaji" value="{{ $item->kode_diskon }}" readonly />
                    </div>
                    <div class="form-group col-md-4">
                        <label class="small mb-1" for="tahun_gaji">Nama Diskon</label>
                        <input class="form-control" id="tahun_gaji" type="text" name="tahun_gaji"
                            placeholder="Input Tahun Gaji" value="{{ $item->nama_diskon }}" readonly />
                    </div>
                    <div class="form-group col-md-4">
                        <label class="small mb-1" for="bulan_gaji">Jumlah Diskon</label>
                        <input class="form-control" id="tahun_gaji" type="text" name="tahun_gaji"
                            placeholder="Input Tahun Gaji" value="{{ $item->jumlah_diskon }}%" readonly />
                    </div>
                    @if ($item->status_diskon == 'Diskon Khusus')
                    <div class="form-group col-md-4">
                        <label class="small mb-1" for="bulan_gaji">Minimal Order</label>
                        <input class="form-control" id="tahun_gaji" type="text" name="tahun_gaji"
                            placeholder="Input Tahun Gaji" value="{{ $item->min_order }}%" readonly />
                    </div>
                    @else

                    @endif
                </div>
            </div>
        </div>
    </div>

    @if ($item->status_diskon == 'Diskon Umum')
    <div class="container">
        <div class="card card-collapsable">
            <a class="card-header" href="#collapseCardExample" data-toggle="collapse" role="button" aria-expanded="true"
                aria-controls="collapseCardExample">Detail Kelompok Diskon
                <div class="card-collapsable-arrow">
                    <i class="fas fa-chevron-down"></i>
                </div>
            </a>
            <div class="collapse show" id="collapseCardExample">
                <div class="card-body">
                    <div class="datatable">
                        <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-bordered table-hover dataTable" id="dataTable"
                                        width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info"
                                        style="width: 100%;">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                    colspan="1" aria-sort="ascending"
                                                    aria-label="Name: activate to sort column descending"
                                                    style="width: 20px;">
                                                    No</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                    colspan="1" aria-label="Position: activate to sort column ascending"
                                                    style="width: 80px;">
                                                    Jenis Sparepart</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($item->Detail as $detail)
                                            <tr role="row" class="odd">
                                                <th scope="row" class="small" class="sorting_1">
                                                    {{ $loop->iteration}}.</th>
                                                <td>{{ $detail->jenis_sparepart }}</td>
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
    @else

    @endif


</main>

@endsection
