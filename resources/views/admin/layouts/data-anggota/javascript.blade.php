<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script> 
<script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap5.min.js"></script>

<script>
    var urlPath ={
        select: "{{ route('dataAnggota.select') }}",
        insert: "{{ route('dataAnggota.insert') }}",
        update: "{{ route('dataAnggota.update') }}",
        delete: "{{ route('dataAnggota.delete') }}"
    }
    inittable()

    function inittable(){
        $(document).ready(function() {
            var dataTable = $('#tabelAnggota').DataTable( {
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
                    { "data": "Nama Anggota" },
                    { "data": "Jenis Anggota" },
                    { "data": "Detail" }
                ]
            } );
            
            function processData(response) {
                var data = [];
                $.each(response.data, function( k, v ){
                    var row = {
                        "No": k + 1,
                        "No Induk": v.no_induk,
                        "Nama Anggota": v.nama_anggota,
                        "Jenis Anggota": v.jenis_anggota,
                        "Detail": `<span onclick=onEdit('${v.id}') class="btn p-1 ps-2 material-icons" style="color: rgb(38, 74, 138);" name="btn-detail" id="btn-detail">description</i></span>`
                    };
                    data.push(row);
                })
                return data;
            }

            function searchFunction() {
                const input = document.getElementById("search_anggota").value;        
                dataTable.search(input).draw();
            }

            document.getElementById("search_anggota").addEventListener("input", searchFunction);
        } );      
    }

    function onEdit(id){
        $.ajax({
            url: urlPath.select,
            type: 'GET',
            data: {
                id: id
            },
            success: function(response){
                if(response.status == true){
                    loadForm();
                    DisplayEdit();
                    $.each(response.data[0], function( k, v ){
                        $('[name='+k+']').val(v)
                        if (v == 'laki-laki'){
                            $('#laki-laki').selected = true;
                        } else {
                            $('#perempuan').selected = true;
                        }
                    });
                } 
            }
        })
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
                const formElement = $('#formAnggota')[0];
                const form = new FormData(formElement);

                urlSave = $('[name=id]').val()  == ''? urlPath.insert:urlPath.update;
                $.ajax({
                    url: urlSave,
                    data: form,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function(response){
                        if(response.status == true){
                            onRefresh()
                            swal("Success !", response.message, "success");
                        } else{
                            swal("Warning", response.message, "warning");
                        }
                    }
                })
            }
        }); 
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
                        id: $('[name=id]').val()
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

    loadForm = () => {
        $('.form_data').removeClass('d-none');
        $('.main_data').addClass('d-none');
        $('.actEdit1').addClass('d-none');
        $('.actCreate1').removeClass('d-none');
        $(`#formAnggota input`).val('');
    }

    DisplayEdit = () => {
		$('.actEdit').removeClass('d-none');
        $('.actCreate').addClass('d-none');
        $(`#formAnggota input`).attr('disabled', 'disabled')
        document.getElementById("jenis_kelamin").disabled = true;
        $('.actEdit1').addClass('d-none');
        $('.dataAnggota').removeClass('d-none');
	}

    onDisplayEdit = () => {
		$('.actEdit').addClass('d-none');
        $('.actCreate').removeClass('d-none');
        $('.actEdit1').removeClass('d-none');
        $('.dataAnggota').addClass('d-none');
        $('.actCreate1').addClass('d-none');
        $(`#formAnggota input`).removeAttr('disabled', 'disabled')
        document.getElementById("jenis_kelamin").disabled = false;

	}

    function onRefresh(){
        $('.main_data').removeClass('d-none');
        $('.form_data').addClass('d-none');
        $('#tabelAnggota').DataTable().destroy();
        inittable()
        onClear()
        document.getElementById("search_anggota").value = "";
    }

    function onClear(){
        $(`#formAnggota`)[0].reset();
    }

    closeForm = () => {
        $('.main_data').removeClass('d-none');
        $('.form_data').addClass('d-none');
	}

    onSubmitForm = () => {
        $(`#formAnggota`).submit();
    }
</script>