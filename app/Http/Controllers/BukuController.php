<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Database\Eloquent\Collection;
use App\Models\DetailBuku;
use App\Models\KategoriBuku;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    public function index()
    {
        return view('admin.layouts.buku.index');
    }

    public function select(Request $request)
    {
        try {
            if (isset($_GET['id'])) {
                $operation = db::select('SELECT bukus.*,kategori_bukus.nama_kategori FROM `bukus`
                LEFT JOIN kategori_bukus
                ON bukus.buku_kategori_id = kategori_bukus.id
                WHERE bukus.id = "' . $_GET['id'] . '" AND bukus.is_active = 1');
            } else {
                $operation = db::select('SELECT bukus.*, kategori_bukus.nama_kategori FROM `bukus` 
                LEFT JOIN kategori_bukus
                ON bukus.buku_kategori_id = kategori_bukus.id
                WHERE bukus.is_active = 1');
            }
            return $this->response($operation);
        } catch (\Exception $e) {
            return $this->response($e->getMessage(), true);
        }
    }
    
    public function getData()
    {
        $kategori_buku = KategoriBuku::select('nama_kategori', 'id')->where('is_active', 1)->orderBy('nama_kategori', 'asc')->get();
        return $this->response($kategori_buku);
    }
    // public function detailBuku(Request $request){
    //     $detailbuku=Buku::find($request->id);
    //     $bukuEksemplar=DetailBuku::where('buku_id','=',$request->id)->get();
    //     return view('admin.layouts.Buku.detailBuku',['detailbuku'=>$detailbuku,'listEksemplar'=>$bukuEksemplar]);
    // }

    // public function form(){
    //         $detailbuku=Buku::find(request()->id_buku);
    //         return view('admin.layouts.Buku.bukuForm',['detailbuku'=>$detailbuku]);
    // }

    // public function formEdit(){
    //         $detailbuku=Buku::find(request()->id_buku);
    //         return view('admin.layouts.Buku.bukuForm',['detailbuku'=>$detailbuku]);
    // }
    public function insert(Request $request)
    {
        try {
            $data = $request->all();
            $request->validate([
                'buku_kategori_id' => 'required',
                'kode_buku' => 'required',
                'judul' => 'required',
                'pengarang' => 'required',
                'halaman' => 'required',
                'no_isbn' => 'required'
            ]);

            $image = $request->file('image');
            if (!empty($image)) {
                $request->image = $request->judul . '-cover.' . $image->getClientOriginalExtension();
                $image->move(public_path('storage/buku/') , $request->image);
            }

            $uuid = Uuid::uuid5(Uuid::NAMESPACE_DNS, Str::random());
            $data['id'] = md5($uuid->toString());
            $data['image'] = $request->image;
            
            $operation = Buku::create($data);
        
            return $this->responseCreate($operation);
        } catch (\Exception $e) {
            return $this->responseCreate($e->getMessage(), true);
        }
    }
    public function update(Request $request)
    {
        // dd($request->all());
        try {
            $data = $request->all();
            
            $request->validate([
                'buku_kategori_id' => 'required',
                'kode_buku' => 'required',
                'judul' => 'required',
                'pengarang' => 'required',
                'no_isbn' => 'required',
                'halaman' => 'required',
            ]);
            unset($data['_token']);

            $buku = Buku::findOrFail($data['id']);

            $image = $request->file('image');
            if (!empty($image)) {   
                $current = public_path('storage/buku/' . $buku->image);
                File::delete($current);   
                $request->image = $request->judul . '-cover.' . $image->getClientOriginalExtension();
                $image->move(public_path('storage/buku/') , $request->image);
                $buku->image = $request->image;
            } 

            $buku->buku_kategori_id = $data['buku_kategori_id'];
            $buku->kode_buku = $data['kode_buku'];
            $buku->judul = $data['judul'];
            $buku->penerbit = $data['penerbit'];
            $buku->pengarang = $data['pengarang'];
            $buku->halaman = $data['halaman'];
            $buku->no_isbn = $data['no_isbn'];

            $operation = $buku->save();
            
            // $data = buku::find(request()->id);
            // $operation = $data->update($request->post());
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
                $buku = DB::table('bukus')
                    ->where('id', '=', $data['id'])
                    ->update([
                        'is_active' => '0'
                    ]);
                
                $getbuku = DB::table('bukus')->where('id', '=', $data['id'])->first();
                $eksemplar = DB::table('detail_bukus')
                    ->where('buku_id', $getbuku->id)
                    ->update([
                        'is_active' => '0'
                    ]);
            });
            $operation['success'] = true;
            return $this->responseDelete($operation);
        } catch (\Exception $e) {
            return $this->responseDelete($e->getMessage());
        }
    }
}
