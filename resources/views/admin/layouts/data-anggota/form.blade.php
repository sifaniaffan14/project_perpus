<div class="form_data row gy-5 g-xl-8 d-none">
    <div class="col-12">
        <div class="card pb-6 mb-5 mb-xl-8" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
    border-radius: 10px;">
            <div class="card-header border-0 d-flex align-items-center justify-content-between position-sticky top-0 bg-white" style="z-index: 99;">
                <h2 class="text-dark-gray fw-bolder fs-3 d-flex align-items-center gap-5 mb-0 actCreate actCreate1">Tambah Anggota</h2>
                <h2 class="text-dark-gray fw-bolder fs-3 d-flex align-items-center gap-5 mb-0 d-none actEdit actEdit1">Edit Anggota</h2>
                <h2 class="text-dark-gray fw-bolder fs-3 d-flex align-items-center gap-5 mb-0 d-none dataAnggota">Data Anggota</h2>
                <div class="form-action-wrapper d-flex gap-4 align-items-center mt-5 w-50 justify-content-end">
                    <button type="button" class="btn text-body m-0 fw-bolder w-25 actCreate" style="border:1px solid #264A8A;" onclick="closeForm()"> <span style="color:#264A8A">Batal</span> </button>
                    <button type="button" class="btn m-0 d-flex flex-center gap-2 fw-bolder w-25 text-light actCreate" style="background-color:#264A8A" onclick="onSubmitForm()">
                        <span class="material-icons-outlined fs-2">save</span> Simpan 
                    </button>
                    <button type="button" onclick="onDisplayEdit(this)" class="btn btn-warning text-light border-2 d-flex flex-center gap-2 m-0 fw-bolder w-25 d-none actEdit">
                        <span class="material-icons-outlined">edit</span> Ubah
                    </button>
                    <button type="button" onclick="onDelete(this)" class="btn btn-danger m-0 d-flex flex-center gap-2 fw-bolder w-25 d-none actEdit" data-roleable="true" data-role="Bandara.Delete">
                        <span class="material-icons-outlined">delete</span> Hapus
                    </button>
                </div>
            </div>
            <div class="card-body py-0 mt-5 pt-5">
                <form onsubmit="onSave(event)" class="d-flex flex-wrap gap-5 justify-content-center" id="formAnggota" name="formAnggota" method="POST" autocomplete="off" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="d-flex flex-column gap-1 pe-5" style="width:49%">
                        <label for="no_induk" class="fw-bolder">No. Induk</label>
                        <input type="text" name="no_induk" id="no_induk" required placeholder="Masukkan No. Induk" class="border-0 py-4 px-5" style="
                                    background-color: #fafafa;
                                    border-radius: 6px;
                                    " required />
                    </div>
                    <div class="d-flex flex-column gap-1 pe-5" style="width:49%">
                        <label for="nama_anggota" class="fw-bolder">Nama Anggota</label>
                        <input type="text" name="nama_anggota" id="nama_anggota" required placeholder="Masukkan Nama Anggota" class="border-0 py-4 px-5" style="
                                    background-color: #fafafa;
                                    border-radius: 6px;
                                    " required />
                    </div>
                    <div class="d-flex flex-column gap-1 pe-5" style="width:49%">
                        <label for="jenis_kelamin" class="fw-bolder">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="py-4 ps-5 pe-12 border-0 text-gray w-100 fs-6 text-light-gray" style="
                                    background-color: #fafafa;
                                    border-radius: 6px;
                                    " required>
                            <option id="laki-laki" value="laki-laki">Laki - Laki</option>
                            <option id="perempuan" value="perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="d-flex flex-column gap-1 pe-5" style="width:49%">
                        <label for="tempat_lahir" class="fw-bolder">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" id="tempat_lahir" required placeholder="Masukkan Tempat Lahir" class="border-0 py-4 px-5" style="
                                    background-color: #fafafa;
                                    border-radius: 6px;
                                    " required />
                    </div>
                    <div class="d-flex flex-column gap-1 fill-2-grid-col-lg pe-5" style="width:49%">
                        <label for="tanggal_lahir" class="fw-bolder">Tanggal Lahir</label>
                        <div class="w-50">
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" placeholder="dd-mm-yyyy" value="" class="border-0 py-4 px-5" style="
                                        background-color: #fafafa;
                                        border-radius: 6px;
                                        " required >
                        </div>
                    </div>
                    <div class="d-flex flex-column gap-1 fill-2-grid-col-lg pe-5" style="width:49%">
                        <label for="jenis_anggota" class="fw-bolder">Jenis Anggota</label>
                        <input type="text" name="jenis_anggota" id="jenis_anggota" required placeholder="Masukkan Jenis Anggota" class="border-0 py-4 px-5" style="
                                    background-color: #fafafa;
                                    border-radius: 6px;
                                    " required />
                    </div>
                    <div class="d-flex flex-column gap-1 fill-2-grid-col-lg pe-5" style="width:49%">
                        <label for="alamat" class="fw-bolder">Alamat</label>
                        <input type="text" name="alamat" id="alamat" required placeholder="Masukkan Alamat" class="border-0 py-4 px-5" style="
                                    background-color: #fafafa;
                                    border-radius: 6px;
                                    " required />
                    </div>
                    <div class="d-flex flex-column gap-1 fill-2-grid-col-lg pe-5" style="width:49%">
                        <label for="email" class="fw-bolder">Email</label>
                        <input type="text" name="email" id="email" required placeholder="Masukkan Email" class="border-0 py-4 px-5" style="
                                    background-color: #fafafa;
                                    border-radius: 6px;
                                    " required />
                    </div>
                    <div class="d-flex flex-column gap-1 fill-2-grid-col-lg pe-5" style="width:49%">
                        <label for="no_telp" class="fw-bolder">No Telpon</label>
                        <input type="text" name="no_telp" id="no_telp" required placeholder="Masukkan No Telpon" class="border-0 py-4 px-5" style="
                                    background-color: #fafafa;
                                    border-radius: 6px;
                                    " required />
                    </div>
                    <div style="width:49%"></div>
                </form>
            </div>
        </div>
    </div>
</div>
