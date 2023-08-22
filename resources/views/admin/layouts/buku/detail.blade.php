<style>
    input[type="checkbox"] {
        width: 20px;
        height: 20px;
        }
</style>
<div class="datail_data row gy-5 g-xl-8 d-none">
    <div class="col-12">
        <div class="data-card card pb-6 mb-5 mb-xl-8" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
    border-radius: 10px;">
            <div class="card-header">
                <h2 class="text-dark-gray fw-bolder fs-3 d-flex align-items-center gap-5 mb-0">
                    <span class="material-icons" style="color:#264A8A"> text_snippet </span> Detail Buku
                </h2>
            </div>
            <div class="col-8 d-flex">
                <div class="col-lg-7" style="padding: 10vh; margin-left:45px">
                    <img src="" id="img" alt="" style="width:28vh; height:34vh">
                </div>
                <svg id="barcode"></svg>

                <div class="col-lg-10" style="padding: 10vh;">
                    <p id="detail_id" style="display:none;"></p>
                    <table style="width: 100%">
                        <tbody style="color: #000000;">
                            <tr>
                                <td width="37%">
                                    <p class="fs-4"> Kode Buku </p>
                                </td>
                                <td>
                                    <p class="fs-4"> : </p>
                                </td>
                                <td>
                                    <p class="fs-4" id="detail_kode_buku"></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="fs-4">Kategori Buku</p>
                                </td>
                                <td>
                                    <p class="fs-4"> : </p>
                                </td>
                                <td>
                                    <p class="fs-4" id="detail_nama_kategori"></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="fs-4">Judul Buku</p>
                                </td>
                                <td>
                                    <p class="fs-4"> : </p>
                                </td>
                                <td>
                                    <p class="fs-4" id="detail_judul"></p>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <p class="fs-4">No. ISBN</p>
                                </td>
                                <td>
                                    <p class="fs-4"> : </p>
                                </td>
                                <td>
                                    <p class="fs-4" id="detail_no_isbn"></p>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <p class="fs-4">Penerbit</p>
                                </td>
                                <td>
                                    <p class="fs-4"> : </p>
                                </td>
                                <td>
                                    <p class="fs-4" id="detail_penerbit"></p>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <p class="fs-4">Pengarang</p>
                                </td>
                                <td>
                                    <p class="fs-4"> : </p>
                                </td>
                                <td>
                                    <p class="fs-4" id="detail_pengarang"></p>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <p class="fs-4">Jumlah Halaman</p>
                                </td>
                                <td>
                                    <p class="fs-4"> : </p>
                                </td>
                                <td>
                                    <p class="fs-4" id="detail_halaman"></p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="bottom" style=" margin-left:8vh; margin-top:-80px; margin-bottom:6vh">
                    <button type="button" onclick="closeDisplayDetail()" class="btn fw-bolder text-light" style="background-color:#264A8A"><i class="bi bi-arrow-left fs-4"></i> Kembali</button>
                    <button type="button" onclick="onEdit(this)" class="btn btn-warning ms-3"><i class="bi bi-pencil-square"></i> Edit</button>
                    <button onclick="onDelete(this)" class="btn btn-danger ms-3"><i class="bi bi-trash"></i> Hapus</button>
            </div>
            <hr style="width: 100%; margin-top:3vh;text-align: center;  border-top: 1px solid ">
            <div class="header-eksemplar" style="padding:4vh; padding-bottom:0vh">
                <h2 class="mb-5" style="text-align: center; font-weight:bold;">Detail Eksemplar</h2>
                <a id="pdfBarcode" onclick="checkBarcode()">
                    <button style="float:right" class="btn btn-warning"><img src="{{ asset('images/barcode_scanner.png')}}" alt=""> Cetak Barcode</button>
                </a>
                <!-- <button type="button" id="btnSelectedRows" style="float:right" class="btn btn-warning"><img src="{{ asset('images/barcode_scanner.png')}}" alt=""> Cetak Barcode</button> -->
                <button type="button" style="float:right; background-color:#264A8A" class="btn me-3 text-light" onclick="showModal()">+ Create New</a></button>
            </div>
            <div class="card-body">
                <table class="table mx-auto text-center" onclick="check()" style="width:95%" id="tableEksemplar">
                    <thead>
                        <tr>
                            <th class="fw-bolder" style="width: 4%"> No </th>
                            <th class="fw-bolder">Kode Eksemplar</th>
                            <th class="fw-bolder">Status</th>
                            <th class="fw-bolder">kondisi</th>
                            <th class="fw-bolder">Tanggal Pinjam</th>
                            <th class="fw-bolder">Tanggal Kembali</th>
                            <th class="fw-bolder">Barcode</th>
                            <th class="fw-bolder">
                                <div class="d-flex align-items-center justify-content-center">
                                    <p class="m-0">Pilih Cetak Barcode&nbsp;&nbsp;</p>
                                    <input type="checkbox" id="allCheckbox" name="pilih[]" value="checked_all">
                                </div>
                            </th>
                            <th class="fw-bolder" style="width: 15%">Action</th>
                        </tr>
                    </thead>
                    <tbody id="listTable"></tbody>
                </table>
            </div>
            {{-- <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Eksemplar</th>
                            <th>Status</th>
                            <th>kondisi</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Action</th>
                            <th>Pilih Barcode</th>
                        </tr>
                    </thead>
                    <tbody id="isiTable">
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>-</td>
                            <td>-</td>
                            <td>
                                <button type="button" class="btn btn-warning" onclick="editEksemplar()">Edit<i class="bi bi-pencil-square"></i></button>
                                <a onclick="hapusEksemplar()" methode="post" class="btn btn-danger">Hapus <i class="bi bi-trash"></i></a>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" name="detail_check[]" type="checkbox" value="" id="flexCheckDefault">

                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div> --}}
            </form>
        </div>
    </div>
</div>





<div class="modal fade" id="form_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Data Eksemplar</h5>
          <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"> -->
            <span class='d-none' aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="javascript:saveEksemplar()" id="formEksemplar" name="formEksemplar" method="POST">
                @csrf
                  <input type="text" class="form-control" id="buku_id" name="buku_id" hidden>
                <div class="form-group">
                    <label for="no_panggil" class="col-form-label">Kode Eksemplar Buku</label>
                    <td><input class="form-control" type="hidden" name="eksemplar_id" id="eksemplar_id"></td>
                    <input type="text" class="form-control" id="no_panggil" name="no_panggil">
                  </div>
                <div class="form-group">
                  <label for="status" class="col-form-label">Status</label>
                  <input class="form-control" id="status" name="status">
                </div>
                <div class="form-group">
                    <label for="kondisi" class="col-form-label">Kondisi</label>
                    <input class="form-control" id="kondisi" name="kondisi">
                  </div>
              
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="hideModal()">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
      </div>
    </div>
  </div> 

  