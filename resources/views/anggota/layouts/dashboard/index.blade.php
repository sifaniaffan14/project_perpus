@extends('anggota.master.app')

@section('content2')
<div id="page-main" class="app-container container-fluid me-10">
	<div id="kt_app_content_container" class="app-container container-fluid me-10">
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
		<div class="row g-5 g-xl-5 p-5">
			<div class="col-md-7 col-lg-7 col-xl-7 col-xxl-7 rounded">
				<div class="container bg-white mr-5 rounded p-5">
					<h3 class="d-flex align-items-center"><span class="material-icons me-2" style="color:#264A8A"> text_snippet </span> Informasi Penting</h4>
					<hr>
					<div class="container p-5 pt-0 mb-7" style="height:7.5vh">
						<h3 class="m-0" id="informasi" style="color:#797979"></h3>
						<p class="mt-5 fs-4" style="color:#888" id="timeInformasi"><i style="color:#888" class="fa fa-calendar-days fs-3 me-5"></i></p>
					</div>
					<hr>
					<div class="container p-5 pt-0 mb-2" style="height:7.5vh">
						<h3 class="m-0" id="informasi2" style="color:#797979"></h3>
						<p class="mt-5 fs-4" style="color:#888" id="timeInformasi2"><i style="color:#888" class="fa fa-calendar-days fs-3 me-5"></i></p>
					</div>
				</div>
				<div class="row mt-8 w-75">
					<div class="col-5">
						<div class="container rounded-4 p-6" style="background-color:#5F5CF1">
							<span class="text-light svg-icon svg-icon-1">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<rect x="2" y="2" width="9" height="9" rx="2" fill="currentColor"></rect>
									<rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="currentColor"></rect>
									<rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="currentColor"></rect>
									<rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="currentColor"></rect>
								</svg>
							</span>
							<h3 class="text-white mt-5 mb-1"><b id="countPeminjaman"></b></h3>
							<p class="text-white m-0 fs-6">Jumlah Peminjaman</p>
						</div>
					</div>
					<div class="col-5">
						<div class="container bg-white rounded-4 p-6">
							<span class="svg-icon svg-icon-2">
								<span class="fa fa-users fs-2" style="color : rgb(4, 196, 4)"></span>
							</span>
							<h3 class="mt-5 mb-1"><b id="countKunjungan"></b></h3>
							<p class="m-0 fs-6" style="color:#B5B5C3">Jumlah Kunjungan</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-5 col-lg-5 col-xl-5 col-xxl-5 ps-8">
				<div class="container rounded bg-white p-5 h-100">
					<h3 class="ps-5 pt-5">Koleksi Terbaru</h3>
					<div id="carouselExampleIndicators" class="carousel slide h-100" data-bs-ride="carousel" style="margin-top:-30px">
					<div class="carousel-indicators" id="carouselIndicators">
					</div>
					<div class="carousel-inner h-100" id="koleksi_terbaru">
					</div>
					<br>
					<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
						<span class="carousel-control-prev-icon bg-secondary" aria-hidden="true"></span>
						<span class="visually-hidden">Previous</span>
					</button>
					<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
						<span class="carousel-control-next-icon bg-secondary" aria-hidden="true"></span>
						<span class="visually-hidden">Next</span>
					</button>
				</div>
				</div>
			</div>
		</div>
		<div class="container-fluid ps-5 pe-5 mt-3">
			<div class="bg-white rounded p-5">
				<div class="table-responsive p-5 row">
					<div class="col">
						<h3 class="pt-3">Data Peminjaman</h3>
					</div>
					<div class="col text-end">
						<a class="btn text-light" style="background-color:#264A8A" href="{{route('cekPinjaman.index')}}"> <i class="fa fa-users text-light"></i> Cek Peminjaman</a>
					</div>
					<table class="table mt-5">
						<thead>
							<tr class="fw-bold fs-6 text-gray-800">
								<th class="text-muted text-center">No</th>
								<th class="text-muted text-center">Judul</th>
								<th class="text-muted text-center">Tanggal Peminjaman</th>
								<th class="text-muted text-center">Tanggal Kembali</th>
								<th class="text-muted text-center">Status</th>
							</tr>
						</thead>
						<tbody id="list_peminjaman">
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

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
@endsection

@section('jsAnggota')
@include('anggota.layouts.dashboard.javascript')
@endsection
