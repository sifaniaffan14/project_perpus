<div class="accident-card card pb-6 mb-5 mb-xl-8">
    <div class="card-header border-0 align-items-center">
        <h2 class="text-dark-gray fw-bolder fs-3 mb-0"> Informasi Penting </h2>
    </div>
    <div class="card-body py-0 mt-5">
        <form action="javascript:onSave()" method="post" id="formInformasi" name="formInformasi" autocomplete="off" enctype="multipart/form-data" class="d-flex flex-column gap-5">
		    @csrf
            <input type="hidden" name="id">
            <div class="fv-row d-flex flex-column gap-1">
                <label for="isi_informasi" class="required fw-bolder fs-5">Isi Informasi</label>
                <textarea placeholder="Masukkan isi informasi" rows="5" cols="30" name="isi_informasi" id="isi_informasi" class="border-0 py-4 px-5 fs-5" style="
                                background-color: #fafafa;
                                border-radius: 6px;
                              " required ></textarea>
            </div>
            <div class="mt-5">
				<div class="d-flex gap-4">
					<button type="button" class="btn btn-outline-primary btn-outline border-2 text-body m-0 fw-bolder w-100 actCreate" onclick="onClear(this)"> Reset </button>
					<button type="submit" class="btn btn-primary m-0 d-flex flex-center gap-2 fw-bolder w-100 actCreate">
						<span class="material-icons-outlined fs-2">save</span> Simpan 
					</button>
				</div>
				<div class="d-flex gap-4">
					<button type="button" onclick="onDisplayEdit(this)" class="btn btn-outline-warning btn-outline border-2 d-flex flex-center gap-2 m-0 fw-bolder w-100 d-none actEdit">
						<span class="material-icons-outlined">edit</span> Ubah
					</button>
					<button type="button" onclick="onDelete(this)" class="btn btn-danger m-0 d-flex flex-center gap-2 fw-bolder w-100 d-none actEdit">
						<span class="material-icons-outlined">delete</span> Hapus
					</button>
				</div>
			</div>
        </form>
    </div>
</div>