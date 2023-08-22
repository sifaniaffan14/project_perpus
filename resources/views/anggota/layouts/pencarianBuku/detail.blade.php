<div id="page-detail" class="app-container container-fluid me-10 d-none">
    <!--begin::Row-->
    <div class="container-fluid">
        <div class="ms-2 me-2 bg-white rounded mb-5 p-5">
            <div class="row p-3">
                <div class="col-1 ms-3">
                    <button class="btn text-light" style="border-radius: 40px; background-color:#244785" onclick="onDisplayMain()">
                        Back
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!--end::Row-->
    <div class="container-fluid ps-5 pe-5">
        <div class="bg-secondary rounded">
            <div class="pt-6 p-5 rounded-bottom-0 rounded-4" style="background-color: #244785;">
                <h2 class="text-white ms-5">Detail Buku</h2>
            </div>
            
            <div class="bg-white p-5">
            <div class="row mt-2">
                    <div class="col-lg-5 d-flex justify-content-center h-auto pb-lg-5 pb-0 align-items-center" style="min-height: 300px">
                        <img id="img_detail" class="mt-4" alt="" style="width:26vh; height:30vh">
                    </div>
                    <div class="col-lg-7 col-12 d-flex flex-column justify-content-center p-lg-2 p-5">
                        <table class="border-0 text__custom fw-semibold align-bottom ">
                            <tr class="pb-2">
                                <td class="align-baseline w-lg-25 w-50 fs-5">Kode Buku</td>
                                <td class="align-baseline text-center fs-5">:</td>
                                <td class="align-baseline fs-5" id="kode_buku"></td>
                            </tr>
                            <tr class="pb-2">
                                <td class="align-baseline w-25 fs-5">Judul Buku</td>
                                <td class="align-baseline text-center fs-5">:</td>
                                <td class="align-baseline fs-5" id="judul"></td>
                            </tr>
                            <tr class="pb-2">
                                <td class="align-baseline w-25 fs-5">Pengarang</td>
                                <td class="align-baseline text-center fs-5">:</td>
                                <td class="align-baseline fs-5" id="pengarang"></td>
                            </tr>
                            <tr class="pb-2">
                                <td class="align-baseline w-25 fs-5">Penerbit</td>
                                <td class="align-baseline text-center fs-5">:</td>
                                <td class="align-baseline fs-5" id="penerbit"></td>
                            </tr>
                            <tr class="pb-2">
                                <td class="align-baseline w-25 fs-5">No. ISBN</td>
                                <td class="align-baseline text-center fs-5">:</td>
                                <td class="align-baseline fs-5" id="no_isbn"></td>
                            </tr>
                            <tr class="pb-2">
                                <td class="align-baseline w-25 fs-5">Jumlah Halaman</td>
                                <td class="align-baseline text-center fs-5">:</td>
                                <td class="align-baseline fs-5" id="halaman"></td>
                            </tr>
                            <tr class="pb-2">
                                <td class="align-baseline w-25 fs-5">Kategori</td>
                                <td class="align-baseline text-center fs-5">:</td>
                                <td class="align-baseline fs-5" id="nama_kategori"></td>
                            </tr>
                        </table>
                        <div class="mt-7">
                            <table class="table table-bordered table-sm mw-100" style="width:90%">
                                <thead class="text-dark">
                                    <tr>
                                        <td class="bg-warning p-2 fs-5 border">No.</td>
                                        <td class="bg-warning p-2 fs-5 border">Kode Eksemplar</td>
                                        <td class="bg-warning p-2 fs-5 border">Status</td>
                                        <td class="bg-warning p-2 fs-5 border">Kondisi</td>
                                        <td class="bg-warning p-2 fs-5 border">Tanggal Pinjam</td>
                                        <td class="bg-warning p-2 fs-5 border">Tanggal Kembali</td>
                                    </tr>
                                </thead>
                                <tbody id="list_table">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>