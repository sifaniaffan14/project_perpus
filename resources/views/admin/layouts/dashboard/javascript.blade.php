<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script> 
<script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap5.min.js"></script>

<script>
var urlPath ={
    selectData: "{{ route('admin-dashboard.selectData') }}",
    selectAbsensi: "{{ route('admin-dashboard.selectAbsensi') }}",
    selectPengajuanPerpanjangan: "{{ route('admin-dashboard.selectPengajuanPerpanjangan') }}",
        // delete: "{{ route('kategoriBuku.delete') }}",
    }

    getData()
    tableAbsensi()
    tablePengajuanPerpanjangan()


function getData(){
        $.ajax({
            url: urlPath.selectData,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
        // Mengakses variabel-variabel dari respons JSON
                var getBuku = response.getBuku;
                var getPeminjaman = response.getPeminjaman;
                var getAbsen = response.getAbsen;
                var getAbsenToday = response.getAbsenToday;
                var getAnggota = response.getAnggota;
                var getPengajuanPerpanjangan = response.getPengajuanPerpanjangan;
        // Menyisipkan nilai variabel ke dalam elemen HTML
                $('#getBuku').text(getBuku);
                $('#getPeminjaman').text(getPeminjaman);
                $('#getAbsen').text(getAbsen);
                $('#getAbsenToday').text(getAbsenToday);
                $('#getAnggota').text(getAnggota);
                $('#getPengajuanPerpanjangan').text(getPengajuanPerpanjangan);
    },
        })
}

function tableAbsensi(){
    $.ajax({
            url: urlPath.selectAbsensi,
            method: "GET",
            success: function(response) {
                var tableBody = $("#listAbsensi");
                if (response.status) {
                    if (response.total > 0) {
                        $.each(response.data, function(index, item) {
                            var row = $("<tr>").appendTo(tableBody);
                            // Kolom Identitas
                            var identityCell = $("<td>").appendTo(row);
                            var identityDiv = $("<div>").addClass("d-flex align-items-center").appendTo(identityCell);
                            if (item.picture == null || item.picture == ''){
                                urlPhoto = window.location.origin + '/storage/user/account_box.png'
                            } else {
                                urlPhoto = window.location.origin + '/storage/user/' + item.picture;
                            }
                            $("<div>").addClass("symbol symbol-50px me-3").html("<img src='"+ urlPhoto +"' class='' alt=''>").appendTo(identityDiv);
                            var identityContent = $("<div>").addClass("d-flex justify-content-start flex-column").appendTo(identityDiv);
                            $("<a>").attr("href", item.picture).addClass("text-gray-800 fw-bold text-hover-primary mb-1 fs-6").text(item.nama_anggota).appendTo(identityContent);
                            $("<span>").addClass("text-gray-400 fw-semibold d-block fs-7").text(item.no_induk).appendTo(identityContent);
                            // Kolom Jenis Anggota
                            $("<td>").html("<span class='text-gray-600 fw-bold fs-6'>" + item.jenis_anggota + "</span>").appendTo(row);
                            // Kolom Jam
                            $("<td>").html("<span class='text-gray-600 fw-bold fs-6'>" + item.waktu.substring(10,16) + "</span>").appendTo(row);
                        });
                        $('#tableAbsensi').DataTable({
                            searching: true,
                            lengthChange: false,
                            pageLength: 5, // Menampilkan 5 data per halaman
                        });
                    } else {
                        var emptyRow = $("<tr>").appendTo(tableBody);
                        var emptyCell = $("<td>").attr("colspan", 3).addClass("text-center").text("No data available").appendTo(emptyRow);
                    }
                } else {
                    console.log(response.message);
                }
            }
        });   
    }

    function tablePengajuanPerpanjangan(){
    $.ajax({
            url: urlPath.selectPengajuanPerpanjangan,
            method: "GET",
            success: function(response) {
                var tableBody = $("#listPengajuanPerpanjangan");
                if (response.status) {
                if (response.total > 0) {
                    $.each(response.data, function(index, item) {
                        var status = '';
                        if (item.status_peminjaman == 5){
                            status = `<span class="badge bg-danger">Tidak diperpanjang</span>`; 
                        }
                        if (item.status_peminjaman == 4){
                            status = `<span class="badge bg-success">Diperpanjang</span>`; 
                        }
                        if (item.status_peminjaman == 3){
                            status = `<span class="badge bg-warning">Belum direspon</span>`; 
                        }
                        var row = $("<tr>").appendTo(tableBody);

                        // Kolom Authors
                        var authorsCell = $("<td>").appendTo(row);
                        var authorsDiv = $("<div>").addClass("d-flex align-items-center").appendTo(authorsCell);
                        var urlPhoto = '';
                        if (item.picture == null || item.picture == ''){
                            urlPhoto = window.location.origin + '/storage/user/account_box.png'
                        } else {
                            urlPhoto = window.location.origin + '/storage/user/' + item.picture;
                        } 
                        $("<div>").addClass("symbol symbol-45px me-5").html("<img src='" + urlPhoto + "' alt=''>").appendTo(authorsDiv);
                        var authorsContent = $("<div>").addClass("d-flex justify-content-start flex-column").appendTo(authorsDiv);
                        $("<a>").attr("href", "item.picture").addClass("text-dark fw-bold text-hover-primary fs-6").text(item.nama_anggota).appendTo(authorsContent);
                        $("<span>").addClass("text-muted fw-semibold text-muted d-block fs-7").text(item.no_induk).appendTo(authorsContent);

                        // Kolom Jumlah Buku
                        $("<td>").html("<span class='text-dark fw-semibold d-block fs-7'>" + item.belum_verif + "</span>").appendTo(row);

                        // Kolom Tanggal Pinjam
                        $("<td>").html("<span class='text-dark fw-semibold d-block fs-7'>" + item.tgl_pinjam + "</span>").appendTo(row);

                        // Kolom Tanggal Kembali
                        $("<td>").html("<span class='text-dark fw-semibold d-block fs-7'>" + item.tgl_kembali + "</span>").appendTo(row);

                        // Kolom Status
                        $("<td>").html(status).appendTo(row);
                    });
                    $('#tablePengajuanPerpanjangan').DataTable({
                            lengthChange: false,
                            pageLength: 5, // Menampilkan 5 data per halaman
                        });
                } else {
                    var emptyRow = $("<tr>").appendTo(tableBody);
                    var emptyCell = $("<td>").attr("colspan", 5).addClass("text-center").text("No data available").appendTo(emptyRow);
                    $("#paginationPerpanjangan").empty();
                }
            } else {
                console.log(response.message);
            }
            }
        });   
    }
</script>