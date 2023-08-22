@extends('anggota.master.app')

@section('content2')
<style>
  /* Mengatur tata letak konten dalam header kolom */
  #tablePeminjaman thead th , #tableRiwayat thead th {
    text-align: center;
  }

  /* Mengatur tata letak konten dalam sel tabel */
  #tablePeminjaman tbody td , #tableRiwayat tbody td {
    text-align: center;
  }
</style>
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
                <h2 class="text-white ms-5">Data Peminjaman</h2>
            </div>
            <div class="container pb-0 p-4">
                <ul class="nav nav-tabs nav-line-tabs ps-14 fs-6" >
                    <li class="nav-item">
                        <a class="nav-link active text-black" data-bs-toggle="tab" href="#kt_tab_pane_1" onclick="tab1()">Sedang Dipinjam</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black" data-bs-toggle="tab" href="#kt_tab_pane_2" onclick="tab2()">Riwayat Peminjaman</a>
                    </li>
                </ul>
            </div>
            <hr class="m-0">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel">
                    <div class="table-responsive row pt-1 p-3">
                        <div class="row m-5">
                            <div class="col">
                                <p class="fs-4 pt-2">Search</>
                            </div>
                            <div class="col-11 me-8">
                                <div class="position-relative w-md-400px me-md-2">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                    <span class="svg-icon svg-icon-3 svg-icon-gray-500 position-absolute top-50 translate-middle ms-6">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"></rect>
                                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor"></path>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <input type="text" class="ps-10 h-40px border-dark rounded w-100" name="search" id="search" value="" placeholder="Ketik Untuk Mencari...">
                                </div>
                            </div>    
                        </div>
                        <hr>
                        <table class="table mt-0 mb-0 m-15" id="tablePeminjaman">
                            <thead>
                                <tr class="fw-bold fs-6 text-gray-800">
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Tanggal Peminjaman</th>
                                    <th>Tanggal Kembali</th>
                                    <th>Perpanjang</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel">
                    <div class="table-responsive row pt-1 p-3">
                        <div class="row m-5">
                            <div class="col">
                                <p class="fs-4 pt-2">Search</>
                            </div>
                            <div class="col-11">
                                <div class="position-relative w-md-400px me-md-2">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                    <span class="svg-icon svg-icon-3 svg-icon-gray-500 position-absolute top-50 translate-middle ms-6">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"></rect>
                                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor"></path>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <input type="text" class="ps-10 h-40px border-dark rounded w-100" name="search2" id="search2" value="" placeholder="Ketik Untuk Mencari...">
                                </div>
                            </div>    
                        </div>
                        <hr>
                        <table class="table" id="tableRiwayat">
                            <thead>
                                <tr class="fw-bold fs-6 text-gray-800">
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Tanggal Peminjaman</th>
                                    <th>Tanggal Kembali</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- <tr>
                                    <td>1</td>
                                    <td>intertico</td>
                                    <td>14-07-2023</td>
                                    <td>14-07-2023</td>
                                    <td><span class="badge badge-success">sudah Kembali</span></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>intertico</td>
                                    <td>14-07-2023</td>
                                    <td>14-07-2023</td>
                                    <td><span class="badge badge-success">sudah Kembali</span></td>
                                </tr> -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('anggota.layouts.cekPeminjaman.javascript')
@endsection