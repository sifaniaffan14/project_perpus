<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script>
    KTPasswordMeter.createInstances();
    var passwordMeterElement = document.querySelector("#kt_password_meter_control");
    var passwordMeter = KTPasswordMeter.getInstance(passwordMeterElement);
    var urlPath ={
        select: "{{ route('MyProfile.select') }}",
        updateProfile: "{{ route('MyProfile.updateProfile') }}",
        updateBiodata: "{{ route('MyProfile.updateBiodata') }}",
    }
    selectAnggota()
    changePassword()
    
    function changePassword(){
        if ($('#oldPass').val() != ''){
            $('.oldPass').addClass('required')
            $('.newPass').addClass('required')
            $('.renewPass').addClass('required')
            document.getElementById('oldPass').required = true;
            document.getElementById('newPass').required = true;
            document.getElementById('renewPass').required = true;
            document.getElementById('newPass').disabled = false;
            document.getElementById('renewPass').disabled = false;
        } else {
            $('.oldPass').removeClass('required')
            $('.newPass').removeClass('required')
            $('.renewPass').removeClass('required')
            $('#newPass').val('')
            $('#renewPass').val('')
            document.getElementById('oldPass').required = false;
            document.getElementById('newPass').required = false;
            document.getElementById('renewPass').required = false;
            document.getElementById('newPass').disabled = true;
            document.getElementById('renewPass').disabled = true;
        }
    }

    function selectAnggota(){
        $.ajax({
            url: urlPath.select,
            type: 'GET',
            success: function(response) {
                if (response.status == true) {
                    var baseUrl = window.location.origin + '/storage/user/';
                    if (response.data[0]['picture'] == '' || response.data[0]['picture'] == null) {
                        document.getElementById('photoPreview').setAttribute('style', "background-image: url(<?= url('/') ?>/assets/media/avatars/blank.png)");
                    } else {
                        var url = baseUrl+response.data[0]['picture'];
                        document.getElementById('photoPreview').setAttribute('style', "background-image: url("+url+")");
                    }
                    $('#profile_nama_anggota').html(response.data[0]['nama_anggota'])
                    $('#profile_no_induk').html(response.data[0]['no_induk'])
                    $('#username').html(response.data[0]['username'])
                    $.each(response.data[0], function( k, v ){
                        $('#'+k).val(v)
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

    function onSaveBiodata(event){
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
            const formElement = $('#formBiodata')[0];
                const form = new FormData(formElement);

                urlSave = urlPath.updateBiodata;
                $.ajax({
                    url: urlSave,
                    data: form,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function(response){
                        if(response.status == true){
                            swal("Success !", response.message, "success");
                            selectAnggota()
                        } else{
                            swal("Warning", response.message, "warning");
                        }
                    }
                })
            }
        }); 
    }

    function onSaveProfile(event){
        event.preventDefault()
        if ($('.oldPass').hasClass('required')){
            if ($('[name="newPass"]').val() != $('[name="renewPass"]').val()) {throw swal("Warning", "Password isn't match!", "warning")}
            if (passwordMeter.getScore() != 100) {throw swal("Warning", "New Password Not Enough Strong!", "warning")}
        }
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

                urlSave = urlPath.updateProfile;
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
                                location.reload();
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

    function onRefreshFormProfile(){
        $(`#formProfile`)[0].reset();
    }
</script>