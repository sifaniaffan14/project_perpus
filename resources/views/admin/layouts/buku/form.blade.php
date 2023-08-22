<div class="form_data row gy-5 g-xl-8 d-none">
    <div class="col-12">
        <div class="card pb-6 mb-5 mb-xl-8" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
    border-radius: 10px;">
            <div class="card-header border-0 d-flex align-items-center justify-content-between position-sticky top-0 bg-white" style="z-index: 99;">
                <h2 class="text-dark-gray fw-bolder fs-3 d-flex align-items-center gap-5 mb-0 actCreate actCreate1">Tambah Buku</h2>
                <h2 class="text-dark-gray fw-bolder fs-3 d-flex align-items-center gap-5 mb-0 d-none actEdit actEdit1">Edit Buku</h2>
                <h2 class="text-dark-gray fw-bolder fs-3 d-flex align-items-center gap-5 mb-0 d-none dataBuku">Data Buku</h2>
                <div class="form-action-wrapper d-flex gap-4 align-items-center mt-5 w-50 justify-content-end">
                    <button type="button" class="btn text-body m-0 fw-bolder w-25 actCreate" style="border:1px solid #264A8A;" onclick="closeForm()"> <span style="color:#264A8A">Batal</span> </button>
                    <button type="button" class="btn m-0 d-flex flex-center gap-2 fw-bolder w-25 text-light actCreate" style="background-color:#264A8A" onclick="onSubmitForm()">
                        <span class="material-icons-outlined fs-2">save</span> Simpan 
                    </button>
                    <button type="button" onclick="onDisplayEdit(this)" class="btn btn-warning text-light border-2 d-flex flex-center gap-2 m-0 fw-bolder w-25 d-none actEdit" style="background-image: #FFA600">
                        <span class="material-icons-outlined">edit</span> Ubah
                    </button>
                    <button type="button" onclick="onDelete(this)" class="btn btn-danger m-0 d-flex flex-center gap-2 fw-bolder w-25 d-none actEdit" data-roleable="true" data-role="Bandara.Delete">
                        <span class="material-icons-outlined">delete</span> Hapus
                    </button>
                </div>
            </div>
            <div class="card-body py-0 mt-5 pt-5">
                <form onsubmit="onSave(event)" class="d-flex flex-wrap gap-5 justify-content-center" id="formBuku" name="formBuku" method="POST" autocomplete="off" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="d-flex flex-column gap-1 pe-5" style="width:49%">
                        <label for="kode_buku" class="fw-bolder">Kode Buku</label>
                        <input type="text" name="kode_buku" id="kode_buku" required placeholder="Masukkan Kode Buku" class="border-0 py-4 px-5" style="
                                    background-color: #fafafa;
                                    border-radius: 6px;
                                    " required />
                    </div>
                    <div class="d-flex flex-column gap-1 pe-5" style="width:49%">
                        <label for="buku_kategori_id" class="fw-bolder">Kategori Buku</label>
                        <select name="buku_kategori_id" id="buku_kategori_id" class="py-4 ps-5 pe-12 border-0 text-gray w-100 fs-6 text-light-gray" style="
                                    background-color: #fafafa;
                                    border-radius: 6px;
                                    " required>
                        </select>
                    </div>
                    <div class="d-flex flex-column gap-1 pe-5" style="width:49%">
                        <label for="judul" class="fw-bolder">Judul Buku</label>
                        <input type="text" name="judul" id="judul" required placeholder="Masukkan Judul Buku" class="border-0 py-4 px-5" style="
                                    background-color: #fafafa;
                                    border-radius: 6px;
                                    " required />
                    </div>
                    <div class="d-flex flex-column gap-1 fill-2-grid-col-lg pe-5" style="width:49%">
                        <label for="penerbit" class="fw-bolder">Penerbit</label>
                        <input type="text" name="penerbit" id="penerbit" required placeholder="Masukkan Penerbit Buku" class="border-0 py-4 px-5" style="
                                    background-color: #fafafa;
                                    border-radius: 6px;
                                    " required />
                    </div>
                    <div class="d-flex flex-column gap-1 fill-2-grid-col-lg pe-5" style="width:49%">
                        <label for="pengarang" class="fw-bolder">Pengarang</label>
                        <input type="text" name="pengarang" id="pengarang" required placeholder="Masukkan Pengarang Buku" class="border-0 py-4 px-5" style="
                                    background-color: #fafafa;
                                    border-radius: 6px;
                                    " required />
                    </div>
                    <div class="d-flex flex-column gap-1 fill-2-grid-col-lg pe-5" style="width:49%">
                        <label for="no_isbn" class="fw-bolder">No. ISBN</label>
                        <input type="text" name="no_isbn" id="no_isbn" required placeholder="Masukkan Nomer ISBN" class="border-0 py-4 px-5" style="
                                    background-color: #fafafa;
                                    border-radius: 6px;
                                    " required />
                    </div>
                    <div class="d-flex flex-column gap-1 fill-2-grid-col-lg pe-5" style="width:49%">
                        <label for="halaman" class="fw-bolder">Jumlah Halaman Buku</label>
                        <input type="text" name="halaman" id="halaman" required placeholder="Masukkan Jumlah Halaman Buku" class="border-0 py-4 px-5" style="
                                    background-color: #fafafa;
                                    border-radius: 6px;
                                    " required />
                    </div>
                    <div class="pe-5" style="width:49%">
                        <div class="d-flex flex-column gap-1">
                            <label class="fw-bolder">Gambar Cover Buku</label>
                            <div class="d-flex align-items-center gap-3">
                                <label for="image" class="d-flex flex-center gap-2 btn text-light label-input" style="background-color:#264A8A">
                                    <span class="material-icons fs-3"> upload </span> Pilih File </label>
                                <span class="text-light-gray file-chosen">Tidak ada file terpilih</span>
                                <input id="image" name="image" type="file" hidden accept="image/png, image/gif, image/jpeg, image/jpg"/>
                            </div>
                        </div>
                        <p class="text-danger m-0 mt-2" id="gambar_error">*gambar format file jpg,png,jpeg - max file 5MB</p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
