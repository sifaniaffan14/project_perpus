{{-- @extends('anggota.master.app')

@section('content2')

<div id="page-main" class="app-container container-fluid me-10">
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
				<div class="container p-5 pt-0" style="height:15vh">
					<p class="m-0" id="informasi"></p>
				</div>
			</div>
			<div class="row mt-8 w-75">
				<div class="col-5">
					<div class="container rounded-4 p-6" style="background-color:#264A8A">
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
				<h4>Koleksi Terbaru</h4>
				<div id="carouselExampleIndicators" class="carousel slide h-100" data-bs-ride="carousel">
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
					<button class="btn text-light" style="background-color:#1BC5BD"> <i class="fa fa-users text-light"></i> Cek Peminjaman</button>
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

<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
<script>
	getAnggota()
	getInformasi()
	getCount()
	getPeminjaman()
	getKoleksi()
	function getAnggota() {
        $.ajax({
            url: "{{ route('dashboard.selectAnggota') }}",
            type: 'GET',
            success: function(response) {
                if (response.status == true) {
                    $('#nama_anggota').html(response.data[0]['nama_anggota'])
					$('#no_induk').html(response.data[0]['no_induk'])
					if (response.data[0]['picture'] == null || response.data[0]['picture'] == ''){
                        document.getElementById("photo_anggota").setAttribute("src", window.location.origin+"/storage/user/account_box.png")
                    } else {
                        document.getElementById("photo_anggota").setAttribute("src", window.location.origin+"/storage/user/"+response.data[0]['picture'])
                    }
                }
            }
        })
    }

	function getInformasi() {
        $.ajax({
            url: "{{ route('dashboard.selectInformasi') }}",
            type: 'GET',
            success: function(response) {
                if (response.status == true) {
                    $('#informasi').html(response.data[0]['isi_informasi'])
                }
            }
        })
    }

	function getCount() {
        $.ajax({
            url: "{{ route('dashboard.selectCount') }}",
            type: 'GET',
            success: function(response) {
                if (response.status == true) {
                    $('#countPeminjaman').html(response.data['countPeminjaman']);
					$('#countKunjungan').html(response.data['countKunjungan']);
                }
            }
        })
    }

	function getPeminjaman() {
        $.ajax({
            url: "{{ route('dashboard.selectPeminjaman') }}",
            type: 'GET',
            success: function(response) {
                if (response.status == true) {
                    $('#list_peminjaman').html('')
					$.each(response.data, function(k, v){
						let peminjaman_status = '';
						if (v.status_peminjaman == 1){
							peminjaman_status = '<span class="badge badge-danger">Belum Kembali</span>';
						} else if (v.status_peminjaman == 3){
							peminjaman_status = '<span class="badge badge-warning">Proses Perpanjangan</span>';
						} else if (v.status_peminjaman == 4){
							peminjaman_status = '<span class="badge badge-warning">Diperpanjang</span>';
						} else if (v.status_peminjaman == 5){
							peminjaman_status = '<span class="badge badge-danger">Ditolak Perpanjangan</span>';
						}

						$('#list_peminjaman').append(`
							<tr>
								<td class="text-center">${k + 1}</td>
								<td class="text-center">${v.judul}</td>
								<td class="text-center">${moment(v.tgl_pinjam).format('DD-MM-YYYY')}</td>
								<td class="text-center">${moment(v.tgl_kembali).format('DD-MM-YYYY')}</td>
								<td class="text-center">${peminjaman_status}</td>
							</tr>
						`)
					})
                }
            }
        })
    }

	function getKoleksi() {
        $.ajax({
            url: "{{ route('dashboard.selectKoleksi') }}",
            type: 'GET',
            success: function(response) {
                if (response.status == true) {
                    $('#koleksi_terbaru').html('')
                    var baseUrl = window.location.origin + '/storage/buku/';
                    $.each(response.data, function(k, v) {
                        if (v.image == '' || v.image == null) {
                            v.image = 'default-cover.jpeg'
                        }
                        var url = baseUrl + v.image
                        if (k == 0){
							$('#koleksi_terbaru').append(`
								<div class="carousel-item h-100 active">
									<div class="d-flex justify-content-center align-items-center h-100">
										<img src="`+url+`" height="195px" width="150px" class="d-block" alt="..." onclick="onDetail('`+v.id+`')" style="cursor:pointer">
									</div>
								</div>
							`)
							$('#carouselIndicators').append(`
								<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active bg-secondary" aria-current="true" aria-label="Slide 1"></button>
							`)
						} else{
							$('#koleksi_terbaru').append(`
								<div class="carousel-item h-100">
									<div class="d-flex justify-content-center align-items-center h-100">
										<img src="`+url+`" height="195px" width="150px" class="d-block" alt="..." onclick="onDetail('`+v.id+`')" style="cursor:pointer">
									</div>
								</div>
							`)
							$('#carouselIndicators').append(`
								<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="`+k+`" class="bg-secondary" aria-label="Slide `+(k + 1)+`"></button>
							`)
						}
                    });

                    
                }
            }
        })
    }

	function onDetail(id) {
        $.ajax({
            url: "{{ route('dashboard.selectDetail') }}",
            type: 'GET',
            data: {
                id: id
            },
            success: function(response) {
                if (response.status == true) {
                    // console.log(response.data[0])
                    var baseUrl = window.location.origin + '/storage/buku/';

                    $('#page-main').addClass('d-none')
                    $('#page-detail').removeClass('d-none')

                    if (response.data[0]['image'] == '' || response.data[0]['image'] == null) {
                        response.data[0]['image'] = 'default-cover.jpeg';
                    }
                    document.getElementById('img_detail').setAttribute('src', baseUrl + response.data[0]['image']);
                    $('#kode_buku').html(response.data[0]['kode_buku']);
                    $('#no_isbn').html(response.data[0]['no_isbn']);
                    $('#judul').html(response.data[0]['judul']);
                    $('#pengarang').html(response.data[0]['pengarang']);
                    $('#penerbit').html(response.data[0]['penerbit']);
                    $('#halaman').html(response.data[0]['halaman']);
                    $('#nama_kategori').html(response.data[0]['nama_kategori']);

                    tableEksemplar(response.data[0]['id']);
                }
            }
        })
    }

    function tableEksemplar(id) {
        $.ajax({
            url: "{{ route('dashboard.selectEksemplar') }}",
            type: 'GET',
            data: {
                id: id
            },
            success: function(response) {

                if (response.status == true) {
                    $('#list_table').html('')
                    var num = 1;
                    $.each(response.data, function(k, v) {
                        if (v.status_peminjaman != 2) {
                            var tgl_pinjam = '-';
                            var tgl_kembali = '-';
                            if (v.tgl_pinjam) {
                                tgl_pinjam = moment(v.tgl_pinjam).format('DD/MM/YYYY');
                                tgl_kembali = moment(v.tgl_kembali).format('DD/MM/YYYY');
                            }
                            $('#list_table').append(`
                                <tr>
                                    <td class="p-2 fs-5 border">${num}</td>
                                    <td class="p-2 fs-5 border">${v.no_panggil}</td>
                                    <td class="p-2 fs-5 border">${v.status}</td>
                                    <td class="p-2 fs-5 border">${v.kondisi}</td>
                                    <td class="p-2 fs-5 border">${tgl_pinjam}</td>
                                    <td class="p-2 fs-5 border">${tgl_kembali}</td>
                                </tr>
                            `)
                            num++;
                        }
                    });
                }
            }
        })
    }

	function onDisplayMain(){
        $('#page-main').removeClass('d-none')
        $('#page-detail').addClass('d-none')
    }
</script>
@endsection --}}