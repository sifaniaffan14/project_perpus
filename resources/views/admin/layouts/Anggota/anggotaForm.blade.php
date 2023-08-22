@extends('master.landing')

@section('content')
<!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->
<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Anggota Baru</h6>
        </div>
        <div class="card-body">
            <form action="JavaScript:saveAnggota()" id="addAnggota" name="addAnggota" class="form-horizontal" method="POST" autocomplete="off">
                <table class="tableFormUser">
                    <tr>
                        <td><input type="hidden" name="id" id="id" value="<?= isset($anggota['id']) ? ($anggota['id']) : '' ?>"></td>
                    </tr>
                    <tr>
                        <td style="width:30%">No Induk</td>
                        <td><input type="text" name="no_induk" id="no_induk" value="<?= isset($anggota['no_induk']) ? ($anggota['no_induk']) : '' ?>"></td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td><input type="text" name="nama" id="nama" value="<?= isset($anggota['nama']) ? ($anggota['nama']) : '' ?>"></td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td><input type="text" name="jenis_kelamin" id="jenis_kelamin" value="<?= isset($anggota['jenis_kelamin']) ? ($anggota['jenis_kelamin']) : '' ?>"></td>
                    </tr>
                    <tr>
                        <td>TTL</td>
                        <td><input type="text" name="TTL" id="TTL" value="<?= isset($anggota['TTL']) ? ($anggota['TTL']) : '' ?>"></td>
                    </tr>
                    <tr>
                        <td>Jenis Anggota</td>
                        <td><input type="text" name="jenis_anggota" id="jenis_anggota" value="<?= isset($anggota['jenis_anggota']) ? ($anggota['jenis_anggota']) : '' ?>"></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td><input type="text" name="alamat" id="alamat" value="<?= isset($anggota['alamat']) ? ($anggota['alamat']) : '' ?>"></td>
                    </tr>
                    <tr>
                        <td>email</td>
                        <td><input type="text" name="email" id="email" value="<?= isset($anggota['email']) ? ($anggota['email']) : '' ?>"></td>
                    </tr>
                    <tr>
                        <td>No Telpon</td>
                        <td><input type="text" name="no_telp" id="no_telp" value="<?= isset($anggota['no_telp']) ? ($anggota['no_telp']) : '' ?>"></td>
                    </tr>
                </table>
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary" style="padding:0.5vw 2vw">Submit</button>
                </div>

            </form>
        </div>
    </div>

</div>


@endsection
<script type="text/javascript">
    function saveAnggota() {
        var id = $("#id").val();
        var NoInduk = $("#no_induk").val();
        var nama = $("#nama").val();
        var JenisKelamin = $("#jenis_kelamin").val();
        var TTL = $("#TTL").val();
        var JenisAnggota = $("#jenis_anggota").val();
        var alamat = $("#alamat").val();
        var email = $("#email").val();
        var NoTelp = $("#no_telp").val();
        if ($("#id").val() == '') {

            // ajax

            $.ajax({
                type: "POST",
                url: "{{ url('anggotaAdd') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    no_induk: NoInduk,
                    nama: nama,
                    jenis_kelamin: JenisKelamin,
                    TTL: TTL,
                    jenis_anggota: JenisAnggota,
                    alamat: alamat,
                    email: email,
                    no_telp: NoTelp,
                },
                success: function(res) {

                    if (res.success == true) {
                        Swal.fire({
                            title: 'success',
                            text: 'Data Telah Ditambahkan',
                            icon: 'success',
                            confirmButtonText: 'oke'
                        });
                        window.location.href = window.location.origin + '/anggotamanagement';
                    } else {
                        window.location.href = window.location.origin + '/anggotaForm';
                    }
                }
            });
        } else {
            $.ajax({
                type: "POST",
                url: window.location.origin + "/editAnggota/" + id,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: id,
                    no_induk: NoInduk,
                    nama: nama,
                    jenis_kelamin: JenisKelamin,
                    TTL: TTL,
                    jenis_anggota: JenisAnggota,
                    alamat: alamat,
                    email: email,
                    no_telp: NoTelp,
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
                        window.location.href = window.location.origin + '/anggotamanagement';
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
</script>