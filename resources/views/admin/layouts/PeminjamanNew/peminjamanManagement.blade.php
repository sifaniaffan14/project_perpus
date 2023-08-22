@extends('master.landing')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <!-- Page Heading -->
            <div class="pengajuanTop">
                <h1 class="h3 mb-2 text-gray-800">Peminjaman Buku</h1>
                @if (session('status'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ session('status') }}</strong>
                </div>
                @endif
                <div class="bar">
                    <a href="" class="btn btn-dark btn-user">Buku Sedang Dipinjam</a>
                    <a href="" class="btn btn-light btn-user">Riwayat Peminjaman</a>
                </div>
            </div>

            <div class="listPeminjaman">
                @foreach($list as $item)
                <div class="box1 card mb-4 py-3 border-left-primary">
                    <div class="itemPeminjaman">
                        <div class="data">
                            <table style="width:100%">
                            <tr>
                                    <th style="width:30%">No Induk :</th>
                                    <td> {{$item->Anggota->no_induk}}</td>
                                </tr>
                            <tr>
                                    <th style="width:30%">Nama Peminjam :</th>
                                    <td> {{$item->Anggota->nama}}</td>
                                </tr>
                                <tr>
                                    <th style="width:30%">Durasi Peminjaman :</th>
                                   
                                </tr>
                              
                            </table>
                        </div>
                        <div class="status">
                            <p>Status <br>dass</p>
                            {{-- <select name="status" id="status" style="width:100%">
                                <option>Pending</option>

                            </select> --}}
                            <div class="btn-tambah "><a href="{{ route('detailPeminjaman.view',$item->id)}}"
                                    class="btn btn-primary btn-user btn-block">Details</a></div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>

    </div>
</div>
<!-- /.container-fluid -->
@endsection

<style>

</style>

<script type="text/javascript">
    function Print() {
        window.print();
    }

    function alert() {
        Swal.fire({
            title: 'success',
            text: 'Data Telah Dihapus',
            icon: 'success',
            confirmButtonText: 'oke'
        });
    }
</script>