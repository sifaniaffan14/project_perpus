<div class="datail_data row gy-5 g-xl-8 d-none">
    <div class="col-12">
        <div class="data-card card pb-6 mb-5 mb-xl-8">
            <div class="card-header pb-5">
                <h2 class="text-dark-gray fw-bolder fs-3 d-flex align-items-center gap-5 mb-0">
                    <span class="material-icons" style="color:#264A8A"> text_snippet </span> Data Peminjaman
                </h2>
                <div class="form-action-wrapper d-flex gap-4 align-items-center mt-5 w-50 justify-content-end">
                    <button type="button" class="btn btn-outline-primary btn-outline border-2 text-body m-0 fw-bolder w-100 actCreate d-none" onclick="closeForm()"> Batal </button>
                    <button type="button" class="btn btn-primary m-0 d-flex flex-center gap-2 fw-bolder w-100 actCreate d-none" onclick="onSubmitForm()">
                        <span class="material-icons-outlined fs-2">save</span> Simpan 
                    </button>
                    <button type="button" onclick="onDisplayEdit(this)" class="btn btn-warning p-4 m-0 d-flex flex-center gap-2 fs-5 fw-bolder w-25 text-light actEdit">
                        <span class="material-icons-outlined">edit</span> Ubah
                    </button>
                    <button type="button" onclick="onDelete()" class="btn btn-danger p-4 m-0 d-flex flex-center gap-2 fs-5 fw-bolder w-25 text-light actEdit">
                        <span class="material-icons-outlined">delete</span> Hapus
                    </button>
                </div>
            </div>
            <div class="col-8 d-flex mx-auto">
                <div class="col-lg-12" style="padding: 10vh; padding-bottom:7vh; padding-top: 4vh;">
                    <h2 class="fw-bolder text-center">Data Peminjam</h2>
                    <p id="detail_peminjaman_id" style="display: none"></p>
                    <table class="w-50 mx-auto mt-9">
                        <tbody style="color: #000000; font-weight:bold">
                            <tr>
                                <td class="w-50 pt-6">
                                    <h5 class="fw-bolder" id="detail_no_induk"></h5>
                                </td>
                                <td class="w-50 pt-6">
                                    <h5 class="fw-bolder" id="detail_nama_anggota"></h5>
                                </td>
                            </tr>
                            <tr>
                                <td class="w-50 pt-5">
                                    <h5 class="fw-bolder" id="detail_jenis_anggota"></h5>
                                </td>
                                <td class="w-50 pt-5">
                                    <h5 class="fw-bolder" id="detail_peminjaman_jumlah"></h5>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <hr class="mx-auto" style="width: 80%; text-align: center;  border-top: 2px solid ">
            <div class="header-eksemplar" style="padding:3vh;">
                <h2 class="fw-bolder text-center">Data Buku</h2>
            </div>
                <div class="card-body py-0">
                    <table class="table w-75 mx-auto" id="tableEksemplar">
                        <thead>
                            <tr>
                                <th class="fw-bolder text-center" style="max-width: 20px"> No </th>
                                <th class="fw-bolder text-center">Kode Eksemplar</th>
                                <th class="fw-bolder text-center">Judul Buku</th>
                                <th class="fw-bolder text-center">Tgl Pinjam</th>
                                <th class="fw-bolder text-center">Tgl Kembali</th>
                            </tr>
                        </thead>
                        <tbody id="list_detail"></tbody>
                    </table>
                </div>
        </div>
    </div>
</div>