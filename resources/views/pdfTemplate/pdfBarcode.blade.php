<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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
</head>

<body>
<div class="grid-container">
@foreach ($barcodebuku as $barcodebuku)
                <div class="grid-item">
                    <div style="padding: 20px 20px 0;">
                    <h6>Perpustakaan SMP AL-Falah Ketintang Surabaya</h5>
                    @php
                    $generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
                    @endphp
                    <img src="data:image/png;base64,{{ base64_encode($generatorPNG->getBarcode($barcodebuku['KodeBuku'], $generatorPNG::TYPE_CODE_128)) }}">
                    <h5 style="margin-top: 10px;">{{$barcodebuku['KodeBuku']}}</h5>
                    </div>
                    <h6 style="border-top: 1px solid black;">{{ $barcodebuku->Buku->judul }}</h5>
                    <h6>{{ $barcodebuku->Buku->KategoriBuku->nama }}</h5>
                </div>

                @endforeach

            </div>
</body>
</html>