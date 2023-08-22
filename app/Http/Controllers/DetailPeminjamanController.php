<?php

namespace App\Http\Controllers;
use App\Models\Peminjaman;
use App\Models\PeminjamanDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class DetailPeminjamanController extends Controller
{
    public function select(){
        try {
            $operation = PeminjamanDetail::where('is_active',1)->get();
            return $this->response($operation);
        } catch (\Exception $e) {
            return $this->response($e->getMessage(),true);
        }
    }  
    
    public function insert(Request $request){
        try {
            $data = $request->all();
            $request->validate([
                'peminjaman_id'=> 'required',
                'detail_buku_id'=> 'required',
                'tgl_pinjam'=> 'required',
                'tgl_kembali'=> 'required',
            ]);
                $uuid = Uuid::uuid5(Uuid::NAMESPACE_DNS, Str::random());
                $data['id'] = md5($uuid->toString());
                $operation = PeminjamanDetail::create($data);
                return $this->responseCreate($operation);
        } catch (\Exception $e) {
            return $this->responseCreate($e->getMessage(),true);
        }
    }   

    public function update(Request $request){
        try {
            $data = $request->all();
            // print_r($data);exit;
            $request->validate([
                'peminjaman_id'=> 'required',
                'detail_buku_id'=> 'required',
                'tgl_pinjam'=> 'required',
                'tgl_kembali'=> 'required',
            ]);
            $data = PeminjamanDetail::find(request()->id);
            $operation = $data->update($request->post());
            return $this->respondUpdated($operation);
        } catch (\Exception $e) {
            return $this->respondUpdated($e->getMessage(),true);
        }
    }
    public function delete(Request $request){
        try {            
            $data = $request->all();
            $data['is_active'] = 0;
            $operation = PeminjamanDetail::where('id',$data['id'])->update($data);

            return $this->responseDelete($operation);
        } catch (\Exception $e) {
            return $this->responseDelete($e->getMessage());
        }
    }

}
