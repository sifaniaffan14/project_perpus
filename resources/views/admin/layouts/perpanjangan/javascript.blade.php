<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/jquery-barcode@2.0.3/dist/jquery-barcode.min.js"></script> --}}

<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="jquery-barcode.js"></script>
<script src="assets/js/jquery-barcode.js"></script>
<script src="assets/js/jquery-barcode.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap5.min.js"></script>

<script>
    var urlPath ={
        select: "{{ route('perpanjangan.select') }}",
        selectDetail: "{{ route('perpanjangan.selectDetail') }}",
        update: "{{ route('perpanjangan.update') }}",
    }
    var idPeminjaman = '';
    var table = 'table_belumverif';
    var dataReject = [];
    var dataSubmit = [];
    inittable('belum_verif');

    function changeTab(name){
        if (name == 'verif'){
            $('.menu2').removeClass('menu-nonaktif');
            $('.menu2').addClass('menu-aktif');
            $('.menu1').removeClass('menu-aktif');
            $('.menu1').addClass('menu-nonaktif');
            $('.verif').removeClass('d-none');
            $('.belum_verif').addClass('d-none');
            table = 'table_verif';
            $('#table_belumverif').DataTable().destroy();
            inittable(name);
        } 
        if (name == 'belum_verif'){
            $('.menu1').removeClass('menu-nonaktif');
            $('.menu1').addClass('menu-aktif');
            $('.menu2').removeClass('menu-aktif');
            $('.menu2').addClass('menu-nonaktif');
            $('.belum_verif').removeClass('d-none');
            $('.verif').addClass('d-none');
            table = 'table_belumverif';
            $('#table_verif').DataTable().destroy();
            inittable(name);
        }
    }

    function inittable(name){
        $(document).ready(function() {
            var dataTable = $('#'+table).DataTable( {
                "ajax": {
                    "url": urlPath.select,
                    "type": "GET",
                    "data": {
                        name:name
                    },
                    "dataSrc": function (response) {
                        var data = processData(response);
                        return data;
                    }
                },
                "columns": [
                    { "data": "No" },
                    { "data": "Nama Peminjam" },
                    { "data": "Jumlah Buku" },
                    { "data": "Tgl Pinjam" },
                    { "data": "Tgl Kembali" },
                    { "data": "Detail" }
                ]
            } );
            
            function processData(response) {
                var data = [];
                $.each(response.data, function( k, v ){
                    var row = {
                        "No": k + 1,
                        "Nama Peminjam": v.nama_anggota,
                        "Jumlah Buku": name == 'belum_verif' ? v.belum_verif : v.sudah_verif,
                        "Tgl Pinjam": moment(v.tgl_pinjam).format('DD/MM/YYYY'),
                        "Tgl Kembali": moment(v.tgl_kembali).format('DD/MM/YYYY'),
                        "Detail": `<span onclick="onDetail('${v.peminjaman_id}')" class="btn p-1 ps-2 material-icons" style="color: rgb(38, 74, 138);" name="btn-detail" id="btn-detail">description</span>`
                    };
                    data.push(row);
                })
                return data;
            }

            if (name == 'belum_verif'){
                function searchFunction() {
                    const input = document.getElementById("search_peminjaman1").value;        
                    dataTable.search(input).draw();
                }

                document.getElementById("search_peminjaman1").addEventListener("input", searchFunction);
            } else {
                function searchFunction() {
                    const input = document.getElementById("search_peminjaman2").value;        
                    dataTable.search(input).draw();
                }

                document.getElementById("search_peminjaman2").addEventListener("input", searchFunction);
            }
        } );
    }

    function onDetail(id){
        var name = '';
        var button = '';
        var tgl_kembali = '';
        if (table == "table_verif"){
            name = 'verif'
        } else {
            name = 'belum_verif'
        }
        $.ajax({
            url: urlPath.selectDetail,
            type: 'GET',
            data: {
                id: id,
                name: name
            },
            success: function(response){
                if (idPeminjaman == ''){
                    onDisplayDetail();

                    //mencari tgl kembali paling lama
                    var peminjaman = null;
                    var tanggalTerlama = null;

                    for (var i = 0; i < response.data.length; i++) {
                        var tanggalKembali = new Date(response.data[i].tgl_kembali);

                        if (tanggalTerlama === null || tanggalKembali > tanggalTerlama) {
                        tanggalTerlama = tanggalKembali;
                        peminjaman = response.data[i];
                        }
                    }

                    $('#no_induk').append(peminjaman['no_induk']);
                    $('#jenis_anggota').append(peminjaman['jenis_anggota'].charAt(0).toUpperCase() + peminjaman['jenis_anggota'].slice(1));
                    $('#tgl_pinjam').append(moment(peminjaman['tgl_pinjam']).format('DD/MM/YYYY'));
                    $('#tgl_kembali').append(moment(peminjaman['tgl_kembali']).format('DD/MM/YYYY'));
                }

                $('#list_perpanjangan').html('')
                if (name == 'belum_verif'){
                    $('.belum_verif').removeClass('d-none')
                    $('.verif').addClass('d-none')
                    $('.status').addClass('d-none')
                    $('.action').removeClass('d-none')
                    $('.alasan').removeClass('d-none')
                    $('.tglKembali').html('Tgl Kembali(Baru)')

                    $.each(response.data, function( k, v ){
                        if (v.status_peminjaman == '3'){
                            button = `<td class="text-center" id="${v.peminjaman_detail_id}">
                                        <button type="button" onclick="onReject('${v.peminjaman_detail_id}')" class="btn btn-danger btn-detail p-2 ps-3" name="btn-detail" id="btn-detail"><i class="bi bi bi-x-lg fs-2"></i></button>
                                        <button type="button" onclick="onSubmit('${v.peminjaman_detail_id}')" class="btn btn-success btn-detail p-2 ps-3 ms-1" name="btn-detail" id="btn-detail"><i class="bi bi-check-lg fs-2"></i></button>
                                    </td>` 
                        } else {
                            button = `<td class="text-center" id="${v.peminjaman_detail_id}">
                                        <p class="text-success">Proses Perpanjangan</p>
                                    </td>` 
                        }
                        $('#list_perpanjangan').append(`
                            <tr>
                                <td class="text-center">${k+1}</td>
                                <td class="text-center">${v.no_panggil}</td>
                                <td class="text-center">${v.judul}</td>
                                <td class="text-center">${moment(v.tgl_pinjam).format('DD/MM/YYYY')}</td>
                                <td class="text-center">${moment(v.tgl_kembali_baru).format('DD/MM/YYYY')}</td>
                                <td class="text-center"> 
                                    <p class="text-dark text-decoration-underline" onclick="onModal('${v.alasan_perpanjangan}')" style="cursor:pointer">Lihat</p>
                                </td>
                                ${button}             
                            </tr>
                        `)
                    });
                } else {
                    $('.status').removeClass('d-none')
                    $('.belum_verif').addClass('d-none')
                    $('.verif').removeClass('d-none')
                    $('.action').addClass('d-none')
                    $('.alasan').addClass('d-none')
                    $('.tglKembali').html('Tgl Kembali')

                    $.each(response.data, function( k, v ){
                        var status = '';
                        if (v.status_peminjaman == 5){
                            status = `<span class="badge bg-danger">Tidak diperpanjang</span>`; 
                        }
                        if (v.status_peminjaman == 4){
                            status = `<span class="badge bg-success">Diperpanjang</span>`; 
                        }
                        
                        $('#list_perpanjangan').append(`
                            <tr>
                                <td class="text-center">${k+1}</td>
                                <td class="text-center">${v.no_panggil}</td>
                                <td class="text-center">${v.judul}</td>
                                <td class="text-center">${moment(v.tgl_pinjam).format('DD/MM/YYYY')}</td>
                                <td class="text-center">${moment(v.tgl_kembali).format('DD/MM/YYYY')}</td>
                                <td class="text-center">${status}</td>               
                            </tr>
                        `)
                    }); 
                }
            
                idPeminjaman = response.data[0]['peminjaman_id'];
            }
        })
    }

    function onModal(alasan){
        var myModal = new bootstrap.Modal(document.getElementById('staticBackdrop'));
        myModal.show();
        if (alasan == 'null'){
            $('#alasan').val('');
        } else {
            $('#alasan').val(alasan);
        }
    }

    function onReject(id){
        swal({
            title: "Peringatan",
            text: "Apakah Anda Yakin Tidak Mengajukan Perpanjangan?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((response) => {
            if (response) {
                dataReject.push(id);
                $('#'+id).html('<p class="text-danger">Tidak Diperpanjang</p>');
            }
        }); 
    }

    function onSubmit(id){
        swal({
            title: "Peringatan",
            text: "Apakah Anda Yakin Mengajukan Perpanjangan?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((response) => {
            if (response) {
                dataSubmit.push(id);
                $('#'+id).html('<p class="text-success">Proses Perpanjangan</p>');
            }
        }); 
    }
    
    function onSave(){
        if (dataSubmit.length == 0 && dataReject.length == 0){
            swal("Warning", 'Masih belum ada buku yang dipilih!', "warning");
        } else {
            swal({
                title: "Peringatan",
                text: "Apakah Anda Yakin Untuk Menyimpan Data?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((response) => {
                if (response) {
                    $.ajax({
                        url: urlPath.update,
                        data: {
                            id: idPeminjaman,
                            dataSubmit: dataSubmit.length != 0 ? dataSubmit : '',
                            dataReject: dataReject.length != 0 ? dataReject : ''
                        },
                        type: 'POST',
                        success: function(response){
                            if(response.status == true){
                                swal("Success !", response.message, "success");
                                onDisplayMain()
                                $('#table_belumverif').DataTable().destroy();
                                inittable('belum_verif');
                            } else{
                                swal("Warning", response.message, "warning");
                            }
                        }
                    })
                }
            }); 
        }
    }

    function onClear(){
        dataReject = [];
        dataSubmit = [];
        onDisplayMain()
    }

    function onDisplayDetail(){
        $('.detail_data').removeClass('d-none');
        $('.main_data').addClass('d-none');
    }

    function onDisplayMain(){
        idPeminjaman = '';
        $('#no_induk').html('No. Induk : ');
        $('#jenis_anggota').html('Jenis Anggota : ');
        $('#tgl_pinjam').html('Tgl Pinjam : ');
        $('#tgl_kembali').html('Tgl Kembali : ');
        $('.detail_data').addClass('d-none');
        $('.main_data').removeClass('d-none');
    }

    function onRefreshTable(){
        if (table == "table_verif"){
            $('#table_verif').DataTable().destroy();
            inittable("verif")
        } else {
            $('#table_belumverif').DataTable().destroy();
            inittable("belum_verif")
        }
    }

    function back(){
        onDisplayMain()
    }
</script>