<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
{{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script> --}}
<script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script> 
<script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap5.min.js"></script> 

<script>
    var table = 'tableKategori'
    var form = 'formKategori'
    var list_table = 'list_table'
    var tabelKategori = null;
    
    var urlPath ={
        insert: "{{ route('kategoriBuku.insert') }}",
        update: "{{ route('kategoriBuku.update') }}",
        select: "{{ route('kategoriBuku.select') }}",
        delete: "{{ route('kategoriBuku.delete') }}",
    }
    inittable()

    function onSave(){
        swal({
            title: "Peringatan",
            text: "Apakah Anda Yakin Untuk Menyimpan Data?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((response) => {
            if (response) {
                const formElement = $('#formKategori')[0];
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

    $(document).ready(function() {
        $('#tableKategori tbody').on('click', 'tr', function() {
            var data = tabelKategori.row(this).data();
            onEdit(data.Id)
        });
    });

    function inittable(){
        $('#tableKategori').DataTable().destroy();
        $(document).ready(function() {
            tabelKategori = $('#tableKategori').DataTable( {
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
                    { "data": "Id", visible: false },
                    { "data": "Kode Kategori" },
                    { "data": "Nama Kategori" },
                ]
            } );
            
            function processData(response) {
                var data = [];
                $.each(response.data, function( k, v ){
                    var row = {
                        "No": k + 1,
                        "Id" : v.id,
                        "Kode Kategori": v.kode_kategori,
                        "Nama Kategori": v.nama_kategori,
                    };
                    data.push(row);
                })
                return data;
            }

            function searchFunction() {
                const input = document.getElementById("search_village").value;        
                tabelKategori.search(input).draw();
            }

            document.getElementById("search_village").addEventListener("input", searchFunction);
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
                    DisplayEdit();
                    $.each( response.data[0], function( k, v ){
                        $('[name='+k+']').val(v)
                    });
                } 
            }
        })
    }

    function onDelete(id){
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
                        id: $('[name="id"]').val()
                    },
                    type: 'POST',
                    success: function(response){
                        if(response.status == true){
                            swal("Success !", response.message, "success");
                            reloadPage()
                        } else{
                            swal("Warning", response.message, "warning");
                        }
                    }
                })
            }
        }); 
    }

    DisplayEdit = () => {
		$('.actEdit').removeClass('d-none');
        $('.actCreate').addClass('d-none');
        $(`#${form} input`).attr('disabled', 'disabled')
	}

    onDisplayEdit = () => {
		$('.actEdit').addClass('d-none');
        $('.actCreate').removeClass('d-none');
        $(`#${form} input`).removeAttr('disabled', 'disabled')

	}

    reloadPage = () => {
		location.reload();
	}

    function onHide(hide,show){
        $('#'+hide).modal('hide')
        $('#'+show).modal('show')
    }

    function onRefresh(){
        onClear()
        inittable()
    }

    function onClear(){
        $(`#${form}`)[0].reset();
    }
</script>