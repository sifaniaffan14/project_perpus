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
                console.log('getInformasi', response)
                if (response.status == true) {
                    $('#informasi').html(response.data[0]['isi_informasi'])
                    $('#timeInformasi').append(time(response.data[0]['updated_at']))
                    $('#informasi2').html(response.data[1]['isi_informasi'])
                    $('#timeInformasi2').append(time(response.data[1]['updated_at']))
                }
            }
        })
    }

    function time(date){
        // Tanggal dan waktu awal
        const startDate = new Date(date);

        // Tanggal dan waktu saat ini
        const currentDate = new Date();

        // Menghitung selisih waktu dalam milidetik
        const timeDiff = currentDate.getTime() - startDate.getTime();

        // Mengubah selisih waktu dalam milidetik menjadi jam
        const hoursDiff = Math.floor(timeDiff / (1000 * 60 * 60));

        // Mengubah selisih waktu dalam jam menjadi format yang diinginkan (days hours ago)
        const daysDiff = Math.floor(hoursDiff / 24);
        const remainingHours = hoursDiff % 24;

        const result = `${daysDiff} days ${remainingHours} hours ago`;

        return result;
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
										<img src="`+url+`" height="230px" width="175px" class="d-block" alt="..." onclick="onDetail('`+v.id+`')" style="cursor:pointer">
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
										<img src="`+url+`" height="230px" width="175px" class="d-block" alt="..." onclick="onDetail('`+v.id+`')" style="cursor:pointer">
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