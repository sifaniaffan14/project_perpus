@extends('master.landing')

@section('content')

<div>
    <div class="main_data row gy-5 g-xl-8">
        <div class="col-12">
            <div class="filter-card card pb-6 mb-5 mb-xl-8" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
    border-radius: 10px;">
                <div class="card-header">
                    <h2 class="text-dark-gray fw-bolder fs-3 d-flex align-items-center gap-5 mb-0">
                        <span class="material-icons" style="color:#264A8A"> filter_alt </span> Filter
                    </h2>
                </div>
                <div class="card-body">
                    <!-- <div class="d-flex flex-column flex-lg-row flex-stack  mx-auto"
                    style="border-bottom: 1px solid #eff2f5; width:90%"> -->
                    <div class="row">
                        <div class="col-lg-3 col-12 d-flex flex-center gap-3 mb-3 mb-lg-0">
                            <label class="form-label fw-bolder min-w-70px">Tahun : </label>
                            <select class="form-control" name="tahun" id="tahun" style="">
                                <option value="#" selected disabled hidden>Pilih tahun</option>
                            </select>
                        </div>
                        <div class="col-lg-3 col-12 d-flex flex-center gap-3 m-lg-0 my-3">
                            <label class="form-label fw-bolder min-w-70px">Bulan : </label>
                            <select class="form-control" name="bulan" id="bulan" disabled>
                                <option value="#" selected disabled hidden>Pilih bulan</option>
                            </select>
                        </div>
                        <div class="col-lg-3 col-12 d-flex flex-center gap-3 m-lg-0 my-3">
                            <label class="form-label fw-bolder min-w-70px">Tanggal : </label>
                            <select class="form-control" name="tanggal" id="tanggal" disabled>
                                <option value="#" selected disabled hidden>Pilih tanggal</option>
                            </select>
                        </div>
                        <div class="col-lg-3 d-flex flex-center gap-4">
                            <button type="button" class="btn btn-sm text-light w-50"
                                    style="background-color:#264A8A;"
                                    onclick="onFilter()">
                                    <span class="material-icons fs-6 pt-2">search</span> 
                                    <span class="fs-6">Cari</span>
                                </button>
                            <button type="button" class="btn btn-sm text-light w-50"
                                    style="background-color:#03BE43;"
                                    onclick="onDownload()">
                                    <span class="material-icons fs-6 pt-2"> print </span>
                                    <span class="fs-6">Cetak</span>
                                </button>
                        </div>
                </div>
                </div>  
            </div>
            <div class="data-card card pb-6 mb-5 mb-xl-8" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
    border-radius: 10px;">
                <div class="card-header">
                    <h2 class="text-dark-gray fw-bolder fs-3 d-flex align-items-center gap-5 mb-0">
                        <span class="material-icons" style="color:#264A8A"> text_snippet </span> Data Peminjaman
                    </h2>
                </div>
                <div class="d-flex flex-column flex-lg-row flex-stack py-5 px-9"
                    style="border-bottom: 1px solid #eff2f5">
                    <div class="d-flex flex-column flex-lg-row gap-5 align-items-lg-center w-100">
                        <label for="search_peminjaman" class="fs-4">Search</label>
                        <div class="position-relative w-lg-50">
                            <input type="search" name="search_peminjaman" id="search_peminjaman"
                                placeholder="Ketik untuk mencari" class="border-0 py-4 ps-12 pe-5 fs-5 w-100"
                                style="background-color: #fafafa;border-radius: 6px;" />
                            <span class="material-icons position-absolute top-50 translate-middle-y text-light-gray"
                                style="left: 10px"> search </span>
                        </div>
                    </div>
                    <div class="d-flex gap-4 mt-5">
                        <button type="button"
                            class="btn btn-outline-primary btn-outline border-2 text-body m-0 fw-bolder w-100 d-flex flex-center p-3"
                            onclick="onRefresh()">
                            <span class="material-icons fs-2"> refresh </span>
                        </button>
                    </div>
                </div>
                <div class="card-body py-0">
                    <table class="table" id="tablePeminjaman">
                        <thead>
                            <tr>
                                <th class="fw-bolder" style="max-width: 37px"> No </th>
                                <th class="fw-bolder">Nama Peminjam</th>
                                <th class="fw-bolder">Jumlah Buku</th>
                                <th class="fw-bolder">Belum Kembali</th>
                                <th class="fw-bolder">Sudah Kembali</th>
                                <th class="fw-bolder">Status</th>
                                <th class="fw-bolder">Detail</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('admin.layouts.peminjaman.formEdit')
    @include('admin.layouts.peminjaman.detail')
</div>

@endsection

@section('js')
@include('admin.layouts.peminjaman.javascript')
@endsection