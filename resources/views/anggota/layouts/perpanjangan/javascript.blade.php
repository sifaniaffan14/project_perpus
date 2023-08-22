<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<script>
    var data = null;
    var urlPath = {
        insert: "{{ route('perpanjanganBuku.insert') }}",
        selectAnggota: "{{ route('perpanjanganBuku.selectAnggota') }}",
        selectPeminjaman: "{{ route('perpanjanganBuku.selectPeminjaman') }}",
    }
    getAnggota()
    getPeminjaman()

    function inputDate(currentDate){
        // Mendapatkan elemen input
        const dateInput = document.getElementById('tgl_kembali_baru');

        // Menghitung tanggal 7 hari ke depan
        const maxDate = new Date();
        maxDate.setDate(currentDate.getDate() + 7);

        // Mengubah format tanggal untuk atribut min dan max
        const formattedCurrentDate = currentDate.toISOString().split('T')[0];
        const formattedMaxDate = maxDate.toISOString().split('T')[0];

        // Mengatur atribut min dan max pada elemen input
        dateInput.setAttribute('min', formattedCurrentDate);
        dateInput.setAttribute('max', formattedMaxDate);
    }

    function getAnggota() {
        $.ajax({
            url: urlPath.selectAnggota,
            type: 'GET',
            success: function(response) {
                if(response.status == true){
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

    function getPeminjaman() {
        $.ajax({
            url: "{{ route('perpanjanganBuku.selectPeminjaman') }}",
            type: 'GET',
            success: function(response) {
                if (response.status == true) {
                    $('#list_perpanjangan').html('')
                    data = response.data
					$.each(response.data, function(k, v){
						let button = `<button type="button" class="px-3 py-2 btn btn-warning" onclick="onModal('`+k+`')"><i class="fa-sharp fa-solid fa-calendar fs-2 p-0"></i></button>`;

						$('#list_perpanjangan').append(`
							<tr>
								<td class="text-center">${k + 1}</td>
								<td class="text-center">${v.judul}</td>
								<td class="text-center">${moment(v.tgl_pinjam).format('DD-MM-YYYY')}</td>
								<td class="text-center">${moment(v.tgl_kembali).format('DD-MM-YYYY')}</td>
								<td class="text-center p-2">${button}</td>
							</tr>
						`)
					})
                }
            }
        })
    }

    function onModal(key){
        const currentDate = new Date();
        const tglKembali = new Date(data[key]['tgl_kembali']);

        if (tglKembali <= currentDate) {
            swal("Warning", 'Tidak bisa melakukan perpanjangan, karena sudah melewati tgl kembali!', "warning")
        } else {
            $('#staticBackdrop').modal('show')
            $.each(data[key], function(k, v){
                $('#'+k).html(v)
                if (k == 'tgl_pinjam'){
                    $('#'+k).html(moment(v).format('DD-MM-YYYY'))
                }
                if (k == 'peminjaman_detail_id'){
                    document.getElementById('btnSimpan').setAttribute('onclick','onSave("'+v+'")')
                }
            })
            inputDate(new Date(moment(data[key]['tgl_kembali']).format('YYYY-MM-DD')))
        }
    }

    function onSave(id){
            if ($('#tgl_kembali_baru').val() == ''){
                swal("Warning", 'Silahkan isi tgl kembali!', "warning")
            } else if($('#alasan_perpanjangan').val() == ''){
                swal("Warning", 'Silahkan isi alasan perpanjagan!', "warning")
            } else {
                swal({
                    title: "Peringatan",
                    text: "Apakah Anda Yakin Untuk Perpanjangan Buku?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((response) => {
                    $.ajax({
                    url: urlPath.insert,
                    type: 'GET',
                    data: {
                        id: id,
                        tgl_kembali_baru: $('#tgl_kembali_baru').val(),
                        alasan: $('#alasan_perpanjangan').val()
                    },
                    success: function(response) {
                        if(response.status == true){
                            $('#staticBackdrop').modal('hide')
                            swal("Success !", response.message, "success");
                        } else{
                            swal("Warning", response.message, "warning");
                        }
                    }
                }); 
            })
            }
    }

    function onReset(){
        $('#staticBackdrop').modal('hide')
        $('#tgl_kembali_baru').val('')
        $('#alasan_perpanjangan').val('')
    }
</script>