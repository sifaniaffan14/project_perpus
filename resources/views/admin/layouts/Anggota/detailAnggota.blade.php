@extends('master.landing')

@section('content')

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Anggota</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3" style="padding: 10vh;">
                    <img src="{{ asset('images/undraw_posting_photo.svg') }}" alt="" style="width: 100%; ">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum, itaque?</p>
                </div>
                <div class="col-lg-7" style="padding: 10vh;">
                    <table style="width: 100%">
                        <tbody style="color: #000000; font-weight:bold">
                            <tr>
                                <td>
                                    <h5> No Induk </h5>
                                </td>
                                <td>
                                    <h5> : </h5>
                                </td>
                                <td>
                                    <h5>{{ $detailAnggota['no_induk'] }}</h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>Nama</h5>
                                </td>
                                <td>
                                    <h5> : </h5>
                                </td>
                                <td>
                                    <h5>{{ $detailAnggota['nama'] }}</h5>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <h5>Jenis Kelamin</h5>
                                </td>
                                <td>
                                    <h5> : </h5>
                                </td>
                                <td> {{ $detailAnggota['jenis_kelamin'] }} </td>
                            </tr>

                            <tr>
                                <td>
                                    <h5>TTL </h5>
                                </td>
                                <td>
                                    <h5> : <h5>
                                </td>
                                <td> {{ $detailAnggota['TTL']}} </td>
                            </tr>

                            <tr>
                                <td>
                                    <h5>Halaman </h5>
                                </td>
                                <td>
                                    <h5> : </h5>
                                </td>
                                <td> {{ $detailAnggota['jenis_anggota'] }} </td>
                            </tr>

                            <tr>
                                <td>
                                    <h5>stok</h5>
                                </td>
                                <td>
                                    <h5> : </h5>
                                </td>
                                <td> {{ $detailAnggota['alamat'] }} </td>
                            </tr>

                            <tr>
                                <td>
                                    <h5>kategori </h5>
                                </td>
                                <td>
                                    <h5> : </h5>
                                </td>
                                <td> {{ $detailAnggota['email'] }} </td>
                            </tr>
                            
                            <tr>
                                <td>
                                    <h5>kategori </h5>
                                </td>
                                <td>
                                    <h5> : </h5>
                                </td>
                                <td> {{ $detailAnggota['no_telp'] }} </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="bottom" style="position: absolute; padding-top: 38vh; margin-left:2vh">
                    <form action="{{ route('anggota.formedit')}}" method="POST">
                        @csrf
                        <a onclick="kembali()" class="btn btn-primary">kembali</a>
                        <input type="hidden" name="id_anggota" id="id_anggota" value="{{ $detailAnggota['id'] }}">
                        <button type="submit" class="btn btn-warning">Edit <i class="bi bi-pencil-square"></i></button>
                        <a onclick="hapusAnggota()" methode="post" class="btn btn-danger">Hapus <i class="bi bi-trash"></i></a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script type="text/javascript">

function kembali() {
        window.location.href = window.location.origin + '/bukumanagement';
    }

    function hapusAnggota() {
        var id = $('#id_anggota').val()
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
                        url: window.location.origin + "/deleteAnggota/" + id,
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
                            window.location.href = window.location.origin + '/anggotamanagement';

                        }
                    });
                }
            });

    }
</script>