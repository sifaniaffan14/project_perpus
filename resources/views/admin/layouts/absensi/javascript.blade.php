<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    var urlPath ={
        insert: "{{ route('absensi.insert') }}",
    }

    let getCurrentYear = new Date().getFullYear()
    document.getElementById('currenYear').innerHTML = getCurrentYear

    document.getElementById("back").addEventListener("click", function() {
        $(".detail-card").addClass("d-none");
        $(".main-card").removeClass("d-none");
        $('#no_induk').val('');
    })

    function myFunction() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }

    $(document).ready(function() {
        $('#no_induk').keypress(function(event) {
            if (event.keyCode === 13) { // keycode untuk tombol enter adalah 13
                event.preventDefault(); // menghindari submit form
                onSave(event);
            }
        });
    });

    function onSave(event){
        $.ajax({
            url: urlPath.insert,
            type: 'POST',
            data:  {
                no_induk: $("#no_induk").val()
            },
            success: function(response){
                if(response.status == true){
                    if (response.data['message']){
                        swal("Warning", "Anggota tidak ditemukan!", "warning");
                    } else {
                        $(".detail-card").removeClass("d-none");
                        $(".main-card").addClass("d-none");

                        $.each(response.data[0], function( k, v ){
                            $("#"+k).html(": "+v)
                            if (k == 'no_induk'){
                                $("#no_induk2").html(": "+v)
                            }
                            if (k == 'picture'){
                                if (v == '' || v == null){
                                    document.getElementById("img").setAttribute("src", "images/User(2).png")
                                } else {
                                    var baseUrl = window.location.origin + '/storage/user/';
                                    var path = baseUrl+v
                                    document.getElementById("img").setAttribute("src", path)
                                }
                            }
                        })
                    }
                } else{
                    swal("Warning", response.message, "warning");
                }
            }
        })
    }
</script>