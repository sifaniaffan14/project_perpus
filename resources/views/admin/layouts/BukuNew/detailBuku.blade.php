@extends('master.landing')

@section('content')

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Buku</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3" style="padding: 10vh;">
                    <img src="{{ asset('images/undraw_posting_photo.svg') }}" alt="" style="width: 100%; ">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum, itaque?</p>
                </div>
                <div class="col-lg-7" style="padding: 10vh;">
                    <input type="hidden" id="NoPanggil" value="{{ $detailbuku['NoPanggil'] }}">
                    <table style="width: 100%">
                        <tbody style="color: #000000; font-weight:bold">
                            <tr>
                                <td>
                                    <h5> No Panggil </h5>
                                </td>
                                <td>
                                    <h5> : </h5>
                                </td>
                                <td>
                                    <h5>{{ $detailbuku['NoPanggil'] }}</h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>Judul</h5>
                                </td>
                                <td>
                                    <h5> : </h5>
                                </td>
                                <td>
                                    <h5>{{ $detailbuku['judul'] }}</h5>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <h5>Penerbit</h5>
                                </td>
                                <td>
                                    <h5> : </h5>
                                </td>
                                <td> {{ $detailbuku['penerbit'] }} </td>
                            </tr>

                            <tr>
                                <td>
                                    <h5>Pengarang </h5>
                                </td>
                                <td>
                                    <h5> : <h5>
                                </td>
                                <td> {{ $detailbuku['pengarang']}} </td>
                            </tr>

                            <tr>
                                <td>
                                    <h5>Halaman </h5>
                                </td>
                                <td>
                                    <h5> : </h5>
                                </td>
                                <td> {{ $detailbuku['halaman'] }} </td>
                            </tr>

                            <tr>
                                <td>
                                    <h5>stok</h5>
                                </td>
                                <td>
                                    <h5> : </h5>
                                </td>
                                <td> {{ $detailbuku['jumlah'] }} </td>
                            </tr>

                            <tr>
                                <td>
                                    <h5>kategori </h5>
                                </td>
                                <td>
                                    <h5> : </h5>
                                </td>
                                <td> {{ $detailbuku->kategoriBuku->nama }} </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="bottom" style="position: absolute; padding-top: 38vh; margin-left:2vh">
                    <form action="{{ route('buku.formedit')}}" method="POST">
                        @csrf
                        <a onclick="kembali()" class="btn btn-primary">kembali</a>
                        <input type="hidden" name="id_buku" id="id_buku" value="{{ $detailbuku['id'] }}">
                        <button type="submit" class="btn btn-warning">Edit <i class="bi bi-pencil-square"></i></button>
                        <a onclick="hapusBuku()" methode="post" class="btn btn-danger">Hapus <i class="bi bi-trash"></i></a>
                    </form>
                </div>
            </div>
            <hr style="width: 80%; margin-top:3vh;text-align: center;  border-top: 2px solid ">
            <div class="header-eksemplar" style="padding:4vh;">
                <h2 style="text-align: center; font-weight:bold;">Detail Eksemplar</h2>
                <form action="{{ route('barcodeBuku.post')}}" method="POST">
                    @csrf
                    <button type="submit" id="btnSelectedRows" style="float:right" class="btn font-weight-bold btn-warning">Cetak Barcode</button>
                    <a style="float:right" class="btn font-weight-bold btn-primary" id="addNewBook" data-toggle="modal" onclick="showModal()">+ Create New</a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Eksemplar</th>
                            <th>Status</th>
                            <th>kondisi</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Action</th>
                            <th>Pilih Barcode</th>
                        </tr>
                    </thead>
                    <tbody id="isiTable">
                        @foreach ($listEksemplar as $detailEksemplar)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $detailEksemplar->KodeBuku }}</td>
                            <td>{{ $detailEksemplar->status }}</td>
                            <td>{{ $detailEksemplar->kondisi }}</td>
                            <td>-</td>
                            <td>-</td>
                            <td>
                                <a onclick="editEksemplar('<?php echo $detailEksemplar->id ?>','<?php echo $detailEksemplar->KodeBuku ?>','<?php echo $detailEksemplar->status ?>','<?php echo $detailEksemplar->kondisi ?>','<?php echo $detailEksemplar->buku_id ?>')" class="btn btn-warning" style="margin:5px" data-id="{{ $detailEksemplar->id }}">Edit<i class="bi bi-pencil-square"></i></a>
                                <a onclick="hapusEksemplar('<?php echo $detailEksemplar->id ?>')" methode="post" class="btn btn-danger">Hapus <i class="bi bi-trash"></i></a>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" name="detail_check[]" type="checkbox" value="{{ $detailEksemplar->KodeBuku }}" id="flexCheckDefault">

                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            </form>
            <div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-fullscreen" role="document">
                    <div class="modal-content" id="exampleModal1">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Eksemplar Buku</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="hideModal()">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="JavaScript:saveEksemplar()">
                            @csrf
                            <div class="modal-body">
                                <td><input class="form-control" type="hidden" name="buku_id" id="buku_id" value=""></td>
                                <td>Kode Eksemplar Buku</td>
                                <td><input class="form-control" type="hidden" name="id" id="Eksmplar_id" value=""></td>
                                <td><input class="form-control" type="text" name="KodeBuku" id="Eksemplar_kode" value=""></td>
                                <td>Status</td>
                                <td><input class="form-control" type="text" name="status" id="Eksemplar_status" value=""></td>
                                <td>Kondisi</td>
                                <td><input class="form-control" type="text" name="kondisi" id="Eksemplar_kondisi" value=""></td>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="hideModal()">Close</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script type="text/javascript">
    getDataEksemplar()

    var table;
    $(document).ready(function() {
        table = $('#dataTable').DataTable({
            columnDefs: [{
                orderable: false,
                className: 'select-checkbox',
                targets: 0
            }, {
                "targets": [2],
                "visible": false,
                "searchable": false
            }],
            select: {
                style: 'os',
                selector: 'td:first-child'
            },
            order: [
                [1, 'asc']
            ]
        });
    });

    $('#btnSelectedRows').on('click', function() {
        var tblData = table.rows('.selected').data();
        var tmpData;
        $.each(tblData, function(i, val) {
            tmpData = tblData[i];
            alert(tmpData);
        });
    })


    function hapusEksemplar(id) {


        $.ajax({
            type: "GET",
            url: "{{ url('deleteEksemplar') }}" + "/" + id,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            success: function(res) {
                getData()
            }
        })
    }

    function showModal() {
        $('#exampleModal').modal('show')
        $('#buku_id').val($('#id_buku').val())
        $('#Eksmplar_id').val('')
        $('#Eksemplar_kode').val('')
        $('#Eksemplar_status').val('')
        $('#Eksemplar_kondisi').val('')
    }

    function hideModal() {
        $('#exampleModal').modal('hide')
    }

    function hapusBuku() {
        var id = $('#id_buku').val()
        swal.fire({
                icon: "warning",
                title: "Are you sure!",
                text: ("You want to delete this Buku !"),
                type: "warning",
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes!",
                showCancelButton: true,
            })
            .then(function(isConfirm) {
                if (isConfirm.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: window.location.origin + "/deleteBuku/" + id,
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
                            window.location.href = window.location.origin + '/bukumanagement';

                        }
                    });
                }
            });

    }

    function kembali() {
        window.location.href = window.location.origin + '/bukumanagement';
    }

    function saveEksemplar() {
        var id = $("#Eksmplar_id").val();
        var buku_id = $("#buku_id").val();
        var KodeBuku = $("#Eksemplar_kode").val();
        var status = $("#Eksemplar_status").val();
        var kondisi = $("#Eksemplar_kondisi").val();

        // ajax
        if ($("#Eksmplar_id").val() == '') {
            $.ajax({
                type: "POST",
                url: "{{ url('addEksemplar') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    buku_id: buku_id,
                    KodeBuku: KodeBuku,
                    status: status,
                    kondisi: kondisi,
                },
                success: function(res) {
                    if (res.success == true) {
                        $('#Eksemplar_kode').val('')
                        $('#Eksemplar_status').val('')
                        $('#Eksemplar_kondisi').val('')
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

                }
            });
        } else {
            $.ajax({
                type: "POST",
                url: "{{ url('editEksemplar') }}" + "/" + id,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    buku_id: buku_id,
                    id: id,
                    KodeBuku: KodeBuku,
                    status: status,
                    kondisi: kondisi,
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

    function editEksemplar(id, KodeBuku, status, kondisi, buku_id) {
        showModal()
        $('#exampleModalLabel').html('Edit Eksemplar Buku')
        $("#Eksmplar_id").val(id);
        $("#Eksemplar_kode").val(KodeBuku);
        $("#buku_id").val(buku_id);
        $("#Eksemplar_status").val(status);
        $("#Eksemplar_kondisi").val(kondisi);
    }

    function getData() {
        var buku_id = $("#buku_id").val();
        $.ajax({
            type: "POST",
            url: "{{ url('listEksemplar') }}" + '/' + buku_id,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                buku_id: buku_id,
            },
            success: function(res) {
                $('#isiTable').empty()
                $.each(res.listEksemplar, function(key, value) {
                    $('#isiTable').append(`<tr>
                    <td>` + (key + 1) + `</td>
                    <td>` + value['KodeBuku'] + `</td>
                    <td>` + value['status'] + `</td>
                    <td>` + value['kondisi'] + `</td>
                    <td></td>
                    <td></td>
                    <td>
                        <a href="JavaScript:editEksemplar('` + value['id'] + `','` + value['KodeBuku'] + `','` + value['status'] + `','` + value['kondisi'] + `','` + value['buku_id'] + `')" class="btn btn-warning" style="margin:5px" >Edit<i class="bi bi-pencil-square"></i></a>
                        <a onclick="hapusEksemplar('` + value['id'] + `')" methode="post" class="btn btn-danger">Hapus <i class="bi bi-trash"></i></a>
                    </td>
                    </tr>`)
                })
            }
        });
    }

    function getDataEksemplar() {
        var buku_id = $("#buku_id").val();
        $.ajax({
            type: "GET",
            url: "{{ url('listEksemplar') }}" + '/' + buku_id,
            success: function(res) {
            }
        });
    }

    function inputField(id, KodeBuku, status, kondisi) {
        $("#Eksmplar_id").val(id);
        //$("#buku_id").val();
        $("#Eksemplar_kode").val(KodeBuku);
        $("#Eksemplar_status").val(status);
        $("#Eksemplar_kondisi").val(kondisi);
    }

    function cetakBarcode() {
        var kode_checklist = $("input[name='detail_check[]']:checked").map(function() {
            return $(this).val();
        }).get();
        var id = $('#buku_id').val()

        $.ajax({
            type: 'POST',
            url: "{{ route('barcodeBuku.view')}}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                kode_checklist: kode_checklist
            },
        })
    }
</script>