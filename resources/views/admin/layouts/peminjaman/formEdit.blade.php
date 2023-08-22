<div class="form_data row gy-5 g-xl-8 d-none">
    <div class="col-12">
        <div class="data-card card pb-6 mb-5 mb-xl-8">
            <div class="card-body p-0">
                <form action="javascript:onUpdate()" name="formPeminjaman" id="formPeminjaman">
                    <div class="card-header">
                        <h2 class="text-dark-gray fw-bolder fs-3 d-flex align-items-center gap-5 mb-0">
                            <span class="material-icons" style="color:#264A8A"> text_snippet </span> Peminjaman Buku
                        </h2>
                        <div class="form-action-wrapper d-flex gap-4 align-items-center mt-5 w-50 justify-content-end">
                            <button type="button"
                                class="btn p-4 text-body m-0 fw-bolder w-25 actCreate" style="border:1px solid #264A8A"
                                onclick="closeForm()"><span style="color:#264A8A"> Batal </span></button>
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
                    <div class="text-header">
                        <h2 class="text-center fw-bolder" style="padding-top: 4vh;">
                            Data Peminjam
                        </h2>
                    </div>
                    <div class="mx-auto mt-5 pt-3" style="width:90%">
                        <div class="pb-3">
                            <input type="hidden" name="peminjaman_id">
                            <div>
                                <label for="anggota_id" class="fs-4 fw-bolder">No. Induk</label>
                                <div class="mt-1">
                                    <select name="anggota_id" id="anggota_id" class="form-control">
                                        <option value="" selected disabled>Silahkan Pilih No. Induk</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="text-content mx-auto" style="width:85%" id="identitas_peminjam">
                        </div>
                        <hr style="width: 100%; margin:2.5vw 0;text-align: center;  border-top: 2px solid grey; ">
                        <div class="text-header" style="margin-top:-1.5vh">
                            <h2 class="text-center fw-bolder">
                                Data Buku
                            </h2>
                        </div>
                        <div class="d-flex mt-8 pt-3">
                            <div class="w-50 d-flex">
                                <div class="ms-auto d-flex align-items-center" style="width:100%">
                                    <label class="fw-bolder fs-4 w-25" for="start">Tgl Pinjam&nbsp;&nbsp;:</label>
                                    <input type="date" class="form-control" name="tgl_pinjam" placeholder="dd-mm-yyyy" value="">
                                    <div style="width:10%"></div>
                                </div>
                            </div>
                            <div class="w-50 d-flex">
                                <div class="me-auto d-flex align-items-center" style="width:100%">
                                    <div style="width:10%"></div>
                                    <label class="fw-bolder fs-4" style="width:28%" for="start">Tgl Kembali&nbsp;&nbsp;:</label>
                                    <input type="date" class="form-control" name="tgl_kembali" placeholder="dd-mm-yyyy" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-9 mb-5">
                            <label class="fs-5 mb-2" for="kode_eksemplar">Kode Eksemplar</label>
                            <input type="text" class="form-control w-25" id="kode_eksemplar"
                                placeholder="Masukkan Kode Eksemplar" />
                        </div>
                        <div class="card-body py-0">
                            <table class="table mx-auto" style="width:60%" id="tablePinjamanEdit">
                                <thead>
                                    <tr>
                                        <th class="fw-bolder text-center" style="max-width: 20px"> No </th>
                                        <th class="fw-bolder text-center">Kode Eksemplar</th>
                                        <th class="fw-bolder text-center">Judul Buku</th>
                                        <th class="fw-bolder text-center pe-5" style="width:10%">Action</th>
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



