@extends('master.landing')

@section('content')

<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 style="float:left" class="m-0 font-weight-bold text-dark">Data Anggota</h3>

        </div>
        <div class="top" style="padding: 3vh 5vh 0vh 0vh;">
         
                <div id="dataTable_filter" class="dataTables_filter" style="font-weight: normal; white-space: nowrap; text-align: left;">
                    <label style="display: inline-block; margin-bottom: .5rem;">Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="dataTable">
                    </label>
                    <a href="{{ route('anggota.form')}}" style="float:right" class="btn font-weight-bold btn-primary" id="addNewBook">+ Create New</a>
                </div>
                
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if (session('status'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ session('status') }}</strong>
                </div>
                @endif
                <table class="table" id="myTable" width="100%" cellspacing="0" style="width: 90%; margin: 0vh auto 0vh auto">
                    <thead class="thead-dark">
                        <tr>
                            <th>NO</th>
                            <th>No Induk</th>
                            <th>Nama</th>
                            <th>Jenis Anggota</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list as $anggota)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $anggota['no_induk'] }}</td>
                            <td>{{ $anggota['nama'] }}</td>
                            <td>{{ $anggota['jenis_anggota'] }}</td>
                            <td><a href="{{ route('detailanggota.view',$anggota->id)}}" class="btn btn-primary"><i class="bi bi-file-earmark-text-fill"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

</div>

@endsection