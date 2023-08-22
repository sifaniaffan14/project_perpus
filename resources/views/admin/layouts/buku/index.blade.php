@extends('master.landing')

@section('content')

<div>
    <div class="main_data row gy-5 g-xl-8">
        <div class="col-12">
            <div class="data-card card pb-6 mb-5 mb-xl-8" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
    border-radius: 10px;">
                <div class="card-header">
                    <h2 class="text-dark-gray fw-bolder fs-3 d-flex align-items-center gap-5 mb-0">
                        <span class="material-icons" style="color:#264A8A"> text_snippet </span> Data Buku
                    </h2>
                </div>
                <div class="d-flex flex-column flex-lg-row flex-stack py-5 px-9"
                    style="border-bottom: 1px solid #eff2f5">
                    <div class="d-flex flex-column flex-lg-row gap-5 align-items-lg-center w-100">
                        <label for="search_buku" class="fs-4">Search</label>
                        <div class="position-relative w-lg-50">
                            <input type="search" name="search_buku" id="search_buku"
                                placeholder="Ketik untuk mencari" class="border-0 py-4 ps-12 pe-5 fs-5 w-100"
                                style="background-color: #fafafa;border-radius: 6px;" />
                            <span class="material-icons position-absolute top-50 translate-middle-y text-light-gray"
                                style="left: 10px"> search </span>
                        </div>
                    </div>
                    <div class="d-flex gap-4 mt-5">
                        <button type="button"
                            class="btn btn-outline-primary btn-outline border-2 text-body m-0 fw-bolder w-100 d-flex flex-center p-3"
                            onclick="onRefresh(this)">
                            <span class="material-icons fs-2"> refresh </span>
                        </button>
                        <button type="button" class="btn m-0 d-flex flex-center gap-2 fw-bolder w-100 text-light"
                            style="background-color:#264A8A"
                            onclick="loadForm()">
                            <span class="material-icons fs-2"> add </span> Tambah </button>
                    </div>
                </div>
                <div class="card-body py-0">
                    <table id="tabelBuku" class="table">
                        <thead>
                            <tr>
                                <th class="fw-bolder" style="max-width: 37px"> No </th>
                                <th class="fw-bolder">Kode Buku</th>
                                <th class="fw-bolder">Nama Buku</th>
                                <th class="fw-bolder">Penerbit</th>
                                <th class="fw-bolder">Kategori</th>
                                <th class="fw-bolder">Detail</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('admin.layouts.buku.form')
    @include('admin.layouts.buku.detail')
</div>

@endsection

@section('js')
@include('admin.layouts.buku.javascript')
@endsection