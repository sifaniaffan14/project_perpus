<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\InformasiPenting;
use Ramsey\Uuid\Uuid;

class InformasiPentingController extends Controller
{
    public function index()
    {
        return view('admin.layouts.informasi-penting.index');
    }

    public function select(){
        try {
            if(isset($_GET['id'])){
                $operation = InformasiPenting::where('id',$_GET['id'])->get();
            } else{ 
                $operation = InformasiPenting::all();
            }
            return $this->response($operation);
        } catch (\Exception $e) {
            return $this->response($e->getMessage(),true);
        }
    }
    public function insert(Request $request){
        try {
            $data = $request->all();
            $request->validate([
                'isi_informasi'=> 'required',
            ]);
    
            $data = $request->post();
            $operation = InformasiPenting::create([
                'isi_informasi' => $data['isi_informasi'],
                'tgl_informasi' => date('Y-m-d')
            ]);
            return $this->responseCreate($operation);
        } catch (\Exception $e) {
            return $this->responseCreate($e->getMessage(),true);
        }
    }    
    public function update(Request $request){

        try {
            $data = $request->all();
            $request->validate([
                'isi_informasi'=> 'required',
            ]);
            
            $data = InformasiPenting::find(request()->id);
            $operation = $data->update($request->post());
            return $this->responseUpdate($operation);
        } catch (\Exception $e) {
            return $this->responseCreate($e->getMessage(),true);
        }
    }
    public function delete(Request $request){
        
        try {            
            $data = $request->all();
            $operation = InformasiPenting::find($data['id'])->delete();

            return $this->responseDelete($operation);
        } catch (\Exception $e) {
            return $this->responseDelete($e->getMessage());
        }
    }
}
