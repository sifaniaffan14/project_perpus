<div>
    <div class="detail_data d-none row gy-5 g-xl-8">
        <div class="col-12">
            <div class="data-card card pb-6 mb-5 mb-xl-8" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
    border-radius: 10px;">
                <form action="javascript:onSave()" name="formPeminjaman" id="formPeminjaman">
                    <div class="card-header pb-5 belum_verif">
                        <h2 class="text-dark-gray fw-bolder fs-3 d-flex align-items-center gap-5 mb-0">
                            <span class="material-icons" style="color:#264A8A"> text_snippet </span> Pengajuan Perpanjangan
                        </h2>
                        <div class="form-action-wrapper d-flex gap-4 align-items-center mt-5 w-50 justify-content-end">
                            <button type="button"
                                class="btn p-4 text-body m-0 fw-bolder w-25 actCreate" style="border:1px solid #264A8A"
                                onclick="onClear()"> <span style="color:#264A8A">Batal</span> </button>
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
                    <div class="card-header pb-5 verif">
                        <h2 class="text-dark-gray fw-bolder fs-3 d-flex align-items-center gap-5 mb-0">
                            <span class="material-icons" style="color:#264A8A"> text_snippet </span> Pengajuan Perpanjangan
                        </h2>
                        <div class="form-action-wrapper d-flex gap-4 align-items-center mt-5 w-50 justify-content-end">
                            <button type="button"
                            class="btn p-4 m-0 d-flex flex-center gap-2 fs-5 fw-bolder w-25 text-light actCreate" style="background-color:#264A8A"
                                onclick="back()"> <span>Kembali</span> </button>
                        </div>
                    </div>
                    <div class="mx-auto" style="width:90%">
                        <div class="text-header">
                            <h2 class="text-center mt-3">
                                Data Peminjam
                            </h2>
                        </div>
                        <div class="mx-auto p-5" style="width:65%; border-bottom: 1px solid #eff2f5">
                            <div class="d-flex flex-wrap mt-5 mb-5 pt-5">
                                <p class="fs-5 ps-5 fw-bolder w-50" id="no_induk">No. Induk : </p>
                                <p class="fs-5 ps-5 fw-bolder w-50" id="jenis_anggota">Jenis Anggota : </p>
                                <p class="fs-5 ps-5 fw-bolder w-50" id="tgl_pinjam">Tgl Pinjam : </p>
                                <p class="fs-5 ps-5 fw-bolder w-50" id="tgl_kembali">Tgl Kembali : </p>
                            </div>
                        </div>
                        <div class="text-header">
                            <h2 class="text-center mt-2">
                                Data Buku
                            </h2>
                        </div>
                    </div>
                    <div class="mt-5 pt-5 mx-auto" style="width:95%">
                        <div class="card-body py-0 mx-auto">
                            <table class="table" id="tableBuku">
                                <thead>
                                    <tr>
                                        <th class="fw-bolder text-center" style="max-width: 20px"> No </th>
                                        <th class="fw-bolder text-center">Kode Eksemplar</th>
                                        <th class="fw-bolder text-center">Judul Buku</th>
                                        <th class="fw-bolder text-center">Tgl Pinjam</th>
                                        <th class="fw-bolder text-center tglKembali">Tgl Kembali(Baru)</th>
                                        <th class="fw-bolder text-center status">Status</th>
                                        <th class="fw-bolder text-center alasan">Alasan Perpanjangan</th>
                                        <th class="fw-bolder text-center action">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="list_perpanjangan"></tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
            <!-- modal -->
            <div class="modal fade" id="staticBackdrop" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content w-auto mx-auto">
                    <div class="modal-header border-bottom-3 border-secondary">
                        <h3 class="modal-title" id="staticBackdropLabel">Alasan Perpanjangan</h3>
                    </div>
                    <div class="modal-body">
                        <textarea rows="8" cols="40" name="alasan" id="alasan" class="border-0 py-4 px-5 fs-5" style="
                                    background-color: #EFF2F5;
                                    border-radius: 6px;
                                " disabled ></textarea>
                    </div>
                    <div class="pt-0 modal-footer">
                        <button type="button" class="btn text-light" style="background-color:#264A8A" data-bs-dismiss="modal">Kembali</button>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
