@extends('master.landing')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 style="float:left" class="m-0 font-weight-bold text-dark">Data Buku</h3>
            <a href="{{ route('barcodeBuku.view')}}" style="float:right" class="btn font-weight-bold btn-warning">Barcode</a>
            <a href="{{ route('buku.form') }}" style="float:right" class="btn font-weight-bold btn-primary" id="addNewBook">+ Create New</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if (session('status'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ session('status') }}</strong>
                </div>
                @endif
                <table class="table" id="myTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th>NO</th>
                            <th>Judul</th>
                            <th>Penerbit</th>
                            <th>Pengarang</th>
                            <th>Kategori</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list as $buku)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $buku['judul'] }}</td>
                            <td>{{ $buku['penerbit'] }}</td>
                            <td>{{ $buku['pengarang'] }}</td>
                            <td>{{ $buku->kategoriBuku->nama }}</td>
                            <td><a href="{{ route('detailbuku.view',$buku->id)}}" class="btn btn-primary"><i class="bi bi-file-earmark-text-fill"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection

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