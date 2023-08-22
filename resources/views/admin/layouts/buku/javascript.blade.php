<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/jquery-barcode@2.0.3/dist/jquery-barcode.min.js"></script> --}}

<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="jquery-barcode.js"></script>
<script src="assets/js/jquery-barcode.js"></script>
<script src="assets/js/jquery-barcode.min.js"></script>
<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script>  -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>  -->
<script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script> 
<script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap5.min.js"></script> 

<script>
    var table = 'tableBuku'
    var form = 'formBuku'
    var formEksemplar = 'formEksemplar'
    var list_table = 'list_table'
    var id_buku = '';
    
    var urlPath ={
        insert: "{{ route('buku.insert') }}",
        update: "{{ route('buku.update') }}",
        select: "{{ route('buku.select') }}",
        delete: "{{ route('buku.delete') }}",
        getData: "{{ route('buku.getData') }}",
        insertEksemplar: "{{ route('detailBuku.insert') }}",
        updateEksemplar: "{{ route('detailBuku.update') }}",
        selectEksemplar: "{{ route('detailBuku.select') }}",
        deleteEksemplar: "{{ route('detailBuku.delete') }}",
    }
    $(document).ready(function () {
		$(`#${table}`).DataTable();
		$(`#${list_table}`).DataTable();
	});
    inittable()
    getData()
  
    const checkboxes = document.getElementsByName('pilih[]');
    var checkedValues = [];
    var value = '';
    function check() {
        var i2 = 0;
        checkboxes.forEach((checkbox) => {
            checkbox.addEventListener('change', () => {
            if (checkbox.checked) {
                if (checkbox.value == 'checked_all'){
                    checkedValues = [];
                    var myCheckbox = document.querySelectorAll('input[id=myCheckbox]');
                    for (var i = 0; i < myCheckbox.length; i++) {
                        myCheckbox[i].checked = true;
                        myCheckbox[i].disabled = true;
                    }
                } 
                if (!checkedValues.includes(checkbox.value)) { // tambahan: cek apakah sudah dipilih sebelumnya
                    checkedValues.push(checkbox.value);
                }
            } else {
                const index = checkedValues.indexOf(checkbox.value);
                if (index > -1) {
                    checkedValues.splice(index, 1);
                }
                if (checkedValues.length == 0){
                    if (!document.getElementById("allCheckbox").checked) {
                        var myCheckbox = document.querySelectorAll('input[id=myCheckbox]');
                        for (var i = 0; i < myCheckbox.length; i++) {
                            myCheckbox[i].checked = false;
                            myCheckbox[i].disabled = false;
                        }
                    }
                }
                document.getElementById("pdfBarcode").removeAttribute("href");
            }
            if (i2 == 0){
                if (checkedValues.length != 0){
                    value = checkedValues.join(',');
                    var baseUrl = window.location.origin;
                    if (value == 'checked_all'){
                        document.getElementById("pdfBarcode").setAttribute('href', baseUrl+"/PDFBarcode/"+id_buku);
                    } else {
                        document.getElementById("pdfBarcode").setAttribute('href', baseUrl+"/PDFBarcode/"+id_buku+"?checkedValues="+value);
                    }
                    i2 = 1;
                }
            }
            });
        });
    }

    function checkBarcode(){
        if (checkedValues.length == 0){
            swal("Warning", 'Pilih buku yang akan dicetak!', "warning");
        }
    }

    function onSave(event){
        event.preventDefault()
        swal({
            title: "Peringatan",
            text: "Apakah Anda Yakin Untuk Menyimpan Data?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((response) => {
            if (response) {
            const formElement = $('#formBuku')[0];
                const form = new FormData(formElement);
                form.append('image', $('#image')[0].files[0])

                urlSave = $('[name=id]').val()  == ''? urlPath.insert:urlPath.update;
                $.ajax({
                    url: urlSave,
                    data: form,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function(response){
                        if(response.status == true){
                            swal("Success !", response.message, "success");
                            location.reload()
                        } else{
                            swal("Warning", response.message, "warning");
                        }
                    }
                })
            }
        }); 
    }

    $('input[type="file"]').change(function() {
        $(this)
            .siblings("label")
            .html('<span class="material-icons fs-3">edit</span> Ubah File')
        $(this).siblings(".file-chosen").text(this.files[0].name)
    })

    onSubmitForm = () => {
        $(`#${form}`).submit();
    }

    function inittable(){
        $(document).ready(function() {
            var dataTable = $('#tabelBuku').DataTable( {
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
                    { "data": "Kode Buku" },
                    { "data": "Nama Buku" },
                    { "data": "Penerbit" },
                    { "data": "Kategori" },
                    { "data": "Detail" }
                ]
            } );
            
            function processData(response) {
                var data = [];
                $.each(response.data, function( k, v ){
                    var row = {
                        "No": k + 1,
                        "Kode Buku": v.kode_buku,
                        "Nama Buku": v.judul,
                        "Penerbit": v.penerbit,
                        "Kategori": v.nama_kategori,
                        "Detail": `<span onclick=onDetail('${v.id}') name="btn-detail" id="btn-detail" class="btn p-1 ps-2 material-icons" style="color: rgb(38, 74, 138);"> description</span>`
                    };
                    data.push(row);
                })
                return data;
            }

            function searchFunction() {
                const input = document.getElementById("search_buku").value;        
                dataTable.search(input).draw();
            }

            document.getElementById("search_buku").addEventListener("input", searchFunction);
        } );      
    }

    function getData(){
        $.ajax({
                url: urlPath.getData,
                type: 'GET',
                success: function(response){
                    if(response.status == true){
                        var options = "";
                        $.each(response.data, function(index, value) {
                            options += "<option value='" + value.id + "'>" + value.nama_kategori + "</option>";
                        });
                        $("#buku_kategori_id").append(options);
                    }
                }
            })
    }

    function onEdit(id){
        $.ajax({
            url: urlPath.select,
            type: 'GET',
            data: {
                id: $('#detail_id').html()
            },
            success: function(response){
                if(response.status == true){
                    loadForm();
                    DisplayEdit();
                    $.each(response.data[0], function( k, v ){
                        if (k == 'image'){
                            $('.label-input').html('<span class="material-icons fs-3">edit</span> Ubah File');
                            $('.file-chosen').html(v)
                        }
                        $('[name='+k+']').val(v)
                    });
                } 
            }
        })
    }

    function onDetail(id){
        $.ajax({
            url: urlPath.select,
            type: 'GET',
            data: {
                id: id
            },
            success: function(response){
                if(response.status == true){
                    onDisplayDetail()
                    tableEksemplar(id);
                    id_buku = id;
                    var baseUrl = window.location.origin + '/storage/buku/';
                    // document.getElementById("pdfBarcode").setAttribute('href', "http://127.0.0.1:8000/PDFBarcode/"+id);
                    $.each(response.data[0], function( k, v ){
                        $('#detail_'+k).html(v)
                        if(k=='id'){
                            $('#buku_'+k).val(v)
                        }
                        if(k=='image'){
                            document.getElementById("img").setAttribute('src', baseUrl+v);
                        }
                    });
                } 
            }
        })
    }

    function onDelete(){
        swal({
            title: "Peringatan",
            text: "Apakah Anda Yakin Untuk Menghapus Data?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((response) => {
            if (response) {
                $.ajax({
                    url: urlPath.delete,
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: $('#detail_id').html()
                    },
                    type: 'POST',
                    success: function(response){
                        if(response.status == true){
                            swal("Success !", response.message, "success");
                            onRefresh()
                        } else{
                            swal("Warning", response.message, "warning");
                        }
                    }
                })
            }
        }); 
    }

    function tableEksemplar(id){
        $.ajax({
            url: urlPath.selectEksemplar,
            type: 'GET',
            data: {
                    id: id
                },
            success: function(response){
                
                if(response.status == true){
                    $('#listTable').html('')
                    var num = 1;
                    $.each(response.data, function( k, v ){
                        var img = $('<img>').attr('src', 'data:image/png;base64,' + v.eksemplar_id);
                        var generatorPNG = "<?php new Picqer\Barcode\BarcodeGeneratorPNG(); ?>";

                        var tgl_pinjam = '-';
                        var tgl_kembali = '-';

                        var element = document.getElementById("row_"+v.eksemplar_id);
                        if (element){
                        } else {
                            if (v.status == 'tersedia' || v.status_peminjaman == null || v.status_peminjaman == ''){
                                $('#listTable').append(`
                                    <tr id="row_${v.eksemplar_id}">
                                        <td>${num}</td>
                                        <td>${v.no_panggil}</td>
                                        <td>${v.status}</td>
                                        <td>${v.kondisi}</td>
                                        <td>${tgl_pinjam}</td>
                                        <td>${tgl_kembali}</td>
                                        <td id="barcode_${v.eksemplar_id}"></td>
                                        <td><input type="checkbox" id="myCheckbox" name="pilih[]" value="${v.no_panggil}"></td>
                                        <td> 
                                            <a onclick="editEksemplar('${v.eksemplar_id}')" class="btn btn-warning" style="padding:5px 4px 8px 9px"><i class="bi bi-pencil-square fs-4"></i></a>
                                            <a onclick="hapusEksemplar('${v.eksemplar_id}')" methode="post" class="btn btn-danger ms-1" style="padding:5px 4px 8px 9px"><i class="bi bi-trash fs-4"></i></a>
                                        </td>
                                    </tr>
                                `)
                            } else {
                                if (v.tgl_pinjam){
                                    if (v.status_peminjaman != 2){
                                        tgl_pinjam = moment(v.tgl_pinjam).format('DD/MM/YYYY');
                                        tgl_kembali = moment(v.tgl_kembali).format('DD/MM/YYYY');
                                    }
                                }
                                $('#listTable').append(`
                                    <tr id="row_${v.eksemplar_id}">
                                        <td>${num}</td>
                                        <td>${v.no_panggil}</td>
                                        <td>${v.status}</td>
                                        <td>${v.kondisi}</td>
                                        <td>${tgl_pinjam}</td>
                                        <td>${tgl_kembali}</td>
                                        <td id="barcode_${v.eksemplar_id}"></td>
                                        <td><input type="checkbox" id="myCheckbox" name="pilih[]" value="${v.no_panggil}"></td>
                                        <td> 
                                            <a onclick="editEksemplar('${v.eksemplar_id}')" class="btn btn-warning" style="padding:5px 4px 8px 9px"><i class="bi bi-pencil-square fs-4"></i></a>
                                            <a onclick="hapusEksemplar('${v.eksemplar_id}')" methode="post" class="btn btn-danger ms-1" style="padding:5px 4px 8px 9px"><i class="bi bi-trash fs-4"></i></a>
                                        </td>
                                    </tr>
                                `)
                            }

                            $("#barcode_"+v.eksemplar_id).barcode(v.no_panggil, "code128");  
                            $(" .codeBarcode").html(v.eksemplar_id);
                            num++;
                        }
                    });
                } 
            }
        })
    }

    function saveEksemplar(){
        swal({
            title: "Peringatan",
            text: "Apakah Anda Yakin Untuk Menyimpan Data?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((response) => {
            if (response) {
                const formElement = $('#formEksemplar')[0];
                const form = new FormData(formElement);

                urlSave = $('[name=eksemplar_id]').val()  == ''? urlPath.insertEksemplar:urlPath.updateEksemplar;
                $.ajax({
                    url: urlSave,
                    data: form,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function(response){
                        if(response.status == true){
                            onDisplayDetail()
                            onClear()
                            hideModal()
                            tableEksemplar(id_buku)
                            swal("Success !", response.message, "success");
                        } else{
                            swal("Warning", response.message, "warning");
                        }
                    }
                })
            }
        }); 
    }

    function editEksemplar(eksemplar_id){
        $.ajax({
            url: urlPath.selectEksemplar,
            type: 'GET',
            data: {
                eksemplar_id: eksemplar_id
            },
            success: function(response){
                if(response.status == true){
                    showModal();
                    onDisplayDetail();
                    tableEksemplar(id_buku)
                    $.each(response.data[0], function( k, v ){
                        $('[name='+k+']').val(v)
                    });
                } 
            }
        })
    }

    function hapusEksemplar(eksemplar_id){
        swal({
            title: "Peringatan",
            text: "Apakah Anda Yakin Untuk Menghapus Data?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((response) => {
            if (response) {
                $.ajax({
                    url: urlPath.deleteEksemplar,
                    data: {
                        _token: "{{ csrf_token() }}",
                        eksemplar_id: eksemplar_id
                    },
                    type: 'POST',
                    success: function(response){
                        if(response.status == true){
                            swal("Success !", response.message, "success");
                            hideModal()
                            onDisplayDetail()
                            tableEksemplar(id_buku)
                        } else{
                            swal("Warning", response.message, "warning");
                        }
                    }
                })
            }
        }); 
    }

    loadForm = () => {
        $('.form_data').removeClass('d-none');
        $('.datail_data').addClass('d-none');
        $('.main_data').addClass('d-none');
        $('.actEdit1').addClass('d-none');
        $('.actCreate1').removeClass('d-none');
        $(`#${form} input`).val('');
        $('.label-input').html('<span class="material-icons fs-3"> upload </span> Pilih File ');
        $('.file-chosen').html('Tidak ada file terpilih');
	}

    closeForm = () => {
        $('.main_data').removeClass('d-none');
        $('.form_data').addClass('d-none');
	}

    DisplayEdit = () => {
		$('.actEdit').removeClass('d-none');
        $('.actCreate').addClass('d-none');
        $(`#${form} input`).attr('disabled', 'disabled');
        document.getElementById("buku_kategori_id").disabled = true;
        $('.actEdit1').addClass('d-none');
        $('.dataBuku').removeClass('d-none');
	}

    onDisplayEdit = () => {
		$('.actEdit').addClass('d-none');
        $('.actCreate').removeClass('d-none');
        $('.actEdit1').removeClass('d-none');
        $('.dataBuku').addClass('d-none');
        $('.actCreate1').addClass('d-none');
        $(`#${form} input`).removeAttr('disabled', 'disabled')
        document.getElementById("buku_kategori_id").disabled = false;

	}

    onDisplayDetail = () => {
        $('.datail_data').removeClass('d-none');
        $('.main_data').addClass('d-none');
        
	}

    closeDisplayDetail = () => {
        $('.main_data').removeClass('d-none');
        $('.datail_data').addClass('d-none');
	}

    showModal = () => {
        $('#form_modal').modal('show')
	}

    hideModal = () => {
        $('#form_modal').modal('hide')
	}

    function onHide(hide,show){
        $('#'+hide).modal('hide')
        $('#'+show).modal('show')
    }

    function onRefresh(){
        $('.main_data').removeClass('d-none');
        $('.form_data').addClass('d-none');
        $('.datail_data').addClass('d-none');
        $('#tabelBuku').DataTable().destroy();
        inittable()
        onClear()
        document.getElementById("search_buku").value = "";
    }

    function onClear(){
        $(`#${form}`)[0].reset();
        $(`#${formEksemplar}`)[0].reset();
    }
</script>