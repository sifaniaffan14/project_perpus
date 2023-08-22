<div class="page-detail d-none">
        <section id="search__bar" class="container">
            <div class="row">
                <div class="col-2 d-flex align-items-center gap-3 my-5">
                    <p onclick="onDisplaySearch()" id="btnBack" class="btn btn-warning m-0 rounded-pill text-light w-75" style="min-width: 100px">Back</p>
                </div>
            </div>
        </section>
        <section id="search__result" class="container card rounded rounded-4 overflow-auto">
            <div class="row">
                <div class="col-12 p-4">
                    <h3 class="fw-bold text__custom text-center">Details</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-5 d-flex justify-content-center h-auto pb-lg-5 pb-0" style="min-height: 300px">
                    <img id="img_detail" class="mt-4" alt="" style="width:26vh; height:30vh">
                </div>
                <div class="col-lg-7 col-12 d-flex flex-column justify-content-center p-lg-2 p-5">
                    <table class="border-0 text__custom fw-semibold align-bottom ">
                        <tr class="pb-2">
                            <td class="align-baseline w-lg-25 w-50">Kode Buku</td>
                            <td class="align-baseline text-center">:</td>
                            <td class="align-baseline" id="kode_buku"></td>
                        </tr>
                        <tr class="pb-2">
                            <td class="align-baseline w-25">Judul Buku</td>
                            <td class="align-baseline text-center">:</td>
                            <td class="align-baseline" id="judul"></td>
                        </tr>
                        <tr class="pb-2">
                            <td class="align-baseline w-25">Pengarang</td>
                            <td class="align-baseline text-center">:</td>
                            <td class="align-baseline" id="pengarang"></td>
                        </tr>
                        <tr class="pb-2">
                            <td class="align-baseline w-25">Penerbit</td>
                            <td class="align-baseline text-center">:</td>
                            <td class="align-baseline" id="penerbit"></td>
                        </tr>
                        <tr class="pb-2">
                            <td class="align-baseline w-25">No. ISBN</td>
                            <td class="align-baseline text-center">:</td>
                            <td class="align-baseline" id="no_isbn"></td>
                        </tr>
                        <tr class="pb-2">
                            <td class="align-baseline w-25">Jumlah Halaman</td>
                            <td class="align-baseline text-center">:</td>
                            <td class="align-baseline" id="halaman"></td>
                        </tr>
                        <tr class="pb-2">
                            <td class="align-baseline w-25">Kategori</td>
                            <td class="align-baseline text-center">:</td>
                            <td class="align-baseline" id="nama_kategori"></td>
                        </tr>
                    </table>
                    <div class="mt-4 table__detail">
                        <table class="table table-bordered table-md mw-100" style="width:100%">
                            <thead class="bg__custom text-light">
                                <tr>
                                    <td>No.</td>
                                    <td>Kode Eksemplar</td>
                                    <td>Status</td>
                                    <td>Kondisi</td>
                                    <td>Tanggal Pinjam</td>
                                    <td>Tanggal Kembali</td>
                                </tr>
                            </thead>
                            <tbody id="list_table">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </section>
    </div>