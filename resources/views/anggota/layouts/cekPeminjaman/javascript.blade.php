@include('component.js')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<script>
    var tabelPeminjaman = null;
    var urlPath = {
        selectAnggota: "{{ route('cekPinjaman.selectAnggota') }}",
        selectPeminjaman: "{{ route('cekPinjaman.selectPeminjaman') }}",
        selectRiwayatPeminjaman: "{{ route('cekPinjaman.selectRiwayatPeminjaman') }}",
    }
    inittable(1)
    getAnggota()

    function getAnggota() {
        $.ajax({
            url: urlPath.selectAnggota,
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

    function inittable(tab){
        var tabel = null;
        var url = null;
        var search = null;
        if (tab == 1){
            tabel = "#tablePeminjaman"
            url = urlPath.selectPeminjaman
            search = "search"
        } else {
            tabel = "#tableRiwayat"
            url = urlPath.selectRiwayatPeminjaman
            search = "search2"
        }
        $(document).ready(function() {
            tabelPeminjaman = $(tabel).DataTable( {
                "ajax": {
                    "url": url,
                    "type": "GET",
                    "dataSrc": function (response) {
                        var data = processData(response);
                        return data;
                    }
                },
                "columns": [
                    { "data": "No" },
                    { "data": "Judul" },
                    { "data": "Tanggal Peminjaman" },
                    { "data": "Tanggal Kembali" },
                    { "data": "Status" },
                ]
            } );
            
            function processData(response) {
                var data = [];
                $.each(response.data, function( k, v ){
                    let peminjaman_status = '';
                    if (v.status_peminjaman == 1){
                        peminjaman_status = '<span class="badge badge-danger">Belum Kembali</span>';
                    } else if (v.status_peminjaman == 2){
                        peminjaman_status = '<span class="badge badge-success">Sudah Kembali</span>';
                    } else if (v.status_peminjaman == 3){
                        peminjaman_status = '<span class="badge badge-warning">Proses Perpanjangan</span>';
                    } else if (v.status_peminjaman == 4){
                        peminjaman_status = '<span class="badge badge-warning">Diperpanjang</span>';
                    } else if (v.status_peminjaman == 5){
                        peminjaman_status = '<span class="badge badge-danger">Ditolak Perpanjangan</span>';
                    }

                    var row = {
                        "No": k + 1,
                        "Judul": v.judul,
                        "Tanggal Peminjaman": moment(v.tgl_pinjam).format('DD/MM/YYYY'),
                        "Tanggal Kembali": moment(v.tgl_kembali).format('DD/MM/YYYY'),
                        "Status": peminjaman_status
                    };
                    data.push(row);
                })
                return data;
            }

            function searchFunction() {
                const input = document.getElementById(search).value;        
                tabelPeminjaman.search(input).draw();
            }

            document.getElementById(search).addEventListener("input", searchFunction);
        } );      
    }

    function tab1(){
        $('#tablePeminjaman').DataTable().destroy();
        inittable(1);
    }

    function tab2(){
        $('#tableRiwayat').DataTable().destroy();
        inittable(2);
    }
</script>