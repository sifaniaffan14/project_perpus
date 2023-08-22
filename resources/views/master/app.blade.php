<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="assets-anggota/media/logos/custom-3.svg">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/pencarian.css">
    <link rel="stylesheet" href="assets/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css" >
    <link rel="stylesheet" href="assets/OwlCarousel2-2.3.4/dist/assets/owl.theme.default.min.css" >
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery.js"></script>
    <script src="assets/OwlCarousel2-2.3.4/dist/owl.carousel.min.js"></script>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Questrial' rel='stylesheet'>
    <title>Perpustakaan SMP Al-Falah Ketintang Surabaya</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid px-5">
            <img src="images/logo.svg" class="logo__navbar" alt="">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse pe-5" id="navbarNav">
                <ul class="navbar-nav ms-auto gap-3 fw-semibold ">
                    <li class="nav-item">
                        <a class="nav-link menu_nav m-0" role="button" onclick="onDisplayLanding()">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu_nav" role="button" onclick="onDisplayAbout()" aria-expanded="false">
                            About Us
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu_nav" role="button" onclick="onDisplayRegulation()">Regulation</a>
                    </li>
                    @if (Auth::check())
                        @if (Auth::user()->isAdmin(Auth::id()))
                        <li class="nav-item">
                            <a href="{{ route('admin-dashboard') }}"
                            class="nav-link btn btn-sm rounded-pill border-0 btn__login" style="width: 110px;">Dashboard</a>
                        </li>
                        @else
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}"
                            class="nav-link btn btn-sm rounded-pill border-0 btn__login" style="width: 110px;">Dashboard</a>
                        </li>
                        @endif
                    @else
                    <li class="nav-item">
                        <a href="{{ route('login') }}"
                        class="nav-link btn btn-sm rounded-pill border-0 btn__login" style="width: 100px;">Login</a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <div class="page-landing">
        <section id="hero1" class="hero__1 container-fluid d-flex flex-column align-items-center justify-content-center">
            <div class="row d-flex gap-4">
                <div class="col-12 text-white text-center">
                    <h1 class="fw-bold">Library</h1>
                    <h5>SMP Al Falah Ketintang Surabaya</h5>
                </div>
                <div class="col-12">
                    <form onsubmit="onSearch(event)" method="POST" autocomplete="off" id="formSearch">
                        @csrf
                        <div class="d-flex justify-content-center" style="height:7.8vh">
                            <div class="dropdown category__">
                                <button class="btn btn-light rounded-pill dropdown-toggle h-100 fw-semibold" onclick="showCategory()" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Category
                                </button>
                                <ul class="dropdown-menu" id="category" aria-labelledby="dropdownCategory">
                                </ul>
                            </div>
                            <input type="text" class="form-control form-control-lg rounded-pill search__input" name="val_search" id="val_search" style="padding-left: 8vh;"
                            placeholder="Ketik satu atau lebih kata kunci berupa Judul atau Pengarang" />
                            <button class="btn btn-lg btn-warning btn__search text-white rounded-pill">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <section id="gallery" class="container-fluid gallery shadow-sm">
            <div class="row">
                <div class="col-12 position-relative">
                    <h3 class="fw-bold text-center p-2 mb-4" style="color: #202F4E;">Koleksi Terbaru</h3>
                    <!-- Set up your HTML -->
                    <div class="container__carousel">
                        <div class="owl-carousel owl-theme" id="koleksi_terbaru">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <footer>
    @include('master.pencarian')
    @include('master.detailPencarian')
    @include('master.aboutUs')
    @include('master.regulasi')
    @include('master.footer')
    <!-- <footer>
        <h6 class="text-white text-center">Copyright 2023 © SMP Al Falah Ketintang Surabaya</h6>
    </footer> -->
</body>
@include('master.javascript')

</html>