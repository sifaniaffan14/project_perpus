@include('component.js')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
<script src="assets/OwlCarousel2-2.3.4/dist/owl.carousel.min.js "></script>
<script>
    var urlPath = {
        search: "{{ route('cariBuku.search') }}",
        selectDetail: "{{ route('cariBuku.selectDetail') }}",
        selectEksemplar: "{{ route('cariBuku.selectEksemplar') }}",
    }
    var resultArray = '';
    var data = '';
    var totalPages = '';
    var next = 2;
    var previous = 1;

    $(document).ready(function() {
        $('#search').keypress(function(event) {
            if (event.keyCode === 13) { // keycode untuk tombol enter adalah 13
                event.preventDefault(); // menghindari submit form
                onSearch(event);
            }
        });
    });

    function onSearch(event) {
        event.preventDefault()

        if ($('#search').val() == '') {} else {
            $.ajax({
                url: urlPath.search,
                data: {
                    val: $('#search').val()
                },
                type: 'GET',
                success: function(response) {
                    if (response.status == true) {
                        resultArray = response.data;
                        data = response.data;
                        $("#search").val('')

                        onSearchResults(1)
                    } else {
                        swal("Warning", "Data Buku tidak ditemukan!", "warning");
                    }
                }
            })
        }
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
                <div class="col-4 mt-5">
                    <div class="row" onclick="onDetail('` + v.id + `')" style="cursor:pointer;">  
                        <div class="col text-end">
                            <img src="` + baseUrl + v.image + `" height="150px" width="113px" alt="">
                        </div>
                        <div class="col">
                            <h4><b>${v.judul}</b></h4>
                            <h5><b>${v.penerbit}</b></h5>
                            <br>
                            <span class="svg-icon svg-icon-2">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="2" y="2" width="9" height="9" rx="2" fill="currentColor"></rect>
                                    <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="currentColor"></rect>
                                    <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="currentColor"></rect>
                                    <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="currentColor"></rect>
                                </svg>
                            </span>
                            <span><b>${v.nama_kategori}</b></span>
                        </div>
                    </div>
                </div>
            `)    

            if (page == 1) {
                showPagination(totalPages, 0)
            } else {
                showPagination(totalPages, page)
            }
        });       
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

                    $('#page-main').addClass('d-none')
                    $('#page-detail').removeClass('d-none')

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
                                    <td class="p-2 fs-5 border">${num}</td>
                                    <td class="p-2 fs-5 border">${v.no_panggil}</td>
                                    <td class="p-2 fs-5 border">${v.status}</td>
                                    <td class="p-2 fs-5 border">${v.kondisi}</td>
                                    <td class="p-2 fs-5 border">${tgl_pinjam}</td>
                                    <td class="p-2 fs-5 border">${tgl_kembali}</td>
                                </tr>
                            `)
                            num++;
                        }
                    });
                }
            }
        })
    }

    function showPagination(totalPages, indexPage) {
        $('#pagination').html(`
            <li class="page-item">
                <p class="m-0 page-link" onclick="previousPage()" style="cursor:pointer;" tabindex="-1" aria-disabled="true"><</a>
            </li>`)
        for (var i = 1; i <= totalPages; i++) {
            $('#pagination').append(`
                <li class="page-item" aria-current="page">
                    <p class="m-0 page-link" id="pagination_` + i + `" onclick="switchPage(` + i + `)" style="cursor:pointer;">` + i + `</p>
                </li>
            `)
        }
        $('#pagination').append(`
            <li class="page-item">
                    <p class="m-0 page-link" onclick="nextPage()" style="cursor:pointer;">></p>
                </li>
            `)


        $('#pagination_1').addClass('active')

        if (indexPage != 0){
            for (var index = 1; index <= totalPages; index++) {
                if ($('#pagination_' + index).hasClass('active')) {
                    $('#pagination_' + indexPage).addClass('active');
                    $('#pagination_' + index).removeClass('active');
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

    function onReset() {
        $("#search").val('')
        data = '';
        $("#result_buku").html("")
        $('#pagination').html('')
    }

    function onDisplayMain(){
        $('#page-main').removeClass('d-none')
        $('#page-detail').addClass('d-none')
    }
</script>