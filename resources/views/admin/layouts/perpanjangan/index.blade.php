@extends('master.landing')

@section('content')

<style>
.tab-menu p:hover {
    border-bottom: 1px solid #0094FF;
    color: #0094FF;
}
.menu-nonaktif {
    border-bottom: 1px solid black;
    color: black;
}
.menu-aktif {
    border-bottom: 1px solid #0094FF;
    color: #0094FF;
}
</style>

<div>
    <div class="main_data row gy-5 g-xl-8">
        <div class="col-12">
            <div class="data-card card pb-6 mb-5 mb-xl-8" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
    border-radius: 10px;">
                <div class="card-header">
                    <h2 class="text-dark-gray fw-bolder fs-3 d-flex align-items-center gap-5 mb-0">
                        <span class="material-icons" style="color:#264A8A"> text_snippet </span> Perpanjangan Buku
                    </h2>
                </div>
                <div class="tab-menu">
                    <div class="d-flex gap-5 mx-auto" style="width:90%">
                        <div class="text-center mt-5 me-5 pt-4">
                            <p class="m-0 pb-2 menu1 menu-aktif" onclick="changeTab('belum_verif')"  style="width:150px; cursor:pointer">Belum Verifikasi</p>
                        </div>
                        <div class="text-center mt-5 ms-5 pt-4">
                            <p class="m-0 pb-2 menu2 menu-nonaktif" onclick="changeTab('verif')" style="width:150px; cursor:pointer">Sudah Verifikasi</p>
                        </div>
                    </div>
                    <hr class="m-0">
                </div>
                <div class="belum_verif">
                    <div class="d-flex flex-column flex-lg-row flex-stack py-5 px-9"
                        style="border-bottom: 1px solid #eff2f5">
                        <div class="d-flex flex-column flex-lg-row gap-5 align-items-lg-center w-100">
                            <label for="search_peminjaman1" class="fs-4">Search</label>
                            <div class="position-relative w-lg-50">
                                <input type="search" name="search_peminjaman1" id="search_peminjaman1"
                                    placeholder="Ketik untuk mencari" class="border-0 py-4 ps-12 pe-5 fs-5 w-100"
                                    style="background-color: #fafafa;border-radius: 6px;" />
                                <span class="material-icons position-absolute top-50 translate-middle-y text-light-gray"
                                    style="left: 10px"> search </span>
                            </div>
                        </div>
                        <div class="d-flex gap-4 mt-5">
                            <button type="button"
                                class="btn btn-outline-primary btn-outline border-2 text-body m-0 fw-bolder w-100 d-flex flex-center p-3"
                                onclick="onRefreshTable()">
                                <span class="material-icons fs-2"> refresh </span>
                            </button>
                        </div>
                    </div>
                    <div class="card-body py-0">
                        <table class="table mx-auto" id="table_belumverif" style="width:95%">
                            <thead>
                                <tr>
                                    <th class="fw-bolder" style="max-width: 37px"> No </th>
                                    <th class="fw-bolder">Nama Peminjam</th>
                                    <th class="fw-bolder">Jumlah Buku</th>
                                    <th class="fw-bolder">Tgl Pinjam</th>
                                    <th class="fw-bolder">Tgl Kembali</th>
                                    <th class="fw-bolder">Detail</th>
                                </tr>
                            </thead>
                            <tbody id="list_table_belumverif"></tbody>
                        </table>
                    </div>
                </div>
                <div class="verif d-none">
                    <div class="d-flex flex-column flex-lg-row flex-stack py-5 px-9"
                        style="border-bottom: 1px solid #eff2f5">
                        <div class="d-flex flex-column flex-lg-row gap-5 align-items-lg-center w-100">
                            <label for="search_peminjaman2" class="fs-4">Search</label>
                            <div class="position-relative w-lg-50">
                                <input type="search" name="search_peminjaman2" id="search_peminjaman2"
                                    placeholder="Ketik untuk mencari" class="border-0 py-4 ps-12 pe-5 fs-5 w-100"
                                    style="background-color: #fafafa;border-radius: 6px;" />
                                <span class="material-icons position-absolute top-50 translate-middle-y text-light-gray"
                                    style="left: 10px"> search </span>
                            </div>
                        </div>
                        <div class="d-flex gap-4 mt-5">
                            <button type="button"
                                class="btn btn-outline-primary btn-outline border-2 text-body m-0 fw-bolder w-100 d-flex flex-center p-3"
                                onclick="onRefreshTable(this)">
                                <span class="material-icons fs-2"> refresh </span>
                            </button>
                        </div>
                    </div>
                    <div class="card-body py-0">
                        <table class="table mx-auto" id="table_verif" style="width:95%">
                            <thead>
                                <tr>
                                    <th class="fw-bolder" style="max-width: 37px"> No </th>
                                    <th class="fw-bolder">Nama Peminjam</th>
                                    <th class="fw-bolder">Jumlah Buku</th>
                                    <th class="fw-bolder">Tgl Pinjam</th>
                                    <th class="fw-bolder">Tgl Kembali</th>
                                    <th class="fw-bolder">Detail</th>
                                </tr>
                            </thead>
                            <tbody id="list_table_verif"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.layouts.perpanjangan.detail')
</div>

@endsection

@section('js')
@include('admin.layouts.perpanjangan.javascript')
@endsection