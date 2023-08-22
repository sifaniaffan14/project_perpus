@include('component.js')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
<script src="assets/OwlCarousel2-2.3.4/dist/owl.carousel.min.js "></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
<script>
    var urlPath = {
        search: "{{ route('landing.search') }}",
        selectDetail: "{{ route('landing.selectDetail') }}",
        selectCategory: "{{ route('landing.selectCategory') }}",
        selectEksemplar: "{{ route('landing.selectEksemplar') }}",
        selectKoleksi: "{{ route('landing.selectKoleksi') }}",
    }
    var resultArray = '';
    var data = '';
    var totalPages = '';
    var next = 2;
    var previous = 1;
    getCategory()
    getKoleksi()

    function getCategory() {
        $.ajax({
            url: urlPath.selectCategory,
            type: 'GET',
            success: function(response) {
                if (response.status == true) {
                    var options = "";
                    $.each(response.data, function(index, value) {
                        options += '<li onclick="showCategory()" ><a class="dropdown-item" href="#' + value.id + '">' + value.nama_kategori + '</a></li>';
                    });
                    $("#category").append(options);
                }
            }
        })
    }

    function onDetail2(id){
        onDetail(id)
        document.getElementById('btnBack').setAttribute('onclick','onDisplayLanding()')
    }

    function getKoleksi() {
        $.ajax({
            url: urlPath.selectKoleksi,
            type: 'GET',
            success: function(response) {
                if (response.status == true) {
                    $('#koleksi_terbaru').html('')
                    var baseUrl = window.location.origin + '/storage/buku/';
                    $.each(response.data, function(k, v) {
                        if (v.image == '' || v.image == null) {
                            v.image = 'default-cover.jpeg'
                        }
                        var url = baseUrl + v.image
                        $('#koleksi_terbaru').append(`
                            <div class="item">
                                <p>
                                    <img src="`+ url +`" class="book__" alt="" onclick="onDetail2('` + v.id + `')" style="cursor:pointer;width: 60% !important;height: 191px !important;border-radius: 10px;"/>
                                </p>
                            </div>
                        `)
                    });

                    // owl carousel
                    $(".owl-carousel").owlCarousel({
                        loop: true,
                        margin: 10,
                        nav: true,
                        center: true,
                        autoplay: true,
                        autoplayTimeout: 1000,
                        autoplayHoverPause: true,
                        navText: [
                            " <button class='prev position-absolute rounded-circle' type='button'><i class='bi bi-chevron-left'></i></button>",
                            " <button class='next position-absolute rounded-circle' type='button'><i class='bi bi-chevron-right'></i></button>",
                        ],
                        responsive: {
                            0: {
                                items: 1,
                            },
                            600: {
                                items: 3,
                            },
                            1000: {
                                items: 5,
                            },
                        },
                    });

                    $(".next").click(function() {
                        owl.trigger("next.owl.carousel");
                    });
                    // Go to the previous item
                    $(".prev").click(function() {
                        // With optional speed parameter
                        // Parameters has to be in square bracket '[]'
                        owl.trigger("prev.owl.carousel", [300]);
                    });

                    $(document).ready(function() {
                        $('.owl-stage-outer').addClass('w-75 mx-auto');
                    })
                }
            }
        })
    }

    function showCategory() {
        if (!$('#category').hasClass('show')) {
            $('#category').addClass('show')
        } else {
            $('#category').removeClass('show')
        }
    }

    function showCategory2() {
        if (!$('#about_us').hasClass('show')) {
            $('#about_us').addClass('show')
        } else {
            $('#about_us').removeClass('show')
        }
    }

    function onSearch(event) {
        event.preventDefault()
        const formElement = $('#formSearch')[0];
        const form = new FormData(formElement);
        if (window.location.hash != '') {
            form.append('kategori_id', window.location.hash.replace('#', ""))
        } else {
            form.append('kategori_id', 'all')
        }

        if ($('#val_search').val() == '') {} else {
            $.ajax({
                url: urlPath.search,
                data: form,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function(response) {
                    if (response.status == true) {
                        resultArray = response.data;
                        data = response.data;
                        $("#search2").val('')
                        $(".page-landing").addClass("d-none");
                        $(".page-search").removeClass("d-none");

                        onSearchResults(1)
                    } else {
                        swal("Warning", "Data Buku tidak ditemukan!", "warning");
                    }
                }
            })
        }
    }

    $(document).ready(function() {
        $('#search2').keypress(function(event) {
            if (event.keyCode === 13) { // keycode untuk tombol enter adalah 13
                event.preventDefault(); // menghindari submit form
                onSearch2();
            }
        });
    });

    function onSearch2() {
        var searchString = $('#search2').val();
        var regex = new RegExp(searchString, 'i');
        const searchResults = Object.values(resultArray).filter(obj => {
            return regex.test(obj.judul) || regex.test(obj.pengarang);
        });

        data = searchResults;
        onSearchResults(1);
    }

    function onReset() {
        $("#search2").val('')
        data = resultArray;
        onSearchResults(1)
    }

    function onSearchResults(page) {
        var itemsPerPage = 6; // Jumlah item per halaman
        totalPages = Math.ceil(data.length / itemsPerPage); // Jumlah total halaman
        var start = (page - 1) * itemsPerPage; // Indeks awal data pada halaman
        var end = start + itemsPerPage; // Indeks akhir data pada halaman
        var pageData = data.slice(start, end); // Ambil data sesuai halaman

        var baseUrl = window.location.origin + '/storage/buku/';
        $("#result_buku").html("")
        $.each(pageData, function(k, v) {
            if (v.image == '' || v.image == null) {
                v.image = 'default-cover.jpeg';
            }
            $("#result_buku").append(`
                <div class=" col-xxl-3 col-xl-3 col-lg-4 col-12">
                    <div onclick="onDetail('` + v.id + `')" style="cursor:pointer;"
                    class="w-100 text-dark search__item text-decoration-none fw-semibold">
                        <img src="` + baseUrl + v.image + `" style="width:15vh; height:20vh" alt="img">
                        <div class="w-75 mb-auto">
                            <div class="d-flex fw-bold pb-2">
                               
                                <div class="text-start">` + v.judul + `</div>
                            </div>
                            <div class="d-flex pb-1">
                                <div class="d-flex justify-content-between" style="width: 80px"><span>Penerbit</span>
                                    <span>:</span>
                                </div>
                                <div class="text-start ps-1">` + v.penerbit + `</div>
                            </div>
                            <div class="d-flex">
                                <div class="d-flex justify-content-between" style="width: 80px"><span>No ISBN</span>
                                    <span>:</span>
                                </div>
                                <div class="text-start ps-1">` + v.no_isbn + `</div>
                            </div>
                            <div class="fw-semibold pt-2"><img src="images/category 6.png" alt="" style="width:2.5vh"></img> ` + v.nama_kategori + `</div>
                        </div>
                    </div>
                </div>
            `)    
        });

        $("#result_buku").append(`
            <div class="col-12 d-flex justify-content-center">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item">
                            <p class="page-link bg-transparent text-dark fw-semibold border-0" onclick="previousPage()" style="cursor:pointer;" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </p>
                        </li>
                        <div class="d-flex" id="num_pagination">
                        </div>
                        <li class="page-item">
                            <p class="page-link bg-transparent text-dark fw-semibold border-0" onclick="nextPage()" style="cursor:pointer;" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </p>
                        </li>
                    </ul>
                </nav>
            </div>
        `)

        if (page == 1) {
            showPagination(totalPages, 0)
        } else {
            showPagination(totalPages, page)
        }
    }

    function onDetail(id) {
        $.ajax({
            url: urlPath.selectDetail,
            type: 'GET',
            data: {
                id: id
            },
            success: function(response) {
                if (response.status == true) {
                    // console.log(response.data[0])
                    var baseUrl = window.location.origin + '/storage/buku/';

                    if (!$('.page-search').hasClass('d-none')){
                        $('.page-search').addClass('d-none');
                    }
                    if (!$('.page-landing').hasClass('d-none')){
                        $('.page-landing').addClass('d-none');
                    }
                    $('.page-detail').removeClass('d-none');

                    if (response.data[0]['image'] == '' || response.data[0]['image'] == null) {
                        response.data[0]['image'] = 'default-cover.jpeg';
                    }
                    document.getElementById('img_detail').setAttribute('src', baseUrl + response.data[0]['image']);
                    $('#kode_buku').html(response.data[0]['kode_buku']);
                    $('#no_isbn').html(response.data[0]['no_isbn']);
                    $('#judul').html(response.data[0]['judul']);
                    $('#pengarang').html(response.data[0]['pengarang']);
                    $('#penerbit').html(response.data[0]['penerbit']);
                    $('#halaman').html(response.data[0]['halaman']);
                    $('#nama_kategori').html(response.data[0]['nama_kategori']);

                    tableEksemplar(response.data[0]['id']);
                }
            }
        })
    }

    function showPagination(totalPages, indexPage) {
        $('#num_pagination').html('')
        for (var i = 1; i <= totalPages; i++) {
            $('#num_pagination').append(`
                <li class="page-item"><p class="page-link m-0 text-dark bg-transparent fw-bold border-0" id="pagination_` + i + `" onclick="switchPage(` + i + `)" style="cursor:pointer;">` + i + `</p>
            `)
        }

        $('#pagination_1').removeClass('text-dark')
        $('#pagination_1').addClass('text-custom')

        if (indexPage != 0){
            for (var index = 1; index <= totalPages; index++) {
                if ($('#pagination_' + index).hasClass('text-custom')) {
                    document.getElementById('pagination_' + indexPage).classList.replace("text-dark", "text-custom");
                    document.getElementById('pagination_' + index).classList.replace("text-custom", "text-dark");
                    break;
                }
            }
        }
    }

    function switchPage(i) {
        onSearchResults(i)
    }

    function nextPage() {
        switchPage(next)
    }

    function previousPage() {
        switchPage(previous)
    }

    function tableEksemplar(id) {
        $.ajax({
            url: urlPath.selectEksemplar,
            type: 'GET',
            data: {
                id: id
            },
            success: function(response) {

                if (response.status == true) {
                    $('#list_table').html('')
                    var num = 1;
                    $.each(response.data, function(k, v) {
                        if (v.status_peminjaman != 2) {
                            var tgl_pinjam = '-';
                            var tgl_kembali = '-';
                            if (v.tgl_pinjam) {
                                tgl_pinjam = moment(v.tgl_pinjam).format('DD/MM/YYYY');
                                tgl_kembali = moment(v.tgl_kembali).format('DD/MM/YYYY');
                            }
                            $('#list_table').append(`
                                <tr>
                                    <td>${num}</td>
                                    <td>${v.no_panggil}</td>
                                    <td>${v.status}</td>
                                    <td>${v.kondisi}</td>
                                    <td>${tgl_pinjam}</td>
                                    <td>${tgl_kembali}</td>
                                </tr>
                            `)
                            num++;
                        }
                    });
                }
            }
        })
    }

    function onDisplaySearch() {
        $('.page-detail').addClass('d-none');
        $('.page-search').removeClass('d-none')
    }

    function onDisplayLanding() {
        if (!$('.page-detail').hasClass('d-none')) {
            $('.page-detail').addClass('d-none')
        }
        if (!$('.page-search').hasClass('d-none')) {
            $('.page-search').addClass('d-none')
        }
        if (!$('.page-about').hasClass('d-none')) {
            $('.page-about').addClass('d-none')
        }
        if (!$('.page-regulation').hasClass('d-none')) {
            $('.page-regulation').addClass('d-none')
        }
        if ($('.page-landing').hasClass('d-none')) {
            $('.page-landing').removeClass('d-none')
            $('#val_search').val('')
        }

        document.getElementById('btnBack').setAttribute('onclick','onDisplaySearch()')
    }

    function onDisplayAbout() {
        $('.page-about').removeClass('d-none')
        $('.page-landing').addClass('d-none')
        $('.page-regulation').addClass('d-none')
    }

    function onDisplayRegulation() {
        $('.page-about').addClass('d-none')
        $('.page-landing').addClass('d-none')
        $('.page-regulation').removeClass('d-none')
    }
</script>