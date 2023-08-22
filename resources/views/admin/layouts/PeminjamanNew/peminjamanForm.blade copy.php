@extends('master.landing')

@section('content')

<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Peminjaman Buku</h6>
        </div>
        <div class="card-body">
            <div class="row" style="padding: 2vh;">
                <h5>Data Anggota</h5>

                <div class="isi" style="padding: 1vh;">
                    <table class="tableFormUser">

                        <tr>
                            <td>Masukkan Id Anggota : </td>
                            <td style="padding-left: 10px;">
                                <datalist id="suggestions"></datalist>
                                <input list="suggestions" type="search" style="border-radius: 6px;" placeholder="Search..." id="pakwildan" onkeyup="pakwildan()">
                                </td>
                        </tr>

                        <tr style="padding-top: 100px;">
                            <td>
                                No Induk :
                            </td>
                            <td>
                                123
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Nama :
                            </td>
                            <td>
                                Anggota
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Jenis Anggota :
                            </td>
                            <td>
                                Affan
                            </td>
                        </tr>

                    </table>


                </div>
            </div>
            <hr style="width: 80%; margin-top:3vh;text-align: center;  border-top: 2px solid ">
            <div class="head-list" style="padding:4vh;">
                <h4 style="text-align: center; font-weight:bold;">Daftar Pinjaman Buku</h4>
            </div>
            <div class="box-input" style="padding: 0vh 0vh 2vh 10vh;">
                <input type="text" placeholder="Masukkan kode buku..." style="border-radius: 8px;" size="30">
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" cellspacing="0" style="width: 80%; margin: 2vh 0vh 0vh 10vh">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Eksemplar</th>
                            <th>Judul Buku</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="isiTable">

                        <tr>
                            <td>1</td>
                            <td>31231</td>
                            <td>321</td>
                            <td>
                                <a onclick="" class="btn btn-danger">Hapus <i class="bi bi-trash"></i></a>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <div class="save-pinjaman" style="padding: 2vh 0vh 0vh 10vh;">
                <button class="btn btn-success">Submit</button>
            </div>
        </div>
    </div>

</div>


@endsection
<script type="text/javascript">
    function pakwildan() {
        var input = $("#pakwildan").val();
        if (input != '') {
            $.ajax({
                type: "POST",
                url: "{{ url('/search') }}" + "/" + input,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    no_induk: input,
                },
                dataType: 'json',
                success: function(res) {
                    if(res.anggota.length != 0){
                        $('#suggestions').empty()
                        $(res.anggota).each(function(index, element) { 
                            console.log(element)

                            $('#suggestions').append(`<option value="`+element.no_induk+`">`+element.nama+`</option>`)
                        });
                    }
                }
            })
        }
    }
</script>