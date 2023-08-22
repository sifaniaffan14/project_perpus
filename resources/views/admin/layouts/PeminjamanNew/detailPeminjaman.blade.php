@extends('master.landing')

@section('content')

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Pinjaman</h6>
        </div>
        <div class="card-body">
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
                                    <h5>{{ $peminjaman->Anggota->no_induk }}</h5>
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
                                    <h5>{{ $peminjaman->Anggota->nama }}</h5>
                                </td>
                            </tr>
                      

                        </tbody>
                    </table>
                </div>
                <hr style="width: 80%;text-align: center;  border-top: 2px solid ">
                <div class="header-list" style="padding:4vh;">
                <h2 style="text-align: center; font-weight:bold;">List Buku Pinjaman</h2>
                <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Eksemplar</th>
                            <th>Judul Buku</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="isiTable">
                    @foreach($detailPeminjaman as $PeminjamanDetail)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $PeminjamanDetail->DetailBuku->KodeBuku }}</td>
                            <td>{{ $PeminjamanDetail->DetailBuku->Buku->judul }}</td>
                            <td>{{ $PeminjamanDetail->tgl_pinjam }}</td>
                            <td>{{ $PeminjamanDetail->tgl_kembali }}</td>
                            <td>
                                <a onclick="" class="btn btn-danger">kembali <i class="bi bi-trash"></i></a>
                            </td>
                    
                        </tr>
                        @endforeach 
                    </tbody>
                </table>
            </div>
                </div> 
        </div>  
    </div>
</div>
@endsection