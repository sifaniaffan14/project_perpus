<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script> 
<script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap5.min.js"></script> 

<script>
    KTPasswordMeter.createInstances();
    var passwordMeterElement = document.querySelector("#kt_password_meter_control");
    var passwordMeter = KTPasswordMeter.getInstance(passwordMeterElement);
    var urlPath ={
        update: "{{ route('profile.update') }}",
        updatePassword: "{{ route('profile.updatePassword') }}",
        selectUser: "{{ route('profile.selectUser') }}",
    }
    getUser()
    
    function getUser(){
        $.ajax({
            url: urlPath.selectUser,
            type: 'GET',
            success: function(response) {
                if (response.status == true) {
                    console.log(response.data[0])
                    var baseUrl = window.location.origin + '/storage/user/';
                    if (response.data[0]['picture'] == '' || response.data[0]['picture'] == null) {
                        document.getElementById('photoPreview').setAttribute('style', "background-image: url(<?= url('/') ?>/assets/media/avatars/blank.png)");
                    } else {
                        var url = baseUrl+response.data[0]['picture'];
                        document.getElementById('photoPreview').setAttribute('style', "background-image: url("+url+")");
                    }
                    $('#previewUsername').html(response.data[0]['username'])
                    $('#previewJabatan').html(response.data[0]['nama_role'])
                    $('#profile_username').val(response.data[0]['username'])
                    $('#id').val(response.data[0]['id'])
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
            const formElement = $('#formProfile')[0];
                const form = new FormData(formElement);
                form.append('photo', $('#photo')[0].files[0])

                urlSave = urlPath.update;
                $.ajax({
                    url: urlSave,
                    data: form,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function(response){
                        if(response.status == true){
                            swal("Success !", response.message, "success");
                            location.reload();
                        } else{
                            swal("Warning", response.message, "warning");
                        }
                    }
                })
            }
        }); 
    }

    function onChangePassword(event){
        event.preventDefault()
        if ($('[name="newPass"]').val() != $('[name="renewPass"]').val()) {throw swal("Warning", "Password isn't match!", "warning")}
        if (passwordMeter.getScore() != 100) {throw swal("Warning", "New Password Not Enough Strong!", "warning")}
        swal({
            title: "Peringatan",
            text: "Apakah Anda Yakin Untuk Menyimpan Data?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((response) => {
            if (response) {
            const formElement = $('#formPassword')[0];
                const form = new FormData(formElement);

                urlSave = urlPath.updatePassword;
                $.ajax({
                    url: urlSave,
                    data: form,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function(response){
                        if(response.status == true){
                            if (response.data['success'] == false){
                                swal("Warning", "Password lama yang Anda masukkan tidak valid!", "warning");
                            } else {
                                swal("Success !", response.message, "success");
                                onRefreshFormPassword()
                            }
                        } else{
                            swal("Warning", response.message, "warning");
                        }
                    }
                })
            }
        }); 
    }

    function comparePass(){
        if($('[name="newPass"]').val() != $('[name="renewPass"]').val()){
            $('[name="renewPass"]').addClass('is-invalid')
        } else {
            $('[name="renewPass"]').removeClass('is-invalid')
        }
    }

    function onRefreshFormPassword(){
        $(`#formPassword`)[0].reset();
    }

    function removeProfile(){
        $('#profileDownload').addClass('d-none')
    }

    onSelectMenu = (type, el) => {
        $('.profileMenu').removeClass('btn-primary')
        $('.profileMenu').addClass('text-gray-900')
        $(el).removeClass('text-gray-900')
        $(el).addClass('btn-primary')
        if (type == "ubah profile") {
            $("#ubahProfile-tab").click();
            onEdit()
        } else if (type == "ubah password") {
            $("#ubahPassword-tab").click();
            onEdit()
        }
    }
</script>