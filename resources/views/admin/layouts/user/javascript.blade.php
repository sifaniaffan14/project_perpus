<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
{{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script> --}}
<script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script> 
<script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap5.min.js"></script> 

<script>
    var table = 'tableUser'
    var form = 'formUser'
    var list_table = 'list_table'
    var foto = false;
    var url = '';
    var tabelUser = null;
    
    var urlPath ={
        insert: "{{ route('user.insert') }}",
        update: "{{ route('user.update') }}",
        select: "{{ route('user.select') }}",
        delete: "{{ route('user.delete') }}",
        getRole: "{{ route('user.getRole') }}",
    }
    // $(document).ready(function () {
		// $(`#tableUser`).DataTable();
		// $(`#${list_table}`).DataTable();
	// });
    inittable()
    getRole()

    $(document).ready(function(){
        $('input[type="file"]').change(function(e){
            $('#changeAvatar').addClass('d-none');
            $('#cancelProfile').removeClass('d-none');
            $('#removeProfile').addClass('d-none');
        });
    });

    document.getElementById("cancelProfile").addEventListener("click", function() {
        if ($("#changeAvatar").hasClass("d-none")) {
            $('#changeAvatar').removeClass('d-none');
        }
        var urlPhoto = window.location.origin + '/storage/user/account_box.png';
        if (url == ''){
            $("#photoPreview").removeAttr("style");
            document.getElementById("photoPreview").setAttribute("style", "background-image: url("+urlPhoto+")");
        } else {
            $("#photoPreview").removeAttr("style");
            document.getElementById("photoPreview").setAttribute("style", "background-image: url("+url+")");
        }
    });
    document.getElementById("removeProfile").addEventListener("click", function() {
        if ($("#changeAvatar").hasClass("d-none")) {
            $('#changeAvatar').removeClass('d-none');
        }
        var urlPhoto = window.location.origin + '/storage/user/account_box.png';
        document.getElementById("photoPreview").setAttribute("style", "background-image: url("+urlPhoto+")");
    });

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
                const formElement = $('#formUser')[0];
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
                            var urlPhoto = window.location.origin + '/storage/user/account_box.png';
                            document.getElementById("photoPreview").setAttribute("style", "background-image: url("+urlPhoto+")");
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
        $('#tableUser tbody').on('click', 'tr', function() {
            var data = tabelUser.row(this).data();
            onEdit(data.Id)
        });
    });

    function inittable(){
        $(document).ready(function() {
            tabelUser = $('#tableUser').DataTable( {
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
                    { "data": "Username" },
                    { "data": "Role" },
                ]
            } );
            
            function processData(response) {
                var data = [];
                $.each(response.data, function( k, v ){
                    var row = {
                        "No": k + 1,
                        "Id" : v.id,
                        "Username": v.username,
                        "Role": v.nama_role,
                    };
                    data.push(row);
                })
                return data;
            }

            function searchFunction() {
                const input = document.getElementById("search_village").value;        
                tabelUser.search(input).draw();
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
                    var baseUrl = window.location.origin + '/storage/user/';
                    $.each( response.data[0], function( k, v ){
                        if (k == 'password'){
                        } else {
                            $('[name='+k+']').val(v);
                        }
                        if (k == 'picture'){
                            if (v == null){
                                foto = false;
                                urlPhoto = baseUrl + "account_box.png";
                                document.getElementById("photoPreview").setAttribute("style", "background-image: url("+ urlPhoto +")");
                                // $("#removeProfile").addClass("d-none");
                            } else {
                                foto = true;
                                url = baseUrl + v;
                                document.getElementById("photoPreview").setAttribute("style", "background-image: url("+url+")");
                                document.getElementsByName("photo").value = url;
                            }
                        }
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
                            // onRefresh()
                            reloadPage()
                        } else{
                            swal("Warning", response.message, "warning");
                        }
                    }
                })
            }
        }); 
    }

    function getRole(){
        $.ajax({
                url: urlPath.getRole,
                type: 'GET',
                success: function(response){
                    if(response.status == true){
                        var options = "";
                        $.each(response.data, function(index, value) {
                            options += "<option value='" + value.id + "'>" + value.nama_role + "</option>";
                        });
                        $("#role_id").append(options);
                    }
                }
            })
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
        $('#changeAvatar').removeClass('d-none');
        if (foto == true){
            $('#cancelProfile').removeClass('d-none');
            $('#removeProfile').removeClass('d-none');
        }
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
        $('#tableUser').DataTable().destroy();
        inittable()
    }

    function onClear(){
        $(`#${form}`)[0].reset();
        if (!$("#cancelProfile").hasClass("d-none")) {
            $('#cancelProfile').addClass('d-none');
        }
    }
</script>