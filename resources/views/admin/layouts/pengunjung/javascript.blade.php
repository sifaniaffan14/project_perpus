<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script> 
<script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"></script>

<script>
    var currentTime = new Date();
    var urlPath ={
        select: "{{ route('pengunjung.select') }}",
        onFilter: "{{ route('pengunjung.onFilter') }}",
    }
    inittable()
    selectTahun()

    $(document).ready(function () {
        $('#tahun').change(function() {
            var currentYear = currentTime.getFullYear();
            var valTahun = $(this).val();
            if (currentYear == valTahun){
                selectBulan(true)
            } else {
                selectBulan(false)
            }
            document.getElementById("bulan").disabled = false;
        })
        $('#bulan').change(function() {
            var currentYear = currentTime.getFullYear();
            var valTahun = $('#tahun').val();
            var currentMonth = currentTime.getMonth() + 1;
            var valBulan = $(this).val();
            if (currentYear == valTahun && currentMonth == valBulan){
                selectTanggal(true)
            } else {
                selectTanggal(false)
            }
            document.getElementById("tanggal").disabled = false;
        })
    })

    function inittable(){
        $(document).ready(function() {
            var dataTable = $('#tabelPengunjung').DataTable( {
                "ajax": {
                    "url": urlPath.select,
                    "type": "GET",
                    "dataSrc": function (response) {
                        var data = processData(response);
                        return data;
                    }
                },
                "columns": [
                    { "data": "No" },
                    { "data": "No Induk" },
                    { "data": "Nama" },
                    { "data": "Tanggal" },
                    { "data": "Jam" }
                ]
            } );
            
            function processData(response) {
                var data = [];
                $.each(response.data, function( k, v ){
                    var row = {
                        "No": k + 1,
                        "No Induk": v.no_induk,
                        "Nama": v.nama_anggota,
                        "Tanggal": v.waktu.substring(0,10),
                        "Jam": v.waktu.substring(10,16)
                    };
                    data.push(row);
                })
                return data;
            }

            function searchFunction() {
                const input = document.getElementById("search_pengunjung").value;        
                dataTable.search(input).draw();
            }

            document.getElementById("search_pengunjung").addEventListener("input", searchFunction);
        } );      
    }

    function selectTahun(){
        var currentYear = currentTime.getFullYear();
        var options = "";
        var tahun = "";
        options += '<option value="#" selected disabled hidden>Pilih tahun</option>';
        for (var i = 0; i < 5; i++) {
            tahun = currentYear - i;
            options += "<option value='" + tahun + "'>" + tahun + "</option>";
        };
        $("#tahun").html("");
        $("#tahun").append(options);
    }

    function selectBulan(status){
        var monthNames = [
            "Januari", "Februari", "Maret", "April", "Mei", "Juni",
            "Juli", "Agustus", "September", "Oktober", "November", "Desember"
        ];
        var options = "";
        options += '<option value="#" selected disabled hidden>Pilih bulan</option>';
        if (status == true){
            var currentMonthNumber = currentTime.getMonth();
            for (var i = 0; i <= currentMonthNumber; i++) {
                options += "<option value='" + (i + 1) + "'>" + monthNames[i] + "</option>";
            }
        } else {
            for (var i = 0; i < monthNames.length; i++) {
                options += "<option value='" + (i + 1) + "'>" + monthNames[i] + "</option>";
            }
        }
        $("#bulan").html("");
        $("#bulan").append(options);
    }

    function selectTanggal(status){
        var currentDate = new Date();
        var options = "";
        options += '<option value="#" selected disabled hidden>Pilih tanggal</option>';
        if (status == true){
            var currentDateNumber = currentDate.getDate();
            for (var i = 1; i <= currentDateNumber; i++) {
                options += "<option value='" + i + "'>" + i + "</option>";
            }
        } else {
            var valBulan = $('#bulan').val();
            currentDate.setDate(1);
            var CountDay = new Date(currentDate.getFullYear(),valBulan, 0).getDate();
            for (var i = 1; i <= CountDay; i++) {
                options += "<option value='" + i + "'>" + i + "</option>";
            }
        }
        $("#tanggal").html("");
        $("#tanggal").append(options);
    }

    function onFilter(){
        $('#tabelPengunjung').DataTable().destroy();
        $(document).ready(function() {
            var dataTable = $('#tabelPengunjung').DataTable( {
                "ajax": {
                    "url": urlPath.onFilter,
                    "type": "GET",
                    "data" : {
                        tahun : $("#tahun").val(),
                        bulan : $("#bulan").val(),
                        tanggal : $("#tanggal").val()
                    },
                    "dataSrc": function (response) {
                        if (response.status == true){
                            var data = processData(response);
                            return data;
                        } else {
                            return [];
                        }
                    }
                },
                "columns": [
                    { "data": "No" },
                    { "data": "No Induk" },
                    { "data": "Nama" },
                    { "data": "Tanggal" },
                    { "data": "Jam" }
                ]
            } );
            
            function processData(response) {
                var data = [];
                $.each(response.data, function( k, v ){
                    var row = {
                        "No": k + 1,
                        "No Induk": v.no_induk,
                        "Nama": v.nama_anggota,
                        "Tanggal": v.waktu,
                        "Jam": v.created_at.substring(10,16)
                    };
                    data.push(row);
                })
                return data;
            }

            function searchFunction() {
                const input = document.getElementById("search_pengunjung").value;        
                dataTable.search(input).draw();
            }

            document.getElementById("search_pengunjung").addEventListener("input", searchFunction);
        } );     
    }

    function onRefresh(){
        $("#tahun").val($("#tahun option:first").val()).trigger("change");
        $("#bulan").val($("#bulan option:first").val()).trigger("change");
        $("#tanggal").val($("#tanggal option:first").val()).trigger("change");
        document.getElementById("bulan").disabled = true;
        document.getElementById("tanggal").disabled = true;
        $('#tabelPengunjung').DataTable().destroy();
        inittable()
        document.getElementById("search_pengunjung").value = "";
    }
</script>