<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\KategoriBuku;
use App\Models\DetailBuku;

class ViewController extends Controller
{
    public function home(){
        return view('master/app');
    }

    public function search(Request $request){
        try {
            $value = $request->all();
            // dd($value);
            if ($value['kategori_id'] == 'all'){
                $operation = Buku::join('kategori_bukus','bukus.buku_kategori_id','=','kategori_bukus.id')
                            ->where('bukus.pengarang', 'LIKE', '%' . $value['val_search'] . '%')
                            ->orWhere('bukus.judul', 'LIKE', '%' . $value['val_search'] . '%')
                            ->where('bukus.is_active', '1')
                            ->where('kategori_bukus.is_active', '1')
                            ->select(
                                'bukus.*',
                                'kategori_bukus.nama_kategori'
                            )
                            ->get()->toArray();
            } else {
                $operation = Buku::join('kategori_bukus','bukus.buku_kategori_id','=','kategori_bukus.id')
                            ->where('bukus.pengarang', 'LIKE', '%' . $value['val_search'] . '%')
                            ->orWhere('bukus.judul', 'LIKE', '%' . $value['val_search'] . '%')
                            ->where('kategori_bukus.id', $value['kategori_id'])
                            ->where('bukus.is_active', '1')
                            ->where('kategori_bukus.is_active', '1')
                            ->select(
                                'bukus.*',
                                'kategori_bukus.nama_kategori'
                            )
                            ->get()->toArray();   
            }
     
            return $this->response($operation);
        } catch (\Exception $e) {
            return $this->response($e->getMessage(), true);
        }
    }

    public function selectCategory(){
        try {
            $operation = KategoriBuku::where('is_active','1')->get()->toArray();
            return $this->response($operation);
        } catch(\Exception $e){
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

    public function selectKoleksi()
    {
        try {
            $operation = Buku::latest('created_at')
                            ->take(8)
                            ->where('bukus.is_active', '1')
                            ->get();

            return $this->response($operation);
        } catch (\Exception $e){
            return $this->response($e->getMessage(), true);
        }
    }
}
