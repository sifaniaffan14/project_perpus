@extends('master.landing')

@section('content')

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Barcode Buku</h6>
        </div>
        <div class="card-body">
            <form class="form-inline">

                <div class="dropdown">
                    <button class="btn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <div class="items" id="items">
                            <a class="dropdown-item">fsdf</a>
                        </div>
                    </div>
                </div>
            </form>
            <a href="{{ route('barcodeBuku.print') }}">fycxd</a>
            <div class="grid-container">
                @foreach ($barcodebuku as $barcodebuku)
                <div class="grid-item">
                    <div style="padding: 20px 20px 0;">
                    <h2>Perpustakaan SMP AL-Falah Ketintang Surabaya</h5>
                    @php
                    $generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
                    @endphp
                    <img src="data:image/png;base64,{{ base64_encode($generatorPNG->getBarcode($barcodebuku['KodeBuku'], $generatorPNG::TYPE_CODE_128)) }}">
                    <h5 style="margin-top: 10px;">{{$barcodebuku['KodeBuku']}}</h5>
                    </div>
                    <h2 style="border-top: 1px solid black;">{{ $barcodebuku->Buku->judul }}</h5>
                    <h2>{{ $barcodebuku->Buku->KategoriBuku->nama }}</h5>
                </div>

                @endforeach


            </div>
        </div>
    </div>
</div>
@endsection

<style>
    .grid-container {
        display: grid;
        grid-template-columns: auto auto auto;
        padding: 10px;
    }

    .grid-item {
        border: 1px solid rgba(0, 0, 0, 0.8);
        font-size: 30px;
        text-align: center;
    }
</style>