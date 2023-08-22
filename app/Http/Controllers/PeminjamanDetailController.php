<?php

namespace App\Http\Controllers;

use App\Models\PeminjamanDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanDetailController extends Controller
{
    public function select()
    {
        try {
            if (isset($_GET['peminjaman_detail_id'])) {
                $operation = db::select('SELECT
                peminjaman_details.peminjaman_detail_id,
                peminjaman_details.tgl_pinjam,
                peminjaman_details.tgl_kembali,
                detail_bukus.no_panggil,
                bukus.judul 
            FROM
                `peminjaman_details`
                LEFT JOIN detail_bukus ON peminjaman_details.detail_buku_id = detail_bukus.eksemplar_id
                LEFT JOIN bukus ON detail_bukus.buku_id = bukus.id
                WHERE peminjaman_details.peminjaman_detail_id = "' . $_GET['peminjaman_detail_id'] . '" ');
            } else{
                $operation = db::select('SELECT
                peminjaman_details.*,
                detail_bukus.no_panggil,
                bukus.judul 
            FROM
                `peminjaman_details`
                LEFT JOIN detail_bukus ON peminjaman_details.detail_buku_id = detail_bukus.eksemplar_id
                LEFT JOIN bukus ON detail_bukus.buku_id = bukus.id'); 
            }
            // $generator = new BarcodeGeneratorPNG();
            // $generator->getBarcode($code, $generator::TYPE_CODE_128), 200, ['Content-Type' => 'image/png'];
            return $this->response($operation);
        } catch (\Exception $e) {
            return $this->response($e->getMessage(), true);
        }
    }
}
