@extends('master.landing')

@section('content')

<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Peminjaman Buku</h6>
        </div>
        <div class="card-body p-5">
            <div class="inputan_no_induk" style="display: none">
                <h3>Masukan No Induk</h3>
                <input type="text" id="no_induk" placeholder="Masukan No Induk">
                <button type="button" class="btn btn-primary" style="padding:0.5vw 2vw"
                    onclick="cariData()">Pencarian</button>
                <div class="detail_peminjam"></div>
            </div>
            <div class="peminjaman_detail_buku">
                <div class="row">
                    <div class="col-4">
                        <div class="box" style="border:1px solid black; border-radius: 10px">
                            <div class="head-list" style="padding:4vh;">
                                <h4 style="text-align: center; font-weight:bold;">Informasi Umum</h4>
                            </div>
                            <div class="row p-3">
                                <div class="col-4">No Induk</div>
                                <div class="col-8">: <span id="info_no_induk">12345</span></div>
                                <div class="col-4">Jenis Keanggotaan</div>
                                <div class="col-6">: <span id="info_jenis_anggota">anggota</span></div>
                                <div class="col-4">Nama</div>
                                <div class="col-6">: <span id="info_nama">nama</span></div>
                                <div class="col-4">Jenis Kelamin</div>
                                <div class="col-8">: <span id="info_jenis_kelamin">Ganda Campuran</span></div>
                                <div class="col-4">Email</div>
                                <div class="col-8">: <span id="info_email">email@email.com</span></div>
                                <div class="col-4">No Telpon</div>
                                <div class="col-8">: <span id="info_no_telp">080002310</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="head-list" style="padding:4vh;">
                            <h4 style="text-align: center; font-weight:bold;">Daftar Buku Pinjaman</h4>
                        </div>
                        <div class="inputan_peminjaman_buku">
                            <form action="JavaScript:addToList()" id="form_data" name="form_data"
                                class="form-horizontal" method="POST" autocomplete="off">
                                <input type="text" id="kode_eksemplar" name="kode_eksemplar" placeholder="Masukan Kode Buku">
                                <button type="submit" class="btn btn-primary" style="padding:0.5vw 2vw"
                                    onclick="">Pencarian</button>
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" cellspacing="0" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Eksemplar</th>
                                        <th>Judul Buku</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="detail_table"></tbody>
                            </table>
                        </div>
                        <div class="save-pinjaman" style="padding: 2vh 0vh 0vh 10vh;">
                            <button class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


@endsection
<script type="text/javascript">
    function cariData() {
        var no_induk = $('#no_induk').val();
        $.ajax({
            type: "GET",
            url: "{{ url('findNoInduk') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                no_induk: no_induk,
            },
            success: function (response) {
                var data = response.data
                if (response.success == "true") {
                    $('.detail_peminjam').html(`
                        <h4 style="color:green"> Data Ditemukan </h4>
                        <p>` + data.nama + ` (` + data.jenis_anggota + ` - ` + data.no_induk + `)</p>
                    `)
                    $('.peminjaman_detail_buku').show()
                } else {
                    Swal.fire({
                        title: 'Warning',
                        text: 'Nomor Induk "' + no_induk + '" Tidak Ditemukan',
                        icon: 'warning',
                        confirmButtonText: 'oke'
                    });
                    $('.peminjaman_detail_buku').hide()
                }
            }
        });
    }

    function addToList(){
        var kode_eksemplar = $('#kode_eksemplar').val();
        $.ajax({
            type: "GET",
            url: "{{ url('findBukuEksemplar') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                kode: kode_eksemplar,
            },
            success: function (response) {
                var data = response.data
                if(response.success){
                    $('#detail_table').append(`
                        <tr>
                            <td>1</td>
                            <td>${data.KodeBuku}</td>
                            <td>${data.judul}</td>
                            <td><button type="button" class="btn btn-danger"
                                    onclick="">Batal</button></td>
                        </tr>
                    `)
                } else{
                    Swal.fire({
                        title: 'Warning',
                        text: 'Buku Tidak Tersedia Untuk Dipinjam',
                        icon: 'warning',
                        confirmButtonText: 'oke'
                    });
                }
            }
        });
    }

    // $('#add_peminjaman_buku').keydown(function (e) {
    //     e.preventDefault()
    //     alert(e)
    // })

</script>
