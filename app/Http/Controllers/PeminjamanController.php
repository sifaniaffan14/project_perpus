<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\PeminjamanDetail;
use App\Models\DetailBuku;
use App\Models\Buku;
use App\Models\Anggota;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Collection;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Borders;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class PeminjamanController extends Controller
{
    public function formPeminjaman()
    {
        return view('admin.layouts.peminjaman.formCreate');
    }

    public function index()
    {
        return view('admin.layouts.peminjaman.index');
    }

    public function select()
    {
        try {
            $where = array();
            if (isset($_GET['peminjaman_id'])) {
                $condition = ['peminjaman_id',$_GET['peminjaman_id']];
                array_push($where,$condition);
            } 

            $operation = Peminjaman::with('peminjaman_detail.detail_buku.buku')->withCount([
                'peminjaman_detail as peminjaman_jumlah',
                'peminjaman_detail as peminjaman_sudah_kembali' => function ($query) {
                    $query->where('status_peminjaman', '=', '2');
                },
                'peminjaman_detail as peminjaman_belum_kembali' => function ($query) {
                    $query->where('status_peminjaman', '!=', '2');
                }
            ])->with('anggota')->where($where)->get();
 
            return $this->response($operation);
        } catch (\Exception $e) {
            return $this->response($e->getMessage(), true);
        }
    }

    public function onFilter(Request $request)
    {
        $where = array();
        if (isset($_GET['peminjaman_id'])) {
            $condition = ['peminjaman_id',$_GET['peminjaman_id']];
            array_push($where,$condition);
        } 
        try {
            if ($_GET['tahun'] != "" && $_GET['bulan'] == "" && $_GET['tanggal'] == ""){
                $operation = Peminjaman::with('peminjaman_detail.detail_buku.buku')->withCount([
                                'peminjaman_detail as peminjaman_jumlah',
                                'peminjaman_detail as peminjaman_sudah_kembali' => function ($query) {
                                    $query->where('status_peminjaman', '=', '2');
                                },
                                'peminjaman_detail as peminjaman_belum_kembali' => function ($query) {
                                    $query->where('status_peminjaman', '!=', '2');
                                }
                            ])->with('anggota')
                            ->where($where)
                            ->whereHas('peminjaman_detail', function ($query) {
                                $query->whereYear('tgl_pinjam', $_GET['tahun']);
                            })
                            ->get();
            } elseif($_GET['tahun'] != "" && $_GET['bulan'] != "" && $_GET['tanggal'] == ""){
                $operation = Peminjaman::with('peminjaman_detail.detail_buku.buku')->withCount([
                                'peminjaman_detail as peminjaman_jumlah',
                                'peminjaman_detail as peminjaman_sudah_kembali' => function ($query) {
                                    $query->where('status_peminjaman', '=', '2');
                                },
                                'peminjaman_detail as peminjaman_belum_kembali' => function ($query) {
                                    $query->where('status_peminjaman', '!=', '2');
                                }
                            ])->with('anggota')
                            ->where($where)
                            ->whereHas('peminjaman_detail', function ($query) {
                                $query->whereYear('tgl_pinjam', $_GET['tahun'])
                                      ->whereMonth('tgl_pinjam', $_GET['bulan']);
                            })
                            ->get();
            } elseif($_GET['tahun'] != "" && $_GET['bulan'] != "" && $_GET['tanggal'] != ""){
                $operation = Peminjaman::with('peminjaman_detail.detail_buku.buku')->withCount([
                                'peminjaman_detail as peminjaman_jumlah',
                                'peminjaman_detail as peminjaman_sudah_kembali' => function ($query) {
                                    $query->where('status_peminjaman', '=', '2');
                                },
                                'peminjaman_detail as peminjaman_belum_kembali' => function ($query) {
                                    $query->where('status_peminjaman', '!=', '2');
                                }
                            ])->with('anggota')
                            ->where($where)
                            ->whereHas('peminjaman_detail', function ($query) {
                                $query->whereYear('tgl_pinjam', $_GET['tahun'])
                                      ->whereMonth('tgl_pinjam', $_GET['bulan'])
                                      ->whereDay('tgl_pinjam', $_GET['tanggal']);
                            })
                            ->get();
            }
            return $this->response($operation);
        } catch (\Exception $e) {
            return $this->response($e->getMessage(), true);
        }
    }

    public function onDownload(Request $request){
        try {
            $operation = PeminjamanDetail::join('peminjamen','peminjaman_detail_peminjaman_id','=','peminjamen.peminjaman_id')
                        ->join('anggotas','peminjamen.anggota_id','=','anggotas.id')
                        ->select(
                            'peminjaman_details.peminjaman_detail_peminjaman_id', 
                            'anggotas.nama_anggota',
                            'anggotas.no_induk',
                            )
                        ->whereYear('peminjaman_details.tgl_pinjam', $_GET['tahun'])
                        ->whereMonth('peminjaman_details.tgl_pinjam', $_GET['bulan'])
                        ->groupBy('peminjaman_details.peminjaman_detail_peminjaman_id', 'anggotas.nama_anggota', 'anggotas.no_induk')
                        ->get();
            
            $operation2 = PeminjamanDetail::
                        select(
                            'peminjaman_detail_peminjaman_id', 
                            'tgl_pinjam',
                            DB::raw('MAX(tgl_kembali) as tgl_kembali'), 
                            DB::raw('COUNT(*) AS jumlah_buku'),
                            // DB::raw('SUM(CASE WHEN status_peminjaman = "2" THEN 1 ELSE 0 END) AS sudah_kembali'),
                            DB::raw('SUM(CASE WHEN status_peminjaman != "2" THEN 1 ELSE 0 END) AS belum_kembali')
                            )
                        ->whereYear('peminjaman_details.tgl_pinjam', $_GET['tahun'])
                        ->whereMonth('peminjaman_details.tgl_pinjam', $_GET['bulan'])
                        ->groupBy('peminjaman_detail_peminjaman_id', 'tgl_pinjam')
                        ->get();

            // Mengubah hasil query builder menjadi koleksi Laravel
            $operation = Collection::make($operation);
            $operation2 = Collection::make($operation2);
            
            // Menggabungkan kedua koleksi menjadi satu array
            $result = $operation->map(function ($item) use ($operation2) {
                $count = $operation2->firstWhere('peminjaman_detail_peminjaman_id', $item->peminjaman_detail_peminjaman_id);
                $item->tgl_pinjam = $count->tgl_pinjam;
                $item->tgl_kembali = $count->tgl_kembali;
                $item->jumlah_buku = $count->jumlah_buku;
                $item->status = $count->belum_kembali != 0 ? 'Belum Kembali' : 'Sudah Kembali';
                return $item;
            })->toArray();

            $spreadsheet = IOFactory::load($_SERVER['DOCUMENT_ROOT'].'/template_laporan/template_laporan_peminjaman.xlsx');;
            $sheet = $spreadsheet->getActiveSheet();
            
            $daftarBulan = [
                1 => 'Januari',
                2 => 'Februari',
                3 => 'Maret',
                4 => 'April',
                5 => 'Mei',
                6 => 'Juni',
                7 => 'Juli',
                8 => 'Agustus',
                9 => 'September',
                10 => 'Oktober',
                11 => 'November',
                12 => 'Desember'
            ];

            $sheet->setCellValue('D8', $_GET['tahun']);
            $sheet->setCellValue('D9', $daftarBulan[$_GET['bulan']]);

            $lastCell = '';
            for ($i = 0; $i < count($result); $i++){
                $sheet->setCellValue('B'.($i + 12), $i + 1);
                $sheet->setCellValue('C'.($i + 12), $result[$i]['nama_anggota']);
                $sheet->setCellValue('D'.($i + 12), $result[$i]['no_induk']);
                $sheet->setCellValue('E'.($i + 12), $result[$i]['tgl_pinjam']);
                $sheet->setCellValue('F'.($i + 12), $result[$i]['tgl_kembali']);
                $sheet->setCellValue('G'.($i + 12), $result[$i]['jumlah_buku']);
                $sheet->setCellValue('H'.($i + 12), $result[$i]['status']);
                $style = $sheet->getStyle('H'.($i + 12));
                if ($result[$i]['status'] == 'Sudah Kembali'){  
                    $rgb = 'A9D08E';
                } else {
                    $rgb = 'FF4B4B';
                }
                $spreadsheet->getActiveSheet()->getStyle('H'.($i + 12))->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => [
                            'rgb' => $rgb,
                        ],
                    ],
                ]);
                $lastCell = 'H'.($i + 12);
            }

            $styleArray = [
                'font' => [
                    'bold' => false,
                    'size' => 10,
                    'color' => ['rgb' => '3A3838'],
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                    ],
                ]
            ];
            
            $spreadsheet->getActiveSheet()->getStyle('B12:'.$lastCell)->applyFromArray($styleArray);

            $writer = new Xlsx($spreadsheet);

            $folderPath = $_SERVER['DOCUMENT_ROOT'].'/upload_files';
            if (!is_dir($folderPath)) {
                mkdir($folderPath);
            }
            $fileName = 'Laporan_Peminjaman_'.$_GET['tahun'].'_'.$_GET['bulan'].'_'.time().'.xlsx';
            $url = $folderPath.'/'.$fileName;
            $writer->save($url);

            $operation['fileName'] = $fileName;
            return $this->response($operation);
        } catch (\Exception $e) {
            return $this->responseCreate('Data yang dipilih kosong!',true);
        }
        
    }

    //     public function form(){
    //         // $detailbuku=Peminjaman::find(request()->id_buku);
    //         return view('admin.layouts.Peminjaman.peminjamanForm');
    // }
    public function insert(Request $request){
        try {
            $data = $request->all();
            $request->validate([
                'anggota_id'=> 'required',
                'tgl_pinjam'=> 'required',
                'tgl_kembali'=> 'required',
                'eksemplar_id.*'=> 'required',
            ]);
            DB::transaction(function () use ($data) {
                $uuid1 = Uuid::uuid5(Uuid::NAMESPACE_DNS, Str::random());
                $data['peminjaman_id'] = md5($uuid1->toString());
                $add = Peminjaman::create([
                    'peminjaman_id' => $data['peminjaman_id'],
                    'anggota_id' => $data['anggota_id'],
                ]);

                $detail['peminjaman_detail_peminjaman_id'] = $add['peminjaman_id'];
                // $detail['peminjaman_detail_id'] = $data['peminjaman_detail_id'];
                $detail['status_peminjaman'] = 1;
                $detail['tgl_pinjam'] = $data['tgl_pinjam'];
                $detail['tgl_kembali'] = $data['tgl_kembali'];
                // print_r($data);exit;
                foreach ($data['eksemplar_id'] as $key => $value) {
                    $uuid = Uuid::uuid5(Uuid::NAMESPACE_DNS, Str::random());
                    $data['peminjaman_detail_id'] = md5($uuid->toString());
                    $detail['peminjaman_detail_id'] = $data['peminjaman_detail_id'];
                    $detail['detail_buku_id'] = $value;
                    PeminjamanDetail::create($detail);

                    // Perubahan status buku menjadi dipinjam
                    DetailBuku::where('eksemplar_id',$value)->update([
                        'status' => 'dipinjam'
                    ]);
                }
            });

            $operation['success'] = true;
            return $this->responseCreate($operation);

        } catch (\Exception $e) {
            return $this->responseCreate($e->getMessage(),true);
        }
    }  

    public function update(Request $request)
    {
        try {
            $data = $request->all();

            $request->validate([
                'anggota_id'=> 'required',
                'tgl_pinjam'=> 'required',
                'tgl_kembali'=> 'required',
                'eksemplar_id.*'=> 'required',
            ]);
           
            DB::transaction(function () use ($data) {
                Peminjaman::where('peminjaman_id',$data['peminjaman_id'])->update([
                    'anggota_id' => $data['anggota_id'],
                ]);

                $peminjaman_detail = PeminjamanDetail::where('peminjaman_detail_peminjaman_id',$data['peminjaman_id'])->delete();
                
                $detail['peminjaman_detail_peminjaman_id'] = $data['peminjaman_id'];
                $detail['status_peminjaman'] = 1;
                $detail['tgl_pinjam'] = $data['tgl_pinjam'];
                $detail['tgl_kembali'] = $data['tgl_kembali'];
                foreach ($data['eksemplar_id'] as $key => $value) {
                    $uuid = Uuid::uuid5(Uuid::NAMESPACE_DNS, Str::random());
                    $data['peminjaman_detail_id'] = md5($uuid->toString());
                    $detail['peminjaman_detail_id'] = $data['peminjaman_detail_id'];
                    $detail['detail_buku_id'] = $value;
                    PeminjamanDetail::create($detail);
                }
            });

            $operation['success'] = true;
            return $this->responseUpdate($operation);
        } catch (\Exception $e) {
            return $this->responseUpdate($e->getMessage(), true);
        }
    }

    public function delete(Request $request)
    {
        try {
            $data = $request->all();
            DB::transaction(function () use ($data) {
                Peminjaman::where('peminjaman_id',$data['peminjaman_id'])->delete();
            });
            $operation['success'] = true;      
            return $this->responseDelete($operation);
        } catch (\Exception $e) {
            return $this->response($e->getMessage(), true);
        }
    }

    public function selectAnggota()
    {
        try {
            if (isset($_GET['id'])) {
                $peminjaman = Peminjaman::where("anggota_id", $_GET['id'])->orderBy("created_at", "asc")->first();

                $peminjamanDetail = [];
                if ($peminjaman != null){
                    $peminjaman = $peminjaman->toArray();
                    $peminjamanDetail = PeminjamanDetail::where("peminjaman_detail_peminjaman_id", $peminjaman['peminjaman_id'])
                                    ->whereNotIn('status_peminjaman', ['2'])->get()->toArray();
                }
                
                if ($peminjamanDetail != []){
                    $operation = $peminjamanDetail;
                } else {
                    $operation = Anggota::where('id', $_GET['id'])->where('is_active', 1)->get();
                }
            } else {
                $operation = Anggota::where('is_active', 1)->get();
            }
            // $generator = new BarcodeGeneratorPNG();
            // $generator->getBarcode($code, $generator::TYPE_CODE_128), 200, ['Content-Type' => 'image/png'];
            return $this->response($operation);
        } catch (\Exception $e) {
            return $this->response($e->getMessage(), true);
        }
    }
    public function selectEksemplar()
    {  
        try {
            if (isset($_GET['no_panggil'])) {
                $detail_buku = DetailBuku::where('no_panggil', $_GET['no_panggil'])->get()->toArray();
                
                if ($detail_buku != []){
                    $peminjaman_detail = PeminjamanDetail::where('detail_buku_id', $detail_buku[0]['eksemplar_id'])
                                    ->whereNotIn('status_peminjaman', ['2'])
                                    ->get()->toArray();
                    if ($peminjaman_detail){
                        $operation = $peminjaman_detail;
                    } else {
                        $operation = db::select('SELECT detail_bukus.*,bukus.judul FROM `detail_bukus`
                        LEFT JOIN bukus
                        ON detail_bukus.buku_id = bukus.id
                        WHERE detail_bukus.no_panggil = "' . $_GET['no_panggil'] . '" AND detail_bukus.is_active = 1');
                    }
                    return $this->response($operation);
                } else {
                    $detail_buku['message'] = "Buku tidak ditemukan!";
                    return $this->response($detail_buku);
                }
            }
        } catch (\Exception $e) {
            return $this->response($e->getMessage(), true);
        }
    }

    public function getAnggota()
    {
        $anggota = Anggota::select('no_induk', 'id')->where('is_active', 1)->orderBy('no_induk', 'asc')->get();
        return $this->response($anggota);
    }

    public function detailPeminjaman(Request $request)
    {
        $peminjaman = Peminjaman::find($request->id);
        $detailPeminjaman = PeminjamanDetail::where('peminjaman_id', '=', $request->id)->get();
        return view('admin.layouts.Peminjaman.detailPeminjaman', ['peminjaman' => $peminjaman, 'detailPeminjaman' => $detailPeminjaman]);
        // return view('admin.layouts.Peminjaman.detailPeminjaman');
    }

    public function search(Request $request)
    {
        $cari = $request->no_induk;
        $anggota = Anggota::where('no_induk', 'LIKE', '%' . $cari . '%')->orWhere('nama', 'LIKE', '%' . $cari . '%')->get();
        return response()->json(['success' => true, 'anggota' => $anggota]);
    }

    public function findNoInduk(Request $request)
    {
        $data = $request->no_induk;
        $anggota = Anggota::where('no_induk', '=', $data)->first();
        $success = "false";

        if ($anggota) {
            $success = "true";
        }

        return response()->json([
            'success' => $success,
            'data' => $anggota
        ]);
    }

    public function findBukuEksemplar(Request $request)
    {
        $DetailBuku = DetailBuku::where('KodeBuku', '=', $request->kode)->where('status', '!=', 0)->first();

        if ($DetailBuku) {
            $Buku = Buku::select('judul')->where('id', '=', $DetailBuku['buku_id'])->first();
            $DetailBuku['judul'] = $Buku['judul'];
            $operation = array(
                'success' => true,
                'data' => $DetailBuku
            );
        } else {
            $operation = array(
                'success' => false
            );
        }

        return $operation;
    }

    public function selectDataAnggota(){
        $operation = Anggota::all();

        return $this->response($operation);
    }
}
