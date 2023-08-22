<?php

namespace App\Http\Controllers\Anggota;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\DetailBuku;

class PencarianBukuController extends Controller
{
    public function index()
    {
        return view('anggota.layouts.pencarianBuku.index');
    }

    public function search(Request $request){
        try {
            $value = $request->all();
            // dd($value);
            $operation = Buku::join('kategori_bukus','bukus.buku_kategori_id','=','kategori_bukus.id')
                            ->where('bukus.pengarang', 'LIKE', '%' . $value['val'] . '%')
                            ->orWhere('bukus.judul', 'LIKE', '%' . $value['val'] . '%')
                            ->where('bukus.is_active', '1')
                            ->where('kategori_bukus.is_active', '1')
                            ->select(
                                'bukus.*',
                                'kategori_bukus.nama_kategori'
                            )
                            ->get()->toArray();
     
            return $this->response($operation);
        } catch (\Exception $e) {
            return $this->response($e->getMessage(), true);
        }
    }

    public function selectDetail(Request $request){
        try {
            $value = $request->all();

            $operation = Buku::join('kategori_bukus','bukus.buku_kategori_id','=','kategori_bukus.id')
                            ->where('bukus.id', $value['id'])
                            ->select(
                                'bukus.*',
                                'kategori_bukus.nama_kategori'
                            )->get()->toArray();
            return $this->response($operation);
        } catch(\Exception $e){
            return $this->response($e->getMessage(), true);
        }
    }


    public function selectEksemplar()
    {
        try {
            $operation = DetailBuku::leftJoin('peminjaman_details','detail_bukus.eksemplar_id','=','peminjaman_details.detail_buku_id')
                            ->where('is_active', 1)
                            ->where('buku_id', $_GET['id'])
                            ->get();
            return $this->response($operation);
        } catch (\Exception $e) {
            return $this->response($e->getMessage(), true);
        }
    }
}
