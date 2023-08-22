@extends('master.landing')

@section('content')
<div>
    <div class="row gy-5 g-xl-8">
        <div class="col-12">
            <div class="data-card card pb-6 mb-5 mb-xl-8" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
    border-radius: 10px;">
                <div class="card-body p-0">
                    <div class="card-header">
                        <h2 class="text-dark-gray fw-bolder fs-3 d-flex align-items-center gap-5 mb-0">
                            <span class="material-icons" style="color:#264A8A"> text_snippet </span> Pengembalian Buku
                        </h2>
                        <div class="form-action-wrapper d-flex gap-4 align-items-center mt-5 w-50  justify-content-end">
                            <button type="button"
                                class="btn p-4 text-body m-0 fw-bolder w-25 actCreate" style="border:1px solid #264A8A"
                                onclick="onClear()"><span style="color:#264A8A"> Batal </span></button>
                            <button type="button"
                                class="btn p-4 m-0 d-flex flex-center gap-2 fs-5 fw-bolder w-25 text-light actCreate" style="background-color:#264A8A" onclick="onSave()">
                                <span class="material-icons-outlined fs-2">save</span> Simpan
                            </button>
                        </div>
                    </div>
                    <div class="mx-auto" style="width:90%">
                        <div
                            style="border-bottom: 1px solid #eff2f5">
                            <div class="gap-5 mb-3 align-items-lg-center w-100 mt-3">
                                <label for="kode_peminjaman" class="fs-4 fw-bolder">No. Induk</label>
                                <div class="position-relative mt-1 w-lg-25" style="cursor:pointer;" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                    <select id="select_anggota_id" style="width: 100%" disabled>
                                        <option value="#" selected disabled>Silahkan Pilih No. Induk</option>
                                    </select>
                                    <input type="hidden" name="anggota_id" id="anggota_id" value="">
                                </div>
                                <!-- Modal -->
                                <div class="modal fade modalAnggota" id="staticBackdrop" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content p-5">
                                        <div class="modal-body">
                                            <div class="position-relative">
                                                <input type="search" name="search_anggota" id="search_anggota"
                                                    placeholder="Ketik untuk mencari" class="py-3 ps-12 pe-5 fs-6 w-100"
                                                    style="background-color: #fafafa;border-radius: 6px; border-width:1.5px" />
                                                <span class="material-icons position-absolute top-50 translate-middle-y text-light-gray"
                                                    style="left: 10px"> search </span>
                                            </div>
                                            <table class="table" id="tabelAnggota" style="cursor:pointer">
                                                <thead>
                                                    <tr>
                                                        <th class="fw-bolder" style="max-width: 37px"> No </th>
                                                        <th class="fw-bolder d-none">Id</th>
                                                        <th class="fw-bolder">No. Induk</th>
                                                        <th class="fw-bolder">Nama</th>
                                                        <th class="fw-bolder">Jenis Anggota</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-header d-none">
                            <h2 class="text mt-5 fs-3 fw-bolder">
                                Data Peminjaman
                            </h2>
                        </div>
                        <div class="text-content ms-5 ps-5" id="identitas_peminjam">
                        </div>
                        <div class="header-eksemplar d-none" style="padding:4vh; padding-bottom:2vh;">
                            <h2 style="text-align: center; font-weight:bold;">Data Buku</h2>
                        </div>
                        <div class="card-body card-eksemplar py-0 d-none">
                            <div class="row mb-2">
                                <label class="fs-6 mb-2" for="kode_eksemplar">Kode Eksemplar</label>
                                <input type="text" class="form-control w-25" id="kode_eksemplar"
                                    placeholder="Masukkan Kode Eksemplar" onchange="onPengembalian()" />
                            </div>
                            <form action="" name="formPengembalian" id="formPengembalian">
                                <input type="hidden" name="peminjaman_id">
                                <table class="table w-100" id="tableEksemplar">
                                    <thead>
                                        <tr>
                                            <th class="fw-bolder text-center" style="max-width: 20px"> No </th>
                                            <th class="fw-bolder text-center">Kode Eksemplar</th>
                                            <th class="fw-bolder text-center">Judul Buku</th>
                                            <th class="fw-bolder text-center">Tgl Pinjam</th>
                                            <th class="fw-bolder text-center">Tgl Kembali</th>
                                            <th class="fw-bolder text-center" style="width:10%">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="listTable" class="text-center"></tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@section('js')
@include('admin.layouts.pengembalian.javascript')
@endsection
