<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {!! ReCaptcha::htmlScriptTagJsApi() !!}
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/login.css">
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <title>Login - Anggota Perpustakaan</title>
    <!-- Wajib untuk jquery -->
    <script src="assets/js/jquery.js"></script>
    <!-- Wajib untuk icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
</head>

<body>
    <h1 class="judul">LIBRARY</h1>
    <h3 class="judul fw-semibold">SMP Al Falah Ketintang Surabaya</h3>
    <div class="py-4 card d-flex justify-content-center align-items-center my-4 shadow-lg card__form">
        <h2>LOGIN</h2>
        <h5>Anggota</h5>
        <form action="{{ route('login') }}" method="POST" autocomplete="off" id="formLogin" class="w-75">
            @csrf
            <div class="w-100 p-0 position-relative">
                <span class="material-symbols-outlined position-absolute icon__">
                    person
                </span>
                <input id="username" type="text" class="form-control form-control-lg bg-light w-100 username__login d-block my-3 @error('email') is-invalid @enderror" name="username" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Username">
            </div>
            <div class="w-100 position-relative">
                <span class="material-symbols-outlined position-absolute icon__">
                    key
                </span>
                <input id="password" type="password" class="form-control form-control-lg bg-light w-100 password__login my-3 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                <button type="button" class="btn p-0 position-absolute see__pass">
                    <span class="material-symbols-outlined" onclick="showPassword()">
                        visibility
                    </span>
                </button>
            </div>
            <div class="m-0 mb-3 w-100 position-relative">
                {!! htmlFormSnippet(['sitekey' => '6Leh2k0nAAAAAG9BFHV4loUcS4JATlDOfGNTwhGE', 'action' => 'perpus.harishidayatulloh.my.id']) !!}
            </div>
            <div class="w-100 position-relative text-center">
                <button class="btn btn-warning text-white my-3 border-0 rounded-pill w-25 submit mx-auto" type="submit" value="Login">
                    Login
                </button>
            </div>
        </form>
        <!-- <a href="./absensi.html">Login sebagai anggota?</a> -->
    </div>
    <footer>
        Copyright <span id="currenYear"></span> 2023 © SMP Al Falah Ketintang Surabaya
    </footer>
    @error('login')
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
            $(document).ready(function() {
                swal("Warning", "{{ $message }}", "warning");
            });
        </script>
    @enderror
</body>
<script type="text/javascript">
    const showPassword = () => {
        if ($("#password").attr("type") == "password") {
            $("#password").attr("type", "text");
            $(".far.fa-eye").removeClass("fa-eye").addClass("fa-eye-slash");
        } else {
            $(".far.fa-eye-slash").removeClass("fa-eye-slash").addClass("fa-eye");
            $("#password").attr("type", "password");
        }
    };

    // function onLogin(event){
    //     event.preventDefault()
    //     const formElement = $('#formSearch')[0];
    //     const form = new FormData(formElement);

    //     $.ajax({
    //             url: '',
    //             data: form,
    //             contentType: false,
    //             processData: false,
    //             type: 'POST',
    //             success: function(response) {
    //                 if (response.status == true) {
    //                     resultArray = response.data;
    //                     data = response.data;
    //                     $("#search2").val('')
    //                     $(".page-landing").addClass("d-none");
    //                     $(".page-search").removeClass("d-none");

    //                     onSearchResults(1)
    //                 } else {
    //                     swal("Warning", "Data Buku tidak ditemukan!", "warning");
    //                 }
    //             }
    //         })
    // }
</script>

</html>
<script src='https://www.google.com/recaptcha/api.js'></script>