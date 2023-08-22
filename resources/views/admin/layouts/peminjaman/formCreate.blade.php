@extends('master.landing')

@section('content')

<div>
    <div class="row gy-5 g-xl-8">
        <div class="col-12">
            <div class="data-card card pb-6 mb-5 mb-xl-8" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
    border-radius: 10px;">
                <form action="javascript:onSave()" name="formPeminjaman" id="formPeminjaman">
                    <div class="card-header pb-5">
                        <h2 class="text-dark-gray fw-bolder fs-3 d-flex align-items-center gap-5 mb-0">
                            <span class="material-icons" style="color:#264A8A"> text_snippet </span> Peminjaman Buku
                        </h2>
                        <div class="form-action-wrapper d-flex gap-4 align-items-center mt-5 w-50 justify-content-end">
                            <button type="button"
                                class="btn p-4 text-body m-0 fw-bolder w-25 actCreate" style="border:1px solid #264A8A"
                                onclick="onClear()"> <span style="color:#264A8A">Reset</span> </button>
                            <button type="submit"
                                class="btn p-4 m-0 d-flex flex-center gap-2 fs-5 fw-bolder w-25 text-light actCreate" style="background-color:#264A8A">
                                <span class="material-icons-outlined fs-2">save</span> Simpan
                            </button>
                            <button type="button" onclick="onDisplayEdit(this)"
                                class="btn btn-outline-warning btn-outline border-2 d-flex flex-center gap-2 m-0 fw-bolder w-100 d-none actEdit">
                                <span class="material-icons-outlined">edit</span> Ubah
                            </button>
                            <button type="button" onclick="onDelete(this)"
                                class="btn btn-danger m-0 d-flex flex-center gap-2 fw-bolder w-100 d-none actEdit"
                                data-roleable="true" data-role="Bandara.Delete">
                                <span class="material-icons-outlined">delete</span> Hapus
                            </button>
                        </div>
                    </div>
                    <div class="mx-auto" style="width:90%">
                        <div class="text-header">
                            <h2 class="text-center mt-3">
                                Data Peminjam
                            </h2>
                        </div>
                        <div
                            style="border-bottom: 1px solid #eff2f5">
                            <div class="gap-5 mb-3 align-items-lg-center w-100 mt-3">
                                <label for="select_anggota_id" class="fs-4 fw-bolder">No. Induk</label>
                                <div class="position-relative w-lg-25" style="cursor:pointer;" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
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
                            <div class="text-content mx-auto" id="identitas_peminjam">
                            </div>
                        </div>
                        <div class="text-header">
                            <h2 class="text-center mt-2">
                                Data Buku
                            </h2>
                        </div>
                        <div class="mt-5 pt-5">
                            <div class="mb-3">
                                <label class="fs-4 fw-bolder" for="start">Tgl Pinjam&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</label>
                                <input type="date" name="tgl_pinjam" placeholder="dd-mm-yyyy" value="">
                            </div>
                            <div class="mb-5">
                                <label class="fs-4 fw-bolder" for="start">Tgl Kembali&nbsp;&nbsp;:&nbsp;</label>
                                <input type="date" name="tgl_kembali" placeholder="dd-mm-yyyy" value="">
                            </div>
                        </div>
                    </div>
                    <div class="mx-auto" style="width:90%">
                        <div class="pt-5 pe-5 me-5 mb-5 w-25 ms-auto">
                            <input type="text" class="form-control" id="kode_eksemplar"
                                placeholder="Masukkan Kode Eksemplar" />
                        </div>
                        <div class="card-body py-0 w-50 mx-auto">
                            <table class="table" id="tablePinjaman">
                                <thead>
                                    <tr>
                                        <th class="fw-bolder text-center" style="width: 20px"> No </th>
                                        <th class="fw-bolder text-center">Kode Eksemplar</th>
                                        <th class="fw-bolder text-center">Judul Buku</th>
                                        <th class="fw-bolder text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="list_pinjaman"></tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

@endsection

@section('js')
@include('admin.layouts.peminjaman.javascript')
@endsection
