@extends('anggota.master.app')

@section('content2')
<div class="app-container container-fluid me-10">
								<!--begin::Row-->
								<div class="row g-5 g-xl-10 p-5">
									<!--begin::Col-->
                                    <div class="col-md-2 col-lg-2 col-xl-2 col-xxl-2">
                                        <div class="container bg-white rounded p-4 text-center">
                                            <img src="" id="photo_anggota" height="103px" width="116px" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); border-radius: 10px;">
                                        </div>
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-10 col-lg-10 col-xl-10 col-xxl-10">
                                        <div class="container bg-white ml-5 rounded ps-17 p-9">
                                            <table>
                                                <tr class="fs-3" style="color:#464E5F">
                                                    <td class="pt-1 pb-4"><b>Nama</b></td>
                                                    <td class="pt-1 ps-6 pe-1 pb-4"> <b>:</b></td>
                                                    <td class="pt-1 pb-4"> <b id="nama_anggota"></b></td>
                                                </tr>
                                                <tr class="fs-3" style="color:#464E5F">
                                                    <td><b>No Induk</b></td>
                                                    <td class=" ps-6"> <b>:</b></td>
                                                    <td> <b id="no_induk"></b></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Row-->
                                <div class="container-fluid ps-5 pe-5">
									<div class="bg-white rounded-4">
                                        <div class="pt-6 p-5 rounded-bottom-0 rounded-4" style="background-color: #244785;">
                                            <h2 class="text-white ms-5">Perpanjangan Buku</h2>
                                        </div>
                                        <div class="table-responsive m-5 row">
                                            <table class="table" id="tablePerpanjangan">
                                                <thead>
                                                    <tr class="fw-bold fs-6 text-gray-800">
                                                        <th class="text-center">No</th>
                                                        <th class="text-center">Judul</th>
                                                        <th class="text-center">Tanggal Peminjaman</th>
                                                        <th class="text-center">Tanggal Kembali</th>
                                                        <th class="text-center">Perpanjang</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="list_perpanjangan">
                                                </tbody>
                                            </table>
                                        </div>
									</div>
								</div>
							</div>
                            <!-- Modal -->
                            <div class="modal fade" id="staticBackdrop" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content pb-0 p-5 w-75 mx-auto" style="border-radius: 25px; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">
                                        <div class="modal-header p-0">
                                            <h4 class="modal-header pb-5 py-2" style="color:#244785">Ajukan Perpanjangan</h5>
                                        </div>
                                        <div class="modal-body">
                                            <p class="fw-bolder fs-6">Judul Buku</p>
                                            <p class="ms-6" id="judul">Intertico</p>
                                            <p class="fw-bolder fs-6">Penerbit</p>
                                            <p class="ms-6" id="penerbit">Intertico</p>
                                            <p class="fw-bolder fs-6">Ketegori Buku</p>
                                            <p class="ms-6" id="nama_kategori">Intertico</p>
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <p class="fw-bolder fs-6 mb-3">Tanggal Pinjam</p>
                                                    <p class="text-center rounded-1 p-1" style="background: #D9D9D9;" id="tgl_pinjam">Intertico</p>
                                                </div>
                                                <div>
                                                    <p class="fw-bolder fs-6 mb-3">Tanggal Kembali (Baru)</p>
                                                    <input type="date" id="tgl_kembali_baru" class="ps-4 pe-2 p-1 rounded-1" style="border: 1.088px solid #000;" name="tgl_kembali_baru">
                                                </div>
                                            </div>
                                            <p class="fw-bolder fs-6">Alasan Perpanjangan</p>
                                            <textarea class="border-0" style="background-color:#EFF2F5" name="alasan_perpanjangan" id="alasan_perpanjangan" cols="38" rows="4" placeholder="Tulis alasan perpanjangan"></textarea>
                                            <div class="d-flex justify-content-end gap-2 mt-8">
                                                <button type="button" class="btn text-light fs-6" style="background-color:#DC3545" onclick="onReset()">
                                                    <i class="bi bi-arrow-clockwise text-light fs-3 p-0" style="transform: scaleX(-1); "></i> Batal
                                                </button>
                                                <button type="button" id="btnSimpan" class="btn text-light fs-6" style="background-color:#264A8A">
                                                    <i class="fa-sharp fa-regular fa-floppy-disk text-light fs-3"></i> Simpan 
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
@endsection      

@section('jsAnggota')
                            @include('anggota.layouts.perpanjangan.javascript')
                            @endsection                       