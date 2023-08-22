<!DOCTYPE html>
<html>
<head>
	<title>Cetak Barcode</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
	<svg id="barcode"></svg>
	<table class="w-100">
		<tbody>
			<?php foreach ($operation as $key => $val) :
				if (count($operation) == 1): ?>
					<tr>
						<td class="w-50 pt-3">
							<table class="table mx-auto" style="width:65%; border:1px solid black">
								<tr>
									<td class="text-center p-0" style="font-size:13px;">
										<p class="m-0 mt-1 mb-2">Perpustakaan SMP AL-FALAH</p>
										<p class="m-0 mb-1">KETINTANG, SURABAYA</p>
									</td>
								</tr>
								<tr>
									<td class="p-0">
										<div class="text-center mx-auto" style="border-top:1px solid black">
											@php
											$generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
											@endphp
											<div class="mt-4 mx-auto" style="width:125px; height:55px">
												<img class="w-100 h-100" src="data:image/png;base64,{{ base64_encode($generatorPNG->getBarcode($val['eksemplar_id'], $generatorPNG::TYPE_CODE_128)) }}">
											</div>
											<p class="mb-0" style="font-size:11px">{{$val['no_panggil']}}</p>
											<p class="mt-2" style="font-weight:bold; font-size:13px">{{$val['nama_kategori']}}</p>
										</div>
									</td>
								</tr>
							</table>
						</td>
						<td></td>
					</tr>
				<?php else:
					if ($key % 2 == 0):?>	
						<tr>
							<td class="w-50 pt-3">
								<table class="table mx-auto" style="width:65%; border:1px solid black">
									<tr>
										<td class="text-center p-0" style="font-size:13px">
											<p class="m-0 mt-1 mb-2">Perpustakaan SMP AL-FALAH</p>
											<p class="m-0 mb-1">KETINTANG, SURABAYA</p>
										</td>
									</tr>
									<tr>
										<td class="p-0">
											<div class="text-center mx-auto" style="border-top:1px solid black">
												@php
												$generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
												@endphp
												<div class="mt-4 mx-auto" style="width:125px; height:55px">
													<img class="w-100 h-100" src="data:image/png;base64,{{ base64_encode($generatorPNG->getBarcode($val['eksemplar_id'], $generatorPNG::TYPE_CODE_128)) }}">
												</div>
												<p class="mb-0" style="font-size:11px">{{$val['no_panggil']}}</p>
												<p class="mt-2" style="font-weight:bold; font-size:13px">{{$val['nama_kategori']}}</p>
											</div>
										</td>
									</tr>
								</table>
							</td>
					<?php else: ?>
							<td class="w-50 pt-3">
								<table class="table mx-auto" style="width:65%; border:1px solid black">
									<tr>
										<td class="text-center p-0" style="font-size:13px">
											<p class="m-0 mt-1 mb-2">Perpustakaan SMP AL-FALAH</p>
											<p class="m-0 mb-1">KETINTANG, SURABAYA</p>
										</td>
									</tr>
									<tr>
										<td class="p-0">
											<div class="text-center mx-auto" style="border-top:1px solid black">
												@php
												$generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
												@endphp
												<div class="mt-4 mx-auto" style="width:125px; height:55px">
													<img class="w-100 h-100" src="data:image/png;base64,{{ base64_encode($generatorPNG->getBarcode($val['eksemplar_id'], $generatorPNG::TYPE_CODE_128)) }}">
												</div>
												<p class="mb-0" style="font-size:11px">{{$val['no_panggil']}}</p>
												<p class="mt-2" style="font-weight:bold; font-size:13px">{{$val['nama_kategori']}}</p>
											</div>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					<?php endif; ?>
				<?php endif; ?>
			<?php endforeach; ?>
		</tbody>
	</table>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>