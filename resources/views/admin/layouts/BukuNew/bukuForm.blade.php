@extends('master.landing')

@section('content')
<!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->
<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Barang Baru</h6>
        </div>
        <div class="card-body">
            <form action="JavaScript:saveBuku()" id="addBuku" name="addBuku" class="form-horizontal" method="POST" autocomplete="off">
                <!-- <form action="javascript:ppp()" id="addBuku" name="addBuku" class="form-horizontal" method="POST"> -->
                <table class="tableFormUser">
                    <tr>
                        <td><input type="hidden" name="id" id="id" value="<?= isset($detailbuku['id']) ? ($detailbuku['id']) : '' ?>"></td>
                    </tr>
                    <tr>
                        <td style="width:30%">No Panggil Buku</td>
                        <td><input type="text" name="NoPanggil" id="NoPanggil" value="<?= isset($detailbuku['NoPanggil']) ? ($detailbuku['NoPanggil']) : '' ?>"></td>
                    </tr>
                    <tr>
                        <td>Judul</td>
                        <td><input type="text" name="judul" id="judul" value="<?= isset($detailbuku['judul']) ? ($detailbuku['judul']) : '' ?>"></td>
                    </tr>
                    <tr>
                        <td>Penerbit</td>
                        <td><input type="text" name="penerbit" id="penerbit" value="<?= isset($detailbuku['penerbit']) ? ($detailbuku['penerbit']) : '' ?>"></td>
                    </tr>
                    <tr>
                        <td>Pengarang</td>
                        <td><input type="text" name="pengarang" id="pengarang" value="<?= isset($detailbuku['pengarang']) ? ($detailbuku['pengarang']) : '' ?>"></td>
                    </tr>
                    <tr>
                        <td>halaman</td>
                        <td><input type="text" name="halaman" id="halaman" value="<?= isset($detailbuku['halaman']) ? ($detailbuku['halaman']) : '' ?>"></td>
                    </tr>
                    <tr>
                        <td>jumlah</td>
                        <td><input type="text" name="jumlah" id="jumlah" value="<?= isset($detailbuku['jumlah']) ? ($detailbuku['jumlah']) : '' ?>"></td>
                    </tr>
                    <tr>
                        <td>kategori</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <input type="hidden" id="kategori_buku_id" name="kategori_buku_id" value="<?= isset($detailbuku->kategoriBuku->id) ? ($detailbuku->kategoriBuku->id) : '' ?>">
                                    <input type="text" id="kategori_buku_nama" name="kategori_buku_nama" readonly value="<?= isset($detailbuku->kategoriBuku->nama) ? ($detailbuku->kategoriBuku->nama) : '' ?>">
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <div class="items" id="items">

                                    </div>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" onclick="showModal()" style="width:100% ;">+ Add</button>
                                </div>
                        </td>

                    </tr>
                </table>
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary" style="padding:0.5vw 2vw">Submit</button>
                </div>

            </form>
        </div>
    </div>

</div>
<div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen" role="document">
        <div class="modal-content" id="exampleModal1">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="hideModal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="JavaScript:saveKategori()">
                <div class="modal-body">
                    <td>Nama</td>
                    <td><input class="form-control" type="hidden" name="id" id="kategori_id" value=""></td>
                    <td><input class="form-control" type="text" name="nama" id="kategori_nama" value=""></td>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="hideModal()">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript">
    getData()

    function showModal() {
        $('#exampleModalLabel').html('Tambah Kategori')
        $('#exampleModal').modal('show')
    }

    function hideModal() {
        $('#exampleModal').modal('hide')
    }

    function saveKategori() {
        var id = $("#kategori_id").val();
        var nama = $("#kategori_nama").val();
        $("#btn-save").html('Please Wait...');
        $("#btn-save").attr("disabled", true);

        // ajax
        if ($("#kategori_id").val() == '') {
            $.ajax({
                type: "POST",
                url: "{{ url('addKategori') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    nama: nama,
                },
                success: function(res) {
                    if (res.success == true) {
                        $('#kategori_nama').val('')
                        hideModal()
                        //$('#exampleModal').modal('hide')
                        getData()
                        Swal.fire({
                            title: 'success',
                            text: 'Data Telah Ditambahkan',
                            icon: 'success',
                            confirmButtonText: 'oke'
                        });
                    }
                    $("#btn-save").html('Submit');
                    $("#btn-save").attr("disabled", false);

                }
            });
        } else {
            $.ajax({
                type: "POST",
                url: "editKategori/" + id,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: id,
                    nama: nama,
                },
                dataType: 'json',
                success: function(res) {
                    Swal.fire({
                        title: 'success',
                        text: 'Data Telah Diedit',
                        icon: 'success',
                        confirmButtonText: 'oke'
                    })
                    hideModal()
                    getData()
                }
            });
        }


    }

    function getData() {
        $.ajax({
            type: "GET",
            url: "{{ url('listKategori') }}",
            success: function(res) {
                $('.items').empty()
                $.each(res, function(key, value) {

                    $('.items').append(` <div class="isi" style="display:flex"> <a class="dropdown-item" onclick="inputField('` + value['id'] + `','` + value['nama'] + `')">
                    ` + value['nama'] + `
                    
                    <a href="JavaScript:edit('` + value['id'] + `','` + value['nama'] + `')" class="btn btn-warning" style="margin:5px" ><i  class="bi bi-pencil-square"></i></a>
                    <a href="JavaScript:hapus('` + value['id'] + `')" class="btn btn-danger" style="margin:5px"><i class="bi bi-trash"></i></a>
                   
                    </a> </div>`)
                })
            }
        });
    }

    function inputField(id, nama) {
        $("#kategori_buku_id").val(id)
        $("#kategori_buku_nama").val(nama)
    }

    function hapus(id) {
        swal.fire({
                title: "Are you sure!",
                text: ("You want to delete this Kategori !"),
                type: "warning",
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes!",
                showCancelButton: true,
            })
            .then(function(isConfirm) {
                if (isConfirm.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "deleteKategori/" + id,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            id: id,
                        },
                        dataType: 'json',
                        success: function(res) {
                            Swal.fire({
                                title: 'success',
                                text: 'Data Telah Dihapus',
                                icon: 'success',
                                confirmButtonText: 'oke'
                            })
                            getData()
                        }
                    });
                }
            });

    }

    function edit(id, nama) {
        showModal()
        $('#exampleModalLabel').html('Edit Kategori')
        $("#kategori_id").val(id);
        $("#kategori_nama").val(nama);

        // var id = $("#kategori_id").val(id);
        // var nama = $("#kategori_nama").val(nama);
    }

    function saveBuku() {
            var id = $("#id").val();
            var NoPanggil = $("#NoPanggil").val();
            var judul = $("#judul").val();
            var penerbit = $("#penerbit").val();
            var pengarang = $("#pengarang").val();
            var halaman = $("#halaman").val();
            var jumlah = $("#jumlah").val();
            var kategori_buku_id = $("#kategori_buku_id").val();
            var kategori_buku_nama = $("#kategori_buku_nama").val();
        if ($("#id").val() == '') {
           
            // ajax

            $.ajax({
                type: "POST",
                url: "{{ url('bukuAdd') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    NoPanggil: NoPanggil,
                    judul: judul,
                    penerbit: penerbit,
                    pengarang: pengarang,
                    halaman: halaman,
                    jumlah: jumlah,
                    kategori_buku_id: kategori_buku_id,
                },
                success: function(res) {

                    if (res.success == true) {
                        Swal.fire({
                            title: 'success',
                            text: 'Data Telah Ditambahkan',
                            icon: 'success',
                            confirmButtonText: 'oke'
                        });
                        window.location.href = window.location.origin + '/bukumanagement';
                    } else {
                        window.location.href = window.location.origin + '/bukuForm';
                    }
                }
            });
        }
        else{
            $.ajax({
            type: "POST",
            url: window.location.origin + "/editBuku/" + id,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: id,
                NoPanggil: NoPanggil,
                judul: judul,
                penerbit: penerbit,
                pengarang: pengarang,
                halaman: halaman,
                jumlah: jumlah,
                kategori_buku_id: kategori_buku_id,
            },
            dataType: 'json',
            success: function(res) {

                if (res.success == true) {
                    Swal.fire({
                        title: 'success',
                        text: 'Data Telah Ditambahkan',
                        icon: 'success',
                        confirmButtonText: 'oke'
                    });
                    window.location.href = window.location.origin + '/bukumanagement';
                } else {
                    Swal.fire({
                        title: 'error',
                        text: 'gagal',
                        icon: 'error',
                        confirmButtonText: 'oke'
                    });
                }
            }
        });
        }
    }

    function editBuku() {

        $.ajax({
            type: "POST",
            url: window.location.origin + "/editBuku/" + id,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: id,
                NoPanggil: NoPanggil,
                judul: judul,
                penerbit: penerbit,
                pengarang: pengarang,
                halaman: halaman,
                jumlah: jumlah,
                kategori_buku_id: kategori_buku_id,
            },
            dataType: 'json',
            success: function(res) {

                if (res.success == true) {
                    Swal.fire({
                        title: 'success',
                        text: 'Data Telah Ditambahkan',
                        icon: 'success',
                        confirmButtonText: 'oke'
                    });
                    window.location.href = window.location.origin + '/bukumanagement';
                } else {
                    window.location.href = window.location.origin + '/bukuForm';
                }
            }
        });
    }
    // function editBuku() {
    //     window.location.href = window.location.origin + '/bukuForm';
    //     $("#id").val(id);
    //     $("#NoPanggil").val(NoPanggil);
    // }

    // $('.btn-').click(function(e) {
    //             var $form =  $(this).closest("form"); //Get the form here.
    //             e.preventDefault();
    //                swal({
    //                     title: 'Are you sure?',
    //                     text: "You won't be able to revert this!",
    //                     type: 'warning',
    //                     buttons:{
    //                         confirm: {
    //                             text : 'Yes, delete it!',
    //                             className : 'btn btn-success'
    //                         },
    //                         cancel: {
    //                             visible: true,
    //                             className: 'btn btn-danger'
    //                         }
    //                     }
    //                 }).then((Delete) => {
    //                     console.log(Delete); //This will be true when delete is clicked
    //                     if (Delete) {
    //                        $form.submit(); //Submit your Form Here. 
    //                        //$('#yourFormId').submit(); //Use same Form Id to submit the Form.
    //                     }
    //                 });
    //     });

    // $(document).on("click","#btn-save",function (event) {
    //$('#btn-save').on("click", function(event) {
    //     event.preventDefault();
    //     ajaxCall();
    //     $("#exampleModal1").modal('hide');
    // });
    // $(document).ready(function() {
    //     $("#exampleModal1").click(function() {
    //         $("#exampleModal").modal('show');
    //     });
    //     $('#btn-save').submit(function(event) {
    //         event.preventDefault();
    //         ajaxCall()
    //         $("#exampleModal").modal('hide');
    //     });
    // });

    // function ajaxCall() {
    //     var nama = $("#nama").val();
    //     $.ajax({
    //         type: "POST",
    //         url: "{{ url('addKategori') }}",
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         data: {
    //             nama: nama,
    //         },
    //         dataType: 'json',
    //         success: function(res) {
    //             console.log(data)
    //             // if(res.success==true){
    //             //     $('#exampleModal').modal('hide');
    //             //     alert("success");
    //             // }
    //         }
    //         // success: resData
    //         // success: $("#btn-save").trigger("reset", function(res) {
    //         //     console.log(res)
    //         // })
    //     })
    // }

    // function resData(data) {
    //     $("#exampleModal").modal('hide');
    // }
    // $(document).ready(function($) {
    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     });
    //     $('#addNewBook').click(function() {
    //         $('#addEditBookForm').trigger("reset");
    //     });


    // $('body').on('click', '.edit', function () {
    //     var id = $(this).data('id');

    //     // ajax
    //     $.ajax({
    //         type:"POST",
    //         url: "{{ url('edit-book') }}",
    //         data: { id: id },
    //         dataType: 'json',
    //         success: function(res){
    //           $('#ajaxBookModel').html("Edit Book");
    //           $('#ajax-book-model').modal('show');
    //           $('#id').val(res.id);
    //           $('#title').val(res.title);
    //           $('#code').val(res.code);
    //           $('#author').val(res.author);
    //        }
    //     });
    // });
    // $('body').on('click', '.delete', function () {
    //    if (confirm("Delete Record?") == true) {
    //     var id = $(this).data('id');

    //     // ajax
    //     $.ajax({
    //         type:"POST",
    //         url: "{{ url('delete-book') }}",
    //         data: { id: id },
    //         dataType: 'json',
    //         success: function(res){
    //           window.location.reload();
    //        }
    //     });
    //    }
    // });
    //     $('body').on('click', '#btn-save', function(event) {
    //         var NoPanggil = $("#NoPanggil").val();
    //         var judul = $("#judul").val();
    //         var penerbit = $("#penerbit").val();
    //         var pengarang = $("#pengarang").val();
    //         var halaman = $("#halaman").val();
    //         var jumlah = $("#jumlah").val();
    //         var kategori_buku_id = $("#kategori_buku_id").val();
    //         $("#btn-save").html('Please Wait...');
    //         $("#btn-save").attr("disabled", true);

    //         // ajax
    //         $.ajax({
    //             type: "POST",
    //             url: "{{ url('add-update-book') }}",
    //             data: {
    //                 NoPanggil: NoPanggil,
    //                 judul: judul,
    //                 penerbit: penerbit,
    //                 pengarang: pengarang,
    //                 halaman: halaman,
    //                 jumlah: jumlah,
    //                 kategori_buku_id: kategori_buku_id,
    //             },
    //             dataType: 'json',
    //             success: function(res) {
    //                 window.location.reload();
    //                 $("#btn-save").html('Submit');
    //                 $("#btn-save").attr("disabled", false);
    //             }
    //         });
    //     });
    // });
    // alert("aaa")
</script>
@endsection